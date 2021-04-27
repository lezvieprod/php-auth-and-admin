-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 27 2021 г., 20:44
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bitready`
--

-- --------------------------------------------------------

--
-- Структура таблицы `claims`
--

CREATE TABLE `claims` (
  `id` int(11) NOT NULL,
  `author` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `newValue` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `claims`
--

INSERT INTO `claims` (`id`, `author`, `title`, `value`, `newValue`, `status`) VALUES
(79, 'admin', 'Изменение архитектуры зданий на Ленинском проспекте', 'uploads/1619537601unnamed.jpg', 'uploads/1619537601a3e2812af66211f81849b98c94d2ecbd.jpg', 0),
(80, 'admin', 'Устранение неровностей дороги на площади Василевского', 'uploads/1619537631file.jpeg', 'uploads/1619537631f1a352a111c5cd4c1d1709497af912d0_XL.jpg', 1),
(81, 'admin', 'Обновить разметку дороги в поселке Ивановка	', 'uploads/1619537645471265eece5d91f2450da86398848e0c.jfif', 'uploads/1619537645unnamed (1).jpg', 1),
(87, 'user', 'Изменение архитектуры зданий на Ленинском проспекте', 'uploads/161954004740055-world_of_tanks_firefly_igra.jpg', NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(355) DEFAULT NULL,
  `login` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `avatar` varchar(500) DEFAULT NULL,
  `user_group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`, `avatar`, `user_group`) VALUES
(9, 'Сокол Илья Владиславович', 'admin', 'ilyxasokol2014@mail.ru', '21232f297a57a5a743894a0e4a801fc3', 'uploads/1618789296programming-wallpaper-gallery-o9lbk8va0wtmpn03.jpg', 1),
(10, 'Сокол Илья Владиславович2', 'user', 'ilyxasokol2014@mail.ru', 'ee11cbb19052e40b07aac0ca060c23ee', 'uploads/1619540013image_2021-04-22_13-07-08.png', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `claims`
--
ALTER TABLE `claims`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
