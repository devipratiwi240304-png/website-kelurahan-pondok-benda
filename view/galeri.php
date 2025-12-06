<?php 
session_start();
$current_page = basename($_SERVER['PHP_SELF']);
include 'template/header.php';
include '../db/connection.php'; // koneksi ke database

if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $result = mysqli_query($conn, "SELECT gambar FROM galeri WHERE id = $id");
    if ($result && $data = mysqli_fetch_assoc($result)) {
        $file_path = "../img/galeri/" . $data['gambar'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        mysqli_query($conn, "DELETE FROM galeri WHERE id = $id");
        echo "<script>alert('Gambar berhasil dihapus!'); window.location.href='galeri.php';</script>";
        exit();
    } else {
        echo "<script>alert('Data tidak ditemukan!');</script>";
    }
}

if (isset($_GET['hapus'])) {
    if (!isset($_SESSION['admin'])) {
        header("Location: admin_login.php");
        exit();
    }

    $id = intval($_GET['hapus']);
    $result = mysqli_query($conn, "SELECT gambar FROM galeri WHERE id = $id");
    if ($result && $data = mysqli_fetch_assoc($result)) {
        $file_path = "../img/galeri/" . $data['gambar'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        mysqli_query($conn, "DELETE FROM galeri WHERE id = $id");
        echo "<script>alert('Gambar berhasil dihapus!'); window.location.href='galeri.php';</script>";
        exit();
    } else {
        echo "<script>alert('Data tidak ditemukan!');</script>";
    }
}


$galeri = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");
?>

<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Galeri Kelurahan</title>
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

        .galeri-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 50px;
            margin-bottom: 60px;
            justify-content: space-between;
        }

        .left-panel {
            flex: 1;
            min-width: 350px;
            max-width: 50%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .additional-photos {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .photo-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .photo-item img {
            width: 100%;
            aspect-ratio: 4/3;
            object-fit: cover;
            border-radius: 10px;
        }

        .photo-item span {
            margin-top: 5px;
            font-size: 14px;
            font-weight: bold;
            color: #333;
            text-align: center;
        }

        .right-panel {
            flex: 0 0 320px;
            background-color: #6e83d1;
            border-radius: 30px;
            padding: 20px;
            color: white;
            display: flex;
            flex-direction: column;
            max-height: 725px;
            overflow: hidden;
        }

        .right-panel h2 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 15px;
        }

        .news-list {
            flex: 1;
            overflow-y: auto;
        }

        .news-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 20px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 10px;
            color: #007BFF; /* biru link */

        }

        .news-item img {
            width: 100%;
            border-radius: 8px;
            object-fit: cover;
            aspect-ratio: 4/3;
            margin-bottom: 10px;
        }

        .news-item a {
            color: #cce0ff;
            text-decoration: none;
            font-weight: bold;
            transition: 0.2s ease-in-out;
        }

        .news-item a:hover {
            color: #ffffff;
            text-decoration: underline;
            color: #0056b3; /* biru lebih gelap saat hover */

        }

        .news-list::-webkit-scrollbar {
            width: 6px;
        }

        .news-list::-webkit-scrollbar-thumb {
            background-color: #ffffff80;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .galeri-container {
                flex-direction: column;
            }

            .right-panel {
                flex: 1;
                margin-top: 20px;
                max-height: none;
                height: auto;
            }

            .additional-photos {
                grid-template-columns: 1fr;
            }
        }
   

.additional-photos {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 20px; /* Jarak antar gambar */
}

.photo-item {
    background: #fdfdfd;
    border-radius: 12px;
    padding: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    transition: transform 0.3s ease;
    text-align: center;
}

.photo-item:hover {
    transform: scale(1.03);
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

<!-- Breadcrumb -->
<section class="breadcrumb breadcrumb_bg banner-bg-1 overlay2 ptb200">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-1">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2 data-aos="fade-down" data-aos-duration="700">Galeri Kelurahan Pondok Benda</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Konten Galeri -->
<div class="container galeri-container">
    <!-- Panel kiri -->
    <div class="left-panel">
    <h3 style="text-align:center; font-size: 22px; font-weight: 600; margin-bottom: 10px; color:#000000;">Galeri Foto</h3>
        <div class="additional-photos">
            <?php
            $counter = 1;
            while ($row = mysqli_fetch_assoc($galeri)):
                $gambarPath = "img/galeri/" . $row['gambar'];
                $judul = htmlspecialchars($row['judul']);
            ?>
                <div class="photo-item">
            <?php if (!empty($row['gambar']) && file_exists($gambarPath)): ?>
                <img src="<?= $gambarPath ?>" alt="<?= $judul ?>">
            <?php else: ?>
                <div style="width:100%; height:150px; background:#eee; border-radius:10px; display:flex; align-items:center; justify-content:center;">
            <span>Tidak ada gambar</span>
        </div>
     <?php endif; ?>
    <span><?= $judul ?></span>
</div>

            <?php 
                $counter++;
            endwhile;

            // Jika jumlah gambar < 4, tampilkan placeholder agar layout tetap rapi
            while ($counter <= 4):
            ?>
                <div class="photo-item">
                    <div style="width:100%; height:150px; background:#eee; border-radius:10px; display:flex; align-items:center; justify-content:center;">
                        <span>Tidak ada gambar</span>
                    </div>
                    <span>Gambar tidak tersedia</span>
                </div>
            <?php 
                $counter++;
            endwhile;
            ?>
        </div>
    </div>


    <!-- Panel kanan (NEWS) -->
    <div class="right-panel">
        <h2>NEWS</h2>
        <div class="news-list">
            <?php
            include '../db/connection.php';
            $berita = mysqli_query($conn, "SELECT * FROM berita ORDER BY id DESC LIMIT 5");
            while ($row = mysqli_fetch_assoc($berita)):
            ?>
            <div class="news-item">
            <img src="img/berita/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['judul']) ?>">
            <a href="<?= htmlspecialchars($row['link']) ?>" target="_blank"><?= htmlspecialchars($row['judul']) ?></a>
    </div>
            <?php endwhile; ?>
        </div>
    </div>
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
                            <li>
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
<script>AOS.init();</script>

<!-- Tambahkan CSS jika tidak pakai Bootstrap -->
<style>
    .text-white {
        color: white;
    }
    .mb-1 {
        margin-bottom: 4px;
    }
</style>
<?php include 'template/footer.php'; ?>
</body>
</html>
