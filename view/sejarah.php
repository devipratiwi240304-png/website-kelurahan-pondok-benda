<?php 
$current_page = basename($_SERVER['PHP_SELF']);
include '../db/connection.php';
include 'template/header.php';
$sejarah = $conn->query("SELECT * FROM sejarah LIMIT 1")->fetch_assoc();

 ?>
     
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

     
<!-- header-start -->
 <style>
        .main-header-area {
            background-color: #2D336B; /* biru tua */
                padding: 1px 0; /* tambahkan ini agar tinggi header pas */

        }

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

            .main-menu nav ul#navigation {
            margin-left: -20px; /* Atur sesuai kebutuhan: -10px, -30px, dst */
}


        #navigation a:hover {
            background-color: #2D336B;
            border-radius: 3px;
        }
         <style>
        .main-header-area {
            background-color: #2D336B; /* biru tua */
        }

        #navigation a {
            color: white;
        }

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
            font-family: inherit; /* Wariskan font dari parent */
        }

        #navigation li:hover > ul.submenu {
            display: block;
        }

        #navigation ul.submenu li a {
            display: block;
            padding: 10px 15px;
            color: white;
            font-weight: 400; /* sesuai font normal website */
            font-family: inherit; /* wariskan font dari induk */
            text-decoration: none;
            white-space: nowrap;
        }

        #navigation ul.submenu li a:hover {
            background-color: #1A224D;
        }

        /* Posisi default untuk submenu */
        ul.submenu {
            position: absolute;
            left: 100%; /* muncul di kanan */
            top: 0;
            display: none;
            z-index: 999;
            background-color: #1a237e; /* warna dropdown submenu */
        }

        /* Ketika hover pada li induk */
        li:hover > ul.submenu {
            display: block;
        }

        /* Tambahan agar parent menu tidak rusak */
        li {
            position: relative;
        }

        <style>
    body {
      font-family: Arial, sans-serif;
      background: #2D336B;
      margin: 0;
      padding: 0;
    }

    .main-container {
      max-width: 1000px;
      margin: 30px auto;
      background: #2D336B;
      padding: 30px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 10px;
    }

    .section {
      margin-bottom: 30px;
      padding: 20px;
      border-radius: 8px;
      background-color: #FFF2F2;
      transition: transform 0.3s ease;
      cursor: pointer; /* kursor berubah saat hover */
    }

    .section:hover {
    transform: scale(1.03);
}

    .section h2 {
      color: #2c3e50;
      margin-bottom: 15px;
    }

    .section p, .section li {
      font-size: 16px;
      line-height: 1.6;
    }

    ul {
      padding-left: 20px;
    }
    /* Judul atau teks atas */
.section h2 {
  color: #000000/* Judul atau teks atas */
.section h2 {
  color: #000;
}

/* Isi teks di bawahnya */
.section p,
.section li {
  color: #343a40;
}
;
}

/* Isi teks di bawahnya */
.section p,
.section li {
  color: #343a40;
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
                        <h2 data-aos="fade-down" data-aos-duration="700">Sejarah Pondok Benda</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb-end -->


  <!-- service-area-start -->
<div class="service-area py-5" >
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div 
                    class="p-5 bg-white"
                    data-aos="fade-up"
                    style="
                        border: 2px solid #A9B5DF;
                        border-radius: 25px;
                        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
                    ">

                    <div class="text-center mb-4">
                        <span data-aos="fade-down" data-aos-delay="100" 
                              style="font-size: 20px; font-weight: 600; color: #000;">
                            Kelurahan Pondok Benda
                        </span>
                    </div>

                    <p data-aos="fade-up" data-aos-delay="200" 
                       style="font-size: 16px; line-height: 1.9; color: #333; text-align: justify;">
                        <?= nl2br(htmlspecialchars($sejarah['isi'])) ?>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>



        <!-- Container Visi Misi Motto -->
        <div class="main-container" style="margin-bottom: 60px;">
            <!-- VISI -->
            <div class="section">
                <h2>VISI</h2>
                <p><?= nl2br(htmlspecialchars($sejarah['visi'])) ?></p>
            </div>

            <!-- MISI -->
            <div class="section">
                <h2>MISI</h2>
                <ul>
                    <?php
                    $misiList = explode("\n", $sejarah['misi']);
                    foreach ($misiList as $misiItem) {
                        echo "<li>" . htmlspecialchars(trim($misiItem)) . "</li>";
                    }
                    ?>
                </ul>
            </div>

            <!-- MOTTO -->
            <div class="section">
                <h2>MOTTO</h2>
                <p><?= htmlspecialchars($sejarah['motto']) ?></p>
            </div>
        </div>
    </div>
</div>
<!-- service-area-end -->
</body>
</html> 

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
                            <li style="margin-left: -70px;">
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
            <small style="color: white;">Copyright by Kelurahan Pondok Benda Tangerang Selatan&copy;2025</small>
        </center>
    </div>
</footer>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
  duration: 500,
  once: false,
  mirror: true // WAJIB: agar animasi muncul lagi saat scroll dari bawah
});

</script>


<!-- Tambahkan CSS jika tidak pakai Bootstrap -->
<style>
    .text-white {
        color: white;
    }
    .mb-1 {
        margin-bottom: 4px;
    }
</style>
        <?php 
        include 'template/footer.php';
         ?>
    <!--end footer-->   