<?php
require_once 'manager.php';
require_once 'customerManager.php';

$customerManager = new customerManager();

// menangani form tambah barang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $nama = $_POST ['nama'];
    $email = $_POST ['email'];
    $customerManager->tambahCustomer($nama, $email);
    header('location: dataCustomer.php');  
}

// menangani penghapusan barang
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $customerManager->hapusCustomer($id);
    header('location: dataCustomer.php'); //redirect setelah menghapus
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Customer</title>
    <link rel="stylesheet" href="style.css?v=<?= filemtime('style.css')?>">
</head>

<body>
    <div class="container">
        <nav>
            <a href="home.php">Home</a>
            <a href="dataBarang.php">Data Barang</a>
            <a href="dataCustomer.php">Data Customer</a>
        </nav>
        
        <h1>Data Customer</h1>
        <form method="POST" action="">
            <div>
                <label for="nama">Nama Customer:</label>
                <input type="text" id="nama" name="nama" required>
            </div><br>
            <div>
                <label for="email">Email Customer:</label>
                <input type="email" id="email" name="email" required>
            </div><br>
            <button type="submit" name="tambah" class="btn btn-add">Tambah Customer</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'CustomerManager.php';
                $customerManager = new CustomerManager();
                $customerList = $customerManager->getCustomer();
                foreach ($customerList as $customer) : ?>
                <tr>
                    <td><?= $customer['id'] ?></td>
                    <td><?= $customer['nama'] ?></td>
                    <td><?= $customer['email'] ?></td>
                    <td>
                        <a href="?hapus=<?= $customer['id'] ?>" class="btn btn-delete">Hapus</a>
                    </td>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    </div>
</div>
</body>

</html>