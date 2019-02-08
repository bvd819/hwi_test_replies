# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.18-0ubuntu0.16.04.1)
# Database: hwi_dev
# Generation Time: 2019-02-08 01:39:18 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table account
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account`;

CREATE TABLE `account` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;

INSERT INTO `account` (`id`, `name`, `image`)
VALUES
	(1,'Bryan','/assets/images/bryan.jpg'),
	(2,'Terra','/assets/images/terra.jpg');

/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table article
# ------------------------------------------------------------

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` mediumtext,
  `content` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;

INSERT INTO `article` (`id`, `title`, `content`)
VALUES
	(1,'Artikel 1','<p>\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque et augue a elit feugiat euismod ut eu nulla. Aenean pretium tortor in enim tincidunt, sed lacinia neque egestas. Ut mattis sodales lorem, non porta erat semper et. Phasellus a mi vehicula, tincidunt ex eu, ullamcorper metus. Sed ultrices in velit quis vulputate. Ut felis est, dignissim at orci sed, ultricies accumsan libero. Nunc tempor blandit justo, a vestibulum turpis porta eget. In non eros tincidunt, vulputate urna id, dapibus lectus. Nulla non purus pharetra, placerat elit et, sollicitudin odio. Phasellus eget sem at augue egestas consectetur ac at sapien. Suspendisse vulputate volutpat erat, ac congue dolor consequat quis. Fusce id placerat nibh, id pharetra ligula. In sapien neque, auctor non justo a, venenatis tincidunt metus. Donec sed ligula id elit iaculis vulputate bibendum quis est. Duis feugiat sem ut sollicitudin ultricies.\n</p>\n<p>\nDonec bibendum nulla eget libero porta bibendum. Phasellus ac interdum mauris. Pellentesque eros enim, luctus vel nibh quis, pellentesque euismod felis. Nulla a blandit urna, sit amet pulvinar libero. Ut in odio et velit mattis tincidunt. Nullam fringilla feugiat turpis, eget pellentesque arcu pulvinar vitae. Quisque faucibus elit vitae pharetra pellentesque. Maecenas ac orci placerat, accumsan lectus id, aliquet eros.\n</p>\n<p>\nMorbi placerat diam et neque tristique, at venenatis nibh facilisis. Nulla sit amet augue massa. Morbi feugiat erat ut felis feugiat, sed iaculis metus malesuada. Donec tincidunt maximus urna ultrices molestie. Etiam pellentesque elementum dui, ut iaculis eros fringilla in. Pellentesque egestas, eros ac bibendum volutpat, lectus urna tempus est, id ullamcorper leo tellus vitae nulla. Sed non dictum mi. Sed arcu eros, varius in malesuada a, ornare vel dui. Donec blandit ligula id purus blandit, quis laoreet ante tempor. Mauris sagittis, purus eget porttitor imperdiet, turpis lectus luctus mi, eget varius diam orci ac justo. Mauris ac ultrices odio, in eleifend ante. Vivamus odio justo, convallis a pellentesque a, vehicula eget diam. Maecenas sed pulvinar arcu. Morbi egestas ornare libero quis accumsan. Etiam eu lectus nec nunc pharetra elementum a et ante.\n</p>\n<p>\nQuisque nec convallis turpis, dictum dictum sapien. Vestibulum vulputate augue risus, vitae ultrices felis rutrum id. Praesent porta enim nibh. Nullam finibus, nisl sed vulputate ornare, lorem augue imperdiet erat, nec mollis nulla sem id enim. Fusce in diam est. Aliquam eu laoreet turpis, sed luctus erat. Sed nec imperdiet ex, nec iaculis augue. Nulla commodo nibh at aliquet rutrum. Nulla porta est nec sem cursus, congue interdum sem tristique. Pellentesque iaculis fermentum vehicula.\n</p>\n<p>\nOrci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam vitae nibh nec odio feugiat malesuada in eu nunc. Donec congue tellus id lacus tincidunt efficitur sed id nibh. Proin commodo, orci non iaculis ultricies, sapien leo faucibus tellus, ut sagittis dui est vel ligula. Quisque ac euismod lectus. Aenean congue velit eget eros faucibus, vitae rhoncus est accumsan. Aliquam erat volutpat. Etiam iaculis laoreet turpis, sed finibus ex porttitor non. Quisque semper eget libero sit amet accumsan. Vestibulum dignissim arcu vel diam tristique, eu mattis enim luctus. Curabitur convallis diam elit, vitae vulputate magna vestibulum in.\n</p>'),
	(2,'Artikel 2','<p>\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque et augue a elit feugiat euismod ut eu nulla. Aenean pretium tortor in enim tincidunt, sed lacinia neque egestas. Ut mattis sodales lorem, non porta erat semper et. Phasellus a mi vehicula, tincidunt ex eu, ullamcorper metus. Sed ultrices in velit quis vulputate. Ut felis est, dignissim at orci sed, ultricies accumsan libero. Nunc tempor blandit justo, a vestibulum turpis porta eget. In non eros tincidunt, vulputate urna id, dapibus lectus. Nulla non purus pharetra, placerat elit et, sollicitudin odio. Phasellus eget sem at augue egestas consectetur ac at sapien. Suspendisse vulputate volutpat erat, ac congue dolor consequat quis. Fusce id placerat nibh, id pharetra ligula. In sapien neque, auctor non justo a, venenatis tincidunt metus. Donec sed ligula id elit iaculis vulputate bibendum quis est. Duis feugiat sem ut sollicitudin ultricies.\n</p>\n<p>\nDonec bibendum nulla eget libero porta bibendum. Phasellus ac interdum mauris. Pellentesque eros enim, luctus vel nibh quis, pellentesque euismod felis. Nulla a blandit urna, sit amet pulvinar libero. Ut in odio et velit mattis tincidunt. Nullam fringilla feugiat turpis, eget pellentesque arcu pulvinar vitae. Quisque faucibus elit vitae pharetra pellentesque. Maecenas ac orci placerat, accumsan lectus id, aliquet eros.\n</p>\n<p>\nMorbi placerat diam et neque tristique, at venenatis nibh facilisis. Nulla sit amet augue massa. Morbi feugiat erat ut felis feugiat, sed iaculis metus malesuada. Donec tincidunt maximus urna ultrices molestie. Etiam pellentesque elementum dui, ut iaculis eros fringilla in. Pellentesque egestas, eros ac bibendum volutpat, lectus urna tempus est, id ullamcorper leo tellus vitae nulla. Sed non dictum mi. Sed arcu eros, varius in malesuada a, ornare vel dui. Donec blandit ligula id purus blandit, quis laoreet ante tempor. Mauris sagittis, purus eget porttitor imperdiet, turpis lectus luctus mi, eget varius diam orci ac justo. Mauris ac ultrices odio, in eleifend ante. Vivamus odio justo, convallis a pellentesque a, vehicula eget diam. Maecenas sed pulvinar arcu. Morbi egestas ornare libero quis accumsan. Etiam eu lectus nec nunc pharetra elementum a et ante.\n</p>\n<p>\nQuisque nec convallis turpis, dictum dictum sapien. Vestibulum vulputate augue risus, vitae ultrices felis rutrum id. Praesent porta enim nibh. Nullam finibus, nisl sed vulputate ornare, lorem augue imperdiet erat, nec mollis nulla sem id enim. Fusce in diam est. Aliquam eu laoreet turpis, sed luctus erat. Sed nec imperdiet ex, nec iaculis augue. Nulla commodo nibh at aliquet rutrum. Nulla porta est nec sem cursus, congue interdum sem tristique. Pellentesque iaculis fermentum vehicula.\n</p>\n<p>\nOrci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam vitae nibh nec odio feugiat malesuada in eu nunc. Donec congue tellus id lacus tincidunt efficitur sed id nibh. Proin commodo, orci non iaculis ultricies, sapien leo faucibus tellus, ut sagittis dui est vel ligula. Quisque ac euismod lectus. Aenean congue velit eget eros faucibus, vitae rhoncus est accumsan. Aliquam erat volutpat. Etiam iaculis laoreet turpis, sed finibus ex porttitor non. Quisque semper eget libero sit amet accumsan. Vestibulum dignissim arcu vel diam tristique, eu mattis enim luctus. Curabitur convallis diam elit, vitae vulputate magna vestibulum in.\n</p>');

/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table reply
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reply`;

CREATE TABLE `reply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) DEFAULT NULL,
  `reply_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `content` longtext,
  `created_date` datetime DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `reply` WRITE;
/*!40000 ALTER TABLE `reply` DISABLE KEYS */;

INSERT INTO `reply` (`id`, `article_id`, `reply_id`, `account_id`, `content`, `created_date`, `score`)
VALUES
	(16,1,0,1,'Hier is een voorbeeld reactie.','2019-02-08 00:38:00',5),
	(17,1,16,1,'Reactie op reactie # 16','2019-02-08 00:40:00',1),
	(18,2,0,2,'Miauw!','2019-02-08 00:48:00',3),
	(19,2,0,1,'Miauw indeed.','2019-02-08 00:57:00',-1),
	(20,2,18,1,'Reactie op een reactie.','2019-02-08 01:04:00',2),
	(21,2,0,1,'Nog een reactie.','2019-02-08 01:32:00',0),
	(22,2,0,1,'Testreactie','2019-02-08 01:33:00',0);

/*!40000 ALTER TABLE `reply` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
