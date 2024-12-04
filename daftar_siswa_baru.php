<?php
    // Start the session
    session_start();

    // Pastikan hanya pengguna yang sudah memverifikasi OTP yang bisa mengakses halaman ini
    if (!isset($_SESSION['otp_verified']) || !$_SESSION['otp_verified']) {
        header('Location: verify_otp.php'); // Arahkan ke halaman verifikasi OTP jika OTP belum diverifikasi
        exit;
    }

    $redirect = "";

    // Cek apakah session is_data_student_exist ada, jika ada, arahkan ke halaman daftar_syarat.php
    if (isset($_SESSION['is_data_student_exist'])) {
        $redirect = "<script> window.location='daftar_syarat.php'; </script>";
    } else {
        // Jika data siswa belum ada, arahkan ke halaman daftar_data_orangtua.php
        $redirect = "<script> window.location='daftar_data_orangtua.php'; </script>";
    }

    // Cek jika tombol submit sudah diklik
    if (isset($_POST['submit'])) {

        // Set semua nama atribut dan nilainya ke variabel dan simpan ke session
        foreach ($_POST as $key => $val) {
            ${$key} = $val;
            $_SESSION[$key] = $val;
        }

        // Cek apakah session tidak kosong, lalu arahkan ke halaman daftar_data_orangtua.php
        if (!empty($_SESSION)) {
            echo $redirect; // Arahkan sesuai kondisi session
            print_r($_SESSION); // Hanya untuk debugging, bisa dihapus setelah selesai
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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style3.css">
    
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="title">Data Calon Siswa</h4>
                        <p class="category">Isi Form pendaftaran dengan benar</p>
                    </div>
                    <div class="card-content p-4">
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="full_name" required autofocus
                                            value="<?php isset($_SESSION['full_name'])  ?  print($_SESSION['full_name']) : ""; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Nama Panggilan</label>
                                        <input type="text" class="form-control" name="nick_name" required
                                            value="<?php isset($_SESSION['nick_name'])  ?  print($_SESSION['nick_name']) : ""; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tempat lahir</label>
                                        <input type="text" class="form-control" name="birth_place" required
                                            value="<?php isset($_SESSION['birth_place'])  ?  print($_SESSION['birth_place']) : ""; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal lahir</label>
                                        <input type="date" class="form-control" name="birth_date" required 
                                            value="<?php isset($_SESSION['birth_date'])  ?  print($_SESSION['birth_date']) : print("2009-01-01"); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Jenis Kelamin</label>
                                        <select name="gender" class="form-control" required>
                                            <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                            <option value="L" <?php isset($_SESSION['gender']) && $_SESSION['gender'] == "L" ? print("selected") : "" ?>>Laki-laki</option>
                                            <option value="P" <?php isset($_SESSION['gender']) && $_SESSION['gender'] == "P" ? print("selected") : "" ?>>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Anak Ke-</label>
                                        <input type="number" class="form-control" name="child_number" required
                                            value="<?php isset($_SESSION['child_number'])  ?  print($_SESSION['child_number']) : ""; ?>">
                                    </div>                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Jumlah Saudara Kandung</label>
                                        <input type="number" class="form-control" name="child_total" required
                                            value="<?php isset($_SESSION['child_total'])  ?  print($_SESSION['child_total']) : ""; ?>">
                                    </div>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Di Kudus ikut</label>
                                        <input type="text" class="form-control" name="in_kudus_follow" required 
                                            value="<?php isset($_SESSION['in_kudus_follow'])  ?  print($_SESSION['in_kudus_follow']) : ""; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Pendidikan Terakhir</label>
                                        <input type="text" class="form-control" name="last_education" required 
                                            value="<?php isset($_SESSION['last_education'])  ?  print($_SESSION['last_education']) : ""; ?>">
                                    </div>
                                </div>
                            </div>
                            
                            <?php if (isset($_SESSION['is_data_student_exist'])) { ?>
                                <button type="submit" name="submit" class="btn btn-primary pull-right">Kembali <i class="fa fa-arrow-right"></i></button>
                            <?php } else { ?>
                                <button type="submit" name="submit" class="btn btn-primary pull-right">Lanjut <i class="fa fa-arrow-right"></i></button>
                            <?php } ?>

                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>