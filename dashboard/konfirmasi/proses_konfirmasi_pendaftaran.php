<?php  
	session_start();
	include '../../koneksi/koneksi.php';

	if (isset($_GET['idd'])) {
		$id 		=	$_GET['idd'];
		$idu 		=	$_GET['idu'];
		$idd 		=	$_GET['idd'];
		$query 		=	"SELECT tanggal_lahir, jenjang_pendidikan FROM pendaftaran WHERE Id = $idd";
		$exec2		= 	mysqli_query($conn, $query); 

		if ($exec2) {
			$data 				=	mysqli_fetch_array($exec2);
			$jenjang_pendidikan = $data['jenjang_pendidikan'];
			$age 				= getAge($data['tanggal_lahir']);

			// Menentukan biaya berdasarkan jenjang pendidikan
			if ($jenjang_pendidikan == 'M') {  // Untuk MTS
				$biaya = 5165000;
			} elseif ($jenjang_pendidikan == 'A') {  // Untuk MA
				$biaya = 5190000;
			} else {
				$biaya = 0; // Atau Anda bisa menetapkan nilai default jika tidak ada jenjang
			}

		} else {
			echo mysqli_error($conn);
		}

		$query		=	"UPDATE detail_pendaftaran SET status_pendaftaran=1, id_admin=$idu, biaya_kegiatan='$biaya', usia='$age' WHERE id_user=$id";
		$exec 		= 	mysqli_query($conn, $query);

		if ($exec) {
			$_SESSION['message']	= "1";
			echo '<script>window.location="../index.php?page=13"</script>';
		} else {
			echo mysqli_error($conn);
		}
	} else {
		echo 'tidak ada';
	}

	function getAge($dob){
		$dob 			= strtotime($dob);
		$current_time 	= time();
		$age_years 		= date('Y',$current_time) - date('Y',$dob);
		$age_months 	= date('m',$current_time) - date('m',$dob);
		$age_days 		= date('d',$current_time) - date('d',$dob);

		if ($age_days<0) {
			$days_in_month = date('t',$current_time);
			$age_months--;
			$age_days= $days_in_month+$age_days;
		}

		if ($age_months<0) {
			$age_years--;
			$age_months = 12+$age_months;
		}

		$age = $age_years." tahun ".$age_months." bulan";

		return $age;
	}
?>