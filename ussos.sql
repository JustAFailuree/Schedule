-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2025 at 11:10 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

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
-- Struktura tabeli dla tabeli `classes`
--

CREATE TABLE `classes` (
  `class_ID` int(11) NOT NULL,
  `user_ID` int(5) NOT NULL,
  `class_name` varchar(255) DEFAULT NULL,
  `Data_zajec` date NOT NULL,
  `Godzina_rozpoczecia` time NOT NULL,
  `Godzina_zakonczenia` time NOT NULL,
  `kierunek_name` varchar(255) DEFAULT NULL,
  `Typ_zajec` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `groups`
--

CREATE TABLE `groups` (
  `group_ID` int(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `group_classes`
--

CREATE TABLE `group_classes` (
  `group_ID` int(11) NOT NULL,
  `class_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `Login` varchar(25) NOT NULL,
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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_groups`
--

CREATE TABLE `user_groups` (
  `user_ID` int(11) NOT NULL,
  `group_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `year_classes`
--

CREATE TABLE `year_classes` (
  `Kierunek_name` varchar(255) NOT NULL,
  `class_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_ID`),
  ADD KEY `wykladowca_ID` (`user_ID`);

--
-- Indeksy dla tabeli `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_ID`);

--
-- Indeksy dla tabeli `group_classes`
--
ALTER TABLE `group_classes`
  ADD PRIMARY KEY (`group_ID`,`class_ID`),
  ADD KEY `class_ID` (`class_ID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`),
  ADD KEY `group_ID` (`group_ID`),
  ADD KEY `Kierunek_name` (`kierunek_name`);

--
-- Indeksy dla tabeli `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`user_ID`),
  ADD KEY `group_ID` (`group_ID`);

--
-- Indeksy dla tabeli `year_classes`
--
ALTER TABLE `year_classes`
  ADD PRIMARY KEY (`Kierunek_name`,`class_ID`),
  ADD KEY `class_ID` (`class_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `group_classes`
--
ALTER TABLE `group_classes`
  ADD CONSTRAINT `group_classes_ibfk_1` FOREIGN KEY (`group_ID`) REFERENCES `groups` (`group_ID`),
  ADD CONSTRAINT `group_classes_ibfk_2` FOREIGN KEY (`class_ID`) REFERENCES `classes` (`class_ID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_ID`) REFERENCES `groups` (`group_ID`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`kierunek_name`) REFERENCES `year_classes` (`Kierunek_name`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`user_ID`) REFERENCES `classes` (`user_ID`);

--
-- Constraints for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD CONSTRAINT `user_groups_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`),
  ADD CONSTRAINT `user_groups_ibfk_2` FOREIGN KEY (`group_ID`) REFERENCES `groups` (`group_ID`);

--
-- Constraints for table `year_classes`
--
ALTER TABLE `year_classes`
  ADD CONSTRAINT `year_classes_ibfk_1` FOREIGN KEY (`class_ID`) REFERENCES `classes` (`class_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
