<?php
// =====================================================
// barang/index.php — menampilkan SELURUH data barang
// =====================================================
require __DIR__ . '/../config/app.php';
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/functions.php';

$pageTitle  = 'Data Barang';
$activeMenu = 'barang';

// Query: ambil barang + nama kategorinya (JOIN), urut berdasarkan nama
$sql = "SELECT b.kode_barang, b.nama_barang, k.nama_kategori,
               b.satuan, b.harga, b.stok, b.stok_minimum
        FROM barang b
        JOIN kategori k ON k.id = b.kategori_id
        ORDER BY b.nama_barang ASC";

// Jalankan query, lalu ambil semua baris menjadi array
$daftarBarang = $pdo->query($sql)->fetchAll();

require __DIR__ . '/../includes/header.php';
?>

<section class="card">
    <div class="card-header">
        <h2>Daftar Barang</h2>
        <span class="badge badge-info"><?= count($daftarBarang) ?> barang</span>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Stok</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php if (count($daftarBarang) === 0): ?>
                <tr><td colspan="8" class="empty">Belum ada data barang.</td></tr>
            <?php endif; ?>

            <?php foreach ($daftarBarang as $i => $b): ?>
                <?php $menipis = (int) $b['stok'] <= (int) $b['stok_minimum']; ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><span class="code"><?= e($b['kode_barang']) ?></span></td>
                    <td><?= e($b['nama_barang']) ?></td>
                    <td><?= e($b['nama_kategori']) ?></td>
                    <td><?= e($b['satuan']) ?></td>
                    <td class="text-right"><?= rupiah($b['harga']) ?></td>
                    <td class="text-right"><?= angka($b['stok']) ?></td>
                    <td>
                        <?php if ($menipis): ?>
                            <span class="badge badge-danger">Menipis</span>
                        <?php else: ?>
                            <span class="badge badge-success">Aman</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>