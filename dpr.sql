-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2023 at 06:57 PM
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
(1, 6, 'Cat Besi', 'Kaleng', 'Avian', 'Putih'),
(2, 6, 'Foot Valve', 'Buah', 'Setara', ''),
(3, 1, 'Freon R11', 'Kaleng', '', ''),
(4, 1, 'Freon R410a', 'Kaleng', '', ''),
(5, 3, 'J1k Antena TV', 'Buah', 'Setara', 'Cowo'),
(6, 6, 'Jet Washer 1/2\"', 'Buah', '', ''),
(7, 3, 'Kabel Antena (Coaxial)', 'Meter', 'RG6', 'Coaxial'),
(8, 3, 'Kabel NYM 4x2,5 mm2', 'Meter', 'Suppreme', 'Nym 4x2,5'),
(9, 6, 'Kawat Tali Beton', 'Meter', 'Setara', 'Bendrat'),
(10, 6, 'Keni PVC 1/2\"', 'Batang', '', ''),
(11, 6, 'Keni PVC 2,5 Inc', 'Buah', 'Setara', ''),
(12, 6, 'Keni PVC 3/4\"', 'Buah', '', ''),
(13, 6, 'Keran Dinding 1/2\"', 'Buah', 'Onda', ''),
(14, 6, 'Keran Wastafel 1/2\"', 'Buah', '', ''),
(15, 6, 'Kunci Ring Pas', 'Buah', 'Tekiro', 'No.10'),
(16, 6, 'Kuwas Cat 1,5', 'Buah', 'Setara', '11/2'),
(17, 3, 'Lampu SL 23 Watt', 'Buah', 'Philips', '23 Watt'),
(18, 3, 'Lampu TL 20', 'Buah', 'Philips', 'TL 20'),
(19, 6, 'Lem', 'Kaleng', 'Asahi', ''),
(20, 6, 'Pipa PVC', 'Batang', 'Wavin', '3/4\"'),
(21, 6, 'Pipa PVC 1/2\"', 'Batang', '', ''),
(22, 6, 'Pompa 125 Watt', 'Unit', 'Panasonic', 'GA 130'),
(23, 6, 'Pompa Air 125Watt', 'Unit', '', ''),
(24, 1, 'Pompa Drain 1', 'Unit', '', ''),
(25, 6, 'Pompa Seawage 1500Watt', 'Unit', 'Ebara', '3 Fasa'),
(26, 6, 'Roda Gerobak', 'Buah', 'Setara', '15cm'),
(27, 6, 'Seal Tape', 'Buah', '', ''),
(28, 6, 'Skrup Gypsum', 'Dus', 'No Brand', ''),
(29, 6, 'Sock Drat Luar PVC', 'Buah', 'Setara', '3/4'),
(30, 6, 'Socket PVC', 'Buah', 'Setara', '3/4\"'),
(31, 3, 'Splitter Antena TV 2 Way', 'Buah', 'Rapid', '2 Way'),
(32, 6, 'Tambang Plastik D2cm', 'Meter', 'Setara', 'Plastik 2Cm'),
(33, 6, 'Tinner Cat', 'Kaleng', 'Setara', '-'),
(34, 6, 'Union Sock', 'Buah', 'Setara', ''),
(35, 6, 'Water Mur 2,5 Inc', 'Buah', 'Setara', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kegiatan`
--

CREATE TABLE `tb_kegiatan` (
  `id_kegiatan` int(11) NOT NULL,
  `nama_kegiatan` text NOT NULL,
  `tahun_anggaran` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nilai_anggaran` bigint(20) NOT NULL,
  `kode_rekening` varchar(50) NOT NULL,
  `nama_pptk` varchar(50) NOT NULL,
  `nip_pptk` varchar(30) NOT NULL,
  `nama_ppk` varchar(50) NOT NULL,
  `nip_ppk` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kegiatan`
--

INSERT INTO `tb_kegiatan` (`id_kegiatan`, `nama_kegiatan`, `tahun_anggaran`, `nilai_anggaran`, `kode_rekening`, `nama_pptk`, `nip_pptk`, `nama_ppk`, `nip_ppk`) VALUES
(2, 'Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah', '2023-09-27 16:14:19', 220000000, '5.3.2.12.12', 'IRMA RAHMAWATI, S.Sos, MM', '19810204 201001 2 002', 'Afwa', '19700922 199803 1 004');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajuan`
--

CREATE TABLE `tb_pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `kegiatan_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bagian_id` varchar(50) NOT NULL,
  `teknisi_id` int(11) NOT NULL,
  `nama_pengaju` varchar(50) NOT NULL,
  `nip_pengaju` varchar(50) NOT NULL,
  `persetujuan` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pengajuan`
--

INSERT INTO `tb_pengajuan` (`id_pengajuan`, `kegiatan_id`, `tanggal`, `bagian_id`, `teknisi_id`, `nama_pengaju`, `nip_pengaju`, `persetujuan`) VALUES
(1, 2, '2023-09-28', '2', 2, 'Alberiansyah', '123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajuan_detail`
--

CREATE TABLE `tb_pengajuan_detail` (
  `id_pengajuan_detail` int(11) NOT NULL,
  `pengajuan_id` int(11) NOT NULL,
  `ruangan_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `jumlah` varchar(30) NOT NULL,
  `keterangan` text NOT NULL,
  `persetujuan` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pengajuan_detail`
--

INSERT INTO `tb_pengajuan_detail` (`id_pengajuan_detail`, `pengajuan_id`, `ruangan_id`, `barang_id`, `jumlah`, `keterangan`, `persetujuan`) VALUES
(1, 1, 1, 1, '1', '123', 0),
(2, 1, 2, 2, '2', '123', 0),
(3, 1, 3, 3, '3', '123', 0);

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
(1, 'ADMINISTRATOR'),
(2, 'PPK'),
(3, 'PPTK');

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
  `no_telp` varchar(15) DEFAULT NULL,
  `no_nik` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_teknisi`
--

INSERT INTO `tb_teknisi` (`id_teknisi`, `bagian_id`, `nama_teknisi`, `no_telp`, `no_nik`, `alamat`, `email`) VALUES
(1, 1, 'ANTON HERMAWAN', '', '', 'Jl. Test', ''),
(2, 2, 'Ari', '', '', '', ''),
(3, 6, 'ASEP', '', '', '', ''),
(4, 7, 'AYI KURNIA', '', '', '', ''),
(5, 3, 'AYI RUSMANA', '', '', '', ''),
(6, 3, 'BILLY ALFIAN', '', '', '', ''),
(7, 6, 'DADANG AVO', '', '', '', ''),
(8, 4, 'DIDIK JAMALUDIN', '', '', '', ''),
(9, 3, 'ERI RUSKANDAR', '', '', '', ''),
(10, 1, 'FAJAR DARMAWAN', '', '', '', ''),
(11, 4, 'FITRA ERVANSYAH', '', '', '', ''),
(12, 4, 'HERRY SUSANTO', '', '', '', ''),
(13, 7, 'INDRA KUSHENDAR PRATAMA', '', '', '', ''),
(14, 4, 'KHELFIN KRISMANTIA', '', '', '', ''),
(15, 1, 'M. HADI', '', '', '', ''),
(16, 4, 'MAHESA SETIA MEGA PUTRA', '', '', '', ''),
(17, 4, 'MUHAMMAD ADLI BAIHAQI', '', '', '', ''),
(18, 1, 'ANTON HERMAWAN', '', '', '', ''),
(19, 2, 'Ari', '', '', '', ''),
(20, 6, 'ASEP', '', '', '', ''),
(21, 7, 'AYI KURNIA', '', '', '', ''),
(22, 3, 'AYI RUSMANA', '', '', '', ''),
(23, 3, 'BILLY ALFIAN', '', '', '', ''),
(24, 6, 'DADANG AVO', '', '', '', ''),
(25, 4, 'DIDIK JAMALUDIN', '', '', '', ''),
(26, 3, 'ERI RUSKANDAR', '', '', '', ''),
(27, 1, 'FAJAR DARMAWAN', '', '', '', ''),
(28, 4, 'FITRA ERVANSYAH', '', '', '', ''),
(29, 4, 'HERRY SUSANTO', '', '', '', ''),
(30, 7, 'INDRA KUSHENDAR PRATAMA', '', '', '', ''),
(31, 4, 'KHELFIN KRISMANTIA', '', '', '', ''),
(32, 1, 'M. HADI', '', '', '', ''),
(33, 4, 'MAHESA SETIA MEGA PUTRA', '', '', '', ''),
(34, 4, 'MUHAMMAD ADLI BAIHAQI', '', '', '', ''),
(35, 4, 'SIGRIT ADITYA SALAM', '', '', '', '');

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
(1, 1, 'Alberiansyah', '$2y$10$hAs3dG4qKe006A9ZmPGR/.RMDFEV.lzmfjOrBMfr9Ii9RjGU5MrBO', 'Alberiansyah'),
(2, 2, 'Afwa', '$2y$10$NLYcwIiEsBfKtp02AY.kK.3yzcEU7en4RjNb25BsmLD9E5S6u5oSS', 'Afwa'),
(3, 3, 'Irma', '$2y$10$Wo.1gwcsSbLhE2FIDEI92.ntAzEcwYAzSm9/E5mzdcZ9rV7UKQRry', 'IRMA RAHMAWATI, S.Sos, MM');

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
  MODIFY `id_bagian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_pengajuan_detail`
--
ALTER TABLE `tb_pengajuan_detail`
  MODIFY `id_pengajuan_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_ruangan`
--
ALTER TABLE `tb_ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_teknisi`
--
ALTER TABLE `tb_teknisi`
  MODIFY `id_teknisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
