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

-- Dumping data for table db_rab.mst_barang: ~2 rows (approximately)
DELETE FROM `mst_barang`;
INSERT INTO `mst_barang` (`id`, `kode_barang`, `nama_barang`, `date_created`) VALUES
	(7, 'RM-1001', 'PASIR PASANG 1 M3', '2025-02-26 05:07:46'),
	(8, 'RM-1002', 'SEMEN MERDEKA 40KG', '2025-02-26 05:07:59'),
	(10, 'RM-1003', 'BATA MERAH 1 PCS', '2025-02-26 05:47:34');

-- Dumping data for table db_rab.mst_jasa: ~1 rows (approximately)
DELETE FROM `mst_jasa`;
INSERT INTO `mst_jasa` (`id`, `kode_jasa`, `nama_jasa`, `date_created`) VALUES
	(5, 'JS-1001', 'TUKANG BATU', '2025-02-26 05:08:20'),
	(6, 'JS-1002', 'ASISTEN TUKANG', '2025-02-26 05:08:28');

-- Dumping data for table db_rab.mst_lokasi: ~5 rows (approximately)
DELETE FROM `mst_lokasi`;
INSERT INTO `mst_lokasi` (`id`, `kab_kota`, `provinsi`, `date_created`) VALUES
	(10, 'KAB MALANG', 'JAWA TIMUR', '2025-02-26 05:05:42'),
	(11, 'KOTA MALANG', 'JAWA TIMUR', '2025-02-26 05:05:34'),
	(12, 'KOTA BATU', 'JAWA TIMUR', '2025-02-26 05:05:56'),
	(13, 'KOTA TANGERANG SELATAN', 'BANTEN', '2025-02-26 05:06:46'),
	(14, 'KOTA TANGERANG', 'BANTEN', '2025-02-26 05:06:58'),
	(15, 'KAB TANGERANG', 'BANTEN', '2025-02-26 05:07:10');

-- Dumping data for table db_rab.mst_user: ~0 rows (approximately)
DELETE FROM `mst_user`;
INSERT INTO `mst_user` (`id`, `username`, `password`, `is_active`, `date_created`) VALUES
	(1, 'agus@solusiciptamedia.com', '$2y$10$Zt89hpSnBkR6s9yJcANteuUE1vu3.AsXKbHZADBqn3rK3rfn0O91e', '1', '2025-02-25 10:28:10');

-- Dumping data for table db_rab.tbl_harga_jasa: ~6 rows (approximately)
DELETE FROM `tbl_harga_jasa`;
INSERT INTO `tbl_harga_jasa` (`id`, `id_mst_jasa`, `kode_jasa`, `nama_jasa`, `harga`, `id_mst_lokasi`, `kab_kota`, `date_created`) VALUES
	(6, 6, 'JS-1002', 'ASISTEN TUKANG', 110000.000000, 12, 'KOTA BATU', '2025-02-26 05:10:21'),
	(7, 6, 'JS-1002', 'ASISTEN TUKANG', 110000.000000, 11, 'KOTA MALANG', '2025-02-26 05:10:31'),
	(8, 6, 'JS-1002', 'ASISTEN TUKANG', 110000.000000, 10, 'KAB MALANG', '2025-02-26 05:10:39'),
	(9, 5, 'JS-1001', 'TUKANG BATU', 150000.000000, 10, 'KAB MALANG', '2025-02-26 05:10:49'),
	(10, 5, 'JS-1001', 'TUKANG BATU', 150000.000000, 11, 'KOTA MALANG', '2025-02-26 05:10:58'),
	(11, 5, 'JS-1001', 'TUKANG BATU', 150000.000000, 12, 'KOTA BATU', '2025-02-26 05:11:06');

-- Dumping data for table db_rab.tbl_harga_material: ~8 rows (approximately)
DELETE FROM `tbl_harga_material`;
INSERT INTO `tbl_harga_material` (`id`, `id_mst_barang`, `kode_barang`, `nama_barang`, `harga`, `id_mst_lokasi`, `kab_kota`, `date_created`) VALUES
	(8, 8, 'RM-1002', 'SEMEN MERDEKA 40KG', 45000.000000, 12, 'KOTA BATU', '2025-02-26 05:08:51'),
	(9, 8, 'RM-1002', 'SEMEN MERDEKA 40KG', 45000.000000, 11, 'KOTA MALANG', '2025-02-26 05:09:01'),
	(10, 8, 'RM-1002', 'SEMEN MERDEKA 40KG', 45000.000000, 10, 'KAB MALANG', '2025-02-26 05:09:12'),
	(11, 7, 'RM-1001', 'PASIR PASANG 1 M3', 170000.000000, 10, 'KAB MALANG', '2025-02-26 05:09:24'),
	(12, 7, 'RM-1001', 'PASIR PASANG 1 M3', 170000.000000, 11, 'KOTA MALANG', '2025-02-26 05:09:38'),
	(13, 7, 'RM-1001', 'PASIR PASANG 1 M3', 170000.000000, 12, 'KOTA BATU', '2025-02-26 05:09:56'),
	(15, 10, 'RM-1003', 'BATA MERAH 1 PCS', 700.000000, 10, 'KAB MALANG', '2025-02-26 05:47:51'),
	(16, 10, 'RM-1003', 'BATA MERAH 1 PCS', 700.000000, 11, 'KOTA MALANG', '2025-02-26 05:47:59'),
	(17, 10, 'RM-1003', 'BATA MERAH 1 PCS', 700.000000, 12, 'KOTA BATU', '2025-02-26 05:48:07');

-- Dumping data for table db_rab.tbl_pekerjaan_detail: ~3 rows (approximately)
DELETE FROM `tbl_pekerjaan_detail`;
INSERT INTO `tbl_pekerjaan_detail` (`id`, `id_tbl_pekerjaan_header`, `kode_pekerjaan`, `uraian_pekerjaan`, `kode_barang`, `nama_barang`, `qty`, `harga_bahan`, `harga_konversi`, `date_created`) VALUES
	(4, 1, 'ITEM-1001', 'Tembok Kasar 1 M3', 'RM-1001', 'PASIR PASANG 1 M3', 0.175000, 175000.000000, 30625.000000, '2025-02-28 01:34:06'),
	(5, 1, 'ITEM-1001', 'Tembok Kasar 1 M3', 'RM-1002', 'SEMEN MERDEKA 40KG', 1.000000, 45000.000000, 45000.000000, '2025-02-28 01:34:09'),
	(6, 1, 'ITEM-1001', 'Tembok Kasar 1 M3', 'RM-1003', 'BATA MERAH 1 PCS', 75.000000, 700.000000, 52500.000000, '2025-02-28 01:34:10');

-- Dumping data for table db_rab.tbl_pekerjaan_header: ~1 rows (approximately)
DELETE FROM `tbl_pekerjaan_header`;
INSERT INTO `tbl_pekerjaan_header` (`id`, `kode_pekerjaan`, `uraian_pekerjaan`, `kab_kota`, `date_created`) VALUES
	(1, 'ITEM-1001', 'Tembok Kasar 1 M3', 'KAB MALANG', '2025-02-28 01:00:10'),
	(16, 'ITEM-1002', 'Acian Finishing', 'KOTA MALANG', '2025-02-28 01:44:43');

-- Dumping data for table db_rab.tbl_rab_detail: ~0 rows (approximately)
DELETE FROM `tbl_rab_detail`;

-- Dumping data for table db_rab.tbl_rab_header: ~0 rows (approximately)
DELETE FROM `tbl_rab_header`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
