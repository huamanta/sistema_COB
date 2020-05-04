-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2020 a las 19:37:53
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_cob`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ant_patologico`
--

CREATE TABLE `ant_patologico` (
  `id_ant_patologico` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(1) COLLATE utf8_spanish_ci DEFAULT '1',
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ant_patologico`
--

INSERT INTO `ant_patologico` (`id_ant_patologico`, `created_at`, `updated_at`, `nombre`, `descripcion`, `estado`, `deleted_at`) VALUES
(1, '2020-03-03 23:03:24', '2020-03-03 00:00:00', 'Cardiopatia', NULL, '1', NULL),
(2, '2020-03-04 02:17:46', '2020-03-04 00:00:00', 'Hepatitis', NULL, '1', NULL),
(3, '2020-03-04 02:17:46', '2020-03-24 00:00:00', 'Alergias', NULL, '1', NULL),
(4, '2020-03-04 02:17:46', '2020-03-31 00:00:00', 'Tuberculosis', NULL, '1', NULL),
(5, '2020-03-04 02:17:46', '2020-03-04 00:00:00', 'Hipertención arterial', NULL, '1', NULL),
(6, '2020-03-04 02:17:46', '2020-03-04 00:00:00', 'ETS', '', '1', NULL),
(7, '2020-03-04 02:17:46', '2020-03-25 00:00:00', 'Epilepcia', NULL, '1', NULL),
(8, '2020-03-04 02:17:46', '2020-03-24 00:00:00', 'Diabetes', NULL, '1', NULL),
(12, '2020-03-06 03:22:41', '2020-03-06 09:22:41', 'New', '', '1', '2020-03-06 09:28:51'),
(13, '2020-03-06 03:27:23', '2020-03-06 09:27:23', 'Yo', 'muebles', '1', '2020-03-06 09:28:44'),
(14, '2020-03-06 04:28:05', '2020-03-06 10:28:05', '', '', '1', '2020-03-06 10:28:15'),
(15, '2020-03-06 04:33:19', '2020-03-06 10:33:19', '', '', '1', '2020-03-06 10:33:23'),
(16, '2020-03-06 04:36:04', '2020-03-06 10:36:04', '', '', '1', '2020-03-06 10:36:10'),
(17, '2020-03-06 04:36:37', '2020-03-06 10:36:37', '', '', '1', '2020-03-06 10:36:42'),
(18, '2020-03-06 04:36:56', '2020-03-06 10:36:56', '', '', '1', '2020-03-06 10:37:01'),
(19, '2020-03-06 04:37:48', '2020-03-06 10:37:48', 'new', '', '1', '2020-03-06 20:38:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id_cita` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `titulo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(2000) COLLATE utf8_spanish_ci NOT NULL,
  `date_start` date DEFAULT NULL,
  `hour_start` time DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `hour_end` time DEFAULT NULL,
  `color` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`id_cita`, `created_at`, `updated_at`, `titulo`, `descripcion`, `date_start`, `hour_start`, `date_end`, `hour_end`, `color`, `id_paciente`, `id_usuario`, `deleted_at`) VALUES
(24, '2020-05-03 09:31:03', '2020-05-03 16:31:03', 'con cliente', 'avatar', '2020-05-03', '10:00:00', '2020-05-04', '10:00:00', '#8000ff', 7, 1, NULL),
(25, '2020-05-03 09:33:17', '2020-05-03 16:33:36', 'abvhxvhx', 'hvxuvux', '2020-05-03', NULL, '2020-05-04', NULL, '#000000', 7, 1, NULL),
(26, '2020-05-03 09:39:54', '2020-05-03 16:39:54', 'knbgyhuj', 'ytrdes', '2020-05-03', '10:30:00', '2020-05-03', '11:20:00', '#0000ff', 1, 1, NULL),
(27, '2020-05-03 10:14:01', '2020-05-03 17:14:01', 'con cliente', '', '2020-05-07', NULL, '2020-05-07', NULL, '#000000', 1, 1, NULL),
(28, '2020-05-03 10:25:58', '2020-05-04 13:54:39', 'Sacada de diente', 'gyhgyvg', '2020-05-05', NULL, NULL, NULL, '#45a547', 1, 1, NULL),
(29, '2020-05-04 07:05:34', '2020-05-04 14:05:34', 'changes', '', '2020-05-04', NULL, NULL, NULL, '#400080', 12, 1, NULL),
(30, '2020-05-04 07:23:40', '2020-05-04 14:23:40', 'jbhgtf', '', '2020-05-12', NULL, NULL, NULL, '#000000', 1, 1, '2020-05-04 14:48:18'),
(31, '2020-05-04 07:26:52', '2020-05-04 14:29:12', 'Profiliaxis molar de tres unidades', 'sd', '2020-05-04', NULL, '2020-05-09', NULL, '#0c9813', 12, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_historia`
--

CREATE TABLE `detalle_historia` (
  `id_detalle_historia` int(11) NOT NULL,
  `id_historia_clinica` int(11) DEFAULT NULL,
  `id_tratamiento` int(11) DEFAULT '0',
  `id_diente` int(11) DEFAULT '0',
  `id_ant_patologico` int(11) DEFAULT '0',
  `cantidad` double NOT NULL,
  `precio` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_historia`
--

INSERT INTO `detalle_historia` (`id_detalle_historia`, `id_historia_clinica`, `id_tratamiento`, `id_diente`, `id_ant_patologico`, `cantidad`, `precio`, `total`) VALUES
(435, 21, NULL, 8, NULL, 0, 0, 0),
(436, 21, NULL, 14, NULL, 0, 0, 0),
(437, 21, NULL, 40, NULL, 0, 0, 0),
(438, 21, NULL, 31, NULL, 0, 0, 0),
(439, 21, NULL, NULL, 2, 0, 0, 0),
(440, 21, NULL, NULL, 1, 0, 0, 0),
(441, 21, 1, NULL, NULL, 1, 15, 15),
(442, 21, 12, NULL, NULL, 1, 230, 230),
(443, 22, NULL, NULL, 1, 0, 0, 0),
(444, 22, NULL, NULL, 4, 0, 0, 0),
(445, 22, NULL, NULL, 7, 0, 0, 0),
(446, 22, NULL, 8, NULL, 0, 0, 0),
(447, 22, NULL, 13, NULL, 0, 0, 0),
(448, 22, NULL, 31, NULL, 0, 0, 0),
(449, 22, NULL, 39, NULL, 0, 0, 0),
(450, 22, NULL, 45, NULL, 0, 0, 0),
(451, 22, NULL, 40, NULL, 0, 0, 0),
(452, 22, NULL, 22, NULL, 0, 0, 0),
(453, 22, NULL, 14, NULL, 0, 0, 0),
(454, 22, 4, NULL, NULL, 1, 120, 120),
(455, 22, 10, NULL, NULL, 1, 90, 90);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_historia_temp`
--

CREATE TABLE `detalle_historia_temp` (
  `token` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `id_tratamiento` int(11) DEFAULT NULL,
  `id_diente` int(11) DEFAULT NULL,
  `id_ant_patologico` int(11) DEFAULT NULL,
  `cantidad` double NOT NULL,
  `precio` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_historia_temp`
--

INSERT INTO `detalle_historia_temp` (`token`, `id_tratamiento`, `id_diente`, `id_ant_patologico`, `cantidad`, `precio`, `total`) VALUES
('403720b7964ada4c4bfff631252ab2cc', NULL, 7, NULL, 0, 0, 0),
('21232f297a57a5a743894a0e4a801fc3', NULL, NULL, 5, 0, 0, 0),
('403720b7964ada4c4bfff631252ab2cc', NULL, 5, NULL, 0, 0, 0),
('21232f297a57a5a743894a0e4a801fc3', NULL, NULL, 4, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diente`
--

CREATE TABLE `diente` (
  `id_diente` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `nombre` varchar(225) COLLATE utf8_spanish_ci DEFAULT NULL,
  `numero` int(1) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `diente`
--

INSERT INTO `diente` (`id_diente`, `created_at`, `updated_at`, `nombre`, `numero`, `deleted`) VALUES
(1, '2020-03-03 23:30:43', '2020-03-03 00:00:00', '', 18, NULL),
(2, '2020-03-03 23:30:43', '2020-03-03 00:00:00', NULL, 17, NULL),
(3, '2020-03-03 23:30:43', '2020-03-03 00:00:00', NULL, 16, NULL),
(4, '2020-03-03 23:30:43', '2020-03-03 00:00:00', NULL, 15, NULL),
(5, '2020-03-03 23:30:43', '2020-03-03 00:00:00', NULL, 14, NULL),
(6, '2020-03-03 23:30:43', '2020-03-03 00:00:00', NULL, 13, NULL),
(7, '2020-03-03 23:30:43', '2020-03-03 00:00:00', NULL, 12, NULL),
(8, '2020-03-03 23:30:43', '2020-03-03 00:00:00', NULL, 11, NULL),
(9, '2020-03-04 00:09:26', '2020-03-04 00:00:00', NULL, 55, NULL),
(10, '2020-03-04 00:09:26', '2020-03-04 00:00:00', NULL, 54, NULL),
(11, '2020-03-04 00:09:26', '2020-03-04 00:00:00', NULL, 53, NULL),
(12, '2020-03-04 00:09:26', '2020-03-18 00:00:00', NULL, 52, NULL),
(13, '2020-03-04 00:09:26', '2020-03-04 00:00:00', NULL, 51, NULL),
(14, '2020-03-04 00:25:44', '2020-03-04 00:00:00', NULL, 21, NULL),
(15, '2020-03-04 00:25:44', '2020-03-04 00:00:00', NULL, 22, NULL),
(16, '2020-03-04 00:25:44', '2020-03-31 00:00:00', NULL, 23, NULL),
(17, '2020-03-04 00:25:44', '2020-03-17 00:00:00', NULL, 24, NULL),
(18, '2020-03-04 00:25:44', '2020-03-04 00:00:00', NULL, 25, NULL),
(19, '2020-03-04 00:25:44', '2020-03-30 00:00:00', NULL, 26, NULL),
(20, '2020-03-04 00:25:44', '2020-03-04 00:00:00', NULL, 27, NULL),
(21, '2020-03-04 00:25:44', '2020-03-04 00:00:00', NULL, 28, NULL),
(22, '2020-03-04 00:28:27', '2020-03-04 00:00:00', NULL, 61, NULL),
(23, '2020-03-04 00:28:27', '2020-03-24 00:00:00', NULL, 62, NULL),
(24, '2020-03-04 00:28:27', '2020-03-31 00:00:00', NULL, 63, NULL),
(25, '2020-03-04 00:28:27', '2020-03-09 00:00:00', NULL, 64, NULL),
(26, '2020-03-04 00:28:27', '2020-03-04 00:00:00', NULL, 65, NULL),
(27, '2020-03-04 00:29:15', '2020-03-04 00:00:00', NULL, 85, NULL),
(28, '2020-03-04 00:35:20', '2020-03-04 00:00:00', NULL, 84, NULL),
(29, '2020-03-04 00:35:20', '2020-03-04 00:00:00', NULL, 83, NULL),
(30, '2020-03-04 00:35:20', '2020-03-04 00:00:00', NULL, 82, NULL),
(31, '2020-03-04 00:35:20', '2020-03-25 00:00:00', NULL, 81, NULL),
(32, '2020-03-04 00:35:20', '2020-03-04 00:00:00', NULL, 48, NULL),
(33, '2020-03-04 00:44:38', '2020-03-04 00:00:00', NULL, 47, NULL),
(34, '2020-03-04 00:44:38', '2020-03-04 00:00:00', NULL, 46, NULL),
(35, '2020-03-04 00:44:38', '2020-03-04 00:00:00', NULL, 45, NULL),
(36, '2020-03-04 00:44:38', '2020-03-25 00:00:00', NULL, 44, NULL),
(37, '2020-03-04 00:44:38', '2020-03-31 00:00:00', NULL, 43, NULL),
(38, '2020-03-04 00:44:38', '2020-03-04 00:00:00', NULL, 42, NULL),
(39, '2020-03-04 00:44:38', '2020-03-04 00:00:00', NULL, 41, NULL),
(40, '2020-03-04 00:47:13', '2020-03-04 00:00:00', NULL, 71, NULL),
(41, '2020-03-04 00:47:13', '2020-03-04 00:00:00', NULL, 72, NULL),
(42, '2020-03-04 00:47:13', '2020-03-17 00:00:00', NULL, 73, NULL),
(43, '2020-03-04 00:47:13', '2020-03-04 00:00:00', NULL, 74, NULL),
(44, '2020-03-04 00:47:13', '2020-03-04 00:00:00', NULL, 75, NULL),
(45, '2020-03-04 00:52:36', '2020-03-04 00:00:00', NULL, 31, NULL),
(46, '2020-03-04 00:52:36', '2020-03-04 00:00:00', NULL, 32, NULL),
(47, '2020-03-04 00:52:36', '2020-03-31 00:00:00', NULL, 33, NULL),
(48, '2020-03-04 00:52:36', '2020-03-30 00:00:00', NULL, 34, NULL),
(49, '2020-03-04 00:52:36', '2020-03-04 00:00:00', NULL, 35, NULL),
(50, '2020-03-04 00:52:36', '2020-03-04 00:00:00', NULL, 36, NULL),
(51, '2020-03-04 00:52:36', '2020-03-31 00:00:00', NULL, 37, NULL),
(52, '2020-03-04 00:52:36', '2020-03-31 00:00:00', NULL, 38, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_civil`
--

CREATE TABLE `estado_civil` (
  `id_estado_civil` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nombre` varchar(225) COLLATE utf8_spanish_ci DEFAULT NULL,
  `abreviacion` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estado_civil`
--

INSERT INTO `estado_civil` (`id_estado_civil`, `created_at`, `nombre`, `abreviacion`, `estado`, `deleted_at`) VALUES
(1, '2020-03-03 23:04:21', 'Soltero', 'S', '1', NULL),
(2, '2020-03-05 23:16:40', 'Casado', 'C', '1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto_perfil`
--

CREATE TABLE `foto_perfil` (
  `id_foto_perfil` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_foto` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `foto_perfil`
--

INSERT INTO `foto_perfil` (`id_foto_perfil`, `created_at`, `nombre`, `tipo_foto`, `estado`, `id_usuario`, `deleted_at`) VALUES
(24, '2020-04-23 21:30:00', '1587695400_DSC02745.JPG', '1', '0', 1, '2020-05-03 02:38:36'),
(25, '2020-05-02 19:38:36', '1588466316_DSC02748.JPG', '1', '0', 1, '2020-05-03 02:43:00'),
(26, '2020-05-02 19:43:00', '1588466580_DSC02746.JPG', '1', '1', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id_genero` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nombre` varchar(225) COLLATE utf8_spanish_ci DEFAULT NULL,
  `abreviacion` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id_genero`, `created_at`, `nombre`, `abreviacion`, `estado`, `deleted_at`) VALUES
(1, '2020-03-03 23:09:28', 'Masculino', 'M', '1', NULL),
(2, '2020-03-05 23:17:18', 'Femenino', 'F', '1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_clinica`
--

CREATE TABLE `historia_clinica` (
  `id_historia_clinica` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `diagnostico` varchar(1000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones` varchar(1000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(1) COLLATE utf8_spanish_ci DEFAULT '1',
  `deleted_at` datetime DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `historia_clinica`
--

INSERT INTO `historia_clinica` (`id_historia_clinica`, `created_at`, `updated_at`, `diagnostico`, `observaciones`, `estado`, `deleted_at`, `id_paciente`, `id_usuario`) VALUES
(21, '2020-05-03 17:13:06', '2020-05-04 00:13:06', 'hiugyftdr', 'edrfghyuj', '1', NULL, 2, 1),
(22, '2020-05-03 21:51:00', '2020-05-04 04:51:00', 'Ninguno', 'Ninguno', '1', NULL, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id_paciente` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `nombre_apoderado` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono_apoderado` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id_paciente`, `updated_at`, `created_at`, `nombre_apoderado`, `telefono_apoderado`, `id_persona`, `deleted_at`) VALUES
(1, '2020-03-03 23:17:08', '2020-03-03 00:00:00', 'Felipe huamanta Rojas', '9999999999', 1, NULL),
(2, '2020-03-05 19:12:46', '2020-03-05 00:00:00', '4nk kenfgkenr', '74785754', 4, NULL),
(7, '2020-03-16 17:31:02', '2020-03-16 11:31:02', 'alko', '', 14, NULL),
(8, '2020-05-03 17:56:22', '2020-05-03 10:56:28', '', '', 18, NULL),
(9, '2020-05-03 18:20:57', '2020-05-03 11:21:03', '', '', 19, NULL),
(10, '2020-05-03 18:21:17', '2020-05-03 11:21:31', '', '', 20, NULL),
(11, '2020-05-03 18:32:47', '2020-05-03 11:32:57', '', '', 21, NULL),
(12, '2020-05-04 14:03:39', '2020-05-04 07:03:39', 'njbhgyftdrstdfghjk', '', 22, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id_pago` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `fecha_pago` datetime NOT NULL,
  `a_cuenta` double NOT NULL,
  `saldo` double NOT NULL,
  `id_historia_clinica` int(11) NOT NULL,
  `id_tratamiento` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`id_pago`, `created_at`, `updated_at`, `fecha_pago`, `a_cuenta`, `saldo`, `id_historia_clinica`, `id_tratamiento`, `deleted_at`) VALUES
(1, '2020-05-03 17:13:07', '0000-00-00 00:00:00', '2020-05-03 01:52:12', 2, 13, 21, 1, NULL),
(2, '2020-05-03 17:13:07', '0000-00-00 00:00:00', '2020-05-03 02:14:27', 400, 60, 21, 12, NULL),
(3, '2020-05-03 21:51:01', '0000-00-00 00:00:00', '2020-05-04 04:50:31', 100, 20, 22, 4, NULL),
(4, '2020-05-03 21:51:01', '0000-00-00 00:00:00', '2020-05-04 04:50:50', 90, 0, 22, 10, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_temp`
--

CREATE TABLE `pago_temp` (
  `token` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_pago` datetime NOT NULL,
  `a_cuenta` double NOT NULL,
  `saldo` double NOT NULL,
  `id_tratamiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id_rol` int(11) NOT NULL,
  `id_ruta` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id_rol`, `id_ruta`, `id_usuario`, `created_at`, `deleted_at`) VALUES
(1, 1, 1, '2020-03-05 10:17:34', NULL),
(1, 2, 1, '2020-03-05 10:17:34', NULL),
(1, 3, 1, '2020-03-09 23:43:09', NULL),
(1, 4, 1, '2020-03-05 10:56:08', NULL),
(1, 5, 1, '2020-03-11 13:45:09', NULL),
(1, 6, 1, '2020-03-05 10:56:08', NULL),
(1, 7, 1, '2020-03-05 12:13:46', NULL),
(1, 8, 1, '2020-03-05 12:13:46', NULL),
(1, 9, 1, '2020-03-08 19:41:44', NULL),
(1, 10, 1, '2020-03-08 21:48:11', NULL),
(1, 11, 1, '2020-03-08 14:55:45', NULL),
(1, 12, 1, '2020-03-06 00:40:27', NULL),
(1, 13, 1, '2020-03-06 00:52:27', NULL),
(1, 14, 1, '2020-03-06 00:59:47', NULL),
(1, 15, 1, '2020-03-09 12:05:12', NULL),
(1, 16, 1, '2020-03-10 10:05:52', NULL),
(2, 1, 1, '2020-04-25 18:46:04', NULL),
(2, 2, 1, '2020-04-05 16:40:40', NULL),
(2, 3, 1, '2020-04-05 16:40:42', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `primer_nombre` varchar(225) COLLATE utf8_spanish_ci DEFAULT NULL,
  `segundo_nombre` varchar(225) COLLATE utf8_spanish_ci DEFAULT NULL,
  `primer_apellido` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `segundo_apellido` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `numero_documento` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ubigeo` varchar(8) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(225) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ocupacion` varchar(225) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_tipo_documento` int(11) DEFAULT NULL,
  `id_estado_civil` int(11) DEFAULT NULL,
  `id_genero` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_persona`, `created_at`, `updated_at`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `fecha_nacimiento`, `numero_documento`, `email`, `telefono`, `ubigeo`, `direccion`, `ocupacion`, `id_tipo_documento`, `id_estado_civil`, `id_genero`, `deleted_at`) VALUES
(1, '2020-03-03 23:13:49', '2020-03-03 00:00:00', 'Alis', '', 'Huamanta', 'Edquen', '2000-05-03', '87676567', 'elderhuaman@upeu.edu.pe', '987876765', '010102', 'Chachapoyas', 'Ingeniero de sistemas', 1, 1, 1, NULL),
(4, '2020-03-05 13:12:46', '2020-03-05 19:12:46', 'ROY', '', 'HUAMANTA', 'EDQUEN', '2020-03-05', '71845255', 'alexito11.ah@gmail.com', '345653466', '020101', 'uwefurguf', 'nknk', 1, 1, 1, NULL),
(5, '2020-03-05 23:25:25', '2020-03-06 05:25:25', 'ELDER', 'ALEX', 'HUAMAN', 'MALUQUISH', '2017-02-01', '72425825', 'elderhuaman@upeu.edu.pe', '984092266', '010105', 'Tambo', 'Administrador Premiun', 1, 1, 1, NULL),
(14, '2020-03-16 11:31:02', '2020-03-16 17:31:02', 'FILOMENA', '', 'SILLO', 'TITO', '1970-01-01', '09877676', 'elderhuaman@upeu.edu.pe', '984092266', '020103', 'Chachapoyas', '', 1, 1, 1, NULL),
(15, '2020-04-13 19:31:54', '2020-04-14 02:31:54', NULL, '', NULL, '', '1970-01-01', '', '', '', '', '', '', 1, 0, 2, NULL),
(16, '2020-04-13 19:32:03', '2020-04-14 02:32:03', NULL, '', NULL, '', '1970-01-01', '', '', '', '', '', '', 1, 0, 2, NULL),
(17, '2020-04-13 19:32:06', '2020-04-14 02:32:06', NULL, '', NULL, '', '1970-01-01', '', '', '', '', '', '', 1, 0, 2, NULL),
(18, '2020-05-03 10:56:22', '2020-05-03 17:56:22', 'Julio', 'Dante', '', 'ghgjkjk', '1998-02-02', '97878786', '', '', '010106', 'Anexo el verde', 'Estudiante', 1, 1, 1, NULL),
(19, '2020-05-03 11:20:57', '2020-05-03 18:20:57', 'ftgftgfgtu', 'yfuffg', 'edrfufv', 'yfyufuy', '2020-05-03', '67677667', '', '', '010109', 'bvhfvgtcgvcj', 'bgvfutctgvcuj', 1, 2, 1, NULL),
(20, '2020-05-03 11:21:17', '2020-05-03 18:21:17', 'MAMAM', '', 'edrfufv', 'yfyufuy', '2020-05-03', '67677667', '', '', '010109', 'bvhfvgtcgvcj', 'bgvfutctgvcuj', 1, 2, 1, NULL),
(21, '2020-05-03 11:32:47', '2020-05-03 18:32:47', NULL, '', NULL, '', '1970-01-01', '', '', '', '', '', '', 0, 0, 0, NULL),
(22, '2020-05-04 07:03:39', '2020-05-04 14:03:39', 'Jan', 'Carlos', '', 'Ortega', '1984-02-07', '78675675', 'juanjose@gmail.com', '987865676', '020105', '', '', 1, 2, 1, NULL),
(23, '2020-05-04 08:15:40', '2020-05-04 15:15:40', 'ANA', 'LUCIA', 'PANTA', 'PURIZACA', '1999-03-03', '76676767', 'jigfuyftd@gdg.gyf', '987655555', '	020106	', 'rtdfydfyjfdxrtxjrt', '', 1, 2, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `nombre` varchar(225) COLLATE utf8_spanish_ci DEFAULT NULL,
  `abreviacion` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `created_at`, `updated_at`, `nombre`, `abreviacion`, `estado`, `deleted_at`) VALUES
(1, '2020-03-05 10:16:22', '2020-03-05 00:00:00', 'Administrador', 'Admin', '1', NULL),
(2, '2020-04-05 16:40:22', '2020-04-05 23:40:22', 'Dentista', 'Dent.', '1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE `ruta` (
  `id_ruta` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `nombre` varchar(225) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ruta` varchar(225) COLLATE utf8_spanish_ci DEFAULT NULL,
  `icono` varchar(225) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nivel` int(11) DEFAULT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ruta`
--

INSERT INTO `ruta` (`id_ruta`, `created_at`, `updated_at`, `nombre`, `ruta`, `icono`, `nivel`, `id_parent`, `deleted_at`) VALUES
(1, '2020-03-05 09:51:56', '2020-03-05 00:00:00', 'Principal', 'principal', 'educate-home', 1, NULL, NULL),
(2, '2020-03-05 09:57:32', '2020-03-05 00:00:00', 'Historia clinica', NULL, 'educate-course', 1, NULL, NULL),
(3, '2020-03-05 10:11:17', '2020-03-05 00:00:00', 'Nueva', 'historia', NULL, 2, 2, NULL),
(4, '2020-03-05 10:52:57', '2020-03-05 00:00:00', 'Pacientes', NULL, 'educate-professor', 1, NULL, NULL),
(5, '2020-03-05 10:54:57', '2020-03-05 00:00:00', 'Listar pacientes', 'listar_paciente', NULL, 2, 4, NULL),
(6, '2020-03-05 10:54:57', '2020-03-05 00:00:00', 'Nuevo paciente', 'paciente', NULL, 2, 4, NULL),
(7, '2020-03-05 12:12:10', NULL, 'Citas', NULL, 'educate-event', 1, NULL, NULL),
(8, '2020-03-05 12:12:10', NULL, 'Seguridad', NULL, 'educate-department', 1, NULL, NULL),
(9, '2020-03-05 15:31:08', '2020-03-05 00:00:00', 'Roles y permisos', 'roles_permisos', NULL, 2, 8, NULL),
(10, '2020-03-05 15:31:08', '2020-03-30 00:00:00', 'Usuarios', 'usuarios', NULL, 2, 8, NULL),
(11, '2020-03-05 22:46:35', '2020-03-05 00:00:00', 'Calendario', 'citas', NULL, 2, 7, NULL),
(12, '2020-03-06 00:33:06', '2020-03-06 00:00:00', 'Registros', NULL, 'educate-event', 1, NULL, NULL),
(13, '2020-03-06 00:50:29', '2020-03-06 00:00:00', 'Antecedentes', 'antecedente', NULL, 2, 12, NULL),
(14, '2020-03-06 00:54:15', '2020-03-06 00:00:00', 'Odontograma', 'dientes', NULL, 2, 12, NULL),
(15, '2020-03-06 00:55:02', '2020-03-06 00:00:00', 'Tratamiento', 'tratamiento', NULL, 2, 12, NULL),
(16, '2020-03-10 10:05:40', '2020-03-10 00:00:00', 'Registros', 'registros', NULL, 2, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id_tipo_documento` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nombre` varchar(225) COLLATE utf8_spanish_ci DEFAULT NULL,
  `abreviacion` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tipo_documento`, `created_at`, `nombre`, `abreviacion`, `estado`, `deleted_at`) VALUES
(1, '2020-03-03 23:13:17', 'DNI', 'DNI', '1', NULL),
(2, '2020-03-05 23:18:33', 'PASSAPORTE', 'PASPRTE', '1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamiento`
--

CREATE TABLE `tratamiento` (
  `id_tratamiento` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `costo` double DEFAULT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tratamiento`
--

INSERT INTO `tratamiento` (`id_tratamiento`, `created`, `updated`, `nombre`, `costo`, `descripcion`, `deleted_at`) VALUES
(1, '2020-03-03 23:04:56', '2020-03-03 00:00:00', 'Radiografia', 15, '', NULL),
(2, '2020-03-04 02:43:24', '2020-03-04 00:00:00', 'Profiliaxis', 300, '', NULL),
(3, '2020-03-04 02:43:24', '2020-03-04 00:00:00', 'Modelos de estudio', 20, '', NULL),
(4, '2020-03-04 09:45:13', '2020-03-04 00:00:00', 'Cirugía', 120, '', NULL),
(5, '2020-03-04 09:45:13', '2020-03-24 00:00:00', 'Exodoncia', 100, '', NULL),
(10, '2020-03-06 05:47:17', '2020-03-06 11:47:17', 'Pulpotomia', 90, '', NULL),
(11, '2020-03-11 22:12:10', '2020-03-12 04:12:10', 'Pulpectomia', 120, '', NULL),
(12, '2020-03-11 22:32:12', '2020-03-12 04:32:12', 'Sellantes', 230, '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `username` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(1) COLLATE utf8_spanish_ci DEFAULT '1',
  `id_persona` int(11) DEFAULT NULL,
  `id_rol` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `created_at`, `updated_at`, `username`, `password`, `estado`, `id_persona`, `id_rol`, `deleted_at`) VALUES
(1, '2020-03-04 01:57:46', '2020-04-16 05:32:08', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '1', 1, 1, NULL),
(2, '2020-05-04 08:15:55', '2020-05-04 15:15:40', 'dentista', 'e10adc3949ba59abbe56e057f20f883e', '1', 23, 2, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ant_patologico`
--
ALTER TABLE `ant_patologico`
  ADD PRIMARY KEY (`id_ant_patologico`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `detalle_historia`
--
ALTER TABLE `detalle_historia`
  ADD PRIMARY KEY (`id_detalle_historia`),
  ADD KEY `id_historia_clinica` (`id_historia_clinica`) USING BTREE,
  ADD KEY `id_tratamiento` (`id_tratamiento`) USING BTREE,
  ADD KEY `id_ant_patologico` (`id_ant_patologico`) USING BTREE,
  ADD KEY `id_diente` (`id_diente`) USING BTREE;

--
-- Indices de la tabla `detalle_historia_temp`
--
ALTER TABLE `detalle_historia_temp`
  ADD KEY `id_ant_patologico` (`id_ant_patologico`),
  ADD KEY `id_diente` (`id_diente`),
  ADD KEY `id_tratamiento` (`id_tratamiento`);

--
-- Indices de la tabla `diente`
--
ALTER TABLE `diente`
  ADD PRIMARY KEY (`id_diente`);

--
-- Indices de la tabla `estado_civil`
--
ALTER TABLE `estado_civil`
  ADD PRIMARY KEY (`id_estado_civil`);

--
-- Indices de la tabla `foto_perfil`
--
ALTER TABLE `foto_perfil`
  ADD PRIMARY KEY (`id_foto_perfil`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  ADD PRIMARY KEY (`id_historia_clinica`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id_paciente`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_historia_clinica` (`id_historia_clinica`),
  ADD KEY `id_tratamiento` (`id_tratamiento`);

--
-- Indices de la tabla `pago_temp`
--
ALTER TABLE `pago_temp`
  ADD KEY `id_tratamiento` (`id_tratamiento`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_rol`,`id_ruta`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_ruta` (`id_ruta`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`),
  ADD KEY `id_tipo_documento` (`id_tipo_documento`),
  ADD KEY `id_estado_civil` (`id_estado_civil`),
  ADD KEY `id_genero` (`id_genero`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD PRIMARY KEY (`id_ruta`),
  ADD KEY `id_parent` (`id_parent`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id_tipo_documento`);

--
-- Indices de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  ADD PRIMARY KEY (`id_tratamiento`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ant_patologico`
--
ALTER TABLE `ant_patologico`
  MODIFY `id_ant_patologico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `detalle_historia`
--
ALTER TABLE `detalle_historia`
  MODIFY `id_detalle_historia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=456;
--
-- AUTO_INCREMENT de la tabla `diente`
--
ALTER TABLE `diente`
  MODIFY `id_diente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT de la tabla `estado_civil`
--
ALTER TABLE `estado_civil`
  MODIFY `id_estado_civil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `foto_perfil`
--
ALTER TABLE `foto_perfil`
  MODIFY `id_foto_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  MODIFY `id_historia_clinica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `ruta`
--
ALTER TABLE `ruta`
  MODIFY `id_ruta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  MODIFY `id_tratamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_historia`
--
ALTER TABLE `detalle_historia`
  ADD CONSTRAINT `detalle_historia_ibfk_1` FOREIGN KEY (`id_historia_clinica`) REFERENCES `historia_clinica` (`id_historia_clinica`),
  ADD CONSTRAINT `detalle_historia_ibfk_2` FOREIGN KEY (`id_ant_patologico`) REFERENCES `ant_patologico` (`id_ant_patologico`),
  ADD CONSTRAINT `detalle_historia_ibfk_3` FOREIGN KEY (`id_tratamiento`) REFERENCES `tratamiento` (`id_tratamiento`),
  ADD CONSTRAINT `detalle_historia_ibfk_4` FOREIGN KEY (`id_diente`) REFERENCES `diente` (`id_diente`);

--
-- Filtros para la tabla `detalle_historia_temp`
--
ALTER TABLE `detalle_historia_temp`
  ADD CONSTRAINT `detalle_historia_temp_ibfk_1` FOREIGN KEY (`id_tratamiento`) REFERENCES `tratamiento` (`id_tratamiento`),
  ADD CONSTRAINT `detalle_historia_temp_ibfk_2` FOREIGN KEY (`id_diente`) REFERENCES `diente` (`id_diente`),
  ADD CONSTRAINT `detalle_historia_temp_ibfk_3` FOREIGN KEY (`id_ant_patologico`) REFERENCES `ant_patologico` (`id_ant_patologico`);

--
-- Filtros para la tabla `foto_perfil`
--
ALTER TABLE `foto_perfil`
  ADD CONSTRAINT `foto_perfil_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  ADD CONSTRAINT `historia_clinica_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `historia_clinica_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`);

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`id_historia_clinica`) REFERENCES `historia_clinica` (`id_historia_clinica`);

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`),
  ADD CONSTRAINT `permiso_ibfk_2` FOREIGN KEY (`id_ruta`) REFERENCES `ruta` (`id_ruta`);

--
-- Filtros para la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD CONSTRAINT `ruta_ibfk_1` FOREIGN KEY (`id_parent`) REFERENCES `ruta` (`id_ruta`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
