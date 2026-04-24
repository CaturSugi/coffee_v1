@extends('layouts.app')

@section('title', 'Manajemen Produk')
@section('page-title')
    ☕ <span>Manajemen</span> Produk
@endsection

@section('content')

<div style="display:flex; flex-direction:column; gap:24px;">

    {{-- ── Header & Stats Overview ── --}}
    <div style="display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:20px;">
        <div>
            <h2 style="font-size:24px; font-weight:800; color:var(--dark-800); margin-bottom:4px;">Katalog Produk</h2>
            <p style="color:var(--gray-400); font-size:14px; font-weight:500;">Kelola inventaris dan menu coffee shop Anda secara real-time.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary" style="width:auto; padding:0 24px; height:48px; border-radius:12px; font-weight:700; box-shadow:0 8px 15px rgba(234, 88, 12, 0.2);">
            ＋ Tambah Produk Baru
        </a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
        <div class="card" style="padding: 24px; border:none; border-left: 5px solid var(--brand-500); display: flex; align-items: center; gap: 18px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <div style="width: 52px; height: 52px; border-radius: 14px; background: var(--brand-50); color: var(--brand-600); display: flex; align-items: center; justify-content: center; font-size: 24px;">☕</div>
            <div>
                <div style="font-size: 11px; color: var(--gray-400); font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2px;">Aktif</div>
                <div style="font-size: 22px; font-weight: 900; color: var(--dark-800);">{{ $totalActive }}</div>
            </div>
        </div>
        <div class="card" style="padding: 24px; border:none; border-left: 5px solid #f59e0b; display: flex; align-items: center; gap: 18px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <div style="width: 52px; height: 52px; border-radius: 14px; background: #fffbeb; color: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 24px;">⚠️</div>
            <div>
                <div style="font-size: 11px; color: var(--gray-400); font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2px;">Menipis</div>
                <div style="font-size: 22px; font-weight: 900; color: var(--dark-800);">{{ $lowStock }}</div>
            </div>
        </div>
        <div class="card" style="padding: 24px; border:none; border-left: 5px solid #ef4444; display: flex; align-items: center; gap: 18px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <div style="width: 52px; height: 52px; border-radius: 14px; background: #fef2f2; color: #ef4444; display: flex; align-items: center; justify-content: center; font-size: 24px;">📦</div>
            <div>
                <div style="font-size: 11px; color: var(--gray-400); font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2px;">Habis</div>
                <div style="font-size: 22px; font-weight: 900; color: var(--dark-800);">{{ $outOfStock }}</div>
            </div>
        </div>
    </div>

    {{-- ── Filter Bar ── --}}
    <div class="card" style="padding: 24px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.05); border-radius:16px;">
        <form method="GET" action="{{ route('admin.products.index') }}" style="display: flex; flex-wrap: wrap; gap: 16px; align-items: flex-end;">
            <div style="flex: 2; min-width: 200px;">
                <label style="display: block; font-size: 11px; font-weight: 700; color: var(--gray-400); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Pencarian</label>
                <div style="position: relative;">
                    <span style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--gray-400);">🔍</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau SKU..." style="width:100%; padding-left: 40px; border-radius: 10px; border: 1px solid var(--gray-200); height: 45px; font-size: 14px; outline:none; transition:border-color 0.2s;">
                </div>
            </div>
            <div style="flex: 1; min-width: 150px;">
                <label style="display: block; font-size: 11px; font-weight: 700; color: var(--gray-400); margin-bottom: 8px; text-transform: uppercase;">Kategori</label>
                <select name="category_id" class="form-select" style="border-radius: 10px; border: 1px solid var(--gray-200); height: 45px;">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div style="flex: 1; min-width: 150px;">
                <label style="display: block; font-size: 11px; font-weight: 700; color: var(--gray-400); margin-bottom: 8px; text-transform: uppercase;">Status Stok</label>
                <select name="stock" class="form-select" style="border-radius: 10px; border: 1px solid var(--gray-200); height: 45px;">
                    <option value="">Semua Stok</option>
                    <option value="low" {{ request('stock') === 'low' ? 'selected' : '' }}>Stok Menipis</option>
                    <option value="out" {{ request('stock') === 'out' ? 'selected' : '' }}>Stok Habis</option>
                </select>
            </div>
            <div style="display: flex; gap: 8px;">
                <button type="submit" class="btn btn-primary" style="height: 45px; padding: 0 24px; border-radius: 10px; font-weight: 700;">Filter</button>
                @if(request()->hasAny(['search','category_id','stock','status']))
                    <a href="{{ route('admin.products.index') }}" class="btn" style="height: 45px; width: 45px; padding: 0; display: flex; align-items: center; justify-content: center; background: var(--gray-100); color: var(--gray-600); border-radius: 10px;" title="Reset">🔄</a>
                @endif
            </div>
        </form>
    </div>

    {{-- ── Product Grid ── --}}
    @if($products->isEmpty())
        <div class="card" style="padding:100px 24px; text-align:center; border:none; box-shadow:0 4px 20px rgba(0,0,0,0.05); border-radius:20px;">
            <div style="font-size:72px; margin-bottom:24px; opacity: 0.3;">☕</div>
            <h3 style="font-size:22px; font-weight:800; color:var(--dark-800); margin-bottom:12px;">Produk Tidak Ditemukan</h3>
            <p style="color:var(--gray-400); margin-bottom:30px; max-width:400px; margin-inline:auto; font-size:15px;">Kami tidak menemukan produk yang sesuai dengan kriteria pencarian Anda.</p>
            <a href="{{ route('admin.products.index') }}" class="btn" style="width:auto; padding:12px 30px; background:var(--gray-100); color:var(--dark-700); border-radius:12px; font-weight:700;">Lihat Semua Produk</a>
        </div>
    @else
        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(240px, 1fr)); gap:24px; margin-bottom:24px;">
            @foreach($products as $product)
            <div class="product-premium-card">
                <div class="card-status-badge">
                    @if(!$product->is_active)
                        <span class="badge" style="background:#6b7280; color:#fff;">NON-AKTIF</span>
                    @elseif($product->stock == 0)
                        <span class="badge" style="background:#ef4444; color:#fff;">HABIS</span>
                    @elseif($product->isLowStock())
                        <span class="badge" style="background:#f59e0b; color:#fff;">⚠ LOW STOCK</span>
                    @else
                        <span class="badge" style="background:#10b981; color:#fff;">READY</span>
                    @endif
                </div>

                <div class="card-image-box">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="main-img" onerror="this.src='{{ asset('images/product-placeholder.png') }}'">
                    <div class="card-overlay-actions">
                        <a href="{{ route('admin.products.edit', $product) }}" class="icon-btn">✏️</a>
                        <button onclick="deleteProduct({{ $product->id }}, '{{ addslashes($product->name) }}')" class="icon-btn" style="color:#ef4444;">🗑️</button>
                    </div>
                </div>

                <div class="card-content-box">
                    <div style="font-size:10px; color:var(--brand-500); font-weight:800; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">
                        {{ $product->category->name ?? 'Uncategorized' }}
                    </div>
                    <h3 class="product-title">{{ $product->name }}</h3>
                    <div style="font-size:11px; color:var(--gray-400); margin-bottom:16px; font-family:'JetBrains Mono', monospace;">{{ $product->sku }}</div>

                    <div style="display:flex; align-items:flex-end; justify-content:space-between; padding-top:16px; border-top:1px solid var(--gray-50);">
                        <div>
                            <div style="font-size:10px; color:var(--gray-400); font-weight:700; text-transform:uppercase; margin-bottom:2px;">Harga Jual</div>
                            <div style="font-size:18px; font-weight:900; color:var(--dark-800);">Rp {{ number_format($product->sell_price, 0, ',', '.') }}</div>
                        </div>
                        <div style="text-align:right;">
                            <div style="font-size:10px; color:var(--gray-400); font-weight:700; text-transform:uppercase; margin-bottom:2px;">Stok</div>
                            <div style="font-size:18px; font-weight:800; color:{{ $product->stock == 0 ? '#ef4444' : ($product->isLowStock() ? '#f59e0b' : '#10b981') }};">
                                {{ $product->stock }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- ── Pagination ── --}}
        <div style="margin-top: 10px;">
            {{ $products->links('partials.pagination') }}
        </div>
    @endif

</div>

{{-- ── Delete Modal ── --}}
<div id="delete-modal" class="modal-overlay" style="display:none;">
    <div class="modal-content" style="max-width:400px;">
        <div class="modal-header">
            <h3>🗑️ Konfirmasi Hapus</h3>
            <button onclick="closeDeleteModal()" class="close-btn">&times;</button>
        </div>
        <div class="modal-body" style="text-align:center;">
            <div style="width:70px; height:70px; border-radius:50%; background:rgba(239,68,68,0.1); color:#ef4444; display:flex; align-items:center; justify-content:center; font-size:30px; margin:0 auto 20px;">🗑️</div>
            <h4 style="font-size:18px; font-weight:800; color:var(--dark-800); margin-bottom:8px;">Hapus Produk?</h4>
            <p style="font-size:14px; color:var(--gray-500); margin-bottom:24px; line-height:1.5;">
                Apakah Anda yakin ingin menghapus <strong id="delete-name" style="color:var(--dark-800);"></strong>? Data produk ini akan dihapus dari katalog.
            </p>
            <form id="delete-form" method="POST">
                @csrf @method('DELETE')
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <button type="button" onclick="closeDeleteModal()" class="btn-cancel-custom">Batal</button>
                    <button type="submit" class="btn-delete-custom">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .product-premium-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid var(--gray-100);
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
        position: relative;
    }
    .product-premium-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        border-color: var(--brand-200);
    }
    .card-status-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        z-index: 10;
    }
    .card-status-badge .badge {
        padding: 6px 12px;
        border-radius: 10px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .card-image-box {
        aspect-ratio: 1/1;
        overflow: hidden;
        background: var(--gray-50);
        position: relative;
    }
    .card-image-box .main-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .product-premium-card:hover .main-img {
        transform: scale(1.1);
    }
    .card-overlay-actions {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.3);
        backdrop-filter: blur(2px);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        opacity: 0;
        transition: all 0.3s ease;
    }
    .product-premium-card:hover .card-overlay-actions {
        opacity: 1;
    }
    .icon-btn {
        width: 44px;
        height: 44px;
        background: #fff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 18px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transition: transform 0.2s;
        border: none;
        cursor: pointer;
    }
    .icon-btn:hover {
        transform: scale(1.1) rotate(5deg);
    }
    .card-content-box {
        padding: 20px;
    }
    .product-title {
        font-size: 15px;
        font-weight: 800;
        color: var(--dark-800);
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

@endsection

@push('scripts')
<script>
function deleteProduct(id, name) {
    document.getElementById('delete-name').textContent = name;
    document.getElementById('delete-form').action = `{{ url('admin/products') }}/${id}`;
    document.getElementById('delete-modal').style.display = 'flex';
}
function closeDeleteModal() {
    document.getElementById('delete-modal').style.display = 'none';
}
window.onclick = function(event) {
    if (event.target.id === 'delete-modal') closeDeleteModal();
}
</script>
@endpush
