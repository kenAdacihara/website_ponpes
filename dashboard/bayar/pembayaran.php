<!-- Page Heading -->
<h3 class="text-center text-primary mt-3">Selamat Datang di Halaman Konfirmasi Pendaftaran</h3>

<?php  
    // Cek apakah pengguna sudah login (auth session ada)
    if (!isset($_SESSION['auth'])) {
        echo '<div class="alert alert-danger" role="alert">User tidak ditemukan. Silakan login terlebih dahulu.</div>';
        exit; // Hentikan eksekusi jika user tidak login
    }
    
    $id_user = $_SESSION['auth']; // Ambil ID user dari session
    
    // Koneksi ke database
    include '../koneksi/koneksi.php'; 
    
    // Query untuk mengambil detail pendaftaran dan jenjang pendidikan
    $query = " SELECT *, jenis_kelamin FROM pendaftaran WHERE id = $id_user; ";
    $exec = mysqli_query($conn, $query);
    
    // Cek apakah query berhasil dieksekusi dan ada data
    if ($exec && mysqli_num_rows($exec) > 0) {
        $daftar = mysqli_fetch_assoc($exec); // Ambil data pendaftaran
    } else {
        echo '<div class="alert alert-danger" role="alert">Gagal mengambil data pendaftaran: ' . mysqli_error($conn) . '</div>';
        exit;
    }

    // Tentukan nama jenis kelamin untuk ditampilkan
    $jenis_kelamin_full = ($daftar['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan';

    // Data biaya berdasarkan jenis kelamin, tanpa mengubah variabel jenis_kelamin_full
    if ($daftar['jenis_kelamin'] == 'L') { // Laki-laki
        $biaya = [
            ['Infaq Santri Baru Pondok', 150000],
            ['Seragam Pondok Putra', 350000],
            ['Biaya Makan Per Minggu', 60000],
            ['SPP Per-Bulan', 40000],
            ['Almari', 300000],
        ];
    } else { // Perempuan
        $biaya = [
            ['Infaq Santri Baru Pondok', 150000],
            ['Seragam Pondok Putri', 400000],
            ['Biaya Makan Per Minggu', 60000],
            ['SPP Per-Bulan', 40000],
            ['Almari', 300000],
        ];
    }

    // Hitung total biaya
    $total_biaya = array_sum(array_column($biaya, 1));
?>

<!-- Tampilan Halaman Pembayaran -->
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="font-weight-bold mb-0">Konfirmasi Pembayaran</h4>
        </div>
        <div class="card-body">
            <h5><b><?php echo $jenis_kelamin_full; ?></b></h5>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Jenis Pengeluaran</th>
                        <th class="text-right">Biaya (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($biaya as $item): ?>
                    <tr>
                        <td><?php echo $item[0]; ?></td>
                        <td class="text-right"><?php echo number_format($item[1], 0, ',', '.'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th class="text-center">Total</th>
                        <th class="text-right"><?php echo number_format($total_biaya, 0, ',', '.'); ?></th>
                    </tr>
                </tbody>
            </table>

            <button class="btn btn-primary btn-md mt-3" id="cetak"><i class="fa fa-print"></i> Cetak dan Bayar</button>
        </div>
    </div>
</div>

<!-- Script Midtrans -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="YOUR_CLIENT_KEY"></script>
<script>
    document.getElementById('cetak').addEventListener('click', function () {
        // Inisiasi transaksi ke Midtrans
        fetch('proses_pembayaran.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ total: <?php echo $total_biaya; ?> })
        })
        .then(response => response.json())
        .then(data => {
            snap.pay(data.token); // Buka payment gateway Midtrans
        })
        .catch(error => console.error('Error:', error));
    });
</script>
