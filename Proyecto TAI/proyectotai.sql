-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 18-08-2026 a las 01:03:26
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectotai`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `armazones`
--

CREATE TABLE `armazones` (
  `id_Armazon` int(11) NOT NULL,
  `nombre_Armazon` varchar(20) NOT NULL,
  `material_Armazon` varchar(20) NOT NULL,
  `forma_Armazon` varchar(20) NOT NULL,
  `tamano_Armazon` varchar(15) NOT NULL,
  `apto_graduacion_alta` tinyint(1) NOT NULL,
  `apto_bifocal_progresivo` tinyint(1) NOT NULL,
  `apto_deporte` tinyint(1) NOT NULL,
  `apto_uso_diario` tinyint(1) NOT NULL,
  `foto_Armazon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `Id_Cliente` int(11) NOT NULL,
  `Nombre_Cliente` varchar(30) NOT NULL,
  `Apellido_Cliente` varchar(30) NOT NULL,
  `Gmail_Cliente` varchar(30) NOT NULL,
  `FecRegis_Cliente` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuestionario`
--

CREATE TABLE `cuestionario` (
  `id_Cuestionario` int(11) NOT NULL,
  `cliente_Id` int(11) NOT NULL,
  `rango_edad` varchar(10) NOT NULL,
  `tipo_rostro` varchar(15) NOT NULL,
  `puente_nariz` varchar(15) NOT NULL,
  `separacion_ojos` varchar(15) NOT NULL,
  `forma_ojos` varchar(20) NOT NULL,
  `tamano_ojos` varchar(10) NOT NULL,
  `tipo_cristal` varchar(30) NOT NULL,
  `graduacion_cristal` tinyint(1) NOT NULL,
  `actividad_principal` varchar(30) NOT NULL,
  `frecuencia_uso` varchar(15) NOT NULL,
  `practica_deporte` tinyint(1) NOT NULL,
  `deporte_practicado` varchar(15) NOT NULL,
  `estilo_preferido` varchar(15) NOT NULL,
  `color_preferencia` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `armazones`
--
ALTER TABLE `armazones`
  ADD PRIMARY KEY (`id_Armazon`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Id_Cliente`);

--
-- Indices de la tabla `cuestionario`
--
ALTER TABLE `cuestionario`
  ADD PRIMARY KEY (`id_Cuestionario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `armazones`
--
ALTER TABLE `armazones`
  MODIFY `id_Armazon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `Id_Cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuestionario`
--
ALTER TABLE `cuestionario`
  MODIFY `id_Cuestionario` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
