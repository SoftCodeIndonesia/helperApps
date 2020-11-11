-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 09, 2020 at 02:58 AM
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
  `waktu_bantuan` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id_bantuan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `rt` int(11) NOT NULL,
  `rw` int(11) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id_keluarga`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keluarga`
--

INSERT INTO `keluarga` (`id_keluarga`, `rules_id`, `no_kk`, `id_pekerjaan`, `kepala_keluarga`, `jumlah_keluarga`, `jumlah_anak`, `rt`, `rw`, `alamat`, `password`, `created_at`, `created_by`) VALUES
(1, 1, '3326080802990021', 1, 'Bejo', 3, 1, 1, 2, 'jl.jendral sudirman, pegaden tengah', '202cb962ac59075b964b07152d234b70', 1604597002, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id_pekerjaan`, `name`, `description`, `created_at`, `created_by`) VALUES
(1, 'pengangguran', 'sudah dipecat', 1604597002, 1);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
