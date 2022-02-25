-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-02-2022 a las 05:42:27
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bloquera las borregas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloque`
--

CREATE TABLE `bloque` (
  `id_bloque` int(11) NOT NULL,
  `blq_nombre` varchar(50) NOT NULL,
  `blq_precio_unitario` float NOT NULL,
  `blq_precio_venta` float NOT NULL,
  `blq_tamano` varchar(30) NOT NULL,
  `blq_estado` tinyint(1) NOT NULL,
  `blq_existencia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bloque`
--

INSERT INTO `bloque` (`id_bloque`, `blq_nombre`, `blq_precio_unitario`, `blq_precio_venta`, `blq_tamano`, `blq_estado`, `blq_existencia`) VALUES
(1, 'tabicon', 2.4, 4, '4x4', 1, 500),
(2, 'tabicon', 2.4, 4, '4x4', 1, 500),
(3, 'tabicon', 2.4, 4, '4x4', 1, 500),
(4, 'tabicon', 3, 4.5, '5x5', 1, 400),
(5, 'tabicon', 3, 4.5, '5x5', 1, 400);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `cl_nombre` varchar(50) NOT NULL,
  `cl_apaterno` varchar(20) NOT NULL,
  `cl_amaterno` varchar(20) NOT NULL,
  `cl_calle` varchar(50) NOT NULL,
  `cl_numb` varchar(20) NOT NULL,
  `cl_codpostal` varchar(10) NOT NULL,
  `cl_colonia` varchar(30) NOT NULL,
  `cl_lugar` varchar(20) NOT NULL,
  `cl_municipio` varchar(30) NOT NULL,
  `cl_telefono` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `cl_nombre`, `cl_apaterno`, `cl_amaterno`, `cl_calle`, `cl_numb`, `cl_codpostal`, `cl_colonia`, `cl_lugar`, `cl_municipio`, `cl_telefono`) VALUES
(1, 'omar', 'gomez', 'peralta', 'ixtlahuacan', '565', '28046', 'oriental', 'casa', 'colima', '3121679078'),
(2, 'pedro', 'marines', 'larios', 'condor', '164', '28017', 'colinas de santa barbara', 'casa', 'colima', '3121774657'),
(3, 'aldo', 'gomez', 'matuz', 'ixtlahuacan', '555', '28046', 'oriental', 'casa', 'colima', '3122739381'),
(4, 'britney', 'garcia', 'gonzalez', 'morelos', '118', '28200', 'manzanillo', 'casa', 'colima', '3141380821'),
(5, 'julio', 'vergara', 'plascencia', 'av.constitucion', '1450', '28017', 'jardines vista hermosa', 'terreno', 'colima', '3122014062');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta_bloque`
--

CREATE TABLE `detalle_venta_bloque` (
  `id_det_vta_blq` int(11) NOT NULL,
  `fk_id_bloque` int(11) NOT NULL,
  `fk_id_venta` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_venta_bloque`
--

INSERT INTO `detalle_venta_bloque` (`id_det_vta_blq`, `fk_id_bloque`, `fk_id_venta`, `cantidad`, `precio_venta`) VALUES
(1, 1, 1, 50, 200),
(2, 1, 2, 100, 400),
(3, 4, 1, 50, 225),
(4, 4, 2, 50, 225),
(5, 2, 3, 150, 600),
(6, 2, 4, 150, 600),
(7, 4, 3, 100, 450),
(8, 4, 4, 100, 450),
(9, 3, 5, 200, 800),
(10, 5, 5, 200, 900);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `fk_id_cliente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `tipo_venta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `fk_id_cliente`, `fecha`, `tipo_venta`) VALUES
(1, 1, '2020-02-11', 'Linea'),
(2, 2, '2019-01-23', 'Mostrador'),
(3, 3, '2021-05-05', 'Linea'),
(4, 4, '2020-07-19', 'Mostrador'),
(5, 5, '2021-10-20', 'Linea');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bloque`
--
ALTER TABLE `bloque`
  ADD PRIMARY KEY (`id_bloque`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `detalle_venta_bloque`
--
ALTER TABLE `detalle_venta_bloque`
  ADD PRIMARY KEY (`id_det_vta_blq`),
  ADD KEY `fk_det_vta_blq_bloque` (`fk_id_bloque`),
  ADD KEY `fk_det_vta_blq_venta` (`fk_id_venta`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `fk_venta_cliente` (`fk_id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bloque`
--
ALTER TABLE `bloque`
  MODIFY `id_bloque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_venta_bloque`
--
ALTER TABLE `detalle_venta_bloque`
  MODIFY `id_det_vta_blq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta_bloque`
--
ALTER TABLE `detalle_venta_bloque`
  ADD CONSTRAINT `fk_det_vta_blq_bloque` FOREIGN KEY (`fk_id_bloque`) REFERENCES `bloque` (`id_bloque`),
  ADD CONSTRAINT `fk_det_vta_blq_venta` FOREIGN KEY (`fk_id_venta`) REFERENCES `venta` (`id_venta`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_cliente` FOREIGN KEY (`fk_id_cliente`) REFERENCES `cliente` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
