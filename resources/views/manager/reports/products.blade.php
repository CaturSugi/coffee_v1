@extends('layouts.app')

@section('title', 'Laporan Performa Produk')
@section('page-title')
    ☕ <span>Laporan</span> Produk
@endsection

@section('content')

<div style="display:flex; flex-direction:column; gap:24px;">

    <div style="display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:20px;">
        <div>
            <h2 style="font-size:24px; font-weight:800; color:var(--dark-800); margin-bottom:4px;">Performa Menu</h2>
            <p style="color:var(--gray-400); font-size:14px; font-weight:500;">Pantau menu mana yang paling disukai pelanggan Anda.</p>
        </div>
    </div>

    <div class="card" style="border-radius:20px; border:none; box-shadow:0 10px 30px rgba(0,0,0,0.05); overflow:hidden;">
        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background:var(--gray-50); text-align:left;">
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase;">Produk</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase;">Kategori</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase; text-align:center;">Stok</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase; text-align:center;">Terjual</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase; text-align:right;">Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr style="border-bottom:1px solid var(--gray-50); transition:background 0.2s;" onmouseover="this.style.background='var(--gray-50)'" onmouseout="this.style.background='transparent'">
                        <td style="padding:16px 24px;">
                            <div style="display:flex; align-items:center; gap:12px;">
                                <div style="width:40px; height:40px; border-radius:10px; background:var(--gray-100); overflow:hidden; flex-shrink:0;">
                                    @if($product->image)
                                        <img src="{{ asset('storage/'.$product->image) }}" style="width:100%; height:100%; object-fit:cover;">
                                    @else
                                        <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-size:18px;">☕</div>
                                    @endif
                                </div>
                                <div style="font-weight:700; color:var(--dark-800);">{{ $product->name }}</div>
                            </div>
                        </td>
                        <td style="padding:16px 24px;">
                            <span style="font-size:13px; color:var(--gray-500);">{{ $product->category->name ?? '-' }}</span>
                        </td>
                        <td style="padding:16px 24px; text-align:center;">
                            <span style="font-size:13px; font-weight:700; color:{{ $product->stock <= $product->min_stock ? '#ef4444' : 'var(--dark-700)' }};">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td style="padding:16px 24px; text-align:center;">
                            <span style="font-size:13px; font-weight:700; color:var(--dark-700);">{{ number_format($product->total_sold) }}</span>
                        </td>
                        <td style="padding:16px 24px; text-align:right;">
                            <span style="font-weight:800; color:var(--brand-600);">Rp {{ number_format($product->total_revenue, 0, ',', '.') }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="padding:20px 24px; background:var(--gray-50);">
            {{ $products->links('partials.pagination') }}
        </div>
    </div>

</div>

@endsection
