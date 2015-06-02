-- phpMyAdmin SQL Dump
-- version 4.4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-06-02 14:49:39
-- 服务器版本： 5.5.43-0+deb8u1
-- PHP Version: 5.6.7-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms_db`
--

-- --------------------------------------------------------

--
-- 表的结构 `cms_article`
--

CREATE TABLE IF NOT EXISTS `cms_article` (
  `id` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL COMMENT '父级ID（栏目ID）',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `author` varchar(255) NOT NULL COMMENT '来源',
  `updatetime` int(10) unsigned NOT NULL COMMENT '更新时间',
  `istop` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '置顶，0否，1是',
  `sort` int(10) unsigned NOT NULL COMMENT '排序',
  `thumb` varchar(255) DEFAULT NULL COMMENT '缩略图路径',
  `content` text NOT NULL COMMENT '内容'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章产品内容表';

-- --------------------------------------------------------

--
-- 表的结构 `cms_banner`
--

CREATE TABLE IF NOT EXISTS `cms_banner` (
  `id` int(10) unsigned NOT NULL,
  `imgpath` varchar(255) NOT NULL COMMENT 'banner图路径',
  `href` varchar(255) NOT NULL COMMENT 'banner图链接',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='首页banner图表';

-- --------------------------------------------------------

--
-- 表的结构 `cms_category`
--

CREATE TABLE IF NOT EXISTS `cms_category` (
  `id` int(10) unsigned NOT NULL,
  `catname` varchar(255) NOT NULL COMMENT '栏目名称',
  `pid` int(10) unsigned NOT NULL COMMENT '父级ID',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '类型，0自定义，1文章，2产品，3单页',
  `isnav` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '在导航显示，0否，1是',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='导航栏目表';

-- --------------------------------------------------------

--
-- 表的结构 `cms_href`
--

CREATE TABLE IF NOT EXISTS `cms_href` (
  `id` int(10) unsigned NOT NULL COMMENT '导航栏目自定义链接ID',
  `href` varchar(255) NOT NULL COMMENT '自定义链接内容'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='导航自定义链接表';

-- --------------------------------------------------------

--
-- 表的结构 `cms_page`
--

CREATE TABLE IF NOT EXISTS `cms_page` (
  `id` int(10) unsigned NOT NULL COMMENT '导航栏目单页ID',
  `content` text NOT NULL COMMENT '单页内容'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='单页内容表';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_article`
--
ALTER TABLE `cms_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_banner`
--
ALTER TABLE `cms_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_category`
--
ALTER TABLE `cms_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms_article`
--
ALTER TABLE `cms_article`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cms_banner`
--
ALTER TABLE `cms_banner`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cms_category`
--
ALTER TABLE `cms_category`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
