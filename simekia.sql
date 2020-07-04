-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.6026
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for simekia
DROP DATABASE IF EXISTS `simekia`;
CREATE DATABASE IF NOT EXISTS `simekia` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `simekia`;

-- Dumping structure for table simekia.antrian_dokter
DROP TABLE IF EXISTS `antrian_dokter`;
CREATE TABLE IF NOT EXISTS `antrian_dokter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` enum('imunisasi','pemeriksaan') DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `pasien_id` int(11) DEFAULT NULL,
  `status` enum('antri','diperiksa','lewati','selesai') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table simekia.antrian_dokter: ~4 rows (approximately)
DELETE FROM `antrian_dokter`;
/*!40000 ALTER TABLE `antrian_dokter` DISABLE KEYS */;
INSERT INTO `antrian_dokter` (`id`, `jenis`, `tgl`, `pasien_id`, `status`, `created_at`, `updated_at`) VALUES
	(6, 'imunisasi', '2020-07-01 05:08:25', 2, 'selesai', '2020-06-30 04:20:13', '2020-06-30 04:20:13'),
	(7, 'pemeriksaan', '2020-07-01 07:08:41', 2, 'selesai', '2020-07-01 07:08:41', '2020-07-01 07:08:41'),
	(8, 'pemeriksaan', '2020-07-01 08:08:42', 2, 'selesai', '2020-07-01 08:08:42', '2020-07-01 08:08:42'),
	(9, 'pemeriksaan', '2020-07-01 09:42:42', 2, 'selesai', '2020-07-01 09:42:43', '2020-07-01 09:42:43'),
	(10, 'pemeriksaan', '2020-07-01 19:21:01', 2, 'selesai', '2020-07-01 19:21:01', '2020-07-01 19:21:01'),
	(11, 'pemeriksaan', '2020-07-04 10:37:43', 3, 'selesai', '2020-07-04 10:37:43', '2020-07-04 10:37:43'),
	(12, 'pemeriksaan', '2020-07-04 10:50:48', 2, 'antri', '2020-07-04 10:50:48', '2020-07-04 10:50:48'),
	(13, 'imunisasi', '2020-07-04 10:59:59', 3, 'diperiksa', '2020-07-04 10:59:59', '2020-07-04 10:59:59');
/*!40000 ALTER TABLE `antrian_dokter` ENABLE KEYS */;

-- Dumping structure for table simekia.antrian_obat
DROP TABLE IF EXISTS `antrian_obat`;
CREATE TABLE IF NOT EXISTS `antrian_obat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` enum('imunisasi','pemeriksaan') DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `pasien_id` int(11) DEFAULT NULL,
  `status` enum('antri','lewati','selesai') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table simekia.antrian_obat: ~0 rows (approximately)
DELETE FROM `antrian_obat`;
/*!40000 ALTER TABLE `antrian_obat` DISABLE KEYS */;
INSERT INTO `antrian_obat` (`id`, `jenis`, `tgl`, `pasien_id`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'pemeriksaan', '2020-07-01 09:48:24', 2, 'selesai', '2020-07-01 09:48:24', '2020-07-01 09:48:24'),
	(2, 'pemeriksaan', '2020-07-01 19:21:45', 2, 'antri', '2020-07-01 19:21:45', '2020-07-01 19:21:45'),
	(3, 'pemeriksaan', '2020-07-04 10:40:03', 3, 'selesai', '2020-07-04 10:40:03', '2020-07-04 10:40:03');
/*!40000 ALTER TABLE `antrian_obat` ENABLE KEYS */;

-- Dumping structure for table simekia.antropometri
DROP TABLE IF EXISTS `antropometri`;
CREATE TABLE IF NOT EXISTS `antropometri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` datetime NOT NULL,
  `pasien_id` int(11) NOT NULL DEFAULT 0,
  `berat_badan` double NOT NULL,
  `tinggi_badan` double NOT NULL,
  `lingkar_kepala` double NOT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table simekia.antropometri: ~0 rows (approximately)
DELETE FROM `antropometri`;
/*!40000 ALTER TABLE `antropometri` DISABLE KEYS */;
INSERT INTO `antropometri` (`id`, `tgl`, `pasien_id`, `berat_badan`, `tinggi_badan`, `lingkar_kepala`, `catatan`, `created_at`, `updated_at`) VALUES
	(7, '2020-06-30 04:20:46', 2, 75, 105, 45, NULL, '2020-06-30 04:20:46', '2020-06-30 04:20:46'),
	(8, '2020-07-01 06:02:58', 3, 75, 30, 45, NULL, '2020-07-01 06:02:58', '2020-07-01 06:02:58');
/*!40000 ALTER TABLE `antropometri` ENABLE KEYS */;

-- Dumping structure for table simekia.bulan
DROP TABLE IF EXISTS `bulan`;
CREATE TABLE IF NOT EXISTS `bulan` (
  `kode` tinyint(4) NOT NULL DEFAULT 0,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table simekia.bulan: ~0 rows (approximately)
DELETE FROM `bulan`;
/*!40000 ALTER TABLE `bulan` DISABLE KEYS */;
INSERT INTO `bulan` (`kode`, `nama`) VALUES
	(1, 'Januari'),
	(2, 'Februari'),
	(3, 'Maret'),
	(4, 'April'),
	(5, 'Mei'),
	(6, 'Juni'),
	(7, 'Juli'),
	(8, 'Agustus'),
	(9, 'September'),
	(10, 'Oktober'),
	(11, 'November'),
	(12, 'Desember');
/*!40000 ALTER TABLE `bulan` ENABLE KEYS */;

-- Dumping structure for table simekia.imunisasi
DROP TABLE IF EXISTS `imunisasi`;
CREATE TABLE IF NOT EXISTS `imunisasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `jenis_imunisasi_id` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `resep` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table simekia.imunisasi: ~0 rows (approximately)
DELETE FROM `imunisasi`;
/*!40000 ALTER TABLE `imunisasi` DISABLE KEYS */;
INSERT INTO `imunisasi` (`id`, `tgl`, `pasien_id`, `jenis_imunisasi_id`, `keterangan`, `resep`, `created_at`, `updated_at`) VALUES
	(2, '2020-07-04', 3, 1, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `imunisasi` ENABLE KEYS */;

-- Dumping structure for table simekia.jenis_imunisasi
DROP TABLE IF EXISTS `jenis_imunisasi`;
CREATE TABLE IF NOT EXISTS `jenis_imunisasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `usia` tinyint(4) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table simekia.jenis_imunisasi: ~35 rows (approximately)
DELETE FROM `jenis_imunisasi`;
/*!40000 ALTER TABLE `jenis_imunisasi` DISABLE KEYS */;
INSERT INTO `jenis_imunisasi` (`id`, `nama`, `usia`, `keterangan`, `created_at`, `updated_at`) VALUES
	(1, 'Hepatitis B-1', 0, 'Vaksin hepatitis B (HB). Menurut jadwal imunisasi IDAI, vaksin HB pertama (monovalent) paling baik diberikan dalam waktu 12 jam setelah lahir dan didahului pemberian suntikan vitamin K1 minimal 30 menit sebelumnya. Jadwal imunisasi lengkap pemberian vaksin HB monovalen adalah usia 0,1, dan 6 bulan. Bayi lahir dari ibu HBsAg positif, diberikan vaksin HB dan imunoglobin hepatitis B (HBIg) pada ekstrimitas yang berbeda. Apabila diberikan HB kombinasi dengan DTPw, maka jadwal imunisasi lengkap dilakukan pada usia 2,3, dan 4 bulan. Apabila vaksin HB kombinasi dengan DTPa, maka jadwal pemberian pada usia 2,4, dan 6 bulan.', NULL, NULL),
	(2, 'Polio-0\r\n', 0, 'Vaksin polio. Apabila lahir di rumah segera berikan OPV-0. Apabila lahir di sarana kesehatan, OPV-0 diberikan saat bayi dipulangkan. Selanjutnya, untuk polio-1, polio-2, polio-3, dan polio booster diberikan OPV atau IPV. Paling sedikit harus mendapat satu dosis vaksin IPV bersamaan dengan pemberian OPV-3.\r\n', NULL, NULL),
	(3, 'BCG', 0, 'Vaksin BCG. Pemberian vaksin BCG berdasarkan jadwal imunisasi IDAI dianjurkan sebelum usia 3 bulan, optimal usia 2 bulan. Apabila diberikan pada usia 3 bulan atau lebih, perlu dilakukan uji tuberculin terlebih dahulu.\r\n', NULL, NULL),
	(4, '	Hepatitis B-2', 2, 'Vaksin hepatitis B (HB). Menurut jadwal imunisasi IDAI, vaksin HB pertama (monovalent) paling baik diberikan dalam waktu 12 jam setelah lahir dan didahului pemberian suntikan vitamin K1 minimal 30 menit sebelumnya. Jadwal imunisasi lengkap pemberian vaksin HB monovalen adalah usia 0,1, dan 6 bulan. Bayi lahir dari ibu HBsAg positif, diberikan vaksin HB dan imunoglobin hepatitis B (HBIg) pada ekstrimitas yang berbeda. Apabila diberikan HB kombinasi dengan DTPw, maka jadwal imunisasi lengkap dilakukan pada usia 2,3, dan 4 bulan. Apabila vaksin HB kombinasi dengan DTPa, maka jadwal pemberian pada usia 2,4, dan 6 bulan.', NULL, NULL),
	(5, 'Polio-1\r\n', 2, 'Vaksin polio. Apabila lahir di rumah segera berikan OPV-0. Apabila lahir di sarana kesehatan, OPV-0 diberikan saat bayi dipulangkan. Selanjutnya, untuk polio-1, polio-2, polio-3, dan polio booster diberikan OPV atau IPV. Paling sedikit harus mendapat satu dosis vaksin IPV bersamaan dengan pemberian OPV-3.\r\n', NULL, NULL),
	(6, 'DTP-1\r\n', 2, 'Vaksin DTP. Vaksin DTP pertama diberikan paling cepat pada usia 6 minggu. Dapat diberikan vaksin DTPw atau DTPa atau kombinasi dengan vaksin lain. Apabila diberikan vaksin DTPa maka interval jadwal imunisasi lengkap pemberian vaksin lanjutan tersebut pada usia 2,4, dan 6 bulan. Untuk usia lebih dari 7 bulan diberikan vaksin Td atau Tdap. Untuk DTP 6 dapat diberikan Td/Tdap pada usia 10-12 tahun dan booster Td diberikan setiap 10 tahun.\r\n', NULL, NULL),
	(7, 'Hib-1\r\n', 2, 'Pemberian vaksin Hib pada anak sudah harus dilakukan saat ia berusia 2, 3, dan 4 bulan. Kemudian pemberian vaksin Hib ulang perlu diulang ketika anak sudah memasuki usia 18 bulan. Sedangkan pada orang dewasa, vaksin Hib bisa diberikan pada usia berapa pun dengan dosis pemberian sebanyak 1–3 kali.', NULL, NULL),
	(8, 'PCV-1\r\n', 2, 'Vaksin pneumokokus (PCV). Apabila diberikan pada usia 7-12 bulan, PCV diberikan 2 kali dengan interval 2 bulan; dan pada usia lebih dari 1 tahun diberikan 1 kali. Keduanya perlu booster pada usia lebih dari 12 bulan atau minimal 2 bulan setelah dosis terakhir. Pada anak usia di atas 2 tahun PCV diberikan cukup satu kali.\r\n', NULL, NULL),
	(9, 'Rotavirus-1\r\n', 2, 'Vaksin rotavirus. Vaksin rotavirus monovalen diberikan 2 kali, dosis pertama diberikan usia 6-14 minggu (dosis pertama tidak diberikan pada usia ≥ 15 minggu), dosis ke-2 diberikan dengan interval minimal 4 minggu. Batas akhir pemberian pada usia 24 minggu. Vaksin rotavirus pentavalen diberikan 3 kali, dosis pertama diberikan usia 6-14 minggu (dosis pertama tidak diberikan pada usia ≥ 15 minggu), dosis kedua dan ketiga diberikan dengan interval 4-10 minggu. Batas akhir pemberian pada usia 32 minggu.\r\n', NULL, NULL),
	(10, 'Hepatitis B-3\r\n', 3, 'Vaksin hepatitis B (HB). Menurut jadwal imunisasi IDAI, vaksin HB pertama (monovalent) paling baik diberikan dalam waktu 12 jam setelah lahir dan didahului pemberian suntikan vitamin K1 minimal 30 menit sebelumnya. Jadwal imunisasi lengkap pemberian vaksin HB monovalen adalah usia 0,1, dan 6 bulan. Bayi lahir dari ibu HBsAg positif, diberikan vaksin HB dan imunoglobin hepatitis B (HBIg) pada ekstrimitas yang berbeda. Apabila diberikan HB kombinasi dengan DTPw, maka jadwal imunisasi lengkap dilakukan pada usia 2,3, dan 4 bulan. Apabila vaksin HB kombinasi dengan DTPa, maka jadwal pemberian pada usia 2,4, dan 6 bulan.', NULL, NULL),
	(11, 'Polio-2\r\n', 3, 'Vaksin polio. Apabila lahir di rumah segera berikan OPV-0. Apabila lahir di sarana kesehatan, OPV-0 diberikan saat bayi dipulangkan. Selanjutnya, untuk polio-1, polio-2, polio-3, dan polio booster diberikan OPV atau IPV. Paling sedikit harus mendapat satu dosis vaksin IPV bersamaan dengan pemberian OPV-3.\r\n', NULL, NULL),
	(12, 'DTP-2\r\n', 3, 'Vaksin DTP. Vaksin DTP pertama diberikan paling cepat pada usia 6 minggu. Dapat diberikan vaksin DTPw atau DTPa atau kombinasi dengan vaksin lain. Apabila diberikan vaksin DTPa maka interval jadwal imunisasi lengkap pemberian vaksin lanjutan tersebut pada usia 2,4, dan 6 bulan. Untuk usia lebih dari 7 bulan diberikan vaksin Td atau Tdap. Untuk DTP 6 dapat diberikan Td/Tdap pada usia 10-12 tahun dan booster Td diberikan setiap 10 tahun.\r\n', NULL, NULL),
	(13, 'Hib-2\r\n', 3, 'Pemberian vaksin Hib pada anak sudah harus dilakukan saat ia berusia 2, 3, dan 4 bulan. Kemudian pemberian vaksin Hib ulang perlu diulang ketika anak sudah memasuki usia 18 bulan. Sedangkan pada orang dewasa, vaksin Hib bisa diberikan pada usia berapa pun dengan dosis pemberian sebanyak 1–3 kali.', NULL, NULL),
	(14, 'Hepatitis B-4\r\n', 4, 'Vaksin hepatitis B (HB). Menurut jadwal imunisasi IDAI, vaksin HB pertama (monovalent) paling baik diberikan dalam waktu 12 jam setelah lahir dan didahului pemberian suntikan vitamin K1 minimal 30 menit sebelumnya. Jadwal imunisasi lengkap pemberian vaksin HB monovalen adalah usia 0,1, dan 6 bulan. Bayi lahir dari ibu HBsAg positif, diberikan vaksin HB dan imunoglobin hepatitis B (HBIg) pada ekstrimitas yang berbeda. Apabila diberikan HB kombinasi dengan DTPw, maka jadwal imunisasi lengkap dilakukan pada usia 2,3, dan 4 bulan. Apabila vaksin HB kombinasi dengan DTPa, maka jadwal pemberian pada usia 2,4, dan 6 bulan.', NULL, NULL),
	(15, 'Polio-3\r\n', 4, 'Vaksin polio. Apabila lahir di rumah segera berikan OPV-0. Apabila lahir di sarana kesehatan, OPV-0 diberikan saat bayi dipulangkan. Selanjutnya, untuk polio-1, polio-2, polio-3, dan polio booster diberikan OPV atau IPV. Paling sedikit harus mendapat satu dosis vaksin IPV bersamaan dengan pemberian OPV-3.\r\n', NULL, NULL),
	(16, 'DTP-3\r\n', 4, 'Vaksin DTP. Vaksin DTP pertama diberikan paling cepat pada usia 6 minggu. Dapat diberikan vaksin DTPw atau DTPa atau kombinasi dengan vaksin lain. Apabila diberikan vaksin DTPa maka interval jadwal imunisasi lengkap pemberian vaksin lanjutan tersebut pada usia 2,4, dan 6 bulan. Untuk usia lebih dari 7 bulan diberikan vaksin Td atau Tdap. Untuk DTP 6 dapat diberikan Td/Tdap pada usia 10-12 tahun dan booster Td diberikan setiap 10 tahun.\r\n', NULL, NULL),
	(17, 'Hib-3\r\n', 4, 'Pemberian vaksin Hib pada anak sudah harus dilakukan saat ia berusia 2, 3, dan 4 bulan. Kemudian pemberian vaksin Hib ulang perlu diulang ketika anak sudah memasuki usia 18 bulan. Sedangkan pada orang dewasa, vaksin Hib bisa diberikan pada usia berapa pun dengan dosis pemberian sebanyak 1–3 kali.', NULL, NULL),
	(18, 'PCV-2\r\n', 4, 'Vaksin pneumokokus (PCV). Apabila diberikan pada usia 7-12 bulan, PCV diberikan 2 kali dengan interval 2 bulan; dan pada usia lebih dari 1 tahun diberikan 1 kali. Keduanya perlu booster pada usia lebih dari 12 bulan atau minimal 2 bulan setelah dosis terakhir. Pada anak usia di atas 2 tahun PCV diberikan cukup satu kali.\r\n', NULL, NULL),
	(19, 'Rotavirus-2\r\n', 4, 'Vaksin rotavirus. Vaksin rotavirus monovalen diberikan 2 kali, dosis pertama diberikan usia 6-14 minggu (dosis pertama tidak diberikan pada usia ≥ 15 minggu), dosis ke-2 diberikan dengan interval minimal 4 minggu. Batas akhir pemberian pada usia 24 minggu. Vaksin rotavirus pentavalen diberikan 3 kali, dosis pertama diberikan usia 6-14 minggu (dosis pertama tidak diberikan pada usia ≥ 15 minggu), dosis kedua dan ketiga diberikan dengan interval 4-10 minggu. Batas akhir pemberian pada usia 32 minggu.\r\n', NULL, NULL),
	(20, 'PCV-3\r\n', 6, 'Vaksin pneumokokus (PCV). Apabila diberikan pada usia 7-12 bulan, PCV diberikan 2 kali dengan interval 2 bulan; dan pada usia lebih dari 1 tahun diberikan 1 kali. Keduanya perlu booster pada usia lebih dari 12 bulan atau minimal 2 bulan setelah dosis terakhir. Pada anak usia di atas 2 tahun PCV diberikan cukup satu kali.\r\n', NULL, NULL),
	(21, 'Rotavirus-3\r\n', 6, 'Vaksin rotavirus. Vaksin rotavirus monovalen diberikan 2 kali, dosis pertama diberikan usia 6-14 minggu (dosis pertama tidak diberikan pada usia ≥ 15 minggu), dosis ke-2 diberikan dengan interval minimal 4 minggu. Batas akhir pemberian pada usia 24 minggu. Vaksin rotavirus pentavalen diberikan 3 kali, dosis pertama diberikan usia 6-14 minggu (dosis pertama tidak diberikan pada usia ≥ 15 minggu), dosis kedua dan ketiga diberikan dengan interval 4-10 minggu. Batas akhir pemberian pada usia 32 minggu.\r\n', NULL, NULL),
	(22, 'Influenza', 6, 'Vaksin influenza. Berdasarkan jadwal imunisasi IDAI, vaksin influenza diberikan pada usia lebih dari 6 bulan, diulang setiap tahun. Untuk imunisasi pertama kali (primary immunization) pada anak usia kurang dari 9 tahun diberi dua kali dengan interval minimal 4 minggu. Untuk anak 6-36 bulan, dosis 0,25 mL. Untuk anak usia 36 bulan atau lebih, dosis 0,5 mL.\r\n', NULL, NULL),
	(23, 'Campak-1\r\n', 9, 'Vaksin campak. Vaksin campak kedua (18 bulan) tidak perlu diberikan apabila sudah mendapatkan MMR.\r\n', NULL, NULL),
	(24, 'Varisela', 12, 'Vaksin varisela. Vaksin varisela diberikan setelah usia 12 bulan, terbaik pada usia sebelum masuk sekolah dasar. Apabila diberikan pada usia lebih dari 13 tahun, perlu 2 dosis dengan interval minimal 4 minggu.\r\n', NULL, NULL),
	(25, 'PCV-4\r\n', 12, 'Vaksin pneumokokus (PCV). Apabila diberikan pada usia 7-12 bulan, PCV diberikan 2 kali dengan interval 2 bulan; dan pada usia lebih dari 1 tahun diberikan 1 kali. Keduanya perlu booster pada usia lebih dari 12 bulan atau minimal 2 bulan setelah dosis terakhir. Pada anak usia di atas 2 tahun PCV diberikan cukup satu kali.\r\n', NULL, NULL),
	(26, 'Japanese encephalitis-1\r\n', 12, 'Vaksin Japanese encephalitis (JE). Vaksin JE diberikan mulai usia 12 bulan pada daerah endemis atau turis yang akan bepergian ke daerah endemis tersebut. Untuk perlindungan jangka panjang dapat diberikan booster 1-2 tahun berikutnya.\r\n', NULL, NULL),
	(27, 'Hib-4\r\n', 15, 'Pemberian vaksin Hib pada anak sudah harus dilakukan saat ia berusia 2, 3, dan 4 bulan. Kemudian pemberian vaksin Hib ulang perlu diulang ketika anak sudah memasuki usia 18 bulan. Sedangkan pada orang dewasa, vaksin Hib bisa diberikan pada usia berapa pun dengan dosis pemberian sebanyak 1–3 kali.', NULL, NULL),
	(28, 'MMR-1\r\n', 15, 'Vaksin MMR/MR. Apabila sudah mendapatkan vaksin campak pada usia 9 bulan, maka vaksin MMR/MR diberikan pada usia 15 bulan (minimal interval 6 bulan). Apabila pada usia 12 bulan belum mendapatkan vaksin campak, maka dapat diberikan vaksin MMR/MR.\r\n', NULL, NULL),
	(29, 'Polio-4\r\n', 18, 'Vaksin polio. Apabila lahir di rumah segera berikan OPV-0. Apabila lahir di sarana kesehatan, OPV-0 diberikan saat bayi dipulangkan. Selanjutnya, untuk polio-1, polio-2, polio-3, dan polio booster diberikan OPV atau IPV. Paling sedikit harus mendapat satu dosis vaksin IPV bersamaan dengan pemberian OPV-3.\r\n', NULL, NULL),
	(30, 'DTP-4\r\n', 12, 'Vaksin DTP. Vaksin DTP pertama diberikan paling cepat pada usia 6 minggu. Dapat diberikan vaksin DTPw atau DTPa atau kombinasi dengan vaksin lain. Apabila diberikan vaksin DTPa maka interval jadwal imunisasi lengkap pemberian vaksin lanjutan tersebut pada usia 2,4, dan 6 bulan. Untuk usia lebih dari 7 bulan diberikan vaksin Td atau Tdap. Untuk DTP 6 dapat diberikan Td/Tdap pada usia 10-12 tahun dan booster Td diberikan setiap 10 tahun.\r\n', NULL, NULL),
	(31, 'Campak-2\r\n', 12, 'Vaksin campak. Vaksin campak kedua (18 bulan) tidak perlu diberikan apabila sudah mendapatkan MMR.\r\n', NULL, NULL),
	(32, 'Influenza', 12, 'Vaksin influenza. Berdasarkan jadwal imunisasi IDAI, vaksin influenza diberikan pada usia lebih dari 6 bulan, diulang setiap tahun. Untuk imunisasi pertama kali (primary immunization) pada anak usia kurang dari 9 tahun diberi dua kali dengan interval minimal 4 minggu. Untuk anak 6-36 bulan, dosis 0,25 mL. Untuk anak usia 36 bulan atau lebih, dosis 0,5 mL.\r\n', NULL, NULL),
	(33, 'Tifoid', 24, 'Ikatan Dokter Anak Indonesia (IDAI) merekomendasikan vaksin tifoid untuk diberikan pada anak usia 2 tahun dan diulang setiap 3 tahun hingga anak berusia 18 tahun.', NULL, NULL),
	(34, 'Hepatitis A\r\n', 24, 'Pemberian vaksin hepatitis A pertama sebaiknya dilakukan saat anak menginjak usia 2 tahun, kemudian dosis kedua dapat diberikan 6-12 bulan setelahnya.\r\n\r\n', NULL, NULL),
	(35, 'Japanese encephalitis-2\r\n', 24, 'Vaksin Japanese encephalitis (JE). Vaksin JE diberikan mulai usia 12 bulan pada daerah endemis atau turis yang akan bepergian ke daerah endemis tersebut. Untuk perlindungan jangka panjang dapat diberikan booster 1-2 tahun berikutnya.\r\n', NULL, NULL);
/*!40000 ALTER TABLE `jenis_imunisasi` ENABLE KEYS */;

-- Dumping structure for table simekia.ortu
DROP TABLE IF EXISTS `ortu`;
CREATE TABLE IF NOT EXISTS `ortu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_ayah` varchar(50) DEFAULT NULL,
  `nama_ibu` varchar(50) DEFAULT NULL,
  `alamat` mediumtext DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table simekia.ortu: ~0 rows (approximately)
DELETE FROM `ortu`;
/*!40000 ALTER TABLE `ortu` DISABLE KEYS */;
INSERT INTO `ortu` (`id`, `username`, `password`, `nama_ayah`, `nama_ibu`, `alamat`, `telp`, `email`, `created_at`, `updated_at`) VALUES
	(3, 'ortu', '469eb28221c8e6d092ddafacb87799bf', 'nama ayah', 'nama ibu', 'alamat', 'telp', 'email', '2020-06-29 05:21:11', '2020-06-29 05:21:11');
/*!40000 ALTER TABLE `ortu` ENABLE KEYS */;

-- Dumping structure for table simekia.pasien
DROP TABLE IF EXISTS `pasien`;
CREATE TABLE IF NOT EXISTS `pasien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ortu_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table simekia.pasien: ~0 rows (approximately)
DELETE FROM `pasien`;
/*!40000 ALTER TABLE `pasien` DISABLE KEYS */;
INSERT INTO `pasien` (`id`, `ortu_id`, `nama`, `jk`, `tempat_lahir`, `tgl_lahir`, `created_at`, `updated_at`) VALUES
	(2, 3, 'Yunita', 'P', 'Banyuwangi', '2017-11-26', '2020-06-29 15:17:12', '2020-06-29 15:37:19'),
	(3, 3, 'Andre', 'L', 'Banyuwangi', '2019-11-26', '2020-06-29 15:17:12', '2020-06-29 15:37:19');
/*!40000 ALTER TABLE `pasien` ENABLE KEYS */;

-- Dumping structure for table simekia.pemeriksaan
DROP TABLE IF EXISTS `pemeriksaan`;
CREATE TABLE IF NOT EXISTS `pemeriksaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` datetime DEFAULT NULL,
  `pasien_id` int(11) DEFAULT NULL,
  `anamnesa` text NOT NULL,
  `diagnosa` text NOT NULL,
  `tindakan` text NOT NULL,
  `resep` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table simekia.pemeriksaan: ~5 rows (approximately)
DELETE FROM `pemeriksaan`;
/*!40000 ALTER TABLE `pemeriksaan` DISABLE KEYS */;
INSERT INTO `pemeriksaan` (`id`, `tgl`, `pasien_id`, `anamnesa`, `diagnosa`, `tindakan`, `resep`, `created_at`, `updated_at`) VALUES
	(1, '2020-07-01 08:03:19', 3, 'a', 'd', 't', 'r', '2020-07-01 08:03:19', '2020-07-01 08:03:19'),
	(2, '2020-07-01 09:15:10', 2, '-', '-', '-', NULL, '2020-07-01 09:15:10', '2020-07-01 09:15:10'),
	(3, '2020-07-01 09:47:59', 2, 'a', 'd', 't', 'r', '2020-07-01 09:47:59', '2020-07-01 09:47:59'),
	(4, '2020-07-01 09:48:24', 2, 'a', 'd', 't', 'r', '2020-07-01 09:48:24', '2020-07-01 09:48:24'),
	(5, '2020-07-01 19:21:45', 2, 'anamnesa', 'diagnosa', 'tindakan', 'resep xxx 250gr\r\nresep bbb 36gr', '2020-07-01 19:21:45', '2020-07-01 19:21:45'),
	(6, '2020-07-04 10:40:03', 3, 'xxx', 'xxxx', 'xxxx', 'xxxx xxx xxxx', '2020-07-04 10:40:03', '2020-07-04 10:40:03');
/*!40000 ALTER TABLE `pemeriksaan` ENABLE KEYS */;

-- Dumping structure for table simekia.pengguna
DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE IF NOT EXISTS `pengguna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `telp` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `level` enum('resepsionis','dokter','apoteker','admin') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table simekia.pengguna: ~4 rows (approximately)
DELETE FROM `pengguna`;
/*!40000 ALTER TABLE `pengguna` DISABLE KEYS */;
INSERT INTO `pengguna` (`id`, `username`, `password`, `nama`, `telp`, `email`, `level`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', '000000000001', 'admin@simekia.com', 'admin', NULL, '2020-07-04 09:14:43'),
	(2, 'resepsionis', '3aeff485f68b360d076de3d73f9247ad', 'Resepsionis', '000000000002', 'resepsionis@simekia', 'resepsionis', '2020-06-30 11:35:51', '2020-06-30 11:35:51'),
	(3, 'dokter', 'd22af4180eee4bd95072eb90f94930e5', 'Dokter', '000000000003', 'dokter@simekia.com', 'dokter', NULL, NULL),
	(4, 'apoteker', '326dd0e9d42a3da01b50028c51cf21fc', 'Apoteker', '000000000004', 'apoteker@simekia.com', 'apoteker', NULL, NULL);
/*!40000 ALTER TABLE `pengguna` ENABLE KEYS */;

-- Dumping structure for table simekia.standart_bb_pb
DROP TABLE IF EXISTS `standart_bb_pb`;
CREATE TABLE IF NOT EXISTS `standart_bb_pb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jk` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `panjang_badan` float NOT NULL DEFAULT 0,
  `min_3_sd` float NOT NULL DEFAULT 0,
  `min_2_sd` float NOT NULL DEFAULT 0,
  `min_1_sd` float NOT NULL DEFAULT 0,
  `median` float NOT NULL DEFAULT 0,
  `plus_1_sd` float NOT NULL DEFAULT 0,
  `plus_2_sd` float NOT NULL DEFAULT 0,
  `plus_3_sd` float NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- Dumping data for table simekia.standart_bb_pb: ~36 rows (approximately)
DELETE FROM `standart_bb_pb`;
/*!40000 ALTER TABLE `standart_bb_pb` DISABLE KEYS */;
INSERT INTO `standart_bb_pb` (`id`, `jk`, `panjang_badan`, `min_3_sd`, `min_2_sd`, `min_1_sd`, `median`, `plus_1_sd`, `plus_2_sd`, `plus_3_sd`) VALUES
	(1, 'Laki-laki', 45, 1.9, 2, 2.2, 2.4, 2.7, 3, 3.3),
	(2, 'Laki-laki', 45.5, 1.9, 2.1, 2.3, 2.5, 2.8, 3.1, 3.4),
	(3, 'Laki-laki', 46, 2, 2.2, 2.4, 2.6, 2.9, 3.1, 3.5),
	(4, 'Laki-laki', 46.5, 2.1, 2.3, 2.5, 2.7, 3, 3.2, 3.6),
	(5, 'Laki-laki', 47, 2.1, 2.3, 2.5, 2.8, 3, 3.3, 3.7),
	(6, 'Laki-laki', 47.5, 2.2, 2.4, 2.6, 2.9, 3.1, 3.4, 3.8),
	(7, 'Laki-laki', 48, 2.3, 2.5, 2.7, 2.9, 3.2, 3.6, 3.9),
	(8, 'Laki-laki', 48.5, 2.3, 2.6, 2.8, 3, 3.3, 3.7, 4),
	(9, 'Laki-laki', 49, 2.4, 2.6, 2.9, 3.1, 3.4, 3.8, 4.2),
	(10, 'Laki-laki', 49.5, 2.5, 2.7, 3, 3.2, 3.5, 3.9, 4.3),
	(11, 'Laki-laki', 50, 2.6, 2.8, 3, 3.3, 3.6, 4, 4.4),
	(12, 'Laki-laki', 50.5, 2.7, 2.9, 3.2, 3.4, 3.8, 4.1, 4.5),
	(13, 'Laki-laki', 51, 2.7, 3, 3.2, 3.5, 3.9, 4.2, 4.7),
	(14, 'Laki-laki', 51.5, 2.8, 3.1, 3.3, 3.6, 4, 4.4, 4.8),
	(15, 'Laki-laki', 52, 2.9, 3.2, 3.5, 3.8, 4.1, 4.5, 5),
	(16, 'Laki-laki', 52.5, 3, 3.3, 3.6, 3.9, 4.2, 4.6, 5.1),
	(17, 'Laki-laki', 53, 3.1, 3.4, 3.7, 4, 4.4, 4.8, 5.3),
	(18, 'Laki-laki', 53.5, 3.2, 3.5, 3.8, 4.1, 4.5, 4.9, 5.4),
	(19, 'Laki-laki', 54, 3.3, 3.6, 3.9, 4.3, 4.7, 5.1, 5.6),
	(20, 'Laki-laki', 54.5, 3.4, 3.7, 4, 4.4, 4.8, 5.3, 5.8),
	(21, 'Laki-laki', 55, 3.6, 3.8, 4.2, 4.5, 5, 5.4, 6),
	(22, 'Laki-laki', 55.5, 3.7, 4, 4.3, 4.7, 5.1, 5.6, 6.1),
	(23, 'Laki-laki', 56, 3.8, 4.1, 4.4, 4.8, 5.3, 5.8, 6.3),
	(24, 'Laki-laki', 56.5, 3.9, 4.2, 4.6, 5, 5.4, 5.9, 6.5),
	(25, 'Laki-laki', 57, 4, 4.3, 4.7, 5.1, 5.6, 6.1, 6.7),
	(26, 'Laki-laki', 57.5, 4.1, 4.5, 4.9, 5.3, 5.7, 6.3, 6.9),
	(27, 'Laki-laki', 58, 4.3, 4.6, 5, 5.4, 5.9, 6.4, 7.1),
	(28, 'Laki-laki', 58.5, 4.4, 4.7, 5.1, 5.6, 6.1, 6.6, 7.2),
	(29, 'Laki-laki', 59, 4.5, 4.8, 5.3, 5.7, 6.2, 6.8, 7.4),
	(30, 'Laki-laki', 59.5, 4.6, 5, 5.4, 5.9, 6.4, 7, 7.6),
	(31, 'Laki-laki', 60, 4.7, 5.1, 5.5, 6, 6.5, 7.1, 7.8),
	(32, 'Laki-laki', 60.5, 4.8, 5.2, 5.6, 6.1, 6.7, 7.3, 8),
	(33, 'Laki-laki', 61, 4.9, 5.3, 5.8, 6.3, 6.8, 7.4, 8.1),
	(34, 'Laki-laki', 61.5, 5, 5.4, 5.9, 6.4, 7, 7.6, 8.3),
	(35, 'Laki-laki', 62, 5.1, 5.6, 6, 6.5, 7.1, 7.7, 8.5),
	(36, 'Laki-laki', 62.5, 5.2, 5.7, 6.1, 6.7, 7.2, 7.9, 8.6);
/*!40000 ALTER TABLE `standart_bb_pb` ENABLE KEYS */;

-- Dumping structure for table simekia.standart_bb_tb
DROP TABLE IF EXISTS `standart_bb_tb`;
CREATE TABLE IF NOT EXISTS `standart_bb_tb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jk` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `tinggi_badan` float NOT NULL DEFAULT 0,
  `min_3_sd` float NOT NULL DEFAULT 0,
  `min_2_sd` float NOT NULL DEFAULT 0,
  `min_1_sd` float NOT NULL DEFAULT 0,
  `median` float NOT NULL DEFAULT 0,
  `plus_1_sd` float NOT NULL DEFAULT 0,
  `plus_2_sd` float NOT NULL DEFAULT 0,
  `plus_3_sd` float NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table simekia.standart_bb_tb: ~0 rows (approximately)
DELETE FROM `standart_bb_tb`;
/*!40000 ALTER TABLE `standart_bb_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `standart_bb_tb` ENABLE KEYS */;

-- Dumping structure for table simekia.standart_bb_u
DROP TABLE IF EXISTS `standart_bb_u`;
CREATE TABLE IF NOT EXISTS `standart_bb_u` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jk` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `umur_bulan` int(11) NOT NULL DEFAULT 0,
  `min_3_sd` float NOT NULL DEFAULT 0,
  `min_2_sd` float NOT NULL DEFAULT 0,
  `min_1_sd` float NOT NULL DEFAULT 0,
  `median` float NOT NULL DEFAULT 0,
  `plus_1_sd` float NOT NULL DEFAULT 0,
  `plus_2_sd` float NOT NULL DEFAULT 0,
  `plus_3_sd` float NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

-- Dumping data for table simekia.standart_bb_u: ~97 rows (approximately)
DELETE FROM `standart_bb_u`;
/*!40000 ALTER TABLE `standart_bb_u` DISABLE KEYS */;
INSERT INTO `standart_bb_u` (`id`, `jk`, `umur_bulan`, `min_3_sd`, `min_2_sd`, `min_1_sd`, `median`, `plus_1_sd`, `plus_2_sd`, `plus_3_sd`) VALUES
	(1, 'Laki-laki', 0, 2.1, 2.5, 2.9, 3.3, 3.9, 4.4, 5),
	(2, 'Laki-laki', 1, 2.9, 3.4, 3.9, 4.5, 5.1, 5.8, 6.6),
	(3, 'Laki-laki', 2, 3.8, 4.3, 4.9, 5.6, 6.3, 7.1, 8),
	(4, 'Laki-laki', 3, 4.4, 5, 5.7, 6.4, 7.2, 8, 9),
	(5, 'Laki-laki', 4, 4.9, 5.6, 6.2, 7, 7.8, 8.7, 9.7),
	(6, 'Laki-laki', 5, 5.3, 6, 6.7, 7.5, 8.4, 9.3, 10.4),
	(7, 'Laki-laki', 6, 5.7, 6.4, 7.1, 7.9, 8.8, 9.8, 10.9),
	(8, 'Laki-laki', 7, 5.9, 6.7, 7.4, 8.3, 9.2, 10.3, 11.4),
	(9, 'Laki-laki', 8, 6.2, 6.9, 7.7, 8.6, 9.6, 10.7, 11.9),
	(10, 'Laki-laki', 9, 6.4, 7.1, 8, 8.9, 9.9, 11, 12.3),
	(11, 'Laki-laki', 10, 6.6, 7.4, 8.2, 9.2, 10.2, 11.4, 12.7),
	(12, 'Laki-laki', 11, 6.8, 7.6, 8.4, 9.4, 10.5, 11.7, 13),
	(13, 'Laki-laki', 12, 6.9, 7.7, 8.6, 9.6, 10.8, 12, 13.3),
	(14, 'Laki-laki', 13, 7.1, 7.9, 8.8, 9.9, 11, 12.3, 13.7),
	(15, 'Laki-laki', 14, 7.2, 8.1, 9, 10.1, 11.3, 12.6, 14),
	(16, 'Laki-laki', 15, 7.4, 8.3, 9.2, 10.3, 11.5, 12.8, 14.3),
	(17, 'Laki-laki', 16, 7.5, 8.4, 9.4, 10.5, 11.7, 13.1, 14.6),
	(18, 'Laki-laki', 17, 7.7, 8.6, 9.6, 10.7, 12, 13.4, 14.9),
	(19, 'Laki-laki', 18, 7.8, 8.8, 9.8, 10.9, 12.2, 13.7, 15.3),
	(20, 'Laki-laki', 19, 8, 8.9, 10, 11.1, 12.5, 13.9, 15.6),
	(21, 'Laki-laki', 20, 8.1, 9.1, 10.1, 11.3, 12.7, 14.2, 15.9),
	(22, 'Laki-laki', 21, 8.2, 9.2, 10.3, 11.5, 12.9, 14.5, 16.2),
	(23, 'Laki-laki', 22, 8.4, 9.4, 10.5, 11.8, 13.2, 14.7, 16.5),
	(24, 'Laki-laki', 23, 8.5, 9.5, 10.7, 12, 13.4, 15, 16.8),
	(25, 'Laki-laki', 24, 8.6, 9.7, 10.8, 12.2, 13.6, 15.3, 17.1),
	(26, 'Laki-laki', 25, 8.8, 9.8, 11, 12.4, 13.9, 15.5, 17.5),
	(27, 'Laki-laki', 26, 8.9, 10, 11.2, 12.5, 14.1, 15.8, 17.8),
	(28, 'Laki-laki', 27, 9, 10.1, 11.3, 12.7, 14.3, 16.1, 18.1),
	(29, 'Laki-laki', 28, 9.1, 10.2, 11.5, 12.9, 14.5, 16.3, 18.4),
	(30, 'Laki-laki', 29, 9.2, 10.4, 11.7, 13.1, 14.8, 16.6, 18.7),
	(31, 'Laki-laki', 30, 9.4, 10.5, 11.8, 13.3, 15, 16.9, 19),
	(32, 'Laki-laki', 31, 9.5, 10.7, 12, 13.5, 15.2, 17.1, 19.3),
	(33, 'Laki-laki', 32, 9.6, 10.8, 12.1, 13.7, 15.4, 17.4, 19.6),
	(34, 'Laki-laki', 33, 9.7, 10.9, 12.3, 13.8, 15.6, 17.6, 19.9),
	(35, 'Laki-laki', 34, 9.8, 11, 12.4, 14, 15.8, 17.8, 20.2),
	(36, 'Laki-laki', 35, 9.9, 11.2, 12.6, 14.2, 16, 18.1, 20.4),
	(37, 'Laki-laki', 36, 10, 11.3, 12.7, 14.3, 16.2, 18.3, 20.7),
	(38, 'Laki-laki', 37, 10.1, 11.4, 12.9, 14.5, 16.4, 18.6, 21),
	(39, 'Laki-laki', 38, 10.2, 11.5, 13, 14.7, 16.6, 18.8, 21.3),
	(40, 'Laki-laki', 39, 10.3, 11.6, 13.1, 14.8, 16.8, 19, 21.6),
	(41, 'Laki-laki', 40, 10.4, 11.8, 13.3, 15, 17, 19.3, 21.9),
	(42, 'Laki-laki', 41, 10.5, 11.9, 13.4, 15.2, 17.2, 19.5, 22.1),
	(43, 'Laki-laki', 42, 10.6, 12, 13.6, 15.3, 17.4, 19.7, 22.4),
	(44, 'Laki-laki', 43, 10.7, 12.1, 13.7, 15.5, 17.6, 20, 22.7),
	(45, 'Laki-laki', 44, 10.8, 12.2, 13.8, 15.7, 17.8, 20.2, 23),
	(46, 'Laki-laki', 45, 10.9, 12.4, 14, 15.8, 18, 20.5, 23.3),
	(47, 'Laki-laki', 46, 11, 12.5, 14.1, 16, 18.2, 20.7, 23.6),
	(48, 'Laki-laki', 47, 11.1, 12.6, 14.3, 16.2, 18.4, 20.9, 23.9),
	(49, 'Laki-laki', 48, 11.2, 12.7, 14.4, 16.3, 18.6, 21.2, 24.2),
	(50, 'Laki-laki', 49, 11.3, 12.8, 14.5, 16.5, 18.8, 21.4, 24.5),
	(51, 'Laki-laki', 50, 11.4, 12.9, 14.7, 16.7, 19, 21.7, 24.8),
	(52, 'Laki-laki', 51, 11.5, 13.1, 14.8, 16.8, 19.2, 21.9, 25.1),
	(53, 'Laki-laki', 52, 11.6, 13.2, 15, 17, 19.4, 22.2, 25.4),
	(54, 'Laki-laki', 53, 11.7, 13.3, 15.1, 17.2, 19.6, 22.4, 25.7),
	(55, 'Laki-laki', 54, 11.8, 13.4, 15.2, 17.3, 19.8, 22.7, 26),
	(56, 'Laki-laki', 55, 11.9, 13.5, 15.4, 17.5, 20, 22.9, 26.3),
	(57, 'Laki-laki', 56, 12, 13.6, 15.5, 17.7, 20.2, 23.2, 26.6),
	(58, 'Laki-laki', 57, 12.1, 13.7, 15.6, 17.8, 20.4, 23.4, 26.9),
	(59, 'Laki-laki', 58, 12.2, 13.8, 15.8, 18, 20.6, 23.7, 27.2),
	(60, 'Laki-laki', 59, 12.3, 14, 15.9, 18.2, 20.8, 23.9, 27.6),
	(61, 'Laki-laki', 60, 12.4, 14.1, 16, 18.3, 21, 24.2, 27.9),
	(63, 'Perempuan', 0, 2, 2.4, 2.8, 3.2, 3.7, 4.2, 4.8),
	(64, 'Perempuan', 1, 2.7, 3.2, 3.6, 4.2, 4.8, 5.5, 6.2),
	(65, 'Perempuan', 2, 3.4, 3.9, 4.5, 5.1, 5.8, 6.6, 7.5),
	(66, 'Perempuan', 3, 4, 4.5, 5.2, 5.8, 6.6, 7.5, 8.5),
	(67, 'Perempuan', 4, 4.4, 5, 5.7, 6.4, 7.3, 8.2, 9.3),
	(68, 'Perempuan', 5, 4.8, 5.4, 6.1, 6.9, 7.8, 8.8, 10),
	(69, 'Perempuan', 6, 5.1, 5.7, 6.5, 7.3, 8.2, 9.3, 10.6),
	(70, 'Perempuan', 7, 5.3, 6, 6.8, 7.6, 8.6, 9.8, 11.1),
	(71, 'Perempuan', 8, 5.6, 6.3, 7, 7.9, 9, 10.2, 11.6),
	(72, 'Perempuan', 9, 5.8, 6.5, 7.3, 8.2, 9.3, 10.5, 12),
	(73, 'Perempuan', 10, 5.9, 6.7, 7.5, 8.5, 9.6, 10.9, 12.4),
	(74, 'Perempuan', 11, 6.1, 6.9, 7.7, 8.7, 9.9, 11.2, 12.8),
	(75, 'Perempuan', 12, 6.3, 7, 7.9, 8.9, 10.1, 11.5, 13.1),
	(76, 'Perempuan', 13, 6.4, 7.2, 8.1, 9.2, 10.4, 11.8, 13.5),
	(77, 'Perempuan', 14, 6.6, 7.4, 8.3, 9.4, 10.6, 12.1, 13.8),
	(78, 'Perempuan', 15, 6.7, 7.6, 8.5, 9.6, 10.9, 12.4, 14.1),
	(79, 'Perempuan', 16, 6.9, 7.7, 8.7, 9.8, 11.1, 12.6, 14.5),
	(80, 'Perempuan', 17, 7, 7.9, 8.9, 10, 11.4, 12.9, 14.8),
	(81, 'Perempuan', 18, 7.2, 8.1, 9.1, 10.2, 11.6, 13.2, 15.1),
	(82, 'Perempuan', 19, 7.3, 8.2, 9.2, 10.4, 11.8, 13.5, 15.4),
	(83, 'Perempuan', 20, 7.5, 8.4, 9.4, 10.6, 12.1, 13.7, 15.7),
	(84, 'Perempuan', 21, 7.6, 8.6, 9.6, 10.9, 12.3, 14, 16),
	(85, 'Perempuan', 22, 7.8, 8.7, 9.8, 11.1, 12.5, 14.3, 16.4),
	(86, 'Perempuan', 23, 7.9, 8.9, 10, 11.3, 12.8, 14.6, 16.7),
	(87, 'Perempuan', 24, 8.1, 9, 10.2, 11.5, 13, 14.8, 17),
	(88, 'Perempuan', 25, 8.2, 9.2, 10.3, 11.7, 13.3, 15.1, 17.3),
	(89, 'Perempuan', 26, 8.4, 9.4, 10.5, 11.9, 13.5, 15.4, 17.7),
	(90, 'Perempuan', 27, 8.5, 9.5, 10.7, 12.1, 13.7, 15.7, 18),
	(91, 'Perempuan', 28, 8.6, 9.7, 10.9, 12.3, 14, 16, 18.3),
	(92, 'Perempuan', 29, 8.8, 9.8, 11.1, 12.5, 14.2, 16.2, 18.7),
	(93, 'Perempuan', 30, 8.9, 10, 11.2, 12.7, 14.4, 16.5, 19),
	(94, 'Perempuan', 31, 9, 10.1, 11.4, 12.9, 14.7, 16.8, 19.3),
	(95, 'Perempuan', 32, 9.1, 10.3, 11.6, 13.1, 14.9, 17.1, 19.6),
	(96, 'Perempuan', 33, 9.3, 10.4, 11.7, 13.3, 15.1, 17.3, 20),
	(97, 'Perempuan', 34, 9.4, 10.5, 11.9, 13.5, 15.4, 17.6, 20.3),
	(98, 'Perempuan', 35, 9.5, 10.7, 12, 13.7, 15.6, 17.9, 20.6);
/*!40000 ALTER TABLE `standart_bb_u` ENABLE KEYS */;

-- Dumping structure for table simekia.standart_imt_u
DROP TABLE IF EXISTS `standart_imt_u`;
CREATE TABLE IF NOT EXISTS `standart_imt_u` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jk` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `umur_bulan` int(11) NOT NULL DEFAULT 0,
  `min_3_sd` float NOT NULL DEFAULT 0,
  `min_2_sd` float NOT NULL DEFAULT 0,
  `min_1_sd` float NOT NULL DEFAULT 0,
  `median` float NOT NULL DEFAULT 0,
  `plus_1_sd` float NOT NULL DEFAULT 0,
  `plus_2_sd` float NOT NULL DEFAULT 0,
  `plus_3_sd` float NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table simekia.standart_imt_u: ~0 rows (approximately)
DELETE FROM `standart_imt_u`;
/*!40000 ALTER TABLE `standart_imt_u` DISABLE KEYS */;
/*!40000 ALTER TABLE `standart_imt_u` ENABLE KEYS */;

-- Dumping structure for table simekia.standart_pb_u
DROP TABLE IF EXISTS `standart_pb_u`;
CREATE TABLE IF NOT EXISTS `standart_pb_u` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jk` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `umur_bulan` int(11) NOT NULL DEFAULT 0,
  `min_3_sd` float NOT NULL DEFAULT 0,
  `min_2_sd` float NOT NULL DEFAULT 0,
  `min_1_sd` float NOT NULL DEFAULT 0,
  `median` float NOT NULL DEFAULT 0,
  `plus_1_sd` float NOT NULL DEFAULT 0,
  `plus_2_sd` float NOT NULL DEFAULT 0,
  `plus_3_sd` float NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Dumping data for table simekia.standart_pb_u: ~25 rows (approximately)
DELETE FROM `standart_pb_u`;
/*!40000 ALTER TABLE `standart_pb_u` DISABLE KEYS */;
INSERT INTO `standart_pb_u` (`id`, `jk`, `umur_bulan`, `min_3_sd`, `min_2_sd`, `min_1_sd`, `median`, `plus_1_sd`, `plus_2_sd`, `plus_3_sd`) VALUES
	(1, 'Laki-laki', 0, 44.2, 46.1, 48, 49.9, 51.8, 53.7, 55.6),
	(2, 'Laki-laki', 1, 48.9, 50.8, 52.8, 54.7, 56.7, 58.6, 60.6),
	(3, 'Laki-laki', 2, 52.4, 54.4, 56.4, 58.4, 60.4, 62.4, 64.4),
	(4, 'Laki-laki', 3, 55.3, 57.3, 59.4, 61.4, 63.5, 65.5, 67.6),
	(5, 'Laki-laki', 4, 57.6, 59.7, 61.8, 63.9, 66, 68, 70.1),
	(6, 'Laki-laki', 5, 59.6, 61.7, 63.8, 65.9, 68, 70.1, 72.2),
	(7, 'Laki-laki', 6, 61.2, 63.3, 65.5, 67.6, 69.8, 71.9, 74),
	(8, 'Laki-laki', 7, 62.7, 64.8, 67, 69.2, 71.3, 73.5, 75.7),
	(9, 'Laki-laki', 8, 64, 66.2, 68.4, 70.6, 72.8, 75, 77.2),
	(10, 'Laki-laki', 9, 65.2, 67.5, 69.7, 72, 74.2, 76.5, 78.7),
	(11, 'Laki-laki', 10, 66.4, 68.7, 71, 73.3, 75.6, 77.9, 80.1),
	(12, 'Laki-laki', 11, 67.6, 69.9, 72.2, 74.5, 76.9, 79.2, 81.5),
	(13, 'Laki-laki', 12, 68.6, 71, 73.4, 75.7, 78.1, 80.5, 82.9),
	(14, 'Laki-laki', 13, 69.6, 72.1, 74.5, 76.9, 79.3, 81.8, 84.2),
	(15, 'Laki-laki', 14, 70.6, 73.1, 75.6, 78, 80.5, 83, 85.5),
	(16, 'Laki-laki', 15, 71.6, 74.1, 76.6, 79.1, 81.7, 84.2, 86.7),
	(17, 'Laki-laki', 16, 72.5, 75, 77.6, 80.2, 82.8, 85.4, 88),
	(18, 'Laki-laki', 17, 73.3, 76, 78.6, 81.2, 83.9, 86.5, 89.2),
	(19, 'Laki-laki', 18, 74.2, 76.9, 79.6, 82.3, 85, 87.7, 90.4),
	(20, 'Laki-laki', 19, 75, 77.7, 80.5, 83.2, 86, 88.8, 91.5),
	(21, 'Laki-laki', 20, 75.8, 78.6, 81.4, 84.2, 87, 89.8, 92.6),
	(22, 'Laki-laki', 21, 76.5, 79.4, 82.3, 85.1, 88, 90.9, 93.8),
	(23, 'Laki-laki', 22, 77.2, 80.2, 83.1, 86, 89, 91.9, 94.9),
	(24, 'Laki-laki', 23, 78, 81, 83.9, 86.9, 89.9, 92.9, 95.9),
	(25, 'Laki-laki', 24, 78.7, 81.7, 84.8, 87.8, 90.9, 93.9, 97);
/*!40000 ALTER TABLE `standart_pb_u` ENABLE KEYS */;

-- Dumping structure for table simekia.standart_tb_u
DROP TABLE IF EXISTS `standart_tb_u`;
CREATE TABLE IF NOT EXISTS `standart_tb_u` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jk` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `umur_bulan` int(11) NOT NULL DEFAULT 0,
  `min_3_sd` float NOT NULL DEFAULT 0,
  `min_2_sd` float NOT NULL DEFAULT 0,
  `min_1_sd` float NOT NULL DEFAULT 0,
  `median` float NOT NULL DEFAULT 0,
  `plus_1_sd` float NOT NULL DEFAULT 0,
  `plus_2_sd` float NOT NULL DEFAULT 0,
  `plus_3_sd` float NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table simekia.standart_tb_u: ~0 rows (approximately)
DELETE FROM `standart_tb_u`;
/*!40000 ALTER TABLE `standart_tb_u` DISABLE KEYS */;
INSERT INTO `standart_tb_u` (`id`, `jk`, `umur_bulan`, `min_3_sd`, `min_2_sd`, `min_1_sd`, `median`, `plus_1_sd`, `plus_2_sd`, `plus_3_sd`) VALUES
	(1, 'Perempuan', 1, 0, 0, 0, 0, 0, 0, 0);
/*!40000 ALTER TABLE `standart_tb_u` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
