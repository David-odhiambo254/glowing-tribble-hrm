-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2023 at 11:56 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_departments`
--

CREATE TABLE `all_departments` (
  `id` int(11) NOT NULL,
  `department` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `all_departments`
--

INSERT INTO `all_departments` (`id`, `department`) VALUES
(2, 'Finance');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `worker_name` varchar(20) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `department` text NOT NULL,
  `Task` text NOT NULL DEFAULT 'Not tasked',
  `gender` text NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `place` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `County` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `worker_name`, `photo`, `department`, `Task`, `gender`, `mobile`, `email`, `dob`, `place`, `city`, `County`, `password`, `date`) VALUES
(3, 'Tracy', '649823f75bd7a.jpg', 'Finance', 'Enroll interns', 'female', '0796325175', 'tracy@gmail.com', '1997-07-14', 'Ruiru,Kenya', 'Nairobi', 'Nairobi', '12345', '2023-06-29 22:29:10'),
(4, 'Brizzy', '649826e9be4af.png', 'Frontend', 'Get lunch', '', '0712345678', 'bizzy@email.com', '2002-02-14', 'Karen,Nairobi', 'Nairobi', 'Nairobi', '12345', '2023-06-29 21:04:38');

-- --------------------------------------------------------

--
-- Table structure for table `leave_app`
--

CREATE TABLE `leave_app` (
  `id` int(11) NOT NULL,
  `staff_name` varchar(20) NOT NULL,
  `department` text NOT NULL,
  `reason` text NOT NULL,
  `descr` mediumtext NOT NULL,
  `starts` date NOT NULL,
  `ends` date NOT NULL,
  `stat` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_app`
--

INSERT INTO `leave_app` (`id`, `staff_name`, `department`, `reason`, `descr`, `starts`, `ends`, `stat`, `date`) VALUES
(1, 'Angela Kate', 'Finance', 'Sick', 'i need to quarantine myself for few weeks as i got some symptoms of covid-19', '2023-06-30', '2023-07-07', 'Approved', '2023-06-28 08:58:58');

-- --------------------------------------------------------

--
-- Table structure for table `off`
--

CREATE TABLE `off` (
  `id` int(11) NOT NULL,
  `staff_name` varchar(20) NOT NULL,
  `department` text NOT NULL,
  `reason` text NOT NULL,
  `description` mediumtext NOT NULL,
  `starts` date NOT NULL,
  `ends` date NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` int(11) NOT NULL,
  `worker_name` varchar(20) NOT NULL,
  `department` text NOT NULL,
  `photo` varchar(10000) NOT NULL,
  `mobile` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `place` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `basic_salary` int(11) NOT NULL,
  `allowance` int(11) NOT NULL,
  `total_amt` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id`, `worker_name`, `department`, `photo`, `mobile`, `email`, `place`, `city`, `basic_salary`, `allowance`, `total_amt`, `date`) VALUES
(2, 'Brizzy', 'ICT', '649defb0dd15a.png', 712345678, 'brizzy@gmail.com', 0, 0, 20000, 9000, 0, '2023-06-29 20:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `pasword` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_name`, `pasword`, `date`) VALUES
(1, 8282123819, 'David', '1234', '2022-07-05 19:49:03'),
(2, 9223372036854775807, 'stan', '1234', '2022-07-05 20:41:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_departments`
--
ALTER TABLE `all_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_app`
--
ALTER TABLE `leave_app`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `off`
--
ALTER TABLE `off`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_name` (`user_name`),
  ADD KEY `date` (`date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_departments`
--
ALTER TABLE `all_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leave_app`
--
ALTER TABLE `leave_app`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `off`
--
ALTER TABLE `off`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
