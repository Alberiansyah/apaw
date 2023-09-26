-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2023 at 08:54 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dpr`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bagian`
--

CREATE TABLE `tb_bagian` (
  `id_bagian` int(11) NOT NULL,
  `nama_bagian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_bagian`
--

INSERT INTO `tb_bagian` (`id_bagian`, `nama_bagian`) VALUES
(1, 'AC'),
(2, 'CCTV'),
(3, 'Elektrikal'),
(4, 'Komputer dan Jaringan'),
(5, 'Lift'),
(6, 'Plumbing'),
(7, 'Sound System');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `bagian_id` int(11) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `merk` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `bagian_id`, `nama_barang`, `satuan`, `merk`, `type`) VALUES
(4, 1, 'Amplas Kasar', 'Meter', 'Setara', 'Kasar');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kegiatan`
--

CREATE TABLE `tb_kegiatan` (
  `id_kegiatan` int(11) NOT NULL,
  `tahun_anggaran` date NOT NULL,
  `nilai_anggaran` int(30) NOT NULL,
  `kode_rekening` varchar(50) NOT NULL,
  `nama_pptk` varchar(50) NOT NULL,
  `nip_pptk` varchar(30) NOT NULL,
  `nama_ppk` varchar(50) NOT NULL,
  `nip_ppk` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajuan`
--

CREATE TABLE `tb_pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_bagian` varchar(50) NOT NULL,
  `nama_teknisi` varchar(50) NOT NULL,
  `nama_pengaju` varchar(50) NOT NULL,
  `nip_pengaju` varchar(50) NOT NULL,
  `nama_kegiatan` text NOT NULL,
  `persetujuan` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajuan_detail`
--

CREATE TABLE `tb_pengajuan_detail` (
  `id_pengajuan_detail` int(11) NOT NULL,
  `pengajuan_id` int(11) NOT NULL,
  `ruangan_id` int(11) NOT NULL,
  `nomor` int(11) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `jumlah` varchar(30) NOT NULL,
  `nama_ruangan` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `persetujuan` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`id_role`, `nama_role`) VALUES
(1, 'ADMINISTRATOR');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ruangan`
--

CREATE TABLE `tb_ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `nama_ruangan` text NOT NULL,
  `lantai` varchar(5) NOT NULL,
  `zona` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_ruangan`
--

INSERT INTO `tb_ruangan` (`id_ruangan`, `nama_ruangan`, `lantai`, `zona`) VALUES
(1, 'Bagian Umum LT.3', '3', 'STAFF'),
(2, 'Halaman 17an', 'H', 'TAMAN'),
(3, 'Kolam Koi', 'H', 'TAMAN'),
(4, 'Loby Fraksi', '1', 'DEWAN'),
(5, 'Mushola LT.3 Staf', '3', 'STAFF'),
(6, 'R. Arsip RT Umum LT.3', '3', 'STAFF'),
(7, 'R. Arsip TU Umum LT.3', '3', 'STAFF'),
(8, 'R. Arsip Umum-PP LT.3', '3', 'STAFF'),
(9, 'R. Kabag Umum LT.3', '3', 'STAFF'),
(10, 'R. Komisi 4', '1', 'DEWAN'),
(11, 'R. Rapat Fraksi PDIP', '1', 'DEWAN'),
(12, 'R. Rapat Umum LT.3', '3', 'STAFF'),
(13, 'R. Tamu Umum', '3', 'STAFF'),
(14, 'Rapat Paripurna', '2', 'DEWAN'),
(15, 'Stok', 'G', 'STAFF'),
(16, 'STP Zona B', 'H', 'DEWAN'),
(17, 'Tempat Wudlu Mushola Lt. 2 Wanita', '2', 'DEWAN'),
(18, 'Toilet Pria Lt.2 Dewan', '2', 'DEWAN'),
(19, 'Toilet Pria LT.3 Dewan', '3', 'STAFF'),
(20, 'Toilet Pria LT.3 Staf', '3', 'STAFF'),
(21, 'Toilet Wanita LT.3 Dewan', '3', 'DEWAN'),
(22, 'Toilet Wanita LT.3 Staf', '3', 'DEWAN'),
(23, 'TU Pimpinan', '2', 'DEWAN');

-- --------------------------------------------------------

--
-- Table structure for table `tb_teknisi`
--

CREATE TABLE `tb_teknisi` (
  `id_teknisi` int(11) NOT NULL,
  `bagian_id` int(1) NOT NULL,
  `nama_teknisi` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `no_nik` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_teknisi`
--

INSERT INTO `tb_teknisi` (`id_teknisi`, `bagian_id`, `nama_teknisi`, `no_telp`, `no_nik`, `alamat`, `email`) VALUES
(1, 1, 'ANTON HERMAWAN', '0878218436271', '3217044918948781', 'Jl. Test', 'test@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `role_id`, `username`, `password`, `nama_lengkap`) VALUES
(1, 1, 'Alberiansyah', '$2y$10$hAs3dG4qKe006A9ZmPGR/.RMDFEV.lzmfjOrBMfr9Ii9RjGU5MrBO', 'Alberiansyah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bagian`
--
ALTER TABLE `tb_bagian`
  ADD PRIMARY KEY (`id_bagian`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indexes for table `tb_pengajuan_detail`
--
ALTER TABLE `tb_pengajuan_detail`
  ADD PRIMARY KEY (`id_pengajuan_detail`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `tb_ruangan`
--
ALTER TABLE `tb_ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indexes for table `tb_teknisi`
--
ALTER TABLE `tb_teknisi`
  ADD PRIMARY KEY (`id_teknisi`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_bagian`
--
ALTER TABLE `tb_bagian`
  MODIFY `id_bagian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pengajuan_detail`
--
ALTER TABLE `tb_pengajuan_detail`
  MODIFY `id_pengajuan_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_ruangan`
--
ALTER TABLE `tb_ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_teknisi`
--
ALTER TABLE `tb_teknisi`
  MODIFY `id_teknisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
