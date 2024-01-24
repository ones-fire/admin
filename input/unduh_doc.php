<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data dokumen berdasarkan ID
    $query = "SELECT nama_dokumen, dokumen_path FROM dokumen WHERE id = '$id';";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $filename = $row['dokumen_path'];
        $filepath = '../Dokumen/' . $filename;

        if (!empty($filename) && file_exists($filepath)) {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: binary");
            readfile($filepath);
            exit;
        } else {
            echo "This File Does not exist.";
        }
    }
}

// Menutup koneksi
mysqli_close($conn);
