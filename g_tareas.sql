-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-03-2024 a las 22:51:13
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
-- Base de datos: `g_tareas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Educacion', 'Mejora el estilo de vida'),
(2, 'Desarrollo Personal', 'Te permite crecer como personal'),
(3, 'Responsabilidades Domésticas', 'Ganas una responsabilidad sobre tu vida'),
(4, 'Relaciones Sociales', 'Estableces mejores vinculos con las personas'),
(5, 'Salud y Binestar', 'Mejora el estilo de vida'),
(6, 'Desarrollo Profesional', 'Mejora tu futuro profesional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas_predeterminadas`
--

CREATE TABLE `tareas_predeterminadas` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tareas_predeterminadas`
--

INSERT INTO `tareas_predeterminadas` (`id`, `categoria_id`, `descripcion`) VALUES
(1, 1, 'Asistir a la escuela regularmente y esforzarse por aprender y alcanzar buenos resultados académicos.'),
(2, 1, 'Desarrollar habilidades de estudio efectivas y aprender a gestionar el tiempo de manera eficiente.'),
(3, 1, 'Explorar opciones educativas futuras, como la universidad, la formación profesional o la educación técnica.'),
(4, 2, 'Fomentar la autoconciencia y la tttttttttt  positiva.'),
(5, 2, 'Desarrollar habilidades de resolución de problemas y toma de decisiones.'),
(6, 2, 'Aprender a manejar el estrés y las emociones de manera saludable.'),
(7, 3, 'Ayudar en las tareas del hogar, como limpiar, cocinar, lavar los platos y hacer la colada.'),
(8, 3, 'Aprender habilidades básicas de mantenimiento del hogar, como cambiar una bombilla o reparar una fuga de agua.'),
(9, 4, 'Cultivar relaciones saludables con amigos, familiares y compañeros.'),
(10, 4, 'Aprender a comunicarse de manera efectiva y a resolver conflictos de manera constructiva.'),
(11, 4, 'Participar en actividades sociales y comunitarias que fomenten el desarrollo de habilidades sociales y la construcción de redes de apoyo.'),
(12, 5, 'Adoptar hábitos saludables de alimentación, ejercicio y sueño.'),
(13, 5, 'Aprender sobre la importancia del autocuidado y la salud mental.'),
(14, 5, 'Buscar ayuda y apoyo cuando sea necesario para abordar problemas de salud física o mental.'),
(15, 6, 'Explorar intereses profesionales y opciones de carrera.'),
(16, 6, 'Obtener experiencia laboral a través de pasantías, voluntariado o empleo a tiempo parcial.'),
(17, 6, 'Desarrollar habilidades profesionales, como redacción de currículums, habilidades de entrevista y trabajo en equipo.'),
(24, 1, 'BORRAR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas_usuario`
--

CREATE TABLE `tareas_usuario` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `tarea_predeterminada_id` int(11) DEFAULT NULL,
  `estado` enum('pendiente','completada') NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tareas_usuario`
--

INSERT INTO `tareas_usuario` (`id`, `usuario_id`, `tarea_predeterminada_id`, `estado`) VALUES
(14, 6, 7, 'completada'),
(15, 6, 8, 'pendiente'),
(16, 6, 12, 'completada'),
(24, 6, 10, 'completada'),
(25, 6, 11, 'completada'),
(29, 6, 13, 'completada'),
(39, 9, 11, 'completada'),
(40, 9, 7, 'completada'),
(41, 9, 8, 'completada'),
(42, 9, 12, 'completada'),
(47, 9, 13, 'completada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `cedula` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `cedula`, `nombre`, `correo`, `contrasena`) VALUES
(6, '1550044182', 'Jeanp', 'jeanpierre150420021828@gmail.com', '$2y$10$Xyhh.TOLeMRYIovk287MYO9NmV/NUi3WvBDpGRfZti4ggolcaWMIS'),
(7, 'admin', 'Administrador', 'admin@example.com', 'admin.admin'),
(8, '1550044187', 'Juan', 'reimblox@gmail.com', '$2y$10$groxhMcouP4SlsXiKB67hezcJzetGG1gHGTsspExzzS5qHnqbt8Sm'),
(9, '1550044189', 'Jeancarlo', 'Jeanarlo01@gmail.com', '$2y$10$x58.PHksvlavg8AJnq95iOS7JjEo7/sDd4VJSutQcGajGEkOKF9Lm');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tareas_predeterminadas`
--
ALTER TABLE `tareas_predeterminadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tareas_predeterminadas_ibfk_1` (`categoria_id`);

--
-- Indices de la tabla `tareas_usuario`
--
ALTER TABLE `tareas_usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_tarea_unique` (`usuario_id`,`tarea_predeterminada_id`),
  ADD KEY `tareas_usuario_ibfk_2` (`tarea_predeterminada_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tareas_predeterminadas`
--
ALTER TABLE `tareas_predeterminadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `tareas_usuario`
--
ALTER TABLE `tareas_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tareas_predeterminadas`
--
ALTER TABLE `tareas_predeterminadas`
  ADD CONSTRAINT `tareas_predeterminadas_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tareas_usuario`
--
ALTER TABLE `tareas_usuario`
  ADD CONSTRAINT `tareas_usuario_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tareas_usuario_ibfk_2` FOREIGN KEY (`tarea_predeterminada_id`) REFERENCES `tareas_predeterminadas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
