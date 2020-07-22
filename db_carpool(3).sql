-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2020 at 09:01 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_carpool`
--

-- --------------------------------------------------------

--
-- Table structure for table `conf_level`
--

CREATE TABLE `conf_level` (
  `id_level` tinyint(2) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `conf_level`
--

INSERT INTO `conf_level` (`id_level`, `name`) VALUES
(1, 'Superadmin'),
(2, 'Administrator'),
(3, 'Direktur'),
(4, 'Supervisor'),
(5, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `conf_menu`
--

CREATE TABLE `conf_menu` (
  `id_menu` int(10) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `icon2` varchar(150) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `akses` tinyint(1) NOT NULL,
  `sub` tinyint(1) NOT NULL,
  `level` text NOT NULL,
  `position` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `conf_menu`
--

INSERT INTO `conf_menu` (`id_menu`, `icon`, `icon2`, `name`, `link`, `status`, `akses`, `sub`, `level`, `position`) VALUES
(1, 'fa-desktop', NULL, 'Dashboard', 'home', 1, 1, 1, '\"1\",\"2\"', 1),
(2, 'fa-cogs', NULL, 'Configuration', 'admin/gen_modul', 1, 1, 1, '\"1\"', 6),
(3, 'fa-weight', NULL, 'Data Driver', 'more_data/data_driver', 1, 1, 1, '\"2\"', 6),
(5, 'fa-shuttle-van', NULL, 'Data Kendaraan', 'more_data/data_kendaraan', 1, 1, 1, '\"2\"', 8),
(6, 'fa-map-marked-alt', NULL, 'Data Lokasi', 'more_data/data_lokasi', 1, 1, 1, '\"2\"', 7),
(7, 'fa-user-friends', NULL, 'Data User', 'more_data/data_user', 1, 1, 1, '\"2\"', 9),
(8, 'fa-journal-whills', NULL, 'Data Permintaan', 'request/request', 1, 1, 1, '\"4\",\"5\"', 1),
(9, 'fa-address-card', NULL, 'Permintaan Approval', 'request/request', 1, 1, 1, '\"2\"', 2),
(10, 'fa-hdd', NULL, 'Permintaan Proses', 'request/proses', 1, 1, 1, '\"2\"', 3),
(11, 'fa-print', NULL, 'Cetak Jadwal', 'request/print_jadwal', 1, 1, 1, '\"2\"', 4),
(12, 'fa-book', NULL, 'Laporan', 'request/laporan', 1, 1, 1, '\"2\"', 5);

-- --------------------------------------------------------

--
-- Table structure for table `conf_submenu`
--

CREATE TABLE `conf_submenu` (
  `id_submenu` int(5) NOT NULL,
  `id_menu` int(5) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `icon2` varchar(150) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `link` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `level` text NOT NULL,
  `position` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `conf_users`
--

CREATE TABLE `conf_users` (
  `id_user` int(10) NOT NULL,
  `fullname` varchar(60) NOT NULL,
  `avatar` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `id_perusahaan` int(4) NOT NULL,
  `id_departemen` int(4) NOT NULL,
  `salt` varchar(15) NOT NULL,
  `level` tinyint(2) NOT NULL,
  `last_login` datetime NOT NULL,
  `ip_address` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `conf_users`
--

INSERT INTO `conf_users` (`id_user`, `fullname`, `avatar`, `username`, `password`, `id_perusahaan`, `id_departemen`, `salt`, `level`, `last_login`, `ip_address`, `email`, `status`) VALUES
(1, 'Superadmin', 'img/avatar/6U6lk2At.jpg', 'admin', '89a0c6ee2ad740022ce185004dd64cca98c04b51', 0, 0, 'Wb8e.?s5', 1, '2020-06-29 12:37:39', '::1', '', 1),
(2, 'Heppy', '', 'heppy', 'ccb69fd6375b7ec9e50f83894c05950aa1c81b31', 0, 0, 'ujAHrMU7', 2, '2020-07-16 09:21:32', '::1', 'heppy452@gmail.com', 1),
(4, 'Siswoyo', '', 'woyo', '5a42f68d1faf1425bd66e3b88375ea57a89f6f4d', 7, 6, 'UDoT!EXc', 5, '2020-06-30 07:20:26', '::1', 'hevi.siswoyo@imip.co.id', 1),
(5, 'Nasrullah', '', 'nasrul', '10d59ad1caf8870f7423bd35e5e1ea32af3089b6', 7, 6, 'Mp2foXSb', 4, '2020-06-23 13:23:30', '::1', 'hevi.siswoyo@imip.co.id', 1),
(7, 'Resky', '', 'kiki', '3beaf0711cbd2e01943d1910c2a47f8bfaf1224d', 7, 56, 'W=g.j6Dh', 5, '2020-07-16 08:58:50', '127.0.0.1', 'hevi.siswoyo@imip.co.id', 1),
(8, 'Indrawan', '', 'indra', '74d5e38efc1d59455fdf4f96969428bbafc4ceff', 7, 56, 'Yt7DFfP&', 4, '2020-07-13 13:56:26', '::1', 'hevi.siswoyo@imip.co.id', 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_driver`
--

CREATE TABLE `data_driver` (
  `id_driver` int(2) NOT NULL,
  `drv_nik` varchar(10) NOT NULL,
  `drv_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_driver`
--

INSERT INTO `data_driver` (`id_driver`, `drv_nik`, `drv_hp`) VALUES
(1, '80305115', '0987763636'),
(2, '80301416', '08219476522');

-- --------------------------------------------------------

--
-- Table structure for table `data_kendaraan`
--

CREATE TABLE `data_kendaraan` (
  `id_kendaraan` int(5) NOT NULL,
  `nomor_plat` varchar(15) NOT NULL,
  `no_internal` varchar(12) NOT NULL,
  `type_kendaraan` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_kendaraan`
--

INSERT INTO `data_kendaraan` (`id_kendaraan`, `nomor_plat`, `no_internal`, `type_kendaraan`) VALUES
(1, 'B 2233 SZA', '', 1),
(3, 'B 2855 SOL', '', 1),
(4, 'B 1841 URZ', 'LV 005 IMIP', 1),
(5, 'B 1949 URZ', '', 1),
(6, 'B 1698 UYO', '', 5);

-- --------------------------------------------------------

--
-- Table structure for table `data_lokasi`
--

CREATE TABLE `data_lokasi` (
  `id_lokasi` int(10) NOT NULL,
  `nama_lokasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_lokasi`
--

INSERT INTO `data_lokasi` (`id_lokasi`, `nama_lokasi`) VALUES
(1, 'Kantor IMIP'),
(2, 'Kantor Tenant'),
(3, 'Politeknik'),
(4, 'Rusunawa');

-- --------------------------------------------------------

--
-- Table structure for table `data_request`
--

CREATE TABLE `data_request` (
  `id_request` int(10) NOT NULL,
  `nomor_request` varchar(14) NOT NULL,
  `jenis_kebutuhan` int(1) NOT NULL,
  `jenis_lokasi` int(1) NOT NULL,
  `tgl_jadwal` date NOT NULL,
  `jam_jemput` time NOT NULL,
  `durasi` int(3) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `lokasi_jemput` text NOT NULL,
  `jml_penumpang` int(3) NOT NULL,
  `nama_pemesan` varchar(40) NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `lokasi_awal` int(3) NOT NULL,
  `lokasi_tujuan` int(3) NOT NULL,
  `keterangan` text NOT NULL,
  `id_perusahaan` int(3) NOT NULL,
  `id_departement` int(3) NOT NULL,
  `status_request` int(1) NOT NULL,
  `jam_berangkat` time NOT NULL,
  `jam_tiba` time NOT NULL,
  `id_driver` int(2) NOT NULL,
  `id_kendaraan` int(2) NOT NULL,
  `id_user` int(3) NOT NULL,
  `tgl_jam_input` datetime NOT NULL,
  `apr_spv` int(1) NOT NULL,
  `apr_spv_tgl` date NOT NULL,
  `apr_spv_ket` text NOT NULL,
  `apr_dir` int(1) NOT NULL,
  `apr_dir_tgl` date NOT NULL,
  `apr_dir_ket` text NOT NULL,
  `apr_ga` int(1) NOT NULL,
  `apr_ga_tgl` date NOT NULL,
  `apr_ga_ket` text NOT NULL,
  `ket_cancel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_request`
--

INSERT INTO `data_request` (`id_request`, `nomor_request`, `jenis_kebutuhan`, `jenis_lokasi`, `tgl_jadwal`, `jam_jemput`, `durasi`, `satuan`, `lokasi_jemput`, `jml_penumpang`, `nama_pemesan`, `no_hp`, `lokasi_awal`, `lokasi_tujuan`, `keterangan`, `id_perusahaan`, `id_departement`, `status_request`, `jam_berangkat`, `jam_tiba`, `id_driver`, `id_kendaraan`, `id_user`, `tgl_jam_input`, `apr_spv`, `apr_spv_tgl`, `apr_spv_ket`, `apr_dir`, `apr_dir_tgl`, `apr_dir_ket`, `apr_ga`, `apr_ga_tgl`, `apr_ga_ket`, `ket_cancel`) VALUES
(1, '2020000001', 1, 1, '2020-07-10', '08:30:00', 1, 'Jam', 'sfff', 1, 'sadas', '87386843', 1, 1, 'sfsf', 7, 56, 1, '00:00:00', '00:00:00', 0, 0, 7, '2020-07-10 15:28:44', 1, '2020-07-13', '', 0, '0000-00-00', '', 0, '0000-00-00', '', ''),
(2, '2020000002', 1, 2, '2020-07-11', '08:30:00', 1, 'Jam', 'Parkiran IMIP', 3, 'Heppy', '0987654231', 1, 3, 'Cek Jaringan Telkom', 7, 56, 3, '08:40:00', '09:00:00', 1, 4, 7, '2020-07-10 15:51:55', 1, '2020-07-10', '', 0, '0000-00-00', '', 1, '2020-07-10', '', ''),
(3, '2020000003', 1, 1, '2020-07-08', '08:30:00', 1, 'Menit', 'rtrt', 1, 'rer', 'rtrtr', 1, 1, 'erwer', 7, 56, 2, '00:00:00', '00:00:00', 0, 0, 7, '2020-07-13 15:34:23', 2, '2020-07-13', 'tidak bisa digunakan maka dari itu saya harus', 0, '0000-00-00', '', 2, '2020-07-13', 'Tidak disetujui oleh Head Departement', ''),
(4, '2020000004', 1, 1, '2020-07-14', '08:30:00', 1, 'Jam', 'parkiran IMIP', 2, 'Heppy', '098763333', 1, 3, 'Meeting aplikasi pertemuan', 7, 56, 1, '00:00:00', '00:00:00', 1, 4, 7, '2020-07-13 15:51:09', 1, '2020-07-13', '', 0, '0000-00-00', '', 1, '2020-07-13', '', ''),
(6, '2020000005', 1, 1, '2020-07-17', '07:30:00', 15, 'Menit', 'RK6', 1, 'sya', '987', 3, 1, 'Berangkat Kerja kenator imip', 7, 56, 0, '00:00:00', '00:00:00', 0, 0, 7, '2020-07-16 09:43:05', 0, '0000-00-00', '', 0, '0000-00-00', '', 0, '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `temp_login`
--

CREATE TABLE `temp_login` (
  `id_temp` int(10) NOT NULL,
  `id_user` int(5) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `nama_user` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_login`
--

INSERT INTO `temp_login` (`id_temp`, `id_user`, `tanggal`, `ip_address`, `nama_user`) VALUES
(1, 1, '2020-03-13 07:04:43', '127.0.0.1', 'Superadmin'),
(2, 2, '2020-03-13 07:27:58', '::1', 'Heppy'),
(3, 2, '2020-03-13 13:07:12', '::1', 'Heppy'),
(4, 1, '2020-03-13 13:07:21', '::1', 'Superadmin'),
(5, 1, '2020-03-14 07:01:30', '::1', 'Superadmin'),
(6, 2, '2020-03-14 07:01:54', '::1', 'Heppy'),
(7, 1, '2020-03-14 14:37:50', '::1', 'Superadmin'),
(8, 1, '2020-04-20 09:20:26', '::1', 'Superadmin'),
(9, 2, '2020-04-20 09:22:17', '::1', 'Heppy'),
(10, 2, '2020-04-20 11:55:29', '::1', 'Heppy'),
(11, 1, '2020-04-20 11:58:40', '::1', 'Superadmin'),
(12, 1, '2020-04-21 12:06:03', '::1', 'Superadmin'),
(13, 2, '2020-04-21 12:16:39', '::1', 'Heppy'),
(14, 2, '2020-04-22 07:07:36', '127.0.0.1', 'Heppy'),
(15, 1, '2020-04-22 07:40:41', '127.0.0.1', 'Superadmin'),
(16, 2, '2020-04-22 07:42:33', '::1', 'Heppy'),
(17, 2, '2020-04-22 12:56:03', '::1', 'Heppy'),
(18, 1, '2020-04-23 07:40:19', '127.0.0.1', 'Superadmin'),
(19, 2, '2020-04-23 07:44:18', '127.0.0.1', 'Heppy'),
(20, 1, '2020-04-23 07:50:02', '127.0.0.1', 'Superadmin'),
(21, 2, '2020-04-23 07:51:29', '127.0.0.1', 'Heppy'),
(22, 2, '2020-04-23 12:30:37', '127.0.0.1', 'Heppy'),
(23, 3, '2020-04-23 12:50:15', '::1', 'Resky'),
(24, 2, '2020-04-24 07:01:49', '127.0.0.1', 'Heppy'),
(25, 4, '2020-04-24 07:46:21', '127.0.0.1', 'Siswoyo'),
(26, 2, '2020-04-24 08:21:15', '127.0.0.1', 'Heppy'),
(27, 1, '2020-04-27 06:46:15', '127.0.0.1', 'Superadmin'),
(28, 2, '2020-04-27 07:41:38', '::1', 'Heppy'),
(29, 4, '2020-04-27 07:42:20', '::1', 'Siswoyo'),
(30, 2, '2020-04-27 09:58:02', '::1', 'Heppy'),
(31, 1, '2020-04-29 09:41:08', '::1', 'Superadmin'),
(32, 4, '2020-04-29 09:42:57', '::1', 'Siswoyo'),
(33, 4, '2020-04-29 12:29:32', '::1', 'Siswoyo'),
(34, 4, '2020-04-30 07:14:32', '::1', 'Siswoyo'),
(35, 4, '2020-05-02 07:47:15', '::1', 'Siswoyo'),
(36, 4, '2020-05-04 06:30:07', '::1', 'Siswoyo'),
(37, 2, '2020-05-04 07:30:59', '::1', 'Heppy'),
(38, 4, '2020-05-04 12:28:38', '::1', 'Siswoyo'),
(39, 1, '2020-05-04 12:42:52', '::1', 'Superadmin'),
(40, 2, '2020-05-04 12:45:23', '::1', 'Heppy'),
(41, 4, '2020-05-05 06:46:27', '::1', 'Siswoyo'),
(42, 2, '2020-05-05 07:37:19', '::1', 'Heppy'),
(43, 1, '2020-05-05 07:59:17', '::1', 'Superadmin'),
(44, 5, '2020-05-05 08:00:43', '::1', 'Nasrullah'),
(45, 1, '2020-05-05 08:24:41', '::1', 'Superadmin'),
(46, 4, '2020-05-05 08:25:12', '::1', 'Siswoyo'),
(47, 2, '2020-05-05 08:41:38', '::1', 'Heppy'),
(48, 1, '2020-05-05 08:55:15', '::1', 'Superadmin'),
(49, 4, '2020-05-05 12:34:24', '::1', 'Siswoyo'),
(50, 5, '2020-05-05 12:34:37', '::1', 'Nasrullah'),
(51, 4, '2020-05-08 06:39:11', '::1', 'Siswoyo'),
(52, 5, '2020-05-08 06:39:33', '::1', 'Nasrullah'),
(53, 5, '2020-05-08 07:55:16', '::1', 'Nasrullah'),
(54, 2, '2020-05-08 07:56:27', '::1', 'Heppy'),
(55, 1, '2020-05-08 08:41:47', '::1', 'Superadmin'),
(56, 4, '2020-05-08 09:16:04', '::1', 'Siswoyo'),
(57, 2, '2020-05-08 12:44:21', '::1', 'Heppy'),
(58, 2, '2020-05-12 06:47:20', '::1', 'Heppy'),
(59, 4, '2020-05-12 07:03:28', '::1', 'Siswoyo'),
(60, 2, '2020-05-12 14:00:28', '::1', 'Heppy'),
(61, 1, '2020-05-12 14:28:12', '::1', 'Superadmin'),
(62, 4, '2020-05-14 06:57:29', '::1', 'Siswoyo'),
(63, 2, '2020-05-14 06:58:04', '::1', 'Heppy'),
(64, 5, '2020-05-14 07:34:28', '::1', 'Nasrullah'),
(65, 4, '2020-05-15 07:13:17', '::1', 'Siswoyo'),
(66, 5, '2020-05-15 07:19:32', '::1', 'Nasrullah'),
(67, 2, '2020-05-15 07:21:54', '::1', 'Heppy'),
(68, 2, '2020-05-15 07:28:31', '::1', 'Heppy'),
(69, 1, '2020-05-15 07:41:40', '::1', 'Superadmin'),
(70, 2, '2020-05-15 12:47:07', '::1', 'Heppy'),
(71, 2, '2020-05-18 07:25:08', '::1', 'Heppy'),
(72, 1, '2020-05-18 07:30:01', '::1', 'Superadmin'),
(73, 2, '2020-05-18 13:12:54', '::1', 'Heppy'),
(74, 5, '2020-05-18 13:14:17', '::1', 'Nasrullah'),
(75, 4, '2020-05-18 13:33:47', '::1', 'Siswoyo'),
(76, 5, '2020-05-18 13:35:48', '::1', 'Nasrullah'),
(77, 2, '2020-05-18 13:48:29', '::1', 'Heppy'),
(78, 4, '2020-05-18 13:52:03', '::1', 'Siswoyo'),
(79, 2, '2020-05-18 13:56:18', '::1', 'Heppy'),
(80, 4, '2020-05-22 13:02:14', '::1', 'Siswoyo'),
(81, 5, '2020-05-22 13:02:44', '::1', 'Nasrullah'),
(82, 4, '2020-05-22 13:09:43', '::1', 'Siswoyo'),
(83, 2, '2020-05-22 13:27:44', '::1', 'Heppy'),
(84, 2, '2020-06-02 07:29:49', '::1', 'Heppy'),
(85, 2, '2020-06-04 07:40:44', '::1', 'Heppy'),
(86, 2, '2020-06-04 11:57:21', '::1', 'Heppy'),
(87, 2, '2020-06-08 06:56:15', '::1', 'Heppy'),
(88, 2, '2020-06-08 11:32:19', '::1', 'Heppy'),
(89, 1, '2020-06-08 14:11:43', '::1', 'Superadmin'),
(90, 2, '2020-06-08 14:17:16', '::1', 'Heppy'),
(91, 1, '2020-06-08 14:37:28', '::1', 'Superadmin'),
(92, 2, '2020-06-09 06:56:46', '::1', 'Heppy'),
(93, 1, '2020-06-09 06:59:30', '::1', 'Superadmin'),
(94, 2, '2020-06-09 07:01:12', '::1', 'Heppy'),
(95, 2, '2020-06-09 08:21:37', '::1', 'Heppy'),
(96, 2, '2020-06-09 12:39:35', '::1', 'Heppy'),
(97, 2, '2020-06-09 14:08:55', '::1', 'Heppy'),
(98, 2, '2020-06-11 12:22:50', '::1', 'Heppy'),
(99, 1, '2020-06-12 07:17:19', '127.0.0.1', 'Superadmin'),
(100, 4, '2020-06-12 07:17:28', '127.0.0.1', 'Siswoyo'),
(101, 4, '2020-06-12 07:24:49', '::1', 'Siswoyo'),
(102, 1, '2020-06-12 07:25:13', '::1', 'Superadmin'),
(103, 4, '2020-06-12 07:31:29', '::1', 'Siswoyo'),
(104, 1, '2020-06-12 08:12:28', '::1', 'Superadmin'),
(105, 5, '2020-06-12 08:13:05', '::1', 'Nasrullah'),
(106, 4, '2020-06-12 12:09:39', '::1', 'Siswoyo'),
(107, 4, '2020-06-12 12:15:48', '::1', 'Siswoyo'),
(108, 4, '2020-06-12 14:55:07', '::1', 'Siswoyo'),
(109, 4, '2020-06-13 06:34:09', '::1', 'Siswoyo'),
(110, 1, '2020-06-13 07:17:29', '::1', 'Superadmin'),
(111, 6, '2020-06-13 07:18:21', '::1', 'Satrio Setiawan'),
(112, 1, '2020-06-13 07:18:44', '::1', 'Superadmin'),
(113, 5, '2020-06-13 07:19:00', '::1', 'Nasrullah'),
(114, 1, '2020-06-13 07:19:18', '::1', 'Superadmin'),
(115, 2, '2020-06-13 07:19:43', '::1', 'Heppy'),
(116, 1, '2020-06-13 08:19:35', '::1', 'Superadmin'),
(117, 2, '2020-06-13 08:28:42', '::1', 'Heppy'),
(118, 2, '2020-06-13 08:38:14', '::1', 'Heppy'),
(119, 5, '2020-06-13 08:38:24', '::1', 'Nasrullah'),
(120, 2, '2020-06-13 09:14:43', '::1', 'Heppy'),
(121, 4, '2020-06-13 09:16:29', '::1', 'Siswoyo'),
(122, 4, '2020-06-13 11:59:52', '::1', 'Siswoyo'),
(123, 2, '2020-06-13 12:00:02', '::1', 'Heppy'),
(124, 5, '2020-06-13 12:06:34', '::1', 'Nasrullah'),
(125, 4, '2020-06-13 12:11:32', '::1', 'Siswoyo'),
(126, 1, '2020-06-13 12:11:39', '::1', 'Superadmin'),
(127, 4, '2020-06-13 12:12:22', '::1', 'Siswoyo'),
(128, 1, '2020-06-13 12:18:07', '::1', 'Superadmin'),
(129, 4, '2020-06-13 12:20:56', '::1', 'Siswoyo'),
(130, 2, '2020-06-16 08:18:03', '::1', 'Heppy'),
(131, 4, '2020-06-19 08:19:32', '::1', 'Siswoyo'),
(132, 2, '2020-06-19 08:19:55', '::1', 'Heppy'),
(133, 4, '2020-06-19 08:20:35', '::1', 'Siswoyo'),
(134, 2, '2020-06-19 08:21:08', '::1', 'Heppy'),
(135, 5, '2020-06-19 08:24:43', '::1', 'Nasrullah'),
(136, 2, '2020-06-19 08:32:19', '::1', 'Heppy'),
(137, 5, '2020-06-19 08:33:47', '::1', 'Nasrullah'),
(138, 4, '2020-06-19 08:56:59', '::1', 'Siswoyo'),
(139, 2, '2020-06-22 08:05:36', '::1', 'Heppy'),
(140, 4, '2020-06-22 08:06:04', '::1', 'Siswoyo'),
(141, 4, '2020-06-22 08:07:32', '::1', 'Siswoyo'),
(142, 2, '2020-06-22 08:28:18', '::1', 'Heppy'),
(143, 2, '2020-06-23 07:55:41', '::1', 'Heppy'),
(144, 2, '2020-06-23 13:01:18', '::1', 'Heppy'),
(145, 4, '2020-06-23 13:16:10', '::1', 'Siswoyo'),
(146, 5, '2020-06-23 13:23:30', '::1', 'Nasrullah'),
(147, 2, '2020-06-23 13:24:09', '::1', 'Heppy'),
(148, 4, '2020-06-25 07:25:46', '::1', 'Siswoyo'),
(149, 2, '2020-06-25 07:39:19', '::1', 'Heppy'),
(150, 2, '2020-06-25 12:35:08', '::1', 'Heppy'),
(151, 4, '2020-06-29 07:39:41', '::1', 'Siswoyo'),
(152, 4, '2020-06-29 12:22:16', '::1', 'Siswoyo'),
(153, 2, '2020-06-29 12:37:28', '::1', 'Heppy'),
(154, 1, '2020-06-29 12:37:39', '::1', 'Superadmin'),
(155, 4, '2020-06-30 07:20:26', '::1', 'Siswoyo'),
(156, 2, '2020-06-30 07:23:11', '::1', 'Heppy'),
(157, 2, '2020-07-02 12:54:14', '::1', 'Heppy'),
(158, 7, '2020-07-02 13:06:07', '::1', 'Resky'),
(159, 8, '2020-07-02 13:09:21', '::1', 'Indrawan'),
(160, 7, '2020-07-02 13:19:05', '::1', 'Resky'),
(161, 2, '2020-07-03 12:55:28', '::1', 'Heppy'),
(162, 2, '2020-07-06 12:29:45', '::1', 'Heppy'),
(163, 2, '2020-07-06 15:16:47', '::1', 'Heppy'),
(164, 2, '2020-07-06 15:43:24', '::1', 'Heppy'),
(165, 7, '2020-07-08 08:47:24', '::1', 'Resky'),
(166, 2, '2020-07-08 09:13:28', '::1', 'Heppy'),
(167, 8, '2020-07-08 09:24:25', '::1', 'Indrawan'),
(168, 2, '2020-07-08 09:25:58', '::1', 'Heppy'),
(169, 2, '2020-07-08 12:30:41', '192.168.1.2', 'Heppy'),
(170, 2, '2020-07-08 13:03:02', '::1', 'Heppy'),
(171, 2, '2020-07-08 13:05:57', '192.168.1.2', 'Heppy'),
(172, 7, '2020-07-08 13:59:42', '::1', 'Resky'),
(173, 8, '2020-07-08 14:08:48', '::1', 'Indrawan'),
(174, 2, '2020-07-10 07:45:00', '::1', 'Heppy'),
(175, 7, '2020-07-10 08:19:47', '::1', 'Resky'),
(176, 2, '2020-07-10 08:21:26', '::1', 'Heppy'),
(177, 7, '2020-07-10 13:28:18', '::1', 'Resky'),
(178, 7, '2020-07-10 13:33:46', '::1', 'Resky'),
(179, 8, '2020-07-10 13:58:04', '::1', 'Indrawan'),
(180, 2, '2020-07-10 13:59:39', '::1', 'Heppy'),
(181, 7, '2020-07-11 10:05:19', '127.0.0.1', 'Resky'),
(182, 7, '2020-07-11 10:21:36', '188.88.3.129', 'Resky'),
(183, 2, '2020-07-11 10:29:40', '188.88.3.129', 'Heppy'),
(184, 2, '2020-07-13 13:06:21', '188.88.3.129', 'Heppy'),
(185, 7, '2020-07-13 13:06:50', '188.88.3.129', 'Resky'),
(186, 8, '2020-07-13 13:07:03', '188.88.3.129', 'Indrawan'),
(187, 7, '2020-07-13 13:26:59', '::1', 'Resky'),
(188, 8, '2020-07-13 13:35:56', '::1', 'Indrawan'),
(189, 7, '2020-07-13 13:45:47', '::1', 'Resky'),
(190, 8, '2020-07-13 13:56:26', '::1', 'Indrawan'),
(191, 2, '2020-07-13 13:57:27', '::1', 'Heppy'),
(192, 7, '2020-07-13 14:00:10', '::1', 'Resky'),
(193, 2, '2020-07-13 14:24:44', '::1', 'Heppy'),
(194, 2, '2020-07-14 08:54:36', '188.88.3.129', 'Heppy'),
(195, 7, '2020-07-14 08:54:43', '188.88.3.129', 'Resky'),
(196, 7, '2020-07-15 14:33:49', '::1', 'Resky'),
(197, 7, '2020-07-16 07:30:44', '127.0.0.1', 'Resky'),
(198, 7, '2020-07-16 08:58:50', '127.0.0.1', 'Resky'),
(199, 2, '2020-07-16 09:21:32', '::1', 'Heppy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conf_level`
--
ALTER TABLE `conf_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `conf_menu`
--
ALTER TABLE `conf_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `conf_submenu`
--
ALTER TABLE `conf_submenu`
  ADD PRIMARY KEY (`id_submenu`);

--
-- Indexes for table `conf_users`
--
ALTER TABLE `conf_users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `data_driver`
--
ALTER TABLE `data_driver`
  ADD PRIMARY KEY (`id_driver`);

--
-- Indexes for table `data_kendaraan`
--
ALTER TABLE `data_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indexes for table `data_lokasi`
--
ALTER TABLE `data_lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `data_request`
--
ALTER TABLE `data_request`
  ADD PRIMARY KEY (`id_request`);

--
-- Indexes for table `temp_login`
--
ALTER TABLE `temp_login`
  ADD PRIMARY KEY (`id_temp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conf_level`
--
ALTER TABLE `conf_level`
  MODIFY `id_level` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `conf_menu`
--
ALTER TABLE `conf_menu`
  MODIFY `id_menu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `conf_submenu`
--
ALTER TABLE `conf_submenu`
  MODIFY `id_submenu` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `conf_users`
--
ALTER TABLE `conf_users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_driver`
--
ALTER TABLE `data_driver`
  MODIFY `id_driver` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_kendaraan`
--
ALTER TABLE `data_kendaraan`
  MODIFY `id_kendaraan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_lokasi`
--
ALTER TABLE `data_lokasi`
  MODIFY `id_lokasi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_request`
--
ALTER TABLE `data_request`
  MODIFY `id_request` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `temp_login`
--
ALTER TABLE `temp_login`
  MODIFY `id_temp` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
