<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #FFF2F2;
            font-family: 'Segoe UI', sans-serif;
            color: #2D336B;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 30px 20px;
        }

        .box-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        header {
            background-color: #2D336B;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
        }

        header h1 {
            color: #FFF2F2;
            font-size: 1.8rem;
            font-weight: bold;
            margin: 0;
        }

        .logout-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            background-color: #FFF2F2;
            color: #2D336B;
            border: none;
            padding: 6px 14px;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #2D336B;
            color: #FFF2F2;
            border: 1px solid #FFF2F2;
        }

        .section-link .row {
            margin-bottom: 15px;
        }

        .section-link a {
            display: block;
            background-color: transparent;
            color: #2D336B;
            border: 2px solid #2D336B;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s ease;
            font-weight: 500;
        }

        .section-link a:hover {
            background-color: #2D336B;
            color: #FFF2F2;
        }

        footer {
            margin-top: 50px;
            text-align: center;
            font-size: 0.9rem;
            color: #2D336B;
            border-top: 1px solid #A9B5DF;
            padding-top: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="box-container">
        <header>
            <h1>Dashboard Admin - Kelurahan Pondok Benda</h1>
            <a href="logout.php" class="logout-btn">Logout</a>
        </header>

        <section class="section-link">
            <div class="row">
                <div class="col-md-4"><a href="admin/galeri_edit.php">Galeri</a></div>
                <div class="col-md-4"><a href="admin/sejarah_edit.php">Sejarah</a></div>
                <div class="col-md-4"><a href="admin/peta_edit.php">Peta Desa</a></div>
            </div>
            <div class="row mt-2">
                <div class="col-md-4"><a href="admin/pelayanan_edit.php">Pelayanan</a></div>
                <div class="col-md-4"><a href="admin/formulir_edit.php">Formulir</a></div>
                <div class="col-md-4"><a href="admin/wilayah_edit.php">Wilayah</a></div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4"><a href="admin/counter_edit.php">Counter</a></div>
            </div>
        </section>

        <footer>
            &copy; <?= date('Y') ?> Kelurahan Pondok Benda
        </footer>
    </div>
</div>
</body>
</html>
