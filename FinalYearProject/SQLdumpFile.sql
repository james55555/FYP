-- MySQL dump 10.13  Distrib 5.6.12, for Win32 (x86)
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
-- Current Database: `fyp`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `fyp` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `fyp`;

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
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estimation`
--

DROP TABLE IF EXISTS `estimation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estimation` (
  `TSK_ID` int(10) unsigned zerofill NOT NULL COMMENT 'Task ID to reference TSK_ID in TASK',
  `ACT_HR` int(4) unsigned DEFAULT NULL COMMENT 'Represents actual hours assigned to the project',
  `PLN_HR` int(4) unsigned DEFAULT NULL COMMENT 'Represents planned hours assigned to project',
  `START_DT` date NOT NULL DEFAULT '2014-06-06' COMMENT 'Represent the start date of the task',
  `ACT_END_DT` date DEFAULT '2014-07-06' COMMENT 'Represent the actual estimated end date',
  `EST_END_DT` date NOT NULL DEFAULT '2014-07-06' COMMENT 'Represent the estimated end date of the task',
  UNIQUE KEY `TSK_ID` (`TSK_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estimation`
--

LOCK TABLES `estimation` WRITE;
/*!40000 ALTER TABLE `estimation` DISABLE KEYS */;
/*!40000 ALTER TABLE `estimation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `acc_id` int(10) unsigned zerofill NOT NULL COMMENT 'Account ID to associate user with project',
  `proj_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Project ID to provide a unique reference to each project',
  `proj_nm` varchar(30) DEFAULT NULL COMMENT 'Name of project',
  `proj_owner_id` int(10) unsigned zerofill DEFAULT NULL COMMENT 'Staff ID located in STAFF table',
  `proj_descr` varchar(200) DEFAULT NULL COMMENT 'Description of the project i.e. website URL etc',
  `proj_dpnd` int(10) unsigned zerofill DEFAULT NULL COMMENT 'Reference other projects this project id is dependent on',
  PRIMARY KEY (`proj_id`),
  KEY `acc_id` (`acc_id`,`proj_owner_id`,`proj_dpnd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table to store project data ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Store STAFF information';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `STATUS_ID` int(2) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Status identifier',
  `STATUS_CD` enum('NS','IP','FN') NOT NULL DEFAULT 'NS' COMMENT 'Status code',
  `STATUS_DESCR` enum('Not Started','In Progress','Finished') NOT NULL DEFAULT 'Not Started' COMMENT 'Status description',
  PRIMARY KEY (`STATUS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Static table to hold status information';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
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
  `STATUS_ID` int(2) unsigned zerofill NOT NULL DEFAULT '01' COMMENT 'Idntify the status of the task',
  `TASK_NM` varchar(30) NOT NULL COMMENT 'Name of the task',
  `WEB_ADDR` varchar(60) DEFAULT NULL COMMENT 'Any email address associated with the task',
  `TSK_DESCR` varchar(200) DEFAULT NULL COMMENT 'Description of the task',
  PRIMARY KEY (`TSK_ID`),
  KEY `PROJ_ID` (`PROJ_ID`,`STATUS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table to store all task data';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `fyp`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `fyp` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `fyp`;

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
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estimation`
--

DROP TABLE IF EXISTS `estimation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estimation` (
  `TSK_ID` int(10) unsigned zerofill NOT NULL COMMENT 'Task ID to reference TSK_ID in TASK',
  `ACT_HR` int(4) unsigned DEFAULT NULL COMMENT 'Represents actual hours assigned to the project',
  `PLN_HR` int(4) unsigned DEFAULT NULL COMMENT 'Represents planned hours assigned to project',
  `START_DT` date NOT NULL DEFAULT '2014-06-06' COMMENT 'Represent the start date of the task',
  `ACT_END_DT` date DEFAULT '2014-07-06' COMMENT 'Represent the actual estimated end date',
  `EST_END_DT` date NOT NULL DEFAULT '2014-07-06' COMMENT 'Represent the estimated end date of the task',
  UNIQUE KEY `TSK_ID` (`TSK_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estimation`
--

LOCK TABLES `estimation` WRITE;
/*!40000 ALTER TABLE `estimation` DISABLE KEYS */;
/*!40000 ALTER TABLE `estimation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `acc_id` int(10) unsigned zerofill NOT NULL COMMENT 'Account ID to associate user with project',
  `proj_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Project ID to provide a unique reference to each project',
  `proj_nm` varchar(30) DEFAULT NULL COMMENT 'Name of project',
  `proj_owner_id` int(10) unsigned zerofill DEFAULT NULL COMMENT 'Staff ID located in STAFF table',
  `proj_descr` varchar(200) DEFAULT NULL COMMENT 'Description of the project i.e. website URL etc',
  `proj_dpnd` int(10) unsigned zerofill DEFAULT NULL COMMENT 'Reference other projects this project id is dependent on',
  PRIMARY KEY (`proj_id`),
  KEY `acc_id` (`acc_id`,`proj_owner_id`,`proj_dpnd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table to store project data ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Store STAFF information';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `STATUS_ID` int(2) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Status identifier',
  `STATUS_CD` enum('NS','IP','FN') NOT NULL DEFAULT 'NS' COMMENT 'Status code',
  `STATUS_DESCR` enum('Not Started','In Progress','Finished') NOT NULL DEFAULT 'Not Started' COMMENT 'Status description',
  PRIMARY KEY (`STATUS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Static table to hold status information';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
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
  `STATUS_ID` int(2) unsigned zerofill NOT NULL DEFAULT '01' COMMENT 'Idntify the status of the task',
  `TASK_NM` varchar(30) NOT NULL COMMENT 'Name of the task',
  `WEB_ADDR` varchar(60) DEFAULT NULL COMMENT 'Any email address associated with the task',
  `TSK_DESCR` varchar(200) DEFAULT NULL COMMENT 'Description of the task',
  PRIMARY KEY (`TSK_ID`),
  KEY `PROJ_ID` (`PROJ_ID`,`STATUS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table to store all task data';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-02-07 17:12:16
