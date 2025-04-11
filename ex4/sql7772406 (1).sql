-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Hôte : sql7.freesqldatabase.com
-- Généré le :  ven. 11 avr. 2025 à 20:43
-- Version du serveur :  5.5.62-0ubuntu0.14.04.1
-- Version de PHP :  7.0.33-0ubuntu0.16.04.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sql7772406`
--

-- --------------------------------------------------------

--
-- Structure de la table `section`
--

CREATE TABLE `section` (
  `id` int(20) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `section`
--

INSERT INTO `section` (`id`, `designation`, `description`) VALUES
(11, 'GL', 'genie_logiciel'),
(22, 'RT', 'Reseau informatique et telecommunications');

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `birthday` date NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `section` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `student`
--

INSERT INTO `student` (`id`, `name`, `birthday`, `image`, `section`) VALUES
(100, 'Skander', '2004-12-10', 'cat.jpg', 11),
(2300166, 'garbâa aziza', '2004-02-06', 'aziza.jpg', 22),
(2300758, 'El manaa amira', '2004-06-07', 'amira.jpg', 11),
(2300958, 'Briki Islem', '2004-10-11', 'islem.jpg', 11);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `cin` int(10) NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `email` varchar(30) CHARACTER SET utf8 NOT NULL,
  `password` varchar(15) CHARACTER SET utf8 NOT NULL,
  `role` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`cin`, `username`, `email`, `password`, `role`) VALUES
(1, 'ziwziw1', 'ziwziw1@gmail.com', '123', 'admin'),
(2, 'ziwziw2', 'ziwziw2@gmail.com', '147', 'user'),
(3, 'amir', 'amir123@gmail.com', '159', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`cin`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `cin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
