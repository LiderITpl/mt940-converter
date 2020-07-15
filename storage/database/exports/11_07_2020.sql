-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 11 Lip 2020, 15:33
-- Wersja serwera: 10.4.13-MariaDB
-- Wersja PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bank_statements`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `statements`
--

CREATE TABLE `statements` (
  `id` int(11) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `startPrice` decimal(10,2) NOT NULL,
  `endPrice` decimal(10,2) NOT NULL,
  `startTimestamp` timestamp NULL DEFAULT NULL,
  `endTimestamp` timestamp NULL DEFAULT NULL,
  `number` int(12) NOT NULL,
  `currency` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `statement_number` int(8) DEFAULT NULL,
  `account` varchar(255) NOT NULL,
  `accountName` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `debitcredit` varchar(255) NOT NULL,
  `cancellation` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `valueTimestamp` timestamp NULL DEFAULT NULL,
  `entryTimestamp` timestamp NULL DEFAULT NULL,
  `transactionCode` varchar(255) NOT NULL,
  `currency` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `statements`
--
ALTER TABLE `statements`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `statements`
--
ALTER TABLE `statements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT dla tabeli `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
