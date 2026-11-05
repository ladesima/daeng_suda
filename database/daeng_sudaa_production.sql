-- =====================================================================
-- DAENG SUDA - PRODUCTION DATABASE DUMP
-- Compatible with MySQL 5.7+, MariaDB 10.3+, cPanel, VPS, phpMyAdmin
-- =====================================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
SET FOREIGN_KEY_CHECKS = 0;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `body` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `slug`, `body`, `is_active`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Penerimaan pegawai', 'penerimaan-pegawai', 'penerimaan pegawai akan dibuka di bulan Desember', 1, '2025-10-15 14:01:00', '2025-10-11 06:01:35', '2025-10-11 06:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `assistance_requests`
--

DROP TABLE IF EXISTS `assistance_requests`;
CREATE TABLE `assistance_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tracking_code` varchar(255) DEFAULT NULL,
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `hp` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `desa` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `jenis` varchar(255) NOT NULL,
  `urgency` varchar(255) NOT NULL,
  `lat` decimal(10,6) DEFAULT NULL,
  `lng` decimal(10,6) DEFAULT NULL,
  `uraian` text NOT NULL,
  `lampiran` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`lampiran`)),
  `status` varchar(255) NOT NULL DEFAULT 'baru',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assistance_requests`
--

INSERT INTO `assistance_requests` (`id`, `tracking_code`, `kode`, `nama`, `hp`, `email`, `kecamatan`, `desa`, `alamat`, `jenis`, `urgency`, `lat`, `lng`, `uraian`, `lampiran`, `status`, `created_at`, `updated_at`) VALUES
(8, NULL, 'XVCYO7KB', 'M NASRUM ISRHOFIL', '085337777045', 'nasisrafil921@gmail.com', 'Bontoramba', 'Kareloe', 'Kareloe', 'Peningkatan Jalan Usaha Tani', 'Kritis', NULL, NULL, 'membutuhkan biaya / modal untuk meningkatkan jalan usaha tani', NULL, 'baru', '2026-02-22 04:30:45', '2026-02-22 04:30:45'),
(9, NULL, 'SP07F7MH', 'M NASRUM ISRHOFIL', '085337777045', 'nasisrafil921@gmail.com', 'Bontoramba', 'Kareloe', 'Kareloe', 'Peningkatan Jalan Usaha Tani', 'Kritis', NULL, NULL, 'membutuhkan biaya / modal untuk meningkatkan jalan usaha tani', NULL, 'baru', '2026-02-22 04:30:45', '2026-02-22 04:30:45');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-home.ann.top3', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;O:23:\"App\\Models\\Announcement\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"announcements\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:1;s:5:\"title\";s:18:\"Penerimaan pegawai\";s:4:\"slug\";s:18:\"penerimaan-pegawai\";s:4:\"body\";s:48:\"penerimaan pegawai akan dibuka di bulan Desember\";s:9:\"is_active\";i:1;s:12:\"published_at\";s:19:\"2025-10-15 22:01:00\";s:10:\"created_at\";s:19:\"2025-10-11 14:01:35\";s:10:\"updated_at\";s:19:\"2025-10-11 14:01:35\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:1;s:5:\"title\";s:18:\"Penerimaan pegawai\";s:4:\"slug\";s:18:\"penerimaan-pegawai\";s:4:\"body\";s:48:\"penerimaan pegawai akan dibuka di bulan Desember\";s:9:\"is_active\";i:1;s:12:\"published_at\";s:19:\"2025-10-15 22:01:00\";s:10:\"created_at\";s:19:\"2025-10-11 14:01:35\";s:10:\"updated_at\";s:19:\"2025-10-11 14:01:35\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:12:\"published_at\";s:8:\"datetime\";s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:4:\"slug\";i:2;s:4:\"body\";i:3;s:12:\"published_at\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1792243405),
('laravel-cache-home.metrics', 'O:17:\"App\\Models\\Metric\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"metrics\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:2:\"id\";i:1;s:9:\"districts\";i:11;s:8:\"villages\";i:113;s:7:\"sectors\";i:8;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-09-25 09:43:15\";}s:11:\"\0*\0original\";a:6:{s:2:\"id\";i:1;s:9:\"districts\";i:11;s:8:\"villages\";i:113;s:7:\"sectors\";i:8;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-09-25 09:43:15\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:9:\"districts\";i:1;s:8:\"villages\";i:2;s:7:\"sectors\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1792243405),
('laravel-cache-home.news.top3', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:3:{i:0;O:15:\"App\\Models\\News\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"news\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:1;s:5:\"title\";s:26:\"Program Rehabilitasi Lahan\";s:7:\"excerpt\";s:44:\"Peningkatan produktivitas sawah di Bangkala.\";s:4:\"body\";s:3:\"hai\";s:8:\"category\";s:9:\"Pertanian\";s:12:\"published_at\";s:19:\"2025-09-08 09:43:00\";s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-09-29 12:19:22\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:1;s:5:\"title\";s:26:\"Program Rehabilitasi Lahan\";s:7:\"excerpt\";s:44:\"Peningkatan produktivitas sawah di Bangkala.\";s:4:\"body\";s:3:\"hai\";s:8:\"category\";s:9:\"Pertanian\";s:12:\"published_at\";s:19:\"2025-09-08 09:43:00\";s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-09-29 12:19:22\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:12:\"published_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:7:\"excerpt\";i:2;s:4:\"body\";i:3;s:8:\"category\";i:4;s:12:\"published_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:15:\"App\\Models\\News\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"news\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:2;s:5:\"title\";s:27:\"Potensi Energi Surya 1.2 GW\";s:7:\"excerpt\";s:35:\"Mendukung energi terbarukan daerah.\";s:4:\"body\";s:450:\"Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. \";s:8:\"category\";s:6:\"Energi\";s:12:\"published_at\";s:19:\"2025-08-30 09:43:15\";s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-09-25 09:43:15\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:2;s:5:\"title\";s:27:\"Potensi Energi Surya 1.2 GW\";s:7:\"excerpt\";s:35:\"Mendukung energi terbarukan daerah.\";s:4:\"body\";s:450:\"Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. \";s:8:\"category\";s:6:\"Energi\";s:12:\"published_at\";s:19:\"2025-08-30 09:43:15\";s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-09-25 09:43:15\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:12:\"published_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:7:\"excerpt\";i:2;s:4:\"body\";i:3;s:8:\"category\";i:4;s:12:\"published_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:15:\"App\\Models\\News\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"news\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:3;s:5:\"title\";s:24:\"Festival Hasil Laut 2024\";s:7:\"excerpt\";s:37:\"Promosi hasil laut dan produk olahan.\";s:4:\"body\";s:450:\"Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. \";s:8:\"category\";s:9:\"Perikanan\";s:12:\"published_at\";s:19:\"2025-08-29 09:43:15\";s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-09-25 09:43:15\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:3;s:5:\"title\";s:24:\"Festival Hasil Laut 2024\";s:7:\"excerpt\";s:37:\"Promosi hasil laut dan produk olahan.\";s:4:\"body\";s:450:\"Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. \";s:8:\"category\";s:9:\"Perikanan\";s:12:\"published_at\";s:19:\"2025-08-29 09:43:15\";s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-09-25 09:43:15\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:12:\"published_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:7:\"excerpt\";i:2;s:4:\"body\";i:3;s:8:\"category\";i:4;s:12:\"published_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1792243405),
('laravel-cache-home.sectors.count', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:6:{i:0;O:17:\"App\\Models\\Sector\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"sectors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:1;s:4:\"name\";s:9:\"Pertanian\";s:4:\"slug\";s:9:\"pertanian\";s:4:\"icon\";s:8:\"ph:wheat\";s:7:\"summary\";s:37:\"Lahan sawah, jagung, komoditas pangan\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:122;}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:1;s:4:\"name\";s:9:\"Pertanian\";s:4:\"slug\";s:9:\"pertanian\";s:4:\"icon\";s:8:\"ph:wheat\";s:7:\"summary\";s:37:\"Lahan sawah, jagung, komoditas pangan\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:122;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:13:\"display_order\";s:7:\"integer\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:4:\"icon\";i:3;s:7:\"summary\";i:4;s:13:\"display_order\";i:5;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:17:\"App\\Models\\Sector\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"sectors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:2;s:4:\"name\";s:10:\"Perkebunan\";s:4:\"slug\";s:10:\"perkebunan\";s:4:\"icon\";s:7:\"ph:leaf\";s:7:\"summary\";s:37:\"Kelapa, kakao, dan tanaman perkebunan\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:8;}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:2;s:4:\"name\";s:10:\"Perkebunan\";s:4:\"slug\";s:10:\"perkebunan\";s:4:\"icon\";s:7:\"ph:leaf\";s:7:\"summary\";s:37:\"Kelapa, kakao, dan tanaman perkebunan\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:8;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:13:\"display_order\";s:7:\"integer\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:4:\"icon\";i:3;s:7:\"summary\";i:4;s:13:\"display_order\";i:5;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:17:\"App\\Models\\Sector\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"sectors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:3;s:4:\"name\";s:9:\"Perikanan\";s:4:\"slug\";s:9:\"perikanan\";s:4:\"icon\";s:7:\"ph:fish\";s:7:\"summary\";s:20:\"Budidaya dan tangkap\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:3;}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:3;s:4:\"name\";s:9:\"Perikanan\";s:4:\"slug\";s:9:\"perikanan\";s:4:\"icon\";s:7:\"ph:fish\";s:7:\"summary\";s:20:\"Budidaya dan tangkap\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:3;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:13:\"display_order\";s:7:\"integer\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:4:\"icon\";i:3;s:7:\"summary\";i:4;s:13:\"display_order\";i:5;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:17:\"App\\Models\\Sector\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"sectors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:4;s:4:\"name\";s:6:\"Energi\";s:4:\"slug\";s:6:\"energi\";s:4:\"icon\";s:12:\"ph:lightning\";s:7:\"summary\";s:32:\"Energi terbarukan & konvensional\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:6;}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:4;s:4:\"name\";s:6:\"Energi\";s:4:\"slug\";s:6:\"energi\";s:4:\"icon\";s:12:\"ph:lightning\";s:7:\"summary\";s:32:\"Energi terbarukan & konvensional\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:6;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:13:\"display_order\";s:7:\"integer\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:4:\"icon\";i:3;s:7:\"summary\";i:4;s:13:\"display_order\";i:5;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:17:\"App\\Models\\Sector\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"sectors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:5;s:4:\"name\";s:9:\"Kehutanan\";s:4:\"slug\";s:9:\"kehutanan\";s:4:\"icon\";s:7:\"ph:tree\";s:7:\"summary\";s:26:\"Hutan lindung dan produksi\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:1;}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:5;s:4:\"name\";s:9:\"Kehutanan\";s:4:\"slug\";s:9:\"kehutanan\";s:4:\"icon\";s:7:\"ph:tree\";s:7:\"summary\";s:26:\"Hutan lindung dan produksi\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:1;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:13:\"display_order\";s:7:\"integer\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:4:\"icon\";i:3;s:7:\"summary\";i:4;s:13:\"display_order\";i:5;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:5;O:17:\"App\\Models\\Sector\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"sectors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:6;s:4:\"name\";s:12:\"Pertambangan\";s:4:\"slug\";s:12:\"pertambangan\";s:4:\"icon\";s:10:\"ph:pickaxe\";s:7:\"summary\";s:25:\"Galian C dan mineral lain\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:2;}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:6;s:4:\"name\";s:12:\"Pertambangan\";s:4:\"slug\";s:12:\"pertambangan\";s:4:\"icon\";s:10:\"ph:pickaxe\";s:7:\"summary\";s:25:\"Galian C dan mineral lain\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:2;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:13:\"display_order\";s:7:\"integer\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:4:\"icon\";i:3;s:7:\"summary\";i:4;s:13:\"display_order\";i:5;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1792243261),
('laravel-cache-home.sliders', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:3:{i:0;O:17:\"App\\Models\\Slider\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"sliders\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:6;s:5:\"title\";s:6:\"wisata\";s:8:\"subtitle\";s:3:\"www\";s:5:\"image\";s:52:\"sliders/SRHxOVx42C69A6C1s0wPPitYw0qBJfhZwlh8tQnD.jpg\";s:5:\"order\";i:2;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-11-19 03:48:37\";s:10:\"updated_at\";s:19:\"2025-11-19 03:48:37\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:6;s:5:\"title\";s:6:\"wisata\";s:8:\"subtitle\";s:3:\"www\";s:5:\"image\";s:52:\"sliders/SRHxOVx42C69A6C1s0wPPitYw0qBJfhZwlh8tQnD.jpg\";s:5:\"order\";i:2;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-11-19 03:48:37\";s:10:\"updated_at\";s:19:\"2025-11-19 03:48:37\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:8:\"subtitle\";i:2;s:5:\"image\";i:3;s:5:\"order\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:17:\"App\\Models\\Slider\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"sliders\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:3;s:5:\"title\";s:4:\"baru\";s:8:\"subtitle\";s:1:\"a\";s:5:\"image\";s:52:\"sliders/kUEPE5BBshTrtF6rvaKPziFn2vKmTk79USk4tJ01.jpg\";s:5:\"order\";i:3;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-11-18 05:16:21\";s:10:\"updated_at\";s:19:\"2025-11-19 02:14:21\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:3;s:5:\"title\";s:4:\"baru\";s:8:\"subtitle\";s:1:\"a\";s:5:\"image\";s:52:\"sliders/kUEPE5BBshTrtF6rvaKPziFn2vKmTk79USk4tJ01.jpg\";s:5:\"order\";i:3;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-11-18 05:16:21\";s:10:\"updated_at\";s:19:\"2025-11-19 02:14:21\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:8:\"subtitle\";i:2;s:5:\"image\";i:3;s:5:\"order\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:17:\"App\\Models\\Slider\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"sliders\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:4;s:5:\"title\";s:3:\"bbb\";s:8:\"subtitle\";s:2:\"bb\";s:5:\"image\";s:52:\"sliders/iXZraaFYqICvz45KXDUD88hGsjZCjeXIh0udmc8M.jpg\";s:5:\"order\";i:4;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-11-19 02:14:46\";s:10:\"updated_at\";s:19:\"2025-11-19 02:14:55\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:4;s:5:\"title\";s:3:\"bbb\";s:8:\"subtitle\";s:2:\"bb\";s:5:\"image\";s:52:\"sliders/iXZraaFYqICvz45KXDUD88hGsjZCjeXIh0udmc8M.jpg\";s:5:\"order\";i:4;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-11-19 02:14:46\";s:10:\"updated_at\";s:19:\"2025-11-19 02:14:55\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:8:\"subtitle\";i:2;s:5:\"image\";i:3;s:5:\"order\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1792243405),
('laravel-cache-home.totals_sda', 'a:6:{s:9:\"pertanian\";O:18:\"App\\Models\\Village\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"villages\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:4:{s:13:\"luas_sawah_ha\";s:8:\"56202.20\";s:14:\"luas_jagung_ha\";s:8:\"18989.86\";s:20:\"lahan_tadah_hujan_ha\";s:8:\"35493.02\";s:12:\"produksi_ton\";s:4:\"0.00\";}s:11:\"\0*\0original\";a:4:{s:13:\"luas_sawah_ha\";s:8:\"56202.20\";s:14:\"luas_jagung_ha\";s:8:\"18989.86\";s:20:\"lahan_tadah_hujan_ha\";s:8:\"35493.02\";s:12:\"produksi_ton\";s:4:\"0.00\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:11:{s:15:\"luas_wilayah_ha\";s:9:\"decimal:2\";s:15:\"jumlah_penduduk\";s:7:\"integer\";s:9:\"pertanian\";s:5:\"array\";s:10:\"perkebunan\";s:5:\"array\";s:9:\"perikanan\";s:5:\"array\";s:10:\"peternakan\";s:5:\"array\";s:6:\"energi\";s:5:\"array\";s:12:\"pertambangan\";s:5:\"array\";s:9:\"kehutanan\";s:5:\"array\";s:16:\"lingkungan_hidup\";s:5:\"array\";s:14:\"data_pendukung\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:9:\"sector_id\";i:1;s:4:\"nama\";i:2;s:9:\"kecamatan\";i:3;s:11:\"kepala_desa\";i:4;s:13:\"kontak_person\";i:5;s:15:\"luas_wilayah_ha\";i:6;s:15:\"jumlah_penduduk\";i:7;s:13:\"kelompok_umkm\";i:8;s:9:\"pertanian\";i:9;s:10:\"perkebunan\";i:10;s:9:\"perikanan\";i:11;s:10:\"peternakan\";i:12;s:6:\"energi\";i:13;s:12:\"pertambangan\";i:14;s:16:\"lingkungan_hidup\";i:15;s:14:\"data_pendukung\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:10:\"perkebunan\";O:18:\"App\\Models\\Village\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"villages\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:7:\"luas_ha\";s:4:\"0.00\";s:16:\"produksi_tahunan\";s:4:\"0.00\";}s:11:\"\0*\0original\";a:2:{s:7:\"luas_ha\";s:4:\"0.00\";s:16:\"produksi_tahunan\";s:4:\"0.00\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:11:{s:15:\"luas_wilayah_ha\";s:9:\"decimal:2\";s:15:\"jumlah_penduduk\";s:7:\"integer\";s:9:\"pertanian\";s:5:\"array\";s:10:\"perkebunan\";s:5:\"array\";s:9:\"perikanan\";s:5:\"array\";s:10:\"peternakan\";s:5:\"array\";s:6:\"energi\";s:5:\"array\";s:12:\"pertambangan\";s:5:\"array\";s:9:\"kehutanan\";s:5:\"array\";s:16:\"lingkungan_hidup\";s:5:\"array\";s:14:\"data_pendukung\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:9:\"sector_id\";i:1;s:4:\"nama\";i:2;s:9:\"kecamatan\";i:3;s:11:\"kepala_desa\";i:4;s:13:\"kontak_person\";i:5;s:15:\"luas_wilayah_ha\";i:6;s:15:\"jumlah_penduduk\";i:7;s:13:\"kelompok_umkm\";i:8;s:9:\"pertanian\";i:9;s:10:\"perkebunan\";i:10;s:9:\"perikanan\";i:11;s:10:\"peternakan\";i:12;s:6:\"energi\";i:13;s:12:\"pertambangan\";i:14;s:16:\"lingkungan_hidup\";i:15;s:14:\"data_pendukung\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:9:\"perikanan\";O:18:\"App\\Models\\Village\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"villages\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:14:\"luas_tambak_ha\";s:4:\"0.00\";s:12:\"produksi_ton\";s:4:\"0.00\";}s:11:\"\0*\0original\";a:2:{s:14:\"luas_tambak_ha\";s:4:\"0.00\";s:12:\"produksi_ton\";s:4:\"0.00\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:11:{s:15:\"luas_wilayah_ha\";s:9:\"decimal:2\";s:15:\"jumlah_penduduk\";s:7:\"integer\";s:9:\"pertanian\";s:5:\"array\";s:10:\"perkebunan\";s:5:\"array\";s:9:\"perikanan\";s:5:\"array\";s:10:\"peternakan\";s:5:\"array\";s:6:\"energi\";s:5:\"array\";s:12:\"pertambangan\";s:5:\"array\";s:9:\"kehutanan\";s:5:\"array\";s:16:\"lingkungan_hidup\";s:5:\"array\";s:14:\"data_pendukung\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:9:\"sector_id\";i:1;s:4:\"nama\";i:2;s:9:\"kecamatan\";i:3;s:11:\"kepala_desa\";i:4;s:13:\"kontak_person\";i:5;s:15:\"luas_wilayah_ha\";i:6;s:15:\"jumlah_penduduk\";i:7;s:13:\"kelompok_umkm\";i:8;s:9:\"pertanian\";i:9;s:10:\"perkebunan\";i:10;s:9:\"perikanan\";i:11;s:10:\"peternakan\";i:12;s:6:\"energi\";i:13;s:12:\"pertambangan\";i:14;s:16:\"lingkungan_hidup\";i:15;s:14:\"data_pendukung\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:6:\"energi\";O:18:\"App\\Models\\Village\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"villages\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:9:\"surya_kwp\";s:5:\"10.00\";s:9:\"angin_kwp\";s:4:\"0.00\";s:14:\"mikrohidro_kwp\";s:4:\"0.00\";}s:11:\"\0*\0original\";a:3:{s:9:\"surya_kwp\";s:5:\"10.00\";s:9:\"angin_kwp\";s:4:\"0.00\";s:14:\"mikrohidro_kwp\";s:4:\"0.00\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:11:{s:15:\"luas_wilayah_ha\";s:9:\"decimal:2\";s:15:\"jumlah_penduduk\";s:7:\"integer\";s:9:\"pertanian\";s:5:\"array\";s:10:\"perkebunan\";s:5:\"array\";s:9:\"perikanan\";s:5:\"array\";s:10:\"peternakan\";s:5:\"array\";s:6:\"energi\";s:5:\"array\";s:12:\"pertambangan\";s:5:\"array\";s:9:\"kehutanan\";s:5:\"array\";s:16:\"lingkungan_hidup\";s:5:\"array\";s:14:\"data_pendukung\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:9:\"sector_id\";i:1;s:4:\"nama\";i:2;s:9:\"kecamatan\";i:3;s:11:\"kepala_desa\";i:4;s:13:\"kontak_person\";i:5;s:15:\"luas_wilayah_ha\";i:6;s:15:\"jumlah_penduduk\";i:7;s:13:\"kelompok_umkm\";i:8;s:9:\"pertanian\";i:9;s:10:\"perkebunan\";i:10;s:9:\"perikanan\";i:11;s:10:\"peternakan\";i:12;s:6:\"energi\";i:13;s:12:\"pertambangan\";i:14;s:16:\"lingkungan_hidup\";i:15;s:14:\"data_pendukung\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:12:\"pertambangan\";O:18:\"App\\Models\\Village\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"villages\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:1:{s:7:\"luas_ha\";s:4:\"0.00\";}s:11:\"\0*\0original\";a:1:{s:7:\"luas_ha\";s:4:\"0.00\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:11:{s:15:\"luas_wilayah_ha\";s:9:\"decimal:2\";s:15:\"jumlah_penduduk\";s:7:\"integer\";s:9:\"pertanian\";s:5:\"array\";s:10:\"perkebunan\";s:5:\"array\";s:9:\"perikanan\";s:5:\"array\";s:10:\"peternakan\";s:5:\"array\";s:6:\"energi\";s:5:\"array\";s:12:\"pertambangan\";s:5:\"array\";s:9:\"kehutanan\";s:5:\"array\";s:16:\"lingkungan_hidup\";s:5:\"array\";s:14:\"data_pendukung\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:9:\"sector_id\";i:1;s:4:\"nama\";i:2;s:9:\"kecamatan\";i:3;s:11:\"kepala_desa\";i:4;s:13:\"kontak_person\";i:5;s:15:\"luas_wilayah_ha\";i:6;s:15:\"jumlah_penduduk\";i:7;s:13:\"kelompok_umkm\";i:8;s:9:\"pertanian\";i:9;s:10:\"perkebunan\";i:10;s:9:\"perikanan\";i:11;s:10:\"peternakan\";i:12;s:6:\"energi\";i:13;s:12:\"pertambangan\";i:14;s:16:\"lingkungan_hidup\";i:15;s:14:\"data_pendukung\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:9:\"kehutanan\";O:18:\"App\\Models\\Village\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"villages\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:13:\"luas_hutan_ha\";s:4:\"0.00\";s:16:\"luas_mangrove_ha\";s:4:\"0.00\";s:13:\"konservasi_ha\";s:4:\"0.00\";}s:11:\"\0*\0original\";a:3:{s:13:\"luas_hutan_ha\";s:4:\"0.00\";s:16:\"luas_mangrove_ha\";s:4:\"0.00\";s:13:\"konservasi_ha\";s:4:\"0.00\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:11:{s:15:\"luas_wilayah_ha\";s:9:\"decimal:2\";s:15:\"jumlah_penduduk\";s:7:\"integer\";s:9:\"pertanian\";s:5:\"array\";s:10:\"perkebunan\";s:5:\"array\";s:9:\"perikanan\";s:5:\"array\";s:10:\"peternakan\";s:5:\"array\";s:6:\"energi\";s:5:\"array\";s:12:\"pertambangan\";s:5:\"array\";s:9:\"kehutanan\";s:5:\"array\";s:16:\"lingkungan_hidup\";s:5:\"array\";s:14:\"data_pendukung\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:9:\"sector_id\";i:1;s:4:\"nama\";i:2;s:9:\"kecamatan\";i:3;s:11:\"kepala_desa\";i:4;s:13:\"kontak_person\";i:5;s:15:\"luas_wilayah_ha\";i:6;s:15:\"jumlah_penduduk\";i:7;s:13:\"kelompok_umkm\";i:8;s:9:\"pertanian\";i:9;s:10:\"perkebunan\";i:10;s:9:\"perikanan\";i:11;s:10:\"peternakan\";i:12;s:6:\"energi\";i:13;s:12:\"pertambangan\";i:14;s:16:\"lingkungan_hidup\";i:15;s:14:\"data_pendukung\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}', 1792243261),
('laravel-cache-sda@jenepontokab.go.id|127.0.0.1', 'i:2;', 1792236300),
('laravel-cache-sda@jenepontokab.go.id|127.0.0.1:timer', 'i:1792236300;', 1792236300);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dinas_sectors`
--

DROP TABLE IF EXISTS `dinas_sectors`;
CREATE TABLE `dinas_sectors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(120) NOT NULL,
  `slug` varchar(140) NOT NULL,
  `group_key` varchar(255) DEFAULT NULL,
  `icon` varchar(120) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `form_schema` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`form_schema`)),
  `display_order` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dinas_sectors`
--

INSERT INTO `dinas_sectors` (`id`, `nama`, `slug`, `group_key`, `icon`, `summary`, `form_schema`, `display_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Dinas PUPR', 'dinas-pupr', 'inti_sda', '🏗️', 'Irigasi, bendungan, embung, tata ruang.', '[{\"key\":\"jml_irigasi\",\"label\":\"Jumlah jaringan irigasi (unit)\",\"type\":\"number\"},{\"key\":\"panjang_irigasi_km\",\"label\":\"Panjang jaringan irigasi (km)\",\"type\":\"number\",\"step\":\"0.01\"},{\"key\":\"jml_bendungan\",\"label\":\"Jumlah bendungan\\/embung (unit)\",\"type\":\"number\"},{\"key\":\"rencana_tataruang\",\"label\":\"Status rencana tata ruang\",\"type\":\"select\",\"options\":[\"Ada & berlaku\",\"Dalam revisi\",\"Belum ada\"]}]', 1, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(2, 'DLH', 'dlh', 'inti_sda', '🌿', 'Kualitas air, udara, pengelolaan sampah.', '[{\"key\":\"lokasi_sungai\",\"label\":\"Lokasi sungai\\/danau\",\"type\":\"text\"},{\"key\":\"indeks_kualitas_air\",\"label\":\"Indeks kualitas air\",\"type\":\"number\",\"step\":\"0.01\"},{\"key\":\"indeks_kualitas_udara\",\"label\":\"Indeks kualitas udara (ISPU)\",\"type\":\"number\",\"step\":\"0.01\"},{\"key\":\"sampah_terkelola_ton\",\"label\":\"Sampah terkelola (ton\\/hari)\",\"type\":\"number\",\"step\":\"0.01\"}]', 2, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(3, 'Dinas Kehutanan', 'dinas-kehutanan', 'inti_sda', '🌲', 'Kawasan hutan, konservasi, illegal logging.', '[{\"key\":\"luas_hutan_ha\",\"label\":\"Luas kawasan hutan (Ha)\",\"type\":\"number\",\"step\":\"0.01\"},{\"key\":\"luas_konservasi_ha\",\"label\":\"Luas kawasan konservasi (Ha)\",\"type\":\"number\",\"step\":\"0.01\"},{\"key\":\"kasus_illegal_logging\",\"label\":\"Kasus illegal logging (thn)\",\"type\":\"number\"}]', 3, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(4, 'DKP', 'dkp', 'inti_sda', '🐟', 'Perikanan: hasil tangkap/budidaya, kualitas air pesisir.', '[{\"key\":\"produksi_tangkap_ton\",\"label\":\"Produksi perikanan tangkap (ton\\/th)\",\"type\":\"number\",\"step\":\"0.01\"},{\"key\":\"produksi_budidaya_ton\",\"label\":\"Produksi budidaya (ton\\/th)\",\"type\":\"number\",\"step\":\"0.01\"},{\"key\":\"kualitas_air_pesisir\",\"label\":\"Kualitas air pesisir\",\"type\":\"select\",\"options\":[\"Baik\",\"Sedang\",\"Buruk\"]}]', 4, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(5, 'Dinas Pertanian', 'dinas-pertanian', 'inti_sda', '🌾', 'Luas lahan, panen/gagal panen, kekeringan.', '[{\"key\":\"luas_tanam_padi_ha\",\"label\":\"Luas tanam padi (Ha)\",\"type\":\"number\",\"step\":\"0.01\"},{\"key\":\"produksi_padi_ton\",\"label\":\"Produksi padi (ton)\",\"type\":\"number\",\"step\":\"0.01\"},{\"key\":\"kejadian_gagal_panen\",\"label\":\"Kejadian gagal panen (kasus)\",\"type\":\"number\"},{\"key\":\"desa_terdampak_kekeringan\",\"label\":\"Desa terdampak kekeringan (desa)\",\"type\":\"number\"}]', 5, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(6, 'PDAM (BUMD)', 'pdam-bumd', 'inti_sda', '🚰', 'Lokasi & volume pengambilan air baku, kualitas.', '[{\"key\":\"sumber_air_baku\",\"label\":\"Sumber air baku\",\"type\":\"text\"},{\"key\":\"debit_l_per_detik\",\"label\":\"Debit (liter\\/detik)\",\"type\":\"number\",\"step\":\"0.01\"},{\"key\":\"kualitas_air_baku\",\"label\":\"Kualitas air baku\",\"type\":\"select\",\"options\":[\"Baik\",\"Sedang\",\"Buruk\"]}]', 6, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(7, 'PERKIMTAN', 'perkimtan', 'inti_sda', '🏡', 'RTH, permukiman, data sanitasi.', '[{\"key\":\"rth_eksisting_ha\",\"label\":\"RTH eksisting (Ha)\",\"type\":\"number\",\"step\":\"0.01\"},{\"key\":\"rumah_tidak_layak_huni\",\"label\":\"Rumah tidak layak huni (unit)\",\"type\":\"number\"},{\"key\":\"akses_sanitasi_layak_persen\",\"label\":\"Akses sanitasi layak (%)\",\"type\":\"number\",\"step\":\"0.01\"}]', 7, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(8, 'Bappeda', 'bappeda', 'perencanaan', '🧭', 'RPJMD/RKPD, indikator & target SDA.', '[{\"key\":\"dok_rpjmd_rkpd\",\"label\":\"Ketersediaan dok. RPJMD\\/RKPD\",\"type\":\"select\",\"options\":[\"Lengkap\",\"Sebagian\",\"Tidak tersedia\"]},{\"key\":\"jml_indikator_sda\",\"label\":\"Jumlah indikator SDA\",\"type\":\"number\"}]', 8, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(9, 'BPKAD', 'bpkad', 'perencanaan', '💰', 'Realisasi anggaran bidang SDA dan infrastruktur SDA.', '[{\"key\":\"anggaran_sda_m\",\"label\":\"Realisasi anggaran SDA (Miliar)\",\"type\":\"number\",\"step\":\"0.01\"},{\"key\":\"anggaran_infrastruktur_m\",\"label\":\"Realisasi infrastruktur SDA (Miliar)\",\"type\":\"number\",\"step\":\"0.01\"}]', 9, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(10, 'Bapenda', 'bapenda', 'perencanaan', '🧾', 'Retribusi Jasa Usaha SDA (air), pajak tambang, PBB sektor pertanian/kehutanan.', '[{\"key\":\"retribusi_usiair_m\",\"label\":\"Realisasi retribusi jasa usaha SDA (Miliar)\",\"type\":\"number\",\"step\":\"0.01\"},{\"key\":\"pajak_tambang_m\",\"label\":\"Pajak pertambangan (Miliar)\",\"type\":\"number\",\"step\":\"0.01\"}]', 10, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(11, 'Bagian Adm Pembangunan', 'bagian-adm-pembangunan', 'perencanaan', '📊', 'Capaian kinerja fisik/keuangan program SDA.', '[{\"key\":\"capaian_fisik_persen\",\"label\":\"Capaian fisik (%)\",\"type\":\"number\",\"step\":\"0.01\"},{\"key\":\"capaian_keu_persen\",\"label\":\"Capaian keuangan (%)\",\"type\":\"number\",\"step\":\"0.01\"}]', 11, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(12, 'Bagian Perekonomian', 'bagian-perekonomian', 'perencanaan', '📈', 'Analisis ekonomi sektoral SDA, kontribusi PDRB.', '[{\"key\":\"kontribusi_pdrb_sda_persen\",\"label\":\"Kontribusi PDRB sektor SDA (%)\",\"type\":\"number\",\"step\":\"0.01\"}]', 12, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(13, 'Bagian Hukum', 'bagian-hukum', 'perencanaan', '⚖️', 'Daftar Perda/Perbup terkait SDA & tata ruang.', '[{\"key\":\"jml_perda_terkait\",\"label\":\"Jumlah Perda terkait SDA\",\"type\":\"number\"},{\"key\":\"jml_perbup_terkait\",\"label\":\"Jumlah Perbup terkait SDA\",\"type\":\"number\"}]', 13, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(14, 'Dinas Sosial', 'dinas-sosial', 'sosial_sdm', '🤝', 'Data keluarga miskin terdampak bencana/kekeringan & penyaluran bantuan.', '[{\"key\":\"kk_terdampak\",\"label\":\"KK terdampak bencana\\/kekeringan\",\"type\":\"number\"},{\"key\":\"bantuan_disalurkan\",\"label\":\"Bantuan disalurkan (paket)\",\"type\":\"number\"}]', 14, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(15, 'Disnakertrans', 'disnakertrans', 'sosial_sdm', '👷', 'Tenaga kerja sektoral SDA (pertanian, perikanan).', '[{\"key\":\"tenaga_kerja_pertanian\",\"label\":\"Tenaga kerja pertanian\",\"type\":\"number\"},{\"key\":\"tenaga_kerja_perikanan\",\"label\":\"Tenaga kerja perikanan\",\"type\":\"number\"}]', 15, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(16, 'Dukcapil', 'dukcapil', 'sosial_sdm', '🧑‍💼', 'Kependudukan berdasar profesi di sektor SDA.', '[{\"key\":\"nelayan_aktif\",\"label\":\"Jumlah nelayan aktif\",\"type\":\"number\"},{\"key\":\"petani_aktif\",\"label\":\"Jumlah petani aktif\",\"type\":\"number\"}]', 16, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(17, 'BKPSDM', 'bkpsdm', 'sosial_sdm', '🎓', 'Jumlah & kompetensi SDM teknis OPD SDA.', '[{\"key\":\"sdm_teknis\",\"label\":\"Jumlah SDM teknis OPD SDA\",\"type\":\"number\"},{\"key\":\"sdm_bersertifikat\",\"label\":\"SDM bersertifikat\",\"type\":\"number\"}]', 17, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(18, 'Satpol PP', 'satpol-pp', 'sosial_sdm', '🛡️', 'Penertiban pelanggaran Perda SDA.', '[{\"key\":\"pelanggaran_sda\",\"label\":\"Kasus pelanggaran SDA (thn)\",\"type\":\"number\"}]', 18, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(19, 'Kesbangpol', 'kesbangpol', 'sosial_sdm', '🤝', 'Potensi konflik sosial terkait SDA.', '[{\"key\":\"konflik_sda\",\"label\":\"Kasus konflik SDA (thn)\",\"type\":\"number\"}]', 19, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(20, 'Disdagperin', 'disdagperin', 'pemanfaatan', '🏭', 'Harga komoditas & industri olahan SDA.', '[{\"key\":\"harga_komoditas_utama\",\"label\":\"Harga komoditas utama (Rp\\/kg)\",\"type\":\"number\",\"step\":\"0.01\"},{\"key\":\"jml_industri_pengolahan\",\"label\":\"Jumlah industri pengolahan\",\"type\":\"number\"}]', 20, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(21, 'Perhubungan', 'perhubungan', 'pemanfaatan', '🚚', 'Aksesibilitas sektor SDA (jalan, pelabuhan).', '[{\"key\":\"kondisi_jalan_persen_baik\",\"label\":\"Kondisi jalan baik (%)\",\"type\":\"number\",\"step\":\"0.01\"},{\"key\":\"pelabuhan_aktif\",\"label\":\"Jumlah pelabuhan aktif\",\"type\":\"number\"}]', 21, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(22, 'Pariwisata', 'pariwisata', 'pemanfaatan', '🗺️', 'Destinasi wisata alam & daya dukung.', '[{\"key\":\"destinasi_wisata_alam\",\"label\":\"Jumlah destinasi wisata alam\",\"type\":\"number\"},{\"key\":\"daya_dukung_dds\",\"label\":\"Daya dukung kawasan (DDS)\",\"type\":\"number\"}]', 22, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(23, 'DPMD', 'dpmd', 'pemanfaatan', '🏘️', 'Realisasi Dana Desa untuk infrastruktur SDA skala kecil.', '[{\"key\":\"jml_embung_desa\",\"label\":\"Embung desa (unit)\",\"type\":\"number\"},{\"key\":\"irigasi_desa_unit\",\"label\":\"Irigasi tersier desa (unit)\",\"type\":\"number\"}]', 23, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(24, 'Pemerintah Kecamatan', 'pemerintah-kecamatan', 'pemanfaatan', '🏛️', 'Potensi kewilayahan & rekap masalah SDA tingkat kecamatan.', '[{\"key\":\"potensi_kec\",\"label\":\"Potensi SDA utama kecamatan\",\"type\":\"textarea\"},{\"key\":\"isu_masalah_kec\",\"label\":\"Isu\\/masalah utama\",\"type\":\"textarea\"}]', 24, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(25, 'BPBD', 'bpbd', 'lain', '🚨', 'Data bencana: lokasi, frekuensi, kerugian.', '[{\"key\":\"jenis_bencana\",\"label\":\"Jenis bencana\",\"type\":\"select\",\"options\":[\"Banjir\",\"Kekeringan\",\"Longsor\",\"Angin kencang\",\"Lainnya\"]},{\"key\":\"lokasi\",\"label\":\"Lokasi (desa\\/kec)\",\"type\":\"text\"},{\"key\":\"kejadian\",\"label\":\"Jumlah kejadian (thn)\",\"type\":\"number\"},{\"key\":\"kerugian_juta\",\"label\":\"Estimasi kerugian (juta Rp)\",\"type\":\"number\",\"step\":\"0.01\"}]', 25, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(26, 'DKP3', 'dkp3', 'lain', '🍚', 'Data cadangan & kerawanan pangan.', '[{\"key\":\"stok_pangan_ton\",\"label\":\"Stok pangan (ton)\",\"type\":\"number\",\"step\":\"0.01\"},{\"key\":\"wilayah_rawan_pangan\",\"label\":\"Wilayah rawan pangan (desa)\",\"type\":\"number\"}]', 26, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(27, 'DP3A', 'dp3a', 'lain', '👩', 'Laporan/isu kerentanan gender bencana SDA.', '[{\"key\":\"kasus_gbv_sda\",\"label\":\"Kasus terkait gender (thn)\",\"type\":\"number\"}]', 27, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(28, 'Diskominfo', 'diskominfo', 'lain', '💻', 'Integrasi sistem, kanal data, diseminasi.', '[{\"key\":\"integrasi_sistem\",\"label\":\"Status integrasi sistem\",\"type\":\"select\",\"options\":[\"Penuh\",\"Sebagian\",\"Belum\"]},{\"key\":\"portal_data\",\"label\":\"Portal data aktif (ya\\/tidak)\",\"type\":\"select\",\"options\":[\"Ya\",\"Tidak\"]}]', 28, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(29, 'Inspektorat', 'inspektorat', 'lain', '📝', 'LHP audit program/proyek SDA.', '[{\"key\":\"lhp_audit_jumlah\",\"label\":\"Jumlah LHP terkait SDA\",\"type\":\"number\"}]', 29, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(30, 'Dinas Koperasi & UMKM', 'dinas-koperasi-umkm', 'lain', '🧺', 'UMKM/Koperasi pengolahan hasil SDA.', '[{\"key\":\"umkm_pengolahan\",\"label\":\"Jumlah UMKM pengolahan\",\"type\":\"number\"},{\"key\":\"koperasi_aktif\",\"label\":\"Jumlah koperasi aktif\",\"type\":\"number\"}]', 30, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(31, 'BAPELITBANGDA', 'bapelitbangda', 'lain', '🧪', 'Hasil riset/kajian & peta inovasi SDA.', '[{\"key\":\"jml_riset\",\"label\":\"Jumlah riset\\/kajian SDA\",\"type\":\"number\"},{\"key\":\"tema_riset\",\"label\":\"Tema riset utama\",\"type\":\"textarea\"}]', 31, 1, '2025-11-02 17:43:28', '2025-11-02 17:43:28');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_reports`
--

DROP TABLE IF EXISTS `emergency_reports`;
CREATE TABLE `emergency_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tracking_code` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `hp` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `severity` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `desa` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  `lat` decimal(10,6) DEFAULT NULL,
  `lng` decimal(10,6) DEFAULT NULL,
  `uraian` text DEFAULT NULL,
  `lampiran` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`lampiran`)),
  `status` varchar(255) NOT NULL DEFAULT 'baru',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `atasan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `nama`, `jabatan`, `nip`, `foto`, `atasan_id`, `created_at`, `updated_at`) VALUES
(12, 'Muslimin. S.Tp., M.M.', 'Kepala Bagian SDA', '-', 'employees/M6Adqo3Qt42Z3aPzoYdpFYp395NMuGGHUWdZ2ZTV.jpg', NULL, '2025-11-16 19:48:45', '2026-10-17 04:32:20');

-- --------------------------------------------------------

--
-- Table structure for table `esdm_reports`
--

DROP TABLE IF EXISTS `esdm_reports`;
CREATE TABLE `esdm_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `village_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'baru',
  `lokasi` text DEFAULT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `keterangan` text DEFAULT NULL,
  `tingkat_urgensi` varchar(255) DEFAULT NULL,
  `verified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `esdm_report_attachments`
--

DROP TABLE IF EXISTS `esdm_report_attachments`;
CREATE TABLE `esdm_report_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `esdm_report_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL DEFAULT 'image',
  `original_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `esdm_report_histories`
--

DROP TABLE IF EXISTS `esdm_report_histories`;
CREATE TABLE `esdm_report_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `esdm_report_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `from_status` varchar(255) DEFAULT NULL,
  `to_status` varchar(255) NOT NULL,
  `catatan` text DEFAULT NULL,
  `instansi_koordinasi` varchar(255) DEFAULT NULL,
  `hasil_koordinasi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaders`
--

DROP TABLE IF EXISTS `leaders`;
CREATE TABLE `leaders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `visi` text DEFAULT NULL,
  `misi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaders`
--

INSERT INTO `leaders` (`id`, `nama`, `jabatan`, `foto`, `visi`, `misi`, `created_at`, `updated_at`) VALUES
(1, 'H. Paris Yasir, SE., MM.,', 'Bupati Jeneponto', 'leaders/NbP3EQaCTKWiA9k4GaFlVLRx1Xpmr6KZZ45e6fdn.jpg', 'Berkelanjutan, Tangguh, Berdayasaing, Religius, Inklusif dan Melaju.', '1. Mengakselerasi Peningkatan Kualitas Hidup Masyarakat Secara Inklusif.\r\n2. Mengakselerasi Penguatan Ekonomi Daerah Berbasis Potensi Strategik secara transformative, Inovatif, Produktif dan Berkelanjutan.\r\n3. Mengakselerasi Penguatan Kolaborasi dan Tata Kelola Pemerintahan yang Berintegritas dan Melayani.\r\n4. Meningkatkan Pembangunan Infrastruktur yang Berkualitas dan Berwawasan Lingkungan.\r\n5. Memperkuat Ketahanan Sosial Budaya dan Kualitas Lingkungan Hidup\r\n6. Meningkatkan Keamanan, Ketentraman, Ketertiban dan religiusitas Kehidupan Masyarakat.\r\n7. Meningkatkan Sinergitas Pembangunan Wilayah dan Daya saing Daerah', '2025-10-06 06:14:58', '2026-10-17 04:31:03');

-- --------------------------------------------------------

--
-- Table structure for table `metrics`
--

DROP TABLE IF EXISTS `metrics`;
CREATE TABLE `metrics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `districts` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `villages` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sectors` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metrics`
--

INSERT INTO `metrics` (`id`, `districts`, `villages`, `sectors`, `created_at`, `updated_at`) VALUES
(1, 11, 113, 8, '2025-09-25 01:43:15', '2025-09-25 01:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_01_01_000001_add_role_to_users_table', 1),
(5, '2024_01_01_000100_create_sectors_table', 1),
(6, '2024_01_01_000200_create_potentials_table', 1),
(7, '2024_01_01_000300_create_news_table', 1),
(8, '2024_01_01_000400_create_metrics_table', 1),
(9, '2025_10_02_051030_create_employees_table', 2),
(10, '2025_10_06_124032_create_leaders_table', 3),
(11, '2025_10_06_124312_create_employees_table', 3),
(12, '2025_10_07_042751_create_sliders_table', 4),
(13, '2025_10_08_012353_create_announcements_table', 5),
(14, '2025_10_08_021706_add_core_fields_to_announcements_table', 6),
(15, '2025_10_11_140456_add_sda_fields_to_potentials_table', 7),
(16, '2025_10_11_143022_tweak_sectors_table_for_catalog_fields', 7),
(17, '2025_10_11_150008_create_villages_table', 8),
(18, '2025_10_11_153626_add_order_column_to_sectors_table', 9),
(19, '2025_10_11_154528_add_kehutanan_to_villages_table', 10),
(20, '2025_10_23_002859_create_reports_table', 11),
(21, '2025_10_23_010731_create_assistance_requests_table', 12),
(22, '2025_10_23_010731_create_emergency_reports_table', 12),
(23, '2025_10_23_010813_create_emergency_reports_table', 13),
(24, '2025_10_23_011026_create_assistance_requests_table', 14),
(25, '2025_10_23_012009_create_emergency_reports_table', 15),
(26, '2025_10_23_012445_alter_assistance_requests_add_tracking_kind_urgency', 16),
(27, '2025_10_27_123241_create_dinas_sectors_table', 17),
(28, '2025_11_02_162157_add_fields_to_dinas_sectors_table', 17),
(29, '2025_11_02_170426_alter_dinas_sectors_and_create_opd_records', 17),
(30, '2025_11_02_181500_create_opd_records_table', 18),
(31, '2026_10_17_100000_add_esdm_fields_to_users_table', 19),
(32, '2026_10_17_100001_create_esdm_reports_table', 19),
(33, '2026_10_17_100002_create_esdm_report_attachments_table', 19),
(34, '2026_10_17_100003_create_esdm_report_histories_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `excerpt` varchar(255) DEFAULT NULL,
  `body` longtext NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `excerpt`, `body`, `category`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Program Rehabilitasi Lahan', 'Peningkatan produktivitas sawah di Bangkala.', 'hai', 'Pertanian', '2025-09-08 01:43:00', '2025-09-25 01:43:15', '2025-09-29 04:19:22'),
(2, 'Potensi Energi Surya 1.2 GW', 'Mendukung energi terbarukan daerah.', 'Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. ', 'Energi', '2025-08-30 01:43:15', '2025-09-25 01:43:15', '2025-09-25 01:43:15'),
(3, 'Festival Hasil Laut 2024', 'Promosi hasil laut dan produk olahan.', 'Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. ', 'Perikanan', '2025-08-29 01:43:15', '2025-09-25 01:43:15', '2025-09-25 01:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `opd_records`
--

DROP TABLE IF EXISTS `opd_records`;
CREATE TABLE `opd_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dinas_sector_id` bigint(20) UNSIGNED NOT NULL,
  `village_id` bigint(20) UNSIGNED NOT NULL,
  `periode_tahun` smallint(5) UNSIGNED DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`payload`)),
  `lampiran` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`lampiran`)),
  `status` varchar(20) NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `potentials`
--

DROP TABLE IF EXISTS `potentials`;
CREATE TABLE `potentials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `desa` varchar(255) DEFAULT NULL,
  `sector_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` decimal(14,2) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kepala_desa` varchar(255) DEFAULT NULL,
  `kontak_person` varchar(255) DEFAULT NULL,
  `luas_wilayah_ha` decimal(12,2) DEFAULT NULL,
  `jumlah_penduduk` bigint(20) UNSIGNED DEFAULT NULL,
  `kelompok_umkm` text DEFAULT NULL,
  `pertanian` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`pertanian`)),
  `perkebunan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`perkebunan`)),
  `perikanan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`perikanan`)),
  `peternakan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`peternakan`)),
  `energi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`energi`)),
  `pertambangan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`pertambangan`)),
  `lingkungan_hidup` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`lingkungan_hidup`)),
  `data_pendukung` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_pendukung`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `potentials`
--

INSERT INTO `potentials` (`id`, `desa`, `sector_id`, `name`, `value`, `unit`, `note`, `created_at`, `updated_at`, `kecamatan`, `kepala_desa`, `kontak_person`, `luas_wilayah_ha`, `jumlah_penduduk`, `kelompok_umkm`, `pertanian`, `perkebunan`, `perikanan`, `peternakan`, `energi`, `pertambangan`, `lingkungan_hidup`, `data_pendukung`) VALUES
(1, NULL, 1, 'Contoh Potensi', 1000.00, 'ha', 'Ubah di admin', '2025-09-25 01:43:15', '2025-09-25 01:43:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, 2, 'Contoh Potensi', 1000.00, 'ha', 'Ubah di admin', '2025-09-25 01:43:15', '2025-09-25 01:43:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, 3, 'Contoh Potensi', 1000.00, 'ha', 'Ubah di admin', '2025-09-25 01:43:15', '2025-09-25 01:43:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, 4, 'Contoh Potensi', 1000.00, 'ha', 'Ubah di admin', '2025-09-25 01:43:15', '2025-09-25 01:43:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, 5, 'Contoh Potensi', 1000.00, 'ha', 'Ubah di admin', '2025-09-25 01:43:15', '2025-09-25 01:43:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, NULL, 6, 'Contoh Potensi', 1000.00, 'ha', 'Ubah di admin', '2025-09-25 01:43:15', '2025-09-25 01:43:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(20) NOT NULL,
  `reporter_name` varchar(255) NOT NULL,
  `reporter_phone` varchar(30) NOT NULL,
  `reporter_email` varchar(255) DEFAULT NULL,
  `village` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `lat` decimal(10,6) DEFAULT NULL,
  `lng` decimal(10,6) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `assistance_type` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `severity` varchar(20) DEFAULT NULL,
  `urgency` varchar(20) DEFAULT NULL,
  `occurred_at` datetime DEFAULT NULL,
  `photos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photos`)),
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attachments`)),
  `tracking_code` varchar(16) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'submitted',
  `follow_up_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

DROP TABLE IF EXISTS `sectors`;
CREATE TABLE `sectors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `order` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `display_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sectors`
--

INSERT INTO `sectors` (`id`, `name`, `slug`, `icon`, `summary`, `order`, `display_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Pertanian', 'pertanian', 'ph:wheat', 'Lahan sawah, jagung, komoditas pangan', 0, 0, 1, '2025-09-25 01:43:15', '2025-10-11 06:31:07'),
(2, 'Perkebunan', 'perkebunan', 'ph:leaf', 'Kelapa, kakao, dan tanaman perkebunan', 0, 0, 1, '2025-09-25 01:43:15', '2025-10-11 06:31:07'),
(3, 'Perikanan', 'perikanan', 'ph:fish', 'Budidaya dan tangkap', 0, 0, 1, '2025-09-25 01:43:15', '2025-10-11 06:31:07'),
(4, 'Energi', 'energi', 'ph:lightning', 'Energi terbarukan & konvensional', 0, 0, 1, '2025-09-25 01:43:15', '2025-10-11 06:31:07'),
(5, 'Kehutanan', 'kehutanan', 'ph:tree', 'Hutan lindung dan produksi', 0, 0, 1, '2025-09-25 01:43:15', '2025-10-11 06:31:07'),
(6, 'Pertambangan', 'pertambangan', 'ph:pickaxe', 'Galian C dan mineral lain', 0, 0, 1, '2025-09-25 01:43:15', '2025-10-11 06:31:07');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0yBhT2lRDH37HyI391S1Zvk39IzFXfO0dTMS54oV', NULL, '127.0.0.1', 'Symfony', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibmVHUzNLT0ZRTkc4TDlpUXZRWWdXeWtrZDhEeGNoSjlkckVqSUtxQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3QvaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792241668),
('4n5cBFPmtayR95812OpDybct566F7Pyvrh7jGYQO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9711', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZVFJSW1LTGQxVzhtTVc3SnI5SkFIT0tTdzFnNWlKWGluTTVndzB1QSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792238329),
('6aZ6ycJfW5KqrCa6Q0bIWlmiLdxvvPyZ9ba9Z22x', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQUs3cThzQmxBY2N6OFhEYVhFbVo5ZDJudGZxTnZVanI2Y1BJUW9MNyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yaXdheWF0L3Blcm1vaG9uYW4tYmFudHVhbiI7fX0=', 1792237702),
('dbxsUODQKXktqMm9mC0dIBBSqslTmLE7nnZXtCmI', 6, '127.0.0.1', 'Symfony', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib1pSOXhyaUJNbmNmeWx1MXJ5RWxRM09oMG9IUlVONFVRc2d6WnlDMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3QvYWRtaW4vbGVhZGVycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjY7fQ==', 1792240179),
('gDIMWRYMZdxxsQLNazhbjQZ9w7hJvkVyEySeSpFS', NULL, '127.0.0.1', 'Python-urllib/3.13', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZWtWQ2FjeUw1QWVxa3NPZmpsRnNZR05nR29XR3ZJSTFtaVhxczRhcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792240699),
('H19uxzjlkEMk9WhHxlN3OCCnqMcrGoUNGOg6e3Az', NULL, '127.0.0.1', 'Python-urllib/3.13', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaGV1alJ1WHhtYWJucHoxb1ZxSFBjbUFSRkFiZ252SFUwNlRJOW41aiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792241019),
('JRH7wI0I6Lkq7VakvebNIv9tkyM6UiEJBSNCbXi0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.141.1 Chrome/150.0.7871.250 Electron/43.7.7 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibVJoZzZzVG11NkVtdXQ0eDN5aUduQlQ0cVpHaFQwalJ4OTBQcmNIUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792236193),
('KMuvn0c4O7no9VwefBCAV3OeaMrjep4W6U2wk1RV', NULL, '127.0.0.1', 'Python-urllib/3.13', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUXJMQm12UEFYNEpxWENUbm9ENVlKQVFJeEZTWHdVMklkRXl6Q3V6QyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1792241020),
('mSGZzNez0SQQSuX5EP8EJC7gXZ9MbVimJbQmoemR', NULL, '127.0.0.1', 'Python-urllib/3.13', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid1dJVHBZNm9zcnZkdnlZYmxaaUJPVDY5b0VJcG9MSk9rTjFaZmV4RyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792241019),
('oPKKYIE2nHpmEcrngFnB6XMJoaONQm75P0gc7ShX', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9711', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWFJ1YnNQWFJLSHlIUDZjaWRCeE1wcWdnSnZqanNSMHI3TExIdlRQSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792237648),
('p7kRq0QiVuZFj04hSKU9lNOHRDSaQGcratc5eBeY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9711', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRlhua3lUSUY3aEtVMWVFOTBuSVlxQTBRYWs0VUZDOW1KWjByZ0p6RCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792241364),
('TosiV2JdDN7Cn5N5j3WgqgMX39BuS2C3rXdcTe2H', NULL, '127.0.0.1', 'Symfony', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSDduOEtkdWZNNHIyMWNmdmNsMmttbE0wYWtDcTdjZURHT0lFT3RXOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHA6Ly9sb2NhbGhvc3QvcHJvZmlsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792240164),
('TYhzuzSUhy8I4I2fcoxJ3he7dULEo25LO51wmeM7', NULL, '127.0.0.1', 'Python-urllib/3.13', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVUtpRWhYS0g2a0xDT3JmUFZaZGtCRGRjeEs3TG9uYWI5ZVpWZGRnUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792241225),
('uj6d9rdUCvADNFMtnW1PDiiJHd4KpkOe02RYqdaN', NULL, '127.0.0.1', 'Symfony', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ1Jpam9kZHdhMnE0NE14bnlWSnBReGJJVUxBdnVlZ09GeExKQ1VRMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHA6Ly9sb2NhbGhvc3QvcHJvZmlsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792240151),
('UQXWscQNUoth7MGJTPlFIIW34VBFSr2kJwgqkzDG', NULL, '127.0.0.1', 'Python-urllib/3.13', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidFR2YUhLaGtBSHd4bWNBN0FlaDdWTGJiYzBITTJyY1JPQTBMSzFHNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdHJ1a3R1ci1vcmdhbmlzYXNpIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792241020),
('voZl5sJlK08bsUk6wpCXJnX4M986s9R1l1BiQXj6', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU3JhMDA4VWMzNzgzWGtERW8xbWlzMTNOVkZ6bkREazlDY3JHb3VOaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODt9', 1792242805),
('xpCeGyjflKnzKmVbb8SmGw44mWyfI2OxSpQY0ttr', NULL, '127.0.0.1', 'Python-urllib/3.13', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNUw4aWJKeEdwdzJXMEtKU0w2OFlyTFp4dDRDaDFzWkRjT0xWYUNCbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792241007),
('ZfWluOPOipcK8WZMljVnV2eeswTXC5rVFBI4j7W2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9711', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib1pVSERIbHREakkwZkpLR0t1Um15cmREd1V5TUtZeTFLR21YUnVlMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792238328),
('ZjzRoO7YzWBGdgz1EsyRDZs44zSYVo2K3MCJp4th', NULL, '127.0.0.1', 'Symfony', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidjVJQ0tvWHp0a294RFJvNm5qSDVKWEllYlVKY0MxaG9aYjZRaFI3MiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3QvaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792241402);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `subtitle`, `image`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'baru', 'a', 'sliders/kUEPE5BBshTrtF6rvaKPziFn2vKmTk79USk4tJ01.jpg', 3, 1, '2025-11-17 21:16:21', '2025-11-18 18:14:21'),
(4, 'bbb', 'bb', 'sliders/iXZraaFYqICvz45KXDUD88hGsjZCjeXIh0udmc8M.jpg', 4, 1, '2025-11-18 18:14:46', '2025-11-18 18:14:55'),
(6, 'wisata', 'www', 'sliders/SRHxOVx42C69A6C1s0wPPitYw0qBJfhZwlh8tQnD.jpg', 2, 1, '2025-11-18 19:48:37', '2025-11-18 19:48:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `village_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `village_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 'admin@mail.com', 'user', NULL, NULL, '$2y$12$xsLzcD1ryZMhoWW04yQ7Puu848QyVWTCrGxLfaNgbV3sdwY382loK', NULL, '2025-09-27 08:21:08', '2025-09-27 08:21:08'),
(6, 'Admin', 'admin@example.com', 'admin', NULL, NULL, '$2y$12$4ZFnaZUUpgUjorxC0rICa.c90OyILxEbatdMKd2FAhfH/OH25wL6q', 'btosmeS7zZumWkYN1iMokUiNTuRrPUGlV4bmYnhLEjFDQY7y9xl8NqdUHzYw', '2025-09-27 08:33:56', '2026-10-17 02:10:00'),
(8, 'Admin SDA', 'sda@jeneponto.go.id', 'admin_sda', NULL, NULL, '$2y$12$pEbKPuwfj2qXTXSGi720Huh/w0QT5hUn3tQlnq3UTN2qR18KAXj92', NULL, '2026-10-17 02:08:43', '2026-10-17 02:08:43'),
(9, 'Pimpinan', 'pimpinan@jeneponto.go.id', 'pimpinan', NULL, NULL, '$2y$12$nB2c94XwzOp/FTw6HicMRO3mEEv28lXU6byOqW.73UYVmNwWE4hSG', NULL, '2026-10-17 02:08:43', '2026-10-17 02:08:43'),
(10, 'Admin Desa Benteng', 'desa.benteng@jeneponto.go.id', 'admin_desa', 41, NULL, '$2y$12$RS5I.6lN9.4P2y6B7d0RZ.d7FGC/XdKcMCjQ1T/8ZgEL.XHYLFLle', NULL, '2026-10-17 02:09:10', '2026-10-17 02:09:10'),
(11, 'Admin Desa Empoang', 'desa.empoang@jeneponto.go.id', 'admin_desa', 87, NULL, '$2y$12$JC0o3g1fBQXLlpA0A8U4SOE3Ozi4zNU7bEHOxYnzUkfn8CvpUHEjG', NULL, '2026-10-17 02:09:10', '2026-10-17 02:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `villages`
--

DROP TABLE IF EXISTS `villages`;
CREATE TABLE `villages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sector_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kepala_desa` varchar(255) DEFAULT NULL,
  `kontak_person` varchar(255) DEFAULT NULL,
  `luas_wilayah_ha` decimal(12,2) DEFAULT NULL,
  `jumlah_penduduk` bigint(20) UNSIGNED DEFAULT NULL,
  `kelompok_umkm` text DEFAULT NULL,
  `pertanian` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`pertanian`)),
  `perkebunan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`perkebunan`)),
  `perikanan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`perikanan`)),
  `peternakan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`peternakan`)),
  `energi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`energi`)),
  `kehutanan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`kehutanan`)),
  `pertambangan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`pertambangan`)),
  `lingkungan_hidup` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`lingkungan_hidup`)),
  `data_pendukung` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_pendukung`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `villages`
--

INSERT INTO `villages` (`id`, `sector_id`, `nama`, `kecamatan`, `kepala_desa`, `kontak_person`, `luas_wilayah_ha`, `jumlah_penduduk`, `kelompok_umkm`, `pertanian`, `perkebunan`, `perikanan`, `peternakan`, `energi`, `kehutanan`, `pertambangan`, `lingkungan_hidup`, `data_pendukung`, `created_at`, `updated_at`) VALUES
(5, 1, 'BALANG BERU', 'BINAMU', 'Dra. ST. SURIATI. M', '082195145771', 50400.00, 4378, NULL, '{\"luas_sawah_ha\":\"317\",\"luas_jagung_ha\":\"159\",\"lahan_tadah_hujan_ha\":\"476\",\"komoditas_utama\":\"PADI\",\"produksi_ton_per_tahun\":\"2058\",\"permasalahan\":\"1.\\tTidak Ada Pengairan\\/ Irigasi\\r\\n2.\\tKekurangan Alat Bajak\\r\\n3.\\tGangguan Hama\\r\\n4.\\tKekurangan Mesin Panen\\r\\n5.\\tMinim Pompanisasi Pertanian\\r\\n6.\\tMinim Akses Pembungan Jalan Tani\\r\\n7.\\tMinim Informasi Harga Pasar Komoditas\",\"usulan_program\":\"1.\\tPengadaan Pengoboran Sumur Dalam\\r\\n2.\\tPengadaan Hand Tractor\\/ Kultivator\\r\\n3.\\tPengadaan Insektisida\\/ Fungisida\\r\\n4.\\tPengadaan Combine Harvester\\r\\n5.\\tPengadaan Pompanisasi\\/ Alcon\\r\\n6.\\tPengadaan Pembungan Jalan Tani\\r\\n7.\\tPengadaan Sarana Informasi Resmi yang Mudah di akses Mengenai Harga pasar Komoditas.\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-20 08:40:57', '2026-01-20 08:43:11'),
(6, 4, 'BALANG BERU', 'BINAMU', 'Dra. ST. SURIATI. M', '082195145771', 50400.00, 4378, NULL, NULL, NULL, NULL, NULL, '{\"potensi_surya_kwp\":null,\"potensi_angin_kwp\":null,\"potensi_mikrohidro_kwp\":null,\"potensi_biogas_biomassa\":null,\"permasalahan\":null,\"usulan_program\":\"1.\\tINDAR DEWA \\r\\n2.\\tASRI ARWAN SAPUTRA\\r\\n3.\\tNUR ALIM\\r\\n4.\\tRUDI HARTONO\\r\\n5.\\tRAHMAN\\r\\n6.\\tDEWI SARTIKA\\r\\n7.\\tSUARDI\\r\\n8.\\tSADARIA\\r\\n9.\\tJUMAINTANG DG LANTI\\r\\n10.\\tSURIANI\\r\\n11.\\t IBNU HARIYANTO\\r\\n12.\\t HAERANI\\r\\n13.\\t JUMAINTANG DG LANTI\\r\\n14.\\t DEWI SARTIKA\\r\\n15.\\t SADARIA\\r\\n16.\\t SUARDI\\r\\n17.\\tSURIANI\\r\\n18.\\t NIA\\r\\n19.\\t HARIS\\r\\n20.\\t SUARDI\\r\\n21.\\t NURLINA\\r\\n22.\\t MUH. IMAM TAUFIQ\\r\\n23.\\t HASNI\\r\\n24.\\t BAHARUDDIN\\r\\n25.\\t BAGAS\\r\\n26.\\t ADI\"}', NULL, NULL, NULL, NULL, '2026-01-20 08:45:28', '2026-01-31 08:43:49'),
(7, 3, 'ARUNGKEKE PALLANTIKANG', 'ARUNGKEKE', 'H. MUH. KASIM, SE', '082189532599', 248.00, 2546, '-', NULL, NULL, '{\"jenis_usaha\":\"TANGKAP \\/ BUDIDAYA RUMPUT LAUT\",\"luas_tambak_kolam_ha\":\"35.00\",\"produksi_ton_per_tahun\":\"1.01\",\"jenis_ikan_udang\":\"IKAN, RUMPUT LAUT\",\"permasalahan\":\"1. Tidak adanya tanggul Penahan Ombak\\r\\n2. Penebangan Hutan Lindung Mangrove\\r\\n3. Masih Kurangnya Sarana dan Prasarana Budidaya Rumput Laut\\r\\n4. Untuk Pembudidaya Rumput Laut, Masyarakat masih sering mengalami gagal panen\\r\\n5. Penjarahan tambak \\/ orang yang tidak bertanggung jawab\",\"usulan_program\":\"1. Tanggul Penahan Ombak\\r\\n2. Permohonan Bantuan Bibit Rumput Laut beserta Tali-temalinya\\r\\n3. Permohonan Bantuan Perahu Untuk Para Nelayan Tangkap maupun yang Pembudidaya Rumput Laut\\r\\n4. Permohonan Jaring beserta Tali atau Tasi Untuk Para Nelayan Tangkap\"}', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-05 04:39:43', '2026-02-11 03:45:44'),
(8, 1, 'BORONGLAMU', 'ARUNGKEKE', 'RIDWAN', '085705958144', 706.52, 2319, NULL, '{\"luas_sawah_ha\":\"350\",\"luas_jagung_ha\":\"200\",\"lahan_tadah_hujan_ha\":\"550\",\"komoditas_utama\":\"PADI\",\"produksi_ton_per_tahun\":\"2085\",\"permasalahan\":\"1. Gangguan Irigasi dan Air\\r\\n2. Serangan Hama\\r\\n3. Kekurangan Alat Hand Tractor\",\"usulan_program\":\"1. Pengadaan Hand Tractor\\r\\n2. Pengadaan Pompa Nisasi\\r\\n3. Pengadaan Sumur Bor\\r\\n4. Pupuk Npk\\r\\n5. Pengadaan Insektisida dan fungisida\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-05 04:57:42', '2026-02-05 04:57:42'),
(9, 2, 'BORONGLAMU', 'ARUNGKEKE', 'RIDWAN', '085705958144', 706.52, 2319, NULL, NULL, '{\"jenis_tanaman\":\"JAGUNG\",\"luas_areal_ha\":\"2055\",\"produksi_rata_tahun\":\"1000\",\"permasalahan\":\"1. Serangan Hama\\r\\n2. Penyakit Tanaman\",\"usulan_program\":\"1. Pengadaan Pupuk Subsidi\\r\\n2. Penyediaan Alat Pertanian\\r\\n3. Pengadaan\\/Penyediaan Bibit Jagung\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-05 05:14:38', '2026-02-05 05:14:38'),
(11, 4, 'EMPOANG UTARA', 'BINAMU', 'ABDUL RAHMAN,A.Md', '087826842064', 1452.00, 4846, NULL, NULL, NULL, NULL, NULL, '{\"potensi_surya_kwp\":null,\"potensi_angin_kwp\":null,\"potensi_mikrohidro_kwp\":null,\"potensi_biogas_biomassa\":null,\"permasalahan\":\"1. Masih banyak warga\\/masyarakat yang tidak memiliki meteran listrik Mandiri\",\"usulan_program\":\"1. SUKIN ( Parappa )\\r\\n2. Nurhayati dg caya ( Mangambang )\\r\\n3. Roslia ( Mangambang )\\r\\n4. Murniati ( Mangambang )\\r\\n5. Syamsul Bahri ( pattallassang )\\r\\n6. Kaharuddin ( mangambang )\\r\\n7. Arifuddin( mangambang )\\r\\n8. Saparuddin. B( mangambang )\\r\\n9. Saparuddin( mangambang )\\r\\n10. Nasiruddin ( mangambang )\\r\\n11. Agung Kurniawan ( pattallassang )\\r\\n12. Nur insan ( pattallassang )\\r\\n13. Muh. Ilham jafar ( pattallassang )\\r\\n14. Tahman dg buang ( pattallassang )\\r\\n15. Sukarman ( pattallassang )\\r\\n16. Ridwan Dg situju ( pattallassang )\\r\\n17. Syaparuddin ( pattallassang )\\r\\n18. Kaimuddin ( lengke-lengkese )\\r\\n19. Sudirman ( lengke- lengkese )\\r\\n20. Muh. Renaldi ( lengke-lengkese )\\r\\n21. Rikar ( lengke-lengkese )\\r\\n22. Mustam (Parappa )\\r\\n23. Saharuddin dg Rewa ( parappa )\\r\\n24.Saleh ( parappa )\\r\\n25. kr. Mangkin ( parappa )\\r\\n26. Muddin minne ( parrappa )\\r\\n27. Wiwi Lestari ( parappa )\\r\\n28. Sariluk ( parappa )\"}', NULL, NULL, NULL, NULL, '2026-02-06 02:47:18', '2026-02-13 03:45:29'),
(12, 1, 'Parasangan Beru', 'Turatea', 'Abd Rahman', '085343697398', 2061.00, 2534, NULL, '{\"luas_sawah_ha\":\"146.9\",\"luas_jagung_ha\":\"100\",\"lahan_tadah_hujan_ha\":null,\"komoditas_utama\":\"Padi\\/Jagung\",\"produksi_ton_per_tahun\":\"1421845\",\"permasalahan\":\"Terkait dengan peningkatan kesejahteraan petani di Desa Parasangan Beru serta luasnya lahan pertanian maka petani menbutuhkan alat-alat\\/ mesin pertanian untuk memudahkan dalam pengolahan lahan,karena biasanya petani menyewa alat-alat pertanian  dengan harga yang sangat mahal\",\"usulan_program\":\"membutuhkan mesin alat-alat pertanian berupa HAND TRAKTOR\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-06 03:36:23', '2026-02-06 03:37:50'),
(13, 1, 'Kelurahan Tonrokassi', 'Tamalatea', 'RUDINI, SE', '085255671747', 490.00, 6786, '48', '{\"luas_sawah_ha\":\"45.20\",\"luas_jagung_ha\":\"210\",\"lahan_tadah_hujan_ha\":\"45.20\",\"komoditas_utama\":\"Jagung\",\"produksi_ton_per_tahun\":\"7\",\"permasalahan\":\"Kurangnya sumber air yang cukup untuk menyiram tanaman, bibit jagung mahal dan langka, pupuk subsidi terbatas, belum ada subsidi racun, semprot racun masih manual, mesin pengisap air\\/penyiram masih kurang, belum ada traktor.\",\"usulan_program\":\"Pengadaan Sumur dalam atau sumur bor di lahan pertanian, bibit jagung SUMO - padi - kedelai, pupuk subsidi ditambah, subsidi racun tanaman, mesin semprot racun, mesin pengisap air\\/penyiram tanaman, traktor.\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-06 05:17:28', '2026-02-09 18:52:12'),
(14, 3, 'Kelurahan Tonrokassi', 'Tamalatea', 'RUDINI, SE', '085255671747', 490.00, 6786, '18', NULL, NULL, '{\"jenis_usaha\":\"Budidaya Rumput Laut\",\"luas_tambak_kolam_ha\":\"0\",\"produksi_ton_per_tahun\":null,\"jenis_ikan_udang\":\"0\",\"permasalahan\":\"1. Modal usaha masih pinjam di bank\\/pegadaian\\/koperasi simpan pinjam\\r\\n2. Modal usaha masih kecil\\/tidak mencukupi\\r\\n3. Bibit rumput laut langka dan mahal\",\"usulan_program\":\"1. Pemberian modal usaha yang memadai\\r\\n2. Pengadaan bibit rumput laut yang mudah dijangkau dari segi harga maupun stoknya\\r\\n3. Pemberian sarana dan prasarana penunjang produksi rumput laut seperti tali, mesin, perahu, dan lain-lain\"}', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-06 05:32:11', '2026-02-09 18:50:16'),
(15, 1, 'BONTOA', 'BINAMU', 'SAHARULLAH. S.,S.KOM', '082195676597', 624.00, 2618, NULL, '{\"luas_sawah_ha\":\"475\",\"luas_jagung_ha\":\"365\",\"lahan_tadah_hujan_ha\":\"526\",\"komoditas_utama\":\"Padi\\/jagung\",\"produksi_ton_per_tahun\":\"2067\",\"permasalahan\":\"1. Serangan Hama\\r\\n2. Kekurangan Mesin panen\\r\\n3.gangguan irigasi dan Air\\r\\n4.kekurangan Alat Hand Tractor\",\"usulan_program\":\"1. Pengasaan Hand Tractor \\r\\n2. Pengadaan Sumur Bor Pertanian\\r\\n3. Pengadaan Pupuk \\r\\n4. Pengadaan Fubgisida dan insektisida \\r\\n5. Pengadaan Bibit Padi dan Jagung\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-06 06:01:34', '2026-02-06 06:25:21'),
(16, 6, 'EMPOANG UTARA', 'BINAMU', 'ABDUL RAHMAN,A.Md', '087826842064', 1452.00, 4846, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"jenis_galian\":\"Tanah Dan Pasir\",\"luas_wilayah_tambang_ha\":\"0.05\",\"status_izin\":\"ilegal\",\"dampak_lingkungan\":\"lingkungan fisik : 1 . Risiko Banjir dan Longsor  2. Kerusakan  jalan 3. Terkikisnya Pinggiran Sungai 4. Kerusakan Lahan\",\"usulan_program\":\"1.  sistem Perizinan untuk penambang\"}', NULL, NULL, '2026-02-06 15:57:08', '2026-02-14 01:34:21'),
(17, 2, 'EMPOANG UTARA', 'BINAMU', 'ABDUL RAHMAN,A.Md', '087826842064', 1452.00, 4846, NULL, NULL, '{\"jenis_tanaman\":\"Jagung\",\"luas_areal_ha\":\"514\",\"produksi_rata_tahun\":\"3855\",\"permasalahan\":\"1. serangan Hama 2. Masalah bibit dan pupuk\",\"usulan_program\":\"1. pengadaan bibit \\/Benih\\r\\n2. Pengadaan pupuk subsidi\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-06 17:11:33', '2026-02-09 16:26:56'),
(18, 1, 'Manjangloe', 'Tamalatea', 'MOHAMMAD SYAHID R SE', '081354772235', 3.47, 2487, NULL, '{\"luas_sawah_ha\":\"78\",\"luas_jagung_ha\":\"219\",\"lahan_tadah_hujan_ha\":\"58\",\"komoditas_utama\":\"Jagung\",\"produksi_ton_per_tahun\":null,\"permasalahan\":\"Kekurangan Air di tambah Saluran Irigasi tidak ada dan Kekurangan Alat Pertanian\",\"usulan_program\":\"1. Saluran Irigasi\\r\\n2.Hand Traktor\\r\\n3.Sumur Bor Pertanian\\r\\n4.Pengecotan Jalan tani\\r\\n5. Pengadaan Bibit Padi Dan Jagung\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-06 18:09:01', '2026-02-06 18:39:50'),
(19, 2, 'KALUMPANG LOE', 'ARUNGKEKE', 'ABD. RAHMAN', '087843544221', 438.00, 2271, NULL, NULL, '{\"jenis_tanaman\":\"Jagung\",\"luas_areal_ha\":\"302.70\",\"produksi_rata_tahun\":\"2118.9\",\"permasalahan\":\"1. Harga Jual Rendah (Ketergantungan Tengkulak)\\r\\n2. Serangan Hama (Ulat)\\r\\n3. Biaya Produksi Tinggi (Benih, Pupuk)\",\"usulan_program\":\"1. Fasilitas akses pasar langsung (Harga lebih baik)\\r\\n2. Bantuan benih tahan hama dan pelatihan teknis\\r\\n3. Pengadaan pupuk subsidi\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-08 18:54:12', '2026-02-08 18:55:18'),
(20, 1, 'Bontomate\'ne', 'Turatea', 'Yusuf Alim, S.E', '082134091180', 67396.74, 3940, '-', '{\"luas_sawah_ha\":\"53231.4\",\"luas_jagung_ha\":\"16632.16\",\"lahan_tadah_hujan_ha\":\"33264.32\",\"komoditas_utama\":\"Padi dan Jagung\",\"produksi_ton_per_tahun\":\"69.87\",\"permasalahan\":\"1. Kekurangan Alat Bajak\\r\\n2. Gangguan Hama\\r\\n3. Kekurangan Mesin Panen\\r\\n4. Minim Pompanisasi Pertanian\\r\\n5. Minim Akses Pembangunan Jalan Tani\\r\\n6. Kurangnya Pengairan Irigasi Dari Induk Kelara\",\"usulan_program\":\"1. Pengadaan Hand Tractor\\/Kultivator\\r\\n2. Pengadaan Insektisida\\/Fungisida\\r\\n3. Pengadaan Combine Harvester\\r\\n4. Pengadaan Pompanisasi\\/Alcon\\r\\n5. Pengadaan Pembangunan Jalan Tani\\r\\n6. Pengadaan Pengeboran Sumur Dalam (Lahan)\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-08 19:18:02', '2026-02-08 19:35:46'),
(21, 2, 'Bontomate\'ne', 'Turatea', 'Yusuf Alim, S.E', '082134091180', 67396.74, 3940, NULL, NULL, '{\"jenis_tanaman\":\"Jagung\",\"luas_areal_ha\":\"16632.16\",\"produksi_rata_tahun\":\"16.64\",\"permasalahan\":\"1. Harga Jual Rendah (Ketergantungan Tengkulak)\\r\\n2. Serangan Hama\\r\\n3. Biaya Produksi Tinggi (Benih)\",\"usulan_program\":\"1. Fasilitas Akses Pasar Langsung\\r\\n2. Bantuan Benih\\r\\n3. Pengadaan Pupuk Subsidi\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-08 19:40:42', '2026-02-08 19:43:47'),
(22, 6, 'Bontomate\'ne', 'Turatea', 'Yusuf Alim, S.E', '082134091180', 67396.74, 3940, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"jenis_galian\":\"Pasir\",\"luas_wilayah_tambang_ha\":\"0.37\",\"status_izin\":\"Ilegal\",\"dampak_lingkungan\":\"Pengikisan Sungai\",\"usulan_program\":\"Tindaki\"}', NULL, NULL, '2026-02-08 19:46:49', '2026-02-08 19:46:49'),
(23, 1, 'EMPOANG UTARA', 'BINAMU', 'ABDUL RAHMAN,A.Md', '087826842064', 1452.00, 4846, NULL, '{\"luas_sawah_ha\":\"514\",\"luas_jagung_ha\":\"514\",\"lahan_tadah_hujan_ha\":\"514\",\"komoditas_utama\":\"Padi\",\"produksi_ton_per_tahun\":\"3495\",\"permasalahan\":\"1.Serangan Hama  \\r\\n2. Kelangkaan Pupuk Bersubsidi\\r\\n3. Penyakit Tanaman\",\"usulan_program\":\"1. Bantuan Mesin Pompa Air\\r\\n2. Pengadaan Pupuk Subsidi\\r\\n3. Pengadaan Racun dan Bibit\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-09 00:05:09', '2026-02-09 16:46:21'),
(24, 1, 'KALUMPANG LOE', 'ARUNGKEKE', 'ABD. RAHMAN', '087843544221', 438.00, 2271, NULL, '{\"luas_sawah_ha\":\"302.70\",\"luas_jagung_ha\":\"302.70\",\"lahan_tadah_hujan_ha\":null,\"komoditas_utama\":\"Padi\",\"produksi_ton_per_tahun\":\"1967.55\",\"permasalahan\":\"1. Harga gabah rendah saat panen\\r\\n2. Biaya produksi tinggi (Pupuk,pestisida)\\r\\n3. serangan hama (wereng,tikus)\\r\\n4. ketergantungan cuaca (kekeringan) \\r\\n5. kurangnya alat pertanian (handtraktor)\",\"usulan_program\":\"1. akses pasar (fasilitas jual gabah harga baik)\\r\\n2. Bantuan input pertanian ( benih unggul, pupuk subsidi)\\r\\n3. infrastruktur irigasi (perbaikan saluran air)\\r\\n4. pengadaan sumur bor\\r\\n5. pengadaan alat pertanian handtraktor\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-09 18:38:15', '2026-02-09 18:38:15'),
(25, 2, 'Kelurahan Tonrokassi', 'Tamalatea', 'RUDINI, SE', '085255671747', 490.00, 6786, '11/3', NULL, '{\"jenis_tanaman\":\"Lontara\",\"luas_areal_ha\":null,\"produksi_rata_tahun\":null,\"permasalahan\":\"Kurangnya peralatan untuk pembuatan gula merah\",\"usulan_program\":\"Pengadaan peralatan masak untuk pembuatan gula merah\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-09 18:55:16', '2026-02-09 18:55:16'),
(26, 4, 'KALUMPANG LOE', 'ARUNGKEKE', 'ABD. RAHMAN', '087843544221', 438.00, 2271, NULL, NULL, NULL, NULL, NULL, '{\"potensi_surya_kwp\":null,\"potensi_angin_kwp\":null,\"potensi_mikrohidro_kwp\":null,\"potensi_biogas_biomassa\":null,\"permasalahan\":\"Masih terdapat masyarakat yang belum memiliki meteran listrik sehingga belum dapat menikmati akses listrik secara mandiri\",\"usulan_program\":\"Daftar rumah tangga yang belum memiliki meteran listrik\\r\\n1. MARIAGI (Dusun Palippiri)\\r\\n2. SAHAMAN (Dusun Palippiri)\"}', NULL, NULL, NULL, NULL, '2026-02-09 19:12:16', '2026-02-09 19:12:16'),
(28, 2, 'KAYULOE TIMUR', 'TURATEA', 'H. LELONG ASIS', '085397789899', 80.00, 2008, NULL, NULL, '{\"jenis_tanaman\":\"JAGUNG\",\"luas_areal_ha\":\"80\",\"produksi_rata_tahun\":\"130\",\"permasalahan\":\"1. Harga Jual Rendah (Ketergantungan Tengkulak)\\r\\n2. Serangan Hama (Ulat)\\r\\n3. Biaya Produksi Tinggi (Benih, Pupuk)\",\"usulan_program\":\"1. Fasilitas akses pasar langsung (Harga lebih baik)\\r\\n2. Bantuan benih tahan hama dan pelatihan teknis\\r\\n3. Pengadaan pupuk subsidi\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-09 20:26:01', '2026-02-09 20:41:34'),
(29, 1, 'KAYULOE TIMUR', 'TURATEA', 'H. LELONG ASIS', '085397789899', 365.00, 2008, NULL, '{\"luas_sawah_ha\":\"365\",\"luas_jagung_ha\":\"80\",\"lahan_tadah_hujan_ha\":null,\"komoditas_utama\":\"padi\",\"produksi_ton_per_tahun\":\"1400.000\",\"permasalahan\":\"1. Fasilitas akses pasar langsung (Harga lebih baik)\\r\\n2. Bantuan benih tahan hama dan pelatihan teknis\\r\\n3. Pengadaan pupuk subsidi\",\"usulan_program\":\"1. akses pasar (fasilitas jual gabah harga baik)\\r\\n2. Bantuan input pertanian ( benih unggul, pupuk subsidi)\\r\\n3. infrastruktur irigasi (perbaikan saluran air)\\r\\n4. pengadaan sumur bor\\r\\n5. pengadaan alat pertanian handtraktor\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-09 20:34:34', '2026-02-09 20:41:49'),
(31, 3, 'Balang Baru', 'Tarowang', 'Darman,S.E', '085824049301/082292922922', 7270.00, 3300, '5', NULL, NULL, '{\"jenis_usaha\":\"Tangkap dan Budidaya Rumput laut\\/Udang\",\"luas_tambak_kolam_ha\":\"10\",\"produksi_ton_per_tahun\":\"20\",\"jenis_ikan_udang\":\"Budidaya Rumput laut dan Udang Tambak\",\"permasalahan\":\"- Masih Kurangya Sarana dan Prasarana Budidaya Tambak Udang \\r\\n- Untuk pembudidaya Rumput Laut ,Petani masih sering mengalami gagal panen\\r\\n- masih kurangx Sarana dan Prasarana Budidaya rumput Laut\",\"usulan_program\":\"- Permohonan bantuan Perahu dan Mesin untuk Nelayan Tangkap\\/Pembudidaya Rumput Laut\\r\\n- Permohonan Bantuan Bibit Rumput Laut dan Tali Temali \\r\\n- Permohonan Jaring dan Tali\\/Tasi Rawe Nelayan Tangkap\\r\\n- Permohonan bantuan Budidaya Bibit Udang \\r\\n- Permohonan Bantuan Sarana dan Prasarana Budidaya Udang\"}', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-10 18:36:05', '2026-02-10 18:36:05'),
(32, 2, 'Balang Baru', 'Tarowang', 'Darman,S.E', '085824049301/082292922922', 7270.00, 3300, '1', NULL, '{\"jenis_tanaman\":\"Kelapa\",\"luas_areal_ha\":\"5\",\"produksi_rata_tahun\":\"10\",\"permasalahan\":\"- Masih Kurangnya Sosialisasi tentang meknisme pembibitan dan Pemupukan kelapa yang baik dan benar\\r\\n- belum tersentuh Bantuan Bibit Kelapa\",\"usulan_program\":\"- Permohonan Sosialisasi Mekanisme Pembibitan dan Pemupukan Bibit Kelapa kepada Masyaratat\\r\\n- Permohon Bantuan Bibit yang Berkualitas\\r\\n- Permohonan Bantuan  Pupuk Khusus Pohon kelapa agar bisa Berproduksi lebih Baik dan lebih Banyak\\r\\n- Permohonan bantuan Sarana dan Prasarana Produksi Kuliner Es Kelapa Muda\\r\\n- Permohona Pembangunan Wisata Kuliner Es Kelapa di Kebun Kelapa\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-10 18:45:29', '2026-02-10 18:45:29'),
(33, 5, 'Balang Baru', 'Tarowang', 'Darman,S.E', '085824049301/082292922922', 7270.00, 3300, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-10 18:51:32', '2026-02-10 18:52:05'),
(34, 4, 'Balang Baru', 'Tarowang', 'Darman,S.E', '085824049301/082292922922', 7270.00, 3300, '-', NULL, NULL, NULL, NULL, '{\"potensi_surya_kwp\":\"10\",\"potensi_angin_kwp\":null,\"potensi_mikrohidro_kwp\":null,\"potensi_biogas_biomassa\":null,\"permasalahan\":\"- Masih adanya rumah tangga yang belum memiliki meteran Listrik\\r\\n- Masih Adanya Jalan Desa yang belum ada lampu Penerangan Jalan sehingga menggangu aktivitas masyarakat di malam hari\",\"usulan_program\":\"- Permohonan bantuan Meteran Listrik untuk rumah tangga yang tidak mampu\\r\\n- Permohonan Bantuan Lampu Penerangan jalan Desa\"}', NULL, NULL, NULL, NULL, '2026-02-10 19:03:34', '2026-02-10 19:03:34'),
(35, 1, 'ARUNGKEKE PALLANTIKANG', 'ARUNGKEKE', 'H. MUH. KASIM, SE', '08189532599', 248.00, 2546, NULL, '{\"luas_sawah_ha\":\"123\",\"luas_jagung_ha\":\"108\",\"lahan_tadah_hujan_ha\":\"50\",\"komoditas_utama\":\"PADI, JAGUNG\",\"produksi_ton_per_tahun\":\"11781\",\"permasalahan\":\"1.\\tBanyak jaringan irigasi rusak\\r\\n2.\\tAir irigasi masih kurang\\r\\n3.\\tSerangan hama dan penyakit tanaman\\r\\n4. Biaya produksi tinggi (Harga pupuk, pestisida)\\r\\n5. Kekurangan Alat Hand Tractor, Mesin Pompa\",\"usulan_program\":\"1.\\tPerbaikan jaringan irigasi yang rusak\\r\\n2.\\tPerbanyak titik sumur bor dilahan sawah untuk percepatan penanaman dengan menambah indeks pertanaman setiap tahunnya 2 kali sampai 3 kali pertahun atau IP 200-300\\r\\n3. Pengadaan Bantuan Pupuk & Pestisida\\r\\n4. Pengadaan Alat Hand Tractor & Mesin Pompa\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-11 04:16:28', '2026-02-11 04:16:28'),
(36, 1, 'Turatea timur', 'Tamalatea', 'Nuraeni.L', '+62 823-9836-4356', 408225.00, 3290, NULL, '{\"luas_sawah_ha\":\"254\",\"luas_jagung_ha\":\"100\",\"lahan_tadah_hujan_ha\":\"9.5\",\"komoditas_utama\":null,\"produksi_ton_per_tahun\":null,\"permasalahan\":\"Belum ada pengairan dan kurangnya bibit untuk petani\",\"usulan_program\":\"Pembangunan irigasi dan pengadaan bibit\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-12 05:23:16', '2026-02-12 05:58:50'),
(37, 2, 'Turatea timur', 'Tamalatea', 'Nuraeni.L', '+62 823-9836-4356', 408225.00, 3290, NULL, NULL, '{\"jenis_tanaman\":\"Kelapa\",\"luas_areal_ha\":\"1\",\"produksi_rata_tahun\":null,\"permasalahan\":\"Kurangnya lahan untuk di jadikan perkebunan dan kurangnya bibit kelapa\",\"usulan_program\":\"Pengadaan bibit\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-12 05:29:27', '2026-02-12 05:57:12'),
(38, 4, 'Turatea timur', 'Tamalatea', 'Nuraeni•L', '+62 823-9836-4356', 408225.00, 3290, NULL, NULL, NULL, NULL, NULL, '{\"potensi_surya_kwp\":null,\"potensi_angin_kwp\":null,\"potensi_mikrohidro_kwp\":null,\"potensi_biogas_biomassa\":null,\"permasalahan\":\"Masih banyak membutuhkan kilometer listrik dan tiang listrik baru\",\"usulan_program\":\"Pengadaan kilometer listrik untuk masyarakat\"}', NULL, NULL, NULL, NULL, '2026-02-12 05:38:22', '2026-02-12 05:59:17'),
(39, 4, 'Manjangloe', 'Tamalatea', 'MOHAMMAD SYAHID R SE', '085342592368', 3.47, 2487, NULL, NULL, NULL, NULL, NULL, '{\"potensi_surya_kwp\":null,\"potensi_angin_kwp\":null,\"potensi_mikrohidro_kwp\":null,\"potensi_biogas_biomassa\":null,\"permasalahan\":\"Numpang di Tetangga\",\"usulan_program\":\"Samri\\r\\nNurmiati\\r\\nKaimuddin\\r\\nHerman.T\\r\\nParman\\r\\nHamida\\r\\nNurjiah\\r\\nSumakkara\\r\\nBudiman\\r\\nErni\\r\\nMustafa\\r\\nSuking\\r\\nArdi\\r\\nSatturia\\r\\nVirayu Narsi\\r\\nRinawati\\r\\nNurbaya\\r\\nSunarti\\r\\nHalipa\\r\\nTika\"}', NULL, NULL, NULL, NULL, '2026-02-19 05:34:22', '2026-02-19 05:34:22'),
(41, 1, 'Benteng', 'Bangkala', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(42, 1, 'Bontomanai', 'Bangkala', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(43, 1, 'Kalimporo', 'Bangkala', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(44, 1, 'Lembang', 'Bangkala', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(45, 1, 'Lembang Lohe', 'Bangkala', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(46, 1, 'Mallasoro', 'Bangkala', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(47, 1, 'Bonto Bulaeng', 'Bangkala', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(48, 1, 'Bonto Karaeng', 'Bangkala', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(49, 1, 'Bonto Marannu', 'Bangkala', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(50, 1, 'Bontojaya', 'Bangkala', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(51, 1, 'Bontoloe', 'Bangkala', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(52, 1, 'Pabentengang', 'Bangkala', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(53, 1, 'Tombo-Tombolo', 'Bangkala', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(54, 1, 'Bonto Cini', 'Bangkala Barat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(55, 1, 'Bonto Loe', 'Bangkala Barat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(56, 1, 'Bonto Mangepe', 'Bangkala Barat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(57, 1, 'Bonto Rita', 'Bangkala Barat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(58, 1, 'Karampuang', 'Bangkala Barat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(59, 1, 'Lembanna', 'Bangkala Barat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(60, 1, 'Nipa-Nipa', 'Bangkala Barat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(61, 1, 'Pallantikang', 'Bangkala Barat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(62, 1, 'Pappalluang', 'Bangkala Barat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(63, 1, 'Barua', 'Bangkala Barat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(64, 1, 'Bontojai', 'Tamalatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(65, 1, 'Bontotangnga', 'Tamalatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(66, 1, 'Karelayu', 'Tamalatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(67, 1, 'Tamalatea', 'Tamalatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(68, 1, 'Turatea', 'Tamalatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(69, 1, 'Bontosunggu', 'Tamalatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(70, 1, 'Borongloe', 'Tamalatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(71, 1, 'Bululoe', 'Tamalatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(72, 1, 'Kampala', 'Tamalatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(73, 1, 'Rappoala', 'Tamalatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(74, 1, 'Tanrara', 'Tamalatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(75, 1, 'Bontoramba', 'Bontoramba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(76, 1, 'Bulusibatang', 'Bontoramba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(77, 1, 'Bontonompo', 'Bontoramba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(78, 1, 'Bontotanga', 'Bontoramba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(79, 1, 'Kalebarembeng', 'Bontoramba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(80, 1, 'Kampung Beru', 'Bontoramba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(81, 1, 'Maero', 'Bontoramba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(82, 1, 'Pallantikang', 'Bontoramba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(83, 1, 'Pattallikang', 'Bontoramba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(84, 1, 'Romanglasa', 'Bontoramba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(85, 1, 'Sapanang', 'Bontoramba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(86, 1, 'Tino', 'Bontoramba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(87, 1, 'Empoang', 'Binamu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(88, 1, 'Empoang Selatan', 'Binamu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(89, 1, 'Balang', 'Binamu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(90, 1, 'Balang Toa', 'Binamu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(91, 1, 'Biringkassi', 'Binamu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(92, 1, 'Monro-Monro', 'Binamu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(93, 1, 'Pabiringa', 'Binamu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(94, 1, 'Panaikang', 'Binamu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(95, 1, 'Sapanang', 'Binamu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(96, 1, 'Sidenre', 'Binamu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(97, 1, 'Tolo', 'Binamu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(98, 1, 'Bontoramba', 'Binamu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(99, 1, 'Bontomatene', 'Turatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(100, 1, 'Kayuloe', 'Turatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(101, 1, 'Kayuloe Barat', 'Turatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(102, 1, 'Paitana', 'Turatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(103, 1, 'Togo-Togo', 'Turatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(104, 1, 'Bantaeng', 'Turatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(105, 1, 'Bontokassi', 'Turatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(106, 1, 'Jombe', 'Turatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(107, 1, 'Lentu', 'Turatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(108, 1, 'Mangalli', 'Turatea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(109, 1, 'Bontosunggu', 'Batang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(110, 1, 'Daya', 'Batang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(111, 1, 'Kaluku', 'Batang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(112, 1, 'Marayoka', 'Batang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(113, 1, 'Mataere', 'Batang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(114, 1, 'Pallantikang', 'Batang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(115, 1, 'Tata', 'Batang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(116, 1, 'Bungung Loe', 'Batang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(117, 1, 'Tompo Balang', 'Batang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(118, 1, 'Arungkeke', 'Arungkeke', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(119, 1, 'Bulo-Bulo', 'Arungkeke', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(120, 1, 'Kalumpangloe', 'Arungkeke', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(121, 1, 'Kampung Parang', 'Arungkeke', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(122, 1, 'Palajau', 'Arungkeke', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(123, 1, 'Tarowang', 'Arungkeke', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(124, 1, 'Bontorappo', 'Tarowang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(125, 1, 'Tarowang', 'Tarowang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(126, 1, 'Bontotangnga', 'Tarowang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(127, 1, 'Kayuloe', 'Tarowang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(128, 1, 'Mangkiling', 'Tarowang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(129, 1, 'Patikarya', 'Tarowang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(130, 1, 'Tamasongo', 'Tarowang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(131, 1, 'Balumbungan', 'Tarowang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(132, 1, 'Bontolebang', 'Kelara', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(133, 1, 'Bontonompo', 'Kelara', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(134, 1, 'Gantarang', 'Kelara', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(135, 1, 'Kelara', 'Kelara', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(136, 1, 'Tolo', 'Kelara', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(137, 1, 'Tolo Barat', 'Kelara', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(138, 1, 'Tolo Selatan', 'Kelara', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(139, 1, 'Tolo Utara', 'Kelara', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(140, 1, 'Bontorannu', 'Kelara', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(141, 1, 'Samataring', 'Kelara', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(142, 1, 'Bonto Bulaeng', 'Rumbia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(143, 1, 'Bonto Manai', 'Rumbia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(144, 1, 'Bonto Tangnga', 'Rumbia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(145, 1, 'Kassi', 'Rumbia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(146, 1, 'Loka', 'Rumbia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(147, 1, 'Rumbia', 'Rumbia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(148, 1, 'Tompobulu', 'Rumbia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(149, 1, 'Ujung', 'Rumbia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28'),
(150, 1, 'Lebang Manai', 'Rumbia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-17 02:08:28', '2026-10-17 02:08:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `announcements_slug_unique` (`slug`),
  ADD KEY `announcements_is_active_index` (`is_active`),
  ADD KEY `announcements_published_at_index` (`published_at`);

--
-- Indexes for table `assistance_requests`
--
ALTER TABLE `assistance_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `assistance_requests_kode_unique` (`kode`),
  ADD UNIQUE KEY `assistance_requests_tracking_code_unique` (`tracking_code`),
  ADD KEY `assistance_requests_hp_index` (`hp`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `dinas_sectors`
--
ALTER TABLE `dinas_sectors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dinas_sectors_slug_unique` (`slug`);

--
-- Indexes for table `emergency_reports`
--
ALTER TABLE `emergency_reports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emergency_reports_tracking_code_unique` (`tracking_code`),
  ADD KEY `emergency_reports_kategori_index` (`kategori`),
  ADD KEY `emergency_reports_severity_index` (`severity`),
  ADD KEY `emergency_reports_waktu_index` (`waktu`),
  ADD KEY `emergency_reports_desa_kecamatan_index` (`desa`,`kecamatan`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_atasan_id_foreign` (`atasan_id`);

--
-- Indexes for table `esdm_reports`
--
ALTER TABLE `esdm_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `esdm_reports_user_id_foreign` (`user_id`),
  ADD KEY `esdm_reports_verified_by_foreign` (`verified_by`),
  ADD KEY `esdm_reports_type_index` (`type`),
  ADD KEY `esdm_reports_status_index` (`status`),
  ADD KEY `esdm_reports_village_id_index` (`village_id`);

--
-- Indexes for table `esdm_report_attachments`
--
ALTER TABLE `esdm_report_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `esdm_report_attachments_esdm_report_id_foreign` (`esdm_report_id`);

--
-- Indexes for table `esdm_report_histories`
--
ALTER TABLE `esdm_report_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `esdm_report_histories_esdm_report_id_foreign` (`esdm_report_id`),
  ADD KEY `esdm_report_histories_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaders`
--
ALTER TABLE `leaders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metrics`
--
ALTER TABLE `metrics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opd_records`
--
ALTER TABLE `opd_records`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_opd_village_year` (`dinas_sector_id`,`village_id`,`periode_tahun`),
  ADD KEY `opd_records_village_id_foreign` (`village_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `potentials`
--
ALTER TABLE `potentials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `potentials_sector_id_foreign` (`sector_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_tracking_code_index` (`tracking_code`);

--
-- Indexes for table `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sectors_slug_unique` (`slug`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_village_id_foreign` (`village_id`);

--
-- Indexes for table `villages`
--
ALTER TABLE `villages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `villages_sector_id_foreign` (`sector_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assistance_requests`
--
ALTER TABLE `assistance_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dinas_sectors`
--
ALTER TABLE `dinas_sectors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `emergency_reports`
--
ALTER TABLE `emergency_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `esdm_reports`
--
ALTER TABLE `esdm_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `esdm_report_attachments`
--
ALTER TABLE `esdm_report_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `esdm_report_histories`
--
ALTER TABLE `esdm_report_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaders`
--
ALTER TABLE `leaders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `metrics`
--
ALTER TABLE `metrics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `opd_records`
--
ALTER TABLE `opd_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `potentials`
--
ALTER TABLE `potentials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sectors`
--
ALTER TABLE `sectors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `villages`
--
ALTER TABLE `villages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_atasan_id_foreign` FOREIGN KEY (`atasan_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `esdm_reports`
--
ALTER TABLE `esdm_reports`
  ADD CONSTRAINT `esdm_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `esdm_reports_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `esdm_reports_village_id_foreign` FOREIGN KEY (`village_id`) REFERENCES `villages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `esdm_report_attachments`
--
ALTER TABLE `esdm_report_attachments`
  ADD CONSTRAINT `esdm_report_attachments_esdm_report_id_foreign` FOREIGN KEY (`esdm_report_id`) REFERENCES `esdm_reports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `esdm_report_histories`
--
ALTER TABLE `esdm_report_histories`
  ADD CONSTRAINT `esdm_report_histories_esdm_report_id_foreign` FOREIGN KEY (`esdm_report_id`) REFERENCES `esdm_reports` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `esdm_report_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `opd_records`
--
ALTER TABLE `opd_records`
  ADD CONSTRAINT `opd_records_dinas_sector_id_foreign` FOREIGN KEY (`dinas_sector_id`) REFERENCES `dinas_sectors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `opd_records_village_id_foreign` FOREIGN KEY (`village_id`) REFERENCES `villages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `potentials`
--
ALTER TABLE `potentials`
  ADD CONSTRAINT `potentials_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_village_id_foreign` FOREIGN KEY (`village_id`) REFERENCES `villages` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `villages`
--
ALTER TABLE `villages`
  ADD CONSTRAINT `villages_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



SET FOREIGN_KEY_CHECKS = 1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;