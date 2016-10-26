-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 18 okt 2016 om 15:33
-- Serverversie: 10.1.9-MariaDB
-- PHP-versie: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lifestyle2`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `habit1` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `habit2` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `habit3` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `first_name`, `last_name`, `habit1`, `habit2`, `habit3`, `created_at`, `updated_at`) VALUES
(1, 5, 'Jonas', 'Stams', 'Niet Roken', '1L water drinken', '1km wandelen', '2016-10-18 13:22:23', '0000-00-00 00:00:00'),
(2, 6, 'Vincent', 'Ravoet', 'Minder studeren', 'Meer zuipen', 'Langer slapen', '2016-10-18 13:25:46', '0000-00-00 00:00:00'),
(3, 7, 'Pieter', 'Bollen', 'Meer studeren', 'Minder zuipen', 'Minder slapen', '2016-10-18 13:26:22', '0000-00-00 00:00:00');

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
(1, 1, '2016-10-18 13:31:23', '0000-00-00 00:00:00', 0, 1, 1, 67, 500, 'No information given.'),
(2, 2, '2016-10-18 13:32:01', '0000-00-00 00:00:00', 0, 1, 1, 75, 700, 'No information given.'),
(3, 3, '2016-10-18 13:32:32', '0000-00-00 00:00:00', 0, 0, 1, 75, 700, 'No information given.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `rolesString` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `rolesString`) VALUES
(1, 'admin1', '$2y$13$1OhkMUBwLcmGWTccoBjEpO.s7eDserRh04Q.MGBG39pZhCF1CMzNS', 'ROLE_ADMIN ROLE_COACH'),
(2, 'admin2', '$2y$13$moF7x2WAVVu7tj19.4TvE.FCmMU50J3AL.yh8UmY.gObCBZQOOIrS', 'ROLE_ADMIN ROLE_COACH'),
(3, 'coach1', '$2y$13$3vEFVTvEFhYxzS6gyoKr3Ogk4YeRIbi7HZN393Ck3rpiL4QRIaQcm', 'ROLE_COACH'),
(4, 'coach2', '$2y$13$FUfGo.Fpzt5Gs48jYBS1COWffVxUAtZp9RpnClQodx4G.2aaWdMte', 'ROLE_COACH'),
(5, 'jonasstams', '$2y$13$bMCIMobjCKR/uNxOn34MRO6PpuqWqJ5E0AUvdvEx.6I7Rbf.r04BG', 'ROLE_CUSTOMER'),
(6, 'vincentravoet', '$2y$13$EzJ/I5gwupVwDVGBl.Doqe4JyqK5qQPgDVxMkMTx5xvi9DYsZQdoG', 'ROLE_CUSTOMER'),
(7, 'pieterbollen', '$2y$13$sgI/y/2HVJ3zyJ5fWSJS6OAdA43.B94XczQOeF4.fzgdVqFAF.CX2', 'ROLE_CUSTOMER');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`),
  ADD KEY `user_id_3` (`user_id`);

--
-- Indexen voor tabel `daily_report`
--
ALTER TABLE `daily_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_451140289395C3F3` (`customer_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `daily_report`
--
ALTER TABLE `daily_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `daily_report`
--
ALTER TABLE `daily_report`
  ADD CONSTRAINT `FK_451140289395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
