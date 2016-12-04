/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.9 : Database - mytube
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mytube` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `mytube`;

/*Table structure for table `channels` */

DROP TABLE IF EXISTS `channels`;

CREATE TABLE `channels` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL COMMENT '频道名称',
  `url` varchar(100) DEFAULT NULL COMMENT '频道的url地址',
  `uploader_url` varchar(100) DEFAULT NULL COMMENT '用户地址',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `content` text COMMENT '评论的内容',
  `commentable_id` int(10) DEFAULT NULL COMMENT '被评论的对象ID',
  `commentable_type` varchar(100) DEFAULT NULL COMMENT '被评论的对象类型',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL COMMENT '谁做的评论',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Table structure for table `movies` */

DROP TABLE IF EXISTS `movies`;

CREATE TABLE `movies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `key` varchar(20) DEFAULT NULL COMMENT 'youtube的key',
  `title` varchar(100) DEFAULT NULL COMMENT '影片名称',
  `description` mediumtext COMMENT '影片的描述',
  `uploader_url` varchar(100) DEFAULT NULL COMMENT '上传者的网址',
  `channel_id` int(10) DEFAULT NULL COMMENT '频道的id',
  `channel_title` varchar(50) DEFAULT NULL COMMENT '频道名称',
  `channel_url` varchar(100) DEFAULT NULL COMMENT '频道的网址',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `playtime` varchar(100) DEFAULT '0' COMMENT '当前播放时间，播放时每一秒更新一次',
  `duration` varchar(100) DEFAULT '1' COMMENT '视频的长度，这个需要计算',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=108 DEFAULT CHARSET=utf8;

/*Table structure for table `playlistables` */

DROP TABLE IF EXISTS `playlistables`;

CREATE TABLE `playlistables` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `playlist_id` int(10) DEFAULT NULL COMMENT '列表id',
  `movie_id` int(10) DEFAULT NULL COMMENT '视频id',
  `index` int(10) DEFAULT NULL COMMENT '视频在列表中的位置',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Table structure for table `playlists` */

DROP TABLE IF EXISTS `playlists`;

CREATE TABLE `playlists` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `title` varchar(100) DEFAULT NULL COMMENT 'playlist的名称',
  `channel_id` int(10) DEFAULT NULL,
  `lastUpdated` varchar(50) DEFAULT NULL COMMENT '列表在网站上最后更新时间',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `taggables` */

DROP TABLE IF EXISTS `taggables`;

CREATE TABLE `taggables` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tag_id` int(10) DEFAULT NULL COMMENT '标签的id',
  `taggable_type` varchar(100) DEFAULT NULL COMMENT '被打标签的对象类型',
  `taggable_id` int(10) DEFAULT NULL COMMENT '被打标签的对象id',
  `user_id` int(10) DEFAULT NULL COMMENT '添加标签的用户',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Table structure for table `tags` */

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '标签的名字',
  `description` text COMMENT '标签的描述',
  `keywords` varchar(100) DEFAULT NULL COMMENT '标签的关键词，以便能够进行相关搜索',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '登录名称',
  `email` varchar(100) DEFAULT NULL COMMENT '登录邮件',
  `password` varchar(100) DEFAULT NULL COMMENT '登录时的密码，需要加密',
  `remember_token` varchar(100) DEFAULT NULL COMMENT '校对自动登录时token是否最新',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notes` tinytext COMMENT '注释说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
