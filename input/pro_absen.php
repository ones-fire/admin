<?php
include '../koneksi.php';

include '../session.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Mendapatkan data absensi siswa dari form
$ids = $_POST['id'];
$tanggal = $_POST['tanggal_hari_ini'];
$edit = $_POST['edit'];
$absensis = $_POST['absensi'];
$kelas = $_POST['kelas'];

// Variabel pesan
$pesan = '';

// Proses pengolahan data absensi
$success = true;

for ($i = 0; $i < count($ids); $i++) {
    $id = $ids[$i];
    $absensi = $absensis[$i];
    // Periksa apakah data dengan id dan tanggal yang sama sudah ada di tabel absensi
    $checkQuery = "SELECT * FROM absensi WHERE siswa_id = '$id' AND tanggal = '$tanggal'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if ($edit == "edit_absensi") {
        // Jika edit = edit_absensi, lakukan update atau insert ke tabel absensi
        if (mysqli_num_rows($checkResult) > 0) {
            $query = "UPDATE absensi SET keterangan = '$absensi' WHERE siswa_id = '$id' AND tanggal = '$tanggal'";
            if (!mysqli_query($conn, $query)) {
                $success = false; // Set $success to false if query fails
            }
        } else {
            $query = "INSERT INTO absensi (siswa_id, tanggal, keterangan) VALUES ('$id', '$tanggal', '$absensi')";
            if (!mysqli_query($conn, $query)) {
                $success = false; // Set $success to false if query fails
            }
        }
    } else {
        if (mysqli_num_rows($checkResult) > 0) {
            // Jika data sudah ada, batalkan insert dan atur pesan menjadi 'dupe'
            $pesanx = 'dupe';
        } else {
            // Jika data belum ada, lakukan insert ke tabel absensi
            $query = "INSERT INTO absensi (siswa_id, tanggal, keterangan) VALUES ('$id', '$tanggal', '$absensi')";
            if (!mysqli_query($conn, $query)) {
                $success = false; // Set $success to false if query fails
            }
        }
    }
}

if ($success && $pesanx === 'dupe') {
    $pesan = $pesanx;
} elseif ($success) {
    $pesan = 'success';
} else {
    $pesan = 'failed';
}

// Menutup koneksi
mysqli_close($conn);

// Redirect kembali ke halaman absen.php dengan membawa pesan dan variabel kelas
header("Location: ../admin/absen.php?pesan=" . $pesan . "&kelas=" . $kelas . "&tanggal=" . $tanggal);
exit();
