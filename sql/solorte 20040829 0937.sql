SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT;
SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS;
SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION;
SET NAMES utf8;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=NO_AUTO_VALUE_ON_ZERO */;


CREATE DATABASE /*!32312 IF NOT EXISTS*/ `ClientInfoDB`;
USE `ClientInfoDB`;

DROP TABLE IF EXISTS `AccessLogTBL`;
CREATE TABLE `AccessLogTBL` (
  `DateTimeStamp` datetime NOT NULL default '0000-00-00 00:00:00',
  `UserID` bigint(20) unsigned default NULL,
  `TypeID` char(1) NOT NULL default '',
  `MEDPAL` bigint(20) unsigned default NULL,
  `Module` varchar(50) default NULL,
  `Activity` varchar(255) default NULL,
  `Result` varchar(255) default NULL,
  PRIMARY KEY  (`DateTimeStamp`),
  KEY `indexUserID` (`UserID`),
  KEY `indexMEDPAL` (`MEDPAL`)
) TYPE=MyISAM;
INSERT INTO `AccessLogTBL` (`DateTimeStamp`,`UserID`,`TypeID`,`MEDPAL`,`Module`,`Activity`,`Result`) VALUES ('2004-03-10 22:13:40',1,'M',6,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-04-03 17:51:11',9,'M',9,'UAmedinsure.php','Dental Insurance Information Added.','Ok'),('2004-03-11 13:06:22',1,'M',0,'hyslogoff.php','Login','Ok'),('2004-03-11 13:13:46',1,'M',8,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-11 13:15:31',1,'M',7,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-04-03 17:47:41',9,'M',9,'UAmedinsure.php','Medical Insurance Information Added.','Ok'),('2004-04-03 17:24:45',9,'M',9,'UAappt.php','Appointment successfully Added','Ok'),('2004-03-11 14:30:01',1,'M',0,'hyslogoff.php','Login','Ok'),('2004-04-03 17:14:20',9,'',9,'login.php','Login','Ok'),('2004-04-03 17:11:20',9,'',9,'login.php','Login','Ok'),('2004-04-03 17:09:51',9,'',9,'login.php','Login','Ok'),('2004-04-03 17:07:55',9,'',9,'login.php','Login','Ok'),('2004-04-03 17:07:06',9,'',9,'login.php','Login','Ok');
INSERT INTO `AccessLogTBL` (`DateTimeStamp`,`UserID`,`TypeID`,`MEDPAL`,`Module`,`Activity`,`Result`) VALUES ('2004-04-03 16:48:31',9,'',9,'login.php','Login','Ok'),('2004-04-03 16:47:58',1,'C',9,'setmedpal.php','Choose Medpal from list','Ok'),('2004-04-03 11:32:37',12,'M',12,'setmedpal.php','Choose Medpal from list','Ok'),('2004-03-12 10:32:45',1,'C',8,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-12 10:32:58',2,'C',2,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-12 10:42:32',1,'C',5,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-12 10:42:38',1,'C',3,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-04-02 14:41:02',1,'C',8,'setmedpal.php','Choose Medpal from list','Ok'),('2004-03-31 17:24:47',12,'M',14,'UAmedemrgcont.php','Secondary Emergency Medical Contact Information Added','Ok'),('2004-03-31 17:23:42',12,'M',14,'UAmedemrgcont.php','Primary Emergency Medical Contact Information Added','Ok'),('2004-03-31 17:22:39',12,'M',14,'UArules.php','Client Rules Updated.','Ok');
INSERT INTO `AccessLogTBL` (`DateTimeStamp`,`UserID`,`TypeID`,`MEDPAL`,`Module`,`Activity`,`Result`) VALUES ('2004-03-31 17:21:37',12,'M',14,'UAnameaddrName.php','Client Name Information update.','Ok'),('2004-03-31 17:21:02',12,'M',14,'UAmedprofExternal.php','External Medical Information update.','Ok'),('2004-03-31 17:20:30',12,'M',14,'UAmedinsure.php','Dental Insurance Information Added.','Ok'),('2004-03-31 17:19:51',12,'M',14,'UAmedinsure.php','Medical Insurance Information Added.','Ok'),('2004-03-14 19:58:10',1,'M',6,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-14 19:58:15',1,'M',6,'hyslogoff.php','Logoff','Ok'),('2004-03-31 17:18:33',12,'M',14,'setmedpal.php','Choose Medpal from list','Ok'),('2004-03-31 17:16:05',12,'M',13,'setmedpal.php','Choose Medpal from list','Ok'),('2004-03-31 17:13:24',12,'M',12,'UAmedemrgcont.php','Secondary Emergency Medical Contact Information Added','Ok'),('2004-03-31 17:12:08',12,'M',12,'UAmedemrgcont.php','Primary Emergency Medical Contact Information Added','Ok'),('2004-03-31 17:10:50',12,'M',12,'UArules.php','Client Rules Updated.','Ok');
INSERT INTO `AccessLogTBL` (`DateTimeStamp`,`UserID`,`TypeID`,`MEDPAL`,`Module`,`Activity`,`Result`) VALUES ('2004-03-31 17:09:07',12,'M',12,'UAnameaddrName.php','Client Name Information update.','Ok'),('2004-03-14 23:10:14',1,'M',8,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-14 23:11:10',1,'M',8,'hyslogoff.php','Logoff','Ok'),('2004-03-14 23:11:53',1,'C',7,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-31 17:08:29',12,'M',12,'UAmedprofExternal.php','External Medical Information update.','Ok'),('2004-03-31 17:07:10',12,'M',12,'UAmedinsure.php','Dental Insurance Information Added.','Ok'),('2004-03-31 17:06:00',12,'M',12,'UAmedinsure.php','Medical Insurance Information update.','Ok'),('2004-03-17 13:25:09',1,'M',7,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-17 13:31:05',1,'M',7,'hyslogoff.php','Logoff','Ok'),('2004-03-31 17:05:06',12,'M',12,'UAappt.php','Appointment successfully Added','Ok'),('2004-03-17 15:23:52',1,'M',7,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO `AccessLogTBL` (`DateTimeStamp`,`UserID`,`TypeID`,`MEDPAL`,`Module`,`Activity`,`Result`) VALUES ('2004-03-17 15:23:59',1,'M',6,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-17 15:24:53',1,'M',8,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-17 15:25:05',1,'M',8,'hyslogoff.php','Logoff','Ok'),('2004-03-31 17:00:56',12,'M',12,'setmedpal.php','Choose Medpal from list','Ok'),('2004-03-19 16:40:06',1,'C',2,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-19 16:52:53',1,'C',2,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-19 17:54:22',9,'C',9,'UAnameaddrPhoto.php','Client Photo Information Added.','Ok'),('2004-03-19 18:11:30',2,'C',2,'UAnameaddrPhoto.php','Client Photo Information update.','Ok'),('2004-03-19 18:14:26',2,'C',2,'UAnameaddrPhoto.php','Client Photo Information update.','Ok'),('2004-03-19 18:19:26',2,'',2,'login.php','Login','Ok'),('2004-03-19 18:21:41',2,'M',2,'hyslogoff.php','Logoff','Ok'),('2004-03-19 18:21:52',9,'',9,'login.php','Login','Ok');
INSERT INTO `AccessLogTBL` (`DateTimeStamp`,`UserID`,`TypeID`,`MEDPAL`,`Module`,`Activity`,`Result`) VALUES ('2004-03-19 18:22:02',9,'M',9,'hyslogoff.php','Logoff','Ok'),('2004-03-19 18:22:18',10,'',10,'login.php','Login','Ok'),('2004-03-19 18:22:44',10,'M',10,'UAnameaddrPhoto.php','Client Photo Information Added.','Ok'),('2004-03-19 18:23:57',10,'M',10,'hyslogoff.php','Logoff','Ok'),('2004-03-19 18:24:22',11,'',11,'login.php','Login','Ok'),('2004-03-19 18:25:01',11,'M',11,'hyslogoff.php','Logoff','Ok'),('2004-03-19 18:25:27',12,'',12,'login.php','Login','Ok'),('2004-03-19 18:25:35',12,'M',12,'hyslogoff.php','Logoff','Ok'),('2004-03-20 00:06:40',12,'',12,'login.php','Login','Ok'),('2004-03-31 11:49:33',1,'M',7,'setmedpal.php','Choose Medpal from list','Ok'),('2004-03-20 10:45:24',1,'C',12,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-20 11:48:18',1,'M',0,'hyslogoff.php','Logoff','Ok'),('2004-03-30 19:57:25',11,'M',11,'hyslogoff.php','Logoff','Ok'),('2004-03-30 19:57:21',11,'',11,'login.php','Login','Ok'),('2004-03-30 18:57:16',11,'M',11,'hyslogoff.php','Logoff','Ok');
INSERT INTO `AccessLogTBL` (`DateTimeStamp`,`UserID`,`TypeID`,`MEDPAL`,`Module`,`Activity`,`Result`) VALUES ('2004-03-30 18:57:05',11,'M',11,'UAnameaddrName.php','Client Name Information update.','Ok'),('2004-03-20 14:12:30',10,'',10,'login.php','Login','Ok'),('2004-03-20 14:14:02',10,'M',10,'hyslogoff.php','Logoff','Ok'),('2004-03-30 18:54:18',11,'',11,'login.php','Login','Ok'),('2004-03-30 17:51:21',12,'M',12,'setmedpal.php','Choose Medpal from list','Ok'),('2004-03-30 16:39:40',2,'M',2,'hyslogoff.php','Logoff','Ok'),('2004-03-30 16:37:30',2,'M',2,'UApresc.php','Client Prescription Information Deleted.','Ok'),('2004-03-30 16:35:53',2,'',2,'login.php','Login','Ok'),('2004-03-20 16:20:19',10,'',10,'login.php','Login','Ok'),('2004-03-21 12:36:27',12,'',12,'login.php','Login','Ok'),('2004-03-21 12:40:05',12,'M',12,'UAmedinsure.php','Medical Insurance Information Added.','Ok'),('2004-03-30 12:17:35',1,'M',6,'hyslogoff.php','Logoff','Ok'),('2004-03-21 12:46:38',12,'',12,'login.php','Login','Ok'),('2004-03-30 12:17:21',1,'M',6,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO `AccessLogTBL` (`DateTimeStamp`,`UserID`,`TypeID`,`MEDPAL`,`Module`,`Activity`,`Result`) VALUES ('2004-03-21 16:36:16',13,'',13,'login.php','Login','Ok'),('2004-03-21 16:36:57',13,'M',13,'hyslogoff.php','Logoff','Ok'),('2004-03-21 16:37:08',13,'',13,'login.php','Login','Ok'),('2004-03-21 16:37:28',13,'M',13,'hyslogoff.php','Logoff','Ok'),('2004-03-21 16:37:39',14,'',14,'login.php','Login','Ok'),('2004-03-21 16:37:49',14,'M',14,'hyslogoff.php','Logoff','Ok'),('2004-03-21 16:37:59',14,'',14,'login.php','Login','Ok'),('2004-03-21 16:38:49',14,'M',14,'hyslogoff.php','Logoff','Ok'),('2004-03-21 16:39:21',12,'M',13,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-21 16:40:48',12,'M',13,'hyslogoff.php','Logoff','Ok'),('2004-03-30 10:30:07',1,'C',12,'setmedpal.php','Choose Medpal from list','Ok'),('2004-03-21 21:12:22',12,'M',13,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-21 21:26:07',12,'M',13,'UAmedinsure.php','Medical Insurance Information Added.','Ok'),('2004-03-21 21:45:11',12,'M',12,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO `AccessLogTBL` (`DateTimeStamp`,`UserID`,`TypeID`,`MEDPAL`,`Module`,`Activity`,`Result`) VALUES ('2004-03-22 12:18:21',1,'M',6,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-22 12:18:40',1,'M',8,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-22 12:19:05',1,'M',8,'hyslogoff.php','Logoff','Ok'),('2004-03-22 13:23:08',1,'M',7,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-22 13:23:24',1,'M',8,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-22 13:24:18',1,'M',6,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-22 13:24:25',1,'M',6,'hyslogoff.php','Logoff','Ok'),('2004-03-22 13:28:23',1,'C',12,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-22 13:30:19',1,'C',12,'UAnameaddrPhoto.php','Client Photo Information Added.','Ok'),('2004-03-22 13:30:50',14,'C',14,'UAnameaddrPhoto.php','Client Photo Information Added.','Ok'),('2004-03-22 13:31:15',13,'C',13,'UAnameaddrPhoto.php','Client Photo Information Added.','Ok');
INSERT INTO `AccessLogTBL` (`DateTimeStamp`,`UserID`,`TypeID`,`MEDPAL`,`Module`,`Activity`,`Result`) VALUES ('2004-03-22 13:31:35',13,'',13,'login.php','Login','Ok'),('2004-03-22 13:33:44',13,'M',13,'hyslogoff.php','Logoff','Ok'),('2004-03-22 13:33:57',14,'',14,'login.php','Login','Ok'),('2004-03-22 13:34:23',14,'M',14,'hyslogoff.php','Logoff','Ok'),('2004-03-22 13:34:55',12,'M',12,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-22 13:35:06',12,'M',13,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-22 13:35:12',12,'M',14,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-22 13:35:19',12,'M',14,'hyslogoff.php','Logoff','Ok'),('2004-03-22 13:42:27',14,'',14,'login.php','Login','Ok'),('2004-03-22 13:48:37',14,'M',14,'hyslogoff.php','Logoff','Ok'),('2004-03-22 13:48:54',2,'',2,'login.php','Login','Ok'),('2004-03-22 13:50:42',2,'M',2,'hyslogoff.php','Logoff','Ok'),('2004-03-22 13:52:48',12,'M',13,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-22 13:52:56',12,'M',12,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO `AccessLogTBL` (`DateTimeStamp`,`UserID`,`TypeID`,`MEDPAL`,`Module`,`Activity`,`Result`) VALUES ('2004-03-22 13:56:03',12,'M',12,'hyslogoff.php','Logoff','Ok'),('2004-03-22 13:57:06',1,'C',9,'setmedpal.php','Choose Medpal to Work with from access list','Ok'),('2004-03-30 10:25:15',1,'M',0,'hyslogoff.php','Logoff','Ok'),('2004-04-03 18:05:45',9,'M',9,'UAmedprofExternal.php','External Medical Information update.','Ok'),('2004-04-03 18:15:23',9,'M',9,'UAnameaddrName.php','Client Name Information update.','Ok'),('2004-04-03 21:11:31',2,'',2,'login.php','Login','Ok'),('2004-04-03 21:13:42',2,'M',2,'hyslogoff.php','Logoff','Ok'),('2004-04-03 23:46:32',9,'',9,'login.php','Login','Ok'),('2004-04-03 23:52:45',9,'',9,'login.php','Login','Ok'),('2004-04-04 00:22:42',9,'M',9,'UAappt.php','Appointment successfully Added','Ok'),('2004-04-04 00:37:21',9,'M',9,'UApresc.php','Client Prescription Information Added.','Ok'),('2004-04-04 00:51:00',9,'M',9,'UApresc.php','Client Prescription Information Added.','Ok'),('2004-04-04 00:56:14',9,'M',9,'UAmedinsure.php','Medical Insurance Information update.','Ok');
INSERT INTO `AccessLogTBL` (`DateTimeStamp`,`UserID`,`TypeID`,`MEDPAL`,`Module`,`Activity`,`Result`) VALUES ('2004-04-04 00:57:00',9,'M',9,'UAmedinsure.php','Medical Insurance Information update.','Ok'),('2004-04-04 01:04:02',9,'M',9,'UAmedinsure.php','Medical Insurance Information update.','Ok'),('2004-04-04 01:10:28',9,'M',9,'UAmedinsure.php','Dental Insurance Information update.','Ok'),('2004-04-04 01:11:20',9,'M',9,'UAmedinsure.php','Dental Insurance Information update.','Ok'),('2004-04-04 01:12:21',9,'M',9,'UAmedprofExternal.php','External Medical Information update.','Ok'),('2004-04-04 01:14:14',9,'M',9,'UAmedprofExternal.php','External Medical Information update.','Ok'),('2004-04-04 01:19:13',9,'M',9,'UAmedprofExternal.php','External Medical Information update.','Ok'),('2004-04-04 01:32:53',9,'M',9,'UAnameaddrName.php','Client Name Information update.','Ok'),('2004-04-04 01:35:12',9,'M',9,'UAnameaddrAddr.php','Address Information Added.','Ok'),('2004-04-04 01:38:16',9,'M',9,'UAnameaddrAddr.php','Address Information Added.','Ok'),('2004-04-04 01:39:56',9,'M',9,'UAnameaddrAddr.php','Address Information Added.','Ok');
INSERT INTO `AccessLogTBL` (`DateTimeStamp`,`UserID`,`TypeID`,`MEDPAL`,`Module`,`Activity`,`Result`) VALUES ('2004-04-04 01:41:03',9,'M',9,'UAnameaddrAddr.php','Address Information Added.','Ok'),('2004-04-04 01:41:50',9,'M',9,'UAnameaddrAddr.php','Address Information Added.','Ok'),('2004-04-04 11:54:25',9,'',9,'login.php','Login','Ok'),('2004-04-04 12:43:30',1,'C',9,'setmedpal.php','Choose Medpal from list','Ok'),('2004-04-04 13:03:37',1,'C',9,'setmedpal.php','Choose Medpal from list','Ok'),('2004-04-04 16:18:46',9,'',9,'login.php','Login','Ok'),('2004-04-04 22:51:00',1,'M',8,'setmedpal.php','Choose Medpal from list','Ok'),('2004-04-04 23:01:54',1,'C',9,'setmedpal.php','Choose Medpal from list','Ok'),('2004-04-04 23:02:25',1,'C',13,'setmedpal.php','Choose Medpal from list','Ok'),('2004-04-04 23:08:19',1,'C',13,'UAappt.php','Appointment successfully Added','Ok'),('2004-04-05 11:06:06',1,'C',9,'setmedpal.php','Choose Medpal from list','Ok'),('2004-04-05 16:19:04',1,'C',12,'setmedpal.php','Choose Medpal from list','Ok'),('2004-04-05 16:23:59',1,'C',12,'UAmedinsure.php','Medical Insurance Information update.','Ok');
INSERT INTO `AccessLogTBL` (`DateTimeStamp`,`UserID`,`TypeID`,`MEDPAL`,`Module`,`Activity`,`Result`) VALUES ('2004-04-05 16:25:47',14,'C',14,'setmedpal.php','Choose Medpal from list','Ok'),('2004-04-05 16:26:15',14,'C',13,'setmedpal.php','Choose Medpal from list','Ok'),('2004-04-05 16:32:40',1,'C',14,'setmedpal.php','Choose Medpal from list','Ok'),('2004-04-05 20:27:16',1,'C',6,'setmedpal.php','Choose Medpal from list','Ok'),('2004-04-10 19:31:20',1,'C',13,'setmedpal.php','Choose Medpal from list','Ok'),('2004-04-26 20:35:17',1,'M',8,'setmedpal.php','Choose Medpal from list','Ok'),('2004-04-29 20:26:20',1,'C',6,'setmedpal.php','Choose Medpal from list','Ok'),('2004-05-02 12:41:14',1,'C',1,'UAmedhist.php','Medical Event successfully Updated.','Ok'),('2004-05-02 11:27:34',1,'C',1,'setmedpal.php','Choose Medpal from list','Ok'),('2004-05-01 22:21:42',1,'C',1,'accesslogdelete.php','Client Logs Deleted.','Ok'),('2004-05-02 21:25:11',1,'C',1,'setmedpal.php','Choose Medpal from list','Ok'),('2004-05-03 08:21:45',1,'C',1,'setmedpal.php','Choose Medpal from list','Ok'),('2004-05-03 09:18:34',1,'C',1,'UAmedproffamhist.php','Family History Information update.','Ok');
INSERT INTO `AccessLogTBL` (`DateTimeStamp`,`UserID`,`TypeID`,`MEDPAL`,`Module`,`Activity`,`Result`) VALUES ('2004-05-03 09:20:41',1,'C',1,'UAmedproffamhist.php','Family History Information update.','Ok'),('2004-05-03 09:40:22',1,'C',1,'UAmedproffamhist.php','Family History Information update.','Ok'),('2004-05-03 09:44:33',1,'C',1,'UAmedproffamhist.php','Family History Information update.','Ok'),('2004-05-03 09:50:40',1,'C',1,'UAmedproffamhist.php','Family History Information update.','Ok'),('2004-05-03 09:51:26',1,'C',1,'UAmedproffamhist.php','Family History Information update.','Ok'),('2004-05-03 11:35:57',1,'C',12,'setmedpal.php','Choose Medpal from list','Ok'),('2004-05-03 11:41:58',1,'C',12,'UAnameaddrPhoto.php','Client Photo Information update.','Ok'),('2004-05-04 21:51:47',1,'C',1,'setmedpal.php','Choose Medpal from list','Ok'),('2004-05-10 14:52:57',1,'C',1,'setmedpal.php','Choose Medpal from list','Ok'),('2004-05-14 12:04:20',1,'C',1,'setmedpal.php','Choose Medpal from list','Ok'),('2004-05-28 09:55:44',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO `AccessLogTBL` (`DateTimeStamp`,`UserID`,`TypeID`,`MEDPAL`,`Module`,`Activity`,`Result`) VALUES ('2004-05-28 10:40:06',1,'M',1,'hyslogoff.php','Logoff','Ok'),('2004-05-28 10:41:45',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok'),('2004-05-28 10:54:22',1,'M',1,'hyslogoff.php','Logoff','Ok'),('2004-05-28 10:54:32',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok'),('2004-05-28 10:57:38',1,'M',1,'hyslogoff.php','Logoff','Ok'),('2004-05-28 10:59:47',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok'),('2004-05-28 11:05:10',1,'M',1,'hyslogoff.php','Logoff','Ok'),('2004-05-28 11:05:25',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok'),('2004-05-28 11:05:43',1,'M',1,'hyslogoff.php','Logoff','Ok'),('2004-05-28 11:05:53',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok'),('2004-05-28 12:56:51',1,'M',1,'hyslogoff.php','Logoff','Ok'),('2004-05-28 12:57:07',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok'),('2004-05-28 13:05:38',1,'M',1,'hyslogoff.php','Logoff','Ok'),('2004-05-28 13:06:14',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO `AccessLogTBL` (`DateTimeStamp`,`UserID`,`TypeID`,`MEDPAL`,`Module`,`Activity`,`Result`) VALUES ('2004-05-28 13:09:39',1,'M',1,'hyslogoff.php','Logoff','Ok'),('2004-08-21 13:41:11',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok'),('2004-08-21 15:01:55',1,'M',1,'hyslogoff.php','Logoff','Ok'),('2004-08-21 15:04:17',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok'),('2004-08-21 15:07:04',1,'M',1,'hyslogoff.php','Logoff','Ok'),('2004-08-21 15:07:44',1,'C',1,'setmedpal.php','Choose Medpal from list','Ok'),('2004-08-21 16:07:03',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok'),('2004-08-21 16:19:17',1,'M',1,'hyslogoff.php','Logoff','Ok'),('2004-08-21 16:20:30',1,'C',1,'setmedpal.php','Choose Medpal from list','Ok'),('2004-08-28 19:07:24',1,'C',1,'setmedpal.php','Choose Medpal from list','Ok'),('2004-08-29 08:27:10',1,'C',1,'setmedpal.php','Choose Medpal from list','Ok'),('2004-08-29 08:29:54',1,'C',1,'setmedpal.php','Choose Medpal from list','Ok');

DROP TABLE IF EXISTS `AddrTBL`;
CREATE TABLE `AddrTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `OrderID` int(10) unsigned default NULL,
  `AddrLine1` varchar(255) default NULL,
  `AddrLine2` varchar(255) default NULL,
  `City` varchar(45) default NULL,
  `State` char(2) default NULL,
  `ZIP` varchar(10) default NULL,
  `PhoneNbr` varchar(15) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `AddrTBL` (`ID`,`OrderID`,`AddrLine1`,`AddrLine2`,`City`,`State`,`ZIP`,`PhoneNbr`) VALUES (22,1,'12 Nichols Rd','','Reading','MA','01867','781-942-1982'),(2,1,'27 Colwell Ave.','','Brighton','MA','02135','617-783-7130'),(3,1,'1 Prarie Way',NULL,'Durango','CO','98772','635-938-7403'),(4,1,'23 Peach Pie Lane','Suite 32','Atlanta','GA','92882','874-737-8733'),(5,1,'16 Loredo Drive','','Ocean City','CA','01922','735-748-6640'),(6,1,'85 Herrick St','suite 99','Beverly','MA','01928','978-922-3000'),(7,1,'86 Herrick St',NULL,'Beverly','MA','01928','978-944-3826'),(8,1,'25 Haven St','','Reading','MA','01928','781-944-2816'),(9,1,'32 Rodeo Dr',NULL,'Durango','CO','01928','668-287-8383'),(10,1,'45 Colfax Ave','Suite 33','Denver','CO','01928','765-983-7378'),(11,1,'2 Peach Tree Way','suite 123','Atlanta','GA','01928','772-762-7264'),(12,1,'33 Orchard Circle','2nd Floor','Newton','MA','01928','888-999-1234'),(13,1,'17 Newbury Ave',NULL,'Boston','MA','01928','923-222-2398'),(14,1,'23  Health St','Suite 23','Chicago','IL','01928','800-123-8887'),(15,1,'5 Comerce Way',NULL,'Lexington','KY','01928','827-222-2938');
INSERT INTO `AddrTBL` (`ID`,`OrderID`,`AddrLine1`,`AddrLine2`,`City`,`State`,`ZIP`,`PhoneNbr`) VALUES (16,1,'12 Haven St','','Reading','MA','01928','781-942-8792'),(17,1,'32 Win St','','Reno','NV','01928','876-938-3927'),(18,1,'88 Oak St','','Atlanta','GA','01928','871-928-2972'),(19,2,'21 Woody end Lane','','Chilmark','MA','01928','508-232-1099'),(20,3,'55 Bungalo way','Suite 44','Fort Lauderdale','FL','01928','888-222-9999'),(23,1,'12 Maple Lane','','Bedford','NY','01928','777-333-1234'),(24,1,'12 Nichols Rd','','Reading','MA','01867','781-999-1234'),(27,1,'23 Channel St','Suite 22','Woburn','MA','01928','781-459-4400'),(28,1,'13 Wilson Ave','Suite 23','Cambridge','MA','01928','888-123-4567'),(29,1,'23 Willow Brook Lane','Suite 32','Hobolton','NJ','918827','800-456-4785'),(30,1,'15 Richmond Ave','','Charston','SC','05224','800-560-4000'),(31,1,'12 Nichols Rd','','Reading','MA','01867','781-942-1982'),(32,1,'12 Nichols Rd','','Reading','MA','01867','781-942-1982'),(33,1,'12 Nichols Rd','','Reading','MA','01867','781-942-1982'),(34,1,'35 Beach St','','Cardiff','CA','09187','782-999-9876');
INSERT INTO `AddrTBL` (`ID`,`OrderID`,`AddrLine1`,`AddrLine2`,`City`,`State`,`ZIP`,`PhoneNbr`) VALUES (35,1,'12 Elm St','suite 33','Woburn','MA','01866','888-777-6666'),(36,1,'23 Park Ave','Suite 32','New York','NY','91881','999-888-7777'),(37,1,'3 Amherst Rd','','Andover','MA','01867','978-474-4074'),(38,1,'8 Richard RD','','Marblehead','MA','01945','781-631-7942'),(39,1,'A Road','','SomeCity','MA','99999','508-785-9057'),(40,1,'3006 Bersano Court','','Pleasanton','CA','94566','925-600-0502'),(41,1,'4725 First St','','Pleasanton','CA','94566','925-462-7060'),(42,1,'5565 W Las Positas Blvd','','Pleasanton','CA','94566','925-73-0404'),(43,1,'1262 Concannon Blvd','','Livermore','CA','94550','925-447-9300'),(44,1,'4224 Stanley Blvd','','Pleasanton','CA','94566','925-846-3357'),(45,1,'5565 W. Las Positas Blvd','','Pleasanton','CA','94566','925-460-8484'),(46,1,'1262 Concannon Blvd','','Livermore','CA','94550','925-447-9300'),(47,1,'3006 Bersano Court','','Pleasanton','CA','94566','925-600-0502'),(48,1,'3006 Bersano Court','','Pleasanton','CA','94566','925-600-0502');
INSERT INTO `AddrTBL` (`ID`,`OrderID`,`AddrLine1`,`AddrLine2`,`City`,`State`,`ZIP`,`PhoneNbr`) VALUES (49,1,'3006 Bersano Court','','Pleasanton','CA','94566','510-508-0808'),(50,1,'506 St John Circle','','Pleasanton','CA','94566','925-846-7856'),(51,1,'3006 Bersano Court','','Pleasanton','CA','(4566','925-600-0502'),(52,1,'708St. John Circle','','Pleasanton','CA','94566','925-846-7856'),(53,0,'','fffff','','','',''),(54,0,'22 Robinson Court','','Andover','xx','',''),(55,0,'22 Robinson Court','','Andover','ma','xxxxx',''),(56,0,'22 Robinson Court','','Andover','ma','01845','xxxxx'),(57,0,'22 Robinson Court','','Andover','ma','01845','978-444-5555'),(58,1,'5420 Sunol Boulevard','','Pleasanton','CA','94566','800-999-9999'),(59,1,'P.O. Box 11111','','Ft. Scott','KA','66701','800-ONE-8081'),(999,1,'Unknown','','Unknown','XX','99999','Unknown');

DROP TABLE IF EXISTS `AdminAuthTBL`;
CREATE TABLE `AdminAuthTBL` (
  `ID` bigint(20) unsigned NOT NULL default '0',
  `Pword` tinyblob,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `AdminAuthTBL` (`ID`,`Pword`) VALUES (1,0x6A616E657463);

DROP TABLE IF EXISTS `AuthTypeTBL`;
CREATE TABLE `AuthTypeTBL` (
  `ID` char(1) NOT NULL default '',
  `AuthType` varchar(45) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `AuthTypeTBL` (`ID`,`AuthType`) VALUES ('C','CustomerService'),('M','Client'),('U','User'),('D','Provider'),('P','Pharmacy'),('E','Emergency');

DROP TABLE IF EXISTS `AuthenticationTBL`;
CREATE TABLE `AuthenticationTBL` (
  `USERID` bigint(20) NOT NULL default '0',
  `TypeID` char(1) NOT NULL default 'M',
  `Pword` tinyblob,
  PRIMARY KEY  (`USERID`,`TypeID`),
  KEY `indexUSERID` (`USERID`),
  KEY `indexTypeID` (`TypeID`)
) TYPE=MyISAM;
INSERT INTO `AuthenticationTBL` (`USERID`,`TypeID`,`Pword`) VALUES (1,'M',0x66726F646F),(2,'M',0x39353939),(3,'M',0x64756465),(4,'M',0x646F776E),(5,'M',0x737572666572),(6,'M',0x77696C6C69616D),(7,'M',0x62726964676574),(8,'M',0x6A616E6574),(1,'D',0x72696368617264),(6,'D',0x67656F726765),(1,'P',0x62726F6F6B73),(1,'U',0x6D616E6F72),(1,'C',0x6A616E657463),(2,'U',0x67656F726765),(3,'P',0x637673),(9,'M',0x32363530),(10,'M',0x37333839),(11,'M',0x36303931),(12,'M',0x36303336),(13,'M',0x63616C6C6965),(14,'M',0x6A757374696E),(2,'C',0x6672616E636573);

DROP TABLE IF EXISTS `AuthorizationLevelTypeTBL`;
CREATE TABLE `AuthorizationLevelTypeTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `Level` varchar(50) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `AuthorizationLevelTypeTBL` (`ID`,`Level`) VALUES (1,'Unrestricted'),(2,'Read All'),(3,'Restricted'),(4,'Exclude');

DROP TABLE IF EXISTS `AuthorizationTBL`;
CREATE TABLE `AuthorizationTBL` (
  `USERID` bigint(20) unsigned NOT NULL default '0',
  `TypeID` char(1) NOT NULL default 'M',
  `MEDPAL` bigint(20) unsigned NOT NULL default '0',
  `Level` int(10) unsigned zerofill default NULL,
  `RelationsID` int(10) unsigned default NULL,
  PRIMARY KEY  (`USERID`,`TypeID`,`MEDPAL`),
  KEY `indexUSERID` (`USERID`),
  KEY `indexTypeID` (`TypeID`),
  KEY `indexMedpal` (`MEDPAL`)
) TYPE=MyISAM;
INSERT INTO `AuthorizationTBL` (`USERID`,`TypeID`,`MEDPAL`,`Level`,`RelationsID`) VALUES (1,'M',1,0000000001,1),(2,'M',2,0000000001,2),(3,'M',3,0000000001,3),(4,'M',4,0000000001,4),(5,'M',5,0000000001,1),(1,'M',6,0000000002,1),(6,'M',6,0000000001,1),(7,'M',7,0000000003,1),(1,'M',7,0000000003,1),(8,'M',8,0000000001,1),(8,'M',1,0000000001,2),(7,'M',8,0000000004,1),(1,'M',8,0000000001,1),(6,'M',8,0000000003,1),(3,'M',5,0000000003,1),(2,'U',1,0000000002,4),(9,'M',9,0000000001,NULL),(10,'M',10,0000000001,NULL),(11,'M',11,0000000001,NULL),(12,'M',12,0000000001,NULL),(13,'M',13,0000000003,0),(14,'M',14,0000000003,0),(12,'M',13,0000000001,1),(12,'M',14,0000000001,1);

DROP TABLE IF EXISTS `BrowserTypeTBL`;
CREATE TABLE `BrowserTypeTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `BrowserType` varchar(50) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `BrowserTypeTBL` (`ID`,`BrowserType`) VALUES (1,'Microsoft IE 4.0'),(2,'Microsoft IE 5.0'),(3,'Microsoft IE 5.5'),(4,'Microsoft IE 6.0'),(5,'Netscape 4.0'),(6,'Netscape 4.5'),(7,'Netscape 6.0'),(8,'Netscape 7.0'),(9,'Mosaic 3.0'),(10,'Opera 3.0'),(11,'Opera 3.5'),(12,'Opera 4.0'),(13,'Opera 5.0'),(14,'Opera 6.0'),(15,'Opera 7.0'),(16,'Mozilla'),(17,'AOL'),(18,'Other'),(19,'Safari');

DROP TABLE IF EXISTS `CalendarAppTypeTBL`;
CREATE TABLE `CalendarAppTypeTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `Description` varchar(45) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `CalendarAppTypeTBL` (`ID`,`Description`) VALUES (1,'Medical'),(3,'Event'),(2,'Prescription'),(4,'Request');

DROP TABLE IF EXISTS `CalendarTBL`;
CREATE TABLE `CalendarTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `StartDate` date NOT NULL default '0000-00-00',
  `StartTime` time NOT NULL default '00:00:00',
  `EndDate` date default NULL,
  `EndTime` time default NULL,
  `Duration` varchar(25) default NULL,
  `AppType` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  KEY `indexStart` (`StartDate`),
  KEY `indexEnd` (`EndDate`)
) TYPE=MyISAM;
INSERT INTO `CalendarTBL` (`ID`,`StartDate`,`StartTime`,`EndDate`,`EndTime`,`Duration`,`AppType`) VALUES (1,'2003-10-25','17:15:00','2003-10-23','17:15:00','1',3),(2,'2003-10-12','08:00:00','2003-10-12','12:00:00','4',1),(3,'2003-10-30','14:30:00','2003-10-30','14:00:00','1',1),(4,'2003-04-15','00:00:00','2003-10-15','00:00:00','6',2),(5,'2002-10-18','00:00:00','2003-10-18',NULL,'1',2),(6,'2001-08-21','00:00:00','2003-10-18',NULL,'2',2),(7,'1992-07-11','00:00:00','1992-07-11',NULL,NULL,3),(8,'1999-11-05','00:00:00','1999-11-05',NULL,NULL,3),(9,'1999-12-02','00:00:00','1999-12-03',NULL,'1',3),(10,'2003-11-01','13:00:00','2003-11-01','14:00:00','1',3),(11,'1959-02-04','00:00:00','2003-11-04',NULL,'14 years',0),(12,'1963-02-04','00:00:00','2099-02-04',NULL,'Perpetual',1),(13,'2000-11-25','00:00:00','2003-11-25',NULL,'4 years',0),(20,'2003-11-01','13:13:00',NULL,NULL,NULL,1),(19,'2003-12-06','19:36:00',NULL,NULL,NULL,1),(21,'0000-00-00','00:00:00','2003-11-23',NULL,NULL,2),(22,'0000-00-00','00:00:00','2003-12-24',NULL,NULL,2),(25,'2003-11-24','00:00:00',NULL,NULL,NULL,3);
INSERT INTO `CalendarTBL` (`ID`,`StartDate`,`StartTime`,`EndDate`,`EndTime`,`Duration`,`AppType`) VALUES (26,'2003-11-25','00:00:00',NULL,NULL,NULL,3),(27,'2003-07-21','00:00:00',NULL,NULL,NULL,3),(28,'2004-01-15','00:00:00',NULL,NULL,NULL,3),(29,'2004-02-03','16:20:00',NULL,NULL,NULL,3),(30,'2004-02-21','13:45:00',NULL,NULL,NULL,1),(31,'2004-02-23','13:45:00',NULL,NULL,NULL,1),(51,'2004-04-09','24:45:00',NULL,NULL,NULL,1),(33,'2004-02-22','12:22:00',NULL,NULL,NULL,1),(34,'2004-02-22','23:22:00',NULL,NULL,NULL,1),(35,'2004-02-11','16:25:00',NULL,NULL,NULL,1),(36,'2004-02-16','08:00:00',NULL,NULL,NULL,1),(37,'0000-00-00','00:00:00','2004-02-04',NULL,NULL,2),(38,'0000-00-00','00:00:00','2004-02-11',NULL,NULL,2),(39,'1995-12-22','00:00:00',NULL,NULL,NULL,3),(40,'2004-02-10','14:45:00',NULL,NULL,NULL,1),(41,'2004-02-22','14:15:00',NULL,NULL,NULL,1),(42,'0000-00-00','00:00:00','2004-02-05',NULL,NULL,2),(43,'2004-02-22','24:33:00',NULL,NULL,NULL,1),(44,'2004-02-06','19:36:00',NULL,NULL,NULL,1),(45,'2004-02-01','13:00:00',NULL,NULL,NULL,1);
INSERT INTO `CalendarTBL` (`ID`,`StartDate`,`StartTime`,`EndDate`,`EndTime`,`Duration`,`AppType`) VALUES (46,'2004-02-01','13:13:00',NULL,NULL,NULL,1),(47,'2004-02-12','08:00:00',NULL,NULL,NULL,1),(48,'2004-01-15','00:00:00','2004-02-15',NULL,NULL,2),(49,'0000-00-00','00:00:00','2004-02-18',NULL,NULL,2),(50,'0000-00-00','00:00:00','2004-02-23',NULL,NULL,2),(52,'2004-04-05','13:05:00',NULL,NULL,NULL,1),(53,'2004-04-09','12:45:00',NULL,NULL,NULL,1),(54,'0000-00-00','00:00:00','2003-03-03',NULL,NULL,2),(55,'0000-00-00','00:00:00','2004-04-05',NULL,NULL,2),(56,'2004-12-30','16:00:00',NULL,NULL,NULL,1),(57,'2004-11-11','16:00:00',NULL,NULL,NULL,1),(58,'1999-12-22','24:31:00',NULL,NULL,NULL,3);

DROP TABLE IF EXISTS `ClientAddrTBL`;
CREATE TABLE `ClientAddrTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `MEDPAL` bigint(20) unsigned default NULL,
  `AddrID` bigint(20) unsigned default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexMEDPAL` (`MEDPAL`),
  KEY `indexAddrID` (`AddrID`)
) TYPE=MyISAM;
INSERT INTO `ClientAddrTBL` (`ID`,`MEDPAL`,`AddrID`) VALUES (1,1,1),(3,3,3),(4,4,4),(5,5,5),(2,2,2),(6,1,19),(7,1,20),(8,1,21),(9,1,22),(10,6,31),(11,7,32),(12,8,33),(13,9,37),(14,10,38),(15,11,39),(16,12,40),(17,13,47),(18,14,48),(19,9,53),(20,9,54),(21,9,55),(22,9,56),(23,9,57);

DROP TABLE IF EXISTS `ClientAllergyTBL`;
CREATE TABLE `ClientAllergyTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `MEDPAL` bigint(20) unsigned NOT NULL default '0',
  `OrderID` int(10) unsigned NOT NULL default '0',
  `Allergy` varchar(255) default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexMEDPAL` (`MEDPAL`)
) TYPE=MyISAM;
INSERT INTO `ClientAllergyTBL` (`ID`,`MEDPAL`,`OrderID`,`Allergy`) VALUES (1,1,1,'Ragweed Pollen cause this individual to have difficulty breathing.  Please administer Antihistamines in an emergency.'),(2,4,1,'Penicillin'),(3,4,2,'Peanuts'),(4,5,1,'Nice Clothing'),(5,1,2,'Lactose intolerance - Please do not server this individual dairy products or they will suffer intence indigestion.'),(6,5,2,'NoneSocks');

DROP TABLE IF EXISTS `ClientAppointmentTBL`;
CREATE TABLE `ClientAppointmentTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `MEDPAL` bigint(20) unsigned NOT NULL default '0',
  `CalendarID` bigint(20) unsigned NOT NULL default '0',
  `Appointment` varchar(255) default NULL,
  `ProviderID` bigint(20) unsigned default NULL,
  `HostID` bigint(20) unsigned default NULL,
  `EventTypeID` int(10) unsigned default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexMEDPAL` (`MEDPAL`)
) TYPE=MyISAM;
INSERT INTO `ClientAppointmentTBL` (`ID`,`MEDPAL`,`CalendarID`,`Appointment`,`ProviderID`,`HostID`,`EventTypeID`) VALUES (1,1,1,'General Physical',1,2,2),(2,1,2,'EKG',3,6,2),(3,1,3,'Dental Exam - premedicate',2,3,2),(4,1,10,'Blood Test - No food 24 before',1,2,2),(10,1,19,'test',1,2,2),(11,1,20,'another test again',5,5,2),(12,2,30,'Physical',3,6,2),(13,2,31,'Blood Test',4,5,2),(14,5,33,'Physical 2',6,8,2),(15,5,34,'Physical',6,8,2),(16,5,35,'Dental Exam',7,7,2),(17,5,36,'Chest Xrays',6,8,2),(18,7,40,'Physical',6,8,2),(19,7,41,'Blood Test',6,8,2),(20,6,43,'Physical',1,2,2),(21,1,44,'test test',1,2,2),(22,1,45,'Blood Test - No food 24 before',1,2,2),(23,1,46,'another test again',5,5,2),(24,1,47,'EKG',3,6,11),(25,12,51,'annual exam',10,11,2),(29,13,57,'test',13,14,2),(28,1,56,'Test',1,2,2);

DROP TABLE IF EXISTS `ClientBehavioralTBL`;
CREATE TABLE `ClientBehavioralTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `MEDPAL` bigint(20) unsigned NOT NULL default '0',
  `OrderID` int(10) unsigned NOT NULL default '0',
  `Behavior` varchar(255) default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexMEDPAL` (`MEDPAL`)
) TYPE=MyISAM;
INSERT INTO `ClientBehavioralTBL` (`ID`,`MEDPAL`,`OrderID`,`Behavior`) VALUES (1,4,1,'Down Syndrone'),(2,1,1,'First Behavioral entry'),(3,5,1,'Happy go lucky');

DROP TABLE IF EXISTS `ClientCronicConditionTBL`;
CREATE TABLE `ClientCronicConditionTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `MEDPAL` bigint(20) unsigned NOT NULL default '0',
  `OrderID` int(10) unsigned NOT NULL default '0',
  `Condition` varchar(255) default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexMEDPAL` (`MEDPAL`)
) TYPE=MyISAM;
INSERT INTO `ClientCronicConditionTBL` (`ID`,`MEDPAL`,`OrderID`,`Condition`) VALUES (5,1,2,'Test for line 2'),(4,1,1,'Test for line 1 updated'),(6,5,1,'No issues');

DROP TABLE IF EXISTS `ClientDiagnosisTBL`;
CREATE TABLE `ClientDiagnosisTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `MEDPAL` bigint(20) unsigned default NULL,
  `ICD9Code` varchar(25) default NULL,
  `ICD9Text` varchar(255) default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexMEDPAL` (`MEDPAL`),
  KEY `indexICD9Code` (`ICD9Code`)
) TYPE=MyISAM;
INSERT INTO `ClientDiagnosisTBL` (`ID`,`MEDPAL`,`ICD9Code`,`ICD9Text`) VALUES (6,1,'V72.2','Dental examination'),(1,1,'845','Sprains and strains of ankle and foot'),(2,1,'536.41','Head Trama'),(3,1,'540.0','Acute appendicitis with generalized peritonitis'),(4,1,'V69.0','Lack of physical exercise'),(7,1,'',''),(8,1,'',''),(9,1,'',''),(10,1,'',''),(11,1,'',''),(12,1,'','');

DROP TABLE IF EXISTS `ClientDispositionTBL`;
CREATE TABLE `ClientDispositionTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `MEDPAL` bigint(20) unsigned default NULL,
  `TypeID` int(10) unsigned default NULL,
  `Disposition` varchar(255) default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexMEDPAL` (`MEDPAL`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `ClientEmergContactsTBL`;
CREATE TABLE `ClientEmergContactsTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `MEDPAL` bigint(20) unsigned default NULL,
  `OrderID` int(10) unsigned default NULL,
  `FullNameID` bigint(20) unsigned default NULL,
  `AddrID` bigint(20) unsigned default NULL,
  `RelationsID` int(10) unsigned default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexMEDPAL` (`MEDPAL`)
) TYPE=MyISAM;
INSERT INTO `ClientEmergContactsTBL` (`ID`,`MEDPAL`,`OrderID`,`FullNameID`,`AddrID`,`RelationsID`) VALUES (1,1,1,23,23,7),(2,1,2,24,24,2),(3,5,1,35,34,1),(4,12,1,53,49,1),(5,12,2,54,50,1),(6,14,1,57,51,1),(7,14,2,58,52,1);

DROP TABLE IF EXISTS `ClientEventTBL`;
CREATE TABLE `ClientEventTBL` (
  `ID` bigint(20) NOT NULL auto_increment,
  `MEDPAL` bigint(20) unsigned NOT NULL default '0',
  `EventTypeID` int(10) unsigned default NULL,
  `CalendarID` bigint(20) unsigned default NULL,
  `Event` varchar(255) default NULL,
  `ProviderID` bigint(20) unsigned default NULL,
  `HostID` bigint(20) unsigned default NULL,
  `SymptomID` bigint(20) unsigned default NULL,
  `DispositionID` bigint(20) unsigned default NULL,
  `DiagnosisID` bigint(20) unsigned default NULL,
  `CurrentStatus` int(10) unsigned default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexMEDPAL` (`MEDPAL`),
  KEY `indexCalendarID` (`CalendarID`),
  KEY `indexProviderID` (`ProviderID`),
  KEY `indexHostID` (`HostID`),
  KEY `indexDiagnosisID` (`DiagnosisID`),
  KEY `indexEventTypeID` (`EventTypeID`),
  KEY `indexStatus` (`CurrentStatus`)
) TYPE=MyISAM;
INSERT INTO `ClientEventTBL` (`ID`,`MEDPAL`,`EventTypeID`,`CalendarID`,`Event`,`ProviderID`,`HostID`,`SymptomID`,`DispositionID`,`DiagnosisID`,`CurrentStatus`) VALUES (1,1,11,7,'Sprained Ankle',1,2,1,1,1,1),(2,1,24,8,'Head Trama from Car Accident',1,2,2,2,2,1),(3,1,15,9,'Appendectomy',5,1,3,3,3,1),(4,1,2,1,'Physical',1,2,4,4,4,1),(5,1,13,10,'Blood Work',1,1,NULL,NULL,11,1),(6,1,2,25,'test test test',1,2,NULL,NULL,7,1),(7,1,20,26,'Enamel test',0,3,NULL,NULL,6,1),(8,1,2,27,'Hit mail box on Segway',5,5,NULL,NULL,8,0),(9,1,1,28,'Stubbed my toe',4,2,NULL,NULL,9,0),(10,1,21,29,'Teeth cleaning',2,3,NULL,NULL,10,0),(11,5,2,39,'Sprained back',6,8,NULL,NULL,NULL,0),(12,1,16,58,'test',1,2,NULL,NULL,12,0);

DROP TABLE IF EXISTS `ClientExternalTBL`;
CREATE TABLE `ClientExternalTBL` (
  `MEDPAL` bigint(20) unsigned NOT NULL default '0',
  `Height` varchar(10) default NULL,
  `Weight` int(10) unsigned default NULL,
  `Sex` char(1) default NULL,
  `EyeColor` varchar(10) default NULL,
  `Eyes` varchar(25) default NULL,
  `Glasses` char(1) default NULL,
  `Vision` varchar(25) default NULL,
  `HairColor` varchar(25) default NULL,
  `Hearing` varchar(25) default NULL,
  `Ears` varchar(25) default NULL,
  `HearingAide` char(1) default NULL,
  `Nose` varchar(25) default NULL,
  `Mouth` varchar(25) default NULL,
  `Teeth` varchar(25) default NULL,
  `Prosthesis` varchar(45) default NULL,
  `Skin` varchar(25) default NULL,
  PRIMARY KEY  (`MEDPAL`)
) TYPE=MyISAM;
INSERT INTO `ClientExternalTBL` (`MEDPAL`,`Height`,`Weight`,`Sex`,`EyeColor`,`Eyes`,`Glasses`,`Vision`,`HairColor`,`Hearing`,`Ears`,`HearingAide`,`Nose`,`Mouth`,`Teeth`,`Prosthesis`,`Skin`) VALUES (1,'6 ~2',220,'M','Hazel','Good','N','20/15','Grey','Good','Good','N','Good','Good','Good','None','Good'),(2,'6 ~2',175,'M','Brown','Good','Y','30 20','Brown','Good','Good','N','Good','Good','Good','None','Good'),(8,'5 ~9',145,'F','Brown','Good','N','20/20','Brown','Good','Good','N','Good','Good','Good','None','Good'),(7,'5 ~7',145,'F','Blue','Good','N','20/20','Blonde','Good','Good','N','Good','Good','Good','None','Good'),(6,'6 ~5',200,'M','Brown','Good','N','20/20','Brown','Good','Good','N','Good','Good','Good','None','Good'),(5,'6~4',180,'M','Blue','Good','N','20/20','Blond','Good','Good','N','Good','Good','Good','None','Good'),(12,'5~7',140,'F','Brown','Good','Y','20/60','Blonde','Good','Good','N','Good','Good','Good','None','Good'),(14,'5~2',40,'M','Brown','Good','N','20/20','Blonde','Good','Good','N','Good','Good','Good','None','Good'),(9,'6~5',35,'F','Blue','Good','Y','20/20','Brown','Good','Good','N','Good','Good','Good','None','Good');

DROP TABLE IF EXISTS `ClientFamilyHistoryTBL`;
CREATE TABLE `ClientFamilyHistoryTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `MEDPAL` bigint(20) unsigned default NULL,
  `RelationshipTypeID` int(10) unsigned default NULL,
  `MedicalConditionID` int(10) unsigned default NULL,
  `FamilyResponce` char(1) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `ClientFamilyHistoryTBL` (`ID`,`MEDPAL`,`RelationshipTypeID`,`MedicalConditionID`,`FamilyResponce`) VALUES (340,1,5,28,''),(339,1,4,28,''),(338,1,3,28,''),(337,1,0,28,'N'),(336,1,5,27,''),(335,1,4,27,''),(334,1,3,27,'N'),(333,1,0,27,''),(332,1,5,26,''),(331,1,4,26,''),(330,1,3,26,''),(329,1,0,26,''),(328,1,5,24,'Y'),(327,1,4,24,''),(326,1,3,24,''),(325,1,0,24,''),(324,1,5,23,''),(323,1,4,23,''),(322,1,3,23,''),(321,1,0,23,''),(320,1,5,22,''),(319,1,4,22,''),(318,1,3,22,''),(317,1,0,22,''),(316,1,5,20,''),(315,1,4,20,'Y'),(314,1,3,20,''),(313,1,0,20,''),(312,1,5,21,''),(311,1,4,21,''),(310,1,3,21,''),(309,1,0,21,''),(308,1,5,13,''),(307,1,4,13,''),(306,1,3,13,''),(305,1,0,13,''),(304,1,5,19,''),(303,1,4,19,''),(302,1,3,19,''),(301,1,0,19,''),(300,1,5,25,''),(299,1,4,25,''),(298,1,3,25,''),(297,1,0,25,''),(296,1,5,18,''),(295,1,4,18,''),(294,1,3,18,''),(293,1,0,18,''),(292,1,5,17,''),(291,1,4,17,''),(290,1,3,17,'Y'),(289,1,0,17,''),(288,1,5,16,''),(287,1,4,16,''),(286,1,3,16,''),(285,1,0,16,'');
INSERT INTO `ClientFamilyHistoryTBL` (`ID`,`MEDPAL`,`RelationshipTypeID`,`MedicalConditionID`,`FamilyResponce`) VALUES (284,1,5,15,''),(283,1,4,15,''),(282,1,3,15,''),(281,1,0,15,''),(280,1,5,11,''),(279,1,4,11,''),(278,1,3,11,'Y'),(277,1,0,11,''),(276,1,5,10,''),(275,1,4,10,''),(274,1,3,10,''),(273,1,0,10,''),(272,1,5,12,''),(271,1,4,12,''),(270,1,3,12,''),(269,1,0,12,''),(268,1,5,9,''),(267,1,4,9,''),(266,1,3,9,''),(265,1,0,9,''),(264,1,5,8,''),(263,1,4,8,''),(262,1,3,8,''),(261,1,0,8,''),(260,1,5,7,''),(259,1,4,7,''),(258,1,3,7,''),(257,1,0,7,''),(256,1,5,14,''),(255,1,4,14,''),(254,1,3,14,''),(253,1,0,14,''),(252,1,5,6,''),(251,1,4,6,''),(250,1,3,6,''),(249,1,0,6,''),(248,1,5,5,''),(247,1,4,5,''),(246,1,3,5,''),(245,1,0,5,''),(244,1,5,4,''),(243,1,4,4,''),(242,1,3,4,''),(241,1,0,4,''),(240,1,5,3,''),(239,1,4,3,''),(238,1,3,3,''),(237,1,0,3,''),(236,1,5,2,''),(235,1,4,2,''),(234,1,3,2,''),(233,1,0,2,''),(232,1,5,1,''),(231,1,4,1,''),(230,1,3,1,''),(229,1,0,1,'');

DROP TABLE IF EXISTS `ClientFamilyTypeTBL`;
CREATE TABLE `ClientFamilyTypeTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `Description` varchar(45) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `ClientFamilyTypeTBL` (`ID`,`Description`) VALUES (1,'Spouse'),(2,'Siblings'),(3,'Parents'),(4,'Children'),(5,'Family'),(6,'Guardian'),(7,'Other');

DROP TABLE IF EXISTS `ClientHostTBL`;
CREATE TABLE `ClientHostTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `MEDPAL` bigint(20) unsigned default NULL,
  `HostID` bigint(20) unsigned default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexMEDPAL` (`MEDPAL`)
) TYPE=MyISAM;
INSERT INTO `ClientHostTBL` (`ID`,`MEDPAL`,`HostID`) VALUES (1,1,10),(3,1,6),(4,1,1),(5,1,3),(6,1,2);

DROP TABLE IF EXISTS `ClientInternalTBL`;
CREATE TABLE `ClientInternalTBL` (
  `MEDPAL` bigint(20) unsigned NOT NULL default '0',
  `BloodType` varchar(25) default NULL,
  `SystolicPressure` int(10) unsigned default NULL,
  `DiastolicPressure` int(10) unsigned default NULL,
  `LDL` int(10) unsigned default NULL,
  `HDL` int(10) unsigned default NULL,
  `Skeletal` varchar(255) default NULL,
  `Muscular` varchar(255) default NULL,
  `Digestive` varchar(255) default NULL,
  `Respiratory` varchar(255) default NULL,
  `Urinary` varchar(255) default NULL,
  `Nervous` varchar(255) default NULL,
  `Circulatory` varchar(255) default NULL,
  `Endocrine` varchar(255) default NULL,
  `Reproductive` varchar(255) default NULL,
  `Immune` varchar(255) default NULL,
  PRIMARY KEY  (`MEDPAL`)
) TYPE=MyISAM;
INSERT INTO `ClientInternalTBL` (`MEDPAL`,`BloodType`,`SystolicPressure`,`DiastolicPressure`,`LDL`,`HDL`,`Skeletal`,`Muscular`,`Digestive`,`Respiratory`,`Urinary`,`Nervous`,`Circulatory`,`Endocrine`,`Reproductive`,`Immune`) VALUES (1,'O Positive',80,120,110,76,'No issues','No Issues','Some gasroentritous years before','Prone to bronchites','No Issues','No Issues','Heart flutter','No Issues','No Issues','No Issues'),(5,'O Positive',0,0,0,0,'','','','','','','','','','');

DROP TABLE IF EXISTS `ClientPayorTBL`;
CREATE TABLE `ClientPayorTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `MEDPAL` bigint(20) NOT NULL default '0',
  `TypeID` int(10) unsigned NOT NULL default '0',
  `PayorID` bigint(20) default NULL,
  `GroupID` varchar(25) default NULL,
  `SubscriberID` varchar(25) default NULL,
  `PrimaryInsuredID` bigint(20) default NULL,
  `PrimaryProviderID` bigint(20) default NULL,
  `OfficeCoPay` varchar(45) default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexType` (`TypeID`),
  KEY `indexMEDPAL` (`MEDPAL`)
) TYPE=MyISAM;
INSERT INTO `ClientPayorTBL` (`ID`,`MEDPAL`,`TypeID`,`PayorID`,`GroupID`,`SubscriberID`,`PrimaryInsuredID`,`PrimaryProviderID`,`OfficeCoPay`) VALUES (6,1,1,3,'930','0243682951',1,1,'75.00'),(7,1,2,2,'23','0185555',22,2,'50.00'),(8,2,1,4,'8455544','99',28,4,'50.00'),(9,2,2,2,'00091881','99',29,2,'80%'),(10,5,2,2,'772','0298887652',33,7,'80 %'),(11,5,1,1,'87777616','0298887652',34,6,'50'),(12,12,1,5,'46312','566555',42,10,'$5'),(13,13,1,1,'46312','46321',51,13,'$5'),(14,12,2,2,'789456','456123',52,10,'none'),(15,14,1,1,'46312','556665',55,13,'$5'),(16,14,2,2,'789456','456123',56,14,'none'),(17,9,1,4,'','005-77-009',59,0,'10'),(18,9,2,2,'550-660','345-67-8900',60,0,'50');

DROP TABLE IF EXISTS `ClientPharmacyTBL`;
CREATE TABLE `ClientPharmacyTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `OrderID` int(10) unsigned default NULL,
  `MEDPAL` bigint(20) unsigned default NULL,
  `PharmacyID` bigint(20) unsigned default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexMEDPAL` (`MEDPAL`)
) TYPE=MyISAM;
INSERT INTO `ClientPharmacyTBL` (`ID`,`OrderID`,`MEDPAL`,`PharmacyID`) VALUES (1,1,1,1),(2,2,1,3),(4,1,5,4),(5,1,2,4),(6,2,2,2),(7,2,5,2),(8,1,3,1),(9,1,7,1),(10,1,6,3),(11,2,6,1),(12,3,1,2),(13,1,9,1),(14,2,9,3),(15,1,12,5),(16,1,14,5),(17,1,13,5);

DROP TABLE IF EXISTS `ClientPrescriptionTBL`;
CREATE TABLE `ClientPrescriptionTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `MEDPAL` bigint(20) unsigned NOT NULL default '0',
  `PrescrNbr` bigint(20) unsigned NOT NULL default '0',
  `CalendarID` bigint(20) unsigned default NULL,
  `PharmacyID` bigint(20) unsigned default NULL,
  `Medication` varchar(255) default NULL,
  `Condition` varchar(255) default NULL,
  `ProviderID` bigint(20) unsigned default NULL,
  `HostID` bigint(20) unsigned default NULL,
  `UnitSz` varchar(25) default NULL,
  `Quantity` varchar(25) NOT NULL default '',
  `Dosage` varchar(45) default NULL,
  `Directions` varchar(255) default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexEndDate` (`CalendarID`),
  KEY `indexPrescNbr` (`PrescrNbr`),
  KEY `indexMEDPAL` (`MEDPAL`)
) TYPE=MyISAM;
INSERT INTO `ClientPrescriptionTBL` (`ID`,`MEDPAL`,`PrescrNbr`,`CalendarID`,`PharmacyID`,`Medication`,`Condition`,`ProviderID`,`HostID`,`UnitSz`,`Quantity`,`Dosage`,`Directions`) VALUES (1,1,887,4,1,'Asprin','Sprained ankle',1,2,'250mg','300','500 mgs','3 times per day'),(2,1,0,5,2,'medication','test condition',2,6,'unit size','Quantity test','dosage','directions'),(3,1,836763,6,3,'eye droplets','Tied eyes',4,1,'2 drops','2 drops','3 drops','twice at night before bed'),(4,1,888,21,2,'Zelach','Pinched Nerve',5,NULL,'5mg','2','10mg','at night'),(5,1,662726,22,2,'darvon','New Years party hangover',5,NULL,'250 mg','200','500 mgs','2 in the morning'),(7,5,299928001,37,4,'Demerall','Broken Ribs',6,NULL,'25mg','50','50mg','Take 2 when you feel pain'),(8,5,998272,38,4,'Alminol','Tooth Ache',7,NULL,'10mg','25','30mg','3 Before bed'),(9,7,9837738,42,1,'Motrin','Feavor',6,NULL,'10mg','100','20mg','Take with food'),(10,1,887,48,1,'Asprin','Sprained ankle',1,NULL,'250mg','300','500 mgs','3 times per day'),(11,1,836763,49,3,'eye droplets','Tied eyes',4,NULL,'2 drops','2 drops','3 drops','twice at night before bed');
INSERT INTO `ClientPrescriptionTBL` (`ID`,`MEDPAL`,`PrescrNbr`,`CalendarID`,`PharmacyID`,`Medication`,`Condition`,`ProviderID`,`HostID`,`UnitSz`,`Quantity`,`Dosage`,`Directions`) VALUES (12,1,888,50,2,'Zelach','Pinched Nerve',5,NULL,'5mg','2','10mg','at night');

DROP TABLE IF EXISTS `ClientProviderTBL`;
CREATE TABLE `ClientProviderTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `OrderID` int(10) unsigned default NULL,
  `MEDPAL` bigint(20) unsigned default NULL,
  `ProviderID` bigint(20) unsigned default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexMEDPAL` (`MEDPAL`)
) TYPE=MyISAM;
INSERT INTO `ClientProviderTBL` (`ID`,`OrderID`,`MEDPAL`,`ProviderID`) VALUES (1,1,1,1),(2,2,1,3),(3,3,1,5),(6,4,1,2),(8,2,5,7),(7,1,5,6),(9,1,2,4),(10,2,2,3),(11,3,2,2),(12,3,5,3),(13,1,3,6),(14,2,3,3),(15,1,7,6),(16,2,7,2),(17,1,6,1),(18,2,6,7),(19,1,12,9),(20,2,12,10),(21,3,12,11),(22,4,12,12),(23,1,14,13),(24,2,14,14),(25,1,13,13),(26,2,13,14),(27,1,9,7),(28,2,9,5),(29,5,1,999);

DROP TABLE IF EXISTS `ClientRequestHistoryTBL`;
CREATE TABLE `ClientRequestHistoryTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `RequestID` bigint(20) unsigned default NULL,
  `MEDPAL` bigint(20) unsigned default NULL,
  `RequestHistDateTime` datetime default NULL,
  `RequestStatus` int(10) unsigned default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexRequestID` (`RequestID`),
  KEY `indexMedpal` (`MEDPAL`)
) TYPE=MyISAM;
INSERT INTO `ClientRequestHistoryTBL` (`ID`,`RequestID`,`MEDPAL`,`RequestHistDateTime`,`RequestStatus`) VALUES (33,1,1,'2004-02-03 08:33:20',1),(32,2,1,'2004-01-11 14:37:17',6),(31,1,1,'2004-01-10 20:49:57',1),(30,2,1,'2004-01-09 22:08:13',2),(29,2,1,'2004-01-09 22:07:01',2),(28,2,1,'2004-01-09 22:06:55',2),(27,2,1,'2004-01-09 22:06:36',2),(26,2,1,'2004-01-09 22:06:15',0),(25,2,1,'2004-01-09 22:01:38',2),(24,2,1,'2004-01-09 22:01:29',0),(23,2,1,'2004-01-09 21:59:33',2),(22,2,1,'2004-01-09 21:59:16',0),(21,2,1,'2004-01-09 21:59:08',2),(20,2,1,'2004-01-09 21:58:46',0),(19,2,1,'2004-01-09 21:46:07',1),(18,1,1,'2004-01-05 20:41:56',1),(34,3,1,'2004-02-03 08:34:36',1),(35,4,5,'2004-02-20 21:59:28',1),(36,2,1,'2004-03-07 12:15:10',6),(37,5,1,'2004-04-09 22:36:41',1),(38,2,1,'2004-04-11 00:12:25',6),(39,3,1,'2004-04-12 16:17:11',1),(40,3,1,'2004-04-14 11:46:46',1),(41,5,1,'2004-04-14 11:46:56',1),(42,3,1,'2004-04-14 13:01:15',1);

DROP TABLE IF EXISTS `ClientRequestTBL`;
CREATE TABLE `ClientRequestTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `MEDPAL` bigint(20) unsigned NOT NULL default '0',
  `RequestDateTime` datetime default NULL,
  `CurrentStatus` int(10) unsigned default NULL,
  `Request` varchar(255) default NULL,
  `ClientEventID` bigint(20) unsigned default NULL,
  `Comments` varchar(255) default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexMEDPAL` (`MEDPAL`),
  KEY `indexCurrentStatus` (`CurrentStatus`),
  KEY `indexRequestDateTime` (`RequestDateTime`)
) TYPE=MyISAM;
INSERT INTO `ClientRequestTBL` (`ID`,`MEDPAL`,`RequestDateTime`,`CurrentStatus`,`Request`,`ClientEventID`,`Comments`) VALUES (1,1,'2004-01-05 20:41:56',1,'Hit mail box on Segway',8,'Ouch'),(2,1,'2004-01-09 21:46:07',6,'Stubbed my toe',9,'try try try again'),(3,1,'2004-02-03 08:34:36',1,'Teeth cleaning',10,''),(4,5,'2004-02-20 21:59:28',1,'Sprained back',11,NULL),(5,1,'2004-04-09 22:36:41',1,'test',12,'');

DROP TABLE IF EXISTS `ClientRulesTBL`;
CREATE TABLE `ClientRulesTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `MEDPAL` bigint(20) unsigned default NULL,
  `RuleEventTypeID` int(10) unsigned default NULL,
  `RuleActionID` int(10) unsigned default NULL,
  `RuleInterval` int(10) unsigned default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexMedpal` (`MEDPAL`),
  KEY `indexAction` (`RuleActionID`)
) TYPE=MyISAM;
INSERT INTO `ClientRulesTBL` (`ID`,`MEDPAL`,`RuleEventTypeID`,`RuleActionID`,`RuleInterval`) VALUES (1,1,1,1,3),(3,1,5,2,5),(5,1,2,3,2),(6,5,2,1,2);

DROP TABLE IF EXISTS `ClientSocialProfileTBL`;
CREATE TABLE `ClientSocialProfileTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `MEDPAL` bigint(20) unsigned NOT NULL default '0',
  `FormerSmoker` char(1) default NULL,
  `CurSmoker` char(1) default NULL,
  `SmokerperMonth` int(10) unsigned default NULL,
  `SmokerType` varchar(15) default NULL,
  `SmokerYears` int(10) unsigned default NULL,
  `Alcohol` char(1) default NULL,
  `AlcoholperMonth` int(10) unsigned default NULL,
  `Exersize` char(1) default NULL,
  `ExersizeperMonth` int(10) unsigned default NULL,
  `ExersizeDescription` varchar(50) default NULL,
  `SubstanceAbuse` char(1) default NULL,
  `SubstanceAbuseDescription` varchar(50) default NULL,
  `Diet` char(1) default NULL,
  `DietDescription` varchar(50) default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexMEDPAL` (`MEDPAL`)
) TYPE=MyISAM;
INSERT INTO `ClientSocialProfileTBL` (`ID`,`MEDPAL`,`FormerSmoker`,`CurSmoker`,`SmokerperMonth`,`SmokerType`,`SmokerYears`,`Alcohol`,`AlcoholperMonth`,`Exersize`,`ExersizeperMonth`,`ExersizeDescription`,`SubstanceAbuse`,`SubstanceAbuseDescription`,`Diet`,`DietDescription`) VALUES (1,1,'Y','N',900,'cigarettes',10,'Y',20,'Y',2,'Tennis',NULL,NULL,'N','');

DROP TABLE IF EXISTS `ClientSpecialInstructionsTBL`;
CREATE TABLE `ClientSpecialInstructionsTBL` (
  `ID` bigint(20) NOT NULL auto_increment,
  `MEDPAL` bigint(20) unsigned NOT NULL default '0',
  `OrderID` int(10) unsigned NOT NULL default '0',
  `SpecialInstructions` varchar(255) default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexMEDPAL` (`MEDPAL`)
) TYPE=MyISAM;
INSERT INTO `ClientSpecialInstructionsTBL` (`ID`,`MEDPAL`,`OrderID`,`SpecialInstructions`) VALUES (1,1,1,'Due to Heart valvle issues this person must Premedicate before dental work or any other minor surgical procedure'),(2,5,1,'Special');

DROP TABLE IF EXISTS `ClientSymptomTBL`;
CREATE TABLE `ClientSymptomTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `MEDPAL` bigint(20) unsigned default NULL,
  `TypeID` int(10) unsigned default NULL,
  `Symptom` varchar(255) default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexMEDPAL` (`MEDPAL`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `ClientTBL`;
CREATE TABLE `ClientTBL` (
  `MEDPAL` bigint(20) unsigned NOT NULL default '0',
  `FullNameID` bigint(20) unsigned default NULL,
  `DOB` date default NULL,
  `PhotoID` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`MEDPAL`)
) TYPE=MyISAM;
INSERT INTO `ClientTBL` (`MEDPAL`,`FullNameID`,`DOB`,`PhotoID`) VALUES (1,1,'1953-02-04',3),(2,2,'1960-11-02',2),(3,3,'1943-06-22',8),(4,4,'1922-07-04',0),(5,5,'1985-12-24',7),(6,30,'1985-11-04',6),(7,31,'1982-12-15',5),(8,32,'1959-04-26',4),(9,38,'1958-06-08',9),(10,39,'1960-03-12',10),(11,40,'1960-04-12',0),(12,41,'1958-12-25',11),(13,49,'1994-04-28',13),(14,50,'1998-01-22',12);

DROP TABLE IF EXISTS `ClientVaccInocTBL`;
CREATE TABLE `ClientVaccInocTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `MEDPAL` bigint(20) unsigned NOT NULL default '0',
  `TypeID` char(1) default NULL,
  `CalendarID` bigint(20) unsigned default NULL,
  `Medication` varchar(45) default NULL,
  `ProviderID` bigint(20) unsigned default NULL,
  `VaccInocTypeID` int(10) unsigned default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexMEDPAL` (`MEDPAL`)
) TYPE=MyISAM;
INSERT INTO `ClientVaccInocTBL` (`ID`,`MEDPAL`,`TypeID`,`CalendarID`,`Medication`,`ProviderID`,`VaccInocTypeID`) VALUES (1,1,'v',11,'oral polio vaccine (OPV)',1,12),(2,1,'v',12,'diptheria-tetanus-acellular pertissis (DTaP)',1,5),(3,1,'v',13,'Chemoprophylaxis',1,16);

DROP TABLE IF EXISTS `DispositionTypeTBL`;
CREATE TABLE `DispositionTypeTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `Description` varchar(45) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `DispositionTypeTBL` (`ID`,`Description`) VALUES (1,'Cured'),(2,'Managed'),(3,'Open');

DROP TABLE IF EXISTS `EventScanTBL`;
CREATE TABLE `EventScanTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `ClientEventID` bigint(20) unsigned default NULL,
  `ScanID` bigint(20) unsigned default NULL,
  `EventScanInfo` varchar(255) default NULL,
  `ScanTypeID` int(10) unsigned default NULL,
  `ScanDefinitionID` int(10) unsigned default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexClientEventID` (`ClientEventID`),
  KEY `indexScanID` (`ScanID`)
) TYPE=MyISAM;
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (1,3,1,'Appendectimy Pathology',1, 1);
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (2,4,2,'Pysical Report',7, 1);
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (3,5,3,'Blood test Results',7, 1);
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (4,4,4,'Biopsy Letter',7, 1);
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (6,2,6,'Cat Scan 1',6, 1);
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (7,2,7,'Cat Scan 2',6, 1);
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (8,2,8,'Cat Scan 3',6, 1);
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (9,2,9,'Cat Scan 4',6, 1);
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (10,2,10,'Diagnosis',11, 1);
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (11,9,11,'test',2, 1);
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (12,9,12,'',2, 1);
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (13,9,13,'',2, 1);
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (14,9,14,'',2, 1);
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (15,9,15,'test again',1, 1);
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (16,1,16,'Ankle Angle 1',1, 1);
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (17,1,17,'Ankle Angle 2',1, 1);
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (18,1,18,'Ankle Angle 3',1, 1);
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (19,1,19,'Diagnostic AVI',13, 1);
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (20,10,22,'test of auto increment',3, 1);
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (21,10,23,'test of auto increment and temp file name',6, 1);
INSERT INTO `EventScanTBL` (`ID`,`ClientEventID`,`ScanID`,`EventScanInfo`,`ScanTypeID`,`ScanDefinitionID`) VALUES (22,1,24,'Test for voice',12,1);

DROP TABLE IF EXISTS `EventTypeTBL`;
CREATE TABLE `EventTypeTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `EventType` varchar(255) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `EventTypeTBL` (`ID`,`EventType`) VALUES (1,'Diagnosis or treatment'),(2,'General checkup'),(3,'Vision exam for glasses'),(4,'Maternity care (pre/postnatal)'),(5,'Well-child exam'),(6,'Immunizations'),(7,'Psychotherapy/Mental health counseling'),(8,'Reproductive services'),(9,'Foot care'),(10,'Physical therapy'),(11,'X-rays'),(12,'CATSCANS, sonograms, bodyscans'),(13,'Throat cultures, blood/urine testing'),(14,'Diagnostic testing'),(15,'Surgery/procedures'),(16,'Tests,unspecified'),(17,'Pre-admission testing'),(18,'Hearing tests'),(19,'Speech therapy'),(91,'Other'),(20,'Dental Exam'),(21,'Dental Cleaning'),(22,'Dental Surgery'),(23,'Dental Other'),(24,'Emergency'),(25,'Physical Exam'),(26,'Mammogram'),(27,'PAP Smear'),(28,'Colonoscopy'),(29,'Prostate Exam');

DROP TABLE IF EXISTS `FullNameTBL`;
CREATE TABLE `FullNameTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `FirstName` varchar(45) default NULL,
  `LastName` varchar(45) default NULL,
  `MI` char(1) default NULL,
  `Prefix` varchar(5) default NULL,
  `Suffix` varchar(5) default NULL,
  `eMailAddr` varchar(255) default NULL,
  `PagerID` varchar(15) default NULL,
  `PagerTeleNbr` varchar(15) default NULL,
  `MobilePhone` varchar(15) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `FullNameTBL` (`ID`,`FirstName`,`LastName`,`MI`,`Prefix`,`Suffix`,`eMailAddr`,`PagerID`,`PagerTeleNbr`,`MobilePhone`) VALUES (1,'Tarrant','Cutler','','Mr','Jr','tarrant.cutler@verizon.net','12345678','800-sky-telen','781-942-1982'),(2,'Steve','Paris','','Mr','','sparis@world.std.com','','','617-733-9599'),(3,'Dude','Ranch',NULL,'Sir',NULL,'dranch@atti.net','888123','800-234-1212','871-987-0023'),(4,'Down','South',NULL,'Ms',NULL,'ds@gp.net',NULL,NULL,'777-666-1234'),(5,'Sufer','Dude','','Yo','','sd@farout.com','743987','888-234-1234','723-397-8365'),(6,'Richard','Oliverio','','Mr','MD','ro@medicalgroup','888677','800-234-2929','987-837-3883'),(7,'Alice','Kaplan',NULL,'Ms','DMD','ak@comcast.net',NULL,NULL,NULL),(8,'John','Smith','J','Mr','MD','jjsmith@verizon.net','12345','888-123-8888','876-129-9389'),(9,'Chauncy','Seegood',NULL,'Mr','MD',NULL,NULL,NULL,NULL),(10,'Bartlet','Saunders','H','Mr','MD','bs@bsoc.net','8880923','800-222-1234','897-376-9802'),(11,'George','Jetson','','Mr','MD','gjetson@wayout.com','','',''),(12,'Alice','Cooper','','Ms','DMD','ac@hotmail.com','','','');
INSERT INTO `FullNameTBL` (`ID`,`FirstName`,`LastName`,`MI`,`Prefix`,`Suffix`,`eMailAddr`,`PagerID`,`PagerTeleNbr`,`MobilePhone`) VALUES (13,'John','Brook','','Mr','','jbrook@verizon.net',NULL,NULL,NULL),(14,'Sally','Green','','Ms','','',NULL,NULL,NULL),(15,'Joan','CVS','','Ms','','',NULL,NULL,NULL),(21,'William','Cutler','E','Mr','',NULL,NULL,NULL,NULL),(22,'Janet','Cutler','C','Ms','',NULL,NULL,NULL,NULL),(23,'Robert','Johnson','M','Mr','III',NULL,NULL,NULL,'781-640-2974'),(24,'Janet','Cutler','M','Mrs','',NULL,NULL,NULL,'777-555-7878'),(25,'Robert','Hunt','J','Mr','III','rjh@cambridgerx.net',NULL,NULL,NULL),(27,'Tarrant','Cutler','','Mr','','tcutler@adelphia.net','888125','800-456-4452','978-456-8856'),(28,'Steven','Paris','','Mr','',NULL,NULL,NULL,NULL),(29,'Steve','Paris','','Mr','',NULL,NULL,NULL,NULL),(30,'William','Cutler','E','Mr','','william.cutler@verizon.net','','','781-308-4881'),(31,'Bridget','Cutler','M','Ms','','','','',''),(32,'Janet','Cutler','M','Mrs','','janet.cutler@verizon.net','','','781-308-0281'),(33,'Surfer','Dude','','Mr','',NULL,NULL,NULL,NULL);
INSERT INTO `FullNameTBL` (`ID`,`FirstName`,`LastName`,`MI`,`Prefix`,`Suffix`,`eMailAddr`,`PagerID`,`PagerTeleNbr`,`MobilePhone`) VALUES (34,'Surfer','Dude','','Mr','',NULL,NULL,NULL,NULL),(35,'Surfette','Dudette','','Ms','',NULL,NULL,NULL,''),(36,'Fred','Manor','J','Mr','III','fred.manor@verizon.net',NULL,NULL,NULL),(37,'Robert','George','','Mr','','rg@verizon.net',NULL,NULL,NULL),(38,'Tamela','Jamieson','','Ms','','txjamieson@cs.com','','','xxffg'),(39,'Misha','Pivovarov','','Mr','','misha@pivovarov.com','','','781-929-7389'),(40,'Joan','Seamster','','Mrs','','jkseamster@yourinsights.biz','','','617-470-6091'),(41,'Sandra','Friedman','','Ms','','sfriedman@solorte.com','','','925-640-6036'),(42,'Rick','Friedman','P','Mr.','',NULL,NULL,NULL,NULL),(43,'Janice','Afruma','','Dr','MD','','','',''),(44,'Michael','Ranahan','','Dr','MD','','','',''),(45,'Loren','Kihlstrom','','Dr','DDS','','','',''),(46,'Thomas','Forest','J','Dr','DC','','','',''),(47,'Stephaen','Anantasiou','','Dr','','','','',''),(48,'Deanna','Aronoff','','Dr','DDS','','','','');
INSERT INTO `FullNameTBL` (`ID`,`FirstName`,`LastName`,`MI`,`Prefix`,`Suffix`,`eMailAddr`,`PagerID`,`PagerTeleNbr`,`MobilePhone`) VALUES (49,'Callie','Friedman','C','Ms','','','','',''),(50,'Justin','Friedman','','Mr','','Justinfriedman@comcast.net','','','925-640-6036'),(51,'Rick','Friedman','P','Mr.','',NULL,NULL,NULL,NULL),(52,'Rick','Friedman','P','Mr.','',NULL,NULL,NULL,NULL),(53,'Rick','Friedman','P','Mr.','',NULL,NULL,NULL,'510-508-0808'),(54,'Darlene','Friedman','','Ms.','',NULL,NULL,NULL,'925-596-0140'),(55,'Rick','Friedman','P','Mr.','',NULL,NULL,NULL,NULL),(56,'Rick','Friedman','P','Mr.','',NULL,NULL,NULL,NULL),(57,'Sandra','Friedman','S','Ms.','',NULL,NULL,NULL,'925-640-6036'),(58,'Darlene','Friedman','','Ms.','',NULL,NULL,NULL,'925-596-0140'),(59,'tamela','','l','ms','',NULL,NULL,NULL,NULL),(60,'tamela','Jamieson','l','ms','',NULL,NULL,NULL,NULL),(61,'Some','Name','','','','',NULL,NULL,NULL),(999,'* Attending *','* Provider *','','','','','','','');

DROP TABLE IF EXISTS `HostTBL`;
CREATE TABLE `HostTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `TypeID` int(10) unsigned default NULL,
  `Name` varchar(255) default NULL,
  `AddrID` bigint(20) unsigned default NULL,
  `URL` varchar(255) default NULL,
  `Map` varchar(255) default NULL,
  `EmergNbr` varchar(15) default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexType` (`TypeID`)
) TYPE=MyISAM;
INSERT INTO `HostTBL` (`ID`,`TypeID`,`Name`,`AddrID`,`URL`,`Map`,`EmergNbr`) VALUES (1,1,'Beverly Hospital',6,'www.beverlyhospital.com',NULL,'897-376-9802'),(2,2,'The Medical Group',7,NULL,NULL,'897-376-9802'),(3,2,'Kaplan Dental Associates',8,NULL,NULL,NULL),(4,2,'Southwest Dental',9,NULL,NULL,'897-376-9802'),(5,1,'Colorado General',10,NULL,NULL,'897-376-9802'),(6,3,'Atlanta Clinic',11,'',NULL,'123-456-7890'),(7,3,'Newton Dental Associates',12,'http://www.dfci.harvard.edu/',NULL,'781-944-1150'),(8,1,'Mass General',13,'http://www.mgh.harvard.edu/',NULL,'897-376-9802'),(9,4,'Northeast Blood Lab',27,'www.notheastblood.com',NULL,'800-777-4000'),(10,2,'Bay Valley Medical Group',41,'http://www.bayvalleymedicalgroup.com/',NULL,''),(11,5,'Michael Ranahan MD',42,'',NULL,''),(12,5,'Loren Kihlstrom DDS',43,'',NULL,''),(13,2,'Forest Chiropractic Office',44,'',NULL,''),(14,5,'Stephen Anantasiou MD',45,'',NULL,''),(15,5,'Deanna Aronoff DDS MSD',46,'',NULL,''),(999,1,'** Unknown Host **',999,'',NULL,'');

DROP TABLE IF EXISTS `HostTypeTBL`;
CREATE TABLE `HostTypeTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `Description` varchar(45) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `HostTypeTBL` (`ID`,`Description`) VALUES (1,'Doctors office or group practice'),(2,'Doctors clinic'),(3,'Neighborhood/family health center'),(4,'Free standing surgical center'),(5,'Company clinic'),(6,'School clinic'),(7,'Other clinic'),(8,'Home'),(9,'Laboratory'),(10,'Walk-in urgent center'),(11,'Hospital outpatient clinic'),(12,'Hospital inpatient clinic'),(19,'Dental clinic'),(20,'Long-term care facility'),(21,'Home health agency'),(22,'Optical store'),(23,'Radiology'),(24,'Ambulance service'),(25,'Emergency room'),(91,'Other');

DROP TABLE IF EXISTS `MedicalConditionTBL`;
CREATE TABLE `MedicalConditionTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `MedicalCondition` varchar(50) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `MedicalConditionTBL` (`ID`,`MedicalCondition`) VALUES (1,'Alcoholism'),(2,'Alzheimers Disease'),(3,'Anemia'),(4,'Anesthesia Problem'),(5,'Arthritis'),(6,'Autoimmune Disorder'),(7,'Bleeding Problem'),(8,'Cancer, Breast'),(9,'Cancer, Melanoma'),(10,'Cancer, Ovary'),(11,'Cancer, Prostate'),(12,'Cancer, Other'),(13,'Heart Attack (Coronary disorder)'),(14,'Birth Defects'),(15,'Depression'),(16,'Diabetes Type 1'),(17,'Diabetes Type 2'),(18,'Eczema'),(19,'Hearing Problems'),(20,'High Cholesterol'),(21,'High Blood Pressure'),(22,'Immunosuppressive Disorders'),(23,'Kidney Diseases'),(24,'Mental Retardation'),(25,'Epilepsy'),(26,'Stroke'),(27,'Substance Abuse'),(28,'Thyroid Disorders');

DROP TABLE IF EXISTS `NotesTBL`;
CREATE TABLE `NotesTBL` (
  `ID` bigint(20) NOT NULL auto_increment,
  `NoteText` varchar(255) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `OperatingSystemTBL`;
CREATE TABLE `OperatingSystemTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `OperatingSystem` varchar(50) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `OperatingSystemTBL` (`ID`,`OperatingSystem`) VALUES (1,'Windows 95'),(2,'Windows 98 First Edition'),(3,'Windows 98 Second Addition'),(4,'Windows XP Home'),(5,'Windows XP Profesional'),(6,'Windows NT'),(7,'Windows 2000'),(8,'Linux'),(9,'Other Unix'),(10,'Apple OS X'),(11,'Apple Macintosh'),(12,'Other');

DROP TABLE IF EXISTS `PayorTBL`;
CREATE TABLE `PayorTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `TypeID` int(10) unsigned default NULL,
  `Name` varchar(255) default NULL,
  `URL` varchar(255) default NULL,
  `AddrID` bigint(20) unsigned default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexType` (`TypeID`)
) TYPE=MyISAM;
INSERT INTO `PayorTBL` (`ID`,`TypeID`,`Name`,`URL`,`AddrID`) VALUES (1,1,'Blue Cross Blue Shield','http://www.bcbs.com/',14),(2,2,'Delta Dental','http://www.deltadental.com/',15),(3,1,'Aetna Insurance','http://www.aetna.com',29),(4,1,'MetLife Insurance','http://www.metlife.com',30),(5,1,'Great-West','http://www.onehealthplan.com',59);

DROP TABLE IF EXISTS `PayorTypeTBL`;
CREATE TABLE `PayorTypeTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `Description` varchar(45) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `PayorTypeTBL` (`ID`,`Description`) VALUES (1,'Medical'),(2,'Dental'),(3,'Other');

DROP TABLE IF EXISTS `PharmacyTBL`;
CREATE TABLE `PharmacyTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `Name` varchar(255) default NULL,
  `URL` varchar(255) default NULL,
  `Map` varchar(255) default NULL,
  `FullNameID` bigint(20) unsigned default NULL,
  `AddrID` bigint(20) unsigned default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `PharmacyTBL` (`ID`,`Name`,`URL`,`Map`,`FullNameID`,`AddrID`) VALUES (1,'Brooks Pharmacy','http://www.brooks-rx.com/',NULL,13,16),(2,'Wal-Greens','http://www.walgreens.com/default.jhtml',NULL,14,17),(3,'CVS','http://www.cvs.com/CVSApp/cvs/gateway/cvsmain',NULL,15,18),(4,'Cambridge Rx','http://www.cambridgerx.com',NULL,25,28),(5,'Raley\'s Drug Center','',NULL,61,58);

DROP TABLE IF EXISTS `PhotoTBL`;
CREATE TABLE `PhotoTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `URL` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `PhotoTBL` (`ID`,`URL`) VALUES (2,'images/000002/StevePict.jpg'),(3,'images/000001/tarrymontana.JPG'),(4,'images/000008/P1010164.JPG'),(5,'images/000007/P1010023.JPG'),(6,'images/000006/P1010221.JPG'),(7,'images/000005/P1010239.JPG'),(8,'images/000003/P9230026.JPG'),(9,'images/000009/tammyj.jpg'),(10,'images/000010/mishap_orig.jpg'),(11,'images/000012/sandyf.jpg'),(12,'images/000014/justinf.jpg'),(13,'images/000013/callief.jpg');

DROP TABLE IF EXISTS `ProblemAreaTBL`;
CREATE TABLE `ProblemAreaTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `ProblemArea` varchar(50) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `ProblemAreaTBL` (`ID`,`ProblemArea`) VALUES (1,'Login'),(2,'Information'),(3,'Requests'),(4,'Add/Update'),(5,'Devices'),(6,'Library'),(7,'Forms'),(8,'Customer Service'),(9,'Help'),(10,'Other');

DROP TABLE IF EXISTS `ProblemSeverityTBL`;
CREATE TABLE `ProblemSeverityTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `ProblemSeverity` varchar(25) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `ProblemSeverityTBL` (`ID`,`ProblemSeverity`) VALUES (1,'Critical'),(2,'High'),(3,'Medium'),(4,'Low'),(5,'As Designed');

DROP TABLE IF EXISTS `ProblemStatusTBL`;
CREATE TABLE `ProblemStatusTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `ProblemStatus` varchar(25) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `ProblemStatusTBL` (`ID`,`ProblemStatus`) VALUES (1,'Opened'),(2,'Triaged'),(3,'Under Development'),(4,'Ready for Test'),(5,'Closed');

DROP TABLE IF EXISTS `ProblemTrackingTBL`;
CREATE TABLE `ProblemTrackingTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `DateTimeStamp` datetime default NULL,
  `USERID` bigint(20) unsigned default NULL,
  `UserTypeID` char(1) NOT NULL default '',
  `ProblemTypeID` int(10) unsigned default NULL,
  `ProblemAreaID` int(10) unsigned default NULL,
  `BrowserTypeID` int(10) unsigned default NULL,
  `BrowserOther` varchar(50) default NULL,
  `OperatingSystemID` int(10) unsigned default NULL,
  `OperatingSystemOther` varchar(50) default NULL,
  `Problem` text,
  `ProblemSeverityID` int(10) unsigned default NULL,
  `ProblemStatusID` int(10) unsigned default NULL,
  `Developer` varchar(50) default NULL,
  `Tester` varchar(50) default NULL,
  `Fix` text,
  PRIMARY KEY  (`ID`),
  KEY `indexUSERID` (`USERID`)
) TYPE=MyISAM;
INSERT INTO `ProblemTrackingTBL` (`ID`,`DateTimeStamp`,`USERID`,`UserTypeID`,`ProblemTypeID`,`ProblemAreaID`,`BrowserTypeID`,`BrowserOther`,`OperatingSystemID`,`OperatingSystemOther`,`Problem`,`ProblemSeverityID`,`ProblemStatusID`,`Developer`,`Tester`,`Fix`) VALUES (1,'2004-03-30 17:57:30',12,'M',8,2,0,'',4,'',' Under insurance info i got a warning:  fopen. . . .permission denied....on line 35\r\n\r\nAlso, where would I find my doctor information??\r\n\r\nI have no idea what browser to select.',1,5,'Tarry','Tarry',NULL),(2,'2004-03-31 17:15:26',12,'M',9,0,0,'',4,'',' Should there be a box asking the relationship of the emergency contact??',0,2,'','',NULL),(3,'2004-04-10 23:07:58',1,'M',3,1,6,'',0,'',' ',5,1,'','',NULL);

DROP TABLE IF EXISTS `ProblemTypeTBL`;
CREATE TABLE `ProblemTypeTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `ProblemType` varchar(50) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `ProblemTypeTBL` (`ID`,`ProblemType`) VALUES (1,'Slow Responce'),(2,'No Responce'),(3,'Corrupted Display'),(4,'Corrupted Data'),(5,'Confusing Interface'),(7,'Update Error'),(8,'General Comment'),(9,'General Question'),(10,'Other');

DROP TABLE IF EXISTS `ProviderHostTBL`;
CREATE TABLE `ProviderHostTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `OrderID` int(10) unsigned default NULL,
  `ProviderID` bigint(20) unsigned default NULL,
  `HostID` bigint(20) unsigned default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexProviderID` (`ProviderID`)
) TYPE=MyISAM;
INSERT INTO `ProviderHostTBL` (`ID`,`OrderID`,`ProviderID`,`HostID`) VALUES (1,1,1,2),(2,2,1,1),(3,1,5,4),(4,1,4,5),(5,1,6,8),(6,1,7,7),(7,1,2,3),(8,1,3,6),(9,2,5,1),(10,3,5,8),(12,1,8,2),(13,2,8,1),(14,2,7,3),(15,1,9,10),(16,1,10,11),(17,1,11,12),(18,1,12,13),(19,1,13,14),(20,1,14,15),(21,1,999,999);

DROP TABLE IF EXISTS `ProviderIdentifierTBL`;
CREATE TABLE `ProviderIdentifierTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `ProviderID` bigint(20) unsigned default NULL,
  `ProviderIdentifier` varchar(15) default NULL,
  `ProviderIdentifierTypeID` int(10) unsigned default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `ProviderIdentifierTBL` (`ID`,`ProviderID`,`ProviderIdentifier`,`ProviderIdentifierTypeID`) VALUES (1,1,'G24648',1),(2,2,'G24649',1),(3,3,'G24640',1),(4,4,'G24641',1),(5,5,'G24642',1),(6,6,'G24643',1),(7,7,'G24644',1),(8,8,'G24676',1),(9,9,'G24646',1),(10,10,'G24647',1),(11,11,'G24618',1),(12,12,'G24628',1),(13,13,'G24638',1),(14,14,'G24658',1);

DROP TABLE IF EXISTS `ProviderIdentifierTypeTBL`;
CREATE TABLE `ProviderIdentifierTypeTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `ProviderIdentifierType` varchar(20) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `ProviderIdentifierTypeTBL` (`ID`,`ProviderIdentifierType`) VALUES (1,'UPIN');

DROP TABLE IF EXISTS `ProviderTBL`;
CREATE TABLE `ProviderTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `TypeID` int(10) unsigned default NULL,
  `FullNameID` bigint(20) unsigned default NULL,
  `SpecialtyID` int(10) unsigned default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexType` (`TypeID`)
) TYPE=MyISAM;
INSERT INTO `ProviderTBL` (`ID`,`TypeID`,`FullNameID`,`SpecialtyID`) VALUES (1,1,6,1),(2,1,7,13),(3,1,8,6),(4,1,9,16),(5,1,10,14),(6,1,11,11),(7,2,12,2),(8,2,27,16),(9,1,43,1),(10,1,44,11),(11,1,45,13),(12,1,46,33),(13,1,47,12),(14,1,48,13),(999,1,999,1);

DROP TABLE IF EXISTS `ProviderTypeTBL`;
CREATE TABLE `ProviderTypeTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `Description` varchar(45) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `ProviderTypeTBL` (`ID`,`Description`) VALUES (1,'Doctor'),(2,'Practitioner'),(3,'Nurse'),(4,'Technician'),(5,'Care Giver'),(6,'EMT'),(7,'Other');

DROP TABLE IF EXISTS `RelationshipTypeTBL`;
CREATE TABLE `RelationshipTypeTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `RelationshipType` varchar(45) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `RelationshipTypeTBL` (`ID`,`RelationshipType`) VALUES (1,'Family'),(2,'Spouse'),(3,'Sibling'),(4,'Parent'),(5,'Child'),(6,'Guardian'),(7,'Health Care Proxy'),(8,'Power of Attorney'),(9,'Primary'),(91,'Other'),(0,'Self');

DROP TABLE IF EXISTS `RequestStatusTBL`;
CREATE TABLE `RequestStatusTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `Description` varchar(45) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `RequestStatusTBL` (`ID`,`Description`) VALUES (1,'Client Request Initiated'),(2,'Under Internal Review'),(3,'Request Sent to Provider'),(4,'Waiting on Provider'),(7,'Provider Information Incomplete'),(8,'Provider Information Complete'),(6,'Quality Assurance Review'),(9,'Client Files Updated'),(10,'Waiting for Client Confirmation'),(11,'Client Confirmation received.'),(12,'Client Request Complete'),(5,'Provider Information Received');

DROP TABLE IF EXISTS `RequestTypeTBL`;
CREATE TABLE `RequestTypeTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `Desrciption` varchar(45) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `RuleActionTBL`;
CREATE TABLE `RuleActionTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `Action` varchar(45) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `RuleActionTBL` (`ID`,`Action`) VALUES (1,'Appointment'),(2,'Prescription Renewal'),(3,'Vaccination Renewal');

DROP TABLE IF EXISTS `RuleEventTypeTBL`;
CREATE TABLE `RuleEventTypeTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `EventType` varchar(45) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `RuleEventTypeTBL` (`ID`,`EventType`) VALUES (1,'Primary Phone call'),(2,'Email'),(3,'Post card'),(4,'Pager'),(5,'Mobile Phone');

DROP TABLE IF EXISTS `ScanDefinitionTBL`;
CREATE TABLE `ScanDefinitionTBL` (
  `keyID` int(10) unsigned NOT NULL auto_increment,
  `ScanTypeID` int(10) unsigned NOT NULL default '0',
  `ID` int(10) unsigned NOT NULL default '0',
  `ScanDefinition` varchar(45) default NULL,
  PRIMARY KEY  (`keyID`)
) TYPE=MyISAM;
INSERT INTO `ScanDefinitionTBL` (`keyID`,`ScanTypeID`,`ID`,`ScanDefinition`) VALUES (1,1,1,'Notes'),(2,1,2,'Form'),(3,1,3,'Test Request'),(4,1,4,'Test Results'),(5,1,5,'Prescription'),(6,1,6,'Instructions'),(7,1,7,'Diagnosis'),(8,1,90,'Other'),(9,1,91,'Unknown'),(10,2,1,'Head - Neck'),(11,2,2,'Chest'),(12,2,3,'Arm - Hand'),(13,2,4,'Leg - Foot'),(14,2,5,'Abdominal'),(15,2,90,'Other'),(16,2,91,'Unknown'),(17,3,1,'ECG'),(18,4,1,'EKG'),(19,5,1,'Head - Neck'),(20,5,2,'Chest'),(21,5,3,'Arm - Hand'),(22,5,4,'Leg - Foot'),(23,5,5,'Abdominal'),(24,5,90,'Other'),(25,5,91,'Unknown'),(26,6,1,'Notes'),(27,6,90,'Other'),(28,6,91,'Unknown'),(29,7,1,'Notes'),(30,7,90,'Other'),(31,7,91,'Unknown'),(32,90,1,'Other'),(33,91,1,'Unknown');

DROP TABLE IF EXISTS `ScanInfoTBL`;
CREATE TABLE `ScanInfoTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `URL` varchar(255) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `ScanInfoTBL` (`ID`,`URL`) VALUES (1,'scan/000001/Appendectomy.jpeg'),(2,'scan/000001/physical.jpg'),(3,'scan/000001/bloodtest.gif'),(4,'scan/000001/biopsy.gif'),(6,'scan/000001/ctbrain1.jpg'),(7,'scan/000001/ctbrain2.jpg'),(8,'scan/000001/ctbrain3.jpg'),(9,'scan/000001/ctbrain4.jpg'),(10,'scan/000001/physical.jpg'),(11,'scan/000001/chart2.jpg'),(12,'scan/000001/chart2.jpg'),(13,'scan/000001/custsup.gif'),(14,'scan/000001/kidneystone1.gif'),(15,'scan/000001/goldsel.gif'),(16,'scan/000001/ankle1.jpg'),(17,'scan/000001/ankle2.jpg'),(18,'scan/000001/ankle3.jpg'),(19,'scan/000001/diagnostic.avi'),(22,'scan/000001/1081803036audioicon2.jpg'),(23,'scan/000001/1081803548audioicon2.jpg'),(24,'scan/000001/mytest.wav');

DROP TABLE IF EXISTS `ScanTypeTBL`;
CREATE TABLE `ScanTypeTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `ScanType` varchar(45) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `ScanTypeTBL` (`ID`,`ScanType`) VALUES (1,'Document'),(2,'Xray'),(3,'ECG'),(4,'EKG'),(5,'CAT'),(6,'Voice'),(7,'Video'),(90,'Other'),(91,'Unknown');

DROP TABLE IF EXISTS `SpecTypeTBL`;
CREATE TABLE `SpecTypeTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `Description` varchar(45) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `SpecTypeTBL` (`ID`,`Description`) VALUES (12,'Pediatrician'),(11,'OB/GYN'),(10,'Urologist'),(9,'Hepatologist'),(8,'Resperitory'),(7,'Immunologist'),(6,'Cardiologist'),(5,'Endocrinologist'),(4,'Neurologist'),(3,'Radiologist'),(2,'Oncologist'),(1,'General Practitioner'),(13,'Dental'),(14,'Orthopedics'),(15,'Surgeon'),(16,'Acupuncture'),(17,'Anesthesiologist'),(18,'Dermatologist'),(19,'Epidemiologist'),(20,'Gastroenterologist'),(21,'Hematologist'),(22,'Internal Medicine'),(23,'Nephrologist'),(24,'Neurologist'),(25,'Ophthamologist'),(26,'Otolaryngologist'),(27,'Pathologist'),(28,'Plastic Surgery'),(29,'Podiatrist'),(30,'Psychiatrist'),(31,'Rheumatologist'),(32,'Geriatric'),(33,'Chiropractor');

DROP TABLE IF EXISTS `SymptomTypeTBL`;
CREATE TABLE `SymptomTypeTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `Description` varchar(45) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `SymptomTypeTBL` (`ID`,`Description`) VALUES (1,'Known'),(2,'Unknown'),(3,'Complex');

DROP TABLE IF EXISTS `UpinTBL`;
CREATE TABLE `UpinTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `UPIN` varchar(6) NOT NULL default '',
  `LastName` varchar(20) default NULL,
  `FirstName` varchar(14) default NULL,
  `MI` varchar(6) default NULL,
  `Suffix` char(3) default NULL,
  `CredentialCodes` char(3) default NULL,
  `LiscenceState` char(2) default NULL,
  `ZIP` varchar(9) default NULL,
  `PrimarySpecialtyCode` char(2) default NULL,
  PRIMARY KEY  (`ID`),
  KEY `indexUPIN` (`UPIN`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `UserTBL`;
CREATE TABLE `UserTBL` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `FullNameID` bigint(20) unsigned default NULL,
  `AddrID` bigint(20) unsigned default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `UserTBL` (`ID`,`FullNameID`,`AddrID`) VALUES (1,36,35),(2,37,36);

DROP TABLE IF EXISTS `VaccInocTypeTBL`;
CREATE TABLE `VaccInocTypeTBL` (
  `ID` int(10) unsigned NOT NULL default '0',
  `VaccInocType` varchar(50) default NULL,
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
INSERT INTO `VaccInocTypeTBL` (`ID`,`VaccInocType`) VALUES (1,'Hepatitas A'),(2,'Hepatitas B'),(3,'Pneumonia Vaccine'),(4,'Tetanus'),(5,'Diptheria'),(6,'Pertussis (Whooping cough)'),(7,'Measles'),(8,'Mumps'),(9,'Rubella'),(10,'HIB'),(11,'Influenza (Flu)'),(12,'Polio'),(13,'Yellow Feaver'),(14,'Typhoid'),(15,'Cholera'),(16,'Malaria'),(91,'Other');
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT;
SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS;
SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
