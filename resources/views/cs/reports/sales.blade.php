@extends('layouts.app')

@section('title', 'Laporan Penjualan Saya')
@section('page-title')
    📊 <span>Laporan</span> Penjualan Saya
@endsection

@section('content')
<div style="display:flex; flex-direction:column; gap:24px;">
    
    <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:15px;">
        <div>
            <h2 style="font-size:24px; font-weight:800; color:var(--dark-800); margin:0;">Rekap Penjualan</h2>
            <p style="color:var(--gray-400); font-size:14px; margin-top:4px;">Pantau performa transaksi Anda sendiri.</p>
        </div>
    </div>

    {{-- Filter Bar --}}
    <div class="card" style="padding:20px; border-radius:15px; border:none; box-shadow:0 4px 15px rgba(0,0,0,0.02); background:#fff;">
        <form action="{{ route('cs.reports.sales') }}" method="GET" style="display:flex; gap:15px; align-items:flex-end; flex-wrap:wrap;">
            <div style="flex:1; min-width:200px;">
                <label class="form-label" style="font-size:12px; font-weight:700; color:var(--gray-400); text-transform:uppercase; margin-bottom:8px; display:block;">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ $startDate }}" class="form-control" style="height:45px; border-radius:10px;">
            </div>
            <div style="flex:1; min-width:200px;">
                <label class="form-label" style="font-size:12px; font-weight:700; color:var(--gray-400); text-transform:uppercase; margin-bottom:8px; display:block;">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ $endDate }}" class="form-control" style="height:45px; border-radius:10px;">
            </div>
            <button type="submit" class="btn btn-dark" style="height:45px; padding:0 30px; border-radius:10px; font-weight:700;">Tampilkan Laporan</button>
        </form>
    </div>

    {{-- Stats Cards --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:20px;">
        <div class="card" style="padding:24px; border-radius:20px; border:none; box-shadow:0 10px 30px rgba(0,0,0,0.05); background:#fff; position:relative; overflow:hidden;">
            <div style="font-size:13px; font-weight:700; color:var(--gray-400); text-transform:uppercase; margin-bottom:10px;">Total Pendapatan</div>
            <div style="font-size:28px; font-weight:900; color:var(--brand-600);">Rp {{ number_format($stats['total_sales'], 0, ',', '.') }}</div>
            <div style="position:absolute; right:20px; bottom:15px; font-size:48px; opacity:0.05;">💰</div>
        </div>

        <div class="card" style="padding:24px; border-radius:20px; border:none; box-shadow:0 10px 30px rgba(0,0,0,0.05); background:#fff; position:relative; overflow:hidden;">
            <div style="font-size:13px; font-weight:700; color:var(--gray-400); text-transform:uppercase; margin-bottom:10px;">Jumlah Transaksi</div>
            <div style="font-size:28px; font-weight:900; color:var(--dark-800);">{{ number_format($stats['transaction_count']) }}</div>
            <div style="position:absolute; right:20px; bottom:15px; font-size:48px; opacity:0.05;">🧾</div>
        </div>

        <div class="card" style="padding:24px; border-radius:20px; border:none; box-shadow:0 10px 30px rgba(0,0,0,0.05); background:#fff; position:relative; overflow:hidden;">
            <div style="font-size:13px; font-weight:700; color:var(--gray-400); text-transform:uppercase; margin-bottom:10px;">Rata-rata Transaksi</div>
            <div style="font-size:28px; font-weight:900; color:var(--dark-800);">Rp {{ number_format($stats['avg_sale'], 0, ',', '.') }}</div>
            <div style="position:absolute; right:20px; bottom:15px; font-size:48px; opacity:0.05;">📈</div>
        </div>
    </div>

    {{-- Transaction Table --}}
    <div class="card" style="border-radius:20px; border:none; box-shadow:0 10px 30px rgba(0,0,0,0.05); overflow:hidden; background:#fff;">
        <div style="padding:20px 24px; border-bottom:1px solid var(--gray-50);">
            <h3 style="font-size:18px; font-weight:800; color:var(--dark-800); margin:0;">Detail Transaksi</h3>
        </div>
        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background:var(--gray-50); text-align:left;">
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase;">Waktu</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase;">Kode TRX</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase;">Member</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase; text-align:right;">Total Tagihan</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase; text-align:center;">Metode</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase; text-align:center;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $tx)
                    <tr style="border-bottom:1px solid var(--gray-50); transition:background 0.2s;" onmouseover="this.style.background='var(--gray-50)'" onmouseout="this.style.background='transparent'">
                        <td style="padding:16px 24px; font-size:13px; color:var(--gray-500);">
                            {{ $tx->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td style="padding:16px 24px;">
                            <span style="font-weight:700; color:var(--brand-600);">{{ $tx->transaction_code }}</span>
                        </td>
                        <td style="padding:16px 24px;">
                            <div style="font-size:13px; font-weight:600; color:var(--dark-700);">{{ $tx->member->member_name ?? 'Non-Member' }}</div>
                        </td>
                        <td style="padding:16px 24px; text-align:right;">
                            <span style="font-weight:800; color:var(--dark-800);">Rp {{ number_format($tx->total_amount, 0, ',', '.') }}</span>
                        </td>
                        <td style="padding:16px 24px; text-align:center;">
                            <span style="font-size:12px; font-weight:600; color:var(--gray-500); text-transform:uppercase;">{{ $tx->payment_method }}</span>
                        </td>
                        <td style="padding:16px 24px; text-align:center;">
                            @if($tx->payment_status == 'completed')
                                <span style="display:inline-block; padding:4px 12px; border-radius:99px; font-size:11px; font-weight:700; background:#dcfce7; color:#166534;">Lunas</span>
                            @else
                                <span style="display:inline-block; padding:4px 12px; border-radius:99px; font-size:11px; font-weight:700; background:#fee2e2; color:#991b1b;">{{ ucfirst($tx->payment_status) }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding:60px 24px; text-align:center; color:var(--gray-400);">Tidak ada transaksi pada periode ini</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($transactions->hasPages())
        <div style="padding:20px 24px; background:var(--gray-50);">
            {{ $transactions->links('partials.pagination') }}
        </div>
        @endif
    </div>

</div>
@endsection
