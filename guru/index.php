<?php
include '../session.php';
$nav = 'home';
?>

<?php include('../layout/header.php');
if ($role !== 'guru') {
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

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Selamat Datang! <?= $nami; ?></h1>

    <!-- Content Row -->
    <div class="row">

        <div class=" col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2" onclick="window.location.href='penilaian.php'" style="cursor: pointer;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-success text-uppercase mb-1">Input Penilaian Siswa</div>
                            <br>
                            <a class="h5 mb-0 font-weight-bold text-gray-800" href="penilaian.php">Klik di sini untuk mengisi </a>
                            <p class="card-text">Anda dapat mengisi siswa, seperti Pekerjaan Rumah, Tugas Harian,dan Ulangan Harian.</p>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-upload fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class=" col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" onclick="window.location.href='pelajaran.php'" style="cursor: pointer;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-primary text-uppercase mb-1">Input Materi Siswa</div>
                            <br>
                            <a class="h5 mb-0 font-weight-bold text-gray-800" href="pelajaran.php">Klik di sini untuk mengunggah</a>
                            <p class="card-text">Anda dapat menambahkan materi dari mata pelajaran anda.</p>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-upload fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" onclick="window.location.href='dokumen.php'" style="cursor: pointer;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-primary text-uppercase mb-1">Input Dokumen Siswa</div>
                            <br>
                            <a class="h5 mb-0 font-weight-bold text-gray-800" href="../admin/dokumen.php">Klik di sini untuk mengunggah</a>
                            <p class="card-text">Anda dapat mengunggah berbagai dokumen siswa, seperti tugas, catatan, dan sertifikat kegiatan.</p>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-upload fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2" onclick="window.location.href='#'" data-toggle="modal" data-target="#kelasModal" style="cursor: pointer;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-success text-uppercase mb-1">Input Absensi Siswa</div>
                            <br>
                            <a class="h5 mb-0 font-weight-bold text-gray-800" href="#" data-toggle="modal" data-target="#kelasModal">Klik di sini untuk mencatat</a>
                            <p class="card-text">Catat kehadiran dan keterlambatan siswa secara mudah dan efisien menggunakan fitur ini.</p>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="kelasModal" tabindex="-1" role="dialog" aria-labelledby="kelasModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="kelasModalLabel">Pilih Kelas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Pilih kelas untuk menginput absensi siswa:</p>
                        <div class="btn-group-vertical d-flex flex-column" role="group">
                            <button type="button" class="btn btn-primary btn-block mx-auto" style="margin-bottom: 3px; width: 150px;" onclick="window.location.href='absen.php?kelas=1'">Kelas 1</button>
                            <button type="button" class="btn btn-primary btn-block mx-auto" style="margin-bottom: 3px; width: 150px;" onclick="window.location.href='absen.php?kelas=2'">Kelas 2</button>
                            <button type="button" class="btn btn-primary btn-block mx-auto" style="margin-bottom: 3px; width: 150px;" onclick="window.location.href='absen.php?kelas=3'">Kelas 3</button>
                            <button type="button" class="btn btn-primary btn-block mx-auto" style="margin-bottom: 3px; width: 150px;" onclick="window.location.href='absen.php?kelas=4'">Kelas 4</button>
                            <button type="button" class="btn btn-primary btn-block mx-auto" style="margin-bottom: 3px; width: 150px;" onclick="window.location.href='absen.php?kelas=5'">Kelas 5</button>
                            <button type="button" class="btn btn-primary btn-block mx-auto" style="margin-bottom: 3px; width: 150px;" onclick="window.location.href='absen.php?kelas=6'">Kelas 6</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div> -->


    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->

<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include('../layout/footer.php') ?>