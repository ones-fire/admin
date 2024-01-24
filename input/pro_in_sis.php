<?php
// Panggil file koneksi ke database
include "../koneksi.php";

// Menangkap data yang diinputkan oleh pengguna
$nisn = $_POST['nisn'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$kelas = $_POST['kelas'];
$alamat = $_POST['alamat'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$password = $tanggal_lahir;

// Query untuk menyimpan data ke dalam database
$query = "INSERT INTO siswa (nisn, nama, jenis_kelamin, kelas, tanggal_lahir, alamat, password) 
              VALUES ('$nisn', '$nama', '$jenis_kelamin', '$kelas', '$tanggal_lahir', '$alamat', '$password')";
$result = mysqli_query($conn, $query);

// Cek apakah data berhasil disimpan atau tidak
if ($result) {
    // Redirect ke halaman in_siswa
    header("Location: ../admin/in_siswa.php?status=sukses");
    exit();
} else {
    header("Location: ../admin/in_siswa.php?status=gagal");
    exit();
}

// print("NISN: " . $nisn);
// print("Nama: " . $nama);
// print("Jenis Kelamin: " . $jenis_kelamin);
// print("Kelas: " . $kelas);
// print("Alamat: " . $alamat);
// print("Tanggal Lahir: " . $tanggal_lahir);
// print("Password: " . $password);
