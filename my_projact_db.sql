
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `attribute_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attribute_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `attribute_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attribute_product` (
  `attr_id` int(10) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`attr_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `attribute_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attribute_value` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL,
  `attr_group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `value` (`value`),
  KEY `attr_group_id` (`attr_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'brand_no_image.jpg',
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `parent_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currency` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `code` varchar(3) NOT NULL,
  `symbol_left` varchar(10) NOT NULL,
  `symbol_right` varchar(10) NOT NULL,
  `value` float(15,2) NOT NULL,
  `base` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gallery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `modification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `old_price` float unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `status` enum('paid','new','processing','success') NOT NULL DEFAULT 'new',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL,
  `currency` varchar(10) NOT NULL,
  `note` text,
  `sum` float unsigned DEFAULT NULL,
  `log_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `sum` int(10) unsigned NOT NULL,
  `date` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `log` text NOT NULL,
  `status` enum('new','paid','processing','success','delete') NOT NULL DEFAULT 'new',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `order_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'no_image.jpg',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` tinyint(3) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `content` text,
  `price` float NOT NULL DEFAULT '0',
  `old_price` float NOT NULL DEFAULT '0',
  `status` enum('off','on') NOT NULL DEFAULT 'on',
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'pattern/no_image.jpg',
  `hit` enum('off','on') NOT NULL DEFAULT 'off',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`),
  KEY `category_id` (`category_id`),
  KEY `hit` (`hit`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `related_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `related_product` (
  `related_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`product_id`,`related_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `img` varchar(255) DEFAULT 'user_default.png',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

LOCK TABLES `attribute_group` WRITE;
/*!40000 ALTER TABLE `attribute_group` DISABLE KEYS */;
INSERT INTO `attribute_group` VALUES (1,'Механизм'),(2,'Стекло'),(3,'Ремешок'),(4,'Корпус'),(5,'Индикация');
/*!40000 ALTER TABLE `attribute_group` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `attribute_product` WRITE;
/*!40000 ALTER TABLE `attribute_product` DISABLE KEYS */;
INSERT INTO `attribute_product` VALUES (1,4),(1,5),(1,71),(1,72),(1,73),(3,5),(3,6),(5,4),(5,5),(6,33),(7,3),(7,6),(8,71),(8,72),(8,73),(10,4),(10,5),(11,7),(11,10),(14,3),(16,4),(16,5),(18,71),(18,72),(18,73);
/*!40000 ALTER TABLE `attribute_product` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `attribute_value` WRITE;
/*!40000 ALTER TABLE `attribute_value` DISABLE KEYS */;
INSERT INTO `attribute_value` VALUES (1,'Механика с автоподзаводом',1),(2,'Механика с ручным заводом',1),(3,'Кварцевый от батарейки',1),(4,'Кварцевый от солнечного аккумулятора',1),(5,'Сапфировое',2),(6,'Минеральное',2),(7,'Полимерное',2),(8,'Стальной',3),(9,'Кожаный',3),(10,'Каучуковый',3),(11,'Полимерный',3),(12,'Нержавеющая сталь',4),(13,'Титановый сплав',4),(14,'Латунь',4),(15,'Полимер',4),(16,'Керамика',4),(17,'Алюминий',4),(18,'Аналоговые',5),(19,'Цифровые',5);
/*!40000 ALTER TABLE `attribute_value` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` VALUES (1,'Casio','casio','abt-1.jpg','Casio sit amet sapien eros Integer dolore magna aliqua'),(2,'Citizen','citizen','abt-2.jpg','In sit amet sapien eros Integer dolore magna aliqua'),(3,'Royal London','royal-london','abt-3.jpg','In sit amet sapien eros Integer dolore magna aliqua'),(4,'Seiko','seiko','seiko.png',NULL),(5,'Diesel','diesel','diesel.png',NULL);
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Men','men',0,'Men','Men'),(2,'Women','women',0,'Women','Women'),(3,'Kids','kids',0,'Kids','Kids'),(4,'Электронные','elektronnye',1,'Электронные','Электронные'),(5,'Механические','mehanicheskie',1,'mehanicheskie','mehanicheskie'),(6,'Casio','casio',4,'Casio','Casio'),(7,'Citizen','citizen',4,'Citizen','Citizen'),(8,'Royal London','royal-london',5,'Royal London','Royal London'),(9,'Seiko','seiko',5,'Seiko','Seiko'),(10,'Epos','epos',5,'Epos','Epos'),(11,'Электронные','elektronnye-11',2,'Электронные','Электронные'),(12,'Механические','mehanicheskie-12',2,'Механические','Механические'),(13,'Adriatica','adriatica',11,'Adriatica','Adriatica'),(14,'Anne Klein','anne-klein',12,'Anne Klein','Anne Klein');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `currency` WRITE;
/*!40000 ALTER TABLE `currency` DISABLE KEYS */;
INSERT INTO `currency` VALUES (1,'Гривна','UAH','',' грн.',25.80,'0'),(2,'Dollar','USD','$ ','',1.00,'1'),(3,'Euro','EUR','€ ','',0.88,'0');
/*!40000 ALTER TABLE `currency` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `gallery` WRITE;
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
INSERT INTO `gallery` VALUES (4,12,'cas-1.jpg'),(107,151,'63d0d5474efb6fc0ea9f69f61e7fd5f0.jpg');
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `modification` WRITE;
/*!40000 ALTER TABLE `modification` DISABLE KEYS */;
/*!40000 ALTER TABLE `modification` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (160,8,'new','2020-01-14 11:07:43',NULL,'UAH','',10320,46),(161,8,'new','2020-01-14 11:07:53',NULL,'UAH','',516,47),(162,8,'success','2020-01-14 11:08:01','2020-01-14 11:19:35','UAH','',10320,48);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `order_log` WRITE;
/*!40000 ALTER TABLE `order_log` DISABLE KEYS */;
INSERT INTO `order_log` VALUES (15,159,9,90300,'','UAH','new?2020-01-14 11:56:55,paid?2020-01-14 11:57:06,success?2020-01-14 11:58:40,delete?2020-01-14 11:58:55','delete'),(14,158,9,90300,'','UAH','new?2020-01-14 11:19:06,paid?2020-01-14 11:19:15,processing?2020-01-14 11:50:22,success?2020-01-14 11:50:24,delete?2020-01-14 11:51:12','delete'),(16,0,0,0,'','',',delete?2020-01-14 13:00:58','delete'),(17,0,0,0,'','',',delete?2020-01-14 13:01:14','delete'),(18,0,0,0,'','',',delete?2020-01-14 13:01:22','delete'),(19,0,0,0,'','',',delete?2020-01-14 13:01:27','delete'),(20,0,0,0,'','',',delete?2020-01-14 13:01:32','delete'),(21,0,0,0,'','',',delete?2020-01-14 13:01:39','delete'),(22,0,0,0,'','',',delete?2020-01-14 13:01:44','delete'),(23,0,0,0,'','',',delete?2020-01-14 13:01:48','delete'),(24,0,0,0,'','',',delete?2020-01-14 13:01:52','delete'),(25,0,0,0,'','',',delete?2020-01-14 13:02:04','delete'),(26,0,0,0,'','',',delete?2020-01-14 13:02:10','delete'),(27,0,0,0,'','',',delete?2020-01-14 13:02:29','delete'),(28,0,0,0,'','',',delete?2020-01-14 13:02:35','delete'),(29,0,0,0,'','',',delete?2020-01-14 13:02:47','delete'),(30,0,0,0,'','',',delete?2020-01-14 13:02:51','delete'),(31,0,0,0,'','',',delete?2020-01-14 13:02:55','delete'),(32,0,0,0,'','',',delete?2020-01-14 13:03:00','delete'),(33,0,0,0,'','',',delete?2020-01-14 13:03:04','delete'),(34,0,0,0,'','',',delete?2020-01-14 13:03:12','delete'),(35,0,0,0,'','',',delete?2020-01-14 13:03:17','delete'),(36,0,0,0,'','',',delete?2020-01-14 13:03:32','delete'),(37,0,0,0,'','',',delete?2020-01-14 13:06:09','delete'),(38,0,0,0,'','',',delete?2020-01-14 13:06:12','delete'),(39,0,0,0,'','',',delete?2020-01-14 13:06:15','delete'),(40,0,0,0,'','',',delete?2020-01-14 13:06:22','delete'),(41,0,0,0,'','',',delete?2020-01-14 13:06:25','delete'),(42,0,0,0,'','',',delete?2020-01-14 13:06:27','delete'),(43,0,0,0,'','',',delete?2020-01-14 13:06:30','delete'),(44,0,0,0,'','',',delete?2020-01-14 13:06:32','delete'),(45,0,0,0,'','',',delete?2020-01-14 13:06:34','delete'),(46,160,8,10320,'2020-01-14 13:07:43','UAH','new?2020-01-14 13:07:43','new'),(47,161,8,516,'2020-01-14 13:07:53','UAH','new?2020-01-14 13:07:53','new'),(48,162,8,10320,'2020-01-14 13:08:01','UAH','new?2020-01-14 13:08:01,paid?2020-01-14 13:08:10,processing?2020-01-14 13:12:30,success?2020-01-14 13:12:32,processing?2020-01-14 13:19:19,success?2020-01-14 13:19:35','success'),(49,163,9,9030,'2020-01-14 13:08:40','UAH','new?2020-01-14 13:08:40,paid?2020-01-14 13:08:49,processing?2020-01-14 13:11:58,delete?2020-01-14 13:12:01','delete'),(50,164,9,90300,'2020-01-14 13:09:03','UAH','new?2020-01-14 13:09:03,success?2020-01-17 20:47:56,delete?2020-01-17 20:48:05','delete');
/*!40000 ALTER TABLE `order_log` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `order_product` WRITE;
/*!40000 ALTER TABLE `order_product` DISABLE KEYS */;
INSERT INTO `order_product` VALUES (145,160,3,1,'Casio GA-1000-1AER','casio-ga-1000-1aer',10320,'p-3.png'),(146,161,7,1,'Q&Q Q956J302Y','q-q-q956j302y',516,'p-7.png'),(147,162,4,1,'Citizen JP1010-00E','citizen-jp1010-00e',10320,'p-4.png');
/*!40000 ALTER TABLE `order_product` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (3,6,'Casio GA-1000-1AER','casio-ga-1000-1aer','',400,0,'on','','','p-3.png','on'),(4,7,'Citizen JP1010-00E','citizen-jp1010-00e','',400,0,'on','','','p-4.png','on'),(5,7,'Citizen BJ2111-08E','citizen-bj2111-08e',NULL,500,0,'on',NULL,NULL,'p-5.png','off'),(6,7,'Citizen AT0696-59E','citizen-at0696-59e','',3500,3550,'on','','','p-6.png','on'),(7,8,'Q&Q Q956J302Y','q-q-q956j302y','',20,0,'on','','','p-7.png','on'),(10,8,'Royal London 41156-02','royal-london-41156-02','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam tristique, diam in consequat iaculis, est purus iaculis mauris, imperdiet facilisis ante ligula at nulla. Quisque volutpat nulla risus, id maximus ex aliquet ut. Suspendisse potenti. Nulla varius lectus id turpis dignissim porta. Quisque magna arcu, blandit quis felis vehicula, feugiat gravida diam. Nullam nec turpis ligula. Aliquam quis blandit elit, ac sodales nisl. Aliquam eget dolor eget elit malesuada aliquet. In varius lorem lorem, semper bibendum lectus lobortis ac.</p>\r\n\r\n<p>Mauris placerat vitae lorem gravida viverra. Mauris in fringilla ex. Nulla facilisi. Etiam scelerisque tincidunt quam facilisis lobortis. In malesuada pulvinar neque a consectetur. Nunc aliquam gravida purus, non malesuada sem accumsan in. Morbi vel sodales libero.</p>\r\n',100,0,'on','','','ea5db014c1c43c424cce002f1b9148e4.jpg','off'),(151,3,'ZZZZ_111','zzzz-111','<h2><ins><strong>CASIO DW-6900SK-1ER</strong></ins></h2>\r\n\r\n<p>DW-6900SK-1ER&nbsp;Коллекция Casio G -Shock представляет собой невероятно модный и современный аксессуар повседневной одежды. Эти часы имеют ярко выраженный спортивный вид. Могут быть как часами для повседневного ношения так и помощником для занятий активными видами спорта и туризма. Они сделаны из современных гипоалергенных, эластичных и очень удобных полимерных материалов. Которые устойчивы к агрессивным средам, повышенному износу. Удобно читаемый циферблат из противоударного минерального стекла, слегка утоплен в корпус что защищает стекло от царапин. Данная модель может пригодится любителям водной стихии использовать для посещения бассейнов и открытых водоемов(озера, речки, моря). Имеет водозащиту 20 атмосфер и расширенный функционал: Будильник мировое время, смену часовых поясов, секундомер, таймер, и очень удобную подсветку..</p>\r\n\r\n<p><img alt=\"\" src=\"/public/images/images/ZZZZ_111/maxresdefault.jpg\" style=\"height:450px; width:800px\" /></p>\r\n\r\n<p>DW-6900SK-1ER&nbsp;Коллекция Casio G -Shock представляет собой невероятно модный и современный аксессуар повседневной одежды. Эти часы имеют ярко выраженный спортивный вид. Могут быть как часами для повседневного ношения так и помощником для занятий активными видами спорта и туризма. Они сделаны из современных гипоалергенных, эластичных и очень удобных полимерных материалов. Которые устойчивы к агрессивным средам, повышенному износу. Удобно читаемый циферблат из противоударного минерального стекла, слегка утоплен в корпус что защищает стекло от царапин. Данная модель может пригодится любителям водной стихии использовать для посещения бассейнов и открытых водоемов(озера, речки, моря). Имеет водозащиту 20 атмосфер и расширенный функционал: Будильник мировое время, смену часовых поясов, секундомер, таймер, и очень удобную подсветку..<br />\r\n<img alt=\"\" src=\"/public/images/images/ZZZZ_111/21903215_2.jpg\" style=\"float:right; height:400px; width:400px\" /></p>\r\n\r\n<p>DW-6900SK-1ER&nbsp;Коллекция Casio G -Shock представляет собой невероятно модный и современный аксессуар повседневной одежды. Эти часы имеют ярко выраженный спортивный вид. Могут быть как часами для повседневного ношения так и помощником для занятий активными видами спорта и туризма. Они сделаны из современных гипоалергенных, эластичных и очень удобных полимерных материалов. Которые устойчивы к агрессивным средам, повышенному износу. Удобно читаемый циферблат из противоударного минерального стекла, слегка утоплен в корпус что защищает стекло от царапин. Данная модель может пригодится любителям водной стихии использовать для посещения бассейнов и открытых водоемов(озера, речки, моря). Имеет водозащиту 20 атмосфер и расширенный функционал: Будильник мировое время, смену часовых поясов, секундомер, таймер, и очень удобную подсветку..</p>\r\n',350,0,'on','','','37e57f1193cd3791ee25e75a9c4add0d.jpg','on');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `related_product` WRITE;
/*!40000 ALTER TABLE `related_product` DISABLE KEYS */;
INSERT INTO `related_product` VALUES (1,5),(7,5),(8,5),(1,73),(2,73),(3,73),(12,73),(25,73);
/*!40000 ALTER TABLE `related_product` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (7,'admin','$2y$10$iI/VVJeQOBmDvII7bv9NDOmjDAIlr32AoCLInCNnpG8nkugr6HjYK','afromipa55@gmail.com','Dmitriy Cheremis','Dnepr','admin','admin.png'),(8,'user1','$2y$10$FDLgsGxPphrjuabyz.y.EOaRQg.OklHbztKP5vrF4BbrcqWRa.kGu','user1@gmail.com','Oleg','Dnepr','user','15778975633777.jpg'),(9,'user2','$2y$10$W.sgBr6VqvhYqiZeGSSDFe65AvFh5xlQZtnhm5nnrw0fQ7bK1ThgC','user2@gmail.com','Kosta','Dnepr','user','user1.jpg'),(10,'user3','$2y$10$ZIWHdOcR7UFcuH.iYhuWTOo0EblCBo4L4NbH3c5AsmiNtGX8ul38i','user3@gmail.com','Dima','Nicopol','user','user_default.png'),(11,'karina','$2y$10$Yj7HIqEOLMw2tJfdCvdOw.tZY86vsov7icwFa11.3BnWR4huDXTiG','karina55mipa@gmail.com','Karina','Dnepr','user','15783908325057.jpeg'),(12,'user','$2y$10$qjUolsZjqXkP5WozCJOIQenP5A7WKcc4T.PWKjgZ2S5iOt7YuwUMe','user55@gmail.com','Dima','Dnepr','user','user_default.png'),(13,'user6','$2y$10$AcHXNd0LhM2ci2v81Jmz9.aihULuspMwyfjNNzVCUFrOqZtfYIAk2','user6@gmail.com','Marina','Nicolaev','user','user_default.png'),(14,'user5','$2y$10$pVxIHbxTJ0ZtMA87seMD1e6n5vy7E8Cdi19cFWXNPm1De6u2BJzlS','user5@gmail.com','Olga','Zaporojie','user','user_default.png'),(15,'user7','$2y$10$aY8xJE97GbUNP9x1/HQS8.Kf4gt98tkqMNzmAqcgYMi8LlOehivZ6','user7@gmail.com','Kola','Nicolaev','user','user_default.png'),(16,'user8','$2y$10$nuyzCOzEUCQjyFG3bYroJugPE0q/LF7s6OsSI8PfFhDj2VRfbIr6G','user8@gmail.com','Gleb','Kiev','user','user_default.png'),(24,'user10','$2y$10$a37lntqm6zooFCaXWW2g0e1XeehUiBYY9RACJWO.XUSW/NBysto7.','user10@gmail.com','Sane','Odesa','user','user_default.png'),(25,'user11','$2y$10$zJaKlVb3MoYieKoo88T02.hHme9Jhot2Iz8n9P2aavU6N.O6/ljH.','user11@gmail.com','Kata','Dnepr','user','user_default.png'),(26,'user12','$2y$10$OswCR5JdiWXAvxrwYbPZU.NDu/H2W7.JijG9Y.ufiRDVjBEBKnzZO','user12@gmail.com','Zoma','Zaporojie','user','user_default.png'),(27,'kiril','$2y$10$sSkdOr/yif.fX/jN5xEXdeHOBxzqc9EZzqMHInKhCtvsEi/ReJD3C','kiril55@gmail.com','Kiril','Margonec','user','user_default.png'),(28,'kseniy','$2y$10$FuUgSBBGT0vKUfnlVRMzAO5aSnRn01JJsjwax3NAzcwgliCBL.Es.','kseniy55@gmail.com','Kseniy','Zaporojie','user','user_default.png'),(29,'Karlen','$2y$10$1Mm5Ben4TF86eZiVEKuJWOyrkjJGeOSXhNcbGVClbhbs9Kslqhgtu','karlen55@gmail.com','karlen','Dnepr','user','user_default.png'),(30,'Pidardimon','$2y$10$hBbKIebZkdE.aqRkLfOrY.p8OxCPxkz1p4Y8SZTAs9FKCHuvEraNG','kostya0693@gmail.com','Hddx','Ghhc','user','user_default.png'),(31,'besffamilniy','$2y$10$aY6LkLBbobiFPHj927AlT.8l3.WAY49N32JOf3eGF1ul907sN56sS','besffamilniy@gmail.com','Vladislav Grindak','Dnipro','user','user_default.png');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

