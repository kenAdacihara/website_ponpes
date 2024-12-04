<!-- Page Heading -->
<h3 class="text-center text-primary mt-3">Selamat Datang di Halaman Upload Bukti Pembayaran Pendaftaran</h3>

<?php  
    include '../koneksi/koneksi.php';

    if (isset($_POST['upload'])) {
        $targetfolderBase       = "../uploads/pembayaran_pendaftaran/";
        $fileNameBayarDaftar    = date("h-m-s").basename( $_FILES['bayar_daftar']['name']);
        $targetfolder           = $targetfolderBase . $fileNameBayarDaftar;
        $ok                     = 1;
        $file_type              = $_FILES['bayar_daftar']['type'];

        if ($file_type=="application/pdf" || $file_type=="image/png" || $file_type=="image/jpeg") {
            
            if(move_uploaded_file($_FILES['bayar_daftar']['tmp_name'], $targetfolder)) {
                $query  = "UPDATE pendaftaran SET upload_pembayaran_pendaftaran='$fileNameBayarDaftar' WHERE id=$id";
                $exec   = mysqli_query($conn, $query);

                if ($exec) {
                    echo "<div class='alert alert-success alert-dismissable'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Berhasil!</strong> Upload Bukti Pembayaran Pendaftaran(PDF, JPEG, PNG).
                        </div>";   
                }     
            } else {
                echo "<div class='alert alert-danger alert-dismissable'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Gagal!</strong> Upload Bukti Pembayaran Pendaftaran(PDF, JPEG, PNG).
                    </div>";
            }
        } else {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Gagal!</strong> Upload Bukti Pembayaran Pendaftaran harus format(.PDF, JPEG, PNG).
                </div>";
        }
    }
?>

<div class="col-12 col-md-10 col-lg-8 mx-auto">
    <div class="card shadow-sm mt-5">
        <div class="card-header bg-primary text-white">
            <h4 class="font-weight-bold">Kofirmasi Pembayaran Pendaftaran</h4>
            <p class="mb-0">Upload bukti pembayaran dalam format yang ditentukan (PNG/JPEG/PDF)</p>
            <a href="index.php?page=16" class="btn btn-warning btn-md pull-right mt-2" style="margin-left: 490px"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card-body table-responsive">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group floating-label" style="margin-left: 20px;">
                        <label class="col-sm-12">Bukti Pembayaran/Struk Transfer (PNG/JPEG/PDF) : </label>
                        <label class="btn btn-primary" for="my-file-selector">
                            <input id="my-file-selector" name="bayar_daftar" type="file" style="display:none" 
                                onchange="$('#upload-file-info').html(this.files[0].name)">
                                upload bukti pembayaran (PNG/JPEG/PDF)
                        </label>
                        <span class='label label-info' id="upload-file-info"></span>
                    </div>
                </div>     
                <button type="submit" name="upload" class="btn btn-success blue pull-right"><i class="fa fa-upload"></i> Upload File</button>
            </form>
        </div>
    </div>
</div>

<br><br>