<?php
include '../koneksi.php';

include '../session.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
// Mendapatkan data absensi siswa dari form
$kelas_siswa = $_POST['kelas_siswa'];
$mata_pelajaran = $_POST['mapel_nama'];
$materi_pelajaran = $_POST['materi_pelajaran'];

// Mendapatkan data absensi siswa dari form
$jumlah_pr = $_POST['jumlah_pr'];
$jumlah_th = $_POST['jumlah_th'];
$jumlah_uh = $_POST['jumlah_uh'];
