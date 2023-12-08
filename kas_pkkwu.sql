-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Des 2023 pada 04.29
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kas_pkkwu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_diri_user`
--

CREATE TABLE `data_diri_user` (
  `id_data_diri` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kabupaten` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_diri_user`
--

INSERT INTO `data_diri_user` (`id_data_diri`, `id_user`, `deskripsi`, `no_telp`, `alamat`, `kecamatan`, `kabupaten`, `provinsi`, `email`) VALUES
(1, 49, '', '', '', '', '', '', ''),
(2, 46, '• Aplikasi ini bertujuan agar keuangan termasuk pendataan keuangan Pemasukan dan Pengeluaran dapat lebih tertata dan efisien, juga bersifat transparan yang dapat ditambahkan maupun dilihat oleh pengguna Aplikasi yaitu User dan Admin.', '088806089256', 'klengkingan 02/09 sedayu', 'jumantono', 'karanganyar', 'jawa tengah', 'nailaaqila31@gmail.com'),
(3, 50, '', '', '', '', '', '', ''),
(4, 51, '', '', '', '', '', '', ''),
(5, 52, '', '', '', '', '', '', ''),
(6, 53, '', '', '', '', '', '', ''),
(7, 54, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `keterangan` varchar(70) NOT NULL,
  `nominal` float NOT NULL,
  `username` varchar(50) NOT NULL,
  `jenis_transaksi` varchar(50) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `keterangan`, `nominal`, `username`, `jenis_transaksi`, `tanggal`) VALUES
(2, 'Sewa Buku Komik', 70000, 'test1', 'Pemasukan', '2023-08-02'),
(5, 'Beli Rak Buku', 16500, 'admin', 'Pengeluaran', '2023-08-03'),
(12, 'Beli Alat Tulis', 11000, 'admin', 'Pengeluaran', '2023-08-07'),
(21, 'Kas Mingguan', 67000, 'admin', 'Pemasukan', '2023-08-10'),
(34, 'beli buku elite global', 10000, 'admin', 'Pengeluaran', '2023-08-14'),
(40, 'nyoba pengeluaran', 15500, 'Saya', 'Pengeluaran', '2023-09-29'),
(41, 'nyoba ke 2', 12500, 'Saya', 'Pengeluaran', '2023-09-29'),
(42, 'nyoba pemasukan', 12500, 'Saya', 'Pemasukan', '2023-09-29'),
(43, 'Kebutuhan beli sayur', 52500, 'admin', 'Pemasukan', '2023-10-13'),
(44, 'beli kebutuhan poko buat hari ini', 15000, 'admin', 'Pemasukan', '2023-10-13'),
(45, 'Nyoba pengeluaran 3', 255500, 'Saya', 'Pengeluaran', '2023-10-13'),
(46, 'sdfsd', 112222, 'Saya', 'Pengeluaran', '2023-11-17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(70) NOT NULL,
  `password` varchar(24) NOT NULL,
  `level` varchar(12) NOT NULL,
  `foto_profile` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `nama`, `password`, `level`, `foto_profile`) VALUES
(46, 'admin', 'Admin', 'admingg', 'Admin', '351024485_1643991786076854_.jpg'),
(49, 'user', 'Admin', 'user123', 'User', 'profile_2.jpg'),
(50, 'Jamal', 'Admin', 'Si Oke', 'Admin', 'profile_4.jpg'),
(51, 'admin-2', 'Admin', 'admin145', 'Admin', 'profile_5.jpg'),
(52, 'Paijo', 'Admin', 'Paijo123', 'Admin', 'profile_7.jpg'),
(53, 'zaid izzah', 'Admin', 'zaidkece123', 'Admin', 'profile_3.jpg'),
(54, 'ahmad', 'Admin', 'aass123', 'User', 'profile_9.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_diri_user`
--
ALTER TABLE `data_diri_user`
  ADD PRIMARY KEY (`id_data_diri`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_diri_user`
--
ALTER TABLE `data_diri_user`
  MODIFY `id_data_diri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
