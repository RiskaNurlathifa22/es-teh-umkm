<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Error Pesanan</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Terjadi Kesalahan</h1>
    <p><?= isset($_SESSION['error_message']) ? htmlspecialchars($_SESSION['error_message']) : 'Terjadi kesalahan tidak diketahui' ?></p>
    <a href="order.php">Kembali ke Form Pesanan</a>
    <?php unset($_SESSION['error_message']); ?>
</body>
</html>