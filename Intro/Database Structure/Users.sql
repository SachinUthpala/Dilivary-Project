-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 09, 2024 at 05:02 AM
-- Server version: 10.3.39-MariaDB
-- PHP Version: 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(128) NOT NULL,
  `u_email` varchar(128) NOT NULL,
  `u_password` varchar(128) NOT NULL,
  `u_admin_access` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`u_id`, `u_name`, `u_email`, `u_password`, `u_admin_access`) VALUES
(14, 'Admin01', 'admin01@eastlink.lk', 'Admin01_eastlink', 1),
(15, 'Admin02', 'admin02@eastlink.lk', 'Admin02_eastlink', 1),
(16, 'Accounting01', 'accounting01@eastlink.lk', 'accounting01_eastlink', 1),
(17, 'Accounting02', 'accounting02@eastlink.lk', 'accounting02_eastlink', 1),
(18, 'Accounting03', 'accounting03@eastlink.lk', 'accounting03_eastlink', 1),
(19, 'Accounting04', 'accounting04@eastlink.lk', 'accounting04_eastlink', 1),
(20, 'WebDeveloper01', 'WebDeveloper01@eastlink.lk', 'WD01_EL', 1),
(21, 'WebDeveloper02', 'WebDeveloper02@eastlink.lk', 'WD02_EL', 1),
(29, 'Sales01', 'sales1@eastlink.lk', 'Sales1', 0),
(30, 'Sales02', 'sales2@eastlink.lk', 'Sales2', 0),
(31, 'Sales03', 'sales3@eastlink.lk', 'Sales3', 0),
(32, 'Sales04', 'sales4@eastlink.lk', 'Sales4', 0),
(33, 'Sales05', 'sales5@eastlink.lk', 'Sales5', 0),
(34, 'Sales06', 'sales6@eastlink.lk', 'Sales6', 0),
(35, 'Sales07', 'sales7@eastlink.lk', 'Sales7', 0),
(36, 'Sales08', 'sales8@eastlink.lk', 'Sales8', 0),
(37, 'Sales09', 'sales9@eastlink.lk', 'Sales9', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
