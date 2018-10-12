-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 12, 2018 at 12:02 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ctfigniter`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(1, 'Binary'),
(2, 'Crypto'),
(3, 'Forensics'),
(4, 'Misc'),
(5, 'Reverse'),
(6, 'Stegano'),
(7, 'Web');

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE `challenges` (
  `id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `description` varchar(255) NOT NULL,
  `flag` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '0',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `title` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `smtp_host` varchar(32) NOT NULL,
  `smtp_port` int(4) NOT NULL,
  `smtp_user` varchar(32) NOT NULL,
  `smtp_pass` varchar(32) NOT NULL,
  `registration` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`title`, `description`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_pass`, `registration`) VALUES
('Ctfigniter', 'Use your brain for fun game challenges', 'ssl://smtp.googlemail.com', 465, 'your@mail.com', 'yourpassword', 1);

-- --------------------------------------------------------

--
-- Table structure for table `solvers`
--

CREATE TABLE `solvers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chall_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `picture` varchar(32) DEFAULT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `token` varchar(64) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `verify` tinyint(1) NOT NULL DEFAULT '0',
  `last_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `password`, `email`, `picture`, `score`, `token`, `visible`, `level`, `verify`, `last_login`, `updated_at`, `created_at`) VALUES
(1, 'Administrator', '$2y$10$zwpEEo0T0sto2b2HT2iPw.bY95n5zQ0//z8EqHexztFs.KpXorgu2', 'superadmin@gmail.com', NULL, 0, '9bfff8e3452cde87b338d18f8b20d7ad7f93135c', 1, 1, 1, '2018-10-12 17:01:47', '2018-09-25 06:12:04', '2018-09-25 06:12:04'),
(2, 'Blackbone', '$2y$10$haoWkxtZwNbuxYo2SunHq.pZRp4JNRJB7cLjtnQKtMsYCW9OtaW2.', 'blackbone@gmail.com', NULL, 0, '9bfff8e3452cde87b338d18f8b20d7ad7f93135a', 1, 0, 1, '2018-10-12 17:00:48', '2018-09-25 06:12:04', '2018-09-25 06:12:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `solvers`
--
ALTER TABLE `solvers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `chall_id` (`chall_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `challenges`
--
ALTER TABLE `challenges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `solvers`
--
ALTER TABLE `solvers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `challenges`
--
ALTER TABLE `challenges`
  ADD CONSTRAINT `challenges_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `challenges_ibfk_2` FOREIGN KEY (`author`) REFERENCES `users` (`id`);

--
-- Constraints for table `solvers`
--
ALTER TABLE `solvers`
  ADD CONSTRAINT `solvers_ibfk_1` FOREIGN KEY (`chall_id`) REFERENCES `challenges` (`id`),
  ADD CONSTRAINT `solvers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
