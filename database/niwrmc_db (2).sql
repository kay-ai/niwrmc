-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 01:00 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `niwrmc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `amendment_of_license_forms`
--

CREATE TABLE `amendment_of_license_forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `applicant_full_name` varchar(255) NOT NULL,
  `applicant_contact_address` varchar(255) NOT NULL,
  `applicant_email` varchar(255) NOT NULL,
  `applicant_website` varchar(255) NOT NULL,
  `contact_full_name` varchar(255) NOT NULL,
  `contact_contact_address` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_website` varchar(255) NOT NULL,
  `type_of_existing_license` varchar(255) NOT NULL,
  `license_number` varchar(255) NOT NULL,
  `expiration_date` varchar(255) NOT NULL,
  `has_applicant_been_refused_license` varchar(255) NOT NULL,
  `details_of_applicant_refusal` varchar(255) DEFAULT NULL,
  `does_area_of_business_operation_cover_ministry_building` varchar(255) NOT NULL,
  `have_you_applied_previously_for_amendment` varchar(255) NOT NULL,
  `previous_has_applicant_been_refused_license` varchar(255) NOT NULL,
  `previous_details_of_applicant_refusal` varchar(255) DEFAULT NULL,
  `terms_for_proposed_amendment` varchar(255) NOT NULL,
  `reasons_for_proposed_amendment` varchar(255) NOT NULL,
  `other_relevant_information` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `application_documents`
--

CREATE TABLE `application_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `application_id` int(11) NOT NULL,
  `application_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application_documents`
--

INSERT INTO `application_documents` (`id`, `name`, `url`, `customer_id`, `application_id`, `application_name`, `created_at`, `updated_at`) VALUES
(4, 'Partnership Document', 'documents/Blank License_1715251100.pptx', 10, 1, 'Drilling License', '2024-05-09 09:38:20', '2024-05-09 09:38:20'),
(5, 'EIA Certification', 'documents/Alfresco EDMS System_1715251126.pptx', 10, 1, 'Drilling License', '2024-05-09 09:38:46', '2024-05-09 09:38:46'),
(6, 'NSITF/ITF', 'documents/Alfresco EDMS System_1715254021.pptx', 10, 1, 'Drilling License', '2024-05-09 10:27:01', '2024-05-09 10:27:01'),
(7, 'Form CA7 of CAC', 'documents/BLU QUARRY LOGO 3_1715258298.png', 10, 1, 'Drilling License', '2024-05-09 11:38:18', '2024-05-09 11:38:18'),
(8, 'EIA Certification', 'documents/about_us_img-removebg-preview_1715259428.png', 10, 2, 'Drilling License', '2024-05-09 11:57:08', '2024-05-09 11:57:08'),
(9, 'EIA Certification', 'documents/about_us_img_1715259737.jpg', 10, 2, 'Drilling License', '2024-05-09 12:02:17', '2024-05-09 12:02:17'),
(10, 'PENCOM Certification', 'documents/about_us_img_1715265042.jpg', 10, 5, 'Discharge Of Waste Water', '2024-05-09 13:30:43', '2024-05-09 13:30:43');

-- --------------------------------------------------------

--
-- Table structure for table `application_forms`
--

CREATE TABLE `application_forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','approved') DEFAULT 'pending',
  `stage` enum('step1','step2','step3','step4','step5','step6','step7') DEFAULT 'step1',
  `application_slug` varchar(255) DEFAULT NULL,
  `business_name` varchar(255) NOT NULL,
  `business_location` varchar(255) NOT NULL,
  `business_postal_address` varchar(255) DEFAULT NULL,
  `business_phone_number` varchar(255) NOT NULL,
  `business_mobile_number` varchar(255) DEFAULT NULL,
  `business_email` varchar(255) NOT NULL,
  `business_website` varchar(255) DEFAULT NULL,
  `legal_status` varchar(255) DEFAULT NULL,
  `shareholders_criminal_status` varchar(255) DEFAULT NULL,
  `shareholders_criminal_status_details` varchar(255) DEFAULT NULL,
  `directors_criminal_status` varchar(255) DEFAULT NULL,
  `directors_criminal_status_details` varchar(255) DEFAULT NULL,
  `license_sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `existing_license` varchar(255) DEFAULT NULL,
  `existing_license_details` varchar(255) DEFAULT NULL,
  `own_10_share_of_another_licensed_entity` varchar(255) DEFAULT NULL,
  `share_licensed_entity_details` varchar(255) DEFAULT NULL,
  `has_applicant_been_denied_suspended_cancelled` varchar(255) DEFAULT NULL,
  `denied_suspended_cancelled_details` varchar(255) DEFAULT NULL,
  `share_capital_of_applicant_authorized` varchar(255) DEFAULT NULL,
  `share_capital_of_applicant_fully_paid` varchar(255) DEFAULT NULL,
  `certified_financial_statements_url` varchar(255) DEFAULT NULL,
  `source_of_funding_share_capital` varchar(255) DEFAULT NULL,
  `source_of_funding_loan_capital` varchar(255) DEFAULT NULL,
  `source_of_funding_others` varchar(255) DEFAULT NULL,
  `main_business_activity_of_applicant` varchar(255) DEFAULT NULL,
  `technical_capacity_of_applicant` longtext DEFAULT NULL,
  `managerial_competence_of_applicant` longtext DEFAULT NULL,
  `technical_support_from_foreign_sources` longtext DEFAULT NULL,
  `technical_support_from_domestic_sources` longtext DEFAULT NULL,
  `description_of_proposed_project` longtext DEFAULT NULL,
  `initial_capacity_of_project` varchar(255) DEFAULT NULL,
  `proposed_future_capacity_of_project` varchar(255) DEFAULT NULL,
  `implementation_schedule_of_project` varchar(255) DEFAULT NULL,
  `present_land_use_at_project_site` varchar(255) DEFAULT NULL,
  `is_there_access_to_public_private_land` varchar(255) DEFAULT NULL,
  `does_area_of_business_operation_cover_defense_ministry` varchar(255) DEFAULT NULL,
  `does_area_of_business_operation_cover_river_basin_DA_land` varchar(255) DEFAULT NULL,
  `environmental_impact_of_project` longtext DEFAULT NULL,
  `geographic_area_license_is_required` longtext DEFAULT NULL,
  `declaration_by_applicant_that_info_is_true` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application_forms`
--

INSERT INTO `application_forms` (`id`, `customer_id`, `status`, `stage`, `application_slug`, `business_name`, `business_location`, `business_postal_address`, `business_phone_number`, `business_mobile_number`, `business_email`, `business_website`, `legal_status`, `shareholders_criminal_status`, `shareholders_criminal_status_details`, `directors_criminal_status`, `directors_criminal_status_details`, `license_sub_category_id`, `existing_license`, `existing_license_details`, `own_10_share_of_another_licensed_entity`, `share_licensed_entity_details`, `has_applicant_been_denied_suspended_cancelled`, `denied_suspended_cancelled_details`, `share_capital_of_applicant_authorized`, `share_capital_of_applicant_fully_paid`, `certified_financial_statements_url`, `source_of_funding_share_capital`, `source_of_funding_loan_capital`, `source_of_funding_others`, `main_business_activity_of_applicant`, `technical_capacity_of_applicant`, `managerial_competence_of_applicant`, `technical_support_from_foreign_sources`, `technical_support_from_domestic_sources`, `description_of_proposed_project`, `initial_capacity_of_project`, `proposed_future_capacity_of_project`, `implementation_schedule_of_project`, `present_land_use_at_project_site`, `is_there_access_to_public_private_land`, `does_area_of_business_operation_cover_defense_ministry`, `does_area_of_business_operation_cover_river_basin_DA_land`, `environmental_impact_of_project`, `geographic_area_license_is_required`, `declaration_by_applicant_that_info_is_true`, `created_at`, `updated_at`) VALUES
(1, 10, 'pending', 'step7', 'drilling-license', 'Lucas Rose', 'Ex quo reprehenderit', 'Ipsum in quae modi d', '+1 (778) 726-7346', '239', 'zulawaw@mailinator.com', 'https://www.zuje.com', 'Partnership', NULL, NULL, NULL, NULL, 1, 'no', 'Veniam veritatis al', 'no', 'Accusantium dolorem', 'no', 'Elit dolorem accusa', 'Maiores ex officiis', 'Facere minim dolorem', NULL, 'Rerum exercitationem', 'Quia dicta id vel a', 'Facilis eaque omnis', 'Autem in quasi do et', 'Exercitationem minim', 'Ullamco quia quis fa', 'Neque quia eveniet', 'Maiores placeat iru', 'Delectus quae omnis', 'Consequuntur ducimus', 'Ad et quos id impedi', 'In explicabo Sapien', NULL, 'Aut accusantium assu', 'yes', 'yes', 'Culpa adipisicing i', 'Non atque numquam qu', 'I Agree', '2024-05-09 08:36:55', '2024-05-09 12:02:17'),
(2, 10, 'pending', 'step7', 'drilling-license', 'Lucas Rose', 'Ex quo reprehenderit', 'Ipsum in quae modi d', '+1 (778) 726-7346', '239', 'zulawaw@mailinator.com', 'https://www.zuje.com', 'Partnership', NULL, NULL, NULL, NULL, 1, 'no', 'Veniam veritatis al', 'no', 'Accusantium dolorem', 'no', 'Elit dolorem accusa', 'Maiores ex officiis', 'Facere minim dolorem', NULL, 'Rerum exercitationem', 'Quia dicta id vel a', 'Facilis eaque omnis', 'Autem in quasi do et', 'Exercitationem minim', 'Ullamco quia quis fa', 'Neque quia eveniet', 'Maiores placeat iru', 'Delectus quae omnis', 'Consequuntur ducimus', 'Ad et quos id impedi', 'In explicabo Sapien', NULL, 'Aut accusantium assu', 'yes', 'yes', 'Culpa adipisicing i', 'Non atque numquam qu', 'I Agree', '2024-05-09 11:49:24', '2024-05-09 12:01:28'),
(5, 10, 'pending', 'step3', 'discharge-of-waste-water', 'Caesar Lynn', 'Minima consequat No', 'Dolor et odit eos po', '+1 (342) 459-6004', '301', 'lapaw@mailinator.com', 'https://www.wepocuxutiz.com', 'Partnership', NULL, NULL, NULL, NULL, 2, 'no', 'Vel explicabo Qui a', 'no', 'Lorem qui accusantiu', 'yes', 'Aliquid et ut labore', 'Ut dolorem provident', 'Maiores aute ut pari', NULL, 'Aspernatur quod maio', 'Magnam itaque molest', 'Harum sunt animi su', 'Odio qui cillum amet', 'Excepturi quos cupid', 'Earum voluptas cupid', 'Aperiam exercitation', 'Et perferendis lorem', 'Fuga Sunt in volupt', 'Eiusmod cupiditate i', 'Reiciendis aliqua V', 'Dolore nostrum quam', NULL, 'Laborum Amet dolor', 'no', 'yes', 'Eaque sed dolorum eo', 'Recusandae Exceptur', 'I Agree', '2024-05-09 13:25:48', '2024-05-09 13:31:38');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `other_names` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `passport` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `other_names`, `phone`, `address`, `passport`, `email`, `email_verified_at`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Steve', 'Arnaldi', 'psykhologgme', '86939873147', 'https://batmanapollo.ru', NULL, 'p4590viakn@hphd.store', NULL, '$2y$10$FCio2X.5a5oxckq34EvQC.A8wdZhUCXdaKsJK2wo2DTXM6JOQeKi6', '2023-12-20 20:30:53', '2023-12-20 20:30:53'),
(2, 'asa', 'Jake', 'sa', '0501234578', 'asasa', NULL, 'saalamm2211@gmail.com', NULL, '$2y$10$CmXM6Cl/6bah2UDz1q7N.OYNAN.YUj4Tvq2432Gq8/Qj/qE.usO2a', '2024-02-25 22:54:17', '2024-02-25 22:54:17'),
(3, 'Chukwubuike', 'Nnaeto', 'Onwuzurumba', '08035450670', '4th Floor, Murjanatu House, 1 Zambezi Crescent off Aguyi Ironsi Street, Maitama Abuja', NULL, 'cnnaeto@oakelegal.com', NULL, '$2y$10$Cfi0LAnoX/KaHnzYoZ1Oc.213e5SaU49JA20edISO1gwrOsvffue2', '2024-02-26 20:34:18', '2024-02-26 20:34:18'),
(4, 'femi', 'micheal', 'tayo', '08099283707', 'central area abuja', NULL, 'sleem1051977@gmail.com', '2024-02-27 13:26:58', '$2y$10$h03tfx6YF9.waUAj7h7AaeipupMkV08CVzlkpSTfAGgs3PSSJls86', '2024-02-27 18:26:58', '2024-02-27 18:26:58'),
(5, 'Mohammed', 'Nasara', 'Abdu', '08067571999', '24 Raji Quarters, Bauchi', NULL, 'mohammad.nasara@gmail.com', NULL, '$2y$10$n9wMMi4XuZVbDX5UTviYtOOTLY3DiC5zoFGaMlmfaVWo94/WyfJwO', '2024-03-06 07:01:16', '2024-03-06 07:01:16'),
(6, 'Emmanuel', 'Okona', 'Obumumneme', '09046205639', '27 Fatai Idowu, Arobioke Street, Lekki Phase 1 Lagos, Nigeria', NULL, 'emmanuelokona24@gmail.com', NULL, '$2y$10$k6SFfvaHjlv7kyadsxwIk.PiE8et90rYa60ibRlxyZnz5bMueA8Ee', '2024-03-23 13:27:01', '2024-03-23 13:27:01'),
(8, 'Favour', 'Obasi', NULL, '09053143790', 'No. 4 High Court Rd Kuje Abuja', 'passports/passport_1713865222.png', 'favourobasi6@gmail.com', '2024-02-27 13:26:58', '$2y$12$tvkHKTZODU0rgRnDlDqY9eqhMACPgG0JYW7RIvUDL6PwBmm0taNUu', '2024-03-28 08:45:11', '2024-04-23 08:40:22'),
(9, 'Davis', 'Mathis', 'Pamela Franks', '+1 (325) 536-7847', 'Aliquid laboris aute', NULL, 'fodisymuc@mailinator.com', '2024-05-09 02:49:41', '$2y$10$VpUsab2syfPVPKM5iuyl3e/S5IPFRejtvPqzFUTmVWacXTsjT2NzC', '2024-05-09 01:49:41', '2024-05-09 01:49:41'),
(10, 'Cassady', 'Michael', 'Travis Stuart', '+1 (464) 898-7402', 'Aliquid eveniet inc', 'passports/passport_1715248515.jpg', 'test@gmail.com', '2024-05-09 09:35:21', '$2y$10$qomg91olpm1B.ajpjJmkYu3Rs9KciBcX9ntYag738GyZh0WJhRQfW', '2024-05-09 08:35:21', '2024-05-09 08:55:16');

-- --------------------------------------------------------

--
-- Table structure for table `email_tokens`
--

CREATE TABLE `email_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_tokens`
--

INSERT INTO `email_tokens` (`id`, `email`, `token`, `created_at`, `updated_at`) VALUES
(1, 'favourobasi6@gmail.com', 'UH8jOXXtWoQxFNZQoaXjpYLgXfWouaPJJOzVyowlMbWvw6UuRwqpqH78Mvs1JaLw', '2023-10-27 17:41:46', '2023-10-27 17:41:46'),
(2, 'favourobasi7@gmail.com', 'EtLpECBzmfbzP6pd8SsuEAfHGMgzIEHKoAqm13NttctHsE2DiWPIWjKJMzkgKre7', '2023-10-27 18:20:55', '2023-10-27 18:20:55'),
(3, 'wixipekyjo@mailinator.com', '2YKmqN3uZWOefLZltAxiQN2XD8Od16BAv7ZKV7KjSXEL23YylHMkLz88U4WtWriP', '2023-10-29 09:11:59', '2023-10-29 09:11:59'),
(4, 'requvitifi@mailinator.com', 'WldPFemCpUT8pVKiNUXCgww6I6XSNdyvt7dei2FsD7YabTQAzEp2lMGv2y8qZ5Ta', '2023-10-29 09:23:39', '2023-10-29 09:23:39'),
(5, 'myvof@mailinator.com', 'JkG45LJFRRB48AoEXjvJQLb9yvlR00Z9OAQaVATVptBYxFKnknoxO2Fz4vCJUfuW', '2023-10-29 13:02:30', '2023-10-29 13:02:30'),
(6, 'zasalebeby@mailinator.com', '7MpJWn7GksU5q9jFFiFXTJpS0AND9aCNPWoMaqmKRxh27c2AFgHuA6RvOeXzAFmD', '2023-10-29 15:21:10', '2023-10-29 15:21:10'),
(7, 'diry@mailinator.com', 'CycGScsIUlqOkzQKbKGtBFCahzVBDmsFu7ZBYg35lvLHmPZfmLgNtZjSyf18C42u', '2023-10-29 16:21:00', '2023-10-29 16:21:00'),
(8, 'rotudupa@mailinator.com', 'dkPQh3IrDe4YyHg7slZnzO6IwJSzTLe492A2SBfIgPFYyIhJ7aRSA7vPEnpPbsyF', '2023-10-29 17:14:58', '2023-10-29 17:14:58'),
(9, 'qawuhafe@mailinator.com', 'aYM8lNpNUrEm1PkkUcWCr0jOI7kVBr6pPrPDiTMjdhzlzN13QpaxFizKwLvsCtXP', '2023-10-29 21:55:09', '2023-10-29 21:55:09'),
(10, 'dusywul@mailinator.com', 'oIFU5XZRv2faOQY6VDmBT8dXWBMaq1ouQEziYkKQZRAvUGieFr9nS0C7tmmqu3Hi', '2023-10-30 09:32:49', '2023-10-30 09:32:49'),
(11, 'kybanygew@mailinator.com', 'RF0NpZ1oIC5Jg2gvdAYbKsaauJbMJmSe4Ua3AWWQRUcPWsVocieRAu6p2MELkqNh', '2023-10-30 09:33:26', '2023-10-30 09:33:26'),
(12, 'gonuteb@mailinator.com', 'uUXX3HBcKqUFgrsQzHS6Wk8VdX7UuCZTcYn5TrL2aUS0UYhs99V1hmSlcrRiBxTZ', '2023-10-30 10:39:22', '2023-10-30 10:39:22'),
(13, 'fafysaleb@mailinator.com', 'S87fsduZdnHLQaYeltfN9IxI9WyKeAOGU3wd05dYGHfucgYi1KlmLti7v7RfRxCH', '2023-10-30 14:03:26', '2023-10-30 14:03:26'),
(14, 'wyzymagiz@mailinator.com', 'YnnzhyOohA107uQYzVlC2mwOGzySHFdzrNFa1Db4SOY7SpUEpkyzarrN2O5kwihX', '2023-10-30 14:05:33', '2023-10-30 14:05:33'),
(15, 'jezow@mailinator.com', 'CJpbpx79WEQUEYHDllZZWxUX6oreSsGaiEoZj7aRtwsaX4yqypvRf3f7uVdl2i9k', '2023-10-30 14:06:48', '2023-10-30 14:06:48'),
(16, 'xiliban@mailinator.com', '9Okjq6TJdL6NdLyYaf7CkHJWEdH9ALxUkGSMFfoJZIvZ4WgPjnwrCi77CsShqJpq', '2023-10-31 12:05:21', '2023-10-31 12:05:21'),
(17, 'bapanimoz@mailinator.com', 'jG6rz3XLENKzj6ZXIUcuTbyE23ipc0UXukTF0fJ1O7BmhIUChdT3soFbMlOfGhWa', '2023-10-31 12:09:00', '2023-10-31 12:09:00'),
(18, 'vunazeku@mailinator.com', 'OxS0kwmcq7RdQ2iExdfTZbLMNIQRTdUleLGhXR4HZia6gQhE4vpEets93H3d2i64', '2023-10-31 12:32:13', '2023-10-31 12:32:13'),
(19, 'hiziqi@mailinator.com', 'EdR5dasdksTXWJwLOg3PcZqcLGKtUdXmXfq0Tk83Rzr2z7aTTFiynDQpjSnXCqT7', '2023-10-31 20:37:59', '2023-10-31 20:37:59'),
(20, 'bofa@mailinator.com', 'BNJR6C6QiO83ohUrF1ShPvNYJnbNmgY6mNzinrRSWm1CFFNaV6Dw0cwZ7KCHOEAc', '2023-10-31 20:49:08', '2023-10-31 20:49:08'),
(21, 'deteryja@mailinator.com', '985y59ym84xAMne4vEddWnIC9Qe0t91gNZlUjbFcI25sUYu7NJP5o3n8IzGWgZE5', '2023-11-02 10:38:33', '2023-11-02 10:38:33'),
(22, 'deteryja@mailinator.com', 'pv9qZElVmeH8hdRhuKKrBz8lPEQxS7p63axVZpDxPgrG6N45xwZlzlDBwCMmLzNw', '2023-11-02 12:06:18', '2023-11-02 12:06:18'),
(23, 'zexuz@mailinator.com', 'AaGBGUEnmHdB0LzWARJ5ZnhiPH1GhkqjeH91FsKcfzqG7PMAsHcncFLQA5J0OdJG', '2023-11-04 00:00:37', '2023-11-04 00:00:37'),
(24, 'zexuz@mailinator.com', 'E9xuy1HakQYpcEI8mI8gavRvi7JH9jk01w5NBaK1FmI6kgZ2MlWMk6CDFksf3Glm', '2023-11-04 00:01:24', '2023-11-04 00:01:24'),
(25, 'favourobasi6@gmail.com', 'C72wbShp5FVDktlw1zOWYzao4elaBhFT7dHd1TwqAQtGLilXHW6Rmc7BaaAgdZch', '2023-11-05 06:58:15', '2023-11-05 06:58:15'),
(26, 'osadare.yetunde@gmail.com', 'j8qaUkiI9dZv3P71aJOmJEhUZOdJ7C3JLnJ6imiWK8gygESXRXFqPeZviPzUo4CH', '2023-11-05 17:31:56', '2023-11-05 17:31:56'),
(27, 'rogyvi@mailinator.com', 'OPUpkfwfqeJuTlpaUTNtaSvXkoxJ1ycw3qIo4cYdZDrlxiJD3pslmeDfIRJLOuTE', '2023-11-07 11:49:29', '2023-11-07 11:49:29'),
(28, 'sadiq@niwrmc.com', 'otCQmWJ9BMGVxT4xEPevKyjXHGhU0TO1FLbMxHOCMBwTOVOrywK9BoNeI6Tp1piA', '2023-11-07 12:00:45', '2023-11-07 12:00:45'),
(29, 'posisy@mailinator.com', 'yxH90uMF1n9kV7CsrqNCWrLiOjeosyzyuUvsivExPzzlCoCe89l5CIgRPUAWrp3t', '2023-11-19 09:42:20', '2023-11-19 09:42:20'),
(30, 'fesonfg@gmail.com', 'Ez4mgVqVrUA478VPygt6SVAfPoO8skX5c9nGoficwnACuD1XZF0PLIhl82BDqpCp', '2023-11-20 10:39:27', '2023-11-20 10:39:27'),
(31, 'p4590viakn@hphd.store', 'cXlziIxwGO8W8Nvlj6iOosn65DOAIbPCc6X20LrQ6gbd2hefvp9Yg3KtynAVKSJM', '2023-12-20 20:30:53', '2023-12-20 20:30:53'),
(32, 'saalamm2211@gmail.com', 'Kz3wIXUWU3ZV9vbcEuuRNUfp5bNvanbLQ6dmJV5FFMh1mISAEQVwdeZFDVywwtUN', '2024-02-25 22:54:17', '2024-02-25 22:54:17'),
(33, 'cnnaeto@oakelegal.com', 'BNA6KvqLIGTImBkfkdDAI0GGbW4vqxWdKSiGwbjLFgfoWoJuCMMJs9wnsqSImazT', '2024-02-26 20:34:18', '2024-02-26 20:34:18'),
(34, 'sleem1051977@gmail.com', 'FOIbUPYYQVQWAifTRS2URGiUev8Ceg7rj43qfa8y4gFehjUlect9Vp1JCWQCG5Y5', '2024-02-27 18:26:58', '2024-02-27 18:26:58'),
(35, 'mohammad.nasara@gmail.com', 'OzVjeHgTDqXUA5LNVJZAd3O6sWmZ2mblIjsdbg10WuLvU3slSRMmGpsezJ0PQA1u', '2024-03-06 07:01:16', '2024-03-06 07:01:16'),
(36, 'emmanuelokona24@gmail.com', 'ApzgeWQc3PTmCr45jJLlDImKrG4dRE16k7ig3bDlKDDJF4X5e9XsuqHGNCfLqyWi', '2024-03-23 13:27:01', '2024-03-23 13:27:01'),
(37, 'favourobasi6@gmail.com', '3xEn0jItfrqMHTI5SWlM0yN2ZGyXLuOrkw3loIFv2LKsGArtkkMVjmBXTVOqNlZy', '2024-03-28 08:41:50', '2024-03-28 08:41:50'),
(38, 'favourobasi6@gmail.com', 'A3oUWHnuT2Pwxh0DzbcjZlaBIJc3Qi89NlDCGsYaPDURbctkxOGB9k2E0X5Th0rY', '2024-03-28 08:45:11', '2024-03-28 08:45:11'),
(39, 'fodisymuc@mailinator.com', 'U02vCR8FQdk3Vgpl9hDn86lrVsOIiJFyzSyPJhrWQ8m6MLxBPvH8t76bD66esvtq', '2024-05-09 01:49:41', '2024-05-09 01:49:41'),
(40, 'test@gmail.com', 'fGVmIQY8fUNVLBrTQH7YYqS3kCtaTByMXJyYk07dW6mIgj10IXcaFqapcT75bXpe', '2024-05-09 08:35:21', '2024-05-09 08:35:21');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `remita_rrr` varchar(255) DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `application_id` varchar(255) NOT NULL,
  `application_name` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `remita_rrr`, `customer_id`, `application_id`, `application_name`, `item`, `category`, `desc`, `amount`, `currency`, `status`, `created_at`, `updated_at`) VALUES
(1, '3608-3690-4977-8', 8, '1', 'discharge-of-waste', 'discharge-of-waste', 'processing_fee', NULL, '500000', 'NGN', 'unpaid', '2024-04-23 08:50:11', '2024-04-23 08:50:11'),
(2, '7075-9569-5502-10', 10, '1', 'drilling-license', 'Drilling License', 'processing_fee', NULL, '500000.00', 'NGN', 'paid', '2024-05-09 10:28:26', '2024-05-09 10:41:15'),
(3, '1187-7365-9386-10', 10, '1', 'drilling-license', 'Drilling License', 'licensing_fee', NULL, '1000000.00', 'NGN', 'paid', '2024-05-09 10:55:33', '2024-05-09 10:56:27'),
(4, '6490-8713-6887-10', 10, '5', 'discharge-of-waste-water', 'Discharge Of Waste Water', 'processing_fee', NULL, '600000.00', 'NGN', 'unpaid', '2024-05-09 13:31:38', '2024-05-09 13:31:38');

-- --------------------------------------------------------

--
-- Table structure for table `licenses`
--

CREATE TABLE `licenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `application_id` int(11) NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `license_type` varchar(255) NOT NULL,
  `license_holder` varchar(255) NOT NULL,
  `assigned_by_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `valid_period` int(11) DEFAULT NULL,
  `revalidate` varchar(255) DEFAULT NULL,
  `application_slug` varchar(255) DEFAULT NULL,
  `licensed_as` varchar(255) DEFAULT NULL,
  `hydrological_area` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `lga` varchar(255) DEFAULT NULL,
  `generated_at` date DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `signature_url` varchar(255) DEFAULT NULL,
  `reg_no` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `licenses`
--

INSERT INTO `licenses` (`id`, `customer_id`, `name`, `application_id`, `payment_id`, `license_type`, `license_holder`, `assigned_by_id`, `created_at`, `updated_at`, `valid_period`, `revalidate`, `application_slug`, `licensed_as`, `hydrological_area`, `state`, `lga`, `generated_at`, `company_address`, `signature_url`, `reg_no`) VALUES
(1, 10, 'Drilling License', 1, 3, 'licensing_fee', 'Lucas Rose', 1, '2024-05-09 11:05:29', '2024-05-09 11:10:49', 10, '0', 'drilling-license', 'Discharge of Water Waste Company', 'HA-II', 'Federal Capital Territory', 'AMAC', '2024-05-09', 'Kuje Abuja', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `license_categories`
--

CREATE TABLE `license_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `license_categories`
--

INSERT INTO `license_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Ground Water', '2024-05-08 23:00:00', '2024-05-08 23:00:00'),
(2, 'Surface Water', '2024-05-09 12:52:53', '2024-05-09 12:52:53'),
(3, 'Discharge Of Waste Water', '2024-05-09 13:11:15', '2024-05-09 13:11:15');

-- --------------------------------------------------------

--
-- Table structure for table `license_sub_categories`
--

CREATE TABLE `license_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `license_category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `processing_fee` decimal(10,2) DEFAULT NULL,
  `licensing_fee` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `license_sub_categories`
--

INSERT INTO `license_sub_categories` (`id`, `name`, `license_category_id`, `created_at`, `updated_at`, `processing_fee`, `licensing_fee`) VALUES
(1, 'Drilling License', 1, '2024-05-08 23:00:00', '2024-05-08 23:00:00', 500000.00, 1000000.00),
(2, 'Discharge Of Waste Water', 2, '2024-05-09 13:14:19', '2024-05-09 13:14:19', 600000.00, 2500000.00);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_27_100438_create_customers_table', 1),
(6, '2023_10_27_154811_create_email_tokens_table', 2),
(7, '2014_10_12_100000_create_password_resets_table', 3),
(13, '2023_10_29_094727_create_discharge_water_waste_forms_table', 4),
(14, '2023_10_30_102402_create_amendment_of_license_forms_table', 4),
(15, '2023_10_30_102434_create_bore_hole_contractor_license_forms_table', 4),
(16, '2023_10_30_110757_create_drillers_license_forms_table', 4),
(17, '2023_10_31_215359_add_customer_id_to_discharge_water_waste_forms_table', 4),
(18, '2023_11_01_151045_create_apllication_documents_table', 5),
(21, '2023_11_02_103526_add_avatar_to_customers_table', 6),
(23, '2023_11_03_113344_add_status_to_discharge_water_waste_form_table', 7),
(26, '2023_11_03_124939_create_invoices_table', 8),
(27, '2023_11_03_124954_create_pricings_table', 8),
(28, '2023_11_04_193225_create_payments_table', 9),
(29, '2023_11_05_083709_create_licenses_table', 10),
(30, '2023_11_05_091523_add_valid_period_to_licenses_table', 11),
(32, '2023_11_05_095654_add_application_name_to_discharge_water_waste_forms_table', 12),
(33, '2023_11_06_132806_create_payment_receipts_table', 13),
(34, '2023_11_06_161539_add_customer_id_to_payments_table', 14),
(36, '2023_11_06_235716_add_slug_to_discharge_of_waste_water_forms_table', 15),
(37, '2023_11_13_154723_add_application_slug_to_licenses_table', 16),
(38, '2023_11_17_113730_add_licensed_as_to_licenses_table', 17),
(40, '2023_11_17_133710_add_generated_to_licenses_table', 18),
(41, '2023_11_19_233612_add_signature_url_to_licenses_table', 19),
(45, '2024_03_09_022835_create_license_categories_table', 20),
(46, '2024_03_09_022845_create_license_sub_categories_table', 20),
(47, '2024_04_24_133845_create_application_forms_table', 20),
(48, '2024_05_09_100009_add_stage_to_application_forms_table', 21),
(49, '2024_05_09_105935_add_fee_to_license_sub_category_table', 22),
(50, '2024_05_09_121232_add_reg_no_to_licenses_table', 23);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `amount_paid` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `application_id` varchar(255) NOT NULL,
  `license_type` varchar(255) NOT NULL,
  `status` enum('verified','unverified') NOT NULL DEFAULT 'unverified',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `customer_id`, `invoice_id`, `transaction_id`, `amount_paid`, `purpose`, `application_id`, `license_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 8, 1, 'BK-1991093', '500000', 'processing_fee', '1', 'discharge-of-waste', 'unverified', '2024-04-23 08:51:17', '2024-04-23 08:51:17'),
(2, 10, 2, 'BK-2961744', '500000.00', 'processing_fee', '1', 'drilling-license', 'verified', '2024-05-09 10:30:13', '2024-05-09 10:41:15'),
(3, 10, 3, 'BK-3697010', '1000000.00', 'licensing_fee', '1', 'drilling-license', 'verified', '2024-05-09 10:55:58', '2024-05-09 10:56:27'),
(4, 10, 4, 'BK-4424364', '600000.00', 'processing_fee', '5', 'discharge-of-waste-water', 'unverified', '2024-05-09 13:32:08', '2024-05-09 13:32:08');

-- --------------------------------------------------------

--
-- Table structure for table `payment_receipts`
--

CREATE TABLE `payment_receipts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_receipts`
--

INSERT INTO `payment_receipts` (`id`, `url`, `payment_id`, `created_at`, `updated_at`) VALUES
(2, 'uploads/payment_receipts/654914144fdda.png', 3, '2023-11-06 15:28:04', '2023-11-06 15:28:04'),
(3, 'uploads/payment_receipts/654a1b04c00d0.jpg', 4, '2023-11-07 10:09:56', '2023-11-07 10:09:56'),
(4, 'uploads/payment_receipts/654a3d5ba2541.png', 5, '2023-11-07 12:36:27', '2023-11-07 12:36:27'),
(5, 'uploads/payment_receipts/654a4096f372a.jpg', 6, '2023-11-07 12:50:15', '2023-11-07 12:50:15'),
(6, 'uploads/payment_receipts/6559e98518196.jpg', 7, '2023-11-19 09:55:01', '2023-11-19 09:55:01'),
(7, 'uploads/payment_receipts/655a75bf16096.png', 8, '2023-11-19 19:53:19', '2023-11-19 19:53:19'),
(8, 'uploads/payment_receipts/655b47f1a9f52.png', 9, '2023-11-20 10:50:09', '2023-11-20 10:50:09'),
(9, 'uploads/payment_receipts/655b4e21c351e.jpg', 10, '2023-11-20 11:16:33', '2023-11-20 11:16:33'),
(10, 'uploads/payment_receipts/66278495bf223.jpg', 1, '2024-04-23 08:51:17', '2024-04-23 08:51:17'),
(11, 'uploads/payment_receipts/663cb3c509f65.png', 2, '2024-05-09 10:30:13', '2024-05-09 10:30:13'),
(12, 'uploads/payment_receipts/663cb9ce0d69d.png', 3, '2024-05-09 10:55:58', '2024-05-09 10:55:58'),
(13, 'uploads/payment_receipts/663cde6898e67.jpg', 4, '2024-05-09 13:32:08', '2024-05-09 13:32:08');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pricings`
--

CREATE TABLE `pricings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pricings`
--

INSERT INTO `pricings` (`id`, `item`, `category`, `desc`, `price`, `created_at`, `updated_at`) VALUES
(2, 'discharge-of-waste', 'licensing_fee', NULL, '2500000', '2023-11-07 09:42:51', '2023-11-07 09:42:51'),
(3, 'discharge-of-waste', 'processing_fee', NULL, '500000', '2023-11-07 09:45:59', '2023-11-07 09:45:59'),
(4, 'bore-hole-contractors', 'processing_fee', NULL, '500000', '2023-11-07 12:45:05', '2023-11-07 12:45:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone`, `address`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'NIWRMC', 'Admin', '09053143790', 'No. 4 ', 'admin@wmc.com', '2023-10-27', '$2y$10$MQUWwkfsiLMOQgnDo6OffOO6v8aQo9gKeV2NzB0j8LbZ/7c/gm3Ya', NULL, '2023-10-26 23:00:00', '2023-10-26 23:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amendment_of_license_forms`
--
ALTER TABLE `amendment_of_license_forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `amendment_of_license_forms_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `application_documents`
--
ALTER TABLE `application_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_documents_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `application_forms`
--
ALTER TABLE `application_forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_forms_customer_id_foreign` (`customer_id`),
  ADD KEY `application_forms_license_sub_category_id_foreign` (`license_sub_category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `email_tokens`
--
ALTER TABLE `email_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `licenses`
--
ALTER TABLE `licenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `licenses_customer_id_foreign` (`customer_id`),
  ADD KEY `licenses_payment_id_foreign` (`payment_id`),
  ADD KEY `fk_licenses_approved_by_id` (`assigned_by_id`);

--
-- Indexes for table `license_categories`
--
ALTER TABLE `license_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `license_sub_categories`
--
ALTER TABLE `license_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `license_sub_categories_license_category_id_foreign` (`license_category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_invoice_id_foreign` (`invoice_id`),
  ADD KEY `payments_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `payment_receipts`
--
ALTER TABLE `payment_receipts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_receipts_payment_id_foreign` (`payment_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pricings`
--
ALTER TABLE `pricings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amendment_of_license_forms`
--
ALTER TABLE `amendment_of_license_forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `application_documents`
--
ALTER TABLE `application_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `application_forms`
--
ALTER TABLE `application_forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `email_tokens`
--
ALTER TABLE `email_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `licenses`
--
ALTER TABLE `licenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `license_categories`
--
ALTER TABLE `license_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `license_sub_categories`
--
ALTER TABLE `license_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_receipts`
--
ALTER TABLE `payment_receipts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pricings`
--
ALTER TABLE `pricings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `amendment_of_license_forms`
--
ALTER TABLE `amendment_of_license_forms`
  ADD CONSTRAINT `amendment_of_license_forms_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `application_documents`
--
ALTER TABLE `application_documents`
  ADD CONSTRAINT `application_documents_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `application_forms`
--
ALTER TABLE `application_forms`
  ADD CONSTRAINT `application_forms_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `application_forms_license_sub_category_id_foreign` FOREIGN KEY (`license_sub_category_id`) REFERENCES `license_sub_categories` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `licenses`
--
ALTER TABLE `licenses`
  ADD CONSTRAINT `fk_licenses_approved_by_id` FOREIGN KEY (`assigned_by_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `licenses_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `licenses_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `license_sub_categories`
--
ALTER TABLE `license_sub_categories`
  ADD CONSTRAINT `license_sub_categories_license_category_id_foreign` FOREIGN KEY (`license_category_id`) REFERENCES `license_categories` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
