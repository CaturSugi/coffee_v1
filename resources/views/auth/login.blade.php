<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login — {{ $settings['shop_name'] ?? 'Bran Coffee' }} POS</title>
  <meta name="description" content="Login ke sistem POS {{ $settings['shop_name'] ?? 'Bran Coffee' }}">
  @vite(['resources/css/app.css'])

  {{-- Dynamic Styling --}}
  <style>
    :root {
      @if(isset($settings['app_brand_color']))
        --brand-500: {{ $settings['app_brand_color'] }};
        --brand-400: {{ $settings['app_brand_color'] }}cc;
        --brand-600: {{ $settings['app_brand_color'] }};
        --brand-50: {{ $settings['app_brand_color'] }}10;
        
        @supports (color: color-mix(in srgb, red, white)) {
          --brand-50: color-mix(in srgb, {{ $settings['app_brand_color'] }}, white 92%);
          --brand-600: color-mix(in srgb, {{ $settings['app_brand_color'] }}, black 15%);
        }
      @endif
    }
  </style>
</head>

<body>

  <div class="auth-page">

    {{-- Left Visual Panel --}}
    <div class="auth-visual">
      <div class="auth-visual-logo">
        @if(isset($settings['app_logo']) && $settings['app_logo'])
          <img src="{{ asset('storage/' . $settings['app_logo']) }}" alt="Logo" style="width:44px; height:44px; border-radius:12px; object-fit:cover;">
        @else
          <div class="auth-visual-logo-icon">☕</div>
        @endif
        <div>
          <div class="auth-visual-logo-text">{{ $settings['shop_name'] ?? 'Bran Coffee' }}</div>
          <div class="auth-visual-logo-sub">{{ $settings['shop_tagline'] ?? 'Point of Sale System' }}</div>
        </div>
      </div>

      <div class="auth-visual-badge">
        <span class="dot" style="background:#4ade80"></span>
        Sistem Aktif & Online
      </div>

      <h1>Kelola Bisnis<br>Kopi Anda<br>Lebih Mudah</h1>
      <p>Platform POS modern untuk coffee shop Anda. Kelola transaksi, stok, member, dan laporan dalam satu sistem terintegrasi.</p>

      <div class="auth-visual-stats">
        <div class="auth-visual-stat">
          <div class="num">{{ number_format($stats['transactions'] ?? 0) }}</div>
          <div class="label">Transaksi</div>
        </div>
        <div class="auth-visual-stat">
          <div class="num">{{ number_format($stats['products'] ?? 0) }}</div>
          <div class="label">Produk</div>
        </div>
        <div class="auth-visual-stat">
          <div class="num">{{ number_format($stats['members'] ?? 0) }}</div>
          <div class="label">Member</div>
        </div>
      </div>
    </div>

    {{-- Right Form Panel --}}
    <div class="auth-form-panel">
      <div class="auth-form-inner">

        <h2>Selamat Datang 👋</h2>
        <p class="auth-subtitle">Masuk ke akun Anda untuk melanjutkan</p>

        {{-- Error messages --}}
        @if ($errors->any())
        <div class="alert alert-danger">
          <span style="font-size:18px">⚠️</span>
          <div>
            @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
            @endforeach
          </div>
        </div>
        @endif

        @if (session('status'))
        <div class="alert alert-success">
          <span style="font-size:18px">✅</span>
          {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="login-form">
          @csrf

          {{-- Email --}}
          <div class="form-group">
            <label class="form-label" for="email">Alamat Email</label>
            <div class="form-control-icon">
              <span class="icon">📧</span>
              <input
                type="email"
                id="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="nama@{{ Str::slug($settings['shop_name'] ?? 'brancoffee') }}.com"
                value="{{ old('email') }}"
                required
                autofocus>
            </div>
          </div>

          {{-- Password --}}
          <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <div class="form-control-icon">
              <span class="icon">🔒</span>
              <input
                type="password"
                id="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="Masukkan password"
                required>
              <span class="icon-right" onclick="togglePassword()" title="Tampilkan password" id="pw-toggle">👁️</span>
            </div>
          </div>

          {{-- Remember me --}}
          <div class="form-options">
            <label class="form-check">
              <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <span class="form-check-label">Ingat saya</span>
            </label>
          </div>

          <button type="submit" class="btn btn-primary" id="login-btn">
            <span id="btn-text">Masuk ke Sistem</span>
            <span id="btn-icon">→</span>
          </button>

        </form>

        {{-- Divider --}}
        <div style="margin:28px 0; text-align:center; position:relative;">
          <div class="divider"></div>
          <span style="position:absolute; top:-10px; left:50%; transform:translateX(-50%); background:var(--dark-800); padding:0 12px; font-size:12px; color:var(--dark-300);">Akun Default</span>
        </div>

        {{-- Quick login hints --}}
        <div style="display:grid; gap:8px;">
          @foreach([
          ['role'=>'Admin', 'email'=>'admin@brancoffee.com', 'icon'=>'👑', 'color'=>'#f97316'],
          ['role'=>'Manager', 'email'=>'manager@brancoffee.com', 'icon'=>'📊', 'color'=>'#3b82f6'],
          ['role'=>'CS Staff', 'email'=>'cs@brancoffee.com', 'icon'=>'🛒', 'color'=>'#22c55e'],
          ] as $acc)
          <button type="button"
            onclick="fillLogin('{{ $acc['email'] }}')"
            style="display:flex; align-items:center; gap:10px; background:var(--dark-700); border:1px solid var(--dark-500); border-radius:10px; padding:10px 14px; cursor:pointer; transition:all .2s; color:var(--gray-300); font-size:13px; font-family:inherit;"
            onmouseover="this.style.borderColor='{{ $acc['color'] }}'; this.style.background='var(--dark-600)'"
            onmouseout="this.style.borderColor='var(--dark-500)'; this.style.background='var(--dark-700)'">
            <span style="font-size:18px">{{ $acc['icon'] }}</span>
            <span><strong style="color:#fff">{{ $acc['role'] }}</strong> &mdash; {{ $acc['email'] }}</span>
          </button>
          @endforeach
        </div>

      </div>
    </div>
  </div>

  <script>
    function togglePassword() {
      const pw = document.getElementById('password');
      const icon = document.getElementById('pw-toggle');
      if (pw.type === 'password') {
        pw.type = 'text';
        icon.textContent = '🙈';
      } else {
        pw.type = 'password';
        icon.textContent = '👁️';
      }
    }

    function fillLogin(email) {
      document.getElementById('email').value = email;
      document.getElementById('password').value = 'password';
      document.getElementById('email').focus();
    }

    document.getElementById('login-form').addEventListener('submit', function() {
      const btn = document.getElementById('login-btn');
      btn.disabled = true;
      document.getElementById('btn-text').textContent = 'Memproses...';
      document.getElementById('btn-icon').textContent = '⏳';
    });
  </script>
</body>

</html>