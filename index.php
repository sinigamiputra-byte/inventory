<?php
// =====================================================
// index.php — Dashboard (ringkasan data dari database)
// =====================================================
require __DIR__ . '/config/app.php';
require __DIR__ . '/config/database.php';
require __DIR__ . '/includes/functions.php';

$pageTitle  = 'Dashboard';
$activeMenu = 'dashboard';

// 1. Hitung ringkasan. fetchColumn() mengambil SATU nilai saja.
$totalBarang   = $pdo->query("SELECT COUNT(*) FROM barang")->fetchColumn();
$totalKategori = $pdo->query("SELECT COUNT(*) FROM kategori")->fetchColumn();
$totalStok     = $pdo->query("SELECT COALESCE(SUM(stok), 0) FROM barang")->fetchColumn();
$nilaiStok     = $pdo->query("SELECT COALESCE(SUM(harga * stok), 0) FROM barang")->fetchColumn();

// 2. Ambil barang yang stoknya sudah mencapai / di bawah batas minimum
$sqlMenipis = "SELECT b.kode_barang, b.nama_barang, k.nama_kategori,
                      b.satuan, b.stok, b.stok_minimum
               FROM barang b
               JOIN kategori k ON k.id = b.kategori_id
               WHERE b.stok <= b.stok_minimum
               ORDER BY b.stok ASC";
$stokMenipis = $pdo->query($sqlMenipis)->fetchAll();

require __DIR__ . '/includes/header.php';
?>

<section class="stats">
    <div class="stat-card">
        <div class="stat-icon blue">📋</div>
        <div>
            <div class="stat-label">Total Jenis Barang</div>
            <div class="stat-value"><?= angka($totalBarang) ?></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon teal">🏷️</div>
        <div>
            <div class="stat-label">Kategori</div>
            <div class="stat-value"><?= angka($totalKategori) ?></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon amber">📦</div>
        <div>
            <div class="stat-label">Total Stok (unit)</div>
            <div class="stat-value"><?= angka($totalStok) ?></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">💰</div>
        <div>
            <div class="stat-label">Nilai Persediaan</div>
            <div class="stat-value small"><?= rupiah($nilaiStok) ?></div>
        </div>
    </div>
</section>

<section class="card">
    <div class="card-header">
        <h2>⚠️ Stok Menipis</h2>
        <span class="badge badge-danger"><?= count($stokMenipis) ?> barang</span>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th class="text-right">Stok</th>
                    <th class="text-right">Minimum</th>
                </tr>
            </thead>
            <tbody>
            <?php if (count($stokMenipis) === 0): ?>
                <tr><td colspan="5" class="empty">Semua stok aman 👍</td></tr>
            <?php endif; ?>

            <?php foreach ($stokMenipis as $b): ?>
                <tr>
                    <td><span class="code"><?= e($b['kode_barang']) ?></span></td>
                    <td><?= e($b['nama_barang']) ?></td>
                    <td><?= e($b['nama_kategori']) ?></td>
                    <td class="text-right text-danger"><b><?= angka($b['stok']) ?></b> <?= e($b['satuan']) ?></td>
                    <td class="text-right"><?= angka($b['stok_minimum']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>