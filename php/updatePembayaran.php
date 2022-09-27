<?php
session_start();
require 'functions.php';

$_SESSION["admin"] = "admin";
$id_order = $_GET["id_order"];
$result = mysqli_query($conn, "SELECT * FROM pembayaran WHERE id_order = $id_order");
$data = mysqli_fetch_assoc($result);

if (isset($_POST["bayar"])) {
    if (updatePembayaran($_POST) > 0) {
        echo "<script type='text/javascript'>
                    alert('Data Pembayaran Berhasil Di Update!');
                    document.location.href = 'adminPembayaran.php';
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
    <title>FRESH LAUNDRY | UPDATE PEMBAYARAN</title>
    <link rel="stylesheet" type="text/css" href="../css/style_updatePembayaran.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="container-header">
            <h2>Update Pembayaran</h2>
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
                    <label>Metode Pembayaran</label>
                    <div class="custom_select">
                        <select name="metode" id="metode" onchange="pilih()" required>
                            <option value="">Pilih</option>
                            <option value="1" <?php if ($data["metode_pembayaran"] == "OVO") {
                                                    echo "selected";
                                                } ?>>OVO</option>
                            <option value="2" <?php if ($data["metode_pembayaran"] == "GoPay") {
                                                    echo "selected";
                                                } ?>>GoPay</option>
                            <option value="3" <?php if ($data["metode_pembayaran"] == "Transfer Bank") {
                                                    echo "selected";
                                                } ?>>Transfer Bank</option>
                            <option value="4" <?php if ($data["metode_pembayaran"] == "Cash On Delivery") {
                                                    echo "selected";
                                                } ?>>COD</option>
                        </select>
                    </div>
                    <input type="hidden" class="metode_pembayaran" id="metode_pembayaran" name="metode_pembayaran">
                    <input type="hidden" class="tanggal" id="tanggal" name="tanggal">
                </div>
                <div class="input_container">
                    <label>Total Harga</label>
                    <div class="harga"><label>Rp</label></div>
                    <input type="number" class="total_harga" id="total_harga" name="total_harga" value="<?php echo $data["total_harga"]; ?>" required>
                </div>
                <div class="input_container">
                    <label>Nominal Pembayaran</label>
                    <div class="harga"><label>Rp</label></div>
                    <input type="number" class="nominal_pembayaran" id="nominal_pembayaran" name="nominal_pembayaran" value="<?php echo $data["nominal_pembayaran"]; ?>" onchange="hitung()" required>
                </div>
                <div class="input_container">
                    <label>Jumlah Kembalian</label>
                    <div class="harga"><label>Rp</label></div>
                    <input type="number" class="jumlah_kembalian" id="jumlah_kembalian" name="jumlah_kembalian" value="<?php echo $data["jumlah_kembalian"]; ?>" required>
                </div>
                <button type="submit" name="bayar">Update</button>
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