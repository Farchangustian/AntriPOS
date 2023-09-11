<?php
// Sertakan file koneksi
include '../config/koneksi.php';

// Uji koneksi database
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}

// Skrip untuk memproses konfirmasi atau pembatalan konfirmasi data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan untuk mengamankan inputan yang diterima dari form
    $id = $_POST['id'];
    $status = $_POST['status']; // Mengambil status dari form

    // Lakukan perubahan status konfirmasi dalam database
    // Kolom 'konfirmasi' diubah sesuai dengan nilai $status
    $query = "UPDATE tb_data SET konfirmasi = $status WHERE id = $id";

    if ($koneksi->query($query) === TRUE) {
        $response = ['success' => true];
    } else {
        $response = ['success' => false, 'error' => $koneksi->error];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

?>
