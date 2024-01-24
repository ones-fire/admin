<?php
include '../koneksi.php';
include '../session.php';
$nav = 'nilai';
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

        <!-- Informasi Mata Pelajaran dan Materi -->
        <div class="col mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Isi Form menuju Penilaian
                    </h6>
                </div>
                <div class="card-body">
                    <!-- Form pertama untuk mengirim pilihan dropdown -->

                    <form class="user" method="post" action="in_penilaian.php">
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
                                            echo "<option value='$mapel_id' data-mapel-nama='$mapel_nama'>$mapel_nama</option>";
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
                            <div class="col-sm-2">
                                <label for="materi_pelajaran" class="col-form-label">Materi Pelajaran :</label>
                            </div>
                            <div class="col">
                                <select class="form-control" id="materi_pelajaran" name="materi_pelajaran">
                                    <option value="" selected disabled>Pilih Materi Pelajaran</option>
                                </select>
                            </div>
                        </div>

                        <!-- Input hidden untuk menyimpan nilai mapel_nama -->
                        <?php
                        if (isset($mapel_nama)) {
                            echo "<input type='hidden' id='mapel_nama' name='mapel_nama' value='$mapel_nama'>";
                        } else {
                            echo "<input type='hidden' id='mapel_nama' name='mapel_nama' value=''>";
                        }
                        ?>

                        <div id="section1">
                            <div class="form-group row">
                                <div class="col text-right"> <!-- Move the button to the right -->
                                    <button type="button" class="btn btn-primary" onclick="showSection()">Lanjutkan</button>
                                </div>
                            </div>
                        </div>

                        <div id="section2" style="display: none;">
                            <!-- Input box untuk Jumlah PR -->
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="jumlah_pr" class="col-form-label">Jumlah Pekerjaan Rumah :</label>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" id="jumlah_pr" name="jumlah_pr" placeholder="Masukkan jumlah penilaian Pekerjaan Rumah" value="1" min="1" required>
                                </div>
                            </div>

                            <!-- Input box untuk Jumlah TH -->
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="jumlah_th" class="col-form-label">Jumlah Tugas Harian :</label>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" id="jumlah_th" name="jumlah_th" placeholder="Masukkan jumlah penilaian Tugas Harian" value="1" min="1" required>
                                </div>
                            </div>

                            <!-- Input box untuk Jumlah UH -->
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="jumlah_uh" class="col-form-label">Jumlah Ulangan Harian :</label>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" id="jumlah_uh" name="jumlah_uh" placeholder="Masukkan jumlah penilaian Ulangan Harian" value="1" min="1" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col text-right">
                                    <!-- Tombol untuk submit form (kedua) -->
                                    <button type="submit" class="btn btn-primary" onclick="validateAndSubmit()">Lanjutkan</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <script>
                        function showSection() {
                            // Hide the first set of input fields and button
                            document.getElementById('section1').style.display = 'none';

                            // Show the second set of input fields and button
                            document.getElementById('section2').style.display = 'block';
                        }

                        function loadMateri() {
                            var selectedMapel = document.getElementById('mata_pelajaran');
                            var materiDropdown = document.getElementById('materi_pelajaran');
                            var mapelNamaInput = document.getElementById('mapel_nama');

                            // Reset dropdown materi
                            materiDropdown.innerHTML = "<option value='' selected disabled>Pilih Materi Pelajaran</option>";

                            // Set nilai mapel_nama dari data-mapel-nama attribute pada option yang dipilih
                            mapelNamaInput.value = selectedMapel.options[selectedMapel.selectedIndex].getAttribute('data-mapel-nama');

                            // Jika mata pelajaran dipilih, muat data materi terkait
                            if (selectedMapel.value !== "") {
                                // Mengambil data materi terkait dengan mata pelajaran yang dipilih
                                var xhr = new XMLHttpRequest();
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState == 4 && xhr.status == 200) {
                                        var materiData = JSON.parse(xhr.responseText);

                                        // Mengecek apakah ada data materi
                                        if (materiData.length > 0) {
                                            // Menggunakan loop untuk menambahkan opsi ke dalam dropdown materi
                                            materiData.forEach(function(materi) {
                                                materiDropdown.innerHTML += "<option value='" + materi.materi + "'>" + materi.materi + "</option>";
                                            });
                                        } else {
                                            // Jika tidak ada data materi
                                            materiDropdown.innerHTML += "<option value='' disabled>Tidak ada data materi untuk mata pelajaran ini</option>";
                                        }
                                    }
                                };

                                xhr.open("GET", "../input/get_materi.php?mapel_id=" + selectedMapel.value, true);
                                xhr.send();
                            }
                        }

                        function validateAndSubmit() {
                            var kelasSiswa = document.getElementById('kelas_siswa').value;
                            var mataPelajaran = document.getElementById('mata_pelajaran').value;
                            var materiPelajaran = document.getElementById('materi_pelajaran').value;
                            var jumlahPR = document.getElementById('jumlah_pr').value;
                            var jumlahTH = document.getElementById('jumlah_th').value;
                            var jumlahUH = document.getElementById('jumlah_uh').value;

                            if (kelasSiswa !== "" && mataPelajaran !== "" && materiPelajaran !== "" && validateNumberInput(jumlahPR) && validateNumberInput(jumlahTH) && validateNumberInput(jumlahUH)) {
                                // All fields are valid, submit the form
                                document.forms[0].submit();
                            } else {
                                // Inform the user to fill in all required fields with valid values
                                alert("Harap isi seluruh form dengan nilai yang valid sebelum melanjutkan.");
                            }
                        }

                        function validateNumberInput(value) {
                            // Validate that the input is a positive integer
                            var intValue = parseInt(value, 10);
                            return !isNaN(intValue) && intValue > 0;
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include('../layout/footer.php') ?>