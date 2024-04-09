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
-- Table structure for table `Delivery_arraange`
--

CREATE TABLE `Delivery_arraange` (
  `ar_id` int(11) NOT NULL,
  `ar_date` date NOT NULL,
  `ar_dn_ref` varchar(1111) NOT NULL,
  `ar_customer_name` varchar(1111) NOT NULL,
  `ar_delivery_address` varchar(1111) NOT NULL,
  `ar_contaced_person` varchar(1111) NOT NULL,
  `ar_requested_by` varchar(1111) NOT NULL,
  `ar_vehicle_type` varchar(11111) NOT NULL,
  `ar_type_of_delivery` varchar(11111) NOT NULL,
  `ar_urgancy` varchar(11111) NOT NULL,
  `ar_delivery_person` varchar(11111) DEFAULT NULL,
  `ar_contact_number` varchar(11111) NOT NULL,
  `ar_created_by` varchar(1111) NOT NULL,
  `ar_created_date` date NOT NULL,
  `ar_created_time` time NOT NULL,
  `ar_status` varchar(100) NOT NULL DEFAULT 'pending',
  `ar_out_time` time DEFAULT NULL,
  `ar_in_time` time DEFAULT NULL,
  `exp_del_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Delivery_arraange`
--

INSERT INTO `Delivery_arraange` (`ar_id`, `ar_date`, `ar_dn_ref`, `ar_customer_name`, `ar_delivery_address`, `ar_contaced_person`, `ar_requested_by`, `ar_vehicle_type`, `ar_type_of_delivery`, `ar_urgancy`, `ar_delivery_person`, `ar_contact_number`, `ar_created_by`, `ar_created_date`, `ar_created_time`, `ar_status`, `ar_out_time`, `ar_in_time`, `exp_del_date`) VALUES
(40, '2024-04-04', 'test01', 'test01-CN', 'test01-DA', 'test01-CP', 'Madhavi', 'Bus', 'Item Delivery & Cash Collect', 'Not Urgent', 'Test01-DP', 'test01-0147', 'admin01@eastlink.lk', '2024-04-04', '11:16:53', 'canceled', '00:17:00', '11:22:00', '2024-04-06'),
(41, '2024-04-04', '30746', 'ITX360', 'Colombo 03', 'Mr.Muditha', 'Taniya', 'Bike', 'Item Delivery', 'Urgent', NULL, '077 173 7748', 'salse01@eastlink.lk', '2024-04-04', '14:17:07', 'canceled', NULL, NULL, '2024-04-04'),
(42, '2024-04-04', '30752', 'Rohana Construction', 'Prompt Express', 'Mr.Gayan', 'Taniya', 'Lorry', 'Item Delivery', 'Very Urgent', 'Douglus', '076 469 3201', 'sales3@eastlink.lk', '2024-04-04', '15:59:51', 'delivered', '16:49:00', '17:50:00', '2024-04-04'),
(43, '2024-04-05', 'Tender', 'University of Moratuwa', 'Diyagama, Homagama', '', 'Taniya', 'Bike', 'Document delivery', 'Sheduled', 'Aruna', '', 'sales3@eastlink.lk', '2024-04-05', '10:12:01', 'delivered', '11:16:00', '12:28:00', '2024-08-08'),
(44, '2024-04-05', '30769', 'Cash Customer', 'No.114, Waidya Road,Dehiwala', 'Mr. Wasif', 'Madhavi', 'Lorry', 'Item Delivery', 'Urgent', 'Douglus', '+94 77 766 6661', 'sales5@eastlink.lk', '2024-04-05', '14:06:54', 'delivered', '14:30:00', '16:10:00', '2024-04-05'),
(48, '2024-04-05', '30778', 'Sri Lanka Telecom Services Ltd.', 'Lesley Ranagala mw, Colombo 08', 'Mr.Dulshan', 'Taniya', 'Bike', 'Item Delivery', 'Urgent', 'Aruna', '071 286 0686', 'sales3@eastlink.lk', '2024-04-05', '16:55:50', 'delivered', '08:30:00', '09:30:00', '2024-04-08'),
(49, '2024-04-08', '30712', 'Mr. Hasantha', 'Battaramulla', '', 'Kasuni', 'Lorry', 'Item Delivery & Cheque collection', 'Very Urgent', 'Aruna', '0763 128743', 'sales8@eastlink.lk', '2024-04-08', '12:07:45', 'delivered', '14:23:00', '17:25:00', '2024-04-08'),
(50, '2024-04-08', '30794', 'Mr. Pasindu', 'Colombo 02', '', 'Kasuni', 'Bike', 'Item Delivery', 'Very Urgent', 'Aruna', '0743-484619', 'sales8@eastlink.lk', '2024-04-08', '12:50:03', 'delivered', '15:00:00', '17:25:00', '2024-04-08'),
(51, '2024-04-08', '30796', 'Premier Data Systems (Pvt) Ltd', 'Kohuwala.', 'Ms.Punsala', 'Kaveesha', 'Bike', 'Item Delivery & Cash Collect', 'Not Urgent', 'Douglus', '0112815015', 'sales6@eastlink.lk', '2024-04-08', '14:08:55', 'delivered', '16:40:00', '17:25:00', '2024-04-08'),
(52, '2024-04-08', '30797', 'Metropolitan', 'No,12,MAGAZINE ROAD,Colombo 08.                                       COLOMBO 08.', 'Mr. Prabath', 'Kasuni', 'Bike', 'Item Delivery', 'Very Urgent', 'Aruna', '071 408 6288', 'sales8@eastlink.lk', '2024-04-08', '14:18:51', 'delivered', '08:30:00', '09:30:00', '2024-04-08'),
(53, '2024-04-08', '30705', 'Ceat Kelani International Tyres (Pvt) Ltd.', 'Kelaniya', 'Mr.Asitha', 'Kaveesha', 'Lorry', 'Item Delivery', 'Urgent', 'Aruna', '0701027225', 'sales6@eastlink.lk', '2024-04-08', '14:23:17', 'pending', '08:30:00', '17:52:00', '2024-04-08'),
(54, '2024-04-08', '30790', 'Kings Hospital Colombo', 'No.18/A, Evergreen Park Road, Narahenpita, Colombo 05.', 'Mr. Sameera', 'Lakmini', 'Lorry', 'Item Delivery', 'Urgent', 'Aruna', '0718340709', 'sales4@eastlink.lk', '2024-04-08', '14:24:53', 'delivered', '15:00:00', '17:25:00', '2024-04-08'),
(55, '2024-04-08', '', 'K I K Lanka (Pvt) Ltd', '35 Fife Road Colombo 5.', 'Mr. Denham', 'Lakmini', 'Lorry', 'Item Delivery', 'Urgent', 'Douglus', '0774408203', 'sales4@eastlink.lk', '2024-04-08', '16:54:42', 'delivered', '17:15:00', '17:55:00', '2024-04-08');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_types`
--

CREATE TABLE `delivery_types` (
  `dTID` int(11) NOT NULL,
  `dType` varchar(2323) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `delivery_types`
--

INSERT INTO `delivery_types` (`dTID`, `dType`) VALUES
(3, 'Document Handover'),
(4, 'Item Delivery & Cash Collect'),
(5, 'Item Delivery'),
(6, 'Item Delivery & Cheque collection'),
(7, 'Document delivery');

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `r_id` int(11) NOT NULL,
  `r_created_by` varchar(125) NOT NULL,
  `r_data` varchar(125) NOT NULL,
  `r_important` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`r_id`, `r_created_by`, `r_data`, `r_important`) VALUES
(12, 'WebDeveloper01@eastlink.lk', 'Test Reminder 01', 'Important'),
(17, 'WebDeveloper01@eastlink.lk', 'Test Reminder 03', 'Not_Important');

-- --------------------------------------------------------

--
-- Table structure for table `RequestedBy`
--

CREATE TABLE `RequestedBy` (
  `rId` int(11) NOT NULL,
  `rName` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `RequestedBy`
--

INSERT INTO `RequestedBy` (`rId`, `rName`) VALUES
(3, 'Hiruni'),
(4, 'Kaveesha'),
(5, 'Taniya'),
(6, 'Kasuni'),
(7, 'Madhavi'),
(8, 'Kasuni'),
(9, 'Sachin'),
(10, 'Lakmini');

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
-- Indexes for table `Delivery_arraange`
--
ALTER TABLE `Delivery_arraange`
  ADD PRIMARY KEY (`ar_id`);

--
-- Indexes for table `delivery_types`
--
ALTER TABLE `delivery_types`
  ADD PRIMARY KEY (`dTID`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `RequestedBy`
--
ALTER TABLE `RequestedBy`
  ADD PRIMARY KEY (`rId`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Delivery_arraange`
--
ALTER TABLE `Delivery_arraange`
  MODIFY `ar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `delivery_types`
--
ALTER TABLE `delivery_types`
  MODIFY `dTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `RequestedBy`
--
ALTER TABLE `RequestedBy`
  MODIFY `rId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
