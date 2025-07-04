<?php
// Konfigurasi database (sesuaikan dengan cloud nanti)
$host = "localhost"; // Ganti dengan host cloud (misal: Cloud SQL)
$username = "root";  // Ganti dengan user cloud
$password = "";      // Ganti dengan password cloud
$database = "es_teh_db"; // Nama database

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>