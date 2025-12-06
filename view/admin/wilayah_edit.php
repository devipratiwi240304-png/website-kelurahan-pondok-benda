<?php
session_start();
include '../../db/connection.php';

// Ambil data awal dari database
$data = $conn->query("SELECT * FROM wilayah LIMIT 1")->fetch_assoc();
$id = $data['id'] ?? null;

// Proses form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'] ?? '';
    $isi = $_POST['isi'] ?? '';

    if ($id) {
        $conn->query("UPDATE wilayah SET judul='$judul', isi='$isi' WHERE id='$id'");
    } else {
        $conn->query("INSERT INTO wilayah (judul, isi) VALUES ('$judul', '$isi')");
    }

    // Ambil ulang data setelah update agar tetap tampil
    $data = $conn->query("SELECT * FROM wilayah LIMIT 1")->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Deskripsi Wilayah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <style>
        body {
            background-color: #FFF2F2;
            font-family: 'Segoe UI', sans-serif;
            color: #2D336B;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
        }

        .section-box {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 25px 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .section-box h2 {
            background-color: #2D336B;
            color: #FFF2F2;
            padding: 15px 20px;
            border-radius: 10px;
            font-size: 22px;
            margin-top: 0;
            margin-bottom: 25px;
        }

        label {
            font-weight: 500;
            margin-top: 10px;
            display: block;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .button-group button,
        .button-group a {
            background-color: #2D336B;
            color: #FFF2F2;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            font-size: 16px;
            text-decoration: none;
            text-align: center;
            transition: 0.3s ease;
            width: 150px;
        }

        .button-group button:hover,
        .button-group a:hover {
            background-color: #A9B5DF;
            color: #2D336B;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="section-box">
        <h2>Edit Deskripsi Wilayah Pondok Benda</h2>
        <form method="post">
            <label for="judul">Judul Wilayah</label>
            <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($data['judul'] ?? '') ?>" required>

            <label for="isi">Deskripsi Wilayah</label>
            <textarea id="isi" name="isi" rows="10" required><?= htmlspecialchars($data['isi'] ?? '') ?></textarea>

            <div class="button-group">
                <button type="submit">Simpan</button>
                <a href="../admin_dashboard.php">← Kembali</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
