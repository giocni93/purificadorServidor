-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-12-2014 a las 14:50:04
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `purificadores`
--
CREATE DATABASE IF NOT EXISTS `purificadores` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `purificadores`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
`id` bigint(20) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `cedula` varchar(15) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellido` varchar(40) NOT NULL,
  `direccion_oficina` varchar(40) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codeudor`
--

CREATE TABLE IF NOT EXISTS `codeudor` (
`id` int(11) NOT NULL,
  `cedula` varchar(15) DEFAULT NULL,
  `nombre` varchar(80) NOT NULL,
  `direccion_oficina` varchar(40) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `referencia` varchar(80) NOT NULL,
  `telefono_referencia` varchar(15) NOT NULL,
  `id_cliente` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_plan_pagos`
--

CREATE TABLE IF NOT EXISTS `detalle_plan_pagos` (
`id` bigint(20) NOT NULL,
  `valor_cuota` double NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `id_plan_pagos` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico`
--

CREATE TABLE IF NOT EXISTS `historico` (
`id` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `observacion` varchar(512) NOT NULL,
  `id_cliente` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE IF NOT EXISTS `inventario` (
`id` bigint(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `valor` double DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `id_tipo_inventario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE IF NOT EXISTS `mantenimiento` (
`id` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_programada` date NOT NULL,
  `fecha_realizacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nombre_tecnico` varchar(60) NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `motivo` varchar(40) NOT NULL,
  `id_cliente` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_pedido`
--

CREATE TABLE IF NOT EXISTS `orden_pedido` (
`id` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `id_cliente` varchar(15) NOT NULL,
  `id_inventario` bigint(20) NOT NULL,
  `fecha_instalacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_pagos`
--

CREATE TABLE IF NOT EXISTS `plan_pagos` (
`id` bigint(20) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `monto` double NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `valor_cuota` double NOT NULL,
  `saldo_pendiente` double NOT NULL,
  `fecha_pago` date NOT NULL,
  `numero_cuota` int(11) NOT NULL,
  `fecha_credito` date NOT NULL,
  `id_cliente` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referencia_cliente`
--

CREATE TABLE IF NOT EXISTS `referencia_cliente` (
`id` bigint(20) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `id_cliente` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_inventario`
--

CREATE TABLE IF NOT EXISTS `tipo_inventario` (
`id` bigint(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_categoria` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
 ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `codeudor`
--
ALTER TABLE `codeudor`
 ADD PRIMARY KEY (`id`), ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `detalle_plan_pagos`
--
ALTER TABLE `detalle_plan_pagos`
 ADD PRIMARY KEY (`id`), ADD KEY `id_plan_pagos` (`id_plan_pagos`);

--
-- Indices de la tabla `historico`
--
ALTER TABLE `historico`
 ADD PRIMARY KEY (`id`), ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
 ADD PRIMARY KEY (`id`), ADD KEY `id_tipo_inventario` (`id_tipo_inventario`);

--
-- Indices de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
 ADD PRIMARY KEY (`id`), ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `orden_pedido`
--
ALTER TABLE `orden_pedido`
 ADD PRIMARY KEY (`id`), ADD KEY `id_cliente` (`id_cliente`), ADD KEY `id_inventario` (`id_inventario`);

--
-- Indices de la tabla `plan_pagos`
--
ALTER TABLE `plan_pagos`
 ADD PRIMARY KEY (`id`), ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `referencia_cliente`
--
ALTER TABLE `referencia_cliente`
 ADD PRIMARY KEY (`id`), ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `tipo_inventario`
--
ALTER TABLE `tipo_inventario`
 ADD PRIMARY KEY (`id`), ADD KEY `id_categoria` (`id_categoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `codeudor`
--
ALTER TABLE `codeudor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalle_plan_pagos`
--
ALTER TABLE `detalle_plan_pagos`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `historico`
--
ALTER TABLE `historico`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `orden_pedido`
--
ALTER TABLE `orden_pedido`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `plan_pagos`
--
ALTER TABLE `plan_pagos`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `referencia_cliente`
--
ALTER TABLE `referencia_cliente`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_inventario`
--
ALTER TABLE `tipo_inventario`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `codeudor`
--
ALTER TABLE `codeudor`
ADD CONSTRAINT `codeudor_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`cedula`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_plan_pagos`
--
ALTER TABLE `detalle_plan_pagos`
ADD CONSTRAINT `detalle_plan_pagos_ibfk_1` FOREIGN KEY (`id_plan_pagos`) REFERENCES `plan_pagos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `historico`
--
ALTER TABLE `historico`
ADD CONSTRAINT `historico_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`cedula`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`id_tipo_inventario`) REFERENCES `tipo_inventario` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
ADD CONSTRAINT `mantenimiento_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`cedula`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_pedido`
--
ALTER TABLE `orden_pedido`
ADD CONSTRAINT `orden_pedido_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`cedula`) ON UPDATE CASCADE,
ADD CONSTRAINT `orden_pedido_ibfk_2` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `plan_pagos`
--
ALTER TABLE `plan_pagos`
ADD CONSTRAINT `plan_pagos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`cedula`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `referencia_cliente`
--
ALTER TABLE `referencia_cliente`
ADD CONSTRAINT `referencia_cliente_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`cedula`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipo_inventario`
--
ALTER TABLE `tipo_inventario`
ADD CONSTRAINT `tipo_inventario_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
