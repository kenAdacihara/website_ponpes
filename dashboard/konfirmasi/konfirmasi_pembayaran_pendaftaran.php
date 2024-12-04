<!-- Page Heading -->
<h3 class="text-center text-primary mt-3">Selamat Datang di Halaman Konfirmasi Pembayaran Pendaftaran</h3>

<?php  
	if (isset($_SESSION['message'])) {
		echo "<div class='alert alert-success alert-dismissable'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<strong>Berhasil!</strong> Konfirmasi Pembayaran pendaftaran.
			  </div>";
	}
?>

<div class="col-12 col-md-10 col-lg-10 mx-auto">
    <div class="card shadow-sm mt-5">
        <div class="card-header bg-primary text-white">
            <h4 class="font-weight-bold">Konfirmasi Pembayaran Pendaftaran</h4>
            <p class="mb-0">Lakukan Konfirmasi Pembayaran Pendaftaran</p>
        </div>
        <div class="card-body table-responsive">
                <h3 style="overflow: hidden;"><b>Data Konfirmasi Pembayaran</b></h3>
				<table class="table table-hover">
					<thead>
						<tr>
							<td><b>No</b></td>
							<td><b>Nama Pendaftar</b></td>
							<td><b>Email</b></td>
							<td><b>Status Pembayaran</b></td>
							<td><b>Aksi</b></td>
						</tr>
					</thead>
				    <tbody>
				    	<?php
							$query 	= "SELECT a.nama, a.id as id_daftar, b.id as id_akun,b.email,c.* 
			    				FROM pendaftaran a, akun b, detail_pendaftaran c 
					    		WHERE a.id=b.id_user 
						    	AND b.role_user=1 
						    	AND c.id_user = a.id
                    			AND a.upload_pembayaran_pendaftaran != ''";

							$exec 	=	mysqli_query($conn, $query);

							if ($exec) {
								$total	= mysqli_num_rows($exec);
								if ($total > 0) {
									$no = 0;  // Inisialisasi variabel $no
									while ($rows = mysqli_fetch_array($exec)) {
										$status = $rows['status_pembayaran_pendaftaran'];
				    	?>
							<tr>
										<td><?php echo ++$no; ?></td>
										<td><?php echo $rows['nama']; ?></td>
										<td><?php echo $rows['email']; ?></td>
										<td><?php $status == 0 ? print("<font color='#e74c3c'>Belum dikonfirmasi</font>") : print("<font color='##2ecc71'>Sudah dikonfirmasi</font>"); ?></td>
										<td>
											<!-- <a href="" class="btn btn-primary btn-sm">Konfirmasi</a> -->
											<a href="konfirmasi/proses_konfirmasi_pembayaran_pendaftaran.php?ida=<?php echo $rows['id_akun'] ?>&idd=<?php echo $rows['id_daftar'] ?>&idu=<?php echo $Id ?>" class="btn btn-warning btn-sm">Konfirmasi</a>
										</td>
									</tr>
				    	<?php
				    				}
								} else {
									echo "<td colspan='5' align='center'><h3><b>Belum ada siswa membayar</b></h3></td>";
								}
							} else {
								echo mysqli_error($conn);
							}
				    	?>
				    </tbody>
				</table>
            </div>
        </div>
    </div>
</div>

<?php unset($_SESSION['message']); ?>