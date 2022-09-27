<?php
session_start();
require 'functions.php';

$_SESSION["admin"] = "admin";
$id_order = $_GET["id_order"];
$result = mysqli_query($conn, "SELECT * FROM orders WHERE id_order = $id_order");
$data = mysqli_fetch_assoc($result);

if (isset($_POST["order"])) {
    if (updateOrder($_POST) > 0) {
        $data["total_harga"] = 0;
        echo "<script type='text/javascript'>
                    alert('Data Order Berhasil Di Update!');
                    document.location.href = 'adminOrder.php';
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
    <title>FRESH LAUNDRY | UPDATE ORDER</title>
    <link rel="stylesheet" type="text/css" href="../css/style_updateOrder.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="container-header">
            <h2>Pemesanan Laundry</h2>
            <ul>
                <li>
                    <a href="">Selamat Datang, <?php error_reporting(0);
                                                echo $_SESSION["admin"]; ?> </a>
                </li>
            </ul>
        </div>
    </header>

    <div class="container">
        <div class="content-form">
            <form method="post" action="" class="form">
                <input type="hidden" name="id_order" value="<?php echo $data["id_order"]; ?>">
                <div class="input_container">
                    <label>Paket Yang Anda Pilih</label>
                    <div class="custom_select">
                        <select name="paket" id="paket" onchange="pilih()" required>
                            <option value="">Pilih</option>
                            <option value="1" <?php if ($data["jenis_laundry"] == "reguler" && $data["jenis_cuci"] == "cuci kering") {
                                                    echo "selected";
                                                } ?>>Paket 1</option>
                            <option value="2" <?php if ($data["jenis_laundry"] == "reguler" && $data["jenis_cuci"] == "cuci kering") {
                                                    echo "selected";
                                                } ?>>Paket 2</option>
                            <option value="3" <?php if ($data["jenis_laundry"] == "express" && $data["jenis_cuci"] == "cuci kering") {
                                                    echo "selected";
                                                } ?>>Paket 3</option>
                            <option value="4" <?php if ($data["jenis_laundry"] == "express" && $data["jenis_cuci"] == "cuci kering") {
                                                    echo "selected";
                                                } ?>>Paket 4</option>
                        </select>
                    </div>
                </div>

                <div class="input_container">
                    <label>Nama</label>
                    <input type="text" class="input" id="nama" name="nama" readonly value='<?php error_reporting(0);
                                                                                            echo $data["nama"]; ?>'>
                </div>
                <div class="input_container">
                    <label>Jenis Laundry</label>
                    <input type="text" class="input" id="jenis_laundry" name="jenis_laundry" value="<?php echo $data["jenis_laundry"]; ?>" required>
                </div>
                <div class="input_container">
                    <label>Jenis Cuci</label>
                    <input type="text" class="input" id="jenis_cuci" name="jenis_cuci" value="<?php echo $data["jenis_cuci"]; ?>" required>
                </div>
                <div class="input_container">
                    <label>Tanggal Masuk</label>
                    <input type="text" class="input" id="tanggal_masuk" name="tanggal_masuk" value="<?php echo $data["tanggal_masuk"]; ?>" required>
                </div>
                <div class="input_container">
                    <label>Tanggal Keluar</label>
                    <input type="text" class="input" id="tanggal_keluar" name="tanggal_keluar" value="<?php echo $data["tanggal_keluar"]; ?>" required>
                </div>
                <div class="input_container">
                    <label>Berat</label>
                    <input type="number" class="input-berat" id="berat" name="berat" value="<?php echo $data["berat"]; ?>" onchange="hitung()" required>
                    <div class="berat"><label>Kg</label></div>
                </div>
                <div class="input_container">
                    <label>Total Harga</label>
                    <div class="harga"><label>Rp</label></div>
                    <input type="text" class="total_harga" id="total_harga" name="total_harga" value="<?php echo $data["total_harga"]; ?>" required>
                </div>
                <button type="submit" name="order">Update</button>
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