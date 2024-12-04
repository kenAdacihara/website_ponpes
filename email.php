<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php'; // Jika menggunakan Composer

    function send_otp($to_email, $subject, $otp) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Ganti dengan SMTP server yang Anda gunakan
            $mail->SMTPAuth = true;
            $mail->Username = 'ahmadwildanmusthofa596@gmail.com'; // Ganti dengan email Anda
            $mail->Password = 'jkkh pnqk ahxb giyu';   // Ganti dengan password email Anda
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('ahmadwildanmusthofa596@gmail.com', 'Kode OTP');
            $mail->addAddress($to_email);

            // Konten email OTP
            $mail->isHTML(true);
            $mail->Subject = $subject;
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
                            background-color: #FF9800;
                            color: white;
                            padding: 10px 0;
                            border-radius: 10px 10px 0 0;
                        }
                        .content {
                            padding: 20px;
                            font-size: 16px;
                            color: #333;
                        }
                        .otp-code {
                            display: inline-block;
                            font-size: 28px;
                            font-weight: bold;
                            padding: 15px;
                            background-color: #4CAF50;
                            color: white;
                            border-radius: 5px;
                            margin-top: 20px;
                            text-align: center;
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
                            <h2>Verifikasi Kode OTP Anda</h2>
                        </div>
                        <div class="content">
                            <p>Halo,</p>
                            <p>Untuk menyelesaikan proses verifikasi akun Anda, masukkan kode OTP berikut:</p>
                            <div class="otp-code">
                                <b>' . $otp . '</b>
                            </div>
                            <p>Kode OTP ini hanya berlaku selama 5 menit. Pastikan Anda memasukkan kode ini segera.</p>
                            <p>Jika Anda tidak merasa melakukan pendaftaran, abaikan email ini.</p>
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
        } catch (Exception $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>
