-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2023 at 11:43 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommercephp`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catId` int(11) NOT NULL,
  `Name` varchar(25) DEFAULT NULL,
  `description` varchar(25) DEFAULT NULL,
  `imgUrl` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catId`, `Name`, `description`, `imgUrl`) VALUES
(21, 'CVs', 'The Best CVS int Ther Wor', '1686690437_imgbox-1-277x277.jpg'),
(22, 'Fruits', 'Best Fruits', '1686690445_imgbox-1-370x270.jpg'),
(23, 'Glass', 'The Base Glass', '1686690454_imgbox-2-576x300.jpg'),
(24, 'Mirrors', 'House Mirrors for best fa', '1686690463_imgbox-2-375x240.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `colorId` int(11) NOT NULL,
  `Name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`colorId`, `Name`) VALUES
(18, 'Black'),
(37, 'Red');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pId` int(11) NOT NULL,
  `Name` varchar(25) DEFAULT NULL,
  `shortDesc` varchar(100) DEFAULT NULL,
  `longDesc` varchar(1000) DEFAULT NULL,
  `imgUrl` varchar(250) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `catId` int(11) DEFAULT NULL,
  `colorId` int(11) DEFAULT NULL,
  `Status` bit(1) DEFAULT NULL,
  `featuredProduct` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pId`, `Name`, `shortDesc`, `longDesc`, `imgUrl`, `Price`, `catId`, `colorId`, `Status`, `featuredProduct`) VALUES
(7, 'Black', 'short description short description short descriptionshort description', 'long Description long Description\r\nlong Description\r\nlong Description\r\nlong Descriptionlong Descriptionlong Descriptionlong Descriptionlong Descriptionlong Descriptionlong Descriptionlong Descriptionlong Description', '1683394166_8.jpg', 4555, 21, 18, b'1', b'1'),
(8, 'Red', 'The Best Discription', 'Long description', '1684520878_imgbox-1-576x300.jpg', 250, 23, 37, b'1', b'1'),
(9, 'Saqib Jato', 'sdfs', 'sdf', '1684520969_gallery-2-870x377.jpg', 234, 22, 18, b'1', b'1'),
(10, 'Muhammad Boota', 'sdfsdf', 'sdsdf', '1684520999_gallery-1-870x377.jpg', 400, 21, 18, b'0', b'1'),
(11, 'M Arshaad', 'asdf', 'sdf', '1684523349_instagram-2-337x280.jpg', 4555, 21, 18, b'1', b'0'),
(12, 'Black', 'sdfsdf', 'sdfsdf', '1684523818_instagram-5-337x280.jpg', 4444, 21, 18, b'1', b'0'),
(13, 'AAAA', 'sdfsdfs', 'sdfsd', '1684528715_1.jpg', 4555, 21, 18, b'1', b'1'),
(14, 'Black', 'this is skdfsdkf', 'skdfkdskf', '1684528757_2.jpg', 4000, 21, 18, b'1', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `tblconfig`
--

CREATE TABLE `tblconfig` (
  `id` int(11) NOT NULL,
  `commonKey` varchar(25) DEFAULT NULL,
  `value` varchar(500) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblconfig`
--

INSERT INTO `tblconfig` (`id`, `commonKey`, `value`, `status`) VALUES
(31, 'sdfsdf', 'imgbox-2-455x455.jpg', 1),
(32, 'PK', 'imgbox-1-1173x620.jpg', 0),
(33, 'PK', 'bg-parallax4.jpg', 0),
(34, 'PK', 'slider-bg-7.jpg', 0),
(35, 'PK', '5.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uId` int(11) NOT NULL,
  `uName` varchar(25) DEFAULT NULL,
  `uEmail` varchar(50) DEFAULT NULL,
  `uPassword` varchar(50) DEFAULT NULL,
  `uPhone` varchar(15) DEFAULT NULL,
  `uGender` bit(1) DEFAULT NULL,
  `uImageUrl` varchar(25) DEFAULT NULL,
  `uRole` bit(1) NOT NULL DEFAULT b'0',
  `uStatus` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uId`, `uName`, `uEmail`, `uPassword`, `uPhone`, `uGender`, `uImageUrl`, `uRole`, `uStatus`) VALUES
(7, 'MBoota', 'm43577535@gmail.com', '12345', '03122383525', b'1', '1684071835CV_3.png', b'1', b'0'),
(8, 'rr', 'saqib@gmail.com', '12345', '23324', b'1', NULL, b'0', b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`colorId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pId`),
  ADD KEY `catId` (`catId`),
  ADD KEY `colorId` (`colorId`);

--
-- Indexes for table `tblconfig`
--
ALTER TABLE `tblconfig`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `colorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblconfig`
--
ALTER TABLE `tblconfig`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`catId`) REFERENCES `category` (`catId`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`colorId`) REFERENCES `color` (`colorId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
