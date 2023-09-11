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

        <?php
        include 'config/koneksi.php';

        // Fungsi untuk menghasilkan nomor urut
        function generateRowNumber($result, $currentRow) {
            return $currentRow + 1;
        }


        $query = "SELECT * FROM tb_data ORDER BY awal_tanggal_rilis DESC;"; // Sesuaikan dengan query Anda
        $result = $koneksi->query($query);

        // Pastikan query di atas telah berhasil dieksekusi
        if (!$result) {
            die("Query error: " . $koneksi->error);
        }
        ?>

        <?php include 'bar/navbar-home.php'; ?>

            <!-- Konten Utama -->
            <main class="col-md-12 ms-sm-auto col-lg-13 px-md-9">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Daftar Data</h1>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No. Urut Antrian</th>
                                <th>Nama Pelapor</th>
                                <th>Divisi</th>
                                <th>Judul Poster</th>
                                <th>Deskripsi</th>
                                <th>Awal Tanggal Rilis</th>
                                <th>Akhir Tanggal Rilis</th>
                                <th>Gambar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                $currentRow = 0;
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . generateRowNumber($result, $currentRow) . "</td>";
                                    echo "<td>" . $row["nama_pelapor"] . "</td>";
                                    echo "<td>" . $row["divisi"] . "</td>";
                                    echo "<td>" . $row["judul_poster"] . "</td>";
                                    echo "<td>" . $row["deskripsi"] . "</td>";
                                    echo "<td>" . date("d-m-Y", strtotime($row["awal_tanggal_rilis"])) . "</td>";
                                    echo "<td>" . date("d-m-Y", strtotime($row["akhir_tanggal_rilis"])) . "</td>";
                                    echo "<td><a href='#' data-toggle='modal' data-target='#gambarModal" . $currentRow . "'><img src='assets/img/" . $row["gambar"] . "' alt='Gambar' width='43'></a></td>";
                                    echo "</tr>";
                                    // Modal untuk gambar
                                    echo '<div class="modal fade" id="gambarModal' . $currentRow . '" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel' . $currentRow . '" aria-hidden="true">';
                                    echo '<div class="modal-dialog modal-lg" role="document">';
                                    echo '<div class="modal-content">';
                                    echo '<div class="modal-header">';
                                    echo '<h5 class="modal-title" id="gambarModalLabel' . $currentRow . '">Gambar Poster</h5>';
                                    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                                    echo '<span aria-hidden="true">&times;</span>';
                                    echo '</button>';
                                    echo '</div>';
                                    echo '<div class="modal-body">';
                                    echo '<img src="assets/img/' . $row["gambar"] . '" alt="Gambar" style="max-width: 720px; max-height: 1000px;">'; // 
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    
                                    $currentRow++;
                                }
                            } else {
                                echo "<tr><td colspan='8'>Tidak ada data.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Link ke Bootstrap JS, Popper.js, dan jQuery -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>