-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 01, 2021 at 11:12 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apps_ui`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL DEFAULT 'Admin',
  `role` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `name`, `role`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admitted_students`
--

CREATE TABLE `admitted_students` (
  `id` int(11) NOT NULL,
  `form_no` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(120) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `status` int(11) NOT NULL,
  `matric` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course_pool`
--

CREATE TABLE `course_pool` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `title` varchar(200) NOT NULL,
  `level` varchar(50) NOT NULL,
  `semester` varchar(25) NOT NULL,
  `unit` int(11) NOT NULL,
  `faculty` varchar(100) DEFAULT NULL,
  `department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_pool`
--

INSERT INTO `course_pool` (`id`, `code`, `title`, `level`, `semester`, `unit`, `faculty`, `department`) VALUES
(1, 'COM 101', 'Introduction to computing', 'ND 1', 'First', 5, '', '1'),
(2, 'CSC 103', 'Electronics', 'ND 1', 'First', 4, '', '1'),
(3, 'CSC 104', 'Introduction to Mechanics ', 'ND 1', 'First', 4, '', '1'),
(4, 'CSC 105', 'Introduction to computing', 'ND 1', 'First', 3, '', '1'),
(5, 'CSC 221', 'Introsuction to System Program', 'ND 2', 'First', 3, '', '1'),
(6, 'CSC 202', 'Comparative Programming', 'ND 2 PT', 'First', 4, '', '1'),
(7, 'COM 125', 'System Programming', 'ND 2 PT', 'First', 3, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `course_reg`
--

CREATE TABLE `course_reg` (
  `matric` varchar(25) NOT NULL,
  `session` varchar(25) NOT NULL,
  `semester` varchar(25) NOT NULL,
  `course` int(11) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_reg`
--

INSERT INTO `course_reg` (`matric`, `session`, `semester`, `course`, `level`) VALUES
('CS20180201803', '2020/2021', 'First', 6, 'ND 2 PT'),
('CS20180201803', '2020/2021', 'First', 7, 'ND 2 PT');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `faculty` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `faculty`) VALUES
(1, 'Computer Science', 'Applied Science');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `date_added` varchar(45) NOT NULL,
  `info` text NOT NULL,
  `event_date` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `olevel`
--

CREATE TABLE `olevel` (
  `id` int(11) NOT NULL,
  `matric` varchar(45) NOT NULL,
  `exam_type` varchar(50) NOT NULL,
  `exam_date` varchar(45) NOT NULL,
  `subjects` text NOT NULL,
  `grades` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `matric` varchar(45) NOT NULL,
  `session` varchar(45) NOT NULL,
  `payment_type` varchar(45) NOT NULL,
  `amount` varchar(15) NOT NULL,
  `date_added` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `matric`, `session`, `payment_type`, `amount`, `date_added`) VALUES
(1, 'CS20180201803', '2020/2021', 'School Fees', '30000', '1630486685');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `matric` varchar(25) NOT NULL,
  `course_id` int(11) NOT NULL,
  `session` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `value` text NOT NULL,
  `info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `info`) VALUES
(1, 'semester', 'First', 'Current Semester'),
(2, 'session', '2020/2021', 'Current Session'),
(3, 'nd_1_ft_school_fees', '48900', 'ND 1 FT School Fees'),
(4, 'nd_1_dpt_school_fees', '39800', 'ND 1 DPT School Fees'),
(5, 'nd_1_pt_school_fees', '29800', 'ND 1 PT School Fees'),
(6, 'nd_2_ft_school_fees', '19800', 'ND 2 FT School Fees'),
(7, 'nd_2_dpt_school_fees', '19800', 'ND 2 DPT School Fees'),
(9, 'nd_2_pt_school_fees', '30000', 'ND 2 PT School Fees'),
(10, 'nd_3_pt_school_fees', '40000', 'PT YR 3 School Fees'),
(11, 'hnd_1_ft_school_fees', '13000', 'HND 1 FT School Fees'),
(12, 'hnd_1_dpt_school_fees', '14000', 'HND 1 DPT School Fees'),
(13, 'hnd_2_ft_school_fees', '18000', 'HND 2 FT School Fees'),
(14, 'hnd_2_dpt_school_fees', '24000', 'HND 2 DPT School Fees'),
(15, 'biodata_update', 'Yes', 'Enable Biodata Update (Yes or No)');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `matric` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `name` varchar(200) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `date_reg` varchar(25) NOT NULL,
  `matric_year` varchar(4) NOT NULL,
  `faculty` varchar(200) NOT NULL,
  `department` varchar(200) NOT NULL,
  `program` varchar(100) NOT NULL DEFAULT 'Undergraduate',
  `admission` varchar(10) NOT NULL,
  `level` varchar(15) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `guardian_name` varchar(150) DEFAULT NULL,
  `guardian_address` varchar(200) DEFAULT NULL,
  `kin_name` varchar(100) DEFAULT NULL,
  `kin_address` varchar(200) DEFAULT NULL,
  `kin_phone` varchar(15) DEFAULT NULL,
  `guardian_phone` varchar(15) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `passport` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `matric`, `password`, `name`, `gender`, `phone`, `email`, `date_reg`, `matric_year`, `faculty`, `department`, `program`, `admission`, `level`, `address`, `guardian_name`, `guardian_address`, `kin_name`, `kin_address`, `kin_phone`, `guardian_phone`, `status`, `passport`) VALUES
(1, 'CS20180200275', 'CS20180200275', 'Aiyeola oluwasegun Taiwo', 'Male', NULL, '', '1630486330', '2018', 'Applied Sciences', 'Computer Science', 'Undergraduate', 'UTME', 'ND 1 FT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(2, 'CS20180203017', 'CS20180203017', 'Zubairu sheriff Akorede', 'Male', NULL, '', '1630486330', '2018', 'Applied Sciences', 'Computer Science', 'Undergraduate', 'UTME', 'ND 1 DPT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(3, 'CS20180201803', 'CS20180201803', 'Adebayo Toheeb Adeniyi', 'Male', '0801234040495', 'CS20180201803@fpe.com', '1630486330', '2018', 'Applied Sciences', 'Computer Science', 'Undergraduate', 'UTME', 'ND 2 PT', 'The Federal Polytechnic, Ede, Osun State', 'Adebayo Toheeb', 'Ede, Osun State', 'Toheeb Adeoye', 'Ede, Osun State', '08038494038', '080898933938', 1, '612f4102c6c43regcs20180201803.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admitted_students`
--
ALTER TABLE `admitted_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_pool`
--
ALTER TABLE `course_pool`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `olevel`
--
ALTER TABLE `olevel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admitted_students`
--
ALTER TABLE `admitted_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_pool`
--
ALTER TABLE `course_pool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `olevel`
--
ALTER TABLE `olevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
