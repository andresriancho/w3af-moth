-- phpMyAdmin SQL Dump
-- version 2.6.0-pl3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Apr 30, 2006 at 05:45 PM
-- Server version: 4.1.8
-- PHP Version: 5.0.3
-- 
-- Database: `ajax_ex`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `customers`
-- 

CREATE TABLE `customers` (
  `CustomerId` int(11) NOT NULL auto_increment,
  `Name` varchar(255) NOT NULL default '',
  `Address` varchar(255) NOT NULL default '',
  `City` varchar(255) NOT NULL default '',
  `State` varchar(255) NOT NULL default '',
  `Zip` varchar(255) NOT NULL default '',
  `Phone` varchar(255) NOT NULL default '',
  `E-mail` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`CustomerId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Sample Customer Data';

-- 
-- Dumping data for table `customers`
-- 

INSERT INTO `customers` VALUES (1, 'Suraj Thapliya', 'Naxal, Bhagbati', 'Kathmandu', 'KTM', '0977', '977-9803165329', 'surajthapaliya@gmail.com');
INSERT INTO `customers` VALUES (2, 'Birijan Maharjan', 'Kathmandu', 'Kathmandu', 'Ktm', '977', '9803020016', 'birijan@wlink.com.np');
