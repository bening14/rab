-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_rab
DROP DATABASE IF EXISTS `db_rab`;
CREATE DATABASE IF NOT EXISTS `db_rab` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `db_rab`;

-- Dumping structure for table db_rab.mst_barang
DROP TABLE IF EXISTS `mst_barang`;
CREATE TABLE IF NOT EXISTS `mst_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama_barang` (`nama_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_rab.mst_barang: ~2 rows (approximately)
REPLACE INTO `mst_barang` (`id`, `kode_barang`, `nama_barang`, `date_created`) VALUES
	(7, 'RM-1001', 'PASIR PASANG 1 M3', '2025-02-26 05:07:46'),
	(8, 'RM-1002', 'SEMEN MERDEKA 40KG', '2025-02-26 05:07:59'),
	(10, 'RM-1003', 'BATA MERAH 1 PCS', '2025-02-26 05:47:34');

-- Dumping structure for table db_rab.mst_jasa
DROP TABLE IF EXISTS `mst_jasa`;
CREATE TABLE IF NOT EXISTS `mst_jasa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jasa` varchar(8) NOT NULL,
  `nama_jasa` varchar(30) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama_jasa` (`nama_jasa`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_rab.mst_jasa: ~1 rows (approximately)
REPLACE INTO `mst_jasa` (`id`, `kode_jasa`, `nama_jasa`, `date_created`) VALUES
	(5, 'JS-1001', 'TUKANG BATU', '2025-02-26 05:08:20'),
	(6, 'JS-1002', 'ASISTEN TUKANG', '2025-02-26 05:08:28');

-- Dumping structure for table db_rab.mst_lokasi
DROP TABLE IF EXISTS `mst_lokasi`;
CREATE TABLE IF NOT EXISTS `mst_lokasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kab_kota` varchar(30) NOT NULL,
  `provinsi` varchar(30) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `kab_kota` (`kab_kota`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_rab.mst_lokasi: ~5 rows (approximately)
REPLACE INTO `mst_lokasi` (`id`, `kab_kota`, `provinsi`, `date_created`) VALUES
	(10, 'KAB MALANG', 'JAWA TIMUR', '2025-02-26 05:05:42'),
	(11, 'KOTA MALANG', 'JAWA TIMUR', '2025-02-26 05:05:34'),
	(12, 'KOTA BATU', 'JAWA TIMUR', '2025-02-26 05:05:56'),
	(13, 'KOTA TANGERANG SELATAN', 'BANTEN', '2025-02-26 05:06:46'),
	(14, 'KOTA TANGERANG', 'BANTEN', '2025-02-26 05:06:58'),
	(15, 'KAB TANGERANG', 'BANTEN', '2025-02-26 05:07:10');

-- Dumping structure for table db_rab.mst_user
DROP TABLE IF EXISTS `mst_user`;
CREATE TABLE IF NOT EXISTS `mst_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` varchar(1) NOT NULL DEFAULT 'Y',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_rab.mst_user: ~0 rows (approximately)
REPLACE INTO `mst_user` (`id`, `username`, `password`, `is_active`, `date_created`) VALUES
	(1, 'agus@solusiciptamedia.com', '$2y$10$Zt89hpSnBkR6s9yJcANteuUE1vu3.AsXKbHZADBqn3rK3rfn0O91e', '1', '2025-02-25 10:28:10');

-- Dumping structure for table db_rab.tbl_harga_jasa
DROP TABLE IF EXISTS `tbl_harga_jasa`;
CREATE TABLE IF NOT EXISTS `tbl_harga_jasa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mst_jasa` int(11) NOT NULL,
  `kode_jasa` varchar(8) NOT NULL,
  `nama_jasa` varchar(50) NOT NULL,
  `harga` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `id_mst_lokasi` int(11) NOT NULL,
  `kab_kota` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_tbl_harga_jasa_mst_jasa` (`id_mst_jasa`),
  KEY `FK_tbl_harga_jasa_mst_lokasi` (`id_mst_lokasi`),
  CONSTRAINT `FK_tbl_harga_jasa_mst_jasa` FOREIGN KEY (`id_mst_jasa`) REFERENCES `mst_jasa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_harga_jasa_mst_lokasi` FOREIGN KEY (`id_mst_lokasi`) REFERENCES `mst_lokasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_rab.tbl_harga_jasa: ~6 rows (approximately)
REPLACE INTO `tbl_harga_jasa` (`id`, `id_mst_jasa`, `kode_jasa`, `nama_jasa`, `harga`, `id_mst_lokasi`, `kab_kota`, `date_created`) VALUES
	(6, 6, 'JS-1002', 'ASISTEN TUKANG', 110000.000000, 12, 'KOTA BATU', '2025-02-26 05:10:21'),
	(7, 6, 'JS-1002', 'ASISTEN TUKANG', 110000.000000, 11, 'KOTA MALANG', '2025-02-26 05:10:31'),
	(8, 6, 'JS-1002', 'ASISTEN TUKANG', 110000.000000, 10, 'KAB MALANG', '2025-02-26 05:10:39'),
	(9, 5, 'JS-1001', 'TUKANG BATU', 150000.000000, 10, 'KAB MALANG', '2025-02-26 05:10:49'),
	(10, 5, 'JS-1001', 'TUKANG BATU', 150000.000000, 11, 'KOTA MALANG', '2025-02-26 05:10:58'),
	(11, 5, 'JS-1001', 'TUKANG BATU', 150000.000000, 12, 'KOTA BATU', '2025-02-26 05:11:06');

-- Dumping structure for table db_rab.tbl_harga_material
DROP TABLE IF EXISTS `tbl_harga_material`;
CREATE TABLE IF NOT EXISTS `tbl_harga_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mst_barang` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `id_mst_lokasi` int(11) NOT NULL,
  `kab_kota` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_tbl_harga_mst_lokasi` (`id_mst_lokasi`),
  KEY `FK_tbl_harga_mst_barang` (`id_mst_barang`),
  CONSTRAINT `FK_tbl_harga_mst_barang` FOREIGN KEY (`id_mst_barang`) REFERENCES `mst_barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_harga_mst_lokasi` FOREIGN KEY (`id_mst_lokasi`) REFERENCES `mst_lokasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_rab.tbl_harga_material: ~8 rows (approximately)
REPLACE INTO `tbl_harga_material` (`id`, `id_mst_barang`, `kode_barang`, `nama_barang`, `harga`, `id_mst_lokasi`, `kab_kota`, `date_created`) VALUES
	(8, 8, 'RM-1002', 'SEMEN MERDEKA 40KG', 45000.000000, 12, 'KOTA BATU', '2025-02-26 05:08:51'),
	(9, 8, 'RM-1002', 'SEMEN MERDEKA 40KG', 45000.000000, 11, 'KOTA MALANG', '2025-02-26 05:09:01'),
	(10, 8, 'RM-1002', 'SEMEN MERDEKA 40KG', 45000.000000, 10, 'KAB MALANG', '2025-02-26 05:09:12'),
	(11, 7, 'RM-1001', 'PASIR PASANG 1 M3', 170000.000000, 10, 'KAB MALANG', '2025-02-26 05:09:24'),
	(12, 7, 'RM-1001', 'PASIR PASANG 1 M3', 170000.000000, 11, 'KOTA MALANG', '2025-02-26 05:09:38'),
	(13, 7, 'RM-1001', 'PASIR PASANG 1 M3', 170000.000000, 12, 'KOTA BATU', '2025-02-26 05:09:56'),
	(15, 10, 'RM-1003', 'BATA MERAH 1 PCS', 700.000000, 10, 'KAB MALANG', '2025-02-26 05:47:51'),
	(16, 10, 'RM-1003', 'BATA MERAH 1 PCS', 700.000000, 11, 'KOTA MALANG', '2025-02-26 05:47:59'),
	(17, 10, 'RM-1003', 'BATA MERAH 1 PCS', 700.000000, 12, 'KOTA BATU', '2025-02-26 05:48:07');

-- Dumping structure for table db_rab.tbl_pekerjaan_detail
DROP TABLE IF EXISTS `tbl_pekerjaan_detail`;
CREATE TABLE IF NOT EXISTS `tbl_pekerjaan_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tbl_pekerjaan_header` int(11) NOT NULL,
  `kode_pekerjaan` varchar(10) NOT NULL,
  `uraian_pekerjaan` varchar(255) NOT NULL,
  `kode_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `qty` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `harga_bahan` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `harga_konversi` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_tbl_pekerjaan_detail_tbl_pekerjaan_header` (`id_tbl_pekerjaan_header`),
  CONSTRAINT `FK_tbl_pekerjaan_detail_tbl_pekerjaan_header` FOREIGN KEY (`id_tbl_pekerjaan_header`) REFERENCES `tbl_pekerjaan_header` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_rab.tbl_pekerjaan_detail: ~3 rows (approximately)
REPLACE INTO `tbl_pekerjaan_detail` (`id`, `id_tbl_pekerjaan_header`, `kode_pekerjaan`, `uraian_pekerjaan`, `kode_barang`, `nama_barang`, `qty`, `harga_bahan`, `harga_konversi`, `date_created`) VALUES
	(4, 1, 'ITEM-1001', 'Tembok Kasar 1 M3', 'RM-1001', 'PASIR PASANG 1 M3', 0.175000, 175000.000000, 30625.000000, '2025-02-28 01:34:06'),
	(5, 1, 'ITEM-1001', 'Tembok Kasar 1 M3', 'RM-1002', 'SEMEN MERDEKA 40KG', 1.000000, 45000.000000, 45000.000000, '2025-02-28 01:34:09'),
	(6, 1, 'ITEM-1001', 'Tembok Kasar 1 M3', 'RM-1003', 'BATA MERAH 1 PCS', 75.000000, 700.000000, 52500.000000, '2025-02-28 01:34:10');

-- Dumping structure for table db_rab.tbl_pekerjaan_header
DROP TABLE IF EXISTS `tbl_pekerjaan_header`;
CREATE TABLE IF NOT EXISTS `tbl_pekerjaan_header` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pekerjaan` varchar(10) NOT NULL,
  `uraian_pekerjaan` varchar(255) NOT NULL,
  `kab_kota` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_rab.tbl_pekerjaan_header: ~1 rows (approximately)
REPLACE INTO `tbl_pekerjaan_header` (`id`, `kode_pekerjaan`, `uraian_pekerjaan`, `kab_kota`, `date_created`) VALUES
	(1, 'ITEM-1001', 'Tembok Kasar 1 M3', 'KAB MALANG', '2025-02-28 01:00:10'),
	(16, 'ITEM-1002', 'Acian Finishing', 'KOTA MALANG', '2025-02-28 01:44:43');

-- Dumping structure for table db_rab.tbl_rab_detail
DROP TABLE IF EXISTS `tbl_rab_detail`;
CREATE TABLE IF NOT EXISTS `tbl_rab_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tbl_rab_header` int(11) NOT NULL,
  `so_number` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_rab.tbl_rab_detail: ~0 rows (approximately)

-- Dumping structure for table db_rab.tbl_rab_header
DROP TABLE IF EXISTS `tbl_rab_header`;
CREATE TABLE IF NOT EXISTS `tbl_rab_header` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `so_number` varchar(10) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_rab.tbl_rab_header: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
