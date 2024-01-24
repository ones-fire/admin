<?php
include '../koneksi.php';

include '../session.php';
$nav = 'guru';

$username = $_SESSION['username'];
$password = $_SESSION['password'];

if (!isset($username)) {
    header("Location: index.php");
    exit();
}

// Query untuk mengambil data user
$query = "SELECT * FROM guru";
$result = mysqli_query($conn, $query);

?>

<?php include('../layout/header.php');
if ($role !== 'admin') {
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
        <h1 class="h3 mb-0 text-gray-800">Data User Guru</h1>
    </div>

    <div class="row">

        <div class="col-xl-9 ">
            <?php
            // Memeriksa apakah query berhasil dijalankan
            if ($result) {
                // Memeriksa apakah ada data yang ditemukan
                if (mysqli_num_rows($result) > 1) {
            ?>
                    <div class="card shadow mb-3">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Data Guru Ditemukan</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NIP</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Jenis Kelamin</th>
                                            <th scope="col">Tanggal Lahir</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Jabatan</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Inisialisasi counter
                                        $counter = 1;
                                        // Loop melalui setiap baris data
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if ($row['id'] == 0) {
                                                continue;
                                            }
                                            echo "<tr>";
                                            echo "<td>" . $counter . "</td>";
                                            echo "<td>" . $row['nip'] . "</td>";
                                            echo "<td>" . $row['nama'] . "</td>";
                                            echo "<td>" . $row['jenis_kelamin'] . "</td>";
                                            echo "<td>" . $row['tanggal_lahir'] . "</td>";
                                            echo "<td>" . $row['alamat'] . "</td>";
                                            echo "<td>" . $row['jabatan'] . "</td>";
                                            echo '<td>';
                                        ?>
                                            <button onclick="editData(<?= $row['id']; ?>)" class="btn btn-success btn-icon-split btn-sm" style="margin-top: 1.5px; margin-bottom: 1.5px;">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-pen"></i>
                                                </span>
                                                <span class="text">Edit</span>
                                            </button>
                                            <button onclick="hapusData_ind(<?= $row['id']; ?>, '<?= $row['nama']; ?>')" class="btn btn-danger btn-icon-split btn-sm" style="margin-top: 1.5px; margin-bottom: 1.5px;">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                <span class="text">Hapus</span>
                                            </button>

                                            <?php
                                            echo "</td>";
                                            echo "</tr>";
                                            // Increment counter
                                            $counter++;
                                            ?>

                                            <!-- Modal Hapus -->
                                            <div class="modal fade" id="hapusIndModal" tabindex="-1" role="dialog" aria-labelledby="hapusIndModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="hapusIndModalLabel">Konfirmasi Hapus</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus data <span id="hapusNama"></span>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <a id="hapusData_ind" href="#" class="btn btn-danger">Hapus</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                function editData(id) {
                                                    // Mengarahkan pengguna ke halaman edit_user.php dengan meneruskan parameter ID melalui URL
                                                    window.location.href = '../input/edit_user.php?id=' + id + '&tabel=guru';
                                                }

                                                function hapusData_ind(id, nama) {
                                                    // Menampilkan nama pada elemen span dengan id "hapusNama"
                                                    document.getElementById("hapusNama").textContent = nama;

                                                    // Mengubah href pada elemen <a> dengan id "hapusData_ind"
                                                    document.getElementById("hapusData_ind").href = '../input/hapus_user.php?id=' + id + '&tabel=siswa&tipe=individual';

                                                    // Menampilkan modal hapusIndModal
                                                    $('#hapusIndModal').modal('show');
                                                }
                                            </script>
                                    </tbody>
                            </div>
                        </div>
                    </div>

                <?php
                                        }
                                        echo "</table>";
                                    } else {
                ?>
                <div class="card border-left-danger shadow mb-4">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-lg font-weight-bold text-danger text-uppercase">
                                    Data Kosong
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
        <?php
        // Menutup koneksi
        mysqli_close($conn);
        ?>

        </div>
    </div>
</div>
</div>
<div class="col">
    <div class="card border-left-success shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 text-lg font-weight-bold text-success text-uppercase mb-1">Input Data</h6>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-lg font-weight-bold text-success mb-1">
                    Input user guru :
                </div>
                <a href="../admin/in_guru.php" class="btn btn-success btn-icon-split float-right">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-circle-right"></i>
                    </span>
                    <span class="text">Input</span>
                </a>
            </div>
            <br>



            <!-- Modal Input -->
            <div class="modal fade bd-example-modal-lg" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="inputModalLabel">Upload Excel File</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <span>Gunakanlah Template Excel yang disediakan untuk upload file:</span>
                            <span><a href="../input/generate_excel.php?tabel=guru" class="btn btn-warning">unduh template Excel</a></span><br>
                            <div id="error-message" class="alert alert-danger mt-3" style="display: none;"></div>
                        </div>
                        <div class="modal-footer">
                            <form action="../input/pro_excel_sis.php?tabel=guru" method="post" enctype="multipart/form-data" class="row-g-2">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <input class="form-control" type="file" name="file" id="formfile">
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">
                                            Batal
                                        </button>
                                        <button id="submitButton" type="submit" class="btn btn-success">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Mendapatkan elemen-elemen yang diperlukan
                var inputModal = document.getElementById('inputModal');
                var submitButton = document.getElementById('submitButton');
                var errorMessage = document.getElementById('error-message');

                // Mengatur event handler saat modal ditampilkan
                inputModal.addEventListener('show.bs.modal', function(event) {
                    // Menghilangkan pesan kesalahan yang mungkin ditampilkan sebelumnya
                    errorMessage.style.display = 'none';
                });

                // Mengatur event handler saat tombol Upload diklik
                submitButton.addEventListener('click', function(event) {
                    // Mengecek apakah file telah dipilih
                    var inputFile = document.getElementById('formfile');
                    if (inputFile.files.length === 0) {
                        errorMessage.textContent = 'Mohon pilih file yang akan diupload.';
                        errorMessage.style.display = 'block';
                        return;
                    }

                    // Mengecek ekstensi file
                    var file = inputFile.files[0];
                    var fileName = file.name;
                    var fileExt = fileName.split('.').pop().toLowerCase();
                    if (fileExt !== 'xlsx') {
                        errorMessage.textContent = 'Hanya file dengan ekstensi .xlsx yang diperbolehkan.';
                        errorMessage.style.display = 'block';
                        return;
                    }

                    // Lanjutkan proses submit form jika sudah valid
                    var form = document.querySelector('form');
                    form.submit();
                });

                // Menampilkan pesan kesalahan dari server
                <?php if (isset($_GET['error'])) { ?>
                    errorMessage.textContent = '<?php echo $_GET['error']; ?>';
                    errorMessage.style.display = 'block';
                <?php } ?>
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