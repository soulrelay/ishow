-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 04, 2017 at 02:17 PM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ShowDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_collect`
--

CREATE TABLE `t_collect` (
  `collect_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `t_collect`
--

INSERT INTO `t_collect` (`collect_id`, `user_id`, `show_id`) VALUES
(5, 1, 2),
(12, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_comment`
--

CREATE TABLE `t_comment` (
  `comment_id` int(11) NOT NULL,
  `comment_content` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_time` datetime NOT NULL,
  `comment_stage` int(11) NOT NULL COMMENT '1-5代表评论星级',
  `user_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='评论表';

--
-- Dumping data for table `t_comment`
--

INSERT INTO `t_comment` (`comment_id`, `comment_content`, `comment_time`, `comment_stage`, `user_id`, `show_id`) VALUES
(2, '好听极了', '2017-10-24 00:00:00', 1, 1, 1),
(3, '再来一首', '2017-10-31 00:00:00', 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_place`
--

CREATE TABLE `t_place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '地点名称',
  `place_longitude` double NOT NULL COMMENT '经度',
  `place_latitude` double NOT NULL COMMENT '纬度',
  `place_desc` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '详细描述'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='演出地点';

--
-- Dumping data for table `t_place`
--

INSERT INTO `t_place` (`place_id`, `place_name`, `place_longitude`, `place_latitude`, `place_desc`) VALUES
(1, '苏州会议中心', 31.2132, 120.345345, '某某街道');

-- --------------------------------------------------------

--
-- Table structure for table `t_show`
--

CREATE TABLE `t_show` (
  `show_id` int(11) NOT NULL,
  `show_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `show_city` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '城市',
  `show_image` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT '演出图片的相对路径',
  `show_price` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '价格区间',
  `show_time` datetime NOT NULL,
  `show_desc` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT '详情描述',
  `show_state` int(11) NOT NULL COMMENT '1:售票中 2:售票结束',
  `place_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='演出表';

--
-- Dumping data for table `t_show`
--

INSERT INTO `t_show` (`show_id`, `show_title`, `show_city`, `show_image`, `show_price`, `show_time`, `show_desc`, `show_state`, `place_id`, `type_id`) VALUES
(1, '周杰伦演唱会', '北京', '1.png', '1000-2000', '2017-10-24 05:00:00', '周杰伦演唱会周杰伦演唱会周杰伦演唱会', 1, 1, 1),
(2, '张杰个人演唱会', '上海', '2.png', '1000', '2017-10-25 00:00:00', '张杰个人演唱会张杰个人演唱会张杰个人演唱会', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_type`
--

CREATE TABLE `t_type` (
  `type_id` int(11) NOT NULL COMMENT '主键，自增长',
  `type_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '类别名称'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='演出类别';

--
-- Dumping data for table `t_type`
--

INSERT INTO `t_type` (`type_id`, `type_name`) VALUES
(1, '演唱会'),
(2, '音乐会'),
(3, '歌剧舞剧'),
(4, '芭蕾');

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `user_id` int(11) NOT NULL,
  `user_phone` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_sex` int(11) DEFAULT NULL COMMENT '0:男 1:女',
  `user_header` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户表';

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`user_id`, `user_phone`, `user_password`, `user_sex`, `user_header`) VALUES
(1, '13581793456', '123', NULL, 'images/header/1508899430.png'),
(2, '18943256784', '2222222', NULL, 'images/header/1508899463.png'),
(7, '123', '232', NULL, NULL),
(8, '1', '222222222', NULL, NULL),
(9, '13456789345', 'dddd', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_collect`
--
ALTER TABLE `t_collect`
  ADD PRIMARY KEY (`collect_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `show_id` (`show_id`);

--
-- Indexes for table `t_comment`
--
ALTER TABLE `t_comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `show_id` (`show_id`);

--
-- Indexes for table `t_place`
--
ALTER TABLE `t_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `t_show`
--
ALTER TABLE `t_show`
  ADD PRIMARY KEY (`show_id`),
  ADD KEY `place_id` (`place_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `t_type`
--
ALTER TABLE `t_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_collect`
--
ALTER TABLE `t_collect`
  MODIFY `collect_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `t_comment`
--
ALTER TABLE `t_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `t_place`
--
ALTER TABLE `t_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_show`
--
ALTER TABLE `t_show`
  MODIFY `show_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_type`
--
ALTER TABLE `t_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键，自增长', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_collect`
--
ALTER TABLE `t_collect`
  ADD CONSTRAINT `fk_collect_show` FOREIGN KEY (`show_id`) REFERENCES `t_show` (`show_id`),
  ADD CONSTRAINT `fk_collect_user` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`user_id`);

--
-- Constraints for table `t_comment`
--
ALTER TABLE `t_comment`
  ADD CONSTRAINT `fk_comment_show` FOREIGN KEY (`show_id`) REFERENCES `t_show` (`show_id`),
  ADD CONSTRAINT `fk_comment_user` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`user_id`);

--
-- Constraints for table `t_show`
--
ALTER TABLE `t_show`
  ADD CONSTRAINT `fk_show_place` FOREIGN KEY (`place_id`) REFERENCES `t_place` (`place_id`),
  ADD CONSTRAINT `fk_show_type` FOREIGN KEY (`type_id`) REFERENCES `t_type` (`type_id`);
