-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:8889
-- 產生時間： 2020 年 11 月 05 日 08:30
-- 伺服器版本： 5.7.30
-- PHP 版本： 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `mytest`
--

-- --------------------------------------------------------

--
-- 資料表結構 `address_book`
--

CREATE TABLE `address_book` (
  `sid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `address_book`
--

INSERT INTO `address_book` (`sid`, `name`, `email`, `mobile`, `birthday`, `address`, `created_at`) VALUES
(1, '李曉明', '123@gmail.com', '092238193', '2000-04-05', '台北市大安區', '2020-11-05 15:37:56'),
(2, '李曉明2', '123@gmail.com', '092238193', '2000-04-05', '台北市大安區', '2020-11-05 15:37:56'),
(3, '坊ＱＱ', '122@gmail.com', '1233322', '2020-11-02', 'dsfsdf', '2020-11-05 15:47:33'),
(4, 'ＱＱ', '122@gmail.com', '1233322', '2020-11-02', 'dsfsdf', '2020-11-05 15:47:33');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `address_book`
--
ALTER TABLE `address_book`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `address_book`
--
ALTER TABLE `address_book`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
