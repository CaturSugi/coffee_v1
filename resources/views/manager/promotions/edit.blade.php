@extends('layouts.app')

@section('title', 'Edit Promo')
@section('page-title')
    🏷️ <span>Edit</span> Promo
@endsection

@section('content')

<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
        <a href="{{ route('manager.promotions.index') }}" style="width: 40px; height: 40px; border-radius: 50%; background: #fff; display: flex; align-items: center; justify-content: center; text-decoration: none; border: 1px solid var(--gray-200); color: var(--dark-800); transition: all 0.2s;">←</a>
        <div>
            <h2 style="font-size: 20px; font-weight: 800; color: var(--dark-800);">Edit Promosi</h2>
            <p style="color: var(--gray-400); font-size: 13px;">Perbarui detail promosi <strong>{{ $promotion->name }}</strong>.</p>
        </div>
    </div>

    <form action="{{ route('manager.promotions.update', $promotion) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card" style="padding: 32px; border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                <div class="form-group" style="grid-column: span 2;">
                    <label class="form-label">Nama Promosi</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: Promo Ramadhan" value="{{ old('name', $promotion->name) }}" required>
                    @error('name') <span style="color: #ef4444; font-size: 12px;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Kode Promo</label>
                    <input type="text" name="code" class="form-control" style="text-transform: uppercase; font-family: 'JetBrains Mono', monospace;" placeholder="RAMADHAN24" value="{{ old('code', $promotion->code) }}" required>
                    @error('code') <span style="color: #ef4444; font-size: 12px;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-select">
                        <option value="1" {{ old('is_active', $promotion->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('is_active', $promotion->is_active) == '0' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Tipe Diskon</label>
                    <select name="discount_type" id="discount_type" class="form-select" required>
                        <option value="percentage" {{ old('discount_type', $promotion->discount_type) == 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
                        <option value="fixed" {{ old('discount_type', $promotion->discount_type) == 'fixed' ? 'selected' : '' }}>Potongan Tetap (Rp)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Nilai Diskon</label>
                    <div style="position: relative;">
                        <input type="number" name="discount_value" class="form-control" placeholder="0" value="{{ old('discount_value', $promotion->discount_value) }}" required>
                        <span id="discount-suffix" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); font-weight: 700; color: var(--gray-400);">%</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Minimal Pembelian (Rp)</label>
                    <input type="number" name="min_purchase" class="form-control" placeholder="0" value="{{ old('min_purchase', $promotion->min_purchase) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Maksimal Potongan (Rp)</label>
                    <input type="number" name="max_discount" id="max_discount" class="form-control" placeholder="Kosongkan jika tidak dibatasi" value="{{ old('max_discount', $promotion->max_discount) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $promotion->start_date->format('Y-m-d')) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Tanggal Berakhir</label>
                    <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $promotion->end_date->format('Y-m-d')) }}" required>
                </div>

                <div class="form-group" style="grid-column: span 2;">
                    <label class="form-label">Deskripsi (Opsional)</label>
                    <textarea name="description" class="form-control" style="height: 100px; resize: none;" placeholder="Berikan info detail mengenai promo ini...">{{ old('description', $promotion->description) }}</textarea>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px; border-top: 1px solid var(--gray-100); padding-top: 24px;">
                <a href="{{ route('manager.promotions.index') }}" class="btn" style="background: var(--gray-100); color: var(--dark-700); padding: 0 24px; height: 48px; border-radius: 12px; font-weight: 700; display: flex; align-items: center; text-decoration: none;">Batal</a>
                <button type="submit" class="btn btn-primary" style="padding: 0 32px; height: 48px; border-radius: 12px; font-weight: 700; box-shadow: 0 8px 20px rgba(234, 88, 12, 0.2);">Perbarui Promo</button>
            </div>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
    const typeSelect = document.getElementById('discount_type');
    const suffix = document.getElementById('discount-suffix');
    const maxDisc = document.getElementById('max_discount');

    function updateUI() {
        if (typeSelect.value === 'percentage') {
            suffix.textContent = '%';
            maxDisc.disabled = false;
            maxDisc.parentElement.style.opacity = '1';
        } else {
            suffix.textContent = 'Rp';
            maxDisc.disabled = true;
            maxDisc.value = '';
            maxDisc.parentElement.style.opacity = '0.5';
        }
    }

    typeSelect.addEventListener('change', updateUI);
    updateUI();
</script>
@endpush
