@extends('layouts.app')

@section('title', 'Dashboard Kasir')
@section('page-title')
    👋 <span>Halo,</span> {{ auth()->user()->name }}
@endsection

@section('content')

<div style="display:flex; flex-direction:column; gap:24px;">

    {{-- ── Greeting & Time ── --}}
    <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:15px;">
        <div>
            <h2 style="font-size:24px; font-weight:800; color:var(--dark-800); margin:0;">Selamat Bekerja! ☕</h2>
            <p style="color:var(--gray-400); font-size:14px; margin-top:4px;">Semoga harimu menyenangkan dan penuh berkah.</p>
        </div>
        <div style="text-align:right;">
            <div id="big-clock" style="font-size:32px; font-weight:900; color:var(--brand-600); line-height:1;">00:00:00</div>
            <div style="font-size:13px; color:var(--gray-400); margin-top:5px; font-weight:600;">{{ now()->isoFormat('dddd, D MMMM Y') }}</div>
        </div>
    </div>

    {{-- ── Quick Stats ── --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:20px;">
        
        <div class="card" style="padding:24px; border-radius:20px; border:none; box-shadow:0 10px 30px rgba(0,0,0,0.05); background:#fff; display:flex; align-items:center; gap:20px;">
            <div style="width:60px; height:60px; border-radius:15px; background:rgba(249,115,22,0.1); color:var(--brand-600); display:flex; align-items:center; justify-content:center; font-size:28px;">💰</div>
            <div>
                <div style="font-size:13px; font-weight:600; color:var(--gray-400);">Penjualan Saya Hari Ini</div>
                <div style="font-size:20px; font-weight:800; color:var(--dark-800); margin-top:2px;">Rp {{ number_format($todayMySales, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="card" style="padding:24px; border-radius:20px; border:none; box-shadow:0 10px 30px rgba(0,0,0,0.05); background:#fff; display:flex; align-items:center; gap:20px;">
            <div style="width:60px; height:60px; border-radius:15px; background:rgba(34,197,94,0.1); color:#22c55e; display:flex; align-items:center; justify-content:center; font-size:28px;">🧾</div>
            <div>
                <div style="font-size:13px; font-weight:600; color:var(--gray-400);">Transaksi Saya</div>
                <div style="font-size:20px; font-weight:800; color:var(--dark-800); margin-top:2px;">{{ number_format($todayMyTransactions) }} Transaksi</div>
            </div>
        </div>

        <div class="card" style="padding:24px; border-radius:20px; border:none; box-shadow:0 10px 30px rgba(0,0,0,0.05); background:#fff; display:flex; align-items:center; gap:20px;">
            <div style="width:60px; height:60px; border-radius:15px; background:rgba(59,130,246,0.1); color:#3b82f6; display:flex; align-items:center; justify-content:center; font-size:28px;">👥</div>
            <div>
                <div style="font-size:13px; font-weight:600; color:var(--gray-400);">Total Member</div>
                <div style="font-size:20px; font-weight:800; color:var(--dark-800); margin-top:2px;">{{ number_format($totalMembers) }} Pelanggan</div>
            </div>
        </div>

    </div>

    {{-- ── Main Actions ── --}}
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px;">
        
        {{-- Big Action Card --}}
        <a href="{{ route('pos.index') }}" class="action-card" style="background:linear-gradient(135deg, var(--brand-500), var(--brand-600)); color:#fff; padding:40px; border-radius:24px; text-decoration:none; display:flex; align-items:center; justify-content:space-between; box-shadow:0 20px 40px rgba(249,115,22,0.25); transition:all 0.3s ease;">
            <div>
                <div style="font-size:32px; font-weight:900; margin-bottom:8px;">Buka Kasir</div>
                <p style="opacity:0.8; margin:0; font-size:16px;">Mulai transaksi baru sekarang</p>
            </div>
            <div style="font-size:64px; opacity:0.3;">🛒</div>
        </a>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
             <button onclick="openMemberModal()" class="small-action-card" style="width:100%; border:none; cursor:pointer;">
                <div class="sa-icon" style="background:#eff6ff; color:#3b82f6;">👤</div>
                <div class="sa-label">Member Baru</div>
             </button>
             <a href="{{ route('pos.transaction.list') }}" class="small-action-card">
                <div class="sa-icon" style="background:#f0fdf4; color:#22c55e;">📜</div>
                <div class="sa-label">Riwayat TRX</div>
             </a>
             <a href="{{ route('profile.index') }}" class="small-action-card">
                <div class="sa-icon" style="background:#fef2f2; color:#ef4444;">⚙️</div>
                <div class="sa-label">Pengaturan</div>
             </a>
             <button onclick="openPromoModal()" class="small-action-card" style="width:100%; border:none; cursor:pointer;">
                <div class="sa-icon" style="background:#fdf4ff; color:#a855f7;">🎁</div>
                <div class="sa-label">Info Promo</div>
             </button>
        </div>

    </div>

    {{-- ── Modals ── --}}
    
    {{-- Promo Modal --}}
    <div id="promoModal" class="modal-overlay" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>🎁 Promosi Aktif</h3>
                <button onclick="closePromoModal()" class="close-btn">&times;</button>
            </div>
            <div class="modal-body">
                @forelse($activePromotions as $promo)
                    <div style="padding:15px; border:1px solid var(--gray-100); border-radius:12px; margin-bottom:12px; background:var(--gray-50);">
                        <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                            <div>
                                <div style="font-weight:800; color:var(--dark-800); font-size:15px;">{{ $promo->name }}</div>
                                <div style="background:var(--brand-50); color:var(--brand-600); display:inline-block; padding:2px 8px; border-radius:6px; font-size:11px; font-weight:800; margin-top:4px;">CODE: {{ $promo->code }}</div>
                            </div>
                            <div style="text-align:right;">
                                <div style="font-size:14px; font-weight:900; color:var(--success);">
                                    @if($promo->discount_type == 'percentage')
                                        {{ $promo->discount_value }}% OFF
                                    @else
                                        Rp {{ number_format($promo->discount_value, 0, ',', '.') }} OFF
                                    @endif
                                </div>
                            </div>
                        </div>
                        <p style="font-size:12px; color:var(--gray-400); margin:8px 0 0 0;">{{ $promo->description }}</p>
                    </div>
                @empty
                    <div style="text-align:center; padding:30px; color:var(--gray-400);">Tidak ada promosi aktif saat ini.</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Member Modal --}}
    <div id="memberModal" class="modal-overlay" style="display:none;">
        <div class="modal-content" style="max-width:450px;">
            <div class="modal-header">
                <h3>👤 Daftar Member Baru</h3>
                <button onclick="closeMemberModal()" class="close-btn">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cs.members.store') }}" method="POST">
                    @csrf
                    <div class="form-group-custom">
                        <label>Nama Lengkap</label>
                        <input type="text" name="member_name" required placeholder="Contoh: John Doe">
                    </div>
                    <div class="form-group-custom">
                        <label>Nomor WhatsApp</label>
                        <input type="text" name="member_phone" required placeholder="Contoh: 08123456789">
                    </div>
                    <div class="form-group-custom">
                        <label>Alamat (Opsional)</label>
                        <textarea name="member_address" rows="3" placeholder="Alamat pelanggan..."></textarea>
                    </div>
                    <div style="margin-top:20px;">
                        <button type="submit" class="btn-primary-custom">Daftarkan Member</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ── Recent Transactions ── --}}
    <div class="card" style="border-radius:24px; border:none; box-shadow:0 10px 30px rgba(0,0,0,0.05); overflow:hidden; background:#fff;">
        <div style="padding:24px; border-bottom:1px solid var(--gray-50); display:flex; justify-content:space-between; align-items:center;">
            <h3 style="font-size:18px; font-weight:800; color:var(--dark-800); margin:0;">Transaksi Terakhir Saya</h3>
            <a href="{{ route('pos.transaction.list') }}" style="font-size:13px; color:var(--brand-600); font-weight:700; text-decoration:none;">Lihat Semua →</a>
        </div>
        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background:var(--gray-50); text-align:left;">
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase;">Kode</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase;">Waktu</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase;">Member</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase;">Total</th>
                        <th style="padding:16px 24px; font-size:12px; font-weight:700; color:var(--gray-500); text-transform:uppercase;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentTransactions as $tx)
                    <tr style="border-bottom:1px solid var(--gray-50); transition:background 0.2s;" onmouseover="this.style.background='var(--gray-50)'" onmouseout="this.style.background='transparent'">
                        <td style="padding:16px 24px;">
                            <span style="font-weight:700; color:var(--brand-600);">{{ $tx->transaction_code }}</span>
                        </td>
                        <td style="padding:16px 24px; font-size:13px; color:var(--gray-500);">
                            {{ $tx->created_at->format('H:i') }}
                        </td>
                        <td style="padding:16px 24px;">
                            <div style="font-size:13px; font-weight:600; color:var(--dark-700);">{{ $tx->member->member_name ?? 'Non-Member' }}</div>
                        </td>
                        <td style="padding:16px 24px;">
                            <span style="font-weight:800; color:var(--dark-800);">Rp {{ number_format($tx->total_amount, 0, ',', '.') }}</span>
                        </td>
                        <td style="padding:16px 24px;">
                            @if($tx->payment_status == 'completed')
                                <span style="display:inline-block; padding:4px 12px; border-radius:99px; font-size:11px; font-weight:700; background:#dcfce7; color:#166534;">Lunas</span>
                            @else
                                <div style="display:flex; align-items:center; gap:10px;">
                                    <span style="display:inline-block; padding:4px 12px; border-radius:99px; font-size:11px; font-weight:700; background:#fee2e2; color:#991b1b;">{{ ucfirst($tx->payment_status) }}</span>
                                    <button onclick="markAsPaid({{ $tx->id }})" class="btn-mark-paid" title="Tandai Sudah Bayar">
                                        ✅
                                    </button>
                                </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding:60px 24px; text-align:center; color:var(--gray-400);">Belum ada transaksi hari ini</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<style>
    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 60px rgba(249,115,22,0.35) !important;
    }
    .small-action-card {
        background: #fff;
        border-radius: 20px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        border: 1px solid var(--gray-100);
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        transition: all 0.2s ease;
    }
    .small-action-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        border-color: var(--brand-200);
    }
    .sa-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }
    .sa-label {
        font-size: 13px;
        font-weight: 700;
        color: var(--dark-800);
    }
    .btn-mark-paid {
        background: #fff;
        border: 1px solid #22c55e;
        color: #22c55e;
        width: 28px;
        height: 28px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        padding: 0;
        font-size: 12px;
    }
    .btn-mark-paid:hover {
        background: #22c55e;
        color: #fff;
        transform: scale(1.1);
    }

</style>

@endsection

@push('scripts')
<script>
    function updateBigClock() {
        const now = new Date();
        const h = String(now.getHours()).padStart(2, '0');
        const m = String(now.getMinutes()).padStart(2, '0');
        const s = String(now.getSeconds()).padStart(2, '0');
        document.getElementById('big-clock').textContent = `${h}:${m}:${s}`;
    }
    setInterval(updateBigClock, 1000);
    updateBigClock();

    function markAsPaid(id) {
        if (!confirm('Tandai transaksi ini sebagai sudah bayar (Lunas)?')) return;

        fetch(`{{ url('pos/transactions') }}/${id}/mark-as-paid`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert(result.message);
                location.reload();
            } else {
                alert('Gagal: ' + result.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan sistem');
        });
    }

    // Modal Logic
    function openPromoModal() { document.getElementById('promoModal').style.display = 'flex'; }
    function closePromoModal() { document.getElementById('promoModal').style.display = 'none'; }
    
    function openMemberModal() { document.getElementById('memberModal').style.display = 'flex'; }
    function closeMemberModal() { document.getElementById('memberModal').style.display = 'none'; }

    // Close on overlay click
    window.onclick = function(event) {
        if (event.target.className === 'modal-overlay') {
            event.target.style.display = 'none';
        }
    }
</script>
@endpush
