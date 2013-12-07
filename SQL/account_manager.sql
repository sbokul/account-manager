-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2013 at 01:30 PM
-- Server version: 5.1.63-0ubuntu0.11.04.1
-- PHP Version: 5.3.5-1ubuntu7.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `account_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

DROP TABLE IF EXISTS `bills`;
CREATE TABLE IF NOT EXISTS `bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `particulars` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `voucher_no` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `particulars`, `amount`, `voucher_no`, `project_id`, `create_date`, `modify_date`) VALUES
(1, '1st RA Bill', 55400, '1', 4, '2013-12-07', '2013-12-07 07:08:53');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `particulars` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `voucher_no` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `particulars`, `amount`, `voucher_no`, `project_id`, `create_date`, `modify_date`) VALUES
(1, 'Office', 100000, '1', 4, '2013-12-07', '2013-12-07 07:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) NOT NULL,
  `work_name` varchar(255) NOT NULL,
  `work_order_amount` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `work_name`, `work_order_amount`, `create_date`, `modify_date`) VALUES
(1, 'Kendua', 'Tubwell', 100000, '2013-10-11', '2013-11-29 15:32:08'),
(2, 'Kendua', 'Tubwell', 100000, '2013-10-11', '2013-11-29 15:32:37'),
(3, 'Kendua2', 'Tubwell', 100000, '2013-10-11', '2013-11-29 15:33:42'),
(4, 'Kendua4', 'asdasd', 0, '2013-10-11', '2013-12-06 14:23:18'),
(6, '', '', 0, '0000-00-00', '2013-12-07 07:24:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_full_name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_address` varchar(50) NOT NULL,
  `user_country` varchar(50) NOT NULL,
  `user_mobile` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT '0',
  `user_type` int(11) NOT NULL DEFAULT '2' COMMENT '(admin-1, normal-2)',
  `create_date` date NOT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_full_name`, `user_name`, `user_address`, `user_country`, `user_mobile`, `email`, `user_password`, `user_status`, `user_type`, `create_date`, `modify_date`) VALUES
(1, 'Bokul', 'bokul', 'Mirpur, Dhaka', 'Bangladesh', '01717251417', 'bokul@horoppa.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '2013-11-19', '2013-11-19 06:07:55');
