<?php
// Script Perbaikan Deployment Otomatis
// Simpan file ini di folder root (selevel dengan .env) lalu akses via browser

echo "<h2>🔧 Coffee POS Deployment Fixer</h2>";

// 1. Hapus file public/hot
$hotFile = __DIR__ . '/public/hot';
if (file_exists($hotFile)) {
    if (unlink($hotFile)) {
        echo "<p style='color:green'>✅ File 'public/hot' berhasil dihapus. Style (CSS) sekarang seharusnya sudah aktif!</p>";
    } else {
        echo "<p style='color:red'>❌ Gagal menghapus 'public/hot'. Silakan hapus manual via File Manager di folder public.</p>";
    }
} else {
    echo "<p style='color:blue'>ℹ️ File 'public/hot' tidak ditemukan. Seharusnya CSS sudah bisa terbaca.</p>";
}

// 2. Cek file .env untuk typo DB_HOST
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    $content = file_get_contents($envFile);
    if (strpos($content, 'DB_HOST=ql113') !== false) {
        echo "<p style='color:orange'>⚠️ Peringatan: Ditemukan 'DB_HOST=ql113' di .env. Seharusnya 'sql113' (kurang huruf S).</p>";
    } else if (strpos($content, 'DB_HOST=sql113') !== false) {
        echo "<p style='color:green'>✅ DB_HOST sepertinya sudah benar (sql113).</p>";
    }
}

// 3. Cek folder public/build
$buildDir = __DIR__ . '/public/build';
if (is_dir($buildDir)) {
    echo "<p style='color:green'>✅ Folder 'public/build' ditemukan. Asset produksi tersedia.</p>";
} else {
    echo "<p style='color:red'>❌ Folder 'public/build' TIDAK ditemukan! Anda harus mengunggah folder 'public/build' agar tampilan muncul.</p>";
}

echo "<hr><p>Silakan <a href='/'>kembali ke halaman utama</a> untuk mengecek hasilnya.</p>";
