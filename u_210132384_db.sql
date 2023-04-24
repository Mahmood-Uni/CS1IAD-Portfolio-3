-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2023 at 09:58 PM
-- Server version: 8.0.32-0ubuntu0.20.04.2
-- PHP Version: 8.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u_210132384_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `pid` int UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `phase` enum('design','development','testing','deployment','complete') DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `uid` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`pid`, `title`, `start_date`, `end_date`, `phase`, `description`, `uid`) VALUES
(1, 'E-Commeerce', '2022-03-05', '2023-03-04', 'complete', 'Online store selling products', 1),
(2, 'Weather App', '2023-01-15', '2023-05-27', 'testing', 'Application that displays the weather forecast', 1),
(3, 'Fitness Tracker', '2023-03-28', '2023-08-19', 'development', 'Application that tracks fitness activities and pregress', 2),
(4, 'social media app', '2023-04-13', '2023-11-25', 'development', 'create a social media app that allows to create profiles, message friends and post content', 3),
(5, 'Task manager app', '2023-01-12', '2023-04-15', 'complete', 'Create an app that can add and remove tasks, sort for date and priority.', 6),
(6, 'Clock app', '2023-04-05', '2023-04-20', 'development', 'Create a Clock app that shows the time, also has a stopwatch feature', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int UNSIGNED NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `email`) VALUES
(1, 'abc', '123', 'Jones@hotmail.com'),
(2, 'jkl', '567', 'William@hotmail.com'),
(3, 'qwe', '$2y$10$SAYkAyTdGXbylZ/l1wgVzuU1TY3RSu6VZ24.bPWzG5IbA3sTEYfRm', 'qwe@hotmail.com'),
(4, 'bnm', '$2y$10$G3F0iBLvEmN3pEtmAhR74..fJxXisjnTTpDA1gVO4a5iDR8JhIbn.', 'bnm@hotmail.com'),
(5, 'adg', '$2y$10$VbO0G5BlfOm00i6LoM92JuOQN36SLcKFwz32OTXszDjeWxDvDnA76', 'adg@hotmail.com'),
(6, 'bbb', '$2y$10$lnw6Ir745lw3Q0jkvmIBM./lS96o8X34TkMMweubMN.sPir1odpy2', 'bbb@hotmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `pid` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
