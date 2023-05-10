-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 10 mai 2023 à 22:04
-- Version du serveur : 8.0.32-0ubuntu0.22.04.2
-- Version de PHP : 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `XOPENDSN`
--

-- --------------------------------------------------------

--
-- Structure de la table `CSGCRDS`
--

CREATE TABLE `CSGCRDS` (
  `ID` int NOT NULL,
  `ANNEE` year NOT NULL,
  `CSG` float NOT NULL,
  `CRDS` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CSGCRDS`
--

INSERT INTO `CSGCRDS` (`ID`, `ANNEE`, `CSG`, `CRDS`) VALUES
(1, 2023, 2.4, 0.5);

-- --------------------------------------------------------

--
-- Structure de la table `PMSS`
--

CREATE TABLE `PMSS` (
  `ID_PMSS` int NOT NULL,
  `PMSS` float NOT NULL,
  `ANNEE` year NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `PMSS`
--

INSERT INTO `PMSS` (`ID_PMSS`, `PMSS`, `ANNEE`) VALUES
(1, 3666, 2023);

-- --------------------------------------------------------

--
-- Structure de la table `RUAA`
--

CREATE TABLE `RUAA` (
  `ID_RUAA` int NOT NULL,
  `BASE` int NOT NULL,
  `PS` float NOT NULL,
  `PP` float NOT NULL,
  `LIBELLE` text COLLATE utf8mb4_general_ci NOT NULL,
  `RUBRIQUE` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `RUAA`
--

INSERT INTO `RUAA` (`ID_RUAA`, `BASE`, `PS`, `PP`, `LIBELLE`, `RUBRIQUE`) VALUES
(1, 2, 3.15, 4.72, 'Complémentaire Tranche 1', 3),
(2, 2, 0.86, 1.29, 'Complémentaire Tranche 1 – CEG', 3),
(3, 3, 8.64, 12.95, 'Complémentaire Tranche 2', 3),
(4, 3, 1.08, 1.62, 'Complémentaire Tranche 2 – CEG', 3),
(8, 3, 0.14, 0.21, 'Contribution technique (CET) - Tranche 1 et Tranche 2', 3),
(9, 2, 0.024, 0.036, 'APEC - Tranche 1', 5),
(10, 3, 0.024, 0.036, 'APEC - Tranche 2', 5);

-- --------------------------------------------------------

--
-- Structure de la table `RUAA_BASE`
--

CREATE TABLE `RUAA_BASE` (
  `ID_RUAA_BASE` int NOT NULL,
  `RUAA_BASE` text COLLATE utf8mb4_general_ci NOT NULL,
  `ASSIETTE` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `RUAA_BASE`
--

INSERT INTO `RUAA_BASE` (`ID_RUAA_BASE`, `RUAA_BASE`, `ASSIETTE`) VALUES
(2, 'Tranche 1 (jusqu’à 1 PMSS)', 921),
(3, 'Tranche 2 (de 1 PMSS jusqu\'à 8 PMSS) ', 920);

-- --------------------------------------------------------

--
-- Structure de la table `RUBRIQUE`
--

CREATE TABLE `RUBRIQUE` (
  `ID_RUBRIQUE` int NOT NULL,
  `RUBRIQUE` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `RUBRIQUE`
--

INSERT INTO `RUBRIQUE` (`ID_RUBRIQUE`, `RUBRIQUE`) VALUES
(1, 'SANTÉ'),
(2, 'ACCIDENTS DU TRAVAIL'),
(3, 'RETRAITE'),
(4, 'FAMILLE - SÉCURITÉ SOCIALE'),
(5, 'ASSURANCE CHÔMAGE'),
(6, 'AUTRES CONTRIBUTIONS EMPLOYEUR'),
(7, 'AUTRES CONTRIBUTIONS SALARIÉ');

-- --------------------------------------------------------

--
-- Structure de la table `SALAIRE`
--

CREATE TABLE `SALAIRE` (
  `ID_SALAIRE` int NOT NULL,
  `DATE` date NOT NULL,
  `REGLEMENT` text COLLATE utf8mb4_general_ci NOT NULL,
  `BRUT` float NOT NULL,
  `NET` float DEFAULT NULL,
  `NETNET` float DEFAULT NULL,
  `PMSS` float NOT NULL,
  `T1` float NOT NULL,
  `T2` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `SALAIRE`
--

INSERT INTO `SALAIRE` (`ID_SALAIRE`, `DATE`, `REGLEMENT`, `BRUT`, `NET`, `NETNET`, `PMSS`, `T1`, `T2`) VALUES
(4, '2023-04-01', 'C123567', 50, 39.56, 35.46, 50, 50, 0),
(8, '2023-04-01', 'C123567', 50, 39.56, 35.46, 50, 50, 0),
(9, '2023-04-01', 'C123567', 50, 39.56, 35.46, 50, 50, 0),
(10, '2023-04-01', 'C123567', 50, 39.56, 35.46, 50, 50, 0),
(11, '2023-04-01', 'C123567', 50, 39.56, 35.46, 50, 50, 0),
(12, '2023-04-01', 'C123567', 50, 39.56, 35.46, 50, 50, 0),
(13, '2023-04-01', 'C123567', 50, 39.56, 35.46, 50, 50, 0),
(14, '2023-04-01', 'C123567', 50, 39.56, 35.46, 50, 50, 0),
(15, '2023-04-01', 'C123567', 50, 39.56, 35.46, 50, 50, 0),
(16, '2023-04-01', 'C123567', 50, 39.56, 35.46, 50, 50, 0),
(17, '2023-04-01', 'C123567', 50, 39.56, 35.46, 50, 50, 0),
(18, '2023-04-01', 'C123567', 50, 39.56, 35.46, 50, 50, 0),
(19, '2023-04-01', 'C123567', 50, 39.56, 35.46, 50, 50, 0),
(20, '2023-04-01', 'C123567', 50, 39.56, 35.46, 50, 50, 0),
(21, '2023-04-01', 'C123567', 50, 39.56, 35.46, 50, 50, 0),
(22, '2023-04-01', 'C123567', 50, 39.56, 35.46, 50, 50, 0),
(23, '2023-04-01', 'C123567', 50, 39.56, 35.46, 50, 50, 0),
(24, '2023-04-01', 'C123567', 50, 39.56, 35.46, 50, 50, 0),
(25, '2023-04-01', 'C123567', 50, 39.56, 35.46, 50, 50, 0);

-- --------------------------------------------------------

--
-- Structure de la table `URSSAF`
--

CREATE TABLE `URSSAF` (
  `ID_URSSAF` int NOT NULL,
  `CTP` int NOT NULL,
  `CI` int NOT NULL,
  `BASE` int NOT NULL,
  `PS` float NOT NULL,
  `PP` float NOT NULL,
  `LIBELLE` text COLLATE utf8mb4_general_ci NOT NULL,
  `RUBRIQUE` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `URSSAF`
--

INSERT INTO `URSSAF` (`ID_URSSAF`, `CTP`, `CI`, `BASE`, `PS`, `PP`, `LIBELLE`, `RUBRIQUE`) VALUES
(1, 863, 75, 3, 0, 7, 'Sécurité Sociale Maladie Maternité Invalidité Décès', 1),
(2, 635, 907, 3, 0, 6, 'Complément cotisation maladie', 1),
(3, 863, 45, 3, 0, 1.25, 'Accident du travail - maladies professionnelles', 2),
(4, 863, 76, 2, 6.9, 8.55, 'Sécurité sociale plafonnée', 3),
(5, 863, 76, 3, 0.4, 1.9, 'Sécurité sociale déplafonnée', 3),
(6, 863, 74, 3, 0, 3.45, 'Allocations familiales', 4),
(7, 863, 102, 3, 0, 1.8, 'Allocations familiales - complément de cotisation', 4),
(8, 863, 68, 3, 0, 0.3, 'Contribution à la solidarité et l\'autonomie', 6),
(9, 332, 49, 2, 0, 0.1, 'Contribution à l\'aide au logement', 6),
(10, 992, 130, 3, 0, 0.59, 'Contribution à l\'apprentissage', 6),
(11, 995, 76, 3, 0, 0.09, 'Contribution à l\'apprentissage - solde', 6),
(12, 959, 128, 3, 0, 0.55, 'Contribution à la formation continue', 6),
(13, 260, 72, 4, 6.8, 0, 'CSG non imposable à l’impôt sur le revenu', 7),
(14, 260, 72, 4, 2.4, 0, 'CSG imposable à l\'impôt sur le revenu', 7),
(15, 260, 79, 4, 0.5, 0, 'CRDS imposable à l\'impôt sur le revenu', 7);

-- --------------------------------------------------------

--
-- Structure de la table `URSSAF_BASE`
--

CREATE TABLE `URSSAF_BASE` (
  `ID_URSSAF_BASE` int NOT NULL,
  `URSSAF_BASE` text COLLATE utf8mb4_general_ci NOT NULL,
  `ASSIETTE` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `URSSAF_BASE`
--

INSERT INTO `URSSAF_BASE` (`ID_URSSAF_BASE`, `URSSAF_BASE`, `ASSIETTE`) VALUES
(2, 'Assiette brute plafonnée', 921),
(3, 'Assiette brute déplafonnée', 920),
(4, 'Assiette de la contribution sociale généralisée', 920);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `CSGCRDS`
--
ALTER TABLE `CSGCRDS`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Index pour la table `PMSS`
--
ALTER TABLE `PMSS`
  ADD PRIMARY KEY (`ID_PMSS`);

--
-- Index pour la table `RUAA`
--
ALTER TABLE `RUAA`
  ADD PRIMARY KEY (`ID_RUAA`),
  ADD UNIQUE KEY `ID_RUAA` (`ID_RUAA`),
  ADD KEY `RUBRIQUE` (`RUBRIQUE`),
  ADD KEY `BASE` (`BASE`);

--
-- Index pour la table `RUAA_BASE`
--
ALTER TABLE `RUAA_BASE`
  ADD UNIQUE KEY `ID_RUAA_BASE` (`ID_RUAA_BASE`);

--
-- Index pour la table `RUBRIQUE`
--
ALTER TABLE `RUBRIQUE`
  ADD PRIMARY KEY (`ID_RUBRIQUE`),
  ADD UNIQUE KEY `ID_RUBRIQUE` (`ID_RUBRIQUE`);

--
-- Index pour la table `SALAIRE`
--
ALTER TABLE `SALAIRE`
  ADD PRIMARY KEY (`ID_SALAIRE`);

--
-- Index pour la table `URSSAF`
--
ALTER TABLE `URSSAF`
  ADD PRIMARY KEY (`ID_URSSAF`),
  ADD UNIQUE KEY `ID_URSSAF` (`ID_URSSAF`),
  ADD KEY `RUBRIQUE` (`RUBRIQUE`),
  ADD KEY `URSSAF_ibfk_2` (`BASE`);

--
-- Index pour la table `URSSAF_BASE`
--
ALTER TABLE `URSSAF_BASE`
  ADD UNIQUE KEY `ID_URSSAF_BASE` (`ID_URSSAF_BASE`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `PMSS`
--
ALTER TABLE `PMSS`
  MODIFY `ID_PMSS` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `RUAA`
--
ALTER TABLE `RUAA`
  MODIFY `ID_RUAA` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `RUBRIQUE`
--
ALTER TABLE `RUBRIQUE`
  MODIFY `ID_RUBRIQUE` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `SALAIRE`
--
ALTER TABLE `SALAIRE`
  MODIFY `ID_SALAIRE` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `URSSAF`
--
ALTER TABLE `URSSAF`
  MODIFY `ID_URSSAF` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `RUAA`
--
ALTER TABLE `RUAA`
  ADD CONSTRAINT `RUAA_ibfk_1` FOREIGN KEY (`RUBRIQUE`) REFERENCES `RUBRIQUE` (`ID_RUBRIQUE`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `RUAA_ibfk_2` FOREIGN KEY (`BASE`) REFERENCES `RUAA_BASE` (`ID_RUAA_BASE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `URSSAF`
--
ALTER TABLE `URSSAF`
  ADD CONSTRAINT `URSSAF_ibfk_1` FOREIGN KEY (`RUBRIQUE`) REFERENCES `RUBRIQUE` (`ID_RUBRIQUE`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `URSSAF_ibfk_2` FOREIGN KEY (`BASE`) REFERENCES `URSSAF_BASE` (`ID_URSSAF_BASE`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
