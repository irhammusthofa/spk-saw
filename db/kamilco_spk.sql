/*
 Navicat Premium Data Transfer

 Source Server         : kamil.co.id
 Source Server Type    : MySQL
 Source Server Version : 50644
 Source Host           : kamil.co.id:3306
 Source Schema         : kamilco_spk

 Target Server Type    : MySQL
 Target Server Version : 50644
 File Encoding         : 65001

 Date: 29/06/2019 18:57:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for area
-- ----------------------------
DROP TABLE IF EXISTS `area`;
CREATE TABLE `area` (
  `a_kode` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `a_nama` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `a_alamat` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `a_telp` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `a_kordinat` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_tahun` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`a_kode`),
  KEY `fk_a_id_tahun` (`id_tahun`),
  CONSTRAINT `fk_a_id_tahun` FOREIGN KEY (`id_tahun`) REFERENCES `tahun_berkas` (`thn_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of area
-- ----------------------------
BEGIN;
INSERT INTO `area` VALUES ('001', 'North Sumatera Area', 'Jl. Dr. Wahidin No. 1 Pangkalan Brandan North Sumatera - 20857', '+62-620 323442', NULL, '2019');
INSERT INTO `area` VALUES ('002', 'Central Sumatera Area', 'Jl. AKBP Cek Agus No 10, Kenten, Palembang - 30114', '+62-711 5648507', NULL, '2019');
INSERT INTO `area` VALUES ('003', 'Southern Sumatera Area', 'Jl. AKBP Cek Agus No 10, Kenten, Palembang - 30114', '+62-711 5648511', NULL, '2019');
INSERT INTO `area` VALUES ('004', 'West Java Area', 'Komplek Perumahan Dinas Distrik TGD Jl. Raya Industri Tegalgede South Cikarang, Bekasi - 17550', '+62-21 89833854', NULL, '2019');
INSERT INTO `area` VALUES ('005', '  Eastern Java Area', 'Jl. Darmo Kali No. 40-42 Surabaya 60241', '+62-31 5689901', '-7.508712, 112.207829', '2019');
INSERT INTO `area` VALUES ('006', 'Kalimantan Area', 'KNE Building, Jl. Pupuk Raya No.55, Bontang Barat, Bontang, East Kalimantan Timur 75313', '+62-548 – 41641', NULL, '2019');
COMMIT;

-- ----------------------------
-- Table structure for dyn_groups
-- ----------------------------
DROP TABLE IF EXISTS `dyn_groups`;
CREATE TABLE `dyn_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `abbrev` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Navigation groupings. Eg, header, sidebar, footer, etc';

-- ----------------------------
-- Records of dyn_groups
-- ----------------------------
BEGIN;
INSERT INTO `dyn_groups` VALUES (1, 'Header', 'header');
INSERT INTO `dyn_groups` VALUES (2, 'Sidebar', 'sidebar');
INSERT INTO `dyn_groups` VALUES (3, 'Footer', 'footer');
INSERT INTO `dyn_groups` VALUES (4, 'Topbar', 'topbar');
INSERT INTO `dyn_groups` VALUES (5, 'Sidebar1', 'sidebar1');
INSERT INTO `dyn_groups` VALUES (6, 'Sidebar2', 'sidebar2');
COMMIT;

-- ----------------------------
-- Table structure for dyn_menu
-- ----------------------------
DROP TABLE IF EXISTS `dyn_menu`;
CREATE TABLE `dyn_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'uri',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `module_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `icon` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `uri` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dyn_group_id` int(11) NOT NULL DEFAULT '0',
  `position` int(5) NOT NULL DEFAULT '0',
  `target` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `is_parent` tinyint(1) NOT NULL DEFAULT '0',
  `show_menu` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `role` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of dyn_menu
-- ----------------------------
BEGIN;
INSERT INTO `dyn_menu` VALUES (1, 'Dasbor', 'uri', 1, 'dashboard', 'fa fa-dashboard', 'https://spk.kamil.co.id/user/dashboard', '', 2, 1, NULL, 0, 0, '1', 'user');
INSERT INTO `dyn_menu` VALUES (2, 'Data Area', 'uri', 2, 'area', 'fa fa-file-text', 'https://spk.kamil.co.id/user/area', '', 2, 2, NULL, 0, 0, '1', 'user');
INSERT INTO `dyn_menu` VALUES (3, 'Data Kriteria', 'uri', 3, 'kriteria', 'fa fa-file-text', 'https://spk.kamil.co.id/user/kriteria', '', 2, 3, NULL, 0, 0, '1', 'user');
INSERT INTO `dyn_menu` VALUES (4, 'Penilaian SAW', 'uri', 9, 'penilaian', 'ion ion-stats-bars', 'https://spk.kamil.co.id/user/penilaian', '', 2, 4, NULL, 0, 0, '1', 'user');
INSERT INTO `dyn_menu` VALUES (5, 'Hasil Perhitungan', 'uri', 16, 'saw', 'ion ion-stats-bars', 'https://spk.kamil.co.id/user/saw', '', 2, 5, NULL, 0, 0, '1', 'user');
INSERT INTO `dyn_menu` VALUES (6, 'Grafik Penilaian', 'uri', 17, 'grafik', 'ion ion-pie-graph', 'https://spk.kamil.co.id/user/grafik', '', 2, 6, NULL, 0, 0, '1', 'user');
INSERT INTO `dyn_menu` VALUES (7, 'Laporan Ranking', 'uri', 18, 'saw', 'fa fa-print', 'https://spk.kamil.co.id/user/saw/cetak', '', 2, 7, NULL, 0, 0, '1', 'user');
INSERT INTO `dyn_menu` VALUES (8, 'Laporan SAW', 'uri', 19, 'saw', 'fa fa-print', 'https://spk.kamil.co.id/user/saw/cetak/lengkap', '', 2, 8, NULL, 0, 0, '1', 'user');
INSERT INTO `dyn_menu` VALUES (9, 'Tahun Berkas', 'uri', 20, 'tahun', 'fa fa-file-text', 'https://spk.kamil.co.id/user/tahun', '', 2, 1, NULL, 0, 0, '1', 'user');
COMMIT;

-- ----------------------------
-- Table structure for kriteria
-- ----------------------------
DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE `kriteria` (
  `k_kode` varchar(50) NOT NULL DEFAULT '',
  `k_nama` varchar(50) DEFAULT NULL,
  `k_bobot` int(10) DEFAULT NULL,
  `id_tahun` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`k_kode`),
  KEY `fk_k_id_tahun` (`id_tahun`),
  CONSTRAINT `fk_k_id_tahun` FOREIGN KEY (`id_tahun`) REFERENCES `tahun_berkas` (`thn_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kriteria
-- ----------------------------
BEGIN;
INSERT INTO `kriteria` VALUES ('C01', 'HSE Meeting', 3, '2019');
INSERT INTO `kriteria` VALUES ('C02', 'HSE Talk/Briefing', 4, '2019');
INSERT INTO `kriteria` VALUES ('C03', 'Inspeksi Lokasi Kerja', 3, '2019');
INSERT INTO `kriteria` VALUES ('C04', 'Tindakan Perbaikan', 5, '2019');
INSERT INTO `kriteria` VALUES ('C05', 'Pengawasan Pekerjaan', 5, '2019');
INSERT INTO `kriteria` VALUES ('C06', 'Fire Drill', 5, '2019');
INSERT INTO `kriteria` VALUES ('C07', 'Simulasi Tanggap Darurat', 3, '2019');
INSERT INTO `kriteria` VALUES ('C08', 'Inspeksi Peralatan Gas Detection, fire and safety', 3, '2019');
INSERT INTO `kriteria` VALUES ('C09', 'HSE Leasson Learned Sharing', 4, '2019');
INSERT INTO `kriteria` VALUES ('C10', 'Managemen Walk Trought', 4, '2019');
COMMIT;

-- ----------------------------
-- Table structure for penilaian
-- ----------------------------
DROP TABLE IF EXISTS `penilaian`;
CREATE TABLE `penilaian` (
  `pn_id` int(100) NOT NULL AUTO_INCREMENT,
  `id_area` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_kriteria` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `pn_nilai` int(50) DEFAULT NULL,
  PRIMARY KEY (`pn_id`),
  KEY `pn_id_area` (`id_area`),
  KEY `pn_id_kriteria` (`id_kriteria`),
  CONSTRAINT `pn_id_area` FOREIGN KEY (`id_area`) REFERENCES `area` (`a_kode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pn_id_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`k_kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of penilaian
-- ----------------------------
BEGIN;
INSERT INTO `penilaian` VALUES (1, '001', 'C01', 3);
INSERT INTO `penilaian` VALUES (2, '001', 'C02', 4);
INSERT INTO `penilaian` VALUES (3, '001', 'C03', 4);
INSERT INTO `penilaian` VALUES (4, '001', 'C04', 3);
INSERT INTO `penilaian` VALUES (15, '002', 'C01', 5);
INSERT INTO `penilaian` VALUES (16, '002', 'C02', 3);
INSERT INTO `penilaian` VALUES (17, '002', 'C03', 4);
INSERT INTO `penilaian` VALUES (18, '002', 'C04', 5);
INSERT INTO `penilaian` VALUES (29, '003', 'C01', 4);
INSERT INTO `penilaian` VALUES (30, '003', 'C02', 5);
INSERT INTO `penilaian` VALUES (31, '003', 'C03', 5);
INSERT INTO `penilaian` VALUES (32, '003', 'C04', 3);
INSERT INTO `penilaian` VALUES (43, '004', 'C01', 4);
INSERT INTO `penilaian` VALUES (44, '004', 'C02', 5);
INSERT INTO `penilaian` VALUES (45, '004', 'C03', 4);
INSERT INTO `penilaian` VALUES (46, '004', 'C04', 1);
INSERT INTO `penilaian` VALUES (57, '005', 'C01', 3);
INSERT INTO `penilaian` VALUES (58, '005', 'C02', 4);
INSERT INTO `penilaian` VALUES (59, '005', 'C03', 5);
INSERT INTO `penilaian` VALUES (60, '005', 'C04', 5);
INSERT INTO `penilaian` VALUES (71, '006', 'C01', 0);
INSERT INTO `penilaian` VALUES (72, '006', 'C02', 0);
INSERT INTO `penilaian` VALUES (73, '006', 'C03', 0);
INSERT INTO `penilaian` VALUES (74, '006', 'C04', 0);
INSERT INTO `penilaian` VALUES (75, '001', 'C05', 5);
INSERT INTO `penilaian` VALUES (76, '001', 'C06', 3);
INSERT INTO `penilaian` VALUES (77, '001', 'C07', 4);
INSERT INTO `penilaian` VALUES (78, '001', 'C08', 5);
INSERT INTO `penilaian` VALUES (79, '001', 'C09', 5);
INSERT INTO `penilaian` VALUES (80, '001', 'C10', 2);
INSERT INTO `penilaian` VALUES (81, '002', 'C05', 3);
INSERT INTO `penilaian` VALUES (82, '002', 'C06', 3);
INSERT INTO `penilaian` VALUES (83, '002', 'C07', 5);
INSERT INTO `penilaian` VALUES (84, '002', 'C08', 4);
INSERT INTO `penilaian` VALUES (85, '002', 'C09', 4);
INSERT INTO `penilaian` VALUES (86, '002', 'C10', 3);
INSERT INTO `penilaian` VALUES (87, '003', 'C05', 2);
INSERT INTO `penilaian` VALUES (88, '003', 'C06', 3);
INSERT INTO `penilaian` VALUES (89, '003', 'C07', 4);
INSERT INTO `penilaian` VALUES (90, '003', 'C08', 5);
INSERT INTO `penilaian` VALUES (91, '003', 'C09', 5);
INSERT INTO `penilaian` VALUES (92, '003', 'C10', 3);
INSERT INTO `penilaian` VALUES (93, '004', 'C05', 4);
INSERT INTO `penilaian` VALUES (94, '004', 'C06', 1);
INSERT INTO `penilaian` VALUES (95, '004', 'C07', 4);
INSERT INTO `penilaian` VALUES (96, '004', 'C08', 5);
INSERT INTO `penilaian` VALUES (97, '004', 'C09', 2);
INSERT INTO `penilaian` VALUES (98, '004', 'C10', 1);
INSERT INTO `penilaian` VALUES (99, '005', 'C05', 5);
INSERT INTO `penilaian` VALUES (100, '005', 'C06', 4);
INSERT INTO `penilaian` VALUES (101, '005', 'C07', 3);
INSERT INTO `penilaian` VALUES (102, '005', 'C08', 5);
INSERT INTO `penilaian` VALUES (103, '005', 'C09', 3);
INSERT INTO `penilaian` VALUES (104, '005', 'C10', 5);
INSERT INTO `penilaian` VALUES (105, '006', 'C05', 0);
INSERT INTO `penilaian` VALUES (106, '006', 'C06', 0);
INSERT INTO `penilaian` VALUES (107, '006', 'C07', 0);
INSERT INTO `penilaian` VALUES (108, '006', 'C08', 0);
INSERT INTO `penilaian` VALUES (109, '006', 'C09', 0);
INSERT INTO `penilaian` VALUES (110, '006', 'C10', 0);
COMMIT;

-- ----------------------------
-- Table structure for tahun_berkas
-- ----------------------------
DROP TABLE IF EXISTS `tahun_berkas`;
CREATE TABLE `tahun_berkas` (
  `thn_id` varchar(4) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `thn_status` int(1) DEFAULT NULL,
  PRIMARY KEY (`thn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tahun_berkas
-- ----------------------------
BEGIN;
INSERT INTO `tahun_berkas` VALUES ('2019', 1);
INSERT INTO `tahun_berkas` VALUES ('2020', 0);
COMMIT;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `u_id` int(100) NOT NULL AUTO_INCREMENT,
  `u_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `u_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `u_password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `u_status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `u_role` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`u_id`) USING BTREE,
  UNIQUE KEY `u_ibfk1_username` (`u_name`) USING BTREE,
  UNIQUE KEY `u_ibfk2_email` (`u_email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES (3, 'admin', 'admin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '1', 'user');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
