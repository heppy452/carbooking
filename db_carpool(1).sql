-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2020 at 02:18 AM
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
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `conf_users`
--

INSERT INTO `conf_users` (`id_user`, `fullname`, `avatar`, `username`, `password`, `id_perusahaan`, `id_departemen`, `salt`, `level`, `last_login`, `ip_address`, `status`) VALUES
(1, 'Superadmin', 'img/avatar/6U6lk2At.jpg', 'admin', '89a0c6ee2ad740022ce185004dd64cca98c04b51', 0, 0, 'Wb8e.?s5', 1, '2020-06-12 07:17:19', '127.0.0.1', 1),
(2, 'Heppy', '', 'heppy', 'ccb69fd6375b7ec9e50f83894c05950aa1c81b31', 0, 0, 'ujAHrMU7', 2, '2020-06-11 12:22:50', '::1', 1),
(4, 'Siswoyo', '', 'woyo', '5a42f68d1faf1425bd66e3b88375ea57a89f6f4d', 7, 6, 'UDoT!EXc', 5, '2020-06-12 07:17:28', '127.0.0.1', 1),
(5, 'Nasrullah', '', 'nasrul', '10d59ad1caf8870f7423bd35e5e1ea32af3089b6', 7, 6, 'Mp2foXSb', 4, '2020-05-22 13:02:44', '::1', 1);

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
(1, '80305115', '082194275479'),
(3, '80301416', '085397340817'),
(4, '80305153', '083287777875');

-- --------------------------------------------------------

--
-- Table structure for table `data_kendaraan`
--

CREATE TABLE `data_kendaraan` (
  `id_kendaraan` int(5) NOT NULL,
  `nomor_plat` varchar(15) NOT NULL,
  `type_kendaraan` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_kendaraan`
--

INSERT INTO `data_kendaraan` (`id_kendaraan`, `nomor_plat`, `type_kendaraan`) VALUES
(1, 'B 2233 SZA', 1),
(3, 'B 2855 SOL', 1),
(4, 'B 1841 URZ', 1),
(5, 'B 1949 URZ', 1),
(6, 'B 1698 UYO', 5);

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
(2, 'Kantor IMIP'),
(3, 'Politeknik'),
(4, 'Klinik IMIP');

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
  `apr_ga_ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_request`
--

INSERT INTO `data_request` (`id_request`, `nomor_request`, `jenis_kebutuhan`, `jenis_lokasi`, `tgl_jadwal`, `jam_jemput`, `lokasi_jemput`, `jml_penumpang`, `nama_pemesan`, `no_hp`, `lokasi_awal`, `lokasi_tujuan`, `keterangan`, `id_perusahaan`, `id_departement`, `status_request`, `jam_berangkat`, `jam_tiba`, `id_driver`, `id_kendaraan`, `id_user`, `tgl_jam_input`, `apr_spv`, `apr_spv_tgl`, `apr_spv_ket`, `apr_dir`, `apr_dir_tgl`, `apr_dir_ket`, `apr_ga`, `apr_ga_tgl`, `apr_ga_ket`) VALUES
(2, '2020000001', 1, 1, '2020-05-07', '13:50:00', 'Kantor IMIP', 2, 'Nasrullah', '085397340817', 2, 3, 'Jemput Depan Kantor IMIP', 7, 6, 3, '14:00:00', '14:34:00', 3, 1, 4, '2020-05-04 11:02:27', 1, '2020-05-08', '', 0, '0000-00-00', '', 1, '2020-05-12', ''),
(3, '2020000002', 1, 2, '2020-05-16', '08:30:00', 'Parkiran Klinik', 3, 'Herson', '082194275478', 4, 2, 'Tolong On time harus meeting pukul 09.00', 7, 6, 3, '08:40:00', '09:00:00', 1, 6, 4, '2020-05-14 09:33:53', 1, '2020-05-14', '', 0, '0000-00-00', '', 1, '2020-05-14', ''),
(4, '2020000003', 1, 2, '2020-05-16', '08:30:00', 'Pintu Belakang', 4, 'Gunnawan', '08934527771', 2, 3, 'Metting pukul 09.00', 7, 6, 3, '09:00:00', '10:00:00', 1, 5, 4, '2020-05-15 09:19:00', 1, '2020-05-18', '', 0, '0000-00-00', '', 1, '2020-05-18', ''),
(5, '2020000004', 2, 2, '2020-05-17', '08:30:00', 'Parkiran Mobil Imip', 1, 'Herson', '09876352786', 2, 3, 'Antar Makanan', 7, 6, 3, '08:40:00', '09:20:00', 4, 6, 2, '2020-05-15 09:55:08', 1, '2020-05-15', '', 0, '0000-00-00', '', 1, '2020-05-15', ''),
(6, '2020000005', 1, 2, '2020-05-23', '08:30:00', 'Parkiran IMIP', 2, 'Heppy', '0987654321', 2, 3, 'ada meeting jam 09.00', 7, 6, 3, '08:30:00', '09:00:00', 4, 5, 4, '2020-05-22 15:18:56', 1, '2020-05-22', '', 0, '0000-00-00', '', 1, '2020-05-22', '');

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
(100, 4, '2020-06-12 07:17:28', '127.0.0.1', 'Siswoyo');

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
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_driver`
--
ALTER TABLE `data_driver`
  MODIFY `id_driver` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id_temp` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
