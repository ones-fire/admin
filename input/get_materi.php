<?php
// Panggil file koneksi ke database
include "../koneksi.php";

// Periksa apakah parameter mapel_id ada dalam permintaan GET
if (isset($_GET['mapel_id'])) {
    $selected_mapel_id = mysqli_real_escape_string($conn, $_GET['mapel_id']);

    // Query untuk mengambil data materi terkait dengan mata pelajaran yang dipilih
    $query_materi = "SELECT id, materi FROM materi WHERE mapel_id = $selected_mapel_id";
    $result_materi = mysqli_query($conn, $query_materi);

    // Membuat array untuk menyimpan data materi
    $materi_data = array();

    // Mengecek apakah ada baris hasil
    if (mysqli_num_rows($result_materi) > 0) {
        // Menggunakan loop untuk mengambil semua baris hasil
        while ($row_materi = mysqli_fetch_assoc($result_materi)) {
            // Menambahkan data materi ke dalam array
            $materi_data[] = $row_materi;
        }
    }

    // Mengirimkan data materi dalam format JSON
    echo json_encode($materi_data);
} else {
    // Jika parameter mapel_id tidak ditemukan
    echo "Parameter mapel_id tidak ditemukan.";
}

// Menutup koneksi database
mysqli_close($conn);
