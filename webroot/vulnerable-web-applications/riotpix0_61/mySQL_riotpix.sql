
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Table structure for table `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `forumid` bigint(20) NOT NULL auto_increment,
  `subject` varchar(100) NOT NULL default '',
  `name` varchar(25) NOT NULL default '',
  `message` text NOT NULL,
  `sorter` int(20) NOT NULL default '0',
  `submitdate` varchar(20) NOT NULL default '',
  `belongstoid` bigint(20) NOT NULL default '0',
  `replys` int(11) NOT NULL default '0',
  `host` varchar(100) NOT NULL default '',
  `time` varchar(15) default '',
  `lastreply` varchar(35) NOT NULL default '',
  `lastposter` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`forumid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `fname` varchar(20) default '',
  `lname` varchar(20) default '',
  `age` varchar(8) default '',
  `sex` varchar(6) default '',
  `location` varchar(40) default NULL,
  `email` varchar(50) default '',
  `username` varchar(20) default '',
  `password` varchar(100) default NULL,
  `updateu` varchar(20) default '',
  `joindate` varchar(15) default '',
  `posts` int(6) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
