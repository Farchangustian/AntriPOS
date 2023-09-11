<?php
include '../config/koneksi.php'; // Menggunakan koneksi.php untuk menghubungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa apakah username dan password cocok di dalam database
    $query = "SELECT * FROM tb_akses WHERE username = '$username' AND password = '$password'";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: admin.php"); // Ganti dengan path yang sesuai
        exit;
    } else {
        $loginError = "Username or password is incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login Admin Poster Antrian</title>
    <!-- Link ke Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-3 text-center">
        <h1 class="mb-4">Halaman Login Admin Poster Antrian</h1>
        
        <?php include '../bar/navbar-admin.php'; ?>
        
        <!-- Icon -->
        <div class="container mt-5	 text-center">
            <img src="../assets/img/icon_login.png" id="icon" alt="User Icon"width="120" height="120" />
        </div>

        <!-- Formulir Login -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-4">
                <form method="post" action="">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                <div class="mt-3">
                        <a href="register.php" class="btn btn-secondary btn-block">Register</a>
                    </div>

                <?php if (isset($loginError)) { ?>
                    <div class="mt-3 text-danger">
                        <?php echo $loginError; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Link ke Bootstrap JS, Popper.js, dan jQuery -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
