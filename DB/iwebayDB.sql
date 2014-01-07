-- phpMyAdmin SQL Dump
-- version 4.1.3
-- http://www.phpmyadmin.net
--
-- Host: db4free.net:3306
-- Generation Time: Jan 07, 2014 at 07:32 PM
-- Server version: 5.6.15
-- PHP Version: 5.3.10-1ubuntu3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `iwebay`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `categoria` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`categoria`) VALUES
('Coleccionismo y Arte'),
('Deportes y Tiempo Libre'),
('Electrónica'),
('Entretenimiento'),
('Hogar y Decoración'),
('Joyería y Belleza'),
('Moda'),
('Motor');

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `detalles` text COLLATE utf8_spanish_ci NOT NULL,
  `precio_inicial` double NOT NULL,
  `precio_compra_ya` double DEFAULT NULL,
  `destacado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=29 ;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `estado`, `cantidad`, `detalles`, `precio_inicial`, `precio_compra_ya`, `destacado`) VALUES
(1, 'producto 1', 'nuevo', 100, 'todos', 100, 123, 1),
(2, 'producto 2', 'usado', 1, 'menos', 12, NULL, 0),
(4, 'prueba union tablas', 'Nuevo', 2, 'zaxdfc', 3, 5, 0),
(5, 'prueba union 2', 'Usado', 4, 'qwerty', 45, 64, 0),
(6, 'asdadad', 'Nuevo', 5, 'asdas', 6, 7, 0),
(7, 'Primera prueba dia', 'Gastado', 7, 'A ver si con las modificaciones esto va', 4, 9, 0),
(8, 'Segunda prueba del dia', 'Usado', 8, 'blabla', 7, 9, 0),
(9, 'Tercera prueba, si será por intentos...', 'Nuevo', 5, 'afafs', 9, 14, 0),
(10, 'Cuarta y subiendo', 'Roto', 4, 'dasfa', 5, 9, 0),
(11, 'asdasd', 'Nuevo', 2131, 'sdffv', 63, 66, 0),
(12, 'Hola holita', 'Nuevo', 4, 'sadd', 5, 6, 0),
(13, 'Prueba definitiva', 'Nuevo', 4, 'asdf', 2, 3, 0),
(14, 'Supuestamente ya mete la categoria al prod', 'Nuevo', 4, 'adffad', 2, 6, 0),
(15, 'Cascos MASMOLA3k', 'Nuevo', 1, 'Son negros, y punto.', 17, 75, 1),
(17, 'Gratitud', 'Nuevo', 1, 'Son negros, y punto.', 17, 75, 1),
(18, 'Corazon de melon', 'Nuevo', 25, 'Moal mil', 12, 125, 1),
(19, 'jijijijijijjjijij', 'Nuevo', 25, 'Moal mil', 12, 125, 0),
(20, 'Prueba de que esto no falla', 'Usado', 1, 'dfaf', 3, 5, 0),
(21, 'sdfwdf', 'Nuevo', 2, 'asddassd', 3, 5, 0),
(22, 'sdafas', 'Nuevo', 2, 'asdasdf', 5, 9, 0),
(23, 'Microfono', 'Nuevo', 1, 'dasda', 12, 125, 1),
(24, 'Prueba buena', 'Usado', 1, 'dsad', 4, 5, 0),
(25, 'Producto prueba restricción', 'Usado', 4, 'asdfa', 6, 4, 0),
(26, 'Aprobado en IW', 'Nuevo', 1, 'Apruebe fácilmente la asignatura de IW', 120, 250, 1),
(27, 'Pantallaza PRO', 'Nuevo', 1, 'Mola mil esta pantalla, ya verás', 210, 315, 0),
(28, 'Pantallaza PRO', 'Nuevo', 1, 'Mola mil esta pantalla, ya verás', 210, 315, 0);

-- --------------------------------------------------------

--
-- Table structure for table `producto_a_categoria`
--

CREATE TABLE `producto_a_categoria` (
  `producto_id` int(11) NOT NULL,
  `categoria_id` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`producto_id`,`categoria_id`),
  UNIQUE KEY `producto_id` (`producto_id`,`categoria_id`),
  UNIQUE KEY `producto_id_2` (`producto_id`,`categoria_id`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `producto_a_categoria`
--

INSERT INTO `producto_a_categoria` (`producto_id`, `categoria_id`) VALUES
(24, 'Deportes y Tiempo Libre'),
(25, 'Deportes y Tiempo Libre'),
(15, 'Electrónica'),
(26, 'Electrónica'),
(14, 'Entretenimiento'),
(27, 'Entretenimiento'),
(28, 'Entretenimiento'),
(18, 'Moda'),
(22, 'Moda'),
(23, 'Moda');

-- --------------------------------------------------------

--
-- Table structure for table `puja`
--

CREATE TABLE `puja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` double NOT NULL,
  `fecha` date NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `subasta_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `subasta_id` (`subasta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `puja`
--

INSERT INTO `puja` (`id`, `cantidad`, `fecha`, `usuario_id`, `subasta_id`) VALUES
(1, 4, '2006-01-14', 2, 2),
(2, 5, '2006-01-14', 1, 2),
(3, 5, '2006-01-14', 1, 2),
(4, 4, '2006-01-14', 1, 2),
(5, 5, '2006-01-14', 1, 2),
(6, 5, '2006-01-14', 1, 2),
(7, 6, '2006-01-14', 1, 2),
(8, 15, '2007-01-14', 2, 5),
(9, 130, '2007-01-14', 2, 8),
(10, 140, '2007-01-14', 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `subasta`
--

CREATE TABLE `subasta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_fin` date NOT NULL,
  `compra_ya` tinyint(1) NOT NULL DEFAULT '0',
  `tipo_envio` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `forma_pago` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `gastos_envio` double NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `producto_id_UNIQUE` (`producto_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `producto_subasta_idx` (`producto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `subasta`
--

INSERT INTO `subasta` (`id`, `descripcion`, `fecha_fin`, `compra_ya`, `tipo_envio`, `forma_pago`, `gastos_envio`, `usuario_id`, `producto_id`) VALUES
(2, 'asdsd', '2016-03-03', 0, 'Urgente', 'PayPal', 4, 1, 14),
(3, 'Croazon de melon', '2014-12-13', 0, 'Urgente', 'PayPal', 12, 2, 18),
(5, 'hehehe', '0014-02-12', 0, 'Urgente', 'PayPal', 1, 2, 23),
(8, 'Aprobado en IW', '2014-01-13', 0, 'Urgente', 'PayPal', 4, 2, 26),
(9, 'Pantalla programatoriumsun', '0014-02-19', 0, 'Urgente', 'TCredito', 12, 1, 28);

-- --------------------------------------------------------

--
-- Table structure for table `tienda`
--

CREATE TABLE `tienda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `imagen` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tienda`
--

INSERT INTO `tienda` (`id`, `nombre`, `descripcion`, `imagen`) VALUES
(4, 'Tienda de Pedro', 'Sobreescribiodeadanssdandaj das?=', NULL),
(5, 'Tienda de Pablo', 'anviaopoihfañsoef asldkfnpae apndifanpesora asdjfapsñeia', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `tienda_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tienda_id_2` (`tienda_id`),
  KEY `tienda_id` (`tienda_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `userName`, `password`, `email`, `direccion`, `telefono`, `fecha_nacimiento`, `tienda_id`) VALUES
(1, 'pedro', 'pedro', 'pedro@ua.es', 'MODIFICADA', '687463529', '1990-06-13', NULL),
(2, 'Pablo', 'pablo', 'pabyspam@gmail.com', 'Alicante', '', '1990-06-13', NULL),
(4, 'admin', 'admin', 'admin@admin.com', 'Nada', '666666666', '1990-06-13', NULL),
(6, 'prueba', 'prueba', 'prueba@jeje.com', 'asjsa', 'asd', '2301-12-13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usuario_a_tienda`
--

CREATE TABLE `usuario_a_tienda` (
  `usuario_id` int(11) NOT NULL,
  `tienda_id` int(11) NOT NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `tienda_id_UNIQUE` (`tienda_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `usuario_a_tienda`
--

INSERT INTO `usuario_a_tienda` (`usuario_id`, `tienda_id`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `voto`
--

CREATE TABLE `voto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `positivo` tinyint(1) NOT NULL,
  `comentario` text COLLATE utf8_spanish_ci,
  `votante_id` int(11) DEFAULT NULL,
  `votado_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `votante_id` (`votante_id`,`votado_id`),
  KEY `votante_id_2` (`votante_id`,`votado_id`),
  KEY `votado_id` (`votado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `voto`
--

INSERT INTO `voto` (`id`, `positivo`, `comentario`, `votante_id`, `votado_id`) VALUES
(1, 1, 'Buen vendedor. Rápido y eficaz. Buena comunicación			', 2, 1),
(2, 0, 'Menudo cabrón. Además de que me llegó todo tarde y roto, me robó a mi novia.	', 2, 1),
(3, 1, 'Peta?', 2, 1),
(4, 1, 'Dildo comprado correctamente.', 2, 1),
(5, 1, 'Prueba de mensaje de confirmación.', 2, 1),
(6, 1, '			', 1, 1),
(7, 1, 'boom', 2, 1),
(8, 0, 'Ya funciona jejeje', 2, 1),
(9, 1, '			', 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `producto_a_categoria`
--
ALTER TABLE `producto_a_categoria`
  ADD CONSTRAINT `producto_a_categoria_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_a_categoria_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `puja`
--
ALTER TABLE `puja`
  ADD CONSTRAINT `puja_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `puja_subasta` FOREIGN KEY (`subasta_id`) REFERENCES `subasta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subasta`
--
ALTER TABLE `subasta`
  ADD CONSTRAINT `producto_subasta` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subasta_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuario_a_tienda`
--
ALTER TABLE `usuario_a_tienda`
  ADD CONSTRAINT `tienda` FOREIGN KEY (`tienda_id`) REFERENCES `tienda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `voto`
--
ALTER TABLE `voto`
  ADD CONSTRAINT `votante_usuario` FOREIGN KEY (`votante_id`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `votado_usuario` FOREIGN KEY (`votado_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
