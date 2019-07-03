-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2019 at 09:08 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `etmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `regdate`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '2019-06-30 04:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `empgroup`
--

CREATE TABLE `empgroup` (
  `no` int(11) NOT NULL,
  `empId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `empId` int(11) NOT NULL,
  `empName` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `empGender` enum('Male','Female') COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `empPosition` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `empEmail` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `empPassword` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`empId`, `empName`, `empGender`, `empPosition`, `empEmail`, `empPassword`, `regDate`) VALUES
(1, 'Nguyễn Trung ', 'Male', 'TGD', 'trungnguyen@gmail.com', 'test123', '2019-06-29 10:55:49'),
(2, 'test', 'Male', 'BGD', 'test@gmail.com', 'test', '2019-06-30 04:12:56'),
(3, 'Đoàn Quang Minh', 'Male', 'NV_CM', 'minhdoan@gmail.com', 'test123', '2019-06-29 10:54:34'),
(4, 'Nguyễn Hà', 'Female', 'PGD', 'hanguyen@gmail.com', 'test', '2019-07-03 08:09:39'),
(12, 'Nguyễn Ngọc Hải', 'Male', 'TP_CM', 'hainguyen@gmail.com', 'test123', '2019-06-29 10:56:01'),
(13, 'Lê Viết Việt Linh', 'Male', 'NV_KT', 'linhle@gmail.com', 'test', '2019-06-29 11:19:58'),
(14, 'test2', 'Female', 'NV_KT', 'test2@gmail.com', 'test', '2019-06-30 03:30:26'),
(15, 'test3', 'Male', 'NV_KT', 'test3@gmail.com', 'test', '2019-06-30 03:30:50'),
(16, 'test4', 'Female', 'NV_CM', 'test4@gmail.com', 'test', '2019-06-30 03:31:13'),
(17, 'test5', 'Male', 'NV_NS', 'test5@gmail.com', 'test', '2019-06-30 03:31:42'),
(18, 'test6', 'Female', 'NV_NS', 'test6@gmail.com', 'test', '2019-06-30 03:32:06'),
(19, 'test7', 'Male', 'NV_KToan', 'test7@gmail.com', 'test', '2019-06-30 03:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `emptask`
--

CREATE TABLE `emptask` (
  `no` int(11) NOT NULL,
  `empId` int(11) NOT NULL,
  `taskId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `emptask`
--

INSERT INTO `emptask` (`no`, `empId`, `taskId`) VALUES
(1, 2, 4),
(2, 1, 4),
(3, 2, 2),
(4, 2, 6),
(7, 2, 9),
(8, 2, 10),
(9, 0, 4),
(12, 0, 4),
(15, 0, 4),
(16, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `groupId` int(11) NOT NULL,
  `groupName` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupId`, `groupName`) VALUES
(1, 'Nghiên cứu giải pháp do sth');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `pos` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `posDetail` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`pos`, `posDetail`) VALUES
('TGD', 'Tổng Giám Đốc'),
('PGD', 'Phó Giám Đốc'),
('TP_CM', 'Trưởng phòng Chuyên môn'),
('NV_CM', 'Nhân viên phòng Chuyên môn'),
('TP_KT', 'Trưởng phòng Khảo thí'),
('NV_KT', 'Nhân viên phòng Khảo thí'),
('TP_KToan', 'Trưởng phòng Kế toán'),
('NV_KToan', 'Nhân viên phòng Kế toán'),
('TP_NS', 'Trưởng phòng Nhân sự'),
('NV_NS', 'Nhân viên phòng Nhân sự');

-- --------------------------------------------------------

--
-- Table structure for table `smalltasks`
--

CREATE TABLE `smalltasks` (
  `smTaskId` int(11) NOT NULL,
  `smTaskTitle` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `smTaskContent` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `smalltasks`
--

INSERT INTO `smalltasks` (`smTaskId`, `smTaskTitle`, `smTaskContent`, `status`) VALUES
(1, 'do sth 1', 'main content 1', 1),
(2, 'check sth 2', 'main content 2', 2),
(3, 'this is weird 3', 'content 3 is main', 1),
(4, 'aecefa', 'asdcce', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tasklink`
--

CREATE TABLE `tasklink` (
  `no` int(11) NOT NULL,
  `tasksId` int(11) NOT NULL,
  `smTaskId` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `tasklink`
--

INSERT INTO `tasklink` (`no`, `tasksId`, `smTaskId`, `status`) VALUES
(1, 4, 1, 1),
(2, 4, 2, 2),
(3, 4, 3, 1),
(4, 4, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `taskId` int(11) NOT NULL,
  `taskCreator` int(11) NOT NULL,
  `taskTitle` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `taskContent` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `taskStartTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `taskFinishTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `taskTotal` int(11) NOT NULL,
  `taskComplete` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`taskId`, `taskCreator`, `taskTitle`, `taskContent`, `taskStartTime`, `taskFinishTime`, `taskTotal`, `taskComplete`) VALUES
(1, 1, 'Nghiên cứu sth', 'do sth', '2019-07-03 06:25:43', '2019-07-09 17:00:00', 0, 0),
(2, 2, 'Nghiên cứu 1', 'Nghiên cứu 1', '2019-07-03 06:25:48', '2019-05-05 19:00:00', 0, 0),
(3, 1, 'Nghiên cứu 2', 'real sth here asdf', '2019-07-03 06:25:52', '2019-02-07 04:02:00', 0, 0),
(4, 2, 'Nghiên cứu 3', 'sth sth sth', '2019-07-03 07:49:09', '2019-03-08 19:00:00', 4, 1),
(5, 3, 'test test', 'asafececs', '2019-07-03 08:28:10', '2019-08-21 17:00:00', 0, 0),
(6, 2, 'fascaece', 'xdtaerfafaew', '2019-07-03 07:51:59', '2019-07-30 17:00:00', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empgroup`
--
ALTER TABLE `empgroup`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`empId`);

--
-- Indexes for table `emptask`
--
ALTER TABLE `emptask`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `smalltasks`
--
ALTER TABLE `smalltasks`
  ADD PRIMARY KEY (`smTaskId`);

--
-- Indexes for table `tasklink`
--
ALTER TABLE `tasklink`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`taskId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `empgroup`
--
ALTER TABLE `empgroup`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `empId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `emptask`
--
ALTER TABLE `emptask`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smalltasks`
--
ALTER TABLE `smalltasks`
  MODIFY `smTaskId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tasklink`
--
ALTER TABLE `tasklink`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `taskId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
