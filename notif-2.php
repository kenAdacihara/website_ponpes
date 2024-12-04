<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Mengimpor PHPMailer dari Composer

function sendRegistrationNotification($email) {
    $mail = new PHPMailer(true);

    try {
        // Aktifkan debugging PHPMailer
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;

        // Konfigurasi server email
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ahmadwildanmusthofa596@gmail.com';
        $mail->Password   = 'jkkh pnqk ahxb giyu'; // Ganti dengan app password jika menggunakan Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Pengaturan email pengirim dan penerima
        $mail->setFrom('ahmadwildanmusthofa596@gmail.com', 'Pondok Salafiyyah Al-Hidayah');
        $mail->addAddress($email);

        // Konten email
        $mail->isHTML(true);
        $mail->Subject = 'Pendaftaran Berhasil di Pondok Salafiyyah Al-Hidayah Kudus';
        $mail->Body    = '
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f9;
                        margin: 0;
                        padding: 0;
                    }
                    .container {
                        max-width: 600px;
                        margin: 20px auto;
                        background-color: #ffffff;
                        border-radius: 10px;
                        padding: 20px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    }
                    .header {
                        text-align: center;
                        background-color: #4CAF50;
                        color: white;
                        padding: 10px 0;
                        border-radius: 10px 10px 0 0;
                    }
                    .content {
                        padding: 20px;
                        font-size: 16px;
                        color: #333;
                    }
                    .btn {
                        display: inline-block;
                        padding: 10px 20px;
                        background-color: #4CAF50;
                        color: white;
                        text-decoration: none;
                        border-radius: 5px;
                        font-weight: bold;
                        margin-top: 20px;
                    }
                    .footer {
                        text-align: center;
                        font-size: 14px;
                        color: #777;
                        margin-top: 30px;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <h2>Selamat! Pendaftaran Anda Berhasil</h2>
                    </div>
                    <div class="content">
                        <p>Anda telah berhasil melakukan pendaftaran di <b>Pondok Salafiyyah Al-Hidayah Kudus</b>.</p>
                        <p>Untuk melengkapi persyaratan pendaftaran, silakan login dengan <b>email</b> dan <b>password</b> yang telah Anda buat.</p>
                        <p>Segera lakukan login untuk menyelesaikan proses pendaftaran Anda.</p>
                        <a href="http://link_login_sistem_anda.com" class="btn">Login Sekarang</a>
                    </div>
                    <div class="footer">
                        <p>Jika Anda membutuhkan bantuan, silakan hubungi kami di <a href="mailto:support@pondok.com">support@pondok.com</a></p>
                        <p>&copy; 2024 Pondok Salafiyyah Al-Hidayah Kudus. All rights reserved.</p>
                    </div>
                </div>
            </body>
            </html>
        ';

        $mail->send();
        return true; // Notifikasi berhasil dikirim
    } catch (Exception $e) {
        echo "Error: " . $mail->ErrorInfo; // Menampilkan pesan error PHPMailer
        return false; // Terjadi error saat pengiriman
    }
}
