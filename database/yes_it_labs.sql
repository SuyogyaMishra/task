-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2025 at 08:31 AM
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
-- Database: `yes_it_labs`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '2025_10_28_173117_create_user_documents_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(2, 'Shivasnhi Dyan', 'shi@gmail.com', '6386369558', '2025-10-28 23:18:02', '2025-10-29 01:58:05'),
(3, 'Rahul', 'sm@gmail.com', 'fvgbhnj', '2025-10-28 23:18:47', '2025-10-29 00:11:20'),
(4, 'user3', 'us3@gmail.com', '6386369558', '2025-10-29 00:33:34', '2025-10-29 00:33:34'),
(5, 'gbn', 'cvbnm@gmial.com', '6386369958', '2025-10-29 00:36:16', '2025-10-29 00:36:16'),
(6, 'fghjmk', 'dfvgbhnjm@gmail.com', '6386369558', '2025-10-29 00:36:50', '2025-10-29 00:36:50'),
(7, 'dfghnjmk,l.;', 'dcfvgbhnjm@gmail.com', '898989563', '2025-10-29 00:38:06', '2025-10-29 00:38:06'),
(8, 'ssdcfvgbhnjmk,', 'xdcfvgbnm@gmai', '5595488866', '2025-10-29 00:38:32', '2025-10-29 00:38:32'),
(9, 'dfvgbhnm,', 'sxcdvfbn@gmail.com', '5656565666', '2025-10-29 00:39:17', '2025-10-29 00:39:17'),
(10, 'dcvbnm,', 'cvbnm@gmail.com', '5455151111', '2025-10-29 00:40:12', '2025-10-29 00:40:12'),
(12, 'hhh', 'ss@gmail.com', 'q', '2025-10-29 01:52:42', '2025-10-29 01:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `user_documents`
--

CREATE TABLE `user_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_type` enum('profile_pic','resume','other') NOT NULL DEFAULT 'other',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_documents`
--

INSERT INTO `user_documents` (`id`, `user_id`, `file_path`, `file_name`, `file_type`, `created_at`, `updated_at`) VALUES
(3, 2, 'profile_pics/SAy4Vjt3WmCFWZBhAlfJVz9EYxwwawJLLE7drQIF.png', 'ChatGPT Image Oct 17, 2025, 01_17_13 PM.png', 'profile_pic', '2025-10-28 23:18:02', '2025-10-28 23:18:02'),
(4, 2, 'resumes/J0BBZBJTnxiox0giNlwSHL2Y1OTFGrtci1j7LjNo.pdf', 'marksheet.pdf', 'resume', '2025-10-28 23:18:02', '2025-10-28 23:18:02'),
(5, 3, 'profile_pics/cxNjX6xMq9UpCPzOKDKz72aUJ5TrG04GbKNtxghA.jpg', 'suyogya.jpg', 'profile_pic', '2025-10-28 23:18:47', '2025-10-28 23:18:47'),
(6, 3, 'resumes/7ejyj6tgkZlfBRtYOIe9Anxe0HhmcGrYnxNYiwHa.pdf', 'marksheet.pdf', 'resume', '2025-10-28 23:18:47', '2025-10-28 23:18:47'),
(7, 4, 'profile_pics/VQOJ01pOMpy2zjtR70vdlJGuBs7DmnHxQHjvq6vQ.png', 'ChatGPT Image Oct 15, 2025, 10_24_09 PM.png', 'profile_pic', '2025-10-29 00:33:34', '2025-10-29 00:33:34'),
(8, 4, 'resumes/EYmV5gWbd4NLhQTDVODYJJ8zhMuews6Li95hSCzc.pdf', 'users_2025-10-29_05-52-02.pdf', 'resume', '2025-10-29 00:33:34', '2025-10-29 00:33:34'),
(9, 5, 'profile_pics/OCIhsVLwv0BvaP0y6gk6uCjj0DuosUrOpxIXCgcn.jpg', 'Screenshot_20240912_131833_Paytm.jpg', 'profile_pic', '2025-10-29 00:36:16', '2025-10-29 00:36:16'),
(10, 5, 'resumes/yTjsCFTWynrF2E6lSOd3gQ5E0jhsuu8MtK2QAyG7.pdf', 'users_2025-10-29_05-52-02.pdf', 'resume', '2025-10-29 00:36:16', '2025-10-29 00:36:16'),
(11, 6, 'profile_pics/ELXdtwCWwKKx2bz1yKJw4nxGziBuF5GyFfsNVG0n.png', 'ChatGPT Image Oct 16, 2025, 04_56_23 PM.png', 'profile_pic', '2025-10-29 00:36:50', '2025-10-29 00:36:50'),
(12, 6, 'resumes/l6bBOSdrFj4nNeLP1cbKv6qcIClPocMh2hgKA5wa.pdf', 'users_2025-10-29_05-52-02.pdf', 'resume', '2025-10-29 00:36:50', '2025-10-29 00:36:50'),
(13, 7, 'profile_pics/Bcx1HtdywLZXrFpQNHlWE5kYOsQZrnVsax0E6c23.png', 'ChatGPT Image Oct 16, 2025, 04_56_23 PM.png', 'profile_pic', '2025-10-29 00:38:06', '2025-10-29 00:38:06'),
(14, 7, 'resumes/465oS6cx6OG2bIFYO2KX3cHL9NmD8IxMhDX1NPKX.pdf', 'users_2025-10-29_05-52-07.pdf', 'resume', '2025-10-29 00:38:06', '2025-10-29 00:38:06'),
(15, 8, 'profile_pics/UZDpuNJxHlMcbBabXB2jyiZwjC5vIshqa0R76fev.bmp', 'DCOM.bmp', 'profile_pic', '2025-10-29 00:38:32', '2025-10-29 00:38:32'),
(16, 8, 'resumes/bf2UQ5GF0d33RT0GxGzFMp54OhV8tv4MWAsN6SeM.pdf', 'users_2025-10-29_05-52-02.pdf', 'resume', '2025-10-29 00:38:32', '2025-10-29 00:38:32'),
(17, 9, 'profile_pics/M95iLvylhx86D3gpoKl5EsDfefnPNIfmYDx72fsn.jpg', 'suyogya.jpg', 'profile_pic', '2025-10-29 00:39:17', '2025-10-29 00:39:17'),
(18, 9, 'resumes/pTYyYCusRHCTk3RGRA9D90xGrM7WHdApWfQPLyw4.pdf', 'users_2025-10-29_05-52-07.pdf', 'resume', '2025-10-29 00:39:17', '2025-10-29 00:39:17'),
(19, 10, 'profile_pics/9Nddz5p3VGtfBNEGuOnIQzw0vWhV799iqf3rAzrF.jpg', 'img_bg_4.jpg', 'profile_pic', '2025-10-29 00:40:12', '2025-10-29 00:40:12'),
(20, 10, 'resumes/KLM7O92o8rGoAFFm27NKlS1jxtDYOLr13GRmWC7c.pdf', 'marksheet_23 (2).pdf', 'resume', '2025-10-29 00:40:12', '2025-10-29 00:40:12'),
(23, 12, 'profile_pics/VWdQGrLZQzzf4wS771Tp1UyF8aEmzvtXiYS4YOTs.png', 'image-removebg-preview.png', 'profile_pic', '2025-10-29 01:52:42', '2025-10-29 01:52:42'),
(24, 12, 'resumes/zNc3gGlyfcSD4tFw4apAozfskGMVBK8aURGMGr4t.pdf', 'users_2025-10-29_05-52-02.pdf', 'resume', '2025-10-29 01:52:42', '2025-10-29 01:52:42');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_documents_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_documents`
--
ALTER TABLE `user_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD CONSTRAINT `user_documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
