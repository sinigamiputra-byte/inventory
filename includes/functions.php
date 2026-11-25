<?php
// =====================================================
// includes/functions.php — fungsi bantu (helper)
// =====================================================

// Mengamankan teks sebelum ditampilkan di HTML (mencegah XSS)
function e($text): string
{
    return htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8');
}

// Format angka menjadi Rupiah. Contoh: 52000 -> Rp 52.000
function rupiah($angka): string
{
    return 'Rp ' . number_format((int) $angka, 0, ',', '.');
}

// Format angka biasa dengan titik ribuan. Contoh: 1250 -> 1.250
function angka($angka): string
{
    return number_format((int) $angka, 0, ',', '.');
}

// Memberi class "active" pada menu sidebar yang sedang dibuka
function menuAktif(string $menu, string $activeMenu): string
{
    return $menu === $activeMenu ? 'active' : '';
}