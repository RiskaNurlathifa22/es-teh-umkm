<?php
session_start();
include 'config.php';

try {
    // Validasi metode request
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid request method");
    }

    // Validasi CSRF token
    if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        throw new Exception("Invalid CSRF token");
    }

    // Validasi input
    $required_fields = ['nama_pelanggan', 'menu_id', 'jumlah'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("Field $field harus diisi");
        }
    }

    // Sanitasi input
    $nama_pelanggan = htmlspecialchars(trim($_POST['nama_pelanggan']));
    $menu_id = (int)$_POST['menu_id'];
    $jumlah = (int)$_POST['jumlah'];

    // Validasi nilai
    if ($menu_id <= 0 || $jumlah <= 0) {
        throw new Exception("Input tidak valid");
    }

    // Dapatkan harga menu
    $stmt = $conn->prepare("SELECT harga FROM menu WHERE id = ?");
    $stmt->bind_param("i", $menu_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        throw new Exception("Menu tidak ditemukan");
    }

    $menu = $result->fetch_assoc();
    $total_harga = $menu['harga'] * $jumlah;

    // Simpan pesanan
    $stmt = $conn->prepare("INSERT INTO orders (nama_pelanggan, menu_id, jumlah, total_harga) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siii", $nama_pelanggan, $menu_id, $jumlah, $total_harga);
    
    if (!$stmt->execute()) {
        throw new Exception("Gagal menyimpan pesanan: " . $stmt->error);
    }

    // Regenerate CSRF token untuk session berikutnya
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

    // Redirect ke halaman sukses
    $_SESSION['order_data'] = [
        'nama' => $nama_pelanggan,
        'total' => $total_harga
    ];
    
    header("Location: order_success.php");
    exit();

} catch (Exception $e) {
    // Simpan error di session dan redirect ke form
    $_SESSION['error'] = $e->getMessage();
    header("Location: order.php");
    exit();
} finally {
    if (isset($stmt)) $stmt->close();
    $conn->close();
}
?>