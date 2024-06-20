<?php
session_start();

// Cek apakah pengguna telah login
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// Ambil data pengguna dari session
$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Selamat Datang di Dashboard</h1>
        <p>Anda telah login sebagai: <?php echo $username; ?></p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>