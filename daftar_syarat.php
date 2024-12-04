<?php  
    session_start();

    if (!isset($_SESSION)) {
        echo 'Session tidak tersedia';
        exit();
    }

    $_SESSION['is_data_parent_exist'] = "";
    $_SESSION['is_data_student_exist'] = "";
    $_SESSION['is_data_account_exist'] = "";

    if (isset($_POST['submit'])) {
        foreach ($_POST as $key => $val) {
            ${$key} = $val;
            $_SESSION[$key] = $val;
        }

        if (!empty($_SESSION)) {
            echo '<script> window.location="daftar_data_orangtua.php"; </script>';
            print_r($_SESSION);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="uploads/identitas/favicon-sekolah.png">
    <title>Penerimaan Santri Baru</title>
    
    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style3.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="title">Syarat Pendaftaran</h4>
                        <p class="category">Isi Form pendaftaran dengan benar</p>
                    </div>
                    <div class="card-body">
                        <h3>Berikut adalah syarat pendaftaran siswa baru yang harus dipenuhi:</h3>
                        <ol>
                            <li class="text-success">Mengisi Formulir Pendaftaran <i class="fa fa-check"></i></li>
                            <li>Fotocopy Akte kelahiran dan kartu keluarga 2 lembar</li>
                            <li>Foto anak dan foto keluarga ukuran 2R</li>
                        </ol>
                        <p class="text-muted"><i><b>*Catatan: Pengembalian Formulir berikut persyaratannya paling lambat 2 minggu setelah pengisian formulir secara online.</b></i></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="title">Data Pendaftar</h4>
                        <p class="category">Periksa data Anda di bawah, pastikan sudah benar</p>
                    </div>
                    <div class="card-body table-responsive">
                        <a href="daftar_siswa_baru.php" class="btn btn-primary float-right mb-3"><i class="fas fa-edit"></i> Edit Data</a>
                        <h3><b>Data Calon Siswa</b></h3>
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td><b>Email</b></td>
                                    <td>: <?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?> <a href="daftar_akun.php" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a></td>
                                </tr>
                                <tr>
                                    <td><b>Nama</b></td>
                                    <td>: <?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Nama Panggilan</b></td>
                                    <td>: <?php echo isset($_SESSION['nick_name']) ? $_SESSION['nick_name'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td><b>TTL</b></td>
                                    <td>: <?php echo isset($_SESSION['birth_place']) ? $_SESSION['birth_place'] : ''; ?>, <?php echo isset($_SESSION['birth_date']) ? $_SESSION['birth_date'] : '2009-01-01'; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Jenis Kelamin</b></td>
                                    <td>: <?php echo isset($_SESSION['gender']) && $_SESSION['gender'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Anak Ke-</b></td>
                                    <td>: <?php echo isset($_SESSION['child_number']) ? $_SESSION['child_number'] : ''; ?> dari <?php echo isset($_SESSION['child_total']) ? $_SESSION['child_total'] : ''; ?> bersaudara</td>
                                </tr>
                                <tr>
                                    <td><b>Di Kudus ikut</b></td>
                                    <td>: <?php echo isset($_SESSION['in_kudus_follow']) ? $_SESSION['in_kudus_follow'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Jenjang Pendidikan</b></td>
                                    <td>: <?php echo isset($_SESSION['last_education']) ? $_SESSION['last_education'] : ''; ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <br>
                        <a href="daftar_data_orangtua.php" class="btn btn-primary float-right mt-1 mb-3"><i class="fas fa-edit"></i> Edit Data</a>
                        <h3><b>Data Orang Tua</b></h3>
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td><b>Nama Ayah</b></td>
                                    <td>: <?php echo isset($_SESSION['father_name']) ? $_SESSION['father_name'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td><b>TTL</b></td>
                                    <td>: <?php echo isset($_SESSION['birth_place_father']) ? $_SESSION['birth_place_father'] : ''; ?>, <?php echo isset($_SESSION['birth_date_father']) ? $_SESSION['birth_date_father'] : '1980-01-01'; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Pendidikan Terakhir</b></td>
                                    <td>: <?php echo isset($_SESSION['father_last_education']) ? $_SESSION['father_last_education'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Pekerjaan</b></td>
                                    <td>: <?php echo isset($_SESSION['father_job']) ? $_SESSION['father_job'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Agama</b></td>
                                    <td>: <?php echo isset($_SESSION['father_religion']) ? $_SESSION['father_religion'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Nama Ibu</b></td>
                                    <td>: <?php echo isset($_SESSION['mother_name']) ? $_SESSION['mother_name'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td><b>TTL</b></td>
                                    <td>: <?php echo isset($_SESSION['birth_place_mother']) ? $_SESSION['birth_place_mother'] : ''; ?>, <?php echo isset($_SESSION['birth_date_mother']) ? $_SESSION['birth_date_mother'] : '1980-01-01'; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Pendidikan Terakhir</b></td>
                                    <td>: <?php echo isset($_SESSION['mother_last_education']) ? $_SESSION['mother_last_education'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Pekerjaan</b></td>
                                    <td>: <?php echo isset($_SESSION['mother_job']) ? $_SESSION['mother_job'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Agama</b></td>
                                    <td>: <?php echo isset($_SESSION['mother_religion']) ? $_SESSION['mother_religion'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Telp/HP</b></td>
                                    <td>: <?php echo isset($_SESSION['telp']) ? $_SESSION['telp'] : ''; ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <hr>
                        <h3>Apakah Anda yakin data di atas sudah benar?</h3>
                        <a href="proses_simpan_pendaftaran.php" class="btn btn-primary float-right">Ya, kirim data pendaftaran</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
