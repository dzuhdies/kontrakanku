<?php
include "koneksi.php";

// Ambil ID kontrakan dari URL
$idkontrakan = isset($_GET['id']) ? $_GET['id'] : 0;

// Query untuk mengambil data kontrakan berdasarkan ID
$sql = "SELECT * FROM kontrakan WHERE idkontrakan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idkontrakan);
$stmt->execute();
$result = $stmt->get_result();
$kontrakan = $result->fetch_assoc();

// Tutup koneksi
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontrakanku</title>
    <link rel="stylesheet" href="deskkontrakan.css">
</head>

<body>
    <header>
        <h1>KONTRAKANKU</h1>
        <nav>
            <a href="#" class="active">Contact</a>
        </nav>
    </header>

    <main>
        <div class="property-image">
            <img src="<?php echo $kontrakan['gambar']; ?>" alt="<?php echo $kontrakan['nama']; ?>">
            <div class="image-nav">
                <button class="prev">&#10094;</button>
                <button class="next">&#10095;</button>
            </div>
        </div>

        <div class="property-details">
            <h2 class="price">Rp. <?php echo number_format($kontrakan['harga'], 0, ',', '.'); ?> <span class="nego">*nego</span></h2>
            <h3><?php echo $kontrakan['nama']; ?></h3>
            <p><?php echo $kontrakan['daerah']; ?></p>

            <div class="owner-contact">
                <h4>Nama Pemilik</h4>
                <button class="chat-button">Chat</button>
            </div>

            <section class="property-info">
                <h4>Informasi Kontrakan</h4>
                <table>
                    <tr>
                        <td>Kamar Tidur</td>
                        <td><?php echo $kontrakan['jumlah_kamar']; ?></td>
                    </tr>
                    <tr>
                        <td>Kamar Mandi</td>
                        <td><?php echo $kontrakan['jumlah_kamarmandi']; ?></td>
                    </tr>
                    <tr>
                        <td>Listrik</td>
                        <td><?php echo $kontrakan['listrik_kwh']; ?> kWh</td>
                    </tr>
                    <tr>
                        <td>Air PDAM</td>
                        <td><?php echo $kontrakan['air_pdam'] == 'Y' ? 'Ya' : 'Tidak'; ?></td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td><?php echo $kontrakan['deskripsi']; ?></td>
                    </tr>
                </table>
            </section>

            <button class="more-info" onclick="location.href='chekout.php?id_kontrakan=<?php echo $kontrakan['idkontrakan']; ?>'">COCOK DEH - LANJUT CHECKOUT</button>

        </div>
    </main>
</body>

</html>
