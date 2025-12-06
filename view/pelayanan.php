<?php 
include 'template/header.php';
include '../db/connection.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pelayanan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .main-header-area { background-color: #2D336B; }
        #navigation a { color: rgb(224, 224, 224); }
        #navigation a:hover { background-color: #3A4180; border-radius: 3px; }
        .form-list { padding: 50px 0; }
        .form-item { background: #fff; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); transition: 0.3s; }
        .form-item:hover { background: #e2e6ea; }
        .form-item h5 { margin-bottom: 10px; color: #2D336B; }
        .form-item a { color: #007bff; text-decoration: none; }
        .form-item a:hover { text-decoration: underline; }
        #navigation .submenu { background-color: #2D336B; }
        #navigation .submenu li a { color: white; }
        #navigation .submenu li a:hover { background-color: #1f2458; color: white; }
        .card { background: #fff; border-radius: 10px; padding: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .card-title { font-size: 1.25rem; font-weight: bold; margin-bottom: 15px; }
        .card-text { margin-bottom: 10px; }
        #persyaratan { margin-top: 80px; margin-bottom: 80px; display: none; }
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

<!-- Header -->
<header>
   <div class="header-area">
    <div id="sticky-header" class="main-header-area white-bg">
        <div class="container">
            <div class="row align-items-center">

                <!-- LOGO -->
                <div class="col-xl-2 col-lg-2">
                    <div class="logo-img">
                        <a href="#">
                            <img src="../img/logo.png" alt="" width="55rem">
                        </a>
                    </div>
                </div>

                <!-- MENU -->
                <div class="col-xl-7 col-lg-7">
                    <div class="main-menu d-none d-lg-block">
                        <nav>
                            <ul id="navigation">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="galeri.php">Galeri</a></li>
                                <li><a href="sejarah.php">Sejarah</a></li>
                                <li><a href="peta.php">Peta Desa</a></li>

                                <li>
                                    <a href="#">Pelayanan</a>
                                    <ul class="submenu">
                                        <!-- isi submenu -->
                                    </ul>
                                </li>

                                <!-- MENU LOGIN -->
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

            </div>
        </div>
    </div>
</div>

        <?php
        $pelayanan = $conn->query("SELECT * FROM pelayanan");
        while ($row = $pelayanan->fetch_assoc()):
        ?>
            <li>
                <a href="<?= htmlspecialchars($row['link_web']) ?>" target="_blank">
                    <?= htmlspecialchars($row['nama']) ?>
                </a>
            </li>
        <?php endwhile; ?>

        <li><a href="formulir.php">Formulir</a></li>
    </ul>
</li>

                                            <?php ; ?>
                                        </ul>
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

<!-- Breadcrumb Start -->
<section class="breadcrumb breadcrumb_bg banner-bg-1 overlay2 ptb200">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-1">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>Formulir Pelayanan</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tombol Tampilkan Persyaratan -->
<div class="container text-center my-4">
    <button onclick="showPersyaratan()" class="btn btn-primary">Lihat Persyaratan</button>
</div>

<!-- JavaScript -->
<script>
function showPersyaratan() {
    const info = document.getElementById("persyaratan");
    const isHidden = info.style.display === "none" || info.style.display === "";
    info.style.display = isHidden ? "block" : "none";

    if (isHidden) {
        setTimeout(() => {
            window.scrollTo({
                top: info.offsetTop - 120,
                behavior: 'smooth'
            });
        }, 100);
    }
}
</script>

<!-- Footer -->
<footer class="footer-area bg-dark">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-sm-6 col-md-3 col-xl-4">
                <div class="single-footer-widget footer_1">
                    <a href="#"><img src="../img/logo.png" alt="" width="50rem"></a>
                    <p class="text-white">Kantor Kelurahan Pondok Benda<br>
                        Jl. Raya Siliwangi No. 1, Pamulang, Tangerang Selatan, Banten <br>15416</p>
                    <div class="social-links">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-xl-3">
                <div class="single-footer-widget footer_icon">
                    <div class="office-location">
                        <ul>
                            <li><strong>Kontak</strong><br>+62 812-3456-7890</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <small>Copyright &copy; 2025 Kelurahan Pondok Benda</small>
    </div>
</footer>

<?php include 'template/footer.php'; ?>
</body>
</html>
