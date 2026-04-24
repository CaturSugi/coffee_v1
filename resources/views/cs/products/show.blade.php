@extends('layouts.app')

@section('title', 'Detail Produk')
@section('page-title')
    ☕ <span>Detail</span> Produk
@endsection

@section('content')
<div style="max-width:900px; margin:0 auto;">
    
    <div style="margin-bottom:24px;">
        <a href="{{ route('cs.products.index') }}" style="color:var(--gray-400); text-decoration:none; font-size:14px; font-weight:600; display:flex; align-items:center; gap:8px;">
            ← Kembali ke Katalog
        </a>
    </div>

    <div class="card" style="border-radius:24px; border:none; box-shadow:0 10px 40px rgba(0,0,0,0.05); background:#fff; overflow:hidden; display:flex; flex-direction:row; min-height:400px;">
        {{-- Product Image --}}
        <div style="width:40%; background:var(--gray-50); border-right:1px solid var(--gray-50);">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" style="width:100%; height:100%; object-fit:cover;">
            @else
                <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-size:120px;">☕</div>
            @endif
        </div>

        {{-- Product Details --}}
        <div style="width:60%; padding:40px; display:flex; flex-direction:column;">
            <div style="flex:1;">
                <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                    <div>
                        <div style="font-size:13px; font-weight:700; color:var(--brand-600); text-transform:uppercase; letter-spacing:1px; margin-bottom:8px;">{{ $product->category->name ?? 'Uncategorized' }}</div>
                        <h2 style="font-size:32px; font-weight:900; color:var(--dark-800); margin-bottom:15px;">{{ $product->name }}</h2>
                    </div>
                    <div style="text-align:right;">
                        <div style="font-size:12px; color:var(--gray-400); font-weight:700; text-transform:uppercase;">SKU</div>
                        <div style="font-size:14px; font-weight:800; color:var(--dark-800);">{{ $p->sku ?? 'BRN-'.str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</div>
                    </div>
                </div>

                <div style="margin:25px 0; padding:20px; border-radius:15px; background:var(--gray-50); display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                    <div>
                        <div style="font-size:13px; color:var(--gray-400); font-weight:600; margin-bottom:5px;">Harga Jual</div>
                        <div style="font-size:24px; font-weight:900; color:var(--brand-600);">Rp {{ number_format($product->sell_price, 0, ',', '.') }}</div>
                    </div>
                    <div style="text-align:right;">
                        <div style="font-size:13px; color:var(--gray-400); font-weight:600; margin-bottom:5px;">Stok Tersedia</div>
                        <div style="font-size:24px; font-weight:900; color:{{ $product->stock <= $product->min_stock ? '#ef4444' : '#22c55e' }};">{{ $product->stock }} {{ $product->unit ?? 'Pcs' }}</div>
                    </div>
                </div>

                <div style="margin-bottom:30px;">
                    <div style="font-size:14px; font-weight:700; color:var(--dark-700); margin-bottom:10px;">Deskripsi Produk</div>
                    <p style="color:var(--gray-500); line-height:1.6; font-size:14px;">{{ $product->description ?? 'Tidak ada deskripsi untuk produk ini.' }}</p>
                </div>
            </div>

            <div style="display:flex; gap:15px;">
                <a href="{{ route('pos.index') }}" class="btn btn-primary" style="flex:1; height:50px; border-radius:12px; font-weight:700; display:flex; align-items:center; justify-content:center; text-decoration:none; box-shadow:0 10px 20px rgba(249,115,22,0.2);">
                    🛒 Tambahkan ke Kasir
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
