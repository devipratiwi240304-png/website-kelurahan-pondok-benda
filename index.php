<?php
include 'db/connection.php'; // Pastikan koneksi database tersedia
$current_page = basename($_SERVER['PHP_SELF']);
$wilayah = $conn->query("SELECT * FROM wilayah LIMIT 1")->fetch_assoc();
$menuQuery = mysqli_query($conn, "SELECT * FROM navbar_menu");
$data = $conn->query("SELECT * FROM counter_data");
$formulir = $conn->query("SELECT * FROM formulir ORDER BY id DESC");
$menus = [];
if ($menuQuery) {
    while ($row = mysqli_fetch_assoc($menuQuery)) {
        $menus[] = $row;
    }
}

// Pisahkan menu utama dan submenu
$menuUtama = [];
$submenuMap = [];

foreach ($menus as $menu) {
    if ($menu['tipe_menu'] === 'utama') {
        $menuUtama[] = $menu;
    } elseif ($menu['tipe_menu'] === 'submenu') {
        $submenuMap[$menu['induk_menu']][] = $menu;
    }
}


?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Sistem Informasi Kelurahan Pondok Benda</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/magnific-popup.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/themify-icons.css" />
    <link rel="stylesheet" href="css/nice-select.css" />
    <link rel="stylesheet" href="css/flaticon.css" />
    <link rel="stylesheet" href="css/animate.css" />
    <link rel="stylesheet" href="css/slicknav.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/style1.css" />
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->

    <style>
        /* Bagian Header Utama */
.main-header-area {
    background-color: #2D336B; /* Biru tua */
        min-height: 90px; /* pastikan tinggi minimum */
            min-height: unset; /* hilangkan jika sebelumnya pakai min-height besar */


}

/* Logo di Navbar */
.logo-img img {
    height: 55px;
    width: auto;
    margin-top: -45px;
    margin-bottom: 0px;
}

/* Navigasi Link */
#navigation a {
    color: white;
    text-decoration: none;
    padding: 2px 16px;
     height: 50px; 
    display: block;
}

#navigation a:hover {
    background-color: #2D336B;
    border-radius: 3px;
}

/* Submenu Style */
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

/* Dropdown posisi submenu */
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

/* Navbar text style */
.navbar .nav-link,
.navbar .navbar-brand {
    color: white !important;
}

.navbar .nav-link:hover,
.navbar .navbar-brand:hover {
    color: #dddddd !important;
}

.navbar .nav-link {
    padding-top: 1rem;
    padding-bottom: 1rem;
    display: flex;
    align-items: center;
}

.navbar .navbar-brand {
    padding-top: 1rem;
    padding-bottom: 1rem;
    display: flex;
    align-items: center;
}

/* Dropdown menu */
.dropdown-menu {
    background-color: #2D336B;
}

.dropdown-menu .dropdown-item {
    color: white;
}

.dropdown-menu .dropdown-item:hover {
    background-color: #1f254d;
    color: white;
}

/* Padding pada header */
.main-header-area .row.align-items-center {
    padding-top: 5px;
    padding-bottom: 5px;
}

/* Marquee */
.marquee-box {
    width: 100%;
    overflow: hidden;
    background-color: #A9B5DF;
    border: 0px solid #ddd;
    padding: 10px 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.marquee-text {
    display: inline-block;
    white-space: nowrap;
    animation: marquee 15s linear infinite;
    font-size: 20px;
    font-weight: bold;
    color: white;
    padding-left: 100%;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
}

@keyframes marquee {
    0% {
        transform: translateX(0%);
    }

    100% {
        transform: translateX(-100%);
    }
}

/* Mencegah horizontal scroll */
body {
    overflow-x: hidden;
}

/* Geser sedikit ke kiri secara halus */
.custom-counter-row {
    transform: translateX(-67px); /* Bisa kamu ubah ke -10px atau -30px sesuai selera */
}

/* Agar counter tetap rata tengah dan tidak terlalu mepet */
.single-counter {
    text-align: center;
    padding: 10px;
}

/* Bungkus header + marquee jadi satu tinggi tetap */
.header-wrapper {
    background-color: #2D336B;
    min-height: 150px;
}

.marquee-box {
    width: 100%;
    overflow: hidden;
    background-color: #A9B5DF;
    padding: 10px 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.marquee-text {
    display: inline-block;
    white-space: nowrap;
    animation: marquee 15s linear infinite;
    font-size: 20px;
    font-weight: bold;
    color: white;
    padding-left: 100%;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
}
@keyframes marquee {
    0% { transform: translateX(0%); }
    100% { transform: translateX(-100%); }
}

/* Biar dummy box tidak ada teks tapi tinggi tetap */
.empty-marquee {
    visibility: hidden;
}


.uniform-hero {
    min-height: 400px; /* Sama seperti halaman 'Peta' yang ideal */
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
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
</head>
<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

<!-- HEADER + MARQUEE dibungkus -->
<div class="header-wrapper">
    <header>
        <div class="header-area">
            <div id="sticky-header" class="main-header-area white-bg">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo-img">
                                <a href="#"><img src="img/logo.png" alt="" width="55rem"></a>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-7">
                            <div class="main-menu d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="index.php" class="<?= $current_page == 'index.php' ? 'active' : '' ?>">Home</a></li>
                                        <li><a href="view/galeri.php" class="<?= $current_page == 'galeri.php' ? 'active' : '' ?>">Galeri</a></li>
                                        <li><a href="view/sejarah.php" class="<?= $current_page == 'sejarah.php' ? 'active' : '' ?>">Sejarah</a></li>
                                        <li><a href="view/peta.php" class="<?= $current_page == 'peta.php' ? 'active' : '' ?>">Peta Desa</a></li>
                                        
                                        <li>
                                            <a href="#">Pelayanan <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <!-- isi submenu -->
                                            </ul>
                         <li class="login-kanan">
                                <a href="view/admin_login.php"
                                class="<?= $current_page == 'admin_login.php' ? 'active' : '' ?>">
                                    <i class="ti-user"></i> Login
                                </a>
                            </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Marquee -->
    <div class="marquee-box">
        <div class="marquee-text">Selamat datang di Sistem Informasi Kelurahan Pondok Benda!</div>
    </div>
</div>


 <section class="breadcrumb breadcrumb_bg banner-bg-1 overlay2 ptb200">
    <div class="container">
        <div style="height: 100px;"></div> <!-- spacer kosong agar tinggi tetap -->
    </div>
</section>


    
<!-- service-area-start -->
<div class="service-area py-5" style="margin-bottom: 70px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div 
                    class="px-5 py-4 bg-white"
                    data-aos="fade-up"
                    style="
                        border: 2px solid #2D336B;
                        border-radius: 25px;
                        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
                        max-width: 100%;
                    ">

                    <div class="text-center mb-3">
                        <h3 style="color: #000; font-weight: 600; font-size: 22px;" data-aos="fade-down">
                            <?= htmlspecialchars($wilayah['judul']) ?>
                        </h3>
                        <hr style="border-top: 1px solid #ccc; width: 60px; margin: 10px auto;">
                    </div>

                    <p data-aos="fade-up" data-aos-delay="100" 
                       style="font-size: 16px; line-height: 1.9; color: #333; text-align: justify;">
                        <?= nl2br(htmlspecialchars($wilayah['isi'])) ?>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- service-area-end -->

<!-- counter-start -->
<div class="counter-area gray-bg">
    <div class="container">
        <div class="row text-center custom-counter-row"> <!-- Tambahkan class khusus -->
            <?php while($row = mysqli_fetch_assoc($data)): ?>
                <div class="col-xl-4 col-md-4 mb-4" data-aos="fade-up">
                <div class="single-counter">
                    <div class="icon">
                        <i class="fa <?= $row['ikon'] ?> fa-4x"></i>
                    </div>
                    <div class="counter-number">
                        <h3><span><?= $row['nilai'] ?></span><span> <?= $row['satuan'] ?></span></h3>
                        <p><?= $row['judul'] ?></p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>
<!-- counter-end -->

    
<?php
$apiKey = 'iI8miXU1J8cReJPRpMDbYgiTQRhUOiLO';
$location = 'Tangerang Selatan';
$url = "https://api.tomorrow.io/v4/weather/forecast?location=" . urlencode($location) . "&apikey=$apiKey&timesteps=1d&units=metric";

// Caching
$cacheFile = __DIR__ . '/cuaca_cache.json';
$cacheTime = 60 * 30; // 30 menit

if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $cacheTime) {
    $response = file_get_contents($cacheFile);
    $data = json_decode($response, true);
    $fromCache = true;
} else {
    $response = @file_get_contents($url);
    if ($response !== false) {
        file_put_contents($cacheFile, $response);
        $data = json_decode($response, true);
        $fromCache = false;
    } else {
        // fallback ke cache lama jika API error
        if (file_exists($cacheFile)) {
            $response = file_get_contents($cacheFile);
            $data = json_decode($response, true);
            $fromCache = true;
        } else {
            $data = null;
            $fromCache = true;
        }
    }
}

$hari = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
$forecastData = $data['timelines']['daily'] ?? [];

if (!empty($forecastData)) {
    $today = $forecastData[0]['values'];
    $suhu_min = $today['temperatureMin'] ?? 0;
    $suhu_max = $today['temperatureMax'] ?? 0;
    $feels_like = ($suhu_max + $suhu_min) / 2 + 1;
    $chance_rain = $today['precipitationProbabilityAvg'] ?? 0;
} else {
    // fallback default
    $suhu_min = 25;
    $suhu_max = 33;
    $feels_like = 30;
    $chance_rain = 10;
    $forecastData = array_fill(0, 6, [
        'time' => date('Y-m-d'),
        'values' => [
            'temperatureMax' => 33,
            'temperatureMin' => 25,
            'precipitationProbabilityAvg' => 10,
        ]
    ]);
}

function getWeatherSVG($rain) {
    if ($rain >= 60) return 'https://cdn-icons-png.flaticon.com/128/1163/1163624.png';
    if ($rain >= 30) return 'https://cdn-icons-png.flaticon.com/128/414/414825.png';
    if ($rain >= 10) return 'https://cdn-icons-png.flaticon.com/128/869/869869.png';
    return 'https://cdn-icons-png.flaticon.com/128/869/869869.png';
}

function getWeatherDesc($rain) {
    if ($rain >= 60) return 'Gerimis';
    if ($rain >= 30) return 'Berawan';
    if ($rain >= 10) return 'Cerah Berawan';
    return 'Cerah';
}

$weatherDesc = getWeatherDesc($chance_rain);
?>

<?php if ($fromCache): ?>

<?php endif; ?>

<div class="cuaca-box" data-aos="fade-up">
  <?php if ($chance_rain >= 30): ?>
  <div class="rain-animation"></div>
  <?php endif; ?>

  <div class="cuaca-header">
    <div class="left">
      <div class="label">
        <img src="https://cdn-icons-png.flaticon.com/128/684/684908.png" style="vertical-align: middle; margin-right: 6px; width: 20px;" />
        Pondok Benda, Pamulang, Tangsel
      </div>
    </div>
    <div class="right">
      <img src="<?= getWeatherSVG($chance_rain) ?>" class="cuaca-icon" style="width: 48px; margin-bottom: 8px;" />
      <h1><?= round(($suhu_min + $suhu_max) / 2, 1) ?>°</h1>
      <p><?= $weatherDesc ?> – Terasa seperti <?= round($feels_like, 1) ?>°</p>
      <small>Peluang hujan: <?= round($chance_rain) ?>%</small>
    </div>
  </div>

  <div class="cuaca-forecast">
    <?php for ($i = 0; $i < min(6, count($forecastData)); $i++):
      $f = $forecastData[$i]['values'];
      $tanggal = date('d', strtotime($forecastData[$i]['time']));
      $namahari = $hari[date('w', strtotime($forecastData[$i]['time']))];
      $icon = getWeatherSVG($f['precipitationProbabilityAvg']);
    ?>
    <div class="cuaca-hari">
      <div class="day"><?= strtoupper($namahari) . ' ' . $tanggal ?></div>
      <img src="<?= $icon ?>" class="cuaca-icon" />
      <div class="temp">↑ <?= round($f['temperatureMax']) ?>° ↓ <?= round($f['temperatureMin']) ?>°</div>
      <div class="rain"><?= round($f['precipitationProbabilityAvg']) ?>%</div>
    </div>
    <?php endfor; ?>
  </div>
</div>


<!-- CSS + Rintik Hujan -->
<style>
body {
  font-family: 'Segoe UI', sans-serif;
  overflow-x: hidden;
}
.cuaca-box {
  position: relative;
  max-width: 900px;
  margin: 60px auto;
  padding: 30px;
  background: #fff;
  border-radius: 20px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.1);
  overflow: hidden;
  z-index: 1;
}
.cuaca-header, .cuaca-forecast {
  position: relative;
  z-index: 2;
}
.cuaca-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-bottom: 20px;
  margin-bottom: 20px;
  border-bottom: 1px solid #ddd;
}
.cuaca-header .left {
  display: flex;
  align-items: center;
  gap: 14px;
}
.cuaca-header .label {
  font-size: 18px;
  font-weight: 600;
  color: #333;
}
.cuaca-header .right h1 {
  font-size: 48px;
  margin: 0;
  color: #222;
}
.cuaca-header .right p {
  margin: 4px 0;
  font-size: 16px;
  color: #555;
}
.cuaca-header .right small {
  font-size: 13px;
  color: #888;
}
.cuaca-forecast {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
  justify-content: space-around;
}
.cuaca-hari {
  background: #f1f1f1;
  border-radius: 10px;
  padding: 10px;
  text-align: center;
  width: 120px;
}
.cuaca-hari .day {
  font-size: 14px;
  margin-bottom: 5px;
}
.cuaca-hari .temp {
  font-weight: 500;
}
.cuaca-hari .rain {
  font-size: 12px;
  color: #666;
}
.cuaca-icon {
  width: 42px;
}

/* === Efek Rintik Hujan dari Internet === */
.rain-animation {
  position: absolute;
  top: 0; left: 0;
  width: 100%;
  height: 100%;
  z-index: 2;
  pointer-events: none;
  background-image: url('https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif');
  background-repeat: repeat;
  background-size: cover;
  opacity: 0.4;
}
</style>


 <!-- footer-start -->
<footer class="footer-area bg-dark">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-sm-6 col-md-3 col-xl-4">
                <div class="single-footer-widget footer_1">
                    <a href="index.html">
                        <img src="img/logo.png" alt="Logo" width="50rem">
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
                            <li style="margin-left: -40px;">
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


<!-- Tambahkan CSS jika tidak pakai Bootstrap -->
<style>
    .text-white {
        color: white;
    }
    .mb-1 {
        margin-bottom: 4px;
    }
</style>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

    <!-- JS here -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/scrollIt.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/nice-select.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins.js"></script>

    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>

    <script src="js/main.js"></script>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 800,    // durasi animasi dalam ms
    once: false,      // biar animasi bisa muncul lebih dari sekali
    mirror: true      // ini yang penting, agar animasi muncul juga saat scroll dari bawah
  });
</script>


</body>

</html>