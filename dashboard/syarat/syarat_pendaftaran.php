<!-- Page Heading -->
<h3 class="text-center text-primary mt-3">Selamat Datang di Halaman Syarat Pendaftaran</h3>

<div class="col-12 col-md-10 col-lg-8 mx-auto">
    <div class="card shadow-sm mt-5">
        <div class="card-header bg-primary text-white">
            <h4 class="font-weight-bold">Syarat Pendaftaran</h4>
            <p class="mb-0">Isi Form Pendaftaran Dengan Benar</p>
        </div>
        <div class="card-body table-responsive">
            <?php  
                // Initialize $daftar as null
                $daftar = null;
                if ($upload_akte != "" && $upload_kartu_keluarga != "" && $foto_anak != "" && $foto_keluarga != "" && $upload_ijazah != "" && $upload_skhu != "") {
                    $queryx = "SELECT * FROM detail_pendaftaran WHERE id_user = $id";
                    $execx = mysqli_query($conn, $queryx);
                    if ($execx) {
                        $daftar = mysqli_fetch_array($execx);
                    } else {
                        echo 'Gagal mengambil data pendaftaran.';
                    }
                }

                if ($daftar) {
                    if ($daftar['status_pendaftaran'] == 1) {
                        echo "<div class='alert alert-success alert-dismissable'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                <strong>Selamat!</strong> Pendaftaran anda sudah dikonfirmasi Admin. Selanjutnya, cetak kwitansi pembayaran <a href='index.php?page=14'><u>di menu pembayaran</u></a>. dan lakukan konfirmasi pembayaran setelah melakukan pembayaran.
                              </div>";
                    } else if ($daftar['status_pendaftaran'] == 2) {
                        echo "<div class='alert alert-warning alert-dismissable'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                <strong>Anda sudah melakukan pembayaran</strong> 
                              </div>";
                    } else if ($daftar['status_pendaftaran'] == 0) {
                        echo "<div class='alert alert-warning alert-dismissable'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                <strong>Persyaratan sudah lengkap. Tunggu konfirmasi admin paling lambat 2 hari kerja</strong> 
                              </div>";
                    }
                }
            ?>
            <h5 class="text-secondary"><b>Berikut adalah syarat pendaftaran siswa baru yang harus dipenuhi :</b></h5>
            <ol>
                <li><font color="#2ecc71">Mengisi Formulir Pendaftaran <i class="fa fa-check"></i></font></li>
                <li> 
                    <?php 
                        if ($upload_akte != "" && $upload_kartu_keluarga != "") {
                            if ($daftar && ($daftar['status_pendaftaran'] == 1 || $daftar['status_pendaftaran'] >= 2)) {
                                echo '<font color="#2ecc71">Fotocopy Akte kelahiran dan kartu keluarga 2 lembar<i class="fa fa-check"></i></font>';
                            } else {
                                echo '<font color="#2ecc71">Fotocopy Akte kelahiran dan kartu keluarga 2 lembar<i class="fa fa-check"></i></font> <a href="index.php?page=11" class="btn btn-primary btn-sm" title="Upload Akte Kelahiran dan Kartu Keluarga"><i class="fas fa-edit"></i></a>';
                            }    
                        } else {
                            echo 'Fotocopy Akte kelahiran dan kartu keluarga 2 lembar <a href="index.php?page=11" class="btn btn-primary btn-sm" title="Upload Akte Kelahiran dan Kartu Keluarga"><i class="fa fa-upload"></i></a>';
                        }  
                    ?>
                </li>
                <li>
                    <?php 
                        if ($foto_anak != "" && $foto_keluarga != "") {
                            if ($daftar && ($daftar['status_pendaftaran'] == 1 || $daftar['status_pendaftaran'] >= 2)) {
                                echo '<font color="#2ecc71">Foto anak dan foto keluarga ukuran 2R<i class="fa fa-check"></i></font>';
                            } else {
                                echo '<font color="#2ecc71">Foto anak dan foto keluarga ukuran 2R<i class="fa fa-check"></i></font> <a href="index.php?page=12" class="btn btn-primary btn-sm" title="Upload Foto Anak dan Keluarga"><i class="fas fa-edit"></i></a>';
                            }             
                        } else {
                            echo 'Foto anak dan foto keluarga ukuran 2R <a href="index.php?page=12" class="btn btn-primary btn-sm" title="Upload Foto Anak dan Keluarga"><i class="fa fa-upload"></i></a>';
                        }
                    ?>
                </li>
                <li>
                <?php 
                        if ($upload_ijazah != "" && $upload_skhu != "") {
                            if ($daftar && ($daftar['status_pendaftaran'] == 1 || $daftar['status_pendaftaran'] >= 2)) {
                                echo '<font color="#2ecc71">Fotocopy Ijazah dan SKHU 2 lembar<i class="fa fa-check"></i></font>';
                            } else {
                                echo '<font color="#2ecc71">Fotocopy Ijazah dan SKHU 2 lembar<i class="fa fa-check"></i></font> <a href="index.php?page=21" class="btn btn-primary btn-sm" title="Upload Ijazah dan SKHU"><i class="fas fa-edit"></i></a>';
                            }    
                        } else {
                            echo 'Fotocopy Ijazah dan SKHU 2 lembar <a href="index.php?page=21" class="btn btn-primary btn-sm" title="Upload Ijazah dan SKHU"><i class="fa fa-upload"></i></a>';
                        }  
                    ?>
                </li>
            </ol>
            <h6><i><b>*Catatan : Tunggu konfirmasi admin paling lambat dua hari kerja untuk verifikasi file.</b></i></h6>
        </div>
    </div>
</div>