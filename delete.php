<?php
$conn = new mysqli('localhost', 'root', '', 'tokobuku');
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET['id'];
$conn->query("DELETE FROM buku WHERE id = $id");

header("Location: index.php");
?>
