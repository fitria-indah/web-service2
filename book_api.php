<?php
header('Content-Type: application/json');

// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'tokobuku');
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Koneksi gagal: ' . $conn->connect_error]);
    exit;
}

// Validasi data
$nama_buku = $_POST['nama_buku'] ?? '';
$harga = $_POST['harga'] ?? 0;
$jumlah = $_POST['jumlah'] ?? 0;

if (empty($nama_buku) || $harga <= 0 || $jumlah <= 0) {
    echo json_encode(['success' => false, 'message' => 'Data tidak valid.']);
    exit;
}

// Tambah buku ke database
$stmt = $conn->prepare("INSERT INTO buku (nama_buku, harga, jumlah) VALUES (?, ?, ?)");
$stmt->bind_param('sii', $nama_buku, $harga, $jumlah);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Buku berhasil ditambahkan.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal menambahkan buku.']);
}
?>
