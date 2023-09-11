<?php
include '../config/koneksi.php';

// Periksa apakah parameter id ada dalam data POST
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Query untuk menghapus data berdasarkan id dengan parameter binding
    $query = "DELETE FROM tb_data WHERE id = ?";
    
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // Jika penghapusan berhasil, arahkan kembali ke listdata.php
        header('Location: listdata.php');
        exit;
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan
        echo "Error: " . $koneksi->error;
    }
}
?>
