<?php
include 'koneksi.php';

$sql = "SELECT nama, tanggal_mulai_sewa, tanggal_akhir_sewa, status FROM kontrakan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontrakanku</title>
    <link rel="stylesheet" href="kontrakanku.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>KONTRAKANKU</h2>
            <ul>
                <li><a href="akun.html">Akun Saya</a></li>
                <li><a href="pemes.html">Pemesanan</a></li>
                <li><a href="#" class="active">Kontrakanku</a></li>
                <li><a href="#">Keluar Akun</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h2>Kontrakanmu</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nama Kontrakan</th>
                        <th>Tanggal Disewakan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $tanggal_sewa = ($row["tanggal_mulai_sewa"] && $row["tanggal_akhir_sewa"]) ? date("m-d-Y", strtotime($row["tanggal_mulai_sewa"])) . " s/d " . date("m-d-Y", strtotime($row["tanggal_akhir_sewa"])) : "-";
                            echo "<tr>";
                            echo "<td>" . $row["nama"] . "</td>";
                            echo "<td>" . $tanggal_sewa . "</td>";
                            echo "<td>" . ($row["status"] == 'available' ? 'Belum Disewa' : 'Tersewa') . "</td>";
                            echo "<td><button class='edit-button'>Edit</button><button class='delete-button'>Hapus</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Tidak ada data kontrakan</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
