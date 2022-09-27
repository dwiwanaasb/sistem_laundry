<?php
session_start();
require 'functions.php';

$result = mysqli_query($conn, "SELECT * FROM orders ORDER BY id_order DESC LIMIT 1");
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FRESH LAUNDRY | BUKTI TRANSAKSI</title>
    <link rel="stylesheet" type="text/css" href="../css/style_cetakBukti.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="container-header">
            <h2>Bukti Transaksi</h2>
        </div>
    </header>

    <table>
        <tr>
            <th>No</th>
            <td><?php echo $row['id_order']; ?></td>
        </tr>
        <tr>
            <th>Nama</th>
            <td><?php echo $row['nama']; ?></td>
        </tr>
        <tr>
            <th>Tanggal Masuk</th>
            <td><?php echo $row['tanggal_masuk']; ?></td>
        </tr>
        <tr>
            <th>Tanggal Keluar</th>
            <td><?php echo $row['tanggal_keluar']; ?></td>
        </tr>
        <tr>
            <th>Jenis Laundry</th>
            <td><?php echo $row['jenis_laundry']; ?></td>
        </tr>
        <tr>
            <th>Jenis Cuci</th>
            <td><?php echo $row['jenis_cuci']; ?></td>
        </tr>
        <tr>
            <th>Metode Pembayaran</th>
            <td><?php echo $_SESSION["metode_pembayaran"]; ?></td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td><?php echo $row['total_harga']; ?></td>
        </tr>
    </table>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>