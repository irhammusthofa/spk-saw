-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 04, 2019 at 06:01 PM
-- Server version: 5.6.44
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kamilco_spk`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `a_kode` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `a_nama` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `a_alamat` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `a_telp` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `a_kordinat` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_tahun` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`a_kode`, `a_nama`, `a_alamat`, `a_telp`, `a_kordinat`, `id_tahun`) VALUES
('01', 'programerrrrr', 'android ', '12345678', '1213', '2020'),
('02', 'analist', 'analis sistem', '342564y', '1214', '2020'),
('03', 'guru', 'pendidikan', 'y5u57', '1218', '2020'),
('04', 'it konsultan', 'wong pinter', '12222222', '', '2020');

--
-- Triggers `area`
--
DELIMITER $$
CREATE TRIGGER `after_area_delete` AFTER DELETE ON `area` FOR EACH ROW INSERT INTO histori SET h_tgl=NOW(), h_table="area",h_tipe="delete", h_user=@user_id,h_after=CONCAT("["",old.a_kode,"","",old.a_nama,"","",old.a_alamat,"","",old.a_telp,"","",old.a_kordinat,"","",old.id_tahun,""]")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_area_insert` BEFORE INSERT ON `area` FOR EACH ROW INSERT INTO histori SET h_tgl=NOW(), h_table="area",h_tipe="insert", h_user=@user_id,h_after=CONCAT("["",new.a_kode,"","",new.a_nama,"","",new.a_alamat,"","",new.a_telp,"","",new.a_kordinat,"","",new.id_tahun,""]")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_area_update` AFTER UPDATE ON `area` FOR EACH ROW INSERT INTO histori SET h_tgl=NOW(), h_table="area",h_tipe="update", h_user=@user_id,h_before=CONCAT("["",old.a_kode,"","",old.a_nama,"","",old.a_alamat,"","",old.a_telp,"","",old.a_kordinat,"","",old.id_tahun,""]"),h_after=CONCAT("["",new.a_kode,"","",new.a_nama,"","",new.a_alamat,"","",new.a_telp,"","",new.a_kordinat,"","",new.id_tahun,""]")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `dyn_groups`
--

CREATE TABLE `dyn_groups` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `abbrev` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Navigation groupings. Eg, header, sidebar, footer, etc';

--
-- Dumping data for table `dyn_groups`
--

INSERT INTO `dyn_groups` (`id`, `title`, `abbrev`) VALUES
(1, 'Header', 'header'),
(2, 'Sidebar', 'sidebar'),
(3, 'Footer', 'footer'),
(4, 'Topbar', 'topbar'),
(5, 'Sidebar1', 'sidebar1'),
(6, 'Sidebar2', 'sidebar2');

-- --------------------------------------------------------

--
-- Table structure for table `dyn_menu`
--

CREATE TABLE `dyn_menu` (
  `id` int(11) NOT NULL,
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
  `role` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dyn_menu`
--

INSERT INTO `dyn_menu` (`id`, `title`, `link_type`, `page_id`, `module_name`, `icon`, `url`, `uri`, `dyn_group_id`, `position`, `target`, `parent_id`, `is_parent`, `show_menu`, `role`) VALUES
(1, 'Dasbor', 'uri', 1, 'dashboard', 'fa fa-dashboard', 'https://spk.kamil.co.id/user/dashboard', '', 2, 1, NULL, 0, 0, '1', 'user'),
(2, 'Data Area', 'uri', 2, 'area', 'fa fa-file-text', 'https://spk.kamil.co.id/user/area', '', 2, 2, NULL, 0, 0, '1', 'user'),
(3, 'Data Kriteria', 'uri', 3, 'kriteria', 'fa fa-file-text', 'https://spk.kamil.co.id/user/kriteria', '', 2, 3, NULL, 0, 0, '1', 'user'),
(4, 'Penilaian SAW', 'uri', 9, 'penilaian', 'ion ion-stats-bars', 'https://spk.kamil.co.id/user/penilaian', '', 2, 4, NULL, 0, 0, '1', 'user'),
(5, 'Hasil Perhitungan', 'uri', 16, 'saw', 'ion ion-stats-bars', 'https://spk.kamil.co.id/user/saw', '', 2, 5, NULL, 0, 0, '1', 'user'),
(6, 'Grafik Penilaian', 'uri', 17, 'grafik', 'ion ion-pie-graph', 'https://spk.kamil.co.id/user/grafik', '', 2, 6, NULL, 0, 0, '1', 'user'),
(7, 'Laporan Ranking', 'uri', 18, 'saw', 'fa fa-print', 'https://spk.kamil.co.id/user/saw/cetak', '', 2, 7, NULL, 0, 0, '1', 'user'),
(8, 'Laporan SAW', 'uri', 19, 'saw', 'fa fa-print', 'https://spk.kamil.co.id/user/saw/cetak/lengkap', '', 2, 8, NULL, 0, 0, '1', 'user'),
(9, 'Tahun Berkas', 'uri', 20, 'tahun', 'fa fa-file-text', 'https://spk.kamil.co.id/user/tahun', '', 2, 1, NULL, 0, 0, '1', 'user'),
(10, 'Histori', 'uri', 21, 'histori', 'fa fa-file-text', 'https://spk.kamil.co.id/user/histori', '', 2, 9, NULL, 0, 0, '1', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `histori`
--

CREATE TABLE `histori` (
  `h_id` int(11) NOT NULL,
  `h_tgl` datetime DEFAULT NULL,
  `h_before` longtext COLLATE utf8_unicode_ci,
  `h_after` longtext COLLATE utf8_unicode_ci,
  `h_table` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `h_tipe` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'insert/update/delete',
  `h_user` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `histori`
--

INSERT INTO `histori` (`h_id`, `h_tgl`, `h_before`, `h_after`, `h_table`, `h_tipe`, `h_user`) VALUES
(7, '2019-07-04 14:35:20', NULL, '[\"05\",\"Contoh\",\"alamat\",\"1201010\",\"0099393\",\"2020\"]', 'area', 'insert', 'admin'),
(8, '2019-07-04 14:35:49', '[\"05\",\"Contoh\",\"alamat\",\"1201010\",\"0099393\",\"2020\"]', '[\"06\",\"Contoh 2\",\"\",\"466666\",\"32222\",\"2020\"]', 'area', 'delete', 'admin'),
(9, '2019-07-04 14:36:37', NULL, '[\"06\",\"Contoh 2\",\"\",\"466666\",\"32222\",\"2020\"]', 'area', 'delete', 'admin'),
(10, '2019-07-04 15:35:52', '[\"04\",\"it konsultan\",\"wong pinter\",\"\",\"\",\"2020\"]', '[\"04\",\"it konsultan\",\"wong pinter\",\"12222222\",\"\",\"2020\"]', 'area', 'update', 'admin'),
(11, '2019-07-04 15:41:45', '[\"01\",\"programer\",\"android php\",\"12345678\",\"1213\",\"2020\"]', '[\"01\",\"programerrrrr\",\"android php\",\"12345678\",\"1213\",\"2020\"]', 'area', 'update', 'admin'),
(12, '2019-07-04 15:42:23', '[\"01\",\"programerrrrr\",\"android php\",\"12345678\",\"1213\",\"2020\"]', '[\"01\",\"programerrrrr\",\"android \",\"12345678\",\"1213\",\"2020\"]', 'area', 'update', 'admin'),
(13, '2019-07-04 16:01:58', '[\"k5\",\"gaji\",\"30\",\"2020\"]', '[\"K5\",\"gaji\",\"30\",\"2020\"]', 'kriteria', 'update', 'admin'),
(24, '2019-07-04 17:56:41', '[\"01\",\"programerrrrr\",\"k1\",\"ipk\",\"4\"]', '[\"01\",\"programerrrrr\",\"k1\",\"ipk\",\"5\"]', 'penilaian', 'update', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `k_kode` varchar(50) NOT NULL DEFAULT '',
  `k_nama` varchar(50) DEFAULT NULL,
  `k_bobot` int(10) DEFAULT NULL,
  `id_tahun` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`k_kode`, `k_nama`, `k_bobot`, `id_tahun`) VALUES
('k1', 'ipk', 30, '2020'),
('k2', 'pemahaman bahasa pemrograman', 20, '2020'),
('k3', 'pengalaman membuat aplikasi', 10, '2020'),
('k4', 'sertifikasi', 10, '2020'),
('K5', 'gaji', 30, '2020');

--
-- Triggers `kriteria`
--
DELIMITER $$
CREATE TRIGGER `after_kriteria_delete` AFTER DELETE ON `kriteria` FOR EACH ROW INSERT INTO histori SET h_tgl=NOW(), h_table="kriteria",h_tipe="delete", h_user=@user_id,h_after=CONCAT("["",old.k_kode,"","",old.k_nama,"","",old.k_bobot,"","",old.id_tahun,""]")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_kriteria_insert` AFTER INSERT ON `kriteria` FOR EACH ROW INSERT INTO histori SET h_tgl=NOW(), h_table="kriteria",h_tipe="insert", h_user=@user_id,h_after=CONCAT("["",new.k_kode,"","",new.k_nama,"","",new.k_bobot,"","",new.id_tahun,""]")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_kriteria_update` AFTER UPDATE ON `kriteria` FOR EACH ROW INSERT INTO histori SET h_tgl=NOW(), h_table="kriteria",h_tipe="update", h_user=@user_id,h_after=CONCAT("["",new.k_kode,"","",new.k_nama,"","",new.k_bobot,"","",new.id_tahun,""]"),h_before=CONCAT("["",old.k_kode,"","",old.k_nama,"","",old.k_bobot,"","",old.id_tahun,""]")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `pn_id` int(100) NOT NULL,
  `id_area` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_kriteria` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `pn_nilai` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`pn_id`, `id_area`, `id_kriteria`, `pn_nilai`) VALUES
(1, '01', 'k1', 5),
(2, '01', 'k2', 80),
(3, '01', 'k3', 1),
(4, '01', 'k4', 90),
(5, '01', 'K5', 10),
(6, '02', 'k1', 3),
(7, '02', 'k2', 90),
(8, '02', 'k3', 2),
(9, '02', 'k4', 1),
(10, '02', 'K5', 10);

--
-- Triggers `penilaian`
--
DELIMITER $$
CREATE TRIGGER `after_nilai_delete` AFTER DELETE ON `penilaian` FOR EACH ROW INSERT INTO histori SET h_tgl=NOW(), h_table="penilaian",h_tipe="delete", h_user=@user_id,h_after=CONCAT("["",old.id_area,"","",@a_nama_a,"","",old.id_kriteria,"","",@k_nama_a,"","",old.pn_nilai,""]")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_nilai_insert` AFTER INSERT ON `penilaian` FOR EACH ROW INSERT INTO histori SET h_tgl=NOW(), h_table="penilaian",h_tipe="insert", h_user=@user_id,h_after=CONCAT("["",new.id_area,"","",@a_nama_a,"","",new.id_kriteria,"","",@k_nama_a,"","",new.pn_nilai,""]")
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_nilai_update` AFTER UPDATE ON `penilaian` FOR EACH ROW IF (old.id_area = new.id_area AND old.id_kriteria = new.id_kriteria AND old.pn_nilai = new.pn_nilai) = false  THEN 
BEGIN INSERT INTO histori SET h_tgl=NOW(), h_table="penilaian",h_tipe="update", h_user=@user_id,h_after=CONCAT("["",new.id_area,"","",@a_nama_a,"","",new.id_kriteria,"","",@k_nama_a,"","",new.pn_nilai,""]"),h_before=CONCAT("["",old.id_area,"","",@a_nama_b,"","",old.id_kriteria,"","",@k_nama_b,"","",old.pn_nilai,""]"); END;
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tahun_berkas`
--

CREATE TABLE `tahun_berkas` (
  `thn_id` varchar(4) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `thn_status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tahun_berkas`
--

INSERT INTO `tahun_berkas` (`thn_id`, `thn_status`) VALUES
('2020', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(100) NOT NULL,
  `u_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `u_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `u_password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `u_status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `u_role` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_name`, `u_email`, `u_password`, `u_status`, `u_role`) VALUES
(3, 'admin', 'admin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '1', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`a_kode`),
  ADD KEY `fk_a_id_tahun` (`id_tahun`);

--
-- Indexes for table `dyn_groups`
--
ALTER TABLE `dyn_groups`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `dyn_menu`
--
ALTER TABLE `dyn_menu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `histori`
--
ALTER TABLE `histori`
  ADD PRIMARY KEY (`h_id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`k_kode`),
  ADD KEY `fk_k_id_tahun` (`id_tahun`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`pn_id`),
  ADD KEY `pn_id_area` (`id_area`),
  ADD KEY `pn_id_kriteria` (`id_kriteria`);

--
-- Indexes for table `tahun_berkas`
--
ALTER TABLE `tahun_berkas`
  ADD PRIMARY KEY (`thn_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`) USING BTREE,
  ADD UNIQUE KEY `u_ibfk1_username` (`u_name`) USING BTREE,
  ADD UNIQUE KEY `u_ibfk2_email` (`u_email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dyn_groups`
--
ALTER TABLE `dyn_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dyn_menu`
--
ALTER TABLE `dyn_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `histori`
--
ALTER TABLE `histori`
  MODIFY `h_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `pn_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `fk_a_id_tahun` FOREIGN KEY (`id_tahun`) REFERENCES `tahun_berkas` (`thn_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD CONSTRAINT `fk_k_id_tahun` FOREIGN KEY (`id_tahun`) REFERENCES `tahun_berkas` (`thn_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `pn_id_area` FOREIGN KEY (`id_area`) REFERENCES `area` (`a_kode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pn_id_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`k_kode`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
