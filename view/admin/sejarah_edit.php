<?php
session_start();
include '../../db/connection.php';

// Ambil data satu baris (karena kita hanya pakai 1 set sejarah, bukan banyak baris)
$data = $conn->query("SELECT * FROM sejarah LIMIT 1")->fetch_assoc();
$id = $data['id'] ?? null;

// Proses update per bagian
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['simpan_sejarah'])) {
        $isi = $_POST['isi'];
        if ($id) {
            $conn->query("UPDATE sejarah SET isi='$isi' WHERE id='$id'");
        } else {
            $conn->query("INSERT INTO sejarah (isi) VALUES ('$isi')");
        }
    }

    if (isset($_POST['simpan_visi'])) {
        $visi = $_POST['visi'];
        if ($id) {
            $conn->query("UPDATE sejarah SET visi='$visi' WHERE id='$id'");
        } else {
            $conn->query("INSERT INTO sejarah (visi) VALUES ('$visi')");
        }
    }

    if (isset($_POST['simpan_misi'])) {
        $misi = $_POST['misi'];
        if ($id) {
            $conn->query("UPDATE sejarah SET misi='$misi' WHERE id='$id'");
        } else {
            $conn->query("INSERT INTO sejarah (misi) VALUES ('$misi')");
        }
    }

    if (isset($_POST['simpan_motto'])) {
        $motto = $_POST['motto'];
        if ($id) {
            $conn->query("UPDATE sejarah SET motto='$motto' WHERE id='$id'");
        } else {
            $conn->query("INSERT INTO sejarah (motto) VALUES ('$motto')");
        }
    }

    header("Location: sejarah_edit.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Sejarah</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <style>
        body {
            background-color: #FFF2F2;
            font-family: 'Segoe UI', sans-serif;
            color: #2D336B;
            margin: 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        header {
            background-color: #2D336B;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        header h1 {
            color: #FFF2F2;
            font-weight: bold;
        }

        h3 {
            margin-top: 30px;
        }

        textarea, input[type="text"] {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
        }

        button {
            background-color: #2D336B;
            color: #FFF2F2;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
        }

        button:hover {
            background-color: #1a2250;
        }

        .btn-back {
            background-color: #2D336B;
            color: #FFF2F2;
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            margin-top: 40px;
        }

        .btn-back:hover {
            background-color: #121a52;
        }

        hr {
            border-top: 1px solid #ccc;
        }
    </style>
</head>
<body>
<div class="container">
    <header>
        <h1>Manajemen Konten Sejarah</h1>
    </header>

    <!-- Form Sejarah -->
    <form method="POST">
        <h3>Isi Sejarah</h3>
        <textarea name="isi" rows="6"><?= $data['isi'] ?? '' ?></textarea>
        <button type="submit" name="simpan_sejarah">Simpan Sejarah</button>
    </form>

    <hr>

    <!-- Form Visi -->
    <form method="POST">
        <h3>Visi</h3>
        <textarea name="visi" rows="4"><?= $data['visi'] ?? '' ?></textarea>
        <button type="submit" name="simpan_visi">Simpan Visi</button>
    </form>

    <hr>

    <!-- Form Misi -->
    <form method="POST">
        <h3>Misi</h3>
        <textarea name="misi" rows="6"><?= $data['misi'] ?? '' ?></textarea>
        <button type="submit" name="simpan_misi">Simpan Misi</button>
    </form>

    <hr>

    <!-- Form Motto -->
    <form method="POST">
        <h3>Motto</h3>
        <input type="text" name="motto" value="<?= $data['motto'] ?? '' ?>">
        <button type="submit" name="simpan_motto">Simpan Motto</button>
    </form>

    <a href="../admin_dashboard.php" class="btn-back">← Kembali ke Dashboard</a>
</div>
</body>
</html>
