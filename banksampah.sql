-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 20, 2023 at 12:42 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banksampah`
--

-- --------------------------------------------------------

--
-- Table structure for table `jns_sampah`
--

CREATE TABLE `jns_sampah` (
  `id_sampah` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_sampah` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` int NOT NULL DEFAULT (0),
  `satuan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diubah` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jns_sampah`
--

INSERT INTO `jns_sampah` (`id_sampah`, `nama_sampah`, `kategori`, `harga`, `satuan`, `diubah`) VALUES
('S0001', 'Botol Plastik', 'Plastik', 2000, 'Kg', '2023-10-09 03:52:21'),
('S0002', 'Kardus', 'Kertas', 1800, 'Kg', '2023-10-02 06:32:24'),
('S0003', 'Tembaga', 'Logam', 4000, 'Kg', '2023-10-06 01:52:56'),
('S0004', 'Kaca', 'Lain-lain', 2500, 'Kg', '2023-10-02 06:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barangkeluar`
--

CREATE TABLE `tb_barangkeluar` (
  `id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sampah` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `jumlah` float NOT NULL DEFAULT (0),
  `total` decimal(30,0) NOT NULL DEFAULT '0',
  `tgl_keluar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_barangkeluar`
--

INSERT INTO `tb_barangkeluar` (`id`, `id_sampah`, `jumlah`, `total`, `tgl_keluar`) VALUES
('BK001', 'S0002', 2, '5000', '2023-10-11 09:54:19');

-- --------------------------------------------------------

--
-- Table structure for table `tb_desa`
--

CREATE TABLE `tb_desa` (
  `id_desa` char(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_desa` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_kecamatan` char(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='tabel data desa';

--
-- Dumping data for table `tb_desa`
--

INSERT INTO `tb_desa` (`id_desa`, `nama_desa`, `id_kecamatan`) VALUES
('﻿2001', 'Argopeni', '01'),
('2002', 'Karangduwur', '01'),
('2003', 'Srati', '01'),
('2004', 'Pasir', '01'),
('2005', 'Jintung', '01'),
('2006', 'Banjararjo', '01'),
('2007', 'Argosari', '01'),
('2008', 'Watukelir', '01'),
('2009', 'Kalibangkang', '01'),
('2010', 'Tlogosari', '01'),
('2011', 'Kalipoh', '01'),
('2012', 'Ayah', '01'),
('2013', 'Candirenggo', '01'),
('2014', 'Mangunweni', '01'),
('2015', 'Jatijajar', '01'),
('2016', 'Demangsari', '01'),
('2017', 'Bulurejo', '01'),
('2018', 'Kedungweru', '01'),
('2001', 'Karangbolong', '02'),
('2002', 'Jladri', '02'),
('2003', 'Adiwarno', '02'),
('2004', 'Rangkah', '02'),
('2005', 'Wonodadi', '02'),
('2006', 'Geblug', '02'),
('2007', 'Rogodadi', '02'),
('2008', 'Pakuran', '02'),
('2009', 'Buayan', '02'),
('2010', 'Sikayu', '02'),
('2011', 'Karangsari', '02'),
('2012', 'Rogodono', '02'),
('2013', 'Banyumudal', '02'),
('2014', 'Tugu', '02'),
('2015', 'Nogoraji', '02'),
('2016', 'Mergosono', '02'),
('2017', 'Semampir', '02'),
('2018', 'Jogomulyo', '02'),
('2019', 'Purbowangi', '02'),
('2020', 'Jatiroto', '02'),
('2001', 'Tambakmulyo', '03'),
('2002', 'Surorejan', '03'),
('2003', 'Waluyorejo', '03'),
('2004', 'Sidoharjo', '03'),
('2005', 'Puliharjo', '03'),
('2006', 'Purwosari', '03'),
('2007', 'Arjowinangun', '03'),
('2008', 'Krandegan', '03'),
('2009', 'Kaleng', '03'),
('2010', 'Tukinggedong', '03'),
('2011', 'Purwoharjo', '03'),
('2012', 'Banjarejo', '03'),
('2013', 'Wetonkulon', '03'),
('2014', 'Pesuruhan', '03'),
('2015', 'Wetonwetan', '03'),
('2016', 'Kedalemankulon', '03'),
('2017', 'Keda lemanwetan', '03'),
('2018', 'Srusuhjurutengah', '03'),
('2019', 'Siti adi', '03'),
('2020', 'Bumirejo', '03'),
('2021', 'Madurejo', '03'),
('2022', 'Sidobunder', '03'),
('2023', 'Sidodadi', '03'),
('2001', 'Karangrejo', '04'),
('2002', 'Karanggadung', '04'),
('2003', 'Tegalretno', '04'),
('2004', 'Ampelsari', '04'),
('2005', 'Munggu', '04'),
('2006', 'Kewangunan', '04'),
('2007', 'Karangduwur', '04'),
('2008', 'Petanahan', '04'),
('2009', 'Kebonsari', '04'),
('2010', 'Grogolpenatus', '04'),
('2011', 'Grogolbeningsari', '04'),
('2012', 'Jogomertan', '04'),
('2013', 'Tanjungsari', '04'),
('2014', 'Sidomulyo', '04'),
('2015', 'Grujugan', '04'),
('2016', 'Kritig', '04'),
('2017', 'Nampudadi', '04'),
('2018', 'Tresnorejo', '04'),
('2019', 'Podourip', '04'),
('2020', 'Jatimulyo', '04'),
('2021', 'Banjarwinangun', '04'),
('2001', 'Jogosimo', '05'),
('2002', 'Tanggulangin', '05'),
('2003', 'Pandanlor', '05'),
('2004', 'Tambakprogaten', '05'),
('2005', 'Gebangsari', '05'),
('2006', 'Klegenrejo', '05'),
('2007', 'Bendogarap', '05'),
('2008', 'Kedungsari', '05'),
('2009', 'Jerukagung', '05'),
('2010', 'Klegenwonosari', '05'),
('2011', 'Klirong', '05'),
('2012', 'Kaliwungu', '05'),
('2013', 'Jatimalang', '05'),
('2014', 'Karangglonggong', '05'),
('2015', 'Ranterejo', '05'),
('2016', 'Wotbuwono', '05'),
('2017', 'Tambakagung', '05'),
('2018', 'Sitirejo', '05'),
('2019', 'Gadungrejo', '05'),
('2020', 'Dorowati', '05'),
('2021', 'Bumiharjo', '05'),
('2022', 'Kebadongan', '05'),
('2023', 'Podoluhur', '05'),
('2024', 'Kedungwinangun', '05'),
('2001', 'Ayamputih', '06'),
('2002', 'Setrojenar', '06'),
('2003', 'Brecong', '06'),
('2004', 'Banjurpasar', '06'),
('2005', 'Indrosari', '06'),
('2006', 'Buluspesantren', '06'),
('2007', 'Banjurmukadan', '06'),
('2008', 'Waluyo', '06'),
('2009', 'Bocor', '06'),
('2010', 'Maduretno', '06'),
('2011', 'Ambalkumolo', '06'),
('2012', 'Rantewringin', '06'),
('2013', 'Tambakrejo', '06'),
('2014', 'Sangubanyu', '06'),
('2015', 'Arjowinangun', '06'),
('2016', 'Ampih', '06'),
('2017', 'Jogopaten', '06'),
('2018', 'Klapasawit', '06'),
('2019', 'Sidomoro', '06'),
('2020', 'Tanjungrejo', '06'),
('2021', 'Tanjungsari', '06'),
('2001', 'Entak', '07'),
('2002', 'Plempukankembaran', '07'),
('2003', 'Kenoyojayan', '07'),
('2004', 'Ambalresmi', '07'),
('2005', 'Kaibonpetangkuran', '07'),
('2006', 'Kaibon', '07'),
('2007', 'Sumberjati', '07'),
('2008', 'Blengorwetan', '07'),
('2009', 'Blengorkulon', '07'),
('2010', 'Benerwetan', '07'),
('2011', 'Benerkulon', '07'),
('2012', 'Ambalkliwonan', '07'),
('2013', 'Pasarsenen', '07'),
('2014', 'Pucangan', '07'),
('2015', 'Ambalkebrek', '07'),
('2016', 'Gondanglegi', '07'),
('2017', 'Banjarsari', '07'),
('2018', 'Lajer', '07'),
('2019', 'Singosari', '07'),
('2020', 'Sidoluhur', '07'),
('2021', 'Sinungrejo', '07'),
('2022', 'Ambarwinangun', '07'),
('2023', 'Peneket', '07'),
('2024', 'Sidorejo', '07'),
('2025', 'Sidomulyo', '07'),
('2026', 'Sidomukti', '07'),
('2027', 'Prasutan', '07'),
('2028', 'Kradenan', '07'),
('2029', 'Pagedangan', '07'),
('2030', 'Surobayan', '07'),
('2031', 'Dukuhrejosari', '07'),
('2032', 'Kembangsawit', '07'),
('2001', 'Miritpetikusan', '08'),
('2002', 'Tlogodepok', '08'),
('2003', 'Mirit', '08'),
('2004', 'Tlogopragoto', '08'),
('2005', 'Lembupurwo', '08'),
('2006', 'Wiromartan', '08'),
('2007', 'Rowo', '08'),
('2008', 'Singoyudan', '08'),
('2009', 'Wergonayan', '08'),
('2010', 'Selotumpeng', '08'),
('2011', 'Sitibentar', '08'),
('2012', 'Karanggede', '08'),
('2013', 'Kertodeso', '08'),
('2014', 'Patukrejomulyo', '08'),
('2015', 'Patukgawemulyo', '08'),
('2016', 'Mangunranan', '08'),
('2017', 'Pekutan', '08'),
('2018', 'Wirogaten', '08'),
('2019', 'Winong', '08'),
('2020', 'Ngabean', '08'),
('2021', 'Sarwogadung', '08'),
('2022', 'Krubungan', '08'),
('2001', 'Tersobo', '09'),
('2002', 'Prembun', '09'),
('2003', 'Kabekelan', '09'),
('2004', 'Tunggalroso', '09'),
('2005', 'Kedungwaru', '09'),
('2006', 'Bagung', '09'),
('2007', 'Sidogede', '09'),
('2008', 'Sembirkadipaten', '09'),
('2009', 'Kedungbulus', '09'),
('2010', 'Mulyosri', '09'),
('2011', 'Pesuningan', '09'),
('2012', 'pecarikan', '09'),
('2013', 'Kabuaran', '09'),
('2001', 'Pekunden', '10'),
('2002', 'Tanjungmeru', '10'),
('2003', 'Kuwarisan', '10'),
('2004', 'Kutowinangun', '10'),
('2005', 'Lundong', '10'),
('2006', 'Mekarsari', '10'),
('2007', 'Babadsari', '10'),
('2008', 'Ungaran', '10'),
('2009', 'Mrinen', '10'),
('2010', 'Pejagatan', '10'),
('2011', 'Triwarno', '10'),
('2012', 'Korowelang', '10'),
('2013', 'Jlegiwinangun', '10'),
('2014', 'Lumbu', '10'),
('2015', 'Tanjungsari', '10'),
('2016', 'Kaliputih', '10'),
('2017', 'Tunjungseto', '10'),
('2018', 'Pesalakan', '10'),
('2019', 'Karangsari', '10'),
('2001', 'Bojongsari', '11'),
('2002', 'Surotrunan', '11'),
('2003', 'Kambangsari', '11'),
('2004', 'Jatimulyo', '11'),
('2005', 'Tanuharjo', '11'),
('2006', 'Karangtanjung', '11'),
('2007', 'Kemangguan', '11'),
('2008', 'Kalijaya', '11'),
('2009', 'Karangkembang', '11'),
('2010', 'Seliling', '11'),
('2011', 'Tlogowulung', '11'),
('2012', 'Kaliputih', '11'),
('2013', 'Wonokromo', '11'),
('2014', 'Sawangan', '11'),
('2015', 'Kalirancang', '11'),
('2016', 'Krakal', '11'),
('1010', 'Selang', '12'),
('1012', 'Tamanwinangun', '12'),
('1013', 'Panjer', '12'),
('1024', 'Kebumen', '12'),
('1026', 'Bumirejo', '12'),
('2001', 'Muktisari', '12'),
('2002', 'Murtirejo', '12'),
('2003', 'Depokrejo', '12'),
('2004', 'Mengkowo', '12'),
('2005', 'Gesikan', '12'),
('2006', 'Kalibagor', '12'),
('2007', 'Argopeni', '12'),
('2008', 'Jatisari', '12'),
('2009', 'Kalirejo', '12'),
('2011', 'Adikarso', '12'),
('2014', 'Kembaran', '12'),
('2015', 'Sumberadi', '12'),
('2016', 'Wonosari', '12'),
('2017', 'Roworejo', '12'),
('2018', 'Tanahsari', '12'),
('2019', 'Bandung', '12'),
('2020', 'Candimulyo', '12'),
('2021', 'Kalijirek', '12'),
('2022', 'Candiwulan', '12'),
('2023', 'Kawedusan', '12'),
('2025', 'Kutosari', '12'),
('2027', 'Gemeksekti', '12'),
('2028', 'Karangsari', '12'),
('2029', 'Jemur', '12'),
('2001', 'Logede', '13'),
('2002', 'Kuwayuhan', '13'),
('2003', 'Kedawung', '13'),
('2004', 'Pejagoan', '13'),
('2005', 'Kebulusan', '13'),
('2006', 'Aditirto', '13'),
('2007', 'Karangpoh', '13'),
('2008', 'Jemur', '13'),
('2009', 'Prigi', '13'),
('2010', 'Kebagoran', '13'),
('2011', 'Pengaringan', '13'),
('2012', 'Peniron', '13'),
('2013', 'Watulawang', '13'),
('2001', 'Menganti', '14'),
('2002', 'Trikarso', '14'),
('2003', 'Sidoharjo', '14'),
('2004', 'Giwangretno', '14'),
('2005', 'Jabres', '14'),
('2006', 'Sruweng', '14'),
('2007', 'Karanggedang', '14'),
('2008', 'Purwodeso', '14'),
('2009', 'Klepusanggar', '14'),
('2010', 'Tanggeran', '14'),
('2011', 'Karangsari', '14'),
('2012', 'Karangpule', '14'),
('2013', 'Pakuran', '14'),
('2014', 'Pengempon', '14'),
('2015', 'Kejawang', '14'),
('2016', 'Karangjambu', '14'),
('2017', 'Sidoagung', '14'),
('2018', 'Penusupan', '14'),
('2019', 'Donosari', '14'),
('2020', 'Pandansari', '14'),
('2021', 'Condongcampur', '14'),
('2001', 'Sugihwaras', '15'),
('2002', 'Tambaharjo', '15'),
('2003', 'Tepakyang', '15'),
('2004', 'Sidomulyo', '15'),
('2005', 'Wajasari', '15'),
('2006', 'Candiwulan', '15'),
('2007', 'Adikarto', '15'),
('2008', 'Adimulyo', '15'),
('2009', 'Temanggal', '15'),
('2010', 'Joho', '15'),
('2011', 'Adiluhur', '15'),
('2012', 'Tegalsari', '15'),
('2013', 'Sekarteja', '15'),
('2014', 'Kemujan', '15'),
('2015', 'Mangunharjo', '15'),
('2016', 'Banyurata', '15'),
('2017', 'Meles', '15'),
('2018', 'Caruban', '15'),
('2019', 'Bonjok', '15'),
('2020', 'Arjomulyo', '15'),
('2021', 'Arjosari', '15'),
('2022', 'Pekuwon', '15'),
('2023', 'Sidomukti', '15'),
('2001', 'Kamulyan', '16'),
('2002', 'Sidomukti', '16'),
('2003', 'Tambaksari', '16'),
('2004', 'Kalipurwo', '16'),
('2005', 'Purwodadi', '16'),
('2006', 'Pondokgebangsari', '16'),
('2007', 'Kuwarasan', '16'),
('2008', 'Harjodowo', '16'),
('2009', 'Lemahduwur', '16'),
('2010', 'Madureso', '16'),
('2011', 'Mangli', '16'),
('2012', 'Gandusari', '16'),
('2013', 'Ori', '16'),
('2014', 'Serut', '16'),
('2015', 'Banjareja', '16'),
('2016', 'Gumawang', '16'),
('2017', 'Wonoyoso', '16'),
('2018', 'Gunungmujil', '16'),
('2019', 'Kuwaru', '16'),
('2020', 'Bendungan', '16'),
('2021', 'Jatimulyo', '16'),
('2022', 'Sawangan', '16'),
('2001', 'Redisari', '17'),
('2002', 'Kalisari', '17'),
('2003', 'Pringtutul', '17'),
('2004', 'Rowokele', '17'),
('2005', 'Bumiagung', '17'),
('2006', 'Jatiluhur', '17'),
('2007', 'Kretek', '17'),
('2008', 'Sukomulyo', '17'),
('2009', 'Giyanti', '17'),
('2010', 'Wonoharjo', '17'),
('2011', 'Wagirpandan', '17'),
('2001', 'Sidoharum', '18'),
('2002', 'Selokerto', '18'),
('2003', 'Kalibeji', '18'),
('2004', 'Jatinegara', '18'),
('2005', 'Bejiruyung', '18'),
('2006', 'Pekuncen', '18'),
('2007', 'Kedungjati', '18'),
('2008', 'Semali', '18'),
('2009', 'Bonosari', '18'),
('2010', 'Sempor', '18'),
('2011', 'Tunjungseto', '18'),
('2012', 'Sampang', '18'),
('2013', 'Donorojo', '18'),
('2014', 'Kedungwringin', '18'),
('2015', 'Kenteng', '18'),
('2016', 'Somagede', '18'),
('1008', 'Gombong', '19'),
('1009', 'Wonokriyo', '19'),
('2001', 'Kalitengah', '19'),
('2002', 'Kem ukus', '19'),
('2003', 'Banjarsari', '19'),
('2004', 'Panjangsari', '19'),
('2005', 'Patemon', '19'),
('2006', 'Kedungpuji', '19'),
('2007', 'Wero', '19'),
('2010', 'Semondo', '19'),
('2011', 'Semanding', '19'),
('2012', 'Sidayu', '19'),
('2013', 'Wonosigro', '19'),
('2014', 'Klopogodo', '19'),
('1002', 'Panjatan', '20'),
('1003', 'Karanganyar', '20'),
('1004', 'Jatiluhur', '20'),
('1007', 'Plarangan', '20'),
('2001', 'Sidomulyo', '20'),
('2005', 'Candi', '20'),
('2006', 'Giripurno', '20'),
('2008', 'Karangkemiri', '20'),
('2009', 'Wonorejo', '20'),
('2010', 'Grenggeng', '20'),
('2011', 'Pohkumbang', '20'),
('2001', 'Karanggayam', '21'),
('2002', 'Kajoran', '21'),
('2003', 'Karangtengah', '21'),
('2004', 'Karangmaja', '21'),
('2005', 'Penimbun', '21'),
('2006', 'Kalirejo', '21'),
('2007', 'Pagebangan', '21'),
('2008', 'Clapar', '21'),
('2009', 'Logandu', '21'),
('2010', 'Kebakalan', '21'),
('2011', 'Karangrejo', '21'),
('2012', 'Wonotirto', '21'),
('2013', 'Kalibening', '21'),
('2014', 'Gunungsari', '21'),
('2015', 'Ginandong', '21'),
('2016', 'Binangun', '21'),
('2017', 'Glontor', '21'),
('2018', 'Selogiri', '21'),
('2019', 'Giritirto', '21'),
('2001', 'Pucangan', '22'),
('2002', 'Seboro', '22'),
('2003', 'Wonosari', '22'),
('2004', 'Sadangkulon', '22'),
('2005', 'Cangkring', '22'),
('2006', 'Sadangwetan', '22'),
('2007', 'Kedunggong', '22'),
('2001', 'Patukrejo', '23'),
('2002', 'Ngasinan', '23'),
('2003', 'Pujodadi', '23'),
('2004', 'Balorejo', '23'),
('2005', 'Rowosari', '23'),
('2006', 'Tlogorejo', '23'),
('2007', 'Bonorowo', '23'),
('2008', 'Simoboyo', '23'),
('2009', 'Bonjokkidul', '23'),
('2010', 'Bonjoklor', '23'),
('2011', 'Mrentul', '23'),
('2001', 'Pejengkolan', '24'),
('2002', 'Balingasal', '24'),
('2003', 'Merden', '24'),
('2004', 'Kalijering', '24'),
('2005', 'Kaligubug', '24'),
('2006', 'Sidototo', '24'),
('2007', 'Rahayu', '24'),
('2008', 'Sendangdalem', '24'),
('2009', 'Padureso', '24'),
('2001', 'Jatipurus', '25'),
('2002', 'Lerepkebumen', '25'),
('2003', 'Blater', '25'),
('2004', 'Poncowamo', '25'),
('2005', 'Tegalrejo', '25'),
('2006', 'Jembangan', '25'),
('2007', 'Kedungdowo', '25'),
('2008', 'Karangtengah', '25'),
('2009', 'Tirtomoyo', '25'),
('2010', 'Soka', '25'),
('2011', 'Kebapangan', '25'),
('2001', 'Widoro', '26'),
('2002', 'Seling', '26'),
('2003', 'Pencil', '26'),
('2004', 'Kedungwaru', '26'),
('2005', 'Kaligending', '26'),
('2006', 'Plumbon', '26'),
('2007', 'Pujotirto', '26'),
('2008', 'Wadasmalang', '26'),
('2009', 'Tlepok', '26'),
('2010', 'Kalisana', '26'),
('2011', 'Langse', '26'),
('2012', 'Banioro', '26'),
('2013', 'Karangsambung', '26'),
('2014', 'Totogan', '26');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_setoran`
--

CREATE TABLE `tb_detail_setoran` (
  `id` int NOT NULL,
  `id_setor` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_sampah` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `berat` float DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `total` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_detail_setoran`
--

INSERT INTO `tb_detail_setoran` (`id`, `id_setor`, `tanggal`, `id_sampah`, `berat`, `harga`, `total`) VALUES
(80, 'ST20231000001', '2023-10-18 09:58:07', 'S0001', 12.5, 2000, 25000),
(81, 'ST20231000001', '2023-10-18 09:58:07', 'S0002', 5, 1800, 9000),
(84, 'ST20231000002', '2023-10-18 09:58:07', 'S0003', 2, 4000, 8000),
(86, 'ST20231000003', '2023-10-18 09:58:07', 'S0004', 10, 2500, 25000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kecamatan`
--

CREATE TABLE `tb_kecamatan` (
  `id_kecamatan` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kecamatan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='tabel data kecamatan';

--
-- Dumping data for table `tb_kecamatan`
--

INSERT INTO `tb_kecamatan` (`id_kecamatan`, `nama_kecamatan`) VALUES
('01', 'Ayah'),
('02', 'Buayan'),
('03', 'Puring'),
('04', 'Petanahan'),
('05', 'Klirong'),
('06', 'Buluspesantren'),
('07', 'Ambal'),
('08', 'Mirit'),
('09', 'Prembun'),
('10', 'Kutowinangun'),
('11', 'Alian'),
('12', 'Kebumen'),
('13', 'Pejagoan'),
('14', 'Sruweng'),
('15', 'Adimulyo'),
('16', 'Kuwarasan'),
('17', 'Rowokele'),
('18', 'Sempor'),
('19', 'Gombong'),
('20', 'Karanganyar'),
('21', 'Karanggayam'),
('22', 'Sadang'),
('23', 'Bonoworo'),
('24', 'Padureso'),
('25', 'Poncowarno'),
('26', 'Karangsambung');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nasabah`
--

CREATE TABLE `tb_nasabah` (
  `id_user` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nin` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_desa` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kecamatan` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rt` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rw` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_lengkap` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saldo` decimal(30,0) NOT NULL DEFAULT '0',
  `dibuat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_nasabah`
--

INSERT INTO `tb_nasabah` (`id_user`, `nin`, `nama`, `id_desa`, `id_kecamatan`, `rt`, `rw`, `alamat_lengkap`, `jk`, `saldo`, `dibuat`) VALUES
('U65260d6cc0089', 'NB202310095001', 'Narindra Yogi Pradana', '2008', '04', '01', '03', 'Jatimulyo Rt.01/Rw.03 Kec.Petanahan Kab.Kebumen', 'Laki-laki', '58000', '2023-10-11 09:50:20'),
('U652f423eb6e28', 'NB202310092601', 'Isnaeni Abdan Syakuro', '2007', '15', '05', '06', 'Adimulyo Adikarto Rt.05/Rw.06 Kebumen', 'Laki-laki', '0', '2023-10-18 09:26:06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penarikan`
--

CREATE TABLE `tb_penarikan` (
  `id_penarikan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nin` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_penarikan` datetime DEFAULT (now()),
  `saldo` decimal(30,0) DEFAULT NULL,
  `jumlah_penarikan` decimal(30,0) DEFAULT NULL,
  `id_petugas` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_penarikan`
--

INSERT INTO `tb_penarikan` (`id_penarikan`, `nin`, `tgl_penarikan`, `saldo`, `jumlah_penarikan`, `id_petugas`, `status`) VALUES
('PN0001', 'NB202310095001', '2023-10-11 09:54:07', '34000', '4000', '63tr3fbugsgd', '1'),
('PN0002', 'NB202310095001', '2023-10-11 10:50:27', '30000', '5000', '63tr3fbugsgd', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_setoran`
--

CREATE TABLE `tb_setoran` (
  `id_setor` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_setor` datetime DEFAULT (now()),
  `nin` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` decimal(30,0) DEFAULT '0',
  `saldo_lama` decimal(30,0) DEFAULT NULL,
  `id_admin` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8mb4_unicode_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_setoran`
--

INSERT INTO `tb_setoran` (`id_setor`, `tanggal_setor`, `nin`, `total`, `saldo_lama`, `id_admin`, `status`) VALUES
('ST20231000001', '2023-10-11 09:52:07', 'NB202310095001', '34000', '0', '63tr3fbugsgd', '1'),
('ST20231000002', '2023-10-12 15:17:03', 'NB202310095001', '8000', '25000', '63tr3fbugsgd', '1'),
('ST20231000003', '2023-10-18 09:16:00', 'NB202310095001', '25000', '33000', '63tr3fbugsgd', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_stok`
--

CREATE TABLE `tb_stok` (
  `id_stok` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sampah` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah` float DEFAULT NULL,
  `tgl_update` timestamp NULL DEFAULT (now())
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_stok`
--

INSERT INTO `tb_stok` (`id_stok`, `id_sampah`, `jumlah`, `tgl_update`) VALUES
('BK001', 'S0001', 12.5, '2023-10-02 06:31:18'),
('BK002', 'S0002', 5, '2023-10-02 06:32:24'),
('BK003', 'S0003', 2, '2023-10-02 06:32:34'),
('BK004', 'S0004', 10, '2023-10-02 06:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` smallint NOT NULL,
  `foto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dibuat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT (now()),
  `dibuat_oleh` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diedit` datetime DEFAULT NULL,
  `is_active` smallint NOT NULL,
  `nama_petugas` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Nasabah',
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_password` smallint DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `email`, `role`, `foto`, `dibuat`, `dibuat_oleh`, `diedit`, `is_active`, `nama_petugas`, `no_hp`, `default_password`, `last_login`) VALUES
('63tr3fbugsgd', 'admin', '$2y$10$46rKPRzRO.dWXXjXEQukne9RZ3NbLk7WOfs.54akoybW8WqMixQAK', 'admin@gmail.com', 3, 'bocchi1.jpg', 'now()', 'Administrator', '2023-10-11 02:48:38', 1, 'Administrator', '089576565444', 0, '2023-10-18 08:55:58'),
('U65260d1db9666', 'PS01', '$2y$10$OeSz43RhXIUl2h0Tjf2ypO29SosrEY0/pouIzMdImxqb29ab6W6KG', 'petugas@gmail.com', 2, 'default.jpg', '2023-10-11 09:49:01', 'Administrator', NULL, 1, 'Petugas 1', '0123456789', 0, '2023-10-11 09:49:23'),
('U65260d6cc0089', 'NB202310095001', '$2y$10$uevnsb5hqCvLmmA/mxgIlOIzCauqdVpDR23IPJV049xBdKARDPJEW', 'yogip@gmail.com', 1, 'default.jpg', '2023-10-11 09:50:20', 'Administrator', '2023-10-11 11:10:33', 1, 'Nasabah', NULL, 0, '2023-10-11 11:10:42'),
('U652f423eb6e28', 'NB202310092601', '$2y$10$Km/iQKEBOE3buXrHVSECg.yGoIbwOkqwUY5UxwwsdHXoCA9Lo.5jC', 'abdan@gmail.com', 1, 'default.jpg', '2023-10-18 09:26:06', 'Administrator', NULL, 1, 'Nasabah', NULL, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jns_sampah`
--
ALTER TABLE `jns_sampah`
  ADD PRIMARY KEY (`id_sampah`) USING BTREE;

--
-- Indexes for table `tb_barangkeluar`
--
ALTER TABLE `tb_barangkeluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_detail_setoran`
--
ALTER TABLE `tb_detail_setoran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kecamatan`
--
ALTER TABLE `tb_kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `tb_nasabah`
--
ALTER TABLE `tb_nasabah`
  ADD PRIMARY KEY (`id_user`) USING BTREE;

--
-- Indexes for table `tb_penarikan`
--
ALTER TABLE `tb_penarikan`
  ADD PRIMARY KEY (`id_penarikan`);

--
-- Indexes for table `tb_setoran`
--
ALTER TABLE `tb_setoran`
  ADD PRIMARY KEY (`id_setor`);

--
-- Indexes for table `tb_stok`
--
ALTER TABLE `tb_stok`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_detail_setoran`
--
ALTER TABLE `tb_detail_setoran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
