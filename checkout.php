<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

// Ambil data dari URL
$id_kontrakan = isset($_GET['id_kontrakan']) ? $_GET['id_kontrakan'] : 0;
$id_user = $_SESSION['id_user'];

// Tanggal pembayaran saat ini
$tanggal_pembayaran = date('Y-m-d');

// Misalkan metode pembayaran adalah 1 (ini hanya contoh, Anda bisa menambahkan opsi metode pembayaran)
$metode_pembayaran = 1;

// Simpan data pembayaran ke dalam database
$sql = "INSERT INTO pembayaran (id_kontrakan, id_user, tanggal_pembayaran, metode_pembayaran) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iisi", $id_kontrakan, $id_user, $tanggal_pembayaran, $metode_pembayaran);

if ($stmt->execute()) {
    // Hapus data kontrakan setelah pembayaran berhasil
    $delete_sql = "DELETE FROM kontrakan WHERE idkontrakan = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $id_kontrakan);
    $delete_stmt->execute();
    $delete_stmt->close();

    echo "Pembayaran berhasil diproses!";
    // Anda bisa mengarahkan ke halaman lain atau menampilkan pesan sukses
} else {
    echo "Gagal memproses pembayaran: " . $stmt->error;
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
