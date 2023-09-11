<?php
session_start();

// Konfigurasi koneksi ke database
$host = "localhost";        // Host database
$username = "root";    // Username database
$password = "";    // Password database
$database = "dbs_tunggutampil"; // Nama database

// Membuat koneksi
$koneksi = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Cek apakah user sudah login
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Query untuk mengambil role pengguna dari database
    $query = "SELECT role FROM tb_akses WHERE username = '$username'";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['role'] = $row['role'];
    }
}

?>
