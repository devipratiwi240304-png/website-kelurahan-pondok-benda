<?php
session_start();
include '../../db/connection.php';

// Cek apakah baris id = 1 sudah ada
$check = $conn->query("SELECT id FROM peta WHERE id = 1");
if ($check->num_rows == 0) {
    $conn->query("INSERT INTO peta (id, nama_peta, embed_link, batas_utara, batas_selatan, batas_barat, batas_timur, kondisi_luas, kondisi_ketinggian, kondisi_curah, kondisi_bulan, kondisi_kelembaban, kondisi_suhu, kondisi_topografi) VALUES (1, '', '', '', '', '', '', '', '', '', '', '', '', '')");
}

$id = 1;

if (isset($_POST['simpan_lokasi'])) {
    $nama_peta = $_POST['nama_peta'] ?? '';
    $embed_link = $_POST['embed_link'] ?? '';
    $conn->query("UPDATE peta SET nama_peta='$nama_peta', embed_link='$embed_link' WHERE id=$id");
}

if (isset($_POST['hapus_lokasi'])) {
    $conn->query("UPDATE peta SET nama_peta='', embed_link='' WHERE id=$id");
}

$arah = ['utara', 'selatan', 'barat', 'timur'];
foreach ($arah as $a) {
    if (isset($_POST["simpan_batas_$a"])) {
        $val = $_POST[$a] ?? '';
        $conn->query("UPDATE peta SET batas_$a='$val' WHERE id=$id");
    }
}

$kondisi = ['luas', 'ketinggian', 'curah', 'bulan', 'kelembaban', 'suhu', 'topografi'];
foreach ($kondisi as $k) {
    if (isset($_POST["simpan_kondisi_$k"])) {
        $val = $_POST[$k] ?? '';
        $conn->query("UPDATE peta SET kondisi_$k='$val' WHERE id=$id");
    }
}

$result = $conn->query("SELECT * FROM peta WHERE id=$id");
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Peta Desa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <style>
        body {
            background-color: #FFF2F2;
            font-family: 'Segoe UI', sans-serif;
            color: #2D336B;
            padding-bottom: 50px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 30px 20px;
        }

        .box {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .box h2 {
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
        }

        button, a.btn-edit {
            background-color: #2D336B;
            color: #FFF2F2;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
            margin-right: 8px;
            margin-top: 10px;
            font-family: 'Segoe UI', sans-serif;
        }

        button:hover, a.btn-edit:hover {
            background-color: #A9B5DF;
            color: #2D336B;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #2D336B;
            color: white;
            text-align: center;
        }

        .btn-back {
            background-color: #2D336B;
            color: #FFF2F2;
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .btn-back:hover {
            background-color: #121a52;
            color: #FFF2F2;
        }

        table td {
            word-break: break-word;
            white-space: normal;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- FORM 1: LOKASI PETA -->
    <div class="box">
        <h2>Ubah Lokasi Peta</h2>
        <form method="POST">
            <label>Nama Peta:</label>
            <input type="text" name="nama_peta" value="<?= htmlspecialchars($data['nama_peta']) ?>" <?= isset($_GET['edit']) && $_GET['edit'] === 'lokasi' ? '' : 'readonly' ?> required>

            <label>Link Embed Google Maps:</label>
            <input type="text" name="embed_link" value="<?= htmlspecialchars($data['embed_link']) ?>" <?= isset($_GET['edit']) && $_GET['edit'] === 'lokasi' ? '' : 'readonly' ?> required>

            <?php if (isset($_GET['edit']) && $_GET['edit'] === 'lokasi'): ?>
                <button type="submit" name="simpan_lokasi">Simpan</button>
            <?php endif; ?>
        </form>

        <table>
            <tr>
                <th>Nama Peta</th>
                <th>Link Embed</th>
                <th>Aksi</th>
            </tr>
            <tr>
                <td><?= htmlspecialchars($data['nama_peta']) ?></td>
                <td><?= htmlspecialchars($data['embed_link']) ?></td>
                <td>
                    <a href="?edit=lokasi" class="btn-edit">Edit</a>
                    <form method="POST" style="display:inline-block" onsubmit="return confirm('Yakin ingin menghapus lokasi peta?')">
                        <input type="hidden" name="nama_peta" value="">
                        <input type="hidden" name="embed_link" value="">
                        <button type="submit" name="hapus_lokasi">Hapus</button>
                    </form>
                </td>
            </tr>
        </table>
    </div>

    <!-- FORM 2: KONDISI WILAYAH -->
    <div class="box">
        <h2>Kondisi Wilayah</h2>
        <form method="POST">
            <table>
                <tr><th>Parameter</th><th>Nilai</th><th>Aksi</th></tr>
                <?php
                $kondisiLabel = [
                    'luas' => 'LUAS WILAYAH',
                    'ketinggian' => 'KETINGGIAN',
                    'curah' => 'CURAH HUJAN',
                    'bulan' => 'JUMLAH BULAN HUJAN',
                    'kelembaban' => 'KELEMBABAN',
                    'suhu' => 'SUHU RATA – RATA HARIAN',
                    'topografi' => 'TOPOGRAFI'
                ];
                foreach ($kondisiLabel as $k => $label): ?>
                    <tr>
                        <td><?= $label ?></td>
                        <td><input type="text" name="<?= $k ?>" value="<?= htmlspecialchars($data["kondisi_$k"] ?? '') ?>"></td>
                        <td><button type="submit" name="simpan_kondisi_<?= $k ?>">Simpan</button></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </form>
    </div>

    <!-- FORM 3: BATAS-BATAS WILAYAH -->
    <div class="box">
        <h2>Batas-Batas Wilayah</h2>
        <form method="POST">
            <table>
                <tr><th>Arah</th><th>Deskripsi</th><th>Aksi</th></tr>
                <?php foreach ($arah as $a): ?>
                    <tr>
                        <td style="text-transform:uppercase;"><?= $a ?></td>
                        <td><input type="text" name="<?= $a ?>" value="<?= htmlspecialchars($data["batas_$a"] ?? '') ?>"></td>
                        <td><button type="submit" name="simpan_batas_<?= $a ?>">Simpan</button></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </form>
    </div>

    <a href="../admin_dashboard.php" class="btn-back">&larr; Kembali ke Dashboard</a>
</div>

</body>
</html>
