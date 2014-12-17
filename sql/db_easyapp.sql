-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vytvořeno: Stř 17. pro 2014, 22:32
-- Verze serveru: 5.6.15-log
-- Verze PHP: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `db_easyapp`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `tbl_article`
--

CREATE TABLE IF NOT EXISTS `tbl_article` (
  `id_article` int(7) NOT NULL AUTO_INCREMENT,
  `language_id` int(7) NOT NULL,
  `user_id` int(7) NOT NULL,
  `title` varchar(50) NOT NULL,
  `article` varchar(500) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_article`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `tbl_language`
--

CREATE TABLE IF NOT EXISTS `tbl_language` (
  `id_language` int(7) NOT NULL AUTO_INCREMENT,
  `language` varchar(50) CHARACTER SET latin1 NOT NULL,
  `code` varchar(2) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_language`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Vypisuji data pro tabulku `tbl_language`
--

INSERT INTO `tbl_language` (`id_language`, `language`, `code`) VALUES
(1, 'English', 'en');

-- --------------------------------------------------------

--
-- Struktura tabulky `tbl_text`
--

CREATE TABLE IF NOT EXISTS `tbl_text` (
  `id_text` int(7) NOT NULL AUTO_INCREMENT,
  `language_id` int(7) NOT NULL,
  `text` varchar(255) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `order` int(7) NOT NULL,
  PRIMARY KEY (`id_text`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Vypisuji data pro tabulku `tbl_text`
--

INSERT INTO `tbl_text` (`id_text`, `language_id`, `text`, `designation`, `order`) VALUES
(1, 1, 'User: ', 'login', 1),
(2, 1, 'Password: ', 'login', 2),
(3, 1, 'Login', 'login', 3),
(4, 1, 'Registration', 'login', 4),
(5, 1, 'Please enter your login information.', 'check', 1),
(6, 1, 'Wrong user and/or password combination.', 'check', 2),
(7, 1, 'Username: ', 'register', 1),
(8, 1, 'Password: ', 'register', 2),
(9, 1, 'Password (Again): ', 'register', 3),
(10, 1, 'Register', 'register', 4),
(11, 1, 'Cancel', 'register', 5),
(12, 1, 'You need to fill every field to proceed.', 'insert', 1),
(13, 1, 'Passwords do not match.', 'insert', 2),
(14, 1, 'Password is too short.', 'insert', 3),
(15, 1, 'You have been registered.', 'insert', 4),
(16, 1, 'Username is already in use.', 'insert', 5),
(17, 1, 'Logout', 'logout', 1),
(18, 1, 'Display', 'articles', 1),
(19, 1, 'Edit', 'articles', 2),
(20, 1, 'New article', 'articles', 3),
(21, 1, 'Title', 'articles', 4),
(22, 1, 'Author', 'articles', 5),
(23, 1, 'Language', 'articles', 6),
(24, 1, 'By: ', 'articles', 7),
(25, 1, 'Back', 'articles', 8),
(26, 1, 'Publish', 'articles', 9),
(27, 1, 'Every field needs to be filled in to proceed.', 'articles', 10),
(28, 1, 'Only letters and numbers are allowed in username.', 'insert', 5);

-- --------------------------------------------------------

--
-- Struktura tabulky `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int(7) NOT NULL AUTO_INCREMENT,
  `language_id` int(7) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
