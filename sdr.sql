-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 21 juil. 2024 à 21:50
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sdr`
--

-- --------------------------------------------------------

--
-- Structure de la table `actionnaire`
--

CREATE TABLE `actionnaire` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `alt` varchar(400) DEFAULT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `actionnaire`
--

INSERT INTO `actionnaire` (`id`, `nom`, `image`, `alt`, `slug`) VALUES
(1, 'Ministère du tourisme', '6555aa478929024d4b189c1e754af6db.png', 'Ministère du tourisme', 'ministere-du-tourisme'),
(2, 'Ministère de l\'interieur', 'e95a48c8b0a873a793dffde37184d136.png', 'Ministère de l\'interieur', 'ministere-de-linterieur'),
(3, 'Tourisme engineering and investement', '4699ad91ffc8bb4f0d2ef4aa4d53638d.jpg', 'Tourisme engineering and investement SMIT MOROCCO', 'tourisme-engineering-and-investement'),
(4, 'Royaume du maroc', 'cc9c6651120efb3ab1bbd895a9410894.png', 'Royaume du maroc  région souss massa', 'royaume-du-maroc');

-- --------------------------------------------------------

--
-- Structure de la table `amnities`
--

CREATE TABLE `amnities` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `amnities`
--

INSERT INTO `amnities` (`id`, `nom`, `slug`) VALUES
(1, 'Parking', 'parking'),
(2, 'wifi', 'wifi'),
(3, 'Piscine', 'piscine'),
(4, 'Air conditioning', 'ep1'),
(5, 'Dog allowed', 'ep2'),
(6, 'Wheelchair accessible', 'ep3'),
(7, 'equipement 4', 'ep4'),
(8, 'equipement 5', 'ep5'),
(9, 'equipement 6', 'ep6');

-- --------------------------------------------------------

--
-- Structure de la table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `slug` varchar(255) NOT NULL,
  `video` varchar(500) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `blog`
--

INSERT INTO `blog` (`id`, `user_id`, `title`, `description`, `created_at`, `slug`, `video`, `image`) VALUES
(1, 1, 'Excited news about arrival fashion.', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi arch itecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam,\r\n\r\nnisi ut aliquid ex ea comm odi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse Tender loin fatback shank ball tip pastrami pork chop strip steak. Swine kielbasa pig doner ribeye andouille pastrami pork kevin. Pork loin chuck ham pork capicola. Pancetta t-bone cow drumstick tail jowl salami tri-tip shank pig turkey turducken ground round pork swine. Prosciutto tri-tip bresaola t-bone boudin\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae nisi sed felis iaculis tempus ut a urna. Duis ma ximus nisi non lacus hendrerit elementum. Duis sit amet sem odio. Maecenas massa purus, iaculis id sem vitae, iaculis porttitor lectus.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi arch itecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia.', '2024-07-07 15:51:48', 'excited-news-about-arrival-fashion', NULL, NULL),
(2, 1, 'Excited news about arrival fashion.', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi arch itecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam,\r\n\r\nnisi ut aliquid ex ea comm odi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse Tender loin fatback shank ball tip pastrami pork chop strip steak. Swine kielbasa pig doner ribeye andouille pastrami pork kevin. Pork loin chuck ham pork capicola. Pancetta t-bone cow drumstick tail jowl salami tri-tip shank pig turkey turducken ground round pork swine. Prosciutto tri-tip bresaola t-bone boudin\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae nisi sed felis iaculis tempus ut a urna. Duis ma ximus nisi non lacus hendrerit elementum. Duis sit amet sem odio. Maecenas massa purus, iaculis id sem vitae, iaculis porttitor lectus.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi arch itecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia.', '2024-07-07 15:51:48', 'excited-news-about-arrival-fashion1', NULL, NULL),
(3, 1, 'Excited news about arrival fashion.', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi arch itecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam,\r\n\r\nnisi ut aliquid ex ea comm odi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse Tender loin fatback shank ball tip pastrami pork chop strip steak. Swine kielbasa pig doner ribeye andouille pastrami pork kevin. Pork loin chuck ham pork capicola. Pancetta t-bone cow drumstick tail jowl salami tri-tip shank pig turkey turducken ground round pork swine. Prosciutto tri-tip bresaola t-bone boudin\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae nisi sed felis iaculis tempus ut a urna. Duis ma ximus nisi non lacus hendrerit elementum. Duis sit amet sem odio. Maecenas massa purus, iaculis id sem vitae, iaculis porttitor lectus.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi arch itecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia.', '2024-07-07 15:51:48', 'excited-news-about-arrival-fashion3', NULL, NULL),
(4, 1, 'Blog numéro 4', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi arch itecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam,\r\n\r\nnisi ut aliquid ex ea comm odi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse Tender loin fatback shank ball tip pastrami pork chop strip steak. Swine kielbasa pig doner ribeye andouille pastrami pork kevin. Pork loin chuck ham pork capicola. Pancetta t-bone cow drumstick tail jowl salami tri-tip shank pig turkey turducken ground round pork swine. Prosciutto tri-tip bresaola t-bone boudin\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae nisi sed felis iaculis tempus ut a urna. Duis ma ximus nisi non lacus hendrerit elementum. Duis sit amet sem odio. Maecenas massa purus, iaculis id sem vitae, iaculis porttitor lectus.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi arch itecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia.', '2024-07-07 16:38:25', 'blog-numero-4', NULL, 'b2119e4894cf29530bbd97859db4e6ec.jpg'),
(5, 1, 'Blog numéro 5', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi arch itecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam,\r\n\r\nnisi ut aliquid ex ea comm odi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse Tender loin fatback shank ball tip pastrami pork chop strip steak. Swine kielbasa pig doner ribeye andouille pastrami pork kevin. Pork loin chuck ham pork capicola. Pancetta t-bone cow drumstick tail jowl salami tri-tip shank pig turkey turducken ground round pork swine. Prosciutto tri-tip bresaola t-bone boudin\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae nisi sed felis iaculis tempus ut a urna. Duis ma ximus nisi non lacus hendrerit elementum. Duis sit amet sem odio. Maecenas massa purus, iaculis id sem vitae, iaculis porttitor lectus.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi arch itecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia.', '2024-07-07 17:04:01', 'blog-numero-5', 'https://www.youtube.com/watch?v=jvmIpd_2Ldc&t=235s', '62f22cf08f07e6d2badd16c4692a1e41.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `slug`, `image`) VALUES
(1, 'Hotêls', 'hotels', '555c08a4ed1dc5b81188acee7771d6ce.jpg'),
(2, 'Maisons d\'hôte', 'maisons-dhote', 'c6e8bd5ee90f53b734e5f9b372e4333f.jpg'),
(3, 'Restaurants', 'restaurants', 'd776fb21be03c4590db9f5c2230d63c9.jpg'),
(4, 'Attractions', 'attractions', 'c8a222ccffb1d9d228ee58ed332bda0b.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `commentsblog`
--

CREATE TABLE `commentsblog` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `commentaire` longtext NOT NULL,
  `commented_at` datetime NOT NULL,
  `display` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commentsblog`
--

INSERT INTO `commentsblog` (`id`, `blog_id`, `nom`, `email`, `website`, `commentaire`, `commented_at`, `display`) VALUES
(1, 5, 'amine tad', 'amine@gmail.com', 'https://amine.com', 'ceci est un commentaire', '2024-07-08 17:03:23', 0);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240720095701', '2024-07-20 11:57:11', 49);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `chemin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `listing_id`, `chemin`) VALUES
(1, 1, '1a42d73a0562cf6a3fb0e9a3594dab3b.jpg'),
(2, 1, 'b08d75ec20d8614db8fafabcbf3458d7.jpg'),
(3, 1, 'eb36684f8185626ce1b7a84e1bfd77dd.jpg'),
(5, 2, 'e50837a665fe9f17b26d93b46b6f6e1a.jpg'),
(6, 2, '2b9fcbe1acc73c30e8a39de0eab813e3.jpg'),
(7, 2, '9e2867d564a3ccec740a461fe9638bc3.jpg'),
(8, 2, '4eb85a82c80d07fb317e9c41eac0da41.jpg'),
(9, 2, '36d82940c5a3164e0428f442ee422df7.jpg'),
(10, 2, '8f1af08a24c583c403ab625e06d1c37e.jpg'),
(15, 3, '13dde6f7ba0273ba534edd1e0cfd8308.jpg'),
(16, 3, '8744a3dc47d98b09c329911be2e27c46.jpg'),
(17, 3, 'bd5dae9bd6628caec0bd8b186919dc4b.jpg'),
(18, 3, '71c778ec7c79154cd041fbcec4ecdcae.jpg'),
(19, 4, '910d226517c5291d0ed2d7bd5193029a.jpg'),
(20, 4, 'daeea33915017c53bdff7998a4fefc48.jpg'),
(21, 4, '9e4367a591a4bea43354b6f63639573c.jpg'),
(22, 4, 'f6f8135300afed072b1e5bcf750c4bc1.jpg'),
(25, 5, '130a451a9d567ca8ae993f61a76d8df4.jpg'),
(26, 5, 'bea8e228e05f9c9c3a67ba4b4ab916db.jpg'),
(27, 5, 'ed34bde11d86908ab5cbc00826303483.jpg'),
(28, 5, 'd4d4bccb685cf07d9bbbe607035ae256.jpg'),
(29, 5, '138b81e7ee6d12f7452e128c538be6ff.jpg'),
(30, 6, 'd832ef3f75bf7b516cf94560bac66103.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `listing`
--

CREATE TABLE `listing` (
  `id` int(11) NOT NULL,
  `ville_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `pension_id` int(11) DEFAULT NULL,
  `name` varchar(400) NOT NULL,
  `adresse` longtext DEFAULT NULL,
  `nb_couverts` smallint(6) NOT NULL,
  `nb_chambre` smallint(6) NOT NULL,
  `nb_lit` smallint(6) NOT NULL,
  `siteweb` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `prix_start` double DEFAULT NULL,
  `prix_end` double DEFAULT NULL,
  `afficher` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `note` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `listing`
--

INSERT INTO `listing` (`id`, `ville_id`, `categorie_id`, `pension_id`, `name`, `adresse`, `nb_couverts`, `nb_chambre`, `nb_lit`, `siteweb`, `email`, `telephone`, `facebook`, `instagram`, `tiktok`, `youtube`, `twitter`, `slug`, `description`, `latitude`, `longitude`, `prix_start`, `prix_end`, `afficher`, `created_at`, `note`) VALUES
(1, 10, 1, NULL, 'Château de Mgouna', NULL, 0, 0, 0, NULL, NULL, '0514323232', NULL, NULL, NULL, NULL, NULL, 'chateau-de-mgouna', 'Zone touristique Route vers Goulmima Errachidia', '35.7774341', '-5.8022008', 100, 200, 1, '2024-07-18 17:48:40', 2),
(2, 1, 3, NULL, 'Young luxury camp', 'Adresse du listing', 0, 0, 0, 'young-luxury-camp.com', 'young.luxury.camp@gmail.com', '056545434', NULL, NULL, NULL, NULL, NULL, 'young-luxury-camp', '\"VIP Merzouga\" est un hôtel d\'exception, conçu pour offrir une expérience de séjour luxueuse et mémorable. Situé au cœur de [lieu], notre établissement allie élégance, confort et services haut de gamme pour répondre aux attentes des voyageurs les plus exigeants. Avec des chambres somptueuses, des installations modernes et un service personnalisé, Luxury House s\'efforce de créer une atmosphère accueillante où chaque détail est soigneusement pensé. Que vous voyagiez pour affaires ou pour le plaisir, notre équipe dévouée est prête à vous offrir une expérience inoubliable et à répondre à tous vos besoins. Découvrez le raffinement et le luxe à \"VIP Merzouga\", où chaque instant devient une occasion spéciale.', '35.7774341', '-5.8012309', 300, 700, 1, '2024-07-18 17:48:40', 4),
(3, 5, 3, 2, 'VIP Merzouga', ' Mon adresse postale est 7 rue des Fleurs 37000 Tours  Mon adresse postale est 7 rue des Fleurs 37000 Tours', 0, 0, 0, 'VIP-Merzouga.com', 'VIP.Merzouga@gmail.com', NULL, 'htps://facebook.com/VIP Merzouga', 'htps://Instagram.com/VIP Merzouga', 'htps://Tiktok.com/VIP Merzouga', 'htps://Youtube.com/VIP Merzouga', 'htps://Twitter.com/VIP Merzouga', 'vip-merzouga', 'description du listing ', '32.334193', '-6.353335', NULL, NULL, 1, '2024-07-18 17:48:40', 4),
(4, 8, 3, 2, 'Yakout Merzouga Luxury Camp', 'Adresse du listing', 0, 0, 0, 'VIP-Yakout.com', 'Yakout@gmail.com', '0514323232', NULL, NULL, NULL, NULL, NULL, 'yakout-merzouga-luxury-camp', '\"Yakout Merzouga Luxury Camp\" est un hôtel d\'exception, conçu pour offrir une expérience de séjour luxueuse et mémorable. Situé au cœur de [lieu], notre établissement allie élégance, confort et services haut de gamme pour répondre aux attentes des voyageurs les plus exigeants. Avec des chambres somptueuses, des installations modernes et un service personnalisé, Yakout Merzouga Luxury Camp s\'efforce de créer une atmosphère accueillante où chaque détail est soigneusement pensé. Que vous voyagiez pour affaires ou pour le plaisir, notre équipe dévouée est prête à vous offrir une expérience inoubliable et à répondre à tous vos besoins. Découvrez le raffinement et le luxe à \"Yakout Merzouga Luxury Camp\", où chaque instant devient une occasion spéciale.', '30.920193', '-6.910923', 300, 700, 1, '2024-07-18 17:48:40', 3),
(5, 9, 1, 5, 'VIP Taghazout', 'Adresse du listing', 0, 0, 0, 'http://VIPTaghazout.com', 'VIPTaghazout@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'vip-taghazout', 'description du listing', NULL, NULL, 100, 800, 1, '2024-07-18 17:48:40', 3),
(6, 7, 3, 2, 'VIP errachidia', 'Mon adresse postale est 7 rue des Fleurs 37000 Tours', 0, 0, 0, 'VIP-errachidiya.com', 'VIP.errachidiya@gmail.com', NULL, 'htps://facebook.com/VIP errachidiya', 'htps://Instagram.com/VIP errachidiya', 'htps://Tiktok.com/VIP errachidiya', 'htps://Youtube.com/VIP Merzouga', 'htps://Twitter.com/VIP errachidiya', 'vip-errachidiya', 'description du listing  errachidiya', '32.334123', '-6.353325', NULL, NULL, 1, '2024-07-18 17:48:40', 5);

-- --------------------------------------------------------

--
-- Structure de la table `listingamnities`
--

CREATE TABLE `listingamnities` (
  `id` int(11) NOT NULL,
  `listing_id` int(11) DEFAULT NULL,
  `amnities_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `listingamnities`
--

INSERT INTO `listingamnities` (`id`, `listing_id`, `amnities_id`) VALUES
(16, 5, 1),
(17, 5, 9),
(37, 2, 1),
(38, 2, 2),
(39, 2, 3),
(46, 1, 1),
(47, 1, 2),
(48, 1, 3),
(49, 1, 4),
(50, 1, 5),
(51, 1, 6),
(52, 1, 7),
(53, 1, 8),
(54, 1, 9);

-- --------------------------------------------------------

--
-- Structure de la table `localite`
--

CREATE TABLE `localite` (
  `id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `localite`
--

INSERT INTO `localite` (`id`, `province_id`, `nom`, `latitude`, `longitude`, `slug`) VALUES
(1, 1, 'Tanger', '35.7774341', '-5.8032309', 'tanger'),
(2, 1, 'Tétouan', '35.570175', '-5.3742776', 'tetouan'),
(3, 2, 'Fès', '34.0346534', '-5.0161926', 'fes'),
(4, 2, 'Meknès', '33.8833.8984131', '-5.5321582', 'meknes'),
(5, 4, 'Béni Mellal', '32.334193', '-6.353335', 'beni-mellal'),
(6, 4, 'Khouribga', '32.8856482', '-6.908798', 'khouribga'),
(7, 7, 'Errachidia', '31.929089', '-4.4340807', 'errachidia'),
(8, 7, 'Ouarzazate', '30.920193', '-6.910923', 'ouarzazate'),
(9, 8, 'Taroudant', '30.470651', '-8.877922', 'taroudant'),
(10, 8, 'Tiznit', '29.698624', '-9.7312815', 'tiznit'),
(11, 9, 'Guelmim', '28.9863852', '-10.0574351', 'guelmim'),
(12, 9, 'Tan-Tan', '28.437553', '-11.098664', 'tan-tan'),
(13, 6, 'Marrakech', '31.6258257', '-7.9891608', 'marrakech'),
(14, 6, 'Safi', '32.2650776', '-9.230554', 'safi');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `partenaire`
--

CREATE TABLE `partenaire` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `alt` varchar(400) DEFAULT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `partenaire`
--

INSERT INTO `partenaire` (`id`, `nom`, `image`, `alt`, `slug`) VALUES
(1, 'Chtouka ait baha', '7d8db8396b029835d186d0300a2e7a5d.jpg', 'Chtouka ait baha conseil province du tourisme', 'chtouka-ait-baha'),
(2, 'OFFPPT', '857cfe0bd34af5dc7c38c1b3fadf8f5a.png', 'OFFPPT', 'offppt'),
(3, 'Anapec', '67769b93f8d4b88461fb0e9fbf1392b4.png', 'Anapec', 'anapec'),
(4, 'Conseil régional d\'investissement Souss Massa', '307d63161147da491d34529c7770779e.png', 'Conseil régional d\'investissement Souss Massa', 'conseil-regional-dinvestissement-souss-massa'),
(5, 'Conseil régional du Tourisme', '1048c6995cfe33bb1bcd238d57e214ae.jpg', 'Conseil régional du Tourisme', 'conseil-regional-du-tourisme'),
(6, 'Initiative Souss massa', '4446fa061367588d0a63ce2698907403.jpg', 'Initiative Souss massa', 'initiative-souss-massa'),
(7, 'CGEM', '91e28333c80e2ead3d6e27cb2bae9ec5.png', 'CGEM', 'cgem');

-- --------------------------------------------------------

--
-- Structure de la table `province`
--

CREATE TABLE `province` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `nb_villes` smallint(6) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `province`
--

INSERT INTO `province` (`id`, `nom`, `nb_villes`, `slug`) VALUES
(1, 'Tanger-Tétouan-Al Hoceïma', 0, 'tanger-tetouan-al-hoceima'),
(2, 'Fès-Meknès', 0, 'fes-meknes'),
(3, 'Rabat-Salé-Kénitra', 0, 'rabat-sale-kenitra'),
(4, 'Béni Mellal-Khénifra', 0, 'beni-mellal-khenifra'),
(5, 'Casablanca-Settat', 0, 'casablanca-settat'),
(6, 'Marrakech-Safi', 0, 'marrakech-safi'),
(7, 'Drâa-Tafilalet', 0, 'draa-tafilalet'),
(8, 'Souss-Massa', 0, 'souss-massa'),
(9, 'Guelmim-Oued Noun', 0, 'guelmim-oued-noun'),
(10, 'Laâyoune-Sakia El Hamra', 0, 'laayoune-sakia-el-hamra'),
(11, 'Dakhla-Oued Ed-Dahab', 0, 'dakhla-oued-ed-dahab');

-- --------------------------------------------------------

--
-- Structure de la table `type_pension`
--

CREATE TABLE `type_pension` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_pension`
--

INSERT INTO `type_pension` (`id`, `nom`, `slug`, `description`) VALUES
(1, 'Logement seul (Room Only)', 'logement-seul-room-only', 'La chambre d\'hôtel est réservée sans repas inclus. Les clients sont responsables de se procurer leur propre nourriture.'),
(2, 'Petit-déjeuner inclus (Bed and Breakfast - B&B)', 'petit-dejeuner-inclus-bed-and-breakfast-b-b', 'Le tarif de la chambre comprend le petit-déjeuner servi à l\'hôtel.'),
(3, 'Demi-pension (Half Board)', 'demi-pension-half-board', 'En plus du logement, le tarif comprend le petit-déjeuner et un autre repas, généralement le dîner...'),
(4, 'Pension complète (Full Board)', 'pension-complete-full-board', 'Le tarif inclut le logement, le petit-déjeuner, le déjeuner et le dîner. Les clients n\'ont pas besoin de se soucier de trouver des repas à l\'extérieur.'),
(5, 'Tout compris (All-Inclusive)', 'tout-compris-all-inclusive', 'En plus du logement et des repas, cette formule peut inclure des boissons, des collations et parfois même des activités.'),
(6, 'Pension familiale (Family Plan)', 'pension-familiale-family-plan', 'Une offre spéciale pour les familles qui peuvent inclure des repas gratuits ou à tarif réduit pour les enfants.');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `nom` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`) VALUES
(1, 'admin@admin.com', '[\"ROLE_ADMIN\"]', '$2y$13$pFKnwtrzFK4UNj5hFvQQS.4XzjiwkcO/fnVGv4QIDtzMPYRu6a/4.', 'Adminisrateur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actionnaire`
--
ALTER TABLE `actionnaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `amnities`
--
ALTER TABLE `amnities`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C0155143A76ED395` (`user_id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentsblog`
--
ALTER TABLE `commentsblog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E21231AADAE07E97` (`blog_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E01FBE6AD4619D1A` (`listing_id`);

--
-- Index pour la table `listing`
--
ALTER TABLE `listing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CB0048D4A73F0036` (`ville_id`),
  ADD KEY `IDX_CB0048D4BCF5E72D` (`categorie_id`),
  ADD KEY `IDX_CB0048D46DB67326` (`pension_id`);

--
-- Index pour la table `listingamnities`
--
ALTER TABLE `listingamnities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2C75CB4DD4619D1A` (`listing_id`),
  ADD KEY `IDX_2C75CB4D345D7B5` (`amnities_id`);

--
-- Index pour la table `localite`
--
ALTER TABLE `localite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F5D7E4A9E946114A` (`province_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `partenaire`
--
ALTER TABLE `partenaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_pension`
--
ALTER TABLE `type_pension`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actionnaire`
--
ALTER TABLE `actionnaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `amnities`
--
ALTER TABLE `amnities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `commentsblog`
--
ALTER TABLE `commentsblog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `listing`
--
ALTER TABLE `listing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `listingamnities`
--
ALTER TABLE `listingamnities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `localite`
--
ALTER TABLE `localite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `partenaire`
--
ALTER TABLE `partenaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `province`
--
ALTER TABLE `province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `type_pension`
--
ALTER TABLE `type_pension`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `FK_C0155143A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `commentsblog`
--
ALTER TABLE `commentsblog`
  ADD CONSTRAINT `FK_E21231AADAE07E97` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`);

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_E01FBE6AD4619D1A` FOREIGN KEY (`listing_id`) REFERENCES `listing` (`id`);

--
-- Contraintes pour la table `listing`
--
ALTER TABLE `listing`
  ADD CONSTRAINT `FK_CB0048D46DB67326` FOREIGN KEY (`pension_id`) REFERENCES `type_pension` (`id`),
  ADD CONSTRAINT `FK_CB0048D4A73F0036` FOREIGN KEY (`ville_id`) REFERENCES `localite` (`id`),
  ADD CONSTRAINT `FK_CB0048D4BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `listingamnities`
--
ALTER TABLE `listingamnities`
  ADD CONSTRAINT `FK_2C75CB4D345D7B5` FOREIGN KEY (`amnities_id`) REFERENCES `amnities` (`id`),
  ADD CONSTRAINT `FK_2C75CB4DD4619D1A` FOREIGN KEY (`listing_id`) REFERENCES `listing` (`id`);

--
-- Contraintes pour la table `localite`
--
ALTER TABLE `localite`
  ADD CONSTRAINT `FK_F5D7E4A9E946114A` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
