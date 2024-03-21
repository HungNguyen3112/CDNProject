-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2018 at 07:31 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `complete-blog-php`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--
CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `likes` int(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `description`, `content`, `views`, `likes`, `image`, `created_at`, `updated_at`) VALUES
(1, '5 Habits that can improve your life', '5-habits-that-can-improve-your-life', '5-habits-that-can-improve-your-life_description', '5-habits-that-can-improve-your-life_content', 12, 0, 'banner.jpg', '2018-11-22 05:59:52', '2018-02-01 13:44:31'),
(2, 'Second post on LifeBlog', 'second-post-on-lifeblog', 'second-post-on-lifeblog_description', 'second-post-on-lifeblog_content', 24, 0, 'banner.jpg', '2018-11-22 05:59:52', '2018-02-01 13:44:31'),
(3, 'Hello Post', 'hello-post', 'hello-post_description', 'hello-post_content', 16, 0, 'banner.jpg', '2018-11-22 05:59:52', '2018-02-01 13:44:31'),
(4, 'Google pixel', 'google-pixel', 'google-pixel_description', 'google-pixel_content', 12, 0, 'banner.jpg', '2018-11-22 05:59:52', '2018-02-01 13:44:31');
-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`, `slug`) VALUES
(1, 'Inspiration', 'inspiration'),
(2, 'Motivation', 'motivation'),
(3, 'Diary', 'diary');

-- --------------------------------------------------------


--
-- Table structure for table `post_topic`
--

CREATE TABLE `post_topic` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_topic`
--

INSERT INTO `post_topic` (`id`, `post_id`, `topic_id`) VALUES
(1, 3, 2),
(2, 1, 1),
(3, 2, 2);

-- --------------------------------------------------------
--
-- Table structure for table `users`
--

-- CREATE TABLE `users` (
--   `id` int(11) NOT NULL,
--   `username` varchar(255) NOT NULL,
--   `email` varchar(255) NOT NULL,
--   `role` enum('Author','Admin') DEFAULT NULL,
--   `password` varchar(255) NOT NULL,
--   `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --
-- -- Dumping data for table `users`
-- --

-- INSERT INTO `users` (`id`, `username`, `email`, `role`, `password`, `created_at`, `updated_at`) VALUES
-- (1, 'Kishan', 'rkishan516@gmail.com', 'Admin', '38caf6bc6147e61e1570f61e737fb6d8', '2018-01-08 07:22:58', '2018-01-08 07:22:58'),
-- (3, 'author1', 'author1@gmail.com', 'Admin', 'b312ba4ffd5245fa2a1ab819ec0d0347', '2018-11-14 14:25:05', '2018-11-14 14:25:05'),
-- (5, 'author2', 'author2@gmail.com', 'Author', '9bd97baef2b853ec00cc3cffd269f679', '2018-11-15 05:24:20', '2018-11-15 05:24:20'),
-- (15, 'user', 'user@gmail.com', NULL, 'ee11cbb19052e40b07aac0ca060c23ee', '2018-11-22 06:02:20', '2018-11-22 06:02:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);
  -- ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_topic`
--
ALTER TABLE `post_topic`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_id` (`post_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `users`
--
-- ALTER TABLE `users`
--   ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for table `post_topic`
--
ALTER TABLE `post_topic`
  ADD CONSTRAINT `post_topic_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `post_topic_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
