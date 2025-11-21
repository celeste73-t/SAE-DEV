-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 21 nov. 2025 à 11:18
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdd_celeste`
--
CREATE DATABASE IF NOT EXISTS bdd_celeste;
USE bdd_celeste;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `chanson`
--

DROP TABLE IF EXISTS `chanson`;
CREATE TABLE IF NOT EXISTS `chanson` (
  `chansonId` int NOT NULL,
  `Titre` varchar(45) DEFAULT NULL,
  `candidat_id` int NOT NULL,
  `Categorie_id` int NOT NULL,
  `compteurVote1` int DEFAULT NULL,
  `compteurVote2` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`chansonId`),
  KEY `fk_chanson_Utilisateur1_idx` (`candidat_id`),
  KEY `fk_chanson_Categorie1_idx` (`Categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

-- --------------------------------------------------------

--
-- Structure de la table `chanson_has_genre`
--

DROP TABLE IF EXISTS `chanson_has_genre`;
CREATE TABLE IF NOT EXISTS `chanson_has_genre` (
  `chanson_chansonId` int NOT NULL,
  `Genre_idGenre` int NOT NULL,
  PRIMARY KEY (`chanson_chansonId`,`Genre_idGenre`),
  KEY `fk_chanson_has_Genre_Genre1_idx` (`Genre_idGenre`),
  KEY `fk_chanson_has_Genre_chanson1_idx` (`chanson_chansonId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contenu` text NOT NULL,
  `utilisateurId` int NOT NULL,
  `postId` int NOT NULL,
  `commentaireId` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utilisateurId` (`utilisateurId`),
  KEY `postId` (`postId`),
  KEY `commentaireId` (`commentaireId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `constante`
--

DROP TABLE IF EXISTS `constante`;
CREATE TABLE IF NOT EXISTS `constante` (
  `id` int NOT NULL AUTO_INCREMENT,
  `startPremierTour` date NOT NULL,
  `endPremierTour` date NOT NULL,
  `startSecondTour` date NOT NULL,
  `endSecondTour` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `idGenre` int NOT NULL,
  `nomDuGenre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idGenre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;