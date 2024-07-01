<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "crud";

// Membuat koneksi
$conn = mysqli_connect($host, $username, $password, $database);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

echo "Terhubung ke database!";
?>
