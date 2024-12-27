

# Web Service

Tugas UAS MATKUL WebService

Nama Fitria Indah Mutia Rini
NIM : 21.01.55.0001

#### Tujuan : Membuat dan menguji web service REST untuk manajemen buku menggunakan PHP dan MySQL.


### Alat yang Dibutuhkan
 1. XAMPP (atau server web lain dengan PHP dan MySQL)
 2. Text editor (misalnya Visual Studio Code, Notepad++, dll)
 3. Postman

## Langkah-langkah Praktikum

### 1. Persiapan Lingkungan
    1. Instal XAMPP jika belum ada.
    2. Buat folder baru bernama rest_buku di dalam direktori htdocs XAMPP Anda.

### 2. Membuat Database
    1. Buka phpMyAdmin (http://localhost/phpmyadmin)
    2. Buat database baru bernama tokobuku
    3. Pilih database tokobuku, lalu buka tab SQL
    4. Jalankan query SQL berikut untuk membuat tabel dan menambahkan data sampel:

```sql
CREATE DATABASE tokobuku;

USE tokobuku;

CREATE TABLE buku (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nama_buku VARCHAR(50),

    harga INT,

    jumlah INT

);

INSERT INTO buku (nama_buku, harga, jumlah) VALUES ('Laskar Pelangi', 110000, 10);
```



