<?php
require 'functions.php';

$order_id = $_GET["order_id"];

if (hapusPembayaran($order_id) > 0) {
    echo "
            <script>
                alert('Data Berhasil Di Hapus!')
                document.location.href = 'adminPembayaran.php';
            </script>";
} else {
    echo mysqli_error($conn);
    echo "
    <script>
        alert('data gagal dihapus!')
    </script>";
}
