<?php
require "../config/dbconfig.php";

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
$fotoProfile_Path = "pages/upload/" . $fotoProfile;

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
    <title>ADMIN ABSEN STUDENT DAY </title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/typicons/typicons.css">
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="js/select.dataTables.min.css">

    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">

    <!-- icon  -->
    <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
    <!-- CONTAINER  -->
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
                        <img src="images/sidebar-logo.png" alt="sidebar-logo" style="width: 200px; height: 70px;" />
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
                            <input type="search" class="form-control" placeholder="Search Here" title="Search here">
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
                            <img class="img-xs rounded-circle" src="images/faces/face8.jpg" alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="images/faces/face8.jpg" alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold"><?= $roleUsernameSession ?></p>
                                <p class="fw-light text-muted mb-0"><?= $role ?></p>
                            </div>
                            <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i>Profile
                                saya</a>
                            <a class="dropdown-item" href="logout.php"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Keluar</a>
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
                        <a class="nav-link" href="index.php">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Data</li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/data/maba.php" aria-expanded="false" aria-controls="tables">
                            <i class="menu-icon mdi mdi-account-multiple"></i>
                            <span class="menu-title">Mahasiswa Baru</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/data/absen.php" aria-expanded="false" aria-controls="tables">
                            <i class="menu-icon mdi mdi-table"></i>
                            <span class="menu-title">Absen</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Akun</li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/profile/profile.php" aria-expanded="false" aria-controls="form-elements">
                            <i class="menu-icon mdi mdi-account-card-details"></i>
                            <span class="menu-title">Profile</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- SIDEBAR END  -->

            <!-- CHILD HALAMAN  -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="home-tab">
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <ul class="nav nav-tabs" role="tablist">
                                    </ul>
                                    <div>
                                        <div class="btn-wrapper">
                                            <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i>
                                                Print</a>
                                            <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Download</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="statistics-details d-flex align-items-center" style="gap: 50px;">
                                                    <div>
                                                        <p class="statistics-title">Mahasiswa Baru</p>
                                                        <h3 class="rate-percentage text-success">32.53%</h3>
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Absensi</p>
                                                        <h3 class="rate-percentage text-danger">7,682</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-12 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="card-body">
                                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                                    <div>
                                                                        <h4 class="card-title card-title-dash">Mahasiswa
                                                                            Baru</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="table-responsive  mt-1">
                                                                    <table class="table select-table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Profile</th>
                                                                                <th>NIM</th>
                                                                                <th>Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php while ($row = mysqli_fetch_array($result)) : ?>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="d-flex ">
                                                                                            <?= '<img src="pages/upload/' . $row['foto_profile'] . '">'; ?>
                                                                                            <div>
                                                                                                <h6><?= $row['nama_lengkap'] ?>
                                                                                                </h6>
                                                                                                <p><?= $row['role'] ?></p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <h6><?= $row['nim'] ?></h6>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="badge badge-opacity-success">
                                                                                            &nbsp;&nbsp;&nbsp;Hadir&nbsp;&nbsp;&nbsp;
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php endwhile; ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
            <!-- CHILD HALAMAN END  -->

        </div>
        <!-- HALAMAN END  -->

    </div>
    <!-- CONTAINER END  -->

    <!-- plugins: js  -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="vendors/progressbar.js/progressbar.min.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <script src="js/jquery.cookie.js" type="text/javascript"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/Chart.roundedBarCharts.js"></script>
</body>

</html>