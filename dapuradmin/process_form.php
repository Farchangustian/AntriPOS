<?php
include '../config/koneksi.php'; // Pastikan ini menginisialisasi $koneksi

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Allowed image formats
    $allowedFormats = array("png", "PNG", "jpg", "jpeg");

    // Upload and handle the image
    $targetDir = "../assets/img/"; // Path menuju direktori
    $fileName = basename($_FILES['gambar']['name']);
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $targetPath = $targetDir . $fileName;

    // Retrieve form data
    $nama_pelapor = $_POST['nama_pelapor'];
    $divisi = $_POST['divisi'];
    $judul_poster = $_POST['judul_poster'];
    $deskripsi = $_POST['deskripsi'];
    $awal_tanggal_rilis = $_POST['awal_tanggal_rilis'];
    $akhir_tanggal_rilis = $_POST['akhir_tanggal_rilis'];
}

    // Check if the file format is allowed
if (in_array($fileExtension, $allowedFormats)) {
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetPath)) {
        // Persiapan pernyataan SQL
        $insertQuery = "INSERT INTO tb_data (nama_pelapor, divisi, judul_poster, deskripsi, awal_tanggal_rilis, akhir_tanggal_rilis, gambar)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Membuat pernyataan bersama
        $stmt = $koneksi->prepare($insertQuery);

        // Bind parameter dan eksekusi pernyataan
        $stmt->bind_param("sssssss", $nama_pelapor, $divisi, $judul_poster, $deskripsi, $awal_tanggal_rilis, $akhir_tanggal_rilis, $fileName);

        if ($stmt->execute()) {
            // Data berhasil ditambah, tampilkan popup dan refresh halaman
            echo '<script>alert("Data Berhasil ditambah!");</script>';
            echo '<script>window.location.href = "tambahdata.php";</script>';
        } else {
            echo "Gagal: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Gagal Upload gambar.";
    }
} else {
    echo "Gambar tidak didukung. Format yang direkomendasikan: PNG, JPG, JPEG.";
}
?>
