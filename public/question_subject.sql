-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 30, 2018 at 11:19 AM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.0.22-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `E-Pratiyogi`
--

-- --------------------------------------------------------

--
-- Table structure for table `question_subject`
--

CREATE TABLE `question_subject` (
  `question_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_subject`
--

INSERT INTO `question_subject` (`question_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(35, 1, NULL, NULL),
(2, 1, NULL, NULL),
(3, 1, NULL, NULL),
(4, 1, NULL, NULL),
(5, 1, NULL, NULL),
(6, 1, NULL, NULL),
(7, 1, NULL, NULL),
(11, 1, NULL, NULL),
(12, 1, NULL, NULL),
(13, 1, NULL, NULL),
(14, 1, NULL, NULL),
(15, 1, NULL, NULL),
(16, 1, NULL, NULL),
(17, 1, NULL, NULL),
(18, 1, NULL, NULL),
(19, 1, NULL, NULL),
(20, 1, NULL, NULL),
(21, 1, NULL, NULL),
(22, 1, NULL, NULL),
(23, 1, NULL, NULL),
(24, 1, NULL, NULL),
(25, 1, NULL, NULL),
(26, 1, NULL, NULL),
(27, 1, NULL, NULL),
(28, 1, NULL, NULL),
(29, 1, NULL, NULL),
(30, 1, NULL, NULL),
(31, 1, NULL, NULL),
(32, 1, NULL, NULL),
(33, 1, NULL, NULL),
(34, 1, NULL, NULL),
(35, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `question_subject`
--
ALTER TABLE `question_subject`
  ADD KEY `question_subject_question_id_index` (`question_id`),
  ADD KEY `question_subject_subject_id_index` (`subject_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `question_subject`
--
ALTER TABLE `question_subject`
  ADD CONSTRAINT `question_subject_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `question_subject_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
