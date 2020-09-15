-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3310
-- Время создания: Май 09 2020 г., 11:18
-- Версия сервера: 5.7.25
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `homework-6`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `Id_good_cart` int(11) NOT NULL,
  `id_good_catalog` int(11) NOT NULL,
  `quantity` bigint(20) NOT NULL DEFAULT '1',
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `category_goods`
--

CREATE TABLE `category_goods` (
  `id_category` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category_goods`
--

INSERT INTO `category_goods` (`id_category`, `name`) VALUES
(1, 'Смартфоны'),
(2, 'Умные книги'),
(3, 'Телевизоры'),
(4, 'Фотоаппараты'),
(5, 'Квадрокоптеры'),
(6, 'Планшеты'),
(7, 'Игровые приставки'),
(8, 'Аудиотехника'),
(9, 'Холодильники'),
(10, 'Электроплиты');

-- --------------------------------------------------------

--
-- Структура таблицы `makers`
--

CREATE TABLE `makers` (
  `id_maker` int(11) NOT NULL,
  `maker` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `makers`
--

INSERT INTO `makers` (`id_maker`, `maker`) VALUES
(1, 'Apple'),
(2, 'Honor'),
(3, 'LG'),
(4, 'SAMSUNG'),
(5, 'HUAWEI'),
(6, 'Xiaomi'),
(7, 'Nokia');

-- --------------------------------------------------------

--
-- Структура таблицы `shop`
--

CREATE TABLE `shop` (
  `id_good_catalog` int(11) NOT NULL,
  `id_category` int(30) NOT NULL,
  `id_maker` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `info` longtext NOT NULL,
  `big_img` varchar(100) NOT NULL DEFAULT 'https://via.placeholder.com/150  C/O https://placeholder.com/',
  `small_img` varchar(100) NOT NULL DEFAULT 'https://via.placeholder.com/150  C/O https://placeholder.com/'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop`
--

INSERT INTO `shop` (`id_good_catalog`, `id_category`, `id_maker`, `model`, `price`, `info`, `big_img`, `small_img`) VALUES
(29, 1, 6, 'Redmi Note 8 Pro 6/128GB', 15990, 'test', 'img/catalog/big_img/redmi-note-8-pro-6128gb_Big.jpg', 'img/catalog/small_img/redmi-note-8-pro-6128gb_Small.jpg'),
(38, 1, 2, 'Honor 20 Lite 4/128GB', 14990, 'test', 'img/catalog/big_img/honor-20-lite-4128gb_Big.jpg', 'img/catalog/small_img/honor-20-lite-4128gb_Small.jpg'),
(39, 1, 3, 'LG V30+', 29990, 'test', 'img/catalog/big_img/lg-v30_Big.jpg', 'img/catalog/small_img/lg-v30_Small.jpg'),
(40, 1, 1, 'Apple iPhone Xr 64GB', 48990, 'test', 'img/catalog/big_img/apple-iphone-xr-64gb_Big.jpg', 'img/catalog/small_img/apple-iphone-xr-64gb_Small.jpg'),
(41, 1, 1, 'iPhone SE (2020) ', 39990, 'test', 'img/catalog/big_img/iphone-se-2020_Big.jpg', 'img/catalog/small_img/iphone-se-2020_Small.jpg'),
(42, 1, 6, 'Xiaomi Redmi 8', 9370, 'test', 'img/catalog/big_img/xiaomi-redmi-8_Big.jpg', 'img/catalog/small_img/xiaomi-redmi-8_Small.jpg'),
(43, 1, 6, 'Xiaomi Redmi Note 8', 11659, 'test', 'img/catalog/big_img/xiaomi-redmi-note-8_Big.jpg', 'img/catalog/small_img/xiaomi-redmi-note-8_Small.jpg'),
(44, 1, 5, 'HUAWEI Y6s 3', 7590, 'test', 'img/catalog/big_img/huawei-y6s-3_Big.jpg', 'img/catalog/small_img/huawei-y6s-3_Small.jpg'),
(45, 1, 5, 'HUAWEI Y5 (2019) 32GB', 6490, 'test', 'img/catalog/big_img/huawei-y5-2019-32gb_Big.jpg', 'img/catalog/small_img/huawei-y5-2019-32gb_Small.jpg'),
(46, 1, 3, 'X power K220DS', 9990, 'test', 'img/catalog/big_img/x-power-k220ds_Big.jpg', 'img/catalog/small_img/x-power-k220ds_Small.jpg'),
(47, 1, 3, 'LG Q6+', 19990, 'test', 'img/catalog/big_img/lg-q6_Big.jpg', 'img/catalog/small_img/lg-q6_Small.jpg'),
(48, 1, 3, 'X view K500DS', 3990, 'test', 'img/catalog/big_img/x-view-k500ds_Big.jpg', 'img/catalog/small_img/x-view-k500ds_Small.jpg'),
(49, 1, 4, 'Galaxy S10 8/128GB', 49990, 'test', 'img/catalog/big_img/galaxy-s10-8128gb_Big.jpg', 'img/catalog/small_img/galaxy-s10-8128gb_Small.jpg'),
(50, 1, 4, 'Galaxy Note 10 Lite 6/128GB', 39990, 'test', 'img/catalog/big_img/galaxy-note-10-lite-6128gb_Big.jpg', 'img/catalog/small_img/galaxy-note-10-lite-6128gb_Small.jpg'),
(51, 1, 2, '9X 4/128GB', 15990, 'test', 'img/catalog/big_img/9x-4128gb_Big.jpg', 'img/catalog/small_img/9x-4128gb_Small.jpg'),
(52, 1, 2, '10 Lite 3/64GB', 10990, 'test', 'img/catalog/big_img/10-lite-364gb_Big.jpg', 'img/catalog/small_img/10-lite-364gb_Small.jpg'),
(53, 1, 5, 'Mate 30 Pro 8/256GB', 53333, 'test', 'img/catalog/big_img/mate-30-pro-8256gb_Big.jpg', 'img/catalog/small_img/mate-30-pro-8256gb_Small.jpg'),
(60, 1, 5, 'P30 Pro 8/256GB', 39650, 'qwerty', 'img/catalog/big_img/p30-pro-8256gb_Big.jpg', 'img/catalog/small_img/p30-pro-8256gb_Small.jpg'),
(61, 1, 5, 'Mate 20 lite', 13100, 'qwerty', 'img/catalog/big_img/mate-20-lite_Big.jpg', 'img/catalog/small_img/mate-20-lite_Small.jpg'),
(68, 1, 2, '10i 128GB', 12990, 'qwerty', 'img/catalog/big_img/10i-128gb_Big.jpg', 'img/catalog/small_img/10i-128gb_Small.jpg'),
(69, 1, 2, '20 6/128GB', 24990, 'qwery', 'img/catalog/big_img/20-6128gb_Big.jpg', 'img/catalog/small_img/20-6128gb_Small.jpg'),
(71, 1, 7, '6.2 3/32GB', 10862, 'qwerty', 'img/catalog/big_img/62-332gb_Big.jpg', 'img/catalog/small_img/62-332gb_Small.jpg'),
(72, 1, 7, '3310', 30000000, 'qwerty', 'img/catalog/big_img/3310_Big.jpg', 'img/catalog/small_img/3310_Small.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `second_name` varchar(100) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(11) NOT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `name`, `second_name`, `email`, `login`, `password`, `status`) VALUES
(4574, 'admin', NULL, NULL, 'admin', '0110', 1),
(4575, NULL, NULL, NULL, 'grey', '556', NULL),
(4578, 'Григорий', 'Микиртумов', 'mikigrigorij@yandex.ru', 'GrigoRASH6000', '1111', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Id_good_cart`) USING BTREE;

--
-- Индексы таблицы `category_goods`
--
ALTER TABLE `category_goods`
  ADD PRIMARY KEY (`id_category`);

--
-- Индексы таблицы `makers`
--
ALTER TABLE `makers`
  ADD PRIMARY KEY (`id_maker`);

--
-- Индексы таблицы `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id_good_catalog`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `Id_good_cart` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `category_goods`
--
ALTER TABLE `category_goods`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `makers`
--
ALTER TABLE `makers`
  MODIFY `id_maker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `shop`
--
ALTER TABLE `shop`
  MODIFY `id_good_catalog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4579;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
