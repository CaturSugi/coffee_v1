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
        
        return view('pos.transaction', [
            'products' => $products,
            'categories' => $categories,
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
            $this->transactionService->processPayment($transaction, $request->all());

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
     * Mark transaction as paid (Quick Action)
     */
    public function markAsPaid($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan',
            ], 404);
        }

        try {
            $transaction->markAsCompleted();

            return response()->json([
                'success' => true,
                'message' => 'Status pembayaran diperbarui menjadi Lunas',
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
        $query = Transaction::with(['details.product', 'member']);

        if ($request->has('status')) {
            $query->where('payment_status', $request->status);
        }

        if ($request->has('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->has('member_id')) {
            $query->where('member_id', $request->member_id);
        }

        if ($request->has('date_from') && $request->has('date_to')) {
            $query->betweenDates($request->date_from, $request->date_to);
        }

        $transactions = $query->latest()->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $transactions,
        ]);
    }
}
