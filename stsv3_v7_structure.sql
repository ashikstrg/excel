-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2017 at 12:30 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stsv3_v7`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_checklist`
--

CREATE TABLE IF NOT EXISTS `attendance_checklist` (
  `id` int(11) unsigned NOT NULL,
  `checklist` text CHARACTER SET utf8 NOT NULL,
  `retail_dms_code` varchar(100) NOT NULL,
  `retail_name` varchar(150) NOT NULL,
  `hr_employee_id` varchar(50) NOT NULL,
  `hr_name` varchar(80) NOT NULL,
  `tm_employee_id` varchar(50) DEFAULT NULL,
  `tm_name` varchar(80) DEFAULT NULL,
  `checklist_date` date NOT NULL,
  `in_time` time NOT NULL,
  `out_time` time DEFAULT NULL,
  `status` enum('Pending','Approved','Declined') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_question`
--

CREATE TABLE IF NOT EXISTS `attendance_question` (
  `id` int(8) unsigned NOT NULL,
  `question` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blood_group`
--

CREATE TABLE IF NOT EXISTS `blood_group` (
  `id` int(8) unsigned NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `complainbox`
--

CREATE TABLE IF NOT EXISTS `complainbox` (
  `id` int(11) unsigned NOT NULL,
  `token_no` bigint(20) NOT NULL,
  `complain` text CHARACTER SET utf8 NOT NULL,
  `hr_employee_id` varchar(50) NOT NULL,
  `hr_name` varchar(80) NOT NULL,
  `retail_dms_code` varchar(100) NOT NULL,
  `retail_name` varchar(150) NOT NULL,
  `status` enum('Pending','Resolved','Declined') NOT NULL DEFAULT 'Pending',
  `complain_date` datetime NOT NULL,
  `feedback` text CHARACTER SET utf8,
  `feedback_by_employee_id` varchar(50) DEFAULT NULL,
  `feedback_by_name` varchar(80) DEFAULT NULL,
  `feedback_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `day_off`
--

CREATE TABLE IF NOT EXISTS `day_off` (
  `id` int(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE IF NOT EXISTS `districts` (
  `id` int(2) unsigned NOT NULL,
  `division_id` int(2) unsigned NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE IF NOT EXISTS `divisions` (
  `id` int(2) unsigned NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hr`
--

CREATE TABLE IF NOT EXISTS `hr` (
  `id` int(11) unsigned NOT NULL,
  `batch` bigint(20) unsigned NOT NULL DEFAULT '0',
  `retail_id` int(11) unsigned DEFAULT NULL,
  `retail_dms_code` varchar(100) DEFAULT NULL,
  `retail_name` varchar(150) DEFAULT NULL,
  `retail_channel_type` varchar(100) DEFAULT NULL,
  `retail_type` varchar(100) DEFAULT NULL,
  `retail_zone` varchar(150) DEFAULT NULL,
  `retail_area` varchar(250) DEFAULT NULL,
  `retail_territory` varchar(250) DEFAULT NULL,
  `retail_location` varchar(250) NOT NULL,
  `designation_id` int(8) unsigned NOT NULL,
  `designation` varchar(100) NOT NULL,
  `employee_type_id` int(8) unsigned NOT NULL,
  `employee_type` varchar(100) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `tm_parent` int(11) unsigned NOT NULL,
  `tm_employee_id` varchar(50) NOT NULL,
  `tm_name` varchar(80) NOT NULL,
  `am_parent` int(11) unsigned NOT NULL,
  `am_employee_id` varchar(50) NOT NULL,
  `am_name` varchar(80) NOT NULL,
  `csm_parent` int(11) unsigned NOT NULL,
  `csm_employee_id` varchar(50) NOT NULL,
  `csm_name` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `status` enum('Active','Inactive','Resigned') NOT NULL DEFAULT 'Active',
  `joining_date` date NOT NULL,
  `leaving_date` date DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `image_src_filename` varchar(255) DEFAULT NULL,
  `image_web_filename` varchar(255) DEFAULT NULL,
  `contact_no_official` varchar(20) NOT NULL,
  `contact_no_personal` varchar(20) NOT NULL,
  `name_immergency_contact_person` varchar(80) NOT NULL,
  `relation_immergency_contact_person` varchar(50) NOT NULL,
  `contact_no_immergency` varchar(20) NOT NULL,
  `email_address` varchar(80) NOT NULL,
  `email_address_official` varchar(80) NOT NULL,
  `bank_name` varchar(150) NOT NULL,
  `bank_ac_name` varchar(80) NOT NULL,
  `bank_ac_no` varchar(20) NOT NULL,
  `bkash_no` varchar(20) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `graduation_status` enum('Graduated','Pursuing') NOT NULL DEFAULT 'Graduated',
  `educational_qualification` varchar(255) NOT NULL,
  `educational_institute` varchar(255) NOT NULL,
  `educational_qualification_second_last` varchar(255) NOT NULL,
  `educational_institute_second_last` varchar(255) NOT NULL,
  `previous_experience` int(8) unsigned NOT NULL,
  `previous_experience_two` int(8) unsigned NOT NULL,
  `permanent_address` varchar(550) NOT NULL,
  `present_address` varchar(550) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `user_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hr_batch`
--

CREATE TABLE IF NOT EXISTS `hr_batch` (
  `id` int(11) NOT NULL,
  `batch` bigint(20) NOT NULL,
  `total_row` int(11) unsigned NOT NULL,
  `file_import` varchar(255) NOT NULL,
  `status` enum('Active','Deleted') NOT NULL DEFAULT 'Active',
  `created_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_designation`
--

CREATE TABLE IF NOT EXISTS `hr_designation` (
  `id` int(8) unsigned NOT NULL,
  `type` varchar(100) CHARACTER SET utf8 NOT NULL,
  `employee_type_id` int(8) unsigned NOT NULL,
  `employee_type` varchar(100) NOT NULL,
  `parent` int(8) unsigned NOT NULL,
  `parent_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_employee_type`
--

CREATE TABLE IF NOT EXISTS `hr_employee_type` (
  `id` int(8) unsigned NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr_management`
--

CREATE TABLE IF NOT EXISTS `hr_management` (
  `id` int(11) unsigned NOT NULL,
  `designation_id` int(8) unsigned NOT NULL,
  `designation` varchar(100) NOT NULL,
  `employee_type_id` int(8) unsigned NOT NULL,
  `employee_type` varchar(100) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `name` varchar(80) NOT NULL,
  `status` enum('Active','Inactive','Resigned') NOT NULL DEFAULT 'Active',
  `joining_date` date NOT NULL,
  `leaving_date` date DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `image_src_filename` varchar(255) DEFAULT NULL,
  `image_web_filename` varchar(255) DEFAULT NULL,
  `contact_no_official` varchar(20) NOT NULL,
  `contact_no_personal` varchar(20) NOT NULL,
  `name_immergency_contact_person` varchar(80) NOT NULL,
  `relation_immergency_contact_person` varchar(50) NOT NULL,
  `contact_no_immergency` varchar(20) NOT NULL,
  `email_address` varchar(80) NOT NULL,
  `email_address_official` varchar(80) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `permanent_address` varchar(550) NOT NULL,
  `present_address` varchar(550) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `user_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hr_sales`
--

CREATE TABLE IF NOT EXISTS `hr_sales` (
  `id` int(11) unsigned NOT NULL,
  `designation_id` int(8) unsigned NOT NULL,
  `designation` varchar(100) NOT NULL,
  `employee_type_id` int(8) unsigned NOT NULL,
  `employee_type` varchar(100) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `parent` int(11) unsigned NOT NULL,
  `manager_id` varchar(50) NOT NULL,
  `manager_name` varchar(80) NOT NULL,
  `manager_designation` varchar(50) NOT NULL,
  `name` varchar(80) NOT NULL,
  `status` enum('Active','Inactive','Resigned') NOT NULL DEFAULT 'Active',
  `joining_date` date NOT NULL,
  `leaving_date` date DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `image_src_filename` varchar(255) DEFAULT NULL,
  `image_web_filename` varchar(255) DEFAULT NULL,
  `contact_no_official` varchar(20) NOT NULL,
  `contact_no_personal` varchar(20) NOT NULL,
  `name_immergency_contact_person` varchar(80) NOT NULL,
  `relation_immergency_contact_person` varchar(50) NOT NULL,
  `contact_no_immergency` varchar(20) NOT NULL,
  `email_address` varchar(80) NOT NULL,
  `email_address_official` varchar(80) NOT NULL,
  `bank_name` varchar(150) NOT NULL,
  `bank_ac_name` varchar(80) NOT NULL,
  `bank_ac_no` varchar(20) NOT NULL,
  `bkash_no` varchar(20) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `graduation_status` enum('Graduated','Pursuing') NOT NULL DEFAULT 'Graduated',
  `educational_qualification` varchar(255) NOT NULL,
  `educational_institute` varchar(255) NOT NULL,
  `educational_qualification_second_last` varchar(255) NOT NULL,
  `educational_institute_second_last` varchar(255) NOT NULL,
  `previous_experience` int(8) unsigned NOT NULL,
  `previous_experience_two` int(8) unsigned NOT NULL,
  `permanent_address` varchar(550) NOT NULL,
  `present_address` varchar(550) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `user_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hr_trainer`
--

CREATE TABLE IF NOT EXISTS `hr_trainer` (
  `id` int(11) unsigned NOT NULL,
  `designation_id` int(8) unsigned NOT NULL,
  `designation` varchar(100) NOT NULL,
  `employee_type_id` int(8) unsigned NOT NULL,
  `employee_type` varchar(100) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `parent` int(11) unsigned NOT NULL,
  `manager_id` varchar(50) NOT NULL,
  `manager_name` varchar(80) NOT NULL,
  `manager_designation` varchar(50) NOT NULL,
  `name` varchar(80) NOT NULL,
  `status` enum('Active','Inactive','Resigned') NOT NULL DEFAULT 'Active',
  `joining_date` date NOT NULL,
  `leaving_date` date DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `image_src_filename` varchar(255) DEFAULT NULL,
  `image_web_filename` varchar(255) DEFAULT NULL,
  `contact_no_official` varchar(20) NOT NULL,
  `contact_no_personal` varchar(20) NOT NULL,
  `name_immergency_contact_person` varchar(80) NOT NULL,
  `relation_immergency_contact_person` varchar(50) NOT NULL,
  `contact_no_immergency` varchar(20) NOT NULL,
  `email_address` varchar(80) NOT NULL,
  `email_address_official` varchar(80) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `permanent_address` varchar(550) NOT NULL,
  `present_address` varchar(550) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `user_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int(11) unsigned NOT NULL,
  `batch` bigint(20) unsigned NOT NULL DEFAULT '1',
  `imei_no` varchar(20) NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `product_name` varchar(80) NOT NULL,
  `product_model_code` varchar(50) NOT NULL,
  `product_model_name` varchar(50) NOT NULL,
  `product_color` varchar(50) NOT NULL,
  `product_type` varchar(50) NOT NULL,
  `lifting_price` decimal(10,2) unsigned NOT NULL,
  `rrp` decimal(10,2) unsigned NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `validity` enum('in','out') NOT NULL DEFAULT 'in',
  `stage` enum('inventory','stock','sold') NOT NULL DEFAULT 'inventory',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_batch`
--

CREATE TABLE IF NOT EXISTS `inventory_batch` (
  `id` int(11) unsigned NOT NULL,
  `batch` bigint(20) unsigned NOT NULL,
  `file_import` varchar(255) NOT NULL,
  `total_row` int(8) unsigned NOT NULL,
  `status` enum('Active','Deleted') NOT NULL DEFAULT 'Active',
  `created_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `left_menu`
--

CREATE TABLE IF NOT EXISTS `left_menu` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) unsigned NOT NULL,
  `label` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `used_by` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mi_infra`
--

CREATE TABLE IF NOT EXISTS `mi_infra` (
  `id` int(11) unsigned NOT NULL,
  `brand` varchar(100) NOT NULL,
  `retail_type` enum('Brandshop','SIS','Priority Store') NOT NULL,
  `store_size` varchar(10) NOT NULL,
  `owner` enum('Company','Franchise') NOT NULL,
  `distributor_type` enum('RD','Distributor') NOT NULL,
  `sales_team` varchar(50) NOT NULL,
  `rsa` varchar(50) NOT NULL,
  `fsm_type` enum('SEC','BP') NOT NULL,
  `region` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `town` varchar(100) NOT NULL,
  `hr_id` int(11) unsigned NOT NULL,
  `hr_employee_id` varchar(50) NOT NULL,
  `hr_name` varchar(80) NOT NULL,
  `hr_designation` varchar(100) NOT NULL,
  `hr_employee_type` varchar(100) NOT NULL,
  `am_employee_id` varchar(50) NOT NULL,
  `am_name` varchar(80) NOT NULL,
  `csm_employee_id` varchar(50) NOT NULL,
  `csm_name` varchar(80) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mi_product`
--

CREATE TABLE IF NOT EXISTS `mi_product` (
  `id` int(11) unsigned NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `display_size` varchar(10) NOT NULL,
  `display_type` varchar(100) NOT NULL,
  `generation` enum('2G','3G','4G') NOT NULL,
  `sim` enum('Single','Dual') NOT NULL,
  `weight` varchar(10) NOT NULL,
  `ram` varchar(10) NOT NULL,
  `rom` varchar(10) NOT NULL,
  `processor` varchar(50) NOT NULL,
  `battery` varchar(10) NOT NULL,
  `camera_rear` varchar(20) NOT NULL,
  `camera_front` varchar(20) NOT NULL,
  `special_feature` varchar(100) NOT NULL,
  `price` decimal(10,2) unsigned NOT NULL,
  `sale_out_vol` int(11) unsigned NOT NULL,
  `region` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `town` varchar(100) NOT NULL,
  `hr_id` int(11) unsigned NOT NULL,
  `hr_employee_id` varchar(50) NOT NULL,
  `hr_name` varchar(80) NOT NULL,
  `hr_designation` varchar(100) NOT NULL,
  `hr_employee_type` varchar(100) NOT NULL,
  `am_employee_id` varchar(50) NOT NULL,
  `am_name` varchar(80) NOT NULL,
  `csm_employee_id` varchar(50) NOT NULL,
  `csm_name` varchar(80) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mi_tpcp`
--

CREATE TABLE IF NOT EXISTS `mi_tpcp` (
  `id` int(11) unsigned NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `trade_promo` varchar(100) NOT NULL,
  `consumer_promo` varchar(100) NOT NULL,
  `fsm_incentive_plan` varchar(100) NOT NULL,
  `other_scheme` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `town` varchar(100) NOT NULL,
  `hr_id` int(11) unsigned NOT NULL,
  `hr_employee_id` varchar(50) NOT NULL,
  `hr_name` varchar(80) NOT NULL,
  `hr_designation` varchar(100) NOT NULL,
  `hr_employee_type` varchar(100) NOT NULL,
  `am_employee_id` varchar(50) NOT NULL,
  `am_name` varchar(80) NOT NULL,
  `csm_employee_id` varchar(50) NOT NULL,
  `csm_name` varchar(80) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mi_visibility`
--

CREATE TABLE IF NOT EXISTS `mi_visibility` (
  `id` int(11) unsigned NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `retail_type` enum('Brandshop','SIS','Priority Store') NOT NULL,
  `store_size` varchar(10) NOT NULL,
  `owner` enum('Company','Franchise') NOT NULL,
  `distributor_type` enum('RD','Distributor') NOT NULL,
  `sales_team` varchar(50) NOT NULL,
  `rsa` varchar(50) NOT NULL,
  `fsm_type` enum('SEC','BP') NOT NULL,
  `region` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `town` varchar(100) NOT NULL,
  `posm` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `image_src_filename` varchar(255) DEFAULT NULL,
  `image_web_filename` varchar(255) DEFAULT NULL,
  `hr_id` int(11) unsigned NOT NULL,
  `hr_employee_id` varchar(50) NOT NULL,
  `hr_name` varchar(80) NOT NULL,
  `hr_designation` varchar(100) NOT NULL,
  `hr_employee_type` varchar(100) NOT NULL,
  `am_employee_id` varchar(50) NOT NULL,
  `am_name` varchar(80) NOT NULL,
  `csm_employee_id` varchar(50) NOT NULL,
  `csm_name` varchar(80) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(8) unsigned NOT NULL,
  `batch` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `module_name` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `hr_id` int(11) unsigned NOT NULL,
  `hr_employee_id` varchar(50) NOT NULL,
  `hr_designation` varchar(100) NOT NULL,
  `hr_employee_type` varchar(100) NOT NULL,
  `hr_name` varchar(80) NOT NULL,
  `message` varchar(550) NOT NULL,
  `read_status` enum('Read','Unread') NOT NULL DEFAULT 'Unread',
  `seen` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_by_name` varchar(255) NOT NULL,
  `image_web_filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) unsigned NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `created_by` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) unsigned NOT NULL,
  `sku_code` varchar(50) NOT NULL,
  `name` varchar(80) NOT NULL,
  `model_code` varchar(50) NOT NULL,
  `model_name` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `lifting_price` decimal(10,2) unsigned NOT NULL,
  `rrp` decimal(10,2) unsigned NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE IF NOT EXISTS `product_color` (
  `id` int(8) unsigned NOT NULL,
  `color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE IF NOT EXISTS `product_type` (
  `id` int(8) unsigned NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE IF NOT EXISTS `properties` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `property_name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `retail`
--

CREATE TABLE IF NOT EXISTS `retail` (
  `id` int(11) unsigned NOT NULL,
  `batch` bigint(20) NOT NULL DEFAULT '0',
  `channel_type` varchar(100) NOT NULL,
  `channelType` int(11) unsigned NOT NULL,
  `retail_type` varchar(100) NOT NULL,
  `retailType` int(11) unsigned NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `dms_code` varchar(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `retail_zone` varchar(150) NOT NULL,
  `retailZone` int(11) unsigned NOT NULL,
  `retail_area` varchar(250) NOT NULL,
  `retailArea` int(11) unsigned NOT NULL,
  `territory` varchar(250) NOT NULL,
  `retail_location` varchar(250) NOT NULL,
  `retailLocation` int(11) unsigned NOT NULL,
  `division` varchar(30) NOT NULL,
  `divisionProperty` int(2) unsigned NOT NULL,
  `district` varchar(30) NOT NULL,
  `districtProperty` int(2) unsigned NOT NULL,
  `upazila` varchar(30) NOT NULL,
  `upazilaProperty` int(2) unsigned NOT NULL,
  `market_name` varchar(250) NOT NULL,
  `geotag` varchar(100) NOT NULL,
  `Address` varchar(550) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `owner_name` varchar(60) NOT NULL,
  `owner_contact_no` varchar(20) NOT NULL,
  `owner_email` varchar(80) NOT NULL,
  `store_contact_no` varchar(20) NOT NULL,
  `store_email` varchar(80) NOT NULL,
  `manager_name` varchar(60) NOT NULL,
  `manager_contact_no` varchar(20) NOT NULL,
  `store_size_sft` int(8) unsigned NOT NULL,
  `store_facade_feet` int(8) unsigned NOT NULL,
  `number_sec` int(4) unsigned NOT NULL,
  `number_rsa` int(4) unsigned NOT NULL,
  `day_off` varchar(20) NOT NULL,
  `connectivity_wifi` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `created_by` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `retail_area`
--

CREATE TABLE IF NOT EXISTS `retail_area` (
  `id` int(11) unsigned NOT NULL,
  `area` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `retail_batch`
--

CREATE TABLE IF NOT EXISTS `retail_batch` (
  `id` int(11) NOT NULL,
  `batch` bigint(20) NOT NULL,
  `total_row` int(11) unsigned NOT NULL,
  `file_import` varchar(255) NOT NULL,
  `status` enum('Active','Deleted') NOT NULL DEFAULT 'Active',
  `created_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `retail_channel_type`
--

CREATE TABLE IF NOT EXISTS `retail_channel_type` (
  `id` int(11) unsigned NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `retail_location`
--

CREATE TABLE IF NOT EXISTS `retail_location` (
  `id` int(11) unsigned NOT NULL,
  `location` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `retail_type`
--

CREATE TABLE IF NOT EXISTS `retail_type` (
  `id` int(11) unsigned NOT NULL,
  `type` varchar(100) NOT NULL,
  `channel_type_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `retail_zone`
--

CREATE TABLE IF NOT EXISTS `retail_zone` (
  `id` int(11) unsigned NOT NULL,
  `zone` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) unsigned NOT NULL,
  `batch` bigint(20) NOT NULL,
  `retail_id` int(11) unsigned NOT NULL,
  `retail_dms_code` varchar(100) NOT NULL,
  `retail_name` varchar(150) NOT NULL,
  `retail_channel_type` varchar(100) NOT NULL,
  `retail_type` varchar(100) NOT NULL,
  `retail_zone` varchar(150) NOT NULL,
  `retail_area` varchar(250) NOT NULL,
  `retail_territory` varchar(250) NOT NULL,
  `hr_id` int(11) unsigned NOT NULL,
  `designation` varchar(100) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `employee_name` varchar(80) NOT NULL,
  `tm_parent` int(11) unsigned NOT NULL,
  `tm_employee_id` varchar(50) NOT NULL,
  `tm_name` varchar(80) NOT NULL,
  `am_parent` int(11) unsigned NOT NULL,
  `am_employee_id` varchar(50) NOT NULL,
  `am_name` varchar(80) NOT NULL,
  `csm_parent` int(11) unsigned NOT NULL,
  `csm_employee_id` varchar(50) NOT NULL,
  `csm_name` varchar(80) NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `product_name` varchar(80) NOT NULL,
  `product_model_code` varchar(50) NOT NULL,
  `product_model_name` varchar(50) NOT NULL,
  `product_color` varchar(50) NOT NULL,
  `product_type` varchar(50) NOT NULL,
  `imei_no` varchar(20) NOT NULL,
  `price` decimal(10,2) unsigned NOT NULL,
  `lifting_price` decimal(10,2) unsigned NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `sales_date` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_batch`
--

CREATE TABLE IF NOT EXISTS `sales_batch` (
  `id` int(11) NOT NULL,
  `batch` bigint(20) NOT NULL,
  `file_import` varchar(255) NOT NULL,
  `status` enum('Active','Deleted') NOT NULL DEFAULT 'Active',
  `created_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(11) unsigned NOT NULL,
  `batch` bigint(20) unsigned NOT NULL,
  `retail_id` int(11) unsigned NOT NULL,
  `retail_dms_code` varchar(100) NOT NULL,
  `retail_name` varchar(150) NOT NULL,
  `retail_type` varchar(100) NOT NULL,
  `retail_channel_type` varchar(100) NOT NULL,
  `retail_zone` varchar(150) NOT NULL,
  `retail_area` varchar(250) NOT NULL,
  `retail_territory` varchar(250) NOT NULL,
  `retail_location` varchar(250) NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `imei_no` varchar(20) NOT NULL,
  `product_name` varchar(80) NOT NULL,
  `product_model_code` varchar(50) NOT NULL,
  `product_model_name` varchar(50) NOT NULL,
  `product_color` varchar(50) NOT NULL,
  `product_type` varchar(50) NOT NULL,
  `lifting_price` decimal(10,2) unsigned NOT NULL,
  `rrp` decimal(10,2) unsigned NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `validity` enum('in','out') NOT NULL DEFAULT 'in',
  `submission_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_batch`
--

CREATE TABLE IF NOT EXISTS `stock_batch` (
  `id` int(11) NOT NULL,
  `batch` bigint(20) NOT NULL,
  `total_row` int(11) unsigned NOT NULL,
  `file_import` varchar(255) NOT NULL,
  `status` enum('Active','Deleted') NOT NULL DEFAULT 'Active',
  `created_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `stock_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `target`
--

CREATE TABLE IF NOT EXISTS `target` (
  `id` int(11) unsigned NOT NULL,
  `batch` bigint(20) NOT NULL,
  `retail_id` int(11) unsigned NOT NULL,
  `retail_dms_code` varchar(100) NOT NULL,
  `retail_name` varchar(150) NOT NULL,
  `retail_channel_type` varchar(100) NOT NULL,
  `retail_type` varchar(100) NOT NULL,
  `retail_zone` varchar(150) NOT NULL,
  `retail_area` varchar(250) NOT NULL,
  `retail_territory` varchar(250) NOT NULL,
  `hr_id` int(11) unsigned NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `employee_name` varchar(80) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `fsm_vol` int(8) unsigned NOT NULL DEFAULT '0',
  `fsm_vol_sales` int(8) unsigned NOT NULL DEFAULT '0',
  `fsm_val` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `fsm_val_sales` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `tm_parent` int(11) unsigned NOT NULL,
  `tm_employee_id` varchar(50) NOT NULL,
  `tm_name` varchar(80) NOT NULL,
  `tm_vol` int(8) unsigned NOT NULL DEFAULT '0',
  `tm_vol_sales` int(8) unsigned NOT NULL DEFAULT '0',
  `tm_val` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `tm_val_sales` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `am_parent` int(11) unsigned NOT NULL,
  `am_employee_id` varchar(50) NOT NULL,
  `am_name` varchar(80) NOT NULL,
  `am_vol` int(8) unsigned NOT NULL DEFAULT '0',
  `am_vol_sales` int(8) unsigned NOT NULL DEFAULT '0',
  `am_val` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `am_val_sales` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `csm_parent` int(11) unsigned NOT NULL,
  `csm_employee_id` varchar(50) NOT NULL,
  `csm_name` varchar(80) NOT NULL,
  `csm_vol` int(8) unsigned NOT NULL DEFAULT '0',
  `csm_vol_sales` int(8) unsigned NOT NULL DEFAULT '0',
  `csm_val` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `csm_val_sales` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `product_name` varchar(80) NOT NULL,
  `product_model_code` varchar(50) NOT NULL,
  `product_model_name` varchar(50) NOT NULL,
  `product_type` varchar(50) NOT NULL,
  `target_date` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `target_batch`
--

CREATE TABLE IF NOT EXISTS `target_batch` (
  `id` int(11) unsigned NOT NULL,
  `batch` bigint(20) NOT NULL,
  `file_import` varchar(255) NOT NULL,
  `status` enum('Active','Deleted') NOT NULL DEFAULT 'Active',
  `created_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `target_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `top_menu`
--

CREATE TABLE IF NOT EXISTS `top_menu` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) unsigned NOT NULL,
  `label` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `used_by` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `training_assessment_answer`
--

CREATE TABLE IF NOT EXISTS `training_assessment_answer` (
  `id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `hr_employee_id` varchar(50) NOT NULL,
  `hr_name` varchar(80) NOT NULL,
  `hr_designation` varchar(100) NOT NULL,
  `hr_employee_type` varchar(100) NOT NULL,
  `question_name` text NOT NULL,
  `answer` varchar(250) NOT NULL,
  `remark` enum('Right','Wrong') NOT NULL DEFAULT 'Wrong'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `training_assessment_category`
--

CREATE TABLE IF NOT EXISTS `training_assessment_category` (
  `id` int(11) unsigned NOT NULL,
  `batch` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` varchar(550) NOT NULL,
  `designations` varchar(550) NOT NULL,
  `qlimit` int(8) unsigned NOT NULL,
  `estimated_time` int(8) unsigned NOT NULL,
  `date_month` date NOT NULL,
  `status` enum('Active','Inactive','Pending','Finish') NOT NULL DEFAULT 'Inactive',
  `notification_count` int(8) unsigned NOT NULL DEFAULT '0',
  `created_by` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `training_assessment_question`
--

CREATE TABLE IF NOT EXISTS `training_assessment_question` (
  `id` int(11) unsigned NOT NULL,
  `question_name` text CHARACTER SET utf8 NOT NULL,
  `answer1` varchar(250) CHARACTER SET utf8 NOT NULL,
  `answer2` varchar(250) CHARACTER SET utf8 NOT NULL,
  `answer3` varchar(250) CHARACTER SET utf8 NOT NULL,
  `answer4` varchar(250) CHARACTER SET utf8 NOT NULL,
  `answer` int(8) unsigned NOT NULL,
  `choice` enum('Single','Multiple') NOT NULL DEFAULT 'Single',
  `category_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `training_assessment_result`
--

CREATE TABLE IF NOT EXISTS `training_assessment_result` (
  `id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `hr_employee_id` varchar(50) NOT NULL,
  `hr_name` varchar(80) NOT NULL,
  `hr_designation` varchar(100) NOT NULL,
  `hr_employee_type` varchar(100) NOT NULL,
  `score` int(11) unsigned NOT NULL,
  `right_answer` int(8) unsigned NOT NULL,
  `wrong_answer` int(8) unsigned NOT NULL,
  `un_answer` int(8) unsigned NOT NULL,
  `score_percent` decimal(10,2) unsigned NOT NULL,
  `total_time` decimal(10,2) unsigned NOT NULL,
  `date_month` date NOT NULL,
  `participation_datetime` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `training_pdf`
--

CREATE TABLE IF NOT EXISTS `training_pdf` (
  `id` int(11) unsigned NOT NULL,
  `batch` varchar(30) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `file_import` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` enum('Inactive','Active','Deleted') CHARACTER SET utf8 NOT NULL DEFAULT 'Inactive',
  `designations` varchar(255) NOT NULL,
  `message` varchar(550) CHARACTER SET utf8 NOT NULL,
  `notification_count` int(8) DEFAULT '0',
  `created_by` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `deleted_by` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `training_datetime` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `travel`
--

CREATE TABLE IF NOT EXISTS `travel` (
  `id` int(11) unsigned NOT NULL,
  `batch` bigint(20) unsigned NOT NULL,
  `hr_employee_id` varchar(50) NOT NULL,
  `hr_name` varchar(80) NOT NULL,
  `hr_designation` varchar(100) NOT NULL,
  `hr_employee_type` varchar(100) NOT NULL,
  `reason` varchar(550) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `place` varchar(550) DEFAULT NULL,
  `cost` decimal(10,2) unsigned NOT NULL,
  `line_manager_hr_id` int(11) unsigned NOT NULL,
  `line_manager_employee_id` varchar(255) NOT NULL,
  `line_manager_name` varchar(80) NOT NULL,
  `line_manager_designation` varchar(100) NOT NULL,
  `line_manager_employee_type` varchar(100) NOT NULL,
  `status` enum('Pending','Rejected','Approved') NOT NULL DEFAULT 'Pending',
  `action_date` datetime DEFAULT NULL,
  `action_by` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `upazilas`
--

CREATE TABLE IF NOT EXISTS `upazilas` (
  `id` int(2) unsigned NOT NULL,
  `district_id` int(2) unsigned NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_actual` varchar(20) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) unsigned NOT NULL,
  `role` enum('super','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_checklist`
--
ALTER TABLE `attendance_checklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_question`
--
ALTER TABLE `attendance_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `blood_group`
--
ALTER TABLE `blood_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complainbox`
--
ALTER TABLE `complainbox`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token_no` (`token_no`);

--
-- Indexes for table `day_off`
--
ALTER TABLE `day_off`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `division_id` (`division_id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr`
--
ALTER TABLE `hr`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`),
  ADD UNIQUE KEY `email_address_official` (`email_address_official`),
  ADD KEY `retail_id` (`retail_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `hr_batch`
--
ALTER TABLE `hr_batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_designation`
--
ALTER TABLE `hr_designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_employee_type`
--
ALTER TABLE `hr_employee_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_management`
--
ALTER TABLE `hr_management`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- Indexes for table `hr_sales`
--
ALTER TABLE `hr_sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- Indexes for table `hr_trainer`
--
ALTER TABLE `hr_trainer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `imei_no` (`imei_no`);

--
-- Indexes for table `inventory_batch`
--
ALTER TABLE `inventory_batch`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `batch` (`batch`);

--
-- Indexes for table `left_menu`
--
ALTER TABLE `left_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `mi_infra`
--
ALTER TABLE `mi_infra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_product`
--
ALTER TABLE `mi_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_tpcp`
--
ALTER TABLE `mi_tpcp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_visibility`
--
ALTER TABLE `mi_visibility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku_code` (`sku_code`);

--
-- Indexes for table `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retail`
--
ALTER TABLE `retail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dms_code` (`dms_code`);

--
-- Indexes for table `retail_area`
--
ALTER TABLE `retail_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retail_batch`
--
ALTER TABLE `retail_batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retail_channel_type`
--
ALTER TABLE `retail_channel_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retail_location`
--
ALTER TABLE `retail_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retail_type`
--
ALTER TABLE `retail_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `channel_type_id` (`channel_type_id`);

--
-- Indexes for table `retail_zone`
--
ALTER TABLE `retail_zone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `imei_no` (`imei_no`);

--
-- Indexes for table `sales_batch`
--
ALTER TABLE `sales_batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `imei_no` (`imei_no`);

--
-- Indexes for table `stock_batch`
--
ALTER TABLE `stock_batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `target`
--
ALTER TABLE `target`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `target_batch`
--
ALTER TABLE `target_batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `top_menu`
--
ALTER TABLE `top_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_assessment_answer`
--
ALTER TABLE `training_assessment_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_assessment_category`
--
ALTER TABLE `training_assessment_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_assessment_question`
--
ALTER TABLE `training_assessment_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_assessment_result`
--
ALTER TABLE `training_assessment_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_pdf`
--
ALTER TABLE `training_pdf`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `batch` (`batch`);

--
-- Indexes for table `travel`
--
ALTER TABLE `travel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upazilas`
--
ALTER TABLE `upazilas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_checklist`
--
ALTER TABLE `attendance_checklist`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attendance_question`
--
ALTER TABLE `attendance_question`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blood_group`
--
ALTER TABLE `blood_group`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `complainbox`
--
ALTER TABLE `complainbox`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `day_off`
--
ALTER TABLE `day_off`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(2) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(2) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr`
--
ALTER TABLE `hr`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_batch`
--
ALTER TABLE `hr_batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_designation`
--
ALTER TABLE `hr_designation`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_employee_type`
--
ALTER TABLE `hr_employee_type`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_management`
--
ALTER TABLE `hr_management`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_sales`
--
ALTER TABLE `hr_sales`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hr_trainer`
--
ALTER TABLE `hr_trainer`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inventory_batch`
--
ALTER TABLE `inventory_batch`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `left_menu`
--
ALTER TABLE `left_menu`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mi_infra`
--
ALTER TABLE `mi_infra`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mi_product`
--
ALTER TABLE `mi_product`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mi_tpcp`
--
ALTER TABLE `mi_tpcp`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mi_visibility`
--
ALTER TABLE `mi_visibility`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `retail`
--
ALTER TABLE `retail`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `retail_area`
--
ALTER TABLE `retail_area`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `retail_batch`
--
ALTER TABLE `retail_batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `retail_channel_type`
--
ALTER TABLE `retail_channel_type`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `retail_location`
--
ALTER TABLE `retail_location`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `retail_type`
--
ALTER TABLE `retail_type`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `retail_zone`
--
ALTER TABLE `retail_zone`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales_batch`
--
ALTER TABLE `sales_batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stock_batch`
--
ALTER TABLE `stock_batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `target`
--
ALTER TABLE `target`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `target_batch`
--
ALTER TABLE `target_batch`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `top_menu`
--
ALTER TABLE `top_menu`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `training_assessment_answer`
--
ALTER TABLE `training_assessment_answer`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `training_assessment_category`
--
ALTER TABLE `training_assessment_category`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `training_assessment_question`
--
ALTER TABLE `training_assessment_question`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `training_assessment_result`
--
ALTER TABLE `training_assessment_result`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `training_pdf`
--
ALTER TABLE `training_pdf`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `travel`
--
ALTER TABLE `travel`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `upazilas`
--
ALTER TABLE `upazilas`
  MODIFY `id` int(2) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_ibfk_1` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `retail_type`
--
ALTER TABLE `retail_type`
  ADD CONSTRAINT `retail_type_ibfk_1` FOREIGN KEY (`channel_type_id`) REFERENCES `retail_channel_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `upazilas`
--
ALTER TABLE `upazilas`
  ADD CONSTRAINT `upazilas_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
