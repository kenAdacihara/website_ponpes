<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Selamat Datang di Halaman Data Pengaturan</h1>
</div>

<?php  
    if (isset($_SESSION['message'])) {
        echo "<div class='alert alert-success alert-dismissable'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Berhasil!</strong> ".$_SESSION['message']."
        </div>";
    }
    date_default_timezone_set("Asia/Jakarta");
    $identitas = mysqli_query($conn, "SELECT * FROM pengaturan ORDER BY id DESC LIMIT 1");
    $d         = mysqli_fetch_object($identitas);
?>

<!-- Gallery Table Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Pengaturan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama">Nama Sekolah</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $d->nama ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Sekolah</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $d->email ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="telp">Telepon Sekolah</label>
                        <input type="text" class="form-control" id="telp" name="telp" value="<?= $d->telepon ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="gmaps">Google Maps Sekolah</label>
                        <textarea class="form-control" id="gmaps" name="gmaps" required><?= $d->google_maps ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="logo">Logo</label><br>
                        <img src="../uploads/identitas/<?= $d->logo ?>" width="300px" class="image">
                        <input type="file" class="form-control" id="logo" name="logo">
                        <input type="hidden" name="logo2" value="<?= $d->logo ?>">
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah logo sekolah.</small>
                    </div>
                    <div class="form-group">
                        <label for="favicon">Favicon</label><br>
                        <img src="../uploads/identitas/<?= $d->favicon ?>" width="100px" class="image">
                        <input type="file" class="form-control" id="favicon" name="favicon">
                        <input type="hidden" name="favicon2" value="<?= $d->favicon ?>">
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah favicon sekolah.</small>
                    </div>
                    <div class="form-group">
                        <label for="tentang">Tentang Sekolah</label>
                        <input type="text" class="form-control" id="tentang" name="tentang" value="<?= $d->tentang_sekolah ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="foto_sekolah">Foto Sekolah</label><br>
                        <img src="../uploads/identitas/<?= $d->foto_sekolah ?>" width="300px" class="image"><br><br>
                        <input type="file" class="form-control" id="foto_sekolah" name="foto_sekolah">
                        <input type="hidden" name="foto_sekolah2" value="<?= $d->foto_sekolah ?>">
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto sekolah.</small>
                    </div>
                    <div class="form-group">
                        <label for="nama_kepsek">Nama Kepala Sekolah</label>
                        <input type="text" class="form-control" id="nama_kepsek" name="nama_kepsek" value="<?= $d->nama_kepsek ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="sambutan">Sambutan Kepala Sekolah</label>
                        <textarea class="form-control" id="sambutan" name="sambutan" required><?= $d->sambutan_kepsek ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto_kepsek">Foto Kepala Sekolah</label><br>
                        <img src="../uploads/identitas/<?= $d->foto_kepsek ?>" width="300px" class="image"><br><br>
                        <input type="file" class="form-control" id="foto_kepsek" name="foto_kepsek">
                        <input type="hidden" name="foto_kepsek2" value="<?= $d->foto_kepsek ?>">
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto kepala sekolah.</small>
                    </div><br>
                    <button type="submit" class="btn btn-primary" name="submit" value="Simpan">Simpan Perubahan</button>
            </form>
                    <?php
                        if(isset($_POST['submit'])){

                            $nama           = addslashes(ucwords($_POST['nama']));
                            $email          = addslashes($_POST['email']);
                            $telp           = addslashes($_POST['telp']);
                            $alamat         = addslashes($_POST['alamat']);
                            $gmaps          = addslashes($_POST['gmaps']);
                            $tentang        = addslashes($_POST['tentang']);
                            $nama_kepsek    = addslashes(ucwords($_POST['nama_kepsek']));
                            $sambutan       = addslashes($_POST['sambutan']);
                            $currdate       = date('Y-m-d H:i:s');
                            
                            //menampung dan validasi data logo
                            if($_FILES['logo']['name'] != ''){
                                //echo 'user ganti gambar';
                                $filename_logo   = $_FILES['logo']['name'];
                                $tmpname_logo    = $_FILES['logo']['tmp_name'];
                                $filesize_logo   = $_FILES['logo']['size'];

                                $formatfile_logo = pathinfo($filename_logo, PATHINFO_EXTENSION);
                                $rename_logo     = 'logo'.time().'.'.$formatfile_logo;

                                $allowedtype_logo    = array('png', 'jpg', 'jpeg', 'gif');

                                if(!in_array($formatfile_logo, $allowedtype_logo)){
                                    echo '<div class="alert alert-error">Format file logo sekolah tidak diizinkan.</div>';
                                    return false;
                                } elseif($filesize_logo > 1000000){
                                    echo '<div class="alert alert-error">Ukuran file logo sekolah tidak boleh lebih dari 1 MB.</div>';
                                    return false;
                                } else{
                                    if(file_exists("../uploads/identitas/".$_POST['logo2'])){
                                        unlink("../uploads/identitas/".$_POST['logo2']);
                                    }
                                    move_uploaded_file($tmpname_logo, "../uploads/identitas/".$rename_logo);
                                }
                            } else{
                                //echo 'user tidak ganti gambar';
                                $rename_logo     = $_POST['logo2'];
                            }

                            //menampung dan validasi data favicon
                            if($_FILES['favicon']['name'] != ''){
                                //echo 'user ganti gambar';
                                $filename_favicon   = $_FILES['favicon']['name'];
                                $tmpname_favicon    = $_FILES['favicon']['tmp_name'];
                                $filesize_favicon   = $_FILES['favicon']['size'];

                                $formatfile_favicon = pathinfo($filename_favicon, PATHINFO_EXTENSION);
                                $rename_favicon     = 'favicon'.time().'.'.$formatfile_favicon;

                                $allowedtype_favicon    = array('png', 'jpg', 'jpeg', 'gif');

                                if(!in_array($formatfile_favicon, $allowedtype_favicon)){
                                    echo '<div class="alert alert-error">Format file favicon sekolah tidak diizinkan.</div>';
                                    return false;
                                } elseif($filesize_favicon > 1000000){
                                    echo '<div class="alert alert-error">Ukuran file favicon sekolah tidak boleh lebih dari 1 MB.</div>';
                                    return false;
                                } else{
                                    if(file_exists("../uploads/identitas/".$_POST['favicon2'])){
                                        unlink("../uploads/identitas/".$_POST['favicon2']);
                                    }
                                    move_uploaded_file($tmpname_favicon, "../uploads/identitas/".$rename_favicon);
                                }
                            } else{
                                //echo 'user tidak ganti gambar';
                                $rename_favicon     = $_POST['favicon2'];
                            }

                            //menampung dan validasi data foto sekolah
                            if($_FILES['foto_sekolah']['name'] != ''){
                                //echo 'user ganti gambar';
                                $filename   = $_FILES['foto_sekolah']['name'];
                                $tmpname    = $_FILES['foto_sekolah']['tmp_name'];
                                $filesize   = $_FILES['foto_sekolah']['size'];

                                $formatfile         = pathinfo($filename, PATHINFO_EXTENSION);
                                $rename_sekolah     = 'sekolah'.time().'.'.$formatfile;

                                $allowedtype    = array('png', 'jpg', 'jpeg', 'gif');

                                if(!in_array($formatfile, $allowedtype)){
                                    echo '<div class="alert alert-error">Format file foto sekolah tidak diizinkan.</div>';
                                    return false;
                                } elseif($filesize > 1000000){
                                    echo '<div class="alert alert-error">Ukuran file foto sekolah tidak boleh lebih dari 1 MB.</div>';
                                    return false;
                                } else{
                                    if(file_exists("../uploads/identitas/".$_POST['foto_sekolah2'])){
                                        unlink("../uploads/identitas/".$_POST['foto_sekolah2']);
                                    }
                                    move_uploaded_file($tmpname, "../uploads/identitas/".$rename_sekolah);
                                }
                            } else{
                                //echo 'user tidak ganti gambar';
                                $rename_sekolah     = $_POST['foto_sekolah2'];
                            }

                            //menampung dan validasi data foto sekolah
                            if($_FILES['foto_kepsek']['name'] != ''){
                                //echo 'user ganti gambar';
                                $filename   = $_FILES['foto_kepsek']['name'];
                                $tmpname    = $_FILES['foto_kepsek']['tmp_name'];
                                $filesize   = $_FILES['foto_kepsek']['size'];

                                $formatfile         = pathinfo($filename, PATHINFO_EXTENSION);
                                $rename_kepsek      = 'kepsek'.time().'.'.$formatfile;

                                $allowedtype    = array('png', 'jpg', 'jpeg', 'gif');

                                if(!in_array($formatfile, $allowedtype)){
                                    echo '<div class="alert alert-error">Format file foto kepala sekolah tidak diizinkan.</div>';
                                    return false;
                                } elseif($filesize > 1000000){
                                    echo '<div class="alert alert-error">Ukuran file foto kepala sekolah tidak boleh lebih dari 1 MB.</div>';
                                    return false;
                                } else{
                                    if(file_exists("../uploads/identitas/".$_POST['foto_kepsek2'])){
                                        unlink("../uploads/identitas/".$_POST['foto_kepsek2']);
                                    }
                                    move_uploaded_file($tmpname, "../uploads/identitas/".$rename_kepsek);
                                }
                            } else{
                                //echo 'user tidak ganti gambar';
                                $rename_kepsesk     = $_POST['foto_kepsek2'];
                            }

                            $update     = mysqli_query($conn, "UPDATE pengaturan SET
                                        nama            = '".$nama."',
                                        email           = '".$email."',
                                        telepon         = '".$telp."',
                                        alamat          = '".$alamat."',
                                        google_maps     = '".$gmaps."',
                                        logo            = '".$rename_logo."',
                                        favicon         = '".$rename_favicon."',
                                        tentang_sekolah = '".$tentang."',
                                        foto_sekolah    = '".$rename_sekolah."',
                                        nama_kepsek     = '".$nama_kepsek."',
                                        sambutan_kepsek = '".$sambutan."',
                                        foto_kepsek     = '".$rename_kepsek."',
                                        updated_at      = '".$currdate."'
                                        WHERE id        = '".$d->id."'
                                    ");

                            if ($update) {
                                $_SESSION['message'] = "Data pengaturan sekolah berhasil diubah!";
                                echo '<script>window.location.href="index.php?page=4";</script>'; // Ganti "nama_halaman.php" dengan nama file halaman galeri Anda
                            } else {
                                echo 'Gagal simpan ' . mysqli_error($conn);
                            }
                        }  
                    ?>
        </div> 
    </div>
</div>                               