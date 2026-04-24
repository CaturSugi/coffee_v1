<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->withTrashed(false);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('sku', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        if ($request->filled('stock')) {
            if ($request->stock === 'low') {
                $query->whereColumn('stock', '<=', 'min_stock');
            } elseif ($request->stock === 'out') {
                $query->where('stock', 0);
            }
        }

        $products   = $query->latest()->paginate(12)->withQueryString();
        $categories = ProductCategory::active()->get();
        $totalActive = Product::where('is_active', true)->count();
        $lowStock    = Product::whereColumn('stock', '<=', 'min_stock')->where('is_active', true)->count();
        $outOfStock  = Product::where('stock', 0)->where('is_active', true)->count();

        return view('admin.products.index', compact(
            'products', 'categories', 'totalActive', 'lowStock', 'outOfStock'
        ));
    }

    public function create()
    {
        $categories = ProductCategory::active()->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'category_id'    => 'required|exists:product_categories,id',
            'description'    => 'nullable|string|max:1000',
            'sku'            => 'required|string|max:100|unique:products,sku',
            'purchase_price' => 'nullable|numeric|min:0',
            'sell_price'     => 'required|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'min_stock'      => 'required|integer|min:0',
            'is_active'      => 'boolean',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['created_by'] = auth()->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk "' . $validated['name'] . '" berhasil ditambahkan!');
    }

    public function show(Product $product)
    {
        $product->load('category', 'transactionDetails');
        $totalSold = $product->transactionDetails->sum('quantity');
        $totalRevenue = $product->transactionDetails->sum('subtotal');
        return view('admin.products.show', compact('product', 'totalSold', 'totalRevenue'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::active()->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'category_id'    => 'required|exists:product_categories,id',
            'description'    => 'nullable|string|max:1000',
            'sku'            => 'required|string|max:100|unique:products,sku,' . $product->id,
            'purchase_price' => 'nullable|numeric|min:0',
            'sell_price'     => 'required|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'min_stock'      => 'required|integer|min:0',
            'is_active'      => 'boolean',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk "' . $product->name . '" berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        $name = $product->name;
        // Soft delete
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Produk "' . $name . '" berhasil dihapus.');
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return back()->with('success', 'Produk berhasil dipulihkan.');
    }
}
