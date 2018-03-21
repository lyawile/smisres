-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2018 at 08:24 PM
-- Server version: 5.7.18-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `cand_result`
--

CREATE TABLE `cand_result` (
  `studentId` int(13) NOT NULL,
  `candidateNumber` varchar(13) NOT NULL,
  `subjectCode` varchar(4) NOT NULL,
  `score` int(11) NOT NULL,
  `dateInserted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cand_result`
--

INSERT INTO `cand_result` (`studentId`, `candidateNumber`, `subjectCode`, `score`, `dateInserted`) VALUES
(2, 'S0139-18-0001', '101', 45, '2018-02-08 00:00:00'),
(3, 'S0139-18-0001', '102', 40, '2018-02-08 00:00:00'),
(4, 'S0139-18-0001', '103', 60, '2018-02-08 00:00:00'),
(5, 'S0139-18-0001', '104', 60, '2018-02-08 00:00:00'),
(6, 'S0139-18-0002', '101', 48, '2018-02-08 00:00:00'),
(7, 'S0139-18-0002', '102', 85, '2018-02-08 00:00:00'),
(8, 'S0139-18-0002', '103', 60, '2018-02-08 00:00:00'),
(9, 'S0139-18-0002', '104', 90, '2018-02-08 00:00:00'),
(10, 'S0139-18-0003', '101', 56, '2018-02-08 00:00:00'),
(11, 'S0139-18-0003', '102', 45, '2018-02-08 00:00:00'),
(12, 'S0139-18-0003', '103', 59, '2018-02-08 00:00:00'),
(13, 'S0139-18-0004', '101', 87, '2018-02-08 00:00:00'),
(14, 'S0139-18-0004', '102', 78, '2018-02-08 00:00:00'),
(15, 'S0139-18-0004', '103', 89, '2018-02-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `examterm`
--

CREATE TABLE `examterm` (
  `id` int(4) NOT NULL,
  `muhula` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examterm`
--

INSERT INTO `examterm` (`id`, `muhula`) VALUES
(1, 'Muhula wa Kwanza'),
(2, 'Muhula wa Pili');

-- --------------------------------------------------------

--
-- Stand-in structure for view `results`
-- (See below for the actual view)
--
CREATE TABLE `results` (
);

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `id` int(4) NOT NULL,
  `studId` int(4) NOT NULL,
  `marks` int(3) NOT NULL,
  `examYear` int(4) NOT NULL,
  `streamId` int(4) NOT NULL,
  `subjectID` int(4) NOT NULL,
  `march` int(3) DEFAULT NULL,
  `june` int(3) DEFAULT NULL,
  `september` int(3) DEFAULT NULL,
  `december` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`id`, `studId`, `marks`, `examYear`, `streamId`, `subjectID`, `march`, `june`, `september`, `december`) VALUES
(1, 79, 85, 2015, 1, 6, 100, 95, 89, 100),
(2, 80, 98, 2015, 1, 6, 0, 0, 0, 0),
(3, 81, 100, 2015, 1, 6, 0, 0, 0, 0),
(4, 82, 98, 2015, 1, 6, 0, 0, 0, 0),
(5, 83, 85, 2015, 1, 6, 0, 0, 0, 0),
(6, 79, 85, 2015, 1, 2, 78, 0, 0, 0),
(7, 80, 100, 2015, 1, 2, 0, 0, 0, 0),
(8, 81, 100, 2015, 1, 2, 0, 0, 0, 0),
(9, 82, 98, 2015, 1, 2, 0, 0, 0, 0),
(10, 83, 89, 2015, 1, 2, 0, 0, 0, 0),
(11, 89, 6, 2, 25, 1, 22, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `score_in_term`
--

CREATE TABLE `score_in_term` (
  `id` int(4) NOT NULL,
  `termId` int(4) NOT NULL,
  `scoreId` int(4) NOT NULL
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
  `phoneNumber` varchar(10) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `birthDate` int(11) NOT NULL,
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
(3, 2, NULL, 'Yusuf ', 'Hassan', 'Lyawile', '2018-02-23 00:00:00', '0688026390', '1', 31508, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(4, 2, NULL, 'Yaaqub', 'Hassan', 'Lyawile', '2018-02-23 00:00:00', '0688026391', '1', 31509, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(5, 2, NULL, 'Twalib', 'Rashid', 'Amir', '2018-02-23 00:00:00', '0688026392', '1', 31510, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(6, 2, NULL, 'Hassan ', 'Ally ', 'Lyawile', '2018-02-23 00:00:00', '0688026388', '1', 31506, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(7, 2, NULL, 'Khadija', 'Yusuph', 'Saibu', '2018-02-23 00:00:00', '0688026389', '2', 31507, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(8, 2, NULL, 'Yusuf ', 'Hassan', 'Lyawile', '2018-02-23 00:00:00', '0688026390', '1', 31508, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(9, 2, NULL, 'Yaaqub', 'Hassan', 'Lyawile', '2018-02-23 00:00:00', '0688026391', '1', 31509, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(10, 2, NULL, 'Twalib', 'Rashid', 'Amir', '2018-02-23 00:00:00', '0688026392', '1', 31510, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(11, 2, NULL, 'Hassan ', 'Ally ', 'Lyawile', '2018-02-23 00:00:00', '0688026388', '1', 31506, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(12, 2, NULL, 'Khadija', 'Yusuph', 'Saibu', '2018-02-23 00:00:00', '0688026389', '2', 31507, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(13, 2, NULL, 'Yusuf ', 'Hassan', 'Lyawile', '2018-02-23 00:00:00', '0688026390', '1', 31508, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(14, 2, NULL, 'Yaaqub', 'Hassan', 'Lyawile', '2018-02-23 00:00:00', '0688026391', '1', 31509, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(15, 2, NULL, 'Twalib', 'Rashid', 'Amir', '2018-02-23 00:00:00', '0688026392', '1', 31510, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(16, 2, NULL, 'Hassan ', 'Ally ', 'Lyawile', '2018-02-23 00:00:00', '0688026388', '1', 31506, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(17, 2, NULL, 'Khadija', 'Yusuph', 'Saibu', '2018-02-23 00:00:00', '0688026389', '2', 31507, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(18, 2, NULL, 'Yusuf ', 'Hassan', 'Lyawile', '2018-02-23 00:00:00', '0688026390', '1', 31508, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(19, 2, NULL, 'Yaaqub', 'Hassan', 'Lyawile', '2018-02-23 00:00:00', '0688026391', '1', 31509, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(20, 2, NULL, 'Twalib', 'Rashid', 'Amir', '2018-02-23 00:00:00', '0688026392', '1', 31510, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(21, 2, NULL, 'Hassan ', 'Ally ', 'Lyawile', '2018-02-23 00:00:00', '0688026388', '1', 31506, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(22, 2, NULL, 'Khadija', 'Yusuph', 'Saibu', '2018-02-23 00:00:00', '0688026389', '2', 31507, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(23, 2, NULL, 'Yusuf ', 'Hassan', 'Lyawile', '2018-02-23 00:00:00', '0688026390', '1', 31508, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(24, 2, NULL, 'Yaaqub', 'Hassan', 'Lyawile', '2018-02-23 00:00:00', '0688026391', '1', 31509, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(25, 1, NULL, 'Twalib', 'Rashid', 'Amir', '2018-02-23 00:00:00', '0688026392', '1', 31510, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(26, 1, NULL, 'Hassan ', 'Ally ', 'Lyawile', '2018-02-23 00:00:00', '0688026388', '1', 31506, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(27, 1, NULL, 'Khadija', 'Yusuph', 'Saibu', '2018-02-23 00:00:00', '0688026389', '2', 31507, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(28, 2, NULL, 'Yusuf ', 'Hassan', 'Lyawile', '2018-02-23 00:00:00', '0688026390', '1', 31508, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(29, 2, NULL, 'Yaaqub', 'Hassan', 'Lyawile', '2018-02-23 00:00:00', '0688026391', '1', 31509, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(30, 2, NULL, 'Twalib', 'Rashid', 'Amir', '2018-02-23 00:00:00', '0688026392', '1', 31510, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(31, 2, NULL, 'Hassan ', 'Ally ', 'Lyawile', '2018-02-23 00:00:00', '0688026388', '1', 31506, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(32, 2, NULL, 'Khadija', 'Yusuph', 'Saibu', '2018-02-23 00:00:00', '0688026389', '2', 31507, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(33, 2, NULL, 'Yusuf ', 'Hassan', 'Lyawile', '2018-02-23 00:00:00', '0688026390', '1', 31508, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(34, 2, NULL, 'Yaaqub', 'Hassan', 'Lyawile', '2018-02-23 00:00:00', '0688026391', '1', 31509, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(35, 2, NULL, 'Twalib', 'Rashid', 'Amir', '2018-02-23 00:00:00', '0688026392', '1', 31510, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(36, 2, NULL, 'Hassan ', 'Ally ', 'Lyawile', '2018-02-23 00:00:00', '0688026388', '1', 31506, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(37, 2, NULL, 'Khadija', 'Yusuph', 'Saibu', '2018-02-23 00:00:00', '0688026389', '2', 31507, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(38, 2, NULL, 'Yusuf ', 'Hassan', 'Lyawile', '2018-02-23 00:00:00', '0688026390', '1', 31508, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(39, 2, NULL, 'Yaaqub', 'Hassan', 'Lyawile', '2018-02-23 00:00:00', '0688026391', '1', 31509, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA'),
(40, 2, NULL, 'Twalib', 'Rashid', 'Amir', '2018-02-23 00:00:00', '0688026392', '1', 31510, NULL, 1, 'MAJENGO PRIMARY SCHOOL</td>', 2015, '1', 'MTWARA');

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

--
-- Dumping data for table `student_in_stream`
--

INSERT INTO `student_in_stream` (`id`, `studentId`, `streamId`, `yearRegistered`, `timeRegistered`) VALUES
(57, 764, 1, 0, ''),
(58, 765, 1, 0, ''),
(59, 766, 1, 0, ''),
(60, 767, 1, 0, ''),
(61, 768, 1, 0, ''),
(62, 769, 2, 0, ''),
(63, 770, 2, 0, ''),
(64, 771, 2, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `student_takes_subjects`
--

CREATE TABLE `student_takes_subjects` (
  `id` int(4) NOT NULL,
  `studentId` int(4) NOT NULL,
  `subjectId` int(4) NOT NULL,
  `isForAll` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_takes_subjects`
--

INSERT INTO `student_takes_subjects` (`id`, `studentId`, `subjectId`, `isForAll`) VALUES
(135, 79, 6, 1),
(136, 79, 13, 1),
(137, 79, 7, 1),
(138, 79, 2, 1),
(139, 80, 6, 1),
(140, 80, 13, 1),
(141, 80, 7, 1),
(142, 80, 2, 1),
(143, 81, 6, 1),
(144, 81, 13, 1),
(145, 81, 7, 1),
(146, 81, 2, 1),
(147, 82, 6, 1),
(148, 82, 13, 1),
(149, 82, 7, 1),
(150, 82, 2, 1),
(151, 83, 6, 1),
(152, 83, 13, 1),
(153, 83, 7, 1),
(154, 83, 2, 1),
(155, 79, 10, 1),
(156, 80, 10, 1),
(157, 81, 10, 1),
(158, 82, 10, 1),
(159, 83, 10, 1),
(160, 79, 9, 1),
(161, 80, 9, 1),
(162, 81, 9, 1),
(163, 82, 9, 1),
(164, 83, 9, 1),
(165, 79, 5, 0),
(166, 79, 3, 1),
(167, 80, 3, 1),
(168, 81, 3, 1),
(169, 82, 3, 1),
(170, 83, 3, 1),
(171, 81, 8, 0),
(172, 80, 1, 0),
(173, 51, 1, 0),
(174, 51, 2, 0),
(175, 51, 9, 0),
(176, 47, 1, 0),
(177, 47, 2, 0),
(178, 47, 3, 0),
(179, 768, 1, 0),
(180, 768, 2, 0),
(181, 768, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subjectID` int(4) NOT NULL,
  `subjectName` varchar(20) NOT NULL,
  `subjectCode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectID`, `subjectName`, `subjectCode`) VALUES
(1, 'Chemistry', '101'),
(2, 'Physics', '102'),
(3, 'Mathematics', '103'),
(4, 'Civics', '104'),
(5, 'Geography', '105'),
(6, 'Islamic Knowledge', '106'),
(7, 'Quran', '107'),
(8, 'Kiswahili', '108'),
(9, 'English', '109');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacherID` int(4) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacherID`, `firstName`, `middleName`, `surname`) VALUES
(4, 'Yusuf', 'Hassan', 'Lyawile'),
(5, 'Twalib', 'Amir', 'Rashid'),
(6, 'Jumanne', 'Hamis', 'Fundi'),
(7, 'Juma', 'Ally', 'Fakihi'),
(8, 'Hassan', 'Ally', 'dfbd'),
(9, 'xxxxxxxxxxx', 'xxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxx'),
(10, 'Juma', ' v fg f', 'efee'),
(14, 'Hassan', 'sdvsdvs', 'vsdvs'),
(16, 'Jamali', 'Ally', 'Kingo'),
(17, 'Hassan', 'sdvsdvs', 'Fakihi'),
(18, 'Juma', 'sdvsdvs', 'Amir'),
(19, 'Ramadhani', 'Rashid', 'Fakihi'),
(20, 'efsev', 'sdvsdvs', 'Fakihi'),
(21, 'Hassan', 'Allu', 'Lyawile'),
(22, 'Hassan', 'Allu', 'Fakihi'),
(23, 'Hassan', 'sdvsdvs', 'dfbd'),
(30, 'Juma', 'sdvsdvs', 'vsdvs'),
(31, 'Hassan', 'Allu', 'Fakihi'),
(32, 'bf bfg', 'Allu', 'Fakihi'),
(33, 'ghmjgh', 'Allu', 'Fakihi'),
(34, 'Juma', 'Allu', 'Fakihi'),
(35, 'Zainab', 'Ally', 'Lyawile'),
(36, 'Saidi', 'Selemani', 'Likongo'),
(37, 'Hassan', 'Ally', 'Lyawile'),
(38, 'Dadi', 'Makororo', 'Makororo'),
(39, 'Hassan', 'sdvsdvs', 'vsdvs'),
(40, 'bf bfg', 'sdvsdvs', 'dfbd'),
(41, 'efsevs', 'vvsvsvsv', 'vsvsvsv'),
(42, 'Hassan', 'Allu', 'efee'),
(43, '', '', ''),
(44, '', '', ''),
(45, '', '', ''),
(46, 'Hassan', 'Lyawile', 'Ally'),
(47, 'Bahati', 'Amir', 'Rashid'),
(48, 'Juma', 'Ally', 'dfbd');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_has_class`
--

CREATE TABLE `teacher_has_class` (
  `teachID` int(4) NOT NULL,
  `classID` int(4) NOT NULL,
  `teacherID` int(4) NOT NULL,
  `subID` int(4) NOT NULL,
  `no_classes_per_week` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_has_class`
--

INSERT INTO `teacher_has_class` (`teachID`, `classID`, `teacherID`, `subID`, `no_classes_per_week`) VALUES
(1, 1, 1, 1, 4),
(2, 3, 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `testing`
--

CREATE TABLE `testing` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testing`
--

INSERT INTO `testing` (`id`, `name`, `salary`) VALUES
(1, 'Hassan', 150),
(2, 'Juma', 100),
(3, 'Shakila', 121),
(4, 'Bahati', 120);

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `timeID` int(4) NOT NULL,
  `time` date NOT NULL,
  `subjectID` int(4) NOT NULL,
  `streamID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`timeID`, `time`, `subjectID`, `streamID`) VALUES
(1, '0000-00-00', 1, 1),
(2, '2015-08-06', 2, 1);

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
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `firstName`, `middleName`, `Surname`, `password`, `username`) VALUES
(1, 'Hassan', 'Ally', 'Lyawile', '0404', 'hlyawile');

-- --------------------------------------------------------

--
-- Structure for view `results`
--
DROP TABLE IF EXISTS `results`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `results`  AS  select `score`.`studId` AS `studId`,sum(`score`.`marks`) AS `total` from `score` group by `score`.`studId` order by `total` desc ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cand_result`
--
ALTER TABLE `cand_result`
  ADD PRIMARY KEY (`studentId`);

--
-- Indexes for table `examterm`
--
ALTER TABLE `examterm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `score_in_term`
--
ALTER TABLE `score_in_term`
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
-- Indexes for table `student_in_stream`
--
ALTER TABLE `student_in_stream`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_takes_subjects`
--
ALTER TABLE `student_takes_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subjectID`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacherID`);

--
-- Indexes for table `teacher_has_class`
--
ALTER TABLE `teacher_has_class`
  ADD PRIMARY KEY (`teachID`);

--
-- Indexes for table `testing`
--
ALTER TABLE `testing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`timeID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cand_result`
--
ALTER TABLE `cand_result`
  MODIFY `studentId` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `examterm`
--
ALTER TABLE `examterm`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `score_in_term`
--
ALTER TABLE `score_in_term`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stream`
--
ALTER TABLE `stream`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `student_in_stream`
--
ALTER TABLE `student_in_stream`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `student_takes_subjects`
--
ALTER TABLE `student_takes_subjects`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subjectID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacherID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `teacher_has_class`
--
ALTER TABLE `teacher_has_class`
  MODIFY `teachID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `testing`
--
ALTER TABLE `testing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `timeID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
