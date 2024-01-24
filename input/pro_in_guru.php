<?php
// Panggil file koneksi ke database
include "../koneksi.php";

// Menangkap data yang diinputkan oleh pengguna
$nip = $_POST['nip'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];
$jabatan = $_POST['jabatan'];
$tanggal_lahir = $_POST['tanggal_lahir'];

// Memeriksa nilai-nilai dan menggantinya dengan nilai kosong jika tidak diisi
$nip = empty($nip) ? "" : $nip;
$nama = empty($nama) ? "" : $nama;
$jenis_kelamin = empty($jenis_kelamin) ? "" : $jenis_kelamin;
$jabatan = empty($jabatan) ? "" : $jabatan;
$alamat = empty($alamat) ? "" : $alamat;
$tanggal_lahir = empty($tanggal_lahir) ? "" : $tanggal_lahir;

// Query untuk menyimpan data ke dalam database
$query = "INSERT INTO guru (nip, nama, jenis_kelamin, jabatan, alamat, tanggal_lahir, password) 
              VALUES ('$nip', '$nama', '$jenis_kelamin', '$jabatan', '$alamat', '$tanggal_lahir', '$tanggal_lahir')";
$result = mysqli_query($conn, $query);

// Cek apakah data berhasil disimpan atau tidak
if ($result) {
    // Redirect ke halaman in_guru
    header("Location: ../admin/in_guru.php?status=sukses");
    exit();
} else {
    header("Location: ../admin/in_guru.php?status=gagal");
    exit();
}
