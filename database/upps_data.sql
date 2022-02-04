-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 16, 2017 at 10:47 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `upps_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `airportshuttle_arrival`
--

DROP TABLE IF EXISTS `airportshuttle_arrival`;
CREATE TABLE IF NOT EXISTS `airportshuttle_arrival` (
  `ArrivalID` int(11) NOT NULL AUTO_INCREMENT,
  `AirportShuttleID` int(11) NOT NULL,
  `PemesananID` int(11) NOT NULL,
  `TanggalBerangkat` date NOT NULL,
  `BerangkatDari` varchar(100) NOT NULL,
  `Tujuan` varchar(100) NOT NULL,
  `Jam` time NOT NULL,
  `Kapasitas` int(11) NOT NULL,
  `Keterangan` varchar(100) NOT NULL,
  `Jenis` varchar(100) NOT NULL DEFAULT 'Arrival',
  `Stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ArrivalID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `airportshuttle_arrival`
--

INSERT INTO `airportshuttle_arrival` (`ArrivalID`, `AirportShuttleID`, `PemesananID`, `TanggalBerangkat`, `BerangkatDari`, `Tujuan`, `Jam`, `Kapasitas`, `Keterangan`, `Jenis`, `Stamp`) VALUES
(1, 1, 2, '2017-07-13', 'Soekarno Hatta', 'Hotel Darmawan Park', '06:00:00', 5, '', 'Arrival', '2017-07-10 08:03:43'),
(2, 2, 3, '2017-07-16', 'Soekarno Hatta', 'Aston Sentul', '07:00:00', 35, '', 'Arrival', '2017-07-10 08:15:41'),
(3, 3, 4, '2017-07-16', 'Soekarno Hatta', 'Aston Sentul', '07:00:00', 40, '', 'Arrival', '2017-07-10 08:29:23'),
(4, 4, 6, '2017-07-18', 'Soeta', 'Aston Sentul', '03:00:00', 28, '', 'Arrival', '2017-07-13 07:24:41'),
(5, 5, 16, '2017-07-23', 'soekarno hatta', 'aston sentul', '03:00:00', 3, '', 'Arrival', '2017-07-21 09:37:10'),
(6, 7, 19, '2017-08-16', 'Soekarno Hatta', 'BLI Sentul', '07:00:00', 15, '', 'Arrival', '2017-08-15 04:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `airportshuttle_departure`
--

DROP TABLE IF EXISTS `airportshuttle_departure`;
CREATE TABLE IF NOT EXISTS `airportshuttle_departure` (
  `DepartureID` int(11) NOT NULL AUTO_INCREMENT,
  `AirportShuttleID` int(11) NOT NULL,
  `PemesananID` int(11) NOT NULL,
  `TanggalBerangkat` date NOT NULL,
  `BerangkatDari` varchar(100) NOT NULL,
  `Tujuan` varchar(100) NOT NULL,
  `Jam` time NOT NULL,
  `Kapasitas` int(11) NOT NULL,
  `Keterangan` varchar(100) NOT NULL,
  `Jenis` varchar(100) NOT NULL DEFAULT 'Departure',
  `Stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`DepartureID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `airportshuttle_departure`
--

INSERT INTO `airportshuttle_departure` (`DepartureID`, `AirportShuttleID`, `PemesananID`, `TanggalBerangkat`, `BerangkatDari`, `Tujuan`, `Jam`, `Kapasitas`, `Keterangan`, `Jenis`, `Stamp`) VALUES
(1, 1, 2, '2017-07-26', 'Hotel Darmawan Park', 'Soekarno', '03:00:00', 5, '', 'Departure', '2017-07-10 08:03:43'),
(2, 2, 3, '2017-07-18', 'Hotel Aston', 'Soekarno', '03:00:00', 35, '', 'Departure', '2017-07-10 08:15:40'),
(3, 3, 4, '2017-07-18', 'Aston Sentul', 'Soekarno', '03:00:00', 40, '', 'Departure', '2017-07-10 08:29:23'),
(4, 4, 6, '2017-07-21', 'Aston Sentul', 'Soekarno', '07:00:00', 28, '', 'Departure', '2017-07-13 07:24:41'),
(5, 5, 16, '2017-07-27', 'aston sentul', 'soekarno hatta', '07:00:00', 3, '', 'Departure', '2017-07-21 09:37:10');

-- --------------------------------------------------------

--
-- Table structure for table `angkatan`
--

DROP TABLE IF EXISTS `angkatan`;
CREATE TABLE IF NOT EXISTS `angkatan` (
  `AngkatanID` int(11) NOT NULL AUTO_INCREMENT,
  `ProgramID` int(11) NOT NULL,
  `NamaAngkatan` varchar(100) NOT NULL,
  `ProgramMulai` date NOT NULL,
  `ProgramSelesai` date NOT NULL,
  PRIMARY KEY (`AngkatanID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=252 ;

--
-- Dumping data for table `angkatan`
--

INSERT INTO `angkatan` (`AngkatanID`, `ProgramID`, `NamaAngkatan`, `ProgramMulai`, `ProgramSelesai`) VALUES
(31, 7, 'ALL', '2017-01-01', '9999-12-31'),
(32, 8, '424', '2017-01-01', '9999-12-31'),
(33, 8, '425', '2017-01-01', '9999-12-31'),
(34, 50, 'All', '2017-01-01', '9999-12-31'),
(35, 48, 'All', '2017-01-01', '9999-12-31'),
(36, 41, 'All', '2017-01-01', '9999-12-31'),
(37, 14, 'All', '2017-01-01', '9999-12-31'),
(38, 20, 'All', '2017-01-01', '9999-12-31'),
(39, 8, '426', '2017-01-01', '9999-12-31'),
(40, 8, '427', '2017-01-01', '9999-12-31'),
(41, 8, '428', '2017-01-01', '9999-12-31'),
(42, 8, '429', '2017-01-01', '9999-12-31'),
(43, 8, '430', '2017-01-01', '9999-12-31'),
(44, 52, '422', '2017-01-01', '9999-12-31'),
(45, 52, '423', '2017-01-01', '9999-12-31'),
(46, 52, '424', '2017-01-01', '9999-12-31'),
(47, 52, '425', '2017-01-01', '9999-12-31'),
(48, 52, '426', '2017-01-01', '9999-12-31'),
(49, 52, '427', '2017-01-01', '9999-12-31'),
(50, 52, '428', '2017-01-01', '9999-12-31'),
(51, 52, '429', '2017-01-01', '9999-12-31'),
(52, 52, '430', '2017-01-01', '9999-12-31'),
(53, 55, '19', '2017-01-01', '9999-12-31'),
(54, 55, '20', '2017-01-01', '9999-12-31'),
(55, 55, '22', '2017-01-01', '9999-12-31'),
(56, 56, '21 OPS', '2017-01-01', '9999-12-31'),
(57, 56, '21 NON OPS', '2017-01-01', '9999-12-31'),
(58, 60, '349', '2017-01-01', '9999-12-31'),
(59, 60, '350', '2017-01-01', '9999-12-31'),
(60, 60, '351', '2017-01-01', '9999-12-31'),
(61, 60, '352', '2017-01-01', '9999-12-31'),
(62, 60, '353', '2017-01-01', '9999-12-31'),
(63, 60, '354', '2017-01-01', '9999-12-31'),
(64, 60, '355', '2017-01-01', '9999-12-31'),
(65, 60, '356', '2017-01-01', '9999-12-31'),
(66, 60, '357', '2017-01-01', '9999-12-31'),
(67, 60, '358', '2017-01-01', '9999-12-31'),
(68, 60, '359', '2017-01-01', '9999-12-31'),
(69, 60, '360', '2017-01-01', '9999-12-31'),
(70, 60, '361', '2017-01-01', '9999-12-31'),
(71, 60, '362', '2017-01-01', '9999-12-31'),
(72, 60, '363', '2017-01-01', '9999-12-31'),
(73, 60, '364', '2017-01-01', '9999-12-31'),
(74, 60, '365', '2017-01-01', '9999-12-31'),
(75, 60, '366', '2017-01-01', '9999-12-31'),
(76, 60, '367', '2017-01-01', '9999-12-31'),
(77, 61, '346', '2017-01-01', '9999-12-31'),
(78, 61, '347', '2017-01-01', '9999-12-31'),
(79, 61, '348', '2017-01-01', '9999-12-31'),
(80, 61, '349', '2017-01-01', '9999-12-31'),
(81, 61, '350', '2017-01-01', '9999-12-31'),
(82, 61, '351', '2017-01-01', '9999-12-31'),
(83, 61, '352', '2017-01-01', '9999-12-31'),
(84, 61, '353', '2017-01-01', '9999-12-31'),
(85, 61, '354', '2017-01-01', '9999-12-31'),
(86, 61, '355', '2017-01-01', '9999-12-31'),
(89, 61, '356', '2017-01-01', '9999-12-31'),
(90, 61, '357', '2017-01-01', '9999-12-31'),
(91, 61, '358', '2017-01-01', '9999-12-31'),
(92, 61, '359', '2017-01-01', '9999-12-31'),
(93, 61, '360', '2017-01-01', '9999-12-31'),
(94, 61, '361', '2017-01-01', '9999-12-31'),
(95, 61, '362', '2017-01-01', '9999-12-31'),
(96, 61, '363', '2017-01-01', '9999-12-31'),
(97, 61, '364', '2017-01-01', '9999-12-31'),
(98, 61, '365', '2017-01-01', '9999-12-31'),
(99, 61, '366', '2017-01-01', '9999-12-31'),
(100, 61, '367', '2017-01-01', '9999-12-31'),
(101, 56, '22 OPS', '2017-01-01', '9999-12-31'),
(102, 56, '22 NON OPS', '2017-01-01', '9999-12-31'),
(103, 56, '23 OPS', '2017-01-01', '9999-12-31'),
(104, 56, '24 OPS', '2017-01-01', '9999-12-31'),
(105, 56, '23 NON OPS', '2017-01-01', '9999-12-31'),
(106, 56, '24 NON OPS', '2017-01-01', '9999-12-31'),
(107, 56, '25 OPS', '2017-01-01', '9999-12-31'),
(108, 56, '25 NON OPS', '2017-01-01', '9999-12-31'),
(109, 56, '26 OPS', '2017-01-01', '9999-12-31'),
(110, 56, '26 NON OPS', '2017-01-01', '9999-12-31'),
(111, 56, '27 OPS', '2017-01-01', '9999-12-31'),
(112, 56, '27 NON OPS', '2017-01-01', '9999-12-31'),
(113, 56, '28 OPS', '2017-01-01', '9999-12-31'),
(114, 56, '28 NON OPS', '2017-01-01', '9999-12-31'),
(115, 56, '29 OPS', '2017-01-01', '9999-12-31'),
(116, 56, '29 NON OPS', '2017-01-01', '9999-12-31'),
(117, 56, '30 OPS', '2017-01-01', '9999-12-31'),
(118, 56, '30 NON OPS', '2017-01-01', '9999-12-31'),
(119, 62, '22', '2017-01-01', '9999-12-31'),
(120, 62, '23', '2017-01-01', '9999-12-31'),
(121, 67, 'All', '2017-01-01', '9999-12-31'),
(122, 68, 'All', '2017-01-01', '9999-12-31'),
(123, 62, '24', '2017-01-01', '9999-12-31'),
(124, 62, '25', '2017-01-01', '9999-12-31'),
(125, 62, '26', '2017-01-01', '9999-12-31'),
(126, 69, 'All', '2017-01-01', '9999-12-31'),
(127, 73, 'All', '2017-01-01', '9999-12-31'),
(128, 71, 'All', '2017-01-01', '9999-12-31'),
(129, 72, 'All', '2017-01-01', '9999-12-31'),
(130, 74, 'All', '2017-01-01', '9999-12-31'),
(131, 75, 'All', '2017-01-01', '9999-12-31'),
(132, 76, 'All', '2017-01-01', '9999-12-31'),
(133, 77, 'All', '2017-01-01', '9999-12-31'),
(134, 78, 'All', '2017-01-01', '9999-12-31'),
(135, 62, '27', '2017-01-01', '9999-12-31'),
(136, 79, 'PKO DAN APU PPT', '2017-01-01', '9999-12-31'),
(137, 79, 'DDPI', '2017-01-01', '9999-12-31'),
(138, 79, 'PIL 1 - OPS', '2017-01-01', '9999-12-31'),
(139, 79, 'PIL 2', '2017-01-01', '9999-12-31'),
(140, 79, 'MRO', '2017-01-01', '9999-12-31'),
(141, 79, 'KETERAMPILAN PENGOLAHAN DATABASE - IDEA', '2017-01-01', '9999-12-31'),
(142, 79, 'AKUNTANSI DAN PERPAJAKAN BCA', '2017-01-01', '9999-12-31'),
(143, 79, 'LBU ILS DAN SAP', '2017-01-01', '9999-12-31'),
(144, 79, 'LBU IDS', '2017-01-01', '9999-12-31'),
(145, 79, 'LBU PEMBUKUAN ', '2017-01-01', '9999-12-31'),
(146, 79, 'PENDALAMAN PIL 1 OPS - CABANG', '2017-01-01', '9999-12-31'),
(147, 79, 'PENDALAMAN PIL 1 OPS - KANWIL', '2017-01-01', '9999-12-31'),
(148, 79, 'AKUNTANSI KEUANGAN ', '2017-01-01', '9999-12-31'),
(149, 79, 'DDAK', '2017-01-01', '9999-12-31'),
(150, 62, '5', '2017-01-01', '9999-12-31'),
(151, 79, 'LAYANAN KREDIT', '2017-01-01', '9999-12-31'),
(152, 62, '4', '2017-01-01', '9999-12-31'),
(153, 79, 'PENDALAMAN PIL 1 KREDIT - AO/SBK', '2017-01-01', '9999-12-31'),
(154, 79, 'PENDALAMAN PIL 1 KREDIT - LAYANAN KREDIT', '2017-01-01', '9999-12-31'),
(155, 79, 'ARK SME', '2017-01-01', '9999-12-31'),
(156, 79, 'CREDIT SKILL ENHANCEMENT', '2017-01-01', '9999-12-31'),
(157, 79, 'ENHANCING LEADERSHIP ROLE', '2017-01-01', '9999-12-31'),
(158, 79, 'MANAGING SELF AND SERVICE', '2017-01-01', '9999-12-31'),
(159, 79, 'MASTERING SELF', '2017-01-01', '9999-12-31'),
(160, 79, 'ON BECOMING GOOD LEADER', '2017-01-01', '9999-12-31'),
(161, 79, 'SUPERVISORY MANAGEMENT', '2017-01-01', '9999-12-31'),
(162, 79, 'LEADING AT SPEED OF TRUST', '2017-01-01', '9999-12-31'),
(163, 79, 'TEKNIK PRESENTASI - BLENDED', '2017-01-01', '9999-12-31'),
(164, 79, 'PERILAKU ASERTIF - BLENDED', '2017-01-01', '9999-12-31'),
(165, 79, 'BERPIKIR DAN BERTINDAK  PROAKTIF', '2017-01-01', '9999-12-31'),
(166, 79, 'MENGUBAH STRES MENJADI SUKSES', '2017-01-01', '9999-12-31'),
(167, 79, 'COMMUNICATE WITH POWER', '2017-01-01', '9999-12-31'),
(168, 79, '7 HABITS - BLENDED', '2017-01-01', '9999-12-31'),
(169, 79, 'VBT 1', '2017-01-01', '9999-12-31'),
(170, 79, 'VBT 2', '2017-01-01', '9999-12-31'),
(171, 79, 'VBT 3', '2017-01-01', '9999-12-31'),
(172, 79, 'VBT 4', '2017-01-01', '9999-12-31'),
(173, 79, 'VBT 5 ', '2017-01-01', '9999-12-31'),
(174, 79, 'RANCANGAN HIDUPKU', '2017-01-01', '9999-12-31'),
(175, 79, 'BASIC COACHING SKILL - BLENDED', '2017-01-01', '9999-12-31'),
(176, 79, 'BUSINESS COMMUNICATION - BLENDED', '2017-01-01', '9999-12-31'),
(177, 79, 'CHANGE MANAGEMENT - BLENDED', '2017-01-01', '9999-12-31'),
(178, 80, 'All', '2017-01-01', '9999-12-31'),
(179, 81, 'All', '2017-01-01', '9999-12-31'),
(180, 82, '1', '2017-01-01', '9999-12-31'),
(181, 63, '15', '2017-01-01', '9999-12-31'),
(182, 63, '16', '2017-01-01', '9999-12-31'),
(183, 63, '17', '2017-01-01', '9999-12-31'),
(184, 63, '18', '2017-01-01', '9999-12-31'),
(185, 63, '19', '2017-01-01', '9999-12-31'),
(186, 63, '20', '2017-01-01', '9999-12-31'),
(187, 63, '21', '2017-01-01', '9999-12-31'),
(188, 63, '22', '2017-01-01', '9999-12-31'),
(189, 63, '23', '2017-01-01', '9999-12-31'),
(190, 64, '16', '2017-01-01', '9999-12-31'),
(191, 64, '17', '2017-01-01', '9999-12-31'),
(192, 64, '18', '2017-01-01', '9999-12-31'),
(193, 64, '19', '2017-01-01', '9999-12-31'),
(194, 64, '20', '2017-01-01', '9999-12-31'),
(195, 64, '21', '2017-01-01', '9999-12-31'),
(196, 64, '22', '2017-01-01', '9999-12-31'),
(197, 64, '23', '2017-01-01', '9999-12-31'),
(198, 64, '24', '2017-01-01', '9999-12-31'),
(199, 66, '5', '2017-01-01', '9999-12-31'),
(200, 66, '6', '2017-01-01', '9999-12-31'),
(201, 65, '5', '2017-01-01', '9999-12-31'),
(202, 65, '6', '2017-01-01', '9999-12-31'),
(203, 65, '7', '2017-01-01', '9999-12-31'),
(204, 65, '8', '2017-01-01', '9999-12-31'),
(205, 65, '9', '2017-01-01', '9999-12-31'),
(206, 85, 'All', '2017-01-01', '9999-12-31'),
(207, 86, 'All', '2017-01-01', '9999-12-31'),
(208, 89, 'KABAG TELLER', '2017-01-01', '9999-12-31'),
(209, 90, 'ANG. 8', '2017-01-01', '9999-12-31'),
(210, 91, 'BATCH 14', '2017-01-01', '9999-12-31'),
(211, 91, 'BATCH 15', '2017-01-01', '9999-12-31'),
(212, 94, '1', '2017-08-28', '9999-12-31'),
(213, 99, 'Training Class', '2017-01-01', '9999-12-31'),
(214, 99, 'Assessment', '2017-01-01', '9999-12-31'),
(215, 0, 'ANG. 6', '2017-01-01', '9999-12-31'),
(216, 95, 'ANG. 6', '2017-01-01', '9999-12-31'),
(217, 95, 'ANG. 18', '2017-01-01', '9999-12-31'),
(218, 96, 'Ang. 14', '2017-01-01', '9999-12-31'),
(219, 96, 'ANG. 1', '2017-01-01', '9999-12-31'),
(220, 96, 'ANG. 3', '2017-01-01', '9999-12-31'),
(221, 97, 'ANG. 25', '2017-01-01', '9999-12-31'),
(222, 97, 'ANG. 1', '2017-01-01', '9999-12-31'),
(223, 97, 'ANG. 5', '2017-01-01', '9999-12-31'),
(224, 97, 'ANG. 11', '2017-01-01', '9999-12-31'),
(225, 98, 'ANG. 3', '2017-01-01', '9999-12-31'),
(226, 98, 'ANG. 23', '2017-01-01', '9999-12-31'),
(227, 98, 'ANG. 20', '2017-01-01', '9999-12-31'),
(228, 98, 'ANG. 28', '2017-01-01', '9999-12-31'),
(229, 92, 'ANG. 1', '2017-01-01', '9999-12-31'),
(230, 79, 'PENDUKUNG CASA', '2017-01-01', '9999-12-31'),
(231, 79, 'STEP OUT FOR NETWORKING - VCON', '2017-01-01', '9999-12-31'),
(232, 79, 'NETWORKING THAT WORKS - VCON', '2017-01-01', '9999-12-31'),
(233, 100, 'PERSONAL WEALTH MANAGEMENT', '2017-01-01', '9999-12-31'),
(234, 100, 'MENGELOLA KEUANGAN PRIBADI-MANAGEMENT', '2017-01-01', '9999-12-31'),
(235, 100, 'MENGELOLA KEUANGAN PRIBADI -STAFF', '2017-01-01', '9999-12-31'),
(236, 100, 'PERSONAL HEALTH MANAGEMENT', '2017-01-01', '9999-12-31'),
(237, 100, 'HELATH MANAGEMENT', '2017-01-01', '9999-12-31'),
(238, 100, 'MENGELOLA HIDUP SEHAT-STAFF', '2017-01-01', '9999-12-31'),
(239, 100, 'NEW ME', '2017-01-01', '9999-12-31'),
(240, 100, 'RING THE BELL (S1-S3)', '2017-01-01', '9999-12-31'),
(241, 100, 'RING THE BELL (S4-S5)', '2017-01-01', '9999-12-31'),
(242, 100, 'RING THE BELL (S6-S7)', '2017-01-01', '9999-12-31'),
(243, 100, 'RING THE BELL (S8)', '2017-01-01', '9999-12-31'),
(244, 100, 'BEAUTIFUL LIFE (S1-S3) TAHAP 1', '2017-01-01', '9999-12-31'),
(245, 100, 'BEAUTIFUL LIFE (S1-S3) TAHAP 2', '2017-01-01', '9999-12-31'),
(246, 100, 'BEAUTIFUL LIFE (S4-S5) TAHAP 1', '2017-01-01', '9999-12-31'),
(247, 100, 'BEAUTIFUL LIFE (S4-S5) TAHAP 2', '2017-01-01', '9999-12-31'),
(248, 100, 'BEAUTIFUL LIFE (S6)', '2017-01-01', '9999-12-31'),
(249, 100, 'BEAUTIFUL LIFE (S7)', '2017-01-01', '9999-12-31'),
(250, 100, 'BEAUTIFUL LIFE (S8)', '2017-01-01', '9999-12-31'),
(251, 100, 'SMART PARENTING', '2017-01-01', '9999-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
CREATE TABLE IF NOT EXISTS `hotel` (
  `HotelID` int(11) NOT NULL AUTO_INCREMENT,
  `HotelName` varchar(100) NOT NULL,
  PRIMARY KEY (`HotelID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`HotelID`, `HotelName`) VALUES
(5, 'Aston Sentul'),
(6, 'Harris Sentul'),
(7, 'Darmawan Park'),
(8, 'Neo+ Green Savana'),
(9, 'Ciputra Jakarta'),
(11, 'Santika Jakarta'),
(12, 'Menara Peninsula'),
(13, 'Binus Square'),
(14, 'Mawar Indah'),
(15, 'Santa Monica');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi_reject`
--

DROP TABLE IF EXISTS `notifikasi_reject`;
CREATE TABLE IF NOT EXISTS `notifikasi_reject` (
  `NotifikasiID` int(11) NOT NULL AUTO_INCREMENT,
  `PemesananID` int(11) NOT NULL,
  `Tipe` varchar(200) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CheckerID` int(11) NOT NULL,
  `StatusAkhirPemesanan` varchar(200) NOT NULL,
  `Tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`NotifikasiID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `notifikasi_reject`
--

INSERT INTO `notifikasi_reject` (`NotifikasiID`, `PemesananID`, `Tipe`, `UserID`, `CheckerID`, `StatusAkhirPemesanan`, `Tanggal`) VALUES
(7, 7, 'Consumption', 19, 16, 'Pending', '2017-07-13 09:51:48'),
(8, 8, 'Class', 10, 16, 'rejected', '2017-07-13 09:08:47');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

DROP TABLE IF EXISTS `pemesanan`;
CREATE TABLE IF NOT EXISTS `pemesanan` (
  `PemesananID` int(11) NOT NULL AUTO_INCREMENT,
  `AngkatanID` int(11) NOT NULL,
  `TanggalAwalPemesanan` date NOT NULL,
  `TanggalAkhirPemesanan` date NOT NULL,
  `PICprogram` varchar(100) NOT NULL,
  `JumlahPeserta` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`PemesananID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`PemesananID`, `AngkatanID`, `TanggalAwalPemesanan`, `TanggalAkhirPemesanan`, `PICprogram`, `JumlahPeserta`, `UserID`) VALUES
(1, 79, '0000-00-00', '0000-00-00', 'M. Basori', 23, 13),
(2, 79, '2017-07-17', '2017-07-21', 'M.Basori', 23, 13),
(3, 126, '2017-07-17', '2017-07-21', 'Nacha', 35, 19),
(4, 159, '2017-07-17', '2017-07-17', 'Nacha', 40, 19),
(5, 121, '2017-07-24', '2017-07-28', 'Nacha', 3, 19),
(6, 156, '2017-07-19', '2017-07-20', 'Nacha', 28, 19),
(7, 156, '2017-07-26', '2017-07-27', 'Nacha', 14, 19),
(8, 101, '0000-00-00', '0000-00-00', 'RIFKI', 12, 10),
(9, 79, '2017-07-17', '2017-07-21', 'Basori', 23, 13),
(10, 101, '2017-08-08', '2017-08-11', 'RIFKI', 12, 10),
(11, 141, '2017-07-18', '2017-07-18', 'Nacha', 25, 19),
(12, 165, '2017-07-24', '2017-07-26', 'Nacha', 26, 19),
(13, 159, '0000-00-00', '0000-00-00', 'Anto', 26, 2),
(14, 101, '2017-08-08', '2017-08-11', 'RIFKI', 12, 10),
(15, 46, '2017-08-01', '2017-08-08', 'RACHMAWATI', 47, 14),
(16, 209, '2017-07-24', '2017-07-26', 'lia', 5, 8),
(17, 125, '2017-07-24', '2017-07-24', 'MAS''UD', 19, 11),
(18, 121, '2017-08-12', '2017-08-12', 'Nacha', 5, 19),
(19, 134, '2017-08-16', '2017-08-18', 'Nacha', 34, 19);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_airportshuttle`
--

DROP TABLE IF EXISTS `pemesanan_airportshuttle`;
CREATE TABLE IF NOT EXISTS `pemesanan_airportshuttle` (
  `AirportShuttleID` int(11) NOT NULL AUTO_INCREMENT,
  `PemesananID` int(11) NOT NULL,
  `Notes` varchar(100) NOT NULL,
  `CheckerNotes` varchar(100) NOT NULL,
  `CheckerID` int(11) NOT NULL,
  `TanggalBuat` varchar(100) NOT NULL,
  `Stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`AirportShuttleID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `pemesanan_airportshuttle`
--

INSERT INTO `pemesanan_airportshuttle` (`AirportShuttleID`, `PemesananID`, `Notes`, `CheckerNotes`, `CheckerID`, `TanggalBuat`, `Stamp`, `status`) VALUES
(1, 2, '', '', 0, '', '2017-07-10 08:03:43', 'Pending'),
(2, 3, '', '', 0, '', '2017-07-10 08:15:40', 'Pending'),
(3, 4, '', '', 0, '', '2017-07-14 02:30:28', 'approved'),
(4, 6, '', '', 0, '', '2017-07-13 07:24:41', 'Pending'),
(5, 16, '', '', 0, '', '2017-07-21 09:37:10', 'Pending'),
(6, 10, '', '', 0, '', '2017-07-21 09:45:28', 'Pending'),
(7, 19, '', '', 0, '', '2017-08-15 04:35:17', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_hotel`
--

DROP TABLE IF EXISTS `pemesanan_hotel`;
CREATE TABLE IF NOT EXISTS `pemesanan_hotel` (
  `PemesananHotelID` int(11) NOT NULL AUTO_INCREMENT,
  `PemesananID` int(11) NOT NULL,
  `HotelName` varchar(100) NOT NULL,
  `TanggalCheckIn` date NOT NULL,
  `TanggalCheckOut` date NOT NULL,
  `Jml_SinglePria` int(11) DEFAULT '0',
  `Jml_TwinPria` int(11) NOT NULL DEFAULT '0',
  `Jml_singleWanita` int(11) NOT NULL DEFAULT '0',
  `Jml_twinWanita` int(11) NOT NULL DEFAULT '0',
  `Note` varchar(100) NOT NULL,
  `CheckerNotes` varchar(100) NOT NULL,
  `CheckerID` int(11) NOT NULL,
  `TanggalBuat` varchar(100) NOT NULL,
  `Stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`PemesananHotelID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `pemesanan_hotel`
--

INSERT INTO `pemesanan_hotel` (`PemesananHotelID`, `PemesananID`, `HotelName`, `TanggalCheckIn`, `TanggalCheckOut`, `Jml_SinglePria`, `Jml_TwinPria`, `Jml_singleWanita`, `Jml_twinWanita`, `Note`, `CheckerNotes`, `CheckerID`, `TanggalBuat`, `Stamp`, `status`) VALUES
(1, 2, 'Darmawan Park', '2017-07-13', '2017-07-26', 0, 3, 0, 2, '', '', 0, '', '2017-07-10 08:03:43', 'Pending'),
(2, 3, 'Aston Sentul', '2017-07-16', '2017-07-18', 3, 21, 5, 6, '', '', 0, '', '2017-07-10 08:15:40', 'Pending'),
(3, 4, 'Aston Sentul', '2017-07-16', '2017-07-18', 6, 0, 4, 0, '', '', 0, '', '2017-07-14 02:40:31', 'booked'),
(4, 6, 'Aston Sentul', '2017-07-18', '2017-07-21', 6, 7, 8, 7, '', '', 0, '', '2017-07-13 07:24:41', 'Pending'),
(5, 12, 'Aston Sentul', '2017-07-23', '2017-07-27', 5, 2, 3, 3, '', '', 0, '', '2017-07-18 02:04:40', 'Pending'),
(6, 16, 'Aston Sentul', '2017-07-23', '2017-07-27', 1, 0, 2, 0, '', '', 0, '', '2017-07-21 09:37:09', 'Pending'),
(7, 10, 'Neo+ Green Savana', '2017-08-08', '2017-08-19', 0, 2, 0, 4, '', '', 0, '', '2017-07-21 09:41:05', 'Pending'),
(8, 19, 'Aston Sentul', '2017-08-21', '2017-08-24', 2, 2, 0, 2, '', '', 0, '', '2017-08-15 04:31:06', 'booked');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_hotel_attachment`
--

DROP TABLE IF EXISTS `pemesanan_hotel_attachment`;
CREATE TABLE IF NOT EXISTS `pemesanan_hotel_attachment` (
  `ID` int(11) NOT NULL,
  `PemesananID` int(11) NOT NULL,
  `File` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_kelas`
--

DROP TABLE IF EXISTS `pemesanan_kelas`;
CREATE TABLE IF NOT EXISTS `pemesanan_kelas` (
  `ClassID` int(11) NOT NULL AUTO_INCREMENT,
  `PemesananID` int(11) NOT NULL,
  `RoomName` varchar(100) NOT NULL,
  `Jumlah_Peserta` int(11) NOT NULL,
  `Layout` varchar(100) NOT NULL,
  `Note` varchar(100) NOT NULL,
  `CheckerNotes` varchar(100) NOT NULL,
  `CheckerID` int(11) NOT NULL,
  `TanggalBuat` date NOT NULL,
  `File` varchar(500) NOT NULL,
  `Stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`ClassID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `pemesanan_kelas`
--

INSERT INTO `pemesanan_kelas` (`ClassID`, `PemesananID`, `RoomName`, `Jumlah_Peserta`, `Layout`, `Note`, `CheckerNotes`, `CheckerID`, `TanggalBuat`, `File`, `Stamp`, `status`) VALUES
(1, 1, 'A301', 23, 'Class Room', '', '', 0, '0000-00-00', '', '2017-07-10 07:44:00', 'Pending'),
(2, 2, 'A301', 23, 'Class Room', '', '', 0, '0000-00-00', '', '2017-07-10 08:03:42', 'Pending'),
(3, 8, 'A202', 12, 'Classroom', '', 'a', 16, '0000-00-00', '', '2017-07-13 09:08:47', 'rejected'),
(4, 13, 'B101', 25, '', '', '', 0, '0000-00-00', '', '2017-07-19 04:41:25', 'Pending'),
(5, 14, 'A202', 12, 'CLASSROOM', '', '', 0, '0000-00-00', '', '2017-07-19 09:34:18', 'Pending'),
(6, 15, 'A803', 47, '', '', '', 0, '0000-00-00', '', '2017-07-20 07:45:10', 'Pending'),
(7, 10, 'A202', 12, 'CLASSROOM', '', '', 0, '0000-00-00', '', '2017-07-21 09:34:36', 'Pending'),
(8, 17, 'A205', 19, 'ROUND TABLE', '', '', 0, '0000-00-00', '', '2017-07-21 09:58:00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_kelas_attachment`
--

DROP TABLE IF EXISTS `pemesanan_kelas_attachment`;
CREATE TABLE IF NOT EXISTS `pemesanan_kelas_attachment` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PemesananID` int(11) NOT NULL,
  `File` longblob NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_konsumsi`
--

DROP TABLE IF EXISTS `pemesanan_konsumsi`;
CREATE TABLE IF NOT EXISTS `pemesanan_konsumsi` (
  `KonsumsiID` int(11) NOT NULL AUTO_INCREMENT,
  `PemesananID` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `JenisKonsumsi` varchar(500) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `RuanganKonsumsi` varchar(100) NOT NULL,
  `Note` varchar(200) NOT NULL,
  `CheckerNotes` varchar(100) NOT NULL,
  `CheckerID` int(11) NOT NULL,
  `TanggalBuat` varchar(100) NOT NULL,
  `Stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`KonsumsiID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

--
-- Dumping data for table `pemesanan_konsumsi`
--

INSERT INTO `pemesanan_konsumsi` (`KonsumsiID`, `PemesananID`, `Tanggal`, `JenisKonsumsi`, `Jumlah`, `RuanganKonsumsi`, `Note`, `CheckerNotes`, `CheckerID`, `TanggalBuat`, `Stamp`, `status`) VALUES
(1, 2, '2017-07-17', 'Coffee Break Pagi', 23, 'A301', '', '', 0, '', '2017-07-10 08:03:42', 'Pending'),
(2, 2, '2017-07-17', 'Lunch', 23, 'A301', '', '', 0, '', '2017-07-10 08:03:42', 'Pending'),
(3, 2, '2017-07-17', 'Coffee Break Siang', 23, 'A301', '', '', 0, '', '2017-07-10 08:03:42', 'Pending'),
(4, 2, '2017-07-18', 'Coffee Break Pagi', 23, 'A301', '', '', 0, '', '2017-07-10 08:03:42', 'Pending'),
(5, 2, '2017-07-18', 'Coffee Break Pagi', 23, 'A301', '', '', 0, '', '2017-07-10 08:03:42', 'Pending'),
(6, 2, '2017-07-18', 'Coffee Break Pagi', 23, 'A301', '', '', 0, '', '2017-07-10 08:03:43', 'Pending'),
(7, 2, '2017-07-18', 'Lunch', 23, 'A301', '', '', 0, '', '2017-07-10 08:03:43', 'Pending'),
(8, 2, '2017-07-19', 'Coffee Break Pagi', 23, 'A301', '', '', 0, '', '2017-07-10 08:03:43', 'Pending'),
(9, 2, '2017-07-19', 'Coffee Break Pagi', 23, 'A301', '', '', 0, '', '2017-07-10 08:03:43', 'Pending'),
(10, 2, '2017-07-19', 'Lunch', 23, 'A301', '', '', 0, '', '2017-07-10 08:03:43', 'Pending'),
(11, 2, '2017-07-19', 'Coffee Break Siang', 23, 'A301', '', '', 0, '', '2017-07-10 08:03:43', 'Pending'),
(12, 2, '2017-07-20', 'Coffee Break Pagi', 23, 'A301', '', '', 0, '', '2017-07-10 08:03:43', 'Pending'),
(13, 2, '2017-07-20', 'Lunch', 23, 'A301', '', '', 0, '', '2017-07-10 08:03:43', 'Pending'),
(14, 2, '2017-07-20', 'Coffee Break Siang', 23, 'A301', '', '', 0, '', '2017-07-10 08:03:43', 'Pending'),
(15, 2, '2017-07-21', 'Coffee Break Pagi', 23, 'A301', '', '', 0, '', '2017-07-10 08:03:43', 'Pending'),
(16, 2, '2017-07-21', 'Lunch', 23, 'A301', '', '', 0, '', '2017-07-10 08:03:43', 'Pending'),
(17, 2, '2017-07-21', 'Coffee Break Siang', 23, 'A301', '', '', 0, '', '2017-07-10 08:03:43', 'Pending'),
(18, 3, '2017-07-17', 'Coffee Break Pagi', 35, 'B103', '', '', 0, '', '2017-07-10 08:15:40', 'Pending'),
(19, 3, '2017-07-17', 'Lunch', 35, 'B103', '', '', 0, '', '2017-07-10 08:15:40', 'Pending'),
(20, 3, '2017-07-17', 'Coffee Break Siang', 35, 'A103', '', '', 0, '', '2017-07-10 08:15:40', 'Pending'),
(21, 4, '2017-07-17', 'Coffee Break Pagi', 40, 'B201', '', '', 0, '', '2017-07-14 02:40:26', 'booked'),
(22, 4, '2017-07-17', 'Lunch', 40, 'B201', '', '', 0, '', '2017-07-14 02:40:26', 'booked'),
(23, 4, '2017-07-17', 'Coffee Break Siang', 40, 'B201', '', '', 0, '', '2017-07-14 02:40:26', 'booked'),
(24, 5, '2017-07-10', 'Coffee Break Pagi', 2, 'A203', '', '', 0, '', '2017-07-10 09:05:34', 'Pending'),
(26, 6, '2017-07-19', 'Coffee Break Pagi', 28, 'B502', '', '', 0, '', '2017-07-13 07:24:41', 'Pending'),
(27, 6, '2017-07-19', 'Lunch', 28, 'B502', '', '', 0, '', '2017-07-13 07:24:41', 'Pending'),
(28, 6, '2017-07-19', 'Coffee Break Siang', 28, 'B502', '', '', 0, '', '2017-07-13 07:24:41', 'Pending'),
(29, 6, '2017-07-20', 'Coffee Break Pagi', 28, 'B502', '', '', 0, '', '2017-07-13 07:24:41', 'Pending'),
(30, 6, '2017-07-20', 'Lunch', 28, 'B502', '', '', 0, '', '2017-07-13 07:24:41', 'Pending'),
(31, 6, '2017-07-20', 'Coffee Break Siang', 28, 'B502', '', '', 0, '', '2017-07-13 07:24:41', 'Pending'),
(32, 7, '2017-07-26', 'Coffee Break Pagi', 14, 'B302', '', '', 0, '', '2017-07-14 02:30:52', 'booked'),
(33, 7, '2017-07-27', 'Lunch', 14, 'B302', '', '', 0, '', '2017-07-14 02:30:52', 'booked'),
(34, 9, '2017-07-17', 'Coffee Break Pagi', 23, 'A301', '', '', 0, '', '2017-07-13 08:33:01', 'Pending'),
(35, 9, '2017-07-17', 'Lunch', 23, 'A301', '', '', 0, '', '2017-07-13 08:33:01', 'Pending'),
(36, 9, '2017-07-17', 'Coffee Break Siang', 23, 'A301', '', '', 0, '', '2017-07-13 08:33:01', 'Pending'),
(37, 9, '2017-07-18', 'Coffee Break Pagi', 23, 'A301', '', '', 0, '', '2017-07-13 08:33:01', 'Pending'),
(38, 9, '2017-07-18', 'Lunch', 23, 'A301', '', '', 0, '', '2017-07-13 08:33:01', 'Pending'),
(39, 9, '2017-07-18', 'Coffee Break Siang', 23, 'A301', '', '', 0, '', '2017-07-13 08:33:01', 'Pending'),
(40, 9, '2017-07-19', 'Coffee Break Pagi', 23, 'A301', '', '', 0, '', '2017-07-13 08:33:01', 'Pending'),
(41, 9, '2017-07-19', 'Coffee Break Pagi', 23, 'A301', '', '', 0, '', '2017-07-13 08:33:01', 'Pending'),
(42, 11, '2017-07-18', 'Lunch', 25, 'A305', '', '', 0, '', '2017-07-17 09:53:01', 'Pending'),
(43, 14, '2017-08-08', 'Coffee Break Pagi', 13, 'A202', '', '', 0, '', '2017-07-21 09:52:33', 'Pending'),
(44, 14, '2017-08-08', 'Coffee Break Siang', 13, 'A202', '', '', 0, '', '2017-07-21 09:52:33', 'Pending'),
(45, 14, '2017-08-08', 'Lunch', 13, 'A202', '', '', 0, '', '2017-07-21 09:52:33', 'Pending'),
(46, 15, '2017-08-01', 'Lunch', 47, 'A803 K.THEATER', '', '', 0, '', '2017-07-20 07:45:10', 'Pending'),
(47, 15, '2017-08-02', 'Lunch', 47, 'A803 K.THEATER', '', '', 0, '', '2017-07-20 07:45:10', 'Pending'),
(48, 15, '2017-08-02', 'Lunch', 47, 'A705 K.KOMPUTER', '', '', 0, '', '2017-07-20 07:45:10', 'Pending'),
(49, 15, '2017-08-03', 'Lunch', 47, 'A705 K.KOMPUTER', '', '', 0, '', '2017-07-20 07:45:10', 'Pending'),
(50, 15, '2017-08-04', 'Lunch', 47, 'A5-BANK MINI TELLER', '', '', 0, '', '2017-07-20 07:45:10', 'Pending'),
(51, 15, '2017-08-07', 'Lunch', 47, 'A5-BANK MINI TELLER', '', '', 0, '', '2017-07-20 07:45:10', 'Pending'),
(52, 15, '2017-08-08', 'Lunch', 47, 'A5-BANK MINI TELLER', '', '', 0, '', '2017-07-20 07:45:10', 'Pending'),
(53, 16, '2017-07-24', 'Coffee Break Pagi', 5, 'B101', '', '', 0, '', '2017-07-21 09:37:09', 'Pending'),
(54, 16, '2017-07-24', 'Lunch', 5, 'B101', '', '', 0, '', '2017-07-21 09:37:09', 'Pending'),
(55, 16, '2017-07-24', 'Coffee Break Siang', 5, 'B101', '', '', 0, '', '2017-07-21 09:37:09', 'Pending'),
(56, 16, '2017-07-25', 'Coffee Break Pagi', 5, 'A101', '', '', 0, '', '2017-07-21 09:37:09', 'Pending'),
(57, 16, '2017-07-25', 'Lunch', 5, 'A101', '', '', 0, '', '2017-07-21 09:37:09', 'Pending'),
(58, 16, '2017-07-25', 'Coffee Break Siang', 5, 'A101', '', '', 0, '', '2017-07-21 09:37:09', 'Pending'),
(59, 16, '2017-07-26', 'Coffee Break Pagi', 5, 'A102', '', '', 0, '', '2017-07-21 09:37:09', 'Pending'),
(60, 16, '2017-07-26', 'Lunch', 5, 'A102', '', '', 0, '', '2017-07-21 09:37:09', 'Pending'),
(61, 16, '2017-07-26', 'Coffee Break Siang', 5, 'A102', '', '', 0, '', '2017-07-21 09:37:09', 'Pending'),
(62, 10, '2017-08-08', 'Coffee Break Pagi', 12, 'A202', '', '', 0, '', '2017-07-21 09:38:38', 'Pending'),
(63, 10, '2017-08-08', 'Lunch', 12, 'A202', '', '', 0, '', '2017-07-21 09:38:38', 'Pending'),
(64, 10, '2017-08-08', 'Coffee Break Siang', 12, 'A202', '', '', 0, '', '2017-07-21 09:38:38', 'Pending'),
(65, 10, '2017-08-09', 'Coffee Break Pagi', 12, 'A203', '', '', 0, '', '2017-07-21 09:38:38', 'Pending'),
(66, 10, '2017-08-09', 'Lunch', 12, 'A203', '', '', 0, '', '2017-07-21 09:38:38', 'Pending'),
(67, 10, '2017-08-09', 'Coffee Break Siang', 12, 'A203', '', '', 0, '', '2017-07-21 09:38:38', 'Pending'),
(68, 10, '2017-08-10', 'Coffee Break Pagi', 12, 'A204', '', '', 0, '', '2017-07-21 09:38:38', 'Pending'),
(69, 10, '2017-08-10', 'Lunch', 12, 'A204', '', '', 0, '', '2017-07-21 09:38:38', 'Pending'),
(70, 10, '2017-08-10', 'Coffee Break Siang', 12, 'A204', '', '', 0, '', '2017-07-21 09:38:38', 'Pending'),
(71, 10, '2017-08-11', 'Coffee Break Pagi', 12, 'A204', '', '', 0, '', '2017-07-21 09:38:38', 'Pending'),
(72, 10, '2017-08-11', 'Lunch', 12, 'A204', '', '', 0, '', '2017-07-21 09:38:38', 'Pending'),
(73, 10, '2017-08-11', 'Coffee Break Siang', 12, 'A204', '', '', 0, '', '2017-07-21 09:38:38', 'Pending'),
(74, 17, '2017-07-24', 'Coffee Break Pagi', 19, 'A205', '', '', 0, '', '2017-07-21 09:58:00', 'Pending'),
(75, 17, '2017-07-24', 'Lunch', 19, 'A205', '', '', 0, '', '2017-07-21 09:58:00', 'Pending'),
(76, 17, '2017-07-24', 'Coffee Break Siang', 19, 'A205', '', '', 0, '', '2017-07-21 09:58:00', 'Pending'),
(77, 18, '2017-08-12', 'Coffee Break Pagi', 6, 'B506', '', '', 0, '', '2017-08-11 03:46:11', 'Pending'),
(78, 18, '2017-08-12', 'Lunch', 7, 'A205', '', '', 0, '', '2017-08-11 03:46:11', 'Pending'),
(79, 18, '2017-08-12', 'Coffee Break Siang', 5, 'B301', '', '', 0, '', '2017-08-11 03:46:11', 'Pending'),
(80, 19, '2017-08-16', 'Coffee Break Pagi', 35, 'B503', '', '', 0, '', '2017-08-14 09:32:14', 'booked'),
(81, 19, '2017-08-16', 'Lunch', 35, 'B503', '', '', 0, '', '2017-08-14 09:32:14', 'booked'),
(82, 19, '2017-08-16', 'Coffee Break Siang', 35, 'B503', '', '', 0, '', '2017-08-14 09:32:14', 'booked'),
(83, 19, '2017-08-17', 'Coffee Break Pagi', 35, 'B503', '', '', 0, '', '2017-08-14 09:32:14', 'booked'),
(84, 19, '2017-08-17', 'Lunch', 35, 'B503', '', '', 0, '', '2017-08-14 09:32:14', 'booked'),
(85, 19, '2017-08-17', 'Coffee Break Siang', 35, 'B503', '', '', 0, '', '2017-08-14 09:32:14', 'booked'),
(86, 19, '2017-08-18', 'Coffee Break Pagi', 35, 'B503', '', '', 0, '', '2017-08-14 09:32:14', 'booked'),
(87, 19, '2017-08-18', 'Lunch', 35, 'B503', '', '', 0, '', '2017-08-14 09:32:14', 'booked'),
(88, 19, '2017-08-18', 'Coffee Break Siang', 35, 'B503', '', '', 0, '', '2017-08-14 09:32:14', 'booked');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_konsumsi_attachment`
--

DROP TABLE IF EXISTS `pemesanan_konsumsi_attachment`;
CREATE TABLE IF NOT EXISTS `pemesanan_konsumsi_attachment` (
  `ID` int(11) NOT NULL,
  `PemesananID` int(11) NOT NULL,
  `File` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_shuttlebus`
--

DROP TABLE IF EXISTS `pemesanan_shuttlebus`;
CREATE TABLE IF NOT EXISTS `pemesanan_shuttlebus` (
  `ShuttleID` int(11) NOT NULL AUTO_INCREMENT,
  `ShuttlePoint` varchar(100) NOT NULL,
  `PemesananID` int(11) NOT NULL,
  `Dates` date NOT NULL,
  `Passanger_Count` int(11) NOT NULL,
  `Stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Note` varchar(100) NOT NULL,
  `CheckerNotes` varchar(100) NOT NULL,
  `CheckerID` int(11) NOT NULL,
  `TanggalBuat` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`ShuttleID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=118 ;

--
-- Dumping data for table `pemesanan_shuttlebus`
--

INSERT INTO `pemesanan_shuttlebus` (`ShuttleID`, `ShuttlePoint`, `PemesananID`, `Dates`, `Passanger_Count`, `Stamp`, `Note`, `CheckerNotes`, `CheckerID`, `TanggalBuat`, `status`) VALUES
(1, 'Alam', 2, '2017-07-17', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(2, 'Bekasi', 2, '2017-07-17', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(3, 'Bogor', 2, '2017-07-17', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(4, 'Kelapa', 2, '2017-07-17', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(5, 'Wisma', 2, '2017-07-17', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(6, 'Alam', 2, '2017-07-18', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(7, 'Bekasi', 2, '2017-07-18', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(8, 'Bogor', 2, '2017-07-18', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(9, 'Kelapa', 2, '2017-07-18', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(10, 'Wisma', 2, '2017-07-18', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(11, 'Alam', 2, '2017-07-19', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(12, 'Bekasi', 2, '2017-07-19', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(13, 'Bogor', 2, '2017-07-19', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(14, 'Kelapa', 2, '2017-07-19', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(15, 'Wisma', 2, '2017-07-19', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(16, 'Alam', 2, '2017-07-20', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(17, 'Bekasi', 2, '2017-07-20', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(18, 'Bogor', 2, '2017-07-20', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(19, 'Kelapa', 2, '2017-07-20', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(20, 'Wisma', 2, '2017-07-20', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(21, 'Alam', 2, '2017-07-21', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(22, 'Bekasi', 2, '2017-07-21', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(23, 'Bogor', 2, '2017-07-21', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(24, 'Kelapa', 2, '2017-07-21', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(25, 'Wisma', 2, '2017-07-21', 7, '2017-07-10 08:03:43', '', '', 0, '', 'Pending'),
(26, 'Alam Sutera', 3, '2017-07-17', 4, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(27, 'Bekasi', 3, '2017-07-17', 2, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(28, 'Bogor', 3, '2017-07-17', 3, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(29, 'Kelapa Gading', 3, '2017-07-17', 3, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(30, 'Wisma Asia', 3, '2017-07-17', 2, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(31, 'Alam Sutera', 3, '2017-07-18', 0, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(32, 'Bekasi', 3, '2017-07-18', 0, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(33, 'Bogor', 3, '2017-07-18', 0, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(34, 'Kelapa Gading', 3, '2017-07-18', 0, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(35, 'Wisma Asia', 3, '2017-07-18', 0, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(36, 'Alam Sutera', 3, '2017-07-19', 0, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(37, 'Bekasi', 3, '2017-07-19', 0, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(38, 'Bogor', 3, '2017-07-19', 0, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(39, 'Kelapa Gading', 3, '2017-07-19', 0, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(40, 'Wisma Asia', 3, '2017-07-19', 0, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(41, 'Alam Sutera', 3, '2017-07-20', 0, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(42, 'Bekasi', 3, '2017-07-20', 0, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(43, 'Bogor', 3, '2017-07-20', 0, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(44, 'Kelapa Gading', 3, '2017-07-20', 0, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(45, 'Wisma Asia', 3, '2017-07-20', 0, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(46, 'Alam Sutera', 3, '2017-07-21', 0, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(47, 'Bekasi', 3, '2017-07-21', 0, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(48, 'Bogor', 3, '2017-07-21', 0, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(49, 'Kelapa Gading', 3, '2017-07-21', 0, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(50, 'Wisma Asia', 3, '2017-07-21', 0, '2017-07-10 08:15:40', '', '', 0, '', 'Pending'),
(51, 'Alam', 4, '2017-07-17', 3, '2017-07-14 02:40:41', '', '', 0, '', 'booked'),
(52, 'Bekasi', 4, '2017-07-17', 3, '2017-07-14 02:40:41', '', '', 0, '', 'booked'),
(53, 'Bogor', 4, '2017-07-17', 3, '2017-07-14 02:40:41', '', '', 0, '', 'booked'),
(54, 'Kelapa', 4, '2017-07-17', 3, '2017-07-14 02:40:41', '', '', 0, '', 'booked'),
(55, 'Wisma', 4, '2017-07-17', 3, '2017-07-14 02:40:41', '', '', 0, '', 'booked'),
(56, 'Alam', 6, '2017-07-19', 4, '2017-07-13 07:37:18', '', '', 0, '', 'Pending'),
(57, 'Bekasi', 6, '2017-07-19', 2, '2017-07-13 07:37:18', '', '', 0, '', 'Pending'),
(58, 'Bogor', 6, '2017-07-19', 3, '2017-07-13 07:37:18', '', '', 0, '', 'Pending'),
(59, 'Pondok', 6, '2017-07-19', 2, '2017-07-13 07:37:18', '', '', 0, '', 'Pending'),
(60, 'Wisma', 6, '2017-07-19', 3, '2017-07-13 07:37:18', '', '', 0, '', 'Pending'),
(61, 'Alam', 6, '2017-07-20', 2, '2017-07-13 07:37:18', '', '', 0, '', 'Pending'),
(62, 'Bogor', 6, '2017-07-20', 2, '2017-07-13 07:37:18', '', '', 0, '', 'Pending'),
(63, 'Pondok', 6, '2017-07-20', 5, '2017-07-13 07:37:18', '', '', 0, '', 'Pending'),
(64, 'Alam Sutera', 16, '2017-07-24', 1, '2017-07-21 09:37:09', '', '', 0, '', 'Pending'),
(65, 'Bekasi', 16, '2017-07-24', 1, '2017-07-21 09:37:09', '', '', 0, '', 'Pending'),
(66, 'Bogor', 16, '2017-07-24', 0, '2017-07-21 09:37:09', '', '', 0, '', 'Pending'),
(67, 'Kelapa Gading', 16, '2017-07-24', 0, '2017-07-21 09:37:09', '', '', 0, '', 'Pending'),
(68, 'Pondok Indah', 16, '2017-07-24', 0, '2017-07-21 09:37:09', '', '', 0, '', 'Pending'),
(69, 'Wisma Asia', 16, '2017-07-24', 0, '2017-07-21 09:37:09', '', '', 0, '', 'Pending'),
(70, 'Alam Sutera', 16, '2017-07-25', 1, '2017-07-21 09:37:09', '', '', 0, '', 'Pending'),
(71, 'Bekasi', 16, '2017-07-25', 1, '2017-07-21 09:37:09', '', '', 0, '', 'Pending'),
(72, 'Bogor', 16, '2017-07-25', 0, '2017-07-21 09:37:09', '', '', 0, '', 'Pending'),
(73, 'Kelapa Gading', 16, '2017-07-25', 0, '2017-07-21 09:37:09', '', '', 0, '', 'Pending'),
(74, 'Pondok Indah', 16, '2017-07-25', 0, '2017-07-21 09:37:09', '', '', 0, '', 'Pending'),
(75, 'Wisma Asia', 16, '2017-07-25', 0, '2017-07-21 09:37:09', '', '', 0, '', 'Pending'),
(76, 'Alam Sutera', 16, '2017-07-26', 1, '2017-07-21 09:37:09', '', '', 0, '', 'Pending'),
(77, 'Bekasi', 16, '2017-07-26', 0, '2017-07-21 09:37:09', '', '', 0, '', 'Pending'),
(78, 'Bogor', 16, '2017-07-26', 0, '2017-07-21 09:37:09', '', '', 0, '', 'Pending'),
(79, 'Kelapa Gading', 16, '2017-07-26', 0, '2017-07-21 09:37:09', '', '', 0, '', 'Pending'),
(80, 'Pondok Indah', 16, '2017-07-26', 0, '2017-07-21 09:37:10', '', '', 0, '', 'Pending'),
(81, 'Wisma Asia', 16, '2017-07-26', 0, '2017-07-21 09:37:10', '', '', 0, '', 'Pending'),
(82, 'Alam', 10, '2017-08-08', 2, '2017-07-21 09:43:35', '', '', 0, '', 'Pending'),
(83, 'Kelapa', 10, '2017-08-08', 1, '2017-07-21 09:43:35', '', '', 0, '', 'Pending'),
(84, 'Wisma', 10, '2017-08-08', 7, '2017-07-21 09:43:35', '', '', 0, '', 'Pending'),
(85, 'Alam', 10, '2017-08-09', 2, '2017-07-21 09:43:35', '', '', 0, '', 'Pending'),
(86, 'Kelapa', 10, '2017-08-09', 1, '2017-07-21 09:43:35', '', '', 0, '', 'Pending'),
(87, 'Wisma', 10, '2017-08-09', 3, '2017-07-21 09:43:35', '', '', 0, '', 'Pending'),
(88, 'Alam', 10, '2017-08-10', 2, '2017-07-21 09:43:35', '', '', 0, '', 'Pending'),
(89, 'Kelapa', 10, '2017-08-10', 1, '2017-07-21 09:43:35', '', '', 0, '', 'Pending'),
(90, 'Wisma', 10, '2017-08-10', 15, '2017-07-21 09:43:35', '', '', 0, '', 'Pending'),
(91, 'Alam', 10, '2017-08-11', 2, '2017-07-21 09:43:35', '', '', 0, '', 'Pending'),
(92, 'Kelapa', 10, '2017-08-11', 1, '2017-07-21 09:43:35', '', '', 0, '', 'Pending'),
(93, 'Wisma', 10, '2017-08-11', 3, '2017-07-21 09:43:35', '', '', 0, '', 'Pending'),
(94, 'Alam Sutera', 17, '2017-07-24', 6, '2017-07-21 09:58:00', '', '', 0, '', 'Pending'),
(95, 'Bekasi', 17, '2017-07-24', 1, '2017-07-21 09:58:01', '', '', 0, '', 'Pending'),
(96, 'Bogor', 17, '2017-07-24', 3, '2017-07-21 09:58:01', '', '', 0, '', 'Pending'),
(97, 'Kelapa Gading', 17, '2017-07-24', 1, '2017-07-21 09:58:01', '', '', 0, '', 'Pending'),
(98, 'Pondok Indah', 17, '2017-07-24', 0, '2017-07-21 09:58:01', '', '', 0, '', 'Pending'),
(99, 'Wisma Asia', 17, '2017-07-24', 7, '2017-07-21 09:58:01', '', '', 0, '', 'Pending'),
(100, 'Alam Sutera', 19, '2017-08-16', 5, '2017-08-15 04:33:43', '', '', 0, '', 'booked'),
(101, 'Bekasi', 19, '2017-08-16', 5, '2017-08-15 04:33:43', '', '', 0, '', 'booked'),
(102, 'Bogor', 19, '2017-08-16', 5, '2017-08-15 04:33:43', '', '', 0, '', 'booked'),
(103, 'Kelapa Gading', 19, '2017-08-16', 5, '2017-08-15 04:33:43', '', '', 0, '', 'booked'),
(104, 'Pondok Indah', 19, '2017-08-16', 5, '2017-08-15 04:33:43', '', '', 0, '', 'booked'),
(105, 'Wisma Asia', 19, '2017-08-16', 5, '2017-08-15 04:33:43', '', '', 0, '', 'booked'),
(106, 'Alam Sutera', 19, '2017-08-17', 5, '2017-08-15 04:33:43', '', '', 0, '', 'booked'),
(107, 'Bekasi', 19, '2017-08-17', 5, '2017-08-15 04:33:43', '', '', 0, '', 'booked'),
(108, 'Bogor', 19, '2017-08-17', 5, '2017-08-15 04:33:43', '', '', 0, '', 'booked'),
(109, 'Kelapa Gading', 19, '2017-08-17', 5, '2017-08-15 04:33:43', '', '', 0, '', 'booked'),
(110, 'Pondok Indah', 19, '2017-08-17', 5, '2017-08-15 04:33:43', '', '', 0, '', 'booked'),
(111, 'Wisma Asia', 19, '2017-08-17', 5, '2017-08-15 04:33:43', '', '', 0, '', 'booked'),
(112, 'Alam Sutera', 19, '2017-08-18', 5, '2017-08-15 04:33:43', '', '', 0, '', 'booked'),
(113, 'Bekasi', 19, '2017-08-18', 5, '2017-08-15 04:33:43', '', '', 0, '', 'booked'),
(114, 'Bogor', 19, '2017-08-18', 5, '2017-08-15 04:33:43', '', '', 0, '', 'booked'),
(115, 'Kelapa Gading', 19, '2017-08-18', 5, '2017-08-15 04:33:43', '', '', 0, '', 'booked'),
(116, 'Pondok Indah', 19, '2017-08-18', 5, '2017-08-15 04:33:43', '', '', 0, '', 'booked'),
(117, 'Wisma Asia', 19, '2017-08-18', 5, '2017-08-15 04:33:43', '', '', 0, '', 'booked');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_shuttlebus_attachment`
--

DROP TABLE IF EXISTS `pemesanan_shuttlebus_attachment`;
CREATE TABLE IF NOT EXISTS `pemesanan_shuttlebus_attachment` (
  `ID` point NOT NULL,
  `PemesananID` int(11) NOT NULL,
  `File` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
CREATE TABLE IF NOT EXISTS `program` (
  `ProgramID` int(11) NOT NULL AUTO_INCREMENT,
  `ProgramName` varchar(100) NOT NULL,
  PRIMARY KEY (`ProgramID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`ProgramID`, `ProgramName`) VALUES
(8, 'TELLER BAKTI TD 1'),
(52, 'TELLER BAKTI TD 2'),
(53, 'TELLER BAKTI MAHIR'),
(54, 'TELLER BAKTI TERAMPIL'),
(55, 'PFL  TELLER'),
(56, 'PSPO'),
(58, 'CSO BAKTI MAHIR'),
(59, 'CSO BAKTI TERAMPIL'),
(60, 'CSO BAKTI TD 1'),
(61, 'CSO BAKTI TD 2'),
(62, 'PFL CSO'),
(63, 'PAO'),
(64, 'PRO'),
(65, 'PAK'),
(66, 'PAI'),
(67, 'AO INTERNAL'),
(68, 'IMPLEMENTASI SALES MANAGEMENT'),
(69, 'APLIKASI SUPPLY CHAIN'),
(70, 'NPL'),
(71, 'COMMERCIAL LOAN TO BUSINESS'),
(72, 'MINIMIZING PROBLEM LOAN'),
(73, 'CASA'),
(74, 'REFRESHMENT TRADE AND REMMITANCE'),
(75, 'RO INTERNAL'),
(76, 'HIGH IMPACT PRESENTATION'),
(77, 'LEADING ACROSS GENERATION'),
(78, 'KAIZEN'),
(79, 'REGULER'),
(80, 'BUILDING CONNECTION AT WORK'),
(81, 'CONSULTATIVE SKILL'),
(82, 'IT TRAINEE'),
(83, 'PPA'),
(84, 'PPTI'),
(85, 'TTT DELIVERY'),
(86, 'TTT CONTENT'),
(87, 'IDENTIFIKASI BANKNOTES'),
(88, 'PEMAHAMAN LAPORAN KEUANGAN'),
(89, 'SOC'),
(90, 'KARIR - P2M UTAMA'),
(91, 'CS SOLUSI '),
(92, 'BIT'),
(94, 'PBI'),
(95, 'KARIR - P2M MADYA'),
(96, 'KARIR - P2M MUDA II'),
(97, 'KARIR - P2M MUDA I CABANG'),
(98, 'KARIR - P2M MUDA I KP'),
(99, 'KARIR - KEPALA KCP'),
(100, 'WORK LIFE BALANCE');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `Roles` varchar(100) NOT NULL,
  `Description` varchar(100) NOT NULL,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`RoleID`, `Roles`, `Description`) VALUES
(1, 'MasterAdmin', 'Developers and high-Administrator'),
(2, 'Koor', ''),
(3, 'Admin Koor', ''),
(4, 'Checker', '');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `RoomID` int(11) NOT NULL AUTO_INCREMENT,
  `RoomName` varchar(100) NOT NULL,
  PRIMARY KEY (`RoomID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`RoomID`, `RoomName`) VALUES
(7, 'A101'),
(8, 'A102'),
(9, 'A103'),
(10, 'A201'),
(11, 'A202'),
(12, 'A203'),
(13, 'A204'),
(14, 'A205'),
(15, 'A206'),
(16, 'A301'),
(17, 'A302'),
(18, 'A303'),
(19, 'A304'),
(20, 'A305'),
(21, 'A306'),
(22, 'A307'),
(23, 'A5-BANK MINI TELLER'),
(24, 'A5-BANK MINI CSO'),
(25, 'A501'),
(27, 'A502'),
(28, 'A503'),
(29, 'A6-BANK MINI TELLER'),
(30, 'A6-BANK MINI CSO'),
(31, 'A601'),
(32, 'A602'),
(33, 'B101'),
(34, 'B102'),
(36, 'B100.2 ASSESSMENT ROOM'),
(37, 'B100.1 ASSESSMENT ROOM'),
(38, 'B100.3 ASSESSMENT ROOM'),
(39, 'B100.4 ASSESSMENT ROOM'),
(40, 'B100.5 ASSESSMENT ROOM'),
(41, 'B100.6 ASSESSMENT ROOM'),
(42, 'B100.7 ASSESSMENT ROOM'),
(43, 'B103'),
(44, 'B201'),
(45, 'B202'),
(46, 'B203'),
(47, 'B204'),
(48, 'B205'),
(49, 'B301'),
(50, 'B302'),
(51, 'B303'),
(52, 'B501'),
(53, 'B502'),
(54, 'B503'),
(55, 'B504'),
(56, 'B505'),
(57, 'B506'),
(58, 'A701 K.KOMPUTER'),
(59, 'A702 K.KOMPUTER'),
(60, 'A703 K.KOMPUTER'),
(61, 'A704 K.KOMPUTER'),
(62, 'A705 K.KOMPUTER'),
(63, 'A706 K.KOMPUTER'),
(64, 'A707 K.KOMPUTER'),
(65, 'A708 K.KOMPUTER'),
(66, 'A800 K.LAB KOMPUTER'),
(67, 'A801 K.THEATER'),
(68, 'A802 K.THEATER'),
(69, 'A803 K.THEATER'),
(70, 'A901 K.THEATER'),
(71, 'A902 K.THEATER'),
(72, 'A903 K.THEATER'),
(73, 'A904 K.THEATER'),
(74, 'A905 K.THEATER'),
(75, 'A1001 K.THEATER'),
(76, 'A1002 K.THEATER'),
(77, 'A1003 K.THEATER'),
(78, 'A1004 K.THEATER');

-- --------------------------------------------------------

--
-- Table structure for table `shuttlepoints`
--

DROP TABLE IF EXISTS `shuttlepoints`;
CREATE TABLE IF NOT EXISTS `shuttlepoints` (
  `ShuttlePointID` int(11) NOT NULL AUTO_INCREMENT,
  `PointName` varchar(100) NOT NULL,
  PRIMARY KEY (`ShuttlePointID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `shuttlepoints`
--

INSERT INTO `shuttlepoints` (`ShuttlePointID`, `PointName`) VALUES
(1, 'Alam Sutera'),
(2, 'Wisma Asia'),
(3, 'Kelapa Gading'),
(4, 'Bekasi'),
(7, 'Bogor'),
(8, 'Pondok Indah');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `RoleID` int(11) NOT NULL,
  `NamaDepan` varchar(100) NOT NULL,
  `NamaBelakang` varchar(100) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `ProfilePict` varchar(100) NOT NULL,
  `Status` varchar(100) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `RoleID`, `NamaDepan`, `NamaBelakang`, `Gender`, `Email`, `Username`, `Password`, `ProfilePict`, `Status`) VALUES
(1, 1, 'shinta', 'nacha ria', 'Male', 'nacha_sangha@bca.co.id', 'sinar', '54321', '', ''),
(2, 2, 'Nurmayanto', 'Sulaeman', 'Male', 'nurmayanto_sulaeman@bca.co.id 	', 'anto', '12345', '', ''),
(4, 3, 'Rina', 'Chandra', 'Female', 'rina_chandra@bca.co.id', 'rina', '15157', '', ''),
(5, 2, 'Cynthia', 'Poetriana', 'Female', 'cynthia_poetriana@bca.co.id', 'Cynthiap', '12345', '', ''),
(6, 3, 'Kusniati', 'Amalia', 'Female', 'kusniati_amalia@bca.co.id', 'Nia', '121212', '', ''),
(7, 2, 'Selfi', 'Liyanti', 'Female', 'selfi_liyanti@bca.co.id', 'Selfi', '12345', '', ''),
(8, 2, 'Lia', 'Amalia', 'Female', 'lia_amalia@bca.co.id', 'Lia', '010203', '', ''),
(9, 2, 'Syaiful', 'Bachri', 'Male', 'syaiful_bachri@bca.co.id', 'Syaiful', '147369', '', ''),
(10, 2, 'Rifki', 'Aditria', 'Male', 'rifki_aditria@bca.co.id', 'Rifki', 'BISMILLAH123', '', ''),
(11, 2, 'Masud', 'Sudin', 'Male', 'masud_sudin@bca.co.id', 'masud', 'MSD', '', ''),
(12, 2, 'Eka', 'Muheri', 'Female', 'eka_muheri@bca.co.id', 'eka', '12345', '', ''),
(13, 2, 'Muhamad', 'Basori', 'Male', 'muhamad_basori@bca.co.id', 'Basori', '12345', '', ''),
(14, 2, 'Rachmawati', 'Syah', 'Female', 'rachmawati_syah@bca.co.id', 'rachma', 'rachma', '', ''),
(15, 2, 'Tiur', 'Sianipar', 'Female', 'tiur_sianipar@bca.co.id', 'tiur', 'tisia18', '', ''),
(16, 4, 'Sri', 'Suhaity', 'Female', 'sri_suhaity@bca.co.id', 'haity', '12345', '', ''),
(17, 2, 'Glora', 'Tio', 'Female', 'glora_tio@bca.co.id', 'Glora', '12345', '', ''),
(19, 2, 'Nacha', 'Ariya Sangha', 'Male', 'nacha_sangha@bca.co.id', 'NACHA', '12345', '', ''),
(20, 2, 'Michelle', 'Tanuwijaya', 'Female', 'michelle_tanuwijaya@bca.co.id', 'Michelle', '12345', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
