-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Сен 09 2022 г., 17:49
-- Версия сервера: 8.0.30-0ubuntu0.20.04.2
-- Версия PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `optica`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category_translations`
--

CREATE TABLE `category_translations` (
  `id` int UNSIGNED NOT NULL,
  `category_id` int UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `body` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `category_translations`
--

INSERT INTO `category_translations` (`id`, `category_id`, `locale`, `name`, `body`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(1, 67, 'ru', 'Контактные линзы', '<div>\r\n<h1 itemprop=\"headline\" style=\"font-size: 20px; line-height: 20px; text-align: center; font-weight: bolder;\"></h1>\r\n<div>\r\n<h1 itemprop=\"headline\">Контактные линзы купить стоит</h1>\r\n<p itemprop=\"description\">Как правило, желание контактные линзы к', 'Контактные линзы купить. Купить контактные линзы в Киеве', 'однодневные линзы купить, купить силикон-гидрогелевые линзы, купить однодневки, купить линзы дейлис тотал, купить линзы DAILIES TOTAL', 'Купить контактные линзы в Киеве и в интернет магазине «Myoptics» в широком ассортименте. Контактные линзы купить недорого по хорошим и доступным ценам'),
(2, 67, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(3, 73, 'ru', 'Растворы и капли', '<div itemscope=\" \">\r\n<h1 itemprop=\"headline\" style=\"font-size: 20px; line-height: 20px; text-align: center; font-weight: bolder;\">Купить капли для линз качество, доказанное временем и проверенное покупателем</h1>\r\n<p itemprop=\"description\" style=\"text-ind', NULL, NULL, NULL),
(4, 73, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(5, 76, 'ru', 'Однодневные линзы', '<div itemscope=\" \">\r\n<h1 itemprop=\"headline\" style=\"font-size: 20px; line-height: 20px; text-align: center; font-weight: bolder;\">Где купить однодневные линзы выгодно</h1>\r\n<p itemprop=\"description\" style=\"text-indent: 20px; line-height: 20px; text-align:', NULL, NULL, NULL),
(6, 76, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(7, 77, 'ru', 'Линзы на 2 недели', '<div itemscope=\" \">\r\n<h1 itemprop=\"headline\" style=\"font-size: 20px; line-height: 20px; text-align: center; font-weight: bolder;\">Почему стоит приобрести двухнедельные линзы у нас</h1>\r\n<p itemprop=\"description\" style=\"text-indent: 20px; line-height: 20px', NULL, NULL, NULL),
(8, 77, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(9, 78, 'ru', 'Линзы на квартал', '<div itemscope=\" \">\r\n<h1 itemprop=\"headline\" style=\"font-size: 20px; line-height: 20px; text-align: center; font-weight: bolder;\">Несколько весомых аргументов в пользу приобретения линзы на квартал</h1>\r\n<p itemprop=\"description\" style=\"text-indent: 20px;', NULL, NULL, NULL),
(10, 78, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(11, 79, 'ru', 'Линзы на 6-9-12 мес', '', NULL, NULL, NULL),
(12, 79, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(13, 80, 'ru', 'Линзы с UV защитой', '<div itemscope=\" \">\r\n<h1 itemprop=\"headline\" style=\"font-size: 20px; line-height: 20px; text-align: center; font-weight: bolder;\">Где приобрести качественные ультрафиолетовые линзы с защитой от ультрафиолета</h1>\r\n<p itemprop=\"description\" style=\"text-ind', NULL, NULL, NULL),
(14, 80, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(15, 81, 'ru', 'Один месяц', '<div itemscope=\" \" itemENGINE=\"http://schema.org/Article\">\r\n<h1 itemprop=\"headline\" style=\"font-size: 20px; line-height: 20px; text-align: center; font-weight: bolder;\">Линзы на один месяц: особенности выбора</h1>\r\n<p itemprop=\"description\" style=\"text-in', NULL, NULL, NULL),
(16, 81, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(17, 82, 'ru', 'Торические линзы', '<div itemscope=\" \">\r\n<h1 itemprop=\"headline\" style=\"font-size: 20px; line-height: 20px; text-align: center; font-weight: bolder;\">Профессиональный подбор средств для коррекции зрения как торические линзы</h1>\r\n<p itemprop=\"description\" style=\"text-indent:', NULL, NULL, NULL),
(18, 82, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(19, 83, 'ru', 'Мультифокальные линзы', '<div itemscope=\" \">\r\n<h1 itemprop=\"headline\" style=\"font-size: 20px; line-height: 20px; text-align: center; font-weight: bolder;\">Где приобрести линзы по приемлемой цене в Украине</h1>\r\n<p itemprop=\"description\" style=\"text-indent: 20px; line-height: 20px', NULL, NULL, NULL),
(20, 83, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(21, 90, 'ru', 'Цветные линзы', '', NULL, NULL, NULL),
(22, 90, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(23, 74, 'ru', 'Аксессуары', '<div itemscope=\" \">\r\n<h1 itemprop=\"headline\" style=\"font-size: 20px; line-height: 20px; text-align: center; font-weight: bolder;\">Аксессуары для линз в широком ассортименте</h1>\r\n<p itemprop=\"description\" style=\"text-indent: 20px; line-height: 20px; text-', 'Аксессуары', 'дорожные наборы, дорожный набор, контейнер для линз, пинцет для линз, съемник для линз, пинцет, футляр для линз', 'Аксессуары для линз приобретайте у нас в интернет магазине «Myoptics» от оригенальных производителей. Купить дорожный контейнер для линз так же футляр для линз по хорошей и доступной цене'),
(24, 74, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(25, 84, 'ru', 'Многофункциональные', '<div itemscope=\" \">\r\n<h1 itemprop=\"headline\" style=\"font-size: 20px; line-height: 20px; text-align: center; font-weight: bolder;\">Купить растворы для контактных линз в нашем интернет магазине Myoptics</h1>\r\n<p itemprop=\"description\" style=\"text-indent: 20', 'Многофункциональные', '', 'Купить растворы для контактных линз в интернет магазине «Myoptics» растворы для линз продаются для вас. Какой раствор нужен для контактных линз звоните или приходите наши специалисты вам подскажут'),
(26, 84, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(27, 85, 'ru', 'Увлажняющие капли', '<div itemscope=\" \">\r\n<h1 itemprop=\"headline\" style=\"font-size: 20px; line-height: 20px; text-align: center; font-weight: bolder;\">Когда стоит купить увлажняющие капли</h1>\r\n<div itemprop=\"articleBody\">\r\n<p itemprop=\"description\" style=\"text-indent: 20px; ', 'Увлажняющие капли. Купить увлажняющие капли', '', 'Купить увлажняющие капли в интернет магазине «Myoptics» для увлажнение глаза и при использовании линзы. Увлажняющие капли купит недорого Киев по хорошим ценам'),
(28, 85, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(29, 86, 'ru', 'Пероксидные системы', '<div itemscope=\" \">\r\n<h1 itemprop=\"headline\" style=\"font-size: 20px; line-height: 20px; text-align: center; font-weight: bolder;\">Пероксидные системы очистки контактных линз или все о контейнерах для линз</h1>\r\n<p itemprop=\"description\" style=\"text-indent', 'Пероксидная система для линз купить. Пероксидные системы очистки контактных линз', '', 'Пероксидная система для линз купить в интернет магазине «Myoptics» от производителя высокого качества. Купить пероксидную систему для линз в Киеве по хорошей цене '),
(30, 86, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(31, 87, 'ru', 'Контейнеры', '<div itemscope=\" \">\r\n<h1 itemprop=\"headline\" style=\"font-size: 20px; line-height: 20px; text-align: center; font-weight: bolder;\"><span style=\"font-family: helvetica;\">Для чего нужны контейнеры для линз</span></h1>\r\n<p itemprop=\"description\" style=\"text-i', 'Купить контейнеры для линз. Контейнеры для линз', '', 'Контейнеры для линз в интернет магазине «Myoptics» аксессуары в широком ассортименте. Контейнеры для линз купить недорого в Киеве по хорошим ценам для каждого есть свой аксессуар'),
(32, 87, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(33, 88, 'ru', 'Пинцеты', '<div itemscope=\" \">\r\n<h1 itemprop=\"headline\" style=\"font-size: 20px; line-height: 20px; text-align: center; font-weight: bolder;\">Пинцеты для контактных линз в интернет магазине Myoptics</h1>\r\n<p itemprop=\"description\" style=\"text-indent: 20px; line-heigh', 'Пинцеты для линз. Пинцет для линз купить', '', 'Пинцет для линз как пользоваться при покупке в интернет магазине «Myoptics» вам покажут наглядное видео. Пинцет для линз купить по хорошей и выгодной цене'),
(34, 88, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(35, 89, 'ru', 'Дорожные наборы', '<div itemscope=\" \">\r\n<h1 itemprop=\"headline\" style=\"font-size: 20px; line-height: 20px; text-align: center; font-weight: bolder;\">Дорожные наборы для линз на все случаи жизни</h1>\r\n<p itemprop=\"description\" style=\"text-indent: 20px; line-height: 20px; tex', 'Дорожные наборы для линз. Наборы для линз', '', 'Дорожные наборы для линз можно приобрести в интернет магазине «Myoptics» в широком ассортименте. Купить дорожные наборы для линз по хорошим и доступным для вас ценам'),
(36, 89, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(37, 91, 'ru', 'Средства ферментной очистки', '', 'Средства ферментной очистки', '', ''),
(38, 91, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(39, 93, 'ru', 'Завершенные акции', '<p>Акции, которые время от времени повторяются производителями. Если вы очень терпеливы, можно подождать :)</p>', 'Завершенные акции', '', ''),
(40, 93, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(41, 97, 'ru', 'Акции и Супер цены', '', 'Акции и Супер цены', 'Акции на контактные линзы;  акции на растворы; Акционные предложения на контактные линзы; Линзы по скидке; Линзы со скидкой', 'Здесь мы размещаем действующие акции нашей онлайн оптики и представительств. Ознакомьтесь, пожалуйста, и мы уверены Вы найдете для себя что-то интересное. Хорошего Вам дня!'),
(42, 97, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(43, 98, 'ru', 'С гиалуроновой кислотой', '', 'С гиалуроновой кислотой', '', ''),
(44, 98, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(45, 99, 'ru', 'Растворы для ЖКЛ', '', 'Растворы для ЖКЛ', '', ''),
(46, 99, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(47, 101, 'ru', 'Все акции', '', 'Все акции', '', ''),
(48, 101, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(49, 102, 'ru', 'Догляд за окулярами', '<p>Засоби від запотівання окулярів, щитків, масок для плавання, лижних масок.</p>\r\n<p>Крім того спреї NOFOG застосовуються для&nbsp;очищення поверхні пластикових захисних щитків, окулярів, інших прозорих поверхонь.&nbsp;</p>\r\n<p>Засоби&nbsp;NOFOG забезпеч', 'Догляд за окулярами', 'засоби від запотівання скла, подарунок на день народження, ідея подарунка на день народження, подарок на день рождения, средство от запотевания стекла, средство очистки очков, средство для очистки очков, средство от потения стекол', 'Средства от запотевания стекол в масках, щитках, очках, подводных масках. Мягко очищают поверхность и создают длительный эффект NOFOG.'),
(50, 102, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(51, 103, 'ru', 'Присоски - манипуляторы', '', 'Присоски - манипуляторы', '', ''),
(52, 103, 'uk', ' nam uk', 'body uk', '-', '-', '-'),
(53, 104, 'ru', '', '', '', '', ''),
(54, 104, 'uk', ' nam uk', 'body uk', '-', '-', '-');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category_translations`
--
ALTER TABLE `category_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_translations_category_id_locale_unique` (`category_id`,`locale`),
  ADD KEY `category_translations_locale_index` (`locale`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category_translations`
--
ALTER TABLE `category_translations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `category_translations`
--
ALTER TABLE `category_translations`
  ADD CONSTRAINT `category_translations_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `dv_categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
