<?php
include 'connection.php'; // koneksi ke DB

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">';
echo '<div class="container">';
echo '<a class="navbar-brand" href="#"><img src="../img/logo.png" alt="Logo" style="height:40px;"></a>';
echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">';
echo '<span class="navbar-toggler-icon"></span>';
echo '</button>';
echo '<div class="collapse navbar-collapse" id="navbarNav">';
echo '<ul class="navbar-nav ml-auto">';

$query = mysqli_query($conn, "SELECT * FROM navbar_menu");
while ($row = mysqli_fetch_assoc($query)) {
    echo '<li><a href="' . $row['link'] . '">' . $row['nama_menu'] . '</a></li>';
}

echo '</ul></div></div></nav>';
?>
