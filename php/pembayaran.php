<?php
session_start();
require 'functions.php';

if (isset($_POST["bayar"])) {
    if (pembayaran($_POST) > 0) {
        $_SESSION["total_harga"] = 0;
        $metode_pembayaran = $_POST["metode_pembayaran"];
        $_SESSION["metode_pembayaran"] = $metode_pembayaran;

        echo "<script type='text/javascript'>
                    alert('Cetak Bukti Transaksi!');
                    document.location.href = 'cetakBukti.php';
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
    <title>FRESH LAUNDRY | PEMBAYARAN</title>
    <link rel="stylesheet" type="text/css" href="../css/style_pembayaran.css">
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
            <li><a href="order.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Pemesanan Laundry</a></li>
            <li class="on"><a href="pembayaran.php"><i class="fa fa-money" aria-hidden="true"></i>Pembayaran</a></li>
            <li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Log Out</a></li>
        </ul>
    </div>

    <header>
        <div class="container-header">
            <h2>Pembayaran</h2>
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
                    <label>Metode Pembayaran</label>
                    <div class="custom_select">
                        <select name="metode" id="metode" onchange="pilih()" required>
                            <option value="">Pilih</option>
                            <option value="1">OVO</option>
                            <option value="2">GoPay</option>
                            <option value="3">Transfer Bank</option>
                            <option value="4">COD</option>
                        </select>
                    </div>
                    <input type="hidden" class="metode_pembayaran" id="metode_pembayaran" name="metode_pembayaran">
                    <input type="hidden" class="tanggal" id="tanggal" name="tanggal">
                </div>
                <div class="input_container">
                    <label>Total Harga</label>
                    <div class="harga"><label>Rp</label></div>
                    <input type="text" class="total_harga" id="total_harga" name="total_harga" readonly value='<?php error_reporting(0);
                                                                                                                echo $_SESSION["total_harga"]; ?>'>
                </div>
                <div class="input_container">
                    <label>Nominal Pembayaran</label>
                    <div class="harga"><label>Rp</label></div>
                    <input type="number" min="0" class="nominal_pembayaran" id="nominal_pembayaran" name="nominal_pembayaran" required value="0" onchange="hitung()">
                </div>
                <div class="input_container">
                    <label>Jumlah Kembalian</label>
                    <div class="harga"><label>Rp</label></div>
                    <input type="text" class="jumlah_kembalian" id="jumlah_kembalian" name="jumlah_kembalian" readonly value="0">
                </div>
                <button type="submit" name="bayar">Bayar</button>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        function pilih() {
            var pilih_metode = document.getElementById("metode");
            var pilihan = pilih_metode.options[pilih_metode.selectedIndex].text;
            document.getElementById("metode_pembayaran").value = pilihan;
        }
    </script>

    <script type="text/javascript">
        function hitung() {
            var total = parseInt(document.getElementById('total_harga').value);
            var nominal = parseInt(document.getElementById('nominal_pembayaran').value);

            if (nominal < total) {
                var kembalian = 0;
            } else {
                var kembalian = nominal - total;
            }
            document.getElementById('jumlah_kembalian').value = kembalian;
        }
    </script>

    <script type='text/javascript'>
        var months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth();
        var yy = date.getYear();
        var year = (yy < 1000) ? yy + 1900 : yy;
        var tanggal = day + ' - ' + months[month] + ' - ' + year;

        document.getElementById('tanggal').value = tanggal;
    </script>
</body>

</html>