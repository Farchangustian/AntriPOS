<?php
include '../config/koneksi.php'; // Menggunakan koneksi.php untuk menghubungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa apakah username sudah terdaftar di dalam database
    $checkQuery = "SELECT * FROM tb_akses WHERE username = '$username'";
    $checkResult = $koneksi->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        $registerError = "Username sudah terdaftar. Silakan coba username lain.";
    } else {
        // Jika username belum terdaftar, lakukan proses registrasi
        // Anda perlu menambahkan logika penyimpanan data registrasi ke dalam database di sini.
        $insertQuery = "INSERT INTO tb_akses (username, email, password) VALUES ('$username', '$username', '$password')";
        // Kemudian eksekusi query tersebut.
        
        // Setelah registrasi berhasil, Anda dapat mengarahkan pengguna ke halaman login.
        header("Location: login.php"); // Ganti dengan path yang sesuai
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Register Admin Poster Antrian</title>
    <!-- Link ke Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-3 text-center">
        <h1 class="mb-4">Halaman Register Admin Poster Antrian</h1>
        
        <?php include '../bar/navbar-admin.php'; ?>
        
        <!-- Icon -->
        <div class="container mt-5 text-center">
            <img src="../assets/img/icon_login.png" id="icon" alt="User Icon" width="120" height="120" />
        </div>

        <!-- Formulir Register -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-4">
                <form method="post" action="">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                    </div>
                    <!-- Tambahkan informasi tambahan yang diperlukan untuk registrasi -->
                    <!-- Misalnya: -->
                    <!-- <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                    </div> -->
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </form>
                <?php if (isset($registerError)) { ?>
                    <div class="mt-3 text-danger">
                        <?php echo $registerError; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Modal Register Berhasil -->
    <div class="modal fade" id="registerSuccessModal" tabindex="-1" role="dialog" aria-labelledby="registerSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerSuccessModalLabel">Registrasi Berhasil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Selamat, registrasi Anda berhasil!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Link ke Bootstrap JS, Popper.js, dan jQuery -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script type="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.4/umd/popper.min.js.map"></script>

    <?php
    // Tampilkan modal jika registrasi berhasil
    if (isset($registerSuccess)) {
        echo '<script>
            $(document).ready(function(){
                $("#registerSuccessModal").modal("show");
            });
        </script>';
    }
    ?>
</body>
</html>
