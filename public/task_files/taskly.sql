-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2021 at 10:31 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taskly`
--

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `status_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'FFBF00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `status_name`, `status_color`, `created_at`, `updated_at`) VALUES
(1, 'pending', '#FFBF00', '2021-11-04 00:31:59', '2021-11-04 00:31:59'),
(2, 'process', '#4682B4', '2021-11-04 00:31:59', '2021-11-04 00:32:30'),
(3, 'approve', '#1b3bde', '2021-11-04 00:31:59', '2021-11-04 00:35:43'),
(4, 'complete', '#4CBB17', '2021-11-04 00:31:59', '2021-11-04 00:31:59'),
(5, 'reject', '#C21807', '2021-11-04 00:31:59', '2021-11-04 00:35:43');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_10_27_072012_create_roles_table', 1),
(6, '2021_10_27_072443_create_permissions_table', 1),
(7, '2021_10_29_053848_create_projects_table', 1),
(14, '2021_11_02_100625_create_task_files_table', 3),
(19, '2021_10_30_111350_create_colors_table', 4),
(20, '2021_10_29_054724_create_tasks_table', 5);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'role', NULL, NULL),
(2, 'users', NULL, NULL),
(3, 'projects', NULL, NULL),
(4, 'tasks', NULL, NULL),
(5, 'settings', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `deadline`, `created_at`, `updated_at`) VALUES
(1, 'ecommerce', 'online shopping facilities', '2021-11-02', '2021-11-02 02:04:09', '2021-11-02 02:04:09'),
(2, 'check project', 'this project is just for checking purpose only', '2021-12-31', '2021-11-04 03:44:34', '2021-11-04 03:44:55');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`permissions_id`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `description`, `permissions_id`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'manage all functionalites', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', '2021-11-02 01:48:32', '2021-11-02 01:48:32'),
(2, 'task manager', 'create, add, delete task.', '[\"4\"]', '2021-11-02 02:00:02', '2021-11-02 02:00:02'),
(6, 'check', 'role for cheching purpose only', '\"NA\"', '2021-11-04 03:31:38', '2021-11-04 03:31:38');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `pending_date` datetime DEFAULT NULL,
  `process_date` datetime DEFAULT NULL,
  `approve_date` datetime DEFAULT NULL,
  `complete_date` datetime DEFAULT NULL,
  `reject_date` datetime DEFAULT NULL,
  `deadline` datetime NOT NULL,
  `parent_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `description`, `project_id`, `user_id`, `status`, `pending_date`, `process_date`, `approve_date`, `complete_date`, `reject_date`, `deadline`, `parent_id`, `created_at`, `updated_at`) VALUES
(5, 'checking attachments', 'retrieving and downloading task attachments.', 2, 5, 3, '2021-11-04 09:41:09', '2021-11-05 07:59:54', '2021-11-05 08:00:53', '2021-11-05 08:00:17', NULL, '2021-11-04 00:00:00', 0, '2021-11-04 04:41:09', '2021-11-05 03:00:53'),
(6, 'check task', 'cehck all files types', 2, 5, 1, '2021-11-05 08:37:42', '2021-11-05 08:29:58', NULL, '2021-11-05 08:30:11', NULL, '2021-11-05 00:00:00', 0, '2021-11-05 01:29:28', '2021-11-05 03:37:42');

-- --------------------------------------------------------

--
-- Table structure for table `task_files`
--

CREATE TABLE `task_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_files`
--

INSERT INTO `task_files` (`id`, `file_name`, `task_id`, `created_at`, `updated_at`) VALUES
(1, '8th semester fees.pdf', 7, '2021-11-02 05:27:54', '2021-11-02 05:27:54'),
(2, 'profile_image.jpg', 7, '2021-11-02 05:27:54', '2021-11-02 05:27:54'),
(3, 'zuhaib ali.docx', 7, '2021-11-02 05:27:55', '2021-11-02 05:27:55'),
(4, 'zuhaib ali.pdf', 7, '2021-11-02 05:27:55', '2021-11-02 05:27:55'),
(5, 'zuhaib ali.docx', 8, '2021-11-02 05:45:30', '2021-11-02 05:45:30'),
(6, 'zuhaib ali.pdf', 1, '2021-11-03 04:39:37', '2021-11-03 04:39:37'),
(7, 'zuhaib ali.docx', 5, '2021-11-04 04:41:10', '2021-11-04 04:41:10'),
(8, 'zuhaib ali.pdf', 5, '2021-11-04 04:41:10', '2021-11-04 04:41:10'),
(9, '8th semester fees.pdf', 6, '2021-11-05 01:29:28', '2021-11-05 01:29:28'),
(10, 'ApnDaa1QTe61V0lcgJgN_135-2.jpg', 6, '2021-11-05 01:29:28', '2021-11-05 01:29:28'),
(11, 'Capture1.PNG', 6, '2021-11-05 01:29:28', '2021-11-05 01:29:28'),
(12, 'gbsproje_ac.sql', 6, '2021-11-05 01:29:28', '2021-11-05 01:29:28'),
(13, 'gbsproje_ac.sql', 5, '2021-11-05 02:26:55', '2021-11-05 02:26:55'),
(14, 'gbsproje_gbs_taskly.sql', 5, '2021-11-05 02:26:55', '2021-11-05 02:26:55'),
(15, 'users.sql', 5, '2021-11-05 02:26:55', '2021-11-05 02:26:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `img`, `first_name`, `last_name`, `address`, `email`, `password`, `role_id`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '1635835754_zuhaib_zuhaib.jpg', 'zuhaib', 'zuhaib', 'hakra muhalla, ali khan, kamber', 'admin@admin.com', '$2y$10$mXdbah969.bfK6dnvqRureZ/UNqYESmxcLNiYAeBLzmFi.TxFx9Lm', 1, NULL, NULL, '2021-11-02 01:49:15', '2021-11-02 01:49:15'),
(3, NULL, 'task', 'manager', 'gbs hyderabad', 'taskmanager@gmail.com', '$2y$10$nf6NkTV6z9Sqzj.ohP34gOIMyNbGoiJcphS6LYS3R7tVawqUrFZMK', 2, NULL, NULL, '2021-11-02 02:44:35', '2021-11-02 02:44:35'),
(5, NULL, 'user', 'check', NULL, 'checking@gmail.com', '$2y$10$Kn4QT9Y27nj0LbIFNzFALOdo2.Wwn5Ds1G3KbW7V/2gR8cKVtKYzm', 6, NULL, NULL, '2021-11-04 03:33:47', '2021-11-04 03:33:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_files`
--
ALTER TABLE `task_files`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `task_files`
--
ALTER TABLE `task_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
