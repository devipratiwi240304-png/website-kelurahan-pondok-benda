<?php
session_start();
include '../../db/connection.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Upload gambar baru galeri
if (isset($_POST['upload'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $path = "../img/galeri/" . basename($gambar);

    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
    $file_ext = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));

    if (!in_array($file_ext, $allowed_ext)) {
        echo "<script>alert('Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan!');</script>";
    } else if (move_uploaded_file($tmp, $path)) {
        $stmt = $conn->prepare("INSERT INTO galeri (judul, gambar) VALUES (?, ?)");
        $stmt->bind_param("ss", $judul, $gambar);
        if ($stmt->execute()) {
            $_SESSION['success'] = 'Gambar berhasil ditambahkan!';
            header("Location: galeri_edit.php");
            exit();
        } else {
            echo "<script>alert('Gagal menyimpan ke database!');</script>";
        }
    } else {
        echo "<script>alert('Gagal upload gambar!');</script>";
    }
}

// Edit judul dan gambar galeri sekaligus
if (isset($_POST['edit_galeri'])) {
    $id = intval($_POST['id']);
    $judul_baru = mysqli_real_escape_string($conn, $_POST['judul_baru']);
    mysqli_query($conn, "UPDATE galeri SET judul = '$judul_baru' WHERE id = $id");

    if (!empty($_FILES['gambar_baru']['name'])) {
        $folder = "../img/galeri/";
        $ext = strtolower(pathinfo($_FILES['gambar_baru']['name'], PATHINFO_EXTENSION));
        $namaBaru = uniqid('galeri_', true) . '.' . $ext;
        $pathBaru = $folder . $namaBaru;

        $getOld = mysqli_query($conn, "SELECT gambar FROM galeri WHERE id = $id");
        if ($getOld && $old = mysqli_fetch_assoc($getOld)) {
            $gambarLama = $old['gambar'];
            if (file_exists($folder . $gambarLama)) {
                unlink($folder . $gambarLama);
            }
        }

        if (move_uploaded_file($_FILES['gambar_baru']['tmp_name'], $pathBaru)) {
            mysqli_query($conn, "UPDATE galeri SET gambar = '$namaBaru' WHERE id = $id");
        }
    }

    $_SESSION['success'] = 'Galeri berhasil diperbarui!';
    header("Location: galeri_edit.php");
    exit();
}

// Tambah berita baru
if (isset($_POST['tambah_berita'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $link = mysqli_real_escape_string($conn, $_POST['link']);
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $folder_berita = "../img/berita/";

    if (!is_dir($folder_berita)) {
        mkdir($folder_berita, 0777, true);
    }

    $ext = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));
    $namaBaru = uniqid('berita_', true) . '.' . $ext;
    $path = $folder_berita . $namaBaru;

    if (move_uploaded_file($tmp, $path)) {
        $query = "INSERT INTO berita (judul, link, gambar) VALUES ('$judul', '$link', '$namaBaru')";
        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = 'Berita berhasil ditambahkan!';
        } else {
            echo "<script>alert('Gagal simpan ke DB: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Gagal upload gambar ke folder: $path');</script>";
    }

    header("Location: galeri_edit.php");
    exit();
}

// Edit berita (termasuk gambar)
if (isset($_POST['edit_berita'])) {
    $id = intval($_POST['id']);
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $link = mysqli_real_escape_string($conn, $_POST['link']);
    $gambarBaru = $_FILES['gambar_baru']['name'];
    $tmpBaru = $_FILES['gambar_baru']['tmp_name'];

    if (!empty($gambarBaru)) {
        $folder = "../img/berita/";
        $ext = strtolower(pathinfo($gambarBaru, PATHINFO_EXTENSION));
        $namaBaru = uniqid('berita_', true) . '.' . $ext;
        $pathBaru = $folder . $namaBaru;

        $getOld = mysqli_query($conn, "SELECT gambar FROM berita WHERE id = $id");
        $old = mysqli_fetch_assoc($getOld);
        $gambarLama = $old['gambar'];
        if (file_exists($folder . $gambarLama)) {
            unlink($folder . $gambarLama);
        }

        if (move_uploaded_file($tmpBaru, $pathBaru)) {
            mysqli_query($conn, "UPDATE berita SET judul='$judul', link='$link', gambar='$namaBaru' WHERE id=$id");
        } else {
            echo "<script>alert('Gagal upload gambar baru!');</script>";
        }
    } else {
        mysqli_query($conn, "UPDATE berita SET judul='$judul', link='$link' WHERE id=$id");
    }

    header("Location: galeri_edit.php");
    exit();
}

// Hapus berita
if (isset($_GET['hapus_berita'])) {
    $id = intval($_GET['hapus_berita']);
    $result = mysqli_query($conn, "SELECT gambar FROM berita WHERE id = $id");
    if ($result && $data = mysqli_fetch_assoc($result)) {
        $file_path = "../img/berita/" . $data['gambar'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }
    mysqli_query($conn, "DELETE FROM berita WHERE id = $id");
    header("Location: galeri_edit.php");
    exit();
}

// Hapus gambar galeri
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $result = mysqli_query($conn, "SELECT gambar FROM galeri WHERE id = $id");
    if ($result && $data = mysqli_fetch_assoc($result)) {
        $file_path = "../img/galeri/" . $data['gambar'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        mysqli_query($conn, "DELETE FROM galeri WHERE id = $id");
        $_SESSION['success'] = 'Gambar berhasil dihapus!';
        header("Location: galeri_edit.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Galeri dan Berita - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        body {
            background-color: #FFF2F2;
            font-family: 'Segoe UI', sans-serif;
            color: #2D336B;
            margin: 20px;
        }
        .container { max-width: 1100px; margin: auto; }
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
            max-width: 150px;
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

   <!-- Galeri -->
<div class="section-box">
    <h2>Kelola Galeri</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Judul Gambar:</label>
        <input type="text" name="judul" required>
        <label>Upload Gambar:</label>
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
    $galeri = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");
    while ($row = mysqli_fetch_assoc($galeri)):
    ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['judul']) ?></td>
            <td><img src="../img/galeri/<?= htmlspecialchars($row['gambar']) ?>" style="max-width: 120px;"></td>
            <td>
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="text" name="judul_baru" value="<?= htmlspecialchars($row['judul']) ?>" required>
                    <input type="file" name="gambar_baru" accept="image/*">
                    <button type="submit" name="edit_galeri" style="background-color:#2D336B; color:white; border:none; padding:8px 14px; border-radius:6px;">Update</button>
                </form>
            </td>
            <td>
                <form method="GET" onsubmit="return confirm('Hapus gambar ini?')">
                    <input type="hidden" name="hapus" value="<?= $row['id'] ?>">
                    <button type="submit" style="background-color:#D9534F; color:white; border:none; padding:8px 14px; border-radius:6px;">Hapus</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
</div>


    <!-- Berita -->
    <div class="section-box">
        <h2>Kelola Berita</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>Judul Berita:</label>
            <input type="text" name="judul" required>
            <label>Link Berita:</label>
            <input type="text" name="link" required>
            <label>Gambar Berita:</label>
            <input type="file" name="gambar" required>
            <button type="submit" name="tambah_berita">Tambah Berita</button>
        </form>

        <table>
            <thead>
            <tr><th>No</th><th>Judul</th><th>Gambar</th><th>Link</th><th>Edit</th><th>Hapus</th></tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            $berita = mysqli_query($conn, "SELECT * FROM berita ORDER BY id DESC");
            while ($row = mysqli_fetch_assoc($berita)):
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['judul']) ?></td>
                    <td><img src="../img/berita/<?= htmlspecialchars($row['gambar']) ?>" width="120"></td>
                    <td><a href="<?= htmlspecialchars($row['link']) ?>" target="_blank"><?= htmlspecialchars($row['link']) ?></a></td>
                    <td>
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="text" name="judul" value="<?= htmlspecialchars($row['judul']) ?>" required>
                            <input type="text" name="link" value="<?= htmlspecialchars($row['link']) ?>" required>
                            <input type="file" name="gambar_baru">
                            <button type="submit" name="edit_berita">Update</button>
                        </form>
                    </td>
                    <td><a href="galeri_edit.php?hapus_berita=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <a href="../admin_dashboard.php" class="btn-back">← Kembali ke Dashboard</a>

</div>
</body>
</html>
