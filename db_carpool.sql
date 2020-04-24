-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2020 at 02:46 AM
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
(3, 'fa-weight', NULL, 'Data Driver', 'more_data/data_driver', 1, 1, 1, '\"2\"', 2),
(5, 'fa-shuttle-van', NULL, 'Data Kendaraan', 'more_data/data_kendaraan', 1, 1, 1, '\"2\"', 3),
(6, 'fa-map-marked-alt', NULL, 'Data Lokasi', 'more_data/data_lokasi', 1, 1, 1, '\"2\"', 4),
(7, 'fa-user-friends', NULL, 'Data User', 'more_data/data_user', 1, 1, 1, '\"2\"', 5);

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
(1, 'Superadmin', 'img/avatar/6U6lk2At.jpg', 'admin', '89a0c6ee2ad740022ce185004dd64cca98c04b51', 0, 0, 'Wb8e.?s5', 1, '2020-04-23 07:50:02', '127.0.0.1', 1),
(2, 'Heppy', '', 'heppy', 'ccb69fd6375b7ec9e50f83894c05950aa1c81b31', 0, 0, 'ujAHrMU7', 2, '2020-04-24 07:01:49', '127.0.0.1', 1),
(4, 'Siswoyo', '', 'woyo', 'dd0437c131418a35c100b77de296a9d75954be8a', 7, 6, '.EsyJi6?', 5, '2020-04-24 07:46:21', '127.0.0.1', 1);

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
(1, '88100085', '082194275479'),
(3, '88100084', '085397340817');

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
(1, 'B 2233 SZA', 3);

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
(2, 'Kantor IMIP');

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
(25, 4, '2020-04-24 07:46:21', '127.0.0.1', 'Siswoyo');

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
  MODIFY `id_menu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `conf_submenu`
--
ALTER TABLE `conf_submenu`
  MODIFY `id_submenu` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `conf_users`
--
ALTER TABLE `conf_users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_driver`
--
ALTER TABLE `data_driver`
  MODIFY `id_driver` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_kendaraan`
--
ALTER TABLE `data_kendaraan`
  MODIFY `id_kendaraan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_lokasi`
--
ALTER TABLE `data_lokasi`
  MODIFY `id_lokasi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `temp_login`
--
ALTER TABLE `temp_login`
  MODIFY `id_temp` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
