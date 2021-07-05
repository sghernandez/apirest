-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2021 at 10:11 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apirest`
--

-- --------------------------------------------------------

--
-- Table structure for table `Paciente`
--

CREATE TABLE `Paciente` (
  `id_Paciente` int(11) NOT NULL,
  `Paciente_documento` varchar(45) DEFAULT NULL,
  `Paciente_nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Paciente`
--

INSERT INTO `Paciente` (`id_Paciente`, `Paciente_documento`, `Paciente_nombre`) VALUES
(9, '987654321', 'Test John'),
(10, '1124578', 'Karol Mena'),
(11, '987654323', 'Fidelino Camacho'),
(12, '11245733', 'Karol Mena');

-- --------------------------------------------------------

--
-- Table structure for table `Usuario`
--

CREATE TABLE `Usuario` (
  `id_Usuario` int(11) NOT NULL,
  `Usuario_usuario` varchar(45) DEFAULT NULL,
  `Usuario_password` varchar(45) DEFAULT NULL,
  `Usuario_estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Usuario`
--

INSERT INTO `Usuario` (`id_Usuario`, `Usuario_usuario`, `Usuario_password`, `Usuario_estado`) VALUES
(1, 'usuario1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(2, 'usuario2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(3, 'usuario3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(4, 'usuario4@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(5, 'usuario5@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(6, 'usuario6@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(7, 'usuario7@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Inactivo'),
(8, 'usuario8@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Inactivo'),
(9, 'usuario9@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Inactivo');

-- --------------------------------------------------------

--
-- Table structure for table `Usuario_token`
--

CREATE TABLE `Usuario_token` (
  `id_Usuario_token` int(11) NOT NULL,
  `Usuario_id` varchar(45) DEFAULT NULL,
  `Usuario_token_token` varchar(45) DEFAULT NULL,
  `Usuario_token_estado` varchar(45) CHARACTER SET armscii8 DEFAULT NULL,
  `Usuario_token_fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Usuario_token`
--

INSERT INTO `Usuario_token` (`id_Usuario_token`, `Usuario_id`, `Usuario_token_token`, `Usuario_token_estado`, `Usuario_token_fecha`) VALUES
(1, '1', 'bf677f0379f82ca2b04a90d61e6c5033', 'Activo', '2021-06-28 16:35:00'),
(2, '1', '0b3e79d2f0be55d89d6ed387a974ab54', 'Activo', '2021-06-28 22:09:00'),
(3, '1', '31ce549f5256ed80c486ce97861e1d33', 'Activo', '2021-06-28 23:26:00'),
(4, '1', '4e1aa375802266978c8371996ce2081b', 'Activo', '2021-06-28 23:26:00'),
(5, '1', '0e9e53976365b601621292f9cc3b043d', 'Activo', '2021-06-28 23:26:00'),
(6, '1', 'bd4d76d833ccf37d6d168a1883648d81', 'Activo', '2021-06-28 23:27:00'),
(7, '1', '21f4e931984c57cd4e853bfa10a88b65', 'Activo', '2021-06-28 23:28:00'),
(8, '1', 'b89689e2535f5d76c20a1de73a6f8d95', 'Activo', '2021-06-28 23:28:00'),
(9, '1', 'ca84566f015088a756fafa91a9a31e15', 'Activo', '2021-07-05 21:39:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Paciente`
--
ALTER TABLE `Paciente`
  ADD PRIMARY KEY (`id_Paciente`);

--
-- Indexes for table `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`id_Usuario`);

--
-- Indexes for table `Usuario_token`
--
ALTER TABLE `Usuario_token`
  ADD PRIMARY KEY (`id_Usuario_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Paciente`
--
ALTER TABLE `Paciente`
  MODIFY `id_Paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Usuario_token`
--
ALTER TABLE `Usuario_token`
  MODIFY `id_Usuario_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
