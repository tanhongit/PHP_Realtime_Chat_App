-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 24, 2022 at 05:33 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatapp-php`
--

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

DROP TABLE IF EXISTS `chats`;
CREATE TABLE IF NOT EXISTS `chats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outgoing_msg_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `incoming_msg_id`, `outgoing_msg_id`, `message`) VALUES
(1, '715753362', '38', 'Github ko'),
(2, '715753362', '38', 'Github ko'),
(3, '715753362', '38', 'Hi man'),
(4, '715753362', '38', 'Hi nam'),
(5, '384176595', '39', 'Alo'),
(6, '715753362', '38', 'OK'),
(7, '384176595', '39', 'nhon'),
(8, '384176595', '39', 'ok'),
(9, '715753362', '38', 'nhon'),
(10, '715753362', '38', '....'),
(11, '715753362', '38', 'fesgiyur '),
(12, '384176595', '39', 'sgtr etg'),
(13, '384176595', '39', 'h');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unique_id`, `full_name`, `last_name`, `email`, `password`, `img`, `status`) VALUES
(37, '408095744', 'Test', 'LTest', 'mailer@test.com.vn', '202cb962ac59075b964b07152d234b70', '1645292877_oil3.jpg', 'off'),
(38, '384176595', 'test', 'testl', 'test@exam.com.vn', 'e10adc3949ba59abbe56e057f20f883e', '1645332496_20170923_120616.jpg', 'active'),
(39, '715753362', 'Test3', 'Test3', 'test3@exam.com.vn', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'active'),
(40, '220750153', 'Test 4', 'Test 4', 'test4@exam.com.vn', 'e10adc3949ba59abbe56e057f20f883e', '1645337222_bagua_4_1024x1024.jpg', 'active'),
(41, '1076120657', 'Test 5', 'test 5', 'test5@exam.com.vn', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'active'),
(42, '359323734', 'Test 6', 'test 6', 'test6@exam.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'active');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
