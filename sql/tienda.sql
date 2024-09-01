-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-06-2023 a las 16:44:33
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `calle` text NOT NULL,
  `num` int(11) NOT NULL,
  `codigo_pos` int(11) NOT NULL,
  `colonia` text NOT NULL,
  `estado` text NOT NULL,
  `ciudad` text NOT NULL,
  `telefono` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `address`
--

INSERT INTO `address` (`id`, `calle`, `num`, `codigo_pos`, `colonia`, `estado`, `ciudad`, `telefono`, `user_id`) VALUES
(3, 'Rio Azul', 6, 93432, 'Lomas de FOVISSSTE', 'Morelos', 'Tuxpan', 78455676, 2),
(4, 'Lazaro', 12, 532532, 'Heroes', 'Colima', 'Merida', 6543543, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `prod_desc` text NOT NULL,
  `stock` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `prod_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `prod_desc`, `stock`, `price`, `prod_img`) VALUES
(1, 'Yogurt de Fresa', 'Yogurt natural hecho con fresa.', 3, 45, './img/yogurt_fresa.jpg'),
(2, 'Yogurt de Piña y Coco', 'Yogurt hecho con piña con coco.', 5, 52, './img/yogurt_mango_pina.jpg'),
(3, 'Yogurt de Mango', 'Yogurt natural hecho con mango.', 6, 48, './img/yogurt3.jpg'),
(4, 'Yogurt de Manzana', 'Yogurt natural hecho con manzana.', 3, 45, './img/yogurt2.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `last_name` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `last_name`, `username`, `password`, `email`) VALUES
(1, '', '', 'admin', 'admin123', 'admin@admin.com'),
(2, 'Eduardo', 'Casados', 'educc', '123', 'eduardocasadoscc@gmail.com'),
(3, 'Joae', 'Cavazos', 'ingca', '123', 'dasdas@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_card_data`
--

CREATE TABLE `user_card_data` (
  `user_id` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `num` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_card_data`
--

INSERT INTO `user_card_data` (`user_id`, `titulo`, `num`, `exp`, `codigo`) VALUES
(1, 'Eduardo Casados', 545346547, 12, 345);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_orders`
--

CREATE TABLE `user_orders` (
  `id` int(11) NOT NULL,
  `productos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`productos`)),
  `total` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `envio` text NOT NULL,
  `metodo_envio` text NOT NULL,
  `metodo_pago` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_orders`
--

INSERT INTO `user_orders` (`id`, `productos`, `total`, `fecha`, `envio`, `metodo_envio`, `metodo_pago`, `user_id`) VALUES
(10, '{\"0\":{\"product_id\":\"3\",\"amount\":3},\"1\":{\"product_id\":\"4\",\"amount\":3},\"total\":523.64}', 524, '2023-06-26', 'En proceso', 'DHL', 'OXXO', 2),
(11, '{\"0\":{\"product_id\":\"4\",\"amount\":2},\"1\":{\"product_id\":\"2\",\"amount\":2},\"total\":445.03999999999996}', 445, '2023-06-26', 'En proceso', 'Paquetexpress', 'OXXO', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_card_data`
--
ALTER TABLE `user_card_data`
  ADD PRIMARY KEY (`user_id`);

--
-- Indices de la tabla `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user_card_data`
--
ALTER TABLE `user_card_data`
  ADD CONSTRAINT `user_card_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
