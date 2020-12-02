-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 02, 2020 at 04:43 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengajuan_bantuan`
--

-- --------------------------------------------------------

--
-- Table structure for table `bantuan`
--

DROP TABLE IF EXISTS `bantuan`;
CREATE TABLE IF NOT EXISTS `bantuan` (
  `id_bantuan` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori_bantuan` int(11) NOT NULL,
  `periode` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id_bantuan`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bantuan`
--

INSERT INTO `bantuan` (`id_bantuan`, `id_kategori_bantuan`, `periode`, `description`, `created_at`, `created_by`) VALUES
(3, 4, 1606176000, 'bantuan raskin', 1606156347, 3),
(2, 1, 1608681600, 'bantuan covid 19', 1606067140, 3),
(4, 1, 1606089600, 'covid', 1606156384, 3);

-- --------------------------------------------------------

--
-- Table structure for table `bukti_terima`
--

DROP TABLE IF EXISTS `bukti_terima`;
CREATE TABLE IF NOT EXISTS `bukti_terima` (
  `id_bukti_terima` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `source` varchar(100) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id_bukti_terima`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bukti_terima`
--

INSERT INTO `bukti_terima` (`id_bukti_terima`, `name`, `source`, `created_at`, `created_by`) VALUES
(2, 'gunawan3.jpeg', 'assets/bukti_terima', 1606762186, 3);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_bantuan`
--

DROP TABLE IF EXISTS `kategori_bantuan`;
CREATE TABLE IF NOT EXISTS `kategori_bantuan` (
  `id_kategori_bantuan` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id_kategori_bantuan`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_bantuan`
--

INSERT INTO `kategori_bantuan` (`id_kategori_bantuan`, `name`, `description`, `created_at`, `created_by`) VALUES
(1, 'COVID-19', 'bantuan masa pandemi covid-19', 1605808074, 3),
(4, 'Raskin', 'bantuan raskin', 1606144832, 3);

-- --------------------------------------------------------

--
-- Table structure for table `keluarga`
--

DROP TABLE IF EXISTS `keluarga`;
CREATE TABLE IF NOT EXISTS `keluarga` (
  `id_keluarga` int(11) NOT NULL AUTO_INCREMENT,
  `rules_id` int(11) NOT NULL,
  `no_kk` char(16) NOT NULL,
  `id_pekerjaan` int(11) NOT NULL,
  `kepala_keluarga` varchar(100) NOT NULL,
  `jumlah_keluarga` int(11) NOT NULL,
  `jumlah_anak` int(11) NOT NULL,
  `rt` varchar(11) NOT NULL,
  `rw` varchar(11) NOT NULL,
  `alamat` text NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `pass` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id_keluarga`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keluarga`
--

INSERT INTO `keluarga` (`id_keluarga`, `rules_id`, `no_kk`, `id_pekerjaan`, `kepala_keluarga`, `jumlah_keluarga`, `jumlah_anak`, `rt`, `rw`, `alamat`, `lat`, `lng`, `pass`, `created_at`, `created_by`) VALUES
(3, 1, '8973874652928276', 1, 'tejo', 4, 2, '003', '004', 'jl.tentara pelajar desa kutorejo', 0, 0, '202cb962ac59075b964b07152d234b70', 1605550314, 3),
(24, 2, '0987876545678987', 35, 'kanto', 5, 3, '001', '003', 'jl.jendral', 0, 0, '202cb962ac59075b964b07152d234b70', 1605638101, 3),
(23, 2, '0987654323456789', 41, 'gunawan', 5, 3, '001', '004', 'jl.tentara pelajar', -6.972830797936966, 109.6213398581665, '202cb962ac59075b964b07152d234b70', 1606854665, 3),
(25, 2, '4393837363546478', 41, 'suwarno', 5, 3, '003', '002', 'pegaden tengah, rt 003 rw 002', -6.973629474627812, 109.62455850898436, '202cb962ac59075b964b07152d234b70', 1606853314, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

DROP TABLE IF EXISTS `pekerjaan`;
CREATE TABLE IF NOT EXISTS `pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id_pekerjaan`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id_pekerjaan`, `name`, `description`, `created_at`, `created_by`) VALUES
(41, 'buruh', 'buruh', 1605640138, 3);

-- --------------------------------------------------------

--
-- Table structure for table `penerima_bantuan`
--

DROP TABLE IF EXISTS `penerima_bantuan`;
CREATE TABLE IF NOT EXISTS `penerima_bantuan` (
  `id_penerima` int(11) NOT NULL AUTO_INCREMENT,
  `id_bantuan` int(11) NOT NULL,
  `id_keluarga` int(11) NOT NULL,
  `status_terima` int(11) NOT NULL,
  `id_bukti_terima` int(11) NOT NULL,
  `tgl_terima` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id_penerima`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerima_bantuan`
--

INSERT INTO `penerima_bantuan` (`id_penerima`, `id_bantuan`, `id_keluarga`, `status_terima`, `id_bukti_terima`, `tgl_terima`, `created_at`, `created_by`) VALUES
(2, 3, 23, 1, 2, 1606780800, 1606762186, 3);

-- --------------------------------------------------------

--
-- Table structure for table `rules_users`
--

DROP TABLE IF EXISTS `rules_users`;
CREATE TABLE IF NOT EXISTS `rules_users` (
  `id_rules` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id_rules`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rules_users`
--

INSERT INTO `rules_users` (`id_rules`, `name`, `description`, `created_at`, `created_by`) VALUES
(1, 'panitia', 'sebagai pengatur data bantuan', 1604597002, 1),
(2, 'penduduk', 'sebagai penduduk desa', 1604597002, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
