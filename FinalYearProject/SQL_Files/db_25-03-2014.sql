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
  `password` varchar(255) NOT NULL COMMENT 'Password for account',
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
INSERT INTO `account` VALUES ('0y','2004-05-12 09:43:00','KA1qzokbK0spCqKzsXy85dOojpTk0lsATXyGSCC2kcIf07OZtCpWjMx6mfBrFugDBva88twMcVjxl4bwglvPsZBLevyYxCFyXA7FXLEM0bhl1eMVBn6oxvj8BmchVqAcq5H6bEF3Lyseq','oDnQIRTs8Ln7TqO71DSyB2YeaQMDD','12i5rqyGLLvjnmfF3','Jack.Arden@web.de'),('18CqFEqEz0R0PrexhIID','0000-00-00 00:00:00','y2Ol2NYJGCySho5eCwM4gIVUkgG0GZDI4AmwpU4P6C4qqd2WXksaag2uA5nfafxTx0bGhggobDF7WQlmRNqGX4YMZ2LpQubwGakbjpKUfUFxq10Tw7ukJ6KwTMZ4hvyTgonjwhZGhjsvn57mRtG0QTZDpunlLxbUnvxvub1yCdEVPvFp7IjofU5cUAPEfD12UDiH1dBuAhYXBdYNF410e3NP3XwtxhXSeJsoWdxKr6l4OB3VSN1','DkwnaHbd6E32lRxGLKQA7','GcS5ZDe28jYu','VWalker@telefonica.org'),('1vmfeOZm0lFelzJcqR','0000-00-00 00:00:00','LS4STzmn5qx8XhR17a6YcOLGAM0fTkR2yl7dB7udl3gyedOM6usoiUIYLGfzaWxeZdjrSe6VVqg4lAir1xCtXVDeDVNWQel24sP4edSzRAyiwGXdP3xo5Ok1LmetwIbnP6','hVHDbLkpTKJm4FJP5MSCyCeC0J','7mWtygrlQeu8TtMuQME','Nick.Freeman@mymail.us'),('1VwdWZQgCXC3SWhQQ4ip','2005-08-03 08:07:00','kLwCkC1knzNuY4Wyw0tgi54zJ1Kpwx3as65QeaZMGgZNhk3mR4Gh5LJRe','3jAehfsJMcY05yKGSUxl5qbxzSmKg','8qliMp','UGerschkow5@telfort.cc'),('3','2005-09-07 04:43:00','ugTtNtjlEBKSfWiBI0pMfUlceWgT61EXqJvH5Hd0eN3YaSMSqOmkf7H2BlohrGxJCO66DRAo7mRpzaRJx6SsfMDbI3xwdhwuV','C3Cd6','fDKnCwRGmZdu4i6yQRVqyUqV2pLpQ','Jakevan Goes@gawab.us'),('3tku2XTIAv','0000-00-00 00:00:00','J6pYtc8y4rDCqCdYGwjfvXccFaC5YOG0VNoeKBFauFWVJVbrUvcYWrUYtJ3b7hZsZLp7pQZSXRaHAT3sJMLNGwRoJNRVWTjr1uLL4H4ED1XdrnMettKKwHIXOBeMYiLVgdYQeIJgDT0bniPFnECvtA5cedXvXwqHHul5tHY3q','Knqc8epkI','03CvK3YnMsb8NZwXrjF3gSh','Richard.Moon@telfort.co.uk'),('4EI6iLzR38kT3Kuz','0000-00-00 00:00:00','zeVNwCkXSYUxWt2DTzfZUEZ4tE73cwztj1fa7hyPXGuSzUVibswYD','G4teooEEKTQ','w3lHkF0icLFObVfyG0Xqh','I.Brisco5@mail.cc'),('53K2','0000-00-00 00:00:00','OGz1tY17Sp55MM165BzuhItjYDfyeMUjU2hhkU5G2g4geISgO5nkoSxcsSDx6zYhFyfuzYrpKXCCn4XzXoVJXfgDPXaGngExpvglNHNkGQv7c6X','ltaGsT7','TtsK4jsfNmaaVSRukrwayTsN','Milan.Dittrich4@libero.fr'),('58iyaQdqBg','0000-00-00 00:00:00','yDMtbvBeGAYPqvWDY0sW31Uw7XAlqP5qBUjKVaKtyVRE7tvG25PyCyGXXKHiulKfuCP7Y5hOkbyarfbnIyYnXTPcXYH1ss4UydqWI5CLfIagX2G4HHVKxCOPBSLTevmcUfnHlCqmeRFOP1pQfDCfm2d13RwnvMCa6Zie','h6ooQRR7CGjXcmrveWxkA','lNlRGAas0tE7wtDXKx6B3SXfa',NULL),('5iLIeaKB0VJTneWY','2007-12-12 02:22:00','bwvp4SvXA4mmrK8WSaddkYXoJVUwKXi3YadF51ggyKawnKiCrvsaw8D7zbRdhfu3B5pbkfur0tbfBfDzOcTKXQn1CwCIXv0kyXpQRW7UQ5JEFTMsZRNOpRsHocY5UrPEgQoLNIYY2paOGYlOhUBgF4XKe4jYsBG0da43RApc4WcY1NBSMDweAGD0HpwKJCL2eIcvnM64CEdDFGlYvlqquV8TMchsxLPq1UaxnHXD','JsRJ15TL','g7pYXU3Z03JuhJ2','Hans.Pyland2@freeweb.it'),('7aZAcwLVcDr2o7VyXs','0000-00-00 00:00:00','fkOTv4WzIuxTgMJg3Smmd7zCcSZDm6kv0MyrWY0iOfwMIlvrReoIOuEZalA20CQHzrqoMEoo02P4T06YjmDZPbgQkXn5JAeiXzpkhAyLsjApqRaB6TDaZMZFFlmYWm1r2jJLUJAHgjUtKGb6JcgANIoDd6ZRxLcJV1ijVOSiHIDb4nT4rj','mZPH6MYl0kObfekjmlrpSiOq2H','8UyNfJF',NULL),('7s','0000-00-00 00:00:00','MOJbfoHy1rWyjISeo4lAOuPHuMYOmOQ6T7NanVV3fr2QVd4e8Iqy7o1aK0h7nn75C','0qIVKZo35XKZKva7EO','qkuvcDo6biR1O','DavidBright@telefonica.dk'),('811Ibs0X0HWiHKUeNRoi','0000-00-00 00:00:00','KEyboqPTtlCXXCzlPTdTKQhTN2kOnVseaQhQuPQBDya2wOgdWIAsCnalfXgmSxIrOzJhyLqrzOlexxtbbD7o0TN7wpaP88Aa051iX1BAkcDRRwZvUYJ8XTWFzbgTsXCR5OIDYFv0rwncQfJzqRvV1nxO','CkW5beFO5LKl1abPuG','jj45Zd30kbZ8LP6Is','V.Leonarda@live.gov'),('83dAlJ8','0000-00-00 00:00:00','4rmneblFY3XJP2JSXphCQ5URtFNMpDTWWIQfb5Uoc6Vkzd33fOxHZdnESq5MSvcVXrtCzTtnMFKkkRe1KFWvnXkZfUJqLS3GiBNkyhWMTzUK4XP6Ndue0VSsR21o1ykG5LFE12QdWYkGewBnjVhRY7e4PqjuBUmgCQeHLIeAW6rk0fVx5AmyPnEEb4K0JP7FlhqNPVSn4A3M7dzGMPABdFyDx7qWt1','8bdtnjJKv5P4','bM7pucxamLbPADe7263s','K.Mayberry1@gawab.nl'),('a','0000-00-00 00:00:00','W1CeRqx5iGlVSVFvv3zPQVUyHrplAgo7u6QKR','MRzQPXmVLJUVFVBZdNsRx78U','xAX','RCramer@msn.nl'),('ABLstp5fa2ID1W0JBqz8','2004-10-07 09:41:00','get71frVOIbWwFFA8btWVQlnwwsFLE7K10IbWUGLGBnMjtoOZF1O8RSlS3jCsqsg3g','7PjydB','Rm4oCNN6VXyEX',NULL),('ahfiR3ubejGkou','2005-09-08 23:45:00','EvE7ospK5Mtv6o3KqaNXtxaNaKywJCLKUON4dCBleQBTkwi8az7IVz3tf3ZE8hpUs7RWYGBtfvwwZMwAR8fV1FR11IYIRv0Y67JCDbjnZ4SlDXCh4N6bfR8DS1fyTAZsJ3U7fdChN1LeBpOZNcvrVGtcBG2dqHXuKrC4','eTp','WBjNIP43yvvZZ0D','Rick.McDaniel2@kpn.ca'),('belqr3IaQaZq4VVg','2006-03-01 08:40:00','GV1MTloNq1vof2ORrxatroYtOFxvKlKU2VRVLOLcGpnIQNORWAsgFQUNsmvbx8YlzOHE1xQQ3V0AbEuTR17KAPvlF76cVoSW','5Q5ctmfTM5Kf5V7kbma','kEy5T','RichardPetrzelka2@yahoo.cn'),('cbmhXTNYdwfakE','0000-00-00 00:00:00','zbSmgeMpMFmCJxmHkcLZRpMrswujc4xzDwhyi5Qz50mNO0jXfz5I17MHlzBOGdkrhKgEUrx4UZbGgkNSDmurvbiTzLCtA4V1WYyuIHhhkbuooAQ7QsoKARS','xY','l2FhRx3D10hMSfBoMMR7yQPgl1Aj','LHoogbandt1@telefonica.dk'),('CDmr22Ij4IBEvd3MdR','2002-07-11 03:41:00','8Ja7wmKUkOwhcRSPjAMntKA6eGFMYSbIgAAf08hY1iYVsaU4pqVGSFKynApVmqqXqHK4bsHaWSViq7HNmViv84eu5bBXUOVCDRFH7Xzd3maFfHEQnIsyRXeezf1M2gw16oQUk1f','p8cL65UH6Qd0DGCs','x7ok1o',NULL),('d','0000-00-00 00:00:00','cIprh8BvgY2vc0efBcxJmoeDrZqmewj','8','fs7U','Kim.Krutkov@gmail.no'),('D1qI25jjN','0000-00-00 00:00:00','p7cmnx582b4bspRLP3huYG4Ub6aprgn2RTKOrM5zFv1SIWZgFcVdIIPvPUq72HSM4SkKeyPLxzUYYbouR3hTzxF3mAu6ySst7j1seKqb2rX2V1y4Kt7w7td5S','SlIygQ','70joFLavvY2rP0vG01KteH1uECS',NULL),('DoEsLoht05uyk','0000-00-00 00:00:00','ctpc3NHcsUP6oxXAmEigAGGqiaiI7f1AR83sRpfHiAMz4uEuSKpofWNKlnE8pja','OrnAQAhfgZHvpAYLWkkGm5','1ZNvjmwswW4VMCOJqYxNQp2oqE',NULL),('E4K','0000-00-00 00:00:00','7DZnkuoKQctaRFfMYEysvRkaLjBrDXxBUre6FdLGlyqllOJEGsrJgJm5yJ7Cmsd2Nfpa0WgOaKGO2Uz26nwCYcj2R402gAhtFbzYop26EKcqk','o','0HC2b3wQXTod1bgRA8Q','Bill.Yinger2@mail.us'),('efGmDuOVTtCp','0000-00-00 00:00:00','vkeigkdeekSnz3vrZNp2eyPmdFteUh4ImQUFlvkfBCveydSVsfsBQSE5DcMoh71wu4gUtOR60oxmueiSCNF8htU5z4MVZ5YQTZ12JsvcPTfmRbAcR1P3258NfINttq7F60koxvlF8PjZVEeERSyRLQ0pq2y3CjGdqlxoy6Rd2UvrtXBeokcqtIwSes','u2yxjcrwiwP6OLu4','CtONraDofrptbiAnMoyG4sbLuF','NickDean@telfort.ca'),('eG','0000-00-00 00:00:00','jkiBq3DK3BvQUhtKq4oMbc6DqlSCV81sSS1FfKwzvW1OeTuKwWZMiKRNBmnwf2LYTWWAdBYsahYu6','GU3nGqzuG0cZn','FOQ1MNXPjlnsGbVsZL2gM4WP5D0N','FransHoyt5@aol.net'),('ePk7Cvaya3kZ3pz3Sf','0000-00-00 00:00:00','Ardhzr4usgh5f8L0LmVpAiTJ','lcGkmuv6xVBkHsf6qV5Y0Z','CXdBy7P','Y.Pyland@gawab.co.uk'),('EqFmfAlm4TPtKUbcYMsLMDdGK','2010-09-03 01:07:00','kTGsY8wyHWl1sBLFh65XQuhp56zSGCHzK32QoZdZl6saCTTw1FVxgdFn2KKR65GnNvYcjkPppZ34IcuFkN3xU2CHGUOmS8XJKohkpCaWopOAqX4btzHP5dk6vwmrh8LF5tHyxGG2pAFUW7YZzEnnvYbbf5fwjNbnFAjwPZnepPet2rUqGhh','7Uwzvrz10hZBQJmN','ixPeJrYo0BigfkfskJxwgQi5V5QE6','Lindsy.Zimmerman@telefonica.no'),('ezVRyvn0veiVSaB5z2','2003-12-13 00:04:00','LVjrG55wjxp1kWg3nRnqn6awZ3gDUY4wjlOf6OQkNliQbyzClQHQoK4uvLEx0nntVdnd4d3vlpHyjSZZ7juS31LxgRNXN8WcvBB6KJZdKXAU7yuLgXyQEuh3BlglN4JV83eVsenCQ6QcGfUaLshugjap3fcpzIf2UZHxVWkajYR5FTDuehPogQsnCjDm64KLX8YTFx2IvdBTmtOaSignp0wiemh5','Bl6lBFPRxGplHhr','VqUBmJulwbMHOsQ3','DickMillis4@aol.nl'),('fK6aiTt','0000-00-00 00:00:00','C0TwAXEmWgDxEfTI20P5wSwjan5hpDgCwknruv','QvSzKwpyNQYWRaf4wEFFbOk2x0hZo','V6atsxIju','RichardYoung4@mymail.be'),('FnP0V4WYSD7jkPqvu','0000-00-00 00:00:00','6Tk0bo17UrGRqOAm0NrGSFzkn4hmePQMqQPRZr8PZ7bziSxeuG','xy2mXO','37woqhm0veeQZ50Oj7RU1nY','GPerilloux@libero.fr'),('g4B370WMQXeVk','2002-03-05 00:21:00','N5i','t7Gcl3l','eeu','RRay@libero.us'),('g4J0TyhPGOOO2lDP','0000-00-00 00:00:00','b2gm8h1tXfH71o0tjgSlhrRuQ1OHXVZL2AhlIkealjcEiLKKS8AWHWCdyHAxoLB8GIenPcGyydLLz8mXYNNySnblA2eh','brsc4qEpHlAx4OvwOntIHxo4h','K1Mrq1doTw1','Bas.Shapiro@hotmail.nl'),('G5IXst4yIUtyMr35IhbVQQJ','0000-00-00 00:00:00','3VGgZDonFnRDDTyMx4drPO3K0llDjCdRUfJUoWpP2eIWsxfKrSkoQHXbF0YIX042ksy7IenWSXkBFTcK4W7bt0QGkZMkfeLLxnLCOp4gU54Meynsr0Xd34TcpN62hjXDfYhe1gzNgnqwenhA6f3VEWeNOnLLuJsl2irFvmKAsQki85MnY1EgmGKtJfzUHJdIJBxlqILPXXMj0WudwugmOYDAPYslYNqfcrqA5dRxhA73hBqFo','Xr2H','Yf5qmV1Vl7xC1','Victor.Praeger4@telfort.org'),('g7bp7bL8XhbyJDxm4f','0000-00-00 00:00:00','dIqJwaEFPWdrJKqph6GhH7CguhLcQzHU7gw3SZB5Z21RhaMHz2pA4ZCCkhbxYk5dQ7aYqJkUsB3l4OypJu2PKK3oMPFGVNBYwbSBAh8dZqitdHGIevKNwyjxG5X4oY8cs5bhWaPGBIH4XvIdqjliUFOfrjlvI4jejVznvLzEiZtHYWM0sipxDHySCXaNlGTgP5y7BK8i6aiXUCGGuqDUv7Jor2PMMxDents07Qe6qK5kofjikBM2P0Bn','byPVPJ46K5rZKnjnE','6','L.Langham@gmail.ca'),('GG8cfPrgLkIv0XrCkTGJc7wA','0000-00-00 00:00:00','eES3YCHaDsvT3qZLdlEwLgqxK8gNp8XojQe5EAK02jaHid3DkAvqVekRD','VVRy','CICX0HqKQecZMHlRMI1hC0','OliverPensec@hotmail.be'),('gztTcvg04jFKVlSy3KfNqjOP','0000-00-00 00:00:00','njrlzGJtvcz7rJQSklmJ2Bj6FXDuHE2mQir30zJ6ct8KFB78G0lseFuYZv6SfrBm1yADPMAk5V','cjke','ErU1vVlZk','RichardHamilton@live.es'),('H0','2001-09-12 04:16:00','TbJGnRQ6QXtipJss50Ywwbx3QHWTsrxI7f62fLdRSw3I7l8scKp13OfXRdMZfsYHJZXdhma8PMHYJS2G052RdPEc65KtDXFTnRtvMd8DIya3uxBwwpdd5OiBFFyFSKVo6GmXhsA2x1gGvimOYJu4tuTT5gtZV3XTndVcS6pSQEJNqApcdOiaQgps30ZHaducMZZG5Tp47bbY7xgzwYl8ZE54g2sNun','jASzBa','kxJlp4ANF',NULL),('HfZeYZvGAyI','0000-00-00 00:00:00','8XnfiymsTWyMj5l3sRDgQs6ztCDrot121IbbKmHXtGRk4hihBt05SAPrOgsj5wV5FHQdSD16PU0Q00Lxo','zNsmHBcn','l8jUFhpvz7ZCyQRk6bSkQWNFR',NULL),('HIBu7SXMrFLvduF','0000-00-00 00:00:00','uOp7QvZY','7sS0os6cUWZJrbo7aHFf','ZmWBVAJ2HerQq3','Lynn.Fernandez@libero.cc'),('HNm6URomtRyGozlcYZHRrgIwN','0000-00-00 00:00:00','kKpQJ6mYIEpVsFYnQEzqqVpxm2gJkaOiiIxdkwxZQU8MLFvtAg3L4wsc1hKaHOR8fleDu4woHnZfoZ2HA2DC5G40GHjUidGQBWlhJMbWZe6t5uFRAZ5V7HwUrZDLjKdmIHTgM8zCop8HncVDhcA8orgQfCl1EkVCO5lmYS2FjstWTHyaHAKlXCcwl2JdCPZjmEZh26d','Rbf62CVrbOLfbNkon68t7B1YoXpMx','m7oZz14M','BrentPyland@mail.be'),('hPScAu','0000-00-00 00:00:00','IzIPjRWtXSUlpeotKLoouZt2GcQ1F7drdJHetXoIVPf6foBMWDCER075WMbUCxiyiU1LA86xKU4cpNP4dHJIYb7YbH2u58voBhGsik0e5ALKOuMlguv','tSNxQIZxo16rBb77FS48E','PZblHaMfHoCDWNy','RWooten@kpn.ca'),('hRgbCzDSUxqvyUCyaWL0','0000-00-00 00:00:00','pmW6lFhVetjJdTVCoA2ZqAId0YlyMplGm3x3hXkgOs4iBujM2RUzALCiJ4P0qzkEcC4bduEmvnmJa0Ob0NOLhXXFLEauluKZhxuBm08rnkiki3CVU5LZkfmj0Ty1WCaElxr0Vve68QgDHuIujIuTHNHPbkpygkNaP8dP1dB81xHk68w1xB8QwRUf5t4QSkl6q6hxNiTyaEpShMMj2m6zPz35DrXEJiCIEvpBRuvkbgoM7Aaw7Q1jfFMI','vLOL14dJCpqlzFJmwMqH5KWYn0K','ql6UiK3rl5XlfLk','Frans.Anderson1@dolfijn.org'),('huleSnUZfi7MdHZFAr','2004-10-06 00:06:00','D8yE4bfciKv3ADP4SS02wsaCEXCizKzOA7dMCT7tpq0DatZu','Hy4NRI5Jlm2Urkvi0irk2qsBYkv0A','Q2td2etbeAW6',NULL),('hWEpxk','0000-00-00 00:00:00','HGu0QDQzcM1vb6ZEwuvSo5qwn1Wlojhrzvg7702u7OXlEF3tuxpqJVO1vymZquJ5GFZGgCSWAxn44AWE7Id1Oaf0vUYd7Cl7JWBXGzAg84NjxFoEeGj0QjnrlOtlFge4LtgjGWfkH1siNkGx60LN6b6O1mSmo6XwliUbHkln8ON3eUPXHGF001ivEpZPiej8gOXUa77k7gaVyqc5v5Hd0fTQxGhIKia4AFKcSZMHE30DH3zEY2pcG3uJnDrVS','rWZ8ZFT4NstWP','6wZnMwe6wPxwmAfE8NzAjU3Qx3jQpA','EFrega3@weboffice.fr'),('HYETRxloa8','0000-00-00 00:00:00','K0tyYsPOxPKhapHyAsAI4h2cr1m0HfYLNKZ2RmPHgVPy250gTHTvW3HQmivPhuenhuOVR7WnAg0Yy1kOjnZPOSLTlVE2PEsKtoQe7gQ0vbnDA1uZADwTgl7owkuXZUAOtLcIqoGSLyHJfq0v5WoaeEgmovxzNFgCNFW6ufsHuENgNvYwRCyz7pjVYt136dTpJRrAl','3YjqA4kovgfc7vSeGg','BwygJpW','RogierTrainor@mail.gov'),('Ia3w7iC2RaYUpUvNmgtZ','2004-05-03 09:57:00','k7vePbzU7qybP58d70fD5uvaaLrpFJM1EkJFaIsetl8YswiGRAzrJMW65hJn5h25IaORAWg5V5iYMcc03whUPZRzbg0PBPlYYOr00Vm6thUINgIt3g2RuetQV5fKVjbragnNm2Sge248Ee8E1szwfOB5K4weW71qeV7tjDIni0FWrgxgqSJ8EXo44ia7cW1XWFje4Q0R','R','K5cDRgiv3MPc3YZhdyYM','JohanCragin5@telefonica.fr'),('IC','2010-04-02 02:15:00','zpUriG2KZbRQu6UJCu','rOCvz','heLwgq8t6FPzPJIhF30p','SBitmacs@msn.nl'),('iH8LTlIAwZFoW','0000-00-00 00:00:00','HDMyTLKqbj7sOdGUschVrchWs5mTJwwPds0bBqVlKLptYPzxeCg1cPGG2HR8j8cToaRHMfbltwCHCCu3LnlEBJXDXHGC5cqYT1htB4oAkDsuSWikkC5YuzIHWnwPiIhpNIa1lz2ChWGauvf8xlphaLdsSFP0tdqRkkJKdgKR7LEYaE5ielvacBpUeGx1','t3tPuJmLpMcRaVRIMYfs6mqji7','Pr',NULL),('IJPkDaLcYspk','0000-00-00 00:00:00','N','3s71nTiOOKKANISAg','SNnEVzH3Ok5PXbZzLetcVaBBh6UrL','FransWolpert@gawab.cn'),('IYYSTCI','2002-07-08 00:40:00','rqg34R3S18Jcmhr42oon','k','SbWJWTaDVtknatqRJqOcNPqPqmf','Nick.Linhart3@freeweb.dk'),('j3LLmL2Z7qC4vfTCFSoO7PJu0','0000-00-00 00:00:00','VrI4Q5JpJ4jupmkMALQJx2rbdYJRvPhLn71knwPgfjB5BTg4WUsEkkytOkvOcANfUDEIFPgvNkjbOMWEvkQsAqmmLVUep5jotnnqt6VtSnkUEPttP6hgcbyv00AMCTxayklUW6FhxlUD5NquWakUIfcgBE86SuP3LtjAEMTunMJ5MD4VRkDIrZCSe0o','QUlLzs5gHzgpMy','0mqhdkc5vSDsWF','Freddy.Hendrix1@telfort.ca'),('james','2014-03-19 09:13:01','$2a$10$19df7f92d2f5cd65d5d7fONj2jw.yPVRIrqaJXoSwIapFhVWgzfF6','james','james',NULL),('JCmp7bNdagCi7qXsgIF','0000-00-00 00:00:00','8syvZjHXiJiQB8wR7kHHEEwRKbXQWSZ63wxy4NYpbrejCZL6S8NTU141DM0r1wBnIFgdJWnSGN5JF7dtyENSvNWt6fDUsfmdpsr4Q5BfGI4qhPsdR7QCuAQtw2nmGzncpOOqmPmcV8yIXxyTqY6kG56sZEYb2cxKtctNByfXetICXea7wC','r5rveK','vo4zA3AMnzJDQRt5QsfmmWr',NULL),('jD12WwLBwacV0SEc8d6jbNDHJ','0000-00-00 00:00:00','cSkvcYWUgYXCvVdEphQXXWoCCCOLzMzWWIob7urgiakATLVhbQfflTGmRULHzFWAEVlhBmhZmTJvW0AFPadIhejHBamhKQRdMQRU7LN4VNebq2J5ARKi4DpFSFwck7GUk1r5Un8SKcOSWse1RFGUH4qbRMyOzDakXMrEA3lIneDXOAYFSzGA1FB0CnlpFxtDTbofzLLEMLLfKD02SR3l5D8rSBRoPAzfq2PPMRFrByYr','zZLvml0gLcM1bAd7UZurt','ulNV4BPXy','NickHoyt@gawab.fr'),('jqEgXv0rWIsQnb7MEK7aCu','0000-00-00 00:00:00','wz8TavBsUT5A0rUCAjUW4jqUBg6wIszaMudOlXDOwyuxTr3ouDytB0a8uYWb1Gf0aspB06e6TQhXgZXIxmCxAUqxr2lNmQiZj3rsqVA1qJWtE5bW73bwLnUv0s5aAlIkK8X08adNvM4dy88Z7ZcsFHyXEw11kH3cxWVfqtshsFqLT0JNUNLeM','WfA0Xd5IRlgDhBkOgIV','s7FeRYoQh8BSXxZ7meERE5','Peter.Depew@excite.es'),('krKujUoz465','2005-08-12 23:17:00','lJzaXkZ8V4wmMlQ52AP8gzJvQe75BSVZH4xf5nuEAXDYLVaqT87uIEMr2PB6NNiBBlqAfKVdxWIlyH4QQulfg3odapzSqSJnsGdiJ7QUT1prdZYnSMV3az2X6T5KsmZoDQeGRzIUQuYA6FibhJ4VlXnWLW2OXS8MjJVt0jDrkzQfZ7Qi3NcTFLMXNwe6JEIFOs7juZpZtNbXSaPDEe2HkyQ6nvqhIur5chziAr','7PuPOpOippXF7mr','emZrlWPO','TCain1@mobileme.net'),('l','0000-00-00 00:00:00','rUahHttIJoTV8xA4TPhkrKqxtSQRvnvHdZ6L5oTXMVv7nYDMJUwx1mE','0xmkGEWUoqezVOTKgRvsjR1','G','William.Yinger@telfort.cn'),('LoEBnjABewXLmyYHK1','2006-10-02 06:09:00','ktiyoxbT8agZsVz8SxeL3g1eaC2JimT0WjfAPD','NlBz','4RXsVdZIY4NI',NULL),('maUT5smHETlOQSZOxVBCt','0000-00-00 00:00:00','bbLUugMFI0bjHIe376uDZAZlCOFfy8lWKwJ5dhccJXNshTtQSWQaxHoURLbo4jP54YmNMSmJ41ONQ0eS3nyu7xUXofUSIDJFEObMop8HjNA','thoG0g7EH4KlupcaY','n','William.Ayers5@kpn.fr'),('Mjdb3AgCSFN53a','0000-00-00 00:00:00','jlYVUz7s7CK0vdE4No2rHEyZQV0o6Zz6erizWyRntjIubj4bZyEKynTeoZiw2QbQnxxa0CstOlRSxevyh050gHq2dRFSx3CYOAuDuUEx','oPyP0WUJcBE5X0euTCw3FVqQZq28G6','pwqDY0AxtrsmEnHVQx6Na3I0FhswZ','R.Heyn@libero.be'),('mK','0000-00-00 00:00:00','5FCr5gSDIrDVcYWlGXIkYe5pVSo7D','w5RlkUr8206aF2yyWFtHWZ5vKVo','djI8njerUiXQTTuC63fI4In','WBeckbau2@web.no'),('MoL5ZycMfaLjzOwSAyi3vaq','2004-05-12 06:40:00','VSIK6CuqhLS4TsC3IrsJowHI4ogo2siVJLFka1ii2yV5QZC5Xkb247iWeKF1tIiyyOMqCYpmLxwVQzHVtIdHNsfb5cLj0JB1zle5wpTJWfXoLlQBN5qdQ3rtwvuBOIKafWUVxlYtFdlVgFFiMBThTbXPF3gusI3NrZ33zWDi3UZJOBQMcVFgq1OnuNb5EFuDOsylBocLCge6eXY4rVBfpJXmFVHdVxIf4rzPM4j','Ky6VH7s','o5G3lu','Dana.Ecchevarri@libero.fr'),('n5yVyrZZxjoWy','2003-08-02 00:04:00','RlOlKALMpzkLuWeqbjWwlrVMRh71izNXMZvZL8w7KDjsHCNtqvRytozQzEOLJrMvZbwSlnhoqH8p1vDCUvAtyRDXPNXBFSxvTVJUNSVw5BXeye4zj1iOPja05YBh56At7umY7CFOQYjdEQlPurlPitwqyCcon4rWUwuyDxWMmxS64wYpbHhDEZ2GH6nRPojfrNAg7tYdN1jOaiQbwr8SLEpTWWnkCr6V5nAxRyXoG0ufD0ugQym6s','VbuXpYt85husJjMMZb1eviUa','QTjxRROEbnQ1wcegW7svv',NULL),('nZm7gK3Req','0000-00-00 00:00:00','48VrAvrssinqlPgYml85qFOaXwIEGFmG3MJVl82HcoYumEJOUfqAU2STiKqQSCTH','hVn1I1yLYsIc2','j','Pierre.Anderson2@telfort.dk'),('oBNaovzJmc0mKR0EwWoBvVeO','0000-00-00 00:00:00','fSDZbqVkeXwghMlClWLDP2McxBSDZuzXRPsY64ZzePNaAB1VRZpdXvSj7L8sh2yysihNNJC5WiIzHZg5g1ZXvtNL1jaE8DrCLEZAAZ4ARC4Fpo2y6gnyWY17wZPrKFMjwJergonCnjD0WHeHSiWzcNlgENDltQZRSB6H7SD7OXkW1aAFBKKBLB3CcFHzTFX0AJCdmRhJnBWGIOaWFymaD0G04Hq8kwFcDufFTXyEQz','Tb5ur0fklvrZZEV17IRC','qKWkEtsMgDnZsU','WMeterson@myspace.gov'),('ODbEYbrgNFzEpkdCZM','2001-09-14 05:18:00','wqVzkESSpiVPYaD13tCramvMkeXCkChkSzq8zK3BiBvRxPrjHwj54fhY3GHktqb8HZJfIOtUZzoKO6Ma3LNOZIw7zmXpzhPqoc6eNPXcP5xN1qnidOa6RojDRFPHY','qYCzF','IswrOOnbqMoW8wLDSDysLx6fsVCE',NULL),('P','0000-00-00 00:00:00','oUW','stFwARr88TxEPw','kobXuqJQTDj7IGkM2ORym','Johan.Mitchell@msn.cn'),('pBM0OtMSFQ','0000-00-00 00:00:00','kr5YMu6tFvf4HQNVkzWmzFMY0M2kQq5uHoKk8FetcUzrERQN73mAzFo4RJ51CTMnxbCm7g3fSDkqb67KhqJQIWUuBydkumoulmqNslKOUKr7iDzdK1Fgcy8bkE0BC1z6sLVHb5VpxpU0sEqITZuIvdKynJeT6oYhdJ3QF2GylXAv3UvYcHvsAuyOLwMdHAGZoSGCxUuWVKr5ErxbSGsgcXKo3rzTZBlZcFZHf0evjSHN1nD8aUZtkLnfHMQZN','XtXMcbxID7fmd','4rDFRtJlxgop0CarQz8e3aybt2fbgR','IGriffith@dolfijn.gov'),('ps','0000-00-00 00:00:00','nhuEG3kkIwLo6tUatzibl70PJjaMZImv1pMLjUo4KK57Ob5Oi7EmqS1rjC','ad4roEZx0AIxgd2suRO0tDKr5WnW','h7sv1sZ4rML6e','JDelRosso5@libero.es'),('pwWcsUa4rYL3VSTYuoG','0000-00-00 00:00:00','GKqvIj','VtMkSC6S6EZ6','xz0ofNCIdVGTRDKdYCNk3V6zg',NULL),('Q','0000-00-00 00:00:00','h2','jVKzZBMCIL8Of4Bxa','8GJVRZJ8hI4kYoQl87Wpev8q','Dick.Heyn1@mobileme.dk'),('qwOPfw','0000-00-00 00:00:00','g3QMVmTwrrHPJ8oRCgHtIlNshKAb8hU46076JzCX6E5gnvO6zSQxr8u3Z4rJOWYuFJ44UasgchpOOK8kZiliZTxJhDT2YMqJ8uTtVB0UQGUMbQh1oYNT1Avgt1aKPRjT6vyLeE0Wdy4BHCSQ','aXONYq7n2yWyvrA0Qjj5BjSRt5BC','C5CyrWwBrpfr443cIvc20rgMrx6zM','LPhelps2@excite.net'),('QYPpdVoqi0','0000-00-00 00:00:00','VsuFFmTInPUxbpB6fIpirSAonZipb0dNx7uM3stE2uhe5k5TnrhCaHRimwMUp8uSERUtSQiabTC6RjlmF7gQ4nSmvwAw3qvdgzPA3s','6aSfiuKwL2dOCH3DSoD','0HmIG2dTt0fQjhBxWk','Nadine.Swaine3@excite.net'),('R6crLEoZsbHU2wNZpPe','0000-00-00 00:00:00','UYteShx4EfHZmQAfeDROm5JrLvDNYPpIhfxEirji7nQj7HVoEgJy4RdioaI01TU7M7RkPUXBPcqYVyXVcBqIfGVJ354QHQDkL1lkxyoQ6u5gNaYhnLF5KIyMJXOfXlY1nr6fm4NaflJIhBXBzmggDq0kFktnsn6nkVqXGuQ0eiFiIsV3MmXc3XwUmZeUzxcF3vmPJRK','Sz','8','Leo.Anderson3@weboffice.be'),('Rk4SU','0000-00-00 00:00:00','DgNa8hhCLUXWspf4E70qT1vuOX6dNaTu5XnQKFNZRHAbKuZlKuF1Vtr','f0PvQfWa4o','0m3z3o56mJ2M5EWBvB4','Bianca.Seibel3@mail.it'),('RXry7WrwWssqiuZ','0000-00-00 00:00:00','WswcQZM8pJwiNqcyAEKLDXt022UEh8KDQYLY5QP3i5Ys7FKFiTROELMAyF2dDqGorxpWKR5c2uz2Qt4ns3Au8GYj46r1Gr0XRsgY3IFBcP6JyICdvWtnLMMWTgnmcZ0isRS3M85blkfWEPu6SCLlhgtgVcDtg4g4yGKD63PLEUslK','KGkIuEvU6vLAHmAFO6TyLYBtN','bip','Ann.Guyer@gmail.it'),('RYNPgbK','0000-00-00 00:00:00','H5xPd11t7emzB617uYv7TBfHjYzfwNM10FImwmKKCGSn4vl4xCSAl1ivGecm2RfNXvN4oM1rtbU1ksfxSd6uyKwtHMit7XE6uPp32Crkru6FHtODYQ3N3W80iGHcRASnXOwZOva2A4JFgK8uLVRHLGlonQuTw1ErZdWbhobJouS5UL6BrkspcmOFIlTMOmSKfo7vqoaNMoUSRGGHYGtzTaSWjS5','Uen3WLDVZBjVWXz0mryEavHN','3Y423PBGE5y188ckyDbbM06tv','RKepler@mail.no'),('s4uufkZLsVyMG75U2','2006-04-07 04:19:00','ViNu06EovgjNDtEsNyF6np6H0BQXNMrYnBDcA3BUXM0RsSLkzt32ftKcfgQw0ZojVMyA1Vn3MW3ERVLPHr7jsjkT8QYQhmOePDa5eNsv0','HYdz3LiQMbGBqgXAL','vf6zyivn3TQSfDIC6KIIP',NULL),('Skuf1TIzUAEYRi2olIWb','0000-00-00 00:00:00','LNORozLnXRgkwAuPNQ6kkwBfQK1Vry','2EJGeQCNuNxPrGnoPPunZ1dcKC1An','7qIZEWROpd08','E.Aldritch@freeweb.be'),('SUVT5PPNKTePPmf','0000-00-00 00:00:00','4B3qnay4UDIrb','ZyWsCXInHHe5MKnPE6E0Ib4IevLao','PK4T2rKrm8DvVAXVGvOm4TjGUy43F','Vincent.Browne@myspace.us'),('taX2seGxrbpDuOd','2011-10-09 04:19:00','DrW4TCgfm07u4aTSOK7WhRa3BeLbxgKKbdr2jFNM15QSBJ6VL','mkzrVAoxBnz071CZjfF','KlNV','Johan.Pearlman2@myspace.dk'),('testuser1','2014-03-19 09:34:28','$2a$10$9b130962e8deb9f088b05uMCGg1fxtiWQV5gL6n3E0jL7rdWKatDe','test','yser1',NULL),('testuser10','2014-03-21 17:07:59','$2a$10$ae52d29d69e1033cbf197ePrVn599ajMzGJNViZ3TwBBD6kSUJ.DG','james','test','james@aston.ac,uk'),('testuser2','2014-03-19 09:36:09','$2a$10$7509c2f9f20794e6b6bdeu2MiKOQ0sWetxs4ni8e3wLGxi/s8P4f6','test','user2',NULL),('testuser3','2014-03-19 09:37:24','$2a$10$799e33fe650ddaba71619u6ZHT539Ic59.q5O60s5sVsglO5LfVLC','test','user3',NULL),('testuser5','2014-03-21 08:33:52','$2a$10$90021503b943a6579a371OJeeJMRoo8ouIBw1OhoD1Wdh/PlJL1bC','test','user','testuser5@email.com'),('tfLKnM14','2003-04-09 04:54:00','m7Fux5xknkVcEUh8UKuhzKEcGTS0ooUfEYhOiNXdShVhpBTgPDwLuJTc2SNTK0v6oJW2qSujhiXnstPaK7Smc3df7esgmMDdGTUQ5tEVkRrRgvyFTzpHgtOK2JVRM0Y7nSktBnamkorskJbzS6RWBvB0lZVC4Det0Qejvf0uRyovV8AG014hemWrYIxKrM5aHwFuhGmoZIK1YaAegXls','kgqEGO67uZZGfQdqj7sO3aJ','yrIBw83HUfCLMGjNwZuJR','Jim.Crocetti@dolfijn.com'),('ToO5LbdXYcSZuV2z','0000-00-00 00:00:00','uz8q28DkB0h0bOfSnMOC4tRYt7uJCoDzqFVn5q8fxrmhNNUiwfrTXrCMToMyh27teuoutZU0rNBVfV3Id3erSGDbasjUOtBFEdPbkIMn0Xxb2zQJXEiMWuwnjWe0CimDdwhlwwVHCR6ke8wTg6RsK1hNdz4kMlMV2u32aeDpeDLp3dQw162khK7aPsVnJSqw1PNruL06o0NtSydRDOKfmDiFfEIhdNFxs','3','ATn0KNmEkILgibN87','Brend.Beckbau2@web.us'),('tZdI3bsT0tXNorDU','0000-00-00 00:00:00','4ualIgSGcSr8WUliOCmhciEH7Rl8u8v6EpreZhfMcG6oxTTIF33Pf7fZC2LfRt6VmjvW0SK0XG4sVRPnrcT7q6abIFLiaA5MIKx8eSzhqukaM3OdgJ746UT8ix8R83yhR30DynKXMiPoIAWhQG1mNt2fFpbuVBy6FnP1leeEcEYpyXpOCim5wBW8F4wVIQSSl1NLSW0D4PthLqO6ayUYR2KT3aablxkGUpSJYRg0xTcOXxUqbLMHZcLs','7xLoEFxjfJMr0G8S4Ls','iNr8lHR3t5VfifHjogP','BasWong@dolfijn.com'),('u','2006-03-03 02:26:00','fGL4X5wiHVyEZJCRpeoUU7JFhy7P4XKxkvPeIldNkMefifowqap4LfBaqs06','MjP0Sen','Kuejg4J586tQstS1pY8nZ8','H.Clark4@myspace.fr'),('UHJd31Xw2UJTQxCU6Vu','2005-01-02 10:22:00','NQyYHd5r6GxdhfPPTgbrOUoVz8Pe1cDW8CvNwTMyTe1zJUosEimKgZzmebjZ54Ycfuhjr8hTMzDapbTOyx0YxhXrOuPaGAhh5TRIEqgQiamC8bfvyYRdXbnkuguixZr8LZx0','cucaYus5oDivyIwj2QwI7QWDG0','zzArJgE',NULL),('v0S2','0000-00-00 00:00:00','hYOVRGWV6qioGsrzJ','s','fvM4HcLjO20HFY46GAIJT','FransAnthony@excite.es'),('v8qg6qho2','2008-02-08 04:38:00','EflsdU77ztpJgyHrLWpt8B7JBL0KR2PoBfT8lO','uzMMEycvfWhDuwIrvidYunqEHmcHFg','Vm7oNQ4','Nick.Ratliff@hotmail.de'),('Vi0xGIAvfXX','0000-00-00 00:00:00','0eFM2oCk6aetyWZqkhRPuz46y2uoNYlZYntstyjhUHuoqKE1TOfdQo6US2VN5HZws1eJZVYeLnSgEJNNCWHCHeRgSPlaaGlEBb8efnpkEsKAY6c6nSp62MjTixxuenmLE1ExMBGLzmpxSj46MK6Xoy81BesQYy2yTkue0Z','hP7kEKJLfZW','DbuyttuL1qoNTnA','BasMayberry@lycos.fr'),('VWyIIyj','0000-00-00 00:00:00','sfDivH3wDebVIWoCdxkXRlQaYDf5LvvxKYEtPHEUR7GVCWI4NwwDfJIffXmJJyprOHMcCsLaxaRWJ67PVDvHxArhfYOWfGQ4dw5BFSwRt4U7NWpkgHx0r46gXr1ku1cZ5CueQ3InNCuNHRfIeIu1ufaAb1gEuURfC6NzMSmzeHaDNHKB1n6rLIRd1BsTtPBeYbLAo1Fic0xdNLTYahcYGOSmje1rVqG0JCUPtvyuK2VDjQ28i','0qdYiw4qiei1BhHAsS5nIezHWuLGP','JpswogRhnOcI3xvXIf','Sjorsvan der Laar3@dolfijn.be'),('w7Vg3luoKYB4MhROJ4Nlcf67i','0000-00-00 00:00:00','we78zgSnjeZKAqApax6hvSyPo6TnW5iSJn6qNCY6SDhsGFuNaaMzg6RDRNR1iEsW1nAekwLcl8tslJNEMbNyJoO2j4LqdzBmJSsIfTvtfTvmjFGYJEB1U85yUkJtney3P4Kos08PrzWfVPmMUhlpIQI3rZqe7CwBaDZHZCEkdRLJFsCCm3WSPWX8m8QSJfRnWhYsTtuI1NVSyJzoF2yoEok44Y0oNFhRPL24qAAJwwbW33UpMrFMrD','hHGcLs3wh','j','R.Ionescu@libero.it'),('wqbo1IVvMVCs2OBxq','0000-00-00 00:00:00','3gNtJo274oe','Nw1JtBkDo4hcUddyKmrC4C2r6Uqp','6SrWtTGg7WWNDkcHWJ','Trees.Cappello@web.fr'),('xdqPh7nTV','2007-01-05 05:48:00','zxB2ZO5xl7WDRqRH8md6NG7Vpk7NmQOcVNMOCZdPRLKoklByRREodc7UtBVOCezywSERvfkZ2agRJIAbFYz3t1gKucv4N45wHirnDcnS7QjG8t0kPNJ1C2vbNXfR0EP0XtFkGPu76Oo','8CQ8DrsMKo','USJeIHAlXRT1','Pauline.Daniel1@mobileme.fr'),('XPH4','2006-09-02 05:16:00','sk2tgTb6uoqGt41X1c3k4JmSM6PVaqFxN2JaDnvrt730sXxgtbJ1WAAxEdJCmUWIuUKvlx0oyZflveIHMrbEMWSrvUCdMyHmEjYgWdAKr7yUZlVjTNS7t6iqiGCLiChOSQjU','4HgJrCN8','fGFRSTuBdvepVHbkriTZCj',NULL),('xyXojKGREuLoSdn','0000-00-00 00:00:00','YbUjjY22Lnq67umeaoLFlUCO2ZJPAsStqcasFasGXBCbxhycUzfObNgePjuwD','i','AtpecCU2yrCWjtxOPmNMbiNiDjMlDX','VBernstein@yahoo.es'),('YALFdo','0000-00-00 00:00:00','ZlFUHw3nE2GAOkhPS87mUEzyjGn08KVDF1sroWwwZcy0s7zrLaSHhJnF0jiYNj4nMDdbHQ7z5v47EMC6TFcZCRc2tc2s0i','baO4UB','fRT4xHW7RmCZa','T.Bertelson@gmail.cn'),('z','2012-07-11 06:45:00','64re5u83wRThlnMD4kxg5rOhVLTcur5xmEsPA','5KxOCiwz','AGZtGBGwzLL1t8FrGO','Annvan Dijk3@lycos.be'),('z04K7','0000-00-00 00:00:00','E5DSpJXyv0WSeTpt4Fruuh1DHBwB0nv0pnBEKe5AUdMwsSVMGsyCqMJqqRduv2sBFnldj8xsv5hU4hw02OYoy44M7jIHFVMSCq0mpeMjavW3QlLvaAqTlshAx6IVk5XxnvSGQUT3Lzucd8mVogHpnuOEW6IopEekbKtQ8ST3vjVU70hVnY6zMw0cyhV0cNn6DcaaQlpL2d5ALBqfSYLo3','kM','bWOhNdtwGfkpn5AGL2i','Hank.Hardoon@aol.org'),('zxFJ','2007-11-10 02:55:00','LGCsYh1','YtSk4J2ULFLNJRzu4HCk3zc','ZHvLrzzE1Nj3nsfURhAJeu','H.Scheffold@gawab.fr'),('ZZVUzf3NLkaWPgTZaMgXW','0000-00-00 00:00:00','36nLN','vA2I0kIIyHccsA7Q','SfTPnoTqU2uBOC6t8q8cQ','FransHarness4@telefonica.co.uk');
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
-- Table structure for table `archived_project`
--

DROP TABLE IF EXISTS `archived_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `archived_project` (
  `proj_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Project ID to provide a unique reference to each project',
  `proj_nm` varchar(30) DEFAULT NULL COMMENT 'Name of project',
  `proj_descr` varchar(200) DEFAULT NULL COMMENT 'Description of the project i.e. website URL etc',
  `archive_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Timestamp to identify date of deletion',
  PRIMARY KEY (`proj_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Table to store project data ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archived_project`
--

LOCK TABLES `archived_project` WRITE;
/*!40000 ALTER TABLE `archived_project` DISABLE KEYS */;
/*!40000 ALTER TABLE `archived_project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dependency`
--

DROP TABLE IF EXISTS `dependency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dependency` (
  `DEPENDENCY_ID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Identify each corresponding dependency',
  `DEPENDENT_ON` int(10) unsigned zerofill DEFAULT NULL COMMENT 'Represents a task id the task requires before start',
  PRIMARY KEY (`DEPENDENCY_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8 COMMENT='Represent dependencies between tasks';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dependency`
--

LOCK TABLES `dependency` WRITE;
/*!40000 ALTER TABLE `dependency` DISABLE KEYS */;
INSERT INTO `dependency` VALUES (0000000001,0000000001),(0000000002,0000000015),(0000000003,0000055069),(0000000004,0000673063),(0000000005,0000339884),(0000000006,0000252669),(0000000007,0000587839),(0000000008,NULL),(0000000009,0000121813),(0000000010,0000357400),(0000000011,0000551314),(0000000012,0000862590),(0000000013,0000665722),(0000000014,0000163576),(0000000015,0000315688),(0000000016,0000182407),(0000000017,0000946487),(0000000018,0000902035),(0000000019,0000408748),(0000000020,0000509561),(0000000021,0000414692),(0000000022,NULL),(0000000023,0000720823),(0000000024,0000277710),(0000000025,0000946314),(0000000026,NULL),(0000000027,0000081526),(0000000028,0000333395),(0000000029,0000731860),(0000000030,0000922353),(0000000031,0000545274),(0000000032,0000100082),(0000000033,0000184206),(0000000034,0000384031),(0000000035,0000498458),(0000000036,NULL),(0000000037,0000353311),(0000000038,0000207817),(0000000039,0000613849),(0000000040,0000167326),(0000000041,0000029815),(0000000042,0000205776),(0000000043,NULL),(0000000044,0000252487),(0000000045,0000944567),(0000000046,0000783484),(0000000047,0000114810),(0000000048,NULL),(0000000049,0000856054),(0000000050,0000753447),(0000000051,NULL),(0000000052,0000228440),(0000000053,0000127838),(0000000054,0000665608),(0000000055,0000913195),(0000000056,0000246719),(0000000057,NULL),(0000000058,0000765884),(0000000059,0000936806),(0000000060,0000175261),(0000000061,NULL),(0000000062,0000780806),(0000000063,0000897892),(0000000064,NULL),(0000000065,0000681627),(0000000066,0000366707),(0000000067,0000006912),(0000000068,0000675945),(0000000069,0000849686),(0000000070,0000631073),(0000000071,0000118448),(0000000072,NULL),(0000000073,0000679712),(0000000074,0000908177),(0000000075,0000538087),(0000000076,0000334530),(0000000077,0000758461),(0000000078,0000550658),(0000000079,0000530131),(0000000080,0000534555),(0000000081,0000443076),(0000000082,NULL),(0000000083,0000532311),(0000000084,0000193430),(0000000085,0000968477),(0000000086,0000620792),(0000000087,NULL),(0000000088,0000986930),(0000000089,0000887513),(0000000090,0000763289),(0000000091,0000248077),(0000000092,NULL),(0000000093,NULL),(0000000094,0000144248),(0000000095,0000673618),(0000000096,0000828994),(0000000097,0000317233),(0000000098,0000023870),(0000000099,0000313494),(0000000100,0000832286),(0000000101,0000895588),(0000000102,0000282657);
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
  PRIMARY KEY (`EST_ID`),
  UNIQUE KEY `TSK_ID` (`EST_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estimation`
--

LOCK TABLES `estimation` WRITE;
/*!40000 ALTER TABLE `estimation` DISABLE KEYS */;
INSERT INTO `estimation` VALUES (0000000001,5,5,'2014-06-06','2014-03-11','2014-07-06'),(0000000002,NULL,NULL,'2014-06-06','2014-07-30','2014-07-06'),(0000000005,NULL,10,'2014-06-06','2014-10-09','2014-11-10'),(0000000006,95,90,'2014-06-06','2014-07-06','2014-07-06');
/*!40000 ALTER TABLE `estimation` ENABLE KEYS */;
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
INSERT INTO `project` VALUES (0000000001,'testproject 1','this project is the first project with everything set up accordingly...'),(0000000002,'testproject2','this project does that'),(0000000003,'projecttest1','projecttest1 description');
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
  UNIQUE KEY `proj_id` (`proj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This table provides the link between projects and their estimation';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_estimation`
--

LOCK TABLES `project_estimation` WRITE;
/*!40000 ALTER TABLE `project_estimation` DISABLE KEYS */;
INSERT INTO `project_estimation` VALUES (0000000001,0000000005),(0000000002,0000000006);
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
  PRIMARY KEY (`STAFF_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Store STAFF information';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (0000000001,'Ian','Nabney','0738392','ITN@aston.ac.uk'),(0000000002,'staff','memmber','018124r320975','staff@aston.ac.uk');
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
INSERT INTO `staff_task` VALUES (0000000001,0000000001),(0000000015,0000000002),(0000000001,0000000002);
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
  `DEPENDENCY_ID` int(10) unsigned zerofill NOT NULL COMMENT 'Dependency Identifier',
  `TSK_ID` int(10) unsigned zerofill NOT NULL COMMENT 'Store task identifier',
  PRIMARY KEY (`TSK_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table to hold information pertaining to the relationships between tasks';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_dependency`
--

LOCK TABLES `task_dependency` WRITE;
/*!40000 ALTER TABLE `task_dependency` DISABLE KEYS */;
INSERT INTO `task_dependency` VALUES (0000000002,0000000001),(0000000001,0000000015);
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

-- Dump completed on 2014-03-25 18:54:13
