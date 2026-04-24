@extends('layouts.app')

@section('title', 'Manajemen Promo')
@section('page-title')
    🏷️ <span>Manajemen</span> Promo
@endsection

@section('content')

<div style="display:flex; flex-direction:column; gap:24px;">

    {{-- ── Header & Action ── --}}
    <div style="display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:20px;">
        <div>
            <h2 style="font-size:24px; font-weight:800; color:var(--dark-800); margin-bottom:4px;">Voucher & Diskon</h2>
            <p style="color:var(--gray-400); font-size:14px; font-weight:500;">Kelola penawaran menarik untuk meningkatkan penjualan Anda.</p>
        </div>
        <a href="{{ route('manager.promotions.create') }}" class="btn btn-primary" style="width:auto; padding:0 24px; height:48px; border-radius:12px; font-weight:700; box-shadow:0 8px 15px rgba(234, 88, 12, 0.2);">
            ＋ Buat Promo Baru
        </a>
    </div>

    {{-- ── Promotion List ── --}}
    @if($promotions->isEmpty())
        <div class="card" style="padding:100px 24px; text-align:center; border:none; box-shadow:0 4px 20px rgba(0,0,0,0.05); border-radius:20px;">
            <div style="font-size:72px; margin-bottom:24px; opacity: 0.3;">🏷️</div>
            <h3 style="font-size:22px; font-weight:800; color:var(--dark-800); margin-bottom:12px;">Belum Ada Promo</h3>
            <p style="color:var(--gray-400); margin-bottom:30px; max-width:400px; margin-inline:auto; font-size:15px;">Buat promo pertama Anda untuk menarik lebih banyak pelanggan.</p>
            <a href="{{ route('manager.promotions.create') }}" class="btn btn-primary" style="width:auto; padding:12px 30px; border-radius:12px; font-weight:700;">Buat Promo</a>
        </div>
    @else
        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(320px, 1fr)); gap:24px; margin-bottom:24px;">
            @foreach($promotions as $promo)
            <div class="promo-card">
                <div class="promo-card-header">
                    <div style="flex:1;">
                        <h3 style="font-size:16px; font-weight:800; color:var(--dark-800); margin-bottom:4px;">{{ $promo->name }}</h3>
                        <div style="display:inline-block; padding:4px 10px; background:var(--brand-50); color:var(--brand-600); border-radius:8px; font-family:'JetBrains Mono', monospace; font-weight:800; font-size:12px; letter-spacing:1px;">
                            {{ $promo->code }}
                        </div>
                    </div>
                    <div style="text-align:right;">
                        <div style="font-size:20px; font-weight:900; color:var(--brand-600);">
                            {{ $promo->discount_type == 'percentage' ? round($promo->discount_value).'%' : 'Rp '.number_format($promo->discount_value, 0, ',', '.') }}
                        </div>
                        <div style="font-size:10px; color:var(--gray-400); font-weight:700; text-transform:uppercase;">Diskon</div>
                    </div>
                </div>

                <div class="promo-card-body">
                    <div style="display:flex; justify-content:space-between; margin-bottom:12px;">
                        <div>
                            <div style="font-size:10px; color:var(--gray-400); font-weight:800; text-transform:uppercase; margin-bottom:2px;">Mulai</div>
                            <div style="font-size:13px; font-weight:700; color:var(--dark-700);">{{ $promo->start_date->format('d M Y') }}</div>
                        </div>
                        <div style="text-align:right;">
                            <div style="font-size:10px; color:var(--gray-400); font-weight:800; text-transform:uppercase; margin-bottom:2px;">Berakhir</div>
                            <div style="font-size:13px; font-weight:700; color:{{ $promo->end_date->isPast() ? '#ef4444' : 'var(--dark-700)' }};">{{ $promo->end_date->format('d M Y') }}</div>
                        </div>
                    </div>
                    
                    <div style="background:var(--gray-50); padding:12px; border-radius:12px; display:flex; justify-content:space-between; font-size:12px;">
                        <span style="color:var(--gray-500); font-weight:600;">Min. Belanja:</span>
                        <span style="color:var(--dark-800); font-weight:800;">Rp {{ number_format($promo->min_purchase, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="promo-card-footer">
                    <div style="display:flex; align-items:center; gap:8px;">
                        <span style="width:8px; height:8px; border-radius:50%; background:{{ $promo->is_active && !$promo->end_date->isPast() ? '#10b981' : '#ef4444' }};"></span>
                        <span style="font-size:11px; font-weight:700; color:{{ $promo->is_active && !$promo->end_date->isPast() ? '#065f46' : '#991b1b' }};">
                            {{ $promo->is_active && !$promo->end_date->isPast() ? 'AKTIF' : 'NON-AKTIF / EXPIRED' }}
                        </span>
                    </div>
                    <div style="display:flex; gap:8px;">
                        <a href="{{ route('manager.promotions.edit', $promo) }}" class="icon-btn" style="width:32px; height:32px; font-size:14px;">✏️</a>
                        <button onclick="deletePromo({{ $promo->id }}, '{{ addslashes($promo->name) }}')" class="icon-btn" style="width:32px; height:32px; font-size:14px; color:#ef4444;">🗑️</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- ── Pagination ── --}}
        <div style="margin-top: 10px;">
            {{ $promotions->links('partials.pagination') }}
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
            <h4 style="font-size:18px; font-weight:800; color:var(--dark-800); margin-bottom:8px;">Hapus Promo?</h4>
            <p style="font-size:14px; color:var(--gray-500); margin-bottom:24px; line-height:1.5;">
                Apakah Anda yakin ingin menghapus <strong id="delete-name" style="color:var(--dark-800);"></strong>? Voucher ini tidak akan bisa digunakan lagi.
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
    .promo-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid var(--gray-100);
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    .promo-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        border-color: var(--brand-200);
    }
    .promo-card-header {
        padding: 24px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        background: linear-gradient(to bottom right, #ffffff, #fafafa);
        border-bottom: 1px solid var(--gray-50);
    }
    .promo-card-body {
        padding: 20px 24px;
        flex: 1;
    }
    .promo-card-footer {
        padding: 16px 24px;
        background: var(--gray-50);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .icon-btn {
        background: #fff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        transition: transform 0.2s;
        border: 1px solid var(--gray-200);
        cursor: pointer;
    }
    .icon-btn:hover {
        transform: scale(1.1);
        background: var(--gray-50);
    }
</style>

@endsection

@push('scripts')
<script>
function deletePromo(id, name) {
    document.getElementById('delete-name').textContent = name;
    document.getElementById('delete-form').action = `{{ url('manager/promotions') }}/${id}`;
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
