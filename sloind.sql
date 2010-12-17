-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 15, 2010 at 04:35 PM
-- Server version: 5.1.40
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sloind`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `string_id` text NOT NULL,
  `title` text NOT NULL,
  `content` longtext NOT NULL,
  `publish` int(2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_edit` int(11) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `order` int(11) NOT NULL,
  `block` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `section_id`, `string_id`, `title`, `content`, `publish`, `user_id`, `last_edit`, `meta_keywords`, `meta_description`, `order`, `block`) VALUES
(1, 1, 'str_id_key', 'Привет', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 1, 1, 1111, 'привет пока досвидания', 'Это пробная статья', 1, 0),
(2, 2, 'dfhgdghh', 'Наверно', 'fdfgjdfgj', 1, 1, 111, '111', '3dhfgf gdh fdh', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `be_menu`
--

CREATE TABLE IF NOT EXISTS `be_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `submenu` int(2) NOT NULL,
  `order` int(11) NOT NULL,
  `com` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `link` text NOT NULL,
  `img` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `be_menu`
--

INSERT INTO `be_menu` (`id`, `id_menu`, `submenu`, `order`, `com`, `title`, `description`, `link`, `img`) VALUES
(1, 0, 0, 0, '', 'Модули', 'Управление Вашими модулями', '', 'img_modules.png'),
(2, 0, 0, 0, 'config', 'Конфигурация', 'Общие настройки сайта', '', 'img_settings.png'),
(3, 0, 0, 0, 'stat', 'Статистика', 'Рейтинг посеща- емости страниц сайта', '', 'img_statistica.png'),
(4, 0, 0, 0, 'help', 'Помощь', 'Управление Вашими модулями', '', 'img_help.png'),
(5, 1, 1, 2, 'articles', 'Статьи', 'Компонент статей.', '', 'articles.png'),
(6, 1, 1, 1, 'news', 'Новости', 'Компонент новостей.', '', 'news.png'),
(7, 1, 1, 0, 'bereview', 'Главная', 'Сводный отчет по работе сайта', '', 'bereview.png');

-- --------------------------------------------------------

--
-- Table structure for table `permisions`
--

CREATE TABLE IF NOT EXISTS `permisions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller` text NOT NULL,
  `com` text NOT NULL,
  `act` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `permisions`
--

INSERT INTO `permisions` (`id`, `controller`, `com`, `act`, `value`) VALUES
(2, 'backend', '', '', '2'),
(7, 'frontend', '', '', '2');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'login', 'Login privileges, granted after account confirmation'),
(2, 'admin', 'Administrative user, has access to everything.');

-- --------------------------------------------------------

--
-- Table structure for table `roles_users`
--

CREATE TABLE IF NOT EXISTS `roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles_users`
--

INSERT INTO `roles_users` (`user_id`, `role_id`) VALUES
(20, 1),
(20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `section_articles`
--

CREATE TABLE IF NOT EXISTS `section_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `string_id` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `last_edit` int(11) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `block` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `section_articles`
--

INSERT INTO `section_articles` (`id`, `section_id`, `string_id`, `title`, `description`, `last_edit`, `meta_keywords`, `meta_description`, `block`) VALUES
(1, 0, 'news', 'Новости', 'О новостях', 423653, 'енук ', 'е нуке', 0),
(2, 0, 'content', 'Последние новости', 'Последние новости', 432634, 'авыр вр вар', 'ы варывар ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(127) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` char(50) NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `logins`, `last_login`) VALUES
(20, 'dapmoed@gmail.com', 'dapmoed', '08dd5ce0465a626489ed5e7027e6cda582e97d5bb9baa42933', 222, 1292393588);

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE IF NOT EXISTS `user_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(32) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `user_id`, `user_agent`, `token`, `created`, `expires`) VALUES
(14, 20, 'd15b8b966ed098160eedf9b491e3a38f82caa648', 'gsz5Y8sSms5gjp6RgdIDiEP08Ty6PEGd', 1290360507, 1291570107),
(9, 20, '5cebb155f6cd4e14830bef152ec7d2603ff70217', 'JJ5bLZ7hq7PerplZUQEYVsoiueoauo90', 1289249902, 1290459502);
