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

    <!-- 404 Error Text -->
    <div class="text-center">
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Page Home Not Found</p>
        <p class="text-gray-500 mb-0">Sepertinya anda menemukan halaman yang tidak terurus dengan benar...</p>
        <a href="index.html">&larr; Back to Home</a>
    </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include('../layout/footer.php') ?>