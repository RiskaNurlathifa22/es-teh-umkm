<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
include '../config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
</head>
<body>
    <h1>Kelola Menu</h1>
    <a href="add_menu.php">Tambah Menu Baru</a>
    
    <table border="1">
        <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php
        $sql = "SELECT * FROM menu";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['nama'] ?></td>
            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
            <td>
                <a href="edit_menu.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="delete_menu.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus menu?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Daftar Pesanan</h2>
    <table border="1">
        <tr>
            <th>Nama Pelanggan</th>
            <th>Menu</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr>
        <?php
        $sql = "SELECT orders.*, menu.nama as menu_nama 
                FROM orders JOIN menu ON orders.menu_id = menu.id";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['nama_pelanggan'] ?></td>
            <td><?= $row['menu_nama'] ?></td>
            <td><?= $row['jumlah'] ?></td>
            <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="logout.php">Logout</a>
</body>
</html>