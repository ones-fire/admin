<?php
include '../koneksi.php';
include '../session.php';
$nav = 'nilai';

// Mendapatkan data absensi siswa dari form
$kelas_siswa = $_POST['kelas_siswa'];
$mata_pelajaran = $_POST['mapel_nama'];
$materi_pelajaran = $_POST['materi_pelajaran'];
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
    <div class="row">
        <div class="col mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Pilihan
                    </h6>
                </div>
                <div class="card-body">
                    <!-- Input box untuk Kelas (disabled) -->
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="kelas_siswa" class="col-form-label">Kelas :</label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="kelas_siswa" name="kelas_siswa" value="<?= $kelas_siswa ?>" disabled>
                        </div>
                    </div>

                    <!-- Input box untuk Mata Pelajaran (disabled) -->
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="mata_pelajaran" class="col-form-label">Mata Pelajaran :</label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="mata_pelajaran" name="mata_pelajaran" value="<?= $mata_pelajaran ?>" disabled>
                        </div>
                    </div>

                    <!-- Input box untuk Materi Pelajaran (disabled) -->
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="materi_pelajaran" class="col-form-label">Materi Pelajaran :</label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="materi_pelajaran" name="materi_pelajaran" value="<?= $materi_pelajaran ?>" disabled>
                        </div>
                    </div>

                    <a href="penilaian.php" class="btn btn-secondary btn-icon-split float-right ">
                        <span class="icon text-white-50">
                            <i class="fas fa-redo"></i>
                        </span>
                        <span class="text">Pilih Ulang</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <!-- Card Body - Second Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    Form Penilaian
                </h6>
            </div>
            <div class="card-body" id="resultCardBody">
                <form method="post" action="proses_input_nilai.php">
                    <table class="table table-bordered" id="resultTable">
                        <thead>
                            <tr class="align-middle">
                                <th scope="col">NISN</th>
                                <th scope="col" style="width: 200px;">Nama</th>
                                <!-- Loop untuk header Pekerjaan Rumah -->
                                <th scope="col" colspan="<?= $jumlah_pr ?>">Pekerjaan Rumah <?= $jumlah_pr ?></th>
                                <th scope="col" colspan="<?= $jumlah_th ?>">Tugas Harian <?= $jumlah_th ?></th>
                                <th scope="col" colspan="<?= $jumlah_uh ?>">Ulangan Harian <?= $jumlah_uh ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Query untuk mengambil NISN dan Nama dari siswa berdasarkan kelas
                            $query_siswa = "SELECT id, nisn, nama FROM siswa WHERE kelas = $kelas_siswa";
                            $result_siswa = mysqli_query($conn, $query_siswa);
                            while ($row_siswa = mysqli_fetch_assoc($result_siswa)) {
                                echo "<tr class='align-middle'>";
                                echo "<th scope='row'>" . $row_siswa['nisn'] . "</th>";
                                echo "<td>" . $row_siswa['nama'] . "</td>";

                                // Form input hidden untuk ID
                                echo "<input type='hidden' name='id[]' value='" . $row_siswa['id'] . "'>";

                                for ($i = 1; $i <= $jumlah_pr; $i++) {
                                    echo "<td><input type='text' class='form-control' name='pr_" . $i . "'></td>";
                                }
                                for ($j = 1; $j <= $jumlah_th; $j++) {
                                    echo "<td><input type='text' class='form-control' name='pr_" . $j . "'></td>";
                                }
                                for ($k = 1; $k <= $jumlah_uh; $k++) {
                                    echo "<td><input type='text' class='form-control' name='pr_" . $k . "'></td>";
                                }

                                // // Form input untuk nilai semester
                                // echo "<td><input type='text' class='form-control' name='nilai_semester_" . $row_siswa['id'] . "' maxlength='3' pattern='\\d{1,3}'></td>";

                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="form-group row">
                        <div class="form-group col text-right">
                            <!-- Tombol Simpan di card kedua -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include('../layout/footer.php') ?>