<?php
include '../session.php';
$nav = 'home';
require '../vendor/autoload.php'; // Mengimpor library PhpSpreadsheet
require '../koneksi.php'; // menghubungkan database

use PhpOffice\PhpSpreadsheet\IOFactory;
?>

<?php include('../layout/header.php');
if ($role !== 'admin') {
    // Redirect ke halaman index.php
?>
    <script>
        window.location.href = "../<?= $role ?>/index.php";
    </script>
<?php
    exit(); // Pastikan untuk keluar dari skrip setelah melakukan redirect
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <?php
    // Query untuk mengambil data user
    $query = "SELECT * FROM siswa";
    $result = mysqli_query($conn, $query);
    ?>

    <!-- Page Headng -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Berhasil Ditambahkan!</h1>
    </div>

    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">

            <?php

            $fileType = $_FILES['file']['type'];

            if ($fileType !== 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
                // Invalid file type, handle the error accordingly
            ?>
                <script>
                    window.location.href = "../admin/view_siswa.php?ecel=gagal";
                </script>
                <?php
                exit();
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Periksa apakah file telah diunggah dengan benar
                if (isset($_FILES['file']['name']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                    $inputFileName = $_FILES['file']['tmp_name'];

                    try {
                        // Load file Excel
                        $spreadsheet = IOFactory::load($inputFileName);

                        // Mendapatkan data dari lembar aktif (Sheet)
                        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                        // Menghapus baris pertama dari array
                        unset($sheetData[1]);
                        // Menghapus kolom pertama dari setiap baris
                        foreach ($sheetData as &$row) {
                            unset($row['A']);
                        }

                        // Lakukan sesuatu dengan data, misalnya menyimpannya ke database
                        foreach ($sheetData as $row) {
                            $nisn = $row['B'];
                            $nama = $row['C'];
                            $jenis_kelamin = $row['D'];
                            $kelas = $row['E'];
                            $alamat = $row['F'];
                            $tanggal_lahir = $row['G'];

                            if (!empty($nisn) || !empty($nama) || !empty($kelas) || !empty($tanggal_lahir)) {
                                // Lanjutkan dengan proses penyimpanan data ke database
                                $query = "INSERT INTO siswa (nisn, nama, jenis_kelamin, kelas, tanggal_lahir, alamat, password) 
                                    VALUES ('$nisn', '$nama', '$jenis_kelamin', '$kelas', '$tanggal_lahir', '$alamat', '$tanggal_lahir')";
                                $hasil = mysqli_query($conn, $query);
                            }
                        }

                        $counter = 1; // Inisialisasi counter
                        // Tampilkan hasil data dalam tabel
                ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Kelas</th>
                                    <th>Alamat</th>
                                    <th>Tanggal Lahir</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach ($sheetData as $row) {
                                    $nisn = $row['B'];
                                    $nama = $row['C'];
                                    $jenis_kelamin = $row['D'];
                                    $kelas = $row['E'];
                                    $alamat = $row['F'];
                                    $tanggal_lahir = $row['G'];

                                    if (!empty($nisn) || !empty($nama) || !empty($kelas) || !empty($tanggal_lahir)) {
                                        // Tampilkan data dalam baris tabel
                                ?>
                                        <tr>
                                            <td><?= $counter; ?></td>
                                            <td><?= $nisn; ?></td>
                                            <td><?= $nama; ?></td>
                                            <td><?= $jenis_kelamin; ?></td>
                                            <td><?= $kelas; ?></td>
                                            <td><?= $alamat; ?></td>
                                            <td><?= $tanggal_lahir; ?></td>
                                        </tr>
                                <?php
                                        $counter++; // Tambahkan counter setelah baris data ditampilkan
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
            <?php
                    } catch (Exception $e) {
                        echo 'Terjadi kesalahan: ' . $e->getMessage();
                    }
                } else {
                }
            }
            ?>

            <a href="../admin/view_siswa.php" class="btn btn-secondary btn-icon-split float-right">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-circle-left"></i>
                </span>
                <span class="text">Kembali</span>
            </a>

        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include('../layout/footer.php') ?>