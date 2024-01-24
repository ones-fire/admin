<?php
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include 'koneksi.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
$pilihan = $_POST['pilihan'];

// Mengubah nilai username menjadi lowercase
$username = strtolower($username);

$_SESSION['username'] = $username;
$_SESSION['password'] = $password;
$_SESSION['pilihan'] = $pilihan;

// menyeleksi akun dengan username dan password yang sesuai
if ($username == "administrator") {
    $data = mysqli_query($conn, "SELECT * FROM admin WHERE nama='$username' AND password='$password'");
    $_SESSION['pilihan'] = "admin";
    $pil_page = 'admin';
} else {
    $data = mysqli_query($conn, "SELECT * FROM $pilihan WHERE nama='$username' AND password='$password'");

    if ($pilihan == "guru") {
        // For guru user
        $_SESSION['pilihan'] = "guru";
        $pil_page = 'guru'; // You can modify this as needed
    } elseif ($pilihan == "siswa") {
        // For siswa user
        $_SESSION['pilihan'] = "siswa";
        $pil_page = 'pages'; // You can modify this as needed
    }
}

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

$_SESSION['pil_page'] = $pil_page;

if ($cek > 0) {
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    header("location:" . $pil_page . "/index.php");
} else {
    header("location:index.php?pesan=gagal");
}
