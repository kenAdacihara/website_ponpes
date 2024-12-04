<?php
    session_start();
    include 'koneksi/koneksi.php';
    include 'email.php'; // Pastikan PHPMailer sudah terinstall

    if (isset($_POST['submit'])) {
        foreach ($_POST as $key => $val) {
            ${$key} = $val;
            $_SESSION[''.$key.''] = $val;
        }

        // Cek apakah email sudah terdaftar
        $query  = "SELECT email FROM akun WHERE email='$email'";
        $exac   = mysqli_query($conn, $query);

        if ($exac) {
            $email_count = mysqli_num_rows($exac);
            if ($email_count > 0) {
                echo '<script>alert("Email sudah digunakan, silahkan gunakan email lain..")</script>';
            } else {
                $cost = 10;
                $hash = password_hash($password, PASSWORD_BCRYPT, ["cost" => $cost]);
                $_SESSION['password'] = $hash;

                // Generate OTP
                $otp = rand(10000, 99999);
                send_otp($email, "Verifikasi OTP", $otp);  // Kirim OTP ke email

                // Simpan OTP ke session dan database
                $_SESSION['otp'] = $otp;

                // Update status akun untuk menunggu verifikasi
                $query = "INSERT INTO akun (email, password, status) VALUES ('$email', '$hash', 'pending')";
                mysqli_query($conn, $query);

                // Redirect ke halaman verifikasi OTP
                header("location: verify_otp.php");
            }
        } else {
            echo mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- title -->
    <title>Halaman Registrasi</title>

    <!-- Css Bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">

    <style>
        .register-image {
        background-image: url(images/register.svg);
        background-size: 100%;
        background-position: center;
        background-repeat: no-repeat;
    }
    </style>
</head>

<body>

<!-- container -->
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="row justify-content-center p-5">
                <div class="col-md-6 d-none d-md-block register-image"></div>
                <div class="col-md-6 p-5">
                    <form class="user" method="post" action="">
                        <h1 class="text-center mb-5">Daftar Akun</h1>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email" required autofocus
                                value="<?php isset($_SESSION['email'])  ?  print($_SESSION['email']) : ""; ?>">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required
                                value="<?php isset($_SESSION['password'])  ?  print($_SESSION['password']) : ""; ?>">
                        </div>
                        <div class="mb-3 text-center d-grid gap-md-2 mx-auto">
                            <?php if (isset($_SESSION['is_data_student_exist'])) { ?>
                                    <button type="submit" name="submit" class="btn btn-primary pull-right">Kembali <i class="fa fa-arrow-right"></i></button>
                            <?php }else{ ?>
                                    <button type="submit" name="submit" class="btn btn-primary pull-right">Register <i class="fa fa-arrow-right"></i></button>
                            <?php } ?>
                        </div>
                        <hr>

                        <!-- login -->
                        <p class=" text-center ">Sudah punya akun? <a class="text-decoration-none" href="login.php">Login</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<!-- Footer container -->
<div class="container-fluid mt-4">

<!-- Footer text -->
<p class="text-center text-secondary">
    Penerimaan Siswa Baru Online | PSB Online
</p>
</div>

<!-- fontawesome -->
<script src="https://kit.fontawesome.com/c48877bd36.js" crossorigin="anonymous"></script>

<!-- import jQuery -->
<script type="text/javascript" src="styles/jquery/jquery.min.js"></script>

<!-- import Js Bootstrap -->
<script type="text/javascript" src="styles/bootstrap/js/bootstrap.min.js"></script>

<!-- import DataTables -->
<script type="text/javascript" src="styles/DataTables/datatables.min.js"></script>

<!-- fungsi Setting DataTables -->
<script>
$(document).ready(function() {
    var table = $('#dataTable').DataTable( {
        responsive: true
    } );
} );
</script>
