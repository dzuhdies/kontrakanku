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

$id = $_POST['id'];

// Query untuk mengupdate status iklan menjadi 'rejected'
$sql = "UPDATE iklan SET status='rejected' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Iklan berhasil ditolak.');window.location='manageiklan.php';</script>";
} else {
    echo "<script>alert('Gagal menolak iklan.');window.location='manageiklan.php';</script>";
}

$conn->close();
?>
