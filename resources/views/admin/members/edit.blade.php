@extends('layouts.app')

@section('title', 'Edit Data Member')
@section('page-title')
    ✏️ <span>Edit</span> Member
@endsection

@section('content')

<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <a href="{{ route('admin.members.index') }}" class="btn" style="width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center; background: #fff; border: 1px solid var(--gray-200); color: var(--dark-700); border-radius: 12px;">←</a>
            <div>
                <h2 style="font-size: 20px; font-weight: 800; color: var(--dark-800);">Edit Data Member</h2>
                <p style="color: var(--gray-400); font-size: 13px;">Perbarui profil atau pengaturan diskon member ini.</p>
            </div>
        </div>
        <div style="background: var(--brand-50); color: var(--brand-600); padding: 8px 16px; border-radius: 10px; font-weight: 800; font-size: 12px; letter-spacing: 1px;">
            {{ $member->member_code }}
        </div>
    </div>

    <form action="{{ route('admin.members.update', $member) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card" style="padding: 32px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-radius: 20px;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                
                {{-- Nama --}}
                <div class="form-group" style="grid-column: span 2;">
                    <label class="form-label" style="font-weight: 700; color: var(--dark-700); margin-bottom: 8px;">Nama Lengkap Pelanggan</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: John Doe" value="{{ old('name', $member->user->name ?? '') }}" required style="height: 48px; border-radius: 12px;">
                    @error('name') <span style="color: var(--danger); font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label" style="font-weight: 700; color: var(--dark-700); margin-bottom: 8px;">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="john@example.com" value="{{ old('email', $member->member_email) }}" required style="height: 48px; border-radius: 12px;">
                    @error('email') <span style="color: var(--danger); font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
                </div>

                {{-- No. HP --}}
                <div class="form-group">
                    <label class="form-label" style="font-weight: 700; color: var(--dark-700); margin-bottom: 8px;">No. HP / WhatsApp</label>
                    <input type="text" name="phone" class="form-control" placeholder="0812xxxxxxxx" value="{{ old('phone', $member->member_phone) }}" required style="height: 48px; border-radius: 12px;">
                    @error('phone') <span style="color: var(--danger); font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
                </div>

                {{-- Diskon Member --}}
                <div class="form-group">
                    <label class="form-label" style="font-weight: 700; color: var(--dark-700); margin-bottom: 8px;">Diskon Default (%)</label>
                    <div style="position: relative;">
                        <input type="number" name="discount_percentage" class="form-control" placeholder="0" value="{{ old('discount_percentage', $member->discount_percentage) }}" min="0" max="100" style="height: 48px; border-radius: 12px; padding-right: 40px;">
                        <span style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: var(--gray-400); font-weight: 700;">%</span>
                    </div>
                    @error('discount_percentage') <span style="color: var(--danger); font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span> @enderror
                </div>

                {{-- Status --}}
                <div class="form-group">
                    <label class="form-label" style="font-weight: 700; color: var(--dark-700); margin-bottom: 8px;">Status Member</label>
                    <select name="is_active" class="form-select" style="height: 48px; border-radius: 12px;">
                        <option value="1" {{ old('is_active', $member->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('is_active', $member->is_active) == 0 ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                </div>

            </div>

            <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid var(--gray-100); display: flex; justify-content: flex-end; gap: 12px;">
                <a href="{{ route('admin.members.index') }}" class="btn" style="width: auto; padding: 0 24px; height: 48px; background: #fff; border: 1px solid var(--gray-200); color: var(--dark-700); border-radius: 12px; font-weight: 700;">Batal</a>
                <button type="submit" class="btn btn-primary" style="width: auto; padding: 0 32px; height: 48px; border-radius: 12px; font-weight: 800; box-shadow: 0 8px 15px rgba(234, 88, 12, 0.2);">Simpan Perubahan</button>
            </div>
        </div>
    </form>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 24px;">
        <div class="card" style="padding: 24px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border-radius: 20px;">
            <div style="font-size: 11px; color: var(--gray-400); font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">Statistik Belanja</div>
            <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                <div>
                    <div style="font-size: 20px; font-weight: 900; color: var(--dark-800);">Rp {{ number_format($member->total_spent, 0, ',', '.') }}</div>
                    <div style="font-size: 12px; color: var(--gray-400);">Total Akumulasi</div>
                </div>
                <div style="text-align: right;">
                    <div style="font-size: 20px; font-weight: 900; color: var(--brand-600);">{{ number_format($member->points_balance, 0, ',', '.') }}</div>
                    <div style="font-size: 12px; color: var(--gray-400);">Total Poin</div>
                </div>
            </div>
        </div>
        <div class="card" style="padding: 24px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border-radius: 20px;">
            <div style="font-size: 11px; color: var(--gray-400); font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">Tier Saat Ini</div>
            <div style="display: flex; align-items: center; gap: 15px;">
                <div style="width: 44px; height: 44px; border-radius: 12px; background: var(--gray-50); display: flex; align-items: center; justify-content: center; font-size: 20px;">
                    @if($member->member_tier == 'Platinum') 💎 @elseif($member->member_tier == 'Gold') 🥇 @else 🥈 @endif
                </div>
                <div>
                    <div style="font-size: 18px; font-weight: 800; color: var(--dark-800);">{{ $member->member_tier }}</div>
                    <div style="font-size: 12px; color: var(--gray-400);">Loyalty Level</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
