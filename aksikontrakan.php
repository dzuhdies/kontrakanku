<?php
include "koneksi.php";

$nama = $_POST['nama'];
$daerah = $_POST['daerah'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];
$nama_file = $_FILES['gambar']['name'];
$ukuran_file = $_FILES['gambar']['size'];
$tmp_file = $_FILES['gambar']['tmp_name'];
$path = "upload/" . $nama_file;

if (move_uploaded_file($tmp_file, $path)) {
    $stmt = $koneksi->prepare("INSERT INTO kontrakan (nama, daerah, harga, deskripsi, gambar) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $nama, $daerah, $harga, $deskripsi, $path);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil disimpan.');window.location='dashbord.php';</script>";
    } else {
        echo "<script>alert('Data gagal disimpan.');window.location='tambah_kontrakan.html';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('File gagal diunggah.');window.location='tambah_kontrakan.html';</script>";
}
?>
