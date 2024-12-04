<style>
  /* Start Screen  */
  .container {
    position: relative;
    width: 100%;
    max-width: 600px;
    background: #283554;
    padding: 35px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    margin: 30px auto;
    animation: fadeIn 0.8s ease-out;
    border: 1px solid #e8eeff;
    }
  .heading {
    text-align: center;
    font-size: 28px;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 25px;
    line-height: 1.4;
  }
  .heading span {
    color: #4f46e5;
  }
  .info-card {
    background: #e6e6fa;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 24px;
    margin-bottom: 25px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  }
  .info {
    font-size: 16px;
    line-height: 1.8;
    color: #4a5568;
    text-align: left;
    margin-bottom: 20px;
  }
  .key-points {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    margin: 25px 0;
  }
  .point-card {
    flex: 1;
    background: #ffffff;
    padding: 15px;
    border-radius: 12px;
    text-align: center;
    border: 1px solid #e2e8f0;
  }
  .point-card .angka {
    font-size: 24px;
    font-weight: 600;
    color: #4f46e5;
    margin-bottom: 8px;
  }
  .point-card .label {
    font-size: 14px;
    color: #64748b;
  }
  .reminder {
    font-size: 15px;
    color: #4a5568;
    background: #e6e6fa;
    padding: 20px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    margin: 25px 0;
    text-align: center;
  }
  .reminder i {
    color: #4f46e5;
    font-style: normal;
  }
  .btn {
    display: block;
    width: 100%;
    background: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    text-align: center;
    transition: background-color 0.3s ease;
  }
  .btn:hover {
    background: #00ffff;
  }
  label {
    display: block;
    font-size: 12px;
    margin-bottom: 10px;
    color: #fff;
  }
  select {
    width: 100%;
    padding: 10px;
    border: none;
    text-transform: capitalize;
    border-radius: 5px;
    margin-bottom: 20px;
    background: #fff;
    color: #1f2847;
    font-size: 14px;
  }
  .start-screen .btn {
    margin-top: 50px;
  }
  .hide {
    display: none;
  }

  /* Quiz Screen */
  .timer {
    width: 100%;
    height: 80px; /* Tinggi lebih rendah */
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    margin-bottom: 20px; /* Jarak lebih kecil */
  }
  .timer .progress {
    position: relative;
    width: 100%;
    height: 30px; /* Tinggi lebih kecil */
    background: transparent;
    border-radius: 20px; /* Border lebih kecil */
    overflow: hidden;
    margin-bottom: 10px; /* Jarak lebih kecil */
    border: 2px solid #3f4868; /* Border lebih tipis */
  }
  .timer .progress .progress-bar {
    width: 100%;
    height: 100%;
    border-radius: 20px; /* Menyesuaikan tinggi */
    background: linear-gradient(to right, #ea517c, #b478f1);
    transition: 1s linear;
  }
  .timer .progress .progress-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #fff;
    font-size: 14px; /* Ukuran font lebih kecil */
    font-weight: 500;
  }
  .question-wrapper .number {
    color: #a2aace;
    font-size: 20px; /* Ukuran font lebih kecil */
    font-weight: 500;
    margin-bottom: 15px; /* Jarak lebih kecil */
  }
  .question-wrapper .number .total {
    color: #576081;
    font-size: 16px; /* Ukuran font lebih kecil */
  }
  .question-wrapper .question {
    color: #fff;
    font-size: 16px; /* Ukuran font lebih kecil */
    font-weight: 400; /* Font lebih ringan */
    margin-bottom: 15px; /* Jarak lebih kecil */
  }
  .answer-wrapper .answer {
    width: 100%;
    height: 50px; /* Tinggi lebih kecil */
    padding: 10px; /* Padding lebih kecil */
    border-radius: 8px; /* Border lebih kecil */
    color: #fff;
    border: 2px solid #3f4868; /* Border lebih tipis */
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px; /* Jarak antar jawaban lebih kecil */
    cursor: pointer;
    transition: 0.3s linear;
  }
  .answer .checkbox {
    width: 16px; /* Lebih kecil */
    height: 16px; /* Lebih kecil */
    border-radius: 50%;
    border: 2px solid #3f4868; /* Border lebih tipis */
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
  }
  .answer .checkbox i {
    color: #fff;
    font-size: 8px; /* Font lebih kecil */
    opacity: 0;
    transition: all 0.3s;
  }
  .answer:hover:not(.checked) .checkbox,
  .answer.selected .checkbox {
    background-color: #0c80ef;
    border-color: #0c80ef;
  }
  .answer.selected .checkbox i {
    opacity: 1;
  }
  .answer.correct {
    border-color: #0cef2a;
  }
  .answer.wrong {
    border-color: #fc3939;
  }
  .question-wrapper,
  .answer-wrapper {
    margin-bottom: 20px;
  }
  .btn.submit, .btn.next {
    margin: 10px 0; /* Jarak antar tombol lebih kecil */
    padding: 8px 16px; /* Ukuran tombol lebih kecil */
    font-size: 14px; /* Ukuran font lebih kecil */
  }

  /* End Screen */
  .end-screen .score {
    color: #fff;
    font-size: 25px;
    font-weight: 500;
    margin-bottom: 80px;
    text-align: center;
  }
  .score .score-text {
    color: #a2aace;
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 120px;
  }

  /* bagian alert */
  .alert {
    position: relative;
    width: 100%;
    max-width: 600px;
    margin: 0 auto 20px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }
  .alert-info {
    background-color: #f8f9fa;
    border: 2px solid #17a2b8;
  }
  .alert h5 {
    color: #0c5460;
    margin-bottom: 10px;
  }
  .alert .text-success {
    color: #28a745;
  }
  .alert .text-danger {
    color: #dc3545;
  }
  .btn-success {
    background-color: #28a745;
    color: white;
    padding: 8px 16px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s;
  }
  .btn-success:hover {
    background-color: #218838;
    text-decoration: none;
    color: white;
  }

  @media (max-width: 468px) {
    .container-quiz {
      min-height: 100vh;
      max-width: 100%;
      border-radius: 0;
    }
  }
</style>

<?php
  // Tambahkan di awal quiz.php untuk mengecek hasil quiz sebelumnya
  $id_user = $_SESSION['auth'];
  $query = "SELECT hasil_quiz FROM pendaftaran WHERE id = $id_user";
  $result = mysqli_query($conn, $query);
  $data = mysqli_fetch_assoc($result);
  $hasil_quiz = $data['hasil_quiz'];
?>

<h3 class="text-center text-primary mt-3">Selamat Datang di Halaman Quiz</h3><br><br>

<!-- Modifikasi tampilan riwayat quiz -->
<?php if($hasil_quiz !== NULL): ?>
  <div class="alert alert-info text-center mb-4">
    <h5>Riwayat Quiz Terakhir</h5>
    <p>Skor yang Anda dapatkan: <strong><?= $hasil_quiz ?>%</strong></p>
    <?php if($hasil_quiz >= 80): ?> <!-- Ubah dari 8 menjadi 80 -->
      <div class="text-success">
        <i class="fas fa-check-circle"></i> Anda telah lulus quiz!
        <br>
        <a href="index.php?page=14" class="btn btn-success btn-sm mt-2">
          <i class="fas fa-money-bill"></i> Lanjut ke Pembayaran
        </a>
      </div>
    <?php else: ?>
      <div class="text-danger">
        <i class="fas fa-times-circle"></i> Anda belum lulus quiz. Silakan coba lagi!
      </div>
    <?php endif; ?>
  </div>
<?php endif; ?>

<div class="container">
  <!-- Start Screen -->
  <div class="start-screen">
    <h1 class="heading">
      <span class="icon">📚 Keterangan Quiz</span>
    </h1>
    <div class="info-card">
      <p class="info">
        Untuk memastikan Anda memahami materi dengan baik sebelum melanjutkan ke proses pembayaran, 
        kami telah menyiapkan serangkaian pertanyaan yang akan menguji pemahaman Anda.
      </p>
    </div>
    <div class="key-points">
      <div class="point-card">
        <div class="angka">10</div>
        <div class="label">Soal Pilihan Ganda</div>
      </div>
      <div class="point-card">
        <div class="angka">80%</div>
        <div class="label">Nilai Minimal</div>
      </div>
      <div class="point-card">
        <div class="angka">✨</div>
        <div class="label">Kesempatan Unlimited</div>
      </div>
    </div>
    <div class="reminder">
      <p>
        <i>💡 Tips:</i> Bacalah setiap pertanyaan dengan cermat dan pilih jawaban terbaik. 
        Fokus pada pemahaman konsep dasar dan aplikasinya.
      </p>
    </div>
    <button class="btn start">Mulai Quiz</button>
  </div>

  <!-- Quiz Screen -->
  <div class="quiz hide">
    <div class="timer">
      <div class="progress">
        <div class="progress-bar"></div>
        <span class="progress-text"></span>
      </div>
    </div>
    <div class="question-wrapper">
      <div class="number">
        Question <span class="current">1</span>
        <span class="total">/10</span>
      </div>
      <div class="question">This is a question?</div>
    </div>
    <div class="answer-wrapper"></div>
    <button class="btn submit" disabled>Submit</button>
    <button class="btn next hide">Next</button>
  </div>

  <!-- End Screen -->
  <div class="end-screen hide">
    <h1 class="heading">
      <span class="icon">📚 Quiz Selesai!</span>
    </h1>
    <div class="score">
      <span class="score-text">Skor Anda:</span>
      <div>
        <span class="final-score">0</span>
        <span class="total-score">/10</span>
      </div>
    </div>
    <p class="result-message text-center"></p> <!-- Tambahan untuk keterangan -->
    <button class="btn restart">Coba Lagi</button>
  </div>
</div>

<script>
  const progressBar = document.querySelector(".progress-bar"),
  progressText = document.querySelector(".progress-text");

  const progress = (value) => {
    const percentage = (value / time) * 100;
    progressBar.style.width = `${percentage}%`;
    progressText.innerHTML = `${value}`;
  };

  const startBtn = document.querySelector(".start"),
    quiz = document.querySelector(".quiz"),
    startScreen = document.querySelector(".start-screen");

  // Ganti dengan fungsi fetch untuk mengambil soal dari database
  let questions = [];

  const fetchQuestions = async () => {
    try {
      // Sesuaikan path ke get_questions.php
      const response = await fetch('quiz/get_questions.php');
      const data = await response.json();
        
      // Cek jika ada error
      if(data.error) {
        throw new Error(data.error);
      }
        
      questions = data;
      if(questions.length === 0) {
        throw new Error('Tidak ada soal tersedia');
      }
        
      startQuiz();
    } catch (error) {
      console.error('Error:', error);
      alert('Gagal mengambil soal dari database: ' + error.message);
      // Kembalikan ke layar awal
      startScreen.classList.remove("hide");
      quiz.classList.add("hide");
    }
  };

  let time = 30,
    score = 0,
    currentQuestion,
    timer;

  const startQuiz = () => {
    if(questions.length === 0) {
      alert('Tidak ada soal tersedia');
      return;
    }
    startScreen.classList.add("hide");
    quiz.classList.remove("hide");
    currentQuestion = 1;
    showQuestion(questions[0]);
  };

  // Modifikasi event listener tombol start
  startBtn.addEventListener("click", () => {
    startScreen.classList.add("hide");
    quiz.classList.remove("hide");
    fetchQuestions(); // Panggil fungsi fetch questions
  });

  const showQuestion = (question) => {
    if(!question) {
      alert('Tidak ada soal tersedia');
      return;
    }
    
    const questionText = document.querySelector(".question"),
      answersWrapper = document.querySelector(".answer-wrapper");
    const questionNumber = document.querySelector(".number");

    questionText.innerHTML = question.question;

    const answers = [
      ...question.incorrect_answers,
      question.correct_answer
    ];

    answersWrapper.innerHTML = "";
    answers.sort(() => Math.random() - 0.5);
    answers.forEach((answer) => {
      answersWrapper.innerHTML += `
        <div class="answer">
          <span class="text">${answer}</span>
          <span class="checkbox">
            <i class="fas fa-check"></i>
          </span>
        </div>
      `;
    });

    questionNumber.innerHTML = ` Question <span class="current">${
      questions.indexOf(question) + 1
    }</span><span class="total">/${questions.length}</span>`;

    const answersDiv = document.querySelectorAll(".answer");
    answersDiv.forEach((answer) => {
      answer.addEventListener("click", () => {
        if (!answer.classList.contains("checked")) {
          answersDiv.forEach((answer) => {
            answer.classList.remove("selected");
          });
          answer.classList.add("selected");
          submitBtn.disabled = false;
        }
      });
    });

    time = 30;
    startTimer(time);
  };

  const startTimer = (time) => {
    timer = setInterval(() => {
      if (time >= 0) {
        progress(time);
        time--;
      } else {
        checkAnswer();
      }
    }, 1000);
  };

  const submitBtn = document.querySelector(".submit"),
    nextBtn = document.querySelector(".next");

  submitBtn.addEventListener("click", () => {
    checkAnswer();
  });

  nextBtn.addEventListener("click", () => {
    nextQuestion();
    submitBtn.style.display = "block";
    nextBtn.style.display = "none";
  });

  const checkAnswer = () => {
    clearInterval(timer);
    const selectedAnswer = document.querySelector(".answer.selected");
    if (selectedAnswer) {
      const answer = selectedAnswer.querySelector(".text").innerHTML;
      if (answer === questions[currentQuestion - 1].correct_answer) {
        score++;
        selectedAnswer.classList.add("correct");
      } else {
        selectedAnswer.classList.add("wrong");
        document.querySelectorAll(".answer").forEach((answer) => {
          if (
            answer.querySelector(".text").innerHTML ===
            questions[currentQuestion - 1].correct_answer
          ) {
            answer.classList.add("correct");
          }
        });
      }
    }

    document.querySelectorAll(".answer").forEach((answer) => {
      answer.classList.add("checked");
    });

    submitBtn.style.display = "none";
    nextBtn.style.display = "block";
  };

  const nextQuestion = () => {
    if (currentQuestion < questions.length) {
      currentQuestion++;
      showQuestion(questions[currentQuestion - 1]);
    } else {
      showScore();
    }
  };

  const endScreen = document.querySelector(".end-screen"),
    finalScore = document.querySelector(".final-score"),
    totalScore = document.querySelector(".total-score");

  document.addEventListener('DOMContentLoaded', async () => {
    const startScreen = document.querySelector(".start-screen");
    const hasilQuiz = <?php echo $hasil_quiz !== NULL ? $hasil_quiz : 'null' ?>;
    
    if (hasilQuiz !== null && hasilQuiz >= 80) { // Ubah dari 8 menjadi 80
        startScreen.classList.add('hide');
    }
  });

  // Modifikasi fungsi showScore
  const showScore = async () => {
    const scorePercentage = score * 10; // Mengubah score menjadi persentase
    
    endScreen.classList.remove("hide");
    quiz.classList.add("hide");
    finalScore.innerHTML = scorePercentage;
    totalScore.innerHTML = "%"; // Ubah format tampilan total score

    try {
      const response = await fetch('quiz/save_result.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `score=${scorePercentage}` // Kirim score dalam bentuk persentase
      });

      const data = await response.json();
        
      if (data.error) {
        throw new Error(data.error);
      }

      const resultMessage = document.querySelector(".result-message");
        if (scorePercentage >= 80) { // Ubah dari 8 menjadi 80
          resultMessage.innerHTML = "🎉 Selamat Anda lulus tes! Silahkan lakukan pembayaran.";
          resultMessage.style.color = "#0cef2a";
            
          // Reload halaman setelah 2 detik untuk menampilkan hasil quiz
          setTimeout(() => {
              window.location.reload();
          }, 2000);
      } else {
        resultMessage.innerHTML = "❌ Maaf, Anda belum lulus tes. Silahkan ulangi lagi.";
        resultMessage.style.color = "#fc3939";
      }

    } catch (error) {
        console.error('Error saving quiz result:', error);
        alert('Gagal menyimpan hasil quiz: ' + error.message);
    }
  };

  const restartBtn = document.querySelector(".restart");
  restartBtn.addEventListener("click", () => {
    window.location.reload();
  });
</script>