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
                <h2>Manage Users</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
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

                        // Query untuk mengambil data pengguna dengan peran user saja
                        $sql = "SELECT id_user, nama_lengkap, email FROM user WHERE role='user'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data setiap baris
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["id_user"] . "</td>";
                                echo "<td>" . $row["nama_lengkap"] . "</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo '<td><button class="btn btn-danger">Hapus</button></td>';
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>Tidak ada data pengguna.</td></tr>";
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
