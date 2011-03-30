-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 28, 2011 at 01:22 PM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `db_tarichi`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_on`
--

CREATE TABLE IF NOT EXISTS `add_on` (
  `add_on_id` varchar(60) NOT NULL,
  `add_on_name` varchar(60) NOT NULL,
  `add_on_def_controller` varchar(60) NOT NULL,
  `add_on_def_setting` text NOT NULL,
  `js_script_generated` text NOT NULL,
  PRIMARY KEY (`add_on_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_on`
--


-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(60) NOT NULL,
  `category_url` varchar(60) NOT NULL,
  `category_desc` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_url`, `category_desc`) VALUES
(1, 'Blog', 'blog', 'Blog of Tarichi'),
(2, 'Berita', 'berita', 'Berita of Tarichi');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_name` varchar(80) NOT NULL,
  `comment_email` varchar(50) NOT NULL,
  `comment_website` varchar(60) NOT NULL,
  `comment_date` int(11) NOT NULL,
  `comment_content` varchar(255) NOT NULL,
  `the_post_id` int(11) NOT NULL,
  `parent_comment_id` int(11) NOT NULL,
  `comment_status` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_name`, `comment_email`, `comment_website`, `comment_date`, `comment_content`, `the_post_id`, `parent_comment_id`, `comment_status`) VALUES
(1, 'commentator', 'commentator@comment.com', 'http://www.goblogan.com', 1300093543, 'Just test the comment', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `flash_item`
--

CREATE TABLE IF NOT EXISTS `flash_item` (
  `flash_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `flash_item_title` varchar(160) NOT NULL,
  `flash_item_desc` varchar(255) NOT NULL,
  `flash_item_image` varchar(200) NOT NULL,
  `flash_item_linkto` varchar(200) NOT NULL,
  `flash_item_order` int(11) NOT NULL,
  `flash_item_caption` varchar(60) NOT NULL,
  PRIMARY KEY (`flash_item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `flash_item`
--

INSERT INTO `flash_item` (`flash_item_id`, `flash_item_title`, `flash_item_desc`, `flash_item_image`, `flash_item_linkto`, `flash_item_order`, `flash_item_caption`) VALUES
(1, 'Bored with your life ?', 'Try some of our tips, feel it', 'bored.jpg', 'http://www.goblogan.com', 1, 'bosan_caption'),
(2, 'Life Colorfull', 'Feel the power of color, paint your life with beautiful color. ', 'colorfull.jpg', 'http://www.goblogan.com', 2, 'colorfull_caption');

-- --------------------------------------------------------

--
-- Table structure for table `img_lib`
--

CREATE TABLE IF NOT EXISTS `img_lib` (
  `img_lib` int(11) NOT NULL AUTO_INCREMENT,
  `img_name` varchar(150) NOT NULL,
  `img_name_thumb` varchar(150) NOT NULL,
  `img_title` varchar(100) NOT NULL,
  `img_desc` varchar(255) NOT NULL,
  `img_file_size` int(11) NOT NULL,
  `img_file_type` varchar(50) NOT NULL,
  PRIMARY KEY (`img_lib`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `img_lib`
--


-- --------------------------------------------------------

--
-- Table structure for table `side_panel`
--

CREATE TABLE IF NOT EXISTS `side_panel` (
  `side_panel_id` int(11) NOT NULL AUTO_INCREMENT,
  `side_panel_type` varchar(60) NOT NULL,
  `side_panel_title` varchar(150) NOT NULL,
  `side_panel_status` int(11) NOT NULL,
  `side_panel_config` varchar(255) NOT NULL,
  `side_panel_order` int(11) NOT NULL,
  `side_panel_position` int(11) NOT NULL,
  PRIMARY KEY (`side_panel_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `side_panel`
--

INSERT INTO `side_panel` (`side_panel_id`, `side_panel_type`, `side_panel_title`, `side_panel_status`, `side_panel_config`, `side_panel_order`, `side_panel_position`) VALUES
(1, 'pages', 'Page List', 0, '', 1, 0),
(2, 'last_comment', 'Last Comment', 0, '', 2, 0),
(3, 'post_by_category', 'Tarichi Update', 1, '1', 1, 0),
(4, 'tag_cloud', 'Tags', 1, '', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `site_config`
--

CREATE TABLE IF NOT EXISTS `site_config` (
  `site_name` varchar(150) NOT NULL,
  `site_slogan` varchar(255) NOT NULL,
  `site_date_format` varchar(200) NOT NULL,
  `site_skin` varchar(60) NOT NULL,
  `site_status` int(11) NOT NULL,
  `site_home_page_type` int(11) NOT NULL,
  `site_per_page_post` int(11) NOT NULL,
  `site_comment_moderation` int(11) NOT NULL,
  `site_main_email` varchar(120) NOT NULL,
  `site_default_keywords` text NOT NULL,
  `site_default_description` text NOT NULL,
  `site_split_post` int(11) NOT NULL,
  `site_language` varchar(35) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_config`
--

INSERT INTO `site_config` (`site_name`, `site_slogan`, `site_date_format`, `site_skin`, `site_status`, `site_home_page_type`, `site_per_page_post`, `site_comment_moderation`, `site_main_email`, `site_default_keywords`, `site_default_description`, `site_split_post`, `site_language`) VALUES
('Tarichi 2', 'Sebuah Web Publishing System', '%d/%m/%Y %h:%i:%s', 'default', 1, 1, 5, 1, 'yourmail@domain.com', 'tarichi, web publishing system, cms', 'Ini situs cuma contoh', 100, 'english');

-- --------------------------------------------------------

--
-- Table structure for table `static_home_page`
--

CREATE TABLE IF NOT EXISTS `static_home_page` (
  `static_home_page_title` text NOT NULL,
  `static_home_page_content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `static_home_page`
--

INSERT INTO `static_home_page` (`static_home_page_title`, `static_home_page_content`) VALUES
('Selamat datang di Tarichi', '<p>Ini adalah halaman utama Tarichi dalam bentuk Statis</p>');

-- --------------------------------------------------------

--
-- Table structure for table `the_page`
--

CREATE TABLE IF NOT EXISTS `the_page` (
  `the_page_id` int(11) NOT NULL AUTO_INCREMENT,
  `the_page_title` varchar(250) NOT NULL,
  `the_page_title_url` varchar(250) NOT NULL,
  `the_page_menu` varchar(60) NOT NULL,
  `the_page_content` text NOT NULL,
  `the_page_last_edit` int(11) NOT NULL,
  `the_page_type_id` int(11) NOT NULL,
  `the_page_link_to` varchar(150) NOT NULL,
  `the_page_parent` int(11) NOT NULL,
  `the_page_enabled` int(11) NOT NULL,
  `the_page_order` int(11) NOT NULL,
  PRIMARY KEY (`the_page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `the_page`
--

INSERT INTO `the_page` (`the_page_id`, `the_page_title`, `the_page_title_url`, `the_page_menu`, `the_page_content`, `the_page_last_edit`, `the_page_type_id`, `the_page_link_to`, `the_page_parent`, `the_page_enabled`, `the_page_order`) VALUES
(1, 'About Tarichi', 'about-tarichi', 'About Tarichi', '<p>Tarichi is a Web Publisihing System or WPS, that can help you to build site become fun, easy and fast. Based on&nbsp;<a title="CodeIgniter" href="http://www.codeigniter.com/" target="_blank">CodeIgniter</a>&nbsp;framework, the best and well documented lightweight framework, Tarichi can be easily developed by everyone who understood that framework.</p>\r\n\n<p>Tarichi is free of charge, free to distribute, and free to modify using GNU-GPL3 license.</p>\r\n\n<p>What kind of site can be builded by Tarichi ?</p>\r\n\n<ul>\r\n\n<li>Personal site, such as blogs.</li>\r\n\n<li>Company Profile site.</li>\r\n\n<li>Portal Site.</li>\r\n\n<li>Product Promotion site.</li>\r\n\n<li>And many more.</li>\r\n\n</ul>', 1300093369, 1, 'the_page/about-tarichi', 3, 1, 1),
(2, 'Why Tarichi', 'why-tarichi', 'Why Tarichi ?', '<p>You have to build your site using Tarichi if :</p>\r\n\n<ul>\r\n\n<li>You are tired with complex CMS and need the simple way to build, manage, and publish your site.</li>\r\n\n<li>You need to use the web as your publishing system.</li>\r\n\n<li>You don''t want to code the site from zero.</li>\r\n\n<li>You need the clean Templating System.</li>\r\n\n<li>You are not a web developer and have to build a website in days.</li>\r\n\n<li>You are the CodeIgniter coder.</li>\r\n\n</ul>', 1300093330, 1, 'the_page/why-tarichi', 3, 1, 1),
(3, '', '', 'Tarichi In Brief', '', 1300093319, 4, '#', 0, 1, 1),
(4, '', '', 'Tarichi Blog', '', 1300093402, 2, 'category/blog', 0, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `the_page_type`
--

CREATE TABLE IF NOT EXISTS `the_page_type` (
  `the_page_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `the_page_type_name` varchar(40) NOT NULL,
  PRIMARY KEY (`the_page_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `the_page_type`
--

INSERT INTO `the_page_type` (`the_page_type_id`, `the_page_type_name`) VALUES
(1, 'normal_page'),
(2, 'per_category'),
(3, 'contact'),
(4, 'static_link'),
(5, 'gallery');

-- --------------------------------------------------------

--
-- Table structure for table `the_post`
--

CREATE TABLE IF NOT EXISTS `the_post` (
  `the_post_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `the_post_title` varchar(255) NOT NULL,
  `the_post_title_url` varchar(255) NOT NULL,
  `the_post_content` text NOT NULL,
  `the_post_date` int(11) NOT NULL,
  `the_post_day` int(11) NOT NULL,
  `the_post_month` int(11) NOT NULL,
  `the_post_year` int(11) NOT NULL,
  `the_post_total_comment` int(11) NOT NULL,
  `the_post_total_view` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `the_post_comment` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`the_post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `the_post`
--

INSERT INTO `the_post` (`the_post_id`, `category_id`, `the_post_title`, `the_post_title_url`, `the_post_content`, `the_post_date`, `the_post_day`, `the_post_month`, `the_post_year`, `the_post_total_comment`, `the_post_total_view`, `user_id`, `the_post_comment`) VALUES
(1, 1, 'First Post', 'first-post', '<p>Hi, this is the first post of Tarichi Web Publishing System.</p>\r\n\n<p>Tarichi is a Web Publisihing System or WPS, that can help you to build site become fun, easy and fast. Based on<a title="CodeIgniter" href="http://www.codeigniter.com/" target="_blank">CodeIgniter</a>&nbsp;framework, the best and well documented lightweight framework, Tarichi can be easily developed by everyone who understood that framework.</p>\r\n\n<p>Tarichi is free of charge, free to distribute, and free to modify using GNU-GPL3 license.</p>', 1300093497, 14, 3, 2011, 1, 0, 1, 0),
(2, 1, 'Second Post With Image', 'second-post-with-image', '<p><img src="/goblogan_baru/image_library/wallbb2.jpg" alt="" /></p>\r\n\n<p>This is second post with image inside it</p>', 1300093716, 14, 3, 2011, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `the_tag`
--

CREATE TABLE IF NOT EXISTS `the_tag` (
  `the_tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `the_tag_name` varchar(30) NOT NULL,
  `the_tag_name_url` varchar(60) NOT NULL,
  PRIMARY KEY (`the_tag_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `the_tag`
--

INSERT INTO `the_tag` (`the_tag_id`, `the_tag_name`, `the_tag_name_url`) VALUES
(1, '', ''),
(2, 'Post', 'Post'),
(3, 'Tarichi', 'Tarichi'),
(4, 'Sample', 'Sample'),
(5, 'CodeIgniter', 'CodeIgniter');

-- --------------------------------------------------------

--
-- Table structure for table `the_tag_connector`
--

CREATE TABLE IF NOT EXISTS `the_tag_connector` (
  `the_tag_connector_id` int(11) NOT NULL AUTO_INCREMENT,
  `the_tag_name` varchar(30) NOT NULL,
  `the_post_id` int(11) NOT NULL,
  PRIMARY KEY (`the_tag_connector_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `the_tag_connector`
--

INSERT INTO `the_tag_connector` (`the_tag_connector_id`, `the_tag_name`, `the_post_id`) VALUES
(1, '', 1),
(2, 'Post', 2),
(3, 'Tarichi', 2),
(4, 'Sample', 2),
(5, 'Post', 1),
(6, 'sample', 1),
(7, 'Tarichi', 1),
(8, 'CodeIgniter', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL,
  `last_login` int(11) NOT NULL,
  `nama_lengkap` varchar(60) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `last_login`, `nama_lengkap`) VALUES
(1, 'admin', '87d1d39d6eed22e4d9ae467e25c91b3f', 0, 'Hendriansah');
