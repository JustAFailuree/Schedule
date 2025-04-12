-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2025 at 04:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ussos`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_ID` int(11) NOT NULL,
  `user_ID` int(5) NOT NULL,
  `class_name` varchar(255) DEFAULT NULL,
  `Data_zajec` date NOT NULL,
  `Godzina_rozpoczecia` time NOT NULL,
  `Godzina_zakonczenia` time NOT NULL,
  `Typ_zajec` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kierunki`
--

CREATE TABLE `kierunki` (
  `id_kierunku` int(11) NOT NULL,
  `nazwa_kierunku` varchar(50) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `id_class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `Nazwa` varchar(25) NOT NULL,
  `Haslo` varchar(25) NOT NULL,
  `Imie` varchar(255) NOT NULL,
  `Nazwisko` varchar(255) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telefon` int(10) NOT NULL,
  `Miasto` varchar(50) NOT NULL,
  `Ulice` varchar(50) NOT NULL,
  `Numer_mieszkania` int(11) NOT NULL,
  `kierunek_name` varchar(255) DEFAULT NULL,
  `Rola` char(1) NOT NULL DEFAULT 'U',
  `group_ID` int(11) DEFAULT NULL,
  `rok_studiow` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `Nazwa`, `Haslo`, `Imie`, `Nazwisko`, `Email`, `Telefon`, `Miasto`, `Ulice`, `Numer_mieszkania`, `kierunek_name`, `Rola`, `group_ID`, `rok_studiow`) VALUES
(1, 'ngga', 'ngga', 'kubus', 'bolec', 'wsadzambolec@123.koks.com', 696969696, 'kapusniak', 'balls', 69, 'gooner', 'U', NULL, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_ID`);

--
-- Indexes for table `kierunki`
--
ALTER TABLE `kierunki`
  ADD PRIMARY KEY (`id_kierunku`),
  ADD KEY `kierunki-uzytkownicy` (`id_uzytkownika`),
  ADD KEY `kierunki-classes` (`id_class`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kierunki`
--
ALTER TABLE `kierunki`
  ADD CONSTRAINT `kierunki-classes` FOREIGN KEY (`id_class`) REFERENCES `classes` (`class_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kierunki-uzytkownicy` FOREIGN KEY (`id_uzytkownika`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
