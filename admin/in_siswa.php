<?php
include '../koneksi.php';

include '../session.php';

$nav = 'siswa';

$username = $_SESSION['username'];
$password = $_SESSION['password'];
$pilihan = $_SESSION['pilihan'];

if (!isset($username)) {
    header("Location: index.php");
    exit();
}

?>

<?php include('../layout/header.php') ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah User Siswa</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- <div class="col-lg-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Foto Pengguna</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div style="display: flex; justify-content: center;">
                            <?php
                            // // memeriksa apakah fdb_foto tidak kosong
                            // if (!empty($fdb_foto)) {
                            //     // menampilkan gambar profile jika fdb_foto tidak kosong
                            //     echo '<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem; src' . $fdb_foto . '">';
                            // } else {
                            //     // menampilkan pesan jika fdb_foto kosong
                            //     echo "<div>";
                            //     echo '<i class="fas fa-user fa-5x" style="margin: auto; font-size: 25rem;"></i>';
                            //     echo "</div>";
                            // }
                            ?>
                            <div>
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;">
                                <i class="fas fa-user fa-5x" style="margin: auto; font-size: 20rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Pilih Gambar :</div>
                                    <form method="post" action="../input/pro_in_sis.php" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input type="file" class="form-control-file" id="foto" name="foto">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="col">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Data Pengguna
                    </h6>
                </div>
                <div class="card-body">
                    <form class="user" method="post" action="../input/pro_in_sis.php">
                        <div class="form-group row">
                            <label for="nisn" class="col-sm-2 col-form-label">NISN :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nisn" id="nisn" placeholder="--NISN--" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="--Nama Lengkap--" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin :</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                                    <option value="">--Pilih Jenis Kelamin--</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kelas" class="col-sm-2 col-form-label">Kelas :</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="kelas" id="kelas" required>
                                    <option value="">--Pilih Kelas--</option>
                                    <option value="1">Kelas 1</option>
                                    <option value="2">Kelas 2</option>
                                    <option value="2">Kelas 3</option>
                                    <option value="2">Kelas 4</option>
                                    <option value="2">Kelas 5</option>
                                    <option value="2">Kelas 6</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="--Alamat--" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir :</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="--Tanggal Lahir--" required>
                                <label style="color: red; font-size: 75%">*Gunakan Format : tanggal/bulan/tahun, Contoh
                                    "2008/05/24"</label>
                            </div>
                        </div>
                        <button class="btn btn-success btn-icon-split float-right" type="submit">
                            <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="text">Simpan</span>
                        </button>
                        <a href="../admin/view_siswa.php" class="btn btn-secondary btn-icon-split float-left">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-circle-left"></i>
                            </span>
                            <span class="text">Kembali</span>
                        </a>

                    </form>
                </div>
            </div>

            <?php
            if (isset($_GET['status'])) {
                $status = $_GET['status'];
                if ($status == 'sukses') {
                    echo '            <div class="row">
                    <div class="col">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-lg font-weight-bold text-success text-uppercase mb-1">
                                            Data Berhasil disimpan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                } elseif ($status == 'gagal') {
                    echo '            <div class="row">
                    <div class="col">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-lg font-weight-bold text-danger text-uppercase mb-1">
                                            Data Gagal disimpan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                }
            }
            ?>
        </div>

    </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include('../layout/footer.php') ?>