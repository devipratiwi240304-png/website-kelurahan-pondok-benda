<?php
session_start();
include '../../db/connection.php';

// Tambah data
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $link_web = $_POST['link_web'];
    $conn->query("INSERT INTO pelayanan (nama, link_web) VALUES ('$nama', '$link_web')");
    header("Location: pelayanan_edit.php");
    exit;
}

// Update data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $link_web = $_POST['link_web'];
    $conn->query("UPDATE pelayanan SET nama='$nama', link_web='$link_web' WHERE id='$id'");
    header("Location: pelayanan_edit.php");
    exit;
}

// Hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM pelayanan WHERE id='$id'");
    header("Location: pelayanan_edit.php");
    exit;
}

// Ambil data untuk edit
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editData = $conn->query("SELECT * FROM pelayanan WHERE id='$id'")->fetch_assoc();
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Pelayanan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
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
        }

        header h1 {
            color: #FFF2F2;
            font-weight: bold;
        }

        .btn-back {
            background-color: #2D336B;
            color: #FFF2F2;
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #121a52;
            color: #FFF2F2;
        }

        label {
            font-weight: 500;
            margin-top: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
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
            background-color: #A9B5DF;
            color: #2D336B;
        }

        .table th {
            background-color: #2D336B;
            color: white;
            text-align: center;
        }

        .table td {
            vertical-align: middle;
            color: #2D336B;
        }

        a.btn-link {
            color: #2D336B;
            font-weight: 500;
            text-decoration: none;
            margin-right: 8px;
        }

        a.btn-link:hover {
            text-decoration: underline;
        }

        footer {
            margin-top: 40px;
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
            <h1>Manajemen Link Pelayanan</h1>
        </header>

        <!-- Form Tambah/Edit -->
        <h2><?= $editData ? 'Edit Link' : 'Tambah Link Baru' ?></h2>
        <form method="POST">
            <?php if ($editData): ?>
                <input type="hidden" name="id" value="<?= $editData['id'] ?>">
            <?php endif; ?>

            <label>Nama Pelayanan:</label>
            <input type="text" name="nama" value="<?= $editData['nama'] ?? '' ?>" required>

            <label>Link Website:</label>
            <input type="text" name="link_web" value="<?= $editData['link_web'] ?? '' ?>" required placeholder="https://...">

            <button type="submit" name="<?= $editData ? 'update' : 'tambah' ?>">
                <?= $editData ? 'Update' : 'Tambah' ?>
            </button>
        </form>

        <hr>

        <!-- Tabel Data -->
        <h2>Daftar Pelayanan</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelayanan</th>
                    <th>Link Website</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $data = $conn->query("SELECT * FROM pelayanan");
                while ($row = $data->fetch_assoc()):
                ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td class="text-center">
                        <a href="<?= htmlspecialchars($row['link_web']) ?>" target="_blank">Kunjungi</a>
                    </td>
                    <td class="text-center">
                        <a href="?edit=<?= $row['id'] ?>" class="btn-link">Edit</a>
                        <a href="?hapus=<?= $row['id'] ?>" class="btn-link" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>


        <div class="mt-4">
            <a href="../admin_dashboard.php" class="btn-back">← Kembali ke Dashboard</a>
        </div>
    </div>
</div>
</body>
</html>
