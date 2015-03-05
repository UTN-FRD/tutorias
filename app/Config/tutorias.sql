-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-03-2015 a las 22:04:29
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tutorias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestas`
--

CREATE TABLE IF NOT EXISTS `encuestas` (
`id` int(10) NOT NULL,
  `estudiante_id` int(10) NOT NULL,
  `pregunta_id` int(10) NOT NULL,
  `respuesta` text COLLATE utf8_spanish2_ci NOT NULL,
  `legajo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `encuestas`
--

INSERT INTO `encuestas` (`id`, `estudiante_id`, `pregunta_id`, `respuesta`, `legajo`) VALUES
(1, 3, 2, 'Si, asi es', 8449),
(2, 0, 3, 'No, para mi no ', 7881),
(3, 2, 1, 'Perfectamente', 8421),
(4, 1, 4, 'no, la verdad que no', 6771),
(5, 4, 1, '', 0),
(6, 4, 2, '', 0),
(7, 4, 3, '', 0),
(8, 4, 4, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE IF NOT EXISTS `estudiantes` (
`id` int(10) NOT NULL,
  `legajo` int(4) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `carrera` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `tutor_id` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id`, `legajo`, `nombre`, `carrera`, `tutor_id`) VALUES
(0, 7881, 'Santiago', 'Ingenieria en Sistemas de informacion', 0),
(1, 6771, 'Sergio', 'IngenierÃ­a en Sistemas', 0),
(3, 8449, 'Matias', 'IngenierÃ­a en Sistemas', 0),
(4, 1234, 'Camila', 'IngenierÃ­a en Sistemas', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE IF NOT EXISTS `preguntas` (
`id` int(10) NOT NULL,
  `pregunta` text COLLATE utf8_spanish2_ci NOT NULL,
  `orden` int(10) NOT NULL,
  `tipo` text COLLATE utf8_spanish2_ci NOT NULL,
  `valores` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `pregunta`, `orden`, `tipo`, `valores`) VALUES
(1, '¿El profesor de la asignatura completa la asistenca minima que se requiere?', 0, '', ''),
(2, '¿El profesor relaciona la teoria con la practica?', 2, '', ''),
(3, '¿El profesor explica bien los temas de su asignatura?', 1, '', ''),
(4, '¿Las clases son participativas?', 3, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutores`
--

CREATE TABLE IF NOT EXISTS `tutores` (
`id` int(10) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `carrera` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tutores`
--

INSERT INTO `tutores` (`id`, `nombre`, `carrera`) VALUES
(1, 'Osvaldo', 'IngenierÃ­a Electrica'),
(2, 'John Tutor', 'IngenierÃ­a Mecanica');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `encuestas`
--
ALTER TABLE `encuestas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tutores`
--
ALTER TABLE `tutores`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `encuestas`
--
ALTER TABLE `encuestas`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tutores`
--
ALTER TABLE `tutores`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
