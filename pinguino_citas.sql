-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2019 a las 00:58:21
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pinguino_citas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_niveles`
--

CREATE TABLE `cat_niveles` (
  `id_nivel` int(11) NOT NULL,
  `departamento` varchar(30) DEFAULT NULL,
  `nivel_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cat_niveles`
--

INSERT INTO `cat_niveles` (`id_nivel`, `departamento`, `nivel_usuario`) VALUES
(1, 'ROOT', 0),
(2, 'ADMINISTRADOR', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id_cita` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `numero_turno` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `costo_consulta` varchar(45) DEFAULT '0',
  `folio_sat` int(11) DEFAULT NULL,
  `contabilizado` int(11) DEFAULT '0',
  `cobrado` int(11) DEFAULT '0',
  `forma_pago` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_cita`, `id_cliente`, `numero_turno`, `fecha`, `hora`, `costo_consulta`, `folio_sat`, `contabilizado`, `cobrado`, `forma_pago`, `activo`) VALUES
(46, 1, 1, '2019-06-19', '08:23:00', '100', NULL, 0, 1, NULL, 1),
(47, 1, 2, '2019-06-19', '08:25:00', '', NULL, 0, 1, 0, 1),
(48, 1, 3, '2019-06-19', '09:20:00', '', NULL, 0, 1, 0, 1),
(49, 1, 4, '2019-06-19', '09:20:00', '100', NULL, 0, 1, 2, 1),
(50, 1, 5, '2019-06-19', '09:22:00', '200', NULL, 0, 1, 1, 1),
(51, 1, 6, '2019-06-19', '09:23:00', '0', NULL, 0, 0, NULL, 1),
(52, 1, 7, '2019-06-19', '14:46:00', '0', NULL, 0, 0, NULL, 1),
(53, 1, 8, '2019-06-19', '14:46:00', '0', NULL, 0, 0, NULL, 1),
(54, 1, 9, '2019-06-19', '14:46:00', '0', NULL, 0, 0, NULL, 1),
(55, 1, 10, '2019-06-19', '14:50:00', '0', NULL, 0, 0, NULL, 1),
(56, 1, 11, '2019-06-19', '14:50:00', '0', NULL, 0, 0, NULL, 1),
(57, 1, 12, '2019-06-19', '14:51:00', '0', NULL, 0, 0, NULL, 1),
(58, 1, 13, '2019-06-19', '14:50:00', '0', NULL, 0, 0, NULL, 1),
(59, 1, 14, '2019-06-19', '14:50:00', '0', NULL, 0, 0, NULL, 1),
(60, 1, 15, '2019-06-19', '14:50:00', '0', NULL, 0, 0, NULL, 1),
(61, 1, 16, '2019-06-19', '15:40:00', '0', NULL, 0, 0, NULL, 1),
(62, 1, 17, '2019-06-19', '15:10:00', '0', NULL, 0, 0, NULL, 1),
(63, 1, 1, '2019-06-20', '15:10:00', '0', NULL, 0, 0, NULL, 1),
(64, 1, 2, '2019-06-20', '15:20:00', '0', NULL, 0, 0, NULL, 1),
(65, 1, 18, '2019-06-19', '15:35:00', '0', NULL, 0, 0, NULL, 1),
(66, 1, 19, '2019-06-19', '15:45:00', '0', NULL, 0, 0, NULL, 1),
(67, 1, 20, '2019-06-19', '15:50:00', '0', NULL, 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_cliente` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo_cliente` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `telefono_cliente`, `correo_cliente`, `fecha_nacimiento`, `activo`) VALUES
(1, 'Jose Lopez', '6644162499', 'x@x', '22-12-2019', 1),
(2, 'MARTIN', '6624162499', 'c@gmail.com', 'DSDFD', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costos`
--

CREATE TABLE `costos` (
  `id_costo` int(11) NOT NULL,
  `costo` varchar(45) DEFAULT NULL,
  `activo` varchar(45) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `costos`
--

INSERT INTO `costos` (`id_costo`, `costo`, `activo`) VALUES
(0, '100', '1'),
(0, '200', '1'),
(0, '300.00', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario_email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido_p` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido_m` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_nivel` int(11) DEFAULT NULL,
  `contrasena` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` char(1) COLLATE utf8_unicode_ci DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario_email`, `nombre`, `apellido_p`, `apellido_m`, `id_nivel`, `contrasena`, `activo`) VALUES
(1, 'root@pinguinosystems.com', 'MARTIN FRANCISCO', 'MARTINEZ', 'FEDERICO', 1, '123456', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cat_niveles`
--
ALTER TABLE `cat_niveles`
  ADD PRIMARY KEY (`id_nivel`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_nivel` (`id_nivel`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cat_niveles`
--
ALTER TABLE `cat_niveles`
  MODIFY `id_nivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
