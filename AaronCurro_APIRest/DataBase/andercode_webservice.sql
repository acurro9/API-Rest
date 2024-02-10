-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2024 at 09:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

drop database if exists andercode_webservice;
create database andercode_webservice;
use andercode_webservice;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `andercode_webservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `tm_categoria`
--

CREATE TABLE `tm_categoria` (
  `cat_id` int(11) NOT NULL,
  `cat_nom` varchar(50) NOT NULL,
  `cat_obs` varchar(250) NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tm_categoria`
--

INSERT INTO `tm_categoria` (`cat_id`, `cat_nom`, `cat_obs`, `est`) VALUES
(1, 'Televisores', 'Observación TV', 1),
(2, 'Refrigeradoras', 'Observación Regrigeradoras', 1),
(3, 'Cocinas', 'Observación TV', 1),
(4, 'Lavadoras', 'Observación Regrigeradoras', 1),
(5, 'Actualizacion', 'Actualizacion Obs', 1);

--
-- Indexes for dumped tables
--
CREATE TABLE `tm_producto` (
  `pro_id` int NOT NULL,
  `pro_nom` varchar(50) NOT NULL,
  `pro_precio` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `cant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `tm_producto` (`pro_id`, `pro_nom`, `pro_precio`, `cat_id`, `cant`) VALUES
(1, 'Tv Samsung', 399, 1, 205),
(2, 'Lavadora Bosch', 699, 4, 100),
(3, 'Plancha de cocinar', 50, 3, 22),
(4, 'Hyper OS', 9, 5, 1000);
--
-- Indexes for table `tm_categoria`
--
ALTER TABLE `tm_categoria`
  ADD PRIMARY KEY (`cat_id`);

  ALTER TABLE `tm_producto`
  ADD PRIMARY KEY (`pro_id`);
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tm_categoria`
--
ALTER TABLE `tm_categoria`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

  ALTER TABLE `tm_producto`
  MODIFY `pro_id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE tm_producto
  ADD CONSTRAINT producto_ibfk_1 FOREIGN KEY (cat_id) REFERENCES tm_categoria (cat_id) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
