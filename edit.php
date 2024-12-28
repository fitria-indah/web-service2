<?php
$conn = new mysqli('localhost', 'root', '', 'tokobuku');
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data buku berdasarkan ID
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM buku WHERE id = $id");
$buku = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_buku = $_POST['nama_buku'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    $stmt = $conn->prepare("UPDATE buku SET nama_buku = ?, harga = ?, jumlah = ? WHERE id = ?");
    $stmt->bind_param("siii", $nama_buku, $harga, $jumlah, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Gagal mengupdate data: " . $conn->error;
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
    <title>Edit Buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Buku</h1>
    <form method="POST">
        <input type="text" name="nama_buku" value="<?= $buku['nama_buku']; ?>" required>
        <input type="number" name="harga" value="<?= $buku['harga']; ?>" required>
        <input type="number" name="jumlah" value="<?= $buku['jumlah']; ?>" required>
        <button type="submit" class="ubah">Simpan Perubahan</button>
    </form>
</body>
</html>
