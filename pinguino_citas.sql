-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2019 a las 00:36:06
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

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
(2, 'ADMINISTRADOR', 1),
(3, 'CONTABILIDAD', 2),
(4, 'DISEÑO', 3),
(5, 'VENTAS', 4),
(6, 'PRODUCCIÓN', 5);

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
  `cobrado` int(11) DEFAULT '0',
  `contabilizado` int(11) DEFAULT '0',
  `activo` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_cita`, `id_cliente`, `numero_turno`, `fecha`, `hora`, `costo_consulta`, `folio_sat`, `cobrado`, `contabilizado`, `activo`) VALUES
(41, 7, 1, '2019-05-04', '13:00:00', '200', NULL, 1, 0, 1),
(42, 7, 1, '2019-05-05', '13:00:00', '0', NULL, 0, 0, 1),
(43, 7, 2, '2019-05-04', '13:15:00', '0', NULL, 0, 0, 1),
(44, 7, 1, '2019-05-25', '19:15:00', '0', NULL, 0, 0, 1),
(45, 7, 1, '2019-05-26', '14:45:00', '0', NULL, 0, 0, 1);

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
(7, 'MARTIN', '999999999999', '111111111@gmail.com', '2019-04-03', 1),
(8, 'CLEINTE 2', '44444444444', 'sdf@gmail.com', '2019-04-30', 1),
(9, 'MARCOS MARTIN', '637121416544', 'sdf@gmail.com', '2019-04-27', 1),
(10, 'MARTIN PRUEB', '123456', 'martn@gmail.com', '2019-04-08', 1),
(11, 'ASD', '3455', 'martin@gmail.com', '2019-04-30', 1),
(12, 'CLEINTE PREUBA', '6624162499', 'martin@gmail.com', '2019-05-15', 1),
(13, 'SDF', '66624162466', 'sdf@gmail.com', '2019-04-25', 1),
(14, 'SDF', 'ASD', 'sdf@gmail.com', '2019-05-01', 1),
(15, 'SDF', '637121416544', 'sdf@gmail.com', '2019-04-30', 1),
(16, 'SDF', 'SDF', 'sdf@gmail.com', '2019-05-01', 1),
(17, 'JOSE LOPEZ PEREX', '333333333333', 'sdf@gmail.com', '2019-05-29', 1),
(18, 'MARTIN MARTINEZ', '6624162499', '', '2019-05-30', 1),
(19, 'MARINA LARA DE MARTINEZ', '662123214645', '', '2019-02-18', 1),
(20, 'PRUEBA EDAD', '6662', 'sdf@gmail.com', '1991-11-08', 1),
(21, 'PRUEBA EDAD', '6662', 'sdf@gmail.com', '1991-11-08', 1);

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
(11, '100', '1'),
(12, '200', '1'),
(13, '300', '1'),
(14, '500', '1');

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
(1, 'root@pinguinosystems.com', 'MARTIN FRANCISCO', 'MARTINEZ', 'FEDERICO', 1, '123456', '1'),
(4, 'martin.francisco.martinez.f@gmail.com', 'MARTIN FRANCISCO', 'FEDERICO', 'MARTINEZ', 2, '123456', '1');

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
-- Indices de la tabla `costos`
--
ALTER TABLE `costos`
  ADD PRIMARY KEY (`id_costo`);

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
  MODIFY `id_nivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `costos`
--
ALTER TABLE `costos`
  MODIFY `id_costo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
