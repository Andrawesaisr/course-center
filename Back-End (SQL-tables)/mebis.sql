-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2020 at 10:04 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";





--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_name` varchar(255) NOT NULL,
  `course_type` varchar(255) NOT NULL,
  `lecturer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- inserting data for table `course`
--

-- INSERT INTO `course` (`course_name`, `course_type`, `lecturer` ) VALUES


-- --------------------------------------------------------


--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `lecturer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `lecturer_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- inserting data for table `lecturer`
--

-- INSERT INTO `lecturer` (`lecturer_name`, `email`,`password`, `degree`, `course_name`, `lecturer_id`) VALUES
-- ('mostafa elgendy', 'mostafa.elegendy', '12345', 'DR.', 'web developin', 2),

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

-- INSERT INTO `student` (`student_id`, `name`, `department`, `email`) VALUES
-- (64160023, 'andrew', 'Computer Science & Engineering', 'andrew@bfcai.edu.eg');

-- --------------------------------------------------------

--
-- Table structure for table `student_current_course`
--

CREATE TABLE `student_current_course` (
  `course_name` varchar(255) NOT NULL,
  `student_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- inserting data for table `student_current_course`
--

-- INSERT INTO `student_current_course` (`course_name`, `student_id`) VALUES
-- ('network', 64160002),
-- ('Database', 64160001);

-- --------------------------------------------------------

--
-- Table structure for table `student_past_courses`
--

CREATE TABLE `student_past_courses` (
  `student_id` int(255) NOT NULL,
  `course_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- inserting data for table `student_past_courses`
--

-- INSERT INTO `student_past_courses` (`student_id`, `course_name`) VALUES
-- (64160023, 'web developing');

-- --------------------------------------------------------


--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_name`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);




