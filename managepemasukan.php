<?php
// Koneksi ke database
include "koneksi.php";

// Query untuk mengambil data pembayaran
$sql = "SELECT pembayaran.id_pembayaran, kontrakan.nama AS nama_kontrakan, user.nama AS penyewa, pembayaran.tanggal_pembayaran, kontrakan.harga 
        FROM pembayaran 
        JOIN kontrakan ON pembayaran.id_kontrakan = kontrakan.idkontrakan
        JOIN user ON pembayaran.id_user = user.id_user";
$result = $conn->query($sql);

// Menyimpan total pemasukan
$total_pemasukan = 0;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Kontrakanku</title>
    <link rel="stylesheet" href="admin.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
    <div class="container">
        <nav class="sidebar">
            <div class="sidebar-header">
                <h2>Kontrakanku</h2>
            </div>
            <ul>
                <li><a href="dashboard_admin.php"><i class="fas fa-users"></i> User Manager</a></li>
                <li><a href="managekontrakan.php"><i class="fas fa-home"></i> Manage Kontrakan</a></li>
                <li><a href="managepemasukan.php"><i class="fas fa-money-bill-wave"></i> Manage Pemasukan</a></li>
                <li><a href="manageiklan.php"><i class="fas fa-money-bill-wave"></i> Manage Iklan</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </nav>

        <main class="content">
            <header>
                <h1>Dashboard Admin</h1>
            </header>

            <section class="main-content">
                <h2>Manage Pemasukan</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Nama Kontrakan</th>
                            <th>Penyewa</th>
                            <th>Tanggal Checkout</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            // Output data dari setiap row
                            while($row = $result->fetch_assoc()) {
                                $total_pemasukan += $row['harga'];
                                echo "<tr>";
                                echo "<td>" . $row['id_pembayaran'] . "</td>";
                                echo "<td>" . $row['nama_kontrakan'] . "</td>";
                                echo "<td>" . $row['penyewa'] . "</td>";
                                echo "<td>" . $row['tanggal_pembayaran'] . "</td>";
                                echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Tidak ada data pembayaran.</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
                <div style="margin-top: 20px;">
                    <h3>Total Pemasukan: Rp <?php echo number_format($total_pemasukan, 0, ',', '.'); ?></h3>
                </div>
            </section>
        </main>
    </div>
</body>

</html>
