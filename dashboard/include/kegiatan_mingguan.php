<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Selamat Datang di Halaman Kegiatan Mingguan</h1>
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

<!-- Kegiatan Table Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Galeri</h6>
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addKegiatanModal"><i class="fa fa-plus"> Tambah Kegiatan Mingguan</i></button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 15%;">Hari</th>
                        <th style="width: 50%;">Kegiatan</th>
                        <th style="width: 20%;">Tempat</th>
                        <th style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1;
                    $where = "WHERE 1=1 ";
                    if(isset($_GET['key'])){
                        $where .= " AND kegiatan LIKE '%".addslashes($_GET['key'])."%' ";
                    }
                    $kegiatan_mingguan = mysqli_query($conn, "SELECT * FROM kegiatan_mingguan $where ORDER BY id ASC");
                    if(mysqli_num_rows($kegiatan_mingguan) > 0 ){
                        while($p = mysqli_fetch_array($kegiatan_mingguan)){
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $p['hari'] ?></td>
                        <td><?= $p['kegiatan'] ?></td>
                        <td><?= $p['tempat'] ?></td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#editKegiatanModal<?= $p['id'] ?>" title="Edit Data" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="index.php?page=7&idkegiatanmingguan=<?= $p['id'] ?>" onclick="return confirm('Yakin ingin hapus ?')" title="Hapus Data" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>

                    <!-- Modal untuk Mengedit Kegiatan -->
                    <div class="modal fade" id="editKegiatanModal<?= $p['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editKegiatanModalLabel<?= $p['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editKegiatanModalLabel<?= $p['id'] ?>">Edit Kegiatan Mingguan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form untuk mengedit kegiatan -->
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                        <div class="form-group">
                                            <label for="hari">Hari</label>
                                            <input type="text" class="form-control" id="hari" name="hari" value="<?= $p['hari'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="kegiatan">Kegiatan</label>
                                            <textarea class="form-control" id="kegiatan" name="kegiatan" rows="3" required><?= $p['kegiatan'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat">Tempat</label>
                                            <input type="text" class="form-control" id="tempat" name="tempat" value="<?= $p['tempat'] ?>" required>
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
                            $hari       = addslashes($_POST['hari']);
                            $kegiatan   = addslashes($_POST['kegiatan']);
                            $tempat     = addslashes($_POST['tempat']);
                            $currdate   = date('Y-m-d H:i:s');
                            
                            $update = mysqli_query($conn, "UPDATE kegiatan_mingguan SET
                                        hari        = '" . $hari . "',
                                        kegiatan    = '" . $kegiatan . "',
                                        tempat      = '" . $tempat . "',
                                        updated_at  = '" . $currdate . "'
                                        WHERE id    = '" . $id . "'
                                    ");

                            if ($update) {
                                $_SESSION['message'] = "Kegiatan Mingguan berhasil diubah!";
                                echo '<script>window.location.href="index.php?page=7";</script>';
                                echo 'Gagal simpan ' . mysqli_error($conn);
                            }
                        }
                    ?>

                    <!-- PHP Code to Handle Delete -->
                    <?php 
                        if(isset($_GET['idkegiatanmingguan'])){
                            
                            $delete = mysqli_query($conn, "DELETE FROM kegiatan_mingguan WHERE id = '".$_GET['idkegiatanmingguan']."' ");
                            
                            if ($delete) {
                                $_SESSION['message'] = "Kegiatan Mingguan berhasil dihapus!";
                                echo '<script>window.location.href="index.php?page=7";</script>';
                            } else {
                                echo 'Gagal hapus ' . mysqli_error($conn);
                            }
                        }
                    ?>

                    <?php }} else{ ?>
                    <tr>
                        <td colspan="5" class="text-center">Data tidak ada</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal untuk Menambahkan Kegiatan -->
<div class="modal fade" id="addKegiatanModal" tabindex="-1" role="dialog" aria-labelledby="addKegiatanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addKegiatanModalLabel">Tambah Kegiatan Harian Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form untuk menambahkan kegiatan -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="hari">Hari</label>
                        <input type="text" class="form-control" id="hari" name="hari" required>
                    </div>
                    <div class="form-group">
                        <label for="kegiatan">Kegiatan</label>
                        <textarea class="form-control" id="kegiatan" name="kegiatan" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tempat">Tempat</label>
                        <input type="text" class="form-control" id="tempat" name="tempat" required>
                    </div>
                    <!-- Tombol Cancel dan Add Gallery -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="submit" value="Simpan">Tambah</button>
                    </div>
                </form>
                <?php
                    if (isset($_POST['submit'])) {

                        $hari      = $_POST['hari'];
                        $kegiatan   = addslashes(ucwords($_POST['kegiatan']));
                        $tempat     = addslashes(ucwords($_POST['tempat']));

                        $simpan = mysqli_query($conn, "INSERT INTO kegiatan_mingguan VALUES (
                            null,
                            '" . $hari . "',
                            '" . $kegiatan . "',
                            '" . $tempat . "',
                            null,
                            null
                        )");

                        if ($simpan) {
                            $_SESSION['message'] = "Kegiatan Mingguan berhasil ditambahkan!";
                            echo '<script>window.location.href="index.php?page=7";</script>'; // Ganti "nama_halaman.php" dengan nama file halaman galeri Anda
                        } else {
                            echo 'Gagal simpan ' . mysqli_error($conn);
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>