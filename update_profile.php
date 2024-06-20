<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kontrakanku";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pastikan pengguna sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

$id_user = $_SESSION['id_user'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$kelamin = $_POST['kelamin'];

// Query untuk meng-update data pengguna
$sql = "UPDATE user SET nama_lengkap='$nama', username='$username', kelamin='$kelamin' WHERE id_user=$id_user";

if ($conn->query($sql) === TRUE) {
    // Update berhasil, arahkan kembali ke halaman akun saya
    header("Location: akunsaya.php");
    exit();
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
