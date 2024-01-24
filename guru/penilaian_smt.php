<?php
include '../koneksi.php';
include '../session.php';
$nav = 'nilai';
?>

<?php include('../layout/header.php');
if (!isset($role) || $role !== 'guru') {
    // Redirect ke halaman index.php
?>
    <script>
        window.location.href = "../<?= $role ?>/index.php";
    </script>
<?php
    exit(); // Pastikan untuk keluar dari skrip setelah melakukan redirect
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected values from the form
    $kelas_siswa = $_POST['kelas_siswa'];
    $mata_pelajaran = $_POST['mata_pelajaran'];
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Pilih Mata Pelajaran
                    </h6>
                </div>
                <div class="card-body">
                    <form id="mainForm" action="penilaian_smt.php" method="post">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="kelas_siswa" class="col-form-label">Kelas :</label>
                            </div>
                            <div class="col">
                                <select class="form-control" id="kelas_siswa" name="kelas_siswa" onchange="loadMateri()">
                                    <option value="" selected disabled>Pilih Kelas</option>
                                    <option value="1">Kelas 1</option>
                                    <option value="2">Kelas 2</option>
                                    <option value="3">Kelas 3</option>
                                    <option value="4">Kelas 4</option>
                                    <option value="5">Kelas 5</option>
                                    <option value="6">Kelas 6</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="mata_pelajaran" class="col-form-label">Mata Pelajaran :</label>
                            </div>
                            <div class="col">
                                <select class="form-control" id="mata_pelajaran" name="mata_pelajaran" onchange="loadMateri()">
                                    <option value="" selected disabled>Pilih Mata Pelajaran</option>
                                    <?php
                                    // Mengambil data mata pelajaran dari database
                                    $query_mapel = "SELECT * FROM mata_pelajaran";
                                    $result_mapel = mysqli_query($conn, $query_mapel);

                                    // Mengecek apakah ada baris hasil
                                    if (mysqli_num_rows($result_mapel) > 0) {
                                        // Menggunakan loop untuk mengambil semua baris hasil
                                        while ($row_mapel = mysqli_fetch_assoc($result_mapel)) {
                                            // Mengambil nilai dari setiap kolom
                                            $mapel_id = $row_mapel['id'];
                                            $mapel_nama = $row_mapel['mapel'];

                                            // Menambahkan opsi ke dalam dropdown
                                            echo "<option value='$mapel_nama'>$mapel_nama</option>";
                                        }
                                    } else {
                                        // Jika tidak ada data mata pelajaran
                                        echo "<option value='' disabled>Tidak ada data mata pelajaran</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col text-right">
                                <!-- Tombol untuk submit form (kedua) -->
                                <button type="button" class="btn btn-primary" onclick="validateAndSubmit()">Lanjutkan</button>
                            </div>
                        </div>
                    </form>

                    <script>
                        function validateAndSubmit() {
                            var kelasSiswa = document.getElementById('kelas_siswa').value;
                            var mataPelajaran = document.getElementById('mata_pelajaran').value;

                            if (kelasSiswa !== "" && mataPelajaran !== "") {
                                // All fields are valid, submit the form
                                document.getElementById('mainForm').submit();
                                // Show the success card
                                document.getElementById('successCard').style.display = 'block';
                            } else {
                                // Inform the user to fill in all required fields with valid values
                                alert("Harap isi seluruh form dengan nilai yang valid sebelum melanjutkan.");
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['kelas_siswa']) && isset($_POST['mata_pelajaran'])) {
    ?>
        <div class="row">
            <div class="col mb-4">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Form Penilaian Semester
                        </h6>
                    </div>
                    <div class="card-body">
                        <!-- Form pertama untuk mengirim pilihan dropdown -->
                        <form method="post" action="proses_input_nilai.php">
                            <table class="table table-bordered" id="resultTable">
                                <thead>
                                    <tr class="align-middle">
                                        <th scope="col">NISN</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nilai Semester</th>
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

                                        echo "<td><input type='text' class='form-control' name='nilai_semester_" . $row_siswa['id'] . "' maxlength='3' pattern='\\d{1,3}'></td>";

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
    <?php
    } else {
        // Notifikasi untuk mengisi kelas dan pelajaran
        echo "*Mohon lengkapi form kelas dan pelajaran di atas.";
    }
    ?>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include('../layout/footer.php') ?>