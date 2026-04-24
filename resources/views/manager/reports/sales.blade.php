@extends('layouts.app')

@section('title', 'Laporan Penjualan')
@section('page-title')
    📈 <span>Laporan</span> Penjualan
@endsection

@section('content')

<div style="display:flex; flex-direction:column; gap:24px;">

    {{-- ── Filter Header ── --}}
    <div class="card" style="padding:24px; border-radius:20px; border:none; box-shadow:0 10px 30px rgba(0,0,0,0.05);">
        <form action="{{ route('manager.reports.sales') }}" method="GET" style="display:flex; align-items:flex-end; gap:20px; flex-wrap:wrap;">
            <div class="form-group" style="flex:1; min-width:200px;">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
            </div>
            <div class="form-group" style="flex:1; min-width:200px;">
                <label class="form-label">Tanggal Berakhir</label>
                <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
            </div>
            <button type="submit" class="btn btn-primary" style="width:auto; padding:0 30px; height:48px; border-radius:12px; font-weight:700;">
                🔍 Filter Laporan
            </button>
        </form>
    </div>

    {{-- ── Quick Stats ── --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:20px;">
        <div class="card" style="padding:24px; border-radius:20px; border:none; background:linear-gradient(135deg, #f97316, #ea580c); color:#fff;">
            <div style="font-size:13px; font-weight:600; opacity:0.8; margin-bottom:8px;">Total Pendapatan</div>
            <div style="font-size:24px; font-weight:800;">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div>
        </div>
        <div class="card" style="padding:24px; border-radius:20px; border:none; background:#fff; border:1px solid var(--gray-100);">
            <div style="font-size:13px; font-weight:600; color:var(--gray-400); margin-bottom:8px;">Total Transaksi</div>
            <div style="font-size:24px; font-weight:800; color:var(--dark-800);">{{ number_format($stats['total_transactions']) }}</div>
        </div>
        <div class="card" style="padding:24px; border-radius:20px; border:none; background:#fff; border:1px solid var(--gray-100);">
            <div style="font-size:13px; font-weight:600; color:var(--gray-400); margin-bottom:8px;">Rata-rata Transaksi</div>
            <div style="font-size:24px; font-weight:800; color:var(--dark-800);">Rp {{ number_format($stats['avg_transaction'], 0, ',', '.') }}</div>
        </div>
    </div>

    {{-- ── Transaction Table ── --}}
    <div class="card" style="border-radius:20px; border:none; box-shadow:0 10px 30px rgba(0,0,0,0.05); overflow:hidden;">
        <div style="padding:24px; border-bottom:1px solid var(--gray-50); display:flex; justify-content:space-between; align-items:center;">
            <h3 style="font-size:18px; font-weight:800; color:var(--dark-800);">Detail Transaksi</h3>
            <div style="font-size:13px; color:var(--gray-400);">Menampilkan {{ $transactions->count() }} dari {{ $transactions->total() }} data</div>
        </div>
        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background:var(--gray-50); text-align:left;">
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase;">Kode</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase;">Waktu</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase;">Member</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase;">Metode</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase; text-align:right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $tx)
                    <tr style="border-bottom:1px solid var(--gray-50); transition:background 0.2s;" onmouseover="this.style.background='var(--gray-50)'" onmouseout="this.style.background='transparent'">
                        <td style="padding:16px 24px;">
                            <span style="font-weight:700; color:var(--brand-600);">{{ $tx->transaction_code }}</span>
                        </td>
                        <td style="padding:16px 24px;">
                            <div style="font-size:13px; font-weight:600; color:var(--dark-700);">{{ $tx->created_at->format('d M Y') }}</div>
                            <div style="font-size:11px; color:var(--gray-400);">{{ $tx->created_at->format('H:i') }}</div>
                        </td>
                        <td style="padding:16px 24px;">
                            <div style="font-size:13px; font-weight:600; color:var(--dark-700);">{{ $tx->member->name ?? 'Non-Member' }}</div>
                            @if($tx->member) <div style="font-size:11px; color:var(--gray-400);">{{ $tx->member->member_code }}</div> @endif
                        </td>
                        <td style="padding:16px 24px;">
                            <span style="display:inline-block; padding:4px 10px; border-radius:8px; font-size:11px; font-weight:700; background:var(--gray-100); color:var(--gray-600); text-transform:uppercase;">
                                {{ $tx->payment_method }}
                            </span>
                        </td>
                        <td style="padding:16px 24px; text-align:right;">
                            <span style="font-weight:800; color:var(--dark-800);">Rp {{ number_format($tx->total_amount, 0, ',', '.') }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding:100px 24px; text-align:center; color:var(--gray-400);">Tidak ada data transaksi ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="padding:20px 24px; background:var(--gray-50);">
            {{ $transactions->links('partials.pagination') }}
        </div>
    </div>

</div>

@endsection
