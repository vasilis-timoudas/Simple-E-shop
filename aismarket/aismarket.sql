/*
 Navicat Premium Data Transfer

 Source Server         : root@localhost
 Source Server Type    : MySQL
 Source Server Version : 50620
 Source Host           : localhost
 Source Database       : aismarket

 Target Server Type    : MySQL
 Target Server Version : 50620
 File Encoding         : utf-8

 Date: 11/24/2014 13:59:03 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `PRODUCTS`
-- ----------------------------
DROP TABLE IF EXISTS `PRODUCTS`;
CREATE TABLE `PRODUCTS` (
  `P_ID` int(11) NOT NULL,
  `P_NAME` varchar(100) NOT NULL,
  `P_DESCR` varchar(100) NOT NULL,
  `P_IMGPTH` varchar(100) NOT NULL,
  `P_VALUE` double NOT NULL,
  `P_VAT` double NOT NULL,
  `P_WEI` float NOT NULL,
  `P_QNT` smallint(6) NOT NULL DEFAULT '1',
  UNIQUE KEY `P_ID` (`P_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=greek;

-- ----------------------------
--  Records of `PRODUCTS`
-- ----------------------------
BEGIN;
INSERT INTO `PRODUCTS` VALUES ('1', 'Apple iPhone 4 8GB White GR', 'SMARTPHONE', './images/sphone01.jpg', '194.3', '44.69', '0.137', '4'), ('2', 'Apple iPhone 5 64GB Black GR', 'SMARTPHONE', './images/sphone02.jpg', '405.69', '93.31', '0.112', '37'), ('3', 'Samsung Galaxy Note 4 N910 Black GR', 'SMARTPHONE', './images/sphone03.jpg', '592.68', '136.32', '0.176', '48'), ('4', 'LG G3 16GB D855 Titanium Black GR', 'SMARTPHONE', './images/sphone04.jpg', '324.39', '74.61', '0.149', '12'), ('5', 'Samsung Headset HS5303 Premium Stereo Dark Silver', 'HANDSFREE', './images/hfree01.jpg', '56.83', '13.07', '0.012', '73'), ('6', 'Pentax K-3 Kit Black + 18-135mm WR', 'PHOTO CAMERA', './images/pcam01.jpg', '1161.79', '267.21', '1.202', '3'), ('7', 'Apple MD827ZM/A Earpods With Remote & Mic', 'HANDSFREE', './images/hfree02.jpg', '23.5', '5.4', '0.009', '98'), ('8', 'Canon Powershot G1X Mark II', 'PHOTO CAMERA', './images/pcam02.jpg', '641.46', '147.54', '1.073', '28'), ('9', 'Philips 20PHH4109/88 20\'\' Slim LED TV HDReady Black', 'TV', './images/tv01.jpg', '113.01', '26', '2.8', '54'), ('10', 'Panasonic TX-32A300E 32\'\' LED HD TV', 'TV', './images/tv02.jpg', '200.73', '46.17', '5.7', '92');
COMMIT;

-- ----------------------------
--  Table structure for `USERS`
-- ----------------------------
DROP TABLE IF EXISTS `USERS`;
CREATE TABLE `USERS` (
  `U_ID` int(11) NOT NULL,
  `U_FULLNAME` varchar(100) NOT NULL,
  `U_EMAIL` varchar(100) NOT NULL,
  `U_PASSWD` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=greek;

-- ----------------------------
--  Records of `USERS`
-- ----------------------------
BEGIN;
INSERT INTO `USERS` VALUES ('1', 'rania', 'rania@teipir.gr', '12<34'), ('2', 'user', 'user@edu.gr', '4s3r'), ('3', 'Raymond Reddington', 'red@bl.com', 'r3d'), ('4', 'Olivia Pope', 'liv@wh.com', '0l1v14'), ('5', 'Violet Crawley', 'viocraw@da.co.uk', 'cr4Wl3y');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
