<?php
include '../db/connection.php'; // pastikan path ini benar sesuai struktur foldermu
$formulir = $conn->query("SELECT * FROM formulir ORDER BY id DESC");
$index = 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Formulir Surat Keterangan</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    padding: 20px;
    background: #FFF2F2;
}

h1 {
    text-align: center;
    color: white;
    margin-bottom: 30px;
}

.formulir-container {
    max-width: 800px;
    margin: 0 auto;
    background: #2D336B;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.formulir-item {
    margin-bottom: 15px;
    border-radius: 5px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.formulir-title {
    padding: 15px;
    cursor: pointer;
    background: #A9B5DF;
    color: white;
    font-weight: bold;
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
    transition: background-color 0.3s ease;
}

.formulir-title:hover {
    background: #94a2d3;
}

.formulir-content {
    display: none;
    padding: 15px;
    border-top: 1px solid #ddd;
    background: #FFF2F2;
    animation: fadeIn 0.3s ease-in-out;
}

.download-link {
    display: inline-block;
    margin-top: 10px;
    background: #2D336B;
    color: white;
    padding: 8px 15px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: bold;
}

.download-link:hover {
    background: #1A224D;
    color: #FFF;
}

.back-button {
    display: block;
    width: fit-content;
    margin: 30px auto 0;
    background-color: #A9B5DF;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.back-button:hover {
    background-color: #8A98D9;
}

.arrow {
    transition: transform 0.3s ease;
}

.rotate {
    transform: rotate(180deg);
}

.syarat {
    padding: 15px;
    color: #333;
    margin-bottom: 10px;
}

.syarat strong {
    display: block;
    margin-bottom: 8px;
    padding-left: 5px;
}

.syarat ul {
    margin-top: 0;
    padding-left: 25px;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-5px); }
    to { opacity: 1; transform: translateY(0); }
}

    </style>
    <script>
        function toggleContent(id, arrowId) {
            const content = document.getElementById(id);
            const arrow = document.getElementById(arrowId);
            const isVisible = content.style.display === 'block';
            content.style.display = isVisible ? 'none' : 'block';
            arrow.innerHTML = isVisible ? '▼' : '▲';
        }
    </script>
</head>
<body>
    <div class="formulir-container">
        <h1>Formulir Surat Keterangan</h1>

        <?php while ($row = $formulir->fetch_assoc()): ?>
        <div class="formulir-item">
            <div class="formulir-title" onclick="toggleContent('content<?= $index ?>', 'arrow<?= $index ?>')">
                <?= htmlspecialchars($row['nama']) ?>
                <span class="arrow" id="arrow<?= $index ?>">▼</span>
            </div>
            <div class="formulir-content" id="content<?= $index ?>">
                <p><?= nl2br(htmlspecialchars($row['keterangan'])) ?></p>
                <a class="download-link" href="<?= htmlspecialchars($row['file']) ?>" download>Download Formulir</a>
            </div>
        </div>
        <?php $index++; endwhile; ?>

        <div class="back-navigation">
            <a href="../index.php" class="back-button">← Kembali</a>
        </div>
    </div>
</body>
</html>
