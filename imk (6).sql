-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jul 09, 2023 at 10:22 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imk`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `nama_admin`, `level`) VALUES
(1, 'admin', 'hello', 'Grace Lee', 'master_admin'),
(2, 'glhaeun', 'haha12', 'Grace Lee', 'normal_admin'),
(5, 'darren', '123', 'Darren', 'normal_admin'),
(6, 'haeunlee', 'hi', 'Grace', '');

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `id` int(11) NOT NULL,
  `foto_calon` varchar(100) NOT NULL,
  `nama_calon` varchar(100) NOT NULL,
  `nama_jabatan` varchar(100) DEFAULT NULL,
  `foto_wakil` varchar(100) DEFAULT NULL,
  `nama_wakil` varchar(100) NOT NULL,
  `voting_name` varchar(100) NOT NULL,
  `visi` varchar(1000) DEFAULT NULL,
  `misi` varchar(100) NOT NULL,
  `partai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`id`, `foto_calon`, `nama_calon`, `nama_jabatan`, `foto_wakil`, `nama_wakil`, `voting_name`, `visi`, `misi`, `partai`) VALUES
(37, 'canvas (7).png', 'Jokowi', 'H', 'canvas (8).png', 'haeunlee', 'PILPRES2023', 'Visivisionvisimission my vision is to mission', '1. Misi\r\n2. Misimisi\r\n3. missy hey missy', 'Kiwi');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `details` varchar(100) DEFAULT NULL,
  `start_tggl` date DEFAULT NULL,
  `end_tggl` date DEFAULT NULL,
  `voting_name` varchar(100) DEFAULT NULL,
  `jml_calon` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `nama_jabatan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `nama`, `details`, `start_tggl`, `end_tggl`, `voting_name`, `jml_calon`, `status`, `nama_jabatan`) VALUES
(16, 'PILPRES2023', 'SVT', '2023-12-31', '2023-12-31', NULL, '1', 'Active', 'SVT PRES'),
(17, 'P', 'h', '2023-07-06', '2023-07-06', NULL, '0', 'Inactive', 'h'),
(20, 'Capres', 'H', '2023-12-31', '2024-01-01', NULL, '0', 'Inactive', 'H');

-- --------------------------------------------------------

--
-- Table structure for table `csv_20230622220455`
--

CREATE TABLE `csv_20230622220455` (
  `﻿Bus` varchar(255) DEFAULT NULL,
  `Aman` varchar(255) DEFAULT NULL,
  `Service` varchar(255) DEFAULT NULL,
  `TidakHilang` varchar(255) DEFAULT NULL,
  `TepatWaktu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `csv_20230622220455`
--

INSERT INTO `csv_20230622220455` (`﻿Bus`, `Aman`, `Service`, `TidakHilang`, `TepatWaktu`) VALUES
('PP', '4', '4', '4', '3'),
('PP', '3', '4', '3', '4'),
('PP', '2', '3', '2', '3'),
('SS', '3', '4', '2', '4'),
('MJ', '4', '4', '4', '3'),
('PMTOH', '3', '2', '3', '2'),
('PP', '3', '3', '4', '2'),
('MJ', '4', '4', '4', '4'),
('ALS', '4', '4', '4', '4'),
('PP', '4', '4', '4', '4'),
('MJ', '2', '2', '3', '2'),
('MJ', '3', '3', '3', '3'),
('ALS', '3', '3', '3', '3'),
('MJ', '3', '3', '3', '3'),
('ALS', '4', '3', '4', '4'),
('ALS', '4', '4', '4', '4'),
('ALS', '3', '3', '3', '4'),
('ALS', '4', '4', '3', '4'),
('ALS', '4', '3', '3', '4'),
('ALS', '3', '4', '3', '3'),
('ALS', '3', '3', '3', '3'),
('ALS', '4', '4', '4', '4'),
('ALS', '4', '3', '3', '4'),
('ALS', '3', '3', '3', '2'),
('PP', '3', '4', '3', '4'),
('SS', '3', '4', '3', '2'),
('ALS', '4', '4', '4', '3'),
('ALS', '4', '3', '3', '4'),
('SS', '4', '3', '3', '2'),
('ALS', '3', '4', '4', '3'),
('ALS', '4', '3', '4', '4'),
('SS', '4', '4', '3', '3'),
('SS', '3', '4', '4', '4'),
('SS', '3', '3', '3', '3'),
('ALS', '4', '3', '3', '2'),
('ALS', '4', '3', '3', '4'),
('MJ', '4', '3', '3', '2'),
('MJ', '4', '3', '3', '4'),
('MJ', '4', '4', '4', '4'),
('MJ', '3', '3', '3', '3'),
('PP', '2', '1', '2', '1'),
('PP', '2', '3', '3', '2'),
('MJ', '3', '3', '3', '3'),
('SS', '3', '4', '4', '3'),
('SS', '4', '4', '3', '3'),
('SS', '4', '4', '4', '4'),
('PP', '3', '3', '3', '3'),
('PP', '4', '4', '4', '4'),
('PP', '3', '3', '3', '3'),
('MJ', '3', '2', '3', '2'),
('MJ', '3', '3', '3', '2'),
('MJ', '3', '3', '3', '3'),
('PMTOH', '3', '4', '4', '4'),
('PMTOH', '3', '3', '3', '3'),
('PMTOH', '3', '3', '3', '2'),
('PMTOH', '3', '2', '3', '3'),
('PMTOH', '3', '3', '3', '3'),
('PMTOH', '3', '4', '4', '3'),
('PP', '4', '4', '4', '4'),
('PP', '3', '2', '3', '3'),
('PP', '3', '2', '4', '3'),
('PP', '3', '2', '4', '2'),
('MJ', '3', '1', '3', '1'),
('MJ', '2', '1', '1', '1'),
('PMTOH', '2', '2', '2', '2'),
('PMTOH', '2', '3', '2', '2'),
('SS', '2', '2', '2', '2'),
('SS', '3', '3', '2', '2'),
('SS', '3', '3', '2', '3'),
('SS', '3', '3', '3', '3'),
('ALS', '4', '4', '4', '4'),
('SS', '1', '1', '1', '1'),
('SS', '2', '2', '2', '1'),
('PMTOH', '3', '2', '3', '4'),
('PMTOH', '3', '3', '3', '3'),
('PMTOH', '4', '3', '4', '4'),
('PMTOH', '4', '4', '4', '4'),
('MJ', '3', '3', '3', '3'),
('PMTOH', '3', '2', '3', '3'),
('PMTOH', '3', '3', '3', '3');

-- --------------------------------------------------------

--
-- Table structure for table `otp_expiry`
--

CREATE TABLE `otp_expiry` (
  `id` int(11) NOT NULL,
  `otp` varchar(10) NOT NULL,
  `is_expired` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `otp_expiry`
--

INSERT INTO `otp_expiry` (`id`, `otp`, `is_expired`, `create_at`, `email`) VALUES
(0, '382000', 0, '2023-06-08 18:57:22', '1'),
(0, '685235', 0, '2023-06-08 19:02:19', '1'),
(0, '648319', 0, '2023-06-08 19:02:20', '1'),
(0, '982673', 0, '2023-06-08 19:04:23', '1'),
(0, '860417', 0, '2023-06-08 19:06:34', '1'),
(0, '574938', 0, '2023-06-08 19:09:10', '1'),
(0, '606562', 0, '2023-06-08 19:12:30', '1'),
(0, '276655', 0, '2023-06-08 19:14:03', '1'),
(0, '656710', 0, '2023-06-08 19:16:54', '1'),
(0, '402243', 0, '2023-06-08 19:19:55', '1'),
(0, '934858', 0, '2023-06-08 19:19:55', '1'),
(0, '418652', 0, '2023-06-08 19:20:52', '1'),
(0, '454377', 0, '2023-06-08 19:29:39', '1'),
(0, '493698', 0, '2023-06-08 19:32:20', '1'),
(0, '679837', 1, '2023-06-08 19:35:22', '1'),
(0, '231355', 0, '2023-06-08 21:15:23', '1'),
(0, '463513', 0, '2023-06-08 21:37:49', '1'),
(0, '689592', 0, '2023-06-08 21:38:40', '1'),
(0, '614430', 0, '2023-06-08 21:49:02', '1'),
(0, '285063', 1, '2023-06-08 21:57:01', '1'),
(0, '460944', 0, '2023-06-08 22:01:24', '1'),
(0, '712679', 0, '2023-06-08 22:02:03', '1'),
(0, '940021', 0, '2023-06-08 22:02:37', '1'),
(0, '549286', 0, '2023-06-08 22:03:41', '1'),
(0, '671598', 0, '2023-06-08 22:06:17', '1'),
(0, '487457', 0, '2023-06-08 22:07:06', '1'),
(0, '810991', 0, '2023-06-08 22:08:56', '1'),
(0, '513208', 0, '2023-06-08 22:11:58', '1'),
(0, '974564', 0, '2023-06-08 22:14:01', '1'),
(0, '578496', 0, '2023-06-08 22:16:23', '1'),
(0, '159064', 0, '2023-06-08 22:17:54', '1'),
(0, '938601', 0, '2023-06-08 22:19:13', '1'),
(0, '722079', 1, '2023-06-08 22:24:54', '1'),
(0, '507009', 0, '2023-06-08 22:25:27', '1'),
(0, '620715', 0, '2023-06-08 22:26:12', '1'),
(0, '915953', 0, '2023-06-08 22:26:36', '1'),
(0, '556031', 0, '2023-06-08 22:27:08', '1'),
(0, '492689', 0, '2023-06-08 22:28:48', '1'),
(0, '430695', 0, '2023-06-08 22:30:01', '1'),
(0, '613349', 1, '2023-06-08 22:31:32', '1'),
(0, '725881', 1, '2023-06-08 22:32:35', '1'),
(0, '663317', 0, '2023-06-08 22:34:21', '1'),
(0, '531320', 0, '2023-06-08 22:34:55', '1'),
(0, '120429', 1, '2023-06-08 22:35:36', '1'),
(0, '952300', 1, '2023-06-08 22:40:15', '1'),
(0, '306473', 0, '2023-06-08 22:41:55', '1'),
(0, '609158', 1, '2023-06-08 22:43:04', '1'),
(0, '404795', 1, '2023-06-08 22:44:05', '1'),
(0, '646576', 0, '2023-06-08 22:45:44', '1'),
(0, '236355', 1, '2023-06-08 22:47:41', '1'),
(0, '150876', 0, '2023-06-08 22:48:50', '1'),
(0, '574115', 0, '2023-06-08 22:49:21', '1'),
(0, '158485', 0, '2023-06-08 22:52:58', '1'),
(0, '574521', 0, '2023-06-08 22:54:01', '1'),
(0, '503189', 0, '2023-06-08 22:55:09', '1'),
(0, '224062', 0, '2023-06-08 22:57:44', '1'),
(0, '263497', 0, '2023-06-08 23:00:24', '1'),
(0, '687116', 0, '2023-06-08 23:01:10', '1'),
(0, '486569', 0, '2023-06-08 23:01:35', '1'),
(0, '817664', 0, '2023-06-08 23:03:44', '1'),
(0, '375243', 0, '2023-06-08 23:04:04', '1'),
(0, '146957', 0, '2023-06-08 23:05:31', '1'),
(0, '709670', 0, '2023-06-08 23:06:34', '1'),
(0, '878095', 1, '2023-06-08 23:07:35', '1'),
(0, '565308', 1, '2023-06-08 23:09:55', '1'),
(0, '985921', 1, '2023-06-08 23:13:14', '1'),
(0, '791626', 1, '2023-06-08 23:14:27', '1'),
(0, '487278', 0, '2023-06-08 23:26:22', '1'),
(0, '348232', 0, '2023-06-08 23:29:23', '1'),
(0, '109984', 0, '2023-06-08 23:30:38', '1'),
(0, '683272', 0, '2023-06-08 23:32:18', '1'),
(0, '882705', 0, '2023-06-09 12:45:14', '1'),
(0, '154880', 0, '2023-06-09 12:48:45', '1'),
(0, '277631', 0, '2023-06-09 12:50:29', '1'),
(0, '527992', 0, '2023-06-09 12:51:06', '1'),
(0, '957338', 0, '2023-06-09 12:51:48', '1'),
(0, '253624', 0, '2023-06-09 13:14:26', '1'),
(0, '993499', 0, '2023-06-09 14:55:02', '1'),
(0, '891965', 1, '2023-06-09 14:57:54', '1'),
(0, '197615', 0, '2023-06-09 14:58:59', '1'),
(0, '477721', 1, '2023-06-09 14:59:38', '1'),
(0, '797680', 0, '2023-06-09 15:01:34', '1'),
(0, '568124', 0, '2023-06-09 15:03:11', '1'),
(0, '883663', 0, '2023-06-09 15:30:26', '1'),
(0, '468303', 0, '2023-06-09 15:38:58', '1'),
(0, '341773', 0, '2023-06-11 16:35:44', '1'),
(0, '797101', 0, '2023-06-11 16:37:11', '1'),
(0, '634421', 0, '2023-06-11 16:37:43', '1'),
(0, '726761', 0, '2023-06-11 16:46:12', '1'),
(0, '151626', 0, '2023-06-11 16:46:46', '1'),
(0, '132689', 0, '2023-06-11 16:47:09', '1'),
(0, '265073', 0, '2023-06-11 16:48:40', '1'),
(0, '353853', 1, '2023-06-11 16:49:38', '1'),
(0, '123123', 1, '2023-06-11 16:58:31', '1'),
(0, '123123', 1, '2023-06-11 16:58:31', '1'),
(0, '488817', 0, '2023-06-11 17:00:36', '1'),
(0, '873906', 0, '2023-06-11 17:08:07', '1'),
(0, '848270', 0, '2023-06-11 17:08:31', '1'),
(0, '367428', 0, '2023-06-11 17:09:17', '1'),
(0, '482324', 0, '2023-06-11 17:09:46', '1'),
(0, '841818', 0, '2023-06-11 17:13:01', '1'),
(0, '738672', 1, '2023-06-11 17:14:30', '1'),
(0, '176680', 1, '2023-06-11 17:15:44', '1'),
(0, '608607', 0, '2023-06-11 17:25:10', '1'),
(0, '314588', 1, '2023-06-11 17:46:26', '1'),
(0, '574295', 1, '2023-06-11 17:52:25', '1'),
(0, '437926', 0, '2023-06-11 17:53:26', '1'),
(0, '804734', 1, '2023-06-11 17:55:29', '1'),
(0, '627677', 0, '2023-06-11 17:57:09', '1'),
(0, '783375', 0, '2023-06-11 17:57:56', '1'),
(0, '848878', 0, '2023-06-11 18:00:30', '1'),
(0, '980380', 0, '2023-06-11 18:00:51', '1'),
(0, '134728', 1, '2023-06-11 18:02:10', '1'),
(0, '619641', 0, '2023-06-11 18:02:49', '1'),
(0, '435705', 0, '2023-06-11 18:04:12', '1'),
(0, '605395', 1, '2023-06-11 18:04:28', '1'),
(0, '393998', 0, '2023-06-11 18:05:05', '1'),
(0, '733503', 0, '2023-06-11 18:08:22', '1'),
(0, '738170', 0, '2023-06-11 18:10:49', '1'),
(0, '980338', 0, '2023-06-11 18:11:00', '1'),
(0, '369799', 0, '2023-06-11 18:11:53', '1'),
(0, '963395', 0, '2023-06-11 18:12:04', '1'),
(0, '137073', 0, '2023-06-11 18:12:41', '1'),
(0, '530139', 0, '2023-06-11 18:13:40', '1'),
(0, '256275', 0, '2023-06-11 18:14:38', '1'),
(0, '130358', 0, '2023-06-11 18:15:12', '1'),
(0, '511784', 1, '2023-06-11 18:17:37', 'haeunictsis@gmail.com'),
(0, '148199', 1, '2023-06-11 18:19:25', 'haeunictsis@gmail.com'),
(0, '236951', 1, '2023-06-11 18:21:23', 'haeunictsis@gmail.com'),
(0, '541293', 0, '2023-06-11 19:30:19', 'haeunictsis@gmail.com'),
(0, '791634', 0, '2023-06-11 19:30:49', 'haeunictsis@gmail.com'),
(0, '106716', 1, '2023-06-11 19:32:12', 'haeunictsis@gmail.com'),
(0, '146981', 1, '2023-06-11 19:35:15', 'haeunictsis@gmail.com'),
(0, '194715', 0, '2023-06-11 19:41:04', 'haeunictsis@gmail.com'),
(0, '147820', 0, '2023-06-11 19:43:08', 'haeunictsis@gmail.com'),
(0, '728101', 0, '2023-06-11 19:45:16', 'haeunictsis@gmail.com'),
(0, '663040', 0, '2023-06-11 19:46:51', 'haeunictsis@gmail.com'),
(0, '111611', 1, '2023-06-11 19:48:09', 'haeunictsis@gmail.com'),
(0, '313911', 0, '2023-06-11 19:53:38', 'haeunictsis@gmail.com'),
(0, '659335', 1, '2023-06-11 19:55:08', 'haeunictsis@gmail.com'),
(0, '559758', 1, '2023-06-12 15:57:16', 'haeunn@gmail.com'),
(0, '701102', 1, '2023-06-12 18:02:00', 'hahaha@gmail.com'),
(0, '414325', 1, '2023-06-12 18:03:43', 'hehehe@gmail.com'),
(0, '482091', 1, '2023-06-12 18:06:09', 'hihihi@gmail.com'),
(0, '481902', 1, '2023-06-12 18:08:23', 'hahehi@gmail.com'),
(0, '169343', 1, '2023-06-12 18:12:06', 'haho@gmail.com'),
(0, '464074', 0, '2023-06-12 18:13:42', 'halo@gmail.com'),
(0, '385545', 0, '2023-06-12 18:24:04', 'Jane@gmail.com'),
(0, '504017', 1, '2023-06-12 18:25:32', 'Jane@gmail.com'),
(0, '651290', 1, '2023-06-12 18:26:42', 'haeuntes100@gmail.com'),
(0, '408601', 0, '2023-06-12 18:27:35', 'haeuntesfinal@gmail.com'),
(0, '800278', 0, '2023-06-12 18:28:59', 'haeuntesfinal@gmail.com'),
(0, '900869', 0, '2023-06-12 18:30:24', 'haeuntesfinal@gmail.com'),
(0, '868994', 0, '2023-06-12 18:31:08', 'haeuntesfinal@gmail.com'),
(0, '309181', 0, '2023-06-27 14:27:37', 'haeunictsis@gmail.com'),
(0, '874149', 0, '2023-06-27 14:28:40', 'haeunictsis@gmail.com'),
(0, '606914', 0, '2023-06-27 14:29:38', 'haeunictsis@gmail.com'),
(0, '535631', 0, '2023-06-27 14:29:52', 'haeunictsis@gmail.com'),
(0, '667798', 0, '2023-06-27 16:37:48', 'haeunictsis@gmail.com'),
(0, '139805', 1, '2023-06-27 16:38:48', 'haeunictsis@gmail.com'),
(0, '929723', 0, '2023-06-27 16:40:43', 'haeunictsis@gmail.com'),
(0, '471066', 0, '2023-06-27 16:42:25', 'haeunictsis@gmail.com'),
(0, '845495', 1, '2023-06-27 16:43:29', 'haeunictsis@gmail.com'),
(0, '504683', 1, '2023-06-27 16:48:01', 'haeunictsis@gmail.com'),
(0, '139313', 0, '2023-06-27 16:48:43', 'haeunictsis@gmail.com'),
(0, '532191', 1, '2023-06-27 16:50:44', 'haeunictsis@gmail.com'),
(0, '705776', 0, '2023-06-27 16:51:25', 'haeunictsis@gmail.com'),
(0, '756429', 1, '2023-06-27 16:51:33', 'haeunictsis@gmail.com'),
(0, '525391', 0, '2023-06-27 16:51:45', 'haeunictsis@gmail.com'),
(0, '745881', 1, '2023-06-27 16:52:11', 'haeunictsis@gmail.com'),
(0, '177690', 1, '2023-06-27 16:55:00', 'haeunictsis@gmail.com'),
(0, '898150', 1, '2023-06-27 16:55:41', 'haeunictsis@gmail.com'),
(0, '792801', 0, '2023-06-27 17:20:23', 'haeunlee12@gmail.com'),
(0, '992275', 0, '2023-06-27 17:21:23', 'haeunictsis@gmail.com'),
(0, '466827', 0, '2023-06-27 17:22:36', 'haeunictsis@gmail.com'),
(0, '501180', 0, '2023-06-27 17:25:27', 'haeunictsis@gmail.com'),
(0, '210988', 0, '2023-06-27 17:25:49', 'haeunictsis@gmail.com'),
(0, '531134', 0, '2023-06-27 17:27:05', 'haeunictsis@gmail.com'),
(0, '936399', 1, '2023-06-27 17:28:45', 'haeunictsis@gmail.com'),
(0, '517970', 0, '2023-06-27 17:32:05', 'haeunictsis@gmail.com'),
(0, '473707', 0, '2023-06-27 17:33:18', 'haeunictsis@gmail.com'),
(0, '113216', 0, '2023-06-27 17:36:15', 'haeunictsis@gmail.com'),
(0, '154721', 0, '2023-06-27 17:37:19', 'haeunictsis@gmail.com'),
(0, '459697', 0, '2023-06-28 11:59:12', 'haeunictsis@gmail.com'),
(0, '202623', 0, '2023-06-28 12:03:31', 'haeunictsis@gmail.com'),
(0, '903851', 0, '2023-06-28 12:04:06', 'haeunictsis@gmail.com'),
(0, '736189', 0, '2023-06-28 12:04:45', 'haeunictsis@gmail.com'),
(0, '401061', 0, '2023-06-28 12:08:02', 'haeunictsis@gmail.com'),
(0, '697830', 0, '2023-06-28 12:14:55', 'haeunictsis@gmail.com'),
(0, '381456', 0, '2023-06-28 12:18:35', 'haeunictsis@gmail.com'),
(0, '541711', 0, '2023-06-28 12:20:01', 'haeunictsis@gmail.com'),
(0, '838685', 0, '2023-06-28 12:21:15', 'haeunictsis@gmail.com'),
(0, '711909', 0, '2023-06-28 12:29:30', 'gaonkimchi@gmail.com'),
(0, '788260', 0, '2023-06-28 12:29:35', 'gaonkimchi@gmail.com'),
(0, '147900', 0, '2023-06-28 12:29:39', 'gaonkimchi@gmail.com'),
(0, '580559', 0, '2023-06-28 12:29:43', 'gaonkimchi@gmail.com'),
(0, '303217', 0, '2023-06-28 12:29:44', 'gaonkimchi@gmail.com'),
(0, '663115', 0, '2023-06-28 12:29:49', 'gaonkimchi@gmail.com'),
(0, '983233', 0, '2023-06-28 12:29:54', 'gaonkimchi@gmail.com'),
(0, '488687', 1, '2023-06-28 12:29:59', 'gaonkimchi@gmail.com'),
(0, '597742', 0, '2023-06-28 20:10:28', 'haeunictsis@gmail.com'),
(0, '911156', 0, '2023-06-28 20:12:17', 'gaonkimchi@gmail.com'),
(0, '500556', 0, '2023-06-28 20:47:56', 'munchmunchgrace@gmail.com'),
(0, '576625', 0, '2023-06-28 20:55:23', 'gaonkimchi@gmail.com'),
(0, '140557', 0, '2023-06-28 21:20:12', 'haeunictsis@gmail.com'),
(0, '111886', 0, '2023-06-29 20:37:52', 'haeunictsis@gmail.com'),
(0, '984213', 0, '2023-06-29 20:37:55', 'haeunictsis@gmail.com'),
(0, '642012', 0, '2023-07-02 22:20:20', 'haeunictsis@gmail.com'),
(0, '356300', 0, '2023-07-02 22:21:51', 'haeunictsis@gmail.com'),
(0, '946157', 0, '2023-07-02 22:23:32', 'haeunictsis@gmail.com'),
(0, '303424', 0, '2023-07-02 22:23:55', 'haeunictsis@gmail.com'),
(0, '533226', 0, '2023-07-02 22:25:30', 'haeunictsis@gmail.com'),
(0, '435819', 0, '2023-07-02 22:27:40', 'haeunictsis@gmail.com'),
(0, '321733', 0, '2023-07-03 12:44:06', 'haeunictsis@gmail.com'),
(0, '211163', 0, '2023-07-04 13:52:12', 'haeunictsis@gmail.com'),
(0, '798344', 0, '2023-07-04 13:55:27', 'haeunictsis@gmail.com'),
(0, '126297', 0, '2023-07-06 12:48:08', 'haeunictsis@gmail.com'),
(0, '736938', 0, '2023-07-07 01:19:02', 'haeunictsis@gmail.com'),
(0, '785930', 1, '2023-07-08 22:35:41', 'haeunictsis@gmail.com'),
(0, '524204', 1, '2023-07-08 22:42:21', 'ejscassava@gmail.com'),
(0, '856789', 0, '2023-07-08 22:48:08', 'ejscassava@gmail.com'),
(0, '183854', 0, '2023-07-08 22:50:02', 'ejscassava@gmail.com'),
(0, '310609', 0, '2023-07-08 22:54:54', 'ejscassava@gmail.com'),
(0, '201872', 1, '2023-07-08 22:57:05', 'haeunictsis@gmail.com'),
(0, '616395', 0, '2023-07-08 23:02:58', 'haho@gmail.com'),
(0, '395467', 0, '2023-07-08 23:07:38', 'haho@gmail.com'),
(0, '404814', 0, '2023-07-08 23:11:59', 'haho@gmail.com'),
(0, '780647', 0, '2023-07-08 23:17:07', 'haho@gmail.com'),
(0, '184175', 1, '2023-07-08 23:33:33', 'haeunictsis@gmail.com'),
(0, '473521', 1, '2023-07-09 07:47:47', 'haeunictsis@gmail.com'),
(0, '628281', 0, '2023-07-09 07:54:38', 'haeunictsis@gmail.com'),
(0, '482159', 0, '2023-07-09 09:44:14', 'haeunictsis@gmail.com'),
(0, '662768', 0, '2023-07-09 09:45:32', 'haeunictsis@gmail.com'),
(0, '388040', 1, '2023-07-09 09:46:52', 'haeunictsis@gmail.com'),
(0, '541157', 0, '2023-07-09 09:48:27', 'haeunictsis@gmail.com'),
(0, '995765', 0, '2023-07-09 09:48:36', 'haeunictsis@gmail.com'),
(0, '718035', 0, '2023-07-09 09:51:03', 'haeunictsis@gmail.com'),
(0, '669519', 0, '2023-07-09 09:52:20', 'haeunictsis@gmail.com'),
(0, '235081', 0, '2023-07-09 09:53:47', 'haeunictsis@gmail.com'),
(0, '171269', 1, '2023-07-09 09:55:45', 'ejscassava@gmail.com'),
(0, '766835', 0, '2023-07-09 09:58:24', 'gaonkimchi@gmail.com'),
(0, '409968', 0, '2023-07-09 09:59:02', 'haeunictsis@gmail.com'),
(0, '998712', 1, '2023-07-09 09:59:07', 'haeunictsis@gmail.com'),
(0, '399717', 0, '2023-07-09 10:06:09', 'haeunictsis@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `prevote_array`
--

CREATE TABLE `prevote_array` (
  `﻿Bus` varchar(255) DEFAULT NULL,
  `Aman` varchar(255) DEFAULT NULL,
  `Service` varchar(255) DEFAULT NULL,
  `TidakHilang` varchar(255) DEFAULT NULL,
  `TepatWaktu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `prevote_array`
--

INSERT INTO `prevote_array` (`﻿Bus`, `Aman`, `Service`, `TidakHilang`, `TepatWaktu`) VALUES
('PP', '4', '4', '4', '3'),
('PP', '3', '4', '3', '4'),
('PP', '2', '3', '2', '3'),
('SS', '3', '4', '2', '4'),
('MJ', '4', '4', '4', '3'),
('PMTOH', '3', '2', '3', '2'),
('PP', '3', '3', '4', '2'),
('MJ', '4', '4', '4', '4'),
('ALS', '4', '4', '4', '4'),
('PP', '4', '4', '4', '4'),
('MJ', '2', '2', '3', '2'),
('MJ', '3', '3', '3', '3'),
('ALS', '3', '3', '3', '3'),
('MJ', '3', '3', '3', '3'),
('ALS', '4', '3', '4', '4'),
('ALS', '4', '4', '4', '4'),
('ALS', '3', '3', '3', '4'),
('ALS', '4', '4', '3', '4'),
('ALS', '4', '3', '3', '4'),
('ALS', '3', '4', '3', '3'),
('ALS', '3', '3', '3', '3'),
('ALS', '4', '4', '4', '4'),
('ALS', '4', '3', '3', '4'),
('ALS', '3', '3', '3', '2'),
('PP', '3', '4', '3', '4'),
('SS', '3', '4', '3', '2'),
('ALS', '4', '4', '4', '3'),
('ALS', '4', '3', '3', '4'),
('SS', '4', '3', '3', '2'),
('ALS', '3', '4', '4', '3'),
('ALS', '4', '3', '4', '4'),
('SS', '4', '4', '3', '3'),
('SS', '3', '4', '4', '4'),
('SS', '3', '3', '3', '3'),
('ALS', '4', '3', '3', '2'),
('ALS', '4', '3', '3', '4'),
('MJ', '4', '3', '3', '2'),
('MJ', '4', '3', '3', '4'),
('MJ', '4', '4', '4', '4'),
('MJ', '3', '3', '3', '3'),
('PP', '2', '1', '2', '1'),
('PP', '2', '3', '3', '2'),
('MJ', '3', '3', '3', '3'),
('SS', '3', '4', '4', '3'),
('SS', '4', '4', '3', '3'),
('SS', '4', '4', '4', '4'),
('PP', '3', '3', '3', '3'),
('PP', '4', '4', '4', '4'),
('PP', '3', '3', '3', '3'),
('MJ', '3', '2', '3', '2'),
('MJ', '3', '3', '3', '2'),
('MJ', '3', '3', '3', '3'),
('PMTOH', '3', '4', '4', '4'),
('PMTOH', '3', '3', '3', '3'),
('PMTOH', '3', '3', '3', '2'),
('PMTOH', '3', '2', '3', '3'),
('PMTOH', '3', '3', '3', '3'),
('PMTOH', '3', '4', '4', '3'),
('PP', '4', '4', '4', '4'),
('PP', '3', '2', '3', '3'),
('PP', '3', '2', '4', '3'),
('PP', '3', '2', '4', '2'),
('MJ', '3', '1', '3', '1'),
('MJ', '2', '1', '1', '1'),
('PMTOH', '2', '2', '2', '2'),
('PMTOH', '2', '3', '2', '2'),
('SS', '2', '2', '2', '2'),
('SS', '3', '3', '2', '2'),
('SS', '3', '3', '2', '3'),
('SS', '3', '3', '3', '3'),
('ALS', '4', '4', '4', '4'),
('SS', '1', '1', '1', '1'),
('SS', '2', '2', '2', '1'),
('PMTOH', '3', '2', '3', '4'),
('PMTOH', '3', '3', '3', '3'),
('PMTOH', '4', '3', '4', '4'),
('PMTOH', '4', '4', '4', '4'),
('MJ', '3', '3', '3', '3'),
('PMTOH', '3', '2', '3', '3'),
('PMTOH', '3', '3', '3', '3');

-- --------------------------------------------------------

--
-- Table structure for table `prevote_bus`
--

CREATE TABLE `prevote_bus` (
  `﻿Bus` varchar(255) DEFAULT NULL,
  `Aman` varchar(255) DEFAULT NULL,
  `Service` varchar(255) DEFAULT NULL,
  `TidakHilang` varchar(255) DEFAULT NULL,
  `TepatWaktu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `prevote_bus`
--

INSERT INTO `prevote_bus` (`﻿Bus`, `Aman`, `Service`, `TidakHilang`, `TepatWaktu`) VALUES
('PP', '4', '4', '4', '3'),
('PP', '3', '4', '3', '4'),
('PP', '2', '3', '2', '3'),
('Sempati Star', '3', '4', '2', '4'),
('MJ', '4', '4', '4', '3'),
('PMTOH', '3', '2', '3', '2'),
('PP', '3', '3', '4', '2'),
('MJ', '4', '4', '4', '4'),
('ALS', '4', '4', '4', '4'),
('PP', '4', '4', '4', '4'),
('MJ', '2', '2', '3', '2'),
('MJ', '3', '3', '3', '3'),
('ALS', '3', '3', '3', '3'),
('MJ', '3', '3', '3', '3'),
('ALS', '4', '3', '4', '4'),
('ALS', '4', '4', '4', '4'),
('ALS', '3', '3', '3', '4'),
('ALS', '4', '4', '3', '4'),
('ALS', '4', '3', '3', '4'),
('ALS', '3', '4', '3', '3'),
('ALS', '3', '3', '3', '3'),
('ALS', '4', '4', '4', '4'),
('ALS', '4', '3', '3', '4'),
('ALS', '3', '3', '3', '2'),
('PP', '3', '4', '3', '4'),
('Sempati Star', '3', '4', '3', '2'),
('ALS', '4', '4', '4', '3'),
('ALS', '4', '3', '3', '4'),
('Sempati Star', '4', '3', '3', '2'),
('ALS', '3', '4', '4', '3'),
('ALS', '4', '3', '4', '4'),
('Sempati Star', '4', '4', '3', '3'),
('Sempati Star', '3', '4', '4', '4'),
('Sempati Star', '3', '3', '3', '3'),
('ALS', '4', '3', '3', '2'),
('ALS', '4', '3', '3', '4'),
('MJ', '4', '3', '3', '2'),
('MJ', '4', '3', '3', '4'),
('MJ', '4', '4', '4', '4'),
('MJ', '3', '3', '3', '3'),
('PP', '2', '1', '2', '1'),
('PP', '2', '3', '3', '2'),
('MJ', '3', '3', '3', '3'),
('Sempati Star', '3', '4', '4', '3'),
('Sempati Star', '4', '4', '3', '3'),
('Sempati Star', '4', '4', '4', '4'),
('PP', '3', '3', '3', '3'),
('PP', '4', '4', '4', '4'),
('PP', '3', '3', '3', '3'),
('MJ', '3', '2', '3', '2'),
('MJ', '3', '3', '3', '2'),
('MJ', '3', '3', '3', '3'),
('PMTOH', '3', '4', '4', '4'),
('PMTOH', '3', '3', '3', '3'),
('PMTOH', '3', '3', '3', '2'),
('PMTOH', '3', '2', '3', '3'),
('PMTOH', '3', '3', '3', '3'),
('PMTOH', '3', '4', '4', '3'),
('PP', '4', '4', '4', '4'),
('PP', '3', '2', '3', '3'),
('PP', '3', '2', '4', '3'),
('PP', '3', '2', '4', '2'),
('MJ', '3', '1', '3', '1'),
('MJ', '2', '1', '1', '1'),
('PMTOH', '2', '2', '2', '2'),
('PMTOH', '2', '3', '2', '2'),
('Sempati Star', '2', '2', '2', '2'),
('Sempati Star', '3', '3', '2', '2'),
('Sempati Star', '3', '3', '2', '3'),
('Sempati Star', '3', '3', '3', '3'),
('ALS', '4', '4', '4', '4'),
('Sempati Star', '1', '1', '1', '1'),
('Sempati Star', '2', '2', '2', '1'),
('PMTOH', '3', '2', '3', '4'),
('PMTOH', '3', '3', '3', '3'),
('PMTOH', '4', '3', '4', '4'),
('PMTOH', '4', '4', '4', '4'),
('MJ', '3', '3', '3', '3'),
('PMTOH', '3', '2', '3', '3'),
('PMTOH', '3', '3', '3', '3');

-- --------------------------------------------------------

--
-- Table structure for table `prevote_presurvei`
--

CREATE TABLE `prevote_presurvei` (
  `id` varchar(255) DEFAULT NULL,
  `pendidikan` varchar(255) DEFAULT NULL,
  `karir` varchar(255) DEFAULT NULL,
  `past` varchar(255) DEFAULT NULL,
  `usia` varchar(255) DEFAULT NULL,
  `visimisi` varchar(255) DEFAULT NULL,
  `parpol` varchar(255) DEFAULT NULL,
  `likely` varchar(255) DEFAULT NULL,
  `willvote` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `prevote_presurvei`
--

INSERT INTO `prevote_presurvei` (`id`, `pendidikan`, `karir`, `past`, `usia`, `visimisi`, `parpol`, `likely`, `willvote`) VALUES
('1', 'A', 'A', 'B', 'A', 'C', 'A', 'A', 'Y'),
('2', 'B', 'C', 'A', 'C', 'A', 'C', 'A', 'Y'),
('3', 'A', 'C', 'B', 'B', 'A', 'C', 'C', 'N'),
('4', 'B', 'B', 'C', 'C', 'C', 'C', 'C', 'Y'),
('5', 'A', 'C', 'A', 'B', 'A', 'A', 'A', 'Y'),
('6', 'A', 'C', 'B', 'B', 'C', 'B', 'B', 'Y'),
('7', 'A', 'C', 'B', 'B', 'A', 'C', 'B', 'Y'),
('8', 'A', 'C', 'B', 'C', 'A', 'C', 'C', 'N'),
('9', 'A', 'B', 'B', 'C', 'A', 'C', 'B', 'Y'),
('10', 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'N'),
('11', 'C', 'C', 'C', 'B', 'B', 'A', 'A', 'Y'),
('12', 'A', 'A', 'C', 'A', 'B', 'C', 'C', 'N'),
('13', 'C', 'A', 'A', 'A', 'B', 'C', 'C', 'Y'),
('14', 'A', 'C', 'C', 'B', 'C', 'C', 'A', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `prevote_test`
--

CREATE TABLE `prevote_test` (
  `id` varchar(255) DEFAULT NULL,
  `pendidikan` varchar(255) DEFAULT NULL,
  `karir` varchar(255) DEFAULT NULL,
  `past` varchar(255) DEFAULT NULL,
  `usia` varchar(255) DEFAULT NULL,
  `visimisi` varchar(255) DEFAULT NULL,
  `parpol` varchar(255) DEFAULT NULL,
  `likely` varchar(255) DEFAULT NULL,
  `willvote` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `prevote_test`
--

INSERT INTO `prevote_test` (`id`, `pendidikan`, `karir`, `past`, `usia`, `visimisi`, `parpol`, `likely`, `willvote`) VALUES
('1', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Jason Tjoa', 'N'),
('2', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Y'),
('3', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'N'),
('4', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Irwanto Wijaya', 'Y'),
('5', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Jason Tjoa', 'N'),
('6', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Y'),
('7', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Y'),
('8', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Jason Tjoa', 'N'),
('9', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Irwanto Wijaya', 'Ziven Louis', 'N'),
('10', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Ziven Louis', 'Irwanto Wijaya', 'Y'),
('11', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Ziven Louis', 'N'),
('12', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Y'),
('13', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Y'),
('14', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Y'),
('15', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'N'),
('16', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Ziven Louis', 'N'),
('17', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'N'),
('18', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'N'),
('19', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'N'),
('20', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Jason Tjoa', 'Y'),
('21', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Y'),
('22', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Ziven Louis', 'Jason Tjoa', 'N'),
('23', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Y'),
('24', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Y'),
('25', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Ziven Louis', 'Jason Tjoa', 'Irwanto Wijaya', 'Y'),
('26', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Y'),
('27', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Ziven Louis', 'Y'),
('28', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Ziven Louis', 'Jason Tjoa', 'N'),
('29', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'N'),
('30', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Y'),
('31', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Y'),
('32', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Irwanto Wijaya', 'Y'),
('33', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Ziven Louis', 'N'),
('34', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Y'),
('35', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'N'),
('36', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Y'),
('37', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'N'),
('38', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Y'),
('39', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Y'),
('40', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Y'),
('41', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Ziven Louis', 'N'),
('42', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'N'),
('43', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Irwanto Wijaya', 'Jason Tjoa', 'Y'),
('44', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Ziven Louis', 'Y'),
('45', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Ziven Louis', 'Ziven Louis', 'Y'),
('46', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Jason Tjoa', 'N'),
('47', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Y'),
('48', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'N'),
('49', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Y'),
('50', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'N'),
('51', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Y'),
('52', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Y'),
('53', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Y'),
('54', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Y'),
('55', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Ziven Louis', 'Jason Tjoa', 'N'),
('56', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Y'),
('57', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Irwanto Wijaya', 'Y'),
('58', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Ziven Louis', 'Y'),
('59', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Jason Tjoa', 'Ziven Louis', 'N'),
('60', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Y'),
('61', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Y'),
('62', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Jason Tjoa', 'Y'),
('63', 'Jason Tjoa', 'Ziven Louis', 'Jason Tjoa', 'Ziven Louis', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'N'),
('64', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Ziven Louis', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Ziven Louis', 'N'),
('65', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'N'),
('66', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'N'),
('67', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'N'),
('68', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Ziven Louis', 'N'),
('69', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Ziven Louis', 'Jason Tjoa', 'Irwanto Wijaya', 'Y'),
('70', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Ziven Louis', 'Ziven Louis', 'Y'),
('71', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'N'),
('72', 'Ziven Louis', 'Ziven Louis', 'Ziven Louis', 'Ziven Louis', 'Irwanto Wijaya', 'Ziven Louis', 'Ziven Louis', 'N'),
('73', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'N'),
('74', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Ziven Louis', 'Ziven Louis', 'Jason Tjoa', 'Y'),
('75', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Y'),
('76', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Irwanto Wijaya', 'Irwanto Wijaya', 'N'),
('77', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'N'),
('78', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Y'),
('79', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Irwanto Wijaya', 'Ziven Louis', 'Y'),
('80', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Ziven Louis', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `prevote_test2`
--

CREATE TABLE `prevote_test2` (
  `id` varchar(255) DEFAULT NULL,
  `pendidikan` varchar(255) DEFAULT NULL,
  `karir` varchar(255) DEFAULT NULL,
  `past` varchar(255) DEFAULT NULL,
  `usia` varchar(255) DEFAULT NULL,
  `visimisi` varchar(255) DEFAULT NULL,
  `parpol` varchar(255) DEFAULT NULL,
  `likely` varchar(255) DEFAULT NULL,
  `willvote` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `prevote_test2`
--

INSERT INTO `prevote_test2` (`id`, `pendidikan`, `karir`, `past`, `usia`, `visimisi`, `parpol`, `likely`, `willvote`) VALUES
('1', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Jason Tjoa', 'N'),
('2', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Y'),
('3', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'N'),
('4', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Irwanto Wijaya', 'Y'),
('5', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Jason Tjoa', 'N'),
('6', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Y'),
('7', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Y'),
('8', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Jason Tjoa', 'N'),
('9', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Irwanto Wijaya', 'Ziven Louis', 'N'),
('10', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Ziven Louis', 'Irwanto Wijaya', 'Y'),
('11', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Ziven Louis', 'N'),
('12', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Y'),
('13', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Y'),
('14', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Y'),
('15', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'N'),
('16', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Ziven Louis', 'N'),
('17', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'N'),
('18', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'N'),
('19', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'N'),
('20', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Jason Tjoa', 'Y'),
('21', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Y'),
('22', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Ziven Louis', 'Jason Tjoa', 'N'),
('23', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Y'),
('24', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Y'),
('25', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Ziven Louis', 'Jason Tjoa', 'Irwanto Wijaya', 'Y'),
('26', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Y'),
('27', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Ziven Louis', 'Y'),
('28', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Ziven Louis', 'Jason Tjoa', 'N'),
('29', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'N'),
('30', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Y'),
('31', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Y'),
('32', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Irwanto Wijaya', 'Y'),
('33', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Ziven Louis', 'N'),
('34', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Y'),
('35', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'N'),
('36', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Y'),
('37', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'N'),
('38', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Y'),
('39', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Y'),
('40', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Y'),
('41', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Ziven Louis', 'N'),
('42', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'N'),
('43', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Irwanto Wijaya', 'Jason Tjoa', 'Y'),
('44', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Ziven Louis', 'Y'),
('45', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Ziven Louis', 'Ziven Louis', 'Y'),
('46', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Jason Tjoa', 'N'),
('47', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Y'),
('48', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'N'),
('49', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Y'),
('50', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'N'),
('51', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Y'),
('52', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Y'),
('53', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Y'),
('54', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Y'),
('55', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Ziven Louis', 'Jason Tjoa', 'N'),
('56', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Y'),
('57', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Irwanto Wijaya', 'Y'),
('58', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Ziven Louis', 'Y'),
('59', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Jason Tjoa', 'Ziven Louis', 'N'),
('60', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Y'),
('61', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Y'),
('62', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Jason Tjoa', 'Y'),
('63', 'Jason Tjoa', 'Ziven Louis', 'Jason Tjoa', 'Ziven Louis', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'N'),
('64', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Ziven Louis', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Ziven Louis', 'N'),
('65', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'N'),
('66', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'N'),
('67', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `prevote_test3`
--

CREATE TABLE `prevote_test3` (
  `id` varchar(255) DEFAULT NULL,
  `pendidikan` varchar(255) DEFAULT NULL,
  `karir` varchar(255) DEFAULT NULL,
  `past` varchar(255) DEFAULT NULL,
  `usia` varchar(255) DEFAULT NULL,
  `visimisi` varchar(255) DEFAULT NULL,
  `parpol` varchar(255) DEFAULT NULL,
  `likely` varchar(255) DEFAULT NULL,
  `willvote` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `prevote_test3`
--

INSERT INTO `prevote_test3` (`id`, `pendidikan`, `karir`, `past`, `usia`, `visimisi`, `parpol`, `likely`, `willvote`) VALUES
('1', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Jason Tjoa', 'N'),
('2', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Y'),
('3', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'N'),
('4', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Irwanto Wijaya', 'Y'),
('5', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Jason Tjoa', 'N'),
('6', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Y'),
('7', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Y'),
('8', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Jason Tjoa', 'N'),
('9', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Irwanto Wijaya', 'Ziven Louis', 'N'),
('10', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Ziven Louis', 'Irwanto Wijaya', 'Y'),
('11', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Ziven Louis', 'N'),
('12', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Y'),
('13', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Y'),
('14', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Y'),
('15', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'N'),
('16', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Ziven Louis', 'N'),
('17', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'N'),
('18', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'N'),
('19', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'N'),
('20', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Jason Tjoa', 'Y'),
('21', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Y'),
('22', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Ziven Louis', 'Jason Tjoa', 'N'),
('23', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Y'),
('24', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Y'),
('25', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Ziven Louis', 'Jason Tjoa', 'Irwanto Wijaya', 'Y'),
('26', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Y'),
('27', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Ziven Louis', 'Y'),
('28', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Ziven Louis', 'Jason Tjoa', 'N'),
('29', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'N'),
('30', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Y'),
('31', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Y'),
('32', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Irwanto Wijaya', 'Y'),
('33', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Ziven Louis', 'N'),
('34', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Y'),
('35', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'N'),
('36', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Y'),
('37', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'N'),
('38', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Jason Tjoa', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Y'),
('39', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Y'),
('40', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Y'),
('41', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Ziven Louis', 'N'),
('42', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'N'),
('43', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Irwanto Wijaya', 'Jason Tjoa', 'Y'),
('44', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Ziven Louis', 'Y'),
('45', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Ziven Louis', 'Ziven Louis', 'Y'),
('46', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Jason Tjoa', 'N'),
('47', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Y'),
('48', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'N'),
('49', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Y'),
('50', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'N'),
('51', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Y'),
('52', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Y'),
('53', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Y'),
('54', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Y'),
('55', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Ziven Louis', 'Jason Tjoa', 'N'),
('56', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Y'),
('57', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Ziven Louis', 'Irwanto Wijaya', 'Y'),
('58', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Jason Tjoa', 'Ziven Louis', 'Ziven Louis', 'Y'),
('59', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Jason Tjoa', 'Ziven Louis', 'N'),
('60', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Jason Tjoa', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Y'),
('61', 'Jason Tjoa', 'Darren Oswaldo Tanjaya', 'Irwanto Wijaya', 'Jason Tjoa', 'Irwanto Wijaya', 'Irwanto Wijaya', 'Ziven Louis', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `prevoting`
--

CREATE TABLE `prevoting` (
  `id` int(10) NOT NULL,
  `table_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `prevoting`
--

INSERT INTO `prevoting` (`id`, `table_name`) VALUES
(1, 'prevote_presurvei'),
(5, 'prevote_test'),
(6, 'prevote_test2'),
(7, 'prevote_test3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomor` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `NIK` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto_KTP` varchar(100) NOT NULL,
  `foto_wajah` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `nama`, `nomor`, `email`, `NIK`, `password`, `foto_KTP`, `foto_wajah`, `status`) VALUES
(9, 'Ha Eun', '0899009987', 'ha@gmail.com', '12567890000', 'abcdeF@12', '', '', 'verified'),
(19, 'Ha Eun', '0812312388', 'hihihi@gmail.com', '1201201201209', '@Abcd12', '', '', 'verified'),
(21, 'Ha Eun', '08116361477', 'haho@gmail.com', '1212343456567', '@Abcd12', '', '', 'verified'),
(23, 'Ha Eun', '087812341234', 'haeuntes100@gmail.com', '1234567899999', '@Abcd12', '', '', 'verified'),
(26, 'haeunlee', '08998123123', 'h@gmail.com', '8877665544321', 'haeunLee12!', 'canvas (6).png', '../img/user/canvas (6).png', 'pending'),
(27, 'Ha Eun', '089988989827', 'h@gmail.com', '1231231231231', 'haeunLee12!', 'bannerconvert.png', '../img/user/caps.png', 'pending'),
(28, 'haeun', '08116361458', 'haeunictsis@gmail.com', '1234567890000', 'haha12!L', 'bannerconvert.png', '../img/user/canvas (6).png', 'verified'),
(29, 'Grace Lee', '0891231234', 'ejscassava@gmail.com', '1230012300123', 'haeunLee12!', 'bannerconvert.png', '../img/user/canvas (6).png', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `NIK` varchar(100) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `choose` varchar(100) NOT NULL,
  `voting_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `category_name`, `user_id`, `NIK`, `user_nama`, `choose`, `voting_time`) VALUES
(1, 'PILPRES2023', 1, '1231231231231', 'glhaeun', 'Jokowi', '2023-07-09'),
(7, 'PILPRES2023', 28, '1234567890000', 'haeun', 'Jokowi', '2023-07-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `prevoting`
--
ALTER TABLE `prevoting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `prevoting`
--
ALTER TABLE `prevoting`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
