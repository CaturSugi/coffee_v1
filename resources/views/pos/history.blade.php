@extends('layouts.app')

@section('title', 'Riwayat Transaksi')
@section('page-title')
    🧾 <span>Riwayat</span> Transaksi
@endsection

@section('content')

<div style="display:flex; flex-direction:column; gap:24px;">

    {{-- Stats Overview --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
        <div class="card" style="padding: 20px; border-left: 4px solid var(--brand-500); display: flex; align-items: center; gap: 15px;">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: var(--brand-50); color: var(--brand-600); display: flex; align-items: center; justify-content: center; font-size: 20px;">🧾</div>
            <div>
                <div style="font-size: 12px; color: var(--gray-400); font-weight: 600;">Total Transaksi</div>
                <div style="font-size: 20px; font-weight: 800; color: var(--dark-800);">{{ $transactions->total() }}</div>
            </div>
        </div>
        <div class="card" style="padding: 20px; border-left: 4px solid #10b981; display: flex; align-items: center; gap: 15px;">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #ecfdf5; color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 20px;">💰</div>
            <div>
                <div style="font-size: 12px; color: var(--gray-400); font-weight: 600;">Revenue (Halaman Ini)</div>
                <div style="font-size: 20px; font-weight: 800; color: var(--dark-800);">Rp {{ number_format($transactions->sum('total_amount'), 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="card" style="padding: 20px; border-left: 4px solid #f59e0b; display: flex; align-items: center; gap: 15px;">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #fffbeb; color: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 20px;">⏳</div>
            <div>
                <div style="font-size: 12px; color: var(--gray-400); font-weight: 600;">Pending</div>
                <div style="font-size: 20px; font-weight: 800; color: var(--dark-800);">{{ $transactions->where('payment_status', 'pending')->count() }}</div>
            </div>
        </div>
    </div>

    {{-- Filter Bar --}}
    <div class="card" style="padding: 24px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
        <form action="{{ route('pos.transaction.list') }}" method="GET" style="display: flex; flex-wrap: wrap; gap: 16px; align-items: flex-end;">
            <div style="flex: 2; min-width: 200px;">
                <label style="display: block; font-size: 11px; font-weight: 700; color: var(--gray-400); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Cari Transaksi</label>
                <div style="position: relative;">
                    <span style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--gray-400);">🔍</span>
                    <input type="text" name="search" class="form-control" placeholder="Masukkan kode transaksi..." value="{{ request('search') }}" style="padding-left: 40px; border-radius: 10px; border: 1px solid var(--gray-200); height: 45px;">
                </div>
            </div>
            <div style="flex: 1; min-width: 150px;">
                <label style="display: block; font-size: 11px; font-weight: 700; color: var(--gray-400); margin-bottom: 8px; text-transform: uppercase;">Status</label>
                <select name="status" class="form-select" style="border-radius: 10px; border: 1px solid var(--gray-200); height: 45px;">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>
            <div style="flex: 1; min-width: 150px;">
                <label style="display: block; font-size: 11px; font-weight: 700; color: var(--gray-400); margin-bottom: 8px; text-transform: uppercase;">Dapur</label>
                <select name="order_status" class="form-select" style="border-radius: 10px; border: 1px solid var(--gray-200); height: 45px;">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('order_status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="preparing" {{ request('order_status') == 'preparing' ? 'selected' : '' }}>Diproses</option>
                    <option value="ready" {{ request('order_status') == 'ready' ? 'selected' : '' }}>Siap</option>
                    <option value="served" {{ request('order_status') == 'served' ? 'selected' : '' }}>Disajikan</option>
                </select>
            </div>
            <div style="flex: 1; min-width: 150px;">
                <label style="display: block; font-size: 11px; font-weight: 700; color: var(--gray-400); margin-bottom: 8px; text-transform: uppercase;">Mulai</label>
                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}" style="border-radius: 10px; border: 1px solid var(--gray-200); height: 45px;">
            </div>
            <div style="flex: 1; min-width: 150px;">
                <label style="display: block; font-size: 11px; font-weight: 700; color: var(--gray-400); margin-bottom: 8px; text-transform: uppercase;">Sampai</label>
                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}" style="border-radius: 10px; border: 1px solid var(--gray-200); height: 45px;">
            </div>
            <div style="display: flex; gap: 8px;">
                <button type="submit" class="btn btn-primary" style="height: 45px; padding: 0 24px; border-radius: 10px; font-weight: 700;">Terapkan</button>
                <a href="{{ route('pos.transaction.list') }}" class="btn" style="height: 45px; width: 45px; padding: 0; display: flex; align-items: center; justify-content: center; background: var(--gray-100); color: var(--gray-600); border-radius: 10px;" title="Reset">🔄</a>
            </div>
        </form>
    </div>

    {{-- Transactions Table --}}
    <div class="card" style="border: none; box-shadow: 0 4px 25px rgba(0,0,0,0.05); overflow: hidden; border-radius: 16px;">
        <div class="table-responsive">
            <table class="table" style="margin-bottom: 0;">
                <thead style="background: var(--gray-50);">
                    <tr>
                        <th style="padding: 16px 24px; color: var(--gray-400); font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Info Transaksi</th>
                        <th style="padding: 16px 24px; color: var(--gray-400); font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Pelanggan</th>
                        <th style="padding: 16px 24px; color: var(--gray-400); font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Kasir</th>
                        <th style="padding: 16px 24px; color: var(--gray-400); font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Metode</th>
                        <th style="padding: 16px 24px; color: var(--gray-400); font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Total Bayar</th>
                        <th style="padding: 16px 24px; color: var(--gray-400); font-size: 11px; text-transform: uppercase; letter-spacing: 1px; text-align: center;">Bayar</th>
                        <th style="padding: 16px 24px; color: var(--gray-400); font-size: 11px; text-transform: uppercase; letter-spacing: 1px; text-align: center;">Dapur</th>
                        <th style="padding: 16px 24px; text-align: right; color: var(--gray-400); font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Aksi</th>
                    </tr>
                </thead>
                <tbody style="background: #fff;">
                    @forelse($transactions as $trx)
                    <tr class="table-row-hover" style="transition: all 0.2s ease; border-bottom: 1px solid var(--gray-50);">
                        <td style="padding: 16px 24px;">
                            <div style="font-weight: 800; color: var(--dark-800); font-size: 14px; margin-bottom: 4px;">{{ $trx->transaction_code }}</div>
                            <div style="font-size: 12px; color: var(--gray-400); display: flex; align-items: center; gap: 5px;">
                                📅 {{ $trx->created_at->format('d M Y') }} <span style="opacity: 0.5;">•</span> 🕒 {{ $trx->created_at->format('H:i') }}
                            </div>
                        </td>
                        <td style="padding: 16px 24px;">
                            @if($trx->member)
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--brand-50); color: var(--brand-600); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 12px;">{{ strtoupper(substr($trx->member->member_name, 0, 1)) }}</div>
                                    <div>
                                        <div style="font-weight: 700; color: var(--dark-700); font-size: 13px;">{{ $trx->member->member_name }}</div>
                                        <div style="font-size: 11px; color: var(--gray-400);">Member #{{ $trx->member->member_code }}</div>
                                    </div>
                                </div>
                            @else
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--gray-100); color: var(--gray-500); display: flex; align-items: center; justify-content: center; font-size: 14px;">👤</div>
                                    <div style="font-weight: 600; color: var(--gray-500); font-size: 13px;">Pelanggan Umum</div>
                                </div>
                            @endif
                        </td>
                        <td style="padding: 16px 24px;">
                            <div style="font-size: 13px; color: var(--dark-700); font-weight: 500;">{{ $trx->user->name ?? 'System' }}</div>
                        </td>
                        <td style="padding: 16px 24px;">
                            <span style="font-size: 11px; font-weight: 700; background: var(--gray-100); color: var(--gray-600); padding: 4px 8px; border-radius: 6px; text-transform: uppercase;">💳 {{ $trx->payment_method }}</span>
                        </td>
                        <td style="padding: 16px 24px;">
                            <div style="font-weight: 800; color: var(--dark-800); font-size: 15px;">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</div>
                            <div style="font-size: 10px; color: var(--gray-400);">{{ $trx->details->count() }} Item(s)</div>
                        </td>
                        <td style="padding: 16px 24px; text-align: center;">
                            @if($trx->payment_status == 'completed')
                                <span style="display: inline-block; padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; background: #d1fae5; color: #065f46;">Lunas</span>
                            @elseif($trx->payment_status == 'pending')
                                <span style="display: inline-block; padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; background: #fef3c7; color: #92400e;">Pending</span>
                            @else
                                <span style="display: inline-block; padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; background: #fee2e2; color: #991b1b;">Batal</span>
                            @endif
                        </td>
                        <td style="padding: 16px 24px; text-align: center;">
                            {!! $trx->order_status_badge !!}
                        </td>
                        <td style="padding: 16px 24px; text-align: right;">
                            <div style="display: flex; gap: 6px; justify-content: flex-end;">
                                <button onclick="viewDetail({{ $trx->id }})" class="action-btn" title="Liat Detail">👁️</button>
                                <a href="{{ route('pos.print.pdf', $trx->id) }}" target="_blank" class="action-btn" title="Download PDF" style="background: var(--brand-50); color: var(--brand-600);">📄</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 80px 24px;">
                            <div style="font-size: 60px; margin-bottom: 20px; opacity: 0.2;">🧾</div>
                            <h3 style="color: var(--gray-400); font-weight: 600; margin-bottom: 10px;">Tidak Ada Data Transaksi</h3>
                            <p style="color: var(--gray-300); font-size: 14px;">Coba gunakan filter lain atau cari kata kunci berbeda.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div style="margin-top: 10px;">
        {{ $transactions->links('partials.pagination') }}
    </div>

</div>

{{-- Detail Modal --}}
<div id="detail-modal" class="modal-overlay" style="display: none; align-items: center; justify-content: center; transition: opacity 0.3s ease; z-index: 9999; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px);">
    <div id="modal-container" style="
        background: #fff; 
        border-radius: 24px; 
        width: 500px; 
        max-width: 95%; 
        max-height: 90vh; 
        display: flex; 
        flex-direction: column; 
        overflow: hidden; 
        box-shadow: 0 30px 60px rgba(0,0,0,0.4);
        transform: translateY(30px);
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    ">
        <div class="card-header" style="background: var(--dark-800); color: #fff; display: flex; justify-content: space-between; align-items: center; padding: 20px 28px; flex-shrink: 0;">
            <div style="display: flex; flex-direction: column;">
                <span style="font-size: 10px; color: rgba(255,255,255,0.5); letter-spacing: 2px; font-weight: 800; margin-bottom: 4px;">INVOICE DETAIL</span>
                <span id="modal-code-header" style="font-size: 18px; font-weight: 800; color: #fff; font-family: 'JetBrains Mono', monospace;">-</span>
            </div>
            <button onclick="closeModal()" style="background: rgba(255,255,255,0.1); border: none; color: #fff; width: 36px; height: 36px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s;">✕</button>
        </div>
        
        <div id="modal-content" style="flex: 1; overflow-y: auto; padding: 28px;">
            <div style="text-align: center; padding: 60px 0;">
                <div class="spinner"></div>
                <p style="margin-top: 15px; color: var(--gray-400); font-size: 14px;">Mengambil data transaksi...</p>
            </div>
        </div>

        <div style="padding: 20px 28px; background: var(--gray-50); border-top: 1px solid var(--gray-100); display: flex; gap: 12px; flex-shrink: 0;">
            <button onclick="closeModal()" class="btn" style="flex: 1; height: 52px; background: #fff; border: 1px solid var(--gray-200); color: var(--dark-700); font-weight: 800; border-radius: 14px; transition: all 0.2s;">Tutup</button>
            <button id="modal-print-btn" class="btn btn-primary" style="flex: 1; height: 52px; font-weight: 800; border-radius: 14px; box-shadow: 0 8px 15px rgba(234, 88, 12, 0.2);">🖨️ Cetak Struk</button>
        </div>
    </div>
</div>

<style>
    .table-row-hover:hover {
        background-color: var(--gray-50) !important;
        cursor: pointer;
    }
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
    
    @media (max-width: 640px) {
        #modal-container {
            width: 100% !important;
            max-width: 100% !important;
            height: 100% !important;
            max-height: 100% !important;
            border-radius: 0 !important;
            transform: translateY(100%) !important;
        }
        #detail-modal.active #modal-container {
            transform: translateY(0) !important;
        }
        #modal-content {
            padding: 24px !important;
        }
    }
    
    .spinner {
        width: 34px;
        height: 34px;
        border: 4px solid var(--gray-100);
        border-top: 4px solid var(--brand-500);
        border-radius: 50%;
        margin: 0 auto;
        animation: spin 0.8s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
    
    #detail-modal.active { opacity: 1 !important; display: flex !important; }
    #detail-modal.active #modal-container { transform: translateY(0); }
</style>

@endsection

@push('scripts')
<script>
    async function viewDetail(id) {
        const modal = document.getElementById('detail-modal');
        const content = document.getElementById('modal-content');
        const printBtn = document.getElementById('modal-print-btn');
        const codeHeader = document.getElementById('modal-code-header');
        
        modal.style.display = 'flex';
        // Trigger animation
        setTimeout(() => modal.classList.add('active'), 10);
        
        content.innerHTML = `
            <div style="text-align: center; padding: 60px 0;">
                <div class="spinner"></div>
                <p style="margin-top: 15px; color: var(--gray-400); font-size: 14px;">Mengambil data transaksi...</p>
            </div>
        `;
        codeHeader.textContent = '-';

        try {
            const response = await fetch(`{{ url('pos/transactions') }}/${id}`);
            const result = await response.json();

            if (result.success) {
                const trx = result.data;
                codeHeader.textContent = trx.transaction_code;
                
                let itemsHtml = '';
                trx.details.forEach(item => {
                    itemsHtml += `
                        <div style="display: flex; gap: 14px; padding: 14px 0; border-bottom: 1px solid var(--gray-50);">
                            <div style="width: 48px; height: 48px; border-radius: 12px; background: var(--gray-100); flex-shrink: 0; overflow: hidden; border: 1px solid var(--gray-100);">
                                <img src="${item.product.image_url}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='{{ asset('images/product-placeholder.png') }}'">
                            </div>
                            <div style="flex: 1;">
                                <div style="font-size: 14px; font-weight: 800; color: var(--dark-800); margin-bottom: 2px;">${item.product.name}</div>
                                <div style="font-size: 12px; color: var(--gray-400); font-weight: 600;">${item.quantity} x Rp ${new Intl.NumberFormat('id-ID').format(item.unit_price)}</div>
                            </div>
                            <div style="font-weight: 800; font-size: 14px; color: var(--dark-800); text-align: right; display: flex; align-items: center;">
                                Rp ${new Intl.NumberFormat('id-ID').format(item.subtotal)}
                            </div>
                        </div>
                    `;
                });

                content.innerHTML = `
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 28px; padding: 20px; background: var(--gray-50); border-radius: 16px; border: 1px solid var(--gray-100);">
                        <div>
                            <div style="font-size: 10px; color: var(--gray-400); margin-bottom: 4px; text-transform: uppercase; font-weight: 800; letter-spacing: 0.5px;">Waktu Transaksi</div>
                            <div style="font-size: 13px; font-weight: 700; color: var(--dark-800);">${new Date(trx.created_at).toLocaleString('id-ID', {dateStyle: 'medium', timeStyle: 'short'})}</div>
                        </div>
                        <div>
                            <div style="font-size: 10px; color: var(--gray-400); margin-bottom: 4px; text-transform: uppercase; font-weight: 800; letter-spacing: 0.5px;">Metode Bayar</div>
                            <div style="font-size: 13px; font-weight: 700; color: var(--dark-800); display: flex; align-items: center; gap: 5px;">💳 ${trx.payment_method.toUpperCase()}</div>
                        </div>
                        <div>
                            <div style="font-size: 10px; color: var(--gray-400); margin-bottom: 4px; text-transform: uppercase; font-weight: 800; letter-spacing: 0.5px;">Petugas Kasir</div>
                            <div style="font-size: 13px; font-weight: 700; color: var(--dark-800);">${trx.user ? trx.user.name : 'System'}</div>
                        </div>
                        <div>
                            <div style="font-size: 10px; color: var(--gray-400); margin-bottom: 4px; text-transform: uppercase; font-weight: 800; letter-spacing: 0.5px;">Member</div>
                            <div style="font-size: 13px; font-weight: 700; color: var(--brand-600);">${trx.member ? trx.member.member_name : 'Umum (Guest)'}</div>
                        </div>
                    </div>

                    <div style="margin-bottom: 15px; font-weight: 800; font-size: 16px; color: var(--dark-800); display: flex; align-items: center; gap: 10px;">
                        <span style="background: var(--brand-50); color: var(--brand-600); width: 30px; height: 30px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 14px;">📦</span> 
                        Daftar Pesanan
                    </div>
                    <div style="margin-bottom: 28px; max-height: 250px; overflow-y: auto; padding-right: 5px;">${itemsHtml}</div>

                    <div style="background: var(--dark-800); padding: 24px; border-radius: 24px; color: #fff; box-shadow: 0 15px 30px rgba(0,0,0,0.25); position: relative; overflow: hidden;">
                        <div style="position: absolute; top: -20px; right: -20px; font-size: 100px; opacity: 0.05; pointer-events: none;">☕</div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 13px; opacity: 0.6; font-weight: 600;">
                            <span>Subtotal</span>
                            <span>Rp ${new Intl.NumberFormat('id-ID').format(trx.subtotal)}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 13px; opacity: 0.6; font-weight: 600;">
                            <span>Pajak Resto (10%)</span>
                            <span>Rp ${new Intl.NumberFormat('id-ID').format(trx.tax_amount)}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 16px; font-size: 13px; color: #fb7185; font-weight: 700;">
                            <span>Potongan Diskon</span>
                            <span>- Rp ${new Intl.NumberFormat('id-ID').format(trx.discount_amount)}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding-top: 16px; border-top: 1px dashed rgba(255,255,255,0.15); font-size: 22px; font-weight: 900; color: #fff;">
                            <span>TOTAL</span>
                            <span>Rp ${new Intl.NumberFormat('id-ID').format(trx.total_amount)}</span>
                        </div>
                    </div>
                `;

                printBtn.onclick = () => printThermal(trx.id);
            }
        } catch (e) {
            content.innerHTML = `
                <div style="text-align: center; padding: 50px 20px; color: var(--danger);">
                    <div style="font-size: 50px; margin-bottom: 15px;">⚠️</div>
                    <p style="margin-top: 10px; font-weight: 700; font-size: 16px;">Gagal Memuat Data</p>
                    <p style="font-size: 13px; opacity: 0.7; margin-bottom: 20px;">Koneksi terputus atau server sedang sibuk.</p>
                    <button onclick="viewDetail(${id})" class="btn btn-primary" style="width: auto; padding: 10px 25px; border-radius: 10px;">Coba Lagi</button>
                </div>
            `;
        }
    }

    function closeModal() {
        const modal = document.getElementById('detail-modal');
        modal.classList.remove('active');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

    async function printThermal(id) {
        try {
            const btn = document.getElementById('modal-print-btn');
            const originalText = btn.innerHTML;
            btn.innerHTML = '⌛ Mencetak...';
            btn.disabled = true;

            const response = await fetch(`{{ url('pos/transactions') }}/${id}/print-thermal`, {
                method: 'POST',
                headers: { 
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            });
            const result = await response.json();
            
            btn.innerHTML = originalText;
            btn.disabled = false;
            
            if (result.success) {
                alert('✅ Berhasil mencetak struk!');
            } else {
                alert('❌ ' + result.message);
            }
        } catch (e) {
            alert('❌ Terjadi kesalahan saat menghubungi printer.');
            const btn = document.getElementById('modal-print-btn');
            btn.innerHTML = '🖨️ Cetak Struk';
            btn.disabled = false;
        }
    }

    window.onclick = function(event) {
        const modal = document.getElementById('detail-modal');
        if (event.target == modal) closeModal();
    }
</script>
@endpush
