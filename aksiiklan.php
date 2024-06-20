<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "kontrakanku"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari formulir
$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];

// Upload gambar
$gambar = $_FILES['gambar']['name'];
$gambar_tmp = $_FILES['gambar']['tmp_name'];
$upload_dir = "iklan/"; // Folder untuk menyimpan gambar

if (move_uploaded_file($gambar_tmp, $upload_dir . $gambar)) {
    // Query untuk menyimpan data iklan ke database
    $sql = "INSERT INTO iklan (nama, deskripsi, gambar) VALUES ('$nama', '$deskripsi', '$gambar')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil disimpan.');window.location='dashbord.php';</script>";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Upload gambar gagal.";
}

$conn->close();
?>
