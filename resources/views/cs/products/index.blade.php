@extends('layouts.app')

@section('title', 'Katalog Produk')
@section('page-title')
    ☕ <span>Katalog</span> Produk
@endsection

@section('content')
<div style="display:flex; flex-direction:column; gap:24px;">
    
    <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:15px;">
        <div>
            <h2 style="font-size:24px; font-weight:800; color:var(--dark-800); margin:0;">Cek Menu & Stok</h2>
            <p style="color:var(--gray-400); font-size:14px; margin-top:4px;">Informasi harga dan ketersediaan stok produk.</p>
        </div>
    </div>

    {{-- Filters --}}
    <div class="card" style="padding:20px; border-radius:15px; border:none; box-shadow:0 4px 15px rgba(0,0,0,0.02);">
        <form action="{{ route('cs.products.index') }}" method="GET" style="display:flex; gap:15px; flex-wrap:wrap;">
            <div style="flex:1; min-width:250px; position:relative;">
                <span style="position:absolute; left:15px; top:50%; transform:translateY(-50%); color:var(--gray-400);">🔍</span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk atau SKU..." 
                    class="form-control" style="padding-left:42px; height:45px; border-radius:10px;">
            </div>
            <div style="width:200px;">
                <select name="category" class="form-select" style="height:45px; border-radius:10px;" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-dark" style="padding:0 25px; border-radius:10px;">Filter</button>
            @if(request('search') || request('category'))
                <a href="{{ route('cs.products.index') }}" class="btn btn-light" style="display:flex; align-items:center; padding:0 15px; border-radius:10px; border:1px solid var(--gray-200);">✕ Reset</a>
            @endif
        </form>
    </div>

    {{-- Products Grid --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:20px;">
        @forelse($products as $p)
        <div class="card" style="border-radius:20px; border:none; box-shadow:0 10px 30px rgba(0,0,0,0.05); overflow:hidden; background:#fff; transition:transform 0.2s; cursor:pointer;" onclick="window.location='{{ route('cs.products.show', $p) }}'">
            <div style="position:relative; height:180px; background:var(--gray-100); overflow:hidden;">
                @if($p->image)
                    <img src="{{ asset('storage/'.$p->image) }}" style="width:100%; height:100%; object-fit:cover;">
                @else
                    <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-size:48px;">☕</div>
                @endif
                
                @if($p->stock <= $p->min_stock)
                    <div style="position:absolute; top:12px; right:12px; background:#ef4444; color:#fff; font-size:10px; font-weight:800; padding:4px 10px; border-radius:99px; text-transform:uppercase;">Stok Menipis</div>
                @endif
            </div>
            <div style="padding:20px;">
                <div style="font-size:12px; font-weight:700; color:var(--brand-600); text-transform:uppercase; margin-bottom:5px;">{{ $p->category->name ?? 'Uncategorized' }}</div>
                <h3 style="font-size:18px; font-weight:800; color:var(--dark-800); margin-bottom:10px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $p->name }}</h3>
                
                <div style="display:flex; justify-content:space-between; align-items:center; margin-top:15px; padding-top:15px; border-top:1px solid var(--gray-50);">
                    <div>
                        <div style="font-size:12px; color:var(--gray-400); font-weight:600;">Harga</div>
                        <div style="font-size:18px; font-weight:800; color:var(--dark-800);">Rp {{ number_format($p->sell_price, 0, ',', '.') }}</div>
                    </div>
                    <div style="text-align:right;">
                        <div style="font-size:12px; color:var(--gray-400); font-weight:600;">Tersedia</div>
                        <div style="font-size:18px; font-weight:800; color:{{ $p->stock <= $p->min_stock ? '#ef4444' : '#22c55e' }};">{{ $p->stock }}</div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div style="grid-column:1/-1; padding:100px 0; text-align:center; color:var(--gray-400);">
            <div style="font-size:64px; margin-bottom:20px;">🏜️</div>
            <p>Produk tidak ditemukan</p>
        </div>
        @endforelse
    </div>

    @if($products->hasPages())
    <div style="margin-top:20px;">
        {{ $products->links('partials.pagination') }}
    </div>
    @endif

</div>
@endsection
