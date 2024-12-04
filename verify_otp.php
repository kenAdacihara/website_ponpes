<?php
session_start();

// Pastikan halaman ini hanya bisa diakses setelah registrasi dan OTP dikirim
if (!isset($_SESSION['otp'])) {
    header('Location: register.php'); // Jika OTP tidak ada di session, arahkan kembali ke halaman register
    exit;
}

if (isset($_POST['submit'])) {
    $input_otp = $_POST['otp'];

    // Cek apakah OTP yang dimasukkan sesuai dengan yang ada di session
    if ($input_otp == $_SESSION['otp']) {
        // OTP valid
        unset($_SESSION['otp']); // Hapus OTP dari session setelah verifikasi berhasil
        $_SESSION['otp_verified'] = true; // Tandai bahwa OTP telah diverifikasi
        header('Location: daftar_siswa_baru.php'); // Arahkan ke halaman pendaftaran data siswa
    } else {
        $error_message = "OTP yang dimasukkan salah. Silakan coba lagi."; // Pesan error jika OTP salah
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-5">Verifikasi OTP</h1>
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <!-- Form untuk memasukkan OTP -->
                <form method="POST">
                    <div class="mb-3">
                        <label for="otp" class="form-label">Masukkan OTP yang telah dikirim ke email Anda:</label>
                        <input type="text" name="otp" class="form-control" placeholder="Masukkan OTP" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Verifikasi</button>
                </form>

                <!-- Menampilkan pesan error jika OTP salah -->
                <?php if (isset($error_message)) { ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Import JS Bootstrap -->
    <script type="text/javascript" src="styles/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
