<?php
session_start();
require 'functions.php';

$result = mysqli_query($conn, "SELECT * FROM users");
$_SESSION["admin"] = "admin";

if (isset($_POST["cari"])) {
    $keyword = $_POST["keyword"];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE nama_lengkap LIKE '%$keyword%'");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FRESH LAUNDRY | ADMIN</title>
    <link rel="stylesheet" type="text/css" href="../css/style_adminUser.css">
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
            <li><a href="adminOrder.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>List Order</a></li>
            <li><a href="adminPembayaran.php"><i class="fa fa-money" aria-hidden="true"></i>List Pembayaran</a></li>
            <li class="on"><a href="adminUser.php"><i class="fa fa-user" aria-hidden="true"></i>List User</a></li>
            <li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Log Out</a></li>
        </ul>
    </div>

    <header>
        <div class="container-header">
            <h2>List User</h2>
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
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Jenis Kelamin</th>
                <th>No Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row) : ?>
                <tr>
                    <td><?php echo $row['id_user']; ?></td>
                    <td><?php echo $row['nama_lengkap']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['jenis_kelamin']; ?></td>
                    <td><?php echo $row['no_telepon']; ?></td>
                    <td><?php echo $row['alamat']; ?></td>
                    <td class="aksi"><a href="hapusUser.php?id_user=<?php echo $row['id_user']; ?>"><button class="hapus"><i class="fas fa-trash"></i></button></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>