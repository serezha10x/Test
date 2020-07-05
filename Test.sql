-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 05 2020 г., 17:12
-- Версия сервера: 5.6.38
-- Версия PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Test`
--

CREATE DATABASE `Test`;
USE `Test`;

--
-- Структура таблицы `User`
--

CREATE TABLE `User` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `api_key` char(60) DEFAULT NULL COMMENT 'key - зарезервировано в MySQL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `User`
--

INSERT INTO `User` (`id`, `name`, `email`, `photo`, `api_key`) VALUES
(48, 'Eliot Anderson', 'anderson@gmail.com', '$2y$10$vh4tW8D7UgysxpcNIPbBe1afRDFwcVpaV70JShqLYjtGuWPQDH2i.webp', '$2y$10$13OKajsJStmMbAXRJZWQMu6Jqcwze596VqCubc8OMFZAlBtkeI3yu'),
(49, 'Darlin Andreson', 'darlin@email.com', '$2y$10$Pg3Q2IzZP9tDWflrmjR3OQuGj1.365VrgSyacBXUjWwJ4vROsoS.webp', '$2y$10$71FWbzzbU.J0fIT9Zd5P9u72/2kwvuCR.wFZwe44yfjdh.oEoWIOS'),
(50, 'Tyrell Wellick', 'ilovelinux@gmail.com', '$2y$10$G1XHuy8QWNyp.yXR4lSL.ZDagxks4RQWE4n5gDxYtQF0UpVSzDcC.webp', '$2y$10$vbznLmcykKXRUh8Ka1AyxuYRJsupyDC9YT1jZC0DDetpgG3jjlRm6'),
(51, 'Angela Moss', 'moss@email.us', '$2y$10$Un9Gy71RFB7C4PeFALzEseltB3fUysYmer0O7fsUrYteXkR.PorJe.webp', '$2y$10$vi1OQrWt6ABTmJ9n0nfIoek0dLSiLOKCz6wQagkHj9oI4PxERFBUC'),
(52, 'White Rose', 'wrose@mail.ru', '$2y$10$Yi688834ctYYozlKCV29JustM8Rl0Uhb98MUnCJAeczNqjsXAI0Am.webp', '$2y$10$4fR89Arhog1qY/x8wDVHV.K2tyxOOoBjLCMBBbcPN0wb6m3G8tZxy'),
(53, 'Thomas Shelby', 'in20th_there_is_not_email@gmail.com', '$2y$10$TmA1HZPg2i9DnTJUJkEPM.2NKONd9Xl8ofzZ96Gi0ULffW5W2TH9W.webp', '$2y$10$DfXRgqPoQZ9CYI0LBuQh1OAC6OC1lbEBBf8KqRXu57EyoQ6Vu3Z22'),
(62, 'Arthur Shelby', 'art_sh@anything.ua', '$2y$10$NVaa3ufcNqgln8LKO.YZ7eQzBNE8vNOh2XhEH2fpLsJbooqAyPHi..webp', '$2y$10$rbljlQSSApchAM9RwpAnyO/7zMe855F49O3BkcT29J0vYDLiD3Fmm'),
(63, 'Finn Shelby', 'fin_007@yandex.ru', '$2y$10$oio7g7CcZQKDy8ckFmK5Oje6zNMoEeBDKVJ4EkeMM4.zqlr9J0..webp', '$2y$10$DKmpDDuFnw88.1lKRgV1ueB2Muci6IbFBREalojx47erg2yUNE86C');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `User`
--
ALTER TABLE `User`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
