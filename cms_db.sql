-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-06-14 20:13:34
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
-- 表的结构 `cms_admin`
--

CREATE TABLE IF NOT EXISTS `cms_admin` (
`uid` int(10) unsigned NOT NULL COMMENT '用户ID',
  `gid` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '用户组ID，0管理组，1用户组',
  `account` varchar(255) NOT NULL COMMENT '管理员账户',
  `password` varchar(255) NOT NULL COMMENT '管理员密码'
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='管理员表';

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
  `uploadfileid` int(10) unsigned DEFAULT NULL COMMENT '缩略图附件ID'
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='文章产品内容表';

-- --------------------------------------------------------

--
-- 表的结构 `cms_article_data`
--

CREATE TABLE IF NOT EXISTS `cms_article_data` (
  `articleid` int(10) unsigned NOT NULL COMMENT '文章ID',
  `content` text NOT NULL COMMENT '文章内容'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cms_banner`
--

CREATE TABLE IF NOT EXISTS `cms_banner` (
`id` int(10) unsigned NOT NULL,
  `uploadfileid` int(10) unsigned DEFAULT NULL COMMENT 'banner图附件ID',
  `href` varchar(255) DEFAULT NULL COMMENT 'banner图链接',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='首页banner图表';

-- --------------------------------------------------------

--
-- 表的结构 `cms_category`
--

CREATE TABLE IF NOT EXISTS `cms_category` (
`id` int(10) unsigned NOT NULL,
  `catname` varchar(255) NOT NULL COMMENT '栏目名称',
  `pid` int(10) unsigned NOT NULL COMMENT '父级ID',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '类型，0自定义，1单页，2文章',
  `isnav` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '在导航显示，0否，1是',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `tpl` varchar(255) DEFAULT NULL COMMENT '定制模板'
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='导航栏目表';

-- --------------------------------------------------------

--
-- 表的结构 `cms_custom_link`
--

CREATE TABLE IF NOT EXISTS `cms_custom_link` (
  `linkid` int(10) unsigned NOT NULL COMMENT '导航栏目自定义链接ID',
  `href` varchar(255) DEFAULT NULL COMMENT '自定义链接内容'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='导航自定义链接表';

-- --------------------------------------------------------

--
-- 表的结构 `cms_message`
--

CREATE TABLE IF NOT EXISTS `cms_message` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '姓名',
  `contact` varchar(255) NOT NULL COMMENT '联系方式',
  `content` text NOT NULL COMMENT '留言内容',
  `createtime` int(10) unsigned NOT NULL COMMENT '留言时间',
  `isread` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0未读，1已读'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='留言表';

-- --------------------------------------------------------

--
-- 表的结构 `cms_page`
--

CREATE TABLE IF NOT EXISTS `cms_page` (
  `pageid` int(10) unsigned NOT NULL COMMENT '导航栏目单页ID',
  `content` text COMMENT '单页内容'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='单页内容表';

-- --------------------------------------------------------

--
-- 表的结构 `cms_piece`
--

CREATE TABLE IF NOT EXISTS `cms_piece` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='碎片调用表';

-- --------------------------------------------------------

--
-- 表的结构 `cms_uploads`
--

CREATE TABLE IF NOT EXISTS `cms_uploads` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '上传文件的原始名称',
  `type` varchar(255) NOT NULL COMMENT '上传文件的MIME类型',
  `size` int(10) unsigned NOT NULL COMMENT '上传文件的大小',
  `ext` varchar(255) NOT NULL COMMENT '上传文件的后缀类型',
  `md5` varchar(32) DEFAULT NULL COMMENT '上传文件的md5哈希验证字符串 仅当hash设置开启后有效',
  `sha1` varchar(40) DEFAULT NULL COMMENT '上传文件的sha1哈希验证字符串 仅当hash设置开启后有效',
  `savename` varchar(255) NOT NULL COMMENT '上传文件的保存名称',
  `savepath` varchar(255) NOT NULL COMMENT '上传文件的保存路径'
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='上传附件表';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_admin`
--
ALTER TABLE `cms_admin`
 ADD PRIMARY KEY (`uid`), ADD UNIQUE KEY `account` (`account`);

--
-- Indexes for table `cms_article`
--
ALTER TABLE `cms_article`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_article_data`
--
ALTER TABLE `cms_article_data`
 ADD PRIMARY KEY (`articleid`);

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
-- Indexes for table `cms_custom_link`
--
ALTER TABLE `cms_custom_link`
 ADD PRIMARY KEY (`linkid`);

--
-- Indexes for table `cms_message`
--
ALTER TABLE `cms_message`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_page`
--
ALTER TABLE `cms_page`
 ADD PRIMARY KEY (`pageid`);

--
-- Indexes for table `cms_piece`
--
ALTER TABLE `cms_piece`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_uploads`
--
ALTER TABLE `cms_uploads`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms_admin`
--
ALTER TABLE `cms_admin`
MODIFY `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cms_article`
--
ALTER TABLE `cms_article`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cms_banner`
--
ALTER TABLE `cms_banner`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cms_category`
--
ALTER TABLE `cms_category`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `cms_message`
--
ALTER TABLE `cms_message`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cms_piece`
--
ALTER TABLE `cms_piece`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cms_uploads`
--
ALTER TABLE `cms_uploads`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
