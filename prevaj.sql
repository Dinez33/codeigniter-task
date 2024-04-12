-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2024 at 07:00 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prevaj`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `question` varchar(5000) NOT NULL,
  `answer` varchar(5000) NOT NULL,
  `answer_type` varchar(100) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `qid` varchar(200) NOT NULL,
  `question` varchar(5000) NOT NULL,
  `question_type` varchar(20) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `qid`, `question`, `question_type`, `status`, `created_at`) VALUES
(103, '6615e9e0c84b6', 'what is the name of the publication for this article?', 'text', 1, '2024-04-10 01:22:40'),
(104, '6615e9e0c84b6', 'what is the name of  this article?', 'text', 1, '2024-04-10 01:22:40'),
(105, '6615e9e0c84b6', 'when was the article published?', 'date', 1, '2024-04-10 01:22:40'),
(106, '6615e9e0c84b6', 'upload the link to the article', 'url', 1, '2024-04-10 01:22:40'),
(107, '6615e9e0c84b6', 'upload the copy of the article', 'file', 1, '2024-04-10 01:22:41'),
(108, '6615e9e0c84b6', 'was this article published in an academic journal?', 'radio', 1, '2024-04-10 01:22:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(300) NOT NULL,
  `password` varchar(500) NOT NULL,
  `user_role` tinyint(5) NOT NULL COMMENT '(1=Admin,2=User)',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_role`, `created_at`) VALUES
(1, 'admin', 'e6e061838856bf47e1de730719fb2609', 1, '2024-04-09 18:50:45'),
(2, 'dinesh', 'e6e061838856bf47e1de730719fb2609', 2, '2024-04-09 18:50:45'),
(3, 'dinesh', '9c9f1c65b1dc1f79498c9f09eb610e1a', 2, '2024-04-10 01:13:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
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
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
