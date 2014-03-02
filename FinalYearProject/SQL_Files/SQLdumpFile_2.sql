
-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 27, 2014 at 01:59 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fyp`
--
CREATE DATABASE IF NOT EXISTS `fyp` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `fyp`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `user_id` varchar(25) NOT NULL,
  `acc_create_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Timestamp for creation of the account',
  `password` varchar(25) NOT NULL COMMENT 'Password for account',
  `first_nm` varchar(30) NOT NULL COMMENT 'First name of the user',
  `last_nm` varchar(30) NOT NULL COMMENT 'Last name of the user',
  `email_addr` varchar(50) DEFAULT NULL COMMENT 'Email address of the user',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Store system user data';

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`user_id`, `acc_create_ts`, `password`, `first_nm`, `last_nm`, `email_addr`) VALUES
('testuser1', '2014-02-13 12:56:15', 'testuser1', 'test1', 'user', 'testuser1@aston');

-- --------------------------------------------------------

--
-- Table structure for table `estimation`
--

CREATE TABLE IF NOT EXISTS `estimation` (
  `TSK_ID` int(10) unsigned zerofill NOT NULL COMMENT 'Task ID to reference TSK_ID in TASK',
  `ACT_HR` int(4) unsigned DEFAULT NULL COMMENT 'Represents actual hours assigned to the project',
  `PLN_HR` int(4) unsigned DEFAULT NULL COMMENT 'Represents planned hours assigned to project',
  `START_DT` date NOT NULL DEFAULT '2014-06-06' COMMENT 'Represent the start date of the task',
  `ACT_END_DT` date DEFAULT '2014-07-06' COMMENT 'Represent the actual estimated end date',
  `EST_END_DT` date NOT NULL DEFAULT '2014-07-06' COMMENT 'Represent the estimated end date of the task',
  UNIQUE KEY `TSK_ID` (`TSK_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `acc_id` int(10) unsigned zerofill NOT NULL COMMENT 'Account ID to associate user with project',
  `proj_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Project ID to provide a unique reference to each project',
  `proj_nm` varchar(30) DEFAULT NULL COMMENT 'Name of project',
  `proj_descr` varchar(200) DEFAULT NULL COMMENT 'Description of the project i.e. website URL etc',
  `proj_dpnd` int(10) unsigned zerofill DEFAULT NULL COMMENT 'Reference other projects this project id is dependent on',
  PRIMARY KEY (`proj_id`),
  KEY `acc_id` (`acc_id`,`proj_dpnd`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table to store project data ' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`acc_id`, `proj_id`, `proj_nm`, `proj_descr`, `proj_dpnd`) VALUES
(0000000001, 0000000001, 'testproject1', 'this project does this', NULL),
(0000000002, 0000000002, 'testproject2', 'this project does that', 0000000001);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `STAFF_ID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Hold the identifier of the staff identifier',
  `STAFF_FIRST_NM` varchar(30) NOT NULL COMMENT 'Hold the first name of the staff member',
  `STAFF_LAST_NM` varchar(30) NOT NULL COMMENT 'Hold the last name of the staff member',
  `STAFF_PHONE` varchar(32) DEFAULT NULL COMMENT 'Hold the staff members telephone number (after PHP validation)',
  `STAFF_EMAIL` varchar(50) DEFAULT NULL COMMENT 'Hold the staff members email address',
  PRIMARY KEY (`STAFF_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Store STAFF information' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`STAFF_ID`, `STAFF_FIRST_NM`, `STAFF_LAST_NM`, `STAFF_PHONE`, `STAFF_EMAIL`) VALUES
(0000000001, 'Ian', 'Nabney', '0738392', 'ITN@aston.ac.uk'),
(0000000002, 'Ian', 'Nabney', '0738392', 'ITN@aston.ac.uk');

--
-- Triggers `staff`
--
DROP TRIGGER IF EXISTS `Add_After_Staff_Insert`;
DELIMITER //
CREATE TRIGGER `Add_After_Staff_Insert` AFTER INSERT ON `staff`
 FOR EACH ROW insert into staff_task
values(staff.staff_id, null)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `staff_task`
--

CREATE TABLE IF NOT EXISTS `staff_task` (
  `TSK_ID` int(10) unsigned zerofill NOT NULL COMMENT 'Field to store task id',
  `STAFF_ID` int(10) unsigned zerofill NOT NULL COMMENT 'Field to store staff id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table to provide join between staff member and task';

--
-- Dumping data for table `staff_task`
--

INSERT INTO `staff_task` (`TSK_ID`, `STAFF_ID`) VALUES
(0000000001, 0000000001);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `TSK_ID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Task identifier',
  `PROJ_ID` int(10) unsigned zerofill NOT NULL COMMENT 'Identify associated project',
  `STATUS` enum('Not Started','In Progress','Finished') NOT NULL DEFAULT 'Not Started' COMMENT 'Display task status',
  `TASK_NM` varchar(30) NOT NULL COMMENT 'Name of the task',
  `WEB_ADDR` varchar(60) DEFAULT NULL COMMENT 'Any email address associated with the task',
  `TSK_DESCR` varchar(200) DEFAULT NULL COMMENT 'Description of the task',
  PRIMARY KEY (`TSK_ID`),
  KEY `PROJ_ID` (`PROJ_ID`,`STATUS`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table to store all task data' AUTO_INCREMENT=16 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`TSK_ID`, `PROJ_ID`, `STATUS`, `TASK_NM`, `WEB_ADDR`, `TSK_DESCR`) VALUES
(0000000001, 0000000001, 'Not Started', 'testtask1', NULL, 'this task does this'),
(0000000015, 0000000001, 'In Progress', 'testTask3', 'www.task.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task_dependency`
--

CREATE TABLE IF NOT EXISTS `task_dependency` (
  `TSK_ID` int(10) unsigned zerofill NOT NULL COMMENT 'Store task identifier',
  `DEPENDCY_ID` int(10) unsigned zerofill NOT NULL COMMENT 'Store task id that TSK_ID is dependent on ',
  `START` char(2) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Y' COMMENT 'Identify whether or this task can be started before its dependency',
  PRIMARY KEY (`TSK_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table to hold information pertaining to the relationships between tasks';

-- --------------------------------------------------------

--
-- Table structure for table `user_project`
--

CREATE TABLE IF NOT EXISTS `user_project` (
  `user_id` varchar(50) NOT NULL COMMENT 'Field to store user id',
  `proj_id` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`proj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table to hold associations between users and their projects';

--
-- Dumping data for table `user_project`
--

INSERT INTO `user_project` (`user_id`, `proj_id`) VALUES
('0002', 0000000001),
('0001', 0000000002);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
