-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2023 at 11:51 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admininfo`
--

CREATE TABLE `admininfo` (
  `id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admininfo`
--

INSERT INTO `admininfo` (`id`, `fname`, `lname`, `email`, `phone`, `username`, `password`) VALUES
(5, 'Suhail', 'Akrami', 'admin@admin.com', '9766409354', 'admin', '0e7517141fb53f21ee439b355b5a1d0a');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `st_id` int(20) NOT NULL,
  `sub_id` int(20) NOT NULL,
  `tc_id` int(11) NOT NULL,
  `st_status` varchar(10) NOT NULL,
  `stat_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `st_id`, `sub_id`, `tc_id`, `st_status`, `stat_date`) VALUES
(7, 226229, 5, 2, '0', '2022-12-22');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `st_id` int(20) NOT NULL,
  `st_name` varchar(20) NOT NULL,
  `st_lname` varchar(20) NOT NULL,
  `st_dept` varchar(20) NOT NULL,
  `st_sem` int(11) NOT NULL,
  `st_email` varchar(30) NOT NULL,
  `st_phone` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `st_id`, `st_name`, `st_lname`, `st_dept`, `st_sem`, `st_email`, `st_phone`, `username`, `password`) VALUES
(2, 226229, 'Zakiullah', 'Nawab', 'CS', 1, 'zaki@zaki.com', '1234567891', 'zaki', '6026eab13daf0bf4d5bae9e21ce93887');

-- --------------------------------------------------------

--
-- Table structure for table `st_sub`
--

CREATE TABLE `st_sub` (
  `st_id` int(20) NOT NULL,
  `sub_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `st_sub`
--

INSERT INTO `st_sub` (`st_id`, `sub_id`) VALUES
(226211, 5);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_id` int(30) NOT NULL,
  `subject_name` varchar(20) NOT NULL,
  `tc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_id`, `subject_name`, `tc_id`) VALUES
(1, 'DMDW', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `tc_id` int(20) NOT NULL,
  `tc_name` varchar(20) NOT NULL,
  `tc_lname` varchar(30) NOT NULL,
  `tc_dept` varchar(20) NOT NULL,
  `tc_email` varchar(30) NOT NULL,
  `tc_phone` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`tc_id`, `tc_name`, `tc_lname`, `tc_dept`, `tc_email`, `tc_phone`, `username`, `password`) VALUES
(1, 'Aparna', 'Vadyanathan', 'CS', 'ap@ap.com', '1234567894', 'ap', 'Apar@123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admininfo`
--
ALTER TABLE `admininfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stat_id` (`st_id`),
  ADD KEY `frkey-att-sub_id` (`sub_id`),
  ADD KEY `frkey-att-tc_id` (`tc_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `st_id` (`st_id`) USING BTREE;

--
-- Indexes for table `st_sub`
--
ALTER TABLE `st_sub`
  ADD KEY `st-fr` (`st_id`),
  ADD KEY `sub-fr` (`sub_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `frkey` (`tc_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`tc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admininfo`
--
ALTER TABLE `admininfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sub_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `tc_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendace_ibfk_1` FOREIGN KEY (`st_id`) REFERENCES `students` (`st_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frkey-att-sub_id` FOREIGN KEY (`sub_id`) REFERENCES `subject` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frkey-att-tc_id` FOREIGN KEY (`tc_id`) REFERENCES `teachers` (`tc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `st_sub`
--
ALTER TABLE `st_sub`
  ADD CONSTRAINT `st-fr` FOREIGN KEY (`st_id`) REFERENCES `students` (`st_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sub-fr` FOREIGN KEY (`sub_id`) REFERENCES `subject` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `frkey` FOREIGN KEY (`tc_id`) REFERENCES `teachers` (`tc_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
