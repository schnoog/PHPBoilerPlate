
--
-- Table structure for table `docu`
--

DROP TABLE IF EXISTS `docu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `docu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `further` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `docusections`
--

DROP TABLE IF EXISTS `docusections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `docusections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) NOT NULL DEFAULT '-1',
  `sectionlabel` varchar(100) NOT NULL,
  `sectiondesc` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `parsec` (`parentid`,`sectionlabel`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nav`
--

DROP TABLE IF EXISTS `nav`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nav_navtype` int(11) NOT NULL,
  `nav_title` varchar(100) NOT NULL,
  `nav_desc` text NOT NULL,
  `nav_parentid` int(11) NOT NULL,
  `nav_allowedmask` int(11) NOT NULL,
  `nav_target` varchar(500) NOT NULL,
  `nav_active` int(1) NOT NULL,
  `nav_sort` int(11) NOT NULL DEFAULT '1000',
  PRIMARY KEY (`id`),
  KEY `nav_navtypeconst` (`nav_navtype`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nav_types`
--

DROP TABLE IF EXISTS `nav_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nav_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `navtype` varchar(50) NOT NULL,
  `navtypedesc` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniquenavtype` (`navtype`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(100) NOT NULL,
  `pagetitle` varchar(500) NOT NULL,
  `useacl` int(1) NOT NULL,
  `syspage` int(1) NOT NULL DEFAULT '0',
  `usermask` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unipage` (`page`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `sys_settings`
--

DROP TABLE IF EXISTS `sys_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `set_section` varchar(50) NOT NULL,
  `set_key` varchar(50) NOT NULL,
  `set_val` varchar(255) NOT NULL,
  `set_sensible` int(1) NOT NULL,
  `set_required` int(1) NOT NULL,
  `set_default` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `seckeyuniq` (`set_section`,`set_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `user_settingkeys`
--

DROP TABLE IF EXISTS `user_settingkeys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_settingkeys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usersetting_key` varchar(99) NOT NULL,
  `usersetting_desc` varchar(4096) NOT NULL,
  `usersetting_default` varchar(99) NOT NULL,
  `usersetting_typevaliparameter` varchar(255) NOT NULL,
  `usersetting_required` int(1) NOT NULL DEFAULT '0',
  `usersetting_preset` varchar(99) NOT NULL COMMENT 'Preset which is used as parameter to presetrequest',
  `usersetting_limittopreset` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unikey` (`usersetting_key`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_settings`
--

DROP TABLE IF EXISTS `user_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `settingkey` int(11) NOT NULL,
  `settingval` varchar(1024) NOT NULL,
  `settingset` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Uniqset` (`userid`,`settingkey`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;


/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-29  0:34:18
