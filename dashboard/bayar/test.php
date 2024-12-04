<?php  
    $queryx = "SELECT * FROM detail_pendaftaran WHERE id_user = $id";
    $execx  = mysqli_query($conn, $queryx);

    if ($execx) {
        $daftar = mysqli_fetch_array($execx);
    } else {
        echo '<div class="alert alert-danger" role="alert">Gagal mengambil data pendaftaran.</div>';
    }	
?>

<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="font-weight-bold mb-0">Pembayaran</h4>
            <small>Berikut Biaya Pendaftaran Santri Baru Pondok Pesantren Salafiyyah Al Hidayah</small>
        </div>
        <div class="card-body">
            <!-- MTs NU Al-Hidayah -->
            <div class="mb-4">
                <h6><b>MTs NU Al-Hidayah</b></h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Jenis Pengeluaran</th>
                                <th class="text-right">Biaya (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Uang Pendaftaran</td>
                                <td class="text-right">300.000</td>
                            </tr>
                            <tr>
                                <td>Infaq Santri Baru</td>
                                <td class="text-right">4.000.000</td>
                            </tr>
                            <tr>
                                <td>Jas Almamater Pondok</td>
                                <td class="text-right">150.000</td>
                            </tr>
                            <tr>
                                <td>Iuran Kegiatan Madrasah</td>
                                <td class="text-right">440.000</td>
                            </tr>
                            <tr>
                                <td>MATSAMA & OSPEK SANTRI</td>
                                <td class="text-right">275.000</td>
                            </tr>
                            <tr>
                                <th class="text-center">Total</th>
                                <th class="text-right">5.165.000</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <br>

            <!-- MA NU Al-Hidayah -->
            <div class="mb-4">
                <h6><b>MA NU Al-Hidayah</b></h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Jenis Pengeluaran</th>
                                <th class="text-right">Biaya (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Uang Pendaftaran</td>
                                <td class="text-right">300.000</td>
                            </tr>
                            <tr>
                                <td>Infaq Santri Baru</td>
                                <td class="text-right">4.000.000</td>
                            </tr>
                            <tr>
                                <td>Jas Almamater Pondok</td>
                                <td class="text-right">175.000</td>
                            </tr>
                            <tr>
                                <td>Iuran Kegiatan Madrasah</td>
                                <td class="text-right">440.000</td>
                            </tr>
                            <tr>
                                <td>MATSAMA & OSPEK SANTRI</td>
                                <td class="text-right">275.000</td>
                            </tr>
                            <tr>
                                <th class="text-center">Total</th>
                                <th class="text-right">5.190.000</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Button Actions -->
            <div class="mt-4">
                <?php  
                    if ($daftar['status_pendaftaran'] == 1) {
                        echo '<a href="index.php?page=15&metode_pembayaran=0&status=true" class="btn btn-primary"><i class="fas fa-print"></i> Cetak Biaya Pendaftaran</a>';
                    } elseif ($daftar['status_pendaftaran'] == 2) {
                        echo '<div class="alert alert-success" role="alert"><i class="fas fa-check-circle"></i> Anda sudah melakukan pembayaran.</div>';
                    } elseif ($daftar['status_pendaftaran'] == 0) {
                        echo '<div class="alert alert-warning" role="alert"><i class="fas fa-info-circle"></i> Persyaratan sudah lengkap. Tunggu konfirmasi admin paling lambat 2 hari kerja.</div>';
                    } elseif ($daftar['status_pendaftaran'] == 4) {
                        echo '<div class="alert alert-success" role="alert"><i class="fas fa-check-circle"></i> Pembayaran pendaftaran sudah lunas.</div>';
                    } elseif ($daftar['status_pendaftaran'] == 3) {
                        echo '<div class="alert alert-info" role="alert"><i class="fas fa-info-circle"></i> Pembayaran pendaftaran lunas di cicilan ke-1.</div>';
                    } else {
                        echo '<div class="alert alert-warning" role="alert"><i class="fas fa-info-circle"></i> Pendaftaran Anda belum dikonfirmasi oleh admin. Tunggu konfirmasi admin untuk tahap selanjutnya.</div>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Metode Pembayaran Modal -->
<div class="modal fade" id="metodePembayaranModal" tabindex="-1" role="dialog" aria-labelledby="metodePembayaranModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      	<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title" id="metodePembayaranModalLabel"><i class="fas fa-credit-card"></i> Pilih Metode Pembayaran</h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="index.php?page=15" method="get">
                <input type="hidden" name="page" value="15">
				<div class="modal-body">
					<div class="form-group">
						<label for="metode_pembayaran" class="font-weight-bold">Metode Pembayaran</label>
						<select name="metode_pembayaran" class="form-control" required>
							<option value="" disabled selected>Pilih Metode Pembayaran</option>
							<option value="0">Lunas</option>
							<option value="1">Cicil (2x)</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
					<button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Pilih</button>
				</div>
			</form>
		</div>
    </div>
</div>