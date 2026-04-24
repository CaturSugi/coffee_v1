@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title')
    📊 <span>Dashboard</span> Admin
@endsection

@section('content')

{{-- ── Greeting ── --}}
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
  <div>
    <h2 style="font-size:22px; font-weight:700; color:var(--dark-800);">
      Selamat datang, {{ auth()->user()->name }}! 👋
    </h2>
    <p style="color:var(--gray-400); font-size:13px; margin-top:4px;">
      {{ now()->isoFormat('dddd, D MMMM Y') }} &mdash; Berikut ringkasan bisnis hari ini
    </p>
  </div>
  <div style="display:flex; align-items:center; gap:20px;">
    <div style="text-align:right; border-right:1px solid var(--gray-100); padding-right:20px; display:none; @media (min-width: 640px) { display: block; }">
      <div id="big-clock" style="font-size:24px; font-weight:800; color:var(--brand-600); line-height:1;">00:00:00</div>
      <div style="font-size:11px; color:var(--gray-400); margin-top:4px; font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">{{ now()->isoFormat('D MMM Y') }}</div>
    </div>
    <a href="{{ route('pos.index') }}"
       style="display:inline-flex; align-items:center; gap:8px; background:linear-gradient(135deg,var(--brand-500),var(--brand-600)); color:#fff; padding:10px 20px; border-radius:10px; font-weight:600; font-size:13px; transition:all .2s;"
       onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 8px 24px rgba(249,115,22,.35)'"
       onmouseout="this.style.transform=''; this.style.boxShadow=''">
      🛒 Buka Kasir
    </a>
  </div>
</div>

{{-- ── Stat Cards ── --}}
<div class="stat-grid">

  <div class="stat-card orange">
    <div class="stat-card-icon orange">💰</div>
    <div class="stat-value">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</div>
    <div class="stat-label">Pendapatan Hari Ini</div>
    <span class="stat-change {{ $revenueGrowth >= 0 ? 'up' : 'down' }}">
      {{ $revenueGrowth >= 0 ? '↑' : '↓' }} {{ abs($revenueGrowth) }}% vs kemarin
    </span>
  </div>

  <div class="stat-card green">
    <div class="stat-card-icon green">🧾</div>
    <div class="stat-value">{{ $todayTransactions }}</div>
    <div class="stat-label">Transaksi Hari Ini</div>
    <span class="stat-change {{ $txGrowth >= 0 ? 'up' : 'down' }}">
      {{ $txGrowth >= 0 ? '↑' : '↓' }} {{ abs($txGrowth) }}% vs kemarin
    </span>
  </div>

  <div class="stat-card blue">
    <div class="stat-card-icon blue">👥</div>
    <div class="stat-value">{{ $totalMembers }}</div>
    <div class="stat-label">Total Member</div>
    <span class="stat-change up">↑ {{ $newMembersThisMonth }} bulan ini</span>
  </div>

  <div class="stat-card" style="--accent: var(--coffee-500)">
    <div class="stat-card-icon coffee">☕</div>
    <div class="stat-value">{{ $totalProducts }}</div>
    <div class="stat-label">Total Produk Aktif</div>
    <span class="stat-change {{ $lowStockCount > 0 ? 'down' : 'up' }}">
      {{ $lowStockCount > 0 ? '⚠️ ' . $lowStockCount . ' stok menipis' : '✓ Semua stok aman' }}
    </span>
  </div>

</div>

{{-- ── Chart + Payment Method ── --}}
<div class="chart-grid">

  {{-- Revenue Chart --}}
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title">Grafik Penjualan</div>
        <div class="card-subtitle" id="chart-subtitle">7 hari terakhir</div>
      </div>
      <select class="form-select" id="chart-period" onchange="updateChart(this.value)">
        <option value="7">7 Hari</option>
        <option value="30">30 Hari</option>
      </select>
    </div>
    <div class="card-body">
      <canvas id="salesChart" height="200"></canvas>
    </div>
  </div>

  {{-- Payment Methods --}}
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title">Metode Pembayaran</div>
        <div class="card-subtitle">Bulan ini</div>
      </div>
    </div>
    <div class="card-body">
      <canvas id="paymentChart" height="160" style="margin-bottom:20px"></canvas>
      <div style="display:grid; gap:8px;">
        @foreach($paymentMethods as $pm)
        <div style="display:flex; align-items:center; gap:10px;">
          <div style="width:10px; height:10px; border-radius:50%; background:{{ $pm['color'] }};"></div>
          <span style="flex:1; font-size:13px; color:var(--gray-500);">{{ $pm['label'] }}</span>
          <span style="font-size:13px; font-weight:600; color:var(--dark-700);">{{ $pm['percent'] }}%</span>
        </div>
        @endforeach
      </div>
    </div>
  </div>

</div>

{{-- ── Bottom Row ── --}}
<div style="display:grid; grid-template-columns: 2fr 1fr; gap:20px; margin-bottom:28px;">

  {{-- Recent Transactions --}}
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title">Transaksi Terbaru</div>
        <div class="card-subtitle">Real-time</div>
      </div>
      <a href="{{ route('pos.transaction.list') }}" style="font-size:12px; color:var(--brand-500); font-weight:600;">Lihat semua →</a>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Kode</th>
            <th>Kasir</th>
            <th>Total</th>
            <th>Pembayaran</th>
            <th>Status</th>
            <th>Waktu</th>
          </tr>
        </thead>
        <tbody>
          @forelse($recentTransactions as $tx)
          <tr>
            <td><span style="font-weight:600; color:var(--brand-600);">{{ $tx->transaction_code }}</span></td>
            <td>
              <div style="display:flex; align-items:center; gap:8px;">
                <div class="avatar">{{ strtoupper(substr($tx->user->name ?? 'U', 0, 2)) }}</div>
                {{ $tx->user->name ?? '-' }}
              </div>
            </td>
            <td><strong>Rp {{ number_format($tx->total_amount, 0, ',', '.') }}</strong></td>
            <td>
              <div class="pm-badge">
                @switch($tx->payment_method)
                  @case('cash') 💵 Tunai @break
                  @case('card') 💳 Kartu @break
                  @case('qris') 📱 QRIS @break
                  @case('e-wallet') 📲 E-Wallet @break
                  @default {{ $tx->payment_method }}
                @endswitch
              </div>
            </td>
            <td>
              @switch($tx->payment_status)
                @case('completed') <span class="badge badge-success">✓ Selesai</span> @break
                @case('pending')   <span class="badge badge-warning">⏳ Pending</span> @break
                @case('cancelled') <span class="badge badge-danger">✕ Batal</span> @break
              @endswitch
            </td>
            <td style="color:var(--gray-400); font-size:12px;">{{ $tx->created_at->diffForHumans() }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="6" style="text-align:center; padding:40px; color:var(--gray-400);">
              Belum ada transaksi hari ini
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- Top Products --}}
  <div class="card">
    <div class="card-header">
      <div class="card-title">Produk Terlaris</div>
    </div>
    <div class="card-body">
      @foreach($topProducts as $i => $prod)
      <div style="display:flex; align-items:center; gap:12px; margin-bottom:16px;">
        <div style="
          width:32px; height:32px; border-radius:8px; flex-shrink:0;
          background:{{ ['linear-gradient(135deg,#f97316,#c2410c)', 'linear-gradient(135deg,#3b82f6,#1d4ed8)', 'linear-gradient(135deg,#22c55e,#15803d)', 'linear-gradient(135deg,#a855f7,#7c3aed)', 'linear-gradient(135deg,#ec4899,#be185d)'][$i % 5] }};
          display:flex; align-items:center; justify-content:center;
          font-size:14px; font-weight:700; color:#fff;">{{ $i + 1 }}</div>
        <div style="flex:1; min-width:0;">
          <div style="font-size:13px; font-weight:600; color:var(--dark-800); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
            {{ $prod->name }}
          </div>
          <div style="font-size:11px; color:var(--gray-400); margin-top:2px;">
            {{ $prod->total_sold }} terjual
          </div>
          <div class="progress" style="margin-top:6px;">
            <div class="progress-bar orange" style="width:{{ min(100, ($prod->total_sold / max(1, $topProducts->first()->total_sold)) * 100) }}%"></div>
          </div>
        </div>
        <div style="font-size:12px; font-weight:700; color:var(--brand-600); flex-shrink:0;">
          Rp {{ number_format($prod->revenue ?? 0, 0, ',', '.') }}
        </div>
      </div>
      @endforeach
    </div>
  </div>

</div>

{{-- ── Quick Actions ── --}}
<div class="card" style="margin-bottom:28px;">
  <div class="card-header">
    <div class="card-title">Aksi Cepat</div>
  </div>
  <div class="card-body">
    <div class="quick-actions">
      <a href="{{ route('pos.index') }}" class="quick-btn">
        <div class="qb-icon" style="background:rgba(249,115,22,.1);">🛒</div>
        Buka Kasir
      </a>
      <a href="{{ route('admin.products.create') }}" class="quick-btn">
        <div class="qb-icon" style="background:rgba(34,197,94,.1);">➕</div>
        Tambah Produk
      </a>
      <a href="{{ route('admin.members.create') }}" class="quick-btn">
        <div class="qb-icon" style="background:rgba(59,130,246,.1);">👤</div>
        Daftar Member
      </a>
      <a href="{{ route('admin.reports.sales') }}" class="quick-btn">
        <div class="qb-icon" style="background:rgba(168,85,247,.1);">📊</div>
        Laporan Penjualan
      </a>
      <a href="{{ route('admin.users.index') }}" class="quick-btn">
        <div class="qb-icon" style="background:rgba(236,72,153,.1);">👥</div>
        Kelola User
      </a>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const salesData = @json($salesChartData);
const paymentData = @json($paymentMethods);

// ── Sales Chart ──
// ── Premium Sales Chart ──
const salesCtx = document.getElementById('salesChart').getContext('2d');

// Create Gradients
const revenueGrad = salesCtx.createLinearGradient(0, 0, 0, 400);
revenueGrad.addColorStop(0, 'rgba(249, 115, 22, 0.4)');
revenueGrad.addColorStop(1, 'rgba(249, 115, 22, 0.05)');

const transGrad = salesCtx.createLinearGradient(0, 0, 0, 400);
transGrad.addColorStop(0, 'rgba(59, 130, 246, 0.3)');
transGrad.addColorStop(1, 'rgba(59, 130, 246, 0)');

let salesChart = new Chart(salesCtx, {
  type: 'bar',
  data: {
    labels: salesData.labels,
    datasets: [
      {
        label: 'Pendapatan',
        data: salesData.revenue,
        backgroundColor: revenueGrad,
        borderColor: '#f97316',
        borderWidth: 2,
        borderRadius: 8,
        barThickness: 20,
        maxBarThickness: 30,
        yAxisID: 'y',
        order: 2
      },
      {
        label: 'Transaksi',
        data: salesData.transactions,
        type: 'line',
        borderColor: '#3b82f6',
        backgroundColor: transGrad,
        borderWidth: 3,
        pointRadius: 4,
        pointHoverRadius: 7,
        pointBackgroundColor: '#fff',
        pointBorderColor: '#3b82f6',
        pointBorderWidth: 3,
        tension: 0.4,
        fill: true,
        yAxisID: 'y1',
        order: 1
      }
    ]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    layout: { padding: { top: 10, bottom: 0 } },
    interaction: { mode: 'index', intersect: false },
    plugins: {
      legend: { 
        display: false // We can build a custom legend for more "premium" look
      },
      tooltip: {
        backgroundColor: 'rgba(255, 255, 255, 0.95)',
        titleColor: '#1e293b',
        bodyColor: '#475569',
        borderColor: '#e2e8f0',
        borderWidth: 1,
        padding: 12,
        boxPadding: 6,
        usePointStyle: true,
        titleFont: { size: 14, weight: 'bold' },
        bodyFont: { size: 13 },
        cornerRadius: 12,
        displayColors: true,
        callbacks: {
          label: ctx => {
            const val = ctx.raw;
            if (ctx.datasetIndex === 0)
              return ` Pendapatan: Rp ${Number(val).toLocaleString('id-ID')}`;
            return ` Transaksi: ${val} pesanan`;
          }
        }
      }
    },
    scales: {
      x: { 
        grid: { display: false }, 
        ticks: { color: '#94a3b8', font: { size: 11, weight: '600' }, padding: 10 } 
      },
      y: {
        position: 'left',
        grid: { color: '#f1f5f9', borderDash: [5, 5], drawBorder: false },
        ticks: {
          color: '#94a3b8', 
          font: { size: 11, weight: '600' },
          padding: 10,
          callback: v => v >= 1000000 ? (v/1000000).toFixed(1)+'jt' : v >= 1000 ? (v/1000).toFixed(0)+'rb' : v
        }
      },
      y1: {
        position: 'right',
        grid: { display: false },
        ticks: { 
            color: '#3b82f6', 
            font: { size: 11, weight: '700' },
            padding: 10
        }
      }
    },
    animation: {
        duration: 2000,
        easing: 'easeOutQuart'
    }
  }
});

// ── Update Chart Function ──
async function updateChart(days) {
    const subtitle = document.getElementById('chart-subtitle');
    const select = document.getElementById('chart-period');
    
    // UI Feedback
    subtitle.textContent = `Memuat data ${days} hari...`;
    select.disabled = true;
    
    try {
        const response = await fetch(`{{ route('admin.dashboard.chart-data') }}?days=${days}`);
        const data = await response.json();
        
        salesChart.data.labels = data.labels;
        salesChart.data.datasets[0].data = data.revenue;
        salesChart.data.datasets[1].data = data.transactions;
        
        salesChart.update('active');
        
        subtitle.textContent = `${days} hari terakhir`;
    } catch (error) {
        console.error('Chart update error:', error);
        subtitle.textContent = 'Gagal memuat data';
    } finally {
        select.disabled = false;
    }
}

// ── Clock Logic ──
function updateBigClock() {
    const now = new Date();
    const h = String(now.getHours()).padStart(2, '0');
    const m = String(now.getMinutes()).padStart(2, '0');
    const s = String(now.getSeconds()).padStart(2, '0');
    const el = document.getElementById('big-clock');
    if (el) el.textContent = `${h}:${m}:${s}`;
}
setInterval(updateBigClock, 1000);
updateBigClock();

// ── Payment Chart ──
const payCtx = document.getElementById('paymentChart').getContext('2d');
new Chart(payCtx, {
  type: 'doughnut',
  data: {
    labels: paymentData.map(p => p.label),
    datasets: [{
      data: paymentData.map(p => p.percent),
      backgroundColor: paymentData.map(p => p.color),
      borderWidth: 0,
      hoverOffset: 6,
    }]
  },
  options: {
    responsive: true,
    cutout: '70%',
    plugins: {
      legend: { display: false },
      tooltip: {
        callbacks: { label: ctx => ` ${ctx.label}: ${ctx.raw}%` }
      }
    }
  }
});
</script>
@endpush
