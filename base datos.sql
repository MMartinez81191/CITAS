create database pinguino_citas;
use pinguino_citas;

DROP TABLE IF EXISTS `cat_niveles`;
CREATE TABLE `cat_niveles`(
	`id_nivel` int (11) not null auto_increment,
    `departamento` varchar(30),
    `nivel_usuario` int,
    PRIMARY KEY (`id_nivel`)
);
-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido_p` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido_m` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_nivel` int(11) DEFAULT NULL,
  `contrasena` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` char(1) COLLATE utf8_unicode_ci DEFAULT '1',
  PRIMARY KEY (`id_usuario`),
  FOREIGN KEY (`id_nivel`) REFERENCES `cat_niveles` (`id_nivel`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
`id_cliente` int(11) NOT NULL AUTO_INCREMENT,
`nombre_cliente` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
`telefono_cliente` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
`correo_cliente` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
`fecha_nacimiento` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
PRIMARY KEY (`id_cliente`)
);

INSERT INTO `cat_niveles` (departamento, nivel_usuario) VALUES ('ROOT', '0');
INSERT INTO `cat_niveles` (departamento, nivel_usuario) VALUES ('ADMINISTRADOR', '1');

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('1', 'root@pinguinosystems.com', 'MARTIN FRANCISCO', 'MARTINEZ', 'FEDERICO', '1', '123456', '1');


DROP TABLE IF exists `citas`;

CREATE TABLE `citas`(
  `id_cita` INT(11) NOT NULL auto_increment,
    `id_cliente` INT(11),
    `fecha` date,
    `hora` time,
    `activo` int(11),
    primary key(`id_cita`)

);