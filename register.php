<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kontrakanku";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Cek apakah form register telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $nama_lengkap = $_POST["nama_lengkap"];
    $email = $_POST["email"];
    $nomor_tlpn = $_POST["nomor_tlpn"];
    $password = $_POST["password"];

    // Query untuk menyimpan data pengguna baru
    $sql = "INSERT INTO user (username, nama_lengkap, email, phone_number, password)
            VALUES ('$username', '$nama_lengkap', '$email', '$nomor_tlpn', '$password')";

    if (mysqli_query($conn, $sql)) {
        $success_message = "Pendaftaran berhasil!";
    } else {
        $error_message = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Tutup koneksi
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - KONTRAKANKU</title>
    <link rel="stylesheet" href="regis.css">
</head>
<body>
    <div class="container">
        <h1>KONTRAKANKU</h1>
        <div class="register-box">
            <h2>Register</h2>
            <?php if (isset($success_message)) echo "<p style='color:green;'>$success_message</p>"; ?>
            <?php if (isset($error_message)) echo "<p style='color:red;'>$error_message</p>"; ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label for="username">Username :</label>
                <input type="text" id="username" name="username" placeholder="Enter Username" required>
                <label for="nama_lengkap">Nama Lengkap :</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Enter Nama Lengkap" required>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" placeholder="Enter Email" required>
                <label for="nomor_tlpn">Nomor Telepon :</label>
                <input type="text" id="nomor_tlpn" name="nomor_tlpn" placeholder="Enter Nomor Telepon" required>
                <label for="password">Password :</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
                <input type="submit" value="SUBMIT">
            </form>
            <p>Sudah punya akun? <a href="login.php">LOGIN</a></p>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
</body>
</html>
