<?php
// Panggil file koneksi ke database
include "../koneksi.php";

// pastikan tipe penghapusan
if (isset($_GET['tipe'])) {
    $tipe = $_GET['tipe'];

    if ($tipe === 'individual') {
        // Pastikan parameter id ada
        if (isset($_GET['id'])) {
            // Ambil id dari parameter
            $id = $_GET['id'];
            $tabel = $_GET['tabel'];

            // Query DELETE untuk menghapus data berdasarkan id
            $query = "DELETE FROM $tabel WHERE id = '$id'";

            // Eksekusi query
            if (mysqli_query($conn, $query)) {
                // Redirect kembali ke halaman sebelumnya
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    } elseif ($tipe === 'all') {
        if (isset($_GET['kelas'])) {
            // Ambil kelas dari parameter
            $tabel = $_GET['tabel'];
            $kelas = $_GET['kelas'];
            if ($kelas === 'Satu') {
                $query = "DELETE FROM $tabel WHERE kelas = '1'";
            } elseif ($kelas === 'Dua') {
                $query = "DELETE FROM $tabel WHERE kelas = '2'";
            } elseif ($kelas === 'Tiga') {
                $query = "DELETE FROM $tabel WHERE kelas = '3'";
            } elseif ($kelas === 'Empat') {
                $query = "DELETE FROM $tabel WHERE kelas = '4'";
            } elseif ($kelas === 'Lima') {
                $query = "DELETE FROM $tabel WHERE kelas = '5'";
            } elseif ($kelas === 'Enam') {
                $query = "DELETE FROM $tabel WHERE kelas = '6'";
            } elseif ($kelas === 'Semua') {
                $query = "DELETE FROM $tabel";
            }

            // Eksekusi query
            if (mysqli_query($conn, $query)) {
                // Redirect kembali ke halaman sebelumnya
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
}
