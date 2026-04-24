@extends('layouts.app')

@section('title', 'Edit Data Pengguna')
@section('page-title')
    👤 <span>Edit</span> Pengguna
@endsection

@section('content')

<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
        <a href="{{ route('admin.users.index') }}" class="btn" style="width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center; background: #fff; border: 1px solid var(--gray-200); color: var(--dark-700); border-radius: 12px;">←</a>
        <div>
            <h2 style="font-size: 20px; font-weight: 800; color: var(--dark-800);">Edit Data Pengguna</h2>
            <p style="color: var(--gray-400); font-size: 13px;">Perbarui profil atau hak akses akun ini.</p>
        </div>
    </div>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card" style="padding: 32px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-radius: 20px;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                
                {{-- Nama --}}
                <div class="form-group" style="grid-column: span 2;">
                    <label class="form-label" style="font-weight: 700; color: var(--dark-700); margin-bottom: 8px;">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required style="height: 48px; border-radius: 12px;">
                    @error('name') <span style="color: var(--danger); font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label" style="font-weight: 700; color: var(--dark-700); margin-bottom: 8px;">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required style="height: 48px; border-radius: 12px;">
                    @error('email') <span style="color: var(--danger); font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
                </div>

                {{-- Role --}}
                <div class="form-group">
                    <label class="form-label" style="font-weight: 700; color: var(--dark-700); margin-bottom: 8px;">Hak Akses (Role)</label>
                    <select name="role" class="form-select" style="height: 48px; border-radius: 12px;" required>
                        <option value="cs" {{ old('role', $user->role) == 'cs' ? 'selected' : '' }}>Staff CS / Kasir</option>
                        <option value="manager" {{ old('role', $user->role) == 'manager' ? 'selected' : '' }}>Manager</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                    @error('role') <span style="color: var(--danger); font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
                </div>

                {{-- Phone --}}
                <div class="form-group" style="grid-column: span 2;">
                    <label class="form-label" style="font-weight: 700; color: var(--dark-700); margin-bottom: 8px;">Nomor Telepon (Opsional)</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" style="height: 48px; border-radius: 12px;">
                </div>

                <div style="grid-column: span 2; margin-top: 10px; padding: 20px; background: var(--gray-50); border-radius: 16px; border: 1px dashed var(--gray-200);">
                    <h4 style="font-size: 14px; font-weight: 800; color: var(--dark-800); margin-bottom: 15px;">Ubah Password</h4>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label class="form-label" style="font-size: 12px; font-weight: 700;">Password Baru</label>
                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah" style="height: 45px; border-radius: 10px;">
                            @error('password') <span style="color: var(--danger); font-size: 11px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" style="font-size: 12px; font-weight: 700;">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru" style="height: 45px; border-radius: 10px;">
                        </div>
                    </div>
                </div>

            </div>

            <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid var(--gray-100); display: flex; justify-content: flex-end; gap: 12px;">
                <a href="{{ route('admin.users.index') }}" class="btn" style="width: auto; padding: 0 24px; height: 48px; background: #fff; border: 1px solid var(--gray-200); color: var(--dark-700); border-radius: 12px; font-weight: 700;">Batal</a>
                <button type="submit" class="btn btn-primary" style="width: auto; padding: 0 32px; height: 48px; border-radius: 12px; font-weight: 800;">Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>

@endsection
