@extends('layouts.app')

@section('title', 'Pengaturan Profil')
@section('page-title')
    ⚙️ <span>Pengaturan</span> Profil
@endsection

@section('content')
<div style="max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 24px;">

    {{-- Back Button --}}
    <div>
        <a href="{{ 
            auth()->user()->isAdmin() ? route('admin.dashboard') : 
            (auth()->user()->isManager() ? route('manager.dashboard') : route('cs.dashboard')) 
        }}" 
        style="display: inline-flex; align-items: center; gap: 8px; color: var(--gray-500); text-decoration: none; font-weight: 700; font-size: 14px; transition: color 0.2s;"
        onmouseover="this.style.color='var(--brand-600)'"
        onmouseout="this.style.color='var(--gray-500)'">
            <span style="font-size: 18px;">←</span> Kembali ke Dashboard
        </a>
    </div>

    @if(session('success'))
    <div style="padding:15px 20px; background:#dcfce7; color:#166534; border-radius:12px; font-weight:700; border:1px solid #bbf7d0;">
        ✅ {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div style="padding:15px 20px; background:#fef2f2; color:#991b1b; border-radius:12px; font-weight:700; border:1px solid #fee2e2;">
        ⚠️ Ada kesalahan saat memperbarui data.
    </div>
    @endif

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
        
        {{-- Profile Information --}}
        <div class="card" style="border-radius:24px; border:none; box-shadow:0 10px 30px rgba(0,0,0,0.05); background:#fff; overflow:hidden;">
            <div style="padding:24px; border-bottom:1px solid var(--gray-50); background: linear-gradient(135deg, var(--brand-500), var(--brand-600)); color: #fff;">
                <h3 style="font-size:18px; font-weight:800; margin:0;">👤 Informasi Pribadi</h3>
                <p style="font-size:12px; opacity:0.8; margin-top:4px;">Perbarui nama dan alamat email Anda.</p>
            </div>
            <div style="padding:24px;">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div class="form-group-custom" style="margin-bottom:20px;">
                        <label style="display:block; font-size:11px; font-weight:800; color:var(--gray-400); text-transform:uppercase; margin-bottom:8px;">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required 
                            style="width:100%; padding:12px 16px; border-radius:12px; border:1px solid var(--gray-200); background:var(--gray-50); font-size:14px; font-weight:600;">
                        @error('name') <span style="font-size:12px; color:var(--danger);">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group-custom" style="margin-bottom:20px;">
                        <label style="display:block; font-size:11px; font-weight:800; color:var(--gray-400); text-transform:uppercase; margin-bottom:8px;">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                            style="width:100%; padding:12px 16px; border-radius:12px; border:1px solid var(--gray-200); background:var(--gray-50); font-size:14px; font-weight:600;">
                        @error('email') <span style="font-size:12px; color:var(--danger);">{{ $message }}</span> @enderror
                    </div>

                    <div style="margin-top:24px;">
                        <button type="submit" class="btn-primary-custom" style="width:100%; padding:14px; border-radius:12px; background:var(--brand-500); color:#fff; border:none; font-weight:700; cursor:pointer; box-shadow:0 10px 20px rgba(249,115,22,0.2);">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Password Update --}}
        <div class="card" style="border-radius:24px; border:none; box-shadow:0 10px 30px rgba(0,0,0,0.05); background:#fff; overflow:hidden;">
            <div style="padding:24px; border-bottom:1px solid var(--gray-50); background: var(--dark-800); color: #fff;">
                <h3 style="font-size:18px; font-weight:800; margin:0;">🔒 Keamanan Akun</h3>
                <p style="font-size:12px; opacity:0.8; margin-top:4px;">Ganti kata sandi Anda secara berkala.</p>
            </div>
            <div style="padding:24px;">
                <form action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    <div class="form-group-custom" style="margin-bottom:16px;">
                        <label style="display:block; font-size:11px; font-weight:800; color:var(--gray-400); text-transform:uppercase; margin-bottom:8px;">Password Saat Ini</label>
                        <input type="password" name="current_password" required
                            style="width:100%; padding:12px 16px; border-radius:12px; border:1px solid var(--gray-200); background:var(--gray-50); font-size:14px; font-weight:600;">
                        @error('current_password') <span style="font-size:12px; color:var(--danger);">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group-custom" style="margin-bottom:16px;">
                        <label style="display:block; font-size:11px; font-weight:800; color:var(--gray-400); text-transform:uppercase; margin-bottom:8px;">Password Baru</label>
                        <input type="password" name="password" required
                            style="width:100%; padding:12px 16px; border-radius:12px; border:1px solid var(--gray-200); background:var(--gray-50); font-size:14px; font-weight:600;">
                        @error('password') <span style="font-size:12px; color:var(--danger);">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group-custom" style="margin-bottom:16px;">
                        <label style="display:block; font-size:11px; font-weight:800; color:var(--gray-400); text-transform:uppercase; margin-bottom:8px;">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" required
                            style="width:100%; padding:12px 16px; border-radius:12px; border:1px solid var(--gray-200); background:var(--gray-50); font-size:14px; font-weight:600;">
                    </div>

                    <div style="margin-top:24px;">
                        <button type="submit" style="width:100%; padding:14px; border-radius:12px; background:var(--dark-800); color:#fff; border:none; font-weight:700; cursor:pointer; transition:all 0.2s;">
                            Perbarui Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    {{-- Account Details Info --}}
    <div class="card" style="padding:24px; border-radius:24px; border:none; box-shadow:0 10px 30px rgba(0,0,0,0.05); background:#fff; display:flex; align-items:center; justify-content:space-between; gap:20px;">
        <div style="display:flex; align-items:center; gap:15px;">
            <div style="width:50px; height:50px; border-radius:50%; background:var(--brand-50); color:var(--brand-600); display:flex; align-items:center; justify-content:center; font-weight:800; font-size:20px;">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <div style="font-weight:800; color:var(--dark-800);">{{ $user->name }}</div>
                <div style="font-size:13px; color:var(--gray-400); font-weight:600;">Role: <span style="color:var(--brand-600);">{{ ucfirst($user->role) }} Staff</span></div>
            </div>
        </div>
        <div style="text-align:right; font-size:12px; color:var(--gray-400); font-weight:600;">
            Terdaftar sejak: {{ $user->created_at->format('d M Y') }}
        </div>
    </div>

</div>

<style>
    .btn-primary-custom:hover {
        background: var(--brand-600) !important;
        transform: translateY(-2px);
    }
    input:focus {
        outline: none;
        border-color: var(--brand-500) !important;
        background: #fff !important;
        box-shadow: 0 0 0 4px var(--brand-50);
    }
</style>
@endsection
