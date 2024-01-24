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
$query = "SELECT d.nama_dokumen, d.id
            FROM dokumen AS d
            JOIN siswa AS s ON d.siswa_id = s.id
            WHERE s.nama = '$username' AND s.password = '$password'";
$result = mysqli_query($conn, $query);
?>

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
                        echo '<td>';
                    ?>
                        <a href="../input/unduh_doc.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                                <i class="fas fa-download"></i>
                            </span>
                            <span class="text">Download</span>
                        </a>
                    <?php
                        echo '</td>';
                        echo "</tr>";
                        // Increment counter
                        $counter++;
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include('../layout/footer.php') ?>