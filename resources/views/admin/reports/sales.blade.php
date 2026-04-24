@extends('layouts.app')

@section('title', 'Laporan Penjualan')
@section('page-title')
    📊 <span>Laporan</span> Penjualan
@endsection

@section('content')

<div style="display:flex; flex-direction:column; gap:28px;">

    {{-- ── Filter & Export ── --}}
    <div style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:20px;">
        <div class="card" style="padding:20px 24px; border:none; box-shadow:0 4px 20px rgba(0,0,0,0.05); border-radius:16px; flex:1; min-width:300px;">
            <form method="GET" action="{{ route('admin.reports.sales') }}" style="display:flex; align-items:flex-end; gap:16px; flex-wrap:wrap;">
                <div style="flex:1; min-width:140px;">
                    <label style="display:block; font-size:11px; font-weight:700; color:var(--gray-400); margin-bottom:8px; text-transform:uppercase;">Dari Tanggal</label>
                    <input type="date" name="start_date" value="{{ $startDate }}" class="form-control" style="height:45px; border-radius:10px;">
                </div>
                <div style="flex:1; min-width:140px;">
                    <label style="display:block; font-size:11px; font-weight:700; color:var(--gray-400); margin-bottom:8px; text-transform:uppercase;">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ $endDate }}" class="form-control" style="height:45px; border-radius:10px;">
                </div>
                <button type="submit" class="btn btn-primary" style="height:45px; padding:0 24px; border-radius:10px; font-weight:700;">Filter Data</button>
            </form>
        </div>

        <div style="display:flex; gap:12px;">
            <a href="{{ route('admin.reports.export', ['type' => 'pdf', 'start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn" style="height:48px; padding:0 20px; background:#fff; border:1px solid #ef4444; color:#ef4444; border-radius:12px; font-weight:700; display:flex; align-items:center; gap:8px;">
                <span>📄</span> Export PDF
            </a>
            <a href="{{ route('admin.reports.export', ['type' => 'csv', 'start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn" style="height:48px; padding:0 20px; background:#fff; border:1px solid #10b981; color:#10b981; border-radius:12px; font-weight:700; display:flex; align-items:center; gap:8px;">
                <span>📊</span> Export CSV
            </a>
        </div>
    </div>

    {{-- ── Summary Stats ── --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:24px;">
        <div class="card stat-card-premium">
            <div class="icon" style="background:rgba(234, 88, 12, 0.1); color:var(--brand-600);">💰</div>
            <div class="info">
                <div class="label">Total Pendapatan</div>
                <div class="value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="card stat-card-premium">
            <div class="icon" style="background:rgba(59, 130, 246, 0.1); color:#3b82f6;">🧾</div>
            <div class="info">
                <div class="label">Total Transaksi</div>
                <div class="value">{{ number_format($totalTransactions, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="card stat-card-premium">
            <div class="icon" style="background:rgba(16, 185, 129, 0.1); color:#10b981;">📦</div>
            <div class="info">
                <div class="label">Produk Terjual</div>
                <div class="value">{{ number_format($totalItems, 0, ',', '.') }} Item</div>
            </div>
        </div>
        <div class="card stat-card-premium">
            <div class="icon" style="background:rgba(139, 92, 246, 0.1); color:#8b5cf6;">✨</div>
            <div class="info">
                <div class="label">Rata-rata Transaksi</div>
                <div class="value">Rp {{ number_format($avgTransaction, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    {{-- ── Chart Section ── --}}
    <div class="card" style="padding:32px; border:none; box-shadow:0 4px 25px rgba(0,0,0,0.05); border-radius:20px;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
            <h3 style="font-size:18px; font-weight:800; color:var(--dark-800);">Tren Penjualan</h3>
            <div style="font-size:12px; color:var(--gray-400); font-weight:600;">Data per hari</div>
        </div>
        <div style="height:300px; position:relative;">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    {{-- ── Transactions Table ── --}}
    <div class="card" style="border:none; box-shadow:0 4px 25px rgba(0,0,0,0.05); border-radius:20px; overflow:hidden;">
        <div style="padding:24px; border-bottom:1px solid var(--gray-50); background:#fff; display:flex; justify-content:space-between; align-items:center;">
            <h3 style="font-size:16px; font-weight:800; color:var(--dark-800);">Detail Transaksi</h3>
            <div style="font-size:13px; color:var(--gray-400);">Menampilkan {{ $transactions->count() }} data terbaru</div>
        </div>
        <div class="table-responsive">
            <table class="table" style="margin-bottom:0;">
                <thead style="background:var(--gray-50);">
                    <tr>
                        <th style="padding:16px 24px; color:var(--gray-400); font-size:11px; text-transform:uppercase; letter-spacing:1px;">ID & Tanggal</th>
                        <th style="padding:16px 24px; color:var(--gray-400); font-size:11px; text-transform:uppercase; letter-spacing:1px;">Pelanggan</th>
                        <th style="padding:16px 24px; color:var(--gray-400); font-size:11px; text-transform:uppercase; letter-spacing:1px;">Metode</th>
                        <th style="padding:16px 24px; color:var(--gray-400); font-size:11px; text-transform:uppercase; letter-spacing:1px; text-align:right;">Subtotal</th>
                        <th style="padding:16px 24px; color:var(--gray-400); font-size:11px; text-transform:uppercase; letter-spacing:1px; text-align:right;">Diskon</th>
                        <th style="padding:16px 24px; color:var(--gray-400); font-size:11px; text-transform:uppercase; letter-spacing:1px; text-align:right;">Total</th>
                        <th style="padding:16px 24px; color:var(--gray-400); font-size:11px; text-transform:uppercase; letter-spacing:1px; text-align:center;">Status</th>
                    </tr>
                </thead>
                <tbody style="background:#fff;">
                    @foreach($transactions as $trx)
                    <tr style="border-bottom:1px solid var(--gray-50);">
                        <td style="padding:16px 24px;">
                            <div style="font-weight:800; color:var(--dark-800); font-size:14px;">#{{ $trx->transaction_code }}</div>
                            <div style="font-size:12px; color:var(--gray-400);">{{ $trx->created_at->format('d M Y, H:i') }}</div>
                        </td>
                        <td style="padding:16px 24px;">
                            <div style="font-weight:700; color:var(--dark-700); font-size:13px;">{{ $trx->member->user->name ?? 'Guest' }}</div>
                            <div style="font-size:11px; color:var(--gray-400);">Kasir: {{ $trx->user->name }}</div>
                        </td>
                        <td style="padding:16px 24px;">
                            <span style="padding:4px 10px; border-radius:8px; font-size:10px; font-weight:800; background:var(--gray-100); color:var(--dark-600); text-transform:uppercase;">{{ $trx->payment_method }}</span>
                        </td>
                        <td style="padding:16px 24px; text-align:right; font-weight:600; color:var(--gray-500);">Rp {{ number_format($trx->subtotal, 0, ',', '.') }}</td>
                        <td style="padding:16px 24px; text-align:right; font-weight:600; color:#ef4444;">- Rp {{ number_format($trx->discount_amount, 0, ',', '.') }}</td>
                        <td style="padding:16px 24px; text-align:right;">
                            <div style="font-weight:900; color:var(--dark-800); font-size:15px;">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</div>
                        </td>
                        <td style="padding:16px 24px; text-align:center;">
                            <div style="display:flex; align-items:center; justify-content:center; gap:8px;">
                                {!! $trx->payment_status_badge !!}
                                @if($trx->payment_status !== 'completed')
                                    <button onclick="markAsPaid({{ $trx->id }})" class="btn-mark-paid" title="Tandai Lunas">✅</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- ── Pagination ── --}}
    <div style="margin-top: 10px;">
        {{ $transactions->links('partials.pagination') }}
    </div>

</div>

<style>
    .stat-card-premium {
        padding: 24px;
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 20px;
        transition: transform 0.3s;
    }
    .stat-card-premium:hover { transform: translateY(-5px); }
    .stat-card-premium .icon {
        width: 56px;
        height: 56px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    .stat-card-premium .label {
        font-size: 11px;
        font-weight: 800;
        color: var(--gray-400);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }
    .stat-card-premium .value {
        font-size: 22px;
        font-weight: 900;
        color: var(--dark-800);
    }
    .btn-mark-paid {
        background: #fff;
        border: 1px solid #22c55e;
        color: #22c55e;
        width: 26px;
        height: 26px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        padding: 0;
        font-size: 11px;
    }
    .btn-mark-paid:hover {
        background: #22c55e;
        color: #fff;
        transform: scale(1.1);
    }
</style>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(234, 88, 12, 0.2)');
    gradient.addColorStop(1, 'rgba(234, 88, 12, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartData->pluck('date')) !!},
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: {!! json_encode($chartData->pluck('total')) !!},
                borderColor: '#ea580c',
                borderWidth: 4,
                backgroundColor: gradient,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#ea580c',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1f2937',
                    padding: 12,
                    titleFont: { size: 14, weight: 'bold' },
                    bodyFont: { size: 13 },
                    callbacks: {
                        label: function(context) {
                            return ' Pendapatan: Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f3f4f6' },
                    ticks: {
                        font: { size: 11, weight: '600' },
                        color: '#9ca3af',
                        callback: function(value) {
                            if (value >= 1000000) return 'Rp ' + (value/1000000) + 'jt';
                            if (value >= 1000) return 'Rp ' + (value/1000) + 'rb';
                            return 'Rp ' + value;
                        }
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: {
                        font: { size: 11, weight: '600' },
                        color: '#9ca3af'
                    }
                }
            }
        }
    });

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
</script>
@endpush
