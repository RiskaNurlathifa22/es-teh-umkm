<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
include '../config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: #fef9f4;
            color: #4b2e2e;
            padding: 2rem;
        }

        h1, h2 {
            color: #8b5c3c;
            margin-bottom: 1rem;
        }

        .btn, .aksi-btn {
            display: inline-block;
            padding: 6px 12px;
            margin: 2px;
            border: none;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .btn {
            background-color: #8b5c3c;
        }

        .btn:hover {
            background-color: #6e4227;
        }

        .aksi-edit { background-color: #f0ad4e; }
        .aksi-hapus { background-color: #d9534f; }
        .aksi-selesai { background-color: #5cb85c; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
            background-color: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 0.8rem;
            text-align: left;
        }

        th {
            background-color: #e6d2c0;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>

    <div class="top-bar">
        <h1>Dashboard Admin</h1>
        <a href="logout.php" class="btn">Logout</a>
    </div>

    <a href="add_menu.php" class="btn">+ Tambah Menu Baru</a>

    <h2>Daftar Menu</h2>
    <table>
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
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
            <td>
                <a class="aksi-btn aksi-edit" href="edit_menu.php?id=<?= $row['id'] ?>">Edit</a>
                <a class="aksi-btn aksi-hapus" href="delete_menu.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus menu ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Daftar Pesanan</h2>
    <table>
        <tr>
            <th>Nama Pelanggan</th>
            <th>Menu</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php
        $sql = "SELECT orders.*, menu.nama as menu_nama 
                FROM orders 
                JOIN menu ON orders.menu_id = menu.id
                ORDER BY orders.id DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= htmlspecialchars($row['nama_pelanggan']) ?></td>
            <td><?= htmlspecialchars($row['menu_nama']) ?></td>
            <td><?= $row['jumlah'] ?></td>
            <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
            <td><?= htmlspecialchars($row['status']) ?></td>
            <td>
                <a class="aksi-btn aksi-edit" href="edit_order.php?id=<?= $row['id'] ?>">Edit</a>
                <a class="aksi-btn aksi-hapus" href="delete_order.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus pesanan ini?')">Hapus</a>
                <a class="aksi-btn aksi-selesai" href="finish_order.php?id=<?= $row['id'] ?>" onclick="return confirm('Tandai pesanan sebagai selesai?')">Selesai</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
