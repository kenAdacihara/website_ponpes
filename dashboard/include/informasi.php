<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Selamat Datang di Halaman Data Informasi</h1>
</div>

<?php  
    if (isset($_SESSION['message'])) {
        echo "<div class='alert alert-success alert-dismissable'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Berhasil!</strong> ".$_SESSION['message']."
        </div>";
    }
    date_default_timezone_set("Asia/Jakarta");
?>

<!-- Informasi Table Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addInformasiModal"><i class="fa fa-plus"> Tambah Informasi</i></button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 15%;">Judul</th>
                        <th style="width: 30%;">Keterangan</th>
                        <th style="width: 30%;">Gambar</th>
                        <th style="width: 10%;">Tanggal</th>
                        <th style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $where = "WHERE 1=1 ";
                    if(isset($_GET['key'])){
                        $where .= " AND keterangan LIKE '%".addslashes($_GET['key'])."%' ";
                    }
                    $informasi = mysqli_query($conn, "SELECT * FROM informasi $where ORDER BY id DESC");
                    if(mysqli_num_rows($informasi) > 0 ){
                        while($p = mysqli_fetch_array($informasi)){
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $p['judul'] ?></td>
                        <td><?= implode(' ', array_slice(str_word_count($p['keterangan'], 1), 0, 10)) ?>...</td>
                        <td><img src="../uploads/informasi/<?= $p['gambar'] ?>" width="250px" style="border-radius: 10px;"></td>
                        <td><?= date('d F Y', strtotime($p['tanggal'])) ?></td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#editInformasiModal<?= $p['id'] ?>" title="Edit Data" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="index.php?page=3&idinformasi=<?= $p['id'] ?>" onclick="return confirm('Yakin ingin hapus ?')" title="Hapus Data" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>

                    <!-- Modal untuk Mengedit Informasi -->
                    <div class="modal fade" id="editInformasiModal<?= $p['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editInformasiModalLabel<?= $p['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editInformasiModalLabel<?= $p['id'] ?>">Edit Informasi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form untuk mengedit informasi -->
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                        <div class="form-group">
                                            <label for="judul">Judul</label>
                                            <input type="text" class="form-control" id="judul" name="judul" value="<?= $p['judul'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required><?= $p['keterangan'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="gambar">Gambar</label>
                                            <input type="file" class="form-control" id="gambar" name="gambar">
                                            <input type="hidden" name="gambar2" value="<?= $p['gambar'] ?>">
                                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $p['tanggal'] ?>" required>
                                        </div>
                                        <!-- Tombol Cancel dan Update Informasi -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary" name="update" value="Update">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PHP Code to Handle Update -->
                    <?php
                        if (isset($_POST['update'])) {
                            $id         = $_POST['id']; // Mengambil id dari form
                            $judul      = addslashes(ucwords($_POST['judul']));
                            $ket        = addslashes(ucwords($_POST['keterangan']));
                            $tanggal    = $_POST['tanggal'];
                            $currdate   = date('Y-m-d H:i:s');
                            
                            if ($_FILES['gambar']['name'] != '') {
                                $filename   = $_FILES['gambar']['name'];
                                $tmpname    = $_FILES['gambar']['tmp_name'];
                                $filesize   = $_FILES['gambar']['size'];

                                $formatfile = pathinfo($filename, PATHINFO_EXTENSION);
                                $rename     = 'informasi' . time() . '.' . $formatfile;

                                $allowedtype    = array('png', 'jpg', 'jpeg', 'gif');

                                if (!in_array($formatfile, $allowedtype)) {
                                    echo '<div class="alert alert-danger">Format file tidak diizinkan.</div>';
                                } elseif ($filesize > 2000000) {
                                    echo '<div class="alert alert-danger">Ukuran file tidak boleh lebih dari 2 MB.</div>';
                                } else {
                                    if (file_exists("../uploads/informasi/" . $_POST['gambar2'])) {
                                        unlink("../uploads/informasi/" . $_POST['gambar2']);
                                    }
                                    move_uploaded_file($tmpname, "../uploads/informasi/" . $rename);
                                }
                            } else {
                                $rename = $_POST['gambar2'];
                            }

                            $update = mysqli_query($conn, "UPDATE informasi SET
                                        judul       = '" . $judul . "',
                                        keterangan  = '" . $ket . "',
                                        gambar        = '" . $rename . "',
                                        tanggal     = '" . $tanggal . "',
                                        updated_at  = '" . $currdate . "'
                                        WHERE id    = '" . $id . "'
                                    ");

                            if ($update) {
                                $_SESSION['message'] = "Informasi berhasil diubah!";
                                echo '<script>window.location.href="index.php?page=3";</script>'; // Ganti "nama_halaman.php" dengan nama file halaman galeri Anda
                            } else {
                                echo 'Gagal simpan ' . mysqli_error($conn);
                            }
                        }
                    ?>

                    <!-- PHP Code to Handle Update -->
                    <?php 
                        if(isset($_GET['idinformasi'])){
                            $informasi = mysqli_query($conn, "SELECT gambar FROM informasi WHERE id = '".$_GET['idinformasi']."' ");
                            if(mysqli_num_rows($informasi) > 0){
                                $p = mysqli_fetch_object($informasi);
                                if(file_exists("../uploads/informasi/".$p->gambar)){
                                    unlink("../uploads/informasi/".$p->gambar);
                                }
                            }
                            $delete = mysqli_query($conn, "DELETE FROM informasi WHERE id = '".$_GET['idinformasi']."' ");
                            
                            if ($delete) {
                                $_SESSION['message'] = "Informasi berhasil dihapus!";
                                echo '<script>window.location.href="index.php?page=3";</script>'; // Ganti "nama_halaman.php" dengan nama file halaman galeri Anda
                            } else {
                                echo 'Gagal hapus ' . mysqli_error($conn);
                            }
                        }
                    ?>

                    <?php }} else{ ?>
                    <tr>
                        <td colspan="6" class="text-center">Data tidak ada</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal untuk Menambahkan Informasi -->
<div class="modal fade" id="addInformasiModal" tabindex="-1" role="dialog" aria-labelledby="addInformasiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInformasiModalLabel">Tambah Informasi Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form untuk menambahkan informasi -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <!-- Tombol Cancel dan Tambah Informasi -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="submit" value="Simpan">Tambah</button>
                    </div>
                </form>
                <?php
                    if (isset($_POST['submit'])) {

                        $judul = addslashes(ucwords($_POST['judul']));
                        $ket = addslashes(ucwords($_POST['keterangan']));
                        $tanggal = $_POST['tanggal'];

                        $filename = $_FILES['gambar']['name'];
                        $tmpname = $_FILES['gambar']['tmp_name'];
                        $filesize = $_FILES['gambar']['size'];

                        $formatfile = pathinfo($filename, PATHINFO_EXTENSION);
                        $rename = 'informasi' . time() . '.' . $formatfile;

                        $allowedtype = array('png', 'jpg', 'jpeg', 'gif');

                        if (!in_array($formatfile, $allowedtype)) {
                            echo '<div class="alert alert-danger">Format file tidak diizinkan.</div>';
                        } elseif ($filesize > 2000000) {
                            echo '<div class="alert alert-danger">Ukuran file tidak boleh lebih dari 1 MB.</div>';
                        } else {
                            move_uploaded_file($tmpname, "../uploads/informasi/" . $rename);
                            $simpan = mysqli_query($conn, "INSERT INTO informasi VALUES (
                                null,
                                '" . $judul . "',
                                '" . $ket . "',
                                '" . $rename . "',
                                '" . $tanggal . "',
                                null,
                                null
                            )");

                            if ($simpan) {
                                $_SESSION['message'] = "Informasi berhasil ditambahkan!";
                                echo '<script>window.location.href="index.php?page=3";</script>'; // Ganti "nama_halaman.php" dengan nama file halaman galeri Anda
                            } else {
                                echo 'Gagal simpan ' . mysqli_error($conn);
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>