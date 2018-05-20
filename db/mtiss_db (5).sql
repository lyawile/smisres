-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2018 at 10:14 PM
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
(44, 4, NULL, 'SAIDI', 'SEIF', 'NGONGO', '2018-05-13 00:00:00', '0652445145', 1, '1986-04-04', 'PS0706001-001-_AMANI_NYARI_CHAUKA.JPG', 1, 'LIKONDE PRIMARY SCHOOL', 2001, 'English', 'MTWARA'),
(45, 4, NULL, 'SALMA', 'SEIF', 'NGONGO', '2018-05-13 00:00:00', '0652445145', 2, '1986-04-04', NULL, 1, 'LIKONDE PRIMARY SCHOOL', 2001, '1', 'MTWARA'),
(47, 1, NULL, 'Selemani', 'Ally', 'Juma', '2018-05-17 14:13:26', '0658121245', 1, '2018-05-16', '', 0, 'Tandika', 2019, 'Swahili', 'Mtwara'),
(48, 0, NULL, 'Rashid', 'Ramadhani', 'Duru', '2018-05-17 17:27:55', '0652454541', 1, '2002-02-05', '', 0, 'Bereko Primary School', 2019, 'English', 'Kondoa'),
(49, 1, NULL, 'Bahati', 'Rashid', 'Amiri', '2018-05-17 17:35:57', '0654845412', 2, '1995-01-10', '', 0, 'Ligula Primary School', 2007, 'Swahili', 'Mtwara Municipality'),
(50, 3, NULL, 'Mwajuma', 'Hamis', 'Hamis', '2018-05-20 03:10:42', '0685121245', 2, '1990-06-12', '', 0, 'Ligula Primary School', 2003, 'Swahili', 'Mtwara'),
(51, 3, NULL, 'Mwajuma', 'Hamis', 'Hamis', '2018-05-20 03:10:42', '0685121245', 2, '1990-06-12', '', 0, 'Ligula Primary School', 2003, 'Swahili', 'Mtwara'),
(52, 1, NULL, 'Fadhili', 'Rashid', 'Rashid', '2018-05-20 10:33:33', '0688026388', 1, '1993-07-14', '', 0, 'Uyui Primary School', 2006, 'Swahili', 'Urambo, Tabora'),
(53, 1, NULL, 'Fadhili', 'Rashid', 'Rashid', '2018-05-20 10:33:33', '0688026388', 1, '1993-07-14', '', 0, 'Uyui Primary School', 2006, 'Swahili', 'Urambo, Tabora'),
(54, 1, NULL, 'Fadhili', 'Rashid', 'Rashid', '2018-05-20 10:33:33', '0688026388', 1, '1993-07-14', '', 0, 'Uyui Primary School', 2006, 'Swahili', 'Urambo, Tabora'),
(55, 1, NULL, 'Fadhili', 'Rashid', 'Rashid', '2018-05-20 10:33:33', '0688026388', 1, '1993-07-14', '', 0, 'Uyui Primary School', 2006, 'Swahili', 'Urambo, Tabora'),
(56, 1, NULL, 'Fadhili', 'Rashid', 'Rashid', '2018-05-20 10:33:33', '0688026388', 1, '1993-07-14', '', 0, 'Uyui Primary School', 2006, 'Swahili', 'Urambo, Tabora'),
(57, 1, NULL, 'Fadhili', 'Rashid', 'Rashid', '2018-05-20 10:33:33', '0688026388', 1, '1993-07-14', '', 0, 'Uyui Primary School', 2006, 'Swahili', 'Urambo, Tabora'),
(58, 1, NULL, 'Fadhili', 'Rashid', 'Rashid', '2018-05-20 10:33:33', '0688026388', 1, '1993-07-14', '', 0, 'Uyui Primary School', 2006, 'Swahili', 'Urambo, Tabora'),
(59, 1, NULL, 'Fadhili', 'Rashid', 'Rashid', '2018-05-20 10:33:33', '0688026388', 1, '1993-07-14', '', 0, 'Uyui Primary School', 2006, 'Swahili', 'Urambo, Tabora'),
(60, 1, NULL, 'Fadhili', 'Rashid', 'Rashid', '2018-05-20 10:33:33', '0688026388', 1, '1993-07-14', '', 0, 'Uyui Primary School', 2006, 'Swahili', 'Urambo, Tabora'),
(61, 1, NULL, 'Fadhili', 'Rashid', 'Rashid', '2018-05-20 10:33:33', '0688026388', 1, '1993-07-14', '', 0, 'Uyui Primary School', 2006, 'Swahili', 'Urambo, Tabora'),
(62, 1, NULL, 'Fadhili', 'Rashid', 'Rashid', '2018-05-20 10:33:33', '0688026388', 1, '1993-07-14', '', 0, 'Uyui Primary School', 2006, 'Swahili', 'Urambo, Tabora'),
(63, 1, NULL, 'Fadhili', 'Rashid', 'Rashid', '2018-05-20 10:33:33', '0688026388', 1, '1993-07-14', '', 0, 'Uyui Primary School', 2006, 'Swahili', 'Urambo, Tabora'),
(64, 1, NULL, 'Fadhili', 'Rashid', 'Rashid', '2018-05-20 10:33:33', '0688026388', 1, '1993-07-14', '', 0, 'Uyui Primary School', 2006, 'Swahili', 'Urambo, Tabora'),
(65, 1, NULL, 'Fadhili', 'Rashid', 'Rashid', '2018-05-20 10:33:33', '0688026388', 1, '1993-07-14', '', 0, 'Uyui Primary School', 2006, 'Swahili', 'Urambo, Tabora');

-- --------------------------------------------------------

--
-- Table structure for table `students_masomo`
--

CREATE TABLE `students_masomo` (
  `id` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `subject1` int(1) DEFAULT NULL,
  `subject2` int(1) DEFAULT NULL,
  `subject3` int(1) DEFAULT NULL,
  `subject4` int(1) DEFAULT NULL,
  `subject5` int(1) DEFAULT NULL,
  `subject6` int(1) DEFAULT NULL,
  `subject7` int(1) DEFAULT NULL,
  `subject8` int(1) DEFAULT NULL,
  `subject9` int(1) DEFAULT NULL,
  `dateInserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students_masomo`
--

INSERT INTO `students_masomo` (`id`, `studentId`, `subject1`, `subject2`, `subject3`, `subject4`, `subject5`, `subject6`, `subject7`, `subject8`, `subject9`, `dateInserted`) VALUES
(58, 64, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2018-05-20 07:55:25'),
(59, 65, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2018-05-20 07:56:13');

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

--
-- Dumping data for table `student_takes_subjects`
--

INSERT INTO `student_takes_subjects` (`id`, `studentId`, `subjectId`, `takes_this_subject`, `dateInserted`) VALUES
(242, 44, 1, 1, '2018-05-20 00:18:59'),
(243, 44, 2, 1, '2018-05-20 00:18:59'),
(244, 44, 3, 1, '2018-05-20 00:18:59'),
(245, 44, 4, 1, '2018-05-20 00:18:59'),
(246, 44, 5, 1, '2018-05-20 00:18:59'),
(247, 44, 6, 1, '2018-05-20 00:18:59'),
(248, 44, 7, 1, '2018-05-20 00:18:59'),
(249, 44, 8, 1, '2018-05-20 00:18:59'),
(250, 44, 9, 1, '2018-05-20 00:18:59'),
(257, 44, 1, 1, '2018-05-20 00:18:59'),
(258, 44, 2, 1, '2018-05-20 00:18:59'),
(259, 44, 3, 1, '2018-05-20 00:18:59'),
(260, 44, 4, 1, '2018-05-20 00:18:59'),
(261, 44, 5, 1, '2018-05-20 00:18:59'),
(262, 44, 6, 1, '2018-05-20 00:18:59'),
(263, 44, 7, 1, '2018-05-20 00:18:59'),
(264, 44, 8, 1, '2018-05-20 00:18:59'),
(265, 44, 9, 1, '2018-05-20 00:18:59'),
(272, 47, 1, 1, '2018-05-20 00:18:59'),
(273, 47, 2, 1, '2018-05-20 00:18:59'),
(274, 47, 3, 1, '2018-05-20 00:18:59'),
(275, 47, 4, 1, '2018-05-20 00:18:59'),
(276, 47, 5, 1, '2018-05-20 00:18:59'),
(277, 47, 6, 1, '2018-05-20 00:18:59'),
(278, 47, 7, 1, '2018-05-20 00:18:59'),
(279, 47, 8, 1, '2018-05-20 00:18:59'),
(280, 47, 9, 1, '2018-05-20 00:18:59'),
(287, 48, 1, 1, '2018-05-20 00:18:59'),
(288, 48, 2, 1, '2018-05-20 00:18:59'),
(289, 48, 3, 1, '2018-05-20 00:18:59'),
(290, 48, 4, 1, '2018-05-20 00:18:59'),
(291, 48, 5, 1, '2018-05-20 00:18:59'),
(292, 48, 6, 1, '2018-05-20 00:18:59'),
(293, 48, 7, 1, '2018-05-20 00:18:59'),
(294, 48, 8, 1, '2018-05-20 00:18:59'),
(295, 48, 9, 1, '2018-05-20 00:18:59'),
(302, 49, 1, 1, '2018-05-20 00:18:59'),
(303, 49, 2, 1, '2018-05-20 00:18:59'),
(304, 49, 3, 1, '2018-05-20 00:18:59'),
(305, 49, 4, 1, '2018-05-20 00:18:59'),
(306, 49, 5, 1, '2018-05-20 00:18:59'),
(307, 49, 6, 1, '2018-05-20 00:18:59'),
(308, 49, 7, 1, '2018-05-20 00:18:59'),
(309, 49, 8, 1, '2018-05-20 00:18:59'),
(310, 49, 9, 1, '2018-05-20 00:18:59'),
(317, 50, 1, 1, '2018-05-20 00:12:04'),
(318, 50, 2, 1, '2018-05-20 00:12:04'),
(319, 50, 3, 1, '2018-05-20 00:12:04'),
(320, 50, 4, 1, '2018-05-20 00:12:04'),
(321, 50, 5, 1, '2018-05-20 00:12:04'),
(322, 50, 6, 1, '2018-05-20 00:12:04'),
(323, 50, 7, 1, '2018-05-20 00:12:04'),
(324, 50, 8, 1, '2018-05-20 00:12:04'),
(325, 50, 9, 1, '2018-05-20 00:12:04');

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
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `students_masomo`
--
ALTER TABLE `students_masomo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `student_in_stream`
--
ALTER TABLE `student_in_stream`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `student_takes_subjects`
--
ALTER TABLE `student_takes_subjects`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
