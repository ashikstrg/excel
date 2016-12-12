-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2016 at 02:29 PM
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
-- Table structure for table `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1472039807),
('author', '2', 1472042727),
('FSM', '12', 1475413127),
('FSM', '17', 1481457511),
('FSM', '18', 1481457582),
('FSM', '20', 1481466881),
('FSM', '21', 1481466950),
('FSM', '7', 1472042727),
('Sales', '10', 1475412843),
('Sales', '11', 1475413034),
('Sales', '13', 1475470918),
('Sales', '9', 1475412693),
('Trainer', '14', 1477566821),
('Trainer', '15', 1477566997),
('Trainer', '16', 1477571474);

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

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1472039369, 1472039369),
('author', 1, NULL, NULL, NULL, 1472039368, 1472039368),
('FSM', 1, NULL, NULL, NULL, 1475054029, 1475054029),
('post/create', 2, 'create post', NULL, NULL, 1472039101, 1472039101),
('post/delete', 2, 'delete post', NULL, NULL, 1472039101, 1472039101),
('post/index', 2, 'Create a index', NULL, NULL, 1472039101, 1472039101),
('post/mdelete', 2, 'delete post', NULL, NULL, 1472039101, 1472039101),
('post/update', 2, 'Update post', NULL, NULL, 1472039101, 1472039101),
('post/view', 2, 'view post', NULL, NULL, 1472039101, 1472039101),
('Sales', 1, NULL, NULL, NULL, 1475054029, 1475054029),
('super', 1, NULL, NULL, NULL, 1472377276, 1472377276),
('Trainer', 1, NULL, NULL, NULL, 1475054029, 1475054029),
('updateOwnPost', 2, 'Update own post', 'isAuthor', NULL, 1472377276, 1472377276);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'author'),
('author', 'post/create'),
('admin', 'post/delete'),
('author', 'post/index'),
('admin', 'post/mdelete'),
('admin', 'post/update'),
('updateOwnPost', 'post/update'),
('author', 'post/view'),
('author', 'updateOwnPost');

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

--
-- Dumping data for table `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('isAuthor', 'O:35:"common\\modules\\auth\\rbac\\AuthorRule":3:{s:4:"name";s:8:"isAuthor";s:9:"createdAt";i:1472377275;s:9:"updatedAt";i:1472377275;}', 1472377275, 1472377275);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE IF NOT EXISTS `districts` (
  `id` int(2) unsigned NOT NULL,
  `division_id` int(2) unsigned NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_id`, `name`) VALUES
(1, 3, 'Dhaka'),
(2, 3, 'Faridpur'),
(3, 3, 'Gazipur'),
(4, 3, 'Gopalganj'),
(5, 3, 'Jamalpur'),
(6, 3, 'Kishoreganj'),
(7, 3, 'Madaripur'),
(8, 3, 'Manikganj'),
(9, 3, 'Munshiganj'),
(10, 3, 'Mymensingh'),
(11, 3, 'Narayanganj'),
(12, 3, 'Narsingdi'),
(13, 3, 'Netrokona'),
(14, 3, 'Rajbari'),
(15, 3, 'Shariatpur'),
(16, 3, 'Sherpur'),
(17, 3, 'Tangail'),
(18, 5, 'Bogra'),
(19, 5, 'Joypurhat'),
(20, 5, 'Naogaon'),
(21, 5, 'Natore'),
(22, 5, 'Nawabganj'),
(23, 5, 'Pabna'),
(24, 5, 'Rajshahi'),
(25, 5, 'Sirajgonj'),
(26, 6, 'Dinajpur'),
(27, 6, 'Gaibandha'),
(28, 6, 'Kurigram'),
(29, 6, 'Lalmonirhat'),
(30, 6, 'Nilphamari'),
(31, 6, 'Panchagarh'),
(32, 6, 'Rangpur'),
(33, 6, 'Thakurgaon'),
(34, 1, 'Barguna'),
(35, 1, 'Barisal'),
(36, 1, 'Bhola'),
(37, 1, 'Jhalokati'),
(38, 1, 'Patuakhali'),
(39, 1, 'Pirojpur'),
(40, 2, 'Bandarban'),
(41, 2, 'Brahmanbaria'),
(42, 2, 'Chandpur'),
(43, 2, 'Chittagong'),
(44, 2, 'Comilla'),
(45, 2, 'Cox''s Bazar'),
(46, 2, 'Feni'),
(47, 2, 'Khagrachari'),
(48, 2, 'Lakshmipur'),
(49, 2, 'Noakhali'),
(50, 2, 'Rangamati'),
(51, 7, 'Habiganj'),
(52, 7, 'Maulvibazar'),
(53, 7, 'Sunamganj'),
(54, 7, 'Sylhet'),
(55, 4, 'Bagerhat'),
(56, 4, 'Chuadanga'),
(57, 4, 'Jessore'),
(58, 4, 'Jhenaidah'),
(59, 4, 'Khulna'),
(60, 4, 'Kushtia'),
(61, 4, 'Magura'),
(62, 4, 'Meherpur'),
(63, 4, 'Narail'),
(64, 4, 'Satkhira');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE IF NOT EXISTS `divisions` (
  `id` int(2) unsigned NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`) VALUES
(1, 'Barisal'),
(2, 'Chittagong'),
(3, 'Dhaka'),
(4, 'Khulna'),
(5, 'Rajshahi'),
(6, 'Rangpur'),
(7, 'Sylhet');

-- --------------------------------------------------------

--
-- Table structure for table `hr`
--

CREATE TABLE IF NOT EXISTS `hr` (
  `id` int(11) unsigned NOT NULL,
  `retail_id` int(11) unsigned DEFAULT NULL,
  `retail_dms_code` varchar(100) DEFAULT NULL,
  `retail_name` varchar(150) DEFAULT NULL,
  `retail_channel_type` varchar(100) DEFAULT NULL,
  `retail_type` varchar(100) DEFAULT NULL,
  `retail_zone` varchar(150) DEFAULT NULL,
  `retail_area` varchar(250) DEFAULT NULL,
  `retail_territory` varchar(250) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr`
--

INSERT INTO `hr` (`id`, `retail_id`, `retail_dms_code`, `retail_name`, `retail_channel_type`, `retail_type`, `retail_zone`, `retail_area`, `retail_territory`, `designation_id`, `designation`, `employee_type_id`, `employee_type`, `employee_id`, `tm_parent`, `tm_employee_id`, `tm_name`, `am_parent`, `am_employee_id`, `am_name`, `csm_parent`, `csm_employee_id`, `csm_name`, `name`, `status`, `joining_date`, `leaving_date`, `image`, `image_src_filename`, `image_web_filename`, `contact_no_official`, `contact_no_personal`, `name_immergency_contact_person`, `relation_immergency_contact_person`, `contact_no_immergency`, `email_address`, `email_address_official`, `bank_name`, `bank_ac_name`, `bank_ac_no`, `bkash_no`, `blood_group`, `graduation_status`, `educational_qualification`, `educational_institute`, `educational_qualification_second_last`, `educational_institute_second_last`, `previous_experience`, `previous_experience_two`, `permanent_address`, `present_address`, `created_at`, `created_by`, `updated_at`, `updated_by`, `user_id`) VALUES
(10, 8, 'TST4', 'Test Retail One', 'P-SES', 'SES', 'East', 'Dhanmondi', 'Test Territory One', 5, 'SEC', 0, 'FSM', 'S12458', 4, '3546456', 'Test Name TM', 3, '98765', 'Test Name AM', 2, '123567', 'Ashikur Rahman', 'Ashikur Rahman', 'Active', '2016-09-08', NULL, '', '1.png', 'hdAKk8OdQF4dc1Mxzp4bdsQibUXcWzqT.png', '11111111111', '11111111111', 'Ashikur Rahman', 'Sibling', '11111111111', 'ashik@analyzenbd.com', 'ashik@analyzenbd.com', 'Brac Bank', 'Test Name', '11111111111111111111', '11111111111', 'A+', 'Graduated', 'HSC', 'Amrita Lal De', 'SSC', 'Zilla School', 6, 2, 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', '2016-09-28 00:42:53', 'admin1', NULL, NULL, 7),
(11, 7, 'TST3', 'dewqfw', 'X-Tel', 'RNG', 'East', 'Dhanmondi', 'ewvr', 6, 'RSA-G', 0, 'FSM', 'R12458', 7, 'TM123456', 'Test NameTM', 6, 'AM123456', 'Test Name CSM', 5, 'MS1234', 'Test Name CSM', 'Test Name RSAG', 'Active', '2016-10-01', NULL, '', 'ashik.jpg', '8No1F9R-IFlcUw7FTsMtGlVrIA9uL16L.jpg', '11111111111', '11111111111', 'Ashikur Rahman', 'Sibling', '11111111111', 'ashik5@analyzenbd.com', 'ashik5@analyzenbd.com', 'Brac Bank', 'Test Name', '11111111111111111111', '11111111111', 'B+', 'Graduated', 'HSC', 'Amrita Lal De', 'SSC', 'Zilla School', 6, 2, 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', '2016-10-02 02:58:45', 'admin1', '2016-11-24 01:21:29', 'admin1', 12),
(12, 8, 'TST4', 'Test Retail One', 'P-SES', 'SES', 'East', 'Dhanmondi', 'Test Territory One', 5, 'SEC', 0, 'FSM', 'S0987', 7, 'TM123456', 'Test NameTM', 6, 'AM123456', 'Test Name CSM', 5, 'MS1234', 'Test Name CSM', 'Ashikur Rahman', 'Active', '2016-12-31', NULL, '', 'ashik.jpg', 'rSQsF7DXol6JWjs2_vyzjhVkdXl1OwfJ.jpg', '11111111111', '11111111111', 'Ashikur Rahman', 'Sibling', '11111111111', 'ashik@analyzenbd.com', 'ashik_sec1@analyzenbd.com', 'Brac Bank', 'Test Name', '11111111111111111111', '11111111111', 'A-', 'Graduated', 'HSC', 'Amrita Lal De', 'SSC', 'Zilla School', 6, 2, 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', '2016-12-11 14:34:38', 'admin1', NULL, NULL, 20),
(13, 8, 'TST4', 'Test Retail One', 'P-SES', 'SES', 'East', 'Dhanmondi', 'Test Territory One', 5, 'SEC', 0, 'FSM', 'S10912', 7, 'TM123456', 'Test NameTM', 6, 'AM123456', 'Test Name CSM', 5, 'MS1234', 'Test Name CSM', 'Ashikur Rahman', 'Active', '2016-12-01', NULL, '', 'ashik.jpg', 'd1nXCqWFpxJXqs-gOlhSB1thejyp9U4c.jpg', '11111111111', '11111111111', 'Ashikur Rahman', 'Sibling', '11111111111', 'ashik@analyzenbd.com', 'ashik_sec2@analyzenbd.com', 'Brac Bank', 'Test Name', '11111111111111111111', '11111111111', 'B+', 'Graduated', 'HSC', 'Amrita Lal De', 'SSC', 'Zilla School', 6, 2, 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', '2016-12-11 14:35:48', 'admin1', '2016-12-12 11:34:38', 'admin1', 21);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_designation`
--

INSERT INTO `hr_designation` (`id`, `type`, `employee_type_id`, `employee_type`, `parent`, `parent_name`) VALUES
(1, 'Admin', 1, 'Admin', 1, 'Admin'),
(2, 'CSM', 2, 'Sales', 1, 'Admin'),
(3, 'AM', 2, 'Sales', 2, 'CSM'),
(4, 'TM', 2, 'Sales', 3, 'AM'),
(5, 'SEC', 3, 'FSM', 4, 'TM'),
(6, 'RSA-G', 3, 'FSM', 4, 'TM'),
(7, 'RSA-R', 3, 'FSM', 4, 'TM'),
(8, 'RSA-Y', 3, 'FSM', 4, 'TM'),
(9, 'Trainer', 4, 'Trainer', 1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `hr_employee_type`
--

CREATE TABLE IF NOT EXISTS `hr_employee_type` (
  `id` int(8) unsigned NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_employee_type`
--

INSERT INTO `hr_employee_type` (`id`, `type`) VALUES
(1, 'Admin'),
(2, 'Sales'),
(3, 'FSM'),
(4, 'Trainer');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_management`
--

INSERT INTO `hr_management` (`id`, `designation_id`, `designation`, `employee_type_id`, `employee_type`, `employee_id`, `name`, `status`, `joining_date`, `leaving_date`, `image`, `image_src_filename`, `image_web_filename`, `contact_no_official`, `contact_no_personal`, `name_immergency_contact_person`, `relation_immergency_contact_person`, `contact_no_immergency`, `email_address`, `email_address_official`, `blood_group`, `permanent_address`, `present_address`, `created_at`, `created_by`, `updated_at`, `updated_by`, `user_id`) VALUES
(2, 1, 'Admin', 1, 'Admin', '123456', 'Ashik M', 'Active', '2016-10-01', NULL, NULL, NULL, 'IciQv8Wog81NToL9wBSYCNZE3MPjR8s2.png', '01790738231', '01790738231', 'Me', 'Self', '01790738231', 'ashik@analyzenbd.com', 'ashik@analyzenbd.com', 'B+', 'N/A', 'N/A', '2016-09-30 18:00:00', 'Admin', NULL, NULL, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_sales`
--

INSERT INTO `hr_sales` (`id`, `designation_id`, `designation`, `employee_type_id`, `employee_type`, `employee_id`, `parent`, `manager_id`, `manager_name`, `manager_designation`, `name`, `status`, `joining_date`, `leaving_date`, `image`, `image_src_filename`, `image_web_filename`, `contact_no_official`, `contact_no_personal`, `name_immergency_contact_person`, `relation_immergency_contact_person`, `contact_no_immergency`, `email_address`, `email_address_official`, `bank_name`, `bank_ac_name`, `bank_ac_no`, `bkash_no`, `blood_group`, `graduation_status`, `educational_qualification`, `educational_institute`, `educational_qualification_second_last`, `educational_institute_second_last`, `previous_experience`, `previous_experience_two`, `permanent_address`, `present_address`, `created_at`, `created_by`, `updated_at`, `updated_by`, `user_id`) VALUES
(1, 1, 'Admin', 1, 'Admin', '123456', 0, 'N/A', 'N/A', 'N/A', 'HR Admin', 'Active', '2016-09-21', NULL, NULL, NULL, 'IciQv8Wog81NToL9wBSYCNZE3MPjR8s2.png', 'N/A', 'N/A', '', '0', 'N/A', 'admin@email.com', '', '', '', '', '', 'N/A', 'Graduated', 'N/A', 'N/A', 'N/A', 'N/A', 0, 0, 'N/A', 'N/A', '2016-09-20 10:00:00', 'admin1', NULL, NULL, 1),
(5, 2, 'CSM', 0, 'Sales', 'MS1234', 1, '123456', 'HR Admin', 'Admin', 'Test Name CSM', 'Active', '2016-10-01', NULL, '', '1.png', 'IciQv8Wog81NToL9wBSYCNZE3MPjR8s2.png', '11111111111', '11111111111', 'Ashikur Rahman', 'Brother', '11111111111', 'ashik1@analyzenbd.com', 'ashik1@analyzenbd.com', 'Test Bank Name', 'Test Bank  Account', 'Test Account Number', '11111111111', 'A+', 'Graduated', 'MSC', 'NSU', 'BSC', 'BRAC', 12, 10, 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', '2016-10-02 08:51:31', 'admin1', '2016-10-16 05:23:37', 'admin1', 9),
(6, 3, 'AM', 0, 'Sales', 'AM123456', 5, 'MS1234', 'Test Name CSM', 'CSM', 'Test Name CSM', 'Active', '2016-10-01', NULL, '', '5.png', 'B7HZ_FOsjhY5bUyarw1rx4PvRzZfQi0Y.png', '11111111111', '11111111111', 'Ashikur Rahman', 'Brother', '11111111111', 'ashik2@analyzenbd.com', 'ashik2@analyzenbd.com', 'Test Bank Name', 'Test Bank  Account', 'Test Account Number', '11111111111', 'A+', 'Graduated', 'MSC', 'NSU', 'BSC', 'BRAC', 12, 10, 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', '2016-10-02 08:54:01', 'admin1', '2016-10-16 05:23:14', 'admin1', 10),
(7, 4, 'TM', 0, 'Sales', 'TM123456', 6, 'AM123456', 'Test Name CSM', 'AM', 'Test NameTM', 'Active', '2016-10-01', NULL, '', '4.png', '_BbpI72choM7Kd2FORuQ2sIkQI-p1H0a.png', '11111111111', '11111111111', 'Ashikur Rahman', 'Brother', '11111111111', 'ashik3@analyzenbd.com', 'ashik3@analyzenbd.com', 'Test Bank Name', 'Test Bank  Account', 'Test Account Number', '11111111111', 'A+', 'Graduated', 'MSC', 'NSU', 'BSC', 'BRAC', 12, 10, 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', '2016-10-02 08:57:12', 'admin1', '2016-10-16 05:22:54', 'admin1', 11),
(8, 3, 'AM', 0, 'Sales', '12456', 5, 'MS1234', 'Test Name CSM', 'CSM', 'Test Name AM', 'Active', '2016-10-28', NULL, '', '2.png', 'cx6OW_edzfFQk1hwpp2YAjNSqPQwSvbA.png', '11111111111', '11111111111', 'Ashikur Rahman', 'Brother', '11111111111', 'ashik123@analyzenbd.com', 'ashik123@analyzenbd.com', 'Test Bank Name', 'Test Bank  Account', 'Test Account Number', '11111111111', 'A+', 'Graduated', 'MSC', 'NSU', 'BSC', 'BRAC', 12, 10, 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', '2016-10-03 01:01:55', 'admin1', '2016-10-16 05:22:27', 'admin1', 13);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hr_trainer`
--

INSERT INTO `hr_trainer` (`id`, `designation_id`, `designation`, `employee_type_id`, `employee_type`, `employee_id`, `parent`, `manager_id`, `manager_name`, `manager_designation`, `name`, `status`, `joining_date`, `leaving_date`, `image`, `image_src_filename`, `image_web_filename`, `contact_no_official`, `contact_no_personal`, `name_immergency_contact_person`, `relation_immergency_contact_person`, `contact_no_immergency`, `email_address`, `email_address_official`, `blood_group`, `permanent_address`, `present_address`, `created_at`, `created_by`, `updated_at`, `updated_by`, `user_id`) VALUES
(2, 9, 'Trainer', 0, 'Trainer', 'TR0976', 1, '123456', 'HR Admin', 'Admin', 'Test Trainer Two', 'Active', '2016-11-01', NULL, '', '2.png', 'Id69eIocDUoNcDm9rsnegTs2z93mSO66.png', '01111111111', '01111111111', 'Ashikur Rahman', '01111111111', '01111111111', 'ashik222@analyzenbd.com', 'ashik222@analyzenbd.com', 'O+', 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', '2016-10-27 07:16:35', 'admin1', NULL, NULL, 15),
(3, 9, 'Trainer', 0, 'Trainer', 'TRIN1234', 1, '123456', 'HR Admin', 'Admin', 'Test Name', 'Inactive', '2016-10-01', NULL, '', 'ashik.jpg', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg', '01111111111', '01111111111', 'Ashikur Rahman', 'Brother', '01111111111', 'ashik12@analyzenbd.com', 'ashik12@analyzenbd.com', 'O-', 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', '2016-10-27 08:31:12', 'admin1', '2016-11-09 02:38:37', 'admin1', 16);

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
) ENGINE=InnoDB AUTO_INCREMENT=316 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `left_menu`
--

INSERT INTO `left_menu` (`id`, `name`, `parent_id`, `label`, `icon`, `url`, `used_by`) VALUES
(1, 'Trainer Dashboard', 0, 'Dashboard', 'fa fa-dashboard', '#', 'Trainer'),
(201, 'Admin Dashboard', 0, 'Dashboard', 'fa fa-dashboard', '#', 'admin'),
(202, 'Admin Home', 201, 'Home', 'fa fa-home', '/site/index', 'admin'),
(204, 'Retail Utility', 0, 'Retail Utility', 'fa fa-wrench', '#', 'admin'),
(205, 'Channel Type Add', 204, 'Channel Type Add', 'fa fa-square-o', '/channel-type/create', 'admin'),
(206, 'Channel Type Control Panel', 204, 'Channel Type Config', 'fa fa-square-o', '/channel-type/index', 'admin'),
(207, 'Retail Type Add', 204, 'Retail Type Add', 'fa fa-square-o', '/retail-type/create', 'admin'),
(208, 'Retail Type Index', 204, 'Retail Type Config', 'fa fa-square-o', '/retail-type/index', 'admin'),
(209, 'Retail Zone Create', 204, 'Retail Zone Add', 'fa fa-square-o', '/retail-zone/create', 'admin'),
(210, 'Retail Zone Index', 204, 'Retail Zone Config', 'fa fa-square-o', '/retail-zone/index', 'admin'),
(211, 'Retail Area Create', 204, 'Retail Area Add', 'fa fa-square-o', '/retail-area/create', 'admin'),
(212, 'Retail Area Index', 204, 'Retail Area Config', 'fa fa-square-o', '/retail-area/index', 'admin'),
(213, 'Retail Location Create', 204, 'Retail Location Add', 'fa fa-square-o', '/retail-location/create', 'admin'),
(214, 'Retail Location Index', 204, 'Retail Location Config', 'fa fa-square-o', '/retail-location/index', 'admin'),
(215, 'Utility Settings', 0, 'Utility Settings', 'fa fa-cog', '#', 'admin'),
(217, 'Division Index', 215, 'Division Config', 'fa fa-square-o', '/divisions/index', 'admin'),
(218, 'Districts Index', 215, 'District Config', 'fa fa-square-o', '/districts/index', 'admin'),
(219, 'Upazilas Index', 215, 'Upazila Config', 'fa fa-square-o', '/upazilas/index', 'admin'),
(220, 'Retail Hash', 0, 'Retail Module', 'fa fa-bullseye', '#', 'admin'),
(221, 'Retail Create', 220, 'Retail Add', 'fa fa-square-o', '/retail/create', 'admin'),
(222, 'Retail Index', 220, 'Retail Config', 'fa fa-square-o', '/retail/index', 'admin'),
(223, 'HR Utility', 0, 'HR Utility', 'fa fa-user-plus', '#', 'admin'),
(224, 'HR | Employee Type Create', 223, 'Employee Type Add', 'fa fa-square-o', '/hr-employee-type/create', 'admin'),
(225, 'HR | Employee Type Index', 223, 'Employee Type Conf', 'fa fa-square-o', '/hr-employee-type/index', 'admin'),
(226, 'HR | Designation Create', 223, 'Designation Add', 'fa fa-square-o', '/hr-designation/create', 'admin'),
(227, 'HR | Designation Index', 223, 'Designation Config', 'fa fa-square-o', '/hr-designation/index', 'admin'),
(228, 'HR Hash', 0, 'HR Module', 'fa fa-user', '#', 'admin'),
(229, 'HR Create', 228, 'HR Add (FSM)', 'fa fa-square-o', '/hr/create', 'admin'),
(230, 'HR Index', 228, 'HR Config (FSM)', 'fa fa-square-o', '/hr/index', 'admin'),
(233, 'HR-Sales Create', 228, 'HR Add (Sales)', 'fa fa-square-o', '/hr-sales/create', 'admin'),
(234, 'HR-Sales Index', 228, 'HR Config (Sales)', 'fa fa-square-o', '/hr-sales/index', 'admin'),
(235, 'Product Utility Hash', 0, 'Product Utility', 'fa fa-product-hunt', '#', 'admin'),
(236, 'Product-Type Create', 235, 'Product Type Add', 'fa fa-square-o', '/product-type/create', 'admin'),
(237, 'Product-Type Index', 235, 'Product Type Config', 'fa fa-square-o', '/product-type/index', 'admin'),
(238, 'Product Hash', 0, 'Product Module', 'fa fa-gift', '#', 'admin'),
(239, 'Product Create', 238, 'Product Add', 'fa fa-square-o', '/product/create', 'admin'),
(240, 'Product Index', 238, 'Product Config', 'fa fa-square-o', '/product/index', 'admin'),
(241, 'Product-Color Create', 235, 'Product Color Add', 'fa fa-square-o', '/product-color/create', 'admin'),
(242, 'Product-Color Index', 235, 'Product Color Config', 'fa fa-square-o', '/product-color/index', 'admin'),
(243, 'User Hash', 0, 'User Module', 'fa fa-users', '#', 'admin'),
(244, 'User Index', 243, 'User Config', 'fa fa-square-o', '/user/index', 'admin'),
(245, 'FSM Dashboard', 0, 'Dashboard', 'fa fa-dashboard', '#', 'FSM'),
(246, 'FSM Home Index', 245, 'Home', 'fa fa-home', '/site/index', 'FSM'),
(247, 'FSM Sales Operation', 0, 'Sales Operation', 'fa fa-gift', '#', 'FSM'),
(248, 'FSM Sales Create', 247, 'Sales Data Upload', 'fa fa-circle', '/sales-batch/create', 'FSM'),
(249, 'FSM SALES BATCH INDEX', 247, 'Sales Batch File', 'fa fa-circle', '/sales-batch/index', 'FSM'),
(250, 'FSM Slaes Index', 247, 'Sales Raw Data', 'fa fa-circle', '/sales/index', 'FSM'),
(251, 'Sales Hash', 0, 'Sales FSM', 'fa fa-gift', '#', 'Sales'),
(252, 'Sales Batch Index', 251, 'Sales Batch File', 'fa fa-circle', '/sales-batch/index', 'Sales'),
(253, 'Slaes Index', 251, 'Sales Raw Data', 'fa fa-circle', '/sales/index', 'Sales'),
(254, 'Target Hash', 0, 'Target Operation', 'fa fa-arrows', '#', 'admin'),
(255, 'Target Create', 254, 'Upload Target', 'fa fa-circle', '/target-batch/create', 'admin'),
(256, 'Target Batch Index', 254, 'Active Batch File', 'fa fa-circle', '/target-batch/index', 'admin'),
(257, 'Target Index', 254, 'Target Raw Data', 'fa fa-circle', '/target/index', 'admin'),
(258, 'Target Hash', 0, 'Target Operation', 'fa fa-arrows', '#', 'Sales'),
(261, 'Target Index', 258, 'Target Raw Data', 'fa fa-circle', '/target/index', 'Sales'),
(262, 'Sales National Hash', 0, 'National Sales', 'fa fa-mobile', '#', 'Sales'),
(263, 'Slaes National', 262, 'Sales Volume', 'fa fa-circle', '/sales/national', 'Sales'),
(264, 'Stock Hash', 0, 'Stock Operation', 'fa fa-hdd-o', '#', 'FSM'),
(265, 'Stock Batch Create', 264, 'Upload Stock', 'fa fa-circle', '/stock-batch/create', 'FSM'),
(266, 'Stock Batch Index', 264, 'Stock Batch Data', 'fa fa-circle', '/stock-batch/index', 'FSM'),
(267, 'Stock Index', 264, 'Stock Raw Data', 'fa fa-circle', '/stock/index', 'FSM'),
(268, 'Slaes National', 262, 'Sales Value', 'fa fa-circle', '/sales/national_val', 'Sales'),
(269, 'Stock Daily Hash', 0, 'Stock Module', 'fa fa-hdd-o', '#', 'Sales'),
(270, 'Stock Index', 269, 'Stock Raw Data', 'fa fa-circle', '/stock/index', 'Sales'),
(271, 'Stock Daily', 269, 'Daily Stock', 'fa fa-circle', '/stock/daily', 'Sales'),
(272, 'Leaderboard', 0, 'Leaderboard', 'fa fa-arrow-circle-up', '#', 'Sales'),
(273, 'Leaderboard', 272, 'Volume', 'fa fa-circle', '/target/leaderboard', 'Sales'),
(274, 'Leaderboard Module Value', 272, 'Value', 'fa fa-circle', '/target/leaderboard_value', 'Sales'),
(275, 'Sales Hash', 0, 'Sales Module', 'fa fa-shopping-basket ', '#', 'Sales'),
(276, 'Sales FSM Model', 275, 'F/M Report (Vol)', 'fa fa-circle', '/sales/retail_model', 'Sales'),
(277, 'Sales FSM Model Value', 275, 'F/M Report (Val)', 'fa fa-circle', '/sales/retail_model_value', 'Sales'),
(278, 'Sales FSM National', 275, 'F/D Report (Vol)', 'fa fa-circle', '/sales/national_retail', 'Sales'),
(279, 'Sales FSM National Value', 275, 'F/D Report (Val)', 'fa fa-circle', '/sales/national_fsm_value', 'Sales'),
(280, 'Target Trend Hash', 0, 'Target Trend', 'fa fa-bar-chart', '#', 'Sales'),
(281, 'Target VS Achievement', 280, 'TGT VS ACHV (Vol)', 'fa fa-circle', '/target/trend_achievement', 'Sales'),
(282, 'Target VS Achievement', 280, 'TGT VS ACHV (Val)', 'fa fa-circle', '/target/trend_achievement_value', 'Sales'),
(283, 'HR-Trainer Create', 228, 'HR Add (Trainer)', 'fa fa-square-o', '/hr-trainer/create', 'admin'),
(284, 'HR-Trainer Index', 228, 'HR Config (Trainer)', 'fa fa-square-o', '/hr-trainer/index', 'admin'),
(285, 'Training Module Hash', 0, 'Training Module', 'fa fa-calendar-check-o', '#', 'Trainer'),
(286, 'Training PDF Create', 285, 'Add Training', 'fa fa-square-o', '/training-pdf/create', 'Trainer'),
(287, 'Training PDF Index', 285, 'Training Config', 'fa fa-square-o', '/training-pdf/index', 'Trainer'),
(290, 'Notification Module Hash', 0, 'Training Notification', 'fa fa-bell', '#', 'Trainer'),
(291, 'Notification Read', 290, 'Read', 'fa fa-square-o', '/notification/read', 'Trainer'),
(292, 'Notification Unread', 290, 'Unread', 'fa fa-square-o', '/notification/unread', 'Trainer'),
(293, 'Training Assessment Questin Module Hash', 0, 'Assessment Module', 'fa fa-question-circle-o ', '#', 'Trainer'),
(294, 'Trainer Home', 1, 'Home', 'fa fa-home', '/site/index', 'Trainer'),
(295, 'Trainer Assessment Category Create', 293, 'Add Assessment', 'fa fa-square-o', '/training-assessment-category/create', 'Trainer'),
(296, 'Trainer Assessment Category Index', 293, 'Assessment Config', 'fa fa-square-o', '/training-assessment-category/index', 'Trainer'),
(297, 'Assessment', 0, 'Monthly Assessment', 'fa fa-calendar-check-o', '#', 'FSM'),
(298, 'Assessment Check', 297, 'Assessment Check', 'fa fa-square-o', '/training-assessment-category/assessment', 'FSM'),
(299, 'MI Module', 0, 'MI Module', 'fa fa-database', '#', 'Sales'),
(300, 'MI Product Create', 299, 'Add Product', 'fa fa-square-o', '/mi-product/create', 'Sales'),
(301, 'MI Product Index', 299, 'Product Config', 'fa fa-square-o', '/mi-product/index', 'Sales'),
(302, 'MI Infra Create', 299, 'Add Infra', 'fa fa-square-o', '/mi-infra/create', 'Sales'),
(303, 'MI Infra Index', 299, 'Infra Config', 'fa fa-square-o', '/mi-infra/index', 'Sales'),
(304, 'MI Tpcp Create', 299, 'Add TP&CP', 'fa fa-square-o', '/mi-tpcp/create', 'Sales'),
(305, 'MI Tpcp Index', 299, 'TP&CP Config', 'fa fa-square-o', '/mi-tpcp/index', 'Sales'),
(306, 'MI Visibility Create', 299, 'Add Visibility', 'fa fa-square-o', '/mi-visibility/create', 'Sales'),
(307, 'MI Visibility Index', 299, 'Visibility Config', 'fa fa-square-o', '/mi-visibility/index', 'Sales'),
(308, 'Travel Module', 0, 'Travel Module', 'fa fa-subway', '#', 'Sales'),
(309, 'Travel Create', 308, 'Travel Application', 'fa fa-square-o', '/travel/create', 'Sales'),
(310, 'Travel Index', 308, 'Application Status', 'fa fa-square-o', '/travel/index', 'Sales'),
(311, 'Travel Manage', 308, 'Managerial Data', 'fa fa-square-o', '/travel/manage', 'Sales'),
(312, 'Travel Config', 308, 'Application Config', 'fa fa-square-o', '/travel/config', 'Sales'),
(313, 'Stock Create', 264, 'Add Stock', 'fa fa-circle', '/stock/create', 'FSM'),
(314, 'FSM Sales Create', 247, 'Add Sales', 'fa fa-circle', '/sales/create', 'FSM'),
(315, 'Target Batch Deleted', 254, 'Deleted Batch File', 'fa fa-circle', '/target-batch/deleted', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1471863108),
('m130524_201442_init', 1471863113),
('m140506_102106_rbac_init', 1472023374);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_infra`
--

INSERT INTO `mi_infra` (`id`, `brand`, `retail_type`, `store_size`, `owner`, `distributor_type`, `sales_team`, `rsa`, `fsm_type`, `region`, `district`, `town`, `hr_id`, `hr_employee_id`, `hr_name`, `hr_designation`, `hr_employee_type`, `am_employee_id`, `am_name`, `csm_employee_id`, `csm_name`, `created_at`, `updated_at`) VALUES
(1, 'Nokia', 'Brandshop', '1200', 'Company', 'RD', 'ABC', 'Test RSA', 'SEC', 'Dhanmondi', 'Dhaka', 'Dhaka', 7, 'TM123456', 'Test NameTM', 'TM', 'Sales', 'AM123456', 'Test Name CSM', 'MS1234', 'Test Name CSM', '2016-12-08 15:17:48', NULL),
(3, 'Nokia 2', 'Brandshop', '1200', 'Franchise', 'RD', 'ABC', 'Test RSA', 'SEC', 'Dhanmondi', 'Dhaka', 'Dhaka', 7, 'TM123456', 'Test NameTM', 'TM', 'Sales', 'AM123456', 'Test Name CSM', 'MS1234', 'Test Name CSM', '2016-12-08 15:26:18', '2016-12-08 15:28:10');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_product`
--

INSERT INTO `mi_product` (`id`, `brand`, `model`, `display_size`, `display_type`, `generation`, `sim`, `weight`, `ram`, `rom`, `processor`, `battery`, `camera_rear`, `camera_front`, `special_feature`, `price`, `sale_out_vol`, `region`, `district`, `town`, `hr_id`, `hr_employee_id`, `hr_name`, `hr_designation`, `hr_employee_type`, `am_employee_id`, `am_name`, `csm_employee_id`, `csm_name`, `created_at`, `updated_at`) VALUES
(2, 'Nokia', 'Lumia', '5', 'Amoled', '2G', 'Single', '12', '2', '2', 'Dual Core', '2500', '12', '5', 'None', '12000.00', 12, 'Dhanmondi', 'Dhaka', 'Dhaka', 7, 'TM123456', 'Test NameTM', 'TM', 'Sales', 'AM123456', 'Test Name CSM', 'MS1234', 'Test Name CSM', '2016-12-08 14:19:53', NULL),
(3, 'Nokia 2', 'Lumia 2', '5', 'Amoled', '2G', 'Dual', '12', '2', '2', 'Dual Core', '2500', '12', '5', 'None', '12000.00', 12, 'Dhanmondi', 'Dhaka', 'Dhaka', 7, 'TM123456', 'Test NameTM', 'TM', 'Sales', 'AM123456', 'Test Name CSM', 'MS1234', 'Test Name CSM', '2016-12-08 14:20:31', '2016-12-08 15:15:32');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_tpcp`
--

INSERT INTO `mi_tpcp` (`id`, `brand`, `model`, `trade_promo`, `consumer_promo`, `fsm_incentive_plan`, `other_scheme`, `region`, `district`, `town`, `hr_id`, `hr_employee_id`, `hr_name`, `hr_designation`, `hr_employee_type`, `am_employee_id`, `am_name`, `csm_employee_id`, `csm_name`, `created_at`, `updated_at`) VALUES
(1, 'Nokia', 'Lumia', 'Yes', 'Yes', 'Yes', 'Yes', 'Dhanmondi', 'Dhaka', 'Dhaka', 7, 'TM123456', 'Test NameTM', 'TM', 'Sales', 'AM123456', 'Test Name CSM', 'MS1234', 'Test Name CSM', '2016-12-08 15:46:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mi_visibility`
--

CREATE TABLE IF NOT EXISTS `mi_visibility` (
  `id` int(11) unsigned NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mi_visibility`
--

INSERT INTO `mi_visibility` (`id`, `brand`, `model`, `posm`, `image`, `image_src_filename`, `image_web_filename`, `hr_id`, `hr_employee_id`, `hr_name`, `hr_designation`, `hr_employee_type`, `am_employee_id`, `am_name`, `csm_employee_id`, `csm_name`, `created_at`, `updated_at`) VALUES
(1, 'Nokia', 'Lumia', 'Yes', '', 'elf.jpg', 'rCJ7lcMhvO2QxSjb8R1xi3g6AYG2dKKp.jpg', 7, 'TM123456', 'Test NameTM', 'TM', 'Sales', 'AM123456', 'Test Name CSM', 'MS1234', 'Test Name CSM', '2016-12-08 16:12:51', NULL),
(2, 'Nokia 2', 'Lumia 2', 'Yes', '', 'giftCM.jpg', '0olxS78Fxu9gTgMf3qpe5ticqTHZUkgJ.jpg', 7, 'TM123456', 'Test NameTM', 'TM', 'Sales', 'AM123456', 'Test Name CSM', 'MS1234', 'Test Name CSM', '2016-12-08 16:15:56', '2016-12-08 16:18:09');

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
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `batch`, `name`, `module_name`, `url`, `hr_id`, `hr_employee_id`, `hr_designation`, `hr_employee_type`, `hr_name`, `message`, `read_status`, `seen`, `created_at`, `created_by`, `created_by_name`, `image_web_filename`) VALUES
(1, 18446744073709551615, 'hshcfua', 'Training', '/training-pdf/notification_view?id=23', 10, 'S12458', 'SEC', 'FSM', 'Ashikur Rahman', 'This Is test', 'Unread', NULL, '2016-11-15 18:19:37', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(2, 18446744073709551615, 'hshcfua', 'Training', '/training-pdf/notification_view?id=23', 11, 'R12458', 'RSA-G', 'FSM', 'Test Name RSAG', 'This Is test', 'Read', '2016-11-29 18:11:20', '2016-11-15 18:19:37', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(3, 18446744073709551615, 'hshcfua', 'Training', '/training-pdf/notification_view?id=23', 10, 'S12458', 'SEC', 'FSM', 'Ashikur Rahman', 'This Is test', 'Unread', NULL, '2016-11-15 18:19:42', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(4, 18446744073709551615, 'hshcfua', 'Training', '/training-pdf/notification_view?id=23', 11, 'R12458', 'RSA-G', 'FSM', 'Test Name RSAG', 'This Is test', 'Read', '2016-11-15 19:56:51', '2016-11-15 18:19:42', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(5, 18446744073709551615, 'hshcfua', 'Training', '/training-pdf/notification_view?id=23', 10, 'S12458', 'SEC', 'FSM', 'Ashikur Rahman', 'This Is test', 'Unread', NULL, '2016-11-15 18:19:48', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(6, 18446744073709551615, 'hshcfua', 'Training', '/training-pdf/notification_view?id=23', 11, 'R12458', 'RSA-G', 'FSM', 'Test Name RSAG', 'This Is test', 'Read', '2016-11-15 19:32:10', '2016-11-15 18:19:48', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(7, 18446744073709551615, 'hshcfua', 'Training', '/training-pdf/notification_view?id=23', 10, 'S12458', 'SEC', 'FSM', 'Ashikur Rahman', 'This Is test', 'Unread', NULL, '2016-11-15 18:19:53', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(8, 18446744073709551615, 'hshcfua', 'Training', '/training-pdf/notification_view?id=23', 11, 'R12458', 'RSA-G', 'FSM', 'Test Name RSAG', 'This Is test', 'Read', NULL, '2016-11-15 18:19:53', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(9, 18446744073709551615, 'Test Training Seven', 'Training', '/training-pdf/notification_view?id=22', 6, 'AM123456', 'AM', 'Sales', 'Test Name CSM', 'This Is test', 'Unread', NULL, '2016-11-15 18:19:58', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(10, 18446744073709551615, 'Test Training Seven', 'Training', '/training-pdf/notification_view?id=22', 8, '12456', 'AM', 'Sales', 'Test Name AM', 'This Is test', 'Unread', NULL, '2016-11-15 18:19:58', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(11, 18446744073709551615, 'Test Training Seven', 'Training', '/training-pdf/notification_view?id=22', 7, 'TM123456', 'TM', 'Sales', 'Test NameTM', 'This Is test', 'Unread', NULL, '2016-11-15 18:19:58', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(12, 18446744073709551615, 'Test Training Seven', 'Training', '/training-pdf/notification_view?id=22', 6, 'AM123456', 'AM', 'Sales', 'Test Name CSM', 'This Is test', 'Unread', NULL, '2016-11-15 18:20:07', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(13, 18446744073709551615, 'Test Training Seven', 'Training', '/training-pdf/notification_view?id=22', 8, '12456', 'AM', 'Sales', 'Test Name AM', 'This Is test', 'Unread', NULL, '2016-11-15 18:20:07', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(14, 18446744073709551615, 'Test Training Seven', 'Training', '/training-pdf/notification_view?id=22', 7, 'TM123456', 'TM', 'Sales', 'Test NameTM', 'This Is test', 'Unread', NULL, '2016-11-15 18:20:07', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(15, 18446744073709551615, 'Test Training Seven', 'Training', '/training-pdf/notification_view?id=22', 6, 'AM123456', 'AM', 'Sales', 'Test Name CSM', 'This Is test', 'Unread', NULL, '2016-11-15 18:20:26', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(16, 18446744073709551615, 'Test Training Seven', 'Training', '/training-pdf/notification_view?id=22', 8, '12456', 'AM', 'Sales', 'Test Name AM', 'This Is test', 'Unread', NULL, '2016-11-15 18:20:26', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(17, 18446744073709551615, 'Test Training Seven', 'Training', '/training-pdf/notification_view?id=22', 7, 'TM123456', 'TM', 'Sales', 'Test NameTM', 'This Is test', 'Unread', NULL, '2016-11-15 18:20:26', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(18, 18446744073709551615, 'hshcfua', 'Training', '/training-pdf/notification_view?id=23', 10, 'S12458', 'SEC', 'FSM', 'Ashikur Rahman', 'This Is test', 'Unread', NULL, '2016-11-15 19:08:24', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(19, 18446744073709551615, 'hshcfua', 'Training', '/training-pdf/notification_view?id=23', 11, 'R12458', 'RSA-G', 'FSM', 'Test Name RSAG', 'This Is test', 'Read', '2016-11-15 19:31:19', '2016-11-15 19:08:24', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(20, 18446744073709551615, 'hshcfua', 'Training', '/training-pdf/notification_view?id=23', 10, 'S12458', 'SEC', 'FSM', 'Ashikur Rahman', 'This Is test', 'Unread', NULL, '2016-11-15 19:08:33', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(21, 18446744073709551615, 'hshcfua', 'Training', '/training-pdf/notification_view?id=23', 11, 'R12458', 'RSA-G', 'FSM', 'Test Name RSAG', 'This Is test', 'Read', '2016-11-15 19:24:30', '2016-11-15 19:08:33', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(22, 18446744073709551615, 'hshcfua', 'Training', '/training-pdf/notification_view?id=23', 10, 'S12458', 'SEC', 'FSM', 'Ashikur Rahman', 'This Is test', 'Unread', NULL, '2016-11-15 19:08:39', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(23, 18446744073709551615, 'hshcfua', 'Training', '/training-pdf/notification_view?id=23', 11, 'R12458', 'RSA-G', 'FSM', 'Test Name RSAG', 'This Is test', 'Read', NULL, '2016-11-15 19:08:39', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(24, 17127343470149119016, 'Sample Assessment on Technology for FSM', 'Assessment', '/training-assessment-category/notification_view?id=7', 10, 'S12458', 'SEC', 'FSM', 'Ashikur Rahman', 'Sample Assessment on Technology ', 'Unread', NULL, '2016-11-23 14:42:18', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(25, 17127343470149119016, 'Sample Assessment on Technology for FSM', 'Assessment', '/training-assessment-category/notification_view?id=7', 11, 'R12458', 'RSA-G', 'FSM', 'Test Name RSAG', 'Sample Assessment on Technology ', 'Read', '2016-11-23 16:28:09', '2016-11-23 14:42:18', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(26, 17127343470149119016, 'Sample Assessment on Technology for FSM', 'Assessment', '/training-assessment-category/notification_view?id=7', 10, 'S12458', 'SEC', 'FSM', 'Ashikur Rahman', 'Sample Assessment on Technology ', 'Unread', NULL, '2016-11-24 13:31:30', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(27, 17127343470149119016, 'Sample Assessment on Technology for FSM', 'Assessment', '/training-assessment-category/notification_view?id=7', 11, 'R12458', 'RSA-G', 'FSM', 'Test Name RSAG', 'Sample Assessment on Technology ', 'Read', '2016-11-24 13:31:59', '2016-11-24 13:31:30', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(28, 17127343470149119016, 'Sample Assessment on Technology for FSM', 'Assessment', '/training-assessment-category/notification_view?id=7', 10, 'S12458', 'SEC', 'FSM', 'Ashikur Rahman', 'Sample Assessment on Technology ', 'Unread', NULL, '2016-11-24 16:39:00', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(29, 17127343470149119016, 'Sample Assessment on Technology for FSM', 'Assessment', '/training-assessment-category/notification_view?id=7', 11, 'R12458', 'RSA-G', 'FSM', 'Test Name RSAG', 'Sample Assessment on Technology ', 'Read', '2016-11-24 17:41:07', '2016-11-24 16:39:00', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(30, 17127343470149119016, 'Sample Assessment on Technology for FSM', 'Assessment', '/training-assessment-category/notification_view?id=7', 10, 'S12458', 'SEC', 'FSM', 'Ashikur Rahman', 'Sample Assessment on Technology ', 'Unread', NULL, '2016-11-24 17:42:12', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(31, 17127343470149119016, 'Sample Assessment on Technology for FSM', 'Assessment', '/training-assessment-category/notification_view?id=7', 11, 'R12458', 'RSA-G', 'FSM', 'Test Name RSAG', 'Sample Assessment on Technology ', 'Read', '2016-11-24 17:42:27', '2016-11-24 17:42:12', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(32, 17127343470149119016, 'Sample Assessment on Technology for FSM', 'Assessment', '/training-assessment-category/notification_view?id=7', 10, 'S12458', 'SEC', 'FSM', 'Ashikur Rahman', 'Sample Assessment on Technology ', 'Unread', NULL, '2016-11-24 17:45:30', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(33, 17127343470149119016, 'Sample Assessment on Technology for FSM', 'Assessment', '/training-assessment-category/notification_view?id=7', 11, 'R12458', 'RSA-G', 'FSM', 'Test Name RSAG', 'Sample Assessment on Technology ', 'Read', '2016-11-24 17:45:41', '2016-11-24 17:45:30', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(34, 17127343470149119016, 'Sample Assessment on Technology for FSM', 'Assessment', '/training-assessment-category/notification_view?id=7', 10, 'S12458', 'SEC', 'FSM', 'Ashikur Rahman', 'Sample Assessment on Technology ', 'Unread', NULL, '2016-11-24 17:47:00', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(35, 17127343470149119016, 'Sample Assessment on Technology for FSM', 'Assessment', '/training-assessment-category/notification_view?id=7', 11, 'R12458', 'RSA-G', 'FSM', 'Test Name RSAG', 'Sample Assessment on Technology ', 'Read', '2016-11-24 17:47:10', '2016-11-24 17:47:00', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(36, 17127343470149119016, 'Sample Assessment on Technology for FSM', 'Assessment', '/training-assessment-category/notification_view?id=7', 10, 'S12458', 'SEC', 'FSM', 'Ashikur Rahman', 'Sample Assessment on Technology ', 'Unread', NULL, '2016-11-24 17:49:47', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(37, 17127343470149119016, 'Sample Assessment on Technology for FSM', 'Assessment', '/training-assessment-category/notification_view?id=7', 11, 'R12458', 'RSA-G', 'FSM', 'Test Name RSAG', 'Sample Assessment on Technology ', 'Read', '2016-11-24 17:49:53', '2016-11-24 17:49:47', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(38, 17127343470149119016, 'Sample Assessment on Technology for FSM', 'Assessment', '/training-assessment-category/notification_view?id=7', 10, 'S12458', 'SEC', 'FSM', 'Ashikur Rahman', 'Sample Assessment on Technology ', 'Unread', NULL, '2016-11-24 17:50:52', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(39, 17127343470149119016, 'Sample Assessment on Technology for FSM', 'Assessment', '/training-assessment-category/notification_view?id=7', 11, 'R12458', 'RSA-G', 'FSM', 'Test Name RSAG', 'Sample Assessment on Technology ', 'Read', '2016-11-24 17:51:10', '2016-11-24 17:50:52', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(40, 17127343470149119016, 'Sample Assessment on Technology for FSM', 'Assessment', '/training-assessment-category/notification_view?id=7', 10, 'S12458', 'SEC', 'FSM', 'Ashikur Rahman', 'Sample Assessment on Technology ', 'Unread', NULL, '2016-11-24 19:09:25', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(41, 17127343470149119016, 'Sample Assessment on Technology for FSM', 'Assessment', '/training-assessment-category/notification_view?id=7', 11, 'R12458', 'RSA-G', 'FSM', 'Test Name RSAG', 'Sample Assessment on Technology ', 'Read', '2016-11-24 19:09:37', '2016-11-24 19:09:25', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(42, 14799940753816, 'True Sample Assessment', 'Assessment', '/training-assessment-category/notification_view?id=8', 10, 'S12458', 'SEC', 'FSM', 'Ashikur Rahman', 'New Assessment on S9 Edge', 'Unread', NULL, '2016-11-24 19:49:36', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(43, 14799940753816, 'True Sample Assessment', 'Assessment', '/training-assessment-category/notification_view?id=8', 11, 'R12458', 'RSA-G', 'FSM', 'Test Name RSAG', 'New Assessment on S9 Edge', 'Read', '2016-11-24 19:49:48', '2016-11-24 19:49:36', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(44, 18446744073709551615, 'Test Training Twelve', 'Training', '/training-pdf/notification_view?id=26', 10, 'S12458', 'SEC', 'FSM', 'Ashikur Rahman', 'This Is test', 'Unread', NULL, '2016-11-29 17:50:17', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(45, 18446744073709551615, 'Test Training Twelve', 'Training', '/training-pdf/notification_view?id=26', 11, 'R12458', 'RSA-G', 'FSM', 'Test Name RSAG', 'This Is test', 'Read', '2016-11-29 17:51:50', '2016-11-29 17:50:17', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(46, 18446744073709551615, 'Sample Assessment FSM on New Handset', 'Assessment', '/training-assessment-category/notification_view?id=9', 11, 'R12458', 'RSA-G', 'FSM', 'Test Name RSAG', 'New Assessment on New Handset', 'Read', '2016-11-29 18:04:42', '2016-11-29 18:04:21', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(47, 14799940753816, 'True Sample Assessment', 'Assessment', '/training-assessment-category/notification_view?id=8', 10, 'S12458', 'SEC', 'FSM', 'Ashikur Rahman', 'New Assessment on S9 Edge', 'Unread', NULL, '2016-11-29 18:10:40', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(48, 14799940753816, 'True Sample Assessment', 'Assessment', '/training-assessment-category/notification_view?id=8', 11, 'R12458', 'RSA-G', 'FSM', 'Test Name RSAG', 'New Assessment on S9 Edge', 'Read', '2016-11-29 18:10:57', '2016-11-29 18:10:40', 'TRIN1234', 'Test Name', '7dDRyD2PQ083_GAG6aA2b7JSWA4DU8Xe.jpg'),
(49, 8102593330427083911, 'Travel Request', 'Travel', '/travel/notification_view?id=1', 6, 'AM123456', 'AM', 'Sales', 'Test Name CSM', 'I am going for a training program', 'Read', '2016-12-08 19:11:20', '2016-12-08 18:48:28', 'TM123456', 'Test NameTM', '_BbpI72choM7Kd2FORuQ2sIkQI-p1H0a.png'),
(50, 8102593330643469311, 'Travel Request', 'Travel', '/travel/notification_view?id=2', 6, 'AM123456', 'AM', 'Sales', 'Test Name CSM', 'I am going for a vacation', 'Read', '2016-12-08 19:37:56', '2016-12-08 19:30:26', 'TM123456', 'Test NameTM', '_BbpI72choM7Kd2FORuQ2sIkQI-p1H0a.png'),
(51, 8102593330713563311, 'Travel Request', 'Travel', '/travel/notification_view?id=3', 6, 'AM123456', 'AM', 'Sales', 'Test Name CSM', 'I am going for a new survey', 'Read', '2016-12-08 19:56:20', '2016-12-08 19:48:36', 'TM123456', 'Test NameTM', '_BbpI72choM7Kd2FORuQ2sIkQI-p1H0a.png'),
(52, 8102593330725387511, 'Travel Request', 'Travel', '/travel/notification_view?id=4', 6, 'AM123456', 'AM', 'Sales', 'Test Name CSM', 'I am going for a new training', 'Read', '2016-12-08 19:56:06', '2016-12-08 19:55:38', 'TM123456', 'Test NameTM', '_BbpI72choM7Kd2FORuQ2sIkQI-p1H0a.png');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) unsigned NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `created_by` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `created_by`) VALUES
(1, 'This is a test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) unsigned NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `model_code`, `model_name`, `color`, `type`, `lifting_price`, `rrp`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Galaxy Note 7', 'N7777', 'N7', 'Black', 'Smart', '50000.00', '60000.00', 'Active', '2016-09-27 08:23:24', 'admin1', NULL, NULL),
(2, 'Galaxy S6', 'S6666', 'S6', 'Black', 'Smart', '50000.00', '60000.00', 'Active', '2016-09-27 08:24:34', 'admin1', '2016-09-27 08:36:00', 'admin1'),
(3, 'Galaxy S7', 'S7777', 'S7', 'Black', 'Smart', '60000.00', '70000.00', 'Active', '2016-09-27 08:25:45', 'admin1', NULL, NULL),
(4, 'Galaxy Note 7', 'N7777', 'N7', 'White', 'Smart', '50000.00', '60000.00', 'Active', '2016-09-27 08:23:24', 'admin1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE IF NOT EXISTS `product_color` (
  `id` int(8) unsigned NOT NULL,
  `color` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_color`
--

INSERT INTO `product_color` (`id`, `color`) VALUES
(1, 'Black'),
(2, 'White'),
(3, 'Gold'),
(4, 'Blue'),
(5, 'Rose Gold');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE IF NOT EXISTS `product_type` (
  `id` int(8) unsigned NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `type`) VALUES
(1, 'BAR'),
(2, 'Smart'),
(3, 'Tab'),
(4, 'APS');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE IF NOT EXISTS `properties` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `property_name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `item_id`, `property_name`, `value`) VALUES
(1, 1, 'color', 'blue'),
(2, 1, 'size', 'large'),
(3, 1, 'weight', '65'),
(4, 2, 'color', 'orange'),
(5, 2, 'weight', '57'),
(6, 2, 'size', 'large'),
(7, 3, 'size', 'small'),
(8, 3, 'color', 'red'),
(9, 3, 'weight', '12'),
(10, 4, 'color', 'violet'),
(11, 4, 'size', 'medium'),
(12, 4, 'weight', '34'),
(13, 5, 'color', 'green'),
(14, 5, 'weight', '10');

-- --------------------------------------------------------

--
-- Table structure for table `retail`
--

CREATE TABLE IF NOT EXISTS `retail` (
  `id` int(11) unsigned NOT NULL,
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retail`
--

INSERT INTO `retail` (`id`, `channel_type`, `channelType`, `retail_type`, `retailType`, `status`, `dms_code`, `name`, `retail_zone`, `retailZone`, `retail_area`, `retailArea`, `territory`, `retail_location`, `retailLocation`, `division`, `divisionProperty`, `district`, `districtProperty`, `upazila`, `upazilaProperty`, `market_name`, `geotag`, `Address`, `contact_no`, `owner_name`, `owner_contact_no`, `owner_email`, `store_contact_no`, `store_email`, `manager_name`, `manager_contact_no`, `store_size_sft`, `store_facade_feet`, `number_sec`, `number_rsa`, `day_off`, `connectivity_wifi`, `created_by`, `created_at`, `updated_at`, `updated_by`) VALUES
(7, 'X-Tel', 0, 'RNG', 0, 'Active', 'TST3', 'dewqfw', 'East', 0, 'Dhanmondi', 0, 'ewvr', 'Metro', 0, 'Barisal', 0, 'Bhola', 0, 'Burhanuddin Upazila', 0, 'Test Market Name One', '123, 456', 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', '01790738233', 'Test Owner Name One', '01111111111', 'ashik@analyzenbd.com', '0111111111', 'ashik@analyzenbd.com', 'Test Manager Name', '01111111111', 1300, 1200, 0, 0, 'Saturday', 'Yes', 'admin1', '2016-09-19 08:53:00', NULL, ''),
(8, 'P-SES', 1, 'SES', 1, 'Active', 'TST4', 'Test Retail One', 'East', 1, 'Dhanmondi', 1, 'Test Territory One', 'Metro', 1, 'Khulna', 4, 'Jessore', 57, 'Keshabpur Upazila', 284, 'Test Market Name One', '123, 456', 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', '01790738233', 'Test Owner Name One', '01111111111', 'ashik@analyzenbd.com', '0111111111', 'ashik@analyzenbd.com', 'Test Manager Name', '01111111111', 1300, 1200, 0, 0, 'Monday', 'Yes', 'admin1', '2016-09-19 08:57:33', '2016-09-19 08:58:59', 'admin1'),
(9, 'P-SES', 1, 'SES', 1, 'Active', 'TST345', 'Test Retail ABCD', 'East', 1, 'Dhanmondi', 1, 'Test Territory One', 'Metro', 1, 'Dhaka', 3, 'Kishoreganj', 6, 'Kishoreganj Sadar Upazila', 185, 'Test Market Name Three', '123, 456', 'House No: 44, Road No: 9, Nikunja - 2, Khilkhet, Dhaka', '01790738233', 'Test Owner Name One', '01111111111', 'ashik@analyzenbd.com', '0111111111', 'ashik@analyzenbd.com', 'N/A', '01111111111', 1200, 1200, 1, 5, 'Saturday', 'Yes', 'admin1', '2016-10-13 06:57:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `retail_area`
--

CREATE TABLE IF NOT EXISTS `retail_area` (
  `id` int(11) unsigned NOT NULL,
  `area` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retail_area`
--

INSERT INTO `retail_area` (`id`, `area`) VALUES
(1, 'Dhanmondi'),
(2, 'Basundhara City'),
(3, 'Motijheel');

-- --------------------------------------------------------

--
-- Table structure for table `retail_channel_type`
--

CREATE TABLE IF NOT EXISTS `retail_channel_type` (
  `id` int(11) unsigned NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `retail_channel_type`
--

INSERT INTO `retail_channel_type` (`id`, `type`) VALUES
(1, 'P-SES'),
(2, 'Chain Retail'),
(3, 'X-Tel'),
(4, 'GRT');

-- --------------------------------------------------------

--
-- Table structure for table `retail_location`
--

CREATE TABLE IF NOT EXISTS `retail_location` (
  `id` int(11) unsigned NOT NULL,
  `location` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retail_location`
--

INSERT INTO `retail_location` (`id`, `location`) VALUES
(1, 'Metro'),
(2, 'Non-metro'),
(3, 'District');

-- --------------------------------------------------------

--
-- Table structure for table `retail_type`
--

CREATE TABLE IF NOT EXISTS `retail_type` (
  `id` int(11) unsigned NOT NULL,
  `type` varchar(100) NOT NULL,
  `channel_type_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `retail_type`
--

INSERT INTO `retail_type` (`id`, `type`, `channel_type_id`) VALUES
(1, 'SES', 1),
(2, 'TD', 2),
(3, 'RNG', 3),
(4, 'Pran FRL', 2);

-- --------------------------------------------------------

--
-- Table structure for table `retail_zone`
--

CREATE TABLE IF NOT EXISTS `retail_zone` (
  `id` int(11) unsigned NOT NULL,
  `zone` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retail_zone`
--

INSERT INTO `retail_zone` (`id`, `zone`) VALUES
(1, 'East'),
(2, 'West'),
(3, 'Test');

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `batch`, `retail_id`, `retail_dms_code`, `retail_name`, `retail_channel_type`, `retail_type`, `retail_zone`, `retail_area`, `retail_territory`, `hr_id`, `designation`, `employee_id`, `employee_name`, `tm_parent`, `tm_employee_id`, `tm_name`, `am_parent`, `am_employee_id`, `am_name`, `csm_parent`, `csm_employee_id`, `csm_name`, `product_id`, `product_name`, `product_model_code`, `product_model_name`, `product_color`, `product_type`, `imei_no`, `price`, `lifting_price`, `status`, `sales_date`, `created_at`, `created_by`) VALUES
(1, 0, 7, 'TST3', 'dewqfw', 'X-Tel', 'RNG', 'East', 'Dhanmondi', 'ewvr', 11, 'RSA-G', 'R12458', 'Test Name RSAG', 7, 'TM123456', 'Test NameTM', 6, 'AM123456', 'Test Name CSM', 5, 'MS1234', 'Test Name CSM', 1, 'Galaxy Note 7', 'N7777', 'N7', 'Black', 'Smart', '111111111111111', '60000.00', '50000.00', 'Active', '2016-12-10', '2016-12-10 12:53:07', 'R12458'),
(2, 0, 7, 'TST3', 'dewqfw', 'X-Tel', 'RNG', 'East', 'Dhanmondi', 'ewvr', 11, 'RSA-G', 'R12458', 'Test Name RSAG', 7, 'TM123456', 'Test NameTM', 6, 'AM123456', 'Test Name CSM', 5, 'MS1234', 'Test Name CSM', 1, 'Galaxy Note 7', 'N7777', 'N7', 'Black', 'Smart', '222222222222222', '60000.00', '50000.00', 'Active', '2016-12-10', '2016-12-10 12:53:48', 'R12458'),
(3, 0, 7, 'TST3', 'dewqfw', 'X-Tel', 'RNG', 'East', 'Dhanmondi', 'ewvr', 11, 'RSA-G', 'R12458', 'Test Name RSAG', 7, 'TM123456', 'Test NameTM', 6, 'AM123456', 'Test Name CSM', 5, 'MS1234', 'Test Name CSM', 2, 'Galaxy S6', 'S6666', 'S6', 'Black', 'Smart', '333333333333333', '60000.00', '50000.00', 'Active', '2016-12-10', '2016-12-10 12:54:04', 'R12458'),
(4, 0, 7, 'TST3', 'dewqfw', 'X-Tel', 'RNG', 'East', 'Dhanmondi', 'ewvr', 11, 'RSA-G', 'R12458', 'Test Name RSAG', 7, 'TM123456', 'Test NameTM', 6, 'AM123456', 'Test Name CSM', 5, 'MS1234', 'Test Name CSM', 3, 'Galaxy S7', 'S7777', 'S7', 'Black', 'Smart', '444444444444444', '70000.00', '60000.00', 'Active', '2016-12-10', '2016-12-10 12:54:25', 'R12458'),
(5, 0, 7, 'TST3', 'dewqfw', 'X-Tel', 'RNG', 'East', 'Dhanmondi', 'ewvr', 11, 'RSA-G', 'R12458', 'Test Name RSAG', 7, 'TM123456', 'Test NameTM', 6, 'AM123456', 'Test Name CSM', 5, 'MS1234', 'Test Name CSM', 4, 'Galaxy Note 7', 'N7777', 'N7', 'White', 'Smart', '555555555555555', '60000.00', '50000.00', 'Active', '2016-12-10', '2016-12-10 12:54:35', 'R12458'),
(6, 0, 7, 'TST3', 'dewqfw', 'X-Tel', 'RNG', 'East', 'Dhanmondi', 'ewvr', 11, 'RSA-G', 'R12458', 'Test Name RSAG', 7, 'TM123456', 'Test NameTM', 6, 'AM123456', 'Test Name CSM', 5, 'MS1234', 'Test Name CSM', 4, 'Galaxy Note 7', 'N7777', 'N7', 'White', 'Smart', '666666666666666', '60000.00', '50000.00', 'Active', '2016-12-10', '2016-12-10 13:18:08', 'R12458'),
(14, 9223372036854775807, 7, 'TST3', 'dewqfw', 'X-Tel', 'RNG', 'East', 'Dhanmondi', 'ewvr', 11, 'RSA-G', 'R12458', 'Test Name RSAG', 7, 'TM123456', 'Test NameTM', 6, 'AM123456', 'Test Name CSM', 5, 'MS1234', 'Test Name CSM', 2, 'Galaxy S6', 'S6666', 'S6', 'Black', 'Smart', 'B20000000000000', '60000.00', '50000.00', 'Active', '2016-12-10', '2016-12-10 14:50:04', 'R12458'),
(15, 9223372036854775807, 7, 'TST3', 'dewqfw', 'X-Tel', 'RNG', 'East', 'Dhanmondi', 'ewvr', 11, 'RSA-G', 'R12458', 'Test Name RSAG', 7, 'TM123456', 'Test NameTM', 6, 'AM123456', 'Test Name CSM', 5, 'MS1234', 'Test Name CSM', 3, 'Galaxy S7', 'S7777', 'S7', 'Black', 'Smart', 'C30000000000000', '70000.00', '60000.00', 'Active', '2016-12-10', '2016-12-10 14:50:04', 'R12458'),
(16, 9223372036854775807, 7, 'TST3', 'dewqfw', 'X-Tel', 'RNG', 'East', 'Dhanmondi', 'ewvr', 11, 'RSA-G', 'R12458', 'Test Name RSAG', 7, 'TM123456', 'Test NameTM', 6, 'AM123456', 'Test Name CSM', 5, 'MS1234', 'Test Name CSM', 3, 'Galaxy S7', 'S7777', 'S7', 'Black', 'Smart', 'E11111111111111', '70000.00', '60000.00', 'Active', '2016-12-10', '2016-12-10 14:50:04', 'R12458'),
(24, 0, 8, 'TST4', 'Test Retail One', 'P-SES', 'SES', 'East', 'Dhanmondi', 'Test Territory One', 13, 'SEC', 'S10912', 'Ashikur Rahman', 7, 'TM123456', 'Test NameTM', 6, 'AM123456', 'Test Name CSM', 5, 'MS1234', 'Test Name CSM', 1, 'Galaxy Note 7', 'N7777', 'N7', 'Black', 'Smart', '358548062849969', '60000.00', '50000.00', 'Active', '2016-12-12', '2016-12-12 16:29:43', 'S10912');

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_batch`
--

INSERT INTO `sales_batch` (`id`, `batch`, `file_import`, `status`, `created_by`, `deleted_by`, `created_at`, `deleted_at`) VALUES
(11, 2407685671535126912, 'uploads/files/sales/64-2992016.csv', 'Active', 'R12458', NULL, '2016-10-02 19:01:12', NULL),
(12, 9223372036854775807, 'uploads/files/sales/65-2992016.csv', 'Active', 'R12458', NULL, '2016-10-17 18:26:30', NULL),
(13, 9223372036854775807, 'uploads/files/sales/70-2992016.csv', 'Active', 'R12458', NULL, '2016-10-17 18:39:52', NULL),
(14, 9223372036854775807, 'uploads/files/sales/35-2992016.csv', 'Active', 'R12458', NULL, '2016-10-17 18:42:11', NULL),
(15, 9223372036854775807, 'uploads/files/sales/63-2992016.csv', 'Active', 'R12458', NULL, '2016-10-17 18:43:41', NULL),
(16, 9223372036854775807, 'uploads/files/sales/42-2992016.csv', 'Active', 'R12458', NULL, '2016-10-17 18:45:35', NULL),
(17, 9223372036854775807, 'uploads/files/sales/15-2992016.csv', 'Active', 'R12458', NULL, '2016-10-17 18:46:52', NULL),
(18, 9223372036854775807, 'uploads/files/sales/33-2992016.csv', 'Deleted', 'R12458', 'TM123456', '2016-10-18 13:33:00', '2016-10-18 18:45:02'),
(19, 9223372036854775807, 'uploads/files/sales/94-2992016.csv', 'Active', 'R12458', NULL, '2016-10-19 13:29:34', NULL),
(20, 9223372036854775807, 'uploads/files/sales/28-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 14:16:43', NULL),
(21, 9223372036854775807, 'uploads/files/sales/72-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 14:19:05', NULL),
(22, 9223372036854775807, 'uploads/files/sales/44-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 14:19:40', NULL),
(23, 9223372036854775807, 'uploads/files/sales/41-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 14:20:55', NULL),
(24, 9223372036854775807, 'uploads/files/sales/70-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 14:22:33', NULL),
(25, 9223372036854775807, 'uploads/files/sales/92-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 14:29:02', NULL),
(26, 9223372036854775807, 'uploads/files/sales/68-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 14:32:45', NULL),
(27, 9223372036854775807, 'uploads/files/sales/30-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 14:39:40', NULL),
(28, 9223372036854775807, 'uploads/files/sales/44-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 14:50:02', NULL),
(29, 9223372036854775807, 'uploads/files/sales/42-2992016.csv', 'Active', 'S10912', NULL, '2016-12-12 16:31:31', NULL);

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
  `submission_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `batch`, `retail_id`, `retail_dms_code`, `retail_name`, `retail_type`, `retail_channel_type`, `retail_zone`, `retail_area`, `retail_territory`, `product_id`, `imei_no`, `product_name`, `product_model_code`, `product_model_name`, `product_color`, `product_type`, `lifting_price`, `rrp`, `status`, `submission_date`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 0, 7, 'TST3', 'dewqfw', 'RNG', 'X-Tel', 'East', 'Dhanmondi', 'ewvr', 2, '111111111111112', 'Galaxy S6', 'S6666', 'S6', 'Black', 'Smart', '50000.00', '60000.00', 'Active', '2016-12-09', '2016-12-08 20:45:30', 'R12458', NULL, NULL),
(3, 0, 7, 'TST3', 'dewqfw', 'RNG', 'X-Tel', 'East', 'Dhanmondi', 'ewvr', 3, '111111111111113', 'Galaxy S7', 'S7777', 'S7', 'Black', 'Smart', '60000.00', '70000.00', 'Active', '2016-12-09', '2016-12-08 20:45:43', 'R12458', NULL, NULL),
(4, 0, 7, 'TST3', 'dewqfw', 'RNG', 'X-Tel', 'East', 'Dhanmondi', 'ewvr', 4, '111111111111114', 'Galaxy Note 7', 'N7777', 'N7', 'White', 'Smart', '50000.00', '60000.00', 'Active', '2016-12-09', '2016-12-08 20:46:01', 'R12458', NULL, NULL),
(10, 0, 7, 'TST3', 'dewqfw', 'RNG', 'X-Tel', 'East', 'Dhanmondi', 'ewvr', 3, '777777777777777', 'Galaxy S7', 'S7777', 'S7', 'Black', 'Smart', '60000.00', '70000.00', 'Active', '2016-12-10', '2016-12-10 06:42:32', 'R12458', NULL, NULL),
(11, 0, 7, 'TST3', 'dewqfw', 'RNG', 'X-Tel', 'East', 'Dhanmondi', 'ewvr', 2, '888888888888888', 'Galaxy S6', 'S6666', 'S6', 'Black', 'Smart', '50000.00', '60000.00', 'Active', '2016-12-10', '2016-12-10 06:48:30', 'R12458', NULL, NULL),
(12, 18446744073709551615, 7, 'TST3', 'dewqfw', 'RNG', 'X-Tel', 'East', 'Dhanmondi', 'ewvr', 1, '100000000000000', 'Galaxy Note 7', 'N7777', 'N7', 'Black', 'Smart', '50000.00', '60000.00', 'Active', '2016-12-10', '2016-12-10 07:41:36', 'R12458', NULL, NULL),
(13, 18446744073709551615, 7, 'TST3', 'dewqfw', 'RNG', 'X-Tel', 'East', 'Dhanmondi', 'ewvr', 2, '200000000000000', 'Galaxy S6', 'S6666', 'S6', 'Black', 'Smart', '50000.00', '60000.00', 'Active', '2016-12-10', '2016-12-10 07:41:36', 'R12458', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_batch`
--

CREATE TABLE IF NOT EXISTS `stock_batch` (
  `id` int(11) NOT NULL,
  `batch` bigint(20) NOT NULL,
  `file_import` varchar(255) NOT NULL,
  `status` enum('Active','Deleted') NOT NULL DEFAULT 'Active',
  `created_by` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `stock_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_batch`
--

INSERT INTO `stock_batch` (`id`, `batch`, `file_import`, `status`, `created_by`, `deleted_by`, `created_at`, `deleted_at`, `stock_date`) VALUES
(1, 9223372036854775807, 'uploads/files/stock/54-2992016.csv', 'Deleted', 'R12458', 'R12458', '2016-10-04 19:37:01', '2016-10-04 20:20:41', '2016-10-04'),
(2, 9223372036854775807, 'uploads/files/stock/39-2992016.csv', 'Active', 'R12458', NULL, '2016-10-04 19:38:36', NULL, '2016-10-04'),
(3, 9223372036854775807, 'uploads/files/stock/19-2992016.csv', 'Active', 'R12458', NULL, '2016-10-04 19:39:22', NULL, '2016-10-04'),
(4, 9223372036854775807, 'uploads/files/stock/77-2992016.csv', 'Active', 'R12458', NULL, '2016-10-04 19:40:28', NULL, '2016-10-04'),
(5, 9223372036854775807, 'uploads/files/stock/11-2992016.csv', 'Active', 'R12458', NULL, '2016-10-04 19:43:00', NULL, '2016-10-04'),
(6, 9223372036854775807, 'uploads/files/stock/10-2992016.csv', 'Active', 'R12458', NULL, '2016-10-04 19:43:46', NULL, '2016-10-04'),
(7, 9223372036854775807, 'uploads/files/stock/18-2992016.csv', 'Active', 'R12458', NULL, '2016-10-04 19:44:05', NULL, '2016-10-04'),
(8, 9223372036854775807, 'uploads/files/stock/81-2992016.csv', 'Active', 'R12458', NULL, '2016-10-04 19:45:02', NULL, '2016-10-04'),
(9, 9223372036854775807, 'uploads/files/stock/28-2992016.csv', 'Active', 'R12458', NULL, '2016-10-04 19:45:24', NULL, '2016-10-04'),
(10, 9223372036854775807, 'uploads/files/stock/43-2992016.csv', 'Active', 'R12458', NULL, '2016-10-04 19:54:05', NULL, '2016-10-04'),
(11, 9223372036854775807, 'uploads/files/stock/66-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 13:34:33', NULL, '2016-12-10'),
(12, 9223372036854775807, 'uploads/files/stock/87-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 13:35:38', NULL, '2016-12-10'),
(13, 9223372036854775807, 'uploads/files/stock/85-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 13:36:31', NULL, '2016-12-10'),
(14, 9223372036854775807, 'uploads/files/stock/21-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 13:36:56', NULL, '2016-12-10'),
(15, 9223372036854775807, 'uploads/files/stock/90-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 13:39:03', NULL, '2016-12-10'),
(16, 9223372036854775807, 'uploads/files/stock/56-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 13:40:18', NULL, '2016-12-10'),
(17, 9223372036854775807, 'uploads/files/stock/65-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 13:41:35', NULL, '2016-12-10'),
(18, 9223372036854775807, 'uploads/files/stock/83-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 13:43:29', NULL, '2016-12-10'),
(19, 9223372036854775807, 'uploads/files/stock/15-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 13:44:43', NULL, '2016-12-10'),
(20, 9223372036854775807, 'uploads/files/stock/13-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 13:47:36', NULL, '2016-12-10'),
(21, 9223372036854775807, 'uploads/files/stock/73-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 14:30:46', NULL, '2016-12-10'),
(22, 9223372036854775807, 'uploads/files/stock/36-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 14:32:05', NULL, '2016-12-10'),
(23, 9223372036854775807, 'uploads/files/stock/20-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 14:46:16', NULL, '2016-12-10'),
(24, 9223372036854775807, 'uploads/files/stock/63-2992016.csv', 'Active', 'R12458', NULL, '2016-12-10 14:48:32', NULL, '2016-12-10'),
(25, 9223372036854775807, 'uploads/files/stock/35-2992016.csv', 'Active', 'S10912', NULL, '2016-12-12 16:30:44', NULL, '2016-12-12');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `target`
--

INSERT INTO `target` (`id`, `batch`, `retail_id`, `retail_dms_code`, `retail_name`, `retail_channel_type`, `retail_type`, `retail_zone`, `retail_area`, `retail_territory`, `hr_id`, `employee_id`, `employee_name`, `designation`, `fsm_vol`, `fsm_vol_sales`, `fsm_val`, `fsm_val_sales`, `tm_parent`, `tm_employee_id`, `tm_name`, `tm_vol`, `tm_vol_sales`, `tm_val`, `tm_val_sales`, `am_parent`, `am_employee_id`, `am_name`, `am_vol`, `am_vol_sales`, `am_val`, `am_val_sales`, `csm_parent`, `csm_employee_id`, `csm_name`, `csm_vol`, `csm_vol_sales`, `csm_val`, `csm_val_sales`, `product_name`, `product_model_code`, `product_model_name`, `product_type`, `target_date`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 2009386088050525911, 7, 'TST3', 'dewqfw', 'X-Tel', 'RNG', 'East', 'Dhanmondi', 'ewvr', 11, 'R12458', 'Test Name RSAG', 'RSA-G', 910, 4, '54600000.00', '240000.00', 7, 'TM123456', 'Test NameTM', 910, 4, '54600000.00', '240000.00', 6, 'AM123456', 'Test Name CSM', 910, 4, '54600000.00', '240000.00', 5, 'MS1234', 'Test Name CSM', 910, 4, '54600000.00', '240000.00', 'Galaxy Note 7', 'N7777', 'N7', 'Smart', '2016-12-01', '2016-12-12 16:15:25', 'admin1', NULL, NULL),
(2, 2009386088050525911, 7, 'TST3', 'dewqfw', 'X-Tel', 'RNG', 'East', 'Dhanmondi', 'ewvr', 11, 'R12458', 'Test Name RSAG', 'RSA-G', 920, 3, '55200000.00', '180000.00', 7, 'TM123456', 'Test NameTM', 920, 3, '55200000.00', '180000.00', 6, 'AM123456', 'Test Name CSM', 920, 3, '55200000.00', '180000.00', 5, 'MS1234', 'Test Name CSM', 920, 3, '55200000.00', '180000.00', 'Galaxy S6', 'S6666', 'S6', 'Smart', '2016-12-01', '2016-12-12 16:15:25', 'admin1', NULL, NULL),
(3, 2009386088050525911, 7, 'TST3', 'dewqfw', 'X-Tel', 'RNG', 'East', 'Dhanmondi', 'ewvr', 11, 'R12458', 'Test Name RSAG', 'RSA-G', 930, 3, '65100000.00', '210000.00', 7, 'TM123456', 'Test NameTM', 930, 3, '65100000.00', '210000.00', 6, 'AM123456', 'Test Name CSM', 930, 3, '65100000.00', '210000.00', 5, 'MS1234', 'Test Name CSM', 930, 3, '65100000.00', '210000.00', 'Galaxy S7', 'S7777', 'S7', 'Smart', '2016-12-01', '2016-12-12 16:15:25', 'admin1', NULL, NULL),
(4, 2009386088050525911, 8, 'TST4', 'Test Retail One', 'P-SES', 'SES', 'East', 'Dhanmondi', 'Test Territory One', 12, 'S0987', 'Ashikur Rahman', 'SEC', 510, 0, '30600000.00', '0.00', 7, 'TM123456', 'Test NameTM', 510, 4, '30600000.00', '240000.00', 6, 'AM123456', 'Test Name CSM', 510, 4, '30600000.00', '240000.00', 5, 'MS1234', 'Test Name CSM', 510, 4, '30600000.00', '240000.00', 'Galaxy Note 7', 'N7777', 'N7', 'Smart', '2016-12-01', '2016-12-12 16:15:25', 'admin1', NULL, NULL),
(5, 2009386088050525911, 8, 'TST4', 'Test Retail One', 'P-SES', 'SES', 'East', 'Dhanmondi', 'Test Territory One', 12, 'S0987', 'Ashikur Rahman', 'SEC', 520, 0, '31200000.00', '0.00', 7, 'TM123456', 'Test NameTM', 520, 3, '31200000.00', '180000.00', 6, 'AM123456', 'Test Name CSM', 520, 3, '31200000.00', '180000.00', 5, 'MS1234', 'Test Name CSM', 520, 3, '31200000.00', '180000.00', 'Galaxy S6', 'S6666', 'S6', 'Smart', '2016-12-01', '2016-12-12 16:15:25', 'admin1', NULL, NULL),
(6, 2009386088050525911, 8, 'TST4', 'Test Retail One', 'P-SES', 'SES', 'East', 'Dhanmondi', 'Test Territory One', 12, 'S0987', 'Ashikur Rahman', 'SEC', 530, 0, '37100000.00', '0.00', 7, 'TM123456', 'Test NameTM', 530, 3, '37100000.00', '210000.00', 6, 'AM123456', 'Test Name CSM', 530, 3, '37100000.00', '210000.00', 5, 'MS1234', 'Test Name CSM', 530, 3, '37100000.00', '210000.00', 'Galaxy S7', 'S7777', 'S7', 'Smart', '2016-12-01', '2016-12-12 16:15:25', 'admin1', NULL, NULL),
(7, 2009386088050525911, 8, 'TST4', 'Test Retail One', 'P-SES', 'SES', 'East', 'Dhanmondi', 'Test Territory One', 13, 'S10912', 'Ashikur Rahman', 'SEC', 810, 1, '48600000.00', '60000.00', 7, 'TM123456', 'Test NameTM', 810, 5, '48600000.00', '300000.00', 6, 'AM123456', 'Test Name CSM', 810, 5, '48600000.00', '300000.00', 5, 'MS1234', 'Test Name CSM', 810, 5, '48600000.00', '300000.00', 'Galaxy Note 7', 'N7777', 'N7', 'Smart', '2016-12-01', '2016-12-12 16:15:25', 'admin1', NULL, NULL),
(8, 2009386088050525911, 8, 'TST4', 'Test Retail One', 'P-SES', 'SES', 'East', 'Dhanmondi', 'Test Territory One', 13, 'S10912', 'Ashikur Rahman', 'SEC', 820, 0, '49200000.00', '0.00', 7, 'TM123456', 'Test NameTM', 820, 3, '49200000.00', '180000.00', 6, 'AM123456', 'Test Name CSM', 820, 3, '49200000.00', '180000.00', 5, 'MS1234', 'Test Name CSM', 820, 3, '49200000.00', '180000.00', 'Galaxy S6', 'S6666', 'S6', 'Smart', '2016-12-01', '2016-12-12 16:15:25', 'admin1', NULL, NULL),
(9, 2009386088050525911, 8, 'TST4', 'Test Retail One', 'P-SES', 'SES', 'East', 'Dhanmondi', 'Test Territory One', 13, 'S10912', 'Ashikur Rahman', 'SEC', 830, 0, '58100000.00', '0.00', 7, 'TM123456', 'Test NameTM', 830, 3, '58100000.00', '210000.00', 6, 'AM123456', 'Test Name CSM', 830, 3, '58100000.00', '210000.00', 5, 'MS1234', 'Test Name CSM', 830, 3, '58100000.00', '210000.00', 'Galaxy S7', 'S7777', 'S7', 'Smart', '2016-12-01', '2016-12-12 16:15:25', 'admin1', NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `target_batch`
--

INSERT INTO `target_batch` (`id`, `batch`, `file_import`, `status`, `created_by`, `deleted_by`, `created_at`, `deleted_at`, `target_date`) VALUES
(1, 2004100256082321201, 'uploads/files/targets/13-210.csv', 'Deleted', 'admin1', 'admin1', '2016-10-03 12:42:01', '2016-10-03 13:18:56', '2016-09-01'),
(2, 2004100256083041221, 'uploads/files/targets/14-210.csv', 'Deleted', 'admin1', 'admin1', '2016-10-03 12:46:41', '2016-12-12 15:32:41', '2016-09-01'),
(3, 2004100256083411621, 'uploads/files/targets/63-210.csv', 'Deleted', 'admin1', 'admin1', '2016-10-03 12:48:51', '2016-12-12 15:32:41', '2016-09-01'),
(4, 2004100256083701161, 'uploads/files/targets/57-210.csv', 'Deleted', 'admin1', 'admin1', '2016-10-03 12:50:21', '2016-12-12 15:32:29', '2016-09-01'),
(5, 9223372036854775807, 'uploads/files/targets/99-210.csv', 'Deleted', '12456', 'admin1', '2016-10-03 16:21:22', '2016-12-12 15:32:29', '2016-09-01'),
(6, 9223372036854775807, 'uploads/files/targets/40-210.csv', 'Deleted', '12456', 'admin1', '2016-10-03 16:23:30', '2016-12-12 15:32:29', '2016-09-01'),
(7, 9223372036854775807, 'uploads/files/targets/85-210.csv', 'Deleted', 'TM123456', 'admin1', '2016-10-03 17:59:04', '2016-12-12 15:32:29', '2016-09-01'),
(8, 2208543898202416911, 'uploads/files/targets/44-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-10-17 16:42:56', '2016-12-12 15:32:29', '0000-00-00'),
(9, 2208543898203041561, 'uploads/files/targets/88-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-10-17 16:46:41', '2016-12-12 15:32:29', '0000-00-00'),
(10, 2208543898203404791, 'uploads/files/targets/93-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-10-17 16:48:44', '2016-12-12 15:32:29', '2016-09-01'),
(11, 2108543898131154431, 'uploads/files/targets/12-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-10-17 17:19:14', '2016-12-12 15:32:29', '2016-10-01'),
(12, 2108543898134915411, 'uploads/files/targets/36-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-10-17 17:41:55', '2016-12-12 15:32:29', '2016-10-01'),
(13, 9223372036854775807, 'uploads/files/targets/60-tm.csv', 'Deleted', 'AM123456', 'admin1', '2016-10-17 19:42:00', '2016-12-12 15:32:29', '2016-10-01'),
(14, 9223372036854775807, 'uploads/files/targets/47-fsm.csv', 'Deleted', 'TM123456', 'admin1', '2016-10-17 19:44:47', '2016-12-12 15:32:29', '2016-10-01'),
(15, 9223372036854775807, 'uploads/files/targets/18-fsm.csv', 'Deleted', 'TM123456', 'admin1', '2016-10-17 19:46:45', '2016-12-12 15:32:29', '2016-10-01'),
(16, 1504829097064234371, 'uploads/files/targets/99-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-10-26 14:37:54', '2016-12-12 15:32:28', '2016-11-01'),
(17, 2612354399041056261, 'uploads/files/targets/79-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 16:46:56', '2016-12-12 15:32:28', '2016-12-01'),
(18, 2612354399041720701, 'uploads/files/targets/49-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 16:50:40', '2016-12-12 15:32:28', '2016-12-01'),
(19, 2612354399041901311, 'uploads/files/targets/27-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 16:51:41', '2016-12-12 15:32:28', '2016-12-01'),
(20, 2612354399042001751, 'uploads/files/targets/76-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 16:52:01', '2016-12-12 15:32:28', '2016-12-01'),
(21, 2612354399043028371, 'uploads/files/targets/31-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 16:58:28', '2016-12-12 15:32:28', '2016-12-01'),
(22, 2612354399043232501, 'uploads/files/targets/46-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 16:59:52', '2016-12-12 15:32:28', '2016-12-01'),
(23, 2612354399062335961, 'uploads/files/targets/22-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 17:26:15', '2016-12-12 15:28:08', '2016-12-01'),
(24, 2612354399070658561, 'uploads/files/targets/67-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 17:52:18', '2016-12-12 15:28:08', '2016-12-01'),
(25, 9223372036854775807, 'uploads/files/targets/74-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 19:48:09', '2016-12-12 15:28:08', '2016-12-01'),
(26, 2612354399140521431, 'uploads/files/targets/47-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 20:03:21', '2016-12-12 15:28:08', '2016-12-01'),
(27, 2612354399140902341, 'uploads/files/targets/26-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 20:05:42', '2016-12-12 15:28:08', '2016-12-01'),
(28, 2612354399141500851, 'uploads/files/targets/39-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 20:09:00', '2016-12-12 15:28:08', '2016-12-01'),
(29, 2612354399141720491, 'uploads/files/targets/46-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 20:10:40', '2016-12-12 15:28:08', '2016-12-01'),
(30, 2612354399143205161, 'uploads/files/targets/59-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 20:19:25', '2016-12-12 15:28:08', '2016-12-01'),
(31, 2612354399143853121, 'uploads/files/targets/22-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 20:23:33', '2016-12-12 15:28:08', '2016-12-01'),
(32, 2612354399144237511, 'uploads/files/targets/68-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 20:25:57', '2016-12-12 15:27:22', '2016-12-01'),
(33, 2612354399144531331, 'uploads/files/targets/36-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 20:27:31', '2016-12-12 15:26:02', '2016-12-01'),
(34, 2612354399150036971, 'uploads/files/targets/27-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 20:36:36', '2016-12-12 15:26:02', '2016-12-01'),
(35, 2612354399150547711, 'uploads/files/targets/88-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 20:39:47', '2016-12-12 15:26:02', '2016-12-01'),
(36, 2612354399152403231, 'uploads/files/targets/97-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 20:50:43', '2016-12-12 15:26:02', '2016-12-01'),
(37, 2612354399152653671, 'uploads/files/targets/23-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 20:52:13', '2016-12-12 15:26:02', '2016-12-01'),
(38, 2612354399153326851, 'uploads/files/targets/36-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 20:56:06', '2016-12-12 15:26:02', '2016-12-01'),
(39, 2612354399153840231, 'uploads/files/targets/11-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 20:59:20', '2016-12-12 15:26:02', '2016-12-01'),
(40, 2612354399165042701, 'uploads/files/targets/43-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 21:02:42', '2016-12-12 15:26:02', '2016-12-01'),
(41, 2612354399165201601, 'uploads/files/targets/95-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 21:03:21', '2016-12-12 15:26:02', '2016-12-01'),
(42, 2612354399165724651, 'uploads/files/targets/64-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 21:06:44', '2016-12-12 15:26:01', '2016-12-01'),
(43, 2612354399165853561, 'uploads/files/targets/89-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 21:07:33', '2016-12-12 15:26:01', '2016-12-01'),
(44, 2612354399170016641, 'uploads/files/targets/34-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 21:08:16', '2016-12-12 15:26:01', '2016-12-01'),
(45, 2612354399170711931, 'uploads/files/targets/49-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 21:12:31', '2016-12-12 15:26:01', '2016-12-01'),
(46, 2612354399170829171, 'uploads/files/targets/85-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 21:13:09', '2016-12-12 15:26:01', '2016-12-01'),
(47, 2612354399170903171, 'uploads/files/targets/32-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 21:13:43', '2016-12-12 15:26:01', '2016-12-01'),
(48, 2612354399171210921, 'uploads/files/targets/93-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 21:15:30', '2016-12-12 15:26:01', '2016-12-01'),
(49, 2612354399171506841, 'uploads/files/targets/80-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 21:17:06', '2016-12-12 15:26:01', '2016-12-01'),
(50, 2612354399171727521, 'uploads/files/targets/19-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-11 21:18:47', '2016-12-12 15:26:01', '2016-12-01'),
(51, 2009386088001347141, 'uploads/files/targets/87-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-12 14:40:27', '2016-12-12 15:27:06', '2016-12-01'),
(52, 2009386088001504321, 'uploads/files/targets/70-admin.csv', 'Deleted', 'admin1', 'admin1', '2016-12-12 14:41:04', '2016-12-12 15:07:55', '2016-12-01'),
(53, 2009386088015415531, 'uploads/files/targets/2009386088015415531.csv', 'Deleted', 'admin1', 'admin1', '2016-12-12 15:00:55', '2016-12-12 16:23:47', '2016-12-01'),
(54, 2009386088015554151, 'uploads/files/targets/2009386088015554151.csv', 'Deleted', 'admin1', 'admin1', '2016-12-12 15:01:54', '2016-12-12 15:06:23', '2016-12-01'),
(55, 2009386088024907311, 'uploads/files/targets/2009386088024907311.csv', 'Deleted', 'admin1', 'admin1', '2016-12-12 15:33:47', '2016-12-12 15:33:53', '2016-12-01'),
(56, 2009386088050525911, 'uploads/files/targets/2009386088050525911.csv', 'Active', 'admin1', NULL, '2016-12-12 16:15:25', NULL, '2016-12-01');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_assessment_category`
--

INSERT INTO `training_assessment_category` (`id`, `batch`, `name`, `message`, `designations`, `qlimit`, `estimated_time`, `date_month`, `status`, `notification_count`, `created_by`, `created_at`) VALUES
(5, 18446744073709551615, 'Sample Assessment FSM', 'New Assessment on Note 7', 'SEC,RSA-G,RSA-R,RSA-Y', 0, 1800, '2016-11-01', 'Inactive', 0, 'TRIN1234', '2016-11-23 14:31:52'),
(6, 18446744073709551615, 'Sample Assessment Two', 'Assessment on S9', 'TM', 0, 6000, '2016-12-01', 'Active', 0, 'TRIN1234', '2016-11-23 14:32:14'),
(7, 17127343470149119016, 'Sample Assessment on Technology for FSM', 'Sample Assessment on Technology ', 'SEC,RSA-G,RSA-R,RSA-Y', 4, 20, '2016-12-01', 'Active', 9, 'TRIN1234', '2016-11-24 16:37:39'),
(8, 14799940753816, 'True Sample Assessment', 'New Assessment on S9 Edge', 'SEC,RSA-G,RSA-R', 5, 6, '2016-11-01', 'Active', 2, 'TRIN1234', '2016-11-24 19:27:55'),
(9, 18446744073709551615, 'Sample Assessment FSM on New Handset', 'New Assessment on New Handset', 'RSA-G,RSA-R,RSA-Y', 3, 5, '2016-11-01', 'Finish', 1, 'TRIN1234', '2016-11-29 17:55:40');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_assessment_question`
--

INSERT INTO `training_assessment_question` (`id`, `question_name`, `answer1`, `answer2`, `answer3`, `answer4`, `answer`, `choice`, `category_id`) VALUES
(1, 'What is the capital of Bangladsh?', 'Khulna', 'Barisal', 'Dhaka', 'Sylhet', 3, 'Single', 7),
(2, 'What is the center of Bangladsh?', 'Khulna', 'Barisal', 'Dhaka', 'Sylhet', 3, 'Single', 7),
(3, 'How many districts in Bangladsh?', '54', '44', '34', '64', 4, 'Single', 7),
(4, 'What karnel used by most of the os?', 'Windows', 'MAC', 'Android', 'Linux', 4, 'Single', 7),
(5, 'What is VLAN?', 'Static LAN', 'Physical LAN', 'Logical LAN', 'None of the above', 3, 'Single', 7),
(6, 'In what purpose ICMP used for?', 'To show error message', 'To solve error', 'Both of above', 'None of above', 1, 'Single', 7),
(7, 'What is the color of SKY?', 'Blue', 'Green', 'Red', 'White', 1, 'Single', 8),
(8, 'What is the color of Ocean?', 'Red', 'Blue', 'Geen', 'White', 2, 'Single', 8),
(9, 'What is the color of hair?', 'White', 'Blue', 'Black', 'Gray', 3, 'Single', 8),
(10, 'What is the color of lip?', 'White', 'Blue', 'Black', 'Red', 4, 'Single', 8),
(11, 'What is the color of leaf?', 'Green', 'Blue', 'Black', 'Red', 1, 'Single', 8),
(12, 'What is the color of Panda?', 'White', 'Blue', 'Black', '1 & 3 Both', 4, 'Single', 8),
(13, 'What is the color of cloud?', 'White', 'Blue', 'Black', 'Green', 3, 'Single', 8),
(14, 'What is the capital of Bangladsh?', 'Khulna', 'Barisal', 'Dhaka', 'Sylhet', 3, 'Single', 9),
(15, 'What is the color of cloud?', 'White', 'Blue', 'Red', 'None of above', 2, 'Single', 9),
(16, 'How many districts in Bangladsh?', '12', '14', '16', '64', 4, 'Single', 9),
(17, 'How many districts in Bangladsh?', '12', '14', '16', '64', 4, 'Single', 9);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_assessment_result`
--

INSERT INTO `training_assessment_result` (`id`, `category_id`, `hr_employee_id`, `hr_name`, `hr_designation`, `hr_employee_type`, `score`, `right_answer`, `wrong_answer`, `un_answer`, `score_percent`, `total_time`, `date_month`, `participation_datetime`, `status`) VALUES
(3, 7, 'R12458', 'Test Name RSAG', 'RSA-G', 'FSM', 1, 1, 3, 0, '25.00', '0.18', '2016-12-01', '2016-11-24 18:57:11', 'Active'),
(4, 8, 'R12458', 'Test Name RSAG', 'RSA-G', 'FSM', 3, 3, 1, 1, '60.00', '0.47', '2016-11-01', '2016-11-24 19:50:18', 'Active'),
(5, 9, 'R12458', 'Test Name RSAG', 'RSA-G', 'FSM', 1, 1, 1, 1, '33.33', '2.22', '2016-11-01', '2016-11-29 18:07:21', 'Active');

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_pdf`
--

INSERT INTO `training_pdf` (`id`, `batch`, `name`, `file_import`, `status`, `designations`, `message`, `notification_count`, `created_by`, `deleted_by`, `created_at`, `deleted_at`, `training_datetime`) VALUES
(19, '27051956392025137016', 'Test Training Ten', 'uploads/files/training/pdf/27051956392025137016-CaMnTiO3.pdf', 'Inactive', '', '', 0, 'TRIN1234', NULL, '2016-11-14 20:15:07', NULL, '2016-11-07 09:40 PM'),
(20, '27051956392025432016', 'Test Training Eleven', 'uploads/files/training/pdf/27051956392025432016-CaMnTiO3.pdf', 'Active', '', '', 0, 'TRIN1234', NULL, '2016-11-07 16:43:42', NULL, '2016-11-07 09:40 PM'),
(21, '29074174600335138616', 'hshcfua', 'uploads/files/training/pdf/29074174600335138616-CaMnTiO3_ch3.pdf', 'Active', '', '', 2, 'TRIN1234', NULL, '2016-11-13 16:24:38', NULL, '2016-11-13 04:10 PM'),
(22, '25044491490207171816', 'Test Training Seven', 'uploads/files/training/pdf/25044491490207171816-CaMnTiO3_ch3.pdf', 'Active', 'AM,TM', 'This Is test', 11, 'TRIN1234', NULL, '2016-11-14 18:25:59', NULL, '2016-11-14 02:55 PM'),
(23, '24044491490707155116', 'hshcfua', 'uploads/files/training/pdf/24044491490707155116-CaMnTiO3.pdf', 'Active', 'SEC,RSA-G,RSA-R', 'This Is test', 13, 'TRIN1234', NULL, '2016-11-14 20:16:59', NULL, '2016-11-13 04:10 PM'),
(24, '21059244802106519316', 'Test Training Twelve', 'uploads/files/training/pdf/21059244802106519316-Product PPT.pdf', 'Inactive', 'SEC,RSA-G,RSA-R,RSA-Y', 'This Is test', 0, 'TRIN1234', NULL, '2016-11-29 17:44:11', NULL, '2016-12-01 05:35 PM'),
(25, '21059244802110028216', 'Test Training Twelve', 'uploads/files/training/pdf/21059244802110028216-Product PPT.pdf', 'Inactive', 'SEC,RSA-G,RSA-R,RSA-Y', 'This Is test', 0, 'TRIN1234', NULL, '2016-11-29 17:46:02', NULL, '2016-12-01 05:35 PM'),
(26, '21059244802110484216', 'Test Training Twelve', 'uploads/files/training/pdf/21059244802110484216-ProductPPT.pdf', 'Active', 'SEC,RSA-G,RSA-R,RSA-Y', 'This Is test', 1, 'TRIN1234', NULL, '2016-11-29 17:48:39', NULL, '2016-12-01 05:35 PM');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `travel`
--

INSERT INTO `travel` (`id`, `batch`, `hr_employee_id`, `hr_name`, `hr_designation`, `hr_employee_type`, `reason`, `start_date`, `end_date`, `place`, `cost`, `line_manager_hr_id`, `line_manager_employee_id`, `line_manager_name`, `line_manager_designation`, `line_manager_employee_type`, `status`, `action_date`, `action_by`, `created_at`) VALUES
(1, 8102593330427083911, 'TM123456', 'Test NameTM', 'TM', 'Sales', 'I am going for a training program', '2016-12-01', '2016-12-07', 'Barisal', '100.00', 6, 'AM123456', 'Test Name CSM', 'AM', 'Sales', 'Rejected', '2016-12-08 19:12:16', 'AM123456', '2016-12-08 18:48:28'),
(2, 8102593330643469311, 'TM123456', 'Test NameTM', 'TM', 'Sales', 'I am going for a vacation', '2016-12-07', '2016-12-14', 'Barisal', '0.00', 6, 'AM123456', 'Test Name CSM', 'AM', 'Sales', 'Approved', '2016-12-08 19:37:58', 'AM123456', '2016-12-08 19:30:26'),
(3, 8102593330713563311, 'TM123456', 'Test NameTM', 'TM', 'Sales', 'I am going for a new survey', '2016-12-14', '2016-12-21', 'Dhaka', '100.00', 6, 'AM123456', 'Test Name CSM', 'AM', 'Sales', 'Rejected', '2016-12-08 19:56:22', 'AM123456', '2016-12-08 19:48:36'),
(4, 8102593330725387511, 'TM123456', 'Test NameTM', 'TM', 'Sales', 'I am going for a new training', '2016-12-03', '2016-12-10', 'Dhaka', '100.00', 6, 'AM123456', 'Test Name CSM', 'AM', 'Sales', 'Rejected', '2016-12-08 19:56:16', 'AM123456', '2016-12-08 19:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `upazilas`
--

CREATE TABLE IF NOT EXISTS `upazilas` (
  `id` int(2) unsigned NOT NULL,
  `district_id` int(2) unsigned NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=493 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `upazilas`
--

INSERT INTO `upazilas` (`id`, `district_id`, `name`) VALUES
(1, 34, 'Amtali Upazila'),
(2, 34, 'Bamna Upazila'),
(3, 34, 'Barguna Sadar Upazila'),
(4, 34, 'Betagi Upazila'),
(5, 34, 'Patharghata Upazila'),
(6, 34, 'Taltali Upazila'),
(7, 35, 'Muladi Upazila'),
(8, 35, 'Babuganj Upazila'),
(9, 35, 'Agailjhara Upazila'),
(10, 35, 'Barisal Sadar Upazila'),
(11, 35, 'Bakerganj Upazila'),
(12, 35, 'Banaripara Upazila'),
(13, 35, 'Gaurnadi Upazila'),
(14, 35, 'Hizla Upazila'),
(15, 35, 'Mehendiganj Upazila'),
(16, 35, 'Wazirpur Upazila'),
(17, 36, 'Bhola Sadar Upazila'),
(18, 36, 'Burhanuddin Upazila'),
(19, 36, 'Char Fasson Upazila'),
(20, 36, 'Daulatkhan Upazila'),
(21, 36, 'Lalmohan Upazila'),
(22, 36, 'Manpura Upazila'),
(23, 36, 'Tazumuddin Upazila'),
(24, 37, 'Jhalokati Sadar Upazila'),
(25, 37, 'Kathalia Upazila'),
(26, 37, 'Nalchity Upazila'),
(27, 37, 'Rajapur Upazila'),
(28, 38, 'Bauphal Upazila'),
(29, 38, 'Dashmina Upazila'),
(30, 38, 'Galachipa Upazila'),
(31, 38, 'Kalapara Upazila'),
(32, 38, 'Mirzaganj Upazila'),
(33, 38, 'Patuakhali Sadar Upazila'),
(34, 38, 'Dumki Upazila'),
(35, 38, 'Rangabali Upazila'),
(36, 39, 'Bhandaria'),
(37, 39, 'Kaukhali'),
(38, 39, 'Mathbaria'),
(39, 39, 'Nazirpur'),
(40, 39, 'Nesarabad'),
(41, 39, 'Pirojpur Sadar'),
(42, 39, 'Zianagar'),
(43, 40, 'Bandarban Sadar'),
(44, 40, 'Thanchi'),
(45, 40, 'Lama'),
(46, 40, 'Naikhongchhari'),
(47, 40, 'Ali kadam'),
(48, 40, 'Rowangchhari'),
(49, 40, 'Ruma'),
(50, 41, 'Brahmanbaria Sadar Upazila'),
(51, 41, 'Ashuganj Upazila'),
(52, 41, 'Nasirnagar Upazila'),
(53, 41, 'Nabinagar Upazila'),
(54, 41, 'Sarail Upazila'),
(55, 41, 'Shahbazpur Town'),
(56, 41, 'Kasba Upazila'),
(57, 41, 'Akhaura Upazila'),
(58, 41, 'Bancharampur Upazila'),
(59, 41, 'Bijoynagar Upazila'),
(60, 42, 'Chandpur Sadar'),
(61, 42, 'Faridganj'),
(62, 42, 'Haimchar'),
(63, 42, 'Haziganj'),
(64, 42, 'Kachua'),
(65, 42, 'Matlab Uttar'),
(66, 42, 'Matlab Dakkhin'),
(67, 42, 'Shahrasti'),
(68, 43, 'Anwara Upazila'),
(69, 43, 'Banshkhali Upazila'),
(70, 43, 'Boalkhali Upazila'),
(71, 43, 'Chandanaish Upazila'),
(72, 43, 'Fatikchhari Upazila'),
(73, 43, 'Hathazari Upazila'),
(74, 43, 'Lohagara Upazila'),
(75, 43, 'Mirsharai Upazila'),
(76, 43, 'Patiya Upazila'),
(77, 43, 'Rangunia Upazila'),
(78, 43, 'Raozan Upazila'),
(79, 43, 'Sandwip Upazila'),
(80, 43, 'Satkania Upazila'),
(81, 43, 'Sitakunda Upazila'),
(82, 44, 'Barura Upazila'),
(83, 44, 'Brahmanpara Upazila'),
(84, 44, 'Burichong Upazila'),
(85, 44, 'Chandina Upazila'),
(86, 44, 'Chauddagram Upazila'),
(87, 44, 'Daudkandi Upazila'),
(88, 44, 'Debidwar Upazila'),
(89, 44, 'Homna Upazila'),
(90, 44, 'Comilla Sadar Upazila'),
(91, 44, 'Laksam Upazila'),
(92, 44, 'Monohorgonj Upazila'),
(93, 44, 'Meghna Upazila'),
(94, 44, 'Muradnagar Upazila'),
(95, 44, 'Nangalkot Upazila'),
(96, 44, 'Comilla Sadar South Upazila'),
(97, 44, 'Titas Upazila'),
(98, 45, 'Chakaria Upazila'),
(99, 45, 'Chakaria Upazila'),
(100, 45, 'Cox''s Bazar Sadar Upazila'),
(101, 45, 'Kutubdia Upazila'),
(102, 45, 'Maheshkhali Upazila'),
(103, 45, 'Ramu Upazila'),
(104, 45, 'Teknaf Upazila'),
(105, 45, 'Ukhia Upazila'),
(106, 45, 'Pekua Upazila'),
(107, 46, 'Feni Sadar'),
(108, 46, 'Chagalnaiya'),
(109, 46, 'Daganbhyan'),
(110, 46, 'Parshuram'),
(111, 46, 'Fhulgazi'),
(112, 46, 'Sonagazi'),
(113, 47, 'Dighinala Upazila'),
(114, 47, 'Khagrachhari Upazila'),
(115, 47, 'Lakshmichhari Upazila'),
(116, 47, 'Mahalchhari Upazila'),
(117, 47, 'Manikchhari Upazila'),
(118, 47, 'Matiranga Upazila'),
(119, 47, 'Panchhari Upazila'),
(120, 47, 'Ramgarh Upazila'),
(121, 48, 'Lakshmipur Sadar Upazila'),
(122, 48, 'Raipur Upazila'),
(123, 48, 'Ramganj Upazila'),
(124, 48, 'Ramgati Upazila'),
(125, 48, 'Komol Nagar Upazila'),
(126, 49, 'Noakhali Sadar Upazila'),
(127, 49, 'Begumganj Upazila'),
(128, 49, 'Chatkhil Upazila'),
(129, 49, 'Companyganj Upazila'),
(130, 49, 'Shenbag Upazila'),
(131, 49, 'Hatia Upazila'),
(132, 49, 'Kobirhat Upazila'),
(133, 49, 'Sonaimuri Upazila'),
(134, 49, 'Suborno Char Upazila'),
(135, 50, 'Rangamati Sadar Upazila'),
(136, 50, 'Belaichhari Upazila'),
(137, 50, 'Bagaichhari Upazila'),
(138, 50, 'Barkal Upazila'),
(139, 50, 'Juraichhari Upazila'),
(140, 50, 'Rajasthali Upazila'),
(141, 50, 'Kaptai Upazila'),
(142, 50, 'Langadu Upazila'),
(143, 50, 'Nannerchar Upazila'),
(144, 50, 'Kaukhali Upazila'),
(145, 1, 'Dhamrai Upazila'),
(146, 1, 'Dohar Upazila'),
(147, 1, 'Keraniganj Upazila'),
(148, 1, 'Nawabganj Upazila'),
(149, 1, 'Savar Upazila'),
(150, 2, 'Faridpur Sadar Upazila'),
(151, 2, 'Boalmari Upazila'),
(152, 2, 'Alfadanga Upazila'),
(153, 2, 'Madhukhali Upazila'),
(154, 2, 'Bhanga Upazila'),
(155, 2, 'Nagarkanda Upazila'),
(156, 2, 'Charbhadrasan Upazila'),
(157, 2, 'Sadarpur Upazila'),
(158, 2, 'Shaltha Upazila'),
(159, 3, 'Gazipur Sadar-Joydebpur'),
(160, 3, 'Kaliakior'),
(161, 3, 'Kapasia'),
(162, 3, 'Sripur'),
(163, 3, 'Kaliganj'),
(164, 3, 'Tongi'),
(165, 4, 'Gopalganj Sadar Upazila'),
(166, 4, 'Kashiani Upazila'),
(167, 4, 'Kotalipara Upazila'),
(168, 4, 'Muksudpur Upazila'),
(169, 4, 'Tungipara Upazila'),
(170, 5, 'Dewanganj Upazila'),
(171, 5, 'Baksiganj Upazila'),
(172, 5, 'Islampur Upazila'),
(173, 5, 'Jamalpur Sadar Upazila'),
(174, 5, 'Madarganj Upazila'),
(175, 5, 'Melandaha Upazila'),
(176, 5, 'Sarishabari Upazila'),
(177, 5, 'Narundi Police I.C'),
(178, 6, 'Astagram Upazila'),
(179, 6, 'Bajitpur Upazila'),
(180, 6, 'Bhairab Upazila'),
(181, 6, 'Hossainpur Upazila'),
(182, 6, 'Itna Upazila'),
(183, 6, 'Karimganj Upazila'),
(184, 6, 'Katiadi Upazila'),
(185, 6, 'Kishoreganj Sadar Upazila'),
(186, 6, 'Kuliarchar Upazila'),
(187, 6, 'Mithamain Upazila'),
(188, 6, 'Nikli Upazila'),
(189, 6, 'Pakundia Upazila'),
(190, 6, 'Tarail Upazila'),
(191, 7, 'Madaripur Sadar'),
(192, 7, 'Kalkini'),
(193, 7, 'Rajoir'),
(194, 7, 'Shibchar'),
(195, 8, 'Manikganj Sadar Upazila'),
(196, 8, 'Singair Upazila'),
(197, 8, 'Shibalaya Upazila'),
(198, 8, 'Saturia Upazila'),
(199, 8, 'Harirampur Upazila'),
(200, 8, 'Ghior Upazila'),
(201, 8, 'Daulatpur Upazila'),
(202, 9, 'Lohajang Upazila'),
(203, 9, 'Sreenagar Upazila'),
(204, 9, 'Munshiganj Sadar Upazila'),
(205, 9, 'Sirajdikhan Upazila'),
(206, 9, 'Tongibari Upazila'),
(207, 9, 'Gazaria Upazila'),
(208, 10, 'Bhaluka'),
(209, 10, 'Trishal'),
(210, 10, 'Haluaghat'),
(211, 10, 'Muktagachha'),
(212, 10, 'Dhobaura'),
(213, 10, 'Fulbaria'),
(214, 10, 'Gaffargaon'),
(215, 10, 'Gauripur'),
(216, 10, 'Ishwarganj'),
(217, 10, 'Mymensingh Sadar'),
(218, 10, 'Nandail'),
(219, 10, 'Phulpur'),
(220, 11, 'Araihazar Upazila'),
(221, 11, 'Sonargaon Upazila'),
(222, 11, 'Bandar'),
(223, 11, 'Naryanganj Sadar Upazila'),
(224, 11, 'Rupganj Upazila'),
(225, 11, 'Siddirgonj Upazila'),
(226, 12, 'Belabo Upazila'),
(227, 12, 'Monohardi Upazila'),
(228, 12, 'Narsingdi Sadar Upazila'),
(229, 12, 'Palash Upazila'),
(230, 12, 'Raipura Upazila, Narsingdi'),
(231, 12, 'Shibpur Upazila'),
(232, 13, 'Kendua Upazilla'),
(233, 13, 'Atpara Upazilla'),
(234, 13, 'Barhatta Upazilla'),
(235, 13, 'Durgapur Upazilla'),
(236, 13, 'Kalmakanda Upazilla'),
(237, 13, 'Madan Upazilla'),
(238, 13, 'Mohanganj Upazilla'),
(239, 13, 'Netrakona-S Upazilla'),
(240, 13, 'Purbadhala Upazilla'),
(241, 13, 'Khaliajuri Upazilla'),
(242, 14, 'Baliakandi Upazila'),
(243, 14, 'Goalandaghat Upazila'),
(244, 14, 'Pangsha Upazila'),
(245, 14, 'Kalukhali Upazila'),
(246, 14, 'Rajbari Sadar Upazila'),
(247, 15, 'Shariatpur Sadar -Palong'),
(248, 15, 'Damudya Upazila'),
(249, 15, 'Naria Upazila'),
(250, 15, 'Jajira Upazila'),
(251, 15, 'Bhedarganj Upazila'),
(252, 15, 'Gosairhat Upazila'),
(253, 16, 'Jhenaigati Upazila'),
(254, 16, 'Nakla Upazila'),
(255, 16, 'Nalitabari Upazila'),
(256, 16, 'Sherpur Sadar Upazila'),
(257, 16, 'Sreebardi Upazila'),
(258, 17, 'Tangail Sadar Upazila'),
(259, 17, 'Sakhipur Upazila'),
(260, 17, 'Basail Upazila'),
(261, 17, 'Madhupur Upazila'),
(262, 17, 'Ghatail Upazila'),
(263, 17, 'Kalihati Upazila'),
(264, 17, 'Nagarpur Upazila'),
(265, 17, 'Mirzapur Upazila'),
(266, 17, 'Gopalpur Upazila'),
(267, 17, 'Delduar Upazila'),
(268, 17, 'Bhuapur Upazila'),
(269, 17, 'Dhanbari Upazila'),
(270, 55, 'Bagerhat Sadar Upazila'),
(271, 55, 'Chitalmari Upazila'),
(272, 55, 'Fakirhat Upazila'),
(273, 55, 'Kachua Upazila'),
(274, 55, 'Mollahat Upazila'),
(275, 55, 'Mongla Upazila'),
(276, 55, 'Morrelganj Upazila'),
(277, 55, 'Rampal Upazila'),
(278, 55, 'Sarankhola Upazila'),
(279, 56, 'Damurhuda Upazila'),
(280, 56, 'Chuadanga-S Upazila'),
(281, 56, 'Jibannagar Upazila'),
(282, 56, 'Alamdanga Upazila'),
(283, 57, 'Abhaynagar Upazila'),
(284, 57, 'Keshabpur Upazila'),
(285, 57, 'Bagherpara Upazila'),
(286, 57, 'Jessore Sadar Upazila'),
(287, 57, 'Chaugachha Upazila'),
(288, 57, 'Manirampur Upazila'),
(289, 57, 'Jhikargachha Upazila'),
(290, 57, 'Sharsha Upazila'),
(291, 58, 'Jhenaidah Sadar Upazila'),
(292, 58, 'Maheshpur Upazila'),
(293, 58, 'Kaliganj Upazila'),
(294, 58, 'Kotchandpur Upazila'),
(295, 58, 'Shailkupa Upazila'),
(296, 58, 'Harinakunda Upazila'),
(297, 59, 'Terokhada Upazila'),
(298, 59, 'Batiaghata Upazila'),
(299, 59, 'Dacope Upazila'),
(300, 59, 'Dumuria Upazila'),
(301, 59, 'Dighalia Upazila'),
(302, 59, 'Koyra Upazila'),
(303, 59, 'Paikgachha Upazila'),
(304, 59, 'Phultala Upazila'),
(305, 59, 'Rupsa Upazila'),
(306, 60, 'Kushtia Sadar'),
(307, 60, 'Kumarkhali'),
(308, 60, 'Daulatpur'),
(309, 60, 'Mirpur'),
(310, 60, 'Bheramara'),
(311, 60, 'Khoksa'),
(312, 61, 'Magura Sadar Upazila'),
(313, 61, 'Mohammadpur Upazila'),
(314, 61, 'Shalikha Upazila'),
(315, 61, 'Sreepur Upazila'),
(316, 62, 'angni Upazila'),
(317, 62, 'Mujib Nagar Upazila'),
(318, 62, 'Meherpur-S Upazila'),
(319, 63, 'Narail-S Upazilla'),
(320, 63, 'Lohagara Upazilla'),
(321, 63, 'Kalia Upazilla'),
(322, 64, 'Satkhira Sadar Upazila'),
(323, 64, 'Assasuni Upazila'),
(324, 64, 'Debhata Upazila'),
(325, 64, 'Tala Upazila'),
(326, 64, 'Kalaroa Upazila'),
(327, 64, 'Kaliganj Upazila'),
(328, 64, 'Shyamnagar Upazila'),
(329, 18, 'Adamdighi'),
(330, 18, 'Bogra Sadar'),
(331, 18, 'Sherpur'),
(332, 18, 'Dhunat'),
(333, 18, 'Dhupchanchia'),
(334, 18, 'Gabtali'),
(335, 18, 'Kahaloo'),
(336, 18, 'Nandigram'),
(337, 18, 'Sahajanpur'),
(338, 18, 'Sariakandi'),
(339, 18, 'Shibganj'),
(340, 18, 'Sonatala'),
(341, 19, 'Joypurhat S'),
(342, 19, 'Akkelpur'),
(343, 19, 'Kalai'),
(344, 19, 'Khetlal'),
(345, 19, 'Panchbibi'),
(346, 20, 'Naogaon Sadar Upazila'),
(347, 20, 'Mohadevpur Upazila'),
(348, 20, 'Manda Upazila'),
(349, 20, 'Niamatpur Upazila'),
(350, 20, 'Atrai Upazila'),
(351, 20, 'Raninagar Upazila'),
(352, 20, 'Patnitala Upazila'),
(353, 20, 'Dhamoirhat Upazila'),
(354, 20, 'Sapahar Upazila'),
(355, 20, 'Porsha Upazila'),
(356, 20, 'Badalgachhi Upazila'),
(357, 21, 'Natore Sadar Upazila'),
(358, 21, 'Baraigram Upazila'),
(359, 21, 'Bagatipara Upazila'),
(360, 21, 'Lalpur Upazila'),
(361, 21, 'Natore Sadar Upazila'),
(362, 21, 'Baraigram Upazila'),
(363, 22, 'Bholahat Upazila'),
(364, 22, 'Gomastapur Upazila'),
(365, 22, 'Nachole Upazila'),
(366, 22, 'Nawabganj Sadar Upazila'),
(367, 22, 'Shibganj Upazila'),
(368, 23, 'Atgharia Upazila'),
(369, 23, 'Bera Upazila'),
(370, 23, 'Bhangura Upazila'),
(371, 23, 'Chatmohar Upazila'),
(372, 23, 'Faridpur Upazila'),
(373, 23, 'Ishwardi Upazila'),
(374, 23, 'Pabna Sadar Upazila'),
(375, 23, 'Santhia Upazila'),
(376, 23, 'Sujanagar Upazila'),
(377, 24, 'Bagha'),
(378, 24, 'Bagmara'),
(379, 24, 'Charghat'),
(380, 24, 'Durgapur'),
(381, 24, 'Godagari'),
(382, 24, 'Mohanpur'),
(383, 24, 'Paba'),
(384, 24, 'Puthia'),
(385, 24, 'Tanore'),
(386, 25, 'Sirajganj Sadar Upazila'),
(387, 25, 'Belkuchi Upazila'),
(388, 25, 'Chauhali Upazila'),
(389, 25, 'Kamarkhanda Upazila'),
(390, 25, 'Kazipur Upazila'),
(391, 25, 'Raiganj Upazila'),
(392, 25, 'Shahjadpur Upazila'),
(393, 25, 'Tarash Upazila'),
(394, 25, 'Ullahpara Upazila'),
(395, 26, 'Birampur Upazila'),
(396, 26, 'Birganj'),
(397, 26, 'Biral Upazila'),
(398, 26, 'Bochaganj Upazila'),
(399, 26, 'Chirirbandar Upazila'),
(400, 26, 'Phulbari Upazila'),
(401, 26, 'Ghoraghat Upazila'),
(402, 26, 'Hakimpur Upazila'),
(403, 26, 'Kaharole Upazila'),
(404, 26, 'Khansama Upazila'),
(405, 26, 'Dinajpur Sadar Upazila'),
(406, 26, 'Nawabganj'),
(407, 26, 'Parbatipur Upazila'),
(408, 27, 'Fulchhari'),
(409, 27, 'Gaibandha sadar'),
(410, 27, 'Gobindaganj'),
(411, 27, 'Palashbari'),
(412, 27, 'Sadullapur'),
(413, 27, 'Saghata'),
(414, 27, 'Sundarganj'),
(415, 28, 'Kurigram Sadar'),
(416, 28, 'Nageshwari'),
(417, 28, 'Bhurungamari'),
(418, 28, 'Phulbari'),
(419, 28, 'Rajarhat'),
(420, 28, 'Ulipur'),
(421, 28, 'Chilmari'),
(422, 28, 'Rowmari'),
(423, 28, 'Char Rajibpur'),
(424, 29, 'Lalmanirhat Sadar'),
(425, 29, 'Aditmari'),
(426, 29, 'Kaliganj'),
(427, 29, 'Hatibandha'),
(428, 29, 'Patgram'),
(429, 30, 'Nilphamari Sadar'),
(430, 30, 'Saidpur'),
(431, 30, 'Jaldhaka'),
(432, 30, 'Kishoreganj'),
(433, 30, 'Domar'),
(434, 30, 'Dimla'),
(435, 31, 'Panchagarh Sadar'),
(436, 31, 'Debiganj'),
(437, 31, 'Boda'),
(438, 31, 'Atwari'),
(439, 31, 'Tetulia'),
(440, 32, 'Badarganj'),
(441, 32, 'Mithapukur'),
(442, 32, 'Gangachara'),
(443, 32, 'Kaunia'),
(444, 32, 'Rangpur Sadar'),
(445, 32, 'Pirgachha'),
(446, 32, 'Pirganj'),
(447, 32, 'Taraganj'),
(448, 33, 'Thakurgaon Sadar Upazila'),
(449, 33, 'Pirganj Upazila'),
(450, 33, 'Baliadangi Upazila'),
(451, 33, 'Haripur Upazila'),
(452, 33, 'Ranisankail Upazila'),
(453, 51, 'Ajmiriganj'),
(454, 51, 'Baniachang'),
(455, 51, 'Bahubal'),
(456, 51, 'Chunarughat'),
(457, 51, 'Habiganj Sadar'),
(458, 51, 'Lakhai'),
(459, 51, 'Madhabpur'),
(460, 51, 'Nabiganj'),
(461, 51, 'Shaistagonj Upazila'),
(462, 52, 'Moulvibazar Sadar'),
(463, 52, 'Barlekha'),
(464, 52, 'Juri'),
(465, 52, 'Kamalganj'),
(466, 52, 'Kulaura'),
(467, 52, 'Rajnagar'),
(468, 52, 'Sreemangal'),
(469, 53, 'Bishwamvarpur'),
(470, 53, 'Chhatak'),
(471, 53, 'Derai'),
(472, 53, 'Dharampasha'),
(473, 53, 'Dowarabazar'),
(474, 53, 'Jagannathpur'),
(475, 53, 'Jamalganj'),
(476, 53, 'Sulla'),
(477, 53, 'Sunamganj Sadar'),
(478, 53, 'Shanthiganj'),
(479, 53, 'Tahirpur'),
(480, 54, 'Sylhet Sadar'),
(481, 54, 'Beanibazar'),
(482, 54, 'Bishwanath'),
(483, 54, 'Dakshin Surma Upazila'),
(484, 54, 'Balaganj'),
(485, 54, 'Companiganj'),
(486, 54, 'Fenchuganj'),
(487, 54, 'Golapganj'),
(488, 54, 'Gowainghat'),
(489, 54, 'Jaintiapur'),
(490, 54, 'Kanaighat'),
(491, 54, 'Zakiganj'),
(492, 54, 'Nobigonj');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_actual`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin1', 'DMymnapdTLBzLVFurNddt1kdWEB4-h38', '$2y$13$ffbsvQC09/I28fuVOHBWUuT76YXeUEEJK39APWg.F4F.24HLrRbJq', NULL, NULL, 'admin1@email.com', 10, 1471945968, 1471945968),
(2, 'author1', 'JpRGZeGYMNK6glk0VEP3dpjeJ3rclh6N', '$2y$13$VSZgWrEVrF28fqIGTMhb9Oztq30oFCG4E0VrSzBiPnqomAhjs/5pS', NULL, NULL, 'author1@email.com', 10, 1472042727, 1472392282),
(7, 'S12458', 'OnVza233FShXtidzOo6ZR0DDAEV-58YV', '$2y$13$N3um4.ObEFxuXUa3E9qq9.SqwC8hA7xo4XMc1pui9JBzob2JEsUTC', '8IEy2U', NULL, 'ashik@analyzenbd.com', 10, 1475059375, 1475059375),
(9, 'MS1234', 'Sw3J2-8u1yXCbiLSgPPpplCfteQeQz6b', '$2y$13$/fqcXOMFBEM7SjOYoSn7oeZG8iyPwpAfaWnv94iyCsLBeP4uCn.5C', 'Hi0UPI', NULL, 'ashik1@analyzenbd.com', 10, 1475412693, 1475412693),
(10, 'AM123456', 'QhGGDjqHbDWaXpjL8iry-9DEw-MJvZCq', '$2y$13$onfEvpQjLLBPFF0RZSIuYuzEhOpJsHMTRwtJqGaFwcuPw7To9qAMq', 'BeeGD-', NULL, 'ashik2@analyzenbd.com', 10, 1475412843, 1475412843),
(11, 'TM123456', 'Gly9pkQaQrlNVJ33RV5ccCFBHeAF_wMb', '$2y$13$Zw5G4Np/iiJowIoQyBD2YuiYIOfY2t6.wcEO.rA1tbCt.iwfjhDGq', 'H7YI3b', NULL, 'ashik3@analyzenbd.com', 10, 1475413034, 1475413034),
(12, 'R12458', 'y3d_5JxFJVI-ng24V5J_XKje0y7NPwQu', '$2y$13$e9n7qqEkfEoeg.ZG1TIWhuzahaZkgx6LOfIll4Jf8sUaHu8LN8MUi', 'coIPD3', NULL, 'ashik5@analyzenbd.com', 10, 1475413127, 1475413127),
(13, '12456', '94OozewrBB-ZxSj1LSpCloAU8oDjMcGb', '$2y$13$laDBkygb4VoD0a4C4RSE7.glTKdVDwFqARHRhGUsi/BfIZw/8n8cm', 'sxF0cM', NULL, 'ashik123@analyzenbd.com', 10, 1475470918, 1475470918),
(14, 'TR123456', 'rcbcHvFYbectU3h99h9cubfLDCOe6FYQ', '$2y$13$PbrLv7SO8Ir0WKKtHWsHT.31c2XFYWONfnC/12YDXjmQj/OzUCMvS', 'zJ9H64', NULL, 'ashik01111111111@analyzenbd.com', 10, 1477566821, 1477566821),
(15, 'TR0976', 'uw1kUH3qoJ7QbAq1Ikr4TyQh_3A7jfVU', '$2y$13$WemNBgS4V6lU.MHcP4qoYe3TRot4RDAnkqb84a1d3rtgDIu6OkuZ2', 'F5fFkX', NULL, 'ashik222@analyzenbd.com', 10, 1477566997, 1477566997),
(16, 'TRIN1234', 'hJscvVJZTZXOBrhZyG58j2H0P4TBOP_h', '$2y$13$spRPnYeaocTwYmB8ZKihaOmoVtJwsP/R6VtDWOPfeSb8AvI32Vzc.', 'TW2o7M', NULL, 'ashik12@analyzenbd.com', 10, 1477571474, 1477571474),
(20, 'S0987', 'xZpTKcZrCAVsaXIW_MdMKGq02QV-NuMq', '$2y$13$I.IesQ9h4n98nd79/o5dRetruALj/pmWnJchAanRygVcILK5pS/Ue', 'zbH9M7', NULL, 'ashik_sec1@analyzenbd.com', 10, 1481466880, 1481466880),
(21, 'S10912', '228Ufx08GmSiZNI1sh2n2kZbbjsc9vyI', '$2y$13$cYzUmcJqP3TastV8JDE/KeALn0ck5i49NJsFHOX7V6Nyd2jSHWfBe', '6PNMAk', NULL, 'ashik_sec2@analyzenbd.com', 10, 1481466950, 1481466950);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) unsigned NOT NULL,
  `role` enum('super','admin') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'super'),
(2, 'admin');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(2) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(2) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `hr`
--
ALTER TABLE `hr`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `hr_designation`
--
ALTER TABLE `hr_designation`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `hr_employee_type`
--
ALTER TABLE `hr_employee_type`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `hr_management`
--
ALTER TABLE `hr_management`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hr_sales`
--
ALTER TABLE `hr_sales`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `hr_trainer`
--
ALTER TABLE `hr_trainer`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `left_menu`
--
ALTER TABLE `left_menu`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=316;
--
-- AUTO_INCREMENT for table `mi_infra`
--
ALTER TABLE `mi_infra`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mi_product`
--
ALTER TABLE `mi_product`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mi_tpcp`
--
ALTER TABLE `mi_tpcp`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mi_visibility`
--
ALTER TABLE `mi_visibility`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `retail`
--
ALTER TABLE `retail`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `retail_area`
--
ALTER TABLE `retail_area`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `retail_channel_type`
--
ALTER TABLE `retail_channel_type`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `retail_location`
--
ALTER TABLE `retail_location`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `retail_type`
--
ALTER TABLE `retail_type`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `retail_zone`
--
ALTER TABLE `retail_zone`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `sales_batch`
--
ALTER TABLE `sales_batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `stock_batch`
--
ALTER TABLE `stock_batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `target`
--
ALTER TABLE `target`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `target_batch`
--
ALTER TABLE `target_batch`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `training_assessment_category`
--
ALTER TABLE `training_assessment_category`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `training_assessment_question`
--
ALTER TABLE `training_assessment_question`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `training_assessment_result`
--
ALTER TABLE `training_assessment_result`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `training_pdf`
--
ALTER TABLE `training_pdf`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `travel`
--
ALTER TABLE `travel`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `upazilas`
--
ALTER TABLE `upazilas`
  MODIFY `id` int(2) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=493;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
