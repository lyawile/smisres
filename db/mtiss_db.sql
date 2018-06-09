-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2018 at 10:59 AM
-- Server version: 5.7.16-log
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mtiss_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `id` int(4) NOT NULL,
  `studId` int(4) NOT NULL,
  `examYear` int(4) NOT NULL,
  `streamId` int(4) NOT NULL,
  `subjectID` int(4) NOT NULL,
  `march` decimal(3,0) DEFAULT NULL,
  `june` decimal(3,0) DEFAULT NULL,
  `september` decimal(3,0) DEFAULT NULL,
  `december` decimal(3,0) DEFAULT NULL,
  `dateInserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stream`
--

CREATE TABLE `stream` (
  `id` int(4) NOT NULL,
  `streamName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stream`
--

INSERT INTO `stream` (`id`, `streamName`) VALUES
(1, 'Form One'),
(2, 'Form Two'),
(3, 'Form Three'),
(4, 'Form Four');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(4) NOT NULL,
  `classId` int(11) NOT NULL,
  `candidateNumber` varchar(13) DEFAULT NULL,
  `firstname` varchar(20) NOT NULL,
  `middlename` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `dateRegistered` datetime NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `birthDate` date NOT NULL,
  `picUrl` varchar(255) DEFAULT NULL,
  `vision` tinyint(4) NOT NULL COMMENT '0 normal, 1 Blind, 2 Low vision',
  `standardSeven` varchar(50) NOT NULL,
  `year` int(4) NOT NULL,
  `medium` varchar(20) NOT NULL,
  `address` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `classId`, `candidateNumber`, `firstname`, `middlename`, `surname`, `dateRegistered`, `phoneNumber`, `gender`, `birthDate`, `picUrl`, `vision`, `standardSeven`, `year`, `medium`, `address`) VALUES
(74, 1, NULL, 'HASSAN', 'Ramadhani', 'Amiri', '2018-05-29 20:54:53', '0654845412', 1, '2007-02-01', '', 0, 'Uyui Primary School', 2016, 'Swahili', 'Urambo, Tabora'),
(75, 1, NULL, 'Selemani', 'Ching\'oro', 'Mafuru', '2018-05-30 14:54:56', '0654845412', 1, '2004-02-04', '', 0, 'Bereko Primary School', 2007, 'English', 'Musoma'),
(78, 3, NULL, 'Mwajuma', 'Hamis', 'Amiri', '2018-05-30 16:22:54', '0688026388', 1, '1998-05-13', '', 0, 'Bereko Primary School', 2003, 'Swahili', 'Mtwara Municipality'),
(79, 1, NULL, 'Hassan', 'Ally ', 'Lyawile', '2018-05-31 00:00:00', '06845124512', 1, '2002-01-10', NULL, 0, 'Majengo Primary School', 2017, '1', 'Mtwara'),
(80, 1, NULL, 'Juma', 'Ally ', 'Kalenje', '2018-05-31 00:00:00', '06845121211', 1, '2000-01-25', NULL, 0, 'Majengo Primary School', 2017, '1', 'Mtwara'),
(81, 1, NULL, 'Bahati', 'Rashid', 'Amiri', '2018-05-31 00:00:00', '06512452225', 2, '2004-01-10', NULL, 0, 'Ligula Primary School', 2017, '2', 'Mtwara');

-- --------------------------------------------------------

--
-- Table structure for table `students_masomo`
--

CREATE TABLE `students_masomo` (
  `id` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `Chemistry` int(1) DEFAULT NULL,
  `Physics` int(1) DEFAULT NULL,
  `Mathematics` int(1) DEFAULT NULL,
  `Civics` int(1) DEFAULT NULL,
  `Geography` int(1) DEFAULT NULL,
  `Islamic_Knowledge` int(1) DEFAULT NULL,
  `Quran` int(1) DEFAULT NULL,
  `Kiswahili` int(1) DEFAULT NULL,
  `English` int(1) DEFAULT NULL,
  `dateInserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students_masomo`
--

INSERT INTO `students_masomo` (`id`, `studentId`, `Chemistry`, `Physics`, `Mathematics`, `Civics`, `Geography`, `Islamic_Knowledge`, `Quran`, `Kiswahili`, `English`, `dateInserted`) VALUES
(67, 74, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2018-06-01 14:42:48'),
(68, 75, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2018-05-31 04:52:20'),
(69, 78, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2018-06-01 11:16:23'),
(70, 79, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2018-05-31 13:37:10'),
(71, 80, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2018-05-31 13:37:10'),
(72, 81, 1, 0, 1, 1, 1, 1, 1, 1, 1, '2018-06-03 17:18:11');

-- --------------------------------------------------------

--
-- Table structure for table `student_in_stream`
--

CREATE TABLE `student_in_stream` (
  `id` int(4) NOT NULL,
  `studentId` int(4) NOT NULL,
  `streamId` int(4) NOT NULL,
  `yearRegistered` int(4) NOT NULL,
  `timeRegistered` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(4) NOT NULL,
  `subjectName` varchar(20) NOT NULL,
  `subjectCode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subjectName`, `subjectCode`) VALUES
(1, 'Chemistry', '101'),
(2, 'Physics', '102'),
(3, 'Mathematics', '103'),
(4, 'Civics', '104'),
(5, 'Geography', '105'),
(6, 'Islamic_Knowledge', '106'),
(7, 'Quran', '107'),
(8, 'Kiswahili', '108'),
(9, 'English', '109');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(3) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `category` int(11) NOT NULL,
  `dateInserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(4) NOT NULL COMMENT '1=yes, 0=no',
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `firstName`, `middleName`, `Surname`, `password`, `username`, `category`, `dateInserted`, `active`, `gender`) VALUES
(16, 'Rashid', 'Ramadhan', 'Duru', 'e10adc3949ba59abbe56e057f20f883e', 'admin', 1, '2018-06-07 08:44:57', 1, 'male');

-- --------------------------------------------------------

--
-- Table structure for table `user_category`
--

CREATE TABLE `user_category` (
  `id` int(11) NOT NULL,
  `group` varchar(10) NOT NULL,
  `dateInserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_category`
--

INSERT INTO `user_category` (`id`, `group`, `dateInserted`) VALUES
(1, 'Admin', '2018-06-03 13:42:13'),
(2, 'Teacher', '2018-06-03 13:42:13'),
(3, 'Accounts', '2018-06-03 13:42:35'),
(4, 'Reports', '2018-06-03 13:42:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stream`
--
ALTER TABLE `stream`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_masomo`
--
ALTER TABLE `students_masomo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_in_stream`
--
ALTER TABLE `student_in_stream`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `user_category`
--
ALTER TABLE `user_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `students_masomo`
--
ALTER TABLE `students_masomo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_category`
--
ALTER TABLE `user_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
