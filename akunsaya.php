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

// Ambil data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $kelamin = $_POST['kelamin'];
    $tgl_lahir_dd = $_POST['tgl_lahir_dd'];
    $tgl_lahir_mm = $_POST['tgl_lahir_mm'];
    $tgl_lahir_yyyy = $_POST['tgl_lahir_yyyy'];
    $tgl_lahir = "$tgl_lahir_yyyy-$tgl_lahir_mm-$tgl_lahir_dd"; // Format tanggal untuk MySQL
    $kota = $_POST['kota'];

    // Query untuk memasukkan data ke dalam database
    $sql = "INSERT INTO data_pribadi (nama_lengkap, username, kelamin, tgl_lahir, kota) 
            VALUES ('$nama', '$username', '$kelamin', '$tgl_lahir', '$kota')";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil disimpan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Saya - Kontrakanku</title>
    <link rel="stylesheet" href="akun.css">
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <h2>KONTRAKANKU</h2>
            <ul>
                <li><a href="#" class="active">Akun Saya</a></li>
                <li><a href="pemes.html">Pemesanan</a></li>
                <li><a href="kontrakanku.html">Kontrakanku</a></li>
                <li><a href="dashbord_login.php">Keluar Akun</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h2>Data Pribadi</h2>
            <form action="akunsaya.php" method="POST">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama">

                <label for="username">Username</label>
                <input type="text" id="username" name="username">

                <label for="kelamin">Kelamin</label>
                <input type="text" id="kelamin" name="kelamin">

                <label for="tgl_lahir">Tanggal Lahir</label>
                <div class="birthdate">
                    <input type="text" id="tgl_lahir_dd" name="tgl_lahir_dd" placeholder="dd">
                    <input type="text" id="tgl_lahir_mm" name="tgl_lahir_mm" placeholder="mm">
                    <input type="text" id="tgl_lahir_yyyy" name="tgl_lahir_yyyy" placeholder="yyyy">
                </div>

                <label for="kota">Kota Tempat Tinggal</label>
                <input type="text" id="kota" name="kota">

                <button type="submit" class="edit-profile-btn">Edit Profile</button>
            </form>

            <h2>Contact Info</h2>
            <div class="contact-info">
                <div class="email-section">
                    <div class="title-with-btn">
                        <h3>Email</h3>
                        <button class="add-email-btn">+ Tambah Email</button>
                    </div>
                    <p>Masukkan Email Anda</p>
                    <div class="email-info">
                        <span>dzuhdies@gmail.com</span>
                        <button class="delete-btn">🗑️</button>
                    </div>
                </div>
                <div class="phone-section">
                    <div class="title-with-btn">
                        <h3>No Handphone</h3>
                        <button class="add-phone-btn">+ Tambah Nomer Handphone</button>
                    </div>
                    <p>Masukkan Nomor Handphone Anda</p>
                    <div class="phone-info">
                        <span>082133616401</span>
                        <button class="delete-btn">🗑️</button>
                    </div>
                </div>
                <button class="delete-account-btn">Hapus Akun</button>
            </div>
        </div>
    </div>
</body>

</html>
