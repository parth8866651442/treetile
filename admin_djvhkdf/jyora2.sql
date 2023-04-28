-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2021 at 02:38 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jyora2`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesslog`
--

CREATE TABLE `accesslog` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login` datetime NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `access` datetime NOT NULL,
  `access_url` varchar(255) NOT NULL,
  `logout` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `addanalytics`
--

CREATE TABLE `addanalytics` (
  `id` int(11) NOT NULL,
  `footerScript` longtext NOT NULL,
  `viewId` int(22) NOT NULL,
  `gsServiceAccount` varchar(256) NOT NULL,
  `fileNameOfP12` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `homelogo` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `type` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `homelogo`, `icon`, `favicon`, `type`, `date`) VALUES
(1, 'dfghjkl', 'eHZ5dXN4OCg=', 'antiquetouch921@gmail.com', '../img/logo.png', '../img/fav.png', '../img/fav.png', 'master-admin', '2021-06-18 10:56:23'),
(2, 'jyorauser', 'eHZ5dXN4OCg=', '', '', '', '', 'admin', '2021-06-18 10:44:58');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `app_img` text NOT NULL,
  `status` int(11) NOT NULL,
  `sequence_order` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_inquiry`
--

CREATE TABLE `blog_inquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `sms_status` varchar(100) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `career_inquiry`
--

CREATE TABLE `career_inquiry` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'Career Inquiry',
  `c_name` varchar(255) NOT NULL,
  `c_email` varchar(100) NOT NULL,
  `c_phone` varchar(20) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `c_address` text NOT NULL,
  `cv_file` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `ip` text NOT NULL,
  `sms_status` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `catagory_image`
--

CREATE TABLE `catagory_image` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `thumb` text NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catagory_image`
--

INSERT INTO `catagory_image` (`id`, `type`, `image`, `thumb`, `order`) VALUES
(7, '1', 'o_1ejml2r4o1gaf1vbd8041hkq2rfb.jpg', 'o_1ejml2r4o1gaf1vbd8041hkq2rfb.jpg', 0),
(8, '1', 'o_1ejml2r4o1k5p1phk16ur135p1s2kc.jpg', 'o_1ejml2r4o1k5p1phk16ur135p1s2kc.jpg', 0),
(9, '3', 'o_1ejml4i3883l19n11j7b1v7ap2va.jpg', 'o_1ejml4i3883l19n11j7b1v7ap2va.jpg', 0),
(10, '2', 'o_1ejml5ejmu87t1tf3m1hdk1gira.jpg', 'o_1ejml5ejmu87t1tf3m1hdk1gira.jpg', 0),
(11, '4', 'o_1ejml64171hn01fcmb96fnoi0a.jpg', 'o_1ejml64171hn01fcmb96fnoi0a.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `catalogue`
--

CREATE TABLE `catalogue` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `size` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL,
  `pdf` varchar(200) NOT NULL,
  `counter` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(222) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `icon`, `status`, `time`, `order`) VALUES
(1, 'Living Room', '', 1, '2020-10-03 06:19:29', 0),
(2, 'Outdoor', '', 1, '2020-10-03 06:19:29', 0),
(3, 'Kitchen', '', 1, '2020-10-03 06:19:29', 0),
(4, 'Bathroom', '', 1, '2020-10-03 06:19:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE `certificate` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `pdf` text NOT NULL,
  `counter` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `certificate`
--

INSERT INTO `certificate` (`id`, `name`, `image`, `pdf`, `counter`, `status`, `date`, `order`) VALUES
(1, '', 'KcFb1S.jpg', '', 0, 1, '2020-10-03 08:47:35', 0),
(2, '', 'fcazcF.jpg', '', 0, 1, '2020-10-03 08:47:43', 0),
(4, '', 'lnWcNb.jpg', '', 0, 1, '2020-10-03 08:48:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `hexacode` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `map` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `type`, `address`, `mobile`, `email`, `date`, `map`) VALUES
(1, 'Domestic', '<p>Survey No.149 1/2,<br />\r\nopp. Sartanpar Village,<br />\r\nSartanpar Road,<br />\r\nVankaner - 363622,<br />\r\nDist- Morbi (Gujarat), India.</p>\r\n', '+91 97277 70233', 'info@ramos.in', '2020-10-14 08:15:04', 'ITFtMTghMW0xMiExbTMhMWQzNjc5LjA1MzY3OTM4MDMwMDghMmQ3MC45NTIxMzg5MTQ5NjMwNyEzZDIyLjc2MzM4OTA4NTA4NDkzNSEybTMhMWYwITJmMCEzZjAhM20yITFpMTAyNCEyaTc2OCE0ZjEzLjEhM20zITFtMiExczB4Mzk1OTkxODcyNTc2NWMwNyUzQTB4Nzg5MjY5ZjZkODYxZmJmNyEyc1JhbW9zJTIwQ2VyYW1pYyUyMFB2dC4lMjBMdGQuITVlMCEzbTIhMXNlbiEyc2luITR2MTYwMTM3NjkxMDE4NCE1bTIhMXNlbiEyc2lu'),
(2, 'International', '<p>Survey No.149 1/2,<br />\r\nopp. Sartanpar Village,<br />\r\nSartanpar Road,<br />\r\nVankaner - 363622,<br />\r\nDist- Morbi (Gujarat), India.</p>\r\n', '+91 95860 77777', 'export@ramos.in', '2020-10-14 08:15:11', '');

-- --------------------------------------------------------

--
-- Table structure for table `contact_inquiry`
--

CREATE TABLE `contact_inquiry` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'contact',
  `c_name` varchar(200) NOT NULL,
  `c_email` varchar(200) NOT NULL,
  `company` varchar(255) NOT NULL,
  `department` varchar(100) NOT NULL,
  `city` varchar(255) NOT NULL,
  `c_phone` varchar(200) NOT NULL,
  `c_message` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notification` varchar(10) NOT NULL DEFAULT '0' COMMENT '0=new notification and 1=old ',
  `status` int(11) NOT NULL DEFAULT '1',
  `sms_status` varchar(222) NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_inquiry`
--

INSERT INTO `contact_inquiry` (`id`, `type`, `c_name`, `c_email`, `company`, `department`, `city`, `c_phone`, `c_message`, `time`, `notification`, `status`, `sms_status`, `ip`) VALUES
(1, 'contact', 'Divyesh Gami', 'gamidivyesh567@gmail.com', '', '', '', '07874220852', 'tesst', '2021-06-19 10:41:13', '0', 1, 'sms inactive', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `design_image`
--

CREATE TABLE `design_image` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `design_image`
--

INSERT INTO `design_image` (`id`, `name`, `image`, `product_id`, `date`) VALUES
(1, 'ACCIAO BRUNITO_1', 'o_1eli99n1us2f1j5e1vhfc8a3c3b.jpg', 588, '2020-10-26 11:04:48'),
(2, 'ACCIAO BRUNITO_3', 'o_1eli99n1u1tefhmpuhvljg10fgc.jpg', 588, '2020-10-26 11:04:48'),
(3, 'ALLUMINIO_2', 'o_1elk8g8jalgv1u8ski1j0u1cgeb.jpg', 596, '2020-10-27 05:29:18'),
(4, 'ALLUMINIO_3', 'o_1elk8g8ja1rjd15gako51ekfc1rc.jpg', 596, '2020-10-27 05:29:18'),
(5, 'ASTER_2', 'o_1elk8i0llifgic11ttc1sqn1q0ib.jpg', 598, '2020-10-27 05:30:15'),
(6, 'ASTER_3', 'o_1elk8i0ll6ev13t61gnsdul6tuc.jpg', 598, '2020-10-27 05:30:15'),
(7, 'CALACATTA_2', 'o_1elk8lvfb1jvpqrbicorh1np9c.jpg', 599, '2020-10-27 05:32:34'),
(8, 'CALACATTA_3', 'o_1elk8lvfb1lcqmc3179l4c6eqgd.jpg', 599, '2020-10-27 05:32:34'),
(9, 'CALACATTA_4', 'o_1elk8lvfb1n4e1mc010aq1q3819jke.jpg', 599, '2020-10-27 05:32:34'),
(10, 'CALACATTA-ORO_2', 'o_1elk8oh2q1upvisu1dtll8631dc.jpg', 600, '2020-10-27 05:33:49'),
(11, 'CALACATTA-ORO_3', 'o_1elk8oh2q1ld71g8g167u12bc1lgqd.jpg', 600, '2020-10-27 05:33:49'),
(12, 'CALACATTA-ORO_4', 'o_1elk8oh2qoe81jee1l5u18vk14n5e.jpg', 600, '2020-10-27 05:33:49'),
(13, 'Concreate_Grey_2', 'o_1elk8scoj1sphu9bdt1m061uf5b.jpg', 601, '2020-10-27 05:36:21'),
(14, 'Concreate_Grey_3', 'o_1elk8scojckc1e5g6pbbmue2bc.jpg', 601, '2020-10-27 05:36:21'),
(15, 'ACCIAO BRUNITO_3', 'o_1elk92qe21lsl1gbl1h4u12os16jlb.jpg', 602, '2020-10-27 05:39:26'),
(16, 'ACCIAO BRUNITO_1', 'o_1elk92qe21nu91g4s1uve1v5617u9c.jpg', 602, '2020-10-27 05:39:26'),
(17, 'NERO MARQUINIA_2', 'o_1elk96o091ujkfvt160c1j2313q7b.jpg', 609, '2020-10-27 05:44:38'),
(18, 'NERO MARQUINIA_3', 'o_1elk96o093hc2281bicakab16c.jpg', 609, '2020-10-27 05:44:38'),
(19, 'OCEAN BLACK_3', 'o_1elk9bd4214eu1vci1uh51i0t1cbqb.jpg', 610, '2020-10-27 05:58:07'),
(20, 'OCEAN BLACK_2', 'o_1elk9bd43110e1ev911rco6lp0ac.jpg', 610, '2020-10-27 05:58:07'),
(21, 'Concreate_Light_2', 'o_1elka68tah496t01o4trpu1q2mb.jpg', 603, '2020-10-27 05:58:49'),
(22, 'Concreate_Light_3', 'o_1elka68ta5gq37b1r5kc7d1tokc.jpg', 603, '2020-10-27 05:58:49'),
(23, 'Elegant Grey_2', 'o_1elkabcuok6d50cb9t1au4ftqb.jpg', 604, '2020-10-27 06:01:48'),
(24, 'Elegant Grey_3', 'o_1elkabcuo1qlf1o5s1cil1km217bac.jpg', 604, '2020-10-27 06:01:48'),
(25, 'INVISIBLE_2', 'o_1elkacqg81gsbdng1dne7eht10b.jpg', 605, '2020-10-27 06:02:25'),
(26, 'INVISIBLE_3', 'o_1elkacqg914891odoi1v9v1k9pc.jpg', 605, '2020-10-27 06:02:25'),
(27, 'LIGHT CEMENT_2', 'o_1elkag3611d6u1o2c1guoe5aqdmb.jpg', 606, '2020-10-27 06:04:21'),
(28, 'LIGHT CEMENT_3', 'o_1elkag361rh21dg4lqb7qi197cc.jpg', 606, '2020-10-27 06:04:21'),
(29, 'OSSIDO-GREY_3', 'o_1elkan7cljis1k96pah1qg01r43a.jpg', 612, '2020-10-27 06:08:19'),
(30, 'OSSIDO_2', 'o_1elkb3hs81hu81d3918tq1foa9sfb.jpg', 613, '2020-10-27 06:16:12'),
(31, 'OSSIDO_3', 'o_1elkb3hs810vp12ji1djs149q1thqc.jpg', 613, '2020-10-27 06:16:12'),
(32, 'OSSIDO-BRUNITO_3', 'o_1elkbhskmrsv18lt129blfvvq1b.jpg', 614, '2020-10-27 06:22:41'),
(33, 'OSSIDO-BRUNITO_2', 'o_1elkbhskml1jtn8e0i11fe4dec.jpg', 614, '2020-10-27 06:22:41'),
(34, 'Taj-Mahal_3', 'o_1elkcus2qnr81r951ffs1ojp16pnb.jpg', 615, '2020-10-27 06:47:16'),
(35, 'Taj-Mahal_2', 'o_1elkcus2qj3qjqa8q3udm14l5c.jpg', 615, '2020-10-27 06:47:16'),
(36, 'OTTONE_2', 'o_1elkd37bs1b8b1e11qjkacc3fqb.jpg', 616, '2020-10-27 06:49:36'),
(37, 'OTTONE_3', 'o_1elkd37bsokd1fgh14ue1htc1m5cc.jpg', 616, '2020-10-27 06:49:36'),
(38, 'SHARA NOIR_2', 'o_1elkd64u6hvu1ga7q171s82qcpb.jpg', 617, '2020-10-27 06:51:09'),
(39, 'SHARA NOIR_3', 'o_1elkd64u6pi013f11na81ejr1uvc.jpg', 617, '2020-10-27 06:51:09'),
(40, 'STATUARIETTO_2', 'o_1elkd8mug7vos81mm8199r13rmb.jpg', 618, '2020-10-27 06:53:16'),
(41, 'STATUARIETTO_3', 'o_1elkd8mug1sm41t051sbo11ca170mc.jpg', 618, '2020-10-27 06:53:16'),
(42, 'STATUARIO_2', 'o_1elkda1uh154jrpspbmshu1repb.jpg', 619, '2020-10-27 06:53:36'),
(43, 'STATUARIO_3', 'o_1elkda1uhq5a4pv1ljtqsr2hmc.jpg', 619, '2020-10-27 06:53:36'),
(44, 'TRAVERTINO ROMANO_2', 'o_1elkdnhj012vt10ecnqspqq16d0b.jpg', 620, '2020-10-27 07:03:40'),
(45, 'TRAVERTINO ROMANO_3', 'o_1elkdnhj0s9tmjp11i1ukv69rc.jpg', 620, '2020-10-27 07:03:40'),
(46, 'VANILLA_2', 'o_1elkdt0t11q4ntme1vhd1m6g6dnb.jpg', 621, '2020-10-27 07:05:20'),
(47, 'VANILLA_3', 'o_1elkdt0t118j6lsq1tqcagq1p3tc.jpg', 621, '2020-10-27 07:05:20'),
(48, 'Bianco Stone f2', 'o_1ell0ebdqutgke51t83vs31edic.jpg', 694, '2020-10-27 12:28:37'),
(49, 'Bianco Stone f3', 'o_1ell0ebdqei579db8lb99spod.jpg', 694, '2020-10-27 12:28:37'),
(50, 'Bianco Stone-4', 'o_1ell0ebdq1pj6lbq11la1miu1dpve.jpg', 694, '2020-10-27 12:28:37'),
(51, 'COSTA BEIGE F2', 'o_1ell0i1l5l111m1fk1514tjttsb.jpg', 695, '2020-10-27 12:29:41'),
(52, 'COSTA BEIGE F3', 'o_1ell0i1l51j8jaru1sv62ir7k8c.jpg', 695, '2020-10-27 12:29:41'),
(53, 'Crown 2', 'o_1ell0kqs11jng19ncgi9th11g25d.jpg', 696, '2020-10-27 12:31:18'),
(54, 'Crown 3', 'o_1ell0kqs114ejerk1j2o1c79356e.jpg', 696, '2020-10-27 12:31:18'),
(55, 'Crown 4', 'o_1ell0kqs116481ekg2kb1idq1fjf.jpg', 696, '2020-10-27 12:31:18'),
(56, 'Crown 5', 'o_1ell0kqs1tj41o4i1u95snk1285g.jpg', 696, '2020-10-27 12:31:18'),
(57, 'Dove Onyx 2', 'o_1ell0lumo1trvpd111r51sg01370b.jpg', 697, '2020-10-27 12:31:49'),
(58, 'Dove Onyx 3', 'o_1ell0lumo1ve0d9417qj170guktc.jpg', 697, '2020-10-27 12:31:49'),
(59, 'FOG GREY F2', 'o_1ell0n680vjubgu1qdh1qjp1tacc.jpg', 698, '2020-10-27 12:32:47'),
(60, 'FOG GREY F3', 'o_1ell0n680kt4mih10i815rk3r6d.jpg', 698, '2020-10-27 12:32:47'),
(61, 'FOG GREY F4', 'o_1ell0n680eeb13c91rmb1jnlj55e.jpg', 698, '2020-10-27 12:32:47'),
(62, 'Fog Light Gray 2', 'o_1ell0od371bqs1jluedlg2vfegc.jpg', 699, '2020-10-27 12:35:04'),
(63, 'Fog Light Gray 3', 'o_1ell0od371tshof4vvc1tr4msld.jpg', 699, '2020-10-27 12:35:04'),
(64, 'Fog Light Gray 4', 'o_1ell0od37aqt18841rrq1lcrnite.jpg', 699, '2020-10-27 12:35:04'),
(65, 'Italy Beige-2', 'o_1ell0t9cj10maj58l7qi3818fld.jpg', 700, '2020-10-27 12:35:51'),
(66, 'Italy Beige-3', 'o_1ell0t9cjdc7kca1orq1cou1aj4e.jpg', 700, '2020-10-27 12:35:51'),
(67, 'Italy Beige-4', 'o_1ell0t9cj1s9f1lsl1vad67k1jurf.jpg', 700, '2020-10-27 12:35:51'),
(68, 'Italy Beige-5', 'o_1ell0t9cj1hd51kri1e52ndp1o6jg.jpg', 700, '2020-10-27 12:35:51'),
(69, 'MARBILANO BROWN_New_DI F2', 'o_1ell0uvhv174km271gdd1aqh109gb.jpg', 701, '2020-10-27 12:37:13'),
(70, 'MARBILANO BROWN_New_DI F3', 'o_1ell0uvhv1l323qscnq1he518mpc.jpg', 701, '2020-10-27 12:37:13'),
(71, 'MOSAICO GREY F2', 'o_1ell114cv1dts15m1pjc1v5217fsb.jpg', 702, '2020-10-27 12:38:20'),
(72, 'MOSAICO GREY F3', 'o_1ell114cv1jvkt7cv5fa2gkupc.jpg', 702, '2020-10-27 12:38:20'),
(73, 'Pisa Gris Part-2', 'o_1ell12gvrjmmcrsgo1clp9gcd.jpg', 703, '2020-10-27 12:38:53'),
(74, 'Pisa Gris Part-3', 'o_1ell12gvrrd2188fph2tau14cqe.jpg', 703, '2020-10-27 12:38:53'),
(75, 'Pisa Gris Part-4', 'o_1ell12gvr1ivu1339csnt671p7hf.jpg', 703, '2020-10-27 12:38:53'),
(76, 'Pisa Gris Part-5', 'o_1ell12gvrt901hj21c621m7otjsg.jpg', 703, '2020-10-27 12:38:53'),
(77, 'SAINA GRIS 2', 'o_1ell13qi4m3717g41qvalmpk8cc.jpg', 704, '2020-10-27 12:39:28'),
(78, 'SAINA GRIS 3', 'o_1ell13qi41grd5mbhjt1blvcjad.jpg', 704, '2020-10-27 12:39:28'),
(79, 'SAINA GRIS 4', 'o_1ell13qi4m3g19tej2du10c90e.jpg', 704, '2020-10-27 12:39:28'),
(80, 'SEA STONE BIANCO 4', 'o_1ell17rdi1bajm4t1r4u1r5r10jac.jpg', 705, '2020-10-27 12:41:59'),
(81, 'SEA STONE BIANCO 5', 'o_1ell17rdib001mse1i2pc9rjdid.jpg', 705, '2020-10-27 12:41:59'),
(82, 'SEA STONE BIANCO 6', 'o_1ell17rdi1tk3jb51vuaae7us5e.jpg', 705, '2020-10-27 12:41:59'),
(83, 'Travertino Silver-2 ', 'o_1ell1buvg190i5v31msc153tlcnd.jpg', 690, '2020-10-27 12:43:52'),
(84, 'Travertino Silver-3 ', 'o_1ell1buvg686qed19nc1c5vei7e.jpg', 690, '2020-10-27 12:43:52'),
(85, 'Travertino Silver-4 ', 'o_1ell1buvgl08gs43k61lamrhvf.jpg', 690, '2020-10-27 12:43:52'),
(86, 'Travertino Silver-5_master ', 'o_1ell1buvg17r01bll2mv1gr97btg.jpg', 690, '2020-10-27 12:43:52'),
(87, 'WONDER STATURIO2', 'o_1ell1dkjk5lo1cl9ngo11r3tufc.jpg', 691, '2020-10-27 12:44:46'),
(88, 'WONDER STATURIO3', 'o_1ell1dkjkd0n1u31bv527e1j4pd.jpg', 691, '2020-10-27 12:44:46'),
(89, 'WONDER STATURIO4', 'o_1ell1dkjkmti1hungn8144fgafe.jpg', 691, '2020-10-27 12:44:46'),
(90, 'ZEBRANO BEIGE-3', 'o_1ell1i64f1dk07f512251nd8nshb.jpg', 692, '2020-10-27 12:47:16'),
(91, 'ZEBRANO BEIGE-2', 'o_1ell1i64fjk2dsfci51kn11c26c.jpg', 692, '2020-10-27 12:47:16'),
(92, 'zebrano grey f2', 'o_1ell1jan3jrc2rrkt01ksp46nb.jpg', 693, '2020-10-27 12:48:01'),
(93, 'zebrano grey f3', 'o_1ell1jan31a0etci94p1ple1g53c.jpg', 693, '2020-10-27 12:48:01'),
(94, 'Concrete  Beige_F2', 'o_1ell1m9dovaf1tjlivm1uedfbhb.jpg', 708, '2020-10-27 12:49:29'),
(95, 'Concrete  Beige_F3', 'o_1ell1m9do116t14v4tna1dui7sec.jpg', 708, '2020-10-27 12:49:29'),
(96, 'Concrete Gray f2', 'o_1ell1pshkapee581eae143rgl8c.jpg', 709, '2020-10-27 12:51:29'),
(97, 'Concrete Gray f3', 'o_1ell1pshkrr3dna1fpt1f9519a5d.jpg', 709, '2020-10-27 12:51:29'),
(98, 'Concrete Gray f4', 'o_1ell1pshkisahh1qoe130vo2te.jpg', 709, '2020-10-27 12:51:29'),
(99, 'Monza Crema  F1', 'o_1ell1u7e917ek1ob91jim1nrb19ooc.jpg', 706, '2020-10-27 12:53:52'),
(100, 'Monza Crema  F2', 'o_1ell1u7e9197h17dpvb248u1mlsd.jpg', 706, '2020-10-27 12:53:52'),
(101, 'Monza Crema  F4', 'o_1ell1u7e91hbkl5o6e160tai6e.jpg', 706, '2020-10-27 12:53:52'),
(102, 'Monza Grey-2', 'o_1ell22hmp8qf1ac9erc1sgp1vptc.jpg', 707, '2020-10-27 12:56:17'),
(103, 'Monza Grey-3', 'o_1ell22hmp1jf614m6q8b1toepcid.jpg', 707, '2020-10-27 12:56:17'),
(104, 'Monza Grey-4', 'o_1ell22hmp5g71rvbkhv11aoojge.jpg', 707, '2020-10-27 12:56:17');

-- --------------------------------------------------------

--
-- Table structure for table `design_preview`
--

CREATE TABLE `design_preview` (
  `id` int(11) NOT NULL,
  `preview_name` text NOT NULL,
  `preview_image` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `export_flag`
--

CREATE TABLE `export_flag` (
  `id` int(22) NOT NULL,
  `flagName` varchar(256) NOT NULL,
  `flagImage` varchar(256) NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT '1',
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `gstno` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `subject` varchar(222) NOT NULL,
  `message` text NOT NULL,
  `details` text NOT NULL,
  `ip` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notification` varchar(10) NOT NULL DEFAULT '0' COMMENT '0=new notification and 1=old ',
  `status` int(11) NOT NULL DEFAULT '1',
  `sms_status` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `frontendmenu`
--

CREATE TABLE `frontendmenu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subname` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `type` varchar(222) NOT NULL,
  `menu` varchar(110) NOT NULL,
  `size` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `thumb` varchar(222) NOT NULL,
  `order` int(11) NOT NULL,
  `gtype` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `type`, `menu`, `size`, `image`, `thumb`, `order`, `gtype`, `description`, `url`) VALUES
(9, 'infrastructure', '', 0, 'uploads/infrastructure/o_1ejmputm210bj4drj6jc76idoh.jpg', 'uploads/infrastructure/thumbnails/o_1ejmputm210bj4drj6jc76idoh.jpg', 0, '', '', ''),
(10, 'infrastructure', '', 0, 'uploads/infrastructure/o_1ejmputm2192u437g9vm9aoosi.jpg', 'uploads/infrastructure/thumbnails/o_1ejmputm2192u437g9vm9aoosi.jpg', 0, '', '', ''),
(11, 'infrastructure', '', 0, 'uploads/infrastructure/o_1ejmputm2edp1htfs9e1v5l1h41j.jpg', 'uploads/infrastructure/thumbnails/o_1ejmputm2edp1htfs9e1v5l1h41j.jpg', 0, '', '', ''),
(12, 'infrastructure', '', 0, 'uploads/infrastructure/o_1ejmputm21u1015c6ohabetecik.jpg', 'uploads/infrastructure/thumbnails/o_1ejmputm21u1015c6ohabetecik.jpg', 0, '', '', ''),
(13, 'infrastructure', '', 0, 'uploads/infrastructure/o_1ejmputm21ohnn4lp3cjv3fvdl.jpg', 'uploads/infrastructure/thumbnails/o_1ejmputm21ohnn4lp3cjv3fvdl.jpg', 0, '', '', ''),
(14, 'infrastructure', '', 0, 'uploads/infrastructure/o_1ejmputm24v51urd16q4kch1n23m.jpg', 'uploads/infrastructure/thumbnails/o_1ejmputm24v51urd16q4kch1n23m.jpg', 0, '', '', ''),
(15, 'infrastructure', '', 0, 'uploads/infrastructure/o_1ejmputm219fj17381a4g6pl1veon.jpg', 'uploads/infrastructure/thumbnails/o_1ejmputm219fj17381a4g6pl1veon.jpg', 0, '', '', ''),
(22, 'slider', '', 0, 'uploads/slider/Py7BGk.jpg', 'uploads/slider/thumbnails/o_1ejn4iao71kgd1i8s8da1vfejf7a.jpg', 0, '', 'Beautiful <br> and durable <br> Slab', ''),
(24, 'slider', '', 0, 'uploads/slider/tZGeBs.jpg', 'uploads/slider/thumbnails/o_1ejn4mcc9d1nhl7bsirce1lbna.jpg', 3, '', 'Designed to<br> complement <br> outdoor', ''),
(25, 'slider', '', 0, 'uploads/slider/o_1ejn4non892ih1t8t4qa1q2qa.jpg', 'uploads/slider/thumbnails/o_1ejn4non892ih1t8t4qa1q2qa.jpg', 2, '', 'Every Floor <br>Covers <br>by tiles', ''),
(26, 'slider', '', 0, 'uploads/slider/v7vxSE.jpg', 'uploads/slider/thumbnails/o_1ekecogdip881jpv1nuosvpkq7a.jpg', 4, '', '<p>Designer <br> Sanitaryware</p>\n', ''),
(28, 'slider', '', 0, 'uploads/slider/o_1eli5fb2b1gga19cko3n76a5ja.jpg', 'uploads/slider/thumbnails/o_1eli5fb2b1gga19cko3n76a5ja.jpg', 0, '', '<p>CERAMIC<br />\r\nCOVERS FOR<br />\r\nEVERY WALL</p>\r\n', '');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(22) NOT NULL,
  `name` varchar(222) NOT NULL,
  `news_id` int(22) NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` int(22) NOT NULL DEFAULT '1',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inspiration`
--

CREATE TABLE `inspiration` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `sequence_order` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `title` text NOT NULL,
  `keyword` text NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `prologo` varchar(255) NOT NULL,
  `packing_details` text NOT NULL,
  `details` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `order`, `status`, `title`, `keyword`, `description`, `slug`, `prologo`, `packing_details`, `details`, `date`) VALUES
(1, 'Wall Tiles', 0, 1, '', '', '', 'wall-tiles', '../uploads/menu_logo/vXe2tB.png', '', '<p>Ramos Ceramic&rsquo;s wall tiles are reasonably priced, remarkably lasting, and near maintenance-free. Through splendid sizes, pigment, and designs, the 3D digital ceramic tiles initiate depth and vitality to the installed space.</p>\r\n', '2020-10-02 09:40:57'),
(6, 'Porcelain Tiles', 0, 1, '', '', '', 'porcelain-tiles', '', '', '', '2021-06-19 10:14:01'),
(7, 'Subway Tiles', 0, 1, '', '', '', 'subway-tiles', '', '', '', '2021-06-19 10:14:24');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `type` varchar(222) NOT NULL,
  `pdate` date NOT NULL,
  `title` varchar(222) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `image` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  `yturl` varchar(20000) NOT NULL,
  `order_news` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `newscatagory`
--

CREATE TABLE `newscatagory` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `series_no` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(200) NOT NULL,
  `scatch` varchar(255) NOT NULL,
  `view` varchar(222) NOT NULL,
  `details` text NOT NULL,
  `application_id` varchar(110) NOT NULL,
  `inspiration_id` varchar(255) NOT NULL,
  `color_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `size_slug` varchar(100) NOT NULL,
  `series_id` int(11) NOT NULL,
  `series_slug` varchar(255) NOT NULL,
  `visible` int(5) NOT NULL DEFAULT '1' COMMENT '0:visible for registered, 1: for all user',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order` int(22) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `view_counter` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `series_no`, `title`, `slug`, `image`, `scatch`, `view`, `details`, `application_id`, `inspiration_id`, `color_id`, `size_id`, `size_slug`, `series_id`, `series_slug`, `visible`, `time`, `order`, `status`, `view_counter`, `menu_id`) VALUES
(710, '60', 'ARIA BROWN', 'aria-brown', 'o_1f8hs3tfh192e6rl1e651dtr1escd.jpg', '', '', '', '', '', 0, 2, '', 22, 'elevation', 1, '2021-06-19 10:12:38', 0, 1, 0, 1),
(711, '61', 'APOLO GRIS', 'apolo-gris', 'o_1f8hs3tfhf3o1tg1m59tiqt0e.jpg', '', '', '', '', '', 0, 2, '', 22, 'elevation', 1, '2021-06-19 10:12:38', 0, 1, 0, 1),
(712, '61', 'APOLO OFF GREY', 'apolo-off-grey', 'o_1f8hs3tfh18c65hb1skrt7aaqrf.jpg', '', '', '', '', '', 0, 2, '', 22, 'elevation', 1, '2021-06-19 10:12:38', 0, 1, 0, 1),
(713, '60', 'ARIA BLACK', 'aria-black', 'o_1f8hs3tfhiac4t32mo1m59lmjg.jpg', '', '', '', '', '', 0, 2, '', 22, 'elevation', 1, '2021-06-19 10:12:38', 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_inquiry`
--

CREATE TABLE `product_inquiry` (
  `id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL DEFAULT 'product-inquiry',
  `c_name` varchar(200) NOT NULL,
  `c_email` varchar(200) NOT NULL,
  `c_phone` varchar(200) NOT NULL,
  `subject` varchar(222) NOT NULL,
  `c_message` text NOT NULL,
  `details` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notification` varchar(10) NOT NULL DEFAULT '0' COMMENT '0=new notification and 1=old ',
  `status` int(11) NOT NULL DEFAULT '1',
  `sms_status` varchar(222) NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_inquiry`
--

INSERT INTO `product_inquiry` (`id`, `type`, `c_name`, `c_email`, `c_phone`, `subject`, `c_message`, `details`, `time`, `notification`, `status`, `sms_status`, `ip`) VALUES
(1, 'product-inquiry', 'paras j', 'c.lightlink@gmail.com', '8238862332', '', 'test', 'Wall Tiles / 300 x 450 MM / Glossy / 1001_LT', '2020-10-02 10:15:00', '0', 1, ' {\"ErrorCode\":\"000\",\"ErrorMessage\":\"Success\",\"JobId\":\"413605030\",\"MessageData\":[{\"Number\":\"8238862332\",\"MessageId\":\"qZE5mPKFdEOU3E1bUIL7pA\",\"Message\":\"Inquiry From www.ramos.in Product:Wall Tiles / 300 x 450 MM / Glossy / ', '::1'),
(2, 'product-inquiry', 'Angl', 'a0819cn@hotmail.com', '48575168888', '', 'I Want  Digital Tiles<br />\r\nAnglCompany <br />\r\nAdress : Asfaltowa 1,26 - 110 skarzysko , poland<br />\r\nContact Name: Angl<br />\r\nphone no.:48 668 078 888', 'Wall Tiles / 300 x 450 MM / Matt / 3012_HL_1', '2021-01-04 07:15:48', '0', 1, ' {\"ErrorCode\":\"000\",\"ErrorMessage\":\"Success\",\"JobId\":\"445998425\",\"MessageData\":[{\"Number\":\"9586077777\",\"MessageId\":\"5PzFpDlspk2wblMMjeT6qw\",\"Message\":\"Inquiry From www.ramos.in Product:Wall Tiles / 300 x 450 MM / Matt / 30', '14.195.238.94'),
(3, 'product-inquiry', 'Issam Ahmed', 'issamahmed9886@gmail.com', '97444583871', '', 'I Want Tiles<br />\r\nAl Muhaidiba <br />\r\nAddress : salva road , doha<br />\r\nMobile No.: 974 7720 0142', 'Big Slab Tiles / 800 x 1600 MM / Glossy / AMAZONITE ICE', '2021-01-04 07:20:28', '0', 1, ' {\"ErrorCode\":\"000\",\"ErrorMessage\":\"Success\",\"JobId\":\"446001109\",\"MessageData\":[{\"Number\":\"9586077777\",\"MessageId\":\"NcQPl4M5DEGTAGhyqAnNBw\",\"Message\":\"Inquiry From www.ramos.in Product:Big Slab Tiles / 800 x 1600 MM / Glos', '14.195.238.94');

-- --------------------------------------------------------

--
-- Table structure for table `product_other_admin_panel`
--

CREATE TABLE `product_other_admin_panel` (
  `id` int(11) NOT NULL,
  `type` varchar(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `details` text NOT NULL,
  `features` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  `parentdir` varchar(222) NOT NULL,
  `header_image` varchar(255) NOT NULL,
  `order` int(22) NOT NULL,
  `colors` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='other admin pnel''s products';

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `id` int(11) NOT NULL,
  `size` varchar(200) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `new` int(11) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT '1',
  `series_no_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=series_no ,1=series, 2=Direct Design , 3=Design with Series & description',
  `order` int(22) NOT NULL,
  `menu_id` int(22) NOT NULL,
  `col_view` varchar(22) NOT NULL DEFAULT '3' COMMENT 'front side view col wise\\n md-sm-xs',
  `packing` text NOT NULL,
  `header_image` varchar(20000) NOT NULL,
  `packing_number` int(10) NOT NULL,
  `packing_size` varchar(20000) NOT NULL,
  `sqlmtrperbox` text NOT NULL,
  `noperbox` int(11) NOT NULL,
  `sizelogo` varchar(255) NOT NULL,
  `catalog_link` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `keyword` text NOT NULL,
  `description` text NOT NULL,
  `thickness` varchar(255) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `netweight` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`id`, `size`, `slug`, `new`, `status`, `series_no_status`, `order`, `menu_id`, `col_view`, `packing`, `header_image`, `packing_number`, `packing_size`, `sqlmtrperbox`, `noperbox`, `sizelogo`, `catalog_link`, `title`, `keyword`, `description`, `thickness`, `weight`, `netweight`, `date`) VALUES
(2, '300 x 600 MM', '300-x-600-mm', 0, '1', 0, 0, 1, '3', '', '', 0, '300 x 600', '', 0, '', '', '', '', '', '', '', '', '2020-10-24 08:41:15'),
(25, '200 x 600 mm', '200-x-600-mm', 0, '1', 0, 0, 1, '4', '', '', 0, '200 x 300', '', 6, '', '', '', '', '', '', '', '', '2021-06-19 10:08:57'),
(26, '600 x 600 mm', '600-x-600-mm', 0, '1', 1, 0, 6, '4', '', '', 0, '600 x 600', '15.5', 4, '', '', '', '', '', '', '', '', '2021-06-19 10:15:22'),
(27, '600 x 1200 mm', '600-x-1200-mm', 0, '1', 1, 0, 6, '4', '', '', 0, '600 x 1200', '15.5', 2, '', '', '', '', '', '', '', '', '2021-06-19 10:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `register_inquiry`
--

CREATE TABLE `register_inquiry` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'register',
  `c_name` varchar(222) NOT NULL,
  `c_email` varchar(222) NOT NULL,
  `c_phone` varchar(222) NOT NULL,
  `c_message` text NOT NULL,
  `ip` text NOT NULL,
  `sms_status` text NOT NULL,
  `status` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `series_name` varchar(200) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `product_size_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `design_view` int(11) NOT NULL COMMENT '1 =''Design With Series No'' and 0 =''Design With Series''',
  `order` int(22) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `header_image` varchar(2000) NOT NULL,
  `serieslogo` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `keyword` text NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`id`, `series_name`, `slug`, `product_size_id`, `menu_id`, `design_view`, `order`, `status`, `header_image`, `serieslogo`, `title`, `keyword`, `description`, `date`) VALUES
(22, 'Elevation', 'elevation', 2, 1, 1, 0, 1, '', '', '', '', '', '2021-06-19 10:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `series_no`
--

CREATE TABLE `series_no` (
  `id` int(11) NOT NULL,
  `series_no_name` varchar(200) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `size_id` int(11) NOT NULL,
  `series_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `order` int(22) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `series_no`
--

INSERT INTO `series_no` (`id`, `series_no_name`, `slug`, `size_id`, `series_id`, `status`, `order`) VALUES
(60, 'ARIA', 'aria', 2, 22, 1, 0),
(61, 'APOL', 'apol', 2, 22, 1, 0),
(62, 'Elevation', 'elevation', 2, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(22) NOT NULL,
  `type` varchar(222) NOT NULL,
  `meta` varchar(222) NOT NULL,
  `data` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `type`, `meta`, `data`) VALUES
(5, 'settings', 'company', 'Jyora Ceramic'),
(6, 'settings', 'title', 'Jyora Ceramic'),
(7, 'settings', 'web_link', 'www.jyoraceramic.com'),
(8, 'paging', 'page_limit_for_search', '8'),
(9, 'paging', 'page_limit_for_gallery', '12'),
(10, 'paging', 'page_limit_for_product_direct_design', '8'),
(11, 'paging', 'page_limit_for_product_design_series_or_series_with_description', '8'),
(12, 'paging', 'page_limit_for_product_series_with_no', '4'),
(13, 'paging', 'page_limit_for_concept', '8'),
(16, 'functionality', 'slider', '0'),
(17, 'functionality', 'product', '1'),
(18, 'functionality', 'product-view', '1'),
(19, 'functionality', 'product-register', '0'),
(20, 'functionality', 'gallery', '0'),
(21, 'functionality', 'catalogue', '1'),
(22, 'functionality', 'news-with-one-image-and-detail', '0'),
(23, 'functionality', 'news-with-multiple-image-and-detail', '0'),
(24, 'functionality', 'contact', '1'),
(25, 'functionality', 'inquiry', '1'),
(26, 'functionality', 'packing', '1'),
(27, 'functionality', 'series_no_length', '4'),
(30, 'paging', 'page_limit_for_blog', '12'),
(31, 'functionality', 'advertisement', '0'),
(32, 'paging', 'page_limit_for_advertisement', '12'),
(33, 'functionality', 'showroom', '0'),
(34, 'paging', 'page_limit_for_showroom', '12'),
(36, 'functionality', 'headerimage', '0'),
(40, 'functionality', 'metadata', '1'),
(41, 'functionality', 'analytics', '0'),
(79, 'functionality', 'lightbox', '0'),
(80, 'functionality', 'lightboxpath', ''),
(81, 'settings', 'stimeout', '10'),
(89, 'functionality', 'file', ''),
(121, 'settings', 'filelimitupload', '500'),
(131, 'packing', 'type', 'packing'),
(132, 'packing', 'packing-details', '<h6>GVT / PGVT</h6>\r\n\r\n<table class=\" table table-bordered table-hover\">\r\n	<thead>\r\n		<tr>\r\n			<th>Sr. No</th>\r\n			<th>SIZE</th>\r\n			<th>PLT. TYPE EURO/REGULAR</th>\r\n			<th>THICKNESS</th>\r\n			<th>PCS/BOX</th>\r\n			<th>SQM/BOX</th>\r\n			<th>WEIGHT PER/BOX</th>\r\n			<th>BOX/PLT</th>\r\n			<th>PLT/CONT.</th>\r\n			<th>TOTAL BOX PER CONT.</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>1</td>\r\n			<td>600x600 MM</td>\r\n			<td>REGULAR</td>\r\n			<td>9.50</td>\r\n			<td>4</td>\r\n			<td>1.44</td>\r\n			<td>28.6</td>\r\n			<td>96</td>\r\n			<td>20</td>\r\n			<td>960</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3</td>\r\n			<td>600x1200 MM</td>\r\n			<td>REGULAR</td>\r\n			<td>9.80</td>\r\n			<td>2</td>\r\n			<td>1.44</td>\r\n			<td>32.70</td>\r\n			<td>84</td>\r\n			<td>20</td>\r\n			<td>840</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h6>Subway Tiles</h6>\r\n\r\n<table class=\" table table-bordered table-hover\">\r\n	<thead>\r\n		<tr>\r\n			<th>Sr. No</th>\r\n			<th>SIZE</th>\r\n			<th>PLT. TYPE EURO/REGULAR</th>\r\n			<th>THICKNESS</th>\r\n			<th>PCS/BOX</th>\r\n			<th>SQM/BOX</th>\r\n			<th>WEIGHT PER/BOX</th>\r\n			<th>BOX/PLT</th>\r\n			<th>PLT/CONT.</th>\r\n			<th>TOTAL BOX PER CONT.</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td rowspan=\"2\">1</td>\r\n			<td rowspan=\"2\">108X108 MM</td>\r\n			<td>REGULAR</td>\r\n			<td rowspan=\"2\">5 MM</td>\r\n			<td rowspan=\"2\">80</td>\r\n			<td rowspan=\"2\">0.933</td>\r\n			<td rowspan=\"2\">9.5</td>\r\n			<td>112</td>\r\n			<td>24</td>\r\n			<td>2688</td>\r\n		</tr>\r\n		<tr>\r\n			<td>EURO</td>\r\n			<td>120</td>\r\n			<td>23</td>\r\n			<td>2760</td>\r\n		</tr>\r\n		<tr>\r\n			<td rowspan=\"2\">2</td>\r\n			<td rowspan=\"2\">100X200 MM</td>\r\n			<td>REGULAR</td>\r\n			<td rowspan=\"2\">7.5</td>\r\n			<td rowspan=\"2\">50</td>\r\n			<td rowspan=\"2\">1.0</td>\r\n			<td rowspan=\"2\">13.2</td>\r\n			<td>96</td>\r\n			<td>20</td>\r\n			<td>1920</td>\r\n		</tr>\r\n		<tr>\r\n			<td>EURO</td>\r\n			<td>72</td>\r\n			<td>27</td>\r\n			<td>1944</td>\r\n		</tr>\r\n		<tr>\r\n			<td rowspan=\"2\">3</td>\r\n			<td rowspan=\"2\">100X300 MM</td>\r\n			<td>REGULAR</td>\r\n			<td rowspan=\"2\">7.5</td>\r\n			<td rowspan=\"2\">33</td>\r\n			<td rowspan=\"2\">1.0</td>\r\n			<td rowspan=\"2\">14</td>\r\n			<td>84</td>\r\n			<td>23</td>\r\n			<td>1932</td>\r\n		</tr>\r\n		<tr>\r\n			<td>EURO</td>\r\n			<td>96</td>\r\n			<td>20</td>\r\n			<td>1920</td>\r\n		</tr>\r\n		<tr>\r\n			<td rowspan=\"2\">4</td>\r\n			<td rowspan=\"2\">100X400 MM</td>\r\n			<td>REGULAR</td>\r\n			<td rowspan=\"2\">7.5</td>\r\n			<td rowspan=\"2\">25</td>\r\n			<td rowspan=\"2\">1.0</td>\r\n			<td rowspan=\"2\">14</td>\r\n			<td>96</td>\r\n			<td>20</td>\r\n			<td>1920</td>\r\n		</tr>\r\n		<tr>\r\n			<td>EURO</td>\r\n			<td>80</td>\r\n			<td>24</td>\r\n			<td>1920</td>\r\n		</tr>\r\n		<tr>\r\n			<td rowspan=\"2\">5</td>\r\n			<td rowspan=\"2\">75X300 MM</td>\r\n			<td>REGULAR</td>\r\n			<td rowspan=\"2\">7.5</td>\r\n			<td rowspan=\"2\">44</td>\r\n			<td rowspan=\"2\">1.0</td>\r\n			<td rowspan=\"2\">12</td>\r\n			<td>81</td>\r\n			<td>24</td>\r\n			<td>1944</td>\r\n		</tr>\r\n		<tr>\r\n			<td>EURO</td>\r\n			<td>80</td>\r\n			<td>24</td>\r\n			<td>1920</td>\r\n		</tr>\r\n		<tr>\r\n			<td rowspan=\"2\">6</td>\r\n			<td rowspan=\"2\">75X150 MM</td>\r\n			<td>REGULAR</td>\r\n			<td rowspan=\"2\">6.5</td>\r\n			<td rowspan=\"2\">84</td>\r\n			<td rowspan=\"2\">1.0</td>\r\n			<td rowspan=\"2\">12</td>\r\n			<td>68</td>\r\n			<td>28</td>\r\n			<td>1904</td>\r\n		</tr>\r\n		<tr>\r\n			<td>EURO</td>\r\n			<td>68</td>\r\n			<td>28</td>\r\n			<td>1904</td>\r\n		</tr>\r\n		<tr>\r\n			<td rowspan=\"2\">7</td>\r\n			<td rowspan=\"2\">150X150 MM</td>\r\n			<td>REGULAR</td>\r\n			<td rowspan=\"2\">7</td>\r\n			<td rowspan=\"2\">44</td>\r\n			<td rowspan=\"2\">1.0</td>\r\n			<td rowspan=\"2\">12.5</td>\r\n			<td>120</td>\r\n			<td>19</td>\r\n			<td>2280</td>\r\n		</tr>\r\n		<tr>\r\n			<td>EURO</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td rowspan=\"2\">8</td>\r\n			<td rowspan=\"2\">200X200 MM</td>\r\n			<td>REGULAR</td>\r\n			<td rowspan=\"2\">6.5</td>\r\n			<td rowspan=\"2\">25</td>\r\n			<td rowspan=\"2\">1.0</td>\r\n			<td rowspan=\"2\">12</td>\r\n			<td>90</td>\r\n			<td>23</td>\r\n			<td>2070</td>\r\n		</tr>\r\n		<tr>\r\n			<td>EURO</td>\r\n			<td>96</td>\r\n			<td>22</td>\r\n			<td>2112</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h6>Wall Tiles</h6>\r\n\r\n<table class=\" table table-bordered table-hover\">\r\n	<thead>\r\n		<tr>\r\n			<th>Sr. No</th>\r\n			<th>SIZE</th>\r\n			<th>PLT. TYPE EURO/REGULAR</th>\r\n			<th>THICKNESS</th>\r\n			<th>PCS/BOX</th>\r\n			<th>SQM/BOX</th>\r\n			<th>WEIGHT PER/BOX</th>\r\n			<th>BOX/PLT</th>\r\n			<th>PLT/CONT.</th>\r\n			<th>TOTAL BOX PER CONT.</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>2</td>\r\n			<td>300X600 MM</td>\r\n			<td>REGULAR</td>\r\n			<td>&nbsp;</td>\r\n			<td>5</td>\r\n			<td>0.9</td>\r\n			<td>14</td>\r\n			<td>90</td>\r\n			<td>22</td>\r\n			<td>1980</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n'),
(133, 'functionality', 'infrastructure', '0'),
(134, 'settings', 'meta_key', 'Jyora, Jyora CeramicWall Tiles, Ceramic Wall Tiles, Ceramic Floor Tiles, glazed vitrified tiles, Digital Vitrified Tiles Morbi, Manufacturer of Ceramic Tiles in Morbi, GVT Tiles, PGVT Tiles, Wall Tiles Morbi, Digital Wall Tiles exporter in Morbi, polished glazed vitrified tiles, polished vitrified tiles, exporter India.'),
(135, 'settings', 'meta_description', 'Jyora Ceramic we are manufacturing and exporters Wall Tiles, Floor Tiles and Subway tiles and we also export Asia, Gulf, North America, African and European country.'),
(252, 'functionality', 'Admin_Panel_Change', '0'),
(253, 'functionality', 'register', '1'),
(256, 'functionality', 'export', '1'),
(257, 'functionality', 'exportFlag', '0'),
(258, 'functionality', 'youtube_video_lightbox', ''),
(259, 'functionality', 'product-inquiry', '0'),
(260, 'functionality', 'event', '0'),
(276, 'functionality', 'video', '0'),
(283, 'functionality', 'menulogo', '0'),
(284, 'functionality', 'sizelogo', '0'),
(285, 'functionality', 'serieslogo', '0'),
(286, 'functionality', 'catalogue_product', '0'),
(287, 'functionality', 'news_video', '0'),
(288, 'functionality', 'blog', '0'),
(289, 'functionality', 'career', '0'),
(290, 'functionality', 'catalogue_product', '0'),
(291, 'functionality', 'frontmenu', '0'),
(292, 'functionality', 'frontcontact', '0'),
(293, 'functionality', 'register_user', '0'),
(294, 'functionality', 'web_visitor', '0'),
(295, 'functionality', 'live_view', '1'),
(296, 'functionality', 'catalog_link', '0'),
(341, 'functionality', 'Whatsapp_display', '0'),
(342, 'functionality', 'whatapp_counter', '0'),
(358, 'functionality', 'product_scatch', '0'),
(464, 'functionality', 'login_otp', '0'),
(516, 'social', 'facebook', 'https://www.facebook.com/'),
(517, 'social', 'twitter', 'https://twitter.com/'),
(518, 'social', 'instagram', 'https://www.instagram.com/'),
(519, 'social', 'pinterest', 'https://in.pinterest.com/'),
(520, 'social', 'linkedin', 'https://in.linkedin.com/'),
(521, 'social', 'whatsapp', 'https://api.whatsapp.com/send?phone=91'),
(524, 'sms', 'sms_statue', '0'),
(525, 'sms', 'sms_mobileno', ''),
(526, 'sms', 'sms_replay', '0'),
(589, 'functionality', 'appicon', '0'),
(590, 'functionality', 'tkd_menu', '0'),
(591, 'functionality', 'tkd_size', '0'),
(592, 'functionality', 'tkd_series', '0'),
(602, 'sms', 'smsmsg', ''),
(603, 'functionality', 'cataloguemenu', '0'),
(604, 'functionality', 'catalogueimg', '1'),
(605, 'functionality', 'register_inquiry', '0'),
(639, 'functionality', 'ceramic_application', '0'),
(640, 'functionality', 'product_inspiration', '0'),
(641, 'functionality', 'Tiles_Color', '0'),
(642, 'social', 'email', 'info@jyoraceramic.com'),
(643, 'functionality', 'slidertext', '0'),
(644, 'functionality', 'slidermenu', '0'),
(645, 'functionality', 'slider_url', '0'),
(916, 'social', 'google', '#'),
(917, 'functionality', 'applicationlogo', '1'),
(942, 'Home', 'title', 'Jyora Ceramic | We are Leading manufacturer and supplier of Subway Tiles, Wall Tiles And Floor Tiles all over the world.'),
(943, 'Home', 'keyword', ''),
(944, 'Home', 'description', ''),
(945, 'Products', 'title', 'Jyora Ceramic | We are Leading manufacturer and supplier of Subway Tiles, Wall Tiles And Floor Tiles all over the world.'),
(946, 'Products', 'keyword', ''),
(947, 'Products', 'description', ''),
(948, 'social', 'houzz', ''),
(949, 'Infrastructure', 'title', 'Jyora Ceramic | Factory'),
(950, 'Infrastructure', 'keyword', ''),
(951, 'Infrastructure', 'description', ''),
(955, 'International', 'title', 'Jyora Ceramic | Export'),
(956, 'International', 'keyword', ''),
(957, 'International', 'description', ''),
(958, 'Brochure', 'title', 'Jyora Ceramic| Catalogue Download'),
(959, 'Brochure', 'keyword', ''),
(960, 'Brochure', 'description', ''),
(967, 'Quality', 'title', 'Jyora Ceramic | Quality'),
(968, 'Quality', 'keyword', ''),
(969, 'Quality', 'description', ''),
(976, 'Contact', 'title', 'Jyora Ceramic | Contact Details'),
(977, 'Contact', 'keyword', ''),
(978, 'Contact', 'description', ''),
(979, 'About', 'title', 'Jyora Ceramic | Company Information'),
(980, 'About', 'keyword', ''),
(981, 'About', 'description', '');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `yturl` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `whatsapp_analytics`
--

CREATE TABLE `whatsapp_analytics` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `visitCount` int(11) NOT NULL,
  `adate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `whatsapp_analytics`
--

INSERT INTO `whatsapp_analytics` (`id`, `ip`, `visitCount`, `adate`) VALUES
(1, '::1', 1, '2020-10-03'),
(2, '1.38.89.159', 1, '2020-10-05'),
(3, '103.250.163.52', 1, '2020-10-10'),
(4, '157.32.246.189', 1, '2020-10-11'),
(5, '103.120.234.16', 4, '2020-10-13'),
(6, '192.168.0.206', 1, '2020-10-16'),
(7, '34.74.229.138', 1, '2020-10-24'),
(8, '119.160.195.29', 1, '2020-10-24'),
(9, '157.46.81.252', 1, '2020-10-24'),
(10, '36.252.194.229', 1, '2020-10-24'),
(11, '106.207.225.137', 1, '2020-10-25'),
(12, '35.196.150.168', 1, '2020-10-25'),
(13, '34.74.20.92', 1, '2020-10-26'),
(14, '119.160.195.29', 1, '2020-10-27'),
(15, '35.196.95.178', 1, '2020-10-27'),
(16, '35.231.240.33', 1, '2020-10-29'),
(17, '54.39.243.183', 1, '2020-10-29'),
(18, '34.75.252.243', 1, '2020-10-29'),
(19, '35.231.241.255', 1, '2020-10-30'),
(20, '114.31.188.166', 1, '2020-10-30'),
(21, '103.81.117.50', 2, '2020-10-30'),
(22, '104.196.147.160', 1, '2020-10-30'),
(23, '168.119.4.44', 1, '2020-10-31'),
(24, '35.196.150.168', 1, '2020-10-31'),
(25, '104.196.119.37', 1, '2020-11-01'),
(26, '106.213.219.184', 1, '2020-11-02'),
(27, '1.39.214.110', 1, '2020-11-02'),
(28, '35.196.150.168', 1, '2020-11-02'),
(29, '157.36.64.164', 2, '2020-11-03'),
(30, '103.250.162.165', 1, '2020-11-03'),
(31, '104.196.178.236', 1, '2020-11-03'),
(32, '110.227.242.113', 1, '2020-11-04'),
(33, '104.196.119.37', 1, '2020-11-04'),
(34, '157.49.229.247', 1, '2020-11-05'),
(35, '35.243.252.220', 1, '2020-11-06'),
(36, '150.129.52.170', 1, '2020-11-06'),
(37, '35.227.5.145', 1, '2020-11-07'),
(38, '35.185.19.233', 1, '2020-11-07'),
(39, '35.237.55.226', 1, '2020-11-07'),
(40, '117.96.224.156', 1, '2020-11-07'),
(41, '104.196.30.166', 1, '2020-11-07'),
(42, '17.58.102.54', 1, '2020-11-07'),
(43, '34.73.217.49', 1, '2020-11-09'),
(44, '1.38.93.37', 1, '2020-11-09'),
(45, '35.231.97.112', 1, '2020-11-09'),
(46, '34.75.211.67', 1, '2020-11-09'),
(47, '175.110.29.212', 1, '2020-11-09'),
(48, '62.210.189.2', 1, '2020-11-10'),
(49, '103.132.240.13', 1, '2020-11-10'),
(50, '34.74.64.84', 1, '2020-11-10'),
(51, '110.227.242.113', 1, '2020-11-11'),
(52, '34.75.21.143', 1, '2020-11-12'),
(53, '157.32.245.134', 1, '2020-11-12'),
(54, '34.74.229.138', 1, '2020-11-13'),
(55, '34.75.134.245', 1, '2020-11-13'),
(56, '35.237.109.13', 1, '2020-11-13'),
(57, '62.210.189.2', 1, '2020-11-14'),
(58, '5.255.231.83', 1, '2020-11-14'),
(59, '104.196.147.160', 1, '2020-11-14'),
(60, '35.243.252.220', 1, '2020-11-15'),
(61, '34.73.217.49', 1, '2020-11-16'),
(62, '35.243.206.211', 1, '2020-11-17'),
(63, '115.97.194.19', 1, '2020-11-17'),
(64, '35.196.240.242', 1, '2020-11-17'),
(65, '34.73.150.127', 1, '2020-11-17'),
(66, '34.75.252.243', 1, '2020-11-18'),
(67, '35.231.225.3', 1, '2020-11-20'),
(68, '35.185.10.67', 1, '2020-11-20'),
(69, '35.196.240.242', 1, '2020-11-21'),
(70, '34.74.157.10', 1, '2020-11-21'),
(71, '27.61.140.14', 1, '2020-11-21'),
(72, '35.243.252.220', 1, '2020-11-21'),
(73, '185.191.171.35', 1, '2020-11-21'),
(74, '35.231.240.33', 1, '2020-11-21'),
(75, '54.36.148.228', 1, '2020-11-22'),
(76, '123.201.90.31', 1, '2020-11-22'),
(77, '34.73.150.127', 1, '2020-11-22'),
(78, '104.196.119.37', 1, '2020-11-22'),
(79, '35.196.95.178', 1, '2020-11-23'),
(80, '35.185.98.127', 1, '2020-11-23'),
(81, '220.158.162.153', 1, '2020-11-23'),
(82, '34.74.229.138', 1, '2020-11-23'),
(83, '34.75.79.5', 1, '2020-11-23'),
(84, '44.234.71.246', 1, '2020-11-24'),
(85, '157.37.21.218', 1, '2020-11-24'),
(86, '104.196.176.192', 1, '2020-11-24'),
(87, '14.192.29.30', 1, '2020-11-24'),
(88, '110.227.242.113', 1, '2020-11-25'),
(89, '34.75.169.236', 1, '2020-11-25'),
(90, '35.196.54.126', 1, '2020-11-25'),
(91, '113.70.60.25', 1, '2020-11-26'),
(92, '157.47.149.206', 2, '2020-11-26'),
(93, '104.196.30.166', 1, '2020-11-27'),
(94, '14.192.29.235', 1, '2020-11-27'),
(95, '27.62.52.116', 1, '2020-11-27'),
(96, '157.32.223.169', 2, '2020-11-27'),
(97, '122.170.43.99', 1, '2020-11-27'),
(98, '176.9.117.99', 1, '2020-11-27'),
(99, '35.243.252.220', 1, '2020-11-28'),
(100, '157.34.134.27', 1, '2020-11-28'),
(101, '34.75.42.85', 1, '2020-11-28'),
(102, '35.243.252.220', 1, '2020-11-29'),
(103, '34.75.169.236', 1, '2020-11-29'),
(104, '34.73.217.49', 1, '2020-11-29'),
(105, '43.241.146.112', 1, '2020-11-30'),
(106, '104.196.222.23', 1, '2020-11-30'),
(107, '35.243.174.27', 1, '2020-12-01'),
(108, '34.75.185.85', 1, '2020-12-01'),
(109, '35.196.143.73', 1, '2020-12-02'),
(110, '35.231.97.112', 1, '2020-12-02'),
(111, '182.69.202.221', 1, '2020-12-02'),
(112, '34.73.217.49', 1, '2020-12-03'),
(113, '34.74.157.10', 1, '2020-12-03'),
(114, '35.231.97.112', 1, '2020-12-03'),
(115, '54.36.148.198', 1, '2020-12-04'),
(116, '103.52.250.227', 1, '2020-12-04'),
(117, '34.75.211.67', 1, '2020-12-04'),
(118, '47.8.129.106', 1, '2020-12-04'),
(119, '207.200.8.180', 1, '2020-12-04'),
(120, '34.73.217.49', 1, '2020-12-05'),
(121, '64.62.202.73', 1, '2020-12-06'),
(122, '35.227.5.145', 1, '2020-12-06'),
(123, '103.120.234.16', 1, '2020-12-07'),
(124, '173.231.59.199', 1, '2020-12-08'),
(125, '35.231.231.246', 1, '2020-12-08'),
(126, '35.231.240.33', 1, '2020-12-08'),
(127, '34.75.196.53', 1, '2020-12-09'),
(128, '35.243.221.30', 1, '2020-12-10'),
(129, '18.134.6.43', 1, '2020-12-10'),
(130, '109.102.111.37', 2, '2020-12-10'),
(131, '35.190.142.20', 1, '2020-12-11'),
(132, '104.196.191.125', 1, '2020-12-11'),
(133, '34.75.14.45', 1, '2020-12-12'),
(134, '35.231.240.33', 1, '2020-12-12'),
(135, '14.192.29.87', 1, '2020-12-12'),
(136, '35.185.98.127', 1, '2020-12-13'),
(137, '27.61.135.119', 1, '2020-12-14'),
(138, '34.73.181.4', 1, '2020-12-14'),
(139, '54.36.148.159', 1, '2020-12-14'),
(140, '117.249.216.239', 1, '2020-12-15'),
(141, '150.129.149.146', 1, '2020-12-15'),
(142, '35.231.240.33', 1, '2020-12-15'),
(143, '35.231.97.112', 1, '2020-12-15'),
(144, '104.196.147.160', 1, '2020-12-16'),
(145, '157.51.133.64', 1, '2020-12-17'),
(146, '34.75.252.243', 1, '2020-12-18'),
(147, '117.195.70.236', 1, '2020-12-18'),
(148, '35.231.225.3', 1, '2020-12-19'),
(149, '106.206.109.50', 1, '2020-12-19'),
(150, '43.250.156.224', 1, '2020-12-19'),
(151, '216.18.204.194', 1, '2020-12-19'),
(152, '167.114.101.65', 1, '2020-12-19'),
(153, '35.237.109.13', 1, '2020-12-20'),
(154, '106.67.151.63', 1, '2020-12-20'),
(155, '34.73.217.49', 1, '2020-12-21'),
(156, '27.54.161.68', 1, '2020-12-21'),
(157, '14.192.29.117', 1, '2020-12-21'),
(158, '47.8.157.185', 2, '2020-12-21'),
(159, '104.196.106.26', 1, '2020-12-21'),
(160, '106.213.182.43', 1, '2020-12-22'),
(161, '192.151.157.210', 1, '2020-12-22'),
(162, '35.185.10.67', 1, '2020-12-23'),
(163, '47.8.105.47', 1, '2020-12-23'),
(164, '35.190.142.20', 1, '2020-12-23'),
(165, '54.36.148.172', 1, '2020-12-24'),
(166, '113.69.181.171', 1, '2020-12-24'),
(167, '35.243.221.30', 1, '2020-12-24'),
(168, '113.69.183.91', 1, '2020-12-25'),
(169, '203.194.101.95', 1, '2020-12-25'),
(170, '35.196.54.126', 1, '2020-12-25'),
(171, '104.196.176.192', 1, '2020-12-25'),
(172, '216.18.204.194', 1, '2020-12-27'),
(173, '104.196.222.23', 2, '2020-12-27'),
(174, '103.52.250.227', 1, '2020-12-27'),
(175, '34.73.185.169', 1, '2020-12-27'),
(176, '113.70.249.56', 1, '2020-12-28'),
(177, '103.112.85.204', 1, '2020-12-28'),
(178, '104.196.191.125', 1, '2020-12-28'),
(179, '106.206.125.173', 1, '2020-12-28'),
(180, '92.220.10.100', 1, '2020-12-29'),
(181, '209.133.205.122', 1, '2020-12-29'),
(182, '34.75.21.143', 1, '2020-12-29'),
(183, '157.33.98.134', 1, '2020-12-30'),
(184, '35.196.95.178', 1, '2020-12-30'),
(185, '34.75.169.236', 1, '2020-12-31'),
(186, '173.212.194.14', 1, '2021-01-01'),
(187, '157.47.207.130', 1, '2021-01-01'),
(188, '35.243.252.220', 1, '2021-01-01'),
(189, '54.36.148.202', 1, '2021-01-02'),
(190, '35.231.240.33', 1, '2021-01-03'),
(191, '216.18.204.194', 1, '2021-01-03'),
(192, '157.44.200.30', 1, '2021-01-03'),
(193, '104.196.30.166', 1, '2021-01-03'),
(194, '157.34.30.230', 2, '2021-01-03'),
(195, '49.36.171.131', 1, '2021-01-04'),
(196, '192.99.160.200', 1, '2021-01-04'),
(197, '35.231.97.112', 1, '2021-01-04'),
(198, '113.70.250.234', 1, '2021-01-04'),
(199, '157.34.24.189', 1, '2021-01-04'),
(200, '1.38.68.234', 1, '2021-01-05'),
(201, '47.8.199.36', 1, '2021-01-05'),
(202, '35.237.229.226', 1, '2021-01-05'),
(203, '35.243.221.30', 1, '2021-01-06'),
(204, '35.231.21.3', 1, '2021-01-06'),
(205, '35.227.5.145', 1, '2021-01-06'),
(206, '34.75.252.243', 1, '2021-01-06'),
(207, '192.99.10.47', 1, '2021-01-07'),
(208, '34.75.42.85', 1, '2021-01-07'),
(209, '106.211.239.208', 1, '2021-01-08'),
(210, '35.196.157.247', 1, '2021-01-08'),
(211, '35.243.206.211', 1, '2021-01-08'),
(212, '27.63.37.11', 1, '2021-01-09'),
(213, '35.196.150.168', 1, '2021-01-09'),
(214, '47.247.154.10', 1, '2021-01-10'),
(215, '167.114.159.183', 1, '2021-01-10'),
(216, '103.120.234.16', 1, '2021-01-10'),
(217, '69.160.160.51', 1, '2021-01-10'),
(218, '35.231.172.79', 1, '2021-01-11'),
(219, '27.54.162.177', 2, '2021-01-11'),
(220, '35.231.149.63', 1, '2021-01-11'),
(221, '54.36.149.14', 1, '2021-01-11'),
(222, '27.56.229.16', 1, '2021-01-11'),
(223, '103.81.93.208', 1, '2021-01-12'),
(224, '34.75.21.143', 1, '2021-01-13'),
(225, '35.231.241.120', 1, '2021-01-13'),
(226, '167.114.158.215', 1, '2021-01-13'),
(227, '216.18.204.202', 1, '2021-01-13'),
(228, '34.74.125.177', 1, '2021-01-14'),
(229, '35.243.252.220', 2, '2021-01-14'),
(230, '62.210.189.2', 1, '2021-01-14'),
(231, '185.191.171.5', 1, '2021-01-14'),
(232, '35.185.19.233', 1, '2021-01-15'),
(233, '157.42.194.51', 1, '2021-01-15'),
(234, '106.222.90.105', 1, '2021-01-15'),
(235, '27.59.123.170', 1, '2021-01-15'),
(236, '35.237.229.226', 1, '2021-01-16'),
(237, '144.91.91.164', 1, '2021-01-16'),
(238, '35.231.241.120', 1, '2021-01-16'),
(239, '34.73.185.169', 1, '2021-01-17'),
(240, '35.231.241.255', 1, '2021-01-18'),
(241, '35.185.10.67', 1, '2021-01-18'),
(242, '157.32.221.190', 1, '2021-01-18'),
(243, '35.231.21.3', 1, '2021-01-18'),
(244, '157.35.254.202', 1, '2021-01-19'),
(245, '168.119.4.44', 1, '2021-01-19'),
(246, '178.150.14.250', 1, '2021-01-19'),
(247, '54.36.148.42', 1, '2021-01-20'),
(248, '34.74.229.138', 1, '2021-01-20'),
(249, '216.18.204.202', 1, '2021-01-21'),
(250, '34.73.185.169', 1, '2021-01-21'),
(251, '104.196.141.147', 1, '2021-01-21'),
(252, '34.75.152.182', 1, '2021-01-21'),
(253, '35.243.206.211', 1, '2021-01-22'),
(254, '192.99.6.226', 1, '2021-01-22'),
(255, '223.238.231.203', 1, '2021-01-22'),
(256, '168.119.99.192', 1, '2021-01-23'),
(257, '3.236.156.34', 1, '2021-01-23'),
(258, '34.75.42.85', 1, '2021-01-23'),
(259, '34.74.20.92', 1, '2021-01-23'),
(260, '35.231.149.63', 1, '2021-01-24'),
(261, '192.99.15.199', 1, '2021-01-25'),
(262, '34.73.217.49', 1, '2021-01-26'),
(263, '34.75.169.236', 1, '2021-01-26'),
(264, '104.196.222.23', 1, '2021-01-27'),
(265, '124.123.106.2', 1, '2021-01-27'),
(266, '216.18.204.202', 1, '2021-01-28'),
(267, '54.36.148.202', 1, '2021-01-28'),
(268, '35.231.97.112', 1, '2021-01-28'),
(269, '157.32.230.3', 2, '2021-01-28'),
(270, '35.243.252.220', 1, '2021-01-29'),
(271, '85.92.66.148', 1, '2021-01-29'),
(272, '14.192.29.201', 1, '2021-01-29'),
(273, '18.188.53.156', 1, '2021-01-29'),
(274, '157.34.2.211', 1, '2021-01-30'),
(275, '34.75.252.243', 1, '2021-01-30'),
(276, '34.74.128.161', 1, '2021-01-30'),
(277, '35.229.42.3', 1, '2021-01-31'),
(278, '47.15.206.247', 1, '2021-02-01'),
(279, '34.75.134.245', 1, '2021-02-01'),
(280, '35.185.10.67', 1, '2021-02-01'),
(281, '34.73.181.4', 1, '2021-02-01'),
(282, '35.243.252.220', 1, '2021-02-01'),
(283, '103.112.85.171', 1, '2021-02-02'),
(284, '35.229.42.3', 1, '2021-02-03'),
(285, '144.76.29.149', 1, '2021-02-03'),
(286, '34.74.229.138', 1, '2021-02-03'),
(287, '216.18.204.202', 1, '2021-02-04'),
(288, '183.87.219.168', 2, '2021-02-05'),
(289, '35.243.252.220', 1, '2021-02-05'),
(290, '35.231.241.120', 1, '2021-02-05'),
(291, '54.36.149.67', 1, '2021-02-05'),
(292, '35.243.206.211', 1, '2021-02-05'),
(293, '35.196.238.104', 1, '2021-02-05'),
(294, '110.227.243.78', 1, '2021-02-06'),
(295, '47.29.127.115', 2, '2021-02-07'),
(296, '34.75.134.245', 1, '2021-02-07'),
(297, '104.196.106.26', 1, '2021-02-07'),
(298, '154.54.249.15', 1, '2021-02-08'),
(299, '182.64.193.52', 1, '2021-02-08'),
(300, '35.231.253.53', 1, '2021-02-09'),
(301, '185.119.81.104', 1, '2021-02-09'),
(302, '192.99.5.225', 1, '2021-02-09'),
(303, '35.227.29.207', 1, '2021-02-10'),
(304, '49.34.104.47', 1, '2021-02-10'),
(305, '34.74.157.10', 1, '2021-02-11'),
(306, '35.196.131.36', 1, '2021-02-11'),
(307, '47.31.142.208', 1, '2021-02-11'),
(308, '35.243.206.211', 1, '2021-02-11'),
(309, '216.18.204.202', 1, '2021-02-11'),
(310, '34.75.14.45', 1, '2021-02-11'),
(311, '185.119.81.104', 1, '2021-02-12'),
(312, '5.9.70.113', 1, '2021-02-12'),
(313, '34.74.229.138', 1, '2021-02-13'),
(314, '124.40.247.19', 1, '2021-02-13'),
(315, '59.91.72.93', 2, '2021-02-13'),
(316, '34.74.139.252', 1, '2021-02-13'),
(317, '35.196.68.46', 1, '2021-02-13'),
(318, '34.75.90.39', 1, '2021-02-14'),
(319, '54.36.148.86', 1, '2021-02-14'),
(320, '104.196.176.192', 1, '2021-02-15'),
(321, '61.2.134.199', 2, '2021-02-15'),
(322, '34.75.42.85', 1, '2021-02-15'),
(323, '34.74.229.138', 1, '2021-02-15'),
(324, '78.46.63.108', 1, '2021-02-15'),
(325, '35.237.55.226', 1, '2021-02-18'),
(326, '103.120.234.16', 1, '2021-02-18'),
(327, '216.18.204.202', 1, '2021-02-18'),
(328, '167.114.158.241', 1, '2021-02-18'),
(329, '106.78.55.15', 1, '2021-02-19'),
(330, '35.185.98.127', 1, '2021-02-19'),
(331, '49.36.79.143', 1, '2021-02-20'),
(332, '104.196.222.23', 1, '2021-02-20'),
(333, '142.44.167.43', 1, '2021-02-21'),
(334, '5.9.77.102', 1, '2021-02-22'),
(335, '35.196.202.144', 1, '2021-02-22'),
(336, '157.34.189.5', 1, '2021-02-22'),
(337, '35.231.59.228', 1, '2021-02-22'),
(338, '54.36.148.205', 1, '2021-02-23'),
(339, '207.200.8.180', 1, '2021-02-23'),
(340, '49.34.251.92', 1, '2021-02-23'),
(341, '34.75.42.85', 1, '2021-02-23'),
(342, '35.190.182.251', 1, '2021-02-24'),
(343, '85.185.2.242', 1, '2021-02-24'),
(344, '109.102.111.39', 2, '2021-02-25'),
(345, '144.76.176.171', 1, '2021-02-25'),
(346, '35.196.143.73', 1, '2021-02-25'),
(347, '35.190.182.251', 1, '2021-02-25'),
(348, '106.213.194.125', 1, '2021-02-25'),
(349, '34.74.168.207', 1, '2021-02-25'),
(350, '113.70.61.97', 1, '2021-02-25'),
(351, '34.73.181.4', 1, '2021-02-25'),
(352, '216.18.204.202', 1, '2021-02-26'),
(353, '42.107.193.89', 1, '2021-02-26'),
(354, '34.74.20.92', 1, '2021-02-27'),
(355, '35.227.69.234', 1, '2021-02-27'),
(356, '183.26.3.233', 2, '2021-02-28'),
(357, '148.251.195.14', 1, '2021-02-28'),
(358, '34.74.229.138', 1, '2021-03-01'),
(359, '103.16.69.240', 1, '2021-03-01'),
(360, '35.190.173.63', 1, '2021-03-01'),
(361, '45.251.50.132', 1, '2021-03-01'),
(362, '34.73.213.210', 1, '2021-03-02'),
(363, '34.73.108.149', 1, '2021-03-02'),
(364, '77.69.251.133', 1, '2021-03-02'),
(365, '34.75.79.5', 1, '2021-03-02'),
(366, '1.38.84.39', 1, '2021-03-03'),
(367, '5.9.108.254', 1, '2021-03-03'),
(368, '35.231.25.97', 1, '2021-03-03'),
(369, '117.203.245.85', 1, '2021-03-03'),
(370, '34.75.211.67', 1, '2021-03-03'),
(371, '62.210.189.2', 1, '2021-03-03'),
(372, '157.41.70.238', 1, '2021-03-04'),
(373, '54.36.148.205', 1, '2021-03-04'),
(374, '171.76.247.120', 1, '2021-03-05'),
(375, '35.190.182.251', 1, '2021-03-05'),
(376, '176.9.117.99', 1, '2021-03-06'),
(377, '144.76.60.198', 1, '2021-03-06'),
(378, '1.38.65.224', 9, '2021-03-07'),
(379, '35.185.53.80', 1, '2021-03-07'),
(380, '42.106.40.131', 2, '2021-03-07'),
(381, '13.66.139.137', 1, '2021-03-07'),
(382, '157.55.39.159', 1, '2021-03-07'),
(383, '35.185.55.165', 1, '2021-03-08'),
(384, '103.120.234.16', 1, '2021-03-09'),
(385, '91.137.17.182', 1, '2021-03-09'),
(386, '35.231.103.22', 1, '2021-03-10'),
(387, '35.185.53.80', 1, '2021-03-10'),
(388, '35.243.157.85', 1, '2021-03-11'),
(389, '49.36.173.252', 2, '2021-03-11'),
(390, '35.237.4.218', 1, '2021-03-11'),
(391, '34.75.155.221', 1, '2021-03-11'),
(392, '35.231.193.223', 1, '2021-03-11'),
(393, '5.9.108.254', 1, '2021-03-12'),
(394, '5.45.207.126', 1, '2021-03-12'),
(395, '34.74.222.187', 1, '2021-03-13'),
(396, '185.191.171.44', 1, '2021-03-13'),
(397, '54.36.148.205', 1, '2021-03-14'),
(398, '104.196.43.251', 1, '2021-03-14'),
(399, '216.18.204.213', 1, '2021-03-14'),
(400, '104.196.106.26', 1, '2021-03-15'),
(401, '5.9.77.102', 1, '2021-03-15'),
(402, '43.252.116.133', 1, '2021-03-15'),
(403, '35.231.252.130', 1, '2021-03-15'),
(404, '47.15.250.22', 1, '2021-03-16'),
(405, '34.73.76.221', 1, '2021-03-16'),
(406, '49.36.133.192', 1, '2021-03-17'),
(407, '35.243.252.220', 1, '2021-03-18'),
(408, '192.99.14.135', 1, '2021-03-18'),
(409, '157.43.210.215', 1, '2021-03-19'),
(410, '152.57.88.165', 3, '2021-03-19'),
(411, '35.243.252.220', 1, '2021-03-20'),
(412, '106.198.120.221', 1, '2021-03-20'),
(413, '157.43.216.244', 2, '2021-03-20'),
(414, '157.33.123.69', 1, '2021-03-21'),
(415, '150.129.200.170', 1, '2021-03-21'),
(416, '157.90.177.228', 1, '2021-03-21'),
(417, '34.74.32.200', 1, '2021-03-22'),
(418, '35.196.9.104', 1, '2021-03-22'),
(419, '35.190.173.63', 1, '2021-03-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesslog`
--
ALTER TABLE `accesslog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addanalytics`
--
ALTER TABLE `addanalytics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_inquiry`
--
ALTER TABLE `blog_inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `career_inquiry`
--
ALTER TABLE `career_inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catagory_image`
--
ALTER TABLE `catagory_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catalogue`
--
ALTER TABLE `catalogue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_inquiry`
--
ALTER TABLE `contact_inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `design_image`
--
ALTER TABLE `design_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `design_preview`
--
ALTER TABLE `design_preview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `export_flag`
--
ALTER TABLE `export_flag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontendmenu`
--
ALTER TABLE `frontendmenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspiration`
--
ALTER TABLE `inspiration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newscatagory`
--
ALTER TABLE `newscatagory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_inquiry`
--
ALTER TABLE `product_inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_other_admin_panel`
--
ALTER TABLE `product_other_admin_panel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register_inquiry`
--
ALTER TABLE `register_inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `series_no`
--
ALTER TABLE `series_no`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whatsapp_analytics`
--
ALTER TABLE `whatsapp_analytics`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesslog`
--
ALTER TABLE `accesslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `addanalytics`
--
ALTER TABLE `addanalytics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_inquiry`
--
ALTER TABLE `blog_inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `career_inquiry`
--
ALTER TABLE `career_inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catagory_image`
--
ALTER TABLE `catagory_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `catalogue`
--
ALTER TABLE `catalogue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_inquiry`
--
ALTER TABLE `contact_inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `design_image`
--
ALTER TABLE `design_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `design_preview`
--
ALTER TABLE `design_preview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `export_flag`
--
ALTER TABLE `export_flag`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frontendmenu`
--
ALTER TABLE `frontendmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inspiration`
--
ALTER TABLE `inspiration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newscatagory`
--
ALTER TABLE `newscatagory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=714;

--
-- AUTO_INCREMENT for table `product_inquiry`
--
ALTER TABLE `product_inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_other_admin_panel`
--
ALTER TABLE `product_other_admin_panel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `register_inquiry`
--
ALTER TABLE `register_inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `series_no`
--
ALTER TABLE `series_no`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=985;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `whatsapp_analytics`
--
ALTER TABLE `whatsapp_analytics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=420;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
