-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Sep 2023 pada 16.51
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbs_tunggutampil`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_akses`
--

CREATE TABLE `tb_akses` (
  `kd_user` int(3) NOT NULL,
  `username` varchar(18) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_akses`
--

INSERT INTO `tb_akses` (`kd_user`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@FRCHN.com', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_data`
--

CREATE TABLE `tb_data` (
  `id` int(11) NOT NULL,
  `nama_pelapor` varchar(255) NOT NULL,
  `divisi` varchar(255) NOT NULL,
  `judul_poster` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `awal_tanggal_rilis` date NOT NULL,
  `akhir_tanggal_rilis` date NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_data`
--

INSERT INTO `tb_data` (`id`, `nama_pelapor`, `divisi`, `judul_poster`, `deskripsi`, `awal_tanggal_rilis`, `akhir_tanggal_rilis`, `gambar`) VALUES
(1, 'IT', 'Informasi Teknologi', 'Poster Bulan Maret', 'Poster IT', '2023-03-01', '2023-03-31', 'Maret.png'),
(2, 'IT', 'Informasi Teknologi', 'Email Phising', 'Informasi tentang Email Phising', '2023-04-01', '2023-04-30', 'April.jpg'),
(3, 'IT', 'Informasi Teknologi', 'Informasi Pergantian Password', 'Poster Informasi Pergantian Password', '2023-05-01', '2023-05-31', 'Mei.jpg'),
(4, 'IT', 'Informasi Teknologi', 'Informasi Virus Ransomware', 'Poster Informasi Virus Ransomware', '2023-06-01', '2023-06-30', 'Juni.jpeg'),
(5, 'IT', 'Informasi Teknologi', 'Informasi Penggunaan Email Perusahaan', 'Informasi Penggunaan Email Perusahaan jangan di buat untuk hal hal pribadi', '2023-07-01', '2023-07-31', 'Juli.jpg'),
(6, 'IT', 'Informasi Teknologi', 'Informasi Single Point Of Contact', 'Poster Informasi Single Point Of Contact', '2023-08-01', '2023-09-02', 'Background desktop bulan Agustsus 2023.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_akses`
--
ALTER TABLE `tb_akses`
  ADD PRIMARY KEY (`kd_user`);

--
-- Indeks untuk tabel `tb_data`
--
ALTER TABLE `tb_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_akses`
--
ALTER TABLE `tb_akses`
  MODIFY `kd_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_data`
--
ALTER TABLE `tb_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
