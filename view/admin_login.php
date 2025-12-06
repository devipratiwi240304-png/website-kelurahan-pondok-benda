<?php
session_start();
require '../db/connection.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = $admin['username'];
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <style>
        body {
            background-color: #FFF2F2;
            font-family: 'Segoe UI', sans-serif;
            color: #2D336B;
        }

        .container {
            max-width: 500px;
            margin: auto;
            padding: 60px 20px;
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

        header h2 {
            color: #FFF2F2;
            font-weight: bold;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #2D336B;
            color: #FFF2F2;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            transition: 0.3s ease;
        }

        button:hover {
            background-color: #1f244e;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }

        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9rem;
            color: #2D336B;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="box-container">
        <header>
            <h2>Login Admin</h2>
        </header>

        <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>

        <footer>
            &copy; <?= date('Y') ?> Kelurahan Pondok Benda
        </footer>
    </div>
</div>
</body>
</html>
