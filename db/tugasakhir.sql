/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : tugasakhir

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 31/12/2020 12:28:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_buku
-- ----------------------------
DROP TABLE IF EXISTS `tbl_buku`;
CREATE TABLE `tbl_buku`  (
  `id_buku` int NOT NULL,
  `foto` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `judul` varchar(75) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `penulis` varchar(75) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `genre` enum('Horor','Fantasi','Romantis','Sci-Fi','Komedi','Misteri','Petulangan','Biografi','Pendidikan','Ensklopedia','Jurnal','Filsafat','Agama') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga` double NULL DEFAULT NULL,
  PRIMARY KEY (`id_buku`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_buku
-- ----------------------------
INSERT INTO `tbl_buku` VALUES (1, '', 'Dilan 1990', 'Pidi Baiq', 'Romantis', 89000);
INSERT INTO `tbl_buku` VALUES (1132, '', '10010', 'EO', 'Horor', 60000);

-- ----------------------------
-- Table structure for tbl_genre
-- ----------------------------
DROP TABLE IF EXISTS `tbl_genre`;
CREATE TABLE `tbl_genre`  (
  `id_genre` int NULL DEFAULT NULL,
  `jurusan` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_genre
-- ----------------------------
INSERT INTO `tbl_genre` VALUES (1, 'Horor\r\nFantasi\r\nRomantis\r');
INSERT INTO `tbl_genre` VALUES (2, 'Fantasi');
INSERT INTO `tbl_genre` VALUES (3, 'Romantis');
INSERT INTO `tbl_genre` VALUES (4, 'Sci-Fi');
INSERT INTO `tbl_genre` VALUES (5, 'Komedi');
INSERT INTO `tbl_genre` VALUES (6, 'Misteri');
INSERT INTO `tbl_genre` VALUES (7, 'Petulangan');
INSERT INTO `tbl_genre` VALUES (8, 'Biografi');
INSERT INTO `tbl_genre` VALUES (9, 'Pendidikan');
INSERT INTO `tbl_genre` VALUES (10, 'Ensklopedia');
INSERT INTO `tbl_genre` VALUES (11, 'Jurnal');
INSERT INTO `tbl_genre` VALUES (12, 'Filsaat');
INSERT INTO `tbl_genre` VALUES (13, 'Agama');

-- ----------------------------
-- Table structure for tbl_penjualan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_penjualan`;
CREATE TABLE `tbl_penjualan`  (
  `id_penjualan` int NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `id_buku` int NOT NULL,
  `jumlah_beli` int NULL DEFAULT NULL,
  `total_beli` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_penjualan
-- ----------------------------
INSERT INTO `tbl_penjualan` VALUES (111, '2020-12-31', 1, 1, 89000);

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user`  (
  `id` int NOT NULL,
  `nama_lengkap` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `username` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `level` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `blokir` enum('N','Y') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_sessions` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES (1, 'Arie Andreana Taufiq', 'admin', 'admin', 'arieandreanataufiq1@gmail.com', 'admin', 'N', '1');

SET FOREIGN_KEY_CHECKS = 1;
