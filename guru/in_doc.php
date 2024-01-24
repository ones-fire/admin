<?php
include '../koneksi.php';

include '../session.php';
$nav = 'home';

$kelas = $_REQUEST['kelas'];
$dokumenTitle = isset($_POST['doc_title']) ? $_POST['doc_title'] : '';

if (empty($kelas)) {
    header("Location: dokumen.php");
    exit();
}

// Query untuk mengambil data siswa
$query = "SELECT *
        FROM siswa 
        WHERE kelas = '$kelas'";
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
    <div class="col-xl-9 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Input Dokumen</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form action="../input/pro_doc.php" method="post" enctype="multipart/form-data">
                    <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                    ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="10%">No</th>
                                    <th scope="col" width="20%">NISN</th>
                                    <th scope="col" width="50%">Nama</th>
                                    <th scope="col" width="20%">Dokumen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Inisialisasi counter
                                $counter = 1;
                                ?>
                                <input type="hidden" name="kelas" value="<?= $kelas; ?>">
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><?= $counter; ?></td>
                                        <td><?= $row['nisn']; ?></td>
                                        <td><?= $row['nama']; ?></td>
                                        <td>
                                            <input type="file" name="dokumen_path[]">
                                            <input type="hidden" name="siswa_id[]" value="<?= $row['id']; ?>">
                                            <input type="hidden" name="doc_title" value="<?= $dokumenTitle; ?>">
                                        </td>
                                    </tr>
                                <?php
                                    $counter++;
                                }
                                ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    <?php
                    } else {
                    ?>
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-lg font-weight-bold text-danger text-uppercase">
                                            Data Siswa di Kelas <?= $kelas; ?> Kosong
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }

                    // Menutup koneksi
                    mysqli_close($conn);
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include('../layout/footer.php') ?>