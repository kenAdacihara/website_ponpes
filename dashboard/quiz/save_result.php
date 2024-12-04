<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['auth'])) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Unauthorized access']);
        exit;
    }

    if (!isset($_POST['score'])) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Score not provided']);
        exit;
    }

    try {
        if(!isset($conn)) {
            include '../../koneksi/koneksi.php';
        }
        
        $id_user = $_SESSION['auth'];
        $score = $_POST['score']; // Score sudah dalam bentuk persentase
        
        // Update kolom hasil_quiz di tabel pendaftaran
        $query = "UPDATE pendaftaran SET hasil_quiz = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ii", $score, $id_user);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            throw new Exception(mysqli_error($conn));
        }

    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(['error' => $e->getMessage()]);
    }
?>