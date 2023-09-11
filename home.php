<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Penampil Poster</title>
    <!-- Link ke Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        /* Tambahkan margin bawah di elemen dengan id carouselExampleCaptions */
        #carouselExampleCaptions {
            margin-top: 1em;
        }
    </style>
</head>
<body>
    <div class="container mt-5 text-center">
        <h1 class="mb-4">AntriPos (Aplikasi Antrian Penampil Poster)</h1>
        
       <?php include 'bar/navbar-home.php'; ?>
        
        <!-- Tambahkan konten aplikasi di sini -->
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                include 'config/koneksi.php'; // Pastikan ini menginisialisasi $koneksi

                // Query untuk mengambil data gambar dari database
                $query = "SELECT * FROM tb_data WHERE konfirmasi = 1";
                $result = $koneksi->query($query);

                if (!$result) {
                    die("Query error: " . $koneksi->error);
                }

                $currentRow = 0;
                while ($row = $result->fetch_assoc()) {
                    $activeClass = ($currentRow == 0) ? 'active' : '';
                    echo '<div class="carousel-item ' . $activeClass . '">';
                    echo '<img src="assets/img/' . $row["gambar"] . '" class="d-block w-100" alt="Gambar" style="max-width: 1080px; height: auto;">';
                    echo '<div class="carousel-caption d-none d-md-block">';
                    echo '<h5>' . $row["judul_poster"] . '</h5>';
                    echo '<p>' . $row["deskripsi"] . '</p>';
                    echo '</div>';
                    echo '</div>';
                    $currentRow++;
                }
                ?>
            </div>
            <!-- Tombol navigasi slider -->
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <!-- Running Text -->
<div class="container text-center mt-3">
    <marquee behavior="scroll" direction="left">
        <?php
        // Include file koneksi
        // Query untuk mengambil data dari database
        $sql = "SELECT divisi, judul_poster, deskripsi, awal_tanggal_rilis, akhir_tanggal_rilis FROM tb_data WHERE konfirmasi = 1 ORDER BY id DESC";
        $result = $koneksi->query($sql);

        if ($result->num_rows > 0) {
    $counter = 1; // Inisialisasi variabel counter
    // Menampilkan data dalam running text
    while ($row = $result->fetch_assoc()) {
        echo "No." . $counter . "&nbsp; &nbsp;";
        // Tampilkan data lain sesuai dengan kebutuhan Anda
        echo "Divisi: " . $row["divisi"] . " - ";
        echo "Judul Poster: " . $row["judul_poster"] . " - ";
        //echo "Deskripsi: " . $row["deskripsi"] . " - ";
        //echo "Awal Tanggal Rilis: " . date("d-m-Y", strtotime($row["awal_tanggal_rilis"])) . " - ";
        echo "Akhir Tanggal Rilis: " . date("d-m-Y", strtotime($row["akhir_tanggal_rilis"])) . " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";
        $counter++; // Increment counter untuk nomor urut berikutnya
            }
        } else {
            echo "Tidak ada data untuk ditampilkan.";
        }

        // Tutup koneksi ke database
        $koneksi->close();
        ?>
    </marquee>
</div>


        <!-- Link ke Bootstrap JS, Popper.js, dan jQuery -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="./assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </div>
</body>
</html>
