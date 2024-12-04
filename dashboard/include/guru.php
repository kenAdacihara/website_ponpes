<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Selamat Datang di Halaman Data Guru</h1>
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

<!-- Gallery Table Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Guru</h6>
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addGuruModal"><i class="fa fa-plus"> Tambah Guru</i></button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 15%;">NIK</th>
                        <th style="width: 28%;">Nama</th>
                        <th style="width: 20%;">Foto</th>
                        <th style="width: 10%;">No.Telp</th>
                        <th style="width: 10%;">Tanggal</th>
                        <th style="width: 12%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    $where = "WHERE 1=1 ";
                    if(isset($_GET['key'])){
                        $where .= " AND nama LIKE '%".addslashes($_GET['key'])."%' ";
                    }
                    $guru = mysqli_query($conn, "SELECT * FROM guru $where ORDER BY id DESC");
                    if(mysqli_num_rows($guru) > 0 ){
                        while($p = mysqli_fetch_array($guru)){
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $p['nik'] ?></td>
                        <td><?= $p['nama'] ?></td>
                        <td><img src="../uploads/guru/<?= $p['foto'] ?>" width="150px" style="border-radius: 10px;"></td>
                        <td><?= $p['telepon'] ?></td>
                        <td><?= date('d F Y', strtotime($p['tanggal'])) ?></td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#editGuruModal<?= $p['id'] ?>" title="Edit Data" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="index.php?page=5&idguru=<?= $p['id'] ?>" onclick="return confirm('Yakin ingin hapus ?')" title="Hapus Data" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>

                    <!-- Modal untuk Mengedit Guru -->
                    <div class="modal fade" id="editGuruModal<?= $p['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editGuruModalLabel<?= $p['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editGuruModalLabel<?= $p['id'] ?>">Edit Guru</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form untuk mengedit guru -->
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                        <div class="form-group">
                                            <label for="nik">NIK</label>
                                            <input type="text" class="form-control" id="nik" name="nik" value="<?= $p['nik'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $p['nama'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="foto">Foto</label>
                                            <input type="file" class="form-control" id="foto" name="foto">
                                            <input type="hidden" name="foto2" value="<?= $p['foto'] ?>">
                                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="telp">No. Telp</label>
                                            <input type="text" class="form-control" id="telp" name="telp" value="<?= $p['telepon'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $p['tanggal'] ?>" required>
                                        </div>
                                        <!-- Tombol Cancel dan Update -->
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
                            $nik        = addslashes($_POST['nik']);
                            $nama       = addslashes(ucwords($_POST['nama']));
                            $telp       = addslashes($_POST['telp']);
                            $tanggal    = $_POST['tanggal'];
                            $currdate   = date('Y-m-d H:i:s');
                            
                            if ($_FILES['foto']['name'] != '') {
                                $filename   = $_FILES['foto']['name'];
                                $tmpname    = $_FILES['foto']['tmp_name'];
                                $filesize   = $_FILES['foto']['size'];

                                $formatfile = pathinfo($filename, PATHINFO_EXTENSION);
                                $rename     = 'guru' . time() . '.' . $formatfile;

                                $allowedtype    = array('png', 'jpg', 'jpeg', 'gif');

                                if (!in_array($formatfile, $allowedtype)) {
                                    echo '<div class="alert alert-danger">Format file tidak diizinkan.</div>';
                                } elseif ($filesize > 2000000) {
                                    echo '<div class="alert alert-danger">Ukuran file tidak boleh lebih dari 2 MB.</div>';
                                } else {
                                    if (file_exists("../uploads/guru/" . $_POST['foto2'])) {
                                        unlink("../uploads/gutu/" . $_POST['foto2']);
                                    }
                                    move_uploaded_file($tmpname, "../uploads/guru/" . $rename);
                                }
                            } else {
                                $rename = $_POST['foto2'];
                            }

                            $update = mysqli_query($conn, "UPDATE guru SET
                                        nik         = '" . $nik . "',
                                        nama        = '" . $nama . "',
                                        foto        = '" . $rename . "',
                                        telepon     = '" . $telp . "',
                                        tanggal     = '" . $tanggal . "',
                                        updated_at  = '" . $currdate . "'
                                        WHERE id    = '" . $id . "'
                                    ");

                            if ($update) {
                                $_SESSION['message'] = "Guru berhasil diubah!";
                                echo '<script>window.location.href="index.php?page=5";</script>'; // Ganti "nama_halaman.php" dengan nama file halaman galeri Anda
                            } else {
                                echo 'Gagal simpan ' . mysqli_error($conn);
                            }
                        }
                    ?>

                    <!-- PHP Code to Handle Delete -->
                    <?php 
                        if(isset($_GET['idguru'])){
                            $guru = mysqli_query($conn, "SELECT foto FROM guru WHERE id = '".$_GET['idguru']."' ");
                            if(mysqli_num_rows($guru) > 0){
                                $p = mysqli_fetch_object($guru);
                                if(file_exists("../uploads/guru/".$p->foto)){
                                    unlink("../uploads/guru/".$p->foto);
                                }
                            }
                            $delete = mysqli_query($conn, "DELETE FROM guru WHERE id = '".$_GET['idguru']."' ");
                            
                            if ($delete) {
                                $_SESSION['message'] = "Guru berhasil dihapus!";
                                echo '<script>window.location.href="index.php?page=5";</script>'; // Ganti "nama_halaman.php" dengan nama file halaman guru Anda
                            } else {
                                echo 'Gagal hapus ' . mysqli_error($conn);
                            }
                        }
                    ?>
                    <?php }} else{ ?>
                    <tr>
                        <td colspan="7" class="text-center">Data tidak ada</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal untuk Menambahkan Guru -->
<div class="modal fade" id="addGuruModal" tabindex="-1" role="dialog" aria-labelledby="addGuruModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGuruModalLabel">Tambah Guru Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form untuk menambahkan guru -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Foto</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" required>
                    </div>
                    <div class="form-group">
                        <label for="telp">No. Telp</label>
                        <input type="text" class="form-control" id="telp" name="telp" required>
                    </div>                    
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <!-- Tombol Cancel dan Add Guru -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="submit" value="Simpan">Tambah</button>
                    </div>
                </form>
                <?php
                    if (isset($_POST['submit'])) {

                        $nik        = addslashes($_POST['nik']);
                        $nama       = addslashes(ucwords($_POST['nama']));
                        $telp       = addslashes($_POST['telp']);
                        $tanggal    = $_POST['tanggal'];

                        $filename = $_FILES['gambar']['name'];
                        $tmpname  = $_FILES['gambar']['tmp_name'];
                        $filesize = $_FILES['gambar']['size'];

                        $formatfile = pathinfo($filename, PATHINFO_EXTENSION);
                        $rename = 'guru' . time() . '.' . $formatfile;

                        $allowedtype = array('png', 'jpg', 'jpeg', 'gif');

                        if (!in_array($formatfile, $allowedtype)) {
                            echo '<div class="alert alert-danger">Format file tidak diizinkan.</div>';
                        } elseif ($filesize > 1000000) {
                            echo '<div class="alert alert-danger">Ukuran file tidak boleh lebih dari 1 MB.</div>';
                        } else {
                            move_uploaded_file($tmpname, "../uploads/guru/" . $rename);
                            $simpan = mysqli_query($conn, "INSERT INTO guru VALUES (
                                null,
                                '" . $nik . "',
                                '" . $nama . "',
                                '" . $rename . "',
                                '" . $telp. "',
                                '" . $tanggal . "',
                                null,
                                null
                            )");

                            if ($simpan) {
                                $_SESSION['message'] = "Guru berhasil ditambahkan!";
                                echo '<script>window.location.href="index.php?page=5";</script>'; // Ganti "nama_halaman.php" dengan nama file halaman guru Anda
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