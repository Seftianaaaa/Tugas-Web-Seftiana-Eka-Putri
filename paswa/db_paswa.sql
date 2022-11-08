-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Okt 2022 pada 00.11
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_paswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tab_kegiatan`
--

CREATE TABLE `tab_kegiatan` (
  `id` int(2) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `nama_kegiatan` varchar(100) DEFAULT NULL,
  `narasumber` varchar(100) DEFAULT NULL,
  `pic` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tab_kelompok`
--

CREATE TABLE `tab_kelompok` (
  `id` int(5) NOT NULL,
  `nama_kelompok` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tab_panitia`
--

CREATE TABLE `tab_panitia` (
  `nim` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `semester` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(14) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tab_perlengkapan`
--

CREATE TABLE `tab_perlengkapan` (
  `id` int(2) NOT NULL,
  `perlengkapan` text DEFAULT NULL,
  `kategori` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tab_peserta`
--

CREATE TABLE `tab_peserta` (
  `nim` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `prodi` varchar(20) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jenis_kelamin` int(11) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `agama` varchar(10) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tab_peserta`
--

INSERT INTO `tab_peserta` (`nim`, `nama`, `prodi`, `semester`, `kelas`, `no_hp`, `email`, `alamat`, `jenis_kelamin`, `foto`, `agama`, `tempat_lahir`, `tanggal_lahir`) VALUES
(2147483647, 'ROID ADIP AKMAL', 'TI', 1, 'Pagi', '0812345678', 'roidadipfatma@gmail.com', 'Jl. Kp bulak no 24 H duren sawit, Klender', 0, 'RobloxScreenShot20220905_003029035.png', 'Islam', 'Jakarta', '2022-10-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tab_peserta_kelompok`
--

CREATE TABLE `tab_peserta_kelompok` (
  `id` int(2) NOT NULL,
  `nim` int(11) DEFAULT NULL,
  `id_kelompok` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tab_tamu`
--

CREATE TABLE `tab_tamu` (
  `id` int(2) NOT NULL,
  `nama_tamu` varchar(100) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tab_tata_tertib`
--

CREATE TABLE `tab_tata_tertib` (
  `id` int(2) NOT NULL,
  `tata_tertib` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tab_user`
--

CREATE TABLE `tab_user` (
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tab_user`
--

INSERT INTO `tab_user` (`username`, `password`) VALUES
('admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tab_kegiatan`
--
ALTER TABLE `tab_kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tab_kelompok`
--
ALTER TABLE `tab_kelompok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tab_panitia`
--
ALTER TABLE `tab_panitia`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `tab_perlengkapan`
--
ALTER TABLE `tab_perlengkapan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tab_peserta`
--
ALTER TABLE `tab_peserta`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `tab_peserta_kelompok`
--
ALTER TABLE `tab_peserta_kelompok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tab_tamu`
--
ALTER TABLE `tab_tamu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tab_tata_tertib`
--
ALTER TABLE `tab_tata_tertib`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tab_user`
--
ALTER TABLE `tab_user`
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tab_kegiatan`
--
ALTER TABLE `tab_kegiatan`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tab_kelompok`
--
ALTER TABLE `tab_kelompok`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tab_perlengkapan`
--
ALTER TABLE `tab_perlengkapan`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tab_peserta`
--
ALTER TABLE `tab_peserta`
  MODIFY `nim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT untuk tabel `tab_peserta_kelompok`
--
ALTER TABLE `tab_peserta_kelompok`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tab_tamu`
--
ALTER TABLE `tab_tamu`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tab_tata_tertib`
--
ALTER TABLE `tab_tata_tertib`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
