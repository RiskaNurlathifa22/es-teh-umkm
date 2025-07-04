<?php
session_start();

// Validasi session data
if (!isset($_SESSION['order_data'])) {
    header("Location: order.php");
    exit();
}

$order_data = $_SESSION['order_data'];
unset($_SESSION['order_data']); // Bersihkan session
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pesanan Berhasil</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Pesanan Berhasil!</h1>
    <p>Terima kasih, <?= htmlspecialchars($order_data['nama']) ?>!</p>
    <p>Total pesanan: Rp <?= number_format($order_data['total'], 0, ',', '.') ?></p>
    <a href="order.php">Kembali ke Menu</a>
</body>
</html>