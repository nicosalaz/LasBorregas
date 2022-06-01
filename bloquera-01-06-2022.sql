-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2022 a las 20:23:32
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bloquera`
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
  `estado` tinyint(1) NOT NULL,
  `blq_existencia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bloque`
--

INSERT INTO `bloque` (`id_bloque`, `blq_nombre`, `blq_precio_unitario`, `blq_precio_venta`, `blq_tamano`, `estado`, `blq_existencia`) VALUES
(1, 'tabicon', 2.4, 4, '4x4', 1, 403),
(4, 'tabicon', 3, 4.5, '5x5', 1, 446),
(8, 'nnn', 90, 90, 'ff', 0, 100),
(9, 'tabicon', 5, 8, '6x6', 1, 180),
(10, 'tabicon', 10, 15, '7x7', 0, 200),
(11, 'tabicon', 15, 20, 'AxA', 0, 100),
(12, 'tabicon', 0, 0, 'a', 0, 0),
(13, 'tabicon', 15, 23, '7x7', 0, 100);

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
  `cl_telefono` varchar(30) NOT NULL,
  `estado` int(1) NOT NULL,
  `fkidrol` int(11) NOT NULL,
  `fkidusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `cl_nombre`, `cl_apaterno`, `cl_amaterno`, `cl_calle`, `cl_numb`, `cl_codpostal`, `cl_colonia`, `cl_lugar`, `cl_municipio`, `cl_telefono`, `estado`, `fkidrol`, `fkidusuario`) VALUES
(1, 'omar', 'gomez', 'peralta', 'ixtlahuacan', '565', '28046', 'oriental', 'casa', 'colima', '3121679078', 0, 3, 1),
(2, 'pedro', 'marines', 'larios', 'condor', '164', '28017', 'colinas de santa barbara', 'casa', 'colima', '3121774657', 1, 3, 2),
(3, 'aldo', 'gomez', 'matuz', 'ixtlahuacan', '555', '28046', 'oriental', 'casa', 'colima', '3122739381', 1, 3, 3),
(4, 'britney', 'garcia', 'gonzalez', 'morelos', '118', '28200', 'manzanillo', 'casa', 'colima', '3141380821', 0, 3, 4),
(5, 'julio', 'vergara', 'plascencia', 'av.constitucion', '1450', '28017', 'jardines vista hermosa', 'terreno', 'colima', '3122014062', 0, 3, 5),
(6, 'Nicolas', 'Salazar', 'Victoria', 'luis', '515', '9876543', 'vista', 'casa', 'colima', '3014868726', 1, 3, 6),
(7, 'Daniela', 'Velez', 'Castillo', 'vista', '122', '98765', 'Villa', 'Casa', 'Colima', '1278765432', 0, 3, 7),
(8, 'Gonzalo', 'Gonzalez', 'Rocha', 'Luis Paez Brotchie', '515', '09876', 'Jardines de vista hermosa', 'casa', 'Colima', '87234578', 1, 3, 8),
(9, 'david', 'diaz', 'perez', 'calle', '510', '245432', 'sandoval', 'casa', 'colima', '12345679', 0, 3, 9),
(10, 'Juan David', 'Muñoz', 'Gaviria', 'calle', '1746', '12345', 'Villa', 'Casa', 'Colima', '1234567', 1, 3, 10),
(11, '123', '1234', '1234', 'asdg', 'asdf', 'asdf', 'asdfg', 'Casa', 'asdfg', '124', 0, 3, 11),
(12, 'Juan', 'diaz', 'andrade', '12 de mayo', '515', '12345', 'centro', 'Casa', 'Colima', '3014675342', 1, 3, 12),
(13, 'Andres', 'Cortes', 'Villa', 'luis', '512', '76000', 'villa', 'Casa', 'Colima', '3015461231', 1, 3, 16),
(14, 'Elvira', 'Ceballos', 'Rojas', 'Luis paez Brotchie', '515', '76002', 'Jardines de vista hermosa', 'Casa', 'Colima', '3024763512', 1, 3, 25);

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
(7, 4, 3, 100, 450),
(8, 4, 4, 100, 450),
(11, 1, 17, 99, 396),
(12, 4, 18, 10, 40),
(13, 1, 18, 20, 80),
(16, 1, 21, 22, 88),
(18, 4, 23, 20, 80),
(19, 1, 24, 10, 40),
(20, 1, 25, 10, 40),
(21, 4, 25, 20, 80),
(22, 4, 26, 20, 90),
(23, 1, 27, 12, 48),
(24, 4, 27, 5, 22.5),
(25, 1, 28, 10, 40),
(26, 4, 28, 7, 31.5),
(27, 1, 28, 6, 24),
(28, 9, 29, 20, 160),
(29, 1, 30, 11, 44),
(30, 1, 31, 5, 20),
(31, 4, 31, 2, 9),
(32, 1, 32, 10, 40),
(33, 4, 33, 3, 13.5),
(34, 4, 34, 3, 13.5),
(35, 1, 35, 12, 48),
(36, 1, 36, 4, 16),
(37, 1, 37, 5, 20),
(38, 1, 38, 2, 8),
(39, 9, 38, 3, 24),
(40, 4, 39, 4, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `nombre_empleado` varchar(50) NOT NULL,
  `apellido_empleado` varchar(50) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_egreso` date DEFAULT NULL,
  `telefono` varchar(10) NOT NULL,
  `estado_actividad` tinyint(1) NOT NULL,
  `fkidrol` int(11) NOT NULL,
  `fkiduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `nombre_empleado`, `apellido_empleado`, `fecha_ingreso`, `fecha_egreso`, `telefono`, `estado_actividad`, `fkidrol`, `fkiduser`) VALUES
(1, 'JUAN FELIPE', 'FERNANDEZ REY', '2022-05-17', NULL, '3014868725', 1, 1, 13),
(2, 'DANI', 'RUIZ', '2022-05-17', NULL, '3014879725', 1, 2, 14),
(3, 'EMPLEADO EN LINEA', 'EMPLEADO EN LINEA', '2022-05-25', NULL, '1234509567', 0, 2, 15),
(4, 'Nicolas', 'Rivolta', '2022-05-24', NULL, '3014723452', 1, 1, 21),
(5, 'Fernando', 'Padilla', '2022-04-20', NULL, '3221456723', 1, 2, 22),
(6, 'fer', 'Padilla', '2022-04-20', '2022-06-01', '3221456723', 0, 2, 23),
(7, 'Fernando', 'Padilla', '2022-04-20', '2022-06-01', '3221456723', 0, 2, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'ADMIN'),
(2, 'EMPLEADO'),
(3, 'CLIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre_usuario` varchar(30) NOT NULL,
  `clave` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre_usuario`, `clave`) VALUES
(1, 'omar', 'A13D75H'),
(2, 'pedro', 'J74HAT12'),
(3, 'aldo', 'LAR1423'),
(4, 'britney', 'OSW1844Q'),
(5, 'julio', 'HS32HA3'),
(6, 'nico.salaz', 'n1c0l4s10'),
(7, 'daniv', 'daniela123'),
(8, 'ggonzalezr', '123456'),
(9, 'juan.diaz', '12345'),
(10, 'jd.munoz', '12345'),
(11, 'cualquiera', '123'),
(12, 'juan_diaz', '12345'),
(13, 'j_fernandez', '12345'),
(14, 'dani_ruiz', 'dani123'),
(15, 'empleado_en_linea', '12345'),
(16, 'andy_cortes', 'andy123'),
(21, 'nico_rivolta', '12345'),
(22, 'fer_pa', '12345'),
(23, 'fer_padilla', '12345'),
(24, 'fer_padilla', '12345'),
(25, 'elvira_cr', '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `fk_id_cliente` int(11) NOT NULL,
  `fk_id_empleado` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `tipo_venta` varchar(50) NOT NULL,
  `total` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `fk_id_cliente`, `fk_id_empleado`, `fecha`, `tipo_venta`, `total`, `estado`) VALUES
(1, 1, 3, '2020-02-11', 'Linea', 100, 0),
(2, 2, 2, '2019-01-23', 'Mostrador', 625, 1),
(3, 3, 3, '2021-05-05', 'Linea', 450, 1),
(4, 4, 2, '2020-07-19', 'Mostrador', 450, 1),
(17, 2, 3, '2022-04-07', 'Linea', 396, 1),
(18, 6, 3, '2022-04-24', 'Linea', 120, 1),
(21, 3, 3, '2022-04-23', 'Linea', 88, 1),
(23, 2, 3, '2022-04-25', 'Linea', 80, 1),
(24, 6, 3, '2022-04-24', 'Linea', 40, 1),
(25, 2, 3, '2022-04-06', 'Linea', 120, 1),
(26, 6, 3, '2022-04-06', 'Linea', 90, 0),
(27, 3, 2, '2022-04-20', 'Mostrador', 71, 1),
(28, 8, 2, '2022-04-13', 'Mostrador', 96, 0),
(29, 3, 3, '2022-04-20', 'Linea', 160, 1),
(30, 2, 3, '2022-07-12', 'Linea', 44, 1),
(31, 6, 5, '2022-05-30', 'Mostrador', 29, 1),
(32, 6, 5, '2022-05-30', 'Mostrador', 40, 1),
(33, 2, 5, '2022-05-30', 'Mostrador', 14, 1),
(34, 8, 5, '2022-05-30', 'Mostrador', 14, 1),
(35, 10, 5, '2022-05-30', 'Mostrador', 48, 1),
(36, 6, 3, '2022-06-01', 'Linea', 16, 1),
(37, 6, 3, '2022-06-01', 'Linea', 20, 1),
(38, 12, 5, '2022-05-31', 'Mostrador', 32, 1),
(39, 3, 5, '2022-06-01', 'Mostrador', 18, 1);

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
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `fk_cl_rol` (`fkidrol`),
  ADD KEY `fk_cl_user` (`fkidusuario`);

--
-- Indices de la tabla `detalle_venta_bloque`
--
ALTER TABLE `detalle_venta_bloque`
  ADD PRIMARY KEY (`id_det_vta_blq`),
  ADD KEY `fk_det_vta_blq_bloque` (`fk_id_bloque`),
  ADD KEY `fk_det_vta_blq_venta` (`fk_id_venta`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `fk_emp_rol` (`fkidrol`),
  ADD KEY `fk_emp_user` (`fkiduser`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

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
  MODIFY `id_bloque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `detalle_venta_bloque`
--
ALTER TABLE `detalle_venta_bloque`
  MODIFY `id_det_vta_blq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_cl_rol` FOREIGN KEY (`fkidrol`) REFERENCES `rol` (`id_rol`),
  ADD CONSTRAINT `fk_cl_user` FOREIGN KEY (`fkidusuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `detalle_venta_bloque`
--
ALTER TABLE `detalle_venta_bloque`
  ADD CONSTRAINT `fk_det_vta_blq_bloque` FOREIGN KEY (`fk_id_bloque`) REFERENCES `bloque` (`id_bloque`),
  ADD CONSTRAINT `fk_det_vta_blq_venta` FOREIGN KEY (`fk_id_venta`) REFERENCES `venta` (`id_venta`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `fk_emp_rol` FOREIGN KEY (`fkidrol`) REFERENCES `rol` (`id_rol`),
  ADD CONSTRAINT `fk_emp_user` FOREIGN KEY (`fkiduser`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_cliente` FOREIGN KEY (`fk_id_cliente`) REFERENCES `cliente` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
