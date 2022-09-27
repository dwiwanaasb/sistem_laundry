<?php
session_start();
unset($_SESSION["total_harga"]);
require 'functions.php';

$result = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FRESH LAUNDRY | DAFTAR HARGA</title>
    <link rel="stylesheet" type="text/css" href="../css/style_daftarHarga.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <input type="checkbox" id="check">
    <label for="check">
        <i class="fa fa-bars" aria-hidden="true" id="btn"></i>
        <i class="fa fa-times" aria-hidden="true" id="cancel"></i>
    </label>

    <div class="sidebar">
        <header>Menu</header>
        <ul>
            <li class="on"><a href="daftarHarga.php"><i class="fa fa-list-alt" aria-hidden="true"></i>Daftar Harga</a></li>
            <li><a href="order.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Pemesanan Laundry</a></li>
            <li><a href="pembayaran.php"><i class="fa fa-money" aria-hidden="true"></i>Pembayaran</a></li>
            <li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Log Out</a></li>
        </ul>
    </div>

    <header>
        <div class="container-header">
            <h2>Daftar Harga</h2>
            <ul>
                <li>
                    <?php
                    $user_terlogin = $_SESSION["username"];
                    $sql_user = mysqli_query($conn, "SELECT * FROM users WHERE id_user = $user_terlogin");
                    $data_user = mysqli_fetch_assoc($sql_user);
                    ?>
                    <a href="updateProfile.php">Selamat Datang, <?php error_reporting(0);
                                                                echo $data_user["username"]; ?> </a>
                </li>
            </ul>
        </div>
    </header>
    <table class="content-table">
        <thead>
            <tr>
                <th>Paket</th>
                <th>Jenis Laundry</th>
                <th>Jenis Cuci</th>
                <th>Harga (Per Kg) </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Reguler (3 Hari)</td>
                <td>Cuci Kering</td>
                <td>Rp 5.000</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Reguler (3 Hari)</td>
                <td>Cuci Setrika</td>
                <td>Rp 7.000</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Express (1 Hari)</td>
                <td>Cuci Kering</td>
                <td>Rp 8.000</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Express (1 Hari)</td>
                <td>Cuci Setrika</td>
                <td>Rp 10.000</td>
            </tr>
        </tbody>
    </table>
</body>

</html>