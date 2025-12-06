<!doctype html>
<html class="no-js" lang="zxx">
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sistem Informasi Desa</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    // Otomatis cek lokasi file agar path css/img tidak error
    $basePath = (basename($_SERVER['PHP_SELF']) == 'index.php') ? '' : '../';
    ?>

    <link rel="shortcut icon" type="image/x-icon" href="<?= $basePath ?>img/logo.png">

    <!-- CSS (autopath) -->
    <link rel="stylesheet" href="<?= $basePath ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $basePath ?>css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= $basePath ?>css/magnific-popup.css">
    <link rel="stylesheet" href="<?= $basePath ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= $basePath ?>css/themify-icons.css">
    <link rel="stylesheet" href="<?= $basePath ?>css/nice-select.css">
    <link rel="stylesheet" href="<?= $basePath ?>css/flaticon.css">
    <link rel="stylesheet" href="<?= $basePath ?>css/animate.css">
    <link rel="stylesheet" href="<?= $basePath ?>css/slicknav.css">
    <link rel="stylesheet" href="<?= $basePath ?>css/style.css">
    
</head>

<body>


<!-- HEADER START -->
<div class="header-wrapper">
    <header>
        <div class="header-area">
            <div id="sticky-header" class="main-header-area white-bg">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo-img">
                                <a href="#">
                                    <img src="<?= $basePath ?>img/logo.png" alt="Logo" width="55rem">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-7">
                            <div class="main-menu d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="<?= $basePath ?>index.php" class="<?= $current_page == 'index.php' ? 'active' : '' ?>">Home</a></li>
                                        <li><a href="<?= $basePath ?>view/galeri.php" class="<?= $current_page == 'galeri.php' ? 'active' : '' ?>">Galeri</a></li>
                                        <li><a href="<?= $basePath ?>view/sejarah.php" class="<?= $current_page == 'sejarah.php' ? 'active' : '' ?>">Sejarah</a></li>
                                        <li><a href="<?= $basePath ?>view/peta.php" class="<?= $current_page == 'peta.php' ? 'active' : '' ?>">Peta Desa</a></li>
                                         <li class="login-kanan ms-auto">
                                            <a href="<?= $basePath ?>view/admin_login.php" class="<?= $current_page == 'admin_login.php' ? 'active' : '' ?>">
                                                <i class="ti-user"></i> Login
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">Pelayanan <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <?php
                                                include $basePath . 'db/connection.php';
                                                $pelayanan = $conn->query("SELECT * FROM pelayanan");
                                                while ($row = $pelayanan->fetch_assoc()):
                                                    if (strtolower($row['nama']) !== 'formulir'):
                                                ?>
                                                <li>
                                                    <a href="<?= htmlspecialchars($row['link_web']) ?>" target="_blank">
                                                        <?= htmlspecialchars($row['nama']) ?>
                                                    </a>
                                                </li>
                                                <?php endif; endwhile; ?>
                                                <li>
                                                    <a href="<?= $basePath ?>view/formulir.php" class="<?= $current_page == 'formulir.php' ? 'active' : '' ?>">Formulir</a>
                                                </li>
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
</div>
