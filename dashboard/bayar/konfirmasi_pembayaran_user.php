<!-- Page Heading -->
<h3 class="text-center text-primary mt-3">Selamat Datang di Halaman Konfirmasi Pembayaran Pendaftaran</h3>

<div class="col-12 col-md-10 col-lg-8 mx-auto">
    <div class="card shadow-sm mt-5">
        <div class="card-header bg-primary text-white">
            <h4 class="font-weight-bold">Konfirmasi Pembayaran</h4>
            <p class="mb-0">Daftar Konfirmasi Pembayaran</p>
        </div>
        <div class="card-body table-responsive">
            <?php  
                // Initialize $daftar as null
                $bayar = null;
                if ($upload_pembayaran_pendaftaran != "") {
                    $queryx = "SELECT * FROM detail_pendaftaran WHERE id_user = $id";
                    $execx = mysqli_query($conn, $queryx);
                    if ($execx) {
                        $bayar = mysqli_fetch_array($execx);
                    } else {
                        echo 'Gagal mengambil data pembayaran pendaftaran.';
                    }
                }

                if ($bayar) {
                    if ($bayar['status_pendaftaran'] == 1) {
                        echo "<div class='alert alert-success alert-dismissable'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                <strong>Selamat!</strong>Pembayaran anda sudah dikonfirmasi Admin. Lunas.
                              </div>";
                    } else if ($bayar['status_pendaftaran'] == 2) {
                        echo "<div class='alert alert-warning alert-dismissable'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                <strong>Anda sudah melakukan pembayaran pendaftaran</strong> 
                              </div>";
                    } else if ($bayar['status_pendaftaran'] == 0) {
                        echo "<div class='alert alert-warning alert-dismissable'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                <strong>Bukti pembayaran pembayaran sudah diupload. Tunggu konfirmasi admin paling lambat 2 hari kerja</strong> 
                              </div>";
                    }
                }
            ?>
           <ul>
                <li> 
                    <?php 
                        if ($upload_pembayaran_pendaftaran != "") {
                            if ($bayar && ($bayar['status_pembayaran_pendaftaran'] == 1 || $bayar['status_pembayaran_pendaftaran'] >= 2)) {
                                echo '<font color="#2ecc71">Upload bukti pembayaran pendaftaran<i class="fa fa-check"></i></font>';
                            } else {
                                echo '<font color="#2ecc71">Upload bukti pembayaran pendaftaran<i class="fa fa-check"></i></font> <a href="index.php?page=17" class="btn btn-primary btn-sm" title="Upload Akte Kelahiran dan Kartu Keluarga"><i class="fas fa-edit"></i></a>';
                            }    
                        } else {
                            echo 'Upload bukti pembayaran pendaftaran <a href="index.php?page=17" class="btn btn-primary btn-sm" title="Upload Akte Kelahiran dan Kartu Keluarga"><i class="fa fa-upload"></i></a>';
                        }  
                    ?>
                </li>
                    </ul>
            <h6><i><b>*Catatan : Tunggu konfirmasi admin paling lambat dua hari kerja untuk verifikasi file.</b></i></h6>
        </div>
    </div>
</div>

<br><br>