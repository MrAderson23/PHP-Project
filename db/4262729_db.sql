-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: fdb28.awardspace.net
-- Generation Time: Jan 22, 2023 at 12:46 PM
-- Server version: 5.7.20-log
-- PHP Version: 8.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4262729_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL, 
  `firstname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pic` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `address`, `city`, `country`, `phone`, `pic`) VALUES
(1, 'user01', '$2y$10$Lxkrb2hT9HiSS4TKG8LUcOWTYCxRni7uwR3e0WCMazSJsxJ2AFXe6', 'John', 'Papas', 'user1@gmail.com', 'user address 1', 'Athens', 'GR', '5454236367346', './img/pics/user1.jpg'),
(2, 'user02', '$2y$10$/btQMJTbwXGVH1XICqKRKOB3K687fB5jjT33ctthbSBTA8oFSpqB6', 'Joana', 'Statham', 'user2@gmail.com', 'user address 2', 'Athens', 'GR', '54657345824', './img/pics/user2.jpg'),
(3, 'user3', '$2y$10$/VIpuEA.I4IdgnPHB4cUBeaiENcbwEI7fr.l9.w0VgZcSl2CGidGq', 'Babis', 'Flou', 'user3@gmail.com', 'user address 3', 'Paris', 'FR', '35657235235', './img/pics/user3.jpg'),
(4, 'user4', '$2y$10$h3dViDZDknJIignW6ipxgerUNRWgH9OJ0xRM5P9QcgYQN8dXBbnv.', 'Mic', 'Jagger', 'user4@gmail.com', 'user address 4', 'Torino', 'IT', '35657235235', './img/pics/user4.jpg'),
(5, 'user5', '$2y$10$CRwZqrocK90mRDfxbViTXe7FHRMWJXfndMtLOZCNWExiYq7JRcRQq', 'Sophi', 'Lauren', 'user5@gmail.com', 'user address 5', 'Paris', 'FR', '35657235235', './img/pics/user5.jpg'),
(6, 'user6', '$2y$10$3E5W9fPtooR0MNOs6QOPBumHAgtSXD2ZSiy4UHnMWpnELDADzXsHq', 'Terens', 'Hill', 'user6@gmail.com', 'user address 6', 'Milano', 'IT', '35657235235', './img/pics/user6.jpg'),
(7, 'user7', '$2y$10$mZhdqBg25YK3/puPaB2Yt.7pA9gvsiAVUhJwhqX2jHlWOW3HL0Q1O', 'Bad', 'Spenser', 'user7@gmail.com', 'user address 7', 'Barcelona', 'ES', '35657235235', './img/pics/user7.jpg'),
(8, 'user8', '$2y$10$bVr.YmqlyoDqkJR2Jm31LO6kKF78D5z5ptbO4Q9wgnorPZ6ibplu6', 'Soula', 'Boula', 'user8@gmail.com', 'user address 8', 'Athens', 'GR', '35657235235', './img/pics/user8.jpg'),
(9, 'user9', '$2y$10$XYtep8ccCPX2Ksp1cZ7DIuPZkS5tFhf16IgnH4ewsSB8YymzieW9a', 'Sakis', 'Rouvas', 'user9@gmail.com', 'user address 9', 'Milano', 'IT', '35657235235', './img/pics/user9.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
