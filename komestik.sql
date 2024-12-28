-- Membuat database baru
CREATE DATABASE IF NOT EXISTS toko_kosmetik;

-- Gunakan database
USE toko_kosmetik;

-- Membuat tabel produk
CREATE TABLE IF NOT EXISTS produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(100) NOT NULL,
    brand VARCHAR(100) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    stok INT NOT NULL
);

-- Menambahkan data ke tabel produk
INSERT INTO produk (nama_produk, brand, harga, stok) VALUES
('Lipstik', 'Maybelline', 50000.00, 100),
('Foundation', 'L\'Oreal', 100000.00, 50),
('Eyeliner', 'Revlon', 45000.00, 150);

-- Menampilkan data tabel untuk memverifikasi
SELECT * FROM produk;
