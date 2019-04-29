-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 29, 2019 at 07:01 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `instapet`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
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
-- Table structure for table `friends`
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
-- Table structure for table `likes_comments`
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
-- Table structure for table `likes_post`
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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `image`, `description`, `timestamp`, `active`) VALUES
(84, 5, 'uploads/posts\\tpCaNjh1DWtCnR60xC1nEdhUH5BlhVl3ulzsgUsTApMkXMhEruTxi8PGMTIXh0\\300.png', 'Placeholder', '2019-04-29 06:57:56', 1),
(85, 5, 'uploads/posts\\djjHfY7ws8YDAVmAaUVIGpYxOkQP92JKL88nBUxcQL5ZqQdIZQYAQUgiWy2DYo\\300.png', 'Placeholder', '2019-04-29 06:58:06', 1),
(86, 5, 'uploads/posts\\YMB05M0weNIwVSz0Al8xa6sHCj2X5FOlisRyQRqxg2ubtC1ufGoNpAqecawyGg\\300.png', 'Placeholder', '2019-04-29 06:58:16', 1),
(87, 5, 'uploads/posts\\w2VfYEcR6AKwb1iCU0gxObsUq0clm4xiTQbeCPOfxPRXgMd0ootsVDnmlG18Bt\\300.png', 'Placeholder', '2019-04-29 06:58:24', 1),
(88, 5, 'uploads/posts\\9QKCd3yfZEehGooy4EyH7cMCkekqRhfg2CvevxSOvqNqez7v78lo2rRsNypYYe\\300.png', 'Placeholder', '2019-04-29 06:58:37', 1),
(89, 5, 'uploads/posts\\o1JkBVQI3waPvFflPhWOttsp5dipP9skg8jyg8Utpl8sxqokgj4Dac4TEn9a43\\300.png', 'Placeholder', '2019-04-29 06:58:46', 1),
(90, 5, 'uploads/posts\\3jt3WZhjqlFph2hUJtfiZq6gGJg93LH0ck4q7FVV4piAv1j0y2HgvmBl9hvok3\\300.png', 'Placeholder', '2019-04-29 06:58:56', 1),
(91, 5, 'uploads/posts\\d0Ay2q0kU5i8d5toGSwIskKwIx81kK7ulOmKZl6SUysmAgXYa8KrnkPUyUSsL1\\300.png', 'Placeholder', '2019-04-29 06:59:10', 1),
(92, 5, 'uploads/posts\\H7HaIfZBTPOFE0M1VTQbLRbhD7Cg5IxgFAZW0SAzJgre1PrxupTcvIUAxcMUTE\\300.png', 'Placeholder', '2019-04-29 06:59:19', 1),
(93, 5, 'uploads/posts\\fc6TMKhnqhH08YUVuIkWqFNvO5Ls9Nz11bmvDpOjBVcRnyZ23Za9fJPX5ffS9e\\300.png', 'Placeholder', '2019-04-29 06:59:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts_color`
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
-- Dumping data for table `posts_color`
--

INSERT INTO `posts_color` (`id`, `posts_id`, `red`, `orange`, `yellow`, `green`, `turquoise`, `blue`, `purple`, `pink`, `white`, `gray`, `black`, `brown`, `active`) VALUES
(2, 84, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 1),
(3, 85, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 1),
(4, 86, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 1),
(5, 87, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 1),
(6, 88, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 1),
(7, 89, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 1),
(8, 90, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 1),
(9, 91, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 1),
(10, 92, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 1),
(11, 93, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `firstname`, `lastname`, `username`, `password`, `description`, `picture`, `timestamp`, `active`) VALUES
(20, 'teddy@test.be', 'Teddy', 'Bear', 'teddyBear', '$2y$10$MFJm9QwQFq6N1x4bDdAex.mXWs7V75HJmeuUofPb.w6cesnoIxyNC', '', '', '2019-04-29 08:53:52', 0),
(21, 'hi@test.be', 'h', 'i', 'hi', '$2y$10$fwZ9o2VRwc7LncJ4XPgGhOlTng.T5LGn0SCo3AhkhA1uDQg.GBeAi', '', '', '2019-04-29 08:54:14', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user1_id` (`user1_id`) USING BTREE,
  ADD UNIQUE KEY `user2_id` (`user2_id`);

--
-- Indexes for table `likes_comments`
--
ALTER TABLE `likes_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes_post`
--
ALTER TABLE `likes_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts_color`
--
ALTER TABLE `posts_color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `likes_comments`
--
ALTER TABLE `likes_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `likes_post`
--
ALTER TABLE `likes_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `posts_color`
--
ALTER TABLE `posts_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `user1_foreign_key` FOREIGN KEY (`user1_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user2_foreign_key` FOREIGN KEY (`user2_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
