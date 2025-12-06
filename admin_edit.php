<?php
session_start();

// Cek login admin (jika diaktifkan)
// if (!isset($_SESSION['admin_logged_in'])) {
//     header("Location: login.php");
//     exit;
// }

$conn = new mysqli("localhost", "root", "", "desa");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah parameter ID ada
if (!isset($_GET['id'])) {
    echo "ID berita tidak ditemukan.";
    exit;
}

$id = intval($_GET['id']);

// Ambil data berita yang akan diedit
$result = $conn->query("SELECT * FROM berita WHERE id = $id");
if ($result->num_rows === 0) {
    echo "Berita tidak ditemukan.";
    exit;
}
$berita = $result->fetch_assoc();

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $conn->real_escape_string($_POST['judul']);
    $isi = $conn->real_escape_string($_POST['isi']);

    $update = $conn->query("UPDATE berita SET judul = '$judul', isi = '$isi' WHERE id = $id");

    if ($update) {
        header("Location: admin_dashboard.php");
        exit;
    } else {
        echo "Gagal memperbarui berita: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Berita</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Edit Berita</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" name="judul" id="judul" class="form-control" value="<?= htmlspecialchars($berita['judul']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="isi" class="form-label">Isi Berita</label>
                <textarea name="isi" id="isi" class="form-control" rows="8" required><?= htmlspecialchars($berita['isi']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="admin_dashboard.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <div class="container mt-4">
    <h1>Edit Struktur Organisasi</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" value="<?= htmlspecialchars($struktur['judul']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar (upload untuk ganti)</label><br>
            <?php if ($struktur['gambar'] && file_exists("../img/struktur/" . $struktur['gambar'])): ?>
                <img src="../img/struktur/<?= htmlspecialchars($struktur['gambar']) ?>" alt="Gambar Struktur" style="max-width: 300px; display: block; margin-bottom: 10px;">
            <?php else: ?>
                <p><em>Tidak ada gambar saat ini.</em></p>
            <?php endif; ?>
            <input type="file" name="gambar" id="gambar" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="struktur_list.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

</body>
</html>
