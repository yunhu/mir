/*
Navicat MySQL Data Transfer

Source Server         : f
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : primir

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2013-11-22 16:28:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `mir_article`
-- ----------------------------
DROP TABLE IF EXISTS `mir_article`;
CREATE TABLE `mir_article` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `classify` int(11) NOT NULL,
  `content` text NOT NULL,
  `apply_time` int(11) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mir_article
-- ----------------------------

-- ----------------------------
-- Table structure for `mir_deny_ip`
-- ----------------------------
DROP TABLE IF EXISTS `mir_deny_ip`;
CREATE TABLE `mir_deny_ip` (
  `pid` int(11) NOT NULL DEFAULT '0',
  `ip` int(11) DEFAULT '0',
  `addtime` int(11) DEFAULT '0',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mir_deny_ip
-- ----------------------------

-- ----------------------------
-- Table structure for `mir_email`
-- ----------------------------
DROP TABLE IF EXISTS `mir_email`;
CREATE TABLE `mir_email` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL,
  `email` char(64) NOT NULL,
  `start_time` int(11) NOT NULL,
  `code` char(64) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mir_email
-- ----------------------------

-- ----------------------------
-- Table structure for `mir_find_product`
-- ----------------------------
DROP TABLE IF EXISTS `mir_find_product`;
CREATE TABLE `mir_find_product` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `version` char(20) NOT NULL,
  `desc` char(128) NOT NULL,
  `contact` char(30) NOT NULL,
  `treatment` tinyint(4) NOT NULL,
  `regtime` int(11) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mir_find_product
-- ----------------------------

-- ----------------------------
-- Table structure for `mir_material`
-- ----------------------------
DROP TABLE IF EXISTS `mir_material`;
CREATE TABLE `mir_material` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `pic` char(128) NOT NULL,
  `name` char(20) NOT NULL,
  `download` int(11) NOT NULL DEFAULT '0',
  `need_socre` int(11) NOT NULL DEFAULT '0',
  `desc` char(128) NOT NULL,
  `apply_time` int(11) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mir_material
-- ----------------------------

-- ----------------------------
-- Table structure for `mir_order`
-- ----------------------------
DROP TABLE IF EXISTS `mir_order`;
CREATE TABLE `mir_order` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1包月,2充值',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1未付款，2已付款，3未确认收货，4完成',
  `add_time` int(11) NOT NULL,
  `order` char(16) DEFAULT NULL,
  `money` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mir_order
-- ----------------------------

-- ----------------------------
-- Table structure for `mir_product`
-- ----------------------------
DROP TABLE IF EXISTS `mir_product`;
CREATE TABLE `mir_product` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1不通过',
  `recommand` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1为推荐',
  `domain` char(100) NOT NULL,
  `name` char(30) NOT NULL,
  `serverip` char(30) NOT NULL,
  `server_time` int(11) NOT NULL,
  `line_type` char(30) NOT NULL,
  `version` char(128) NOT NULL,
  `qq` char(30) NOT NULL,
  `pic` char(128) NOT NULL,
  `add_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mir_product
-- ----------------------------

-- ----------------------------
-- Table structure for `mir_user`
-- ----------------------------
DROP TABLE IF EXISTS `mir_user`;
CREATE TABLE `mir_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `pwd` char(64) NOT NULL,
  `email` char(64) NOT NULL,
  `email_status` tinyint(4) NOT NULL DEFAULT '0',
  `phone` int(11) NOT NULL,
  `qq` int(14) NOT NULL,
  `sina` char(30) NOT NULL,
  `lastlogintime` int(11) NOT NULL DEFAULT '0',
  `lastloginip` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1为禁用',
  `level` tinyint(4) NOT NULL DEFAULT '0',
  `gold` int(11) NOT NULL DEFAULT '0',
  `regtime` int(11) NOT NULL,
  `token` char(64) DEFAULT NULL,
  `openid` char(64) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mir_user
-- ----------------------------

-- ----------------------------
-- Table structure for `mir_user_allow`
-- ----------------------------
DROP TABLE IF EXISTS `mir_user_allow`;
CREATE TABLE `mir_user_allow` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '包月',
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `apply_time` int(11) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mir_user_allow
-- ----------------------------

-- ----------------------------
-- Table structure for `mir_user_score`
-- ----------------------------
DROP TABLE IF EXISTS `mir_user_score`;
CREATE TABLE `mir_user_score` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `used_score` int(11) NOT NULL DEFAULT '0',
  `unused_score` int(11) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mir_user_score
-- ----------------------------
DROP TRIGGER IF EXISTS `test`;
DELIMITER ;;
CREATE TRIGGER `test` AFTER INSERT ON `mir_user` FOR EACH ROW begin
insert into mir_user_score(uid) values (new.uid);
end
;;
DELIMITER ;
