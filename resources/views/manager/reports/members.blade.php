@extends('layouts.app')

@section('title', 'Laporan Loyalitas Member')
@section('page-title')
    👥 <span>Laporan</span> Member
@endsection

@section('content')

<div style="display:flex; flex-direction:column; gap:24px;">

    <div style="display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:20px;">
        <div>
            <h2 style="font-size:24px; font-weight:800; color:var(--dark-800); margin-bottom:4px;">Loyalitas Member</h2>
            <p style="color:var(--gray-400); font-size:14px; font-weight:500;">Identifikasi pelanggan paling setia dan potensial Anda.</p>
        </div>
    </div>

    <div class="card" style="border-radius:20px; border:none; box-shadow:0 10px 30px rgba(0,0,0,0.05); overflow:hidden;">
        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background:var(--gray-50); text-align:left;">
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase;">Member</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase;">Kontak</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase; text-align:center;">Total Kunjungan</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase; text-align:center;">Poin</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase; text-align:right;">Total Belanja</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                    <tr style="border-bottom:1px solid var(--gray-50); transition:background 0.2s;" onmouseover="this.style.background='var(--gray-50)'" onmouseout="this.style.background='transparent'">
                        <td style="padding:16px 24px;">
                            <div style="display:flex; align-items:center; gap:12px;">
                                <div style="width:40px; height:40px; border-radius:50%; background:var(--brand-50); color:var(--brand-600); display:flex; align-items:center; justify-content:center; font-weight:800; font-size:16px; flex-shrink:0;">
                                    {{ strtoupper(substr($member->user->name ?? 'M', 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-weight:700; color:var(--dark-800);">{{ $member->user->name ?? 'Unknown' }}</div>
                                    <div style="font-size:11px; color:var(--gray-400); font-family:'JetBrains Mono', monospace;">{{ $member->member_code }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="padding:16px 24px;">
                            <div style="font-size:13px; color:var(--dark-700);">{{ $member->member_phone ?? '-' }}</div>
                            <div style="font-size:11px; color:var(--gray-400);">{{ $member->member_email ?? '-' }}</div>
                        </td>
                        <td style="padding:16px 24px; text-align:center;">
                            <span style="font-size:13px; font-weight:700; color:var(--dark-700);">{{ $member->transactions_count }}x</span>
                        </td>
                        <td style="padding:16px 24px; text-align:center;">
                            <span style="display:inline-block; padding:4px 10px; border-radius:8px; font-size:11px; font-weight:700; background:#fef3c7; color:#92400e;">
                                ⭐ {{ number_format($member->points_balance) }}
                            </span>
                        </td>
                        <td style="padding:16px 24px; text-align:right;">
                            <span style="font-weight:800; color:var(--brand-600);">Rp {{ number_format($member->transactions_sum_total_amount ?? 0, 0, ',', '.') }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="padding:20px 24px; background:var(--gray-50);">
            {{ $members->links('partials.pagination') }}
        </div>
    </div>

</div>

@endsection
