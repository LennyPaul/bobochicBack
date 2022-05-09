-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage de la structure de la table test_technique. declinaisons
CREATE TABLE IF NOT EXISTS `declinaisons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produit` int(11) NOT NULL DEFAULT '0',
  `price` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `stock` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL,
  `reference` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_produit` (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Listage des données de la table test_technique.declinaisons : ~0 rows (environ)
/*!40000 ALTER TABLE `declinaisons` DISABLE KEYS */;
INSERT INTO `declinaisons` (`id`, `id_produit`, `price`, `stock`, `title`, `reference`) VALUES
	(1, 1, 139.990000, 20, 'rouge', 'A01R');
INSERT INTO `declinaisons` (`id`, `id_produit`, `price`, `stock`, `title`, `reference`) VALUES
	(2, 1, 189.990000, 40, 'bleu', 'A01B');
/*!40000 ALTER TABLE `declinaisons` ENABLE KEYS */;

-- Listage de la structure de la table test_technique. produits
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(50) NOT NULL DEFAULT '0',
  `price` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `stock` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL DEFAULT '0',
  `nb_declinaison` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Listage des données de la table test_technique.produits : ~1 rows (environ)
/*!40000 ALTER TABLE `produits` DISABLE KEYS */;
INSERT INTO `produits` (`id`, `reference`, `price`, `stock`, `title`, `nb_declinaison`) VALUES
	(1, 'A01', 150.990000, 50, 'produit test A', 2);
INSERT INTO `produits` (`id`, `reference`, `price`, `stock`, `title`, `nb_declinaison`) VALUES
	(2, 'B01', 120.990000, 10, 'produit test B', 0);
/*!40000 ALTER TABLE `produits` ENABLE KEYS */;


--
ALTER TABLE `declinaisons`
  ADD CONSTRAINT `declinaison` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id`);


/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
