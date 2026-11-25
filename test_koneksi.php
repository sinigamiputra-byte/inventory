<?php
// test_koneksi.php — HANYA untuk uji coba, hapus setelah berhasil
require __DIR__ . '/config/database.php';

$jumlah = $pdo->query("SELECT COUNT(*) FROM barang")->fetchColumn();

echo "<h2>✅ Koneksi berhasil!</h2>";
echo "<p>Jumlah data barang di database: <b>$jumlah</b></p>";