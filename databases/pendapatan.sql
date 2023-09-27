-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 27, 2023 at 01:29 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21141132_transjakarta`
--

-- --------------------------------------------------------

--
-- Table structure for table `pendapatan`
--

CREATE TABLE `pendapatan` (
  `Kode` varchar(21) NOT NULL DEFAULT '',
  `Trayek` longtext DEFAULT NULL,
  `Jenis` varchar(27) DEFAULT NULL,
  `year_2019` bigint(20) DEFAULT NULL,
  `year_2020` bigint(20) DEFAULT NULL,
  `year_2021` bigint(20) DEFAULT NULL,
  `id_pendapatan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pendapatan`
--

INSERT INTO `pendapatan` (`Kode`, `Trayek`, `Jenis`, `year_2019`, `year_2020`, `year_2021`, `id_pendapatan`) VALUES
('Angkutan Pariwisata', '(BW2) Jakarta Baru\n(BW4) Pencakar Langit\n(BW9) Monas - Pantai Indah Kapuk', 'Layanan Bus Wisata', 0, 0, 0, 1),
('Angkutan Umum', '(P1) Lebak Bulus - Pondok Indah\n(P2) Lebak Bulus - Blok M\n(P3) Lebak Bulus - Pondok Gede\n(P4) Lebak Bulus - Kemang\n(P5) Lebak Bulus - Kebayoran Baru\n(P6) Lebak Bulus - Senopati\n(P7) Lebak Bulus - Kuningan\n(P8) Lebak Bulus - Setiabudi\n(P9) Lebak Bulus - Thamrin\n(P10) Lebak Bulus - Monas', 'Layanan Bus Pengumpan', 126947054994, 32531332752, 0, 2),
('Angkutan Umum Lainnya', 'Semua Trayek dengan Kartu Layanan Gratis', 'Layanan Bus Gratis', 0, 0, 104922500, 3),
('Koridor I ', '(1) Blok M - Kota', 'Layanan Sistem BRT', 93950566124, 43665098213, 29516746498, 4),
('Koridor II ', '(2) Pulogadung 1 - Monas\n(2A) Pulogadung 1 - Rawa Buaya', 'Layanan Sistem BRT', 29913094973, 14976964000, 10797570187, 5),
('Koridor III ', '(3) Kalideres - Monas via Veteran\n(3F) Kalideres - Gelora Bung Karno (GBK)\n(3H) Jelambar - Kota', 'Layanan Sistem BRT', 39975278549, 20922782000, 15040274996, 6),
('Koridor IV ', '(4) Pulogadung 2 - Dukuh Atas 2\n(4D) Pulogadung 2 - Kuningan', 'Layanan Sistem BRT', 29455491234, 12652492500, 8406663000, 7),
('Koridor IX ', '(9) Pinang Ranti - Pluit', 'Layanan Sistem BRT', 55483788767, 30379656492, 21994603992, 8),
('Koridor V ', '(5) Kp.Melayu - Ancol\n(5C) PGC 2 - Juanda\n(5D) PGC 1 - Ancol', 'Layanan Sistem BRT', 38144616872, 18468433022, 13652045389, 9),
('Koridor VI ', '(6) Ragunan - Dukuh Atas 2\n(6A) Ragunan - MH Thamrin via Kuningan\n(6B) Ragunan - MH Thamrin via Semanggi\n(6V) Ragunan - Polda Metro Jaya', 'Layanan Sistem BRT', 38855459654, 17879747000, 11658961500, 10),
('Koridor VII ', '(7) Kp.Melayu - Kp.Rambutan\n(7F) Kp.Rambutan - Juanda via Cempaka Putih', 'Layanan Sistem BRT', 34379598199, 16078734549, 12028224494, 11),
('Koridor VIII ', '(8) Lebak Bulus - Pasar Baru', 'Layanan Sistem BRT', 39826013203, 20247399500, 14822881999, 12),
('Koridor X ', '(10) Tanjung Priok - PGC 2\n(10D) Tanjung Priok - Kp.Rambutan\n(10H) Tanjung Priok - Kejaksaan Agung', 'Layanan Sistem BRT', 31109086987, 17258548000, 12050660992, 13),
('Koridor XI ', '(11) Pulogebang - Kp.Melayu', 'Layanan Sistem BRT', 11032062040, 5865508500, 4173351000, 14),
('Koridor XII ', '(12) Pluit - Tanjung Priok', 'Layanan Sistem BRT', 9371415690, 6085049501, 4698685998, 15),
('Koridor XIII ', '(13) Ciledug - Tendean\n(13C) Puri Beta 2 - Ragunan\n(13D) Puri Beta 2 - Latuharhari', 'Layanan Sistem BRT', 27028211502, 13536280509, 9501512496, 16),
('Mikrotrans', '(JAK01) Tanjung Priok - Plumpang\r\n(JAK02) Kampung Melayu - Duren Sawit\r\n(JAK03) Lebak Bulus - Andara\r\n(JAK04) Grogol - Tubagus Angke\r\n(JAK05) Semper - Rorotan\r\n(JAK06) Kp Rambutan - Pondok Gede\r\n(JAK07) Tanah Abang - Grogol Via Tawakal\r\n(JAK08) Roxy - Benhil\r\n(JAK09) Roxy Mas - Karet\r\n(JAK10) Tanah Abang\r\n(JAK100 ) Terminal Pulo Gebang - Rusun Pinus Elok\r\n(JAK105 ) St Tebet - Rusun Cipinang Muara\r\n(JAK106) Terminal Klender - Terminal Kp Melayu\r\n(JAK10A) Gondangdia - Cikini Via Salemba Raya\r\n(JAK10B)Gondangdia - Cikini Via Kramat Raya\r\n(JAK11) Tanah Abang - Kebayoran Lama\r\n(JAK110A) Rusun Marunda - Pulogebang\r\n(JAK110B) Rusun Komarudin - Putaran Balik Bebek Tni\r\n(JAK112) Terminal Tanah Merah - Pulogadung\r\n(JAK113) Rusun Sindang Koja - Kp Sawah\r\n(JAK115) Terminal Tj Priok - Pegangsaan Ii Igi\r\n(JAK117) Tj Priok - Tanah Merdeka\r\n(JAK118) Taman Waduk Papanggo - Kota Tua\r\n(JAK12 ) Tanah Abang - Kebayoran Lama Via Pos Pengumben\r\n(JAK120) Jakarta International Stadium - Term.Muara Angke\r\n(JAK13) Tanah Abang - Kota Intan Via Lima\r\n(JAK14) Tanah Abang - Meruya\r\n(JAK15) Bulak Turi - Tj Priok\r\n(JAK16) Cililitan ( Pgc ) - Condet\r\n(JAK17) Senen - Pulogadung\r\n(JAK18) St. Duren Kalibata - Kuningan\r\n(JAK19) Pinang Ranti - Kp Rambutan\r\n(JAK20) Cawang Uki - Lubang Buaya\r\n(JAK21) Cililitan ( Pgc ) - Dwikora\r\n(JAK22) Dwikora - Penas Kalimalang\r\n(JAK23) Senen - Pisangan Baru\r\n(JAK24) Senen - Pulogadung Via Kelapa Gading\r\n(JAK25) Kp Rambutan - Kalisari\r\n(JAK26) Rawamangun - Duren Sawit\r\n(JAK27) Pulogebang - Rorotan\r\n(JAK28) Pasar Rebo - Stasiun Lrt Harjamukti\r\n(JAK29) Tj Priok - Sukapura\r\n(JAK30) Grogol - Meruya Via Roxy\r\n(JAK31) Blok M - Andara\r\n(JAK32) Lebak Bulus - Petukangan\r\n(JAK33) Pulogadung - Kota\r\n(JAK34) Terminal Klender - Terminal Rawamangun\r\n(JAK35) Rawamngun - Pangkalan Jati\r\n(JAK36) Cilangkap - Cililitan ( Pgc )\r\n(JAK37) Cililitan ( Pgc ) - Condet Via Kayu Manis\r\n(JAK38) Bulak Ringin - Kp Rambutan\r\n(JAK39) Kalimalang - Duren Sawit\r\n(JAK40) Harapan Baru - Pulogebang Via Rawa Kuning\r\n(JAK41) Kampung Melayu - Pulogadung\r\n(JAK42) Kampung Melayu - Pondok Kelapa\r\n(JAK43B) Tongtek - Tebet Eco Park\r\n(JAK43C) Sarana Jaya - Tebet Eco Park - St.Cawang\r\n(JAK44) Andara - St Universitas Pancasila\r\n(JAK45)  Lebak Bulus - Ragunan\r\n(JAK46) Pasar Minggu - Jagakarsa\r\n(JAK47) Pasar Minggu - Ciganjur Via Kb Ragunan\r\n(JAK48A) St Tebet - Karet\r\n(JAK48B) St Tebet - Kampung Melayu\r\n(JAK49) Lebak Bulus - Cipulir\r\n(JAK50) Kalideres - Puri Kembangan\r\n(JAK51) Taman Kota - Budi Luhur\r\n(JAK52) Kalideres - Muara Angke\r\n(JAK53) Grogol - Pos Pengumben\r\n(JAK54) Grogol - Benhil\r\n(JAK56) Grogol - Srengseng\r\n(JAK58) Cilincing - Rorotan\r\n(JAK59) Rawamangun - Tanah Merah\r\n(JAK60) Kelapa Gading - Rusun Kemayoran\r\n(JAK61) Cempaka Putih - Pulogadung Via Kelapa Gading\r\n(JAK64) Aseli - Term. Pasar Minggu\r\n(JAK71) Kp Rambutan - Pinang Ranti\r\n(JAK72) Kp Rambutan - Pasar Rebo Via Poncol\r\n(JAK73) Stasiun Lrt Harjamukti - Kramat Jati\r\n(JAK74) Rawamangun - Cipinang Muara\r\n(JAK75) Cililitan - Kampung Pulo\r\n(JAK77) Tanjung Priok - Jembatan Hitam\r\n(JAK80) Rawa Buaya - Rawa Kompeni\r\n(JAK84) Terminal Kampung Melayu - Kapin Raya\r\n(JAK85) Bintara - Cipinang Indah\r\n(JAK86) Terminal Rawamangun - Terminal Manggarai\r\n(JAK88) Terminal Tj Priok - Ancol Barat\r\n(JAK89) Terminal Tanjung Priok - Taman Kota Intan\r\n(JAK90) Terminal Tanjung Priok - Rusun Kemayoran\r\n(JAK99) Terminal Pulo Gadung - Lampiri', 'Layanan Pengumpan Bus Kecil', 0, 0, 0, 17),
('Royaltrans', '(1K) Cibubur Junction - Blok M\n(1T) Cibubur - Balai Kota\n(1U) Taman Mini - Balaikota\n(6P) Cibubur - Kuningan\n(B13) Bekasi Barat - Blok M\n(B14) Bekasi Barat - Kuningan\n(D31) Cinere - Kuningan\n(D32) Cinere - Bundaran Senayan\n(S12) BSD Serpong - Fatmawati\n(S31) Bintaro - Fatmawati', 'Layanan Premium', 23332620000, 28900000, 3037740000, 18),
('Transjabodetabek', '(2B) Harapan Indah - Asmi\n(7C) Cibubur - BKN\n(B11) Sumarecon Bekasi - BNN\n(B21) Bekasi Timur - BNN\n(D11) Depok - PGC 1\n(D21) Universitas Indonesia - Lebak Bulus\n(S11) BSD (Serpong) - Jelambar\n(S21) CSW - Ciputat\n(S22) Ciputat - Kp.Rambutan\n(T11) Poris Plawad - Bundaran Senayan\n(T12) Poris Plawad - Juanda', 'Layanan Perbatasan', 44343934000, 9700379526, 2255691008, 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pendapatan`
--
ALTER TABLE `pendapatan`
  ADD PRIMARY KEY (`id_pendapatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pendapatan`
--
ALTER TABLE `pendapatan`
  MODIFY `id_pendapatan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
