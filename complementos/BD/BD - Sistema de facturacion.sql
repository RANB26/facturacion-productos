-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-07-2023 a las 00:57:53
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `facturacion`
--
CREATE DATABASE IF NOT EXISTS `facturacion` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `facturacion`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `id_detalle` int(10) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `cantidad_producto` int(3) NOT NULL,
  `total_detalle` int(6) NOT NULL,
  `id_factura` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(10) NOT NULL,
  `id_asesor` int(10) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `fecha_factura` date,
  `mpago_factura` varchar(15) NOT NULL,
  `subtotal_factura` int(10) NOT NULL,
  `total_factura` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(10) NOT NULL,
  `codigo_producto` int(10) NOT NULL UNIQUE,
  `descripcion_producto` varchar(50) NOT NULL,
  `precio_producto` int(20) NOT NULL,
  `existencias_producto` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

INSERT INTO `producto` (`id_producto`, `codigo_producto`, `descripcion_producto`, `precio_producto`, `existencias_producto`) VALUES
(1, 12345, 'Champu con brillo concentrado', 12000, 40);

INSERT INTO `producto` (`id_producto`, `codigo_producto`, `descripcion_producto`, `precio_producto`, `existencias_producto`) VALUES
(2, 23456, 'Paños de microfibra', 5000, 20);

INSERT INTO `producto` (`id_producto`, `codigo_producto`, `descripcion_producto`, `precio_producto`, `existencias_producto`) VALUES
(3, 34567, 'Esponjas quitamanchas Clay Bar', 7000, 70);

INSERT INTO `producto` (`id_producto`, `codigo_producto`, `descripcion_producto`, `precio_producto`, `existencias_producto`) VALUES
(4, 45678, 'Lavaparabrisas anti-lluvia Krafft Rain X', 15000, 50);

INSERT INTO `producto` (`id_producto`, `codigo_producto`, `descripcion_producto`, `precio_producto`, `existencias_producto`) VALUES
(5, 56789, 'Limpiador de llantas Liqui Moly', 20000, 100);


--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(10) NOT NULL,
  `documento_usuario` int(10) NOT NULL,
  `nombre_usuario` varchar(15) NOT NULL,
  `apellido_usuario` varchar(15) NOT NULL,
  `telefono_usuario` varchar(10) NOT NULL,
  `correo_usuario` varchar(30) NOT NULL,
  `password_usuario` varchar(25) NOT NULL,
  `rol_usuario` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `documento_usuario`, `nombre_usuario`, `apellido_usuario`, `telefono_usuario`, `correo_usuario`, `password_usuario`, `rol_usuario`) VALUES
(1, 1042850202, 'Asesor', 'Ejemplo', '310712354', 'asesor@gmail.com', '123', 'Asesor');

INSERT INTO `usuario` (`id_usuario`, `documento_usuario`, `nombre_usuario`, `apellido_usuario`, `telefono_usuario`, `correo_usuario`, `password_usuario`, `rol_usuario`) VALUES
(2, 1045486524, 'Cliente', 'Ejemplo', '310712354', 'cliente@gmail.com', '123', 'Cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`id_detalle`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `Factura_usuario` (`id_asesor`),
  ADD KEY `Usuario_factura` (`id_cliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `validacion_documento` (`documento_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `id_detalle` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(10) NOT NULL AUTO_INCREMENT;
  
  
  ALTER TABLE `factura`
  MODIFY `id_factura` int(10) NOT NULL AUTO_INCREMENT;
  

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `Factura_usuario` FOREIGN KEY (`id_asesor`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `Usuario_factura` FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
