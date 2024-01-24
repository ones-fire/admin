<?php
include '../koneksi.php';
include '../session.php';
$nav = 'mapel';

include('../layout/header.php') ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Lihat Materi Pelajaran
                    </h6>
                </div>
                <div class="card-body">
                    <!-- Form pertama untuk mengirim pilihan dropdown -->
                    <form class="user" method="post" action="pelajaran.php">
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <select class="form-control" id="mata_pelajaran" name="mata_pelajaran">
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
                                            echo "<option value='$mapel_id'>$mapel_nama</option>";
                                        }
                                    } else {
                                        // Jika tidak ada data mata pelajaran
                                        echo "<option value='' disabled>Tidak ada data mata pelajaran</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary">Pilih</button>
                            </div>
                        </div>
                    </form>

                    <?php
                    // Menampilkan tabel hanya jika mata pelajaran dipilih
                    if (isset($_POST['mata_pelajaran'])) {
                        $mapel_id = mysqli_real_escape_string($conn, $_POST['mata_pelajaran']);
                        $query_materi = "SELECT * FROM materi WHERE mapel_id = '$mapel_id'";
                        $result_materi = mysqli_query($conn, $query_materi);

                        // Tampilkan tabel jika ada data materi
                        if (mysqli_num_rows($result_materi) > 0) {
                    ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Materi Pelajaran
                                                <?php
                                                $query = mysqli_query($conn, "SELECT mapel FROM mata_pelajaran WHERE id = '$mapel_id'");
                                                $result = mysqli_fetch_assoc($query);
                                                echo $result['mapel'];
                                                ?></th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Mengambil data materi dari database
                                        $mapel_id = mysqli_real_escape_string($conn, $mapel_id);

                                        $query_materi = "SELECT * FROM materi WHERE mapel_id = '$mapel_id'";
                                        $result_materi = mysqli_query($conn, $query_materi);


                                        // Mengecek apakah ada baris hasil
                                        if (mysqli_num_rows($result_materi) > 0) {
                                            // Inisialisasi nomor urut
                                            $nomor_urut = 1;

                                            // Menggunakan loop untuk mengambil semua baris hasil
                                            while ($row_materi = mysqli_fetch_assoc($result_materi)) {
                                                // Mengambil nilai dari setiap kolom
                                                $materi_id = $row_materi['id'];
                                                $materi_nama = $row_materi['materi'];

                                                // Menampilkan materi ke dalam baris tabel
                                                echo "<tr>";
                                                echo "<td>$nomor_urut</td>";
                                                echo "<td>$materi_nama</td>";
                                                // Tambahkan tombol hapus dengan link ke halaman penghapusan materi
                                                echo "<td><a href='../input/pro_del_materi.php?id=$materi_id' class='btn btn-danger btn-sm'>Hapus</a></td>";
                                                echo "</tr>";

                                                // Increment nomor urut
                                                $nomor_urut++;
                                            }
                                        } else {
                                            // Jika tidak ada data materi
                                            echo "<tr><td colspan='2'>Tidak ada data materi</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        } else {
                            // Tampilkan pesan jika tidak ada data materi
                            echo "<p>Tidak ada data materi untuk mata pelajaran " ?>
                            <?php
                            $query = mysqli_query($conn, "SELECT mapel FROM mata_pelajaran WHERE id = '$mapel_id'");
                            $result = mysqli_fetch_assoc($query);
                            echo $result['mapel'];
                            ?>
                    <?php ".</p>";
                        }
                    } ?>


                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-success">
                        Tambah Materi Pelajaran
                    </h6>
                </div>
                <!-- Include jQuery library (Satu kali) -->
                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

                <div class="card-body">
                    <!-- Formulir Tambah Materi Pelajaran -->
                    <form class="user" method="post" action="../input/pro_in_materi.php" id="formTambahMateri">
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <select class="form-control" id="mata_pelajaran" name="mata_pelajaran" data-mapel-id="<?php echo $selected_mapel_id; ?>">
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
                                            $mapel_id_option = $row_mapel['id'];
                                            $mapel_nama = $row_mapel['mapel'];

                                            // Menambahkan opsi ke dalam dropdown
                                            echo "<option value='$mapel_id_option'>$mapel_nama</option>";
                                        }
                                    } else {
                                        // Jika tidak ada data mata pelajaran
                                        echo "<option value='' disabled>Tidak ada data mata pelajaran</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-sm-9 mt-4">
                                <input type="text" class="form-control" id="new_materi" name="new_materi" placeholder="Tambah Materi">
                            </div>
                            <div class="col mt-4">
                                <button type="submit" class="btn btn-primary" id="btnSubmitMateri">Submit</button>
                            </div>
                        </div>
                    </form>


                    <!-- Script JavaScript untuk menampilkan formulir yang sesuai -->
                    <script>
                        $(document).ready(function() {
                            $("#btnTambahMataPelajaran").click(function() {
                                $("#formTambahMakul").toggle();
                                $("#formTambahMateri").hide();
                            });

                            $("#btnTambahMateriPelajaran").click(function() {
                                $("#formTambahMateri").toggle();
                                $("#formTambahMakul").hide();
                            });

                            $("#btnSubmitMakul").click(function() {
                                if ($("#new_makul").val() === "") {
                                    alert("Isi field 'Tambah Mata Pelajaran' terlebih dahulu!");
                                } else {
                                    $("#formTambahMakul").submit();
                                }
                            });

                            $("#btnSubmitMateri").click(function() {
                                if ($("#new_materi").val() === "") {
                                    alert("Isi field 'Tambah Materi' terlebih dahulu!");
                                } else {
                                    $("#formTambahMateri").submit();
                                }
                            });
                        });
                    </script>
                </div>


            </div>
            <?php
            // Cek apakah ada parameter status_mapel atau status_materi
            $showCard = isset($_GET['status_mapel']) || (isset($_GET['status_materi'])) || (isset($_GET['status_del_materi']));
            ?>

            <?php if ($showCard) : ?>
                <div class="card mb-4 py-3 <?php echo (isset($_GET['status_mapel']) || (isset($_GET['status_materi']) && $_GET['status_materi'] == 'sukses')) ? 'border-left-success' : 'border-left-danger'; ?>">
                    <?php if (isset($_GET['status_mapel']) || (isset($_GET['status_materi']) && $_GET['status_materi'] == 'sukses')) : ?>
                        <div class="card-body">
                            <?php
                            if (isset($_GET['status_materi'])) {
                                echo 'Materi berhasil disimpan!';
                            } else if (isset($_GET['status_mapel']) && $_GET['status_mapel'] == 'sukses') {
                                echo 'Mata Pelajaran berhasil disimpan!';
                            } else if (isset($_GET['status_del_materi']) && $_GET['status_del_materi'] == 'sukses') {
                                echo 'Materi berhasil dihapus!';
                            }
                            ?>
                        </div>
                    <?php else : ?>
                        <div class="card-body">
                            <?php
                            if (isset($_GET['status_materi'])) {
                                echo 'Gagal menyimpan materi!';
                            } else if (isset($_GET['status_mapel']) && $_GET['status_mapel'] == 'gagal') {
                                echo 'Gagal menyimpan mata pelajaran!';
                            } else if (isset($_GET['status_del_materi']) && $_GET['status_del_materi'] == 'gagal') {
                                echo 'Materi gagal dihapus!';
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>




        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include('../layout/footer.php') ?>