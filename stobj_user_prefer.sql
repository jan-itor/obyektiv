-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 14 2016 г., 00:16
-- Версия сервера: 5.5.49-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `nep4uku_objektiv`
--

-- --------------------------------------------------------

--
-- Структура таблицы `stobj_user_prefer`
--

CREATE TABLE IF NOT EXISTS `stobj_user_prefer` (
  `art_id` int(11) NOT NULL,
  `interest` int(11) NOT NULL,
  `not_interest` int(11) NOT NULL,
  `actual` int(11) NOT NULL,
  `not_actual` int(11) NOT NULL,
  `prefer_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`prefer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Дамп данных таблицы `stobj_user_prefer`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
