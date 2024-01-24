<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $siswaIds = $_POST['siswa_id'];
    $fileDokumens = $_FILES['dokumen_path'];
    $dokumenTitle = $_POST['doc_title'];

    // Loop melalui setiap siswa_id yang dikirim
    foreach ($siswaIds as $key => $siswaId) {
        $fileDokumenName = $fileDokumens['name'][$key];
        $fileDokumenTmp = $fileDokumens['tmp_name'][$key];

        // Membaca ekstensi file
        $ekstensi = pathinfo($fileDokumenName, PATHINFO_EXTENSION);

        // Generate nama unik
        $namaUnik = time() . '_' . uniqid() . '.' . $ekstensi;

        // Simpan file di folder "Dokumen" dengan nama unik
        $path = $namaUnik;
        $save_path = "../Dokumen/" . $path;
        move_uploaded_file($fileDokumenTmp, $save_path);

        // Insert data ke tabel dokumen
        $query = "INSERT INTO dokumen (siswa_id, nama_dokumen, dokumen_path) VALUES ('$siswaId', '$dokumenTitle', '$path')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            // Jika terjadi kesalahan saat memasukkan data, tampilkan pesan error
            echo "Error: " . mysqli_error($conn);
        }
    }

    // Mengalihkan kembali ke halaman "../admin/dokumen.php"
    header("Location: ../admin/dokumen.php");
    exit();
} else {
    echo "Form tidak disubmit";
}

// Menutup koneksi
mysqli_close($conn);
