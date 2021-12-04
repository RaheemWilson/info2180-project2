DROP DATABASE IF EXISTS bugme;
CREATE DATABASE bugme;
USE bugme;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `firstname` varchar(64) NOT NULL default '',
  `lastname` varchar(64) NOT NULL default '',
  `email` varchar(64) NOT NULL unique,
  `password` varchar(64) NOT NULL default '',
  `date_joined` datetime NOT NULL default current_timestamp,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

--
-- Table structure for table `issues`
--

DROP TABLE IF EXISTS `issues`;
CREATE TABLE `issues` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(50) NOT NULL default '',
  `description` text NOT NULL default '',
  `type` varchar(20) NOT NULL default '',
  `priority` varchar(35) NOT NULL default '',
  `status` varchar(35) NOT NULL default '',
  `assigned_to` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created` datetime NOT NULL default current_timestamp,
  `updated` datetime default NULL default current_timestamp,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;
