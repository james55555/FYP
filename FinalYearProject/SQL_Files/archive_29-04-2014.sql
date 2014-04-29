-- MySQL dump 10.13  Distrib 5.6.12, for Win64 (x86_64)
--
-- Host: localhost    Database: archive
-- ------------------------------------------------------
-- Server version	5.6.12-log

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `user_id` varchar(25) NOT NULL,
  `acc_create_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Timestamp for creation of the account',
  `password` varchar(255) NOT NULL COMMENT 'Password for account',
  `first_nm` varchar(30) NOT NULL COMMENT 'First name of the user',
  `last_nm` varchar(30) NOT NULL COMMENT 'Last name of the user',
  `email_addr` varchar(50) DEFAULT NULL COMMENT 'Email address of the user',
  `archive_ts` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Store system user data';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `convertToMySQLNull` BEFORE INSERT ON `account`
 FOR EACH ROW BEGIN
SET NEW.`email_addr`=NULLIF(NEW.`email_addr`,"NULL");
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `dependency`
--

DROP TABLE IF EXISTS `dependency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dependency` (
  `DEPENDENCY_ID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Identify each corresponding dependency',
  `DEPENDENT_ON` int(10) unsigned zerofill DEFAULT NULL COMMENT 'Represents a task id the task requires before start',
  `archive_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`DEPENDENCY_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Represent dependencies between tasks';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dependency`
--

LOCK TABLES `dependency` WRITE;
/*!40000 ALTER TABLE `dependency` DISABLE KEYS */;
INSERT INTO `dependency` VALUES (0000000001,0000000002,'2014-04-03 10:54:02'),(0000000002,0000000003,'2014-04-03 11:23:16'),(0000000005,0000000003,'2014-04-03 12:35:12');
/*!40000 ALTER TABLE `dependency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estimation`
--

DROP TABLE IF EXISTS `estimation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estimation` (
  `EST_ID` int(10) unsigned zerofill NOT NULL COMMENT 'Estimation identifier to determine which project or task it is related to',
  `ACT_HR` int(4) unsigned DEFAULT NULL COMMENT 'Represents actual hours assigned to the project',
  `PLN_HR` int(4) unsigned DEFAULT NULL COMMENT 'Represents planned hours assigned to project',
  `START_DT` date NOT NULL DEFAULT '2014-06-06' COMMENT 'Represent the start date of the task',
  `ACT_END_DT` date DEFAULT '2014-07-06' COMMENT 'Represent the actual estimated end date',
  `EST_END_DT` date NOT NULL DEFAULT '2014-07-06' COMMENT 'Represent the estimated end date of the task',
  `archive_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`EST_ID`),
  UNIQUE KEY `TSK_ID` (`EST_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estimation`
--

LOCK TABLES `estimation` WRITE;
/*!40000 ALTER TABLE `estimation` DISABLE KEYS */;
INSERT INTO `estimation` VALUES (0000000001,10,15,'2014-03-03','2014-07-31','2014-07-14','2014-04-03 10:53:20'),(0000000003,NULL,10,'2014-06-06','2014-10-09','2014-11-10','2014-04-10 13:51:53'),(0000000004,20,10,'2013-06-06','2014-01-09','2014-02-10','2014-04-03 08:32:02'),(0000000031,13,235,'2014-05-06',NULL,'2014-05-06','2014-04-02 19:37:38'),(0000000032,NULL,98,'2014-04-03',NULL,'2014-04-17','2014-04-07 08:53:07'),(0000000033,NULL,24,'2014-04-08',NULL,'2014-04-09','2014-04-07 08:52:34'),(0000000034,NULL,200,'1998-02-01',NULL,'2000-03-02','2014-04-07 10:12:20'),(0000000035,NULL,200,'1998-02-01',NULL,'2000-03-02','2014-04-07 10:06:05'),(0000000036,NULL,200,'1998-02-01',NULL,'2000-03-02','2014-04-07 10:03:42'),(0000000037,NULL,200,'1998-02-01',NULL,'2000-03-02','2014-04-07 09:50:30'),(0000000038,NULL,2,'1992-04-05',NULL,'2014-04-05','2014-04-08 17:26:07'),(0000000039,NULL,2,'1992-04-05',NULL,'2014-04-05','2014-04-08 17:25:09'),(0000000040,NULL,2,'1992-04-05',NULL,'2014-04-05','2014-04-08 17:24:55'),(0000000041,0,23,'1992-04-05','0000-00-00','1992-05-05','2014-04-21 20:36:39'),(0000000077,NULL,123,'2313-04-03',NULL,'2400-03-12','2014-04-09 17:53:47'),(0000000078,NULL,123,'2313-04-03',NULL,'2400-03-12','2014-04-09 17:53:22'),(0000000079,NULL,12,'1234-12-12',NULL,'2212-03-12','2014-04-21 20:12:37'),(0000000080,NULL,123,'2222-12-04',NULL,'1222-12-12','2014-04-10 15:12:19'),(0000000081,NULL,0,'2014-03-06',NULL,'2014-04-05','2014-04-10 15:06:07'),(0000000082,NULL,123,'1234-01-05',NULL,'9000-03-12','2014-04-11 18:44:15'),(0000000083,NULL,123,'1234-12-05',NULL,'3214-03-12','2014-04-11 18:43:34'),(0000000084,NULL,123,'1234-12-05',NULL,'3214-03-12','2014-04-11 18:18:06'),(0000000085,NULL,123,'1234-12-05',NULL,'3214-03-12','2014-04-11 18:17:49'),(0000000086,NULL,123,'1234-12-05',NULL,'3214-03-12','2014-04-11 18:15:26'),(0000000087,NULL,0,'0000-00-00',NULL,'0000-00-00','2014-04-19 16:11:27'),(0000000088,NULL,0,'0000-00-00',NULL,'0000-00-00','2014-04-20 15:52:08'),(0000000097,NULL,0,'0000-00-00',NULL,'0000-00-00','2014-04-13 21:28:02'),(0000000255,0,0,'0000-00-00','2014-06-07','0000-00-00','2014-04-24 00:22:36'),(0000000256,0,0,'0000-00-00','2015-04-03','0000-00-00','2014-04-22 19:22:43'),(0000000257,0,213,'2014-04-15','2014-04-23','2014-04-30','2014-04-23 23:52:14'),(0000000258,0,0,'0000-00-00','2015-05-05','0000-00-00','2014-04-22 22:39:14'),(0000000259,0,0,'0000-00-00','2014-04-16','0000-00-00','2014-04-23 23:52:09'),(0000000260,0,0,'0000-00-00','2015-05-03','0000-00-00','2014-04-23 17:07:56'),(0000000279,0,0,'0000-00-00','2015-05-03','0000-00-00','2014-04-23 17:25:30'),(0000000280,0,0,'0000-00-00','2015-05-03','0000-00-00','2014-04-23 17:25:30'),(0000000281,0,0,'0000-00-00','2015-05-03','0000-00-00','2014-04-23 17:25:30'),(0000000282,0,0,'0000-00-00','2015-05-03','0000-00-00','2014-04-23 17:25:31'),(0000000283,0,0,'0000-00-00','2015-05-03','0000-00-00','2014-04-23 17:25:32'),(0000000286,0,0,'0000-00-00','2014-04-16','0000-00-00','2014-04-23 23:52:12'),(0000000322,NULL,215,'2014-04-01',NULL,'2014-04-30','2014-04-24 00:07:54'),(0000000323,0,0,'0000-00-00','2014-04-02','0000-00-00','2014-04-24 00:07:53'),(0000000324,NULL,2134,'2014-04-01',NULL,'2014-04-30','2014-04-24 00:22:01'),(0000000325,0,0,'0000-00-00','2014-04-05','0000-00-00','2014-04-24 00:22:00'),(0000000405,0,3000,'2015-01-01','2014-04-26','2015-12-31','2014-04-26 14:59:04'),(0000000406,0,0,'0000-00-00','2015-01-01','0000-00-00','2014-04-26 14:59:04'),(0000000407,0,0,'0000-00-00','2015-01-14','0000-00-00','2014-04-26 14:58:12');
/*!40000 ALTER TABLE `estimation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `proj_id` int(10) unsigned zerofill NOT NULL COMMENT 'Project ID to provide a unique reference to each project',
  `proj_nm` varchar(30) DEFAULT NULL COMMENT 'Name of project',
  `proj_descr` varchar(200) DEFAULT NULL COMMENT 'Description of the project i.e. website URL etc',
  `archive_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'set timestamp for deletion',
  PRIMARY KEY (`proj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table to store project data ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (0000000032,'test project','this project is here to test deletes','2014-04-02 13:52:28'),(0000000033,'project','new project','2014-04-07 08:53:08'),(0000000034,'mondayProjTesting','a new project','2014-04-07 08:52:34'),(0000000035,'show message testing','this project is here to test the show message screen','2014-04-07 10:12:20'),(0000000036,'show message testing','this project is here to test the show message screen','2014-04-07 10:06:05'),(0000000037,'show message testing','this project is here to test the show message screen','2014-04-07 10:03:42'),(0000000038,'show message testing','this project is here to test the show message screen','2014-04-07 09:50:31'),(0000000039,'new project','this is a new project','2014-04-08 17:26:07'),(0000000040,'new project','this is a new project','2014-04-08 17:25:09'),(0000000041,'new project','this is a new project','2014-04-08 17:24:56'),(0000000042,'Test project 2','newtest                                                ','2014-04-21 20:36:39'),(0000000044,'test','test run','2014-04-10 15:06:09'),(0000000045,'new project','new description','2014-04-23 23:52:16'),(0000000046,'new project','this is to test the delete functionality','2014-04-24 00:07:56'),(0000000047,'new project','tobe deleted','2014-04-24 00:22:01'),(0000000048,'matthew\'s project','a very boring, boring project with boring tasks','2014-04-26 14:59:06');
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_estimation`
--

DROP TABLE IF EXISTS `project_estimation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_estimation` (
  `proj_id` int(10) unsigned zerofill NOT NULL COMMENT 'this provides the link to each project',
  `est_id` int(10) unsigned zerofill NOT NULL COMMENT 'this provides the link to each estimation',
  `archive_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `proj_id` (`proj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This table provides the link between projects and their estimation';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_estimation`
--

LOCK TABLES `project_estimation` WRITE;
/*!40000 ALTER TABLE `project_estimation` DISABLE KEYS */;
INSERT INTO `project_estimation` VALUES (0000000032,0000000031,'2014-04-02 20:23:30'),(0000000033,0000000032,'2014-04-07 08:53:08'),(0000000034,0000000033,'2014-04-07 08:52:34'),(0000000035,0000000034,'2014-04-07 10:12:20'),(0000000036,0000000035,'2014-04-07 10:06:05'),(0000000037,0000000036,'2014-04-07 10:03:42'),(0000000038,0000000037,'2014-04-07 09:50:30'),(0000000039,0000000038,'2014-04-08 17:26:07'),(0000000040,0000000039,'2014-04-08 17:25:09'),(0000000041,0000000040,'2014-04-08 17:24:55'),(0000000042,0000000041,'2014-04-21 20:36:39'),(0000000043,0000000079,'2014-04-21 20:12:37'),(0000000044,0000000097,'2014-04-23 17:25:32'),(0000000045,0000000257,'2014-04-23 23:52:15'),(0000000046,0000000322,'2014-04-24 00:07:55'),(0000000047,0000000324,'2014-04-24 00:22:01'),(0000000048,0000000405,'2014-04-26 14:59:05');
/*!40000 ALTER TABLE `project_estimation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff` (
  `STAFF_ID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Hold the identifier of the staff identifier',
  `STAFF_FIRST_NM` varchar(30) NOT NULL COMMENT 'Hold the first name of the staff member',
  `STAFF_LAST_NM` varchar(30) NOT NULL COMMENT 'Hold the last name of the staff member',
  `STAFF_PHONE` varchar(32) DEFAULT NULL COMMENT 'Hold the staff members telephone number (after PHP validation)',
  `STAFF_EMAIL` varchar(50) DEFAULT NULL COMMENT 'Hold the staff members email address',
  `archive_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`STAFF_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Store STAFF information';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `Add_After_Staff_Insert` AFTER INSERT ON `staff`
 FOR EACH ROW insert into staff_task
values(staff.staff_id, null) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `staff_task`
--

DROP TABLE IF EXISTS `staff_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff_task` (
  `TSK_ID` int(10) unsigned zerofill NOT NULL COMMENT 'Field to store task id',
  `STAFF_ID` int(10) unsigned zerofill NOT NULL COMMENT 'Field to store staff id',
  `archive_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table to provide join between staff member and task';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_task`
--

LOCK TABLES `staff_task` WRITE;
/*!40000 ALTER TABLE `staff_task` DISABLE KEYS */;
INSERT INTO `staff_task` VALUES (0000000020,0000000001,'2014-04-03 10:53:19'),(0000000015,0000000002,'2014-04-03 11:23:16'),(0000000001,0000000002,'2014-04-03 11:23:16'),(0000000048,0000000034,'2014-04-13 21:28:00'),(0000000019,0000000034,'2014-04-13 21:28:00'),(0000000047,0000000033,'2014-04-23 15:34:37'),(0000000018,0000000033,'2014-04-23 15:34:37'),(0000000071,0000000098,'2014-04-23 17:25:31'),(0000000072,0000000099,'2014-04-23 23:52:11'),(0000000073,0000000100,'2014-04-24 00:07:50'),(0000000074,0000000101,'2014-04-24 00:21:59');
/*!40000 ALTER TABLE `staff_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `TSK_ID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Task identifier',
  `PROJ_ID` int(10) unsigned zerofill NOT NULL COMMENT 'Identify associated project',
  `STATUS` enum('Not Started','In Progress','Finished') NOT NULL DEFAULT 'Not Started' COMMENT 'Display task status',
  `TASK_NM` varchar(30) NOT NULL COMMENT 'Name of the task',
  `WEB_ADDR` varchar(60) DEFAULT NULL COMMENT 'Any email address associated with the task',
  `TSK_DESCR` varchar(200) DEFAULT NULL COMMENT 'Description of the task',
  `archive_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TSK_ID`),
  KEY `PROJ_ID` (`PROJ_ID`,`STATUS`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8 COMMENT='Table to store all task data';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (0000000001,0000000001,'Not Started','test task 1','www.testdetails.com',NULL,'2014-04-03 10:54:02'),(0000000002,0000000001,'In Progress','test task 3',NULL,'a description','2014-04-03 11:23:16'),(0000000003,0000000001,'Not Started','test task 4','www.testdetails.com',NULL,'2014-04-10 13:51:54'),(0000000004,0000000001,'Finished','test task 2','email','a description','2014-04-07 08:57:17'),(0000000017,0000000043,'Not Started','Testing Task 1','','This task is used ','2014-04-11 18:45:36'),(0000000018,0000000043,'Not Started','Testing Task 1','','This task is used ','2014-04-11 18:45:16'),(0000000019,0000000043,'Not Started','Testing Task 1','','This task is used ','2014-04-11 18:44:15'),(0000000020,0000000032,'Finished','delete tewst task','task to delete',NULL,'2014-04-03 12:35:12'),(0000000021,0000000043,'Not Started','new task','','added new tasks','2014-04-11 18:18:06'),(0000000022,0000000043,'Not Started','new task','','added new tasks','2014-04-11 18:17:49'),(0000000023,0000000043,'Not Started','new task','','added new tasks','2014-04-11 18:15:26'),(0000000024,0000000001,'Not Started','update test','','this project ','2014-04-19 16:11:28'),(0000000025,0000000001,'Not Started','update test','','this project ','2014-04-20 15:52:09'),(0000000033,0000000044,'Not Started','','','','2014-04-23 15:34:40'),(0000000034,0000000043,'Not Started','','','','2014-04-13 21:28:03'),(0000000045,0000000042,'In Progress','testTask','','this is a new task to debug the system with.','2014-04-09 16:57:04'),(0000000046,0000000042,'In Progress','testTask','','this is a new task to debug the system with.','2014-04-09 17:53:47'),(0000000047,0000000042,'In Progress','testTask','','this is a new task to debug the system with.','2014-04-09 17:53:23'),(0000000048,0000000042,'In Progress','new task','https://www.hotmail.com','this is a newst','2014-04-10 15:12:20'),(0000000068,0000000001,'Not Started','new tas','NULL','NULL','2014-04-23 20:08:38'),(0000000071,0000000001,'Not Started','new tas','NULL','NULL','2014-04-24 00:22:36'),(0000000072,0000000044,'Not Started','testask','NULL','NULL','2014-04-22 19:22:45'),(0000000073,0000000044,'Not Started','new task','NULL','this','2014-04-22 22:39:15'),(0000000074,0000000045,'Not Started','new task','NULL','NULL','2014-04-23 23:52:11'),(0000000075,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:07:57'),(0000000076,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:09:05'),(0000000077,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:13:11'),(0000000078,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:26'),(0000000079,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:26'),(0000000080,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:26'),(0000000081,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:26'),(0000000082,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:27'),(0000000083,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:27'),(0000000084,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:27'),(0000000085,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:27'),(0000000086,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:28'),(0000000087,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:28'),(0000000088,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:28'),(0000000089,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:28'),(0000000090,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:29'),(0000000091,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:29'),(0000000092,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:29'),(0000000093,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:29'),(0000000094,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:30'),(0000000095,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:30'),(0000000096,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:31'),(0000000097,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:31'),(0000000098,0000000044,'Not Started','james','NULL','NULL','2014-04-23 17:25:32'),(0000000099,0000000045,'Not Started','delete task','NULL','NULL','2014-04-23 23:52:14'),(0000000100,0000000046,'In Progress','new task','website','this is the delete task','2014-04-24 00:07:54'),(0000000101,0000000047,'Not Started','to be del','NULL','this is a new task to be deleted','2014-04-24 00:22:00'),(0000000103,0000000048,'Not Started','task 1','NULL','the most boring of tasks','2014-04-26 14:59:04'),(0000000104,0000000048,'In Progress','task 2','NULL','a slightly less boring task','2014-04-26 14:58:13');
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_dependency`
--

DROP TABLE IF EXISTS `task_dependency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_dependency` (
  `DEPENDENCY_ID` int(10) unsigned zerofill NOT NULL COMMENT 'Dependency Identifier',
  `TSK_ID` int(10) unsigned zerofill NOT NULL COMMENT 'Store task identifier',
  `archive_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TSK_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table to hold information pertaining to the relationships between tasks';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_dependency`
--

LOCK TABLES `task_dependency` WRITE;
/*!40000 ALTER TABLE `task_dependency` DISABLE KEYS */;
INSERT INTO `task_dependency` VALUES (0000000001,0000000001,'2014-04-03 10:54:02'),(0000000002,0000000002,'2014-04-03 11:23:16'),(0000000003,0000000003,'2014-04-10 13:51:53'),(0000000071,0000000004,'2014-04-07 08:57:17'),(0000000072,0000000005,'2014-04-22 19:22:44'),(0000000073,0000000007,'2014-04-22 22:39:15'),(0000000074,0000000010,'2014-04-23 23:52:10');
/*!40000 ALTER TABLE `task_dependency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_estimation`
--

DROP TABLE IF EXISTS `task_estimation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_estimation` (
  `tsk_id` int(10) unsigned zerofill NOT NULL COMMENT 'This is the link to each task',
  `est_id` int(10) unsigned zerofill NOT NULL COMMENT 'This is the link to each estimation',
  `archive_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `tsk_id` (`tsk_id`,`est_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This table provides the link between TASK and ESTIMATION';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_estimation`
--

LOCK TABLES `task_estimation` WRITE;
/*!40000 ALTER TABLE `task_estimation` DISABLE KEYS */;
INSERT INTO `task_estimation` VALUES (0000000001,0000000001,'2014-04-03 10:53:20'),(0000000002,0000000002,'2014-04-03 11:23:16'),(0000000003,0000000003,'2014-04-10 13:51:53'),(0000000006,0000000000,'2014-04-03 07:53:05'),(0000000017,0000000080,'2014-04-11 18:45:36'),(0000000018,0000000081,'2014-04-11 18:45:16'),(0000000019,0000000082,'2014-04-11 18:44:15'),(0000000020,0000000004,'2014-04-03 08:16:00'),(0000000021,0000000084,'2014-04-11 18:18:06'),(0000000022,0000000085,'2014-04-11 18:17:49'),(0000000023,0000000086,'2014-04-11 18:15:26'),(0000000024,0000000087,'2014-04-19 16:11:26'),(0000000025,0000000088,'2014-04-20 15:52:08'),(0000000033,0000000096,'2014-04-23 15:34:39'),(0000000034,0000000097,'2014-04-13 21:28:01'),(0000000046,0000000077,'2014-04-09 17:53:47'),(0000000047,0000000078,'2014-04-09 17:53:22'),(0000000048,0000000080,'2014-04-10 15:12:18'),(0000000071,0000000255,'2014-04-24 00:22:36'),(0000000072,0000000256,'2014-04-22 19:22:43'),(0000000073,0000000258,'2014-04-22 22:39:14'),(0000000074,0000000259,'2014-04-23 23:52:08'),(0000000075,0000000260,'2014-04-23 17:07:56'),(0000000094,0000000279,'2014-04-23 17:25:29'),(0000000095,0000000280,'2014-04-23 17:25:30'),(0000000096,0000000281,'2014-04-23 17:25:30'),(0000000097,0000000282,'2014-04-23 17:25:31'),(0000000098,0000000283,'2014-04-23 17:25:32'),(0000000099,0000000286,'2014-04-23 23:52:12'),(0000000100,0000000323,'2014-04-24 00:07:52'),(0000000101,0000000325,'2014-04-24 00:21:59'),(0000000103,0000000406,'2014-04-26 14:59:04'),(0000000104,0000000407,'2014-04-26 14:58:11');
/*!40000 ALTER TABLE `task_estimation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_project`
--

DROP TABLE IF EXISTS `user_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_project` (
  `user_id` varchar(50) NOT NULL COMMENT 'Field to store user id',
  `proj_id` int(10) unsigned zerofill NOT NULL,
  `archive_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'time project was disassociated with user',
  PRIMARY KEY (`proj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table to hold associations between users and their projects';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_project`
--

LOCK TABLES `user_project` WRITE;
/*!40000 ALTER TABLE `user_project` DISABLE KEYS */;
INSERT INTO `user_project` VALUES ('testuser1',0000000032,'2014-04-02 20:27:10'),('testuser1',0000000033,'2014-04-07 08:53:08'),('testuser1',0000000034,'2014-04-07 08:52:35'),('testuser1',0000000035,'2014-04-07 10:12:20'),('testuser1',0000000036,'2014-04-07 10:06:05'),('testuser1',0000000037,'2014-04-07 10:03:43'),('testuser1',0000000038,'2014-04-07 09:50:31'),('testuser1',0000000039,'2014-04-08 17:26:07'),('testuser1',0000000040,'2014-04-08 17:25:10'),('testuser1',0000000041,'2014-04-08 17:24:56'),('testuser1',0000000042,'2014-04-21 20:36:39'),('testuser1',0000000043,'2014-04-21 20:12:38'),('testuser1',0000000044,'2014-04-10 15:06:09'),('testuser1',0000000045,'2014-04-23 23:52:17'),('testuser1',0000000046,'2014-04-24 00:07:56'),('testuser1',0000000047,'2014-04-24 00:22:02'),('whits91',0000000048,'2014-04-26 14:59:06');
/*!40000 ALTER TABLE `user_project` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-29 22:43:46
