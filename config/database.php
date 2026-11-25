<?php
// =====================================================
// config/database.php — koneksi ke database db_inventorybrg
// =====================================================

$host = 'localhost';      // lokasi server MySQL (komputer sendiri)
$db   = 'db_inventorybrg';   // nama database
$user = 'root';           // user bawaan XAMPP
$pass = '';               // password bawaan XAMPP: kosong

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // error menjadi exception
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // hasil berupa array asosiatif
            PDO::ATTR_EMULATE_PREPARES   => false,                  // prepared statement asli
        ]
    );
} catch (PDOException $e) {
    // Detail error hanya dicatat ke log, TIDAK ditampilkan ke pengguna
    error_log('Koneksi database gagal: ' . $e->getMessage());

    http_response_code(500);
    exit('<div style="font-family:sans-serif;max-width:520px;margin:80px auto;padding:24px;'
        . 'border:1px solid #f3c7c0;border-radius:12px;background:#fff5f3;color:#7a2618">'
        . '<h2 style="margin-top:0">Koneksi ke database gagal</h2>'
        . '<p>Pastikan <b>MySQL</b> di XAMPP Control Panel sudah <b>Start</b> '
        . 'dan database <b>db_inventorybrg</b> sudah diimpor.</p></div>');
}