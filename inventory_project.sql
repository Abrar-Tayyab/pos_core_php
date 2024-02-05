-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 11, 2020 at 05:11 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `bid` int(255) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) NOT NULL,
  PRIMARY KEY (`bid`),
  UNIQUE KEY `brand_name` (`brand_name`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`bid`, `brand_name`) VALUES
(18, 'Honda'),
(19, 'HP'),
(15, 'lenovo'),
(17, 'LG'),
(16, 'Nokia'),
(4, 'oppo'),
(11, 'samsung'),
(8, 'sony');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cid` int(255) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`cid`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cid`, `category_name`) VALUES
(14, 'Charger'),
(3, 'laptop'),
(17, 'LCD'),
(10, 'mobile');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `oid` int(255) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(255) NOT NULL,
  `product_qty` int(255) NOT NULL,
  `total_amount` int(255) NOT NULL,
  `added_date` date NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`oid`, `category_name`, `brand_name`, `product_name`, `product_price`, `product_qty`, `total_amount`, `added_date`) VALUES
(7, 'mobile', 'moto', 'moto e', 12000, 2, 24000, '2019-03-03'),
(9, 'mobile', 'samsung', 'j7', 16000, 16, 256000, '2019-03-06'),
(10, 'mobile', 'samsung', 'j5', 18000, 12, 216000, '2019-03-06'),
(11, 'mobile', 'moto', 'moto e', 12000, 2, 24000, '2019-03-19'),
(12, 'mobile', 'samsung', 'j5', 18000, 12, 216000, '2019-03-19'),
(13, 'mobile', 'samsung', 'j5', 18000, 12, 216000, '2019-03-19'),
(14, 'mobile', 'samsung', 'j5', 18000, 12, 216000, '2019-03-19'),
(15, 'mobile', 'samsung', 'j5', 18000, 12, 216000, '2019-03-19'),
(16, 'mobile', 'samsung', 'j5', 18000, 12, 216000, '2019-03-19'),
(17, 'mobile', 'moto', 'moto e', 12000, 2, 24000, '2019-03-19'),
(18, 'mobile', 'moto', 'moto e', 12000, 2, 24000, '2019-03-19'),
(19, 'mobile', 'samsung', 'j5', 18000, 10, 180000, '2019-07-22'),
(20, 'mobile', 'samsung', 'j5', 18000, 2, 36000, '2019-07-22'),
(21, 'laptop', 'lenovo', 'Core i5 2nd Generation', 35000, 3, 105000, '2019-07-28'),
(22, 'laptop', 'lenovo', 'Core i5 2nd Generation', 35000, 1, 35000, '2019-07-28'),
(23, 'mobile', 'Nokia', '1112', 2000, 24, 48000, '2019-08-29'),
(24, 'laptop', 'oppo', 'core i7 2nd Generation', 45000, 2, 90000, '2019-08-29'),
(25, 'LCD', 'HP', '5 inch', 25000, 11, 275000, '2019-08-29'),
(26, 'laptop', 'oppo', 'core i7 2nd Generation', 45000, 1, 45000, '2019-09-24'),
(27, 'mobile', 'lenovo', 'moto e4', 15000, 10, 150000, '2019-09-24'),
(28, 'mobile', 'lenovo', 'moto e4', 15000, 2, 30000, '2019-09-24'),
(29, 'mobile', 'lenovo', 'moto e4', 15000, 1, 15000, '2019-09-24'),
(30, 'Bike', 'Honda', '125', 95000, 2, 190000, '2019-09-24'),
(31, 'laptop', 'oppo', 'core i7 2nd Generation', 45000, 2, 90000, '2019-09-24'),
(32, 'Bike', 'Honda', '125', 95000, 2, 190000, '2019-09-30');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `pid` int(255) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(255) NOT NULL,
  `product_qty` int(255) NOT NULL,
  `added_date` date NOT NULL,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `product_name` (`product_name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `category_name`, `brand_name`, `product_name`, `product_price`, `product_qty`, `added_date`) VALUES
(2, 'mobile', 'lenovo', 'moto e4', 15000, 10, '2019-08-29'),
(3, 'mobile', 'moto', 'moto e', 12000, 2, '2019-02-28'),
(5, 'mobile', 'samsung', 'j5', 18000, 0, '2019-03-03'),
(6, 'laptop', 'lenovo', 'Core i5 2nd Generation', 35000, 1, '2019-07-22'),
(8, 'Bike', 'Honda', '125', 95000, 6, '2019-08-29'),
(9, 'mobile', 'Nokia', '1112', 2000, 0, '2019-08-29'),
(10, 'laptop', 'oppo', 'core i7 2nd Generation', 45000, 0, '2019-08-29'),
(11, 'LCD', 'HP', '5 inch', 25000, 0, '2019-08-29');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `register_date` date NOT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `register_date`) VALUES
(1, 'Abrar', 'abrar@mail.com', '1234', '0000-00-00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
