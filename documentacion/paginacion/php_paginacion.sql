-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-03-2018 a las 13:14:51
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `php_paginacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `alumno_id` int(11) NOT NULL,
  `nombres` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `telefonos` varchar(20) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`alumno_id`, `nombres`, `telefonos`) VALUES
(1, 'Jhon F. Connor', '987686543'),
(2, 'Juan M. Cardenas', '345768797'),
(3, 'Luis Gallesse', '98655-9765'),
(4, 'Armando V. Vicent', '876445-9876'),
(5, 'Maria H. Casas', '765-9876'),
(6, 'Francisco J. Zac', '7545535-9766'),
(7, 'German G. Benites', '089786564'),
(8, 'Hector J. Neon', '9797864453'),
(9, 'Lucas K. Caceres', '8685-9978'),
(10, 'King L. Baron', '8675757-98'),
(11, 'Moises H. Varas', '796968575'),
(12, 'Trader F. Morales', '99797979'),
(13, 'Wen V. Marlon', '979786875'),
(14, 'Pones M. Casas', '98675757'),
(15, 'Emirat B. Den', '8868686'),
(16, 'Filomena Y. Vaca', '0978686'),
(17, 'Genesis V. Joon', '86868686'),
(18, 'Lucia T. Baca', '77585886'),
(19, 'Nilda G. Yanes', '878878878'),
(20, 'Nestor J. Dante', '7686868'),
(21, 'Jhon F. Connor', '987686543'),
(22, 'Juan M. Cardenas', '345768797'),
(23, 'Luis Gallesse', '98655-9765'),
(24, 'Armando V. Vicent', '876445-9876'),
(25, 'Maria H. Casas', '765-9876'),
(26, 'Francisco J. Zac', '7545535-9766'),
(27, 'German G. Benites', '089786564'),
(28, 'Hector J. Neon', '9797864453'),
(29, 'Lucas K. Caceres', '8685-9978'),
(30, 'King L. Baron', '8675757-98'),
(31, 'Moises H. Varas', '796968575'),
(32, 'Trader F. Morales', '99797979'),
(33, 'Wen V. Marlon', '979786875'),
(34, 'Pones M. Casas', '98675757'),
(35, 'Emirat B. Den', '8868686'),
(36, 'Filomena Y. Vaca', '0978686'),
(37, 'Genesis V. Joon', '86868686'),
(38, 'Lucia T. Baca', '77585886'),
(39, 'Nilda G. Yanes', '878878878'),
(40, 'Nestor J. Dante', '7686868');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`alumno_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `alumno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
