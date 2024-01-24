<?php
include '../koneksi.php';

include '../session.php';
$nav = 'absen';

$username = $_SESSION['username'];
$password = $_SESSION['password'];

if (!isset($username)) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['kelas'])) {
    $kelas = $_GET['kelas'];
    if ($kelas == '1') {
        $kels_sis = 'Kelas 1';
    } elseif ($kelas == '2') {
        $kels_sis = 'Kelas 2';
    } elseif ($kelas == '3') {
        $kels_sis = 'Kelas 3';
    } elseif ($kelas == '4') {
        $kels_sis = 'Kelas 4';
    } elseif ($kelas == '5') {
        $kels_sis = 'Kelas 5';
    } elseif ($kelas == '6') {
        $kels_sis = 'Kelas 6';
    } else {
        echo 'Kelas tidak ditemukan';
    }
}

// Mengubah nama bulan dalam bahasa Indonesia
$bulan = array(
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember'
);

// Mendapatkan bulan dalam angka dari tanggal
$bulan_a = date("n");

// Mengganti angka bulan dengan kata bulan
$bulan_k = $bulan[$bulan_a];

// Menggabungkan tanggal, bulan (kata), dan tahun
$tanggal_hasil =  date("d ") . $bulan_k . date(" Y");

// Query untuk mengambil data user
$query = "SELECT * FROM siswa WHERE kelas = '$kelas'";
$result = mysqli_query($conn, $query);

$tanggal_hari_ini = date("Y-m-d");

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

    <!-- Page Headng -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Absensi Siswa</h1>
    </div>

    <?php
    // Memeriksa apakah query berhasil dijalankan
    if ($result) {
        // Memeriksa apakah ada data yang ditemukan
        if (mysqli_num_rows($result) > 0) {
    ?>

            <div class="row">
                <div class="col mb-4">
                    <div class="card shadow mb-4">
                        <form method="post" action="../input/pro_absen.php">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Absen Siswa <?= $kels_sis; ?> </h6>
                                <a class="btn btn-success">
                                    <span class="text">
                                        <label for="tanggal">Tanggal:</label>
                                        <input type="date" id="tanggal_hari_ini" name="tanggal_hari_ini">
                                    </span>
                                </a>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body">
                                <input type="hidden" name="kelas" value="<?= $kelas; ?>">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NISN</th>
                                            <th scope="col">Nama</th>
                                            <th class="text-center align-middle" scope="col">Hadir</th>
                                            <th class="text-center align-middle" scope="col">Ijin</th>
                                            <th class="text-center align-middle" scope="col">Sakit</th>
                                            <th class="text-center align-middle" scope="col">Absen</th>
                                            <th scope="col">Absensi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <input type="hidden" name="edit" value="edit_absensi">

                                        <?php
                                        // Inisialisasi counter
                                        $counter = 1;

                                        // Loop melalui setiap baris data
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $siswa_id = $row['id'];

                                            $query_keterangan = "SELECT
                                                                COUNT(CASE WHEN keterangan = 'hadir' THEN 1 END) AS jumlah_hadir,
                                                                COUNT(CASE WHEN keterangan = 'sakit' THEN 1 END) AS jumlah_sakit,
                                                                COUNT(CASE WHEN keterangan = 'ijin' THEN 1 END) AS jumlah_ijin,
                                                                COUNT(CASE WHEN keterangan = 'absen' THEN 1 END) AS jumlah_absen
                                                            FROM absensi
                                                            WHERE siswa_id = '$siswa_id'";

                                            $result_keterangan = mysqli_query($conn, $query_keterangan);

                                            if ($result_keterangan) {
                                                $row_keterangan = mysqli_fetch_assoc($result_keterangan);
                                                $jumlah_hadir = $row_keterangan['jumlah_hadir'];
                                                $jumlah_sakit = $row_keterangan['jumlah_sakit'];
                                                $jumlah_ijin = $row_keterangan['jumlah_ijin'];
                                                $jumlah_absen = $row_keterangan['jumlah_absen'];

                                                // Gunakan nilai-nilai tersebut sesuai kebutuhan
                                            } else {
                                                echo "Error: " . mysqli_error($conn);
                                            }
                                        ?>

                                            <tr>
                                                <td class="align-middle"><?= $counter; ?></td>
                                                <td class="align-middle"><?= $row['nisn']; ?></td>
                                                <td class="align-middle"><?= $row['nama']; ?></td>
                                                <td class="bg-hadir text-white text-center align-middle"><?= $jumlah_hadir; ?></td>
                                                <td class="bg-ijin text-dark text-center align-middle"><?= $jumlah_sakit; ?></td>
                                                <td class="bg-sakit text-dark text-center align-middle"><?= $jumlah_ijin; ?></td>
                                                <td class="bg-absen text-white text-center align-middle"><?= $jumlah_absen; ?></td>
                                                <td class="align-middle">
                                                    <input type="hidden" name="id[]" value="<?= $row['id']; ?>">
                                                    <select class="form-control" name="absensi[]">
                                                        <option value="hadir" selected>Hadir</option>
                                                        <option value="sakit">Sakit</option>
                                                        <option value="ijin">Ijin</option>
                                                        <option value="absen">Absen</option>
                                                    </select>
                                                </td>
                                            </tr>

                                        <?php
                                            // Increment counter
                                            $counter++;
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <button type="submit" class="btn btn-success btn-icon-split float-right">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="text">Simpan</span>
                                </button>
                        </form>
                    </div>
                </div>
            </div>


</div>

<?php
        } else {
?>
    <div class="card border-left-danger col-lg-8 shadow mb-4">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-lg font-weight-bold text-danger text-uppercase ">
                        Data <?= $kels_sis; ?> Kosong</div>
                </div>
            </div>
        </div>
    </div>
<?php
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Menutup koneksi
    mysqli_close($conn);
?>

<?php
// Memeriksa apakah terdapat variabel GET 'pesan'
if (isset($_GET['pesan'])) {
    $pesan = $_GET['pesan'];
    $tanggal_get = $_GET['tanggal'];

    if ($pesan == "success") {
        echo "<script>alert('Absensi untuk tanggal $tanggal_get berhasil disimpan!')</script>";
    } elseif ($pesan == "failed") {
        echo "<script>alert('Terjadi kesalahan saat menyimpan absensi untuk tanggal $tanggal_get')</script>";
    } elseif ($pesan == "dupe") {
        echo "<script>alert('Kelas ini sudah melakukan absensi, tolong lakukan edit dengan menekan tombol tanggal')</script>";
    }
}
?>



</div>
</div>
<!-- /.container-fluid -->


<?php include('../layout/footer.php') ?>