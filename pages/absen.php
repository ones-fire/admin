<?php
include '../koneksi.php';

include '../session.php';
$nav = 'absen';

if (empty($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];
$password = $_SESSION['password'];
$pilihan = $_SESSION['pilihan'];

// Query untuk mengambil data user
$query = "SELECT * FROM $pilihan WHERE nama='$username' AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $fdb_row = mysqli_fetch_assoc($result);
    $siswa_id = $fdb_row['id'];
}

// Query untuk mengambil 

?>

<style>
    .bg-hadir {
        background-color: rgba(40, 167, 69, 0.7);
        /* Hijau transparan */
    }

    .bg-ijin,
    .bg-sakit {
        background-color: rgba(255, 193, 7, 0.7);
        /* Kuning transparan */
    }

    .bg-absen {
        background-color: rgba(220, 53, 69, 0.7);
        /* Merah transparan */
    }
</style>

<?php include('../layout/header.php');
if ($role !== 'pages') {
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

    <!-- Page Headng -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Absensi Siswa</h1>
    </div>

    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Absen Siswa</h6>
        </div>

        <div class="card-body">
            <table class="table bordered">
                <thead>
                    <tr>
                        <th class="table-dark text-center align-middle" width="5%">No</th>
                        <th class="table-dark text-center align-middle" width="15%">Tanggal</th>
                        <th class="table-dark text-center align-middle" width="10%" scope="col">Hadir</th>
                        <th class="table-dark text-center align-middle" width="10%" scope="col">Sakit</th>
                        <th class="table-dark text-center align-middle" width="10%" scope="col">Ijin</th>
                        <th class="table-dark text-center align-middle" width="10%" scope="col">Absen</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    // Inisialisasi counter
                    $counter = 1;
                    $Chadir = 0;
                    $Csakit = 0;
                    $Cijin = 0;
                    $Cabsen = 0;

                    $query_absensi = "SELECT * FROM absensi WHERE siswa_id = '$siswa_id' ORDER BY `absensi`.`tanggal` ASC ";

                    $result_absensi = mysqli_query($conn, $query_absensi);

                    // Loop melalui setiap baris data
                    while ($row = mysqli_fetch_assoc($result_absensi)) {
                        $tanggal = $row['tanggal'];
                        $tgl_format = date("l, j F Y", strtotime($tanggal));
                    ?>
                        <tr>
                            <td class="align-middle text-center align-middle"><?= $counter; ?></td>
                            <td class="align-middle text-center align-middle"><?= $tgl_format; ?></td>
                            <td <?php if ($row['keterangan'] == 'hadir') {
                                    $tag = "Hadir";
                                    echo 'class="bg-hadir text-white text-center align-middle"';
                                    $Chadir++;
                                } else {
                                    echo 'class="text-center align-middle"';
                                    $tag = "-";
                                } ?>><?= $tag; ?></td>
                            <td <?php if ($row['keterangan'] == 'sakit') {
                                    $tag = "Sakit";
                                    echo 'class="bg-sakit text-white text-center align-middle"';
                                    $Csakit++;
                                } else {
                                    echo 'class="text-center align-middle"';
                                    $tag = "-";
                                } ?>><?= $tag; ?></td>
                            <td <?php if ($row['keterangan'] == 'ijin') {
                                    $tag = "Ijin";
                                    echo 'class="bg-ijin text-white text-center align-middle"';
                                    $Cijin++;
                                } else {
                                    echo 'class="text-center align-middle"';
                                    $tag = "-";
                                } ?>><?= $tag; ?></td>
                            <td <?php if ($row['keterangan'] == 'absen') {
                                    $tag = "Absen";
                                    echo 'class="bg-absen text-white text-center align-middle"';
                                    $Cabsen++;
                                } else {
                                    echo 'class="text-center align-middle"';
                                    $tag = "-";
                                } ?>><?= $tag; ?></td>
                        </tr>

                    <?php
                        // Increment counter
                        $counter++;
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="table-dark align-middle text-center align-middle" colspan="2">Jumlah</td>
                        <td class="bg-hadir text-white text-center align-middle"><?= $Chadir; ?></td>
                        <td class="bg-ijin text-white text-center align-middle"><?= $Cijin; ?></td>
                        <td class="bg-sakit text-white text-center align-middle"><?= $Csakit; ?></td>
                        <td class="bg-absen text-white text-center align-middle"><?= $Cabsen; ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include '../layout/footer.php'; ?>