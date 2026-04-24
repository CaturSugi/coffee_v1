@extends('layouts.app')

@section('title', 'Laporan Produk Terlaris')
@section('page-title')
    ☕ <span>Laporan</span> Produk
@endsection

@section('content')

<div style="display:flex; flex-direction:column; gap:28px;">

    {{-- ── Filter ── --}}
    <div class="card" style="padding:20px 24px; border:none; box-shadow:0 4px 20px rgba(0,0,0,0.05); border-radius:16px;">
        <form method="GET" action="{{ route('admin.reports.products') }}" style="display:flex; align-items:flex-end; gap:16px; flex-wrap:wrap;">
            <div style="flex:1; min-width:140px;">
                <label style="display:block; font-size:11px; font-weight:700; color:var(--gray-400); margin-bottom:8px; text-transform:uppercase;">Periode Awal</label>
                <input type="date" name="start_date" value="{{ $startDate }}" class="form-control" style="height:45px; border-radius:10px;">
            </div>
            <div style="flex:1; min-width:140px;">
                <label style="display:block; font-size:11px; font-weight:700; color:var(--gray-400); margin-bottom:8px; text-transform:uppercase;">Periode Akhir</label>
                <input type="date" name="end_date" value="{{ $endDate }}" class="form-control" style="height:45px; border-radius:10px;">
            </div>
            <button type="submit" class="btn btn-primary" style="height:45px; padding:0 24px; border-radius:10px; font-weight:700;">Filter Data</button>
        </form>
    </div>

    {{-- ── Product Table ── --}}
    <div class="card" style="border:none; box-shadow:0 4px 25px rgba(0,0,0,0.05); border-radius:20px; overflow:hidden;">
        <div style="padding:24px; border-bottom:1px solid var(--gray-50); background:#fff; display:flex; justify-content:space-between; align-items:center;">
            <h3 style="font-size:16px; font-weight:800; color:var(--dark-800);">Analisis Penjualan Produk</h3>
            <div style="font-size:13px; color:var(--gray-400);">Urut berdasarkan kuantitas terjual</div>
        </div>
        <div class="table-responsive">
            <table class="table" style="margin-bottom:0;">
                <thead style="background:var(--gray-50);">
                    <tr>
                        <th style="padding:16px 24px; color:var(--gray-400); font-size:11px; text-transform:uppercase; letter-spacing:1px;">Nama Produk</th>
                        <th style="padding:16px 24px; color:var(--gray-400); font-size:11px; text-transform:uppercase; letter-spacing:1px;">Kategori</th>
                        <th style="padding:16px 24px; color:var(--gray-400); font-size:11px; text-transform:uppercase; letter-spacing:1px; text-align:center;">Total Terjual</th>
                        <th style="padding:16px 24px; color:var(--gray-400); font-size:11px; text-transform:uppercase; letter-spacing:1px; text-align:right;">Total Pendapatan</th>
                        <th style="padding:16px 24px; color:var(--gray-400); font-size:11px; text-transform:uppercase; letter-spacing:1px; text-align:center;">Performa</th>
                    </tr>
                </thead>
                <tbody style="background:#fff;">
                    @foreach($products as $item)
                    <tr style="border-bottom:1px solid var(--gray-50);">
                        <td style="padding:16px 24px;">
                            <div style="font-weight:800; color:var(--dark-800); font-size:14px;">{{ $item->product->name ?? 'Deleted Product' }}</div>
                            <div style="font-size:11px; color:var(--gray-400);">SKU: {{ $item->product->sku ?? '-' }}</div>
                        </td>
                        <td style="padding:16px 24px;">
                            <span style="font-size:13px; color:var(--dark-600);">{{ $item->product->category->name ?? 'N/A' }}</span>
                        </td>
                        <td style="padding:16px 24px; text-align:center;">
                            <div style="font-weight:800; color:var(--brand-600); font-size:16px;">{{ number_format($item->total_qty, 0, ',', '.') }}</div>
                            <div style="font-size:10px; color:var(--gray-400); font-weight:700;">UNIT</div>
                        </td>
                        <td style="padding:16px 24px; text-align:right;">
                            <div style="font-weight:900; color:var(--dark-800); font-size:15px;">Rp {{ number_format($item->total_revenue, 0, ',', '.') }}</div>
                        </td>
                        <td style="padding:16px 24px;">
                            <div style="width:100px; height:8px; background:var(--gray-100); border-radius:4px; margin:0 auto; position:relative; overflow:hidden;">
                                <div style="position:absolute; left:0; top:0; height:100%; background:var(--brand-500); width:{{ min(100, ($item->total_qty / max(1, $products->first()->total_qty)) * 100) }}%;"></div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- ── Pagination ── --}}
    <div style="margin-top: 10px;">
        {{ $products->links('partials.pagination') }}
    </div>

</div>

@endsection
