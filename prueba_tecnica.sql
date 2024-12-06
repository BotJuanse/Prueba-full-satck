-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2024 a las 17:44:52
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba_tecnica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id_proyecto` int(11) NOT NULL,
  `nombre_proyecto` varchar(255) NOT NULL,
  `usuario_creador` varchar(255) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `estado_proyecto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id_proyecto`, `nombre_proyecto`, `usuario_creador`, `fecha_creacion`, `estado_proyecto`) VALUES
(1, 'proyecto de prueba editado', '5', '2024-12-05', 'activo'),
(2, 'segundo proyecto', '3', '2024-12-05', 'activo'),
(3, 'otro proyecto mas', '4', '2024-12-05', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id_tarea` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `proyecto` varchar(255) NOT NULL,
  `fecha_finalizacion` date NOT NULL,
  `estado_tarea` varchar(255) NOT NULL,
  `usuario_creador_tarea` varchar(255) NOT NULL,
  `usuario_responsable_tarea` varchar(255) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `estado_tarea_p` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id_tarea`, `titulo`, `proyecto`, `fecha_finalizacion`, `estado_tarea`, `usuario_creador_tarea`, `usuario_responsable_tarea`, `fecha_creacion`, `estado_tarea_p`) VALUES
(1, 'primera tarea', '2', '2024-12-18', 'Pausado', '3', '6', '2024-12-05', 'activo'),
(2, 'segunda tarea', '1', '2024-12-19', 'Completado', '3', '5', '2024-12-05', 'activo'),
(3, 'tercera tarea', '3', '2024-12-24', 'Pausado', '1', '4', '2024-12-05', 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nombre` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(255) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `estado` varchar(10) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `correo`, `password`, `rol`, `fecha_creacion`, `estado`, `id_usuario`) VALUES
('Sebastian Peñaloza', 'sebastian.penaloza.gutierrez@gmail.com', 'U2ViYXMxMjM=', 'Administrador', '2024-12-04', 'activo', 1),
('juan gutierrez', 'juan.gutierrez@gmail.com', 'U2ViYXMxMjM=', 'Usuario', '2024-12-05', 'activo', 2),
('gabriela milanes', 'gabriela.milanes@gmail.com', 'R2FieTEyMw==', 'Administrador', '2024-12-05', 'activo', 3),
('Sofia hernandez', 'sofia.hernandez@gmail.com', 'U29maWExMjM=', 'Usuario', '2024-12-05', 'activo', 4),
('david lopez', 'david.lopez@gmail.com', 'RGF2aWQxMjM=', 'Usuario', '2024-12-05', 'activo', 5),
('raul salinas', 'raul.salinas@gmail.com', 'UmF1bDEyMw==', 'Usuario', '2024-12-05', 'activo', 6),
('duvan perez', 'duvan.perez@gmail.com', 'RHV2YW4xMjM=', 'Usuario', '2024-12-06', 'activo', 7),
('dana sanchez', 'dana.sanchez@gmail.com', 'RGFuYTEyMw==', 'Sin asignación', '2024-12-06', 'pendiente', 8),
('patricia tapia', 'patricia.tapia@gmail.com', 'UGF0cmljaWExMjM=', 'Sin asignación', '2024-12-06', 'pendiente', 9),
('alejandra sierra', 'alejandra.sierra@gmail.com', 'QWxlamFuZHJhMTIz', 'Sin asignación', '2024-12-06', 'pendiente', 11);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id_proyecto`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tarea`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
