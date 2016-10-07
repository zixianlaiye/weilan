-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-10-07 10:41:46
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

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
-- 表的结构 `picture`
--

CREATE TABLE IF NOT EXISTS `picture` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(25) DEFAULT NULL,
  `picture` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `picture_address` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `dostatus` char(3) NOT NULL DEFAULT '未开始',
  `phone` varchar(11) CHARACTER SET latin1 NOT NULL,
  `email` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `connecter` varchar(10) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `project`
--

INSERT INTO `project` (`pid`, `name`, `cid`, `datetime`, `needtime`, `money`, `description`, `filestatus`, `filename`, `fileaddress`, `dostatus`, `phone`, `email`, `uid`, `connecter`) VALUES
(2, '测试一', '2', '1473668569', '40', '30', '2333', 1, NULL, '/uploads/Azrael_login.zip', '进行中', '18010614539', '550965989@qq.com', 0, '范老师'),
(3, '测试二', '3', '1473668707', '10', '32244', '23333', 1, NULL, '/uploads/5c311454944729.zip', '未开始', '18010614539', '550965989@qq.com', 0, '范老师'),
(4, '例1', '2', '1473757006', '123', '123123', '213123', 0, NULL, NULL, '未开始', '123123', '13223', 0, '12312'),
(5, '例2', '2', '1473757454', '2323', '23232', '23323', 0, NULL, NULL, '已完成', '2323', '2323', 0, '23232'),
(6, '例2', '2', '1473757489', '2323', '23232', '23323', 0, NULL, NULL, '未开始', '2323', '2323', 0, '23232'),
(7, '例3', '2', '1473757569', '10', '10', 'qwewe', 0, NULL, NULL, '未开始', '18010614539', 'qweqw', 0, 'qweeq'),
(8, 'r23erwe', '2', '1473757587', '10', '10', '213123', 0, NULL, NULL, '未开始', '18010614539', '123123', 0, '122'),
(9, '例4', '2', '1473757674', '234234', '32432', '23423', 0, NULL, NULL, '未开始', '32423', '3244', 0, '342'),
(11, '测试', '2', '1473758728', '3424', '324234', '3242', 0, NULL, NULL, '未开始', '32432', '32423', 0, '324324'),
(12, '344', '5', '1473758936', '23423', '2344', 'rtefg', 1, NULL, '/uploads/2016-2017学年校历.rar', '未开始', '18010614539', '550965989@qq.com', 0, '234'),
(13, '例5', '5', '1473763423', '342', '23423', '2342', 0, NULL, NULL, '未开始', '23423', '32423', 0, '32423'),
(14, '345', '5', '1473763450', '34534', '3454', '34534', 0, NULL, NULL, '未开始', '34534', '435345', 0, '34534');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
