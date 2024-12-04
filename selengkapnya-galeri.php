<?php
    include 'koneksi/koneksi.php';
    date_default_timezone_set("Asia/Jakarta");

    $identitas = mysqli_query($conn, "SELECT * FROM pengaturan ORDER BY id DESC LIMIT 1");
    $d         = mysqli_fetch_object($identitas);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website <?= $d->nama ?></title>
    <link rel="icon" href="uploads/identitas/<?= $d->favicon ?>">
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- font awesome/icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="assets/css/styles.css"/>
    <link rel="stylesheet" href="assets/css/style2.css">
</head>
<body>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container d-flex justify-content-center">
      <a class="navbar-brand js-scroll-trigger mx-auto" href="#page-top">Galeri Ponpes Salafiyyah Al-Hidayah</a>
    </div>
  </nav>

  <br><br><br>
  <div class="container">
    <div class="section-title">
      <h2>Galeri Selengkapnya</h2>
    </div>
    <?php
      $galeri = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");
      if(mysqli_num_rows($galeri) > 0){
        while($p = mysqli_fetch_array($galeri)){
    ?>
          <div class="section-item">
            <div class="row">
              <div class="col-md-6">
                <a href="detail-galeri.php?id=<?= $p['id'] ?>"><img class="section-item-thumbnail" src="uploads/galeri/<?= $p['foto'] ?>" alt=""></a>
              </div>
              <div class="col-md-6">
                <div class="section-item-title">
                  <h3><?= $p['judul']?></h3>
                  <div class="section-item-meta">
                    <?php $tanggal = date('d F Y', strtotime($p['tanggal'])); ?>   
                    <span><i class="far fa-calendar-alt"></i> <?= $tanggal ?> </span>
                    <span><i class="fas fa-map-marked-alt"></i> Kudus, Indonesia</span>
                  </div>
                </div>
                <div class="section-item-body">
                  <p>
                    <?= implode(' ', array_slice(str_word_count($p['keterangan'], 1), 0, 20)) ?>
                    <a href="detail-galeri.php?id=<?= $p['id'] ?>" class="more">[...]</a>
                  </p>
                </div>
              </div>  
            </div>
          </div>
    <?php }}else{ ?>
      Tidak ada data
    <?php } ?>
  </div> 

    <!-- Footer-->
    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <!-- Footer Location-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Telepon</h4>
                    <p class="lead mb-0"><?= $d->telepon ?></p>
                </div>
                <!-- Footer Social Icons-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Media Sosial</h4>
                    <a class="btn btn-outline-light btn-social mx-1" href="https://web.facebook.com/p/YAPIM-Pondok-Pesantren-Salafiyah-Al-Hidayah-Kudus-100063830271136/?locale=id_ID&_rdc=1&_rdr"><i class="fab fa-fw fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="https://www.instagram.com/ponpesalhidayahkudus/"><i class="fab fa-fw fa-instagram"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="https://www.tiktok.com/@ppalhidayah02kudus"><i class="fa-brands fa-tiktok"></i></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="https://www.youtube.com/@alhidayahkudus"><i class="fab fa-fw fa-youtube"></i></a>
                </div>
                <!-- Footer About Text-->
                <div class="col-lg-4">
                    <h4 class="text-uppercase mb-4">Alamat Sekolah</h4>
                    <p class="lead mb-0"><?= $d->alamat ?></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="container"><small><?= $d->nama ?> - 2024</small></div>
    </div>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
    <div class="scroll-to-top d-lg-none position-fixed">
        <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
    </div>
</body>
</html>