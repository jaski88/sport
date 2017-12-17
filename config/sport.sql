-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 17, 2017 at 10:23 PM
-- Server version: 5.7.20-0ubuntu0.17.10.1
-- PHP Version: 7.1.11-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sport`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `public` int(11) NOT NULL DEFAULT '1',
  `time_start` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `duration` int(11) NOT NULL,
  `time_end` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cyclic` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1',
  `description` text NOT NULL,
  `location` text NOT NULL,
  `event_type` int(11) NOT NULL,
  `people_min` int(11) DEFAULT NULL,
  `people_max` int(11) DEFAULT NULL,
  `town` varchar(100) DEFAULT NULL,
  `region_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `user_id`, `public`, `time_start`, `duration`, `time_end`, `cyclic`, `active`, `description`, `location`, `event_type`, `people_min`, `people_max`, `town`, `region_id`) VALUES
(1, 3, 0, '2017-12-16 00:00:00', 0, '2017-12-18 00:00:00', 0, 1, 'drewqrwqer', '53.379;14.600', 1, 0, 0, '', 1),
(2, 3, 1, '2017-12-17 20:00:00', 0, '2017-12-17 20:00:00', 1, 1, 'fafasfsadf', '53.919477702268864;14.429711914062523', 1, 0, 0, 'Szczecin', 1),
(3, 3, 0, '2017-12-17 16:34:00', 0, '2017-12-17 16:34:00', 0, 1, 'fdasf dsaf', '53.379;14.6', 1, 0, 3, 'Księżnej Anny, 70-671 Szczecin, Poland', 1),
(4, 3, 0, '2017-12-17 16:34:00', 0, '2017-12-17 16:34:00', 0, 1, 'fdsafsdfasf', '52.91777627162588;17.148828125000023', 4, 0, 0, 'Żoń 3, 64-832 Żoń, Poland', 1),
(5, 3, 0, '2017-12-17 17:01:00', 0, '2017-12-17 17:01:00', 0, 1, 'fsafsdafsa d', '52.99140916108877;16.908502197265648', 1, 1, 2, 'Łąkowa 13, 64-800 Chodzież, Poland', 1),
(6, 3, 1, '2017-12-17 17:33:00', 0, '2017-12-17 17:33:00', 0, 1, 'fdfafafasdf', '52.214943853505886;21.171330921874983', 1, 0, 0, 'Zambrowska 5-7, 04-642 Warszawa, Poland', 1),
(7, 3, 1, '2017-12-17 17:35:00', 0, '2017-12-17 17:35:00', 0, 1, 'Desc', '52.23239981898375;21.124639027343733', 1, 0, 0, 'Ostrobramska, 04-041 Warszawa, Poland', 1),
(8, 3, 1, '2017-12-17 20:53:00', 0, '2017-12-17 20:53:00', 0, 1, 'uyytuytu tyy', '52.231769;21.006536', 1, 0, 0, 'Pałac Kultury i Nauki, plac Defilad 1, 00-901 Warszawa, Poland', 1),
(9, 3, 1, '2017-12-17 18:00:00', 5, '2017-12-17 19:00:57', 0, 1, 'gfgfsdg dfsg ', '52.231769;21.006536', 1, 0, 0, 'Pałac Kultury i Nauki, plac Defilad 1, 00-901 Warszawa, Poland', 1),
(10, 3, 1, '2017-12-30 20:01:00', 2, '2017-12-17 19:02:07', 0, 1, 'fdsafdsfs', '52.221674677104176;21.363591664062483', 1, 0, 0, 'Okuniewska 50, 05-074 Halinów, Poland', 1),
(11, 3, 1, '2017-12-17 20:52:00', 2, '2017-12-17 21:54:13', 0, 1, 'fdsafsadfd', '52.18801035776798;21.581944935546858', 2, 1, 3, 'Mińsk Mazowiecki', 1),
(12, 3, 1, '2017-12-30 20:58:00', 2, '2017-12-17 21:59:16', 0, 1, 'ffsafsdaf', '52.056475712915734;23.154363148437483', 3, 3, 3, 'Grabanów-Kolonia', 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_type`
--

CREATE TABLE `event_type` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_type`
--

INSERT INTO `event_type` (`id`, `name`) VALUES
(1, 'Football'),
(2, 'Running'),
(3, 'Bike'),
(4, 'Basketball');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `name`, `slug`, `active`) VALUES
(1, 'dolnośląskie', 'dolnoslaskie', 1),
(2, 'kujawsko-pomorskie', 'kujawsko-pomorskie', 1),
(3, 'lubelskie', 'lubelskie', 1),
(4, 'lubuskie', 'lubuskie', 1),
(5, 'mazowieckie', 'mazowieckie', 1),
(6, 'małopolskie', 'malopolskie', 1),
(7, 'opolskie', 'opolskie', 1),
(8, 'podkarpackie', 'podkarpackie', 1),
(9, 'podlaskie', 'podlaskie', 1),
(10, 'pomorskie', 'pomorskie', 1),
(11, 'śląskie', 'slaskie', 1),
(12, 'świętokrzyskie', 'swietokrzyskie', 1),
(13, 'warmińsko-mazurskie', 'warminsko-mazurskie', 1),
(14, 'wielkopolskie', 'wielkopolskie', 1),
(15, 'zachodniopomorskie', 'zachodniopomorskie', 1),
(16, 'łódzkie', 'lodzkie', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(3, 'a', '0cc175b9c0f1b6a831c399e269772661', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_type` (`event_type`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `event_type`
--
ALTER TABLE `event_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `event_type`
--
ALTER TABLE `event_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `event_ibfk_2` FOREIGN KEY (`event_type`) REFERENCES `event_type` (`id`),
  ADD CONSTRAINT `event_ibfk_3` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
