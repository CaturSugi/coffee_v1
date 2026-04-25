<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="theme-color" content="{{ $settings['app_brand_color'] ?? '#ea580c' }}">
  <link rel="manifest" href="{{ asset('manifest.json') }}">
  <link rel="apple-touch-icon" href="{{ asset('storage/logo.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('storage/logo.png') }}">
  <title>@yield('title', 'Dashboard') — {{ $settings['shop_name'] ?? 'Bran Coffee' }} POS</title>
  <meta name="description" content="@yield('meta_description', ($settings['shop_name'] ?? 'Bran Coffee') . ' POS Management System')">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  
  {{-- Dynamic Styling --}}
  <style>
    :root {
      @if(isset($settings['app_brand_color']))
        --brand-500: {{ $settings['app_brand_color'] }};
        --brand-400: {{ $settings['app_brand_color'] }}cc;
        --brand-600: {{ $settings['app_brand_color'] }};
        --brand-50: {{ $settings['app_brand_color'] }}10; {{-- 10% opacity --}}
        
        {{-- Modern browser support for better color blending --}}
        @supports (color: color-mix(in srgb, red, white)) {
          --brand-50: color-mix(in srgb, {{ $settings['app_brand_color'] }}, white 92%);
          --brand-100: color-mix(in srgb, {{ $settings['app_brand_color'] }}, white 80%);
          --brand-600: color-mix(in srgb, {{ $settings['app_brand_color'] }}, black 15%);
          --brand-700: color-mix(in srgb, {{ $settings['app_brand_color'] }}, black 30%);
        }
      @endif
    }
  </style>

  @stack('styles')
</head>
<body>

<div class="app-wrapper">

  {{-- ── Sidebar ── --}}
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
      @if(isset($settings['app_logo']) && $settings['app_logo'])
        <img src="{{ asset('storage/' . $settings['app_logo']) }}" alt="Logo" style="width:40px; height:40px; border-radius:10px; object-fit:cover;">
      @else
        <div class="sidebar-logo-icon">☕</div>
      @endif
      <div>
        <div class="sidebar-logo-text">{{ $settings['shop_name'] ?? 'Bran Coffee' }}</div>
        <div class="sidebar-logo-sub">{{ $settings['shop_tagline'] ?? 'POS System' }}</div>
      </div>
    </div>

    <nav class="sidebar-nav">

      {{-- Main --}}
      <div class="sidebar-section-label">Main</div>

      @if(auth()->user()->isManager())
        <a href="{{ route('manager.dashboard') }}" class="sidebar-item {{ request()->routeIs('manager.dashboard') ? 'active' : '' }}">
          <span class="icon">📊</span>
          Dashboard
        </a>
      @elseif(auth()->user()->isCS())
        <a href="{{ route('cs.dashboard') }}" class="sidebar-item {{ request()->routeIs('cs.dashboard') ? 'active' : '' }}">
          <span class="icon">📊</span>
          Dashboard
        </a>
      @else
        <a href="{{ route('admin.dashboard') }}" class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <span class="icon">📊</span>
          Dashboard
        </a>
      @endif

      <a href="{{ route('pos.index') }}" class="sidebar-item {{ request()->routeIs('pos.*') ? 'active' : '' }}">
        <span class="icon">🛒</span>
        Kasir / POS
      </a>

      {{-- Produk --}}
      <div class="sidebar-section-label">Katalog</div>

      @if(auth()->user()->isCS())
        <a href="{{ route('cs.products.index') }}" class="sidebar-item {{ request()->routeIs('cs.products.*') ? 'active' : '' }}">
          <span class="icon">☕</span>
          Produk
        </a>
      @else
        <a href="{{ route('admin.products.index') }}" class="sidebar-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
          <span class="icon">☕</span>
          Produk
        </a>
      @endif

      {{-- Transaksi --}}
      <div class="sidebar-section-label">Transaksi</div>

      <a href="{{ route('pos.transaction.list') }}" class="sidebar-item {{ request()->routeIs('pos.transaction.*') ? 'active' : '' }}">
        <span class="icon">🧾</span>
        Riwayat Transaksi
      </a>

      <a href="{{ route('kitchen.dashboard') }}" class="sidebar-item {{ request()->routeIs('kitchen.*') ? 'active' : '' }}">
        <span class="icon">🍳</span>
        Dapur (KDS)
      </a>

      @if(auth()->user()->isCS())
        <a href="{{ route('cs.members.index') }}" class="sidebar-item {{ request()->routeIs('cs.members.*') ? 'active' : '' }}">
          <span class="icon">👥</span>
          Member
        </a>
      @else
        <a href="{{ route('admin.members.index') }}" class="sidebar-item {{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
          <span class="icon">👥</span>
          Member
        </a>
      @endif

      {{-- Laporan --}}
      <div class="sidebar-section-label">Laporan</div>

      @if(auth()->user()->isManager())
        <a href="{{ route('manager.reports.sales') }}" class="sidebar-item {{ request()->routeIs('manager.reports.sales') ? 'active' : '' }}">
          <span class="icon">📈</span>
          Laporan Penjualan
        </a>
        <a href="{{ route('manager.reports.products') }}" class="sidebar-item {{ request()->routeIs('manager.reports.products') ? 'active' : '' }}">
          <span class="icon">☕</span>
          Performa Produk
        </a>
        <a href="{{ route('manager.reports.members') }}" class="sidebar-item {{ request()->routeIs('manager.reports.members') ? 'active' : '' }}">
          <span class="icon">👥</span>
          Laporan Member
        </a>
      @elseif(auth()->user()->isCS())
        <a href="{{ route('cs.reports.sales') }}" class="sidebar-item {{ request()->routeIs('cs.reports.sales') ? 'active' : '' }}">
          <span class="icon">📈</span>
          Laporan Penjualan Saya
        </a>
      @else
        <a href="{{ route('admin.reports.dashboard') }}" class="sidebar-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
          <span class="icon">📈</span>
          Laporan Penjualan
        </a>
      @endif

      {{-- Management --}}
      @if(auth()->user()->isManager() || auth()->user()->isAdmin())
        <div class="sidebar-section-label">Manajemen</div>
        
        @if(auth()->user()->isManager())
          <a href="{{ route('manager.promotions.index') }}" class="sidebar-item {{ request()->routeIs('manager.promotions.*') ? 'active' : '' }}">
            <span class="icon">🏷️</span>
            Manajemen Promo
          </a>
        @endif

        @if(auth()->user()->isAdmin())
          <a href="{{ route('admin.users.index') }}" class="sidebar-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <span class="icon">👤</span>
            Pengguna
          </a>

          <a href="{{ route('admin.settings.index') }}" class="sidebar-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <span class="icon">⚙️</span>
            Pengaturan
          </a>
        @endif
      @endif

    </nav>

    {{-- Sidebar user --}}
    <div class="sidebar-user">
      <div class="sidebar-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
      <div>
        <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
        <div class="sidebar-user-role">{{ ucfirst(auth()->user()->role) }}</div>
      </div>
      <form method="POST" action="{{ route('logout') }}" style="margin-left:auto;">
        @csrf
        <button type="submit" class="sidebar-user-logout" title="Keluar">🚪</button>
      </form>
    </div>
  </aside>

  {{-- Sidebar overlay for mobile --}}
  <div class="sidebar-overlay" id="sidebar-overlay" onclick="toggleSidebar()"></div>

  {{-- ── Main Content ── --}}
  <div class="main-content">

    {{-- Topbar --}}
    <header class="topbar">
      <button onclick="toggleSidebar()" style="background:none;border:none;cursor:pointer;font-size:22px;margin-right:4px;display:none;" id="menu-btn">☰</button>
      <div class="topbar-title">{!! $__env->yieldContent('page-title', 'Dashboard') !!}</div>

      <div class="topbar-actions">
        <div class="topbar-time" id="clock">{{ now()->format('H:i') }}</div>

        <div class="topbar-btn notification-wrapper" title="Pesanan Belum Disajikan" id="notif-btn">
          🔔
          <span class="badge" id="notif-badge" style="display:none;">0</span>
          
          <div class="notif-dropdown" id="notif-dropdown">
            <div class="notif-header">
              Pesanan Belum Disajikan
              <span id="notif-count-text">0 Pesanan</span>
            </div>
            <div class="notif-body" id="notif-list">
              <div class="notif-empty">Memuat pesanan...</div>
            </div>
            <div class="notif-footer">
              <a href="{{ route('kitchen.dashboard') }}">Buka Kitchen Dashboard</a>
            </div>
          </div>
        </div>

        <div class="topbar-btn" title="Profile">
          <div class="avatar" style="width:24px;height:24px;font-size:10px;">{{ strtoupper(substr(auth()->user()->name,0,2)) }}</div>
        </div>
      </div>
    </header>

    {{-- Page Content --}}
    <main class="page-content">
      @if(session('success'))
        <div class="alert alert-success" style="margin-bottom:20px">
          ✅ {{ session('success') }}
        </div>
      @endif
      @if(session('error'))
        <div class="alert alert-danger" style="margin-bottom:20px">
          ⚠️ {{ session('error') }}
        </div>
      @endif

      @yield('content')
    </main>

  </div>
</div>

<script>
// Live clock
function updateClock() {
  const now = new Date();
  const h = String(now.getHours()).padStart(2,'0');
  const m = String(now.getMinutes()).padStart(2,'0');
  const s = String(now.getSeconds()).padStart(2,'0');
  const el = document.getElementById('clock');
  if (el) el.textContent = `${h}:${m}:${s}`;
}
updateClock();
setInterval(updateClock, 1000);

// ── Notification Logic ──
const notifBtn = document.getElementById('notif-btn');
const notifDropdown = document.getElementById('notif-dropdown');
const notifBadge = document.getElementById('notif-badge');
const notifList = document.getElementById('notif-list');
const notifCountText = document.getElementById('notif-count-text');

if (notifBtn) {
    notifBtn.onclick = (e) => {
        e.stopPropagation();
        notifDropdown.classList.toggle('show');
        fetchNotifications();
    };
}

window.onclick = (e) => {
    if (notifDropdown && !notifBtn.contains(e.target)) {
        notifDropdown.classList.remove('show');
    }
    // Existing sidebar toggle
    if (e.target.id === 'sidebar-overlay') {
        toggleSidebar();
    }
};

async function fetchNotifications() {
    try {
        const response = await fetch('{{ route("pos.notifications.unserved") }}');
        const result = await response.json();
        
        if (result.success) {
            updateNotifUI(result);
        }
    } catch (error) {
        console.error('Notif error:', error);
    }
}

function updateNotifUI(result) {
    const count = result.count;
    notifBadge.textContent = count;
    notifBadge.style.display = count > 0 ? 'flex' : 'none';
    notifCountText.textContent = `${count} Pesanan`;

    if (count === 0) {
        notifList.innerHTML = '<div class="notif-empty">Semua pesanan sudah disajikan ✨</div>';
        return;
    }

    notifList.innerHTML = result.data.map(order => `
        <div class="notif-item">
            <div class="notif-item-info">
                <div class="notif-item-title">#${order.code} &bull; ${order.customer}</div>
                <div class="notif-item-meta">${order.items_count} item &bull; ${order.time}</div>
            </div>
            <button onclick="markAsServed(event, ${order.id})" class="notif-item-action" title="Tandai Sudah Disajikan">✅</button>
        </div>
    `).join('');
}

async function markAsServed(e, id) {
    e.stopPropagation();
    try {
        const response = await fetch(`{{ url('pos/transactions') }}/${id}/serve`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        });
        const result = await response.json();
        if (result.success) {
            fetchNotifications();
        }
    } catch (error) {
        console.error('Serve error:', error);
    }
}

// Initial fetch & poll
fetchNotifications();
setInterval(fetchNotifications, 30000); // Poll every 30s
</script>

@stack('scripts')
<script>
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      // Use the root-relative path for the service worker
      navigator.serviceWorker.register('{{ asset("sw.js") }}')
        .then(reg => console.log('Service worker registered.', reg))
        .catch(err => console.log('Service worker registration failed:', err));
    });
  }
</script>
</body>
</html>
