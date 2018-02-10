-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  sam. 10 fév. 2018 à 13:29
-- Version du serveur :  10.1.30-MariaDB
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `travian_artefact`
--
CREATE DATABASE IF NOT EXISTS `travian_artefact` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `travian_artefact`;

-- --------------------------------------------------------

--
-- Structure de la table `artefacts`
--

CREATE TABLE `artefacts` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nom` varchar(100) NOT NULL,
  `x` smallint(6) NOT NULL,
  `y` smallint(6) NOT NULL,
  `type` enum('mineur','majeur','unique') NOT NULL,
  `valider` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `artefacts`
--

INSERT INTO `artefacts` (`id`, `nom`, `x`, `y`, `type`, `valider`) VALUES
(1, 'Bénédiction de Bastet  I', -73, 107, 'majeur', 0),
(2, 'Bénédiction de Bastet  II', 81, 11, 'majeur', 1),
(3, 'Bénédiction de Bastet  III', -88, 28, 'majeur', 0),
(4, 'Bénédiction de Bastet  IV', -89, -58, 'majeur', 0),
(5, 'Vigilance d&#39;Heimdall  V', -105, 170, 'mineur', 0),
(6, 'Vigilance d&#39;Heimdall  VI', 243, 221, 'mineur', 1),
(7, 'Vigilance d&#39;Heimdall  VII', 219, -72, 'mineur', 0),
(8, 'Vigilance d&#39;Heimdall  VIII', 40, 18, 'mineur', 1),
(9, 'Vigilance d&#39;Heimdall  IX', -219, -312, 'mineur', 0),
(10, 'Vigilance d&#39;Heimdall  X', -180, 82, 'mineur', 0),
(11, 'Diadème d&#39;Isis', -37, 76, 'unique', 1),
(12, 'Bénédiction de Sleipnir  I', 21, 84, 'majeur', 0),
(13, 'Bénédiction de Sleipnir  II', 53, -42, 'majeur', 0),
(14, 'Bénédiction de Sleipnir  III', -25, -10, 'majeur', 0),
(15, 'Bénédiction de Sleipnir  IV', -32, 72, 'majeur', 0),
(16, 'Vitalité d&#39;Hermod  V', -49, 135, 'mineur', 0),
(17, 'Vitalité d&#39;Hermod  VI', 96, 103, 'mineur', 0),
(18, 'Vitalité d&#39;Hermod  VII', 258, -63, 'mineur', 0),
(19, 'Vitalité d&#39;Hermod  VIII', 107, -95, 'mineur', 0),
(20, 'Vitalité d&#39;Hermod  IX', -112, -35, 'mineur', 0),
(21, 'Vitalité d&#39;Hermod  X', -152, -39, 'mineur', 0),
(22, 'Plume de Pégase', 101, 100, 'unique', 0),
(23, 'Moisson de Fulla  I', 68, 59, 'majeur', 0),
(24, 'Moisson de Fulla  II', 57, -80, 'majeur', 0),
(25, 'Moisson de Fulla  III', -92, -110, 'majeur', 0),
(26, 'Moisson de Fulla  IV', -71, 82, 'majeur', 0),
(27, 'Offrande de Satet  V', -58, 32, 'mineur', 0),
(28, 'Offrande de Satet  VI', 1, 11, 'mineur', 0),
(29, 'Offrande de Satet  VII', 105, 116, 'mineur', 0),
(30, 'Offrande de Satet  VIII', 72, -43, 'mineur', 0),
(31, 'Offrande de Satet  IX', -63, -141, 'mineur', 0),
(32, 'Offrande de Satet  X', -154, -87, 'mineur', 0),
(33, 'Épis d&#39;or', 58, 0, 'unique', 0),
(34, 'Entraînement selon Fandral  I', 106, 110, 'majeur', 0),
(35, 'Entraînement selon Fandral  II', 38, -99, 'majeur', 0),
(36, 'Entraînement selon Fandral  III', -131, -30, 'majeur', 0),
(37, 'Entraînement selon Fandral  IV', -38, 126, 'majeur', 0),
(38, 'Formation selon Tyr  V', -40, 48, 'mineur', 0),
(39, 'Formation selon Tyr  VI', -121, 65, 'mineur', 0),
(40, 'Formation selon Tyr  VII', 102, 100, 'mineur', 0),
(41, 'Formation selon Tyr  VIII', 136, -93, 'mineur', 0),
(42, 'Formation selon Tyr  IX', 57, -1, 'mineur', 0),
(43, 'Formation selon Tyr  X', -79, -92, 'mineur', 0),
(44, 'Mjöllnir', 37, -100, 'unique', 0),
(45, 'Parchemin d&#39;Horus  I', 40, -100, 'majeur', 0),
(46, 'Parchemin d&#39;Horus  II', -208, -291, 'majeur', 0),
(47, 'Parchemin d&#39;Horus  III', -59, 43, 'majeur', 0),
(48, 'Parchemin d&#39;Horus  IV', 115, 123, 'majeur', 0),
(49, 'Parchemin de Thot  V', -24, -10, 'mineur', 0),
(50, 'Parchemin de Thot  VI', -33, 84, 'mineur', 0),
(51, 'Parchemin de Thot  VII', 77, 38, 'mineur', 0),
(52, 'Parchemin de Thot  VIII', -14, -78, 'mineur', 0),
(53, 'Parchemin de Thot  IX', 102, -129, 'mineur', 0),
(54, 'Parchemin de Thot  X', -73, -75, 'mineur', 0),
(55, 'Cachette d&#39;Odin  I', 50, -180, 'majeur', 0),
(56, 'Cachette d&#39;Odin  II', -116, -29, 'majeur', 0),
(57, 'Cachette d&#39;Odin  III', -68, 100, 'majeur', 0),
(58, 'Cachette d&#39;Odin  IV', 97, 155, 'majeur', 0),
(59, 'Forêt enchantée  V', -141, -32, 'mineur', 0),
(60, 'Forêt enchantée  VI', -71, 97, 'mineur', 0),
(61, 'Forêt enchantée  VII', 30, 82, 'mineur', 0),
(62, 'Forêt enchantée  VIII', 32, -93, 'mineur', 0),
(63, 'Forêt enchantée  IX', 95, -109, 'mineur', 0),
(64, 'Forêt enchantée  X', -62, -140, 'mineur', 0),
(65, 'Livre magique de Thot', 76, -26, 'unique', 1),
(66, 'Vision de Volla  I', -4, -8, 'majeur', 0),
(67, 'Vision de Volla  II', -70, 23, 'majeur', 0),
(68, 'Vision de Volla  III', -40, 65, 'majeur', 0),
(69, 'Vision de Volla  IV', 91, 59, 'majeur', 0),
(70, 'Prophétie de Frea  V', -92, -66, 'mineur', 0),
(71, 'Prophétie de Frea  VI', -93, 36, 'mineur', 0),
(72, 'Prophétie de Frea  VII', -15, 106, 'mineur', 0),
(73, 'Prophétie de Frea  VIII', 50, 64, 'mineur', 0),
(74, 'Prophétie de Frea  IX', -36, -89, 'mineur', 0),
(75, 'Prophétie de Frea  X', 21, -45, 'mineur', 0),
(76, 'L’œil d&#39;Horus', -27, -19, 'unique', 1),
(77, 'Malédiction de Loki', -66, 60, 'mineur', 0),
(78, 'Malédiction de Loki', 46, 218, 'mineur', 0),
(79, 'Malédiction de Loki', 88, 161, 'mineur', 0),
(80, 'Malédiction de Loki', 144, -15, 'mineur', 0),
(81, 'Malédiction de Loki', 127, -131, 'mineur', 0),
(82, 'Malédiction de Loki', 28, -143, 'mineur', 0),
(83, 'Malédiction de Loki', 70, 27, 'mineur', 0),
(84, 'Malédiction de Loki', -139, -87, 'mineur', 0),
(85, 'Malédiction de Loki', -96, 3, 'mineur', 0),
(86, 'Malédiction de Loki', -189, 99, 'mineur', 0),
(87, 'L&#39;Anneau des Nibelungen', -23, -43, 'unique', 1);

-- --------------------------------------------------------

--
-- Structure de la table `village_offensif`
--

CREATE TABLE `village_offensif` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `proprietaire` varchar(40) NOT NULL,
  `x` smallint(6) NOT NULL,
  `y` smallint(6) NOT NULL,
  `pt` tinyint(3) UNSIGNED NOT NULL,
  `bottes` enum('aucune','mercenaire','guerrier','archer') NOT NULL,
  `cible` enum('unique','majeur','mineur','tournante') NOT NULL,
  `cdt` tinyint(3) UNSIGNED NOT NULL,
  `valider` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `artefacts`
--
ALTER TABLE `artefacts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `village_offensif`
--
ALTER TABLE `village_offensif`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `artefacts`
--
ALTER TABLE `artefacts`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT pour la table `village_offensif`
--
ALTER TABLE `village_offensif`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;