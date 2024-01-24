<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>SYFO POSUTU</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet" />
</head>

<!-- Check apakah user sudah login -->

<body id="page-top">
    <?php
    if ($_SESSION['status'] != "login") {
        header("location:../index.php?pesan=belum_login");
    }


    // Check the user's role
    if ($_SESSION['pilihan'] == "admin") {
        $role = "admin"; // Fix: Use $role for assignment
        $navside_role = "navside_ad.php";
    } elseif ($_SESSION['pilihan'] == "guru") {
        $role = "guru"; // Fix: Use $role for assignment
        $navside_role = "navside_guru.php";
    } elseif ($_SESSION['pilihan'] == "siswa") {
        $role = "pages"; // Fix: Use $role for assignment
        $navside_role = "navside.php";
    }
    include('../layout/' . $navside_role);

    ?>