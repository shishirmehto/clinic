-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2018 at 02:25 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `password` varchar(34) NOT NULL,
  `email` varchar(150) NOT NULL,
  `gender` char(7) NOT NULL,
  `image` varchar(200) DEFAULT 'users.png',
  `status` int(1) NOT NULL DEFAULT '1',
  `resetcode` varchar(34) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `name`, `password`, `email`, `gender`, `image`, `status`, `resetcode`) VALUES
(2, 'test', 'e10adc3949ba59abbe56e057f20f883e', 'infinito.technology@gmail.com', 'male', 'e945048d30747b8fafdad46a0667c735.png', 1, ''),
(3, 'adyant', 'e10adc3949ba59abbe56e057f20f883e', 'admin@gmail.com', 'male', 'users.png', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctorid` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `password` varchar(34) NOT NULL,
  `email` varchar(150) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `resetcode` varchar(34) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctorid`, `name`, `password`, `email`, `status`, `resetcode`) VALUES
(1, 'doc', '0bad310aa8c9cea83b4a681986a5e568', 'doctor@gmail.com', 1, ''),
(2, 'John Doctor', '0bad310aa8c9cea83b4a681986a5e568', 'doctor2@gmail.com', 1, ''),
(3, 'Pooja', '0bad310aa8c9cea83b4a681986a5e568', 'pooja@gmail.com', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_information`
--

CREATE TABLE `doctor_information` (
  `student_id` int(3) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `date_of_birth` date NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(40) NOT NULL DEFAULT 'mydoctor.png',
  `last_login_date` datetime NOT NULL,
  `registration_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_information`
--

INSERT INTO `doctor_information` (`student_id`, `gender`, `date_of_birth`, `contact_no`, `address`, `description`, `image`, `last_login_date`, `registration_date`) VALUES
(1, 'male', '0000-00-00', '', '', '', '7dd77adcfef2e786dff52e25ce2f5144.jpg', '2018-03-30 10:22:04', '2018-03-30'),
(2, 'male', '0000-00-00', '', '', '', 'mydoctor.png', '2018-03-30 10:07:39', '2018-03-30'),
(3, 'female', '0000-00-00', '', '', '', 'mydoctor.png', '2018-03-30 10:21:53', '2018-03-30');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patientid` int(3) NOT NULL,
  `userid` int(3) NOT NULL,
  `doctorid` int(11) NOT NULL,
  `symptoms` varchar(200) NOT NULL,
  `medicine` text NOT NULL,
  `date` datetime NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patientid`, `userid`, `doctorid`, `symptoms`, `medicine`, `date`, `amount`) VALUES
(1, 1, 1, 'nothing3', 'med1,med2,med3', '2018-03-30 10:18:22', 150),
(2, 1, 1, 'Nothing3', 'Med1,med2,med3,med4', '2018-03-30 10:19:06', 150);

-- --------------------------------------------------------

--
-- Table structure for table `patient_information`
--

CREATE TABLE `patient_information` (
  `student_id` int(3) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `date_of_birth` date NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(40) NOT NULL DEFAULT 'myuser.png',
  `last_login_date` datetime NOT NULL,
  `registration_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `patient_information`
--

INSERT INTO `patient_information` (`student_id`, `gender`, `date_of_birth`, `contact_no`, `address`, `description`, `image`, `last_login_date`, `registration_date`) VALUES
(1, 'male', '1996-12-25', '9131092430', 'H. No. 81, Bhawani Campus, Phase - 2,\nNarela Sankiri', 'this is desc', 'myuser.png', '2018-03-31 08:49:15', '2018-03-30'),
(2, 'male', '1996-12-26', '9131092430', 'H. No. 81, Bhawani Campus, Phase - 2,\nNarela Sankiri', '', 'myuser.png', '2018-03-30 10:16:11', '2018-03-30');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `userid` int(3) NOT NULL,
  `path` varchar(40) NOT NULL,
  `report_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `userid`, `path`, `report_date`) VALUES
(1, 1, 'dbcf08eef09864d850ce95d2569bbf75.jpg', '2018-03-30 10:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `password` varchar(34) NOT NULL,
  `email` varchar(150) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `resetcode` varchar(34) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `name`, `password`, `email`, `status`, `resetcode`) VALUES
(1, 'John', '0bad310aa8c9cea83b4a681986a5e568', 'patient@gmail.com', 1, 'd453de84a97eb435602b40bf12dfe6c4'),
(2, 'Pooja', '0bad310aa8c9cea83b4a681986a5e568', 'pooja@gmail.com', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorid`);

--
-- Indexes for table `doctor_information`
--
ALTER TABLE `doctor_information`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patientid`);

--
-- Indexes for table `patient_information`
--
ALTER TABLE `patient_information`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `doctor_information`
--
ALTER TABLE `doctor_information`
  MODIFY `student_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patientid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `patient_information`
--
ALTER TABLE `patient_information`
  MODIFY `student_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
