<?php
require "../../../config/dbconfig.php";

// Mulai session
session_start();

$usersData = "SELECT * FROM users order by nama_lengkap ASC";
$result = mysqli_query($conn, $usersData);

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header('location: /absen/login.php');
    exit();
}

// Ambil data user dari session
$username = $_SESSION['username'];
$role = $_SESSION['role'];

$query = "SELECT * FROM users WHERE username = '$username'";
$result2 = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result2);

// Menampilkan foto profile user
$fotoProfile = $row["foto_profile"];
$fotoProfile_Path = "../upload/" . $fotoProfile;

// Role user
if ($role == 'admin') {
    $roleUsernameSession = $username;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MAHASISWA BARU</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="../../vendors/feather/feather.css">
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../vendors/typicons/typicons.css">
    <link rel="stylesheet" href="../../vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="../../images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- HEAD -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>

                    <!-- LOGO  -->
                    <a class="navbar-brand brand-logo" href="index.php">
                        <img src="../../images/sidebar-logo.png" alt="sidebar-logo" style="width: 200px; height: 70px;" />
                    </a>
                    <!-- LOGO END  -->

                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">

                    <!-- PESAN SELAMAT DATANG  -->
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">Selamat Datang, <span class="text-black fw-bold"><?= $roleUsernameSession ?></span></h1>
                        <h3 class="welcome-sub-text">Administrator Absen Mahasiswa Baru</h3>
                    </li>
                    <!-- PESAN SELAMAT DATANG END  -->

                </ul>
                <ul class="navbar-nav ms-auto">

                    <!-- CARI  -->
                    <li class="nav-item">
                        <form class="search-form" action="#">
                            <i class="icon-search"></i>
                            <input type="search" class="form-control" placeholder="Cari" title="Search here">
                        </form>
                    </li>
                    <!-- CARI END  -->

                    <!-- KALENDER  -->
                    <li class="nav-item d-lg-block">
                        <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                            <span class="input-group-addon input-group-prepend border-right">
                                <span class="icon-calendar input-group-text calendar-icon"></span>
                            </span>
                            <input type="text" class="form-control">
                        </div>
                    </li>
                    <!-- KALENDER END  -->

                    <!-- PROFILE  -->
                    <li class="nav-item dropdown d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" src="../../images/faces/face8.jpg" alt="Profile image">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="../../images/faces/face8.jpg" alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold"><?= $roleUsernameSession ?></p>
                                <p class="fw-light text-muted mb-0"><?= $role ?></p>
                            </div>
                            <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i>Profile
                                saya</a>
                            <a class="dropdown-item" href="../../logout.php"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Keluar</a>
                        </div>
                    </li>
                    <!-- PROFILE END  -->

                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- HEAD END  -->

        <!-- HALAMAN -->
        <div class="container-fluid page-body-wrapper">

            <!-- SETTING SKIN  -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">WARNA SIDEBAR</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border me-3"></div>Terang
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border me-3"></div>Gelap
                    </div>
                    <p class="settings-heading mt-2">WARNA HEADER</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>
            <!-- SETTING SKIN END  -->

            <!-- SIDEBAR  -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../../index.php">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Data</li>
                    <li class="nav-item">
                        <a class="nav-link" href="maba.php" aria-expanded="false" aria-controls="tables">
                            <i class="menu-icon mdi mdi-account-multiple"></i>
                            <span class="menu-title">Mahasiswa Baru</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="absen.php" aria-expanded="false" aria-controls="tables">
                            <i class="menu-icon mdi mdi-table"></i>
                            <span class="menu-title">Absen</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Akun</li>
                    <li class="nav-item">
                        <a class="nav-link" href="../profile/profile.php" aria-expanded="false" aria-controls="form-elements">
                            <i class="menu-icon mdi mdi-account-card-details"></i>
                            <span class="menu-title">Profile</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- SIDEBAR END  -->

            <!-- CHILD HALAMAN -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Mahasiswa Baru</h4>
                                    <div class="card-description justify-content-between">
                                        <button class="btn btn-primary text-white" type="button" data-bs-toggle="modal" data-bs-target="#modalTambah">+&nbsp;&nbsp;Tambah
                                            Mahasiswa</button>
                                        <a href="#" class="btn btn-otline-dark" onclick="window.open('cetak-excel.php')"><i class="icon-printer"></i>
                                            Cetak</a>
                                    </div>

                                    <!-- MODAL TAMBAH MAHASISWA -->
                                    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel" style="font-weight: 800;">TAMBAH
                                                        MAHASISWA BARU</h5>
                                                </div>
                                                <form method="POST" action="../../../action.php" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="fotoProfile">Foto Profile</label>
                                                            <input type="file" class="form-control text-center" name="fotoProfile">
                                                        </div>

                                                        <div class="mb-3">
                                                            <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <select class="form-select" name="jenis_kelamin" required>
                                                                <option disabled selected="selected">---Pilih jenis
                                                                    kelamin---</option>
                                                                <option value="Laki-laki">Laki-laki</option>
                                                                <option value="Perempuan">Perempuan</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <input type="number" class="form-control" name="nim" placeholder="NIM" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                                                        </div>

                                                        <input type="hidden" name="password" value="mabaIlkomUndana23">

                                                        <input type="hidden" name="role" value="user">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" name="btnTambahUser" class="btn btn-success">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- MODAL TAMBAH MAHASISWA END  -->

                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Foto
                                                    </th>
                                                    <th>
                                                        Nama Lengkap
                                                    </th>
                                                    <th>
                                                        Jenis Kelamin
                                                    </th>
                                                    <th>
                                                        Nim
                                                    </th>
                                                    <th>
                                                        Username
                                                    </th>
                                                    <th>
                                                        Role
                                                    </th>
                                                    <th>
                                                        &nbsp;
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php while ($row = mysqli_fetch_array($result)) : ?>
                                                    <tr>
                                                        <td class="py-1">
                                                            <?= '<img src="../upload/' . $row['foto_profile'] . '">'; ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['nama_lengkap'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['jenis_kelamin'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['nim'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['username'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['role'] ?>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <button type="button" class="btn btn-warning btn-icon justify-content-between" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $i ?>">
                                                                    <i class=" ti-pencil-alt"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-danger btn-icon justify-content-between" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $i ?>">
                                                                    <i class=" ti-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- MODAL UBAH MAHASISWA  -->
                                                    <div class="modal fade" id="modalUbah<?= $i ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel" style="font-weight: 800;">UBAH
                                                                        MAHASISWA - <?= $row['nama_lengkap'] ?></h5>
                                                                </div>
                                                                <form method="POST" action="../../../action.php" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <input type="text" class="form-control" name="id" value="<?= $row['id'] ?>" readonly>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <input type="text" class="form-control" name="nama_lengkap" value="<?= $row['nama_lengkap'] ?>" placeholder="Nama Lengkap">
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <select class="form-select" name="jenis_kelamin" required>
                                                                                <option disabled selected value="">----Pilih
                                                                                    jenis
                                                                                    kelamin----</option>
                                                                                <option value="Laki-laki">Laki-laki</option>
                                                                                <option value="Perempuan">Perempuan</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <input type="number" class="form-control" name="nim" value="<?= $row['nim'] ?>" placeholder="NIM">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit" name="btnUbahUser" class="btn btn-warning">Ubah</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- MODAL UBAH MAHASISWA END  -->


                                                    <!-- MODAL HAPUS MAHASISWA  -->
                                                    <form action="../../../action.php">
                                                        <div class="modal fade" id="modalHapus<?= $i ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-scrollable">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="staticBackdropLabel" style="font-weight: 800;">HAPUS
                                                                            MAHASISWA - <?= $row['nama_lengkap'] ?> -
                                                                            <?= $row['nim'] ?> ?</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <h5><?php ?></h5>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit" name="btnHapusUser" class="btn btn-danger">Hapus</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- MODAL HAPUS MAHASISWA END  -->

                                                    <?php $i++; ?>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FOOTER  -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Layout by <a href="https://www.instagram.com/sprite.cocacolaa/" target="_blank">Angkykanni</a></span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2023. All
                            rights reserved.</span>
                    </div>
                </footer>
                <!-- FOOTER END  -->

            </div>
            <!-- CHILD HALAMAN END -->
        </div>
        <!-- HALAMAN END -->
    </div>
    <!-- CONTAINER END -->

    <!-- MODAL JS  -->
    <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function() {
            myInput.focus()
        })
    </script>
    <!-- MODAL JS END  -->

    <!-- plugins:js -->
    <script src="../../vendors/js/vendor.bundle.base.js"></script>
    <script src="../../vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="../../js/off-canvas.js"></script>
    <script src="../../js/hoverable-collapse.js"></script>
    <script src="../../js/template.js"></script>
    <script src="../../js/settings.js"></script>
    <script src="../../js/todolist.js"></script>
</body>

</html>