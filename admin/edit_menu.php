<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
include '../config.php';

$id = $_GET['id'];
$sql = "SELECT * FROM menu WHERE id = $id";
$result = $conn->query($sql);
$menu = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    $update = $conn->prepare("UPDATE menu SET nama=?, harga=?, deskripsi=? WHERE id=?");
    $update->bind_param("sdsi", $nama, $harga, $deskripsi, $id);
    $update->execute();

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: #fef9f4;
            color: #4b2e2e;
            padding: 2rem;
        }

        h2 {
            color: #8b5c3c;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        form {
            background-color: #fff;
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

        input, textarea {
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

    <h2>Edit Menu</h2>
    <form method="POST">
        <label>Nama Menu</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($menu['nama']) ?>" required>

        <label>Harga</label>
        <input type="number" name="harga" value="<?= $menu['harga'] ?>" required>

        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="4"><?= htmlspecialchars($menu['deskripsi']) ?></textarea>

        <button type="submit">Simpan Perubahan</button>
        <a href="dashboard.php" class="back-btn">Kembali</a>
    </form>

</body>
</html>
