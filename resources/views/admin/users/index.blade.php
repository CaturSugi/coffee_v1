@extends('layouts.app')

@section('title', 'Manajemen Pengguna')
@section('page-title')
    👤 <span>Manajemen</span> Pengguna
@endsection

@section('content')

<div style="display:flex; flex-direction:column; gap:24px;">

    {{-- ── Header & Action ── --}}
    <div style="display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:20px;">
        <div>
            <h2 style="font-size:24px; font-weight:800; color:var(--dark-800); margin-bottom:4px;">Staf & Pengelola</h2>
            <p style="color:var(--gray-400); font-size:14px; font-weight:500;">Atur hak akses untuk Admin, Manager, dan Customer Service.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary" style="width:auto; padding:0 24px; height:48px; border-radius:12px; font-weight:700; box-shadow:0 8px 15px rgba(234, 88, 12, 0.2);">
            ＋ Tambah Pengguna Baru
        </a>
    </div>

    {{-- ── User List Table ── --}}
    <div class="card" style="border: none; box-shadow: 0 4px 25px rgba(0,0,0,0.05); overflow: hidden; border-radius: 16px;">
        <div class="table-responsive">
            <table class="table" style="margin-bottom: 0;">
                <thead style="background: var(--gray-50);">
                    <tr>
                        <th style="padding: 16px 24px; color: var(--gray-400); font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Pengguna</th>
                        <th style="padding: 16px 24px; color: var(--gray-400); font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Role</th>
                        <th style="padding: 16px 24px; color: var(--gray-400); font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Kontak</th>
                        <th style="padding: 16px 24px; color: var(--gray-400); font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Status</th>
                        <th style="padding: 16px 24px; text-align: right; color: var(--gray-400); font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Aksi</th>
                    </tr>
                </thead>
                <tbody style="background: #fff;">
                    @foreach($users as $user)
                    <tr style="border-bottom: 1px solid var(--gray-50);">
                        <td style="padding: 16px 24px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 40px; height: 40px; border-radius: 12px; background: var(--brand-500); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 14px; box-shadow: 0 4px 10px rgba(234, 88, 12, 0.2);">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div style="font-weight: 800; color: var(--dark-800); font-size: 14px;">{{ $user->name }}</div>
                                    <div style="font-size: 12px; color: var(--gray-400);">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 16px 24px;">
                            @if($user->role == 'admin')
                                <span style="padding: 4px 10px; border-radius: 8px; font-size: 10px; font-weight: 800; background: #fee2e2; color: #991b1b; text-transform: uppercase;">Administrator</span>
                            @elseif($user->role == 'manager')
                                <span style="padding: 4px 10px; border-radius: 8px; font-size: 10px; font-weight: 800; background: #eff6ff; color: #1e40af; text-transform: uppercase;">Manager</span>
                            @else
                                <span style="padding: 4px 10px; border-radius: 8px; font-size: 10px; font-weight: 800; background: #f3f4f6; color: #374151; text-transform: uppercase;">Staff CS</span>
                            @endif
                        </td>
                        <td style="padding: 16px 24px;">
                            <div style="font-size: 13px; color: var(--dark-700);">{{ $user->phone ?? '-' }}</div>
                        </td>
                        <td style="padding: 16px 24px;">
                            @if($user->is_active)
                                <div style="display: flex; align-items: center; gap: 6px; color: #10b981; font-size: 12px; font-weight: 700;">
                                    <span style="width: 8px; height: 8px; border-radius: 50%; background: #10b981;"></span> Aktif
                                </div>
                            @else
                                <div style="display: flex; align-items: center; gap: 6px; color: var(--gray-400); font-size: 12px; font-weight: 700;">
                                    <span style="width: 8px; height: 8px; border-radius: 50%; background: var(--gray-400);"></span> Non-Aktif
                                </div>
                            @endif
                        </td>
                        <td style="padding: 16px 24px; text-align: right;">
                            <div style="display: flex; gap: 8px; justify-content: flex-end;">
                                <a href="{{ route('admin.users.edit', $user) }}" class="action-btn" title="Edit Data">✏️</a>
                                @if($user->id !== auth()->id())
                                    <button onclick="deleteUser({{ $user->id }}, '{{ addslashes($user->name) }}')" class="action-btn" style="background: #fef2f2; color: #ef4444;" title="Hapus User">🗑️</button>
                                @endif
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
        {{ $users->links('partials.pagination') }}
    </div>

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
            <h4 style="font-size:18px; font-weight:800; color:var(--dark-800); margin-bottom:8px;">Hapus Pengguna?</h4>
            <p style="font-size:14px; color:var(--gray-500); margin-bottom:24px; line-height:1.5;">
                Apakah Anda yakin ingin menghapus akun <strong id="delete-name" style="color:var(--dark-800);"></strong>? Pengguna ini tidak akan bisa login lagi.
            </p>
            <form id="delete-form" method="POST">
                @csrf @method('DELETE')
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <button type="button" onclick="closeDeleteModal()" class="btn-cancel-custom">Batal</button>
                    <button type="submit" class="btn-delete-custom">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .action-btn {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--gray-100);
        color: var(--gray-600);
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        font-size: 16px;
    }
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
</style>

@endsection

@push('scripts')
<script>
function deleteUser(id, name) {
    document.getElementById('delete-name').textContent = name;
    document.getElementById('delete-form').action = `{{ url('admin/users') }}/${id}`;
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
