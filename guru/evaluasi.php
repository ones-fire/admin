<?php
include '../session.php';
$nav = 'nilai';
?>

<?php include('../layout/header.php') ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <table>
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

    <div class="pagination">
        <a href="#">&laquo;</a>
        <a href="#">1</a>
        <a href="#" class="active">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">&raquo;</a>
    </div>


</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include('../layout/footer.php') ?>