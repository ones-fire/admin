<?php
include '../session.php';
$nav = 'home';
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

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Evaluasi</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Foto Pengguna
                        <div class="pagination float-right">
                            <a href="#">&laquo;</a>
                            <a href="#">1</a>
                            <a href="#" class="active">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">&raquo;</a>
                        </div>
                    </h6>

                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div style="display: flex; justify-content: center;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Evaluasi</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Pengetahuan Umum</td>
                                        <td>80</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Penalaran</td>
                                        <td>90</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Kemampuan Berbahasa</td>
                                        <td>75</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Kemampuan Komunikasi</td>
                                        <td>85</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Kemampuan Pemecahan Masalah</td>
                                        <td>95</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Kerja Sama Tim</td>
                                        <td>70</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Kreativitas</td>
                                        <td>88</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Inisiatif</td>
                                        <td>82</td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Kedisiplinan</td>
                                        <td>92</td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Ketepatan Waktu</td>
                                        <td>78</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include('../layout/footer.php') ?>