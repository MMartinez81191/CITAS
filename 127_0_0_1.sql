-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-04-2019 a las 03:04:44
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
-- Base de datos: `cofipro`
--
CREATE DATABASE IF NOT EXISTS `cofipro` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cofipro`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idcliente` int(11) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `rfc` varchar(15) NOT NULL,
  `tel_oficina` varchar(12) DEFAULT NULL,
  `tel_celular` varchar(12) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idcliente`, `razon_social`, `rfc`, `tel_oficina`, `tel_celular`, `correo`) VALUES
(20, 'Instituto Tecnologico De Hermosillo colonia centro', 'RFCDDSSDDDDDD', '637-110-7411', '662-182-6760', 'cfe.cfe@cfe.gov'),
(21, 'SEINMI SA DE CV', 'SEINMI21254SD', '637-102-5669', '612-588-1101', 'cfe@cfe.gov.mx'),
(22, 'SEINMI SA DE CV Matriz 2', 'SEINMI21254SD', '637-102-5669', '612-588-1101', 'cfe@cfe.gov.mx'),
(23, 'Instituto Tecnologico De Hermosillo', 'CFE211108HSDR', '637-102-5669', '656-565-8888', 'cfe@cfe.gov.mx'),
(24, 'SEINMI SA DE CV', 'SEINMI21254SD', '623-663-2258', '612-588-1101', 'seinmi@seinmi.com.mx'),
(27, 'Comision federal de electricicad', 'SEINMI21254SD', '623-663-2258', '656-565-8888', 'seinmi@seinmi.com.mx'),
(28, 'SEINMI SA DE CV', 'CFE211108HSDR', '623-663-2258', '656-565-8888', 'seinmi@seinmi.com.mx'),
(29, 'SEINMI SA DE CV', 'SEINMI21254SD', '623-663-2258', '612-588-1101', 'cfe@cfe.gov.mx'),
(31, 'Instituto Tecnologico De Hermosillo', 'SEINMI21254SD', '623-663-2258', '612-588-1101', 'seinmi@seinmi.com.mx'),
(32, 'JUdidth was here', 'ASADASDFAFASD', '', '', ''),
(33, 'as', 'ASSSSAAAAAAAA', '662-182-6760', '122-266-9988', 'mf@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `idcontacto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tel_oficina` varchar(12) NOT NULL,
  `tel_celular` varchar(12) NOT NULL,
  `correo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`idcontacto`, `nombre`, `tel_oficina`, `tel_celular`, `correo`) VALUES
(1, 'Guillermo ', '6666666666', '6666666666', 'seinmi@seinmi.com.mx'),
(3, 'JOSE GUILLERMO GUAJARDO IZABAL', 'GUillermo ', '6621826760', '6621826760'),
(4, 'JOSE GUILLERMO GUAJARDO IZABAL', 'GUillermo ', '6621826760', '6621826760'),
(5, 'JOSE GUILLERMO GUAJARDO IZABAL', '9999999999', '7777777777', 'mfmf_oquitoa@hotmail.com'),
(6, 'JOSE GUILLERMO GUAJARDO IZABAL', '9999999999', '7777777777', 'mfmf_oquitoa@hotmail.com'),
(7, 'JOSE GUILLERMO GUAJARDO IZABAL', '9999999999', '7777777777', 'mfmf_oquitoa@hotmail.com'),
(8, 'JOSE GUILLERMO GUAJARDO IZABAL', '9999999999', '7777777777', 'mfmf_oquitoa@hotmail.com'),
(9, 'JOSE GUILLERMO GUAJARDO IZABAL', '9999999999', '7777777777', 'mfmf_oquitoa@hotmail.com'),
(14, 'JOSE GUILLERMO GUAJARDO IZABAL', '6621826760', '6371107867', 'seinmi@seinmi.com.mx'),
(19, 'Martin Francisco Martinez', '6621826760', '3333333333', 'sadfasd'),
(21, 'Martin Francisco Martinez', '6621826760', '7777777777', 'minera@gmail.com'),
(22, 'USUARIO PRUEBA', '637-110-7867', '612-588-1100', 'correo@correo.com'),
(24, '', '', '', ''),
(25, 'Martin Francisco Martinez Federico', '662-182-6760', '637-110-7867', 'martin.francisco.martinez.f@seinmi.com.mx'),
(26, 'Martin Martinez', '662-182-6760', '662-128-6258', 'martin@gmail.com'),
(27, 'MARTIN FRANCISCO MARTINEZ FEDERICO', '662-182-6760', '662-128-6258', 'cfe@cfe.gov'),
(28, 'MARTIN FRANCISCO MARTINEZ FEDERICO', '662-182-6760', '662-128-6258', 'cfe@cfe.gov'),
(29, 'MARTIN FRANCISCO MARTINEZ FEDERICO', '662-182-6760', '662-128-6258', 'cfe@cfe.gov'),
(30, 'asdf', '123-365-5441', '443-444-4444', 'cfe@cfe.gov'),
(31, 'martin pistolas', '662-182-6760', '443-444-4444', 'cfe@cfe.gov'),
(32, 'Adolfo RIvera Castillo', '637-110-6419', '637-110-6419', 'ith@vinculacion.ith.mx'),
(33, 'guillemo Plata Martinez', '637-110-7867', '637-110-7867', 'gplata@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresos`
--

CREATE TABLE `egresos` (
  `idegreso` int(11) NOT NULL,
  `idproyecto` int(11) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  `idmovimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `egresos`
--

INSERT INTO `egresos` (`idegreso`, `idproyecto`, `idproveedor`, `idmovimiento`) VALUES
(1, 14, 5, 1),
(2, 14, 4, 2),
(3, 14, 4, 5),
(5, 15, 5, 12),
(9, 17, 4, 40),
(10, 17, 5, 42),
(12, 17, 5, 51),
(13, 17, 4, 55),
(14, 17, 4, 63),
(15, 17, 6, 64),
(16, 20, 4, 67),
(17, 20, 4, 69),
(18, 17, 4, 71);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechas_proyecto`
--

CREATE TABLE `fechas_proyecto` (
  `idfecha_proyecto` int(11) NOT NULL,
  `fecha_inicio_real` date NOT NULL,
  `fecha_termino_real` date DEFAULT NULL,
  `fecha_inicio_prog` date NOT NULL,
  `fecha_termino_prog` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fechas_proyecto`
--

INSERT INTO `fechas_proyecto` (`idfecha_proyecto`, `fecha_inicio_real`, `fecha_termino_real`, `fecha_inicio_prog`, `fecha_termino_prog`) VALUES
(44, '2015-12-27', '2015-07-30', '2015-12-27', '2016-01-10'),
(45, '2016-02-26', '2016-08-19', '2016-02-25', '2016-02-26'),
(47, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(48, '2016-05-27', '0000-00-00', '2016-03-08', '2016-06-01'),
(49, '2016-05-29', '0000-00-00', '2016-05-29', '2016-05-29'),
(50, '2016-05-26', '0000-00-00', '2016-05-26', '2016-05-26'),
(51, '2016-05-26', '2016-05-26', '2016-05-26', '2016-05-26'),
(52, '2016-05-26', '0000-00-00', '2016-05-26', '2016-05-26'),
(53, '2016-05-27', '0000-00-00', '2016-05-26', '2016-05-26'),
(54, '2016-05-26', '2016-05-28', '2016-05-26', '2016-05-26'),
(55, '2016-07-30', '2016-07-30', '2016-07-16', '2016-07-16'),
(56, '2016-07-30', '2016-07-30', '2016-07-17', '2016-07-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `giros`
--

CREATE TABLE `giros` (
  `idgiro` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `giros`
--

INSERT INTO `giros` (`idgiro`, `nombre`) VALUES
(5, 'Construccion'),
(6, 'Pavimentado'),
(7, 'Estructuras Metalicas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `idingreso` int(11) NOT NULL,
  `idproyecto` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idmovimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`idingreso`, `idproyecto`, `idcliente`, `idmovimiento`) VALUES
(2, 14, 4, 4),
(3, 14, 5, 6),
(14, 15, 23, 27),
(15, 15, 21, 28),
(16, 15, 20, 29),
(17, 15, 20, 30),
(18, 15, 20, 31),
(19, 15, 20, 32),
(25, 17, 21, 44),
(27, 17, 20, 48),
(28, 17, 21, 52),
(29, 17, 20, 53),
(30, 17, 20, 54),
(31, 17, 20, 56),
(32, 17, 20, 58),
(33, 17, 20, 59),
(34, 17, 20, 60),
(35, 17, 28, 61),
(36, 17, 27, 62),
(37, 17, 23, 65),
(38, 20, 20, 66),
(39, 17, 20, 70),
(40, 21, 33, 72);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `ingreso_egreso`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `ingreso_egreso` (
`idproyecto` int(11)
,`idmovimiento` int(11)
,`fecha` date
,`numero_factura` int(11)
,`razon_social` varchar(100)
,`nombre` varchar(45)
,`importe` decimal(10,2)
,`tipo` char(1)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_colores`
--

CREATE TABLE `lista_colores` (
  `idcolor` int(11) NOT NULL,
  `color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lista_colores`
--

INSERT INTO `lista_colores` (`idcolor`, `color`) VALUES
(1, '#CD5C5C'),
(2, '#F08080'),
(3, '#FA8072'),
(4, '#E9967A'),
(5, '#FFA07A'),
(6, '#DC143C'),
(7, '#FF0000'),
(8, '#B22222'),
(9, '#8B0000'),
(10, '#FFC0CB'),
(11, '#FFB6C1'),
(12, '#FF69B4'),
(13, '#FF1493'),
(14, '#C71585'),
(15, '#DB7093'),
(16, '#FFA07A'),
(17, '#FF7F50'),
(18, '#FF6347'),
(19, '#FF4500'),
(20, '#FF8C00'),
(21, '#FFA500'),
(22, '#FFD700'),
(23, '#FFFF00'),
(24, '#FFFFE0'),
(25, '#FFFACD'),
(26, '#FAFAD2'),
(27, '#FFEFD5'),
(28, '#FFE4B5'),
(29, '#FFDAB9'),
(30, '#EEE8AA'),
(31, '#F0E68C'),
(32, '#BDB76B'),
(33, '#E6E6FA'),
(34, '#D8BFD8'),
(35, '#DDA0DD'),
(36, '#EE82EE'),
(37, '#DA70D6'),
(38, '#FF00FF'),
(39, '#FF00FF'),
(40, '#BA55D3'),
(41, '#9370DB'),
(42, '#8A2BE2'),
(43, '#9400D3'),
(44, '#9932CC'),
(45, '#8B008B'),
(46, '#800080'),
(47, '#4B0082'),
(48, '#6A5ACD'),
(49, '#483D8B'),
(50, '#ADFF2F'),
(51, '#7FFF00'),
(52, '#7CFC00'),
(53, '#00FF00'),
(54, '#32CD32'),
(55, '#98FB98'),
(56, '#90EE90'),
(57, '#00FA9A'),
(58, '#00FF7F'),
(59, '#3CB371'),
(60, '#2E8B57'),
(61, '#228B22'),
(62, '#008000'),
(63, '#006400'),
(64, '#9ACD32'),
(65, '#6B8E23'),
(66, '#808000'),
(67, '#556B2F'),
(68, '#66CDAA'),
(69, '#8FBC8F'),
(70, '#20B2AA'),
(71, '#008B8B'),
(72, '#008080'),
(73, '#00FFFF'),
(74, '#00FFFF'),
(75, '#E0FFFF'),
(76, '#AFEEEE'),
(77, '#7FFFD4'),
(78, '#40E0D0'),
(79, '#48D1CC'),
(80, '#00CED1'),
(81, '#5F9EA0'),
(82, '#4682B4'),
(83, '#B0C4DE'),
(84, '#B0E0E6'),
(85, '#ADD8E6'),
(86, '#87CEEB'),
(87, '#87CEFA'),
(88, '#00BFFF'),
(89, '#1E90FF'),
(90, '#6495ED'),
(91, '#7B68EE'),
(92, '#4169E1'),
(93, '#0000FF'),
(94, '#0000CD'),
(95, '#00008B'),
(96, '#000080'),
(97, '#191970'),
(98, '#FFF8DC'),
(99, '#FFEBCD'),
(100, '#FFE4C4'),
(101, '#FFDEAD'),
(102, '#F5DEB3'),
(103, '#DEB887'),
(104, '#D2B48C'),
(105, '#BC8F8F'),
(106, '#F4A460'),
(107, '#DAA520'),
(108, '#B8860B'),
(109, '#CD853F'),
(110, '#D2691E'),
(111, '#8B4513'),
(112, '#A0522D'),
(113, '#A52A2A'),
(114, '#800000'),
(115, '#FFFFFF'),
(116, '#FFFAFA'),
(117, '#F0FFF0'),
(118, '#F5FFFA'),
(119, '#F0FFFF'),
(120, '#F0F8FF'),
(121, '#F8F8FF'),
(122, '#F5F5F5'),
(123, '#FFF5EE'),
(124, '#F5F5DC'),
(125, '#FDF5E6'),
(126, '#FFFAF0'),
(127, '#FFFFF0'),
(128, '#FAEBD7'),
(129, '#FAF0E6'),
(130, '#FFF0F5'),
(131, '#FFE4E1'),
(132, '#DCDCDC'),
(133, '#D3D3D3'),
(134, '#C0C0C0'),
(135, '#A9A9A9'),
(136, '#808080'),
(137, '#696969'),
(138, '#778899'),
(139, '#708090'),
(140, '#2F4F4F'),
(141, '#000000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `idmovimiento` int(11) NOT NULL,
  `idproyecto` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_concepto` int(11) NOT NULL,
  `importe` decimal(10,2) NOT NULL,
  `numero_factura` int(11) DEFAULT NULL,
  `tipo` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`idmovimiento`, `idproyecto`, `fecha`, `id_concepto`, `importe`, `numero_factura`, `tipo`) VALUES
(1, 14, '2016-01-02', 7, '1200.00', 1010101, 'E'),
(2, 14, '2015-12-31', 7, '3434.00', 12269557, 'E'),
(4, 14, '2015-12-31', 1, '1500.00', NULL, 'I'),
(5, 14, '2016-02-19', 7, '12000.00', 2147483647, 'E'),
(6, 14, '2016-02-27', 2, '11000.00', NULL, 'I'),
(13, 15, '0000-00-00', 1, '12000.00', NULL, 'I'),
(20, 15, '0000-00-00', 1, '0.00', NULL, 'I'),
(27, 15, '2016-03-09', 2, '100.00', NULL, 'I'),
(28, 15, '2016-03-10', 1, '1.00', NULL, 'I'),
(29, 15, '2016-03-10', 2, '1.00', NULL, 'I'),
(30, 15, '2016-03-05', 1, '1.00', NULL, 'I'),
(31, 15, '2016-03-10', 2, '1.00', NULL, 'I'),
(32, 15, '2016-03-10', 2, '1.00', NULL, 'I'),
(40, 17, '2016-03-30', 6, '121.00', 2221, 'E'),
(42, 17, '2016-03-30', 7, '1200.00', 12000, 'E'),
(44, 17, '2016-04-03', 2, '12000.00', NULL, 'I'),
(48, 17, '2016-04-21', 2, '1200.00', NULL, 'I'),
(51, 17, '2016-04-27', 5, '1200.00', 1200336, 'E'),
(52, 17, '2016-04-28', 2, '13000.00', NULL, 'I'),
(53, 17, '2016-04-27', 1, '1200.00', NULL, 'I'),
(54, 17, '2016-04-27', 1, '12000.00', NULL, 'I'),
(55, 17, '2016-04-27', 7, '120000.00', 2147483647, 'E'),
(56, 17, '2016-04-27', 1, '1200.50', NULL, 'I'),
(57, 17, '2016-06-25', 2, '1200.00', NULL, 'I'),
(58, 17, '2016-06-30', 2, '1200.00', NULL, 'I'),
(59, 17, '2016-06-30', 3, '12.50', NULL, 'I'),
(60, 17, '2016-06-30', 3, '19.00', NULL, 'I'),
(61, 17, '2016-07-01', 3, '11.99', NULL, 'I'),
(62, 17, '2016-08-19', 3, '1250.50', NULL, 'I'),
(63, 17, '2016-11-08', 7, '192000.10', 163360, 'E'),
(64, 17, '2016-12-31', 7, '166666.99', 1356698, 'E'),
(65, 17, '2016-06-30', 2, '121324.99', NULL, 'I'),
(66, 20, '2016-06-30', 1, '12200.20', NULL, 'I'),
(67, 20, '2016-07-01', 5, '132.90', 163360, 'E'),
(68, 20, '0000-00-00', 5, '1350.50', 0, 'E'),
(69, 20, '2016-06-30', 5, '1300.85', 1356698, 'E'),
(70, 17, '2016-07-01', 2, '1200.70', NULL, 'I'),
(71, 17, '2016-06-30', 8, '9000.99', 2147483647, 'E'),
(72, 21, '2019-03-26', 3, '12000.00', NULL, 'I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `idproveedor` int(11) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `rfc` varchar(15) NOT NULL,
  `tel_oficina` varchar(12) DEFAULT NULL,
  `tel_celular` varchar(12) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idproveedor`, `razon_social`, `rfc`, `tel_oficina`, `tel_celular`, `correo`) VALUES
(4, 'Comercial del Herrrero', 'RFC', '6621826760', '0000000000', 'minera@gmail.com'),
(5, 'Tornillos y mangeras de sonra Actualizado', 'TOMASON25584', '662-182-6760', '637-110-7860', 'tomason@email.com'),
(6, 'Marint INC', 'ASESSDFFESSS', '', '', ''),
(7, 'sadasdf', 'ASDFASDFASDFA', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `idproyecto` int(11) NOT NULL,
  `nombre_proyecto` varchar(100) NOT NULL,
  `idfecha_proyecto` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idgiro` int(11) NOT NULL,
  `idcontacto` int(11) NOT NULL,
  `monto_contrato` decimal(17,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`idproyecto`, `nombre_proyecto`, `idfecha_proyecto`, `idcliente`, `idgiro`, `idcontacto`, `monto_contrato`) VALUES
(14, 'Locales', 44, 4, 5, 21, '150000.00'),
(15, 'Locales', 45, 22, 6, 22, '300.00'),
(17, 'Cancha de pasto sintetico ITH', 48, 20, 5, 25, '3.15'),
(18, 'asdf', 51, 20, 5, 28, '1250.00'),
(19, 'Proyecto prueba 2', 53, 20, 5, 30, '150.00'),
(20, 'proyecyto prueba 3', 54, 20, 5, 31, '345.00'),
(21, 'Proyecto Puente', 55, 20, 5, 32, '12000.55'),
(22, 'Proyecto Puente 2', 56, 23, 7, 33, '200.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_gastos`
--

CREATE TABLE `tipo_gastos` (
  `idtipo_gasto` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_gastos`
--

INSERT INTO `tipo_gastos` (`idtipo_gasto`, `nombre`, `color`) VALUES
(5, 'Material', '#CD5C5C'),
(6, 'Mano de obra', '#812d2d'),
(7, 'Material Electronico', '#CD5C5C'),
(8, 'bb', '#FF00FF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_ingresos`
--

CREATE TABLE `tipo_ingresos` (
  `idtipo_ingreso` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `color` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_ingresos`
--

INSERT INTO `tipo_ingresos` (`idtipo_ingreso`, `nombre`, `color`) VALUES
(1, 'Anticipo', NULL),
(2, 'Estimacion', NULL),
(3, 'Finiquito', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `nivel` int(1) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre`, `usuario`, `nivel`, `password`) VALUES
(159, 'Adminsitrador', 'ADMIN', 1, 'ADMIN123'),
(160, 'pito perez', 'USER', 2, 'USER123'),
(161, 'SD', 'SD', 2, 'SADFSADF');

-- --------------------------------------------------------

--
-- Estructura para la vista `ingreso_egreso`
--
DROP TABLE IF EXISTS `ingreso_egreso`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ingreso_egreso`  AS  (select `egresos`.`idproyecto` AS `idproyecto`,`movimientos`.`idmovimiento` AS `idmovimiento`,`movimientos`.`fecha` AS `fecha`,`movimientos`.`numero_factura` AS `numero_factura`,`proveedores`.`razon_social` AS `razon_social`,`tipo_gastos`.`nombre` AS `nombre`,`movimientos`.`importe` AS `importe`,`movimientos`.`tipo` AS `tipo` from (((`egresos` join `movimientos` on((`egresos`.`idmovimiento` = `movimientos`.`idmovimiento`))) join `proveedores` on((`egresos`.`idproveedor` = `proveedores`.`idproveedor`))) join `tipo_gastos` on((`movimientos`.`id_concepto` = `tipo_gastos`.`idtipo_gasto`)))) union all (select `ingresos`.`idproyecto` AS `idproyecto`,`movimientos`.`idmovimiento` AS `idmovimiento`,`movimientos`.`fecha` AS `fecha`,`movimientos`.`numero_factura` AS `numero_factura`,`clientes`.`razon_social` AS `razon_social`,`tipo_ingresos`.`nombre` AS `nombre`,`movimientos`.`importe` AS `importe`,`movimientos`.`tipo` AS `tipo` from (((`ingresos` join `movimientos` on((`ingresos`.`idmovimiento` = `movimientos`.`idmovimiento`))) join `clientes` on((`ingresos`.`idcliente` = `clientes`.`idcliente`))) join `tipo_ingresos` on((`movimientos`.`id_concepto` = `tipo_ingresos`.`idtipo_ingreso`)))) order by `fecha` desc ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`idcontacto`);

--
-- Indices de la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD PRIMARY KEY (`idegreso`),
  ADD KEY `fk_egresos_1` (`idproyecto`);

--
-- Indices de la tabla `fechas_proyecto`
--
ALTER TABLE `fechas_proyecto`
  ADD PRIMARY KEY (`idfecha_proyecto`);

--
-- Indices de la tabla `giros`
--
ALTER TABLE `giros`
  ADD PRIMARY KEY (`idgiro`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`idingreso`),
  ADD KEY `fk_ingresos_1_idx` (`idproyecto`);

--
-- Indices de la tabla `lista_colores`
--
ALTER TABLE `lista_colores`
  ADD PRIMARY KEY (`idcolor`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`idmovimiento`),
  ADD KEY `fk_movimientos_1_idx` (`idproyecto`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idproveedor`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`idproyecto`);

--
-- Indices de la tabla `tipo_gastos`
--
ALTER TABLE `tipo_gastos`
  ADD PRIMARY KEY (`idtipo_gasto`);

--
-- Indices de la tabla `tipo_ingresos`
--
ALTER TABLE `tipo_ingresos`
  ADD PRIMARY KEY (`idtipo_ingreso`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `idcontacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `egresos`
--
ALTER TABLE `egresos`
  MODIFY `idegreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `fechas_proyecto`
--
ALTER TABLE `fechas_proyecto`
  MODIFY `idfecha_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `giros`
--
ALTER TABLE `giros`
  MODIFY `idgiro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `idingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `lista_colores`
--
ALTER TABLE `lista_colores`
  MODIFY `idcolor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `idmovimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `idproyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `tipo_gastos`
--
ALTER TABLE `tipo_gastos`
  MODIFY `idtipo_gasto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipo_ingresos`
--
ALTER TABLE `tipo_ingresos`
  MODIFY `idtipo_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD CONSTRAINT `fk_egresos_1` FOREIGN KEY (`idproyecto`) REFERENCES `proyectos` (`idproyecto`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `fk_ingresos_1` FOREIGN KEY (`idproyecto`) REFERENCES `proyectos` (`idproyecto`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `fk_movimientos_1` FOREIGN KEY (`idproyecto`) REFERENCES `proyectos` (`idproyecto`) ON DELETE CASCADE ON UPDATE NO ACTION;
--
-- Base de datos: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(11) NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Volcado de datos para la tabla `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"cofipro\",\"table\":\"usuarios\"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float UNSIGNED NOT NULL DEFAULT '0',
  `y` float UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Volcado de datos para la tabla `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2019-04-03 01:03:50', '{\"lang\":\"es\",\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indices de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indices de la tabla `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indices de la tabla `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indices de la tabla `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indices de la tabla `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indices de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indices de la tabla `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indices de la tabla `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indices de la tabla `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indices de la tabla `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indices de la tabla `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Base de datos: `pinguino_citas`
--
CREATE DATABASE IF NOT EXISTS `pinguino_citas` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pinguino_citas`;

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
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `activo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_cita`, `id_cliente`, `fecha`, `hora`, `activo`) VALUES
(12, 1, '2019-10-08', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_cliente` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo_cliente` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `telefono_cliente`, `correo_cliente`, `fecha_nacimiento`) VALUES
(1, 'Jose Lopez', '6644162499', 'x@x', '22-12-2019'),
(2, 'MARTIN', '6624162499', 'c@gmail.com', 'DSDFD');

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
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
--
-- Base de datos: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
