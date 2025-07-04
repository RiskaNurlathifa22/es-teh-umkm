<?php
session_start();
include 'config.php';

// Generate CSRF token hanya jika belum ada
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sentra UMKM - Es Teh</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fef9f4;
            color: #4b2e2e;
            line-height: 1.8;
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

        main {
            display: flex;
            flex-wrap: wrap;
            padding: 2rem 4rem;
            max-width: 1000px;
            margin: auto;
            gap: 2rem;
        }

        .image {
            flex: 1 1 40%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #8b5c3c;
            color: white;
            padding: 1rem;
            text-align: center;
            margin-top: 2rem;
        }

        footer a {
            color: #fff;
            text-decoration: underline;
        }

        .form-container {
            flex: 1 1 50%;
            background-color: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin: auto;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        form label {
            font-weight: bold;
            margin-bottom: 0.3rem;
        }

        form input[type="text"],
        form input[type="number"],
        form select {
            padding: 0.6rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
        }

        form button {
            padding: 0.8rem;
            background-color: #8b5c3c;
            color: white;
            font-size: 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: #6e4227;
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

    <main>
        <div class="form-container">
            <h2 style="text-align: center; color: #8b5c3c; margin-bottom: 1.5rem;">Form Pemesanan</h2>
            <form action="process_order.php" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama_pelanggan" required>

                <label for="menu">Pilih Menu:</label>
                <select id="menu" name="menu_id" required>
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

                <label for="jumlah">Jumlah:</label>
                <input type="number" id="jumlah" name="jumlah" min="1" required>

                <button type="submit">Pesan</button>
            </form>
        </div>
    </main>


    <footer>
        &copy; <?= date('Y') ?> Sentra UMKM Es Teh
    </footer>
</body>
</html>
<?php
$conn->close();
?>

