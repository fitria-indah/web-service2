<?php
// Koneksi database
$conn = new mysqli('localhost', 'root', '', 'toko_kosmetik');
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Validasi input
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = isset($_POST['nama_produk']) ? trim($_POST['nama_produk']) : '';
    $brand = isset($_POST['brand']) ? trim($_POST['brand']) : '';
    $harga = isset($_POST['harga']) ? (int)$_POST['harga'] : 0;
    $stok = isset($_POST['stok']) ? (int)$_POST['stok'] : 0;

    // Validasi untuk memastikan data tidak kosong atau salah
    if (!empty($nama_produk) && !empty($brand) && $harga > 0 && $stok >= 0) {
        // Query untuk menambahkan data ke tabel
        $stmt = $conn->prepare("INSERT INTO produk (nama_produk, brand, harga, stok) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $nama_produk, $brand, $harga, $stok);

        if ($stmt->execute()) {
            echo "<script>alert('Produk berhasil ditambahkan!'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan produk: " . $conn->error . "'); history.go(-1);</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Data tidak valid. Mohon cek input Anda.'); history.go(-1);</script>";
    }
} else {
    echo "<script>alert('Invalid request method!'); window.location='index.php';</script>";
}

// Menutup koneksi
$conn->close();
