-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 02 2016 г., 13:23
-- Версия сервера: 5.5.48
-- Версия PHP: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `new_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Podija`
--

CREATE TABLE IF NOT EXISTS `Podija` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `description` text,
  `date` date NOT NULL,
  `members` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Podija`
--

INSERT INTO `Podija` (`id`, `Name`, `description`, `date`, `members`) VALUES
(1, 'Вилаз', 'чалтмиролт ьит', '2016-05-19', 'миьитбь'),
(2, 'dfg', 'hf', '0000-00-00', 'cgj');

-- --------------------------------------------------------

--
-- Структура таблицы `yii2_start_blogs`
--

CREATE TABLE IF NOT EXISTS `yii2_start_blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `snippet` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `image_url` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `preview_url` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `status_id` smallint(6) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `yii2_start_blogs`
--

INSERT INTO `yii2_start_blogs` (`id`, `title`, `alias`, `snippet`, `content`, `image_url`, `preview_url`, `views`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 'Blog', 'blog', '', '<p>Kontent</p>', '5742fe9ee76ce.jpg', '', 0, 0, 1464008380, 1464008380);

-- --------------------------------------------------------

--
-- Структура таблицы `yii2_start_categoty_of_tutorials`
--

CREATE TABLE IF NOT EXISTS `yii2_start_categoty_of_tutorials` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `yii2_start_comments`
--

CREATE TABLE IF NOT EXISTS `yii2_start_comments` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `model_class` int(11) unsigned NOT NULL,
  `model_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status_id` tinyint(2) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `yii2_start_comments_models`
--

CREATE TABLE IF NOT EXISTS `yii2_start_comments_models` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status_id` smallint(6) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `yii2_start_migration`
--

CREATE TABLE IF NOT EXISTS `yii2_start_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `yii2_start_migration`
--

INSERT INTO `yii2_start_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1460971922),
('m140418_204054_create_module_tbl', 1460971935),
('m140526_193056_create_module_tbl', 1460972032),
('m140911_074715_create_module_tbl', 1460972370);

-- --------------------------------------------------------

--
-- Структура таблицы `yii2_start_module`
--

CREATE TABLE IF NOT EXISTS `yii2_start_module` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL COMMENT 'Заголовок',
  `text` text NOT NULL COMMENT 'Описание',
  `sortOrder` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `yii2_start_module`
--

INSERT INTO `yii2_start_module` (`id`, `name`, `text`, `sortOrder`) VALUES
(1, 'Заголовок', 'Описание', 2),
(2, 'Заголовок2', 'Jagermeister', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `yii2_start_profiles`
--

CREATE TABLE IF NOT EXISTS `yii2_start_profiles` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `avatar_url` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `yii2_start_profiles`
--

INSERT INTO `yii2_start_profiles` (`user_id`, `name`, `surname`, `avatar_url`) VALUES
(1, 'Administration', 'Site', ''),
(2, 'Олександр', 'Савченко', '574e05f774429.jpg'),
(3, 'Олександр', 'Савченко', '574e073286590.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `yii2_start_tutorial`
--

CREATE TABLE IF NOT EXISTS `yii2_start_tutorial` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description_short` text NOT NULL,
  `description` text NOT NULL,
  `preview_url` varchar(64) NOT NULL,
  `status` int(11) NOT NULL,
  `alias` varchar(128) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `yii2_start_tutorial`
--

INSERT INTO `yii2_start_tutorial` (`id`, `title`, `category_id`, `description_short`, `description`, `preview_url`, `status`, `alias`, `sort_order`, `date`, `views`) VALUES
(1, '1234', 12, 'yftgy', 'hgfgf', '5746c9f98030e.jpg', 12, '12', 12, 12, 123),
(2, 'New title', 1, 'Всем привет это Сатурн', 'Добро пожаловать на дни еврейского умопомешательства и прочие праздники жизни', '574738ac54bc4.jpg', 1, 'alias', 1, 121311313, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `yii2_start_tutorial_category`
--

CREATE TABLE IF NOT EXISTS `yii2_start_tutorial_category` (
  `id` int(11) NOT NULL,
  `tutorial_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `yii2_start_users`
--

CREATE TABLE IF NOT EXISTS `yii2_start_users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(53) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `status_id` smallint(6) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `yii2_start_users`
--

INSERT INTO `yii2_start_users` (`id`, `username`, `email`, `password_hash`, `auth_key`, `token`, `role`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@demo.com', '$2y$13$8DahHg9EPze2RgFWncE3ZuHhSGqV3uvxW3QNA9p5hBTC0D/UVcUe2', 'QMaek1oDk3Zt8soiTcMDbHtaQICiyRir', 'aINmxtTB429Qx5r6aeyVpW9q0ydA9AVo_1460971935', 'superadmin', 1, 1460971934, 1460971934),
(2, 'Zoturn', 'saturncheg@ukr.net', '$2y$13$ZO4tSIRut1WMkJBXgT/QBeJ37gvJrTP3Dl9xACWVFtqeuQxWl/ob6', '5tlSFvNmzkGpau9xNzeHCdnYI_nWgSXL', 'NVzm6ECbmgYvd_irJP11uMRVMP22wnyz_1464731135', 'user', 0, 1464731135, 1464731135),
(3, 'Zoturnj', 'satturrn@gmail.com', '$2y$13$sT8sSrLjz7ARc2T061MAY.xhkyXYWoC6sOcuyG1iUJqTg4PjE3A1q', '9Yg0hO9NeSu5ARLEkPnw-a_xmX_3GmuG', '4R_D3YV1jPMCmwfFWL8uMXzlU0pU7D8D_1464731454', 'user', 0, 1464731454, 1464731454);

-- --------------------------------------------------------

--
-- Структура таблицы `yii2_start_user_email`
--

CREATE TABLE IF NOT EXISTS `yii2_start_user_email` (
  `user_id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(53) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `yii2_start_widget`
--

CREATE TABLE IF NOT EXISTS `yii2_start_widget` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `info` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `yii2_start_widget`
--

INSERT INTO `yii2_start_widget` (`id`, `name`, `info`, `date`) VALUES
(1, 'Zoturn', 'skjgbsdg', '2013-05-20');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Podija`
--
ALTER TABLE `Podija`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `yii2_start_blogs`
--
ALTER TABLE `yii2_start_blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `views` (`views`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`);

--
-- Индексы таблицы `yii2_start_categoty_of_tutorials`
--
ALTER TABLE `yii2_start_categoty_of_tutorials`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `yii2_start_comments`
--
ALTER TABLE `yii2_start_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`),
  ADD KEY `FK_comment_parent` (`parent_id`),
  ADD KEY `FK_comment_author` (`author_id`),
  ADD KEY `FK_comment_model_class` (`model_class`);

--
-- Индексы таблицы `yii2_start_comments_models`
--
ALTER TABLE `yii2_start_comments_models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`);

--
-- Индексы таблицы `yii2_start_migration`
--
ALTER TABLE `yii2_start_migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `yii2_start_module`
--
ALTER TABLE `yii2_start_module`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sortOrder` (`sortOrder`);

--
-- Индексы таблицы `yii2_start_profiles`
--
ALTER TABLE `yii2_start_profiles`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `yii2_start_tutorial`
--
ALTER TABLE `yii2_start_tutorial`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `yii2_start_tutorial_category`
--
ALTER TABLE `yii2_start_tutorial_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `yii2_start_users`
--
ALTER TABLE `yii2_start_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role` (`role`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `created_at` (`created_at`);

--
-- Индексы таблицы `yii2_start_user_email`
--
ALTER TABLE `yii2_start_user_email`
  ADD PRIMARY KEY (`user_id`,`token`);

--
-- Индексы таблицы `yii2_start_widget`
--
ALTER TABLE `yii2_start_widget`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Podija`
--
ALTER TABLE `Podija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `yii2_start_blogs`
--
ALTER TABLE `yii2_start_blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `yii2_start_categoty_of_tutorials`
--
ALTER TABLE `yii2_start_categoty_of_tutorials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `yii2_start_comments`
--
ALTER TABLE `yii2_start_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `yii2_start_module`
--
ALTER TABLE `yii2_start_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `yii2_start_profiles`
--
ALTER TABLE `yii2_start_profiles`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `yii2_start_tutorial`
--
ALTER TABLE `yii2_start_tutorial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `yii2_start_tutorial_category`
--
ALTER TABLE `yii2_start_tutorial_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `yii2_start_users`
--
ALTER TABLE `yii2_start_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `yii2_start_widget`
--
ALTER TABLE `yii2_start_widget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `yii2_start_comments`
--
ALTER TABLE `yii2_start_comments`
  ADD CONSTRAINT `FK_comment_author` FOREIGN KEY (`author_id`) REFERENCES `yii2_start_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_comment_model_class` FOREIGN KEY (`model_class`) REFERENCES `yii2_start_comments_models` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_comment_parent` FOREIGN KEY (`parent_id`) REFERENCES `yii2_start_comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `yii2_start_profiles`
--
ALTER TABLE `yii2_start_profiles`
  ADD CONSTRAINT `FK_profile_user` FOREIGN KEY (`user_id`) REFERENCES `yii2_start_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `yii2_start_user_email`
--
ALTER TABLE `yii2_start_user_email`
  ADD CONSTRAINT `FK_user_email_user` FOREIGN KEY (`user_id`) REFERENCES `yii2_start_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
