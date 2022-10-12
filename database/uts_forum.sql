-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2022 at 08:51 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uts_forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `banned`
--

CREATE TABLE `banned` (
  `user_id` varchar(10) NOT NULL,
  `reason` int(11) NOT NULL,
  `banned_since` date NOT NULL,
  `banned_until` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banned`
--

INSERT INTO `banned` (`user_id`, `reason`, `banned_since`, `banned_until`) VALUES
('00006', 0, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` varchar(5) NOT NULL,
  `user_id` varchar(5) NOT NULL,
  `post_id` varchar(5) NOT NULL,
  `body` varchar(5000) NOT NULL,
  `time_created` time NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `post_id`, `body`, `time_created`, `date_created`) VALUES
('C0017', '00003', 'p0002', 'mew', '21:03:34', '2022-10-10'),
('C0018', '00003', 'p0002', 'i can sleep yey', '21:08:37', '2022-10-10'),
('C0019', '00003', 'p0003', 'MOM I DID IT!', '21:09:23', '2022-10-10'),
('C0020', '00003', 'p0003', 'aaaaaaaaaaaa let me sleep!', '21:10:33', '2022-10-10'),
('C0026', '00003', 'p0005', 'lmao', '21:20:32', '2022-10-10'),
('C0027', '00003', 'p0003', 'awaaaaaaaaaaaaaaaaaaaaaaaa', '21:35:50', '2022-10-10'),
('C0028', '00003', 'p0005', 'its 2:36 AM AND IAM STILL DOING WEB ADLFhloasdfh', '21:36:42', '2022-10-10'),
('C0029', '00003', 'p0005', 'I NEED COFEEEEEEEEEEEEEEEEEEEEEEEEEEEE', '21:37:46', '2022-10-10'),
('C0030', '00003', 'p0005', 'i need coffee aaaaaaaaaaaaaaaaaa', '21:38:04', '2022-10-10'),
('C0031', '00003', 'p0006', '................', '21:39:39', '2022-10-10'),
('C0032', '00003', 'p0006', '.;.', '21:39:52', '2022-10-10'),
('C0033', '00003', 'p0006', 'PLS WORK..', '21:40:29', '2022-10-10'),
('C0034', '00003', 'p0006', 'YESSSSSSSS IT WORKS :))))))))))))))))', '21:40:40', '2022-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id` varchar(5) NOT NULL,
  `categories` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `categories`) VALUES
('F0001', 'C++'),
('F0002', 'Python'),
('F0003', 'Java'),
('F0004', 'Ruby'),
('F0005', 'SQL'),
('F0006', 'PHP'),
('F0007', 'C'),
('F0008', 'Javascript');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `user_id` varchar(5) NOT NULL,
  `post_id` varchar(5) NOT NULL,
  `like_bool` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`user_id`, `post_id`, `like_bool`) VALUES
('00003', 'p0001', 1),
('00003', 'p0003', 1),
('00003', 'p0006', 1),
('00003', 'p0007', 1),
('00003', 'p0012', 1),
('00003', 'p0013', 1),
('00003', 'p0014', 0),
('00005', 'p0001', 1),
('00005', 'p0002', 1),
('00005', 'p0003', 0),
('00005', 'p0004', 1),
('10001', 'p0006', 1),
('10001', 'p0008', 0),
('10001', 'p0009', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` varchar(5) NOT NULL,
  `title` varchar(300) NOT NULL,
  `body` mediumtext NOT NULL,
  `like_ammount` int(11) NOT NULL,
  `comment_ammount` int(11) NOT NULL,
  `time_created` time NOT NULL,
  `date_created` date NOT NULL,
  `user_id` varchar(5) NOT NULL,
  `forum_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `body`, `like_ammount`, `comment_ammount`, `time_created`, `date_created`, `user_id`, `forum_id`) VALUES
('p0005', 'AUTO FISHING WEB', 'fish', 0, 0, '00:00:05', '2022-10-08', '00003', 'F0002'),
('p0006', 'FISHING 2', 'fish fish', 1, 0, '00:00:06', '2022-10-08', '00003', 'F0004'),
('p0007', 'FISHING 3', 'fish fish fish', 1, 0, '00:00:06', '2022-10-08', '00003', 'F0002'),
('p0012', 'testing like', 'LIKE', 0, 0, '15:15:43', '2022-10-10', '00003', 'F0002'),
('p0013', 'TESTING LIKE 4', 'testing testing..\r\n', 0, 0, '15:19:07', '2022-10-10', '00003', 'F0006'),
('p0014', 'Testing 3 like', 'testing .. tesintg', 0, 0, '15:20:43', '2022-10-10', '00003', 'F0007');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(45) NOT NULL,
  `user_key` varchar(30) NOT NULL,
  `encrypted_password` varchar(50) NOT NULL,
  `img` varchar(50) DEFAULT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `user_key`, `encrypted_password`, `img`, `name`) VALUES
('00002', 'svan', 'ivanhalim888@gmail.com', 'A60XJf!Ydj5ig9mfkT6A', 'bLZNsa!3cQQrz20Gwkb', '00002.jpg', 'ivanhalim'),
('00003', 'ikan', 'ikan@gmail.com', 'mE5946K9pfAsb8Uet9sn', '1tjKC5LZ1qeoYWDlyzHOw8R', '00003.jpg', 'tongkol'),
('00005', 'Hunter2', 'awa@gmail.com', '4Saheyuh!36G0XCE5n1d', 'g22bom92txAy!nzJmyR48s1', '00005.jpg', 'AWDAWDA'),
('00006', 'Kenzi1010', 'supergamerzone134@gmail.com', 'L!OUiNgX3K30Pn7CddPq', 'wWLpBGm8ppO3Zoi8ti4c8X9Lk', '00006.png', 'Pixel'),
('10001', 'admin', '', 'ADWjWuuhXZiOYNFvMyMi', 'o4eoYm9JNukh9ucsRvlL8xQs', '10001.png', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banned`
--
ALTER TABLE `banned`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`user_id`,`post_id`),
  ADD KEY `post_id_like` (`post_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `forum_id` (`forum_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `banned`
--
ALTER TABLE `banned`
  ADD CONSTRAINT `banned_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `user_id_like` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
