-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2025-05-28 16:09:39
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
-- 資料庫： `group_11`
--
CREATE DATABASE IF NOT EXISTS `group_11` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `group_11`;

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
(15, 'member', '$2y$10$PtX1bvBfLHq7p4k62Z3iQ.yPGHWr2q80tFj.YTUwddik2u4rWCaDy', 'member@gmail.com', 'member', '0912-345634', '國立彰化師範大學', 'M', '2025-04-04', NULL, '2025-05-24 23:06:09', NULL, 0, 'user'),
(16, 'admin', '$2y$10$8MyWm.1gnPCa40G5y.agGeMcyK/H1ANUn/hbu/LI8zSZyOGufQH8C', 'admin@gmail.com', 'admin', '0912-345655', '國立彰化師範大學', 'M', '2025-04-04', NULL, '2025-05-22 17:24:28', NULL, 0, 'admin');

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

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `pid` int(11) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `name` varchar(50) NOT NULL,
  `brand` varchar(10) NOT NULL,
  `color` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `function` varchar(100) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `cate` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `description` varchar(500) NOT NULL,
  `sub_cate` varchar(10) DEFAULT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`pid`, `time`, `name`, `brand`, `color`, `price`, `function`, `pic`, `cate`, `type`, `description`, `sub_cate`, `stock`) VALUES
(1, '2025-04-30 12:04:44', 'iPad 11 11吋/WiFi/128G 平板電腦', 'Apple', '銀色 藍色 粉紅色', 11900, '11吋128GBA16仿生晶片', 'images/ipad11.png', '手機/平板', 'WIFI', '實際規格依Apple原廠公告為準:https://www.apple.com/tw/', 'iPad', 10),
(2, '2025-04-30 12:04:44', 'iPad Air 11吋/WiFi/128G平板電腦', 'Apple', '銀色 黃色 粉紅色', 18690, 'Apple M2 晶片\n抗反射鍍膜\n1200 萬像素廣角相機', 'images/ipadair.png', '手機/平板', 'WIFI', '實際規格依Apple原廠公告為準:https://www.apple.com/tw/', 'iPad', 10),
(3, '2025-04-30 12:04:44', 'iPad Pro 11吋/WiFi/256G/M4晶片 平板電腦', 'Apple', '白色 灰色', 35890, 'Apple M4 晶片\r\n1200 萬像素廣角相機\r\n256GB 儲存空間', 'images/ipadpro.png', '手機/平板', 'WIFI', 'Apple iPad Pro 11 (2024) Wi-Fi 256GB 功能特色\n採用 iPadOS 17 作業系統\n11 吋 2,420 x 1,668pixels 解析度 Ultra Retina XDR 顯示器\n內建 Apple M4 晶片（16 核心神經網路引擎）\n8GB RAM + 256GB ROM\n前置 1,200 萬畫素鏡頭\n後置 1,200 萬畫素鏡頭\n適應性原彩閃光燈、光學雷達掃描儀\nWi-Fi 6E、藍牙 5.3\nFace ID 人臉辨識\n內建 31.29 瓦特小時可充電鋰聚合物電池\n採用 USB Type-C 連接埠 (支援 Thunderbolt 3、USB 4；速度最高可達 40Gb/s)\n支援Apple Pencil Pro、巧控鍵盤', 'iPad', 10),
(4, '2025-04-30 12:04:44', 'iPad Pro 第2代(11吋/256G/WiFi)平板電腦', 'Apple', '白色 灰色', 17800, 'A12Z仿生晶片\n8核心繪圖處理\n1200 萬像素超廣角相機', 'images/ipadpro2.png', '手機/平板', 'WIFI', '實際規格依Apple原廠公告為準:https://www.apple.com/tw/', 'iPad', 10),
(5, '2025-04-30 12:04:44', 'iPhone 15(128G/6.1吋)', 'Apple', '黑色 白色 綠色', 22999, 'A16 仿生晶片超Retina XDR顯示器防潑、抗水與防塵 IP68等級', 'images/iphone15.png', '手機/平板', '5G', '實際規格依Apple原廠公告為準:https://www.apple.com/tw/', 'iPhone', 9),
(6, '2025-04-30 12:04:44', ' iPhone 15 Pro 128GB 6.1吋', 'Apple', '黑色 白色 藍色', 26490, 'A17 Pro 仿生 5G晶片\nA+級展示機+原廠配件\n原廠電池健康度１００%', 'images/iphone15pro.png', '手機/平板', '5G', 'Apple iPhone 15 Pro 128GB 功能特色\niOS 作業系統\n6.1 吋 2,556 x 1,179pixels 解析度超 Retina XDR 顯示器（OLED 螢幕）\nA17 Pro 仿生晶片（6 核心 GPU）\n128GB ROM\n前置 1,200 萬畫素原深感測相機\n後置 4,800 萬畫素廣角鏡頭 + 1,200 萬畫素超廣角鏡頭 + 1,200 萬畫素望遠鏡頭\n5G 上網、eSIM、Wi-Fi 6E、藍牙 5.3、超寬頻、NFC 讀取\n電影級模式、杜比視界錄製、夜間攝影、智慧型 HDR 5 模式、動作模式 (防手震錄影)\nSOS 緊急服務、車禍偵測功能\nFace ID 臉部辨識\n支援有線快速充電、15W MagSafe 無線充電、7.5W Qi 無線充電\n採用 USB Type-C 連接埠 (USB 3；速度最高可達 10Gb/s)', 'iPhone', 10),
(7, '2025-04-30 12:04:44', 'iPhone 16(128G/6.1吋)', 'Apple', '黑色 白色 紫色', 28299, 'A18 晶片\n超Retina XDR 顯示器\n防潑、抗水與防塵 IP68等級', 'images/iphone16.png', '手機/平板', '5G', '實際規格依Apple原廠公告為準:https://www.apple.com/tw/', 'iPhone', 10),
(8, '2025-04-30 12:04:44', 'iPhone 16 Pro(128G/6.3吋)', 'Apple', '黑色 白色 玫瑰金', 34598, '首款生成式 AI 手機\n相機控制鍵\nA18 Pro 仿生晶片', 'images/iphone16pro.png', '手機/平板', '5G', '實際規格依Apple原廠公告為準:https://www.apple.com/tw/', 'iPhone', 10),
(9, '2025-04-30 12:04:44', 'Pixel 9 5G (6.3吋/256G)', 'Google', '曜石黑', 22388, '支援 Gemini、魔術修圖\n進階雙後置鏡頭\nIP68 防塵防水', 'images/google_pixel.png', '手機/平板', '5G', '實際商品規格請依官網公告(https://store.google.com/tw/category/phones?hl=zh-TW)為主', '安卓手機', 10),
(10, '2025-04-30 12:04:44', 'Xiaomi 15 Ultra 5G (6.73吋/1TB)', '小米', '經典黑銀', 37999, '徠卡1吋主鏡頭\n徠卡200MP超級潛望長\n台積電最新3奈米旗艦處理', 'images/xiaomi.png', '手機/平板', '5G', '實際規格依小米原廠公告為準:https://www.mi.com/tw', '安卓手機', 10),
(11, '2025-04-30 12:04:44', 'Xperia 1 VI 5G (6.5吋/512G)', 'Sony', '夜黑 墨綠', 35490, '配備3.5mm 耳機孔\n蔡司光學T*鍍膜\n即時物件追蹤', 'images/sony.png', '手機/平板', '5G', '實際規格依Sony原廠公告為準:https://www.sony.com.tw/zh', '安卓手機', 10),
(12, '2025-04-30 12:04:44', 'OPPO Find X8 Pro (6.78吋/512GB)', 'OPPO', '靜謐黑', 32990, '全新ColorOS15智慧AI\n快拍按鈕 實現全新極速抓拍\n雙潛望鏡頭 支援AI望遠長焦', 'images/oppo.png', '手機/平板', '5G', '型號\nOPPO Find X8 Pro\n\n顏色    \n浮光白/靜謐黑\n\n螢幕    \n尺寸*1    6.78吋\n解析度    2780x 1264 (1.5K)\n色彩    10.7億色\n更新率    120Hz\n\n處理器    \nMediaTek Dimensity 9400\n\n相機    \n後置鏡頭\n5000萬畫素(OIS 主鏡頭)\n5000萬畫素(6倍潛望式長焦鏡頭)\n5000萬畫素(3倍潛望式長焦鏡頭)\n5000萬畫素(120°超廣角鏡頭)\n\n前置鏡頭\n3200萬畫素 (支援4K 60fps Dolby Vision杜比視界)\n\n記憶體*2        \n16GB RAM/ 512GB ROM\n\n通訊頻段*3    \n2G GSM    850 / 900 / 1800 / 1900\n3G WCDMA    B1/ B2 / B4 / B5 / B6/ B8/ B19\n4G FDD LTE    B1/ B2/ B3/ B4/ B5/ B7/ B8/ B12/ B13/ B17/ B18/ B19/ B20/ B25/B26/ B28/ B32/B66\n4G TDD LT', '安卓手機', 10),
(13, '2025-04-30 12:04:44', 'SONY Alpha ILCE-7M4/A7M4 A7IV', 'Sony', '黑色', 60120, '3,300萬像素35mm全片幅\n先進BIONZ XR影像處理器\n錄影即時自動追蹤對焦功能', 'images/SONY Alpha ILCE.png', '相機/相機配件', '全幅 / CMOS', '型號：ILCE-7M4(單機身)\n鏡頭相容性：Sony E 接環鏡頭\n影像感光元件：35 mm 全片幅 (35.9 x 23.9 mm)、Exmor R CMOS 感光元件\n像素 (有效像素)：約 33 百萬像素\n像素 (總像素)：約 34.1 百萬像素\n感光元件長寬比：3:2\n防塵系統：有 (光學濾鏡上的抗靜電鍍膜與感光元件位移機制)\n隨機附件：充電電池 NP-FZ100、AC 變壓器、肩帶、機身鏡頭蓋、配件熱靴蓋、接目罩、USB-A 至 USB-C 連接線 (USB 3.2)', '微單眼/單眼', 10),
(14, '2025-04-30 12:04:44', 'Nikon Z8 KIT 附 Z 24-120mm F4 S', 'Nikon', '黑色', 132601, '總代理國祥貿易公司貨\n柔膚效果適用於影片與靜態影像\n4軸垂直及水平翻揭式螢幕', 'images/Nikon Z8.png', '相機/相機配件', '全幅 / CMOS', '高達 120 fps 低速連拍：約 1 至 10 fps 高速連拍：約 10 至 20 fps 高速畫面擷取 (C30)：約 30 fps 高速畫面擷取 (C60)：約 60 fps 高速畫面擷取 (C120)：約 120 fps 最高每秒拍攝 (前捲) 張數經內部測試計算。', '微單眼/單眼', 10),
(15, '2025-04-30 12:04:44', 'Canon EOS R8 24-50mm f/4.5-6.3 IS STM', 'Canon', '黑色', 44064, '6K超取樣4K 60p\n高達每秒40張高速連拍\n人物及動物眼對焦', 'images/Canon EOS.png', '相機/相機配件', '全幅 / CMOS', '自動對焦模式 靜態影像： 單次自動對焦(ONE-SHOT AF), 伺服自動對焦(SERVO AF), 手動對焦\n短片拍攝：單次自動對焦(ONE-SHOT AF), 短片伺服自動對焦(Movie SERVO AF), 手動對焦\n自動對焦點選擇 自動選擇、手動選擇\n自動對焦系統對焦點 靜態影像：最多4,897個手動選擇的自動對焦點 / 最多1,053個自動選擇的自動對焦框\n短片拍攝： 最多4,067個手動選擇的自動對焦點 / 最多1,053個自動選擇的自動對焦框\nBuilt-in Flash -\n最近對焦距離（cm） -\n連拍速度（每秒拍攝數量）（最多） 電子前簾快門：6 fps\n電子快門：40 fps\n數碼變焦 數位增距鏡 x2.0 及 x4.0\n尺寸（mm；約數；不包括凸起部份） 132.5 × 86.1 × 70.0\n驅動系統 -\n有效ISO感光度 靜態影像：100–102,400 (L:50, H:204,800)\n短片拍攝： 100–25,600 (H:32,000 - 102,400)\nCanon Log 短片拍攝： ISO 800–25,600 (L:100-640, H:', '微單眼/單眼', 10),
(16, '2025-04-30 12:04:44', 'FUJIFILM X-T50 +XC15-45mm', 'Fujifilm', '黑色', 50255, '軟片模擬轉盤設計\n3吋傾斜式觸控螢幕\n4020萬畫素', 'images/FUJIFILM X-T50.png', '相機/相機配件', 'APS-C CMOS', '品牌     Fujifilm富士\n相機類型    微單眼\n影像感應器    CMOS\n有效像素    3001萬~5000萬像素\n螢幕尺寸    3.0吋以上\n螢幕類型    翻轉式螢幕, 可觸控式螢幕\nISO範圍(最大ISO值)    12800\n儲存媒介    SD, SDHC, SDXC\n最快快門速度    1/4000秒\n觀景窗型式    視平式電子觀景器\n觀景窗視野率    100%\n多媒體功能    藍牙\n機身尺寸 (寬 x 高 x 深) (mm)    約123.8ｍｍ × 84ｍｍ × 48.8ｍｍ（最小深度） (34.2ｍｍ)\n機身重量(不含電池)(g)    -\n保固期限    12個月\n片幅     APS-C\n來源     平行輸入\n重量     約465g (含電池和存儲卡)', '微單眼/單眼', 10),
(17, '2025-04-30 12:04:44', 'SONY FE 200-600mm F5.6-6.3 G OSS', 'Sony', '黑色', 55660, '超望遠變焦 G 系列鏡頭\n高階光學設計\nSony 奈米 AR 鍍膜', 'images/SONY FE.png', '相機/相機配件', '超望遠變焦', '實際規格依Sony原廠公告為準:https://www.sony.com.tw/zh', '單眼鏡頭', 10),
(18, '2025-04-30 12:04:44', 'Nikon NIKKOR Z MC 105mm F2.8 VR S', 'Nikon', '黑色', 27930, '總代理國祥貿易司貨。\n1:1 Macro 微距鏡頭\n配有防手震，手持拍攝更便利', 'images/Nikon NIKKOR.png', '相機/相機配件', '望遠定焦', '實際規格依Nikon原廠公告為準:https://www.coolpix.com.tw', '單眼鏡頭', 10),
(19, '2025-04-30 12:04:44', 'Canon EF 35mm f/1.4 L II USM', 'Canon', '黑色', 56253, '強化抗撞擊、抗震、防塵防水滴\n全新研發BR鏡片\n全片幅廣角鏡頭', 'images/Canon EF.png', '相機/相機配件', '超廣角變焦', '視角 (對角) 63°\n鏡片組 11群14片\n特殊鏡片 1片BR鏡片 1片UD鏡片 2片非球面鏡片\n特殊鍍膜 次波長結構塗膜 (SWC)氟塗膜\n光圈葉片數 9 (圓形光圈)\n最小光圈 f/22\n最近對焦距離(m) 0.28m\n最大放大倍率(x) 0.21x\n鏡頭馬達驅動 環型超音波馬達\n全時手動對焦 支援\n防塵防水滴設計* 支援\n濾鏡尺寸(mm) 72mm\n鏡長 x 最大直徑(mm) 105.5 x 80.4mm\n重量(克) 約760克', '單眼鏡頭', 10),
(20, '2025-04-30 12:04:44', 'Sigma 16mm F1.4 DC DN', 'Sigma', '黑色', 14304, '虛化效果的人像攝影之理想器材\n總代理公司貨三年保固（需回函）\n線性軌道自動對焦馬達', 'images/Sigma 16mm.png', '相機/相機配件', '標準定焦', '鏡片結構：13群16片\n視角：83.2度\n光圈葉片數：9 片\n最小光圈：F16\n最近對焦距離：25cm\n最大放大比：1:9.9\n濾鏡尺寸：67mm\n體積：直徑 72.2mm x 長度 92.3mm\n重量：405公克', '單眼鏡頭', 10),
(21, '2025-04-30 12:04:44', 'SONY ZV-1F Vlog 相機', 'Sony', '黑色', 18980, '呼朋引伴拍攝，背景一同入鏡\n風格外觀功能，十種濾鏡拍攝\n觸控螢幕操作，新手快速上手', 'images/SONY ZV-1F.png', '相機/相機配件', '1/1.7吋 CMO', '實際規格依Sony原廠公告為準:https://www.sony.com.tw/zh', '數位/拍立得', 10),
(22, '2025-04-30 12:04:44', 'Nikon D7500 BODY單機身+18-140mm VR', 'Nikon', '黑色', 39048, '強勁EXPEED 5影像處\n2090萬有效像素影像解像度\nDX格式CMOS感應器', 'images/Nikon D7500.png', '相機/相機配件', 'APS-C CMOS', 'Nikon D7500 規格    \n主要賣點    2100 萬像素、51 點對焦、1.3 倍 DX 影像裁剪、3.2 吋 LCD、內置 Wi-Fi 及 NFC\n推出日期    約 2017 年 4 月\n感光元件像素    2151 萬像素\n有效像素    2090 萬像素\n感光元件格式    APS-C\n感光元件大小    23.5 x 15.7 mm\n感光元件種類    CMOS\n最大解像度    5568 x 3712\n耐用特性    防塵防水滴\n動畫種類    MPEG 4/H.264 無間斷有聲影片\n動畫音效    立體聲\n多媒體功能    內置 Wi-Fi 及 NFC\n135 格式焦距    視鏡頭而定\n變焦能力    視鏡頭而定\n光圈範圍    視鏡頭而定\n自動對焦情況    Nikon Advanced Multi-CAM 3500 II 對焦系統\n    51 個對焦點 (15 個十字型感應器、1 點支援 f/8)\n    單次伺服 AF-S\n    連續伺服 AF-C\n    自動 AF-S / AF-C 選擇\n    根據主體狀態自動啟動預測追蹤對焦\n曝光模式 ', '數位/拍立得', 10),
(23, '2025-04-30 12:04:44', 'Canon PowerShot SX70 HS', 'Canon', '黑色', 18990, '總代理國祥貿易司貨。\n4K超高清錄影拍攝\n0cm超微距拍攝', 'images/Canon PowerShot SX70.jpg', '相機/相機配件', '1/2.3吋 CMO', 'Canon公司貨享有12個月保固。 詳細以官網公告為主 http://rainbowphoto.com.tw', '數位/拍立得', 10),
(24, '2025-04-30 12:04:44', 'LEICA SOFORT 2雙模式即時相機', 'Leica', '黑色 白色', 14180, '由徠卡相機於德國設計\n可連接至徠卡FOTOS應用程\n可選擇性列印照片，帶有手動列印', 'images/LEICA SOFORT 2.png', '相機/相機配件', '1/3吋CMOS', '實際規格依Sony原廠公告為準:https://leica-camera.com/zh-Hant', '數位/拍立得', 10),
(25, '2025-04-30 12:04:44', 'MSI 14吋 i7 RTX3050-6G 電競筆電', 'Msi', '黑色', 26900, '搭載第13代i7處理器\n16:10比例144Hz更新\n穿透感半透明機身設計', 'images/MSI laptop.png', '電腦/筆電', '無觸控螢幕', '型號(型式)：MS-14P1    \n證書編號：CI33206008A401\n\n螢 幕：14” FHD+ (1920x1200), 144Hz, IPS-Level\n處理器：Intel☆ Core™i7-13620H (2.4GHz/Turbo 4.9GHz)(Cache 24MB)\n記憶體：16GB DDR5-5200 ,2Slots ,Max 64GB\n硬 碟：512GB M.2 SSD (NVMe PCIe)\n顯示晶片：GeForce RTX™ 3050 Laptop GPU 6GB GDDR6\n插 槽：1x M.2 SSD slot (NVMe PCIe Gen4)\n\nI/O連接埠：\n1x Type-C (USB3.2 Gen2 / DP)\n2x Type-A USB3.2 Gen1\n1x HDMI™ 2.1 (4K @ 60Hz)\n1x RJ45\n    \n視訊鏡頭：HD type (30fps@720p)\n音 效：2x 2W Speaker / 1x Mic-in/Headphone-out Combo Jack\n支援網路：802.11 ax Wi-Fi 6E + Blue', '筆記型電腦', 10),
(26, '2025-04-30 12:04:44', 'ASUS 14吋Ultra5翻轉觸控筆電', 'Asus', '灰色', 39999, '德國萊茵護眼認證\nIce Cool散熱技術\n14\" Touch FHD', 'images/ASUS Ultra5.png', '電腦/筆電', '觸控螢幕', '型號：TP3407SA-0023G226V 夜幕灰\n螢幕尺寸(解析度)：14\" Touch FHD (1920 x 1200) OLED 16:10 aspect ratio\n處理器：Intel Core Ultra 5 Processor 226V 16GB 1.6 GHz (8MB Cache, up to 4.5GHz, 8 cores, 8 Threads)\nIntel☆ AI Boost NPU up to 40\n記憶體(內建/最大)：16GB LPDDR5X on board\n硬碟：1TB M.2 NVMe PCIe 4.0 SSD\n顯示卡:Intel Arc 130V GPU\nLAN或WLAN：Wi-Fi 7 (802.11be)+Bluetooth 5.4\n作業系統：Windows 11 Home\nExpansion Slot(includes used):\n1x M.2 2280 PCIe 4.0x4\n輸入輸出介面(I/O連接埠)/配件\n1x USB 3.2 Gen 1 Type-A (data speed up to 5Gbps)\n1x USB 3.2 Gen 2 ', '筆記型電腦', 10),
(27, '2025-04-30 12:04:44', 'HP 14吋i7-1255U輕薄軍規效能筆電', 'Hp', '銀色', 23900, '10核心CPU\n窄邊框 防眩光 低藍光螢幕\n長效續航 輕鬆使用', 'images/HP.png', '電腦/筆電', '無觸控螢幕', 'HP IDS UMA i7-1255U 240 G9 Base NB PC\nHP Country Kit TW\nMISC eStar PCID\n14 inch FHD (1920x1080) Anti-Glare LED UWVA 250 Narrow Bezel slim\nAsteroid Silver Plastic with HD Webcam + TNR ID\n1TB PCIe NVMe Value Solid State Drive\nAsh Silver ISK Textured Touchpad Imagepad TW\n16GB (1x16GB) DDR4 3200\nax 2x2 +Bluetooth 5.2 WW with 2 Antennas WLAN\nWindows 11 Home 64 Plus\nOS Localization TW\nC5 1.0m Sticker Conventional Power Cord TW\n45 Watt Smart nPFC Right Angle AC Adapter\n3 Cell 41 WHr Long Life\n1/1/0 War', '筆記型電腦', 10),
(28, '2025-04-30 12:04:44', 'DELL 14吋i5輕薄筆電', 'Dell', '藍色', 25999, '14吋 2.2K 低藍光螢幕\n13代i5-1334U\n三年保固', 'images/DELL laptop.png', '電腦/筆電', '無觸控螢幕', '型號:DC5440-R2608P3Y\n\n處理器CPU 13th Generation Intel Core ™ i5-1334U (12 MB cache, 10 cores, 12 threads, up to 4.60 GHz)\n內建記憶體 16GB, DDR5, 4400MT/s\n最大擴充 2 slot / 32GB\n硬碟容量/轉速 512GB M.2 PCIe NVMe Solid State Drive\n顯示卡 Intel Iris Xe Graphics\n光碟機 No\n螢幕尺寸 14\n螢幕解析度 16:10 2.2K (2240 x 1400) Anti-Glare Non-Touch 300nits WVA Display with ComfortView Plus Support\n網路通訊功能 1x1 AX Wi-Fi 6 (Realtek RTL 8851BE)\n作業系統 Windows 11 專業版 三國語言版(繁體中文、簡體中文、英文)\n連接埠和插槽\nHDMI 1.4*,\n(1) USB 3.2 Gen 1 Type-C™(Data Transfer only i', '筆記型電腦', 10),
(29, '2025-04-30 12:04:44', 'ASUS i5 八核電腦', 'Asus', '白色', 17990, '最高可擴充至64G DDR5\n可裝最高RTX4060顯示卡\n3C用品店獨家!', 'images/Asus computer.png', '電腦/筆電', '家用桌上型', 'H-V500MV-13420H139W\n處理器CPU：Intel i5-13420H Processor 2.1 GHz (12MB Cache, up to 4.6 GHz, 8 cores, 12 Threads)\n記憶體：16GB DDR5 SO-DIMM\n顯示卡：無\n硬碟：512GB M.2 2280 NVMe™ PCIe☆ 4.0 SSD\n光碟機：Without optical drive\n無線網路：Wi-Fi 6(802.11ax) (Dual band) 1*1 + Bluetooth☆ 5.3 Wireless Card\n電源：330W power supply (80+ Platinum, peak 660W)\nRear I/O Port:\n1x RJ45 Gigabit Ethernet\n1x HDMI 1.4\n1x Displayport 1.4\n1x Kensington lock\n4x USB 2.0 Type-A\nFront I/O Port:\n1x 3.5mm combo audio jack\n1x USB 3.2 Gen 1 Type-C\n2x USB ', '主機', 10),
(30, '2025-04-30 12:04:44', 'Acer N4505雙核電腦', 'Acer', '黑色', 8888, '小空間最佳選擇\n瀏覽網頁/文書處理\n影片播放滿足日常使用', 'images/Acer computer.png', '電腦/筆電', '家用桌上型', '型號：XC-840\n作業系統：Windows 11 home\nCPU：Intel Celeron N4505\nLCD 尺寸：N\n解析度：N\n顯示晶片：N\nVRAM：N\n記憶體(實際出貨)：8G DDR4\n記憶體支援容量(總插槽數量/總容量)：2/16GB\nAudio：Integrated high-definition, 5.1-channel surround sound\n儲存：256G PCIe\n光碟機：N\nWebcam 前：N\nWebcam 後：N\n無線網路：802.11 ac/a/b/g/n\n藍牙：Bluetooth☆ 5.0\n區域網路    RJ-45: Y\nKensington lock slot：N\n尺寸(mm)：100 (W) x 330 (D) x 295 (H) mm\n電源變壓器：65W\n電池：N\nBattery Life：N\nFront I/O Port：No Card Reader\n1x USB 3.2 Gen 1 Type-C☆\n1x USB 3.2 Gen 1 Type-A\n1x 3.5mm Headset/speaker jack\n1x Microphon', '主機', 10),
(31, '2025-04-30 12:04:44', 'MSI i7 RTX4070S電競電腦', 'Msi', '黑色', 64900, '搭載第14代i7處理器\nRTX4070 SUPER獨顯\nUSB Type C正反插設計', 'images/Msi computer.png', '電腦/筆電', '電競桌上型', '處理器：Intel Core i7 14700F 2.1GHz\n主機板晶片：Intel H610\n顯示晶片：GeForce RTX 4070 SUPER VENTUS 2X 12G\n記憶體：32GB DDR5 5600MHz(32G*1)\n插 槽：2 x DDR5 U-DIMMs,up to 64GB\n固態硬碟：2TB M.2 PCIe GEN3\n\n輸出/入介面\nI/O (前)\n1 x USB 3.2 Gen 1 Type A\n1 x USB 3.2 Gen 1 Type C\n1 x 麥克風輸入\n1 x 耳機輸出\n\nI/O (後)\n2 x USB 3.2 Gen 1 Type A\n4 x USB 2.0 Type A\n1 x RJ45\n2x WiFi Antenna\n1 x PS/2\n3x Audio jacks\n1 x HDMI\n3 x DP\n\n電 源：500W Bronze 80 Plus (ATX)\n音 效：7.1 Channel HD Audio (Realtek ALC897)\n光碟機：無\n有線網路：Intel I219V\n無線網路：AzureWave/AW-XB560NF\n', '主機', 10),
(32, '2025-04-30 12:04:44', 'HP E-2324G 四核直立伺服器', 'Hp', '黑色', 169900, '8TBX2 HDD+4TB\n支援固態硬碟，開機更快速\n高安全性、高穩定性、高擴充性', 'images/Hp computer.png', '電腦/筆電', '商用桌上型', '主機主要規格\n品牌：HPE 慧與科技\n型號：ML30 Gen10\n晶片組：Intel C256 Chipset\n處理器：Intel☆ Xeon☆ E-2324G 處理器（8M 快取記憶體，3.10 GHz）\n記憶體容量：已加裝非原廠128G DDR4 (經銷3年保固，特式升級)\n記憶體工作頻率(MHz)：3200\n記憶體插槽數/最高支援容量：4/128G\n固態硬碟：已加裝非原廠4TB M.2 SSD (經銷3年保固，特式升級)\n傳統硬碟：已加裝非原廠8TBx2 HDD (經銷3年保固，特式升級)\n顯示功能類型：內建顯示晶片\n顯示(卡)晶片型號：Intel UHD 顯示晶片 P750\n顯示卡記憶體類型：無\n顯示卡記憶體容量：無\n作業系統：Windows Server 2022 Standard\n主機型態：直立式伺服器\n其他規格\n區域網路：Broadcom BCM5720 Ethernet 1Gb 2-port BASE-T Adapter\n無線網路：無\n磁碟陣列：內建Software RAID Intel VROC SATA (Supports 6.0Gb/s SATA、RAID 0, ', '主機', 10),
(33, '2025-04-30 12:04:44', 'ASUS XG49VQ 49型 曲面 ROG電競 液晶螢幕', 'Asus', '黑色', 19888, '1800R 曲面超寬HDR\n支援144HZ高速畫面更率\nAMDFreeSync2HDR', 'images/Asus monitor.png', '電腦/筆電', '無觸控螢幕', '面板尺寸：49\" (124.46cm)\n支援最大解析度：3840 x 1080 144Hz\n面板類型:VA\n曲面:1800R\n點距：0.311 mm\n亮度(Max.)：450 cd/m2(Typ.)\n對比度CR(Typ.)：3,000:1\n可視角度(CR)=10)：178°(H) / 178°(V)\n顯示顏色數：16.7M\n反應時間：4ms (Gray to Gray)\nSPLENDID Preset Mode：GameVisual (Mode) : (Scenery, FPS, RTS/RPG, sRGB, Racing, Cinema, MOBA, user mode\n支援HDCP：Yes\nHDR support ：Yes\n數位-HDMI：Yes X2\n數位-Display port：Yes\nAV Audio Input：1DP 2HDMI\n耳機：3.5 mm Mini-jack\nUSB Hub：USB3.0 ports(Upstream x 1, Downstream x 2)\n數位：30 ~167 KHz (H) /48 ~144 Hz(V)\n支援電壓：100–240V, 50', 'LCD螢幕', 10),
(34, '2025-04-30 12:04:44', 'Acer 宏碁 E271 G0 27型電競螢幕', 'Acer', '黑色', 2688, 'FHD解析度/IPS面板技術\n120Hz刷新率/5ms反應\n支援VESA壁掛', 'images/Acer E271 G0 27.png', '電腦/筆電', '無觸控螢幕', 'Display Size尺寸 ： 27”H\nMaximum Resolution and Refresh Rate解析度 ： VGA:1920x1080@75Hz / HDMI:1920x1080@120Hz\nGlare ： No\nPanel面板 ： In-Plane Switching\nResponse Time反應時間 ： 5ms (GTG)\nContrast Ratio對比 ： 100 million:1 max (ACM)\nBrightness亮度 ： 250 nits (cd/m2)\nViewing Angle可視角 ： 178° (H), 178° (V)\nColors支援顏色 ： 16.7M\nColor Gamut色域 ： 72% NTSC\nBits ： 8Bit\nInput Signal輸入介面 ： 1VGA+1HDMI(1.4)\nVESA Wall Mounting壁掛 ： 75 x 75 mm\nSpeaker喇叭 ： N/A\nPower Supply電源(100 - 240 V) ： External (C13/C14)\nTilt 傾斜 ： -5° to 15°', 'LCD螢幕', 10),
(35, '2025-04-30 12:04:44', 'AOC AG276QZD2 27型 240Hz 電競螢幕', 'Aoc', '黑色', 16999, '2560 X 1440 解析度\n240Hz刷新0.03ms反應\nAdaptive Sync技術', 'images/AOC AG276QZD2.png', '電腦/筆電', '無觸控螢幕', '實際規格依AOC原廠公告為準:https://tw.aoc.com/', 'LCD螢幕', 10),
(36, '2025-04-30 12:04:44', 'LG 樂金 27GR93U-B 27型 IPS 4K 144Hz 電競螢幕', 'Lg', '黑色', 13900, 'IPS 1ms 反應時間\n144Hz 更新率\n三年原廠保固', 'images/LG 27GR93U-B.png', '電腦/筆電', '無觸控螢幕', '實際規格依LG原廠公告為準:https://www.lg.com/tw/', 'LCD螢幕', 10);

-- --------------------------------------------------------

--
-- 資料表結構 `reviews`
--

CREATE TABLE `reviews` (
  `username` varchar(10) NOT NULL,
  `time` datetime NOT NULL,
  `comment` text NOT NULL,
  `pid` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `like_cnt` int(11) NOT NULL,
  `unlike_cnt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `reviews`
--

INSERT INTO `reviews` (`username`, `time`, `comment`, `pid`, `rating`, `review_id`, `like_cnt`, `unlike_cnt`) VALUES
('member', '2025-05-24 17:57:44', 'good', 2, 4, 8, 0, 0),
('member', '2025-05-24 23:11:01', 'soso', 2, 3, 9, 0, 0),
('member', '2025-05-24 23:11:36', 'bad', 26, 2, 10, 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '購物車編號',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT '使用者編號',
  `product_id` int(10) UNSIGNED NOT NULL COMMENT '產品編號',
  `quantity` int(11) UNSIGNED NOT NULL COMMENT '商品數量',
  `price` decimal(10,2) NOT NULL COMMENT '成交單價',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '建立時間',
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新時間',
  `color` varchar(11) NOT NULL COMMENT '選擇顏色'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `subscriber`
--

CREATE TABLE `subscriber` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `subscriber`
--

INSERT INTO `subscriber` (`id`, `email`) VALUES
(8, 'member@gmail.com');

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
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- 資料表索引 `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- 資料表索引 `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`product_id`);

--
-- 資料表索引 `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '會員編號', AUTO_INCREMENT=27;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '訂單編號', AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `shoppingcart`
--
ALTER TABLE `shoppingcart`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '購物車編號';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
