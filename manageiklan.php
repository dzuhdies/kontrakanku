<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
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
                <li><a href="managepemasukan.html"><i class="fas fa-money-bill-wave"></i> Manage Pemasukan</a></li>
                <li><a href="manageiklan.php"><i class="fas fa-money-bill-wave"></i> Manage Iklan</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </nav>

        <main class="content">
            <header>
                <h1>Dashboard Admin</h1>
            </header>

            <section class="main-content">
                <h2>Manage Iklan</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Iklan</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
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

                        // Query untuk mengambil data iklan
                        $sql = "SELECT id, nama, deskripsi, gambar, status FROM iklan";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data setiap baris
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["nama"] . "</td>";
                                echo "<td>" . $row["deskripsi"] . "</td>";
                                echo "<td><img src='" . $row["gambar"] . "' alt='" . $row["nama"] . "' style='width: 100px; height: auto;'></td>";
                                echo "<td>" . ucfirst($row["status"]) . "</td>";
                                echo '<td>
                                        <form style="display:inline-block;" action="approveiklan.php" method="POST">
                                            <input type="hidden" name="id" value="' . $row["id"] . '">
                                            <button type="submit" class="btn btn-success">Approve</button>
                                        </form>
                                        <form style="display:inline-block;" action="rejectiklan.php" method="POST">
                                            <input type="hidden" name="id" value="' . $row["id"] . '">
                                            <button type="submit" class="btn btn-danger">Reject</button>
                                        </form>
                                      </td>';
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Tidak ada data iklan.</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>

</html>
