-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 20, 2021 at 01:15 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DRTB_DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `resetPassToken`
--

CREATE TABLE `resetPassToken` (
  `id` int(11) NOT NULL,
  `token` varchar(500) DEFAULT NULL,
  `currentDataTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resetPassToken`
--

INSERT INTO `resetPassToken` (`id`, `token`, `currentDataTime`) VALUES
(12, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xOTIuMTY4LjEuMzRcL0RSVEItdjFcL3BocF9qd3RcLyIsImF1ZCI6Imh0dHA6XC9cLzE5Mi4xNjguMS4zNFwvRFJUQi12MVwvcGhwX2p3dFwvIiwiaWF0IjoxNjM0NzI2NDcwLCJleHAiOjE2MzQ3MjY1OTAsImRhdGEiOnsidXNlcklkIjoibWtAMTI0In19.aiWgjwR6VS6nuaFTRB06JACFAJEbPl5vCK-V8b4NDiw', '2021-10-20 10:41:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `resetPassToken`
--
ALTER TABLE `resetPassToken`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `resetPassToken`
--
ALTER TABLE `resetPassToken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
