<?php
// Start the session
session_start();
include 'koneksi/koneksi.php';

// Check if student data exists in the session
$redirect = isset($_SESSION['is_data_student_exist']) 
    ? "<script>window.location='daftar_syarat.php';</script>" 
    : "<script>window.location='daftar_siswa_baru.php';</script>";

// Handle form submission
if (isset($_POST['submit'])) {
    // Store form data in session variables
    foreach ($_POST as $key => $val) {
        ${$key} = $val;
        $_SESSION[$key] = $val;
    }

    // Check if the email is already registered
    $query = "SELECT email FROM akun WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $email_count = mysqli_num_rows($result);
        if ($email_count > 0) {
            echo '<script>alert("Email sudah digunakan, silahkan gunakan email lain.");</script>';
        } else {
            $cost = 10;
            $hash = password_hash($password, PASSWORD_BCRYPT, ["cost" => $cost]);
            $_SESSION['password'] = $hash;

            // Redirect to the appropriate page if session data is present
            if (!empty($_SESSION)) {
                echo $redirect;
                print_r($_SESSION);
            }
        }
    } else {
        echo mysqli_error($conn);
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
            <div class="col-lg-8">
                <div class="card mt-5">
                    <div class="card-header bg-primary text-white">
                        <h4 class="title">Data Akun Pengguna</h4>
                        <p class="category">Isi formulir pendaftaran akun dengan benar. Akun ini akan digunakan untuk login.</p>
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="email" class="control-label">Email</label>
                                <input type="email" id="email" class="form-control" name="email" required autofocus
                                    value="<?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <input type="password" id="password" class="form-control" name="password" required
                                    value="<?= isset($_SESSION['password']) ? htmlspecialchars($_SESSION['password']) : ''; ?>">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary float-right">
                                <?= isset($_SESSION['is_data_student_exist']) ? 'Kembali' : 'Lanjut'; ?> 
                                <i class="fa fa-arrow-right ml-2"></i>
                            </button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>