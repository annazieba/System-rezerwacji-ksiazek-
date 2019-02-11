-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 05 Lut 2019, 11:59
-- Wersja serwera: 10.1.28-MariaDB
-- Wersja PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `biblioteka`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `czytelnicy`
--

CREATE TABLE `czytelnicy` (
  `id` int(11) NOT NULL,
  `imie` text COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `rezerwacje` text COLLATE utf8_polish_ci NOT NULL,
  `user` text COLLATE utf8_polish_ci NOT NULL,
  `pass` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `czytelnicy`
--

INSERT INTO `czytelnicy` (`id`, `imie`, `nazwisko`, `email`, `rezerwacje`, `user`, `pass`) VALUES
(1, 'Maria', 'Nowak', 'marianowak@gmail.com', '6 - Potop', 'marysia', '$2y$10$j6Xv.cjH0/hmUd0ecSaACOJN362sKNEBmoKjtKIbSCers5JWEfSWq'),
(2, 'Jan', 'Kowalski', 'jkowalski@gmail.com', '', 'janek', 'asdfg'),
(3, 'Alicja', 'Borowska', 'aborowska@gmail.com', '', 'ala', 'zxcv'),
(4, 'Joanna', 'Mazur', 'janam@gmail.com', '', 'asia', '$2y$10$HJSgnx/oh2J0AdSOJCl6xuemAxjYQTBbrWhjANODZC29b6wR/Skba'),
(5, 'Adrianna', 'Jaworska', 'ajaworska@gmail.com', '', 'ada', '$2y$10$3oAUvmPuIL01.iafT5VFnuPrRgjN0iSBV8VOUG5lEIRvaMKrlzoRu');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `czytelnicy`
--
ALTER TABLE `czytelnicy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `czytelnicy`
--
ALTER TABLE `czytelnicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
