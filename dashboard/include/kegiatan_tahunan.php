<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Selamat Datang di Halaman Kegiatan Tahunan</h1>
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
        <h6 class="m-0 font-weight-bold text-primary">Kegiatan Tahunan</h6>
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addKegiatanModal"><i class="fa fa-plus"> Tambah Kegiatan Tahunan</i></button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 70%;">Kegiatan</th>
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
                    $kegiatan_tahunan = mysqli_query($conn, "SELECT * FROM kegiatan_tahunan $where ORDER BY id ASC");
                    if(mysqli_num_rows($kegiatan_tahunan) > 0 ){
                        while($p = mysqli_fetch_array($kegiatan_tahunan)){
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $p['kegiatan'] ?></td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#editKegiatanModal<?= $p['id'] ?>" title="Edit Data" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="index.php?page=8&idkegiatantahunan=<?= $p['id'] ?>" onclick="return confirm('Yakin ingin hapus ?')" title="Hapus Data" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>

                    <!-- Modal untuk Mengedit Kegiatan -->
                    <div class="modal fade" id="editKegiatanModal<?= $p['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editKegiatanModalLabel<?= $p['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editKegiatanModalLabel<?= $p['id'] ?>">Edit Kegiatan Tahunan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form untuk mengedit kegiatan -->
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                        <div class="form-group">
                                            <label for="kegiatan">Kegiatan</label>
                                            <textarea class="form-control" id="kegiatan" name="kegiatan" rows="3" required><?= $p['kegiatan'] ?></textarea>
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
                            $kegiatan   = addslashes($_POST['kegiatan']);
                            $currdate   = date('Y-m-d H:i:s');
                            
                            $update = mysqli_query($conn, "UPDATE kegiatan_tahunan SET
                                        kegiatan    = '" . $kegiatan . "',
                                        updated_at  = '" . $currdate . "'
                                        WHERE id    = '" . $id . "'
                                    ");

                            if ($update) {
                                $_SESSION['message'] = "Kegiatan Tahunan berhasil diubah!";
                                echo '<script>window.location.href="index.php?page=8";</script>';
                                echo 'Gagal simpan ' . mysqli_error($conn);
                            }
                        }
                    ?>

                    <!-- PHP Code to Handle Delete -->
                    <?php 
                        if(isset($_GET['idkegiatantahunan'])){
                            
                            $delete = mysqli_query($conn, "DELETE FROM kegiatan_tahunan WHERE id = '".$_GET['idkegiatantahunan']."' ");
                            
                            if ($delete) {
                                $_SESSION['message'] = "Kegiatan Tahunan berhasil dihapus!";
                                echo '<script>window.location.href="index.php?page=8";</script>';
                            } else {
                                echo 'Gagal hapus ' . mysqli_error($conn);
                            }
                        }
                    ?>
                    
                    <?php }} else{ ?>
                    <tr>
                        <td colspan="3" class="text-center">Data tidak ada</td>
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
                        <label for="kegiatan">Kegiatan</label>
                        <textarea class="form-control" id="kegiatan" name="kegiatan" rows="3" required></textarea>
                    </div>
                    <!-- Tombol Cancel dan Add Gallery -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="submit" value="Simpan">Tambah</button>
                    </div>
                </form>
                <?php
                    if (isset($_POST['submit'])) {

                        $kegiatan   = addslashes(ucwords($_POST['kegiatan']));

                        $simpan = mysqli_query($conn, "INSERT INTO kegiatan_tahunan VALUES (
                            null,
                            '" . $kegiatan . "',
                            null,
                            null
                        )");

                        if ($simpan) {
                            $_SESSION['message'] = "Kegiatan Tahunan berhasil ditambahkan!";
                            echo '<script>window.location.href="index.php?page=8";</script>';
                        } else {
                            echo 'Gagal simpan ' . mysqli_error($conn);
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>