<?php 
$current_page = basename($_SERVER['PHP_SELF']);
include 'template/header.php';
include '../db/connection.php';

$result = mysqli_query($conn, "SELECT * FROM peta LIMIT 1");
$data = mysqli_fetch_assoc($result);

if (!$data) {
    $data = [
        'embed_link' => '',
        'batas_utara' => 'Data belum tersedia.',
        'batas_selatan' => 'Data belum tersedia.',
        'batas_barat' => 'Data belum tersedia.',
        'batas_timur' => 'Data belum tersedia.',
        'kondisi_luas' => 'Data belum tersedia.',
        'kondisi_ketinggian' => 'Data belum tersedia.',
        'kondisi_curah' => 'Data belum tersedia.',
        'kondisi_bulan' => 'Data belum tersedia.',
        'kondisi_kelembaban' => 'Data belum tersedia.',
        'kondisi_suhu' => 'Data belum tersedia.',
        'kondisi_topografi' => 'Data belum tersedia.'
    ];
}
?>

<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>
    .main-header-area {
        background-color: #2D336B;
    }

            /* Logo di Navbar */
.logo-img img {
    height: 55px;
    width: auto;
    margin-top: -45px;
    margin-bottom: 0px;
}

    #navigation a {
       color: white;
            text-decoration: none;
            padding: 4px 16px;
            height: 50px; 
            display: block;        }

    #navigation a:hover {
        background-color: #2D336B;
        border-radius: 3px;
    }

    #navigation ul.submenu {
        background-color: #2D336B;
        border-radius: 4px;
        padding: 0;
        margin: 0;
        list-style: none;
        position: absolute;
        display: none;
        z-index: 9999;
        font-family: inherit;
    }

    #navigation li:hover > ul.submenu {
        display: block;
    }

    #navigation ul.submenu li a {
        display: block;
        padding: 10px 15px;
        color: white;
        font-weight: 400;
        font-family: inherit;
        text-decoration: none;
        white-space: nowrap;
    }

    #navigation ul.submenu li a:hover {
        background-color: #1A224D;
    }

    ul.submenu {
        position: absolute;
        left: 100%;
        top: 0;
        display: none;
        z-index: 999;
        background-color: #1a237e;
    }

    li:hover > ul.submenu {
        display: block;
    }

    li {
        position: relative;
    }
    #navigation {
    position: relative;
}

#navigation .login-kanan {
    position: absolute;
    right: -200px;        /* geser 200px ke kanan */
    top: 50%;
    transform: translateY(-50%);
}

#navigation .login-kanan a i {
    margin-right: 2px;     /* jarak ikon ke teks */
    font-size: 16px;
}
</style>

<!-- breadcrumb-start -->
<section class="breadcrumb breadcrumb_bg banner-bg-1 overlay2 ptb200">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-1">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2 data-aos="fade-down" data-aos-duration="700">Peta Kelurahan Pondok Benda</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb-end -->

<!-- Start Align Area -->
<div class="whole-wrap">
    <div class="container box_1170">
        <div class="section-top-border">
            <!-- Judul Peta -->
            <h4 style="font-size: 28px; text-align: center; margin-bottom: 20px;">
                Peta Lokasi
            </h4>

            <!-- Lokasi Peta -->
            <div style="display: flex; justify-content: center;">
                <iframe src="<?= $data['embed_link']; ?>" width="900" height="500" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
</div>



            <!-- Kondisi Wilayah -->
     <!-- Kondisi Wilayah -->
<center data-aos="slide-up" data-aos-delay="100" data-aos-duration="700" data-aos-easing="ease-in-out">
    <h4 style="margin-top: 60px; font-size: 20px;">Kondisi Wilayah Kelurahan Pondok Benda</h4>
    <table style="margin-top: 25px; width: 80%; font-size: 15px; border-collapse: separate; border-spacing: 0; background-color: #fefefe; border: 1px solid rgba(0,0,0,0.2); border-radius: 10px; overflow: hidden;">
        <thead style="background-color: #2D336B; color: white;">
            <tr>
                <th style="padding: 12px; text-align: left; border-right: 1px solid rgba(255,255,255,0.2); border-bottom: 1px solid rgba(255,255,255,0.2);">Kategori</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.2);">Keterangan</th>
            </tr>
        </thead>
   <tbody style="color: #333;">
    <tr>
        <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);">Luas Wilayah</td>
        <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);"><?= $data['kondisi_luas'] ?></td>
    </tr>
    <tr>
        <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);">Ketinggian</td>
        <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);"><?= $data['kondisi_ketinggian'] ?></td>
    </tr>
    <tr>
        <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);">Curah Hujan</td>
        <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);"><?= $data['kondisi_curah'] ?></td>
    </tr>
    <tr>
        <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);">Jumlah Bulan Hujan</td>
        <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);"><?= $data['kondisi_bulan'] ?></td>
    </tr>
    <tr>
        <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);">Kelembaban</td>
        <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);"><?= $data['kondisi_kelembaban'] ?></td>
    </tr>
    <tr>
        <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);">Suhu Rata – Rata Harian</td>
        <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);"><?= $data['kondisi_suhu'] ?></td>
    </tr>
    <tr>
        <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);">Topografi</td>
        <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);"><?= $data['kondisi_topografi'] ?></td>
    </tr>
</tbody>

    </table>
</center>


<!-- Batas Wilayah -->
<div data-aos="slide-up" data-aos-delay="100" data-aos-duration="700" data-aos-easing="ease-in-out"
     style="text-align: center; margin-bottom: 100px;">
    
    <h4 style="margin-top: 60px; font-size: 20px;">
        Batas-Batas Wilayah Kelurahan Pondok Benda
    </h4>

    <table style="margin-top: 25px; width: 80%; margin-inline: auto; font-size: 15px; border-collapse: separate; border-spacing: 0; background-color: #fff; border: 1px solid rgba(0,0,0,0.2); border-radius: 10px; overflow: hidden;">
        <thead style="background-color: #2D336B; color: white;">
            <tr>
                <th style="padding: 12px; text-align: left; border-right: 1px solid rgba(255,255,255,0.2); border-bottom: 1px solid rgba(255,255,255,0.2);">Arah</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.2);">Batas Wilayah</th>
            </tr>
        </thead>
        <tbody style="color: #333;">
            <tr>
                <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);">Utara</td>
                <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);"><?= $data['batas_utara'] ?></td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);">Selatan</td>
                <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);"><?= $data['batas_selatan'] ?></td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);">Barat</td>
                <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);"><?= $data['batas_barat'] ?></td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);">Timur</td>
                <td style="padding: 10px; border: 1px solid rgba(0,0,0,0.1);"><?= $data['batas_timur'] ?></td>
            </tr>
        </tbody>
    </table>
</div>



<!-- footer-start -->
<footer class="footer-area bg-dark">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-sm-6 col-md-3 col-xl-4">
                <div class="single-footer-widget footer_1">
                    <a href="index.html">
                        <img src="../img/logo.png" alt="Logo" width="50rem">
                    </a>
                    <p class="text-white">
                        Kantor Kelurahan Pondok Benda<br>
                        Jalan Raya Siliwangi No. 1, Pamulang, Pd. Benda, Kota Tangerang Selatan, Banten<br>
                        15416
                    </p>

                    <!-- Sosial Media dihilangkan tapi struktur tetap -->
                    <div class="social-links">
                        <ul>
                            <!-- Sosial media dihapus -->
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Kontak -->
            <div class="col-sm-6 col-md-3 col-xl-3">
                <div class="single-footer-widget footer_icon">
                    <div class="office-location" style="color: white; margin-top: 55px;">
                        <ul>
                            <li style="margin-left: -50px;">
                                <strong style="color: white;"></strong><br>
                                Banten, Indonesia<br>
                                kelurahanpondokbenda24i5@gmail.com
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <center>
            <small style="color: white;">Copyright by Kelurahan Pondok Benda Tangerang Selatan &copy;2025</small>
        </center>
    </div>
</footer>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 400,
    once: false,
    mirror: true
  });
</script>


    </div>
</footer>
<?php 
include 'template/footer.php';
?>