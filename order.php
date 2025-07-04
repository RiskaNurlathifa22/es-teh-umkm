<?php
session_start();
include 'config.php';

// Generate CSRF token hanya jika belum ada
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pesan Es Teh</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Form Pemesanan</h1>
    <form action="process_order.php" method="POST">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        
        <label>Nama:</label>
        <input type="text" name="nama_pelanggan" required>

        <label>Pilih Menu:</label>
        <select name="menu_id" required>
            <?php
            $sql = "SELECT * FROM menu";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()):
            ?>
            <option value="<?= $row['id'] ?>">
                <?= htmlspecialchars($row['nama']) ?> (Rp <?= number_format($row['harga'], 0, ',', '.') ?>)
            </option>
            <?php endwhile; ?>
        </select>

        <label>Jumlah:</label>
        <input type="number" name="jumlah" min="1" required>

        <button type="submit">Pesan</button>
    </form>
</body>
</html>
<?php
$conn->close();
?>