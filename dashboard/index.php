<?php  
    include '../auth.php';
    include '../koneksi/koneksi.php';

    $role = "";
    $id 	= $_SESSION['auth'];

    if ($_SESSION['role_user'] == 0) {
        $role = "Admin";
        $query      = "SELECT * FROM akun WHERE id = $id";
        $exec       = mysqli_query($conn, $query);

        if ($exec) {
            while ($user = mysqli_fetch_array($exec)) {
                foreach ($user as $key=>$val) {
                    ${$key} = $val;
                }       
            }
        }

    } else {
        $role = "User";
        $query      = "SELECT a.*,b.* FROM pendaftaran a, akun b WHERE a.id = $id AND b.id_user=$id";
        $exec       = mysqli_query($conn, $query);

        if ($exec) {
            while ($user = mysqli_fetch_array($exec)) {
                foreach ($user as $key=>$val) {
                    ${$key} = $val;
                }       
            }
        }
    }

    $getPage = isset($_GET['page']) ? $_GET['page'] : null;

    switch ($getPage) {
        case 1:
            $page 				= "include/home.php";
            $_SESSION['active']	= "1";
            break;
        case 2:
            $page 				= "include/galeri.php";
            $_SESSION['active']	= "2";
            break;
        case 3:
            $page 				= "include/informasi.php";
            $_SESSION['active']	= "3";
            break;
        case 4:
            $page 				= "include/pengaturan.php";
            $_SESSION['active']	= "4";
            break;
        case 5:
            $page 				= "include/guru.php";
            $_SESSION['active']	= "5";
            break;
        case 6:
            $page 				= "include/kegiatan_harian.php";
            $_SESSION['active']	= "6";
            break;
        case 7:
            $page 				= "include/kegiatan_mingguan.php";
            $_SESSION['active']	= "7";
            break;
        case 8:
            $page 				= "include/kegiatan_tahunan.php";
            $_SESSION['active']	= "8";
            break;
        case 9:
            $page 				= "include/profile.php";
            $_SESSION['active']	= "9";
            break;
        case 10:
            $page 				= "syarat/syarat_pendaftaran.php";
            $_SESSION['active']	= "10";
            break;
        case 11:
            $page 				= "syarat/upload_akte.php";
            $_SESSION['active']	= "10";
            break;
        case 12:
            $page 				= "syarat/upload_foto2r.php";
            $_SESSION['active']	= "10";
            break;
        case 13:
            $page 				= "konfirmasi/konfirmasi_pendaftaran.php";
            $_SESSION['active']	= "11";
            break;
        case 14:
            $page 				= "bayar/pembayaran.php";
            $_SESSION['active']	= "12";
            break;
        case 15:
            $page 				= "bayar/review_pembayaran_pendaftaran.php";
            $_SESSION['active']	= "12";
            break;
        case 16:
            $page 				= "bayar/konfirmasi_pembayaran_user.php";
            $_SESSION['active']	= "13";
            break;
        case 17:
            $page 				= "bayar/upload_pembayaran_pendaftaran.php";
            $_SESSION['active']	= "13";
            break;
        case 18:
            $page               = "konfirmasi/konfirmasi_pembayaran_pendaftaran.php";
            $_SESSION['active'] = '14';
            break;
        case 19:
            $page               = "konfirmasi/proses_konfirmasi_pembayaran_pendaftaran.php";
            $_SESSION['active'] = '14';
            break;
        case 20:
            $page               = "laporan/laporan.php";
            $_SESSION['active'] = '15';
            break;
        case 21:
            $page 				= "syarat/upload_ijazah.php";
            $_SESSION['active']	= "10";
            break;
        case 22:
            $page 				= "quiz/quiz.php";
            $_SESSION['active']	= "16";
            break;
        default:
            $page 	= "include/home.php";
            $_SESSION['active']	= "1";
            break;
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>
            <hr class="sidebar-divider my-0"> <!-- Divider -->
            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php echo $_SESSION['active'] == 1 ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?page=1">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Home</span>
                </a>
            </li>
            </li>
            <?php if ($role == "User") { ?>
                <!-- Nav Item - Profile -->
                <hr class="sidebar-divider my-0"> <!-- Divider -->
                <li class="nav-item <?php echo $_SESSION['active'] == 9 ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=9">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>User Profile</span>
                    </a>
                </li>
                <!-- Nav Item - Syarat Pendaftaran -->
                <hr class="sidebar-divider my-0"> <!-- Divider -->
                <li class="nav-item <?php echo $_SESSION['active'] == 10 ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=10">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Syarat Pendaftaran</span>
                    </a>
                </li>
                <!-- Nav Item - Quiz -->
                <hr class="sidebar-divider my-0"> <!-- Divider -->
                <li class="nav-item <?php echo $_SESSION['active'] == 16 ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=22">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Quiz</span>
                    </a>
                </li>
                <!-- Nav Item - Pembayaran -->
                <hr class="sidebar-divider my-0"> <!-- Divider -->
                <li class="nav-item <?php echo $_SESSION['active'] == 12 ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=14">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Pembayaran</span>
                    </a>
                </li>
                <!-- Nav Item - Konfirmsi Pembayaran -->
                <hr class="sidebar-divider my-0"> <!-- Divider -->
                <li class="nav-item <?php echo $_SESSION['active'] == 13 ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=16">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Konfirmasi Pembayaran Pendaftaran</span>
                    </a>
                </li>
                        
            <?php } ?>

            <?php if ($role == "Admin") { ?>
                <!-- Nav Item - Galeri -->
                <hr class="sidebar-divider my-0"> <!-- Divider -->
                <li class="nav-item <?php echo $_SESSION['active'] == 2 ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=2">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Galeri</span>
                    </a>
                </li>
                <!-- Nav Item - Informasi -->
                <hr class="sidebar-divider my-0"> <!-- Divider -->
                <li class="nav-item <?php echo $_SESSION['active'] == 3 ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=3">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Informasi</span>
                    </a>
                </li>
                <!-- Nav Item - Pengaturan -->
                <hr class="sidebar-divider my-0"> <!-- Divider -->
                <li class="nav-item <?php echo $_SESSION['active'] == 4 ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=4">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>
                <!-- Nav Item - Guru -->
                <hr class="sidebar-divider my-0"> <!-- Divider -->
                <li class="nav-item <?php echo $_SESSION['active'] == 5 ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=5">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Guru</span>
                    </a>
                </li>
                <!-- Nav Item - Kegiatan -->
                <hr class="sidebar-divider my-0"> <!-- Divider -->
                <li class="nav-item <?php echo in_array($_SESSION['active'], [6, 7, 8]) ? 'active' : ''; ?>">
                    <a class="nav-link <?php echo in_array($_SESSION['active'], [6, 7, 8]) ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="<?php echo in_array($_SESSION['active'], [6, 7, 8]) ? 'true' : 'false'; ?>" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Kegiatan</span>
                    </a>
                    <div id="collapseTwo" class="collapse <?php echo in_array($_SESSION['active'], [6, 7, 8]) ? 'show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?php echo $_SESSION['active'] == 6 ? 'active' : ''; ?>" href="index.php?page=6">Harian</a>
                            <a class="collapse-item <?php echo $_SESSION['active'] == 7 ? 'active' : ''; ?>" href="index.php?page=7">Mingguan</a>
                            <a class="collapse-item <?php echo $_SESSION['active'] == 8 ? 'active' : ''; ?>" href="index.php?page=8">Tahunan</a>
                        </div>
                    </div>
                </li>
                <!-- Nav Item - Konfirmasi Pendaftaram -->
                <hr class="sidebar-divider my-0"> <!-- Divider -->
                <li class="nav-item <?php echo $_SESSION['active'] == 11 ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=13">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Konfirmasi Pendaftaran</span>
                    </a>
                </li>
                <!-- Nav Item - Konfirmasi Pembayaran -->
                <hr class="sidebar-divider my-0"> <!-- Divider -->
                <li class="nav-item <?php echo $_SESSION['active'] == 14 ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=18">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Konfirmasi Pembayaran Pendaftaran</span>
                    </a>
                </li>
                <!-- Nav Item - Laporan -->
                <hr class="sidebar-divider my-0"> <!-- Divider -->
                <li class="nav-item <?php echo $_SESSION['active'] == 15 ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=20">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Laporan</span>
                    </a>
                </li>

			<?php } ?>
               
            
            <!-- Nav Item - Logout -->
            <hr class="sidebar-divider my-0"> <!-- Divider -->
            <li class="nav-item active">
                <a class="nav-link" href="../logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
            
            <hr class="sidebar-divider d-none d-md-block"> <!-- Divider -->
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content"><br>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php include $page; ?>     
                </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/chart-area-demo.js"></script>
    <script src="../assets/js/demo/chart-pie-demo.js"></script>

</body>
</html>