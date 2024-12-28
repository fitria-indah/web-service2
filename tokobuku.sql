CREATE DATABASE tokobuku;

USE tokobuku;

CREATE TABLE buku (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nama_buku VARCHAR(50),

    harga INT,

    jumlah INT

);

INSERT INTO buku (nama_buku, harga, jumlah) VALUES ('Laskar Pelangi', 110000, 10);