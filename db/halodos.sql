-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2023 at 09:41 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `halodos`
--

-- --------------------------------------------------------

--
-- Table structure for table `mskampus`
--

CREATE TABLE `mskampus` (
  `kampusid` int(11) NOT NULL,
  `kampusname` varchar(225) NOT NULL,
  `kampusaddress` text NOT NULL,
  `createdby` int(100) NOT NULL,
  `createddate` timestamp NULL DEFAULT NULL,
  `updatedby` int(100) NOT NULL,
  `updateddate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mskampus`
--

INSERT INTO `mskampus` (`kampusid`, `kampusname`, `kampusaddress`, `createdby`, `createddate`, `updatedby`, `updateddate`) VALUES
(1, 'Universitas Terbuka', 'Learn From Home', 1, '2023-09-29 22:41:31', 1, '2023-09-30 13:22:53'),
(5, 'Universita Muhammadiyah Malang', 'Cedek PGRI', 1, '2023-09-30 12:58:16', 1, '2023-09-30 13:03:36');

-- --------------------------------------------------------

--
-- Table structure for table `msprodi`
--

CREATE TABLE `msprodi` (
  `prodiid` int(11) NOT NULL,
  `prodiname` varchar(225) NOT NULL,
  `kampusid` int(100) NOT NULL,
  `createdby` int(100) NOT NULL,
  `createddate` timestamp NULL DEFAULT NULL,
  `updatedby` int(100) NOT NULL,
  `updateddate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `msprodi`
--

INSERT INTO `msprodi` (`prodiid`, `prodiname`, `kampusid`, `createdby`, `createddate`, `updatedby`, `updateddate`) VALUES
(1, 'Sistem Informatika', 1, 1, '2023-09-29 22:41:31', 1, '2023-09-29 22:41:31');

-- --------------------------------------------------------

--
-- Table structure for table `mstopic`
--

CREATE TABLE `mstopic` (
  `topicid` int(11) NOT NULL,
  `topicname` varchar(225) NOT NULL,
  `masterid` int(100) DEFAULT NULL,
  `kampusid` int(100) NOT NULL,
  `prodiid` int(100) NOT NULL,
  `images` varchar(225) DEFAULT NULL,
  `createdby` int(100) NOT NULL,
  `createddate` timestamp NULL DEFAULT NULL,
  `updatedby` int(100) NOT NULL,
  `updateddate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mstopic`
--

INSERT INTO `mstopic` (`topicid`, `topicname`, `masterid`, `kampusid`, `prodiid`, `images`, `createdby`, `createddate`, `updatedby`, `updateddate`) VALUES
(5, 'Topic Satu', NULL, 1, 1, '1696527265_16d65f20143cba2d3b9c.png', 5, '2023-10-05 09:18:01', 5, '2023-10-05 10:34:25'),
(6, 'Subtopic satu', 5, 1, 1, NULL, 5, '2023-10-05 09:19:34', 5, '2023-10-05 09:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `msuser`
--

CREATE TABLE `msuser` (
  `userid` int(11) NOT NULL,
  `fullname` varchar(225) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(225) NOT NULL,
  `phonenumber` varchar(30) NOT NULL,
  `jeniskelamin` varchar(40) NOT NULL,
  `kampusid` int(100) NOT NULL,
  `prodiid` int(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `profilepict` varchar(225) NOT NULL,
  `createdby` int(100) NOT NULL,
  `createddate` timestamp NULL DEFAULT NULL,
  `updatedby` int(100) NOT NULL,
  `updateddate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `msuser`
--

INSERT INTO `msuser` (`userid`, `fullname`, `password`, `email`, `phonenumber`, `jeniskelamin`, `kampusid`, `prodiid`, `role`, `profilepict`, `createdby`, `createddate`, `updatedby`, `updateddate`) VALUES
(1, 'Administrator', '$2y$10$MweRw6mMrgZXE2FEVAp8yOIM0Tjp0UT4AJqXuNm1gwup8o48KsHDq', 'administrator@gmail.com', '0822123123', 'lakilaki', 1, 1, 'admin', '', 1, '2023-09-29 22:41:31', 1, '2023-10-03 11:02:05'),
(2, 'Arifianto', '$2y$10$ijOcC6uR1Wi3SzptqZfjk.kajVUrFYX1PN76xTrTAjqCd3s8RKQFe', 'email@gmail.com', '234234', 'lakilaki', 1, 1, 'user', '', 1, '2023-10-01 00:30:15', 1, '2023-10-01 00:46:00'),
(4, 'Arifianto', '$2y$10$M8MbDHxGP5Ia2ndFC1nKPuWur5D8MezyYdXI0vorhE19Hj.4lv1WW', 'percobaan@gmail.com', '123843738', 'lakilaki', 1, 1, 'user', '', 4, '2023-10-04 05:44:59', 4, '2023-10-04 06:01:29'),
(5, 'Dosen', '$2y$10$8nxCbrTnd7u8gMG9fsuRC.13QxXR7W5.9N9jw4Oynefa.7g.haJL6', 'dosen@gmail.com', '1273912738912739', 'lakilaki', 1, 1, 'dospem', '', 0, '2023-10-05 05:36:04', 5, '2023-10-05 05:39:55'),
(6, '', '$2y$10$C1eTqgPEP0qNK8g54Lcuueo6wv6fvfRpifM.Q5JlyeRpVLqUO5kvC', 'dosen2@gmail.com', '', '', 0, 0, 'dospem', '', 0, '2023-10-05 06:04:09', 0, '2023-10-05 06:04:09');

-- --------------------------------------------------------

--
-- Table structure for table `trkonsultasi`
--

CREATE TABLE `trkonsultasi` (
  `konsulid` int(100) NOT NULL,
  `kampusid` int(100) NOT NULL,
  `prodiid` int(100) NOT NULL,
  `topicid` int(100) NOT NULL,
  `topicdtid` int(100) NOT NULL,
  `dosenid` int(100) NOT NULL,
  `userid` int(100) NOT NULL,
  `tanggal` date NOT NULL,
  `jamfrom` time NOT NULL,
  `jamto` time NOT NULL,
  `status` varchar(100) NOT NULL,
  `reason` text NOT NULL,
  `link` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mskampus`
--
ALTER TABLE `mskampus`
  ADD PRIMARY KEY (`kampusid`);

--
-- Indexes for table `msprodi`
--
ALTER TABLE `msprodi`
  ADD PRIMARY KEY (`prodiid`);

--
-- Indexes for table `mstopic`
--
ALTER TABLE `mstopic`
  ADD PRIMARY KEY (`topicid`);

--
-- Indexes for table `msuser`
--
ALTER TABLE `msuser`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `trkonsultasi`
--
ALTER TABLE `trkonsultasi`
  ADD PRIMARY KEY (`konsulid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mskampus`
--
ALTER TABLE `mskampus`
  MODIFY `kampusid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `msprodi`
--
ALTER TABLE `msprodi`
  MODIFY `prodiid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mstopic`
--
ALTER TABLE `mstopic`
  MODIFY `topicid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `msuser`
--
ALTER TABLE `msuser`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trkonsultasi`
--
ALTER TABLE `trkonsultasi`
  MODIFY `konsulid` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
