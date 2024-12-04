<!-- Page Heading -->
<div class="text-center my-3">
    <h2 class="text-primary">Rincian Pembayaran Pendaftaran</h2>aun
    <h3><b>Ponpes Salafiyah Al-Hidayah</b></h3>
    <hr class="w-75 mx-auto">
</div>

<?php  
    if (isset($_GET['metode_pembayaran'])) {
        $metode_pembayaran = $_GET['metode_pembayaran'];
    }

    // Set the payment method to "LUNAS" directly
    $metode_pembayaran = 0; // Full payment
    $m = "L";

    // Update the payment method in the database
    $queryUpdate = "UPDATE detail_pendaftaran SET metode_pembayaran_pendaftaran='$m' WHERE id_user=$id";
    $execUpdate = mysqli_query($conn, $queryUpdate);

    if ($execUpdate) {
        echo '<script>alert("Berhasil pilih metode pembayaran, silahkan lakukan pembayaran")</script>';
    } else {
        echo mysqli_error($conn);
    }

    // Fetch registration details and jenjang_pendidikan
    $queryx = "
        SELECT dp.*, p.jenjang_pendidikan
        FROM detail_pendaftaran dp
        JOIN pendaftaran p ON dp.id_user = p.Id
        WHERE dp.id_user = $id
    ";
    $execx = mysqli_query($conn, $queryx);
    if ($execx) {
        $daftar = mysqli_fetch_array($execx);
    } else {
        echo 'Gagal mengambil data';
    }

    // Determine full name of educational level
    $jenjang_pendidikan_full = '';
    if ($daftar['jenjang_pendidikan'] == 'M') {
        $jenjang_pendidikan_full = 'MTS';
    } elseif ($daftar['jenjang_pendidikan'] == 'A') {
        $jenjang_pendidikan_full = 'MA';
    }
?>

<div class="row">
    <div class="col-sm-12 col-md-8 col-lg-10 mx-auto">
        <div class="card shadow-sm mt-5">
            <div class="card-header bg-primary text-white">
                <h4 class="font-weight-bold">Biaya yang Harus Dibayarkan</h4>
            </div>
            <div class="card-body">
                <h4><b><?php echo $nama; ?></b>, Anda masuk ke dalam jenjang pendidikan <b><?php echo $jenjang_pendidikan_full; ?></b> dengan metode pembayaran <b><i><?php echo $metode_pembayaran == 0 ? "LUNAS" : "CICILAN"; ?></i></b>:</h4>

                <?php if ($jenjang_pendidikan_full == 'MTS') { // MTS ?>

                    <?php if ($metode_pembayaran == 0) { ?>
                        <ol>
                            <li><b>MTS :</b></li>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Jenis Pengeluaran</th>
                                        <th class="text-right">Biaya</th>
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
                        </ol>
                    <?php } ?>

                <?php } elseif ($jenjang_pendidikan_full == 'MA') { // MA ?>

                    <?php if ($metode_pembayaran == 0) { ?>
                        <ol>
                            <li><b>MA :</b></li>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Jenis Pengeluaran</th>
                                        <th class="text-right">Biaya</th>
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
                        </ol>
                    <?php } ?>

                <?php } ?>

                <p>Lakukan pembayaran ke rekening XXX a.n XXX</p>
                <b>Lakukan konfirmasi di halaman konfirmasi pendaftaran</b>

                <h5 class="text-right">Tanggal Cetak: <b><?php echo date("Y-m-d"); ?></b></h5>
                
                <button class="btn btn-primary btn-md pull-right" id="cetak"><i class="fa fa-print"></i> Cetak</button>    
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .btn, .text-right {
            display: none; /* Sembunyikan tombol cetak saat print */
        }
        table {
            width: 100%; /* Pastikan tabel memenuhi halaman */
        }
    }
</style>

<script>
    document.getElementById('cetak').addEventListener('click', function () {
        window.print();
    });
</script>
