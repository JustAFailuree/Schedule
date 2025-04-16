-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2025 at 12:19 PM
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
  `class_name` varchar(255) DEFAULT NULL,
  `Data_zajec` date NOT NULL,
  `Godzina_rozpoczecia` time NOT NULL,
  `Godzina_zakonczenia` time NOT NULL,
  `Typ_zajec` varchar(30) NOT NULL,
  `id_kierunku` int(11) NOT NULL,
  `budynek` varchar(255) NOT NULL,
  `numer_sali` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_ID`, `class_name`, `Data_zajec`, `Godzina_rozpoczecia`, `Godzina_zakonczenia`, `Typ_zajec`, `id_kierunku`, `budynek`, `numer_sali`) VALUES
(1, 'nazwa klasy', '2025-04-12', '09:15:00', '11:30:00', 'Wykład', 1, 'Wydział Inżynieri', 'Sala W13');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kierunki`
--

CREATE TABLE `kierunki` (
  `id_kierunku` int(11) NOT NULL,
  `nazwa_kierunku` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kierunki`
--

INSERT INTO `kierunki` (`id_kierunku`, `nazwa_kierunku`) VALUES
(1, 'Informatyka'),
(3, 'Nazwa Robocza');

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
  `Rola` char(1) NOT NULL DEFAULT 'U',
  `rok_studiow` int(11) DEFAULT NULL,
  `id_kierunku` int(11) NOT NULL,
  `tytul_naukowy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `Nazwa`, `Haslo`, `Imie`, `Nazwisko`, `Email`, `Telefon`, `Miasto`, `Ulice`, `Numer_mieszkania`, `Rola`, `rok_studiow`, `id_kierunku`, `tytul_naukowy`) VALUES
(1, 'Janek', '1234', 'Janek', 'Jankowski', 'test@example.com', 123456789, 'Jarosław', 'Jana Pwała 2', 34, 'W', NULL, 1, 'Dr'),
(6, 'ngga', 'ngga', 'kuba', 'plcu', 'kuba@wp.pl', 123123123, 'przeworsk', 'debow', 123, 'U', 2, 1, '-'),
(7, 'dfg', 'dfg', 'dfg', 'dfg', 'dfgdfg@wp.pl', 123123123, 'sdfgsdgf', 'sdgsdg', 5, 'A', 2, 3, '-');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_ID`),
  ADD KEY `klasy-kierunki` (`id_kierunku`);

--
-- Indeksy dla tabeli `kierunki`
--
ALTER TABLE `kierunki`
  ADD PRIMARY KEY (`id_kierunku`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`),
  ADD KEY `uzytkownicy-kierunki` (`id_kierunku`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kierunki`
--
ALTER TABLE `kierunki`
  MODIFY `id_kierunku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
