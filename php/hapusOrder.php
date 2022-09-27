<?php
require 'functions.php';

$id_order = $_GET["id_order"];

if (hapusOrder($id_order) > 0) {
    echo "
            <script>
                alert('Data Berhasil Di Hapus!')
                document.location.href = 'adminOrder.php';
            </script>";
} else {
    echo mysqli_error($conn);
    echo "
    <script>
        alert('data gagal dihapus!')
    </script>";
}
