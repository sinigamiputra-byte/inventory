<?php
// =====================================================
// config/app.php — pengaturan umum aplikasi
// =====================================================

// Nama aplikasi yang tampil di sidebar dan judul tab browser
define('APP_NAME', 'SI Inventory');

// Alamat folder proyek di htdocs.
// Jika nama folder kamu BUKAN "inventory", ganti nilai di bawah ini.
define('BASE_URL', '/inventory');

// Zona waktu Indonesia bagian barat (agar tanggal & jam sesuai)
date_default_timezone_set('Asia/Jakarta');