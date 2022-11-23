-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2022 a las 01:24:12
-- Versión del servidor: 10.4.24-MariaDB-log
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `productos`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_crear_detalle_venta` (IN `codigo` INT, IN `precio` INT, IN `cantidad` INT, IN `subtotal` INT)   BEGIN
DECLARE max_id_venta int;
SET max_id_venta =(SELECT get_last_venta());
INSERT INTO detalle_venta
VALUES (null, max_id_venta, codigo, cantidad, subtotal, precio);
CALL pa_descontar_stock(codigo, cantidad);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_crear_venta` (IN `total` INT(10))   BEGIN
INSERT INTO venta VALUES(null, now(), total);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_descontar_stock` (IN `cod_desc` INT, IN `cant_descontar` INT)   BEGIN
DECLARE COD_CONSULTA INT;
SET COD_CONSULTA = (SELECT codigo FROM producto where codigo = cod_desc);
UPDATE producto SET cantidad = cantidad - cant_descontar WHERE codigo = COD_CONSULTA;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_validar_stock` (IN `codigo_stock` INT, OUT `stockActual` INT)   BEGIN
SELECT cantidad INTO stockActual
FROM producto
WHERE codigo = codigo_stock;
END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `get_last_venta` () RETURNS INT(10) DETERMINISTIC BEGIN
DECLARE max_id_venta INT;
SET max_id_venta = (SELECT MAX(id_venta) from venta);
RETURN max_id_venta;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id` int(10) NOT NULL,
  `id_venta` int(10) NOT NULL,
  `codigo_pro` int(10) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `subtotal` int(10) NOT NULL,
  `precio` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id`, `id_venta`, `codigo_pro`, `cantidad`, `subtotal`, `precio`) VALUES
(1, 1, 30016, 1, 100000, 100000),
(2, 1, 30019, 1, 56410, 56410),
(3, 2, 30015, 2, 3200000, 1600000),
(4, 2, 30018, 2, 6504000, 3252000),
(5, 3, 30015, 3, 4800000, 1600000),
(6, 3, 30016, 4, 400000, 100000),
(7, 4, 30017, 1, 550000, 550000),
(8, 5, 30019, 2, 112820, 56410),
(9, 5, 30020, 1, 580000, 580000),
(10, 6, 30020, 1, 580000, 580000),
(11, 6, 30018, 1, 3252000, 3252000),
(12, 7, 30019, 2, 112820, 56410);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `codigo` int(8) NOT NULL,
  `nom_pro` varchar(50) NOT NULL,
  `precio` int(10) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `oculto` int(1) DEFAULT NULL,
  `cod_barra` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `codigo`, `nom_pro`, `precio`, `cantidad`, `imagen`, `oculto`, `cod_barra`) VALUES
(1, 30015, 'Ryzen 9 5950x', 1600000, 5, 'ryzen9.jpg', 0, NULL),
(2, 30016, 'Teclado Mecanico', 100000, 11, 'teclado_mecanico_logitech.jpg', 0, NULL),
(3, 30017, 'board asus', 550000, 4, 'asus_h570.jfif', 0, NULL),
(4, 30018, 'portatil asus rog', 3252000, 2, 'asus_rog.jfif', 0, NULL),
(6, 30019, 'Mouse pad gamer', 56410, 10, 'mouse_pad_gamer.jfif', 0, NULL),
(7, 30020, 'SSD gigabyte 240 GB', 580000, 3, 'ssd_gigagyte_240GB.png', 0, NULL),
(8, 30021, 'Bocinas logitech', 215000, 5, 'logitech_z506.jpeg', 0, NULL),
(9, 30022, 'audifonos jbl', 203000, 9, 'jbl_t120.jfif', 0, NULL),
(10, 30023, 'Monitor Sceptre 24 pulgadas', 463000, 5, 'sceptre_24_curvo.jpg', 0, NULL),
(12, 30024, 'poco f4 GT', 1554020, 7, 'poco_f4_gt.jpg', 0, NULL),
(11, 30025, 'POCO M4 PRO GT_', 856000, 10, 'poco_m4_pro.jfif', 0, NULL),
(13, 30026, 'Modem tp-link', 97300, 13, 'moden_tp-link.jfif', 0, NULL),
(14, 30027, 'Memoria usb kingston 64 b', 52310, 20, 'memoria-usb-64gb-kingston.jpg', 0, NULL),
(15, 30028, 'ventilador samurai', 210000, 3, 'ventilador_samurai_ultra.jpg', 0, NULL),
(16, 30029, 'audifonos jbl t120', 295685, 5, 'jbl_t120.jfif', 0, NULL),
(17, 30030, 'iphone 14 max', 7230000, 8, 'iPhone-14-Pro.jpg', 0, NULL),
(18, 30031, 'Samsung s22 ultra', 5100000, 7, 'samsung_s22_ultra.jpg', 0, NULL),
(19, 30032, 'Xiaomi 12 pro', 3700000, 4, 'xiaomi_12_pro.jpg', 0, NULL),
(20, 30033, 'SSD Gigabyte 1TB', 469500, 3, 'm.2_gigagyte_1TB.png', 0, NULL),
(21, 30034, 'xiami pad 5', 1500000, 6, 'xiaomi_pad_5.jpg', 0, NULL),
(22, 30035, 'aple watch', 210000, 12, 'aple_watch_series_4.jfif', 0, NULL),
(23, 30036, 'Samsung m.2 1TB', 955500, 3, 'm.2_nvme_samsung.jpg', 0, NULL),
(24, 30037, 'Mouse Logitech G604', 263000, 5, 'mouse_g604_logitech.webp', 0, NULL),
(25, 30038, 'Power Bank Pxwaxpy', 141500, 3, 'power_bank_36800.jpg', 0, NULL),
(26, 30039, 'Impresora 3D Ender 3', 1389000, 5, 'impresora_3d_Ender3_creality.png', 0, NULL),
(27, 30040, 'Ipad Pro M2', 8463000, 3, 'ipad_pro_m2.jfif', 0, NULL),
(28, 30041, 'Camara Seguridad Wifi 360 Steren', 200000, 3, 'camara_wifi_360_steren.jpg', 0, NULL),
(29, 30042, 'Usb Kingston 64 GB', 45000, 5, 'memoria-usb-64gb-kingston.jpg', 0, NULL),
(30, 30043, 'Control Ps4', 160000, 5, '', 0, NULL),
(31, 30044, 'Control Xbox One S', 230000, 6, '', 0, NULL),
(32, 30045, 'Audifono cable', 13600, 20, '', 0, NULL),
(33, 30046, 'prueba', 1, 1, '', 0, NULL),
(34, 30047, 'prueba', 2, 1, '', 0, NULL),
(35, 30048, 'prueba', 1, 1, '', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `fecha`, `total`) VALUES
(1, '2022-09-07', 156410),
(2, '2022-09-07', 9704000),
(3, '2022-09-08', 5200000),
(4, '2022-09-11', 550000),
(5, '2022-09-11', 692820),
(6, '2022-09-11', 3832000),
(7, '2022-09-16', 112820);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_venta_v_fk_id_det_venta` (`id_venta`),
  ADD KEY `codigo_pro_fk_codigo_pro_det` (`codigo_pro`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `codigo_pro_fk_codigo_pro_det` FOREIGN KEY (`codigo_pro`) REFERENCES `producto` (`codigo`),
  ADD CONSTRAINT `id_venta_v_fk_id_det_venta` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
