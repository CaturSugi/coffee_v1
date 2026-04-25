@extends('layouts.app')

@section('title', 'Pengaturan Sistem')
@section('page-title')
    ⚙️ <span>Pengaturan</span> Sistem
@endsection

@section('content')
<div style="display:flex; flex-direction:column; gap:24px;">

    @if(session('success'))
    <div style="padding:15px 20px; background:#dcfce7; color:#166534; border-radius:12px; font-weight:700; border:1px solid #bbf7d0;">
        ✅ {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div style="display:grid; grid-template-columns: 280px 1fr; gap:32px;">
            
            {{-- Navigation Side --}}
            <div style="display:flex; flex-direction:column; gap:8px;">
                <button type="button" onclick="switchTab('general')" id="tab-general" class="setting-tab active">
                    <span class="icon">🏢</span>
                    <div class="text">
                        <div class="title">Informasi Toko</div>
                        <div class="desc">Nama, alamat, & kontak</div>
                    </div>
                </button>
                <button type="button" onclick="switchTab('pos')" id="tab-pos" class="setting-tab">
                    <span class="icon">🛒</span>
                    <div class="text">
                        <div class="title">Sistem POS</div>
                        <div class="desc">Pajak, biaya layanan, & struk</div>
                    </div>
                </button>
                <button type="button" onclick="switchTab('appearance')" id="tab-appearance" class="setting-tab">
                    <span class="icon">🎨</span>
                    <div class="text">
                        <div class="title">Tampilan</div>
                        <div class="desc">Logo & identitas visual</div>
                    </div>
                </button>
                <button type="button" onclick="switchTab('social')" id="tab-social" class="setting-tab">
                    <span class="icon">🌐</span>
                    <div class="text">
                        <div class="title">Media Sosial</div>
                        <div class="desc">Link Instagram, WA, dll</div>
                    </div>
                </button>
            </div>

            {{-- Content Side --}}
            <div class="card" style="border:none; box-shadow:0 10px 30px rgba(0,0,0,0.05); border-radius:24px; background:#fff; overflow:hidden;">
                
                {{-- General Tab --}}
                <div id="content-general" class="tab-content active">
                    <div class="tab-header">
                        <h3>🏢 Informasi Toko</h3>
                        <p>Atur detail dasar kedai kopi Anda.</p>
                    </div>
                    <div class="tab-body">
                        <div class="form-group">
                            <label>Nama Kedai</label>
                            <input type="text" name="shop_name" value="{{ $settings['shop_name'] ?? 'The Coffee House' }}" class="form-control-premium">
                        </div>
                        <div class="form-group">
                            <label>Slogan / Tagline</label>
                            <input type="text" name="shop_tagline" value="{{ $settings['shop_tagline'] ?? 'Brewing Happiness' }}" class="form-control-premium">
                        </div>
                        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px;">
                            <div class="form-group">
                                <label>Email Kontak</label>
                                <input type="email" name="shop_email" value="{{ $settings['shop_email'] ?? 'hello@coffeehouse.com' }}" class="form-control-premium">
                            </div>
                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <input type="text" name="shop_phone" value="{{ $settings['shop_phone'] ?? '0812-3456-7890' }}" class="form-control-premium">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat Lengkap</label>
                            <textarea name="shop_address" rows="3" class="form-control-premium">{{ $settings['shop_address'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- POS Tab --}}
                <div id="content-pos" class="tab-content">
                    <div class="tab-header">
                        <h3>🛒 Konfigurasi POS</h3>
                        <p>Atur parameter transaksi dan pembayaran.</p>
                    </div>
                    <div class="tab-body">
                        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px;">
                            <div class="form-group">
                                <label>Pajak (PPN %)</label>
                                <div style="position:relative;">
                                    <input type="number" name="pos_tax_percentage" value="{{ $settings['pos_tax_percentage'] ?? '10' }}" class="form-control-premium">
                                    <span style="position:absolute; right:15px; top:50%; transform:translateY(-50%); font-weight:700; color:var(--gray-400);">%</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Biaya Layanan (Service Charge %)</label>
                                <div style="position:relative;">
                                    <input type="number" name="pos_service_charge" value="{{ $settings['pos_service_charge'] ?? '0' }}" class="form-control-premium">
                                    <span style="position:absolute; right:15px; top:50%; transform:translateY(-50%); font-weight:700; color:var(--gray-400);">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Simbol Mata Uang</label>
                            <input type="text" name="pos_currency_symbol" value="{{ $settings['pos_currency_symbol'] ?? 'Rp' }}" class="form-control-premium">
                        </div>
                        <div class="form-group">
                            <label>Pesan di Kaki Struk (Footer)</label>
                            <textarea name="pos_receipt_footer" rows="3" class="form-control-premium">{{ $settings['pos_receipt_footer'] ?? 'Terima kasih atas kunjungan Anda!' }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Appearance Tab --}}
                <div id="content-appearance" class="tab-content">
                    <div class="tab-header">
                        <h3>🎨 Identitas Visual</h3>
                        <p>Sesuaikan tampilan logo dan tema aplikasi.</p>
                    </div>
                    <div class="tab-body">
                        <div class="form-group">
                            <label>Logo Aplikasi</label>
                            <div style="display:flex; align-items:center; gap:24px; padding:20px; border:2px dashed var(--gray-100); border-radius:16px;">
                                <div style="width:80px; height:80px; background:var(--gray-50); border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:32px; overflow:hidden;">
                                    @if(isset($settings['app_logo']) && $settings['app_logo'])
                                        <img src="{{ asset('storage/' . $settings['app_logo']) }}" alt="Logo" style="width:100%; height:100%; object-fit:cover;">
                                    @else
                                        ☕
                                    @endif
                                </div>
                                <div style="flex:1;">
                                    <input type="file" name="app_logo" class="form-control" style="margin-bottom:8px;">
                                    <p style="font-size:12px; color:var(--gray-400); margin:0;">Disarankan PNG transparan, ukuran maksimal 2MB.</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Warna Utama (Brand Color)</label>
                            <div style="display:flex; gap:12px; align-items:center;">
                                <input type="color" name="app_brand_color" value="{{ $settings['app_brand_color'] ?? '#ea580c' }}" style="width:60px; height:45px; border:none; padding:0; background:none; cursor:pointer; border-radius:8px;">
                                <input type="text" value="{{ $settings['app_brand_color'] ?? '#ea580c' }}" class="form-control-premium" style="width:120px;" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Social Tab --}}
                <div id="content-social" class="tab-content">
                    <div class="tab-header">
                        <h3>🌐 Media Sosial & Kontak</h3>
                        <p>Hubungkan kedai Anda dengan pelanggan.</p>
                    </div>
                    <div class="tab-body">
                        <div class="form-group">
                            <label>Username Instagram</label>
                            <div style="position:relative;">
                                <span style="position:absolute; left:15px; top:50%; transform:translateY(-50%); color:var(--gray-400);">@</span>
                                <input type="text" name="social_instagram" value="{{ $settings['social_instagram'] ?? '' }}" class="form-control-premium" style="padding-left:35px;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>WhatsApp Center</label>
                            <input type="text" name="social_whatsapp" value="{{ $settings['social_whatsapp'] ?? '' }}" class="form-control-premium" placeholder="Contoh: 628123456789">
                        </div>
                        <div class="form-group">
                            <label>Facebook Page</label>
                            <input type="text" name="social_facebook" value="{{ $settings['social_facebook'] ?? '' }}" class="form-control-premium">
                        </div>
                    </div>
                </div>

                <div class="tab-footer">
                    <button type="submit" class="btn btn-primary" style="padding:12px 32px; border-radius:12px; font-weight:700; box-shadow:0 10px 20px rgba(234,88,12,0.2);">
                        Simpan Perubahan
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>

<style>
    .setting-tab {
        background: transparent;
        border: 1px solid transparent;
        padding: 16px 20px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 16px;
        text-align: left;
        cursor: pointer;
        transition: all 0.2s;
        width: 100%;
    }
    .setting-tab:hover {
        background: rgba(0,0,0,0.02);
    }
    .setting-tab.active {
        background: #fff;
        border-color: var(--gray-100);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .setting-tab .icon {
        font-size: 24px;
        width: 44px;
        height: 44px;
        background: var(--gray-50);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .setting-tab.active .icon {
        background: var(--brand-50);
        color: var(--brand-600);
    }
    .setting-tab .title {
        font-size: 14px;
        font-weight: 800;
        color: var(--dark-800);
    }
    .setting-tab .desc {
        font-size: 11px;
        color: var(--gray-400);
        font-weight: 600;
    }

    .tab-content {
        display: none;
        padding: 32px;
    }
    .tab-content.active {
        display: block;
    }
    .tab-header {
        margin-bottom: 32px;
        border-bottom: 1px solid var(--gray-50);
        padding-bottom: 24px;
    }
    .tab-header h3 {
        font-size: 20px;
        font-weight: 900;
        color: var(--dark-800);
        margin: 0;
    }
    .tab-header p {
        font-size: 13px;
        color: var(--gray-400);
        margin: 8px 0 0 0;
    }

    .form-group {
        margin-bottom: 24px;
    }
    .form-group label {
        display: block;
        font-size: 11px;
        font-weight: 800;
        color: var(--gray-400);
        text-transform: uppercase;
        margin-bottom: 10px;
        letter-spacing: 0.5px;
    }
    .form-control-premium {
        width: 100%;
        height: 48px;
        background: var(--gray-50);
        border: 1px solid var(--gray-100);
        border-radius: 12px;
        padding: 0 16px;
        font-size: 14px;
        font-weight: 600;
        color: var(--dark-700);
        transition: all 0.2s;
    }
    .form-control-premium:focus {
        background: #fff;
        border-color: var(--brand-500);
        box-shadow: 0 0 0 4px var(--brand-50);
        outline: none;
    }
    textarea.form-control-premium {
        height: auto;
        padding: 16px;
    }

    .tab-footer {
        padding: 24px 32px;
        background: var(--gray-50);
        border-top: 1px solid var(--gray-100);
        display: flex;
        justify-content: flex-end;
    }
</style>

@endsection

@push('scripts')
<script>
    function switchTab(tabId) {
        // Update tabs
        document.querySelectorAll('.setting-tab').forEach(tab => {
            tab.classList.remove('active');
        });
        document.getElementById('tab-' + tabId).classList.add('active');

        // Update content
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.remove('active');
        });
        document.getElementById('content-' + tabId).classList.add('active');
    }
</script>
@endpush
