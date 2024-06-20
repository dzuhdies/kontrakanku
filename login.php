<?php
session_start();

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kontrakanku";

$koneksi = mysqli_connect($servername, $username, $password, $dbname);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Cek apakah form login telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query untuk mengambil data pengguna
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Login berhasil
        $_SESSION["username"] = $username;
        header("Location: dashbord_login.php");
        exit();
    } else {
        $error_message = "Username atau password salah.";
    }
}

// Tutup koneksi
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kontrakanku Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <div class="container">
        <!-- <h1>KONTRAKANKU</h1> -->
        <div class="login-box">
            <h2>Login</h2>
            <?php if (isset($error_message)) echo "<p style='color:red;'>$error_message</p>"; ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label>username :</label>
                <input type="text" name="username" placeholder="Enter Username" required>
                <label>password :</label>
                <input type="password" name="password" placeholder="Enter Password" required>
                <p>belum punya akun ? <a href="register.php">register</a></p>
                <input type="submit" value="Login">
            </form>
        </div>
    </div>
</body>
</html>