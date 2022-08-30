-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mer 16 Octobre 2019 à 19:14
-- Version du serveur: 5.5.8
-- Version de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `libsystem`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(2) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pic` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `pwd`, `firstName`, `lastName`, `mobile`, `email`, `pic`) VALUES
(1, 'feutse', 'feutse', 'Feutse', 'gaetan', '695736963', 'gaetanfeutse@gmail.com', 'IMG_20180804_102342.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customerId` int(4) NOT NULL,
  `title` text NOT NULL,
  `ip` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `available` tinyint(4) NOT NULL,
  PRIMARY KEY (`customerId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `customer`
--

INSERT INTO `customers` (`customerId`, `title`, `ip`, `location`, `status`, `available`) VALUES
(1002, 'ORANGE', '195.125.168.122', 'Yaounde', 'Yaounde', 1),
(1003, 'MTN', '127.195.168.122', 'DOUALA', 'active', 1),
(1004, 'sdsdsd', '127.195.168.122', 'dsd', 'active', 1),
(1005, 'sdsdssd', '127.195.168.122', 'dsdds', 'active', 1);

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(3) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `position` varchar(10) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pic` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `members`
--

INSERT INTO `members` (`id`, `firstName`, `lastName`, `username`, `pwd`, `position`, `mobile`, `email`, `pic`) VALUES
(11, 'Tcheta', 'pascal', 'pascal', 'pascal12', 'employee', '658745414', 'pascal@yahoo.fr', '1554124457584.jpg'),
(12, 'Taning', 'alex', 'alex', 'alex', 'employee', '695458455', 'survey@rewas-app-lex.com', 'IMG_20180804_214509.jpg'),
(13, 'ghost', 'pascal', 'rogkjuytf', 'mlokdiy', 'employee', '654157595', 'flashdan@otkrit-ooo.ru', ''),
(14, 'alextaning', 'ghost', 'gaitan', 'nnnnnn', 'employee', '652451235', 'harrovian@playcard-semi.com', '');

-- --------------------------------------------------------

--
-- Structure de la table `requestforcustomer`
--

CREATE TABLE IF NOT EXISTS `requestforcustomer` (
  `requestId` int(3) NOT NULL,
  `customerName` text NOT NULL,
  `customerip` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `requestDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `requestforcustomer`
--

INSERT INTO `requestforcustomer` (`requestId`, `customerName`, `customerip`, `description`, `requestDate`) VALUES
(11, 'sqsqsq', '125.12.32.25', 'ezezdsds', '2019-10-16 11:50:29'),
(11, 'sqsqsq', '125.12.32.25', 'ezezdsds', '2019-10-16 11:55:03');
