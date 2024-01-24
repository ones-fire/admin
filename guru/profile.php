<?php
include '../koneksi.php';

include '../session.php';
$nav = 'prov';

$username = $_SESSION['username'];
$password = $_SESSION['password'];
$pilihan = $_SESSION['pilihan'];

if (!isset($username)) {
    header("Location: index.php");
    exit();
}

// Query untuk mengambil data user
$query = "SELECT * FROM $pilihan WHERE nama='$username'AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $fdb_row = mysqli_fetch_assoc($result);
    $fdb_user_id = $fdb_row['id'];
    $fdb_nip = $fdb_row['nip'];
    $fdb_nama = $fdb_row['nama'];
    $fdb_jenis_kelamin = $fdb_row['jenis_kelamin'];
    $fdb_alamat = $fdb_row['alamat'];
    $fdb_password = $fdb_row['password'];
    $fdb_jabatan = $fdb_row['jabatan'];
    $fdb_tanggal_lahir = $fdb_row['tanggal_lahir'];
}

$_SESSION['user_id'] = $fdb_user_id;

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

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
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
                    <form class="user">
                        <div class="form-group row">
                            <label for="nip" class="col-sm-2 col-form-label">NIP :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nip" id="nip" value="<?= $fdb_nip; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama" id="nama" value="<?= $fdb_nama; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" value="<?= $fdb_jenis_kelamin; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="<?= $fdb_tanggal_lahir; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $fdb_alamat; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-2 col-form-label">Jabatan :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="jabatan" id="jabatan" value="<?= $fdb_jabatan; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password :</label>
                            <div class="input-group col-sm-10">
                                <input type="password" class="form-control" name="password" id="password" value="<?= $fdb_password; ?>" readonly>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                                        <i id="eyeIcon" class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <a href="../guru/profile_ed.php" class="btn btn-info btn-icon-split float-right">
                            <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text">Edit</span>
                        </a>

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