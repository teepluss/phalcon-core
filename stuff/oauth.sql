/*
 Navicat Premium Data Transfer

 Source Server         : Vagrant ScotchBox
 Source Server Type    : MySQL
 Source Server Version : 50543
 Source Host           : localhost
 Source Database       : core

 Target Server Type    : MySQL
 Target Server Version : 50543
 File Encoding         : utf-8

 Date: 06/11/2015 11:35:12 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `oauth_access_token_scopes`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_token_scopes`;
CREATE TABLE `oauth_access_token_scopes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `access_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `scope` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `access_token` (`access_token`),
  KEY `scope` (`scope`),
  CONSTRAINT `oauth_access_token_scopes_ibfk_1` FOREIGN KEY (`access_token`) REFERENCES `oauth_access_tokens` (`access_token`) ON DELETE CASCADE,
  CONSTRAINT `oauth_access_token_scopes_ibfk_2` FOREIGN KEY (`scope`) REFERENCES `oauth_scopes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `oauth_access_tokens`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `access_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `session_id` int(10) unsigned NOT NULL,
  `expire_time` int(11) NOT NULL,
  PRIMARY KEY (`access_token`),
  KEY `session_id` (`session_id`),
  CONSTRAINT `oauth_access_tokens_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `oauth_sessions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `oauth_auth_code_scopes`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_code_scopes`;
CREATE TABLE `oauth_auth_code_scopes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `auth_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `scope` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_code` (`auth_code`),
  KEY `scope` (`scope`),
  CONSTRAINT `oauth_auth_code_scopes_ibfk_1` FOREIGN KEY (`auth_code`) REFERENCES `oauth_auth_codes` (`auth_code`) ON DELETE CASCADE,
  CONSTRAINT `oauth_auth_code_scopes_ibfk_2` FOREIGN KEY (`scope`) REFERENCES `oauth_scopes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `oauth_auth_codes`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `auth_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `session_id` int(10) unsigned NOT NULL,
  `expire_time` int(11) NOT NULL,
  `client_redirect_uri` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`auth_code`),
  KEY `session_id` (`session_id`),
  CONSTRAINT `oauth_auth_codes_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `oauth_sessions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `oauth_client_redirect_uris`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_client_redirect_uris`;
CREATE TABLE `oauth_client_redirect_uris` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `redirect_uri` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `oauth_client_redirect_uris`
-- ----------------------------
BEGIN;
INSERT INTO `oauth_client_redirect_uris` VALUES ('1', 'testclient', 'http://localhost/redirect');
COMMIT;

-- ----------------------------
--  Table structure for `oauth_clients`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `oauth_clients`
-- ----------------------------
BEGIN;
INSERT INTO `oauth_clients` VALUES ('testclient', 'secret', 'Test Client');
COMMIT;

-- ----------------------------
--  Table structure for `oauth_refresh_tokens`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `refresh_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expire_time` int(11) NOT NULL,
  `access_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`refresh_token`),
  KEY `access_token` (`access_token`),
  CONSTRAINT `oauth_refresh_tokens_ibfk_1` FOREIGN KEY (`access_token`) REFERENCES `oauth_access_tokens` (`access_token`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `oauth_scopes`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_scopes`;
CREATE TABLE `oauth_scopes` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `oauth_scopes`
-- ----------------------------
BEGIN;
INSERT INTO `oauth_scopes` VALUES ('basic', 'Basic details about your account'), ('email', 'Your email address'), ('photo', 'Your photo');
COMMIT;

-- ----------------------------
--  Table structure for `oauth_session_scopes`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_session_scopes`;
CREATE TABLE `oauth_session_scopes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` int(10) unsigned NOT NULL,
  `scope` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `scope` (`scope`),
  KEY `session_id` (`session_id`),
  CONSTRAINT `oauth_session_scopes_ibfk_1` FOREIGN KEY (`scope`) REFERENCES `oauth_scopes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `oauth_session_scopes_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `oauth_sessions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `oauth_session_scopes`
-- ----------------------------
BEGIN;
INSERT INTO `oauth_session_scopes` VALUES ('1', '2', 'basic'), ('2', '4', 'basic'), ('3', '8', 'basic'), ('4', '10', 'basic'), ('5', '12', 'basic'), ('6', '14', 'basic'), ('7', '17', 'basic'), ('8', '19', 'basic'), ('9', '20', 'basic'), ('10', '21', 'basic'), ('11', '22', 'basic'), ('12', '23', 'basic'), ('13', '24', 'basic'), ('14', '25', 'basic'), ('15', '26', 'basic'), ('16', '27', 'basic'), ('17', '28', 'basic'), ('18', '29', 'basic'), ('19', '30', 'basic'), ('20', '31', 'basic'), ('21', '32', 'basic'), ('22', '33', 'basic'), ('23', '34', 'basic'), ('24', '35', 'basic'), ('25', '36', 'basic'), ('26', '41', 'basic'), ('27', '42', 'basic'), ('28', '43', 'basic'), ('29', '44', 'basic'), ('30', '45', 'basic'), ('31', '46', 'basic'), ('32', '47', 'basic'), ('33', '48', 'basic'), ('34', '49', 'basic'), ('35', '50', 'basic'), ('36', '51', 'basic'), ('37', '52', 'basic'), ('38', '53', 'basic'), ('39', '54', 'basic'), ('40', '55', 'basic'), ('41', '56', 'basic'), ('42', '57', 'basic'), ('43', '58', 'basic'), ('44', '59', 'basic'), ('45', '60', 'basic'), ('46', '61', 'basic');
COMMIT;

-- ----------------------------
--  Table structure for `oauth_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_sessions`;
CREATE TABLE `oauth_sessions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_redirect_uri` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `oauth_sessions_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `oauth_clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `oauth_sessions`
-- ----------------------------
BEGIN;
INSERT INTO `oauth_sessions` VALUES ('1', 'client', 'testclient', 'testclient', null), ('2', 'client', 'testclient', 'testclient', null), ('3', 'client', 'testclient', 'testclient', null), ('4', 'client', 'testclient', 'testclient', null), ('5', 'client', 'testclient', 'testclient', null), ('6', 'client', 'testclient', 'testclient', null), ('7', 'client', 'testclient', 'testclient', null), ('8', 'client', 'testclient', 'testclient', null), ('9', 'client', 'testclient', 'testclient', null), ('10', 'client', 'testclient', 'testclient', null), ('11', 'client', 'testclient', 'testclient', null), ('12', 'client', 'testclient', 'testclient', null), ('13', 'client', 'testclient', 'testclient', null), ('14', 'client', 'testclient', 'testclient', null), ('15', 'client', 'testclient', 'testclient', null), ('16', 'client', 'testclient', 'testclient', null), ('17', 'client', 'testclient', 'testclient', null), ('18', 'client', 'testclient', 'testclient', null), ('19', 'client', 'testclient', 'testclient', null), ('20', 'user', 'sumeko', 'testclient', null), ('21', 'user', 'sumeko', 'testclient', null), ('22', 'user', 'sumeko', 'testclient', null), ('23', 'user', 'sumeko', 'testclient', null), ('24', 'user', 'sumeko', 'testclient', null), ('25', 'user', 'sumeko', 'testclient', null), ('26', 'user', 'sumeko', 'testclient', null), ('27', 'user', 'sumeko', 'testclient', null), ('28', 'client', 'testclient', 'testclient', null), ('29', 'client', 'testclient', 'testclient', null), ('30', 'client', 'testclient', 'testclient', null), ('31', 'client', 'testclient', 'testclient', null), ('32', 'client', 'testclient', 'testclient', null), ('33', 'client', 'testclient', 'testclient', null), ('34', 'client', 'testclient', 'testclient', null), ('35', 'user', 'sumeko', 'testclient', null), ('36', 'user', 'sumeko', 'testclient', null), ('37', 'client', 'testclient', 'testclient', null), ('38', 'client', 'testclient', 'testclient', null), ('39', 'client', 'testclient', 'testclient', null), ('40', 'client', 'testclient', 'testclient', null), ('41', 'client', 'testclient', 'testclient', null), ('42', 'client', 'testclient', 'testclient', null), ('43', 'client', 'testclient', 'testclient', null), ('44', 'client', 'testclient', 'testclient', null), ('45', 'user', 'sumeko', 'testclient', null), ('46', 'user', 'sumeko', 'testclient', null), ('47', 'user', 'sumeko', 'testclient', null), ('48', 'user', 'sumeko', 'testclient', null), ('49', 'user', 'sumeko', 'testclient', null), ('50', 'user', 'sumeko', 'testclient', null), ('51', 'user', 'sumeko', 'testclient', null), ('52', 'user', 'sumeko', 'testclient', null), ('53', 'user', 'sumeko', 'testclient', null), ('54', 'user', 'sumeko', 'testclient', null), ('55', 'user', 'sumeko', 'testclient', null), ('56', 'user', 'sumeko', 'testclient', null), ('57', 'user', 'sumeko', 'testclient', null), ('58', 'user', 'sumeko', 'testclient', null), ('59', 'user', 'sumeko', 'testclient', null), ('60', 'user', 'sumeko', 'testclient', null), ('61', 'user', 'sumeko', 'testclient', null), ('62', 'client', 'testclient', 'testclient', null), ('63', 'client', 'testclient', 'testclient', null), ('64', 'client', 'testclient', 'testclient', null), ('65', 'client', 'testclient', 'testclient', null), ('66', 'client', 'testclient', 'testclient', null), ('67', 'client', 'testclient', 'testclient', null), ('68', 'client', 'testclient', 'testclient', null), ('69', 'client', 'testclient', 'testclient', null), ('70', 'client', 'testclient', 'testclient', null), ('71', 'client', 'testclient', 'testclient', null), ('72', 'client', 'testclient', 'testclient', null), ('73', 'client', 'testclient', 'testclient', null), ('74', 'client', 'testclient', 'testclient', null), ('75', 'client', 'testclient', 'testclient', null), ('76', 'client', 'testclient', 'testclient', null), ('77', 'client', 'testclient', 'testclient', null), ('78', 'client', 'testclient', 'testclient', null), ('79', 'client', 'testclient', 'testclient', null), ('80', 'client', 'testclient', 'testclient', null), ('81', 'client', 'testclient', 'testclient', null), ('82', 'client', 'testclient', 'testclient', null), ('83', 'client', 'testclient', 'testclient', null), ('84', 'client', 'testclient', 'testclient', null), ('85', 'client', 'testclient', 'testclient', null), ('86', 'client', 'testclient', 'testclient', null), ('87', 'client', 'testclient', 'testclient', null), ('88', 'client', 'testclient', 'testclient', null), ('89', 'client', 'testclient', 'testclient', null), ('90', 'client', 'testclient', 'testclient', null), ('91', 'client', 'testclient', 'testclient', null), ('92', 'client', 'testclient', 'testclient', null), ('93', 'client', 'testclient', 'testclient', null), ('94', 'client', 'testclient', 'testclient', null);
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('3', 'sumeko', '$2a$08$b7mvfNd7xiGAL3jeP3PqyODksidQDqzyvIJfZ5NPvyT2Acyg0xjqq', 'Sumeko', 'sumeko@live.com', 'https://s.gravatar.com/avatar/14df293d6c5cd6f05996dfc606a6a951');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
