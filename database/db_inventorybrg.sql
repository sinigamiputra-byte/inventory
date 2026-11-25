-- =====================================================
-- Database  : db_inventorybrg
-- Proyek    : Sistem Informasi Inventory Barang
-- Mata kuliah: Praktek Pemrograman WEB II (AP211707)
-- =====================================================

CREATE DATABASE IF NOT EXISTS db_inventorybrg
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_inventorybrg;

-- Hapus tabel lama (jika ada) agar impor bisa diulang
DROP TABLE IF EXISTS transaksi;
DROP TABLE IF EXISTS barang;
DROP TABLE IF EXISTS kategori;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  nama        VARCHAR(100) NOT NULL,
  username    VARCHAR(50)  NOT NULL UNIQUE,
  password    VARCHAR(255) NOT NULL,
  role        ENUM('admin','petugas') NOT NULL DEFAULT 'petugas',
  created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE kategori (
  id             INT AUTO_INCREMENT PRIMARY KEY,
  nama_kategori  VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE barang (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  kode_barang   VARCHAR(20)  NOT NULL UNIQUE,
  nama_barang   VARCHAR(150) NOT NULL,
  kategori_id   INT NOT NULL,
  satuan        VARCHAR(20)  NOT NULL,
  harga         INT UNSIGNED NOT NULL DEFAULT 0,
  stok          INT UNSIGNED NOT NULL DEFAULT 0,
  stok_minimum  INT UNSIGNED NOT NULL DEFAULT 5,
  created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_barang_kategori FOREIGN KEY (kategori_id)
    REFERENCES kategori(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE transaksi (
  id              INT AUTO_INCREMENT PRIMARY KEY,
  kode_transaksi  VARCHAR(30) NOT NULL UNIQUE,
  jenis           ENUM('masuk','keluar') NOT NULL,
  tanggal         DATE NOT NULL,
  barang_id       INT NOT NULL,
  jumlah          INT UNSIGNED NOT NULL,
  keterangan      VARCHAR(255) NULL,
  user_id         INT NOT NULL,
  created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_transaksi_barang FOREIGN KEY (barang_id)
    REFERENCES barang(id) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT fk_transaksi_user FOREIGN KEY (user_id)
    REFERENCES users(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

-- Akun demo: admin / admin123  dan  petugas / petugas123
INSERT INTO users (nama, username, password, role) VALUES
('Administrator',  'admin',   '$2y$10$spkWv2/VZPwDb56vop97cOSmD1CSlsL0QeBaRQfkw0p/8sxuUmOn2', 'admin'),
('Petugas Gudang', 'petugas', '$2y$10$x6waPPcogV2tjLcfgTDwFuPd0LeOm7cYHURokjty8FjTZa8.o9Y.q', 'petugas');

INSERT INTO kategori (nama_kategori) VALUES
('Alat Tulis Kantor'), ('Elektronik'), ('Kebersihan'), ('Konsumsi');

INSERT INTO barang (kode_barang, nama_barang, kategori_id, satuan, harga, stok, stok_minimum) VALUES
('BRG-001', 'Kertas HVS A4 70gsm',     1, 'rim',   52000, 25, 10),
('BRG-002', 'Pulpen Hitam',            1, 'pak',   24000, 12,  5),
('BRG-003', 'Map Plastik',             1, 'lusin', 18000,  4,  5),
('BRG-004', 'Mouse USB',               2, 'unit',  65000,  8,  3),
('BRG-005', 'Flashdisk 32GB',          2, 'unit',  85000,  2,  3),
('BRG-006', 'Cairan Pembersih Lantai', 3, 'botol', 21000, 15,  5),
('BRG-007', 'Tisu Gulung',             3, 'pak',   32000,  6,  5),
('BRG-008', 'Air Mineral 600ml',       4, 'dus',   48000, 10,  4);