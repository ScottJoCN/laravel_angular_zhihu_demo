/*
Navicat MySQL Data Transfer

Source Server         : scott
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : laravel

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-09-19 11:20:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for answers
-- ----------------------------
DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `answers_user_id_foreign` (`user_id`),
  KEY `answers_question_id_foreign` (`question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of answers
-- ----------------------------
INSERT INTO `answers` VALUES ('1', 'aaa', '2', '1', '2017-08-25 10:48:59', '2017-08-25 15:24:56');
INSERT INTO `answers` VALUES ('2', '泻药', '3', '1', '2017-08-28 10:30:09', '2017-08-28 10:30:09');

-- ----------------------------
-- Table structure for answer_user
-- ----------------------------
DROP TABLE IF EXISTS `answer_user`;
CREATE TABLE `answer_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `answer_id` int(10) unsigned NOT NULL,
  `vote` smallint(5) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `answer_user_user_id_answer_id_vote_unique` (`user_id`,`answer_id`,`vote`),
  KEY `answer_user_answer_id_foreign` (`answer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of answer_user
-- ----------------------------
INSERT INTO `answer_user` VALUES ('3', '2', '2', '1', '2017-08-29 14:55:21', '2017-08-29 14:55:21');
INSERT INTO `answer_user` VALUES ('7', '2', '1', '1', '2017-08-29 15:08:01', '2017-08-29 15:08:01');

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `question_id` int(10) unsigned DEFAULT NULL,
  `answer_id` int(10) unsigned DEFAULT NULL,
  `reply_to` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_question_id_foreign` (`question_id`),
  KEY `comments_answer_id_foreign` (`answer_id`),
  KEY `comments_reply_to_foreign` (`reply_to`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('2', 'sofa2', '3', null, '2', null, '2017-08-28 15:37:31', '2017-08-28 15:37:31');
INSERT INTO `comments` VALUES ('3', 'sofa2', '3', '1', null, null, '2017-08-28 15:39:04', '2017-08-28 15:39:04');
INSERT INTO `comments` VALUES ('4', 'sofa2', '3', null, '1', null, '2017-08-28 15:40:36', '2017-08-28 15:40:36');
INSERT INTO `comments` VALUES ('5', 'sofa2', '3', null, '1', null, '2017-08-28 15:41:07', '2017-08-28 15:41:07');
INSERT INTO `comments` VALUES ('6', '不明觉厉', '3', null, '1', null, '2017-08-28 15:41:39', '2017-08-28 15:41:39');
INSERT INTO `comments` VALUES ('7', '不明觉厉', '3', null, '1', null, '2017-08-28 15:45:23', '2017-08-28 15:45:23');
INSERT INTO `comments` VALUES ('8', '不明觉厉', '3', null, '2', null, '2017-08-28 15:46:46', '2017-08-28 15:46:46');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2017_08_23_011301_create_table_questions', '2');
INSERT INTO `migrations` VALUES ('2017_08_24_173725_create_table_answers', '3');
INSERT INTO `migrations` VALUES ('2017_08_28_103438_create_table_comments', '4');
INSERT INTO `migrations` VALUES ('2017_08_29_114703_create_table_answer_user', '5');
INSERT INTO `migrations` VALUES ('2017_08_29_171150_add_field_phone_captcha', '6');

-- ----------------------------
-- Table structure for questions
-- ----------------------------
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `desc` text COLLATE utf8_unicode_ci COMMENT 'description',
  `user_id` int(10) unsigned NOT NULL,
  `admin_id` int(10) unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ok',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of questions
-- ----------------------------
INSERT INTO `questions` VALUES ('1', '为什么地球是圆的', 'abc', '2', '0', 'ok', '2017-08-24 02:35:24', '2017-08-24 11:05:14');
INSERT INTO `questions` VALUES ('19', '地球为什么不是方的？', '地球为什么不是方的？', '2', '0', 'ok', '2017-09-18 11:37:15', '2017-09-18 11:37:15');
INSERT INTO `questions` VALUES ('3', 'test', 'test', '3', '0', 'ok', '2017-08-24 11:36:39', '2017-08-24 11:36:39');
INSERT INTO `questions` VALUES ('4', 'test', 'test', '2', '0', 'ok', '2017-08-24 11:36:40', '2017-08-24 11:36:40');
INSERT INTO `questions` VALUES ('5', 'test', 'test', '2', '0', 'ok', '2017-08-24 11:36:41', '2017-08-24 11:36:41');
INSERT INTO `questions` VALUES ('6', 'test', 'test', '2', '0', 'ok', '2017-08-24 11:36:42', '2017-08-24 11:36:42');
INSERT INTO `questions` VALUES ('7', 'test', 'test', '2', '0', 'ok', '2017-08-24 11:36:43', '2017-08-24 11:36:43');
INSERT INTO `questions` VALUES ('8', 'test', 'test', '2', '0', 'ok', '2017-08-24 11:36:44', '2017-08-24 11:36:44');
INSERT INTO `questions` VALUES ('9', 'test', 'test', '2', '0', 'ok', '2017-08-24 11:36:44', '2017-08-24 11:36:44');
INSERT INTO `questions` VALUES ('10', 'test', 'test', '2', '0', 'ok', '2017-08-24 11:36:45', '2017-08-24 11:36:45');
INSERT INTO `questions` VALUES ('11', 'test', 'test', '2', '0', 'ok', '2017-08-24 11:36:46', '2017-08-24 11:36:46');
INSERT INTO `questions` VALUES ('12', 'test', 'test', '2', '0', 'ok', '2017-08-24 11:36:47', '2017-08-24 11:36:47');
INSERT INTO `questions` VALUES ('13', 'test', 'test', '2', '0', 'ok', '2017-08-24 11:36:47', '2017-08-24 11:36:47');
INSERT INTO `questions` VALUES ('14', 'test', 'test', '2', '0', 'ok', '2017-08-24 11:36:48', '2017-08-24 11:36:48');
INSERT INTO `questions` VALUES ('15', 'test', 'test', '2', '0', 'ok', '2017-08-24 11:36:48', '2017-08-24 11:36:48');
INSERT INTO `questions` VALUES ('16', 'test', 'test', '2', '0', 'ok', '2017-08-24 11:36:49', '2017-08-24 11:36:49');
INSERT INTO `questions` VALUES ('17', 'test', 'test', '2', '0', 'ok', '2017-08-24 11:36:50', '2017-08-24 11:36:50');
INSERT INTO `questions` VALUES ('18', 'test', 'test', '2', '0', 'ok', '2017-08-24 11:36:52', '2017-08-24 11:36:52');
INSERT INTO `questions` VALUES ('20', 'abcdefg', 'abcdefg', '2', '0', 'ok', '2017-09-18 14:24:12', '2017-09-18 14:24:12');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` text COLLATE utf8_unicode_ci,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone_captcha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'han', null, '$2y$10$7.jQNur2A4MOOD10Dv2OoeMiaQ.Gz7Bcd3jO2VhLjd5FBGGZ0nH.e', null, null, '1234', null, '2017-09-01 11:37:26', '2474');
INSERT INTO `users` VALUES ('2', 'han2', null, '$2y$10$RXR4dJZMbop1ROFJrZLscOiimQ7xa7Bod7KUwbcwbWWPbLiUEHtOy', null, null, '12345', '2017-08-22 07:20:36', '2017-08-29 16:19:50', '');
INSERT INTO `users` VALUES ('3', 'test1', null, '$2y$10$vcgIYiJ8KC5CAaveHVPET.t3ydpkr7eg2VnbQtoZbLHAnmJ8dRgeu', null, null, '123456', '2017-08-28 10:29:53', '2017-08-28 10:29:53', '');
INSERT INTO `users` VALUES ('4', 'han222', null, '$2y$10$QueBlGBUZpkUg7rQ84LxO.ntRv/V59mrarR.VelwRWSX2WNUe0N96', null, null, null, '2017-09-07 17:29:32', '2017-09-07 17:29:32', '');
INSERT INTO `users` VALUES ('5', 'abcdefg', null, '$2y$10$yhEo0wbsd8foK15J5napDeu0EVz5i4INfhJO7oqhGeWFLzKAIehl6', null, null, null, '2017-09-07 17:35:49', '2017-09-07 17:35:49', '');
