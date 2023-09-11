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
    <title>Dashboard Admin</title>
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
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <a href="login.php?logout=true" class="btn btn-sm btn-outline-secondary">Log Out</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Halo: <?php echo $username; ?></p>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Link ke Bootstrap JS, Popper.js, dan jQuery -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
