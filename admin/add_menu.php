<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    
    // Upload gambar (sederhana)
    $gambar = 'default.jpg';
    if ($_FILES['gambar']['name']) {
        $gambar = basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/images/$gambar");
    }

    $stmt = $conn->prepare("INSERT INTO menu (nama, harga, deskripsi, gambar) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $nama, $harga, $deskripsi, $gambar);
    $stmt->execute();

    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Menu</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: #fef9f4;
            color: #4b2e2e;
            padding: 2rem;
        }

        h2 {
            text-align: center;
            color: #8b5c3c;
            margin-bottom: 1.5rem;
        }

        form {
            background-color: white;
            max-width: 500px;
            margin: auto;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-top: 1rem;
            margin-bottom: 0.3rem;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 0.6rem;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button, .back-btn {
            margin-top: 1.5rem;
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 6px;
            background-color: #8b5c3c;
            color: white;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        button:hover, .back-btn:hover {
            background-color: #6e4227;
        }

        .back-btn {
            background-color: #aaa;
            margin-left: 10px;
        }
    </style>
</head>
<body>

    <h2>Tambah Menu Baru</h2>

    <form method="POST" enctype="multipart/form-data">
        <label>Nama Menu</label>
        <input type="text" name="nama" placeholder="Contoh: Nasi Goreng" required>

        <label>Harga</label>
        <input type="number" name="harga" placeholder="Contoh: 15000" required>

        <label>Deskripsi</label>
        <textarea name="deskripsi" placeholder="Deskripsi singkat menu" rows="4"></textarea>

        <label>Gambar</label>
        <input type="file" name="gambar" accept="image/*">

        <button type="submit">Simpan</button>
        <a href="dashboard.php" class="back-btn">← Kembali</a>
    </form>

</body>
</html>
