-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2015 at 07:18 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kuesioner_online`
--
CREATE DATABASE IF NOT EXISTS `kuesioner_online` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `kuesioner_online`;

-- --------------------------------------------------------

--
-- Table structure for table `ddosen`
--

CREATE TABLE IF NOT EXISTS `ddosen` (
  `id_dosen` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_dosen`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ddosen`
--

INSERT INTO `ddosen` (`id_dosen`, `nama`, `status`, `created`, `modified`) VALUES
(1, 'Hardi Jamhur', 1, '2015-09-10 00:25:35', NULL),
(2, 'Dahlia Widhyaestoeti', 1, '2015-09-13 09:38:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dmahasiswa`
--

CREATE TABLE IF NOT EXISTS `dmahasiswa` (
  `npm` int(8) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `status` int(1) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`npm`),
  KEY `ix_dmahasiswa_npm` (`npm`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1512029 ;

--
-- Dumping data for table `dmahasiswa`
--

INSERT INTO `dmahasiswa` (`npm`, `nama`, `jurusan`, `kelas`, `status`, `created`, `modified`) VALUES
(1412015, 'Laviva Ma ash Sholihati Fil Jannah', 'Sistem Informasi', 'A', 1, '2015-10-11 08:52:05', '2015-10-11 08:54:15'),
(1412028, 'Rizka Nurmala', 'Sistem Informasi', 'A', 1, '2015-10-11 08:52:33', NULL),
(1412031, 'Indiary Almira', 'Sistem Informasi', 'A', 1, '2015-09-10 00:24:17', NULL),
(1512018, 'Yanuar Nurcahyani', 'Teknik Informatika', 'A', 1, '2015-09-13 03:28:05', NULL),
(1512020, 'Zaky Yudha Prihakasa', 'Teknik Informatika', 'A', 1, '2015-09-13 03:28:05', NULL),
(1512027, 'Ogiano Waskitajaya', 'Teknik Informatika', 'A', 1, '2015-10-11 08:53:47', NULL),
(1512028, 'Oky Octaviansyah', 'Teknik Informatika', 'A', 1, '2015-10-11 08:53:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dmatkul`
--

CREATE TABLE IF NOT EXISTS `dmatkul` (
  `id_matkul` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_matkul`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `dmatkul`
--

INSERT INTO `dmatkul` (`id_matkul`, `nama`, `status`, `created`, `modified`) VALUES
(1, 'Research Methodology', 1, '2015-09-10 00:26:05', '2015-10-11 08:44:26'),
(2, 'Data Driven Websites', 1, '2015-09-10 10:05:57', '2015-10-11 08:44:48'),
(3, 'Information Technology Project (Minor)', 1, '2015-09-10 10:41:56', '2015-10-11 08:45:21'),
(4, 'Information System Project (Minor)', 1, '2015-10-11 08:47:13', NULL),
(5, 'Datamining & Datawarehouse', 1, '2015-10-11 08:48:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fjawaban`
--

CREATE TABLE IF NOT EXISTS `fjawaban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kontrak_matkul` int(11) NOT NULL,
  `id_kuesioner` int(11) DEFAULT NULL,
  `id_template` int(11) NOT NULL,
  `id_kompetensi` int(11) DEFAULT NULL,
  `id_butir` int(11) NOT NULL,
  `jawaban` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kuesioner_idx` (`id_kuesioner`),
  KEY `id_template_idx` (`id_template`),
  KEY `id_butir_idx` (`id_butir`),
  KEY `fjawaban_id_kontrak_matkul_idx` (`id_kontrak_matkul`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kontrak_matkul`
--

CREATE TABLE IF NOT EXISTS `kontrak_matkul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `npm` int(8) DEFAULT NULL,
  `id_matkul` int(11) DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `id_settings` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `isi_kuesioner` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_dosen_idx` (`id_dosen`),
  KEY `id_matkul_idx` (`id_matkul`),
  KEY `npm_idx` (`npm`),
  KEY `kontrak_matkul_id_settings_idx` (`id_settings`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `kontrak_matkul`
--

INSERT INTO `kontrak_matkul` (`id`, `npm`, `id_matkul`, `id_dosen`, `id_settings`, `status`, `isi_kuesioner`) VALUES
(20, 1412015, 1, 1, 1, 1, '0'),
(21, 1412015, 4, 1, 5, 1, '0'),
(22, 1412028, 1, 1, 1, 1, '0'),
(23, 1412028, 4, 1, 5, 1, '0'),
(24, 1412031, 1, 1, 1, 1, '0'),
(25, 1412031, 4, 1, 5, 1, '0'),
(26, 1412015, 5, 2, 6, 1, '0'),
(27, 1412028, 5, 2, 6, 1, '0'),
(28, 1412031, 5, 2, 6, 1, '0'),
(29, 1512018, 1, 1, 1, 1, '0'),
(30, 1512018, 3, 1, 5, 1, '0'),
(31, 1512018, 2, 2, 6, 1, '0'),
(32, 1512020, 1, 1, 1, 1, '0'),
(33, 1512020, 3, 1, 5, 1, '0'),
(34, 1512020, 2, 2, 6, 1, '0'),
(35, 1512027, 1, 1, 1, 1, '0'),
(36, 1512027, 3, 1, 5, 1, '0'),
(37, 1512027, 2, 2, 6, 1, '0'),
(38, 1512028, 1, 1, 1, 1, '0'),
(39, 1512028, 3, 1, 5, 1, '0'),
(40, 1512028, 2, 2, 6, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahap_belajar` int(1) DEFAULT NULL,
  `semester` varchar(20) DEFAULT NULL,
  `thn_akademik` varchar(20) DEFAULT NULL,
  `aktif` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `tahap_belajar`, `semester`, `thn_akademik`, `aktif`) VALUES
(1, 1, 'Genap', '2015/2016', 0),
(5, 2, 'Genap', '2015/2016', 0),
(6, 3, 'Genap', '2015/2016', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_saran`
--

CREATE TABLE IF NOT EXISTS `tbl_saran` (
  `id_saran` int(11) NOT NULL AUTO_INCREMENT,
  `id_kontrak_matkul` int(11) NOT NULL,
  `id_settings` int(11) NOT NULL,
  `saran` text,
  PRIMARY KEY (`id_saran`),
  KEY `tbl_saran_id_kontrak_matkul_idx` (`id_kontrak_matkul`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbutir`
--

CREATE TABLE IF NOT EXISTS `tbutir` (
  `id_butir` int(11) NOT NULL AUTO_INCREMENT,
  `butir` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `id_kompetensi` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_butir`),
  KEY `ix_tbutir_id_butir` (`id_butir`),
  KEY `tbutir_id_kompetensi_idx` (`id_kompetensi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbutir_template`
--

CREATE TABLE IF NOT EXISTS `tbutir_template` (
  `id_butir_template` int(11) NOT NULL AUTO_INCREMENT,
  `id_template` int(11) DEFAULT NULL,
  `id_butir` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_butir_template`),
  KEY `id_template_idx` (`id_template`),
  KEY `id_butir_idx` (`id_butir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tkompetensi`
--

CREATE TABLE IF NOT EXISTS `tkompetensi` (
  `id_kompetensi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kompetensi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_kompetensi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `tkuesioner`
--

CREATE TABLE IF NOT EXISTS `tkuesioner` (
  `id_kuesioner` int(11) NOT NULL AUTO_INCREMENT,
  `id_template` int(11) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `id_settings` int(11) NOT NULL,
  PRIMARY KEY (`id_kuesioner`),
  KEY `ix_tkuesioner_id_kuesioner` (`id_kuesioner`),
  KEY `tkuesioner_id_template_idx` (`id_template`),
  KEY `tkuesioner_id_settings_idx` (`id_settings`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `tlogin`
--

CREATE TABLE IF NOT EXISTS `tlogin` (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `real_id` int(11) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `level` int(1) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `foto` text NOT NULL,
  `can_save` int(1) NOT NULL,
  `can_edit` int(1) NOT NULL,
  `can_delete` int(1) NOT NULL,
  `last_login` datetime NOT NULL,
  `counter_fail` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tlogin`
--

INSERT INTO `tlogin` (`id_login`, `real_id`, `username`, `password`, `level`, `nama_lengkap`, `email`, `foto`, `can_save`, `can_edit`, `can_delete`, `last_login`, `counter_fail`, `status`, `created`, `modified`) VALUES
(3, NULL, 'zakyyudha', 'cb54b22e2a32ca8284d24a751e69094f', 0, 'Zaky Yudha Prihakasa', 'zakyyudha@rocketmail.com', '24d47d494294d0c110207cfb4c2ba589.jpg', 1, 1, 1, '2015-10-12 23:41:35', 1, 1, '2015-09-09 21:54:18', '2015-10-12 16:41:35'),
(4, NULL, 'oky', 'c4771c088a4c9f0ef9560dadf0cbc500', 1, 'Oky Octaviansyah', 'oky.octaviansyah@yahoo.com', '97b3edc77c5bf2a615ef9e07df1d720e.jpg', 1, 1, 1, '2015-10-08 14:39:53', 2, 1, '2015-09-09 21:57:43', '2015-10-08 07:39:53'),
(5, 1412031, '1412031', '62b07358ea4c6e51dee5c4377ef5323d', 2, 'Indiary Almira', 'indiaryalmira@gmail.com', '5a560b73fb5faf137fd36c124f8dc01d.jpg', 1, 1, 1, '2015-10-06 23:12:51', 1, 1, '2015-09-10 06:25:16', '2015-10-06 16:12:51'),
(6, 1, 'hardi', 'dddb1b27f1a7d7601a6a0f7e2ca92926', 3, 'Hardi Jamhur', 'hardijamhur@gmail.com', '7049c3a029047836233f6673b86dbc8e.jpg', 1, 1, 1, '2015-10-09 14:57:21', 0, 1, '2015-09-12 03:19:19', '2015-10-09 07:57:21'),
(7, 1512020, '1512020', '6acc63c80283cd5e4f29ef1cefad41b8', 2, 'Zaky Yudha Prihakasa', 'zakyyudha@rocketmail.com', '80b8efde6b69c2fbaf3a0e4eb7ccf88c.jpg', 1, 1, 1, '2015-10-12 23:38:25', 3, 1, '2015-09-13 03:31:04', '2015-10-12 16:38:25'),
(8, 1512018, '1512018', '5bf0b8c7da2857150c2be73fcc07bac0', 2, 'Yanuar Nurcahyani', 'yanuar666999@gmail.com', '948f29844bf4922015da30925e4c82d4.jpg', 1, 1, 1, '2015-10-06 23:13:09', 2, 1, '2015-09-13 03:31:04', '2015-10-06 16:13:09'),
(9, 2, 'dahlia', '6c063d4af7417bb33f5c5ba1b4040da0', 3, 'Dahlia Widhyaestoeti', 'dahlia@stikombinaniaga.ac.id', 'cfe3e0efbb0a2c76865bf93d1ca15772.jpg', 1, 1, 1, '2015-10-12 23:40:12', 1, 1, '2015-09-13 09:42:28', '2015-10-12 16:40:12'),
(10, NULL, 'irma', '76af47488ac4ecce7c29005f15cf7d0e', 4, 'Irmayansyah', 'irma@stikombinaniaga.ac.id', 'f709787d9196d084003c77cc6ede49e7.jpg', 1, 1, 1, '2015-10-09 15:03:26', 0, 1, '2015-09-30 05:45:18', '2015-10-09 08:03:26'),
(11, 1512027, '1512027', 'e139410d1cb2383d857eeaf8627d010f', 2, 'Ogiano Waskitajaya', 'ogiwaskita@gmail.com', 'NULL', 1, 1, 1, '2015-10-11 16:21:15', 0, 1, '2015-10-11 09:21:15', '2015-10-11 09:22:00'),
(12, 1512028, '1512028', '7e4b767c551f8715a3e96f3802deeb34', 2, 'Oky Octaviansyah', 'okyocta@gmail.com', 'null', 1, 1, 1, '2015-10-11 16:21:15', 0, 1, '2015-10-11 09:21:15', '2015-10-11 09:22:43'),
(13, 1412028, '1412028', '4e55deddea55e04f5c2ce6c45859c43e', 2, 'Rizka Nurmala', 'rizkanurmala@gmail.com', 'NULL', 1, 1, 1, '2015-10-11 16:21:15', 0, 1, '2015-10-11 09:21:15', '2015-10-11 09:22:53'),
(14, 1412015, '1412015', '8d66eb2150dccfbd02705e87182a15a8', 2, 'Laviva MSFJ', 'lavivamsfj@gmail.com', 'NULL', 1, 1, 1, '2015-10-11 16:21:15', 0, 1, '2015-10-11 09:21:15', '2015-10-11 09:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `ttemplate`
--

CREATE TABLE IF NOT EXISTS `ttemplate` (
  `id_template` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_template`),
  KEY `ix_ttemplate_id_template` (`id_template`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fjawaban`
--
ALTER TABLE `fjawaban`
  ADD CONSTRAINT `fjawaban_id_butir` FOREIGN KEY (`id_butir`) REFERENCES `tbutir` (`id_butir`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fjawaban_id_kontrak_matkul` FOREIGN KEY (`id_kontrak_matkul`) REFERENCES `kontrak_matkul` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fjawaban_id_kuesioner` FOREIGN KEY (`id_kuesioner`) REFERENCES `tkuesioner` (`id_kuesioner`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fjawaban_id_template` FOREIGN KEY (`id_template`) REFERENCES `ttemplate` (`id_template`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kontrak_matkul`
--
ALTER TABLE `kontrak_matkul`
  ADD CONSTRAINT `kontrak_matkul_id_dosen` FOREIGN KEY (`id_dosen`) REFERENCES `ddosen` (`id_dosen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `kontrak_matkul_id_matkul` FOREIGN KEY (`id_matkul`) REFERENCES `dmatkul` (`id_matkul`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `kontrak_matkul_id_settings` FOREIGN KEY (`id_settings`) REFERENCES `settings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `kontrak_matkul_npm` FOREIGN KEY (`npm`) REFERENCES `dmahasiswa` (`npm`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_saran`
--
ALTER TABLE `tbl_saran`
  ADD CONSTRAINT `tbl_saran_id_kontrak_matkul` FOREIGN KEY (`id_kontrak_matkul`) REFERENCES `kontrak_matkul` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbutir`
--
ALTER TABLE `tbutir`
  ADD CONSTRAINT `tbutir_id_kompetensi` FOREIGN KEY (`id_kompetensi`) REFERENCES `tkompetensi` (`id_kompetensi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbutir_template`
--
ALTER TABLE `tbutir_template`
  ADD CONSTRAINT `tbutir_template_id_butir` FOREIGN KEY (`id_butir`) REFERENCES `tbutir` (`id_butir`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbutir_template_id_template` FOREIGN KEY (`id_template`) REFERENCES `ttemplate` (`id_template`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tkuesioner`
--
ALTER TABLE `tkuesioner`
  ADD CONSTRAINT `tkuesioner_id_settings` FOREIGN KEY (`id_settings`) REFERENCES `settings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tkuesioner_id_template` FOREIGN KEY (`id_template`) REFERENCES `ttemplate` (`id_template`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
