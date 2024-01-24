<?php
// Panggil file koneksi ke database
include "../koneksi.php";

// Menangkap data yang diinputkan oleh pengguna
$id = intval($_GET['id']);

var_dump($id);

// Query untuk menyimpan data ke dalam database
$query = "DELETE FROM mata_pelajaran WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);

// Bind the parameter and specify its data type
mysqli_stmt_bind_param($stmt, "s", $id);

// Execute the statement
$result = mysqli_stmt_execute($stmt);


// Cek apakah data berhasil disimpan atau tidak
if ($result) {
    // Redirect ke halaman pelajaran
    header("Location: ../admin/pelajaran.php?status_del_mapel=sukses");
    exit();
} else {
    header("Location: ../admin/pelajaran.php?status_del_mapel=gagal");
    exit();
}
