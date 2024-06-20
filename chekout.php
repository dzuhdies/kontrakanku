<?php
include "koneksi.php";

// Ambil ID kontrakan dari URL
$id_kontrakan = isset($_GET['id_kontrakan']) ? $_GET['id_kontrakan'] : 0;
$id_user = 1; // Ganti dengan ID user yang sesuai

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal_mulai_sewa = $_POST['tanggalMulai'];
    $durasi_sewa = $_POST['durasiSewa'];
    $metode_pembayaran = $_POST['metodePembayaran'];

    // Hitung tanggal akhir sewa berdasarkan durasi
    $tanggal_akhir_sewa = date('Y-m-d', strtotime("+$durasi_sewa years", strtotime($tanggal_mulai_sewa)));

    // Simpan data pembayaran
    $sql = "INSERT INTO pembayaran (id_kontrakan, id_user, tanggal_pembayaran, metode_pembayaran) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $id_kontrakan, $id_user, $tanggal_mulai_sewa, $metode_pembayaran);
    $stmt->execute();

    // Update status kontrakan menjadi 'sold' dan simpan tanggal mulai serta akhir sewa
    $sql_update = "UPDATE kontrakan SET status = 'sold', tanggal_mulai_sewa = ?, tanggal_akhir_sewa = ? WHERE idkontrakan = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssi", $tanggal_mulai_sewa, $tanggal_akhir_sewa, $id_kontrakan);
    $stmt_update->execute();

    // Redirect ke halaman pembayaran
    header("Location: pembayaran.php");
    exit;
}

// Query untuk mengambil data kontrakan berdasarkan ID
$sql = "SELECT * FROM kontrakan WHERE idkontrakan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_kontrakan);
$stmt->execute();
$result = $stmt->get_result();
$kontrakan = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Kontrakan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8 flex justify-center">
        <!-- Sidebar sebelah kiri -->
        <div class="w-1/3 mr-8">
            <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                <h2 class="text-lg font-bold mb-4">Detail Kontrakan</h2>
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama:</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $kontrakan['nama']; ?>" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" readonly>
                </div>
                <div class="mb-4">
                    <label for="harga" class="block text-sm font-medium text-gray-700">Harga:</label>
                    <input type="text" id="harga" name="harga" value="Rp <?php echo number_format($kontrakan['harga'], 0, ',', '.'); ?>" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" readonly>
                </div>
                <a href="deskkontrakan.php?id=<?php echo $id_kontrakan; ?>" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md mr-2 hover:bg-gray-400 focus:bg-gray-400 focus:outline-none inline-block">Cancel</a>
            </div>
        </div>
        <!-- Gambar kontrakan sebelah kanan -->
        <div class="w-2/3">
            <div class="bg-white rounded-lg shadow-md p-4 mb-4 flex items-center justify-center">
                <img src="<?php echo $kontrakan['gambar']; ?>" alt="Kontrakan" class="w-64 h-auto rounded-lg">
                <div class="ml-4">
                    <h3 class="text-lg font-bold">Nama Kontrakan: <?php echo $kontrakan['nama']; ?></h3>
                    <p class="text-sm text-gray-600">Alamat: <?php echo $kontrakan['daerah']; ?></p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4">
                <h2 class="text-lg font-bold mb-4">Pembayaran</h2>
                <form method="POST" action="">
                    <div class="mb-4">
                        <label for="tanggalMulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai Sewa:</label>
                        <input type="date" id="tanggalMulai" name="tanggalMulai" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    </div>
                    <div class="mb-4">
                        <label for="durasiSewa" class="block text-sm font-medium text-gray-700">Durasi Sewa:</label>
                        <select id="durasiSewa" name="durasiSewa" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            <option value="1">1 Tahun</option>
                            <option value="2">2 Tahun</option>
                            <option value="3">3 Tahun</option>
                            <option value="4">4 Tahun</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="totalHarga" class="block text-sm font-medium text-gray-700">Total Harga (termasuk pajak 10%):</label>
                        <input type="text" id="totalHarga" name="totalHarga" value="Rp <?php echo number_format($kontrakan['harga'] * 1.1, 0, ',', '.'); ?>" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="metodePembayaran" class="block text-sm font-medium text-gray-700">Metode Pembayaran:</label>
                        <select id="metodePembayaran" name="metodePembayaran" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            <option value="bca">BCA</option>
                            <option value="bni">BNI</option>
                            <option value="bri">BRI</option>
                            <option value="mandiri">Mandiri</option>
                            <option value="qris">QRIS</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600 focus:bg-indigo-600 focus:outline-none">Checkout</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
