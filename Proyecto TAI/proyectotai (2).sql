-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 20-08-2026 a las 00:27:19
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
  `nombre_Armazon` varchar(100) NOT NULL,
  `tipo_montura` enum('Montura completa','Media montura','Al aire','Tres piezas') NOT NULL DEFAULT 'Montura completa',
  `material_Armazon` varchar(40) NOT NULL,
  `forma_Armazon` varchar(30) NOT NULL,
  `tamano_Armazon` varchar(30) NOT NULL,
  `color_Armazon` varchar(30) NOT NULL DEFAULT 'Negro',
  `apto_graduacion_alta` tinyint(1) NOT NULL,
  `apto_bifocal_progresivo` tinyint(1) NOT NULL,
  `apto_deporte` tinyint(1) NOT NULL,
  `apto_uso_diario` tinyint(1) NOT NULL,
  `foto_Armazon` varchar(500) NOT NULL,
  `cuidado_Armazon` varchar(500) NOT NULL DEFAULT 'Limpiar con pa±o de microfibra y guardar en estuche.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `armazones`
--

INSERT INTO `armazones` (`id_Armazon`, `nombre_Armazon`, `tipo_montura`, `material_Armazon`, `forma_Armazon`, `tamano_Armazon`, `color_Armazon`, `apto_graduacion_alta`, `apto_bifocal_progresivo`, `apto_deporte`, `apto_uso_diario`, `foto_Armazon`, `cuidado_Armazon`) VALUES
(1, 'Clásico Negro 01', 'Montura completa', 'Acetato', 'Rectangular', 'Mediano', 'Negro', 1, 1, 0, 1, 'https://www.rimloo.com/_next/image?q=75&url=https%3A%2F%2Frimloo.b-cdn.net%2Feyeglasses%2F2225%2FBlack%2Fmain%2Ffront_view.jpg%3Fv%3D3&w=3840', 'Limpiar con pano de microfibra; evitar calor intenso y guardar en estuche rigido.'),
(2, 'Retro Carey 02', 'Montura completa', 'Acetato', 'Redondo', 'Mediano', 'Carey', 1, 0, 0, 1, 'https://www.friendsandframes.lt/cdn/shop/files/RB_7239_2000_54_a1.png?v=1737280123&width=533', 'Limpiar con pano humedo suave; no dejar al sol ni dentro del auto.'),
(3, 'Urbano Plata 03', 'Media montura', 'Metal', 'Rectangular', 'Grande', 'Negro', 0, 1, 0, 1, 'https://lentepolis.com/cdn/shop/files/15234.jpg?v=1752686635', 'Limpiar el marco metalico con pano seco y revisar el hilo de sujecion de las lentes.'),
(4, 'Ejecutivo Azul 04', 'Media montura', 'Acero inoxidable', 'Ovalado', 'Mediano', 'Azul', 1, 1, 0, 1, 'https://leoptica.com/cdn/shop/products/MK2137-01-2_1024x.jpg?v=1634944703', 'Usar pano de microfibra y ajustar tornillos solo en una optica si se aflojan.'),
(5, 'Minimal Titanio 05', 'Al aire', 'Titanio', 'Rectangular', 'Mediano', 'Plata', 0, 1, 0, 1, 'https://www.lafam.com.co/cdn/shop/files/front-0EA1162__3001__P21__shad__bk_c29053da-a607-4daa-a1e1-34cbed559420_1024x682.jpg?v=1718655287', 'Manipular siempre con ambas manos; no apoyar las lentes sobre superficies.'),
(6, 'Liviano Oro 06', 'Tres piezas', 'Titanio', 'Ovalado', 'Pequeño', 'Oro', 0, 1, 0, 1, 'https://www.lafam.com.co/cdn/shop/files/front-8719154772078_00001_1024x682.jpg?v=1708352621', 'Limpiar con pano de microfibra y evitar torsiones; llevar a una optica para ajustes.'),
(7, 'Sport Flex 07', 'Montura completa', 'TR-90', 'Geométrico', 'Grande', 'Negro', 1, 0, 1, 1, 'https://image-gg.efeglasses.com/goods/E08548/E08548B/E08548B-2.jpg-1200.webp', 'Lavar con agua fria y jabon neutro; secar con pano suave despues de actividad fisica.'),
(8, 'Aviador Metal 08', 'Montura completa', 'Metal', 'Aviador', 'Grande', 'Plata', 0, 0, 0, 1, 'https://images.specscart.co.uk/products/buckley/buckley-1/file_v54s2h.webp', 'Guardar en estuche y limpiar el metal con pano seco para conservar el acabado.'),
(9, 'Cat Eye Rosa 09', 'Montura completa', 'Plástico inyectado', 'Cat-eye', 'Mediano', 'Rosa', 0, 0, 0, 1, 'https://www.americasbest.com/pmedia/301931/301931.jpg', 'Evitar perfume, alcohol y calor directo; limpiar con pano suave.'),
(10, 'Nylon Activo 10', 'Montura completa', 'Nylon / polímeros', 'Cuadrado', 'Mediano', 'Verde', 1, 0, 1, 1, 'https://image-gg.efeglasses.com/goods/E19029/E19029C1/E19029C1-2.jpg-1200.webp', 'Enjuagar con agua fria tras el uso deportivo y guardar completamente seco.'),
(11, 'Acero Rectangular 11', 'Al aire', 'Acero inoxidable', 'Rectangular', 'Mediano', 'Oro', 0, 0, 0, 1, 'img/armazon-acero-rectangular.png', 'Limpiar con pano de microfibra y guardar en estuche para proteger la montura.'),
(12, 'TR-90 Flexible Azul 12', 'Montura completa', 'TR-90', 'Ovalado', 'Pequeño', 'Azul', 1, 0, 1, 1, 'img/armazon-tr90-ovalado-chico.png', 'Lavar con agua fria y jabon neutro; secar con un pano suave.'),
(13, 'TR-90 Deportivo Gris 13', 'Montura completa', 'TR-90', 'Ovalado', 'Mediano', 'Negro', 1, 0, 1, 0, 'img/armazon-tr90-deportivo.png', 'Enjuagar despues de la actividad fisica y guardar seco en su estuche.'),
(14, 'Chiaroscuro Moravia Blue Block', 'Montura completa', 'Acetato', 'Cat-eye', 'Grande', 'Negro', 0, 0, 0, 1, 'img/chiaroscuro-moravia.png', 'Limpiar con microfibra; evitar calor intenso y guardar en su bolsita Puffer.'),
(15, 'Kevingston KVN 6609 TR90', 'Montura completa', 'TR-90', 'Rectangular', 'Mediano', 'Transparente', 0, 0, 0, 1, 'img/kevingston-kvn-6609.png', 'Limpiar con la franela incluida y conservar en su estuche.'),
(16, 'Chiaroscuro YHY6856', 'Montura completa', 'Metal', 'Cat-eye', 'Mediano', 'Oro', 0, 0, 0, 1, 'img/chiaroscuro-yhy6856.png', 'Limpiar con pano de microfibra y evitar doblar las patillas FLEX.'),
(17, 'Dormont Round Green/Tortoise', 'Montura completa', 'Acetato', 'Redondo', 'Mediano', 'Verde', 0, 0, 0, 1, 'img/dormont-round-green.png', 'Usar microfibra limpia y guardar en estuche al terminar el dia.'),
(18, 'Sllac Asiher Geometric SportsGlasses', 'Montura completa', 'TR-90', 'Geométrico', 'Grande', 'Negro', 0, 0, 1, 0, 'img/sllac-asiher-sport.png', 'Lavar despues del deporte, secar suavemente y guardar en estuche.'),
(19, 'Cloe Aro Completo', 'Montura completa', 'Metal', 'Geométrico', 'Grande', 'Violeta', 0, 0, 0, 1, 'img/aro-completo-cloe.png', 'Limpiar con pano de microfibra y guardar en estuche para conservar el aro completo.');

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

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`Id_Cliente`, `Nombre_Cliente`, `Apellido_Cliente`, `Gmail_Cliente`, `FecRegis_Cliente`) VALUES
(1, 'Victoria', 'Romero', 'anaromerob.5108@gmail.com', '2026-08-18 19:46:43'),
(2, 'Erica', 'Quispe', 'ericaquispe123@gmail.com', '2026-08-18 23:19:47');

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
-- Volcado de datos para la tabla `cuestionario`
--

INSERT INTO `cuestionario` (`id_Cuestionario`, `cliente_Id`, `rango_edad`, `tipo_rostro`, `puente_nariz`, `separacion_ojos`, `forma_ojos`, `tamano_ojos`, `tipo_cristal`, `graduacion_cristal`, `actividad_principal`, `frecuencia_uso`, `practica_deporte`, `deporte_practicado`, `estilo_preferido`, `color_preferencia`) VALUES
(1, 1, '18-30', 'diamante', 'normal', 'normal', 'almendrados', 'medianos', 'monofocal', 0, 'trabajo_estudio', 'diario', 0, 'Ninguno', 'clasico', 'sin_preferencia'),
(2, 2, '13-17', 'corazon', 'normal', 'normal', 'caidos', 'grandes', 'progresivo', 1, 'aire_libre', 'diario', 1, 'Fútbol', 'deportivo', 'Carey');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recomendaciones_cuestionario`
--

CREATE TABLE `recomendaciones_cuestionario` (
  `id_Recomendacion` int(11) NOT NULL,
  `cuestionario_Id` int(11) NOT NULL,
  `armazon_Id` int(11) NOT NULL,
  `puntaje` int(11) NOT NULL,
  `posicion` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recomendaciones_cuestionario`
--

INSERT INTO `recomendaciones_cuestionario` (`id_Recomendacion`, `cuestionario_Id`, `armazon_Id`, `puntaje`, `posicion`) VALUES
(1, 1, 4, 29, 1),
(2, 1, 6, 25, 2),
(3, 1, 9, 23, 3),
(4, 2, 7, 37, 1),
(5, 2, 4, 36, 2),
(6, 2, 10, 36, 3);

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
-- Indices de la tabla `recomendaciones_cuestionario`
--
ALTER TABLE `recomendaciones_cuestionario`
  ADD PRIMARY KEY (`id_Recomendacion`),
  ADD UNIQUE KEY `uq_cuestionario_posicion` (`cuestionario_Id`,`posicion`),
  ADD KEY `fk_recomendacion_armazon` (`armazon_Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `armazones`
--
ALTER TABLE `armazones`
  MODIFY `id_Armazon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `Id_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cuestionario`
--
ALTER TABLE `cuestionario`
  MODIFY `id_Cuestionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `recomendaciones_cuestionario`
--
ALTER TABLE `recomendaciones_cuestionario`
  MODIFY `id_Recomendacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `recomendaciones_cuestionario`
--
ALTER TABLE `recomendaciones_cuestionario`
  ADD CONSTRAINT `fk_recomendacion_armazon` FOREIGN KEY (`armazon_Id`) REFERENCES `armazones` (`id_Armazon`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_recomendacion_cuestionario` FOREIGN KEY (`cuestionario_Id`) REFERENCES `cuestionario` (`id_Cuestionario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
