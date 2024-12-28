<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'tokobuku');
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil data dari form
    $nama_buku = $_POST['nama_buku'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    // Tambahkan data ke database
    $stmt = $conn->prepare("INSERT INTO buku (nama_buku, harga, jumlah) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $nama_buku, $harga, $jumlah);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Gagal menambah data: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Tambah Buku</h1>
    <form method="POST">
        <input type="text" name="nama_buku" placeholder="Nama Buku" required>
        <input type="number" name="harga" placeholder="Harga" required>
        <input type="number" name="jumlah" placeholder="Jumlah" required>
        <button type="submit" class="tambah">Tambahkan</button>
    </form>
</body>
</html>
