@extends('layouts.app')

@section('title', 'Daftar Member Baru')
@section('page-title')
    👥 <span>Registrasi</span> Member
@endsection

@section('content')
<div style="max-width:800px; margin:0 auto;">
    
    <div style="margin-bottom:24px;">
        <a href="{{ route('cs.members.index') }}" style="color:var(--gray-400); text-decoration:none; font-size:14px; font-weight:600; display:flex; align-items:center; gap:8px;">
            ← Kembali ke Daftar
        </a>
        <h2 style="font-size:24px; font-weight:800; color:var(--dark-800); margin-top:12px;">Daftar Member Baru</h2>
    </div>

    <div class="card" style="padding:32px; border-radius:24px; border:none; box-shadow:0 10px 30px rgba(0,0,0,0.05); background:#fff;">
        <form action="{{ route('cs.members.store') }}" method="POST">
            @csrf
            
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px; margin-bottom:24px;">
                <div class="form-group">
                    <label class="form-label" style="font-weight:700; color:var(--dark-700);">Nama Lengkap</label>
                    <input type="text" name="member_name" value="{{ old('member_name') }}" class="form-control" placeholder="Contoh: John Doe" required style="height:48px; border-radius:12px;">
                    @error('member_name') <small style="color:red;">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" style="font-weight:700; color:var(--dark-700);">Nomor WhatsApp</label>
                    <input type="text" name="member_phone" value="{{ old('member_phone') }}" class="form-control" placeholder="Contoh: 08123456789" required style="height:48px; border-radius:12px;">
                    @error('member_phone') <small style="color:red;">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="form-group" style="margin-bottom:32px;">
                <label class="form-label" style="font-weight:700; color:var(--dark-700);">Alamat (Opsional)</label>
                <textarea name="member_address" class="form-control" rows="3" placeholder="Masukkan alamat lengkap member..." style="border-radius:12px; padding:15px;">{{ old('member_address') }}</textarea>
                @error('member_address') <small style="color:red;">{{ $message }}</small> @enderror
            </div>

            <div style="background:var(--brand-50); padding:20px; border-radius:16px; margin-bottom:32px;">
                <div style="display:flex; gap:15px; align-items:center;">
                    <div style="font-size:24px;">🎁</div>
                    <div>
                        <div style="font-weight:800; color:var(--brand-700);">Keuntungan Member Baru</div>
                        <p style="margin:0; font-size:13px; color:var(--brand-600); opacity:0.8;">Setiap member baru akan mendapatkan diskon langsung 5% dan poin setiap transaksi.</p>
                    </div>
                </div>
            </div>

            <div style="display:flex; gap:12px;">
                <button type="submit" class="btn btn-primary" style="flex:1; height:50px; border-radius:12px; font-weight:700; font-size:16px; box-shadow:0 10px 20px rgba(249,115,22,0.2);">
                    Daftarkan Member
                </button>
                <a href="{{ route('cs.members.index') }}" class="btn btn-light" style="display:flex; align-items:center; justify-content:center; padding:0 24px; border-radius:12px; border:1px solid var(--gray-200); text-decoration:none; color:var(--gray-600); font-weight:700;">
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
