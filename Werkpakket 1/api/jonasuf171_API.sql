-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: 10.3.1.195
-- Gegenereerd op: 07 nov 2016 om 15:32
-- Serverversie: 5.6.29
-- PHP-versie: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jonasuf171_API`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `habit1` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `habit2` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `habit3` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `profile_picture_url` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `habit1`, `habit2`, `habit3`, `profile_picture_url`, `created_at`, `updated_at`) VALUES
(1, 'Jonas', 'Stams', 'joggen', 'fietsen', 'yoga', 'http://jonasstams.be/api/public/images/profile-pics/jonasstams.jpg', '2016-10-18 13:22:23', '2016-11-07 10:23:13'),
(2, 'Vincent', 'Ravoet', 'zwemmen met zwembandjes', 'fietsen', 'lopen', '', '2016-10-18 13:25:46', '2016-11-03 14:23:26'),
(3, 'Pieter', 'Bollen', 'Stoppen met roken', 'Minder zuipen', 'Meer slapen', '', '2016-10-18 13:26:22', '2016-10-25 08:34:19'),
(5, 'Jan', 'Willekens', 'varen', 'fietsen', 'wandelen', '', '2016-10-25 17:27:24', '0000-00-00 00:00:00'),
(6, 'Tom', 'Schuyten', 'bijen voeren', 'fietsen', 'wandelen', '', '2016-10-26 08:23:23', '0000-00-00 00:00:00'),
(14, 'Jan', 'Willekens', 'varen', 'fietsen', 'wandelen', '', '2016-11-07 10:21:37', '0000-00-00 00:00:00'),
(15, 'jeffrey', 'van den heuvel', 'notariaat', 'klimmen', 'wandelen', '', '2016-11-07 10:22:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `daily_report`
--

CREATE TABLE `daily_report` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `habit1_done` tinyint(1) NOT NULL,
  `habit2_done` tinyint(1) NOT NULL,
  `habit3_done` tinyint(1) NOT NULL,
  `weight` double NOT NULL,
  `calories` double NOT NULL,
  `extra_information` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `daily_report`
--

INSERT INTO `daily_report` (`id`, `customer_id`, `created_at`, `updated_at`, `habit1_done`, `habit2_done`, `habit3_done`, `weight`, `calories`, `extra_information`) VALUES
(1, 1, '2016-10-18 13:31:23', '2016-10-26 10:02:14', 0, 0, 0, 50, 500, 'No information given.'),
(2, 2, '2016-10-18 13:32:01', '2016-10-18 13:25:11', 0, 1, 1, 63, 700, 'No information given.'),
(3, 3, '2016-10-18 13:32:32', '0000-00-00 00:00:00', 0, 0, 1, 75, 700, 'No information given.'),
(4, 2, '2016-10-20 10:09:59', '0000-00-00 00:00:00', 1, 1, 1, 63.2, 500, 'No information given.'),
(5, 2, '2016-10-20 10:10:13', '0000-00-00 00:00:00', 1, 0, 0, 63.2, 700, 'No information given.'),
(6, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 1, 50, 500, 'No information given'),
(7, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 1, 50, 500, 'No information given'),
(8, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0, 1, 50, 500, 'No information given'),
(9, 1, '1970-01-01 00:00:18', '0000-00-00 00:00:00', 1, 0, 1, 50, 500, 'No information given'),
(10, 1, '1970-01-01 00:00:18', '0000-00-00 00:00:00', 1, 0, 1, 50, 500, 'No information given'),
(11, 1, '2017-06-09 22:00:00', '0000-00-00 00:00:00', 1, 0, 1, 50, 500, 'No information given'),
(12, 1, '2016-10-19 22:00:00', '0000-00-00 00:00:00', 1, 0, 1, 50, 500, 'No information given'),
(13, 1, '2016-10-24 22:00:00', '0000-00-00 00:00:00', 1, 0, 1, 50, 500, 'No information given'),
(20, 1, '2016-10-25 22:00:00', '0000-00-00 00:00:00', 1, 0, 1, 50, 500, 'No information given'),
(21, 2, '2016-10-25 22:00:00', '0000-00-00 00:00:00', 1, 0, 1, 50, 500, 'No information given'),
(22, 2, '2016-10-24 22:00:00', '0000-00-00 00:00:00', 1, 0, 1, 50, 500, 'No information given'),
(23, 2, '2016-10-26 22:00:00', '0000-00-00 00:00:00', 1, 0, 1, 50, 500, 'No information given'),
(24, 2, '2016-10-27 22:00:00', '0000-00-00 00:00:00', 1, 1, 1, 55, 550, 'No information given'),
(26, 2, '2016-11-02 23:00:00', '0000-00-00 00:00:00', 1, 1, 0, 500, 500, 'No information given'),
(27, 2, '2016-11-03 23:00:00', '0000-00-00 00:00:00', 1, 1, 0, 50, 50, 'No information given'),
(28, 2, '2016-11-06 23:00:00', '0000-00-00 00:00:00', 1, 1, 1, 50, 500, 'No information given');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `daily_report`
--
ALTER TABLE `daily_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_451140289395C3F3` (`customer_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT voor een tabel `daily_report`
--
ALTER TABLE `daily_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `daily_report`
--
ALTER TABLE `daily_report`
  ADD CONSTRAINT `FK_451140289395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
