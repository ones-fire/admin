<?php
include '../koneksi.php';

include '../session.php';
$nav = 'siswa';

$username = $_SESSION['username'];
$password = $_SESSION['password'];

if (!isset($username)) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data yang dikirimkan melalui form
    $kelas_select = $_POST['kelas_select'];

    if ($kelas_select === '0') {
        // Query untuk mengambil data user
        $query = "SELECT * FROM siswa";
        $result = mysqli_query($conn, $query);
    } else {
        // Query untuk mengambil data user
        $query = "SELECT * FROM siswa WHERE kelas = '$kelas_select'";
        $result = mysqli_query($conn, $query);
    }
} else {
    // Query untuk mengambil data user
    $query = "SELECT * FROM siswa";
    $result = mysqli_query($conn, $query);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Periksa apakah form telah disubmit dengan metode POST
    if (isset($_POST['kelas_hapus'])) {
        // Periksa apakah variabel $kelas_hapus ada
        $kelas_hapus = $_POST['kelas_hapus'];
    }
}

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
        <h1 class="h3 mb-0 text-gray-800">Data User Siswa</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <?php
        // Memeriksa apakah query berhasil dijalankan
        if ($result) {
            // Memeriksa apakah ada data yang ditemukan
            if (mysqli_num_rows($result) > 0) {
        ?>
                <div class="col-xl-9 col-lg-5">
                    <div class="card shadow mb-3">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Data Siswa <?php if (isset($kelas_select) && !empty($kelas_select)) {
                                                                                            echo 'Kelas ' . $kelas_select;
                                                                                        } else {
                                                                                            echo "Yang Ditemukan";
                                                                                        } ?></h6>
                        </div>
                        <!-- Card Body -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NISN</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Jenis Kelamin</th>
                                            <th scope="col">Tanggal Lahir</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Inisialisasi counter
                                        $counter = 1;

                                        // Loop melalui setiap baris data
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $counter . "</td>";
                                            echo "<td>" . $row['nisn'] . "</td>";
                                            echo "<td>" . $row['nama'] . "</td>";
                                            echo "<td>" . $row['jenis_kelamin'] . "</td>";
                                            echo "<td>" . $row['tanggal_lahir'] . "</td>";
                                            echo "<td>" . $row['alamat'] . "</td>";
                                            echo "<td>" . $row['kelas'] . "</td>";
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
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

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
                                    window.location.href = '../input/edit_user.php?id=' + id + '&tabel=siswa';
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



                        </div>
                    <?php
                } else {
                    ?>
                        <div class="col-xl-9 col-lg-5">
                            <div class="card border-left-danger shadow mb-3">
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="text-lg font-weight-bold text-danger text-uppercase ">

                                        <?php
                                        if (isset($kelas_select) && !empty($kelas_select)) {
                                            if ($kelas_select === 'Semua') {
                                                echo '                    Data Siswa Kosong';
                                            } else {
                                                echo '                    Data Kelas ' . $kelas_select . ' Kosong';
                                            }
                                        } else {
                                            echo '                    Data Siswa Kosong';
                                        }
                                        ?>

                                    </div>
                                </div>


                            <?php
                        }
                            ?>
                            </div>

                        <?php
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                        ?>



                        </div>
                        <?php
                        $query1 = "SELECT * FROM siswa";
                        $result_cek = mysqli_query($conn, $query1);
                        if (mysqli_num_rows($result_cek) > 0) {

                        ?>
                            <div class="col-md-3">
                                <div class="card border-left-info shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 text-lg font-weight-bold text-info text-uppercase mb-1">Lihat data siswa berdasarkan kelas?</h6>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <div class="form-row align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-lg font-weight-bold text-info mb-1">
                                                        Lihat kelas : </div>
                                                </div>
                                                <div class="col-auto ">
                                                    <select class="custom-select mr-sm-2" id="kelas_select" name="kelas_select">
                                                        <option selected value="0">Semua</option>
                                                        <option value="1">Satu</option>
                                                        <option value="2">Dua</option>
                                                        <option value="3">Tiga</option>
                                                        <option value="4">Empat</option>
                                                        <option value="5">Lima</option>
                                                        <option value="6">Enam</option>
                                                    </select>
                                                </div>

                                                <button type='submit' class="btn btn-info btn-icon-split ">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-check"></i>
                                                    </span>
                                                    <span class="text">Lihat</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="card border-left-success shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 text-lg font-weight-bold text-success text-uppercase mb-1">Input Data</h6>
                                    </div>

                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="text-lg font-weight-bold text-success mb-1">
                                                Input satu siswa :
                                            </div>
                                            <a href="../admin/in_siswa.php" class="btn btn-success btn-icon-split float-right">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-arrow-circle-right"></i>
                                                </span>
                                                <span class="text">Input</span>
                                            </a>
                                        </div>
                                        <br>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="text-lg font-weight-bold text-success mb-1">
                                                Input melalui file excel :
                                            </div>
                                            <button type="button" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#inputModal" onclick="setSelectedKelasInput()">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-file-excel"></i>
                                                </span>
                                                <span class="text">Input</span>
                                            </button>
                                        </div>
                                    </div>


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
                                                    <span>Gunakanlah Template Excel yang disediakan untuk upload file :</span>
                                                    <span><a href="../input/generate_excel.php?tabel=siswa" class="btn btn-warning">unduh template Excel</a></span><br>
                                                    <div id="error-message" class="alert alert-danger mt-3" style="display: none;"></div>
                                                    <br>
                                                    <span>Pilih File Excel yang akan diupload :</span>
                                                    <form action="../input/pro_excel_sis.php" method="post" enctype="multipart/form-data" class="row-g-2">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <input class="form-control" type="file" name="file" id="formfile" accept=".xlsx">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="modal-footer">
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

                                <div class="card border-left-danger shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 text-lg font-weight-bold text-danger text-uppercase mb-1">Hapus data siswa berdasarkan kelas?</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">

                                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <div class="form-row align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-lg font-weight-bold text-danger mb-1">
                                                        Hapus kelas :
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <select class="custom-select mr-sm-2" id="kelas_hapus" name="kelas_hapus">
                                                        <!-- pilihan kelas -->
                                                        <option selected value="0">Pilih...</option>
                                                        <option value="all">Semua</option>
                                                        <option value="1">Satu</option>
                                                        <option value="2">Dua</option>
                                                        <option value="3">Tiga</option>
                                                        <option value="4">Empat</option>
                                                        <option value="5">Lima</option>
                                                        <option value="6">Enam</option>
                                                    </select>
                                                </div>
                                                <button type="button" class="btn btn-danger btn-icon-split float-right" onclick="setSelectedKelasHapus()">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                    <span class="text">Hapus</span>
                                                </button>
                                            </div>
                                        </form>

                                        <!-- Modal Hapus -->
                                        <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span id="kelasToDelete"></span>
                                                        <br>Apakah Anda yakin ingin menghapus kelas ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">
                                                            Batal
                                                        </button>
                                                        <a id="hapusLink" class="btn btn-danger" href="hapus.php">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <script>
                                function setSelectedKelasHapus() {
                                    // Mengambil nilai dari input kelas_hapus
                                    var kelasHapus = document.getElementById("kelas_hapus");
                                    var kelasValue = kelasHapus.options[kelasHapus.selectedIndex].text;

                                    // Menampilkan atau menyembunyikan modal berdasarkan nilai kelas
                                    if (kelasValue === "Pilih...") {
                                        // Jika opsi "Pilih..." dipilih, sembunyikan modal
                                        $('#hapusModal').modal('hide');
                                    } else {
                                        // Jika opsi lain dipilih, tampilkan modal
                                        $('#hapusModal').modal('show');

                                        // Menyimpan nilai kelas ke dalam elemen modal
                                        var kelasToDeleteElement = document.getElementById("kelasToDelete");
                                        kelasToDeleteElement.textContent = "Kelas yang akan dihapus : Kelas  " + kelasValue;

                                        // Mengubah link href pada tombol "Hapus" di dalam modal
                                        var hapusLink = document.getElementById("hapusLink");
                                        hapusLink.href = '../input/hapus_user.php?kelas=' + kelasValue + '&tabel=siswa&tipe=all';
                                    }
                                }
                            </script>
                        <?php
                        }
                        ?>


                    </div>
                    <!-- /.container-fluid -->

                </div>
    </div>

    <?php
    // Menutup koneksi
    mysqli_close($conn);
    ?>

    <?php include('../layout/footer.php') ?>