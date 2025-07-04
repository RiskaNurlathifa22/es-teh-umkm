<?php include 'config.php'; ?>
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

        .text {
            flex: 1 1 55%;
        }

        .text h2 {
            color: #8b5c3c;
            margin-bottom: 1rem;
        }

        .text h2.judul-tengah {
            text-align: center;
            color: #8b5c3c;
            margin-bottom: 1rem;
        }

        .text p {
            text-align: justify;
            margin-bottom: 1rem;
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

        @media (max-width: 768px) {
            main {
                flex-direction: column;
                padding: 1.5rem;
            }

            .text, .image {
                flex: 1 1 100%;
            }
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
    </nav>

    <main>
        <div class="text">
            <h2 class="judul-tengah">Tentang Kami</h2>
            <p>
                Sentra UMKM Es Teh hadir sebagai wujud kecintaan kami terhadap minuman sederhana yang digemari oleh semua kalangan: es teh. 
                Kami percaya bahwa es teh bukan sekadar pelepas dahaga, melainkan juga bagian dari budaya dan kebersamaan masyarakat Indonesia.
            </p>
            <p>
                Dengan bahan-bahan alami dan racikan khas, kami menyajikan berbagai varian rasa mulai dari teh klasik, teh susu, hingga teh buah kekinian. 
                Setiap produk kami diracik oleh tangan-tangan UMKM lokal yang penuh semangat dan dedikasi dalam menciptakan cita rasa terbaik.
            </p>
            <p>
                Bergabunglah dalam gerakan mendukung pelaku usaha lokal. Setiap gelas es teh yang Anda nikmati turut menghidupkan ekonomi rakyat dan membuka peluang usaha yang lebih luas.
            </p>
        </div>
        <div class="image">
            <img src="assets/images/es-teh-kekinian.jpg" alt="Es Teh Kekinian">
        </div>
    </main>

    <footer>
        <p>Hubungi kami: <a href="https://wa.me/628123456789" target="_blank">08123456789</a></p>
    </footer>
</body>
</html>
