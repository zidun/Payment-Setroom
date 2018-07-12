-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2018 at 09:35 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `11505071_zidun`
--

-- --------------------------------------------------------

--
-- Table structure for table `agen`
--

CREATE TABLE IF NOT EXISTS `agen` (
  `id_agen` varchar(12) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `saldo` double NOT NULL,
  `biaya_admin` double NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `akses` varchar(20) NOT NULL,
  PRIMARY KEY (`id_agen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agen`
--

INSERT INTO `agen` (`id_agen`, `nama`, `alamat`, `no_telepon`, `saldo`, `biaya_admin`, `username`, `password`, `akses`) VALUES
('A20180125001', 'Zidun', 'Sukabirus', '085817725512', 0, 2000, 'agen', 'agen123', 'agen'),
('A20180129001', 'Muhammad Ramdan', 'Bogor', '083811941421', 0, 5000, 'zidun', 'zidun123', 'agen');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id_pelanggan` varchar(14) NOT NULL,
  `no_meter` varchar(12) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `tenggang` varchar(2) NOT NULL,
  `id_tarif` int(11) NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `no_meter`, `nama`, `alamat`, `tenggang`, `id_tarif`) VALUES
('20180126081200', '025180150800', 'Muhammad Ramdan', 'Ciaiw', '26', 4),
('20180126081257', '025180150857', 'Zidun', 'Bogor', '26', 3),
('20180126081804', '025180150804', 'Syamsul Hidayatullah', 'Bandung', '26', 5),
('20180126165945', '025180151645', 'Muhammad romi', 'Sukabirus', '26', 8),
('20180128141026', '027180171426', 'Fajar Firdaus', 'Tajur', '28', 5),
('20180128141049', '027180171449', 'Muhamad Segafi Kurniawan', 'Cibogo', '28', 4),
('20180128141130', '027180171430', 'Muhammad Junaedi', 'Pasir Muncang', '28', 8),
('20180128141244', '027180171444', 'Muhammad Nur Alfi', 'Tajur', '28', 4),
('20180128141336', '027180171436', 'Ramadhan Yoga Pratam', 'Cengkareng, Jakarta', '28', 4),
('20180128141409', '027180171409', 'Rizaldy Sukma Perkasa', 'Ciawi', '28', 4),
('20180129132711', '028180111311', 'Muhammad ', 'Ciawi', '29', 10),
('20180129135850', '028180111350', 'Alwi Gunawan', 'Cireketeg', '29', 4),
('20180130165747', '029180121647', 'Muhammmad zidun', 'Ciawi', '30', 4),
('20180131085951', '030180130851', 'Zainul Fahri', 'Ciawi', '31', 3),
('20180201092427', '031180240927', 'Ari Aliansyah', 'gadog', '01', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id_pembayaran` varchar(15) NOT NULL,
  `id_pelanggan` varchar(14) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `waktu_bayar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bulan_bayar` varchar(2) NOT NULL,
  `tahun_bayar` year(4) NOT NULL,
  `jumlah_bayar` double NOT NULL,
  `biaya_admin` double NOT NULL,
  `total_akhir` double NOT NULL,
  `bayar` double NOT NULL,
  `kembali` double NOT NULL,
  `id_agen` varchar(12) NOT NULL,
  PRIMARY KEY (`id_pembayaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pelanggan`, `tgl_bayar`, `waktu_bayar`, `bulan_bayar`, `tahun_bayar`, `jumlah_bayar`, `biaya_admin`, `total_akhir`, `bayar`, `kembali`, `id_agen`) VALUES
('BYR201801260001', '20180126081200', '2018-01-26', '2018-01-26 08:07:41', '02', 2018, 15000, 2000, 17000, 20000, 3000, 'A20180125001'),
('BYR201801260002', '20180126081804', '2018-01-26', '2018-01-26 09:22:34', '02', 2018, 75000, 2000, 77000, 80000, 3000, 'A20180125001'),
('BYR201801260003', '20180126165945', '2018-01-26', '2018-01-26 10:04:01', '02', 2018, 150000, 2000, 152000, 160000, 8000, 'A20180125001'),
('BYR201801280001', '20180126081200', '2018-01-28', '2018-01-28 10:17:20', '03', 2018, 135000, 2000, 137000, 140000, 3000, 'A20180125001'),
('BYR201801280002', '20180126081200', '2018-01-28', '2018-01-28 10:18:52', '04', 2018, 1350000, 2000, 1352000, 1400000, 48000, 'A20180125001'),
('BYR201801290001', '20180129132711', '2018-01-29', '2018-01-29 06:29:58', '02', 2018, 140000, 2000, 142000, 150000, 8000, 'A20180125001'),
('BYR201801290002', '20180128141130', '2018-01-29', '2018-01-29 06:41:50', '02', 2018, 1500000, 2000, 1502000, 1510000, 8000, 'A20180125001'),
('BYR201801300001', '20180130165747', '2018-01-30', '2018-01-30 10:01:59', '02', 2018, 150000, 2000, 152000, 160000, 8000, 'A20180125001'),
('BYR201802010001', '20180128141026', '2018-02-01', '2018-02-01 01:33:50', '02', 2018, 75000, 2000, 77000, 80000, 3000, 'A20180125001'),
('BYR201802010002', '20180128141026', '2018-02-01', '2018-02-01 02:22:32', '03', 2018, 37500, 2000, 39500, 40000, 500, 'A20180125001');

-- --------------------------------------------------------

--
-- Table structure for table `penggunaan`
--

CREATE TABLE IF NOT EXISTS `penggunaan` (
  `id_penggunaan` varchar(20) NOT NULL,
  `id_pelanggan` varchar(14) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `meter_awal` int(11) NOT NULL,
  `meter_akhir` int(11) NOT NULL,
  `tgl_cek` date NOT NULL,
  `id_petugas` varchar(12) NOT NULL,
  PRIMARY KEY (`id_penggunaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penggunaan`
--

INSERT INTO `penggunaan` (`id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `meter_awal`, `meter_akhir`, `tgl_cek`, `id_petugas`) VALUES
('20180126081200022018', '20180126081200', '02', 2018, 0, 10, '2018-02-23', 'P20180125001'),
('20180126081200032018', '20180126081200', '03', 2018, 10, 100, '2018-02-26', 'P20180125001'),
('20180126081200042018', '20180126081200', '04', 2018, 100, 1000, '2018-04-26', 'P20180125001'),
('20180126081200052018', '20180126081200', '05', 2018, 1000, 0, '0000-00-00', ''),
('20180126081257022018', '20180126081257', '02', 2018, 0, 80, '2018-02-26', 'P20180125001'),
('20180126081257032018', '20180126081257', '03', 2018, 80, 0, '0000-00-00', ''),
('20180126081804022018', '20180126081804', '02', 2018, 0, 100, '2018-02-26', 'P20180125001'),
('20180126081804032018', '20180126081804', '03', 2018, 100, 0, '0000-00-00', ''),
('20180126165945022018', '20180126165945', '02', 2018, 0, 100, '2018-02-26', 'P20180125001'),
('20180126165945032018', '20180126165945', '03', 2018, 100, 0, '0000-00-00', ''),
('20180128141026022018', '20180128141026', '02', 2018, 0, 100, '2018-02-01', 'P20180125001'),
('20180128141026032018', '20180128141026', '03', 2018, 100, 150, '2018-03-01', 'P20180125001'),
('20180128141026042018', '20180128141026', '04', 2018, 150, 200, '2018-04-23', 'P20180125001'),
('20180128141026052018', '20180128141026', '05', 2018, 200, 0, '0000-00-00', ''),
('20180128141049022018', '20180128141049', '02', 2018, 0, 0, '0000-00-00', ''),
('20180128141130022018', '20180128141130', '02', 2018, 0, 1000, '2018-02-26', 'P20180125001'),
('20180128141130032018', '20180128141130', '03', 2018, 1000, 2000, '2018-01-01', 'P20180125001'),
('20180128141130042018', '20180128141130', '04', 2018, 2000, 0, '0000-00-00', ''),
('20180128141244022018', '20180128141244', '02', 2018, 0, 0, '0000-00-00', ''),
('20180128141336022018', '20180128141336', '02', 2018, 0, 0, '0000-00-00', ''),
('20180128141409022018', '20180128141409', '02', 2018, 0, 0, '0000-00-00', ''),
('20180129132711022018', '20180129132711', '02', 2018, 0, 100, '2018-01-29', 'P20180125001'),
('20180129132711032018', '20180129132711', '03', 2018, 100, 0, '0000-00-00', ''),
('20180129135850022018', '20180129135850', '02', 2018, 0, 50, '2018-02-25', 'P20180125001'),
('20180129135850032018', '20180129135850', '03', 2018, 50, 70, '2018-03-25', 'P20180125001'),
('20180129135850042018', '20180129135850', '04', 2018, 70, 0, '0000-00-00', ''),
('20180130165747022018', '20180130165747', '02', 2018, 0, 100, '2018-02-21', 'P20180125001'),
('20180130165747032018', '20180130165747', '03', 2018, 100, 0, '0000-00-00', ''),
('20180131085951022018', '20180131085951', '02', 2018, 0, 100, '2018-02-21', 'P20180125001'),
('20180131085951032018', '20180131085951', '03', 2018, 100, 120, '2018-03-21', 'P20180125001'),
('20180131085951042018', '20180131085951', '04', 2018, 120, 200, '2018-04-25', 'P20180125001'),
('20180131085951052018', '20180131085951', '05', 2018, 200, 0, '0000-00-00', ''),
('20180201075546022018', '20180201075546', '02', 2018, 0, 0, '0000-00-00', ''),
('20180201092427022018', '20180201092427', '02', 2018, 0, 100, '2018-02-21', 'P20180125001'),
('20180201092427032018', '20180201092427', '03', 2018, 100, 0, '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE IF NOT EXISTS `petugas` (
  `id_petugas` varchar(12) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `akses` varchar(20) NOT NULL,
  PRIMARY KEY (`id_petugas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama`, `alamat`, `no_telepon`, `jk`, `username`, `password`, `akses`) VALUES
('P20180125001', 'Muhammad Ramdan', 'Sukabirus', '083811941421', 'L', 'petugas', 'petugas123', 'petugas'),
('P20180129001', 'Muhammad Ramdan', '12', '12', 'L', 'ramdan', 'aku123', 'petugas');

-- --------------------------------------------------------

--
-- Stand-in structure for view `qw_pembayaran`
--
CREATE TABLE IF NOT EXISTS `qw_pembayaran` (
`id_pembayaran` varchar(15)
,`id_pelanggan` varchar(14)
,`tgl_bayar` date
,`waktu_bayar` timestamp
,`bulan_bayar` varchar(2)
,`tahun_bayar` year(4)
,`jumlah_bayar` double
,`biaya_admin` double
,`total_akhir` double
,`bayar` double
,`kembali` double
,`id_agen` varchar(12)
,`nama_pelanggan` varchar(50)
,`nama_agen` varchar(50)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `qw_penggunaan`
--
CREATE TABLE IF NOT EXISTS `qw_penggunaan` (
`id_penggunaan` varchar(20)
,`id_pelanggan` varchar(14)
,`bulan` varchar(2)
,`tahun` year(4)
,`meter_awal` int(11)
,`meter_akhir` int(11)
,`tgl_cek` date
,`id_petugas` varchar(12)
,`nama_pelanggan` varchar(50)
,`nama_petugas` varchar(50)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `qw_tagihan`
--
CREATE TABLE IF NOT EXISTS `qw_tagihan` (
`id_tagihan` int(11)
,`id_pelanggan` varchar(14)
,`bulan` varchar(2)
,`tahun` year(4)
,`jumlah_meter` int(11)
,`tarif_perkwh` double
,`jumlah_bayar` double
,`status` varchar(15)
,`id_petugas` varchar(12)
,`nama_pelanggan` varchar(50)
,`id_tarif` int(11)
,`nama_petugas` varchar(50)
);
-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE IF NOT EXISTS `tagihan` (
  `id_tagihan` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` varchar(14) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `jumlah_meter` int(11) NOT NULL,
  `tarif_perkwh` double NOT NULL,
  `jumlah_bayar` double NOT NULL,
  `status` varchar(15) NOT NULL,
  `id_petugas` varchar(12) NOT NULL,
  PRIMARY KEY (`id_tagihan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`id_tagihan`, `id_pelanggan`, `bulan`, `tahun`, `jumlah_meter`, `tarif_perkwh`, `jumlah_bayar`, `status`, `id_petugas`) VALUES
(5, '20180126081200', '02', 2018, 10, 1500, 15000, 'Terbayar', 'P20180125001'),
(6, '20180126081200', '03', 2018, 90, 1500, 135000, 'Terbayar', 'P20180125001'),
(7, '20180126081804', '02', 2018, 100, 750, 75000, 'Terbayar', 'P20180125001'),
(8, '20180126165945', '02', 2018, 100, 1500, 150000, 'Terbayar', 'P20180125001'),
(9, '20180126081257', '02', 2018, 80, 1000, 80000, 'Belum Bayar', 'P20180125001'),
(10, '20180126081200', '04', 2018, 900, 1500, 1350000, 'Terbayar', 'P20180125001'),
(11, '20180129132711', '02', 2018, 100, 1400, 140000, 'Terbayar', 'P20180125001'),
(12, '20180128141130', '02', 2018, 1000, 1500, 1500000, 'Terbayar', 'P20180125001'),
(13, '20180128141130', '03', 2018, 1000, 1500, 1500000, 'Belum Bayar', 'P20180125001'),
(14, '20180129135850', '02', 2018, 50, 1500, 75000, 'Belum Bayar', 'P20180125001'),
(15, '20180129135850', '03', 2018, 20, 1500, 30000, 'Belum Bayar', 'P20180125001'),
(16, '20180128141026', '02', 2018, 100, 750, 75000, 'Terbayar', 'P20180125001'),
(17, '20180128141026', '03', 2018, 50, 750, 37500, 'Terbayar', 'P20180125001'),
(18, '20180128141026', '04', 2018, 50, 750, 37500, 'Belum Bayar', 'P20180125001'),
(19, '20180130165747', '02', 2018, 100, 1500, 150000, 'Terbayar', 'P20180125001'),
(20, '20180131085951', '02', 2018, 100, 1000, 100000, 'Belum Bayar', 'P20180125001'),
(21, '20180131085951', '03', 2018, 20, 1000, 20000, 'Belum Bayar', 'P20180125001'),
(22, '20180131085951', '04', 2018, 80, 1000, 80000, 'Belum Bayar', 'P20180125001'),
(24, '20180201092427', '02', 2018, 100, 1000, 100000, 'Belum Bayar', 'P20180125001');

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE IF NOT EXISTS `tarif` (
  `id_tarif` int(11) NOT NULL AUTO_INCREMENT,
  `kode_tarif` varchar(20) NOT NULL,
  `golongan` varchar(10) NOT NULL,
  `daya` varchar(10) NOT NULL,
  `tarif_perkwh` double NOT NULL,
  PRIMARY KEY (`id_tarif`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`id_tarif`, `kode_tarif`, `golongan`, `daya`, `tarif_perkwh`) VALUES
(3, 'R3/450VA', 'R3', '450VA', 1000),
(4, 'R1/900VA', 'R1', '900VA', 1500),
(5, 'R2/450VA', 'R2', '450VA', 750),
(8, 'R2/900VA', 'R2', '900VA', 1500),
(9, 'B1/1500VA', 'B1', '1500VA', 2000),
(10, 'R3/900VA', 'R3', '900VA', 1400),
(13, 'R1/450VA', 'R1', '450VA', 1000),
(16, 'R3/1300VA', 'R3', '1300VA', 1500);

-- --------------------------------------------------------

--
-- Structure for view `qw_pembayaran`
--
DROP TABLE IF EXISTS `qw_pembayaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `qw_pembayaran` AS select `pembayaran`.`id_pembayaran` AS `id_pembayaran`,`pembayaran`.`id_pelanggan` AS `id_pelanggan`,`pembayaran`.`tgl_bayar` AS `tgl_bayar`,`pembayaran`.`waktu_bayar` AS `waktu_bayar`,`pembayaran`.`bulan_bayar` AS `bulan_bayar`,`pembayaran`.`tahun_bayar` AS `tahun_bayar`,`pembayaran`.`jumlah_bayar` AS `jumlah_bayar`,`pembayaran`.`biaya_admin` AS `biaya_admin`,`pembayaran`.`total_akhir` AS `total_akhir`,`pembayaran`.`bayar` AS `bayar`,`pembayaran`.`kembali` AS `kembali`,`pembayaran`.`id_agen` AS `id_agen`,`pelanggan`.`nama` AS `nama_pelanggan`,`agen`.`nama` AS `nama_agen` from ((`pembayaran` join `pelanggan` on((`pelanggan`.`id_pelanggan` = `pembayaran`.`id_pelanggan`))) join `agen` on((`agen`.`id_agen` = `pembayaran`.`id_agen`)));

-- --------------------------------------------------------

--
-- Structure for view `qw_penggunaan`
--
DROP TABLE IF EXISTS `qw_penggunaan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `qw_penggunaan` AS select `penggunaan`.`id_penggunaan` AS `id_penggunaan`,`penggunaan`.`id_pelanggan` AS `id_pelanggan`,`penggunaan`.`bulan` AS `bulan`,`penggunaan`.`tahun` AS `tahun`,`penggunaan`.`meter_awal` AS `meter_awal`,`penggunaan`.`meter_akhir` AS `meter_akhir`,`penggunaan`.`tgl_cek` AS `tgl_cek`,`penggunaan`.`id_petugas` AS `id_petugas`,`pelanggan`.`nama` AS `nama_pelanggan`,`petugas`.`nama` AS `nama_petugas` from ((`penggunaan` join `pelanggan` on((`penggunaan`.`id_pelanggan` = `pelanggan`.`id_pelanggan`))) join `petugas` on((`penggunaan`.`id_petugas` = `petugas`.`id_petugas`)));

-- --------------------------------------------------------

--
-- Structure for view `qw_tagihan`
--
DROP TABLE IF EXISTS `qw_tagihan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `qw_tagihan` AS select `tagihan`.`id_tagihan` AS `id_tagihan`,`tagihan`.`id_pelanggan` AS `id_pelanggan`,`tagihan`.`bulan` AS `bulan`,`tagihan`.`tahun` AS `tahun`,`tagihan`.`jumlah_meter` AS `jumlah_meter`,`tagihan`.`tarif_perkwh` AS `tarif_perkwh`,`tagihan`.`jumlah_bayar` AS `jumlah_bayar`,`tagihan`.`status` AS `status`,`tagihan`.`id_petugas` AS `id_petugas`,`pelanggan`.`nama` AS `nama_pelanggan`,`pelanggan`.`id_tarif` AS `id_tarif`,`petugas`.`nama` AS `nama_petugas` from ((`tagihan` join `pelanggan` on((`pelanggan`.`id_pelanggan` = `tagihan`.`id_pelanggan`))) join `petugas` on((`petugas`.`id_petugas` = `tagihan`.`id_petugas`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
