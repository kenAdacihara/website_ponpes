<?php
    include 'koneksi/koneksi.php';
    date_default_timezone_set("Asia/Jakarta");

    $identitas = mysqli_query($conn, "SELECT * FROM pengaturan ORDER BY id DESC LIMIT 1");
    $d         = mysqli_fetch_object($identitas);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Website <?= $d->nama ?></title>
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="assets/css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">

        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">Ponpes Al-Hidayah</a>
                <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#panduan">Panduan</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#profil">Profil</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#informasi">Informasi</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#program">Program</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#galeri">Galeri</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="login.php">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Masthead-->
        <header class="masthead text-white mb-0" id="panduan" style="position: relative; background: url('assets/img/ponpes.jpg') no-repeat center center; background-size: cover;">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);"></div>
            <div class="container" style="position: relative; z-index: 1;">
                <!-- About Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-white" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">Panduan Pendaftaran</h2>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- About Section Content-->
                <div class="row">
                    <div class="col-lg-4 ml-auto"><p class="lead" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">Yayasan Pendidikan Islam Pondok Pesantren Salafiyah Al-Hidayah Kudus atau biasa di singkat YAPIM PON. Pendaftaran akan dibuka untuk tahun ajaran 2024-2025.</p></div>
                    <div class="col-lg-4 mr-auto"><p class="lead" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">Langkah pertama mendaftar adalah klik tombol daftar, jika belum memiliki akun, harap register terlebih dahulu. Lalu login dan lengkapi data dan berkas yang diminta.</p></div>
                </div>
                <!-- About Section Button-->
                <div class="text-center mt-4">
                    <a class="btn btn-xl btn-outline-light" href="login.php">
                        Daftar
                    </a>
                </div>
            </div>
        </header>

        <!-- Profil Section-->
        <section class="page-section profil" id="profil">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="video-wrapper">
                            <iframe width="100%" height="315" src="https://www.youtube.com/embed/Zde5_g9Rbc4?si=-wt1HBU3gtT16LuT" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="sambutan-content">
                            <h2 class="page-section-heading text-center text-secondary"><?= $d->nama ?></h2>
                            <p class="lead"><?= $d->tentang_sekolah ?> [.....]</p>
                            <a href="selengkapnya-profil.php" class="btn btn-utama">Baca Selengkapnya</a>
                        </div>
                    </div>
                    <div class="col-12 sambutan-kepsek">
                        <img src="uploads/identitas/<?= $d->foto_kepsek ?>" alt="Foto Ketua Ponpes" class="img-fluid rounded mb-4" style="border-radius: 10px; width: 200px; height: 200px; object-fit: cover;">
                        <h3 class="display-5 font-weight-bold mb-3">Sambutan dari Ketua Ponpes</h3>
                        <h4 class="text-success font-weight-bold mb-4"><?= $d->nama_kepsek ?></h4>
                        <p class="lead text-center">
                            Assalamu'alaikum Warahmatullahi Wabarakatuh
                            <br><br><?= $d->sambutan_kepsek ?><br><br>
                            Wassalamu'alaikum Warahmatullahi Wabarakatuh
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Informasi Terbaru Section-->
        <section class="page-section informasi" id="informasi">
            <div class="container">
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Informasi Terbaru</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <?php
                    $informasi = mysqli_query($conn, "SELECT * FROM informasi ORDER BY id DESC LIMIT 3");
                    $counter = 0; // Inisialisasi penghitung
                    if(mysqli_num_rows($informasi) > 0){
                        while($p = mysqli_fetch_array($informasi)){
                        // Hanya tampilkan jika belum mencapai 6 berita
                        if($counter < 6){
                            // Tampilkan konten berita disini
                ?>
                <div class="section-item">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="detail-informasi.php?id=<?= $p['id'] ?>"><img class="section-item-thumbnail" src="uploads/informasi/<?= $p['gambar'] ?>" alt=""></a>
                        </div>
                        <div class="col-md-6">
                            <div class="section-item-title">
                                <h3><?= $p['judul'] ?></h3>
                                <div class="section-item-meta">
                                    <span><i class="far fa-calendar-alt"></i> <?= date('d F Y', strtotime($p['tanggal'])) ?> </span>
                                    <span><i class="fas fa-map-marked-alt"></i> Kudus, Indonesia</span>
                                </div>
                            </div>
                            <div class="section-item-body">
                                <p>
                                    <?= implode(' ', array_slice(str_word_count($p['keterangan'], 1), 0, 20)) ?>
                                    <a href="detail-informasi.php?id=<?= $p['id'] ?>" class="more">[...]</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                            $counter++; // Tambahkan penghitung setiap kali berita ditampilkan
                        } else {
                            break; // Hentikan loop setelah mencapai 6 berita
                        }
                    }
                    } else {
                        echo 'Tidak ada data';
                    }
                ?>
                <div class="tombol-selengkapnya">
                    <a href="selengkapnya-informasi.php" class="btn btn-lainnya">Lihat Informasi Lainnya</a>
                </div>
            </div>
        </section>

        <!-- Tenaga Pengajar Section-->
        <section class="page-section portfolio" id="program">
            <div class="container">
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Tenaga Pengajar</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <?php
                    $guru = mysqli_query($conn, "SELECT * FROM guru ORDER BY id DESC");
                    if(mysqli_num_rows($guru) > 0){
                ?>
                <!-- Portfolio Grid Items-->
                <div class="row">
                    <?php
                        while($p = mysqli_fetch_array($guru)){
                            $modalId = "portfolioModal" . $p['id']; // ID modal unik untuk setiap guru
                    ?>
                    <!-- Portfolio Item -->
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#<?= $modalId ?>">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="uploads/guru/<?= $p['foto'] ?>" alt="Tenaga Pengajar" style="width: 100%; height: 400px; object-fit: cover;"/>
                        </div>
                    </div>

                    <!-- Portfolio Modal -->
                    <div class="portfolio-modal modal fade" id="<?= $modalId ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $modalId ?>Label" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                </button>
                                <div class="modal-body text-center">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-8">
                                                <!-- Portfolio Modal - Title-->
                                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="<?= $modalId ?>Label"><?= $p['nama'] ?></h2>
                                                <!-- Icon Divider-->
                                                <div class="divider-custom">
                                                    <div class="divider-custom-line"></div>
                                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                                    <div class="divider-custom-line"></div>
                                                </div>
                                                <!-- Portfolio Modal - Image-->
                                                <img class="img-fluid rounded mb-5" src="uploads/guru/<?= $p['foto'] ?>" alt="Tenaga Pengajar"/>
                                                <!-- Portfolio Modal - Text-->
                                                <p class="mb-5"><?= $p['nama'] ?></p>
                                                <button class="btn btn-primary" data-dismiss="modal">
                                                    <i class="fas fa-times fa-fw"></i>
                                                    Close Window
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                        }
                    ?>
                </div>
                <?php
                    } else {
                        echo 'Tidak ada data';
                    }
                ?>
            </div>
        </section>

        <!-- Galeri Section-->
        <section class="page-section galeri" id="galeri">
            <div class="container">
                <!-- Galeri Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Galeri</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <?php
                    $galeri = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC LIMIT 6");
                    $counter = 0; // Inisialisasi penghitung
                    if(mysqli_num_rows($galeri) > 0){
                ?>
                <div class="section-body">
                    <div class="row">
                    <?php
                        while($p = mysqli_fetch_array($galeri)){
                        // Hanya tampilkan jika belum mencapai 6 berita
                        if($counter < 6){
                            // Tampilkan konten berita disini
                    ?>
                        <div class="col-md-4"><br><br>
                            <div class="section-thumbnail">
                                <a href="detail-galeri.php?id=<?= $p['id'] ?>"><img src="uploads/galeri/<?= $p['foto'] ?>" alt="Video Profil Al-Achsaniyyah"></a>
                                <div class="tanggal">
                                    <?php
                                        $tanggal = date('d', strtotime($p['tanggal'])); // Mengambil tanggal dalam format dua digit (01-31)
                                        $bulan = date('F', strtotime($p['tanggal'])); // Mengambil bulan dalam format teks penuh (January-December)
                                        $tahun = date('Y', strtotime($p['tanggal'])); // Mengambil tahun dalam format empat digit
                                    ?>
                                        <span class="tgl"><?= $tanggal ?></span>
                                        <span class="tgl-2"><?= $bulan . ', ' . $tahun ?></span>
                                </div>
                            </div>
                            <div class="section-content">
                                <a href="detail-galeri.php"><h3>Al-Achsaniyyah</h3></a>
                                <p>
                                    <?= implode(' ', array_slice(str_word_count($p['keterangan'], 1), 0, 15)) ?>
                                    <a href="detail-galeri.php?id=<?= $p['id'] ?>" class="more">[...]</a>
                                </p>     
                            </div>
                            <div class="section-meta">
                                <a href="detail-galeri.php?id=<?= $p['id'] ?>">Kegiatan</a>
                                <a href="#profil"><i class="fas fa-user"></i> Administrator</a>
                            </div>
                        </div>
                        <?php
                                    $counter++; // Tambahkan penghitung setiap kali berita ditampilkan
                                } else {
                                    break; // Hentikan loop setelah mencapai 6 berita
                                }
                            }
                        ?>
                    </div>
                </div>
                <?php
                    } else {
                        echo 'Tidak ada data';
                    }
                ?>
                <div class="tombol-selengkapnya">
                    <a href="selengkapnya-galeri.php" class="btn btn-lainnya">Lihat Galeri Lainnya</a>
                </div>
            </div>
        </section>

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

        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Contact form JS-->
        <script src="assets/mail/jqBootstrapValidation.js"></script>
        <script src="assets/mail/contact_me.js"></script>
        <!-- Core theme JS-->
        <script src="assets/js/scripts.js"></script>
    </body>
</html>