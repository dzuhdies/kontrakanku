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

// Query untuk mengambil data kontrakan berdasarkan ID
$sql = "SELECT * FROM kontrakan WHERE idkontrakan='$idkontrakan'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "<script>alert('Data tidak ditemukan.');window.location='managekontrakan.php';</script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $daerah = $_POST['daerah'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $jumlah_kamar = $_POST['jumlah_kamar'];
    $air_pdam = $_POST['air_pdam'];
    $listrik_kwh = $_POST['listrik_kwh'];
    $jumlah_kamarmandi = $_POST['jumlah_kamarmandi'];

    // Query untuk mengupdate data kontrakan
    $sql = "UPDATE kontrakan SET nama='$nama', daerah='$daerah', deskripsi='$deskripsi', harga='$harga', jumlah_kamar='$jumlah_kamar', air_pdam='$air_pdam', listrik_kwh='$listrik_kwh', jumlah_kamarmandi='$jumlah_kamarmandi' WHERE idkontrakan='$idkontrakan'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Kontrakan berhasil diperbarui.');window.location='managekontrakan.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui kontrakan.');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kontrakan - Kontrakanku</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <div class="container">
        <h2>Edit Kontrakan</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?id=' . $idkontrakan); ?>">
            <label for="nama">Nama Kontrakan:</label>
            <input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
            
            <label for="daerah">Daerah:</label>
            <input type="text" id="daerah" name="daerah" value="<?php echo $row['daerah']; ?>" required>
            
            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" required><?php echo $row['deskripsi']; ?></textarea>
            
            <label for="harga">Harga:</label>
            <input type="text" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required>
            
            <label for="jumlah_kamar">Jumlah Kamar:</label>
            <input type="number" id="jumlah_kamar" name="jumlah_kamar" value="<?php echo $row['jumlah_kamar']; ?>" required>
            
            <label for="air_pdam">Air PDAM:</label>
            <select id="air_pdam" name="air_pdam" required>
                <option value="Y" <?php if ($row['air_pdam'] == 'Y') echo 'selected'; ?>>Ya</option>
                <option value="N" <?php if ($row['air_pdam'] == 'N') echo 'selected'; ?>>Tidak</option>
            </select>
            
            <label for="listrik_kwh">Daya Listrik (kWh):</label>
            <input type="number" id="listrik_kwh" name="listrik_kwh" value="<?php echo $row['listrik_kwh']; ?>" required>
            
            <label for="jumlah_kamarmandi">Jumlah Kamar Mandi:</label>
            <input type="number" id="jumlah_kamarmandi" name="jumlah_kamarmandi" value="<?php echo $row['jumlah_kamarmandi']; ?>" required>
            
            <button type="submit">Update</button>
        </form>
    </div>
</body>

</html>
