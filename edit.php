<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'toko_kosmetik');

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID dari URL, pastikan adalah angka
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Validasi ID yang diterima
if ($id <= 0) {
    die("ID produk tidak valid.");
}

// Ambil data produk berdasarkan ID
$stmt = $conn->prepare("SELECT * FROM produk WHERE id = ?");
$stmt->bind_param("i", $id); // "i" untuk integer
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Produk tidak ditemukan.");
}

// Ambil data produk
$data = $result->fetch_assoc();

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = isset($_POST['nama_produk']) ? trim($_POST['nama_produk']) : '';
    $harga = isset($_POST['harga']) ? (float)$_POST['harga'] : 0;
    $stok = isset($_POST['stok']) ? (int)$_POST['stok'] : 0;

    if ($nama_produk !== '' && $harga > 0 && $stok >= 0) {
        // Update data produk dengan prepared statement untuk menghindari SQL Injection
        $update_stmt = $conn->prepare("UPDATE produk SET nama_produk = ?, harga = ?, stok = ? WHERE id = ?");
        $update_stmt->bind_param("sdii", $nama_produk, $harga, $stok, $id);

        if ($update_stmt->execute()) {
            // Redirect ke index.php setelah update berhasil
            header('Location: index.php');
            exit;
        } else {
            echo "Error: Gagal memperbarui produk.";
        }

        $update_stmt->close();
    } else {
        echo "Input tidak valid. Silakan periksa kembali data yang dimasukkan.";
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Ubah Produk</h2>
    <form action="" method="post">
        <label for="nama_produk">Nama Produk:</label>
        <input type="text" id="nama_produk" name="nama_produk" value="<?= htmlspecialchars($data['nama_produk']); ?>" required><br>

        <label for="harga">Harga:</label>
        <input type="number" id="harga" name="harga" value="<?= htmlspecialchars($data['harga']); ?>" required><br>

        <label for="stok">Stok:</label>
        <input type="number" id="stok" name="stok" value="<?= htmlspecialchars($data['stok']); ?>" required><br>

        <button type="submit">Ubah</button>
    </form>
</body>
</html>
