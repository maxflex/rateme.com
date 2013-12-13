-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 13, 2013 at 07:47 AM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `settings`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID пользователя',
  `email` varchar(255) CHARACTER SET cp1251 DEFAULT NULL,
  `password` varchar(255) CHARACTER SET cp1251 DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET cp1251 DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET cp1251 DEFAULT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'img/profile/noava.png' COMMENT 'URL аватара',
  `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Пол (0 - мужской, 1 - женский)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1256 COMMENT='Пользователи' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `avatar`, `gender`) VALUES
(1, 'maksim@kolyadin.com', '184005', 'Максим', 'Гамезо', 'http://cs409627.vk.me/v409627117/6048/8syrgkkHwog.jpg', 0),
(2, 'gamezo-fortochnik@gmail.com', 'petuhfortochnik', 'Александр', 'Гамезо', 'img/profile/noava.png', 0);
--
-- Database: `user_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `adjectives`
--

CREATE TABLE `adjectives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adjective` varchar(20) CHARACTER SET cp1251 NOT NULL COMMENT 'Прилагательное',
  `likes` int(11) NOT NULL DEFAULT '1' COMMENT 'Кол-во голосов "за"',
  `dislikes` int(11) NOT NULL DEFAULT '0' COMMENT 'Кол-во голосов "против"',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Отзывы о пользователе (прилагательные)' AUTO_INCREMENT=10 ;

--
-- Dumping data for table `adjectives`
--

INSERT INTO `adjectives` (`id`, `adjective`, `likes`, `dislikes`) VALUES
(1, 'охуенен', 1, 0),
(2, 'здорова', 0, 0),
(3, 'замалымный', 0, 0),
(4, 'пасатиж', 0, 0),
(7, 'замалымный', 1, 0),
(8, 'простофиля', 2, 0),
(9, 'заебический', 1, 0);