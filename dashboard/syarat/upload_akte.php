<!-- Page Heading -->
<h3 class="text-center text-primary mt-3">Selamat Datang di Halaman Upload Akte Kelahiran</h3>

<?php  
    include '../koneksi/koneksi.php';

    if (isset($_POST['upload'])) {
        $targetfolderBase   = "../uploads/akte/";

        $fileNameAkte           = date("h-m-s").basename( $_FILES['akte']['name']);
        $fileNameKartuKeluarga  = date("h-m-s").basename( $_FILES['kk']['name']);

        $targetfolder   = $targetfolderBase . $fileNameAkte;
        $targetfolder2  = $targetfolderBase . $fileNameKartuKeluarga;
        
        $ok=1;

        $file_type=$_FILES['akte']['type'];
        $file_type2=$_FILES['kk']['type'];

        if ($file_type=="application/pdf" || $file_type=="image/png" || $file_type=="image/jpeg") {
            
            if(move_uploaded_file($_FILES['akte']['tmp_name'], $targetfolder)) {
                $query  = "UPDATE pendaftaran SET upload_akte='$fileNameAkte' WHERE id=$id";
                $exec   = mysqli_query($conn, $query);

                if ($exec) {
                    echo "<div class='alert alert-success alert-dismissable'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Berhasil!</strong> Upload Akte(PDF, JPEG, PNG).
                        </div>";   
                }     
            } else {
                echo "<div class='alert alert-danger alert-dismissable'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Gagal!</strong> Upload Akte(PDF, JPEG, PNG).
                    </div>";
            }
        } else {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Gagal!</strong> Upload Akte harus format(.PDF, JPEG, PNG).
                </div>";
        }

        if ($file_type2=="application/pdf" || $file_type2=="image/png" || $file_type2=="image/jpeg") {

            if(move_uploaded_file($_FILES['kk']['tmp_name'], $targetfolder2)) {
                $query  = "UPDATE pendaftaran SET upload_kartu_keluarga='$fileNameKartuKeluarga' WHERE id=$id";
                $exec   = mysqli_query($conn, $query);

                if ($exec) {
                    echo "<div class='alert alert-success alert-dismissable'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Berhasil!</strong> Upload Kartu Keluarga(PDF, JPEG, PNG).
                        </div>";                
                }
            } else {
                echo "<div class='alert alert-danger alert-dismissable'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Gagal!</strong> Upload Kartu Keluarga(PDF, JPEG, PNG).
                    </div>";

            }
        } else {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Gagal!</strong> Upload Kartu Kelarga harus format(PDF, JPEG, PNG).
                </div>";
        }  
    }
?>

<div class="col-12 col-md-10 col-lg-8 mx-auto">
    <div class="card shadow-sm mt-5">
        <div class="card-header bg-primary text-white">
            <h4 class="font-weight-bold">Upload Akte(PDF, JPEG, PNG) dan Kartu Keluarga(PDF, JPEG, PNG)</h4>
            <p class="mb-0">Upload dengan format yang benar(PDF, JPEG, PNG)</p>
            <a href="index.php?page=10" class="btn btn-warning btn-md pull-right mt-0" style="margin-left: 490px"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card-body table-responsive">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group floating-label" style="margin-left: 20px;">
                        <label class="col-sm-12">Akte Kelahiran (PDF, JPEG, PNG) : </label>
                        <label class="btn btn-primary" for="my-file-selector">
                            <input id="my-file-selector" name="akte" type="file" style="display:none" 
                                onchange="$('#upload-file-info').html(this.files[0].name)">
                                Upload Akte (PDF, JPEG, PNG)
                        </label>
                        <span class='label label-info' id="upload-file-info"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group floating-label" style="margin-left: 20px;">
                        <label class="col-sm-12">Kartu Keluarga (PDF, JPEG, PNG) : </label>
                        <label class="btn btn-primary" for="my-file-selector2">
                            <input id="my-file-selector2" name="kk" type="file" style="display:none" 
                                onchange="$('#upload-file-info2').html(this.files[0].name)">
                                Upload Kartu Keluarga Keluarga (PDF, JPEG, PNG)
                        </label>
                        <span class='label label-info' id="upload-file-info2"></span>
                    </div>
                </div>    
                <hr> 
                <button type="submit" name="upload" class="btn btn-success blue pull-right"><i class="fa fa-upload"></i> Upload File</button>
            </form>
        </div>
    </div>
</div>
<br><br>