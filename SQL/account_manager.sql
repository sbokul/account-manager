-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2014 at 11:09 PM
-- Server version: 5.5.33
-- PHP Version: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dynamic_accounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE IF NOT EXISTS `bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `particulars` varchar(255) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `voucher_no` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `particulars`, `amount`, `voucher_no`, `project_id`, `create_date`, `modify_date`) VALUES
(1, '1st RA Bill', '55400', '1', 4, '2013-12-07', '2013-12-07 07:08:53'),
(2, 'pay order return', '1155000', '01', 8, '2013-06-27', '2014-03-27 10:18:00'),
(3, '1st r/a bill', '2448870', '02', 8, '2013-06-27', '2014-03-27 10:18:44'),
(4, '2nd R/A Bill', '2848860', '03', 8, '2013-07-30', '2014-03-27 10:19:44'),
(5, '3rd R/A Bill', '1965557', '04', 8, '2013-07-04', '2014-03-27 10:20:21'),
(6, 'pay order return', '574000', '5', 8, '2013-11-20', '2014-03-27 10:21:06');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `particulars` varchar(255) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `voucher_no` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=117 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `particulars`, `amount`, `voucher_no`, `project_id`, `create_date`, `modify_date`) VALUES
(1, 'Office', '100000', '1', 4, '2013-12-07', '2013-12-07 07:19:19'),
(3, 'Photo Copy', '10000', '2', 4, '2013-12-07', '2013-12-07 15:37:52'),
(4, 'Photo Copy', '5000', '3', 4, '2013-12-08', '2013-12-08 05:56:55'),
(5, 'Office', '10000', '4', 4, '2013-12-08', '2013-12-08 05:57:44'),
(6, 'ruhul bhai', '2000', '13', 4, '2013-12-11', '2013-12-09 09:51:09'),
(7, 'schedule parchase', '8000', '01', 8, '2004-04-13', '2014-03-27 08:16:52'),
(8, 'photocopy', '2385', '02', 8, '2013-06-04', '2014-03-27 08:17:49'),
(9, 'photocopy', '3062', '03', 8, '2013-04-07', '2014-03-27 08:18:41'),
(10, 'pay order', '1155000', '04', 8, '2013-04-07', '2014-03-27 08:22:11'),
(11, 'office molla', '10000', '05', 8, '2013-04-07', '2014-03-27 08:23:16'),
(12, 'office molla', '10000', '05/02', 8, '2013-04-08', '2014-03-27 08:24:48'),
(13, 'office xen', '200000', '06', 8, '2013-04-08', '2014-03-27 08:25:41'),
(14, 'nasir mistry', '150290', '07', 8, '2013-04-16', '2014-03-27 08:26:55'),
(15, 'noore alom mistry', '15000', '08', 8, '2013-04-16', '2014-03-27 08:28:06'),
(16, 'nasir mistry', '10000', '09', 8, '2013-04-17', '2014-03-27 08:30:06'),
(17, 'office xen', '2000', '10', 8, '2013-04-17', '2014-03-27 08:31:35'),
(18, 'noore alom mistry', '40000', '11', 8, '2013-04-21', '2014-03-27 08:32:17'),
(19, 'tube well goods', '200000', '12', 8, '2013-04-21', '2014-03-27 08:33:20'),
(20, 'office xen', '150000', '13', 8, '2013-04-21', '2014-03-27 08:33:58'),
(21, 'noore alom mistry', '10000', '14', 8, '2013-04-25', '2014-03-27 08:34:31'),
(22, 'Convynce', '6500', '15', 8, '2013-04-26', '2014-03-27 08:35:07'),
(23, 'Convynce', '3000', '16', 8, '2013-04-26', '2014-03-27 08:35:29'),
(24, 'office molla', '20000', '17', 8, '2013-04-26', '2014-03-27 08:36:00'),
(25, 'nasir mistry', '15000', '18', 8, '2013-04-27', '2014-03-27 08:36:26'),
(26, 'unus ali mistry', '12000', '19', 8, '2013-04-27', '2014-03-27 08:37:01'),
(27, 'nasir mistry', '22000', '20', 8, '2013-04-29', '2014-03-27 08:37:40'),
(28, 'noore alom mistry', '10000', '21', 8, '2013-04-30', '2014-03-27 08:38:06'),
(29, 'office xen', '400000', '22', 8, '2013-04-30', '2014-03-27 08:38:38'),
(30, 'tube well goods', '500', '23', 8, '2013-05-02', '2014-03-27 08:39:13'),
(31, 'nasir mistry', '10000', '24', 8, '2013-05-03', '2014-03-27 08:39:36'),
(32, 'office molla', '590', '25', 8, '2013-05-04', '2014-03-27 08:40:31'),
(33, 'noore alom mistry', '10000', '26', 8, '2013-05-04', '2014-03-27 08:40:56'),
(34, 'tube well goods ( Talukder group)', '37500', '27', 8, '2013-05-05', '2014-03-27 08:41:47'),
(35, 'office expensses', '1000', '28', 8, '2013-05-07', '2014-03-27 08:42:44'),
(36, 'nasir mistry', '10000', '29', 8, '2013-05-08', '2014-03-27 08:43:07'),
(37, 'noore alom mistry', '10000', '30', 8, '2013-05-09', '2014-03-27 08:43:36'),
(38, 'office xen', '450000', '31', 8, '2013-05-11', '2014-03-27 08:44:55'),
(39, 'performance security', '865261', '32', 8, '2013-05-11', '2014-03-27 08:48:23'),
(40, 'nasir mistry', '9000', '33', 8, '2013-05-11', '2014-03-27 08:48:53'),
(41, 'tube well goods ( Talukder group)', '372400', '34', 8, '2013-05-12', '2014-03-27 08:49:27'),
(42, 'noore alom mistry', '10000', '35', 8, '2013-05-12', '2014-03-27 08:50:31'),
(43, 'noore alom mistry', '10000', '35', 8, '2013-05-12', '2014-03-27 08:50:32'),
(44, 'nasir mistry', '5000', '36', 8, '2013-06-13', '2014-03-27 08:52:26'),
(45, 'tube well goods (RFL Groop)', '1938640', '37', 8, '2013-05-13', '2014-03-27 08:53:40'),
(46, 'tube well goods ( Talukder group)', '186000', '38', 8, '2013-05-14', '2014-03-27 08:54:16'),
(47, 'unus ali mistry', '40800', '39', 8, '2013-05-14', '2014-03-27 08:54:47'),
(48, 'nasir mistry', '12000', '40', 8, '2013-05-15', '2014-03-27 09:01:06'),
(49, 'tube well goods (unload charge)', '10500', '41', 8, '2013-05-16', '2014-03-27 09:06:07'),
(50, 'nasir mistry', '10000', '42', 8, '2013-05-16', '2014-03-27 09:06:32'),
(51, 'nasir mistry', '10000', '42', 8, '2013-05-16', '2014-03-27 09:06:40'),
(52, 'nasir mistry', '10000', '42', 8, '2013-05-16', '2014-03-27 09:06:49'),
(53, 'nasir mistry', '10000', '42', 8, '2013-05-16', '2014-03-27 09:06:55'),
(54, 'noore alom mistry', '10400', '43', 8, '2013-05-17', '2014-03-27 09:08:01'),
(55, 'office expensses', '5500', '44', 8, '2013-05-17', '2014-03-27 09:09:14'),
(56, 'office expensses', '5180', '45', 8, '2013-05-19', '2014-03-27 09:09:49'),
(57, 'tube well goods (unload charge)', '5300', '46', 8, '2013-05-19', '2014-03-27 09:11:07'),
(58, 'tube well goods( tara system)', '11000', '47', 8, '2013-05-20', '2014-03-27 09:12:42'),
(59, 'tube well goods( tara system)', '12000', '48', 8, '2013-05-21', '2014-03-27 09:13:38'),
(60, 'noore alom mistry', '12000', '49', 8, '2013-05-21', '2014-03-27 09:14:08'),
(61, 'nasir mistry', '12000', '50', 8, '2013-05-21', '2014-03-27 09:14:29'),
(62, 'nasir mistry', '12000', '50', 8, '2013-05-21', '2014-03-27 09:15:01'),
(63, 'tube well goods', '12520', '51', 8, '2013-05-21', '2014-03-27 09:20:33'),
(64, 'tube well goods', '9742', '52', 8, '2013-05-23', '2014-03-27 09:22:44'),
(65, 'nasir mistry', '13000', '53', 8, '2013-05-24', '2014-03-27 09:24:27'),
(66, 'noore alom mistry', '3000', '54', 8, '2013-05-24', '2014-03-27 09:24:59'),
(67, 'tube well goods ( Talukder group)', '304580', '55', 8, '2013-05-26', '2014-03-27 09:33:22'),
(68, 'nasir mistry', '15000', '56', 8, '2013-05-28', '2014-03-27 09:33:59'),
(69, 'noore alom mistry', '10000', '57', 8, '2013-05-28', '2014-03-27 09:34:39'),
(70, 'office molla', '10000', '58', 8, '2013-05-29', '2014-03-27 09:35:26'),
(71, 'Convynce', '4150', '59', 8, '2013-05-30', '2014-03-27 09:36:10'),
(72, 'nasir mistry', '12000', '60', 8, '2013-05-30', '2014-03-27 09:37:13'),
(73, 'noore alom mistry', '15000', '61', 8, '2013-06-02', '2014-03-27 09:38:00'),
(74, 'nasir mistry', '15000', '61/2', 8, '2013-06-02', '2014-03-27 09:39:14'),
(75, 'shaheb ali', '50000', '62', 8, '2013-06-09', '2014-03-27 09:42:09'),
(76, 'noore alom mistry', '15000', '62', 8, '2013-06-10', '2014-03-27 09:43:38'),
(77, 'nasir mistry', '15000', '64', 8, '2013-06-10', '2014-03-27 09:44:22'),
(78, 'nasir mistry', '15000', '65', 8, '2013-06-13', '2014-03-27 09:44:59'),
(79, 'tube well goods( tara system)', '19030', '66', 8, '2013-06-15', '2014-03-27 09:45:45'),
(80, 'noore alom mistry', '15125', '67', 8, '2013-06-18', '2014-03-27 09:48:45'),
(81, 'nasir mistry', '15125', '68', 8, '2013-06-18', '2014-03-27 09:51:17'),
(82, 'dulal', '3400', '69', 8, '2013-06-19', '2014-03-27 09:52:46'),
(83, 'office xen', '50000', '70', 8, '2013-06-19', '2014-03-27 09:53:41'),
(84, 'tube well goods', '2000', '71', 8, '2013-06-19', '2014-03-27 09:55:22'),
(85, 'dulal', '7150', '72', 8, '2013-06-20', '2014-03-27 09:55:50'),
(86, 'shaheb ali', '13000', '73', 8, '2013-06-20', '2014-03-27 09:56:17'),
(87, 'noore alom mistry', '5000', '74', 8, '2013-06-22', '2014-03-27 09:57:03'),
(88, 'nasir mistry', '15000', '75', 8, '2013-06-23', '2014-03-27 09:57:43'),
(89, 'noore alom mistry', '15000', '76', 8, '2013-06-23', '2014-03-27 09:58:09'),
(90, 'nasir mistry', '15000', '77', 8, '2013-06-25', '2014-03-27 09:58:56'),
(91, 'office xen', '350000', '78', 8, '2013-06-26', '2014-03-27 09:59:25'),
(92, 'office expensses', '26000', '79', 8, '2013-06-28', '2014-03-27 09:59:59'),
(93, 'dulal', '7000', '80', 8, '2013-06-29', '2014-03-27 10:00:26'),
(94, 'office molla', '15000', '81', 8, '2013-06-29', '2014-03-27 10:01:02'),
(95, 'nasir mistry', '16530', '82', 8, '2013-07-01', '2014-03-27 10:01:38'),
(96, 'mamun', '1000', '83', 8, '2013-07-02', '2014-03-27 10:02:15'),
(97, 'noore alom mistry', '15000', '84', 8, '2014-07-03', '2014-03-27 10:02:42'),
(98, 'shaheb ali', '14000', '85', 8, '2013-07-03', '2014-03-27 10:03:14'),
(99, 'nasir mistry', '20000', '86', 8, '2013-07-03', '2014-03-27 10:03:45'),
(100, 'nasir mistry', '5000', '87', 8, '2013-07-05', '2014-03-27 10:04:09'),
(101, 'shaheb ali', '14000', '88', 8, '2013-07-07', '2014-03-27 10:04:44'),
(102, 'noore alom mistry', '15000', '89', 8, '2013-07-07', '2014-03-27 10:05:11'),
(103, 'nasir mistry', '15000', '90', 8, '2013-07-07', '2014-03-27 10:05:37'),
(104, 'noore alom mistry', '25000', '91', 8, '2013-07-09', '2014-03-27 10:06:26'),
(105, 'office expensses', '5000', '92', 8, '2013-07-10', '2014-03-27 10:07:10'),
(106, 'nasir mistry', '15000', '93', 8, '2013-07-10', '2014-03-27 10:07:36'),
(107, 'noore alom mistry', '15000', '94', 8, '2013-07-10', '2014-03-27 10:08:13'),
(108, 'shaheb ali', '13000', '95', 8, '2013-07-11', '2014-03-27 10:08:41'),
(109, 'tube well goods( tara system)', '49090', '96', 8, '2013-07-13', '2014-03-27 10:09:38'),
(110, 'shaheb ali', '12000', '97', 8, '2013-07-13', '2014-03-27 10:10:06'),
(111, 'nasir mistry', '13000', '98', 8, '2013-07-14', '2014-03-27 10:10:34'),
(112, 'noore alom mistry', '15000', '99', 8, '2013-07-14', '2014-03-27 10:11:03'),
(113, 'nasir mistry', '45000', '100', 8, '2013-07-16', '2014-03-27 10:11:28'),
(114, 'shaheb ali', '14000', '101', 8, '2013-07-17', '2014-03-27 10:12:29'),
(115, 'nasir mistry', '5000', '102', 8, '2013-07-17', '2014-03-27 10:12:47'),
(116, 'nasir mistry', '13000', '10', 8, '2013-07-18', '2014-03-27 10:13:35');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) NOT NULL,
  `work_name` varchar(255) NOT NULL,
  `work_order_amount` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '(Active-1, Inactive-0)',
  `create_date` date NOT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `work_name`, `work_order_amount`, `address`, `status`, `create_date`, `modify_date`) VALUES
(1, 'Kendua', 'Tubwell', '100000', '', 0, '2013-10-11', '2013-12-08 14:33:27'),
(2, 'Kendua', 'Tubwell', '100000', '', 0, '2013-10-11', '2013-12-08 14:40:54'),
(3, 'Kendua2', 'Tubwell', '100000', '', 0, '2013-10-11', '2014-03-27 09:01:25'),
(4, 'Kendua4', 'Tubwell', '1000000', 'Dhaka', 0, '2013-10-11', '2014-03-27 13:50:54'),
(7, 'Kendua5', 'Tubwell', '100000', 'asd', 0, '2013-12-07', '2013-12-08 14:53:53'),
(8, 'Kishoregonj Installation of deep  tubewell', 'Kishoregonj Installation of deep  tubewell', '17291810', 'Kishoregonj', 1, '0000-00-00', '2014-03-27 08:14:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_full_name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_address` varchar(50) NOT NULL,
  `user_country` varchar(50) NOT NULL,
  `user_mobile` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT '1',
  `user_type` int(11) NOT NULL DEFAULT '2' COMMENT '(admin-1, normal-2)',
  `create_date` date NOT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_full_name`, `user_name`, `user_address`, `user_country`, `user_mobile`, `email`, `user_password`, `user_status`, `user_type`, `create_date`, `modify_date`) VALUES
(1, 'Admin', 'admin', 'Mirpur, Dhaka', 'Bangladesh', '01717..........', 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '2013-11-19', '2013-12-08 14:53:27');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
