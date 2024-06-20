<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kontrakanku";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data kontrakan dari database
$sql = "SELECT * FROM kontrakan";
$result = $conn->query($sql);

// Periksa jika terdapat error dalam query
if (!$result) {
    die("Error dalam query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontrakanku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dash.css">
</head>
<body>
    <header>
        <div class="logo">
            <h2>KONTRAKANKU</h2>
        </div>
        <nav>
            <a href="akun.html">Akun</a>
            <a href="contact.html">Contact</a>
        </nav>
    </header>
    <main>
    <div class="container">
        <br>
    <div class="heading">
        <h2><strong>MWENEMUKAN KONTRAKAN JADI MUDAH</strong></h2>
    </div>
    <br>
    <div class="search-bar">
        <input type="text" placeholder="cari tempat atau fasilitas">
        <button>Cari</button>
    </div>
    <br>
</div>

        <br>
        <br>
        <div class="buttons">
            <a href="carikontrakan.html">
            <button id="button1">
                <img src="upload/cari.png" alt="Gambar 1">
                Carikan Kontrakan
            </button></a>
            <a href="kontrakan.html">
            <button id="button2">
                <img src="upload/disewakan.png" alt="Gambar 2">
                Sewakan Kontrakan
            </button></a>
            <a href="iklan.php">
            <button id="button3">
                <img src="upload/iklan.png" alt="Gambar 3">
                Iklankan Kontrakan
            </button></a>
        </div>
<br>
<br>
<br>
<br>
        <div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-indicators">
        <?php

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query untuk mengambil data iklan
        $sql = "SELECT * FROM iklan";
        $result = $conn->query($sql);

        // Output indicator untuk setiap iklan
        if ($result->num_rows > 0) {
            $count = 0;
            while($row = $result->fetch_assoc()) {
                echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="' . $count . '"';
                if ($count == 0) {
                    echo ' class="active"';
                }
                echo ' aria-label="Slide ' . ($count + 1) . '"></button>';
                $count++;
            }
        }
        $conn->close();
        ?>
    </div>
    <div class="carousel-inner">
        <?php
        // Koneksi ke database (kembali dibuka)
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query untuk mengambil data iklan
        $sql = "SELECT * FROM iklan";
        $result = $conn->query($sql);

        // Output konten untuk setiap iklan
        if ($result->num_rows > 0) {
            $count = 0;
            while($row = $result->fetch_assoc()) {
                echo '<div class="carousel-item';
                if ($count == 0) {
                    echo ' active';
                }
                echo '">';
                echo '<img src="iklan/' . $row['gambar'] . '" class="d-block w-100" alt="' . $row['nama'] . '">';
                echo '<div class="carousel-caption d-none d-md-block">';
                echo '<h5>' . $row['nama'] . '</h5>';
                echo '<p>' . $row['deskripsi'] . '</p>';
                echo '</div>';
                echo '</div>';
                $count++;
            }
        }
        $conn->close();
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<br>
<br>
<br>
<br>
<div class="kontrakan-list">
    <?php
    // Koneksi ke database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kontrakanku";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query untuk mengambil data kontrakan
    $sql = "SELECT * FROM kontrakan";
    $result = $conn->query($sql);

    // Periksa jika terdapat error dalam query
    if (!$result) {
        die("Error dalam query: " . $conn->error);
    }

    // Output daftar kontrakan
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="kontrakan-item" data-id="' . $row['idkontrakan'] . '">';
            if (isset($row['gambar']) && !empty($row['gambar'])) {
                echo '<img src="' . $row['gambar'] . '" alt="' . $row['nama'] . '">';
            } else {
                echo '<img src="default_image.jpg" alt="Default Image">'; // Ganti dengan path gambar default yang sesuai
            }
            echo '<h3>' . $row['nama'] . '</h3>';
            echo '<p>' . $row['daerah'] . '</p>';
            echo '<p>Rp ' . number_format($row['harga'], 0, ',', '.') . '</p>';
            echo '</div>';
        }
    } else {
        echo "Tidak ada data kontrakan.";
    }

    // Tutup koneksi database
    $conn->close();
    ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const kontrakanItems = document.querySelectorAll('.kontrakan-item');
    kontrakanItems.forEach(item => {
        item.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            window.location.href = 'deskkontrakan.html?id=' + id;
        });
    });
});
</script>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
