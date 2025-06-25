-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 25 juin 2025 à 15:57
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `recomcopy`
--

-- --------------------------------------------------------

--
-- Structure de la table `reco`
--

DROP TABLE IF EXISTS `reco`;
CREATE TABLE IF NOT EXISTS `reco` (
  `id_reco` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `titre` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_modification` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_reco`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reco`
--

INSERT INTO `reco` (`id_reco`, `id_user`, `nom`, `titre`, `description`, `url`, `date_creation`, `date_modification`) VALUES
(1, 0, 'Tour Eiffel', 'Tour Eiffel', 'Vue panoramique sur la ville de paris', 'https://www.getyourguide.com/fr-fr/s?locale=fr&currency=EUR&surface=&funnel=&google_ads_click_source=tpa&product_id=45877&option_id=59912&partner_id=CD951&et=45877&lc=16&cq_src=google_ads&cq_cmp=20972176934&cq_con=154972707741&cq_term=&cq_med=&cq_plac=&cq', '2025-06-02 12:31:57', '2025-06-02 12:31:57'),
(2, 0, 'Arc  de Triomphe', 'Arc de triomphe', 'Grand monument', 'https://arc-de-triomphe.paristickets.com/fr/?ci=2&cm=412485859_1299623060049876_c_o_arc%20de%20triomphe_e_{extensionid}&msclkid=5ad329f4d4f1144eff7541ba39000228&utm_source=bing&utm_medium=cpc&utm_campaign=Paris%20-%20Arc%20De%20Triomphe%20-%20French%20-%2', '2025-06-15 18:03:32', '2025-06-15 18:03:32'),
(3, 0, 'Musee du louvre', 'Musee du louvre', 'Musee avec des tableaux, statuettes', 'https://www.tiqets.com/fr/billets-musee-du-louvre-l124297/?utm_account=154002310&utm_source=bing&utm_medium=cpc&utm_campaign=434096224&utm_content=1257841921637262&msclkid=231f82424f9a15a89f3cea0ca142358f&utm_term=musee+du+louvre', '2025-06-15 18:08:20', '2025-06-15 18:08:20'),
(4, 0, 'Galeries Lafayette', 'Galeries Lafayette', 'Milieu très fréquenté pour le shopping et la vue panoramique est gratuite', 'https://haussmann.galerieslafayette.com/', '2025-06-15 18:30:52', '2025-06-15 18:30:52'),
(5, 0, 'Musee d\'Orsay', 'Musee d\'Orsay', 'Musée pluridisciplinaire exposant la plus riche collection de tableaux impressionnistes.', 'https://www.tiqets.com/fr/billets-musee-d-orsay-l141867/?utm_account=154002310&utm_source=bing&utm_medium=cpc&utm_campaign=710709443&utm_content=1254544111660843&msclkid=4eb5abe07cdd1b91f413c3af46834c08&utm_term=musee+orsay', '2025-06-15 23:29:50', '2025-06-15 23:29:50'),
(6, 0, 'Notre-Dame de paris', 'Notre-Dame de paris', 'Au-delà de sa vocation religieuse, la cathédrale Notre-Dame de Paris est l’un des fleurons du patrimoine culturel national et mondial', 'https://notre-dame-de-paris.culture.gouv.fr/fr/le-monument', '2025-06-15 23:32:35', '2025-06-15 23:32:35');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo_profil` varchar(200) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `photo_profil`, `admin`, `date_creation`) VALUES
(1, 'juliene', 'julie@gmail.com', '$2y$10$AiI8rurUpiTW7er1pbxjyO3p/q5KZPMSqL0lm7qodOPsxKFssUoiO', NULL, 0, '2025-05-28 14:48:55'),
(2, 'martin', 'martin@gmail.com', '$2y$10$zjnI14zwVe7vBCJbUQK9BekvRlt9o5y4fRlGJ0ex.9IP2E.Bo3R7.', NULL, 0, '2025-05-28 14:49:42'),
(3, 'gilberto', 'gilbert@gmail.com', '$2y$10$1ORa5sxxd5YyRJ433cQqXOXjWJvHs3aVRm6jNz9zOAfq2.o/BxRUi', NULL, 0, '2025-05-28 15:26:38'),
(5, 'huge', 'huge@gmail.com', '$2y$10$kn/JE0G3FvyNyFXxU.EaZeYFxcb6.Rmj6uShVVXnHJo.JKfwMLtfS', NULL, 1, '2025-06-02 11:11:03'),
(6, 'michel', 'michel@gmail.com', '$2y$10$AtvOJlMfUty8.IElgIFI9up1.ZOWXzZ0N/ffiOMLQ0WtmuCh4yF.u', NULL, 0, '2025-06-14 00:55:20');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
