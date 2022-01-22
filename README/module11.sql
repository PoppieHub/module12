-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 16 2022 г., 01:09
-- Версия сервера: 8.0.19
-- Версия PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `module11`
--

-- --------------------------------------------------------

--
-- Структура таблицы `home`
--

CREATE TABLE `home` (
  `id` int NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `birth` date NOT NULL,
  `city` text NOT NULL,
  `author` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `home`
--

INSERT INTO `home` (`id`, `firstName`, `lastName`, `birth`, `city`, `author`) VALUES
(1, 'Андрей', 'Королев', '1999-06-05', 'Челябинск', 1),
(2, 'Петя', 'Тестовый', '1900-12-26', 'город которого нет(', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `periodoflife`
--

CREATE TABLE `periodoflife` (
  `id` int NOT NULL,
  `json` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `periodoflife`
--

INSERT INTO `periodoflife` (`id`, `json`) VALUES
(1, '{\"0\": {\"namePeriod\": \"подростковый\", \"periodFrom\": \"12\", \"periodUpTo\": \"16\"}, \"1\": {\"namePeriod\": \"юношеский\", \"periodFrom\": \"17\", \"periodUpTo\": \"20\"}, \"2\": {\"namePeriod\": \"зрелый возраст, 1 период\", \"periodFrom\": \"21\", \"periodUpTo\": \"34\"}, \"3\": {\"namePeriod\": \"зрелый возраст, 2 период\", \"periodFrom\": \"35\", \"periodUpTo\": \"59\"}, \"4\": {\"namePeriod\": \"пожилой возраст\", \"periodFrom\": \"60\", \"periodUpTo\": \"74\"}, \"5\": {\"namePeriod\": \"старческий возраст\", \"periodFrom\": \"75\", \"periodUpTo\": \"89\"}, \"6\": {\"namePeriod\": \"долгожители\", \"periodFrom\": \"90\", \"periodUpTo\": \"none\"}, \"7\": {\"namePeriod\": \"детский\", \"periodFrom\": \"none\", \"periodUpTo\": \"11\"}}');

-- --------------------------------------------------------

--
-- Структура таблицы `portfolio`
--

CREATE TABLE `portfolio` (
  `id` int NOT NULL,
  `title` text NOT NULL,
  `description` text,
  `scr` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `portfolio`
--

INSERT INTO `portfolio` (`id`, `title`, `description`, `scr`) VALUES
(1, 'ejournal', 'Электронный журнал на PHP фреймворке Symfony. Данное приложение создавалось мною с нуля, чтобы ознакомится с одним из крутых фреймворком.\r\nВеб-приложение, представляет разделение ролей пользователей и иметь следующие возможности:\r\nДля преподавателя – возможность выбора прикрепленных ему дисциплин, выбора групп, отображение студентов выбранной группы и управление посещаемостью студентов, вывод статистики по выбранному студенту.\r\nДля студента – возможность выбора прикрепленной дисциплины и вывод статистики посещаемости по данной дисциплине. \r\nДля деканата – отображение статистики по группам и вывод статистики студента из выбранной группы. \r\nА также функционал администратора, обладающего возможностью управлением и редактированием данных. \r\nПрофиль пользователя, обладающего возможностью редактированием данных. \r\n', 'https://github.com/PoppieHub/ejournal'),
(2, 'metrics', 'Метрика - приложения для анализа поведения посетителей на веб-ресурсе. Также написана на Symfony.\r\nПриложение обладает функционалом:\r\nподсчет уникальных пользователей за текущий день,\r\nподсчет просмотров страниц за текущий день,\r\nимеет статистику посещаемости за период в виде графика,\r\nимеет статистику устройств пользователей за все время,\r\nподсчет просмотров конкретных страниц.\r\nА также имеет возможность управления страницами и второстепенными посадочными страницами.', 'https://github.com/PoppieHub/metrics'),
(3, 'Новостной портал на Yii-2', 'Простое приложение. Реализовывалось мной для ознакомления со спецификой фреймворка Yii2.', 'https://github.com/PoppieHub/yii-application'),
(4, 'Электронный журнал посещаемости на yii2.', 'Более упрощенное приложение на yii2, чем сообрат на symfony, но из общего только схожесть таблиц в бд. Создавалось более 3 лет назад, на github мною не публиковалось.', NULL),
(5, 'Моделирование математической функции при помощи нейронной сети на Python.', 'Целью разработки этой системы являлось распознавание математической функции и\r\nработа с большим количеством данных, на основании которых прогнозируется\r\nрезультат. Для работы было выбрано арифметическое среднее 500\r\nчисел, генерируем для нее\r\nправильных ответов.', 'https://github.com/PoppieHub/NN_find_mean');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `periodoflife`
--
ALTER TABLE `periodoflife`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `home`
--
ALTER TABLE `home`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `periodoflife`
--
ALTER TABLE `periodoflife`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
