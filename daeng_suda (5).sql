-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2025 at 04:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daeng_suda`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-home.ann.top3', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;O:23:\"App\\Models\\Announcement\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"announcements\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:1;s:5:\"title\";s:18:\"Penerimaan pegawai\";s:4:\"slug\";s:18:\"penerimaan-pegawai\";s:4:\"body\";s:48:\"penerimaan pegawai akan dibuka di bulan Desember\";s:9:\"is_active\";i:1;s:12:\"published_at\";s:19:\"2025-10-15 22:01:00\";s:10:\"created_at\";s:19:\"2025-10-11 14:01:35\";s:10:\"updated_at\";s:19:\"2025-10-11 14:01:35\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:1;s:5:\"title\";s:18:\"Penerimaan pegawai\";s:4:\"slug\";s:18:\"penerimaan-pegawai\";s:4:\"body\";s:48:\"penerimaan pegawai akan dibuka di bulan Desember\";s:9:\"is_active\";i:1;s:12:\"published_at\";s:19:\"2025-10-15 22:01:00\";s:10:\"created_at\";s:19:\"2025-10-11 14:01:35\";s:10:\"updated_at\";s:19:\"2025-10-11 14:01:35\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:12:\"published_at\";s:8:\"datetime\";s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:4:\"slug\";i:2;s:4:\"body\";i:3;s:12:\"published_at\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1762499968),
('laravel-cache-home.metrics', 'O:17:\"App\\Models\\Metric\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"metrics\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:6:{s:2:\"id\";i:1;s:9:\"districts\";i:11;s:8:\"villages\";i:113;s:7:\"sectors\";i:8;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-09-25 09:43:15\";}s:11:\"\0*\0original\";a:6:{s:2:\"id\";i:1;s:9:\"districts\";i:11;s:8:\"villages\";i:113;s:7:\"sectors\";i:8;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-09-25 09:43:15\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:3:{i:0;s:9:\"districts\";i:1;s:8:\"villages\";i:2;s:7:\"sectors\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1762499968),
('laravel-cache-home.news.top3', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:3:{i:0;O:15:\"App\\Models\\News\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"news\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:1;s:5:\"title\";s:26:\"Program Rehabilitasi Lahan\";s:7:\"excerpt\";s:44:\"Peningkatan produktivitas sawah di Bangkala.\";s:4:\"body\";s:3:\"hai\";s:8:\"category\";s:9:\"Pertanian\";s:12:\"published_at\";s:19:\"2025-09-08 09:43:00\";s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-09-29 12:19:22\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:1;s:5:\"title\";s:26:\"Program Rehabilitasi Lahan\";s:7:\"excerpt\";s:44:\"Peningkatan produktivitas sawah di Bangkala.\";s:4:\"body\";s:3:\"hai\";s:8:\"category\";s:9:\"Pertanian\";s:12:\"published_at\";s:19:\"2025-09-08 09:43:00\";s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-09-29 12:19:22\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:12:\"published_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:7:\"excerpt\";i:2;s:4:\"body\";i:3;s:8:\"category\";i:4;s:12:\"published_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:15:\"App\\Models\\News\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"news\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:2;s:5:\"title\";s:27:\"Potensi Energi Surya 1.2 GW\";s:7:\"excerpt\";s:35:\"Mendukung energi terbarukan daerah.\";s:4:\"body\";s:450:\"Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. \";s:8:\"category\";s:6:\"Energi\";s:12:\"published_at\";s:19:\"2025-08-30 09:43:15\";s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-09-25 09:43:15\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:2;s:5:\"title\";s:27:\"Potensi Energi Surya 1.2 GW\";s:7:\"excerpt\";s:35:\"Mendukung energi terbarukan daerah.\";s:4:\"body\";s:450:\"Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. \";s:8:\"category\";s:6:\"Energi\";s:12:\"published_at\";s:19:\"2025-08-30 09:43:15\";s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-09-25 09:43:15\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:12:\"published_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:7:\"excerpt\";i:2;s:4:\"body\";i:3;s:8:\"category\";i:4;s:12:\"published_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:15:\"App\\Models\\News\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"news\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:3;s:5:\"title\";s:24:\"Festival Hasil Laut 2024\";s:7:\"excerpt\";s:37:\"Promosi hasil laut dan produk olahan.\";s:4:\"body\";s:450:\"Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. \";s:8:\"category\";s:9:\"Perikanan\";s:12:\"published_at\";s:19:\"2025-08-29 09:43:15\";s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-09-25 09:43:15\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:3;s:5:\"title\";s:24:\"Festival Hasil Laut 2024\";s:7:\"excerpt\";s:37:\"Promosi hasil laut dan produk olahan.\";s:4:\"body\";s:450:\"Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. Konten berita. \";s:8:\"category\";s:9:\"Perikanan\";s:12:\"published_at\";s:19:\"2025-08-29 09:43:15\";s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-09-25 09:43:15\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:12:\"published_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:7:\"excerpt\";i:2;s:4:\"body\";i:3;s:8:\"category\";i:4;s:12:\"published_at\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1762499968),
('laravel-cache-home.sectors.count', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:6:{i:0;O:17:\"App\\Models\\Sector\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"sectors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:1;s:4:\"name\";s:9:\"Pertanian\";s:4:\"slug\";s:9:\"pertanian\";s:4:\"icon\";s:8:\"ph:wheat\";s:7:\"summary\";s:37:\"Lahan sawah, jagung, komoditas pangan\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:0;}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:1;s:4:\"name\";s:9:\"Pertanian\";s:4:\"slug\";s:9:\"pertanian\";s:4:\"icon\";s:8:\"ph:wheat\";s:7:\"summary\";s:37:\"Lahan sawah, jagung, komoditas pangan\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:0;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:13:\"display_order\";s:7:\"integer\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:4:\"icon\";i:3;s:7:\"summary\";i:4;s:13:\"display_order\";i:5;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:17:\"App\\Models\\Sector\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"sectors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:2;s:4:\"name\";s:10:\"Perkebunan\";s:4:\"slug\";s:10:\"perkebunan\";s:4:\"icon\";s:7:\"ph:leaf\";s:7:\"summary\";s:37:\"Kelapa, kakao, dan tanaman perkebunan\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:0;}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:2;s:4:\"name\";s:10:\"Perkebunan\";s:4:\"slug\";s:10:\"perkebunan\";s:4:\"icon\";s:7:\"ph:leaf\";s:7:\"summary\";s:37:\"Kelapa, kakao, dan tanaman perkebunan\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:0;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:13:\"display_order\";s:7:\"integer\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:4:\"icon\";i:3;s:7:\"summary\";i:4;s:13:\"display_order\";i:5;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:17:\"App\\Models\\Sector\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"sectors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:3;s:4:\"name\";s:9:\"Perikanan\";s:4:\"slug\";s:9:\"perikanan\";s:4:\"icon\";s:7:\"ph:fish\";s:7:\"summary\";s:20:\"Budidaya dan tangkap\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:0;}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:3;s:4:\"name\";s:9:\"Perikanan\";s:4:\"slug\";s:9:\"perikanan\";s:4:\"icon\";s:7:\"ph:fish\";s:7:\"summary\";s:20:\"Budidaya dan tangkap\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:0;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:13:\"display_order\";s:7:\"integer\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:4:\"icon\";i:3;s:7:\"summary\";i:4;s:13:\"display_order\";i:5;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:17:\"App\\Models\\Sector\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"sectors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:4;s:4:\"name\";s:6:\"Energi\";s:4:\"slug\";s:6:\"energi\";s:4:\"icon\";s:12:\"ph:lightning\";s:7:\"summary\";s:32:\"Energi terbarukan & konvensional\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:2;}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:4;s:4:\"name\";s:6:\"Energi\";s:4:\"slug\";s:6:\"energi\";s:4:\"icon\";s:12:\"ph:lightning\";s:7:\"summary\";s:32:\"Energi terbarukan & konvensional\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:2;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:13:\"display_order\";s:7:\"integer\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:4:\"icon\";i:3;s:7:\"summary\";i:4;s:13:\"display_order\";i:5;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:17:\"App\\Models\\Sector\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"sectors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:5;s:4:\"name\";s:9:\"Kehutanan\";s:4:\"slug\";s:9:\"kehutanan\";s:4:\"icon\";s:7:\"ph:tree\";s:7:\"summary\";s:26:\"Hutan lindung dan produksi\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:0;}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:5;s:4:\"name\";s:9:\"Kehutanan\";s:4:\"slug\";s:9:\"kehutanan\";s:4:\"icon\";s:7:\"ph:tree\";s:7:\"summary\";s:26:\"Hutan lindung dan produksi\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:0;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:13:\"display_order\";s:7:\"integer\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:4:\"icon\";i:3;s:7:\"summary\";i:4;s:13:\"display_order\";i:5;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:5;O:17:\"App\\Models\\Sector\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"sectors\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:11:{s:2:\"id\";i:6;s:4:\"name\";s:12:\"Pertambangan\";s:4:\"slug\";s:12:\"pertambangan\";s:4:\"icon\";s:10:\"ph:pickaxe\";s:7:\"summary\";s:25:\"Galian C dan mineral lain\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:0;}s:11:\"\0*\0original\";a:11:{s:2:\"id\";i:6;s:4:\"name\";s:12:\"Pertambangan\";s:4:\"slug\";s:12:\"pertambangan\";s:4:\"icon\";s:10:\"ph:pickaxe\";s:7:\"summary\";s:25:\"Galian C dan mineral lain\";s:5:\"order\";i:0;s:13:\"display_order\";i:0;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-09-25 09:43:15\";s:10:\"updated_at\";s:19:\"2025-10-11 14:31:07\";s:14:\"villages_count\";i:0;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:9:\"is_active\";s:7:\"boolean\";s:13:\"display_order\";s:7:\"integer\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:4:\"name\";i:1;s:4:\"slug\";i:2;s:4:\"icon\";i:3;s:7:\"summary\";i:4;s:13:\"display_order\";i:5;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1762499968),
('laravel-cache-home.sliders', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:2:{i:0;O:17:\"App\\Models\\Slider\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"sliders\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:1;s:5:\"title\";s:1:\"l\";s:8:\"subtitle\";s:1:\"l\";s:5:\"image\";s:52:\"sliders/Y74pBxQvqMglRjW3PPpTuOrNiL5oRQDCzK45CH8a.jpg\";s:5:\"order\";i:1;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-10-07 05:14:18\";s:10:\"updated_at\";s:19:\"2025-10-16 11:44:29\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:1;s:5:\"title\";s:1:\"l\";s:8:\"subtitle\";s:1:\"l\";s:5:\"image\";s:52:\"sliders/Y74pBxQvqMglRjW3PPpTuOrNiL5oRQDCzK45CH8a.jpg\";s:5:\"order\";i:1;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-10-07 05:14:18\";s:10:\"updated_at\";s:19:\"2025-10-16 11:44:29\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:8:\"subtitle\";i:2;s:5:\"image\";i:3;s:5:\"order\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:17:\"App\\Models\\Slider\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"sliders\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:2;s:5:\"title\";s:2:\"la\";s:8:\"subtitle\";s:2:\"la\";s:5:\"image\";s:52:\"sliders/crOF5jZdlesNRwPk0S3P3wOzSDq0hdsmeODle01L.jpg\";s:5:\"order\";i:2;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-10-07 05:21:37\";s:10:\"updated_at\";s:19:\"2025-10-16 11:44:47\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:2;s:5:\"title\";s:2:\"la\";s:8:\"subtitle\";s:2:\"la\";s:5:\"image\";s:52:\"sliders/crOF5jZdlesNRwPk0S3P3wOzSDq0hdsmeODle01L.jpg\";s:5:\"order\";i:2;s:9:\"is_active\";i:1;s:10:\"created_at\";s:19:\"2025-10-07 05:21:37\";s:10:\"updated_at\";s:19:\"2025-10-16 11:44:47\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:8:\"subtitle\";i:2;s:5:\"image\";i:3;s:5:\"order\";i:4;s:9:\"is_active\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1762499968),
('laravel-cache-home.totals_sda', 'a:6:{s:9:\"pertanian\";O:18:\"App\\Models\\Village\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"villages\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:4:{s:13:\"luas_sawah_ha\";s:4:\"0.00\";s:14:\"luas_jagung_ha\";s:4:\"0.00\";s:20:\"lahan_tadah_hujan_ha\";s:4:\"0.00\";s:12:\"produksi_ton\";s:4:\"0.00\";}s:11:\"\0*\0original\";a:4:{s:13:\"luas_sawah_ha\";s:4:\"0.00\";s:14:\"luas_jagung_ha\";s:4:\"0.00\";s:20:\"lahan_tadah_hujan_ha\";s:4:\"0.00\";s:12:\"produksi_ton\";s:4:\"0.00\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:11:{s:15:\"luas_wilayah_ha\";s:9:\"decimal:2\";s:15:\"jumlah_penduduk\";s:7:\"integer\";s:9:\"pertanian\";s:5:\"array\";s:10:\"perkebunan\";s:5:\"array\";s:9:\"perikanan\";s:5:\"array\";s:10:\"peternakan\";s:5:\"array\";s:6:\"energi\";s:5:\"array\";s:12:\"pertambangan\";s:5:\"array\";s:9:\"kehutanan\";s:5:\"array\";s:16:\"lingkungan_hidup\";s:5:\"array\";s:14:\"data_pendukung\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:9:\"sector_id\";i:1;s:4:\"nama\";i:2;s:9:\"kecamatan\";i:3;s:11:\"kepala_desa\";i:4;s:13:\"kontak_person\";i:5;s:15:\"luas_wilayah_ha\";i:6;s:15:\"jumlah_penduduk\";i:7;s:13:\"kelompok_umkm\";i:8;s:9:\"pertanian\";i:9;s:10:\"perkebunan\";i:10;s:9:\"perikanan\";i:11;s:10:\"peternakan\";i:12;s:6:\"energi\";i:13;s:12:\"pertambangan\";i:14;s:16:\"lingkungan_hidup\";i:15;s:14:\"data_pendukung\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:10:\"perkebunan\";O:18:\"App\\Models\\Village\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"villages\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:7:\"luas_ha\";s:4:\"0.00\";s:16:\"produksi_tahunan\";s:4:\"0.00\";}s:11:\"\0*\0original\";a:2:{s:7:\"luas_ha\";s:4:\"0.00\";s:16:\"produksi_tahunan\";s:4:\"0.00\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:11:{s:15:\"luas_wilayah_ha\";s:9:\"decimal:2\";s:15:\"jumlah_penduduk\";s:7:\"integer\";s:9:\"pertanian\";s:5:\"array\";s:10:\"perkebunan\";s:5:\"array\";s:9:\"perikanan\";s:5:\"array\";s:10:\"peternakan\";s:5:\"array\";s:6:\"energi\";s:5:\"array\";s:12:\"pertambangan\";s:5:\"array\";s:9:\"kehutanan\";s:5:\"array\";s:16:\"lingkungan_hidup\";s:5:\"array\";s:14:\"data_pendukung\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:9:\"sector_id\";i:1;s:4:\"nama\";i:2;s:9:\"kecamatan\";i:3;s:11:\"kepala_desa\";i:4;s:13:\"kontak_person\";i:5;s:15:\"luas_wilayah_ha\";i:6;s:15:\"jumlah_penduduk\";i:7;s:13:\"kelompok_umkm\";i:8;s:9:\"pertanian\";i:9;s:10:\"perkebunan\";i:10;s:9:\"perikanan\";i:11;s:10:\"peternakan\";i:12;s:6:\"energi\";i:13;s:12:\"pertambangan\";i:14;s:16:\"lingkungan_hidup\";i:15;s:14:\"data_pendukung\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:9:\"perikanan\";O:18:\"App\\Models\\Village\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"villages\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:14:\"luas_tambak_ha\";s:4:\"0.00\";s:12:\"produksi_ton\";s:4:\"0.00\";}s:11:\"\0*\0original\";a:2:{s:14:\"luas_tambak_ha\";s:4:\"0.00\";s:12:\"produksi_ton\";s:4:\"0.00\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:11:{s:15:\"luas_wilayah_ha\";s:9:\"decimal:2\";s:15:\"jumlah_penduduk\";s:7:\"integer\";s:9:\"pertanian\";s:5:\"array\";s:10:\"perkebunan\";s:5:\"array\";s:9:\"perikanan\";s:5:\"array\";s:10:\"peternakan\";s:5:\"array\";s:6:\"energi\";s:5:\"array\";s:12:\"pertambangan\";s:5:\"array\";s:9:\"kehutanan\";s:5:\"array\";s:16:\"lingkungan_hidup\";s:5:\"array\";s:14:\"data_pendukung\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:9:\"sector_id\";i:1;s:4:\"nama\";i:2;s:9:\"kecamatan\";i:3;s:11:\"kepala_desa\";i:4;s:13:\"kontak_person\";i:5;s:15:\"luas_wilayah_ha\";i:6;s:15:\"jumlah_penduduk\";i:7;s:13:\"kelompok_umkm\";i:8;s:9:\"pertanian\";i:9;s:10:\"perkebunan\";i:10;s:9:\"perikanan\";i:11;s:10:\"peternakan\";i:12;s:6:\"energi\";i:13;s:12:\"pertambangan\";i:14;s:16:\"lingkungan_hidup\";i:15;s:14:\"data_pendukung\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:6:\"energi\";O:18:\"App\\Models\\Village\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"villages\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:9:\"surya_kwp\";s:6:\"124.15\";s:9:\"angin_kwp\";s:7:\"2353.00\";s:14:\"mikrohidro_kwp\";s:8:\"12434.00\";}s:11:\"\0*\0original\";a:3:{s:9:\"surya_kwp\";s:6:\"124.15\";s:9:\"angin_kwp\";s:7:\"2353.00\";s:14:\"mikrohidro_kwp\";s:8:\"12434.00\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:11:{s:15:\"luas_wilayah_ha\";s:9:\"decimal:2\";s:15:\"jumlah_penduduk\";s:7:\"integer\";s:9:\"pertanian\";s:5:\"array\";s:10:\"perkebunan\";s:5:\"array\";s:9:\"perikanan\";s:5:\"array\";s:10:\"peternakan\";s:5:\"array\";s:6:\"energi\";s:5:\"array\";s:12:\"pertambangan\";s:5:\"array\";s:9:\"kehutanan\";s:5:\"array\";s:16:\"lingkungan_hidup\";s:5:\"array\";s:14:\"data_pendukung\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:9:\"sector_id\";i:1;s:4:\"nama\";i:2;s:9:\"kecamatan\";i:3;s:11:\"kepala_desa\";i:4;s:13:\"kontak_person\";i:5;s:15:\"luas_wilayah_ha\";i:6;s:15:\"jumlah_penduduk\";i:7;s:13:\"kelompok_umkm\";i:8;s:9:\"pertanian\";i:9;s:10:\"perkebunan\";i:10;s:9:\"perikanan\";i:11;s:10:\"peternakan\";i:12;s:6:\"energi\";i:13;s:12:\"pertambangan\";i:14;s:16:\"lingkungan_hidup\";i:15;s:14:\"data_pendukung\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:12:\"pertambangan\";O:18:\"App\\Models\\Village\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"villages\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:1:{s:7:\"luas_ha\";s:4:\"0.00\";}s:11:\"\0*\0original\";a:1:{s:7:\"luas_ha\";s:4:\"0.00\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:11:{s:15:\"luas_wilayah_ha\";s:9:\"decimal:2\";s:15:\"jumlah_penduduk\";s:7:\"integer\";s:9:\"pertanian\";s:5:\"array\";s:10:\"perkebunan\";s:5:\"array\";s:9:\"perikanan\";s:5:\"array\";s:10:\"peternakan\";s:5:\"array\";s:6:\"energi\";s:5:\"array\";s:12:\"pertambangan\";s:5:\"array\";s:9:\"kehutanan\";s:5:\"array\";s:16:\"lingkungan_hidup\";s:5:\"array\";s:14:\"data_pendukung\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:9:\"sector_id\";i:1;s:4:\"nama\";i:2;s:9:\"kecamatan\";i:3;s:11:\"kepala_desa\";i:4;s:13:\"kontak_person\";i:5;s:15:\"luas_wilayah_ha\";i:6;s:15:\"jumlah_penduduk\";i:7;s:13:\"kelompok_umkm\";i:8;s:9:\"pertanian\";i:9;s:10:\"perkebunan\";i:10;s:9:\"perikanan\";i:11;s:10:\"peternakan\";i:12;s:6:\"energi\";i:13;s:12:\"pertambangan\";i:14;s:16:\"lingkungan_hidup\";i:15;s:14:\"data_pendukung\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:9:\"kehutanan\";O:18:\"App\\Models\\Village\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"villages\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:13:\"luas_hutan_ha\";s:4:\"0.00\";s:16:\"luas_mangrove_ha\";s:4:\"0.00\";s:13:\"konservasi_ha\";s:4:\"0.00\";}s:11:\"\0*\0original\";a:3:{s:13:\"luas_hutan_ha\";s:4:\"0.00\";s:16:\"luas_mangrove_ha\";s:4:\"0.00\";s:13:\"konservasi_ha\";s:4:\"0.00\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:11:{s:15:\"luas_wilayah_ha\";s:9:\"decimal:2\";s:15:\"jumlah_penduduk\";s:7:\"integer\";s:9:\"pertanian\";s:5:\"array\";s:10:\"perkebunan\";s:5:\"array\";s:9:\"perikanan\";s:5:\"array\";s:10:\"peternakan\";s:5:\"array\";s:6:\"energi\";s:5:\"array\";s:12:\"pertambangan\";s:5:\"array\";s:9:\"kehutanan\";s:5:\"array\";s:16:\"lingkungan_hidup\";s:5:\"array\";s:14:\"data_pendukung\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:16:{i:0;s:9:\"sector_id\";i:1;s:4:\"nama\";i:2;s:9:\"kecamatan\";i:3;s:11:\"kepala_desa\";i:4;s:13:\"kontak_person\";i:5;s:15:\"luas_wilayah_ha\";i:6;s:15:\"jumlah_penduduk\";i:7;s:13:\"kelompok_umkm\";i:8;s:9:\"pertanian\";i:9;s:10:\"perkebunan\";i:10;s:9:\"perikanan\";i:11;s:10:\"peternakan\";i:12;s:6:\"energi\";i:13;s:12:\"pertambangan\";i:14;s:16:\"lingkungan_hidup\";i:15;s:14:\"data_pendukung\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}', 1762499968);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dinas_sectors`
--

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
(1, 'Andi Saputra', 'Kepala Dinas', '19850101 202001 1 001', 'employees/qXTRkTR4ZZdAp7eDCrqi9ZssEq0Uemv96gHEDAJt.jpg', NULL, '2025-10-06 06:12:23', '2025-10-06 07:19:45'),
(2, 'Siti Rahmawati', 'Sekretaris Dinas', '19900315 202101 2 002', NULL, 1, '2025-10-06 06:12:23', '2025-10-06 06:12:23'),
(3, 'Budi Santoso', 'Staf Administrasi', '19950820 202201 3 003', NULL, 1, '2025-10-06 06:12:23', '2025-10-06 06:12:23'),
(4, 'Andi Saputra', 'Kepala Dinas', '19850101 202001 1 001', NULL, NULL, '2025-10-06 06:14:58', '2025-10-06 06:14:58'),
(5, 'Siti Rahmawati', 'Sekretaris Dinas', '19900315 202101 2 002', NULL, 4, '2025-10-06 06:14:58', '2025-10-06 06:14:58'),
(6, 'Budi Santoso', 'Staf Administrasi', '19950820 202201 3 003', NULL, 4, '2025-10-06 06:14:58', '2025-10-06 06:14:58'),
(7, 'Andi Saputra', 'Kepala Dinas', '19850101 202001 1 001', NULL, NULL, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(8, 'Siti Rahmawati', 'Sekretaris Dinas', '19900315 202101 2 002', NULL, 7, '2025-11-02 17:43:28', '2025-11-02 17:43:28'),
(9, 'Budi Santoso', 'Staf Administrasi', '19950820 202201 3 003', NULL, 7, '2025-11-02 17:43:28', '2025-11-02 17:43:28');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

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
(1, 'Drs. H. Andi Suryana, M.Si.', 'Bupati Kabupaten Suka Maju', 'leaders/99U3uRvq37jxQA3Vrd7jB6TyLxltY7t5fxJCZ4Rh.jpg', 'Mewujudkan Kabupaten Suka Maju yang Sejahtera, Mandiri, dan Berdaya Saing.', '1. Meningkatkan kualitas sumber daya manusia.\n2. Memperkuat tata kelola pemerintahan yang bersih dan transparan.\n3. Mengembangkan ekonomi daerah berbasis potensi lokal.\n4. Meningkatkan pelayanan publik dan kesejahteraan masyarakat.', '2025-10-06 06:14:58', '2025-10-06 07:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `metrics`
--

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
(30, '2025_11_02_181500_create_opd_records_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

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

--
-- Dumping data for table `opd_records`
--

INSERT INTO `opd_records` (`id`, `dinas_sector_id`, `village_id`, `periode_tahun`, `tanggal`, `payload`, `lampiran`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 2, 2025, '2025-11-04', '{\"luas_tanam_padi_ha\":\"100\",\"produksi_padi_ton\":\"500\",\"kejadian_gagal_panen\":\"3\",\"desa_terdampak_kekeringan\":\"14\"}', NULL, 'draft', '2025-11-04 10:01:16', '2025-11-04 10:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `potentials`
--

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
('l2qt7bbDPpCYpXuuLQ1rIA9Vex35Vgyr0G4SX6QE', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTUJQVkxXOXN2VEFKWW1GbGppRzVrNFB3bGcxWlljWmJqUnVTTXViRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wb3RlbnNpIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1762308586),
('vGyItOFM4OS4Eq50flNSq12fFtXRdiHqmEI0NL7C', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOFY3eGxXYWNPbHFQNXo2dEN3cHU4elZ5Smo4MDZkODV1Wk10NXJYRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wb3RlbnNpL29wZC9kaW5hcy1wZXJ0YW5pYW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Njt9', 1762499454);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

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
(1, 'l', 'l', 'sliders/Y74pBxQvqMglRjW3PPpTuOrNiL5oRQDCzK45CH8a.jpg', 1, 1, '2025-10-06 21:14:18', '2025-10-16 03:44:29'),
(2, 'la', 'la', 'sliders/crOF5jZdlesNRwPk0S3P3wOzSDq0hdsmeODle01L.jpg', 2, 1, '2025-10-06 21:21:37', '2025-10-16 03:44:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 'admin@mail.com', 'user', NULL, '$2y$12$xsLzcD1ryZMhoWW04yQ7Puu848QyVWTCrGxLfaNgbV3sdwY382loK', NULL, '2025-09-27 08:21:08', '2025-09-27 08:21:08'),
(5, 'Admin', 'bagas@gmail.com', 'user', NULL, '$2y$12$ZLWl6xocv3qTgJdbJ.gdWeA5qJ9fT7Rc3OrhQlUbjvFRE0fg4XllC', NULL, '2025-09-27 08:24:33', '2025-09-27 08:24:33'),
(6, 'Admin', 'admin@example.com', 'admin', NULL, '$2y$12$Tc3wmRLNFb3/0RxKFoKTP.syy.pI1tKJJy/P7lksIh6Ovj0hWLc/e', NULL, '2025-09-27 08:33:56', '2025-11-02 17:43:28');

-- --------------------------------------------------------

--
-- Table structure for table `villages`
--

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
(1, 4, 'Desa tompo', 'binamu', 'musyary', '081222212212', 100.21, 450, NULL, '{\"luas_sawah_ha\":null,\"luas_jagung_ha\":null,\"lahan_tadah_hujan_ha\":null,\"komoditas_utama\":null,\"produksi_ton\":null,\"permasalahan\":null,\"usulan_program\":null}', '{\"jenis_tanaman\":null,\"luas_ha\":null,\"produksi_tahunan\":null,\"permasalahan\":null,\"usulan_program\":null}', '{\"jenis_usaha\":null,\"luas_tambak_ha\":null,\"produksi_ton\":null,\"jenis_utama\":null,\"permasalahan\":null,\"usulan_program\":null}', '{\"jenis_ternak\":null,\"populasi\":null,\"produksi\":null,\"permasalahan\":null,\"usulan_program\":null}', '{\"potensi_surya_kwp\":\"3.15\",\"potensi_angin_kwp\":\"12\",\"potensi_mikrohidro_kwp\":\"11\",\"potensi_biogas\":\"100\",\"permasalahan\":\"-\",\"usulan_program\":\"-\"}', NULL, '{\"jenis_galian\":null,\"luas_ha\":null,\"status_izin\":null,\"dampak_lingkungan\":null,\"usulan_program\":null}', NULL, NULL, '2025-10-11 10:22:02', '2025-10-11 10:22:02'),
(2, 4, 'ads', 'adsa', 'dfas', 'sdsa', 13.00, 2341, 'ssdadf', '{\"luas_sawah_ha\":null,\"luas_jagung_ha\":null,\"lahan_tadah_hujan_ha\":null,\"komoditas_utama\":null,\"produksi_ton\":null,\"permasalahan\":null,\"usulan_program\":null}', '{\"jenis_tanaman\":null,\"luas_ha\":null,\"produksi_tahunan\":null,\"permasalahan\":null,\"usulan_program\":null}', '{\"jenis_usaha\":null,\"luas_tambak_ha\":null,\"produksi_ton\":null,\"jenis_utama\":null,\"permasalahan\":null,\"usulan_program\":null}', '{\"jenis_ternak\":null,\"populasi\":null,\"produksi\":null,\"permasalahan\":null,\"usulan_program\":null}', '{\"potensi_surya_kwp\":\"121\",\"potensi_angin_kwp\":\"2341\",\"potensi_mikrohidro_kwp\":\"12423\",\"potensi_biogas\":\"1241\",\"permasalahan\":\"-\",\"usulan_program\":\"-\"}', NULL, '{\"jenis_galian\":null,\"luas_ha\":null,\"status_izin\":null,\"dampak_lingkungan\":null,\"usulan_program\":null}', NULL, NULL, '2025-10-11 10:27:58', '2025-10-11 10:27:58');

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dinas_sectors`
--
ALTER TABLE `dinas_sectors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `emergency_reports`
--
ALTER TABLE `emergency_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `metrics`
--
ALTER TABLE `metrics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `opd_records`
--
ALTER TABLE `opd_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `villages`
--
ALTER TABLE `villages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_atasan_id_foreign` FOREIGN KEY (`atasan_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;

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
-- Constraints for table `villages`
--
ALTER TABLE `villages`
  ADD CONSTRAINT `villages_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
