<?php
include '../koneksi.php';

include '../session.php';

$username = $_SESSION['username'];
$password = $_SESSION['password'];
$pilihan = $_SESSION['pilihan'];
$id = $_SESSION['user_id'];

if (!isset($username)) {
    header("Location: index.php");
    exit();
}
$nav = 'prov';

// Query untuk mengambil data user
$query = "SELECT * FROM guru where id = '$id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $fdb_row = mysqli_fetch_assoc($result);
    $fdb_nama = $fdb_row['nama'];
    $fdb_jenis_kelamin = $fdb_row['jenis_kelamin'];
    $fdb_nip = $fdb_row['nip'];
    $fdb_jabatan = $fdb_row['jabatan'];
    $fdb_tanggal_lahir = $fdb_row['tanggal_lahir'];
    $fdb_alamat = $fdb_row['alamat'];
    $fdb_password = $fdb_row['password'];
}

?>

<?php include('../layout/header.php') ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Pengguna</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Profile Pengguna
                    </h6>
                </div>
                <div class="card-body">
                    <form class="user" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                        <div class=" form-group row">
                            <label for="nip" class="col-sm-2 col-form-label">NIP :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nip" id="nip" value="<?= $fdb_nip ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama" id="nama" value="<?= $fdb_nama; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin :</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                    <option value="Laki-laki" <?php if ($fdb_jenis_kelamin == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                    <option value="Perempuan" <?php if ($fdb_jenis_kelamin == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jabatan' : 'kelas'; ?>" class="col-sm-2 col-form-label">Jabatan:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="jabatan" id="jabatan" value=" <?= $fdb_jabatan ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="<?= $fdb_tanggal_lahir; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $fdb_alamat; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password :</label>
                            <div class="input-group col-sm-10">
                                <input type="password" class="form-control" name="password" id="password" value="<?= $fdb_password; ?>">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                                        <i id="eyeIcon" class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success btn-icon-split float-right">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Simpan</span>
                            </button>
                            <a href="../guru/profile.php" class="btn btn-secondary btn-icon-split float-left">
                                <span class="icon text-white-50">
                                    <i class="fas fa-arrow-circle-left"></i>
                                </span>
                                <span class="text">Kembali</span>
                            </a>

                        </div>

                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            // Pastikan semua input yang diperlukan diisi dengan benar sebelum diproses
                            if (!empty($_POST['nip']) && !empty($_POST['nama']) && !empty($_POST['jenis_kelamin']) && !empty($_POST['jabatan']) && !empty($_POST['tanggal_lahir']) && !empty($_POST['alamat']) && !empty($_POST['password'])) {
                                // Tangkap nilai-nilai yang dikirim melalui formulir
                                $nip = $_POST['nip'];
                                $jabatan = $_POST['jabatan'];

                                $nama = $_POST['nama'];
                                $jenis_kelamin = $_POST['jenis_kelamin'];
                                $tanggal_lahir = $_POST['tanggal_lahir'];
                                $alamat = $_POST['alamat'];
                                $password = $_POST['password'];

                                // Query UPDATE
                                $sql = "UPDATE guru SET ";
                                $sql .= "nip='$nip'";
                                $sql .= ", nama='$nama', jenis_kelamin='$jenis_kelamin', ";
                                $sql .= "jabatan='$jabatan'";
                                $sql .= ", tanggal_lahir='$tanggal_lahir', alamat='$alamat', password='$password' WHERE id='$id'";

                                // Eksekusi query
                                $result = mysqli_query($conn, $sql);

                                if ($result) {
                                    // Jika proses penyimpanan berhasil, Anda dapat melakukan tindakan lain, seperti menampilkan modal atau pesan sukses di halaman yang sama
                                    echo '<script>alert("Data berhasil disimpan!\nTolong Login Kembali.");</script>';
                                    echo '<script>window.location.href = "../logout.php";</script>';
                                } else {
                                    // Jika terjadi kesalahan dalam query, Anda dapat menampilkan pesan error atau melakukan tindakan yang sesuai
                                    echo '<script>alert("Terjadi kesalahan. Data gagal disimpan.");</script>';
                                }
                            } else {
                                // Jika ada input yang kosong, Anda dapat menampilkan pesan error atau melakukan tindakan yang sesuai
                                echo '<script>alert("Semua input harus diisi!");</script>';
                            }
                        }
                        ?>

                        <script>
                            function togglePassword() {
                                var passwordInput = document.getElementById("password");
                                var eyeIcon = document.getElementById("eyeIcon");

                                if (passwordInput.type === "password") {
                                    passwordInput.type = "text";
                                    eyeIcon.classList.remove("fa-eye");
                                    eyeIcon.classList.add("fa-eye-slash");
                                } else {
                                    passwordInput.type = "password";
                                    eyeIcon.classList.remove("fa-eye-slash");
                                    eyeIcon.classList.add("fa-eye");
                                }
                            }
                        </script>
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