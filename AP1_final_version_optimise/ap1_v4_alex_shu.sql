-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : Dim 27 avr. 2025 à 14:25
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ap1_v4_alex.shu`
--

-- --------------------------------------------------------

--
-- Structure de la table `cr`
--

CREATE TABLE `cr` (
  `num` bigint(20) NOT NULL,
  `date` date DEFAULT NULL,
  `description` text,
  `vu` tinyint(1) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `num_utilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cr`
--

INSERT INTO `cr` (`num`, `date`, `description`, `vu`, `datetime`, `num_utilisateur`) VALUES
(1, '2024-06-02', 'aa &quot;&#039;&quot;é  &#039; ds', 1, '2024-06-01 10:00:00', 3),
(2, '2024-06-02', 'Configuration d\'un réseau local sécurisé avec pare-feu et test de la connectivité.', 0, '2024-06-02 11:00:00', 4),
(3, '2024-06-03', 'Analyse de données clients pour une startup et production de graphiques via Python et PowerBI.', 1, '2024-06-03 12:00:00', 6),
(4, '2024-06-04', 'Développement de nouvelles fonctionnalités pour un site e-commerce en PHP et MySQL.', 1, '2024-06-04 13:30:00', 7),
(5, '2024-06-05', 'Intégration d&#039;une API externe pour récupérer des données en temps réel sur un tableau de bord.', 0, '2024-06-05 14:00:00', 3),
(6, '2024-06-06', 'Mise en place de sauvegardes automatisées pour les serveurs et validation des scripts.', 1, '2024-06-06 15:00:00', 4),
(7, '2024-06-06', 'Création de modèles prédictifs pour analyser les ventes et améliorer les projections financières.1', 0, '2024-06-07 16:00:00', 6),
(9, '2024-12-12', 'Tests', NULL, '2024-12-13 14:52:26', 3),
(10, '2024-06-05', 'Intégration d\'une API externe pour récupérer des données en temps réel sur un tableau de bord.', NULL, '2024-12-13 15:03:56', 3),
(11, '2025-04-27', 'J\'ai fait du Bootstrap.', NULL, '2025-04-27 12:33:17', 3),
(12, '2025-04-28', 'Découverte de React.', NULL, '2025-04-27 15:51:26', 3);

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

CREATE TABLE `stage` (
  `num` int(10) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `CP` int(10) DEFAULT NULL,
  `ville` varchar(40) DEFAULT NULL,
  `tel` int(30) DEFAULT NULL,
  `libelleStage` varchar(500) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `num_tuteur` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `stage`
--

INSERT INTO `stage` (`num`, `nom`, `adresse`, `CP`, `ville`, `tel`, `libelleStage`, `email`, `num_tuteur`) VALUES
(1, 'Stage Développement Web', '123 Rue A', 75001, 'Paris', 123456789, 'Développement d\'un site web pour une entreprise.', 'contact@entrepriseA.com', 2),
(2, 'Stage Réseaux', '456 Rue B', 69002, 'Lyon', 987654321, 'Mise en place d\'infrastructures réseau sécurisées.', 'contact@entrepriseB.com', 1),
(3, 'Stage Data Science', '789 Rue C', 31000, 'Toulouse', 112233445, 'Analyse de données pour une startup.', 'contact@entrepriseC.com', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tuteur`
--

CREATE TABLE `tuteur` (
  `num` int(10) NOT NULL,
  `nom` varchar(40) DEFAULT NULL,
  `prenom` varchar(40) DEFAULT NULL,
  `tel` int(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tuteur`
--

INSERT INTO `tuteur` (`num`, `nom`, `prenom`, `tel`, `email`) VALUES
(1, 'Dupuis', 'Marc', 123123123, 'marc.dupuis@entrepriseA.com'),
(2, 'Lemoine', 'Sophie', 456456456, 'sophie.lemoine@entrepriseB.com'),
(3, 'Giraud', 'Antoine', 789789789, 'antoine.giraud@entrepriseC.com');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `num` int(10) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `tel` int(20) DEFAULT NULL,
  `login` varchar(100) DEFAULT NULL,
  `motdepasse` varchar(100) DEFAULT NULL,
  `type` int(1) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `option` int(1) NOT NULL COMMENT '0 pour ELEVE; 1 pour PROF',
  `num_stage` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`num`, `nom`, `prenom`, `tel`, `login`, `motdepasse`, `type`, `email`, `option`, `num_stage`) VALUES
(1, 'Gravouil', 'Benjamin', 123456789, 'bgravouil', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 'benjamin.gravouil@gmail.com', 0, NULL),
(2, 'Tarif', 'Mohamad', 987654321, 'mtarif', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 'mohamad.tarif@example.com', 0, NULL),
(3, 'Bérnard', 'Léa', 111222333, 'lbernard', '5f4dcc3b5aa765d61d8327deb882cf99', 0, 'lea.bernard@gmail.com', 1, 1),
(4, 'Lambert', 'Lucas', 222333444, 'llambert', '5f4dcc3b5aa765d61d8327deb882cf99', 0, 'lucas.lambert@example.com', 1, 2),
(5, 'Richard', 'Emma', 333444555, 'erichard', '5f4dcc3b5aa765d61d8327deb882cf99', 0, 'emma.richard@example.com', 1, NULL),
(6, 'Lefevre', 'Hugo', 444555666, 'hlefevre', '3300bbb5663b55c0b9fa4c377feda49e', 0, 'hugo.lefevre@example.com', 1, 3),
(7, 'Moreau', 'Clara', 555666777, 'cmoreau', '5f4dcc3b5aa765d61d8327deb882cf99', 0, 'clara.moreau@example.com', 1, 1),
(8, 'Simon', 'Nathan', 666777888, 'nsimon', '5f4dcc3b5aa765d61d8327deb882cf99', 0, 'nathan.simon@example.com', 1, NULL),
(9, 'Rousseau', 'Camille', 777888999, 'crousseau', '5f4dcc3b5aa765d61d8327deb882cf99', 0, 'camille.rousseau@example.com', 1, 2),
(10, 'Durand', 'Tom', 888999000, 'tdurand', '5f4dcc3b5aa765d61d8327deb882cf99', 0, 'tom.durand@example.com', 1, NULL),
(11, 'Pierre', 'Jean', 1, 'Jpierre', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 'jeanpierre@gmail.com', 0, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cr`
--
ALTER TABLE `cr`
  ADD PRIMARY KEY (`num`),
  ADD KEY `FK_CR` (`num_utilisateur`);

--
-- Index pour la table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`num`),
  ADD KEY `FK_stage` (`num_tuteur`);

--
-- Index pour la table `tuteur`
--
ALTER TABLE `tuteur`
  ADD PRIMARY KEY (`num`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`num`),
  ADD KEY `FK_Uuser` (`num_stage`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cr`
--
ALTER TABLE `cr`
  MODIFY `num` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `stage`
--
ALTER TABLE `stage`
  MODIFY `num` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tuteur`
--
ALTER TABLE `tuteur`
  MODIFY `num` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `num` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cr`
--
ALTER TABLE `cr`
  ADD CONSTRAINT `FK_CR` FOREIGN KEY (`num_utilisateur`) REFERENCES `utilisateur` (`num`);

--
-- Contraintes pour la table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `FK_stage` FOREIGN KEY (`num_tuteur`) REFERENCES `tuteur` (`num`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_Uuser` FOREIGN KEY (`num_stage`) REFERENCES `stage` (`num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
