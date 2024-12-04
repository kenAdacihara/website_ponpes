<?php  
    session_start();  // Memulai atau melanjutkan sesi yang sudah ada.
    session_destroy();  // Menghancurkan semua data sesi. Ini akan mengakhiri sesi pengguna, menghapus semua variabel sesi yang disimpan.
    // Menggunakan JavaScript untuk mengarahkan pengguna ke halaman login setelah sesi dihancurkan.
    echo '<script>window.location = "login.php"</script>';  
?>
