<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Metode Tidak Diizinkan — 405</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <style>
    body {
      background-color: #f9fafb;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      margin: 0;
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }
    .error-card {
      background: white;
      padding: 3rem;
      border-radius: 20px;
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
      text-align: center;
      max-width: 450px;
      width: 90%;
    }
    .error-code {
      font-size: 6rem;
      font-weight: 900;
      color: #ea580c;
      line-height: 1;
      margin-bottom: 1rem;
      opacity: 0.1;
    }
    .error-icon {
      font-size: 5rem;
      margin-bottom: 1.5rem;
    }
    h1 {
      font-size: 1.5rem;
      color: #111827;
      margin-bottom: 0.75rem;
    }
    p {
      color: #6b7280;
      margin-bottom: 2rem;
      line-height: 1.6;
    }
    .btn-home {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background-color: #374151;
      color: white;
      padding: 0.75rem 1.5rem;
      border-radius: 12px;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.2s;
    }
    .btn-home:hover {
      transform: translateY(-2px);
      background-color: #111827;
    }
  </style>
</head>
<body>
  <div class="error-card">
    <div class="error-code">405</div>
    <div class="error-icon">🚫</div>
    <h1>Akses Tidak Diizinkan</h1>
    <p>Maaf, metode akses halaman ini salah. Jika Anda ingin keluar (Logout), pastikan menekan tombol Keluar yang tersedia di menu aplikasi.</p>
    <a href="{{ url('/') }}" class="btn-home">
      Kembali ke Dashboard
    </a>
  </div>
</body>
</html>
