-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 09, 2024 alle 18:15
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warehouse_manager`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `categories_1`
--

CREATE TABLE `categories_1` (
  `id` int(11) NOT NULL,
  `description` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `categories_1`
--

INSERT INTO `categories_1` (`id`, `description`) VALUES
(1, 'Armi nucleari'),
(2, '9mm'),
(3, 'armi bianche'),
(4, 'motori a scoppio');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(64) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `name`) VALUES
(1, 'v', '9e3669d19b675bd57058fd4664205d2a', 'Eri il fico volpe');

-- --------------------------------------------------------

--
-- Struttura della tabella `warehouse_1`
--

CREATE TABLE `warehouse_1` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `code` int(19) NOT NULL,
  `qty` int(6) NOT NULL,
  `img` varchar(32) NOT NULL,
  `location` varchar(64) NOT NULL,
  `category` int(11) NOT NULL,
  `isPublic` tinyint(1) NOT NULL,
  `isStock` tinyint(1) NOT NULL,
  `aStock` int(10) UNSIGNED DEFAULT NULL,
  `minimum` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `warehouse_1`
--

INSERT INTO `warehouse_1` (`id`, `name`, `code`, `qty`, `img`, `location`, `category`, `isPublic`, `isStock`, `aStock`, `minimum`) VALUES
(1, 'beretta', 1233312312, 3, 'awdwd', 'awdawdssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', 0, 0, 0, NULL, NULL),
(2, 'falce', 22222, 33, 'awdwdaa', 'awdssssaaaaa', 1, 0, 0, NULL, NULL),
(3, 'm4', 0, 0, '', '', 2, 0, 0, NULL, NULL),
(4, 'ak-47', 2147483647, 4, 'root/dada/dwrf.jpg', 'dwdwdwdwdwdwdwdwdwdwdwdwd', 2, 0, 0, NULL, NULL);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `categories_1`
--
ALTER TABLE `categories_1`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `warehouse_1`
--
ALTER TABLE `warehouse_1`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `categories_1`
--
ALTER TABLE `categories_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `warehouse_1`
--
ALTER TABLE `warehouse_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
