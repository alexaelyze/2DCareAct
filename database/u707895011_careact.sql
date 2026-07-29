-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 29, 2026 at 06:21 AM
-- Server version: 11.8.8-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u707895011_careact`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `action` text DEFAULT NULL,
  `page` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `role`, `action`, `page`, `created_at`) VALUES
(1, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-05 14:52:18'),
(2, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-05 14:53:00'),
(3, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-05 14:54:57'),
(4, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-05 14:58:45'),
(5, 12, 'user', 'Visited Home Page', 'home.php', '2026-05-07 01:48:47'),
(6, 12, 'user', 'Visited Home Page', 'home.php', '2026-05-07 01:49:28'),
(7, 12, 'user', 'Visited Home Page', 'home.php', '2026-05-07 01:54:21'),
(8, 12, 'user', 'Visited Home Page', 'home.php', '2026-05-07 01:54:49'),
(9, 12, 'user', 'Completed vitals quiz (Score: 27%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-07 01:57:47'),
(10, 12, 'user', 'Completed mobility quiz (Score: 46%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-07 02:02:40'),
(11, 13, 'user', 'Visited Home Page', 'home.php', '2026-05-07 02:03:20'),
(12, 13, 'user', 'Visited Home Page', 'home.php', '2026-05-08 03:01:42'),
(13, 13, 'user', 'Visited Home Page', 'home.php', '2026-05-08 03:06:02'),
(14, 13, 'user', 'Visited Home Page', 'home.php', '2026-05-08 03:06:37'),
(15, 14, 'user', 'Visited Home Page', 'home.php', '2026-05-08 06:15:34'),
(16, 14, 'user', 'Visited Home Page', 'home.php', '2026-05-08 06:16:40'),
(17, 15, 'user', 'Visited Home Page', 'home.php', '2026-05-08 10:13:40'),
(18, 15, 'user', 'Visited Home Page', 'home.php', '2026-05-08 10:13:47'),
(19, 15, 'user', 'Visited Home Page', 'home.php', '2026-05-08 10:13:59'),
(20, 17, 'user', 'Visited Home Page', 'home.php', '2026-05-08 10:53:48'),
(21, 17, 'user', 'Visited Home Page', 'home.php', '2026-05-08 10:54:23'),
(22, 17, 'user', 'Visited Home Page', 'home.php', '2026-05-08 10:55:35'),
(23, 17, 'user', 'Completed vitals quiz (Score: 87%, Mistakes: 2, Status: Competent)', 'quiz', '2026-05-08 10:57:44'),
(24, 17, 'user', 'Completed vitalsignsimulation (Score: 7%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-08 10:58:49'),
(25, 17, 'user', 'Completed vitalsignsimulation (Score: 7%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-08 10:59:35'),
(26, 18, 'user', 'Visited Home Page', 'home.php', '2026-05-08 11:01:25'),
(27, 17, 'user', 'Completed cpr quiz (Score: 100%, Mistakes: 0, Status: Competent)', 'quiz', '2026-05-08 11:01:44'),
(28, 17, 'user', 'Completed mobility quiz (Score: 35%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-08 11:03:22'),
(29, 18, 'user', 'Completed cpr quiz (Score: 93%, Mistakes: 1, Status: Competent)', 'quiz', '2026-05-08 11:05:19'),
(30, 18, 'user', 'Visited Home Page', 'home.php', '2026-05-08 11:05:57'),
(31, 17, 'user', 'Completed mobility quiz (Score: 81%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-08 11:07:37'),
(32, 19, 'user', 'Visited Home Page', 'home.php', '2026-05-08 11:47:28'),
(33, 21, 'user', 'Visited Home Page', 'home.php', '2026-05-08 14:05:55'),
(34, 21, 'user', 'Completed vitals quiz (Score: 7%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-08 14:12:44'),
(35, 21, 'user', 'Completed vitals quiz (Score: 33%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-08 14:14:07'),
(36, 21, 'user', 'Completed vitals quiz (Score: 100%, Mistakes: 0, Status: Competent)', 'quiz', '2026-05-08 14:16:38'),
(37, 21, 'user', 'Completed vitalsignsimulation (Score: 0%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-08 14:17:48'),
(38, 21, 'user', 'Completed vitalsignsimulation (Score: 0%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-08 14:19:03'),
(39, 21, 'user', 'Completed vitalsignsimulation (Score: 7%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-08 14:21:23'),
(40, 21, 'user', 'Completed vitalsignsimulation (Score: 7%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-08 14:21:47'),
(41, 21, 'user', 'Completed cpr quiz (Score: 100%, Mistakes: 0, Status: Competent)', 'quiz', '2026-05-08 14:27:41'),
(42, 31, 'user', 'Visited Home Page', 'home.php', '2026-05-09 05:49:00'),
(43, 31, 'user', 'Visited Home Page', 'home.php', '2026-05-09 05:50:31'),
(44, 31, 'user', 'Visited Home Page', 'home.php', '2026-05-09 05:51:02'),
(45, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-09 08:13:02'),
(46, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-09 08:13:04'),
(47, 34, 'user', 'Visited Home Page', 'home.php', '2026-05-09 11:52:30'),
(48, 34, 'user', 'Completed vitals quiz (Score: 87%, Mistakes: 2, Status: Competent)', 'quiz', '2026-05-09 11:53:51'),
(49, 34, 'user', 'Completed vitalsignsimulation (Score: 100%, Mistakes: 2, Status: Competent)', 'simulation', '2026-05-09 11:54:21'),
(50, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-09 11:56:46'),
(51, 1, 'user', 'Completed vitals quiz (Score: 93%, Mistakes: 1, Status: Competent)', 'quiz', '2026-05-09 11:57:47'),
(52, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-09 11:58:04'),
(53, 1, 'user', 'Completed cpr quiz (Score: 100%, Mistakes: 0, Status: Competent)', 'quiz', '2026-05-09 11:59:31'),
(54, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-09 11:59:33'),
(55, 35, 'user', 'Visited Home Page', 'home.php', '2026-05-09 12:01:57'),
(56, 35, 'user', 'Visited Home Page', 'home.php', '2026-05-09 12:02:15'),
(57, 36, 'user', 'Visited Home Page', 'home.php', '2026-05-09 13:09:48'),
(58, 36, 'user', 'Visited Home Page', 'home.php', '2026-05-09 13:12:02'),
(59, 31, 'user', 'Visited Home Page', 'home.php', '2026-05-09 14:57:24'),
(60, 37, 'user', 'Visited Home Page', 'home.php', '2026-05-09 15:41:52'),
(61, 38, 'user', 'Visited Home Page', 'home.php', '2026-05-09 15:43:46'),
(62, 38, 'user', 'Visited Home Page', 'home.php', '2026-05-09 15:44:16'),
(63, 38, 'user', 'Visited Home Page', 'home.php', '2026-05-09 15:44:22'),
(64, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:19:48'),
(65, 42, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:22:26'),
(66, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:27:56'),
(67, 42, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:28:34'),
(68, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:29:25'),
(69, 43, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:30:19'),
(70, 41, 'user', 'Completed vitals quiz (Score: 100%, Mistakes: 0, Status: Competent)', 'quiz', '2026-05-10 10:31:39'),
(71, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:31:47'),
(72, 44, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:32:46'),
(73, 44, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:33:06'),
(74, 31, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:34:33'),
(75, 43, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:35:07'),
(76, 43, 'user', 'Completed vitals quiz (Score: 7%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 10:36:22'),
(77, 45, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:36:28'),
(78, 45, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:36:38'),
(79, 45, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:37:16'),
(80, 45, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:37:23'),
(81, 45, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:37:55'),
(82, 44, 'user', 'Completed vitals quiz (Score: 87%, Mistakes: 2, Status: Competent)', 'quiz', '2026-05-10 10:39:59'),
(83, 44, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:40:21'),
(84, 44, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:40:33'),
(85, 41, 'user', 'Completed mobility quiz (Score: 92%, Mistakes: 2, Status: Competent)', 'quiz', '2026-05-10 10:40:42'),
(86, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:40:52'),
(87, 44, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:40:58'),
(88, 46, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:43:54'),
(89, 46, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:44:12'),
(90, 46, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:44:18'),
(91, 44, 'user', 'Completed cpr quiz (Score: 93%, Mistakes: 1, Status: Competent)', 'quiz', '2026-05-10 10:46:41'),
(92, 44, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:46:46'),
(93, 44, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:47:28'),
(94, 44, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:47:36'),
(95, 44, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:47:43'),
(96, 46, 'user', 'Completed vitals quiz (Score: 40%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 10:48:32'),
(97, 44, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:48:39'),
(98, 41, 'user', 'Completed hygiene quiz (Score: 100%, Mistakes: 0, Status: Competent)', 'quiz', '2026-05-10 10:48:47'),
(99, 44, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:49:01'),
(100, 42, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:49:38'),
(101, 41, 'user', 'Completed vitalsignsimulation (Score: 0%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 10:50:39'),
(102, 47, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:51:19'),
(103, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:51:19'),
(104, 46, 'user', 'Completed vitals quiz (Score: 87%, Mistakes: 2, Status: Competent)', 'quiz', '2026-05-10 10:51:25'),
(105, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:52:12'),
(106, 46, 'user', 'Completed vitalsignsimulation (Score: 0%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 10:53:12'),
(107, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:53:48'),
(108, 46, 'user', 'Completed vitalsignsimulation (Score: 0%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 10:54:14'),
(109, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:54:48'),
(110, 44, 'user', 'Completed infant quiz (Score: 88%, Mistakes: 2, Status: Competent)', 'quiz', '2026-05-10 10:55:32'),
(111, 44, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:55:44'),
(112, 46, 'user', 'Completed cpr quiz (Score: 27%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 10:57:47'),
(113, 44, 'user', 'Completed hygiene quiz (Score: 38%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 10:58:34'),
(114, 44, 'user', 'Visited Home Page', 'home.php', '2026-05-10 10:58:39'),
(115, 44, 'user', 'Completed hygiene quiz (Score: 44%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 11:02:53'),
(116, 44, 'user', 'Visited Home Page', 'home.php', '2026-05-10 11:02:55'),
(117, 46, 'user', 'Visited Home Page', 'home.php', '2026-05-10 11:06:26'),
(118, 46, 'user', 'Completed cpr quiz (Score: 33%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 11:08:07'),
(119, 46, 'user', 'Completed cpr quiz (Score: 53%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 11:10:12'),
(120, 46, 'user', 'Completed cpr quiz (Score: 100%, Mistakes: 0, Status: Competent)', 'quiz', '2026-05-10 11:12:12'),
(121, 46, 'user', 'Visited Home Page', 'home.php', '2026-05-10 11:12:52'),
(122, 47, 'user', 'Completed vitals quiz (Score: 53%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 11:15:00'),
(123, 47, 'user', 'Completed vitalsignsimulation (Score: 7%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:17:00'),
(124, 46, 'user', 'Completed vitalsignsimulation (Score: 20%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:17:09'),
(125, 46, 'user', 'Completed vitalsignsimulation (Score: 20%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:18:38'),
(126, 46, 'user', 'Completed vitalsignsimulation (Score: 20%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:20:15'),
(127, 47, 'user', 'Completed cpr quiz (Score: 93%, Mistakes: 1, Status: Competent)', 'quiz', '2026-05-10 11:21:36'),
(128, 46, 'user', 'Completed cpr_simulation (Score: 15%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:21:48'),
(129, 46, 'user', 'Completed cpr_simulation (Score: 23%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:23:12'),
(130, 47, 'user', 'Completed cpr_simulation (Score: 100%, Mistakes: 2, Status: Competent)', 'simulation', '2026-05-10 11:24:05'),
(131, 46, 'user', 'Completed cpr_simulation (Score: 69%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:25:03'),
(132, 46, 'user', 'Completed cpr_simulation (Score: 100%, Mistakes: 1, Status: Competent)', 'simulation', '2026-05-10 11:26:19'),
(133, 47, 'user', 'Completed mobility quiz (Score: 46%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 11:27:30'),
(134, 46, 'user', 'Completed vitalsignsimulation (Score: 27%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:27:59'),
(135, 47, 'user', 'Completed mobilitysimulation (Score: 17%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:28:53'),
(136, 46, 'user', 'Completed vitalsignsimulation (Score: 40%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:29:02'),
(137, 46, 'user', 'Completed vitalsignsimulation (Score: 100%, Mistakes: 1, Status: Competent)', 'simulation', '2026-05-10 11:31:20'),
(138, 47, 'user', 'Completed infant quiz (Score: 50%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 11:31:26'),
(139, 43, 'user', 'Visited Home Page', 'home.php', '2026-05-10 11:31:30'),
(140, 47, 'user', 'Completed infantsimulation (Score: 11%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:32:20'),
(141, 46, 'user', 'Completed cpr_simulation (Score: 100%, Mistakes: 1, Status: Competent)', 'simulation', '2026-05-10 11:33:04'),
(142, 43, 'user', 'Visited Home Page', 'home.php', '2026-05-10 11:33:28'),
(143, 47, 'user', 'Completed hygiene quiz (Score: 88%, Mistakes: 2, Status: Competent)', 'quiz', '2026-05-10 11:34:44'),
(144, 48, 'user', 'Visited Home Page', 'home.php', '2026-05-10 11:34:53'),
(145, 47, 'user', 'Completed hygienesimulation (Score: 60%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:35:50'),
(146, 47, 'user', 'Visited Home Page', 'home.php', '2026-05-10 11:36:00'),
(147, 47, 'user', 'Completed vitalsignsimulation (Score: 20%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:36:56'),
(148, 48, 'user', 'Completed vitals quiz (Score: 20%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 11:37:43'),
(149, 48, 'user', 'Visited Home Page', 'home.php', '2026-05-10 11:38:16'),
(150, 43, 'user', 'Completed vitals quiz (Score: 53%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 11:38:55'),
(151, 43, 'user', 'Completed vitalsignsimulation (Score: 0%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:41:36'),
(152, 46, 'user', 'Completed mobility quiz (Score: 81%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 11:43:03'),
(153, 48, 'user', 'Completed vitals quiz (Score: 100%, Mistakes: 0, Status: Competent)', 'quiz', '2026-05-10 11:43:13'),
(154, 43, 'user', 'Completed cpr quiz (Score: 40%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 11:44:25'),
(155, 46, 'user', 'Visited Home Page', 'home.php', '2026-05-10 11:45:48'),
(156, 43, 'user', 'Completed cpr_simulation (Score: 23%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:47:11'),
(157, 46, 'user', 'Completed mobilitysimulation (Score: 17%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:47:40'),
(158, 48, 'user', 'Completed mobility quiz (Score: 58%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 11:48:05'),
(159, 46, 'user', 'Completed mobilitysimulation (Score: 17%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:48:31'),
(160, 43, 'user', 'Completed mobility quiz (Score: 15%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 11:49:26'),
(161, 47, 'user', 'Visited Home Page', 'home.php', '2026-05-10 11:49:28'),
(162, 46, 'user', 'Completed mobilitysimulation (Score: 50%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:49:56'),
(163, 43, 'user', 'Completed mobilitysimulation (Score: 8%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:50:30'),
(164, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 11:50:39'),
(165, 46, 'user', 'Completed mobilitysimulation (Score: 58%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:51:14'),
(166, 42, 'user', 'Visited Home Page', 'home.php', '2026-05-10 11:51:44'),
(167, 43, 'user', 'Completed hygienesimulation (Score: 40%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:52:38'),
(168, 46, 'user', 'Completed mobilitysimulation (Score: 75%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:52:48'),
(169, 43, 'user', 'Completed hygiene quiz (Score: 19%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 11:53:08'),
(170, 43, 'user', 'Completed infant quiz (Score: 19%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 11:53:33'),
(171, 43, 'user', 'Completed mobilitysimulation (Score: 8%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:53:58'),
(172, 46, 'user', 'Completed mobilitysimulation (Score: 100%, Mistakes: 2, Status: Competent)', 'simulation', '2026-05-10 11:54:12'),
(173, 43, 'user', 'Completed hygienesimulation (Score: 30%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:54:12'),
(174, 43, 'user', 'Visited Home Page', 'home.php', '2026-05-10 11:54:15'),
(175, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 11:54:19'),
(176, 46, 'user', 'Visited Home Page', 'home.php', '2026-05-10 11:54:54'),
(177, 44, 'user', 'Visited Home Page', 'home.php', '2026-05-10 11:57:09'),
(178, 43, 'user', 'Completed infant quiz (Score: 6%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 11:57:26'),
(179, 43, 'user', 'Completed cpr quiz (Score: 33%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 11:57:56'),
(180, 43, 'user', 'Visited Home Page', 'home.php', '2026-05-10 11:58:17'),
(181, 43, 'user', 'Completed infantsimulation (Score: 0%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 11:59:17'),
(182, 43, 'user', 'Visited Home Page', 'home.php', '2026-05-10 11:59:34'),
(183, 43, 'user', 'Visited Home Page', 'home.php', '2026-05-10 12:00:26'),
(184, 44, 'user', 'Completed mobility quiz (Score: 42%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 12:02:29'),
(185, 44, 'user', 'Visited Home Page', 'home.php', '2026-05-10 12:02:31'),
(186, 43, 'user', 'Completed vitals quiz (Score: 13%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 12:03:33'),
(187, 44, 'user', 'Completed mobility quiz (Score: 77%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 12:07:48'),
(188, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 12:21:31'),
(189, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 12:22:42'),
(190, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 12:23:02'),
(191, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 12:23:29'),
(192, 41, 'user', 'Completed infant quiz (Score: 63%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 12:25:30'),
(193, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 12:25:34'),
(194, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 12:26:17'),
(195, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 12:26:43'),
(196, 41, 'user', 'Completed infant quiz (Score: 88%, Mistakes: 2, Status: Competent)', 'quiz', '2026-05-10 12:29:08'),
(197, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 12:29:14'),
(198, 41, 'user', 'Completed cpr quiz (Score: 33%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 12:32:10'),
(199, 41, 'user', 'Completed cpr quiz (Score: 80%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 12:34:18'),
(200, 41, 'user', 'Completed cpr quiz (Score: 100%, Mistakes: 0, Status: Competent)', 'quiz', '2026-05-10 12:35:30'),
(201, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 12:36:21'),
(202, 41, 'user', 'Completed vitalsignsimulation (Score: 7%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 12:37:25'),
(203, 41, 'user', 'Completed vitalsignsimulation (Score: 7%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 12:37:54'),
(204, 41, 'user', 'Completed vitalsignsimulation (Score: 20%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 12:39:01'),
(205, 41, 'user', 'Completed vitalsignsimulation (Score: 20%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 12:40:14'),
(206, 41, 'user', 'Completed vitalsignsimulation (Score: 20%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 12:41:45'),
(207, 41, 'user', 'Completed vitalsignsimulation (Score: 20%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 12:42:08'),
(208, 41, 'user', 'Completed vitalsignsimulation (Score: 20%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 12:42:48'),
(209, 41, 'user', 'Completed vitalsignsimulation (Score: 27%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 12:43:24'),
(210, 41, 'user', 'Completed vitalsignsimulation (Score: 40%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 12:44:18'),
(211, 41, 'user', 'Completed vitalsignsimulation (Score: 40%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 12:49:31'),
(212, 41, 'user', 'Completed vitalsignsimulation (Score: 47%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 12:50:09'),
(213, 41, 'user', 'Completed vitalsignsimulation (Score: 40%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 12:50:40'),
(214, 41, 'user', 'Completed vitalsignsimulation (Score: 100%, Mistakes: 2, Status: Competent)', 'simulation', '2026-05-10 12:52:58'),
(215, 41, 'user', 'Completed mobilitysimulation (Score: 8%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 12:53:58'),
(216, 41, 'user', 'Completed infantsimulation (Score: 78%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 12:55:30'),
(217, 42, 'user', 'Visited Home Page', 'home.php', '2026-05-10 12:56:26'),
(218, 41, 'user', 'Completed infantsimulation (Score: 89%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 12:57:04'),
(219, 41, 'user', 'Completed infantsimulation (Score: 89%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 12:57:58'),
(220, 42, 'user', 'Visited Home Page', 'home.php', '2026-05-10 12:58:35'),
(221, 41, 'user', 'Completed infantsimulation (Score: 100%, Mistakes: 2, Status: Competent)', 'simulation', '2026-05-10 12:58:44'),
(222, 42, 'user', 'Visited Home Page', 'home.php', '2026-05-10 12:58:49'),
(223, 41, 'user', 'Completed cpr_simulation (Score: 100%, Mistakes: 2, Status: Competent)', 'simulation', '2026-05-10 12:59:59'),
(224, 41, 'user', 'Completed hygienesimulation (Score: 70%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 13:00:51'),
(225, 41, 'user', 'Completed hygienesimulation (Score: 100%, Mistakes: 2, Status: Competent)', 'simulation', '2026-05-10 13:01:35'),
(226, 41, 'user', 'Completed mobilitysimulation (Score: 17%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 13:02:04'),
(227, 41, 'user', 'Completed mobilitysimulation (Score: 17%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 13:02:24'),
(228, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 13:03:07'),
(229, 51, 'user', 'Visited Home Page', 'home.php', '2026-05-10 13:16:38'),
(230, 51, 'user', 'Completed vitals quiz (Score: 20%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 13:28:25'),
(231, 51, 'user', 'Completed vitalsignsimulation (Score: 0%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 13:29:30'),
(232, 51, 'user', 'Completed cpr quiz (Score: 93%, Mistakes: 1, Status: Competent)', 'quiz', '2026-05-10 13:34:51'),
(233, 51, 'user', 'Completed vitalsignsimulation (Score: 7%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 13:36:00'),
(234, 51, 'user', 'Completed cpr_simulation (Score: 69%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 13:37:56'),
(235, 51, 'user', 'Completed mobility quiz (Score: 35%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 13:41:07'),
(236, 51, 'user', 'Completed cpr_simulation (Score: 23%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 13:41:36'),
(237, 51, 'user', 'Completed cpr_simulation (Score: 69%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 13:42:38'),
(238, 51, 'user', 'Completed cpr_simulation (Score: 100%, Mistakes: 1, Status: Competent)', 'simulation', '2026-05-10 13:43:26'),
(239, 51, 'user', 'Visited Home Page', 'home.php', '2026-05-10 13:52:54'),
(240, 51, 'user', 'Completed mobility quiz (Score: 46%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 13:57:25'),
(241, 51, 'user', 'Completed mobility quiz (Score: 77%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-10 14:01:14'),
(242, 51, 'user', 'Completed mobility quiz (Score: 92%, Mistakes: 2, Status: Competent)', 'quiz', '2026-05-10 14:05:35'),
(243, 51, 'user', 'Completed mobilitysimulation (Score: 42%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 14:07:32'),
(244, 51, 'user', 'Completed mobilitysimulation (Score: 17%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 14:08:17'),
(245, 51, 'user', 'Visited Home Page', 'home.php', '2026-05-10 14:14:28'),
(246, 48, 'user', 'Visited Home Page', 'home.php', '2026-05-10 14:23:55'),
(247, 48, 'user', 'Visited Home Page', 'home.php', '2026-05-10 14:25:37'),
(248, 41, 'user', 'Completed infant quiz (Score: 100%, Mistakes: 0, Status: Competent)', 'quiz', '2026-05-10 14:30:09'),
(249, 41, 'user', 'Completed mobility quiz (Score: 100%, Mistakes: 0, Status: Competent)', 'quiz', '2026-05-10 14:42:20'),
(250, 41, 'user', 'Completed vitalsignsimulation (Score: 100%, Mistakes: 0, Status: Competent)', 'simulation', '2026-05-10 14:44:27'),
(251, 41, 'user', 'Completed hygienesimulation (Score: 100%, Mistakes: 0, Status: Competent)', 'simulation', '2026-05-10 14:45:32'),
(252, 41, 'user', 'Completed cpr_simulation (Score: 100%, Mistakes: 0, Status: Competent)', 'simulation', '2026-05-10 14:47:10'),
(253, 41, 'user', 'Completed infantsimulation (Score: 100%, Mistakes: 2, Status: Competent)', 'simulation', '2026-05-10 14:48:13'),
(254, 41, 'user', 'Completed infantsimulation (Score: 100%, Mistakes: 1, Status: Competent)', 'simulation', '2026-05-10 14:49:05'),
(255, 41, 'user', 'Completed infantsimulation (Score: 100%, Mistakes: 0, Status: Competent)', 'simulation', '2026-05-10 14:49:42'),
(256, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 14:50:12'),
(257, 41, 'user', 'Completed mobilitysimulation (Score: 17%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 14:50:42'),
(258, 41, 'user', 'Completed mobilitysimulation (Score: 58%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 14:51:50'),
(259, 41, 'user', 'Completed mobilitysimulation (Score: 92%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 14:53:13'),
(260, 41, 'user', 'Completed mobilitysimulation (Score: 92%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 14:56:04'),
(261, 41, 'user', 'Completed mobilitysimulation (Score: 92%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-10 14:57:05'),
(262, 41, 'user', 'Completed mobilitysimulation (Score: 100%, Mistakes: 1, Status: Competent)', 'simulation', '2026-05-10 14:57:35'),
(263, 41, 'user', 'Completed mobilitysimulation (Score: 100%, Mistakes: 0, Status: Competent)', 'simulation', '2026-05-10 14:58:10'),
(264, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 14:59:24'),
(265, 41, 'user', 'Visited Home Page', 'home.php', '2026-05-10 15:03:10'),
(266, 53, 'user', 'Visited Home Page', 'home.php', '2026-05-10 19:26:51'),
(267, 53, 'user', 'Visited Home Page', 'home.php', '2026-05-10 19:28:53'),
(268, 54, 'user', 'Visited Home Page', 'home.php', '2026-05-11 00:30:42'),
(269, 54, 'user', 'Visited Home Page', 'home.php', '2026-05-11 00:30:55'),
(270, 54, 'user', 'Visited Home Page', 'home.php', '2026-05-11 00:31:16'),
(271, 55, 'user', 'Visited Home Page', 'home.php', '2026-05-11 06:27:59'),
(272, 56, 'user', 'Visited Home Page', 'home.php', '2026-05-11 08:12:58'),
(273, 57, 'user', 'Visited Home Page', 'home.php', '2026-05-11 10:43:53'),
(274, 57, 'user', 'Completed vitals quiz (Score: 20%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-11 10:46:38'),
(275, 57, 'user', 'Completed vitals quiz (Score: 93%, Mistakes: 1, Status: Competent)', 'quiz', '2026-05-11 10:48:42'),
(276, 58, 'user', 'Visited Home Page', 'home.php', '2026-05-11 10:49:22'),
(277, 59, 'user', 'Visited Home Page', 'home.php', '2026-05-11 12:29:38'),
(278, 60, 'user', 'Visited Home Page', 'home.php', '2026-05-12 02:39:10'),
(279, 60, 'user', 'Visited Home Page', 'home.php', '2026-05-12 02:39:43'),
(280, 60, 'user', 'Completed vitals quiz (Score: 27%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-12 02:41:38'),
(281, 60, 'user', 'Completed vitals quiz (Score: 53%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-12 02:43:21'),
(282, 60, 'user', 'Completed vitals quiz (Score: 87%, Mistakes: 2, Status: Competent)', 'quiz', '2026-05-12 02:44:32'),
(283, 61, 'user', 'Visited Home Page', 'home.php', '2026-05-12 07:29:23'),
(284, 61, 'user', 'Visited Home Page', 'home.php', '2026-05-12 07:29:38'),
(285, 62, 'user', 'Visited Home Page', 'home.php', '2026-05-12 07:47:52'),
(286, 62, 'user', 'Visited Home Page', 'home.php', '2026-05-12 07:48:01'),
(287, 62, 'user', 'Completed vitals quiz (Score: 87%, Mistakes: 2, Status: Competent)', 'quiz', '2026-05-12 07:52:55'),
(288, 62, 'user', 'Completed vitalsignsimulation (Score: 7%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 07:55:28'),
(289, 62, 'user', 'Completed cpr quiz (Score: 93%, Mistakes: 1, Status: Competent)', 'quiz', '2026-05-12 07:58:39'),
(290, 62, 'user', 'Completed mobility quiz (Score: 35%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-12 08:02:12'),
(291, 62, 'user', 'Completed infant quiz (Score: 50%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-12 08:04:09'),
(292, 62, 'user', 'Completed hygiene quiz (Score: 44%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-12 08:06:20'),
(293, 62, 'user', 'Visited Home Page', 'home.php', '2026-05-12 08:09:17'),
(294, 62, 'user', 'Completed vitalsignsimulation (Score: 7%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 08:10:16'),
(295, 62, 'user', 'Completed vitalsignsimulation (Score: 7%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 08:11:04'),
(296, 62, 'user', 'Completed vitalsignsimulation (Score: 0%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 08:11:32'),
(297, 62, 'user', 'Completed vitalsignsimulation (Score: 7%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 08:12:18'),
(298, 62, 'user', 'Completed vitalsignsimulation (Score: 7%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 08:12:47'),
(299, 62, 'user', 'Completed vitalsignsimulation (Score: 7%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 08:13:04'),
(300, 62, 'user', 'Completed vitalsignsimulation (Score: 7%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 08:13:20'),
(301, 62, 'user', 'Completed vitalsignsimulation (Score: 20%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 08:14:15'),
(302, 60, 'user', 'Visited Home Page', 'home.php', '2026-05-12 08:25:20'),
(303, 60, 'user', 'Completed vitalsignsimulation (Score: 0%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 08:25:50'),
(304, 60, 'user', 'Completed cpr quiz (Score: 60%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-12 08:27:58'),
(305, 60, 'user', 'Completed cpr quiz (Score: 93%, Mistakes: 1, Status: Competent)', 'quiz', '2026-05-12 08:29:05'),
(306, 60, 'user', 'Completed mobility quiz (Score: 35%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-12 08:30:57'),
(307, 60, 'user', 'Completed mobility quiz (Score: 42%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-12 08:32:24'),
(308, 60, 'user', 'Visited Home Page', 'home.php', '2026-05-12 08:32:54'),
(309, 60, 'user', 'Completed mobility quiz (Score: 50%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-12 08:34:41'),
(310, 60, 'user', 'Completed mobility quiz (Score: 77%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-12 08:37:37'),
(311, 60, 'user', 'Completed mobility quiz (Score: 81%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-12 08:39:54'),
(312, 60, 'user', 'Completed mobility quiz (Score: 77%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-12 08:42:52'),
(313, 60, 'user', 'Completed mobility quiz (Score: 96%, Mistakes: 1, Status: Competent)', 'quiz', '2026-05-12 08:44:30'),
(314, 60, 'user', 'Completed hygiene quiz (Score: 38%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-12 08:46:14'),
(315, 60, 'user', 'Completed hygiene quiz (Score: 88%, Mistakes: 2, Status: Competent)', 'quiz', '2026-05-12 08:47:45'),
(316, 60, 'user', 'Visited Home Page', 'home.php', '2026-05-12 08:48:11'),
(317, 60, 'user', 'Completed vitalsignsimulation (Score: 0%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 08:49:19'),
(318, 63, 'user', 'Visited Home Page', 'home.php', '2026-05-12 10:39:42'),
(319, 64, 'user', 'Visited Home Page', 'home.php', '2026-05-12 11:49:08'),
(320, 64, 'user', 'Completed vitals quiz (Score: 20%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-12 11:53:17'),
(321, 64, 'user', 'Completed vitals quiz (Score: 67%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-12 11:55:07'),
(322, 64, 'user', 'Completed vitals quiz (Score: 100%, Mistakes: 0, Status: Competent)', 'quiz', '2026-05-12 11:56:14'),
(323, 64, 'user', 'Completed vitalsignsimulation (Score: 7%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 11:57:35'),
(324, 65, 'user', 'Visited Home Page', 'home.php', '2026-05-12 11:58:49'),
(325, 64, 'user', 'Completed vitalsignsimulation (Score: 13%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 11:58:53'),
(326, 65, 'user', 'Visited Home Page', 'home.php', '2026-05-12 11:59:02'),
(327, 64, 'user', 'Completed vitalsignsimulation (Score: 20%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:00:06'),
(328, 64, 'user', 'Completed vitalsignsimulation (Score: 13%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:00:37'),
(329, 64, 'user', 'Completed vitalsignsimulation (Score: 20%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:01:25'),
(330, 64, 'user', 'Completed vitalsignsimulation (Score: 20%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:01:51'),
(331, 64, 'user', 'Completed vitalsignsimulation (Score: 20%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:02:20'),
(332, 64, 'user', 'Completed vitalsignsimulation (Score: 20%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:02:36'),
(333, 64, 'user', 'Completed vitalsignsimulation (Score: 20%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:02:59'),
(334, 64, 'user', 'Completed cpr quiz (Score: 93%, Mistakes: 1, Status: Competent)', 'quiz', '2026-05-12 12:04:38'),
(335, 64, 'user', 'Completed cpr_simulation (Score: 15%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:05:08'),
(336, 64, 'user', 'Completed mobility quiz (Score: 23%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-12 12:06:54'),
(337, 64, 'user', 'Completed mobility quiz (Score: 54%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-12 12:08:54'),
(338, 64, 'user', 'Completed mobility quiz (Score: 92%, Mistakes: 2, Status: Competent)', 'quiz', '2026-05-12 12:12:56'),
(339, 64, 'user', 'Completed infant quiz (Score: 94%, Mistakes: 1, Status: Competent)', 'quiz', '2026-05-12 12:16:53'),
(340, 64, 'user', 'Completed hygiene quiz (Score: 38%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-12 12:18:07'),
(341, 64, 'user', 'Completed hygiene quiz (Score: 94%, Mistakes: 1, Status: Competent)', 'quiz', '2026-05-12 12:20:54'),
(342, 64, 'user', 'Completed hygienesimulation (Score: 30%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:21:33'),
(343, 64, 'user', 'Completed hygienesimulation (Score: 70%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:22:27'),
(344, 64, 'user', 'Completed hygienesimulation (Score: 80%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:23:17'),
(345, 64, 'user', 'Completed hygienesimulation (Score: 100%, Mistakes: 2, Status: Competent)', 'simulation', '2026-05-12 12:24:02'),
(346, 64, 'user', 'Visited Home Page', 'home.php', '2026-05-12 12:24:33'),
(347, 64, 'user', 'Completed infantsimulation (Score: 78%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:26:18'),
(348, 9, 'user', 'Visited Home Page', 'home.php', '2026-05-12 12:27:03'),
(349, 64, 'user', 'Completed infantsimulation (Score: 67%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:27:03'),
(350, 9, 'user', 'Visited Home Page', 'home.php', '2026-05-12 12:27:05'),
(351, 64, 'user', 'Completed mobilitysimulation (Score: 33%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:28:05'),
(352, 64, 'user', 'Completed infantsimulation (Score: 78%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:29:03'),
(353, 64, 'user', 'Completed infantsimulation (Score: 33%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:29:19'),
(354, 64, 'user', 'Visited Home Page', 'home.php', '2026-05-12 12:30:35'),
(355, 64, 'user', 'Completed infantsimulation (Score: 67%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:31:35'),
(356, 64, 'user', 'Completed infantsimulation (Score: 78%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:32:15'),
(357, 64, 'user', 'Completed infantsimulation (Score: 100%, Mistakes: 0, Status: Competent)', 'simulation', '2026-05-12 12:32:58'),
(358, 64, 'user', 'Completed mobilitysimulation (Score: 42%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:33:55'),
(359, 64, 'user', 'Completed mobilitysimulation (Score: 42%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:34:44'),
(360, 64, 'user', 'Completed mobilitysimulation (Score: 42%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:37:07'),
(361, 64, 'user', 'Completed vitalsignsimulation (Score: 7%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:42:51'),
(362, 64, 'user', 'Completed vitalsignsimulation (Score: 7%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:44:48'),
(363, 64, 'user', 'Completed vitalsignsimulation (Score: 100%, Mistakes: 2, Status: Competent)', 'simulation', '2026-05-12 12:48:29'),
(364, 64, 'user', 'Completed cpr_simulation (Score: 62%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:49:18'),
(365, 64, 'user', 'Completed cpr_simulation (Score: 69%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:49:59'),
(366, 64, 'user', 'Completed cpr_simulation (Score: 69%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:50:39'),
(367, 64, 'user', 'Completed cpr_simulation (Score: 100%, Mistakes: 0, Status: Competent)', 'simulation', '2026-05-12 12:51:17'),
(368, 64, 'user', 'Completed mobilitysimulation (Score: 17%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:52:11'),
(369, 64, 'user', 'Completed mobilitysimulation (Score: 17%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:52:37'),
(370, 64, 'user', 'Completed mobilitysimulation (Score: 42%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:53:12'),
(371, 64, 'user', 'Completed mobilitysimulation (Score: 42%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 12:53:52'),
(372, 64, 'user', 'Completed mobilitysimulation (Score: 100%, Mistakes: 2, Status: Competent)', 'simulation', '2026-05-12 12:59:02'),
(373, 64, 'user', 'Completed infantsimulation (Score: 78%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-12 13:00:00'),
(374, 64, 'user', 'Completed infantsimulation (Score: 100%, Mistakes: 1, Status: Competent)', 'simulation', '2026-05-12 13:00:40'),
(375, 64, 'user', 'Completed hygienesimulation (Score: 100%, Mistakes: 1, Status: Competent)', 'simulation', '2026-05-12 13:01:34'),
(376, 64, 'user', 'Visited Home Page', 'home.php', '2026-05-12 13:02:15'),
(377, 45, 'user', 'Visited Home Page', 'home.php', '2026-05-14 01:57:22'),
(378, 45, 'user', 'Visited Home Page', 'home.php', '2026-05-14 01:57:31'),
(379, 45, 'user', 'Completed mobility quiz (Score: 42%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-14 02:05:37'),
(380, 45, 'user', 'Visited Home Page', 'home.php', '2026-05-14 02:07:18'),
(381, 45, 'user', 'Completed mobility quiz (Score: 54%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-14 02:09:54'),
(382, 45, 'user', 'Visited Home Page', 'home.php', '2026-05-14 02:13:17'),
(383, 45, 'user', 'Completed mobility quiz (Score: 62%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-14 02:27:08'),
(384, 45, 'user', 'Completed mobility quiz (Score: 77%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-14 02:29:36'),
(385, 45, 'user', 'Completed mobility quiz (Score: 92%, Mistakes: 2, Status: Competent)', 'quiz', '2026-05-14 02:31:57'),
(386, 45, 'user', 'Visited Home Page', 'home.php', '2026-05-14 02:32:18'),
(387, 45, 'user', 'Completed mobilitysimulation (Score: 17%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-14 02:35:46'),
(388, 45, 'user', 'Completed mobilitysimulation (Score: 25%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-14 02:36:54'),
(389, 45, 'user', 'Completed mobilitysimulation (Score: 25%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-14 02:37:21'),
(390, 45, 'user', 'Completed mobilitysimulation (Score: 100%, Mistakes: 1, Status: Competent)', 'simulation', '2026-05-14 02:39:25'),
(391, 45, 'user', 'Completed infant quiz (Score: 25%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-14 02:41:28'),
(392, 45, 'user', 'Visited Home Page', 'home.php', '2026-05-14 02:43:17'),
(393, 45, 'user', 'Completed infant quiz (Score: 69%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-14 02:47:05'),
(394, 45, 'user', 'Completed infant quiz (Score: 94%, Mistakes: 1, Status: Competent)', 'quiz', '2026-05-14 02:48:07'),
(395, 45, 'user', 'Visited Home Page', 'home.php', '2026-05-14 02:48:15'),
(396, 45, 'user', 'Completed infantsimulation (Score: 100%, Mistakes: 1, Status: Competent)', 'simulation', '2026-05-14 02:51:50'),
(397, 45, 'user', 'Completed hygiene quiz (Score: 63%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-14 02:56:10'),
(398, 45, 'user', 'Completed hygiene quiz (Score: 100%, Mistakes: 0, Status: Competent)', 'quiz', '2026-05-14 02:57:37'),
(399, 45, 'user', 'Completed hygienesimulation (Score: 10%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-14 02:58:44'),
(400, 45, 'user', 'Completed hygienesimulation (Score: 10%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-14 02:59:28'),
(401, 45, 'user', 'Completed hygienesimulation (Score: 10%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-14 02:59:42'),
(402, 45, 'user', 'Completed hygienesimulation (Score: 20%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-14 03:00:17'),
(403, 45, 'user', 'Completed hygienesimulation (Score: 30%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-14 03:01:31'),
(404, 45, 'user', 'Completed hygienesimulation (Score: 100%, Mistakes: 2, Status: Competent)', 'simulation', '2026-05-14 03:03:12'),
(405, 45, 'user', 'Completed cpr quiz (Score: 27%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-14 03:05:19'),
(406, 45, 'user', 'Completed cpr quiz (Score: 53%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-14 03:06:35'),
(407, 45, 'user', 'Completed cpr quiz (Score: 93%, Mistakes: 1, Status: Competent)', 'quiz', '2026-05-14 03:07:51'),
(408, 45, 'user', 'Completed cpr_simulation (Score: 0%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-14 03:08:14'),
(409, 45, 'user', 'Completed cpr_simulation (Score: 38%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-14 03:09:23'),
(410, 45, 'user', 'Completed cpr_simulation (Score: 38%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-14 03:10:18'),
(411, 45, 'user', 'Completed cpr_simulation (Score: 100%, Mistakes: 1, Status: Competent)', 'simulation', '2026-05-14 03:11:42'),
(412, 45, 'user', 'Completed vitalsignsimulation (Score: 7%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-14 03:12:22'),
(413, 45, 'user', 'Completed vitalsignsimulation (Score: 20%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-14 03:12:55'),
(414, 45, 'user', 'Completed vitalsignsimulation (Score: 27%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-14 03:13:41'),
(415, 45, 'user', 'Completed vitalsignsimulation (Score: 60%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-14 03:14:46'),
(416, 45, 'user', 'Completed vitalsignsimulation (Score: 60%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-14 03:15:54'),
(417, 45, 'user', 'Completed vitalsignsimulation (Score: 53%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-14 03:16:55'),
(418, 45, 'user', 'Completed vitalsignsimulation (Score: 100%, Mistakes: 2, Status: Competent)', 'simulation', '2026-05-14 03:18:43'),
(419, 45, 'user', 'Visited Home Page', 'home.php', '2026-05-14 03:18:51'),
(420, 45, 'user', 'Completed vitals quiz (Score: 27%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-14 03:20:17'),
(421, 45, 'user', 'Completed vitals quiz (Score: 53%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-14 03:21:19'),
(422, 45, 'user', 'Completed vitals quiz (Score: 87%, Mistakes: 2, Status: Competent)', 'quiz', '2026-05-14 03:22:23'),
(423, 45, 'user', 'Visited Home Page', 'home.php', '2026-05-14 03:22:59'),
(424, 9, 'user', 'Visited Home Page', 'home.php', '2026-05-16 23:55:57'),
(425, 9, 'user', 'Completed mobilitysimulation (Score: 8%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-17 00:31:21'),
(426, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-18 13:18:00'),
(427, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-18 13:29:28'),
(428, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-18 13:29:31'),
(429, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-18 14:32:10'),
(430, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-31 11:33:08'),
(431, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-31 11:33:27'),
(432, 1, 'user', 'Completed vitals quiz (Score: 7%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-05-31 11:43:14'),
(433, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-31 11:43:48'),
(434, 1, 'user', 'Completed vitalsignsimulation (Score: 7%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-05-31 11:45:34'),
(435, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-31 11:45:49'),
(436, 1, 'user', 'Completed vitalsignsimulation (Score: 100%, Mistakes: 0, Status: Competent)', 'simulation', '2026-05-31 11:47:19'),
(437, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-31 11:47:35'),
(438, 1, 'user', 'Completed vitals quiz (Score: 93%, Mistakes: 1, Status: Competent)', 'quiz', '2026-05-31 11:49:21'),
(439, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-31 11:49:53'),
(440, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-31 11:50:26'),
(441, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-31 11:51:07'),
(442, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-31 11:54:43'),
(443, 2, NULL, 'Updated user ID 5 role to instructor', NULL, '2026-05-31 12:12:47'),
(444, 2, NULL, 'Updated user ID 5 role to user', NULL, '2026-05-31 12:12:59'),
(445, 2, NULL, 'Updated user ID 1 role to instructor', NULL, '2026-05-31 12:13:07'),
(446, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-31 12:13:10'),
(447, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-31 12:13:12'),
(448, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-31 12:13:13'),
(449, 2, NULL, 'Updated user ID 1 role to user', NULL, '2026-05-31 12:13:35'),
(450, 1, 'user', 'Visited Home Page', 'home.php', '2026-05-31 12:13:44'),
(451, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-02 12:25:47'),
(452, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-02 12:31:29'),
(453, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-02 12:32:28'),
(454, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-02 12:49:41'),
(455, 2, NULL, 'Updated user ID 1 role to instructor', NULL, '2026-06-02 12:50:21'),
(456, 2, NULL, 'Updated user ID 1 role to admin', NULL, '2026-06-02 12:50:51'),
(457, 2, NULL, 'Updated user ID 1 role to user', NULL, '2026-06-02 12:51:10'),
(458, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-02 12:51:17'),
(459, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-02 12:51:22'),
(460, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-04 12:46:12'),
(461, 1, 'user', 'Completed vitalsignsimulation (Score: 0%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-06-04 12:55:34'),
(462, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-04 12:55:46'),
(463, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-04 12:56:18'),
(464, 1, 'user', 'Completed vitalsignsimulation (Score: 100%, Mistakes: 0, Status: Competent)', 'simulation', '2026-06-04 12:56:52'),
(465, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-04 12:56:57'),
(466, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-04 12:58:44'),
(467, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-04 13:00:55'),
(468, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-06 11:25:27'),
(469, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-06 11:33:07'),
(470, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-06 11:33:58'),
(471, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-06 11:35:53'),
(472, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-06 11:51:51'),
(473, 2, NULL, 'Updated user ID 1 role to instructor', NULL, '2026-06-06 11:52:24'),
(474, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-06 11:52:31'),
(475, 2, NULL, 'Updated user ID 1 role to admin', NULL, '2026-06-06 11:52:58'),
(476, 2, NULL, 'Updated user ID 1 role to user', NULL, '2026-06-06 11:53:26'),
(477, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-06 11:53:33'),
(478, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-06 11:54:38'),
(479, 6, 'instructor', 'Completed vitals quiz (Score: 100%, Mistakes: 0, Status: Competent)', 'quiz', '2026-06-09 12:04:15'),
(480, 6, 'instructor', 'Completed vitalsignsimulation (Score: 100%, Mistakes: 0, Status: Competent)', 'simulation', '2026-06-09 12:04:51'),
(481, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-09 13:11:48'),
(482, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-09 13:14:59');
INSERT INTO `activity_logs` (`id`, `user_id`, `role`, `action`, `page`, `created_at`) VALUES
(483, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-09 13:15:12'),
(484, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-09 13:23:34'),
(485, 1, 'user', 'Completed vitals quiz (Score: 100%, Mistakes: 0, Status: Competent)', 'quiz', '2026-06-09 13:39:23'),
(486, 1, 'user', 'Completed vitalsignsimulation (Score: 100%, Mistakes: 0, Status: Competent)', 'simulation', '2026-06-09 13:53:46'),
(487, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-09 13:56:16'),
(488, 2, NULL, 'Updated user ID 1 role to instructor', NULL, '2026-06-09 14:02:10'),
(489, 2, NULL, 'Updated user ID 1 role to admin', NULL, '2026-06-09 14:02:43'),
(490, 2, NULL, 'Updated user ID 1 role to user', NULL, '2026-06-09 14:03:06'),
(491, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-09 14:03:15'),
(492, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-10 06:10:18'),
(493, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-10 06:10:24'),
(494, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-10 06:11:43'),
(495, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-10 12:31:28'),
(496, 1, 'user', 'Completed vitals quiz (Score: 27%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-06-10 12:36:05'),
(497, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-10 12:36:19'),
(498, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-10 12:36:32'),
(499, 1, 'user', 'Completed vitals quiz (Score: 93%, Mistakes: 1, Status: Competent)', 'quiz', '2026-06-10 12:37:08'),
(500, 1, 'user', 'Completed vitalsignsimulation (Score: 13%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-06-10 12:39:02'),
(501, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-10 12:39:19'),
(502, 1, 'user', 'Completed vitalsignsimulation (Score: 100%, Mistakes: 0, Status: Competent)', 'simulation', '2026-06-10 12:39:53'),
(503, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-10 12:40:00'),
(504, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-10 12:40:28'),
(505, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-10 12:41:03'),
(506, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-10 12:42:16'),
(507, 1, 'user', 'Completed vitalsignsimulation (Score: 100%, Mistakes: 1, Status: Competent)', 'simulation', '2026-06-10 12:56:01'),
(508, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-10 12:57:28'),
(509, 2, NULL, 'Updated user ID 1 role to instructor', NULL, '2026-06-10 12:57:59'),
(510, 2, NULL, 'Updated user ID 1 role to admin', NULL, '2026-06-10 12:58:27'),
(511, 2, NULL, 'Updated user ID 1 role to user', NULL, '2026-06-10 12:58:48'),
(512, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-10 12:58:58'),
(513, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-11 00:21:07'),
(514, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-11 03:00:26'),
(515, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-11 03:12:13'),
(516, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-11 03:15:04'),
(517, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-11 03:15:43'),
(518, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-11 03:17:13'),
(519, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-11 03:17:46'),
(520, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-11 03:19:26'),
(521, 2, NULL, 'Updated user ID 1 role to instructor', NULL, '2026-06-11 03:31:29'),
(522, 2, NULL, 'Updated user ID 1 role to admin', NULL, '2026-06-11 03:31:56'),
(523, 2, NULL, 'Updated user ID 1 role to user', NULL, '2026-06-11 03:32:18'),
(524, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-11 03:32:29'),
(525, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-11 05:17:50'),
(526, 1, 'user', 'Completed vitals quiz (Score: 7%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-06-11 05:21:31'),
(527, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-11 05:21:42'),
(528, 1, 'user', 'Completed vitals quiz (Score: 93%, Mistakes: 1, Status: Competent)', 'quiz', '2026-06-11 05:22:45'),
(529, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-11 05:23:06'),
(530, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-11 05:23:38'),
(531, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-11 05:36:26'),
(532, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-11 05:44:34'),
(533, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-11 11:04:13'),
(534, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-11 11:08:31'),
(535, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-11 11:09:33'),
(536, 2, NULL, 'Updated user ID 1 role to instructor', NULL, '2026-06-11 11:21:47'),
(537, 2, NULL, 'Updated user ID 1 role to admin', NULL, '2026-06-11 11:22:14'),
(538, 2, NULL, 'Updated user ID 1 role to user', NULL, '2026-06-11 11:22:33'),
(539, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-11 11:22:39'),
(540, 70, 'user', 'Visited Home Page', 'home.php', '2026-06-14 03:07:07'),
(541, 70, 'user', 'Visited Home Page', 'home.php', '2026-06-14 03:07:23'),
(542, 70, 'user', 'Visited Home Page', 'home.php', '2026-06-14 03:07:26'),
(543, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-20 12:33:27'),
(544, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-20 12:34:16'),
(545, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-20 12:38:45'),
(546, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-20 12:42:26'),
(547, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-20 12:42:29'),
(548, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-20 12:43:58'),
(549, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-20 12:44:18'),
(550, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-20 12:58:10'),
(551, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-20 12:58:13'),
(552, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-20 12:58:17'),
(553, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-20 12:58:49'),
(554, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-20 13:55:19'),
(555, 71, 'user', 'Visited Home Page', 'home.php', '2026-06-20 13:56:56'),
(556, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-21 13:05:40'),
(557, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-21 13:05:45'),
(558, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-21 13:29:22'),
(559, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-21 13:37:54'),
(560, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-21 13:42:36'),
(561, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-21 13:43:22'),
(562, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-21 13:43:32'),
(563, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-21 13:44:17'),
(564, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-21 13:45:16'),
(565, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-21 13:45:23'),
(566, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-27 06:09:27'),
(567, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-27 07:25:56'),
(568, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-28 07:47:44'),
(569, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-30 05:35:10'),
(570, 1, 'user', 'Visited Home Page', 'home.php', '2026-06-30 07:41:25'),
(571, 1, 'user', 'Visited Home Page', 'home.php', '2026-07-01 05:55:34'),
(572, 73, 'user', 'Visited Home Page', 'home.php', '2026-07-01 06:49:50'),
(573, 73, 'user', 'Visited Home Page', 'home.php', '2026-07-01 06:50:22'),
(574, 73, 'user', 'Visited Home Page', 'home.php', '2026-07-01 06:53:34'),
(575, 73, 'user', 'Completed vitals quiz (Score: 7%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-07-01 06:56:09'),
(576, 73, 'user', 'Visited Home Page', 'home.php', '2026-07-01 06:56:48'),
(577, 73, 'user', 'Visited Home Page', 'home.php', '2026-07-01 06:59:45'),
(578, 74, 'user', 'Visited Home Page', 'home.php', '2026-07-01 07:08:51'),
(579, 74, 'user', 'Completed vitals quiz (Score: 7%, Mistakes: 3, Status: Incompetent)', 'quiz', '2026-07-01 07:11:05'),
(580, 9, 'user', 'Visited Home Page', 'home.php', '2026-07-02 02:50:45'),
(581, 9, 'user', 'Completed mobilitysimulation (Score: 0%, Mistakes: 3, Status: Incompetent)', 'simulation', '2026-07-02 02:55:04'),
(582, 75, 'user', 'Visited Home Page', 'home.php', '2026-07-02 11:13:56'),
(583, 75, 'user', 'Visited Home Page', 'home.php', '2026-07-02 11:15:05'),
(584, 75, 'user', 'Visited Home Page', 'home.php', '2026-07-02 11:30:57'),
(585, 76, 'user', 'Visited Home Page', 'home.php', '2026-07-02 11:33:16'),
(586, 76, 'user', 'Visited Home Page', 'home.php', '2026-07-02 11:34:20'),
(587, 77, 'user', 'Visited Home Page', 'home.php', '2026-07-02 11:48:22'),
(588, 77, 'user', 'Visited Home Page', 'home.php', '2026-07-02 11:49:28'),
(589, 78, 'user', 'Visited Home Page', 'home.php', '2026-07-03 15:06:17'),
(590, 78, 'user', 'Visited Home Page', 'home.php', '2026-07-03 15:06:54'),
(591, 79, 'user', 'Visited Home Page', 'home.php', '2026-07-03 22:01:43'),
(592, 1, 'user', 'Visited Home Page', 'home.php', '2026-07-15 06:21:09'),
(593, 1, 'user', 'Visited Home Page', 'home.php', '2026-07-15 06:29:43'),
(594, 1, 'user', 'Visited Home Page', 'home.php', '2026-07-15 07:27:04'),
(595, 1, 'user', 'Visited Home Page', 'home.php', '2026-07-15 07:36:33'),
(596, 1, 'user', 'Visited Home Page', 'home.php', '2026-07-15 07:37:43'),
(597, 1, 'user', 'Visited Home Page', 'home.php', '2026-07-17 11:12:17'),
(598, 1, 'user', 'Visited Home Page', 'home.php', '2026-07-17 11:24:17');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `message`, `created_at`) VALUES
(1, 'Hello!', '2026-04-29 11:44:28'),
(2, 'Good Morning', '2026-04-29 12:43:05'),
(3, 'Hello', '2026-05-02 06:36:20'),
(4, 'Greetings!', '2026-05-04 06:02:20'),
(5, 'Make sure to finish your assignments before May 10th', '2026-05-04 12:30:51'),
(6, 'Good Day!', '2026-05-05 14:50:53'),
(7, 'Good Night!', '2026-05-05 14:52:55'),
(8, 'Good Morning!', '2026-05-31 11:51:01'),
(9, 'Good Morning', '2026-06-02 12:32:22'),
(10, 'Good Afternoon', '2026-06-02 12:48:18'),
(11, 'Good Afternoon!', '2026-06-04 12:58:36'),
(12, 'Good Afternoon!', '2026-06-06 11:33:53'),
(13, 'Hi!', '2026-06-06 11:51:45'),
(14, 'Good Afternoon!', '2026-06-09 13:23:28'),
(15, 'Good Day', '2026-06-11 05:23:34'),
(16, 'Good Afternoon!', '2026-06-11 05:35:43'),
(17, 'Good Day!', '2026-06-11 11:04:55'),
(18, 'Hi!', '2026-06-11 11:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `title`, `link`) VALUES
(1, 'CLEARING THE OBSTRUCTED AIRWAY - PERSON IS LYING DOWN', 'module1.php'),
(2, 'CLEARING THE OBSTRUCTED AIRWAY - THE PERSON IS STANDING OR SITTING', 'module2.php'),
(3, 'HOUSING ALTERNATIVES', 'module3.php'),
(4, 'RESIDENT RIGHTS', 'module4.php'),
(5, 'COMMON CONDITIONS IN THE ELDERLY', 'module5.php'),
(6, 'ADULT CPR PROCEDURE', 'module6.php'),
(7, 'TRANSFERRING THE CLIENT FROM BED TO WHEELCHAIR', 'module7.php'),
(8, 'TRANSFERRING THE CLIENT FROM WHEELCHAIR TO BED', 'module8.php');

-- --------------------------------------------------------

--
-- Table structure for table `module_contents`
--

CREATE TABLE `module_contents` (
  `id` int(11) NOT NULL,
  `module_id` varchar(20) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `section_label` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module_contents`
--

INSERT INTO `module_contents` (`id`, `module_id`, `image`, `description`, `sort_order`, `section_label`) VALUES
(11, 'module1', 'm1/img5bc.png', 'b. Insert your other index finger into the mouth along the side of the cheek and deep into the throat. Your finger should be at the base of the tongue.\r\nc. Form a hook with your index finger.', 10, NULL),
(12, 'module1', 'm1/img5de.png', 'd. Try to dislodge and remove the object. Do not push it deeper into the throat.\r\ne. Grasp and remove an object within reach.', 11, NULL),
(23, 'module2', 'm2/img3c.png', 'c. Make a fist one hand.', 5, NULL),
(24, 'module2', 'm2/img3d.png', 'd. Place the thumb side of the fist against the abdomen. The fist is in the middle above the navel and below the end of the sternum (breastbone)', 6, NULL),
(32, 'module2', 'm2/img6de.png', 'd. Try to dislodge and remove the object. Do not push it deeper into the throat.\r\ne. Grasp and remove an object within reach.', 14, NULL),
(38, 'module3', 'm3/1.png', '', 1, NULL),
(39, 'module3', 'm3/2.png', '', 2, NULL),
(40, 'module3', 'm3/3.png', '', 3, NULL),
(41, 'module3', 'm3/4.png', '', 4, NULL),
(42, 'module3', 'm3/5.png', '', 5, NULL),
(43, 'module3', 'm3/6.png', '', 6, NULL),
(44, 'module3', 'm3/7.png', '', 7, NULL),
(45, 'module3', 'm3/8.png', '', 8, NULL),
(88, 'module6', 'm6/img1.png', '1. Check for unresponsiveness.', 1, NULL),
(89, 'module6', 'm6/img2.png', '2. Call for help. Activate the EMS system.', 2, NULL),
(92, 'module6', 'm6/img5.png', '5. Check for breathlessness.', 5, NULL),
(168, 'module6', 'm6/step_1782544023.gif', '3. Position the person supine. Logroll the person so there is no twisting of the spine. The person must be on a hard, flat surface. Place the person\'s arms alongside the body.', 3, NULL),
(169, 'module6', 'm6/step_1782544054.gif', '4. Open the airway. Use the head-tilt/chin-lift maneuver.', 4, NULL),
(170, 'module6', 'm6/step_1782544199.gif', '6. Give 2 breaths. Each should be 1½ to 2 seconds long. Let the person\'s chest deflate between breaths.', 6, NULL),
(171, 'module6', 'm6/step_1782544218.gif', '7. Check for pulselessness. Check the pulse for 5 to 10 seconds. Use your other hand to keep the airway open with the head-tilt maneuver.', 7, NULL),
(172, 'module6', 'm6/step_1782544241.gif', '8. Give chest compressions if the person has no pulse. Give compressions at a rate of 80 to 100 per minute. Give 15 compressions and then 2 breaths.\r\na. Establish a rhythm, and count out loud (1 and, 2 and... 15).', 8, NULL),
(173, 'module6', 'm6/step_1782544337.gif', 'b. Open the airway, and give 2 breaths.', 9, NULL),
(174, 'module6', 'm6/step_1782544386.gif', 'c. Repeat this step until 4 cycles of 15 compressions and 2 breaths are given.', 10, NULL),
(175, 'module6', 'm6/step_1782544430.gif', '9. Check for a carotid pulse (3 to 5 seconds)', 11, NULL),
(176, 'module6', 'm6/step_1782544494.gif', '10. Continue CPR if the person has no pulse. Begin with chest compressions.', 12, NULL),
(177, 'module6', 'm6/step_1782544508.gif', '11-12. Continue the cycles of 15 compressions and 2 breaths. Check for a pulse every few minutes.', 13, NULL),
(179, 'module6', 'm6/step_1782544592.gif', '2. Continue chest compressions. The helper says, \"I know CPR. Can I help?\"', 26, NULL),
(180, 'module6', 'm6/step_1782544682.gif', '1. Perform one-person CPR until help arrives', 25, 'CPR - TWO RESCUERS'),
(181, 'module6', 'm6/step_1782544747.gif', '3. Indicate that you want help. Ask that the EMS system be activated, if not already done.', 27, NULL),
(182, 'module6', 'm6/step_1782544772.gif', '4. Do not stop chest compressions. The helper kneels on the other side of the person. The two-rescuer procedure begins after you complete a cycle of 15 compressions and 2 breaths.', 28, NULL),
(183, 'module6', 'm6/step_1782544790.gif', '5. Stop compressions for 3 to 5 seconds. The helper checks for carotid pulse. Helper states \"no pulse\"', 29, NULL),
(184, 'module6', 'm6/step_1782544844.gif', '6. Perform two-person CPR:\r\na. The helper gives 2 breaths', 30, NULL),
(185, 'module6', 'm6/step_1782544873.gif', 'b. Give chest compressions at 80 to 100 per minute. Count out loud (1 and, 2 and... 5).', 31, NULL),
(186, 'module6', 'm6/step_1782544896.gif', 'c. The helper gives a breath immediately after fifth compression.', 32, NULL),
(187, 'module6', 'm6/step_1782544918.gif', 'd. A breath is given after every fifth compression.', 33, NULL),
(188, 'module6', 'm6/step_1782544942.gif', '7. Stop compressions after 1 minute. Your helper checks for a carotid pulse. After the first minute, stop compressions every few minutes to check for breathing and circulation.', 34, NULL),
(189, 'module6', 'm6/step_1782544964.gif', '8. Call for a position switch when you are tired', 35, NULL),
(190, 'module6', 'm6/step_1782544988.gif', '9. Change positions quickly.', 36, NULL),
(191, 'module6', 'm6/step_1782545024.gif', '10. Give one breath after every fifth compression.', 37, NULL),
(192, 'module6', 'm6/step_1782545041.gif', '11. Switch positions when the person giving the compressions is tired. Check for a pulse and breathing at every position change.', 38, NULL),
(193, 'module1', 'm1/step_1782798581.gif', '1. Ask the person if she or he is choking.', 1, NULL),
(194, 'module1', 'm1/step_1782798598.gif', '2. Determine if the person can cough or speak.', 2, NULL),
(195, 'module1', 'm1/step_1782798621.gif', '3. Perform the Heimlich maneuver if the person is choking:\r\na. Position the person supine.', 3, NULL),
(196, 'module1', 'm1/step_1782798656.gif', 'b. Kneel next to the person\'s thighs.\r\nc. Place the heel of one hand against the abdomen. It should be in the middle above the navel and below the end of the sternum (breastbone)', 4, NULL),
(197, 'module1', 'm1/step_1782798734.gif', 'd. Place your second hand on top of your first hand', 5, NULL),
(198, 'module1', 'm1/step_1782798763.gif', 'e. Press into the abdomen with a quick, upward thrust', 6, NULL),
(199, 'module1', 'm1/step_1782798781.gif', 'f. Repeat abdominal thrusts until the object is expelled or the person loses consciousness', 7, NULL),
(200, 'module1', 'm1/step_1782798797.gif', '4. Lower the unconscious person to the floor or ground. Activate the EMS system.', 8, NULL),
(201, 'module1', 'm1/step_1782798900.gif', '5. Do the finger sweep maneuver to check for a foreign object:\r\na. Open the person\'s mouth. Use the tongue jaw lift maneuver.', 9, NULL),
(202, 'module1', 'm1/step_1782798920.gif', '6. Open the airway with the head-tilt/chin-lift maneuver.', 12, NULL),
(203, 'module1', 'm1/step_1782798934.gif', '7. Give 2 breaths.', 13, NULL),
(204, 'module1', 'm1/step_1782799005.gif', '8. Reposition the person\'s head if you could not ventilate the person then give 2 breaths.', 14, NULL),
(205, 'module1', 'm1/step_1782799021.gif', '9. Give up to 5 abdominal thrusts.', 15, NULL),
(206, 'module1', 'm1/step_1782799031.gif', '10. Repeat steps 6 through 10 (finger sweeps, rescue breathing, and abdominal thrusts) until the object is expelled or emergency medical personnel arrive.', 16, NULL),
(207, 'module2', 'm2/step_1782799876.gif', '1. Ask the person if he or she is choking', 1, NULL),
(208, 'module2', 'm2/step_1782799888.gif', '2. Determine if the person can cough or speak.', 2, NULL),
(209, 'module2', 'm2/step_1782799905.gif', '3. Perform the Heimlich maneuver (abdominal thrusts) if the person is standing or sitting:\r\na. Stand behind the person.', 3, NULL),
(210, 'module2', 'm2/step_1782799923.gif', 'b. Wrap your arms around the person\'s waist.', 4, NULL),
(211, 'module2', 'm2/step_1782799955.gif', 'e. Grasp your fist with your other hand.', 7, NULL),
(212, 'module2', 'm2/step_1782799967.gif', 'f. Press your fist and hand into the person\'s abdomen with a quick, upward thrust.', 8, NULL),
(213, 'module2', 'm2/step_1782799980.gif', 'g. Repeat the abdominal thrust until the object is expelled or the person loses consciousness.', 9, NULL),
(214, 'module2', 'm2/step_1782799992.gif', '4. Lower the unconscious person to the floor or ground.', 10, NULL),
(215, 'module2', 'm2/step_1782800001.gif', '5. Activate the EMS system.', 11, NULL),
(216, 'module2', 'm2/step_1782800020.gif', '6. Do the finger sweep maneuver to check for a foreign object:\r\na. Open the person\'s mouth. Use the tongue jaw lift maneuver.', 12, NULL),
(217, 'module2', 'm2/step_1782800048.gif', 'b. Insert your other index finger into the mouth along the side of the cheek and deep into the throat. Your finger should be at the base of the tongue.\r\nc. Form a hook with your index finger.', 13, NULL),
(218, 'module2', 'm2/step_1782800084.gif', '7. Open the airway with the head-tilt/chin-lift maneuver.', 15, NULL),
(219, 'module2', 'm2/step_1782800101.gif', '8. Give 2 breaths.', 16, NULL),
(220, 'module2', 'm2/step_1782800117.gif', '9. Reposition the person\'s head if you could not ventilate the person then give 2 breaths.', 17, NULL),
(221, 'module2', 'm2/step_1782800130.gif', '10. Give up to 5 abdominal thrusts.', 18, NULL),
(222, 'module2', 'm2/step_1782800140.gif', '11. Repeat steps 6 through 10 (finger sweeps, rescue breathing, and abdominal thrusts) until the object is expelled or emergency medical personnel arrive.', 19, NULL),
(223, 'module5', 'm5/step_1782801063.gif', 'A. Dementia', 17, 'NEUROLOGICAL CONDITIONS - CEREBROVASCULAR ACCIDENT/STROKE  ➤ Elderly would be more institutionalized post-CVA  ➤ Complications:'),
(226, 'module5', 'm5/step_1782801137.gif', 'B. Osteoporosis', 18, NULL),
(227, 'module5', 'm5/step_1782801150.gif', 'C. Impaired auditory and visual abilities', 19, NULL),
(228, 'module5', 'm5/step_1782801177.gif', 'E. Osteoarthritis', 21, NULL),
(229, 'module5', 'm5/step_1782801214.gif', 'G. Confounding stresses of older families', 23, NULL),
(230, 'module5', 'm5/step_1782801265.gif', '1. Thrombosis\r\n➤ A blood clot within a blood vessel of the brain or neck\r\n➤ Secondary to arteriosclerosis resulting to slowing of cerebral circulation\r\n➤ Thrombotic stroke - Slow to develop, paresthesia/transient speech loss\r\n➤ Precedes onset of symptoms by days/hours', 24, 'Stroke - Sudden loss of brain function resulting from a disruption of the blood supply to a part of the brain'),
(231, 'module5', 'm5/step_1782801286.gif', '2. Embolism\r\n➤ Blood clot/other material carried to the brain from another part of the body\r\n➤ Presence of preexisting conditions: Infective endocarditis, RHD, MI, Pulmonary Infections\r\n➤ Embolic stroke - Sudden onset of hemiparesis/hemiplegia with or without aphasia/LOC in a patient with a cardiac or pulmonary disease', 25, NULL),
(232, 'module5', 'm5/step_1782801387.gif', '➤ Atheroma - Abnormal mass of fat as in deposits\r\n- Characterized by TIA', 27, NULL),
(233, 'module5', 'm5/step_1782801404.gif', '4. Cerebral Hemorrhage\r\n➤ Rupture of a cerebral blood vessel with bleeding into the brain tissue or spaces surrounding the brain', 28, NULL),
(234, 'module5', 'm5/step_1782801422.gif', 'Types of hemorrhage:\r\nA. Extradural/epidural hemorrhage - Bleeding between inner skull and dura mater compressing brain underneath\r\nB. Subdural - Bleeding between dura mater and arachnoid membrane\r\nC. Subarachnoid - Hemorrhage occurring in the subarachnoid space\r\nD. Intracerebral - Hemorrhage or bleeding into the brain substance usually due to HTN, cerebral atherosclerosis', 29, NULL),
(235, 'module5', 'm5/step_1782801523.png', 'D. Polypharmacy', 20, NULL),
(236, 'module5', 'm5/step_1782801554.png', 'F. Skin fragilities', 22, NULL),
(237, 'module5', 'm5/step_1782801608.png', '3. Cerebral Ischemia\r\n➤ Insufficiency of blood supply to the brain due mainly to atheromatous constriction of arteries supplying the brain', 26, NULL),
(238, 'module5', 'm5/step_1782801659.gif', '1. Improving mobility\r\n- Preventing deformities\r\n- Changing position every 2 hours', 30, 'HEALTHCARE PROVIDER\'S INTERVENTIONS'),
(239, 'module5', 'm5/step_1782801672.gif', '2. Retraining affected extremities', 31, NULL),
(240, 'module5', 'm5/step_1782801702.png', '3. Prepare patient for ambulation - sitting balance/tolerance, standing balance/tolerance', 32, NULL),
(241, 'module5', 'm5/step_1782801731.png', '4. Prevent shoulder pain', 33, NULL),
(242, 'module5', 'm5/step_1782801752.gif', '5. Achieve self-care', 34, NULL),
(243, 'module5', 'm5/step_1782801767.gif', '6. Achieve good means of communication', 35, NULL),
(244, 'module5', 'm5/step_1782801801.png', '7. Maintain skin integrity', 36, NULL),
(245, 'module5', 'm5/step_1782801829.png', '8. Improve family coping through health teaching', 37, NULL),
(246, 'module5', 'm5/step_1782801839.png', '9. Home health care', 38, NULL),
(247, 'module5', 'm5/step_1782801860.gif', '10. Sexual function', 39, NULL),
(248, 'module5', 'm5/step_1782801888.gif', '- Most commonly caused by falls\r\n- Most fatalities: Pedestrian accidents\r\nMen - usually involves alcohol\r\nWomen - usually involves house accidents\r\n- MAJOR GOAL: Protection from a secondary fall to prevent a second TBI or a fracture', 40, 'TRAUMATIC BRAIN INJURY'),
(249, 'module4', 'm4/step_1782802676.gif', '1. The right to privacy and confidentiality\r\n- Personal privacy/body exposure, right to visit with others and be visited in private, telephone/letters, confidentiality in healthcare.', 8, NULL),
(250, 'module4', 'm4/step_1782802692.gif', '2. The right to personal choice.\r\n- Choice in terms of physicians, care, treatments', 9, NULL),
(251, 'module4', 'm4/step_1782802704.gif', '3. The right to voice disputes/grievances.\r\n- Dispute or grievance involving care/another resident', 10, NULL),
(252, 'module4', 'm4/step_1782802714.gif', '4. The right to participate in resident and family groups.', 11, NULL),
(253, 'module4', 'm4/step_1782802725.gif', '5. The right to care and security of personal possessions.\r\n- Label personal items with owner\'s name, investigate lost/stolen/broken items.\r\n- Do not go through a resident\'s personal items without consent.', 12, NULL),
(254, 'module4', 'm4/step_1782802739.gif', '6. Freedom from abuse, mistreatment, and neglect\r\n- Freedom from involuntary seclusion\r\n- Involuntary seclusion: separating the resident from others against his/her will', 13, NULL),
(255, 'module4', 'm4/step_1782802750.gif', '7. Freedom from restraints.', 14, NULL),
(256, 'module7', 'm7/step_1782803948.gif', 'A. Place the chair even with the top of the bed', 19, NULL),
(257, 'module7', 'm7/step_1782803964.gif', 'B. Put a folded blanket or cushion on the seat of the chair, and lock its wheels', 20, NULL),
(258, 'module7', 'm7/step_1782803978.gif', 'C. Lower the bed for proper alignment with the chair', 21, NULL),
(259, 'module7', 'm7/step_1782804163.gif', 'D. Place shoes on the individual.\r\nE. Help her/him to sit at the side of the bed to gain strength and avoid dizziness.\r\nF. Ensure that their feet touch the floor, and that clothing is in place.', 22, NULL),
(260, 'module7', 'm7/step_1782804205.gif', 'G. Use a transfer belt. Stand in front of the person', 23, NULL),
(261, 'module7', 'm7/step_1782804224.gif', 'H. Have the client place her/his hands on the mattress and hold on', 24, NULL),
(262, 'module7', 'm7/step_1782804243.gif', 'I. With the clients feet flat on the floor and leaning forward, grasp the belt on both sides', 25, NULL),
(263, 'module7', 'm7/step_1782804283.gif', 'J. Brace your knees with the clients\' and block the clients\' feet with your feet', 26, NULL),
(264, 'module7', 'm7/step_1782804337.gif', 'K. Position transfer disc. Have the client push down on the mattress to stand, and count 1, 2, and 3.\r\nL. Pull the client up to a standing position as you straighten your knees.', 27, NULL),
(265, 'module7', 'm7/step_1782804397.gif', 'M. If you do not have a transfer belt, place your hands under the clients\' arms and your hands around the shoulder blades. Have the person lean forward while you brace your knees against her/his knees.\r\nN. Have the person count with you 1, 2, 3, and pull the client up into position', 28, NULL),
(266, 'module7', 'm7/step_1782804420.gif', 'O. With transfer belt, turn them so they can grasp the far arm of the chair. The legs should touch the edge of the chair. Continue to turn until the client can grasp the other armrest', 29, NULL),
(267, 'module7', 'm7/step_1782804444.gif', 'P. Without transfer belt, turn them so they can grasp the far arm of the chair. Continue to turn until the client can grasp the other armrest', 30, NULL),
(268, 'module7', 'm7/step_1782804476.gif', 'R. Positions for the frail, injured, or those that are ill may need to be supported with rolled towels or pillows. This will require direction from the supervising nurse, or on doctor\'s orders', 32, NULL),
(269, 'module7', 'm7/step_1782804603.gif', 'Q. Lower them into the chair as you bend your hips and knees. Ensure their buttocks are to the back of the seat and they are in good alignment. Position their feet on the footrests', 31, NULL),
(270, 'module8', 'm8/step_1782805008.gif', '1. Place the chair at the head of the bed. The chair back is even with the headboard. Lock the wheelchair wheels and bed wheels.', 13, NULL),
(271, 'module8', 'm8/step_1782805036.gif', '2. Remove blanket. Remove feet from foot rest. Fasten gait belt.', 14, NULL),
(272, 'module8', 'm8/step_1782805069.gif', '3. Brace your knee against patient\'s weak knee. Ask the patient to lean forward. Place arm on client\'s shoulder blade while holding the gait belt.', 15, NULL),
(273, 'module8', 'm8/step_1782805082.gif', '3.1. Instruct patient to push himself/herself up with strong arm on the wheelchair\'s armrest as you pull him/her into standing position. (Count to 3).', 16, NULL),
(274, 'module8', 'm8/step_1782805097.gif', '4. Ask client if he feels dizzy.', 17, NULL),
(275, 'module8', 'm8/step_1782805110.gif', '5. Pivot patient. Ask the patient to step strong leg towards the bed while assisting weak leg. Ask patient to step back until back of knees touch the bed.', 18, NULL),
(276, 'module8', 'm8/step_1782805149.gif', '6. Ask client to hold onto the edge of mattress. Gently sit the person on the bed. Remove gait belt.', 19, NULL),
(277, 'module8', 'm8/step_1782805166.gif', '7. Scoot client backwards. Support the shoulder and legs laying the client back to the bed.', 20, NULL),
(278, 'module8', 'm8/step_1782805180.gif', '8. Remove non-skid slippers and paper towel. Make sure client is properly aligned. Cover client with top linens.', 21, NULL),
(279, 'module8', 'm8/step_1782805196.gif', '9. Return signal light, raise side rails, unscreen client, thank client for his/her cooperation, do aftercare, wash hands, document.', 22, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quizlab`
--

CREATE TABLE `quizlab` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizlab`
--

INSERT INTO `quizlab` (`id`, `title`, `link`) VALUES
(1, 'CHECKING VITAL SIGNS - QUIZ', 'quiz1.php'),
(2, 'CHECKING VITAL SIGNS - SIMULATION', 'simulation1.php'),
(3, 'CPR TRAINING - QUIZ', 'quiz2.php'),
(4, 'CPR TRAINING - SIMULATION', 'simulation2.php'),
(5, 'ASSISTED MOBILITY - QUIZ', 'quiz3.php'),
(6, 'ASSISTED MOBILITY - SIMULATION', 'simulation3.php'),
(7, 'INFANT CARE - QUIZ', 'quiz4.php'),
(8, 'INFANT CARE - SIMULATION', 'simulation4.php'),
(9, 'ELDERLY HYGIENE AND GROOMING - QUIZ', 'quiz5.php'),
(10, 'ELDERLY HYGIENE AND GROOMING - SIMULATION', 'simulation5.php');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` int(11) NOT NULL,
  `quiz_id` varchar(50) NOT NULL,
  `question` text NOT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`options`)),
  `correct_index` int(11) NOT NULL COMMENT '0-based index of correct option in options array',
  `sort_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question`, `options`, `correct_index`, `sort_order`) VALUES
(4, 'vitals', 'True or False: Washing hands first is the first step before taking the BP.', '[\"True\",\"False\"]', 0, 1),
(5, 'vitals', 'Prepare the ______. Clean the _______ (earpiece, binaurals, tubing, diaphragm and bell) cleaned with _______ soaked in alcohol.', '[\"Stethoscope, BP Apparatus, Cotton Balls\",\"BP Apparatus, Cotton Balls, Stethoscope\",\"BP Apparatus, Stethoscope, Cotton Balls\",\"Cotton Balls, Stethoscope, BP Apparatus\"]', 2, 2),
(6, 'vitals', 'When the upper arm is exposed and the cuff of the BP apparatus is wrapped around the client\'s arm: How many inch should it be above the antecubital fossa?', '[\"1 inch above the antecubital fossa. Must be even and snug.\",\"2 inch above the antecubital fossa. Must be even and snug.\",\"3 inch above the antecubital fossa. Must be even and snug.\",\"4 inch above the antecubital fossa. Must be even and snug.\"]', 0, 3),
(7, 'vitals', 'How many fingers should be laid on the radial pulse?', '[\"1-2 fingers\",\"2-3 fingers\",\"2 fingers\",\"3 fingers\"]', 1, 4),
(8, 'vitals', 'The point where the pulse stops in the manometer is noted then ___mmHg is added (maximum inflation point or Maximum inflation rate)', '[\"20\",\"35\",\"47\",\"30\"]', 3, 5),
(9, 'vitals', 'True or False: Valve should be tight and the air is not released.', '[\"True\",\"False\"]', 1, 6),
(10, 'vitals', 'Instruct patient to clasp and unclasp hands or wait for?', '[\"10 seconds\",\"3 seconds\",\"8 seconds\",\"5 seconds\"]', 3, 7),
(11, 'vitals', 'True or False: Diaphram is placed on the palm to warm it.', '[\"True\",\"False\"]', 0, 8),
(12, 'vitals', 'The _______ is palpated and the ______ is placed over it.', '[\"stethoscope, brachial pulse\",\"brachial pulse, valve\",\"brachial pulse, stethoscope\",\"valve, stethoscope\"]', 2, 9),
(13, 'vitals', 'Valve is ______ again and cuff is inflated up to maximum inflation point.', '[\"Loosened\",\"Tightened\"]', 1, 10),
(14, 'vitals', 'Valve is ______ and released slowly.', '[\"Tightened\",\"Loosened\"]', 1, 11),
(15, 'vitals', 'True or False: Systolic and diastolic pressure are noted.', '[\"True\",\"False\"]', 0, 12),
(16, 'vitals', 'True or False: Air from cuff is fully tightened.', '[\"True\",\"False\"]', 1, 13),
(17, 'vitals', 'True or False: BP results are recorded.', '[\"True\",\"False\"]', 0, 14),
(18, 'vitals', 'Earpiece and diaphragm are cleaned with ______ soaked in alcohol.', '[\"tissue paper\",\"warm cloth\",\"towel\",\"cotton balls\"]', 3, 15),
(19, 'cpr', 'True or False: The scene needs to be surveyed for safety.', '[\"True\",\"False\"]', 0, 1),
(20, 'cpr', 'True or False: The first aider should introduce themselves and ask for consent.', '[\"True\",\"False\"]', 0, 2),
(21, 'cpr', 'True or False: Unconsciousness should be established.', '[\"True\",\"False\"]', 0, 3),
(22, 'cpr', 'When Medical Assistance was activated, it should have:', '[\"Hospital number\",\"Instructions about victim/s status and location\",\"Caller\'s details\",\"Instructions when to end call\",\"All of the above\"]', 4, 4),
(23, 'cpr', 'Airway should be ___ using the correct technique. Open the mouth including the tongue. Finger __ was done if positive for obstruction.', '[\"sweep, opened\",\"closed, sweep\",\"opened, sweep\",\"sweep, closed\"]', 2, 5),
(24, 'cpr', 'Breathing and Pulse was assessed for _ seconds. LLF considered. Carotid Pulse checked.', '[\"5 seconds\",\"12 seconds\",\"7 seconds\",\"10 seconds\"]', 3, 6),
(25, 'cpr', 'Perform CPR for _ minutes, _ cycles (30 compressions: 2 blow/cycle)', '[\"2 minutes, 5 cycles\",\"3 minutes, 10 cycles\",\"4 minutes, 3 cycles\",\"5 minutes, 10 cycles\"]', 0, 7),
(26, 'cpr', 'Re-assess breathing and circulation for _ seconds.', '[\"5 seconds\",\"3 seconds\",\"10 seconds\",\"8 seconds\"]', 2, 8),
(27, 'cpr', 'Perform RB for __ minutes, _ cycles (starts and ends with blow)', '[\"3 minutes, 10 cycles\",\"10 minutes, 20 cycles\",\"4 minutes, 30 cycles\",\"2 minutes, 24 cycles\"]', 3, 9),
(28, 'cpr', 'Re-assess breathing and circulation for _ seconds.', '[\"3 seconds\",\"20 seconds\",\"15 seconds\",\"10 seconds\"]', 3, 10),
(29, 'cpr', 'Do __ position and care for shock.', '[\"circulating\",\"resting\",\"recovery\",\"body\"]', 2, 11),
(30, 'cpr', 'Do secondary survey:', '[\"BDOTS was checked: Back, Front, note chest tenderness\",\"Spine alignment was checked\",\"Interview relative/bystander for pertinent emergency details\",\"SAMPLE history. Vital Signs (BP, PR, RR) were taken.\",\"Documentation\",\"All of the above\"]', 5, 12),
(31, 'cpr', 'True or False: Indicate when to stop CPR: S-T-O-P-S', '[\"True\",\"False\"]', 0, 13),
(32, 'cpr', 'True or False: PPE was worn and proper disinfection done during procedure.', '[\"True\",\"False\"]', 0, 14),
(33, 'cpr', 'True or False: CPR mask should not be used on the victim during CPR and RB.', '[\"True\",\"False\"]', 1, 15),
(34, 'mobility', 'TRANSFERRING THE CLIENT FROM BED TO WHEELCHAIR - True or False: Pre-procedure (Greet/introduction, explain procedure, check ID bracelet, consent).', '[\"True\",\"False\"]', 0, 1),
(35, 'mobility', 'True or False: Collects transfer paraphernalia: wheelchair/armchair, nonskid shoes, sheet of paper/rubber mat, lap blanket, towels/seat cushion if needed, gait belt.', '[\"True\",\"False\"]', 0, 2),
(36, 'mobility', 'Screen __, lower __.', '[\"bed, patient\",\"patient, bed\",\"patient, chair\",\"chair, patient\"]', 1, 3),
(37, 'mobility', 'Choose the correct sentence: Places the chair at the head of the bed. The chair back is even with the headboard.', '[\"Places a folded bath towel or cushion on the seat if needed.\",\"Place a pillow against the backrest.\",\"Locks the wheelchair wheels and bed wheels.\",\"Removes/swings away the footrests.\",\"All of the above\"]', 4, 4),
(38, 'mobility', 'True or False: Signal lights should be removed, bed rails should be lowered, check vital signs, fan-folded linens to foot of bed, Puts on the person\'s shoes while he/she is still lying in bed.', '[\"True\",\"False\"]', 0, 5),
(39, 'mobility', 'Moving patient into sitting position:', '[\"Long-sitting position\",\"Dangling position\",\"Fowler\'s position\",\"All of the above\"]', 3, 6),
(40, 'mobility', 'Asks the client to hold onto the edge of the mattress with the strong arm or supports the person in the __ position.', '[\"laying\",\"recovery\",\"sitting\",\"All of the above\"]', 2, 7),
(41, 'mobility', 'True or False: It\'s okay to leave the person alone. Providing support is unnecessary.', '[\"True\",\"False\"]', 1, 8),
(42, 'mobility', 'True or False: Checks the person\'s condition. Asks how the person feels (dizziness/lightheadedness), pulse and respiration, difficulty of breathing, cyanosis.', '[\"True\",\"False\"]', 0, 9),
(43, 'mobility', 'Ask the client to scoot forward (or assist when needed) until feet touches the __.', '[\"chair\",\"bed\",\"wall\",\"floor\"]', 3, 10),
(44, 'mobility', 'True or False: Applies the transfer belt/ or do manual procedure. Transfer belt is correctly attached. Transfer belt is not too tight or loose.', '[\"True\",\"False\"]', 0, 11),
(45, 'mobility', 'True or False: Brace your knee against patient\'s strong knee. Ask the patient to lean backward. Place arm on client\'s shoulder blade while holding the gait belt. Instruct patient to push himself/herself up with strong arm (or hold on the wheelchair\'s armrest) as you pull him/her in standing position. Count to 5.', '[\"True\",\"False\"]', 1, 12),
(46, 'mobility', 'True or False: Ask client if he feels dizzy.', '[\"True\",\"False\"]', 0, 13),
(47, 'mobility', 'Pivot patient. Ask the patient to step __ leg towards the wheelchair while assisting __ leg. Ask patient step back until back of knees touch the __ of seat', '[\"strong, weak, middle\",\"weak, strong, middle\",\"strong, weak, edge\",\"weak, strong, edge\"]', 2, 14),
(48, 'mobility', 'Gently sits the person on the chair. Make sure ___ touches the backrest/pillow. Remove gait belt.', '[\"back\",\"buttocks\",\"shoulder\",\"waist\"]', 1, 15),
(49, 'mobility', 'Cover the client with lap blanket. Places feet on the foot rest. _ first.', '[\"strong\",\"weak\"]', 1, 16),
(50, 'mobility', 'True or False: Demonstrates proper maneuvering of wheelchair in and out of room.', '[\"True\",\"False\"]', 0, 17),
(51, 'mobility', 'TRANSFERRING THE CLIENT FROM WHEELCHAIR TO BED - Places the chair at the _ of the bed. The chair back is even with the headboard. _ the wheelchair wheels and bed wheels.', '[\"edge, locks\",\"head, locks\",\"middle, locks\",\"corner, locks\"]', 1, 18),
(52, 'mobility', 'True or False: Remove blanket. Remove feet from foot rest. Return gait belt.', '[\"True\",\"False\"]', 0, 19),
(53, 'mobility', 'Choose the next step: Brace your knee against patient\'s weak knee.', '[\"Ask the patient to lean forward. Place arm on client\'s shoulder blade while holding the gait belt\",\"Instruct patient to push himself/herself up with strong arm on the wheelchair\'s armrest as you pull him/her in standing position.\",\"All of the above\"]', 2, 20),
(54, 'mobility', 'True or False: Ask client if he feels dizzy.', '[\"True\",\"False\"]', 0, 21),
(55, 'mobility', 'Pivot patient. Ask the patient to step __ leg towards the bed while assisting __ leg. Ask patient step back until back of __ touch the bed.', '[\"weak, strong, knees\",\"weak, strong, head\",\"strong, weak, head\",\"strong, weak, knees\"]', 3, 22),
(56, 'mobility', 'True or False: Ask client to hold onto the edge of seat. Gently sits the person on the bed. Do not remove the gait belt.', '[\"True\",\"False\"]', 1, 23),
(57, 'mobility', 'Scoot client __. Support the shoulder and legs laying the client back to the bed.', '[\"forwards\",\"backwards\",\"sidewards\",\"All of the above\"]', 1, 24),
(58, 'mobility', 'Remove non-skid __ and paper towel. Make sure client is properly aligned. Cover client with top linens.', '[\"slippers\",\"shoes\",\"sandals\",\"barefoot\"]', 0, 25),
(59, 'mobility', 'Return signal light, raise side rails, unscreen client, thanks client for his/her cooperation, do aftercare, wash hands, and __.', '[\"document\",\"record\",\"rest\",\"leave\"]', 0, 26),
(60, 'infant', 'True or False: Hands should be washed and materials should be prepared.', '[\"True\",\"False\"]', 0, 1),
(61, 'infant', 'Ounces of milk formula is considered:', '[\"Doctor\'s order\",\"Manufacturer\'s recommendation\",\"Scoop to water ratio\",\"All of the above\"]', 3, 2),
(62, 'infant', 'True or False: Bottle is filled with cold water. The required/desired number of scoops of milk formula is prepared.', '[\"True\",\"False\"]', 1, 3),
(63, 'infant', 'The bottle is shaken in __?', '[\"circular motion if the bottle has no stopper\",\"up and down if the bottle has a stopper\",\"Both are correct ways\"]', 2, 4),
(64, 'infant', 'True or False: The nipple is held for aseptic purposes', '[\"True\",\"False\"]', 1, 5),
(65, 'infant', 'True or False: The baby is placed in a comfortable position and is held securely in the CG\'s arms (cradle position).', '[\"True\",\"False\"]', 0, 6),
(66, 'infant', 'True or False: The temperature of the milk formula is checked using the outer wrist.', '[\"True\",\"False\"]', 1, 7),
(67, 'infant', 'True or False: The bottle was tilted so that the nipple and bottleneck are filled with milk.', '[\"True\",\"False\"]', 0, 8),
(68, 'infant', 'True or False: The baby is fed accordingly. Rooting reflex was elicited to open baby\'s mouth.', '[\"True\",\"False\"]', 0, 9),
(69, 'infant', 'The baby was burped during the middle of the feeding or everything of the formula was consumed.', '[\"Over the shoulder\",\"Over the lap\",\"Rocking or sitting\",\"All of the above\"]', 3, 10),
(70, 'infant', 'On all _ methods, baby\'s security was taken into consideration', '[\"3\",\"6\",\"9\",\"5\"]', 0, 11),
(71, 'infant', 'Continue feeding then _ again.', '[\"rest\",\"prepare\",\"burp\",\"feed\"]', 2, 12),
(72, 'infant', 'Comforted the baby before returning to the crib. Crib rails __.', '[\"up\",\"down\",\"forward\",\"backward\"]', 0, 13),
(73, 'infant', 'Left-over milk: Large amount left - Refrigerate and consume within _ hours. Discard after _ hours.', '[\"2\",\"4\",\"6\",\"8\"]', 1, 14),
(74, 'infant', 'True or False: Small amount left-over milk should be discarded.', '[\"True\",\"False\"]', 0, 15),
(75, 'infant', 'True or False: Aftercare. Do not return all materials that were used.', '[\"True\",\"False\"]', 1, 16),
(76, 'hygiene', 'SHAVING - True or False: Pre-procedure includes greeting, introduce yourself, check ID bracelet, and explain procedure.', '[\"True\",\"False\"]', 0, 1),
(77, 'hygiene', 'Wash hands and collect all materials. Fill basin with _ water and arrange all materials on overbed table.', '[\"hot\",\"cold\",\"warm\",\"cool\"]', 2, 2),
(78, 'hygiene', 'True or False: Screen patient, raise bed, remove signal lights, lower bedside rails and place patient in semi-fowlers position.', '[\"True\",\"False\"]', 0, 3),
(79, 'hygiene', 'True or False: Adjust the lighting to see the client\'s face clearly.', '[\"True\",\"False\"]', 0, 4),
(80, 'hygiene', 'Place the bath towel over the __. Allow the client to use a mirror if he or she would like to.', '[\"shoulder\",\"chest\",\"head\",\"back\"]', 1, 5),
(81, 'hygiene', 'True or False: Adjust the overbed table for easy reach.', '[\"True\",\"False\"]', 0, 6),
(82, 'hygiene', 'True or False: Fix the razor blade to the shaver tightly. Wash the client\'s face. Let it dry.', '[\"True\",\"False\"]', 1, 7),
(83, 'hygiene', 'Wet the wash cloth or face towel. Wring it out. Apply the washcloth or towel to the client\'s face for a few __.', '[\"minutes\",\"hours\",\"seconds\",\"days\"]', 0, 8),
(84, 'hygiene', 'True or False: Do not put on gloves. Apply shaving cream with your hands or using a shaving brush.', '[\"True\",\"False\"]', 1, 9),
(85, 'hygiene', 'Hold the client\'s skin taut with one hand and shave in the direction of hair growth. Use __ strokes around the chin and lips.', '[\"longer\",\"shorter\",\"backward\",\"forward\"]', 1, 10),
(86, 'hygiene', 'True or False: Rinse the razor frequently. Shake off excess water and lather.', '[\"True\",\"False\"]', 0, 11),
(87, 'hygiene', 'True or False: If bleeding, Do not apply pressure to the area.', '[\"True\",\"False\"]', 1, 12),
(88, 'hygiene', 'Wash off remaining shaving cream or soap from the client\'s face, then dry with a __.', '[\"tissue\",\"handkerchief\",\"cloth\",\"towel\"]', 3, 13),
(89, 'hygiene', 'True or False: Apply aftershave lotion if requested.', '[\"True\",\"False\"]', 0, 14),
(90, 'hygiene', 'True or False: Do not remove the towel and gloves. Move the overhead table to the side of the bed.', '[\"True\",\"False\"]', 1, 15),
(91, 'hygiene', 'True or False: Return signal lights, lower bed, raise siderails, do aftercare, unscreen the patient, thank patient for cooperation, wash hands and report and document bleeding or nicks.', '[\"True\",\"False\"]', 0, 16);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_scores`
--

CREATE TABLE `quiz_scores` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quiz_name` varchar(50) NOT NULL,
  `steps` int(11) DEFAULT NULL,
  `total_steps` int(11) DEFAULT NULL,
  `percentage` int(11) DEFAULT NULL,
  `mistakes` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_scores`
--

INSERT INTO `quiz_scores` (`id`, `user_id`, `quiz_name`, `steps`, `total_steps`, `percentage`, `mistakes`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'vitals', 140, 150, 93, 1, 'Competent', '2026-01-27 12:27:18', '2026-06-11 05:22:45'),
(12, 2, 'vitals', 150, 150, 100, 0, 'Competent', '2026-01-27 12:56:47', '2026-03-18 06:28:13'),
(19, 1, 'mobility', 260, 260, 100, 0, 'Competent', '2026-01-28 12:06:50', '2026-04-20 13:12:57'),
(20, 1, 'cpr', 150, 150, 100, 0, 'Competent', '2026-01-28 12:07:41', '2026-05-09 11:59:31'),
(24, 2, 'mobility', 250, 260, 96, 1, 'Competent', '2026-01-28 12:09:46', '2026-03-18 06:32:30'),
(29, 1, 'infant', 160, 160, 100, 0, 'Competent', '2026-01-28 12:41:16', '2026-04-20 13:16:22'),
(30, 2, 'infant', 60, 160, 38, 3, 'Incompetent', '2026-01-28 12:42:06', '2026-01-29 06:48:06'),
(34, 2, 'hygiene', 30, 160, 19, 3, 'Incompetent', '2026-01-29 06:55:21', '2026-01-29 06:55:36'),
(39, 2, 'cpr_simulation', 13, 13, 100, 0, 'Competent', '2026-03-11 06:50:52', '2026-03-11 07:48:06'),
(55, 2, 'cpr', 150, 150, 100, 0, 'Competent', '2026-03-18 06:29:57', '2026-03-18 06:29:57'),
(58, 3, 'vitals', 10, 150, 7, 3, 'Incompetent', '2026-04-04 11:43:08', '2026-04-04 11:43:42'),
(60, 4, 'vitals', 0, 150, 0, 0, 'Incompetent', '2026-04-05 11:30:07', '2026-04-05 11:40:55'),
(62, 5, 'vitals', 0, 150, 0, 0, 'Incompetent', '2026-04-05 14:04:14', '2026-04-05 14:04:14'),
(63, 5, 'cpr', 0, 150, 0, 3, 'Incompetent', '2026-04-05 14:07:53', '2026-04-05 14:07:53'),
(71, 1, 'hygiene', 150, 160, 94, 1, 'Competent', '2026-04-20 13:19:57', '2026-04-20 13:19:57'),
(75, 6, 'vitals', 150, 150, 100, 0, 'Competent', '2026-04-29 12:55:44', '2026-06-09 12:04:15'),
(80, 9, 'vitals', 10, 150, 7, 3, 'Incompetent', '2026-05-04 11:45:55', '2026-05-04 11:45:55'),
(81, 12, 'vitals', 40, 150, 27, 3, 'Incompetent', '2026-05-07 01:57:47', '2026-05-07 01:57:47'),
(82, 12, 'mobility', 120, 260, 46, 3, 'Incompetent', '2026-05-07 02:02:40', '2026-05-07 02:02:40'),
(83, 17, 'vitals', 130, 150, 87, 2, 'Competent', '2026-05-08 10:57:44', '2026-05-08 10:57:44'),
(84, 17, 'cpr', 150, 150, 100, 0, 'Competent', '2026-05-08 11:01:44', '2026-05-08 11:01:44'),
(85, 17, 'mobility', 210, 260, 81, 3, 'Incompetent', '2026-05-08 11:03:22', '2026-05-08 11:07:37'),
(86, 18, 'cpr', 140, 150, 93, 1, 'Competent', '2026-05-08 11:05:19', '2026-05-08 11:05:19'),
(88, 21, 'vitals', 150, 150, 100, 0, 'Competent', '2026-05-08 14:12:44', '2026-05-08 14:16:38'),
(91, 21, 'cpr', 150, 150, 100, 0, 'Competent', '2026-05-08 14:27:41', '2026-05-08 14:27:41'),
(92, 34, 'vitals', 130, 150, 87, 2, 'Competent', '2026-05-09 11:53:51', '2026-05-09 11:53:51'),
(95, 41, 'vitals', 150, 150, 100, 0, 'Competent', '2026-05-10 10:31:39', '2026-05-10 10:31:39'),
(96, 43, 'vitals', 20, 150, 13, 3, 'Incompetent', '2026-05-10 10:36:22', '2026-05-10 12:03:33'),
(97, 44, 'vitals', 130, 150, 87, 2, 'Competent', '2026-05-10 10:39:59', '2026-05-10 10:39:59'),
(98, 41, 'mobility', 260, 260, 100, 0, 'Competent', '2026-05-10 10:40:42', '2026-05-10 14:42:20'),
(99, 44, 'cpr', 140, 150, 93, 1, 'Competent', '2026-05-10 10:46:41', '2026-05-10 10:46:41'),
(100, 46, 'vitals', 130, 150, 87, 2, 'Competent', '2026-05-10 10:48:32', '2026-05-10 10:51:25'),
(101, 41, 'hygiene', 160, 160, 100, 0, 'Competent', '2026-05-10 10:48:47', '2026-05-10 10:48:47'),
(103, 44, 'infant', 140, 160, 88, 2, 'Competent', '2026-05-10 10:55:32', '2026-05-10 10:55:32'),
(104, 46, 'cpr', 150, 150, 100, 0, 'Competent', '2026-05-10 10:57:47', '2026-05-10 11:12:12'),
(105, 44, 'hygiene', 70, 160, 44, 3, 'Incompetent', '2026-05-10 10:58:34', '2026-05-10 11:02:53'),
(110, 47, 'vitals', 80, 150, 53, 3, 'Incompetent', '2026-05-10 11:15:00', '2026-05-10 11:15:00'),
(111, 47, 'cpr', 140, 150, 93, 1, 'Competent', '2026-05-10 11:21:36', '2026-05-10 11:21:36'),
(112, 47, 'mobility', 120, 260, 46, 3, 'Incompetent', '2026-05-10 11:27:30', '2026-05-10 11:27:30'),
(113, 47, 'infant', 80, 160, 50, 3, 'Incompetent', '2026-05-10 11:31:26', '2026-05-10 11:31:26'),
(114, 47, 'hygiene', 140, 160, 88, 2, 'Competent', '2026-05-10 11:34:44', '2026-05-10 11:34:44'),
(115, 48, 'vitals', 150, 150, 100, 0, 'Competent', '2026-05-10 11:37:43', '2026-05-10 11:43:13'),
(117, 46, 'mobility', 210, 260, 81, 3, 'Incompetent', '2026-05-10 11:43:03', '2026-05-10 11:43:03'),
(119, 43, 'cpr', 50, 150, 33, 3, 'Incompetent', '2026-05-10 11:44:25', '2026-05-10 11:57:56'),
(120, 48, 'mobility', 150, 260, 58, 3, 'Incompetent', '2026-05-10 11:48:05', '2026-05-10 11:48:05'),
(121, 43, 'mobility', 40, 260, 15, 3, 'Incompetent', '2026-05-10 11:49:26', '2026-05-10 11:49:26'),
(122, 43, 'hygiene', 30, 160, 19, 3, 'Incompetent', '2026-05-10 11:53:08', '2026-05-10 11:53:08'),
(123, 43, 'infant', 10, 160, 6, 3, 'Incompetent', '2026-05-10 11:53:33', '2026-05-10 11:57:26'),
(126, 44, 'mobility', 200, 260, 77, 3, 'Incompetent', '2026-05-10 12:02:29', '2026-05-10 12:07:48'),
(129, 41, 'infant', 160, 160, 100, 0, 'Competent', '2026-05-10 12:25:30', '2026-05-10 14:30:09'),
(131, 41, 'cpr', 150, 150, 100, 0, 'Competent', '2026-05-10 12:32:10', '2026-05-10 12:35:30'),
(134, 51, 'vitals', 30, 150, 20, 3, 'Incompetent', '2026-05-10 13:28:25', '2026-05-10 13:28:25'),
(135, 51, 'cpr', 140, 150, 93, 1, 'Competent', '2026-05-10 13:34:51', '2026-05-10 13:34:51'),
(136, 51, 'mobility', 240, 260, 92, 2, 'Competent', '2026-05-10 13:41:07', '2026-05-10 14:05:35'),
(142, 57, 'vitals', 140, 150, 93, 1, 'Competent', '2026-05-11 10:46:38', '2026-05-11 10:48:42'),
(144, 60, 'vitals', 130, 150, 87, 2, 'Competent', '2026-05-12 02:41:38', '2026-05-12 02:44:32'),
(147, 62, 'vitals', 130, 150, 87, 2, 'Competent', '2026-05-12 07:52:55', '2026-05-12 07:52:55'),
(148, 62, 'cpr', 140, 150, 93, 1, 'Competent', '2026-05-12 07:58:39', '2026-05-12 07:58:39'),
(149, 62, 'mobility', 90, 260, 35, 3, 'Incompetent', '2026-05-12 08:02:12', '2026-05-12 08:02:12'),
(150, 62, 'infant', 80, 160, 50, 3, 'Incompetent', '2026-05-12 08:04:09', '2026-05-12 08:04:09'),
(151, 62, 'hygiene', 70, 160, 44, 3, 'Incompetent', '2026-05-12 08:06:20', '2026-05-12 08:06:20'),
(152, 60, 'cpr', 140, 150, 93, 1, 'Competent', '2026-05-12 08:27:58', '2026-05-12 08:29:05'),
(154, 60, 'mobility', 250, 260, 96, 1, 'Competent', '2026-05-12 08:30:57', '2026-05-12 08:44:30'),
(161, 60, 'hygiene', 140, 160, 88, 2, 'Competent', '2026-05-12 08:46:14', '2026-05-12 08:47:45'),
(163, 64, 'vitals', 150, 150, 100, 0, 'Competent', '2026-05-12 11:53:17', '2026-05-12 11:56:14'),
(166, 64, 'cpr', 140, 150, 93, 1, 'Competent', '2026-05-12 12:04:38', '2026-05-12 12:04:38'),
(167, 64, 'mobility', 240, 260, 92, 2, 'Competent', '2026-05-12 12:06:54', '2026-05-12 12:12:56'),
(170, 64, 'infant', 150, 160, 94, 1, 'Competent', '2026-05-12 12:16:53', '2026-05-12 12:16:53'),
(171, 64, 'hygiene', 150, 160, 94, 1, 'Competent', '2026-05-12 12:18:07', '2026-05-12 12:20:54'),
(173, 45, 'mobility', 240, 260, 92, 2, 'Competent', '2026-05-14 02:05:37', '2026-05-14 02:31:57'),
(178, 45, 'infant', 150, 160, 94, 1, 'Competent', '2026-05-14 02:41:28', '2026-05-14 02:48:07'),
(181, 45, 'hygiene', 160, 160, 100, 0, 'Competent', '2026-05-14 02:56:10', '2026-05-14 02:57:37'),
(183, 45, 'cpr', 140, 150, 93, 1, 'Competent', '2026-05-14 03:05:19', '2026-05-14 03:07:51'),
(186, 45, 'vitals', 130, 150, 87, 2, 'Competent', '2026-05-14 03:20:17', '2026-05-14 03:22:23'),
(197, 73, 'vitals', 10, 150, 7, 3, 'Incompetent', '2026-07-01 06:56:09', '2026-07-01 06:56:09'),
(198, 74, 'vitals', 10, 150, 7, 3, 'Incompetent', '2026-07-01 07:11:05', '2026-07-01 07:11:05');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_settings`
--

CREATE TABLE `quiz_settings` (
  `quiz_id` varchar(50) NOT NULL,
  `quiz_label` varchar(255) NOT NULL,
  `score_redirect` varchar(255) NOT NULL COMMENT 'PHP file to redirect to after quiz',
  `timer_seconds` int(11) NOT NULL DEFAULT 600,
  `steps_per_q` int(11) NOT NULL DEFAULT 10,
  `max_mistakes` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_settings`
--

INSERT INTO `quiz_settings` (`quiz_id`, `quiz_label`, `score_redirect`, `timer_seconds`, `steps_per_q`, `max_mistakes`) VALUES
('cpr', 'CPR Training - Quiz', 'cprquizscore.php', 600, 10, 3),
('hygiene', 'Elderly Hygiene and Grooming - Quiz', 'hygienequizscore.php', 600, 10, 3),
('infant', 'Infant Care - Quiz', 'infantquizscore.php', 600, 10, 3),
('mobility', 'Assisted Mobility - Quiz', 'mobilityquizscore.php', 600, 10, 3),
('vitals', 'Checking Vital Signs - Quiz', 'vitalsquizscore.php', 600, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `simulation_actions`
--

CREATE TABLE `simulation_actions` (
  `id` int(11) NOT NULL,
  `sim_id` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL COMMENT 'action key e.g. touch, wash, cpr',
  `icon` varchar(255) NOT NULL COMMENT 'path to icon image'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `simulation_actions`
--

INSERT INTO `simulation_actions` (`id`, `sim_id`, `action`, `icon`) VALUES
(1, 'vitalsignsimulation', 'touch', 'icons/hand.png'),
(2, 'vitalsignsimulation', 'mouth', 'icons/mouth.png'),
(3, 'vitalsignsimulation', 'listen', 'icons/ear.png'),
(4, 'vitalsignsimulation', 'call', 'icons/phone.png'),
(5, 'vitalsignsimulation', 'cpr', 'icons/cpr.png'),
(6, 'vitalsignsimulation', 'exercise', 'icons/exercise.png'),
(7, 'vitalsignsimulation', 'lift', 'icons/lift.png'),
(8, 'vitalsignsimulation', 'walker', 'icons/walker.png'),
(9, 'vitalsignsimulation', 'love', 'icons/self-love.png'),
(10, 'vitalsignsimulation', 'lotion', 'icons/lotion.png'),
(11, 'vitalsignsimulation', 'wash', 'icons/washing-hand.png'),
(12, 'vitalsignsimulation', 'cotton', 'icons/cotton.png'),
(13, 'vitalsignsimulation', 'bp', 'icons/bp-apparatus.png'),
(14, 'vitalsignsimulation', 'note', 'icons/note.png'),
(15, 'vitalsignsimulation', 'stethoscope', 'icons/stethoscope.png'),
(16, 'cpr_simulation', 'touch', 'icons/hand.png'),
(17, 'cpr_simulation', 'mouth', 'icons/mouth.png'),
(18, 'cpr_simulation', 'listen', 'icons/ear.png'),
(19, 'cpr_simulation', 'call', 'icons/phone.png'),
(20, 'cpr_simulation', 'cpr', 'icons/cpr.png'),
(21, 'cpr_simulation', 'exercise', 'icons/exercise.png'),
(22, 'cpr_simulation', 'lift', 'icons/lift.png'),
(23, 'cpr_simulation', 'walker', 'icons/walker.png'),
(24, 'cpr_simulation', 'love', 'icons/self-love.png'),
(25, 'cpr_simulation', 'lotion', 'icons/lotion.png'),
(26, 'mobilitysimulation', 'touch', 'icons/hand.png'),
(27, 'mobilitysimulation', 'mouth', 'icons/mouth.png'),
(28, 'mobilitysimulation', 'listen', 'icons/ear.png'),
(29, 'mobilitysimulation', 'call', 'icons/phone.png'),
(30, 'mobilitysimulation', 'cpr', 'icons/cpr.png'),
(31, 'mobilitysimulation', 'exercise', 'icons/exercise.png'),
(32, 'mobilitysimulation', 'lift', 'icons/lift.png'),
(33, 'mobilitysimulation', 'walker', 'icons/walker.png'),
(34, 'mobilitysimulation', 'love', 'icons/self-love.png'),
(35, 'mobilitysimulation', 'lotion', 'icons/lotion.png'),
(36, 'mobilitysimulation', 'wash', 'icons/washing-hand.png'),
(37, 'mobilitysimulation', 'cotton', 'icons/cotton.png'),
(38, 'mobilitysimulation', 'bp', 'icons/bp-apparatus.png'),
(39, 'mobilitysimulation', 'note', 'icons/note.png'),
(40, 'mobilitysimulation', 'stethoscope', 'icons/stethoscope.png'),
(41, 'mobilitysimulation', 'milk', 'icons/milk.png'),
(42, 'mobilitysimulation', 'water', 'icons/warm-water.png'),
(43, 'mobilitysimulation', 'shake', 'icons/shake.png'),
(44, 'mobilitysimulation', 'feed', 'icons/feed.png'),
(45, 'mobilitysimulation', 'burp', 'icons/burp.png'),
(46, 'mobilitysimulation', 'wheelchair', 'icons/wheelchair.png'),
(47, 'mobilitysimulation', 'care', 'icons/care.png'),
(48, 'infantsimulation', 'touch', 'icons/hand.png'),
(49, 'infantsimulation', 'mouth', 'icons/mouth.png'),
(50, 'infantsimulation', 'listen', 'icons/ear.png'),
(51, 'infantsimulation', 'call', 'icons/phone.png'),
(52, 'infantsimulation', 'cpr', 'icons/cpr.png'),
(53, 'infantsimulation', 'exercise', 'icons/exercise.png'),
(54, 'infantsimulation', 'lift', 'icons/lift.png'),
(55, 'infantsimulation', 'walker', 'icons/walker.png'),
(56, 'infantsimulation', 'love', 'icons/self-love.png'),
(57, 'infantsimulation', 'lotion', 'icons/lotion.png'),
(58, 'infantsimulation', 'wash', 'icons/washing-hand.png'),
(59, 'infantsimulation', 'cotton', 'icons/cotton.png'),
(60, 'infantsimulation', 'bp', 'icons/bp-apparatus.png'),
(61, 'infantsimulation', 'note', 'icons/note.png'),
(62, 'infantsimulation', 'stethoscope', 'icons/stethoscope.png'),
(63, 'infantsimulation', 'milk', 'icons/milk.png'),
(64, 'infantsimulation', 'water', 'icons/warm-water.png'),
(65, 'infantsimulation', 'shake', 'icons/shake.png'),
(66, 'infantsimulation', 'feed', 'icons/feed.png'),
(67, 'infantsimulation', 'burp', 'icons/burp.png'),
(68, 'hygienesimulation', 'touch', 'icons/hand.png'),
(69, 'hygienesimulation', 'mouth', 'icons/mouth.png'),
(70, 'hygienesimulation', 'listen', 'icons/ear.png'),
(71, 'hygienesimulation', 'call', 'icons/phone.png'),
(72, 'hygienesimulation', 'cpr', 'icons/cpr.png'),
(73, 'hygienesimulation', 'exercise', 'icons/exercise.png'),
(74, 'hygienesimulation', 'lift', 'icons/lift.png'),
(75, 'hygienesimulation', 'walker', 'icons/walker.png'),
(76, 'hygienesimulation', 'love', 'icons/self-love.png'),
(77, 'hygienesimulation', 'lotion', 'icons/lotion.png');

-- --------------------------------------------------------

--
-- Table structure for table `simulation_scores`
--

CREATE TABLE `simulation_scores` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `simulation_name` varchar(100) DEFAULT NULL,
  `steps` int(11) DEFAULT NULL,
  `total_steps` int(11) DEFAULT NULL,
  `percentage` int(11) DEFAULT NULL,
  `mistakes` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `simulation_scores`
--

INSERT INTO `simulation_scores` (`id`, `user_id`, `simulation_name`, `steps`, `total_steps`, `percentage`, `mistakes`, `status`, `created_at`) VALUES
(1, 2, 'cpr_simulation', 13, 13, 100, 0, 'Competent', '2026-07-02 11:29:05'),
(2, 2, 'hygienesimulation', 10, 10, 100, 0, 'Competent', '2026-07-02 11:29:05'),
(3, 2, 'vitalsignsimulation', 0, 15, 0, 3, 'Incompetent', '2026-07-02 11:29:05'),
(4, 2, 'infantsignsimulation', 9, 9, 100, 0, 'Competent', '2026-07-02 11:29:05'),
(5, 2, 'infantsimulation', 9, 9, 100, 0, 'Competent', '2026-07-02 11:29:05'),
(6, 2, 'mobilitysimulation', 12, 12, 100, 1, 'Competent', '2026-07-02 11:29:05'),
(7, 1, 'vitalsignsimulation', 16, 16, 100, 1, 'Competent', '2026-07-02 11:29:05'),
(8, 3, 'vitalsignsimulation', 15, 15, 100, 0, 'Competent', '2026-07-02 11:29:05'),
(9, 4, 'vitalsignsimulation', 2, 15, 13, 3, 'Incompetent', '2026-07-02 11:29:05'),
(10, 5, 'vitalsignsimulation', 15, 15, 100, 2, 'Competent', '2026-07-02 11:29:05'),
(11, 1, 'mobilitysimulation', 12, 12, 100, 1, 'Competent', '2026-07-02 11:29:05'),
(12, 1, 'cpr_simulation', 13, 13, 100, 0, 'Competent', '2026-07-02 11:29:05'),
(13, 1, 'infantsimulation', 9, 9, 100, 0, 'Competent', '2026-07-02 11:29:05'),
(14, 1, 'hygienesimulation', 10, 10, 100, 0, 'Competent', '2026-07-02 11:29:05'),
(15, 6, 'vitalsignsimulation', 15, 15, 100, 0, 'Competent', '2026-07-02 11:29:05'),
(16, 6, 'cpr_simulation', 1, 13, 8, 3, 'Incompetent', '2026-07-02 11:29:05'),
(17, 9, 'infantsimulation', 0, 9, 0, 3, 'Incompetent', '2026-07-02 11:29:05'),
(18, 17, 'vitalsignsimulation', 1, 15, 7, 3, 'Incompetent', '2026-07-02 11:29:05'),
(19, 21, 'vitalsignsimulation', 1, 15, 7, 3, 'Incompetent', '2026-07-02 11:29:05'),
(20, 34, 'vitalsignsimulation', 15, 15, 100, 2, 'Competent', '2026-07-02 11:29:05'),
(21, 41, 'vitalsignsimulation', 15, 15, 100, 0, 'Competent', '2026-07-02 11:29:05'),
(22, 46, 'vitalsignsimulation', 15, 15, 100, 1, 'Competent', '2026-07-02 11:29:05'),
(23, 47, 'vitalsignsimulation', 3, 15, 20, 3, 'Incompetent', '2026-07-02 11:29:05'),
(24, 46, 'cpr_simulation', 13, 13, 100, 1, 'Competent', '2026-07-02 11:29:05'),
(25, 47, 'cpr_simulation', 13, 13, 100, 2, 'Competent', '2026-07-02 11:29:05'),
(26, 47, 'mobilitysimulation', 2, 12, 17, 3, 'Incompetent', '2026-07-02 11:29:05'),
(27, 47, 'infantsimulation', 1, 9, 11, 3, 'Incompetent', '2026-07-02 11:29:05'),
(28, 47, 'hygienesimulation', 6, 10, 60, 3, 'Incompetent', '2026-07-02 11:29:05'),
(29, 43, 'vitalsignsimulation', 0, 15, 0, 3, 'Incompetent', '2026-07-02 11:29:05'),
(30, 43, 'cpr_simulation', 3, 13, 23, 3, 'Incompetent', '2026-07-02 11:29:05'),
(31, 46, 'mobilitysimulation', 12, 12, 100, 2, 'Competent', '2026-07-02 11:29:05'),
(32, 43, 'mobilitysimulation', 1, 12, 8, 3, 'Incompetent', '2026-07-02 11:29:05'),
(33, 43, 'hygienesimulation', 3, 10, 30, 3, 'Incompetent', '2026-07-02 11:29:05'),
(34, 43, 'infantsimulation', 0, 9, 0, 3, 'Incompetent', '2026-07-02 11:29:05'),
(35, 41, 'mobilitysimulation', 12, 12, 100, 0, 'Competent', '2026-07-02 11:29:05'),
(36, 41, 'infantsimulation', 9, 9, 100, 0, 'Competent', '2026-07-02 11:29:05'),
(37, 41, 'cpr_simulation', 13, 13, 100, 0, 'Competent', '2026-07-02 11:29:05'),
(38, 41, 'hygienesimulation', 10, 10, 100, 0, 'Competent', '2026-07-02 11:29:05'),
(39, 51, 'vitalsignsimulation', 1, 15, 7, 3, 'Incompetent', '2026-07-02 11:29:05'),
(40, 51, 'cpr_simulation', 13, 13, 100, 1, 'Competent', '2026-07-02 11:29:05'),
(41, 51, 'mobilitysimulation', 2, 12, 17, 3, 'Incompetent', '2026-07-02 11:29:05'),
(42, 62, 'vitalsignsimulation', 3, 15, 20, 3, 'Incompetent', '2026-07-02 11:29:05'),
(43, 60, 'vitalsignsimulation', 0, 15, 0, 3, 'Incompetent', '2026-07-02 11:29:05'),
(44, 64, 'vitalsignsimulation', 15, 15, 100, 2, 'Competent', '2026-07-02 11:29:05'),
(45, 64, 'cpr_simulation', 13, 13, 100, 0, 'Competent', '2026-07-02 11:29:05'),
(46, 64, 'hygienesimulation', 10, 10, 100, 1, 'Competent', '2026-07-02 11:29:05'),
(47, 64, 'infantsimulation', 9, 9, 100, 1, 'Competent', '2026-07-02 11:29:05'),
(48, 64, 'mobilitysimulation', 12, 12, 100, 2, 'Competent', '2026-07-02 11:29:05'),
(49, 45, 'mobilitysimulation', 12, 12, 100, 1, 'Competent', '2026-07-02 11:29:05'),
(50, 45, 'infantsimulation', 9, 9, 100, 1, 'Competent', '2026-07-02 11:29:05'),
(51, 45, 'hygienesimulation', 10, 10, 100, 2, 'Competent', '2026-07-02 11:29:05'),
(52, 45, 'cpr_simulation', 13, 13, 100, 1, 'Competent', '2026-07-02 11:29:05'),
(53, 45, 'vitalsignsimulation', 15, 15, 100, 2, 'Competent', '2026-07-02 11:29:05'),
(54, 9, 'mobilitysimulation', 0, 12, 0, 3, 'Incompetent', '2026-07-02 11:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `simulation_settings`
--

CREATE TABLE `simulation_settings` (
  `sim_id` varchar(50) NOT NULL,
  `sim_title` varchar(255) NOT NULL,
  `scenario` text NOT NULL,
  `score_redirect` varchar(255) NOT NULL,
  `max_mistakes` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `simulation_settings`
--

INSERT INTO `simulation_settings` (`sim_id`, `sim_title`, `scenario`, `score_redirect`, `max_mistakes`) VALUES
('cpr_simulation', 'CPR Training Simulation', 'Scenario: You are a caretaker looking after an elderly who suddenly collapsed and is not breathing. You must perform CPR to save their life.', 'cprsimulationscore.php', 3),
('hygienesimulation', 'Elderly Hygiene and Grooming Simulation', 'Scenario: You are a newly assigned caretaker for a family\'s elderly. Your goal is to explain and demonstrate healthcare provider\'s interventions.', 'hygienesimulationscore.php', 3),
('infantsimulation', 'Infant Care Simulation', 'Scenario: You are assigned to take care of a client\'s infant.', 'infantsimulationscore.php', 3),
('mobilitysimulation', 'Assisted Mobility Simulation', 'Scenario: You are assigned to transfer a client from wheelchair to bed.', 'mobilitysimulationscore.php', 3),
('vitalsignsimulation', 'Checking Vital  Sign Simulation', 'Scenario: You are a newly caregiver assigned to check the vital signs of the clients.', 'vitalssimulationscore.php', 3);

-- --------------------------------------------------------

--
-- Table structure for table `simulation_steps`
--

CREATE TABLE `simulation_steps` (
  `id` int(11) NOT NULL,
  `sim_id` varchar(50) NOT NULL,
  `step_text` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `correct_action` varchar(50) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `simulation_steps`
--

INSERT INTO `simulation_steps` (`id`, `sim_id`, `step_text`, `image`, `correct_action`, `sort_order`) VALUES
(1, 'vitalsignsimulation', '1. Wash hands.', 'sim_uploads/vitalsignsimulation/step_1780229324.png', 'wash', 1),
(2, 'vitalsignsimulation', '2. Prepare the BP apparatus. Clean the stethoscope (earpiece, binaurals, tubing, diaphragm and bell) cleaned with cotton balls soaked in alcohol.', 'm9/2.png', 'cotton', 2),
(3, 'vitalsignsimulation', '3. Upper arm is exposed and the cuff of the BP apparatus is wrapped around the client\'s arm 1 inch above the antecubital fossa. Must be even and snug.', 'm9/3.png', 'bp', 3),
(4, 'vitalsignsimulation', '4. 2-3 fingers are laid on the radial pulse. Valve is tightened and cuff is inflated up to the point where the pulse stops.', 'm9/4.png', 'bp', 4),
(5, 'vitalsignsimulation', '5. The point where the pulse stops in the manometer is noted then 30 mmHg is added (maximum inflation point or Maximum inflation rate)', 'm9/5.png', 'note', 5),
(6, 'vitalsignsimulation', '6. Valve is loosened and air is fully released.', 'm9/6.png', 'bp', 6),
(7, 'vitalsignsimulation', '7. Instruct patient to clasp and unclasp hands or wait for 5 seconds', 'm9/7.png', 'mouth', 7),
(8, 'vitalsignsimulation', '8. Get stethoscope. Diaphragm is placed on the palm to warm it.', 'm9/8.png', 'stethoscope', 8),
(9, 'vitalsignsimulation', '9. The brachial pulse is palpated and the stethoscope is placed over it.', 'm9/9.png', 'stethoscope', 9),
(10, 'vitalsignsimulation', '10. Valve is tightened again and cuff is inflated up to the maximum inflation point.', 'm9/10.png', 'bp', 10),
(11, 'vitalsignsimulation', '11. Valve is loosened and released slowly', 'm9/11.png', 'bp', 11),
(12, 'vitalsignsimulation', '12. Systolic and diastolic pressure are noted.', 'm9/12.png', 'note', 12),
(13, 'vitalsignsimulation', '13. Air from cuff is fully released.', 'm9/13.png', 'bp', 13),
(14, 'vitalsignsimulation', '14. BP results are recorded.', 'm9/14.png', 'note', 14),
(15, 'vitalsignsimulation', '15. Earpiece and diaphragm are cleaned with cotton balls soaked in alcohol.', 'm9/15.png', 'cotton', 15),
(16, 'cpr_simulation', '1. Check for unresponsiveness.', 'm6/img1.png', 'listen', 1),
(17, 'cpr_simulation', '2. Call for help. Activate the EMS system.', 'm6/img2.png', 'call', 2),
(18, 'cpr_simulation', '3. Position the person supine. Logroll the person so there is no twisting of the spine. The person must be on a hard, flat surface. Place the person\'s arms alongside the body.', 'm6/img3.png', 'touch', 3),
(19, 'cpr_simulation', '4. Open the airway. Use the head-tilt/chin-lift maneuver.', 'm6/img4.png', 'touch', 4),
(20, 'cpr_simulation', '5. Check for breathlessness.', 'm6/img5.png', 'listen', 5),
(21, 'cpr_simulation', '6. Give 2 breaths. Each should be 1½ to 2 seconds long. Let the person\'s chest deflate between breaths.', 'm6/img6.png', 'mouth', 6),
(22, 'cpr_simulation', '7. Check for pulselessness. Check the pulse for 5 to 10 seconds. Use your other hand to keep the airway open with the head-tilt maneuver.', 'm6/img7.png', 'touch', 7),
(23, 'cpr_simulation', '8. Give chest compressions if the person has no pulse. Give compressions at a rate of 80 to 100 per minute. Give 15 compressions and then 2 breaths. Establish a rhythm, and count out loud (try: 1 and, 2 and... 15).', 'm6/img8a.png', 'cpr', 8),
(24, 'cpr_simulation', '9. Open the airway, and give 2 breaths.', 'm6/img6.png', 'mouth', 9),
(25, 'cpr_simulation', '10. Repeat this step until 4 cycles of 15 compressions and 2 breaths are given.', 'm6/img8c.png', 'cpr', 10),
(26, 'cpr_simulation', '11. Check for a carotid pulse (3 to 5 seconds)', 'm6/img9.png', 'touch', 11),
(27, 'cpr_simulation', '12. Continue CPR if the person has no pulse. Begin with chest compressions.', 'm6/img8a.png', 'cpr', 12),
(28, 'cpr_simulation', '13. Continue the cycles of 15 compressions and 2 breaths. Check for a pulse every few minutes.', 'm6/img8c.png', 'cpr', 13),
(29, 'mobilitysimulation', '1. Places the chair at the head of the bed. The chair back is even with the headboard. Locks the wheelchair wheels and bed wheels.', 'm8/1.png', 'wheelchair', 1),
(30, 'mobilitysimulation', '2. Remove blanket. Remove feet from foot rest. Return gait belt.', 'm8/2.png', 'touch', 2),
(31, 'mobilitysimulation', '3. Brace your knee against patient\'s weak knee. Ask the patient to lean forward. Place arm on client\'s shoulder blade while holding the gait belt.', 'm8/3.png', 'care', 3),
(32, 'mobilitysimulation', '4. Instruct patient to push himself/herself up with strong arm on the wheelchair\'s armrest as you pull him/her in standing position. (Count to 3).', 'm8/4.png', 'mouth', 4),
(33, 'mobilitysimulation', '5. Ask client if he feels dizzy.', 'm8/5.png', 'mouth', 5),
(34, 'mobilitysimulation', '6. Pivot patient. Ask the patient to step strong leg towards the bed while assisting weak leg. Ask patient step back until back of knees touch the bed.', 'm8/6.png', 'mouth', 6),
(35, 'mobilitysimulation', '7. Ask client to hold onto the edge of mattress. Gently sits the person on the bed. Remove gait belt.', 'm8/7.png', 'mouth', 7),
(36, 'mobilitysimulation', '8. Scoot client backwards. Support the shoulder and legs laying the client back to the bed.', 'm8/8.png', 'care', 8),
(37, 'mobilitysimulation', '9. Scoot client backwards. Support the shoulder and legs laying the client back to the bed.', 'm8/9.png', 'care', 9),
(38, 'mobilitysimulation', '10. Scoot client backwards. Support the shoulder and legs laying the client back to the bed.', 'm8/10.png', 'care', 10),
(39, 'mobilitysimulation', '11. Remove non-skid slippers and paper towel. Make sure client is properly aligned. Cover client with top linens.', 'm8/11.png', 'touch', 11),
(40, 'mobilitysimulation', '12. Return signal light, raise side rails, unscreened client, thanks client for his/her cooperation, do aftercare, wash hands, document.', 'm8/12.png', 'touch', 12),
(41, 'infantsimulation', '1. Hands are washed and materials were prepared.', 'm10/1.png', 'wash', 1),
(42, 'infantsimulation', '2. Ounces of milk formula is considered: Doctor\'s order, Manufacturer\'s recommendation, Scoop to water ratio', 'm10/2.png', 'milk', 2),
(43, 'infantsimulation', '3. Bottle is filled with warm water. The required/desired number of scoops of milk formula is prepared.', 'm10/3.png', 'water', 3),
(44, 'infantsimulation', '4. The bottle is shaken in either of the following ways: circular motion if the bottle has no stopper / up and down if the bottle has a stopper', 'm10/4.png', 'shake', 4),
(45, 'infantsimulation', '5. Feeding: (1) The baby is placed in a comfortable position and is held securely in the CG\'s arms (cradle position). (2) The temperature of the milk formula is checked using the inner wrist. (3) The bottle was tilted so that the nipple and bottleneck are filled with milk. (4) The baby is fed accordingly. Rooting reflex was elicited to open baby\'s mouth', 'm10/5.png', 'feed', 5),
(46, 'infantsimulation', '6. The baby was burped during the middle of the feeding or half of the formula was consumed.', 'm10/6.png', 'burp', 6),
(47, 'infantsimulation', '7. Comforted the baby before returning to the crib. Crib rails up.', 'm10/7.png', 'love', 7),
(48, 'infantsimulation', '8. Left-over milk: Large amount left - Refrigerate and consume within 4 hours. Discard after 4 hours. Small amount left - Discard', 'm10/8.png', 'milk', 8),
(49, 'infantsimulation', '9. Aftercare. Return all materials used.', 'm10/9.png', 'touch', 9),
(50, 'hygienesimulation', '1. Improving mobility - Preventing deformities - Changing position every 2 hours', 'm5a/img1.png', 'exercise', 1),
(51, 'hygienesimulation', '2. Retraining affected extremities.', 'm5a/img2.png', 'lift', 2),
(52, 'hygienesimulation', '3. Prepare patient for ambulation - sitting balance/tolerance, standing balance/tolerance.', 'm5a/img3.png', 'walker', 3),
(53, 'hygienesimulation', '4. Prevent shoulder pain.', 'm5a/img4.png', 'touch', 4),
(54, 'hygienesimulation', '5. Achieve self-care.', 'm5a/img5.png', 'love', 5),
(55, 'hygienesimulation', '6. Achieve good means of communication.', 'm5a/img6.png', 'mouth', 6),
(56, 'hygienesimulation', '7. Maintain skin integrity.', 'm5a/img7.png', 'lotion', 7),
(57, 'hygienesimulation', '8. Improve family coping through health teaching.', 'm5a/img8.png', 'mouth', 8),
(58, 'hygienesimulation', '9. Home health care.', 'm5a/img9.png', 'love', 9),
(59, 'hygienesimulation', '10. Sexual function', 'm5a/img10.png', 'mouth', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('user','admin','instructor') DEFAULT 'user',
  `verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `gender`, `email`, `password`, `created_at`, `role`, `verified`) VALUES
(1, 'alexa', '', 'villar', 'female', 'alexa@gmail.com', '$2y$10$DyfTxPs8sH1OrOR2Ua4uHuXBAozrBc8ihet6Bypc4/UoHXLg2947a', '2026-01-26 12:53:58', 'user', 1),
(2, 'admin', '', '1', 'male', 'admin@gmail.com', '$2y$10$kc17cgUbhANwTmZ.qd5rPedzZffkbc58KA8YCIHnLaMKn7auPP8Oe', '2026-01-27 12:55:16', 'admin', 1),
(5, 'John', '', 'Doe', 'male', 'johndoe.ortega@gmail.com', '$2y$10$a2VSDKt/G66UbuubUxzPlu/Qz6kGlhsaycvRVwJzK0kVMasPrDFZW', '2026-04-05 13:42:53', 'user', 1),
(6, 'Jane', '', 'Doe', 'female', 'janedoe@gmail.com', '$2y$10$SO6OoUPbej4IF9tJhX5iA.avsWawJ.Xl5ybWwoCJUCYbd5zYMOzmW', '2026-04-19 12:19:10', 'instructor', 1),
(8, 'Rian Gabrielle', 'Gabriel', 'Joaquin', 'male', 'admin2@gmail.com', '$2y$10$t6elM3IZtJiQfV4GUe0vnuBB.LXnU0WcyZJJyRcdivBC3h/xmt.Qi', '2026-05-04 07:42:01', 'admin', 1),
(9, 'Andien', 'Dale', 'Zapata', 'male', 'andien@gmail.com', '$2y$10$bRI33L2c0ZNYeMKchMmcMe.XeRHpIybie74ha.6POjagzMBcSFkPq', '2026-05-04 10:46:53', 'user', 1),
(10, 'Andien', 'Dale', 'Zapata', 'male', 'admin3@gmail.com', '$2y$10$xZBD9JANH32D1Vv4PLcec.TWXCopzyDMkgx0SP05sPEd4heB5rCfS', '2026-05-04 12:20:12', 'admin', 1),
(11, 'Andien', 'Dale', 'Zapata', 'male', 'andieninstructor@gmail.com', '$2y$10$/QYG4MTaqljmIFl8meG45.m.mMyrHPmpPCsJlHfdGSc1GosZ8nK6q', '2026-05-04 12:27:02', 'instructor', 1),
(12, 'EFLEDA', 'Bambao', 'JARATA', 'female', 'efledajarata@gmail.com', '$2y$10$6HpgpkK0j/2SnU8JdZn50OFxHPIkAtBxN5q8ASVl1DoCGFplqjMK.', '2026-05-07 01:48:15', 'user', 1),
(13, 'Daphne', 'De Joya', 'Zapata', 'female', 'dzaph72@gmail.com', '$2y$10$ihzqaRncIhtSeMdWslRluOr4rP3Mt.FGZAfcbiVrfztLeIPePqsqy', '2026-05-07 02:02:41', 'user', 1),
(14, 'REJIELYN ', 'Tobias', 'Delizo', 'female', 'elymunar1230@gmail.com', '$2y$10$vNeElmqezNi2v8t5qZymQ.YqmpNx3Aw.HikYhgY3UExfzTgg2QmQ6', '2026-05-08 06:15:12', 'user', 1),
(15, 'Gem', 'Gurion ', 'Mueca ', 'female', 'gema.021703@gmail.com', '$2y$10$CBoj/zGTfgOJha5CSRy4e.DRjiWFPui2ro.qWHi4WvXDRzBG.nTOS', '2026-05-08 10:13:28', 'user', 1),
(16, 'Jessell', 'Durano ', 'Radaza', 'female', 'jessellradaza9@gmail.com', '$2y$10$Xm8USbjr4VsofvYGryA/xOz/f7L8geTrtSdFuTaKnUTIoB.01pqIK', '2026-05-08 10:50:01', 'user', 1),
(17, 'Emmalyb', 'Manejo', 'Caliguiw', 'female', 'dlare6630@gmail.com', '$2y$10$fkBiiW0bejErhqZVGamfQ.eNLE2L9WF6nTupJP0zz70gEmugEij1q', '2026-05-08 10:53:38', 'user', 1),
(18, 'Troy', 'Nisperos', 'Flores', 'male', 'christiantroynflores@gmail.com', '$2y$10$5WaeaduNJjA1HNFm5DvUoeZENfnZm/pxd.o9vUPkBzdwYedkr8PBW', '2026-05-08 11:01:16', 'user', 1),
(19, 'Bryllan Joshua', 'Dungo', 'Ringor', 'male', 'bryllan.ringor@gmail.com', '$2y$10$dUZXkySdzR1HboEIPPWSFu3xps.syeDD5kEGy4lefWjVKzNuMJJm2', '2026-05-08 11:47:12', 'user', 1),
(20, 'Ashley Hope', 'Marquez', 'Nerida', 'female', 'marquezashleyhope7@gmail.com', '$2y$10$eDThckAF5FHfQC6Dxk6/K.hhXGMWK.fYe/.ouIfgkt25AwdKaMziG', '2026-05-08 11:57:50', 'user', 1),
(21, 'Kylle', 'Abubo', 'Hufalar', 'male', 'kmhufalar@gmail.com', '$2y$10$lHlL4m6sgBdQGIOMCBuDnesYkw92hYpL3IfzYCNfcN4pDOZx/tlv.', '2026-05-08 13:58:05', 'user', 1),
(28, 'Jocelyn', 'Balcita', 'Tadina', 'female', 'jocelynbtadina@gmail.com', '$2y$10$hbHjHzZMINPbLhzHpm2LMuv/DIePcOWKaZSvGpCwFPediFrv2sHZS', '2026-05-09 05:43:46', 'user', 1),
(31, 'Jocelyn', 'Balcita', 'Tadina', 'female', 'treyce1017@yahoo.com', '$2y$10$yVfv8dvYjAgF05Fp9KnhKuLo9OrYBwUjOJrWXfKSbmLbMJsfn9iiO', '2026-05-09 05:48:49', 'user', 1),
(32, 'Maria', '', 'Concepcion', 'female', 'mariaconcepcion@gmail.com', '$2y$10$gXJW6iGZlzJuVal03xX0q.D5wDjaIk9ab636KjTlUYTlLp3cwwbxW', '2026-05-09 08:09:11', 'user', 1),
(33, 'Gail', 'B.', 'Descalso', 'female', 'gaildescalso@gmail.com', '$2y$10$YurKjEWR0HBMhroJBHTAg.Ay9d8HPzkl0G8OJYVhlGGQc.767tKKy', '2026-05-09 08:16:06', 'user', 1),
(34, 'Ashley', 'M.', 'Almonte', 'male', 'almonte22@gmail.com', '$2y$10$48narwmWviJKEjaWWX/5kO6agl1qdB.b/djGExuuNTuIBNdufdocW', '2026-05-09 11:11:20', 'user', 1),
(35, 'Ryan James', 'M.', 'Macalintal', 'male', 'rjmacalintal_11@gmail.com', '$2y$10$1s1S0TwKkdx32ZJol5kSReJ7tUEZWSZV0b3Ff2cFjUvKotlwdVPfe', '2026-05-09 12:01:39', 'user', 1),
(36, 'Wayne', 'Ethan', 'Gan', 'male', 'ethanwaynegan@gmail.com', '$2y$10$rkz0EszqpVA8mwZnUDwhDeyCnSe7ZaHZRyr2MCh5tTNVIFa6Imoaa', '2026-05-09 13:09:31', 'user', 1),
(37, 'Christian', 'R', 'Inovejas', 'male', 'christian.inovejas24@gmail.com', '$2y$10$dNjJLMhEwZMMbsZ9JFTIs.qtVRAU4UxReSFOcw91ERp57YLHY0i9W', '2026-05-09 15:41:49', 'user', 1),
(38, 'Zairoh', '', 'Manombaga', 'male', 'zaiwohhyy@gmail.com', '$2y$10$4t7I3x/wuSp5DmJj7M1sN.VyeE13gotBVyBhJMAfFpFo7vC/N..qK', '2026-05-09 15:43:18', 'user', 1),
(40, 'Ethan', 'Madala', 'Orig', 'male', 'madala08@gmail.com', '$2y$10$Uq3c93bgnbmdt4asus9XOem8i8YhrbcNI.tGWrLKZIREsG4fynYEy', '2026-05-10 04:49:36', 'user', 1),
(41, 'christian', 'lapenied', 'rivera', 'male', 'ianlipat2@gmail.com', '$2y$10$pEm8.Tsw.LsJ9D7G951fmuf3j1AUgaJA5waLiILahuwXHHi7Fz0ki', '2026-05-10 10:19:36', 'user', 1),
(42, 'amira', 'matutina', 'abuan', 'female', 'amiramatutina57@gmail.com', '$2y$10$s1XD.doQZKm9heXCwA4LXOmSfSY5yeJ1t.ES.JmFW0m9mK8uBK12O', '2026-05-10 10:22:05', 'user', 1),
(43, 'Estephang', 'Naparan', 'Payabyab', 'female', 'estephanypayabyab@gmail.com', '$2y$10$1/XgMPaocV2Sjh2pkEFy2OF1LP7RxXtqDXHBdil1Fme7nYpc1xkSK', '2026-05-10 10:30:01', 'user', 1),
(44, 'Fatima', 'Galatcha', 'Soliven', 'male', 'empresssoliven@gmail.com', '$2y$10$errVL0UC6esMDyCFYQ991e2PTftLQRX9Tt/yeIErG2Hr5Sm5xLHtO', '2026-05-10 10:32:42', 'user', 1),
(45, 'Kristine Mar', 'D.', 'Tolentino', 'female', 'krizzyeahm@gmail.com', '$2y$10$NvOag8RYs10RXdp8Z5nIV.jGjhdxdV/bt3MnX9V/R/6.vGtZWKmom', '2026-05-10 10:36:06', 'user', 1),
(46, 'Eduardo', 'Cariño', 'Valdez Jr', 'male', 'lemonade2730@gmail.com', '$2y$10$xWlUk9eJ.toA2YUE7WX/PeBwqFaweYt26.JR6XBm5fc5qWU/SRy5u', '2026-05-10 10:43:23', 'user', 1),
(47, 'Josa Camille', 'Cabading', 'Bungay', 'female', 'josa.camille.bungay@gmail.com', '$2y$10$lGv23drDvpKxNP0FcJdd7OCAAU9E1HJIk4U1djb4rOkkv4QVO0B2C', '2026-05-10 10:48:16', 'user', 1),
(48, 'Maricon', 'Monio', 'Andaya', 'female', 'mariconandaya1025@gmail.com', '$2y$10$WUsAS9B.n1z0FVkreR.Io.Ogv/Gc0N0OnA3fGmxmdZLepFqDsWR56', '2026-05-10 11:34:32', 'user', 1),
(49, 'Alyanna Sherril', 'Paras', 'Pacleb', 'female', 'isherrilpacleb@gmail.com', '$2y$10$d6SXCBK0quRNXDdFGE2.rOBQ0R11mq0AbWuI6/xu/KLkzlyimhfpu', '2026-05-10 12:20:14', 'user', 1),
(51, 'Jhonilla', '', 'Sibolboro', 'female', 'jhonilla.sibolboro12@gmail.com', '$2y$10$wHx9hgCO7YOz90OU95QAZuUaIhuQ0OPES5RpQ3Fl2tWZwllz4nLkG', '2026-05-10 13:16:27', 'user', 1),
(53, 'Alyanna', 'Sherril', 'Pacleb', 'female', 'alyannasherrilpacleb@gmail.com', '$2y$10$JLTWm7Yh4NxTSWId87/cZO2BzdWRPUtpKyywG/AHgl5T2/ZxmQKOC', '2026-05-10 19:26:30', 'user', 1),
(54, 'Carie', 'Litawen', 'Papat-iw', 'female', 'papatiwcarie@gmail.com', '$2y$10$B2H/4afdC6s1H9y7lY1ObeC03VMA3UQERu7B48MeQdBkQ1j.xL382', '2026-05-11 00:30:31', 'user', 1),
(55, 'Barry', 'Paul', 'Magsino', 'male', 'barrymagsino@gmail.com', '$2y$10$l22vfMMaQ2FynXAsuYRwVO2MxBzjpjwqCHOZ.Br59Aol/H/c1nEtG', '2026-05-11 06:27:42', 'user', 1),
(56, 'mark', 'a', 'encarnacion', 'male', 'markdion032304@gmail.com', '$2y$10$DpeS1B.SOysPPT3KCwsdEeFChuZwiBaT2enrEzQzD9oLD0GOBJA/.', '2026-05-11 08:12:13', 'user', 1),
(57, 'Giselle', 'Guerrero', 'Abando', 'female', 'gzelgee10@gmail.com', '$2y$10$xtYZMujbrPv6PhropyDwfOwF8LMuD0tNq9YZrMOCpTqzu/PkX/Tzq', '2026-05-11 10:43:34', 'user', 1),
(58, 'Rogilyn Mae', 'Erilla', 'Baluyot', 'female', 'rogilynmaebaluyot424@gmail.com', '$2y$10$4UFDFL5GPhPAf8YKOwV0yeR2hd4ftbrGPfy.0LVmnd8XxX7fzQBf.', '2026-05-11 10:49:08', 'user', 1),
(59, 'Kaychelle', 'Villanueva', 'Villanueva', 'female', 'kaychellev1@gmail.com', '$2y$10$AnnKiDVa83poTDzdFJnmGuibS8HH1DYXZelOhQ3bCDsjF1HlHIlBm', '2026-05-11 12:29:22', 'user', 1),
(60, 'Raven kyle', 'Bautista', 'Reasonda', 'male', 'ravenkylereasonda044@gmail.com', '$2y$10$z20z8H93Vj2N8IyYRKL7q./KdGGpJ.vrgfq0KiegNHFNy1OlcWwXu', '2026-05-12 02:38:49', 'user', 1),
(61, 'Levi', 'Wandien', 'Bayaua', 'male', 'bayaualevi77@gmail.com', '$2y$10$Llx3hPXs5A8nyPr.ZRSfwu.DNFtVNu2KshLy2MpMJ4yYk.KCZvKW.', '2026-05-12 07:28:51', 'user', 1),
(62, 'Richelle', 'Licos', 'Acosta', 'female', 'richellelicosacosta@gmail.com', '$2y$10$NdtbHJc.l/N5IzaUz/Arpe1Y9Et2yY4WWBMKzK4Kn/BMhc58lvUr.', '2026-05-12 07:47:29', 'user', 1),
(63, 'Carlo', 'Manaloto', 'Encarnacion', 'female', 'carloencarnacion224@gmail.com', '$2y$10$eX6KwibgUK8NDJlM92DCH.C.cgUpu1RMIiJtkePxd6h7JEKfPxN6y', '2026-05-12 10:39:23', 'user', 1),
(64, 'Adelaide', 'Romero', 'Mangaoang', 'male', 'laidee819@gmail.com', '$2y$10$lyy7RjEEpO9FEDXfzkAl4uwlUGnbt5zSs.P0wFeuDde5Y4Z2uDMfy', '2026-05-12 11:48:36', 'user', 1),
(65, 'Reysa Mae', 'Gormi', 'Iballo', 'female', 'reysamaeiballo@gmail.com', '$2y$10$jg6J7PisjMWP19YX7VrBqOjJVe1HpsUhIz8tRFsEdBGYZ1uwRaBxG', '2026-05-12 11:58:30', 'user', 1),
(66, 'Maribel', 'Garcia ', 'Rimas', 'female', 'rimasmaribel025@gmail.com', '$2y$10$G22uAK4V6S7MN4QRlUfUKuO25rpX1RWVh8pVUTp6h.p9S8B8MouSC', '2026-05-12 12:36:53', 'user', 1),
(67, 'Raia', 'F.', 'Foe', 'male', 'sheryn.gandia18@gmail.com', '$2y$10$bxsJRYil/5T5XQ/7vks2sOmI9Fk8..I291tHy7bnJJtYcEci1qlfG', '2026-05-12 14:06:06', 'user', 1),
(70, 'Tina', 'Aaa', 'Pascua', 'female', 'cpascua@gmail.com', '$2y$10$3qDhATP9iQOQNS6it9rcWepa1i//0QGiERpRo5XMrNolpuUcUQYKe', '2026-06-14 03:06:47', 'user', 1),
(71, 'lockley', '', 'reed', 'male', 'lockleyreedemp@gmail.com', '$2y$10$zLaCnZNy5wCe6tX4CudYXuVQnKa0SRnPmO5tvXB.WH3JTSDyFKxcm', '2026-06-20 13:56:02', 'user', 1),
(72, 'test', '', '123', 'male', '123@gmail.com', '$2y$10$C8QJl4glCvPVofLhTN4lrOlANNfsyUrN0jqTGxNiTWQoqZqvLC1bO', '2026-06-20 13:57:12', 'user', 0),
(73, 'Christine Ann', 'Bungcaras', 'Villar', 'female', 'christine2.villar@gmail.com', '$2y$10$Z2oD05XvA28N4NnsGZZjSO44K4YykRmUCpU8j3zKwrwpy8rCd/KQO', '2026-07-01 06:42:13', 'user', 1),
(74, 'Miggy', '', 'D', 'male', 'seaforrent@gmail.com', '$2y$10$JqLUyz6Q5JQVVSdZuORhOuG9.uYz6fdm0ql74JIpUi1itvc0cemPa', '2026-07-01 07:07:46', 'user', 1),
(76, 'alexa', '', 'villar3', 'female', 'alexaelyze3@gmail.com', '$2y$10$ZYJZyX/FDe7comc4jYsuueQKqh6/tEXcEYP/pe1QCSM3Q39xwTFRu', '2026-07-02 11:32:03', 'user', 1),
(77, 'Alexa', '', 'Villar4', 'female', 'alexaelyze1@gmail.com', '$2y$10$.IBYAgHe4hR6MigyKoTTP.jgPOrGUOfvNVDh3b523e6n1Wvz.d2g.', '2026-07-02 11:47:16', 'user', 1),
(78, 'che', 'villar', 'valencia', 'female', 'chevillar_31@yahoo.com', '$2y$10$YKKGqGsTeNroZOOTQ8QMoeSa8u5ZDjHMo1VOQqYBCrWrMvGU.cAGa', '2026-07-03 15:04:58', 'user', 1),
(79, 'Jet', '', 'Diaz', 'male', 'rayjustindiaz@yahoo.com.ph', '$2y$10$.4bGo7B9zzdVbFNeZpRE9uZciGVzbNzb4DWW38oqBE5hzA/Jv46Fu', '2026-07-03 22:00:51', 'user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `verification_tokens`
--

CREATE TABLE `verification_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expires_at` timestamp NOT NULL DEFAULT (current_timestamp() + interval 24 hour)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `verification_tokens`
--

INSERT INTO `verification_tokens` (`id`, `user_id`, `token`, `created_at`, `expires_at`) VALUES
(2, 72, 'b39bd57c55fa69fe13236ef7739441ddaa0ddffffec390cdee927a0e1531ec05', '2026-06-20 13:57:12', '2026-06-21 13:57:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_contents`
--
ALTER TABLE `module_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizlab`
--
ALTER TABLE `quizlab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quiz_scores`
--
ALTER TABLE `quiz_scores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`quiz_name`),
  ADD UNIQUE KEY `unique_quiz` (`user_id`,`quiz_name`);

--
-- Indexes for table `quiz_settings`
--
ALTER TABLE `quiz_settings`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `simulation_actions`
--
ALTER TABLE `simulation_actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sim_id` (`sim_id`);

--
-- Indexes for table `simulation_scores`
--
ALTER TABLE `simulation_scores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_sim` (`user_id`,`simulation_name`);

--
-- Indexes for table `simulation_settings`
--
ALTER TABLE `simulation_settings`
  ADD PRIMARY KEY (`sim_id`);

--
-- Indexes for table `simulation_steps`
--
ALTER TABLE `simulation_steps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sim_id` (`sim_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `verification_tokens`
--
ALTER TABLE `verification_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=599;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `module_contents`
--
ALTER TABLE `module_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;

--
-- AUTO_INCREMENT for table `quizlab`
--
ALTER TABLE `quizlab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `quiz_scores`
--
ALTER TABLE `quiz_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `simulation_actions`
--
ALTER TABLE `simulation_actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `simulation_scores`
--
ALTER TABLE `simulation_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `simulation_steps`
--
ALTER TABLE `simulation_steps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `verification_tokens`
--
ALTER TABLE `verification_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
