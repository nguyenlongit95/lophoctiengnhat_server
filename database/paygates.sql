-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th4 01, 2021 lúc 09:24 AM
-- Phiên bản máy phục vụ: 5.7.24
-- Phiên bản PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hoctiengnhat`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `paygates`
--

DROP TABLE IF EXISTS `paygates`;
CREATE TABLE IF NOT EXISTS `paygates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `configs` text COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `paygates`
--

INSERT INTO `paygates` (`id`, `name`, `code`, `url`, `configs`, `icon`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Ngân Lượng', 'nganluong', 'https://www.nganluong.vn/checkout.php', '{\"RECEIVER\":\"demo@nganluong.vn\",\"MERCHANT_ID\":\"36680\",\"MERCHANT_PASS\":\"matkhauketnoi\",\"currency\":\"vnd\"}', '', '2020-11-27 02:58:17', '2021-03-31 20:36:28', NULL),
(3, 'VNPAY', 'vnpay', 'http://sandbox.vnpayment.vn/paymentv2/vpcpay.html', '{\"vnp_HashSecret\":\"BYOLXENKWJJQXKVVLRBKJHYMXEASMRCH\",\"vnp_TmnCode\":\"DULCJHZU\",\"currency\":\"vnd\",\"url\":\"http:\\/\\/sandbox.vnpayment.vn\\/paymentv2\\/vpcpay.html\"}', '', '2020-12-02 02:49:33', '2021-04-01 00:07:26', NULL),
(4, 'PayPal', 'paypal', 'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=', '{\"SECRET_ID\":\"ED4XVsfGNc-px4RXweWGcE_IJ7GcR6gSMtf5dr6PGlJPndsRPOXtRe8c6f_eSywYLPBc7HczK6qFlcdM\",\"CLIENT_ID\":\"AeYbemRrJQ94AKpZKo_sHSQJsdk8sH25QrfeDwiPhL8kEXxb962Xjs875juuJGsrPGCP5o2mb35jpqSq\",\"SANBOX_ACCOUNT\":\"sb-nlqij3868487@business.example.com\",\"VERSION\":\"53.0\", \"API_USERNAME\" : \"sb-nlqij3868487@business.example.com\", \"API_PASSWORD\":\"thanhnhan030796\", \"API_SIGNATURE\":\"A3CZZ6twi-WT-7ZwGQua95N4-iDJAoXTkTDd9WQ7kUjYBGT3y8pqxT4D\", \"VERSION\" : \"55.0\"}', '', '2020-12-07 09:22:36', '2021-03-31 01:51:33', NULL),
(5, 'MoMo', 'momo', 'https://test-payment.momo.vn', '{\"partnerCode\":\"MOMO2RUK20210401\",\"accessKey\":\"MarXljRRVSODYYom\",\"secretKey\":\"hNKD0ueMaF4kDVR2MV92LEahFNRTOo2Z\",\"currency\":\"vnd\"}', 'momo.png', '2021-04-01 08:15:35', '2021-04-01 08:15:35', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
