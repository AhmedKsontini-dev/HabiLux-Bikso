-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 15 mai 2025 à 11:49
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
-- Structure de la table `besoin_user`
--

DROP TABLE IF EXISTS `besoin_user`;
CREATE TABLE IF NOT EXISTS `besoin_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `ville_bien` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `gouvernorat_bien` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type_bien` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prix_min` double NOT NULL,
  `prix_max` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AE502A75A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `besoin_user`
--

INSERT INTO `besoin_user` (`id`, `user_id`, `ville_bien`, `gouvernorat_bien`, `type_bien`, `prix_min`, `prix_max`) VALUES
(1, 33, 'sousse', 'sousse', 'Appartement', 10000, 50000),
(2, 33, 'Ariana', 'Ariana', 'Villa', 10000, 200000);

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
  `prix_bien` int NOT NULL,
  `type_offre` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `afficher_prix` tinyint(1) NOT NULL,
  `date_creation` datetime DEFAULT NULL,
  `publier_par_id` int NOT NULL,
  `tel_proprietaire2` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `position_map` longtext COLLATE utf8mb3_unicode_ci,
  `bien_afficher` tinyint(1) NOT NULL DEFAULT '1',
  `nom_proprietaire` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tel_proprietaire1` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `adresse_proprietaire` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `youtube_id` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `disponibilite` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_45EDC38675B74E2D` (`gouvernorat_id`),
  KEY `IDX_45EDC386A73F0036` (`ville_id`),
  KEY `IDX_45EDC386C54C8C93` (`type_id`),
  KEY `IDX_45EDC386F5003096` (`publier_par_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12590 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `bien`
--

INSERT INTO `bien` (`id`, `gouvernorat_id`, `ville_id`, `type_id`, `nom_bien`, `adresse_bien`, `prix_bien`, `type_offre`, `description`, `afficher_prix`, `date_creation`, `publier_par_id`, `tel_proprietaire2`, `position_map`, `bien_afficher`, `nom_proprietaire`, `tel_proprietaire1`, `adresse_proprietaire`, `youtube_id`, `disponibilite`) VALUES
(12560, 17, 57, 1, 'Bureau', 'Centre-Ville', 1350, 'A Louer', 'C\'est un bureau H+3 situé au premier étage d\'une résidence avec ascenseur sis au centre ville Nabeul.  Cet espace de travail comprend ,un hall d\'accueil, trois bureaux spacieux, une kitchenette et un point d\'eau.  Il bénéficie d\'une visibilité grâce à son', 1, '2025-05-04 18:49:31', 50, '20536895', '36.45652555847018,10.742917026842573', 1, 'mohsen', '93313256', 'nabeul', '-MQMPegvO0U', 'Disponible'),
(12564, 17, 57, 6, 'Villa individuelle en vente', 'Oued baten hammamet sud', 2300000, 'A Vendre', 'Implantée sur un terrain de superficie totale égale à 2200m² dont 600m² dont l’espace bâtie est une agréable villa avec un piscine. Elle situé à deux minutes de la mer au plein cœur de la zone touristique Hammamet Sud. L’espace bâtie se répartie comme sui', 1, '2025-05-04 20:03:27', 33, '20536895', '36.41094953452815,10.584312978333404', 0, 'aziz bouksila', '93313256', 'hammamet', '-MQMPegvO0U', 'Non_disponible'),
(12565, 23, 74, 5, 'S+3 en vente', 'Gammarth', 220000, 'A Vendre', 'un appartement S+3 situé au 1er étage d’une résidence calme à Gammarth.  À l’entrée, vous serez accueilli par un salon lumineux ouvrant sur une terrasse, une cuisine fonctionnelle avec séchoir.  La partie nuit se compose de trois chambres à coucher, dont', 1, '2025-05-08 11:02:26', 33, '20536895', '36.909438866587934,10.291143535636051', 1, 'nidhal', '93313256', 'hammamet', '-MQMPegvO0U', 'Disponible'),
(12566, 25, 80, 2, 'Terrain habitation', 'Gammarth', 440000, 'A Vendre', 'un terrain exceptionnel situé à Gammarth Village, dans un quartier résidentiel recherché de la banlieue nord de Tunis.  Ce terrain bénéficie d’un emplacement idéal, à proximité immédiate des écoles, commerces et toutes les commodités nécessaires au quotid', 1, '2025-05-08 11:06:27', 33, '20536895', '35.765680673666246,10.530625939831246', 1, 'mounir sehli', '93313256', 'hammamet', '-MQMPegvO0U', 'Disponible'),
(12567, 16, 53, 5, 'Studio en vente', 'Monastir - Skanes La Falaise', 120000, 'A Vendre', 'Cet appartement meublé est situé zone Sweni, à seulement 5 minutes à pied de la plage et à proximité de toutes les commodités.  L’entrée s’ouvre sur un salon lumineux, avec une cuisine américaine entièrement équipée (plaque de cuisson, hotte). La partie n', 1, '2025-05-08 11:11:23', 33, '20536895', '35.62426103102311,10.74705496683211', 1, 'amine', '93313256', 'sousse', '-MQMPegvO0U', 'Disponible'),
(12568, 13, 44, 5, 'S+2 en vente', 'Mahdia - Zone Touristique Mahdia', 310000, 'A Vendre', 'Cet appartement offre un emplacement stratégique, proche de toutes les commodités et à quelques minutes de la plage.  Dès l\'entrée on trouve un espace de vie lumineux et à la fois spacieux, qui peut agencer aisément un salon et une salle à manger.  La cui', 1, '2025-05-08 11:28:45', 33, '20536895', '35.5083066978012,11.038688661978735', 1, 'chawki', '93313256', 'mahdia', '-MQMPegvO0U', 'Disponible'),
(12569, 17, 57, 5, 'S+2 en location', 'Salakta', 650, 'A Louer', 'Cet appartement vide est situé dans une résidence calme et sécurisée, à quelques minutes de la plage.  Dès l\'entrée, on trouve un espace de vie lumineux et spacieux, pouvant facilement accueillir un salon et une salle à manger, donnant accès à un balcon d', 1, '2025-05-08 12:06:53', 33, NULL, '36.40802070382984,10.640633858317553', 1, 'mohamed habibi', '93313256', 'hammamet', '-MQMPegvO0U', 'Disponible'),
(12570, 13, 44, 6, 'Villa en bande', 'Jinen el mansoura', 3000, 'A Louer', 'Cette élégante villa jumelée, en cours de finition, s\'élève sur trois niveaux et est nichée dans un quartier calme et résidentiel à El Fatha.\r\n\r\nRez-de-chaussée :\r\n\r\nVilla S+2 avec entrée indépendante. Dès l\'entrée, vous êtes accueilli par une kitchenette', 1, '2025-05-08 12:34:11', 33, '20536895', '35.47677567081545,11.03630750156761', 1, 'med habib', '93313256', 'mahdia', '-MQMPegvO0U', 'Louee'),
(12571, 17, 57, 4, 'Dépôt - Location', 'Hammamet Sud', 2000, 'A Louer', 'Découvrez une opportunité exceptionnelle pour votre entreprise à Hammamet Sud, Nabeul, Tunisia ! Ce dépôt commercial, en bon état, est une excellente valeur sur le marché immobilier. Idéalement situé à proximité de la mosquée, de l\'autoroute, des commerce', 1, '2025-05-08 12:54:11', 36, NULL, '36.40547861263018,10.568017551685836', 1, 'yassine', '93313256', 'hammamet', '-MQMPegvO0U', 'Disponible'),
(12572, 1, 74, 6, 'Villa - Vente', 'La Soukra Ariana Tunisie', 1800000, 'A Vendre', 'On vous propose à la vente en exclusivité une villa S+5 sur un terrain de\r\n1651m ² et 420 m ² bâtis.\r\nElle se compose de:\r\n- Un salon et un séjour lumineux ouverts sur lextérieur.\r\n- Une suite parentale avec vue sur le jardin.', 1, '2025-05-08 13:23:40', 36, NULL, '36.85358799105456,10.185168160741071', 1, 'oussema', '93313256', 'hammamet', '-MQMPegvO0U', 'Disponible'),
(12573, 23, 74, 4, 'Dépôt - Location', 'Séjoumi Tunis', 1700, 'A Louer', 'HABILUX vous propose à la location un Dépôt de stockage de 1000m² sur la route principale de Séjoumi\r\nDépôt + un studio pour le gardien\r\nSuperficie : 1000m²\r\n\r\nLoyer 2700 DT/HT\r\n\r\nPour plus d\'information veuillez nous contacter.', 1, '2025-05-08 13:51:43', 36, NULL, '36.79718920417815,9.963394734747213', 1, 'ridha', '93313256', 'tunis', '-MQMPegvO0U', 'Disponible'),
(12574, 25, 80, 4, 'Dépôt', 'khzema-sousse', 25000, 'A Vendre', 'HabiLux vous propose à la location un espace de stockage à charguia 1. avec Monte-charge\r\ncomposé comme suit :\r\nRDC: 1800m² stockage hauteur 5 m\r\nEtage: 1200m² stockage hauteur : 5m en dalle\r\n600m² administration\r\nLoyer :sur demande\r\nPour plus amples info', 1, '2025-05-08 14:02:07', 36, NULL, '35.82633761665516,10.618384649781524', 1, 'ahmed', '93313256', 'sousse', '-MQMPegvO0U', 'Disponible'),
(12575, 17, 57, 4, 'Dépôt - Location', 'HANGAR', 20000, 'A Vendre', 'Location d\'un hangar à la sortie de Nabeul.\r\n\r\n▪️ 2000 M2 de surface d\'exploitation, répartis sur 2 blocs de surface approximative de 1200 M2 ( Bloc A )\r\net 800 M2 ( Bloc 2 ), avec possibilité d\'extension de 1000 M2 supplémentaires de bâtit attenant.', 1, '2025-05-08 14:15:18', 33, NULL, '36.45000844447082,10.705538775112991', 1, 'monji', '93313256', 'nabeul', '-MQMPegvO0U', 'Disponible'),
(12576, 13, 44, 4, 'Dépôt - Location', 'à Lebna', 12000, 'A Louer', 'HabiLux propose à la location ou à la vente un local commercial valable pour une usine ou un dépôt dans un emplacement stratégique directement sur la route MC27 entre Korba et Menzel Temim Niveau Chatt Ezzouhour.\r\n\r\nLa superficie exploitable qui est couve', 1, '2025-05-08 14:22:12', 36, NULL, '35.50279777500469,11.045452198510175', 1, 'aziz', '93313256', 'mahdia', '-MQMPegvO0U', 'Disponible'),
(12577, 16, 53, 4, 'Dépôt', 'à Raoued', 45000, 'A Vendre', 'Un local industriel spacieux offrant une surface bâtie de 2000 m² sur un terrain de 2500 m².\r\n\r\nCaractéristiques clés :\r\n\r\nSurface bâtie : 2000 m²', 1, '2025-05-08 14:33:48', 36, NULL, '35.70702611287749,10.70487847332938', 1, 'khmaies', '93313256', 'monastir', '-MQMPegvO0U', 'Disponible'),
(12578, 16, 53, 5, 'Appartemant S+3', 'Ksibet El Mediouni', 35000, 'A Vendre', 'Nous proposons à la location un appartement de type S+3, d’une superficie de 110 m², situé dans une résidence calme et bien entretenue, bénéficiant d’un excellent emplacement à proximité immédiate des commodités essentielles (écoles, commerces, transports', 1, '2025-05-08 14:52:26', 36, NULL, '35.72510009504976,10.815342148939411', 1, 'ridha', '93313256', 'monastir', '-MQMPegvO0U', 'Disponible'),
(12579, 25, 80, 5, 'Appartement S+3', 'Skanes La Falaise', 1200, 'A Louer', 'Cet appartement est situé au premier étage d’une résidence calme et résidentielle, avec ascenseur et place de parking au sous-sol.\r\n\r\nL’entrée s’ouvre sur une pièce de vie lumineuse.\r\nLa cuisine, bien agencée, est équipée de rangements fonctionnels et don', 1, '2025-05-08 14:57:56', 36, NULL, '35.8644583170048,10.608700075356198', 1, 'yassine', '93313256', 'sousse', '-MQMPegvO0U', 'Disponible'),
(12580, 17, 57, 6, 'Villa individuelle en vente', 'Hammamet Sud', 870000, 'A Vendre', 'Cette villa meublé S+6 offre un cadre de vie idéal pour une grande famille ou un projet d’investissement.\r\n\r\nÉrigée sur trois niveaux, elle se compose de six chambres à coucher bien réparties, assurant confort et intimité à chaque étage.\r\n\r\nLe sous-sol co', 1, '2025-05-08 17:10:37', 33, NULL, '36.40686019192426,10.559438982877758', 1, 'bilel', '93313256', 'hammamet', '-MQMPegvO0U', 'Disponible'),
(12581, 25, 80, 6, 'Villa individuelle en location', 'hamem soussa', 3500, 'A Louer', 'Cette villa S+4, idéalement située au cœur de la zone touristique de Hammamet Sud, à proximité immédiate de la mer. Elle se compose d’un spacieux salon lumineux, d’une cuisine indépendante entièrement équipée (plaque de cuisson, four électrique, réfrigéra', 1, '2025-05-08 17:30:36', 33, NULL, '35.87106534714805,10.60496731251989', 1, 'med habib', '93313256', 'sousse', '-MQMPegvO0U', 'Disponible'),
(12582, 23, 74, 6, 'Villa individuelle en location', 'soukra', 3600, 'A Louer', 'Cette villa se situe dans une résidence sécurisée, les pieds dans l’eau, à Jinen Hammamet. Le salon, lumineux, s’ouvre sur un jardin privatif. La cuisine est indépendante et entièrement équipée. La partie nuit se compose de six chambres à coucher répartie', 1, '2025-05-08 17:41:39', 33, NULL, '36.856823474483754,10.295219022618902', 1, 'amine', '93313256', 'tunis', '-MQMPegvO0U', 'Disponible'),
(12583, 16, 53, 1, 'Bureau en vente', 'Monastir - Skanes La Falaise', 190000, 'A Vendre', 'Ce bureau se compose de deux pièces fonctionnelles, idéales pour une activité professionnelle.\r\n\r\nProfitez d\'un emplacement stratégique au centre-ville, offrant une accessibilité facile et un cadre de travail agréable.', 1, '2025-05-08 18:14:13', 33, NULL, '35.771697691969905,10.809201531601078', 1, 'amine', '93313256', 'monastir', '-MQMPegvO0U', 'Disponible'),
(12584, 13, 44, 2, 'Terrain habitation', 'Mahdia', 800, 'A Louer', 'Ce terrain d\'exception, idéalement situé à l\'angle de deux rues dans un quartier résidentiel prisé. D\'une superficie de 651 m² et de forme rectangulaire, il bénéficie de façades de 31 m et 25 m, offrant ainsi de nombreuses possibilités d\'aménagement. Son ', 1, '2025-05-08 18:22:18', 33, NULL, '35.48728740575157,11.00702010785291', 1, 'ahmed', '93313256', 'mahdia', '-MQMPegvO0U', 'Disponible'),
(12585, 23, 74, 1, 'Hall+4 en vente', 'Lafayette', 400000, 'A Vendre', 'Nous proposons à la vente un bureau Hall + 4 d’une superficie de 170 m², situé au 7 étage d’un immeuble équipé d’un ascenseur, à Lafayette, en deuxième position par rapport à l’avenue Mohamed V. Offrant une vue dégagée sur le centre-ville de Tunis et le L', 1, '2025-05-11 13:35:45', 50, NULL, '36.81365854108129,10.182376346480657', 1, 'amine', '93313256', 'tunis', '-MQMPegvO0U', 'Disponible'),
(12586, 17, 57, 1, 'Hall+2 en location', 'Nabeul centre', 1300, 'A Louer', 'Ce bureau en H+2 se situe au quatrième étage d\'un immeuble situé au cœur de l\'Ariana dans un immeuble récent équipé par un double ascenseur. Cet immeuble sécurisé a un gardien.\r\n\r\nÀ l’entrée vous trouvez une salle de réception.\r\n\r\nDans la continuité, deux', 1, '2025-05-11 13:48:14', 50, NULL, '36.45442688547802,10.738035133122175', 1, 'mohsen', '93313256', 'nabeul', '-MQMPegvO0U', 'Disponible');

--
-- Déclencheurs `bien`
--
DROP TRIGGER IF EXISTS `insertProprieteBien`;
DELIMITER $$
CREATE TRIGGER `insertProprieteBien` AFTER INSERT ON `bien` FOR EACH ROW BEGIN



insert into details_propriete select null,id,new.id,null,0 from propriete where type_id=new.type_id;


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
  `status` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'en_attente',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `contact_message`
--

INSERT INTO `contact_message` (`id`, `name`, `email`, `message`, `created_at`, `is_read`, `tel`, `status`) VALUES
(29, 'ahmed ksontini', 'ahmedksontini122@gmail.com', 'test message', '2025-05-08 19:53:10', 1, '93313278', 'confirmer');

-- --------------------------------------------------------

--
-- Structure de la table `details_propriete`
--

DROP TABLE IF EXISTS `details_propriete`;
CREATE TABLE IF NOT EXISTS `details_propriete` (
  `id` int NOT NULL AUTO_INCREMENT,
  `propriete_id` int DEFAULT NULL,
  `bien_id` int NOT NULL,
  `valeur_propriete` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `afficher` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9A8574818566CAF` (`propriete_id`),
  KEY `IDX_9A85748BD95B80F` (`bien_id`)
) ENGINE=InnoDB AUTO_INCREMENT=427 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `details_propriete`
--

INSERT INTO `details_propriete` (`id`, `propriete_id`, `bien_id`, `valeur_propriete`, `afficher`) VALUES
(270, 86, 12560, '1er', 1),
(271, 87, 12560, '2010', 0),
(272, 88, 12560, '2019', 1),
(273, 89, 12560, ' Haut standing', 1),
(277, 90, 12560, 'Autnome', NULL),
(291, 91, 12564, ' Moyen standing', 1),
(292, 92, 12564, '2000', 1),
(293, 93, 12564, 'oui', 1),
(294, 94, 12565, 'bas', 1),
(295, 95, 12565, 'disponible', 1),
(296, 96, 12565, ' Haut standing', 0),
(297, 97, 12565, '2010', 1),
(301, 98, 12566, '100', 1),
(302, 94, 12567, '2eme etage', 1),
(303, 95, 12567, 'disponible', 1),
(304, 96, 12567, ' Haut standing', 0),
(305, 97, 12567, '2005', 1),
(309, 94, 12568, '2eme etage', 1),
(310, 95, 12568, 'disponible', 1),
(311, 96, 12568, 'haut standing', 1),
(312, 97, 12568, '2022', 1),
(316, 94, 12569, '1er etage', 1),
(317, 95, 12569, 'non disponible', 1),
(318, 96, 12569, ' Haut standing', 0),
(319, 97, 12569, '2015', 1),
(323, 91, 12570, 'haut standing', 1),
(324, 92, 12570, '2023', 1),
(325, 93, 12570, 'oui', 1),
(326, 99, 12571, '120', 1),
(327, 100, 12571, '10', 1),
(328, 101, 12571, '2', 1),
(329, 91, 12572, 'Haut standing', 1),
(330, 92, 12572, '2016', 1),
(331, 93, 12572, 'oui', 1),
(332, 99, 12573, '180', 1),
(333, 100, 12573, '15', 1),
(334, 101, 12573, '1', 1),
(335, 99, 12574, '1000', 1),
(336, 100, 12574, '5', 1),
(337, 101, 12574, '0', 1),
(338, 99, 12575, '160', 1),
(339, 100, 12575, '10', 1),
(340, 101, 12575, '0', 1),
(341, 99, 12576, '1200', 1),
(342, 100, 12576, '13', 1),
(343, 101, 12576, '1', 1),
(344, 99, 12577, '2000', 1),
(345, 100, 12577, '18', 1),
(346, 101, 12577, '1', 1),
(347, 94, 12578, '2eme etage', 1),
(348, 95, 12578, 'non disponible ', 0),
(349, 96, 12578, 'normal', 1),
(350, 97, 12578, '2014', 1),
(354, 94, 12579, ' 1 (étage moyen)', 1),
(355, 95, 12579, ' Centrale ', 0),
(356, 96, 12579, ' Haut standing', 1),
(357, 97, 12579, ' 2019', 1),
(361, 102, 12579, 'oui', NULL),
(362, 103, 12579, 'non', NULL),
(363, 91, 12580, ' Moyen standing', 1),
(364, 92, 12580, ' 2020', 1),
(365, 93, 12580, 'oui', 1),
(366, 104, 12580, 'privé', 0),
(367, 91, 12581, ' Haut standing', 1),
(368, 92, 12581, ' 2019', 0),
(369, 93, 12581, 'oui', 1),
(370, 104, 12581, 'oui', 1),
(374, 105, 12581, 'oui', NULL),
(375, 91, 12582, ' Moyen standing', 1),
(376, 92, 12582, '2020', 1),
(377, 93, 12582, 'oui', 1),
(378, 104, 12582, 'oui', 0),
(379, 105, 12582, 'oui', 0),
(382, 86, 12583, ' 4 (étage elevé)', 1),
(383, 87, 12583, '2012', 1),
(384, 88, 12583, '2020', 0),
(385, 89, 12583, 'normal', 1),
(386, 90, 12583, '', 0),
(389, 98, 12584, '400', 1),
(390, 86, 12585, '7 (étage elevé)', 1),
(391, 87, 12585, ' 2009', 1),
(392, 88, 12585, '', 0),
(393, 89, 12585, ' Moyen standing', 1),
(394, 90, 12585, '', 0),
(397, 107, 12585, '700', NULL),
(398, 86, 12586, ' 4 (étage elevé)', 0),
(399, 87, 12586, '2023', 1),
(400, 88, 12586, '', 0),
(401, 89, 12586, ' Haut standing', 1),
(402, 90, 12586, ' Centralisée', 0),
(403, 107, 12586, ' 75', 1),
(405, 108, 12586, 'oui', NULL);

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
('DoctrineMigrations\\Version20250405195806', '2025-04-05 19:58:19', 17),
('DoctrineMigrations\\Version20250406141629', '2025-04-06 14:20:14', 67),
('DoctrineMigrations\\Version20250406145408', '2025-04-06 14:54:30', 21),
('DoctrineMigrations\\Version20250406154745', '2025-04-06 15:49:36', 21),
('DoctrineMigrations\\Version20250406163830', '2025-04-06 16:38:58', 59),
('DoctrineMigrations\\Version20250407195426', '2025-04-07 19:56:24', 54),
('DoctrineMigrations\\Version20250408012845', '2025-04-08 01:29:10', 43),
('DoctrineMigrations\\Version20250408153144', '2025-04-08 15:31:57', 52),
('DoctrineMigrations\\Version20250408162151', '2025-04-08 16:22:07', 41),
('DoctrineMigrations\\Version20250428144339', '2025-04-28 14:43:58', 79),
('DoctrineMigrations\\Version20250504175505', '2025-05-04 17:55:45', 95),
('DoctrineMigrations\\Version20250504185818', '2025-05-04 18:58:36', 32),
('DoctrineMigrations\\Version20250514191505', '2025-05-14 19:15:39', 105);

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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id`, `title`, `start_date`, `end_date`, `description`) VALUES
(35, 'visite du bien', '2025-05-09 10:00:00', '2025-05-09 11:00:00', 'visite du bien ID: 1670\nA 10H \nnom di client : mohamed \ntel: 93311325');

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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=300 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `historique_action`
--

INSERT INTO `historique_action` (`id`, `user_id`, `action`, `description`, `date_action`) VALUES
(206, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-04 18:42:37'),
(207, 33, 'Ajout', 'Ajout d\'un nouveau propriété ', '2025-05-04 18:46:12'),
(208, 33, 'Ajout', 'Ajout d\'un nouveau propriété ', '2025-05-04 18:46:33'),
(209, 33, 'Ajout', 'Ajout d\'un nouveau propriété ', '2025-05-04 18:46:49'),
(210, 33, 'Ajout', 'Ajout d\'un nouveau propriété ', '2025-05-04 18:47:03'),
(211, 33, 'Suppression', 'Suppression de bien ', '2025-05-04 18:47:49'),
(212, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-04 18:49:31'),
(213, 33, 'Ajout', 'Ajout d\'une nouvelle transaction ', '2025-05-04 18:54:49'),
(214, 33, 'Ajout', 'Ajout d\'un nouveau propriété ', '2025-05-04 19:44:23'),
(215, 33, 'Ajout', 'Ajout d\'un nouveau propriété ', '2025-05-04 19:44:34'),
(216, 33, 'Ajout', 'Ajout d\'un nouveau propriété ', '2025-05-04 19:44:59'),
(217, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-04 19:46:54'),
(218, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-04 19:47:41'),
(219, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-04 20:00:51'),
(220, 33, 'Modification', 'Modification de bien ID: 12563', '2025-05-04 20:01:26'),
(221, 33, 'Suppression', 'Suppression de bien ', '2025-05-04 20:02:18'),
(222, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-04 20:03:28'),
(223, 33, 'Modification', 'Modification de bien ID: 12564', '2025-05-04 20:03:39'),
(224, 33, 'Ajout', 'Ajout d\'un nouveau propriété ', '2025-05-08 10:57:28'),
(225, 33, 'Ajout', 'Ajout d\'un nouveau propriété ', '2025-05-08 10:57:38'),
(226, 33, 'Ajout', 'Ajout d\'un nouveau propriété ', '2025-05-08 10:57:49'),
(227, 33, 'Ajout', 'Ajout d\'un nouveau propriété ', '2025-05-08 10:58:00'),
(228, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-08 11:02:27'),
(229, 33, 'Ajout', 'Ajout d\'un nouveau propriété ', '2025-05-08 11:04:09'),
(230, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-08 11:06:27'),
(231, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-08 11:11:24'),
(232, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-08 11:28:45'),
(233, 33, 'Ajout', 'Ajout d\'un nouveau propriété ', '2025-05-08 11:53:08'),
(234, 33, 'Ajout', 'Ajout d\'un nouveau propriété ', '2025-05-08 11:53:17'),
(235, 33, 'Ajout', 'Ajout d\'un nouveau propriété ', '2025-05-08 11:53:39'),
(236, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-08 12:06:53'),
(237, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-08 12:34:11'),
(238, 36, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-08 12:54:11'),
(239, 36, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-08 13:23:41'),
(240, 36, 'Modification', 'Modification de bien ID: 12572', '2025-05-08 13:34:25'),
(241, 36, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-08 13:51:44'),
(242, 36, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-08 14:02:08'),
(243, 36, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-08 14:15:19'),
(244, 36, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-08 14:22:13'),
(245, 36, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-08 14:33:48'),
(246, 36, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-08 14:52:26'),
(247, 36, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-08 14:57:57'),
(248, 36, 'Modification', 'Modification de bien ID: 12579', '2025-05-08 15:01:43'),
(249, 33, 'Modification', 'Modification de client ID: 50', '2025-05-08 15:12:22'),
(250, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-08 17:10:39'),
(251, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-08 17:30:37'),
(252, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-08 17:41:40'),
(253, 33, 'Modification', 'Modification de bien ID: 12582', '2025-05-08 18:08:44'),
(254, 33, 'Modification', 'Modification de bien ID: 12560', '2025-05-08 18:09:09'),
(255, 33, 'Modification', 'Modification de bien ID: 12575', '2025-05-08 18:09:37'),
(256, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-08 18:14:14'),
(257, 33, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-08 18:22:18'),
(258, 33, 'Modification', 'Modification de bien ID: 12560', '2025-05-08 18:32:35'),
(259, 33, 'Ajout', 'Ajout d\'un nouveau date de visite dans le calendrier ', '2025-05-08 19:27:04'),
(260, 33, 'Modification', 'Modification de client ID: 35', '2025-05-08 19:34:29'),
(261, 33, 'Modification', 'Modification de client ID: 35', '2025-05-08 19:42:19'),
(262, 33, 'Modification', 'Modification de client ID: 48', '2025-05-08 19:42:35'),
(263, 33, 'Suppression', 'Suppression de client ', '2025-05-08 19:43:31'),
(264, 33, 'Modification', 'Modification de client ID: 36', '2025-05-08 19:45:01'),
(265, 33, 'Modification', 'Modification de client ID: 36', '2025-05-08 19:45:42'),
(266, 33, 'Modification', 'Modification de client ID: 36', '2025-05-08 19:45:54'),
(267, 33, 'Modification', 'Modification de propriété ID: 89', '2025-05-08 19:50:33'),
(268, 33, 'Modification', 'Modification de propriété ID: 89', '2025-05-08 19:51:02'),
(269, 33, 'Ajout', 'Ajout d\'un nouveau propriété ', '2025-05-08 19:51:33'),
(270, 33, 'Suppression', 'Suppression de propriété ', '2025-05-08 19:51:44'),
(271, 50, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-11 13:35:47'),
(272, 50, 'Modification', 'Modification de propriété ID: 107', '2025-05-11 13:39:04'),
(273, 50, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-11 13:48:14'),
(274, 50, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-11 13:55:33'),
(275, 50, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-11 13:56:15'),
(276, 50, 'Suppression', 'Suppression de bien ', '2025-05-11 14:03:50'),
(277, 50, 'Ajout', 'Ajout d\'un nouveau bien ', '2025-05-12 09:20:47'),
(278, 50, 'Modification', 'Modification de bien ID: 12560', '2025-05-12 09:22:42'),
(279, 50, 'Suppression', 'Suppression de bien ', '2025-05-12 09:26:34'),
(280, 50, 'Modification', 'Modification de bien ID: 12560', '2025-05-12 09:46:03'),
(281, 50, 'Ajout', 'Ajout d\'une nouvelle transaction ', '2025-05-14 20:45:59'),
(282, 50, 'Modification', 'Modification de transaction ID: 15 ', '2025-05-14 20:57:29'),
(283, 50, 'Modification', 'Modification de transaction ID: 15 ', '2025-05-14 21:03:30'),
(284, 50, 'Modification', 'Modification de transaction ID: 15 ', '2025-05-14 21:03:50'),
(285, 50, 'Suppression', 'Suppression d\'une transaction ', '2025-05-14 21:06:37'),
(286, 50, 'Modification', 'Modification de transaction ID: 14 ', '2025-05-14 21:08:35'),
(287, 50, 'Modification', 'Modification de transaction ID: 14 ', '2025-05-14 21:09:39'),
(288, 50, 'Ajout', 'Ajout d\'une nouvelle transaction ', '2025-05-14 21:10:43'),
(289, 50, 'Modification', 'Modification de bien ID: 12586', '2025-05-14 21:13:17'),
(290, 50, 'Modification', 'Modification de bien ID: 12585', '2025-05-14 21:13:31'),
(291, 50, 'Ajout', 'Ajout d\'une nouvelle transaction ', '2025-05-14 21:32:17'),
(292, 50, 'Ajout', 'Ajout d\'une nouvelle transaction ', '2025-05-14 21:33:09'),
(293, 50, 'Ajout', 'Ajout d\'une nouvelle transaction ', '2025-05-14 21:34:33'),
(294, 50, 'Ajout', 'Ajout d\'une nouvelle transaction ', '2025-05-14 21:36:23'),
(295, 50, 'Ajout', 'Ajout d\'une nouvelle transaction ', '2025-05-14 21:38:13'),
(296, 50, 'Modification', 'Modification de bien ID: 12570', '2025-05-14 21:39:18'),
(297, 50, 'Modification', 'Modification de bien ID: 12570', '2025-05-14 21:40:34'),
(298, 33, 'Modification', 'Modification de bien ID: 12570', '2025-05-15 11:38:35'),
(299, 33, 'Modification', 'Modification de bien ID: 12564', '2025-05-15 11:39:30');

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
) ENGINE=InnoDB AUTO_INCREMENT=300 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `image_bien`
--

INSERT INTO `image_bien` (`id`, `bien_id`, `nom_image`, `principal`) VALUES
(88, 12560, 'gallery-1-6817b6bbe9b19.jpg', 1),
(89, 12560, 'gallery-2-6817b6bbe9f14.jpg', 1),
(90, 12560, 'gallery-3-6817b6bbea0c1.jpg', 1),
(91, 12560, 'gallery-4-6817b6bbea252.jpg', 1),
(92, 12560, 'gallery-6817b6bbea3c9.jpg', 1),
(132, 12564, 'gallery-5-6817c8107e434.jpg', 1),
(133, 12564, 'gallery-6-6817c8107ea13.jpg', 1),
(134, 12564, 'gallery-7-6817c8107ed43.jpg', 1),
(135, 12564, 'gallery-8-6817c8107f049.jpg', 1),
(136, 12564, 'gallery-9-6817c8107f371.jpg', 1),
(137, 12564, 'gallery-10-6817c8107f656.jpg', 1),
(138, 12564, 'gallery-11-6817c8107fa77.jpg', 1),
(139, 12564, 'gallery-12-6817c8107fd79.jpg', 1),
(140, 12564, 'gallery-13-6817c81080101.jpg', 1),
(141, 12564, 'gallery-14-6817c81080645.jpg', 1),
(142, 12564, 'gallery-15-6817c81080a13.jpg', 1),
(143, 12564, 'gallery-16-6817c81080db4.jpg', 1),
(144, 12564, 'gallery-17-6817c81081123.jpg', 1),
(145, 12565, 'gallery-1-681c8f43067dc.jpg', 1),
(146, 12565, 'gallery-2-681c8f4307f08.jpg', 1),
(147, 12565, 'gallery-3-681c8f4308085.jpg', 1),
(148, 12565, 'gallery-4-681c8f43081c0.jpg', 1),
(149, 12565, 'gallery-5-681c8f43082ee.jpg', 1),
(150, 12565, 'gallery-6-681c8f4308485.jpg', 1),
(151, 12565, 'gallery-7-681c8f4308607.jpg', 1),
(152, 12565, 'gallery-8-681c8f4308764.jpg', 1),
(153, 12565, 'gallery-681c8f4308899.jpg', 1),
(154, 12566, 'gallery-9-681c9033e9dfc.jpg', 1),
(155, 12567, 'gallery-10-681c915c71a2c.jpg', 1),
(156, 12567, 'gallery-11-681c915c72430.jpg', 1),
(157, 12567, 'gallery-12-681c915c72ab5.jpg', 1),
(158, 12567, 'gallery-13-681c915c72f8d.jpg', 1),
(159, 12567, 'gallery-14-681c915c73478.jpg', 1),
(160, 12568, 'gallery-15-681c956dcded8.jpg', 1),
(161, 12568, 'gallery-16-681c956dce5df.jpg', 1),
(162, 12568, 'gallery-17-681c956dcea46.jpg', 1),
(163, 12568, 'gallery-18-681c956dcee29.jpg', 1),
(164, 12568, 'gallery-19-681c956dcf18d.jpg', 1),
(165, 12568, 'gallery-20-681c956dcf5c4.jpg', 1),
(166, 12568, 'gallery-21-681c956dcf98f.jpg', 1),
(167, 12568, 'gallery-22-681c956dcfccc.jpg', 1),
(168, 12568, 'gallery-23-681c956dcffa9.jpg', 1),
(169, 12569, 'gallery-1-681c9e5de6c77.jpg', 1),
(170, 12569, 'gallery-2-681c9e5de74f7.jpg', 1),
(171, 12569, 'gallery-3-681c9e5de795d.jpg', 1),
(172, 12569, 'gallery-4-681c9e5de7d99.jpg', 1),
(173, 12569, 'gallery-5-681c9e5de81ec.jpg', 1),
(174, 12569, 'gallery-681c9e5de863e.jpg', 1),
(175, 12570, 'gallery-6-681ca4c3b76ae.jpg', 1),
(176, 12570, 'gallery-7-681ca4c3b7c95.jpg', 1),
(177, 12570, 'gallery-8-681ca4c3b8086.jpg', 1),
(178, 12570, 'gallery-9-681ca4c3b8484.jpg', 1),
(179, 12570, 'gallery-10-681ca4c3b8811.jpg', 1),
(180, 12570, 'gallery-11-681ca4c3b8bfd.jpg', 1),
(181, 12570, 'gallery-12-681ca4c3b8ffb.jpg', 1),
(182, 12570, 'gallery-13-681ca4c3b9454.jpg', 1),
(183, 12570, 'gallery-14-681ca4c3b97c9.jpg', 1),
(184, 12571, 'L-13b73dda-929b-4f2d-9fed-f225b2cb8a0c-681ca973e0bf2.jpg', 1),
(185, 12571, 'L-37b4589d-fd7d-41c6-a71f-f72bb4d1f691-681ca973e12f4.jpg', 1),
(186, 12571, 'L-438e3c4d-5c78-4748-8816-756440ef65b0-681ca973e15d0.jpg', 1),
(187, 12571, 'L-cbe6cae2-5ab4-48ec-a1f4-6213fd5f94f8-681ca973e195d.jpg', 1),
(188, 12571, 'L-eeb4f9f6-2f28-4b0e-bd4e-54a1e13d4c53-681ca973e1c6e.jpg', 1),
(189, 12571, 'L-fae2d16d-bd9f-485e-b39d-4011582ad29f-681ca973e208f.jpg', 1),
(190, 12572, 'GTImageHandler-1-681cb05d9076a.jpg', 1),
(191, 12572, 'GTImageHandler-2-681cb05d90f12.jpg', 1),
(192, 12572, 'GTImageHandler-3-681cb05d912b7.jpg', 1),
(193, 12572, 'GTImageHandler-4-681cb05d915fb.jpg', 1),
(194, 12572, 'GTImageHandler-5-681cb05d91935.jpg', 1),
(195, 12572, 'GTImageHandler-6-681cb05d91dad.jpg', 1),
(196, 12573, 'GTImageHandler-1-681cb6f06be54.jpg', 1),
(197, 12573, 'GTImageHandler-2-681cb6f06ce09.jpg', 1),
(198, 12573, 'GTImageHandler-3-681cb6f06cf71.jpg', 1),
(199, 12573, 'GTImageHandler-681cb6f06d0b4.jpg', 1),
(200, 12574, 'GTImageHandler-1-681cb95ff345b.jpg', 1),
(201, 12574, 'GTImageHandler-2-681cb95ff3c3d.jpg', 1),
(202, 12574, 'GTImageHandler-3-681cb95ff4078.jpg', 1),
(203, 12574, 'GTImageHandler-681cb96000301.jpg', 1),
(204, 12575, 'GTImageHandler-4-681cbc7755c3d.jpg', 1),
(205, 12575, 'GTImageHandler-5-681cbc7756443.jpg', 1),
(206, 12576, 'GTImageHandler-6-681cbe151eee8.jpg', 1),
(207, 12576, 'GTImageHandler-7-681cbe151f4da.jpg', 1),
(208, 12576, 'GTImageHandler-8-681cbe151ffe1.jpg', 1),
(209, 12576, 'GTImageHandler-9-681cbe1520375.jpg', 1),
(210, 12576, 'GTImageHandler-10-681cbe1520878.jpg', 1),
(211, 12577, 'GTImageHandler-1-681cc0ccdc4fe.jpg', 1),
(212, 12577, 'GTImageHandler-2-681cc0ccdcc44.jpg', 1),
(213, 12577, 'GTImageHandler-3-681cc0ccdcf5f.jpg', 1),
(214, 12577, 'GTImageHandler-4-681cc0ccdd239.jpg', 1),
(215, 12577, 'GTImageHandler-681cc0ccdd500.jpg', 1),
(216, 12578, 'detail-681cc52acb5e2.jpg', 1),
(217, 12578, 'gallery-1-681cc52acbbe9.jpg', 1),
(218, 12578, 'gallery-2-681cc52acbf8f.jpg', 1),
(219, 12578, 'gallery-3-681cc52acc3d9.jpg', 1),
(220, 12578, 'gallery-4-681cc52acc7bb.jpg', 1),
(221, 12578, 'gallery-5-681cc52accb49.jpg', 1),
(222, 12578, 'gallery-6-681cc52accfb7.jpg', 1),
(223, 12578, 'gallery-681cc52acd2ae.jpg', 1),
(224, 12579, 'gallery-1-681cc67571613.jpg', 1),
(225, 12579, 'gallery-2-681cc67571d42.jpg', 1),
(226, 12579, 'gallery-3-681cc67572115.jpg', 1),
(227, 12579, 'gallery-4-681cc6757246e.jpg', 1),
(228, 12579, 'gallery-5-681cc675727be.jpg', 1),
(229, 12579, 'gallery-6-681cc67572bd1.jpg', 1),
(230, 12579, 'gallery-681cc67572ee4.jpg', 1),
(231, 12580, 'detail-681ce58f8baf7.jpg', 1),
(232, 12580, 'gallery-1-681ce58f8bf84.jpg', 1),
(233, 12580, 'gallery-2-681ce58f8c1d8.jpg', 1),
(234, 12580, 'gallery-3-681ce58f8c3a8.jpg', 1),
(235, 12580, 'gallery-4-681ce58f8c647.jpg', 1),
(236, 12580, 'gallery-5-681ce58f8c9e2.jpg', 1),
(237, 12580, 'gallery-6-681ce58f8cc0c.jpg', 1),
(238, 12580, 'gallery-7-681ce58f8cdb9.jpg', 1),
(239, 12580, 'gallery-8-681ce58f8cf65.jpg', 1),
(240, 12580, 'gallery-9-681ce58f8d119.jpg', 1),
(241, 12580, 'gallery-10-681ce58f8d2b1.jpg', 1),
(242, 12580, 'gallery-11-681ce58f8d439.jpg', 1),
(243, 12580, 'gallery-12-681ce58f8d630.jpg', 1),
(244, 12581, 'gallery-1-681cea3d86fcc.jpg', 1),
(245, 12581, 'gallery-2-681cea3d8786b.jpg', 1),
(246, 12581, 'gallery-3-681cea3d87da7.jpg', 1),
(247, 12581, 'gallery-4-681cea3d882a1.jpg', 1),
(248, 12581, 'gallery-5-681cea3d88892.jpg', 1),
(249, 12581, 'gallery-6-681cea3d88df7.jpg', 1),
(250, 12581, 'gallery-7-681cea3d89618.jpg', 1),
(251, 12581, 'gallery-8-681cea3d89b1e.jpg', 1),
(252, 12581, 'gallery-9-681cea3d8a1f6.jpg', 1),
(253, 12581, 'gallery-10-681cea3d8a709.jpg', 1),
(254, 12581, 'gallery-11-681cea3d8ad67.jpg', 1),
(255, 12581, 'gallery-681cea3d8b17c.jpg', 1),
(256, 12582, 'detail-681cecd40d1dd.jpg', 1),
(257, 12582, 'gallery-1-681cecd40dd23.jpg', 1),
(258, 12582, 'gallery-2-681cecd40e1c2.jpg', 1),
(259, 12582, 'gallery-3-681cecd40e5d2.jpg', 1),
(260, 12582, 'gallery-4-681cecd40e9d6.jpg', 1),
(261, 12582, 'gallery-5-681cecd40f079.jpg', 1),
(262, 12582, 'gallery-6-681cecd40f540.jpg', 1),
(263, 12582, 'gallery-7-681cecd40fb15.jpg', 1),
(264, 12582, 'gallery-8-681cecd4102a7.jpg', 1),
(265, 12582, 'gallery-9-681cecd410948.jpg', 1),
(266, 12582, 'gallery-10-681cecd410ea7.jpg', 1),
(267, 12582, 'gallery-681cecd41146e.jpg', 1),
(268, 12583, 'detail-681cf4763cd50.jpg', 1),
(269, 12583, 'gallery-1-681cf4763d381.jpg', 1),
(270, 12583, 'gallery-2-681cf4763d701.jpg', 1),
(271, 12583, 'gallery-681cf4763d9ec.jpg', 1),
(272, 12584, 'terr2-681cf65acd78e.webp', 1),
(273, 12584, 'terrain1-681cf65ad70dc.jpg', 1),
(274, 12584, 'terrain2-681cf65ad7208.jpg', 1),
(275, 12584, 'terrain3-681cf65ad7311.jpg', 1),
(276, 12585, 'detail-6820a7b348271.jpg', 1),
(277, 12585, 'gallery-1-6820a7b349879.jpg', 1),
(278, 12585, 'gallery-2-6820a7b349b92.jpg', 1),
(279, 12585, 'gallery-3-6820a7b349eb1.jpg', 1),
(280, 12585, 'gallery-4-6820a7b34a1ad.jpg', 1),
(281, 12585, 'gallery-5-6820a7b34a482.jpg', 1),
(282, 12585, 'gallery-6-6820a7b34a7b7.jpg', 1),
(283, 12585, 'gallery-6820a7b34aaa4.jpg', 1),
(284, 12586, 'gallery-1-6820aa9edbc41.jpg', 1),
(285, 12586, 'gallery-2-6820aa9edbfaf.jpg', 1),
(286, 12586, 'gallery-3-6820aa9edc1b7.jpg', 1),
(287, 12586, 'gallery-4-6820aa9edc37b.jpg', 1),
(288, 12586, 'gallery-6820aa9edc4fc.jpg', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `propriete`
--

INSERT INTO `propriete` (`id`, `type_id`, `nom_propriete`) VALUES
(86, 1, 'Etage'),
(87, 1, 'Année de construction'),
(88, 1, 'Année de rénovation'),
(89, 1, 'Catégorie'),
(90, 1, 'Conditionnement'),
(91, 6, 'Catégorie'),
(92, 6, 'Année de construction'),
(93, 6, 'Libre'),
(94, 5, 'Etage'),
(95, 5, 'Chauffage'),
(96, 5, 'Catégorie'),
(97, 5, 'Année de construction'),
(98, 2, 'Superficie (m²)'),
(99, 4, 'Superficie (m²)'),
(100, 4, 'Places de parking'),
(101, 4, 'Nombre de WC'),
(102, 5, 'Ascenseur'),
(103, 5, 'Libre'),
(104, 6, 'Jardin'),
(105, 6, 'Piscine'),
(107, 1, 'Superficie (m²)'),
(108, 1, 'Ascenseur');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bien_id` int DEFAULT NULL,
  `nom_acheteur` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tel_acheteur` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `cin_acheteur` int NOT NULL,
  `type_transaction` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `commission` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `date_transaction` date NOT NULL,
  `mode_paiement` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `payer` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `statut_transaction` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prix_vente` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `adresse_acheteur` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `objet_contrat` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description_bien` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `debut_location` date DEFAULT NULL,
  `fin_location` date DEFAULT NULL,
  `obligation_vendeur` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `obligation_acheteur` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `conditions_resiliation` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `confidentialite` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `poste_vendeur` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tel_vendeur` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `mail_vendeur` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `signature_vendeur` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `signature_acheteur` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `nom_vendeur` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `declaration1` tinyint(1) DEFAULT NULL,
  `declaration2` tinyint(1) DEFAULT NULL,
  `agent_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_723705D1BD95B80F` (`bien_id`),
  KEY `IDX_723705D13414710B` (`agent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `transaction`
--

INSERT INTO `transaction` (`id`, `bien_id`, `nom_acheteur`, `tel_acheteur`, `cin_acheteur`, `type_transaction`, `commission`, `date_transaction`, `mode_paiement`, `payer`, `statut_transaction`, `prix_vente`, `adresse_acheteur`, `objet_contrat`, `description_bien`, `debut_location`, `fin_location`, `obligation_vendeur`, `obligation_acheteur`, `conditions_resiliation`, `confidentialite`, `poste_vendeur`, `tel_vendeur`, `mail_vendeur`, `signature_vendeur`, `signature_acheteur`, `nom_vendeur`, `declaration1`, `declaration2`, `agent_id`) VALUES
(20, 12570, 'mohsen yahya', '93313278', 8569234, 'Location', NULL, '2025-05-14', 'rthrht', 'paye', 'termine', 'rthrh', 'hammamet', 'brter', 'rhtrht', NULL, NULL, 'rthr', 'hrthtrt', 'htrh', 'rthrht', 'responsable de vente', '523659', 'ahmed@gmail.com', NULL, NULL, 'ksontini ahmed', 1, 1, NULL),
(21, 12564, 'mohsen yahya', '93313278', 8569234, 'Vente', NULL, '2025-05-14', 'efwf', 'paye', 'en_cours', 'wefw', 'hammamet', 'werfgww', 'fwefwefe', NULL, NULL, 'wefw', 'fwef', 'wefwef', 'wefw', 'responsable de vente', '523659', 'ahmed@gmail.com', NULL, NULL, 'ksontini ahmed', 1, 1, NULL);

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
  `poste` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `experience` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cin` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `reset_password_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `tel`, `verifier`, `photo_profil`, `confirmation_token`, `status`, `instagram`, `linkedin`, `facebook`, `cree_en`, `localisation`, `adresse`, `poste`, `description`, `experience`, `cin`, `reset_password_token`) VALUES
(33, 'ahmedksontini122@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$45i890RKa4zJwBFC3MSKWeSzIT564vQHaGKij1evKHeP2wMoplbyy', 'ksontini', 'ahmed', 93313278, 1, '2a81356ca9e1b69cc42ff0608efdb69d.jpg', NULL, 1, 'https://www.instagram.com/ahmed_ksontini_/', 'https://www.linkedin.com/in/ahmed-ksontini-3589071a0/', 'https://www.facebook.com/ahmed.ksontini.37?locale=fr_FR', '2025-02-01 10:50:44', 'Hammamet', 'Rue taher ben fraj', 'Responsable d’agence', 'Passionné par l\'immobilier et fort d\'une solide expérience dans le secteur, j\'occupe actuellement le poste de Responsable d\'Agence Immobilière. Mon rôle consiste à superviser et développer les activités de l’agence, en garantissant un service client de qu', '15 ans', '08985353', ''),
(35, 'nidhalSafta@gmail.com', '{\"1\": \"ROLE_USER\"}', '$2y$13$77Zer4QkE9qyjk1nWHNpz.ygIUuV.JCGXG1vjTb0cB3PTJgw5rLTO', 'safta', 'Nidhal', 22687017, 1, 'WhatsApp-Image-2025-02-03-at-11-50-59-AM-67a09fcf2a3c0.jpg', NULL, 0, NULL, NULL, NULL, '2025-02-03 10:51:59', 'kharouba', 'hammamet', NULL, NULL, NULL, '06423587', NULL),
(36, 'bilel@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$4waxRdAxtGlm6PYC.6z3TOTiECepJBQ6o03tFH6kz7xaT0Ilz3z7m', 'magherby', 'bilel', 12345678, 1, '2cb678c73b64ad326514cf63572e11ed.jpg', NULL, 0, NULL, NULL, NULL, '2025-02-03 17:59:55', 'rue ben fraj', 'hammamet', 'Administrateur de biens', NULL, NULL, '02785913', NULL),
(48, 'wassim@gmail.com', '{\"1\": \"ROLE_USER\"}', '$2y$13$1jes15DWkMhyO8UEd7egi.iEWYvg4EDOJUOXbKLkJh1qTj0VGlwOm', 'ben fraj', 'wassim', 93313278, 1, 'wassim-67f0135ed8c3a.jpg', NULL, 0, NULL, NULL, NULL, '2025-04-04 17:14:07', 'rue ben fraj', 'hammamet', NULL, NULL, NULL, NULL, NULL),
(50, 'walid@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$v1e0B/MjexUVQ6DVRyNAb.H49rDhAVLWDibQsAOL/o2Efi3bi9kdq', 'Ben Abda', 'Walid', 90345678, 1, 'images-681cc83bf0328.png', NULL, 1, NULL, NULL, NULL, '2025-05-08 15:05:32', 'rue ben fraj', 'nabeul', 'Conseiller en immobilier', NULL, NULL, NULL, NULL);

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
-- Contraintes pour la table `besoin_user`
--
ALTER TABLE `besoin_user`
  ADD CONSTRAINT `FK_AE502A75A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

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
  ADD CONSTRAINT `FK_9A85748BD95B80F` FOREIGN KEY (`bien_id`) REFERENCES `bien` (`id`) ON DELETE CASCADE;

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
