<?php
// Panggil file koneksi ke database
include "../koneksi.php";

// Menangkap data yang diinputkan oleh pengguna
$mapel = $_POST['new_mapel'];

var_dump($mapel);

// Query untuk menyimpan data ke dalam database
$query = "INSERT INTO mata_pelajaran (mapel) VALUES ('$mapel')";
$result = mysqli_query($conn, $query);

// Cek apakah data berhasil disimpan atau tidak
if ($result) {
    // Redirect ke halaman pelajaran
    header("Location: ../admin/pelajaran.php?status_mapel=sukses");
    exit();
} else {
    header("Location: ../admin/pelajaran.php?status_mapel=gagal");
    exit();
}
