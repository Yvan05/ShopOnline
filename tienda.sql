-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 27-03-2024 a las 15:18:05
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Battle royal'),
(2, 'Terror'),
(6, 'Mundo Abierto'),
(7, 'Historia'),
(8, 'Niños'),
(9, 'Deportes'),
(10, 'Accion'),
(11, 'Disparos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_pedido`
--

DROP TABLE IF EXISTS `lineas_pedido`;
CREATE TABLE IF NOT EXISTS `lineas_pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `paypal_id` int(11) NOT NULL,
  `unidades` int(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lineas_pedidos` (`pedido_id`),
  KEY `fk_lineas_productos` (`producto_id`),
  KEY `fk_lineas_payment` (`paypal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lineas_pedido`
--

INSERT INTO `lineas_pedido` (`id`, `pedido_id`, `producto_id`, `paypal_id`, `unidades`) VALUES
(29, 145, 12, 14, 3),
(30, 146, 12, 15, 1),
(31, 147, 24, 16, 1),
(32, 148, 18, 17, 1),
(33, 149, 18, 18, 1),
(34, 150, 18, 19, 1),
(35, 151, 29, 20, 1),
(36, 152, 29, 21, 2),
(37, 152, 18, 21, 1),
(38, 153, 29, 22, 2),
(39, 153, 18, 22, 1),
(40, 154, 29, 23, 2),
(41, 154, 18, 23, 1),
(42, 155, 13, 24, 2),
(43, 156, 13, 25, 2),
(44, 156, 27, 25, 2),
(45, 157, 13, 26, 2),
(46, 157, 17, 26, 1),
(47, 158, 30, 27, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_id` varchar(50) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `payment_id_user` varchar(25) NOT NULL,
  `payment_email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `payment`
--

INSERT INTO `payment` (`id`, `payment_id`, `payment_status`, `payment_id_user`, `payment_email`) VALUES
(14, '26E37346CW5850223', 'COMPLETED', 'PCV54M9T5LPYE', 'sb-meb43j22204030@personal.example.com'),
(15, '6GX526409K5194255', 'COMPLETED', 'PCV54M9T5LPYE', 'sb-meb43j22204030@personal.example.com'),
(16, '0V197271G6500232P', 'COMPLETED', 'PCV54M9T5LPYE', 'sb-meb43j22204030@personal.example.com'),
(17, '5BL019132L9743207', 'COMPLETED', 'PCV54M9T5LPYE', 'sb-meb43j22204030@personal.example.com'),
(18, '6N474654NW893350L', 'COMPLETED', 'PCV54M9T5LPYE', 'sb-meb43j22204030@personal.example.com'),
(19, '6BK58725AP9010627', 'COMPLETED', 'PCV54M9T5LPYE', 'sb-meb43j22204030@personal.example.com'),
(20, '8K454584YD184593J', 'COMPLETED', 'PCV54M9T5LPYE', 'sb-meb43j22204030@personal.example.com'),
(21, '0P420812AR590190G', 'COMPLETED', 'PCV54M9T5LPYE', 'sb-meb43j22204030@personal.example.com'),
(22, '03752073SR3412317', 'COMPLETED', 'PCV54M9T5LPYE', 'sb-meb43j22204030@personal.example.com'),
(23, '5R2930946C9559604', 'COMPLETED', 'PCV54M9T5LPYE', 'sb-meb43j22204030@personal.example.com'),
(24, '1UY14670GT595872E', 'COMPLETED', 'PCV54M9T5LPYE', 'sb-meb43j22204030@personal.example.com'),
(25, '7RA23891RH0297208', 'COMPLETED', 'PCV54M9T5LPYE', 'sb-meb43j22204030@personal.example.com'),
(26, '36C30733NR3259302', 'COMPLETED', 'PCV54M9T5LPYE', 'sb-meb43j22204030@personal.example.com'),
(27, '0YH794085M171305E', 'COMPLETED', 'PCV54M9T5LPYE', 'sb-meb43j22204030@personal.example.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `coste` float(200,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pedido_usuario` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `pais`, `estado`, `municipio`, `direccion`, `coste`, `status`, `fecha`, `hora`) VALUES
(145, 258, 'Afghanistan', 'Badakhshan', 'Jurm', 'valle calafia #2011', 1980.00, 'sended', '2022-12-09', '15:01:20'),
(146, 258, 'Albania', 'Bulqize', 'Bulqize', 'valle calafia #2011', 660.00, 'confirm', '2022-12-09', '15:11:18'),
(147, 258, 'Afghanistan', 'Badakhshan', 'Eshkashem', 'valle calafia #2011', 617.50, 'confirm', '2022-12-13', '10:48:13'),
(148, 258, 'Albania', 'Berat', 'Berat', 'valle calafia #2011', 297.00, 'confirm', '2022-12-13', '11:08:54'),
(149, 258, 'Afghanistan', 'Badakhshan', 'Eshkashem', 'valle calafia #2011', 297.00, 'confirm', '2022-12-13', '11:10:12'),
(150, 259, 'Afghanistan', 'Badakhshan', 'Eshkashem', 'valle calafia #2011', 297.00, 'confirm', '2022-12-13', '15:28:01'),
(151, 258, 'Afghanistan', 'Badgis', 'Bala Morghab', 'valle calafia #2011', 708.10, 'confirm', '2022-12-15', '11:06:48'),
(152, 258, 'Afghanistan', 'Badakhshan', 'Eshkashem', 'aasasasa', 1713.20, 'confirm', '2022-12-15', '12:15:05'),
(153, 258, 'Afghanistan', 'Badakhshan', 'Eshkashem', 'valle calafia #2011', 1713.20, 'confirm', '2022-12-15', '12:21:12'),
(154, 258, 'Afghanistan', 'Badakhshan', 'Eshkashem', 'valle calafia #2011', 1713.20, 'confirm', '2022-12-15', '12:27:05'),
(155, 258, 'Afghanistan', 'Badakhshan', 'Eshkashem', 'valle calafia #2011', 2548.00, 'confirm', '2022-12-15', '12:30:36'),
(156, 258, 'Albania', 'Berat', 'Berat', 'valle calafia #2011', 3100.00, 'confirm', '2022-12-15', '12:32:10'),
(157, 258, 'Afghanistan', 'Baglan', 'Andarab', 'valle calafia #2011', 3222.50, 'confirm', '2022-12-15', '12:36:47'),
(158, 258, 'Afghanistan', 'Badakhshan', 'Eshkashem', 'valle calafia #2011', 1520.00, 'confirm', '2022-12-15', '14:18:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  `oferta` varchar(2) DEFAULT NULL,
  `precio` float(100,2) NOT NULL,
  `stock` int(200) NOT NULL,
  `fecha` date DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_producto_categoria` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `descripcion`, `oferta`, `precio`, `stock`, `fecha`, `imagen`) VALUES
(11, 1, 'Fornite', 'Juego de disparos en tercera persona, con la caracteristica de construccion', '5', 600.00, 9, '2022-10-01', 'f_juego.png'),
(12, 1, 'Apex Leguends', 'Juego de disparos en primera persona con personajes y habilidades únicas ,juega en equipos y sobrevive', '12', 750.00, 1, '2022-10-02', 'apex.jpg'),
(13, 9, 'FIFA2023', 'Juego de deportes de futbol actual con los mejores equipos del mundo', '2', 1300.00, 3, '2022-10-03', 'Fifa.jpg'),
(14, 9, 'NBA 2K3', 'Juego de deporte de basquetbol con los mejores jugadores y equipos de la liga', '', 1100.00, 7, '2022-10-04', 'nba.jpg'),
(15, 8, 'Mario Party', 'Juego infantil de Nintendo con mucha diversión y minijuegos para jugar', '20', 450.00, 5, '2022-10-05', 'mparty.jpg'),
(16, 8, 'Mario Street', 'Juego de futbol con poderes ,mario y sus amigos juegan futbol y usan gran variedad de poderes', '', 250.00, 7, '2022-10-06', 'mario.jpg'),
(17, 10, 'Crash', 'Juego de carreras con mucha accion con los personajes de Crash ', '5', 710.00, 8, '2022-10-07', 'crash.jpg'),
(18, 10, 'Rocket Legue', 'Juego de carros jugando un partido de futbol con muchos poderes y diversion', '1', 300.00, 3, '2022-10-08', 'rocket.jpg'),
(19, 6, 'GTA V', 'Juego simulación de la vida con misiones y historia', '', 550.00, 58, '2022-10-09', 'gta.jpg'),
(20, 6, 'Zelda', 'Juego modo historia de Zelda explorando un nuevo mundo', '1', 800.00, 6, '2022-10-10', 'zelda.jpg'),
(21, 6, 'Spider Man', 'Juego de Marvel ,historia de Spiderman atrapando villanos y haciendo misiones', '3', 630.00, 3, '2022-10-11', 'spider.jpg'),
(22, 7, 'Ciber Punk', 'Juego futurista de misiones y mundo abierto', '2', 420.00, 4, '2022-10-12', 'ciber.jpg'),
(23, 7, 'Horizon', 'Juego de un mundo extraño con misiones increíbles y paisajes alucinantes', '2', 350.00, 0, '2022-10-13', 'horizon.jpg'),
(24, 2, 'Residen Evil', 'Juego de terror/acción con misiones y historia increíbles', '5', 650.00, 0, '2022-09-29', 'residen.jpg'),
(25, 6, 'Red Redemtion 2', 'Juego de misiones en un época del viejo oeste con historia y mecánicas nuevas', '5', 999.00, 2, '2022-09-27', 'rded.jpg'),
(26, 7, 'God Of War', 'Juego de accion / historia de los dioses del olimpo y cratos en busca de algo', '8', 470.00, 3, '2022-09-22', 'god.jpg'),
(27, 10, 'Call Of Duty', 'Juego de disparon en primera persona inspirado en la segunda guerra mundial', '8', 300.00, 0, '2022-09-02', 'Cod.jpg'),
(28, 10, 'Far Cry 5', 'Juego de mercenario y mundo abierto con misiones imposibles', '10', 1500.00, 0, '2022-09-17', 'farcry.jpg'),
(29, 10, 'Injustic 2', 'Juego de pelea con los personajes mas conocidos de los super héroes actuales y villanos', '3', 730.00, 0, '2022-10-02', 'injust.jpg'),
(30, 6, 'Elden Ring', 'Juego con misiones imposibles en busca de ser el mejor', '5', 1600.00, 7, '2022-10-11', 'elden.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rol` varchar(100) NOT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=261 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `rol`, `imagen`, `password`) VALUES
(258, 'Yael Ivan', 'Cruz', 'yaelivan16@gmail.com', 'administrador', 'perfil1.png', '$2y$04$JWhQ3wz/dgUy70Mt9auby.RGoVHX6DH9BL/JW8HR5E2kn4NLiHOqe'),
(259, 'yael', 'linares', 'yaelivan17@gmail.com', 'user', 'logo.png', '$2y$04$W5GWcd7hwclpQaPKfVJ4T.0h74BGp9OMuqKydOqjzS/24VKpkCh06');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineas_pedido`
--
ALTER TABLE `lineas_pedido`
  ADD CONSTRAINT `fk_lineas_payment` FOREIGN KEY (`paypal_id`) REFERENCES `payment` (`id`),
  ADD CONSTRAINT `fk_lineas_pedidos` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `fk_lineas_productos` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
