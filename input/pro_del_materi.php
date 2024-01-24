<?php
// Panggil file koneksi ke database
include "../koneksi.php";

// Menangkap data yang diinputkan oleh pengguna
$id = intval($_GET['id']);

var_dump($id);

// Query untuk menyimpan data ke dalam database
$query = "DELETE FROM materi WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);

// Bind the parameter and specify its data type
mysqli_stmt_bind_param($stmt, "s", $id);

// Execute the statement
$result = mysqli_stmt_execute($stmt);


// Cek apakah data berhasil disimpan atau tidak
if ($result) {
    // Redirect ke halaman pelajaran
    header("Location: ../guru/pelajaran.php?status_del_materi=sukses");
    exit();
} else {
    header("Location: ../guru/pelajaran.php?status_del_materi=gagal");
    exit();
}
