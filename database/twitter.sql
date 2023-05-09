/*
 Navicat Premium Data Transfer

 Source Server         : mysql_w
 Source Server Type    : MySQL
 Source Server Version : 80021
 Source Host           : localhost:3306
 Source Schema         : twitter

 Target Server Type    : MySQL
 Target Server Version : 80021
 File Encoding         : 65001

 Date: 15/01/2021 21:52:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment`  (
  `comment_id` int(0) NOT NULL AUTO_INCREMENT,
  `comment_status` varchar(145) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `comment_by` int(0) NOT NULL,
  `comment_tweet` int(0) NOT NULL,
  `comment_create_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`comment_id`) USING BTREE,
  INDEX `fk_comt_u`(`comment_by`) USING BTREE,
  INDEX `fk_comt_t`(`comment_tweet`) USING BTREE,
  CONSTRAINT `fk_comt_t` FOREIGN KEY (`comment_tweet`) REFERENCES `tweets` (`tweet_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_comt_u` FOREIGN KEY (`comment_by`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for follow
-- ----------------------------
DROP TABLE IF EXISTS `follow`;
CREATE TABLE `follow`  (
  `follow_id` int(0) NOT NULL AUTO_INCREMENT,
  `user_sender` int(0) NULL DEFAULT NULL,
  `user_receive` int(0) NULL DEFAULT NULL,
  `follow_create_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`follow_id`) USING BTREE,
  INDEX `fk_sender_us`(`user_sender`) USING BTREE,
  INDEX `fk_receive_us`(`user_receive`) USING BTREE,
  CONSTRAINT `fk_receive_us` FOREIGN KEY (`user_receive`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_sender_us` FOREIGN KEY (`user_sender`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 69 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of follow
-- ----------------------------
INSERT INTO `follow` VALUES (42, 3, 1, '2020-12-02 22:54:29');
INSERT INTO `follow` VALUES (68, 1, 3, '2021-01-14 21:22:03');
INSERT INTO `follow` VALUES (69, 122, 1, '2021-01-15 20:57:47');

-- ----------------------------
-- Table structure for likes
-- ----------------------------
DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes`  (
  `like_id` int(0) NOT NULL AUTO_INCREMENT,
  `user_id` int(0) NULL DEFAULT NULL,
  `tweet_id` int(0) NULL DEFAULT NULL,
  `retweet_id` int(0) NULL DEFAULT NULL,
  `like_date` datetime(0) NULL DEFAULT NULL,
  `like_type` enum('tweet','retweet') CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`like_id`) USING BTREE,
  INDEX `fk_like_user`(`user_id`) USING BTREE,
  INDEX `fk_like_tweet`(`tweet_id`) USING BTREE,
  CONSTRAINT `fk_like_tweet` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`tweet_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_like_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 70 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of likes
-- ----------------------------
INSERT INTO `likes` VALUES (69, 1, 70, NULL, '2021-01-14 22:04:46', 'tweet');
INSERT INTO `likes` VALUES (77, 3, 70, NULL, '2021-01-15 20:29:16', 'tweet');

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message`  (
  `message_id` int(0) NOT NULL AUTO_INCREMENT,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `message_to` int(0) NULL DEFAULT NULL,
  `message_from` int(0) NULL DEFAULT NULL,
  `create_date` datetime(0) NULL DEFAULT NULL,
  `message_status` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`message_id`) USING BTREE,
  INDEX `fk_msgto_us`(`message_to`) USING BTREE,
  INDEX `fk_msgfrom_us`(`message_from`) USING BTREE,
  CONSTRAINT `fk_msgfrom_us` FOREIGN KEY (`message_from`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_msgto_us` FOREIGN KEY (`message_to`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 47 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES (42, 'xin chào', 1, 122, '2021-01-15 17:13:32', 1);
INSERT INTO `message` VALUES (43, 'tôi là nhật', 122, 1, '2021-01-15 17:13:47', 1);
INSERT INTO `message` VALUES (44, 'còn bạn ', 122, 1, '2021-01-15 17:13:50', 1);
INSERT INTO `message` VALUES (45, 'tôi là guard', 1, 122, '2021-01-15 17:14:05', 1);
INSERT INTO `message` VALUES (46, 'xin chào', 122, 1, '2021-01-15 19:48:56', 1);
INSERT INTO `message` VALUES (47, 'hello', 122, 1, '2021-01-15 20:54:21', 1);

-- ----------------------------
-- Table structure for notification
-- ----------------------------
DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification`  (
  `notification_id` int(0) NOT NULL AUTO_INCREMENT,
  `notification_for` int(0) NULL DEFAULT NULL,
  `notification_from` int(0) NULL DEFAULT NULL,
  `target` int(0) NULL DEFAULT NULL,
  `type` enum('follow','retweet','like','metion') CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `create_date` datetime(0) NULL DEFAULT NULL,
  `status` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`notification_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of notification
-- ----------------------------
INSERT INTO `notification` VALUES (42, 1, 3, 70, 'like', '2021-01-15 20:29:16', 1);
INSERT INTO `notification` VALUES (45, 1, 3, 70, 'retweet', '2021-01-15 20:52:58', 1);
INSERT INTO `notification` VALUES (46, 1, 122, 0, 'follow', '2021-01-15 20:57:47', 1);

-- ----------------------------
-- Table structure for retweets
-- ----------------------------
DROP TABLE IF EXISTS `retweets`;
CREATE TABLE `retweets`  (
  `retweet_id` int(0) NOT NULL AUTO_INCREMENT,
  `retweet_status` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `user_retweet` int(0) NULL DEFAULT NULL,
  `tweet_id` int(0) NULL DEFAULT NULL,
  `like_count` int(0) NULL DEFAULT NULL,
  `post_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`retweet_id`) USING BTREE,
  INDEX `fk_rt_us`(`user_retweet`) USING BTREE,
  INDEX `fk_rt_tw`(`tweet_id`) USING BTREE,
  CONSTRAINT `fk_rt_tw` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`tweet_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_rt_us` FOREIGN KEY (`user_retweet`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of retweets
-- ----------------------------
INSERT INTO `retweets` VALUES (18, 'retwet', 3, 70, 0, '2021-01-15 20:52:57');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `role_id` int(0) NOT NULL AUTO_INCREMENT,
  `role_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `role_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES (1, 'USER', 'USER');
INSERT INTO `role` VALUES (2, 'ADMIN', 'ADMIN');

-- ----------------------------
-- Table structure for trends
-- ----------------------------
DROP TABLE IF EXISTS `trends`;
CREATE TABLE `trends`  (
  `trend_id` int(0) NOT NULL AUTO_INCREMENT,
  `hashtag` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `trend_status` int(0) NULL DEFAULT NULL,
  `count_used` int(0) NULL DEFAULT NULL,
  `trends_create_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`trend_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trends
-- ----------------------------
INSERT INTO `trends` VALUES (19, 'vku', 1, 1, '2021-01-15 21:43:34');

-- ----------------------------
-- Table structure for tweets
-- ----------------------------
DROP TABLE IF EXISTS `tweets`;
CREATE TABLE `tweets`  (
  `tweet_id` int(0) NOT NULL AUTO_INCREMENT,
  `tweet_status` varchar(140) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `tweet_userid` int(0) NULL DEFAULT NULL,
  `tweet_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `likes_count` int(0) NULL DEFAULT NULL,
  `tweet_create_date` datetime(0) NULL DEFAULT NULL,
  `retweet_count` int(0) NULL DEFAULT NULL,
  `status` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`tweet_id`) USING BTREE,
  INDEX `fk_tw_us`(`tweet_userid`) USING BTREE,
  CONSTRAINT `fk_tw_us` FOREIGN KEY (`tweet_userid`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 75 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tweets
-- ----------------------------
INSERT INTO `tweets` VALUES (70, '#vku xin chào vku', 1, 'public/imagetweet/FB_IMG_1540718623965.jpg', 2, '2020-12-02 21:49:11', 1, 1);
INSERT INTO `tweets` VALUES (73, '@nhat123 tag', 3, '', 0, '2020-12-09 13:08:10', 0, 1);
INSERT INTO `tweets` VALUES (78, 'I love the card that she got, the card says that the worst is now behind her& positive new experiences are on the horizon', 1, 'public/imagetweet/En4254kVgAITs9j.jpg', 0, '2021-01-15 21:18:59', 0, 1);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `user_id` int(0) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `screen_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `profile_image` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `profile_cover` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `following` int(0) NULL DEFAULT NULL,
  `followers` int(0) NULL DEFAULT NULL,
  `bio` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `role_id` int(0) NULL DEFAULT NULL,
  `user_status` int(0) NULL DEFAULT NULL,
  `user_create_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  INDEX `fk_us_role`(`role_id`) USING BTREE,
  CONSTRAINT `fk_us_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 222 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'nhat123', 'nhatkt21@gmail.com', '123456', 'lenhat132', 'public/imageUser/62 - Cl0pnsY.jpg', 'public/imageUser/312 - TYx9JM4.jpg', 2, 1, 'hello', 'viet nam', '', 2, 1, '2020-12-07 22:26:49');
INSERT INTO `users` VALUES (3, 'NGUYENVANA', 'a@gmail.com', '1234567', 'nguyễn văn A', 'public/imageUser/5 - s7hHbrm.jpg', 'public/imageUser/microsoft-thua-nhan-loi-tu-khoi-dong-lai-do-ban-cap-nhat-windows-10-e52-5042064.jpg', 1, 1, 'asa', NULL, NULL, 2, 1, '2020-12-07 22:26:52');
INSERT INTO `users` VALUES (15, 'leducnhat', 'nhatkt2ddd1@gmail.com', '12323232', 'Lê Nhật', 'public/imageUser/28 - uzJFj76.png', 'public/imageUser/microsoft-thua-nhan-loi-tu-khoi-dong-lai-do-ban-cap-nhat-windows-10-e52-5042064.jpg', 0, 0, 'ddsdsd', NULL, NULL, 2, 1, '2020-12-07 22:26:55');
INSERT INTO `users` VALUES (18, 'nhat', 'nhat2@gmail.com', '1234567', 'Lê Nhật', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2020-12-07 22:26:58');
INSERT INTO `users` VALUES (19, 'nhat2', 'nhat3@gmail.com', '124565', 'Hiển thị 1', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2020-12-07 22:27:01');
INSERT INTO `users` VALUES (20, 'lethiennhan', 'lethiennhan.qn@gmail.com', '20102001', 'Thiện Nhân', 'public/imageUser/shin.jpg', 'public/imageUser/map.jpg', 0, 0, '', '', '', 2, 1, '2020-12-07 22:27:04');
INSERT INTO `users` VALUES (21, 'admin', 'admin@gmail.com', '123456', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL);
INSERT INTO `users` VALUES (122, 'Guard1', 'Guard1@gmail.com', '123456', 'MOD số 122', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 1, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (123, 'Guard2', 'Guard2@gmail.com', '123456', 'MOD số 123', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (124, 'Guard3', 'Guard3@gmail.com', '123456', 'MOD số 124', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (125, 'Guard4', 'Guard4@gmail.com', '123456', 'MOD số 125', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (126, 'Guard5', 'Guard5@gmail.com', '123456', 'MOD số 126', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (127, 'Guard6', 'Guard6@gmail.com', '123456', 'MOD số 127', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (128, 'Guard7', 'Guard7@gmail.com', '123456', 'MOD số 128', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (129, 'Guard8', 'Guard8@gmail.com', '123456', 'MOD số 129', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (130, 'Guard9', 'Guard9@gmail.com', '123456', 'MOD số 130', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (131, 'Guard10', 'Guard10@gmail.com', '123456', 'MOD số 131', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (132, 'Guard11', 'Guard11@gmail.com', '123456', 'MOD số 132', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (133, 'Guard12', 'Guard12@gmail.com', '123456', 'MOD số 133', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (134, 'Guard13', 'Guard13@gmail.com', '123456', 'MOD số 134', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (135, 'Guard14', 'Guard14@gmail.com', '123456', 'MOD số 135', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (136, 'Guard15', 'Guard15@gmail.com', '123456', 'MOD số 136', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (137, 'Guard16', 'Guard16@gmail.com', '123456', 'MOD số 137', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (138, 'Guard17', 'Guard17@gmail.com', '123456', 'MOD số 138', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (139, 'Guard18', 'Guard18@gmail.com', '123456', 'MOD số 139', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (140, 'Guard19', 'Guard19@gmail.com', '123456', 'MOD số 140', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (141, 'Guard20', 'Guard20@gmail.com', '123456', 'MOD số 141', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (142, 'Guard21', 'Guard21@gmail.com', '123456', 'MOD số 142', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (143, 'Guard22', 'Guard22@gmail.com', '123456', 'MOD số 143', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (144, 'Guard23', 'Guard23@gmail.com', '123456', 'MOD số 144', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (145, 'Guard24', 'Guard24@gmail.com', '123456', 'MOD số 145', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (146, 'Guard25', 'Guard25@gmail.com', '123456', 'MOD số 146', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (147, 'Guard26', 'Guard26@gmail.com', '123456', 'MOD số 147', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (148, 'Guard27', 'Guard27@gmail.com', '123456', 'MOD số 148', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (149, 'Guard28', 'Guard28@gmail.com', '123456', 'MOD số 149', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (150, 'Guard29', 'Guard29@gmail.com', '123456', 'MOD số 150', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (151, 'Guard30', 'Guard30@gmail.com', '123456', 'MOD số 151', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (152, 'Guard31', 'Guard31@gmail.com', '123456', 'MOD số 152', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (153, 'Guard32', 'Guard32@gmail.com', '123456', 'MOD số 153', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (154, 'Guard33', 'Guard33@gmail.com', '123456', 'MOD số 154', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (155, 'Guard34', 'Guard34@gmail.com', '123456', 'MOD số 155', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (156, 'Guard35', 'Guard35@gmail.com', '123456', 'MOD số 156', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (157, 'Guard36', 'Guard36@gmail.com', '123456', 'MOD số 157', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (158, 'Guard37', 'Guard37@gmail.com', '123456', 'MOD số 158', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (159, 'Guard38', 'Guard38@gmail.com', '123456', 'MOD số 159', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (160, 'Guard39', 'Guard39@gmail.com', '123456', 'MOD số 160', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (161, 'Guard40', 'Guard40@gmail.com', '123456', 'MOD số 161', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (162, 'Guard41', 'Guard41@gmail.com', '123456', 'MOD số 162', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (163, 'Guard42', 'Guard42@gmail.com', '123456', 'MOD số 163', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (164, 'Guard43', 'Guard43@gmail.com', '123456', 'MOD số 164', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (165, 'Guard44', 'Guard44@gmail.com', '123456', 'MOD số 165', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (166, 'Guard45', 'Guard45@gmail.com', '123456', 'MOD số 166', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (167, 'Guard46', 'Guard46@gmail.com', '123456', 'MOD số 167', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (168, 'Guard47', 'Guard47@gmail.com', '123456', 'MOD số 168', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (169, 'Guard48', 'Guard48@gmail.com', '123456', 'MOD số 169', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (170, 'Guard49', 'Guard49@gmail.com', '123456', 'MOD số 170', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (171, 'Guard50', 'Guard50@gmail.com', '123456', 'MOD số 171', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (172, 'Guard51', 'Guard51@gmail.com', '123456', 'MOD số 172', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (173, 'Guard52', 'Guard52@gmail.com', '123456', 'MOD số 173', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (174, 'Guard53', 'Guard53@gmail.com', '123456', 'MOD số 174', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (175, 'Guard54', 'Guard54@gmail.com', '123456', 'MOD số 175', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (176, 'Guard55', 'Guard55@gmail.com', '123456', 'MOD số 176', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (177, 'Guard56', 'Guard56@gmail.com', '123456', 'MOD số 177', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (178, 'Guard57', 'Guard57@gmail.com', '123456', 'MOD số 178', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (179, 'Guard58', 'Guard58@gmail.com', '123456', 'MOD số 179', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (180, 'Guard59', 'Guard59@gmail.com', '123456', 'MOD số 180', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (181, 'Guard60', 'Guard60@gmail.com', '123456', 'MOD số 181', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (182, 'Guard61', 'Guard61@gmail.com', '123456', 'MOD số 182', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (183, 'Guard62', 'Guard62@gmail.com', '123456', 'MOD số 183', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (184, 'Guard63', 'Guard63@gmail.com', '123456', 'MOD số 184', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (185, 'Guard64', 'Guard64@gmail.com', '123456', 'MOD số 185', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (186, 'Guard65', 'Guard65@gmail.com', '123456', 'MOD số 186', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (187, 'Guard66', 'Guard66@gmail.com', '123456', 'MOD số 187', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (188, 'Guard67', 'Guard67@gmail.com', '123456', 'MOD số 188', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (189, 'Guard68', 'Guard68@gmail.com', '123456', 'MOD số 189', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (190, 'Guard69', 'Guard69@gmail.com', '123456', 'MOD số 190', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (191, 'Guard70', 'Guard70@gmail.com', '123456', 'MOD số 191', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (192, 'Guard71', 'Guard71@gmail.com', '123456', 'MOD số 192', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (193, 'Guard72', 'Guard72@gmail.com', '123456', 'MOD số 193', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (194, 'Guard73', 'Guard73@gmail.com', '123456', 'MOD số 194', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (195, 'Guard74', 'Guard74@gmail.com', '123456', 'MOD số 195', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (196, 'Guard75', 'Guard75@gmail.com', '123456', 'MOD số 196', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (197, 'Guard76', 'Guard76@gmail.com', '123456', 'MOD số 197', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (198, 'Guard77', 'Guard77@gmail.com', '123456', 'MOD số 198', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (199, 'Guard78', 'Guard78@gmail.com', '123456', 'MOD số 199', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (200, 'Guard79', 'Guard79@gmail.com', '123456', 'MOD số 200', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (201, 'Guard80', 'Guard80@gmail.com', '123456', 'MOD số 201', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (202, 'Guard81', 'Guard81@gmail.com', '123456', 'MOD số 202', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (203, 'Guard82', 'Guard82@gmail.com', '123456', 'MOD số 203', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (204, 'Guard83', 'Guard83@gmail.com', '123456', 'MOD số 204', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (205, 'Guard84', 'Guard84@gmail.com', '123456', 'MOD số 205', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (206, 'Guard85', 'Guard85@gmail.com', '123456', 'MOD số 206', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (207, 'Guard86', 'Guard86@gmail.com', '123456', 'MOD số 207', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (208, 'Guard87', 'Guard87@gmail.com', '123456', 'MOD số 208', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (209, 'Guard88', 'Guard88@gmail.com', '123456', 'MOD số 209', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (210, 'Guard89', 'Guard89@gmail.com', '123456', 'MOD số 210', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (211, 'Guard90', 'Guard90@gmail.com', '123456', 'MOD số 211', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (212, 'Guard91', 'Guard91@gmail.com', '123456', 'MOD số 212', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (213, 'Guard92', 'Guard92@gmail.com', '123456', 'MOD số 213', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (214, 'Guard93', 'Guard93@gmail.com', '123456', 'MOD số 214', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (215, 'Guard94', 'Guard94@gmail.com', '123456', 'MOD số 215', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (216, 'Guard95', 'Guard95@gmail.com', '123456', 'MOD số 216', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (217, 'Guard96', 'Guard96@gmail.com', '123456', 'MOD số 217', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (218, 'Guard97', 'Guard97@gmail.com', '123456', 'MOD số 218', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (219, 'Guard98', 'Guard98@gmail.com', '123456', 'MOD số 219', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (220, 'Guard99', 'Guard99@gmail.com', '123456', 'MOD số 220', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');
INSERT INTO `users` VALUES (221, 'Guard100', 'Guard100@gmail.com', '123456', 'MOD số 221', 'public/images/profile_img/defaultProfileImage.png', 'public/images/profile_cover/defaultCoverImage.png', 0, 0, NULL, NULL, NULL, 2, 1, '2021-01-14 20:40:50');

-- ----------------------------
-- Procedure structure for statistic_notification
-- ----------------------------
DROP PROCEDURE IF EXISTS `statistic_notification`;
delimiter ;;
CREATE PROCEDURE `statistic_notification`(_userId INT(11))
SELECT * FROM notification AS N INNER JOIN users AS U on N.notification_from  = U.user_id 
LEFT JOIN tweets AS T ON N.target = T.tweet_id 
LEFT JOIN likes AS L ON N.target = L.tweet_id 
LEFT JOIN retweets AS R ON N.target = R.tweet_id
INNER JOIN follow AS F ON N.notification_from = F.user_sender AND N.notification_for = F.user_receive 
WHERE N.notification_for = _userId AND N.notification_from != _userId GROUP BY notification_id
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
