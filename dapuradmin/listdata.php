<?php

include '../config/koneksi.php'; // Pastikan ini menginisialisasi $koneksi

// Query untuk mengambil data dari tabel dbs_data
$query = "SELECT * FROM tb_data WHERE konfirmasi = 1";
$result = $koneksi->query($query);

// Fungsi untuk menghasilkan nomor urut
function generateRowNumber($result, $currentRow) {
    return $currentRow + 1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Data</title>
    <!-- Link ke Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include '../bar/sidebar.php'; ?>

            <!-- Konten Utama -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3
                border-bottom">
                    <h1 class="h2">Daftar Data</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#myModal">Log Out</button>
                            <a href="../home.php" class="btn btn-sm btn-outline-secondary">Halaman Depan</a>
                        </div>
                    </div>
                </div>

                <div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Keluar</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Yakin ingin keluar?
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="login.php?logout=true" class="btn btn-danger">Ya</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal konfirmasi hapus -->
<div class="modal fade" id="hapusModal<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel<?php echo $row["id"]; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusModalLabel<?php echo $row["id"]; ?>">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a href="hapus_data.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nomor Urut</th>
                                <th>Nama Pelapor</th>
                                <th>Divisi</th>
                                <th>Judul Poster</th>
                                <th>Deskripsi</th>
                                <th>Awal Tanggal Rilis</th>
                                <th>Akhir Tanggal Rilis</th>
                                <th>Gambar</th>
                                <th>Actions</th>
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
                                    echo "<td>" . $row["awal_tanggal_rilis"] . "</td>";
                                    echo "<td>" . $row["akhir_tanggal_rilis"] . "</td>";
                                    echo "<td><a href='#' data-toggle='modal' data-target='#gambarModal" . $currentRow . "'><img src='../assets/img/" . $row["gambar"] . "' alt='Gambar' width='43'></a></td>";
                                   
                                    // Kolom Actions
                                    echo '<td>';
                                    echo '<a href="edit_data.php?id=' . $row["id"] . '" class="btn btn-primary">Edit</a>';
                                    echo ' <button type="button" class="btn btn-danger hapus-data-konfirmasi" data-toggle="modal" data-target="#hapusModal' . $row["id"] . '">Hapus</button>';
                                    echo '</td>';

                                    // Modal konfirmasi hapus
                                    echo '<div class="modal fade" id="hapusModal' . $row["id"] . '" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel' . $row["id"] . '" aria-hidden="true">';
                                    echo '<div class="modal-dialog" role="document">';
                                    echo '<div class="modal-content">';
                                    echo '<div class="modal-header">';
                                    echo '<h5 class="modal-title" id="hapusModalLabel' . $row["id"] . '">Konfirmasi Hapus</h5>';
                                    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                                    echo '<span aria-hidden="true">&times;</span>';
                                    echo '</button>';
                                    echo '</div>';
                                    echo '<div class="modal-body">';
                                    echo 'Apakah Anda yakin data akan dihapus?'; // Perubahan pesan konfirmasi di sini
                                    echo '</div>';
                                    echo '<div class="modal-footer">';
                                    echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>';
                                    echo '<button type="button" class="btn btn-danger hapus-data" data-id="' . $row["id"] . '">Hapus</button>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';


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
                                    echo '<img src="../assets/img/' . $row["gambar"] . '" alt="Gambar" style="max-width: 720px; max-height: 1000px;">'; 
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        // Tangkap klik pada tombol "Hapus"
        $(".hapus-data-konfirmasi").click(function () {
            // Ambil ID data dari atribut data-id
            var id = $(this).data("id");

            // Sembunyikan modal konfirmasi penghapusan
            $("#hapusModal" + id).modal("hide");

            // Tampilkan kembali modal konfirmasi penghapusan
            $("#konfirmasiHapusModal" + id).modal("show");
        });

        // Tangkap klik pada tombol "Hapus" dalam modal konfirmasi penghapusan
        $(".hapus-data").click(function () {
            // Ambil ID data dari atribut data-id
            var id = $(this).data("id");

            // Kirim permintaan AJAX untuk menghapus data dengan metode POST
            $.ajax({
                type: "POST",
                url: "hapus_data.php",
                data: { id: id }, // Mengirim ID sebagai data POST
                success: function (response) {
                    // Tampilkan notifikasi
                    alert("Data berhasil dihapus");

                    // Refresh halaman untuk menampilkan perubahan
                    location.reload();
                },
                error: function () {
                    // Tampilkan pesan kesalahan jika terjadi masalah
                    alert("Terjadi kesalahan saat menghapus data");
                }
            });
        });
    });
</script>
</body>
</html>
