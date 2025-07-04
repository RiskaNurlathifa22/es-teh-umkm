<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include '../config.php';

$id = $_GET['id'];
$sql = "SELECT * FROM orders WHERE id = $id";
$result = $conn->query($sql);
$order = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $menu_id = $_POST['menu_id'];
    $jumlah = $_POST['jumlah'];

    $menu = $conn->query("SELECT harga FROM menu WHERE id = $menu_id")->fetch_assoc();
    $total = $menu['harga'] * $jumlah;

    $stmt = $conn->prepare("UPDATE orders SET nama_pelanggan=?, menu_id=?, jumlah=?, total_harga=? WHERE id=?");
    $stmt->bind_param("siiii", $nama, $menu_id, $jumlah, $total, $id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit;
}

$menuList = $conn->query("SELECT * FROM menu");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pesanan</title>
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

        input, select {
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
    <h2 style="text-align: center;">Edit Pesanan</h2>
    <form method="POST">
        <label>Nama Pelanggan:</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($order['nama_pelanggan']) ?>" required>

        <label>Menu:</label>
        <select name="menu_id" required>
            <?php while ($menu = $menuList->fetch_assoc()): ?>
                <option value="<?= $menu['id'] ?>" <?= $menu['id'] == $order['menu_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($menu['nama']) ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Jumlah:</label>
        <input type="number" name="jumlah" value="<?= $order['jumlah'] ?>" min="1" required>

        <label>Status:</label>
        <input type="text" name="status" value="<?= htmlspecialchars($order['status']) ?>" required>

        <button type="submit">Simpan</button>
        <a href="dashboard.php" class="back-btn">Kembali</a>
    </form>
</body>
</html>
