-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2023 a las 21:49:09
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `uab_asistencias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_asistencia` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `entrada` datetime DEFAULT NULL,
  `salida` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id_asistencia`, `id_empleado`, `entrada`, `salida`) VALUES
(24, 12, '2023-11-27 03:35:18', '2023-11-27 03:35:28'),
(26, 12, '2023-11-27 03:36:52', '2023-11-27 03:36:55'),
(27, 13, '2023-11-27 03:37:05', '2023-11-27 03:37:08'),
(28, 13, '2023-11-27 03:37:21', '2023-11-27 03:37:26'),
(29, 12, '2023-11-27 03:41:13', '2023-11-27 03:41:20'),
(30, 12, '2023-11-27 03:41:51', '2023-11-27 03:41:53'),
(31, 13, '2023-11-27 03:42:18', '2023-11-27 03:42:20'),
(32, 13, '2023-11-27 03:42:29', '2023-11-27 03:42:35'),
(33, 13, '2023-11-27 03:43:02', '2023-11-27 03:43:05'),
(34, 13, '2023-11-27 09:58:43', '2023-11-27 09:58:48'),
(35, 12, '2023-11-27 10:58:01', NULL),
(36, 12, '2023-11-27 10:58:38', NULL),
(37, 12, '2023-11-27 10:59:03', NULL),
(38, 12, '2023-11-27 11:00:05', NULL),
(39, 12, '2023-11-27 11:00:29', '2023-11-27 11:00:32'),
(40, 12, '2023-11-27 11:00:37', '2023-11-27 11:00:45'),
(41, 12, '2023-11-27 11:00:48', '2023-11-27 11:01:02'),
(42, 12, '2023-11-27 11:01:05', '2023-11-27 11:01:23'),
(43, 13, '2023-11-27 11:01:43', '2023-11-27 11:02:36'),
(44, 13, '2023-11-27 11:04:10', NULL),
(45, 13, '2023-11-27 11:09:06', '2023-11-27 11:20:21'),
(46, 13, '2023-11-27 11:33:11', '2023-11-27 12:27:02'),
(47, 12, '2023-11-27 14:04:23', '2023-11-27 14:04:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id_cargo`, `nombre`) VALUES
(2, 'INGENIERIA'),
(3, 'FCEA'),
(4, 'SALUD'),
(5, 'TEOLOGIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `dni` varchar(255) NOT NULL,
  `cargo` int(11) NOT NULL,
  `horas_acumuladas` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `nombre`, `apellido`, `dni`, `cargo`, `horas_acumuladas`) VALUES
(12, 'Cristian', 'Ledezma', '12345', 3, '00:01:13'),
(13, 'Wilder', 'Mamani', '987654', 2, '01:09:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `ruc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `nombre`, `telefono`, `ubicacion`, `ruc`) VALUES
(1, 'Informatica Studios', '925310896', 'av. los incas', '78945612378');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `usuario`, `password`) VALUES
(1, 'Cristian', 'Ledezma', 'cristian@gmail.com', '25d55ad283aa400af464c76d713c07ad'),
(7, 'Sebastian ', 'Ledezma', 'sebas@gmail.com', '25d55ad283aa400af464c76d713c07ad');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_asistencia`),
  ADD KEY `fk2` (`id_empleado`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `fk1` (`cargo`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `fk2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`cargo`) REFERENCES `cargo` (`id_cargo`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
