USE ClientInfoDB;

## MySQL dump 8.23
##
## Host: localhost    Database: ClientInfoDB
########################################################-
## Server version	3.23.58-log

##
## Table structure for table `AccessLogTBL`
##

DROP TABLE IF EXISTS AccessLogTBL;
CREATE TABLE AccessLogTBL (
  DateTimeStamp datetime NOT NULL default '0000-00-00 00:00:00',
  UserID bigint(20) unsigned default NULL,
  TypeID char(1) NOT NULL default '',
  MEDPAL bigint(20) unsigned default NULL,
  Module varchar(50) default NULL,
  Activity varchar(255) default NULL,
  Result varchar(255) default NULL,
  PRIMARY KEY  (DateTimeStamp),
  KEY indexUserID (UserID),
  KEY indexMEDPAL (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `AccessLogTBL`
##


INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-10 22:13:40',1,'M',6,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-03 17:51:11',9,'M',9,'UAmedinsure.php','Dental Insurance Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-11 13:06:22',1,'M',0,'hyslogoff.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-11 13:13:46',1,'M',8,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-11 13:15:31',1,'M',7,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-03 17:47:41',9,'M',9,'UAmedinsure.php','Medical Insurance Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-03 17:24:45',9,'M',9,'UAappt.php','Appointment successfully Added','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-11 14:30:01',1,'M',0,'hyslogoff.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-03 17:14:20',9,'',9,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-03 17:11:20',9,'',9,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-03 17:09:51',9,'',9,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-03 17:07:55',9,'',9,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-03 17:07:06',9,'',9,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-03 16:48:31',9,'',9,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-03 16:47:58',1,'C',9,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-03 11:32:37',12,'M',12,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-12 10:32:45',1,'C',8,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-12 10:32:58',2,'C',2,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-12 10:42:32',1,'C',5,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-12 10:42:38',1,'C',3,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-02 14:41:02',1,'C',8,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-31 17:24:47',12,'M',14,'UAmedemrgcont.php','Secondary Emergency Medical Contact Information Added','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-31 17:23:42',12,'M',14,'UAmedemrgcont.php','Primary Emergency Medical Contact Information Added','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-31 17:22:39',12,'M',14,'UArules.php','Client Rules Updated.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-31 17:21:37',12,'M',14,'UAnameaddrName.php','Client Name Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-31 17:21:02',12,'M',14,'UAmedprofExternal.php','External Medical Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-31 17:20:30',12,'M',14,'UAmedinsure.php','Dental Insurance Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-31 17:19:51',12,'M',14,'UAmedinsure.php','Medical Insurance Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-14 19:58:10',1,'M',6,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-14 19:58:15',1,'M',6,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-31 17:18:33',12,'M',14,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-31 17:16:05',12,'M',13,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-31 17:13:24',12,'M',12,'UAmedemrgcont.php','Secondary Emergency Medical Contact Information Added','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-31 17:12:08',12,'M',12,'UAmedemrgcont.php','Primary Emergency Medical Contact Information Added','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-31 17:10:50',12,'M',12,'UArules.php','Client Rules Updated.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-31 17:09:07',12,'M',12,'UAnameaddrName.php','Client Name Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-14 23:10:14',1,'M',8,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-14 23:11:10',1,'M',8,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-14 23:11:53',1,'C',7,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-31 17:08:29',12,'M',12,'UAmedprofExternal.php','External Medical Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-31 17:07:10',12,'M',12,'UAmedinsure.php','Dental Insurance Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-31 17:06:00',12,'M',12,'UAmedinsure.php','Medical Insurance Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-17 13:25:09',1,'M',7,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-17 13:31:05',1,'M',7,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-31 17:05:06',12,'M',12,'UAappt.php','Appointment successfully Added','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-17 15:23:52',1,'M',7,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-17 15:23:59',1,'M',6,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-17 15:24:53',1,'M',8,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-17 15:25:05',1,'M',8,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-31 17:00:56',12,'M',12,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-19 16:40:06',1,'C',2,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-19 16:52:53',1,'C',2,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-19 17:54:22',9,'C',9,'UAnameaddrPhoto.php','Client Photo Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-19 18:11:30',2,'C',2,'UAnameaddrPhoto.php','Client Photo Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-19 18:14:26',2,'C',2,'UAnameaddrPhoto.php','Client Photo Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-19 18:19:26',2,'',2,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-19 18:21:41',2,'M',2,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-19 18:21:52',9,'',9,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-19 18:22:02',9,'M',9,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-19 18:22:18',10,'',10,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-19 18:22:44',10,'M',10,'UAnameaddrPhoto.php','Client Photo Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-19 18:23:57',10,'M',10,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-19 18:24:22',11,'',11,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-19 18:25:01',11,'M',11,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-19 18:25:27',12,'',12,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-19 18:25:35',12,'M',12,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-20 00:06:40',12,'',12,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-31 11:49:33',1,'M',7,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-20 10:45:24',1,'C',12,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-20 11:48:18',1,'M',0,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-30 19:57:25',11,'M',11,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-30 19:57:21',11,'',11,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-30 18:57:16',11,'M',11,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-30 18:57:05',11,'M',11,'UAnameaddrName.php','Client Name Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-20 14:12:30',10,'',10,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-20 14:14:02',10,'M',10,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-30 18:54:18',11,'',11,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-30 17:51:21',12,'M',12,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-30 16:39:40',2,'M',2,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-30 16:37:30',2,'M',2,'UApresc.php','Client Prescription Information Deleted.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-30 16:35:53',2,'',2,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-20 16:20:19',10,'',10,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-21 12:36:27',12,'',12,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-21 12:40:05',12,'M',12,'UAmedinsure.php','Medical Insurance Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-30 12:17:35',1,'M',6,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-21 12:46:38',12,'',12,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-30 12:17:21',1,'M',6,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-21 16:36:16',13,'',13,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-21 16:36:57',13,'M',13,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-21 16:37:08',13,'',13,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-21 16:37:28',13,'M',13,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-21 16:37:39',14,'',14,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-21 16:37:49',14,'M',14,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-21 16:37:59',14,'',14,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-21 16:38:49',14,'M',14,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-21 16:39:21',12,'M',13,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-21 16:40:48',12,'M',13,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-30 10:30:07',1,'C',12,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-21 21:12:22',12,'M',13,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-21 21:26:07',12,'M',13,'UAmedinsure.php','Medical Insurance Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-21 21:45:11',12,'M',12,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 12:18:21',1,'M',6,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 12:18:40',1,'M',8,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 12:19:05',1,'M',8,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:23:08',1,'M',7,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:23:24',1,'M',8,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:24:18',1,'M',6,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:24:25',1,'M',6,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:28:23',1,'C',12,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:30:19',1,'C',12,'UAnameaddrPhoto.php','Client Photo Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:30:50',14,'C',14,'UAnameaddrPhoto.php','Client Photo Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:31:15',13,'C',13,'UAnameaddrPhoto.php','Client Photo Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:31:35',13,'',13,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:33:44',13,'M',13,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:33:57',14,'',14,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:34:23',14,'M',14,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:34:55',12,'M',12,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:35:06',12,'M',13,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:35:12',12,'M',14,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:35:19',12,'M',14,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:42:27',14,'',14,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:48:37',14,'M',14,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:48:54',2,'',2,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:50:42',2,'M',2,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:52:48',12,'M',13,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:52:56',12,'M',12,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:56:03',12,'M',12,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-22 13:57:06',1,'C',9,'setmedpal.php','Choose Medpal to Work with from access list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-03-30 10:25:15',1,'M',0,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-03 18:05:45',9,'M',9,'UAmedprofExternal.php','External Medical Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-03 18:15:23',9,'M',9,'UAnameaddrName.php','Client Name Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-03 21:11:31',2,'',2,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-03 21:13:42',2,'M',2,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-03 23:46:32',9,'',9,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-03 23:52:45',9,'',9,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 00:22:42',9,'M',9,'UAappt.php','Appointment successfully Added','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 00:37:21',9,'M',9,'UApresc.php','Client Prescription Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 00:51:00',9,'M',9,'UApresc.php','Client Prescription Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 00:56:14',9,'M',9,'UAmedinsure.php','Medical Insurance Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 00:57:00',9,'M',9,'UAmedinsure.php','Medical Insurance Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 01:04:02',9,'M',9,'UAmedinsure.php','Medical Insurance Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 01:10:28',9,'M',9,'UAmedinsure.php','Dental Insurance Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 01:11:20',9,'M',9,'UAmedinsure.php','Dental Insurance Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 01:12:21',9,'M',9,'UAmedprofExternal.php','External Medical Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 01:14:14',9,'M',9,'UAmedprofExternal.php','External Medical Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 01:19:13',9,'M',9,'UAmedprofExternal.php','External Medical Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 01:32:53',9,'M',9,'UAnameaddrName.php','Client Name Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 01:35:12',9,'M',9,'UAnameaddrAddr.php','Address Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 01:38:16',9,'M',9,'UAnameaddrAddr.php','Address Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 01:39:56',9,'M',9,'UAnameaddrAddr.php','Address Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 01:41:03',9,'M',9,'UAnameaddrAddr.php','Address Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 01:41:50',9,'M',9,'UAnameaddrAddr.php','Address Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 11:54:25',9,'',9,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 12:43:30',1,'C',9,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 13:03:37',1,'C',9,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 16:18:46',9,'',9,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 22:51:00',1,'M',8,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 23:01:54',1,'C',9,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 23:02:25',1,'C',13,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-04 23:08:19',1,'C',13,'UAappt.php','Appointment successfully Added','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-05 11:06:06',1,'C',9,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-05 16:19:04',1,'C',12,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-05 16:23:59',1,'C',12,'UAmedinsure.php','Medical Insurance Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-05 16:25:47',14,'C',14,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-05 16:26:15',14,'C',13,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-05 16:32:40',1,'C',14,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-05 20:27:16',1,'C',6,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-06 09:16:47',2,'C',2,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-06 14:44:15',2,'C',2,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-06 14:52:34',1,'M',6,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-06 14:52:47',1,'M',7,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-06 14:54:36',15,'C',15,'UAmedhist.php','Medical Event successfully Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-07 11:02:13',1,'M',7,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-07 11:02:22',1,'M',7,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-07 13:33:47',1,'C',2,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-07 13:39:04',9,'C',9,'UAmedinsure.php','Medical Insurance Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-07 13:39:09',9,'C',9,'UAmedinsure.php','Dental Insurance Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-07 14:33:34',2,'C',15,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-07 15:01:58',2,'C',15,'UAnameaddrAddr.php','Address Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-07 15:02:05',2,'C',15,'UAnameaddrAddr.php','Address Information updated.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-07 15:02:14',2,'C',15,'UAnameaddrAddr.php','Address Information Deleted.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-07 15:19:14',2,'C',15,'UAnameaddrPhoto.php','Client Photo Information Added.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-07 15:20:47',2,'C',15,'UArules.php','Client Rules Updated.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-08 09:09:24',1,'C',6,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-08 11:38:45',1,'C',11,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-08 11:41:05',1,'C',10,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-08 13:13:13',2,'C',15,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-08 13:14:17',2,'',2,'login.php','Login','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-08 13:14:44',2,'M',2,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-08 13:15:08',2,'C',15,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-08 13:16:31',2,'C',15,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-10 18:42:25',1,'C',15,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-24 00:56:23',1,'M',8,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-24 00:56:00',1,'M',8,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-24 00:55:31',1,'M',6,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-13 18:17:32',1,'C',15,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-13 18:28:35',1,'C',15,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-13 18:35:09',1,'C',15,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-13 19:21:37',1,'C',15,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-14 14:41:51',1,'M',7,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-14 14:43:00',1,'M',8,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-14 14:43:12',1,'M',6,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-19 20:06:10',1,'C',8,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-15 21:04:59',1,'C',12,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-28 20:40:51',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-16 12:08:20',1,'C',15,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-26 21:20:16',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-26 21:04:19',1,'M',1,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-19 10:33:22',1,'M',8,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-26 20:33:25',1,'M',1,'accesslogdelete.php','Client Logs Deleted.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-19 10:33:11',1,'M',8,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-28 22:48:57',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-28 23:13:06',1,'M',1,'UAmedprofExternal.php','External Medical Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-28 23:13:11',1,'M',1,'UAmedprofExternal.php','External Medical Information update.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-28 23:13:33',1,'M',1,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-28 23:13:41',1,'C',1,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-29 20:58:56',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-29 21:04:05',1,'M',1,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-30 10:25:18',1,'C',15,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-30 12:12:08',1,'C',15,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-30 12:13:37',1,'C',15,'UAmedhist.php','Medical Event successfully Updated.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-30 12:13:56',1,'C',15,'UAmedhist.php','Medical Event successfully Updated.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-30 12:14:18',1,'C',15,'UAmedhist.php','Medical Event successfully Updated.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-30 12:14:54',1,'C',15,'UAmedhist.php','Medical Event successfully Updated.','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-30 12:53:26',1,'C',15,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-30 12:57:57',2,'C',2,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-30 13:43:19',1,'C',15,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-30 13:44:48',2,'C',16,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-30 14:00:08',1,'C',1,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-04-30 14:49:26',1,'M',0,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-05-01 22:31:29',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-05-01 22:38:57',1,'M',1,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-05-01 22:42:30',1,'C',12,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-05-02 15:04:34',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-05-02 15:07:17',1,'M',1,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-05-02 16:15:42',1,'M',8,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-05-02 16:15:49',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-05-02 16:16:36',1,'M',1,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-05-02 16:16:56',1,'C',1,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-05-02 16:18:34',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-05-02 21:24:01',1,'M',8,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-05-02 21:24:09',1,'M',8,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-05-02 21:24:17',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-05-02 21:54:32',1,'M',1,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-05-03 08:28:57',1,'M',1,'setmedpal.php','Choose Medpal from list','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-05-03 08:29:20',1,'M',1,'hyslogoff.php','Logoff','Ok');
INSERT INTO AccessLogTBL (DateTimeStamp, UserID, TypeID, MEDPAL, Module, Activity, Result) VALUES ('2004-05-03 11:09:44',1,'C',1,'setmedpal.php','Choose Medpal from list','Ok');

##
## Table structure for table `AddrTBL`
##

DROP TABLE IF EXISTS AddrTBL;
CREATE TABLE AddrTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  OrderID int(10) unsigned default NULL,
  AddrLine1 varchar(255) default NULL,
  AddrLine2 varchar(255) default NULL,
  City varchar(45) default NULL,
  State char(2) default NULL,
  ZIP varchar(10) default NULL,
  PhoneNbr varchar(15) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `AddrTBL`
##


INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (999,1,'Unknown','','Unknown','XX','99999','Unknown');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (22,1,'12 Nichols Rd','','Reading','MA','01867','781-942-1982');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (2,1,'27 Colwell Ave.','','Brighton','MA','02135','617-783-7130');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (3,1,'1 Prarie Way',NULL,'Durango','CO','98772','635-938-7403');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (4,1,'23 Peach Pie Lane','Suite 32','Atlanta','GA','92882','874-737-8733');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (5,1,'16 Loredo Drive','','Ocean City','CA','01922','735-748-6640');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (6,1,'85 Herrick St','suite 99','Beverly','MA','01928','978-922-3000');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (7,1,'86 Herrick St',NULL,'Beverly','MA','01928','978-944-3826');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (8,1,'25 Haven St','','Reading','MA','01928','781-944-2816');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (9,1,'32 Rodeo Dr',NULL,'Durango','CO','01928','668-287-8383');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (10,1,'45 Colfax Ave','Suite 33','Denver','CO','01928','765-983-7378');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (11,1,'2 Peach Tree Way','suite 123','Atlanta','GA','01928','772-762-7264');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (12,1,'33 Orchard Circle','2nd Floor','Newton','MA','01928','888-999-1234');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (13,1,'17 Newbury Ave',NULL,'Boston','MA','01928','923-222-2398');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (14,1,'23  Health St','Suite 23','Chicago','IL','01928','800-123-8887');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (15,1,'5 Comerce Way',NULL,'Lexington','KY','01928','827-222-2938');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (16,1,'12 Haven St','','Reading','MA','01928','781-942-8792');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (17,1,'32 Win St','','Reno','NV','01928','876-938-3927');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (18,1,'88 Oak St','','Atlanta','GA','01928','871-928-2972');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (19,2,'21 Woody end Lane','','Chilmark','MA','01928','508-232-1099');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (20,3,'55 Bungalo way','Suite 44','Fort Lauderdale','FL','01928','888-222-9999');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (23,1,'12 Maple Lane','','Bedford','NY','01928','777-333-1234');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (24,1,'12 Nichols Rd','','Reading','MA','01867','781-999-1234');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (27,1,'23 Channel St','Suite 22','Woburn','MA','01928','781-459-4400');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (28,1,'13 Wilson Ave','Suite 23','Cambridge','MA','01928','888-123-4567');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (29,1,'23 Willow Brook Lane','Suite 32','Hobolton','NJ','918827','800-456-4785');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (30,1,'15 Richmond Ave','','Charston','SC','05224','800-560-4000');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (31,1,'12 Nichols Rd','','Reading','MA','01867','781-942-1982');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (32,1,'12 Nichols Rd','','Reading','MA','01867','781-942-1982');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (33,1,'12 Nichols Rd','','Reading','MA','01867','781-942-1982');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (34,1,'35 Beach St','','Cardiff','CA','09187','782-999-9876');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (35,1,'12 Elm St','suite 33','Woburn','MA','01866','888-777-6666');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (36,1,'23 Park Ave','Suite 32','New York','NY','91881','999-888-7777');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (37,1,'3 Amherst Rd','','Andover','MA','01867','978-474-4074');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (38,1,'8 Richard RD','','Marblehead','MA','01945','781-631-7942');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (39,1,'A Road','','SomeCity','MA','99999','508-785-9057');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (40,1,'3006 Bersano Court','','Pleasanton','CA','94566','925-600-0502');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (41,1,'4725 First St','','Pleasanton','CA','94566','925-462-7060');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (42,1,'5565 W Las Positas Blvd','','Pleasanton','CA','94566','925-73-0404');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (43,1,'1262 Concannon Blvd','','Livermore','CA','94550','925-447-9300');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (44,1,'4224 Stanley Blvd','','Pleasanton','CA','94566','925-846-3357');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (45,1,'5565 W. Las Positas Blvd','','Pleasanton','CA','94566','925-460-8484');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (46,1,'1262 Concannon Blvd','','Livermore','CA','94550','925-447-9300');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (47,1,'3006 Bersano Court','','Pleasanton','CA','94566','925-600-0502');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (48,1,'3006 Bersano Court','','Pleasanton','CA','94566','925-600-0502');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (49,1,'3006 Bersano Court','','Pleasanton','CA','94566','510-508-0808');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (50,1,'506 St John Circle','','Pleasanton','CA','94566','925-846-7856');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (51,1,'3006 Bersano Court','','Pleasanton','CA','(4566','925-600-0502');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (52,1,'708St. John Circle','','Pleasanton','CA','94566','925-846-7856');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (53,0,'','fffff','','','','');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (54,0,'22 Robinson Court','','Andover','xx','','');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (55,0,'22 Robinson Court','','Andover','ma','xxxxx','');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (56,0,'22 Robinson Court','','Andover','ma','01845','xxxxx');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (57,0,'22 Robinson Court','','Andover','ma','01845','978-444-5555');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (58,1,'5420 Sunol Boulevard','','Pleasanton','CA','94566','800-999-9999');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (59,1,'P.O. Box 11111','','Ft. Scott','KA','66701','800-ONE-8081');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (66,1,'1690 Commonwealth Ave.','','Brighton','MA','02135','617-232-3513');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (61,1,'330 Brookline Avenue','','Boston','MA','02215','617-667-7000');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (62,1,'1101 Beacon St.','','Brookline','MA','02446','617-277-0700');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (63,1,'St. Elizabeth\'s Professional Building','280 Washington St., Suite 309','Brighton','MA','02135','617-782-5316');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (64,1,'1180 Beacon St. Suite 3A','','Brookline','MA','02446','617-566-3120');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (65,1,'27 Colwell Ave.','','Brighton','MA','02135','617-783-7130');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (67,1,'27 Colwell Ave.','','Brighton','MA','02135','617-783-7130');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (68,1,'39 Plain Rd.','','Upton','MA','01568','508-529-6673');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (69,1,'39 Plain Rd.','','Upton','MA','01568','508-529-6673');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (70,1,'39 Plain Rd.','','Upton','MA','01568','508-529-6673');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (71,1,'University Campus','55 Lake Ave. N.','Worcester','MA','01655','(508) 856-5520');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (72,1,'75 Francis Street','','Boston','MA','02115','(617) 732-5500');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (73,1,'39 Plain Rd.','','Upton','MA','01568','508-529-6673');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (74,1,'125 Nashua St.','','Boston','MA','02114','617-373-7000');
INSERT INTO AddrTBL (ID, OrderID, AddrLine1, AddrLine2, City, State, ZIP, PhoneNbr) VALUES (75,1,'14 Prospect St.','','Milford','MA','01757','508-473-1190');

##
## Table structure for table `AdminAuthTBL`
##

DROP TABLE IF EXISTS AdminAuthTBL;
CREATE TABLE AdminAuthTBL (
  ID bigint(20) unsigned NOT NULL default '0',
  Pword tinyblob,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `AdminAuthTBL`
##


INSERT INTO AdminAuthTBL (ID, Pword) VALUES (1,'janetc');

##
## Table structure for table `AuthTypeTBL`
##

DROP TABLE IF EXISTS AuthTypeTBL;
CREATE TABLE AuthTypeTBL (
  ID char(1) NOT NULL default '',
  AuthType varchar(45) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `AuthTypeTBL`
##


INSERT INTO AuthTypeTBL (ID, AuthType) VALUES ('C','CustomerService');
INSERT INTO AuthTypeTBL (ID, AuthType) VALUES ('M','Client');
INSERT INTO AuthTypeTBL (ID, AuthType) VALUES ('U','User');
INSERT INTO AuthTypeTBL (ID, AuthType) VALUES ('D','Provider');
INSERT INTO AuthTypeTBL (ID, AuthType) VALUES ('P','Pharmacy');
INSERT INTO AuthTypeTBL (ID, AuthType) VALUES ('E','Emergency');

##
## Table structure for table `AuthenticationTBL`
##

DROP TABLE IF EXISTS AuthenticationTBL;
CREATE TABLE AuthenticationTBL (
  USERID bigint(20) NOT NULL default '0',
  TypeID char(1) NOT NULL default 'M',
  Pword tinyblob,
  PRIMARY KEY  (USERID,TypeID),
  KEY indexUSERID (USERID),
  KEY indexTypeID (TypeID)
) TYPE=MyISAM;

##
## Dumping data for table `AuthenticationTBL`
##


INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (1,'M','frodo');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (2,'M','9599');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (3,'M','dude');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (4,'M','down');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (5,'M','surfer');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (6,'M','william');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (7,'M','bridget');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (8,'M','janet');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (1,'D','richard');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (6,'D','george');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (1,'P','brooks');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (1,'U','manor');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (1,'C','janetc');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (2,'U','george');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (3,'P','cvs');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (9,'M','2650');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (10,'M','7389');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (11,'M','6091');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (12,'M','6036');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (13,'M','callie');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (14,'M','justin');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (2,'C','frances');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (15,'M','frances');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (3,'U','s052656p');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (3,'C','pivovarov');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (4,'U','0248');
INSERT INTO AuthenticationTBL (USERID, TypeID, Pword) VALUES (16,'M','0248');

##
## Table structure for table `AuthorizationLevelTypeTBL`
##

DROP TABLE IF EXISTS AuthorizationLevelTypeTBL;
CREATE TABLE AuthorizationLevelTypeTBL (
  ID int(10) unsigned NOT NULL default '0',
  Level varchar(50) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `AuthorizationLevelTypeTBL`
##


INSERT INTO AuthorizationLevelTypeTBL (ID, Level) VALUES (1,'Unrestricted');
INSERT INTO AuthorizationLevelTypeTBL (ID, Level) VALUES (2,'Read All');
INSERT INTO AuthorizationLevelTypeTBL (ID, Level) VALUES (3,'Restricted');
INSERT INTO AuthorizationLevelTypeTBL (ID, Level) VALUES (4,'Exclude');

##
## Table structure for table `AuthorizationTBL`
##

DROP TABLE IF EXISTS AuthorizationTBL;
CREATE TABLE AuthorizationTBL (
  USERID bigint(20) unsigned NOT NULL default '0',
  TypeID char(1) NOT NULL default 'M',
  MEDPAL bigint(20) unsigned NOT NULL default '0',
  Level int(10) unsigned zerofill default NULL,
  RelationsID int(10) unsigned default NULL,
  PRIMARY KEY  (USERID,TypeID,MEDPAL),
  KEY indexUSERID (USERID),
  KEY indexTypeID (TypeID),
  KEY indexMedpal (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `AuthorizationTBL`
##


INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (1,'M',1,0000000001,0);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (2,'M',2,0000000001,2);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (3,'M',3,0000000001,3);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (4,'M',4,0000000001,4);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (5,'M',5,0000000001,1);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (1,'M',6,0000000002,1);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (6,'M',6,0000000001,1);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (7,'M',7,0000000003,1);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (1,'M',7,0000000003,1);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (8,'M',8,0000000001,1);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (8,'M',1,0000000001,2);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (7,'M',8,0000000004,1);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (1,'M',8,0000000001,1);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (6,'M',8,0000000003,1);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (3,'M',5,0000000003,1);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (2,'U',1,0000000002,8);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (9,'M',9,0000000001,NULL);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (10,'M',10,0000000001,NULL);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (11,'M',11,0000000001,NULL);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (12,'M',12,0000000001,NULL);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (13,'M',13,0000000003,0);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (14,'M',14,0000000003,0);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (12,'M',13,0000000001,1);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (12,'M',14,0000000001,1);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (15,'M',15,0000000001,1);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (3,'U',15,0000000001,1);
INSERT INTO AuthorizationTBL (USERID, TypeID, MEDPAL, Level, RelationsID) VALUES (16,'M',16,0000000001,NULL);

##
## Table structure for table `BrowserTypeTBL`
##

DROP TABLE IF EXISTS BrowserTypeTBL;
CREATE TABLE BrowserTypeTBL (
  ID int(10) unsigned NOT NULL default '0',
  BrowserType varchar(50) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `BrowserTypeTBL`
##


INSERT INTO BrowserTypeTBL (ID, BrowserType) VALUES (1,'Microsoft IE 4.0');
INSERT INTO BrowserTypeTBL (ID, BrowserType) VALUES (2,'Microsoft IE 5.0');
INSERT INTO BrowserTypeTBL (ID, BrowserType) VALUES (3,'Microsoft IE 5.5');
INSERT INTO BrowserTypeTBL (ID, BrowserType) VALUES (4,'Microsoft IE 6.0');
INSERT INTO BrowserTypeTBL (ID, BrowserType) VALUES (5,'Netscape 4.0');
INSERT INTO BrowserTypeTBL (ID, BrowserType) VALUES (6,'Netscape 4.5');
INSERT INTO BrowserTypeTBL (ID, BrowserType) VALUES (7,'Netscape 6.0');
INSERT INTO BrowserTypeTBL (ID, BrowserType) VALUES (8,'Netscape 7.0');
INSERT INTO BrowserTypeTBL (ID, BrowserType) VALUES (9,'Mosaic 3.0');
INSERT INTO BrowserTypeTBL (ID, BrowserType) VALUES (10,'Opera 3.0');
INSERT INTO BrowserTypeTBL (ID, BrowserType) VALUES (11,'Opera 3.5');
INSERT INTO BrowserTypeTBL (ID, BrowserType) VALUES (12,'Opera 4.0');
INSERT INTO BrowserTypeTBL (ID, BrowserType) VALUES (13,'Opera 5.0');
INSERT INTO BrowserTypeTBL (ID, BrowserType) VALUES (14,'Opera 6.0');
INSERT INTO BrowserTypeTBL (ID, BrowserType) VALUES (15,'Opera 7.0');
INSERT INTO BrowserTypeTBL (ID, BrowserType) VALUES (16,'Mozilla');
INSERT INTO BrowserTypeTBL (ID, BrowserType) VALUES (17,'AOL');
INSERT INTO BrowserTypeTBL (ID, BrowserType) VALUES (18,'Other');
INSERT INTO BrowserTypeTBL (ID, BrowserType) VALUES (19,'Safari');

##
## Table structure for table `CalendarAppTypeTBL`
##

DROP TABLE IF EXISTS CalendarAppTypeTBL;
CREATE TABLE CalendarAppTypeTBL (
  ID int(10) unsigned NOT NULL default '0',
  Description varchar(45) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `CalendarAppTypeTBL`
##


INSERT INTO CalendarAppTypeTBL (ID, Description) VALUES (1,'Medical');
INSERT INTO CalendarAppTypeTBL (ID, Description) VALUES (3,'Event');
INSERT INTO CalendarAppTypeTBL (ID, Description) VALUES (2,'Prescription');
INSERT INTO CalendarAppTypeTBL (ID, Description) VALUES (4,'Request');

##
## Table structure for table `CalendarTBL`
##

DROP TABLE IF EXISTS CalendarTBL;
CREATE TABLE CalendarTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  StartDate date NOT NULL default '0000-00-00',
  StartTime time NOT NULL default '00:00:00',
  EndDate date default NULL,
  EndTime time default NULL,
  Duration varchar(25) default NULL,
  AppType int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (ID),
  KEY indexStart (StartDate),
  KEY indexEnd (EndDate)
) TYPE=MyISAM;

##
## Dumping data for table `CalendarTBL`
##


INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (1,'2003-10-25','16:15:00','2003-10-23','17:15:00','1',1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (2,'2003-10-12','08:00:00','2003-10-12','12:00:00','4',1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (3,'2003-10-30','14:30:00','2003-10-30','14:00:00','1',1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (4,'2003-04-15','00:00:00','2003-10-15','00:00:00','6',2);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (5,'2002-10-18','00:00:00','2003-10-18',NULL,'1',2);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (6,'2001-08-21','00:00:00','2003-10-18',NULL,'2',2);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (7,'1992-07-11','00:00:00','1992-07-11',NULL,NULL,3);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (8,'1999-11-05','00:00:00','1999-11-05',NULL,NULL,3);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (9,'1999-12-02','00:00:00','1999-12-03',NULL,'1',3);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (10,'2003-11-01','13:00:00','2003-11-01','14:00:00','1',1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (11,'1959-02-04','00:00:00','2003-11-04',NULL,'14 years',0);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (12,'1963-02-04','00:00:00','2099-02-04',NULL,'Perpetual',1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (13,'2000-11-25','00:00:00','2003-11-25',NULL,'4 years',0);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (20,'2003-11-01','13:13:00',NULL,NULL,NULL,1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (19,'2003-12-06','19:36:00',NULL,NULL,NULL,1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (21,'0000-00-00','00:00:00','2003-11-23',NULL,NULL,2);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (22,'0000-00-00','00:00:00','2003-12-24',NULL,NULL,2);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (25,'2003-11-24','00:00:00',NULL,NULL,NULL,3);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (26,'2003-11-25','00:00:00',NULL,NULL,NULL,3);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (27,'2003-07-21','00:00:00',NULL,NULL,NULL,3);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (28,'2004-01-15','00:00:00',NULL,NULL,NULL,3);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (29,'2004-02-03','15:20:00',NULL,NULL,NULL,3);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (30,'2004-02-21','13:45:00',NULL,NULL,NULL,1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (31,'2004-02-23','13:45:00',NULL,NULL,NULL,1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (51,'2004-04-09','24:45:00',NULL,NULL,NULL,1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (33,'2004-02-22','12:22:00',NULL,NULL,NULL,1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (34,'2004-02-22','23:22:00',NULL,NULL,NULL,1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (35,'2004-02-11','16:25:00',NULL,NULL,NULL,1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (36,'2004-02-16','08:00:00',NULL,NULL,NULL,1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (37,'0000-00-00','00:00:00','2004-02-04',NULL,NULL,2);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (38,'0000-00-00','00:00:00','2004-02-11',NULL,NULL,2);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (39,'1995-12-22','00:00:00',NULL,NULL,NULL,3);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (40,'2004-02-10','14:45:00',NULL,NULL,NULL,1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (41,'2004-02-22','14:15:00',NULL,NULL,NULL,1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (42,'0000-00-00','00:00:00','2004-02-05',NULL,NULL,2);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (43,'2004-02-22','24:33:00',NULL,NULL,NULL,1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (44,'2004-02-06','19:36:00',NULL,NULL,NULL,1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (45,'2004-02-01','13:00:00',NULL,NULL,NULL,1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (46,'2004-02-01','13:13:00',NULL,NULL,NULL,1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (47,'2004-02-12','08:00:00',NULL,NULL,NULL,1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (48,'0000-00-00','00:00:00','2004-02-15',NULL,NULL,2);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (49,'0000-00-00','00:00:00','2004-02-18',NULL,NULL,2);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (50,'0000-00-00','00:00:00','2004-02-23',NULL,NULL,2);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (52,'2004-04-05','13:05:00',NULL,NULL,NULL,1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (53,'2004-04-09','12:45:00',NULL,NULL,NULL,1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (54,'0000-00-00','00:00:00','2003-03-03',NULL,NULL,2);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (55,'0000-00-00','00:00:00','2004-04-05',NULL,NULL,2);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (56,'2004-12-30','16:00:00',NULL,NULL,NULL,1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (57,'2004-11-11','16:00:00',NULL,NULL,NULL,1);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (58,'2004-03-17','00:00:00',NULL,NULL,NULL,3);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (59,'2004-03-17','00:00:00',NULL,NULL,NULL,3);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (60,'2003-03-17','15:10:00',NULL,NULL,NULL,3);
INSERT INTO CalendarTBL (ID, StartDate, StartTime, EndDate, EndTime, Duration, AppType) VALUES (61,'2003-01-30','00:00:00',NULL,NULL,NULL,3);

##
## Table structure for table `ClientAddrTBL`
##

DROP TABLE IF EXISTS ClientAddrTBL;
CREATE TABLE ClientAddrTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  MEDPAL bigint(20) unsigned default NULL,
  AddrID bigint(20) unsigned default NULL,
  PRIMARY KEY  (ID),
  KEY indexMEDPAL (MEDPAL),
  KEY indexAddrID (AddrID)
) TYPE=MyISAM;

##
## Dumping data for table `ClientAddrTBL`
##


INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (1,1,1);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (3,3,3);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (4,4,4);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (5,5,5);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (2,2,2);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (6,1,19);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (7,1,20);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (8,1,21);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (9,1,22);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (10,6,31);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (11,7,32);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (12,8,33);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (13,9,37);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (14,10,38);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (15,11,39);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (16,12,40);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (17,13,47);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (18,14,48);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (19,9,53);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (20,9,54);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (21,9,55);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (22,9,56);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (23,9,57);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (24,15,60);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (25,15,65);
INSERT INTO ClientAddrTBL (ID, MEDPAL, AddrID) VALUES (28,16,70);

##
## Table structure for table `ClientAllergyTBL`
##

DROP TABLE IF EXISTS ClientAllergyTBL;
CREATE TABLE ClientAllergyTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  MEDPAL bigint(20) unsigned NOT NULL default '0',
  OrderID int(10) unsigned NOT NULL default '0',
  Allergy varchar(255) default NULL,
  PRIMARY KEY  (ID),
  KEY indexMEDPAL (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `ClientAllergyTBL`
##


INSERT INTO ClientAllergyTBL (ID, MEDPAL, OrderID, Allergy) VALUES (1,1,1,'Ragweed Pollen cause this individual to have difficulty breathing.  Please administer Antihistamines in an emergency.');
INSERT INTO ClientAllergyTBL (ID, MEDPAL, OrderID, Allergy) VALUES (2,4,1,'Penicillin');
INSERT INTO ClientAllergyTBL (ID, MEDPAL, OrderID, Allergy) VALUES (3,4,2,'Peanuts');
INSERT INTO ClientAllergyTBL (ID, MEDPAL, OrderID, Allergy) VALUES (4,5,1,'Nice Clothing');
INSERT INTO ClientAllergyTBL (ID, MEDPAL, OrderID, Allergy) VALUES (5,1,2,'Lactose intolerance - Please do not server this individual dairy products or they will suffer intence indigestion.');
INSERT INTO ClientAllergyTBL (ID, MEDPAL, OrderID, Allergy) VALUES (6,5,2,'NoneSocks');

##
## Table structure for table `ClientAppointmentTBL`
##

DROP TABLE IF EXISTS ClientAppointmentTBL;
CREATE TABLE ClientAppointmentTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  MEDPAL bigint(20) unsigned NOT NULL default '0',
  CalendarID bigint(20) unsigned NOT NULL default '0',
  Appointment varchar(255) default NULL,
  ProviderID bigint(20) unsigned default NULL,
  HostID bigint(20) unsigned default NULL,
  EventTypeID int(10) unsigned default NULL,
  PRIMARY KEY  (ID),
  KEY indexMEDPAL (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `ClientAppointmentTBL`
##


INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (1,1,1,'General Physical',1,2,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (2,1,2,'EKG',3,6,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (3,1,3,'Dental Exam - premedicate',2,3,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (4,1,10,'Blood Test - No food 24 before',1,2,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (10,1,19,'test',1,2,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (11,1,20,'another test again',5,5,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (12,2,30,'Physical',3,6,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (13,2,31,'Blood Test',4,5,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (14,5,33,'Physical 2',6,8,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (15,5,34,'Physical',6,8,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (16,5,35,'Dental Exam',7,7,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (17,5,36,'Chest Xrays',6,8,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (18,7,40,'Physical',6,8,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (19,7,41,'Blood Test',6,8,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (20,6,43,'Physical',1,2,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (21,1,44,'test test',1,2,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (22,1,45,'Blood Test - No food 24 before',1,2,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (23,1,46,'another test again',5,5,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (24,1,47,'EKG',3,6,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (25,12,51,'annual exam',10,11,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (29,13,57,'test',13,14,2);
INSERT INTO ClientAppointmentTBL (ID, MEDPAL, CalendarID, Appointment, ProviderID, HostID, EventTypeID) VALUES (28,1,56,'Test',1,2,2);

##
## Table structure for table `ClientBehavioralTBL`
##

DROP TABLE IF EXISTS ClientBehavioralTBL;
CREATE TABLE ClientBehavioralTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  MEDPAL bigint(20) unsigned NOT NULL default '0',
  OrderID int(10) unsigned NOT NULL default '0',
  Behavior varchar(255) default NULL,
  PRIMARY KEY  (ID),
  KEY indexMEDPAL (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `ClientBehavioralTBL`
##


INSERT INTO ClientBehavioralTBL (ID, MEDPAL, OrderID, Behavior) VALUES (1,4,1,'Down Syndrone');
INSERT INTO ClientBehavioralTBL (ID, MEDPAL, OrderID, Behavior) VALUES (2,1,1,'First Behavioral entry');
INSERT INTO ClientBehavioralTBL (ID, MEDPAL, OrderID, Behavior) VALUES (3,5,1,'Happy go lucky');

##
## Table structure for table `ClientCronicConditionTBL`
##

DROP TABLE IF EXISTS ClientCronicConditionTBL;
CREATE TABLE ClientCronicConditionTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  MEDPAL bigint(20) unsigned NOT NULL default '0',
  OrderID int(10) unsigned NOT NULL default '0',
  Condition varchar(255) default NULL,
  PRIMARY KEY  (ID),
  KEY indexMEDPAL (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `ClientCronicConditionTBL`
##


INSERT INTO ClientCronicConditionTBL (ID, MEDPAL, OrderID, Condition) VALUES (5,1,2,'Test for line 2');
INSERT INTO ClientCronicConditionTBL (ID, MEDPAL, OrderID, Condition) VALUES (4,1,1,'Test for line 1 updated');
INSERT INTO ClientCronicConditionTBL (ID, MEDPAL, OrderID, Condition) VALUES (6,5,1,'No issues');

##
## Table structure for table `ClientDiagnosisTBL`
##

DROP TABLE IF EXISTS ClientDiagnosisTBL;
CREATE TABLE ClientDiagnosisTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  MEDPAL bigint(20) unsigned default NULL,
  ICD9Code varchar(25) default NULL,
  ICD9Text varchar(255) default NULL,
  PRIMARY KEY  (ID),
  KEY indexMEDPAL (MEDPAL),
  KEY indexICD9Code (ICD9Code)
) TYPE=MyISAM;

##
## Dumping data for table `ClientDiagnosisTBL`
##


INSERT INTO ClientDiagnosisTBL (ID, MEDPAL, ICD9Code, ICD9Text) VALUES (6,1,'V72.2','Dental examination');
INSERT INTO ClientDiagnosisTBL (ID, MEDPAL, ICD9Code, ICD9Text) VALUES (1,1,'845','Sprains and strains of ankle and foot');
INSERT INTO ClientDiagnosisTBL (ID, MEDPAL, ICD9Code, ICD9Text) VALUES (2,1,'536.41','Head Trama');
INSERT INTO ClientDiagnosisTBL (ID, MEDPAL, ICD9Code, ICD9Text) VALUES (3,1,'540.0','Acute appendicitis with generalized peritonitis');
INSERT INTO ClientDiagnosisTBL (ID, MEDPAL, ICD9Code, ICD9Text) VALUES (4,1,'V69.0','Lack of physical exercise');
INSERT INTO ClientDiagnosisTBL (ID, MEDPAL, ICD9Code, ICD9Text) VALUES (7,1,'','');
INSERT INTO ClientDiagnosisTBL (ID, MEDPAL, ICD9Code, ICD9Text) VALUES (8,1,'','');
INSERT INTO ClientDiagnosisTBL (ID, MEDPAL, ICD9Code, ICD9Text) VALUES (9,1,'','');
INSERT INTO ClientDiagnosisTBL (ID, MEDPAL, ICD9Code, ICD9Text) VALUES (10,15,'','');
INSERT INTO ClientDiagnosisTBL (ID, MEDPAL, ICD9Code, ICD9Text) VALUES (11,15,'','');
INSERT INTO ClientDiagnosisTBL (ID, MEDPAL, ICD9Code, ICD9Text) VALUES (12,15,'','');
INSERT INTO ClientDiagnosisTBL (ID, MEDPAL, ICD9Code, ICD9Text) VALUES (13,15,'','');

##
## Table structure for table `ClientDispositionTBL`
##

DROP TABLE IF EXISTS ClientDispositionTBL;
CREATE TABLE ClientDispositionTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  MEDPAL bigint(20) unsigned default NULL,
  TypeID int(10) unsigned default NULL,
  Disposition varchar(255) default NULL,
  PRIMARY KEY  (ID),
  KEY indexMEDPAL (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `ClientDispositionTBL`
##



##
## Table structure for table `ClientEmergContactsTBL`
##

DROP TABLE IF EXISTS ClientEmergContactsTBL;
CREATE TABLE ClientEmergContactsTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  MEDPAL bigint(20) unsigned default NULL,
  OrderID int(10) unsigned default NULL,
  FullNameID bigint(20) unsigned default NULL,
  AddrID bigint(20) unsigned default NULL,
  RelationsID int(10) unsigned default NULL,
  PRIMARY KEY  (ID),
  KEY indexMEDPAL (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `ClientEmergContactsTBL`
##


INSERT INTO ClientEmergContactsTBL (ID, MEDPAL, OrderID, FullNameID, AddrID, RelationsID) VALUES (1,1,1,23,23,8);
INSERT INTO ClientEmergContactsTBL (ID, MEDPAL, OrderID, FullNameID, AddrID, RelationsID) VALUES (2,1,2,24,24,2);
INSERT INTO ClientEmergContactsTBL (ID, MEDPAL, OrderID, FullNameID, AddrID, RelationsID) VALUES (3,5,1,35,34,1);
INSERT INTO ClientEmergContactsTBL (ID, MEDPAL, OrderID, FullNameID, AddrID, RelationsID) VALUES (4,12,1,53,49,1);
INSERT INTO ClientEmergContactsTBL (ID, MEDPAL, OrderID, FullNameID, AddrID, RelationsID) VALUES (5,12,2,54,50,1);
INSERT INTO ClientEmergContactsTBL (ID, MEDPAL, OrderID, FullNameID, AddrID, RelationsID) VALUES (6,14,1,57,51,1);
INSERT INTO ClientEmergContactsTBL (ID, MEDPAL, OrderID, FullNameID, AddrID, RelationsID) VALUES (7,14,2,58,52,1);

##
## Table structure for table `ClientEventTBL`
##

DROP TABLE IF EXISTS ClientEventTBL;
CREATE TABLE ClientEventTBL (
  ID bigint(20) NOT NULL auto_increment,
  MEDPAL bigint(20) unsigned NOT NULL default '0',
  EventTypeID int(10) unsigned default NULL,
  CalendarID bigint(20) unsigned default NULL,
  Event varchar(255) default NULL,
  ProviderID bigint(20) unsigned default NULL,
  HostID bigint(20) unsigned default NULL,
  SymptomID bigint(20) unsigned default NULL,
  DispositionID bigint(20) unsigned default NULL,
  DiagnosisID bigint(20) unsigned default NULL,
  CurrentStatus int(10) unsigned default NULL,
  PRIMARY KEY  (ID),
  KEY indexMEDPAL (MEDPAL),
  KEY indexCalendarID (CalendarID),
  KEY indexProviderID (ProviderID),
  KEY indexHostID (HostID),
  KEY indexDiagnosisID (DiagnosisID),
  KEY indexEventTypeID (EventTypeID),
  KEY indexStatus (CurrentStatus)
) TYPE=MyISAM;

##
## Dumping data for table `ClientEventTBL`
##


INSERT INTO ClientEventTBL (ID, MEDPAL, EventTypeID, CalendarID, Event, ProviderID, HostID, SymptomID, DispositionID, DiagnosisID, CurrentStatus) VALUES (1,1,2,7,'Sprained Ankle',1,2,1,1,1,1);
INSERT INTO ClientEventTBL (ID, MEDPAL, EventTypeID, CalendarID, Event, ProviderID, HostID, SymptomID, DispositionID, DiagnosisID, CurrentStatus) VALUES (2,1,12,8,'Head Trama from Car Accident',1,2,2,2,2,1);
INSERT INTO ClientEventTBL (ID, MEDPAL, EventTypeID, CalendarID, Event, ProviderID, HostID, SymptomID, DispositionID, DiagnosisID, CurrentStatus) VALUES (3,1,8,9,'Appendectomy',5,1,3,3,3,1);
INSERT INTO ClientEventTBL (ID, MEDPAL, EventTypeID, CalendarID, Event, ProviderID, HostID, SymptomID, DispositionID, DiagnosisID, CurrentStatus) VALUES (4,1,5,1,'Physical',1,2,4,4,4,1);
INSERT INTO ClientEventTBL (ID, MEDPAL, EventTypeID, CalendarID, Event, ProviderID, HostID, SymptomID, DispositionID, DiagnosisID, CurrentStatus) VALUES (5,1,4,10,'Blood Work',1,1,NULL,NULL,NULL,1);
INSERT INTO ClientEventTBL (ID, MEDPAL, EventTypeID, CalendarID, Event, ProviderID, HostID, SymptomID, DispositionID, DiagnosisID, CurrentStatus) VALUES (6,1,2,25,'test test test',1,2,NULL,NULL,7,1);
INSERT INTO ClientEventTBL (ID, MEDPAL, EventTypeID, CalendarID, Event, ProviderID, HostID, SymptomID, DispositionID, DiagnosisID, CurrentStatus) VALUES (7,1,4,26,'Enamel test',2,3,NULL,NULL,6,1);
INSERT INTO ClientEventTBL (ID, MEDPAL, EventTypeID, CalendarID, Event, ProviderID, HostID, SymptomID, DispositionID, DiagnosisID, CurrentStatus) VALUES (8,1,2,27,'Hit mail box on Segway',5,5,NULL,NULL,8,0);
INSERT INTO ClientEventTBL (ID, MEDPAL, EventTypeID, CalendarID, Event, ProviderID, HostID, SymptomID, DispositionID, DiagnosisID, CurrentStatus) VALUES (9,1,4,28,'Stubbed my toe',4,2,NULL,NULL,9,0);
INSERT INTO ClientEventTBL (ID, MEDPAL, EventTypeID, CalendarID, Event, ProviderID, HostID, SymptomID, DispositionID, DiagnosisID, CurrentStatus) VALUES (10,1,3,29,'Teeth cleaning',2,3,NULL,NULL,NULL,0);
INSERT INTO ClientEventTBL (ID, MEDPAL, EventTypeID, CalendarID, Event, ProviderID, HostID, SymptomID, DispositionID, DiagnosisID, CurrentStatus) VALUES (11,5,2,39,'Sprained back',6,8,NULL,NULL,NULL,0);
INSERT INTO ClientEventTBL (ID, MEDPAL, EventTypeID, CalendarID, Event, ProviderID, HostID, SymptomID, DispositionID, DiagnosisID, CurrentStatus) VALUES (12,15,91,58,'HIPAA Authorization form',17,18,NULL,NULL,10,1);
INSERT INTO ClientEventTBL (ID, MEDPAL, EventTypeID, CalendarID, Event, ProviderID, HostID, SymptomID, DispositionID, DiagnosisID, CurrentStatus) VALUES (13,15,91,59,'Made a request for medical records',17,18,NULL,NULL,12,1);
INSERT INTO ClientEventTBL (ID, MEDPAL, EventTypeID, CalendarID, Event, ProviderID, HostID, SymptomID, DispositionID, DiagnosisID, CurrentStatus) VALUES (14,15,91,60,'Made a request for medical records',17,18,NULL,NULL,11,1);
INSERT INTO ClientEventTBL (ID, MEDPAL, EventTypeID, CalendarID, Event, ProviderID, HostID, SymptomID, DispositionID, DiagnosisID, CurrentStatus) VALUES (15,15,16,61,'Medical Reports sent to Dr. Tirmizi',15,17,NULL,NULL,13,1);

##
## Table structure for table `ClientExternalTBL`
##

DROP TABLE IF EXISTS ClientExternalTBL;
CREATE TABLE ClientExternalTBL (
  MEDPAL bigint(20) unsigned NOT NULL default '0',
  Height varchar(10) default NULL,
  Weight int(10) unsigned default NULL,
  Sex char(1) default NULL,
  EyeColor varchar(10) default NULL,
  Eyes varchar(25) default NULL,
  Glasses char(1) default NULL,
  Vision varchar(25) default NULL,
  HairColor varchar(25) default NULL,
  Hearing varchar(25) default NULL,
  Ears varchar(25) default NULL,
  HearingAide char(1) default NULL,
  Nose varchar(25) default NULL,
  Mouth varchar(25) default NULL,
  Teeth varchar(25) default NULL,
  Prosthesis varchar(45) default NULL,
  Skin varchar(25) default NULL,
  PRIMARY KEY  (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `ClientExternalTBL`
##


INSERT INTO ClientExternalTBL (MEDPAL, Height, Weight, Sex, EyeColor, Eyes, Glasses, Vision, HairColor, Hearing, Ears, HearingAide, Nose, Mouth, Teeth, Prosthesis, Skin) VALUES (1,'6~2',220,'M','Hazel','Good','N','20/15','Grey','Good','Good','N','Good','Good','Good','None','Good');
INSERT INTO ClientExternalTBL (MEDPAL, Height, Weight, Sex, EyeColor, Eyes, Glasses, Vision, HairColor, Hearing, Ears, HearingAide, Nose, Mouth, Teeth, Prosthesis, Skin) VALUES (2,'6~2',175,'M','Brown','Good','Y','30 20','Brown','Good','Good','N','Good','Good','Good','None','Good');
INSERT INTO ClientExternalTBL (MEDPAL, Height, Weight, Sex, EyeColor, Eyes, Glasses, Vision, HairColor, Hearing, Ears, HearingAide, Nose, Mouth, Teeth, Prosthesis, Skin) VALUES (8,'5~9',145,'F','Brown','Good','N','20/20','Brown','Good','Good','N','Good','Good','Good','None','Good');
INSERT INTO ClientExternalTBL (MEDPAL, Height, Weight, Sex, EyeColor, Eyes, Glasses, Vision, HairColor, Hearing, Ears, HearingAide, Nose, Mouth, Teeth, Prosthesis, Skin) VALUES (7,'5~7',145,'F','Blue','Good','N','20/20','Blonde','Good','Good','N','Good','Good','Good','None','Good');
INSERT INTO ClientExternalTBL (MEDPAL, Height, Weight, Sex, EyeColor, Eyes, Glasses, Vision, HairColor, Hearing, Ears, HearingAide, Nose, Mouth, Teeth, Prosthesis, Skin) VALUES (6,'6~5',200,'M','Brown','Good','N','20/20','Brown','Good','Good','N','Good','Good','Good','None','Good');
INSERT INTO ClientExternalTBL (MEDPAL, Height, Weight, Sex, EyeColor, Eyes, Glasses, Vision, HairColor, Hearing, Ears, HearingAide, Nose, Mouth, Teeth, Prosthesis, Skin) VALUES (5,'6~4',180,'M','Blue','Good','N','20/20','Blond','Good','Good','N','Good','Good','Good','None','Good');
INSERT INTO ClientExternalTBL (MEDPAL, Height, Weight, Sex, EyeColor, Eyes, Glasses, Vision, HairColor, Hearing, Ears, HearingAide, Nose, Mouth, Teeth, Prosthesis, Skin) VALUES (12,'5~7',140,'F','Brown','Good','Y','20/60','Blonde','Good','Good','N','Good','Good','Good','None','Good');
INSERT INTO ClientExternalTBL (MEDPAL, Height, Weight, Sex, EyeColor, Eyes, Glasses, Vision, HairColor, Hearing, Ears, HearingAide, Nose, Mouth, Teeth, Prosthesis, Skin) VALUES (14,'5~2',40,'M','Brown','Good','N','20/20','Blonde','Good','Good','N','Good','Good','Good','None','Good');
INSERT INTO ClientExternalTBL (MEDPAL, Height, Weight, Sex, EyeColor, Eyes, Glasses, Vision, HairColor, Hearing, Ears, HearingAide, Nose, Mouth, Teeth, Prosthesis, Skin) VALUES (9,'6~5',35,'F','Blue','Good','Y','20/20','Brown','Good','Good','N','Good','Good','Good','None','Good');

##
## Table structure for table `ClientFamilyHistoryTBL`
##

DROP TABLE IF EXISTS ClientFamilyHistoryTBL;
CREATE TABLE ClientFamilyHistoryTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  MEDPAL bigint(20) unsigned default NULL,
  RelationshipTypeID int(10) unsigned default NULL,
  MedicalConditionID int(10) unsigned default NULL,
  FamilyResponce char(1) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;
##
## Dumping data for table `ClientFamilyHistoryTBL`
##



##
## Table structure for table `ClientFamilyTypeTBL`
##

DROP TABLE IF EXISTS ClientFamilyTypeTBL;
CREATE TABLE ClientFamilyTypeTBL (
  ID int(10) unsigned NOT NULL default '0',
  Description varchar(45) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `ClientFamilyTypeTBL`
##


INSERT INTO ClientFamilyTypeTBL (ID, Description) VALUES (1,'Spouse');
INSERT INTO ClientFamilyTypeTBL (ID, Description) VALUES (2,'Siblings');
INSERT INTO ClientFamilyTypeTBL (ID, Description) VALUES (3,'Parents');
INSERT INTO ClientFamilyTypeTBL (ID, Description) VALUES (4,'Children');
INSERT INTO ClientFamilyTypeTBL (ID, Description) VALUES (5,'Family');
INSERT INTO ClientFamilyTypeTBL (ID, Description) VALUES (6,'Guardian');
INSERT INTO ClientFamilyTypeTBL (ID, Description) VALUES (7,'Other');

##
## Table structure for table `ClientHostTBL`
##

DROP TABLE IF EXISTS ClientHostTBL;
CREATE TABLE ClientHostTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  MEDPAL bigint(20) unsigned default NULL,
  HostID bigint(20) unsigned default NULL,
  PRIMARY KEY  (ID),
  KEY indexMEDPAL (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `ClientHostTBL`
##


INSERT INTO ClientHostTBL (ID, MEDPAL, HostID) VALUES (1,1,10);
INSERT INTO ClientHostTBL (ID, MEDPAL, HostID) VALUES (3,1,6);
INSERT INTO ClientHostTBL (ID, MEDPAL, HostID) VALUES (4,1,1);
INSERT INTO ClientHostTBL (ID, MEDPAL, HostID) VALUES (5,1,3);
INSERT INTO ClientHostTBL (ID, MEDPAL, HostID) VALUES (6,1,2);

##
## Table structure for table `ClientInternalTBL`
##

DROP TABLE IF EXISTS ClientInternalTBL;
CREATE TABLE ClientInternalTBL (
  MEDPAL bigint(20) unsigned NOT NULL default '0',
  BloodType varchar(25) default NULL,
  SystolicPressure int(10) unsigned default NULL,
  DiastolicPressure int(10) unsigned default NULL,
  LDL int(10) unsigned default NULL,
  HDL int(10) unsigned default NULL,
  Skeletal varchar(255) default NULL,
  Muscular varchar(255) default NULL,
  Digestive varchar(255) default NULL,
  Respiratory varchar(255) default NULL,
  Urinary varchar(255) default NULL,
  Nervous varchar(255) default NULL,
  Circulatory varchar(255) default NULL,
  Endocrine varchar(255) default NULL,
  Reproductive varchar(255) default NULL,
  Immune varchar(255) default NULL,
  PRIMARY KEY  (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `ClientInternalTBL`
##


INSERT INTO ClientInternalTBL (MEDPAL, BloodType, SystolicPressure, DiastolicPressure, LDL, HDL, Skeletal, Muscular, Digestive, Respiratory, Urinary, Nervous, Circulatory, Endocrine, Reproductive, Immune) VALUES (1,'O Positive',80,120,110,76,'No issues','No Issues','Some gasroentritous years before','Prone to bronchites','No Issues','No Issues','Heart flutter','No Issues','No Issues','No Issues');
INSERT INTO ClientInternalTBL (MEDPAL, BloodType, SystolicPressure, DiastolicPressure, LDL, HDL, Skeletal, Muscular, Digestive, Respiratory, Urinary, Nervous, Circulatory, Endocrine, Reproductive, Immune) VALUES (5,'O Positive',0,0,0,0,'','','','','','','','','','');

##
## Table structure for table `ClientPayorTBL`
##

DROP TABLE IF EXISTS ClientPayorTBL;
CREATE TABLE ClientPayorTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  MEDPAL bigint(20) NOT NULL default '0',
  TypeID int(10) unsigned NOT NULL default '0',
  PayorID bigint(20) default NULL,
  GroupID varchar(25) default NULL,
  SubscriberID varchar(25) default NULL,
  PrimaryInsuredID bigint(20) default NULL,
  PrimaryProviderID bigint(20) default NULL,
  OfficeCoPay varchar(45) default NULL,
  PRIMARY KEY  (ID),
  KEY indexType (TypeID),
  KEY indexMEDPAL (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `ClientPayorTBL`
##


INSERT INTO ClientPayorTBL (ID, MEDPAL, TypeID, PayorID, GroupID, SubscriberID, PrimaryInsuredID, PrimaryProviderID, OfficeCoPay) VALUES (6,1,1,1,'930','0243682951',1,1,'75.00');
INSERT INTO ClientPayorTBL (ID, MEDPAL, TypeID, PayorID, GroupID, SubscriberID, PrimaryInsuredID, PrimaryProviderID, OfficeCoPay) VALUES (7,1,2,2,'23','0185555',22,2,'50.00');
INSERT INTO ClientPayorTBL (ID, MEDPAL, TypeID, PayorID, GroupID, SubscriberID, PrimaryInsuredID, PrimaryProviderID, OfficeCoPay) VALUES (8,2,1,4,'8455544','99',28,4,'50.00');
INSERT INTO ClientPayorTBL (ID, MEDPAL, TypeID, PayorID, GroupID, SubscriberID, PrimaryInsuredID, PrimaryProviderID, OfficeCoPay) VALUES (9,2,2,2,'00091881','99',29,2,'80%');
INSERT INTO ClientPayorTBL (ID, MEDPAL, TypeID, PayorID, GroupID, SubscriberID, PrimaryInsuredID, PrimaryProviderID, OfficeCoPay) VALUES (10,5,2,2,'772','0298887652',33,7,'80 %');
INSERT INTO ClientPayorTBL (ID, MEDPAL, TypeID, PayorID, GroupID, SubscriberID, PrimaryInsuredID, PrimaryProviderID, OfficeCoPay) VALUES (11,5,1,1,'87777616','0298887652',34,6,'50');
INSERT INTO ClientPayorTBL (ID, MEDPAL, TypeID, PayorID, GroupID, SubscriberID, PrimaryInsuredID, PrimaryProviderID, OfficeCoPay) VALUES (12,12,1,5,'46312','566555',42,10,'$5');
INSERT INTO ClientPayorTBL (ID, MEDPAL, TypeID, PayorID, GroupID, SubscriberID, PrimaryInsuredID, PrimaryProviderID, OfficeCoPay) VALUES (13,13,1,1,'46312','46321',51,13,'$5');
INSERT INTO ClientPayorTBL (ID, MEDPAL, TypeID, PayorID, GroupID, SubscriberID, PrimaryInsuredID, PrimaryProviderID, OfficeCoPay) VALUES (14,12,2,2,'789456','456123',52,10,'none');
INSERT INTO ClientPayorTBL (ID, MEDPAL, TypeID, PayorID, GroupID, SubscriberID, PrimaryInsuredID, PrimaryProviderID, OfficeCoPay) VALUES (15,14,1,1,'46312','556665',55,13,'$5');
INSERT INTO ClientPayorTBL (ID, MEDPAL, TypeID, PayorID, GroupID, SubscriberID, PrimaryInsuredID, PrimaryProviderID, OfficeCoPay) VALUES (16,14,2,2,'789456','456123',56,14,'none');
INSERT INTO ClientPayorTBL (ID, MEDPAL, TypeID, PayorID, GroupID, SubscriberID, PrimaryInsuredID, PrimaryProviderID, OfficeCoPay) VALUES (17,9,1,4,'Test','005-77-009',59,7,'10');
INSERT INTO ClientPayorTBL (ID, MEDPAL, TypeID, PayorID, GroupID, SubscriberID, PrimaryInsuredID, PrimaryProviderID, OfficeCoPay) VALUES (18,9,2,2,'550-660','345-67-8900',60,7,'50');

##
## Table structure for table `ClientPharmacyTBL`
##

DROP TABLE IF EXISTS ClientPharmacyTBL;
CREATE TABLE ClientPharmacyTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  OrderID int(10) unsigned default NULL,
  MEDPAL bigint(20) unsigned default NULL,
  PharmacyID bigint(20) unsigned default NULL,
  PRIMARY KEY  (ID),
  KEY indexMEDPAL (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `ClientPharmacyTBL`
##


INSERT INTO ClientPharmacyTBL (ID, OrderID, MEDPAL, PharmacyID) VALUES (1,1,1,1);
INSERT INTO ClientPharmacyTBL (ID, OrderID, MEDPAL, PharmacyID) VALUES (2,2,1,3);
INSERT INTO ClientPharmacyTBL (ID, OrderID, MEDPAL, PharmacyID) VALUES (4,1,5,4);
INSERT INTO ClientPharmacyTBL (ID, OrderID, MEDPAL, PharmacyID) VALUES (5,1,2,4);
INSERT INTO ClientPharmacyTBL (ID, OrderID, MEDPAL, PharmacyID) VALUES (6,2,2,2);
INSERT INTO ClientPharmacyTBL (ID, OrderID, MEDPAL, PharmacyID) VALUES (7,2,5,2);
INSERT INTO ClientPharmacyTBL (ID, OrderID, MEDPAL, PharmacyID) VALUES (8,1,3,1);
INSERT INTO ClientPharmacyTBL (ID, OrderID, MEDPAL, PharmacyID) VALUES (9,1,7,1);
INSERT INTO ClientPharmacyTBL (ID, OrderID, MEDPAL, PharmacyID) VALUES (10,1,6,3);
INSERT INTO ClientPharmacyTBL (ID, OrderID, MEDPAL, PharmacyID) VALUES (11,2,6,1);
INSERT INTO ClientPharmacyTBL (ID, OrderID, MEDPAL, PharmacyID) VALUES (12,3,1,2);
INSERT INTO ClientPharmacyTBL (ID, OrderID, MEDPAL, PharmacyID) VALUES (13,1,9,1);
INSERT INTO ClientPharmacyTBL (ID, OrderID, MEDPAL, PharmacyID) VALUES (14,2,9,3);
INSERT INTO ClientPharmacyTBL (ID, OrderID, MEDPAL, PharmacyID) VALUES (15,1,12,5);
INSERT INTO ClientPharmacyTBL (ID, OrderID, MEDPAL, PharmacyID) VALUES (16,1,14,5);
INSERT INTO ClientPharmacyTBL (ID, OrderID, MEDPAL, PharmacyID) VALUES (17,1,13,5);
INSERT INTO ClientPharmacyTBL (ID, OrderID, MEDPAL, PharmacyID) VALUES (18,1,15,6);

##
## Table structure for table `ClientPrescriptionTBL`
##

DROP TABLE IF EXISTS ClientPrescriptionTBL;
CREATE TABLE ClientPrescriptionTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  MEDPAL bigint(20) unsigned NOT NULL default '0',
  PrescrNbr bigint(20) unsigned NOT NULL default '0',
  CalendarID bigint(20) unsigned default NULL,
  PharmacyID bigint(20) unsigned default NULL,
  Medication varchar(255) default NULL,
  Condition varchar(255) default NULL,
  ProviderID bigint(20) unsigned default NULL,
  HostID bigint(20) unsigned default NULL,
  UnitSz varchar(25) default NULL,
  Quantity varchar(25) NOT NULL default '',
  Dosage varchar(45) default NULL,
  Directions varchar(255) default NULL,
  PRIMARY KEY  (ID),
  KEY indexEndDate (CalendarID),
  KEY indexPrescNbr (PrescrNbr),
  KEY indexMEDPAL (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `ClientPrescriptionTBL`
##


INSERT INTO ClientPrescriptionTBL (ID, MEDPAL, PrescrNbr, CalendarID, PharmacyID, Medication, Condition, ProviderID, HostID, UnitSz, Quantity, Dosage, Directions) VALUES (1,1,887,4,1,'Asprin','Sprained ankle',1,2,'250mg','300','500 mgs','3 times per day');
INSERT INTO ClientPrescriptionTBL (ID, MEDPAL, PrescrNbr, CalendarID, PharmacyID, Medication, Condition, ProviderID, HostID, UnitSz, Quantity, Dosage, Directions) VALUES (2,1,0,5,2,'medication','test condition',2,6,'unit size','Quantity test','dosage','directions');
INSERT INTO ClientPrescriptionTBL (ID, MEDPAL, PrescrNbr, CalendarID, PharmacyID, Medication, Condition, ProviderID, HostID, UnitSz, Quantity, Dosage, Directions) VALUES (3,1,836763,6,3,'eye droplets','Tied eyes',4,1,'2 drops','2 drops','3 drops','twice at night before bed');
INSERT INTO ClientPrescriptionTBL (ID, MEDPAL, PrescrNbr, CalendarID, PharmacyID, Medication, Condition, ProviderID, HostID, UnitSz, Quantity, Dosage, Directions) VALUES (4,1,888,21,2,'Zelach','Pinched Nerve',5,NULL,'5mg','2','10mg','at night');
INSERT INTO ClientPrescriptionTBL (ID, MEDPAL, PrescrNbr, CalendarID, PharmacyID, Medication, Condition, ProviderID, HostID, UnitSz, Quantity, Dosage, Directions) VALUES (5,1,662726,22,2,'darvon','New Years party hangover',5,NULL,'250 mg','200','500 mgs','2 in the morning');
INSERT INTO ClientPrescriptionTBL (ID, MEDPAL, PrescrNbr, CalendarID, PharmacyID, Medication, Condition, ProviderID, HostID, UnitSz, Quantity, Dosage, Directions) VALUES (7,5,299928001,37,4,'Demerall','Broken Ribs',6,NULL,'25mg','50','50mg','Take 2 when you feel pain');
INSERT INTO ClientPrescriptionTBL (ID, MEDPAL, PrescrNbr, CalendarID, PharmacyID, Medication, Condition, ProviderID, HostID, UnitSz, Quantity, Dosage, Directions) VALUES (8,5,998272,38,4,'Alminol','Tooth Ache',7,NULL,'10mg','25','30mg','3 Before bed');
INSERT INTO ClientPrescriptionTBL (ID, MEDPAL, PrescrNbr, CalendarID, PharmacyID, Medication, Condition, ProviderID, HostID, UnitSz, Quantity, Dosage, Directions) VALUES (9,7,9837738,42,1,'Motrin','Feavor',6,NULL,'10mg','100','20mg','Take with food');
INSERT INTO ClientPrescriptionTBL (ID, MEDPAL, PrescrNbr, CalendarID, PharmacyID, Medication, Condition, ProviderID, HostID, UnitSz, Quantity, Dosage, Directions) VALUES (10,1,887,48,1,'Asprin','Sprained ankle',1,NULL,'250mg','300','500 mgs','3 times per day');
INSERT INTO ClientPrescriptionTBL (ID, MEDPAL, PrescrNbr, CalendarID, PharmacyID, Medication, Condition, ProviderID, HostID, UnitSz, Quantity, Dosage, Directions) VALUES (11,1,836763,49,3,'eye droplets','Tied eyes',4,NULL,'2 drops','2 drops','3 drops','twice at night before bed');
INSERT INTO ClientPrescriptionTBL (ID, MEDPAL, PrescrNbr, CalendarID, PharmacyID, Medication, Condition, ProviderID, HostID, UnitSz, Quantity, Dosage, Directions) VALUES (12,1,888,50,2,'Zelach','Pinched Nerve',5,NULL,'5mg','2','10mg','at night');

##
## Table structure for table `ClientProviderTBL`
##

DROP TABLE IF EXISTS ClientProviderTBL;
CREATE TABLE ClientProviderTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  OrderID int(10) unsigned default NULL,
  MEDPAL bigint(20) unsigned default NULL,
  ProviderID bigint(20) unsigned default NULL,
  PRIMARY KEY  (ID),
  KEY indexMEDPAL (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `ClientProviderTBL`
##


INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (30,1,15,15);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (2,2,1,3);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (3,3,1,5);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (6,4,1,2);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (8,2,5,7);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (7,1,5,6);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (9,1,2,4);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (10,2,2,3);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (11,3,2,2);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (12,3,5,3);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (13,1,3,6);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (14,2,3,3);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (15,1,7,6);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (16,2,7,2);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (17,1,6,1);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (18,2,6,7);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (19,1,12,9);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (20,2,12,10);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (21,3,12,11);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (22,4,12,12);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (23,1,14,13);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (24,2,14,14);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (25,1,13,13);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (26,2,13,14);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (27,1,9,7);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (28,2,9,5);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (29,5,1,1);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (31,2,15,16);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (32,3,15,17);
INSERT INTO ClientProviderTBL (ID, OrderID, MEDPAL, ProviderID) VALUES (33,5,1,999);

##
## Table structure for table `ClientRequestHistoryTBL`
##

DROP TABLE IF EXISTS ClientRequestHistoryTBL;
CREATE TABLE ClientRequestHistoryTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  RequestID bigint(20) unsigned default NULL,
  MEDPAL bigint(20) unsigned default NULL,
  RequestHistDateTime datetime default NULL,
  RequestStatus int(10) unsigned default NULL,
  PRIMARY KEY  (ID),
  KEY indexRequestID (RequestID),
  KEY indexMedpal (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `ClientRequestHistoryTBL`
##


INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (33,1,1,'2004-02-03 08:33:20',1);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (32,2,1,'2004-01-11 14:37:17',6);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (31,1,1,'2004-01-10 20:49:57',1);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (30,2,1,'2004-01-09 22:08:13',2);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (29,2,1,'2004-01-09 22:07:01',2);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (28,2,1,'2004-01-09 22:06:55',2);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (27,2,1,'2004-01-09 22:06:36',2);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (26,2,1,'2004-01-09 22:06:15',0);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (25,2,1,'2004-01-09 22:01:38',2);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (24,2,1,'2004-01-09 22:01:29',0);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (23,2,1,'2004-01-09 21:59:33',2);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (22,2,1,'2004-01-09 21:59:16',0);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (21,2,1,'2004-01-09 21:59:08',2);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (20,2,1,'2004-01-09 21:58:46',0);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (19,2,1,'2004-01-09 21:46:07',1);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (18,1,1,'2004-01-05 20:41:56',1);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (34,3,1,'2004-02-03 08:34:36',1);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (35,4,5,'2004-02-20 21:59:28',1);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (36,2,1,'2004-03-07 12:15:10',6);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (37,1,1,'2004-04-06 14:29:35',2);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (38,5,15,'2004-04-07 15:27:27',1);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (39,6,15,'2004-04-07 15:28:39',1);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (40,5,15,'2004-04-07 15:55:05',12);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (41,6,15,'2004-04-07 15:56:21',12);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (42,7,15,'2004-04-07 15:58:02',1);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (43,7,15,'2004-04-07 16:03:32',6);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (44,7,15,'2004-04-07 16:04:26',8);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (45,7,15,'2004-04-07 16:04:35',9);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (46,7,15,'2004-04-07 16:05:29',11);
INSERT INTO ClientRequestHistoryTBL (ID, RequestID, MEDPAL, RequestHistDateTime, RequestStatus) VALUES (47,7,15,'2004-04-07 16:05:38',12);

##
## Table structure for table `ClientRequestTBL`
##

DROP TABLE IF EXISTS ClientRequestTBL;
CREATE TABLE ClientRequestTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  MEDPAL bigint(20) unsigned NOT NULL default '0',
  RequestDateTime datetime default NULL,
  CurrentStatus int(10) unsigned default NULL,
  Request varchar(255) default NULL,
  ClientEventID bigint(20) unsigned default NULL,
  Comments varchar(255) default NULL,
  PRIMARY KEY  (ID),
  KEY indexMEDPAL (MEDPAL),
  KEY indexCurrentStatus (CurrentStatus),
  KEY indexRequestDateTime (RequestDateTime)
) TYPE=MyISAM;

##
## Dumping data for table `ClientRequestTBL`
##


INSERT INTO ClientRequestTBL (ID, MEDPAL, RequestDateTime, CurrentStatus, Request, ClientEventID, Comments) VALUES (1,1,'2004-01-05 20:41:56',2,'Hit mail box on Segway',8,'Ouch');
INSERT INTO ClientRequestTBL (ID, MEDPAL, RequestDateTime, CurrentStatus, Request, ClientEventID, Comments) VALUES (2,1,'2004-01-09 21:46:07',6,'Stubbed my toe',9,'try try try again');
INSERT INTO ClientRequestTBL (ID, MEDPAL, RequestDateTime, CurrentStatus, Request, ClientEventID, Comments) VALUES (3,1,'2004-02-03 08:34:36',1,'Teeth cleaning',10,NULL);
INSERT INTO ClientRequestTBL (ID, MEDPAL, RequestDateTime, CurrentStatus, Request, ClientEventID, Comments) VALUES (4,5,'2004-02-20 21:59:28',1,'Sprained back',11,NULL);
INSERT INTO ClientRequestTBL (ID, MEDPAL, RequestDateTime, CurrentStatus, Request, ClientEventID, Comments) VALUES (5,15,'2004-04-07 15:27:27',12,'Made a request for medical records',13,'');
INSERT INTO ClientRequestTBL (ID, MEDPAL, RequestDateTime, CurrentStatus, Request, ClientEventID, Comments) VALUES (6,15,'2004-04-07 15:28:39',12,'Made a request for medical records',14,'');
INSERT INTO ClientRequestTBL (ID, MEDPAL, RequestDateTime, CurrentStatus, Request, ClientEventID, Comments) VALUES (7,15,'2004-04-07 15:58:02',12,'Medical Reports sent to Dr. Tirmizi',15,'');

##
## Table structure for table `ClientRulesTBL`
##

DROP TABLE IF EXISTS ClientRulesTBL;
CREATE TABLE ClientRulesTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  MEDPAL bigint(20) unsigned default NULL,
  RuleEventTypeID int(10) unsigned default NULL,
  RuleActionID int(10) unsigned default NULL,
  RuleInterval int(10) unsigned default NULL,
  PRIMARY KEY  (ID),
  KEY indexMedpal (MEDPAL),
  KEY indexAction (RuleActionID)
) TYPE=MyISAM;

##
## Dumping data for table `ClientRulesTBL`
##


INSERT INTO ClientRulesTBL (ID, MEDPAL, RuleEventTypeID, RuleActionID, RuleInterval) VALUES (1,1,1,1,3);
INSERT INTO ClientRulesTBL (ID, MEDPAL, RuleEventTypeID, RuleActionID, RuleInterval) VALUES (3,1,5,2,5);
INSERT INTO ClientRulesTBL (ID, MEDPAL, RuleEventTypeID, RuleActionID, RuleInterval) VALUES (5,1,2,3,2);
INSERT INTO ClientRulesTBL (ID, MEDPAL, RuleEventTypeID, RuleActionID, RuleInterval) VALUES (6,5,2,1,2);
INSERT INTO ClientRulesTBL (ID, MEDPAL, RuleEventTypeID, RuleActionID, RuleInterval) VALUES (7,15,2,1,5);

##
## Table structure for table `ClientSocialProfileTBL`
##

DROP TABLE IF EXISTS ClientSocialProfileTBL;
CREATE TABLE ClientSocialProfileTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  MEDPAL bigint(20) unsigned NOT NULL default '0',
  FormerSmoker char(1) default NULL,
  CurSmoker char(1) default NULL,
  SmokerperMonth int(10) unsigned default NULL,
  SmokerType varchar(15) default NULL,
  SmokerYears int(10) unsigned default NULL,
  Alcohol char(1) default NULL,
  AlcoholperMonth int(10) unsigned default NULL,
  Exersize char(1) default NULL,
  ExersizeperMonth int(10) unsigned default NULL,
  ExersizeDescription varchar(50) default NULL,
  SubstanceAbuse char(1) default NULL,
  SubstanceAbuseDescription varchar(50) default NULL,
  Diet char(1) default NULL,
  DietDescription varchar(50) default NULL,
  PRIMARY KEY  (ID),
  KEY indexMEDPAL (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `ClientSocialProfileTBL`
##



##
## Table structure for table `ClientSpecialInstructionsTBL`
##

DROP TABLE IF EXISTS ClientSpecialInstructionsTBL;
CREATE TABLE ClientSpecialInstructionsTBL (
  ID bigint(20) NOT NULL auto_increment,
  MEDPAL bigint(20) unsigned NOT NULL default '0',
  OrderID int(10) unsigned NOT NULL default '0',
  SpecialInstructions varchar(255) default NULL,
  PRIMARY KEY  (ID),
  KEY indexMEDPAL (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `ClientSpecialInstructionsTBL`
##


INSERT INTO ClientSpecialInstructionsTBL (ID, MEDPAL, OrderID, SpecialInstructions) VALUES (1,1,1,'Due to Heart valvle issues this person must Premedicate before dental work or any other minor surgical procedure');
INSERT INTO ClientSpecialInstructionsTBL (ID, MEDPAL, OrderID, SpecialInstructions) VALUES (2,5,1,'Special');

##
## Table structure for table `ClientSymptomTBL`
##

DROP TABLE IF EXISTS ClientSymptomTBL;
CREATE TABLE ClientSymptomTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  MEDPAL bigint(20) unsigned default NULL,
  TypeID int(10) unsigned default NULL,
  Symptom varchar(255) default NULL,
  PRIMARY KEY  (ID),
  KEY indexMEDPAL (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `ClientSymptomTBL`
##



##
## Table structure for table `ClientTBL`
##

DROP TABLE IF EXISTS ClientTBL;
CREATE TABLE ClientTBL (
  MEDPAL bigint(20) unsigned NOT NULL default '0',
  FullNameID bigint(20) unsigned default NULL,
  DOB date default NULL,
  PhotoID bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `ClientTBL`
##


INSERT INTO ClientTBL (MEDPAL, FullNameID, DOB, PhotoID) VALUES (1,1,'1953-02-04',3);
INSERT INTO ClientTBL (MEDPAL, FullNameID, DOB, PhotoID) VALUES (2,2,'1960-11-02',2);
INSERT INTO ClientTBL (MEDPAL, FullNameID, DOB, PhotoID) VALUES (3,3,'1943-06-22',8);
INSERT INTO ClientTBL (MEDPAL, FullNameID, DOB, PhotoID) VALUES (4,4,'1922-07-04',0);
INSERT INTO ClientTBL (MEDPAL, FullNameID, DOB, PhotoID) VALUES (5,5,'1985-12-24',7);
INSERT INTO ClientTBL (MEDPAL, FullNameID, DOB, PhotoID) VALUES (6,30,'1985-11-04',6);
INSERT INTO ClientTBL (MEDPAL, FullNameID, DOB, PhotoID) VALUES (7,31,'1982-12-15',5);
INSERT INTO ClientTBL (MEDPAL, FullNameID, DOB, PhotoID) VALUES (8,32,'1959-04-26',4);
INSERT INTO ClientTBL (MEDPAL, FullNameID, DOB, PhotoID) VALUES (9,38,'1958-06-08',9);
INSERT INTO ClientTBL (MEDPAL, FullNameID, DOB, PhotoID) VALUES (10,39,'1960-03-12',10);
INSERT INTO ClientTBL (MEDPAL, FullNameID, DOB, PhotoID) VALUES (11,40,'1960-04-12',0);
INSERT INTO ClientTBL (MEDPAL, FullNameID, DOB, PhotoID) VALUES (12,41,'1958-12-25',11);
INSERT INTO ClientTBL (MEDPAL, FullNameID, DOB, PhotoID) VALUES (13,49,'1994-04-28',13);
INSERT INTO ClientTBL (MEDPAL, FullNameID, DOB, PhotoID) VALUES (14,50,'1998-01-22',12);
INSERT INTO ClientTBL (MEDPAL, FullNameID, DOB, PhotoID) VALUES (15,62,'1926-01-05',14);
INSERT INTO ClientTBL (MEDPAL, FullNameID, DOB, PhotoID) VALUES (16,70,'1951-03-26',0);

##
## Table structure for table `ClientVaccInocTBL`
##

DROP TABLE IF EXISTS ClientVaccInocTBL;
CREATE TABLE ClientVaccInocTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  MEDPAL bigint(20) unsigned NOT NULL default '0',
  TypeID char(1) default NULL,
  CalendarID bigint(20) unsigned default NULL,
  Medication varchar(45) default NULL,
  ProviderID bigint(20) unsigned default NULL,
  VaccInocTypeID int(10) unsigned default NULL,
  PRIMARY KEY  (ID),
  KEY indexMEDPAL (MEDPAL)
) TYPE=MyISAM;

##
## Dumping data for table `ClientVaccInocTBL`
##


INSERT INTO ClientVaccInocTBL (ID, MEDPAL, TypeID, CalendarID, Medication, ProviderID, VaccInocTypeID) VALUES (1,1,'v',11,'oral polio vaccine (OPV)',1,12);
INSERT INTO ClientVaccInocTBL (ID, MEDPAL, TypeID, CalendarID, Medication, ProviderID, VaccInocTypeID) VALUES (2,1,'v',12,'diptheria-tetanus-acellular pertissis (DTaP)',1,5);
INSERT INTO ClientVaccInocTBL (ID, MEDPAL, TypeID, CalendarID, Medication, ProviderID, VaccInocTypeID) VALUES (3,1,'v',13,'Chemoprophylaxis',1,16);

##
## Table structure for table `DispositionTypeTBL`
##

DROP TABLE IF EXISTS DispositionTypeTBL;
CREATE TABLE DispositionTypeTBL (
  ID int(10) unsigned NOT NULL default '0',
  Description varchar(45) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `DispositionTypeTBL`
##


INSERT INTO DispositionTypeTBL (ID, Description) VALUES (1,'Cured');
INSERT INTO DispositionTypeTBL (ID, Description) VALUES (2,'Managed');
INSERT INTO DispositionTypeTBL (ID, Description) VALUES (3,'Open');

##
## Table structure for table `EventScanTBL`
##

DROP TABLE IF EXISTS EventScanTBL;
CREATE TABLE EventScanTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  ClientEventID bigint(20) unsigned default NULL,
  ScanID bigint(20) unsigned default NULL,
  EventScanInfo varchar(255) default NULL,
  ScanTypeID int(10) unsigned default NULL,
  PRIMARY KEY  (ID),
  KEY indexClientEventID (ClientEventID),
  KEY indexScanID (ScanID)
) TYPE=MyISAM;

##
## Dumping data for table `EventScanTBL`
##


INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (1,3,1,'Appendectimy Pathology',1);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (2,4,2,'Pysical Report',8);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (3,5,3,'Blood test Results',8);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (4,4,4,'Biopsy Letter',8);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (6,2,6,'Cat Scan 1',6);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (7,2,7,'Cat Scan 2',6);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (8,2,8,'Cat Scan 3',6);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (9,2,9,'Cat Scan 4',6);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (10,2,10,'Diagnosis',11);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (11,9,11,'test',7);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (12,9,12,'',91);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (13,9,13,'',91);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (14,9,14,'',91);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (15,9,15,'test again',91);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (16,1,16,'Ankle Angle 1',1);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (17,1,17,'Ankle Angle 2',1);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (18,1,18,'Ankle Angle 3',1);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (19,14,19,'HIPAA release form, page 1',3);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (20,14,20,'HIPAA release form, page 2',3);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (21,14,21,'Medical History form',3);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (22,14,22,'Medical History Form',3);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (23,14,23,'Recent problems report',8);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (24,14,24,'Physical Examination form',3);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (25,14,25,'Formulation Plans',2);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (26,14,26,'Multi Disciplinary Progress Notes',2);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (27,14,27,'Multi Disciplinary Progress Notes',2);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (28,14,28,'Laboratory - Hematology',8);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (29,14,29,'Laboratory - Chemistry',8);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (30,14,30,'Specimen Inquiry',7);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (31,14,31,'Transthoracic Echocariogram',4);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (32,14,32,'Transthoracic EchoCardiogram',4);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (33,14,33,'Colonoscopy Report',8);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (34,14,34,'Radiology Report',8);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (35,14,35,'Colonoscopy Report',8);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (36,14,36,'Surgical Pathology Report',8);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (37,14,37,'Laboratory - Chemistry and Hematology Report',8);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (38,15,38,'Letter from Dr. Lopkin to Dr. Tirmizi',2);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (39,15,39,'Final Report  re: chronic cough',8);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (40,15,40,'Cytology Report',8);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (41,15,41,'Bilateral Mamogram report',8);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (42,15,42,'ECG printout',4);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (43,15,43,'ECG printout',4);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (44,1,44,'Voice Test',12);
INSERT INTO EventScanTBL (ID, ClientEventID, ScanID, EventScanInfo, ScanTypeID) VALUES (45,1,45,'Video Test',13);

##
## Table structure for table `EventTypeTBL`
##

DROP TABLE IF EXISTS EventTypeTBL;
CREATE TABLE EventTypeTBL (
  ID int(10) unsigned NOT NULL default '0',
  EventType varchar(255) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `EventTypeTBL`
##


INSERT INTO EventTypeTBL (ID, EventType) VALUES (1,'Diagnosis or treatment');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (2,'General checkup');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (3,'Vision exam for glasses');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (4,'Maternity care (pre/postnatal)');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (5,'Well-child exam');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (6,'Immunizations');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (7,'Psychotherapy/Mental health counseling');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (8,'Reproductive services');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (9,'Foot care');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (10,'Physical therapy');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (11,'X-rays');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (12,'CATSCANS, sonograms, bodyscans');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (13,'Throat cultures, blood/urine testing');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (14,'Diagnostic testing');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (15,'Surgery/procedures');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (16,'Tests,unspecified');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (17,'Pre-admission testing');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (18,'Hearing tests');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (19,'Speech therapy');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (91,'Other');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (20,'Dental Exam');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (21,'Dental Cleaning');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (22,'Dental Surgery');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (23,'Dental Other');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (24,'Emergency');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (25,'Physical Exam');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (26,'Mammogram');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (27,'PAP Smear');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (28,'Colonoscopy');
INSERT INTO EventTypeTBL (ID, EventType) VALUES (29,'Prostate Exam');

##
## Table structure for table `FullNameTBL`
##

DROP TABLE IF EXISTS FullNameTBL;
CREATE TABLE FullNameTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  FirstName varchar(45) default NULL,
  LastName varchar(45) default NULL,
  MI char(1) default NULL,
  Prefix varchar(5) default NULL,
  Suffix varchar(5) default NULL,
  eMailAddr varchar(255) default NULL,
  PagerID varchar(15) default NULL,
  PagerTeleNbr varchar(15) default NULL,
  MobilePhone varchar(15) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `FullNameTBL`
##


INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (999,'* Attending *','* Provider *','','','','','','','');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (1,'Tarrant','Cutler','','Mr','Jr','tarrant.cutler@verizon.net','12345678','800-sky-telen','781-942-1982');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (2,'Steve','Paris','','Mr','','sparis@world.std.com','','','617-733-9599');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (3,'Dude','Ranch',NULL,'Sir',NULL,'dranch@atti.net','888123','800-234-1212','871-987-0023');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (4,'Down','South',NULL,'Ms',NULL,'ds@gp.net',NULL,NULL,'777-666-1234');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (5,'Sufer','Dude','','Yo','','sd@farout.com','743987','888-234-1234','723-397-8365');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (6,'Richard','Oliverio','','Mr','MD','ro@medicalgroup','888677','800-234-2929','987-837-3883');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (7,'Alice','Kaplan',NULL,'Ms','DMD','ak@comcast.net',NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (8,'John','Smith','J','Mr','MD','jjsmith@verizon.net','12345','888-123-8888','876-129-9389');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (9,'Chauncy','Seegood',NULL,'Mr','MD',NULL,NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (10,'Bartlet','Saunders','H','Mr','MD','bs@bsoc.net','8880923','800-222-1234','897-376-9802');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (11,'George','Jetson','','Mr','MD','gjetson@wayout.com','','','');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (12,'Alice','Cooper','','Ms','DMD','ac@hotmail.com','','','');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (13,'John','Brook','','Mr','','jbrook@verizon.net',NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (14,'Sally','Green','','Ms','','',NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (15,'Joan','CVS','','Ms','','',NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (21,'William','Cutler','E','Mr','',NULL,NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (22,'Janet','Cutler','C','Ms','',NULL,NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (23,'Robert','Johnson','M','Mr','III',NULL,NULL,NULL,'781-640-2974');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (24,'Janet','Cutler','M','Mrs','',NULL,NULL,NULL,'777-555-7878');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (25,'Robert','Hunt','J','Mr','III','rjh@cambridgerx.net',NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (27,'Tarrant','Cutler','','Mr','','tcutler@adelphia.net','888125','800-456-4452','978-456-8856');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (28,'Steven','Paris','','Mr','',NULL,NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (29,'Steve','Paris','','Mr','',NULL,NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (30,'William','Cutler','E','Mr','','william.cutler@verizon.net','','','781-308-4881');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (31,'Bridget','Cutler','M','Ms','','','','','');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (32,'Janet','Cutler','M','Mrs','','janet.cutler@verizon.net','','','781-308-0281');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (33,'Surfer','Dude','','Mr','',NULL,NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (34,'Surfer','Dude','','Mr','',NULL,NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (35,'Surfette','Dudette','','Ms','',NULL,NULL,NULL,'');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (36,'Fred','Manor','J','Mr','III','fred.manor@verizon.net',NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (37,'Robert','George','','Mr','','rg@verizon.net',NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (38,'Tamela','Jamieson','','Ms','','txjamieson@cs.com','','','xxffg');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (39,'Misha','Pivovarov','','Mr','','misha@pivovarov.com','','','781-929-7389');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (40,'Joan','Seamster','','Mrs','','jkseamster@yourinsights.biz','','','617-470-6091');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (41,'Sandra','Friedman','','Ms','','sfriedman@solorte.com','','','925-640-6036');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (42,'Rick','Friedman','P','Mr.','',NULL,NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (43,'Janice','Afruma','','Dr','MD','','','','');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (44,'Michael','Ranahan','','Dr','MD','','','','');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (45,'Loren','Kihlstrom','','Dr','DDS','','','','');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (46,'Thomas','Forest','J','Dr','DC','','','','');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (47,'Stephaen','Anantasiou','','Dr','','','','','');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (48,'Deanna','Aronoff','','Dr','DDS','','','','');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (49,'Callie','Friedman','C','Ms','','','','','');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (50,'Justin','Friedman','','Mr','','Justinfriedman@comcast.net','','','925-640-6036');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (51,'Rick','Friedman','P','Mr.','',NULL,NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (52,'Rick','Friedman','P','Mr.','',NULL,NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (53,'Rick','Friedman','P','Mr.','',NULL,NULL,NULL,'510-508-0808');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (54,'Darlene','Friedman','','Ms.','',NULL,NULL,NULL,'925-596-0140');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (55,'Rick','Friedman','P','Mr.','',NULL,NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (56,'Rick','Friedman','P','Mr.','',NULL,NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (57,'Sandra','Friedman','S','Ms.','',NULL,NULL,NULL,'925-640-6036');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (58,'Darlene','Friedman','','Ms.','',NULL,NULL,NULL,'925-596-0140');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (59,'tamela','Test','l','ms','',NULL,NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (60,'tamela','Jamieson','l','ms','',NULL,NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (61,'Some','Name','','','','',NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (62,'Frances','Paris','','','','sparis@world.std.com','','','');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (63,'Carl','Lopkin','','Dr.','','','','','');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (64,'Peter','Bendetson','R','Dr.','','','','','');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (65,'Ali','Tirmizi','','Dr.','','','','','');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (66,'John','Leary','','Mr.','','',NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (67,'Steven','Paris','M','Mr.','','sparis@world.std.com',NULL,NULL,NULL);
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (70,'Charles','Weisner','F','Mr.','','','','','');
INSERT INTO FullNameTBL (ID, FirstName, LastName, MI, Prefix, Suffix, eMailAddr, PagerID, PagerTeleNbr, MobilePhone) VALUES (71,'Elizabeth','Weisner','','Mrs.','','',NULL,NULL,NULL);

##
## Table structure for table `HostTBL`
##

DROP TABLE IF EXISTS HostTBL;
CREATE TABLE HostTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  TypeID int(10) unsigned default NULL,
  Name varchar(255) default NULL,
  AddrID bigint(20) unsigned default NULL,
  URL varchar(255) default NULL,
  Map varchar(255) default NULL,
  EmergNbr varchar(15) default NULL,
  PRIMARY KEY  (ID),
  KEY indexType (TypeID)
) TYPE=MyISAM;

##
## Dumping data for table `HostTBL`
##


INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (999,1,'** Unknown Host **',999,'',NULL,'');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (1,1,'Beverly Hospital',6,'www.beverlyhospital.com',NULL,'897-376-9802');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (2,2,'The Medical Group',7,NULL,NULL,'897-376-9802');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (3,2,'Kaplan Dental Associates',8,NULL,NULL,NULL);
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (4,2,'Southwest Dental',9,NULL,NULL,'897-376-9802');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (5,1,'Colorado General',10,NULL,NULL,'897-376-9802');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (6,3,'Atlanta Clinic',11,'',NULL,'123-456-7890');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (7,3,'Newton Dental Associates',12,'http://www.dfci.harvard.edu/',NULL,'781-944-1150');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (8,1,'Mass General',13,'http://www.mgh.harvard.edu/',NULL,'897-376-9802');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (9,4,'Northeast Blood Lab',27,'www.notheastblood.com',NULL,'800-777-4000');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (10,2,'Bay Valley Medical Group',41,'http://www.bayvalleymedicalgroup.com/',NULL,'');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (11,5,'Michael Ranahan MD',42,'',NULL,'');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (12,5,'Loren Kihlstrom DDS',43,'',NULL,'');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (13,2,'Forest Chiropractic Office',44,'',NULL,'');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (14,5,'Stephen Anantasiou MD',45,'',NULL,'');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (15,5,'Deanna Aronoff DDS MSD',46,'',NULL,'');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (16,1,'Beth Israel Hospital',61,'http://www.bidmc.harvard.edu',NULL,'');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (17,5,'Dr. Carl Lopkin',62,'',NULL,'');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (18,2,'Caritas Medical Group',63,'',NULL,'');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (19,5,'Dr. Peter Bendetson',64,'',NULL,'');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (20,12,'UMass Memorial-University Campus',71,'http://www.umassmed.edu',NULL,'(508) 856-5520');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (21,12,'Brigham and Women\'s Hospital',72,'http://www.brighamandwomens.org/',NULL,'(617) 732-5500');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (22,20,'Spaulding Rehabilitation Hospital',74,'http://www.spauldingrehab.org/',NULL,'617-573-7000');
INSERT INTO HostTBL (ID, TypeID, Name, AddrID, URL, Map, EmergNbr) VALUES (23,12,'Milford Whitinsville Regional Hospital',75,'http://www.milfordregional.com/',NULL,'508-473-1190');

##
## Table structure for table `HostTypeTBL`
##

DROP TABLE IF EXISTS HostTypeTBL;
CREATE TABLE HostTypeTBL (
  ID int(10) unsigned NOT NULL default '0',
  Description varchar(45) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `HostTypeTBL`
##


INSERT INTO HostTypeTBL (ID, Description) VALUES (1,'Doctors office or group practice');
INSERT INTO HostTypeTBL (ID, Description) VALUES (2,'Doctors clinic');
INSERT INTO HostTypeTBL (ID, Description) VALUES (3,'Neighborhood/family health center');
INSERT INTO HostTypeTBL (ID, Description) VALUES (4,'Free standing surgical center');
INSERT INTO HostTypeTBL (ID, Description) VALUES (5,'Company clinic');
INSERT INTO HostTypeTBL (ID, Description) VALUES (6,'School clinic');
INSERT INTO HostTypeTBL (ID, Description) VALUES (7,'Other clinic');
INSERT INTO HostTypeTBL (ID, Description) VALUES (8,'Home');
INSERT INTO HostTypeTBL (ID, Description) VALUES (9,'Laboratory');
INSERT INTO HostTypeTBL (ID, Description) VALUES (10,'Walk-in urgent center');
INSERT INTO HostTypeTBL (ID, Description) VALUES (11,'Hospital outpatient clinic');
INSERT INTO HostTypeTBL (ID, Description) VALUES (12,'Hospital inpatient clinic');
INSERT INTO HostTypeTBL (ID, Description) VALUES (19,'Dental clinic');
INSERT INTO HostTypeTBL (ID, Description) VALUES (20,'Long-term care facility');
INSERT INTO HostTypeTBL (ID, Description) VALUES (21,'Home health agency');
INSERT INTO HostTypeTBL (ID, Description) VALUES (22,'Optical store');
INSERT INTO HostTypeTBL (ID, Description) VALUES (23,'Radiology');
INSERT INTO HostTypeTBL (ID, Description) VALUES (24,'Ambulance service');
INSERT INTO HostTypeTBL (ID, Description) VALUES (25,'Emergency room');
INSERT INTO HostTypeTBL (ID, Description) VALUES (91,'Other');

##
## Table structure for table `MedicalConditionTBL`
##

DROP TABLE IF EXISTS MedicalConditionTBL;
CREATE TABLE MedicalConditionTBL (
  ID int(10) unsigned NOT NULL default '0',
  MedicalCondition varchar(50) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `MedicalConditionTBL`
##


INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (1,'Alcoholism');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (2,'Alzheimers Disease');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (3,'Anemia');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (4,'Anesthesia Problem');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (5,'Arthritis');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (6,'Autoimmune Disorder');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (7,'Bleeding Problem');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (8,'Cancer, Breast');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (9,'Cancer, Melanoma');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (10,'Cancer, Ovary');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (11,'Cancer, Prostate');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (12,'Cancer, Other');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (13,'Heart Attack (Coronary disorder)');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (14,'Birth Defects');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (15,'Depression');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (16,'Diabetes Type 1');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (17,'Diabetes Type 2');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (18,'Eczema');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (19,'Hearing Problems');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (20,'High Cholesterol');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (21,'High Blood Pressure');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (22,'Immunosuppressive Disorders');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (23,'Kidney Diseases');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (24,'Mental Retardation');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (25,'Epilepsy');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (26,'Stroke');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (27,'Substance Abuse');
INSERT INTO MedicalConditionTBL (ID, MedicalCondition) VALUES (28,'Thyroid Disorders');

##
## Table structure for table `NotesTBL`
##

DROP TABLE IF EXISTS NotesTBL;
CREATE TABLE NotesTBL (
  ID bigint(20) NOT NULL auto_increment,
  NoteText varchar(255) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `NotesTBL`
##



##
## Table structure for table `OperatingSystemTBL`
##

DROP TABLE IF EXISTS OperatingSystemTBL;
CREATE TABLE OperatingSystemTBL (
  ID int(10) unsigned NOT NULL default '0',
  OperatingSystem varchar(50) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `OperatingSystemTBL`
##


INSERT INTO OperatingSystemTBL (ID, OperatingSystem) VALUES (1,'Windows 95');
INSERT INTO OperatingSystemTBL (ID, OperatingSystem) VALUES (2,'Windows 98 First Edition');
INSERT INTO OperatingSystemTBL (ID, OperatingSystem) VALUES (3,'Windows 98 Second Addition');
INSERT INTO OperatingSystemTBL (ID, OperatingSystem) VALUES (4,'Windows XP Home');
INSERT INTO OperatingSystemTBL (ID, OperatingSystem) VALUES (5,'Windows XP Profesional');
INSERT INTO OperatingSystemTBL (ID, OperatingSystem) VALUES (6,'Windows NT');
INSERT INTO OperatingSystemTBL (ID, OperatingSystem) VALUES (7,'Windows 2000');
INSERT INTO OperatingSystemTBL (ID, OperatingSystem) VALUES (8,'Linux');
INSERT INTO OperatingSystemTBL (ID, OperatingSystem) VALUES (9,'Other Unix');
INSERT INTO OperatingSystemTBL (ID, OperatingSystem) VALUES (10,'Apple OS X');
INSERT INTO OperatingSystemTBL (ID, OperatingSystem) VALUES (11,'Apple Macintosh');
INSERT INTO OperatingSystemTBL (ID, OperatingSystem) VALUES (12,'Other');

##
## Table structure for table `PayorTBL`
##

DROP TABLE IF EXISTS PayorTBL;
CREATE TABLE PayorTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  TypeID int(10) unsigned default NULL,
  Name varchar(255) default NULL,
  URL varchar(255) default NULL,
  AddrID bigint(20) unsigned default NULL,
  PRIMARY KEY  (ID),
  KEY indexType (TypeID)
) TYPE=MyISAM;

##
## Dumping data for table `PayorTBL`
##


INSERT INTO PayorTBL (ID, TypeID, Name, URL, AddrID) VALUES (1,1,'Blue Cross Blue Shield','http://www.bcbs.com/',14);
INSERT INTO PayorTBL (ID, TypeID, Name, URL, AddrID) VALUES (2,2,'Delta Dental','http://www.deltadental.com/',15);
INSERT INTO PayorTBL (ID, TypeID, Name, URL, AddrID) VALUES (3,1,'Aetna Insurance','http://www.aetna.com',29);
INSERT INTO PayorTBL (ID, TypeID, Name, URL, AddrID) VALUES (4,1,'MetLife Insurance','http://www.metlife.com',30);
INSERT INTO PayorTBL (ID, TypeID, Name, URL, AddrID) VALUES (5,1,'Great-West','http://www.onehealthplan.com',59);

##
## Table structure for table `PayorTypeTBL`
##

DROP TABLE IF EXISTS PayorTypeTBL;
CREATE TABLE PayorTypeTBL (
  ID int(10) unsigned NOT NULL default '0',
  Description varchar(45) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `PayorTypeTBL`
##


INSERT INTO PayorTypeTBL (ID, Description) VALUES (1,'Medical');
INSERT INTO PayorTypeTBL (ID, Description) VALUES (2,'Dental');
INSERT INTO PayorTypeTBL (ID, Description) VALUES (3,'Other');

##
## Table structure for table `PharmacyTBL`
##

DROP TABLE IF EXISTS PharmacyTBL;
CREATE TABLE PharmacyTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  Name varchar(255) default NULL,
  URL varchar(255) default NULL,
  Map varchar(255) default NULL,
  FullNameID bigint(20) unsigned default NULL,
  AddrID bigint(20) unsigned default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `PharmacyTBL`
##


INSERT INTO PharmacyTBL (ID, Name, URL, Map, FullNameID, AddrID) VALUES (1,'Brooks Pharmacy','http://www.brooks-rx.com/',NULL,13,16);
INSERT INTO PharmacyTBL (ID, Name, URL, Map, FullNameID, AddrID) VALUES (2,'Wal-Greens','http://www.walgreens.com/default.jhtml',NULL,14,17);
INSERT INTO PharmacyTBL (ID, Name, URL, Map, FullNameID, AddrID) VALUES (3,'CVS','http://www.cvs.com/CVSApp/cvs/gateway/cvsmain',NULL,15,18);
INSERT INTO PharmacyTBL (ID, Name, URL, Map, FullNameID, AddrID) VALUES (4,'Cambridge Rx','http://www.cambridgerx.com',NULL,25,28);
INSERT INTO PharmacyTBL (ID, Name, URL, Map, FullNameID, AddrID) VALUES (5,'Raley\'s Drug Center','',NULL,61,58);
INSERT INTO PharmacyTBL (ID, Name, URL, Map, FullNameID, AddrID) VALUES (6,'Sutherland Pharmacy','',NULL,66,66);

##
## Table structure for table `PhotoTBL`
##

DROP TABLE IF EXISTS PhotoTBL;
CREATE TABLE PhotoTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  URL varchar(255) NOT NULL default '',
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `PhotoTBL`
##


INSERT INTO PhotoTBL (ID, URL) VALUES (2,'images/000002/StevePict.jpg');
INSERT INTO PhotoTBL (ID, URL) VALUES (3,'images/000001/tarryc.jpg');
INSERT INTO PhotoTBL (ID, URL) VALUES (4,'images/000008/P1010164.JPG');
INSERT INTO PhotoTBL (ID, URL) VALUES (5,'images/000007/P1010023.JPG');
INSERT INTO PhotoTBL (ID, URL) VALUES (6,'images/000006/P1010221.JPG');
INSERT INTO PhotoTBL (ID, URL) VALUES (7,'images/000005/P1010239.JPG');
INSERT INTO PhotoTBL (ID, URL) VALUES (8,'images/000003/P9230026.JPG');
INSERT INTO PhotoTBL (ID, URL) VALUES (9,'images/000009/tammyj.jpg');
INSERT INTO PhotoTBL (ID, URL) VALUES (10,'images/000010/mishap_orig.jpg');
INSERT INTO PhotoTBL (ID, URL) VALUES (11,'images/000012/sandyf.jpg');
INSERT INTO PhotoTBL (ID, URL) VALUES (12,'images/000014/justinf.jpg');
INSERT INTO PhotoTBL (ID, URL) VALUES (13,'images/000013/callief.jpg');
INSERT INTO PhotoTBL (ID, URL) VALUES (14,'images/000015/Frances1.JPG');

##
## Table structure for table `ProblemAreaTBL`
##

DROP TABLE IF EXISTS ProblemAreaTBL;
CREATE TABLE ProblemAreaTBL (
  ID int(10) unsigned NOT NULL default '0',
  ProblemArea varchar(50) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `ProblemAreaTBL`
##


INSERT INTO ProblemAreaTBL (ID, ProblemArea) VALUES (1,'Login');
INSERT INTO ProblemAreaTBL (ID, ProblemArea) VALUES (2,'Information');
INSERT INTO ProblemAreaTBL (ID, ProblemArea) VALUES (3,'Requests');
INSERT INTO ProblemAreaTBL (ID, ProblemArea) VALUES (4,'Add/Update');
INSERT INTO ProblemAreaTBL (ID, ProblemArea) VALUES (5,'Devices');
INSERT INTO ProblemAreaTBL (ID, ProblemArea) VALUES (6,'Library');
INSERT INTO ProblemAreaTBL (ID, ProblemArea) VALUES (7,'Forms');
INSERT INTO ProblemAreaTBL (ID, ProblemArea) VALUES (8,'Customer Service');
INSERT INTO ProblemAreaTBL (ID, ProblemArea) VALUES (9,'Help');
INSERT INTO ProblemAreaTBL (ID, ProblemArea) VALUES (10,'Other');

##
## Table structure for table `ProblemSeverityTBL`
##

DROP TABLE IF EXISTS ProblemSeverityTBL;
CREATE TABLE ProblemSeverityTBL (
  ID int(10) unsigned NOT NULL default '0',
  ProblemSeverity varchar(25) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `ProblemSeverityTBL`
##


INSERT INTO ProblemSeverityTBL (ID, ProblemSeverity) VALUES (1,'Critical');
INSERT INTO ProblemSeverityTBL (ID, ProblemSeverity) VALUES (2,'High');
INSERT INTO ProblemSeverityTBL (ID, ProblemSeverity) VALUES (3,'Medium');
INSERT INTO ProblemSeverityTBL (ID, ProblemSeverity) VALUES (4,'Low');
INSERT INTO ProblemSeverityTBL (ID, ProblemSeverity) VALUES (5,'As Designed');

##
## Table structure for table `ProblemStatusTBL`
##

DROP TABLE IF EXISTS ProblemStatusTBL;
CREATE TABLE ProblemStatusTBL (
  ID int(10) unsigned NOT NULL default '0',
  ProblemStatus varchar(25) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `ProblemStatusTBL`
##


INSERT INTO ProblemStatusTBL (ID, ProblemStatus) VALUES (1,'Opened');
INSERT INTO ProblemStatusTBL (ID, ProblemStatus) VALUES (2,'Triaged');
INSERT INTO ProblemStatusTBL (ID, ProblemStatus) VALUES (3,'Under Development');
INSERT INTO ProblemStatusTBL (ID, ProblemStatus) VALUES (4,'Ready for Test');
INSERT INTO ProblemStatusTBL (ID, ProblemStatus) VALUES (5,'Closed');

##
## Table structure for table `ProblemTrackingTBL`
##

DROP TABLE IF EXISTS ProblemTrackingTBL;
CREATE TABLE ProblemTrackingTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  DateTimeStamp datetime default NULL,
  USERID bigint(20) unsigned default NULL,
  UserTypeID char(1) NOT NULL default '',
  ProblemTypeID int(10) unsigned default NULL,
  ProblemAreaID int(10) unsigned default NULL,
  BrowserTypeID int(10) unsigned default NULL,
  BrowserOther varchar(50) default NULL,
  OperatingSystemID int(10) unsigned default NULL,
  OperatingSystemOther varchar(50) default NULL,
  Problem text,
  ProblemSeverityID int(10) unsigned default NULL,
  ProblemStatusID int(10) unsigned default NULL,
  Developer varchar(50) default NULL,
  Tester varchar(50) default NULL,
  Fix text,
  PRIMARY KEY  (ID),
  KEY indexUSERID (USERID)
) TYPE=MyISAM;

##
## Dumping data for table `ProblemTrackingTBL`
##


INSERT INTO ProblemTrackingTBL (ID, DateTimeStamp, USERID, UserTypeID, ProblemTypeID, ProblemAreaID, BrowserTypeID, BrowserOther, OperatingSystemID, OperatingSystemOther, Problem, ProblemSeverityID, ProblemStatusID, Developer, Tester, Fix) VALUES (1,'2004-03-30 17:57:30',12,'M',8,2,0,'',4,'',' Under insurance info i got a warning:  fopen. . . .permission denied....on line 35\r\n\r\nAlso, where would I find my doctor information??\r\n\r\nI have no idea what browser to select.',1,5,'Tarry','Tarry','chmod file');
INSERT INTO ProblemTrackingTBL (ID, DateTimeStamp, USERID, UserTypeID, ProblemTypeID, ProblemAreaID, BrowserTypeID, BrowserOther, OperatingSystemID, OperatingSystemOther, Problem, ProblemSeverityID, ProblemStatusID, Developer, Tester, Fix) VALUES (2,'2004-03-31 17:15:26',12,'M',9,2,0,'',4,'',' Should there be a box asking the relationship of the emergency contact??',2,5,'TC','TC','Added');

##
## Table structure for table `ProblemTypeTBL`
##

DROP TABLE IF EXISTS ProblemTypeTBL;
CREATE TABLE ProblemTypeTBL (
  ID int(10) unsigned NOT NULL default '0',
  ProblemType varchar(50) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `ProblemTypeTBL`
##


INSERT INTO ProblemTypeTBL (ID, ProblemType) VALUES (1,'Slow Responce');
INSERT INTO ProblemTypeTBL (ID, ProblemType) VALUES (2,'No Responce');
INSERT INTO ProblemTypeTBL (ID, ProblemType) VALUES (3,'Corrupted Display');
INSERT INTO ProblemTypeTBL (ID, ProblemType) VALUES (4,'Corrupted Data');
INSERT INTO ProblemTypeTBL (ID, ProblemType) VALUES (5,'Confusing Interface');
INSERT INTO ProblemTypeTBL (ID, ProblemType) VALUES (7,'Update Error');
INSERT INTO ProblemTypeTBL (ID, ProblemType) VALUES (8,'General Comment');
INSERT INTO ProblemTypeTBL (ID, ProblemType) VALUES (9,'General Question');
INSERT INTO ProblemTypeTBL (ID, ProblemType) VALUES (10,'Other');

##
## Table structure for table `ProviderHostTBL`
##

DROP TABLE IF EXISTS ProviderHostTBL;
CREATE TABLE ProviderHostTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  OrderID int(10) unsigned default NULL,
  ProviderID bigint(20) unsigned default NULL,
  HostID bigint(20) unsigned default NULL,
  PRIMARY KEY  (ID),
  KEY indexProviderID (ProviderID)
) TYPE=MyISAM;

##
## Dumping data for table `ProviderHostTBL`
##


INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (1,1,1,2);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (2,2,1,1);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (3,1,5,4);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (4,1,4,5);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (5,1,6,8);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (6,1,7,7);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (7,1,2,3);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (8,1,3,6);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (9,2,5,1);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (10,3,5,8);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (12,1,8,2);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (13,2,8,1);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (14,2,7,3);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (15,1,9,10);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (16,1,10,11);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (17,1,11,12);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (18,1,12,13);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (19,1,13,14);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (20,1,14,15);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (32,1,15,17);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (31,1,16,19);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (28,1,17,18);
INSERT INTO ProviderHostTBL (ID, OrderID, ProviderID, HostID) VALUES (33,1,999,999);

##
## Table structure for table `ProviderIdentifierTBL`
##

DROP TABLE IF EXISTS ProviderIdentifierTBL;
CREATE TABLE ProviderIdentifierTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  ProviderID bigint(20) unsigned default NULL,
  ProviderIdentifier varchar(15) default NULL,
  ProviderIdentifierTypeID int(10) unsigned default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `ProviderIdentifierTBL`
##


INSERT INTO ProviderIdentifierTBL (ID, ProviderID, ProviderIdentifier, ProviderIdentifierTypeID) VALUES (1,1,'G24648',1);
INSERT INTO ProviderIdentifierTBL (ID, ProviderID, ProviderIdentifier, ProviderIdentifierTypeID) VALUES (2,2,'G24649',1);
INSERT INTO ProviderIdentifierTBL (ID, ProviderID, ProviderIdentifier, ProviderIdentifierTypeID) VALUES (3,3,'G24640',1);
INSERT INTO ProviderIdentifierTBL (ID, ProviderID, ProviderIdentifier, ProviderIdentifierTypeID) VALUES (4,4,'G24641',1);
INSERT INTO ProviderIdentifierTBL (ID, ProviderID, ProviderIdentifier, ProviderIdentifierTypeID) VALUES (5,5,'G24642',1);
INSERT INTO ProviderIdentifierTBL (ID, ProviderID, ProviderIdentifier, ProviderIdentifierTypeID) VALUES (6,6,'G24643',1);
INSERT INTO ProviderIdentifierTBL (ID, ProviderID, ProviderIdentifier, ProviderIdentifierTypeID) VALUES (7,7,'G24644',1);
INSERT INTO ProviderIdentifierTBL (ID, ProviderID, ProviderIdentifier, ProviderIdentifierTypeID) VALUES (8,8,'G24676',1);
INSERT INTO ProviderIdentifierTBL (ID, ProviderID, ProviderIdentifier, ProviderIdentifierTypeID) VALUES (9,9,'G24646',1);
INSERT INTO ProviderIdentifierTBL (ID, ProviderID, ProviderIdentifier, ProviderIdentifierTypeID) VALUES (10,10,'G24647',1);
INSERT INTO ProviderIdentifierTBL (ID, ProviderID, ProviderIdentifier, ProviderIdentifierTypeID) VALUES (11,11,'G24618',1);
INSERT INTO ProviderIdentifierTBL (ID, ProviderID, ProviderIdentifier, ProviderIdentifierTypeID) VALUES (12,12,'G24628',1);
INSERT INTO ProviderIdentifierTBL (ID, ProviderID, ProviderIdentifier, ProviderIdentifierTypeID) VALUES (13,13,'G24638',1);
INSERT INTO ProviderIdentifierTBL (ID, ProviderID, ProviderIdentifier, ProviderIdentifierTypeID) VALUES (14,14,'G24658',1);
INSERT INTO ProviderIdentifierTBL (ID, ProviderID, ProviderIdentifier, ProviderIdentifierTypeID) VALUES (15,15,'G24358',1);
INSERT INTO ProviderIdentifierTBL (ID, ProviderID, ProviderIdentifier, ProviderIdentifierTypeID) VALUES (16,16,'G24358',1);
INSERT INTO ProviderIdentifierTBL (ID, ProviderID, ProviderIdentifier, ProviderIdentifierTypeID) VALUES (17,17,'G24358',1);

##
## Table structure for table `ProviderIdentifierTypeTBL`
##

DROP TABLE IF EXISTS ProviderIdentifierTypeTBL;
CREATE TABLE ProviderIdentifierTypeTBL (
  ID int(10) unsigned NOT NULL default '0',
  ProviderIdentifierType varchar(20) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `ProviderIdentifierTypeTBL`
##


INSERT INTO ProviderIdentifierTypeTBL (ID, ProviderIdentifierType) VALUES (1,'UPIN');

##
## Table structure for table `ProviderTBL`
##

DROP TABLE IF EXISTS ProviderTBL;
CREATE TABLE ProviderTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  TypeID int(10) unsigned default NULL,
  FullNameID bigint(20) unsigned default NULL,
  SpecialtyID int(10) unsigned default NULL,
  PRIMARY KEY  (ID),
  KEY indexType (TypeID)
) TYPE=MyISAM;

##
## Dumping data for table `ProviderTBL`
##


INSERT INTO ProviderTBL (ID, TypeID, FullNameID, SpecialtyID) VALUES (999,1,999,1);
INSERT INTO ProviderTBL (ID, TypeID, FullNameID, SpecialtyID) VALUES (1,1,6,1);
INSERT INTO ProviderTBL (ID, TypeID, FullNameID, SpecialtyID) VALUES (2,1,7,13);
INSERT INTO ProviderTBL (ID, TypeID, FullNameID, SpecialtyID) VALUES (3,1,8,6);
INSERT INTO ProviderTBL (ID, TypeID, FullNameID, SpecialtyID) VALUES (4,1,9,16);
INSERT INTO ProviderTBL (ID, TypeID, FullNameID, SpecialtyID) VALUES (5,1,10,14);
INSERT INTO ProviderTBL (ID, TypeID, FullNameID, SpecialtyID) VALUES (6,1,11,11);
INSERT INTO ProviderTBL (ID, TypeID, FullNameID, SpecialtyID) VALUES (7,2,12,2);
INSERT INTO ProviderTBL (ID, TypeID, FullNameID, SpecialtyID) VALUES (8,1,27,7);
INSERT INTO ProviderTBL (ID, TypeID, FullNameID, SpecialtyID) VALUES (9,1,43,1);
INSERT INTO ProviderTBL (ID, TypeID, FullNameID, SpecialtyID) VALUES (10,1,44,11);
INSERT INTO ProviderTBL (ID, TypeID, FullNameID, SpecialtyID) VALUES (11,1,45,13);
INSERT INTO ProviderTBL (ID, TypeID, FullNameID, SpecialtyID) VALUES (12,1,46,33);
INSERT INTO ProviderTBL (ID, TypeID, FullNameID, SpecialtyID) VALUES (13,1,47,12);
INSERT INTO ProviderTBL (ID, TypeID, FullNameID, SpecialtyID) VALUES (14,1,48,13);
INSERT INTO ProviderTBL (ID, TypeID, FullNameID, SpecialtyID) VALUES (15,1,63,11);
INSERT INTO ProviderTBL (ID, TypeID, FullNameID, SpecialtyID) VALUES (16,1,64,18);
INSERT INTO ProviderTBL (ID, TypeID, FullNameID, SpecialtyID) VALUES (17,1,65,1);

##
## Table structure for table `ProviderTypeTBL`
##

DROP TABLE IF EXISTS ProviderTypeTBL;
CREATE TABLE ProviderTypeTBL (
  ID int(10) unsigned NOT NULL default '0',
  Description varchar(45) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `ProviderTypeTBL`
##


INSERT INTO ProviderTypeTBL (ID, Description) VALUES (1,'Doctor');
INSERT INTO ProviderTypeTBL (ID, Description) VALUES (2,'Practitioner');
INSERT INTO ProviderTypeTBL (ID, Description) VALUES (3,'Nurse');
INSERT INTO ProviderTypeTBL (ID, Description) VALUES (4,'Technician');
INSERT INTO ProviderTypeTBL (ID, Description) VALUES (5,'Care Giver');
INSERT INTO ProviderTypeTBL (ID, Description) VALUES (6,'EMT');
INSERT INTO ProviderTypeTBL (ID, Description) VALUES (7,'Other');

##
## Table structure for table `RelationshipTypeTBL`
##

DROP TABLE IF EXISTS RelationshipTypeTBL;
CREATE TABLE RelationshipTypeTBL (
  ID int(10) unsigned NOT NULL default '0',
  RelationshipType varchar(45) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `RelationshipTypeTBL`
##


INSERT INTO RelationshipTypeTBL (ID, RelationshipType) VALUES (1,'Family');
INSERT INTO RelationshipTypeTBL (ID, RelationshipType) VALUES (2,'Spouse');
INSERT INTO RelationshipTypeTBL (ID, RelationshipType) VALUES (3,'Sibling');
INSERT INTO RelationshipTypeTBL (ID, RelationshipType) VALUES (4,'Parent');
INSERT INTO RelationshipTypeTBL (ID, RelationshipType) VALUES (5,'Child');
INSERT INTO RelationshipTypeTBL (ID, RelationshipType) VALUES (6,'Guardian');
INSERT INTO RelationshipTypeTBL (ID, RelationshipType) VALUES (7,'Health Care Proxy');
INSERT INTO RelationshipTypeTBL (ID, RelationshipType) VALUES (8,'Power of Attorney');
INSERT INTO RelationshipTypeTBL (ID, RelationshipType) VALUES (9,'Primary');
INSERT INTO RelationshipTypeTBL (ID, RelationshipType) VALUES (91,'Other');
INSERT INTO RelationshipTypeTBL (ID, RelationshipType) VALUES (0,'Self');

##
## Table structure for table `RequestStatusTBL`
##

DROP TABLE IF EXISTS RequestStatusTBL;
CREATE TABLE RequestStatusTBL (
  ID int(10) unsigned NOT NULL default '0',
  Description varchar(45) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `RequestStatusTBL`
##


INSERT INTO RequestStatusTBL (ID, Description) VALUES (1,'Client Request Initiated');
INSERT INTO RequestStatusTBL (ID, Description) VALUES (2,'Under Internal Review');
INSERT INTO RequestStatusTBL (ID, Description) VALUES (3,'Request Sent to Provider');
INSERT INTO RequestStatusTBL (ID, Description) VALUES (4,'Waiting on Provider');
INSERT INTO RequestStatusTBL (ID, Description) VALUES (7,'Provider Information Incomplete');
INSERT INTO RequestStatusTBL (ID, Description) VALUES (8,'Provider Information Complete');
INSERT INTO RequestStatusTBL (ID, Description) VALUES (6,'Quality Assurance Review');
INSERT INTO RequestStatusTBL (ID, Description) VALUES (9,'Client Files Updated');
INSERT INTO RequestStatusTBL (ID, Description) VALUES (10,'Waiting for Client Confirmation');
INSERT INTO RequestStatusTBL (ID, Description) VALUES (11,'Client Confirmation received.');
INSERT INTO RequestStatusTBL (ID, Description) VALUES (12,'Client Request Complete');
INSERT INTO RequestStatusTBL (ID, Description) VALUES (5,'Provider Information Received');

##
## Table structure for table `RequestTypeTBL`
##

DROP TABLE IF EXISTS RequestTypeTBL;
CREATE TABLE RequestTypeTBL (
  ID int(10) unsigned NOT NULL default '0',
  Desrciption varchar(45) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `RequestTypeTBL`
##



##
## Table structure for table `RuleActionTBL`
##

DROP TABLE IF EXISTS RuleActionTBL;
CREATE TABLE RuleActionTBL (
  ID int(10) unsigned NOT NULL default '0',
  Action varchar(45) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `RuleActionTBL`
##


INSERT INTO RuleActionTBL (ID, Action) VALUES (1,'Appointment');
INSERT INTO RuleActionTBL (ID, Action) VALUES (2,'Prescription Renewal');
INSERT INTO RuleActionTBL (ID, Action) VALUES (3,'Vaccination Renewal');

##
## Table structure for table `RuleEventTypeTBL`
##

DROP TABLE IF EXISTS RuleEventTypeTBL;
CREATE TABLE RuleEventTypeTBL (
  ID int(10) unsigned NOT NULL default '0',
  EventType varchar(45) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `RuleEventTypeTBL`
##


INSERT INTO RuleEventTypeTBL (ID, EventType) VALUES (1,'Primary Phone call');
INSERT INTO RuleEventTypeTBL (ID, EventType) VALUES (2,'Email');
INSERT INTO RuleEventTypeTBL (ID, EventType) VALUES (3,'Post card');
INSERT INTO RuleEventTypeTBL (ID, EventType) VALUES (4,'Pager');
INSERT INTO RuleEventTypeTBL (ID, EventType) VALUES (5,'Mobile Phone');

##
## Table structure for table `ScanInfoTBL`
##

DROP TABLE IF EXISTS ScanInfoTBL;
CREATE TABLE ScanInfoTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  URL varchar(255) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `ScanInfoTBL`
##


INSERT INTO ScanInfoTBL (ID, URL) VALUES (1,'scan/000001/Appendectomy.jpeg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (2,'scan/000001/physical.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (3,'scan/000001/bloodtest.gif');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (4,'scan/000001/biopsy.gif');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (6,'scan/000001/ctbrain1.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (7,'scan/000001/ctbrain2.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (8,'scan/000001/ctbrain3.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (9,'scan/000001/ctbrain4.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (10,'scan/000001/physical.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (11,'scan/000001/chart2.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (12,'scan/000001/chart2.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (13,'scan/000001/custsup.gif');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (14,'scan/000001/kidneystone1.gif');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (15,'scan/000001/goldsel.gif');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (16,'scan/000001/ankle1.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (17,'scan/000001/ankle2.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (18,'scan/000001/ankle3.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (19,'scan/000015/1081366161scan0001.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (20,'scan/000015/1081366178scan0002.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (21,'scan/000015/1081366211scan0003.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (22,'scan/000015/1081366337scan0004.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (23,'scan/000015/1081366397scan0005.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (24,'scan/000015/1081366436scan0006.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (25,'scan/000015/1081367007scan0007.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (26,'scan/000015/1081367040scan0008.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (27,'scan/000015/1081367074scan0009.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (28,'scan/000015/1081367109scan0010.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (29,'scan/000015/1081367177scan0011.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (30,'scan/000015/1081367201scan0012.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (31,'scan/000015/1081367235scan0013.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (32,'scan/000015/1081367306scan0014.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (33,'scan/000015/1081367377scan0015.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (34,'scan/000015/1081367419scan0016.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (35,'scan/000015/1081367444scan0017.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (36,'scan/000015/1081367484scan0018.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (37,'scan/000015/1081367613scan0019.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (38,'scan/000015/1081367930scan0020.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (39,'scan/000015/1081367981scan0021.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (40,'scan/000015/1081368008scan0022.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (41,'scan/000015/1081368055scan0023.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (42,'scan/000015/1081368174scan0024.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (43,'scan/000015/1081368197scan0025.jpg');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (44,'scan/000001/1081889622mytest.wav');
INSERT INTO ScanInfoTBL (ID, URL) VALUES (45,'scan/000001/1081889649Diagnostic.avi');

##
## Table structure for table `ScanTypeTBL`
##

DROP TABLE IF EXISTS ScanTypeTBL;
CREATE TABLE ScanTypeTBL (
  ID int(10) unsigned NOT NULL default '0',
  ScanType varchar(45) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `ScanTypeTBL`
##


INSERT INTO ScanTypeTBL (ID, ScanType) VALUES (1,'Xray');
INSERT INTO ScanTypeTBL (ID, ScanType) VALUES (2,'Notes');
INSERT INTO ScanTypeTBL (ID, ScanType) VALUES (3,'Form');
INSERT INTO ScanTypeTBL (ID, ScanType) VALUES (4,'ECG');
INSERT INTO ScanTypeTBL (ID, ScanType) VALUES (5,'EKG');
INSERT INTO ScanTypeTBL (ID, ScanType) VALUES (6,'CAT');
INSERT INTO ScanTypeTBL (ID, ScanType) VALUES (7,'Test Request');
INSERT INTO ScanTypeTBL (ID, ScanType) VALUES (8,'Test Results');
INSERT INTO ScanTypeTBL (ID, ScanType) VALUES (9,'Prescription');
INSERT INTO ScanTypeTBL (ID, ScanType) VALUES (10,'Instructions');
INSERT INTO ScanTypeTBL (ID, ScanType) VALUES (11,'Diagnosis');
INSERT INTO ScanTypeTBL (ID, ScanType) VALUES (12,'Voice');
INSERT INTO ScanTypeTBL (ID, ScanType) VALUES (13,'Video');
INSERT INTO ScanTypeTBL (ID, ScanType) VALUES (91,'Other');

##
## Table structure for table `SpecTypeTBL`
##

DROP TABLE IF EXISTS SpecTypeTBL;
CREATE TABLE SpecTypeTBL (
  ID int(10) unsigned NOT NULL default '0',
  Description varchar(45) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `SpecTypeTBL`
##


INSERT INTO SpecTypeTBL (ID, Description) VALUES (12,'Pediatrician');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (11,'OB/GYN');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (10,'Urologist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (9,'Hepatologist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (8,'Resperitory');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (7,'Immunologist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (6,'Cardiologist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (5,'Endocrinologist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (4,'Neurologist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (3,'Radiologist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (2,'Oncologist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (1,'General Practitioner');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (13,'Dental');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (14,'Orthopedics');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (15,'Surgeon');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (16,'Acupuncture');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (17,'Anesthesiologist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (18,'Dermatologist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (19,'Epidemiologist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (20,'Gastroenterologist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (21,'Hematologist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (22,'Internal Medicine');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (23,'Nephrologist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (24,'Neurologist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (25,'Ophthamologist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (26,'Otolaryngologist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (27,'Pathologist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (28,'Plastic Surgery');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (29,'Podiatrist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (30,'Psychiatrist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (31,'Rheumatologist');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (32,'Geriatric');
INSERT INTO SpecTypeTBL (ID, Description) VALUES (33,'Chiropractor');

##
## Table structure for table `SymptomTypeTBL`
##

DROP TABLE IF EXISTS SymptomTypeTBL;
CREATE TABLE SymptomTypeTBL (
  ID int(10) unsigned NOT NULL default '0',
  Description varchar(45) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `SymptomTypeTBL`
##


INSERT INTO SymptomTypeTBL (ID, Description) VALUES (1,'Known');
INSERT INTO SymptomTypeTBL (ID, Description) VALUES (2,'Unknown');
INSERT INTO SymptomTypeTBL (ID, Description) VALUES (3,'Complex');

##
## Table structure for table `UserTBL`
##

DROP TABLE IF EXISTS UserTBL;
CREATE TABLE UserTBL (
  ID bigint(20) unsigned NOT NULL auto_increment,
  FullNameID bigint(20) unsigned default NULL,
  AddrID bigint(20) unsigned default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `UserTBL`
##


INSERT INTO UserTBL (ID, FullNameID, AddrID) VALUES (1,36,35);
INSERT INTO UserTBL (ID, FullNameID, AddrID) VALUES (2,37,36);
INSERT INTO UserTBL (ID, FullNameID, AddrID) VALUES (3,67,67);
INSERT INTO UserTBL (ID, FullNameID, AddrID) VALUES (4,71,73);

##
## Table structure for table `VaccInocTypeTBL`
##

DROP TABLE IF EXISTS VaccInocTypeTBL;
CREATE TABLE VaccInocTypeTBL (
  ID int(10) unsigned NOT NULL default '0',
  VaccInocType varchar(50) default NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

##
## Dumping data for table `VaccInocTypeTBL`
##


INSERT INTO VaccInocTypeTBL (ID, VaccInocType) VALUES (1,'Hepatitas A');
INSERT INTO VaccInocTypeTBL (ID, VaccInocType) VALUES (2,'Hepatitas B');
INSERT INTO VaccInocTypeTBL (ID, VaccInocType) VALUES (3,'Pneumonia Vaccine');
INSERT INTO VaccInocTypeTBL (ID, VaccInocType) VALUES (4,'Tetanus');
INSERT INTO VaccInocTypeTBL (ID, VaccInocType) VALUES (5,'Diptheria');
INSERT INTO VaccInocTypeTBL (ID, VaccInocType) VALUES (6,'Pertussis (Whooping cough)');
INSERT INTO VaccInocTypeTBL (ID, VaccInocType) VALUES (7,'Measles');
INSERT INTO VaccInocTypeTBL (ID, VaccInocType) VALUES (8,'Mumps');
INSERT INTO VaccInocTypeTBL (ID, VaccInocType) VALUES (9,'Rubella');
INSERT INTO VaccInocTypeTBL (ID, VaccInocType) VALUES (10,'HIB');
INSERT INTO VaccInocTypeTBL (ID, VaccInocType) VALUES (11,'Influenza (Flu)');
INSERT INTO VaccInocTypeTBL (ID, VaccInocType) VALUES (12,'Polio');
INSERT INTO VaccInocTypeTBL (ID, VaccInocType) VALUES (13,'Yellow Feaver');
INSERT INTO VaccInocTypeTBL (ID, VaccInocType) VALUES (14,'Typhoid');
INSERT INTO VaccInocTypeTBL (ID, VaccInocType) VALUES (15,'Cholera');
INSERT INTO VaccInocTypeTBL (ID, VaccInocType) VALUES (16,'Malaria');
INSERT INTO VaccInocTypeTBL (ID, VaccInocType) VALUES (91,'Other');

