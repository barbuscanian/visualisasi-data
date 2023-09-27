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
-- Table structure for table `jumlahpptahun`
--

CREATE TABLE `jumlahpptahun` (
  `id` int(11) NOT NULL,
  `tahun` int(11) DEFAULT NULL,
  `penumpang` int(11) DEFAULT NULL,
  `pendapatan` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jumlahpptahun`
--

INSERT INTO `jumlahpptahun` (`id`, `tahun`, `penumpang`, `pendapatan`) VALUES
(1, 2019, 264032780, 672148292788),
(2, 2020, 126845277, 280277306064),
(3, 2021, 98882818, 173740536049);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jumlahpptahun`
--
ALTER TABLE `jumlahpptahun`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jumlahpptahun`
--
ALTER TABLE `jumlahpptahun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
