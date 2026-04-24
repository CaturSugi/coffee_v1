@extends('layouts.app')

@section('title', 'Laporan Loyalitas Member')
@section('page-title')
    👥 <span>Laporan</span> Member
@endsection

@section('content')

<div style="display:flex; flex-direction:column; gap:28px;">

    {{-- ── Filter ── --}}
    <div class="card" style="padding:20px 24px; border:none; box-shadow:0 4px 20px rgba(0,0,0,0.05); border-radius:16px;">
        <form method="GET" action="{{ route('admin.reports.members') }}" style="display:flex; align-items:flex-end; gap:16px; flex-wrap:wrap;">
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

    {{-- ── Member Table ── --}}
    <div class="card" style="border:none; box-shadow:0 4px 25px rgba(0,0,0,0.05); border-radius:20px; overflow:hidden;">
        <div style="padding:24px; border-bottom:1px solid var(--gray-50); background:#fff; display:flex; justify-content:space-between; align-items:center;">
            <h3 style="font-size:16px; font-weight:800; color:var(--dark-800);">Peringkat Loyalitas Member</h3>
            <div style="font-size:13px; color:var(--gray-400);">Berdasarkan total kontribusi belanja</div>
        </div>
        <div class="table-responsive">
            <table class="table" style="margin-bottom:0;">
                <thead style="background:var(--gray-50);">
                    <tr>
                        <th style="padding:16px 24px; color:var(--gray-400); font-size:11px; text-transform:uppercase; letter-spacing:1px;">Member</th>
                        <th style="padding:16px 24px; color:var(--gray-400); font-size:11px; text-transform:uppercase; letter-spacing:1px; text-align:center;">Jml Transaksi</th>
                        <th style="padding:16px 24px; color:var(--gray-400); font-size:11px; text-transform:uppercase; letter-spacing:1px; text-align:right;">Total Kontribusi</th>
                        <th style="padding:16px 24px; color:var(--gray-400); font-size:11px; text-transform:uppercase; letter-spacing:1px; text-align:right;">Poin Terkumpul</th>
                        <th style="padding:16px 24px; color:var(--gray-400); font-size:11px; text-transform:uppercase; letter-spacing:1px; text-align:center;">Tier</th>
                    </tr>
                </thead>
                <tbody style="background:#fff;">
                    @foreach($members as $m)
                    <tr style="border-bottom:1px solid var(--gray-50);">
                        <td style="padding:16px 24px;">
                            <div style="display:flex; align-items:center; gap:12px;">
                                <div style="width:36px; height:36px; border-radius:10px; background:var(--brand-500); color:#fff; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:12px;">
                                    {{ strtoupper(substr($m->user->name ?? '?', 0, 2)) }}
                                </div>
                                <div>
                                    <div style="font-weight:800; color:var(--dark-800); font-size:14px;">{{ $m->user->name ?? 'N/A' }}</div>
                                    <div style="font-size:11px; color:var(--gray-400);">{{ $m->member_code }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="padding:16px 24px; text-align:center;">
                            <div style="font-weight:800; color:var(--dark-700); font-size:15px;">{{ number_format($m->transactions_count, 0, ',', '.') }}</div>
                            <div style="font-size:10px; color:var(--gray-400); font-weight:700;">TRANSAKSI</div>
                        </td>
                        <td style="padding:16px 24px; text-align:right;">
                            <div style="font-weight:900; color:var(--brand-600); font-size:15px;">Rp {{ number_format($m->transactions_sum_total_amount ?? 0, 0, ',', '.') }}</div>
                        </td>
                        <td style="padding:16px 24px; text-align:right;">
                            <div style="font-weight:700; color:var(--dark-700); font-size:14px;">{{ number_format($m->points_balance, 0, ',', '.') }}</div>
                            <div style="font-size:10px; color:var(--gray-400); font-weight:700;">PTS</div>
                        </td>
                        <td style="padding:16px 24px; text-align:center;">
                            @php
                                $tier = strtolower($m->member_tier);
                                $colors = [
                                    'platinum' => ['bg' => '#eff6ff', 'text' => '#1e40af'],
                                    'gold' => ['bg' => '#fffbeb', 'text' => '#92400e'],
                                    'silver' => ['bg' => '#f3f4f6', 'text' => '#374151'],
                                    'bronze' => ['bg' => '#fff7ed', 'text' => '#9a3412'],
                                ];
                                $c = $colors[$tier] ?? $colors['bronze'];
                            @endphp
                            <span style="padding:4px 10px; border-radius:8px; font-size:10px; font-weight:800; background:{{ $c['bg'] }}; color:{{ $c['text'] }}; text-transform:uppercase;">{{ $m->member_tier }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- ── Pagination ── --}}
    <div style="margin-top: 10px;">
        {{ $members->links('partials.pagination') }}
    </div>

</div>

@endsection
