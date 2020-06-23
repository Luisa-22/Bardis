-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-06-2020 a las 20:52:28
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bardis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_administrador`
--

CREATE TABLE `tbl_administrador` (
  `cedula_administrador` varchar(11) NOT NULL,
  `nombre_establecimiento` varchar(80) NOT NULL,
  `nombre1_administrador` varchar(30) NOT NULL,
  `nombre2_administrador` varchar(30) DEFAULT NULL,
  `apellido1_administrador` varchar(25) NOT NULL,
  `apellido2_administrador` varchar(25) DEFAULT NULL,
  `correo_administrador` varchar(80) NOT NULL,
  `celular1_administrador` varchar(12) NOT NULL,
  `clave_administrador` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_administrador`
--

INSERT INTO `tbl_administrador` (`cedula_administrador`, `nombre_establecimiento`, `nombre1_administrador`, `nombre2_administrador`, `apellido1_administrador`, `apellido2_administrador`, `correo_administrador`, `celular1_administrador`, `clave_administrador`) VALUES
('1000204858', 'Alma Bendita', 'Camilo', 'Andres', 'Perez', 'Toro', 'cperez@gmail.com', '3205334902', 'almab');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cancion`
--

CREATE TABLE `tbl_cancion` (
  `id_cancion` int(11) NOT NULL,
  `nombre_cancion` varchar(60) NOT NULL,
  `nombre_interprete` varchar(60) DEFAULT NULL,
  `cedula_administrador` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_cancion`
--

INSERT INTO `tbl_cancion` (`id_cancion`, `nombre_cancion`, `nombre_interprete`, `cedula_administrador`) VALUES
(1, 'Rojo', 'J Balvin', '1000204858'),
(2, 'Sin sentimiento', 'Grupo Niche', '1000204858'),
(3, 'Deseándote', 'Frankie Ruiz', '1000204858'),
(4, 'Gris', 'J Balvin', '1000204858');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categoria`
--

CREATE TABLE `tbl_categoria` (
  `id_categoria` varchar(7) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_categoria`
--

INSERT INTO `tbl_categoria` (`id_categoria`, `nombre_categoria`) VALUES
('C01', 'Comidas'),
('C02', 'Cervezas'),
('C03', 'Rones'),
('C04', 'Whiskeys'),
('C05', 'Shots'),
('C06', 'Vinos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cliente`
--

CREATE TABLE `tbl_cliente` (
  `documento_cliente` varchar(11) NOT NULL,
  `nombre_cliente` varchar(50) NOT NULL,
  `correo_cliente` varchar(80) NOT NULL,
  `edad_cliente` int(11) NOT NULL,
  `clave_cliente` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_cliente`
--

INSERT INTO `tbl_cliente` (`documento_cliente`, `nombre_cliente`, `correo_cliente`, `edad_cliente`, `clave_cliente`) VALUES
('1000207386', 'LuisaVelez', 'luisafer622@gmail.com', 18, 'luisa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cliente_cancion`
--

CREATE TABLE `tbl_cliente_cancion` (
  `documento_cliente` varchar(11) NOT NULL,
  `id_cancion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_cliente_cancion`
--

INSERT INTO `tbl_cliente_cancion` (`documento_cliente`, `id_cancion`) VALUES
('1000207386', 1),
('1000207386', 2),
('1000207386', 3),
('1000207386', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_copia_pedido`
--

CREATE TABLE `tbl_copia_pedido` (
  `id_pedido1` int(11) DEFAULT NULL,
  `total1` float DEFAULT NULL,
  `fecha1` date DEFAULT NULL,
  `numero_mesa1` int(11) DEFAULT NULL,
  `id_estado1` varchar(7) DEFAULT NULL,
  `cedula_empleado1` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_copia_pedido_producto`
--

CREATE TABLE `tbl_copia_pedido_producto` (
  `id_pedido1` int(11) DEFAULT NULL,
  `id_producto1` int(11) DEFAULT NULL,
  `cantidad1` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_copia_pedido_producto`
--

INSERT INTO `tbl_copia_pedido_producto` (`id_pedido1`, `id_producto1`, `cantidad1`) VALUES
(1, 3, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_copia_producto`
--

CREATE TABLE `tbl_copia_producto` (
  `id_productoo` int(11) DEFAULT NULL,
  `nombre_producto1` varchar(80) DEFAULT NULL,
  `precio_producto1` float DEFAULT NULL,
  `descripcion_producto1` varchar(300) DEFAULT NULL,
  `id_categoria1` varchar(7) DEFAULT NULL,
  `cedula_administrador1` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_copia_producto`
--

INSERT INTO `tbl_copia_producto` (`id_productoo`, `nombre_producto1`, `precio_producto1`, `descripcion_producto1`, `id_categoria1`, `cedula_administrador1`) VALUES
(1, 'Sanduche Derretido', 14500, 'Con pollo', 'C01', '1000204858'),
(2, 'Sanduche Ejecutivo', 14500, 'Con tocineta', 'C01', '1000204858'),
(3, 'Corona', 7000, '', 'C02', '1000204858'),
(4, 'Pilsen', 4500, '', 'C02', '1000204858'),
(5, 'Ron Medell?n Dorado', 50000, '375 ml', 'C03', '1000204858'),
(6, 'Ron Medellin Extra A?ejo ', 70000, '750 ml', 'C03', '1000204858'),
(7, 'Whisky Something Special', 80000, '750 ml', 'C04', '1000204858'),
(8, 'Whisky Buchanans Deluxe', 180000, '1000 ml', 'C04', '1000204858'),
(9, 'Kamikaze', 8000, 'Vodka', 'C05', '1000204858'),
(10, 'Termita', 10000, 'Tequila y baileys', 'C05', '1000204858'),
(11, 'Vino gato negro ', 45000, '750 ml', 'C06', '1000204858'),
(12, 'Merlot Rose', 60000, '', 'C06', '1000204858');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_empleado`
--

CREATE TABLE `tbl_empleado` (
  `cedula_empleado` varchar(11) NOT NULL,
  `nombre1_empleado` varchar(30) NOT NULL,
  `nombre2_empleado` varchar(30) DEFAULT NULL,
  `apellido1_empleado` varchar(25) NOT NULL,
  `apellido2_empleado` varchar(25) DEFAULT NULL,
  `celular1_empleado` varchar(11) NOT NULL,
  `correo_empleado` varchar(80) NOT NULL,
  `clave_empleado` varchar(180) NOT NULL,
  `id_tipo_empleado` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_empleado`
--

INSERT INTO `tbl_empleado` (`cedula_empleado`, `nombre1_empleado`, `nombre2_empleado`, `apellido1_empleado`, `apellido2_empleado`, `celular1_empleado`, `correo_empleado`, `clave_empleado`, `id_tipo_empleado`) VALUES
('1037643149', 'Daniel ', '', 'Perez', '', '3148295893', 'dperez@gmail.com', 'dj', '002'),
('43725470', 'Juan', 'Andres', 'Isaza', '', '3146762313', 'juanisaza10@gmail.com', 'mesero', '001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado`
--

CREATE TABLE `tbl_estado` (
  `id_estado` varchar(5) NOT NULL,
  `estado_pedido` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_estado`
--

INSERT INTO `tbl_estado` (`id_estado`, `estado_pedido`) VALUES
('E01', 'Proceso'),
('E02', 'Atendido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_evento_promocion`
--

CREATE TABLE `tbl_evento_promocion` (
  `id_evento_promocion` int(11) NOT NULL,
  `nombre_evento_promocion` varchar(80) NOT NULL,
  `descripcion_evento_promocion` varchar(300) DEFAULT NULL,
  `fecha_evento_promocion` date NOT NULL,
  `imagen_evento_promocion` varchar(100) DEFAULT NULL,
  `cedula_administrador` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_evento_promocion`
--

INSERT INTO `tbl_evento_promocion` (`id_evento_promocion`, `nombre_evento_promocion`, `descripcion_evento_promocion`, `fecha_evento_promocion`, `imagen_evento_promocion`, `cedula_administrador`) VALUES
(1, 'Evento de Música Popular', 'A cargo de Pipe Bueno', '2020-07-25', '../img_eventos_promociones/conciertoPipeBueno.jpg', '1000204858');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pedido`
--

CREATE TABLE `tbl_pedido` (
  `id_pedido` int(11) NOT NULL,
  `total` float NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp(),
  `numero_mesa` int(11) NOT NULL,
  `id_estado` varchar(5) NOT NULL,
  `cedula_empleado` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_pedido`
--

INSERT INTO `tbl_pedido` (`id_pedido`, `total`, `fecha_hora`, `numero_mesa`, `id_estado`, `cedula_empleado`) VALUES
(1, 28000, '2020-06-03 18:51:02', 1, 'E01', '43725470');

--
-- Disparadores `tbl_pedido`
--
DELIMITER $$
CREATE TRIGGER `copia_seguridad_pedido` BEFORE UPDATE ON `tbl_pedido` FOR EACH ROW begin
insert into tbl_copia_pedido(id_pedido1,total1,fecha1,numero_mesa1,id_estado1,cedula_empleado1)values(new.id_pedido,new.total,
new.fecha_hora,new.numero_mesa,new.id_estado,new.cedula_empleado);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pedido_producto`
--

CREATE TABLE `tbl_pedido_producto` (
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_pedido_producto`
--

INSERT INTO `tbl_pedido_producto` (`id_pedido`, `id_producto`, `cantidad`) VALUES
(1, 3, 4);

--
-- Disparadores `tbl_pedido_producto`
--
DELIMITER $$
CREATE TRIGGER `copia_seguridad_pedido_producto` AFTER INSERT ON `tbl_pedido_producto` FOR EACH ROW begin
insert into tbl_copia_pedido_producto(id_pedido1,id_producto1,cantidad1)values(new.id_pedido,new.id_producto,new.cantidad);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_producto`
--

CREATE TABLE `tbl_producto` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(50) NOT NULL,
  `precio_producto` float NOT NULL,
  `descripcion_producto` varchar(300) DEFAULT NULL,
  `id_categoria` varchar(7) NOT NULL,
  `cedula_administrador` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_producto`
--

INSERT INTO `tbl_producto` (`id_producto`, `nombre_producto`, `precio_producto`, `descripcion_producto`, `id_categoria`, `cedula_administrador`) VALUES
(1, 'Sanduche Derretido', 14500, 'Con pollo', 'C01', '1000204858'),
(2, 'Sanduche Ejecutivo', 14500, 'Con tocineta', 'C01', '1000204858'),
(3, 'Corona', 7000, '', 'C02', '1000204858'),
(4, 'Pilsen', 4500, '', 'C02', '1000204858'),
(5, 'Ron Medell?n Dorado', 50000, '375 ml', 'C03', '1000204858'),
(6, 'Ron Medellin Extra A?ejo ', 70000, '750 ml', 'C03', '1000204858'),
(7, 'Whisky Something Special', 80000, '750 ml', 'C04', '1000204858'),
(8, 'Whisky Buchanans Deluxe', 180000, '1000 ml', 'C04', '1000204858'),
(9, 'Kamikaze', 8000, 'Vodka', 'C05', '1000204858'),
(10, 'Termita', 10000, 'Tequila y baileys', 'C05', '1000204858'),
(11, 'Vino gato negro ', 45000, '750 ml', 'C06', '1000204858'),
(12, 'Merlot Rose', 60000, '', 'C06', '1000204858');

--
-- Disparadores `tbl_producto`
--
DELIMITER $$
CREATE TRIGGER `copia_seguridad_producto` AFTER INSERT ON `tbl_producto` FOR EACH ROW begin
insert into tbl_copia_producto(id_productoo,nombre_producto1,
precio_producto1,descripcion_producto1,id_categoria1,cedula_administrador1)
values(new.id_producto,new.nombre_producto,
new.precio_producto,new.descripcion_producto,new.id_categoria,new.cedula_administrador);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_empleado`
--

CREATE TABLE `tbl_tipo_empleado` (
  `id_tipo_empleado` varchar(5) NOT NULL,
  `tipo_empleado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_tipo_empleado`
--

INSERT INTO `tbl_tipo_empleado` (`id_tipo_empleado`, `tipo_empleado`) VALUES
('001', 'Mesero'),
('002', 'Dj');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_administrador`
--
ALTER TABLE `tbl_administrador`
  ADD PRIMARY KEY (`cedula_administrador`);

--
-- Indices de la tabla `tbl_cancion`
--
ALTER TABLE `tbl_cancion`
  ADD PRIMARY KEY (`id_cancion`),
  ADD KEY `cedula_administrador` (`cedula_administrador`);

--
-- Indices de la tabla `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  ADD PRIMARY KEY (`documento_cliente`);

--
-- Indices de la tabla `tbl_cliente_cancion`
--
ALTER TABLE `tbl_cliente_cancion`
  ADD KEY `documento_cliente` (`documento_cliente`),
  ADD KEY `id_cancion` (`id_cancion`);

--
-- Indices de la tabla `tbl_empleado`
--
ALTER TABLE `tbl_empleado`
  ADD PRIMARY KEY (`cedula_empleado`),
  ADD KEY `id_tipo_empleado` (`id_tipo_empleado`);

--
-- Indices de la tabla `tbl_estado`
--
ALTER TABLE `tbl_estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `tbl_evento_promocion`
--
ALTER TABLE `tbl_evento_promocion`
  ADD PRIMARY KEY (`id_evento_promocion`),
  ADD KEY `cedula_administrador` (`cedula_administrador`);

--
-- Indices de la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `cedula_empleado` (`cedula_empleado`);

--
-- Indices de la tabla `tbl_pedido_producto`
--
ALTER TABLE `tbl_pedido_producto`
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `cedula_administrador` (`cedula_administrador`);

--
-- Indices de la tabla `tbl_tipo_empleado`
--
ALTER TABLE `tbl_tipo_empleado`
  ADD PRIMARY KEY (`id_tipo_empleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_cancion`
--
ALTER TABLE `tbl_cancion`
  MODIFY `id_cancion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_evento_promocion`
--
ALTER TABLE `tbl_evento_promocion`
  MODIFY `id_evento_promocion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_cancion`
--
ALTER TABLE `tbl_cancion`
  ADD CONSTRAINT `tbl_cancion_ibfk_1` FOREIGN KEY (`cedula_administrador`) REFERENCES `tbl_administrador` (`cedula_administrador`);

--
-- Filtros para la tabla `tbl_cliente_cancion`
--
ALTER TABLE `tbl_cliente_cancion`
  ADD CONSTRAINT `tbl_cliente_cancion_ibfk_1` FOREIGN KEY (`documento_cliente`) REFERENCES `tbl_cliente` (`documento_cliente`),
  ADD CONSTRAINT `tbl_cliente_cancion_ibfk_2` FOREIGN KEY (`id_cancion`) REFERENCES `tbl_cancion` (`id_cancion`);

--
-- Filtros para la tabla `tbl_empleado`
--
ALTER TABLE `tbl_empleado`
  ADD CONSTRAINT `tbl_empleado_ibfk_1` FOREIGN KEY (`id_tipo_empleado`) REFERENCES `tbl_tipo_empleado` (`id_tipo_empleado`);

--
-- Filtros para la tabla `tbl_evento_promocion`
--
ALTER TABLE `tbl_evento_promocion`
  ADD CONSTRAINT `tbl_evento_promocion_ibfk_1` FOREIGN KEY (`cedula_administrador`) REFERENCES `tbl_administrador` (`cedula_administrador`);

--
-- Filtros para la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  ADD CONSTRAINT `tbl_pedido_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `tbl_estado` (`id_estado`),
  ADD CONSTRAINT `tbl_pedido_ibfk_2` FOREIGN KEY (`cedula_empleado`) REFERENCES `tbl_empleado` (`cedula_empleado`);

--
-- Filtros para la tabla `tbl_pedido_producto`
--
ALTER TABLE `tbl_pedido_producto`
  ADD CONSTRAINT `tbl_pedido_producto_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `tbl_pedido` (`id_pedido`),
  ADD CONSTRAINT `tbl_pedido_producto_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `tbl_producto` (`id_producto`);

--
-- Filtros para la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  ADD CONSTRAINT `tbl_producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categoria` (`id_categoria`),
  ADD CONSTRAINT `tbl_producto_ibfk_2` FOREIGN KEY (`cedula_administrador`) REFERENCES `tbl_administrador` (`cedula_administrador`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
