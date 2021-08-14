-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2021 at 11:01 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clra`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(50) NOT NULL,
  `user_name` varchar(500) DEFAULT NULL,
  `firstname` varchar(500) DEFAULT NULL,
  `lastname` varchar(500) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(50) DEFAULT NULL,
  `isAdmin` int(5) DEFAULT NULL,
  `isHod` int(5) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `isSuperHod` int(5) DEFAULT NULL,
  `isManager` int(5) DEFAULT NULL,
  `isTeamLead` int(5) DEFAULT NULL,
  `isTeamMember` int(5) DEFAULT NULL,
  `ops_team` int(5) DEFAULT NULL,
  `remember_token` int(5) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `last_login_time` datetime(6) DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `clra_role` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `firstname`, `lastname`, `email`, `password`, `avatar`, `mobile_number`, `isAdmin`, `isHod`, `department_id`, `role_id`, `designation`, `isSuperHod`, `isManager`, `isTeamLead`, `isTeamMember`, `ops_team`, `remember_token`, `created_by`, `updated_by`, `last_login_time`, `created_at`, `updated_at`, `clra_role`) VALUES
(1, 'employer1', 'employer', 'one', 'employer1@gmail.com', '$2y$10$VgKHC1kKYTPDaua/1CRcmuNrfByu.k6oJrflmsnKZDcRH77zBbTTm', NULL, NULL, 0, 0, 0, 0, 'Employer', 0, 0, 0, 0, 0, NULL, 1, 1, '2021-04-21 11:26:50.000000', '2020-10-28 01:07:28.000000', '2020-10-28 06:37:28.000000', 1),
(2, 'contractor1', 'contractor', 'one', 'contractor1@gmail.com', '$2y$10$VgKHC1kKYTPDaua/1CRcmuNrfByu.k6oJrflmsnKZDcRH77zBbTTm', NULL, NULL, 0, 0, 0, 0, 'Contractor', 0, 0, 0, 0, 0, NULL, 1, 1, '2021-04-21 11:26:50.000000', '2020-10-28 01:07:28.000000', '2020-10-28 06:37:28.000000', 2),
(3, 'auditor1', 'auditor', 'one', 'auditor1@gmail.com', '$2y$10$VgKHC1kKYTPDaua/1CRcmuNrfByu.k6oJrflmsnKZDcRH77zBbTTm', NULL, NULL, 0, 0, 0, 0, 'Auditor', 0, 0, 0, 0, 0, NULL, 1, 1, '2021-04-21 11:26:50.000000', '2020-10-28 01:07:28.000000', '2020-10-28 06:37:28.000000', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
