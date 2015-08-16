-- phpMyAdmin SQL Dump
-- version 4.4.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 16 Agu 2015 pada 18.20
-- Versi Server: 5.6.23-log
-- PHP Version: 5.6.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kuisoner_online`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ddosen`
--

CREATE TABLE IF NOT EXISTS `ddosen` (
  `id_dosen` int(11) NOT NULL,
  `id_matkul` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dmahasiswa`
--

CREATE TABLE IF NOT EXISTS `dmahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `NPM` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `semester` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dmatkul`
--

CREATE TABLE IF NOT EXISTS `dmatkul` (
  `id_matkul` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fjawaban`
--

CREATE TABLE IF NOT EXISTS `fjawaban` (
  `id_butir` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `jawaban` int(11) NOT NULL,
  `id_header` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rbutirpaket`
--

CREATE TABLE IF NOT EXISTS `rbutirpaket` (
  `id_paket` int(11) NOT NULL,
  `id_butir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rdatepublish`
--

CREATE TABLE IF NOT EXISTS `rdatepublish` (
  `id_datepublish` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbutir`
--

CREATE TABLE IF NOT EXISTS `tbutir` (
  `id_butir` int(11) NOT NULL,
  `butir` text NOT NULL,
  `status` int(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `theader`
--

CREATE TABLE IF NOT EXISTS `theader` (
  `id_header` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tlogin`
--

CREATE TABLE IF NOT EXISTS `tlogin` (
  `id_login` int(11) NOT NULL,
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
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpaket`
--

CREATE TABLE IF NOT EXISTS `tpaket` (
  `id_paket` int(11) NOT NULL,
  `paket` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ddosen`
--
ALTER TABLE `ddosen`
  ADD PRIMARY KEY (`id_dosen`),
  ADD KEY `id_matkul` (`id_matkul`);

--
-- Indexes for table `dmahasiswa`
--
ALTER TABLE `dmahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indexes for table `dmatkul`
--
ALTER TABLE `dmatkul`
  ADD PRIMARY KEY (`id_matkul`);

--
-- Indexes for table `fjawaban`
--
ALTER TABLE `fjawaban`
  ADD KEY `id_butir` (`id_butir`),
  ADD KEY `id_header` (`id_header`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `rbutirpaket`
--
ALTER TABLE `rbutirpaket`
  ADD KEY `id_butir` (`id_butir`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `rdatepublish`
--
ALTER TABLE `rdatepublish`
  ADD PRIMARY KEY (`id_datepublish`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `tbutir`
--
ALTER TABLE `tbutir`
  ADD PRIMARY KEY (`id_butir`);

--
-- Indexes for table `theader`
--
ALTER TABLE `theader`
  ADD PRIMARY KEY (`id_header`),
  ADD KEY `id_dosen` (`id_dosen`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indexes for table `tlogin`
--
ALTER TABLE `tlogin`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `tpaket`
--
ALTER TABLE `tpaket`
  ADD PRIMARY KEY (`id_paket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ddosen`
--
ALTER TABLE `ddosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dmahasiswa`
--
ALTER TABLE `dmahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dmatkul`
--
ALTER TABLE `dmatkul`
  MODIFY `id_matkul` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rdatepublish`
--
ALTER TABLE `rdatepublish`
  MODIFY `id_datepublish` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbutir`
--
ALTER TABLE `tbutir`
  MODIFY `id_butir` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `theader`
--
ALTER TABLE `theader`
  MODIFY `id_header` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tlogin`
--
ALTER TABLE `tlogin`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tpaket`
--
ALTER TABLE `tpaket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dmatkul`
--
ALTER TABLE `dmatkul`
  ADD CONSTRAINT `dmatkul_ibfk_1` FOREIGN KEY (`id_matkul`) REFERENCES `ddosen` (`id_matkul`);

--
-- Ketidakleluasaan untuk tabel `fjawaban`
--
ALTER TABLE `fjawaban`
  ADD CONSTRAINT `fjawaban_ibfk_2` FOREIGN KEY (`id_paket`) REFERENCES `tpaket` (`id_paket`);

--
-- Ketidakleluasaan untuk tabel `rbutirpaket`
--
ALTER TABLE `rbutirpaket`
  ADD CONSTRAINT `rbutirpaket_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `tpaket` (`id_paket`);

--
-- Ketidakleluasaan untuk tabel `tbutir`
--
ALTER TABLE `tbutir`
  ADD CONSTRAINT `tbutir_ibfk_1` FOREIGN KEY (`id_butir`) REFERENCES `rbutirpaket` (`id_butir`),
  ADD CONSTRAINT `tbutir_ibfk_2` FOREIGN KEY (`id_butir`) REFERENCES `fjawaban` (`id_butir`);

--
-- Ketidakleluasaan untuk tabel `theader`
--
ALTER TABLE `theader`
  ADD CONSTRAINT `theader_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `ddosen` (`id_dosen`),
  ADD CONSTRAINT `theader_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `dmahasiswa` (`id_mahasiswa`),
  ADD CONSTRAINT `theader_ibfk_3` FOREIGN KEY (`id_header`) REFERENCES `fjawaban` (`id_header`);

--
-- Ketidakleluasaan untuk tabel `tpaket`
--
ALTER TABLE `tpaket`
  ADD CONSTRAINT `tpaket_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `rdatepublish` (`id_paket`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
