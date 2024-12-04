<?php 
	session_start();
	include '../../koneksi/koneksi.php';

	// Memastikan parameter 'idd' dan 'idu' ada dalam URL
	if (isset($_GET['idd']) && isset($_GET['idu'])) {
		$id_daftar 	= $_GET['idd'];  // ID pendaftaran
		$id_admin  	= $_GET['idu'];  // ID admin yang mengonfirmasi

		// Query untuk mendapatkan tanggal lahir dan jenjang pendidikan siswa
		$query 		= "SELECT tanggal_lahir, jenjang_pendidikan FROM pendaftaran WHERE id = $id_daftar";
		$exec2		= mysqli_query($conn, $query); 

		if ($exec2 && mysqli_num_rows($exec2) > 0) {
			$data 				= mysqli_fetch_array($exec2);
			$jenjang_pendidikan = $data['jenjang_pendidikan'];
			$age 				= getAge($data['tanggal_lahir']); // Menghitung umur siswa

			// Menentukan biaya berdasarkan jenjang pendidikan
			if ($jenjang_pendidikan == 'M') {  
				$biaya = 5165000; // Biaya untuk MTS
			} elseif ($jenjang_pendidikan == 'A') {  
				$biaya = 5190000; // Biaya untuk MA
			} else {
				$biaya = 0; // Biaya default jika jenjang pendidikan tidak ditemukan
			}

		} else {
			// Jika query gagal atau data tidak ditemukan
			echo "Error: " . mysqli_error($conn);
			exit; // Keluar dari eksekusi jika terjadi kesalahan
		}

		// Melakukan update status pembayaran dan menyimpan informasi tambahan
		$query_update = "
			UPDATE detail_pendaftaran 
			SET status_pembayaran_pendaftaran = 1, 
				id_admin = $id_admin, 
				biaya_kegiatan = '$biaya', 
				usia = '$age' 
			WHERE id_user = $id_daftar";
		$exec_update = mysqli_query($conn, $query_update);

		if ($exec_update) {
			$_SESSION['message'] = "1"; // Menyimpan pesan sukses ke dalam session
			// Redirect ke halaman konfirmasi
			echo '<script>window.location="../index.php?page=18"</script>';
		} else {
			echo "Error: " . mysqli_error($conn); // Menampilkan pesan error jika update gagal
		}
	} else {
		// Jika 'idd' atau 'idu' tidak ada dalam URL
		echo 'Data tidak ditemukan atau parameter tidak lengkap.';
	}

	// Fungsi untuk menghitung umur berdasarkan tanggal lahir
	function getAge($dob) {
		$dob = strtotime($dob); // Mengubah format tanggal lahir menjadi timestamp
		$current_time = time(); // Mendapatkan waktu saat ini

		// Menghitung umur dalam tahun, bulan, dan hari
		$age_years  = date('Y', $current_time) - date('Y', $dob);
		$age_months = date('m', $current_time) - date('m', $dob);
		$age_days   = date('d', $current_time) - date('d', $dob);

		// Penyesuaian jika jumlah hari negatif
		if ($age_days < 0) {
			$days_in_month = date('t', $current_time);
			$age_months--;
			$age_days = $days_in_month + $age_days;
		}

		// Penyesuaian jika jumlah bulan negatif
		if ($age_months < 0) {
			$age_years--;
			$age_months = 12 + $age_months;
		}

		// Mengembalikan umur dalam format "x tahun y bulan"
		return $age_years . " tahun " . $age_months . " bulan";
	}
?>
