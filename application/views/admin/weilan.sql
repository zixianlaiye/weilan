-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-07-16 15:29:42
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
  `username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cid` int(4) NOT NULL AUTO_INCREMENT,
  `cname` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`cid`, `cname`) VALUES
(1, '网站开发'),
(2, '平面设计');

-- --------------------------------------------------------

--
-- 表的结构 `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `uid` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT '项目名称',
  `cid` varchar(5) CHARACTER SET utf8 NOT NULL COMMENT '项目类型',
  `datetime` varchar(15) CHARACTER SET utf8 NOT NULL COMMENT '发布时间',
  `needtime` varchar(10) CHARACTER SET utf8 NOT NULL COMMENT '项目周期',
  `corefunction` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '核心功能',
  `money` varchar(15) CHARACTER SET utf8 NOT NULL COMMENT '项目报酬',
  `technology` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '开发技术要求',
  `addcontent` text CHARACTER SET utf8,
  `filestatus` varchar(1) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `fileaddress` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `dostatus` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `project`
--

INSERT INTO `project` (`uid`, `name`, `cid`, `datetime`, `needtime`, `corefunction`, `money`, `technology`, `addcontent`, `filestatus`, `fileaddress`, `dostatus`) VALUES
(1, '11111', '1', 'July 12 2016 09', '111', '111', '1111', '111', '111111', '1', '/uploads/cefc32d66864d9e853d788082936e8ac.jpg', 0),
(2, '11111', '1', 'July 12 2016 09', '111', '111', '1111', '111', '111111', '0', 'NULL', 0),
(3, '111111', '2', 'July 12 2016 09', '1111111', '111111111', '11111111', '11111111', '', '0', NULL, 0),
(4, '11111', '2', 'July 12 2016 09', '111', '111', '1111', '111', '111111', '0', 'NULL', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
