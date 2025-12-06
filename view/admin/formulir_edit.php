<?php
session_start();
include '../../db/connection.php';

// Tambah Data
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $keterangan = $_POST['keterangan'];

    $file_name = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    $path = "dokumen/" . basename($file_name); // ✅ BENAR

    if (move_uploaded_file($tmp, $path)) {
        $conn->query("INSERT INTO formulir (nama, file, keterangan) VALUES ('$nama', '$path', '$keterangan')");
        header("Location: formulir_edit.php");
    } else {
        echo "<script>alert('Upload file gagal!');</script>";
    }
}

// Update Data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $keterangan = $_POST['keterangan'];

    if ($_FILES['file']['name']) {
        $file_name = $_FILES['file']['name'];
        $tmp = $_FILES['file']['tmp_name'];
        $path = "dokumen/" . basename($file_name); // ✅ BENAR
        move_uploaded_file($tmp, $path);
        $conn->query("UPDATE formulir SET nama='$nama', file='$path', keterangan='$keterangan' WHERE id='$id'");
    } else {
        $conn->query("UPDATE formulir SET nama='$nama', keterangan='$keterangan' WHERE id='$id'");
    }
    header("Location: formulir_edit.php");
}

// Hapus Data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM formulir WHERE id='$id'");
    header("Location: formulir_edit.php");
}

// Ambil Data untuk Edit
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editData = $conn->query("SELECT * FROM formulir WHERE id='$id'")->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Formulir</title>
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
        label {
            font-weight: 500;
            margin-top: 10px;
        }
        input[type="text"], textarea, input[type="file"] {
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
        table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 14px;
    background-color: white;
    border-radius: 8px;
    overflow: hidden;
}

table thead {
    background-color: #2D336B;
    color: white;
}

table thead th {
    text-align: center;
    padding: 12px 10px;
    font-weight: 600;
    border-right: 1px solid #445;
}

table thead th:last-child {
    border-right: none;
}

table tbody tr:nth-child(even) {
    background-color: #F3F4F6;
}

table tbody td {
    padding: 10px 12px;
    color: #2D336B;
    vertical-align: middle;
    border-bottom: 1px solid #ddd;
}

table tbody td a {
    text-decoration: none;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 13px;
    margin-right: 4px;
}

table tbody td a.btn-link {
    background-color: #2D336B;
    color: white;
    transition: 0.2s ease;
}

table tbody td a.btn-link:hover {
    background-color: #1a1f4d;
    color: #fff;
}

    </style>
</head>
<body>
<div class="container">
    <div class="box-container">
        <header>
            <h1>Manajemen Formulir</h1>
        </header>

        <h2><?= $editData ? 'Edit Formulir' : 'Tambah Formulir' ?></h2>
        <form method="POST" enctype="multipart/form-data">
            <?php if ($editData): ?>
                <input type="hidden" name="id" value="<?= $editData['id'] ?>">
            <?php endif; ?>

            <label>Nama Formulir:</label>
            <input type="text" name="nama" value="<?= $editData['nama'] ?? '' ?>" required>

            <label>Upload File PDF:</label>
            <input type="file" name="file" accept="application/pdf">

            <label>Keterangan:</label>
            <textarea name="keterangan" rows="4"><?= $editData['keterangan'] ?? '' ?></textarea>

            <button type="submit" name="<?= $editData ? 'update' : 'tambah' ?>">
                <?= $editData ? 'Update' : 'Tambah' ?>
            </button>
        </form>

        <hr>

        <h2>Daftar Formulir</h2>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>File</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            $data = $conn->query("SELECT * FROM formulir");
            while ($row = $data->fetch_assoc()):
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><a href="<?= htmlspecialchars($row['file']) ?>" target="_blank">Download</a></td>
                    <td><?= nl2br(htmlspecialchars($row['keterangan'] ?? '')) ?></td>
                    <td>
                        <a href="formulir_edit.php?edit=<?= $row['id'] ?>" class="btn-link">Edit</a>
                        <a href="formulir_edit.php?hapus=<?= $row['id'] ?>" class="btn-link" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
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