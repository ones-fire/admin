<?php
include '../koneksi.php';

include '../session.php';
$nav = 'dokumen';

$username = $_SESSION['username'];
$password = $_SESSION['password'];

if (!isset($username)) {
    header("Location: index.php");
    exit();
}

// Query untuk mengambil data user
$query = "SELECT DISTINCT d.nama_dokumen, s.kelas
        FROM dokumen d
        JOIN siswa s ON d.siswa_id = s.id;
        ";
$result = mysqli_query($conn, $query);
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

    <?php
    // Cek status
    $status = isset($_GET['status']) ? $_GET['status'] : '';
    if ($status === 'success') {
        $alertType = 'success';
        $alertMessage = 'Dokumen berhasil disimpan.';
    } elseif ($status === 'failed') {
        $alertType = 'danger';
        $alertMessage = 'Terjadi kesalahan. Dokumen gagal disimpan.';
    } else {
        // Jika tidak ada status atau status tidak valid, tidak menampilkan alert
        $alertType = '';
        $alertMessage = '';
    }
    ?>

    <?php
    // Cek pesan
    $pesan = isset($_GET['pesan']) ? $_GET['pesan'] : '';
    if ($pesan === 'success') {
        $alertType = 'success';
        $alertMessage = 'Dokumen berhasil Dihapus.';
    } elseif ($pesan === 'failed') {
        $alertType = 'danger';
        $alertMessage = 'Terjadi kesalahan. Dokumen gagal Dihapus.';
    } else {
        // Jika tidak ada pesan atau pesan tidak valid, tidak menampilkan alert
        $alertType = '';
        $alertMessage = '';
    }
    ?>

    <?php if (!empty($alertType) && !empty($alertMessage)) { ?>
        <div class="alert alert-<?= $alertType ?>" role="alert">
            <?= $alertMessage ?>
        </div>
    <?php } ?>

    <!-- Page Headng -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Dokumen</h1>
    </div>

    <div class="row">

        <?php
        // Memeriksa apakah query berhasil dijalankan
        if ($result) {
            // Memeriksa apakah ada data yang ditemukan
            if (mysqli_num_rows($result) > 0) {
        ?>
                <div class="col-xl-9 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Data Dokumen Ditemukan</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" width="10%">No</th>
                                        <th scope="col" width="50%">Nama Dokumen</th>
                                        <th scope="col" width="20%">Kelas</th>
                                        <th scope="col" width="20%">Aksi</th>
                                    </tr>
                                </thead>
                                <?php

                                // Inisialisasi counter
                                $counter = 1;

                                // Loop melalui setiap baris data
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $counter . "</td>";
                                    echo "<td>" . $row['nama_dokumen'] . "</td>";
                                    echo "<td> Kelas " . $row['kelas'] . "</td>";
                                    echo '<td>';
                                ?>
                                    <a data-toggle="modal" data-target="#hapusModal<?= $counter ?>" class="btn btn-danger btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Hapus</span>
                                    </a>
                                    <?php
                                    echo '</td>';
                                    echo "</tr>";
                                    ?>
                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="hapusModal<?= $counter ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel<?= $counter ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="hapusModalLabel<?= $counter ?>">Konfirmasi Hapus</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Anda yakin ingin menghapus dokumen ini?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <form action="../input/hapus_doc.php" method="POST">
                                                        <input type="hidden" name="nama_dokumen" value="<?= $row['nama_dokumen']; ?>">
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    // Increment counter
                                    $counter++;
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="col-xl-9">
                    <div class="card border-left-danger shadow mb-4 ">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-lg font-weight-bold text-danger text-uppercase ">
                                        Data Kosong</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        ?>


        <div class="col">
            <div class="card border-left-success shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 text-lg font-weight-bold text-success text-uppercase mb-1">Input Data</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-lg font-weight-bold text-success mb-1">
                            Input data Dokumen :
                        </div>
                        <a data-toggle="modal" data-target="#inputModal" class="btn btn-success btn-icon-split float-right">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-circle-right"></i>
                            </span>
                            <span class="text">Input</span>
                        </a>

                        <!-- Modal Input -->
                        <div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="inputModalLabel">Input Dokumen</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="in_doc.php" method="post">
                                            <div class="form-group">
                                                <label for="doc_title">Nama Dokumen :</label>
                                                <input type="text" class="form-control" id="doc_title" name="doc_title" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="kelas">Untuk kelas :</label>
                                                <select class="form-control" id="kelas" name="kelas" required>
                                                    <option value="">Pilih Kelas</option>
                                                    <option value="1">Kelas 1</option>
                                                    <option value="2">Kelas 2</option>
                                                    <option value="3">Kelas 3</option>
                                                    <option value="4">Kelas 4</option>
                                                    <option value="5">Kelas 5</option>
                                                    <option value="6">Kelas 6</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
</div>
<!-- End of Main Content -->

<?php include('../layout/footer.php') ?>