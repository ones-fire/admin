<?php
// Panggil file koneksi ke database
include "../koneksi.php";

$namaDokumen = $_POST['nama_dokumen'];

if (isset($namaDokumen)) {
    $query = "DELETE FROM `dokumen` WHERE `dokumen`.`nama_dokumen` = '$namaDokumen'";
    if (mysqli_query($conn, $query)) {
        $pesan = "success";
    } else {
        $pesan = "failed";
    }
}
// Redirect kembali ke halaman absen.php dengan membawa pesan dan variabel kelas
header("Location: ../admin/dokumen.php?pesan=" . $pesan);
exit();
