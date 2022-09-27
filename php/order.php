<?php
session_start();
require 'functions.php';
$result = mysqli_query($conn, "SELECT * FROM users");

if (isset($_POST["order"])) {
    if (order($_POST) > 0) {
        $total_harga = $_POST["total_harga"];
        $_SESSION["total_harga"] = $total_harga;

        echo "<script  type='text/javascript'>
                    alert('Order Berhasil Ditambahkan!');
                    document.location.href = 'pembayaran.php';
                </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FRESH LAUNDRY | ORDER</title>
    <link rel="stylesheet" type="text/css" href="../css/style_order.css">
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
            <li><a href="daftarHarga.php"><i class="fa fa-list-alt" aria-hidden="true"></i>Daftar Harga</a></li>
            <li class="on"><a href="order.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Pemesanan Laundry</a></li>
            <li><a href="pembayaran.php"><i class="fa fa-money" aria-hidden="true"></i>Pembayaran</a></li>
            <li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Log Out</a></li>
        </ul>
    </div>

    <header>
        <div class="container-header">
            <h2>Pemesanan Laundry</h2>
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

    <div class="container">
        <div class="content-form">
            <form method="post" action="" class="form">
                <div class="input_container">
                    <label>Paket Yang Anda Pilih</label>
                    <div class="custom_select">
                        <select name="paket" id="paket" onchange="pilih()" required>
                            <option value="">Pilih</option>
                            <option value="1">Paket 1</option>
                            <option value="2">Paket 2</option>
                            <option value="3">Paket 3</option>
                            <option value="4">Paket 4</option>
                        </select>
                    </div>
                </div>
                <div class="input_container">
                    <label>Nama</label>
                    <input type="text" class="input" id="nama" name="nama" readonly value='<?php error_reporting(0);
                                                                                            echo $data_user["username"]; ?>'>
                </div>
                <div class="input_container">
                    <label>Jenis Laundry</label>
                    <input type="text" class="input" id="jenis_laundry" name="jenis_laundry" readonly>
                </div>
                <div class="input_container">
                    <label>Jenis Cuci</label>
                    <input type="text" class="input" id="jenis_cuci" name="jenis_cuci" readonly>
                </div>
                <div class="input_container">
                    <label>Tanggal Masuk</label>
                    <input type="text" class="input" id="tanggal_masuk" name="tanggal_masuk" readonly>
                </div>
                <div class="input_container">
                    <label>Tanggal Keluar</label>
                    <input type="text" class="input" id="tanggal_keluar" name="tanggal_keluar" readonly>
                </div>
                <div class="input_container">
                    <label>Berat</label>
                    <input type="number" min="0" class="input-berat" id="berat" name="berat" onchange="hitung()" required>
                    <div class="berat"><label>Kg</label></div>
                </div>
                <div class="input_container">
                    <label>Total Harga</label>
                    <div class="harga"><label>Rp</label></div>
                    <?php error_reporting(0); ?>
                    <input type="text" class="total_harga" id="total_harga" name="total_harga" readonly>
                </div>
                <button type="submit" name="order">Order</button>
            </form>
        </div>
    </div>

    <script type='text/javascript'>
        var months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth();
        var yy = date.getYear();
        var year = (yy < 1000) ? yy + 1900 : yy;
        var tanggalmasuk = day + ' - ' + months[month] + ' - ' + year;

        document.getElementById('tanggal_masuk').value = tanggalmasuk;
    </script>

    <script type="text/javascript">
        function pilih() {
            var pilih_paket = document.getElementById("paket");
            var pilihan = pilih_paket.options[pilih_paket.selectedIndex].text;

            if (pilihan == "Paket 1") {
                var jenisLaundry = "reguler";
                var jenisCuci = "cuci kering";
                tanggalkeluar = 3 + day + ' - ' + months[month] + ' - ' + year;

            } else if (pilihan == "Paket 2") {
                var jenisLaundry = "reguler";
                var jenisCuci = "cuci setrika";
                tanggalkeluar = 3 + day + ' - ' + months[month] + ' - ' + year;

            } else if (pilihan == "Paket 3") {
                var jenisLaundry = "express";
                var jenisCuci = "cuci kering";
                tanggalkeluar = 1 + day + ' - ' + months[month] + ' - ' + year;

            } else if (pilihan == "Paket 4") {
                var jenisLaundry = "express";
                var jenisCuci = "cuci setrika";
                tanggalkeluar = 1 + day + ' - ' + months[month] + ' - ' + year;
            }
            document.getElementById('jenis_laundry').value = jenisLaundry;
            document.getElementById('jenis_cuci').value = jenisCuci;
            document.getElementById('tanggal_keluar').value = tanggalkeluar;
        }
    </script>

    <script type="text/javascript">
        function hitung() {
            var pilih_paket = document.getElementById("paket");
            var pilihan = pilih_paket.options[pilih_paket.selectedIndex].text;
            var berat = parseInt(document.getElementById('berat').value);

            if (pilihan == "Paket 1") {
                if (berat < 0) {
                    total_harga = 0;
                } else {
                    total_harga = parseInt(berat) * 5000;
                }
            } else if (pilihan == "Paket 2") {
                if (berat < 0) {
                    total_harga = 0;
                } else {
                    total_harga = parseInt(berat) * 7000;
                }
            } else if (pilihan == "Paket 3") {
                if (berat < 0) {
                    total_harga = 0;
                } else {
                    total_harga = parseInt(berat) * 8000;
                }
            } else if (pilihan == "Paket 4") {
                if (berat < 0) {
                    total_harga = 0;
                } else {
                    total_harga = parseInt(berat) * 10000;
                }
            }
            document.getElementById('total_harga').value = total_harga;
        }
    </script>
</body>

</html>