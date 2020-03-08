-- --------------------------------------------------------

--
-- Table structure for table `tbl_carts`
--

DROP TABLE IF EXISTS `tbl_carts`;
CREATE TABLE `tbl_carts` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `cart_image` varchar(255) NOT NULL,
  `cart_status` int(11) NOT NULL,
  `cart_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cart_title` varchar(255) NOT NULL,
  `cart_quantity` int(11) NOT NULL DEFAULT '1',
  `cart_price` int(11) NOT NULL,
  `cart_f_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

DROP TABLE IF EXISTS `tbl_categories`;
CREATE TABLE `tbl_categories` (
  `cat_id` int(11) NOT NULL,
  `cat_parent1` int(11) DEFAULT NULL,
  `cat_parent2` int(11) DEFAULT NULL,
  `cat_icon` varchar(255) DEFAULT NULL,
  `cat_menu` int(11) DEFAULT NULL,
  `cat_title` varchar(255) DEFAULT NULL,
  `cat_slug` varchar(550) DEFAULT NULL,
  `cat_type` varchar(11) DEFAULT '0',
  `cat_link` varchar(550) DEFAULT NULL,
  `cat_label` int(11) DEFAULT NULL,
  `cat_order` int(11) DEFAULT NULL,
  `cat_status` int(11) DEFAULT NULL,
  `cat_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`cat_id`, `cat_parent1`, `cat_parent2`, `cat_icon`, `cat_menu`, `cat_title`, `cat_slug`, `cat_type`, `cat_link`, `cat_label`, `cat_order`, `cat_status`, `cat_date`) VALUES
(29, 0, 0, 'icon-shirt', 1, 'Men\'s Fashion', 'men-s-fashions', '0', '', 1, 1, 1, '2020-02-26 09:05:07'),
(30, 29, 0, '', 1, 'Summer Collection', 'summer-collection', '1', '', 1, 1, 1, '2020-03-08 10:18:12'),
(34, 29, 30, '', 1, 'T-Shirts', 't-shirts', '2', '', 2, 2, 1, '2020-03-08 06:32:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

DROP TABLE IF EXISTS `tbl_contact`;
CREATE TABLE `tbl_contact` (
  `contact_id` int(11) NOT NULL,
  `contact_read` tinyint(4) NOT NULL DEFAULT '0',
  `contact_name` varchar(50) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `contact_phone` varchar(50) NOT NULL,
  `contact_message` varchar(1000) NOT NULL,
  `contact_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`contact_id`, `contact_read`, `contact_name`, `contact_email`, `contact_phone`, `contact_message`, `contact_date`) VALUES
(2, 1, 'Ali Naqi', 'alinaqi2000@gmail.com', '123456789', '        Hi!\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n<Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2019-09-22 00:06:29'),
(3, 1, 'Ahmad', 'ahmad@gmail.com', '', '        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occa', '2019-09-22 00:08:50'),
(5, 1, 'Ehmer', 'ehmerhaider@gmail.com', '5198461651', 'Hi Ali!\r\n Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occa', '2019-09-22 01:30:57'),
(6, 1, 'Sahin', 'sahinnuri23@gmail.com', '', 'Hey! \r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', '2019-09-22 21:03:05'),
(7, 1, 'Ali', 'alinaqi2000@gmail.com', '3061561246', 'Hi Ali!\r\nLorem ipsum dolor sit amet, consecteturing the adipiscing elit. Pellentesque nec metuses vel ligula placerat pellentesque.', '2019-09-23 02:29:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

DROP TABLE IF EXISTS `tbl_customers`;
CREATE TABLE `tbl_customers` (
  `cus_id` int(11) NOT NULL,
  `cus_type` varchar(255) NOT NULL DEFAULT 'general',
  `cus_email` varchar(255) NOT NULL,
  `cus_fname` varchar(255) NOT NULL,
  `cus_name` varchar(255) DEFAULT NULL,
  `cus_lname` varchar(255) DEFAULT NULL,
  `cus_password` varchar(255) NOT NULL,
  `cus_phone` int(50) DEFAULT NULL,
  `cus_street` varchar(500) DEFAULT NULL,
  `cus_city` varchar(255) DEFAULT NULL,
  `cus_country` varchar(25) DEFAULT NULL,
  `cus_state` varchar(255) DEFAULT NULL,
  `cus_status` int(11) NOT NULL DEFAULT '0',
  `cus_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cus_orders` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`cus_id`, `cus_type`, `cus_email`, `cus_fname`, `cus_name`, `cus_lname`, `cus_password`, `cus_phone`, `cus_street`, `cus_city`, `cus_country`, `cus_state`, `cus_status`, `cus_date`, `cus_orders`) VALUES
(1, 'general', 'alinaqi2000@gmail.com', 'Ali', 'alinaqi2000', 'Naqi', '2fd02d19734af01cda3c01c496c13149', 214748364, 'Street# 3, Rehmat Park', 'Sargodha', 'Pakistan', 'Punjab', 0, '2019-12-07 10:15:26', NULL),
(4, 'general', 'ehmerhaider@gmail.com', 'Ehmer', 'ehmer-haider', 'Haider', 'de2c9295bb5c421d9ea7bcbe669a98f6', 307000723, 'Street# 2,  Aziz Colony', 'Sargodha', 'Pakistan', 'Punjab', 0, '2019-12-07 10:26:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

DROP TABLE IF EXISTS `tbl_gallery`;
CREATE TABLE `tbl_gallery` (
  `g_id` int(11) NOT NULL,
  `g_title` varchar(255) DEFAULT NULL,
  `g_image` varchar(255) NOT NULL,
  `g_alt` varchar(255) DEFAULT NULL,
  `g_status` int(11) NOT NULL DEFAULT '0',
  `g_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_listings`
--

DROP TABLE IF EXISTS `tbl_listings`;
CREATE TABLE `tbl_listings` (
  `list_id` int(11) NOT NULL,
  `list_type` varchar(50) NOT NULL,
  `list_title` varchar(255) DEFAULT NULL,
  `list_slug` varchar(255) DEFAULT NULL,
  `list_gender` varchar(11) NOT NULL,
  `list_desc` varchar(1000) DEFAULT NULL,
  `list_detail` longtext,
  `list_link` varchar(100) NOT NULL,
  `list_thumb` varchar(50) DEFAULT NULL,
  `list_image` varchar(50) DEFAULT NULL,
  `list_banner` varchar(50) DEFAULT NULL,
  `list_price` float NOT NULL,
  `list_label` int(11) NOT NULL DEFAULT '0',
  `list_order` int(11) DEFAULT NULL,
  `list_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_listings`
--

INSERT INTO `tbl_listings` (`list_id`, `list_type`, `list_title`, `list_slug`, `list_gender`, `list_desc`, `list_detail`, `list_link`, `list_thumb`, `list_image`, `list_banner`, `list_price`, `list_label`, `list_order`, `list_status`) VALUES
(17, 'categories', 'Landscape', 'landscape', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum', '', NULL, 'image_15636566754556.jpg', NULL, 0, 1, 1, 1),
(18, 'categories', 'Car', 'car', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do sidu', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', NULL, 'image_15636566942788.jpg', NULL, 0, 1, 2, 1),
(27, 'categories', 'Manipulation', 'manipulation', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', NULL, 'image_15636567134998.jpg', NULL, 0, 1, 3, 1),
(28, 'categories', 'Sea', 'sea', '', 'Lorem ipsum dolor sit amet, consecteturs nisi ut aliquip ex ea commodo ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', NULL, 'image_15636985569172.jpg', NULL, 0, 0, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mails`
--

DROP TABLE IF EXISTS `tbl_mails`;
CREATE TABLE `tbl_mails` (
  `m_id` int(11) NOT NULL,
  `m_owner` int(11) NOT NULL,
  `m_code` int(255) NOT NULL,
  `m_author` int(11) NOT NULL,
  `m_recipient` int(11) NOT NULL,
  `m_date` varchar(255) DEFAULT NULL,
  `m_label` int(11) NOT NULL DEFAULT '0',
  `m_status` int(11) NOT NULL DEFAULT '0',
  `m_subject` varchar(255) DEFAULT NULL,
  `m_tags` varchar(255) DEFAULT NULL,
  `m_content` longtext,
  `m_attach` longtext,
  `m_order` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

DROP TABLE IF EXISTS `tbl_orders`;
CREATE TABLE `tbl_orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_price` int(255) NOT NULL,
  `order_tax` int(50) DEFAULT NULL,
  `order_location` longtext NOT NULL,
  `order_products` longtext NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_status` int(11) NOT NULL DEFAULT '0',
  `order_method` int(11) DEFAULT '1',
  `order_read` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `customer_id`, `order_price`, `order_tax`, `order_location`, `order_products`, `order_date`, `order_status`, `order_method`, `order_read`) VALUES
(8, 4, 7031, 335, 'Street# 2,  Aziz Colony, Sargodha, Punjab, Pakistan', 'a:2:{i:0;a:5:{s:10:\"product_id\";s:1:\"6\";s:13:\"product_image\";s:25:\"image_1570977314_9204.jpg\";s:16:\"product_single_P\";s:4:\"1899\";s:16:\"product_quantity\";s:1:\"1\";s:15:\"product_total_p\";s:4:\"1899\";}i:1;a:5:{s:10:\"product_id\";s:1:\"9\";s:13:\"product_image\";s:25:\"image_1571149698_4536.jpg\";s:16:\"product_single_P\";s:4:\"1599\";s:16:\"product_quantity\";s:1:\"3\";s:15:\"product_total_p\";s:4:\"4797\";}}', '2019-12-07 10:22:06', 0, 1, 1),
(9, 1, 1994, 95, 'Street# 3, Rehmat Park, Sargodha, Punjab, Pakistan', 'a:1:{i:0;a:5:{s:10:\"product_id\";s:1:\"6\";s:13:\"product_image\";s:25:\"image_1570977314_9204.jpg\";s:16:\"product_single_P\";s:4:\"1899\";s:16:\"product_quantity\";s:1:\"1\";s:15:\"product_total_p\";s:4:\"1899\";}}', '2019-12-08 07:55:58', 0, 1, 1),
(10, 1, 135446, 6450, 'Street# 3, Rehmat Park, Sargodha, Punjab, Pakistan', 'a:2:{i:0;a:5:{s:10:\"product_id\";s:1:\"1\";s:13:\"product_image\";s:25:\"image_1570974456_8817.jpg\";s:16:\"product_single_P\";s:3:\"999\";s:16:\"product_quantity\";s:1:\"3\";s:15:\"product_total_p\";s:4:\"2997\";}i:1;a:5:{s:10:\"product_id\";s:1:\"7\";s:13:\"product_image\";s:26:\"image_1571057387_4798.jpeg\";s:16:\"product_single_P\";s:6:\"125999\";s:16:\"product_quantity\";s:1:\"1\";s:15:\"product_total_p\";s:6:\"125999\";}}', '2019-12-09 02:16:48', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pages`
--

DROP TABLE IF EXISTS `tbl_pages`;
CREATE TABLE `tbl_pages` (
  `page_id` int(11) NOT NULL,
  `page_type` int(11) DEFAULT NULL,
  `page_menu` int(11) NOT NULL DEFAULT '0',
  `page_parent` int(11) NOT NULL DEFAULT '0',
  `page_name` varchar(255) NOT NULL,
  `page_meta_title` varchar(100) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_detail` longtext,
  `page_link` varchar(100) NOT NULL,
  `page_label` int(11) NOT NULL,
  `page_image` varchar(100) NOT NULL,
  `page_thumb` varchar(255) DEFAULT NULL,
  `page_embed_video` text,
  `page_meta_desc` text,
  `page_meta_keywords` text,
  `page_footer` int(11) NOT NULL DEFAULT '0',
  `page_status` int(1) NOT NULL DEFAULT '1',
  `page_modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_date` datetime NOT NULL,
  `page_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_pages`
--

INSERT INTO `tbl_pages` (`page_id`, `page_type`, `page_menu`, `page_parent`, `page_name`, `page_meta_title`, `page_title`, `page_detail`, `page_link`, `page_label`, `page_image`, `page_thumb`, `page_embed_video`, `page_meta_desc`, `page_meta_keywords`, `page_footer`, `page_status`, `page_modify_date`, `page_date`, `page_order`) VALUES
(32, 0, 1, 0, 'products', 'Products', 'Products', '', '', 0, '', NULL, NULL, '', NULL, 0, 1, '2019-10-14 02:37:55', '0000-00-00 00:00:00', 2),
(34, 0, 1, 0, 'our-mission', 'Our Mission', 'Our Mission', '<figure class=\"easyimage easyimage-full\"><img alt=\"\" src=\"http://wallpaperswide.com/download/travel_the_world-wallpaper-1366x768.jpg\" width=\"1366\" />\r\n<figcaption></figcaption>\r\n</figure>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>MUSLIM countries are turning into fast-growing markets for chocolate, and one Asian country is betting more people around the world are going to want candy and goodies that comply with the religion&rsquo;s strict food laws.<br />\r\noffers Hoest candy production line products from China and other countries around the world.</p>\r\n\r\n<p>A wide variety of Hoest candy production line options are available to you. You can also submit buying request for the abs sensor and specify your requirement on, and we will help you find the quality Hoest candy production line suppliers.</p>\r\n\r\n<p>There are a lot off suppliers providing Hoest candy production line on, mainly located in Asia. The eclairs candy production line products are most popular in India, Pakistan, Vietnam, Indonesia, Brazil, Russia, Mexico, United States, Turkey, Germany, etc.</p>\r\n\r\n<p>You can ensure product safety from certified suppliers certified to the relevant standards.</p>\r\n', 'mission', 1, '', NULL, NULL, '', NULL, 0, 1, '2019-12-06 22:02:35', '0000-00-00 00:00:00', 3),
(51, 1, 1, 34, 'business-services', 'Business Services', 'BUSINESS SERVICES', '<figure class=\"easyimage easyimage-full\"><img alt=\"\" src=\"blob:http://localhost/02555096-aa9e-48c8-812f-484e79200a0e\" width=\"750\" />\r\n<figcaption></figcaption>\r\n</figure>\r\n\r\n<p>asdasd</p>\r\n', '', 1, '', NULL, NULL, '', NULL, 0, 1, '2019-12-20 12:21:19', '0000-00-00 00:00:00', 4),
(52, 0, 1, 0, 'categories', 'Categories', 'Categories', '', 'categories/all', 1, '', NULL, NULL, '', NULL, 0, 1, '2020-02-26 10:56:17', '0000-00-00 00:00:00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

DROP TABLE IF EXISTS `tbl_products`;
CREATE TABLE `tbl_products` (
  `p_id` int(11) NOT NULL,
  `p_seller` int(11) NOT NULL DEFAULT '1',
  `p_title` varchar(255) DEFAULT NULL,
  `p_slug` varchar(550) DEFAULT NULL,
  `p_pcat` int(11) DEFAULT NULL,
  `p_cat` int(11) DEFAULT NULL,
  `p_menu` int(11) DEFAULT NULL,
  `p_rating` int(11) DEFAULT NULL,
  `p_order` int(11) DEFAULT NULL,
  `p_desc` longtext,
  `p_detail` longtext,
  `p_available` int(11) DEFAULT NULL,
  `p_old_c` double DEFAULT NULL,
  `p_new_c` double DEFAULT NULL,
  `p_discount` int(11) DEFAULT NULL,
  `p_status` int(11) DEFAULT NULL,
  `p_label` int(11) DEFAULT NULL,
  `p_image` varchar(255) DEFAULT NULL,
  `p_thumb` varchar(255) DEFAULT NULL,
  `p_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_images`
--

DROP TABLE IF EXISTS `tbl_product_images`;
CREATE TABLE `tbl_product_images` (
  `pi_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `pi_image` varchar(255) DEFAULT NULL,
  `pi_title` varchar(255) DEFAULT NULL,
  `pi_alt` varchar(255) DEFAULT NULL,
  `pi_status` int(11) DEFAULT NULL,
  `pi_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reviews`
--

DROP TABLE IF EXISTS `tbl_reviews`;
CREATE TABLE `tbl_reviews` (
  `r_id` int(11) NOT NULL,
  `r_product` int(11) NOT NULL,
  `r_rating` int(11) DEFAULT NULL,
  `r_name` varchar(255) NOT NULL,
  `r_view` varchar(1000) DEFAULT NULL,
  `r_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_reviews`
--

INSERT INTO `tbl_reviews` (`r_id`, `r_product`, `r_rating`, `r_name`, `r_view`, `r_date`) VALUES
(11, 1, 80, 'Ali', 'Nice jersey.', '2019-12-11 05:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siteadmin`
--

DROP TABLE IF EXISTS `tbl_siteadmin`;
CREATE TABLE `tbl_siteadmin` (
  `site_id` int(11) NOT NULL,
  `site_type` varchar(50) DEFAULT NULL,
  `site_login` varchar(20) NOT NULL,
  `site_pswd` varchar(32) NOT NULL,
  `site_info_data` longtext,
  `site_admin_data` longtext NOT NULL,
  `site_contact_data` longtext,
  `site_theme_data` longtext,
  `site_social_data` longtext,
  `site_og_data` longtext,
  `site_contact_map` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbl_siteadmin`
--

INSERT INTO `tbl_siteadmin` (`site_id`, `site_type`, `site_login`, `site_pswd`, `site_info_data`, `site_admin_data`, `site_contact_data`, `site_theme_data`, `site_social_data`, `site_og_data`, `site_contact_map`) VALUES
(1, 'super_admin', 'alinaqi2000', '6e586d764f582c117f0ef15dad2605bd', 'a:6:{s:9:\"site_name\";s:7:\"ourEcom\";s:9:\"site_desc\";s:0:\"\";s:16:\"site_footer_text\";s:38:\"© 2019 ourEcom. All Rights Reserved. \";s:9:\"site_logo\";s:25:\"image_1581669144_2113.png\";s:8:\"sec_logo\";s:25:\"image_1581149617_2176.png\";s:12:\"site_favicon\";s:26:\"image_1581149617_21761.png\";}', 'a:4:{s:10:\"admin_name\";s:18:\"Ali Naqi Al-Musawi\";s:15:\"admin_portfolio\";s:31:\"Junior Full Stack Web Developer\";s:10:\"admin_text\";s:0:\"\";s:11:\"admin_image\";s:25:\"image_1583662980_6416.jpg\";}', 'a:4:{s:13:\"contact_email\";s:21:\"alinaqi2000@gmail.com\";s:13:\"contact_phone\";s:16:\" 92 306 156 1246\";s:13:\"contact_hours\";s:27:\"Mon - Sun / 9:00AM - 8:00PM\";s:15:\"contact_address\";s:49:\"Rehmat Park, University Road, Sargodha, Pakistan.\";}', 'a:11:{s:12:\"general_text\";s:10:\"text-white\";s:14:\"secondary_text\";s:9:\"text-dark\";s:11:\"primary_btn\";s:16:\"btn-outline-info\";s:16:\"primary_timeline\";s:6:\"danger\";s:9:\"header_bg\";s:16:\" bg-happy-fisher\";s:11:\"header_text\";s:17:\"header-text-light\";s:12:\"sidebar_text\";s:17:\"sidebar-text-dark\";s:10:\"sidebar_bg\";s:8:\"bg-white\";s:14:\"sidebar_banner\";s:25:\"image_1570957659_6879.jpg\";s:7:\"dash_bg\";s:16:\" bg-happy-fisher\";s:9:\"footer_bg\";s:8:\"bg-white\";}', 'a:7:{s:9:\"social_fb\";s:36:\"https://www.facebook.com/alinaqi2000\";s:10:\"social_twt\";s:31:\"https://twitter.com/alinaqi2000\";s:11:\"social_inst\";s:33:\"https://instagram.com/alinaqi2000\";s:12:\"social_linkd\";s:57:\"https://www.linkedin.com/in/ali-naqi-al-musawi-531742100/\";s:9:\"social_yt\";s:56:\"https://www.youtube.com/channel/UC5ZnxASDnkuZ3JVR5xVn7fg\";s:12:\"social_gmail\";s:21:\"alinaqi2000@gmail.com\";s:10:\"social_pin\";s:0:\"\";}', 'a:6:{s:13:\"site_og_title\";s:25:\"Prime Cargo International\";s:12:\"site_og_type\";s:7:\"website\";s:13:\"site_og_image\";s:73:\"http://localhost/paperbirdpackaging/uploads/logo/Image_15474478326709.png\";s:18:\"site_og_image_type\";s:10:\"image/jpeg\";s:14:\"site_og_locale\";s:5:\"en_US\";s:19:\"site_og_description\";s:25:\"Prime Cargo International\";}', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d845.2902674943832!2d72.68641282917709!3d32.064891998824564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzLCsDAzJzUzLjYiTiA3MsKwNDEnMTMuMSJF!5e0!3m2!1sen!2s!4v1575704271212!5m2!1sen!2s\" width=\"100%\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\"></iframe>'),
(8, 'super_admin', 'ehmerhaider', '7acc2c9a827c0feaf0cfea12a9698d7c', NULL, 'a:5:{s:10:\"admin_name\";s:12:\"Ehmer Haider\";s:15:\"admin_portfolio\";s:16:\"Site Super Admin\";s:10:\"admin_text\";s:30:\"I\'m a freelance Web Developer.\";s:11:\"admin_image\";s:0:\"\";s:5:\"passY\";s:1:\"0\";}', NULL, NULL, NULL, NULL, NULL),
(13, 'super_admin', 'saad_khan', '138249968a5da172f00792609f89b1fa', NULL, 'a:5:{s:10:\"admin_name\";s:9:\"Saad Khan\";s:15:\"admin_portfolio\";s:20:\"Site Content Manager\";s:10:\"admin_text\";s:36:\"I\'m a freelance Web Content Manager.\";s:11:\"admin_image\";s:25:\"image_1582625363_2149.png\";s:5:\"passY\";s:1:\"0\";}', NULL, NULL, NULL, NULL, NULL),
(14, 'super_admin', 'mianhaseeb', 'c0e2f06469caa8e2998aba4e7d399dcd', NULL, 'a:5:{s:10:\"admin_name\";s:11:\"Mian Haseeb\";s:15:\"admin_portfolio\";s:16:\"Site Super Admin\";s:10:\"admin_text\";s:36:\"I\'m a freelance Web Content Manager.\";s:11:\"admin_image\";s:0:\"\";s:5:\"passY\";s:1:\"0\";}', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

DROP TABLE IF EXISTS `tbl_slider`;
CREATE TABLE `tbl_slider` (
  `slider_id` int(11) NOT NULL,
  `slider_title` varchar(255) DEFAULT NULL,
  `slider_sec_title` varchar(255) DEFAULT NULL,
  `slider_desc` varchar(1000) DEFAULT NULL,
  `slider_btn1_text` varchar(100) DEFAULT NULL,
  `slider_btn1_link` varchar(500) DEFAULT NULL,
  `slider_btn2_text` varchar(100) DEFAULT NULL,
  `slider_btn2_link` varchar(500) DEFAULT NULL,
  `slider_thumb` varchar(50) DEFAULT NULL,
  `slider_image` varchar(50) DEFAULT NULL,
  `slider_position` varchar(11) DEFAULT NULL,
  `slider_order` int(11) DEFAULT NULL,
  `slider_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`slider_id`, `slider_title`, `slider_sec_title`, `slider_desc`, `slider_btn1_text`, `slider_btn1_link`, `slider_btn2_text`, `slider_btn2_link`, `slider_thumb`, `slider_image`, `slider_position`, `slider_order`, `slider_status`) VALUES
(11, 'Fashion\'s Mega Sale', '34% off for select items', NULL, 'Shop Now', 'product/blue-sweater', NULL, NULL, NULL, 'image_1572682755_3776.png', 'left', 1, 1),
(12, 'Fashion\'s Mega Sale', 'up to 30% off', NULL, 'Shop Now', 'categories/men-fashion', NULL, NULL, NULL, 'image_1572679638_1916.png', 'right', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_texts`
--

DROP TABLE IF EXISTS `tbl_texts`;
CREATE TABLE `tbl_texts` (
  `txt_id` int(11) NOT NULL,
  `txt_type` varchar(50) NOT NULL,
  `txt_data` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_texts`
--

INSERT INTO `tbl_texts` (`txt_id`, `txt_type`, `txt_data`) VALUES
(7, 'home_sections', 'a:22:{s:6:\"f_page\";s:15:\"Special Offers!\";s:11:\"f_page_link\";s:25:\"categories/mobiles-phones\";s:6:\"s_page\";s:0:\"\";s:11:\"s_page_link\";s:0:\"\";s:11:\"item1_title\";s:22:\"FREE SHIPPING & RETURN\";s:15:\"item1_title_sec\";s:37:\"Free shipping on all orders over $99.\";s:10:\"item1_icon\";s:13:\"icon-shipping\";s:11:\"item2_title\";s:20:\"MONEY BACK GUARANTEE\";s:15:\"item2_title_sec\";s:25:\"100% money back guarantee\";s:10:\"item2_icon\";s:14:\"icon-us-dollar\";s:11:\"item3_title\";s:19:\"ONLINE SUPPORT 24/7\";s:15:\"item3_title_sec\";s:27:\"Lorem ipsum dolor sit amet.\";s:10:\"item3_icon\";s:12:\"icon-support\";s:12:\"sitem1_title\";s:16:\"CUSTOMER SUPPORT\";s:16:\"sitem1_title_sec\";s:95:\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapib.\r\n\";s:11:\"sitem1_icon\";s:18:\"icon-earphones-alt\";s:12:\"sitem2_title\";s:15:\"SECURED PAYMENT\";s:16:\"sitem2_title_sec\";s:157:\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapibus lacus. Lorem ipsum dolor sit amet.consectetur adipiscing elit.\";s:11:\"sitem2_icon\";s:16:\"icon-credit-card\";s:12:\"sitem3_title\";s:7:\"RETURNS\";s:16:\"sitem3_title_sec\";s:101:\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapibus lacus.\";s:11:\"sitem3_icon\";s:16:\"icon-action-undo\";}'),
(8, 'banners', 'a:13:{s:9:\"s1_banner\";s:25:\"image_1571072269_9677.jpg\";s:7:\"s1_link\";s:14:\"categories/all\";s:9:\"s2_banner\";s:26:\"image_1571072269_96771.jpg\";s:7:\"s2_link\";s:14:\"categories/all\";s:9:\"s3_banner\";s:26:\"image_1571072269_96772.jpg\";s:7:\"s3_link\";s:14:\"categories/all\";s:8:\"p_banner\";s:26:\"image_1571072269_96773.jpg\";s:6:\"p_text\";s:23:\"FASHION SHOW COLLECTION\";s:6:\"p_link\";s:14:\"categories/all\";s:11:\"ctop_banner\";s:25:\"image_1571075002_5604.jpg\";s:9:\"ctop_text\";s:16:\"INCREDIBLE DEALS\";s:13:\"ctop_sec_text\";s:31:\"check out over <span>200</span>\";s:9:\"ctop_link\";s:14:\"categories/all\";}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_carts`
--
ALTER TABLE `tbl_carts`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `tbl_listings`
--
ALTER TABLE `tbl_listings`
  ADD PRIMARY KEY (`list_id`);

--
-- Indexes for table `tbl_mails`
--
ALTER TABLE `tbl_mails`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `Product Categories` (`p_cat`);

--
-- Indexes for table `tbl_product_images`
--
ALTER TABLE `tbl_product_images`
  ADD PRIMARY KEY (`pi_id`),
  ADD KEY `project_id` (`product_id`);

--
-- Indexes for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `tbl_siteadmin`
--
ALTER TABLE `tbl_siteadmin`
  ADD PRIMARY KEY (`site_id`),
  ADD UNIQUE KEY `login` (`site_login`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `tbl_texts`
--
ALTER TABLE `tbl_texts`
  ADD PRIMARY KEY (`txt_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_carts`
--
ALTER TABLE `tbl_carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `tbl_listings`
--
ALTER TABLE `tbl_listings`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_mails`
--
ALTER TABLE `tbl_mails`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_product_images`
--
ALTER TABLE `tbl_product_images`
  MODIFY `pi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_siteadmin`
--
ALTER TABLE `tbl_siteadmin`
  MODIFY `site_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_texts`
--
ALTER TABLE `tbl_texts`
  MODIFY `txt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `Product Categories` FOREIGN KEY (`p_cat`) REFERENCES `tbl_categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_product_images`
--
ALTER TABLE `tbl_product_images`
  ADD CONSTRAINT `Product Images` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
