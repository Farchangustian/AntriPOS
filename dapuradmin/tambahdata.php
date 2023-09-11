<?php
session_start();

// Memeriksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

// Memeriksa apakah tombol "Log Out" ditekan
if (isset($_GET['logout'])) {
    session_destroy(); // Menghapus semua data sesi
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tambah Data</title>
    <!-- Link ke Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include '../bar/sidebar.php'; ?>

            <!-- Konten Utama -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Menu Tambah Data</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="login.php?logout=true" class="btn btn-sm btn-outline-secondary">Log Out</a>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-12">
        <!-- Form for Adding Data -->
        <form action="process_form.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama_pelapor" class="form-label">Nama Pelapor</label>
                <input type="text" class="form-control" id="nama_pelapor" name="nama_pelapor" required>
            </div>
            <div class="mb-3">
                <label for="divisi" class="form-label">Divisi</label>
                <input type="text" class="form-control" id="divisi" name="divisi" required>
            </div>
            <div class="mb-3">
                <label for="judul_poster" class="form-label">Judul Poster</label>
                <input type="text" class="form-control" id="judul_poster" name="judul_poster" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
            </div>
            <div class="mb-3">
                <label for="awal_tanggal_rilis" class="form-label">Awal Tanggal Rilis</label>
                <input type="date" class="form-control" id="awal_tanggal_rilis" name="awal_tanggal_rilis" required>
            </div>
            <div class="mb-3">
                <label for="akhir_tanggal_rilis" class="form-label">Akhir Tanggal Rilis</label>
                <input type="date" class="form-control" id="akhir_tanggal_rilis" name="akhir_tanggal_rilis" required>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar (Max 10 MB)</label>
                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
            </thead>
        </div>
    </div>
</main>


    <!-- Link ke Bootstrap JS, Popper.js, dan jQuery -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
