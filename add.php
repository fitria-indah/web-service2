<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambahkan Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Tambahkan Produk</h1>
    <form action="save.php" method="post">
        <div class="form-group">
            <label for="nama_produk">Nama Produk:</label>
            <input type="text" id="nama_produk" name="nama_produk" required>
        </div>
        <div class="form-group">
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" required>
        </div>
        <div class="form-group">
            <label for="harga">Harga:</label>
            <input type="number" id="harga" name="harga" required>
        </div>
        <div class="form-group">
            <label for="stok">Stok:</label>
            <input type="number" id="stok" name="stok" required>
        </div>
        <button type="submit" class="submit">Simpan</button>
        <a href="index.php"><button type="button" class="back">Kembali</button></a>
    </form>
</body>
</html>
