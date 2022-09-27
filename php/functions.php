<?php
$conn = mysqli_connect("localhost", "root", "", "project-laundry");

function registrasi($data)
{
    global $conn;

    $fullname = $data["fullname"];
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $jenis_kelamin = $data["jenis_kelamin"];
    $number = $data["number"];
    $address = $data["address"];

    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                        alert('Username Sudah Terdaftar !');
                    </script>";
        return false;
    }

    if ($password !== $password2) {
        echo "<script>
                        alert('Konfirmasi Password tidak Sesuai !');
                    </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO users VALUES(
                '',
                '$fullname',
                '$username',
                '$password',
                '$jenis_kelamin',
                '$number',
                '$address')");
    return mysqli_affected_rows($conn);
}

function order($data)
{
    global $conn;

    $nama = $data["nama"];
    $jenis_laundry = $data["jenis_laundry"];
    $jenis_cuci = $data["jenis_cuci"];
    $tanggal_masuk = $data["tanggal_masuk"];
    $tanggal_keluar = $data["tanggal_keluar"];
    $berat = $data["berat"];
    $total_harga = $data["total_harga"];

    mysqli_query($conn, "INSERT INTO orders VALUES(
                '',
                '$nama',
                '$jenis_laundry',
                '$jenis_cuci',
                '$tanggal_masuk',
                '$tanggal_keluar',
                '$berat',
                '$total_harga')");
    return mysqli_affected_rows($conn);
}

function pembayaran($data)
{
    global $conn;

    $metode_pembayaran = $data["metode_pembayaran"];
    $tanggal = $data["tanggal"];
    $total_harga = $data["total_harga"];
    $nominal_pembayaran = $data["nominal_pembayaran"];
    $jumlah_kembalian = $data["jumlah_kembalian"];

    mysqli_query($conn, "INSERT INTO pembayaran VALUES(
                '',
                '$metode_pembayaran',
                '$tanggal',
                '$total_harga',
                '$nominal_pembayaran',
                '$jumlah_kembalian')");
    return mysqli_affected_rows($conn);
}

function hapusUser($id_user)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM users WHERE id_user = $id_user");

    return mysqli_affected_rows($conn);
}

function hapusOrder($id_order)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM orders WHERE id_order = $id_order");

    return mysqli_affected_rows($conn);
}

function hapusPembayaran($id_order)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM pembayaran WHERE id_order = $id_order");

    return mysqli_affected_rows($conn);
}

function updateOrder($data)
{
    global $conn;

    $id_order = $data["id_order"];
    $nama = $data["nama"];
    $jenis_laundry = $data["jenis_laundry"];
    $jenis_cuci = $data["jenis_cuci"];
    $tanggal_masuk = $data["tanggal_masuk"];
    $tanggal_keluar = $data["tanggal_keluar"];
    $berat = $data["berat"];
    $total_harga = $data["total_harga"];

    mysqli_query($conn, "UPDATE orders SET 
                        nama = '$nama',
                        jenis_laundry = '$jenis_laundry',
                        jenis_cuci = '$jenis_cuci', 
                        tanggal_masuk = '$tanggal_masuk',
                        tanggal_keluar = '$tanggal_keluar',
                        berat = '$berat',
                        total_harga = '$total_harga'
                        WHERE id_order = $id_order");
    return mysqli_affected_rows($conn);
}

function updatePembayaran($data)
{
    global $conn;

    $id_order = $data["id_order"];
    $metode_pembayaran = $data["metode_pembayaran"];
    $tanggal = $data["tanggal"];
    $total_harga = $data["total_harga"];
    $nominal_pembayaran = $data["nominal_pembayaran"];
    $jumlah_kembalian = $data["jumlah_kembalian"];

    mysqli_query($conn, "UPDATE pembayaran SET 
                        metode_pembayaran = '$metode_pembayaran', 
                        tanggal = '$tanggal', 
                        total_harga = '$total_harga',
                        nominal_pembayaran = '$nominal_pembayaran',
                        jumlah_kembalian = '$jumlah_kembalian' 
                        WHERE id_order = $id_order");
    return mysqli_affected_rows($conn);
}

function updateProfile($data)
{
    global $conn;

    $sesi = $_SESSION["username"];
    $nama_lengkap = $data["nama_lengkap"];
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $jenis_kelamin = $data["jenis_kelamin"];
    $no_telepon = $data["no_telepon"];
    $alamat = $data["alamat"];

    if ($password !== $password2) {
        echo "<script>
                        alert('Konfirmasi Password tidak Sesuai !');
                    </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "UPDATE users SET 
                        nama_lengkap = '$nama_lengkap', 
                        username = '$username',
                        password = '$password',
                        jenis_kelamin = '$jenis_kelamin',
                        no_telepon = '$no_telepon',
                        alamat = '$alamat'
                        WHERE id_user = $sesi");
    return mysqli_affected_rows($conn);
}
