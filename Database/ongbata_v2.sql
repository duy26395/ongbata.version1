-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2021 at 05:34 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ongbata_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutyou`
--

CREATE TABLE `aboutyou` (
  `id` int(11) NOT NULL,
  `membersid` int(11) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Aboutyou_logo` varchar(255) NOT NULL,
  `Aboutyou_displaymode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aboutyou`
--

INSERT INTO `aboutyou` (`id`, `membersid`, `Type`, `Description`, `Aboutyou_logo`, `Aboutyou_displaymode`) VALUES
(2, 1, 'Tính cách', 'Vui vẻ', '', ''),
(3, 1, 'tính cách', 'Hoa dong', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `ID` int(11) NOT NULL,
  `membersid` int(11) DEFAULT NULL,
  `postid` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `datecreate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`ID`, `membersid`, `postid`, `content`, `datecreate`) VALUES
(1, 1, 1, '+ Va?o chie??u nga?y 15/7/2021, Trung ta?m Kie??m soa?t Be??nh ta??t TP. Ho?? Chi? Minh ?a?ng ky? bo?? sung tre?n He?? tho??ng Quo??c gia qua?n ly? ca be??nh COVID-19 danh sa?ch 689 ca be??nh (BN40152-BN40840) ?a? ?u?o??c pha?t hie??n tru?o??c ?o? ta?i ca?c khu ca?ch ly', NULL),
(2, 2, 1, 'dep qua', NULL),
(3, 1, 2, 'cmt of post id 2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `ID` int(11) NOT NULL,
  `postid` int(11) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `isvideo` tinyint(1) DEFAULT NULL,
  `gallerytype` varchar(10) NOT NULL,
  `datecreate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`ID`, `postid`, `url`, `isvideo`, `gallerytype`, `datecreate`) VALUES
(1, 1, '209088309_251528529638589_4772199930380361117_n.jpg', NULL, 'imgavatar', 1629185002),
(2, 2, '188938688_472356644024938_249355253056740301_n.jpg', NULL, 'imgavatar', 1629185015),
(3, 3, '188206093_475589787034957_417689121209685679_n.jpg', NULL, 'imgcover', 1629185013),
(6, 26, 'yqvpJt.jpg', NULL, '', 2147483647),
(18, 108, '1919135953.jpg', NULL, '', 1629185015),
(19, 108, '234442902_364642141962368_1861416128874790549_n.jpg', NULL, '', 1629185015),
(20, 108, '222407266_575442636780427_6083484273398377084_n.jpg', NULL, '', 1629185015),
(22, 111, 'duydev_test1 (1).jpg', NULL, '', 1631634094),
(23, 111, 'duydev_test1.jpg', NULL, '', 1631634094),
(24, 111, 'duydev_test2.jpg', NULL, '', 1631634095),
(25, 112, '178654664_1412849409070221_9175328205496818664_n.jpg', NULL, '', 1631635240),
(26, 112, '205900322_189314059673126_2961824119710106173_n.jpg', NULL, '', 1631635240),
(27, 112, '198889157_220604679699872_6247445420132766935_n.jpg', NULL, '', 1631635240),
(31, 116, '230885109_548409869638967_4346591977508846866_n.jpg', NULL, '', 1631689539),
(32, 116, '222407266_575442636780427_6083484273398377084_n.jpg', NULL, '', 1631689539),
(52, 134, '2fb01126cde4fa7b4d4f5c209c7cb0a3.jpg', NULL, '', 1631766371),
(53, 134, '255295a59680eb2e27889568926ed6e5.jpg', NULL, '', 1631766371),
(60, 138, 'a56c7e1f4185df7b5b0b416e7f7ef8c4.jpg', NULL, '', 1631809818),
(61, 138, 'original.jpg', NULL, '', 1631809818),
(63, 139, '238525093_200718988703194_3732500517027314317_n.jpg', NULL, '', 1631810507),
(64, 139, 'b8db196b9982c5cdfd90caf613949128.jpg', NULL, '', 1631810507),
(70, 139, '158364755_938242553598572_6255459073316320113_n.jpg', NULL, '', 1632123330),
(88, 157, 'Fight The Bad Feeling_1080p.mp4', NULL, '', 1632370745);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `groupname` varchar(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groupsdetail`
--

CREATE TABLE `groupsdetail` (
  `id` int(11) NOT NULL,
  `groupsid` int(11) DEFAULT NULL,
  `membersid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lifeevents`
--

CREATE TABLE `lifeevents` (
  `id` int(11) NOT NULL,
  `membersid` int(11) NOT NULL,
  `DateTime` int(11) NOT NULL,
  `NameEvenet` varchar(255) NOT NULL,
  `EventDetail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lifeevents`
--

INSERT INTO `lifeevents` (`id`, `membersid`, `DateTime`, `NameEvenet`, `EventDetail`) VALUES
(1, 1, 2025, 'Kết hôn ', 'Đã tìm được nửa kia nên kết hôn haha'),
(3, 1, 20, 'Đã có nhà mới tại Đà Nẵng haha', 'Sau những cố gắng thì cũng đạt được ước mơ');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `ID` int(11) NOT NULL,
  `author` int(10) DEFAULT NULL,
  `USER` varchar(200) DEFAULT NULL,
  `family` smallint(6) DEFAULT NULL,
  `date` int(10) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `birth` varchar(100) DEFAULT NULL,
  `death` tinyint(1) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `site` varchar(200) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `birthplace` varchar(255) DEFAULT NULL,
  `paddress` varchar(255) NOT NULL,
  `deathplace` varchar(255) DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `interests` varchar(255) DEFAULT NULL,
  `bio` mediumtext DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `birthday` tinyint(2) DEFAULT NULL,
  `birthmonth` tinyint(2) DEFAULT NULL,
  `birthyear` smallint(4) DEFAULT NULL,
  `deathday` tinyint(2) DEFAULT NULL,
  `deathmonth` tinyint(2) DEFAULT NULL,
  `deathyear` smallint(4) DEFAULT NULL,
  `birthdate` int(11) DEFAULT NULL,
  `maritalstatus` varchar(30) NOT NULL,
  `mariagedate` int(11) DEFAULT NULL,
  `deathdate` int(11) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`ID`, `author`, `USER`, `family`, `date`, `firstname`, `lastname`, `gender`, `birth`, `death`, `type`, `photo`, `email`, `site`, `tel`, `mobile`, `birthplace`, `paddress`, `deathplace`, `profession`, `company`, `interests`, `bio`, `level`, `parent`, `birthday`, `birthmonth`, `birthyear`, `deathday`, `deathmonth`, `deathyear`, `birthdate`, `maritalstatus`, `mariagedate`, `deathdate`, `facebook`, `instagram`, `twitter`, `longitude`, `latitude`) VALUES
(1, 2, '', 2, 1622435233, 'NhÃƒÂ¢n', 'NguyÃ¡Â»â€¦n hÃ¡Â»Â¯u', 2, NULL, 1, 1, 'uploads/MTYyMjQzNTEzNTMyOTgxMjE3NjkyMTA4MDUwMDEyMA_1622435233.jpg', '123@email.com', '', '', '0914200244', 'Quang Nam', 'Da Nang', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 778352400, '', 1622435233, 1622435233, '', '', '', '108.210369', '16.074691'),
(2, 9, '', 4, 1623466023, 'Ãƒ ghmwssa', 'cedfv', 1, NULL, 1, 2, 'images/avatar/2.jpg', '', '', '', '', '', '', '', '', '', '', '', 0, 9, 0, 0, 0, 0, 0, 0, 1623466023, '', 1623466023, 1623466023, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `placeslived`
--

CREATE TABLE `placeslived` (
  `id` int(11) NOT NULL,
  `membersid` int(11) NOT NULL,
  `Place` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `DateStart` int(11) NOT NULL,
  `Display mode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `placeslived`
--

INSERT INTO `placeslived` (`id`, `membersid`, `Place`, `Type`, `DateStart`, `Display mode`) VALUES
(13, 1, 'Đã sống tại Mỹ', 'Quê quán', 0, ''),
(15, 1, 'Huế', 'Quê quán', 0, ''),
(17, 1, 'Da Nang', 'Tỉnh-Thành phố hiện tại', 0, ''),
(18, 1, 'Huế', 'Quê quán', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `membersid` int(11) DEFAULT NULL,
  `Title` varchar(255) CHARACTER SET utf32 COLLATE utf32_vietnamese_ci DEFAULT NULL,
  `content` text DEFAULT NULL,
  `datecreate` int(11) DEFAULT NULL,
  `statuspost` varchar(50) DEFAULT NULL,
  `groupsid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `membersid`, `Title`, `content`, `datecreate`, `statuspost`, `groupsid`) VALUES
(1, 1, 'Thá»§ tÆ°á»›ng chá»‰ Ä‘áº¡o thÃ nh láº­p 7 â€œTá»• cÃ´ng tÃ¡c Ä‘áº·c biá»‡tâ€ phÃ²ng, chá»‘ng COVID-19 táº¡i TPHCM', '+ 33 ca ca?ch ly ngay sau khi nha??p ca?nh ta?i Thanh Ho?a (19), HCM (10), Ha? No??i (2), Qua?ng Nam (1), Bi?nh ?i?nh (1).\r\n+ 1.889 ca ghi nha??n trong nu?o??c ta?i TP. Ho?? Chi? Minh (1.399), Bi?nh Du?o?ng (122), ?o??ng Tha?p (63), ?o??ng Nai (60), Long An (41), ?a? Na??ng (33), Be??n Tre (30), Phu? Ye?n (30), Vi?nh Long (17), Bi?nh Thua??n (17), Bi?nh Phu?o??c (13), Hu?ng Ye?n (12), Ca??n Tho? (11), Ninh Thua??n (10), Ha? No??i (7), So?c Tra?ng (4), Qua?ng Nga?i (4), Kha?nh Ho?a (4), Ba??c Ninh (3), Tra? Vinh (3), Bi?nh ?i?nh (1), Ca? Mau (1), Vi?nh Phu?c (1), La?m ?o??ng (1), ?a??k La??k (1), Ba??c Giang (1); trong ?o? 1.685 ca ?u?o??c pha?t hie??n trong khu ca?ch ly hoa??c khu ?a? ?u?o??c phong toa?.', NULL, NULL, NULL),
(2, 1, '????????????????', 'C?p nh?t ?nh bÃ¬a', 1628584057, NULL, NULL),
(3, 1, 'C????????????????????', 'C?p nh?t ?nh ??i di?n', 1628584108, NULL, NULL),
(8, 1, 'minh dang nghi gi ne', NULL, NULL, NULL, NULL),
(12, 1, 'test cai hinh ne', NULL, NULL, NULL, NULL),
(13, 1, 'check cai last id ne', NULL, NULL, NULL, NULL),
(15, 1, 'tÃƒÂ©t cÃƒÂ¡i khÃƒÂ¡c nÃƒÂ¨', NULL, NULL, NULL, NULL),
(16, 1, 'Ã„â€˜ÃƒÂ£ test cÃƒÂ¡i khÃƒÂ¡c rÃ¡Â»â€œi', NULL, NULL, NULL, NULL),
(20, 1, 'fhdskjfksdf', NULL, NULL, NULL, NULL),
(21, 1, 'ksdjflksdf', NULL, NULL, NULL, NULL),
(24, 1, 'hshdjfkshkjdf', NULL, NULL, NULL, NULL),
(26, 1, 'giÃ¡Â»Â mÃ¡Â»â€ºi Ã„â€˜ÃƒÂºng lÃƒÂ  cÃƒÂ¡i hÃƒÂ¬nh nÃƒÂ¨', NULL, NULL, NULL, NULL),
(47, 1, 'ewrwerwer', NULL, NULL, NULL, NULL),
(70, 1, 'ahihi', NULL, 1629104413, NULL, NULL),
(71, 1, 'ahihi', NULL, 1629104413, NULL, NULL),
(72, 1, 'ku kiet ngu ngok', NULL, 1629105126, NULL, NULL),
(73, 1, 'ashdh', NULL, 1629105255, NULL, NULL),
(74, 1, 'ahihi', NULL, 1629105374, NULL, NULL),
(75, 1, 'co con chim be nho', NULL, 1629105435, NULL, NULL),
(76, 1, 'park kim thang', NULL, 1629105716, NULL, NULL),
(77, 1, 'Lee Kang Sucs', NULL, 1629105811, NULL, NULL),
(78, 1, 'kiet lekt', NULL, 1629105939, NULL, NULL),
(79, 1, 'anh lo em ma', NULL, 1629105988, NULL, NULL),
(80, 1, 'khong sao ma', NULL, 1629106111, NULL, NULL),
(81, 1, 'con trym co dom', NULL, 1629106136, NULL, NULL),
(83, 1, 'test mutil hinh', NULL, 1629107188, NULL, NULL),
(84, 1, 'test nhieu hinh lan 1', NULL, 1629107260, NULL, NULL),
(85, 1, 'test mutili img lan 2', NULL, 1629107448, NULL, NULL),
(86, 1, 'test mutil img lan 3', NULL, 1629107577, NULL, NULL),
(88, 1, 'ahihi', NULL, 1629166966, NULL, NULL),
(89, 1, '123', NULL, 1629166988, NULL, NULL),
(90, 1, 'test 1', NULL, 1629167034, NULL, NULL),
(91, 1, 'test 3', NULL, 1629167500, NULL, NULL),
(92, 1, 'test 4', NULL, 1629167664, NULL, NULL),
(94, 1, 'test 55', NULL, 1629168246, NULL, NULL),
(95, 1, 'test 6', NULL, 1629168302, NULL, NULL),
(96, 1, 'test 7', NULL, 1629168367, NULL, NULL),
(99, 1, 'test 10', NULL, 1629168991, NULL, NULL),
(108, 1, 'test 11', NULL, 1629185013, NULL, NULL),
(109, 1, '<p>ahihi do ngok</p>', NULL, 1631610396, NULL, NULL),
(111, 1, '<p>ahihi</p>', NULL, 1631634093, NULL, NULL),
(112, 1, '<p><span style=\"color:hsl(60, 75%, 60%);\"><strong>up 2 áº£nh</strong></span></p>', NULL, 1631635239, NULL, NULL),
(116, 1, '<p>up 2 img of post</p>', NULL, 1631689538, NULL, NULL),
(124, 1, '<p>cuoi thoi</p>', NULL, 1631719738, NULL, NULL),
(125, 1, '<p>test dung khong ne</p>', NULL, 1631720273, NULL, NULL),
(127, 1, '<p>312312332</p>', NULL, 1631720938, NULL, NULL),
(128, 1, '<p>gdgfd</p>', NULL, 1631721087, NULL, NULL),
(134, 1, '<p>asd</p>', NULL, 1631766371, NULL, NULL),
(138, 1, '<p><span style=\"background-color:hsl(60, 75%, 60%);\"><strong>hihi</strong></span></p>', NULL, 1631809817, NULL, NULL),
(139, 1, '<p>final ne</p>', NULL, 1631810506, NULL, NULL),
(157, 1, '<p>tesst video</p>', NULL, 1632370743, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `postaction`
--

CREATE TABLE `postaction` (
  `ID` int(11) NOT NULL,
  `postid` int(11) DEFAULT NULL,
  `membersid` int(11) NOT NULL,
  `react` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postaction`
--

INSERT INTO `postaction` (`ID`, `postid`, `membersid`, `react`) VALUES
(2, 1, 1, 'comment'),
(3, 1, 2, 'like'),
(4, 2, 1, 'comment'),
(5, 1, 2, 'comment'),
(30, 3, 1, 'like'),
(41, 15, 1, 'like'),
(43, 26, 1, 'like'),
(44, 12, 1, 'like'),
(56, 8, 1, 'like'),
(99, 75, 1, 'like'),
(106, 90, 1, 'like'),
(114, 96, 1, 'like'),
(116, 108, 1, 'like');

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE `work` (
  `id` int(11) NOT NULL,
  `membersid` int(11) NOT NULL,
  `Workplace` varchar(255) NOT NULL,
  `DateStart` int(11) NOT NULL,
  `Displaymode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`id`, `membersid`, `Workplace`, `DateStart`, `Displaymode`) VALUES
(107, 1, 'Đã học tại Nga', 0, ''),
(114, 1, 'Đã lam việc tại đà nẵng', 0, ''),
(115, 1, 'Studying at universty', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutyou`
--
ALTER TABLE `aboutyou`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membersid` (`membersid`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `membersid` (`membersid`),
  ADD KEY `postid` (`postid`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `postid` (`postid`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groupsdetail`
--
ALTER TABLE `groupsdetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membersid` (`membersid`),
  ADD KEY `groupsid` (`groupsid`);

--
-- Indexes for table `lifeevents`
--
ALTER TABLE `lifeevents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membersid` (`membersid`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `placeslived`
--
ALTER TABLE `placeslived`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membersid` (`membersid`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membersid` (`membersid`),
  ADD KEY `groupsid` (`groupsid`);

--
-- Indexes for table `postaction`
--
ALTER TABLE `postaction`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `postid` (`postid`),
  ADD KEY `membersid` (`membersid`);

--
-- Indexes for table `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membersid` (`membersid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groupsdetail`
--
ALTER TABLE `groupsdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `postaction`
--
ALTER TABLE `postaction`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aboutyou`
--
ALTER TABLE `aboutyou`
  ADD CONSTRAINT `aboutyou_ibfk_1` FOREIGN KEY (`membersid`) REFERENCES `members` (`ID`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`membersid`) REFERENCES `members` (`ID`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`postid`) REFERENCES `post` (`id`);

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `post` (`id`);

--
-- Constraints for table `groupsdetail`
--
ALTER TABLE `groupsdetail`
  ADD CONSTRAINT `groupsdetail_ibfk_1` FOREIGN KEY (`membersid`) REFERENCES `members` (`ID`),
  ADD CONSTRAINT `groupsdetail_ibfk_2` FOREIGN KEY (`groupsid`) REFERENCES `groups` (`id`);

--
-- Constraints for table `lifeevents`
--
ALTER TABLE `lifeevents`
  ADD CONSTRAINT `lifeevents_ibfk_1` FOREIGN KEY (`membersid`) REFERENCES `members` (`ID`);

--
-- Constraints for table `placeslived`
--
ALTER TABLE `placeslived`
  ADD CONSTRAINT `placeslived_ibfk_1` FOREIGN KEY (`membersid`) REFERENCES `members` (`ID`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`membersid`) REFERENCES `members` (`ID`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`groupsid`) REFERENCES `groups` (`id`);

--
-- Constraints for table `postaction`
--
ALTER TABLE `postaction`
  ADD CONSTRAINT `postaction_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `postaction_ibfk_2` FOREIGN KEY (`membersid`) REFERENCES `members` (`ID`);

--
-- Constraints for table `work`
--
ALTER TABLE `work`
  ADD CONSTRAINT `work_ibfk_1` FOREIGN KEY (`membersid`) REFERENCES `members` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
