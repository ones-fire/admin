<?php
include '../session.php';
$nav = 'home';
?>

<?php $navbar = ($_SESSION['pilihan'] == "guru") ? "navside_ad.php" : "navside.php"; ?>

<?php include('layout/header.php') ?>
<?php include('layout/' . $navbar) ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- 404 Error Text -->
    <div class="text-center">
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Page Not Found</p>
        <p class="text-gray-500 mb-0">Sepertinya anda menemukan halaman yang tidak terurus dengan benar...</p>
        <a href="../<?= ($_SESSION['pilihan'] == "guru") ? "admin" : "pages"; ?>/index.php">&larr; Back to Home</a>
    </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include('layout/footer.php') ?>
<?php include('layout/add.php') ?>