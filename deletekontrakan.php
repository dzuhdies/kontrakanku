<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kontrakanku";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$idkontrakan = $_GET['id'];

// Query untuk menghapus data kontrakan
$sql = "DELETE FROM kontrakan WHERE idkontrakan='$idkontrakan'";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Kontrakan berhasil dihapus.');window.location='managekontrakan.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus kontrakan.');window.location='managekontrakan.php';</script>";
}

$conn->close();
?>
