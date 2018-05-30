-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2018 at 07:22 PM
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
-- Table structure for table `cand_result`
--

CREATE TABLE `cand_result` (
  `studentId` int(13) NOT NULL,
  `candidateNumber` varchar(13) NOT NULL,
  `subjectCode` varchar(4) NOT NULL,
  `score` int(11) NOT NULL,
  `dateInserted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
`studId` int(4)
,`total` decimal(32,0)
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
(78, 3, NULL, 'Mwajuma', 'Hamis', 'Amiri', '2018-05-30 16:22:54', '0688026388', 1, '1998-05-13', '', 0, 'Bereko Primary School', 2003, 'Swahili', 'Mtwara Municipality');

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
(67, 74, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2018-05-30 10:57:08'),
(68, 75, 0, 1, 0, 1, 1, 0, 1, 1, 1, '2018-05-30 17:05:43'),
(69, 78, 0, 0, 1, 1, 1, 1, 1, 1, 1, '2018-05-30 17:10:14');

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
-- Table structure for table `student_takes_subjects`
--

CREATE TABLE `student_takes_subjects` (
  `id` int(4) NOT NULL,
  `studentId` int(4) NOT NULL,
  `subjectId` int(4) NOT NULL,
  `takes_this_subject` tinyint(4) NOT NULL COMMENT '1=yes, 0=no',
  `dateInserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
-- Indexes for table `student_takes_subjects`
--
ALTER TABLE `student_takes_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `studentId` int(13) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `students_masomo`
--
ALTER TABLE `students_masomo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
