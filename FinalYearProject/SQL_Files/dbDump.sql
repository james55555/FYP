-- MySQL dump 10.13  Distrib 5.6.12, for Win64 (x86_64)
--
-- Host: localhost    Database: fyp
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
  `password` varchar(25) NOT NULL COMMENT 'Password for account',
  `first_nm` varchar(30) NOT NULL COMMENT 'First name of the user',
  `last_nm` varchar(30) NOT NULL COMMENT 'Last name of the user',
  `email_addr` varchar(50) DEFAULT NULL COMMENT 'Email address of the user',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Store system user data';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES ('','2014-03-18 14:47:51','','','',NULL),('testuser1','2014-02-13 12:56:15','testuser1','test1','user','testuser1@aston'),('testuser2','2014-03-02 18:06:51','testuser2','test','user2','testuse2@hotmail.com'),('testuser3','2014-03-06 22:26:29','testuser3','testuser3','testuser3','testuser1@asda');
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `convertToMySQLNull` BEFORE INSERT ON `account` FOR EACH ROW BEGIN
SET NEW.`email_addr`=NULLIF(NEW.`email_addr`,"NULL");
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

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
  PRIMARY KEY (`EST_ID`),
  UNIQUE KEY `TSK_ID` (`EST_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estimation`
--

LOCK TABLES `estimation` WRITE;
/*!40000 ALTER TABLE `estimation` DISABLE KEYS */;
INSERT INTO `estimation` VALUES (0000000001,NULL,NULL,'2014-06-06',NULL,'2014-07-06'),(0000000002,NULL,NULL,'2014-06-06','2014-07-30','2014-07-06');
/*!40000 ALTER TABLE `estimation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proect_estimation`
--

DROP TABLE IF EXISTS `proect_estimation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proect_estimation` (
  `proj_id` int(10) unsigned zerofill NOT NULL COMMENT 'this provides the link to each project',
  `est_id` int(10) unsigned zerofill NOT NULL COMMENT 'this provides the link to each estimation',
  UNIQUE KEY `proj_id` (`proj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This table provides the link between projects and their estimation';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proect_estimation`
--

LOCK TABLES `proect_estimation` WRITE;
/*!40000 ALTER TABLE `proect_estimation` DISABLE KEYS */;
/*!40000 ALTER TABLE `proect_estimation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `proj_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Project ID to provide a unique reference to each project',
  `proj_nm` varchar(30) DEFAULT NULL COMMENT 'Name of project',
  `proj_descr` varchar(200) DEFAULT NULL COMMENT 'Description of the project i.e. website URL etc',
  PRIMARY KEY (`proj_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Table to store project data ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (0000000001,'testproject1','this project does this'),(0000000002,'testproject2','this project does that'),(0000000003,'projecttest1','projecttest1 description');
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
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
  PRIMARY KEY (`STAFF_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Store STAFF information';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (0000000001,'Ian','Nabney','0738392','ITN@aston.ac.uk'),(0000000002,'Ian','Nabney','0738392','ITN@aston.ac.uk');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
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
  `STAFF_ID` int(10) unsigned zerofill NOT NULL COMMENT 'Field to store staff id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table to provide join between staff member and task';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_task`
--

LOCK TABLES `staff_task` WRITE;
/*!40000 ALTER TABLE `staff_task` DISABLE KEYS */;
INSERT INTO `staff_task` VALUES (0000000001,0000000001);
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
  PRIMARY KEY (`TSK_ID`),
  KEY `PROJ_ID` (`PROJ_ID`,`STATUS`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='Table to store all task data';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (0000000001,0000000001,'Not Started','testtask1',NULL,'this task does this'),(0000000015,0000000001,'In Progress','testTask3','www.task.com',NULL);
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_dependency`
--

DROP TABLE IF EXISTS `task_dependency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_dependency` (
  `TSK_ID` int(10) unsigned zerofill NOT NULL COMMENT 'Store task identifier',
  `DEPENDCY_ID` int(10) unsigned zerofill NOT NULL COMMENT 'Store task id that TSK_ID is dependent on ',
  `START` char(2) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Y' COMMENT 'Identify whether or this task can be started before its dependency',
  PRIMARY KEY (`TSK_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table to hold information pertaining to the relationships between tasks';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_dependency`
--

LOCK TABLES `task_dependency` WRITE;
/*!40000 ALTER TABLE `task_dependency` DISABLE KEYS */;
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
  UNIQUE KEY `tsk_id` (`tsk_id`,`est_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This table provides the link between TASK and ESTIMATION';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_estimation`
--

LOCK TABLES `task_estimation` WRITE;
/*!40000 ALTER TABLE `task_estimation` DISABLE KEYS */;
INSERT INTO `task_estimation` VALUES (0000000001,0000000001),(0000000015,0000000002);
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
  PRIMARY KEY (`proj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table to hold associations between users and their projects';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_project`
--

LOCK TABLES `user_project` WRITE;
/*!40000 ALTER TABLE `user_project` DISABLE KEYS */;
INSERT INTO `user_project` VALUES ('testuser1',0000000001),('testuser2',0000000002),('testuser1',0000000003);
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

-- Dump completed on 2014-03-19  8:08:51
