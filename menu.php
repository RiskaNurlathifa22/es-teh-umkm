<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Menu Es Teh</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Menu Es Teh Kami</h1>
    <div class="menu-container">
        <?php
        $sql = "SELECT * FROM menu";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()):
        ?>
        <div class="menu-item">
            <img src="assets/images/<?= $row['gambar'] ?>" width="100">
            <h3><?= $row['nama'] ?></h3>
            <p>Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
            <p><?= $row['deskripsi'] ?></p>
        </div>
        <?php endwhile; ?>
    </div>
    <a href="order.php" class="btn">Pesan Sekarang</a>
</body>
</html>