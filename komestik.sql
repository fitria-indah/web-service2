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
    stok INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Menambahkan data ke tabel produk
INSERT INTO produk (nama_produk, brand, harga, stok) VALUES
('Lipstik', 'Maybelline', 50000.00, 100),
('Foundation', 'L\'Oreal', 100000.00, 50),
('Eyeliner', 'Revlon', 45000.00, 150);

-- Membuat tabel admin
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Menambahkan data admin default dengan password yang di-hash
-- Password asli: admin123
INSERT INTO admin (username, password) VALUES
('admin', '$2y$10$DnBnTrJ.x2JtV.kF2mcY.O/RpD/3uhIYkPqGZQl.n.7rcdbDRdga2');

-- Membuat prosedur untuk registrasi admin baru
DELIMITER //

CREATE PROCEDURE RegisterAdmin (
    IN new_username VARCHAR(50),
    IN new_password VARCHAR(255)
)
BEGIN
    -- Cek apakah username sudah ada
    IF EXISTS (SELECT 1 FROM admin WHERE username = new_username) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Username already exists.';
    ELSE
        -- Menambahkan admin baru
        INSERT INTO admin (username, password) VALUES (new_username, new_password);
    END IF;
END //

DELIMITER ;

-- Verifikasi data
SELECT * FROM produk;
SELECT * FROM admin;
