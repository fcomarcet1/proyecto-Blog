-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 31-08-2020 a las 09:59:36
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `blog_master`
--
CREATE DATABASE IF NOT EXISTS `blog_master` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `blog_master`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--



DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `idcategoria` int NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idcategoria`, `nombre_categoria`) VALUES
(1, 'Accion'),
(2, 'Rol'),
(3, 'Deportes'),
(4, 'Plataformas'),
(5, 'Arcade');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

DROP TABLE IF EXISTS `entradas`;
CREATE TABLE IF NOT EXISTS `entradas` (
  `identrada` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_categoria` int NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` mediumtext,
  `fecha_entrada` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`identrada`),
  KEY `fk_entrada_usuario` (`id_usuario`),
  KEY `fk_entrada_categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`identrada`, `id_usuario`, `id_categoria`, `titulo`, `descripcion`, `fecha_entrada`) VALUES
(1, 1, 1, 'Novedades GTA 5 Onine,', 'Review de GTA 5 Online', '2020-08-27 20:55:40'),
(2, 1, 2, 'Review LOL online.', 'Todo sobre el LOL.', '2020-08-28 11:13:16'),
(3, 1, 3, 'Nuevos fichajes en FIFA 20', 'Review de FIFA 20', '2020-08-28 11:13:16'),
(4, 2, 1, 'Novedades Assasins Online', 'Review sobre Assasins online.', '2020-08-28 11:16:07'),
(5, 2, 2, 'Nueva Expansion WoW Shadowlands.', 'Todo sobre la nueva expansion de wow.', '2020-08-28 11:16:07'),
(6, 2, 3, 'Nuevos jugadores en PES 2020', 'Review de los nuevos jugadores de PES 2020.', '2020-08-28 11:18:19'),
(7, 3, 1, 'Novedades Call of Duty Online', 'Review de COD.', '2020-08-28 11:18:19'),
(8, 3, 1, 'Review Fornite Online', 'Todo sobre Fornite Online.', '2020-08-28 11:20:32'),
(9, 3, 3, 'Nuevos circuitos en ACC', 'Review de los nuevos circuitos de ACC', '2020-08-28 11:20:32'),
(10, 3, 1, 'Guia GTA Vice City.', 'GTA Vice City.', '2020-08-28 11:21:46'),
(11, 1, 2, 'Jugando con SQL.', 'Todo sobre SQL.', '2020-08-28 11:21:46'),
(12, 1, 2, 'dark souls', 'Hdlkajdlakjsdljaskdlkasjdlaksjdlakjdlk\r\nasñldañldkañlkdañldkñ', '2020-08-31 09:52:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuario` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_usuario` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `uq_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre`, `apellidos`, `email`, `password`, `fecha_usuario`) VALUES
(1, 'admin', 'admin', 'admin@admin.es', '$2y$04$smrVqDykseRsPHteU.8wGOd211CnhANXoXha3giWwJt3j4RaqokyO', '2020-08-29 10:11:15'),
(2, 'invitado', 'invitado', 'invitado@mail.es', '$2y$04$GYRRa2IDhEdndNVicWnUAuteA1i4of7xn4pvXpCwl87T5Ei6es37O', '2020-08-29 10:13:05'),
(3, 'fco', 'marcet prieto', 'fcomarcet1@gmail.com', '$2y$04$l3snvYdg1vJ72cW81edlTeFilJNvuw8WVf3TocFEDjEz4jVmJJwU6', '2020-08-29 10:14:02');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `fk_entrada_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`idcategoria`) ,
  ADD CONSTRAINT `fk_entrada_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
