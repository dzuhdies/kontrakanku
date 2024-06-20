<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Iklan</title>
    <link rel="stylesheet" href="ik.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Iklan</h1>
        <form action="aksiiklan.php" method="post" enctype="multipart/form-data">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" required></textarea>

            <label for="gambar">Gambar:</label>
            <input type="file" id="gambar" name="gambar" accept="image/*" required>

            <button type="submit">Tambah</button>
        </form>
    </div>
</body>
</html>
