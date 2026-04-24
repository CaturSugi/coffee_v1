<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Member;
use App\Models\Promotion;
use App\Services\TransactionService;
use App\Services\PrinterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    protected $transactionService;
    protected $printerService;

    public function __construct(TransactionService $transactionService, PrinterService $printerService)
    {
        $this->transactionService = $transactionService;
        $this->printerService = $printerService;
        
        $this->middleware('auth');
        $this->middleware('role:cs,admin,manager');
    }

    /**
     * Show POS interface
     */
    public function index()
    {
        $products = Product::active()->with('category')->get();
        $categories = \App\Models\ProductCategory::active()->get();
        $members = Member::active()->get();
        
        return view('pos.transaction', [
            'products' => $products,
            'categories' => $categories,
            'members' => $members,
        ]);
    }

    /**
     * Get products via API (for POS search/filter)
     */
    public function getProducts(Request $request)
    {
        $query = Product::active()->with('category');

        if ($request->has('search')) {
            $query->search($request->search);
        }

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    /**
     * Get product details
     */
    public function getProduct($id)
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product,
        ]);
    }

    /**
     * Search members
     */
    public function searchMembers(Request $request)
    {
        $search = $request->input('q', '');
        
        $members = Member::active()
            ->search($search)
            ->limit(10)
            ->get()
            ->map(function ($member) {
                return [
                    'id' => $member->id,
                    'name' => $member->member_name,
                    'code' => $member->member_code,
                    'phone' => $member->member_phone,
                    'discount' => $member->discount_percentage,
                    'tier' => $member->member_tier,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $members,
        ]);
    }

    /**
     * Validate promotion code
     */
    public function validatePromotion(Request $request)
    {
        $code = $request->input('code');
        $amount = $request->input('amount', 0);

        $promotion = Promotion::where('code', $code)->first();

        if (!$promotion) {
            return response()->json([
                'success' => false,
                'message' => 'Kode promosi tidak valid',
            ]);
        }

        if (!$promotion->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Promosi telah berakhir',
            ]);
        }

        if ($promotion->start_date > now() || $promotion->end_date < now()) {
            return response()->json([
                'success' => false,
                'message' => 'Promosi tidak berlaku untuk tanggal ini',
            ]);
        }

        if ($promotion->usage_limit && $promotion->usage_count >= $promotion->usage_limit) {
            return response()->json([
                'success' => false,
                'message' => 'Promosi telah mencapai batas penggunaan',
            ]);
        }

        if ($promotion->min_purchase > 0 && $amount < $promotion->min_purchase) {
            return response()->json([
                'success' => false,
                'message' => 'Minimum pembelian Rp ' . number_format($promotion->min_purchase, 0, ',', '.'),
            ]);
        }

        // Calculate discount
        $discount = 0;
        if ($promotion->discount_type === 'percentage') {
            $discount = ($amount * $promotion->discount_value) / 100;
            if ($promotion->max_discount) {
                $discount = min($discount, $promotion->max_discount);
            }
        } else {
            $discount = min($promotion->discount_value, $amount);
        }

        return response()->json([
            'success' => true,
            'message' => 'Kode promosi valid',
            'data' => [
                'code' => $promotion->code,
                'name' => $promotion->name,
                'discount' => $discount,
                'discount_type' => $promotion->discount_type,
            ],
        ]);
    }

    /**
     * Create transaction
     */
    public function store(StoreTransactionRequest $request)
    {
        try {
            $transaction = $this->transactionService->createTransaction(
                $request->validated()
            );

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil dibuat',
                'data' => $transaction,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Get transaction details
     */
    public function show($id)
    {
        $transaction = Transaction::with(['details.product', 'member', 'user'])->find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $transaction,
        ]);
    }

    /**
     * Process payment
     */
    public function processPayment(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan',
            ], 404);
        }

        try {
            $this->transactionService->processPayment($transaction, $request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil diproses',
                'data' => $transaction,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Print thermal
     */
    public function printThermal($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan',
            ], 404);
        }

        $result = $this->printerService->printThermal($transaction);

        return response()->json($result);
    }

    /**
     * Print via Bluetooth
     */
    public function printBluetooth($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan',
            ], 404);
        }

        $result = $this->printerService->printBluetooth($transaction);

        return response()->json($result);
    }

    /**
     * Download PDF invoice
     */
    public function downloadPDF($id)
    {
        $transaction = Transaction::with('details.product')->find($id);

        if (!$transaction) {
            abort(404);
        }

        $pdf = $this->printerService->generatePDF($transaction);

        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Invoice_' . $transaction->transaction_code . '.pdf"',
        ]);
    }

    /**
     * Cancel transaction
     */
    public function cancel($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan',
            ], 404);
        }

        try {
            $this->transactionService->cancelTransaction($transaction);

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil dibatalkan',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Get transaction list
     */
    public function list(Request $request)
    {
        $query = Transaction::with(['details.product', 'member', 'user']);

        if ($request->filled('status')) {
            $query->where('payment_status', $request->status);
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('order_status')) {
            $query->where('order_status', $request->order_status);
        }

        if ($request->filled('search')) {
            $query->where('transaction_code', 'like', "%{$request->search}%");
        }

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [$request->date_from . ' 00:00:00', $request->date_to . ' 23:59:59']);
        }

        $transactions = $query->latest()->paginate(15)->withQueryString();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $transactions,
            ]);
        }

        return view('pos.history', compact('transactions'));
    }

    /**
     * Mark transaction as served
     */
    public function markAsServed($id)
    {
        $transaction = Transaction::find($id);
        
        if (!$transaction) {
            return response()->json(['success' => false, 'message' => 'Transaksi tidak ditemukan'], 404);
        }

        $transaction->update(['order_status' => 'served']);

        return response()->json([
            'success' => true,
            'message' => 'Pesanan #' . $transaction->transaction_code . ' telah disajikan'
        ]);
    }

    /**
     * Get list of unserved orders for notifications
     */
    public function getUnservedOrders()
    {
        $orders = Transaction::with(['member', 'details.product'])
            ->where('order_status', '!=', 'served')
            ->where('payment_status', '!=', 'cancelled')
            ->latest()
            ->limit(10)
            ->get()
            ->map(function($tx) {
                return [
                    'id' => $tx->id,
                    'code' => $tx->transaction_code,
                    'time' => $tx->created_at->diffForHumans(),
                    'status' => $tx->order_status,
                    'customer' => $tx->member->member_name ?? 'Pelanggan Umum',
                    'items_count' => $tx->details->sum('quantity')
                ];
            });

        return response()->json([
            'success' => true,
            'count' => $orders->count(),
            'data' => $orders
        ]);
    }
}
