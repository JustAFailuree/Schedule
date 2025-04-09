-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2025 at 12:29 PM
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
-- Struktura tabeli dla tabeli `users`
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
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_ID`) REFERENCES `groups` (`group_ID`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`kierunek_name`) REFERENCES `year_classes` (`Kierunek_name`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`user_ID`) REFERENCES `classes` (`user_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
