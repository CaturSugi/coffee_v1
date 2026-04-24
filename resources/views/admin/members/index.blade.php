@extends('layouts.app')

@section('title', 'Manajemen Member')
@section('page-title')
    👥 <span>Manajemen</span> Member
@endsection

@section('content')

<div style="display:flex; flex-direction:column; gap:24px;">

    {{-- ── Header & Stats ── --}}
    <div style="display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:20px;">
        <div>
            <h2 style="font-size:24px; font-weight:800; color:var(--dark-800); margin-bottom:4px;">Loyalty Members</h2>
            <p style="color:var(--gray-400); font-size:14px; font-weight:500;">Kelola program loyalitas dan database pelanggan tetap Anda.</p>
        </div>
        <a href="{{ route('admin.members.create') }}" class="btn btn-primary" style="width:auto; padding:0 24px; height:48px; border-radius:12px; font-weight:700; box-shadow:0 8px 15px rgba(234, 88, 12, 0.2);">
            ＋ Tambah Member Baru
        </a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
        <div class="card" style="padding: 24px; border:none; border-left: 5px solid var(--brand-500); display: flex; align-items: center; gap: 18px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <div style="width: 52px; height: 52px; border-radius: 14px; background: var(--brand-50); color: var(--brand-600); display: flex; align-items: center; justify-content: center; font-size: 24px;">👥</div>
            <div>
                <div style="font-size: 11px; color: var(--gray-400); font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2px;">Total Member</div>
                <div style="font-size: 22px; font-weight: 900; color: var(--dark-800);">{{ $members->total() }}</div>
            </div>
        </div>
        <div class="card" style="padding: 24px; border:none; border-left: 5px solid #10b981; display: flex; align-items: center; gap: 18px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <div style="width: 52px; height: 52px; border-radius: 14px; background: #ecfdf5; color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 24px;">💎</div>
            <div>
                <div style="font-size: 11px; color: var(--gray-400); font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2px;">Platinum Tier</div>
                <div style="font-size: 22px; font-weight: 900; color: var(--dark-800);">{{ $members->where('member_tier', 'Platinum')->count() }}</div>
            </div>
        </div>
        <div class="card" style="padding: 24px; border:none; border-left: 5px solid #3b82f6; display: flex; align-items: center; gap: 18px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <div style="width: 52px; height: 52px; border-radius: 14px; background: #eff6ff; color: #3b82f6; display: flex; align-items: center; justify-content: center; font-size: 24px;">✨</div>
            <div>
                <div style="font-size: 11px; color: var(--gray-400); font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2px;">Total Poin</div>
                <div style="font-size: 22px; font-weight: 900; color: var(--dark-800);">{{ number_format($members->sum('points_balance'), 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    {{-- ── Filter Bar ── --}}
    <div class="card" style="padding: 24px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.05); border-radius:16px;">
        <form method="GET" action="{{ route('admin.members.index') }}" style="display: flex; flex-wrap: wrap; gap: 16px; align-items: flex-end;">
            <div style="flex: 2; min-width: 200px;">
                <label style="display: block; font-size: 11px; font-weight: 700; color: var(--gray-400); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Cari Member</label>
                <div style="position: relative;">
                    <span style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--gray-400);">🔍</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama, Email, atau No. HP..." style="width:100%; padding-left: 40px; border-radius: 10px; border: 1px solid var(--gray-200); height: 45px; font-size: 14px; outline:none; transition:border-color 0.2s;">
                </div>
            </div>
            <div style="flex: 1; min-width: 150px;">
                <label style="display: block; font-size: 11px; font-weight: 700; color: var(--gray-400); margin-bottom: 8px; text-transform: uppercase;">Tier Member</label>
                <select name="tier" class="form-select" style="border-radius: 10px; border: 1px solid var(--gray-200); height: 45px;">
                    <option value="">Semua Tier</option>
                    <option value="Platinum" {{ request('tier') == 'Platinum' ? 'selected' : '' }}>💎 Platinum</option>
                    <option value="Gold" {{ request('tier') == 'Gold' ? 'selected' : '' }}>🥇 Gold</option>
                    <option value="Silver" {{ request('tier') == 'Silver' ? 'selected' : '' }}>🥈 Silver</option>
                    <option value="Bronze" {{ request('tier') == 'Bronze' ? 'selected' : '' }}>🥉 Bronze</option>
                </select>
            </div>
            @if(auth()->user()->isAdmin())
            <div style="display:flex; align-items:center; gap:8px; margin-left:10px;">
                <input type="checkbox" name="show_trashed" id="show_trashed" value="1" {{ request('show_trashed') ? 'checked' : '' }} onchange="this.form.submit()" style="width:18px; height:18px; cursor:pointer;">
                <label for="show_trashed" style="font-size:12px; font-weight:700; color:var(--gray-500); cursor:pointer;">Tampilkan Data Terhapus</label>
            </div>
            @endif
            <div style="display: flex; gap: 8px; margin-left:auto;">
                <button type="submit" class="btn btn-primary" style="height: 45px; padding: 0 24px; border-radius: 10px; font-weight: 700;">Filter</button>
                @if(request()->hasAny(['search','tier','show_trashed']))
                    <a href="{{ route('admin.members.index') }}" class="btn" style="height: 45px; width: 45px; padding: 0; display: flex; align-items: center; justify-content: center; background: var(--gray-100); color: var(--gray-600); border-radius: 10px;" title="Reset">🔄</a>
                @endif
            </div>
        </form>
    </div>

    {{-- ── Member Grid ── --}}
    @if($members->isEmpty())
        <div class="card" style="padding:100px 24px; text-align:center; border:none; box-shadow:0 4px 20px rgba(0,0,0,0.05); border-radius:20px;">
            <div style="font-size:72px; margin-bottom:24px; opacity: 0.3;">👥</div>
            <h3 style="font-size:22px; font-weight:800; color:var(--dark-800); margin-bottom:12px;">Member Tidak Ditemukan</h3>
            <p style="color:var(--gray-400); margin-bottom:30px; max-width:400px; margin-inline:auto; font-size:15px;">Belum ada member yang terdaftar atau kriteria pencarian Anda tidak cocok.</p>
            <a href="{{ route('admin.members.index') }}" class="btn" style="width:auto; padding:12px 30px; background:var(--gray-100); color:var(--dark-700); border-radius:12px; font-weight:700;">Lihat Semua Member</a>
        </div>
    @else
        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(300px, 1fr)); gap:24px; margin-bottom:24px;">
            @foreach($members as $member)
            <div class="member-card">
                <div class="member-card-header">
                    <div class="member-avatar">
                        {{ strtoupper(substr($member->user->name ?? '?', 0, 2)) }}
                    </div>
                    <div class="member-info">
                        <h3 class="member-name">{{ $member->user->name ?? 'N/A' }}</h3>
                        <div class="member-id">{{ $member->member_code }}</div>
                    </div>
                    <div class="member-tier-badge {{ strtolower($member->member_tier) }}">
                        {{ $member->member_tier }}
                    </div>
                    @if($member->trashed())
                    <div style="position: absolute; top: 12px; left: 12px; padding: 2px 8px; background: var(--danger); color: #fff; border-radius: 6px; font-size: 10px; font-weight: 800; text-transform: uppercase; z-index: 5;">
                        TERHAPUS
                    </div>
                    @endif
                </div>

                <div class="member-card-body">
                    <div class="member-stat-row">
                        <div class="stat-item">
                            <span class="label">Total Spent</span>
                            <span class="value">Rp {{ number_format($member->total_spent, 0, ',', '.') }}</span>
                        </div>
                        <div class="stat-item" style="text-align: right;">
                            <span class="label">Points</span>
                            <span class="value" style="color: var(--brand-600);">{{ number_format($member->points_balance, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <div class="member-contact-info">
                        <div class="contact-item">
                            <span class="icon">📱</span> {{ $member->member_phone }}
                        </div>
                        <div class="contact-item">
                            <span class="icon">📧</span> {{ $member->member_email }}
                        </div>
                    </div>
                </div>

                <div class="member-card-footer">
                    @if($member->trashed())
                        @if(auth()->user()->isAdmin())
                        <form action="{{ route('admin.members.restore', $member->id) }}" method="POST" style="flex:1;">
                            @csrf
                            <button type="submit" class="member-action-btn edit" style="width:100%; background:var(--success); color:#fff; border:none;">Pulihkan</button>
                        </form>
                        @endif
                    @else
                        <a href="{{ route('admin.members.edit', $member) }}" class="member-action-btn edit">Edit</a>
                        <button onclick="deleteMember({{ $member->id }}, '{{ addslashes($member->user->name) }}')" class="member-action-btn delete">Hapus</button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{-- ── Pagination ── --}}
        <div style="margin-top: 10px;">
            {{ $members->links('partials.pagination') }}
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
            <h4 style="font-size:18px; font-weight:800; color:var(--dark-800); margin-bottom:8px;">{{ auth()->user()->isAdmin() ? 'Hapus Permanen?' : 'Hapus Member?' }}</h4>
            <p style="font-size:14px; color:var(--gray-500); margin-bottom:24px; line-height:1.5;">
                Apakah Anda yakin ingin menghapus <strong id="delete-name" style="color:var(--dark-800);"></strong>? 
                @if(auth()->user()->isAdmin())
                    Tindakan ini akan <strong>menghapus data secara permanen</strong> dan tidak dapat dibatalkan.
                @else
                    Data member akan <strong>disembunyikan</strong> dari daftar aktif.
                @endif
            </p>
            <form id="delete-form" method="POST">
                @csrf @method('DELETE')
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <button type="button" onclick="closeDeleteModal()" class="btn-cancel-custom">Batal</button>
                    <button type="submit" class="btn-delete-custom">{{ auth()->user()->isAdmin() ? 'Ya, Hapus Permanen' : 'Ya, Hapus' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .member-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid var(--gray-100);
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    .member-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        border-color: var(--brand-200);
    }
    .member-card-header {
        padding: 24px;
        display: flex;
        align-items: center;
        gap: 16px;
        position: relative;
        background: linear-gradient(to bottom right, #ffffff, #fafafa);
    }
    .member-avatar {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        background: var(--brand-500);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 18px;
        box-shadow: 0 8px 15px rgba(234, 88, 12, 0.2);
    }
    .member-info {
        flex: 1;
    }
    .member-name {
        font-size: 16px;
        font-weight: 800;
        color: var(--dark-800);
        margin-bottom: 2px;
    }
    .member-id {
        font-size: 11px;
        color: var(--gray-400);
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .member-tier-badge {
        position: absolute;
        top: 24px;
        right: 24px;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
    }
    .member-tier-badge.platinum { background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; }
    .member-tier-badge.gold { background: #fffbeb; color: #92400e; border: 1px solid #fde68a; }
    .member-tier-badge.silver { background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; }
    .member-tier-badge.bronze { background: #fff7ed; color: #9a3412; border: 1px solid #ffedd5; }

    .member-card-body {
        padding: 0 24px 24px;
        flex: 1;
    }
    .member-stat-row {
        display: flex;
        justify-content: space-between;
        padding: 16px 0;
        border-bottom: 1px solid var(--gray-50);
        margin-bottom: 16px;
    }
    .stat-item .label {
        display: block;
        font-size: 10px;
        color: var(--gray-400);
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 4px;
    }
    .stat-item .value {
        font-size: 15px;
        font-weight: 800;
        color: var(--dark-800);
    }
    .member-contact-info {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .contact-item {
        font-size: 13px;
        color: var(--gray-500);
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 500;
    }
    .member-card-footer {
        padding: 16px 24px;
        background: var(--gray-50);
        display: flex;
        gap: 10px;
    }
    .member-action-btn {
        flex: 1;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
        font-family: inherit;
    }
    .member-action-btn.edit { background: #fff; border: 1px solid var(--gray-200); color: var(--dark-700); }
    .member-action-btn.edit:hover { background: var(--gray-100); }
    .member-action-btn.delete { background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.2); color: #ef4444; }
    .member-action-btn.delete:hover { background: #ef4444; color: #fff; }
</style>

@endsection

@push('scripts')
<script>
function deleteMember(id, name) {
    document.getElementById('delete-name').textContent = name;
    document.getElementById('delete-form').action = `{{ url('admin/members') }}/${id}`;
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
