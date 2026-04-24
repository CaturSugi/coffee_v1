@extends('layouts.app')

@section('title', 'Tambah Pengguna Baru')
@section('page-title')
    👤 <span>Tambah</span> Pengguna
@endsection

@section('content')

<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
        <a href="{{ route('admin.users.index') }}" class="btn" style="width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center; background: #fff; border: 1px solid var(--gray-200); color: var(--dark-700); border-radius: 12px;">←</a>
        <div>
            <h2 style="font-size: 20px; font-weight: 800; color: var(--dark-800);">Tambah Pengguna Baru</h2>
            <p style="color: var(--gray-400); font-size: 13px;">Daftarkan akun untuk Admin, Manager, atau Customer Service.</p>
        </div>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="card" style="padding: 32px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-radius: 20px;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                
                {{-- Nama --}}
                <div class="form-group" style="grid-column: span 2;">
                    <label class="form-label" style="font-weight: 700; color: var(--dark-700); margin-bottom: 8px;">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" placeholder="Nama Staf" value="{{ old('name') }}" required style="height: 48px; border-radius: 12px;">
                    @error('name') <span style="color: var(--danger); font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label" style="font-weight: 700; color: var(--dark-700); margin-bottom: 8px;">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="email@coffee.com" value="{{ old('email') }}" required style="height: 48px; border-radius: 12px;">
                    @error('email') <span style="color: var(--danger); font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
                </div>

                {{-- Role --}}
                <div class="form-group">
                    <label class="form-label" style="font-weight: 700; color: var(--dark-700); margin-bottom: 8px;">Hak Akses (Role)</label>
                    <select name="role" class="form-select" style="height: 48px; border-radius: 12px;" required>
                        <option value="cs" {{ old('role') == 'cs' ? 'selected' : '' }}>Staff CS / Kasir</option>
                        <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                    @error('role') <span style="color: var(--danger); font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label class="form-label" style="font-weight: 700; color: var(--dark-700); margin-bottom: 8px;">Password</label>
                    <input type="password" name="password" class="form-control" required style="height: 48px; border-radius: 12px;">
                    @error('password') <span style="color: var(--danger); font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="form-group">
                    <label class="form-label" style="font-weight: 700; color: var(--dark-700); margin-bottom: 8px;">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required style="height: 48px; border-radius: 12px;">
                </div>

                {{-- Phone --}}
                <div class="form-group" style="grid-column: span 2;">
                    <label class="form-label" style="font-weight: 700; color: var(--dark-700); margin-bottom: 8px;">Nomor Telepon (Opsional)</label>
                    <input type="text" name="phone" class="form-control" placeholder="0812xxxxxxxx" value="{{ old('phone') }}" style="height: 48px; border-radius: 12px;">
                </div>

            </div>

            <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid var(--gray-100); display: flex; justify-content: flex-end; gap: 12px;">
                <a href="{{ route('admin.users.index') }}" class="btn" style="width: auto; padding: 0 24px; height: 48px; background: #fff; border: 1px solid var(--gray-200); color: var(--dark-700); border-radius: 12px; font-weight: 700;">Batal</a>
                <button type="submit" class="btn btn-primary" style="width: auto; padding: 0 32px; height: 48px; border-radius: 12px; font-weight: 800;">Simpan Pengguna</button>
            </div>
        </div>
    </form>
</div>

@endsection
