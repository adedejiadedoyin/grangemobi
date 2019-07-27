-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 10, 2019 at 09:36 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.3.1-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `collegeData`
--

-- --------------------------------------------------------

--
-- Table structure for table `lecturerTable`
--

CREATE TABLE `lecturerTable` (
  `staffNumber` int(6) NOT NULL,
  `firstName` varchar(10) NOT NULL,
  `lastName` varchar(15) NOT NULL,
  `moduleNo1` int(6) NOT NULL,
  `moduleNo2` int(6) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table contains all lecturer records for the example database.';

--
-- Dumping data for table `lecturerTable`
--

INSERT INTO `lecturerTable` (`staffNumber`, `firstName`, `lastName`, `moduleNo1`, `moduleNo2`, `email`) VALUES
(123001, 'Charlie', 'Cullen', 999001, 999003, 'charlie@here.com'),
(123002, 'Hugh', 'McAtamney', 999002, 999009, 'hugh@there.com'),
(123003, 'Keith', 'Gardiner', 999006, 999008, 'keith@there.com'),
(123004, 'Paula', 'McGloin', 999004, 999005, 'paula@there.com'),
(123005, 'James', 'Wogan', 999007, 999010, 'james@there.com');

-- --------------------------------------------------------

--
-- Table structure for table `lectureTimetable`
--

CREATE TABLE `lectureTimetable` (
  `id` int(11) NOT NULL,
  `moduleNo` int(11) NOT NULL,
  `day` smallint(6) NOT NULL,
  `start_at` time NOT NULL,
  `end_at` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lectureTimetable`
--

INSERT INTO `lectureTimetable` (`id`, `moduleNo`, `day`, `start_at`, `end_at`) VALUES
(1, 999006, 1, '14:00:00', '15:00:00'),
(2, 999001, 2, '14:00:00', '15:00:00'),
(3, 999004, 3, '12:00:00', '15:00:00'),
(4, 999001, 4, '15:00:00', '17:00:00'),
(5, 999005, 5, '09:00:00', '11:00:00'),
(6, 999002, 1, '14:00:00', '15:00:00'),
(7, 999003, 3, '16:00:00', '18:00:00'),
(8, 999003, 4, '10:00:00', '12:00:00'),
(9, 999002, 4, '08:00:00', '10:00:00'),
(10, 999005, 2, '08:00:00', '10:00:00'),
(11, 999007, 3, '12:00:00', '15:00:00'),
(12, 999008, 5, '16:00:00', '18:00:00'),
(13, 999009, 2, '12:00:00', '15:00:00'),
(14, 999010, 1, '11:00:00', '12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `moduleTable`
--

CREATE TABLE `moduleTable` (
  `moduleNo` int(6) NOT NULL,
  `moduleName` varchar(30) NOT NULL,
  `credits` int(2) NOT NULL,
  `website` varchar(30) NOT NULL,
  `dueDate` date NOT NULL,
  `location` varchar(25) NOT NULL,
  `room` varchar(10) NOT NULL,
  `lat` varchar(20) NOT NULL,
  `long` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table contains all module records for the example database.';

--
-- Dumping data for table `moduleTable`
--

INSERT INTO `moduleTable` (`moduleNo`, `moduleName`, `credits`, `website`, `dueDate`, `location`, `room`, `lat`, `long`) VALUES
(999001, 'Dynamic Web Development', 15, 'www.dynWeb.ie', '2013-05-14', 'Aungier Street', '4037', '53.338545', '-6.26607'),
(999002, 'Human Computer Interaction', 10, 'www.hci.ie', '2013-04-09', 'Aungier Street', '2005', '53.338545', '-6.26607'),
(999003, 'Introduction to Programming', 15, 'www.jscriptIntro.ie', '2013-01-11', 'Kevin Street', '1045', '53.337015', '-6.267933'),
(999004, 'Design Principles', 15, 'www.designIntro.ie', '2013-04-25', 'Bolton Street', '0130', '53.351406', '-6.268724'),
(999005, 'Design Practice', 10, 'www.designPract.ie', '2013-01-11', 'Cathal Brugha Street', '0123', '53.352044', '-6.259514'),
(999006, 'Digital Audio', 10, 'www.dspAudio.com', '2013-05-10', 'Aungier Street', '3025', '53.338545', '-6.26607'),
(999007, 'Digital Signal Processing', 10, 'www.dspGeneral.ie', '2013-04-04', 'Kevin Street', '2103', '53.337015', '-6.267933'),
(999008, 'History of Digital Media', 5, 'www.itsbeendone.ie', '2013-03-28', 'Aungier Street', '0120', '53.338545', '-6.26607'),
(999009, 'Digital Asset Management', 5, 'www.contentStore.ie', '2013-05-30', 'Bolton Street', '1004', '53.351406', '-6.268724'),
(999010, 'Production Skills', 10, 'www.webDevPro.ie', '2013-04-02', 'Aungier Street', '1089', '53.338545', '-6.26607');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(10) NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `date_published` datetime NOT NULL,
  `category` varchar(50) NOT NULL,
  `img_link` varchar(600) NOT NULL,
  `has_video` tinyint(1) NOT NULL,
  `video_link` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `date_published`, `category`, `img_link`, `has_video`, `video_link`) VALUES
(1, 'Headline one', 'Liquor ipsum dolor sit amet bearded lady, grog murphy\'s bourbon lancer. Kamikaze vodka gimlet; old rip van winkle, lemon drop martell salty dog tom collins smoky martini ben nevis man o\'war. Strathmill grand marnier sea breeze b & b mickey slim. Cactus jack aberlour seven and seven, beefeater early times beefeater kalimotxo royal arrival jack rose. Cutty sark scots whisky b & b harper\'s finlandia agent orange pink lady three wise men gin fizz murphy\'s.', '2019-05-01 02:30:00', 'academics', 'img/travel.jpg', 0, ''),
(2, 'Headline two', 'Liquor ipsum dolor sit amet bearded lady, grog murphy\'s bourbon lancer. Kamikaze vodka gimlet; old rip van winkle, lemon drop martell salty dog tom collins smoky martini ben nevis man o\'war. Strathmill grand marnier sea breeze b & b mickey slim. Cactus jack aberlour seven and seven, beefeater early times beefeater kalimotxo royal arrival jack rose. Cutty sark scots whisky b & b harper\'s finlandia agent orange pink lady three wise men gin fizz murphy\'s. Chartreuse french 75 brandy daisy widow\'s cork 7 crown ketel one captain morgan fleischmann\'s, hayride, edradour godfather. Long island iced tea choking hazard black bison, greyhound harvey wallbanger,gibbon kir royale salty dog tonic and tequila.Pisco sour daiquiri lejon bruichladdich mickey slim sea breeze wolfram kensington court special: pink lady white lady or delilah. Pisco sour glen spey, courvoisier j & b metaxas glenlivet tormore chupacabra, sambuca lorraine knockdhu gin and tonic margarita schenley\'s. Bumbo glen ord the macallan balvenie lemon split presbyterian old rip van winkle paradise gin sling. Myers black bison metaxa caridan linkwood three wise men blue hawaii wine cooler Talisker moonwalk cosmopolitan wolfram zurracapote glen garioch patron saketini brandy alexander, singapore sling', '2019-05-02 10:00:00', 'health', 'img/food.jpg', 0, ''),
(3, 'Headline three', 'Liquor ipsum dolor sit amet bearded lady, grog murphy\'s bourbon lancer. Kamikaze vodka gimlet; old rip van winkle, lemon drop martell salty dog tom collins smoky martini ben nevis man o\'war. Strathmill grand marnier sea breeze b & b mickey slim. Cactus jack aberlour seven and seven, beefeater early times beefeater kalimotxo royal arrival jack rose. Cutty sark scots whisky b & b harper\'s finlandia agent orange pink lady three wise men gin fizz murphy\'s. Chartreuse french 75 brandy daisy widow\'s cork 7 crown ketel one captain morgan fleischmann\'s, hayride, edradour godfather. Long island iced tea choking hazard black bison, greyhound harvey wallbanger,gibbon kir royale salty dog tonic and tequila.Pisco sour daiquiri lejon bruichladdich mickey slim sea breeze wolfram kensington court special: pink lady white lady or delilah. Pisco sour glen spey, courvoisier j & b metaxas glenlivet tormore chupacabra, sambuca lorraine knockdhu gin and tonic margarita schenley\'s. Bumbo glen ord the macallan balvenie lemon split presbyterian old rip van winkle paradise gin sling.', '2019-05-03 00:00:00', 'video', 'img/travel.jpg', 1, 'video/video.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `oauth_provider` enum('','facebook','google','twitter') COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `email`, `gender`, `locale`, `picture`, `link`, `created`, `modified`) VALUES
(1, 'facebook', '2302245200057298', 'Elmo', 'Elmo', 'haveyoumetelmo@gmail.com', 'male', '', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=2302245200057298&height=50&width=50&ext=1558598976&hash=AeRxuCsxrQq1UdYt', 'https://www.facebook.com/app_scoped_user_id/YXNpZADpBWEZAIR2dRNk5WaTVKaGRFRDhtaVFCMlV6bkFUV0l0dE02ampObmJ3WTd3SWtNRnRXQ01ZANkNRYWlRcV8zYm16bHdxanI2bU9uVWpSWC1BM0tOWXc4TkRHekVQWWNWWkl2QUFmZA0R2RmRDS0Qxd3ZAx/', '2019-04-22 15:27:15', '2019-04-23 08:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `user_moduleList`
--

CREATE TABLE `user_moduleList` (
  `id` int(11) NOT NULL,
  `oauth_uid` bigint(100) NOT NULL,
  `moduleNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_moduleList`
--

INSERT INTO `user_moduleList` (`id`, `oauth_uid`, `moduleNo`) VALUES
(12, 2302245200057298, 999010),
(17, 2302245200057298, 999002),
(18, 2302245200057298, 999008);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lecturerTable`
--
ALTER TABLE `lecturerTable`
  ADD PRIMARY KEY (`staffNumber`);

--
-- Indexes for table `lectureTimetable`
--
ALTER TABLE `lectureTimetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moduleTable`
--
ALTER TABLE `moduleTable`
  ADD PRIMARY KEY (`moduleNo`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_moduleList`
--
ALTER TABLE `user_moduleList`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lectureTimetable`
--
ALTER TABLE `lectureTimetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_moduleList`
--
ALTER TABLE `user_moduleList`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
