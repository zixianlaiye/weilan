-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-09-03 14:37:08
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `weilan`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `uid` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `degree` int(1) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cid` int(4) NOT NULL AUTO_INCREMENT,
  `cname` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`cid`, `cname`) VALUES
(2, '平面设计'),
(3, '网站开发'),
(5, '征文创意'),
(7, '活动发布');

-- --------------------------------------------------------

--
-- 表的结构 `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `pid` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT '项目名称',
  `cid` varchar(5) NOT NULL COMMENT '项目类型',
  `datetime` varchar(15) NOT NULL COMMENT '发布时间',
  `needtime` varchar(10) NOT NULL COMMENT '项目周期',
  `money` varchar(15) NOT NULL COMMENT '项目报酬',
  `description` text,
  `filestatus` int(1) NOT NULL DEFAULT '0',
  `filename` varchar(20) DEFAULT NULL,
  `fileaddress` varchar(50) DEFAULT NULL,
  `dostatus` int(1) NOT NULL DEFAULT '0',
  `phone` varchar(11) CHARACTER SET latin1 NOT NULL,
  `email` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `connecter` varchar(10) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
