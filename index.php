<?php
session_start();

// Cek apakah admin sudah login
$loggedIn = isset($_SESSION['admin']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Kosmetik</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header a {
            text-decoration: none;
            color: white;
            padding: 10px 15px;
            background-color: #007BFF;
            border-radius: 5px;
        }
        .header a:hover {
            background-color: #0056b3;
        }
        .header .auth-buttons a {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Daftar Produk Kosmetik</h1>
        <div class="auth-buttons">
            <?php if ($loggedIn): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login Admin</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Form Pencarian -->
    <form method="get" style="margin-bottom: 20px;">
        <input type="text" name="keyword" placeholder="Cari produk atau brand..." value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
        <button type="submit">Cari</button>
        <a href="index.php"><button type="button">Reset</button></a>
    </form>
    
    <?php if ($loggedIn): ?>
        <a href="add.php"><button class="tambah">Tambahkan Produk</button></a>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Brand</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Koneksi database
            $conn = new mysqli('localhost', 'root', '', 'toko_kosmetik');
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            // Query pencarian
            $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
            $sql = "SELECT * FROM produk";
            if (!empty($keyword)) {
                $sql .= " WHERE nama_produk LIKE ? OR brand LIKE ?";
            }

            $stmt = $conn->prepare($sql);
            if (!empty($keyword)) {
                $search = "%$keyword%";
                $stmt->bind_param("ss", $search, $search);
            }
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $no = 1;
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama_produk']); ?></td>
                        <td><?= htmlspecialchars($row['brand']); ?></td>
                        <td>Rp. <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td><?= $row['stok']; ?></td>
                        <td>
                            <?php if ($loggedIn): ?>
                                <a href="edit.php?id=<?= $row['id']; ?>">
                                    <button class="ubah">Ubah</button>
                                </a>
                                <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                    <button class="hapus">Hapus</button>
                                </a>
                            <?php else: ?>
                                <span>-</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="6">Data tidak ditemukan.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
