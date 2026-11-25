<?php
// =====================================================
// includes/header.php — bagian atas setiap halaman
// Variabel yang harus diisi sebelum file ini dipanggil:
//   $pageTitle  : judul halaman
//   $activeMenu : nama menu yang aktif (dashboard, barang, kategori)
// =====================================================
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?> — <?= e(APP_NAME) ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>
<div class="layout">

    <aside class="sidebar">
        <div class="brand">
            <span class="brand-logo">📦</span>
            <div>
                <div class="brand-name"><?= e(APP_NAME) ?></div>
                <div class="brand-sub">Inventory Barang</div>
            </div>
        </div>

        <nav class="menu">
            <div class="menu-label">Utama</div>
            <a href="<?= BASE_URL ?>/index.php" class="<?= menuAktif('dashboard', $activeMenu) ?>">
                <span>🏠</span> Dashboard
            </a>

            <div class="menu-label">Data Master</div>
            <a href="<?= BASE_URL ?>/barang/index.php" class="<?= menuAktif('barang', $activeMenu) ?>">
                <span>📋</span> Data Barang
            </a>
            <a href="<?= BASE_URL ?>/kategori/index.php" class="<?= menuAktif('kategori', $activeMenu) ?>">
                <span>🏷️</span> Kategori
            </a>

            <div class="menu-label">Segera Hadir</div>
            <a class="disabled"><span>🔄</span> Transaksi <small>Mg 14</small></a>
            <a class="disabled"><span>📊</span> Laporan <small>Mg 15</small></a>
        </nav>
    </aside>

    <main class="content">
        <header class="topbar">
            <h1><?= e($pageTitle) ?></h1>
            <span class="topbar-date"><?= date('d-m-Y') ?></span>
        </header>