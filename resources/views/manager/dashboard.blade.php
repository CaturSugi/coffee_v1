@extends('layouts.app')

@section('title', 'Manager Dashboard')
@section('page-title')
    📊 <span>Dashboard</span> Manager
@endsection

@section('content')

{{-- ── Greeting ── --}}
<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
  <div>
    <h2 style="font-size:22px; font-weight:700; color:var(--dark-800);">
      Halo Manager, {{ auth()->user()->name }}! ☕
    </h2>
    <p style="color:var(--gray-400); font-size:13px; margin-top:4px;">
      {{ now()->isoFormat('dddd, D MMMM Y') }} &mdash; Pantau performa coffee shop Anda
    </p>
  </div>
  <div style="display:flex; align-items:center; gap:20px;">
    <div style="text-align:right; border-right:1px solid var(--gray-100); padding-right:20px;">
      <div id="big-clock" style="font-size:24px; font-weight:800; color:var(--brand-600); line-height:1;">00:00:00</div>
      <div style="font-size:11px; color:var(--gray-400); margin-top:4px; font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">{{ now()->isoFormat('D MMM Y') }}</div>
    </div>
    <div style="display:flex; gap:10px;">
      <a href="{{ route('manager.promotions.index') }}" 
         style="display:inline-flex; align-items:center; gap:8px; background:var(--dark-800); color:#fff; padding:10px 18px; border-radius:10px; font-weight:600; font-size:13px; transition:all .2s;"
         onmouseover="this.style.background='#000'"
         onmouseout="this.style.background='var(--dark-800)'">
        📢 Promo Aktif
      </a>
      <a href="{{ route('manager.reports.sales') }}" 
         style="display:inline-flex; align-items:center; gap:8px; background:linear-gradient(135deg,var(--brand-500),var(--brand-600)); color:#fff; padding:10px 18px; border-radius:10px; font-weight:600; font-size:13px; transition:all .2s;"
         onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 8px 24px rgba(249,115,22,.35)'"
         onmouseout="this.style.transform=''; this.style.boxShadow=''">
        📈 Laporan Detail
      </a>
    </div>
  </div>
</div>

{{-- ── Stat Cards ── --}}
<div class="stat-grid">

  <div class="stat-card orange">
    <div class="stat-card-icon orange">💰</div>
    <div class="stat-value">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</div>
    <div class="stat-label">Pendapatan Hari Ini</div>
    <span class="stat-change {{ $revenueGrowth >= 0 ? 'up' : 'down' }}">
      {{ $revenueGrowth >= 0 ? '↑' : '↓' }} {{ abs(round($revenueGrowth, 1)) }}% vs kemarin
    </span>
  </div>

  <div class="stat-card green">
    <div class="stat-card-icon green">🧾</div>
    <div class="stat-value">{{ $todayTransactions }}</div>
    <div class="stat-label">Transaksi Hari Ini</div>
    <span class="stat-change {{ $txGrowth >= 0 ? 'up' : 'down' }}">
      {{ $txGrowth >= 0 ? '↑' : '↓' }} {{ abs(round($txGrowth, 1)) }}% vs kemarin
    </span>
  </div>

  <div class="stat-card blue">
    <div class="stat-card-icon blue">👥</div>
    <div class="stat-value">{{ $totalMembers }}</div>
    <div class="stat-label">Total Member</div>
    <span class="stat-change up">↑ {{ $newMembersThisMonth }} baru bulan ini</span>
  </div>

  <div class="stat-card purple">
    <div class="stat-card-icon purple">🎁</div>
    <div class="stat-value">{{ $activePromotions }}</div>
    <div class="stat-label">Promo Berjalan</div>
    <span class="stat-change up">Cek performa promo</span>
  </div>

</div>

{{-- ── Main Charts ── --}}
<div class="chart-grid" style="grid-template-columns: 1fr; margin-bottom: 28px;">
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title">Tren Penjualan & Transaksi</div>
        <div class="card-subtitle" id="chart-subtitle">7 hari terakhir</div>
      </div>
      <select class="form-select" id="chart-period" onchange="updateChart(this.value)" style="width:auto; padding:6px 12px; border-radius:8px; font-size:12px; border:1px solid var(--gray-200); cursor:pointer;">
        <option value="7">7 Hari</option>
        <option value="30">30 Hari</option>
      </select>
    </div>
    <div class="card-body">
      <canvas id="managerSalesChart" height="100"></canvas>
    </div>
  </div>
</div>

<div style="display:grid; grid-template-columns: 1.5fr 1fr; gap:20px;">
  
  {{-- Top Products --}}
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title">Produk Terlaris</div>
        <div class="card-subtitle">Berdasarkan volume penjualan</div>
      </div>
    </div>
    <div class="card-body">
      <div style="display:grid; gap:16px;">
        @foreach($topProducts as $i => $prod)
        <div style="display:flex; align-items:center; gap:15px;">
          <div style="width:40px; height:40px; border-radius:12px; background:var(--gray-100); display:flex; align-items:center; justify-content:center; font-weight:700; color:var(--dark-800);">
            {{ $i + 1 }}
          </div>
          <div style="flex:1;">
            <div style="display:flex; justify-content:space-between; margin-bottom:6px;">
              <span style="font-weight:600; color:var(--dark-800);">{{ $prod->name }}</span>
              <span style="font-size:13px; color:var(--gray-500);">{{ $prod->total_sold }} Cup</span>
            </div>
            <div class="progress" style="height:6px;">
              <div class="progress-bar orange" style="width:{{ ($prod->total_sold / $topProducts->first()->total_sold) * 100 }}%"></div>
            </div>
          </div>
          <div style="text-align:right; min-width:100px;">
            <div style="font-weight:700; color:var(--brand-600);">Rp {{ number_format($prod->revenue, 0, ',', '.') }}</div>
            <div style="font-size:11px; color:var(--gray-400);">Total Revenue</div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  {{-- Recent Promotions --}}
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title">Promo Terbaru</div>
        <div class="card-subtitle">Manajemen promosi</div>
      </div>
      <a href="{{ route('manager.promotions.index') }}" style="font-size:12px; color:var(--brand-500); font-weight:600;">Lihat semua</a>
    </div>
    <div class="card-body" style="padding:0;">
      @foreach($recentPromotions as $promo)
      <div style="padding:15px 20px; border-bottom:1px solid var(--gray-100); display:flex; align-items:center; gap:12px;">
        <div style="font-size:20px;">{{ $promo->type == 'discount' ? '🏷️' : '🎁' }}</div>
        <div style="flex:1;">
          <div style="font-weight:600; color:var(--dark-800); font-size:13px;">{{ $promo->name }}</div>
          <div style="font-size:11px; color:var(--gray-400);">{{ $promo->code }} &bull; {{ $promo->is_active ? 'Aktif' : 'Non-aktif' }}</div>
        </div>
        <div>
           @if($promo->is_active)
             <span style="background:#dcfce7; color:#166534; padding:2px 8px; border-radius:4px; font-size:10px; font-weight:700;">ACTIVE</span>
           @else
             <span style="background:#fee2e2; color:#991b1b; padding:2px 8px; border-radius:4px; font-size:10px; font-weight:700;">INACTIVE</span>
           @endif
        </div>
      </div>
      @endforeach
    </div>
  </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const salesData = @json($salesChartData);

// ── Premium Manager Chart ──
const ctx = document.getElementById('managerSalesChart').getContext('2d');

const revGrad = ctx.createLinearGradient(0, 0, 0, 300);
revGrad.addColorStop(0, 'rgba(249, 115, 22, 0.4)');
revGrad.addColorStop(1, 'rgba(249, 115, 22, 0)');

const txGrad = ctx.createLinearGradient(0, 0, 0, 300);
txGrad.addColorStop(0, 'rgba(59, 130, 246, 0.2)');
txGrad.addColorStop(1, 'rgba(59, 130, 246, 0)');

let managerSalesChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: salesData.labels,
    datasets: [
      {
        label: 'Pendapatan',
        data: salesData.revenue,
        borderColor: '#f97316',
        backgroundColor: revGrad,
        borderWidth: 4,
        pointBackgroundColor: '#fff',
        pointBorderColor: '#f97316',
        pointBorderWidth: 3,
        pointRadius: 4,
        pointHoverRadius: 8,
        tension: 0.4,
        fill: true,
        yAxisID: 'y'
      },
      {
        label: 'Transaksi',
        data: salesData.transactions,
        borderColor: '#3b82f6',
        backgroundColor: txGrad,
        borderWidth: 2,
        borderDash: [5, 5],
        pointRadius: 0,
        tension: 0.4,
        fill: true,
        yAxisID: 'y1'
      }
    ]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    interaction: { mode: 'index', intersect: false },
    plugins: {
      legend: { 
        position: 'top', 
        align: 'end', 
        labels: { 
            boxWidth: 8, 
            usePointStyle: true, 
            pointStyle: 'circle',
            font: { size: 12, weight: '700' },
            color: '#64748b'
        } 
      },
      tooltip: {
        backgroundColor: 'rgba(30, 41, 59, 0.95)',
        padding: 14,
        titleFont: { size: 14, weight: 'bold' },
        bodyFont: { size: 13 },
        cornerRadius: 10,
        callbacks: {
          label: ctx => ctx.datasetIndex === 0 ? ` Rp ${ctx.raw.toLocaleString('id-ID')}` : ` ${ctx.raw} Transaksi`
        }
      }
    },
    scales: {
      x: { 
        grid: { display: false }, 
        ticks: { color: '#94a3b8', font: { size: 11, weight: '600' } } 
      },
      y: { 
        position: 'left', 
        grid: { color: '#f1f5f9', drawBorder: false }, 
        ticks: { 
          color: '#94a3b8',
          font: { size: 11, weight: '600' },
          callback: v => v >= 1000000 ? (v/1000000).toFixed(1)+'jt' : v >= 1000 ? (v/1000).toFixed(0)+'rb' : v
        } 
      },
      y1: { 
        position: 'right', 
        grid: { display: false }, 
        ticks: { color: '#3b82f6', font: { size: 11, weight: '700' } } 
      }
    },
    animation: {
        duration: 1500,
        easing: 'easeInOutQuart'
    }
  }
});

// ── Update Chart Function ──
async function updateChart(days) {
    const subtitle = document.getElementById('chart-subtitle');
    const select = document.getElementById('chart-period');
    
    subtitle.textContent = `Memuat data...`;
    select.disabled = true;
    
    try {
        const response = await fetch(`{{ route('manager.dashboard.chart-data') }}?days=${days}`);
        const data = await response.json();
        
        managerSalesChart.data.labels = data.labels;
        managerSalesChart.data.datasets[0].data = data.revenue;
        managerSalesChart.data.datasets[1].data = data.transactions;
        
        managerSalesChart.update('active');
        
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
</script>
@endpush
