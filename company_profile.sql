-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jan 2026 pada 11.18
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company_profile`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `certifications`
--

CREATE TABLE `certifications` (
  `certification_id` int(10) UNSIGNED NOT NULL,
  `certification_name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `certifications`
--

INSERT INTO `certifications` (`certification_id`, `certification_name`, `description`, `file`, `created_at`, `updated_at`) VALUES
(5, 'ISO 9001:2015 – Sistem Manajemen Mutu', '<p>Sertifikasi sistem manajemen mutu yang memastikan seluruh proses kerja perusahaan berjalan secara terstruktur, konsisten, dan berorientasi pada kepuasan pelanggan.</p>', 'certifications/SCO6ebXDGsLWmKhmMky3mi5VIwh4hG1vRS3WDUra.jpg', '2026-01-30 09:07:40', '2026-01-30 09:07:40'),
(6, 'ISO 45001:2018 – Sistem Manajemen Keselamatan dan Kesehatan Kerja', '<p>Sertifikasi yang menunjukkan komitmen perusahaan dalam menerapkan sistem keselamatan dan kesehatan kerja guna meminimalisir risiko kecelakaan di lingkungan kerja.</p>', 'certifications/CkpYogE1utnCZ7sSNuwfCdyvfcDpd1Inlscr1wek.jpg', '2026-01-30 09:07:56', '2026-01-30 09:07:56'),
(7, 'Sertifikat Keahlian (SKA) Tenaga Ahli', '<p>Sertifikasi keahlian tenaga profesional yang memastikan sumber daya manusia memiliki kompetensi sesuai bidang konstruksi yang ditangani.</p>', 'certifications/DwJJfTAo1tZSwPFINEAvpyFiLIbHx7GMK1z6mZlA.jpg', '2026-01-30 09:08:14', '2026-01-30 09:08:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `clients`
--

CREATE TABLE `clients` (
  `client_id` int(10) UNSIGNED NOT NULL,
  `client_name` varchar(150) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `clients`
--

INSERT INTO `clients` (`client_id`, `client_name`, `picture`, `description`, `created_at`, `updated_at`) VALUES
(3, 'PT Nusantara Properti Sejahtera', 'clients/4gzLhvZ05P9nxjdL6t4GDWuTG6iVKW8DpWujkBLH.png', '<p>Perusahaan pengembang properti yang berfokus pada pembangunan perumahan dan kawasan komersial dengan standar kualitas dan keamanan yang tinggi.</p>', '2026-01-30 09:03:56', '2026-01-30 09:03:56'),
(4, 'PT Sentra Logistik Indonesia', 'clients/7A1KFxEodqsuz6alpO7ybCOEo5ORe8DKfYKbGd61.png', '<p>Perusahaan logistik nasional yang membutuhkan fasilitas gudang dan bangunan industri yang efisien dan berstandar keselamatan kerja.</p>', '2026-01-30 09:04:23', '2026-01-30 09:04:23'),
(5, 'PT Wisata Alam Nusantara', 'clients/yj3LhhXFuQRupmXF1I5paoAvxz4hkdQswpogdUHV.png', '<p>Perusahaan pengelola kawasan wisata yang berfokus pada pengembangan destinasi wisata keluarga yang aman, nyaman, dan berkelanjutan</p>', '2026-01-30 09:04:47', '2026-01-30 09:04:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `company_profile`
--

CREATE TABLE `company_profile` (
  `profile_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `company_profile`
--

INSERT INTO `company_profile` (`profile_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(2, 'VISI', '<p>saerstdfyugoipo[k[jhutirexwezxrtcvybnmo,popjytcrexwzxtrcyuinompcsdidfhjojhgf7d5sw43qzw45ert7u9i08h7g6f53s23w4e5crvtinui[jg6f56ewesthfghini765d45exrdy hnio6f56de5xrdf ghjhinug6fr6ctd ghj</p>', '2026-01-29 08:21:15', '2026-01-30 08:39:36'),
(3, 'MISI', '<p>sxdcfvgbhnbhvgfcdxszsxdcfvgbhnjhbgvfcdxszasxdcfvgbhnjhbgvfcdxszxdcfvgbhnjmnhbgvfcdxszxdcfvgbhnjhbgvfcdxdcvgbhnjhbgvfcdxcfvgbhn</p>', '2026-01-29 08:44:07', '2026-01-30 08:39:42'),
(4, 'SEJARAH', '<p>wertyuiopiuyterwrtyuiopiuytrewsrdtfyuiop[opiuytrsdaddfghjkljhgfdszxcvcxbvcxgfhjdfghiuytdfghjjhgfghjkl</p>', '2026-01-29 08:50:44', '2026-01-30 08:39:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `content_calendars`
--

CREATE TABLE `content_calendars` (
  `calendar_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `note` text DEFAULT NULL,
  `scheduled_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `content_calendars`
--

INSERT INTO `content_calendars` (`calendar_id`, `title`, `note`, `scheduled_date`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '123456789', '123456789', '2026-03-14', 1, '2026-01-30 02:28:11', '2026-01-30 02:43:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jobs`
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
-- Struktur dari tabel `job_batches`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 2),
(3, '0001_01_01_000002_create_jobs_table', 2),
(4, '2026_01_30_102206_create_visitor_logs_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `news`
--

CREATE TABLE `news` (
  `id_berita` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `isi` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `author` varchar(150) NOT NULL,
  `jenis_berita` varchar(100) NOT NULL,
  `tanggal_publikasi` datetime NOT NULL,
  `tanggal_update` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `news`
--

INSERT INTO `news` (`id_berita`, `judul`, `slug`, `isi`, `image`, `author`, `jenis_berita`, `tanggal_publikasi`, `tanggal_update`, `created_at`, `updated_at`) VALUES
(10, 'PT. DANADIPA BERTU PERKASA Terapkan Sistem Manajemen Integrasi', NULL, '<p>PT. DANADIPA BERTU PERKASA telah menetapkan, menerapkan, memelihara, serta mengembangkan Sistem Manajemen Integrasi ISO 9001:2000 dan OHSAS 18001 untuk memastikan kualitas pekerjaan dan keselamatan kerja di setiap proyek.</p>', 'news/BTEahudvNJBYSHjmwtXk8AFajdASOnS49TDbOYnx.jpg', 'Wawan', 'Berita Perusahaan', '2026-01-30 16:27:45', '2026-01-30 09:27:45', NULL, NULL),
(11, 'Fokus Keselamatan Kerja di Proyek Berkonstruksi', NULL, '<p>Keselamatan kerja menjadi prioritas utama bagi PT. DANADIPA BERTU PERKASA. Setiap proyek dengan risiko tinggi memiliki manager HSE atau K3 untuk meminimalkan angka kecelakaan dan menjamin keamanan pekerja.</p>', 'news/PXLX1MbMoK7L2iEvhiENrSD5Li0omFRp2kfao412.jpg', 'Wawan', 'Berita K3', '2026-01-30 16:28:22', '2026-01-30 09:28:22', NULL, NULL),
(12, 'Standar Kualitas dan Kesehatan Kerja di Proyek Wisata', NULL, '<p>Dalam membangun rumah tinggal, tempat wisata, gudang, dan gedung, PT. DANADIPA BERTU PERKASA memastikan setiap proyek mematuhi standar kualitas tinggi dan prosedur keselamatan kerja sesuai ISO 9001 dan OHSAS 18001.</p>', 'news/RmTP1iWbo6QeYmdkE50z9ngONq9OQ3KoZ0MO6rry.jpg', 'Wawan', 'Berita Proyek', '2026-01-30 16:28:58', '2026-01-30 09:28:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `partners`
--

CREATE TABLE `partners` (
  `partner_id` int(10) UNSIGNED NOT NULL,
  `partner_name` varchar(150) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `partners`
--

INSERT INTO `partners` (`partner_id`, `partner_name`, `logo`, `created_at`, `updated_at`) VALUES
(2, 'PT Baja Konstruksi Nusantara', 'partners/SCE0f68YgIEaS3Nzw2oao1DrLOR7EZYyWxug1BBV.png', '2026-01-30 09:05:29', '2026-01-30 09:05:29'),
(3, 'PT Beton Prima Indonesia', 'partners/eudgZpS32wQ7POeitjDbkTqaKAvOhMzby2i6SFXz.png', '2026-01-30 09:05:41', '2026-01-30 09:05:41'),
(4, 'PT Mandiri Teknik Konsultan', 'partners/mGZrNl2LRub8SEto4uo9YMjHfX4hLJWv2FD2qx1Z.png', '2026-01-30 09:05:52', '2026-01-30 09:05:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `portfolios`
--

CREATE TABLE `portfolios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `projects`
--

CREATE TABLE `projects` (
  `project_id` int(10) UNSIGNED NOT NULL,
  `project_name` varchar(150) NOT NULL,
  `location` varchar(150) NOT NULL,
  `year` year(4) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `location`, `year`, `thumbnail`, `created_at`, `updated_at`) VALUES
(4, 'Pembangunan Rumah Tinggal Dua Lantai', 'Yogyakarta', '2026', 'projects/Vk80ytsjDPt4uFvoDEg2EaDI0Gzy1TOAKEPuN1k0.png', '2026-01-30 08:52:26', '2026-01-30 08:52:26'),
(5, 'Revitalisasi Area Wisata Keluarga', 'Sukabumi, Jawa Barat', '2026', 'projects/kEJSFAhk3YGhzWD50Lba48F81bzkS0vgqCtq0wkb.png', '2026-01-30 08:53:01', '2026-01-30 08:53:01'),
(6, 'Pembangunan Gedung Serbaguna', 'Bandung, Jawa Barat', '2026', 'projects/Fz9YfVCgHSUILA8cr1QfC3sdy6H2WfTyf8etFjeT.png', '2026-01-30 08:53:29', '2026-01-30 08:53:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `project_stories`
--

CREATE TABLE `project_stories` (
  `story_id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `challenge` text NOT NULL,
  `solution` text NOT NULL,
  `result` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `project_stories`
--

INSERT INTO `project_stories` (`story_id`, `project_id`, `challenge`, `solution`, `result`, `created_at`, `updated_at`) VALUES
(3, 6, '<p>Keterbatasan waktu pengerjaan dengan kebutuhan bangunan multifungsi yang harus memenuhi standar keamanan, kenyamanan, serta mampu menampung berbagai aktivitas dalam satu ruang.</p>', '<p>Menerapkan manajemen proyek terintegrasi dengan perencanaan yang matang, penggunaan material berkualitas, serta pengawasan ketat terhadap mutu dan keselamatan kerja (K3) di setiap tahapan pembangunan.</p>', '<p>Gedung serbaguna berhasil diselesaikan tepat waktu, memiliki struktur yang kuat, fleksibel untuk berbagai kegiatan, serta memenuhi standar keselamatan dan kualitas yang ditetapkan.</p>', '2026-01-30 08:55:00', '2026-01-30 08:55:00'),
(4, 5, '<p>Kondisi fasilitas wisata yang sudah lama dan kurang layak sehingga membutuhkan perbaikan tanpa mengganggu lingkungan sekitar dan aktivitas pengunjung.</p>', '<p>Melakukan revitalisasi bertahap dengan desain yang lebih modern dan ramah lingkungan, serta menerapkan sistem keselamatan kerja yang ketat selama proses pembangunan.</p>', '<p>Area wisata tampil lebih menarik, aman, dan nyaman bagi pengunjung, meningkatkan daya tarik wisata serta memberikan dampak positif terhadap jumlah kunjungan.</p>', '2026-01-30 08:55:41', '2026-01-30 08:55:41'),
(5, 4, '<p>Keterbatasan lahan dan kebutuhan desain rumah dua lantai yang kuat, nyaman, serta sesuai dengan anggaran pemilik rumah.</p>', '<p>Mengoptimalkan desain struktur dan tata ruang, pemilihan material yang efisien, serta pelaksanaan pekerjaan yang terkontrol dengan penerapan standar mutu dan K3.</p>', '<p>Rumah tinggal dua lantai terbangun dengan struktur yang kokoh, desain fungsional, nyaman dihuni, serta sesuai dengan rencana anggaran dan waktu yang ditentukan.</p>', '2026-01-30 08:56:10', '2026-01-30 08:56:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(2, 'admin'),
(1, 'pengunjung'),
(3, 'pimpinan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `service_id` int(10) UNSIGNED NOT NULL,
  `service_name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `description`, `icon`, `created_at`, `updated_at`) VALUES
(5, 'Jasa Konstruksi Gedung', '<p>Menyediakan layanan pembangunan gedung komersial dan non-komersial dengan standar mutu tinggi, mulai dari perencanaan, pelaksanaan, hingga serah terima proyek sesuai spesifikasi teknis dan waktu yang disepakati.</p>', 'services/fswXz1F4GsqQ7HKZZVVu6VsxXe3DMuGxIxvJIP5q.jpg', '2026-01-30 08:47:57', '2026-01-30 08:47:57'),
(6, 'Konsultasi Teknis Konstruksi', '<p>Memberikan layanan konsultasi teknis terkait perencanaan konstruksi, analisis struktur, serta penerapan standar mutu dan keselamatan kerja.</p>', 'services/EIFIDNIgujMQLgZQsV3iAi7XngeVpkgzKi4KmrC7.png', '2026-01-30 08:48:43', '2026-01-30 08:48:43'),
(7, 'Pembangunan Rumah Tinggal', '<p>Layanan pembangunan rumah tinggal yang mengutamakan kualitas struktur, kenyamanan, serta keselamatan kerja dengan penerapan sistem manajemen mutu dan K3 yang terintegrasi.</p>', 'services/iUZaFpu8bv1zZxrrMZlOhfetpRQFynl0wLyrpsKq.png', '2026-01-30 08:49:09', '2026-01-30 08:49:09'),
(8, 'Renovasi dan Rehabilitasi Bangunan', '<p>Menyediakan layanan renovasi dan perbaikan bangunan lama untuk meningkatkan fungsi, keamanan, dan nilai estetika sesuai kebutuhan klien.</p>', 'services/kFdw3SwKLAjELn5SoW5UccwFFDgcOBSJBusUeb95.png', '2026-01-30 08:49:32', '2026-01-30 08:49:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trust_boosters`
--

CREATE TABLE `trust_boosters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role_id`, `status_created_at`, `created_at`, `updated_at`) VALUES
(1, 'Wawan', 'waw@gmail.com', '$2y$12$0iYIeBWNPdTYapGgsCiQ.eyfjVCS97KKRChS54o.MFdkwSt/KavQK', 2, '2026-01-29 03:18:07', '2026-01-29 03:18:07', '2026-01-29 03:18:07'),
(2, 'Leader', 'leader@gmail.com', '$2y$12$v5zylBDFXVygJaxzVc9BKekju8INIer81ayKgazPuVJ09imTc6WH.', 3, '2026-01-30 04:02:57', '2026-01-30 04:02:57', '2026-01-30 04:02:57'),
(3, 'Admin123', 'admin123@gmail.com', '$2y$12$iqy10.Wjb6fXNMCo2rDtm.qha.jUf0G5JciMD2nGyC.rKpPCWnOYK', 2, '2026-01-30 10:08:02', '2026-01-30 10:08:02', '2026-01-30 10:08:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `visitor_logs`
--

CREATE TABLE `visitor_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `url` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `visitor_logs`
--

INSERT INTO `visitor_logs` (`id`, `ip_address`, `url`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', '_visitor-test', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 03:53:30', '2026-01-30 03:53:30'),
(2, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 03:53:45', '2026-01-30 03:53:45'),
(3, '127.0.0.1', 'proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 03:55:47', '2026-01-30 03:55:47'),
(4, '127.0.0.1', 'trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 03:55:48', '2026-01-30 03:55:48'),
(5, '127.0.0.1', 'services', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 03:55:49', '2026-01-30 03:55:49'),
(6, '127.0.0.1', 'proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 03:55:54', '2026-01-30 03:55:54'),
(7, '127.0.0.1', 'proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 03:55:55', '2026-01-30 03:55:55'),
(8, '127.0.0.1', 'proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 03:55:56', '2026-01-30 03:55:56'),
(9, '127.0.0.1', 'contact', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 03:56:13', '2026-01-30 03:56:13'),
(10, '127.0.0.1', 'news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 03:56:15', '2026-01-30 03:56:15'),
(11, '127.0.0.1', 'news/8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 03:56:18', '2026-01-30 03:56:18'),
(12, '127.0.0.1', 'news/4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 03:56:20', '2026-01-30 03:56:20'),
(13, '127.0.0.1', 'pimpinan/login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 04:11:07', '2026-01-30 04:11:07'),
(14, '127.0.0.1', 'pimpinan/login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 04:12:15', '2026-01-30 04:12:15'),
(15, '127.0.0.1', 'pimpinan/login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 04:12:21', '2026-01-30 04:12:21'),
(16, '127.0.0.1', 'pimpinan/login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 04:12:21', '2026-01-30 04:12:21'),
(17, '127.0.0.1', 'pimpinan/login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 04:13:00', '2026-01-30 04:13:00'),
(18, '127.0.0.1', 'pimpinan/login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 04:13:01', '2026-01-30 04:13:01'),
(19, '127.0.0.1', 'pimpinan/login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 04:14:08', '2026-01-30 04:14:08'),
(20, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 04:14:09', '2026-01-30 04:14:09'),
(21, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 04:15:17', '2026-01-30 04:15:17'),
(22, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 04:17:11', '2026-01-30 04:17:11'),
(23, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 04:19:32', '2026-01-30 04:19:32'),
(24, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 04:21:01', '2026-01-30 04:21:01'),
(25, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 04:22:28', '2026-01-30 04:22:28'),
(26, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 04:22:31', '2026-01-30 04:22:31'),
(27, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 04:22:33', '2026-01-30 04:22:33'),
(28, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 04:22:51', '2026-01-30 04:22:51'),
(29, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 04:23:38', '2026-01-30 04:23:38'),
(30, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 04:25:56', '2026-01-30 04:25:56'),
(31, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 05:43:01', '2026-01-30 05:43:01'),
(32, '127.0.0.1', 'company-profile', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 05:43:44', '2026-01-30 05:43:44'),
(33, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 05:43:47', '2026-01-30 05:43:47'),
(34, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 05:50:40', '2026-01-30 05:50:40'),
(35, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 05:50:41', '2026-01-30 05:50:41'),
(36, '127.0.0.1', 'company-profile', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 06:09:28', '2026-01-30 06:09:28'),
(37, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 06:09:38', '2026-01-30 06:09:38'),
(38, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 06:09:46', '2026-01-30 06:09:46'),
(39, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:07:13', '2026-01-30 07:07:13'),
(40, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:07:15', '2026-01-30 07:07:15'),
(41, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:07:20', '2026-01-30 07:07:20'),
(42, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:23:39', '2026-01-30 07:23:39'),
(43, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:23:57', '2026-01-30 07:23:57'),
(44, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:28:52', '2026-01-30 07:28:52'),
(45, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:29:45', '2026-01-30 07:29:45'),
(46, '127.0.0.1', '/company-profile', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:29:46', '2026-01-30 07:29:46'),
(47, '127.0.0.1', '/services', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:29:48', '2026-01-30 07:29:48'),
(48, '127.0.0.1', '/proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:29:49', '2026-01-30 07:29:49'),
(49, '127.0.0.1', '/trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:29:49', '2026-01-30 07:29:49'),
(50, '127.0.0.1', '/news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:29:50', '2026-01-30 07:29:50'),
(51, '127.0.0.1', '/contact', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:29:51', '2026-01-30 07:29:51'),
(52, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:36:30', '2026-01-30 07:36:30'),
(53, '127.0.0.1', 'news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:45:56', '2026-01-30 07:45:56'),
(54, '127.0.0.1', 'news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:45:58', '2026-01-30 07:45:58'),
(55, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:47:29', '2026-01-30 07:47:29'),
(56, '127.0.0.1', 'pimpinan/login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:47:32', '2026-01-30 07:47:32'),
(57, '127.0.0.1', 'pimpinan/login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:47:38', '2026-01-30 07:47:38'),
(58, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:47:38', '2026-01-30 07:47:38'),
(59, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:47:42', '2026-01-30 07:47:42'),
(60, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:47:45', '2026-01-30 07:47:45'),
(61, '127.0.0.1', 'trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:47:49', '2026-01-30 07:47:49'),
(62, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:47:52', '2026-01-30 07:47:52'),
(63, '127.0.0.1', 'trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:50:40', '2026-01-30 07:50:40'),
(64, '127.0.0.1', 'trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:51:31', '2026-01-30 07:51:31'),
(65, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:51:33', '2026-01-30 07:51:33'),
(66, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:51:35', '2026-01-30 07:51:35'),
(67, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:51:39', '2026-01-30 07:51:39'),
(68, '127.0.0.1', 'pimpinan/login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:51:42', '2026-01-30 07:51:42'),
(69, '127.0.0.1', 'pimpinan/login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:51:50', '2026-01-30 07:51:50'),
(70, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:51:50', '2026-01-30 07:51:50'),
(71, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:51:54', '2026-01-30 07:51:54'),
(72, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:51:54', '2026-01-30 07:51:54'),
(73, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:51:55', '2026-01-30 07:51:55'),
(74, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:51:55', '2026-01-30 07:51:55'),
(75, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:52:02', '2026-01-30 07:52:02'),
(76, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:52:03', '2026-01-30 07:52:03'),
(77, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:52:04', '2026-01-30 07:52:04'),
(78, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:52:05', '2026-01-30 07:52:05'),
(79, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:52:07', '2026-01-30 07:52:07'),
(80, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:53:46', '2026-01-30 07:53:46'),
(81, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:53:46', '2026-01-30 07:53:46'),
(82, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 07:53:47', '2026-01-30 07:53:47'),
(83, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:07:19', '2026-01-30 08:07:19'),
(84, '127.0.0.1', '/proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:07:20', '2026-01-30 08:07:20'),
(85, '127.0.0.1', '/trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:07:20', '2026-01-30 08:07:20'),
(86, '127.0.0.1', '/contact', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:07:21', '2026-01-30 08:07:21'),
(87, '127.0.0.1', '/news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:07:22', '2026-01-30 08:07:22'),
(88, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:07:23', '2026-01-30 08:07:23'),
(89, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:07:49', '2026-01-30 08:07:49'),
(90, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:08:28', '2026-01-30 08:08:28'),
(91, '127.0.0.1', 'pimpinan/login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:08:31', '2026-01-30 08:08:31'),
(92, '127.0.0.1', 'pimpinan/login', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:08:35', '2026-01-30 08:08:35'),
(93, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:08:36', '2026-01-30 08:08:36'),
(94, '127.0.0.1', 'pimpinan/dashboard', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:08:37', '2026-01-30 08:08:37'),
(95, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:08:43', '2026-01-30 08:08:43'),
(96, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:11:10', '2026-01-30 08:11:10'),
(97, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:11:11', '2026-01-30 08:11:11'),
(98, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:11:17', '2026-01-30 08:11:17'),
(99, '127.0.0.1', '/proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:19:18', '2026-01-30 08:19:18'),
(100, '127.0.0.1', '/trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:19:18', '2026-01-30 08:19:18'),
(101, '127.0.0.1', '/news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:19:19', '2026-01-30 08:19:19'),
(102, '127.0.0.1', '/contact', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:19:20', '2026-01-30 08:19:20'),
(103, '127.0.0.1', '/services', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:24:15', '2026-01-30 08:24:15'),
(104, '127.0.0.1', '/services', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:24:24', '2026-01-30 08:24:24'),
(105, '127.0.0.1', '/company-profile', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:24:25', '2026-01-30 08:24:25'),
(106, '127.0.0.1', '/services', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:24:26', '2026-01-30 08:24:26'),
(107, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:27:20', '2026-01-30 08:27:20'),
(108, '127.0.0.1', '/company-profile', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:27:21', '2026-01-30 08:27:21'),
(109, '127.0.0.1', '/services', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:27:22', '2026-01-30 08:27:22'),
(110, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:36:19', '2026-01-30 08:36:19'),
(111, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:36:20', '2026-01-30 08:36:20'),
(112, '127.0.0.1', '/company-profile', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:37:39', '2026-01-30 08:37:39'),
(113, '127.0.0.1', '/company-profile', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:39:57', '2026-01-30 08:39:57'),
(114, '127.0.0.1', '/company-profile', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:40:40', '2026-01-30 08:40:40'),
(115, '127.0.0.1', '/services', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:40:47', '2026-01-30 08:40:47'),
(116, '127.0.0.1', '/services', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:48:12', '2026-01-30 08:48:12'),
(117, '127.0.0.1', '/services', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:49:34', '2026-01-30 08:49:34'),
(118, '127.0.0.1', '/company-profile', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:49:54', '2026-01-30 08:49:54'),
(119, '127.0.0.1', '/services', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:49:55', '2026-01-30 08:49:55'),
(120, '127.0.0.1', '/proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:49:56', '2026-01-30 08:49:56'),
(121, '127.0.0.1', '/proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:53:32', '2026-01-30 08:53:32'),
(122, '127.0.0.1', '/proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:55:06', '2026-01-30 08:55:06'),
(123, '127.0.0.1', '/proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:56:13', '2026-01-30 08:56:13'),
(124, '127.0.0.1', '/proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:57:45', '2026-01-30 08:57:45'),
(125, '127.0.0.1', '/proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:57:47', '2026-01-30 08:57:47'),
(126, '127.0.0.1', '/proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:57:54', '2026-01-30 08:57:54'),
(127, '127.0.0.1', '/proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:57:56', '2026-01-30 08:57:56'),
(128, '127.0.0.1', '/proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 08:58:10', '2026-01-30 08:58:10'),
(129, '127.0.0.1', '/proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:00:24', '2026-01-30 09:00:24'),
(130, '127.0.0.1', '/proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:00:58', '2026-01-30 09:00:58'),
(131, '127.0.0.1', '/proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:02:28', '2026-01-30 09:02:28'),
(132, '127.0.0.1', '/services', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:02:29', '2026-01-30 09:02:29'),
(133, '127.0.0.1', '/proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:02:30', '2026-01-30 09:02:30'),
(134, '127.0.0.1', '/trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:02:31', '2026-01-30 09:02:31'),
(135, '127.0.0.1', '/trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:03:59', '2026-01-30 09:03:59'),
(136, '127.0.0.1', '/trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:08:18', '2026-01-30 09:08:18'),
(137, '127.0.0.1', '/trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:10:36', '2026-01-30 09:10:36'),
(138, '127.0.0.1', '/trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:14:57', '2026-01-30 09:14:57'),
(139, '127.0.0.1', '/trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:16:17', '2026-01-30 09:16:17'),
(140, '127.0.0.1', '/trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:18:30', '2026-01-30 09:18:30'),
(141, '127.0.0.1', '/trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:19:16', '2026-01-30 09:19:16'),
(142, '127.0.0.1', '/trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:20:09', '2026-01-30 09:20:09'),
(143, '127.0.0.1', '/news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:20:26', '2026-01-30 09:20:26'),
(144, '127.0.0.1', '/news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:20:38', '2026-01-30 09:20:38'),
(145, '127.0.0.1', '/news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:20:42', '2026-01-30 09:20:42'),
(146, '127.0.0.1', '/news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:20:45', '2026-01-30 09:20:45'),
(147, '127.0.0.1', '/trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:20:46', '2026-01-30 09:20:46'),
(148, '127.0.0.1', '/news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:20:47', '2026-01-30 09:20:47'),
(149, '127.0.0.1', '/contact', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:20:48', '2026-01-30 09:20:48'),
(150, '127.0.0.1', '/news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:20:50', '2026-01-30 09:20:50'),
(151, '127.0.0.1', '/trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:20:57', '2026-01-30 09:20:57'),
(152, '127.0.0.1', '/news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:21:07', '2026-01-30 09:21:07'),
(153, '127.0.0.1', '/news/8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:21:19', '2026-01-30 09:21:19'),
(154, '127.0.0.1', '/news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:21:23', '2026-01-30 09:21:23'),
(155, '127.0.0.1', '/news/8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:21:41', '2026-01-30 09:21:41'),
(156, '127.0.0.1', '/news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:23:03', '2026-01-30 09:23:03'),
(157, '127.0.0.1', '/news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:23:18', '2026-01-30 09:23:18'),
(158, '127.0.0.1', '/news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:23:36', '2026-01-30 09:23:36'),
(159, '127.0.0.1', '/news/8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:23:40', '2026-01-30 09:23:40'),
(160, '127.0.0.1', '/news/8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:24:47', '2026-01-30 09:24:47'),
(161, '127.0.0.1', '/news/8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:29:01', '2026-01-30 09:29:01'),
(162, '127.0.0.1', '/news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:29:03', '2026-01-30 09:29:03'),
(163, '127.0.0.1', '/news/11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:29:07', '2026-01-30 09:29:07'),
(164, '127.0.0.1', '/news/12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:29:14', '2026-01-30 09:29:14'),
(165, '127.0.0.1', '/news/10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:29:19', '2026-01-30 09:29:19'),
(166, '127.0.0.1', '/news/11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:29:36', '2026-01-30 09:29:36'),
(167, '127.0.0.1', '/news/11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:30:12', '2026-01-30 09:30:12'),
(168, '127.0.0.1', '/news/12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:30:15', '2026-01-30 09:30:15'),
(169, '127.0.0.1', '/news/10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:30:16', '2026-01-30 09:30:16'),
(170, '127.0.0.1', '/news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:30:25', '2026-01-30 09:30:25'),
(171, '127.0.0.1', '/contact', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:30:27', '2026-01-30 09:30:27'),
(172, '127.0.0.1', '/trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:30:29', '2026-01-30 09:30:29'),
(173, '127.0.0.1', '/news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:30:30', '2026-01-30 09:30:30'),
(174, '127.0.0.1', '/trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:30:31', '2026-01-30 09:30:31'),
(175, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:30:33', '2026-01-30 09:30:33'),
(176, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:31:47', '2026-01-30 09:31:47'),
(177, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:33:41', '2026-01-30 09:33:41'),
(178, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:33:59', '2026-01-30 09:33:59'),
(179, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:34:16', '2026-01-30 09:34:16'),
(180, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:34:54', '2026-01-30 09:34:54'),
(181, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:35:32', '2026-01-30 09:35:32'),
(182, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:35:42', '2026-01-30 09:35:42'),
(183, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:35:48', '2026-01-30 09:35:48'),
(184, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:36:55', '2026-01-30 09:36:55'),
(185, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:37:14', '2026-01-30 09:37:14'),
(186, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:37:57', '2026-01-30 09:37:57'),
(187, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:40:03', '2026-01-30 09:40:03'),
(188, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:41:14', '2026-01-30 09:41:14'),
(189, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:44:10', '2026-01-30 09:44:10'),
(190, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:45:16', '2026-01-30 09:45:16'),
(191, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:47:37', '2026-01-30 09:47:37'),
(192, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:49:46', '2026-01-30 09:49:46'),
(193, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:50:45', '2026-01-30 09:50:45'),
(194, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:50:52', '2026-01-30 09:50:52'),
(195, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:51:04', '2026-01-30 09:51:04'),
(196, '127.0.0.1', '/services', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:51:07', '2026-01-30 09:51:07'),
(197, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:51:11', '2026-01-30 09:51:11'),
(198, '127.0.0.1', '/services', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:51:20', '2026-01-30 09:51:20'),
(199, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:51:50', '2026-01-30 09:51:50'),
(200, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:53:08', '2026-01-30 09:53:08'),
(201, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:54:09', '2026-01-30 09:54:09'),
(202, '127.0.0.1', '/news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:54:25', '2026-01-30 09:54:25'),
(203, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:55:55', '2026-01-30 09:55:55'),
(204, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:58:36', '2026-01-30 09:58:36'),
(205, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:58:48', '2026-01-30 09:58:48'),
(206, '127.0.0.1', '/proyek-stories', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:59:32', '2026-01-30 09:59:32'),
(207, '127.0.0.1', '/trust-booster', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:59:36', '2026-01-30 09:59:36'),
(208, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 09:59:41', '2026-01-30 09:59:41'),
(209, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 10:18:05', '2026-01-30 10:18:05'),
(210, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 10:18:17', '2026-01-30 10:18:17'),
(211, '127.0.0.1', '/news', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 10:18:19', '2026-01-30 10:18:19'),
(212, '127.0.0.1', '/contact', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 10:18:21', '2026-01-30 10:18:21'),
(213, '127.0.0.1', '/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-01-30 10:18:23', '2026-01-30 10:18:23');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`certification_id`);

--
-- Indeks untuk tabel `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indeks untuk tabel `company_profile`
--
ALTER TABLE `company_profile`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indeks untuk tabel `content_calendars`
--
ALTER TABLE `content_calendars`
  ADD PRIMARY KEY (`calendar_id`),
  ADD KEY `fk_content_calendars_users` (`created_by`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id_berita`),
  ADD UNIQUE KEY `news_judul_unique` (`judul`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indeks untuk tabel `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`partner_id`);

--
-- Indeks untuk tabel `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indeks untuk tabel `project_stories`
--
ALTER TABLE `project_stories`
  ADD PRIMARY KEY (`story_id`),
  ADD KEY `fk_project_stories_projects` (`project_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indeks untuk tabel `trust_boosters`
--
ALTER TABLE `trust_boosters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeks untuk tabel `visitor_logs`
--
ALTER TABLE `visitor_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_ip_address` (`ip_address`),
  ADD KEY `idx_url` (`url`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `certifications`
--
ALTER TABLE `certifications`
  MODIFY `certification_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `company_profile`
--
ALTER TABLE `company_profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `content_calendars`
--
ALTER TABLE `content_calendars`
  MODIFY `calendar_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `news`
--
ALTER TABLE `news`
  MODIFY `id_berita` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `partners`
--
ALTER TABLE `partners`
  MODIFY `partner_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `project_stories`
--
ALTER TABLE `project_stories`
  MODIFY `story_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `trust_boosters`
--
ALTER TABLE `trust_boosters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `visitor_logs`
--
ALTER TABLE `visitor_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `content_calendars`
--
ALTER TABLE `content_calendars`
  ADD CONSTRAINT `fk_content_calendars_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `project_stories`
--
ALTER TABLE `project_stories`
  ADD CONSTRAINT `fk_project_stories_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
