-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2019 年 7 月 11 日 13:21
-- サーバのバージョン： 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gsf_d03_db21`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `guest_table`
--

CREATE TABLE `guest_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `typ` int(12) DEFAULT NULL,
  `national` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `occupation` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `cadd` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `guest_table`
--

INSERT INTO `guest_table` (`id`, `name`, `dob`, `typ`, `national`, `occupation`, `cadd`, `image`, `indate`) VALUES
(2, 'aaaa', '2019-07-08', 5, 'USA', 'Freelancer', 'zzz', NULL, '2019-07-09 18:06:19'),
(3, 'mintia', '2016-03-02', 2, 'Japan', 'Freelancer', 'ddd', NULL, '2019-07-11 14:55:00'),
(4, 'whinky', '2019-01-07', NULL, 'Japan', 'Teacher', 'vvvv', NULL, '2019-07-11 15:05:18'),
(6, 'ssadfgh', '2019-07-25', NULL, 'USO', 'Freelancer', 'oooooo', 'upload/20190711065601d41d8cd98f00b204e9800998ecf8427e.jpeg', '2019-07-11 15:56:01'),
(7, 'Jason Bourne', '1991-11-21', NULL, 'USA', 'Agent', 'USA', 'upload/20190711131149d41d8cd98f00b204e9800998ecf8427e.jpeg', '2019-07-11 22:11:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guest_table`
--
ALTER TABLE `guest_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guest_table`
--
ALTER TABLE `guest_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
