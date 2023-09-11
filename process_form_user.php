<?php
// Fungsi untuk mendapatkan ekstensi file
function getFileExtension($filename) {
    return pathinfo($filename, PATHINFO_EXTENSION);
}

// Fungsi untuk menghasilkan nama unik untuk gambar yang diunggah
function generateUniqueFileName($filename) {
    $extension = getFileExtension($filename);
    $basename = bin2hex(random_bytes(8)); // Generate nama acak
    return $basename . '.' . $extension;
}

// Pastikan untuk memeriksa apakah ada file yang diunggah
if ($_FILES['gambar']['error'] === 0) {
    $namaGambar = $_FILES['gambar']['name'];
    $lokasiGambar = $_FILES['gambar']['tmp_name'];
    $ukuranGambar = $_FILES['gambar']['size'];

    // Batas maksimal file (dalam byte), misalnya 10 MB
    $batasMaksimal = 10 * 1024 * 1024; // 10 MB

    // Array format gambar yang diizinkan
    $formatGambarDiizinkan = ['jpeg', 'jpg', 'png'];

    // Mendapatkan ekstensi file
    $ekstensiGambar = strtolower(getFileExtension($namaGambar));

    if (in_array($ekstensiGambar, $formatGambarDiizinkan)) {
        if ($ukuranGambar <= $batasMaksimal) {
            // Pindahkan gambar yang diunggah ke lokasi yang benar
            $namaGambarBaru = generateUniqueFileName($namaGambar);
            $lokasiSimpan = 'assets/img/' . $namaGambarBaru;

            if (move_uploaded_file($lokasiGambar, $lokasiSimpan)) {
                // File gambar berhasil diunggah, sekarang Anda dapat menyimpan data lain ke database
                include 'config/koneksi.php';

                // Tangkap data dari formulir
                $namaPelapor = $_POST['nama_pelapor'];
                $divisi = $_POST['divisi'];
                $judulPoster = $_POST['judul_poster'];
                $deskripsi = $_POST['deskripsi'];
                $awalTanggalRilis = $_POST['awal_tanggal_rilis'];
                $akhirTanggalRilis = $_POST['akhir_tanggal_rilis'];

                // Buat query SQL untuk menyimpan data ke database
                $query = "INSERT INTO tb_data (nama_pelapor, divisi, judul_poster, deskripsi, awal_tanggal_rilis, akhir_tanggal_rilis, gambar, konfirmasi) VALUES ('$namaPelapor', '$divisi', '$judulPoster', '$deskripsi', '$awalTanggalRilis', '$akhirTanggalRilis', '$namaGambarBaru', 0)";

                // Jalankan query
                    if ($koneksi->query($query) === TRUE) {
                        // Menampilkan notifikasi berhasil menggunakan modal popup
                        echo '<script>';
                        echo 'alert("Data berhasil disimpan dan Data akan divalidasi oleh Admin.");';
                        echo 'window.location.href = "ajukanpost.php";'; // Redirect ke halaman ajukanpost.php
                        echo '</script>';
                        exit; // Pastikan untuk keluar agar tidak menjalankan kode berikutnya
                    } else {
                        echo "Error: " . $query . "<br>" . $koneksi->error;
                    }

                    // Tutup koneksi ke database
                    $koneksi->close();
            } else {
                echo "Gagal mengunggah gambar.";
            }
        } else {
            echo "Ukuran gambar melebihi batas maksimal yang diperbolehkan (10 MB).";
        }
    } else {
        echo "Format gambar tidak diizinkan. Gunakan format JPEG atau PNG.";
    }
} else {
    echo "Terjadi kesalahan saat mengunggah gambar.";
}
?>
