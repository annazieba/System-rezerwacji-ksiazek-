-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 05 Lut 2019, 12:00
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
-- Struktura tabeli dla tabeli `ksiazki`
--

CREATE TABLE `ksiazki` (
  `id` int(11) NOT NULL,
  `tytul` text COLLATE utf8_polish_ci NOT NULL,
  `autor` text COLLATE utf8_polish_ci NOT NULL,
  `gatunek` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `ksiazki`
--

INSERT INTO `ksiazki` (`id`, `tytul`, `autor`, `gatunek`) VALUES
(1, 'Pan Tadeusz', 'Adam Mickiewicz', 'Klasyka'),
(2, 'Dziady', 'Adam Mickiewicz', 'Klasyka'),
(3, 'Quo vadis', 'Henryk Sienkiewicz', 'Klasyka'),
(4, 'Chlopi', 'Wladyslaw Reymont', 'Klasyka'),
(5, 'Lalka', 'Boleslaw Prus', 'Klasyka'),
(6, 'Potop', 'Henryk Sienkiewicz', 'Klasyka'),
(7, 'Zbrodnia i kara', 'Fiodor Dostojewski', 'Klasyka'),
(9, 'Lokomotywa', 'Julian Tuwim', 'Dla dzieci'),
(10, 'Przypadki Robinsona Crusoe', 'Daniel Defoe', 'Przygodowe'),
(11, 'Za zamknietymi drzwiami', 'B. A. Paris', 'Thriller'),
(12, 'Nie mow nikomu', 'Harlan Coben', 'Kryminal'),
(13, 'Kwiat pustyni', 'Waris Dirie', 'Biograficzne'),
(14, 'Schronienie', 'Harlan Coben', 'Kryminal'),
(15, 'Dzieci z Bulerbyn', 'Astrid Lindgren', 'Dla dzieci'),
(16, 'Nad Niemnem', 'Eliza Orzeszkowa', 'Klasyka'),
(17, 'Detektyw Pozytywka', 'Grzegorz Kasdepke', 'Dla dzieci'),
(18, 'Pinokio', 'Carlo Collodi', 'Dla dzieci'),
(19, 'Klamczucha ', 'Malgorzata Musierowicz', 'Dla dzieci'),
(20, 'Sny wojenne', 'Marek Harny', 'Kryminalne'),
(21, 'To co zostawila', 'Ellen Marie Wiseman', 'Thriller'),
(22, 'W cieniu prawa', 'Remigiusz Mroz', 'Kryminalne'),
(23, 'Wieza jaskolki', 'Sapkowski', 'Fantasy');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `ksiazki`
--
ALTER TABLE `ksiazki`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `ksiazki`
--
ALTER TABLE `ksiazki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
