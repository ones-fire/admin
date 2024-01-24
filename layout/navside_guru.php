<?php include_once '../koneksi.php'; ?>
<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon">
                <img src="../img/logo.png" width="50" height="50">
            </div>
            <div class="sidebar-brand-text mx-3">SYFO POSUTU</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item <?= ($nav == 'home') ? 'active' : ''; ?>">
            <a class="nav-link" href="../<?= $_SESSION['pil_page']; ?>/index.php">
                <i class="fas fa-fw fa-home"></i>
                <span>Home</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Heading -->
        <div class="sidebar-heading">Mapel</div>

        <li class="nav-item <?= ($nav == 'nilai') ? 'active' : ''; ?>">
            <a class="nav-link" href="../<?= $role ?>/penilaian.php">
                <i class="fas fa-fw fa-id-card"></i>
                <span>Penilaian</span>
            </a>
        </li>

        <li class="nav-item <?= ($nav == 'mapel') ? 'active' : ''; ?>">
            <a class="nav-link" href="../<?= $role ?>/pelajaran.php">
                <i class="fas fa-user"></i>
                <span>Pelajaran</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Profile Nav Item -->
        <li class="nav-item <?= ($nav == 'prov') ? 'active' : ''; ?>">
            <a class="nav-link" href="../<?= $role ?>/profile.php">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </a>
        </li>

        <!-- Logout Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>


        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <?php
                    $username_nav = $_SESSION['username'];
                    $password_nav = $_SESSION['password'];
                    $pilihan_nav = $_SESSION['pilihan'];

                    // Query untuk mengambil data user
                    $query = "SELECT * FROM $pilihan_nav WHERE nama='$username_nav'AND password='$password_nav'";
                    $resultk = mysqli_query($conn, $query);

                    if (mysqli_num_rows($resultk) > 0) {
                        $fdb_row = mysqli_fetch_assoc($resultk);
                        $jenkel = $fdb_row['jenis_kelamin'];
                        $nami = $fdb_row['nama'];
                    }

                    if ($jenkel == 'perempuan') {
                        $foto = '../img/undraw_profile_1.svg';
                    } else {
                        $foto = '../img/undraw_profile_2.svg';
                    }
                    ?>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $nami; ?></span>
                            <img class="img-profile rounded-circle" src="<?= $foto; ?>" />
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="../<?= $role ?>/profile.php">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->