<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontrakanku</title>
    <link rel="stylesheet" href="carikontrakan.css">
</head>

<body>
    <header>
        <h1>KONTRAKANKU</h1>
    </header>
    <div class="container"> 
        <h2>Pilih Kontrakanmu dan buat jadi KENYATAAN</h2>
        <div class="form-container">
            <form action="dashbord_login.php" method="POST">
                <label for="location">Lokasi :</label>
                <input type="text" id="location" name="location">

                <div class="row">
                    <div class="column">
                        <label for="bedrooms">Jumlah Kamar :</label>
                        <input type="number" id="bedrooms" name="bedrooms">
                    </div>
                </div>
                <label for="air_pdam">Air PDAM:</label>
                <select id="air_pdam" name="air_pdam">
                    <option value="">Semua</option>
                    <option value="Y">Ya</option>
                    <option value="N">Tidak</option>
                </select>

                <label for="electricity">Listrik *Kwh :</label>
                <select id="electricity" name="electricity">
                    <option value="">Semua</option>
                    <option value="1300">1300 Kwh</option>
                    <option value="2200">2200 Kwh</option>
                    <option value="3500">3500 Kwh</option>
                </select>

                <button type="submit">Carikan saya</button>
            </form>
        </div>
    </div>

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
        // Tutup koneksi database
        $conn->close();
        ?>
    </div>

</body>

</html>
