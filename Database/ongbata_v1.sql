-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 06, 2021 lúc 08:15 PM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ongbata_v1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `ID` int(11) NOT NULL,
  `membersid` int(11) DEFAULT NULL,
  `postid` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `datecreate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`ID`, `membersid`, `postid`, `content`, `datecreate`) VALUES
(1, 1, 1, '+ Va?o chie??u nga?y 15/7/2021, Trung ta?m Kie??m soa?t Be??nh ta??t TP. Ho?? Chi? Minh ?a?ng ky? bo?? sung tre?n He?? tho??ng Quo??c gia qua?n ly? ca be??nh COVID-19 danh sa?ch 689 ca be??nh (BN40152-BN40840) ?a? ?u?o??c pha?t hie??n tru?o??c ?o? ta?i ca?c khu ca?ch ly', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cong_viec`
--

CREATE TABLE `cong_viec` (
  `id` int(11) NOT NULL,
  `membersid` int(11) NOT NULL,
  `noi_lam_viec` varchar(255) NOT NULL,
  `che_do_hien_thi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `cong_viec`
--

INSERT INTO `cong_viec` (`id`, `membersid`, `noi_lam_viec`, `che_do_hien_thi`) VALUES
(129, 1, 'Sẽ học tại Na uy😁🤣', ''),
(136, 1, 'Đã lam việc tại đà nẵng', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gallery`
--

CREATE TABLE `gallery` (
  `ID` int(11) NOT NULL,
  `postid` int(11) DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `isvideo` tinyint(1) DEFAULT NULL,
  `datecreate` int(11) DEFAULT NULL,
  `gallerycategoryid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `gallery`
--

INSERT INTO `gallery` (`ID`, `postid`, `url`, `isvideo`, `datecreate`, `gallerycategoryid`) VALUES
(1, 1, '1.jpg', NULL, NULL, 7),
(2, 2, '188938688_472356644024938_249355253056740301_n.jpg', NULL, NULL, 10),
(3, 3, '188206093_475589787034957_417689121209685679_n.jpg', NULL, NULL, 9),
(4, 5, 'trinh sat doan.jpg', NULL, 1629799618, 7),
(5, 6, '80197630_573986226718300_5319612270802632704_o.jpg', NULL, 1629799651, 7),
(10, 10, '209053931_493404051920197_2431657891482064714_n.jpg', NULL, 1630139265, 7),
(11, 11, 'hinh11(2).jpg', NULL, 1630139277, 7),
(15, 15, 'Team Guy 2.png', NULL, 1630165672, 9),
(17, 18, '80197630_573986226718300_5319612270802632704_o.jpg', NULL, 1630251993, 9),
(18, 19, 'avavtar tết.jpg', NULL, 1630252206, 9),
(21, 22, '53074153_2028378037465905_3581825609002647552_n_2.jpg', NULL, 1630253416, 9),
(22, 26, 'hinh11(2).jpg', NULL, 1630254083, 9),
(24, 31, 'spirited-away.jpg', NULL, 1630419326, 9),
(28, 37, '53074153_2028378037465905_3581825609002647552_n_2.jpg', NULL, 1630464457, 10),
(31, 41, 'avavtar tết.jpg', NULL, 1630465538, 9),
(32, 42, 'giphy.gif', NULL, 1630488182, 10),
(33, 43, 'Team Guy1.jpg', NULL, 1630488235, 10),
(36, 47, 'đầu năm đi chua.jpg', NULL, 1630506669, 7),
(37, 48, '53074153_2028378037465905_3581825609002647552_n.jpg', NULL, 1630506705, 7),
(38, 48, '53074153_2028378037465905_3581825609002647552_n_2.jpg', NULL, 1630506705, 7),
(39, 48, '80197630_573986226718300_5319612270802632704_o.jpg', NULL, 1630506705, 7),
(40, 49, '53074153_2028378037465905_3581825609002647552_n.jpg', NULL, 1630507242, 7),
(41, 50, 'avavtar tết.jpg', NULL, 1630507490, 7),
(42, 8, 'Cartoon Network 2013 - Extended (Video).mp4', NULL, 1630507490, 8),
(44, 56, 'Bonnie宝仪-Bao Yi - Cô gái dễ thương - Sao chép.mp4', NULL, 1630577708, 8),
(45, 58, 'trinh sat doan.jpg', NULL, 1630660255, 10),
(48, 61, '121070128_102013911686479_3780136903540920987_n.jpg', NULL, 1630769500, 10),
(51, 64, 'avavtar tết.jpg', NULL, 1630769919, 10),
(52, 80, '203156108_493404101920192_5905528089939338329_n (2).jpg', NULL, 1630947276, 7),
(53, 81, '[Nhạc Tik Tok] Tôi sẵn sàng ở bên cạnh bạn Remix (我愿意平凡的陪在你身旁) - 蔡耀轩remix - Vương Thất Thất (王七七).mp4', NULL, 1630947295, 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gallerycategory`
--

CREATE TABLE `gallerycategory` (
  `NAME` varchar(50) DEFAULT NULL,
  `Note` varchar(255) DEFAULT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `gallerycategory`
--

INSERT INTO `gallerycategory` (`NAME`, `Note`, `ID`) VALUES
('imgnormal', NULL, 7),
('video', NULL, 8),
('avatar', NULL, 9),
('coverimg', NULL, 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mapbox`
--

CREATE TABLE `mapbox` (
  `id` int(11) NOT NULL,
  `membersid` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `paragraph` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `mapbox`
--

INSERT INTO `mapbox` (`id`, `membersid`, `location`, `title`, `paragraph`) VALUES
(1, 1, '108.210369, 16.074691', 'TÔI ĐÂY HỌC', 'Trung tâm đào tạo lập trình, marketting và đồ họa'),
(2, 1, '108.25189519999999,15.973589500000001', 'Ký túc xá Việt Hàn', 'Của Trường Việt Hàn nha haha'),
(3, 1, '108.25182939999999, 15.973586800000001', 'Khu A', 'femsle'),
(14, 1, '108.2518509, 15.9735851', '', ''),
(15, 1, '108.25183600000001, 15.973584400000002', 'Khu C', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `members`
--

CREATE TABLE `members` (
  `ID` int(11) NOT NULL,
  `author` int(10) DEFAULT NULL,
  `USER` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `family` smallint(6) DEFAULT NULL,
  `date` int(10) DEFAULT NULL,
  `firstname` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `lastname` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
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
-- Đang đổ dữ liệu cho bảng `members`
--

INSERT INTO `members` (`ID`, `author`, `USER`, `family`, `date`, `firstname`, `lastname`, `gender`, `birth`, `death`, `type`, `photo`, `email`, `site`, `tel`, `mobile`, `birthplace`, `paddress`, `deathplace`, `profession`, `company`, `interests`, `bio`, `level`, `parent`, `birthday`, `birthmonth`, `birthyear`, `deathday`, `deathmonth`, `deathyear`, `birthdate`, `maritalstatus`, `mariagedate`, `deathdate`, `facebook`, `instagram`, `twitter`, `longitude`, `latitude`) VALUES
(1, 2, '', 2, 1622435233, 'Nhân', 'Nguyễn hữu', 2, NULL, 1, 1, 'uploads/MTYyMjQzNTEzNTMyOTgxMjE3NjkyMTA4MDUwMDEyMA_1622435233.jpg', '123@email.com', '', '', '0914200244', 'Quang Nam', 'Da Nang', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 778352400, '', 1622435233, 1622435233, '', '', '', '', ''),
(2, 9, '', 4, 1623466023, '? ghmwssa', 'cedfv', 1, NULL, 1, 2, 'images/avatar/2.jpg', '', '', '', '', '', '', '', '', '', '', '', 0, 9, 0, 0, 0, 0, 0, 0, 1623466023, '', 1623466023, 1623466023, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `noi_song`
--

CREATE TABLE `noi_song` (
  `id` int(11) NOT NULL,
  `membersid` int(11) NOT NULL,
  `noi_song` varchar(255) NOT NULL,
  `mo_ta` varchar(255) NOT NULL,
  `che_do_hien_thi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `noi_song`
--

INSERT INTO `noi_song` (`id`, `membersid`, `noi_song`, `mo_ta`, `che_do_hien_thi`) VALUES
(17, 1, 'Da Nang', 'Tỉnh-Thành phố hiện tại', ''),
(18, 1, 'Huế', 'Quê quán', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `membersid` int(11) DEFAULT NULL,
  `Title` varchar(255) CHARACTER SET utf32 COLLATE utf32_vietnamese_ci DEFAULT NULL,
  `content` text DEFAULT NULL,
  `datecreate` int(11) DEFAULT NULL,
  `statuspost` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `post`
--

INSERT INTO `post` (`id`, `membersid`, `Title`, `content`, `datecreate`, `statuspost`) VALUES
(1, 1, 'Thủ tướng chỉ đạo thành lập 7 “Tổ công tác đặc biệt” phòng, chống COVID-19 tại TPHCM', '+ 33 ca ca?ch ly ngay sau khi nha??p ca?nh ta?i Thanh Ho?a (19), HCM (10), Ha? No??i (2), Qua?ng Nam (1), Bi?nh ?i?nh (1).\r\n+ 1.889 ca ghi nha??n trong nu?o??c ta?i TP. Ho?? Chi? Minh (1.399), Bi?nh Du?o?ng (122), ?o??ng Tha?p (63), ?o??ng Nai (60), Long An (41), ?a? Na??ng (33), Be??n Tre (30), Phu? Ye?n (30), Vi?nh Long (17), Bi?nh Thua??n (17), Bi?nh Phu?o??c (13), Hu?ng Ye?n (12), Ca??n Tho? (11), Ninh Thua??n (10), Ha? No??i (7), So?c Tra?ng (4), Qua?ng Nga?i (4), Kha?nh Ho?a (4), Ba??c Ninh (3), Tra? Vinh (3), Bi?nh ?i?nh (1), Ca? Mau (1), Vi?nh Phu?c (1), La?m ?o??ng (1), ?a??k La??k (1), Ba??c Giang (1); trong ?o? 1.685 ca ?u?o??c pha?t hie??n trong khu ca?ch ly hoa??c khu ?a? ?u?o??c phong toa?.', NULL, NULL),
(2, 1, '????????????????', 'C?p nh?t ?nh bìa', NULL, NULL),
(3, 1, 'C????????????????????', 'C?p nh?t ?nh ??i di?n', NULL, NULL),
(4, 1, 'hello', NULL, 1629799587, NULL),
(5, 1, 'hello', NULL, 1629799616, NULL),
(6, 1, 'hello😘😍😍', NULL, 1629799650, NULL),
(8, 1, '', NULL, 1629799828, NULL),
(10, 1, '😂😂😂😂\nxin chao', NULL, 1630139262, NULL),
(11, 1, '😂😂😂😂\nxin chao', NULL, 1630139274, NULL),
(14, 1, 'Cập nhật ảnh đại diện', NULL, 1630156439, NULL),
(15, 1, 'Cập nhật ảnh đại diện', NULL, 1630165672, NULL),
(16, 1, 'Cập \\', NULL, 1630245705, NULL),
(18, 1, 'Cập nhật ảnh đại diện', NULL, 1630251993, NULL),
(19, 1, 'Cập nhật ảnh đại diện', NULL, 1630252206, NULL),
(22, 1, 'Cập nhật ảnh đại diện', NULL, 1630253416, NULL),
(25, 1, 'Cập nhật ảnh đại diện', NULL, 1630253999, NULL),
(26, 1, 'Cập nhật ảnh đại diện', NULL, 1630254082, NULL),
(28, 1, 'Cập nhật ảnh đại diện', NULL, 1630255545, NULL),
(31, 1, 'Cập nhật ảnh đại diện', NULL, 1630419326, NULL),
(35, 1, 'hhh', NULL, 1630464409, NULL),
(37, 1, 'Cập nhật ảnh bìa', NULL, 1630464457, NULL),
(39, 1, 'xin chao nhes', NULL, 1630465012, NULL),
(41, 1, 'Cập nhật ảnh đại diện', NULL, 1630465538, NULL),
(42, 1, 'Cập nhật ảnh bìa', NULL, 1630488182, NULL),
(43, 1, 'Cập nhật ảnh bìa', NULL, 1630488235, NULL),
(46, 1, 'Thêm 1ảnh', NULL, 1630506492, NULL),
(47, 1, 'Thêm 1ảnh', NULL, 1630506669, NULL),
(48, 1, 'Thêm 3ảnh', NULL, 1630506705, NULL),
(49, 1, 'Thêm 1 ảnh', NULL, 1630507242, NULL),
(50, 1, 'Thêm 1 ảnh', NULL, 1630507490, NULL),
(56, 1, 'Thêm 1 Video', NULL, 1630577707, NULL),
(57, 1, 'hh', NULL, 1630591958, NULL),
(58, 1, 'Cập nhật ảnh bìa', NULL, 1630660255, NULL),
(61, 1, 'Cập nhật ảnh bìa', NULL, 1630769500, NULL),
(64, 1, 'Cập nhật ảnh bìa', NULL, 1630769918, NULL),
(65, 1, 'You can also attach the click handlers to the body so that they never get destroyed in the first place.\nYou can also attach the click handlers to the body so that they never get destroyed in the first place.', NULL, 1630834384, NULL),
(76, 1, '<p><i><strong>xin chao nhes </strong></i><span style=\"background-color:hsl(60, 75%, 60%);\"><i><strong>haha</strong></i></span></p>', NULL, 1630933778, NULL),
(79, 1, '<figure class=\"table\"><table><tbody><tr><td>Giap</td><td>Nhan</td><td>Duy</td><td>Hien</td><td>Hung</td></tr><tr><td>4</td><td>4</td><td>8</td><td>7</td><td>8</td></tr><tr><td>2</td><td>2</td><td>3</td><td>6</td><td>7</td></tr></tbody></table></figure>', NULL, 1630935347, NULL),
(80, 1, 'Thêm 1 ảnh', NULL, 1630947276, NULL),
(81, 1, 'Thêm 1 Video', NULL, 1630947295, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `postaction`
--

CREATE TABLE `postaction` (
  `ID` int(11) NOT NULL,
  `postid` int(11) DEFAULT NULL,
  `membersid` int(11) NOT NULL,
  `react` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `postaction`
--

INSERT INTO `postaction` (`ID`, `postid`, `membersid`, `react`) VALUES
(17, 37, 1, 'like'),
(20, 39, 1, 'like'),
(28, 35, 1, 'like'),
(29, 31, 1, 'like'),
(30, 28, 1, 'like'),
(31, 26, 1, 'like'),
(32, 25, 1, 'like'),
(33, 22, 1, 'like'),
(34, 19, 1, 'like'),
(35, 18, 1, 'like'),
(36, 16, 1, 'like'),
(37, 15, 1, 'like'),
(38, 14, 1, 'like'),
(40, 11, 1, 'like'),
(41, 10, 1, 'like'),
(42, 8, 1, 'like'),
(43, 6, 1, 'like'),
(44, 5, 1, 'like'),
(45, 4, 1, 'like'),
(46, 1, 1, 'like'),
(47, 2, 1, 'like'),
(48, 3, 1, 'like'),
(49, 46, 1, 'like'),
(52, 56, 1, 'like'),
(53, 65, 1, 'like'),
(58, 64, 1, 'like'),
(59, 76, 1, 'like');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `su_kien_trong_doi`
--

CREATE TABLE `su_kien_trong_doi` (
  `id` int(11) NOT NULL,
  `membersid` int(11) NOT NULL,
  `thoi_gian` varchar(255) NOT NULL,
  `su_kien` varchar(255) NOT NULL,
  `chi_tiet_su_kien` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `su_kien_trong_doi`
--

INSERT INTO `su_kien_trong_doi` (`id`, `membersid`, `thoi_gian`, `su_kien`, `chi_tiet_su_kien`) VALUES
(1, 1, '2025', 'Kết hôn ', 'Đã tìm được nửa kia nên kết hôn haha'),
(3, 1, '20-05-2022', 'Đã có nhà mới tại Đà Nẵng haha', 'Sau những cố gắng thì cũng đạt được ước mơ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thong_tin_co_ban`
--

CREATE TABLE `thong_tin_co_ban` (
  `id` int(11) NOT NULL,
  `membersid` int(11) NOT NULL,
  `loai_thong_tin` varchar(255) NOT NULL,
  `thong_tin_co_ban` varchar(255) NOT NULL,
  `che_do_hien_thi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `thong_tin_co_ban`
--

INSERT INTO `thong_tin_co_ban` (`id`, `membersid`, `loai_thong_tin`, `thong_tin_co_ban`, `che_do_hien_thi`) VALUES
(1, 1, 'Giới tính', 'Nam', ''),
(2, 1, 'Ngày sinh ', '26/06/2007', ''),
(5, 1, 'Tình trạng quan hệ', 'Độc thân', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thong_tin_lien_he`
--

CREATE TABLE `thong_tin_lien_he` (
  `id` int(11) NOT NULL,
  `membersid` int(11) NOT NULL,
  `loai_lien_he` varchar(255) NOT NULL,
  `thong_tin_lien_he` varchar(255) NOT NULL,
  `che_do_hien_thi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `thong_tin_lien_he`
--

INSERT INTO `thong_tin_lien_he` (`id`, `membersid`, `loai_lien_he`, `thong_tin_lien_he`, `che_do_hien_thi`) VALUES
(2, 1, 'Số điện thoại', '0394684472', ''),
(3, 1, 'Email', 'giapho.06082000@gmail.com', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tieu_su`
--

CREATE TABLE `tieu_su` (
  `id` int(11) NOT NULL,
  `membersid` int(11) NOT NULL,
  `mo_ta` varchar(255) NOT NULL,
  `noidung_ts` varchar(255) NOT NULL,
  `anh_logo` varchar(255) NOT NULL,
  `che_do_hien_thi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tieu_su`
--

INSERT INTO `tieu_su` (`id`, `membersid`, `mo_ta`, `noidung_ts`, `anh_logo`, `che_do_hien_thi`) VALUES
(3, 1, 'Tính cách', 'Hoa đồng', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `membersid` (`membersid`),
  ADD KEY `postid` (`postid`);

--
-- Chỉ mục cho bảng `cong_viec`
--
ALTER TABLE `cong_viec`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `postid` (`postid`),
  ADD KEY `gallerycategoryid` (`gallerycategoryid`);

--
-- Chỉ mục cho bảng `gallerycategory`
--
ALTER TABLE `gallerycategory`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `mapbox`
--
ALTER TABLE `mapbox`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `noi_song`
--
ALTER TABLE `noi_song`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membersid` (`membersid`);

--
-- Chỉ mục cho bảng `postaction`
--
ALTER TABLE `postaction`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `postid` (`postid`),
  ADD KEY `membersid` (`membersid`);

--
-- Chỉ mục cho bảng `su_kien_trong_doi`
--
ALTER TABLE `su_kien_trong_doi`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thong_tin_co_ban`
--
ALTER TABLE `thong_tin_co_ban`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thong_tin_lien_he`
--
ALTER TABLE `thong_tin_lien_he`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tieu_su`
--
ALTER TABLE `tieu_su`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `cong_viec`
--
ALTER TABLE `cong_viec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT cho bảng `gallery`
--
ALTER TABLE `gallery`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `gallerycategory`
--
ALTER TABLE `gallerycategory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `mapbox`
--
ALTER TABLE `mapbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `members`
--
ALTER TABLE `members`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `noi_song`
--
ALTER TABLE `noi_song`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT cho bảng `postaction`
--
ALTER TABLE `postaction`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT cho bảng `su_kien_trong_doi`
--
ALTER TABLE `su_kien_trong_doi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `thong_tin_co_ban`
--
ALTER TABLE `thong_tin_co_ban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `thong_tin_lien_he`
--
ALTER TABLE `thong_tin_lien_he`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tieu_su`
--
ALTER TABLE `tieu_su`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`membersid`) REFERENCES `members` (`ID`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`postid`) REFERENCES `post` (`id`);

--
-- Các ràng buộc cho bảng `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `gallery_ibfk_2` FOREIGN KEY (`gallerycategoryid`) REFERENCES `gallerycategory` (`ID`);

--
-- Các ràng buộc cho bảng `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`membersid`) REFERENCES `members` (`ID`);

--
-- Các ràng buộc cho bảng `postaction`
--
ALTER TABLE `postaction`
  ADD CONSTRAINT `postaction_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `postaction_ibfk_2` FOREIGN KEY (`membersid`) REFERENCES `members` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
