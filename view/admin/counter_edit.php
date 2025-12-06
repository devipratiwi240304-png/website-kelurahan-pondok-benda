<?php
include '../../db/connection.php';

// Update nilai saja
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);                  // pastikan ID adalah angka
    $nilai = trim($_POST['nilai']);              // hapus spasi di input
    mysqli_query($conn, "UPDATE counter_data SET nilai='$nilai' WHERE id=$id") or die(mysqli_error($conn));
    header("Location: counter_edit.php");
    exit;
}

// Ambil 3 data counter
$counters = mysqli_query($conn, "SELECT * FROM counter_data LIMIT 3");
$data = [];
while ($row = mysqli_fetch_assoc($counters)) {
    $data[] = $row;
}

// Label tetap untuk setiap form
$judulTetap = ['Jumlah Penduduk', 'Kepadatan Penduduk', 'Luas Wilayah'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Counter (Nilai Saja)</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            padding: 30px;
        }

        h2, h3 {
            color: #2D336B;
        }

        .counter-form {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            max-width: 600px;
        }

        .counter-form form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .counter-form input[type="number"] {
            padding: 8px;
            flex: 1 1 100px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .counter-form button {
            background-color: #2D336B;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 16px;
            cursor: pointer;
        }

        .counter-form button:hover {
            background-color: #1b204a;
        }

        .readonly-info {
            flex: 1 1 100%;
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        .hint {
            font-style: italic;
            color: darkred;
            font-size: 13px;
            margin-top: -5px;
            margin-bottom: 10px;
        }

        .back-link {
            display: inline-block;
            margin-top: 30px;
            text-decoration: none;
            background-color: #2D336B;
            color: #000;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .back-link:hover {
            background-color: #bbb;
        }
    </style>
</head>
<body>

<h2>Manajemen Nilai Counter</h2>

<?php for ($i = 0; $i < 3; $i++): ?>
    <div class="counter-form">
        <h3><?= $judulTetap[$i] ?? 'Data' ?></h3>
        <form method="post">
            <div class="readonly-info">
                Satuan: <?= htmlspecialchars($data[$i]['satuan'] ?? '-') ?> |
                Ikon: <?= htmlspecialchars($data[$i]['ikon'] ?? '-') ?>
            </div>
            <div class="hint">Masukkan angka tanpa titik atau simbol (contoh: <b>45679</b>)</div>
            <input type="number" name="nilai" value="<?= intval($data[$i]['nilai'] ?? 0) ?>" required>
            <input type="hidden" name="id" value="<?= $data[$i]['id'] ?? '' ?>">
            <button type="submit" name="update">Simpan</button>
        </form>
    </div>
<?php endfor; ?>

<a href="../admin_dashboard.php" class="back-link">← Kembali ke Dashboard</a>

</body>
</html>
