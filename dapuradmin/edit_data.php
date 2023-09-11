<?php
include '../config/koneksi.php'; // Pastikan ini menginisialisasi $koneksi

// Periksa apakah ID data dikirimkan melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data berdasarkan ID
    $query = "SELECT * FROM tb_data WHERE id = $id";
    $result = $koneksi->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Periksa apakah form pengeditan data telah disubmit
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama_pelapor = $_POST['nama_pelapor'];
            $divisi = $_POST['divisi'];
            $judul_poster = $_POST['judul_poster'];
            $deskripsi = $_POST['deskripsi'];
            $awal_tanggal_rilis = $_POST['awal_tanggal_rilis'];
            $akhir_tanggal_rilis = $_POST['akhir_tanggal_rilis'];

            // Query untuk mengupdate data
            $updateQuery = "UPDATE tb_data SET
                nama_pelapor = '$nama_pelapor',
                divisi = '$divisi',
                judul_poster = '$judul_poster',
                deskripsi = '$deskripsi',
                awal_tanggal_rilis = '$awal_tanggal_rilis',
                akhir_tanggal_rilis = '$akhir_tanggal_rilis'
                WHERE id = $id";

            if ($koneksi->query($updateQuery) === TRUE) {
                // Jika berhasil diupdate, alihkan kembali ke halaman Daftar Data
                echo '<script>
                    alert("Perubahan berhasil disimpan.");
                    window.location.href = "listdata.php";
                </script>';
                exit;
            } else {
                echo "Error: " . $updateQuery . "<br>" . $koneksi->error;
            }
        }
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "ID data tidak ditemukan.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <!-- Link ke Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Edit Data</h1>
        <form action="" method="POST">
            <!-- Form pengeditan data -->
            <div class="mb-3">
                <label for="nama_pelapor" class="form-label">Nama Pelapor</label>
                <input type="text" class="form-control" id="nama_pelapor" name="nama_pelapor" value="<?php echo $row['nama_pelapor']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="divisi" class="form-label">Divisi</label>
                <input type="text" class="form-control" id="divisi" name="divisi" value="<?php echo $row['divisi']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="judul_poster" class="form-label">Judul Poster</label>
                <input type="text" class="form-control" id="judul_poster" name="judul_poster" value="<?php echo $row['judul_poster']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required><?php echo $row['deskripsi']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="awal_tanggal_rilis" class="form-label">Awal Tanggal Rilis</label>
                <input type="date" class="form-control" id="awal_tanggal_rilis" name="awal_tanggal_rilis" value="<?php echo $row['awal_tanggal_rilis']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="akhir_tanggal_rilis" class="form-label">Akhir Tanggal Rilis</label>
                <input type="date" class="form-control" id="akhir_tanggal_rilis" name="akhir_tanggal_rilis" value="<?php echo $row['akhir_tanggal_rilis']; ?>" required>
            </div>
             <!-- Tombol "Simpan Perubahan" -->
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    <!-- Tambahkan script jQuery dari CDN Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Tambahkan script Bootstrap JS dari CDN Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
