-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2022 at 07:16 AM
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
('C0001', '00001', 'p0001', 'awa', '19:51:18', '2022-10-10'),
('C0002', '00001', 'p0001', 'testing', '19:52:57', '2022-10-10'),
('C0003', '00001', 'p0001', 'MAMA AKU DI TI', '20:23:54', '2022-10-10'),
('C0004', '00001', 'p0001', 'MAMA AKU DI TI 2', '20:24:20', '2022-10-10'),
('C0005', '00001', 'p0001', 'omg', '20:43:38', '2022-10-10'),
('C0006', '00001', 'p0001', 'test', '20:44:59', '2022-10-10'),
('C0007', '00003', 'p0001', 'lmao', '20:48:06', '2022-10-10'),
('C0008', '00003', 'p0001', 'last test', '20:49:07', '2022-10-10'),
('C0009', '00003', 'p0001', 'dawdasdaw', '20:49:20', '2022-10-10'),
('C0010', '00003', 'p0001', 'last last etst', '20:50:22', '2022-10-10'),
('C0011', '00003', 'p0001', 'last last etst etst', '20:53:39', '2022-10-10'),
('C0012', '00003', 'p0001', 'swawarasddaw', '20:55:27', '2022-10-10'),
('C0013', '00003', 'p0001', 'sUIPA', '20:56:41', '2022-10-10'),
('C0014', '00003', 'p0001', 'cyka blyat', '20:57:54', '2022-10-10'),
('C0015', '00003', 'p0001', 'lmao lmao', '21:02:49', '2022-10-10'),
('C0016', '00003', 'p0001', 'mew', '21:03:12', '2022-10-10'),
('C0017', '00003', 'p0002', 'mew', '21:03:34', '2022-10-10'),
('C0018', '00003', 'p0002', 'i can sleep yey', '21:08:37', '2022-10-10'),
('C0019', '00003', 'p0003', 'MOM I DID IT!', '21:09:23', '2022-10-10'),
('C0020', '00003', 'p0003', 'aaaaaaaaaaaa let me sleep!', '21:10:33', '2022-10-10'),
('C0021', '00003', 'p0004', 'i dont understand...', '21:12:56', '2022-10-10'),
('C0022', '00003', 'p0004', '.....', '21:13:40', '2022-10-10'),
('C0023', '00003', 'p0004', 'paawwor', '21:15:21', '2022-10-10'),
('C0024', '00003', 'p0004', 'wo pu ming bai', '21:17:46', '2022-10-10'),
('C0025', '00003', 'p0004', 'pls...', '21:19:12', '2022-10-10'),
('C0026', '00003', 'p0005', 'lmao', '21:20:32', '2022-10-10'),
('C0027', '00003', 'p0003', 'awaaaaaaaaaaaaaaaaaaaaaaaa', '21:35:50', '2022-10-10'),
('C0028', '00003', 'p0005', 'its 2:36 AM AND IAM STILL DOING WEB ADLFhloasdfh', '21:36:42', '2022-10-10'),
('C0029', '00003', 'p0005', 'I NEED COFEEEEEEEEEEEEEEEEEEEEEEEEEEEE', '21:37:46', '2022-10-10'),
('C0030', '00003', 'p0005', 'i need coffee aaaaaaaaaaaaaaaaaa', '21:38:04', '2022-10-10'),
('C0031', '00003', 'p0006', '................', '21:39:39', '2022-10-10'),
('C0032', '00003', 'p0006', '.;.', '21:39:52', '2022-10-10'),
('C0033', '00003', 'p0006', 'PLS WORK..', '21:40:29', '2022-10-10'),
('C0034', '00003', 'p0006', 'YESSSSSSSS IT WORKS :))))))))))))))))', '21:40:40', '2022-10-10'),
('C0035', '00001', 'p0003', 'lmao', '21:41:32', '2022-10-10'),
('C0036', '00001', 'p0002', '+1', '21:47:05', '2022-10-10'),
('C0037', '00001', 'p0002', 'awa', '06:09:49', '2022-10-11'),
('C0038', '00001', 'p0009', 'wow gud', '06:10:24', '2022-10-11');

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
('00001', 'p0001', 1),
('00001', 'p0002', 1),
('00001', 'p0003', 1),
('00001', 'p0004', 0),
('00001', 'p0005', 1),
('00001', 'p0006', 0),
('00001', 'p0007', 0),
('00001', 'p0008', 1),
('00001', 'p0009', 1),
('00001', 'p0010', 1),
('00001', 'p0011', 1),
('00001', 'p0015', 1),
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
('00005', 'p0004', 1);

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
('p0001', 'test', 'dkfa[fdkakadf[psafdoapsdofsd[a', 23, 0, '00:00:09', '2007-10-22', '00001', 'F0001'),
('p0002', 'testing 2', 'bla bla bla', 21, 0, '00:00:11', '2007-10-22', '00001', 'F0002'),
('p0003', 'CAWDSA', 'infromatika is good', 1, 0, '00:00:02', '2007-10-22', '00001', 'F0004'),
('p0004', 'testing, testing', '迪诶吾娜迪娜诶迪诶吾迪娜诶诶迪弗尺艾尺吉诶弗勒艾艾吉艾迪艾诶娜迪艾勒艾艾诶娜迪屁艾勒艾艾诶娜迪艾', 1, 0, '00:00:04', '2022-10-08', '00001', 'F0008'),
('p0005', 'AUTO FISHING WEB', 'fish', 0, 0, '00:00:05', '2022-10-08', '00003', 'F0002'),
('p0006', 'FISHING 2', 'fish fish', 1, 0, '00:00:06', '2022-10-08', '00003', 'F0004'),
('p0007', 'FISHING 3', 'fish fish fish', 1, 0, '00:00:06', '2022-10-08', '00003', 'F0002'),
('p0008', 'suk dik ', 'adwasdsafafdfasfsasdfdfasasdfsdfasf', 1, 0, '00:00:07', '2022-10-08', '00004', 'F0007'),
('p0009', 'suk dik mor', 'adwasdsafafdfasfsasdfdfasasdfsdfasf dassdaasd ', 0, 0, '00:00:07', '2022-10-08', '00004', 'F0005'),
('p0010', 'EEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEER', 'AW', 0, 0, '00:00:09', '2022-10-08', '00001', 'F0008'),
('p0011', 'testing', 'aljdasjlafhdhfjlkhsdjksdfhkjlasdfsdf', 0, 0, '13:35:22', '2022-10-09', '00001', 'F0002'),
('p0012', 'testing like', 'LIKE', 0, 0, '15:15:43', '2022-10-10', '00003', 'F0002'),
('p0013', 'TESTING LIKE 4', 'testing testing..\r\n', 0, 0, '15:19:07', '2022-10-10', '00003', 'F0006'),
('p0014', 'Testing 3 like', 'testing .. tesintg', 0, 0, '15:20:43', '2022-10-10', '00003', 'F0007'),
('p0015', 'sleeping guide', 'Many factors can interfere with a good night\'s sleep — from work stress and family responsibilities to illnesses. It\'s no wonder that quality sleep is sometimes elusive.\r\n\r\nYou might not be able to control the factors that interfere with your sleep. However, you can adopt habits that encourage better sleep. Start with these simple tips.\r\n\r\n1. Stick to a sleep schedule\r\nSet aside no more than eight hours for sleep. The recommended amount of sleep for a healthy adult is at least seven hours. Most people don\'t need more than eight hours in bed to be well rested.\r\n\r\nGo to bed and get up at the same time every day, including weekends. Being consistent reinforces your body\'s sleep-wake cycle.\r\n\r\nIf you don\'t fall asleep within about 20 minutes of going to bed, leave your bedroom and do something relaxing. Read or listen to soothing music. Go back to bed when you\'re tired. Repeat as needed, but continue to maintain your sleep schedule and wake-up time.\r\n\r\n2. Pay attention to what you eat and drink\r\nDon\'t go to bed hungry or stuffed. In particular, avoid heavy or large meals within a couple of hours of bedtime. Discomfort might keep you up.\r\n\r\nNicotine, caffeine and alcohol deserve caution, too. The stimulating effects of nicotine and caffeine take hours to wear off and can interfere with sleep. And even though alcohol might make you feel sleepy at first, it can disrupt sleep later in the night.', 0, 0, '02:50:11', '2022-10-11', '00001', 'F0004');

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
('00001', 'ivanhalim', 'ivanhalim888@yahoo.co.id', '49sN7Ea!ri8c9jLy870J', 'qvfcj9saXZ3cODtHF3V48yNLNQ82', '00001.jpg', 'Grego'),
('00002', 'svan', 'ivanhalim888@gmail.com', 'A60XJf!Ydj5ig9mfkT6A', 'bLZNsa!3cQQrz20Gwkb', '00002.jpg', 'ivanhalim'),
('00003', 'ikan', 'ikan@gmail.com', 'mE5946K9pfAsb8Uet9sn', '1tjKC5LZ1qeoYWDlyzHOw8R', '00003.jpg', 'tongkol'),
('00004', 'Agustinusss', 'ivanhalim888@gmail.com', 'R7ZR83jxIHKNpu6w!hws', '6GgTn6IRhREmw3UUbLClbD', '00004.jpg', 'Latihan1'),
('00005', 'Hunter2', 'awa@gmail.com', '4Saheyuh!36G0XCE5n1d', 'g22bom92txAy!nzJmyR48s1', '00005.jpg', 'AWDAWDA');

--
-- Indexes for dumped tables
--

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
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `post_id_like` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_like` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
