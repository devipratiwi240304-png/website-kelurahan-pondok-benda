<?php
session_start();
session_unset();      // Hapus semua variabel session
session_destroy();    // Hancurkan session

header("Location: admin_login.php"); // Arahkan kembali ke login
exit;