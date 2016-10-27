-- MySQL dump 10.14  Distrib 5.5.50-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: newssyst_sha
-- ------------------------------------------------------
-- Server version	5.5.50-MariaDB-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL COMMENT 'Заголовок',
  `content` text NOT NULL COMMENT 'Содержимое',
  `publication_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата публикации',
  `last_upd` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Последнее изменение',
  `author_id` int(50) NOT NULL,
  `level` enum('school','city','area','global','system') NOT NULL COMMENT 'Уровень видимости',
  `published` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Видимость (да/нет)',
  `expiration_time` enum('one','two','three','never') NOT NULL,
  PRIMARY KEY (`article_id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (36,'Привет','Переменные издержки (variable cost, VC) - издержки, которые зависят от объема производства. К ним относятся затраты на заработную плату, сырье, топливо, электроэнергию, транспортные услуги и т.п. В отличие от постоянных переменные издержки изменяются в прямой зависимости от объема производства. Графически они изображаются в виде восходящей кривой (см. рис. 7.2), обозначаемой линией VC. Кривая переменных издержек показывает, что с ростом выпуска продукта растут переменные издержки производства. Различие между постоянными и переменными издержками имеет существенное значение для каждого бизнесмена. Переменными издержками предприниматель может управлять, так как их величина изменяется в течение краткосрочного периода в результате изменения объема производства. Постоянные же издержки находятся вне контроля администрации фирмы, так как они обязательны и должны быть оплачены независимо от объема производства. Общие, или валовые, издержки (total cost, ТС) - издержки в целом при данном объеме производства. Если наложить друг на друга кривые постоянных и переменных издержек, то получим новую кривую, отражающую общие издержки (см. рис. 7.2). Она обозначается кривой ТС. Таким образом, ТС= FC+ VC. В экономическом анализе кроме средних общих издержек используются такие понятия, как средние постоянные и средние переменные издержки. Рассчитываются они следующим образом: средние постоянные издержки (AFC) равны отношению постоянных издержек (FC) к выпуску продукции (Q): AFC = FC/Q. Средние переменные издержки (AVC), по аналогии, равны отношению переменных издержек (VC) к выпуску продукции: AVC = VC/Q.','2016-03-23 14:33:08','2016-05-17 12:13:57',6,'area',1,'one'),(62,'Привет','Nordea Bank: Доллар локально вполне может двинуться в направлении 70 рублей. В среду выйдут минутки ФРС, в четверг будет выступать глава Федрезерва. Рынок запутан в сигналах, но пока мало кто верит в повышение ставки на ближайших заседаниях. Любой намек на более жесткую политику, особенно после сильной статистики по рынку труда на прошлой неделе, может негативно сказаться на сырьевых валютах.','2016-04-06 10:31:31','2016-04-06 13:46:14',6,'city',0,'one'),(66,'Акция \"Зарядка для жизни\"','В  МОАУ СОШ № 2  в марте 2016 года прошли мероприятия «Медиа безопасности» для учащихся и родителей по ознакомлению с правилами безопасного пользования Интернетом, для учащихся 1-4 классов, 5-8 классов, 9-11 классов и их родителей  в целях формирования культуры ответственного, этичного и безопасного использования информационных технологий.','2016-04-07 07:33:00','0000-00-00 00:00:00',8,'city',0,'one'),(67,'Даже моя мама сделает лучше','А ничего, что когда просто заходишь, то видишь всего две новости, но когда ты заходишь в личный кабинет, то новости уже 3. это типа такая фича и баловство с правами доступа? ну и еще твой скриптик просмотра картинок идет по всей базе данных картинок, которые загрузил этот юзер, а не по новости. ну и картинка размером 50 на 50 пикселей, которая хранится в png и весит 300кб это не лучшее решение по оптимизации.\r\nи что бы ты не обижался, что я тут тебя задрочил, а ты и так знаешь, что все говно вот тебе котейка. даже гифки крепятся. молодец) возможно это все модерируется неким подобием начальства, и вам говорят, что вы лучше всех, а я так тут такой. накидал вам. вас даже возможно накажут. вот блин. что будет если я прикреплю голую бабу, чтобы ты не грустил?','2016-04-07 16:11:02','2016-04-07 16:17:17',6,'city',0,'one'),(71,'Не бессмысленный набор букв, а новость','Где-то не знаю где случилось что-то не знаю что. Кто-то не знаю кто был свидетелем происшествия. \"Это было что-то не знаю что\", – рассказывает очевидец.','2016-04-11 10:22:43','2016-04-17 11:43:45',6,'city',0,'one'),(73,'Проверка','<i>Проверка</i>','2016-04-17 06:54:29','2016-04-18 03:23:30',6,'city',0,'one'),(75,'ШОК 18+!! РЯЗАНСКИЕ УЧЕНЫЕ ВЫЯСНИЛИ ЧТО...','В РЯЗАНИ ПИРОГИ С ГЛАЗАМИ','2016-04-17 13:02:20','0000-00-00 00:00:00',6,'city',0,'one'),(77,'Акция \"Зарядка для жизни\"','В  МОАУ СОШ № 2  в марте 2016 года прошли мероприятия «Медиа безопасности» для учащихся и родителей по ознакомлению с правилами безопасного пользования Интернетом, для учащихся 1-4 классов, 5-8 классов, 9-11 классов и их родителей  в целях формирования культуры ответственного, этичного и безопасного использования информационных технологий.','2016-04-07 07:33:00','2016-05-23 10:09:59',9,'city',1,'one'),(78,'Привет','Добро пожаловать на сайт новостной системы \"Интеллектуальная школа\". \r\nЧтобы добавить новый материал, нажмите на кнопку \"Добавить новость\" на панели сверху. \r\nЕсли Вы хотите отредактировать новость, которую Вы уже добавляли, пройдите в свой кабинет и нажмите на кнопку \"Редактировать\" под соответствующей новостью. Там же вы можете удалить устаревший материал, он также будет удалён из Вашего приложения.\r\nУчтите, что добавленная Вами новость не появится сразу в приложении. Сначала её должен проверить наш модератор. Это не займёт много времени.','2016-04-19 12:53:58','2016-05-17 12:29:42',6,'system',1,'one'),(95,'Азбука здоровья','В рамках проходящей «Недели Здоровья» 21 апреля в 1 г классе был проведен классный час на тему «Азбука здоровья». В ходе данного мероприятия ребята размышляли о здоровье, отгадывали загадки, играли, а также сделали небольшие проекты о здоровом образе жизни. ','2016-05-23 10:14:17','0000-00-00 00:00:00',9,'city',0,'one'),(96,'А чо','А как дела с отступами?\r\nИсправили, надеюсь?\r\n       ЕЕЕЕЕЕЕЕ','2016-06-23 03:55:45','0000-00-00 00:00:00',6,'city',0,'one');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `src` varchar(255) NOT NULL,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `article_id` (`article_id`),
  CONSTRAINT `images_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (15,'http://shalashaska.h1n.ru/images/56f2a9246609d.jpeg',36),(54,'http://shalashaska.h1n.ru/images/imgnews/5704eab186ae2.png',62),(55,'http://shalashaska.h1n.ru/images/imgnews/5704eab1870d8.jpg',62),(60,'http://shalashaska.h1n.ru/images/imgnews/57060d2c50536.jpg',66),(61,'http://shalashaska.h1n.ru/images/imgnews/57060d2c50cdf.jpg',66),(62,'http://shalashaska.h1n.ru/images/imgnews/57060d2c5122f.jpg',66),(63,'http://shalashaska.h1n.ru/images/imgnews/57068696ca545.gif',67),(68,'http://shalashaska.h1n.ru/images/imgnews/57132d301eadd.jpg',71),(69,'http://shalashaska.h1n.ru/images/imgnews/57132d301f06a.jpg',71),(70,'http://shalashaska.h1n.ru/images/imgnews/57132d301f26d.jpg',71),(71,'http://shalashaska.h1n.ru/images/imgnews/57132d301f821.jpg',71),(73,'http://shalashaska.h1n.ru/images/imgnews/57132d301fbf6.jpg',71),(76,'http://shalashaska.h1n.ru/images/imgnews/5713332550ea8.jpg',73),(77,'http://shalashaska.h1n.ru/images/imgnews/5713895c88b5c.png',75),(83,'http://shalashaska.h1n.ru/images/imgnews/5716270f2165e.jpg',77),(85,'http://shalashaska.h1n.ru/images/imgnews/5716270f22657.jpg',77),(86,'http://shalashaska.h1n.ru/images/imgnews/57162a664b477.jpg',78),(87,'http://shalashaska.h1n.ru/images/imgnews/57163227b516f.jpg',77),(91,'http://shalashaska.h1n.ru/images/imgnews/5742d7fa11bf7.jpg',95),(92,'http://shalashaska.h1n.ru/images/imgnews/5742d7fa122f6.jpg',95);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orgs`
--

DROP TABLE IF EXISTS `orgs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orgs` (
  `org_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_type` enum('school','lyceum','tech_supp','another') NOT NULL COMMENT 'Тип организации',
  `org_title` text NOT NULL COMMENT 'Название организации',
  `city` varchar(100) NOT NULL COMMENT 'Город (село, ПГТ)',
  `province` varchar(200) DEFAULT NULL COMMENT 'Район (провинция)',
  `area` varchar(200) DEFAULT NULL COMMENT 'Область, край',
  PRIMARY KEY (`org_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orgs`
--

LOCK TABLES `orgs` WRITE;
/*!40000 ALTER TABLE `orgs` DISABLE KEYS */;
INSERT INTO `orgs` VALUES (1,'tech_supp','Группа ЗБ','Благовещенск','Благовещенский','Амурская'),(2,'school','High school of dead','Ромны','Ромненский','Амурская'),(3,'school','Школа №2','Бобруйск','Ракамакафо','Алтайский'),(4,'school','Школа №2','Санкт-Петербург','Северо-Западный','Ленинградская');
/*!40000 ALTER TABLE `orgs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(200) NOT NULL COMMENT 'Имя',
  `second_name` varchar(100) NOT NULL COMMENT 'Отчество',
  `surname` varchar(200) NOT NULL COMMENT 'Фамилия',
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post` varchar(100) NOT NULL COMMENT 'Должность',
  `email` varchar(50) NOT NULL COMMENT 'Почта',
  `login` varchar(200) NOT NULL COMMENT 'Логин',
  `password` varchar(200) NOT NULL COMMENT 'Пароль',
  `hash` varchar(32) NOT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Активация и возможность постить новости',
  `org_id` int(50) NOT NULL,
  `user_group` enum('admin','user','moderator') NOT NULL COMMENT 'Принадлежность пользователя',
  `token` text NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `email` (`email`),
  KEY `school` (`org_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `orgs` (`org_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (6,'Брюс','Томасович','Уэйн','2016-03-21 09:16:53','Бетмен','batman@gotham.com','222','04a284dd792660856f1a2f913128e1d2','',1,3,'user',''),(7,'Solid','dc','Snake','2016-04-06 13:35:54','dscsdc','snake@eater.com','snake','d4354b4190845747994e9eaa45205757','',1,1,'user',''),(8,'Иван','Иванович','Иванов','2016-04-07 07:23:39','ывыва','aa@aa.aa','aaa','daa1549dea3c9caf46ff13f0c64127b3','',1,3,'user',''),(9,'Иван','Иванович','Иванов','2016-04-19 12:35:52','Директор школы №2 г. Благовещенска','ivanivanov@email.com','ivanov','c30680082c4e9c1ae5a2b1d75dec7b1c','c9c07d1c03795b77e966d6da2a6f30d1',1,4,'user','eLzEckQQqx0:APA91bHKOXtvX50tci-E0Z9WW4iwoZxHIJS8qhEQ79XjDz5zWwnTh4o8MJuNUewUHp8AeChNZ3t3whIWdp-jWLUWe1u8z5IqR6yD5gso9jcanutkgf7-j1CeSNqZ5CnuiQvm3rdv0F43');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-04  9:29:25
