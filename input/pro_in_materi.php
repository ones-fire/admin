<?php
// Panggil file koneksi ke database
include "../koneksi.php";

// Menangkap data yang diinputkan oleh pengguna
$mata_pelajaran = intval($_POST['mata_pelajaran']);
$new_materi = mysqli_real_escape_string($conn, $_POST['new_materi']);

// Query untuk menyimpan data ke dalam database
$query = "INSERT INTO materi (mapel_id, materi) VALUES (?, ?)";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ss", $mata_pelajaran, $new_materi);
$result = mysqli_stmt_execute($stmt);

// Cek apakah data berhasil disimpan atau tidak
if ($result) {
    // Redirect ke halaman pelajaran
    header("Location: ../guru/pelajaran.php?status_materi=sukses");
    exit();
} else {
    header("Location: ../guru/pelajaran.php?status_materi=gagal");
    exit();
}
