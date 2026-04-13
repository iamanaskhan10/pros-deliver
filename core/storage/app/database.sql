-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 31, 2025 at 09:03 AM
-- Server version: 8.0.36-28
-- PHP Version: 8.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `influencer-beta`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_email_verified` tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: not verified, 1:verified',
  `email_verify_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1:super admin, 2:admin, 3:manager, 4:editor, 5:supporter 6:employee',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0:active, 1:inactive',
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `identity` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `blog_post_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=pending, 1=approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint NOT NULL,
  `admin_id` bigint NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` bigint DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  `tag_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `category_id`, `admin_id`, `title`, `slug`, `content`, `image`, `views`, `status`, `tag_name`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Boost your tech brand with permanent exposure to 10M+ monthly viewers', 'boost-your-tech-brand-with-permanent-exposure-to-10m-monthly-viewers', '<p>Over the last several years, a number of factors—including the pandemic, shifting labor market dynamics, macroeconomic uncertainties, and technological advancements—have prompted a significant reevaluation of what “work” looks like among enterprise leaders. To help drive the growth and success of our enterprise business, and deliver work solutions to our largest clients, we were pleased to welcome Zoë Diamadi as Upwork’s General Manager (GM) of Enterprise.</p><p><br></p><p>\r\n</p><p>Zoë came to Upwork with over two decades of experience as a go-to-market leader, strategist, engineer, management consultant, and innovator at many companies across tech, talent, and B2B. Since joining in June of 2023, she has overseen and evolved Enterprise sales, product, engineering, and operations.\r\n</p><p>We spoke with Zoë about her critical role in helping enterprises navigate the changing global work environment and dynamic hiring climate, her reasons for joining Upwork, and how she plans to champion the delivery of a best-in-class Enterprise Suite offering to our largest customers.</p><p><br></p><p>\r\n</p><p>You have extensive background in technology and business. How has your journey prepared you for your role as GM of Enterprise at Upwork?\r\n</p><p>My journey has been an evolution through various domains, from engineering to management consulting, and what I like to call “intrapreneurship.” I spent six years as GM of LinkedIn Elevate, building the leading employee advocacy solution for enterprises, as well as time spent in executive positions for LinkedIn’s B2B organization, helping scale its three enterprise business lines.</p><p><br></p><p>\r\n</p><p>More recently, I served as an operating advisor at Bessemer Venture Partners. There, I guided portfolio companies on go-to-market topics spanning revenue growth, efficient scaling, and operational excellence for sales and post-sales functions.\r\n</p><p>These experiences have given me a holistic perspective on enterprises, their business strategies, and opportunities that drive growth. This journey has led me to my current role at Upwork.\r\n</p><p>I believe we are at a critical inflection point in the future of work, and frankly, \"work\" needs to catch up to the technologies that are now enabling it to happen. Upwork delivers an end-to-end offering that gives enterprise companies access to a wide breadth of highly skilled fractional to full-time professionals and workforce solutions, enabling them to achieve incredible business outcomes. I hope to help even more organizations discover, and scale with, the transformational value of Upwork.\r\n</p><p>What motivated you to join Upwork?</p><p><br></p><p>\r\n</p><p>Aside from what I feel is the perfect career fit, on a more personal level, I grew up in a small rural place in Greece. Every day, I saw firsthand how many talented and hardworking people were limited by their geography and couldn’t access the opportunities they wanted and were qualified for. These people in my memories represent an untapped pool of highly skilled talent who could have a huge impact on companies. Additionally, these companies and jobs represent a huge economic opportunity for these people to lift themselves, their families, and their communities up.\r\n</p><p>That’s why I’m so passionate about Upwork—and why I joined.</p>', '348', NULL, 1, 'Ideas,thinking', '2024-12-11 01:20:24', '2025-04-29 04:18:16'),
(3, 3, 1, 'Empower and Elevate – wellness and self-growth influencer campaign', 'empower-and-elevate-wellness-and-self-growth-influencer-campaign', 'Over the last several years, a number of factors—including the pandemic, shifting labor market dynamics, macroeconomic uncertainties, and technological advancements—have prompted a significant reevaluation of what “work” looks like among enterprise leaders. To help drive the growth and success of our enterprise business, and deliver work solutions to our largest clients, we were pleased to welcome Zoë Diamadi as Upwork’s General Manager (GM) of Enterprise.\r\n<div>Zoë came to Upwork with over two decades of experience as a go-to-market leader, strategist, engineer, management consultant, and innovator at many companies across tech, talent, and B2B. Since joining in June of 2023, she has overseen and evolved Enterprise sales, product, engineering, and operations.\r\n</div><div>We spoke with Zoë about her critical role in helping enterprises navigate the changing global work environment and dynamic hiring climate, her reasons for joining Upwork, and how she plans to champion the delivery of a best-in-class Enterprise Suite offering to our largest customers.\r\n</div><div>You have extensive background in technology and business. How has your journey prepared you for your role as GM of Enterprise at Upwork?\r\n</div><div>My journey has been an evolution through various domains, from engineering to management consulting, and what I like to call “intrapreneurship.” I spent six years as GM of LinkedIn Elevate, building the leading employee advocacy solution for enterprises, as well as time spent in executive positions for LinkedIn’s B2B organization, helping scale its three enterprise business lines.\r\n</div><div>More recently, I served as an operating advisor at Bessemer Venture Partners. There, I guided portfolio companies on go-to-market topics spanning revenue growth, efficient scaling, and operational excellence for sales and post-sales functions.\r\n</div><div>These experiences have given me a holistic perspective on enterprises, their business strategies, and opportunities that drive growth. This journey has led me to my current role at Upwork.\r\n</div><div>I believe we are at a critical inflection point in the future of work, and frankly, \"work\" needs to catch up to the technologies that are now enabling it to happen. Upwork delivers an end-to-end offering that gives enterprise companies access to a wide breadth of highly skilled fractional to full-time professionals and workforce solutions, enabling them to achieve incredible business outcomes. I hope to help even more organizations discover, and scale with, the transformational value of Upwork.\r\n</div><div>What motivated you to join Upwork?\r\n</div><div>Aside from what I feel is the perfect career fit, on a more personal level, I grew up in a small rural place in Greece. Every day, I saw firsthand how many talented and hardworking people were limited by their geography and couldn’t access the opportunities they wanted and were qualified for. These people in my memories represent an untapped pool of highly skilled talent who could have a huge impact on companies. Additionally, these companies and jobs represent a huge economic opportunity for these people to lift themselves, their families, and their communities up.\r\n</div><div>That’s why I’m so passionate about Upwork—and why I joined.</div>', '336', NULL, 1, 'beauty,tips', '2024-12-11 04:52:45', '2025-04-29 04:16:16'),
(4, 1, 1, 'Extreme experience in eBay research and listings', 'extreme-experience-in-ebay-research-and-listings', 'Over the last several years, a number of factors—including the pandemic, shifting labor market dynamics, macroeconomic uncertainties, and technological advancements—have prompted a significant reevaluation of what “work” looks like among enterprise leaders. To help drive the growth and success of our enterprise business, and deliver work solutions to our largest clients, we were pleased to welcome Zoë Diamadi as Upwork’s General Manager (GM) of Enterprise.\r\n<div>Zoë came to Upwork with over two decades of experience as a go-to-market leader, strategist, engineer, management consultant, and innovator at many companies across tech, talent, and B2B. Since joining in June of 2023, she has overseen and evolved Enterprise sales, product, engineering, and operations.\r\n</div><div>We spoke with Zoë about her critical role in helping enterprises navigate the changing global work environment and dynamic hiring climate, her reasons for joining Upwork, and how she plans to champion the delivery of a best-in-class Enterprise Suite offering to our largest customers.\r\n</div><div>You have extensive background in technology and business. How has your journey prepared you for your role as GM of Enterprise at Upwork?\r\n</div><div>My journey has been an evolution through various domains, from engineering to management consulting, and what I like to call “intrapreneurship.” I spent six years as GM of LinkedIn Elevate, building the leading employee advocacy solution for enterprises, as well as time spent in executive positions for LinkedIn’s B2B organization, helping scale its three enterprise business lines.\r\n</div><div>More recently, I served as an operating advisor at Bessemer Venture Partners. There, I guided portfolio companies on go-to-market topics spanning revenue growth, efficient scaling, and operational excellence for sales and post-sales functions.\r\n</div><div>These experiences have given me a holistic perspective on enterprises, their business strategies, and opportunities that drive growth. This journey has led me to my current role at Upwork.\r\n</div><div>I believe we are at a critical inflection point in the future of work, and frankly, \"work\" needs to catch up to the technologies that are now enabling it to happen. Upwork delivers an end-to-end offering that gives enterprise companies access to a wide breadth of highly skilled fractional to full-time professionals and workforce solutions, enabling them to achieve incredible business outcomes. I hope to help even more organizations discover, and scale with, the transformational value of Upwork.\r\n</div><div>What motivated you to join Upwork?\r\n</div><div>Aside from what I feel is the perfect career fit, on a more personal level, I grew up in a small rural place in Greece. Every day, I saw firsthand how many talented and hardworking people were limited by their geography and couldn’t access the opportunities they wanted and were qualified for. These people in my memories represent an untapped pool of highly skilled talent who could have a huge impact on companies. Additionally, these companies and jobs represent a huge economic opportunity for these people to lift themselves, their families, and their communities up.\r\n</div><div>That’s why I’m so passionate about Upwork—and why I joined.</div>', '278', NULL, 1, 'experience', '2024-12-11 04:53:11', '2025-04-29 04:12:47'),
(8, 11, 1, 'Glow up your brand with skincare-entric beauty content', 'glow-up-your-brand-with-skincare-entric-beauty-content', 'Are you passionate about transforming spaces into cozy, stylish sanctuaries?<br><br>🏡✨ Do you love sharing decor tips, before-and-after transformations, or showcasing minimalist, boho, or luxury interiors with your followers?<br><br>We’re partnering with brands in the home decor and lifestyle niche – from furniture companies to eco-friendly organizers and aesthetic lighting brands – and we’re looking for creators like you to bring them to life on social media. Whether you do room makeovers, shelf styling, or mood board magic, this is your chance to monetize your taste and influence.<br><br><b>✅ Features You’ll Have Access To:</b><br>Brand Collaborations: Match with interior &amp; decor brands aligned with your audience<br>Custom Campaign Briefs: Clear guidelines so you can create with purpose<br>Real-Time Analytics: Track views, reach, and ROI for your campaigns<br>One-Click Portfolio Display: Showcase your top posts, collabs, and decor transformations<br>Secure Payment System: Guaranteed payments on completion<br>Direct Messaging: Easy chat with clients for faster turnaround<br><br><br><br><b>🎯 Ideal Influencer Profile:</b><br>Aesthetic-driven Instagram or TikTok feed<br>Home organization, furniture styling, or DIY home content<br>Audience interested in cozy living, smart spaces, or design inspiration<br>Platform reach on Instagram Reels, TikTok, or Pinterest', '346', NULL, 1, 'Tiktok,Youtube,social', '2024-12-20 02:04:44', '2025-04-29 04:22:09'),
(9, 11, 1, 'Elevate your brand with authentic fashion influence', 'elevate-your-brand-with-authentic-fashion-influence', '<p>Are you a fashion influencer passionate about style, trends, and authentic engagement? Join our dynamic platform to collaborate with top fashion brands seeking to connect with audiences through genuine and stylish content.​<br><br><br><b>What We Offer:</b><br><br>🤝 Seamless Collaboration: Connect directly with brands that align with your fashion niche and audience.<br>📈 Performance Analytics: Access real-time data on engagement, reach, and conversions to showcase your impact.<br>💼 Portfolio Showcase: Highlight your previous collaborations and style to attract potential brand partners.<br>💬 Direct Communication: Utilize our integrated messaging system for efficient coordination with brands.<br>💰 Secure Payments: Ensure timely and secure compensation for your creative efforts.​<br><br><b>Ideal Collaborators:</b><br><br>Fashion influencers with a strong presence on platforms like Instagram, TikTok, or YouTube, who have an engaged following and a passion for creating compelling fashion content.​<br><br><b>Join Us:</b><br>Become part of a community where your fashion influence meets brand opportunities. Let\'s create stylish narratives that resonate.​</p><p>\r\n</p><p><br></p><p><br></p><p>\r\n</p>', '276', NULL, 1, 'brand,promotion', '2024-12-21 02:29:12', '2025-04-29 04:21:10'),
(10, 1, 1, 'Style your space – home decor influencer collabs', 'style-your-space-home-decor-influencer-collabs', 'Are you passionate about transforming spaces into cozy, stylish sanctuaries?<br><br>🏡✨ Do you love sharing decor tips, before-and-after transformations, or showcasing minimalist, boho, or luxury interiors with your followers?<br><br>We’re partnering with brands in the home decor and lifestyle niche – from furniture companies to eco-friendly organizers and aesthetic lighting brands – and we’re looking for creators like you to bring them to life on social media. Whether you do room makeovers, shelf styling, or mood board magic, this is your chance to monetize your taste and influence.<br><br><br>✅ Features You’ll Have Access To:<br><br>Brand Collaborations: Match with interior &amp; decor brands aligned with your audience<br>Custom Campaign Briefs: Clear guidelines so you can create with purpose<br>Real-Time Analytics: Track views, reach, and ROI for your campaigns<br>One-Click Portfolio Display: Showcase your top posts, collabs, and decor transformations<br>Secure Payment System: Guaranteed payments on completion<br>Direct Messaging: Easy chat with clients for faster turnaround<br><br><br><b>🎯 Ideal Influencer Profile:</b><br><br>Aesthetic-driven Instagram or TikTok feed<br>Home organization, furniture styling, or DIY home content<br>Audience interested in cozy living, smart spaces, or design inspiration<br>Platform reach on Instagram Reels, TikTok, or Pinterest', '339', NULL, 1, 'decor,home furnished', '2024-12-25 05:17:33', '2025-04-29 04:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `identity` bigint NOT NULL,
  `is_project_job` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `selected_category` int DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `short_description`, `slug`, `meta_title`, `meta_description`, `status`, `selected_category`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Lifestyle', 'This category describes lifestyles', 'lifestyle', 'This category describes lifestyles', 'This category describes lifestyles', 1, 0, '17', '2023-02-06 05:36:19', '2025-04-12 23:04:09'),
(2, 'Fashion', 'This category describes Fashion', 'fashion', NULL, NULL, 1, 0, '18', '2023-02-06 05:48:16', '2025-04-12 23:27:10'),
(3, 'Beauty', 'This category describes Beauty', 'beauty', NULL, NULL, 1, 0, '19', '2023-02-06 05:48:36', '2025-04-12 23:27:27'),
(4, 'Travel', 'This category describes Travel', 'travel', NULL, NULL, 1, 0, '20', '2023-02-06 05:48:45', '2025-04-12 23:27:45'),
(5, 'Food and Drink', 'This category describes Food and Drink', 'food-and-drink', NULL, NULL, 1, 0, '103', '2023-02-06 05:49:25', '2025-04-12 23:28:06'),
(9, 'Fitness and  Health', 'This category describes Fitness and  Health', 'fitness-and-health', NULL, NULL, 1, 0, '22', '2023-02-07 00:27:03', '2025-04-12 23:25:45'),
(11, 'Tech and Gadgets', 'This category describes Tech and Gadgets', 'tech-and-gadgets', NULL, NULL, 1, 0, '24', '2023-02-07 00:57:08', '2025-04-12 23:26:52'),
(13, 'Parenting and Family', 'This category describes Parenting and Family', 'parenting-and-family', NULL, NULL, 1, 0, '21', '2023-02-07 00:58:39', '2025-04-12 23:26:40'),
(18, 'Finance & Business', 'This category describes Finance & Business', 'finance-and-business', 'Finance & Business', 'Finance & Business', 1, 0, '37', '2023-05-15 23:50:03', '2025-04-12 23:26:23'),
(24, 'Entertainment and Media', 'Entertainment and Media', 'entertainment-and-media', NULL, NULL, 1, 0, NULL, '2024-01-30 06:09:16', '2025-04-12 23:25:13');

-- --------------------------------------------------------

--
-- Table structure for table `category_users`
--

CREATE TABLE `category_users` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `ticket_id` bigint NOT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `notify` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'admin, client, freelancer',
  `load_from` int NOT NULL DEFAULT '0',
  `is_synced` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint UNSIGNED NOT NULL,
  `country_id` int DEFAULT NULL,
  `state_id` int NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `state_id`, `city`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Dhanmondi', 1, '2023-01-29 00:52:22', '2023-01-29 00:52:22'),
(2, 2, 16, 'Akutan', 1, '2023-01-29 01:14:49', '2023-01-29 01:14:49'),
(4, 1, 2, 'Najirhat', 1, '2023-01-29 01:32:51', '2023-01-29 03:51:38'),
(15, 1, 1, '   Kalabagan', 1, '2023-01-29 05:12:55', '2023-01-29 05:12:55'),
(16, 1, 1, '   Nilkhet', 1, '2023-01-29 05:12:55', '2023-01-29 05:12:55'),
(17, 4, 22, 'Adachi Ku', 1, '2023-02-08 05:56:36', '2023-02-08 05:56:36'),
(18, 2, 16, 'zxczxc', 1, '2023-02-08 06:12:41', '2023-02-08 06:12:41'),
(19, 1, 3, 'zxczxczxc', 1, '2023-02-08 06:12:53', '2023-02-08 06:12:53'),
(20, 1, 18, 'sdfsdfs sd', 1, '2023-02-08 06:13:19', '2023-02-08 06:13:19'),
(21, 7, 24, 'test', 1, '2024-09-25 04:19:53', '2024-09-25 04:19:53'),
(22, 7, 25, 'test washi', 1, '2024-09-25 04:20:17', '2024-09-25 04:20:17'),
(23, 3, 21, 'Walsall', 1, '2025-07-14 22:06:31', '2025-07-14 22:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `client_notifications`
--

CREATE TABLE `client_notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `identity` bigint NOT NULL,
  `client_id` bigint NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint UNSIGNED NOT NULL,
  `country` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag_url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `zone_status` tinyint NOT NULL DEFAULT '1',
  `latitude` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country`, `flag`, `flag_url`, `country_code`, `status`, `zone_status`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 'Bangladesh', NULL, 'https://flagcdn.com/w320/bd.png', 'BD', 1, 1, '24', '90', '2021-12-06 23:56:27', '2023-10-21 23:38:12'),
(2, 'United States', NULL, 'https://flagcdn.com/w320/um.png', 'US', 1, 1, '19.3', '166.633333', '2021-12-06 23:56:42', '2023-10-21 23:38:04'),
(3, 'United Kingdom', NULL, 'https://flagcdn.com/w320/gb.png', 'GB', 1, 1, '54', '-2', '2021-12-06 23:56:53', '2023-10-21 23:37:44'),
(4, 'Japan', NULL, 'https://flagcdn.com/w320/jp.png', 'JP', 1, 1, '36', '138', '2021-12-06 23:57:01', '2023-10-21 23:38:21'),
(5, 'Australia', NULL, 'https://flagcdn.com/w320/au.png', 'AU', 1, 1, '-27', '133', '2021-12-06 23:57:08', '2023-10-21 23:38:31'),
(6, 'India', NULL, 'https://flagcdn.com/w320/in.png', 'IN', 1, 0, '20', '77', '2022-02-16 10:10:41', '2023-10-21 23:38:38'),
(7, 'Brazil', NULL, 'https://flagcdn.com/w320/br.png', 'BR', 1, 1, '-10', '-55', '2022-02-16 10:10:53', '2023-10-21 23:38:47'),
(8, 'Canada', NULL, 'https://flagcdn.com/w320/ca.png', 'CA', 1, 1, '60', '-95', '2022-02-16 10:11:01', '2023-10-21 23:38:53'),
(9, 'Pakistan', NULL, 'https://flagcdn.com/w320/pk.png', 'PK', 1, 1, '30', '70', '2022-02-16 10:11:25', '2023-10-21 23:39:02'),
(10, 'Turkey', NULL, 'https://flagcdn.com/w320/tr.png', 'TR', 1, 1, '39', '35', '2022-02-27 02:02:58', '2023-10-21 23:39:09'),
(11, 'Germany', NULL, 'https://flagcdn.com/w320/de.png', 'DE', 1, 1, '51', '9', '2022-02-27 02:03:07', '2023-10-21 23:37:22'),
(12, 'France', NULL, 'https://flagcdn.com/w320/fr.png', 'FR', 1, 1, '46', '2', '2022-02-27 02:03:11', '2023-10-21 23:37:16'),
(13, 'Italy', NULL, 'https://flagcdn.com/w320/it.png', 'IT', 1, 1, '42.83333333', '12.83333333', '2022-02-27 02:03:20', '2023-10-21 23:37:09'),
(14, 'Kenya', NULL, 'https://flagcdn.com/w320/ke.png', 'KE', 1, 1, '1', '38', '2022-02-27 02:03:26', '2023-10-21 23:37:03'),
(15, 'United Arab Emirates', NULL, 'https://flagcdn.com/w320/ae.png', 'AE', 1, 1, '24', '54', '2022-02-27 02:04:07', '2023-10-21 23:36:35'),
(64, 'Russia', NULL, 'https://flagcdn.com/w320/ru.png', 'RU', 1, 1, '60', '100', '2022-10-24 06:27:34', '2023-10-21 23:41:25'),
(65, 'Nepal', NULL, 'https://flagcdn.com/w320/np.png', 'NP', 1, 1, '28', '84', '2022-10-24 06:27:34', '2023-10-21 23:40:56'),
(66, 'Mexico', NULL, 'https://flagcdn.com/w320/mx.png', 'MX', 1, 1, '23', '-102', '2022-10-24 06:27:34', '2023-10-21 23:40:39'),
(67, 'Egypt', NULL, 'https://flagcdn.com/w320/eg.png', 'EG', 1, 1, '27', '30', '2022-10-24 06:29:27', '2023-10-21 23:40:05'),
(68, 'Chile', NULL, 'https://flagcdn.com/w320/cl.png', 'CL', 1, 1, '-30', '-71', '2023-04-14 23:35:22', '2023-10-21 23:34:33');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive,1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Order Management', 0, '2023-08-27 01:44:10', '2023-08-27 03:42:50'),
(2, 'Project Management', 1, '2023-08-27 01:49:45', '2023-08-27 03:44:07'),
(3, 'Account Management', 1, '2023-08-27 01:50:59', '2023-08-27 01:50:59'),
(7, 'Payment Management', 1, '2023-08-27 03:44:23', '2023-08-27 03:44:23');

-- --------------------------------------------------------

--
-- Table structure for table `experience_levels`
--

CREATE TABLE `experience_levels` (
  `id` bigint UNSIGNED NOT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experience_levels`
--

INSERT INTO `experience_levels` (`id`, `level`, `status`, `created_at`, `updated_at`) VALUES
(1, 'junior', 1, '2024-09-18 02:43:31', '2024-09-18 02:43:31'),
(2, 'MidLevel', 1, '2024-09-18 02:44:04', '2024-09-18 02:44:04'),
(3, 'Senior', 1, '2024-09-18 02:44:12', '2024-09-18 03:41:49'),
(6, 'Not Mandatory', 1, '2024-09-18 04:20:43', '2024-09-18 05:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=active 1=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `title`, `description`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 'Outstanding Platform', 'I am working on Freelancer Platform since 2018 and I was amazed by the outcomes I got in my life Thanks to them for freeing me from 9-5 Now I can proudly say it is a outstanding platform.', 5, 1, '2023-10-30 04:20:41', '2024-02-17 22:17:29'),
(2, 3, 'Useful Platform', 'I am working on Freelancer Platform since 2018 and I was amazed by the outcomes I got in my life Thanks to them for freeing me from 9-5 Now I can proudly say it is a outstanding platform. for all the task and flow and supports.', 5, 1, '2023-10-30 04:20:41', '2024-02-17 22:17:40'),
(3, 4, 'I found best ever clients', 'I am working on Freelancer Platform since 2018 and I was amazed by the outcomes I got in my life Thanks to them for freeing me from 9-5 Now I can proudly say it is a outstanding platform.', 2, 1, '2023-10-30 04:20:41', '2024-01-15 03:09:27'),
(4, 5, 'Friendly support', 'I am working on Freelancer Platform since 2018 and I was amazed by the outcomes I got in my life Thanks to them for freeing me from 9-5 Now I can proudly say it is a outstanding platform', 1, 1, '2023-10-30 04:20:41', '2024-01-15 03:09:39'),
(5, 5, 'Outstanding platform', 'I am working on Freelancer Platform since 2018 and I was amazed by the outcomes I got in my life Thanks to them for freeing me from 9-5 Now I can proudly say it is a outstanding platform', 5, 0, '2023-10-30 04:20:41', '2024-02-17 22:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `form_builders`
--

CREATE TABLE `form_builders` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `success_message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_builders`
--

INSERT INTO `form_builders` (`id`, `title`, `email`, `button_text`, `fields`, `success_message`, `created_at`, `updated_at`) VALUES
(1, 'Contact Form', 'contact@xilancer.com', 'Submit', '{\"success_message\":\"Your Message Successfully Send.\",\"field_type\":[\"text\",\"email\",\"tel\",\"textarea\"],\"field_name\":[\"your-name\",\"your-email\",\"your-phone\",\"your-message\"],\"field_placeholder\":[\"Your Name\",\"Your Email\",\"Your Phone\",\"Your Message\"],\"field_required\":[\"on\",\"on\"]}', 'Your Message Successfully Send.', '2022-12-29 04:52:45', '2023-12-17 23:18:48'),
(6, 'Test Form', 'test@filancer.com', 'Test', '{\"success_message\":\"Test\",\"field_type\":[\"text\"],\"field_name\":[\"your-name\"],\"field_placeholder\":[\"Your Name\"]}', 'Test', '2022-12-29 05:53:05', '2023-01-01 06:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_levels`
--

CREATE TABLE `freelancer_levels` (
  `id` bigint UNSIGNED NOT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `freelancer_levels`
--

INSERT INTO `freelancer_levels` (`id`, `level`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Rated Plus', 1, '133', '2023-12-23 16:57:22', '2024-05-22 00:25:11'),
(2, 'Top Rated', 1, '132', '2023-12-23 16:59:15', '2024-01-02 23:50:23'),
(3, 'Rising Talent', 1, '131', '2023-12-23 16:59:32', '2024-01-03 17:19:01'),
(4, 'initail', 1, '129', '2024-03-03 23:51:19', '2024-07-29 22:11:54');

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_level_rules`
--

CREATE TABLE `freelancer_level_rules` (
  `id` bigint UNSIGNED NOT NULL,
  `freelancer_level_id` bigint NOT NULL,
  `period` int NOT NULL,
  `avg_rating` double NOT NULL,
  `earning` double NOT NULL,
  `complete_order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `freelancer_level_rules`
--

INSERT INTO `freelancer_level_rules` (`id`, `freelancer_level_id`, `period`, `avg_rating`, `earning`, `complete_order`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 4.5, 200, 3, '2023-12-30 01:13:18', '2024-05-22 00:00:37'),
(2, 2, 9, 4, 500, 5, '2024-01-01 19:05:18', '2024-05-22 00:01:16'),
(3, 1, 12, 4, 60, 1, '2024-01-01 20:59:09', '2024-05-22 00:50:41'),
(4, 4, 1, 5, 50000, 200, '2024-03-03 23:51:47', '2024-03-03 23:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_notifications`
--

CREATE TABLE `freelancer_notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `identity` bigint NOT NULL,
  `freelancer_id` bigint NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `identity_verifications`
--

CREATE TABLE `identity_verifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `verify_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint NOT NULL,
  `state_id` bigint NOT NULL,
  `city_id` bigint NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `national_id_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `front_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `back_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint DEFAULT NULL COMMENT '1=verified, 2=rejected',
  `is_read` tinyint NOT NULL DEFAULT '0' COMMENT '1=read and 0=unread',
  `load_from` int NOT NULL DEFAULT '0',
  `is_synced` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `individual_commission_settings`
--

CREATE TABLE `individual_commission_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `admin_commission_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_commission_charge` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `individual_commission_settings`
--

INSERT INTO `individual_commission_settings` (`id`, `user_id`, `admin_commission_type`, `admin_commission_charge`, `created_at`, `updated_at`) VALUES
(1, 7, 'percentage', 10, '2023-07-11 06:32:57', '2023-07-11 06:32:57'),
(2, 85, 'percentage', 45, '2024-05-21 00:59:36', '2024-05-21 00:59:36');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(14, 'default', '{\"uuid\":\"26820340-7b5c-490c-9e28-803ec1d3ad68\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:46:\\\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\\":5:{s:57:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000client_id\\\";i:1;s:61:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:412;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:2:{i:0;s:6:\\\"client\\\";i:1;s:10:\\\"freelancer\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:1027:\\\"<div class=\\\"chat-wrapper-details-inner-chat chat-reply\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                 <a href=\\\"https:\\/\\/xilancer.test\\/freelancer\\/profile-details\\/freelancer\\\" target=\\\"_blank\\\">\\r\\n                                            <img src=\\\"https:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712222749-660e721ddbe7b.jpg\\\" alt=\\\"\\\">\\r\\n                                    <\\/a>\\r\\n            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents\\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para\\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">sd sdf<\\/span>\\r\\n                                                        <\\/p>\\r\\n\\r\\n\\r\\n                                    <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713769922, 1713769922),
(15, 'default', '{\"uuid\":\"6d0022c1-defa-48c4-b4ee-b3b164456f5e\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:46:\\\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\\":5:{s:57:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000client_id\\\";i:1;s:61:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:413;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:2:{i:0;s:6:\\\"client\\\";i:1;s:10:\\\"freelancer\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:1033:\\\"<div class=\\\"chat-wrapper-details-inner-chat chat-reply\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                 <a href=\\\"https:\\/\\/xilancer.test\\/freelancer\\/profile-details\\/freelancer\\\" target=\\\"_blank\\\">\\r\\n                                            <img src=\\\"https:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712222749-660e721ddbe7b.jpg\\\" alt=\\\"\\\">\\r\\n                                    <\\/a>\\r\\n            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents\\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para\\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">sd sd fsdf f<\\/span>\\r\\n                                                        <\\/p>\\r\\n\\r\\n\\r\\n                                    <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713769936, 1713769936),
(16, 'default', '{\"uuid\":\"1d83ca04-8177-47c3-b284-697955cc60a9\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:46:\\\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\\":5:{s:57:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000client_id\\\";i:2;s:61:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:414;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:28;s:9:\\\"relations\\\";a:2:{i:0;s:6:\\\"client\\\";i:1;s:10:\\\"freelancer\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:1035:\\\"<div class=\\\"chat-wrapper-details-inner-chat chat-reply\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                 <a href=\\\"https:\\/\\/xilancer.test\\/freelancer\\/profile-details\\/freelancer\\\" target=\\\"_blank\\\">\\r\\n                                            <img src=\\\"https:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712222749-660e721ddbe7b.jpg\\\" alt=\\\"\\\">\\r\\n                                    <\\/a>\\r\\n            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents\\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para\\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">sd dsf sdf sdf<\\/span>\\r\\n                                                        <\\/p>\\r\\n\\r\\n\\r\\n                                    <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713769959, 1713769959),
(17, 'default', '{\"uuid\":\"c78c4cf9-833a-4a0f-be2f-2f5343697a8b\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:46:\\\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\\":5:{s:57:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000client_id\\\";i:1;s:61:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:415;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:2:{i:0;s:6:\\\"client\\\";i:1;s:10:\\\"freelancer\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:1032:\\\"<div class=\\\"chat-wrapper-details-inner-chat chat-reply\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                 <a href=\\\"https:\\/\\/xilancer.test\\/freelancer\\/profile-details\\/freelancer\\\" target=\\\"_blank\\\">\\r\\n                                            <img src=\\\"https:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712222749-660e721ddbe7b.jpg\\\" alt=\\\"\\\">\\r\\n                                    <\\/a>\\r\\n            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents\\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para\\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">sdfsd ff sf<\\/span>\\r\\n                                                        <\\/p>\\r\\n\\r\\n\\r\\n                                    <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770063, 1713770063),
(18, 'default', '{\"uuid\":\"69061b71-b3ad-4c36-b69c-64a2799efd06\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:46:\\\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\\":5:{s:57:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000client_id\\\";i:1;s:61:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:416;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:2:{i:0;s:6:\\\"client\\\";i:1;s:10:\\\"freelancer\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:1030:\\\"<div class=\\\"chat-wrapper-details-inner-chat chat-reply\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                 <a href=\\\"http:\\/\\/xilancer.test\\/freelancer\\/profile-details\\/freelancer\\\" target=\\\"_blank\\\">\\r\\n                                            <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712222749-660e721ddbe7b.jpg\\\" alt=\\\"\\\">\\r\\n                                    <\\/a>\\r\\n            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents\\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para\\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">dsf sdf sdf<\\/span>\\r\\n                                                        <\\/p>\\r\\n\\r\\n\\r\\n                                    <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770108, 1713770108),
(19, 'default', '{\"uuid\":\"a6047847-2d68-4b31-808e-291822ce2c10\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:46:\\\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\\":5:{s:57:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000client_id\\\";i:1;s:61:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:417;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:2:{i:0;s:6:\\\"client\\\";i:1;s:10:\\\"freelancer\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:1030:\\\"<div class=\\\"chat-wrapper-details-inner-chat chat-reply\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                 <a href=\\\"http:\\/\\/xilancer.test\\/freelancer\\/profile-details\\/freelancer\\\" target=\\\"_blank\\\">\\r\\n                                            <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712222749-660e721ddbe7b.jpg\\\" alt=\\\"\\\">\\r\\n                                    <\\/a>\\r\\n            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents\\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para\\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">dsf sdf sdf<\\/span>\\r\\n                                                        <\\/p>\\r\\n\\r\\n\\r\\n                                    <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770126, 1713770126),
(20, 'default', '{\"uuid\":\"dc3bf774-c23c-4858-a775-70010a2d794d\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:46:\\\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\\":5:{s:57:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000client_id\\\";i:1;s:61:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:418;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:2:{i:0;s:6:\\\"client\\\";i:1;s:10:\\\"freelancer\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:1028:\\\"<div class=\\\"chat-wrapper-details-inner-chat chat-reply\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                 <a href=\\\"http:\\/\\/xilancer.test\\/freelancer\\/profile-details\\/freelancer\\\" target=\\\"_blank\\\">\\r\\n                                            <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712222749-660e721ddbe7b.jpg\\\" alt=\\\"\\\">\\r\\n                                    <\\/a>\\r\\n            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents\\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para\\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">sd fsdf s<\\/span>\\r\\n                                                        <\\/p>\\r\\n\\r\\n\\r\\n                                    <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770169, 1713770169),
(21, 'default', '{\"uuid\":\"26f11ddd-3c21-4e2c-897d-84ab96f70d57\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":2:{s:8:\\\"\\u0000*\\u0000email\\\";s:17:\\\"tclient@gmail.com\\\";s:10:\\\"\\u0000*\\u0000message\\\";s:9:\\\"sd fsdf s\\\";}\"}}', 0, NULL, 1713770169, 1713770169),
(22, 'default', '{\"uuid\":\"9995a506-64c5-4686-ae58-91ab0e7beb3d\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:46:\\\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\\":5:{s:57:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000client_id\\\";i:1;s:61:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:419;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:2:{i:0;s:6:\\\"client\\\";i:1;s:10:\\\"freelancer\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:1030:\\\"<div class=\\\"chat-wrapper-details-inner-chat chat-reply\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                 <a href=\\\"http:\\/\\/xilancer.test\\/freelancer\\/profile-details\\/freelancer\\\" target=\\\"_blank\\\">\\r\\n                                            <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712222749-660e721ddbe7b.jpg\\\" alt=\\\"\\\">\\r\\n                                    <\\/a>\\r\\n            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents\\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para\\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">sdf sdf sdf<\\/span>\\r\\n                                                        <\\/p>\\r\\n\\r\\n\\r\\n                                    <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770183, 1713770183),
(23, 'default', '{\"uuid\":\"90f3df9f-9422-471b-a483-bf7f7d1a2da4\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":2:{s:8:\\\"\\u0000*\\u0000email\\\";s:17:\\\"tclient@gmail.com\\\";s:10:\\\"\\u0000*\\u0000message\\\";s:11:\\\"sdf sdf sdf\\\";}\"}}', 0, NULL, 1713770183, 1713770183),
(24, 'default', '{\"uuid\":\"6fce4305-b5c3-4081-bfb6-9342435ef724\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:44:\\\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\\":5:{s:55:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000client_id\\\";i:1;s:59:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:420;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:874:\\\"<div class=\\\"chat-wrapper-details-inner-chat\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                                    <img src=\\\"https:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712223133-660e739ddff66.jpg\\\" alt=\\\"\\\">\\r\\n                            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents \\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para \\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">dfg dfg<\\/span>\\r\\n                                                        <\\/p>\\r\\n                                <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770192, 1713770192),
(25, 'default', '{\"uuid\":\"194b9e06-2fea-48ff-b75d-f0e90a203f57\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:44:\\\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\\":5:{s:55:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000client_id\\\";i:1;s:59:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:421;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:872:\\\"<div class=\\\"chat-wrapper-details-inner-chat\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                                    <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712223133-660e739ddff66.jpg\\\" alt=\\\"\\\">\\r\\n                            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents \\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para \\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">sd sdf<\\/span>\\r\\n                                                        <\\/p>\\r\\n                                <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770298, 1713770298),
(26, 'default', '{\"uuid\":\"1cdf234f-eaab-4daa-a220-7ae3cb6a9d5c\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:46:\\\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\\":5:{s:57:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000client_id\\\";i:1;s:61:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:422;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:2:{i:0;s:6:\\\"client\\\";i:1;s:10:\\\"freelancer\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:1028:\\\"<div class=\\\"chat-wrapper-details-inner-chat chat-reply\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                 <a href=\\\"http:\\/\\/xilancer.test\\/freelancer\\/profile-details\\/freelancer\\\" target=\\\"_blank\\\">\\r\\n                                            <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712222749-660e721ddbe7b.jpg\\\" alt=\\\"\\\">\\r\\n                                    <\\/a>\\r\\n            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents\\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para\\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">fsadf sdf<\\/span>\\r\\n                                                        <\\/p>\\r\\n\\r\\n\\r\\n                                    <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770312, 1713770312),
(27, 'default', '{\"uuid\":\"ee0708cf-ad28-48e8-9999-e1e202a1feae\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:44:\\\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\\":5:{s:55:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000client_id\\\";i:1;s:59:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:423;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:868:\\\"<div class=\\\"chat-wrapper-details-inner-chat\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                                    <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712223133-660e739ddff66.jpg\\\" alt=\\\"\\\">\\r\\n                            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents \\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para \\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">ok<\\/span>\\r\\n                                                        <\\/p>\\r\\n                                <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770347, 1713770347),
(28, 'default', '{\"uuid\":\"7e446d6c-5114-41f5-8e65-0739fc5cfda9\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:44:\\\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\\":5:{s:55:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000client_id\\\";i:1;s:59:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:424;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:869:\\\"<div class=\\\"chat-wrapper-details-inner-chat\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                                    <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712223133-660e739ddff66.jpg\\\" alt=\\\"\\\">\\r\\n                            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents \\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para \\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">ok2<\\/span>\\r\\n                                                        <\\/p>\\r\\n                                <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770380, 1713770380),
(29, 'default', '{\"uuid\":\"3a62c398-58a5-49f5-882b-6292561479f8\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:46:\\\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\\":5:{s:57:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000client_id\\\";i:1;s:61:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:425;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:2:{i:0;s:6:\\\"client\\\";i:1;s:10:\\\"freelancer\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:1022:\\\"<div class=\\\"chat-wrapper-details-inner-chat chat-reply\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                 <a href=\\\"http:\\/\\/xilancer.test\\/freelancer\\/profile-details\\/freelancer\\\" target=\\\"_blank\\\">\\r\\n                                            <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712222749-660e721ddbe7b.jpg\\\" alt=\\\"\\\">\\r\\n                                    <\\/a>\\r\\n            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents\\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para\\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">lol<\\/span>\\r\\n                                                        <\\/p>\\r\\n\\r\\n\\r\\n                                    <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770464, 1713770464),
(30, 'default', '{\"uuid\":\"7073be4d-33ec-4211-8ab5-f551abf72aa8\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:44:\\\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\\":5:{s:55:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000client_id\\\";i:1;s:59:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:426;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:874:\\\"<div class=\\\"chat-wrapper-details-inner-chat\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                                    <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712223133-660e739ddff66.jpg\\\" alt=\\\"\\\">\\r\\n                            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents \\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para \\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">dfds sdf<\\/span>\\r\\n                                                        <\\/p>\\r\\n                                <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770502, 1713770502),
(31, 'default', '{\"uuid\":\"75a9e2ca-7d78-4479-a2c9-1557a5bce7e2\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:44:\\\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\\":5:{s:55:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000client_id\\\";i:1;s:59:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:427;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:876:\\\"<div class=\\\"chat-wrapper-details-inner-chat\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                                    <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712223133-660e739ddff66.jpg\\\" alt=\\\"\\\">\\r\\n                            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents \\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para \\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">sd sdf sdf<\\/span>\\r\\n                                                        <\\/p>\\r\\n                                <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770554, 1713770554);
INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(32, 'default', '{\"uuid\":\"8b650bd7-21a7-4daf-a5ce-62e50f3b22c9\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:44:\\\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\\":5:{s:55:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000client_id\\\";i:1;s:59:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:428;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:870:\\\"<div class=\\\"chat-wrapper-details-inner-chat\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                                    <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712223133-660e739ddff66.jpg\\\" alt=\\\"\\\">\\r\\n                            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents \\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para \\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">8898<\\/span>\\r\\n                                                        <\\/p>\\r\\n                                <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770563, 1713770563),
(33, 'default', '{\"uuid\":\"b29cba66-15bf-4b6c-ac16-66aeb9d1c499\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:46:\\\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\\":5:{s:57:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000client_id\\\";i:1;s:61:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:429;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:2:{i:0;s:6:\\\"client\\\";i:1;s:10:\\\"freelancer\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:1032:\\\"<div class=\\\"chat-wrapper-details-inner-chat chat-reply\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                 <a href=\\\"https:\\/\\/xilancer.test\\/freelancer\\/profile-details\\/freelancer\\\" target=\\\"_blank\\\">\\r\\n                                            <img src=\\\"https:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712222749-660e721ddbe7b.jpg\\\" alt=\\\"\\\">\\r\\n                                    <\\/a>\\r\\n            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents\\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para\\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">sdf sdf sdf<\\/span>\\r\\n                                                        <\\/p>\\r\\n\\r\\n\\r\\n                                    <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770615, 1713770615),
(34, 'default', '{\"uuid\":\"551d1b9d-3701-48e1-a7e2-b517b5397224\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:44:\\\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\\":5:{s:55:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000client_id\\\";i:1;s:59:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:430;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:874:\\\"<div class=\\\"chat-wrapper-details-inner-chat\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                                    <img src=\\\"https:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712223133-660e739ddff66.jpg\\\" alt=\\\"\\\">\\r\\n                            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents \\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para \\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">sd fsdf<\\/span>\\r\\n                                                        <\\/p>\\r\\n                                <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770650, 1713770650),
(35, 'default', '{\"uuid\":\"99188e31-ba51-4880-a39a-4bdd99af18bd\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:44:\\\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\\":5:{s:55:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000client_id\\\";i:1;s:59:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:431;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:870:\\\"<div class=\\\"chat-wrapper-details-inner-chat\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                                    <img src=\\\"https:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712223133-660e739ddff66.jpg\\\" alt=\\\"\\\">\\r\\n                            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents \\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para \\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">890<\\/span>\\r\\n                                                        <\\/p>\\r\\n                                <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770656, 1713770656),
(36, 'default', '{\"uuid\":\"805d1f95-6973-4f76-b012-18f5382ebac1\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:46:\\\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\\":5:{s:57:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000client_id\\\";i:1;s:61:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:432;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:2:{i:0;s:6:\\\"client\\\";i:1;s:10:\\\"freelancer\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:1024:\\\"<div class=\\\"chat-wrapper-details-inner-chat chat-reply\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                 <a href=\\\"https:\\/\\/xilancer.test\\/freelancer\\/profile-details\\/freelancer\\\" target=\\\"_blank\\\">\\r\\n                                            <img src=\\\"https:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712222749-660e721ddbe7b.jpg\\\" alt=\\\"\\\">\\r\\n                                    <\\/a>\\r\\n            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents\\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para\\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">890<\\/span>\\r\\n                                                        <\\/p>\\r\\n\\r\\n\\r\\n                                    <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770670, 1713770670),
(37, 'default', '{\"uuid\":\"517a14c8-31d1-4628-bfcf-fd5dea2e5e1c\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:46:\\\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\\":5:{s:57:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000client_id\\\";i:1;s:61:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:433;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:2:{i:0;s:6:\\\"client\\\";i:1;s:10:\\\"freelancer\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:1025:\\\"<div class=\\\"chat-wrapper-details-inner-chat chat-reply\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                 <a href=\\\"https:\\/\\/xilancer.test\\/freelancer\\/profile-details\\/freelancer\\\" target=\\\"_blank\\\">\\r\\n                                            <img src=\\\"https:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712222749-660e721ddbe7b.jpg\\\" alt=\\\"\\\">\\r\\n                                    <\\/a>\\r\\n            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents\\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para\\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">0000<\\/span>\\r\\n                                                        <\\/p>\\r\\n\\r\\n\\r\\n                                    <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770676, 1713770676),
(38, 'default', '{\"uuid\":\"ab6fb5bf-561b-432b-98d0-1dc275207c14\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:44:\\\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\\":5:{s:55:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000client_id\\\";i:1;s:59:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:434;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:873:\\\"<div class=\\\"chat-wrapper-details-inner-chat\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                                    <img src=\\\"https:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712223133-660e739ddff66.jpg\\\" alt=\\\"\\\">\\r\\n                            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents \\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para \\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">nazmil<\\/span>\\r\\n                                                        <\\/p>\\r\\n                                <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770749, 1713770749),
(39, 'default', '{\"uuid\":\"75fb208e-eab1-4c8a-8b23-6227397008ce\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:46:\\\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\\":5:{s:57:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000client_id\\\";i:1;s:61:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:435;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:2:{i:0;s:6:\\\"client\\\";i:1;s:10:\\\"freelancer\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:1024:\\\"<div class=\\\"chat-wrapper-details-inner-chat chat-reply\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                 <a href=\\\"https:\\/\\/xilancer.test\\/freelancer\\/profile-details\\/freelancer\\\" target=\\\"_blank\\\">\\r\\n                                            <img src=\\\"https:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712222749-660e721ddbe7b.jpg\\\" alt=\\\"\\\">\\r\\n                                    <\\/a>\\r\\n            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents\\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para\\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">789<\\/span>\\r\\n                                                        <\\/p>\\r\\n\\r\\n\\r\\n                                    <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770769, 1713770769),
(40, 'default', '{\"uuid\":\"a4dc2efa-2fa0-4a66-aebd-0a7271469737\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:44:\\\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\\":5:{s:55:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000client_id\\\";i:1;s:59:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:436;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:870:\\\"<div class=\\\"chat-wrapper-details-inner-chat\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                                    <img src=\\\"https:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712223133-660e739ddff66.jpg\\\" alt=\\\"\\\">\\r\\n                            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents \\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para \\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">123<\\/span>\\r\\n                                                        <\\/p>\\r\\n                                <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770783, 1713770783),
(41, 'default', '{\"uuid\":\"37371e1b-ad6c-45ac-87bf-d132c1a8a980\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:44:\\\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\\":5:{s:55:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000client_id\\\";i:1;s:59:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:437;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:871:\\\"<div class=\\\"chat-wrapper-details-inner-chat\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                                    <img src=\\\"https:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712223133-660e739ddff66.jpg\\\" alt=\\\"\\\">\\r\\n                            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents \\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para \\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">4545<\\/span>\\r\\n                                                        <\\/p>\\r\\n                                <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770824, 1713770824),
(42, 'default', '{\"uuid\":\"5bc1802b-be84-4cae-aae4-df75165fa760\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:46:\\\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\\":5:{s:57:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000client_id\\\";i:1;s:61:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:438;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:2:{i:0;s:6:\\\"client\\\";i:1;s:10:\\\"freelancer\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:1023:\\\"<div class=\\\"chat-wrapper-details-inner-chat chat-reply\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                 <a href=\\\"https:\\/\\/xilancer.test\\/freelancer\\/profile-details\\/freelancer\\\" target=\\\"_blank\\\">\\r\\n                                            <img src=\\\"https:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712222749-660e721ddbe7b.jpg\\\" alt=\\\"\\\">\\r\\n                                    <\\/a>\\r\\n            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents\\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para\\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">45<\\/span>\\r\\n                                                        <\\/p>\\r\\n\\r\\n\\r\\n                                    <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770836, 1713770836),
(43, 'default', '{\"uuid\":\"64dec059-c02f-47cd-8144-dd8eceae998b\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:46:\\\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\\":5:{s:57:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000client_id\\\";i:1;s:61:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:439;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:2:{i:0;s:6:\\\"client\\\";i:1;s:10:\\\"freelancer\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:1030:\\\"<div class=\\\"chat-wrapper-details-inner-chat chat-reply\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                 <a href=\\\"http:\\/\\/xilancer.test\\/freelancer\\/profile-details\\/freelancer\\\" target=\\\"_blank\\\">\\r\\n                                            <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712222749-660e721ddbe7b.jpg\\\" alt=\\\"\\\">\\r\\n                                    <\\/a>\\r\\n            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents\\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para\\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">fdg dgf dfg<\\/span>\\r\\n                                                        <\\/p>\\r\\n\\r\\n\\r\\n                                    <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713770987, 1713770987),
(44, 'default', '{\"uuid\":\"dc12b9ac-6a72-405a-a913-d6cd7189895d\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:44:\\\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\\":5:{s:55:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000client_id\\\";i:1;s:59:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:440;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:871:\\\"<div class=\\\"chat-wrapper-details-inner-chat\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                                    <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712223133-660e739ddff66.jpg\\\" alt=\\\"\\\">\\r\\n                            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents \\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para \\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">55656<\\/span>\\r\\n                                                        <\\/p>\\r\\n                                <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713771010, 1713771010),
(45, 'default', '{\"uuid\":\"ac1065ad-af2b-4f4e-ad11-7464d39edbd5\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:44:\\\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\\":5:{s:55:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000client_id\\\";i:1;s:59:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:441;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:869:\\\"<div class=\\\"chat-wrapper-details-inner-chat\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                                    <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712223133-660e739ddff66.jpg\\\" alt=\\\"\\\">\\r\\n                            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents \\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para \\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">fdg<\\/span>\\r\\n                                                        <\\/p>\\r\\n                                <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713771038, 1713771038),
(46, 'default', '{\"uuid\":\"63cfc517-0fab-40c5-b86b-09233e5257cb\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:46:\\\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\\":5:{s:57:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000client_id\\\";i:1;s:61:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:442;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:2:{i:0;s:6:\\\"client\\\";i:1;s:10:\\\"freelancer\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:1028:\\\"<div class=\\\"chat-wrapper-details-inner-chat chat-reply\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                 <a href=\\\"http:\\/\\/xilancer.test\\/freelancer\\/profile-details\\/freelancer\\\" target=\\\"_blank\\\">\\r\\n                                            <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712222749-660e721ddbe7b.jpg\\\" alt=\\\"\\\">\\r\\n                                    <\\/a>\\r\\n            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents\\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para\\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">df gdfg d<\\/span>\\r\\n                                                        <\\/p>\\r\\n\\r\\n\\r\\n                                    <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713771076, 1713771076),
(47, 'default', '{\"uuid\":\"af06de6b-407e-4c41-9aec-4213c088dfd8\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:46:\\\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\\":5:{s:57:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000client_id\\\";i:1;s:61:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:443;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:2:{i:0;s:6:\\\"client\\\";i:1;s:10:\\\"freelancer\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:1023:\\\"<div class=\\\"chat-wrapper-details-inner-chat chat-reply\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                 <a href=\\\"http:\\/\\/xilancer.test\\/freelancer\\/profile-details\\/freelancer\\\" target=\\\"_blank\\\">\\r\\n                                            <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712222749-660e721ddbe7b.jpg\\\" alt=\\\"\\\">\\r\\n                                    <\\/a>\\r\\n            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents\\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para\\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">....<\\/span>\\r\\n                                                        <\\/p>\\r\\n\\r\\n\\r\\n                                    <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713771164, 1713771164);
INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(48, 'default', '{\"uuid\":\"73614fd5-662b-4528-927c-d5f6ab6ed1f0\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:44:\\\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\\":5:{s:55:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000client_id\\\";i:1;s:59:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:444;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:881:\\\"<div class=\\\"chat-wrapper-details-inner-chat\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                                    <img src=\\\"http:\\/\\/localhost\\/xilancer\\/assets\\/uploads\\/profile\\/1712223133-660e739ddff66.jpg\\\" alt=\\\"\\\">\\r\\n                            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents \\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para \\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">how we2226<\\/span>\\r\\n                                                        <\\/p>\\r\\n                                <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713771402, 1713771402),
(49, 'default', '{\"uuid\":\"921746dc-d01f-4642-afbd-14ceca17cf72\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:44:\\\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\\":5:{s:55:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000client_id\\\";i:1;s:59:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000freelancer_id\\\";i:8;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:452;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:26;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:878:\\\"<div class=\\\"chat-wrapper-details-inner-chat\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                                    <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712223133-660e739ddff66.jpg\\\" alt=\\\"\\\">\\r\\n                            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents \\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para \\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">df dfg dg gf<\\/span>\\r\\n                                                        <\\/p>\\r\\n                                <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713772297, 1713772297),
(50, 'default', '{\"uuid\":\"a9ec7dbc-7973-4675-8ff1-8f58dbfe96c3\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":2:{s:8:\\\"\\u0000*\\u0000email\\\";s:14:\\\"riad@gmail.com\\\";s:10:\\\"\\u0000*\\u0000message\\\";s:12:\\\"df dfg dg gf\\\";}\"}}', 0, NULL, 1713772297, 1713772297),
(51, 'default', '{\"uuid\":\"fc8e7878-8f76-47de-a161-2cdb4bd1e37b\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:44:\\\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\\":5:{s:55:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000client_id\\\";i:1;s:59:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000freelancer_id\\\";i:8;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:453;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:26;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:870:\\\"<div class=\\\"chat-wrapper-details-inner-chat\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                                    <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712223133-660e739ddff66.jpg\\\" alt=\\\"\\\">\\r\\n                            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents \\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para \\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">9090<\\/span>\\r\\n                                                        <\\/p>\\r\\n                                <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713772374, 1713772374),
(52, 'default', '{\"uuid\":\"ec7b42c3-c480-4b90-95b6-d8865adb3c63\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":2:{s:8:\\\"\\u0000*\\u0000email\\\";s:14:\\\"riad@gmail.com\\\";s:10:\\\"\\u0000*\\u0000message\\\";s:4:\\\"9090\\\";}\"}}', 0, NULL, 1713772374, 1713772374),
(53, 'default', '{\"uuid\":\"eadb64bd-587a-43dc-aa64-f0c447d3f636\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:44:\\\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\\":5:{s:55:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000client_id\\\";i:1;s:59:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000freelancer_id\\\";i:8;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:454;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:26;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:870:\\\"<div class=\\\"chat-wrapper-details-inner-chat\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                                    <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712223133-660e739ddff66.jpg\\\" alt=\\\"\\\">\\r\\n                            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents \\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para \\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">8080<\\/span>\\r\\n                                                        <\\/p>\\r\\n                                <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713772445, 1713772445),
(54, 'default', '{\"uuid\":\"05e10312-bd61-41f5-a7f0-9e7a124d8402\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":2:{s:8:\\\"\\u0000*\\u0000email\\\";s:14:\\\"riad@gmail.com\\\";s:10:\\\"\\u0000*\\u0000message\\\";s:4:\\\"8080\\\";}\"}}', 0, NULL, 1713772445, 1713772445),
(55, 'default', '{\"uuid\":\"078761e9-fb9c-47e6-93c1-3ddf743fe99d\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:44:\\\"Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\\":5:{s:55:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000client_id\\\";i:1;s:59:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatUserMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:455;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:1:{i:0;s:6:\\\"client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:868:\\\"<div class=\\\"chat-wrapper-details-inner-chat\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                                    <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712223133-660e739ddff66.jpg\\\" alt=\\\"\\\">\\r\\n                            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents \\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para \\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">90<\\/span>\\r\\n                                                        <\\/p>\\r\\n                                <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713772500, 1713772500),
(56, 'default', '{\"uuid\":\"668ee004-dfb6-4bd7-8f90-f6b939b18074\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":2:{s:8:\\\"\\u0000*\\u0000email\\\";s:21:\\\"tfreelancer@gmail.com\\\";s:10:\\\"\\u0000*\\u0000message\\\";s:2:\\\"90\\\";}\"}}', 0, NULL, 1713772500, 1713772500),
(57, 'default', '{\"uuid\":\"b5e3d4e6-14dc-4d2a-b13b-b3f7385bebb9\",\"displayName\":\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":13:{s:5:\\\"event\\\";O:46:\\\"Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\\":5:{s:57:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000client_id\\\";i:1;s:61:\\\"\\u0000Modules\\\\Chat\\\\Events\\\\LivechatVendorMessageEvent\\u0000freelancer_id\\\";i:7;s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:37:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChatMessage\\\";s:2:\\\"id\\\";i:456;s:9:\\\"relations\\\";a:3:{i:0;s:8:\\\"liveChat\\\";i:1;s:19:\\\"liveChat.freelancer\\\";i:2;s:15:\\\"liveChat.client\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"livechat\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:30:\\\"Modules\\\\Chat\\\\Entities\\\\LiveChat\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:2:{i:0;s:6:\\\"client\\\";i:1;s:10:\\\"freelancer\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"messageBlade\\\";s:1023:\\\"<div class=\\\"chat-wrapper-details-inner-chat chat-reply\\\">\\r\\n        <div class=\\\"chat-wrapper-details-inner-chat-flex\\\">\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-thumb\\\">\\r\\n                 <a href=\\\"http:\\/\\/xilancer.test\\/freelancer\\/profile-details\\/freelancer\\\" target=\\\"_blank\\\">\\r\\n                                            <img src=\\\"http:\\/\\/xilancer.test\\/assets\\/uploads\\/profile\\/1712222749-660e721ddbe7b.jpg\\\" alt=\\\"\\\">\\r\\n                                    <\\/a>\\r\\n            <\\/div>\\r\\n            <div class=\\\"chat-wrapper-details-inner-chat-contents\\\">\\r\\n                <p class=\\\"chat-wrapper-details-inner-chat-contents-para\\\">\\r\\n                                        <span class=\\\"chat-wrapper-details-inner-chat-contents-para-span\\\">0000<\\/span>\\r\\n                                                        <\\/p>\\r\\n\\r\\n\\r\\n                                    <span class=\\\"chat-wrapper-details-inner-chat-contents-time mt-2\\\">\\r\\n                    1 second ago\\r\\n                <\\/span>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1713772514, 1713772514);

-- --------------------------------------------------------

--
-- Table structure for table `job_histories`
--

CREATE TABLE `job_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `job_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `reject_count` bigint DEFAULT NULL,
  `edit_count` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_posts`
--

CREATE TABLE `job_posts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` bigint NOT NULL,
  `duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hourly_rate` int DEFAULT NULL,
  `estimated_hours` int DEFAULT NULL,
  `budget` double NOT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=pending/inactivate, 1=approve/publish',
  `current_status` tinyint NOT NULL DEFAULT '0' COMMENT '0=nothing, 1=in progress, 2=complete, 3=cancel',
  `on_off` tinyint NOT NULL DEFAULT '1' COMMENT '1=on, 0=off',
  `job_approve_request` tinyint NOT NULL DEFAULT '0' COMMENT '0=request for approve, 1=approve, 2=decline, 2=will change to 0 when the user edit the project.',
  `last_seen` timestamp NULL DEFAULT NULL,
  `last_apply_date` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `load_from` int NOT NULL DEFAULT '0',
  `is_synced` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_posts`
--

INSERT INTO `job_posts` (`id`, `user_id`, `title`, `slug`, `category`, `duration`, `level`, `description`, `type`, `hourly_rate`, `estimated_hours`, `budget`, `attachment`, `status`, `current_status`, `on_off`, `job_approve_request`, `last_seen`, `last_apply_date`, `meta_title`, `meta_description`, `meta_tags`, `load_from`, `is_synced`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tech Influencer Needed to Review Our Brand New Smartwatch', 'tech-influencer-needed-to-review-our-brand-new-smartwatch', 11, 'less than a week', 'junior', '<p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">We are launching a next-gen smartwatch with health tracking and custom widgets. You’ll receive the product and are expected to create an unboxing video and a 5-minute tutorial or review on TikTok or YouTube.</p>', 'Onsite', NULL, NULL, 50, '1745820668-680f1bfc919ad.pdf', 1, 1, 1, 1, '2025-04-16 04:57:26', NULL, 'Smartwatch Campaign – Tech Reviewers Wanted', 'Create tech content around our smartwatch launch. Unbox, demo, and review.', NULL, 1, 1, '2023-04-16 17:51:16', '2025-07-08 11:39:20'),
(2, 113, 'Submit proposals for my parenting agency', 'submit-proposals-for-my-parenting-agency', 13, 'less than a week', 'junior', '<p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">Are you a parenting coach, family blogger, or selling products for moms, dads, or kids? I’ll feature your content on a high-traffic Pinterest account with over 10 million monthly viewers — where it stays permanently.</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">This is perfect for parenting tips, family-friendly products, educational tools, kids’ activities, baby gear, and more.</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">With 13+ years of Pinterest experience and a proven strategy I use for my own successful shops, I’ll give your content the organic, ongoing exposure it needs to thrive.</p>', 'Online', NULL, NULL, 50, '1745820364-680f1acc75885.pdf', 1, 0, 1, 1, '2025-04-16 04:57:27', NULL, 'Submit proposals for my parenting agency', 'Submit proposals for my parenting agency', NULL, 1, 1, '2023-04-16 21:19:42', '2025-04-28 00:07:39'),
(4, 114, 'Inspire wanderlust travel influencers wanted', 'full-time-preffessional-android-and-ios-app-developer', 4, 'less than 2 month', 'junior', '<p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">re you passionate about capturing breathtaking destinations, sharing hidden gems, and inspiring others to explore the world? 🌎✨ We’re searching for adventurous travel influencers ready to collaborate with top travel brands, resorts, tour companies, and experience platforms!</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">Whether you\'re a digital nomad, weekend explorer, luxury traveler, or van life enthusiast, this project invites you to create authentic, captivating travel content that sparks wanderlust across Instagram, TikTok, YouTube, or Pinterest.</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">Work with brands to promote dream locations, boutique hotels, travel gear, apps, and once-in-a-lifetime experiences!</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><br></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><b>✅ Features Included for Influencers:</b></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">📸 Sponsored Travel Content Opportunities – Showcase destinations, products, and services</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">✈️ Press Trip Invitations &amp; Brand Experiences – Get access to exclusive travel packages</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">🎥 Short-Form &amp; Long-Form Content Creation – From viral Reels to cinematic YouTube travel vlogs</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">📊 Real-Time Analytics Dashboard – Track your impact, reach, and brand engagement</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">💬 Direct Brand Communication – Collaborate easily with campaign coordinators</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">🔒 Secure Payment Processing – Guaranteed payouts after project completion</p>', 'Onsite', NULL, NULL, 500, '1699250918-654882e6bbf98.pdf', 1, 0, 1, 1, '2025-04-16 04:57:28', NULL, 'Inspire wanderlust travel influencers wanted', 'Inspire wanderlust travel influencers wanted', NULL, 1, 1, '2023-05-24 17:17:27', '2025-04-27 23:52:28'),
(5, 1, 'Promote our agency  the world with us travel influencer collaboration', 'promote-our-agency-the-world-with-us-travel-influencer-collaboration', 4, 'less than a week', 'junior', '<p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">About this project</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">Are you a passionate travel influencer eager to share captivating journeys and authentic experiences with your audience? Join our dynamic platform to connect with top travel brands seeking to showcase destinations through genuine storytelling and stunning visuals.​</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><br></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><b>What We Offer:</b></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">🤝 Seamless Collaboration: Partner with brands that align with your travel niche and audience demographics.</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">📈 Performance Analytics: Access real-time data on engagement, reach, and conversions to demonstrate your impact.</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">💼 Portfolio Showcase: Highlight your previous travel collaborations and adventures to attract potential brand partners.</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">💬 Direct Communication: Utilize our integrated messaging system for efficient coordination with brands.</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">💰 Secure Payments: Ensure timely and secure compensation for your creative efforts.​</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><br></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><b>Ideal Collaborators:</b></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">Travel influencers with a strong presence on platforms like Instagram, TikTok, or YouTube, who have an engaged following and a knack for creating compelling travel content.​</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><br></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><b>Join Us:</b></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">Become part of a community where your travel stories meet brand opportunities. Let\'s inspire wanderlust together.​</p>', 'Onsite', NULL, NULL, 500, '1685861166-647c332e48e81.pdf', 1, 2, 1, 1, '2025-04-16 04:57:20', NULL, 'Promote our agency  the world with us travel influencer collaboration', 'Promote our agency  the world with us travel influencer collaboration', NULL, 1, 1, '2023-06-03 18:46:06', '2025-04-27 23:48:06'),
(6, 2, 'Need influencer to Inspire wellness collaborate on personal growth & mindfulness campaigns', 'need-influencer-to-inspire-wellness-collaborate-on-personal-growth-amp-mindfulness-campaigns', 1, 'less than a month', 'junior', '<p><font color=\"#0e1724\">Do you promote a balanced life filled with self-love, mindfulness, and positive transformation? 🌞 Whether you\'re sharing motivational content, healthy routines, journaling tips, or mental health check-ins—your voice can spark growth.</font></p><p><br></p><p><font color=\"#0e1724\">This project invites wellness-focused influencers to collaborate with brands on campaigns that support emotional wellness, mental clarity, self-care routines, and personal development. Work with journals, supplement brands, meditation apps, coaches, and platforms that empower real change.</font></p><p><font color=\"#0e1724\"><br></font></p><p><font color=\"#0e1724\"><br></font></p><p><font color=\"#0e1724\"><br></font></p><p><font color=\"#0e1724\"><b>✅ Included Features:</b></font></p><p><font color=\"#0e1724\"><br></font></p><p><br></p><p><font color=\"#0e1724\">📸 Wellness &amp; Self-Care Visual Content</font></p><p><font color=\"#0e1724\">➤ Create authentic photo/video content showcasing morning routines, journaling, or meditation.</font></p><p><font color=\"#0e1724\">🧘 Reels &amp; Short Videos for Daily Wellness Tips</font></p><p><font color=\"#0e1724\">➤ Post calming, engaging wellness videos with inspiring voiceovers or affirmations.</font></p><p><font color=\"#0e1724\">📆 Weekly Content Calendar Planning</font></p><p><font color=\"#0e1724\">➤ Strategically post content aligned with seasons, wellness goals, and trending topics.</font></p><p><font color=\"#0e1724\">📊 Analytics Dashboard Access</font></p><p><font color=\"#0e1724\">➤ View real-time insights on engagement, reach, and saves for wellness posts.</font></p>', 'Online', NULL, NULL, 250, '1699249858-65487ec28b030.txt', 1, 0, 1, 1, '2025-04-16 04:57:18', NULL, 'Need influencer to Inspire wellness collaborate on personal growth & mindfulness campaigns', 'Need influencer to Inspire wellness collaborate on personal growth & mindfulness campaigns', NULL, 1, 1, '2023-06-05 17:13:55', '2025-04-27 23:38:29'),
(7, 1, 'I need a influencer to elevated lifestyle choices', 'i-need-a-influencer-to-elevated-lifestyle-choices', 1, 'less than 2 month', 'junior', '<p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">Hello, lovely people! I’m thrilled to offer you an exciting opportunity to transform your everyday life into something extraordinary. In this project, I’ll guide you through creating a well-rounded, intentional lifestyle that blends wellness, fashion, home decor, productivity, and self-care—everything you need to live your best life!</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><br></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\"><b>Key Features:</b></span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\"><b>Product Reviews &amp; Recommendations:</b> I’ll feature top wellness, fashion, and home decor products that I absolutely love and use in my own life. Expect honest, in-depth reviews to help you make informed choices!</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><b>Real-Life Integration:</b> You’ll see how these products and practices fit into my daily routine, whether it’s a new skincare routine, stylish wardrobe essentials, or home upgrades that make my space feel cozy and inspiring.</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\"><b>Exclusive Discounts &amp; Offers:</b> Get access to special deals and discounts for the featured products—because everyone deserves to treat themselves!</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><b>Engaging Content:</b> I’ll connect with you through Q&amp;A sessions, interactive polls, and live videos where we can chat about all things lifestyle and I can answer your burning questions.</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><b>Personalized Tips: </b>From fashion styling to home decor and wellness routines, I’ll be sharing personalized advice tailored to elevate your life and help you feel your best.</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><b>Collaborations with Trusted Brands: </b>I’ll partner with some of the best lifestyle brands out there to bring you top-quality products that enhance your everyday experiences.</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><br></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">If you’re looking for a way to elevate your lifestyle, get inspired, and discover new products that truly add value to your life, this is for you! Let’s work together to create a lifestyle that you love, full of positivity, balance, and beauty. 🌿✨</span></p>', 'Online', NULL, NULL, 200, '1745823837-680f285d7c6d3.pdf', 1, 0, 1, 1, '2025-08-06 16:29:08', NULL, 'I need a influencer to elevated lifestyle choices', 'I need a influencer to elevated lifestyle choices', NULL, 1, 1, '2023-09-11 06:45:09', '2025-08-06 16:29:08'),
(8, 2, 'Experience tech influencer  needed to promote our new mobile based tech brand', 'experience-tech-influencer-needed-to-promote-our-new-mobile-based-tech-brand', 11, 'less than a month', 'junior', '<h2 class=\"myJob-wrapper-single-title\"><font color=\"#62646a\" face=\"Manrope, sans-serif\"><span style=\"font-size: 16px; font-weight: normal;\">Want to get our&nbsp; tech product in front of a huge audience? You’ll showcase our gadget on my high-traffic Pinterest account, where it can be seen by over 10 million monthly viewers — and it stays there forever.</span></font></h2><h2 class=\"myJob-wrapper-single-title\"><font color=\"#62646a\" face=\"Manrope, sans-serif\"><span style=\"font-size: 16px; font-weight: normal;\"><br></span></font></h2><h2 class=\"myJob-wrapper-single-title\"><font color=\"#62646a\" face=\"Manrope, sans-serif\"><span style=\"font-size: 16px; font-weight: normal;\"><br></span></font><span style=\"font-size: 16px; color: rgb(98, 100, 106); font-family: Manrope, sans-serif; font-weight: 400; display: inline !important;\">No ads. No pressure selling. Just long-term, organic visibility.</span></h2><h2 class=\"myJob-wrapper-single-title\"><br></h2><div><font color=\"#62646a\" face=\"Manrope, sans-serif\"><span style=\"font-size: 16px;\"><b>💡 What’s Needed:</b></span></font></div><div><font color=\"#62646a\" face=\"Manrope, sans-serif\"><span style=\"font-size: 16px;\">✅ Permanent placement on a targeted Tech &amp; Gadgets board</span></font></div><div><span style=\"font-size: 16px; color: rgb(98, 100, 106); font-family: Manrope, sans-serif; display: inline !important;\">✅ SEO-optimized title, description, and tags</span></div><div><font color=\"#62646a\" face=\"Manrope, sans-serif\"><span style=\"font-size: 16px;\">✅ Visually engaging, keyword-rich pin design</span></font></div><div><font color=\"#62646a\" face=\"Manrope, sans-serif\"><span style=\"font-size: 16px;\">✅ 100% organic reach — no bots, no paid traffic</span></font></div><div><span style=\"font-size: 16px; color: rgb(98, 100, 106); font-family: Manrope, sans-serif; display: inline !important;\">✅ One-time payment for lifetime exposure</span></div>', 'Online', NULL, NULL, 100, '1699257624-65489d18d695a.pdf', 1, 0, 1, 1, '2024-02-19 03:34:41', NULL, 'Experience tech influencer  needed to promote our new mobile based tech brand', 'Experience tech influencer  needed to promote our new mobile based tech brand', NULL, 1, 1, '2023-09-19 23:56:28', '2025-04-28 00:20:45'),
(9, 1, 'Need style our space home decor influencer collabs', 'style-your-space-home-decor-influencer-collabss', 1, 'less than a week', 'junior', '<p><font color=\"#0e1724\">🏡✨ Do you love sharing decor tips, before-and-after transformations, or showcasing minimalist, boho, or luxury interiors with your followers?</font></p><p><br></p><p><font color=\"#0e1724\">We’re partnering with brands in the home decor and lifestyle niche – from furniture companies to eco-friendly organizers and aesthetic lighting brands – and we’re looking for creators like you to bring them to life on social media. Whether you do room makeovers, shelf styling, or mood board magic, this is your chance to monetize your taste and influence.</font></p><p><br></p><p><font color=\"#0e1724\"><br></font></p><p><font color=\"#0e1724\"><b>✅ Features You’ll Have Access To:</b></font></p><p><br></p><p><font color=\"#0e1724\"><b>Brand Collaborations:</b> Match with interior &amp; decor brands aligned with your audience</font></p><p><font color=\"#0e1724\"><b>Custom Campaign Briefs:</b> Clear guidelines so you can create with purpose</font></p><p><font color=\"#0e1724\"><b>Real-Time Analytics:</b> Track views, reach, and ROI for your campaigns</font></p><p><font color=\"#0e1724\"><b>One-Click Portfolio Display:</b> Showcase your top posts, collabs, and decor transformations</font></p><p><font color=\"#0e1724\"><b>Secure Payment System:</b> Guaranteed payments on completion</font></p><p><font color=\"#0e1724\"><b>Direct Messaging:</b> Easy chat with clients for faster turnaround</font></p>', 'Online', NULL, NULL, 200, '1699248745-65487a691055a.txt', 1, 0, 1, 1, '2025-08-08 07:13:21', NULL, 'Style your space – home decor influencer collab', 'Style your space – home decor influencer collab', NULL, 1, 1, '2023-09-20 06:04:27', '2025-08-08 07:13:21'),
(10, 6, 'I Need your fashion brand with trend driven high Impact content', 'your-fashion-brand-with-trend-driven-high-impact-content', 2, '1 Days', 'junior', '<p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">Are you a fashion influencer passionate about style, trends, and authentic engagement? Join our dynamic platform to collaborate with top fashion brands seeking to connect with audiences through genuine and stylish content.​</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\"><br></span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\"><b>What We Offer:</b></span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">🤝 Seamless Collaboration: Connect directly with brands that align with your fashion niche and audience.</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">📈 Performance Analytics: Access real-time data on engagement, reach, and conversions to showcase your impact.</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">💼 Portfolio Showcase: Highlight your previous collaborations and style to attract potential brand partners.</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">💬 Direct Communication: Utilize our integrated messaging system for efficient coordination with brands.</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">💰 Secure Payments: Ensure timely and secure compensation for your creative efforts.​</span></p>', 'Online', NULL, NULL, 300, '1699248562-654879b26056f.pdf', 1, 0, 1, 1, '2025-04-16 04:57:14', NULL, 'Your fashion brand with trend driven high Impact content', 'Your fashion brand with trend driven high Impact content', NULL, 1, 1, '2023-09-20 06:10:35', '2025-04-28 00:13:12'),
(11, 1, 'We need a fashion influencer passionate about style and trends', 'a-fashion-influencer-passionate-about-style-and-trends', 2, 'less than a week', 'junior', '<p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">Are you a fashion influencer passionate about style, trends, and authentic engagement? Join our dynamic platform to collaborate with top fashion brands seeking to connect with audiences through genuine and stylish content.​</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\"><br></span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\"><b>What We Offer:</b></span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">🤝 Seamless Collaboration: Connect directly with brands that align with your fashion niche and audience.</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">📈 Performance Analytics: Access real-time data on engagement, reach, and conversions to showcase your impact.</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">💼 Portfolio Showcase: Highlight your previous collaborations and style to attract potential brand partners.</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">💬 Direct Communication: Utilize our integrated messaging system for efficient coordination with brands.</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">💰 Secure Payments: Ensure timely and secure compensation for your creative efforts.​</p>', 'Online', NULL, NULL, 500, '1699247558-654875c61d50c.txt', 1, 2, 1, 1, '2025-08-09 12:52:10', NULL, 'A fashion influencer passionate about style and trends', 'A fashion influencer passionate about style and trends', NULL, 1, 1, '2023-09-20 06:48:17', '2025-08-09 12:52:10'),
(12, 112, 'Need street style fashion influencer collabs', 'project-in-laravel-and-vuejs-3', 2, 'less than a month', 'junior', '<p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">Are you ready to set the trends, not just follow them? 😎🔥</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">We’re calling all bold, authentic, and edgy fashion influencers who live and breathe street style! From oversized fits to luxury sneakers, distressed denim to statement accessories — your unique vibe deserves the spotlight.</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">Join forces with brands looking to promote urban fashion collections, sneaker drops, designer streetwear, and indie labels through fresh, powerful content. Show the world how you style the streets!</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">✅ Features for Influencers:</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">📸 Street Style Photoshoot Opportunities</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">➤ Collaborate on creative shoots in iconic city spots or urban backdrops.</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">🎥 Dynamic Fashion Reels &amp; TikToks</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">➤ Create quick, edgy styling videos, fit checks, and behind-the-scenes content.</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">💬 Direct Brand Communication</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\"><br></span><span style=\"display: inline !important;\">➤ Coordinate campaigns easily with streetwear brands and fashion startups.</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">📈 Analytics Dashboard Access</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">➤ Get live stats on your campaign reach, engagement, and saves.</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">🛍️ Exclusive Sneak Peeks and Product Launches</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">➤ Be the first to rock limited edition pieces and promote exclusive drops.</span></p>', 'Online', NULL, NULL, 50, '1699247291-654874bba36ad.pdf', 1, 0, 1, 1, '2025-04-16 04:57:11', NULL, NULL, 'Street style fashion influencer collabs', NULL, 1, 1, '2023-10-04 04:12:56', '2025-04-28 00:12:22'),
(13, 111, 'Extreme experience in eBay research and listings', 'extreme-experience-in-ebay-research-and-listings', 9, 'less than a week', 'junior', '<p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">I am looking for someone with extreme experience in eBay research and listings to assist with listing optimization and management.</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">- I am open to any market or product category and need assistance with more than 20 eBay listings.</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">- The ideal candidate should have expertise in optimizing listings for maximum visibility and sales.</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">- They should also have experience in managing listings, including updating product information, pricing, and inventory.</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">- Strong research and analytical skills are required for competitor analysis and product research.</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">- Proficiency in eBay\'s platform and guidelines is essential to ensure compliance and maximize results.</p>', 'Onsite', NULL, NULL, 100, '1699252773-65488a251c02a.pdf', 1, 0, 1, 1, '2025-04-16 05:25:56', NULL, NULL, NULL, NULL, 1, 1, '2023-11-06 00:39:33', '2025-04-16 05:41:20'),
(14, 1, 'Glow up our brand with skincare-entric beauty content', 'glow-up-our-brand-with-skincare-entric-beauty-content', 3, 'less than a month', 'junior', '<p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">Want your skincare brand to be seen and trusted? Let me help you shine—literally and figuratively. As a beauty influencer with a focus on skincare, I specialize in creating content that highlights ingredients, textures, results, and routines that resonate with skincare enthusiasts.</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\"><b><br></b></span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\"><b>📸 What I Offer:</b></span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">✅ Morning &amp; Night Routine Videos – Organic, step-by-step content with your product featured</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\"><span style=\"display: inline !important;\">✅ Before &amp; After Series – Showcase real results that build trust</span></p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">✅ Ingredient-Focused Reviews – Break down benefits, use-cases, and comparisons</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">✅ Aesthetic Product Photography – Clean, on-brand imagery for Instagram &amp; Pinterest</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">✅ Unboxing &amp; First Impressions – Raw, honest feedback that builds authenticity</p><p style=\"line-height: 1.4; margin-block: 0px; margin-bottom: 24px; color: rgb(14, 23, 36); font-family: Roboto, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 15px;\"=\"\">✅ Instagram Reels / TikToks – High-quality vertical content optimized for engagement</p>', 'Online', NULL, NULL, 500, '1699253437-65488cbd45a82.pdf', 1, 0, 1, 1, '2025-08-30 13:11:24', NULL, 'Glow up our  brand with skincare-entric beauty content', 'Glow up our  brand with skincare-entric beauty content', NULL, 1, 1, '2023-11-06 00:50:37', '2025-08-30 13:11:24'),
(15, 2, 'Need an dynamic influencer to promote my recipes on social platform', 'need-an-dynamic-influencer-to-promote-my-recipes-on-social-platform', 5, 'less than a month', 'junior', '<p><font color=\"#0e1724\">I Want to showcase my food or beverage brand in the most delicious way possible? 🍝🍰</font></p><p><br></p><p><font color=\"#0e1724\">I specialize in developing original recipes featuring your product and presenting them through eye-catching photos, videos, and step-by-step guides. From comforting classics to modern gourmet creations, I can help your brand stand out and connect with food-loving audiences across Instagram, TikTok, YouTube, and Pinterest.</font></p><p><br></p><p><font color=\"#0e1724\">Let’s collaborate to bring your products to life in kitchens around the world! 🌍🍴</font></p><p><br></p><p><font color=\"#0e1724\"><br></font></p><p><font color=\"#0e1724\"><b>🎯 Who This is Perfect For:</b></font></p><p><font color=\"#0e1724\"><b><br></b></font></p><p><font color=\"#0e1724\">Food &amp; beverage brands launching new products</font></p><p><span style=\"color: rgb(14, 23, 36); display: inline !important;\">Health food companies promoting ingredients or supplements</span></p><p><span style=\"color: rgb(14, 23, 36); display: inline !important;\">Kitchen tool brands seeking recipe-based promotions</span></p><p><span style=\"color: rgb(14, 23, 36); display: inline !important;\">Gourmet shops and online marketplaces boosting brand visibility</span></p>', 'Online', NULL, NULL, 300, '1699255170-65489382671f1.pdf', 1, 2, 1, 1, '2025-05-19 05:46:24', NULL, 'Need an dynamic influencer to promote my recipes on social platform', 'Need an dynamic influencer to promote my recipes on social platform', NULL, 1, 1, '2023-11-06 01:19:30', '2025-05-19 05:47:22'),
(84, 111, 'Elevate our  brand with authentic fashion influence', 'elevate-your-brand-with-authentic-fashion-influence', 2, 'less than a month', 'Not Mandatory', '<p>Are you a fashion influencer passionate about style, trends, and authentic engagement? Join our dynamic platform to collaborate with top fashion brands seeking to connect with audiences through genuine and stylish content.​</p><p><br></p><p><br></p><p><b>What We Offer:</b></p><p>🤝 Seamless Collaboration: Connect directly with brands that align with your fashion niche and audience.</p><p>📈 Performance Analytics: Access real-time data on engagement, reach, and conversions to showcase your impact.</p><p>💼 Portfolio Showcase: Highlight your previous collaborations and style to attract potential brand partners.</p><p>💬 Direct Communication: Utilize our integrated messaging system for efficient coordination with brands.</p><p>💰 Secure Payments: Ensure timely and secure compensation for your creative efforts.​</p>', 'Online', NULL, NULL, 45, '1745823777-680f28210e35e.pdf', 0, 0, 1, 1, '2025-05-04 02:14:05', NULL, 'Elevate your brand with authentic fashion influence', 'Elevate your brand with authentic fashion influence', NULL, 0, 0, '2025-04-16 05:48:31', '2025-05-04 02:14:05'),
(87, 113, 'Collaborate with Vegan Skincare Brand for Reels and Instagram Stories', 'collaborate-with-vegan-skincare-brand-for-reels-and-instagram-stories', 3, '3 Days', 'Senior', '<p>We are launching a new all-natural, vegan skincare line aimed at people with sensitive skin. We\'re seeking passionate beauty influencers to showcase our moisturizer in creative Instagram reels and stories. You’ll receive the product kit and create 2-3 pieces of content that highlight daily use, texture, and benefits.</p>', 'Online', NULL, NULL, 100, '1750675625-685930a90c044.png', 1, 0, 1, 1, '2025-07-07 00:48:24', NULL, 'Promote Vegan Skincare on Instagram', 'Looking for beauty influencers to promote our new skincare line through social content.', NULL, 0, 0, '2025-06-23 04:47:05', '2025-07-08 11:27:35'),
(88, 115, 'Summer Glow Skincare Launch', 'summer-glow-skincare-launch', 24, 'less than a month', 'MidLevel', 'We’re launching our new vegan skincare line for summer 2025! We want beauty influencers to create unboxing videos, honest reviews, and share skin glow-up reels to boost brand awareness.', 'Online', NULL, NULL, 5000, '', 1, 2, 1, 1, '2025-07-14 22:10:05', NULL, 'Reiciendis voluptate', 'Doloremque aliquam i', NULL, 0, 0, '2025-07-14 04:28:20', '2025-07-14 22:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `job_post_skills`
--

CREATE TABLE `job_post_skills` (
  `id` bigint UNSIGNED NOT NULL,
  `job_post_id` bigint NOT NULL,
  `skill_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_post_skills`
--

INSERT INTO `job_post_skills` (`id`, `job_post_id`, `skill_id`, `created_at`, `updated_at`) VALUES
(8, 3, 2, '2023-04-17 18:36:06', '2023-04-17 18:36:06'),
(9, 3, 3, '2023-04-17 18:36:06', '2023-04-17 18:36:06'),
(10, 4, 1, '2023-05-24 17:17:27', '2023-05-24 17:17:27'),
(11, 4, 2, '2023-05-24 17:17:27', '2023-05-24 17:17:27'),
(12, 5, 1, '2023-06-03 18:46:06', '2023-06-03 18:46:06'),
(13, 5, 3, '2023-06-03 18:46:06', '2023-06-03 18:46:06'),
(25, 12, 4, '2023-11-05 22:54:02', '2023-11-05 22:54:02'),
(26, 12, 6, '2023-11-05 22:54:02', '2023-11-05 22:54:02'),
(30, 11, 4, '2023-11-05 23:12:38', '2023-11-05 23:12:38'),
(31, 11, 6, '2023-11-05 23:12:38', '2023-11-05 23:12:38'),
(37, 10, 6, '2023-11-05 23:29:22', '2023-11-05 23:29:22'),
(38, 10, 7, '2023-11-05 23:29:22', '2023-11-05 23:29:22'),
(45, 9, 30, '2023-11-05 23:37:39', '2023-11-05 23:37:39'),
(47, 9, 32, '2023-11-05 23:37:39', '2023-11-05 23:37:39'),
(48, 7, 7, '2023-11-05 23:42:10', '2023-11-05 23:42:10'),
(54, 6, 6, '2023-11-05 23:50:58', '2023-11-05 23:50:58'),
(55, 6, 7, '2023-11-05 23:50:58', '2023-11-05 23:50:58'),
(80, 15, 52, '2023-11-06 01:19:30', '2023-11-06 01:19:30'),
(81, 15, 53, '2023-11-06 01:19:30', '2023-11-06 01:19:30'),
(82, 15, 54, '2023-11-06 01:19:30', '2023-11-06 01:19:30'),
(86, 8, 53, '2023-11-06 02:03:51', '2023-11-06 02:03:51'),
(87, 8, 56, '2023-11-06 02:03:51', '2023-11-06 02:03:51'),
(88, 8, 57, '2023-11-06 02:03:51', '2023-11-06 02:03:51'),
(89, 16, 1, '2023-11-09 07:56:12', '2023-11-09 07:56:12'),
(90, 17, 1, '2023-11-09 08:01:57', '2023-11-09 08:01:57'),
(91, 18, 1, '2023-11-22 02:06:31', '2023-11-22 02:06:31'),
(92, 18, 3, '2023-11-22 02:06:31', '2023-11-22 02:06:31'),
(93, 19, 7, '2023-11-22 08:52:51', '2023-11-22 08:52:51'),
(94, 20, 2, '2023-11-22 09:21:18', '2023-11-22 09:21:18'),
(95, 20, 3, '2023-11-22 09:21:18', '2023-11-22 09:21:18'),
(96, 21, 2, '2023-11-22 22:06:25', '2023-11-22 22:06:25'),
(97, 22, 1, '2023-11-22 22:08:18', '2023-11-22 22:08:18'),
(98, 22, 2, '2023-11-22 22:08:18', '2023-11-22 22:08:18'),
(99, 23, 3, '2023-11-22 22:10:00', '2023-11-22 22:10:00'),
(100, 23, 6, '2023-11-22 22:10:00', '2023-11-22 22:10:00'),
(101, 24, 1, '2023-11-22 22:11:38', '2023-11-22 22:11:38'),
(102, 24, 4, '2023-11-22 22:11:38', '2023-11-22 22:11:38'),
(103, 25, 2, '2023-11-23 01:38:53', '2023-11-23 01:38:53'),
(104, 25, 4, '2023-11-23 01:38:53', '2023-11-23 01:38:53'),
(105, 26, 3, '2023-11-26 06:39:41', '2023-11-26 06:39:41'),
(106, 27, 6, '2023-11-26 06:40:47', '2023-11-26 06:40:47'),
(107, 28, 1, '2023-11-26 07:24:28', '2023-11-26 07:24:28'),
(108, 29, 3, '2023-11-29 04:25:12', '2023-11-29 04:25:12'),
(109, 29, 4, '2023-11-29 04:25:12', '2023-11-29 04:25:12'),
(110, 30, 1, '2024-01-30 03:27:12', '2024-01-30 03:27:12'),
(111, 31, 58, '2024-01-30 05:52:35', '2024-01-30 05:52:35'),
(112, 31, 59, '2024-01-30 05:52:35', '2024-01-30 05:52:35'),
(113, 32, 2, '2024-01-30 07:15:49', '2024-01-30 07:15:49'),
(114, 32, 6, '2024-01-30 07:15:49', '2024-01-30 07:15:49'),
(115, 33, 1, '2024-03-04 05:50:19', '2024-03-04 05:50:19'),
(119, 36, 1, '2024-03-20 21:53:17', '2024-03-20 21:53:17'),
(120, 36, 2, '2024-03-20 21:53:17', '2024-03-20 21:53:17'),
(121, 35, 11, '2024-03-20 22:10:01', '2024-03-20 22:10:01'),
(122, 35, 12, '2024-03-20 22:10:01', '2024-03-20 22:10:01'),
(128, 44, 4, '2024-05-20 00:59:28', '2024-05-20 00:59:28'),
(129, 45, 2, '2024-05-20 06:57:36', '2024-05-20 06:57:36'),
(130, 46, 2, '2024-06-02 03:19:41', '2024-06-02 03:19:41'),
(131, 46, 6, '2024-06-02 03:19:41', '2024-06-02 03:19:41'),
(132, 47, 1, '2024-06-02 23:27:12', '2024-06-02 23:27:12'),
(133, 47, 2, '2024-06-02 23:27:12', '2024-06-02 23:27:12'),
(134, 47, 6, '2024-06-02 23:27:12', '2024-06-02 23:27:12'),
(135, 48, 2, '2024-06-02 23:34:30', '2024-06-02 23:34:30'),
(136, 49, 4, '2024-06-02 23:36:15', '2024-06-02 23:36:15'),
(137, 49, 6, '2024-06-02 23:36:15', '2024-06-02 23:36:15'),
(138, 50, 2, '2024-06-25 01:34:32', '2024-06-25 01:34:32'),
(139, 51, 4, '2024-07-07 01:41:01', '2024-07-07 01:41:01'),
(140, 52, 4, '2024-07-07 05:45:55', '2024-07-07 05:45:55'),
(141, 53, 6, '2024-07-07 06:01:53', '2024-07-07 06:01:53'),
(142, 53, 10, '2024-07-07 06:01:53', '2024-07-07 06:01:53'),
(143, 54, 6, '2024-07-07 06:03:34', '2024-07-07 06:03:34'),
(144, 55, 2, '2024-07-09 04:15:46', '2024-07-09 04:15:46'),
(145, 56, 2, '2024-07-16 05:12:20', '2024-07-16 05:12:20'),
(146, 57, 1, '2024-07-27 00:33:43', '2024-07-27 00:33:43'),
(147, 57, 2, '2024-07-27 00:33:43', '2024-07-27 00:33:43'),
(148, 58, 200, '2024-07-27 00:38:27', '2024-07-27 01:19:56'),
(150, 59, 1, '2024-07-27 00:44:35', '2024-07-27 00:44:35'),
(151, 59, 2, '2024-07-27 00:44:35', '2024-07-27 00:44:35'),
(152, 60, 1, '2024-07-27 00:46:05', '2024-07-27 00:46:05'),
(153, 60, 2, '2024-07-27 00:46:05', '2024-07-27 00:46:05'),
(154, 61, 200, '2024-07-27 00:47:10', '2024-07-27 01:05:59'),
(156, 61, 100, '2024-07-27 01:05:59', '2024-07-27 01:05:59'),
(157, 58, 100, '2024-07-27 01:19:56', '2024-07-27 01:19:56'),
(158, 62, 2, '2024-08-01 00:24:31', '2024-08-01 00:24:31'),
(159, 63, 1, '2024-08-01 00:27:10', '2024-08-01 00:27:10'),
(160, 64, 4, '2024-08-01 00:34:22', '2024-08-01 00:34:22'),
(161, 65, 2, '2024-08-01 00:38:32', '2024-08-01 00:38:32'),
(162, 66, 2, '2024-08-01 00:44:41', '2024-08-01 00:44:41'),
(163, 67, 2, '2024-08-01 00:46:18', '2024-08-01 00:46:18'),
(164, 68, 7, '2024-08-01 00:51:56', '2024-08-01 00:51:56'),
(165, 69, 2, '2024-08-01 01:08:46', '2024-08-01 01:08:46'),
(166, 69, 7, '2024-08-01 01:08:46', '2024-08-01 01:08:46'),
(167, 70, 4, '2024-08-01 01:29:55', '2024-08-01 01:29:55'),
(168, 71, 4, '2024-08-01 01:48:14', '2024-08-01 01:48:14'),
(169, 72, 2, '2024-08-01 01:55:07', '2024-08-01 01:55:07'),
(170, 73, 2, '2024-08-01 03:17:39', '2024-08-01 03:17:39'),
(171, 73, 7, '2024-08-01 03:17:39', '2024-08-01 03:17:39'),
(172, 74, 2, '2024-08-05 22:56:20', '2024-08-05 22:56:20'),
(173, 74, 7, '2024-08-05 22:56:20', '2024-08-05 22:56:20'),
(174, 75, 4, '2024-08-28 23:41:29', '2024-08-28 23:41:29'),
(175, 76, 1, '2024-08-31 02:07:45', '2024-08-31 02:07:45'),
(176, 76, 2, '2024-08-31 02:07:45', '2024-08-31 02:07:45'),
(177, 77, 2, '2024-08-31 04:08:41', '2024-08-31 04:08:41'),
(178, 77, 7, '2024-08-31 04:08:41', '2024-08-31 04:08:41'),
(179, 78, 4, '2024-08-31 04:20:40', '2024-08-31 04:20:40'),
(180, 79, 2, '2024-09-18 04:26:41', '2024-09-18 04:26:41'),
(181, 79, 20, '2024-09-18 04:26:41', '2024-09-18 04:26:41'),
(182, 80, 1, '2024-09-25 05:55:05', '2024-09-25 05:55:05'),
(183, 80, 4, '2024-09-25 05:55:05', '2024-09-25 05:55:05'),
(184, 81, 2, '2024-09-28 04:59:23', '2024-09-28 04:59:23'),
(185, 81, 6, '2024-09-28 04:59:23', '2024-09-28 04:59:23'),
(186, 82, 2, '2024-09-29 03:17:34', '2024-09-29 03:17:34'),
(187, 83, 2, '2024-10-06 02:07:30', '2024-10-06 02:07:30'),
(188, 83, 7, '2024-10-06 02:07:30', '2024-10-06 02:07:30'),
(189, 13, 2, '2025-04-16 05:23:52', '2025-04-16 05:23:52'),
(190, 13, 4, '2025-04-16 05:23:52', '2025-04-16 05:23:52'),
(191, 13, 6, '2025-04-16 05:23:52', '2025-04-16 05:23:52'),
(192, 84, 3, '2025-04-16 05:48:31', '2025-04-16 05:48:31'),
(193, 84, 4, '2025-04-16 05:48:31', '2025-04-16 05:48:31'),
(194, 14, 58, '2025-04-27 23:44:33', '2025-04-27 23:44:33'),
(195, 14, 59, '2025-04-27 23:44:33', '2025-04-27 23:44:33'),
(197, 2, 60, '2025-04-28 00:07:39', '2025-04-28 00:07:39'),
(199, 85, 2, '2025-04-28 23:56:17', '2025-04-28 23:56:17'),
(200, 86, 3, '2025-04-29 00:05:25', '2025-04-29 00:05:25'),
(204, 87, 58, '2025-06-23 04:47:05', '2025-06-23 04:47:05'),
(206, 87, 61, '2025-07-08 11:27:35', '2025-07-08 11:27:35'),
(207, 1, 57, '2025-07-08 11:38:58', '2025-07-08 11:38:58'),
(208, 1, 59, '2025-07-08 11:38:58', '2025-07-08 11:38:58'),
(209, 1, 63, '2025-07-08 11:39:20', '2025-07-08 11:39:20'),
(210, 88, 4, '2025-07-14 04:28:20', '2025-07-14 04:28:20');

-- --------------------------------------------------------

--
-- Table structure for table `job_post_sub_categories`
--

CREATE TABLE `job_post_sub_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `job_post_id` bigint NOT NULL,
  `sub_category_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_post_sub_categories`
--

INSERT INTO `job_post_sub_categories` (`id`, `job_post_id`, `sub_category_id`, `created_at`, `updated_at`) VALUES
(5, 3, 21, '2023-04-17 18:36:06', '2023-04-17 18:36:06'),
(7, 5, 6, '2023-06-03 18:46:06', '2023-06-03 18:46:06'),
(8, 5, 8, '2023-06-03 18:46:06', '2023-06-03 18:46:06'),
(9, 6, 1, '2023-06-05 17:13:55', '2023-06-05 17:13:55'),
(10, 7, 1, '2023-09-11 06:45:09', '2023-09-11 06:45:09'),
(12, 9, 2, '2023-09-20 06:04:28', '2023-09-20 06:04:28'),
(18, 12, 20, '2023-11-05 22:54:02', '2023-11-05 22:54:02'),
(19, 12, 21, '2023-11-05 22:54:02', '2023-11-05 22:54:02'),
(20, 12, 22, '2023-11-05 22:54:02', '2023-11-05 22:54:02'),
(21, 11, 20, '2023-11-05 23:12:38', '2023-11-05 23:12:38'),
(22, 11, 21, '2023-11-05 23:12:38', '2023-11-05 23:12:38'),
(23, 11, 22, '2023-11-05 23:12:38', '2023-11-05 23:12:38'),
(24, 10, 21, '2023-11-05 23:29:22', '2023-11-05 23:29:22'),
(25, 10, 22, '2023-11-05 23:29:22', '2023-11-05 23:29:22'),
(27, 7, 24, '2023-11-05 23:42:10', '2023-11-05 23:42:10'),
(28, 6, 24, '2023-11-05 23:50:58', '2023-11-05 23:50:58'),
(29, 5, 5, '2023-11-06 00:01:23', '2023-11-06 00:01:23'),
(30, 5, 7, '2023-11-06 00:01:23', '2023-11-06 00:01:23'),
(31, 4, 5, '2023-11-06 00:08:39', '2023-11-06 00:08:39'),
(32, 4, 6, '2023-11-06 00:08:39', '2023-11-06 00:08:39'),
(33, 4, 7, '2023-11-06 00:08:39', '2023-11-06 00:08:39'),
(34, 4, 8, '2023-11-06 00:08:39', '2023-11-06 00:08:39'),
(35, 2, 26, '2023-11-06 00:17:12', '2023-11-06 00:17:12'),
(36, 2, 33, '2023-11-06 00:17:12', '2023-11-06 00:17:12'),
(41, 13, 35, '2023-11-06 00:45:49', '2023-11-06 00:45:49'),
(43, 14, 36, '2023-11-06 00:58:33', '2023-11-06 00:58:33'),
(45, 15, 37, '2023-11-06 01:24:11', '2023-11-06 01:24:11'),
(46, 8, 29, '2023-11-06 02:00:25', '2023-11-06 02:00:25'),
(47, 16, 1, '2023-11-09 07:56:12', '2023-11-09 07:56:12'),
(48, 17, 1, '2023-11-09 08:01:57', '2023-11-09 08:01:57'),
(49, 18, 5, '2023-11-22 02:06:30', '2023-11-22 02:06:30'),
(50, 19, 24, '2023-11-22 08:52:51', '2023-11-22 08:52:51'),
(51, 20, 2, '2023-11-22 09:21:18', '2023-11-22 09:21:18'),
(52, 21, 1, '2023-11-22 22:06:25', '2023-11-22 22:06:25'),
(53, 21, 24, '2023-11-22 22:06:25', '2023-11-22 22:06:25'),
(54, 22, 20, '2023-11-22 22:08:18', '2023-11-22 22:08:18'),
(55, 23, 20, '2023-11-22 22:10:00', '2023-11-22 22:10:00'),
(56, 24, 5, '2023-11-22 22:11:38', '2023-11-22 22:11:38'),
(57, 25, 2, '2023-11-23 01:38:53', '2023-11-23 01:38:53'),
(58, 26, 35, '2023-11-26 06:39:41', '2023-11-26 06:39:41'),
(59, 27, 37, '2023-11-26 06:40:47', '2023-11-26 06:40:47'),
(60, 28, 20, '2023-11-26 07:24:27', '2023-11-26 07:24:27'),
(61, 29, 36, '2023-11-29 04:25:12', '2023-11-29 04:25:12'),
(62, 30, 2, '2024-01-30 03:27:12', '2024-01-30 03:27:12'),
(63, 31, 45, '2024-01-30 05:52:35', '2024-01-30 05:52:35'),
(64, 32, 2, '2024-01-30 07:15:48', '2024-01-30 07:15:48'),
(65, 33, 20, '2024-03-04 05:50:19', '2024-03-04 05:50:19'),
(71, 36, 1, '2024-03-20 21:53:17', '2024-03-20 21:53:17'),
(72, 36, 2, '2024-03-20 21:53:17', '2024-03-20 21:53:17'),
(73, 35, 11, '2024-03-20 22:10:01', '2024-03-20 22:10:01'),
(74, 35, 12, '2024-03-20 22:10:01', '2024-03-20 22:10:01'),
(80, 44, 46, '2024-05-20 00:59:28', '2024-05-20 00:59:28'),
(81, 45, 2, '2024-05-20 06:57:36', '2024-05-20 06:57:36'),
(82, 45, 49, '2024-05-20 06:57:36', '2024-05-20 06:57:36'),
(83, 46, 2, '2024-06-02 03:19:41', '2024-06-02 03:19:41'),
(84, 47, 20, '2024-06-02 23:27:11', '2024-06-02 23:27:11'),
(85, 48, 2, '2024-06-02 23:34:30', '2024-06-02 23:34:30'),
(86, 49, 2, '2024-06-02 23:36:15', '2024-06-02 23:36:15'),
(87, 50, 24, '2024-06-25 01:34:32', '2024-06-25 01:34:32'),
(88, 51, 2, '2024-07-07 01:41:01', '2024-07-07 01:41:01'),
(89, 52, 1, '2024-07-07 05:45:55', '2024-07-07 05:45:55'),
(90, 53, 36, '2024-07-07 06:01:52', '2024-07-07 06:01:52'),
(91, 54, 21, '2024-07-07 06:03:34', '2024-07-07 06:03:34'),
(92, 55, 3, '2024-07-09 04:15:46', '2024-07-09 04:15:46'),
(93, 56, 3, '2024-07-16 05:12:20', '2024-07-16 05:12:20'),
(94, 57, 1, '2024-07-27 00:33:43', '2024-07-27 00:33:43'),
(95, 57, 2, '2024-07-27 00:33:43', '2024-07-27 00:33:43'),
(96, 58, 200, '2024-07-27 00:38:27', '2024-07-27 01:19:56'),
(98, 59, 1, '2024-07-27 00:44:35', '2024-07-27 00:44:35'),
(99, 59, 2, '2024-07-27 00:44:35', '2024-07-27 00:44:35'),
(100, 60, 1, '2024-07-27 00:46:05', '2024-07-27 00:46:05'),
(101, 60, 2, '2024-07-27 00:46:05', '2024-07-27 00:46:05'),
(102, 61, 200, '2024-07-27 00:47:10', '2024-07-27 01:05:59'),
(104, 61, 100, '2024-07-27 01:05:59', '2024-07-27 01:05:59'),
(105, 58, 100, '2024-07-27 01:19:56', '2024-07-27 01:19:56'),
(106, 62, 1, '2024-08-01 00:24:31', '2024-08-01 00:24:31'),
(107, 63, 24, '2024-08-01 00:27:09', '2024-08-01 00:27:09'),
(108, 64, 21, '2024-08-01 00:34:22', '2024-08-01 00:34:22'),
(109, 65, 21, '2024-08-01 00:38:32', '2024-08-01 00:38:32'),
(110, 66, 20, '2024-08-01 00:44:41', '2024-08-01 00:44:41'),
(111, 67, 20, '2024-08-01 00:46:17', '2024-08-01 00:46:17'),
(112, 68, 20, '2024-08-01 00:51:56', '2024-08-01 00:51:56'),
(113, 69, 22, '2024-08-01 01:08:46', '2024-08-01 01:08:46'),
(114, 70, 21, '2024-08-01 01:29:55', '2024-08-01 01:29:55'),
(115, 71, 2, '2024-08-01 01:48:14', '2024-08-01 01:48:14'),
(116, 72, 24, '2024-08-01 01:55:07', '2024-08-01 01:55:07'),
(117, 73, 2, '2024-08-01 03:17:39', '2024-08-01 03:17:39'),
(118, 74, 24, '2024-08-05 22:56:20', '2024-08-05 22:56:20'),
(119, 76, 36, '2024-08-31 02:07:45', '2024-08-31 02:07:45'),
(120, 77, 2, '2024-08-31 04:08:41', '2024-08-31 04:08:41'),
(121, 77, 46, '2024-08-31 04:08:41', '2024-08-31 04:08:41'),
(122, 78, 24, '2024-08-31 04:20:40', '2024-08-31 04:20:40'),
(123, 79, 2, '2024-09-18 04:26:41', '2024-09-18 04:26:41'),
(124, 80, 2, '2024-09-25 05:55:05', '2024-09-25 05:55:05'),
(125, 81, 24, '2024-09-28 04:59:23', '2024-09-28 04:59:23'),
(126, 82, 21, '2024-09-29 03:17:34', '2024-09-29 03:17:34'),
(127, 83, 24, '2024-10-06 02:07:30', '2024-10-06 02:07:30'),
(128, 84, 3, '2025-04-16 05:48:31', '2025-04-16 05:48:31'),
(129, 8, 30, '2025-04-28 00:20:45', '2025-04-28 00:20:45'),
(130, 85, 36, '2025-04-28 23:56:17', '2025-04-28 23:56:17'),
(131, 86, 2, '2025-04-29 00:05:25', '2025-04-29 00:05:25'),
(133, 87, 36, '2025-07-08 11:27:06', '2025-07-08 11:27:06'),
(134, 1, 29, '2025-07-08 11:38:58', '2025-07-08 11:38:58'),
(135, 1, 30, '2025-07-08 11:38:58', '2025-07-08 11:38:58'),
(136, 1, 34, '2025-07-08 11:38:58', '2025-07-08 11:38:58'),
(137, 88, 52, '2025-07-14 04:28:20', '2025-07-14 04:28:20');

-- --------------------------------------------------------

--
-- Table structure for table `job_proposals`
--

CREATE TABLE `job_proposals` (
  `id` bigint UNSIGNED NOT NULL,
  `job_id` bigint NOT NULL,
  `freelancer_id` bigint NOT NULL,
  `client_id` bigint NOT NULL,
  `amount` double NOT NULL,
  `duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revision` int NOT NULL DEFAULT '0',
  `cover_letter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=pending, 1=accept, 2=reject',
  `is_hired` tinyint NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes',
  `is_short_listed` tinyint NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes',
  `is_interview_take` tinyint NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes',
  `is_view` tinyint NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes',
  `is_rejected` tinyint NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes',
  `load_from` int NOT NULL DEFAULT '0',
  `is_synced` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_proposals`
--

INSERT INTO `job_proposals` (`id`, `job_id`, `freelancer_id`, `client_id`, `amount`, `duration`, `revision`, `cover_letter`, `attachment`, `status`, `is_hired`, `is_short_listed`, `is_interview_take`, `is_view`, `is_rejected`, `load_from`, `is_synced`, `created_at`, `updated_at`) VALUES
(1, 11, 5, 1, 500, 'Less than a month', 3, 'We are looking for skilled and experienced LARAVEL and JS developer.\r\n\r\nWe have ecommerce system build in Laravel and we want to further extend it.\r\n\r\n* We will be adding new features (enhance search, add filters, improve listings)\r\n\r\n* We are already hosting multiple stores in our system with ability to run their own products and categories\r\n\r\n* We want to make it for wholesalers with large amount of products\r\n\r\n* Connecting Paypal API', '1699351779-654a0ce3075f8.pdf', 0, 1, 1, 1, 1, 0, 1, 1, '2024-11-07 04:09:39', '2025-08-09 12:52:36'),
(2, 10, 5, 1, 300, 'Less than 2 month', 4, '- Experience in building and adding new features to existing software\r\n\r\n- Strong problem-solving skills and attention to detail\r\n\r\n- Ability to collaborate with a team and communicate effectively', '1699356664-654a1ff8dcdb9.pdf', 0, 0, 1, 1, 0, 1, 1, 1, '2024-11-07 05:31:04', '2024-12-15 07:28:34'),
(3, 13, 5, 1, 100, 'Less than 2 month', 3, 'I am looking for someone with extreme experience in eBay research and listings to assist with listing optimization and management.- I am open to any', '1699362821-654a3805d08da.pdf', 0, 0, 1, 1, 1, 1, 1, 1, '2024-11-07 07:13:41', '2025-04-16 05:25:48'),
(5, 23, 5, 1, 45, '2 Days', 5, 'fsdfsdfs sf sdf asjdkna slkdmaldk asmd asda\r\nasd asdlaksdl; asmdklmnfklsdfjopwei we\r\nsadlfk sdlfksdl;f sdfsd\r\nfsdfl sdf;l sd,fl;sdf,sdfsd sdf', '', 0, 0, 0, 0, 1, 1, 0, 0, '2024-11-23 01:01:52', '2024-12-18 05:54:23'),
(10, 25, 5, 1, 56, '2 Days', 6, 'gjvjvvjvbvghjfghfgh gfh gjvjvvjvbvghjfghfgh gfh gjvjvvjvbvghjfghfgh gfh gjvjvvjvbvghjfghfgh gfh gjvjvvjvbvghjfghfgh gfh gjvjvvjvbvghjfghfgh gfh gjvjvvjvbvghjfghfgh gfh', '1700982629-6562ef657c9e8.png', 0, 0, 1, 1, 1, 0, 1, 1, '2024-11-26 01:10:29', '2024-12-15 07:28:37'),
(12, 26, 5, 1, 100, 'Less than a month', 6, 'dasfas df ffd ad fdasf dfs asd df df sad f  da a d af as  asd d  dasfas df ffd ad fdasf dfs asd df df sad f  da a d af as  asd d  dasfas df ffd ad fdasf dfs asd df df sad f  da a d af as  asd d', '1701003493-656340e5a28a7.png', 0, 0, 1, 0, 1, 0, 1, 1, '2024-11-26 06:58:13', '2024-12-15 07:28:39'),
(18, 20, 5, 1, 56, '2 Days', 5, 'sdf sd janaslskadm askldm asda s;dasd asdk asdk asoidj asd asd kjaspod kaspdo asdop aksdsjad ijasdoiajsdoi jasodi jasd asd asd adasd asd asd asd asd aasd asd asd asd', '1702888730-6580051a8e8af.jpg', 0, 0, 0, 0, 0, 0, 1, 1, '2024-12-18 02:38:50', '2024-12-15 07:28:41'),
(19, 29, 5, 1, 234, '2 Days', 12, 'asd hasdasdlk asdl kamsd asd asd asdas asdj asdj asidj aposid jkapsod kasopd kaspod kasdasd asd asd asda sasd asd', '1702888799-6580055f4de52.png', 0, 0, 0, 0, 0, 0, 1, 1, '2024-12-18 02:39:59', '2024-12-15 07:28:43'),
(20, 28, 5, 1, 54, 'Less than a week', 34, 'hd jasn asd naskd aslkdm asldm as;ld ,mas;ld asd asd askld jmsdfglfd;g d;fg dfgdf dfg dfgdf ah asdjknasd asd asdasd asd asda asd', '', 0, 0, 0, 0, 0, 0, 0, 0, '2024-12-23 07:11:43', '2023-12-23 07:11:43'),
(61, 76, 5, 1, 60, '2 Days', 4, 'wer werwer wer wer wer werwe we rwer werw asdas dasd asd asdasd asd asd asd asda sd asdas dasd asda asda sdaauishd asdn iksd jf sdf sdkfjlkasdf aslkd asd', '', 0, 0, 0, 0, 0, 0, 0, 0, '2024-09-05 04:49:18', '2024-09-05 04:49:18'),
(62, 40, 5, 1, 60, '2 Days', 4, 'wer werwer wer wer wer werwe we rwer werw asdas dasd asd asdasd asd asd asd asda sd asdas dasd asda asda sdaauishd asdn iksd jf sdf sdkfjlkasdf aslkd asd', '', 0, 0, 0, 0, 0, 0, 0, 0, '2024-09-05 04:50:55', '2024-09-05 04:50:55'),
(63, 40, 4, 1, 60, '2 Days', 4, 'wer werwer wer wer wer werwe we rwer werw asdas dasd asd asdasd asd asd asd asda sd asdas dasd asda asda sdaauishd asdn iksd jf sdf sdkfjlkasdf aslkd asd', '', 0, 0, 0, 0, 0, 0, 0, 0, '2024-09-05 04:58:42', '2024-09-05 04:58:42'),
(64, 40, 4, 1, 60, '2 Days', 4, 'wer werwer wer wer wer werwe we rwer werw asdas dasd asd asdasd asd asd asd asda sd asdas dasd asda asda sdaauishd asdn iksd jf sdf sdkfjlkasdf aslkd asd', '', 0, 0, 0, 0, 0, 0, 0, 0, '2024-09-05 05:00:54', '2024-09-05 05:00:54'),
(65, 76, 4, 1, 60, '2 Days', 4, 'wer werwer wer wer wer werwe we rwer werw asdas dasd asd asdasd asd asd asd asda sd asdas dasd asda asda sdaauishd asdn iksd jf sdf sdkfjlkasdf aslkd asd', '', 0, 0, 0, 0, 0, 0, 0, 0, '2024-09-05 05:05:06', '2024-09-05 05:05:06'),
(67, 80, 5, 3, 100, 'Less than a week', 2, 'sd dsfsdf sdf sdf sdf', '', 0, 0, 0, 0, 0, 0, 0, 0, '2024-09-28 23:06:58', '2024-09-28 23:06:58'),
(68, 82, 3, 7, 90, 'Less than a week', 5, 'hey how are you. let me know the direct access.. thanks', '1727601662-66f91bfe41a48.docx', 0, 0, 1, 1, 1, 0, 0, 0, '2024-09-29 03:21:02', '2024-09-30 05:18:50'),
(92, 15, 5, 1, 300, '3 Days', 4, 'I am looking for someone with extreme experience in eBay research and listings to assist with listing optimization and management.- I am open to any', '', 0, 0, 0, 1, 1, 0, 0, 0, '2025-05-04 01:59:00', '2025-05-19 05:55:10'),
(93, 14, 5, 1, 500, '2 Days', 3, 'I am looking for someone with extreme experience in eBay research and listings to assist with listing optimization and management.- I am open to any', '', 0, 0, 0, 1, 1, 0, 0, 0, '2025-05-04 01:59:27', '2025-08-30 13:11:51'),
(94, 87, 5, 1, 80, '3 Days', 5, 'Meta Title - ideal length is 50–60 characters (optional) Meta Title', '1750832385-685b95019c656.png', 0, 0, 0, 0, 1, 0, 0, 0, '2025-06-25 00:19:45', '2025-07-08 12:02:10'),
(95, 88, 116, 115, 4600, 'Less than a month', 4, 'I’m excited to collaborate on your new vegan skincare line! For this campaign, I propose to create:\r\n\r\n2 high-quality unboxing reels showcasing the packaging and first impressions.\r\n\r\n3 Instagram stories sharing how I incorporate the products into my daily routine, with swipe-up links if needed.\r\n\r\n1 short testimonial video (30–60 sec) talking about my skin glow-up results.\r\n\r\nI’ll make sure the content feels genuine and aligns with your clean beauty values. I’ll use trending audio and relevant hashtags to maximise reach.', '1752494183-6874f067ad1a8.jpg', 0, 0, 0, 1, 1, 0, 0, 0, '2025-07-14 05:56:23', '2025-07-14 21:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `slug`, `direction`, `status`, `default`, `created_at`, `updated_at`) VALUES
(1, 'English (UK)', 'en_GB', 'ltr', 'publish', 0, '2024-11-22 04:56:35', '2025-07-30 21:19:43'),
(11, 'Español', 'es_ES', 'ltr', 'publish', 0, '2023-12-31 03:47:54', '2025-07-30 21:19:17'),
(14, 'Türkçe', 'tr_TR', 'ltr', 'publish', 1, '2024-11-20 23:32:33', '2025-08-12 03:57:33'),
(15, 'Português', 'pt_PT', 'ltr', 'publish', 0, '2024-01-19 23:33:06', '2025-07-27 22:49:03'),
(16, 'Русский', 'ru_RU', 'ltr', 'publish', 0, '2024-11-19 23:37:17', '2025-08-12 03:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `lengths`
--

CREATE TABLE `lengths` (
  `id` bigint UNSIGNED NOT NULL,
  `length` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lengths`
--

INSERT INTO `lengths` (`id`, `length`, `status`, `created_at`, `updated_at`) VALUES
(1, '1 Days', 1, '2024-09-18 01:36:18', '2024-09-18 01:36:18'),
(2, '2 Days', 1, '2024-09-18 01:38:42', '2024-09-18 01:38:42'),
(3, '3 Days', 1, '2024-09-18 01:38:50', '2024-09-18 01:38:50'),
(4, 'less than a week', 1, '2024-09-18 01:39:35', '2024-09-18 01:39:35'),
(5, 'less than a month', 1, '2024-09-18 01:40:27', '2024-09-18 01:40:27'),
(6, 'less than 2 month', 1, '2024-09-18 01:40:40', '2024-09-18 01:40:40'),
(7, 'less than 3 month', 1, '2024-09-18 01:41:05', '2024-09-18 01:41:05'),
(8, 'More than 3 month', 1, '2024-09-18 01:41:14', '2024-09-18 05:45:57');

-- --------------------------------------------------------

--
-- Table structure for table `live_chats`
--

CREATE TABLE `live_chats` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint DEFAULT NULL,
  `freelancer_id` bigint DEFAULT NULL,
  `admin_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `live_chat_messages`
--

CREATE TABLE `live_chat_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `live_chat_id` bigint UNSIGNED NOT NULL,
  `from_user` int NOT NULL COMMENT '1 = client, 2 = freelancer, 3 = admin',
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_seen` tinyint NOT NULL DEFAULT '0' COMMENT '0=unseen, 1=seen',
  `load_from` int NOT NULL DEFAULT '0',
  `is_synced` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_activities`
--

CREATE TABLE `log_activities` (
  `id` bigint UNSIGNED NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_uploads`
--

CREATE TABLE `media_uploads` (
  `id` bigint UNSIGNED NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `size` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `dimensions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `user_id` bigint DEFAULT NULL,
  `load_from` int NOT NULL DEFAULT '0',
  `is_synced` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_uploads`
--

INSERT INTO `media_uploads` (`id`, `title`, `path`, `alt`, `size`, `dimensions`, `type`, `user_id`, `load_from`, `is_synced`, `created_at`, `updated_at`) VALUES
(231, 'razorpay.png', 'razorpay1742975361.png', NULL, '1.09 KB', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:21', '2025-03-26 01:49:21'),
(232, 'paytm.png', 'paytm1742975361.png', NULL, '984 ', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:21', '2025-03-26 01:49:21'),
(233, 'paystack.png', 'paystack1742975361.png', NULL, '1.06 KB', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:21', '2025-03-26 01:49:21'),
(234, 'paytabs.png', 'paytabs1742975361.png', NULL, '1.84 KB', '59 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:21', '2025-03-26 01:49:21'),
(235, 'payfast.png', 'payfast1742975361.png', NULL, '1.28 KB', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:21', '2025-03-26 01:49:21'),
(236, 'paypal.png', 'paypal1742975361.png', NULL, '1.2 KB', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:21', '2025-03-26 01:49:21'),
(237, 'pagali.png', 'pagali1742975361.png', NULL, '993 ', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:21', '2025-03-26 01:49:21'),
(238, 'mollie.png', 'mollie1742975361.png', NULL, '810 ', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:21', '2025-03-26 01:49:21'),
(239, 'marcadopago.png', 'marcadopago1742975361.png', NULL, '1.63 KB', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:21', '2025-03-26 01:49:21'),
(240, 'midtrans.png', 'midtrans1742975361.png', NULL, '907 ', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:21', '2025-03-26 01:49:21'),
(241, 'manual.png', 'manual1742975361.png', NULL, '2.74 KB', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:21', '2025-03-26 01:49:21'),
(242, 'kineticpay.png', 'kineticpay1742975361.png', NULL, '20.54 KB', '648 x 211 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:21', '2025-03-26 01:49:21'),
(243, 'instamojo.png', 'instamojo1742975362.png', NULL, '1.66 KB', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:22', '2025-03-26 01:49:22'),
(244, 'flutterwave.png', 'flutterwave1742975362.png', NULL, '1 KB', '59 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:22', '2025-03-26 01:49:22'),
(245, 'cinitpay.png', 'cinitpay1742975362.png', NULL, '1.41 KB', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:22', '2025-03-26 01:49:22'),
(246, 'cashfree.png', 'cashfree1742975362.png', NULL, '1.32 KB', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:22', '2025-03-26 01:49:22'),
(247, 'billplz.png', 'billplz1742975362.png', NULL, '1.36 KB', '59 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:22', '2025-03-26 01:49:22'),
(248, 'authorizedotnet.png', 'authorizedotnet1742975362.png', NULL, '2.01 KB', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:22', '2025-03-26 01:49:22'),
(249, 'square.png', 'square1742975362.png', NULL, '1.38 KB', '59 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:22', '2025-03-26 01:49:22'),
(250, 'sitesway.png', 'sitesway1742975362.png', NULL, '1.41 KB', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:22', '2025-03-26 01:49:22'),
(251, 'toybpay.png', 'toybpay1742975362.png', NULL, '1014 ', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:22', '2025-03-26 01:49:22'),
(252, 'stripe.png', 'stripe1742975362.png', NULL, '1.15 KB', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:22', '2025-03-26 01:49:22'),
(253, 'zitopay.png', 'zitopay1742975362.png', NULL, '1.52 KB', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:22', '2025-03-26 01:49:22'),
(254, 'xendit-logo.png', 'xendit-logo1742975362.png', NULL, '31.91 KB', '1024 x 441 pixels', 'admin', 1, 0, 0, '2025-03-26 01:49:22', '2025-03-26 01:49:22'),
(255, 'IMG_93571737251996.png', 'IMG_935717372519961742977238.png', NULL, '22.95 KB', '1050 x 591 pixels', 'admin', 1, 0, 0, '2025-03-26 02:20:38', '2025-03-26 02:20:38'),
(256, '2nd1700310726.png', '2nd17003107261742977281.png', NULL, '1.32 MB', '1296 x 700 pixels', 'admin', 1, 0, 0, '2025-03-26 02:21:21', '2025-03-26 02:21:21'),
(257, '51701088005.png', '517010880051743924876.png', NULL, '2.59 KB', '47 x 47 pixels', 'web', 99, 0, 0, '2025-04-06 01:34:36', '2025-04-06 01:34:36'),
(258, '1699185334-654782b6ed9e9.png', '1699185334-654782b6ed9e91743924894.png', NULL, '175.75 KB', '1770 x 960 pixels', 'web', 99, 0, 0, '2025-04-06 01:34:54', '2025-04-06 01:34:54'),
(259, '1699184794-6547809aeeaca.png', '1699184794-6547809aeeaca1743924894.png', NULL, '305.16 KB', '1770 x 960 pixels', 'web', 99, 0, 0, '2025-04-06 01:34:54', '2025-04-06 01:34:54'),
(260, '1699187515-65478b3b0682d.png', '1699187515-65478b3b0682d1743924894.png', NULL, '262.66 KB', '1770 x 960 pixels', 'web', 99, 0, 0, '2025-04-06 01:34:54', '2025-04-06 01:34:54'),
(261, 'image (5).png', 'image (5)1743927620.png', NULL, '35.79 KB', '558 x 171 pixels', 'admin', 1, 0, 0, '2025-04-06 02:20:20', '2025-04-06 02:20:20'),
(262, 'influencer Logo.png', 'influencer Logo1743927801.png', NULL, '2.27 KB', '141 x 30 pixels', 'admin', 1, 0, 0, '2025-04-06 02:23:21', '2025-04-06 02:23:21'),
(263, 'influencer white Logo.png', 'influencer white Logo1743927801.png', NULL, '1.82 KB', '141 x 30 pixels', 'admin', 1, 0, 0, '2025-04-06 02:23:21', '2025-04-06 02:23:21'),
(264, 'ellipse-selection.png', 'ellipse-selection1743927887.png', NULL, '859 ', '24 x 24 pixels', 'admin', 1, 0, 0, '2025-04-06 02:24:47', '2025-04-06 02:24:47'),
(265, 'Screenshot 2025-04-06 at 7.13.09 PM.png', 'Screenshot 2025-04-06 at 7.13.09 PM1744287848.png', NULL, '379.72 KB', '1378 x 697 pixels', 'web', 7, 0, 0, '2025-04-10 06:24:08', '2025-04-10 06:24:08'),
(266, 'blog1.jpg', 'blog11744528345.jpg', NULL, '7.16 KB', '210 x 295 pixels', 'web', 5, 0, 0, '2025-04-13 01:12:25', '2025-04-13 01:12:25'),
(267, 'blog6.jpg', 'blog61744528689.jpg', NULL, '17.06 KB', '210 x 295 pixels', 'web', 5, 0, 0, '2025-04-13 01:18:09', '2025-04-13 01:18:09'),
(269, 'blog8.jpg', 'blog81744528689.jpg', NULL, '14.11 KB', '210 x 295 pixels', 'web', 5, 0, 0, '2025-04-13 01:18:09', '2025-04-13 01:18:09'),
(276, '1736233417-677cd1c919315.png', '1736233417-677cd1c9193151744864187.png', NULL, '67.77 KB', '750 x 410 pixels', 'web', 5, 0, 0, '2025-04-16 22:29:47', '2025-04-16 22:29:47'),
(277, '1736233574-677cd2664f7ed.png', '1736233574-677cd2664f7ed1744864187.png', NULL, '165.86 KB', '750 x 410 pixels', 'web', 5, 0, 0, '2025-04-16 22:29:47', '2025-04-16 22:29:47'),
(278, '1742791266-67e0e26235149.png', '1742791266-67e0e262351491744864187.png', NULL, '183.74 KB', '750 x 410 pixels', 'web', 5, 0, 0, '2025-04-16 22:29:47', '2025-04-16 22:29:47'),
(279, '1742793591-67e0eb773ada3.png', '1742793591-67e0eb773ada31744864187.png', NULL, '196.08 KB', '750 x 410 pixels', 'web', 5, 0, 0, '2025-04-16 22:29:47', '2025-04-16 22:29:47'),
(280, '1742793503-67e0eb1f7af20.png', '1742793503-67e0eb1f7af201744865225.png', NULL, '161.88 KB', '750 x 410 pixels', 'web', 5, 0, 0, '2025-04-16 22:47:05', '2025-04-16 22:47:05'),
(281, 'Logo (1).png', 'Logo (1)1744886040.png', NULL, '1.91 KB', '205 x 37 pixels', 'admin', 1, 0, 0, '2025-04-17 04:34:00', '2025-04-17 04:34:00'),
(282, 'Logo (2).png', 'Logo (2)1744886040.png', NULL, '1.59 KB', '135 x 37 pixels', 'admin', 1, 0, 0, '2025-04-17 04:34:00', '2025-04-17 04:34:00'),
(283, 'Logo (3).png', 'Logo (3)1744886040.png', NULL, '1.29 KB', '95 x 37 pixels', 'admin', 1, 0, 0, '2025-04-17 04:34:00', '2025-04-17 04:34:00'),
(284, 'Logo (4).png', 'Logo (4)1744886040.png', NULL, '1.23 KB', '97 x 37 pixels', 'admin', 1, 0, 0, '2025-04-17 04:34:00', '2025-04-17 04:34:00'),
(285, 'Logo.png', 'Logo1744886054.png', NULL, '1.59 KB', '186 x 37 pixels', 'admin', 1, 0, 0, '2025-04-17 04:34:14', '2025-04-17 04:34:14'),
(286, '01.png', '011745124316.png', NULL, '9.45 KB', '200 x 200 pixels', 'admin', 1, 0, 0, '2025-04-19 22:45:16', '2025-04-19 22:45:16'),
(287, '02.png', '021745124316.png', NULL, '10.06 KB', '201 x 200 pixels', 'admin', 1, 0, 0, '2025-04-19 22:45:16', '2025-04-19 22:45:16'),
(288, '04.png', '041745124316.png', NULL, '10.73 KB', '200 x 200 pixels', 'admin', 1, 0, 0, '2025-04-19 22:45:16', '2025-04-19 22:45:16'),
(289, '03.png', '031745124316.png', NULL, '13.15 KB', '201 x 200 pixels', 'admin', 1, 0, 0, '2025-04-19 22:45:16', '2025-04-19 22:45:16'),
(290, 'arrow-right-up.png', 'arrow-right-up1745125944.png', NULL, '1.11 KB', '71 x 18 pixels', 'admin', 1, 0, 0, '2025-04-19 23:12:24', '2025-04-19 23:12:24'),
(291, 'arrow-right-down.png', 'arrow-right-down1745125944.png', NULL, '1.09 KB', '71 x 19 pixels', 'admin', 1, 0, 0, '2025-04-19 23:12:24', '2025-04-19 23:12:24'),
(292, 'analytics-up.png', 'analytics-up1745130500.png', NULL, '622 ', '33 x 32 pixels', 'admin', 1, 0, 0, '2025-04-20 00:28:20', '2025-04-20 00:28:20'),
(293, 'analytics-up.svg', 'analytics-up1745130500.svg', NULL, '', '', 'admin', 1, 0, 0, '2025-04-20 00:28:20', '2025-04-20 00:28:20'),
(294, 'medal-04.svg', 'medal-041745130500.svg', NULL, '', '', 'admin', 1, 0, 0, '2025-04-20 00:28:20', '2025-04-20 00:28:20'),
(295, 'police-badge.svg', 'police-badge1745130500.svg', NULL, '', '', 'admin', 1, 0, 0, '2025-04-20 00:28:20', '2025-04-20 00:28:20'),
(296, 'social.svg', 'social1745130500.svg', NULL, '', '', 'admin', 1, 0, 0, '2025-04-20 00:28:20', '2025-04-20 00:28:20'),
(297, 'wide.svg', 'wide1745130500.svg', NULL, '', '', 'admin', 1, 0, 0, '2025-04-20 00:28:20', '2025-04-20 00:28:20'),
(298, 'team117010720901742804432.jpg', 'team1170107209017428044321745154865.jpg', NULL, '16.32 KB', '306 x 306 pixels', 'admin', 1, 0, 0, '2025-04-20 07:14:25', '2025-04-20 07:14:25'),
(299, 'team317010720901742804431.jpg', 'team3170107209017428044311745154865.jpg', NULL, '20.03 KB', '306 x 306 pixels', 'admin', 1, 0, 0, '2025-04-20 07:14:25', '2025-04-20 07:14:25'),
(300, 'team217010720911742804432.jpg', 'team2170107209117428044321745154865.jpg', NULL, '19.29 KB', '306 x 306 pixels', 'admin', 1, 0, 0, '2025-04-20 07:14:25', '2025-04-20 07:14:25'),
(301, 'team417010720911742804431.jpg', 'team4170107209117428044311745154865.jpg', NULL, '16.93 KB', '306 x 306 pixels', 'admin', 1, 0, 0, '2025-04-20 07:14:25', '2025-04-20 07:14:25'),
(305, 'banner.png', 'banner1745219736.png', NULL, '82.96 KB', '390 x 524 pixels', 'admin', 1, 0, 0, '2025-04-21 01:15:37', '2025-04-21 01:15:37'),
(306, 'user2.png', 'user21745219841.png', NULL, '188.66 KB', '407 x 612 pixels', 'admin', 1, 0, 0, '2025-04-21 01:17:21', '2025-04-21 01:17:21'),
(307, 'see-profile-gentlema-11563886739l6i9igwwuz-removebg-preview.png', 'see-profile-gentlema-11563886739l6i9igwwuz-removebg-preview1745219943.png', NULL, '195.51 KB', '494 x 505 pixels', 'admin', 1, 0, 0, '2025-04-21 01:19:03', '2025-04-21 01:19:03'),
(308, 'young-adult-enjoying-virtual-date-removebg-preview.png', 'young-adult-enjoying-virtual-date-removebg-preview1745220059.png', NULL, '262.68 KB', '408 x 612 pixels', 'admin', 1, 0, 0, '2025-04-21 01:20:59', '2025-04-21 01:20:59'),
(309, 'login.jpeg', 'login1745220815.jpeg', NULL, '219.64 KB', '940 x 788 pixels', 'admin', 1, 0, 0, '2025-04-21 01:33:35', '2025-04-21 01:33:35'),
(310, '1744111720-67f50868856f6.png', '1744111720-67f50868856f61745222950.png', NULL, '460.05 KB', '750 x 410 pixels', 'web', 5, 0, 0, '2025-04-21 02:09:11', '2025-04-21 02:09:11'),
(311, '1707080486-65bffb26c050b.jpg', '1707080486-65bffb26c050b1745222964.jpg', NULL, '149.54 KB', '910 x 484 pixels', 'web', 5, 0, 0, '2025-04-21 02:09:24', '2025-04-21 02:09:24'),
(312, '1704527511-65990697e1610.jpg', '1704527511-65990697e16101745222964.jpg', NULL, '228.67 KB', '1079 x 576 pixels', 'web', 5, 0, 0, '2025-04-21 02:09:24', '2025-04-21 02:09:24'),
(313, '1703753312-658d36602d639.jpg', '1703753312-658d36602d6391745222964.jpg', NULL, '237.03 KB', '1014 x 582 pixels', 'web', 5, 0, 0, '2025-04-21 02:09:24', '2025-04-21 02:09:24'),
(314, '1699185334-654782b6ed9e9.png', '1699185334-654782b6ed9e91745222964.png', NULL, '175.75 KB', '1770 x 960 pixels', 'web', 5, 0, 0, '2025-04-21 02:09:24', '2025-04-21 02:09:24'),
(315, '1699184794-6547809aeeaca.png', '1699184794-6547809aeeaca1745222964.png', NULL, '305.16 KB', '1770 x 960 pixels', 'web', 5, 0, 0, '2025-04-21 02:09:24', '2025-04-21 02:09:24'),
(316, '1699168234-65473feae005f.png', '1699168234-65473feae005f1745222964.png', NULL, '167.99 KB', '1770 x 960 pixels', 'web', 5, 0, 0, '2025-04-21 02:09:24', '2025-04-21 02:09:24'),
(324, 'make-research-and-find-instagram-influencer.jpg', 'make-research-and-find-instagram-influencer1745390281.jpg', NULL, '69.28 KB', '680 x 409 pixels', 'web', 5, 0, 0, '2025-04-23 00:38:01', '2025-04-23 00:38:01'),
(325, 'promote-you-on-my-10500-plus-linkedin-connections (2).jpg', 'promote-you-on-my-10500-plus-linkedin-connections (2)1745391367.jpg', NULL, '176.04 KB', '680 x 383 pixels', 'web', 5, 0, 0, '2025-04-23 00:56:07', '2025-04-23 00:56:07'),
(326, 'find-best-instagram-tiktok-and-youtube-influencer-list.png', 'find-best-instagram-tiktok-and-youtube-influencer-list1745404586.png', NULL, '214.97 KB', '680 x 400 pixels', 'web', 5, 0, 0, '2025-04-23 04:36:26', '2025-04-23 04:36:26'),
(327, '4.jpg', '41745405618.jpg', NULL, '110.5 KB', '996 x 664 pixels', 'web', 5, 0, 0, '2025-04-23 04:53:38', '2025-04-23 04:53:38'),
(328, 'skin-care4.png', 'skin-care4.png', NULL, '2.15 MB', '1536 x 1024 pixels', 'web', 5, 0, 0, '2025-04-23 05:27:20', '2025-04-23 05:27:20'),
(329, 'parenting_pinterest_promo_680x410.jpg', 'parenting_pinterest_promo_680x4101745408437.jpg', NULL, '45.11 KB', '680 x 410 pixels', 'web', 5, 0, 0, '2025-04-23 05:40:37', '2025-04-23 05:40:37'),
(330, 'skin-care-5.png', 'skin-care-5.png', NULL, '2.15 MB', '1536 x 1024 pixels', 'web', 5, 0, 0, '2025-04-24 01:09:18', '2025-04-24 01:09:18'),
(332, 'skincare.png', 'skincare1745485454.png', NULL, '498.12 KB', '680 x 453 pixels', 'web', 5, 0, 0, '2025-04-24 03:04:14', '2025-04-24 03:04:14'),
(333, 'home_decor_influencer_collab_680x454.png', 'home_decor_influencer_collab_680x4541745487180.png', NULL, '461.32 KB', '680 x 454 pixels', 'web', 5, 0, 0, '2025-04-24 03:33:00', '2025-04-24 03:33:00'),
(334, 'lifestyle.png', 'lifestyle1745488706.png', NULL, '2.82 MB', '1536 x 1024 pixels', 'web', 5, 0, 0, '2025-04-24 03:58:27', '2025-04-24 03:58:27'),
(335, 'file (2).jpg', 'file (2)1745490156.jpg', NULL, '93.97 KB', '303 x 454 pixels', 'web', 5, 0, 0, '2025-04-24 04:22:36', '2025-04-24 04:22:36'),
(336, 'file (1).jpg', 'file (1)1745490156.jpg', NULL, '158.22 KB', '680 x 453 pixels', 'web', 5, 0, 0, '2025-04-24 04:22:36', '2025-04-24 04:22:36'),
(337, 'file.jpg', 'file1745490157.jpg', NULL, '81.62 KB', '303 x 454 pixels', 'web', 5, 0, 0, '2025-04-24 04:22:37', '2025-04-24 04:22:37'),
(338, 'life.jpg', 'life1745491572.jpg', NULL, '242.5 KB', '680 x 453 pixels', 'web', 5, 0, 0, '2025-04-24 04:46:12', '2025-04-24 04:46:12'),
(339, 'life1.jpg', 'life11745491572.jpg', NULL, '274.98 KB', '680 x 453 pixels', 'web', 5, 0, 0, '2025-04-24 04:46:12', '2025-04-24 04:46:12'),
(340, 'life2.jpg', 'life21745491572.jpg', NULL, '235.67 KB', '680 x 453 pixels', 'web', 5, 0, 0, '2025-04-24 04:46:12', '2025-04-24 04:46:12'),
(341, 'life3.jpg', 'life31745491572.jpg', NULL, '354.84 KB', '680 x 540 pixels', 'web', 5, 0, 0, '2025-04-24 04:46:12', '2025-04-24 04:46:12'),
(342, 'life4.jpg', 'life41745491572.jpg', NULL, '300.35 KB', '680 x 458 pixels', 'web', 5, 0, 0, '2025-04-24 04:46:12', '2025-04-24 04:46:12'),
(343, 'fashon-2.jpg', 'fashon-21745494780.jpg', NULL, '312.88 KB', '680 x 453 pixels', 'web', 5, 0, 0, '2025-04-24 05:39:40', '2025-04-24 05:39:40'),
(344, 'fashon-1.jpg', 'fashon-11745494780.jpg', NULL, '302.62 KB', '680 x 453 pixels', 'web', 5, 0, 0, '2025-04-24 05:39:40', '2025-04-24 05:39:40'),
(345, 'fashon-3.jpg', 'fashon-31745494781.jpg', NULL, '271.72 KB', '680 x 453 pixels', 'web', 5, 0, 0, '2025-04-24 05:39:41', '2025-04-24 05:39:41'),
(346, 'file (2).jpg', 'file (2)1745500478.jpg', NULL, '198.9 KB', '680 x 453 pixels', 'web', 5, 0, 0, '2025-04-24 07:14:38', '2025-04-24 07:14:38'),
(347, 'file (1).jpg', 'file (1)1745500478.jpg', NULL, '352.74 KB', '680 x 512 pixels', 'web', 5, 0, 0, '2025-04-24 07:14:38', '2025-04-24 07:14:38'),
(348, 'file.jpg', 'file1745500478.jpg', NULL, '127.81 KB', '680 x 494 pixels', 'web', 5, 0, 0, '2025-04-24 07:14:38', '2025-04-24 07:14:38'),
(349, 'file (3).jpg', 'file (3)1745500478.jpg', NULL, '212.53 KB', '680 x 453 pixels', 'web', 5, 0, 0, '2025-04-24 07:14:38', '2025-04-24 07:14:38'),
(350, 'file (2).jpg', 'file (2)1745501977.jpg', NULL, '204.88 KB', '680 x 453 pixels', 'web', 5, 0, 0, '2025-04-24 07:39:37', '2025-04-24 07:39:37'),
(351, 'file (1).jpg', 'file (1)1745501977.jpg', NULL, '214.87 KB', '680 x 510 pixels', 'web', 5, 0, 0, '2025-04-24 07:39:37', '2025-04-24 07:39:37'),
(352, 'file.jpg', 'file1745501977.jpg', NULL, '267.76 KB', '680 x 628 pixels', 'web', 5, 0, 0, '2025-04-24 07:39:37', '2025-04-24 07:39:37'),
(353, 'file-1.jpg', 'file-11745727254.jpg', NULL, '236.63 KB', '680 x 465 pixels', 'web', 5, 0, 0, '2025-04-26 22:14:14', '2025-04-26 22:14:14'),
(354, 'file2.jpg', 'file21745727254.jpg', NULL, '295.3 KB', '680 x 454 pixels', 'web', 5, 0, 0, '2025-04-26 22:14:14', '2025-04-26 22:14:14'),
(355, 'travel-1.jpg', 'travel-11745728517.jpg', NULL, '113.7 KB', '740 x 740 pixels', 'web', 5, 0, 0, '2025-04-26 22:35:17', '2025-04-26 22:35:17'),
(356, 'travel-2.jpg', 'travel-21745728517.jpg', NULL, '130.93 KB', '996 x 660 pixels', 'web', 5, 0, 0, '2025-04-26 22:35:17', '2025-04-26 22:35:17'),
(357, 'travel-3.jpg', 'travel-31745728517.jpg', NULL, '106.77 KB', '996 x 664 pixels', 'web', 5, 0, 0, '2025-04-26 22:35:17', '2025-04-26 22:35:17'),
(358, 'travel-4.jpg', 'travel-41745728517.jpg', NULL, '170.41 KB', '1380 x 773 pixels', 'web', 5, 0, 0, '2025-04-26 22:35:17', '2025-04-26 22:35:17'),
(359, 'travel-3.jpg', 'travel-31745731658.jpg', NULL, '106.77 KB', '996 x 664 pixels', 'web', 3, 0, 0, '2025-04-26 23:27:38', '2025-04-26 23:27:38'),
(360, 'travel-2.jpg', 'travel-21745731658.jpg', NULL, '130.93 KB', '996 x 660 pixels', 'web', 3, 0, 0, '2025-04-26 23:27:38', '2025-04-26 23:27:38'),
(361, 'travel- file.jpg', 'travel- file1745731658.jpg', NULL, '453.65 KB', '680 x 680 pixels', 'web', 3, 0, 0, '2025-04-26 23:27:38', '2025-04-26 23:27:38'),
(362, 'travel-1.jpg', 'travel-11745731658.jpg', NULL, '113.7 KB', '740 x 740 pixels', 'web', 3, 0, 0, '2025-04-26 23:27:38', '2025-04-26 23:27:38'),
(363, 'file-1.jpg', 'file-11745731658.jpg', NULL, '236.63 KB', '680 x 465 pixels', 'web', 3, 0, 0, '2025-04-26 23:27:38', '2025-04-26 23:27:38'),
(364, 'file2.jpg', 'file21745731658.jpg', NULL, '295.3 KB', '680 x 454 pixels', 'web', 3, 0, 0, '2025-04-26 23:27:38', '2025-04-26 23:27:38'),
(365, 'street- file.jpg', 'street- file1745731658.jpg', NULL, '276.49 KB', '680 x 381 pixels', 'web', 3, 0, 0, '2025-04-26 23:27:38', '2025-04-26 23:27:38'),
(366, 'street-file-3.jpg', 'street-file-31745731658.jpg', NULL, '441.7 KB', '680 x 680 pixels', 'web', 3, 0, 0, '2025-04-26 23:27:38', '2025-04-26 23:27:38'),
(367, 'street-file2.jpg', 'street-file21745731658.jpg', NULL, '446.12 KB', '680 x 680 pixels', 'web', 3, 0, 0, '2025-04-26 23:27:38', '2025-04-26 23:27:38'),
(368, 'file (1)1745500478.jpg', 'file (1)17455004781745732611.jpg', NULL, '83.37 KB', '680 x 512 pixels', 'web', 3, 0, 0, '2025-04-26 23:43:31', '2025-04-26 23:43:31'),
(369, 'tech-3.jpg', 'tech-31745732611.jpg', NULL, '68.97 KB', '1380 x 773 pixels', 'web', 3, 0, 0, '2025-04-26 23:43:31', '2025-04-26 23:43:31'),
(370, 'file (2)1745500478.jpg', 'file (2)17455004781745732611.jpg', NULL, '42.24 KB', '680 x 453 pixels', 'web', 3, 0, 0, '2025-04-26 23:43:31', '2025-04-26 23:43:31'),
(371, 'recipe.jpg', 'recipe1745734054.jpg', NULL, '306.71 KB', '680 x 382 pixels', 'web', 3, 0, 0, '2025-04-27 00:07:34', '2025-04-27 00:07:34'),
(372, 'recipe2.jpg', 'recipe21745734054.jpg', NULL, '185.82 KB', '680 x 453 pixels', 'web', 3, 0, 0, '2025-04-27 00:07:34', '2025-04-27 00:07:34'),
(373, 'receipe-3.jpg', 'receipe-31745734054.jpg', NULL, '229.5 KB', '680 x 359 pixels', 'web', 3, 0, 0, '2025-04-27 00:07:34', '2025-04-27 00:07:34'),
(374, 'finance1.jpg', 'finance11745735261.jpg', NULL, '224.57 KB', '680 x 389 pixels', 'web', 3, 0, 0, '2025-04-27 00:27:41', '2025-04-27 00:27:41'),
(375, 'finance2.jpg', 'finance21745735261.jpg', NULL, '287.95 KB', '680 x 389 pixels', 'web', 3, 0, 0, '2025-04-27 00:27:41', '2025-04-27 00:27:41'),
(376, 'finance3.jpg', 'finance31745735261.jpg', NULL, '168.87 KB', '680 x 381 pixels', 'web', 3, 0, 0, '2025-04-27 00:27:41', '2025-04-27 00:27:41'),
(377, 'smart-home-2.jpg', 'smart-home-21745739968.jpg', NULL, '237.11 KB', '680 x 381 pixels', 'web', 3, 0, 0, '2025-04-27 01:46:08', '2025-04-27 01:46:08'),
(378, 'smart-home-3.jpg', 'smart-home-31745739968.jpg', NULL, '332.79 KB', '680 x 680 pixels', 'web', 3, 0, 0, '2025-04-27 01:46:08', '2025-04-27 01:46:08'),
(379, 'smart-home.jpg', 'smart-home1745739968.jpg', NULL, '225.77 KB', '680 x 381 pixels', 'web', 3, 0, 0, '2025-04-27 01:46:08', '2025-04-27 01:46:08'),
(380, 'fashon-11745494780.jpg', 'fashon-117454947801745742308.jpg', NULL, '73.47 KB', '680 x 453 pixels', 'web', 3, 0, 0, '2025-04-27 02:25:08', '2025-04-27 02:25:08'),
(381, 'lifestyle-3.jpg', 'lifestyle-31745742308.jpg', NULL, '267.02 KB', '680 x 453 pixels', 'web', 3, 0, 0, '2025-04-27 02:25:08', '2025-04-27 02:25:08'),
(382, 'life-style-2.jpg', 'life-style-21745742308.jpg', NULL, '581.27 KB', '680 x 1021 pixels', 'web', 3, 0, 0, '2025-04-27 02:25:08', '2025-04-27 02:25:08'),
(383, 'about-us-1.png', 'about-us-11745899076.png', NULL, '138.61 KB', '940 x 788 pixels', 'admin', 1, 0, 0, '2025-04-28 21:57:56', '2025-04-28 21:57:56'),
(384, 'what-we-do.png', 'what-we-do1745899534.png', NULL, '1.32 MB', '1296 x 700 pixels', 'admin', 1, 0, 0, '2025-04-28 22:05:34', '2025-04-28 22:05:34'),
(385, 'tech-3.jpg', 'tech-31745924242.jpg', NULL, '68.97 KB', '1380 x 773 pixels', 'web', 4, 0, 0, '2025-04-29 04:57:22', '2025-04-29 04:57:22'),
(386, 'link-1.jpg', 'link-11745924588.jpg', NULL, '56.04 KB', '680 x 383 pixels', 'web', 4, 0, 0, '2025-04-29 05:03:08', '2025-04-29 05:03:08'),
(387, 'file-11745727254.jpg', 'file-117457272541745925309.jpg', NULL, '62.84 KB', '680 x 465 pixels', 'web', 4, 0, 0, '2025-04-29 05:15:09', '2025-04-29 05:15:09'),
(388, 'file21745727254.jpg', 'file217457272541745925309.jpg', NULL, '72.18 KB', '680 x 454 pixels', 'web', 4, 0, 0, '2025-04-29 05:15:09', '2025-04-29 05:15:09'),
(389, 'logo-workeet-blue17336713011738131293.svg', 'logo-workeet-blue173367130117381312931745992495.svg', NULL, '', '', 'admin', 1, 0, 0, '2025-04-29 23:54:55', '2025-04-29 23:54:55'),
(390, 'site-logo.png', 'site-logo1745992719.png', NULL, '2.33 KB', '141 x 30 pixels', 'admin', 1, 0, 0, '2025-04-29 23:58:39', '2025-04-29 23:58:39'),
(391, 'iyzipay14.svg', 'iyzipay141745996756.svg', NULL, '', '', 'admin', 1, 0, 0, '2025-04-30 01:05:56', '2025-04-30 01:05:56'),
(392, 'awd36.png', 'awd361745999239.png', NULL, '44.38 KB', '764 x 193 pixels', 'admin', 1, 0, 0, '2025-04-30 01:47:19', '2025-04-30 01:47:19'),
(393, 'toybppay.png', 'toybppay1746000102.png', NULL, '1.1 KB', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-04-30 02:01:42', '2025-04-30 02:01:42'),
(394, 'ssl.png', 'ssl1746000283.png', NULL, '3.56 KB', '462 x 100 pixels', 'admin', 1, 0, 0, '2025-04-30 02:04:43', '2025-04-30 02:04:43'),
(395, 'xendit1.png', 'xendit11746003003.png', NULL, '29.15 KB', '1266 x 335 pixels', 'admin', 1, 0, 0, '2025-04-30 02:50:03', '2025-04-30 02:50:03'),
(396, 'logo.png', 'logo1750568969.png', NULL, '2.11 KB', '137 x 31 pixels', 'admin', 1, 0, 0, '2025-06-21 23:09:29', '2025-06-21 23:09:29'),
(397, 'Footer-Logo.png', 'Footer-Logo1750569021.png', NULL, '1.37 KB', '137 x 31 pixels', 'admin', 1, 0, 0, '2025-06-21 23:10:21', '2025-06-21 23:10:21'),
(398, 'internet-antenna-01.png', 'internet-antenna-011750569046.png', NULL, '1.22 KB', '34 x 34 pixels', 'admin', 1, 0, 0, '2025-06-21 23:10:46', '2025-06-21 23:10:46'),
(399, 'Image.png', 'Image1750574018.png', NULL, '619.42 KB', '799 x 762 pixels', 'admin', 1, 0, 0, '2025-06-22 00:33:38', '2025-06-22 00:33:38'),
(400, 'banner-bg.png', 'banner-bg1750574461.png', NULL, '25.69 KB', '1920 x 861 pixels', 'admin', 1, 0, 0, '2025-06-22 00:41:01', '2025-06-22 00:41:01'),
(401, 'market-palce1.png', 'market-palce11750649409.png', NULL, '8.92 KB', '200 x 200 pixels', 'admin', 1, 0, 0, '2025-06-22 21:30:09', '2025-06-22 21:30:09'),
(402, 'market-palce3.png', 'market-palce31750649452.png', NULL, '11.37 KB', '201 x 200 pixels', 'admin', 1, 0, 0, '2025-06-22 21:30:52', '2025-06-22 21:30:52'),
(403, 'market-palce2.png', 'market-palce21750649452.png', NULL, '9.12 KB', '201 x 200 pixels', 'admin', 1, 0, 0, '2025-06-22 21:30:52', '2025-06-22 21:30:52'),
(404, 'market-palce4.png', 'market-palce41750649452.png', NULL, '9.84 KB', '200 x 200 pixels', 'admin', 1, 0, 0, '2025-06-22 21:30:52', '2025-06-22 21:30:52'),
(405, 'arrow-right-up.png', 'arrow-right-up1750649521.png', NULL, '854 ', '71 x 18 pixels', 'admin', 1, 0, 0, '2025-06-22 21:32:01', '2025-06-22 21:32:01'),
(406, 'arrow-right-down.png', 'arrow-right-down1750649521.png', NULL, '809 ', '71 x 18 pixels', 'admin', 1, 0, 0, '2025-06-22 21:32:01', '2025-06-22 21:32:01'),
(407, 'earth.png', 'earth1750657833.png', NULL, '520 ', '24 x 25 pixels', 'admin', 1, 0, 0, '2025-06-22 23:50:33', '2025-06-22 23:50:33'),
(408, 'analytics-up.png', 'analytics-up1750657833.png', NULL, '513 ', '24 x 25 pixels', 'admin', 1, 0, 0, '2025-06-22 23:50:33', '2025-06-22 23:50:33'),
(409, 'webhook.png', 'webhook1750657833.png', NULL, '444 ', '24 x 25 pixels', 'admin', 1, 0, 0, '2025-06-22 23:50:33', '2025-06-22 23:50:33'),
(410, 'promotion.png', 'promotion1750657833.png', NULL, '432 ', '24 x 25 pixels', 'admin', 1, 0, 0, '2025-06-22 23:50:33', '2025-06-22 23:50:33'),
(411, 'medal-04.png', 'medal-041750657933.png', NULL, '442 ', '24 x 25 pixels', 'admin', 1, 0, 0, '2025-06-22 23:52:13', '2025-06-22 23:52:13'),
(412, 'police-badge.png', 'police-badge1750658097.png', NULL, '492 ', '24 x 25 pixels', 'admin', 1, 0, 0, '2025-06-22 23:54:57', '2025-06-22 23:54:57'),
(413, 'ice-cubes.png', 'ice-cubes1750658738.png', NULL, '918 ', '34 x 34 pixels', 'admin', 1, 0, 0, '2025-06-23 00:05:38', '2025-06-23 00:05:38'),
(414, 'bounding-box.png', 'bounding-box1750658738.png', NULL, '1.12 KB', '34 x 34 pixels', 'admin', 1, 0, 0, '2025-06-23 00:05:38', '2025-06-23 00:05:38'),
(415, 'internet-antenna-01.png', 'internet-antenna-011750658738.png', NULL, '1.22 KB', '34 x 34 pixels', 'admin', 1, 0, 0, '2025-06-23 00:05:38', '2025-06-23 00:05:38'),
(416, 'user-group.png', 'user-group1750658738.png', NULL, '1.01 KB', '34 x 34 pixels', 'admin', 1, 0, 0, '2025-06-23 00:05:38', '2025-06-23 00:05:38'),
(419, 'image.png', 'image1750669629.png', NULL, '316.94 KB', '548 x 597 pixels', 'admin', 1, 0, 0, '2025-06-23 03:07:10', '2025-06-23 03:07:10'),
(420, 'about-us.png', 'about-us1751282775.png', NULL, '1.43 MB', '1320 x 596 pixels', 'admin', 1, 0, 0, '2025-06-30 05:26:15', '2025-06-30 05:26:15'),
(421, 'success-stories.png', 'success-stories1751282909.png', NULL, '348.52 KB', '559 x 361 pixels', 'admin', 1, 0, 0, '2025-06-30 05:28:29', '2025-06-30 05:28:29'),
(422, 'calendar-03.png', 'calendar-031751284107.png', NULL, '502 ', '30 x 30 pixels', 'admin', 1, 0, 0, '2025-06-30 05:48:27', '2025-06-30 05:48:27'),
(423, 'ice-cubes.png', 'ice-cubes1751284107.png', NULL, '558 ', '30 x 30 pixels', 'admin', 1, 0, 0, '2025-06-30 05:48:27', '2025-06-30 05:48:27'),
(424, 'user-03.png', 'user-031751284107.png', NULL, '477 ', '30 x 30 pixels', 'admin', 1, 0, 0, '2025-06-30 05:48:27', '2025-06-30 05:48:27'),
(425, 'user-group.png', 'user-group1751284107.png', NULL, '550 ', '30 x 30 pixels', 'admin', 1, 0, 0, '2025-06-30 05:48:27', '2025-06-30 05:48:27'),
(426, 'vision.png', 'vision1751285958.png', NULL, '539.07 KB', '646 x 430 pixels', 'admin', 1, 0, 0, '2025-06-30 06:19:18', '2025-06-30 06:19:18'),
(427, 'mission-wraper.png', 'mission-wraper1751285958.png', NULL, '529.26 KB', '646 x 434 pixels', 'admin', 1, 0, 0, '2025-06-30 06:19:18', '2025-06-30 06:19:18'),
(428, 'stripe1742975362.png', 'stripe17429753621751453408.png', NULL, '1.26 KB', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-07-02 04:50:08', '2025-07-02 04:50:08'),
(429, 'stripe17429753621751453408.png', 'stripe174297536217514534081751453451.png', NULL, '1.26 KB', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-07-02 04:50:51', '2025-07-02 04:50:51'),
(430, 'stripe17429753621751453408.png', 'stripe174297536217514534081751455079.png', NULL, '1.26 KB', '60 x 40 pixels', 'admin', 1, 0, 0, '2025-07-02 05:17:59', '2025-07-02 05:17:59'),
(431, '153657144_110a594b-0bf1-4ef2-a370-c9abdc902ef1.jpg', '153657144_110a594b-0bf1-4ef2-a370-c9abdc902ef11751976462.jpg', NULL, '881.02 KB', '4500 x 3000 pixels', 'admin', 1, 0, 0, '2025-07-08 06:07:43', '2025-07-08 06:07:43'),
(432, '15.png', '151752045119.png', NULL, '163.16 KB', '390 x 235 pixels', 'web', 9, 0, 0, '2025-07-09 01:11:59', '2025-07-09 01:11:59'),
(433, '16.png', '161752045333.png', NULL, '130.13 KB', '390 x 235 pixels', 'web', 9, 0, 0, '2025-07-09 01:15:33', '2025-07-09 01:15:33'),
(434, '17.png', '171752045378.png', NULL, '138.3 KB', '390 x 235 pixels', 'web', 9, 0, 0, '2025-07-09 01:16:18', '2025-07-09 01:16:18'),
(435, '490cd33b77e718bdcbe9686fc2d1293c0ca102cd.jpg', '490cd33b77e718bdcbe9686fc2d1293c0ca102cd1752057166.jpg', NULL, '5.1 MB', '4096 x 2304 pixels', 'web', 9, 0, 0, '2025-07-09 04:32:47', '2025-07-09 04:32:47'),
(436, '15.png', '151752057538.png', NULL, '650.48 KB', '750 x 450 pixels', 'web', 9, 0, 0, '2025-07-09 04:38:58', '2025-07-09 04:38:58'),
(437, '490cd33b77e718bdcbe9686fc2d1293c0ca102cd.jpg', '490cd33b77e718bdcbe9686fc2d1293c0ca102cd1752057932.jpg', NULL, '5.1 MB', '4096 x 2304 pixels', 'web', 5, 0, 0, '2025-07-09 04:45:32', '2025-07-09 04:45:32'),
(438, 'p1.jpg', 'p11752058138.jpg', NULL, '2 MB', '1500 x 1001 pixels', 'web', 5, 0, 0, '2025-07-09 04:48:58', '2025-07-09 04:48:58'),
(439, 'p3.jpg', 'p31752058144.jpg', NULL, '6.63 MB', '4096 x 2731 pixels', 'web', 5, 0, 0, '2025-07-09 04:49:05', '2025-07-09 04:49:05'),
(440, '490cd33b77e718bdcbe9686fc2d1293c0ca102cd.jpg', '490cd33b77e718bdcbe9686fc2d1293c0ca102cd1752058155.jpg', NULL, '5.1 MB', '4096 x 2304 pixels', 'web', 5, 0, 0, '2025-07-09 04:49:16', '2025-07-09 04:49:16'),
(441, 'p2.jpg', 'p21752058197.jpg', NULL, '4.71 MB', '3772 x 2518 pixels', 'web', 5, 0, 0, '2025-07-09 04:49:58', '2025-07-09 04:49:58'),
(442, 'p4.jpg', 'p41752122129.jpg', NULL, '1.92 MB', '3748 x 2500 pixels', 'web', 4, 0, 0, '2025-07-09 22:35:30', '2025-07-09 22:35:30'),
(443, 'p5.jpg', 'p51752122138.jpg', NULL, '5.74 MB', '4096 x 2731 pixels', 'web', 4, 0, 0, '2025-07-09 22:35:39', '2025-07-09 22:35:39'),
(444, 'p6.jpg', 'p61752122145.jpg', NULL, '5.17 MB', '4096 x 2731 pixels', 'web', 4, 0, 0, '2025-07-09 22:35:46', '2025-07-09 22:35:46'),
(445, 'p10.jpg', 'p101752123532.jpg', NULL, '4.69 MB', '4096 x 2732 pixels', 'web', 5, 0, 0, '2025-07-09 22:58:53', '2025-07-09 22:58:53'),
(446, 'p9.jpg', 'p91752123541.jpg', NULL, '7.58 MB', '4096 x 2734 pixels', 'web', 5, 0, 0, '2025-07-09 22:59:01', '2025-07-09 22:59:01'),
(447, 'p6.jpg', 'p61752123550.jpg', NULL, '5.17 MB', '4096 x 2731 pixels', 'web', 5, 0, 0, '2025-07-09 22:59:10', '2025-07-09 22:59:10'),
(448, 'p7.jpg', 'p71752123559.jpg', NULL, '9.07 MB', '4096 x 2731 pixels', 'web', 5, 0, 0, '2025-07-09 22:59:20', '2025-07-09 22:59:20'),
(449, 'p8.jpg', 'p81752123571.jpg', NULL, '6.06 MB', '4096 x 2725 pixels', 'web', 5, 0, 0, '2025-07-09 22:59:32', '2025-07-09 22:59:32'),
(450, 'p11.jpg', 'p111752124362.jpg', NULL, '7.3 MB', '4096 x 2730 pixels', 'web', 5, 0, 0, '2025-07-09 23:12:43', '2025-07-09 23:12:43'),
(451, 'p12.jpg', 'p121752124370.jpg', NULL, '1.38 MB', '3763 x 2500 pixels', 'web', 5, 0, 0, '2025-07-09 23:12:51', '2025-07-09 23:12:51'),
(452, 'p13.jpg', 'p131752124379.jpg', NULL, '4.6 MB', '4096 x 2732 pixels', 'web', 5, 0, 0, '2025-07-09 23:12:59', '2025-07-09 23:12:59'),
(453, 'p14.jpg', 'p141752124386.jpg', NULL, '7.43 MB', '4096 x 2730 pixels', 'web', 5, 0, 0, '2025-07-09 23:13:07', '2025-07-09 23:13:07'),
(454, 'influencer-logo.png', 'influencer-logo1752494517.png', NULL, '1.8 KB', '137 x 31 pixels', 'admin', 1, 0, 0, '2025-07-14 06:01:57', '2025-07-14 06:01:57'),
(455, 'order_attachment_1752551820.jpg', 'order_attachment_17525518201752554032.jpg', NULL, '378.78 KB', '1000 x 667 pixels', 'web', 116, 0, 0, '2025-07-14 22:33:52', '2025-07-14 22:33:52'),
(456, 'beautiful-interior-decorations.jpg', 'beautiful-interior-decorations1752554108.jpg', NULL, '1.23 MB', '6240 x 4160 pixels', 'web', 116, 0, 0, '2025-07-14 22:35:10', '2025-07-14 22:35:10'),
(457, 'beautiful-interior-decorations.jpg', 'beautiful-interior-decorations1752554118.jpg', NULL, '1.23 MB', '6240 x 4160 pixels', 'web', 116, 0, 0, '2025-07-14 22:35:19', '2025-07-14 22:35:19'),
(458, 'modern-styled-entryway.jpg', 'modern-styled-entryway1752554125.jpg', NULL, '9.62 MB', '7000 x 4667 pixels', 'web', 116, 0, 0, '2025-07-14 22:35:27', '2025-07-14 22:35:27'),
(459, '2149427991.jpg', '21494279911752554165.jpg', NULL, '636.99 KB', '667 x 1000 pixels', 'web', 116, 0, 0, '2025-07-14 22:36:05', '2025-07-14 22:36:05'),
(460, '2150794726.jpg', '21507947261752554168.jpg', NULL, '403.32 KB', '667 x 1000 pixels', 'web', 116, 0, 0, '2025-07-14 22:36:08', '2025-07-14 22:36:08'),
(461, '2149427974.jpg', '21494279741752554172.jpg', NULL, '491.97 KB', '667 x 1000 pixels', 'web', 116, 0, 0, '2025-07-14 22:36:12', '2025-07-14 22:36:12'),
(462, '4932179_Indoor_House_1280x720.mp4', '4932179_Indoor_House_1280x7201752554399.mp4', NULL, '', '', 'web', 116, 0, 0, '2025-07-14 22:39:59', '2025-07-14 22:39:59'),
(463, 'hero.png', 'hero1752667844.png', NULL, '425.5 KB', '649 x 733 pixels', 'admin', 1, 0, 0, '2025-07-16 06:10:45', '2025-07-16 06:10:45'),
(464, 'Logo (1).png', 'Logo (1)1752745480.png', NULL, '2.16 KB', '138 x 31 pixels', 'admin', 1, 0, 0, '2025-07-17 03:44:40', '2025-07-17 03:44:40'),
(465, 'Logo (2).png', 'Logo (2)1752746752.png', NULL, '1.9 KB', '138 x 31 pixels', 'admin', 1, 0, 0, '2025-07-17 04:05:52', '2025-07-17 04:05:52'),
(466, 'image 1.png', 'image 11753258004.png', NULL, '20.17 KB', '528 x 528 pixels', 'admin', 1, 0, 0, '2025-07-23 02:06:44', '2025-07-23 02:06:44'),
(467, 'logo.png', 'logo1753258109.png', NULL, '1.08 KB', '135 x 37 pixels', 'admin', 1, 0, 0, '2025-07-23 02:08:29', '2025-07-23 02:08:29'),
(468, 'tv.png', 'tv1753440811.png', NULL, '9.06 KB', '512 x 512 pixels', 'web', 5, 0, 0, '2025-07-25 04:53:31', '2025-07-25 04:53:31'),
(469, '520547310_10163455183804257_6822189103971791135_n.jpg', '520547310_10163455183804257_6822189103971791135_n1753524377.jpg', NULL, '86.25 KB', '520 x 484 pixels', 'web', 5, 0, 0, '2025-07-26 04:06:17', '2025-07-26 04:06:17');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Primary Menu', '[{\"ptype\":\"pages\",\"id\":2,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":12},{\"ptype\":\"custom\",\"id\":3,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Campaigns\",\"purl\":\"@url/campaigns/all\"},{\"ptype\":\"custom\",\"id\":4,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Projects\",\"purl\":\"@url/projects/all\"},{\"ptype\":\"custom\",\"id\":5,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Influencers\",\"purl\":\"@url/talents/all\"},{\"ptype\":\"custom\",\"id\":6,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Pages\",\"purl\":\"#\",\"children\":[{},{},{},{},{},{},{},{},{},{},{},{},{\"ptype\":\"custom\",\"id\":19,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Blog\",\"purl\":\"@url/blogs/all\"},{},{},{\"ptype\":\"custom\",\"id\":21,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Subscriptions\",\"purl\":\"@url/subscriptions/all\"},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{\"ptype\":\"pages\",\"id\":47,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":6},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{\"ptype\":\"pages\",\"id\":89,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":10},{},{},{},{},{},{},{\"ptype\":\"pages\",\"id\":95,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":8},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{}]},{\"ptype\":\"pages\",\"id\":129,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":2}]', 'default', '2024-12-27 04:43:16', '2025-07-25 02:19:55'),
(2, 'Secondary Menu', '[{\"ptype\":\"custom\",\"id\":2,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Home\",\"purl\":\"@url\"},{\"ptype\":\"pages\",\"id\":3,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":2}]', '', '2024-12-27 04:44:55', '2025-05-04 02:46:20'),
(4, 'Social Menu', NULL, '', '2024-12-27 05:31:28', '2025-05-04 02:44:36'),
(5, 'Test Menu', '[{\"ptype\":\"custom\",\"id\":2,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Home\",\"purl\":\"@url\"},{\"ptype\":\"pages\",\"pid\":2,\"id\":2}]', '', '2024-12-28 01:50:31', '2025-05-04 02:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `meta_data`
--

CREATE TABLE `meta_data` (
  `id` bigint UNSIGNED NOT NULL,
  `meta_taggable_id` bigint UNSIGNED NOT NULL,
  `meta_taggable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `facebook_meta_tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `facebook_meta_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_meta_tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `twitter_meta_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meta_data`
--

INSERT INTO `meta_data` (`id`, `meta_taggable_id`, `meta_taggable_type`, `meta_title`, `meta_tags`, `meta_description`, `facebook_meta_tags`, `facebook_meta_description`, `facebook_meta_image`, `twitter_meta_tags`, `twitter_meta_description`, `twitter_meta_image`, `created_at`, `updated_at`) VALUES
(2, 2, 'Modules\\Pages\\Entities\\Page', 'dfgsdfsdf', 'sdfsd sdf,fsdfsdf s,sd fsd sdf', 'sdf sdfsd fsdf', 'sdf sdfsd', 'sdfsdfsd', '8', 'sdf sdfsd f', 'sdf sdfsdf', '5', '2022-12-21 05:30:29', '2024-08-26 05:32:21'),
(4, 2, 'Modules\\Pages\\Entities\\Page', 'dfgsdfsdf', 'sdfsd sdf,fsdfsdf s,sd fsd sdf', 'sdf sdfsd fsdf', 'sdf sdfsd', 'sdfsdfsd', '8', 'sdf sdfsd f', 'sdf sdfsdf', '5', '2022-12-21 07:22:54', '2024-08-26 05:32:21'),
(8, 6, 'Modules\\Pages\\Entities\\Page', 'privacy policy', 'privacy,policy', 'privacy policy', 'asd asd as', 'asd asd asd', NULL, '', '', NULL, '2022-12-28 01:51:07', '2025-07-16 05:31:32'),
(10, 8, 'Modules\\Pages\\Entities\\Page', 'about us', 'about,us', 'about us', '', '', NULL, '', '', NULL, '2023-11-02 06:43:42', '2025-06-30 05:34:33'),
(13, 3, 'Modules\\Blog\\Entities\\BlogPost', 'Empower and Elevate – wellness and self-growth influencer campaign', '', 'Empower and Elevate – wellness and self-growth influencer campaign', '', '', NULL, '', '', NULL, '2023-12-11 04:52:45', '2025-04-29 04:16:16'),
(14, 4, 'Modules\\Blog\\Entities\\BlogPost', 'Extreme experience in eBay research and listings', 'experience', 'Extreme experience in eBay research and listings', '', '', NULL, '', '', NULL, '2023-12-11 04:53:11', '2025-04-29 04:12:47'),
(18, 10, 'Modules\\Pages\\Entities\\Page', '', '', '', '', '', NULL, '', '', NULL, '2024-02-17 03:40:25', '2025-07-16 05:49:40'),
(19, 8, 'Modules\\Blog\\Entities\\BlogPost', 'Glow up your brand with skincare-entric beauty content', '', 'Glow up your brand with skincare-entric beauty content', '', '', NULL, '', '', NULL, '2024-02-20 02:04:44', '2025-04-29 04:22:09'),
(20, 9, 'Modules\\Blog\\Entities\\BlogPost', 'Elevate your brand with authentic fashion influence', '', 'Elevate your brand with authentic fashion influence', '', '', NULL, '', '', NULL, '2024-02-20 02:29:12', '2025-04-29 04:21:10'),
(22, 12, 'Modules\\Pages\\Entities\\Page', 'Home Page', 'home page two', 'Home Page', '', '', NULL, '', '', NULL, '2024-05-12 23:01:35', '2025-02-18 11:24:21'),
(23, 10, 'Modules\\Blog\\Entities\\BlogPost', 'Style your space – home decor influencer collabs', 'style', 'Style your space – home decor influencer collabs', '', '', NULL, '', '', NULL, '2024-06-11 05:17:33', '2025-04-29 04:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_12_06_070148_create_admins_table', 1),
(6, '2022_12_07_111046_create_static_options_table', 2),
(7, '2022_12_07_111908_create_media_uploads_table', 3),
(9, '2022_12_21_081351_create_meta_data_table', 4),
(10, '2022_12_21_075819_create_pages_table', 5),
(11, '2022_12_27_102354_create_menus_table', 6),
(12, '2022_12_29_073650_create_form_builders_table', 7),
(13, '2023_01_14_111350_create_widgets_table', 8),
(15, '2014_10_12_000000_create_users_table', 9),
(16, '2023_01_25_061947_create_countries_table', 10),
(17, '2023_01_25_062042_create_states_table', 10),
(18, '2023_01_25_062051_create_cities_table', 10),
(21, '2023_02_01_105814_create_user_experiences_table', 12),
(22, '2023_02_06_070500_create_user_education_table', 13),
(26, '2023_02_06_104340_create_categories_table', 15),
(27, '2023_02_06_104409_create_sub_categories_table', 15),
(31, '2023_02_08_080702_add_slug_and_image_to_categories_table', 16),
(32, '2023_02_08_080738_add_slug_and_image_to_sub_categories_table', 16),
(33, '2023_02_09_031836_create_skills_table', 17),
(34, '2023_02_12_120227_create_user_works_table', 18),
(35, '2023_02_13_070232_create_user_skills_table', 19),
(36, '2023_02_13_110318_add_hourly_rate_to_users_table', 20),
(38, '2023_02_15_084950_create_identity_verifications_table', 21),
(41, '2023_02_20_062146_add_status_and_is_read_to_identity_verifications_table', 22),
(43, '2023_02_22_102326_add_deleted_at_to_users', 23),
(47, '2023_02_26_072137_create_create_projects_table', 25),
(48, '2023_02_27_060732_create_create_project_attributes_table', 26),
(49, '2023_03_05_045336_add_slug_and_status_to_create_projects', 27),
(51, '2023_03_13_091210_create_portfolios_table', 28),
(52, '2023_03_19_061043_add_timezone_to_states', 29),
(53, '2023_03_19_091240_add_check_online_status_to_users', 30),
(55, '2023_03_19_101455_add_check_work_availability_to_users', 31),
(56, '2023_03_22_065938_add_google_2fa_secret_to_users', 32),
(57, '2023_03_22_085506_add_google_2fa_enable_disable_disable_to_users', 33),
(58, '2023_03_28_090737_create_project_histories_table', 34),
(61, '2023_03_29_034510_add_project_approve_request_to_create_projects', 35),
(62, '2023_04_02_045528_create_admin_notifications_table', 36),
(63, '2023_04_03_083057_create_create_project_sub_categories_table', 37),
(64, '2023_04_04_063804_add_category_id_to_create_projects', 38),
(65, '2023_04_06_022811_create_wallets_table', 39),
(66, '2023_04_06_022826_create_wallet_histories_table', 39),
(76, '2023_04_29_070422_create_subscription_types_table', 43),
(77, '2023_04_29_071804_create_subscription_features_table', 43),
(78, '2023_04_29_072511_create_subscriptions_table', 43),
(79, '2023_05_02_123118_create_page_builders_table', 44),
(80, '2023_05_07_070709_create_languages_table', 45),
(81, '2023_05_15_052137_add_short_description_to_categories', 46),
(82, '2023_05_15_060433_add_short_description_to_sub_categories', 47),
(83, '2023_05_17_072955_add_level_to_users', 48),
(85, '2023_05_30_105849_add_last_apply_date_and_last_seen_to_jobs_table', 49),
(86, '2023_06_01_063633_create_job_histories_table', 50),
(88, '2023_06_07_044153_change_is_read_column_name', 51),
(89, '2023_06_08_034931_rename_subscription_connet_to_limit', 52),
(91, '2023_06_13_044928_add_validatity_to_subscription_types', 53),
(96, '2023_06_17_054259_create_user_subscriptions_table', 54),
(107, '2023_07_10_043726_create_user_earnings_table', 55),
(108, '2023_07_10_075003_create_individual_commission_settings_table', 55),
(145, '2023_07_09_042039_create_orders_table', 56),
(147, '2023_07_26_115750_create_order_decline_histories_table', 56),
(148, '2023_07_26_120317_create_order_decline_wallet_histories_table', 56),
(169, '2023_07_30_063825_create_user_notifications_table', 57),
(170, '2023_07_30_070915_create_order_submit_histories_table', 57),
(171, '2023_08_01_103629_create_order_request_revisions_table', 57),
(174, '2023_08_08_054420_add_revision_left_to_orders_table', 58),
(181, '2023_08_10_043412_create_ratings_table', 59),
(182, '2023_08_10_045939_create_rating_details_table', 59),
(183, '2023_08_21_101229_add_status_before_hold_to_orders_table', 60),
(184, '2023_08_21_101822_add_is_suspend_to_users_table', 60),
(185, '2023_08_27_055736_create_departments_table', 61),
(186, '2023_08_27_060148_create_tickets_table', 61),
(187, '2023_08_27_060349_create_chat_messages_table', 61),
(192, '2023_05_23_165755_create_live_chats_table', 62),
(193, '2023_05_23_165849_create_live_chat_messages_table', 62),
(195, '2023_09_11_094021_create_job_posts_table', 63),
(197, '2023_09_11_111935_create_job_post_sub_categories_table', 64),
(198, '2023_04_17_052446_create_job_skills_table', 65),
(199, '2023_09_11_115123_create_job_post_skills_table', 66),
(204, '2023_09_12_112426_create_job_proposals_table', 67),
(211, '2023_08_02_074726_create_freelancer_notifications_table', 69),
(212, '2023_08_03_115328_create_client_notifications_table', 69),
(213, '2023_10_01_051409_add_revision_to_job_proposals', 70),
(214, '2023_09_24_072604_create_offers_table', 71),
(215, '2023_09_24_072659_create_offer_milestones_table', 71),
(216, '2023_07_13_093714_create_order_milestones_table', 72),
(217, '2023_10_04_125750_add_current_status_to_job_posts', 73),
(218, '2023_10_15_073144_add_remaining_balance_and_withdraw_amount_to_wallets', 74),
(220, '2023_10_15_130310_create_withdraw_gateways_table', 75),
(222, '2023_10_16_122611_create_withdraw_requests_table', 76),
(223, '2023_10_19_092727_create_permission_tables', 77),
(224, '2023_10_19_095329_add_menu_name_to_permissions', 77),
(225, '2020_02_04_010636_create_newsletters_table', 78),
(230, '2023_10_29_115154_create_question_answers_table', 79),
(232, '2023_10_30_082828_create_feedback_table', 80),
(233, '2023_11_09_052611_create_bookmarks_table', 81),
(234, '2023_11_13_090531_create_reports_table', 82),
(235, '2023_12_04_093048_create_xg_ftp_infos_table', 83),
(236, '2023_12_11_062442_create_blog_posts_table', 84),
(241, '2023_12_23_081053_create_freelancer_levels_table', 85),
(242, '2023_12_23_081216_create_freelancer_level_rules_table', 85),
(243, '2024_01_14_091704_add_reject_reason_to_project_histories_table', 86),
(244, '2024_01_29_053338_create_project_promote_settings_table', 87),
(245, '2024_01_31_071706_add_offer_package_available_or_not_to_projects_table', 88),
(247, '2024_02_08_063522_create_promotion_project_lists_table', 89),
(248, '2024_02_14_075240_add_is_valid_payment_promotion_project_lists__table', 90),
(249, '2024_02_14_060336_add_is_pro_and_pro_expire_date_to_projects_table', 91),
(250, '2024_02_15_120132_add_is_valid_payment_to_orders_table', 92),
(251, '2024_02_18_072401_add_note_to_reports_table', 93),
(252, '2024_02_18_150813_create_news_letter_for_emails_table', 94),
(253, '2024_03_05_123836_add_email_verify_token_to_admins', 95),
(254, '2024_03_06_065635_add_firebase_device_token_to_users', 96),
(256, '2024_04_21_131737_create_jobs_table', 97),
(257, '2024_05_01_053357_add_apple_id_to_users_table', 98),
(258, '2024_05_05_100714_add_is_pro_to_users_table', 99),
(259, '2024_05_16_095256_create_words_table', 100),
(260, '2024_05_19_051405_add_freeze_withdraw_and_freeze_project_freeze_job_freeze_order_freeze_chat_to_users', 101),
(262, '2024_05_20_093916_create_log_activities_table', 102),
(263, '2024_06_11_053715_add_meta_title_and_meta_description_to_categories', 103),
(264, '2024_06_11_054044_add_meta_title_and_meta_description_to_sub_categories', 104),
(265, '2024_06_25_052118_add_meta_title_and_meta_description_and_meta_tags_to_projects', 105),
(266, '2024_06_25_053121_add_meta_title_and_meta_description_and_meta_tags_to_job_posts', 105),
(267, '2024_07_03_082447_add_load_from_and_is_synced_to_media_uploads', 106),
(268, '2024_07_06_050745_add_load_from_and_is_synced_to_projects', 107),
(269, '2024_07_07_103341_add_load_from_and_is_synced_to_job_posts', 108),
(270, '2024_07_07_135455_add_load_from_and_is_synced_to_job_proposals', 109),
(271, '2024_07_08_091056_add_load_from_and_is_synced_to_portfolios', 110),
(272, '2024_07_08_113034_add_load_from_and_is_synced_to_users', 111),
(273, '2024_07_09_061732_add_load_from_and_is_synced_to_chat_messages', 112),
(274, '2024_07_11_103143_add_load_from_and_is_synced_to_identity_verifications', 113),
(275, '2024_04_26_034953_create_payment_meta_data_table', 114),
(276, '2024_08_01_035813_add_hourly_rate_and_estimated_hours_to_job_posts', 114),
(277, '2024_08_13_054216_add_email_send_to_wallet_histories', 115),
(278, '2024_08_13_063128_add_email_send_to_orders', 116),
(279, '2024_08_13_063226_add_email_send_to_user_subscriptions', 116),
(280, '2024_08_13_063805_add_email_send_to_promotion_project_lists', 116),
(283, '2024_08_18_080543_create_order_work_histories_table', 117),
(284, '2024_08_27_100524_add_selected_category_to_categories', 118),
(285, '2024_08_28_122807_create_order_screenshots_table', 119),
(286, '2024_08_29_115158_add_load_from_and_is_synced_to_live_chat_messages', 120),
(287, '2024_09_11_043432_change_admins_table_role_default_value', 121),
(288, '2024_09_18_062831_create_lengths_table', 122),
(289, '2024_09_18_080536_create_experience_levels_table', 123),
(290, '2024_09_22_064433_add_order_type_to_orders', 124),
(291, '2023_01_31_111953_create_user_introductions_table', 125),
(293, '2024_10_27_104510_create_social_profiles_table', 126),
(294, '2024_10_27_130433_create_user_langs_table', 127),
(295, '2024_10_28_113008_create_category_users_table', 128),
(296, '2024_10_28_114306_create_sub_category_users_table', 128),
(297, '2024_10_29_120759_add_male_female_to_users', 129),
(298, '2024_11_04_092958_add_video_to_projects', 130),
(299, '2025_02_06_114715_add_default_social_platform_to_social_profiles', 131),
(300, '2025_04_16_051156_add_subscription_highlight_color_to_subscriptions', 131),
(302, '2025_06_30_074154_create_blog_comments_table', 132),
(303, '2025_07_19_172820_add_is_free_to_subscription_types_table', 132),
(304, '2025_08_20_061608_add_phone_otp_verify_with_expiration', 133),
(305, '2025_08_24_091213_add_stripe_columns_to_user_subscriptions_table', 133),
(306, '2025_08_25_051517_add_stripeIds_to_subscription_table', 133),
(307, '2025_08_25_065326_add_stripe_sessionId_to_usersubscription', 133),
(308, '2025_08_25_075629_add_period_start_end_date_to_usersubscription', 133),
(309, '2025_08_25_090406_add_is_recurring_subcription_to_usersubscription', 133),
(310, '2025_08_26_081020_add_target_limit_to_user_subscriptions_table', 133);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news_letter_for_emails`
--

CREATE TABLE `news_letter_for_emails` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint UNSIGNED NOT NULL,
  `freelancer_id` bigint NOT NULL,
  `client_id` bigint NOT NULL,
  `price` double NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `deadline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=pending, 1=active, 2=reject',
  `revision` int NOT NULL DEFAULT '0',
  `revision_left` int NOT NULL DEFAULT '0',
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offer_milestones`
--

CREATE TABLE `offer_milestones` (
  `id` bigint UNSIGNED NOT NULL,
  `offer_id` bigint NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `deadline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=pending, 1=active, 2=complete, 3=cancel',
  `revision` int NOT NULL DEFAULT '0',
  `revision_left` int NOT NULL DEFAULT '0',
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL COMMENT 'client id',
  `freelancer_id` bigint NOT NULL,
  `order_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identity` bigint NOT NULL COMMENT 'project_id or job_id',
  `is_project_job` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'project or job',
  `is_basic_standard_premium_custom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'project type',
  `is_fixed_hourly` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'fixed or hourly',
  `is_custom` tinyint NOT NULL DEFAULT '0' COMMENT '1=custom',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=pending, 1=active, 2=delivered, 3=complete, 4=cancel, 5=decline by frl, 6=suspend by ad, 7=hold by ad',
  `email_send` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_before_hold` tinyint NOT NULL DEFAULT '0' COMMENT '0=not hold , 1=hold',
  `revision` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revision_left` int NOT NULL DEFAULT '0',
  `delivery_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` double NOT NULL,
  `commission_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `commission_charge` double NOT NULL,
  `commission_amount` double NOT NULL DEFAULT '0',
  `transaction_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_charge` double NOT NULL DEFAULT '0',
  `transaction_amount` double NOT NULL DEFAULT '0',
  `payable_amount` double NOT NULL DEFAULT '0',
  `refund_amount` double NOT NULL DEFAULT '0',
  `refund_status` tinyint NOT NULL DEFAULT '0' COMMENT '0=pending, 1=paid',
  `total_hour` double DEFAULT NULL,
  `payment_gateway` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_valid_payment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manual_payment_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_decline_histories`
--

CREATE TABLE `order_decline_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint NOT NULL,
  `freelancer_id` bigint NOT NULL,
  `client_id` bigint NOT NULL,
  `order_price` double NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cancel_or_decline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_decline_histories`
--

INSERT INTO `order_decline_histories` (`id`, `order_id`, `freelancer_id`, `client_id`, `order_price`, `payment_status`, `cancel_or_decline`, `cancel_by`, `created_at`, `updated_at`) VALUES
(1, 14, 8, 2, 50, 'complete', 'decline', 'freelancer', '2024-02-19 03:18:27', '2024-02-19 03:18:27'),
(2, 71, 7, 1, 100, 'complete', 'decline', 'freelancer', '2024-03-05 23:00:35', '2024-03-05 23:00:35'),
(3, 70, 7, 1, 56, 'complete', 'decline', 'freelancer', '2024-03-05 23:07:26', '2024-03-05 23:07:26'),
(4, 122, 7, 1, 100, 'complete', 'decline', 'freelancer', '2024-04-03 00:13:44', '2024-04-03 00:13:44'),
(5, 154, 7, 1, 200, 'complete', 'decline', 'freelancer', '2024-04-23 23:38:55', '2024-04-23 23:38:55'),
(6, 155, 7, 1, 100, 'complete', 'decline', 'freelancer', '2024-04-23 23:42:00', '2024-04-23 23:42:00'),
(7, 111, 7, 1, 400, 'complete', 'decline', 'freelancer', '2024-04-24 01:38:44', '2024-04-24 01:38:44'),
(8, 111, 7, 1, 400, 'complete', 'decline', 'freelancer', '2024-04-24 01:42:15', '2024-04-24 01:42:15'),
(9, 111, 7, 1, 400, 'complete', 'decline sdfsdfsad', 'freelancer', '2024-04-24 02:00:57', '2024-04-24 02:00:57'),
(10, 111, 7, 1, 400, 'complete', 'decline', 'freelancer', '2024-04-24 02:05:28', '2024-04-24 02:05:28'),
(11, 241, 7, 1, 200, 'complete', 'decline', 'freelancer', '2024-08-18 01:57:16', '2024-08-18 01:57:16'),
(12, 383, 5, 1, 2, 'complete', 'decline', 'freelancer', '2025-07-14 21:36:22', '2025-07-14 21:36:22');

-- --------------------------------------------------------

--
-- Table structure for table `order_decline_wallet_histories`
--

CREATE TABLE `order_decline_wallet_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint NOT NULL,
  `freelancer_id` bigint NOT NULL,
  `client_id` bigint NOT NULL,
  `order_price` double NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cancel_or_decline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_milestones`
--

CREATE TABLE `order_milestones` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `deadline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=pending, 1=active, 2=complete, 3=cancel',
  `revision` int NOT NULL DEFAULT '0',
  `revision_left` int NOT NULL DEFAULT '0',
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_request_revisions`
--

CREATE TABLE `order_request_revisions` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint NOT NULL,
  `order_submit_history_id` bigint DEFAULT NULL,
  `milestone_id` int DEFAULT NULL,
  `description` blob,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_screenshots`
--

CREATE TABLE `order_screenshots` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_submit_histories`
--

CREATE TABLE `order_submit_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint NOT NULL,
  `order_milestone_id` bigint DEFAULT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=pending, 1=approve, 2=request revision,',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_work_histories`
--

CREATE TABLE `order_work_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` int NOT NULL,
  `client_id` int NOT NULL,
  `freelancer_id` int NOT NULL,
  `job_id` int DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `only_start_date` date DEFAULT NULL,
  `only_end_date` date DEFAULT NULL,
  `hours_worked` time NOT NULL,
  `seconds` int DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `page_content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `page_builder_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `layout` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breadcrumb_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `navbar_variant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_variant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibility` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT NULL COMMENT '1-active, 0-inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `page_content`, `page_builder_status`, `layout`, `page_class`, `breadcrumb_status`, `navbar_variant`, `footer_variant`, `visibility`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Contact', 'contact-us', '<p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><br></span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><span style=\"display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span></span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span></span></span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\"><br></span></span></span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span></span></span></span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\"><br></span></span></span></span></p><p><span style=\"color: rgb(153, 153, 153); font-family: Manrope, sans-serif; font-size: 15px; font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align); display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\"><span style=\"display: inline !important;\">You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%</span><br></span><br></span><br></span><br></span><br></p>', 'on', 'normal_layout', 'nav-absolute', 'on', '01', '01', 'all', 1, '2024-10-21 07:22:54', '2025-01-26 05:32:21');
INSERT INTO `pages` (`id`, `title`, `slug`, `page_content`, `page_builder_status`, `layout`, `page_class`, `breadcrumb_status`, `navbar_variant`, `footer_variant`, `visibility`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Privacy Policy', 'privacy-policy', '<p style=\"text-align: left; border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important; font-size: 24px;\"><b>Privacy Policy</b></span></p><p style=\"text-align: left; border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px;\" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"display: inline !important;\">Welcome to Influencer, a influence platform dedicated to connecting clients with independent professionals globally. We understand the importance of privacy and are committed to protecting the personal information of our users. This Privacy Policy outlines our practices regarding the collection, use, and disclosure of your information when you use our website and services.</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Please read this policy carefully to understand how we handle your persona<span style=\"font-size: 18px;\">﻿</span>l information.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">1. Information We Collect</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">We may collect the following types of information:</p><ul style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; list-style-position: initial; list-style-image: initial; margin: 1.25em 0px; padding: 0px; display: flex; flex-direction: column; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" 16px;=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><li style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 0px; padding-left: 0.375em; display: block; min-height: 28px;\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold); margin-top: 1.25em; margin-bottom: 1.25em;\">Personal Identification Information:</span> Name, email address, postal address, and other contact details.</li><li style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 0px; padding-left: 0.375em; display: block; min-height: 28px;\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold); margin-top: 1.25em; margin-bottom: 1.25em;\">Professional Information:</span> Resume, work history, educational background, skills, and any other information related to professional qualifications.</li><li style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 0px; padding-left: 0.375em; display: block; min-height: 28px;\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold); margin-top: 1.25em; margin-bottom: 1.25em;\">Financial Information:</span> Payment details, including credit card numbers, bank information, and billing address, which are processed by our secure payment processing partners.</li><li style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 0px; padding-left: 0.375em; display: block; min-height: 28px;\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold); margin-top: 1.25em; margin-bottom: 1.25em;\">Technical Information:</span> IP addresses, browser types, operating system details, device information, and usage data such as website navigation patterns.</li></ul><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">2. How We Use Your Information</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">The information we collect may be used for the following purposes:</p><ul style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; list-style-position: initial; list-style-image: initial; margin: 1.25em 0px; padding: 0px; display: flex; flex-direction: column; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" 16px;=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><li style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 0px; padding-left: 0.375em; display: block; min-height: 28px;\">To facilitate the creation of your account and your access to our services.</li><li style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 0px; padding-left: 0.375em; display: block; min-height: 28px;\">To match clients with suitable freelancers and vice versa.</li><li style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 0px; padding-left: 0.375em; display: block; min-height: 28px;\">To process payments and manage transactions.</li><li style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 0px; padding-left: 0.375em; display: block; min-height: 28px;\">To communicate with you about your account or transactions and to send you updates about our services.</li><li style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 0px; padding-left: 0.375em; display: block; min-height: 28px;\">To improve our website functionality and user experience.</li><li style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 0px; padding-left: 0.375em; display: block; min-height: 28px;\">To comply with legal obligations and enforce our terms and conditions.</li></ul><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">3. Sharing Your Information</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">We may share your information with:</p><ul style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; list-style-position: initial; list-style-image: initial; margin: 1.25em 0px; padding: 0px; display: flex; flex-direction: column; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" 16px;=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><li style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 0px; padding-left: 0.375em; display: block; min-height: 28px;\">Other users of the site when necessary to facilitate service offerings and collaborations.</li><li style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 0px; padding-left: 0.375em; display: block; min-height: 28px;\">Service providers who perform services on our behalf, such as payment processing, data analysis, and email delivery services.</li><li style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 0px; padding-left: 0.375em; display: block; min-height: 28px;\">Law enforcement or other government agencies if required by law or in good faith belief that such action is necessary to comply with legal processes.</li></ul><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">We do not sell, rent, or lease our user lists to third parties for their marketing purposes without your explicit consent.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">4. Data Security</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">We implement reasonable security measures to protect against unauthorized access, alteration, disclosure, or destruction of your personal information. However, no method of transmission over the internet or electronic storage is 100% secure, and we cannot guarantee its absolute security.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">5. Your Rights</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">You have the right to:</p><ul style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; list-style-position: initial; list-style-image: initial; margin: 1.25em 0px; padding: 0px; display: flex; flex-direction: column; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" 16px;=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><li style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 0px; padding-left: 0.375em; display: block; min-height: 28px;\">Access, update, or delete the personal information we have on you.</li><li style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 0px; padding-left: 0.375em; display: block; min-height: 28px;\">Object to the processing of your personal information.</li><li style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 0px; padding-left: 0.375em; display: block; min-height: 28px;\">Request that we restrict the processing of your personal information.</li><li style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 0px; padding-left: 0.375em; display: block; min-height: 28px;\">Withdraw consent at any time where we relied on your consent to process your personal information.</li></ul><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">6. International Transfers</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Your information may be transferred to, and maintained on, computers located outside of your state, province, country, or other governmental jurisdiction where the data protection laws may differ from those of your jurisdiction.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">7. Changes to This Privacy Policy</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page. We encourage you to review this Privacy Policy periodically for any changes.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">8. Contact Us</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">If you have any questions about this Privacy Policy, please contact us:</p><ul style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; list-style-position: initial; list-style-image: initial; margin: 1.25em 0px; padding: 0px; display: flex; flex-direction: column; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" 16px;=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><li style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 0px; padding-left: 0.375em; display: block; min-height: 28px;\">By email: [Insert Email Address]</li><li style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 0px; padding-left: 0.375em; display: block; min-height: 28px;\">By visiting this page on our website: [Insert Privacy Policy Page URL]</li></ul><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">Consent</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">By using our website and services, you consent to the collection, use, and sharing of your personal information as outlined in this Privacy Policy.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-top: 1.25em; margin-right: 0px; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">This Privacy Policy is intended to be a general template and may need to be tailored to comply with the laws of your jurisdiction or to suit the specific operations of your website or application. It is advisable to consult with a legal expert when drafting your actual privacy policy.</p>', NULL, 'normal_layout', 'none', NULL, NULL, '01', 'all', 1, '2024-10-28 01:51:06', '2025-07-16 05:31:32');
INSERT INTO `pages` (`id`, `title`, `slug`, `page_content`, `page_builder_status`, `layout`, `page_class`, `breadcrumb_status`, `navbar_variant`, `footer_variant`, `visibility`, `status`, `created_at`, `updated_at`) VALUES
(8, 'About Us', 'about-us', '<p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">About Us</span></p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Welcome to [Your Freelancing Website Name], where talent meets opportunity.</p><h3 style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: 1.25em; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; line-height: 1.6; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: inherit;\">Our Story</span></h3><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">In the bustling digital age, where connectivity is as simple as a click, we found that the true potential of freelance talent was still untapped. Established in [Year], our platform was born from a simple yet powerful vision: to create a seamless bridge between gifted freelancers and visionary businesses.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">We recognized the hurdles of the gig economy – the uncertainty, the competition, the often-impersonal interactions – and set out to craft a solution that would empower both freelancers and clients alike.</p><h3 style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: 1.25em; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; line-height: 1.6; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: inherit;\">Our Mission</span></h3><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">At [Your Freelancing Website Name], we\'re not just building a marketplace; we\'re cultivating a community. Our mission is to facilitate a professional environment where freelancers can thrive, businesses can innovate, and collaboration can flourish.</p><h3 style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: 1.25em; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; line-height: 1.6; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: inherit;\">Our Values</span></h3><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">Integrity</span>: We believe in honest and transparent communication, ensuring that every interaction on our platform is conducted with the utmost respect and professionalism.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">Innovation</span>: Staying ahead of the curve is in our DNA. We constantly seek out new ways to enhance your experience, simplify processes, and enable success.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">Excellence</span>: Our commitment to quality is unwavering. We meticulously curate our pool of talent and the projects that come through our platform, guaranteeing a standard of excellence that is second to none.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-weight: 600; color: var(--tw-prose-bold);\">Community</span>: We understand the power of connection. That\'s why we foster a supportive network of professionals who share advice, offer mentorship, and help each other grow.</p><h3 style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: 1.25em; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; line-height: 1.6; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: inherit;\">Our Community</span></h3><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Our freelancers are the heartbeat of our platform. They are writers, designers, developers, marketers, consultants, and more – each bringing a unique set of skills and a passion for their craft.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Our clients range from startups to Fortune 500 companies, all seeking the perfect match for their project needs. Together, they span the globe, creating a diverse and dynamic tapestry of cultures and ideas.</p><h3 style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: 1.25em; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; line-height: 1.6; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: inherit;\">Our Promise</span></h3><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">To Freelancers: We promise to provide you with a platform where you can showcase your skills, set your rates, and connect with clients who value what you do.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">To Clients: We promise a curated selection of top-tier freelancers who are not only talented but also reliable and ready to help bring your projects to life.</p><h3 style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: 1.25em; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; line-height: 1.6; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><span style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: inherit;\">Join Us</span></h3><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-bottom: 1.25em; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Whether you\'re a freelancer looking to take your career to new heights or a business in search of the right talent to complete your next project, [Your Freelancing Website Name] is your partner in success. Explore our site, join our community, and let\'s make something incredible together.</p><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin: 1.25em 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">Because here, we believe that when great minds collaborate, the possibilities are endless.</p><hr style=\"border-top-width: 1px; border-style: solid; border-color: var(--tw-prose-hr); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: rgb(55, 65, 81); height: 0px; margin-top: 3em; margin-bottom: 3em; font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" font-size:=\"\" 16px;=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\"><p style=\"border: 0px solid rgb(217, 217, 227); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(69,89,164,.5); --tw-ring-offset-shadow: 0 0 transparent; --tw-ring-shadow: 0 0 transparent; --tw-shadow: 0 0 transparent; --tw-shadow-colored: 0 0 transparent; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; margin-right: 0px; margin-left: 0px; color: rgb(55, 65, 81); font-family: Söhne, ui-sans-serif, system-ui, -apple-system, \" segoe=\"\" ui\",=\"\" roboto,=\"\" ubuntu,=\"\" cantarell,=\"\" \"noto=\"\" sans\",=\"\" sans-serif,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\",=\"\" emoji\";=\"\" white-space-collapse:=\"\" preserve;=\"\" background-color:=\"\" rgb(247,=\"\" 247,=\"\" 248);\"=\"\">This sample is meant to be inspirational and should be customized to align with the specific brand voice, value proposition, and unique selling points of your freelancing website.</p>', 'on', 'normal_layout', 'none', NULL, '01', '01', 'all', 1, '2024-11-02 06:43:42', '2025-06-30 05:34:33');
INSERT INTO `pages` (`id`, `title`, `slug`, `page_content`, `page_builder_status`, `layout`, `page_class`, `breadcrumb_status`, `navbar_variant`, `footer_variant`, `visibility`, `status`, `created_at`, `updated_at`) VALUES
(10, 'Terms Conditions', 'terms-conditions', '<p><br><b><span style=\"font-size: 24px;\">Terms Conditions</span></b><br><br><br>Welcome to Influencer, a freelancing platform dedicated to connecting clients with independent professionals globally. We understand the importance of privacy and are committed to protecting the personal information of our users. This Privacy Policy outlines our practices regarding the collection, use, and disclosure of your information when you use our website and services.<br><br>Please read this policy carefully to understand how we handle your persona﻿l information.<br><br><b>1. Information We Collect</b><br><br>We may collect the following types of information:<br><br>&nbsp;&nbsp;&nbsp; Personal Identification Information: Name, email address, phone number, postal address, and other contact details.<br>&nbsp;&nbsp;&nbsp; Professional Information: Resume, work history, educational background, skills, and any other information related to professional qualifications.<br>&nbsp;&nbsp;&nbsp; Financial Information: Payment details, including credit card numbers, bank information, and billing address, which are processed by our secure payment processing partners.<br>&nbsp;&nbsp;&nbsp; Technical Information: IP addresses, browser types, operating system details, device information, and usage data such as website navigation patterns.<br><br><b>2. How We Use Your Information</b><br><br>The information we collect may be used for the following purposes:<br><br>&nbsp;&nbsp;&nbsp; To facilitate the creation of your account and your access to our services.<br>&nbsp;&nbsp;&nbsp; To match clients with suitable influencers and vice versa.<br>&nbsp;&nbsp;&nbsp; To process payments and manage transactions.<br>&nbsp;&nbsp;&nbsp; To communicate with you about your account or transactions and to send you updates about our services.<br>&nbsp;&nbsp;&nbsp; To improve our website functionality and user experience.<br>&nbsp;&nbsp;&nbsp; To comply with legal obligations and enforce our terms and conditions.<br><br><b>3. Sharing Your Information</b><br><br>We may share your information with:<br><br>Other users of the site when necessary to facilitate service offerings and collaborations.<br>Service providers who perform services on our behalf, such as payment processing, data analysis, and email delivery services.<br>Law enforcement or other government agencies if required by law or in good faith belief that such action is necessary to comply with legal processes.<br><br>We do not sell, rent, or lease our user lists to third parties for their marketing purposes without your explicit consent.<br><br><b>4. Data Security</b><br><br>We implement reasonable security measures to protect against unauthorized access, alteration, disclosure, or destruction of your personal information. However, no method of transmission over the internet or electronic storage is 100% secure, and we cannot guarantee its absolute security.<br><br><b>5. Your Rights</b><br><br>You have the right to:<br><br>&nbsp;&nbsp;&nbsp; Access, update, or delete the personal information we have on you.<br>&nbsp;&nbsp;&nbsp; Object to the processing of your personal information.<br>&nbsp;&nbsp;&nbsp; Request that we restrict the processing of your personal information.<br>&nbsp;&nbsp;&nbsp; Withdraw consent at any time where we relied on your consent to process your personal information.<br><br><b>6. International Transfers</b><br><br>Your information may be transferred to, and maintained on, computers located outside of your state, province, country, or other governmental jurisdiction where the data protection laws may differ from those of your jurisdiction.<br><br><b>7. Changes to This Privacy Policy</b><br><br>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page. We encourage you to review this Privacy Policy periodically for any changes.<br><br><b>8. Contact Us</b><br><br>If you have any questions about this Privacy Policy, please contact us:<br><br>&nbsp;&nbsp;&nbsp; By email: [Insert Email Address]<br>&nbsp;&nbsp;&nbsp; By visiting this page on our website: [Insert Privacy Policy Page URL]<br><br>Consent<br><br>By using our website and services, you consent to the collection, use, and sharing of your personal information as outlined in this Privacy Policy.<br><br>This Privacy Policy is intended to be a general template and may need to be tailored to comply with the laws of your jurisdiction or to suit the specific operations of your website or application. It is advisable to consult with a legal expert when drafting your actual privacy policy.<br><br></p>', NULL, 'normal_layout', 'none', NULL, NULL, '01', 'all', 1, '2024-12-17 03:40:25', '2025-07-16 05:49:40'),
(12, 'Home', 'home-page', NULL, 'on', 'home_page_layout', 'none', NULL, '01', '01', 'all', 1, '2024-12-29 23:01:35', '2025-02-18 11:24:21');

-- --------------------------------------------------------

--
-- Table structure for table `page_builders`
--

CREATE TABLE `page_builders` (
  `id` bigint UNSIGNED NOT NULL,
  `addon_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addon_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addon_namespace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addon_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addon_order` bigint UNSIGNED DEFAULT NULL,
  `addon_page_id` bigint UNSIGNED DEFAULT NULL,
  `addon_page_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addon_settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_builders`
--

INSERT INTO `page_builders` (`id`, `addon_name`, `addon_type`, `addon_namespace`, `addon_location`, `addon_order`, `addon_page_id`, `addon_page_type`, `addon_settings`, `created_at`, `updated_at`) VALUES
(3, 'HeaderStyleOne', 'update', 'plugins\\PageBuilder\\Addons\\Header\\HeaderStyleOne', 'dynamic_page', 1, 7, 'dynamic_page', 'a:23:{s:2:\"id\";s:1:\"3\";s:10:\"addon_name\";s:14:\"HeaderStyleOne\";s:15:\"addon_namespace\";s:64:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcSGVhZGVyXEhlYWRlclN0eWxlT25l\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:47:\"Work from anywhere, Get the freedom you deserve\";s:8:\"subtitle\";s:131:\"Get hired by great clients and businesses around the world and work independently as you want. Pay just 1-2% fees on your earnings.\";s:21:\"find_work_button_text\";N;s:21:\"find_work_button_link\";s:1:\"#\";s:24:\"find_project_button_text\";N;s:24:\"find_project_button_link\";s:1:\"#\";s:27:\"top_freelancer_of_the_month\";s:10:\"asdas dasd\";s:12:\"slider_image\";N;s:15:\"shape_image_one\";s:3:\"126\";s:15:\"shape_image_two\";s:3:\"127\";s:16:\"background_image\";N;s:11:\"padding_top\";s:2:\"65\";s:14:\"padding_bottom\";s:2:\"68\";s:10:\"section_bg\";s:18:\"rgb(247, 248, 255)\";s:10:\"trusted_by\";a:1:{s:5:\"logo_\";a:5:{i:0;s:2:\"83\";i:1;s:2:\"82\";i:2;s:2:\"81\";i:3;s:2:\"80\";i:4;s:2:\"84\";}}}', '2023-10-26 06:25:40', '2024-06-06 07:10:00'),
(4, 'WhyOurMarketplace', 'update', 'plugins\\PageBuilder\\Addons\\WhyOurMarketplace\\WhyOurMarketplace', 'dynamic_page', 3, 7, 'dynamic_page', 'a:13:{s:2:\"id\";s:1:\"4\";s:10:\"addon_name\";s:17:\"WhyOurMarketplace\";s:15:\"addon_namespace\";s:84:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcV2h5T3VyTWFya2V0cGxhY2VcV2h5T3VyTWFya2V0cGxhY2U=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"2\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:25:\"Why work in our platform?\";s:11:\"padding_top\";s:2:\"50\";s:14:\"padding_bottom\";s:2:\"50\";s:10:\"section_bg\";N;s:21:\"why_choose_our_market\";a:2:{s:6:\"image_\";a:4:{i:0;s:2:\"67\";i:1;s:2:\"66\";i:2;s:2:\"68\";i:3;s:2:\"69\";}s:6:\"title_\";a:4:{i:0;s:25:\"19K+ Jobs Posted Everyday\";i:1;s:29:\"8K+ Globally Verified Clients\";i:2;s:31:\"We Take Little to No Commission\";i:3;s:28:\"Get Certificates of Earnings\";}}}', '2023-10-26 06:59:44', '2024-11-04 00:01:32'),
(5, 'PopularJobOne', 'update', 'plugins\\PageBuilder\\Addons\\Job\\PopularJobOne', 'dynamic_page', 5, 7, 'dynamic_page', 'a:13:{s:2:\"id\";s:1:\"5\";s:10:\"addon_name\";s:13:\"PopularJobOne\";s:15:\"addon_namespace\";s:60:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcSm9iXFBvcHVsYXJKb2JPbmU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"4\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:11:\"Recent Jobs\";s:5:\"items\";s:1:\"5\";s:11:\"padding_top\";s:2:\"61\";s:14:\"padding_bottom\";s:2:\"60\";s:10:\"section_bg\";N;}', '2023-10-26 07:09:17', '2024-11-04 00:01:32'),
(6, 'TestimonialOne', 'update', 'plugins\\PageBuilder\\Addons\\Testimonial\\TestimonialOne', 'dynamic_page', 6, 7, 'dynamic_page', 'a:14:{s:2:\"id\";s:1:\"6\";s:10:\"addon_name\";s:14:\"TestimonialOne\";s:15:\"addon_namespace\";s:72:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcVGVzdGltb25pYWxcVGVzdGltb25pYWxPbmU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"5\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:38:\"What Freelancers are Thinking About Us\";s:18:\"slider_button_text\";N;s:5:\"items\";s:1:\"5\";s:11:\"padding_top\";s:2:\"87\";s:14:\"padding_bottom\";s:2:\"81\";s:10:\"section_bg\";N;}', '2023-10-26 07:22:31', '2024-11-04 00:01:32'),
(7, 'FaqOne', 'update', 'plugins\\PageBuilder\\Addons\\Faq\\FaqOne', 'dynamic_page', 7, 7, 'dynamic_page', 'a:15:{s:2:\"id\";s:1:\"7\";s:10:\"addon_name\";s:6:\"FaqOne\";s:15:\"addon_namespace\";s:52:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcRmFxXEZhcU9uZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"6\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:13:\"section_title\";s:25:\"Frequently Asked Question\";s:9:\"sub_title\";s:82:\"Didn’t find the right answer? here you can ask your own questions to our support\";s:5:\"image\";s:2:\"72\";s:11:\"padding_top\";s:2:\"68\";s:14:\"padding_bottom\";s:3:\"102\";s:10:\"section_bg\";N;s:3:\"faq\";a:2:{s:6:\"title_\";a:5:{i:0;s:37:\"How much commission do I need to pay?\";i:1;s:33:\"How membership subscription work?\";i:2;s:53:\"What are the benefits of joining Freelancer platform?\";i:3;s:43:\"Do I need to pay extra fees for withdrawal?\";i:4;s:26:\"What’s the closure time?\";}s:12:\"description_\";a:5:{i:0;s:154:\"You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%\";i:1;s:154:\"You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%\";i:2;s:154:\"You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%\";i:3;s:154:\"You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%\";i:4;s:154:\"You’re not obliged to pay any fee before you earn and we just charge less than 2% on your total earnings if you have membership then it’s less than 1%\";}}}', '2023-10-26 07:28:32', '2024-11-04 00:01:32'),
(8, 'PricePlanOne', 'update', 'plugins\\PageBuilder\\Addons\\PricePlan\\PricePlanOne', 'dynamic_page', 9, 7, 'dynamic_page', 'a:12:{s:2:\"id\";s:1:\"8\";s:10:\"addon_name\";s:12:\"PricePlanOne\";s:15:\"addon_namespace\";s:68:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcUHJpY2VQbGFuXFByaWNlUGxhbk9uZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"8\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:10:\"Price Plan\";s:10:\"section_bg\";N;s:11:\"padding_top\";s:2:\"50\";s:14:\"padding_bottom\";s:3:\"100\";}', '2023-10-26 07:34:03', '2024-11-04 00:01:33'),
(9, 'NewsLetterOne', 'update', 'plugins\\PageBuilder\\Addons\\NewsLetter\\NewsLetterOne', 'dynamic_page', 11, 7, 'dynamic_page', 'a:14:{s:2:\"id\";s:1:\"9\";s:10:\"addon_name\";s:13:\"NewsLetterOne\";s:15:\"addon_namespace\";s:68:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcTmV3c0xldHRlclxOZXdzTGV0dGVyT25l\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:2:\"10\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:67:\"Join the club of hundreds of other Freelancers working with freedom\";s:9:\"sub_title\";s:102:\"Get discounts and newsletters on our hotels in your email. We promise to not spam. Unsubscribe anytime\";s:5:\"image\";s:2:\"70\";s:11:\"padding_top\";s:2:\"44\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;}', '2023-10-27 23:31:28', '2024-11-04 00:01:33'),
(10, 'BrandOne', 'update', 'plugins\\PageBuilder\\Addons\\Brand\\BrandOne', 'dynamic_page', 12, 7, 'dynamic_page', 'a:12:{s:2:\"id\";s:2:\"10\";s:10:\"addon_name\";s:8:\"BrandOne\";s:15:\"addon_namespace\";s:56:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQnJhbmRcQnJhbmRPbmU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:2:\"11\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:11:\"padding_top\";s:2:\"50\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;s:10:\"brand_logo\";a:1:{s:6:\"brand_\";a:7:{i:0;s:2:\"91\";i:1;s:2:\"90\";i:2;s:2:\"89\";i:3;s:2:\"88\";i:4;s:2:\"87\";i:5;s:2:\"90\";i:6;s:2:\"85\";}}}', '2023-10-27 23:35:54', '2024-11-04 00:01:33'),
(12, 'ContactMessage', 'update', 'plugins\\PageBuilder\\Addons\\Contact\\ContactMessage', 'dynamic_page', 1, 2, 'dynamic_page', 'a:16:{s:2:\"id\";s:2:\"12\";s:10:\"addon_name\";s:14:\"ContactMessage\";s:15:\"addon_namespace\";s:68:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQ29udGFjdFxDb250YWN0TWVzc2FnZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:1:\"2\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:7:\"heading\";s:12:\"Send Message\";s:16:\"contact_form_des\";s:90:\"Feel free to contact with us if you have any query or face any issues to use this website.\";s:5:\"title\";s:12:\"Get In touch\";s:16:\"contact_info_des\";s:39:\"Also you can use quick contact details.\";s:12:\"contact_info\";a:3:{s:5:\"icon_\";a:5:{i:0;s:21:\"fas fa-map-marker-alt\";i:1;s:12:\"fas fa-phone\";i:2;s:12:\"fas fa-phone\";i:3;s:15:\"fas fa-envelope\";i:4;s:12:\"fas fa-clock\";}s:6:\"title_\";a:5:{i:0;s:7:\"Address\";i:1;s:12:\"Phone Number\";i:2;s:15:\"Phone Number(2)\";i:3;s:13:\"Email Address\";i:4;s:14:\"Business Hours\";}s:12:\"description_\";a:5:{i:0;s:34:\"8502 Preston Wood, Oregon Michigan\";i:1;s:12:\"(629)5550129\";i:2;s:12:\"(088)5532129\";i:3;s:24:\"bill.senders@example.com\";i:4;s:26:\"(GMT +6) 10:00am - 07:00pm\";}}s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:14:\"custom_form_id\";s:1:\"1\";}', '2023-10-31 01:18:39', '2025-07-16 05:43:19'),
(18, 'AboutUs', 'new', 'plugins\\PageBuilder\\Addons\\About\\AboutUs', 'dynamic_page', 1, 9, 'dynamic_page', 'a:13:{s:10:\"addon_name\";s:7:\"AboutUs\";s:15:\"addon_namespace\";s:56:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQWJvdXRcQWJvdXRVcw==\";s:10:\"addon_type\";s:3:\"new\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:1:\"9\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:13:\"section_title\";s:17:\"This is something\";s:11:\"description\";s:1350:\"<p style=\"text-align: center; \"><span style=\"font-weight: normal; font-size: 36px;\">Welcome to Xilancer</span></p><p style=\"text-align: center; \"><span style=\"font-weight: normal; font-size: 36px;\">\r\n</span></p><p style=\"text-align: left;\"><span style=\"font-weight: normal;\">﻿Welcome to Xilancer, a freelancing platform dedicated to connecting clients with independent professionals globally. We understand the importance of privacy and are committed to protecting the personal information of our users. This Privacy Policy outlines our practices regarding the collection, use, and disclosure of your information when you use our website and services.</span></p><p style=\"text-align: left;\"><span style=\"font-weight: normal;\"><br></span></p><p style=\"text-align: center; \"><br></p><p style=\"text-align: center; \">\r\n</p><p style=\"text-align: left;\">﻿<span style=\"font-weight: normal;\">Welcome to Xilancer, a freelancing platform dedicated to connecting clients with independent professionals globally. We understand the importance of privacy and are committed to protecting the personal information of our users. This Privacy Policy outlines our practices regarding the collection, use, and disclosure of your information when you use our website and services.</span></p><p style=\"text-align: center; \">\r\n</p><p style=\"text-align: center; \">\r\n</p>\";s:5:\"image\";s:3:\"101\";s:11:\"padding_top\";s:3:\"260\";s:14:\"padding_bottom\";s:3:\"190\";s:10:\"section_bg\";N;}', '2023-11-22 00:38:16', '2023-11-22 00:38:16'),
(19, 'PopularProjectOne', 'update', 'plugins\\PageBuilder\\Addons\\Project\\PopularProjectOne', 'dynamic_page', 4, 7, 'dynamic_page', 'a:13:{s:2:\"id\";s:2:\"19\";s:10:\"addon_name\";s:17:\"PopularProjectOne\";s:15:\"addon_namespace\";s:72:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcUHJvamVjdFxQb3B1bGFyUHJvamVjdE9uZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"3\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:12:\"Top Projects\";s:5:\"items\";s:1:\"5\";s:11:\"padding_top\";s:2:\"48\";s:14:\"padding_bottom\";s:2:\"47\";s:10:\"section_bg\";N;}', '2023-11-25 00:22:03', '2024-11-04 00:01:32'),
(22, 'CategoryProjectOne', 'update', 'plugins\\PageBuilder\\Addons\\Category\\CategoryProjectOne', 'dynamic_page', 8, 7, 'dynamic_page', 'a:14:{s:2:\"id\";s:2:\"22\";s:10:\"addon_name\";s:18:\"CategoryProjectOne\";s:15:\"addon_namespace\";s:72:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQ2F0ZWdvcnlcQ2F0ZWdvcnlQcm9qZWN0T25l\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"7\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:29:\"Browse Projects By Categories\";s:5:\"items\";s:1:\"8\";s:18:\"slider_button_text\";N;s:11:\"padding_top\";s:2:\"49\";s:14:\"padding_bottom\";s:3:\"102\";s:10:\"section_bg\";N;}', '2024-01-08 23:08:28', '2024-11-04 00:01:33'),
(23, 'CategoryJobOne', 'update', 'plugins\\PageBuilder\\Addons\\Category\\CategoryJobOne', 'dynamic_page', 10, 7, 'dynamic_page', 'a:14:{s:2:\"id\";s:2:\"23\";s:10:\"addon_name\";s:14:\"CategoryJobOne\";s:15:\"addon_namespace\";s:68:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQ2F0ZWdvcnlcQ2F0ZWdvcnlKb2JPbmU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"9\";s:13:\"addon_page_id\";s:1:\"7\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:25:\"Browse Jobs By Categories\";s:5:\"items\";s:1:\"8\";s:18:\"slider_button_text\";s:5:\"Swipe\";s:11:\"padding_top\";s:2:\"50\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;}', '2024-01-09 00:05:42', '2024-11-04 00:01:33'),
(33, 'TestimonialOne', 'update', 'plugins\\PageBuilder\\Addons\\Testimonial\\TestimonialOne', 'dynamic_page', 10, 12, 'dynamic_page', 'a:15:{s:2:\"id\";s:2:\"33\";s:10:\"addon_name\";s:14:\"TestimonialOne\";s:15:\"addon_namespace\";s:72:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcVGVzdGltb25pYWxcVGVzdGltb25pYWxPbmU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:2:\"10\";s:13:\"addon_page_id\";s:2:\"12\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:13:\"Client Review\";s:18:\"slider_button_text\";N;s:5:\"items\";s:2:\"10\";s:11:\"padding_top\";s:3:\"120\";s:14:\"padding_bottom\";s:3:\"120\";s:10:\"section_bg\";s:18:\"rgb(244, 239, 239)\";s:17:\"testimonial_image\";s:3:\"419\";}', '2024-05-14 00:20:41', '2025-06-23 03:07:14'),
(34, 'WhyChooseUs', 'update', 'plugins\\PageBuilder\\Addons\\WhyChooseUs\\WhyChooseUs', 'dynamic_page', 6, 12, 'dynamic_page', 'a:13:{s:2:\"id\";s:2:\"34\";s:10:\"addon_name\";s:11:\"WhyChooseUs\";s:15:\"addon_namespace\";s:68:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcV2h5Q2hvb3NlVXNcV2h5Q2hvb3NlVXM=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"6\";s:13:\"addon_page_id\";s:2:\"12\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:24:\"Why 1M+ People Choose Us\";s:11:\"padding_top\";s:3:\"120\";s:14:\"padding_bottom\";s:3:\"120\";s:10:\"section_bg\";N;s:13:\"why_choose_us\";a:3:{s:6:\"image_\";a:6:{i:0;s:3:\"292\";i:1;s:3:\"411\";i:2;s:3:\"410\";i:3;s:3:\"407\";i:4;s:3:\"412\";i:5;s:3:\"409\";}s:6:\"title_\";a:6:{i:0;s:22:\"Smart, Simple Insights\";i:1;s:29:\"Top Influencers You Can Trust\";i:2;s:20:\"Creative That Clicks\";i:3;s:42:\"All Kinds of Influencers, All in One Place\";i:4;s:28:\"Easy Cancellation, No Stress\";i:5;s:32:\"We’re Global — Just Like You\";}s:9:\"subtitle_\";a:6:{i:0;s:119:\"We break down the data so you don’t have to. Track what matters and find the right influencers without the guesswork.\";i:1;s:116:\"We only feature influencers who’ve built real communities — not just big numbers. So your brand gets real reach.\";i:2;s:122:\"From storytelling to scroll-stopping visuals, our influencers know how to create content your audience will actually love.\";i:3;s:112:\"No matter your niche, size, or goal — we’ve got influencers that fit. From micro to mega, lifestyle to tech.\";i:4;s:114:\"Things change, we get it. That’s why we offer a fair return policy if you need to cancel or tweak your campaign.\";i:5;s:116:\"Whether you\'re working locally or thinking big, we connect you with influencers (and clients) from around the world.\";}}}', '2024-05-14 04:31:23', '2025-07-08 04:55:53'),
(43, 'MobiApplica', 'update', 'plugins\\PageBuilder\\Addons\\MobiApplica\\MobiApplica', 'dynamic_page', 12, 12, 'dynamic_page', 'a:25:{s:2:\"id\";s:2:\"43\";s:10:\"addon_name\";s:11:\"MobiApplica\";s:15:\"addon_namespace\";s:68:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcTW9iaUFwcGxpY2FcTW9iaUFwcGxpY2E=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:2:\"12\";s:13:\"addon_page_id\";s:2:\"12\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:20:\"free_app_store_title\";s:31:\"Download Freelancers Mobile App\";s:20:\"free_app_store_image\";s:3:\"146\";s:19:\"free_app_store_link\";s:1:\"#\";s:25:\"free_app_play_store_image\";s:3:\"145\";s:24:\"free_app_play_store_link\";s:67:\"https://play.google.com/store/apps/details?id=com.xgenious.xilancer\";s:20:\"free_app_store_shape\";s:3:\"147\";s:20:\"free_app_store_phone\";s:3:\"152\";s:22:\"client_app_store_title\";s:27:\"Download Clients Mobile App\";s:22:\"client_app_store_image\";s:3:\"146\";s:21:\"client_app_store_link\";s:1:\"#\";s:27:\"client_app_play_store_image\";s:3:\"145\";s:26:\"client_app_play_store_link\";s:74:\"https://play.google.com/store/apps/details?id=com.xgenious.xilancer_client\";s:22:\"client_app_store_shape\";s:3:\"148\";s:22:\"client_app_store_phone\";s:3:\"154\";s:11:\"padding_top\";s:3:\"260\";s:14:\"padding_bottom\";s:3:\"190\";s:10:\"section_bg\";N;}', '2024-06-03 07:11:42', '2024-06-03 07:16:48'),
(45, 'ProjectPromotion', 'update', 'Modules\\SecurityManage\\Http\\PageBuilder\\Promotion\\ProjectPromotion', 'dynamic_page', 12, 12, 'dynamic_page', 'a:15:{s:2:\"id\";s:2:\"45\";s:10:\"addon_name\";s:16:\"ProjectPromotion\";s:15:\"addon_namespace\";s:88:\"TW9kdWxlc1xTZWN1cml0eU1hbmFnZVxIdHRwXFBhZ2VCdWlsZGVyXFByb21vdGlvblxQcm9qZWN0UHJvbW90aW9u\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:2:\"12\";s:13:\"addon_page_id\";s:2:\"12\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:17:\"Promoted Projects\";s:5:\"items\";s:1:\"5\";s:8:\"view_all\";s:3:\"asd\";s:13:\"view_all_link\";s:5:\"sadsa\";s:11:\"padding_top\";s:3:\"170\";s:14:\"padding_bottom\";s:3:\"168\";s:10:\"section_bg\";N;}', '2024-06-29 02:42:01', '2024-06-29 03:51:46'),
(46, 'HeaderStyleCustom', 'update', 'Modules\\CoinPaymentGateway\\App\\Http\\PageBuilder\\Header\\HeaderStyleCustom', 'dynamic_page', 1, 12, 'dynamic_page', 'a:19:{s:2:\"id\";s:2:\"46\";s:10:\"addon_name\";s:17:\"HeaderStyleCustom\";s:15:\"addon_namespace\";s:96:\"TW9kdWxlc1xDb2luUGF5bWVudEdhdGV3YXlcQXBwXEh0dHBcUGFnZUJ1aWxkZXJcSGVhZGVyXEhlYWRlclN0eWxlQ3VzdG9t\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"12\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:29:\"Take your talent to the orbit\";s:8:\"subtitle\";s:166:\"We make it’s easier for talents and businesses to connect and we make it absolutely less charges. Hire Talents or Get Hired from our platform and work independently\";s:21:\"find_work_button_text\";s:9:\"Find Work\";s:21:\"find_work_button_link\";s:6:\"sadasd\";s:23:\"find_talent_button_text\";s:11:\"Find Talent\";s:23:\"find_talent_button_link\";s:7:\"asd asd\";s:23:\"highlighted_banner_text\";s:28:\"Next Gen. Freelance Platform\";s:16:\"background_image\";s:3:\"219\";s:11:\"padding_top\";s:1:\"0\";s:14:\"padding_bottom\";s:1:\"0\";s:10:\"section_bg\";N;}', '2024-08-24 22:55:24', '2024-08-25 06:03:25'),
(50, 'HeaderStyleOne', 'update', 'plugins\\PageBuilder\\Addons\\Header\\HeaderStyleOne', 'dynamic_page', 1, 12, 'dynamic_page', 'a:18:{s:2:\"id\";s:2:\"50\";s:10:\"addon_name\";s:14:\"HeaderStyleOne\";s:15:\"addon_namespace\";s:64:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcSGVhZGVyXEhlYWRlclN0eWxlT25l\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"12\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:52:\"Elevate your brand with expert influencer marketing.\";s:8:\"subtitle\";s:210:\"Unlock the power of authentic connections and targeted reach through strategic collaborations with top tier influencers Whether you\'re looking to build brand awareness drive engagement or boost conversions our.\";s:21:\"find_work_button_text\";s:11:\"Get Started\";s:21:\"find_work_button_link\";N;s:24:\"find_project_button_text\";s:15:\"Hire influencer\";s:24:\"find_project_button_link\";N;s:11:\"banner_bg_1\";s:3:\"400\";s:12:\"banner_image\";s:3:\"463\";s:11:\"padding_top\";s:2:\"60\";s:14:\"padding_bottom\";s:2:\"61\";}', '2025-02-18 11:01:22', '2025-07-16 06:10:57'),
(51, 'AllShakes', 'update', 'plugins\\PageBuilder\\Addons\\Shake\\AllShakes', 'dynamic_page', 1, 13, 'dynamic_page', 'a:12:{s:2:\"id\";s:2:\"51\";s:10:\"addon_name\";s:9:\"AllShakes\";s:15:\"addon_namespace\";s:56:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcU2hha2VcQWxsU2hha2Vz\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"13\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:10:\"All Shakes\";s:5:\"items\";s:1:\"8\";s:11:\"padding_top\";s:2:\"64\";s:14:\"padding_bottom\";s:2:\"58\";}', '2025-02-18 11:05:57', '2025-04-09 06:15:37'),
(52, 'BrandOne', 'update', 'plugins\\PageBuilder\\Addons\\Brand\\BrandOne', 'dynamic_page', 2, 12, 'dynamic_page', 'a:13:{s:2:\"id\";s:2:\"52\";s:10:\"addon_name\";s:8:\"BrandOne\";s:15:\"addon_namespace\";s:56:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQnJhbmRcQnJhbmRPbmU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"2\";s:13:\"addon_page_id\";s:2:\"12\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:12:\"Our Sponsors\";s:11:\"padding_top\";s:2:\"50\";s:14:\"padding_bottom\";s:2:\"50\";s:10:\"section_bg\";s:12:\"rgb(0, 0, 0)\";s:10:\"brand_logo\";a:1:{s:6:\"brand_\";a:5:{i:0;s:3:\"467\";i:1;s:3:\"467\";i:2;s:3:\"467\";i:3;s:3:\"467\";i:4;s:3:\"467\";}}}', '2025-02-18 11:54:45', '2025-07-23 02:09:02'),
(54, 'FeaturedInfluencer', 'update', 'plugins\\PageBuilder\\Addons\\FeaturedInfluencer\\FeaturedInfluencer', 'dynamic_page', 3, 12, 'dynamic_page', 'a:15:{s:2:\"id\";s:2:\"54\";s:10:\"addon_name\";s:18:\"FeaturedInfluencer\";s:15:\"addon_namespace\";s:88:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcRmVhdHVyZWRJbmZsdWVuY2VyXEZlYXR1cmVkSW5mbHVlbmNlcg==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"3\";s:13:\"addon_page_id\";s:2:\"12\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:19:\"Featured Influencer\";s:5:\"items\";s:1:\"4\";s:21:\"find_more_button_text\";s:9:\"Find More\";s:21:\"find_more_button_link\";N;s:11:\"padding_top\";s:3:\"120\";s:14:\"padding_bottom\";s:2:\"60\";s:10:\"section_bg\";N;}', '2025-02-22 08:08:01', '2025-06-22 03:01:08'),
(55, 'LatestJob', 'update', 'plugins\\PageBuilder\\Addons\\Job\\LatestJob', 'dynamic_page', 4, 12, 'dynamic_page', 'a:15:{s:2:\"id\";s:2:\"55\";s:10:\"addon_name\";s:9:\"LatestJob\";s:15:\"addon_namespace\";s:56:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcSm9iXExhdGVzdEpvYg==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"4\";s:13:\"addon_page_id\";s:2:\"12\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:16:\"Recent Campaigns\";s:5:\"items\";s:1:\"6\";s:21:\"find_more_button_text\";s:9:\"Find More\";s:21:\"find_more_button_link\";N;s:11:\"padding_top\";s:2:\"60\";s:14:\"padding_bottom\";s:3:\"120\";s:10:\"section_bg\";N;}', '2025-02-22 08:23:27', '2025-07-14 00:47:03'),
(56, 'HowMarketplaceWork', 'update', 'plugins\\PageBuilder\\Addons\\HowMarketplaceWork\\HowMarketplaceWork', 'dynamic_page', 5, 12, 'dynamic_page', 'a:13:{s:2:\"id\";s:2:\"56\";s:10:\"addon_name\";s:18:\"HowMarketplaceWork\";s:15:\"addon_namespace\";s:88:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcSG93TWFya2V0cGxhY2VXb3JrXEhvd01hcmtldHBsYWNlV29yaw==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"5\";s:13:\"addon_page_id\";s:2:\"12\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:24:\"How Our Marketplace Work\";s:11:\"padding_top\";s:3:\"120\";s:14:\"padding_bottom\";s:3:\"120\";s:10:\"section_bg\";s:18:\"rgb(253, 244, 247)\";s:21:\"why_choose_our_market\";a:4:{s:6:\"image_\";a:4:{i:0;s:3:\"401\";i:1;s:3:\"403\";i:2;s:3:\"402\";i:3;s:3:\"404\";}s:6:\"title_\";a:4:{i:0;s:14:\"Create Account\";i:1;s:15:\"Create Campaign\";i:2;s:15:\"Find Influencer\";i:3;s:11:\"Collaborate\";}s:9:\"subtitle_\";a:4:{i:0;s:53:\"Join as an Influencer or Brand to start your journey.\";i:1;s:71:\"Create your campaign or projects and explore the brands and influencer.\";i:2;s:53:\"After publishing your campaigns find the influencers.\";i:3;s:53:\"After publishing your campaigns find the influencers.\";}s:12:\"arrow_image_\";a:4:{i:0;s:3:\"406\";i:1;s:3:\"405\";i:2;s:3:\"406\";i:3;N;}}}', '2025-02-22 08:33:26', '2025-06-23 05:24:41'),
(57, 'CustomerSatisfaction', 'update', 'plugins\\PageBuilder\\Addons\\CustomerSatisfaction\\CustomerSatisfaction', 'dynamic_page', 7, 12, 'dynamic_page', 'a:13:{s:2:\"id\";s:2:\"57\";s:10:\"addon_name\";s:20:\"CustomerSatisfaction\";s:15:\"addon_namespace\";s:92:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQ3VzdG9tZXJTYXRpc2ZhY3Rpb25cQ3VzdG9tZXJTYXRpc2ZhY3Rpb24=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"7\";s:13:\"addon_page_id\";s:2:\"12\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:27:\"Customer Satisfaction Stats\";s:11:\"padding_top\";s:3:\"120\";s:14:\"padding_bottom\";s:3:\"120\";s:10:\"section_bg\";N;s:30:\"customer_satisfaction_repeater\";a:4:{s:6:\"image_\";a:4:{i:0;s:3:\"414\";i:1;s:3:\"415\";i:2;s:3:\"413\";i:3;s:3:\"416\";}s:7:\"number_\";a:4:{i:0;s:5:\"3.5K+\";i:1;s:5:\"4.5K+\";i:2;s:5:\"7.5K+\";i:3;s:5:\"8.5K+\";}s:6:\"title_\";a:4:{i:0;s:6:\"Brands\";i:1;s:11:\"Influencers\";i:2;s:9:\"Campaigns\";i:3;s:14:\"Collaborations\";}s:9:\"bg_color_\";a:4:{i:0;N;i:1;N;i:2;N;i:3;N;}}}', '2025-02-22 08:44:12', '2025-06-30 06:03:41'),
(58, 'FaqOne', 'update', 'plugins\\PageBuilder\\Addons\\Faq\\FaqOne', 'dynamic_page', 11, 12, 'dynamic_page', 'a:13:{s:2:\"id\";s:2:\"58\";s:10:\"addon_name\";s:6:\"FaqOne\";s:15:\"addon_namespace\";s:52:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcRmFxXEZhcU9uZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:2:\"11\";s:13:\"addon_page_id\";s:2:\"12\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:13:\"section_title\";s:26:\"Frequently Asked Questions\";s:11:\"padding_top\";s:3:\"120\";s:14:\"padding_bottom\";s:3:\"120\";s:10:\"section_bg\";s:18:\"rgb(253, 244, 247)\";s:3:\"faq\";a:2:{s:6:\"title_\";a:4:{i:0;s:46:\"How do you choose the right for your campaign?\";i:1;s:58:\"What are the most effective types of influencer campaigns?\";i:2;s:52:\"How can brands measure influencer marketing success?\";i:3;s:46:\"How do you choose the right for your campaign?\";}s:12:\"description_\";a:4:{i:0;s:164:\"Influencers often specialize in certain niches, such as beauty, fitness, fashion, tech, or food. Ensure the influencer’s niche aligns with your brand’s industry\";i:1;s:122:\"Influencer marketing helps brands build trust, reach new audiences, and drive  conversions through authentic endorsements.\";i:2;s:122:\"Influencer marketing helps brands build trust, reach new audiences, and drive  conversions through authentic endorsements.\";i:3;s:164:\"Influencers often specialize in certain niches, such as beauty, fitness, fashion, tech, or food. Ensure the influencer’s niche aligns with your brand’s industry\";}}}', '2025-02-22 08:53:52', '2025-06-22 03:58:30'),
(60, 'AllShakes', 'update', 'plugins\\PageBuilder\\Addons\\Shake\\AllShakes', 'dynamic_page', 8, 12, 'dynamic_page', 'a:13:{s:2:\"id\";s:2:\"60\";s:10:\"addon_name\";s:9:\"AllShakes\";s:15:\"addon_namespace\";s:56:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcU2hha2VcQWxsU2hha2Vz\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"8\";s:13:\"addon_page_id\";s:2:\"12\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:15:\"Latest Projects\";s:5:\"items\";s:1:\"3\";s:11:\"padding_top\";s:3:\"120\";s:14:\"padding_bottom\";s:3:\"120\";s:10:\"section_bg\";N;}', '2025-04-20 06:17:08', '2025-06-23 05:58:37'),
(61, 'PricePlanOne', 'update', 'plugins\\PageBuilder\\Addons\\PricePlan\\PricePlanOne', 'dynamic_page', 9, 12, 'dynamic_page', 'a:14:{s:2:\"id\";s:2:\"61\";s:10:\"addon_name\";s:12:\"PricePlanOne\";s:15:\"addon_namespace\";s:68:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcUHJpY2VQbGFuXFByaWNlUGxhbk9uZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"9\";s:13:\"addon_page_id\";s:2:\"12\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:27:\"Easy and affordable Pricing\";s:8:\"subtitle\";N;s:20:\"view_all_button_text\";N;s:20:\"view_all_button_link\";N;s:11:\"padding_top\";s:3:\"120\";s:14:\"padding_bottom\";s:3:\"120\";}', '2025-06-22 05:59:45', '2025-06-22 06:00:48'),
(62, 'TestimonialOne', 'update', 'plugins\\PageBuilder\\Addons\\Testimonial\\TestimonialOne', 'dynamic_page', 7, 8, 'dynamic_page', 'a:15:{s:2:\"id\";s:2:\"62\";s:10:\"addon_name\";s:14:\"TestimonialOne\";s:15:\"addon_namespace\";s:72:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcVGVzdGltb25pYWxcVGVzdGltb25pYWxPbmU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"5\";s:13:\"addon_page_id\";s:1:\"8\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:13:\"Client Review\";s:18:\"slider_button_text\";N;s:5:\"items\";s:1:\"6\";s:11:\"padding_top\";s:3:\"120\";s:14:\"padding_bottom\";s:3:\"120\";s:10:\"section_bg\";N;s:17:\"testimonial_image\";s:3:\"419\";}', '2025-06-30 05:04:37', '2025-06-30 06:17:44'),
(63, 'AboutUsTwo', 'update', 'plugins\\PageBuilder\\Addons\\About\\AboutUsTwo', 'dynamic_page', 1, 8, 'dynamic_page', 'a:19:{s:2:\"id\";s:2:\"63\";s:10:\"addon_name\";s:10:\"AboutUsTwo\";s:15:\"addon_namespace\";s:60:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQWJvdXRcQWJvdXRVc1R3bw==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:1:\"8\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:13:\"section_title\";s:8:\"About Us\";s:11:\"description\";s:579:\"<span style=\"font-weight: normal;\">Welcome to our world where creativity meets influence, We are a dynamic content hub led by influencer a passionate influencer dedicated to inspiring educating and connecting with a global community. From fashion and lifestyle to travel beauty and everyday motivation our platform is more than just posts it\'s a space where authenticity shines and stories resonate. Every piece of content is crafted with heart aiming to uplift entertain and spark meaningful conversations. With a growing network of followers and a trusted</span><div><br></div>\";s:5:\"image\";s:3:\"420\";s:11:\"padding_top\";s:3:\"121\";s:14:\"padding_bottom\";s:3:\"121\";s:10:\"section_bg\";N;s:13:\"success_title\";s:15:\"Success Stories\";s:17:\"success_sub_title\";s:26:\"Growth Fueled by Influence\";s:19:\"success_description\";s:368:\"<div><span style=\"font-weight: normal;\">Step behind the filters and into the real journeys of today’s top influencers. These inspiring success stories reveal how passionate creators turned their hobbies into thriving personal brands and their voices into influence that matters. From the early struggles and steep learning curves to breakthrough moments</span></div>\";s:13:\"success_image\";s:3:\"421\";s:14:\"success_points\";a:1:{s:15:\"success_points_\";a:5:{i:0;s:44:\"Landed brand deals with top global companies\";i:1;s:47:\"Turned content creation into a full-time career\";i:2;s:51:\"Built engaged communities across multiple platforms\";i:3;s:47:\"Launched successful product lines or businesses\";i:4;s:50:\"Overcame algorithm changes and platform challenges\";}}}', '2025-06-30 05:27:48', '2025-06-30 05:29:28'),
(64, 'CustomerSatisfaction', 'update', 'plugins\\PageBuilder\\Addons\\CustomerSatisfaction\\CustomerSatisfaction', 'dynamic_page', 2, 8, 'dynamic_page', 'a:13:{s:2:\"id\";s:2:\"64\";s:10:\"addon_name\";s:20:\"CustomerSatisfaction\";s:15:\"addon_namespace\";s:92:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQ3VzdG9tZXJTYXRpc2ZhY3Rpb25cQ3VzdG9tZXJTYXRpc2ZhY3Rpb24=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"2\";s:13:\"addon_page_id\";s:1:\"8\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:24:\"Our Community Commitment\";s:11:\"padding_top\";s:3:\"121\";s:14:\"padding_bottom\";s:3:\"121\";s:10:\"section_bg\";N;s:30:\"customer_satisfaction_repeater\";a:4:{s:6:\"image_\";a:4:{i:0;s:3:\"414\";i:1;s:3:\"415\";i:2;s:3:\"413\";i:3;s:3:\"416\";}s:7:\"number_\";a:4:{i:0;s:5:\"3.5k+\";i:1;s:4:\"600+\";i:2;s:4:\"100+\";i:3;s:5:\"8.5K+\";}s:6:\"title_\";a:4:{i:0;s:5:\"Users\";i:1;s:12:\"Team Members\";i:2;s:15:\"Brand Campaigns\";i:3;s:14:\"Collaborations\";}s:9:\"bg_color_\";a:4:{i:0;N;i:1;N;i:2;N;i:3;N;}}}', '2025-06-30 05:50:19', '2025-07-16 04:56:17'),
(65, 'MissionVision', 'update', 'plugins\\PageBuilder\\Addons\\About\\MissionVision', 'dynamic_page', 6, 8, 'dynamic_page', 'a:13:{s:2:\"id\";s:2:\"65\";s:10:\"addon_name\";s:13:\"MissionVision\";s:15:\"addon_namespace\";s:64:\"cGx1Z2luc1xQYWdlQnVpbGRlclxBZGRvbnNcQWJvdXRcTWlzc2lvblZpc2lvbg==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"6\";s:13:\"addon_page_id\";s:1:\"8\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:13:\"section_title\";s:20:\"Our Mission & Vision\";s:14:\"mission_vision\";a:3:{s:6:\"title_\";a:2:{i:0;s:7:\"Mission\";i:1;s:6:\"Vision\";}s:12:\"description_\";a:2:{i:0;s:241:\"<span style=\"font-weight: normal;\">To inspire educate and empower a global community through authentic storytelling, impactful content, and meaningful engagement promoting positivity creativity and personal growth across all platforms</span>\";i:1;s:243:\"<span style=\"font-weight: normal;\">To become a trusted voice and leading digital presence that influences culture, drives change, and connects people through shared experiences and values making a lasting impact both online and offline.</span>\";}s:6:\"image_\";a:2:{i:0;s:3:\"427\";i:1;s:3:\"426\";}}s:11:\"padding_top\";s:3:\"120\";s:14:\"padding_bottom\";s:1:\"1\";s:10:\"section_bg\";N;}', '2025-06-30 06:19:51', '2025-07-17 03:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `menu_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `menu_name`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Category', 'category-list', 'admin', '2023-10-22 01:16:30', '2023-10-22 01:16:30'),
(2, 'Category', 'category-add', 'admin', '2023-10-22 01:16:30', '2023-10-22 01:16:30'),
(3, 'Category', 'category-edit', 'admin', '2023-10-22 01:16:31', '2023-10-22 01:16:31'),
(4, 'Category', 'category-delete', 'admin', '2023-10-22 01:16:31', '2023-10-22 01:16:31'),
(5, 'Category', 'category-status-change', 'admin', '2023-10-22 01:16:31', '2023-10-22 01:16:31'),
(6, 'Category', 'category-bulk-delete', 'admin', '2023-10-22 01:16:31', '2023-10-22 01:16:31'),
(7, 'Subcategory', 'subcategory-list', 'admin', '2023-10-22 01:18:53', '2023-10-22 01:18:53'),
(8, 'Subcategory', 'subcategory-add', 'admin', '2023-10-22 01:18:53', '2023-10-22 01:18:53'),
(9, 'Subcategory', 'subcategory-edit', 'admin', '2023-10-22 01:18:53', '2023-10-22 01:18:53'),
(10, 'Subcategory', 'subcategory-delete', 'admin', '2023-10-22 01:18:53', '2023-10-22 01:18:53'),
(11, 'Subcategory', 'subcategory-status-change', 'admin', '2023-10-22 01:18:53', '2023-10-22 01:18:53'),
(12, 'Subcategory', 'subcategory-bulk-delete', 'admin', '2023-10-22 01:18:53', '2023-10-22 01:18:53'),
(13, 'Skill', 'skill-list', 'admin', '2023-10-22 01:20:00', '2023-10-22 01:20:00'),
(14, 'Skill', 'skill-add', 'admin', '2023-10-22 01:20:00', '2023-10-22 01:20:00'),
(15, 'Skill', 'skill-edit', 'admin', '2023-10-22 01:20:00', '2023-10-22 01:20:00'),
(16, 'Skill', 'skill-delete', 'admin', '2023-10-22 01:20:00', '2023-10-22 01:20:00'),
(17, 'Skill', 'skill-status-change', 'admin', '2023-10-22 01:20:00', '2023-10-22 01:20:00'),
(18, 'Skill', 'skill-bulk-delete', 'admin', '2023-10-22 01:20:00', '2023-10-22 01:20:00'),
(19, 'Country', 'country-list', 'admin', '2023-10-22 01:25:54', '2023-10-22 01:25:54'),
(20, 'Country', 'country-add', 'admin', '2023-10-22 01:25:54', '2023-10-22 01:25:54'),
(21, 'Country', 'country-edit', 'admin', '2023-10-22 01:25:54', '2023-10-22 01:25:54'),
(22, 'Country', 'country-delete', 'admin', '2023-10-22 01:25:54', '2023-10-22 01:25:54'),
(23, 'Country', 'country-status-change', 'admin', '2023-10-22 01:25:54', '2023-10-22 01:25:54'),
(24, 'Country', 'country-bulk-delete', 'admin', '2023-10-22 01:25:54', '2023-10-22 01:25:54'),
(25, 'Country', 'country-csv-file-import', 'admin', '2023-10-22 01:25:54', '2023-10-22 01:25:54'),
(26, 'State', 'state-list', 'admin', '2023-10-22 01:26:48', '2023-10-22 01:26:48'),
(27, 'State', 'state-add', 'admin', '2023-10-22 01:26:48', '2023-10-22 01:26:48'),
(28, 'State', 'state-edit', 'admin', '2023-10-22 01:26:48', '2023-10-22 01:26:48'),
(29, 'State', 'state-delete', 'admin', '2023-10-22 01:26:48', '2023-10-22 01:26:48'),
(30, 'State', 'state-status-change', 'admin', '2023-10-22 01:26:48', '2023-10-22 01:26:48'),
(31, 'State', 'state-bulk-delete', 'admin', '2023-10-22 01:26:48', '2023-10-22 01:26:48'),
(32, 'State', 'state-csv-file-import', 'admin', '2023-10-22 01:26:48', '2023-10-22 01:26:48'),
(33, 'City', 'city-list', 'admin', '2023-10-22 01:27:12', '2023-10-22 01:27:12'),
(34, 'City', 'city-add', 'admin', '2023-10-22 01:27:12', '2023-10-22 01:27:12'),
(35, 'City', 'city-edit', 'admin', '2023-10-22 01:27:12', '2023-10-22 01:27:12'),
(36, 'City', 'city-delete', 'admin', '2023-10-22 01:27:12', '2023-10-22 01:27:12'),
(37, 'City', 'city-status-change', 'admin', '2023-10-22 01:27:13', '2023-10-22 01:27:13'),
(38, 'City', 'city-bulk-delete', 'admin', '2023-10-22 01:27:13', '2023-10-22 01:27:13'),
(39, 'City', 'city-csv-file-import', 'admin', '2023-10-22 01:27:13', '2023-10-22 01:27:13'),
(40, 'Project', 'project-list', 'admin', '2023-10-22 01:33:18', '2023-10-22 01:33:18'),
(41, 'Project', 'project-delete', 'admin', '2023-10-22 01:33:18', '2023-10-22 01:33:18'),
(42, 'Project', 'project-details', 'admin', '2023-10-22 01:33:18', '2023-10-22 01:33:18'),
(43, 'Project', 'project-reject', 'admin', '2023-10-22 01:33:19', '2023-10-22 01:33:19'),
(44, 'Project', 'project-status-change', 'admin', '2023-10-22 01:33:19', '2023-10-22 01:33:19'),
(45, 'Project', 'project-history-list', 'admin', '2023-10-22 01:35:30', '2023-10-22 01:35:30'),
(46, 'Campaign', 'campaign-list', 'admin', '2023-10-22 01:51:58', '2023-10-22 01:51:58'),
(47, 'Campaign', 'campaign-details', 'admin', '2023-10-22 01:51:58', '2023-10-22 01:51:58'),
(48, 'Campaign', 'campaign-delete', 'admin', '2023-10-22 01:51:58', '2023-10-22 01:51:58'),
(49, 'Campaign', 'campaign-status-change', 'admin', '2023-10-22 01:51:58', '2023-10-22 01:51:58'),
(50, 'Campaign', 'campaign-auto-approval', 'admin', '2023-10-22 01:51:59', '2023-10-22 01:51:59'),
(51, 'Campaign', 'campaign-history-list', 'admin', '2023-10-22 01:51:59', '2023-10-22 01:51:59'),
(52, 'Wallet', 'deposit-list', 'admin', '2023-10-22 01:58:28', '2023-10-22 01:58:28'),
(53, 'Wallet', 'deposit-settings-view', 'admin', '2023-10-22 01:58:28', '2023-10-22 01:58:28'),
(54, 'Wallet', 'deposit-settings-update', 'admin', '2023-10-22 01:58:28', '2023-10-22 01:58:28'),
(55, 'Wallet', 'deposit-history-details', 'admin', '2023-10-22 01:58:28', '2023-10-22 01:58:28'),
(56, 'Wallet', 'complete-manual-deposit-status', 'admin', '2023-10-22 01:58:28', '2023-10-22 01:58:28'),
(57, 'Withdraw', 'withdraw-list', 'admin', '2023-10-22 02:03:25', '2023-10-22 02:03:25'),
(58, 'Withdraw', 'withdraw-settings-view', 'admin', '2023-10-22 02:03:25', '2023-10-22 02:03:25'),
(59, 'Withdraw', 'withdraw-settings-update', 'admin', '2023-10-22 02:03:25', '2023-10-22 02:03:25'),
(60, 'Withdraw', 'withdraw-status-change', 'admin', '2023-10-22 02:03:25', '2023-10-22 02:03:25'),
(61, 'Withdraw', 'withdraw-payment-gateway-list', 'admin', '2023-10-22 02:03:25', '2023-10-22 02:03:25'),
(62, 'Withdraw', 'withdraw-payment-gateway-add', 'admin', '2023-10-22 02:03:25', '2023-10-22 02:03:25'),
(63, 'Withdraw', 'withdraw-payment-gateway-edit', 'admin', '2023-10-22 02:03:25', '2023-10-22 02:03:25'),
(64, 'Withdraw', 'withdraw-payment-gateway-delete', 'admin', '2023-10-22 02:03:25', '2023-10-22 02:03:25'),
(65, 'Withdraw', 'withdraw-payment-status-change', 'admin', '2023-10-22 02:03:25', '2023-10-22 02:03:25'),
(66, 'Subscription', 'subscription-type-list', 'admin', '2023-10-22 03:18:59', '2023-10-22 03:18:59'),
(67, 'Subscription', 'subscription-type-add', 'admin', '2023-10-22 03:18:59', '2023-10-22 03:18:59'),
(68, 'Subscription', 'subscription-type-edit', 'admin', '2023-10-22 03:18:59', '2023-10-22 03:18:59'),
(69, 'Subscription', 'subscription-type-delete', 'admin', '2023-10-22 03:18:59', '2023-10-22 03:18:59'),
(70, 'Subscription', 'subscription-type-bulk-delete', 'admin', '2023-10-22 03:18:59', '2023-10-22 03:18:59'),
(71, 'Subscription', 'subscription-list', 'admin', '2023-10-22 03:18:59', '2023-10-22 03:18:59'),
(72, 'Subscription', 'subscription-add', 'admin', '2023-10-22 03:18:59', '2023-10-22 03:18:59'),
(73, 'Subscription', 'subscription-edit', 'admin', '2023-10-22 03:18:59', '2023-10-22 03:18:59'),
(74, 'Subscription', 'subscription-delete', 'admin', '2023-10-22 03:18:59', '2023-10-22 03:18:59'),
(75, 'Subscription', 'subscription-bulk-delete', 'admin', '2023-10-22 03:18:59', '2023-10-22 03:18:59'),
(76, 'Subscription', 'subscription-status-change', 'admin', '2023-10-22 03:18:59', '2023-10-22 03:18:59'),
(77, 'Subscription', 'subscription-connect-settings-view', 'admin', '2023-10-22 03:18:59', '2023-10-22 03:18:59'),
(78, 'Subscription', 'subscription-connect-settings-update', 'admin', '2023-10-22 03:18:59', '2023-10-22 03:18:59'),
(79, 'User Subscription', 'user-subscription-list', 'admin', '2023-10-22 03:23:39', '2023-10-22 03:23:39'),
(80, 'User Subscription', 'user-subscription-status-change', 'admin', '2023-10-22 03:23:39', '2023-10-22 03:23:39'),
(81, 'User Subscription', 'user-active-subscription', 'admin', '2023-10-22 03:23:39', '2023-10-22 03:23:39'),
(82, 'User Subscription', 'user-inactive-subscription', 'admin', '2023-10-22 03:23:40', '2023-10-22 03:23:40'),
(83, 'User Subscription', 'user-manual-subscription', 'admin', '2023-10-22 03:23:40', '2023-10-22 03:23:40'),
(84, 'Transaction Fee', 'transaction-fee-settings-view', 'admin', '2023-10-22 03:28:15', '2023-10-22 03:28:15'),
(85, 'Transaction Fee', 'transaction-fee-settings-update', 'admin', '2023-10-22 03:28:15', '2023-10-22 03:28:15'),
(86, 'Withdraw Fee', 'withdraw-fee-settings-view', 'admin', '2023-10-22 03:28:38', '2023-10-22 03:28:38'),
(87, 'Withdraw Fee', 'withdraw-fee-settings-update', 'admin', '2023-10-22 03:28:38', '2023-10-22 03:28:38'),
(88, 'Admin Commission', 'admin-commission-settings-view', 'admin', '2023-10-22 03:30:49', '2023-10-22 03:30:49'),
(89, 'Admin Commission', 'admin-commission-settings-update', 'admin', '2023-10-22 03:30:49', '2023-10-22 03:30:49'),
(90, 'Order', 'order-list', 'admin', '2023-10-22 03:38:10', '2023-10-22 03:38:10'),
(91, 'Order', 'order-details', 'admin', '2023-10-22 03:38:10', '2023-10-22 03:38:10'),
(92, 'Order', 'order-hold', 'admin', '2023-10-22 03:38:10', '2023-10-22 03:38:10'),
(93, 'Order', 'order-active', 'admin', '2023-10-22 03:38:10', '2023-10-22 03:38:10'),
(94, 'Order', 'order-queue', 'admin', '2023-10-22 03:38:10', '2023-10-22 03:38:10'),
(95, 'Order', 'order-deliver', 'admin', '2023-10-22 03:38:10', '2023-10-22 03:38:10'),
(96, 'Order', 'order-complete', 'admin', '2023-10-22 03:38:10', '2023-10-22 03:38:10'),
(97, 'Order', 'order-cancel', 'admin', '2023-10-22 03:38:10', '2023-10-22 03:38:10'),
(98, 'Order', 'order-decline', 'admin', '2023-10-22 03:38:10', '2023-10-22 03:38:10'),
(99, 'Order', 'order-manual-payment-status-update', 'admin', '2023-10-22 03:38:10', '2023-10-22 03:38:10'),
(100, 'Department', 'department-list', 'admin', '2023-10-22 03:59:01', '2023-10-22 03:59:01'),
(101, 'Department', 'department-add', 'admin', '2023-10-22 03:59:01', '2023-10-22 03:59:01'),
(102, 'Department', 'department-edit', 'admin', '2023-10-22 03:59:01', '2023-10-22 03:59:01'),
(103, 'Department', 'department-delete', 'admin', '2023-10-22 03:59:01', '2023-10-22 03:59:01'),
(104, 'Department', 'department-bulk-delete', 'admin', '2023-10-22 03:59:01', '2023-10-22 03:59:01'),
(105, 'Department', 'department-status-update', 'admin', '2023-10-22 03:59:01', '2023-10-22 03:59:01'),
(106, 'Support Ticket', 'support-ticket-list', 'admin', '2023-10-22 04:19:55', '2023-10-22 04:19:55'),
(107, 'Support Ticket', 'support-ticket-details', 'admin', '2023-10-22 04:19:55', '2023-10-22 04:19:55'),
(108, 'Support Ticket', 'support-ticket-delete', 'admin', '2023-10-22 04:19:55', '2023-10-22 04:19:55'),
(109, 'Support Ticket', 'support-ticket-bulk-action', 'admin', '2023-10-22 04:19:55', '2023-10-22 04:19:55'),
(110, 'Support Ticket', 'support-ticket-status-change', 'admin', '2023-10-22 04:19:55', '2023-10-22 04:19:55'),
(111, 'Support Ticket', 'support-ticket-reply', 'admin', '2023-10-22 04:19:55', '2023-10-22 04:19:55'),
(112, 'Support Ticket', 'support-ticket-close', 'admin', '2023-10-22 04:19:56', '2023-10-22 04:19:56'),
(113, 'Notification', 'notification-list', 'admin', '2023-10-22 04:21:17', '2023-10-22 04:21:17'),
(114, 'Notification', 'notification-details', 'admin', '2023-10-22 04:21:17', '2023-10-22 04:21:17'),
(115, 'User Manage', 'user-list', 'admin', '2023-10-22 04:47:01', '2023-10-22 04:47:01'),
(116, 'User Manage', 'user-details', 'admin', '2023-10-22 04:47:01', '2023-10-22 04:47:01'),
(117, 'User Manage', 'user-details-update', 'admin', '2023-10-22 04:47:01', '2023-10-22 04:47:01'),
(118, 'User Manage', 'user-identity-details', 'admin', '2023-10-22 04:47:01', '2023-10-22 04:47:01'),
(119, 'User Manage', 'user-identity-decline', 'admin', '2023-10-22 04:47:01', '2023-10-22 04:47:01'),
(120, 'User Manage', 'user-identity-status-update', 'admin', '2023-10-22 04:47:01', '2023-10-22 04:47:01'),
(121, 'User Manage', 'user-password-change', 'admin', '2023-10-22 04:47:01', '2023-10-22 04:47:01'),
(122, 'User Manage', 'user-delete', 'admin', '2023-10-22 04:47:01', '2023-10-22 04:47:01'),
(123, 'User Manage', 'user-account-status-change', 'admin', '2023-10-22 04:47:01', '2023-10-22 04:47:01'),
(124, 'User Manage', 'user-individual-commission-settings', 'admin', '2023-10-22 04:47:01', '2023-10-22 04:47:01'),
(125, 'User Manage', 'user-account-suspend-page', 'admin', '2023-10-22 04:47:01', '2023-10-22 04:47:01'),
(126, 'User Manage', 'user-account-suspend', 'admin', '2023-10-22 04:47:01', '2023-10-22 04:47:01'),
(127, 'User Manage', 'user-trash-list', 'admin', '2023-10-22 04:49:01', '2023-10-22 04:49:01'),
(128, 'User Manage', 'user-restore-from-trash-list', 'admin', '2023-10-22 04:49:01', '2023-10-22 04:49:01'),
(129, 'Page Text Settings', 'login-page-settings-view', 'admin', '2023-10-22 05:12:33', '2023-10-22 05:12:33'),
(130, 'Page Text Settings', 'login-page-settings-update', 'admin', '2023-10-22 05:12:33', '2023-10-22 05:12:33'),
(131, 'Page Text Settings', 'register-page-settings-view', 'admin', '2023-10-22 05:12:33', '2023-10-22 05:12:33'),
(132, 'Page Text Settings', 'register-page-settings-update', 'admin', '2023-10-22 05:12:33', '2023-10-22 05:12:33'),
(133, 'Page Text Settings', 'account-page-settings-view', 'admin', '2023-10-22 05:12:33', '2023-10-22 05:12:33'),
(134, 'Page Text Settings', 'account-page-settings-update', 'admin', '2023-10-22 05:12:33', '2023-10-22 05:12:33'),
(135, 'Page Text Settings', 'introduction-page-settings-view', 'admin', '2023-10-22 05:12:33', '2023-10-22 05:12:33'),
(136, 'Page Text Settings', 'introduction-page-settings-update', 'admin', '2023-10-22 05:12:34', '2023-10-22 05:12:34'),
(137, 'Page Text Settings', 'experience-page-settings-view', 'admin', '2023-10-22 05:12:34', '2023-10-22 05:12:34'),
(138, 'Page Text Settings', 'experience-page-settings-update', 'admin', '2023-10-22 05:12:34', '2023-10-22 05:12:34'),
(139, 'Page Text Settings', 'education-page-settings-view', 'admin', '2023-10-22 05:12:34', '2023-10-22 05:12:34'),
(140, 'Page Text Settings', 'education-page-settings-update', 'admin', '2023-10-22 05:12:34', '2023-10-22 05:12:34'),
(141, 'Page Text Settings', 'work-page-settings-view', 'admin', '2023-10-22 05:12:34', '2023-10-22 05:12:34'),
(142, 'Page Text Settings', 'work-page-settings-update', 'admin', '2023-10-22 05:12:34', '2023-10-22 05:12:34'),
(143, 'Page Text Settings', 'skill-page-settings-view', 'admin', '2023-10-22 05:12:34', '2023-10-22 05:12:34'),
(144, 'Page Text Settings', 'skill-page-settings-update', 'admin', '2023-10-22 05:12:34', '2023-10-22 05:12:34'),
(145, 'Page Text Settings', 'photo-page-settings-view', 'admin', '2023-10-22 05:12:34', '2023-10-22 05:12:34'),
(146, 'Page Text Settings', 'photo-page-settings-update', 'admin', '2023-10-22 05:12:34', '2023-10-22 05:12:34'),
(147, 'General Settings', 'reading', 'admin', '2023-10-22 05:58:58', '2023-10-22 05:58:58'),
(148, 'General Settings', 'navbar-global-variant', 'admin', '2023-10-22 05:58:58', '2023-10-22 05:58:58'),
(149, 'General Settings', 'footer-global-variant', 'admin', '2023-10-22 05:58:58', '2023-10-22 05:58:58'),
(150, 'General Settings', 'site-identity', 'admin', '2023-10-22 05:58:58', '2023-10-22 05:58:58'),
(151, 'General Settings', 'basic-settings', 'admin', '2023-10-22 05:58:58', '2023-10-22 05:58:58'),
(152, 'General Settings', 'color-settings', 'admin', '2023-10-22 05:58:58', '2023-10-22 05:58:58'),
(153, 'General Settings', 'typography-settings', 'admin', '2023-10-22 05:58:58', '2023-10-22 05:58:58'),
(154, 'General Settings', 'seo-settings', 'admin', '2023-10-22 05:58:58', '2023-10-22 05:58:58'),
(155, 'General Settings', 'third-party-script-settings', 'admin', '2023-10-22 05:58:58', '2023-10-22 05:58:58'),
(156, 'General Settings', 'social-login-settings', 'admin', '2023-10-22 05:58:58', '2023-10-22 05:58:58'),
(157, 'General Settings', 'email-template-settings', 'admin', '2023-10-22 05:58:58', '2023-10-22 05:58:58'),
(158, 'General Settings', 'smtp-settings', 'admin', '2023-10-22 05:58:58', '2023-10-22 05:58:58'),
(159, 'General Settings', 'custom-css-settings', 'admin', '2023-10-22 05:58:59', '2023-10-22 05:58:59'),
(160, 'General Settings', 'custom-js-settings', 'admin', '2023-10-22 05:58:59', '2023-10-22 05:58:59'),
(161, 'General Settings', 'gdpr-settings', 'admin', '2023-10-22 05:58:59', '2023-10-22 05:58:59'),
(162, 'General Settings', 'licence-settings', 'admin', '2023-10-22 05:58:59', '2023-10-22 05:58:59'),
(163, 'General Settings', 'cache-settings', 'admin', '2023-10-22 05:58:59', '2023-10-22 05:58:59'),
(164, 'General Settings', 'database-upgrade', 'admin', '2023-10-22 05:58:59', '2023-10-22 05:58:59'),
(165, 'Payment Gateway Settings', 'payment-info-settings', 'admin', '2023-10-22 06:03:42', '2023-10-22 06:03:42'),
(166, 'Payment Gateway Settings', 'payment-gateway-settings', 'admin', '2023-10-22 06:03:42', '2023-10-22 06:03:42'),
(167, 'Menu Builder', 'menu-list', 'admin', '2023-10-22 06:20:10', '2023-10-22 06:20:10'),
(168, 'Menu Builder', 'menu-add', 'admin', '2023-10-22 06:20:10', '2023-10-22 06:20:10'),
(169, 'Menu Builder', 'menu-edit', 'admin', '2023-10-22 06:20:10', '2023-10-22 06:20:10'),
(170, 'Menu Builder', 'menu-delete', 'admin', '2023-10-22 06:20:10', '2023-10-22 06:20:10'),
(171, 'Form Builder', 'form-list', 'admin', '2023-10-22 06:27:24', '2023-10-22 06:27:24'),
(172, 'Form Builder', 'form-add', 'admin', '2023-10-22 06:27:24', '2023-10-22 06:27:24'),
(173, 'Form Builder', 'form-edit', 'admin', '2023-10-22 06:27:24', '2023-10-22 06:27:24'),
(174, 'Form Builder', 'form-delete', 'admin', '2023-10-22 06:27:24', '2023-10-22 06:27:24'),
(175, 'Form Builder', 'form-bulk-delete', 'admin', '2023-10-22 06:27:24', '2023-10-22 06:27:24'),
(176, 'Widget Builder', 'widget-list', 'admin', '2023-10-22 06:35:42', '2023-10-22 06:35:42'),
(177, 'Widget Builder', 'widget-add', 'admin', '2023-10-22 06:35:42', '2023-10-22 06:35:42'),
(178, 'Widget Builder', 'widget-update', 'admin', '2023-10-22 06:35:42', '2023-10-22 06:35:42'),
(179, 'Widget Builder', 'widget-delete', 'admin', '2023-10-22 06:35:42', '2023-10-22 06:35:42'),
(180, 'Email Template', 'email-template-list', 'admin', '2023-10-22 06:39:35', '2023-10-22 06:39:35'),
(181, 'Email Template', 'email-template-details', 'admin', '2023-10-22 06:39:35', '2023-10-22 06:39:35'),
(182, 'Email Template', 'email-template-update', 'admin', '2023-10-22 06:39:35', '2023-10-22 06:39:35'),
(183, 'Email Template', 'email-template-delete', 'admin', '2023-10-22 06:39:36', '2023-10-22 06:39:36'),
(184, 'Pages', 'page-list', 'admin', '2023-10-22 06:47:37', '2023-10-22 06:47:37'),
(185, 'Pages', 'page-create-new', 'admin', '2023-10-22 06:47:37', '2023-10-22 06:47:37'),
(186, 'Pages', 'page-edit', 'admin', '2023-10-22 06:47:37', '2023-10-22 06:47:37'),
(187, 'Pages', 'page-update', 'admin', '2023-10-22 06:47:37', '2023-10-22 06:47:37'),
(188, 'Pages', 'page-delete', 'admin', '2023-10-22 06:47:37', '2023-10-22 06:47:37'),
(189, 'Pages', 'page-delete-bulk-action', 'admin', '2023-10-22 06:47:38', '2023-10-22 06:47:38'),
(190, 'Pages', 'manage-404-page', 'admin', '2023-10-22 06:47:38', '2023-10-22 06:47:38'),
(191, 'Pages', 'update-404-page', 'admin', '2023-10-22 06:47:38', '2023-10-22 06:47:38'),
(192, 'Pages', 'manage-maintenance-page', 'admin', '2023-10-22 06:47:38', '2023-10-22 06:47:38'),
(193, 'Pages', 'update-maintenance-page', 'admin', '2023-10-22 06:47:38', '2023-10-22 06:47:38'),
(194, 'Language', 'language-list', 'admin', '2023-10-22 06:54:01', '2023-10-22 06:54:01'),
(195, 'Language', 'language-add', 'admin', '2023-10-22 06:54:01', '2023-10-22 06:54:01'),
(196, 'Language', 'language-edit', 'admin', '2023-10-22 06:54:01', '2023-10-22 06:54:01'),
(197, 'Language', 'language-word-edit', 'admin', '2023-10-22 06:54:01', '2023-10-22 06:54:01'),
(198, 'User Subscription', 'user-subscription-manual-payment-status-change', 'admin', '2023-10-25 04:31:06', '2023-10-25 04:31:06'),
(199, 'Support Ticket', 'support-ticket-add', 'admin', '2023-10-25 05:53:02', '2023-10-25 05:53:02'),
(200, 'Language', 'language-word-list', 'admin', '2023-10-25 22:44:08', '2023-10-25 22:44:08'),
(201, 'Language', 'language-word-add', 'admin', '2023-10-25 22:48:59', '2023-10-25 22:48:59'),
(202, 'User Manage', 'user-identity-verify-request-list', 'admin', '2023-10-25 23:04:19', '2023-10-25 23:04:19'),
(203, 'Blog Manage', 'blog-list', 'admin', '2023-12-21 00:28:04', '2023-12-21 00:28:04'),
(204, 'Blog Manage', 'blog-add', 'admin', '2023-12-21 00:28:04', '2023-12-21 00:28:04'),
(205, 'Blog Manage', 'blog-edit', 'admin', '2023-12-21 00:28:04', '2023-12-21 00:28:04'),
(206, 'Blog Manage', 'blog-delete', 'admin', '2023-12-21 00:28:04', '2023-12-21 00:28:04'),
(207, 'License Manage', 'generate-license-key', 'admin', '2023-12-21 00:28:04', '2023-12-21 00:28:04'),
(208, 'License Manage', 'update-license', 'admin', '2023-12-21 00:28:04', '2023-12-21 00:28:04');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `load_from` int NOT NULL DEFAULT '0',
  `is_synced` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `user_id`, `username`, `image`, `title`, `description`, `published_date`, `load_from`, `is_synced`, `created_at`, `updated_at`) VALUES
(2, 7, 'freelancer', '1699336547-6549d163cbd51.png', 'Build Laravel Website From Scratch', 'Zaika is an E-commerce app I designed for my client who owns a fashion brand in Britain - I did secondary reseach to understand people’s need and', NULL, 1, 1, '2023-03-13 04:52:50', '2024-07-16 00:49:39'),
(3, 7, 'freelancer', '1678780315-6410279b00cb4.png', 'Build Ecommerce Website From Scratch', 'Build Laravel Website From ScratchBuild Laravel Website From ScratchBuild Laravel Website From ScratchBuild Laravel Website From ScratchBuild', NULL, 1, 1, '2023-03-13 05:19:45', '2024-07-16 00:49:39'),
(4, 7, 'freelancer', '1678780293-641027851d676.png', 'Build PHP Website From Scratch', 'Build Ecommerce Website From ScratchBuild Ecommerce Website From ScratchBuild Ecommerce Website From ScratchBuild Ecommerce Website From Scratch', NULL, 1, 1, '2023-03-13 05:22:03', '2024-07-16 00:49:39'),
(5, 7, 'freelancer', '1678798094-64106d0e7e758.png', 'Build App Website From Scratch34sd sf ds s', 'Когда солнце заходит за горизонт, и звезды начинают светиться на ночном небе, моя душа наполняется тишиной и спокойствием.', NULL, 1, 1, '2023-03-13 05:24:23', '2024-07-16 00:49:40'),
(11, 8, 'tfreelancer2', '1678969543-64130ac75052e.png', 'as dasdasd asdas d', 'as dasd asdas asd asda sasd asda  asd asd asdas asdasd asd', NULL, 0, 0, '2023-03-16 06:25:43', '2023-03-16 06:25:43'),
(12, 8, 'riad', '1700653830-655deb06d4c22.png', 'Multi Vendor Ecommerce Marketplace', 'Multi vendor market place is designed for multi purpose use.', NULL, 1, 1, '2023-11-05 06:03:51', '2024-07-16 00:49:40'),
(13, 8, 'riad', '1700653951-655deb7f26715.png', '10 Years Working Experience in Service Marketplace', 'On demand service marketplace for freelancers and users.', NULL, 1, 1, '2023-11-05 06:07:34', '2024-07-16 00:49:41'),
(21, 8, 'riad', '1720435325-668bc27dac7a2.jpeg', 'Professional Html Developer', 'Professional Html Developer Professional Html Developer', NULL, 1, 0, '2024-07-08 04:42:06', '2024-07-08 04:42:06'),
(23, 6, 'freelancer2', '1720444569-668be6997a441.jpeg', 'asd asd as', 'asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd', NULL, 1, 0, '2024-07-08 07:16:10', '2024-07-08 07:16:10'),
(24, 7, 'freelancer', '1721110622-6696105e16744.jpeg', 'asdasdasd sa asdasd asd', 'asd asd asdas d asdasd asd asdas asdasd asdasdasdasd asd', NULL, 1, 1, '2024-07-16 00:17:02', '2024-07-16 00:49:41'),
(25, 1, 'client', '1727004522-66efff6ab683d.png', 'New Design', 'a asd asdasdas dasdasd asd asd asd asdasdasdasd asdasdasd asd', NULL, 0, 0, '2024-09-22 05:28:42', '2024-09-22 05:28:42'),
(26, 1, 'client', '1727004588-66efffaca87cb.png', 'sad asd asd2', 'sad asd asd sad asd asdasn asodasld asd asd asd saasd asd', NULL, 0, 0, '2024-09-22 05:29:48', '2024-09-22 05:43:17');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `category_id` bigint NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `basic_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `standard_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `premium_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `basic_revision` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `standard_revision` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `premium_revision` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `basic_delivery` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `standard_delivery` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `premium_delivery` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `basic_regular_charge` double NOT NULL,
  `basic_discount_charge` double DEFAULT NULL,
  `standard_regular_charge` double DEFAULT NULL,
  `standard_discount_charge` double DEFAULT NULL,
  `premium_regular_charge` double DEFAULT NULL,
  `premium_discount_charge` double DEFAULT NULL,
  `project_on_off` tinyint NOT NULL DEFAULT '1' COMMENT '0=off, 1=on',
  `project_approve_request` tinyint NOT NULL DEFAULT '0' COMMENT '0=request for approve, 1=approve,2=2 will change to 0 when the user resubmit after rejected.',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT 'o=pending, 1=approve',
  `is_pro` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pro_expire_date` timestamp NULL DEFAULT NULL,
  `offer_packages_available_or_not` int DEFAULT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `load_from` int NOT NULL DEFAULT '0',
  `is_synced` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `category_id`, `title`, `slug`, `description`, `image`, `video`, `basic_title`, `standard_title`, `premium_title`, `basic_revision`, `standard_revision`, `premium_revision`, `basic_delivery`, `standard_delivery`, `premium_delivery`, `basic_regular_charge`, `basic_discount_charge`, `standard_regular_charge`, `standard_discount_charge`, `premium_regular_charge`, `premium_discount_charge`, `project_on_off`, `project_approve_request`, `status`, `is_pro`, `pro_expire_date`, `offer_packages_available_or_not`, `meta_title`, `meta_description`, `meta_tags`, `load_from`, `is_synced`, `created_at`, `updated_at`) VALUES
(68, 5, 11, 'I will create honest and engaging tech content for your gadget or smart device', 'i-will-create-honest-and-engaging-tech-content-for-your-gadget-or-smart-device', '<header style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><h3 style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69); font-family: Macan, \"><span style=\"font-size: 18px;\">Hey tech brand 👋</span><span style=\"font-size: 18px;\">﻿</span></h3><div><br></div><div>If you’re launching a gadget, mobile accessory, or smart device and want real, high-quality influencer content that builds trust — I’ve got you covered.</div><div><br></div><div>I’m a tech content creator with a loyal following of gadget lovers on TikTok, Instagram, and YouTube Shorts. I specialize in hands-on demos, unboxings, feature walkthroughs, and everyday usage reviews that resonate with real users — not overly scripted ads.</div><div><br></div><div>Whether you’re promoting smartwatches, wireless earbuds, portable chargers, phone holders, or LED desk gadgets, I’ll make your product:</div><div><br></div><div>Look sleek, modern, and useful</div><div><br></div><div>Feel authentic and natural — like a friend showing off a cool device</div><div><br></div><div>Get attention from tech enthusiasts and casual users alike</div><div><br></div><div>Here’s what I can deliver:</div><div><br></div><div>A full unboxing experience with packaging aesthetics</div><div><br></div><div>Hands-on feature demo, usage, and impressions</div><div><br></div><div>Voiceover or captioned video to highlight top specs</div><div><br></div><div>A blend of practical + lifestyle use (e.g., using the smartwatch at the gym or in a work meeting)</div><div><br></div><div>HD video quality, proper lighting, branded mentions, and CTA</div><div><br></div><div>All content is edited for social performance — short, fast-paced, and clean visuals to drive interest, engagement, and conversions.</div><div><br></div><div>Let me help turn your tech into talk.</div></header>', '450|453|452|451', NULL, 'Basic', 'Standard', 'Premium', '1', '3', '5', '1 Days', '3 Days', 'Less than a week', 50, NULL, 200, NULL, 300, NULL, 1, 1, 1, 'yes', '2024-07-12 06:14:58', 1, 'Tech influencer unboxing and review content for your gadget', 'Launch your gadget with engaging influencer content — from unboxing to demo and voiceover reviews designed for social media.', NULL, 1, 1, '2023-03-05 19:27:46', '2025-07-09 23:16:06'),
(69, 5, 3, 'I will create authentic beauty content showcasing your toner, foundation, or skincare products', 'i-will-create-authentic-beauty-content-showcasing-your-toner-foundation-or-skincare-products', '<header style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><h4 style=\"border: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69); font-family: Macan, \"><span style=\"font-size: 18px;\">Hi there! 👋</span></h4><div>Are you looking for real, engaging content that shows your skincare or makeup product in action — not just a photo, but a full user experience? You’ve come to the right place!</div><div><br></div><div>I\'m a beauty content creator with over 15k engaged followers on Instagram and TikTok, known for my honest reviews, natural lighting, and minimal-to-glam transformations. I’ve worked with both indie and established brands, and my audience trusts my take on everything from daily toners to high-coverage foundations.</div><div><br></div><div>Here’s what I can do for your product:</div><div><br></div><div>Unbox it with excitement and aesthetic appeal 🌿</div><div><br></div><div>Apply it on-camera with close-up shots to showcase texture and blend ✨</div><div><br></div><div>Talk through key ingredients and benefits with a personal, relatable touch 💬</div><div><br></div><div>Provide high-resolution video or carousel content with captions and brand tags 📸</div><div><br></div><div>This is perfect for you if you\'re promoting:</div><div><br></div><div>Hydrating or exfoliating toners</div><div><br></div><div>Light/medium/full-coverage foundations</div><div><br></div><div>Serum-infused primers or moisturizers</div><div><br></div><div>Any other clean beauty or dermatologist-approved product</div><div><br></div><div>All content will be filmed in HD using natural lighting or softbox, with options for background styling (plants, mirrors, shelves, etc.) to match your brand vibe.</div></header>', '449|448|446|445', NULL, 'Basic', 'Standard', 'Premium', '2', '5', '10', '3 Days', 'Less than a week', 'Less than a month', 100, NULL, 200, NULL, 350, NULL, 1, 1, 1, NULL, NULL, 1, 'Beauty influencer content for toner or foundation', 'Get authentic, close-up skincare or foundation content from a beauty influencer with a trusted, engaged audience.', NULL, 1, 1, '2023-03-05 20:16:52', '2025-07-09 23:03:35'),
(70, 5, 24, 'Be the voice of the stars – join celebrity vews collabs', 'i-will-develop-php-laravel-website', '<header style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><h3 style=\"border: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69); font-family: Macan, \">About this project</h3></header><div class=\"description-wrapper\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 20px; position: relative; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><span style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; font-size: 0px;\"></span><div class=\"description-content\" data-impression-collected=\"true\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; overflow-wrap: break-word; max-height: none; overflow: hidden; word-break: break-word;\"><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Are you always on top of the latest celebrity headlines, red carpet looks, and viral pop culture moments? <br>🔥💬 Do your followers turn to you for quick updates, juicy insights, and trending takes on the entertainment world? Then this project is made for you!</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">We’re inviting entertainment-savvy influencers to join our marketplace for celebrity news collaborations. From Instagram reels to TikTok breakdowns and YouTube commentaries, you’ll get exclusive access to campaigns with entertainment brands, blogs, podcasts, media houses, and more. 📰🎙️</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">🚀 Platform Features Tailored for You:</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">✅ Instant Brand Matching – Work with media platforms and pop culture channels that vibe with your content</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">✅ Real-Time Campaign Analytics – Track your audience engagement, impressions &amp; post reach instantly</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">✅ Dedicated Messaging System – Collaborate directly with editors, producers, and brands</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">✅ Portfolio Display – Highlight your top viral takes, reviews, and celeb interviews</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">✅ Secure Payments – No delay, no stress — get paid safely after every campaign</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">✅ Content Briefs Made Simple – Easily follow campaign goals with crystal-clear briefs</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">🎯 Ideal for Influencers Who:</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Cover celebrity gossip, red carpet fashion, or trending Hollywood/Bollywood news</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Run an active pop culture commentary account (TikTok, YouTube Shorts, Reels, etc.)</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Have a fast-reacting, trend-aware audience</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Share humorous, informative, or stylish celebrity content</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Are looking to collaborate with news platforms, fashion critics, and entertainment shows</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>💼 Sample Campaign Types:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">“Hot or Not” Celebrity Style Reactions 👗🔥</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Breaking Celebrity News Reels 🎥🗞️</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Red Carpet Event Commentary 🎤🏆</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Influencer Collabs with Entertainment Blogs 💻📰</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Trending Couple/Drama Breakdown Posts 💔📸</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>📢 Ready to Be the First to Break the News?</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Join Influence.Bytesed.com and connect with top brands and media companies who are looking for creators just like you—smart, fast, and always in the know.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Your take on today’s headlines could be tomorrow’s viral hit. Let’s make the gossip go global. 🌐✨</p></div></div>', '346|343|341', NULL, 'Basic', 'Standard', 'Premium', '2', '1', '1', 'Less than a week', 'Less than a month', 'Less than 2 month', 5500, NULL, 6000, NULL, 7000, NULL, 1, 1, 1, NULL, NULL, 1, 'Be the voice of the stars – join celebrity vews collabs', 'Be the voice of the stars – join celebrity vews collabs', NULL, 1, 1, '2023-03-11 20:02:42', '2025-04-24 07:41:40'),
(73, 102, 4, 'Inspire wanderlust  travel influencers wanted', 'inspire-wanderlust-travel-influencers-wanted', '<header style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><h3 style=\"border: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69); font-family: Macan, \">About this project</h3><p style=\"border: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69);\"><br></p></header><div class=\"description-wrapper\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 20px; position: relative; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><div class=\"description-content\" data-impression-collected=\"true\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; overflow-wrap: break-word; max-height: none; overflow: hidden; word-break: break-word;\"><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Are you passionate about capturing breathtaking destinations, sharing hidden gems, and inspiring others to explore the world? 🌎✨ We’re searching for adventurous travel influencers ready to collaborate with top travel brands, resorts, tour companies, and experience platforms!</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Whether you\'re a digital nomad, weekend explorer, luxury traveler, or van life enthusiast, this project invites you to create authentic, captivating travel content that sparks wanderlust across Instagram, TikTok, YouTube, or Pinterest.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Work with brands to promote dream locations, boutique hotels, travel gear, apps, and once-in-a-lifetime experiences!</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>✅ Features Included for Influencers:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">📸 Sponsored Travel Content Opportunities – Showcase destinations, products, and services</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">✈️ Press Trip Invitations &amp; Brand Experiences – Get access to exclusive travel packages</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">🎥 Short-Form &amp; Long-Form Content Creation – From viral Reels to cinematic YouTube travel vlogs</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">📊 Real-Time Analytics Dashboard – Track your impact, reach, and brand engagement</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">💬 Direct Brand Communication – Collaborate easily with campaign coordinators</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">🔒 Secure Payment Processing – Guaranteed payouts after project completion</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>🎯 Ideal Influencer:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Love for travel, exploration, and storytelling</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Strong audience engagement on social media platforms</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">High-quality photography and videography skills</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Ability to deliver authentic, inspiring content that fits the brand’s narrative</p></div></div>', '358|356|355', NULL, 'Basic', NULL, NULL, '1', NULL, NULL, '3 Days', NULL, NULL, 5000, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 'yes', '2024-08-28 06:03:49', 0, 'Inspire wanderlust  travel influencers wanted', 'Inspire wanderlust  travel influencers wanted', NULL, 1, 1, '2023-04-01 18:14:30', '2025-04-26 22:43:01'),
(84, 102, 4, 'Explore the World with Us –Travel Influencer Collaboration', 'explore-the-world-with-us-travel-influencer-collaboration', '<header style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><h4 style=\"border: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69); font-family: Macan, \">About this project</h4></header><div class=\"description-wrapper\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 20px; position: relative; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><span style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; font-size: 0px;\"></span><div class=\"description-content\" data-impression-collected=\"true\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; overflow-wrap: break-word; max-height: none; overflow: hidden; word-break: break-word;\"><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Are you a passionate travel influencer eager to share captivating journeys and authentic experiences with your audience? Join our dynamic platform to connect with top travel brands seeking to showcase destinations through genuine storytelling and stunning visuals.​</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>What We Offer:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>🤝 Seamless Collaboration:</b> Partner with brands that align with your travel niche and audience demographics.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>📈 Performance Analytics:</b> Access real-time data on engagement, reach, and conversions to demonstrate your impact.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>💼 Portfolio Showcase:</b> Highlight your previous travel collaborations and adventures to attract potential brand partners.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>💬 Direct Communication:</b> Utilize our integrated messaging system for efficient coordination with brands.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>💰 Secure Payments:</b> Ensure timely and secure compensation for your creative efforts.​</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>Ideal Collaborators:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Travel influencers with a strong presence on platforms like Instagram, TikTok, or YouTube, who have an engaged following and a knack for creating compelling travel content.​</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>Join Us:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Become part of a community where your travel stories meet brand opportunities. Let\'s inspire wanderlust together.​</p></div></div>', '357|356|355', NULL, 'Basic', NULL, NULL, '1', NULL, NULL, '1 Days', NULL, NULL, 3000, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, 0, 'Explore the World with Us –Travel Influencer Collaboration', 'Explore the World with Us –Travel Influencer Collaboration', NULL, 1, 1, '2023-04-02 21:23:16', '2025-04-26 22:36:42'),
(92, 5, 3, 'Glow up your brand with skincare-entric beauty content', 'glow-up-your-brand-with-skincare-centric-beauty-content', '<header style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><h4 style=\"border: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69); font-family: Macan, \">About this project</h4></header><div class=\"description-wrapper\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 20px; position: relative; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><span style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; font-size: 0px;\"></span><div class=\"description-content\" data-impression-collected=\"true\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; overflow-wrap: break-word; max-height: none; overflow: hidden; word-break: break-word;\"><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\">Want your skincare brand to be seen and trusted? Let me help you shine—literally and figuratively. As a beauty influencer with a focus on skincare, I specialize in creating content that highlights ingredients, textures, results, and routines that resonate with skincare enthusiasts.</span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\"><br></span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\"><b>📸 What I Offer:</b></span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\"><br></span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\"><b>✅ Morning &amp; Night Routine Videos</b> – Organic, step-by-step content with your product featured</span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\"><b>✅ Before &amp; After Series</b> – Showcase real results that build trust</span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\"><b>✅ Ingredient-Focused Reviews</b> – Break down benefits, use-cases, and comparisons</span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\"><b>✅ Aesthetic Product Photography</b> – Clean, on-brand imagery for Instagram &amp; Pinterest</span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\"><b>✅ Unboxing &amp; First Impressions</b> – Raw, honest feedback that builds authenticity</span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\"><b>✅ Instagram Reels / TikToks</b> – High-quality vertical content optimized for engagement</span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\"><br></span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\"><b>📊 Audience Insights:</b></span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\">🎯 Age Group: 20–35</span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\">📍 Geo: US, Canada, UK, Australia</span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\">💬 Skin Concerns: Acne, dryness, glow-boosting, anti-aging</span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\">🌸 Engagement Rate: 5.2%+</span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\">👩‍⚕️ Audience Trust: Known for transparency &amp; honest reviews</span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\"><br></span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\"><b>✨ Why Work With Me?</b></span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\"><br></span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\">💬 Transparent, relatable skincare content</span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\">🎥 Trend-aware formats (GRWM, “empties,” dupe tests, etc.)</span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\">🧴 Trusted by a growing community of skincare lovers</span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\">📈 Proven results in boosting brand awareness + product interest</span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\">💡 Creative concepts tailored to your campaign goals</span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\"><br></span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\"><b>💌 Let’s Collaborate!</b></span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\">If you’re a skincare brand ready to connect with real skincare lovers through authentic, results-driven content—let’s talk. Whether it’s a one-time collab or a long-term ambassador role, I’m excited to bring your glow to the feed. ✨</span></p></div></div>', '332|337|336', NULL, 'Basic', 'Standard', 'Premium', '2', '1', '1', '2 Days', '3 Days', '1 Days', 1500, NULL, 2000, NULL, 2500, NULL, 1, 1, 1, 'yes', '2024-08-28 06:03:20', 1, 'Glow up your brand with skincare-entric beauty content', 'Glow up your brand with skincare-entric beauty content', NULL, 1, 1, '2023-05-15 01:25:04', '2025-04-24 04:28:07'),
(93, 4, 1, 'A journey to elevated lifestyle choices', 'a-journey-to-elevated-lifestyle-choices', '<p><b><span style=\"font-size: 24px;\">About this project&nbsp;</span></b></p><p><br></p><p><br></p><p>Hello, lovely people! I’m thrilled to offer you an exciting opportunity to transform your everyday life into something extraordinary. In this project, I’ll guide you through creating a well-rounded, intentional lifestyle that blends wellness, fashion, home decor, productivity, and self-care—everything you need to live your best life!</p><p><br></p><p>As an influencer, I’ve always believed in the power of small changes to make a big impact. From the latest wellness trends to the most stylish home decor pieces, I’ll share my favorite lifestyle products, tips, and tricks that help me feel more energized, organized, and inspired every day. Through honest reviews, styling tips, and sneak peeks into my own routine, I’ll show you how you can curate a lifestyle that’s all about YOU—living with intention, balance, and joy.</p><p><br></p><p><br></p><p><b>Key Features:</b></p><p><br></p><p><b>Product Reviews &amp; Recommendations:</b> I’ll feature top wellness, fashion, and home decor products that I absolutely love and use in my own life. Expect honest, in-depth reviews to help you make informed choices!</p><p><br></p><p><b>Real-Life Integration:</b> You’ll see how these products and practices fit into my daily routine, whether it’s a new skincare routine, stylish wardrobe essentials, or home upgrades that make my space feel cozy and inspiring.</p><p><br></p><p><b>Exclusive Discounts &amp; Offers:</b> Get access to special deals and discounts for the featured products—because everyone deserves to treat themselves!</p><p><br></p><p><b>Engaging Content: </b>I’ll connect with you through Q&amp;A sessions, interactive polls, and live videos where we can chat about all things lifestyle and I can answer your burning questions.</p><p><br></p><p><b>Personalized Tips:</b> From fashion styling to home decor and wellness routines, I’ll be sharing personalized advice tailored to elevate your life and help you feel your best.</p><p><br></p><p><b>Collaborations with Trusted Brands:</b> I’ll partner with some of the best lifestyle brands out there to bring you top-quality products that enhance your everyday experiences.</p><p><br></p><p>If you’re looking for a way to elevate your lifestyle, get inspired, and discover new products that truly add value to your life, this is for you! Let’s work together to create a lifestyle that you love, full of positivity, balance, and beauty. 🌿✨</p>', '382|381|380', NULL, 'Basic', 'Standard', 'Premium', '1', '1', '1000', '1 Days', '3 Days', 'Less than a week', 50, NULL, 250, NULL, 400, NULL, 1, 1, 1, NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2023-05-15 17:58:55', '2025-04-27 02:26:57'),
(94, 3, 11, 'A complete smart home transformation', 'a-complete-smart-home-transformation', '<header style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><h3 style=\"border: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69); font-family: Macan, \"><span style=\"font-family: \" times=\"\" new=\"\" roman\";\"=\"\">About this project</span></h3></header><div class=\"description-wrapper\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 20px; position: relative; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><span style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; font-size: 0px;\"></span><div class=\"description-content\" data-impression-collected=\"true\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; overflow-wrap: break-word; max-height: none; overflow: hidden; word-break: break-word;\"><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">I’m offering an exciting opportunity to explore the best smart home gadgets and tech available today. As an influencer in the tech and gadgets category, I’ll guide you through the process of upgrading your home with innovative solutions that will make your life more convenient, secure, and efficient.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">In this project, I will collaborate with top smart home brands to bring you a selection of cutting-edge devices, ranging from smart thermostats to intelligent security systems, voice-controlled assistants, and more. Through detailed product reviews, live demonstrations, and expert tutorials, I’ll show you exactly how these gadgets work and how they can be integrated into your home seamlessly.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><b>What’s Included:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><b>Product Showcases:</b> I will feature the latest smart home devices, highlighting their unique features and how they fit into everyday life.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><b>Hands-On Tutorials: </b>You’ll see how each device works, from installation to setup and real-life applications, helping you get the most out of your gadgets.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><b>Tech Tips &amp; Tricks:</b> I’ll share insider tips to optimize your smart home setup, making sure you get the best performance and convenience.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><b>Exclusive Discounts &amp; Deals:</b> Enjoy exclusive offers and discounts on the products featured in the project, giving you access to the best tech at unbeatable prices.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><b>Interactive Engagement: </b>Get involved with live Q&amp;A sessions, polls, and feedback opportunities, where you can ask questions and share your experiences with me.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">This project is perfect for those who want to dive into the world of smart home technology, but don’t know where to start. Whether you\'re looking to upgrade your current setup or completely redesign your space with the latest gadgets, I’ll guide you through every step to create the ultimate connected home.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">Let’s take your home to the next level—join me on this smart home journey and experience the future of living today!</p></div></div>', '377|378|372', NULL, 'Basic', 'Standard', 'Premium', '1', '2', '3', '1 Days', '2 Days', '3 Days', 50, NULL, 100, NULL, 150, NULL, 1, 1, 1, NULL, NULL, 1, 'Smart home exploring the future of tech and gadgets', 'Smart home exploring the future of tech and gadgets', NULL, 1, 1, '2023-05-15 18:54:37', '2025-04-30 07:10:47');
INSERT INTO `projects` (`id`, `user_id`, `category_id`, `title`, `slug`, `description`, `image`, `video`, `basic_title`, `standard_title`, `premium_title`, `basic_revision`, `standard_revision`, `premium_revision`, `basic_delivery`, `standard_delivery`, `premium_delivery`, `basic_regular_charge`, `basic_discount_charge`, `standard_regular_charge`, `standard_discount_charge`, `premium_regular_charge`, `premium_discount_charge`, `project_on_off`, `project_approve_request`, `status`, `is_pro`, `pro_expire_date`, `offer_packages_available_or_not`, `meta_title`, `meta_description`, `meta_tags`, `load_from`, `is_synced`, `created_at`, `updated_at`) VALUES
(95, 3, 5, 'I will create and share recipes featuring your food products', 'i-will-create-and-share-recipes-featuring-your-food-products', '<header style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><h2 class=\"section-title\" style=\"border: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 700;=\"\" font-size:=\"\" 20px;=\"\" line-height:=\"\" 28px;\"=\"\"></h2><h3><span style=\"font-family: \" times=\"\" new=\"\" roman\";\"=\"\">About this project</span></h3><h3><br></h3><h3><div class=\"_1mm74yfxe _1mm74yf0 _1mm74yfs4 _1mm74yf1d3 _1mm74yf115\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; box-sizing: var(--_1heu0h56v); gap: var(--_1heu0h54r); -webkit-box-orient: vertical; -webkit-box-direction: normal; flex-direction: var(--_1heu0h55l); display: var(--_1heu0h566); width: var(--_1heu0h59b); color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"></div><div class=\"_1mm74yfx9 _1mm74yf0 _1mm74yfru _1mm74yf1d3 _1mm74yf115\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; box-sizing: var(--_1heu0h56v); gap: var(--_1heu0h54p); flex-direction: var(--_1heu0h55k); -webkit-box-orient: vertical; -webkit-box-direction: normal; display: var(--_1heu0h566); width: var(--_1heu0h59b); color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><div class=\"_1ik1of50\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69);\"><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Want to showcase your food or beverage brand in the most delicious way possible? 🍝🍰</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">I\'m a passionate recipe creator and food influencer who transforms quality ingredients into crave-worthy dishes and vibrant visual content!</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">I specialize in developing original recipes featuring your product and presenting them through eye-catching photos, videos, and step-by-step guides. From comforting classics to modern gourmet creations, I can help your brand stand out and connect with food-loving audiences across Instagram, TikTok, YouTube, and Pinterest.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Let’s collaborate to bring your products to life in kitchens around the world! 🌍🍴</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">✅ Features You’ll Get:</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">🍳 Custom Recipe Development</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">➤ A unique, brand-focused recipe using your food or beverage product.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">📸 High-Quality Food Photography</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">➤ Professional, mouth-watering shots of the final dish and ingredients.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">🎥 Engaging Recipe Videos</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">➤ Step-by-step reels, TikToks, or YouTube shorts — perfect for social sharing.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">📝 Recipe Write-Up for Blog or Post</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">➤ Full, detailed written recipe ready for your use in blogs, posts, or ads.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">📈 Audience Engagement and Performance Insights</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">➤ Analytics including views, saves, clicks, and engagement rates.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">🎯 Who This is Perfect For:</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Food &amp; beverage brands launching new products</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Health food companies promoting ingredients or supplements</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Kitchen tool brands seeking recipe-based promotions</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Gourmet shops and online marketplaces boosting brand visibility</p></div></div></h3></header>', '373|372|371', NULL, 'Basic', 'Standard', 'Premium', '4', '6', '8', '3 Days', '3 Days', '2 Days', 100, NULL, 200, NULL, 300, NULL, 1, 1, 1, 'yes', '2024-09-28 00:50:35', 1, 'I will create and share recipes featuring your food products', 'I will create and share recipes featuring your food products', NULL, 1, 1, '2023-05-15 19:03:12', '2025-04-30 07:11:41'),
(96, 3, 18, 'I will promote your business to a targeted audience', 'i-will-promote-your-business-to-a-targeted-audience', '<header style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><h2 class=\"section-title\" style=\"border: 0px; margin: 0px; outline: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 700;=\"\" font-size:=\"\" 20px;=\"\" line-height:=\"\" 28px;\"=\"\"></h2><h3><span style=\"font-family: \" times=\"\" new=\"\" roman\";\"=\"\">About this project</span></h3><h3><span style=\"font-family: \" times=\"\" new=\"\" roman\";\"=\"\"><br></span></h3><h3><span style=\"font-family: \" times=\"\" new=\"\" roman\";\"=\"\"><br></span></h3><p><span style=\"font-family: \" times=\"\" new=\"\" roman\";\"=\"\"><br></span><span style=\"color: rgb(71, 84, 103); font-size: 16px; display: inline !important;\">Looking to expand your business reach and drive real engagement? 📊✨&nbsp;</span><span style=\"color: rgb(71, 84, 103); font-size: 16px; display: inline !important;\">I’m a business-focused influencer with an active, engaged audience made up of entrepreneurs, startups, investors, and business enthusiasts.</span></p><p style=\"border: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69);\"></p><ul></ul><p></p><p style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; overflow-wrap: break-word; max-height: none; overflow: hidden; word-break: break-word;\"></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">I specialize in authentic business promotion, sharing brands, services, and success stories throughhigh-quality posts, professional storytelling, and actionable content.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Whether you’re launching a new service, offering a startup solution, or looking to build brand trust, I can help you reach the right people and boost your credibility.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Let’s work together to turn attention into action for your business! 🚀</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>✅ Features You’ll Get:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">📢 Business Shoutouts or Dedicated Posts</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">➤ Highlighting your brand, services, or products authentically on my platforms.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">📊 Professional Business Storytelling</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">➤ Engaging captions or video scripts that build trust and authority.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">🎥 Promotional Videos or Reels</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">➤ Short-form content to explain your offer, showcase benefits, and drive clicks.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">🔗 Call-to-Action Integration</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">➤ Directing my audience to your website, service page, or landing page.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">📈 Performance Insights</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">➤ Analytics including impressions, reach, clicks, and engagement.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>🎯 Ideal for:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b><br></b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Startups and entrepreneurs launching new services</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Business coaches, consultants, and financial advisors</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Tech platforms, SaaS businesses, and service-based brands</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">E-commerce stores targeting business professionals</p><p></p></header>', '376|375|374', NULL, 'Basic', 'Standard', 'Premium', '1', '2', '1000', '1 Days', '2 Days', 'Less than a week', 200, NULL, 250, NULL, 300, NULL, 1, 1, 1, 'yes', '2024-09-28 00:49:55', 1, 'I will promote your business to a targeted audience', 'I will promote your business to a targeted audience', NULL, 1, 1, '2023-05-15 19:29:02', '2025-04-27 00:36:18'),
(97, 3, 11, 'I will review & unbox your tech products', 'i-will-write-seo-content-for-your-blog', '<header style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><h3 style=\"border: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69); font-family: Macan, \"><span style=\"font-family: \" times=\"\" new=\"\" roman\";\"=\"\">About this project</span></h3></header><div class=\"description-wrapper\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 20px; position: relative; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><span style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; font-size: 0px;\"></span><div class=\"description-content\" data-impression-collected=\"true\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; overflow-wrap: break-word; max-height: none; overflow: hidden; word-break: break-word;\"><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">&nbsp;Looking for the perfect influencer to deliver a professional, detailed, and engaging unboxing experience? 🎥✨</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">I’m a tech content creator with a passion for the latest innovations — from smartphones and smartwatches to gaming gear and smart home devices.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">I offer high-quality unboxing and review content that showcases your product\'s design, features, and real-world performance, helping you connect with tech-savvy audiences across platforms like YouTube, TikTok, Instagram, and Pinterest.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Partner with me to build trust, boost awareness, and drive sales with authentic and visually appealing content!</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>✅ Features You’ll Get:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b><br></b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">🎥 Professional Unboxing Video</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">➤ Showcasing packaging, first impressions, and initial hands-on experience.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">🛠️ Detailed Hands-On Review</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">➤ Highlighting product features, usability, advantages, and honest feedback.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">🎙️ Voiceover or On-Camera Presentation</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">➤ Options for stylish narrated videos or personal on-camera appearances.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">📈 Real-Time Engagement Insights</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">➤ Access to performance data — impressions, clicks, reach.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">📦 Promotion Across My Active Tech Channels</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">➤ Reach thousands of tech enthusiasts and potential customers.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>🎯 Who I Work Best With:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b><br></b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Brands launching new tech gadgets, wearables, or smart devices</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Companies seeking authentic, real-world product demonstrations</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Businesses aiming to create buzz around product launches</p></div></div>', '369|370|368', NULL, 'Basic', 'Standard', 'Premium', '1', '2', '3', '3 Days', '2 Days', '3 Days', 200, NULL, 400, NULL, 500, NULL, 1, 1, 1, 'yes', '2024-09-28 00:48:58', 1, 'I will review & unbox your tech products', 'I will review & unbox your tech products', NULL, 1, 1, '2023-05-15 20:18:29', '2025-04-30 07:10:19'),
(98, 3, 2, 'Street style fashion influencer collabs', 'street-style-fashion-influencer-collabs', '<header style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><h4 style=\"border: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 700;=\"\" font-size:=\"\" 20px;=\"\" line-height:=\"\" 28px;\"=\"\">About this project</h4></header><div class=\"description-wrapper\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 20px; position: relative; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><div class=\"description-content\" data-impression-collected=\"true\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; overflow-wrap: break-word; max-height: none; overflow: hidden; word-break: break-word;\"><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br role=\"presentation\" data-uw-rm-sr=\"\"></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Are you ready to set the trends, not just follow them? 😎🔥</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">We’re calling all bold, authentic, and edgy fashion influencers who live and breathe street style! From oversized fits to luxury sneakers, distressed denim to statement accessories — your unique vibe deserves the spotlight.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Join forces with brands looking to promote urban fashion collections, sneaker drops, designer streetwear, and indie labels through fresh, powerful content. Show the world how you style the streets!</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>✅ Features for Influencers:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b><br></b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">📸 Street Style Photoshoot Opportunities</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">➤ Collaborate on creative shoots in iconic city spots or urban backdrops.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">🎥 Dynamic Fashion Reels &amp; TikToks</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">➤ Create quick, edgy styling videos, fit checks, and behind-the-scenes content.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">💬 Direct Brand Communication</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">➤ Coordinate campaigns easily with streetwear brands and fashion startups.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">📈 Analytics Dashboard Access</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">➤ Get live stats on your campaign reach, engagement, and saves.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">🛍️ Exclusive Sneak Peeks and Product Launches</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">➤ Be the first to rock limited edition pieces and promote exclusive drops.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>🎯 Ideal Influencer:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b><br></b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Passionate about streetwear, sneakers, and edgy fashion</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Skilled at street photography or fashion videography</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Strong Instagram, TikTok, or YouTube presence</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Ability to deliver both photo and short-form video content</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Authentic voice with a deep connection to urban fashion culture</p></div></div>', '367|366|365', NULL, 'Basic', 'Standard', 'Premium', '1', '1', '1', '2 Days', '3 Days', '3 Days', 300, NULL, 500, NULL, 700, NULL, 1, 1, 1, 'yes', '2024-09-08 00:48:30', 1, 'Street style fashion influencer collabs', 'Street style fashion influencer collabs', NULL, 1, 1, '2023-05-15 21:42:56', '2025-04-26 23:31:52'),
(99, 4, 2, 'Your fashion brand with trend driven high Impact content', 'your-fashion-brand-with-trend-driven-high-impact-content', '<header style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><h4 style=\"border: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 700;=\"\" font-size:=\"\" 20px;=\"\" line-height:=\"\" 28px;\"=\"\">About this project</h4></header><div class=\"description-wrapper\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 20px; position: relative; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><div class=\"description-content\" data-impression-collected=\"true\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; overflow-wrap: break-word; max-height: none; overflow: hidden; word-break: break-word;\"><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">&nbsp;Are you a fashion influencer passionate about style, trends, and authentic engagement? Join our dynamic platform to collaborate with top fashion brands seeking to connect with audiences through genuine and stylish content.​</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><b>What We Offer:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">🤝 Seamless Collaboration: Connect directly with brands that align with your fashion niche and audience.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">📈 Performance Analytics: Access real-time data on engagement, reach, and conversions to showcase your impact.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">💼 Portfolio Showcase: Highlight your previous collaborations and style to attract potential brand partners.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">💬 Direct Communication: Utilize our integrated messaging system for efficient coordination with brands.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">💰 Secure Payments: Ensure timely and secure compensation for your creative efforts.​</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><b>Ideal Collaborators:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">Fashion influencers with a strong presence on platforms like Instagram, TikTok, or YouTube, who have an engaged following and a passion for creating compelling fashion content.​</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><b>Join Us:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">Become part of a community where your fashion influence meets brand opportunities. Let\'s create stylish narratives that resonate.​</p></div></div>', '344|343|337', NULL, 'Basic', 'Standard', 'Premium', '1', '1', '1', '1 Days', '1 Days', '1 Days', 200, NULL, 250, NULL, 300, NULL, 1, 1, 1, 'yes', '2024-08-22 05:47:47', 1, 'Your fashion brand with trend driven high Impact content', 'Your fashion brand with trend driven high Impact content', NULL, 1, 1, '2023-05-15 21:51:24', '2025-04-24 06:39:08'),
(100, 5, 2, 'Elevate your brand with authentic fashion influence', 'i-will-write-compelling-website-content-copywriting', '<header style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><h2 class=\"section-title\" style=\"border: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 700;=\"\" font-size:=\"\" 20px;=\"\" line-height:=\"\" 28px;\"=\"\"></h2><h3><span style=\"font-family: \" times=\"\" new=\"\" roman\";\"=\"\">About this project</span></h3><h3><br></h3></header><div class=\"description-wrapper\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 20px; position: relative; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><div class=\"description-content\" data-impression-collected=\"true\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; overflow-wrap: break-word; max-height: none; overflow: hidden; word-break: break-word;\"><div class=\"description-wrapper\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 20px; position: relative; font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><div class=\"description-content\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; overflow-wrap: break-word; max-height: none; overflow: hidden; word-break: break-word;\"><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><span style=\"display: inline !important;\">Are you a fashion influencer passionate about style, trends, and authentic engagement? Join our dynamic platform to collaborate with top fashion brands seeking to connect with audiences through genuine and stylish content.​</span></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>What We Offer:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>🤝 Seamless Collaboration:</b> Connect directly with brands that align with your fashion niche and audience.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>📈 Performance Analytics:</b> Access real-time data on engagement, reach, and conversions to showcase your impact.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">💼<b> Portfolio Showcase:</b> Highlight your previous collaborations and style to attract potential brand partners.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>💬 Direct Communication:</b> Utilize our integrated messaging system for efficient coordination with brands.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>💰 Secure Payments:</b> Ensure timely and secure compensation for your creative efforts.​</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>Ideal Collaborators:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Fashion influencers with a strong presence on platforms like Instagram, TikTok, or YouTube, who have an engaged following and a passion for creating compelling fashion content.​</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>Join Us:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Become part of a community where your fashion influence meets brand opportunities. Let\'s create stylish narratives that resonate.​</p></div></div></div></div>', '345|344|343', NULL, 'Basic', 'Standard', 'Premium', '2', '1', '1', '1 Days', '2 Days', '3 Days', 100, NULL, 200, NULL, 300, NULL, 1, 1, 1, NULL, NULL, 1, 'Elevate your brand with authentic fashion influence', 'Elevate your brand with authentic fashion influence', NULL, 1, 1, '2023-05-15 22:13:39', '2025-04-29 05:53:49'),
(101, 102, 1, 'Empower and  Elevate – wellness  and self-growth influencer campaign', 'i-will-write-powerful-and-engaging-website-content', '<header style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><h4 style=\"border: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 700;=\"\" font-size:=\"\" 20px;=\"\" line-height:=\"\" 28px;\"=\"\"><span style=\"font-family: \" times=\"\" new=\"\" roman\";\"=\"\">About this project</span></h4></header><div class=\"description-wrapper\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 20px; position: relative; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><span style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; font-size: 0px;\"></span><div class=\"description-content\" data-impression-collected=\"true\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; overflow-wrap: break-word; max-height: none; overflow: hidden; word-break: break-word;\"><div class=\"description-wrapper\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 20px; position: relative; font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><div class=\"description-content\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; overflow-wrap: break-word; max-height: none; overflow: hidden; word-break: break-word;\"><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Are you passionate about guiding others on their journey to a better, more mindful life? 🌞 Whether you\'re sharing meditation rituals, journaling prompts, morning routines, or emotional well-being tips—your voice inspires change.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">We’re teaming up with wellness brands, life coaches, meditation apps, supplement companies, and self-improvement startups who are eager to connect with authentic creators who walk the walk. This is your space to influence for impact—one intention at a time.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>✅ Platform Features for You:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b><br></b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>Smart Brand Matching</b> – Connect with wellness-focused brands that match your values</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>Real-Time Analytics </b>– Measure reach, saves, and engagement on your content</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>Branded Campaign Briefs</b> – Clear goals so your message aligns with the brand</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>Integrated Messaging</b> – Chat directly with campaign coordinators</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>Portfolio Display</b> – Showcase your favorite rituals, reels, and content pieces</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>Secure Payment Process</b> – Guaranteed payouts for each project completed</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b>🎯 Ideal for Influencers Who:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><b><br></b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Share tips on journaling, meditation, mindset, or mental wellness</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Promote a balance of physical, emotional, and spiritual well-being</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Have a following on Instagram, TikTok, YouTube, or Pinterest</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Are experienced in creating motivational reels, mindfulness blogs, or podcast clips</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Love working with ethical, organic, and self-growth brands</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Please contact us before place an order.</p></div></div></div></div>', '334|339|338', NULL, 'Basic', 'Standard', 'Premium', '1', '1', '1', '1 Days', '1 Days', '1 Days', 100, NULL, 200, NULL, 300, NULL, 1, 1, 1, NULL, NULL, 1, 'Empower and  Elevate – wellness  and self-growth influencer campaign', 'Empower and  Elevate – wellness  and self-growth influencer campaign', NULL, 1, 1, '2023-05-15 22:56:08', '2025-04-24 04:52:59');
INSERT INTO `projects` (`id`, `user_id`, `category_id`, `title`, `slug`, `description`, `image`, `video`, `basic_title`, `standard_title`, `premium_title`, `basic_revision`, `standard_revision`, `premium_revision`, `basic_delivery`, `standard_delivery`, `premium_delivery`, `basic_regular_charge`, `basic_discount_charge`, `standard_regular_charge`, `standard_discount_charge`, `premium_regular_charge`, `premium_discount_charge`, `project_on_off`, `project_approve_request`, `status`, `is_pro`, `pro_expire_date`, `offer_packages_available_or_not`, `meta_title`, `meta_description`, `meta_tags`, `load_from`, `is_synced`, `created_at`, `updated_at`) VALUES
(102, 5, 13, 'Finding family balance in a digital world', 'finding-family-balance-in-a-digital-world', '<header style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><h4 style=\"border: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 700;=\"\" font-size:=\"\" 20px;=\"\" line-height:=\"\" 28px;\"=\"\"><span style=\"font-family: \" times=\"\" new=\"\" roman\";\"=\"\">About this project</span></h4></header><div class=\"description-wrapper\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 20px; position: relative; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><div class=\"description-content\" data-impression-collected=\"true\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; overflow-wrap: break-word; max-height: none; overflow: hidden; word-break: break-word;\"><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">Today\'s parents face unique challenges balancing technology with family connection. Here are key strategies for success:</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><b>Create Tech-Free Zones 🚫</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">Designate screen-free areas like dinner tables and bedrooms to foster meaningful conversation.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><b>Quality Over Quantity 🌟</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">Focus on educational content and co-viewing experiences rather than just limiting screen time.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><b>Model Healthy Habits 👀</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">Children learn from watching you! Put your own phone down during family time.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><b>Embrace Analog Activities ❤️</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">Board games, outdoor adventures, and crafts build stronger bonds than digital entertainment.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><b>Age-Appropriate Boundaries 👶👦👱‍♀️</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">Adjust your approach as children grow, from strict limits for toddlers to guided independence for teens.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">Remember: Technology will evolve, but children\'s needs for connection remain constant. Your presence matters more than any screen!</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">Your satisfaction is my priority, so I offer UNLIMITED revisions!</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">Please message me before placing an order. Let\'s discuss how I can craft the perfect&nbsp;<span style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; font-weight: 700;\">website copy</span>&nbsp;for your needs!</p></div></div>', '350|352|351', NULL, 'Basic', 'Standard', 'Premium', '1', '1', '1', '1 Days', '1 Days', '1 Days', 100, NULL, 200, NULL, 300, NULL, 1, 1, 1, NULL, NULL, 1, 'Finding family balance in a digital world', 'Finding family balance in a digital world', NULL, 1, 1, '2023-05-15 22:57:22', '2025-04-24 07:40:33'),
(103, 5, 13, 'Promote Your Parenting or Family Brand to 10M+ Monthly Pinterest Viewers – Forever', 'promote-your-parenting-or-family-brand-to-10m-monthly-pinterest-viewers-forever', '<header style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><h4 style=\"border: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 700;=\"\" font-size:=\"\" 20px;=\"\" line-height:=\"\" 28px;\"=\"\"><span style=\"font-size: 24px;\">About this project</span></h4><h4 style=\"border: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 700;=\"\" font-size:=\"\" 20px;=\"\" line-height:=\"\" 28px;\"=\"\"><span style=\"color: rgb(71, 84, 103); font-size: 16px; font-family: sans-serif; display: inline !important;\"><br></span></h4><h4 style=\"border: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 700;=\"\" font-size:=\"\" 20px;=\"\" line-height:=\"\" 28px;\"=\"\"><span style=\"color: rgb(71, 84, 103); font-size: 16px; font-family: sans-serif; display: inline !important;\">Are you a parenting coach, family blogger, or selling products for moms, dads, or kids? I’ll feature your content on a high-traffic Pinterest account with over 10 million monthly viewers — where it stays permanently.</span></h4></header><div class=\"description-wrapper\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 20px; position: relative; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><div class=\"description-content\" data-impression-collected=\"true\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; overflow-wrap: break-word; max-height: none; overflow: hidden; word-break: break-word;\"><div class=\"description-wrapper\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 20px; position: relative; font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><div class=\"description-content\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; overflow-wrap: break-word; max-height: none; overflow: hidden; word-break: break-word;\"><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">This is perfect for parenting tips, family-friendly products, educational tools, kids’ activities, baby gear, and more.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">With 13+ years of Pinterest experience and a proven strategy I use for my own successful shops, I’ll give your content the organic, ongoing exposure it needs to thrive.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">👨‍👩‍👧‍👦 What You’ll Get:</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">✅ Permanent pin placement on a targeted Parenting &amp; Family board</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">✅ SEO-optimized title, description &amp; tags</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">✅ Eye-catching, keyword-rich design</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">✅ No paid ads — 100% organic reach</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">✅ One-time fee for lifetime visibility</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\">Let’s connect your message with the families who need it most — and keep it growing daily.</p></div></div></div></div>', '352|351|340', NULL, 'Basic', 'Standard', 'Premium', '1', '1', '1', '1 Days', '1 Days', '1 Days', 100, NULL, 200, NULL, 300, NULL, 1, 1, 1, 'yes', '2024-08-28 22:56:03', 1, NULL, NULL, NULL, 1, 1, '2023-05-15 22:58:35', '2025-04-29 05:20:35'),
(104, 102, 11, 'I will promote your product on my 10 000 000 views traffic pinterest boards', 'i-will-promote-your-product-on-my-10-000-000-views-traffic-pinterest-boards', '<header style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><h2 class=\"section-title\" style=\"border: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 700;=\"\" font-size:=\"\" 20px;=\"\" line-height:=\"\" 28px;\"=\"\"></h2><h3><span style=\"font-family: \" times=\"\" new=\"\" roman\";\"=\"\">About this project</span></h3></header><div class=\"description-wrapper\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 20px; position: relative; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><span style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; font-size: 0px;\"></span><div class=\"description-content\" data-impression-collected=\"true\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; overflow-wrap: break-word; max-height: none; overflow: hidden; word-break: break-word;\"><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">Looking to skyrocket your product visibility on one of the most engaged platforms? With over 10 million monthly views across my curated Pinterest boards, I offer a powerful opportunity to showcase your product in front of a highly active, niche-targeted audience.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">Whether you\'re promoting fashion, wellness, home décor, digital products, or eCommerce items – I’ll strategically pin your content where it gets maximum exposure, saves, and clicks.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><b>✅ What You’ll Get:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">📌 High-Engagement Pin Placement on viral boards</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">🌎 Niche-Relevant Audience Targeting (fashion, home, beauty, lifestyle, etc.)</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">📈 Increased Traffic to Your Product Page or Website</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">🖼️ Custom Pin Design (Optional – depending on package)</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">🔄 Organic Reach Through Repins and Saves</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">📊 Performance Snapshot (Impressions, saves, clicks)</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><b>🔥 Ideal for:</b></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">Small businesses, Etsy sellers, content creators, bloggers, digital product sellers, and lifestyle brands looking to expand their reach through evergreen Pinterest marketing.</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">Let me help you turn pins into profits!</p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><span style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; font-weight: 700;\">What are you waiting for, Order your thumbnail Now !</span></p></div></div>', '346|349|348', NULL, 'Basic', 'Standard', 'Premium', '5', '1', '1', '1 Days', '1 Days', '1 Days', 50, NULL, 234, NULL, 456, NULL, 1, 1, 1, 'yes', '2024-08-17 22:41:49', 1, 'I will promote your product on my 10 000 000 views traffic pinterest boards', 'I will promote your product on my 10 000 000 views traffic pinterest boards', NULL, 1, 1, '2023-05-15 23:01:21', '2025-04-24 07:26:23'),
(107, 4, 11, 'Boost your tech brand with permanent exposure to 10M+ monthly viewers', 'boost-your-tech-brand-with-permanent-exposure-to-10m-monthly-viewers', '<header style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; color: rgb(98, 100, 106); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><h2 class=\"section-title\" style=\"border: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 25px; color: rgb(64, 65, 69); font-family: Macan, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 700;=\"\" font-size:=\"\" 20px;=\"\" line-height:=\"\" 28px;\"=\"\"></h2><h3><span style=\"font-family: \" times=\"\" new=\"\" roman\";\"=\"\">About this project</span></h3></header><div class=\"description-wrapper\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px 0px 20px; position: relative;\" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"><span style=\"color: rgb(98, 100, 106); border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; font-size: 0px;\"></span><div class=\"description-content\" data-impression-collected=\"true\" style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; overflow-wrap: break-word; max-height: none; overflow: hidden; word-break: break-word;\"><p style=\"color: rgb(98, 100, 106); border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">Want to get your tech product in front of a huge audience? I’ll showcase your gadget on my high-traffic Pinterest account, where it can be seen by over 10 million monthly viewers — and it stays there forever.</p><p style=\"color: rgb(98, 100, 106); border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><b>No ads. No pressure selling. Just long-term, organic visibility.</b></p><p style=\"color: rgb(98, 100, 106); border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"color: rgb(98, 100, 106); border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">With 13+ years of experience growing accounts and promoting my own shops (Etsy, Redbubble, ArtStation, YouTube), I know how to create scroll-stopping content that gets results.</p><p style=\"color: rgb(98, 100, 106); border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"color: rgb(98, 100, 106); border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"color: rgb(98, 100, 106); border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><b>💡 What’s Included:</b></p><p style=\"color: rgb(98, 100, 106); border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"color: rgb(98, 100, 106); border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">✅ Permanent placement on a targeted Tech &amp; Gadgets board</p><p style=\"color: rgb(98, 100, 106); border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">✅ SEO-optimized title, description, and tags</p><p style=\"color: rgb(98, 100, 106); border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">✅ Visually engaging, keyword-rich pin design</p><p style=\"color: rgb(98, 100, 106); border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">✅ 100% organic reach — no bots, no paid traffic</p><p style=\"color: rgb(98, 100, 106); border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\">✅ One-time payment for lifetime exposure</p><p style=\"color: rgb(98, 100, 106); border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"color: rgb(98, 100, 106); border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><span style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; font-weight: 700;\"><span style=\"background: rgb(255, 236, 209);\">Please Message Me Before Place the Order</span></span></p><p style=\"color: rgb(98, 100, 106); border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><br></p><p style=\"color: rgb(98, 100, 106); border: 0px; margin-right: 0px; margin-left: 0px; outline-style: initial; outline-width: 0px; padding: 0px;\" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;\"=\"\"><span style=\"border: 0px; margin: 0px; outline-style: initial; outline-width: 0px; padding: 0px; font-weight: 700;\"><span style=\"background: rgb(255, 236, 209);\">Tag:&nbsp;</span></span>Facebook Ads Campaign Instagram Ads Shopify Facebook Ads Social Media Ads.</p></div></div>', '348|347|346', NULL, 'Basic', 'Standard', 'Premium', '3', '1', '1', '1 Days', '1 Days', '1 Days', 100, NULL, 455, NULL, 678, NULL, 1, 1, 1, 'yes', '2024-05-17 22:41:29', 1, 'Boost your tech brand with permanent exposure to 10M+ monthly viewers', 'Boost your tech brand with permanent exposure to 10M+ monthly viewers', NULL, 1, 1, '2023-05-15 23:08:19', '2025-04-24 07:14:53'),
(189, 9, 2, 'asdjn adalskd add asd asd asd ada da', 'asdjn-adalskd-add-asd-asd-asd-ada-da', '<p>adasnlkamsdklasmd;lasd;lakd;ask d;akdasjdaoisjdaiosjdaosd paosd asdas dasd</p>', '1709472190-65e479bedb914.png', NULL, 'Basic', 'Standard', 'Premium', '1', '1', '1', '1 Days', '1 Days', '1 Days', 50, 40, 60, 50, 70, 60, 1, 1, 1, NULL, NULL, 1, NULL, NULL, NULL, 1, 1, '2024-03-03 07:23:10', '2024-07-15 05:50:56'),
(190, 9, 2, 'I will model and promote your fashion brand on Instagram', 'i-will-model-and-promote-your-fashion-brand-on-instagram', '<p>Hi! I\'m a fashion-forward influencer with an engaged audience. I’ll create high-quality posts or reels wearing your product, tag your brand, and write compelling captions that drive engagement and awareness.</p>', '436|434|433', NULL, 'Basic', 'Standard', 'Premium', '1', '1', '1', '1 Days', '1 Days', '1 Days', 50, NULL, 60, NULL, 70, NULL, 1, 1, 1, NULL, NULL, 1, 'Promote your fashion brand on Instagram', 'I’ll model and showcase your clothing brand with reels or posts to drive visibility and engagement.', NULL, 1, 1, '2024-03-03 07:25:22', '2025-07-09 04:39:11'),
(248, 5, 1, 'Style your space – home decor influencer collabs', 'i-will-find-instagram-tiktok-youtube-influencer-to-research-influencer-marketing-list', '<p><b>About this project</b></p><p><br></p><p>Are you passionate about transforming spaces into cozy, stylish sanctuaries? <br><br>🏡✨ Do you love sharing decor tips, before-and-after transformations, or showcasing minimalist, boho, or luxury interiors with your followers?</p><p><br></p><p>We’re partnering with brands in the home decor and lifestyle niche – from furniture companies to eco-friendly organizers and aesthetic lighting brands – and we’re looking for creators like you to bring them to life on social media. Whether you do room makeovers, shelf styling, or mood board magic, this is your chance to monetize your taste and influence.</p><p><br></p><p><b>✅ Features You’ll Have Access To:</b></p><p><b><br></b></p><p>Brand Collaborations: Match with interior &amp; decor brands aligned with your audience</p><p>Custom Campaign Briefs: Clear guidelines so you can create with purpose</p><p>Real-Time Analytics: Track views, reach, and ROI for your campaigns</p><p>One-Click Portfolio Display: Showcase your top posts, collabs, and decor transformations</p><p>Secure Payment System: Guaranteed payments on completion</p><p>Direct Messaging: Easy chat with clients for faster turnaround</p><p><br></p><p><br></p><p><b>🎯 Ideal Influencer Profile:</b></p><p>Aesthetic-driven Instagram or TikTok feed</p><p>Home organization, furniture styling, or DIY home content</p><p>Audience interested in cozy living, smart spaces, or design inspiration</p><p>Platform reach on Instagram Reels, TikTok, or Pinterest</p>', '341|340|339', NULL, 'Basic', 'Standard', 'Premium', '1', '1', '1', '2 Days', '3 Days', '3 Days', 50, NULL, 60, NULL, 70, NULL, 1, 1, 1, NULL, NULL, 1, 'Style your space – home decor influencer collabs', 'Style your space – home decor influencer collabs', NULL, 1, 1, '2024-06-25 00:32:23', '2025-04-29 05:18:24'),
(271, 4, 2, 'I will promote your party or event wear in high-glam content', 'i-will-promote-your-party-or-event-wear-in-high-glam-content', 'I’ll wear your dress or suit to an actual event (or themed shoot), creating glam content that fits eveningwear or party vibes, with professional lighting and setting.', '444|443|442', NULL, 'Basic', 'Standard', 'Premium', '3', '5', '1000', '1 Days', '2 Days', '3 Days', 50, NULL, 150, NULL, 250, NULL, 1, 1, 1, NULL, NULL, 1, 'Eveningwear influencer content', 'High-glam party look content for your fashion label with luxury styling and visuals.', NULL, 1, 0, '2024-07-18 01:11:45', '2025-07-09 22:41:37'),
(329, 5, 3, 'I will promote your skincare brand with honest reviews', 'i-will-promote-your-skincare-brand-with-honest-reviews', '<p>With a growing beauty audience, I will apply your skincare product, create a reel showing real-time results, and talk about benefits and texture honestly.</p>', '441|440|439|438', NULL, 'Basic', 'Standard', 'Premium', '1', '1', '1', '1 Days', '1 Days', '1 Days', 20, NULL, 30, NULL, 40, NULL, 1, 0, 1, NULL, NULL, 1, 'Skincare influencer for honest product reviews', 'Promote your skincare product via real user content and authentic reviews from a beauty influencer.', NULL, 0, 0, '2025-05-04 23:02:38', '2025-07-09 04:55:56'),
(330, 116, 2, 'I help brands showcase beautiful, relatable home decor content.', 'i-help-brands-showcase-beautiful-relatable-home-decor-content', '<p><span style=\"font-size: 18px;\"><b>🏡 Home Decor Lifestyle Service Description</b></span></p><p><br></p><p>Are you a home decor brand looking to bring your products to life through engaging, high-quality content? I offer lifestyle-focused content creation that blends aesthetic visuals with authentic storytelling to connect your products with real homes and real people.</p><p><br></p><p>As a lifestyle influencer with a passion for interior styling, I specialize in creating custom photo and video content that showcases how your decor pieces enhance everyday living. Whether it’s a cozy corner transformation, a seasonal refresh, or a full room setup, I’ll capture your brand’s vibe in a natural and relatable way.</p><p><br></p><p><b>What I Offer:</b></p><ul><li>Styled product photography in real home settings</li><li>Instagram Reels or TikTok videos highlighting use, setup, and styling tips</li><li>Story content with voiceover or captions for deeper engagement</li><li>Caption writing and hashtag research (if needed)</li><li>Option to include lifestyle models or voice/narration depending on your needs</li></ul><p>Every piece of content is tailored to your brand aesthetics and target audience. I aim to create visuals that are not only scroll-stopping but also conversion-focused — whether your goal is awareness, sales, or UGC reuse.</p><p><br></p><p>Let’s make your decor feel like home — and help your audience imagine it in theirs!</p><p><br></p>', '461|460|459|458|457', '462', 'Basic', 'Standard', 'Premium', '1', '2', '3', '1 Days', '2 Days', 'Less than a week', 300, NULL, 400, NULL, 600, NULL, 1, 1, 1, NULL, NULL, 1, NULL, NULL, NULL, 0, 0, '2025-07-14 22:45:49', '2025-07-14 22:48:05'),
(331, 5, 1, 'γηδδφγηφ γφδγφφδ ηγφφηδδφη', 'γηδδφγηφ-γφδγφφδ-ηγφφηδδφη', '<p>ηγφφδδφ ηφγφδδφ ηφγηγφ ηδφφδγφδ ηγφδφδφ φγφδδ</p>', '438', NULL, 'Basic', NULL, NULL, '1', NULL, NULL, '1 Days', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, NULL, NULL, NULL, '45ρυευτ ρτυ τρρετυ ρτ', NULL, NULL, 0, 0, '2025-07-25 13:27:57', '2025-07-25 13:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `project_attributes`
--

CREATE TABLE `project_attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `create_project_id` bigint NOT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_numeric_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `basic_check_numeric` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `standard_check_numeric` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `premium_check_numeric` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_attributes`
--

INSERT INTO `project_attributes` (`id`, `user_id`, `create_project_id`, `type`, `check_numeric_title`, `basic_check_numeric`, `standard_check_numeric`, `premium_check_numeric`, `created_at`, `updated_at`) VALUES
(934, 7, 105, 'numeric', 'No of Pages', '1', '2', '3', NULL, '2023-11-22 00:09:50'),
(935, 7, 105, 'checkbox', 'Responsive Design', 'on', 'on', 'on', NULL, '2023-11-22 00:09:50'),
(936, 7, 105, 'checkbox', 'Source Code', 'on', 'on', 'on', NULL, '2023-11-22 00:09:50'),
(1664, 9, 189, 'checkbox', 'asd asd asd asdasd asd', 'on', 'on', 'on', '2024-03-03 07:23:11', '2024-03-03 07:23:11'),
(1937, 1, 275, 'checkbox', 'sadasd', 'on', 'on', 'on', NULL, '2024-09-22 03:57:38'),
(1938, 1, 275, 'checkbox', 'sadasdasd', 'on', 'on', 'on', NULL, '2024-09-22 03:57:38'),
(1939, 1, 275, 'checkbox', 'sadasdas d', 'on', 'on', 'on', NULL, '2024-09-22 03:57:38'),
(1940, 99, 299, 'checkbox', 'asd asd asd asd', 'on', 'on', 'on', '2024-11-03 01:16:49', '2024-11-03 01:16:49'),
(1941, 99, 299, 'checkbox', 'sad asdasd asd', 'on', 'on', 'on', '2024-11-03 01:16:49', '2024-11-03 01:16:49'),
(1942, 99, 300, 'checkbox', 'asd sad asd a', 'on', 'on', 'on', '2024-11-03 01:17:30', '2024-11-03 01:17:30'),
(1943, 99, 300, 'checkbox', 'sdas dasd asd', 'off', 'off', 'off', '2024-11-03 01:17:30', '2024-11-03 01:17:30'),
(1944, 99, 300, 'checkbox', 'as asd asd d', 'on', 'on', 'on', '2024-11-03 01:17:30', '2024-11-03 01:17:30'),
(1945, 99, 301, 'checkbox', 'as dasd ad asd', 'off', 'off', 'off', '2024-11-03 01:18:51', '2024-11-03 01:18:51'),
(1946, 99, 301, 'checkbox', 'as as asd asd asd', 'on', 'on', 'on', '2024-11-03 01:18:51', '2024-11-03 01:18:51'),
(1947, 99, 301, 'checkbox', 'as asdad d', 'on', 'on', 'on', '2024-11-03 01:18:51', '2024-11-03 01:18:51'),
(1948, 99, 302, 'checkbox', 'one', 'on', 'off', 'off', '2024-11-03 01:27:59', '2024-11-03 01:27:59'),
(1949, 99, 302, 'checkbox', 'two', 'on', 'off', 'off', '2024-11-03 01:27:59', '2024-11-03 01:27:59'),
(1950, 99, 302, 'checkbox', 'three', 'on', 'off', 'off', '2024-11-03 01:27:59', '2024-11-03 01:27:59'),
(1951, 99, 303, 'checkbox', 'as as asd asd', 'off', 'off', 'off', '2024-11-03 01:45:13', '2024-11-03 01:45:13'),
(1952, 99, 303, 'checkbox', 'sad asd asd', 'on', 'off', 'off', '2024-11-03 01:45:13', '2024-11-03 01:45:13'),
(1953, 99, 303, 'checkbox', 'as dasd asdas das', 'off', 'off', 'off', '2024-11-03 01:45:13', '2024-11-03 01:45:13'),
(1954, 99, 303, 'checkbox', 'as asddasd asd', 'on', 'off', 'off', '2024-11-03 01:45:13', '2024-11-03 01:45:13'),
(1955, 99, 304, 'checkbox', 'as asasd asd', 'off', 'off', 'off', '2024-11-03 01:57:15', '2024-11-03 01:57:15'),
(1956, 99, 304, 'checkbox', 'asd asd  sdsa', 'off', 'off', 'off', '2024-11-03 01:57:15', '2024-11-03 01:57:15'),
(1957, 99, 304, 'checkbox', 'asd sad', 'off', 'off', 'off', '2024-11-03 01:57:15', '2024-11-03 01:57:15'),
(1958, 99, 304, 'checkbox', 'asd sad- sdf', 'off', 'off', 'off', '2024-11-03 01:57:15', '2024-11-03 01:57:15'),
(1959, 99, 305, 'checkbox', 'as asd asd', 'on', 'off', 'off', '2024-11-03 01:59:35', '2024-11-03 01:59:35'),
(1960, 99, 305, 'checkbox', 'as dasd', 'on', 'off', 'off', '2024-11-03 01:59:35', '2024-11-03 01:59:35'),
(1961, 99, 305, 'checkbox', 'asd asd', 'on', 'off', 'off', '2024-11-03 01:59:35', '2024-11-03 01:59:35'),
(1962, 99, 305, 'checkbox', 'as dassad', 'on', 'off', 'off', '2024-11-03 01:59:35', '2024-11-03 01:59:35'),
(1963, 99, 306, 'checkbox', 'sadas dasdasd', 'on', 'on', 'on', '2024-11-03 06:26:22', '2024-11-03 06:26:22'),
(1964, 99, 306, 'checkbox', 'asd asd', 'on', 'on', 'on', '2024-11-03 06:26:22', '2024-11-03 06:26:22'),
(1965, 99, 306, 'checkbox', 'asd asd asdads', 'on', 'on', 'on', '2024-11-03 06:26:22', '2024-11-03 06:26:22'),
(2037, 99, 307, NULL, 'sadasd asd asd ad 34', 'on', 'off', 'off', NULL, '2024-11-04 07:05:53'),
(2038, 99, 307, NULL, 'asd asdad sad a ad sad sad', 'on', 'off', 'off', NULL, '2024-11-04 07:05:53'),
(2039, 99, 307, NULL, 'sd asd asd as', 'off', 'off', 'off', NULL, '2024-11-04 07:05:53'),
(2040, 99, 307, NULL, 'test', 'off', 'off', 'off', NULL, '2024-11-04 07:05:53'),
(2041, 99, 307, NULL, 'test2', 'off', 'off', 'off', NULL, '2024-11-04 07:05:53'),
(2042, 99, 307, NULL, 'sda  asd asd', 'on', 'off', 'off', NULL, '2024-11-04 07:05:53'),
(2069, 99, 308, NULL, 'ad asdasd', 'on', 'off', 'off', NULL, '2024-11-04 22:22:39'),
(2070, 99, 308, NULL, 'asd asd a', 'on', 'off', 'off', NULL, '2024-11-04 22:22:39'),
(2071, 99, 309, 'checkbox', 'as asd', 'on', 'on', 'on', '2024-11-04 22:30:30', '2024-11-04 22:30:30'),
(2072, 99, 309, 'checkbox', 'asd ad', 'on', 'on', 'on', '2024-11-04 22:30:30', '2024-11-04 22:30:30'),
(2073, 99, 310, 'checkbox', 'gdfsg dfg dfg', 'off', 'off', 'off', '2024-11-04 23:04:56', '2024-11-04 23:04:56'),
(2074, 99, 310, 'checkbox', 'fd dfgdf dfg df', 'off', 'off', 'off', '2024-11-04 23:04:56', '2024-11-04 23:04:56'),
(2081, 99, 312, 'checkbox', 'as dasd', 'on', 'off', 'off', '2024-11-04 23:29:41', '2024-11-04 23:29:41'),
(2082, 99, 312, 'checkbox', 'asd asd', 'on', 'off', 'off', '2024-11-04 23:29:41', '2024-11-04 23:29:41'),
(2083, 99, 312, 'checkbox', 'as dasd', 'on', 'off', 'off', '2024-11-04 23:29:41', '2024-11-04 23:29:41'),
(2089, 99, 313, NULL, 'as dasd', 'off', 'off', 'off', NULL, '2024-11-04 23:40:46'),
(2090, 99, 313, NULL, 'sa asd asd', 'on', 'off', 'off', NULL, '2024-11-04 23:40:46'),
(2091, 99, 313, NULL, 'as asd', 'on', 'off', 'off', NULL, '2024-11-04 23:40:46'),
(2092, 99, 313, NULL, 'as asd asd', 'on', 'off', 'off', NULL, '2024-11-04 23:40:46'),
(2093, 99, 313, NULL, 'asd asasd', 'on', 'off', 'off', NULL, '2024-11-04 23:40:46'),
(2094, 99, 314, 'checkbox', 'asd asdasd', 'off', 'off', 'off', '2024-11-05 01:47:53', '2024-11-05 01:47:53'),
(2095, 99, 314, 'checkbox', 'sa das asd asd', 'off', 'off', 'off', '2024-11-05 01:47:53', '2024-11-05 01:47:53'),
(2096, 99, 315, 'checkbox', NULL, 'off', 'off', 'off', '2024-11-06 00:19:30', '2024-11-06 00:19:30'),
(2097, 99, 316, 'checkbox', NULL, 'off', 'off', 'off', '2024-11-06 00:37:13', '2024-11-06 00:37:13'),
(2099, 99, 318, 'checkbox', NULL, 'off', 'off', 'off', '2024-11-06 00:46:37', '2024-11-06 00:46:37'),
(2100, 99, 318, 'checkbox', NULL, 'off', 'off', 'off', '2024-11-06 00:46:37', '2024-11-06 00:46:37'),
(2101, 99, 319, 'checkbox', NULL, 'off', 'off', 'off', '2024-11-06 00:49:11', '2024-11-06 00:49:11'),
(2144, 99, 317, NULL, NULL, 'off', 'off', 'off', NULL, '2024-11-06 05:34:01'),
(2145, 99, 321, NULL, NULL, 'off', 'off', 'off', NULL, '2024-11-06 05:34:50'),
(2146, 99, 311, NULL, 'one', 'on', 'off', 'off', NULL, '2024-11-06 05:35:58'),
(2147, 99, 311, NULL, 'two', 'off', 'off', 'off', NULL, '2024-11-06 05:35:58'),
(2148, 99, 311, NULL, 'three', 'off', 'off', 'off', NULL, '2024-11-06 05:35:58'),
(2167, 99, 323, NULL, NULL, 'off', 'off', 'off', NULL, '2024-11-06 05:43:20'),
(2168, 99, 323, NULL, NULL, 'off', 'off', 'off', NULL, '2024-11-06 05:43:20'),
(2169, 99, 322, NULL, 'abc', 'on', 'on', 'on', NULL, '2024-11-06 05:44:12'),
(2170, 99, 322, NULL, 'abc sd', 'on', 'on', 'on', NULL, '2024-11-06 05:44:12'),
(2173, 99, 320, NULL, 'fdgdf sa asasdas', 'off', 'off', 'off', NULL, '2024-11-06 06:19:24'),
(2174, 99, 320, NULL, 'sa dasas  sdfsd sd sdas asd sad asd asd asd sad ad', 'off', 'off', 'off', NULL, '2024-11-06 06:19:24'),
(2187, 99, 324, NULL, 'abc', 'on', 'on', 'on', NULL, '2025-02-22 07:34:34'),
(2188, 99, 324, NULL, 'abcs asda', 'on', 'on', 'off', NULL, '2025-02-22 07:34:34'),
(2189, 99, 324, NULL, 'abcd', 'on', 'off', 'on', NULL, '2025-02-22 07:34:34'),
(2190, 99, 324, NULL, 'as dsad as', 'on', 'on', 'on', NULL, '2025-02-22 07:34:34'),
(2191, 99, 325, 'checkbox', 'ewwerwerwer', 'on', 'off', 'on', '2025-04-06 01:35:54', '2025-04-06 01:35:54'),
(2192, 99, 325, 'checkbox', 'werewrwerwe', 'on', 'on', 'on', '2025-04-06 01:35:54', '2025-04-06 01:35:54'),
(2506, 5, 92, NULL, 'Morning routine videos', 'on', 'on', 'on', NULL, '2025-04-24 04:28:07'),
(2507, 5, 92, NULL, 'Night routine videos', 'off', 'on', 'on', NULL, '2025-04-24 04:28:07'),
(2508, 5, 92, NULL, 'Before & after series', 'off', 'on', 'on', NULL, '2025-04-24 04:28:07'),
(2509, 5, 92, NULL, 'Product photography', 'off', 'off', 'on', NULL, '2025-04-24 04:28:07'),
(2510, 5, 92, NULL, 'Instagram reels', 'on', 'on', 'on', NULL, '2025-04-24 04:28:07'),
(2511, 5, 92, NULL, 'Tiktok reels', 'off', 'off', 'off', NULL, '2025-04-24 04:28:07'),
(2512, 5, 92, NULL, 'First impressions', 'off', 'off', 'off', NULL, '2025-04-24 04:28:07'),
(2517, 5, 101, NULL, 'Smart brand matching', 'on', 'on', 'on', NULL, '2025-04-24 04:52:59'),
(2518, 5, 101, NULL, 'Real-time analytics', 'on', 'on', 'on', NULL, '2025-04-24 04:52:59'),
(2519, 5, 101, NULL, 'Branded campaign briefs', 'off', 'off', 'on', NULL, '2025-04-24 04:52:59'),
(2520, 5, 101, NULL, 'Integrated messaging', 'off', 'on', 'on', NULL, '2025-04-24 04:52:59'),
(2521, 5, 101, NULL, 'Portfolio display', 'on', 'on', 'on', NULL, '2025-04-24 04:52:59'),
(2533, 5, 99, NULL, 'Seamless collaboration', 'off', 'on', 'on', NULL, '2025-04-24 06:39:08'),
(2534, 5, 99, NULL, 'Performance analytics', 'on', 'on', 'on', NULL, '2025-04-24 06:39:08'),
(2535, 5, 99, NULL, 'Portfolio showcase', 'on', 'on', 'on', NULL, '2025-04-24 06:39:08'),
(2536, 5, 99, NULL, 'Direct communication', 'on', 'off', 'on', NULL, '2025-04-24 06:39:08'),
(2537, 5, 99, NULL, 'Competitor analyze', 'off', 'on', 'on', NULL, '2025-04-24 06:39:08'),
(2544, 5, 107, NULL, 'Action plan', 'on', 'off', 'on', NULL, '2025-04-24 07:14:53'),
(2545, 5, 107, NULL, 'Campaign audit', 'off', 'on', 'on', NULL, '2025-04-24 07:14:53'),
(2546, 5, 107, NULL, 'Target audience research', 'on', 'on', 'on', NULL, '2025-04-24 07:14:53'),
(2547, 5, 107, NULL, 'Ad content creation', 'off', 'on', 'on', NULL, '2025-04-24 07:14:53'),
(2548, 5, 107, NULL, 'Campaign setup', 'off', 'on', 'on', NULL, '2025-04-24 07:14:53'),
(2549, 5, 107, NULL, 'xcvxcvxcv', 'off', 'off', 'on', NULL, '2025-04-24 07:14:53'),
(2559, 5, 104, NULL, '1 Pin posted on a high-traffic', 'on', 'on', 'on', NULL, '2025-04-24 07:26:23'),
(2560, 5, 104, NULL, 'Board with over 500K+ monthly views', 'off', 'on', 'on', NULL, '2025-04-24 07:26:23'),
(2561, 5, 104, NULL, 'Targeted audience based on product category', 'off', 'off', 'on', NULL, '2025-04-24 07:26:23'),
(2570, 5, 102, NULL, 'Screen time management tips', 'off', 'on', 'on', NULL, '2025-04-24 07:40:33'),
(2571, 5, 102, NULL, 'Digital free family activities', 'on', 'on', 'on', NULL, '2025-04-24 07:40:33'),
(2572, 5, 102, NULL, 'Mindful media consumption', 'off', 'off', 'on', NULL, '2025-04-24 07:40:33'),
(2573, 5, 102, NULL, 'Tech free zones & routines', 'on', 'on', 'on', NULL, '2025-04-24 07:40:33'),
(2574, 5, 70, NULL, 'Daily post', 'on', 'on', 'on', NULL, '2025-04-24 07:41:40'),
(2575, 5, 70, NULL, 'Weekly post', 'on', 'on', 'on', NULL, '2025-04-24 07:41:40'),
(2576, 5, 70, NULL, 'Caption Crafting', 'on', 'on', 'on', NULL, '2025-04-24 07:41:40'),
(2577, 5, 70, NULL, 'Reels tiktok', 'off', 'on', 'on', NULL, '2025-04-24 07:41:40'),
(2578, 5, 70, NULL, 'Trend monitoring', 'off', 'off', 'on', NULL, '2025-04-24 07:41:40'),
(2579, 5, 70, NULL, 'Link-in-bio integration', 'on', 'on', 'on', NULL, '2025-04-24 07:41:40'),
(2580, 5, 70, NULL, 'Hashtag strategy for visibility', 'off', 'on', 'on', NULL, '2025-04-24 07:41:40'),
(2584, 5, 84, NULL, 'Functional app', 'on', 'off', 'off', NULL, '2025-04-26 22:36:42'),
(2585, 5, 84, NULL, '2 operating systems', 'on', 'off', 'off', NULL, '2025-04-26 22:36:42'),
(2586, 5, 84, NULL, 'App submission', 'off', 'off', 'off', NULL, '2025-04-26 22:36:42'),
(2587, 5, 84, NULL, 'App icon', 'on', 'off', 'off', NULL, '2025-04-26 22:36:42'),
(2588, 5, 84, NULL, 'Splash screen', 'off', 'off', 'off', NULL, '2025-04-26 22:36:42'),
(2589, 5, 84, NULL, 'Ad network integration', 'off', 'off', 'off', NULL, '2025-04-26 22:36:42'),
(2590, 5, 84, NULL, 'Source code', 'on', 'off', 'off', NULL, '2025-04-26 22:36:42'),
(2599, 5, 73, NULL, 'Functional app', 'on', 'off', 'off', NULL, '2025-04-26 22:43:01'),
(2600, 5, 73, NULL, '1 operating system', 'on', 'off', 'off', NULL, '2025-04-26 22:43:01'),
(2601, 5, 73, NULL, 'App submission', 'on', 'off', 'off', NULL, '2025-04-26 22:43:01'),
(2602, 5, 73, NULL, 'App icon', 'on', 'off', 'off', NULL, '2025-04-26 22:43:01'),
(2603, 5, 73, NULL, 'Splash screen', 'on', 'off', 'off', NULL, '2025-04-26 22:43:01'),
(2604, 5, 73, NULL, 'Ad network integration', 'off', 'off', 'off', NULL, '2025-04-26 22:43:01'),
(2605, 5, 73, NULL, 'Source code', 'off', 'off', 'off', NULL, '2025-04-26 22:43:01'),
(2606, 5, 73, NULL, 'sdfsdf', 'off', 'off', 'off', NULL, '2025-04-26 22:43:01'),
(2607, 3, 98, NULL, '1 street style look  post', 'on', 'on', 'on', NULL, '2025-04-26 23:31:52'),
(2608, 3, 98, NULL, '2 street style look  post', 'on', 'on', 'on', NULL, '2025-04-26 23:31:52'),
(2609, 3, 98, NULL, '3 street style look  post', 'off', 'off', 'on', NULL, '2025-04-26 23:31:52'),
(2610, 3, 98, NULL, '1 short-form Reel', 'off', 'off', 'on', NULL, '2025-04-26 23:31:52'),
(2611, 3, 98, NULL, '2 short-form Reel', 'on', 'on', 'on', NULL, '2025-04-26 23:31:52'),
(2612, 3, 98, NULL, '3 short-form Reel', 'off', 'off', 'on', NULL, '2025-04-26 23:31:52'),
(2657, 3, 96, NULL, 'Post mentioning your business', 'on', 'on', 'on', NULL, '2025-04-27 00:36:18'),
(2658, 3, 96, NULL, 'Short promotional caption', 'off', 'on', 'off', NULL, '2025-04-27 00:36:18'),
(2659, 3, 96, NULL, '1 branded tag', 'off', 'off', 'on', NULL, '2025-04-27 00:36:18'),
(2660, 3, 96, NULL, 'Basic engagement insights', 'on', 'on', 'on', NULL, '2025-04-27 00:36:18'),
(2661, 3, 96, NULL, 'Delivery within 5 days', 'on', 'on', 'on', NULL, '2025-04-27 00:36:18'),
(2667, 3, 93, NULL, 'Real life integration', 'on', 'on', 'on', NULL, '2025-04-27 02:26:57'),
(2668, 3, 93, NULL, 'Engaging content', 'off', 'off', 'on', NULL, '2025-04-27 02:26:57'),
(2669, 3, 93, NULL, 'Personalized tips', 'on', 'on', 'on', NULL, '2025-04-27 02:26:57'),
(2670, 3, 93, NULL, 'Collaborations with trusted brands', 'off', 'on', 'on', NULL, '2025-04-27 02:26:57'),
(2716, 5, 248, NULL, 'Branded Home styling content', 'on', 'on', 'on', NULL, '2025-04-29 05:18:24'),
(2717, 5, 248, NULL, 'Reels & TikToks for interior inspiration', 'off', 'on', 'on', NULL, '2025-04-29 05:18:24'),
(2718, 5, 248, NULL, 'Engagement insights', 'on', 'off', 'on', NULL, '2025-04-29 05:18:24'),
(2719, 5, 248, NULL, 'Scheduled campaign', 'on', 'on', 'on', NULL, '2025-04-29 05:18:24'),
(2724, 5, 103, NULL, 'Eye catching', 'on', 'on', 'on', NULL, '2025-04-29 05:20:35'),
(2725, 5, 103, NULL, 'Words', 'off', 'on', 'on', NULL, '2025-04-29 05:20:35'),
(2726, 5, 103, NULL, 'SEO friendly', 'off', 'off', 'on', NULL, '2025-04-29 05:20:35'),
(2727, 5, 103, NULL, 'No paid ads', 'on', 'on', 'on', NULL, '2025-04-29 05:20:35'),
(2728, 5, 100, NULL, 'Seamless collaboration', 'off', 'on', 'on', NULL, '2025-04-29 05:53:49'),
(2729, 5, 100, NULL, 'Performance analytics', 'off', 'off', 'on', NULL, '2025-04-29 05:53:49'),
(2730, 5, 100, NULL, 'Portfolio showcase', 'on', 'on', 'on', NULL, '2025-04-29 05:53:49'),
(2731, 5, 100, NULL, 'Direct communication', 'on', 'on', 'on', NULL, '2025-04-29 05:53:49'),
(2732, 5, 100, NULL, 'Competitor analyze', 'on', 'on', 'on', NULL, '2025-04-29 05:53:49'),
(2738, 3, 97, NULL, 'No of words', 'off', 'off', 'on', NULL, '2025-04-30 07:10:19'),
(2739, 3, 97, NULL, 'Topic research', 'on', 'on', 'on', NULL, '2025-04-30 07:10:19'),
(2740, 3, 97, NULL, 'SEO keywords', 'on', 'on', 'on', NULL, '2025-04-30 07:10:19'),
(2741, 3, 97, NULL, 'SEO Keyword', 'on', 'on', 'on', NULL, '2025-04-30 07:10:19'),
(2742, 3, 97, NULL, 'Research References & citations', 'on', 'on', 'on', NULL, '2025-04-30 07:10:19'),
(2743, 3, 94, NULL, 'Smart home device', 'off', 'off', 'on', NULL, '2025-04-30 07:10:47'),
(2744, 3, 94, NULL, 'Unboxing video', 'off', 'off', 'on', NULL, '2025-04-30 07:10:47'),
(2745, 3, 94, NULL, 'Basic setup tutorial', 'on', 'on', 'on', NULL, '2025-04-30 07:10:47'),
(2746, 3, 94, NULL, 'Social media shout-out', 'on', 'on', 'on', NULL, '2025-04-30 07:10:47'),
(2747, 3, 94, NULL, 'Engagement', 'on', 'on', 'on', NULL, '2025-04-30 07:10:47'),
(2748, 3, 95, NULL, 'Custom recipe featuring your product', 'on', 'on', 'on', NULL, '2025-04-30 07:11:41'),
(2749, 3, 95, NULL, 'High-quality food photo', 'off', 'on', 'on', NULL, '2025-04-30 07:11:41'),
(2750, 3, 95, NULL, 'Short social media pos', 'off', 'off', 'on', NULL, '2025-04-30 07:11:41'),
(2751, 3, 95, NULL, 'Product tag and mention in the caption', 'on', 'on', 'on', NULL, '2025-04-30 07:11:41'),
(2752, 3, 95, NULL, 'Basic engagement insights', 'on', 'on', 'on', NULL, '2025-04-30 07:11:41'),
(2781, 9, 190, NULL, 'Content upload', 'on', 'on', 'on', NULL, '2025-07-09 04:39:11'),
(2782, 9, 190, NULL, '1 Instagram story with tag', 'off', 'on', 'on', NULL, '2025-07-09 04:39:11'),
(2783, 9, 190, NULL, '1 story + 1 feed post', 'off', 'on', 'on', NULL, '2025-07-09 04:39:11'),
(2784, 9, 190, NULL, '2 stories + 1 reel + tag & caption', 'off', 'off', 'on', NULL, '2025-07-09 04:39:11'),
(2787, 5, 329, NULL, '1 story showing product use', 'on', 'on', 'on', NULL, '2025-07-09 04:55:56'),
(2788, 5, 329, NULL, '1 reel + 1 captioned post', 'off', 'on', 'on', NULL, '2025-07-09 04:55:56'),
(2789, 5, 329, NULL, '1 reel + 2 stories + skincare highlight', 'off', 'off', 'on', NULL, '2025-07-09 04:55:56'),
(2793, 4, 271, NULL, '1 photo with tag', 'on', 'on', 'on', NULL, '2025-07-09 22:41:37'),
(2794, 4, 271, NULL, 'Reel + outfit breakdown', 'off', 'on', 'on', NULL, '2025-07-09 22:41:37'),
(2795, 4, 271, NULL, '2 reels + high-end photography', 'off', 'off', 'on', NULL, '2025-07-09 22:41:37'),
(2804, 5, 69, NULL, '1 Instagram story or photo showing product use', 'on', 'on', 'on', NULL, '2025-07-09 23:03:35'),
(2805, 5, 69, NULL, '1 reel or TikTok with full demo + brand tags', 'off', 'on', 'on', NULL, '2025-07-09 23:03:35'),
(2806, 5, 69, NULL, '1 unboxing + 1 demo reel + 1 story + product review caption', 'off', 'off', 'on', NULL, '2025-07-09 23:03:35'),
(2807, 5, 69, NULL, 'Content upload', 'on', 'on', 'on', NULL, '2025-07-09 23:03:35'),
(2808, 5, 68, NULL, '1 unboxing photo or story', 'on', 'on', 'on', NULL, '2025-07-09 23:16:06'),
(2809, 5, 68, NULL, 'Brand tag and hashtags', 'on', 'on', 'on', NULL, '2025-07-09 23:16:06'),
(2810, 5, 68, NULL, 'Natural demo with product usage', 'off', 'on', 'on', NULL, '2025-07-09 23:16:06'),
(2811, 5, 68, NULL, '1 full review reel or TikTok (60–90 seconds)', 'off', 'off', 'on', NULL, '2025-07-09 23:16:06'),
(2812, 5, 68, NULL, 'Link in bio for 5 days', 'off', 'off', 'on', NULL, '2025-07-09 23:16:06'),
(2813, 116, 330, 'checkbox', 'Product photos', 'off', 'off', 'on', '2025-07-14 22:45:49', '2025-07-14 22:45:49'),
(2814, 5, 331, 'checkbox', 'γηδφγφγφδ', 'on', 'off', 'off', '2025-07-25 13:27:57', '2025-07-25 13:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `project_histories`
--

CREATE TABLE `project_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `reject_count` bigint DEFAULT NULL,
  `edit_count` bigint DEFAULT NULL,
  `reject_reason` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_promote_settings`
--

CREATE TABLE `project_promote_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `budget` double NOT NULL,
  `duration` int NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_promote_settings`
--

INSERT INTO `project_promote_settings` (`id`, `title`, `image`, `budget`, `duration`, `status`, `created_at`, `updated_at`) VALUES
(1, '10 days', NULL, 10, 10, 1, '2024-01-29 01:32:25', '2024-02-08 04:24:34'),
(2, '20 days', NULL, 20, 20, 1, '2024-01-29 01:41:33', '2024-02-08 04:24:13'),
(3, '30 days', NULL, 30, 30, 1, '2024-01-29 01:50:34', '2024-02-08 04:23:48');

-- --------------------------------------------------------

--
-- Table structure for table `project_sub_categories`
--

CREATE TABLE `project_sub_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint NOT NULL,
  `sub_category_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_sub_categories`
--

INSERT INTO `project_sub_categories` (`id`, `project_id`, `sub_category_id`, `created_at`, `updated_at`) VALUES
(11, 84, 5, '2023-04-04 01:32:37', '2023-04-04 01:32:37'),
(12, 84, 6, '2023-04-04 01:32:37', '2023-04-04 01:32:37'),
(23, 73, 6, '2023-05-14 03:47:27', '2023-05-14 03:47:27'),
(36, 93, 24, '2023-05-15 23:58:55', '2023-05-15 23:58:55'),
(63, 108, 3, '2023-11-05 00:18:30', '2023-11-05 00:18:30'),
(64, 108, 21, '2023-11-05 00:18:30', '2023-11-05 00:18:30'),
(65, 108, 22, '2023-11-05 00:18:30', '2023-11-05 00:18:30'),
(67, 84, 7, '2023-11-05 02:26:29', '2023-11-05 02:26:29'),
(68, 84, 8, '2023-11-05 02:26:29', '2023-11-05 02:26:29'),
(69, 73, 5, '2023-11-05 02:32:31', '2023-11-05 02:32:31'),
(83, 98, 22, '2023-11-05 05:13:28', '2023-11-05 05:13:28'),
(84, 97, 29, '2023-11-05 05:22:16', '2023-11-05 05:22:16'),
(90, 93, 1, '2023-11-05 05:55:34', '2023-11-05 05:55:34'),
(91, 107, 29, '2023-11-05 06:20:57', '2023-11-05 06:20:57'),
(92, 107, 30, '2023-11-05 06:20:57', '2023-11-05 06:20:57'),
(93, 107, 34, '2023-11-05 06:27:13', '2023-11-05 06:27:13'),
(94, 105, 1, '2023-11-05 06:32:26', '2023-11-05 06:32:26'),
(95, 105, 24, '2023-11-05 06:32:26', '2023-11-05 06:32:26'),
(98, 103, 26, '2023-11-05 06:47:36', '2023-11-05 06:47:36'),
(99, 103, 31, '2023-11-05 06:47:36', '2023-11-05 06:47:36'),
(100, 103, 32, '2023-11-05 06:47:36', '2023-11-05 06:47:36'),
(101, 102, 26, '2023-11-05 07:04:10', '2023-11-05 07:04:10'),
(102, 102, 31, '2023-11-05 07:04:10', '2023-11-05 07:04:10'),
(111, 109, 1, '2023-11-13 01:18:59', '2023-11-13 01:18:59'),
(112, 110, 1, '2023-11-15 01:12:23', '2023-11-15 01:12:23'),
(113, 111, 3, '2023-11-15 01:34:17', '2023-11-15 01:34:17'),
(114, 112, 2, '2023-11-15 01:47:18', '2023-11-15 01:47:18'),
(115, 113, 20, '2023-11-15 01:48:12', '2023-11-15 01:48:12'),
(116, 114, 20, '2023-11-15 01:55:38', '2023-11-15 01:55:38'),
(117, 115, 20, '2023-11-15 01:56:47', '2023-11-15 01:56:47'),
(118, 116, 21, '2023-11-15 02:09:10', '2023-11-15 02:09:10'),
(119, 117, 2, '2023-11-15 02:20:41', '2023-11-15 02:20:41'),
(120, 118, 1, '2023-11-15 02:22:45', '2023-11-15 02:22:45'),
(121, 119, 20, '2023-11-15 02:29:31', '2023-11-15 02:29:31'),
(122, 120, 2, '2023-11-15 02:30:23', '2023-11-15 02:30:23'),
(123, 121, 21, '2023-11-15 02:31:58', '2023-11-15 02:31:58'),
(124, 122, 1, '2023-11-15 02:34:27', '2023-11-15 02:34:27'),
(125, 123, 3, '2023-11-15 02:36:00', '2023-11-15 02:36:00'),
(126, 124, 1, '2023-11-15 02:39:05', '2023-11-15 02:39:05'),
(127, 125, 20, '2023-11-15 02:40:30', '2023-11-15 02:40:30'),
(128, 126, 1, '2023-11-22 01:17:21', '2023-11-22 01:17:21'),
(129, 126, 2, '2023-11-22 01:17:21', '2023-11-22 01:17:21'),
(130, 127, 3, '2023-11-22 01:48:39', '2023-11-22 01:48:39'),
(131, 127, 21, '2023-11-22 01:48:39', '2023-11-22 01:48:39'),
(132, 128, 36, '2023-11-22 06:54:07', '2023-11-22 06:54:07'),
(133, 129, 21, '2023-11-22 07:16:18', '2023-11-22 07:16:18'),
(134, 130, 3, '2023-11-22 08:16:43', '2023-11-22 08:16:43'),
(135, 131, 20, '2023-11-23 00:02:30', '2023-11-23 00:02:30'),
(136, 132, 1, '2023-11-24 22:30:56', '2023-11-24 22:30:56'),
(137, 133, 1, '2023-11-26 06:20:51', '2023-11-26 06:20:51'),
(138, 134, 1, '2023-11-26 06:27:46', '2023-11-26 06:27:46'),
(139, 135, 3, '2023-11-26 06:29:12', '2023-11-26 06:29:12'),
(140, 136, 35, '2023-11-26 06:33:11', '2023-11-26 06:33:11'),
(141, 137, 2, '2023-11-26 07:21:06', '2023-11-26 07:21:06'),
(142, 138, 36, '2023-11-29 06:26:25', '2023-11-29 06:26:25'),
(143, 139, 20, '2023-11-30 00:49:53', '2023-11-30 00:49:53'),
(144, 140, 21, '2023-11-30 00:51:15', '2023-11-30 00:51:15'),
(145, 141, 20, '2023-11-30 01:04:32', '2023-11-30 01:04:32'),
(146, 142, 20, '2023-11-30 01:25:27', '2023-11-30 01:25:27'),
(147, 143, 21, '2023-11-30 06:24:28', '2023-11-30 06:24:28'),
(148, 144, 2, '2023-12-03 03:29:09', '2023-12-03 03:29:09'),
(149, 145, 20, '2023-12-30 06:45:30', '2023-12-30 06:45:30'),
(150, 146, 1, '2024-01-03 22:07:37', '2024-01-03 22:07:37'),
(152, 148, 20, '2024-01-11 06:16:58', '2024-01-11 06:16:58'),
(153, 149, 1, '2024-01-24 01:01:45', '2024-01-24 01:01:45'),
(154, 150, 2, '2024-01-24 01:16:44', '2024-01-24 01:16:44'),
(155, 151, 2, '2024-01-24 01:27:40', '2024-01-24 01:27:40'),
(156, 152, 1, '2024-01-24 01:44:12', '2024-01-24 01:44:12'),
(157, 153, 21, '2024-01-24 01:51:18', '2024-01-24 01:51:18'),
(158, 154, 7, '2024-01-24 01:58:20', '2024-01-24 01:58:20'),
(159, 155, 6, '2024-01-24 02:22:26', '2024-01-24 02:22:26'),
(160, 156, 3, '2024-01-30 03:30:06', '2024-01-30 03:30:06'),
(161, 157, 52, '2024-01-30 06:17:05', '2024-01-30 06:17:05'),
(162, 158, 52, '2024-01-30 06:21:35', '2024-01-30 06:21:35'),
(163, 159, 22, '2024-01-30 06:24:10', '2024-01-30 06:24:10'),
(164, 159, 45, '2024-01-30 06:24:10', '2024-01-30 06:24:10'),
(165, 160, 3, '2024-01-30 06:29:25', '2024-01-30 06:29:25'),
(166, 161, 20, '2024-01-30 07:11:40', '2024-01-30 07:11:40'),
(167, 162, 3, '2024-01-30 07:24:55', '2024-01-30 07:24:55'),
(168, 163, 21, '2024-01-30 07:26:13', '2024-01-30 07:26:13'),
(169, 164, 21, '2024-01-30 07:29:53', '2024-01-30 07:29:53'),
(170, 165, 20, '2024-01-30 07:32:38', '2024-01-30 07:32:38'),
(171, 166, 36, '2024-01-30 08:06:43', '2024-01-30 08:06:43'),
(172, 167, 36, '2024-01-30 08:08:49', '2024-01-30 08:08:49'),
(173, 168, 3, '2024-01-30 08:22:06', '2024-01-30 08:22:06'),
(174, 169, 1, '2024-01-30 08:32:22', '2024-01-30 08:32:22'),
(175, 170, 36, '2024-01-30 08:37:24', '2024-01-30 08:37:24'),
(176, 171, 36, '2024-01-30 08:38:42', '2024-01-30 08:38:42'),
(177, 172, 36, '2024-01-30 08:57:04', '2024-01-30 08:57:04'),
(178, 173, 1, '2024-01-31 00:02:37', '2024-01-31 00:02:37'),
(179, 174, 36, '2024-01-31 00:34:01', '2024-01-31 00:34:01'),
(180, 175, 21, '2024-01-31 00:37:41', '2024-01-31 00:37:41'),
(181, 176, 20, '2024-01-31 03:39:54', '2024-01-31 03:39:54'),
(182, 177, 20, '2024-01-31 03:47:10', '2024-01-31 03:47:10'),
(183, 178, 2, '2024-01-31 03:50:19', '2024-01-31 03:50:19'),
(184, 179, 20, '2024-01-31 04:29:44', '2024-01-31 04:29:44'),
(185, 180, 20, '2024-01-31 04:36:38', '2024-01-31 04:36:38'),
(186, 181, 21, '2024-01-31 04:53:33', '2024-01-31 04:53:33'),
(187, 182, 46, '2024-01-31 04:54:49', '2024-01-31 04:54:49'),
(188, 183, 46, '2024-01-31 04:56:39', '2024-01-31 04:56:39'),
(189, 184, 20, '2024-01-31 04:59:27', '2024-01-31 04:59:27'),
(190, 185, 36, '2024-01-31 06:54:02', '2024-01-31 06:54:02'),
(191, 186, 24, '2024-03-03 06:54:26', '2024-03-03 06:54:26'),
(192, 187, 36, '2024-03-03 07:14:03', '2024-03-03 07:14:03'),
(193, 188, 2, '2024-03-03 07:18:01', '2024-03-03 07:18:01'),
(194, 189, 20, '2024-03-03 07:23:10', '2024-03-03 07:23:10'),
(195, 190, 20, '2024-03-03 07:25:22', '2024-03-03 07:25:22'),
(196, 191, 20, '2024-04-01 23:55:35', '2024-04-01 23:55:35'),
(197, 192, 21, '2024-04-02 00:05:42', '2024-04-02 00:05:42'),
(198, 193, 2, '2024-04-02 00:07:41', '2024-04-02 00:07:41'),
(199, 194, 2, '2024-04-02 00:11:31', '2024-04-02 00:11:31'),
(216, 203, 1, '2024-04-24 06:46:34', '2024-04-24 06:46:34'),
(217, 203, 2, '2024-04-24 06:46:34', '2024-04-24 06:46:34'),
(218, 204, 1, '2024-04-24 06:48:09', '2024-04-24 06:48:09'),
(219, 204, 2, '2024-04-24 06:48:09', '2024-04-24 06:48:09'),
(254, 222, 1, '2024-04-24 07:19:01', '2024-04-24 07:19:01'),
(255, 222, 2, '2024-04-24 07:19:01', '2024-04-24 07:19:01'),
(260, 225, 1, '2024-04-24 07:27:17', '2024-04-24 07:27:17'),
(261, 225, 2, '2024-04-24 07:27:17', '2024-04-24 07:27:17'),
(262, 226, 2, '2024-04-24 22:45:30', '2024-04-24 22:45:30'),
(263, 226, 24, '2024-04-24 22:45:30', '2024-04-24 22:45:30'),
(264, 227, 1, '2024-04-24 22:51:19', '2024-04-24 22:51:19'),
(265, 227, 2, '2024-04-24 22:51:19', '2024-04-24 22:51:19'),
(266, 228, 1, '2024-04-24 22:54:40', '2024-04-24 22:54:40'),
(267, 228, 2, '2024-04-24 22:54:40', '2024-04-24 22:54:40'),
(268, 229, 1, '2024-04-24 23:01:25', '2024-04-24 23:01:25'),
(269, 229, 2, '2024-04-24 23:01:25', '2024-04-24 23:01:25'),
(276, 233, 1, '2024-04-24 23:08:30', '2024-04-24 23:08:30'),
(277, 233, 2, '2024-04-24 23:08:30', '2024-04-24 23:08:30'),
(282, 236, 1, '2024-04-25 03:54:13', '2024-04-25 03:54:13'),
(283, 236, 2, '2024-04-25 03:54:13', '2024-04-25 03:54:13'),
(284, 237, 1, '2024-04-25 06:30:35', '2024-04-25 06:30:35'),
(285, 237, 2, '2024-04-25 06:30:35', '2024-04-25 06:30:35'),
(286, 238, 1, '2024-04-25 06:51:20', '2024-04-25 06:51:20'),
(287, 238, 2, '2024-04-25 06:51:20', '2024-04-25 06:51:20'),
(288, 239, 1, '2024-04-25 06:54:13', '2024-04-25 06:54:13'),
(289, 239, 2, '2024-04-25 06:54:13', '2024-04-25 06:54:13'),
(293, 240, 3, '2024-04-26 23:57:19', '2024-04-28 02:37:33'),
(294, 240, 3, '2024-04-26 23:57:19', '2024-04-28 02:37:33'),
(296, 240, 3, '2024-04-28 02:37:33', '2024-04-28 02:37:33'),
(297, 241, 36, '2024-05-05 00:17:17', '2024-05-05 00:17:17'),
(298, 242, 36, '2024-05-05 00:38:26', '2024-05-05 00:38:26'),
(299, 243, 2, '2024-05-20 07:07:10', '2024-05-20 07:07:10'),
(300, 244, 1, '2024-06-01 05:52:46', '2024-06-01 05:52:46'),
(301, 244, 46, '2024-06-01 05:52:46', '2024-06-01 05:52:46'),
(302, 245, 2, '2024-06-03 23:13:29', '2024-06-03 23:13:29'),
(303, 246, 2, '2024-06-03 23:14:35', '2024-06-03 23:14:35'),
(304, 247, 2, '2024-06-25 00:27:35', '2024-06-25 00:27:35'),
(305, 248, 2, '2024-06-25 00:32:23', '2024-06-25 00:32:23'),
(306, 249, 37, '2024-07-04 05:39:01', '2024-07-04 05:39:01'),
(307, 250, 37, '2024-07-04 05:50:03', '2024-07-04 05:50:03'),
(308, 251, 20, '2024-07-04 06:18:08', '2024-07-04 06:18:08'),
(309, 252, 2, '2024-07-04 06:43:56', '2024-07-04 06:43:56'),
(310, 253, 24, '2024-07-05 23:16:22', '2024-07-05 23:16:22'),
(311, 254, 21, '2024-07-05 23:28:18', '2024-07-05 23:28:18'),
(312, 255, 20, '2024-07-05 23:32:00', '2024-07-05 23:32:00'),
(313, 256, 20, '2024-07-06 01:29:52', '2024-07-06 01:29:52'),
(314, 257, 24, '2024-07-07 00:08:38', '2024-07-07 00:08:38'),
(315, 258, 20, '2024-07-09 04:22:26', '2024-07-09 04:22:26'),
(316, 259, 20, '2024-07-14 23:34:02', '2024-07-14 23:34:02'),
(317, 260, 20, '2024-07-16 05:45:10', '2024-07-16 05:45:10'),
(318, 261, 1, '2024-07-16 07:36:45', '2024-07-16 07:36:45'),
(319, 262, 1, '2024-07-16 07:42:21', '2024-07-16 07:42:21'),
(320, 263, 1, '2024-07-17 23:07:18', '2024-07-17 23:07:18'),
(321, 263, 2, '2024-07-17 23:07:18', '2024-07-17 23:07:18'),
(322, 264, 1, '2024-07-17 23:32:00', '2024-07-17 23:32:00'),
(323, 264, 2, '2024-07-17 23:32:00', '2024-07-17 23:32:00'),
(324, 265, 1, '2024-07-17 23:44:31', '2024-07-17 23:44:31'),
(325, 265, 2, '2024-07-17 23:44:31', '2024-07-17 23:44:31'),
(326, 266, 1, '2024-07-17 23:54:33', '2024-07-17 23:54:33'),
(327, 266, 2, '2024-07-17 23:54:33', '2024-07-17 23:54:33'),
(328, 267, 2, '2024-07-18 00:01:12', '2024-07-18 00:01:12'),
(329, 268, 1, '2024-07-18 00:46:12', '2024-07-18 00:46:12'),
(330, 268, 2, '2024-07-18 00:46:12', '2024-07-18 00:46:12'),
(331, 269, 1, '2024-07-18 00:57:34', '2024-07-18 00:57:34'),
(332, 269, 2, '2024-07-18 00:57:34', '2024-07-18 00:57:34'),
(333, 270, 1, '2024-07-18 01:06:15', '2024-07-18 01:06:15'),
(334, 270, 2, '2024-07-18 01:06:15', '2024-07-18 01:06:15'),
(338, 272, 21, '2024-08-01 00:58:20', '2024-08-01 00:58:20'),
(339, 273, 20, '2024-08-01 01:18:58', '2024-08-01 01:18:58'),
(340, 274, 21, '2024-08-31 04:12:52', '2024-08-31 04:12:52'),
(341, 275, 20, '2024-09-22 03:49:50', '2024-09-22 03:49:50'),
(342, 275, 22, '2024-09-22 03:49:50', '2024-09-22 03:49:50'),
(346, 279, 36, '2024-10-30 23:56:00', '2024-10-30 23:56:00'),
(347, 280, 36, '2024-10-30 23:57:25', '2024-10-30 23:57:25'),
(348, 281, 21, '2024-10-31 00:00:24', '2024-10-31 00:00:24'),
(366, 299, 20, '2024-11-03 01:16:49', '2024-11-03 01:16:49'),
(367, 300, 3, '2024-11-03 01:17:30', '2024-11-03 01:17:30'),
(368, 301, 46, '2024-11-03 01:18:51', '2024-11-03 01:18:51'),
(369, 302, 20, '2024-11-03 01:27:59', '2024-11-03 01:27:59'),
(370, 303, 2, '2024-11-03 01:45:13', '2024-11-03 01:45:13'),
(371, 304, 20, '2024-11-03 01:57:15', '2024-11-03 01:57:15'),
(372, 305, 20, '2024-11-03 01:59:35', '2024-11-03 01:59:35'),
(373, 306, 36, '2024-11-03 06:26:22', '2024-11-03 06:26:22'),
(374, 307, 20, '2024-11-04 03:48:51', '2024-11-04 03:48:51'),
(375, 307, 22, '2024-11-04 05:17:28', '2024-11-04 05:17:28'),
(376, 308, 36, '2024-11-04 07:19:22', '2024-11-04 07:19:22'),
(377, 309, 20, '2024-11-04 22:30:30', '2024-11-04 22:30:30'),
(378, 310, 21, '2024-11-04 23:04:56', '2024-11-04 23:04:56'),
(379, 311, 2, '2024-11-04 23:20:35', '2024-11-04 23:20:35'),
(380, 312, 20, '2024-11-04 23:29:41', '2024-11-04 23:29:41'),
(381, 313, 21, '2024-11-04 23:38:49', '2024-11-04 23:38:49'),
(382, 314, 46, '2024-11-05 01:47:53', '2024-11-05 01:47:53'),
(383, 315, 20, '2024-11-06 00:19:30', '2024-11-06 00:19:30'),
(384, 316, 2, '2024-11-06 00:37:13', '2024-11-06 00:37:13'),
(385, 317, 36, '2024-11-06 00:45:50', '2024-11-06 00:45:50'),
(386, 318, 20, '2024-11-06 00:46:37', '2024-11-06 00:46:37'),
(387, 319, 2, '2024-11-06 00:49:11', '2024-11-06 00:49:11'),
(388, 320, 20, '2024-11-06 00:53:44', '2024-11-06 00:53:44'),
(389, 321, 37, '2024-11-06 00:55:24', '2024-11-06 00:55:24'),
(390, 322, 46, '2024-11-06 02:35:23', '2024-11-06 02:35:23'),
(391, 323, 1, '2024-11-06 03:33:09', '2024-11-06 03:33:09'),
(392, 323, 46, '2024-11-06 03:33:09', '2024-11-06 03:33:09'),
(393, 324, 20, '2024-11-06 03:44:11', '2024-11-06 03:44:11'),
(394, 324, 22, '2024-11-06 03:44:11', '2024-11-06 03:44:11'),
(395, 325, 1, '2025-04-06 01:35:54', '2025-04-06 01:35:54'),
(396, 325, 2, '2025-04-06 01:35:54', '2025-04-06 01:35:54'),
(398, 326, 1, '2025-04-16 22:32:09', '2025-04-16 22:32:09'),
(399, 327, 2, '2025-04-16 23:16:32', '2025-04-16 23:16:32'),
(401, 328, 7, '2025-04-23 02:19:25', '2025-04-23 02:19:25'),
(402, 104, 29, '2025-04-23 05:25:34', '2025-04-23 05:25:34'),
(403, 104, 30, '2025-04-23 05:25:34', '2025-04-23 05:25:34'),
(404, 101, 1, '2025-04-23 06:35:22', '2025-04-23 06:35:22'),
(406, 101, 24, '2025-04-23 06:35:22', '2025-04-23 06:35:22'),
(408, 101, 47, '2025-04-23 06:35:22', '2025-04-23 06:35:22'),
(409, 100, 3, '2025-04-23 07:02:42', '2025-04-23 07:02:42'),
(410, 100, 20, '2025-04-23 07:02:42', '2025-04-23 07:02:42'),
(411, 100, 21, '2025-04-23 07:02:42', '2025-04-23 07:02:42'),
(412, 99, 3, '2025-04-23 07:15:05', '2025-04-23 07:15:05'),
(413, 99, 22, '2025-04-23 07:15:05', '2025-04-23 07:15:05'),
(414, 99, 45, '2025-04-23 07:15:05', '2025-04-23 07:15:05'),
(415, 92, 36, '2025-04-23 07:23:01', '2025-04-23 07:23:01'),
(417, 70, 52, '2025-04-24 00:42:47', '2025-04-24 00:42:47'),
(418, 248, 46, '2025-04-24 03:33:28', '2025-04-24 03:33:28'),
(419, 97, 30, '2025-04-26 23:43:44', '2025-04-26 23:43:44'),
(420, 95, 37, '2025-04-27 00:10:51', '2025-04-27 00:10:51'),
(421, 96, 57, '2025-04-27 00:29:51', '2025-04-27 00:29:51'),
(422, 94, 34, '2025-04-27 01:51:54', '2025-04-27 01:51:54'),
(424, 190, 3, '2025-07-09 01:14:14', '2025-07-09 01:14:14'),
(425, 190, 58, '2025-07-09 01:14:14', '2025-07-09 01:14:14'),
(426, 329, 36, '2025-07-09 04:55:56', '2025-07-09 04:55:56'),
(427, 271, 3, '2025-07-09 22:40:34', '2025-07-09 22:40:34'),
(428, 271, 20, '2025-07-09 22:40:34', '2025-07-09 22:40:34'),
(429, 271, 58, '2025-07-09 22:40:34', '2025-07-09 22:40:34'),
(430, 69, 36, '2025-07-09 23:01:52', '2025-07-09 23:01:52'),
(431, 69, 59, '2025-07-09 23:01:52', '2025-07-09 23:01:52'),
(432, 69, 60, '2025-07-09 23:01:52', '2025-07-09 23:01:52'),
(433, 68, 29, '2025-07-09 23:16:06', '2025-07-09 23:16:06'),
(434, 68, 30, '2025-07-09 23:16:06', '2025-07-09 23:16:06'),
(435, 68, 34, '2025-07-09 23:16:06', '2025-07-09 23:16:06'),
(436, 68, 61, '2025-07-09 23:16:06', '2025-07-09 23:16:06'),
(437, 330, 3, '2025-07-14 22:45:49', '2025-07-14 22:45:49'),
(438, 331, 1, '2025-07-25 13:27:57', '2025-07-25 13:27:57'),
(439, 332, 1, '2025-07-27 15:36:06', '2025-07-27 15:36:06');

-- --------------------------------------------------------

--
-- Table structure for table `promotion_project_lists`
--

CREATE TABLE `promotion_project_lists` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `identity` bigint DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'project,profile,proposal',
  `package_id` int NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `transaction_fee` double DEFAULT NULL,
  `duration` bigint NOT NULL DEFAULT '0',
  `expire_date` timestamp NULL DEFAULT NULL,
  `payment_gateway` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_valid_payment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `email_send` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manual_payment_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `impression` int NOT NULL DEFAULT '0',
  `click` int NOT NULL DEFAULT '0',
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_answers`
--

CREATE TABLE `question_answers` (
  `id` bigint UNSIGNED NOT NULL,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint NOT NULL,
  `sender_id` bigint NOT NULL,
  `sender_type` tinyint NOT NULL COMMENT '1=client, 2=freelancer',
  `rating` double NOT NULL,
  `review_feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating_details`
--

CREATE TABLE `rating_details` (
  `id` bigint UNSIGNED NOT NULL,
  `rating_id` bigint NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'skill,availability,communication,deadline,quality,co-operation',
  `rating` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint DEFAULT NULL,
  `client_id` bigint NOT NULL,
  `freelancer_id` bigint NOT NULL,
  `reporter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'freelancer, client',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin', '2023-10-19 07:28:11', '2023-10-19 07:28:11'),
(2, 'Admin', 'admin', '2023-10-19 07:31:16', '2023-10-19 07:31:16'),
(6, 'Editor', 'admin', '2023-10-23 01:03:36', '2023-10-23 01:03:36');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(11, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(30, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(52, 2),
(53, 2),
(54, 2),
(55, 2),
(56, 2),
(57, 2),
(58, 2),
(61, 2),
(62, 2),
(63, 2),
(65, 2),
(66, 2),
(67, 2),
(68, 2),
(70, 2),
(71, 2),
(72, 2),
(73, 2),
(76, 2),
(77, 2),
(78, 2),
(79, 2),
(80, 2),
(81, 2),
(82, 2),
(83, 2),
(84, 2),
(85, 2),
(90, 2),
(91, 2),
(92, 2),
(93, 2),
(94, 2),
(95, 2),
(96, 2),
(97, 2),
(98, 2),
(99, 2),
(100, 2),
(101, 2),
(102, 2),
(103, 2),
(104, 2),
(105, 2),
(106, 2),
(107, 2),
(110, 2),
(111, 2),
(112, 2),
(113, 2),
(114, 2),
(115, 2),
(116, 2),
(117, 2),
(118, 2),
(119, 2),
(120, 2),
(121, 2),
(122, 2),
(123, 2),
(124, 2),
(125, 2),
(126, 2),
(127, 2),
(128, 2),
(129, 2),
(130, 2),
(131, 2),
(132, 2),
(133, 2),
(134, 2),
(135, 2),
(136, 2),
(137, 2),
(138, 2),
(139, 2),
(140, 2),
(141, 2),
(142, 2),
(143, 2),
(144, 2),
(145, 2),
(146, 2),
(147, 2),
(148, 2),
(149, 2),
(150, 2),
(151, 2),
(152, 2),
(153, 2),
(154, 2),
(155, 2),
(156, 2),
(157, 2),
(158, 2),
(159, 2),
(160, 2),
(161, 2),
(162, 2),
(163, 2),
(164, 2),
(165, 2),
(166, 2),
(167, 2),
(168, 2),
(169, 2),
(170, 2),
(171, 2),
(172, 2),
(173, 2),
(176, 2),
(177, 2),
(178, 2),
(180, 2),
(181, 2),
(182, 2),
(184, 2),
(185, 2),
(186, 2),
(187, 2),
(188, 2),
(189, 2),
(190, 2),
(191, 2),
(192, 2),
(193, 2),
(194, 2),
(195, 2),
(196, 2),
(197, 2),
(200, 2),
(201, 2),
(202, 2),
(203, 2),
(204, 2),
(205, 2),
(207, 2),
(208, 2),
(1, 6),
(2, 6),
(3, 6),
(4, 6),
(5, 6),
(6, 6),
(88, 6),
(89, 6);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint UNSIGNED NOT NULL,
  `skill` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_category_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `skill`, `category_id`, `sub_category_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TravelGuide', '4', NULL, 1, '2023-02-08 22:31:43', '2025-04-13 00:21:41'),
(2, 'TravelTips', '4', NULL, 1, '2023-02-08 22:41:05', '2025-04-13 00:22:03'),
(3, 'LuxuryTravel', '4', NULL, 1, '2023-02-08 22:42:43', '2025-04-13 00:22:32'),
(4, 'OutfitInspo', '2', NULL, 1, '2023-02-08 22:49:30', '2025-04-13 00:21:06'),
(6, 'MensFashion', '2', NULL, 1, '2023-02-08 23:00:58', '2025-04-13 00:20:45'),
(7, 'SustainableStyle', '2', NULL, 1, '2023-02-08 23:03:02', '2025-04-13 00:20:10'),
(30, 'StreetStyle', '1', NULL, 1, '2023-11-05 23:34:30', '2025-04-13 00:17:54'),
(32, 'Negotiation skills', '1', NULL, 1, '2023-11-05 23:34:58', '2025-04-13 00:16:21'),
(52, 'EasyRecipes', '5', NULL, 1, '2023-11-06 01:16:19', '2025-04-13 00:18:27'),
(53, 'FoodieFinds', '5', NULL, 1, '2023-11-06 01:16:43', '2025-04-13 00:19:02'),
(54, 'FoodPhotography', '5', NULL, 1, '2023-11-06 01:17:00', '2025-04-13 00:19:19'),
(56, 'Hashtag Strategy', '11', NULL, 1, '2023-11-06 02:01:16', '2025-04-13 00:12:48'),
(57, 'YouTube', '11', NULL, 1, '2023-11-06 02:02:18', '2025-04-13 00:12:08'),
(58, 'TikTok', '2', NULL, 1, '2024-01-30 05:42:18', '2025-04-13 00:11:55'),
(59, 'Instagram', '1', NULL, 1, '2024-01-30 05:42:48', '2025-04-13 00:11:36'),
(60, 'Parenting', '13', '31', 1, '2025-04-28 00:07:08', '2025-04-28 00:07:08'),
(61, 'Instagram Marketing', '3', '36', 1, '2025-07-08 11:26:36', '2025-07-08 11:26:36'),
(62, 'Storytelling', '11', NULL, 1, '2025-07-08 11:34:55', '2025-07-08 11:34:55'),
(63, 'Tech Reviews', '11', NULL, 1, '2025-07-08 11:38:28', '2025-07-08 11:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `social_profiles`
--

CREATE TABLE `social_profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `profile_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `followers` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform_icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_profiles`
--

INSERT INTO `social_profiles` (`id`, `user_id`, `profile_link`, `followers`, `platform_icon`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 99, 'https://twitter.com', '2.2m', 'fab fa-twitter-square', NULL, '2024-10-27 05:43:47', '2024-10-29 06:58:02'),
(2, 99, 'https://instagram.com', '33.8m', 'fab fa-instagram', NULL, '2024-10-27 05:51:57', '2024-10-29 06:57:37'),
(3, 99, 'https://youtube.com', '30.8m', 'fab fa-youtube', NULL, '2024-10-28 01:46:05', '2024-10-29 06:57:11'),
(7, 99, 'https://facebook.com', '33.9m', 'fab fa-facebook', NULL, '2024-10-29 06:55:24', '2024-10-29 06:56:39'),
(8, 7, 'https://instagram.com', '456k', 'fab fa-instagram', NULL, '2025-04-09 06:42:19', '2025-04-09 06:42:19'),
(9, 7, 'https://facebook.com', '450k', 'fab fa-facebook', NULL, '2025-04-09 06:42:42', '2025-04-09 06:42:42'),
(10, 7, 'https://youtube.com', '490m', 'fab fa-youtube', NULL, '2025-04-09 23:27:31', '2025-04-09 23:27:31'),
(11, 5, 'https://instagram.com', '50k', 'fab fa-instagram', NULL, '2025-04-12 23:01:07', '2025-07-26 21:36:03'),
(12, 5, 'https://facebook.com', '30k', 'fab fa-facebook-f', NULL, '2025-04-12 23:01:41', '2025-04-12 23:01:41'),
(14, 4, '#', '100k', 'fab fa-instagram', NULL, '2025-04-15 04:28:05', '2025-04-15 04:28:05'),
(15, 4, '#', '150k', 'fab fa-facebook-f', NULL, '2025-04-15 04:28:26', '2025-04-15 04:28:26'),
(16, 4, '#', '200k', 'fab fa-youtube', NULL, '2025-04-15 04:29:35', '2025-04-15 04:29:35'),
(17, 3, '#', '450k', 'fab fa-instagram', NULL, '2025-04-15 05:32:43', '2025-04-15 05:32:43'),
(18, 3, '#', '300K', 'fab fa-facebook-f', NULL, '2025-04-15 05:33:05', '2025-04-15 05:33:05'),
(19, 3, '#', '10M', 'fab fa-youtube', NULL, '2025-04-15 05:33:26', '2025-04-15 05:33:26'),
(20, 102, 'https://facebook.com', '124k', 'fab fa-facebook-f', NULL, '2025-04-21 00:17:13', '2025-04-21 00:18:18'),
(21, 102, 'https://youtube.com', '340k', 'fab fa-youtube', NULL, '2025-04-21 00:17:53', '2025-04-21 00:18:44'),
(22, 102, 'https://instagram.com', '40k', 'fab fa-instagram', NULL, '2025-04-21 00:19:10', '2025-04-21 00:19:10'),
(23, 103, 'sdfsdfsd', '45', 'fab fa-500px', NULL, '2025-05-02 06:42:21', '2025-05-02 06:42:21'),
(24, 5, 'test', '1050k', 'fab fa-youtube', NULL, '2025-06-25 03:28:12', '2025-07-26 15:42:04'),
(25, 8, 'https://www.facebook.com', '100k', 'fab fa-facebook-f', NULL, '2025-07-10 10:21:26', '2025-07-10 10:21:26'),
(26, 8, 'https://www.instagram.com/', '1M', 'fab fa-instagram', NULL, '2025-07-10 10:21:55', '2025-07-10 10:21:55'),
(27, 9, 'https://www.youtube.com/', '300K', 'fab fa-youtube', NULL, '2025-07-10 10:25:38', '2025-07-10 10:25:38'),
(28, 9, 'https://www.facebook.com/', '250K', 'fab fa-facebook-f', NULL, '2025-07-10 10:26:04', '2025-07-10 10:26:04'),
(29, 9, 'https://www.instagram.com/', '300K', 'fab fa-instagram', NULL, '2025-07-10 10:26:23', '2025-07-10 10:36:52'),
(30, 10, 'facebook.com', '1M', 'fab fa-facebook-f', NULL, '2025-07-10 10:38:28', '2025-07-10 10:38:28'),
(31, 10, 'instagram', '2.5M', 'fab fa-instagram', NULL, '2025-07-10 10:38:48', '2025-07-10 10:38:48'),
(32, 10, 'https://www.youtube.com/', '600K', 'fab fa-youtube', NULL, '2025-07-10 10:39:16', '2025-07-10 10:39:16'),
(33, 11, 'https://www.facebook.com/', '2M', 'fab fa-facebook-f', NULL, '2025-07-10 10:41:45', '2025-07-10 10:41:45'),
(34, 11, 'https://www.instagram.com/', '300K', 'fab fa-instagram', NULL, '2025-07-10 10:42:18', '2025-07-10 10:42:18'),
(35, 116, 'Facebook.com', '400k', 'fab fa-facebook-f', NULL, '2025-07-14 22:02:41', '2025-07-14 22:02:41'),
(36, 116, 'Instagram', '1M', 'fab fa-instagram', NULL, '2025-07-14 22:03:07', '2025-07-14 22:03:07');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint UNSIGNED NOT NULL,
  `country_id` int DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `timezone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `state`, `status`, `timezone`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dhaka', 1, 'Asia/Dhaka', '2023-01-28 00:55:31', '2023-03-28 23:39:28'),
(2, 1, 'Chittagong', 1, NULL, '2023-01-28 00:55:56', '2023-01-28 03:04:44'),
(3, 1, 'Sylhet', 1, NULL, '2023-01-28 00:56:11', '2023-01-28 03:22:41'),
(16, 2, 'Alaska ', 1, 'America/Anchorage', '2023-01-28 04:32:19', '2023-11-25 22:21:44'),
(17, 1, '   Rajshahi', 1, NULL, '2023-01-28 04:32:19', '2023-01-28 04:32:19'),
(18, 1, '   Khulna', 1, NULL, '2023-01-28 04:32:19', '2023-01-28 04:32:19'),
(19, 14, 'New Delli', 1, NULL, '2023-02-08 04:33:28', '2023-02-08 04:58:52'),
(20, 11, 'Lahore', 1, NULL, '2023-02-08 04:40:48', '2023-02-08 04:56:01'),
(21, 3, 'Walsall', 1, 'Europe/London', '2023-02-08 05:09:35', '2023-02-08 05:09:35'),
(22, 4, 'Tokyo', 1, 'Asia/Tokyo', '2023-02-08 05:09:44', '2023-02-08 05:09:44'),
(23, 13, 'zxczxcz', 1, NULL, '2023-02-08 05:09:52', '2023-02-08 05:09:52'),
(24, 7, 'Newyork', 1, 'America/New_York', '2024-09-25 04:06:16', '2024-09-25 04:06:39'),
(25, 7, 'WashingTon', 1, 'America/Indiana/Winamac', '2024-09-25 04:07:14', '2024-09-25 04:07:14');

-- --------------------------------------------------------

--
-- Table structure for table `static_options`
--

CREATE TABLE `static_options` (
  `id` bigint UNSIGNED NOT NULL,
  `option_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `static_options`
--

INSERT INTO `static_options` (`id`, `option_name`, `option_value`, `created_at`, `updated_at`) VALUES
(1, 'site_title', 'Influencer', '2022-12-10 01:37:26', '2025-07-24 01:10:37'),
(2, 'site_footer_copyright', '{copy}  {year}  All right reserved by  <a href=\"https://bytesed.com/\">bytesed</a>', '2022-12-10 01:37:26', '2025-07-24 01:10:37'),
(3, 'disable_user_email_verify', NULL, '2022-12-10 01:37:26', '2025-07-24 01:10:37'),
(4, 'site_maintenance_mode', NULL, '2022-12-10 01:37:26', '2025-07-24 01:10:37'),
(5, 'admin_loader_animation', 'on', '2022-12-10 01:37:26', '2025-07-24 01:10:37'),
(6, 'site_loader_animation', 'on', '2022-12-10 01:37:26', '2025-07-24 01:10:37'),
(7, 'site_force_ssl_redirection', NULL, '2022-12-10 01:37:26', '2025-07-24 01:10:37'),
(8, 'site_google_captcha_enable', 'on', '2022-12-10 01:37:26', '2025-07-24 01:10:37'),
(9, 'site_logo', '464', '2022-12-11 23:42:42', '2025-07-17 03:44:52'),
(10, 'site_favicon', '398', '2022-12-11 23:42:42', '2025-07-17 03:44:52'),
(11, 'site_main_color_one', '#000000', '2022-12-12 00:51:22', '2023-11-14 08:59:17'),
(12, 'site_main_color_two', '#000000', '2022-12-12 00:51:22', '2023-11-14 08:59:17'),
(13, 'site_main_color_three', '#4b1111', '2022-12-12 00:51:22', '2023-11-14 08:59:17'),
(14, 'heading_color', '#2A2B2C', '2022-12-12 00:51:22', '2025-07-14 04:10:36'),
(15, 'light_color', '#a04eb7', '2022-12-12 00:51:22', '2023-11-14 08:59:17'),
(16, 'extra_light_color', '#000000', '2022-12-12 00:51:22', '2023-11-14 08:59:17'),
(17, 'body_font_family', 'Urbanist', '2022-12-12 05:19:22', '2025-07-03 00:42:04'),
(18, 'heading_font_family', 'Plus Jakarta Sans', '2022-12-12 05:19:22', '2025-07-03 00:42:04'),
(19, 'extra_body_font', NULL, '2022-12-12 05:19:22', '2025-07-03 00:42:04'),
(20, 'heading_font', NULL, '2022-12-12 05:19:22', '2025-07-03 00:42:04'),
(21, 'body_font_variant', 'a:9:{i:0;s:5:\"0,100\";i:1;s:5:\"0,200\";i:2;s:5:\"0,300\";i:3;s:5:\"0,400\";i:4;s:5:\"0,500\";i:5;s:5:\"0,600\";i:6;s:5:\"0,700\";i:7;s:5:\"0,800\";i:8;s:5:\"0,900\";}', '2022-12-12 05:19:22', '2025-07-03 00:42:04'),
(22, 'heading_font_variant', 'a:7:{i:0;s:5:\"0,200\";i:1;s:5:\"0,300\";i:2;s:5:\"0,400\";i:3;s:5:\"0,500\";i:4;s:5:\"0,600\";i:5;s:5:\"0,700\";i:6;s:5:\"0,800\";}', '2022-12-12 05:19:22', '2025-07-03 00:42:04'),
(23, 'site_meta_tags', 'Influencer,Influstar', '2022-12-13 00:03:23', '2025-07-24 11:27:34'),
(24, 'site_meta_description', 'Influencer Hiring Marketplace', '2022-12-13 00:03:23', '2025-07-24 11:27:34'),
(25, 'og_meta_title', 'Influencer Hiring Marketplace', '2022-12-13 00:03:23', '2025-07-24 11:27:34'),
(26, 'og_meta_description', 'Influencer Hiring Marketplace', '2022-12-13 00:03:23', '2025-07-24 11:27:34'),
(27, 'og_meta_site_name', 'Influencer Hiring Marketplace', '2022-12-13 00:03:23', '2025-07-24 11:27:34'),
(28, 'og_meta_url', 'Influencer Hiring Marketplace', '2022-12-13 00:03:24', '2025-07-24 11:27:34'),
(29, 'og_meta_image', '2', '2022-12-13 00:03:24', '2025-07-24 11:27:34'),
(30, 'site_third_party_tracking_code', NULL, '2022-12-13 01:46:32', '2024-01-20 05:51:34'),
(31, 'site_google_analytics', NULL, '2022-12-13 01:46:32', '2024-01-20 05:09:44'),
(32, 'site_google_captcha_v3_site_key', '6LcJtlYpAAAAAAZAJk7pjWKhz09FRSWLCYyKVpAd', '2022-12-13 01:46:32', '2024-01-20 05:36:20'),
(33, 'site_google_captcha_v3_secret_key', '6LcJtlYpAAAAAENuELMZG9N3UqUak0bV0IvioEHA', '2022-12-13 01:46:32', '2024-01-20 05:36:20'),
(34, 'tawk_api_key', NULL, '2022-12-13 01:46:32', '2024-01-20 05:09:44'),
(35, 'facebook_client_id', '1038164014840209', '2022-12-13 04:59:55', '2025-07-17 03:28:21'),
(36, 'facebook_client_secret', '9525a1421712efe96842c958d6cfacd1', '2022-12-13 04:59:55', '2025-07-17 03:28:21'),
(37, 'google_client_id', '186610561011-mccpr8ovke96u0vd8o1d0te3t2bijgbk.apps.googleusercontent.com', '2022-12-13 04:59:55', '2025-07-17 03:28:21'),
(38, 'google_client_secret', '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', '2022-12-13 04:59:55', '2025-07-17 03:28:21'),
(39, 'site_global_email', 'info@influencer.test', '2022-12-13 07:46:18', '2025-07-16 03:20:54'),
(40, 'site_global_email_template', '<p>sdf sdf sdf sdf sdfs dsdf sdf&nbsp;</p>', '2022-12-13 07:46:18', '2025-07-16 03:20:54'),
(41, 'site_smtp_mail_mailer', 'smtp', '2022-12-14 00:53:07', '2024-02-19 01:50:18'),
(42, 'site_smtp_mail_host', 'smtp.mailtrap.io', '2022-12-14 00:53:07', '2024-02-19 01:50:18'),
(43, 'site_smtp_mail_port', '587', '2022-12-14 00:53:07', '2024-02-19 01:50:18'),
(44, 'site_smtp_mail_username', '8fa73add6aad18', '2022-12-14 00:53:07', '2024-02-19 01:50:18'),
(45, 'site_smtp_mail_password', 'c96cbf3b046393', '2022-12-14 00:53:07', '2024-02-19 01:50:18'),
(46, 'site_smtp_mail_encryption', 'tls', '2022-12-14 00:53:07', '2024-02-19 01:50:18'),
(47, 'site_gdpr_cookie_title', 'Cookies & Privacy', '2022-12-15 03:19:57', '2022-12-15 03:24:34'),
(48, 'site_gdpr_cookie_message', 'Is education residence conveying so so. Suppose shyness say ten behaved morning had. Any unsatiable assistance compliment occasional too reasonably advantages.', '2022-12-15 03:19:57', '2022-12-15 03:24:34'),
(49, 'site_gdpr_cookie_more_info_label', 'More information', '2022-12-15 03:19:57', '2022-12-15 03:24:34'),
(50, 'site_gdpr_cookie_more_info_link', '{url}/privacy-policy', '2022-12-15 03:19:57', '2022-12-15 03:24:34'),
(51, 'site_gdpr_cookie_accept_button_label', 'Accept', '2022-12-15 03:19:57', '2022-12-15 03:24:34'),
(52, 'site_gdpr_cookie_decline_button_label', 'Decline', '2022-12-15 03:19:57', '2022-12-15 03:24:34'),
(53, 'site_gdpr_cookie_manage_button_label', 'Manage', '2022-12-15 03:19:57', '2022-12-15 03:24:34'),
(54, 'site_gdpr_cookie_manage_title', NULL, '2022-12-15 03:19:57', '2022-12-15 03:24:34'),
(55, 'site_gdpr_cookie_manage_item_title', 'a:2:{i:0;s:4:\"test\";i:1;s:8:\"yr dfdfg\";}', '2022-12-15 03:19:57', '2022-12-15 03:24:34'),
(56, 'site_gdpr_cookie_manage_item_description', 'a:2:{i:0;s:14:\"sadas dsa asda\";i:1;s:61:\"fg dfg dfgdf dfgdfg dfg dfg dfg dfg dfg dfg dfg dfgdfgdfg d d\";}', '2022-12-15 03:19:57', '2022-12-15 03:24:34'),
(57, 'site_gdpr_cookie_delay', '5000', '2022-12-15 03:19:57', '2022-12-15 03:24:34'),
(58, 'site_gdpr_cookie_enabled', 'on', '2022-12-15 03:19:57', '2022-12-15 03:24:34'),
(59, 'site_gdpr_cookie_expire', '30', '2022-12-15 03:19:57', '2022-12-15 03:24:34'),
(60, 'global_navbar_variant', '01', '2022-12-15 07:08:00', '2025-05-06 01:07:55'),
(61, 'global_footer_variant', '01', '2022-12-17 23:45:33', '2022-12-17 23:45:41'),
(62, 'paypal_preview_logo', '236', '2022-12-20 01:33:51', '2025-07-02 04:05:29'),
(63, 'paypal_mode', NULL, '2022-12-20 01:33:51', '2023-04-09 22:54:08'),
(64, 'paypal_sandbox_client_id', 'AUP7AuZMwJbkee-2OmsSZrU-ID1XUJYE-YB-2JOrxeKV-q9ZJZYmsr-UoKuJn4kwyCv5ak26lrZyb-gb', '2022-12-20 01:33:51', '2025-07-02 04:05:29'),
(65, 'paypal_sandbox_client_secret', 'EEIxCuVnbgING9EyzcF2q-gpacLneVbngQtJ1mbx-42Lbq-6Uf6PEjgzF7HEayNsI4IFmB9_CZkECc3y', '2022-12-20 01:33:51', '2025-07-02 04:05:29'),
(66, 'paypal_sandbox_app_id', '641651651958', '2022-12-20 01:33:51', '2025-07-02 04:05:29'),
(67, 'paypal_live_app_id', NULL, '2022-12-20 01:33:51', '2025-07-02 04:05:29'),
(68, 'paypal_payment_action', NULL, '2022-12-20 01:33:51', '2025-07-02 04:05:29'),
(69, 'paypal_currency', NULL, '2022-12-20 01:33:51', '2025-07-02 04:05:29'),
(70, 'paypal_notify_url', NULL, '2022-12-20 01:33:51', '2025-07-02 04:05:29'),
(71, 'paypal_locale', NULL, '2022-12-20 01:33:51', '2025-07-02 04:05:29'),
(72, 'paypal_validate_ssl', NULL, '2022-12-20 01:33:52', '2025-07-02 04:05:29'),
(73, 'paypal_live_client_id', NULL, '2022-12-20 01:33:52', '2025-07-02 04:05:29'),
(74, 'paypal_live_client_secret', NULL, '2022-12-20 01:33:52', '2025-07-02 04:05:29'),
(75, 'paypal_gateway', 'on', '2022-12-20 01:33:52', '2025-07-02 04:05:29'),
(76, 'paypal_test_mode', 'on', '2022-12-20 01:33:52', '2025-07-02 04:05:29'),
(77, 'razorpay_preview_logo', '231', '2022-12-20 01:56:54', '2025-07-02 04:05:29'),
(78, 'razorpay_key', NULL, '2022-12-20 01:56:54', '2025-07-02 04:05:29'),
(79, 'razorpay_secret', NULL, '2022-12-20 01:56:54', '2025-07-02 04:05:29'),
(80, 'razorpay_api_key', 'rzp_test_SXk7LZqsBPpAkj', '2022-12-20 01:56:54', '2025-07-02 04:05:29'),
(81, 'razorpay_api_secret', 'Nenvq0aYArtYBDOGgmMH7JNv', '2022-12-20 01:56:54', '2025-07-02 04:05:29'),
(82, 'razorpay_gateway', 'on', '2022-12-20 01:56:54', '2025-07-02 04:05:29'),
(83, 'stripe_preview_logo', '252', '2022-12-20 01:56:54', '2025-07-02 04:05:29'),
(84, 'stripe_publishable_key', NULL, '2022-12-20 01:56:54', '2025-07-02 04:05:29'),
(85, 'stripe_secret_key', 'sk_test_51GwS1SEmGOuJLTMs2vhSliTwAGkOt4fKJMBrxzTXeCJoLrRu8HFf4I0C5QuyE3l3bQHBJm3c0qFmeVjd0V9nFb6Z00VrWDJ9Uw', '2022-12-20 01:56:54', '2025-07-02 04:05:29'),
(86, 'stripe_public_key', 'pk_test_51GwS1SEmGOuJLTMsIeYKFtfAT3o3Fc6IOC7wyFmmxA2FIFQ3ZigJ2z1s4ZOweKQKlhaQr1blTH9y6HR2PMjtq1Rx00vqE8LO0x', '2022-12-20 01:56:54', '2025-07-02 04:05:29'),
(87, 'stripe_gateway', 'on', '2022-12-20 01:56:55', '2025-07-02 04:05:29'),
(88, 'paytm_gateway', NULL, '2022-12-20 01:56:55', '2025-07-02 04:05:29'),
(89, 'paytm_preview_logo', '232', '2022-12-20 01:56:55', '2025-07-02 04:05:29'),
(90, 'paytm_merchant_key', 'dv0XtmsPYpewNag&', '2022-12-20 01:56:55', '2025-07-02 04:05:29'),
(91, 'paytm_merchant_mid', 'Digita57697814558795', '2022-12-20 01:56:55', '2025-07-02 04:05:29'),
(92, 'paytm_merchant_website', 'WEBSTAGING', '2022-12-20 01:56:55', '2025-07-02 04:05:29'),
(93, 'paytm_test_mode', NULL, '2022-12-20 01:56:55', '2025-07-02 04:05:29'),
(94, 'paystack_merchant_email', 'nazmuldiu8@gmail.com', '2022-12-20 01:56:55', '2025-07-02 04:05:29'),
(95, 'paystack_preview_logo', '233', '2022-12-20 01:56:55', '2025-07-02 04:05:29'),
(96, 'paystack_public_key', 'pk_test_b39c852df5cb0e78ccf9f59c3b91831cf39e7a90', '2022-12-20 01:56:55', '2025-07-02 04:05:29'),
(97, 'paystack_secret_key', 'sk_test_6ef0642e0da8dc790c7dd9ea50144ac4c4a28b5c', '2022-12-20 01:56:55', '2025-07-02 04:05:29'),
(98, 'paystack_gateway', 'on', '2022-12-20 01:56:55', '2025-07-02 04:05:29'),
(99, 'mollie_preview_logo', '238', '2022-12-20 01:56:55', '2025-07-02 04:05:29'),
(100, 'mollie_public_key', 'test_fVk76gNbAp6ryrtRjfAVvzjxSHxC2v', '2022-12-20 01:56:55', '2025-07-02 04:05:29'),
(101, 'mollie_gateway', 'on', '2022-12-20 01:56:55', '2025-07-02 04:05:29'),
(102, 'marcado_pagp_client_id', NULL, '2022-12-20 01:56:55', '2023-04-09 22:54:10'),
(103, 'marcado_pago_client_secret', NULL, '2022-12-20 01:56:55', '2023-04-09 22:54:10'),
(104, 'marcado_pago_test_mode', NULL, '2022-12-20 01:56:55', '2023-04-09 22:54:10'),
(105, 'cash_on_delivery_gateway', NULL, '2022-12-20 01:56:55', '2025-07-02 04:05:29'),
(106, 'cash_on_delivery_preview_logo', NULL, '2022-12-20 01:56:55', '2025-07-02 04:05:29'),
(107, 'flutterwave_preview_logo', '244', '2022-12-20 01:56:55', '2025-07-02 04:05:29'),
(108, 'flutterwave_gateway', 'on', '2022-12-20 01:56:55', '2025-07-02 04:05:29'),
(109, 'flw_public_key', '86cce2ec43c63e09a517290a8347fcab', '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(110, 'flw_secret_key', 'd37a42d8917db84f1b2f47c125252d0a', '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(111, 'flw_secret_hash', 'xilancer', '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(112, 'midtrans_preview_logo', '240', '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(113, 'midtrans_merchant_id', NULL, '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(114, 'midtrans_server_key', 'SB-Mid-server-9z5jztsHyYxEdSs7DgkNg2on', '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(115, 'midtrans_client_key', 'SB-Mid-client-iDuy-jKdZHkLjL_I', '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(116, 'midtrans_environment', NULL, '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(117, 'midtrans_gateway', 'on', '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(118, 'midtrans_test_mode', 'on', '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(119, 'payfast_preview_logo', '235', '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(120, 'payfast_merchant_id', '10024000', '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(121, 'payfast_merchant_key', '77jcu5v4ufdod', '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(122, 'payfast_passphrase', 'testpayfastsohan', '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(123, 'payfast_merchant_env', NULL, '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(124, 'payfast_itn_url', NULL, '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(125, 'payfast_gateway', 'on', '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(126, 'cashfree_preview_logo', '246', '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(127, 'cashfree_test_mode', NULL, '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(128, 'cashfree_app_id', '94527832f47d6e74fa6ca5e3c72549', '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(129, 'cashfree_secret_key', 'ec6a3222018c676e95436b2e26e89c1ec6be2830', '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(130, 'cashfree_gateway', NULL, '2022-12-20 01:56:56', '2025-07-02 04:05:29'),
(131, 'instamojo_preview_logo', '243', '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(132, 'instamojo_client_id', 'test_nhpJ3RvWObd3uryoIYF0gjKby5NB5xu6S9Z', '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(133, 'instamojo_client_secret', 'test_iZusG4P35maQVPTfqutbCc6UEbba3iesbCbrYM7zOtDaJUdbPz76QOnBcDgblC53YBEgsymqn2sx3NVEPbl3b5coA3uLqV1ikxKquOeXSWr8Ruy7eaKUMX1yBbm', '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(134, 'instamojo_username', NULL, '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(135, 'instamojo_password', NULL, '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(136, 'instamojo_test_mode', NULL, '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(137, 'instamojo_gateway', NULL, '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(138, 'marcadopago_preview_logo', '239', '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(139, 'marcado_pago_client_id', 'TEST-0a3cc78a-57bf-4556-9dbe-2afa06347769', '2022-12-20 01:56:57', '2023-04-10 21:43:47'),
(140, 'marcadopago_gateway', NULL, '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(141, 'marcadopago_test_mode', NULL, '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(142, 'zitopay_username', 'dvrobin4', '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(143, 'zitopay_preview_logo', '253', '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(144, 'zitopay_gateway', 'on', '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(145, 'zitopay_test_mode', 'on', '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(146, 'billplz_collection_name', 'kjj5ya006', '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(147, 'billplz_xsignature', 'S-HDXHxRJB-J7rNtoktZkKJg', '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(148, 'billplz_key', 'b2ead199-e6f3-4420-ae5c-c94f1b1e8ed6', '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(149, 'billplz_preview_logo', '247', '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(150, 'billplz_gateway', 'on', '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(151, 'billplz_test_mode', 'on', '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(152, 'paytabs_region', 'GLOBAL', '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(153, 'paytabs_profile_id', '96698', '2022-12-20 01:56:57', '2025-07-02 04:05:29'),
(154, 'paytabs_server_key', 'SKJNDNRHM2-JDKTZDDH2N-H9HLMJNJ2L', '2022-12-20 01:56:58', '2025-07-02 04:05:29'),
(155, 'paytabs_preview_logo', '234', '2022-12-20 01:56:58', '2025-07-02 04:05:29'),
(156, 'paytabs_gateway', 'on', '2022-12-20 01:56:58', '2025-07-02 04:05:29'),
(157, 'paytabs_test_mode', 'on', '2022-12-20 01:56:58', '2025-07-02 04:05:29'),
(158, 'cinetpay_site_id', '445160', '2022-12-20 01:56:58', '2025-07-02 04:05:29'),
(159, 'cinetpay_app_key', '12912847765bc0db748fdd44.40081707', '2022-12-20 01:56:58', '2025-07-02 04:05:29'),
(160, 'cinetpay_preview_logo', '245', '2022-12-20 01:56:58', '2025-07-02 04:05:29'),
(161, 'cinetpay_gateway', 'on', '2022-12-20 01:56:58', '2025-07-02 04:05:29'),
(162, 'cinetpay_test_mode', 'on', '2022-12-20 01:56:58', '2025-07-02 04:05:29'),
(163, 'squareup_application_id', NULL, '2022-12-20 01:56:58', '2025-07-02 04:05:29'),
(164, 'squareup_location_id', 'LA1P8YBKGAH7R', '2022-12-20 01:56:58', '2025-07-02 04:05:29'),
(165, 'squareup_access_token', 'EAAAlzld5YVN5RPECvh-Yj11JblBkAnwh2lcfEGseRMLH6SQS_6V_AhsrZuPX9dE', '2022-12-20 01:56:58', '2025-07-02 04:05:29'),
(166, 'squareup_preview_logo', '249', '2022-12-20 01:56:58', '2025-07-02 04:05:29'),
(167, 'squareup_gateway', 'on', '2022-12-20 01:56:58', '2025-07-02 04:05:29'),
(168, 'squareup_test_mode', 'on', '2022-12-20 01:56:58', '2025-07-02 04:05:29'),
(169, 'paytm_channel', 'WEB', '2022-12-20 02:01:36', '2025-07-02 04:05:29'),
(170, 'paytm_industry_type', 'Retail', '2022-12-20 02:01:36', '2025-07-02 04:05:29'),
(171, 'error_404_page_title', 'Page Not Found', '2022-12-26 04:23:23', '2023-11-19 01:48:27'),
(172, 'error_404_page_subtitle', 'Page Unavailable!!', '2022-12-26 04:23:23', '2023-11-19 01:48:27'),
(173, 'error_404_page_paragraph', 'Sorry but the page you are looking for does not exist, have been removed. name changed or is temporarily unavailable', '2022-12-26 04:23:23', '2023-11-19 01:48:27'),
(174, 'error_404_page_button_text', 'Back To Home', '2022-12-26 04:23:23', '2023-11-19 01:48:27'),
(175, 'error_image', '102', '2022-12-26 04:23:23', '2023-11-19 01:48:27'),
(176, 'maintain_page_title', 'Sorry  we are down for schedule maintenance right now !!', '2022-12-26 05:51:02', '2023-12-20 05:31:15'),
(177, 'maintain_page_description', 'Sorry  we are down for schedule maintenance right now !!', '2022-12-26 05:51:02', '2023-12-20 05:31:15'),
(178, 'maintenance_duration', '2022-12-31', '2022-12-26 05:51:02', '2023-12-20 05:31:15'),
(179, 'maintain_page_logo', '125', '2022-12-26 05:51:02', '2023-12-20 05:31:15'),
(180, 'professional_title', NULL, '2023-02-14 04:40:23', '2024-10-27 04:24:39'),
(181, 'intro_title', 'Provide a short intro within 250 character.', '2023-02-14 04:40:23', '2024-10-27 04:24:39'),
(183, 'inner_title', 'Experience', '2023-02-14 05:31:43', '2023-02-14 05:32:10'),
(184, 'modal_title', 'Add Work Experience', '2023-02-14 05:31:43', '2023-02-14 05:32:10'),
(185, 'edit_modal_title', 'Edit Work Experience', '2023-02-14 05:31:43', '2023-02-14 05:32:10'),
(193, 'work_title', 'What kinds of services will you provide to clients?(Work)', '2023-02-14 05:57:43', '2024-10-29 01:10:58'),
(194, 'work_inner_title', 'Choose, what would you do?', '2023-02-14 05:57:43', '2024-10-29 01:10:58'),
(195, 'work_modal_title', 'Choose a service', '2023-02-14 05:57:43', '2024-10-29 01:10:58'),
(196, 'skill_title', 'Great! Now add some skills you have', '2023-02-14 06:30:53', '2024-10-29 01:11:05'),
(197, 'hourly_rate', NULL, '2023-02-14 06:40:13', '2023-02-14 06:40:13'),
(198, 'profile_photo', NULL, '2023-02-14 06:40:13', '2023-02-14 06:40:13'),
(199, 'hourly_rate_title', 'What is your hourly rate?', '2023-02-14 06:41:09', '2024-01-22 03:50:50'),
(200, 'profile_photo_title', 'Upload profile photo', '2023-02-14 06:41:09', '2024-10-29 01:09:31'),
(201, 'account_page_title', 'Setup Your Account', '2023-02-14 22:59:23', '2023-04-02 22:04:24'),
(202, 'account_page_skip_title', 'Skip', '2023-02-14 22:59:23', '2023-04-02 22:04:24'),
(203, 'account_page_back_button_title', 'Back', '2023-02-14 22:59:23', '2023-04-02 22:04:24'),
(204, 'introduction_menu_title', 'Introduction', '2023-02-14 23:08:28', '2024-10-27 04:24:39'),
(205, 'introduction_menu_sub_title', 'How do you professionally introduce yourself?', '2023-02-14 23:08:28', '2024-10-27 04:24:39'),
(210, 'work_menu_title', 'Choose Categories', '2023-02-14 23:37:33', '2024-10-29 01:10:58'),
(211, 'work_menu_sub_title', 'Add the services and necessary skills you offer.', '2023-02-14 23:37:33', '2024-10-29 01:10:58'),
(212, 'skill_menu_title', 'Skills', '2023-02-14 23:37:56', '2024-10-29 01:11:05'),
(213, 'skill_menu_sub_title', 'Add the services and necessary skills you offer.', '2023-02-14 23:37:56', '2024-10-29 01:11:05'),
(214, 'hourly_rate_menu_title', 'Profile  Photo', '2023-02-14 23:38:36', '2024-10-29 01:09:31'),
(215, 'hourly_rate_menu_sub_title', 'Just add your profile photo to finish.', '2023-02-14 23:38:36', '2024-10-29 01:09:31'),
(216, 'user_identity_verify_subject', 'User identity verify request email', '2023-02-16 02:31:58', '2023-02-16 02:32:15'),
(217, 'user_identity_verify_message', '<p>Hello,</p><p></p>You have a new request for user identity verification<p></p>', '2023-02-16 02:31:58', '2023-02-16 02:32:15'),
(218, 'user_info_update_subject', 'User Info Update Email', '2023-02-18 04:51:23', '2023-02-18 05:10:03'),
(219, 'user_info_update_message', '<p>Hello @name,\r\n</p><p>Your information successfully updated</p><p>Username: @username</p><p> Email: @email</p><p>\r\n</p>', '2023-02-18 04:51:23', '2023-02-18 05:10:03'),
(220, 'user_identity_verify_confirm_subject', 'User Identity Verify Confirm', '2023-02-20 01:38:44', '2023-02-20 01:38:44'),
(221, 'user_identity_verify_confirm_message', '<p>Hello @name,\r\n</p><p>Your identity verification successfully done. Now you are a verified user.\r\n</p><p>Username: @username\r\n</p><p>Email: @email</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>', '2023-02-20 01:38:45', '2023-02-20 01:38:45'),
(222, 'user_identity_re_verify_subject', 'User Identity Reverification', '2023-02-20 02:10:13', '2023-02-20 02:10:13'),
(223, 'user_identity_re_verify_message', '<p>Hello @name,\r\n</p><p>Your identity need to reverification for the following reasons.</p><ul><li>Face issue</li><li>ID issue</li></ul><p>Username: @username\r\n</p><p>Email: @email</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>', '2023-02-20 02:10:13', '2023-02-20 02:10:13'),
(224, 'user_identity_decline_subject', 'User Identity Decline', '2023-02-20 03:17:50', '2023-02-20 03:36:03'),
(225, 'user_identity_decline_message', '<p>Hello @name,\r\n</p><p>Your identity verification request decline for the bellow reasons</p><ul><li>&nbsp;image not si,ilar</li><li>number not match</li><li>email not match</li></ul><p>Username: @username\r\n</p><p>Email: @email</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>', '2023-02-20 03:17:50', '2023-02-20 03:36:03'),
(226, 'user_password_change_subject', 'User Password Change Email', '2023-02-21 22:53:34', '2023-02-21 22:56:21'),
(227, 'user_password_change_message', '<p>Hello @name,\r\n</p><p>Your password has been changed.\r\n</p><p>New password : @password</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>', '2023-02-21 22:53:34', '2023-02-21 22:56:21'),
(228, 'user_status_active_subject', 'User Status Activate Email', '2023-02-22 03:18:43', '2023-02-22 03:18:43'),
(229, 'user_status_active_message', '<p>Hello @name,\r\n</p><p>Your account status has been changed from inactive to active.</p><p>\r\n</p>', '2023-02-22 03:18:43', '2023-02-22 03:18:43'),
(230, 'user_status_inactive_subject', 'User Status Inactivate Email', '2023-02-22 03:22:20', '2023-02-22 03:22:20'),
(231, 'user_status_inactive_message', '<p>Hello @name,\r\n</p><p>Your account status has been changed from active to inactive due to multiple violations of our community guidelines.</p><ul><li>test text</li><li>test text</li><li>test text</li><li>test text</li></ul><p>\r\n</p>', '2023-02-22 03:22:20', '2023-02-22 03:22:20'),
(232, 'user_register_subject', 'New User Register Email', '2023-02-23 06:36:57', '2024-01-30 00:13:15'),
(233, 'user_register_message', '<p>Hello Admin,\r\n</p><p>New user just registered. Bello is the user details.</p><p><br></p><p>Name : @name</p><p>Email: @email</p><p>Username: @username</p><p>User Type: @userType</p><p>\r\n</p><p>\r\n</p>', '2023-02-23 06:36:57', '2024-01-30 00:13:15'),
(234, 'site_global_currency', 'USD', '2023-03-06 06:48:47', '2025-04-30 02:32:24'),
(235, 'enable_disable_decimal_point', 'enable', '2023-03-06 07:51:22', '2025-04-30 02:32:24'),
(236, 'site_currency_symbol_position', 'left', '2023-03-06 07:51:22', '2025-04-30 02:32:24'),
(237, 'site_default_payment_gateway', 'stripe', '2023-03-06 07:51:22', '2025-04-30 02:32:24'),
(238, 'site_usd_to_idr_exchange_rate', '100', '2023-03-06 07:51:22', '2025-04-30 02:32:24'),
(239, 'site_usd_to_inr_exchange_rate', '100', '2023-03-06 07:51:22', '2025-04-30 02:32:24'),
(240, 'site_usd_to_ngn_exchange_rate', '100', '2023-03-06 07:51:22', '2025-04-30 02:32:24'),
(241, 'site_usd_to_zar_exchange_rate', '100', '2023-03-06 07:51:22', '2025-04-30 02:32:24'),
(242, 'site_usd_to_brl_exchange_rate', '100', '2023-03-06 07:51:22', '2025-04-30 02:32:24'),
(243, 'site_usd_to_myr_exchange_rate', '100', '2023-03-06 07:51:22', '2025-04-30 02:32:24'),
(244, '_2fa_disable_subject', 'Disable 2FA Email', '2023-03-25 00:36:36', '2023-03-25 00:36:36'),
(245, '_2fa_disable_message', '<p>Hello @name,<br><br>2 factor authentication successfully disable from your account.<br></p>', '2023-03-25 00:36:36', '2023-03-25 00:36:36'),
(246, 'user_email_verified_subject', 'User Email Verify', '2023-03-25 01:12:29', '2023-03-25 02:22:42'),
(247, 'user_email_verified_message', '<p>Hello @name,<br><br>Your email address successfully verified.<br></p>', '2023-03-25 01:12:29', '2023-03-25 02:22:42'),
(248, 'project_create_email_subject', 'Project Create Email', '2023-03-25 03:12:40', '2023-03-25 03:12:40'),
(249, 'project_create_email_message', '<p>Hello,<br><br>A new project is just created. Project ID: @project_id<br></p>', '2023-03-25 03:12:40', '2023-03-25 03:12:40'),
(250, 'project_approve_email_subject', 'Project Activate Email', '2023-03-25 03:41:43', '2023-03-28 02:12:13'),
(251, 'project_approve_email_message', '<p>Hello @name,<br><br>Your project successfully activate. Project ID: @project_id<br></p>', '2023-03-25 03:41:43', '2023-03-28 02:12:13'),
(252, 'project_decline_email_subject', 'Project Reject Email', '2023-03-25 03:50:42', '2023-03-28 02:27:42'),
(253, 'project_decline_email_message', '<p>Hello @name,<br><br>Your project has been rejected. Project ID: @project_id<br></p>', '2023-03-25 03:50:42', '2023-03-28 02:27:42'),
(254, 'project_edit_email_subject', 'Project Edit Email', '2023-03-26 21:55:46', '2023-03-26 21:55:46'),
(255, 'project_edit_email_message', '<p>Hello,\r\n</p><p>A project is just edited. Project ID: @project_id</p><p>\r\n</p>', '2023-03-26 21:55:46', '2023-03-26 21:55:46'),
(256, 'project_inactivate_email_subject', 'Project Inactivate Email', '2023-03-28 01:12:45', '2023-03-28 02:00:19'),
(257, 'project_inactivate_email_message', '<p>Hello @name,\r\n</p><p>Your project inactivate for the bellow reasons..... Project ID: @project_id</p><p>\r\n</p>', '2023-03-28 01:12:45', '2023-03-28 02:00:19'),
(258, 'login_page_title', 'Login to continue', '2023-03-29 23:49:12', '2025-07-19 07:38:01'),
(259, 'login_page_button_title', 'Sign In Now', '2023-03-29 23:49:12', '2025-07-19 07:38:01'),
(260, 'login_page_sidebar_title', 'Influencer Marketplace', '2023-03-29 23:49:12', '2025-07-19 07:38:01'),
(261, 'login_page_sidebar_description', 'Welcome, to influencer marketplace. Here you can build a awesome career. Be a influencer or you can post your job.', '2023-03-29 23:49:12', '2025-07-19 07:38:01'),
(262, 'login_page_social_login_enable_disable', 'on', '2023-03-29 23:49:12', '2025-07-19 07:38:01'),
(263, 'login_page_sidebar_image', '431', '2023-03-30 00:26:39', '2025-07-19 07:38:01'),
(264, 'register_page_title', 'Register', '2023-03-30 01:27:49', '2025-07-19 07:42:13'),
(265, 'register_page_button_title', 'Register Now', '2023-03-30 01:27:49', '2025-07-19 07:42:13'),
(266, 'register_page_sidebar_title', 'The Creator Marketplace', '2023-03-30 01:27:49', '2025-07-19 07:42:13'),
(267, 'register_page_sidebar_description', 'Influencer is a marketplace where you can buy or sell digital creative services. The platform helps individual influencers, photographers, writers, and musicians collaborate and transact with marketers. Creatives list projects on the site and Marketers buy creative deals through a streamlined chat experience.', '2023-03-30 01:27:49', '2025-07-19 07:42:13'),
(268, 'register_page_social_login_enable_disable', NULL, '2023-03-30 01:27:49', '2025-07-19 07:42:13'),
(269, 'register_page_sidebar_image', '26', '2023-03-30 01:27:49', '2024-10-23 23:24:55'),
(270, 'site_white_logo', '454', '2023-04-02 22:55:28', '2025-07-17 03:44:52'),
(271, 'manual_payment_preview_logo', '241', '2023-04-05 03:06:03', '2025-07-02 04:05:30'),
(272, 'site_manual_payment_name', 'Bank  Transfer', '2023-04-05 03:06:03', '2023-04-12 21:34:36'),
(273, 'manual_payment_test_mode', NULL, '2023-04-05 03:06:03', '2025-07-02 04:05:30'),
(274, 'user_deposit_to_wallet_subject', 'User Deposit Email', '2023-04-06 01:30:36', '2023-04-06 01:42:47'),
(275, 'user_deposit_to_wallet_message', '<p>Hello @name,<br><br>Your deposit to wallet successfully completed. Deposit ID: @deposit_id<br></p>', '2023-04-06 01:30:36', '2023-04-06 01:42:47'),
(276, 'user_deposit_to_wallet_subject_admin', 'User Deposit Email', '2023-04-06 01:31:53', '2023-04-06 01:42:41'),
(277, 'user_deposit_to_wallet_message_admin', '<p>Hello,<br></p><p>A user deposit to his wallet. Deposit ID: @deposit_id<br></p>', '2023-04-06 01:31:53', '2023-04-06 01:42:41'),
(278, 'deposit_amount_limitation_for_user', '500', '2023-04-08 23:01:49', '2024-04-04 00:33:31'),
(279, 'razorpay_test_mode', 'on', '2023-04-09 23:51:10', '2025-07-02 04:05:29'),
(280, 'stripe_test_mode', 'on', '2023-04-09 23:51:10', '2025-07-02 04:05:29'),
(281, 'paystack_test_mode', 'on', '2023-04-09 23:51:11', '2025-07-02 04:05:29'),
(282, 'mollie_test_mode', 'on', '2023-04-09 23:51:11', '2025-07-02 04:05:29'),
(283, 'flutterwave_test_mode', 'on', '2023-04-09 23:51:11', '2025-07-02 04:05:29'),
(284, 'payfast_test_mode', 'on', '2023-04-09 23:51:12', '2025-07-02 04:05:29'),
(285, 'marcadopago_client_id', 'TEST-0a3cc78a-57bf-4556-9dbe-2afa06347769', '2023-04-10 21:46:19', '2025-07-02 04:05:29'),
(286, 'marcadopago_client_secret', 'TEST-4644184554273630-070813-7d817e2ca1576e75884001d0755f8a7a-786499991', '2023-04-10 21:46:19', '2025-07-02 04:05:29'),
(287, 'toyyibpay_secrect_key', 'wnbtrqle-9t9l-m02j-e2bz-iaj2tkp52sfo', '2023-04-11 03:10:15', '2025-07-02 04:05:29'),
(288, 'toyyibpay_category_code', '0m0j9yc4', '2023-04-11 03:10:15', '2025-07-02 04:05:29'),
(289, 'toyyibpay_preview_logo', '393', '2023-04-11 03:10:15', '2025-07-02 04:05:29'),
(290, 'toyyibpay_gateway', 'on', '2023-04-11 03:10:15', '2025-07-02 04:05:29'),
(291, 'toyyibpay_test_mode', 'on', '2023-04-11 03:10:15', '2025-07-02 04:05:29'),
(292, 'pagali_page_id', NULL, '2023-04-11 03:53:41', '2025-07-02 04:05:29'),
(293, 'pagali_entity_id', NULL, '2023-04-11 03:53:41', '2025-07-02 04:05:29'),
(294, 'pagali_preview_logo', '237', '2023-04-11 03:53:41', '2025-07-02 04:05:29'),
(295, 'pagali_gateway', 'on', '2023-04-11 03:53:41', '2025-07-02 04:05:29'),
(296, 'pagali_test_mode', 'on', '2023-04-11 03:53:41', '2025-07-02 04:05:29'),
(297, 'authorize_dot_net_login_id', '2e8yjNL89kV2', '2023-04-11 22:24:12', '2025-07-02 04:05:29'),
(298, 'authorize_dot_net_transaction_id', '65968Gb3DU2ntX2v', '2023-04-11 22:24:12', '2025-07-02 04:05:29'),
(299, 'authorize_dot_net_preview_logo', '248', '2023-04-11 22:24:12', '2025-07-02 04:05:29'),
(300, 'authorize_dot_net_gateway', 'on', '2023-04-11 22:24:12', '2025-07-02 04:05:29'),
(301, 'authorize_dot_net_test_mode', 'on', '2023-04-11 22:24:12', '2025-07-02 04:05:29'),
(302, 'sitesway_brand_id', NULL, '2023-04-11 23:13:38', '2025-07-02 04:05:29'),
(303, 'sitesway_api_key', NULL, '2023-04-11 23:13:38', '2025-07-02 04:05:30'),
(304, 'sitesway_preview_logo', '250', '2023-04-11 23:13:38', '2025-07-02 04:05:30'),
(305, 'sitesway_gateway', NULL, '2023-04-11 23:13:38', '2025-07-02 04:05:30'),
(306, 'sitesway_test_mode', 'on', '2023-04-11 23:13:38', '2025-07-02 04:05:30'),
(307, 'manual_payment_gateway', NULL, '2023-04-12 22:12:04', '2025-07-02 04:05:30'),
(308, 'job_create_email_subject', 'Campaign Create Email', '2023-04-17 01:14:00', '2025-04-28 23:17:44'),
(309, 'job_create_email_message', '<p>Hello,</p><p><br></p><p>\r\n</p><p>A new campaign is just created. Campaign ID: @campaign_id</p><p>\r\n</p>', '2023-04-17 01:14:00', '2025-04-28 23:17:44'),
(310, 'job_edit_email_subject', 'Campaign Edit Email', '2023-04-17 01:42:31', '2025-04-28 23:17:32'),
(311, 'job_edit_email_message', '<p>Hello,</p><p>\r\n</p><p>A campaign is just edited. Campaign ID: @campaign_id</p><p>\r\n</p>', '2023-04-17 01:42:31', '2025-04-28 23:17:32'),
(312, 'job_approve_email_subject', 'Campaign Activate Email', '2023-04-17 02:02:00', '2025-04-28 23:17:12'),
(313, 'job_approve_email_message', '<p>Hello @name,</p><p><br></p><p>\r\n</p><p>Your campaign successfully activate. Campaign ID: @campaign_id</p><p>\r\n</p>', '2023-04-17 02:02:00', '2025-04-28 23:17:12'),
(314, 'job_inactivate_email_subject', 'Campaign Inactivate Email', '2023-04-17 02:09:25', '2025-04-28 23:16:46'),
(315, 'job_inactivate_email_message', '<p>Hello @name,\r\n</p><p>Your campaign inactivate for the bellow reasons..... Campaign ID: @campaign_id</p><p>\r\n</p>', '2023-04-17 02:09:25', '2025-04-28 23:16:46'),
(316, 'job_decline_email_subject', 'Campaign Decline Email', '2023-04-17 02:13:15', '2025-04-28 23:38:55'),
(317, 'job_decline_email_message', '<p>Hello @name,\r\n</p><p>Your campaign has been rejected. Campaign ID: @campaign_id</p><p>\r\n</p>', '2023-04-17 02:13:15', '2025-04-28 23:38:55'),
(318, 'site_tag_line', 'Freelance Services Marketplace', '2023-05-09 01:09:04', '2025-07-24 01:10:37'),
(319, 'home_page', '12', '2023-05-10 00:53:34', '2024-05-12 23:06:03'),
(320, 'user_subscription_purchase_subject', 'User Subscription Purchase Email', '2023-06-22 05:44:20', '2024-02-09 22:53:03'),
(321, 'user_subscription_purchase_message', '<p>Hello @name</p><p><br></p><p>Your subscription purchase successfully completed. Subscription ID: @subscription_id</p>', '2023-06-22 05:44:20', '2024-02-09 22:53:03'),
(322, 'user_subscription_purchase_admin_email_subject', 'User Subscription Purchase Email', '2023-06-22 05:46:20', '2024-02-09 22:53:06'),
(323, 'user_subscription_purchase_admin_email_message', '<p>Hello Admin</p><p><br></p><p>A user just purchase a subscription. Subscription ID: @subscription_id</p>', '2023-06-22 05:46:20', '2024-02-09 22:53:06'),
(324, 'limit_settings', '2', '2023-06-24 01:29:25', '2023-07-06 04:01:20'),
(325, 'manual_subscription_complete_subject', 'Subscription Manual Payment Complete', '2023-06-26 01:16:35', '2024-02-10 00:49:37'),
(326, 'manual_subscription_complete_message', '<p>Hello @name,\r\n</p><p><br></p><p>Your manual subscription payment status successfully changed from pending to complete. Subscription ID: @subscription_id</p><p>\r\n</p>', '2023-06-26 01:16:35', '2024-02-10 00:49:37'),
(327, 'manual_subscription_pending_subject', 'Subscription Manual Payment Pending Email', '2023-06-26 01:17:48', '2023-06-26 01:17:48'),
(328, 'manual_subscription_pending_message', '<p>Hello @name,\r\n</p><p>Your manual subscription payment status changed from complete to pending. Subscription ID: @subscription_id</p><p>\r\n</p>', '2023-06-26 01:17:48', '2023-06-26 01:17:48'),
(329, 'manual_subscription_complete_subject_to_admin', 'Subscription Manual Payment Complete', '2023-07-04 03:59:45', '2024-02-10 00:48:48'),
(330, 'manual_subscription_complete_message_to_admin', '<p>Hello admin,\r\n</p><p><br></p><p>A manual subscription payment status successfully changed from pending to complete. Subscription ID: @subscription_id</p><p>\r\n</p><p>\r\n</p>', '2023-07-04 03:59:46', '2024-02-10 00:48:48'),
(331, 'subscription_active_subject', 'Subscription Active', '2023-07-04 05:28:01', '2023-07-04 05:28:42'),
(332, 'subscription_active_message', '<p>Hello @name,\r\n</p><p>Your subscription status changed from inactive to active. Subscription ID: @subscription_id</p><p>\r\n</p>', '2023-07-04 05:28:01', '2023-07-04 05:28:42'),
(333, 'subscription_inactive_subject', 'Subscription Inactive', '2023-07-04 05:29:31', '2023-07-04 05:29:31'),
(334, 'subscription_inactive_message', '<p>Hello @name,\r\n</p><p>Your subscription status changed from active to inactive. Subscription ID: @subscription_id</p><p>\r\n</p>', '2023-07-04 05:29:31', '2023-07-04 05:29:31'),
(353, 'admin_commission_type', 'percentage', '2023-07-11 01:37:44', '2023-07-11 01:37:44'),
(354, 'admin_commission_charge', '21', '2023-07-11 01:37:44', '2023-07-11 01:37:44'),
(359, 'transaction_fee_type', 'percentage', '2023-07-12 01:19:22', '2025-07-14 03:55:05'),
(360, 'transaction_fee_charge', '10', '2023-07-12 01:19:22', '2025-07-14 03:55:05'),
(361, 'order_hold_subject', 'Hold Order', '2023-08-22 00:39:06', '2023-08-22 06:48:43'),
(362, 'order_hold_message', '<p>Hello @name,</p><p><br></p><p>Your order has been hold .... contact with support team</p><p><br></p><p>Order Id: #@order_id</p>', '2023-08-22 00:39:06', '2023-08-22 06:48:43'),
(363, 'order_unhold_subject', 'Unhold Order', '2023-08-22 00:40:04', '2023-08-22 01:24:20'),
(364, 'order_unhold_message', '<p>Hello @name;\r\n</p><p>Your order has been Unhold ....</p><p><br></p><p>Order Id: #@order_id</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>', '2023-08-22 00:40:04', '2023-08-22 01:24:21'),
(365, 'account_active_subject', 'Account Active', '2023-08-22 03:55:06', '2023-08-22 06:48:19'),
(366, 'account_active_message', '<p>Hello @name,</p><p><br></p><p>Your account has been active......</p>', '2023-08-22 03:55:06', '2023-08-22 06:48:19'),
(367, 'account_suspend_subject', 'Account Suspend', '2023-08-22 03:55:23', '2023-08-22 06:48:24'),
(368, 'account_suspend_message', '<p>Hello @name,</p><p><br></p><p>Your account has been suspended......</p>', '2023-08-22 03:55:23', '2023-08-22 06:48:24'),
(369, 'account_unsuspend_subject', 'Account Active', '2023-08-24 04:10:00', '2023-08-24 04:10:00'),
(370, 'account_unsuspend_message', '<p>Hello @name,\r\n</p><p>Your account has been unsuspend form suspend......</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>', '2023-08-24 04:10:00', '2023-08-24 04:10:00'),
(371, 'order_manual_payment_complete_subject', 'Order Manual Payment Complete', '2023-08-24 07:30:11', '2023-08-24 07:30:11'),
(372, 'order_manual_payment_complete_message', '<p>Hello @name,</p><p><br></p><p>\r\n</p><p>Your order payment has been updated from pending to complete.</p><p><br></p><p>\r\n</p><p>Order Id: #@order_id</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>', '2023-08-24 07:30:11', '2023-08-24 07:30:11'),
(373, 'support_ticket_subject', 'Support Ticket', '2023-08-27 06:59:20', '2023-08-27 07:08:12'),
(374, 'support_ticket_message', '<p>Hello @name,</p><p><br></p><p>You have a new ticket</p><p><br></p><p>Ticket ID: #@ticket_id</p>', '2023-08-27 06:59:20', '2023-08-27 07:08:12'),
(375, 'support_ticket_message_email_subject', 'Support Ticket Message Email', '2023-08-29 04:57:15', '2023-08-29 04:57:15'),
(376, 'support_ticket_message_email_message', '<p>Hello @name,</p><p><br></p><p>You have a new message for the bellow ticket</p><p><br></p><p>Ticket ID : #@ticket_id</p>', '2023-08-29 04:57:15', '2023-08-29 04:57:15'),
(377, 'job_auto_approval', 'yes', '2023-09-20 05:50:29', '2023-12-03 01:11:41'),
(378, 'withdraw_amount_limitation_for_user', '50', '2023-10-15 05:09:35', '2023-10-15 05:09:35'),
(379, 'minimum_withdraw_amount', '50', '2023-10-15 05:28:40', '2023-10-17 03:47:28'),
(380, 'maximum_withdraw_amount', '500', '2023-10-15 05:28:40', '2023-10-17 03:47:28'),
(381, 'withdraw_fee', '6', '2023-10-16 23:47:35', '2024-02-15 05:11:22'),
(382, 'register_subscription', '10', '2023-11-06 04:35:25', '2023-11-06 04:35:25'),
(383, 'order_auto_approval', '3', '2023-11-12 00:48:20', '2023-11-12 01:02:38'),
(384, 'main_color_one', '#FF5B6B', '2023-11-14 09:43:54', '2025-07-14 04:10:36'),
(385, 'main_color_two', '#2bdfff', '2023-11-14 09:43:54', '2025-07-14 04:10:36'),
(386, 'secondary_color', '#ffa500', '2023-11-14 09:43:54', '2025-07-14 04:10:36'),
(387, 'paragraph_color', '#5a5e60', '2023-11-14 09:43:54', '2025-07-14 04:10:36'),
(388, 'body_color', '#5a5e60', '2023-11-14 22:58:12', '2025-07-14 04:10:36'),
(389, 'site_script_version', '1.1.0', '2023-11-14 22:58:12', '2023-12-21 04:01:05'),
(390, 'pusher_app_id', '1604228', '2023-11-23 04:15:18', '2023-11-23 04:15:18'),
(391, 'pusher_app_key', 'e07d3579c61106775c6b', '2023-11-23 04:15:18', '2023-11-23 04:15:18'),
(392, 'pusher_app_secret', 'e01f77e48c08ca689b76', '2023-11-23 04:15:18', '2023-11-23 04:15:18'),
(393, 'pusher_app_cluster', 'ap1', '2023-11-23 04:15:18', '2023-11-23 04:15:18'),
(394, 'license_product_uuid', 'bd972f30bc7af2f42f667e2682db42207f62d81f', '2023-12-04 05:43:33', '2023-12-21 03:34:13'),
(395, 'site_license_key', '5FD0-F256-63B6-9DF6-0681', '2023-12-04 05:43:33', '2023-12-21 03:34:22'),
(396, 'license_purchase_code', 'ba4c54a6-4725-47e4-b0bc-802a52e3b8dd', '2023-12-04 05:43:34', '2023-12-21 03:34:13'),
(397, 'license_email', 'aymanshaltut@gmail.com', '2023-12-04 05:43:34', '2023-12-21 03:34:13'),
(398, 'license_username', 'dmiytiiym', '2023-12-04 05:43:34', '2023-12-21 03:34:13'),
(399, 'site_manual_payment_description', '<p><br></p>', '2023-12-10 22:43:41', '2025-07-02 04:05:30'),
(400, 'page_loader', 'disable', '2023-12-13 23:39:15', '2024-01-08 01:01:29'),
(401, 'mouse_pointer', 'disable', '2023-12-13 23:52:13', '2023-12-13 23:57:30'),
(402, 'item_license_status', 'verified', '2023-12-18 23:42:21', '2023-12-21 03:34:22'),
(403, 'item_license_msg', 'License is Activated!', '2023-12-18 23:42:21', '2023-12-21 03:34:22'),
(404, 'section_font_family', 'Urbanist', '2023-12-26 07:30:35', '2025-07-03 00:42:04'),
(405, 'section_font_variant', 'a:9:{i:0;s:5:\"0,100\";i:1;s:5:\"0,200\";i:2;s:5:\"0,300\";i:3;s:5:\"0,400\";i:4;s:5:\"0,500\";i:5;s:5:\"0,600\";i:6;s:5:\"0,700\";i:7;s:5:\"0,800\";i:8;s:5:\"0,900\";}', '2023-12-26 07:51:49', '2025-07-03 00:42:04'),
(406, 'iyzipay_secret_key', 'sandbox-QsgXTUpizlCZzHaypMJwkL8YTMGsYMBM', '2023-12-27 01:27:05', '2025-07-02 04:05:30'),
(407, 'iyzipay_api_key', 'sandbox-wtyih1LNnlN1FtCei29rVjbZRKfqVeUC', '2023-12-27 01:27:05', '2025-07-02 04:05:30'),
(408, 'iyzipay_preview_logo', '391', '2023-12-27 01:27:05', '2025-07-02 04:05:30'),
(409, 'iyzipay_gateway', 'on', '2023-12-27 01:27:05', '2025-07-02 04:05:30'),
(410, 'iyzipay_test_mode', 'on', '2023-12-27 01:27:05', '2025-07-02 04:05:30'),
(411, 'bottom_to_top', 'enable', '2023-12-31 04:09:51', '2023-12-31 04:11:29'),
(412, 'sticky_menu', 'enable', '2024-01-09 02:00:48', '2025-05-04 06:15:49'),
(413, 'project_enable_disable', 'enable', '2024-01-10 03:39:51', '2024-06-26 07:57:45'),
(414, 'job_enable_disable', 'enable', '2024-01-11 02:52:49', '2024-06-26 07:14:26'),
(415, 'register_page_choose_role_title', 'Identify as an Influencer or Brand', '2024-01-17 23:28:22', '2025-07-19 07:42:13'),
(416, 'register_page_choose_role_subtitle', 'Choose a identity from below to continue signing up', '2024-01-17 23:28:22', '2025-07-19 07:42:13'),
(417, 'register_page_choose_join_freelancer_title', 'I\'m an influencer or creator', '2024-01-17 23:28:22', '2025-07-19 07:42:13'),
(418, 'register_page_choose_join_client_title', 'I\'m a buyer, brand or company', '2024-01-17 23:28:22', '2025-07-19 07:42:13'),
(419, 'register_page_continue_button_title', 'Continue', '2024-01-17 23:28:22', '2025-07-19 07:42:13'),
(420, 'google_analytics_gt4_ID', 'sd sdf sdf asdasd asd', '2024-01-20 04:32:42', '2024-01-27 05:05:55'),
(421, 'google_tag_manager_ID', 'sdf sdf sf', '2024-01-20 04:34:04', '2024-01-20 04:34:04'),
(422, 'facebook_pixels_id', 'dfg dfg d dfgdf dfg dfg dfg dfg', '2024-01-20 04:34:20', '2024-01-20 04:34:20'),
(423, 'instagram_access_token', 'zxc zxc zxc', '2024-01-20 04:34:50', '2024-01-20 04:34:50'),
(424, 'google_analytics_gt4_status', 'on', '2024-01-20 04:48:13', '2024-01-27 05:15:22'),
(425, 'google_tag_manager_status', 'off', '2024-01-20 04:57:25', '2024-01-30 07:43:37'),
(426, 'captcha_status', 'off', '2024-01-20 05:06:50', '2025-05-02 06:26:54'),
(427, 'adroll_pixels_status', 'off', '2024-01-20 05:45:33', '2024-01-20 05:45:40'),
(428, 'site_currency_thousand_separator', ',', '2024-01-20 23:44:28', '2025-04-30 02:32:24'),
(429, 'site_currency_decimal_separator', '.', '2024-01-20 23:44:28', '2025-04-30 02:32:24'),
(430, 'enable_disable_decimal_point ?? \"\" ', NULL, '2024-01-21 00:39:28', '2024-01-23 00:06:40'),
(431, 'site_currency_symbol_position ?? \"\" ', NULL, '2024-01-21 00:39:28', '2024-01-23 00:06:41'),
(432, 'site_kes_to_idr_exchange_rate', '12386', '2024-01-23 04:57:28', '2024-01-23 05:12:57'),
(433, 'site_kes_to_inr_exchange_rate', '123', '2024-01-23 04:57:28', '2024-01-23 05:12:57'),
(434, 'site_kes_to_ngn_exchange_rate', '123', '2024-01-23 04:57:28', '2024-01-23 05:12:57'),
(435, 'site_kes_to_zar_exchange_rate', '12300', '2024-01-23 04:57:28', '2024-01-23 05:12:57'),
(436, 'site_kes_to_brl_exchange_rate', '12300', '2024-01-23 04:57:28', '2024-01-23 05:12:57'),
(437, 'site_kes_to_myr_exchange_rate', '12300', '2024-01-23 04:57:28', '2024-01-23 05:12:57'),
(438, 'site_eur_to_idr_exchange_rate', NULL, '2024-01-23 05:15:59', '2024-07-28 22:27:17'),
(439, 'site_eur_to_inr_exchange_rate', NULL, '2024-01-23 05:15:59', '2024-07-28 22:27:17'),
(440, 'site_eur_to_ngn_exchange_rate', NULL, '2024-01-23 05:15:59', '2024-07-28 22:27:17'),
(441, 'site_eur_to_zar_exchange_rate', NULL, '2024-01-23 05:15:59', '2024-07-28 22:27:17'),
(442, 'site_eur_to_brl_exchange_rate', NULL, '2024-01-23 05:15:59', '2024-07-28 22:27:17'),
(443, 'site_eur_to_myr_exchange_rate', NULL, '2024-01-23 05:15:59', '2024-07-28 22:27:17'),
(444, 'site_eur_to_usd_exchange_rate', NULL, '2024-01-23 05:18:05', '2024-07-28 22:27:17'),
(445, 'site_usd_to_usd_exchange_rate', '100', '2024-01-23 05:18:13', '2025-04-30 02:32:24'),
(446, 'home_page_animation', 'disable', '2024-01-23 06:53:04', '2024-01-24 05:53:28'),
(447, 'manual_payment_gateway_name', 'Bank Transfer', '2024-01-27 03:47:50', '2025-07-02 04:05:30'),
(448, 'user_register_welcome_subject', 'User Register Welcome Email', '2024-01-29 23:40:31', '2024-09-02 07:25:47'),
(449, 'user_register_welcome_message', '<p>Hello @name,\r\n</p><p>Your registration successfully completed. Below is your account details.</p><p><br></p><p>\r\n</p><p>Name : @name\r\n</p><p>Email: @email\r\n</p><p>Username: @username\r\n</p><p>User Type: @userType</p>', '2024-01-29 23:40:31', '2024-09-02 07:25:47'),
(450, 'promote_transaction_fee_type', 'percentage', '2024-02-03 01:51:32', '2024-02-03 01:51:32'),
(451, 'promote_transaction_fee_charge', '2', '2024-02-03 01:51:32', '2024-02-03 01:51:32'),
(452, 'user_promote_package_purchase_subject_admin', 'Promote Package Purchase Email to Admin', '2024-02-09 23:50:26', '2024-02-09 23:50:26'),
(453, 'user_promote_package_purchase_message_admin', '<p>Hello Admin </p><p><br></p><p>A user just buy a promotion package. Package ID: @package_id<br></p>', '2024-02-09 23:50:26', '2024-02-09 23:50:26'),
(454, 'user_promote_package_purchase_subject', 'Promote Package Purchase Email to User', '2024-02-09 23:51:24', '2024-02-09 23:51:24'),
(455, 'user_promote_package_purchase_message', '<p>Hello @name<br><br>Your promotion package purchase successfully completed. Package ID: @package_id<br></p>', '2024-02-09 23:51:24', '2024-02-09 23:51:24'),
(456, 'user_promote_package_manual_payment_complete_subject', 'Promotion Package Purchase Manual Payment Complete Email To User', '2024-02-10 00:51:14', '2024-02-12 02:04:52'),
(457, 'user_promote_package_manual_payment_complete_message', '<p>Hello @name</p><p><br></p>Your manual promotion package purchase payment status successfully changed from pending to complete. Promotion ID: @promotion_id<br>', '2024-02-10 00:51:14', '2024-02-12 02:04:52'),
(458, 'withdraw_fee_type', 'percentage', '2024-02-15 03:36:55', '2024-02-15 05:11:22'),
(459, 'payment_failed_order_enable_disable', 'disable', '2024-02-15 07:26:29', '2024-02-15 07:30:49'),
(460, 'toc_page_link', 'terms-conditions', '2024-02-17 03:52:20', '2025-07-19 07:42:13'),
(461, 'privacy_policy_link', 'privacy-policy', '2024-02-17 03:52:20', '2025-07-19 07:42:13'),
(462, 'project_auto_approval', 'no', '2024-03-03 05:36:38', '2024-03-03 07:23:57'),
(463, 'site_inr_to_usd_exchange_rate', NULL, '2024-03-04 08:04:19', '2024-08-26 01:59:44'),
(464, 'site_inr_to_idr_exchange_rate', NULL, '2024-03-04 08:04:19', '2024-08-26 01:59:44'),
(465, 'site_inr_to_inr_exchange_rate', NULL, '2024-03-04 08:04:19', '2024-08-26 01:59:44'),
(466, 'site_inr_to_ngn_exchange_rate', NULL, '2024-03-04 08:04:19', '2024-08-26 01:59:44'),
(467, 'site_inr_to_zar_exchange_rate', NULL, '2024-03-04 08:04:19', '2024-08-26 01:59:44'),
(468, 'site_inr_to_brl_exchange_rate', NULL, '2024-03-04 08:04:19', '2024-08-26 01:59:44'),
(469, 'site_inr_to_myr_exchange_rate', NULL, '2024-03-04 08:04:19', '2024-08-26 01:59:44'),
(470, 'firebase_server_key', 'BBGKs999iXM-PDCn-h9R4flHDBuTr5-qzCalctsDQ-LSxB0ijIx7-M8Zd3rEef0TLiILYQE9iLyMMd38urk9JtQ', '2024-03-06 02:14:34', '2024-08-03 00:43:59'),
(471, 'social_login_enable_disable', NULL, '2024-03-06 06:18:23', '2025-07-24 01:10:37'),
(472, 'commission_disable_client_panel', 'enable', '2024-03-07 03:29:29', '2024-03-07 03:30:19'),
(473, 'chat_email_enable_disable', 'enable', '2024-04-22 00:28:27', '2024-05-06 00:06:59'),
(474, 'profile_page_badge_settings', 'enable', '2024-05-22 01:38:40', '2024-05-22 02:10:10'),
(475, 'site_krw_to_usd_exchange_rate', NULL, '2024-06-02 05:37:26', '2024-06-02 05:39:58'),
(476, 'site_krw_to_idr_exchange_rate', NULL, '2024-06-02 05:37:26', '2024-06-02 05:39:58'),
(477, 'site_krw_to_inr_exchange_rate', NULL, '2024-06-02 05:37:26', '2024-06-02 05:39:58'),
(478, 'site_krw_to_ngn_exchange_rate', NULL, '2024-06-02 05:37:26', '2024-06-02 05:39:58'),
(479, 'site_krw_to_zar_exchange_rate', NULL, '2024-06-02 05:37:26', '2024-06-02 05:39:58'),
(480, 'site_krw_to_brl_exchange_rate', NULL, '2024-06-02 05:37:26', '2024-06-02 05:39:58'),
(481, 'site_krw_to_myr_exchange_rate', NULL, '2024-06-02 05:37:26', '2024-06-02 05:39:58'),
(482, 'subscription_enable_disable', 'enable', '2024-06-05 22:52:55', '2024-09-23 01:57:47'),
(483, 'recaptcha_site_key', '6LfsQoYrAAAAADtpnbuwqqLk5zeIcjLgWnpd1k_6', '2024-06-06 03:55:33', '2025-07-17 03:19:55'),
(484, 'recaptcha_secret_key', '6LfsQoYrAAAAAPUR6fta2HYOXkf0P2iqyUbqorrI', '2024-06-06 03:55:33', '2025-07-17 03:19:55'),
(485, 'client_withdraw_enable_disable', 'disable', '2024-06-25 03:52:03', '2024-06-25 04:58:22'),
(486, 'storage_driver', 'CustomUploader', '2024-06-30 04:51:31', '2024-08-31 00:30:08'),
(487, 'wasabi_access_key_id', '4BDTR0FTJ8BWR0JPPCB5', '2024-06-30 04:51:31', '2024-08-31 00:30:09'),
(488, 'wasabi_secret_access_key', '3zDIatXwm9pBzTOeRsd8dCQvzFHi6uVQAuOJHhz3', '2024-06-30 04:51:31', '2024-08-31 00:30:09'),
(489, 'wasabi_default_region', 'ap-northeast-1', '2024-06-30 04:51:31', '2024-08-31 00:30:09'),
(490, 'wasabi_bucket', 'xilancer', '2024-06-30 04:51:31', '2024-08-31 00:30:09'),
(491, 'wasabi_endpoint', 'https://s3.ap-northeast-1.wasabisys.com', '2024-06-30 04:51:31', '2024-08-31 00:30:09'),
(492, 'cloudflare_r2_access_key_id', 'd204b68d30ba058c615a0b1bba9e3386', '2024-06-30 04:51:31', '2024-08-31 00:30:09'),
(493, 'cloudflare_r2_secret_access_key', '75f9bd41bd09342c5da1dae5c2a00c46f9be85e995b72bd74571dff23e7dbbdd', '2024-06-30 04:51:31', '2024-08-31 00:30:09');
INSERT INTO `static_options` (`id`, `option_name`, `option_value`, `created_at`, `updated_at`) VALUES
(494, 'cloudflare_r2_bucket', 'test-multisas', '2024-06-30 04:51:31', '2024-08-31 00:30:09'),
(495, 'cloudflare_r2_url', 'r2.multipurposesass.com', '2024-06-30 04:51:31', '2024-08-31 00:30:09'),
(496, 'cloudflare_r2_endpoint', 'https://bfccd7d75ad97be0dfb82c6ff6236dad.r2.cloudflarestorage.com', '2024-06-30 04:51:31', '2024-08-31 00:30:09'),
(497, 'cloudflare_r2_use_path_style_endpoint', '0', '2024-06-30 04:51:31', '2024-08-31 00:30:09'),
(498, 'aws_access_key_id', 'sdfsdf', '2024-06-30 04:51:31', '2024-08-31 00:30:09'),
(499, 'aws_secret_access_key', 'sdf sdf', '2024-06-30 04:51:32', '2024-08-31 00:30:09'),
(500, 'aws_default_region', 'sdf sdf', '2024-06-30 04:51:32', '2024-08-31 00:30:09'),
(501, 'aws_bucket', 'sdf sdf', '2024-06-30 04:51:32', '2024-08-31 00:30:09'),
(502, 'aws_url', 'sdf sdf', '2024-06-30 04:51:32', '2024-08-31 00:30:09'),
(503, 'aws_endpoint', 'sdf sdf', '2024-06-30 04:51:32', '2024-08-31 00:30:09'),
(504, 'aws_use_path_style_endpoint', '0', '2024-06-30 04:51:32', '2024-08-31 00:30:09'),
(505, 'order_enable_disable_description_settings', 'enable', '2024-07-01 23:18:18', '2024-07-10 01:48:01'),
(506, 'order_enable_disable_milestone_settings', 'enable', '2024-07-01 23:18:48', '2024-07-10 01:48:13'),
(507, 'kineticpay_gateway', 'on', '2024-07-09 23:35:26', '2025-07-02 04:05:30'),
(508, 'kineticpay_test_mode', 'on', '2024-07-09 23:35:26', '2025-07-02 04:05:30'),
(509, 'kineticpay_merchant_key', 'ede1c5e9f81c9d12bf418629f56a7870', '2024-07-09 23:35:26', '2025-07-02 04:05:30'),
(510, 'kinetic_preview_logo', '193', '2024-07-09 23:35:26', '2024-07-10 00:01:11'),
(511, 'awdpay_gateway', 'on', '2024-07-09 23:35:26', '2025-07-02 04:05:30'),
(512, 'awdpay_test_mode', 'on', '2024-07-09 23:35:26', '2025-07-02 04:05:30'),
(513, 'awdpay_private_key', 'asda asdasd', '2024-07-09 23:35:26', '2025-07-02 04:05:30'),
(514, 'awdpay_preview_logo', '392', '2024-07-09 23:35:26', '2025-07-02 04:05:30'),
(515, 'awdpay_logo_url', 'https://www.awdpay.com/api/public/image-1649803735945-214296083.png', '2024-07-09 23:35:26', '2025-07-02 04:05:30'),
(516, 'kineticpay_preview_logo', '242', '2024-07-10 00:03:52', '2025-07-02 04:05:30'),
(517, 'site_myr_to_usd_exchange_rate', NULL, '2024-07-10 02:45:45', '2025-04-30 01:34:50'),
(518, 'site_myr_to_idr_exchange_rate', NULL, '2024-07-10 02:45:45', '2025-04-30 01:34:50'),
(519, 'site_myr_to_inr_exchange_rate', NULL, '2024-07-10 02:45:45', '2025-04-30 01:34:50'),
(520, 'site_myr_to_ngn_exchange_rate', NULL, '2024-07-10 02:45:45', '2025-04-30 01:34:50'),
(521, 'site_myr_to_zar_exchange_rate', NULL, '2024-07-10 02:45:45', '2025-04-30 01:34:50'),
(522, 'site_myr_to_brl_exchange_rate', NULL, '2024-07-10 02:45:45', '2025-04-30 01:34:50'),
(523, 'site_myr_to_myr_exchange_rate', NULL, '2024-07-10 02:45:45', '2025-04-30 01:34:50'),
(524, 'yoomoney_gateway', NULL, '2024-08-10 05:15:35', '2025-07-02 04:05:30'),
(525, 'yoomoney_test_mode', NULL, '2024-08-10 05:15:35', '2025-07-02 04:05:30'),
(526, 'yoomoney_preview_logo', NULL, '2024-08-10 05:15:35', '2025-07-02 04:05:30'),
(527, 'yoomoney_shop_id', NULL, '2024-08-10 05:15:35', '2025-07-02 04:05:30'),
(528, 'yoomoney_secret_key', NULL, '2024-08-10 05:15:35', '2025-07-02 04:05:30'),
(529, 'site_rub_to_usd_exchange_rate', '100', '2024-08-10 23:10:18', '2024-08-10 23:10:53'),
(530, 'site_rub_to_idr_exchange_rate', '100', '2024-08-10 23:10:18', '2024-08-10 23:10:53'),
(531, 'site_rub_to_inr_exchange_rate', '100', '2024-08-10 23:10:18', '2024-08-10 23:10:53'),
(532, 'site_rub_to_ngn_exchange_rate', '100', '2024-08-10 23:10:18', '2024-08-10 23:10:53'),
(533, 'site_rub_to_zar_exchange_rate', '10', '2024-08-10 23:10:18', '2024-08-10 23:10:53'),
(534, 'site_rub_to_brl_exchange_rate', '90', '2024-08-10 23:10:18', '2024-08-10 23:10:53'),
(535, 'site_rub_to_myr_exchange_rate', '90', '2024-08-10 23:10:18', '2024-08-10 23:10:53'),
(536, 'category_section_enable_disable', 'enable', '2024-08-13 06:43:57', '2024-08-13 06:44:49'),
(537, 'minimum_hour_for_realtime_earning', '1', '2024-08-21 23:52:52', '2024-08-21 23:54:23'),
(538, 'coinpayments_gateway', NULL, '2024-08-22 03:34:01', '2025-07-02 04:05:30'),
(539, 'coinpayments_test_mode', NULL, '2024-08-22 03:34:01', '2025-07-02 04:05:30'),
(540, 'coinpayments_preview_logo', NULL, '2024-08-22 03:34:01', '2025-07-02 04:05:30'),
(541, 'coinpayments_merchant', NULL, '2024-08-22 03:34:01', '2025-07-02 04:05:30'),
(542, 'coinpayments_ipn_pin', NULL, '2024-08-22 03:34:01', '2025-07-02 04:05:30'),
(543, 'coinpay_currency', '[\"USD\",\"LTCT\",\"ZEN\",\"BTC\"]', NULL, NULL),
(544, 'front_cdn_enable_disable', 'disable', '2024-08-30 23:41:37', '2024-08-31 00:02:05'),
(550, 'profile_switch_enable_disable', 'enable', '2024-10-03 07:26:15', '2024-10-03 07:27:49'),
(554, 'file_extensions', '[\"png\",\"jpg\",\"jpeg\",\"gif\",\"pdf\",\"doc\",\"docx\",\"txt\",\"ppt\",\"zip\"]', '2024-10-06 04:52:16', '2025-04-27 23:01:50'),
(555, 'max_upload_size', '10240', '2024-10-06 04:52:16', '2025-04-27 23:01:50'),
(556, 'language_menu_title', 'Languages', '2024-10-29 00:17:43', '2024-10-29 00:17:43'),
(557, 'language_menu_sub_title', 'Add  the necessary languages you know.', '2024-10-29 00:17:43', '2024-10-29 00:17:43'),
(558, 'language_title', 'Great! Now add some languages you have.', '2024-10-29 00:17:43', '2024-10-29 00:17:43'),
(559, 'location_menu_title', 'Location', '2024-10-29 00:44:33', '2024-10-29 01:10:03'),
(560, 'location_menu_sub_title', 'Set your location', '2024-10-29 00:44:33', '2024-10-29 01:10:03'),
(561, 'location_country_title', 'Choose your country', '2024-10-29 00:44:33', '2024-10-29 01:10:03'),
(562, 'location_state_title', 'Choose your state', '2024-10-29 00:44:33', '2024-10-29 01:10:03'),
(563, 'location_city_title', 'Choose your city', '2024-10-29 00:44:33', '2024-10-29 01:10:03'),
(564, 'social_menu_title', 'Social Profiles', '2024-10-29 00:55:24', '2024-10-29 00:56:19'),
(565, 'social_menu_sub_title', 'Let clients know about your social profiles.', '2024-10-29 00:55:24', '2024-10-29 00:56:19'),
(566, 'social_title', 'Tell us about your social profiles.', '2024-10-29 00:55:24', '2024-10-29 00:56:19'),
(567, 'social_inner_title', 'Followers', '2024-10-29 00:55:24', '2024-10-29 00:56:19'),
(568, 'social_modal_title', 'Add social profile', '2024-10-29 00:55:24', '2024-10-29 00:56:19'),
(569, 'social_edit_modal_title', 'Edit social profile', '2024-10-29 00:55:24', '2024-10-29 00:56:19'),
(570, 'register_page_sidebar_title_two', 'Create an Account Today', '2025-04-21 00:09:21', '2025-07-19 07:42:13'),
(571, 'register_page_sidebar_description_two', 'Influencer is a marketplace where you can buy or sell digital creative services. The platform helps individual influencers, photographers, writers, and musicians collaborate and transact with marketers. Creatives list projects on the site and Marketers buy creative deals through a streamlined chat experience.', '2025-04-21 00:09:21', '2025-07-19 07:42:13'),
(572, 'xendit_gateway', 'on', '2025-04-30 02:12:59', '2025-07-02 04:05:30'),
(573, 'xendit_test_mode', 'on', '2025-04-30 02:12:59', '2025-07-02 04:05:30'),
(574, 'xendit_secret_key', 'xnd_development_axvvNZd9HGFxJlH8SpFqwgKYMUFugu8uF8ZCqAfpZ7QCovylWMbpJi0I3XDtS', '2025-04-30 02:12:59', '2025-07-02 04:05:30'),
(575, 'xendit_webhook_token', NULL, '2025-04-30 02:12:59', '2025-07-02 04:05:30'),
(576, 'xendit_preview_logo', '395', '2025-04-30 02:12:59', '2025-07-02 04:05:30'),
(577, 'sslcommerce_gateway', 'on', '2025-04-30 02:12:59', '2025-07-02 04:05:30'),
(578, 'sslcommerce_preview_logo', '394', '2025-04-30 02:12:59', '2025-07-02 04:05:30'),
(579, 'sslcommerce_test_mode', 'on', '2025-04-30 02:12:59', '2025-07-02 04:05:30'),
(580, 'sslcommerce_store_id', 'xgeni65bceeafdfb1e', '2025-04-30 02:12:59', '2025-07-02 04:05:30'),
(581, 'sslcommerce_store_password', 'xgeni65bceeafdfb1e@ssl', '2025-04-30 02:12:59', '2025-07-02 04:05:30'),
(582, 'site_usd_to_bdt_exchange_rate', '100', '2025-04-30 02:32:24', '2025-04-30 02:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint UNSIGNED NOT NULL,
  `subscription_type_id` bigint NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `limit` bigint NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-active, 0-inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `subscription_highlight_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_product_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_price_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `subscription_type_id`, `title`, `logo`, `price`, `limit`, `status`, `created_at`, `updated_at`, `subscription_highlight_color`, `stripe_product_id`, `stripe_price_id`) VALUES
(1, 1, 'Standard', '113', 20, 100, 1, '2025-02-01 22:45:15', '2025-04-15 23:43:08', 'no', NULL, NULL),
(2, 2, 'Standard', '115', 110, 60, 1, '2025-02-03 00:21:17', '2025-04-15 23:43:08', 'no', NULL, NULL),
(3, 1, 'Starter', '113', 30, 5, 1, '2025-02-04 00:23:11', '2025-04-15 23:43:08', 'no', NULL, NULL),
(4, 2, 'Starter', '57', 100, 50, 0, '2025-02-05 03:29:33', '2025-04-15 23:43:08', 'no', NULL, NULL),
(5, 2, 'Professional', '114', 150, 100, 1, '2025-02-09 23:06:27', '2025-04-15 23:43:08', 'no', NULL, NULL),
(6, 1, 'Professional', '264', 50, 10, 0, '2025-02-13 23:10:38', '2025-07-08 12:22:51', 'no', NULL, NULL),
(7, 1, 'Professional Plus', '264', 60, 23, 1, '2025-03-13 23:11:55', '2025-04-15 23:47:34', 'yes', NULL, NULL),
(8, 3, 'Nano Offer', '57', 10, 5, 0, '2025-02-14 23:13:30', '2025-04-15 23:43:08', 'no', NULL, NULL),
(9, 3, 'Micro Offer', '57', 20, 10, 0, '2025-03-13 23:17:56', '2025-04-15 23:43:08', 'no', NULL, NULL),
(10, 5, 'Welcome Subscription', '264', 0, 20, 1, '2025-03-19 06:57:07', '2025-07-19 12:48:40', 'no', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscription_features`
--

CREATE TABLE `subscription_features` (
  `id` bigint UNSIGNED NOT NULL,
  `subscription_id` bigint NOT NULL,
  `feature` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_features`
--

INSERT INTO `subscription_features` (`id`, `subscription_id`, `feature`, `status`, `created_at`, `updated_at`) VALUES
(293, 4, 'Yearly useable', 'on', '2023-11-08 04:59:30', '2023-11-08 04:59:30'),
(294, 4, 'Support', 'on', '2023-11-08 04:59:30', '2023-11-08 04:59:30'),
(295, 4, 'Very professional', 'on', '2023-11-08 04:59:30', '2023-11-08 04:59:30'),
(296, 4, 'Easy Access', 'on', '2023-11-08 04:59:30', '2023-11-08 04:59:30'),
(297, 4, 'New policy remove', 'on', '2023-11-08 04:59:30', '2023-11-08 04:59:30'),
(298, 4, 'Lifetime', 'off', '2023-11-08 04:59:30', '2023-11-08 04:59:30'),
(299, 4, 'Less use', 'off', '2023-11-08 04:59:30', '2023-11-08 04:59:30'),
(356, 8, 'Connect 5', 'on', '2023-11-08 06:09:17', '2023-11-08 06:09:17'),
(357, 8, 'Weekly', 'on', '2023-11-08 06:09:17', '2023-11-08 06:09:17'),
(358, 8, 'Less feature', 'on', '2023-11-08 06:09:17', '2023-11-08 06:09:17'),
(359, 8, 'New feature', 'on', '2023-11-08 06:09:17', '2023-11-08 06:09:17'),
(360, 8, 'Support system', 'on', '2023-11-08 06:09:17', '2023-11-08 06:09:17'),
(361, 8, 'No drawback', 'on', '2023-11-08 06:09:17', '2023-11-08 06:09:17'),
(362, 8, 'Professional', 'on', '2023-11-08 06:09:17', '2023-11-08 06:09:17'),
(391, 5, 'Connect 100', 'on', '2023-11-27 06:27:53', '2023-11-27 06:27:53'),
(392, 5, 'Yearly system', 'on', '2023-11-27 06:27:53', '2023-11-27 06:27:53'),
(393, 5, 'Less use', 'on', '2023-11-27 06:27:53', '2023-11-27 06:27:53'),
(394, 5, 'Professional', 'on', '2023-11-27 06:27:53', '2023-11-27 06:27:53'),
(395, 5, 'One time get', 'on', '2023-11-27 06:27:53', '2023-11-27 06:27:53'),
(396, 5, 'Monthly support', 'on', '2023-11-27 06:27:53', '2023-11-27 06:27:53'),
(397, 5, 'New policy', 'on', '2023-11-27 06:27:53', '2023-11-27 06:27:53'),
(398, 3, 'Monthly support', 'on', '2023-11-27 06:28:15', '2023-11-27 06:28:15'),
(399, 3, 'Lifetime', 'on', '2023-11-27 06:28:15', '2023-11-27 06:28:15'),
(400, 3, 'Professional', 'on', '2023-11-27 06:28:15', '2023-11-27 06:28:15'),
(401, 3, 'Long term', 'off', '2023-11-27 06:28:15', '2023-11-27 06:28:15'),
(402, 3, 'New feature', 'off', '2023-11-27 06:28:15', '2023-11-27 06:28:15'),
(403, 3, 'Unlimited validity', 'off', '2023-11-27 06:28:15', '2023-11-27 06:28:15'),
(404, 3, 'All Time', 'off', '2023-11-27 06:28:15', '2023-11-27 06:28:15'),
(405, 2, 'Yearly system', 'on', '2023-11-27 06:28:38', '2023-11-27 06:28:38'),
(406, 2, 'Professional', 'on', '2023-11-27 06:28:38', '2023-11-27 06:28:38'),
(407, 2, 'Usefull', 'on', '2023-11-27 06:28:38', '2023-11-27 06:28:38'),
(408, 2, 'Less price', 'on', '2023-11-27 06:28:38', '2023-11-27 06:28:38'),
(409, 2, 'Low cost', 'on', '2023-11-27 06:28:38', '2023-11-27 06:28:38'),
(410, 2, 'Reasonable', 'off', '2023-11-27 06:28:38', '2023-11-27 06:28:38'),
(411, 2, 'Lifetime', 'off', '2023-11-27 06:28:38', '2023-11-27 06:28:38'),
(412, 1, 'Month wise', 'on', '2023-11-27 06:28:55', '2023-11-27 06:28:55'),
(413, 1, 'Get more connect', 'on', '2023-11-27 06:28:55', '2023-11-27 06:28:55'),
(414, 1, 'Multiple use', 'on', '2023-11-27 06:28:55', '2023-11-27 06:28:55'),
(415, 1, 'Multi connect', 'on', '2023-11-27 06:28:55', '2023-11-27 06:28:55'),
(416, 1, 'Professional use', 'on', '2023-11-27 06:28:55', '2023-11-27 06:28:55'),
(417, 1, 'Month wise', 'off', '2023-11-27 06:28:55', '2023-11-27 06:28:55'),
(418, 1, 'Lifetime support', 'off', '2023-11-27 06:28:55', '2023-11-27 06:28:55'),
(419, 11, 'fgdfg', 'off', '2024-07-08 01:33:45', '2024-07-08 01:33:45'),
(420, 11, 'fgdfg', 'off', '2024-07-08 01:33:45', '2024-07-08 01:33:45'),
(421, 11, 'fgdfg', 'off', '2024-07-08 01:33:45', '2024-07-08 01:33:45'),
(464, 9, 'Connect 10', 'on', '2024-10-23 04:19:15', '2024-10-23 04:19:15'),
(465, 9, 'Weekly 2', 'on', '2024-10-23 04:19:15', '2024-10-23 04:19:15'),
(466, 9, 'Limit 10', 'on', '2024-10-23 04:19:15', '2024-10-23 04:19:15'),
(467, 9, 'Professional', 'on', '2024-10-23 04:19:15', '2024-10-23 04:19:15'),
(468, 9, 'Supported', 'on', '2024-10-23 04:19:15', '2024-10-23 04:19:15'),
(469, 9, 'Less use', 'on', '2024-10-23 04:19:15', '2024-10-23 04:19:15'),
(470, 9, 'Welcome feature', 'off', '2024-10-23 04:19:15', '2024-10-23 04:19:15'),
(478, 7, 'Connect 23', 'on', '2025-04-15 23:47:34', '2025-04-15 23:47:34'),
(479, 7, 'Professional', 'on', '2025-04-15 23:47:34', '2025-04-15 23:47:34'),
(480, 7, 'Monthly support', 'on', '2025-04-15 23:47:34', '2025-04-15 23:47:34'),
(481, 7, 'Features', 'on', '2025-04-15 23:47:34', '2025-04-15 23:47:34'),
(482, 7, 'New way', 'on', '2025-04-15 23:47:34', '2025-04-15 23:47:34'),
(483, 7, 'Long term', 'on', '2025-04-15 23:47:34', '2025-04-15 23:47:34'),
(484, 7, 'Usefull', 'on', '2025-04-15 23:47:34', '2025-04-15 23:47:34'),
(485, 6, 'Connect 10', 'on', '2025-04-15 23:48:08', '2025-04-15 23:48:08'),
(486, 6, 'Monthly support', 'on', '2025-04-15 23:48:08', '2025-04-15 23:48:08'),
(487, 6, 'Professional', 'on', '2025-04-15 23:48:08', '2025-04-15 23:48:08'),
(488, 6, 'List type', 'on', '2025-04-15 23:48:08', '2025-04-15 23:48:08'),
(489, 6, 'New feature', 'on', '2025-04-15 23:48:08', '2025-04-15 23:48:08'),
(490, 6, 'Long term', 'on', '2025-04-15 23:48:08', '2025-04-15 23:48:08'),
(491, 6, 'Healthy usecase', 'on', '2025-04-15 23:48:08', '2025-04-15 23:48:08'),
(492, 10, 'Free for first time', 'on', '2025-07-19 12:48:40', '2025-07-19 12:48:40'),
(493, 10, 'Get while register', 'on', '2025-07-19 12:48:40', '2025-07-19 12:48:40'),
(494, 10, 'Must register as a freelancer', 'on', '2025-07-19 12:48:40', '2025-07-19 12:48:40'),
(495, 10, 'One time get', 'on', '2025-07-19 12:48:40', '2025-07-19 12:48:40'),
(496, 10, 'Use for job proposal', 'on', '2025-07-19 12:48:40', '2025-07-19 12:48:40'),
(497, 10, 'Get only once', 'on', '2025-07-19 12:48:40', '2025-07-19 12:48:40'),
(498, 10, 'Totally Free', 'on', '2025-07-19 12:48:40', '2025-07-19 12:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_types`
--

CREATE TABLE `subscription_types` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `validity` int DEFAULT NULL,
  `is_free` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_types`
--

INSERT INTO `subscription_types` (`id`, `type`, `validity`, `is_free`, `created_at`, `updated_at`) VALUES
(1, 'Monthly', 30, 0, '2025-02-03 06:39:12', '2025-03-13 00:11:48'),
(2, 'Yearly', 365, 0, '2025-02-10 06:39:24', '2025-03-13 00:11:36'),
(3, 'Weekly', 7, 0, '2025-02-13 00:13:12', '2025-03-17 00:13:12'),
(5, 'Free', 30, 1, '2025-02-19 06:56:31', '2025-07-19 12:48:23');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `sub_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `category_id` bigint NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive 1=active',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `sub_category`, `short_description`, `slug`, `meta_title`, `meta_description`, `category_id`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Daily Life', 'This category descrips Daily Life', 'dailylife', 'This category descrips Daily Life', 'This category descrips Daily Life', 1, 1, NULL, '2023-02-07 06:00:14', '2025-04-12 23:31:10'),
(2, 'Home Decor', 'This category descrips financial Home Decor', 'home-decor', NULL, NULL, 1, 1, NULL, '2023-02-07 06:00:23', '2025-04-12 23:32:06'),
(3, 'Luxury Fashion', 'This category related to Luxury Fashion', 'luxury-fashion', NULL, NULL, 2, 1, '69', '2023-02-07 22:28:02', '2025-04-12 23:33:50'),
(5, 'Destination Guides', 'This category descrips financial Destination Guides', 'destination-guides', NULL, NULL, 4, 1, NULL, '2023-02-07 22:28:28', '2025-04-12 23:36:51'),
(6, 'Travel Tips', 'This category descrips financial Travel Tips', 'travel-tips', NULL, NULL, 4, 1, NULL, '2023-02-07 22:28:43', '2025-04-12 23:37:45'),
(7, 'Luxury Travel', 'This category descrips financial operations Luxury Travel', 'luxury-travel', NULL, NULL, 4, 1, NULL, '2023-02-07 22:28:55', '2025-04-12 23:39:18'),
(8, 'Adventure Travel', 'This category descrips financial Adventure Travel', 'adventure-travel', NULL, NULL, 4, 1, NULL, '2023-02-07 22:29:07', '2025-04-12 23:40:15'),
(20, 'Men\'s-Women\'s Fashion', 'This category descrips Men\'s-Women\'s Fashion', 'men-women-fashion', NULL, NULL, 2, 1, '7', '2023-02-08 22:49:10', '2025-04-12 23:35:58'),
(21, 'Sustainable Fashion', 'This category descrips Sustainable Fashion', 'sustainable-fashion', NULL, NULL, 2, 1, NULL, '2023-02-08 23:02:13', '2025-04-12 23:34:50'),
(22, 'Street Style', 'This category descrips Street Style', 'street-style', NULL, NULL, 2, 1, NULL, '2023-02-08 23:02:39', '2025-04-12 23:47:21'),
(24, 'Wellness', 'This category describes Wellness', 'wellness', NULL, NULL, 1, 1, '69', '2023-05-15 23:54:28', '2025-04-12 23:50:51'),
(26, 'Pregnancy', 'This category descrips Pregnancy', 'pregnancy', NULL, NULL, 13, 1, NULL, '2023-05-17 06:51:34', '2025-04-12 23:58:10'),
(29, 'Reviews', 'Reviews', 'reviews', NULL, NULL, 11, 1, '77', '2023-11-05 05:21:43', '2025-04-12 23:55:37'),
(30, 'Unboxings', 'Unboxings', 'unboxings', NULL, NULL, 11, 1, '77', '2023-11-05 05:41:56', '2025-04-12 23:56:11'),
(31, 'Family Life', 'Family Life', 'family-life', NULL, NULL, 13, 1, '77', '2023-11-05 06:23:45', '2025-04-13 00:00:39'),
(32, 'Baby Products', 'Baby Products', 'baby-products', NULL, NULL, 13, 1, '69', '2023-11-05 06:24:27', '2025-04-12 23:58:53'),
(33, 'Parenting Tips', 'Parenting Tips', 'parenting-tips', NULL, NULL, 13, 1, '67', '2023-11-05 06:25:42', '2025-04-12 23:59:34'),
(34, 'Smart Home', 'Smart Home', 'smart-home', NULL, NULL, 11, 1, '66', '2023-11-05 06:26:26', '2025-04-12 23:56:58'),
(35, 'Mental Health', 'Mental Health', 'mental-health', NULL, NULL, 9, 1, NULL, '2023-11-06 00:45:03', '2025-04-13 00:04:27'),
(36, 'Skincare', 'Skincare', 'skincare', NULL, NULL, 3, 1, NULL, '2023-11-06 00:51:44', '2025-04-13 00:01:44'),
(37, 'Recipes', 'Recipes', 'recipes', NULL, NULL, 5, 1, NULL, '2023-11-06 01:20:41', '2025-04-13 00:03:03'),
(45, 'Lookbooks', 'Lookbooks', 'lookbooks', NULL, NULL, 2, 1, NULL, '2024-01-30 05:23:34', '2025-04-12 23:49:01'),
(46, 'Productivity', 'Productivity', 'productivity', NULL, NULL, 1, 1, NULL, '2024-01-30 05:26:55', '2025-04-12 23:52:23'),
(47, 'Personal Development', 'Personal Development', 'personal-development', NULL, NULL, 1, 1, NULL, '2024-01-30 05:27:42', '2025-04-12 23:53:14'),
(52, 'Celebrity News', 'Celebrity News', 'celebrity-news', NULL, NULL, 24, 1, NULL, '2024-01-30 06:10:28', '2025-04-13 00:06:49'),
(57, 'Businence Promotion', 'Businence Promotion', 'businence-promotion', NULL, 'Businence Promotion', 18, 1, NULL, '2025-04-27 00:15:12', '2025-04-27 00:15:12'),
(58, 'Outfit Showcasing', 'Outfit Showcasing', 'outfit-showcasing', 'Outfit Showcasing', 'Outfit Showcasing', 2, 1, NULL, '2025-07-09 01:09:08', '2025-07-09 01:09:08'),
(59, 'Makeup', 'Makeup', 'makeup', 'Makeup', 'Makeup', 3, 1, NULL, '2025-07-09 22:55:59', '2025-07-09 22:55:59'),
(60, 'Blush & Highlighters', 'Blush & Highlighters', 'blush-amp-highlighters', 'Blush & Highlighters', 'Blush & Highlighters', 3, 1, NULL, '2025-07-09 22:56:37', '2025-07-09 22:56:37'),
(61, 'Computing & Accessories', 'Computing & Accessories', 'computing-amp-accessories', 'Computing & Accessories', 'Computing & Accessories', 11, 1, NULL, '2025-07-09 23:09:52', '2025-07-09 23:09:52');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category_users`
--

CREATE TABLE `sub_category_users` (
  `id` bigint UNSIGNED NOT NULL,
  `sub_category_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint NOT NULL,
  `admin_id` bigint DEFAULT NULL,
  `client_id` bigint DEFAULT NULL,
  `freelancer_id` bigint DEFAULT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `subject` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `priority` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `via` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'admin, client, freelancer',
  `operating_system` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hourly_rate` double NOT NULL DEFAULT '0',
  `experience_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'junior',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint DEFAULT NULL,
  `state_id` bigint DEFAULT NULL,
  `city_id` bigint DEFAULT NULL,
  `user_type` tinyint NOT NULL DEFAULT '0' COMMENT '1:client, 2:freelancer',
  `check_online_status` timestamp NULL DEFAULT NULL,
  `check_work_availability` tinyint NOT NULL DEFAULT '1',
  `user_active_inactive_status` tinyint NOT NULL DEFAULT '1' COMMENT '0:inactive, 1:active',
  `user_verified_status` tinyint NOT NULL DEFAULT '0' COMMENT '0:not verified, 1:verified',
  `is_suspend` tinyint NOT NULL DEFAULT '0' COMMENT '0=no , 1=yes',
  `terms_condition` int NOT NULL DEFAULT '1',
  `about` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_email_verified` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0: not verified, 1:verified',
  `google_2fa_secret` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_2fa_enable_disable_disable` tinyint NOT NULL DEFAULT '0' COMMENT '0=disable 1=enable',
  `google_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `github_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apple_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_pro` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pro_expire_date` timestamp NULL DEFAULT NULL,
  `email_verify_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `firebase_device_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freeze_withdraw` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freeze_project` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freeze_job` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freeze_chat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freeze_order_create` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_otp_verify` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = not verified, 1 = verified',
  `phone_otp_code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Stores the OTP code for phone verification',
  `phone_otp_expiration` timestamp NULL DEFAULT NULL COMMENT 'Stores the expiration time for the OTP code',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `load_from` int NOT NULL DEFAULT '0',
  `is_synced` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `hourly_rate`, `experience_level`, `email`, `phone`, `gender`, `username`, `password`, `image`, `country_id`, `state_id`, `city_id`, `user_type`, `check_online_status`, `check_work_availability`, `user_active_inactive_status`, `user_verified_status`, `is_suspend`, `terms_condition`, `about`, `is_email_verified`, `google_2fa_secret`, `google_2fa_enable_disable_disable`, `google_id`, `facebook_id`, `github_id`, `apple_id`, `is_pro`, `pro_expire_date`, `email_verify_token`, `firebase_device_token`, `freeze_withdraw`, `freeze_project`, `freeze_job`, `freeze_chat`, `freeze_order_create`, `email_verified_at`, `phone_otp_verify`, `phone_otp_code`, `phone_otp_expiration`, `remember_token`, `load_from`, `is_synced`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Test', 'Client', 0, 'junior', 'tclient@example.com', '6546463544645', NULL, 'client', '$2y$10$tBbLYBeweDyYBf81Yun5TuPAZMBYLwU8c2mrMszBe67P7RcC1yKNK', '1744721044-67fe5494b8b7a.png', 4, 22, 17, 1, '2025-08-30 13:12:09', 1, 1, 1, 0, 1, NULL, '1', 'HATKCPGN5WGPJEFU', 0, NULL, NULL, NULL, NULL, NULL, NULL, '969657', 'eyar1gBcQ_2wuVc-jK7rJ1:APA91bHX3WQaIljuOCpPebDiOXX3FSCWo7Q-zeFPxbuFPpz4zRCyoj7_S-Jox83f6W_hshSepbtoiPzF2YiJlt1Y63JIfduBufTYvdWrjR-7mdLBpuvfCOWt6u1SEY2WtNYNdKho73KE', NULL, NULL, 'unfreeze', 'unfreeze', 'unfreeze', NULL, 0, NULL, NULL, NULL, 1, 1, '2025-01-23 06:03:28', '2025-08-30 13:12:09', NULL),
(2, 'Istiak', 'Ahmed', 0, 'junior', 'istiak@example.com', '0172873763', NULL, 'istiak', '$2y$10$dVn7Zka2IxHQeXYRCe/GweDPW7wqxjwT2qycATvIcLh3fg20i5z0W', '1752041529-686e08393ed8f.png', 3, 21, NULL, 1, '2025-07-14 01:41:13', 1, 1, 1, 0, 1, NULL, '1', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '374933', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2025-01-23 23:35:32', '2025-07-14 01:41:13', NULL),
(3, 'Ayesha', 'Noor', 0, 'senior', 'ayeshanoor@example.com', '01713602726', 'female', 'riad', '$2y$10$sXCk0xU6shlnk8QuJWvmSeca/vDULwFCOgKQP68TyPIbObo7cIFWa', '1752733803-6878986b54f98.png', 2, 16, 2, 2, '2025-07-17 00:30:15', 1, 1, 1, 0, 1, NULL, '1', 'FKQTMPWCBBUNKYMY', 0, NULL, NULL, 'Brand Ambassador', 'Yes', 'yes', '2024-09-18 00:09:40', '525550', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 1, '2025-09-29 22:40:49', '2025-07-17 00:30:15', NULL),
(4, 'Jake', 'Shansom', 0, 'junior', 'jake@example.com', '45634563454', 'male', 'shahin', '$2y$10$sXCk0xU6shlnk8QuJWvmSeca/vDULwFCOgKQP68TyPIbObo7cIFWa', '1752733334-687896965b810.png', 1, 2, 4, 2, '2025-07-17 00:29:43', 1, 1, 0, 0, 1, NULL, '1', NULL, 0, NULL, NULL, 'Social Media Strategist', 'Yes', 'yes', '2024-09-28 00:56:22', '965295', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 1, '2025-02-23 06:49:24', '2025-07-17 00:29:43', NULL),
(5, 'Test', 'Influencer', 0, 'junior', 'testinfluencer@example.com', '0239433242', 'male', 'influencer', '$2y$10$xxOdjaFbcRNI76SwI4.tN.a.OVHEiHI/gzeTa83UUDQGtL1TMRXpu', '1752732944-687895104723f.png', 1, 1, 1, 2, '2025-08-30 16:14:21', 1, 1, 1, 0, 1, NULL, '1', 'FCDRNDB3C6PVI3IR', 0, NULL, NULL, 'Digital Content Creator', 'Yes', NULL, NULL, '690987', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2025-10-27 01:40:45', '2025-08-30 16:14:21', NULL),
(6, 'Rafi', 'Shaek', 0, 'junior', 'rafi@example.com', NULL, NULL, 'rafi12', '$2y$10$mKBsog.mQ07Mt4ujTdZbHOlsmQQjNcK2T0Rm9NF7vA42.lq2.2C7a', '1752042335-686e0b5f2ba7c.png', 1, 1, 1, 1, '2025-07-09 00:28:37', 1, 1, 0, 0, 1, NULL, '1', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '550474', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2025-04-20 23:22:01', '2025-07-14 01:37:44', NULL),
(7, 'Shanta', 'Islam', 0, 'junior', 'shanta@example.com', NULL, 'female', 'shanto12', '$2y$10$NMB4JTbpa7XSw2ct1RMDpejMhZ7XKfUvuao1Cr5vk5fQN31TgzQcK', '1751994368-686d50004d38d.png', 7, 24, 21, 2, '2025-07-14 01:35:05', 1, 1, 0, 0, 1, NULL, '1', NULL, 0, NULL, NULL, 'Social Media Strategist', 'Yes', NULL, NULL, '682439', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2025-04-21 00:15:37', '2025-07-14 01:35:05', NULL),
(8, 'Ariana', 'Lopez', 0, 'expert', 'ariana.lopez@example.com', '01710000001', 'male', 'ari.lopez', '$2y$10$xxOdjaFbcRNI76SwI4.tN.a.OVHEiHI/gzeTa83UUDQGtL1TMRXpu', '1752041911-686e09b7591d9.png', 2, 16, 2, 2, '2025-07-10 10:24:39', 1, 1, 0, 0, 1, NULL, '1', NULL, 0, NULL, NULL, 'Digital Content Creator', 'Yes', NULL, NULL, '690983', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2025-07-08 16:00:54', '2025-07-10 10:24:39', NULL),
(9, 'Jamal', 'Reed', 0, 'junior', 'jamal.reed@example.com', '01710000002', 'male', 'jamalreed', '$2y$10$xxOdjaFbcRNI76SwI4.tN.a.OVHEiHI/gzeTa83UUDQGtL1TMRXpu', '1751994691-686d5143390ba.png', 2, 16, 2, 2, '2025-07-10 10:37:23', 1, 1, 1, 0, 1, NULL, '1', NULL, 0, NULL, NULL, 'Digital Marketing Specialist', 'Yes', NULL, NULL, '690984', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2025-07-08 16:00:54', '2025-07-10 10:37:23', NULL),
(10, 'Leo', 'Martinez', 15, 'mid', 'leo.martinez@example.com', '01710000004', 'male', 'leomart', '$2y$10$xxOdjaFbcRNI76SwI4.tN.a.OVHEiHI/gzeTa83UUDQGtL1TMRXpu', '1752733835-6878988bad2a9.png', 3, 21, NULL, 2, '2025-07-17 00:44:43', 1, 1, 0, 0, 1, NULL, '1', NULL, 0, NULL, NULL, 'Content Creator', 'Yes', NULL, NULL, '690985', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2025-07-08 16:00:54', '2025-07-17 00:44:43', NULL),
(11, 'Nora', 'Khan', 0, 'senior', 'nora.khan@example.com', '01710000009', 'male', 'norakstyle', '$2y$10$xxOdjaFbcRNI76SwI4.tN.a.OVHEiHI/gzeTa83UUDQGtL1TMRXpu', '1751994791-686d51a7b25e9.png', 4, 22, 17, 2, '2025-07-10 10:57:31', 1, 1, 1, 0, 1, NULL, '1', NULL, 0, NULL, NULL, 'Fashion Creator', 'Yes', NULL, NULL, '690986', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2025-07-08 16:00:54', '2025-07-10 10:57:31', NULL),
(111, 'Liam', 'Morgan', 0, 'junior', 'liam.morgan@example.com', '6546463540001', 'male', 'liamclient', '$2y$10$tBbLYBeweDyYBf81Yun5TuPAZMBYLwU8c2mrMszBe67P7RcC1yKNK', '1752042533-686e0c2574038.png', 2, 16, 2, 1, '2025-07-09 00:37:37', 1, 1, 1, 0, 1, NULL, '1', 'HATLIAM0001', 0, NULL, NULL, NULL, NULL, NULL, NULL, '690987', 'eyar1gBcQ_2wuVc-abcabc01', NULL, NULL, 'unfreeze', 'unfreeze', 'unfreeze', NULL, 0, NULL, NULL, NULL, 1, 1, '2025-07-08 16:38:49', '2025-07-14 01:36:24', NULL),
(112, 'Sophia', 'Lee', 0, 'junior', 'sophia.lee@example.com', '6546463540002', 'female', 'sophclient', '$2y$10$tBbLYBeweDyYBf81Yun5TuPAZMBYLwU8c2mrMszBe67P7RcC1yKNK', '1752043137-686e0e810e68e.png', 4, 22, 17, 1, '2025-07-09 00:45:11', 1, 1, 1, 0, 1, NULL, '1', 'HATSOPH0002', 0, NULL, NULL, NULL, NULL, NULL, NULL, '690986', 'eyar1gBcQ_2wuVc-abcabc02', NULL, NULL, 'unfreeze', 'unfreeze', 'unfreeze', NULL, 0, NULL, NULL, NULL, 1, 1, '2025-07-08 16:38:49', '2025-07-14 01:37:15', NULL),
(113, 'Noah', 'Khan', 0, 'junior', 'noah.khan@example.com', '6546463540003', 'male', 'noahclient', '$2y$10$tBbLYBeweDyYBf81Yun5TuPAZMBYLwU8c2mrMszBe67P7RcC1yKNK', '1752042105-686e0a7914f30.png', 2, 16, 2, 1, '2025-07-09 00:25:15', 1, 1, 1, 0, 1, NULL, '1', 'HATNOAH0003', 0, NULL, NULL, NULL, NULL, NULL, NULL, '690981', 'eyar1gBcQ_2wuVc-abcabc03', NULL, NULL, 'unfreeze', 'unfreeze', 'unfreeze', NULL, 0, NULL, NULL, NULL, 1, 1, '2025-07-08 16:38:49', '2025-07-14 01:36:58', NULL),
(114, 'Ava', 'Reed', 0, 'junior', 'ava.reed@example.com', '6546463540004', 'male', 'avaclient', '$2y$10$tBbLYBeweDyYBf81Yun5TuPAZMBYLwU8c2mrMszBe67P7RcC1yKNK', '1752041650-686e08b20a4a7.png', 2, 16, 2, 1, '2025-07-17 07:03:16', 1, 1, 1, 0, 1, NULL, '1', 'HATAVA0004', 0, NULL, NULL, NULL, NULL, NULL, NULL, '690980', 'eyar1gBcQ_2wuVc-abcabc04', NULL, NULL, 'unfreeze', 'unfreeze', 'unfreeze', NULL, 0, NULL, NULL, NULL, 1, 1, '2025-07-08 16:38:49', '2025-07-17 07:03:16', NULL),
(115, 'Eva', 'Rothchild', 0, 'junior', 'Eva@influencer.com', NULL, NULL, 'eva', '$2y$10$gNIRvvEnLi1t99sc/5RuXen9xsjrtlsPrBS7jCl20/FqiOpvDpkQO', NULL, NULL, NULL, NULL, 1, '2025-07-14 22:49:25', 1, 1, 0, 0, 1, NULL, '1', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '568234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2025-07-14 04:01:59', '2025-07-14 22:49:25', NULL),
(116, 'Salena', 'Fisk', 0, 'junior', 'salena@influencer.com', NULL, 'female', 'selina', '$2y$10$y5XE52b2nTfztjOFjiLoAOYkRwsGFe/xzjcp/3wchH8210RamUQrK', '1752494800-6874f2d077206.jpg', 3, 21, 23, 2, '2025-07-15 00:21:35', 1, 1, 0, 0, 1, NULL, '1', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '646147', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2025-07-14 05:42:00', '2025-07-15 00:21:35', NULL),
(118, 'Hero', 'Zero', 0, 'junior', 'Gg@gg.com', NULL, NULL, 'herozero', '$2y$10$I259wlD/kMlIudVjsZzmfOIxHOTYge9moQGMtz/qFiZhW7Z6hTrMW', NULL, NULL, NULL, NULL, 1, '2025-07-25 04:54:33', 1, 1, 0, 0, 1, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '136070', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2025-07-25 04:53:56', '2025-07-25 04:54:33', NULL),
(119, 'Richard', 'Nestor', 0, 'junior', 'rickardnb@gmail.com', NULL, NULL, 'rickardnestor', '$2y$10$1CUFjZ5AuqfVTp3xwrkFEOBErUVxAQCklsw7neJCGalymTGoU3W0G', NULL, NULL, NULL, NULL, 2, '2025-07-26 03:48:08', 1, 1, 0, 0, 1, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '303035', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2025-07-26 03:46:24', '2025-07-26 03:48:08', NULL),
(120, 'tester', 'tester', 0, 'junior', 'heyec47073@kloudis.com', NULL, NULL, 'tester777', '$2y$10$2hpHOUlDdfSV/AIzgomp/e4rtTSUyh8E6DugYkoUNu1aWGVi4tB2q', NULL, NULL, NULL, NULL, 2, '2025-07-27 03:09:31', 1, 1, 0, 0, 1, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '296002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2025-07-27 03:08:48', '2025-07-27 03:09:31', NULL),
(121, 'tester2', 'tester2', 0, 'junior', 'y8odq@mechanicspedia.com', NULL, NULL, 'tester7772', '$2y$10$3x6UcPpPuin06yaTVgHJKuv8yGev0zcc0RwRV54QfCXjFKf27euZq', NULL, NULL, NULL, NULL, 2, '2025-07-27 03:10:19', 1, 1, 0, 0, 1, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '371249', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2025-07-27 03:09:31', '2025-07-27 03:10:19', NULL),
(122, 'Boss', 'Faiela', 0, 'junior', 'arnaldo.faela01@gmail.com', NULL, NULL, 'Boss', '$2y$10$2NPWfmf42NeCGe1ZQYgAxOGhLleMe2OJJYEExxJdmHTjwCq495RIe', NULL, NULL, NULL, NULL, 2, '2025-07-27 07:15:00', 1, 1, 0, 0, 1, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '900122', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2025-07-27 07:09:39', '2025-07-27 07:15:00', NULL),
(123, 'Meme', 'User', 0, 'junior', 'memeuser@gmail.com', NULL, NULL, 'memeuser', '$2y$10$RkzuU3bbZ29XUR/p8vGIROyngpQ2qQyjxDfSMbvwmaj78X1b6u4JW', NULL, NULL, NULL, NULL, 1, '2025-07-28 00:54:52', 1, 1, 0, 0, 1, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '174981', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2025-07-28 00:54:21', '2025-07-28 00:54:52', NULL),
(124, 'Rafaqat', 'Imran', 0, 'junior', 'imranom2022@gmail.com', NULL, NULL, 'Lara2ers', '$2y$10$0fLEjSfv33/Wcuo5y0Co9ulQ.IqvjTVx.rGzwMpUU5Cj19feRc1VG', NULL, NULL, NULL, NULL, 2, '2025-07-28 20:14:43', 1, 1, 0, 0, 1, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '953932', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2025-07-28 17:35:34', '2025-07-28 20:14:43', NULL),
(125, 'Olcay', 'Tasdemir', 0, 'junior', 'ilanlarr@gmail.com', NULL, NULL, 'iletio', '$2y$10$oGpIvKQFLanMj50DA64Ix.pSSBUHEBSiMoixNf27DpB/iTRPf9iT.', NULL, NULL, NULL, NULL, 1, '2025-07-30 10:59:28', 1, 1, 0, 0, 1, NULL, '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '273758', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2025-07-30 10:53:44', '2025-07-30 10:59:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_earnings`
--

CREATE TABLE `user_earnings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `total_earning` double NOT NULL DEFAULT '0',
  `total_withdraw` double NOT NULL DEFAULT '0',
  `remaining_balance` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_earnings`
--

INSERT INTO `user_earnings` (`id`, `user_id`, `total_earning`, `total_withdraw`, `remaining_balance`, `created_at`, `updated_at`) VALUES
(1, 5, 1248.164, 0, 1248.164, '2023-11-07 00:54:27', '2025-05-19 05:47:21'),
(2, 3, 861.1, 0, 861.1, '2023-11-27 06:15:31', '2025-04-29 23:03:21'),
(5, 4, 316, 0, 316, '2025-04-29 06:56:48', '2025-04-29 22:53:54'),
(6, 102, 342.86, 0, 342.86, '2025-04-29 22:03:33', '2025-04-29 22:10:45'),
(7, 116, 3634, 0, 3634, '2025-07-14 21:59:35', '2025-07-14 21:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `user_education`
--

CREATE TABLE `user_education` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `institution` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `degree` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_experiences`
--

CREATE TABLE `user_experiences` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_introductions`
--

CREATE TABLE `user_introductions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_introductions`
--

INSERT INTO `user_introductions` (`id`, `user_id`, `description`, `created_at`, `updated_at`) VALUES
(3, 5, 'Dynamic influencer creating engaging content around lifestyle, fashion, and travel. Passionate about inspiring others through authentic storytelling, brand collaborations, loyal audience across multiple platforms.', '2025-04-12 23:00:14', '2025-04-12 23:00:14'),
(4, 4, 'Dynamic influencer creating engaging content around lifestyle, fashion, and travel. Passionate about inspiring others through authentic storytelling, brand collaborations, loyal audience across multiple platforms', '2025-04-15 04:22:55', '2025-04-15 04:22:55'),
(5, 3, 'Dynamic influencer creating engaging content around lifestyle, fashion, and travel. Passionate about inspiring others through authentic storytelling, brand collaborations, loyal audience across multiple platforms.', '2025-04-15 05:32:27', '2025-04-15 05:32:27'),
(6, 102, 'Dynamic influencer creating engaging content around lifestyle, fashion, and travel. Passionate about inspiring others through authentic storytelling, brand collaborations, loyal audience across multiple platforms.', '2025-04-21 00:16:48', '2025-04-21 00:16:48'),
(7, 103, 'hello', '2025-05-02 06:42:03', '2025-05-02 06:42:03'),
(8, 8, 'Creative digital content creator specializing in engaging product promos, reels, and brand storytelling. Helping brands connect with their audience through authentic, eye-catching content. Available for collaborations and promotions.', '2025-07-10 10:20:32', '2025-07-10 10:20:32'),
(9, 9, 'Results-driven Digital Marketing Specialist with a passion for growing brands online. Expert in SEO, social media, and ad campaigns. Let’s boost your visibility and drive real results through smart, data-backed strategies.', '2025-07-10 10:25:08', '2025-07-10 10:25:08'),
(10, 10, 'Versatile Content Creator crafting engaging visuals and compelling stories for brands. From videos to social media content, I help businesses connect, inspire, and grow their audience authentically. Available for brand collaborations.', '2025-07-10 10:38:06', '2025-07-10 10:38:06'),
(11, 11, 'Fashion Creator with a flair for styling, trends, and visual storytelling. I bring brands to life through chic, on-trend content that captivates and converts. Let’s create fashion moments that stand out and drive engagement.', '2025-07-10 10:41:26', '2025-07-10 10:41:26'),
(12, 116, 'Lifestyle & beauty creator sharing honest reviews, skincare glow-ups & mindful living. Let’s make your brand shine! 📸✨', '2025-07-14 22:01:58', '2025-07-14 22:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_langs`
--

CREATE TABLE `user_langs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `lang` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_langs`
--

INSERT INTO `user_langs` (`id`, `user_id`, `lang`, `created_at`, `updated_at`) VALUES
(3, 5, 'English (UK) , Español , Português , বাংলা', '2025-04-13 00:23:44', '2025-04-13 00:23:44'),
(4, 102, 'English (UK) , Español , Türkçe', '2025-04-21 00:20:21', '2025-04-21 00:20:25'),
(5, 3, 'English (UK) , Español , বাংলা', '2025-04-21 02:32:13', '2025-04-21 02:32:13'),
(6, 4, 'English (UK) , Español , Türkçe', '2025-04-21 06:38:45', '2025-04-21 06:38:45'),
(7, 103, 'hello, English (UK) , Español', '2025-05-02 06:44:26', '2025-05-02 06:44:26'),
(8, 8, 'English (UK)', '2025-07-10 10:23:43', '2025-07-10 10:23:43'),
(9, 9, 'English (UK) , Español', '2025-07-10 10:27:23', '2025-07-10 10:27:23'),
(10, 10, ', English (UK) , Português , Español', '2025-07-10 10:39:59', '2025-07-10 10:39:59'),
(11, 11, 'English (UK)', '2025-07-10 10:53:54', '2025-07-10 10:54:21'),
(12, 116, ', English (UK) , Español', '2025-07-14 22:05:35', '2025-07-14 22:05:35'),
(13, 1, 'English (UK) , Español , Português , বাংলা', '2025-07-25 13:40:39', '2025-07-25 13:40:39');

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE `user_notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `identity` bigint NOT NULL,
  `client_id` bigint NOT NULL,
  `freelancer_id` bigint NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_client_read` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `is_freelancer_read` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_skills`
--

CREATE TABLE `user_skills` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `skill` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_skills`
--

INSERT INTO `user_skills` (`id`, `user_id`, `skill`, `created_at`, `updated_at`) VALUES
(2, 3, 'TravelGuide , TravelTips , LuxuryTravel , OutfitInspo , FoodPhotography', '2023-03-16 06:50:02', '2025-04-21 02:38:55'),
(10, 5, 'Tiktok,Instragram, FoodieFinds , FoodPhotography , MensFashion , EasyRecipes, LuxuryTravel , TravelTips , TravelGuide , SustainableStyle , Negotiation skills , TikTok , Instagram , Instagram Marketing , StreetStyle', '2025-04-12 23:46:05', '2025-07-25 16:14:36'),
(11, 102, 'Digital Marketer', '2025-04-21 00:20:15', '2025-04-21 00:20:15'),
(12, 4, 'TikTok,YouTube,Marketing,Promote', '2025-04-21 06:38:39', '2025-04-21 06:38:39'),
(13, 103, 'sdsadasda,asdasda', '2025-05-02 06:42:39', '2025-05-02 06:42:39'),
(14, 8, 'TikTok , Instagram , Storytelling , Tech Reviews , Instagram Marketing , OutfitInspo , YouTube', '2025-07-10 10:23:37', '2025-07-10 10:23:37'),
(15, 9, 'TravelGuide , TravelTips , Instagram , Instagram Marketing , OutfitInspo , Tech Reviews', '2025-07-10 10:27:15', '2025-07-10 10:27:15'),
(16, 10, 'TravelGuide , TravelTips , LuxuryTravel , OutfitInspo , MensFashion , SustainableStyle , StreetStyle , FoodieFinds , EasyRecipes , FoodPhotography , TikTok , Instagram , Parenting , Instagram Marketing , Tech Reviews , Storytelling', '2025-07-10 10:39:54', '2025-07-10 10:39:54'),
(17, 11, 'TravelGuide , TravelTips , LuxuryTravel , OutfitInspo , StreetStyle , SustainableStyle , Negotiation skills , FoodPhotography', '2025-07-10 10:53:51', '2025-07-10 10:54:17'),
(18, 116, ',Content Creation,Video Editing,Product Photography,Storytelling,Brand Partnerships,Hashtag Research,Community Engagement,Trend Spotting,SEO', '2025-07-14 22:05:22', '2025-07-14 22:05:22'),
(19, 1, 'Tiktok,Instragram, FoodieFinds , FoodPhotography , MensFashion , EasyRecipes', '2025-07-25 13:40:30', '2025-07-25 13:40:30');

-- --------------------------------------------------------

--
-- Table structure for table `user_subscriptions`
--

CREATE TABLE `user_subscriptions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `stripe_customer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_session_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_subscription_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_price_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription_id` bigint NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `limit` bigint NOT NULL DEFAULT '0',
  `target_limit` int DEFAULT NULL,
  `expire_date` timestamp NULL DEFAULT NULL,
  `payment_gateway` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_recurring_subscription` tinyint(1) NOT NULL DEFAULT '0',
  `start_date` timestamp NULL DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manual_payment_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_send` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_subscriptions`
--

INSERT INTO `user_subscriptions` (`id`, `user_id`, `stripe_customer_id`, `stripe_session_id`, `stripe_subscription_id`, `stripe_price_id`, `subscription_id`, `price`, `limit`, `target_limit`, `expire_date`, `payment_gateway`, `payment_status`, `is_recurring_subscription`, `start_date`, `status`, `transaction_id`, `manual_payment_image`, `email_send`, `created_at`, `updated_at`) VALUES
(119, 5, NULL, NULL, NULL, NULL, 3, 30, 5, NULL, '2025-05-15 22:45:41', 'stripe', NULL, 0, NULL, 0, NULL, NULL, NULL, '2025-04-15 22:45:41', '2025-04-15 22:45:41'),
(120, 5, NULL, NULL, NULL, NULL, 7, 60, 19, NULL, '2025-05-15 22:49:06', 'stripe', 'complete', 0, NULL, 1, 'pi_3RENuREmGOuJLTMs1Tt6vbYl', NULL, NULL, '2025-04-15 22:49:06', '2025-05-04 01:59:27'),
(121, 102, NULL, NULL, NULL, NULL, 10, 12, 20, NULL, '2025-05-21 00:15:37', 'Trial', 'complete', 0, NULL, 1, NULL, NULL, NULL, '2025-04-21 00:15:37', '2025-04-21 00:15:37'),
(137, 5, NULL, NULL, NULL, NULL, 6, 50, 10, NULL, '2025-06-02 23:53:09', 'xendit', 'complete', 0, NULL, 1, '681700c61cfd0b6884670ac3', NULL, NULL, '2025-05-03 23:53:09', '2025-05-03 23:53:28'),
(138, 5, NULL, NULL, NULL, NULL, 7, 60, 23, NULL, '2025-07-25 00:11:21', 'stripe', NULL, 0, NULL, 0, NULL, NULL, NULL, '2025-06-25 00:11:21', '2025-06-25 00:11:21'),
(139, 5, NULL, NULL, NULL, NULL, 7, 60, 21, NULL, '2025-07-25 00:11:39', 'wallet', 'complete', 0, NULL, 1, NULL, NULL, NULL, '2025-06-25 00:11:39', '2025-06-25 00:19:45'),
(140, 116, NULL, NULL, NULL, NULL, 2, 110, 58, NULL, '2026-07-14 05:55:09', 'stripe', 'complete', 0, NULL, 1, 'pi_3RkkysEmGOuJLTMs1wpZknb6', NULL, NULL, '2025-07-14 05:55:09', '2025-07-14 05:56:23'),
(141, 5, NULL, NULL, NULL, NULL, 7, 60, 23, NULL, '2025-08-24 09:24:38', 'razorpay', NULL, 0, NULL, 0, NULL, NULL, NULL, '2025-07-25 09:24:38', '2025-07-25 09:24:38'),
(142, 5, NULL, NULL, NULL, NULL, 7, 60, 23, NULL, '2025-08-24 11:49:15', 'wallet', 'complete', 0, NULL, 1, NULL, NULL, NULL, '2025-07-25 11:49:15', '2025-07-25 11:49:15'),
(143, 5, NULL, NULL, NULL, NULL, 5, 150, 100, NULL, '2026-07-25 11:49:45', 'wallet', 'complete', 0, NULL, 1, NULL, NULL, NULL, '2025-07-25 11:49:45', '2025-07-25 11:49:45'),
(144, 5, NULL, NULL, NULL, NULL, 7, 60, 23, NULL, '2025-08-24 17:53:03', 'wallet', 'complete', 0, NULL, 1, NULL, NULL, NULL, '2025-07-25 17:53:03', '2025-07-25 17:53:03'),
(145, 119, NULL, NULL, NULL, NULL, 10, 0, 20, NULL, '2025-08-25 03:46:24', 'Trial', 'complete', 0, NULL, 1, NULL, NULL, NULL, '2025-07-26 03:46:24', '2025-07-26 03:46:24'),
(146, 120, NULL, NULL, NULL, NULL, 10, 0, 20, NULL, '2025-08-26 03:08:48', 'Trial', 'complete', 0, NULL, 1, NULL, NULL, NULL, '2025-07-27 03:08:48', '2025-07-27 03:08:48'),
(147, 121, NULL, NULL, NULL, NULL, 10, 0, 20, NULL, '2025-08-26 03:09:31', 'Trial', 'complete', 0, NULL, 1, NULL, NULL, NULL, '2025-07-27 03:09:31', '2025-07-27 03:09:31'),
(148, 122, NULL, NULL, NULL, NULL, 10, 0, 20, NULL, '2025-08-26 07:09:39', 'Trial', 'complete', 0, NULL, 1, NULL, NULL, NULL, '2025-07-27 07:09:39', '2025-07-27 07:09:39'),
(149, 124, NULL, NULL, NULL, NULL, 10, 0, 20, NULL, '2025-08-27 17:35:34', 'Trial', 'complete', 0, NULL, 1, NULL, NULL, NULL, '2025-07-28 17:35:34', '2025-07-28 17:35:34'),
(150, 5, NULL, NULL, NULL, NULL, 10, 0, 20, NULL, '2025-09-02 04:52:13', 'iyzipay', NULL, 0, NULL, 0, NULL, NULL, NULL, '2025-08-03 04:52:13', '2025-08-03 04:52:13'),
(151, 127, NULL, NULL, NULL, NULL, 10, 0, 20, NULL, '2025-09-03 02:59:03', 'Trial', 'complete', 0, NULL, 1, NULL, NULL, NULL, '2025-08-04 02:59:03', '2025-08-04 02:59:03'),
(152, 128, NULL, NULL, NULL, NULL, 10, 0, 20, NULL, '2025-09-03 03:09:07', 'Trial', 'complete', 0, NULL, 1, NULL, NULL, NULL, '2025-08-04 03:09:07', '2025-08-04 03:09:07'),
(153, 129, NULL, NULL, NULL, NULL, 10, 0, 20, NULL, '2025-09-06 06:10:55', 'Trial', 'complete', 0, NULL, 1, NULL, NULL, NULL, '2025-08-07 06:10:55', '2025-08-07 06:10:55'),
(154, 5, NULL, NULL, NULL, NULL, 7, 60, 23, NULL, '2025-09-24 17:12:25', 'wallet', 'complete', 0, NULL, 1, NULL, NULL, NULL, '2025-08-25 17:12:25', '2025-08-25 17:12:25'),
(155, 5, NULL, NULL, NULL, NULL, 2, 110, 60, NULL, '2026-08-25 17:12:49', 'paypal', NULL, 0, NULL, 0, NULL, NULL, NULL, '2025-08-25 17:12:49', '2025-08-25 17:12:49'),
(156, 130, NULL, NULL, NULL, NULL, 10, 0, 20, NULL, '2025-09-27 02:58:19', 'Trial', 'complete', 0, NULL, 1, NULL, NULL, NULL, '2025-08-28 02:58:19', '2025-08-28 02:58:19');

-- --------------------------------------------------------

--
-- Table structure for table `user_works`
--

CREATE TABLE `user_works` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `category_id` bigint NOT NULL,
  `sub_category_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_works`
--

INSERT INTO `user_works` (`id`, `user_id`, `category_id`, `sub_category_id`, `created_at`, `updated_at`) VALUES
(1, 5, 3, 6, '2025-02-12 06:09:10', '2025-09-16 22:52:25'),
(2, 3, 4, 6, '2025-05-17 01:38:56', '2025-09-18 01:02:37'),
(7, 4, 1, 1, '2025-09-01 23:18:58', '2025-09-01 23:18:58'),
(8, 1, 1, 24, '2025-09-22 23:34:12', '2025-09-22 23:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `balance` double NOT NULL,
  `remaining_balance` double NOT NULL DEFAULT '0',
  `withdraw_amount` double NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `balance`, `remaining_balance`, `withdraw_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 173, 140, 0, 1, '2025-03-29 18:00:00', '2025-07-28 01:40:24'),
(2, 2, 120, 120, 0, 1, '2025-03-29 18:00:00', '2025-03-29 18:00:00'),
(3, 3, 1358, 1358, 0, 1, '2025-03-29 18:00:00', '2025-04-29 23:03:21'),
(4, 4, 1516, 1516, 0, 1, '2025-03-29 18:00:00', '2025-04-29 22:53:54'),
(5, 5, 747, 1137, 0, 1, '2025-03-29 18:00:00', '2025-08-25 17:12:25'),
(6, 101, 0, 0, 0, 1, '2025-04-20 23:22:01', '2025-04-20 23:22:01'),
(7, 102, 342.86, 342.86, 0, 1, '2025-04-21 00:15:37', '2025-04-29 22:10:45'),
(8, 9, 342.86, 342.86, 0, 1, '2025-04-21 00:15:37', '2025-04-29 22:10:45'),
(11, 8, 342.86, 342.86, 0, 1, '2025-04-21 00:15:37', '2025-04-29 22:10:45'),
(12, 10, 342.86, 342.86, 0, 1, '2025-04-21 00:15:37', '2025-04-29 22:10:45'),
(13, 11, 342.86, 342.86, 0, 1, '2025-04-21 00:15:37', '2025-04-29 22:10:45'),
(14, 6, 342.86, 342.86, 0, 1, '2025-04-21 00:15:37', '2025-04-29 22:10:45'),
(15, 7, 342.86, 342.86, 0, 1, '2025-04-21 00:15:37', '2025-04-29 22:10:45'),
(16, 111, 342.86, 342.86, 0, 1, '2025-04-21 00:15:37', '2025-04-29 22:10:45'),
(17, 112, 342.86, 342.86, 0, 1, '2025-04-21 00:15:37', '2025-04-29 22:10:45'),
(18, 113, 342.86, 342.86, 0, 1, '2025-04-21 00:15:37', '2025-04-29 22:10:45'),
(19, 114, 342.86, 342.86, 0, 1, '2025-04-21 00:15:37', '2025-04-29 22:10:45'),
(20, 115, 50, 0, 0, 1, '2025-07-14 04:01:59', '2025-07-14 21:39:31'),
(21, 116, 3634, 3634, 0, 1, '2025-07-14 05:42:00', '2025-07-14 21:59:35'),
(22, 118, 0, 0, 0, 1, '2025-07-25 04:53:56', '2025-07-25 04:53:56'),
(23, 119, 0, 0, 0, 1, '2025-07-26 03:46:24', '2025-07-26 03:46:24'),
(24, 120, 0, 0, 0, 1, '2025-07-27 03:08:48', '2025-07-27 03:08:48'),
(25, 121, 0, 0, 0, 1, '2025-07-27 03:09:31', '2025-07-27 03:09:31'),
(26, 122, 0, 0, 0, 1, '2025-07-27 07:09:39', '2025-07-27 07:09:39'),
(27, 123, 0, 0, 0, 1, '2025-07-28 00:54:21', '2025-07-28 00:54:21'),
(28, 124, 0, 0, 0, 1, '2025-07-28 17:35:34', '2025-07-28 17:35:34'),
(29, 125, 0, 0, 0, 1, '2025-07-30 10:53:44', '2025-07-30 10:53:44'),
(30, 126, 0, 0, 0, 1, '2025-07-31 21:26:41', '2025-07-31 21:26:41'),
(31, 127, 0, 0, 0, 1, '2025-08-04 02:59:03', '2025-08-04 02:59:03'),
(32, 128, 0, 0, 0, 1, '2025-08-04 03:09:07', '2025-08-04 03:09:07'),
(33, 129, 0, 0, 0, 1, '2025-08-07 06:10:55', '2025-08-07 06:10:55'),
(34, 130, 0, 0, 0, 1, '2025-08-28 02:58:19', '2025-08-28 02:58:19');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_histories`
--

CREATE TABLE `wallet_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `payment_gateway` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manual_payment_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1',
  `email_send` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet_histories`
--

INSERT INTO `wallet_histories` (`id`, `user_id`, `payment_gateway`, `payment_status`, `amount`, `transaction_id`, `manual_payment_image`, `status`, `email_send`, `created_at`, `updated_at`) VALUES
(175, 5, 'stripe', 'complete', 500, 'pi_3RKu9uEmGOuJLTMs0EyVu0Xz', '0', 1, NULL, '2025-05-03 22:28:01', '2025-05-03 22:28:15'),
(177, 5, 'xendit', 'complete', 400, '6816ee5c1cfd0b688466fd1c', '0', 1, NULL, '2025-05-03 22:34:35', '2025-05-03 22:34:55'),
(178, 5, 'manual_payment', 'pending', 300, NULL, 'manual_attachment_1746333319.png', 1, NULL, '2025-05-03 22:35:19', '2025-05-03 22:35:19'),
(179, 1, 'stripe', 'complete', 20, 'pi_3RiVx1EmGOuJLTMs1joTjO3G', '0', 1, NULL, '2025-07-08 01:27:39', '2025-07-08 01:28:32'),
(180, 5, 'paytabs', '', 50, NULL, '0', 1, NULL, '2025-07-25 11:41:03', '2025-07-25 11:41:03'),
(181, 5, 'iyzipay', '', 50, NULL, '0', 1, NULL, '2025-07-25 11:47:47', '2025-07-25 11:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

CREATE TABLE `widgets` (
  `id` bigint UNSIGNED NOT NULL,
  `widget_area` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `widget_order` int DEFAULT NULL,
  `widget_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `widget_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `widget_content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `widgets`
--

INSERT INTO `widgets` (`id`, `widget_area`, `widget_order`, `widget_location`, `widget_name`, `widget_content`, `created_at`, `updated_at`) VALUES
(13, NULL, 2, 'footer_one', 'AboutUsWidget', 'a:7:{s:2:\"id\";s:2:\"13\";s:11:\"widget_name\";s:13:\"AboutUsWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_one\";s:12:\"widget_order\";s:1:\"2\";s:5:\"title\";s:8:\"About Us\";s:9:\"menu_link\";a:2:{s:10:\"list_item_\";a:4:{i:0;s:5:\"About\";i:1;s:7:\"Contact\";i:2;s:14:\"Privacy Policy\";i:3;s:20:\"Terms and Conditions\";}s:4:\"url_\";a:4:{i:0;s:9:\"/about-us\";i:1;s:11:\"/contact-us\";i:2;s:15:\"/privacy-policy\";i:3;s:17:\"/terms-conditions\";}}}', '2023-10-31 05:11:20', '2025-07-20 03:14:14'),
(14, NULL, 1, 'footer_one', 'SocialAreaWidget', 'a:8:{s:2:\"id\";s:2:\"14\";s:11:\"widget_name\";s:16:\"SocialAreaWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_one\";s:12:\"widget_order\";s:1:\"1\";s:5:\"image\";s:3:\"465\";s:11:\"description\";s:84:\"An influencer is someone who shapes others\' decisions through their online presence.\";s:11:\"social_icon\";a:2:{s:5:\"icon_\";a:5:{i:0;s:17:\"fab fa-facebook-f\";i:1;s:16:\"fab fa-instagram\";i:2;s:14:\"fab fa-youtube\";i:3;s:16:\"far fa-thumbs-up\";i:4;s:21:\"fab fa-twitter-square\";}s:4:\"url_\";a:5:{i:0;s:1:\"#\";i:1;s:1:\"#\";i:2;s:1:\"#\";i:3;s:1:\"#\";i:4;s:1:\"#\";}}}', '2023-10-31 05:34:22', '2025-07-17 04:06:01'),
(17, NULL, 3, 'copyright', 'CopyrightWidget', 'a:6:{s:2:\"id\";s:2:\"17\";s:11:\"widget_name\";s:15:\"CopyrightWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:9:\"copyright\";s:12:\"widget_order\";s:1:\"3\";s:5:\"title\";s:40:\"© 2025  Influencer  All Rights reserved\";}', '2023-10-31 06:43:31', '2025-07-20 03:14:48'),
(18, NULL, 2, 'footer_two', 'ContactUsTwoWidget', 'a:8:{s:2:\"id\";s:2:\"18\";s:11:\"widget_name\";s:18:\"ContactUsTwoWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_two\";s:12:\"widget_order\";s:1:\"1\";s:5:\"title\";s:10:\"Contact Us\";s:11:\"description\";s:70:\"Amet minim mollit non deserunt ullamco est sit ali dolor do amet sint.\";s:12:\"contact_info\";a:2:{s:5:\"icon_\";a:2:{i:0;s:12:\"fas fa-phone\";i:1;s:15:\"fas fa-envelope\";}s:5:\"info_\";a:2:{i:0;s:29:\"Have a question? 310-437-2766\";i:1;s:35:\"Have a question? unreal@example.com\";}}}', '2023-10-31 07:26:30', '2024-01-17 01:26:02'),
(19, NULL, 3, 'footer_two', 'AboutUsWidget', 'a:7:{s:2:\"id\";s:2:\"19\";s:11:\"widget_name\";s:13:\"AboutUsWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_two\";s:12:\"widget_order\";s:1:\"2\";s:5:\"title\";s:8:\"About Us\";s:9:\"menu_link\";a:2:{s:10:\"list_item_\";a:5:{i:0;s:5:\"About\";i:1;s:7:\"Contact\";i:2;s:14:\"Privacy Policy\";i:3;s:20:\"Terms and Conditions\";i:4;s:20:\"Terms and Conditions\";}s:4:\"url_\";a:5:{i:0;s:1:\"#\";i:1;s:1:\"#\";i:2;s:1:\"#\";i:3;s:1:\"#\";i:4;s:1:\"#\";}}}', '2023-10-31 07:33:39', '2024-01-17 01:26:02'),
(20, NULL, 4, 'footer_two', 'ServiceWidget', 'a:9:{s:2:\"id\";s:2:\"20\";s:11:\"widget_name\";s:13:\"ServiceWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_two\";s:12:\"widget_order\";s:1:\"3\";s:5:\"title\";s:8:\"Services\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"5\";}', '2023-10-31 07:35:30', '2024-01-17 01:26:02'),
(21, NULL, 5, 'footer_two', 'NewsLetterWidget', 'a:7:{s:2:\"id\";s:2:\"21\";s:11:\"widget_name\";s:16:\"NewsLetterWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_two\";s:12:\"widget_order\";s:1:\"4\";s:5:\"title\";s:20:\"Subscribe Newsletter\";s:11:\"description\";s:81:\"Enter your email to receive regular updates, newsletters. We promise to not spam.\";}', '2023-10-31 07:41:26', '2024-01-17 01:26:02'),
(27, NULL, 3, 'footer_one', 'AdvertiserWidget', 'a:7:{s:2:\"id\";s:2:\"27\";s:11:\"widget_name\";s:16:\"AdvertiserWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_one\";s:12:\"widget_order\";s:1:\"3\";s:5:\"title\";s:10:\"Advertiser\";s:9:\"menu_link\";a:2:{s:10:\"list_item_\";a:4:{i:0;s:18:\"Join as Advertiser\";i:1;s:7:\"Pricing\";i:2;s:16:\"Find Influencers\";i:3;s:11:\"Book a Demo\";}s:4:\"url_\";a:4:{i:0;s:14:\"/user-register\";i:1;s:18:\"/subscriptions/all\";i:2;s:12:\"/talents/all\";i:3;s:11:\"/contact-us\";}}}', '2025-06-23 03:19:55', '2025-07-20 03:14:27');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_gateways`
--

CREATE TABLE `withdraw_gateways` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `field` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=active, 2=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraw_gateways`
--

INSERT INTO `withdraw_gateways` (`id`, `name`, `field`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bank', 'a:3:{i:0;s:9:\"Bank Name\";i:1;s:10:\"Swift Code\";i:2;s:14:\"Account Number\";}', 1, '2023-10-16 02:31:37', '2023-10-16 04:24:26'),
(4, 'Paypal', 'a:4:{i:0;s:12:\"Account Name\";i:1;s:14:\"Account Number\";i:2;s:12:\"Account Type\";i:3;s:10:\"Account Id\";}', 1, '2023-10-16 04:17:18', '2023-10-16 04:20:51');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_requests`
--

CREATE TABLE `withdraw_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `gateway_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=pending, 2=complete, 3=cancel',
  `gateway_fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE `words` (
  `id` bigint UNSIGNED NOT NULL,
  `word` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`id`, `word`, `status`, `created_at`, `updated_at`) VALUES
(1, '@email', 'active', '2024-05-16 04:26:53', '2024-05-16 04:26:53'),
(2, 'account number', 'active', '2024-05-16 04:27:39', '2024-05-16 05:49:49');

-- --------------------------------------------------------

--
-- Table structure for table `xg_ftp_infos`
--

CREATE TABLE `xg_ftp_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `item_version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_license_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_license_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_license_msg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xg_payment_meta`
--

CREATE TABLE `xg_payment_meta` (
  `id` bigint UNSIGNED NOT NULL,
  `gateway` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `meta_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `session_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `track` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` bigint UNSIGNED NOT NULL DEFAULT '0' COMMENT '0=pending,1=complete,2=cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_comments_blog_post_id_foreign` (`blog_post_id`),
  ADD KEY `blog_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_users`
--
ALTER TABLE `category_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_notifications`
--
ALTER TABLE `client_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experience_levels`
--
ALTER TABLE `experience_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_builders`
--
ALTER TABLE `form_builders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `freelancer_levels`
--
ALTER TABLE `freelancer_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `freelancer_level_rules`
--
ALTER TABLE `freelancer_level_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `freelancer_notifications`
--
ALTER TABLE `freelancer_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `identity_verifications`
--
ALTER TABLE `identity_verifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `individual_commission_settings`
--
ALTER TABLE `individual_commission_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_histories`
--
ALTER TABLE `job_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_posts`
--
ALTER TABLE `job_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_posts_category_index` (`category`);

--
-- Indexes for table `job_post_skills`
--
ALTER TABLE `job_post_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_post_skills_job_post_id_skill_id_index` (`job_post_id`,`skill_id`);

--
-- Indexes for table `job_post_sub_categories`
--
ALTER TABLE `job_post_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_post_sub_categories_job_post_id_sub_category_id_index` (`job_post_id`,`sub_category_id`);

--
-- Indexes for table `job_proposals`
--
ALTER TABLE `job_proposals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lengths`
--
ALTER TABLE `lengths`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_chats`
--
ALTER TABLE `live_chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_chat_messages`
--
ALTER TABLE `live_chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `live_chat_messages_live_chat_id_foreign` (`live_chat_id`);

--
-- Indexes for table `log_activities`
--
ALTER TABLE `log_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_uploads`
--
ALTER TABLE `media_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meta_data`
--
ALTER TABLE `meta_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `newsletters_email_unique` (`email`);

--
-- Indexes for table `news_letter_for_emails`
--
ALTER TABLE `news_letter_for_emails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_letter_for_emails_email_unique` (`email`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer_milestones`
--
ALTER TABLE `offer_milestones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_decline_histories`
--
ALTER TABLE `order_decline_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_decline_wallet_histories`
--
ALTER TABLE `order_decline_wallet_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_milestones`
--
ALTER TABLE `order_milestones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_request_revisions`
--
ALTER TABLE `order_request_revisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_screenshots`
--
ALTER TABLE `order_screenshots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_submit_histories`
--
ALTER TABLE `order_submit_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_work_histories`
--
ALTER TABLE `order_work_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_builders`
--
ALTER TABLE `page_builders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_attributes`
--
ALTER TABLE `project_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_histories`
--
ALTER TABLE `project_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_promote_settings`
--
ALTER TABLE `project_promote_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_sub_categories`
--
ALTER TABLE `project_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotion_project_lists`
--
ALTER TABLE `promotion_project_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_answers`
--
ALTER TABLE `question_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_details`
--
ALTER TABLE `rating_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_profiles`
--
ALTER TABLE `social_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_options`
--
ALTER TABLE `static_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_features`
--
ALTER TABLE `subscription_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_types`
--
ALTER TABLE `subscription_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category_users`
--
ALTER TABLE `sub_category_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `user_earnings`
--
ALTER TABLE `user_earnings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_education`
--
ALTER TABLE `user_education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_experiences`
--
ALTER TABLE `user_experiences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_introductions`
--
ALTER TABLE `user_introductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_langs`
--
ALTER TABLE `user_langs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_skills`
--
ALTER TABLE `user_skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_works`
--
ALTER TABLE `user_works`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_histories`
--
ALTER TABLE `wallet_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `widgets`
--
ALTER TABLE `widgets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_gateways`
--
ALTER TABLE `withdraw_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `words`
--
ALTER TABLE `words`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xg_ftp_infos`
--
ALTER TABLE `xg_ftp_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xg_payment_meta`
--
ALTER TABLE `xg_payment_meta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `category_users`
--
ALTER TABLE `category_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `client_notifications`
--
ALTER TABLE `client_notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `experience_levels`
--
ALTER TABLE `experience_levels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `form_builders`
--
ALTER TABLE `form_builders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `freelancer_levels`
--
ALTER TABLE `freelancer_levels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `freelancer_level_rules`
--
ALTER TABLE `freelancer_level_rules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `freelancer_notifications`
--
ALTER TABLE `freelancer_notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `identity_verifications`
--
ALTER TABLE `identity_verifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `individual_commission_settings`
--
ALTER TABLE `individual_commission_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `job_histories`
--
ALTER TABLE `job_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_posts`
--
ALTER TABLE `job_posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `job_post_skills`
--
ALTER TABLE `job_post_skills`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `job_post_sub_categories`
--
ALTER TABLE `job_post_sub_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `job_proposals`
--
ALTER TABLE `job_proposals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `lengths`
--
ALTER TABLE `lengths`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `live_chats`
--
ALTER TABLE `live_chats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `live_chat_messages`
--
ALTER TABLE `live_chat_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_activities`
--
ALTER TABLE `log_activities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media_uploads`
--
ALTER TABLE `media_uploads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=470;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `meta_data`
--
ALTER TABLE `meta_data`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_letter_for_emails`
--
ALTER TABLE `news_letter_for_emails`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offer_milestones`
--
ALTER TABLE `offer_milestones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_decline_histories`
--
ALTER TABLE `order_decline_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_decline_wallet_histories`
--
ALTER TABLE `order_decline_wallet_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_milestones`
--
ALTER TABLE `order_milestones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_request_revisions`
--
ALTER TABLE `order_request_revisions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_screenshots`
--
ALTER TABLE `order_screenshots`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_submit_histories`
--
ALTER TABLE `order_submit_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_work_histories`
--
ALTER TABLE `order_work_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `page_builders`
--
ALTER TABLE `page_builders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- AUTO_INCREMENT for table `project_attributes`
--
ALTER TABLE `project_attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2817;

--
-- AUTO_INCREMENT for table `project_histories`
--
ALTER TABLE `project_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_promote_settings`
--
ALTER TABLE `project_promote_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `project_sub_categories`
--
ALTER TABLE `project_sub_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=440;

--
-- AUTO_INCREMENT for table `promotion_project_lists`
--
ALTER TABLE `promotion_project_lists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_answers`
--
ALTER TABLE `question_answers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating_details`
--
ALTER TABLE `rating_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `social_profiles`
--
ALTER TABLE `social_profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `static_options`
--
ALTER TABLE `static_options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=583;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subscription_features`
--
ALTER TABLE `subscription_features`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=499;

--
-- AUTO_INCREMENT for table `subscription_types`
--
ALTER TABLE `subscription_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `sub_category_users`
--
ALTER TABLE `sub_category_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `user_earnings`
--
ALTER TABLE `user_earnings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_education`
--
ALTER TABLE `user_education`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_experiences`
--
ALTER TABLE `user_experiences`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_introductions`
--
ALTER TABLE `user_introductions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_langs`
--
ALTER TABLE `user_langs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_skills`
--
ALTER TABLE `user_skills`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `user_works`
--
ALTER TABLE `user_works`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `wallet_histories`
--
ALTER TABLE `wallet_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `widgets`
--
ALTER TABLE `widgets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `withdraw_gateways`
--
ALTER TABLE `withdraw_gateways`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `words`
--
ALTER TABLE `words`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `xg_ftp_infos`
--
ALTER TABLE `xg_ftp_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `xg_payment_meta`
--
ALTER TABLE `xg_payment_meta`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD CONSTRAINT `blog_comments_blog_post_id_foreign` FOREIGN KEY (`blog_post_id`) REFERENCES `blog_posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blog_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `live_chat_messages`
--
ALTER TABLE `live_chat_messages`
  ADD CONSTRAINT `live_chat_messages_live_chat_id_foreign` FOREIGN KEY (`live_chat_id`) REFERENCES `live_chats` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
