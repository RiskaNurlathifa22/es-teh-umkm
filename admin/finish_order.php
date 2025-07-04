<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
include '../config.php';

$id = $_GET['id'];
$conn->query("UPDATE orders SET status='selesai' WHERE id = $id");

header("Location: dashboard.php");
exit;
?>
