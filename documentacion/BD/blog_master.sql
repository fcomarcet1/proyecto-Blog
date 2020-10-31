-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 25-08-2020 a las 09:22:40
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

DROP TABLE IF EXISTS `entradas`;
CREATE TABLE IF NOT EXISTS `entradas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `categoria_id` int NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` mediumtext,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_entrada_usuario` (`usuario_id`),
  KEY `fk_entrada_categoria` (`categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `fk_entrada_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `fk_entrada_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `fecha`) VALUES
(1, 'admin', 'admin', 'admin@admin.es', '$2y$04$smrVqDykseRsPHteU.8wGOd211CnhANXoXha3giWwJt3j4RaqokyO', '2020-08-29 10:11:15'),
(2, 'invitado', 'invitado', 'invitado@mail.es', '$2y$04$GYRRa2IDhEdndNVicWnUAuteA1i4of7xn4pvXpCwl87T5Ei6es37O', '2020-08-29 10:13:05'),
(3, 'fco', 'marcet prieto', 'fcomarcet1@gmail.com', '$2y$04$l3snvYdg1vJ72cW81edlTeFilJNvuw8WVf3TocFEDjEz4jVmJJwU6', '2020-08-29 10:14:02');


INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Accion'),
(2, 'Rol'),
(3, 'Deportes'),
(4, 'Plataformas'),
(5, 'Arcade');


INSERT INTO `entradas` (`id`, `usuario_id`, `categoria_id`, `titulo`, `descripcion`, `fecha`) VALUES
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
