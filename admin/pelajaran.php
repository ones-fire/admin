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
                        Mata Pelajaran
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Mengambil data materi dari database
                                // Mengambil data mata pelajaran dari database
                                $query_mapel = "SELECT * FROM mata_pelajaran";
                                $result_mapel = mysqli_query($conn, $query_mapel);

                                // Mengecek apakah ada baris hasil
                                if (mysqli_num_rows($result_mapel) > 0) {
                                    // Inisialisasi nomor urut
                                    $nomor_urut = 1;

                                    // Menggunakan loop untuk mengambil semua baris hasil
                                    while ($row_mapel = mysqli_fetch_assoc($result_mapel)) {
                                        // Mengambil nilai dari setiap kolom
                                        $mapel_id = $row_mapel['id'];
                                        $mapel_nama = $row_mapel['mapel'];

                                        // Menampilkan materi ke dalam baris tabel
                                        echo "<tr>";
                                        echo "<td>$nomor_urut</td>";
                                        echo "<td>$mapel_nama</td>";
                                        echo "<td><a href='../input/pro_del_mapel.php?id=$mapel_id' class='btn btn-danger btn-sm'>Hapus</a></td>";
                                        // Tambahkan tombol hapus dengan link ke halaman penghapusan materi
                                        echo "</tr>";

                                        // Increment nomor urut
                                        $nomor_urut++;
                                    }
                                } else {
                                    // Jika tidak ada data materi
                                    echo "<tr><td colspan='2'>Tidak ada data mata pelajaran</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-success">
                        Tambah Mata Pelajaran
                    </h6>
                </div>
                <div class="card-body">
                    <!-- Formulir Tambah Mata Pelajaran -->
                    <form class="user" method="post" action="../input/pro_in_mapel.php" id="formTambahMakul">
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="new_mapel" name="new_mapel" placeholder="Tambah Mata Pelajaran">
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-success" id="btnSubmitMakul">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include('../layout/footer.php') ?>