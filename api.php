<?php
$conn = new mysqli('localhost', 'root', '', 'toko_kosmetik');
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $result = $conn->query("SELECT * FROM produk");
        echo json_encode($result->fetch_all(MYSQLI_ASSOC));
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $conn->query("INSERT INTO produk (nama_produk, harga, stok) VALUES ('{$data['nama_produk']}', {$data['harga']}, {$data['stok']})");
        echo json_encode(['status' => 'success']);
        break;
}
?>
