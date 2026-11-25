<?php
// =====================================================
// kategori/index.php — menampilkan seluruh kategori
// beserta jumlah barang di setiap kategori
// =====================================================
require __DIR__ . '/../config/app.php';
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/functions.php';

$pageTitle  = 'Kategori';
$activeMenu = 'kategori';

// LEFT JOIN: kategori tetap tampil walaupun belum punya barang
$sql = "SELECT k.id, k.nama_kategori,
               COUNT(b.id)            AS jumlah_barang,
               COALESCE(SUM(b.stok), 0) AS total_stok
        FROM kategori k
        LEFT JOIN barang b ON b.kategori_id = k.id
        GROUP BY k.id, k.nama_kategori
        ORDER BY k.nama_kategori ASC";

$daftarKategori = $pdo->query($sql)->fetchAll();

require __DIR__ . '/../includes/header.php';
?>

<section class="card">
    <div class="card-header">
        <h2>Daftar Kategori</h2>
        <span class="badge badge-info"><?= count($daftarKategori) ?> kategori</span>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th class="text-right">Jumlah Jenis Barang</th>
                    <th class="text-right">Total Stok</th>
                </tr>
            </thead>
            <tbody>
            <?php if (count($daftarKategori) === 0): ?>
                <tr><td colspan="4" class="empty">Belum ada data kategori.</td></tr>
            <?php endif; ?>

            <?php foreach ($daftarKategori as $i => $k): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= e($k['nama_kategori']) ?></td>
                    <td class="text-right"><?= angka($k['jumlah_barang']) ?></td>
                    <td class="text-right"><?= angka($k['total_stok']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>