-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 03, 2018 at 10:13 PM
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
  `day_start` date DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `time_start` varchar(10) DEFAULT NULL,
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

INSERT INTO `event` (`id`, `user_id`, `public`, `day_start`, `duration`, `time_start`, `cyclic`, `active`, `description`, `location`, `event_type`, `people_min`, `people_max`, `town`, `region_id`) VALUES
(1, 3, 0, '2017-12-16', 0, '00:00:00', 0, 1, 'drewqrwqer', '53.379;14.600', 1, 0, 0, '', 1),
(2, 3, 1, '2017-12-17', 0, '00:00:00', 1, 1, 'fafasfsadf', '53.92058973356862;14.43949661254885', 1, 0, 0, 'Nowomyśliwska 74, 72-500 Międzyzdroje, Poland', 15),
(3, 3, 0, '2017-12-17', 0, '00:00:00', 0, 1, 'fdasf dsaf', '53.379;14.6', 1, 0, 3, 'Księżnej Anny, 70-671 Szczecin, Poland', 1),
(4, 3, 0, '2017-12-17', 0, '00:00:00', 0, 1, 'fdsafsdfasf', '52.91777627162588;17.148828125000023', 4, 0, 0, 'Żoń 3, 64-832 Żoń, Poland', 1),
(5, 3, 0, '2017-12-17', 0, '00:00:00', 0, 1, 'fsafsdafsa d', '52.99140916108877;16.908502197265648', 1, 1, 2, 'Łąkowa 13, 64-800 Chodzież, Poland', 1),
(6, 3, 1, '2017-12-17', 4, '00:00:00', 0, 1, 'fdfafafasdf', '52.214943853505886;21.171330921874983', 1, 0, 1, 'Zambrowska 5-7, 04-642 Warszawa, Poland', 1),
(7, 3, 1, '2017-12-17', 0, '00:00:00', 0, 1, 'Desc', '52.23239981898375;21.124639027343733', 1, 0, 0, 'Ostrobramska, 04-041 Warszawa, Poland', 1),
(8, 3, 1, '2017-12-17', 0, '00:00:00', 0, 1, 'uyytuytu tyy', '52.231769;21.006536', 1, 0, 0, 'Pałac Kultury i Nauki, plac Defilad 1, 00-901 Warszawa, Poland', 1),
(9, 3, 1, '2017-12-17', 5, '00:00:00', 0, 1, 'gfgfsdg dfsg ', '52.231769;21.006536', 1, 0, 0, 'Pałac Kultury i Nauki, plac Defilad 1, 00-901 Warszawa, Poland', 1),
(10, 3, 1, '2017-12-30', 2, '00:00:00', 0, 1, 'fdsafdsfs', '52.221674677104176;21.363591664062483', 1, 0, 0, 'Okuniewska 50, 05-074 Halinów, Poland', 1),
(11, 3, 1, '2017-12-17', 2, '00:00:00', 0, 1, 'fdsafsadfd', '52.18801035776798;21.581944935546858', 2, 1, 3, 'Mińsk Mazowiecki', 1),
(12, 3, 1, '2017-12-30', 2, '00:00:00', 0, 1, 'ffsafsdaf', '52.056475712915734;23.154363148437483', 3, 3, 3, 'Grabanów-Kolonia', 1),
(13, 3, 1, '2017-12-20', 1, '00:00:00', 0, 1, 'fasfsadf', '53.413394938722185;14.546575062499983', 4, 0, 0, 'Kolumba 60A, Szczecin, Poland', 15),
(14, 3, 1, '2017-12-19', 2, '00:00:00', 0, 1, 'vvxvxzcv', '53.437943825179005;14.550008290039045', 3, 0, 0, 'Mieczysława Niedziałkowskiego 4, Szczecin, Poland', 15),
(15, 3, 1, '2017-12-20', 1, '00:00:00', 0, 1, 'Description', '53.12923611551213;23.207788085937523', 1, 0, 0, 'zaułek Podlaski, 15-001 Białystok, Poland', 9),
(16, 3, 1, '2017-12-20', 1, '00:00:00', 0, 1, 'fsafsa fas f', '50.0572770345513;19.97618150018309', 1, 0, 0, 'Bajeczna 12, 31-566 Kraków, Poland', 6),
(17, 3, 1, '2017-12-20', 1, '00:00:00', 0, 1, 'gfdsgfdg sdg', '54.33586951070905;18.67979478143309', 4, 0, 0, 'Żurawia 13, 80-731 Gdańsk, Poland', 10),
(18, 3, 1, '2017-12-21', 1, '00:00:00', 0, 1, 'ffsfsdf', '53.46640022158186;14.591056816802961', 3, 1, 0, 'Strzałowska 27A, Szczecin, Poland', 15),
(19, 4, 1, '2017-12-23', 1, '00:00:00', 0, 1, 'fdafsdf', '52.41511634707683;16.937088482604963', 1, 0, 0, 'Północna 2, Poznań, Poland', 14),
(20, 4, 1, '2017-12-23', 1, '00:00:00', 0, 1, 'test', '53.42930218830626;14.614853375183088', 1, 1, 12, 'Górnośląska 6, Szczecin, Poland', 15),
(21, 4, 1, '2017-12-24', 5, '00:00:00', 0, 0, 'dsfadf safds fd', '50.240316615205586;19.05332993768309', 4, 3, 4, 'Górnośląska, Katowice, Poland', 11),
(22, 4, 1, '2017-12-25', 1, '00:00:00', 0, 1, 'Squash', '52.234660180064594;21.00889634393309', 5, 1, 1, 'Marszałkowska 132, 00-008 Warszawa, Poland', 6),
(23, 5, 1, '2017-12-25', 1, '00:00:00', 0, 1, 'fafsafs f', '52.234660180064594;21.00889634393309', 1, 10, 12, 'Marszałkowska 132, 00-008 Warszawa, Poland', 6),
(24, 5, 1, '2017-12-25', 1, '00:00:00', 0, 1, 'gfdhdfhfgdh', '51.937624857087606;15.526718609558088', 1, 0, 6, 'Władysława IV 20, Zielona Góra', 4),
(26, 21, 1, '2018-01-02', 1, '00:00:00', 0, 1, 'afsafasf', '51.74757195949175;19.49278306268309', 1, 1, 5, 'Przybyszewskiego 149A, Łódź', 16),
(27, 4, 1, '2018-01-03', 1, '17:01:00', 0, 1, 'fsafsaf', '52.234660180064594;21.00889634393309', 1, 0, 0, 'Marszałkowska 132, 00-008 Warszawa', 6),
(28, 4, 1, '2018-01-10', 1, '17:00', 0, 1, 'fgdsfg', '52.234660180064594;21.00889634393309', 1, 0, 0, 'Marszałkowska 132, 00-008 Warszawa', 6);

-- --------------------------------------------------------

--
-- Table structure for table `event_enroll`
--

CREATE TABLE `event_enroll` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_enroll`
--

INSERT INTO `event_enroll` (`event_id`, `user_id`, `status`, `time`) VALUES
(1, 4, 1, '2017-12-24 14:46:38'),
(2, 4, 1, '2017-12-24 16:48:45'),
(2, 5, 1, '2017-12-24 14:47:34'),
(6, 4, 1, '2017-12-24 14:46:38'),
(7, 5, 1, '2017-12-24 14:46:38'),
(9, 4, 1, '2017-12-24 14:48:38'),
(9, 5, 1, '2017-12-24 15:01:15'),
(11, 4, 1, '2017-12-24 14:46:38'),
(19, 5, 1, '2017-12-24 16:00:49'),
(20, 4, 1, '2017-12-24 14:46:38'),
(21, 4, 1, '2017-12-24 14:46:38'),
(22, 4, 1, '2017-12-25 16:58:27'),
(24, 5, 1, '2017-12-25 18:10:10'),
(26, 21, 1, '2018-01-02 11:08:07');

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
(4, 'Basketball'),
(5, 'Squash');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `coords` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `region` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'Dolnośląskie', 'dolnoslaskie', 1),
(2, 'Kujawsko-pomorskie', 'kujawsko-pomorskie', 1),
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
(15, 'Zachodniopomorskie', 'zachodniopomorskie', 1),
(16, 'łódzkie', 'lodzkie', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fb_id` varchar(100) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `coords` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fb_id`, `token`, `username`, `password`, `email`, `name`, `surname`, `role`, `coords`, `address`, `region_id`) VALUES
(3, '', 'ef2bae3028f20ca4f805a2b036908841', 'a', '0cc175b9c0f1b6a831c399e269772661', '', '', '', 1, '52.234660180064594;21.00889634393309', 'Marszałkowska 132, 00-008 Warszawa', 6),
(4, '', '', 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '', '', 1, '52.234660180064594;21.00889634393309', 'Marszałkowska 132, 00-008 Warszawa', 6),
(5, '', '', 'test', '7491dc619808ca98650b5e81ff2ce68f', 'test2@test.pl', '', '', 0, '53.42930218830626;14.592880718933088', 'Logistyczna, 71-001 Szczecin', 15),
(19, NULL, 'b40ebfc7dbfe2a54e10f5166421ca78a', 'b', '92eb5ffee6ae2fec3ad71c777531578f', 'test@test.pl', '', '', 0, NULL, NULL, NULL),
(21, '2090968321132718', '', 'rafal', NULL, 'rafal@jaskurzynski.pl', 'Rafal', 'Jaskurzynski', 1, NULL, NULL, NULL);

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
-- Indexes for table `event_enroll`
--
ALTER TABLE `event_enroll`
  ADD UNIQUE KEY `event_id` (`event_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `event_type`
--
ALTER TABLE `event_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
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

--
-- Constraints for table `event_enroll`
--
ALTER TABLE `event_enroll`
  ADD CONSTRAINT `event_enroll_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `event_enroll_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
