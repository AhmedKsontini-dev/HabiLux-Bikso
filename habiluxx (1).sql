-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 10 fév. 2025 à 08:26
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
  `plan` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `localisation_bien` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `afficher_prix` tinyint(1) NOT NULL,
  `date_creation` datetime DEFAULT NULL,
  `publier_par_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_45EDC38675B74E2D` (`gouvernorat_id`),
  KEY `IDX_45EDC386A73F0036` (`ville_id`),
  KEY `IDX_45EDC386C54C8C93` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `bien`
--

INSERT INTO `bien` (`id`, `gouvernorat_id`, `ville_id`, `type_id`, `nom_bien`, `adresse_bien`, `prix_bien`, `type_offre`, `description`, `plan`, `video`, `localisation_bien`, `afficher_prix`, `date_creation`, `publier_par_id`) VALUES
(1, 17, 57, 6, 'S+3', 'hammamet', '50 000', 'A Louer', 'Villa a vendre a Hammamet', NULL, NULL, 'hammamet', 0, '2025-02-05 13:11:23', 33),
(2, 12, 48, 1, 'S+2', 'hammamet', '120 000', 'A Vendre', 'bureau commercial a vendre en centre ville', NULL, NULL, 'rue taher benfraj', 1, '2025-02-07 19:41:43', 33),
(5, 17, 57, 6, 'S+2', 'hammamet', '1 500', 'A Louer', 'test', NULL, NULL, 'hammamet', 1, '2025-02-07 20:36:25', 33);

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
-- Structure de la table `details_propriete`
--

DROP TABLE IF EXISTS `details_propriete`;
CREATE TABLE IF NOT EXISTS `details_propriete` (
  `id` int NOT NULL AUTO_INCREMENT,
  `propriete_id` int DEFAULT NULL,
  `bien_id` int DEFAULT NULL,
  `valeur_propriete` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9A8574818566CAF` (`propriete_id`),
  KEY `IDX_9A85748BD95B80F` (`bien_id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `details_propriete`
--

INSERT INTO `details_propriete` (`id`, `propriete_id`, `bien_id`, `valeur_propriete`) VALUES
(1, 1, 1, '160'),
(2, 2, 1, '2'),
(3, 3, 1, '6'),
(4, 4, 1, '3'),
(5, 5, 1, 'Moderne'),
(6, 6, 1, '2'),
(7, 7, 1, 'Oui'),
(8, 8, 1, 'Oui'),
(9, 9, 1, 'Oui'),
(10, 10, 1, 'Oui'),
(11, 11, 1, 'Garage'),
(12, 12, 1, 'Oui'),
(13, 13, 1, 'Terrain basketball'),
(14, 14, 1, 'Oui'),
(15, 15, 1, 'Non'),
(16, 16, 1, '6 Caméras '),
(17, 17, 1, 'Non'),
(18, 18, 1, 'Oui'),
(19, 19, 2, ''),
(20, 20, 2, ''),
(21, 21, 2, ''),
(22, 22, 2, ''),
(23, 23, 2, ''),
(24, 24, 2, ''),
(25, 25, 2, ''),
(26, 26, 2, ''),
(27, 27, 2, ''),
(28, 28, 2, ''),
(29, 29, 2, ''),
(30, 30, 2, ''),
(31, 31, 2, ''),
(32, 32, 2, ''),
(33, 33, 2, ''),
(34, 34, 2, ''),
(35, 35, 2, ''),
(36, 36, 2, ''),
(72, 1, 5, ''),
(73, 2, 5, ''),
(74, 3, 5, ''),
(75, 4, 5, ''),
(76, 5, 5, ''),
(77, 6, 5, ''),
(78, 7, 5, ''),
(79, 8, 5, ''),
(80, 9, 5, ''),
(81, 10, 5, ''),
(82, 11, 5, ''),
(83, 12, 5, ''),
(84, 13, 5, ''),
(85, 14, 5, ''),
(86, 15, 5, ''),
(87, 16, 5, ''),
(88, 17, 5, ''),
(89, 18, 5, '');

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

-- --------------------------------------------------------

--
-- Structure de la table `gouvernorat`
--

DROP TABLE IF EXISTS `gouvernorat`;
CREATE TABLE IF NOT EXISTS `gouvernorat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_gouvernorat` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
(24, 'Zaghouan');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `image_bien`
--

INSERT INTO `image_bien` (`id`, `bien_id`, `nom_image`, `principal`) VALUES
(1, 1, 'v1-67a3637d735eb.png', 1),
(2, 1, 'v2-67a3637d74136.png', 0),
(3, 1, 'v3-67a3637d742cf.png', 0),
(4, 1, 'v4-67a3637d7441f.png', 0),
(5, 1, 'v5-67a3637d74542.png', 0),
(6, 1, 'v6-67a3637d7465f.png', 0),
(7, 2, 'villa1-67a661f85be3e.jpg', 1),
(10, 5, 'villa1-67a66ecbd246c.jpg', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
(65, 4, 'Électricité et éclairage'),
(66, 4, 'Systèmes de ventilation (Naturelle, mécanique, climatisation industrielle)'),
(67, 4, 'Système de sécurité (Vidéosurveillance, alarme)'),
(68, 4, 'Connexion internet et réseau (Accès à la fibre ou au Wi-Fi)'),
(69, 4, 'Bureaux annexes (Présence de bureaux administratifs)'),
(70, 4, 'Sanitaires et vestiaires');

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `tel`, `verifier`, `photo_profil`, `confirmation_token`, `status`, `instagram`, `linkedin`, `facebook`, `cree_en`, `localisation`, `adresse`, `poste`, `description`, `experience`, `cin`) VALUES
(33, 'ahmedksontini122@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$8I0VZhcDCqJTNg35csoRnu2ZO.WLmA6Vb9d3cr2l3ACoLPjqQWhsu', 'ksontini', 'ahmed', 93313278, 1, 'c568f05c6abb5290f4111fd5a23ae9dd.jpg', NULL, 1, 'https://www.instagram.com/ahmed_ksontini_/', 'https://www.linkedin.com/in/ahmed-ksontini-3589071a0/', 'https://www.facebook.com/ahmed.ksontini.37?locale=fr_FR', '2025-02-01 10:50:44', 'Hammamet', 'Rue taher ben fraj', 'a:1:{i:0;s:22:\"Responsable d’agence\";}', 'Passionné par l\'immobilier et fort d\'une solide expérience dans le secteur, j\'occupe actuellement le poste de Responsable d\'Agence Immobilière. Mon rôle consiste à superviser et développer les activités de l’agence, en garantissant un service client de qu', '15 ans', '08985353'),
(35, 'nidhalSafta@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$OqugijJgk5eju0iD7OuEj.hxM.mW3hA1vMdEdqMkfKrJArR7tskKO', 'safta', 'Nidhal', 22687017, 1, 'WhatsApp-Image-2025-02-03-at-11-50-59-AM-67a09fcf2a3c0.jpg', NULL, 0, NULL, NULL, NULL, '2025-02-03 10:51:59', 'kharouba', 'hammamet', 'a:1:{i:0;s:16:\"Agent immobilier\";}', NULL, NULL, '06423587'),
(36, 'bilel@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$4waxRdAxtGlm6PYC.6z3TOTiECepJBQ6o03tFH6kz7xaT0Ilz3z7m', 'magherby', 'bilel', 12345678, 1, 'bilel-67a1041b03342.jpg', NULL, 0, NULL, NULL, NULL, '2025-02-03 17:59:55', NULL, NULL, 'a:1:{i:1;s:24:\"Conseiller en immobilier\";}', NULL, NULL, NULL),
(37, 'wassim@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$hmXAU4dZKoFOPSKsb5cNYegHcE4RoLbUOp327Xo0jXXr0stv/HEwK', 'ben fradj', 'wassim', 12345678, 1, 'e3ae7ca9d9fc3c60dae8e27cc76f9836.jpg', NULL, 0, 'wassim_benfraj', NULL, 'wassim ben fraj', '2025-02-03 18:05:23', 'Hammamet', 'rue jabnoun', 'a:1:{i:0;s:17:\"Expert immobilier\";}', NULL, NULL, '06589234'),
(38, 'aziz@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$eFdgHJb8pQhEH/4gSoTDK.FxVUI907SRf4OdGOH.mcGa3PT2v9iB6', 'benfraj', 'aziz', 12345678, 1, 'zizou-67a1063d25314.jpg', NULL, 0, NULL, NULL, NULL, '2025-02-03 18:09:01', NULL, NULL, 'a:1:{i:0;s:17:\"Expert immobilier\";}', NULL, NULL, NULL),
(39, 'ali@gmail.com', '[]', '$2y$13$Kf3HRF3bs2kQyFHgAHgvKex9RkXVg93FMZHVDer7jCAmZSRkYmBpm', 'salah', 'ali', 1234566678, 1, 'team-1-67a11e0d1a07d.jpg', NULL, 0, NULL, NULL, NULL, '2025-02-03 19:50:37', 'rue ben fraj', 'hammamet', 'N;', NULL, NULL, '85764231');

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
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
(78, 'Nadhour', 24);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bien`
--
ALTER TABLE `bien`
  ADD CONSTRAINT `FK_45EDC38675B74E2D` FOREIGN KEY (`gouvernorat_id`) REFERENCES `gouvernorat` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_45EDC386A73F0036` FOREIGN KEY (`ville_id`) REFERENCES `ville` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_45EDC386C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type_bien` (`id`);

--
-- Contraintes pour la table `details_propriete`
--
ALTER TABLE `details_propriete`
  ADD CONSTRAINT `FK_9A8574818566CAF` FOREIGN KEY (`propriete_id`) REFERENCES `propriete` (`id`),
  ADD CONSTRAINT `FK_9A85748BD95B80F` FOREIGN KEY (`bien_id`) REFERENCES `bien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `image_bien`
--
ALTER TABLE `image_bien`
  ADD CONSTRAINT `FK_B7D72918BD95B80F` FOREIGN KEY (`bien_id`) REFERENCES `bien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `propriete`
--
ALTER TABLE `propriete`
  ADD CONSTRAINT `FK_73A85B93C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type_bien` (`id`);

--
-- Contraintes pour la table `ville`
--
ALTER TABLE `ville`
  ADD CONSTRAINT `FK_43C3D9C375B74E2D` FOREIGN KEY (`gouvernorat_id`) REFERENCES `gouvernorat` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
