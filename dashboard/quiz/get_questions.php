<?php
    // Start session jika belum dimulai
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Cek apakah user sudah login dan memiliki role_user
    if (!isset($_SESSION['auth']) || !isset($_SESSION['role_user'])) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Unauthorized access'));
        exit;
    }

    try {
        // Include koneksi jika belum tersedia
        if(!isset($conn)) {
            include '../../koneksi/koneksi.php';
        }
        
        // Query untuk mengambil 10 soal random
        $query = "SELECT * FROM soal_quiz ORDER BY RAND() LIMIT 10";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            throw new Exception(mysqli_error($conn));
        }

        $questions = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $question = array(
                'question' => $row['pertanyaan'],
                'correct_answer' => $row['jawaban_benar'],
                'incorrect_answers' => array(
                    $row['jawaban_salah1'],
                    $row['jawaban_salah2'],
                    $row['jawaban_salah3']
                )
            );
            array_push($questions, $question);
        }

        // Return dalam format JSON
        header('Content-Type: application/json');
        echo json_encode($questions);

    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => $e->getMessage()));
    }
?>