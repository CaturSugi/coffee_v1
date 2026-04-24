@extends('layouts.app')

@section('title', 'Manajemen Member')
@section('page-title')
    👥 <span>Manajemen</span> Member
@endsection

@section('content')
<div style="display:flex; flex-direction:column; gap:24px;">
    
    <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:15px;">
        <div>
            <h2 style="font-size:24px; font-weight:800; color:var(--dark-800); margin:0;">Daftar Pelanggan</h2>
            <p style="color:var(--gray-400); font-size:14px; margin-top:4px;">Kelola data member dan program loyalitas.</p>
        </div>
        <a href="{{ route('cs.members.create') }}" class="btn btn-primary" style="display:flex; align-items:center; gap:8px; padding:12px 24px; border-radius:12px;">
            <span style="font-size:18px;">+</span> Member Baru
        </a>
    </div>

    {{-- Search Bar --}}
    <div class="card" style="padding:15px; border-radius:15px; border:none; box-shadow:0 4px 15px rgba(0,0,0,0.02);">
        <form action="{{ route('cs.members.index') }}" method="GET" style="display:flex; gap:12px;">
            <div style="flex:1; position:relative;">
                <span style="position:absolute; left:15px; top:50%; transform:translateY(-50%); color:var(--gray-400);">🔍</span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, kode, atau nomor telepon..." 
                    class="form-control" style="padding-left:42px; height:45px; border-radius:10px;">
            </div>
            <button type="submit" class="btn btn-dark" style="padding:0 25px; border-radius:10px;">Cari</button>
            @if(request('search'))
                <a href="{{ route('cs.members.index') }}" class="btn btn-light" style="display:flex; align-items:center; padding:0 15px; border-radius:10px; border:1px solid var(--gray-200);">✕</a>
            @endif
        </form>
    </div>

    {{-- Table --}}
    <div class="card" style="border-radius:20px; border:none; box-shadow:0 10px 30px rgba(0,0,0,0.05); overflow:hidden; background:#fff;">
        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background:var(--gray-50); text-align:left;">
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase;">Member</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase;">Kontak</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase; text-align:center;">Tier</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase; text-align:center;">Poin</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase; text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $m)
                    <tr style="border-bottom:1px solid var(--gray-50); transition:background 0.2s;" onmouseover="this.style.background='var(--gray-50)'" onmouseout="this.style.background='transparent'">
                        <td style="padding:16px 24px;">
                            <div style="display:flex; align-items:center; gap:12px;">
                                <div style="width:40px; height:40px; border-radius:50%; background:var(--brand-50); color:var(--brand-600); display:flex; align-items:center; justify-content:center; font-weight:800; font-size:16px;">
                                    {{ substr($m->member_name, 0, 1) }}
                                </div>
                                <div>
                                    <div style="font-weight:700; color:var(--dark-800);">{{ $m->member_name }}</div>
                                    <div style="font-size:12px; color:var(--gray-400); font-weight:600;">{{ $m->member_code }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="padding:16px 24px;">
                            <div style="font-size:13px; font-weight:600; color:var(--dark-700);">{{ $m->member_phone }}</div>
                            <div style="font-size:12px; color:var(--gray-400); overflow:hidden; text-overflow:ellipsis; white-space:nowrap; max-width:150px;">{{ $m->member_address ?? '-' }}</div>
                        </td>
                        <td style="padding:16px 24px; text-align:center;">
                            @php
                                $badgeColor = match($m->member_tier) {
                                    'gold' => ['bg' => '#fef9c3', 'text' => '#854d0e'],
                                    'silver' => ['bg' => '#f3f4f6', 'text' => '#374151'],
                                    default => ['bg' => '#ffedd5', 'text' => '#9a3412'],
                                };
                            @endphp
                            <span style="display:inline-block; padding:4px 12px; border-radius:99px; font-size:11px; font-weight:800; text-transform:uppercase; background:{{ $badgeColor['bg'] }}; color:{{ $badgeColor['text'] }};">
                                {{ $m->member_tier }}
                            </span>
                        </td>
                        <td style="padding:16px 24px; text-align:center;">
                            <span style="font-weight:800; color:var(--brand-600);">{{ number_format($m->points_balance) }}</span>
                        </td>
                        <td style="padding:16px 24px; text-align:right;">
                            <a href="{{ route('cs.members.edit', $m) }}" class="btn btn-sm btn-light" style="padding:8px 12px; border-radius:8px; border:1px solid var(--gray-200); color:var(--gray-600); font-size:12px; font-weight:700; text-decoration:none;">Edit</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding:60px 24px; text-align:center; color:var(--gray-400);">Tidak ada data member ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($members->hasPages())
        <div style="padding:20px 24px; background:var(--gray-50);">
            {{ $members->links('partials.pagination') }}
        </div>
        @endif
    </div>

</div>
@endsection
