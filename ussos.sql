-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2025 at 04:20 PM
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
  `class_name` varchar(255) DEFAULT NULL,
  `Data_zajec` date NOT NULL,
  `Godzina_rozpoczecia` time NOT NULL,
  `Godzina_zakonczenia` time NOT NULL,
  `Typ_zajec` varchar(30) NOT NULL,
  `id_kierunku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kierunki`
--

CREATE TABLE `kierunki` (
  `id_kierunku` int(11) NOT NULL,
  `nazwa_kierunku` varchar(50) NOT NULL
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
  `Rola` char(1) NOT NULL DEFAULT 'U',
  `rok_studiow` int(11) DEFAULT NULL,
  `id_kierunku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_ID`),
  ADD KEY `klasy-kierunki` (`id_kierunku`);

--
-- Indexes for table `kierunki`
--
ALTER TABLE `kierunki`
  ADD PRIMARY KEY (`id_kierunku`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`),
  ADD KEY `uzytkownicy-kierunki` (`id_kierunku`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `klasy-kierunki` FOREIGN KEY (`id_kierunku`) REFERENCES `kierunki` (`id_kierunku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `uzytkownicy-kierunki` FOREIGN KEY (`id_kierunku`) REFERENCES `kierunki` (`id_kierunku`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
