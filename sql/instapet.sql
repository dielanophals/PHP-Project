-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 11 mei 2019 om 16:59
-- Serverversie: 10.1.38-MariaDB
-- PHP-versie: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testddd`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user1_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `likes_comments`
--

CREATE TABLE `likes_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `likes_post`
--

CREATE TABLE `likes_post` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts_color`
--

CREATE TABLE `posts_color` (
  `id` int(11) NOT NULL,
  `posts_id` int(11) NOT NULL,
  `red` int(11) NOT NULL,
  `orange` int(11) NOT NULL,
  `yellow` int(11) NOT NULL,
  `green` int(11) NOT NULL,
  `turquoise` int(11) NOT NULL,
  `blue` int(11) NOT NULL,
  `purple` int(11) NOT NULL,
  `pink` int(11) NOT NULL,
  `white` int(11) NOT NULL,
  `gray` int(11) NOT NULL,
  `black` int(11) NOT NULL,
  `brown` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `posts_color`
--

INSERT INTO `posts_color` (`id`, `posts_id`, `red`, `orange`, `yellow`, `green`, `turquoise`, `blue`, `purple`, `pink`, `white`, `gray`, `black`, `brown`, `active`) VALUES
(1, 1, 0, 44, 0, 3, 0, 0, 3, 6, 3, 16, 3, 22, 1),
(2, 2, 0, 3, 0, 5, 0, 0, 3, 15, 25, 38, 3, 10, 1),
(3, 3, 18, 4, 0, 0, 0, 0, 4, 0, 0, 0, 59, 14, 1),
(4, 4, 18, 4, 0, 0, 0, 0, 4, 0, 0, 0, 59, 14, 1),
(5, 5, 0, 0, 0, 0, 3, 0, 3, 0, 0, 48, 48, 0, 1),
(6, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 80, 10, 1),
(7, 7, 0, 5, 0, 0, 0, 0, 0, 15, 5, 60, 5, 10, 1),
(8, 8, 0, 0, 0, 6, 0, 9, 0, 0, 0, 38, 47, 0, 1),
(9, 9, 6, 38, 3, 0, 13, 6, 0, 6, 0, 6, 0, 22, 1),
(10, 10, 0, 0, 0, 0, 7, 82, 4, 4, 0, 0, 4, 0, 1),
(11, 11, 0, 0, 0, 6, 0, 9, 0, 0, 0, 38, 47, 0, 1),
(12, 12, 0, 44, 0, 3, 0, 0, 3, 6, 3, 16, 3, 22, 1),
(13, 13, 0, 44, 0, 3, 0, 0, 3, 6, 3, 16, 3, 22, 1),
(14, 14, 0, 44, 0, 3, 0, 0, 3, 6, 3, 16, 3, 22, 1),
(15, 15, 0, 44, 0, 3, 0, 0, 3, 6, 3, 16, 3, 22, 1),
(16, 16, 0, 44, 0, 3, 0, 0, 3, 6, 3, 16, 3, 22, 1),
(17, 17, 0, 44, 0, 3, 0, 0, 3, 6, 3, 16, 3, 22, 1),
(18, 18, 0, 44, 0, 3, 0, 0, 3, 6, 3, 16, 3, 22, 1),
(19, 19, 0, 44, 0, 3, 0, 0, 3, 6, 3, 16, 3, 22, 1),
(20, 20, 0, 44, 0, 3, 0, 0, 3, 6, 3, 16, 3, 22, 1),
(21, 21, 0, 44, 0, 3, 0, 0, 3, 6, 3, 16, 3, 22, 1),
(22, 22, 0, 44, 0, 3, 0, 0, 3, 6, 3, 16, 3, 22, 1),
(23, 23, 0, 14, 0, 14, 0, 0, 0, 9, 6, 9, 14, 34, 1),
(24, 23, 0, 14, 0, 14, 0, 0, 0, 9, 6, 9, 14, 34, 1),
(25, 23, 0, 14, 0, 14, 0, 0, 0, 9, 6, 9, 14, 34, 1),
(26, 23, 0, 14, 0, 14, 0, 0, 0, 9, 6, 9, 14, 34, 1),
(27, 23, 0, 14, 0, 14, 0, 0, 0, 9, 6, 9, 14, 34, 1),
(28, 23, 0, 14, 0, 14, 0, 0, 0, 9, 6, 9, 14, 34, 1),
(29, 24, 0, 5, 0, 0, 0, 0, 0, 15, 5, 60, 5, 10, 1),
(30, 26, 0, 0, 0, 0, 0, 3, 0, 0, 0, 10, 88, 0, 1),
(31, 27, 0, 0, 0, 0, 0, 3, 0, 0, 0, 10, 88, 0, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user1_id` (`user1_id`) USING BTREE,
  ADD KEY `user2_id` (`user2_id`) USING BTREE;

--
-- Indexen voor tabel `likes_comments`
--
ALTER TABLE `likes_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `likes_post`
--
ALTER TABLE `likes_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `posts_color`
--
ALTER TABLE `posts_color`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `likes_comments`
--
ALTER TABLE `likes_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `likes_post`
--
ALTER TABLE `likes_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT voor een tabel `posts_color`
--
ALTER TABLE `posts_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `user1_foreign_key` FOREIGN KEY (`user1_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user2_foreign_key` FOREIGN KEY (`user2_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
