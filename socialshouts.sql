-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2016 at 06:12 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `socialbudd`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(11) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `date`, `user_id`) VALUES
(1, 'Hello Guys this is me', '2016-11-04 12:49:21', 2),
(2, 'My Second Post', '2016-11-04 12:50:09', 1),
(3, 'Hello Recruiters', '2016-11-04 13:04:47', 1),
(4, 'Hi Guys I am feeling alone any body can help?', '2016-11-04 13:29:01', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(64) NOT NULL,
  `name` text NOT NULL,
  `google_id` decimal(25,0) NOT NULL,
  `email` varchar(50) NOT NULL,
  `joined` datetime NOT NULL,
  `group` int(11) NOT NULL,
  `avator` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `name`, `google_id`, `email`, `joined`, `group`, `avator`) VALUES
(1, 'neo.xactor@gmail.com', 'ed2ab98113e1494ce3ac94948a7290d8', 'õ\\+ÿ"Õ?çèrÁU¹ëZ£§Ã.EìJ…Õ}]ÎÐŸL', 'leet khan', '118425759128767389076', 'neo.xactor@gmail.com', '2016-11-04 08:59:35', 1, 'https://lh4.googleusercontent.com/-MZGZwEAlLQY/AAAAAAAAAAI/AAAAAAAAAeo/d2UM4vnKdoE/photo.jpg?sz=50'),
(2, 'taskbucks344@gmail.com', 'd5eeaea1e0541889618690ce55c35f20', '`%‚¬›œ½ÿs¹þŒ‰‡ç‚.º­Çü9&S¾hß®x»', 'Shawn Tucker', '100659710226374222292', 'taskbucks344@gmail.com', '2016-11-04 13:25:17', 1, 'https://lh3.googleusercontent.com/-Wbq692_c9sc/AAAAAAAAAAI/AAAAAAAAAAw/3WrSk8NQd8w/photo.jpg?sz=50'),
(3, 'kh4n', '3ca079ec8d103747c3fbb65996d59dc922473921007bd31a6bdfca5110ba0d8a', 'Î²ƒëINÝcŸ\nÜ{«‡õªÐZof‹BZv­½\r', 'Shahid Kamal', '0', '', '2016-11-04 16:43:23', 1, 'styles/images/mm.png'),
(4, 'shawn', '7e1e49f6bb1fce3aae143d5e89ab2500f4c49266c06d978e3b798663586a9ec1', 'ØŠSöÏZ€½L”õÓ''>ô!¼>úùDòûN}Sê', 'Shawn Tucker', '0', '', '2016-11-04 16:49:34', 1, 'styles/images/mm.png'),
(5, 'anwar', '0e9202d2f68e68a42fdcde878d04c423f43e44a2b10fac22b75e6a1e8890baae', ':µ$¶‹Ÿ“g‘(!º´ÿ_}\Z£[¥TälÕPýî\\}Üeœ', 'Anwar Ali', '0', '', '2016-11-04 17:37:24', 1, 'styles/images/mm.png'),
(6, 'shoaib', '321ff8151cd00ad8ed6e019c8cf2f94e983ef66da58e60d9cde8a5bf8a5b9ab9', 'æÜ_Á3ì&y²¬[ûó½Zöž"(ós.YB«Ú%Á*', 'Shoaib Khan', '0', 'shoaib21295@gmail.com', '2016-11-04 17:40:25', 1, 'https://www.gravatar.com/avatar/d41d8cd98f00b204e9800998ecf8427e?d=mm&f=y&s=200');

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE IF NOT EXISTS `users_session` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_session`
--
ALTER TABLE `users_session`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
