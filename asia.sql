-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2020 a las 23:59:48
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `asia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ingreso`
--

CREATE TABLE IF NOT EXISTS `tb_ingreso` (
`ID` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `FECHA_INGRESO` date NOT NULL,
  `HORA_INGRESO` time NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=413 ;

--
-- Volcado de datos para la tabla `tb_ingreso`
--

INSERT INTO `tb_ingreso` (`ID`, `ID_USUARIO`, `FECHA_INGRESO`, `HORA_INGRESO`) VALUES
(401, 6837, '2020-10-28', '10:10:29'),
(402, 6837, '2020-10-28', '10:10:42'),
(403, 6837, '2020-10-28', '10:10:12'),
(404, 6837, '2020-10-28', '10:10:58'),
(405, 6837, '2020-10-28', '10:10:11'),
(406, 6837, '2020-10-28', '11:10:41'),
(407, 6837, '2020-10-28', '12:10:16'),
(408, 6837, '2020-10-28', '17:10:13'),
(409, 6844, '2020-10-28', '17:10:41'),
(410, 6837, '2020-10-28', '18:10:21'),
(411, 6837, '2020-10-28', '19:10:02'),
(412, 6837, '2020-10-28', '19:10:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_permisos`
--

CREATE TABLE IF NOT EXISTS `tb_permisos` (
`ID` int(11) NOT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  `DESCRIPCION` longtext NOT NULL,
  `ACTIVO` tinyint(1) NOT NULL,
  `GRUPO` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tb_permisos`
--

INSERT INTO `tb_permisos` (`ID`, `NOMBRE`, `DESCRIPCION`, `ACTIVO`, `GRUPO`) VALUES
(1, 'Ver usuarios del sistema', 'Permite ver todos los usuarios que se encuentran activos/inactivos en el sistema.', 1, 1),
(2, 'Editar usuarios del sistema', 'Permite editar la información de un usuario.', 1, 1),
(3, 'Eliminar usuarios del sistema', 'Permite eliminar la información de un usuario del sistema.', 1, 1),
(4, 'Agregar usuarios del sistema', 'Permite agregar un nuevo usuario al sistema.', 1, 1),
(5, 'Agregar permisos a usuarios', 'Permite agregar permisos a los usuarios del sistema.', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_permisos_grupo`
--

CREATE TABLE IF NOT EXISTS `tb_permisos_grupo` (
`ID` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tb_permisos_grupo`
--

INSERT INTO `tb_permisos_grupo` (`ID`, `NOMBRE`) VALUES
(1, 'Usuarios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_rel_perm`
--

CREATE TABLE IF NOT EXISTS `tb_rel_perm` (
`ID` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `ID_PERMISO` int(11) NOT NULL,
  `FECHA_CARGA` date NOT NULL,
  `HORA_CARGA` time NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42944 ;

--
-- Volcado de datos para la tabla `tb_rel_perm`
--

INSERT INTO `tb_rel_perm` (`ID`, `ID_USUARIO`, `ID_PERMISO`, `FECHA_CARGA`, `HORA_CARGA`) VALUES
(42883, 6837, 5, '2020-01-30', '15:01:08'),
(42884, 6837, 4, '2020-01-30', '15:01:08'),
(42886, 6837, 2, '2020-01-30', '15:01:08'),
(42887, 6837, 3, '2020-01-30', '15:01:08'),
(42888, 6837, 1, '2020-01-30', '15:01:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuario`
--

CREATE TABLE IF NOT EXISTS `tb_usuario` (
`ID` int(11) NOT NULL,
  `NOMBRES` varchar(50) NOT NULL,
  `APELLIDO` varchar(50) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `CONTRASENIA` varchar(256) NOT NULL,
  `ACTIVO` tinyint(1) NOT NULL,
  `FECHA_CARGA` date NOT NULL,
  `HORA_CARGA` time NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6847 ;

--
-- Volcado de datos para la tabla `tb_usuario`
--

INSERT INTO `tb_usuario` (`ID`, `NOMBRES`, `APELLIDO`, `NOMBRE`, `CONTRASENIA`, `ACTIVO`, `FECHA_CARGA`, `HORA_CARGA`) VALUES
(6837, 'Fernando Matías', 'Cruz', 'matias_acsm', '$2y$10$nnhhPGy30VajW9fIMlShdO74BMSJSRjPury0MJzKqP6gvq7m25zTi', 1, '2017-06-11', '19:06:53');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_ingreso`
--
ALTER TABLE `tb_ingreso`
 ADD PRIMARY KEY (`ID`), ADD KEY `ID_USUARIO` (`ID_USUARIO`);

--
-- Indices de la tabla `tb_permisos`
--
ALTER TABLE `tb_permisos`
 ADD PRIMARY KEY (`ID`), ADD KEY `GRUPO` (`GRUPO`);

--
-- Indices de la tabla `tb_permisos_grupo`
--
ALTER TABLE `tb_permisos_grupo`
 ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tb_rel_perm`
--
ALTER TABLE `tb_rel_perm`
 ADD PRIMARY KEY (`ID`), ADD KEY `ID_USUARIO` (`ID_USUARIO`), ADD KEY `ID_PERMISO` (`ID_PERMISO`);

--
-- Indices de la tabla `tb_usuario`
--
ALTER TABLE `tb_usuario`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_ingreso`
--
ALTER TABLE `tb_ingreso`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=413;
--
-- AUTO_INCREMENT de la tabla `tb_permisos`
--
ALTER TABLE `tb_permisos`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tb_permisos_grupo`
--
ALTER TABLE `tb_permisos_grupo`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tb_rel_perm`
--
ALTER TABLE `tb_rel_perm`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42944;
--
-- AUTO_INCREMENT de la tabla `tb_usuario`
--
ALTER TABLE `tb_usuario`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6847;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_permisos`
--
ALTER TABLE `tb_permisos`
ADD CONSTRAINT `tb_permisos_ibfk_1` FOREIGN KEY (`GRUPO`) REFERENCES `tb_permisos_grupo` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_rel_perm`
--
ALTER TABLE `tb_rel_perm`
ADD CONSTRAINT `tb_rel_perm_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `tb_usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tb_rel_perm_ibfk_2` FOREIGN KEY (`ID_PERMISO`) REFERENCES `tb_permisos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
