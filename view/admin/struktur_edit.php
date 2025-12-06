<?php
session_start();
include '../../db/connection.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Upload gambar struktur baru
if (isset($_POST['upload'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $folder = "../img/struktur/";

    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $ext = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($ext, $allowed_ext)) {
        echo "<script>alert('Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan!');</script>";
    } else {
        $namaBaru = uniqid('struktur_', true) . '.' . $ext;
        $path = $folder . $namaBaru;

        if (move_uploaded_file($tmp, $path)) {
            $stmt = $conn->prepare("INSERT INTO struktur (judul, gambar) VALUES (?, ?)");
            $stmt->bind_param("ss", $judul, $namaBaru);
            if ($stmt->execute()) {
                $_SESSION['success'] = 'Struktur berhasil ditambahkan!';
                header("Location: struktur_edit.php");
                exit();
            } else {
                echo "<script>alert('Gagal menyimpan ke database!');</script>";
            }
        } else {
            echo "<script>alert('Gagal upload gambar!');</script>";
        }
    }
}

// Edit struktur (judul & gambar)
if (isset($_POST['edit_struktur'])) {
    $id = intval($_POST['id']);
    $judul_baru = mysqli_real_escape_string($conn, $_POST['judul_baru']);
    mysqli_query($conn, "UPDATE struktur SET judul='$judul_baru' WHERE id=$id");

    if (!empty($_FILES['gambar_baru']['name'])) {
        $folder = "../img/struktur/";
        $ext = strtolower(pathinfo($_FILES['gambar_baru']['name'], PATHINFO_EXTENSION));
        $namaBaru = uniqid('struktur_', true) . '.' . $ext;
        $pathBaru = $folder . $namaBaru;

        $getOld = mysqli_query($conn, "SELECT gambar FROM struktur WHERE id=$id");
        if ($getOld && $old = mysqli_fetch_assoc($getOld)) {
            $gambarLama = $old['gambar'];
            if (file_exists($folder . $gambarLama)) {
                unlink($folder . $gambarLama);
            }
        }

        if (move_uploaded_file($_FILES['gambar_baru']['tmp_name'], $pathBaru)) {
            mysqli_query($conn, "UPDATE struktur SET gambar='$namaBaru' WHERE id=$id");
        }
    }

    $_SESSION['success'] = 'Struktur berhasil diperbarui!';
    header("Location: struktur_edit.php");
    exit();
}

// Hapus struktur
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $result = mysqli_query($conn, "SELECT gambar FROM struktur WHERE id=$id");
    if ($result && $data = mysqli_fetch_assoc($result)) {
        $file_path = "../img/struktur/" . $data['gambar'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        mysqli_query($conn, "DELETE FROM struktur WHERE id=$id");
        $_SESSION['success'] = 'Data struktur berhasil dihapus!';
        header("Location: struktur_edit.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Struktur Organisasi - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        body {
            background-color: #FFF2F2;
            font-family: 'Segoe UI', sans-serif;
            color: #2D336B;
            margin: 20px;
        }
        .container { max-width: 900px; margin: auto; }
        .section-box {
            background-color: #fff;
            border-radius: 12px;
            padding: 25px 20px;
            margin-bottom: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }
        .section-box h2 {
            background-color: #2D336B;
            color: #FFF2F2;
            padding: 15px 20px;
            border-radius: 10px;
            font-size: 22px;
            margin: 0 0 25px 0;
        }
        label { font-weight: 500; margin-top: 10px; display: block; }
        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }
        button {
            background-color: #2D336B;
            color: #FFF2F2;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s ease;
        }
        button:hover { background-color: #A9B5DF; color: #2D336B; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            color: #2D336B;
            vertical-align: middle;
        }
        th {
            background-color: #2D336B;
            color: white;
            text-align: center;
        }
        img {
            max-width: 250px;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        form.inline { display: inline-block; }
        .btn-back {
            background-color: #2D336B;
            color: #FFF2F2;
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        .btn-back:hover { background-color: #121a52; }
    </style>
</head>
<body>
<div class="container">

    <!-- Struktur Organisasi -->
    <div class="section-box">
        <h2>Kelola Struktur Organisasi</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>Judul Struktur:</label>
            <input type="text" name="judul" required>
            <label>Upload Gambar Struktur:</label>
            <input type="file" name="gambar" accept="image/*" required>
            <button type="submit" name="upload">Upload</button>
        </form>

        <table>
            <thead>
                <tr><th>No</th><th>Judul</th><th>Gambar</th><th>Edit</th><th>Hapus</th></tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            $struktur = mysqli_query($conn, "SELECT * FROM struktur ORDER BY id DESC");
            while ($row = mysqli_fetch_assoc($struktur)):
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['judul']) ?></td>
                    <td><img src="../img/struktur/<?= htmlspecialchars($row['gambar']) ?>" alt="Struktur" style="max-width: 200px;"></td>
                    <td>
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="text" name="judul_baru" value="<?= htmlspecialchars($row['judul']) ?>" required>
                            <input type="file" name="gambar_baru" accept="image/*">
                            <button type="submit" name="edit_struktur">Update</button>
                        </form>
                    </td>
                    <td>
                        <form method="GET" onsubmit="return confirm('Hapus struktur ini?')">
                            <input type="hidden" name="hapus" value="<?= $row['id'] ?>">
                            <button type="submit" style="background-color:#D9534F; color:white; border:none; padding:8px 14px; border-radius:6px;">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <a href="../admin_dashboard.php" class="btn-back">← Kembali ke Dashboard</a>

</div>
</body>
</html>
