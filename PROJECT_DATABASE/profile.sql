-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 07, 2020 at 10:18 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `profile`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutuses`
--

DROP TABLE IF EXISTS `aboutuses`;
CREATE TABLE IF NOT EXISTS `aboutuses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usersID_FK` int(10) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aboutuses_usersid_fk_foreign` (`usersID_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aboutuses`
--

INSERT INTO `aboutuses` (`id`, `usersID_FK`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, '<p style=\"text-align:right\">این سایت به عنوان معرفی کننده گروه برنامه نویسی رونیکا است. این گروه مفتخر به انجام چندین پروژه در حوزه سایت و نرم افزارهای تحت وب میباشد. بهترینها رو برای شما اجرا میکنیم به ما اطمینان کنید<span> &#1748; </span></p>\r\n\r\n<p style=\"text-align:right\">: مهارت های تیم در حوزه های زیر خلاصه میشود &nbsp;</p>\r\n\r\n<ol dir=\"rtl\">\r\n	<li>طراحی تخصصی سایت های شرکتی و فروشگاهی&nbsp;</li>\r\n	<li>طراحی سایت های شرکتی و فروشگاهی با وردپرس</li>\r\n	<li>پشتیبانی از سایت ها و نرم افزار های تحت وب</li>\r\n	<li>طراحی و پشتیبانی اتوماسیون های اداری با تکنولوژی های بروز بسته به نیاز و تقاضای مشتریان</li>\r\n</ol>\r\n\r\n<p style=\"text-align:right\">&nbsp;:&nbsp;مراحل انجام پروژه برای مشتریان بسته به نوع و اندازه پروژه تعیین میشود ولی یک روال کلی دارد که به شرح زیر است</p>\r\n\r\n<ol dir=\"rtl\">\r\n	<li>مرحله یک</li>\r\n	<li>مرحله دو</li>\r\n</ol>', '2020-06-20 13:24:18', '2020-08-02 09:38:12');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` varchar(600) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` tinyint(1) NOT NULL,
  `popular` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL,
  `categoryID_FK` int(10) UNSIGNED NOT NULL,
  `usersID_FK` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articles_categoryid_fk_foreign` (`categoryID_FK`),
  KEY `articles_usersid_fk_foreign` (`usersID_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `picture`, `slug`, `url`, `tags`, `content`, `priority`, `popular`, `status`, `categoryID_FK`, `usersID_FK`, `created_at`, `updated_at`) VALUES
(7, 'مقاله یک', '{\"main\":\"\\/upload\\/images\\/blog\\/1596716409-\\u0627\\u0645\\u0627\\u0645 \\u0628\\u0627\\u0642\\u0631.jpg\",\"others\":[\"\\/upload\\/images\\/blog\\/300_1596716409-\\u0627\\u0645\\u0627\\u0645 \\u0628\\u0627\\u0642\\u0631.jpg\",\"\\/upload\\/images\\/blog\\/600_1596716409-\\u0627\\u0645\\u0627\\u0645 \\u0628\\u0627\\u0642\\u0631.jpg\",\"\\/upload\\/images\\/blog\\/900_1596716409-\\u0627\\u0645\\u0627\\u0645 \\u0628\\u0627\\u0642\\u0631.jpg\"]}', 'مقاله یک', 'http://localhost:8000/blog/مقاله یک', 'مقاله,مقاله یک', '<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>\r\n\r\n<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>\r\n\r\n<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>\r\n\r\n<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>\r\n\r\n<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>', 1, 1, 1, 2, 1, '2020-08-06 07:50:10', '2020-08-06 07:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `category_articles`
--

DROP TABLE IF EXISTS `category_articles`;
CREATE TABLE IF NOT EXISTS `category_articles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(600) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `usersID_FK` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_articles_usersid_fk_foreign` (`usersID_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_articles`
--

INSERT INTO `category_articles` (`id`, `title`, `slug`, `tags`, `status`, `parent_id`, `usersID_FK`, `created_at`, `updated_at`) VALUES
(1, 'دسته بندی نشده', 'دسته بندی نشده', 'دسته بندی نشده', 1, 0, 1, '2020-06-17 13:40:55', '2020-08-04 08:45:12'),
(2, 'دسته مقاله 1', 'دسته مقاله 1', 'برچسب مقالات,مقاله یک', 1, 0, 1, '2020-08-06 04:48:53', '2020-08-06 08:25:12');

-- --------------------------------------------------------

--
-- Table structure for table `category_portfolios`
--

DROP TABLE IF EXISTS `category_portfolios`;
CREATE TABLE IF NOT EXISTS `category_portfolios` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(600) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `usersID_FK` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_portfolios_usersid_fk_foreign` (`usersID_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_portfolios`
--

INSERT INTO `category_portfolios` (`id`, `title`, `slug`, `tags`, `status`, `parent_id`, `usersID_FK`, `created_at`, `updated_at`) VALUES
(1, 'دسته بندی نشده', 'دسته بندی نشده', NULL, 1, 0, 1, '2020-08-06 03:45:41', '2020-08-06 03:45:41'),
(2, 'دسته پورتفولیو 1', 'دسته پورتفولیو 1', NULL, 1, 0, 1, '2020-08-06 03:49:11', '2020-08-06 03:50:56');

-- --------------------------------------------------------

--
-- Table structure for table `category_services`
--

DROP TABLE IF EXISTS `category_services`;
CREATE TABLE IF NOT EXISTS `category_services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(600) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `usersID_FK` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_services_usersid_fk_foreign` (`usersID_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_services`
--

INSERT INTO `category_services` (`id`, `title`, `slug`, `tags`, `status`, `parent_id`, `usersID_FK`, `created_at`, `updated_at`) VALUES
(1, 'دسته بندی نشده', 'دسته بندی نشده', NULL, 1, 0, 1, '2020-08-06 04:25:41', '2020-08-06 04:25:41'),
(2, 'دسته سرویس 1', 'دسته سرویس 1', NULL, 1, 0, 1, '2020-08-06 04:26:02', '2020-08-06 04:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `contactuses`
--

DROP TABLE IF EXISTS `contactuses`;
CREATE TABLE IF NOT EXISTS `contactuses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tel` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(600) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(600) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usersID_FK` int(10) UNSIGNED NOT NULL,
  `google_map` varchar(700) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contactuses_usersid_fk_foreign` (`usersID_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contactuses`
--

INSERT INTO `contactuses` (`id`, `tel`, `email`, `mobile`, `fax`, `postal_code`, `address`, `usersID_FK`, `google_map`, `created_at`, `updated_at`) VALUES
(1, '09999891521', 'davoudkhoshkar1995@gmail.com', '09999891521', '1', '1', '<p>ایران، تهران، میدان آزادی، ضلع جنوبی میدان فتح، مجتمع پارساییان</p>', 1, NULL, '2020-06-19 15:38:17', '2020-07-30 08:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `picture`, `phone`, `mobile`, `created_at`, `updated_at`) VALUES
(1, 'داوود خوشکار', 'info@info.com', NULL, NULL, NULL, '2020-08-05 07:12:11', '2020-08-05 07:12:11'),
(2, 'داوود خوشکار', 'infi@info.com', NULL, NULL, NULL, '2020-08-05 07:12:40', '2020-08-05 07:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image_models`
--

DROP TABLE IF EXISTS `image_models`;
CREATE TABLE IF NOT EXISTS `image_models` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image_models`
--

INSERT INTO `image_models` (`id`, `picture`, `symbol`, `model_id`, `created_at`, `updated_at`) VALUES
(13, '/upload/images/portfolio/small/1596279765-5.jpg', 'portfolio_3', 3, '2020-08-01 06:32:45', '2020-08-01 06:32:45'),
(16, '/upload/images/portfolio/small/1596283944-13.jpg', 'portfolio_5', 3, '2020-08-01 07:42:24', '2020-08-01 07:42:24'),
(11, '/upload/images/portfolio/small/1596280106-25.jpg', 'portfolio_1', 3, '2020-08-01 06:32:45', '2020-08-01 06:38:26'),
(14, '/upload/images/portfolio/small/1596279783-19.jpg', 'portfolio_4', 3, '2020-08-01 06:33:03', '2020-08-01 06:33:03'),
(17, '/upload/images/portfolio/small/1596288083-10.jpg', 'portfolio_0', 4, '2020-08-01 08:51:23', '2020-08-01 08:51:23'),
(18, '/upload/images/portfolio/small/1596288083-9.jpg', 'portfolio_1', 4, '2020-08-01 08:51:23', '2020-08-01 08:51:23'),
(19, '/upload/images/portfolio/small/1596288083-6.jpg', 'portfolio_2', 4, '2020-08-01 08:51:23', '2020-08-01 08:51:23'),
(20, '/upload/images/portfolio/small/1596288947-5.jpg', 'portfolio_0', 5, '2020-08-01 09:05:47', '2020-08-01 09:05:47'),
(21, '/upload/images/portfolio/small/1596288947-1.jpg', 'portfolio_1', 5, '2020-08-01 09:05:47', '2020-08-01 09:05:47'),
(25, '/upload/images/service/small/1596303266-2.jpg', 'service_0', 2, '2020-08-01 13:04:26', '2020-08-01 13:04:26'),
(26, '/upload/images/service/small/1596303266-3.jpg', 'service_1', 2, '2020-08-01 13:04:26', '2020-08-01 13:04:26'),
(27, '/upload/images/service/small/1596303496-29.jpg', 'service_2', 2, '2020-08-01 13:08:16', '2020-08-01 13:08:16'),
(28, '/upload/images/service/small/1596303496-27.jpg', 'service_3', 2, '2020-08-01 13:08:16', '2020-08-01 13:08:16');

-- --------------------------------------------------------

--
-- Table structure for table `image_services`
--

DROP TABLE IF EXISTS `image_services`;
CREATE TABLE IF NOT EXISTS `image_services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `serviceID_FK` int(10) UNSIGNED NOT NULL,
  `imageUrl` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `image_services_serviceid_fk_foreign` (`serviceID_FK`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `parent_id` int(11) NOT NULL,
  `url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usersID_FK` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_usersid_fk_foreign` (`usersID_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `slug`, `status`, `parent_id`, `url`, `usersID_FK`, `created_at`, `updated_at`) VALUES
(3, 'منو سه', 'منو سه', 1, 0, 'http://localhost:8000/site/منو سه', 1, '2020-06-12 13:49:54', '2020-06-12 13:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `article_id` int(11) NOT NULL DEFAULT 0,
  `content` varchar(700) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `contact` tinyint(4) DEFAULT 0,
  `comment` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_customer_id_foreign` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `subject`, `article_id`, `content`, `customer_id`, `contact`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'موضوع تصادفی', 0, 'پیام تصادفی', 1, 1, 0, '2020-08-05 07:12:11', '2020-08-05 07:12:11'),
(2, 'fdsafasdfas', 0, 'dfsadfsafsdaas', 2, 1, 0, '2020-08-05 07:12:40', '2020-08-05 07:12:40'),
(3, '', 0, 'پیام تصادفی', 1, 1, 0, '2020-08-05 07:28:31', '2020-08-05 07:28:31'),
(4, '', 4, 'پیامی دیگر', 1, 1, 0, '2020-08-05 07:29:01', '2020-08-05 07:29:01'),
(5, '', 4, 'fdsafdsafdsadfas', 1, 1, 1, '2020-08-05 07:31:38', '2020-08-05 07:31:38');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_06_11_172249_create_menus_table', 2),
(6, '2020_06_11_185154_create__vw_menus_view', 3),
(7, '2020_06_12_191500_create_pages_table', 4),
(8, '2020_06_12_191557_add_page_column_to_menus_table', 4),
(9, '2020_06_12_195916_add_menu_column_to_pages_table', 5),
(10, '2020_06_13_170651_create_sliders_table', 6),
(11, '2020_06_16_190209_create_articles_table', 7),
(12, '2020_06_16_191126_create_category_articles_table', 7),
(13, '2020_06_19_182902_create_contactuses_table', 8),
(14, '2020_06_20_172909_create_aboutuses_table', 9),
(15, '2020_06_20_184811_create_socialmedia_table', 10),
(16, '2020_06_21_195949_create_services_table', 11),
(17, '2020_06_21_200400_create_category_services_table', 11),
(18, '2020_06_26_174638_create_image_services_table', 12),
(19, '2020_07_31_065036_create_portfolios_table', 13),
(20, '2020_07_31_065714_create_category_portfolios_table', 13),
(21, '2020_07_31_081249_create_image_models_table', 13),
(22, '2020_08_05_092353_create_messages_table', 14),
(23, '2020_08_05_092914_create_customers_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `pages_menu_id_foreign` (`menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `content`, `created_at`, `updated_at`, `menu_id`) VALUES
(5, '<p>محتوای صفحه دوم نیز ایجاد شد</p>', '2020-06-12 16:11:19', '2020-06-12 16:11:19', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

DROP TABLE IF EXISTS `portfolios`;
CREATE TABLE IF NOT EXISTS `portfolios` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `picture` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` varchar(600) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoryID_FK` int(10) UNSIGNED NOT NULL,
  `usersID_FK` int(10) UNSIGNED NOT NULL,
  `priority` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `portfolios_categoryid_fk_foreign` (`categoryID_FK`),
  KEY `portfolios_usersid_fk_foreign` (`usersID_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `picture`, `title`, `slug`, `tags`, `content`, `categoryID_FK`, `usersID_FK`, `priority`, `status`, `created_at`, `updated_at`) VALUES
(2, '{\"main\":\"\\/upload\\/images\\/portfolio\\/large\\/seo.png\",\"others\":[\"\\/upload\\/images\\/portfolio\\/large\\/300_1596790691-seo.png\",\"\\/upload\\/images\\/portfolio\\/large\\/600_1596790691-seo.png\",\"\\/upload\\/images\\/portfolio\\/large\\/900_1596790691-seo.png\"]}', 'نمونه کاردوم', 'نمونه کاردوم', NULL, '<p>متن تصادفی</p>', 1, 1, 0, 1, '2020-08-06 04:15:47', '2020-08-07 04:28:11');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `picture` varchar(800) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoryID_FK` int(10) UNSIGNED NOT NULL,
  `usersID_FK` int(10) UNSIGNED NOT NULL,
  `priority` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `tags` varchar(600) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_categoryid_foreign` (`categoryID_FK`),
  KEY `services_usersid_foreign` (`usersID_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `picture` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` tinyint(1) NOT NULL DEFAULT 0,
  `usersID_FK` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `slider_type` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sliders_usersid_fk_foreign` (`usersID_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `picture`, `title`, `description`, `link`, `priority`, `usersID_FK`, `status`, `slider_type`, `created_at`, `updated_at`) VALUES
(10, '/upload/images/slider/1596709749_1596136075_4.jpg', 'تصویر یکم', NULL, '#', 1, 1, 1, 1, '2020-07-30 14:37:13', '2020-08-06 05:59:09'),
(11, '/upload/images/slider/1596709735_1596136033_1.jpg', 'تصویر دوم', NULL, '#', 2, 1, 1, 1, '2020-07-30 14:37:55', '2020-08-06 05:58:55');

-- --------------------------------------------------------

--
-- Table structure for table `socialmedia`
--

DROP TABLE IF EXISTS `socialmedia`;
CREATE TABLE IF NOT EXISTS `socialmedia` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `link` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socialmedia`
--

INSERT INTO `socialmedia` (`id`, `link`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'تغییربشسیبسبسشی', 1, 1, '2020-06-20 15:27:17', '2020-06-21 13:49:18'),
(2, 'یسبیشسبشس', 5, 1, '2020-06-20 16:38:04', '2020-06-20 17:03:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`) USING HASH
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'داوود خوشکار', '2580772189', 'info@info.com', NULL, '$2y$10$zf8F6FirOgnBNoVICwsxd.hJ/ibHoqtMPkhQHVGMqoReai96KXNku', NULL, 1, '2020-06-06 14:09:59', '2020-06-06 14:09:59');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_articles`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_articles`;
CREATE TABLE IF NOT EXISTS `vw_articles` (
`id` bigint(20) unsigned
,`title` varchar(200)
,`picture` varchar(1000)
,`slug` varchar(200)
,`url` varchar(500)
,`tags` varchar(600)
,`content` text
,`priority` tinyint(1)
,`popular` tinyint(1)
,`status` tinyint(1)
,`categoryID_FK` int(10) unsigned
,`usersID_FK` int(10) unsigned
,`created_at` timestamp
,`updated_at` timestamp
,`UserName` varchar(100)
,`CategoryName` varchar(150)
,`PersianPriority` varchar(3)
,`PersianStatus` varchar(13)
,`PersianPopular` varchar(7)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_categoryarticles`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_categoryarticles`;
CREATE TABLE IF NOT EXISTS `vw_categoryarticles` (
`id` bigint(20) unsigned
,`title` varchar(150)
,`slug` varchar(300)
,`tags` varchar(600)
,`status` tinyint(1)
,`parent_id` int(11)
,`usersID_FK` int(10) unsigned
,`created_at` timestamp
,`updated_at` timestamp
,`ParentName` varchar(150)
,`UserName` varchar(100)
,`PersianStatus` varchar(13)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_categoryportfolio`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_categoryportfolio`;
CREATE TABLE IF NOT EXISTS `vw_categoryportfolio` (
`id` bigint(20) unsigned
,`title` varchar(150)
,`slug` varchar(300)
,`tags` varchar(600)
,`status` tinyint(1)
,`parent_id` int(11)
,`usersID_FK` int(10) unsigned
,`created_at` timestamp
,`updated_at` timestamp
,`ParentName` varchar(150)
,`UserName` varchar(100)
,`PersianStatus` varchar(13)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_categoryservices`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_categoryservices`;
CREATE TABLE IF NOT EXISTS `vw_categoryservices` (
`id` bigint(20) unsigned
,`title` varchar(150)
,`slug` varchar(300)
,`tags` varchar(600)
,`status` tinyint(1)
,`parent_id` int(11)
,`usersID_FK` int(10) unsigned
,`created_at` timestamp
,`updated_at` timestamp
,`ParentName` varchar(150)
,`UserName` varchar(100)
,`PersianStatus` varchar(13)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_menus`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_menus`;
CREATE TABLE IF NOT EXISTS `vw_menus` (
`id` int(10) unsigned
,`title` varchar(30)
,`slug` varchar(200)
,`status` tinyint(1)
,`parent_id` int(11)
,`url` varchar(500)
,`usersID_FK` int(10) unsigned
,`created_at` timestamp
,`updated_at` timestamp
,`ParentName` varchar(30)
,`UserName` varchar(100)
,`PersianStatus` varchar(13)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_portfolio`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_portfolio`;
CREATE TABLE IF NOT EXISTS `vw_portfolio` (
`id` bigint(20) unsigned
,`picture` varchar(1000)
,`title` varchar(200)
,`slug` varchar(200)
,`tags` varchar(600)
,`content` text
,`categoryID_FK` int(10) unsigned
,`usersID_FK` int(10) unsigned
,`priority` tinyint(1)
,`status` tinyint(1)
,`created_at` timestamp
,`updated_at` timestamp
,`UserName` varchar(100)
,`CategoryName` varchar(150)
,`PersianPriority` varchar(5)
,`PersianStatus` varchar(13)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_services`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_services`;
CREATE TABLE IF NOT EXISTS `vw_services` (
`id` bigint(20) unsigned
,`picture` varchar(800)
,`title` varchar(200)
,`slug` varchar(200)
,`content` text
,`categoryID_FK` int(10) unsigned
,`usersID_FK` int(10) unsigned
,`priority` tinyint(1)
,`status` tinyint(1)
,`tags` varchar(600)
,`created_at` timestamp
,`updated_at` timestamp
,`UserName` varchar(100)
,`CategoryName` varchar(150)
,`PersianPriority` varchar(5)
,`PersianStatus` varchar(13)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_sliders`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_sliders`;
CREATE TABLE IF NOT EXISTS `vw_sliders` (
`id` bigint(20) unsigned
,`picture` varchar(500)
,`title` varchar(200)
,`description` varchar(300)
,`link` varchar(300)
,`priority` tinyint(1)
,`usersID_FK` int(10) unsigned
,`status` tinyint(1)
,`slider_type` tinyint(1)
,`created_at` timestamp
,`updated_at` timestamp
,`UserName` varchar(100)
,`PersianStatus` varchar(13)
,`PersianPriority` varchar(5)
,`PersianSliderType` varchar(13)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_socialmedia`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_socialmedia`;
CREATE TABLE IF NOT EXISTS `vw_socialmedia` (
`id` bigint(20) unsigned
,`link` varchar(200)
,`type` tinyint(1)
,`status` tinyint(4)
,`created_at` timestamp
,`updated_at` timestamp
,`PersianTitle` varchar(10)
,`PersianStatus` varchar(8)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_articles`
--
DROP TABLE IF EXISTS `vw_articles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_articles`  AS  select `a`.`id` AS `id`,`a`.`title` AS `title`,`a`.`picture` AS `picture`,`a`.`slug` AS `slug`,`a`.`url` AS `url`,`a`.`tags` AS `tags`,`a`.`content` AS `content`,`a`.`priority` AS `priority`,`a`.`popular` AS `popular`,`a`.`status` AS `status`,`a`.`categoryID_FK` AS `categoryID_FK`,`a`.`usersID_FK` AS `usersID_FK`,`a`.`created_at` AS `created_at`,`a`.`updated_at` AS `updated_at`,`u`.`name` AS `UserName`,`ca`.`title` AS `CategoryName`,case `a`.`priority` when 1 then 'اول' when 2 then 'دوم' when 3 then 'سوم' end AS `PersianPriority`,case `a`.`status` when 0 then 'غیر قابل رویت' when 1 then 'قابل رویت' end AS `PersianStatus`,case `a`.`popular` when 0 then 'نامعروف' when 1 then 'معروف' end AS `PersianPopular` from ((`articles` `a` join `category_articles` `ca` on(`ca`.`id` = `a`.`categoryID_FK`)) join `users` `u` on(`u`.`id` = `a`.`usersID_FK`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_categoryarticles`
--
DROP TABLE IF EXISTS `vw_categoryarticles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_categoryarticles`  AS  select `ca`.`id` AS `id`,`ca`.`title` AS `title`,`ca`.`slug` AS `slug`,`ca`.`tags` AS `tags`,`ca`.`status` AS `status`,`ca`.`parent_id` AS `parent_id`,`ca`.`usersID_FK` AS `usersID_FK`,`ca`.`created_at` AS `created_at`,`ca`.`updated_at` AS `updated_at`,`ccaa`.`title` AS `ParentName`,`u`.`name` AS `UserName`,case `ca`.`status` when 0 then 'غیر قابل رویت' when 1 then 'قابل رویت' end AS `PersianStatus` from ((`category_articles` `ca` left join `category_articles` `ccaa` on(`ccaa`.`id` = `ca`.`parent_id`)) join `users` `u` on(`u`.`id` = `ca`.`usersID_FK`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_categoryportfolio`
--
DROP TABLE IF EXISTS `vw_categoryportfolio`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_categoryportfolio`  AS  select `cp`.`id` AS `id`,`cp`.`title` AS `title`,`cp`.`slug` AS `slug`,`cp`.`tags` AS `tags`,`cp`.`status` AS `status`,`cp`.`parent_id` AS `parent_id`,`cp`.`usersID_FK` AS `usersID_FK`,`cp`.`created_at` AS `created_at`,`cp`.`updated_at` AS `updated_at`,`ccpp`.`title` AS `ParentName`,`u`.`name` AS `UserName`,case `cp`.`status` when 0 then 'غیر قابل رویت' when 1 then 'قابل رویت' end AS `PersianStatus` from ((`category_portfolios` `cp` left join `category_portfolios` `ccpp` on(`ccpp`.`id` = `cp`.`parent_id`)) join `users` `u` on(`u`.`id` = `cp`.`usersID_FK`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_categoryservices`
--
DROP TABLE IF EXISTS `vw_categoryservices`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_categoryservices`  AS  select `cs`.`id` AS `id`,`cs`.`title` AS `title`,`cs`.`slug` AS `slug`,`cs`.`tags` AS `tags`,`cs`.`status` AS `status`,`cs`.`parent_id` AS `parent_id`,`cs`.`usersID_FK` AS `usersID_FK`,`cs`.`created_at` AS `created_at`,`cs`.`updated_at` AS `updated_at`,`ccss`.`title` AS `ParentName`,`u`.`name` AS `UserName`,case `cs`.`status` when 0 then 'غیر قابل رویت' when 1 then 'قابل رویت' end AS `PersianStatus` from ((`category_services` `cs` left join `category_services` `ccss` on(`ccss`.`id` = `cs`.`parent_id`)) join `users` `u` on(`u`.`id` = `cs`.`usersID_FK`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_menus`
--
DROP TABLE IF EXISTS `vw_menus`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_menus`  AS  select `m`.`id` AS `id`,`m`.`title` AS `title`,`m`.`slug` AS `slug`,`m`.`status` AS `status`,`m`.`parent_id` AS `parent_id`,`m`.`url` AS `url`,`m`.`usersID_FK` AS `usersID_FK`,`m`.`created_at` AS `created_at`,`m`.`updated_at` AS `updated_at`,`mm`.`title` AS `ParentName`,`u`.`name` AS `UserName`,case `m`.`status` when 0 then 'غیر قابل رویت' when 1 then 'قابل رویت' end AS `PersianStatus` from ((`menus` `m` left join `menus` `mm` on(`m`.`parent_id` = `mm`.`id`)) join `users` `u` on(`m`.`usersID_FK` = `u`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_portfolio`
--
DROP TABLE IF EXISTS `vw_portfolio`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_portfolio`  AS  select `p`.`id` AS `id`,`p`.`picture` AS `picture`,`p`.`title` AS `title`,`p`.`slug` AS `slug`,`p`.`tags` AS `tags`,`p`.`content` AS `content`,`p`.`categoryID_FK` AS `categoryID_FK`,`p`.`usersID_FK` AS `usersID_FK`,`p`.`priority` AS `priority`,`p`.`status` AS `status`,`p`.`created_at` AS `created_at`,`p`.`updated_at` AS `updated_at`,`u`.`name` AS `UserName`,`cp`.`title` AS `CategoryName`,case `p`.`priority` when 1 then 'اول' when 2 then 'دوم' when 3 then 'سوم' when 4 then 'چهارم' when 5 then 'پنجم' when 6 then 'ششم' end AS `PersianPriority`,case `p`.`status` when 0 then 'غیر قابل رویت' when 1 then 'قابل رویت' end AS `PersianStatus` from ((`portfolios` `p` join `category_portfolios` `cp` on(`cp`.`id` = `p`.`categoryID_FK`)) join `users` `u` on(`u`.`id` = `p`.`usersID_FK`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_services`
--
DROP TABLE IF EXISTS `vw_services`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_services`  AS  select `s`.`id` AS `id`,`s`.`picture` AS `picture`,`s`.`title` AS `title`,`s`.`slug` AS `slug`,`s`.`content` AS `content`,`s`.`categoryID_FK` AS `categoryID_FK`,`s`.`usersID_FK` AS `usersID_FK`,`s`.`priority` AS `priority`,`s`.`status` AS `status`,`s`.`tags` AS `tags`,`s`.`created_at` AS `created_at`,`s`.`updated_at` AS `updated_at`,`u`.`name` AS `UserName`,`cs`.`title` AS `CategoryName`,case `s`.`priority` when 1 then 'اول' when 2 then 'دوم' when 3 then 'سوم' when 4 then 'چهارم' when 5 then 'پنجم' when 6 then 'ششم' end AS `PersianPriority`,case `s`.`status` when 0 then 'غیر قابل رویت' when 1 then 'قابل رویت' end AS `PersianStatus` from ((`services` `s` join `category_services` `cs` on(`cs`.`id` = `s`.`categoryID_FK`)) join `users` `u` on(`u`.`id` = `s`.`usersID_FK`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_sliders`
--
DROP TABLE IF EXISTS `vw_sliders`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_sliders`  AS  select `s`.`id` AS `id`,`s`.`picture` AS `picture`,`s`.`title` AS `title`,`s`.`description` AS `description`,`s`.`link` AS `link`,`s`.`priority` AS `priority`,`s`.`usersID_FK` AS `usersID_FK`,`s`.`status` AS `status`,`s`.`slider_type` AS `slider_type`,`s`.`created_at` AS `created_at`,`s`.`updated_at` AS `updated_at`,`u`.`name` AS `UserName`,case `s`.`status` when 0 then 'غیر قابل رویت' when 1 then 'قابل رویت' end AS `PersianStatus`,case `s`.`priority` when 1 then 'اول' when 2 then 'دوم' when 3 then 'سوم' when 4 then 'چهارم' when 5 then 'پنجم' end AS `PersianPriority`,case `s`.`slider_type` when 1 then 'تصویری' when 2 then 'متنی و تصویری' end AS `PersianSliderType` from (`sliders` `s` join `users` `u` on(`s`.`usersID_FK` = `u`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_socialmedia`
--
DROP TABLE IF EXISTS `vw_socialmedia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_socialmedia`  AS  select `sm`.`id` AS `id`,`sm`.`link` AS `link`,`sm`.`type` AS `type`,`sm`.`status` AS `status`,`sm`.`created_at` AS `created_at`,`sm`.`updated_at` AS `updated_at`,case `sm`.`type` when 1 then 'اینستاگرام' when 2 then 'لینکدین' when 3 then 'توییتر' when 4 then 'تلگرام' when 5 then 'یوتیوب' when 6 then 'گپ' when 7 then 'سروش' when 8 then 'آپارات' end AS `PersianTitle`,case `sm`.`status` when 1 then 'قعال' when 0 then 'غیر قعال' end AS `PersianStatus` from `socialmedia` `sm` ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
