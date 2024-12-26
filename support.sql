-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Дек 25 2024 г., 00:20
-- Версия сервера: 5.7.24
-- Версия PHP: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `database`
--

-- --------------------------------------------------------

--
-- Структура таблицы `support`
--

CREATE TABLE `support` (
  `support_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `support`
--

INSERT INTO `support` (`support_id`, `name`, `email`, `message`) VALUES
(1, 'qwe', 'qwe@mail.ru', 'qwe'),
(2, 'asd', 'asd@mail.ru', 'asddddd');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`support_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `support`
--
ALTER TABLE `support`
  MODIFY `support_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
