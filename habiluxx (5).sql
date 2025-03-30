-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 17 mars 2025 à 00:17
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `habiluxx`
--

-- --------------------------------------------------------

--
-- Structure de la table `bien`
--

DROP TABLE IF EXISTS `bien`;
CREATE TABLE IF NOT EXISTS `bien` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gouvernorat_id` int DEFAULT NULL,
  `ville_id` int DEFAULT NULL,
  `type_id` int DEFAULT NULL,
  `nom_bien` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `adresse_bien` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prix_bien` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type_offre` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `localisation_bien` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `afficher_prix` tinyint(1) NOT NULL,
  `date_creation` datetime DEFAULT NULL,
  `publier_par_id` int NOT NULL,
  `position_map` longtext COLLATE utf8mb3_unicode_ci,
  `nom_client` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tel_client` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tel_client2` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `adresse_client` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_45EDC38675B74E2D` (`gouvernorat_id`),
  KEY `IDX_45EDC386A73F0036` (`ville_id`),
  KEY `IDX_45EDC386C54C8C93` (`type_id`),
  KEY `IDX_45EDC386F5003096` (`publier_par_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `bien`
--

INSERT INTO `bien` (`id`, `gouvernorat_id`, `ville_id`, `type_id`, `nom_bien`, `adresse_bien`, `prix_bien`, `type_offre`, `description`, `localisation_bien`, `afficher_prix`, `date_creation`, `publier_par_id`, `position_map`, `nom_client`, `tel_client`, `tel_client2`, `adresse_client`) VALUES
(2, 12, 57, 1, 'S+2', 'hammamet', '1 000', 'A Vendre', 'bureau commercial a vendre en centre ville', 'rue taher benfraj', 1, '2025-02-07 19:41:43', 33, NULL, 'mohsen', '93313278', '9331278', 'hammamet'),
(5, 17, 57, 6, 'S+3', 'hammamet', '1 500', 'A Vendre', 'test', 'hammamet', 1, '2025-02-07 20:36:25', 33, NULL, 'yassin', '93313278', '9331278', 'hammamet'),
(7, 24, 78, 2, 'Terrain blanc', 'Zaghouan', '20 000 000', 'A Vendre', 'Saisissez cette belle opportunité d’acquérir un terrain blanc de 400 m², situé à Nadhour, Zaghouan. Idéal pour une construction résidentielle ou un projet agricole, ce terrain bénéficie d’un chemin accessible et d’un cadre paisible.', 'Nadhour', 1, '2025-02-17 14:13:16', 33, '36.3898546632654,10.138543057949919', '', '', NULL, ''),
(11, 17, 57, 2, 'Terrain Blanc', 'Bir bouragba', '2 000', 'A Vendre', 'À vendre : Terrain blanc de 800 m² à Bir Bouregba .Offrez-vous une opportunité unique avec ce terrain blanc de 800 m², situé à Bir Bouregba, dans un cadre calme et agréable, idéal pour construire votre future maison ou réaliser un projet immobilier.', 'rue ennasr', 1, '2025-03-02 13:09:55', 33, '36.43218369368595,10.562161385622876', '', '', NULL, ''),
(12, 17, 56, 5, 'Appartement S+3', 'AFH', '30 000 000', 'A Louer', 'Cet appartement de rêve au style moderne jamais habité, situé au cinquième étage d\'une résidence sécurisée à La Nouvelle Ariana. Avec ses doubles ascenseurs et sa proximité avec toutes les commodités, cet appartement offre un mode de vie idéal.  L\'entrée', 'AFH', 1, '2025-03-02 13:29:17', 33, '36.435632962563936,10.693520171702263', 'amin', '93313278', '9331278', 'hammamet'),
(13, 25, 80, 4, 'Depot', 'Sousse', '5 000 000', 'A Vendre', 'À vendre : Dépôt à Sousse – Opportunité idéale pour votre activité professionnelle .  Mettez la main sur un dépôt spacieux situé à Sousse, une zone stratégique pour vos besoins logistiques et commerciaux. Ce dépôt est parfait pour le stockage, l’indust', 'Khzema', 1, '2025-03-02 13:52:56', 33, '35.84225240776427,10.576161179882144', 'ines', '93313278', '9331278', 'hammamet'),
(14, 23, 11, 4, 'depot', 'Ben arous', '35 000 000', 'A Vendre', 'Profitez de cette opportunité unique d\'acquérir un dépôt spacieux situé à Ben Arous, dans une zone industrielle en pleine croissance. Ce dépôt est parfait pour le stockage, la distribution ou toute autre activité nécessitant un grand espace.', 'Ben arous', 1, '2025-03-02 13:59:56', 33, '36.61803527839754,10.177577135988086', '', '', NULL, ''),
(15, 17, 57, 4, 'Depot', 'hammamet', '3 000', 'A Vendre', 'Profitez de cette opportunité unique d\'acquérir un dépôt spacieux situé à Ben Arous, dans une zone industrielle en pleine croissance. Ce dépôt est parfait pour le stockage, la distribution ou toute autre activité nécessitant un grand espace.', 'Rue monji slim', 0, '2025-03-02 14:06:53', 33, '36.412952678407954,10.628209871482436', 'aziz', '93313278', '9331278', 'hammamet'),
(16, 17, 57, 6, 'Villa', 'hammamet', '4 000', 'A Vendre', 'Découvrez cette magnifique villa située dans un quartier prisé, offrant un confort moderne et un cadre de vie paisible. Idéale pour une famille ou pour ceux qui recherchent une résidence haut de gamme, cette villa combine élégance, espaces généreux et pre', 'Corniche', 1, '2025-03-02 14:17:36', 36, '36.40042526616362,10.608892961253055', '', '', NULL, ''),
(17, 17, 56, 5, 'Studio S+1', 'Nabeul', '350 DT/mois', 'A Louer', 'studio pour etudiant', 'Bir challouf', 1, '2025-03-02 14:26:40', 36, '36.4503640002468,10.721525949144011', '', '', NULL, '');

--
-- Déclencheurs `bien`
--
DROP TRIGGER IF EXISTS `insertProprieteBien`;
DELIMITER $$
CREATE TRIGGER `insertProprieteBien` AFTER INSERT ON `bien` FOR EACH ROW BEGIN



insert into details_propriete select null,id,new.id,null from propriete where type_id=new.type_id;


  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `contact_message`
--

DROP TABLE IF EXISTS `contact_message`;
CREATE TABLE IF NOT EXISTS `contact_message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `tel` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `contact_message`
--

INSERT INTO `contact_message` (`id`, `name`, `email`, `message`, `created_at`, `is_read`, `tel`) VALUES
(1, 'ahmed', 'ahmedksontini122@gmail.com', 'test message ', '2025-03-04 13:20:11', 1, ''),
(2, 'bilel', 'bilel@gmail.com', 'test num 2', '2025-03-04 13:43:45', 1, ''),
(3, 'wassim', 'wassim@gmail.com', 'test contact home ', '2025-03-04 14:01:46', 1, ''),
(4, 'ahmed', 'ahmedksontini122@gmail.com', 'test num', '2025-03-05 14:43:47', 1, '93313278'),
(5, 'msi', 'amine@gmail.com', 'test num', '2025-03-05 14:46:37', 1, '00052624'),
(6, 'aziiiiiiiiz', 'aziz@gmail.com', 'test', '2025-03-05 15:00:35', 1, '96333457'),
(7, 'ahmed', 'ahmedksontini122@gmail.com', '16 \r\nADBJB', '2025-03-13 02:24:10', 1, '96333457'),
(8, 'ahmed', 'amineksontini5@gmail.com', 'tzre', '2025-03-15 11:52:07', 1, '96333457'),
(9, 'ahmed', 'amineksontini5@gmail.com', 'tzre', '2025-03-15 11:55:44', 1, '96333457'),
(10, 'ahmed', 'amineksontini5@gmail.com', 'tzre', '2025-03-15 11:56:14', 1, '96333457'),
(11, 'ahmed', 'amineksontini5@gmail.com', 'tzre', '2025-03-15 11:56:42', 1, '96333457'),
(12, 'ahmed', 'amineksontini5@gmail.com', 'tzre', '2025-03-15 11:57:11', 1, '96333457');

-- --------------------------------------------------------

--
-- Structure de la table `details_propriete`
--

DROP TABLE IF EXISTS `details_propriete`;
CREATE TABLE IF NOT EXISTS `details_propriete` (
  `id` int NOT NULL AUTO_INCREMENT,
  `propriete_id` int DEFAULT NULL,
  `bien_id` int DEFAULT NULL,
  `valeur_propriete` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `afficher` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9A8574818566CAF` (`propriete_id`),
  KEY `IDX_9A85748BD95B80F` (`bien_id`)
) ENGINE=InnoDB AUTO_INCREMENT=257 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `details_propriete`
--

INSERT INTO `details_propriete` (`id`, `propriete_id`, `bien_id`, `valeur_propriete`, `afficher`) VALUES
(19, 19, 2, '60', 1),
(20, 20, 2, '1', 1),
(21, 21, 2, 'Ascenseur ', 1),
(22, 22, 2, 'oui', 0),
(23, 23, 2, 'oui', 0),
(24, 24, 2, 'oui', 0),
(25, 25, 2, 'oui', 0),
(26, 26, 2, 'non', 0),
(27, 27, 2, 'oui', 0),
(28, 28, 2, 'non', 0),
(29, 29, 2, 'non', 0),
(30, 30, 2, 'oui', 0),
(31, 31, 2, 'oui', 0),
(32, 32, 2, 'non', 0),
(33, 33, 2, 'non', 0),
(34, 34, 2, 'non', 0),
(35, 35, 2, 'Centre ville', 0),
(36, 36, 2, 'oui', 0),
(72, 1, 5, '90', 0),
(73, 2, 5, '1', 1),
(74, 3, 5, '3', 1),
(75, 4, 5, '2', 1),
(76, 5, 5, 'Traditionnelle', 0),
(77, 6, 5, '1', 0),
(78, 7, 5, 'oui', 0),
(79, 8, 5, 'non', 0),
(80, 9, 5, 'non', 0),
(81, 10, 5, 'non', 0),
(82, 11, 5, 'non', 0),
(83, 12, 5, 'non', 0),
(84, 13, 5, 'non', 0),
(85, 14, 5, 'oui', 0),
(86, 15, 5, 'oui', 0),
(87, 16, 5, 'Cameras', 0),
(88, 17, 5, 'non', 0),
(89, 18, 5, 'oui', 0),
(121, 37, 7, '102 m²', NULL),
(122, 38, 7, 'carre', NULL),
(123, 39, 7, 'Residentielle', NULL),
(124, 40, 7, 'chemin de terre', NULL),
(125, 41, 7, 'ecoles', NULL),
(126, 42, 7, 'oui', NULL),
(127, 43, 7, 'maison', NULL),
(168, 37, 11, '800m²', NULL),
(169, 38, 11, 'carré', NULL),
(170, 39, 11, 'Agricole', NULL),
(171, 40, 11, 'Chemin de terre', NULL),
(172, 41, 11, '1.5 Km', NULL),
(173, 42, 11, 'Oui', NULL),
(174, 43, 11, 'Maison', NULL),
(175, 44, 12, '105 m²', NULL),
(176, 45, 12, 'Etage N*3', NULL),
(177, 46, 12, '3', NULL),
(178, 47, 12, '1', NULL),
(179, 48, 12, 'Terrasse', NULL),
(180, 49, 12, 'Sur rue', NULL),
(181, 50, 12, 'Double vitrage', NULL),
(182, 51, 12, 'Electrique', NULL),
(183, 52, 12, 'Cuisine fermée et bien equipée', NULL),
(184, 53, 12, 'Bainoire , WC non séparé', NULL),
(185, 54, 12, '21/05/2023', NULL),
(186, 55, 12, 'Oui', NULL),
(187, 56, 12, 'piscine et jardin', NULL),
(188, 57, 12, 'interphone', NULL),
(189, 58, 12, 'Stationnement public', NULL),
(190, 59, 13, '90 m²', NULL),
(191, 60, 13, '4 m', NULL),
(192, 61, 13, 'Neuf', NULL),
(193, 62, 13, 'non', NULL),
(194, 63, 13, 'Portes sectionnelles', NULL),
(195, 64, 13, 'parkings', NULL),
(196, 65, 13, 'oui', NULL),
(197, 59, 14, '150 m²', 1),
(198, 60, 14, '7m', 0),
(199, 61, 14, 'Neuf', 1),
(200, 62, 14, 'oui', 0),
(201, 63, 14, 'Rideaux', 0),
(202, 64, 14, 'Aire de retournement pour camions', 1),
(203, 65, 14, 'oui', 0),
(204, 59, 15, '110 m²', 1),
(205, 60, 15, '4', 0),
(206, 61, 15, 'en bon état', 1),
(207, 62, 15, 'non', 1),
(208, 63, 15, ' rideaux métalliques', 0),
(209, 64, 15, 'cours', 0),
(210, 65, 15, 'oui', 0),
(211, 1, 16, '250 m²', 0),
(212, 2, 16, '2', 1),
(213, 3, 16, '4', 1),
(214, 4, 16, '2', 0),
(215, 5, 16, 'Traditionnelle', 0),
(216, 6, 16, '2', 1),
(217, 7, 16, 'oui', 0),
(218, 8, 16, 'non', 0),
(219, 9, 16, 'non', 0),
(220, 10, 16, 'oui', 0),
(221, 11, 16, 'oui', 0),
(222, 12, 16, ' barbecue', 0),
(223, 13, 16, 'non', 0),
(224, 14, 16, 'oui', 0),
(225, 15, 16, 'non', 0),
(226, 16, 16, 'non', 0),
(227, 17, 16, 'non', 0),
(228, 18, 16, 'oui', 0),
(242, 44, 17, '55 m²', 1),
(243, 45, 17, 'Rez-de-chaussée', 0),
(244, 46, 17, '1', 1),
(245, 47, 17, '1', 1),
(246, 48, 17, 'Balcon', 0),
(247, 49, 17, 'sur rue', 0),
(248, 50, 17, 'Simple', 0),
(249, 51, 17, 'au gaz', 0),
(250, 52, 17, 'fermée et bien équipée', 0),
(251, 53, 17, 'douche et WC non séparé', 0),
(252, 54, 17, 'Ancien', 0),
(253, 55, 17, '', 0),
(254, 56, 17, '', 0),
(255, 57, 17, '', 0),
(256, 58, 17, ' place extérieure', 0);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250313175421', '2025-03-13 17:54:37', 41);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `description` longtext COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id`, `title`, `start_date`, `end_date`, `description`) VALUES
(26, 'visite', '2025-03-15 00:00:00', '2025-03-15 00:00:00', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE IF NOT EXISTS `favoris` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `bien_id` int NOT NULL,
  `date_ajout` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_8933C432A76ED395` (`user_id`),
  KEY `IDX_8933C432BD95B80F` (`bien_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`id`, `user_id`, `bien_id`, `date_ajout`) VALUES
(31, 33, 5, '2025-03-09 09:52:59'),
(36, 33, 17, '2025-03-15 11:49:10');

-- --------------------------------------------------------

--
-- Structure de la table `gouvernorat`
--

DROP TABLE IF EXISTS `gouvernorat`;
CREATE TABLE IF NOT EXISTS `gouvernorat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_gouvernorat` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `gouvernorat`
--

INSERT INTO `gouvernorat` (`id`, `nom_gouvernorat`) VALUES
(1, 'Ariana'),
(2, 'Beja'),
(3, 'Ben Arous'),
(4, 'Bizerte'),
(5, 'Gabès'),
(6, 'Gafsa'),
(7, 'Jendouba'),
(8, 'Kairouan'),
(9, 'Kasserine'),
(10, 'Kebili'),
(11, 'La Manouba'),
(12, 'Le Kef'),
(13, 'Mahdia'),
(14, 'Manouba'),
(15, 'Médenine'),
(16, 'Monastir'),
(17, 'Nabeul'),
(18, 'Sfax'),
(19, 'Sidi Bouzid'),
(20, 'Siliana'),
(21, 'Tataouine'),
(22, 'Tozeur'),
(23, 'Tunis'),
(24, 'Zaghouan'),
(25, 'Sousse');

-- --------------------------------------------------------

--
-- Structure de la table `historique_action`
--

DROP TABLE IF EXISTS `historique_action`;
CREATE TABLE IF NOT EXISTS `historique_action` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `action` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb3_unicode_ci,
  `date_action` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8E8E2CCEA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `historique_action`
--

INSERT INTO `historique_action` (`id`, `user_id`, `action`, `description`, `date_action`) VALUES
(53, 33, 'Modification', 'Modification de client ID: 38', '2025-02-22 22:52:30'),
(54, 33, 'Suppression', 'Suppression de client ', '2025-02-22 22:52:53'),
(55, 33, 'Modification', 'Modification de bien ID: 7', '2025-02-22 22:53:16'),
(56, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-02-22 22:53:43'),
(57, 33, 'Suppression', 'Suppression de bien ', '2025-02-22 22:54:01'),
(58, 33, 'Modification', 'Modification de propriété ID: 66', '2025-02-22 22:54:31'),
(59, 33, 'Suppression', 'Suppression de propriété ', '2025-02-22 22:55:05'),
(60, 33, 'Ajout', 'Ajout d\'un nouveau propriété ', '2025-02-22 22:55:28'),
(61, 33, 'Modification', 'Modification de client ID: 33', '2025-02-27 21:42:41'),
(62, 33, 'Suppression', 'Suppression une date de visite', '2025-03-01 11:33:13'),
(63, 33, 'Modification', 'Modification de client ID: 35', '2025-03-01 19:06:50'),
(64, 33, 'Modification', 'Modification de bien ID: 1', '2025-03-01 19:07:21'),
(65, 33, 'Ajout', 'Ajout d\'un nouveau date de visite dans le calendrier ', '2025-03-02 12:48:38'),
(66, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-03-02 13:09:18'),
(67, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-03-02 13:09:55'),
(68, 33, 'Suppression', 'Suppression de bien ', '2025-03-02 13:13:42'),
(69, 33, 'Modification', 'Modification de bien ID: 11', '2025-03-02 13:16:52'),
(70, 33, 'Modification', 'Modification de bien ID: 11', '2025-03-02 13:18:39'),
(71, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-03-02 13:29:18'),
(72, 33, 'Modification', 'Modification de bien ID: 7', '2025-03-02 13:46:21'),
(73, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-03-02 13:52:56'),
(74, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-03-02 13:59:56'),
(75, 36, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-03-02 14:06:53'),
(76, 36, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-03-02 14:17:37'),
(77, 36, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-03-02 14:26:41'),
(78, 33, 'Suppression', 'Suppression de bien ', '2025-03-03 09:46:47'),
(79, 33, 'Ajout', 'Ajout d\'un nouveau date de visite dans le calendrier ', '2025-03-04 15:57:41'),
(80, 33, 'Suppression', 'Suppression une date de visite', '2025-03-04 15:58:13'),
(81, 33, 'Modification', 'Modification de client ID: 46', '2025-03-04 16:22:52'),
(82, 33, 'Modification', 'Modification de bien ID: 2', '2025-03-05 16:41:34'),
(83, 33, 'Modification', 'Modification de bien ID: 2', '2025-03-05 16:43:25'),
(84, 33, 'Modification', 'Modification de bien ID: 2', '2025-03-05 17:06:22'),
(85, 33, 'Modification', 'Modification de client ID: 46', '2025-03-10 10:23:26'),
(86, 33, 'Modification', 'Modification de client ID: 35', '2025-03-10 10:24:29'),
(87, 33, 'Modification', 'Modification de client ID: 46', '2025-03-10 10:25:19'),
(88, 33, 'Modification', 'Modification de client ID: 46', '2025-03-10 10:25:36'),
(89, 33, 'Modification', 'Modification de bien ID: 5', '2025-03-14 16:10:30'),
(90, 33, 'Modification', 'Modification de bien ID: 15', '2025-03-14 16:59:23'),
(91, 33, 'Modification', 'Modification de bien ID: 12', '2025-03-14 17:24:19'),
(92, 33, 'Modification', 'Modification de bien ID: 13', '2025-03-14 18:10:41');

-- --------------------------------------------------------

--
-- Structure de la table `image_bien`
--

DROP TABLE IF EXISTS `image_bien`;
CREATE TABLE IF NOT EXISTS `image_bien` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bien_id` int DEFAULT NULL,
  `nom_image` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `principal` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B7D72918BD95B80F` (`bien_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `image_bien`
--

INSERT INTO `image_bien` (`id`, `bien_id`, `nom_image`, `principal`) VALUES
(7, 2, 'villa1-67a661f85be3e.jpg', 1),
(10, 5, 'villa1-67a66ecbd246c.jpg', 1),
(12, 7, 'v6-67b343fe6de88.png', 1),
(18, 11, 'terrain1-67c458a3d5465.jpg', 1),
(19, 11, 'terrain2-67c458a3d5712.jpg', 1),
(20, 11, 'terrain3-67c458a3d584b.jpg', 1),
(21, 12, 'app1-67c45d2e65ac1.jpg', 1),
(22, 12, 'app2-67c45d2e66050.jpg', 1),
(23, 12, 'app3-67c45d2e6636d.jpg', 1),
(24, 12, 'app4-67c45d2e66680.jpg', 1),
(25, 12, 'app5-67c45d2e66933.jpg', 1),
(26, 12, 'app6-67c45d2e66ce8.jpg', 1),
(27, 13, 'depot3-67c462b8eb3b1.jpg', 1),
(28, 14, 'depot4-67c4645c9fd03.jpg', 1),
(29, 15, 'depot1-67c465fddaedd.webp', 1),
(30, 16, 'gallery-2-67c46880f3eaa.jpg', 1),
(31, 16, 'gallery-3-67c4688100224.jpg', 1),
(32, 16, 'gallery-4-67c468810059d.jpg', 1),
(33, 16, 'gallery-5-67c46881008aa.jpg', 1),
(34, 16, 'gallery-6-67c4688100c64.jpg', 1),
(35, 16, 'gallery-7-67c4688100f9f.jpg', 1),
(36, 16, 'gallery-8-67c4688101314.jpg', 1),
(37, 16, 'gallery-9-67c4688101691.jpg', 1),
(38, 16, 'gallery-10-67c4688101a55.jpg', 1),
(39, 16, 'gallery-11-67c4688101ce2.jpg', 1),
(40, 16, 'gallery-12-67c4688101f94.jpg', 1),
(41, 16, 'gallery-67c4688102235.jpg', 1),
(42, 17, '6-67c46aa15ffb5.jpg', 1),
(43, 17, '7-67c46aa16053d.jpg', 1),
(44, 17, '9-67c46aa160958.jpg', 1),
(45, 17, '10-67c46aa160bed.jpg', 1),
(46, 17, '11-67c46aa160e83.jpg', 1),
(47, 17, '12-67c46aa1610f7.jpg', 1),
(48, 2, 'hammamet-67c87ebe75aef.jpg', 0),
(49, 2, 'bilel-67c87f2d65130.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `propriete`
--

DROP TABLE IF EXISTS `propriete`;
CREATE TABLE IF NOT EXISTS `propriete` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_id` int DEFAULT NULL,
  `nom_propriete` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_73A85B93C54C8C93` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `propriete`
--

INSERT INTO `propriete` (`id`, `type_id`, `nom_propriete`) VALUES
(1, 6, 'Superficie (m²)'),
(2, 6, 'Nombre d’étages'),
(3, 6, 'Nombre de chambres'),
(4, 6, 'Nombre de salles de bains'),
(5, 6, 'Type de construction (Traditionnelle, Moderne)'),
(6, 6, 'Nombre de salons'),
(7, 6, 'Cuisine équipée'),
(8, 6, 'Bureau ou bibliothèque'),
(9, 6, 'Piscine'),
(10, 6, 'Jardin'),
(11, 6, 'Garage ou parking privé'),
(12, 6, 'Cuisine d’été / barbecue'),
(13, 6, 'Terrain de sport (tennis, mini-golf, etc.)'),
(14, 6, 'Climatisation / chauffage central'),
(15, 6, 'Domotique (maison intelligente)'),
(16, 6, 'Système de sécurité (caméras, alarme, portail automatique)'),
(17, 6, 'Panneaux solaires'),
(18, 6, 'Enternet'),
(19, 1, 'Superficie (m²)'),
(20, 1, 'Nombre d’étages'),
(21, 1, 'Accès (Ascenseur, escaliers)'),
(22, 1, 'Open space (pour un travail collaboratif)'),
(23, 1, 'Bureaux privés'),
(24, 1, 'Salle de réunion équipée (écran, vidéoprojecteur, visioconférence)'),
(25, 1, 'Espace d’accueil'),
(26, 1, 'Cuisine'),
(27, 1, 'Sanitaires modernes'),
(28, 1, 'Espaces de rangement / archives'),
(29, 1, 'Climatisation / chauffage central'),
(30, 1, 'Fibre optique / Internet haut débit'),
(31, 1, 'Système de vidéosurveillance'),
(32, 1, 'Portes coupe-feu'),
(33, 1, 'Sorties de secours bien signalées'),
(34, 1, 'Parking privé ou public'),
(35, 1, 'Emplacement stratégique (centre-ville, quartier d’affaires, zone commerciale)'),
(36, 1, 'terrasse extérieure'),
(37, 2, 'Superficie'),
(38, 2, 'Forme du terrain (Rectangulaire, carré, irrégulier)'),
(39, 2, 'Vocation (Résidentielle, commerciale, industrielle, agricole)'),
(40, 2, 'Facilité d\'accès (route goudronnée, chemin de terre, accès piéton)'),
(41, 2, 'Distance aux commodités (écoles, commerces, hôpitaux, zones industrielles)'),
(42, 2, 'Terrain viabilisé ou non (raccordement aux réseaux d’eau, électricité, assainissement)'),
(43, 2, 'Type de construction autorisée (maison, immeuble, commerce, entrepôt...)'),
(44, 5, 'Superficie (m²)'),
(45, 5, 'Étage (Rez-de-chaussée, étage intermédiaire, dernier étage)'),
(46, 5, 'Nombre de chambres'),
(47, 5, 'Nombre de salons'),
(48, 5, 'Balcon/Terrasse'),
(49, 5, 'Exposition et vue (Vue dégagée, sur cour, sur rue, mer, montagne)'),
(50, 5, 'Fenêtres et isolation (Simple/double vitrage, volets roulants ou battants)'),
(51, 5, 'Chauffage et climatisation (Individuel, collectif, au gaz, électrique, pompe à chaleur)'),
(52, 5, 'Cuisine (Ouverte (américaine) ou fermée, équipée ou non)'),
(53, 5, 'Salle de bain (baignoire ou douche, WC séparé ou non)'),
(54, 5, 'Année de construction (Ancien, récent, neuf)'),
(55, 5, 'Présence d’un ascenseur (Oui/Non)'),
(56, 5, 'Espaces communs  (Jardin, cour intérieure, local à vélos, salle de sport, piscine)'),
(57, 5, 'Sécurité (Digicode, interphone, gardien, vidéosurveillance)'),
(58, 5, 'Stationnement  (Parking privé, garage, place extérieure, stationnement public)'),
(59, 4, 'Superficie (m²)'),
(60, 4, 'Hauteur sous plafond  (Standard (3-4m) ou grande hauteur (10m+) pour racks de stockage)'),
(61, 4, 'État du bâtiment (Neuf, ancien, rénové, en bon état)'),
(62, 4, 'Isolation thermique et phonique (Oui/Non)'),
(63, 4, 'Portes d’accès (Portes sectionnelles, rideaux métalliques, portes piétonnes)'),
(64, 4, 'Espace de manœuvre ( Aire de retournement pour camions, parkings, cours)'),
(65, 4, 'Électricité et éclairage');

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
CREATE TABLE IF NOT EXISTS `reset_password_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `selector` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `reset_password_request`
--

INSERT INTO `reset_password_request` (`id`, `user_id`, `selector`, `hashed_token`, `requested_at`, `expires_at`) VALUES
(8, 33, '65wecYMM5uVmzE3rClsb', 'fJ0QDwcXNT7KM+O+PJTHrhgs/Di+IzxYQHbvxVCrUPk=', '2025-02-21 15:25:44', '2025-02-21 16:25:44'),
(9, 35, '3YFn2ycvagZdTEcNCs7j', '7oc+vstd/Yuqu/7Ii+9Hhyzw0JqR2wP4b/EvGcCelNY=', '2025-02-21 15:30:04', '2025-02-21 16:30:04');

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bien_id` int DEFAULT NULL,
  `agent_id` int NOT NULL,
  `nom_acheteur` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tel_acheteur` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `cin_acheteur` int NOT NULL,
  `type_transaction` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prix_initial` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prix_final` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `commission` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `date_transaction` date NOT NULL,
  `mode_paiement` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nbr_mois` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prix_par_mois` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `payer` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `statut_transaction` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_723705D13414710B` (`agent_id`),
  KEY `IDX_723705D1BD95B80F` (`bien_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `transaction`
--

INSERT INTO `transaction` (`id`, `bien_id`, `agent_id`, `nom_acheteur`, `tel_acheteur`, `cin_acheteur`, `type_transaction`, `prix_initial`, `prix_final`, `commission`, `date_transaction`, `mode_paiement`, `nbr_mois`, `prix_par_mois`, `payer`, `statut_transaction`) VALUES
(1, 2, 33, 'mohsen yahya', '93313278', 2563956, 'Vente', '200 000 000 DT', '220 000 000 DT', '20 000 000', '2025-03-01', 'Virement', '5', '24 000 000', 'En cours', 'Validée'),
(2, 16, 36, 'amine', '93313278', 12345678, 'Location', '200 000 000 DT', '220 000 000 DT', '5 000 000', '2025-03-06', 'Virement', '5', '24 000 000', 'Payé', 'Validée'),
(3, 13, 35, 'mohsen yahya', '93313278', 5272582, 'Location', '200 000 000 DT', '220 000 000 DT', '7 000 000', '2025-04-12', 'Virement', '5', '24 000 000', 'Payé', 'Validée'),
(4, 11, 35, 'amine', '93313278', 5272, 'Vente', '200 000 000 DT', '220 000 000 DT', '20 000 000', '2025-05-14', 'Chèque', '5', '24 000 000', 'En cours', 'En attente');

-- --------------------------------------------------------

--
-- Structure de la table `type_bien`
--

DROP TABLE IF EXISTS `type_bien`;
CREATE TABLE IF NOT EXISTS `type_bien` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `type_bien`
--

INSERT INTO `type_bien` (`id`, `nom_type`) VALUES
(1, 'Bureau commercial'),
(2, 'Terrain'),
(4, 'Depot'),
(5, 'Appartement'),
(6, 'Villa');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb3_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tel` int NOT NULL,
  `verifier` tinyint(1) NOT NULL,
  `photo_profil` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `instagram` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cree_en` datetime DEFAULT NULL,
  `localisation` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `poste` longtext COLLATE utf8mb3_unicode_ci COMMENT '(DC2Type:array)',
  `description` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `experience` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cin` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `reset_password_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `tel`, `verifier`, `photo_profil`, `confirmation_token`, `status`, `instagram`, `linkedin`, `facebook`, `cree_en`, `localisation`, `adresse`, `poste`, `description`, `experience`, `cin`, `reset_password_token`) VALUES
(33, 'ahmedksontini122@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$U4s7Db8aJu6TaRCMQEXnq.GOV684iINbsqikxXqThquwSKWhHm0RK', 'ksontini', 'ahmed', 93313278, 1, '4263bab136fb59c6461d0c25f60de0fb.jpg', NULL, 0, 'https://www.instagram.com/ahmed_ksontini_/', 'https://www.linkedin.com/in/ahmed-ksontini-3589071a0/', 'https://www.facebook.com/ahmed.ksontini.37?locale=fr_FR', '2025-02-01 10:50:44', 'Hammamet', 'Rue taher ben fraj', 'a:1:{i:0;s:22:\"Responsable d’agence\";}', 'Passionné par l\'immobilier et fort d\'une solide expérience dans le secteur, j\'occupe actuellement le poste de Responsable d\'Agence Immobilière. Mon rôle consiste à superviser et développer les activités de l’agence, en garantissant un service client de qu', '15 ans', '08985353', ''),
(35, 'nidhalSafta@gmail.com', '{\"1\": \"ROLE_USER\"}', '$2y$13$77Zer4QkE9qyjk1nWHNpz.ygIUuV.JCGXG1vjTb0cB3PTJgw5rLTO', 'safta', 'Nidhal', 22687017, 1, 'WhatsApp-Image-2025-02-03-at-11-50-59-AM-67a09fcf2a3c0.jpg', NULL, 0, NULL, NULL, NULL, '2025-02-03 10:51:59', 'kharouba', 'hammamet', 'a:1:{i:0;s:16:\"Agent immobilier\";}', NULL, NULL, '06423587', NULL),
(36, 'bilel@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$4waxRdAxtGlm6PYC.6z3TOTiECepJBQ6o03tFH6kz7xaT0Ilz3z7m', 'magherby', 'bilel', 12345678, 1, 'bilel-67a1041b03342.jpg', NULL, 1, NULL, NULL, NULL, '2025-02-03 17:59:55', NULL, NULL, 'a:1:{i:1;s:24:\"Conseiller en immobilier\";}', NULL, NULL, NULL, NULL),
(46, 'wassim@gmail.com', '{\"1\": \"ROLE_USER\"}', '$2y$13$zrk0B34Jlt/amWZQzYzv..0PHl89YaiKbf4P3iDTGLFfrPePp8Ofi', 'benfraj', 'wassim', 93313278, 1, 'bf78ba5e3c8082ec9f0414156883978a.jpg', NULL, 0, NULL, NULL, NULL, '2025-02-24 18:42:17', 'rue ben fraj', 'hammamet', 'a:0:{}', NULL, NULL, '857642311', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_ville` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `gouvernorat_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_43C3D9C375B74E2D` (`gouvernorat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`id`, `nom_ville`, `gouvernorat_id`) VALUES
(3, 'Ariana', 1),
(4, 'Raoued', 1),
(5, 'Mnihla', 1),
(6, 'La Soukra', 1),
(7, 'Beja', 2),
(8, 'Tajerouine', 2),
(9, 'Nefza', 2),
(10, 'Medjez El Bab', 2),
(11, 'Ben Arous', 3),
(12, 'Mégrine', 3),
(13, 'Rades', 3),
(14, 'Hammadi', 3),
(15, 'Bizerte', 4),
(16, 'Menzel Bourguiba', 4),
(17, 'Menzel Jemil', 4),
(18, 'Rafraf', 4),
(19, 'Gabès', 5),
(20, 'Médenine', 5),
(21, 'Zarzis', 5),
(22, 'Gafsa', 6),
(23, 'Métlaoui', 6),
(24, 'Redeyef', 6),
(25, 'Jendouba', 7),
(26, 'Bousalem', 7),
(27, 'Tabarka', 7),
(28, 'Ghardimaou', 7),
(29, 'Kairouan', 8),
(30, 'Haffouz', 8),
(31, 'Chébika', 8),
(32, 'Kasserine', 9),
(33, 'Sbeïtla', 9),
(34, 'Thala', 9),
(35, 'Kebili', 10),
(36, 'Douz', 10),
(37, 'Nefta', 10),
(38, 'La Manouba', 11),
(39, 'Tebourba', 11),
(40, 'El Battan', 11),
(41, 'Le Kef', 12),
(42, 'Dahmani', 12),
(43, 'Tajerouine', 12),
(44, 'Mahdia', 13),
(45, 'El Djem', 13),
(46, 'Ksar Hellal', 13),
(47, 'Manouba', 14),
(48, 'Oued Ellil', 14),
(49, 'Cité Ennasr', 14),
(50, 'Médenine', 15),
(51, 'Ben Gardane', 15),
(52, 'El Hamma', 15),
(53, 'Monastir', 16),
(54, 'Moknine', 16),
(55, 'Ksar Hellal', 16),
(56, 'Nabeul', 17),
(57, 'Hammamet', 17),
(58, 'Menzel Temime', 17),
(59, 'Sfax', 18),
(60, 'Skhira', 18),
(61, 'Kerkennah', 18),
(62, 'Sidi Bouzid', 19),
(63, 'Cebbala', 19),
(64, 'Meknassi', 19),
(65, 'Siliana', 20),
(66, 'Makthar', 20),
(67, 'Gaâfour', 20),
(68, 'Tataouine', 21),
(69, 'Bordj El Amri', 21),
(70, 'Ghomrassen', 21),
(71, 'Tozeur', 22),
(72, 'Nefta', 22),
(73, 'Tamerza', 22),
(74, 'Tunis', 23),
(75, 'La Marsa', 23),
(76, 'Cité El Khadra', 23),
(77, 'Zaghouan', 24),
(78, 'Nadhour', 24),
(80, 'Sousse', 25);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bien`
--
ALTER TABLE `bien`
  ADD CONSTRAINT `FK_45EDC38675B74E2D` FOREIGN KEY (`gouvernorat_id`) REFERENCES `gouvernorat` (`id`),
  ADD CONSTRAINT `FK_45EDC386A73F0036` FOREIGN KEY (`ville_id`) REFERENCES `ville` (`id`),
  ADD CONSTRAINT `FK_45EDC386C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type_bien` (`id`),
  ADD CONSTRAINT `FK_45EDC386F5003096` FOREIGN KEY (`publier_par_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `details_propriete`
--
ALTER TABLE `details_propriete`
  ADD CONSTRAINT `FK_9A8574818566CAF` FOREIGN KEY (`propriete_id`) REFERENCES `propriete` (`id`),
  ADD CONSTRAINT `FK_9A85748BD95B80F` FOREIGN KEY (`bien_id`) REFERENCES `bien` (`id`);

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `FK_8933C432A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8933C432BD95B80F` FOREIGN KEY (`bien_id`) REFERENCES `bien` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `historique_action`
--
ALTER TABLE `historique_action`
  ADD CONSTRAINT `FK_8E8E2CCEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `image_bien`
--
ALTER TABLE `image_bien`
  ADD CONSTRAINT `FK_B7D72918BD95B80F` FOREIGN KEY (`bien_id`) REFERENCES `bien` (`id`);

--
-- Contraintes pour la table `propriete`
--
ALTER TABLE `propriete`
  ADD CONSTRAINT `FK_73A85B93C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type_bien` (`id`);

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `FK_723705D13414710B` FOREIGN KEY (`agent_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_723705D1BD95B80F` FOREIGN KEY (`bien_id`) REFERENCES `bien` (`id`);

--
-- Contraintes pour la table `ville`
--
ALTER TABLE `ville`
  ADD CONSTRAINT `FK_43C3D9C375B74E2D` FOREIGN KEY (`gouvernorat_id`) REFERENCES `gouvernorat` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
