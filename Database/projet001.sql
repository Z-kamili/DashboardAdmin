-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 23, 2020 at 05:47 PM
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
-- Database: `projet001`
--

-- --------------------------------------------------------

--
-- Table structure for table `acceszone`
--

DROP TABLE IF EXISTS `acceszone`;
CREATE TABLE IF NOT EXISTS `acceszone` (
  `idPersonnel` int(11) NOT NULL,
  `idZone` int(11) NOT NULL,
  KEY `fk_accesZone_zone` (`idZone`),
  KEY `fk_accesZone_personnel` (`idPersonnel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acceszone`
--

INSERT INTO `acceszone` (`idPersonnel`, `idZone`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(3, 1),
(3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `acceszonetemp`
--

DROP TABLE IF EXISTS `acceszonetemp`;
CREATE TABLE IF NOT EXISTS `acceszonetemp` (
  `idAccesZT` int(11) NOT NULL AUTO_INCREMENT,
  `raisonAccesZT` text COLLATE utf8_unicode_ci NOT NULL,
  `dateD_AccesZT` datetime NOT NULL,
  `dateF_AccesZT` datetime NOT NULL,
  `idPersonnel` int(11) NOT NULL,
  `idZone` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idAccesZT`),
  KEY `fk_accesZoneTemp_personnel` (`idPersonnel`),
  KEY `fk_accesZoneTemp_zone` (`idZone`),
  KEY `fk_accesZoneTemp_utilisateur` (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acceszonetemp`
--

INSERT INTO `acceszonetemp` (`idAccesZT`, `raisonAccesZT`, `dateD_AccesZT`, `dateF_AccesZT`, `idPersonnel`, `idZone`, `idUtilisateur`) VALUES
(1, 'raison', '2020-10-13 20:00:00', '2020-10-13 22:00:00', 2, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `Email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `access` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Email`, `password`, `access`) VALUES
('admin99@gmail.com', 'Te$t2022', 1),
('Ahmed@gmail.com', '123456', 0),
('Mohammed@gmail.com', '12345678', 0);

-- --------------------------------------------------------

--
-- Table structure for table `broker`
--

DROP TABLE IF EXISTS `broker`;
CREATE TABLE IF NOT EXISTS `broker` (
  `idBroker` int(11) NOT NULL AUTO_INCREMENT,
  `macBroker` char(17) COLLATE utf8_unicode_ci NOT NULL,
  `typeBroker` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idZone` int(11) DEFAULT NULL,
  PRIMARY KEY (`idBroker`),
  UNIQUE KEY `macBroker` (`macBroker`),
  KEY `fk_broker_zone` (`idZone`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `broker`
--

INSERT INTO `broker` (`idBroker`, `macBroker`, `typeBroker`, `idZone`) VALUES
(1, '95-43-C8-3B-C0-0A', 'pointage', 1),
(2, '8C-5D-24-D4-A8-BF', 'zone', 3),
(3, 'FE-36-54-95-BD-74', 'zone', 2),
(5, '0B-88-A4-66-0E-A0', 'zone', 3);

-- --------------------------------------------------------

--
-- Table structure for table `convergence`
--

DROP TABLE IF EXISTS `convergence`;
CREATE TABLE IF NOT EXISTS `convergence` (
  `idConvergence` int(11) NOT NULL AUTO_INCREMENT,
  `dateConvergence` datetime NOT NULL,
  `distanceConvergence` float NOT NULL,
  `idBroker` int(11) DEFAULT NULL,
  `idPersonnel` int(11) DEFAULT NULL,
  `idPersonnel_2` int(11) DEFAULT NULL,
  PRIMARY KEY (`idConvergence`),
  KEY `fk_convergence_broker` (`idBroker`),
  KEY `fk_convergence_personnel` (`idPersonnel`),
  KEY `fk_convergence_idPersonnel2` (`idPersonnel_2`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `convergence`
--

INSERT INTO `convergence` (`idConvergence`, `dateConvergence`, `distanceConvergence`, `idBroker`, `idPersonnel`, `idPersonnel_2`) VALUES
(26, '2020-10-10 10:10:10', 1.2, 5, 1, 2),
(27, '2020-10-10 10:10:10', 0.5, 5, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `historique`
--

DROP TABLE IF EXISTS `historique`;
CREATE TABLE IF NOT EXISTS `historique` (
  `idHistorique` int(11) NOT NULL AUTO_INCREMENT,
  `actionHistorique` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `dateHistorique` datetime DEFAULT NULL,
  `idPersonnel` int(11) NOT NULL,
  PRIMARY KEY (`idHistorique`),
  KEY `fk_historique_personnel` (`idPersonnel`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `historique`
--
DROP TRIGGER IF EXISTS `historique_defaultDateTime`;
DELIMITER $$
CREATE TRIGGER `historique_defaultDateTime` BEFORE INSERT ON `historique` FOR EACH ROW SET NEW.dateHistorique = now()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `idNotification` int(11) NOT NULL AUTO_INCREMENT,
  `sujetNotification` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `dateNotification` datetime NOT NULL,
  `idBroker` int(11) DEFAULT NULL,
  `idPersonnel` int(11) DEFAULT NULL,
  PRIMARY KEY (`idNotification`),
  KEY `fk_notification_broker` (`idBroker`),
  KEY `fk_notification_personnel` (`idPersonnel`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`idNotification`, `sujetNotification`, `dateNotification`, `idBroker`, `idPersonnel`) VALUES
(4, 'br_na_brace', '2020-10-13 21:32:47', 1, NULL),
(5, 'br_na_z', '2020-10-15 00:30:16', 1, 3),
(6, 'br_na_z', '2020-10-15 00:31:51', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
CREATE TABLE IF NOT EXISTS `personnel` (
  `idPersonnel` int(11) NOT NULL AUTO_INCREMENT,
  `cinPersonnel` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `nomPersonnel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prenomPersonnel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telPersonnel` int(11) NOT NULL,
  `dateNaisPersonnel` date NOT NULL,
  `departementPersonnel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `macBracelet` char(17) COLLATE utf8_unicode_ci NOT NULL,
  `pointsPersonnel` int(11) NOT NULL,
  `onlinePersonnel` tinyint(1) NOT NULL,
  PRIMARY KEY (`idPersonnel`),
  UNIQUE KEY `cinPersonnel` (`cinPersonnel`),
  UNIQUE KEY `macBracelet` (`macBracelet`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`idPersonnel`, `cinPersonnel`, `nomPersonnel`, `prenomPersonnel`, `telPersonnel`, `dateNaisPersonnel`, `departementPersonnel`, `macBracelet`, `pointsPersonnel`, `onlinePersonnel`) VALUES
(1, 'FF953785', 'EL MERNISSI', 'Anouar', 663865410, '1982-02-04', 'dep_1', '66-68-7C-6B-58-8F', 1003, 1),
(2, 'FK74333', 'AATIFF', 'Brahime', 664780929, '1976-10-11', 'dep_1', '7E-0E-95-27-13-3E', 2002, 1),
(3, 'H426165', 'MAROUANE', 'Abdelmotalib', 653325549, '1982-11-06', 'dep_1', '17-DE-36-70-58-A9', 1000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

DROP TABLE IF EXISTS `record`;
CREATE TABLE IF NOT EXISTS `record` (
  `idRecord` int(11) NOT NULL AUTO_INCREMENT,
  `battementCoeur` int(11) NOT NULL,
  `temperature` int(11) NOT NULL,
  `oxygene` float NOT NULL,
  `dateRecord` datetime NOT NULL,
  `idBroker` int(11) DEFAULT NULL,
  `idPersonnel` int(11) DEFAULT NULL,
  PRIMARY KEY (`idRecord`),
  KEY `fk_record_broer` (`idBroker`),
  KEY `fk_record_personnel` (`idPersonnel`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recordpoints`
--

DROP TABLE IF EXISTS `recordpoints`;
CREATE TABLE IF NOT EXISTS `recordpoints` (
  `idRecordPoints` int(11) NOT NULL AUTO_INCREMENT,
  `raisonRecordPoints` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `dateRecordPoints` datetime NOT NULL,
  `nbPoints` int(11) NOT NULL,
  `idBroker` int(11) DEFAULT NULL,
  `idPersonnel` int(11) DEFAULT NULL,
  PRIMARY KEY (`idRecordPoints`),
  KEY `fk_recordPoints_broker` (`idBroker`),
  KEY `fk_recordPoints_personnel` (`idPersonnel`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `recordpoints`
--

INSERT INTO `recordpoints` (`idRecordPoints`, `raisonRecordPoints`, `dateRecordPoints`, `nbPoints`, `idBroker`, `idPersonnel`) VALUES
(43, 'Ne pas maintenir la distance sociale', '2020-10-15 15:10:38', -5, 5, 1),
(44, 'Ne pas maintenir la distance sociale', '2020-10-15 15:10:38', -5, 5, 2),
(46, 'Ne pas maintenir la distance sociale', '2020-10-15 15:10:38', -15, 5, 1),
(47, 'Ne pas maintenir la distance sociale', '2020-10-15 15:10:38', -15, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `emailUtilisateur` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `roleUtilisateur` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `passUtilisateur` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `idPersonnel` int(11) NOT NULL,
  PRIMARY KEY (`idUtilisateur`),
  KEY `fk_utilisateur_personnel` (`idPersonnel`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `emailUtilisateur`, `roleUtilisateur`, `passUtilisateur`, `idPersonnel`) VALUES
(1, 'test@gmail.com', 'admin', 'azerty', 3);

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

DROP TABLE IF EXISTS `zone`;
CREATE TABLE IF NOT EXISTS `zone` (
  `idZone` int(11) NOT NULL AUTO_INCREMENT,
  `labelZone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idZone`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`idZone`, `labelZone`) VALUES
(1, 'zone_1'),
(2, 'zone_2'),
(3, 'zone_3'),
(4, 'zone_4');

-- --------------------------------------------------------

--
-- Table structure for table `zonelog`
--

DROP TABLE IF EXISTS `zonelog`;
CREATE TABLE IF NOT EXISTS `zonelog` (
  `idZoneLog` int(11) NOT NULL AUTO_INCREMENT,
  `dateZoneLog` datetime NOT NULL,
  `compteurZoneLog` int(11) NOT NULL,
  `idPersonnel` int(11) NOT NULL,
  `idBroker` int(11) NOT NULL,
  PRIMARY KEY (`idZoneLog`),
  KEY `fk_zoneLog_personnel` (`idPersonnel`),
  KEY `fk_zoneLog_broker` (`idBroker`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zonelog`
--

INSERT INTO `zonelog` (`idZoneLog`, `dateZoneLog`, `compteurZoneLog`, `idPersonnel`, `idBroker`) VALUES
(40, '2020-10-15 00:01:18', 0, 3, 5),
(41, '2020-10-15 00:02:09', 595, 3, 5),
(42, '2020-10-15 00:28:51', 600, 3, 5),
(43, '2020-10-15 00:31:41', 4, 3, 5);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acceszone`
--
ALTER TABLE `acceszone`
  ADD CONSTRAINT `fk_accesZone_personnel` FOREIGN KEY (`idPersonnel`) REFERENCES `personnel` (`idPersonnel`),
  ADD CONSTRAINT `fk_accesZone_zone` FOREIGN KEY (`idZone`) REFERENCES `zone` (`idZone`);

--
-- Constraints for table `acceszonetemp`
--
ALTER TABLE `acceszonetemp`
  ADD CONSTRAINT `fk_accesZoneTemp_personnel` FOREIGN KEY (`idPersonnel`) REFERENCES `personnel` (`idPersonnel`),
  ADD CONSTRAINT `fk_accesZoneTemp_utilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`),
  ADD CONSTRAINT `fk_accesZoneTemp_zone` FOREIGN KEY (`idZone`) REFERENCES `zone` (`idZone`);

--
-- Constraints for table `broker`
--
ALTER TABLE `broker`
  ADD CONSTRAINT `fk_broker_zone` FOREIGN KEY (`idZone`) REFERENCES `zone` (`idZone`);

--
-- Constraints for table `convergence`
--
ALTER TABLE `convergence`
  ADD CONSTRAINT `fk_convergence_broker` FOREIGN KEY (`idBroker`) REFERENCES `broker` (`idBroker`),
  ADD CONSTRAINT `fk_convergence_idPersonnel2` FOREIGN KEY (`idPersonnel_2`) REFERENCES `personnel` (`idPersonnel`),
  ADD CONSTRAINT `fk_convergence_personnel` FOREIGN KEY (`idPersonnel`) REFERENCES `personnel` (`idPersonnel`);

--
-- Constraints for table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `fk_historique_personnel` FOREIGN KEY (`idPersonnel`) REFERENCES `personnel` (`idPersonnel`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `fk_notification_broker` FOREIGN KEY (`idBroker`) REFERENCES `broker` (`idBroker`),
  ADD CONSTRAINT `fk_notification_personnel` FOREIGN KEY (`idPersonnel`) REFERENCES `personnel` (`idPersonnel`);

--
-- Constraints for table `record`
--
ALTER TABLE `record`
  ADD CONSTRAINT `fk_record_broer` FOREIGN KEY (`idBroker`) REFERENCES `broker` (`idBroker`),
  ADD CONSTRAINT `fk_record_personnel` FOREIGN KEY (`idPersonnel`) REFERENCES `personnel` (`idPersonnel`);

--
-- Constraints for table `recordpoints`
--
ALTER TABLE `recordpoints`
  ADD CONSTRAINT `fk_recordPoints_broker` FOREIGN KEY (`idBroker`) REFERENCES `broker` (`idBroker`),
  ADD CONSTRAINT `fk_recordPoints_personnel` FOREIGN KEY (`idPersonnel`) REFERENCES `personnel` (`idPersonnel`);

--
-- Constraints for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `fk_utilisateur_personnel` FOREIGN KEY (`idPersonnel`) REFERENCES `personnel` (`idPersonnel`);

--
-- Constraints for table `zonelog`
--
ALTER TABLE `zonelog`
  ADD CONSTRAINT `fk_zoneLog_broker` FOREIGN KEY (`idBroker`) REFERENCES `broker` (`idBroker`),
  ADD CONSTRAINT `fk_zoneLog_personnel` FOREIGN KEY (`idPersonnel`) REFERENCES `personnel` (`idPersonnel`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
