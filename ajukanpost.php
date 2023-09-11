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
    </div>
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Form for Adding Data -->
            <form action="process_form_user.php" method="POST" enctype="multipart/form-data">
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
        </div>
    </div>
</div>

<!-- Konfirmasi Modal -->
    <div class="modal fade" id="konfirmasiModal" tabindex="-1" role="dialog" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin mengirim data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#terimaKasihModal">Ya, Kirim</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Terima Kasih Modal -->
    <div class="modal fade" id="terimaKasihModal" tabindex="-1" role="dialog" aria-labelledby="terimaKasihModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="terimaKasihModalLabel">Terima Kasih</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Terima kasih telah mengirim data. Data Anda akan diproses oleh admin.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

<script>
        // Ambil semua tanggal rilis yang sudah ada dalam database
        var existingDates = <?php echo json_encode($existingDatesArray); ?>; // Gantilah ini dengan data yang sesuai dari PHP

        // Ambil elemen input tanggal
        var awalTanggalRilisInput = document.getElementById('awal_tanggal_rilis');
        
        // Fungsi untuk memblokir tanggal-tanggal tertentu
        function blockDates() {
            var selectedDate = new Date(awalTanggalRilisInput.value);
            
            // Periksa apakah tanggal yang dipilih sudah ada dalam array tanggal yang sudah ada
            if (existingDates.includes(selectedDate.toISOString().split('T')[0])) {
                // Tanggal sudah ada dalam database, maka tampilkan pesan kesalahan
                alert('Tanggal yang Anda pilih sudah ada dalam database. Silakan pilih tanggal lain.');
                awalTanggalRilisInput.value = ''; // Hapus nilai tanggal yang dipilih
            }
        }

        // Tambahkan event listener untuk memblokir tanggal-tanggal tertentu saat nilai input berubah
        awalTanggalRilisInput.addEventListener('change', blockDates);
    </script>
</body>
</main>
</html>