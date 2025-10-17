-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 15-10-2025 a las 17:04:30
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
-- Base de datos: `gym`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_usuarios`
--

CREATE TABLE `data_usuarios` (
  `id_data_usuario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `genero` enum('Masculino','Femenino','Otro') NOT NULL,
  `fecha_nac` date NOT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `altura` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_nopad_ci;

--
-- Volcado de datos para la tabla `data_usuarios`
--

INSERT INTO `data_usuarios` (`id_data_usuario`, `id_usuario`, `nombre`, `apellido`, `genero`, `fecha_nac`, `peso`, `altura`) VALUES
(4, 26, 'Admin', 'Admin', 'Masculino', '1990-10-27', 78.00, 178.00),
(5, 27, 'User', 'User', 'Masculino', '2000-10-10', 80.00, 179.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

CREATE TABLE `ejercicios` (
  `id_ejercicio` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `grupo_muscular` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_nopad_ci;

--
-- Volcado de datos para la tabla `ejercicios`
--

INSERT INTO `ejercicios` (`id_ejercicio`, `nombre`, `grupo_muscular`) VALUES
(1, 'Banco Plano', 'Pecho'),
(5, 'Peso Muerto', 'Piernas'),
(10, 'Press Inclinado con Mancuernas', 'Pecho'),
(11, 'Press Declinado', 'Pecho'),
(12, 'Aperturas con Mancuernas', 'Pecho'),
(13, 'Fondos en Paralelas', 'Pecho'),
(14, 'Dominadas', 'Espalda'),
(15, 'Remo con Barra', 'Espalda'),
(16, 'Jalón al Pecho', 'Espalda'),
(17, 'Peso Muerto Rumano', 'Espalda'),
(18, 'Remo con Mancuerna', 'Espalda'),
(19, 'Sentadillas', 'Piernas'),
(20, 'Prensa de Piernas', 'Piernas'),
(22, 'Zancadas', 'Piernas'),
(23, 'Extensión de Piernas', 'Piernas'),
(24, 'Curl Femoral', 'Piernas'),
(25, 'Elevación de Talones', 'Piernas'),
(26, 'Press Militar', 'Hombros'),
(27, 'Elevaciones Laterales', 'Hombros'),
(28, 'Elevaciones Frontales', 'Hombros'),
(29, 'Pájaro con Mancuernas', 'Hombros'),
(30, 'Encogimientos con Barra', 'Hombros'),
(31, 'Curl con Barra', 'Bíceps'),
(32, 'Curl con Mancuernas', 'Bíceps'),
(33, 'Curl Concentrado', 'Bíceps'),
(34, 'Curl en Predicador', 'Bíceps'),
(35, 'Fondos entre Bancos', 'Tríceps'),
(36, 'Extensión con Mancuerna', 'Tríceps'),
(37, 'Press Francés', 'Tríceps'),
(38, 'Cuerda en Polea', 'Tríceps'),
(39, 'Crunch', 'Abdomen'),
(40, 'Elevaciones de Piernas', 'Abdomen'),
(41, 'Plancha', 'Abdomen'),
(42, 'Abdominales en Máquina', 'Abdomen'),
(43, 'Hip Thrust', 'Glúteos'),
(44, 'Puente de Glúteos', 'Glúteos'),
(45, 'Patada de Glúteos', 'Glúteos'),
(46, 'Peso Muerto Sumo', 'Glúteos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutina_usuario`
--

CREATE TABLE `rutina_usuario` (
  `id_rutina` int(11) NOT NULL,
  `dia` int(11) NOT NULL,
  `repeticiones` int(11) NOT NULL,
  `series` int(11) NOT NULL,
  `rir` int(11) DEFAULT 0,
  `id_ejercicio` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_nopad_ci;

--
-- Volcado de datos para la tabla `rutina_usuario`
--

INSERT INTO `rutina_usuario` (`id_rutina`, `dia`, `repeticiones`, `series`, `rir`, `id_ejercicio`, `id_usuario`) VALUES
(33, 1, 10, 4, 1, 1, 27),
(34, 1, 10, 3, 0, 10, 27),
(35, 1, 12, 3, 0, 11, 27),
(36, 1, 12, 4, 0, 37, 27),
(37, 1, 10, 3, 0, 36, 27),
(38, 2, 10, 4, 1, 15, 27),
(39, 2, 12, 4, 2, 16, 27),
(40, 2, 8, 3, 1, 18, 27),
(41, 2, 10, 4, 1, 31, 27),
(43, 2, 12, 3, 0, 34, 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `rol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_nopad_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `password`, `rol`) VALUES
(26, 'admin@admin.com', '$2y$10$0cx5MD4aJxbgRnDvvSs/OelqlsR4eKhpJ7nWRguftwLitWKSOelO2', 'admin'),
(27, 'user@user.com', '$2y$10$dzMBFhqvmxQ2rFLb4GRByO6h9QibMSSNZSSNOaUzu/4HgTgjDBkUq', 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `data_usuarios`
--
ALTER TABLE `data_usuarios`
  ADD PRIMARY KEY (`id_data_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  ADD PRIMARY KEY (`id_ejercicio`);

--
-- Indices de la tabla `rutina_usuario`
--
ALTER TABLE `rutina_usuario`
  ADD PRIMARY KEY (`id_rutina`),
  ADD KEY `id_ejercicio` (`id_ejercicio`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `data_usuarios`
--
ALTER TABLE `data_usuarios`
  MODIFY `id_data_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  MODIFY `id_ejercicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `rutina_usuario`
--
ALTER TABLE `rutina_usuario`
  MODIFY `id_rutina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `data_usuarios`
--
ALTER TABLE `data_usuarios`
  ADD CONSTRAINT `data_usuarios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rutina_usuario`
--
ALTER TABLE `rutina_usuario`
  ADD CONSTRAINT `rutina_usuario_ibfk_1` FOREIGN KEY (`id_ejercicio`) REFERENCES `ejercicios` (`id_ejercicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rutina_usuario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
