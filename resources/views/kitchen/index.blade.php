@extends('layouts.app')

@section('title', 'Kitchen Display System')

@section('content')
<div class="kds-container">
    
    <div class="kds-header">
        <div class="header-title">
            <h2 style="font-size:24px; font-weight:800; color:var(--dark-800); margin:0;">☕ Barista & Kitchen Board</h2>
            <p style="color:var(--gray-400); font-size:14px; margin-top:4px;">Kelola pesanan aktif yang sedang mengantre.</p>
        </div>
        <div class="header-actions">
            <div id="live-timer" class="live-timer">00:00:00</div>
            <button onclick="location.reload()" class="btn btn-dark refresh-btn">
                <span>🔄</span> Refresh
            </button>
        </div>
    </div>

    {{-- Auto Refresh Progress Bar --}}
    <div class="refresh-progress-container">
        <div id="refresh-progress" class="refresh-progress-bar"></div>
    </div>

    {{-- KDS Board Grid --}}
    <div class="kds-grid">
        @forelse($orders as $order)
        <div class="order-card" data-id="{{ $order->id }}">
            
            {{-- Card Header --}}
            <div class="order-card-header" style="background:{{ $order->order_status == 'ready' ? '#f0fdf4' : 'var(--gray-50)' }};">
                <div>
                    <div class="order-code">#{{ $order->transaction_code }}</div>
                    <h3 class="customer-name">{{ $order->member->member_name ?? 'Pelanggan Umum' }}</h3>
                </div>
                <div class="order-status-info">
                    <div class="time-ago" data-time="{{ $order->created_at->toIso8601String() }}">0m ago</div>
                    <div style="margin-top:5px;">{!! $order->order_status_badge !!}</div>
                </div>
            </div>

            {{-- Card Items --}}
            <div class="order-card-body">
                <div class="order-items-list">
                    @foreach($order->details as $item)
                    <div class="order-item">
                        <div style="display:flex; gap:12px; align-items:center;">
                            <div class="item-qty">{{ $item->quantity }}</div>
                            <div class="item-name">{{ $item->product->name ?? 'Produk Tidak Ditemukan' }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @if($order->notes)
                <div class="order-note">
                    <strong>Note:</strong> {{ $order->notes }}
                </div>
                @endif
            </div>

            {{-- Card Footer / Actions --}}
            <div class="order-card-footer">
                @if($order->order_status == 'pending')
                    <button onclick="updateStatus({{ $order->id }}, 'preparing')" class="btn btn-primary action-btn">Mulai Proses</button>
                @elseif($order->order_status == 'preparing')
                    <button onclick="updateStatus({{ $order->id }}, 'ready')" class="btn btn-warning action-btn" style="background:#fbbf24; border:none; color:#92400e;">✅ Siap Diambil</button>
                @elseif($order->order_status == 'ready')
                    <button onclick="updateStatus({{ $order->id }}, 'served')" class="btn btn-success action-btn" style="background:#22c55e; border:none;">🚀 Sajikan</button>
                @endif
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div style="font-size:80px; margin-bottom:20px;">🎉</div>
            <h3 style="font-size:24px; font-weight:800;">Semua Pesanan Selesai!</h3>
            <p>Tidak ada antrean saat ini. Waktunya istirahat sejenak ☕</p>
        </div>
        @endforelse
    </div>

</div>

<style>
    .kds-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        min-height: calc(100vh - 120px);
    }

    .kds-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .header-actions {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .live-timer {
        font-family: 'JetBrains Mono', monospace;
        font-weight: 700;
        color: var(--brand-600);
        background: var(--brand-50);
        padding: 8px 15px;
        border-radius: 10px;
        white-space: nowrap;
    }

    .refresh-btn {
        padding: 10px 20px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .refresh-progress-container {
        width: 100%;
        height: 4px;
        background: var(--gray-100);
        border-radius: 2px;
        overflow: hidden;
    }

    .refresh-progress-bar {
        width: 0%;
        height: 100%;
        background: var(--brand-500);
        transition: width 1s linear;
    }

    .kds-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 25px;
        padding-bottom: 40px;
    }

    .order-card {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        border: 1px solid var(--gray-100);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .order-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
        border-color: var(--brand-200);
    }

    .order-card-header {
        padding: 20px;
        border-bottom: 1px solid var(--gray-100);
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .order-code {
        font-size: 11px;
        font-weight: 800;
        color: var(--gray-400);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 4px;
    }

    .customer-name {
        font-size: 18px;
        font-weight: 900;
        color: var(--dark-800);
        margin: 0;
    }

    .order-status-info {
        text-align: right;
    }

    .time-ago {
        font-size: 12px;
        font-weight: 700;
        color: var(--brand-600);
    }

    .order-card-body {
        padding: 20px;
        flex: 1;
    }

    .order-items-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 10px;
        border-bottom: 1px dashed var(--gray-100);
    }

    .item-qty {
        width: 32px;
        height: 32px;
        background: var(--brand-50);
        color: var(--brand-600);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 14px;
    }

    .item-name {
        font-weight: 700;
        color: var(--dark-700);
        font-size: 15px;
    }

    .order-note {
        margin-top: 15px;
        padding: 12px;
        background: #fff7ed;
        border-left: 4px solid #f97316;
        border-radius: 8px;
        font-size: 13px;
        color: #9a3412;
    }

    .order-card-footer {
        padding: 15px 20px;
        background: var(--gray-50);
        border-top: 1px solid var(--gray-100);
        display: flex;
        gap: 10px;
    }

    .action-btn {
        flex: 1;
        font-weight: 700;
        border-radius: 12px;
        padding: 12px;
    }

    .empty-state {
        grid-column: 1/-1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 100px 20px;
        color: var(--gray-300);
        text-align: center;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .kds-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .header-actions {
            width: 100%;
            justify-content: space-between;
        }

        .kds-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .customer-name {
            font-size: 16px;
        }

        .order-card {
            border-radius: 16px;
        }
    }

    @media (max-width: 480px) {
        .live-timer {
            font-size: 12px;
            padding: 6px 10px;
        }
        
        .refresh-btn {
            font-size: 13px;
            padding: 8px 15px;
        }
    }
</style>
@endsection

@push('scripts')
<script>
    function updateStatus(id, status) {
        if (!confirm('Yakin ingin mengubah status pesanan ini?')) return;

        fetch(`{{ url('kitchen') }}/${id}/status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                location.reload();
            } else {
                alert('Gagal memperbarui status');
            }
        });
    }

    function updateTimeAgo() {
        document.querySelectorAll('.time-ago').forEach(el => {
            const startTime = new Date(el.dataset.time);
            const now = new Date();
            const diffMs = now - startTime;
            const diffMins = Math.floor(diffMs / 60000);
            
            if (diffMins < 1) {
                el.textContent = 'Just now';
            } else {
                el.textContent = diffMins + 'm ago';
            }

            // Change color if too long
            if (diffMins > 10) el.style.color = '#ef4444';
            else if (diffMins > 5) el.style.color = '#f59e0b';
        });
    }

    function updateLiveTimer() {
        const now = new Date();
        document.getElementById('live-timer').textContent = now.toLocaleTimeString('id-ID');
    }

    setInterval(updateTimeAgo, 30000);
    setInterval(updateLiveTimer, 1000);
    updateTimeAgo();
    updateLiveTimer();

    // Auto refresh logic (15 seconds)
    let secondsLeft = 15;
    const progressBar = document.getElementById('refresh-progress');
    
    setInterval(() => {
        secondsLeft--;
        let percentage = ((15 - secondsLeft) / 15) * 100;
        progressBar.style.width = percentage + '%';
        
        if (secondsLeft <= 0) {
            location.reload();
        }
    }, 1000);
</script>
@endpush
