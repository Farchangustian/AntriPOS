<?php

// Memeriksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
?>

<nav class="col-md-2 d-none d-md-block bg-light sidebar sidebar-right">
    <div class="d-flex justify-content-between align-items-center p-3">
        <img src="../assets/img/icon_admin.png" alt="Admin Icon" class="img-fluid">
    </div>
    <div class="d-flex justify-content-center align-items-center p-3 border-top">
        <?php echo $username; ?>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="admin.php">
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="tambahdata.php">
                Menu Tambah Data
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="listdata.php">
                Daftar Data Poster
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="listpengajuan.php">
               Daftar Pengajuan Poster
            </a>
        </li>
    </ul>
</nav>
