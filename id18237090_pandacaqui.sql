-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 01, 2022 at 02:26 PM
-- Server version: 10.5.12-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id18237090_pandacaqui`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `announcementTo` int(11) NOT NULL,
  `subject` varchar(550) NOT NULL,
  `message` longtext NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `documents` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `documents`, `status`) VALUES
(1, 'Form-137', 0),
(2, 'Good moral', 0),
(3, 'Diploma or Certificate', 0),
(11, 'Card', 0);

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` int(11) NOT NULL,
  `grade` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `grade`, `status`) VALUES
(1, 'I', 0),
(2, 'II', 0),
(3, 'III', 0),
(4, 'IV', 0),
(5, 'V', 0),
(6, 'VI', 0);

-- --------------------------------------------------------

--
-- Table structure for table `requestfile`
--

CREATE TABLE `requestfile` (
  `id` int(11) NOT NULL,
  `requestor` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL,
  `file` varchar(250) NOT NULL,
  `reason` longtext NOT NULL,
  `dateRequest` date NOT NULL,
  `dateRelease` date DEFAULT NULL,
  `uploadfiles` text DEFAULT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `gradeID` int(11) NOT NULL,
  `section` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sectionName` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `advicer` int(11) NOT NULL,
  `schoolYear` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `gradeID`, `section`, `sectionName`, `advicer`, `schoolYear`, `status`) VALUES
(25, 1, '1', 'A', 53, '2021-2022', 0),
(27, 1, '2', 'B', 52, '2021-2022', 0),
(31, 2, '1', '2-A', 54, '2021-2022', 0),
(33, 2, '2', '2-B', 55, '2021-2022', 0);

-- --------------------------------------------------------

--
-- Table structure for table `studentgrade`
--

CREATE TABLE `studentgrade` (
  `id` int(11) NOT NULL,
  `studentRecordID` int(11) NOT NULL,
  `subjectID` int(11) NOT NULL,
  `quarter1` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quarter2` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quarter3` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quarter4` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `final` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `studentgrade`
--

INSERT INTO `studentgrade` (`id`, `studentRecordID`, `subjectID`, `quarter1`, `quarter2`, `quarter3`, `quarter4`, `final`, `remarks`) VALUES
(111, 46, 1, '90', '86', '86', '86', '98', 'passed'),
(112, 46, 2, '86', '76', '98', '89', '89', 'passed'),
(113, 46, 3, '89', '98', '89', '88', '98', 'passed'),
(114, 46, 4, '90', '90', '89', '98', '89', 'passed'),
(115, 46, 5, '89', '98', '89', '89', '98', 'passed'),
(116, 46, 6, '89', '98', '98', '89', '98', 'passed'),
(117, 46, 7, '98', '89', '89', '98', '89', 'passed'),
(118, 46, 8, '89', '98', '89', '89', '98', 'passed'),
(119, 46, 9, '89', '98', '98', '98', '89', 'passed'),
(120, 46, 10, '89', '98', '98', '98', '89', 'passed'),
(121, 46, 11, '89', '98', '98', '89', '87', 'passed'),
(122, 46, 12, '89', '89', '98', '98', '87', 'passed'),
(123, 46, 13, '98', '89', '98', '89', '89', 'passed'),
(124, 46, 14, '98', '89', '98', '89', '89', 'passed'),
(125, 46, 103, '87', '78', '87', '78', '98', 'passed'),
(126, 46, 105, '98', '89', '98', '98', '98', 'passed'),
(127, 50, 1, '98', '98', '98', '98', '96', 'passed'),
(128, 50, 2, '98', '899', '89', '98', '97', 'passed'),
(129, 50, 3, '89', '98', '89', '98', '97', 'passed'),
(130, 50, 4, '89', '98', '98', '89', '97', 'passed'),
(131, 50, 5, '98', '98', '89', '98', '98', 'passed'),
(132, 50, 6, '89', '98', '89', '98', '90', 'passed'),
(133, 50, 7, '89', '98', '98', '89', '98', 'passed'),
(134, 50, 8, '89', '98', '98', '89', '87', 'passed'),
(135, 50, 9, '98', '89', '89', '98', '89', 'passed'),
(136, 50, 10, '89', '89', '98', '98', '90', 'passed'),
(137, 50, 11, '89', '98', '98', '98', '90', 'passed'),
(138, 50, 12, '98', '89', '98', '89', '98', 'passed'),
(139, 50, 13, '89', '99', '98', '98', '90', 'passed'),
(140, 50, 14, '89', '89', '89', '98', '89', 'passed'),
(141, 50, 105, '98', '98', '89', '89', '89', 'passed'),
(142, 48, 18, '98', '899', '89', '89', '98', 'passed'),
(143, 48, 19, '89', '897', '97', '99', '90', 'passed'),
(144, 48, 20, '87', '98', '87', '98', '89', 'passed'),
(145, 48, 21, '99', '87', '88', '88', '98', 'passed'),
(146, 48, 22, '99', '97', '98', '86', '89', 'passed'),
(147, 48, 23, '87', '78', '87', '87', '96', 'passed'),
(148, 48, 24, '89', '98', '89', '88', '98', 'passed'),
(149, 48, 25, '87', '87', '98', '87', '87', 'passed'),
(150, 48, 26, '98', '87', '89', '98', '89', 'passed'),
(151, 48, 27, '90', '98', '89', '98', '87', 'passed'),
(152, 48, 28, '89', '98', '98', '89', '89', 'passed'),
(153, 48, 29, '87', '98', '87', '98', '88', 'passed'),
(154, 48, 30, '98', '97', '86', '89', '99', 'passed'),
(155, 48, 97, '87', '87', '87', '98', '97', 'passed'),
(156, 48, 101, '98', '89', '98', '88', '98', 'passed'),
(157, 48, 104, '98', '89', '97', '89', '96', 'passed'),
(158, 49, 18, '98', '89', '98', '89', '87', 'passed'),
(159, 49, 19, '89', '89', '89', '98', '86', 'passed'),
(160, 49, 20, '87', '89', '90', '87', '89', 'passed'),
(161, 49, 21, '98', '89', '89', '88', '87', 'passed'),
(162, 49, 22, '87', '90', '88', '89', '88', 'passed'),
(163, 49, 23, '87', '90', '87', '89', '88', 'passed'),
(164, 49, 24, '87', '87', '88', '87', '89', 'passed'),
(165, 49, 25, '89', '98', '87', '87', '87', 'passed'),
(166, 49, 26, '97', '85', '87', '85', '89', 'passed'),
(167, 49, 27, '84', '87', '96', '93', '89', 'passed'),
(168, 49, 28, '89', '91', '92', '93', '88', 'passed'),
(169, 49, 29, '89', '98', '89', '89', '89', 'passed'),
(170, 49, 30, '98', '98', '89', '98', '98', 'passed'),
(171, 49, 97, '89', '98', '98', '89', '89', 'passed'),
(172, 49, 101, '89', '89', '89', '88', '87', 'passed'),
(173, 49, 104, '86', '88', '98', '98', '96', 'passed');

-- --------------------------------------------------------

--
-- Table structure for table `studentrecordhistory`
--

CREATE TABLE `studentrecordhistory` (
  `id` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL,
  `nextSectionID` int(11) DEFAULT NULL,
  `studentID` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `studentrecordhistory`
--

INSERT INTO `studentrecordhistory` (`id`, `sectionID`, `nextSectionID`, `studentID`, `status`) VALUES
(46, 25, NULL, 56, 0),
(48, 31, NULL, 58, 0),
(49, 33, NULL, 59, 0),
(50, 27, NULL, 60, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `gradeID` int(11) NOT NULL,
  `subject` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `gradeID`, `subject`, `status`) VALUES
(1, 1, 'Mother Tongue', 0),
(2, 1, 'Filipino', 0),
(3, 1, 'English', 0),
(4, 1, 'Mathematics', 0),
(5, 1, 'Science', 0),
(6, 1, 'Araling Panlipunan', 0),
(7, 1, 'EPP/TLE', 0),
(8, 1, 'MAPEH', 0),
(9, 1, 'Music', 0),
(10, 1, 'Arts', 0),
(11, 1, 'Physical Education', 0),
(12, 1, 'Health', 0),
(13, 1, 'Edukasyon sa Pagpapakatao', 0),
(14, 1, 'Arabic Language', 0),
(15, 1, 'Islamic Values Education', 1),
(16, 1, 'General Average', 1),
(17, 2, 'Mother Tongue', 1),
(18, 2, 'Filipino', 0),
(19, 2, 'English', 0),
(20, 2, 'Mathematics', 0),
(21, 2, 'Science', 0),
(22, 2, 'Araling Panlipunan', 0),
(23, 2, 'EPP/TLE', 0),
(24, 2, 'MAPEH', 0),
(25, 2, 'Music', 0),
(26, 2, 'Arts', 0),
(27, 2, 'Physical Education', 0),
(28, 2, 'Health', 0),
(29, 2, 'Edukasyon sa Pagpapakatao', 0),
(30, 2, 'Arabic Language', 0),
(31, 2, 'Islamic Values Education', 1),
(32, 2, 'General Average', 1),
(33, 3, 'Mother Tongue', 0),
(34, 3, 'Filipino', 0),
(35, 3, 'English', 0),
(36, 3, 'Mathematics', 0),
(37, 3, 'Science', 0),
(38, 3, 'Araling Panlipunan', 0),
(39, 3, 'EPP/TLE', 0),
(40, 3, 'MAPEH', 0),
(41, 3, 'Music', 0),
(42, 3, 'Arts', 0),
(43, 3, 'Physical Education', 0),
(44, 3, 'Health', 0),
(45, 3, 'Edukasyon sa Pagpapakatao', 0),
(46, 3, 'Arabic Language', 0),
(47, 3, 'Islamic Values Education', 0),
(48, 3, 'General Average', 1),
(49, 4, 'Mother Tongue', 0),
(50, 4, 'Filipino', 0),
(51, 4, 'English', 0),
(52, 4, 'Mathematics', 0),
(53, 4, 'Science', 0),
(54, 4, 'Araling Panlipunan', 0),
(55, 4, 'EPP/TLE', 0),
(56, 4, 'MAPEH', 0),
(57, 4, 'Music', 0),
(58, 4, 'Arts', 0),
(59, 4, 'Physical Education', 0),
(60, 4, 'Physical Education', 1),
(61, 4, 'Health', 0),
(62, 4, 'Edukasyon sa Pagpapakatao', 0),
(63, 4, 'Arabic Language', 0),
(64, 4, 'Islamic Values Education', 0),
(65, 4, 'General Average', 1),
(66, 5, 'Mother Tongue', 0),
(67, 5, 'Filipino', 0),
(68, 5, 'English', 0),
(69, 5, 'Mathematics', 0),
(70, 5, 'Science', 0),
(71, 5, 'Araling Panlipunan', 0),
(72, 5, 'EPP/TLE', 0),
(73, 5, 'MAPEH', 0),
(74, 5, 'Music', 0),
(75, 5, 'Arts', 0),
(76, 5, 'Physical Education', 0),
(77, 5, 'Health', 0),
(78, 5, 'Edukasyon sa Pagpapakatao', 0),
(79, 5, 'Arabic Language', 0),
(80, 5, 'Islamic Values Education', 0),
(81, 5, 'General Average', 1),
(82, 6, 'Mother Tongue', 0),
(83, 6, 'Filipino', 0),
(84, 6, 'English', 0),
(85, 6, 'Mathematics', 0),
(86, 6, 'Science', 0),
(87, 6, 'Araling Panlipunan', 0),
(88, 6, 'EPP/TLE', 0),
(89, 6, 'MAPEH', 0),
(90, 6, 'Music', 0),
(91, 6, 'Arts', 0),
(92, 6, 'Physical Education', 0),
(93, 6, 'Health', 0),
(94, 6, 'Edukasyon sa Pagpapakatao', 0),
(95, 6, 'Islamic Values Education', 0),
(96, 6, 'General Average', 1),
(97, 2, 'Islamic Values Education', 0),
(98, 1, 'Islamic Values Education', 1),
(99, 3, '', 1),
(100, 5, 'Physics', 1),
(101, 2, 'Mother Tongue', 0),
(102, 1, 'Islamic Values Education', 1),
(103, 1, 'Islamic Values Education', 1),
(104, 2, 'Islamic Values Education', 1),
(105, 1, 'Islamic Values Education', 0),
(106, 6, 'Arabic Language', 0);

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE `useraccount` (
  `id` int(11) NOT NULL,
  `email` varchar(550) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(550) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(550) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(550) COLLATE utf8_unicode_ci NOT NULL,
  `mname` varchar(550) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(550) COLLATE utf8_unicode_ci NOT NULL,
  `bday` date NOT NULL,
  `gender` varchar(550) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(550) COLLATE utf8_unicode_ci NOT NULL,
  `section` int(11) DEFAULT NULL,
  `position` varchar(550) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`id`, `email`, `password`, `image`, `fname`, `mname`, `lname`, `bday`, `gender`, `address`, `section`, `position`, `status`) VALUES
(1, 'Admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'images/profile/1643983541DSC_0265.JPG', 'Arione', 'Bautista', 'Reyes', '2022-01-10', 'Male', 'Masantol Pampanga', NULL, 'Admin', 0),
(52, 'mae2@email.com', 'e10adc3949ba59abbe56e057f20f883e', 'images/profile/profile.png', 'Mae', 'Pangilinan ', 'Bautista', '1990-11-30', 'Female', 'Magalang, Pampanga', NULL, 'Teacher', 0),
(53, 'rein1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'images/profile/profile.png', 'Rein  ', 'Salonga', 'Yumang', '1986-11-30', 'Male', 'Magalang, Pampanga', NULL, 'Teacher', 0),
(54, 'junior3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'images/profile/profile.png', 'Junior ', 'Perez ', 'Banal', '1986-06-30', 'Male', 'Arayat, Pampanga', NULL, 'Teacher', 0),
(55, 'efren4@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'images/profile/profile.png', 'Efren', 'Ventura ', 'Salazar', '1982-07-30', 'Male', 'Magalang, Pampanga', NULL, 'Teacher', 0),
(56, '10111213', 'e10adc3949ba59abbe56e057f20f883e', 'images/profile/profile.png', 'Ronel ', 'Manansala', 'Sunga', '2000-06-30', 'Male', 'Magalang, Pampanga', 25, 'Student', 0),
(58, '20111213', 'e10adc3949ba59abbe56e057f20f883e', 'images/profile/profile.png', 'Aldrin ', 'Suarez', 'Garcia', '2000-12-30', 'Male', 'Magalang, Pampanga', 31, 'Student', 0),
(59, '20121314', 'e10adc3949ba59abbe56e057f20f883e', 'images/profile/profile.png', 'Tony', 'Manalo ', 'Batas', '2000-07-30', 'Female', 'Magalang. Pampanga', 33, 'Student', 0),
(60, '10121314', 'e10adc3949ba59abbe56e057f20f883e', 'images/profile/profile.png', 'Jv', 'Supan', 'Tolentino', '2000-07-30', 'Male', 'Magalang, Pampanga', 27, 'Student', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requestfile`
--
ALTER TABLE `requestfile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentgrade`
--
ALTER TABLE `studentgrade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentrecordhistory`
--
ALTER TABLE `studentrecordhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requestfile`
--
ALTER TABLE `requestfile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `studentgrade`
--
ALTER TABLE `studentgrade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `studentrecordhistory`
--
ALTER TABLE `studentrecordhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `useraccount`
--
ALTER TABLE `useraccount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
