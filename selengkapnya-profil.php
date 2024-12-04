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
    <title>Website Ponpes Salafiyyah Al-Hidayah</title>
    <link rel="stylesheet" href="assets/css/style2.css">
</head>
<body>
<div class="container">
    <div class="section-title">
        <h2>Profil Ponpes Salafiyyah Al-Hidayah</h2>
    </div>
</div>

<div class="wrapper" style="width: 1100px; margin: auto; position: relative;">
    <!-- profil -->
    <section id="home" style="margin: auto; display: flex; justify-content: center; align-items: center; margin-bottom: 50px;">
        <div style="margin-right: 20px;">
            <img src="uploads/identitas/foto-ponpes.jpg" width="100%" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" alt="">
        </div>
        <div class="kolom" style="margin-top: 50px; margin-bottom: 50px;">
            <p class="deskripsi" style="font-size: 20px; font-weight: bold; font-family: 'comic sans ms'; color: #364f6b;">Sekolah agama di Jawa Tengah</p>
            <h2 style="font-family: 'comic sans ms'; font-weight: 800; font-size: 45px; margin-bottom: 20px; color: #364f6b; width: 100%; line-height: 50px;"><?= $d->nama ?></h2>
            <p><?= $d->tentang_sekolah ?></p>
        </div>
    </section>

    <!-- visi misi -->
    <section id="home" style="margin: auto; display: flex; justify-content: center; align-items: center; margin-bottom: 50px;">
        <div class="kolom" style="margin-top: 50px; margin-bottom: 50px;">
            <p class="deskripsi" style="font-size: 20px; font-weight: bold; font-family: 'comic sans ms'; color: #364f6b;">Visi dan Misi</p>
            <h2 style="font-family: 'comic sans ms'; font-weight: 800; font-size: 45px; margin-bottom: 20px; color: #364f6b; width: 100%; line-height: 50px;"><?= $d->nama ?></h2>
            <p>
                Visi dari pondok pesantren Al-Hidayah adalah berwawasan, Agama, Hafidz Al qur’an, dan ber-akhlaqul karimah, sedangkan misi 
                dari pondok pesantren Al-Hidayah adalah meningkatkan sumber daya manusia islami dan mengembangkan ilmu pengetahuan keagamaan
                dan mendidik menjadi kader yang Hafidz Al-qur’an dan ber-akhlaqul karimah
            </p>
        </div>
        <div style="margin-right: 15px;">
            <img src="uploads/identitas/foto-ponpes3.jpg" width="110%" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" alt="">
        </div>
    </section>

    <!-- letak geografis -->
    <section id="home" style="margin: auto; display: flex; justify-content: center; align-items: center; margin-bottom: 50px;">
        <div style="margin-right: 20px; flex-shrink: 0;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.052841303913!2d110.80078197374858!3d-6.763411866135103!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70dc9d98400007%3A0xf0075fdefa624937!2sPondok%20Pesantren%20Alhidayah!5e0!3m2!1sid!2sid!4v1724939761275!5m2!1sid!2sid" width="500" height="300" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="kolom" style="margin-top: 50px; margin-bottom: 50px;">
            <p class="deskripsi" style="font-size: 20px; font-weight: bold; font-family: 'comic sans ms'; color: #364f6b;">Letak Geografis</p>
            <h2 style="font-family: 'comic sans ms'; font-weight: 800; font-size: 45px; margin-bottom: 20px; color: #364f6b; width: 100%; line-height: 50px;">Ponpes Salafiyah Al-Hidayah</h2>
            <p>
                Pondok Pesantren Al-Hidayah berada tepat di dukuh Srabi Kidul desa Getassrabi Kecamatan Gebog Kudus Jawa tengah. Pondok 
                Pesantren Al-Hidayah masih satu kawasan dengan Madrasah Al-Hidayah karena Ponpes Al-Hidayah masih satu yayasan dengan 
                Madrasah Al-Hidayah.
            </p>
        </div>
    </section>


    <!-- pengelolaan -->
    <section id="home" style="margin: auto; display: flex; justify-content: center; align-items: center; margin-bottom: 50px;">
        <div class="kolom" style="margin-top: 50px; margin-bottom: 50px;">
            <p class="deskripsi" style="font-size: 20px; font-weight: bold; font-family: 'comic sans ms'; color: #364f6b;">Pengelolaan Ponpes</p>
            <h2 style="font-family: 'comic sans ms'; font-weight: 800; font-size: 45px; margin-bottom: 20px; color: #364f6b; width: 100%; line-height: 50px;"><?= $d->nama ?></h2>
            <p>
                Dalam pengelolaan Pondok Pesantren Al-Hidayah menganut menejemen Tradisional” dengan figure sentral seorang kyai. Artinya 
                segala kebijakan yang di ambil di konsultasikan dan mendapat persetujuan Pengasuh. Di bawah Pengasuh ada unsur Pembina dan 
                Pengurus harian. Dalam
            </p>
        </div>
        <div style="margin-right: 20px;">
            <img src="uploads/identitas/foto-ponpes2.jpg" width="100%" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" alt="">
        </div>
    </section>
</div>
</body>
</html>
