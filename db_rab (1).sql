-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 08, 2025 at 05:46 AM
-- Server version: 10.3.39-MariaDB-0ubuntu0.20.04.2
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rab`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_barang`
--

CREATE TABLE `mst_barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_barang`
--

INSERT INTO `mst_barang` (`id`, `kode_barang`, `nama_barang`, `satuan`, `date_created`) VALUES
(13, 'RM-1001', 'BATA MERAH', 'PCS', '2025-03-02 02:31:46'),
(14, 'RM-1002', 'PASIR PASANG', 'M3', '2025-03-02 02:31:58'),
(15, 'RM-1003', 'SEMEN MERDEKA 40KG', 'SAK', '2025-03-02 02:33:53'),
(16, 'RM-1004', 'SEMEN GRESIK 40KG', 'SAK', '2025-03-02 02:34:09'),
(17, 'RM-1005', 'BATA RINGAN', 'PCS', '2025-03-02 02:36:37'),
(18, 'RM-1006', 'DULUX CATYLAC 5KG', 'KALENG', '2025-03-02 02:53:17'),
(19, 'RM-1007', 'BATU PONDASI KALI', 'TRUCK', '2025-03-02 02:54:52'),
(20, 'RM-1008', 'AMPLAS METERAN', 'MTR', '2025-03-06 03:30:36'),
(21, 'RM-1009', 'MOWILEX WOODSTAIN 1L', 'KALENG', '2025-03-06 04:05:15'),
(22, 'RM-1010', 'VINILEX GLOSS 5KG', 'KALENG', '2025-03-06 04:21:22'),
(23, 'RM-1011', 'KUAS 2,5\"', 'PCS', '2025-03-06 04:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `mst_jasa`
--

CREATE TABLE `mst_jasa` (
  `id` int(11) NOT NULL,
  `kode_jasa` varchar(8) NOT NULL,
  `nama_jasa` varchar(30) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_jasa`
--

INSERT INTO `mst_jasa` (`id`, `kode_jasa`, `nama_jasa`, `satuan`, `date_created`) VALUES
(8, 'JS-1001', 'TUKANG BATU', 'OH', '2025-03-02 02:34:45'),
(9, 'JS-1002', 'ASISTEN TUKANG', 'OH', '2025-03-02 02:34:52'),
(10, 'JS-1003', 'TUKANG CAT', 'OH', '2025-03-02 02:52:04');

-- --------------------------------------------------------

--
-- Table structure for table `mst_lokasi`
--

CREATE TABLE `mst_lokasi` (
  `id` int(11) NOT NULL,
  `kab_kota` varchar(30) NOT NULL,
  `provinsi` varchar(30) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_lokasi`
--

INSERT INTO `mst_lokasi` (`id`, `kab_kota`, `provinsi`, `date_created`) VALUES
(20, 'MALANG RAYA', 'JAWA TIMUR', '2025-03-02 02:29:38'),
(21, 'TANGERANG', 'JABODETABEK', '2025-03-05 05:22:17');

-- --------------------------------------------------------

--
-- Table structure for table `mst_satuan`
--

CREATE TABLE `mst_satuan` (
  `id` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_satuan`
--

INSERT INTO `mst_satuan` (`id`, `satuan`, `date_created`) VALUES
(9, 'PCS', '2025-03-02 02:29:50'),
(10, 'M2', '2025-03-02 02:29:58'),
(11, 'M3', '2025-03-02 02:30:03'),
(12, 'OH', '2025-03-02 02:30:10'),
(13, 'COLT', '2025-03-02 02:30:16'),
(14, 'RIT', '2025-03-02 02:30:22'),
(15, 'TRUCK', '2025-03-02 02:30:29'),
(16, 'SAK', '2025-03-02 02:33:43'),
(17, 'LONJOR', '2025-03-02 02:30:49'),
(18, 'MTR', '2025-03-02 02:31:25'),
(19, 'KALENG', '2025-03-02 02:52:54');

-- --------------------------------------------------------

--
-- Table structure for table `mst_user`
--

CREATE TABLE `mst_user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `is_active` varchar(1) NOT NULL DEFAULT 'Y',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_user`
--

INSERT INTO `mst_user` (`id`, `username`, `password`, `nama`, `is_active`, `date_created`) VALUES
(1, 'agus@solusiciptamedia.com', '$2y$10$Zt89hpSnBkR6s9yJcANteuUE1vu3.AsXKbHZADBqn3rK3rfn0O91e', 'Agus Salim', '1', '2025-03-02 02:19:39'),
(2, 'info@solusitukang.id', '$2y$10$v0piD.XoZyucgLr1uLknuOxL067tz.rKSPzEu8pANMWd8KQWgeCp6', 'ADMIN STI', '1', '2025-03-02 02:26:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_harga_jasa`
--

CREATE TABLE `tbl_harga_jasa` (
  `id` int(11) NOT NULL,
  `id_mst_jasa` int(11) NOT NULL,
  `kode_jasa` varchar(8) NOT NULL,
  `nama_jasa` varchar(50) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `harga` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `id_mst_lokasi` int(11) NOT NULL,
  `kab_kota` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_harga_jasa`
--

INSERT INTO `tbl_harga_jasa` (`id`, `id_mst_jasa`, `kode_jasa`, `nama_jasa`, `satuan`, `harga`, `id_mst_lokasi`, `kab_kota`, `date_created`) VALUES
(13, 8, 'JS-1001', 'TUKANG BATU', 'OH', 150000.000000, 20, 'MALANG RAYA', '2025-03-02 02:47:29'),
(14, 9, 'JS-1002', 'ASISTEN TUKANG', 'OH', 125000.000000, 20, 'MALANG RAYA', '2025-03-02 02:47:59'),
(15, 10, 'JS-1003', 'TUKANG CAT', 'OH', 150000.000000, 20, 'MALANG RAYA', '2025-03-02 02:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_harga_material`
--

CREATE TABLE `tbl_harga_material` (
  `id` int(11) NOT NULL,
  `id_mst_barang` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `harga` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `id_mst_lokasi` int(11) NOT NULL,
  `kab_kota` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_harga_material`
--

INSERT INTO `tbl_harga_material` (`id`, `id_mst_barang`, `kode_barang`, `nama_barang`, `satuan`, `harga`, `id_mst_lokasi`, `kab_kota`, `date_created`) VALUES
(27, 22, 'RM-1010', 'VINILEX GLOSS 5KG', 'KALENG', 250000.000000, 20, 'MALANG RAYA', '2025-03-06 04:33:17'),
(28, 21, 'RM-1009', 'MOWILEX WOODSTAIN 1L', 'KALENG', 125000.000000, 20, 'MALANG RAYA', '2025-03-06 04:33:33'),
(29, 20, 'RM-1008', 'AMPLAS METERAN', 'MTR', 11000.000000, 20, 'MALANG RAYA', '2025-03-06 04:33:51'),
(30, 23, 'RM-1011', 'KUAS 2,5\"', 'PCS', 15000.000000, 20, 'MALANG RAYA', '2025-03-06 04:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pekerjaan_detail`
--

CREATE TABLE `tbl_pekerjaan_detail` (
  `id` int(11) NOT NULL,
  `id_tbl_pekerjaan_header` int(11) NOT NULL,
  `kode_pekerjaan` varchar(10) NOT NULL,
  `uraian_pekerjaan` varchar(255) NOT NULL,
  `kode_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `qty` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `harga_bahan` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `harga_konversi` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pekerjaan_detail`
--

INSERT INTO `tbl_pekerjaan_detail` (`id`, `id_tbl_pekerjaan_header`, `kode_pekerjaan`, `uraian_pekerjaan`, `kode_barang`, `nama_barang`, `qty`, `harga_bahan`, `harga_konversi`, `date_created`) VALUES
(61, 32, 'ITEM-1005', 'Amplas Lantai Kayu', 'JS-1003', 'TUKANG CAT', 0.085000, 150000.000000, 12750.000000, '2025-03-06 04:44:22'),
(63, 32, 'ITEM-1005', 'Amplas Lantai Kayu', 'JS-1002', 'ASISTEN TUKANG', 0.085000, 125000.000000, 10625.000000, '2025-03-06 04:44:59'),
(64, 33, 'ITEM-1006', 'Cat Lantai Kayu', 'RM-1009', 'MOWILEX WOODSTAIN 1L', 0.085000, 125000.000000, 10625.000000, '2025-03-06 04:53:16'),
(65, 33, 'ITEM-1006', 'Cat Lantai Kayu', 'RM-1011', 'KUAS 2,5\"', 0.050000, 15000.000000, 750.000000, '2025-03-06 04:54:49'),
(68, 33, 'ITEM-1006', 'Cat Lantai Kayu', 'JS-1003', 'TUKANG CAT', 0.085000, 150000.000000, 12750.000000, '2025-03-06 04:55:15'),
(69, 33, 'ITEM-1006', 'Cat Lantai Kayu', 'JS-1002', 'ASISTEN TUKANG', 0.085000, 125000.000000, 10625.000000, '2025-03-06 04:55:46'),
(70, 34, 'ITEM-1007', 'Amplas Cat Dinding Lama', 'RM-1008', 'AMPLAS METERAN', 0.100000, 11000.000000, 1100.000000, '2025-03-06 04:57:51'),
(71, 34, 'ITEM-1007', 'Amplas Cat Dinding Lama', 'JS-1003', 'TUKANG CAT', 0.085000, 150000.000000, 12750.000000, '2025-03-06 04:58:02'),
(72, 34, 'ITEM-1007', 'Amplas Cat Dinding Lama', 'JS-1002', 'ASISTEN TUKANG', 0.085000, 125000.000000, 10625.000000, '2025-03-06 04:58:10'),
(73, 35, 'ITEM-1008', 'Cat Dinding Baru 2 Lapis', 'RM-1011', 'KUAS 2,5\"', 0.100000, 15000.000000, 1500.000000, '2025-03-06 04:59:26'),
(74, 35, 'ITEM-1008', 'Cat Dinding Baru 2 Lapis', 'RM-1010', 'VINILEX GLOSS 5KG', 0.040000, 250000.000000, 10000.000000, '2025-03-06 05:01:52'),
(75, 35, 'ITEM-1008', 'Cat Dinding Baru 2 Lapis', 'JS-1003', 'TUKANG CAT', 0.070000, 150000.000000, 10500.000000, '2025-03-06 05:06:34'),
(76, 35, 'ITEM-1008', 'Cat Dinding Baru 2 Lapis', 'JS-1002', 'ASISTEN TUKANG', 0.070000, 125000.000000, 8750.000000, '2025-03-06 05:06:46'),
(77, 36, 'ITEM-1009', 'Amplas Meja kayu', 'RM-1008', 'AMPLAS METERAN', 0.100000, 11000.000000, 1100.000000, '2025-03-06 05:08:10'),
(78, 36, 'ITEM-1009', 'Amplas Meja kayu', 'JS-1003', 'TUKANG CAT', 0.085000, 150000.000000, 12750.000000, '2025-03-06 05:08:22'),
(79, 36, 'ITEM-1009', 'Amplas Meja kayu', 'JS-1002', 'ASISTEN TUKANG', 0.085000, 125000.000000, 10625.000000, '2025-03-06 05:08:32'),
(80, 37, 'ITEM-1010', 'Cat Meja kayu', 'RM-1011', 'KUAS 2,5\"', 0.050000, 15000.000000, 750.000000, '2025-03-06 05:09:23'),
(81, 37, 'ITEM-1010', 'Cat Meja kayu', 'JS-1003', 'TUKANG CAT', 0.070000, 150000.000000, 10500.000000, '2025-03-06 05:09:37'),
(82, 37, 'ITEM-1010', 'Cat Meja kayu', 'JS-1002', 'ASISTEN TUKANG', 0.070000, 125000.000000, 8750.000000, '2025-03-06 05:09:50'),
(83, 37, 'ITEM-1010', 'Cat Meja kayu', 'RM-1009', 'MOWILEX WOODSTAIN 1L', 0.085000, 125000.000000, 10625.000000, '2025-03-06 05:10:18'),
(84, 32, 'ITEM-1005', 'Amplas Lantai Kayu', 'RM-1008', 'AMPLAS METERAN', 0.100000, 11000.000000, 1100.000000, '2025-03-06 05:15:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pekerjaan_header`
--

CREATE TABLE `tbl_pekerjaan_header` (
  `id` int(11) NOT NULL,
  `kode_pekerjaan` varchar(10) NOT NULL,
  `uraian_pekerjaan` varchar(255) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `kab_kota` varchar(50) NOT NULL,
  `harga_origin` decimal(20,6) DEFAULT 0.000000,
  `harga_up_30` decimal(20,6) DEFAULT 0.000000,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pekerjaan_header`
--

INSERT INTO `tbl_pekerjaan_header` (`id`, `kode_pekerjaan`, `uraian_pekerjaan`, `satuan`, `kab_kota`, `harga_origin`, `harga_up_30`, `date_created`) VALUES
(32, 'ITEM-1005', 'Amplas Lantai Kayu', 'M2', 'MALANG RAYA', 24475.000000, 31817.500000, '2025-03-06 05:15:31'),
(33, 'ITEM-1006', 'Cat Lantai Kayu', 'M2', 'MALANG RAYA', 34750.000000, 45175.000000, '2025-03-06 04:55:46'),
(34, 'ITEM-1007', 'Amplas Cat Dinding Lama', 'M2', 'MALANG RAYA', 24475.000000, 31817.500000, '2025-03-06 04:58:10'),
(35, 'ITEM-1008', 'Cat Dinding Baru 2 Lapis', 'M2', 'MALANG RAYA', 30750.000000, 39975.000000, '2025-03-06 05:06:47'),
(36, 'ITEM-1009', 'Amplas Meja kayu', 'M2', 'MALANG RAYA', 24475.000000, 31817.500000, '2025-03-06 05:08:32'),
(37, 'ITEM-1010', 'Cat Meja kayu', 'M2', 'MALANG RAYA', 30625.000000, 39812.500000, '2025-03-06 05:10:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rab_detail`
--

CREATE TABLE `tbl_rab_detail` (
  `id` int(11) NOT NULL,
  `id_tbl_rab_header` int(11) NOT NULL,
  `so_number` varchar(10) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `kode_pekerjaan` varchar(10) NOT NULL,
  `uraian_pekerjaan` varchar(255) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `harga_origin` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `qty` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `harga_konversi` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `margin_persen` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `margin_amount` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `resiko_persen` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `resiko_amount` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `harga_final` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `profit` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rab_detail`
--

INSERT INTO `tbl_rab_detail` (`id`, `id_tbl_rab_header`, `so_number`, `customer`, `kode_pekerjaan`, `uraian_pekerjaan`, `satuan`, `harga_origin`, `qty`, `harga_konversi`, `margin_persen`, `margin_amount`, `resiko_persen`, `resiko_amount`, `harga_final`, `profit`, `date_created`) VALUES
(57, 18, 'SO-0541', 'OBY', 'ITEM-1005', 'Amplas Lantai Kayu', 'M2', 24475.000000, 12.000000, 293700.000000, 0.400000, 117480.000000, 0.000000, 0.000000, 411180.000000, 117480.000000, '2025-03-06 05:25:36'),
(58, 18, 'SO-0541', 'OBY', 'ITEM-1006', 'Cat Lantai Kayu', 'M2', 34750.000000, 12.000000, 417000.000000, 0.400000, 166800.000000, 0.000000, 0.000000, 583800.000000, 166800.000000, '2025-03-06 05:26:24'),
(59, 18, 'SO-0541', 'OBY', 'ITEM-1007', 'Amplas Cat Dinding Lama', 'M2', 24475.000000, 26.000000, 636350.000000, 0.400000, 254540.000000, 0.000000, 0.000000, 890890.000000, 254540.000000, '2025-03-06 05:26:47'),
(60, 18, 'SO-0541', 'OBY', 'ITEM-1008', 'Cat Dinding Baru 2 Lapis', 'M2', 30750.000000, 26.000000, 799500.000000, 0.400000, 319800.000000, 0.000000, 0.000000, 1119300.000000, 319800.000000, '2025-03-06 05:27:12'),
(61, 18, 'SO-0541', 'OBY', 'ITEM-1009', 'Amplas Meja kayu', 'M2', 24475.000000, 1.700000, 41607.500000, 0.400000, 16643.000000, 0.000000, 0.000000, 58250.500000, 16643.000000, '2025-03-06 05:28:00'),
(62, 18, 'SO-0541', 'OBY', 'ITEM-1010', 'Cat Meja kayu', 'M2', 30625.000000, 1.700000, 52062.500000, 0.400000, 20825.000000, 0.000000, 0.000000, 72887.500000, 20825.000000, '2025-03-06 05:28:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rab_header`
--

CREATE TABLE `tbl_rab_header` (
  `id` int(11) NOT NULL,
  `so_number` varchar(10) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `kegiatan_pekerjaan` varchar(255) NOT NULL,
  `luas_area` varchar(255) NOT NULL,
  `nilai_origin` decimal(20,6) DEFAULT 0.000000,
  `nilai_final` decimal(20,6) DEFAULT 0.000000,
  `profit` decimal(20,6) DEFAULT 0.000000,
  `kab_kota` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rab_header`
--

INSERT INTO `tbl_rab_header` (`id`, `so_number`, `customer`, `alamat`, `hp`, `kegiatan_pekerjaan`, `luas_area`, `nilai_origin`, `nilai_final`, `profit`, `kab_kota`, `date_created`) VALUES
(18, 'SO-0541', 'OBY', 'jl. Puncak Tidar no. 1B', '0816759322', 'Cat Ulang Lantai Kayu, Dinding & Meja Kayu', '26', 2240220.000000, 3136308.000000, 896088.000000, 'MALANG RAYA', '2025-03-06 05:28:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_barang`
--
ALTER TABLE `mst_barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_barang` (`nama_barang`);

--
-- Indexes for table `mst_jasa`
--
ALTER TABLE `mst_jasa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_jasa` (`nama_jasa`);

--
-- Indexes for table `mst_lokasi`
--
ALTER TABLE `mst_lokasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kab_kota` (`kab_kota`);

--
-- Indexes for table `mst_satuan`
--
ALTER TABLE `mst_satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_user`
--
ALTER TABLE `mst_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_harga_jasa`
--
ALTER TABLE `tbl_harga_jasa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tbl_harga_jasa_mst_jasa` (`id_mst_jasa`),
  ADD KEY `FK_tbl_harga_jasa_mst_lokasi` (`id_mst_lokasi`);

--
-- Indexes for table `tbl_harga_material`
--
ALTER TABLE `tbl_harga_material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tbl_harga_mst_lokasi` (`id_mst_lokasi`),
  ADD KEY `FK_tbl_harga_mst_barang` (`id_mst_barang`);

--
-- Indexes for table `tbl_pekerjaan_detail`
--
ALTER TABLE `tbl_pekerjaan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tbl_pekerjaan_detail_tbl_pekerjaan_header` (`id_tbl_pekerjaan_header`);

--
-- Indexes for table `tbl_pekerjaan_header`
--
ALTER TABLE `tbl_pekerjaan_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rab_detail`
--
ALTER TABLE `tbl_rab_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tbl_rab_detail_tbl_rab_header` (`id_tbl_rab_header`);

--
-- Indexes for table `tbl_rab_header`
--
ALTER TABLE `tbl_rab_header`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `so_number` (`so_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_barang`
--
ALTER TABLE `mst_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `mst_jasa`
--
ALTER TABLE `mst_jasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mst_lokasi`
--
ALTER TABLE `mst_lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `mst_satuan`
--
ALTER TABLE `mst_satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `mst_user`
--
ALTER TABLE `mst_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_harga_jasa`
--
ALTER TABLE `tbl_harga_jasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_harga_material`
--
ALTER TABLE `tbl_harga_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_pekerjaan_detail`
--
ALTER TABLE `tbl_pekerjaan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tbl_pekerjaan_header`
--
ALTER TABLE `tbl_pekerjaan_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_rab_detail`
--
ALTER TABLE `tbl_rab_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tbl_rab_header`
--
ALTER TABLE `tbl_rab_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_harga_jasa`
--
ALTER TABLE `tbl_harga_jasa`
  ADD CONSTRAINT `FK_tbl_harga_jasa_mst_jasa` FOREIGN KEY (`id_mst_jasa`) REFERENCES `mst_jasa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tbl_harga_jasa_mst_lokasi` FOREIGN KEY (`id_mst_lokasi`) REFERENCES `mst_lokasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_harga_material`
--
ALTER TABLE `tbl_harga_material`
  ADD CONSTRAINT `FK_tbl_harga_mst_barang` FOREIGN KEY (`id_mst_barang`) REFERENCES `mst_barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tbl_harga_mst_lokasi` FOREIGN KEY (`id_mst_lokasi`) REFERENCES `mst_lokasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pekerjaan_detail`
--
ALTER TABLE `tbl_pekerjaan_detail`
  ADD CONSTRAINT `FK_tbl_pekerjaan_detail_tbl_pekerjaan_header` FOREIGN KEY (`id_tbl_pekerjaan_header`) REFERENCES `tbl_pekerjaan_header` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_rab_detail`
--
ALTER TABLE `tbl_rab_detail`
  ADD CONSTRAINT `FK_tbl_rab_detail_tbl_rab_header` FOREIGN KEY (`id_tbl_rab_header`) REFERENCES `tbl_rab_header` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
