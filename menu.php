<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Menu Es Teh</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fef9f4;
            color: #4b2e2e;
            margin: 0;
            padding: 0;
        }

        header {
            background-image: url('assets/images/header.jpg');
            background-size: cover;
            background-position: center;
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-shadow: 1px 1px 5px rgba(0,0,0,0.6);
            text-align: center;
            padding: 1rem;
        }

        header h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        header p {
            font-size: 1.2rem;
        }

        nav {
            background-color: #d7b49e;
            padding: 1rem;
            text-align: center;
        }

        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #4b2e2e;
            font-weight: bold;
        }

        nav a:hover {
            color: #8b5c3c;
        }

        header h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        header p {
            font-size: 1.2rem;
        }

        .menu-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
            padding: 2rem;
        }

        .menu-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            width: 220px;
            padding: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }

        .menu-item img {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }

        .menu-item h3 {
            margin: 0.5rem 0;
            color: #4b2e2e;
        }

        .menu-item p {
            margin: 0.25rem 0;
            font-size: 14px;
        }

        .btn {
            display: block;
            width: fit-content;
            margin: 2rem auto;
            padding: 0.8rem 1.5rem;
            background-color: #8b5c3c;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #6c432f;
        }

        footer {
            text-align: center;
            padding: 1rem;
            background-color: #8b5c3c;
            color: white;
        }
        
        

    </style>
</head>
<body>
    <header>
        <h1>Sentra UMKM Es Teh</h1>
        <p>Minuman segar untuk hari Anda!</p>
    </header>

    <nav>
        <a href="index.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="order.php">Pesan</a>
        <a href="admin/login.php" style="float: right;">Login Admin</a>
    </nav>

    <h2 style="text-align: center;
            color: #8b5c3c;
            margin-bottom: 1rem; margin-top: 3rem;">Menu Es Teh Kami</h2>

    <div class="menu-container">
        <?php
        $sql = "SELECT * FROM menu";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0):
            while($row = $result->fetch_assoc()):
        ?>
            <div class="menu-item">
                <img src="assets/images/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama']) ?>">
                <h3><?= htmlspecialchars($row['nama']) ?></h3>
                <p>Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
                <p><?= htmlspecialchars($row['deskripsi']) ?></p>
            </div>
        <?php
            endwhile;
        else:
            echo "<p style='text-align:center;'>Menu belum tersedia saat ini.</p>";
        endif;
        ?>
    </div>

    <a href="order.php" class="btn">Pesan Sekarang</a>

    <footer>
        &copy; <?= date('Y') ?> Sentra UMKM Es Teh
    </footer>
</body>
</html>
