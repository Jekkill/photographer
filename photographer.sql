-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 27 2018 г., 08:46
-- Версия сервера: 10.1.29-MariaDB
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `photographer`
--

-- --------------------------------------------------------

--
-- Структура таблицы `connection`
--

CREATE TABLE `connection` (
  `connection_id` int(10) UNSIGNED NOT NULL,
  `connection_user_id` int(10) UNSIGNED NOT NULL,
  `connection_session_id` varchar(100) NOT NULL,
  `connection_token` char(32) NOT NULL,
  `connection_expire` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `connection`
--

INSERT INTO `connection` (`connection_id`, `connection_user_id`, `connection_session_id`, `connection_token`, `connection_expire`) VALUES
(27, 14, 'r4930gl85ls9kiet94l9hmtr6b', 'byv0diil5nf6cg2punuvs7ff6ukbrupo', '2018-01-23 18:30:42'),
(28, 14, 'qgfgujv8m6nti80opm0i2mcdjh', '34q9f7ilh5kftr4j09qks3vh3fc3kkzk', '2018-01-26 11:42:45'),
(29, 14, 'qgfgujv8m6nti80opm0i2mcdjh', '34q9f7ilh5kftr4j09qks3vh3fc3kkzk', '2018-01-26 11:42:45'),
(30, 14, 'qgfgujv8m6nti80opm0i2mcdjh', '34q9f7ilh5kftr4j09qks3vh3fc3kkzk', '2018-01-26 11:42:45'),
(31, 14, 'abjhb23ku62sptb9ql9fnpag3l', 'cg3ozat35qkc91gevojyz09nggxbdtun', '2018-01-26 11:55:48'),
(32, 14, 'i5871s9j8g1bd0vmc61nd1bc5t', 'rmj3aign29hxrloulefqp8s30ifaitqa', '2018-01-27 09:45:44'),
(33, 14, '8g19ar7lipvcr67icdvmghao5b', 'wvdf6zt4c2thnmqik6zwmiv74tpq57uq', '2018-01-27 09:55:31'),
(34, 14, 'i99budj5kbneqs698japs98rfl', 'wkj4w3yesori2x7lhtmy46uf4fiwe6g8', '2018-01-27 09:56:05'),
(35, 14, 'jghqlq9r2h8plc9mnmrssdnmbr', 'qua7pvxx0b8mwrbtt10wospwa8094hbs', '2018-01-27 10:16:59');

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(10) UNSIGNED NOT NULL,
  `feedback_user_id` int(10) UNSIGNED NOT NULL,
  `feedback_text` varchar(500) NOT NULL,
  `feedback_path_to_image` varchar(500) NOT NULL,
  `feedback_date` date NOT NULL,
  `feedback_is_checked` tinyint(4) UNSIGNED NOT NULL,
  `feedback_is_visible` tinyint(4) UNSIGNED NOT NULL,
  `feedback_is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `feedback_user_id`, `feedback_text`, `feedback_path_to_image`, `feedback_date`, `feedback_is_checked`, `feedback_is_visible`, `feedback_is_deleted`) VALUES
(1, 1, '  Знаю Веру очень давно, около 5 лет. Каждый раз при необходимости прихожу к ней фотографироваться - никогда никаких проблем не было, фотографии она всегда делает быстро  и отдает их заблаговременно. К тому же, в отличии от других фотографов, ведет себя сдержано и , естественно, никогда не позволяет себе повысить голос.   ', 'sfasffsfdhsdvafdsfasf897.jpg', '2016-11-10', 1, 1, 0),
(2, 2, 'Отмечаю пунктуальность и профессионализм (снимки делались с огромной скоростью, видно, что выбор тех или иных настроек камеры выполнялся за доли секунды). Прекрасное чувство юмора, благодаря которому хорошие снимки получились даже в конце дня, когда все падали с ног. ', 'dfakjfhasjfhasgfafkl8789.jpg', '2017-02-20', 1, 1, 0),
(3, 3, 'Спасибо огромное, Вера, за потрясающие фотографии! Вы заряжали нас энергией весь день, с вами было легко и приятно работать. Я боялась, что очень устану на прогулке, но она пронеслась как одно мгновение.', 'sfgasfahassfas7878.jpg', '2017-05-15', 1, 1, 0),
(4, 5, 'Очень рады, что, выбирая фотографа на свадьбу, в итоге обратились к Вере. На протяжении всей подготовки к событию она отвечала на возникающие вопросы по фотосессии и не только, в день свадьбы приехала вовремя, на протяжении всего дня работала очень деликатно и ненавязчиво.', 'dsadavaxfjahfjhasf7878.jpg', '2017-10-16', 1, 1, 0),
(6, 12, 'asfadgadsgzxczsdasf', 'noPhoto.jpg', '2018-01-21', 0, 0, 1),
(7, 15, ' ufkajslkjflk;dsa ', 'noPhoto.jpg', '2018-01-22', 0, 0, 1),
(10, 20, 'Спасибо большое Вере за фото нашего камерного праздника! Фотографии получились очень живыми, естественным, потому что мы были собой, а Вера это все \"словила\" и оформила в карточки, которые всю жизнь будут напоминать нам об этом событии и греть сердце.', '1517038503.jpg', '2018-01-27', 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `request`
--

CREATE TABLE `request` (
  `request_id` int(10) UNSIGNED NOT NULL,
  `request_user_id` int(10) UNSIGNED NOT NULL,
  `request_date` date DEFAULT NULL,
  `request_text` varchar(500) DEFAULT NULL,
  `request_is_checked` tinyint(4) UNSIGNED NOT NULL,
  `request_is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `request`
--

INSERT INTO `request` (`request_id`, `request_user_id`, `request_date`, `request_text`, `request_is_checked`, `request_is_deleted`) VALUES
(1, 1, '2018-02-02', '  Нужен фотограф на детский праздник. Сможете ?', 1, 0),
(2, 5, '2018-02-25', '     В этот день нужно будет пофотографировать детей на празднике. Поможете?     ', 1, 0),
(3, 16, '2018-01-31', 'HSfhashfhaslfhahsfh', 0, 1),
(4, 18, '2018-03-09', ' В этот день хотим сыграть свадьбу с девушкой. Хотелось бы проконсультироваться насчёт цены.  ', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_number` varchar(50) DEFAULT NULL,
  `user_is_deleted` tinyint(4) UNSIGNED NOT NULL,
  `user_is_admin` tinyint(4) UNSIGNED NOT NULL,
  `user_password` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_number`, `user_is_deleted`, `user_is_admin`, `user_password`) VALUES
(1, 'Юлия', 'uliya@rambler.ru', '79217455465', 0, 0, NULL),
(2, 'Василий', 'vasilii@yandex.ru', NULL, 0, 0, NULL),
(3, 'Антонина', 'tonya@gmail.com', '79513428590', 0, 0, NULL),
(4, 'Василиса', 'vasilisa@gmail.ru', NULL, 0, 0, NULL),
(5, 'Дмитрий', 'dmitrii@mail.ru', '79505552136', 0, 0, NULL),
(12, 'Elena', 'jakdsjfkajsfk@fjaskjadkg.ashf', NULL, 0, 0, NULL),
(14, '', 'admin@admin.ru', NULL, 0, 1, 'a5e70b2d3967e62733bf294d239792c4'),
(15, 'egdsgqw', 'sdgsd@agsad.ru', NULL, 0, 0, NULL),
(16, 'HJdfajf', 'asjfjaksfj@asfjask.ru', '78413241686', 0, 0, NULL),
(18, 'Андрей', 'andrei@gmail.com', '79536574532', 0, 0, NULL),
(20, 'Арина', 'arina@main.ru', NULL, 0, 0, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `connection`
--
ALTER TABLE `connection`
  ADD PRIMARY KEY (`connection_id`),
  ADD KEY `connection_user_id` (`connection_user_id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `feedback_user_id` (`feedback_user_id`);

--
-- Индексы таблицы `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `request_user_id` (`request_user_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `connection`
--
ALTER TABLE `connection`
  MODIFY `connection_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `connection`
--
ALTER TABLE `connection`
  ADD CONSTRAINT `connection_ibfk_1` FOREIGN KEY (`connection_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`feedback_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`request_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
