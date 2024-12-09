<?php
require_once 'Barang.php';
require_once 'BarangManager.php';

$BarangManager = new BarangManager();

// menangani form tambah barang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $nama = $_POST ['nama'];
    $harga = $_POST ['harga'];
    $stok = $_POST ['stok'];
    $BarangManager->tambahBarang($nama, $harga, $stok);
    header('location: dataBarang.php');  
}

// menangani penghapusan barang
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $BarangManager->hapusBarang($id);
    header('location: dataBarang.php'); //redirect setelah menghapus
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencatatan Barang</title>
    <link rel="stylesheet" href="style.css?v=<?= filemtime('style.css')?>">
    </head>

    
    <body>
        <div class="container">
            <nav>
                 <a href="home.php"> Home</a>    
                 <a href="dataBarang.php"> Data Barang</a>    
                 <a href="dataCustomer.php"> Data Customer</a>
            </nav>

            <h1>Data Barang</h1>
            <form method="POST" action="">
            <div>
                <label for="nama">Nama Barang</label>
                <input type="text" id="nama" name="nama" required>
            </div><br>
            <div>
                <label for="harga">Harga Barang</label>
                <input type="number" id="harga" name="harga" required>
            </div><br>
            <div>
                <label for="stok">Stok Barang</label>
                <input type="number" id="stok" name="stok" required>
            </div><br>
            <button type="submit" name="tambah" class="btn btn-add">Tambah Barang</button>
        </form>

            
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($BarangManager->getBarang() as $barang): ?>
                        <tr>
                            <td><?= $barang['id'] ?></td>
                            <td><?= $barang['nama'] ?></td>
                            <td><?= $barang['harga'] ?></td>
                            <td><?= $barang['stok'] ?></td>
                            <td>
                                <a href="?hapus=<?= $barang['id'] ?>" class="btn btn-delete">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>