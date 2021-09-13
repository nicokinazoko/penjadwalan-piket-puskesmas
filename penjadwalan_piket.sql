-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2021 at 11:26 AM
-- Server version: 10.4.8-MariaDB-log
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjadwalan_piket`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jabatans`
--

CREATE TABLE `jabatans` (
  `id_jabatan` bigint(20) UNSIGNED NOT NULL,
  `nama_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatans`
--

INSERT INTO `jabatans` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Dokter Umum'),
(2, 'Perawat'),
(3, 'Tata Usaha'),
(4, 'Bidan'),
(5, 'Kesehatan Lingkungan'),
(6, 'Surveillance'),
(7, 'Kesehatan Masyarakat'),
(8, 'Farmasi'),
(9, 'Apoteker'),
(10, 'Analis'),
(11, 'Dokter Gigi'),
(12, 'Perawat Gigi'),
(13, 'Rekam Medis');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kelamins`
--

CREATE TABLE `jenis_kelamins` (
  `id_jenis_kelamin` bigint(20) UNSIGNED NOT NULL,
  `nama_jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_kelamins`
--

INSERT INTO `jenis_kelamins` (`id_jenis_kelamin`, `nama_jenis_kelamin`) VALUES
(1, 'Laki-Laki'),
(2, 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2019_08_19_000000_create_failed_jobs_table', 1),
(12, '2021_07_15_095200_create_pikets_table', 1),
(13, '2021_07_15_095631_create_jenis_kelamins_table', 1),
(14, '2021_07_15_095739_create_jabatans_table', 1),
(15, '2021_07_15_095820_create_pegawais_table', 1),
(16, '2021_07_15_100135_create_penjadwalans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawais`
--

CREATE TABLE `pegawais` (
  `id_pegawai` bigint(20) UNSIGNED NOT NULL,
  `nama_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_jenis_kelamin` bigint(20) UNSIGNED NOT NULL,
  `id_jabatan` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawais`
--

INSERT INTO `pegawais` (`id_pegawai`, `nama_pegawai`, `id_jenis_kelamin`, `id_jabatan`) VALUES
(10, 'dr. Amelia', 2, 1),
(11, 'dr. Dwi Bhakti P', 2, 1),
(12, 'Eni Sudaryati', 2, 2),
(13, 'Nely Puspita', 2, 2),
(14, 'Martiningsih', 2, 1),
(15, 'Endah Lestari', 2, 2),
(16, 'Eni Setioningsih', 2, 2),
(17, 'Margi Yuwono', 1, 2),
(18, 'Ari S', 2, 2),
(19, 'Suripah', 2, 2),
(20, 'Heriyah Safari', 2, 2),
(21, 'Ukhulul', 1, 2),
(22, 'Anisa', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `penjadwalans`
--

CREATE TABLE `penjadwalans` (
  `id_penjadwalans` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` bigint(20) UNSIGNED NOT NULL,
  `id_piket` bigint(20) UNSIGNED NOT NULL,
  `tanggal_penjadwalan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pikets`
--

CREATE TABLE `pikets` (
  `id_piket` bigint(20) UNSIGNED NOT NULL,
  `kode_piket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_piket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pikets`
--

INSERT INTO `pikets` (`id_piket`, `kode_piket`, `nama_piket`) VALUES
(18, 'RPU', 'Ruang Pelayanan Umum'),
(19, 'PCare RPU', 'PCare RPU Ruang Infeksius'),
(21, 'R.Inf', 'Ruang Infeksius'),
(22, 'IVA/PTM', 'Screening IVA/PTM/USPRO'),
(23, 'PB', 'PosBindu'),
(24, 'KR', 'Kunjungan Rumah'),
(25, 'B', 'Bendahara'),
(26, 'Aster', 'Klinik Aster'),
(30, 'Mtbs/RT', 'Manajemen Tata Laksana Balita Sakit - Ruang Tindakan'),
(31, 'Surveillance', 'Surveillance'),
(32, 'SCR', 'Screening'),
(34, 'KKR', 'Kader Kesehatan Remaja'),
(35, 'Prolanis', 'Program Pengelolaan Penyakit Kronis'),
(36, 'LP', 'Rumah Tahanan'),
(37, 'PKD', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jabatans`
--
ALTER TABLE `jabatans`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `jenis_kelamins`
--
ALTER TABLE `jenis_kelamins`
  ADD PRIMARY KEY (`id_jenis_kelamin`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `pegawais_id_jenis_kelamin_foreign` (`id_jenis_kelamin`),
  ADD KEY `pegawais_id_jabatan_foreign` (`id_jabatan`);

--
-- Indexes for table `penjadwalans`
--
ALTER TABLE `penjadwalans`
  ADD PRIMARY KEY (`id_penjadwalans`),
  ADD KEY `penjadwalans_id_pegawai_foreign` (`id_pegawai`),
  ADD KEY `penjadwalans_id_piket_foreign` (`id_piket`);

--
-- Indexes for table `pikets`
--
ALTER TABLE `pikets`
  ADD PRIMARY KEY (`id_piket`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatans`
--
ALTER TABLE `jabatans`
  MODIFY `id_jabatan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jenis_kelamins`
--
ALTER TABLE `jenis_kelamins`
  MODIFY `id_jenis_kelamin` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pegawais`
--
ALTER TABLE `pegawais`
  MODIFY `id_pegawai` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `penjadwalans`
--
ALTER TABLE `penjadwalans`
  MODIFY `id_penjadwalans` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pikets`
--
ALTER TABLE `pikets`
  MODIFY `id_piket` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pegawais`
--
ALTER TABLE `pegawais`
  ADD CONSTRAINT `pegawais_id_jabatan_foreign` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatans` (`id_jabatan`),
  ADD CONSTRAINT `pegawais_id_jenis_kelamin_foreign` FOREIGN KEY (`id_jenis_kelamin`) REFERENCES `jenis_kelamins` (`id_jenis_kelamin`);

--
-- Constraints for table `penjadwalans`
--
ALTER TABLE `penjadwalans`
  ADD CONSTRAINT `penjadwalans_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawais` (`id_pegawai`),
  ADD CONSTRAINT `penjadwalans_id_piket_foreign` FOREIGN KEY (`id_piket`) REFERENCES `pikets` (`id_piket`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
