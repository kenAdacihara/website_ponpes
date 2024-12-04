<?php  
    session_start();
    include 'koneksi/koneksi.php';

    if (isset($_POST['submit'])) { 
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Retrieve password, role, and account ID
        $query = "SELECT a.password, a.role_user as role, COALESCE(b.id, a.id) as id_akun_daftar 
                  FROM akun a 
                  LEFT JOIN pendaftaran b ON b.id = a.id_user 
                  WHERE email='$email'";
        $exec  = mysqli_query($conn, $query);

        if ($exec && mysqli_num_rows($exec) > 0) {
            $rows = mysqli_fetch_assoc($exec);

            if (password_verify($password, $rows['password'])) {
                $_SESSION['role_user'] = $rows['role'];
                $_SESSION['auth'] = $rows['id_akun_daftar'];

                // Redirect based on role
                if ($rows['role'] == 0) {
                    echo '<script> window.location="dashboard/index.php?role=admin"; </script>';
                } else {
                    echo '<script> window.location="dashboard/index.php?role=user"; </script>';
                }
            } else {
                echo 'Password Salah!';
            }
        } else {
            echo 'Tidak ada user terdaftar';
        }
    }
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <style>
        .login-image {
        background-image: url(images/login.svg);
        background-size: 100%;
        background-position: center;
        background-repeat: no-repeat;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="row justify-content-center p-5">
                <!-- Bagian kiri halaman login (bisa diisi dengan gambar atau teks) -->
                <div class="col-md-6 d-none d-md-block login-image p-5"></div>
                <div class="col-md-6 p-5">
                    <!-- Form login -->
                    <form method="post" action="" class="user">
                        <h1 class="text-center mb-5">Halaman Login</h1>
                        <div class="mb-3">
                            <input type="text" class="form-control form-control-user" name="email" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                        </div>
                        <div class="mb-3 text-center d-grid gap-md-2 mx-auto">
                            <button type="submit" class="btn btn-dark btn-user" name="submit">Log In</button>
                        </div>
                        <hr/>
                        <!-- Link untuk registrasi jika pengguna belum punya akun -->
                        <p class=" text-center ">Belum punya akun? <a class="text-decoration-none" href="register.php">Register</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="container-fluid mt-4">
        <p class="text-center text-secondary">
            Penerimaan Siswa Baru Online | PSB Online
        </p>
    </div>

</body>
</html>