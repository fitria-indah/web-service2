<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'toko_kosmetik');

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID dari URL, pastikan adalah angka
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    // Siapkan statement untuk menghapus produk berdasarkan ID
    $stmt = $conn->prepare("DELETE FROM produk WHERE id = ?");
    $stmt->bind_param("i", $id); // "i" artinya integer

    // Eksekusi statement
    if ($stmt->execute()) {
        // Redirect ke index.php setelah berhasil
        header('Location: index.php');
        exit;
    } else {
        echo "Error: Gagal menghapus produk.";
    }

    // Tutup statement
    $stmt->close();
} else {
    echo "ID produk tidak valid.";
}

// Tutup koneksi
$conn->close();
?>
