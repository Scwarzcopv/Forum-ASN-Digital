CREATE DATABASE IF NOT EXISTS forum_asn_digital;
USE forum_asn_digital;
/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 100424
 Source Host           : localhost:3306
 Source Schema         : forum_asn_digital

 Target Server Type    : MySQL
 Target Server Version : 100424
 File Encoding         : 65001

 Date: 20/07/2023 10:10:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `image` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `role_id` int(11) NULL DEFAULT NULL,
  `is_active` int(11) NULL DEFAULT NULL,
  `date_created` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'Bang Admin', 'admin', 'default.png', '$2y$10$mzx.bNPZGi3nmdarNDM4tuk2slLpJhaNafHWYq9bnEbEHL1Dsneku', 2, 1, 1689741359);
INSERT INTO `user` VALUES (2, 'Super Admin', 'superadmin', 'default.png', '$2y$10$dr6zOmdfHeN6le9BAn.1WuOi98uMJAqBmmK9iMMJztombWuuJW/7K', 1, 1, 1689763607);
INSERT INTO `user` VALUES (5, 'Bang User', 'user', 'default.png', '$2y$10$j1q8O2OAd61MHFDnQ6y9A.lpyE9WRg1gOb.3KSPqSXtSN9NFI.oj.', 3, 1, 1689778556);

-- ----------------------------
-- Table structure for user_access_menu
-- ----------------------------
DROP TABLE IF EXISTS `user_access_menu`;
CREATE TABLE `user_access_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NULL DEFAULT NULL,
  `role_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_access_menu
-- ----------------------------
INSERT INTO `user_access_menu` VALUES (1, 1, 1);
INSERT INTO `user_access_menu` VALUES (2, 1, 2);
INSERT INTO `user_access_menu` VALUES (3, 2, 1);
INSERT INTO `user_access_menu` VALUES (4, 2, 2);
INSERT INTO `user_access_menu` VALUES (5, 3, 3);
INSERT INTO `user_access_menu` VALUES (6, 4, 1);
INSERT INTO `user_access_menu` VALUES (7, 4, 2);
INSERT INTO `user_access_menu` VALUES (8, 4, 3);
INSERT INTO `user_access_menu` VALUES (9, 5, 1);
INSERT INTO `user_access_menu` VALUES (10, 5, 2);
INSERT INTO `user_access_menu` VALUES (11, 5, 3);
INSERT INTO `user_access_menu` VALUES (12, 6, 1);
INSERT INTO `user_access_menu` VALUES (13, 7, 1);

-- ----------------------------
-- Table structure for user_menu
-- ----------------------------
DROP TABLE IF EXISTS `user_menu`;
CREATE TABLE `user_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_menu
-- ----------------------------
INSERT INTO `user_menu` VALUES (1, 'Admin');
INSERT INTO `user_menu` VALUES (2, 'Notulen');
INSERT INTO `user_menu` VALUES (3, 'Event');
INSERT INTO `user_menu` VALUES (4, 'Forum');
INSERT INTO `user_menu` VALUES (5, 'User');
INSERT INTO `user_menu` VALUES (6, 'Menu');
INSERT INTO `user_menu` VALUES (7, 'Registration');

-- ----------------------------
-- Table structure for user_role
-- ----------------------------
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_role
-- ----------------------------
INSERT INTO `user_role` VALUES (1, 'Super Administrator');
INSERT INTO `user_role` VALUES (2, 'Administrator');
INSERT INTO `user_role` VALUES (3, 'Member');

-- ----------------------------
-- Table structure for user_sub_menu
-- ----------------------------
DROP TABLE IF EXISTS `user_sub_menu`;
CREATE TABLE `user_sub_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NULL DEFAULT NULL,
  `title` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `url` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `icon` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_active` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_sub_menu
-- ----------------------------
INSERT INTO `user_sub_menu` VALUES (1, 1, 'Dashboard', 'admin', 'fa-solid fa-sliders', 1);
INSERT INTO `user_sub_menu` VALUES (2, 2, 'List Notulen', 'notulen', 'fa-solid fa-clipboard', 1);
INSERT INTO `user_sub_menu` VALUES (3, 2, 'Persetujuan Notulen', 'notulen/persetujuan', 'fa-solid fa-clipboard-check', 1);
INSERT INTO `user_sub_menu` VALUES (4, 2, 'Scan', 'notulen/scan', 'fa-solid fa-qrcode', 1);
INSERT INTO `user_sub_menu` VALUES (5, 3, 'Event', 'event', 'fa-solid fa-clipboard', 1);
INSERT INTO `user_sub_menu` VALUES (6, 3, 'Scan', 'event/scan', 'fa-solid fa-qrcode', 1);
INSERT INTO `user_sub_menu` VALUES (7, 4, 'Forum', 'forum', 'fa-solid fa-comments', 1);
INSERT INTO `user_sub_menu` VALUES (8, 4, 'Pertanyaan Tertunda', 'forum/pertanyaan_tertunda', 'fa-solid fa-layer-group', 1);
INSERT INTO `user_sub_menu` VALUES (9, 4, 'Pertanyaan', 'forum/pertanyaan', 'fa-solid fa-person-circle-question', 1);
INSERT INTO `user_sub_menu` VALUES (10, 5, 'My Profile', 'user', 'fa-solid fa-user', 1);
INSERT INTO `user_sub_menu` VALUES (11, 5, 'Edit Profile', 'user/edit', 'fa-solid fa-pen-to-square', 1);
INSERT INTO `user_sub_menu` VALUES (12, 5, 'Change Password', 'user/change_password', 'fa-solid fa-key', 1);
INSERT INTO `user_sub_menu` VALUES (13, 6, 'Menu Manajemen', 'menu', 'fa-solid fa-book', 1);
INSERT INTO `user_sub_menu` VALUES (14, 6, 'Sub Menu Manajemen', 'menu/submenu', 'fa-solid fa-book-open', 1);
INSERT INTO `user_sub_menu` VALUES (15, 6, 'Role', 'menu/role', 'fa-solid fa-user-gear', 1);
INSERT INTO `user_sub_menu` VALUES (16, 7, 'Registration User', 'registration', 'fa-solid fa-user-plus', 1);

SET FOREIGN_KEY_CHECKS = 1;
