-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2025-05-05 09:46:02
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `shopping`
--
CREATE DATABASE IF NOT EXISTS `shopping` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `shopping`;

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL COMMENT '會員編號',
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '登入帳號',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '加密密碼',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '電子郵件',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '姓名',
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '手機號碼',
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '地址',
  `gender` enum('M','F','O') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'O' COMMENT '性別:M=男、F=女、O=其他',
  `birthdate` date DEFAULT NULL COMMENT '生日',
  `created_at` datetime DEFAULT NULL COMMENT '註冊時間',
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp() COMMENT '更新時間',
  `last_login_at` datetime DEFAULT NULL COMMENT '最後登入時間',
  `status` tinyint(1) NOT NULL COMMENT '帳號狀態:1=啟用、0=停用',
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user' COMMENT '權限角色'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`id`, `username`, `password`, `email`, `name`, `phone`, `address`, `gender`, `birthdate`, `created_at`, `updated_at`, `last_login_at`, `status`, `role`) VALUES
(3, 'member', '$2y$10$4Cga4qoQOyftzES0/oToMOa2Mq6AzXTrErjTN287ChzZevzxP0SI.', 'member@gmail.com', 'member', '0912-345655', '國立彰化師範大學', 'O', '2025-04-05', NULL, NULL, NULL, 0, 'user');

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL COMMENT '訂單編號',
  `user_id` int(11) NOT NULL COMMENT '關聯會員資料表',
  `order_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT '下單時間',
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '訂單總金額',
  `payment_status` enum('paid','unpaid','cancelled','') NOT NULL DEFAULT 'unpaid' COMMENT '付款狀態',
  `shipping_status` enum('pending','shipped','delivered','returned') NOT NULL DEFAULT 'pending' COMMENT '運送狀態',
  `shipping_address` text DEFAULT NULL COMMENT '收件地址',
  `payment_method` varchar(50) DEFAULT NULL COMMENT '付款方式\r\n(ex. 信用卡、轉帳)',
  `note` text DEFAULT NULL COMMENT '備註',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '建立時間',
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp() COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `total_amount`, `payment_status`, `shipping_status`, `shipping_address`, `payment_method`, `note`, `created_at`, `updated_at`) VALUES
(1, 0, '2025-05-03 22:00:08', 0.00, 'unpaid', 'pending', NULL, NULL, NULL, '2025-05-03 22:00:08', NULL);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '會員編號', AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '訂單編號', AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
