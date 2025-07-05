<?php
$host = "sql12.freesqldatabase.com";
$username = "sql12788433";
$password = "MfwkwdcxXj";
$database = "sql12788433";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>