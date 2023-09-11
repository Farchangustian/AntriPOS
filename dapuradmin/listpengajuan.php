<?php

include '../config/koneksi.php'; // Pastikan ini menginisialisasi $koneksi

// Query untuk mengambil data dari tabel dbs_data
$query = "SELECT * FROM tb_data";
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
    <title>Daftar Pengajuan Poster</title>
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
                <th>Status</th>
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

                    // Tampilkan status berdasarkan nilai "konfirmasi"
                    echo '<td>';
                    if ($row["konfirmasi"] == 0) {
                        echo '<div class="alert alert-danger" role="alert">Pending</div>';
                    } elseif ($row["konfirmasi"] == 1) {
                        echo '<div class="alert alert-success" role="alert">Konfirmasi</div>';
                    }
                    echo '</td>';
                    echo "<td><a href='#' data-toggle='modal' data-target='#gambarModal" . $currentRow . "'><img src='../assets/img/" . $row["gambar"] . "' alt='Gambar' width='43'></a></td>";

                    // Tombol Edit
                    echo '<td>';
                    echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal' . $currentRow . '">Edit</button>';
                    echo '</td>';

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
                    echo '<img src="../assets/img/' . $row["gambar"] . '" alt="Gambar" style="max-width: 720px; max-height: 1000px;">';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    // Modal Edit
                    echo '<div class="modal fade" id="editModal' . $currentRow . '" tabindex="-1" role="dialog" aria-labelledby="editModalLabel' . $currentRow . '" aria-hidden="true">';
                    echo '<div class="modal-dialog" role="document">';
                    echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="editModalLabel' . $currentRow . '">Edit Data</h5>';
                    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                    echo '<span aria-hidden="true">&times;</span>';
                    echo '</button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo '<form action="process_konfirmasi.php" method="POST">';
                    echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                    // Formulir edit data di sini
                    echo '</form>';
                    echo '</div>';
                    echo '<div class="modal-footer">';
                    echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>';
                    echo '<button type="button" class="btn btn-success" onclick="submitForm(' . $currentRow . ')">Konfirmasi</button>';
                    echo '<button type="button" class="btn btn-danger" onclick="rejectForm(' . $currentRow . ')">Pending</button>';

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    $currentRow++;
                }
            } else {
                echo "<tr><td colspan='10'>Tidak ada data.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
            </main>
        </div>
    </div>

    <!-- Link ke Bootstrap JS, Popper.js, dan jQuery -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="../assets/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script>
function submitForm(rowNumber) {
    var form = document.querySelector('#editModal' + rowNumber + ' form');
    var formData = new FormData(form);

    // Set status menjadi 1 (konfirmasi)
    formData.set('status', 1);

    fetch('process_konfirmasi.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Tampilkan notifikasi bahwa data berhasil dikonfirmasi
            alert('Data berhasil dikonfirmasi dan dipublikasikan.');
            // Refresh halaman setelah konfirmasi
            window.location.reload();
        } else {
            alert('Gagal mengkonfirmasi data.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Untuk menekan tombol "Pending"
function rejectForm(rowNumber) {
    var form = document.querySelector('#editModal' + rowNumber + ' form');
    var formData = new FormData(form);

    // Set status menjadi 0 (pending)
    formData.set('status', 0);

    fetch('process_konfirmasi.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Tampilkan notifikasi bahwa data berhasil ditolak
            alert('Data berhasil ditolak dan diubah menjadi pending.');
            // Refresh halaman setelah penolakan
            window.location.reload();
        } else {
            alert('Gagal menolak data.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>
</body>
</html>
