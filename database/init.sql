-- Buat database
CREATE DATABASE IF NOT EXISTS `es_teh_db`;
USE `es_teh_db`;

-- Tabel menu
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` text,
  `gambar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- Tabel pesanan
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(100) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`menu_id`) REFERENCES `menu`(`id`)
);

-- Insert contoh data menu
INSERT INTO `menu` (`nama`, `harga`, `deskripsi`, `gambar`) VALUES
('Es Teh Original', 5000, 'Es teh dengan gula pasir', 'original.jpg'),
('Es Teh Lemon', 7000, 'Es teh dengan lemon segar', 'lemon.jpg'),
('Es Teh Susu', 8000, 'Es teh dengan susu kental manis', 'susu.jpg');