<?php
// Start session  
session_start();

// Import connection to database and email notification function
include "koneksi/koneksi.php";
include "notif-2.php"; // Memastikan PHPMailer tersedia

// Check if $_SESSION is set
if (isset($_SESSION)) {
    foreach ($_SESSION as $key => $val) {
        ${$key} = $val;
    }

    // Insert to 'pendaftaran' table
    $sql = "INSERT INTO pendaftaran VALUES(null, '$full_name', '$nick_name', '$birth_place', 
            '$birth_date', '$gender', '$child_number', '$child_total', '$in_kudus_follow', '$last_education',
            '$father_name', '$birth_place_father', '$birth_date_father', '$father_last_education',
            '$father_job', '$father_religion', '$mother_name', '$birth_place_mother', '$birth_date_mother',
            '$mother_last_education', '$mother_job', '$mother_religion', '$telp','','','','','','','')";

    $exec = mysqli_query($conn, $sql);

    if ($exec) {
        $id = $conn->insert_id;

        // Check if email already exists
        $check_email_query = "SELECT * FROM akun WHERE email = '$email'";
        $result = mysqli_query($conn, $check_email_query);

        if (mysqli_num_rows($result) > 0) {
            // If email exists, update the existing record
            $update_query = "UPDATE akun SET password = '$password', id_user = $id, role_user = 1, status = 'verified' WHERE email = '$email'";
            $exec_update = mysqli_query($conn, $update_query);

            if (!$exec_update) {
                echo "Failed to update account: " . mysqli_error($conn);
                exit;
            }
        } else {
            // If email does not exist, insert a new record
            $query = "INSERT INTO akun (email, password, nama_admin, role_user, id_user, status) VALUES ('$email', '$password', '', 1, $id, 'verified')";
            $exec_akun = mysqli_query($conn, $query);

            if (!$exec_akun) {
                echo "Failed to insert account: " . mysqli_error($conn);
                exit;
            }
        }

        // Tidak lagi memasukkan data ke tabel 'detail_pendaftaran' karena tabelnya dihapus

        // Send confirmation email
        if (sendRegistrationNotification($email)) {
            // Jika pengiriman email berhasil, redirect ke halaman sukses
            session_destroy();
            echo '<script> window.location="success_register.php"; </script>';
        } else {
            echo "Failed to send notification email.";
        }

    } else {
        echo "Failed to insert registration: " . mysqli_error($conn);
    }
}
?>