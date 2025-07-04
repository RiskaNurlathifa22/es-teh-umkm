<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    
    // Upload gambar (sederhana)
    $gambar = 'default.jpg';
    if ($_FILES['gambar']['name']) {
        $gambar = basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/images/$gambar");
    }

    $sql = "INSERT INTO menu (nama, harga, deskripsi, gambar) 
            VALUES ('$nama', $harga, '$deskripsi', '$gambar')";
    $conn->query($sql);
    header('Location: dashboard.php');
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="nama" placeholder="Nama Menu" required>
    <input type="number" name="harga" placeholder="Harga" required>
    <textarea name="deskripsi" placeholder="Deskripsi"></textarea>
    <input type="file" name="gambar" accept="image/*">
    <button type="submit">Simpan</button>
</form>