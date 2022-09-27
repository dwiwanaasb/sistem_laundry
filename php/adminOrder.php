<?php
session_start();
require 'functions.php';

$result = mysqli_query($conn, "SELECT * FROM orders");
$_SESSION["admin"] = "admin";

if (isset($_POST["cari"])) {
    $keyword = $_POST["keyword"];
    $result = mysqli_query($conn, "SELECT * FROM orders WHERE nama LIKE '%$keyword%'");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FRESH LAUNDRY | ADMIN</title>
    <link rel="stylesheet" type="text/css" href="../css/style_adminOrder.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <input type="checkbox" id="check">
    <label for="check">
        <i class="fa fa-bars" aria-hidden="true" id="btn"></i>
        <i class="fa fa-times" aria-hidden="true" id="cancel"></i>
    </label>
    <div class="sidebar">
        <header>Menu Admin</header>
        <ul>
            <li class="on"><a href="adminOrder.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>List Order</a></li>
            <li><a href="adminPembayaran.php"><i class="fa fa-money" aria-hidden="true"></i>List Pembayaran</a></li>
            <li><a href="adminUser.php"><i class="fa fa-user" aria-hidden="true"></i>List User</a></li>
            <li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Log Out</a></li>
        </ul>
    </div>

    <header>
        <div class="container-header">
            <h2>List Order</h2>
            <ul>
                <li>
                    <a>Selamat Datang, <?php error_reporting(0);
                                        echo $_SESSION["admin"]; ?> </a>
                </li>
            </ul>
        </div>
    </header>

    <div class="container-search">
        <form method="post" action="">
            <input type="text" name="keyword" placeholder="Masukkan Nama User..." autocomplete="off">
            <button type="submit" name="cari"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <table class="content-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Laundry</th>
                <th>Jenis Cuci</th>
                <th>Tanggal Masuk</th>
                <th>Tanggal Keluar</th>
                <th>Berat(kg)</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row) : ?>
                <tr>
                    <td><?php echo $row['id_order']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['jenis_laundry']; ?></td>
                    <td><?php echo $row['jenis_cuci']; ?></td>
                    <td><?php echo $row['tanggal_masuk']; ?></td>
                    <td><?php echo $row['tanggal_keluar']; ?></td>
                    <td><?php echo $row['berat']; ?></td>
                    <td><?php echo $row['total_harga']; ?></td>
                    <td class="aksi"><a href="updateOrder.php?id_order=<?php echo $row['id_order']; ?>"><button class="update"><i class="fas fa-pencil-alt"></i></button></a><a href="hapusOrder.php?id_order=<?php echo $row['id_order']; ?>"><button class="hapus"><i class="fas fa-trash"></i></button></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>