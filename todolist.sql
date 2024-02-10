-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-02-2024 a las 04:50:05
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `todolist`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `todos`
--

CREATE TABLE `todos` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `isComplete` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `todos`
--

INSERT INTO `todos` (`id`, `id_user`, `name`, `description`, `isComplete`) VALUES
(1, 5, 'My fisrt taskss', 'In this task i need go to the doctor :D ', 1),
(2, 6, 'My second task', 'I need go to the doctor  because im very very sick for my period', 0),
(3, 5, 'Tarea 1', 'Descripción para Tarea 1', 0),
(4, 3, 'Tarea 2', 'Descripción para Tarea 2', 0),
(5, 3, 'Tarea 3', 'Descripción para Tarea 3', 0),
(6, 1, 'Tarea 4', 'Descripción para Tarea 4', 0),
(7, 6, 'Tarea 5', 'Descripción para Tarea 5', 0),
(8, 5, 'Tarea 6', 'Descripción para Tarea 6', 0),
(9, 5, 'Tarea 7', 'Descripción para Tarea 7', 0),
(10, 3, 'Tarea 8', 'Descripción para Tarea 8', 0),
(11, 2, 'Tarea 9', 'Descripción para Tarea 9', 0),
(12, 3, 'Tarea 10', 'Descripción para Tarea 10', 0),
(13, 3, 'Tarea 11', 'Descripción para Tarea 11', 0),
(14, 4, 'Tarea 12', 'Descripción para Tarea 12', 0),
(15, 5, 'Tarea 13', 'Descripción para Tarea 13', 0),
(16, 6, 'Tarea 14', 'Descripción para Tarea 14', 0),
(17, 4, 'Tarea 15', 'Descripción para Tarea 15', 0),
(18, 3, 'Tarea 16', 'Descripción para Tarea 16', 0),
(19, 3, 'Tarea 17', 'Descripción para Tarea 17', 0),
(20, 3, 'Tarea 18', 'Descripción para Tarea 18', 0),
(21, 4, 'Tarea 19', 'Descripción para Tarea 19', 0),
(22, 2, 'Tarea 20', 'Descripción para Tarea 20', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `auth_key` varchar(100) NOT NULL,
  `access_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `auth_key`, `access_token`) VALUES
(1, 'test', 'test@test.com', '$2y$13$17tao71.IpT1AECTemlLhu/jSH8doyFQiI/OhrV7WdEb99rlw6rcW', 't1wBsgJm3CVb0h_ihOXARFePkRB_zdBp', 'aH7EoBUGS5D2PAbQSp0eY7tMZn8MJejV'),
(2, 'test2', 'test2@test.com', '$2y$13$17tao71.IpT1AECTemlLhu/jSH8doyFQiI/OhrV7WdEb99rlw6rcW', 'JLmdHO9mpo7bbO_N7A7t8eX3wmkVJJp9', 'S1eskgW4J8h1FcvRnBuI0F53muw78mk9'),
(3, 'test3', 'test3@test.com', '$2y$13$17tao71.IpT1AECTemlLhu/jSH8doyFQiI/OhrV7WdEb99rlw6rcW', 'd2KihzZuqlfEaALLk758m2jEBZT3lTv7', 'vyJsv8s9wEKKV-cJDuqNIHOAcQcJOtQV'),
(4, 'testt', 'testt@test.com', '$2y$13$17tao71.IpT1AECTemlLhu/jSH8doyFQiI/OhrV7WdEb99rlw6rcW', 'IUyUPfySHm8hiwzaVCO7LdxCm-Y3MuPt', '4OgXMLv2DtL_V5uJeX3_78C1JgqDLJ8Z'),
(5, 'ricardo2', 'ricardo@gmail.com', '$2y$13$17tao71.IpT1AECTemlLhu/jSH8doyFQiI/OhrV7WdEb99rlw6rcW', '-kZiBcssxM9oq6Aui1SPicXR2FWolYpi', 'CWPaDSJ1QW5Hc5NJkvL-QjRaGOtX0M5O'),
(6, 'Fer1996', 'fer1995@test.com', '$2y$13$17tao71.IpT1AECTemlLhu/jSH8doyFQiI/OhrV7WdEb99rlw6rcW', 'ZhZVH0X0GlqcdJm5tmXskM2XETGF-IjT', 'DgMk70yA5ic1u_FMUE5mToVkFAA1lNac'),
(7, 'LastUser', 'lasuser@lasuser.com', '$2y$13$17tao71.IpT1AECTemlLhu/jSH8doyFQiI/OhrV7WdEb99rlw6rcW', 'Gg6kS27Tf4roLfreh7Ozb5itt6Qt6qQ2', 'k0Z0oWwd24qjHI-77DkqDfH40aXKs-pA');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_id_user` (`id_user`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `todos`
--
ALTER TABLE `todos`
  ADD CONSTRAINT `fk_todos_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
