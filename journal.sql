-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 28 2017 г., 23:55
-- Версия сервера: 5.5.50
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `journal`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Проведение обучения и консультаций.'),
(2, 'Техническая поддержка пользователей');

-- --------------------------------------------------------

--
-- Структура таблицы `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `event`
--

INSERT INTO `event` (`id`, `name`, `count`, `category_id`) VALUES
(1, 'обучение и консультации преподавателей и сотрудников работе в системе управления обучением «LMS-Школа»', 1, 1),
(2, 'обучение сотрудников СПбКВК работе с электронным документооборота OnlyOffice', 12, 1),
(3, 'консультации для преподавателей и воспитателей по работе с электронным документооборота OnlyOffice', 27, 1),
(4, 'оказание оперативной помощи сотрудникам СПбКВК (не включается, «тормозит», не работает)', 148, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`) VALUES
(1, 'Дьячок Михаил Сергеевич'),
(2, 'Бикулин Павел Петрович'),
(3, 'Абушинов Александр Александрович');

-- --------------------------------------------------------

--
-- Структура таблицы `users_event`
--

CREATE TABLE IF NOT EXISTS `users_event` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_event`
--

INSERT INTO `users_event` (`id`, `user_id`, `event_id`, `count`, `date`) VALUES
(1, 3, 1, 1, '2017-08-26'),
(2, 2, 2, 12, '2017-05-11'),
(3, 1, 3, 27, '2017-06-02'),
(4, 2, 4, 128, '2017-07-14'),
(5, 3, 4, 20, '2017-08-28');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_event`
--
ALTER TABLE `users_event`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `users_event`
--
ALTER TABLE `users_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
