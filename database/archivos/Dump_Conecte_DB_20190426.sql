-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 26-04-2019 a las 17:29:25
-- Versión del servidor: 8.0.15
-- Versión de PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `conecte_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('djruiz@outlook.es', '26fbbe6d55d2b26fa89f5b6a487d59e0b8ac1006a97a2b2d05cb74c8e21942c8', '2019-04-26 22:28:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_billeteras`
--

CREATE TABLE `tbl_billeteras` (
  `ID` int(11) UNSIGNED NOT NULL,
  `ID_USER` int(11) UNSIGNED NOT NULL,
  `SALDO` varchar(250) NOT NULL DEFAULT '0',
  `SALDO_TOTAL` varchar(250) NOT NULL DEFAULT '0',
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_billeteras`
--

INSERT INTO `tbl_billeteras` (`ID`, `ID_USER`, `SALDO`, `SALDO_TOTAL`, `CREATED_AT`, `UPDATED_AT`) VALUES
(11, 1, '300000000', '300000000', NULL, '2019-04-23 10:04:05'),
(12, 2, '323600', '300000000', NULL, '2019-04-23 21:34:11'),
(13, 28, '11400', '12800', NULL, '2019-04-23 10:04:05'),
(14, 3, '0', '0', NULL, '2019-04-23 09:34:24'),
(16, 30, '0', '0', '2019-04-26 21:09:03', '2019-04-26 21:09:03'),
(19, 33, '0', '0', '2019-04-26 22:02:36', '2019-04-26 22:02:36'),
(21, 35, '0', '0', '2019-04-26 22:16:43', '2019-04-26 22:16:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_configuraciones_artistas`
--

CREATE TABLE `tbl_configuraciones_artistas` (
  `ID` int(11) NOT NULL,
  `ID_ARTISTA` int(10) UNSIGNED NOT NULL,
  `PRECIO_DEDICATORIA` varchar(250) NOT NULL,
  `ACEPTO_SOLICITUDES_DE_DEDICATORIAS` int(10) UNSIGNED DEFAULT NULL,
  `ACEPTO_CONTRATOS` int(10) UNSIGNED NOT NULL,
  `COMICION_DECICATORIAS` varchar(10) DEFAULT '0',
  `COMICION_CONTRATOS` varchar(10) DEFAULT '0',
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_configuraciones_artistas`
--

INSERT INTO `tbl_configuraciones_artistas` (`ID`, `ID_ARTISTA`, `PRECIO_DEDICATORIA`, `ACEPTO_SOLICITUDES_DE_DEDICATORIAS`, `ACEPTO_CONTRATOS`, `COMICION_DECICATORIAS`, `COMICION_CONTRATOS`, `CREATED_AT`, `UPDATED_AT`) VALUES
(1, 1, '25000', 27, 26, '0', '0', '2019-03-29 17:24:51', '2019-03-29 17:24:51'),
(2, 2, '35000', 26, 26, '4', '1', '2019-03-29 17:24:51', '2019-04-17 02:05:05'),
(3, 3, '35000', 26, 26, '4', '1', '2019-03-29 17:24:51', '2019-04-17 02:05:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_formulario_de_pago_contratacion`
--

CREATE TABLE `tbl_formulario_de_pago_contratacion` (
  `ID` int(10) UNSIGNED NOT NULL,
  `ID_SOLICITUD_DE_CONTRATACION` int(10) UNSIGNED NOT NULL,
  `PRECIO` varchar(250) DEFAULT NULL,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_formulario_de_pago_contratacion`
--

INSERT INTO `tbl_formulario_de_pago_contratacion` (`ID`, `ID_SOLICITUD_DE_CONTRATACION`, `PRECIO`, `CREATED_AT`, `UPDATED_AT`) VALUES
(17, 12, '1000000', '2019-04-23 10:01:19', '2019-04-23 10:01:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_movimientos`
--

CREATE TABLE `tbl_movimientos` (
  `ID` int(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_ARTISTA` int(10) UNSIGNED DEFAULT NULL,
  `ID_CLIENTE` int(10) UNSIGNED DEFAULT NULL,
  `ID_TIPO` int(10) UNSIGNED DEFAULT NULL,
  `ID_ESTADO` int(10) UNSIGNED DEFAULT NULL,
  `COSTO_TOTAL` varchar(250) DEFAULT NULL,
  `PORCENTAJE_PLATAFORMA` varchar(250) NOT NULL,
  `COMICION_PLATAFORMA` varchar(250) NOT NULL,
  `PORCENTAJE_ARTISTA` varchar(250) NOT NULL,
  `COMICION_ARTISTA` varchar(250) NOT NULL,
  `SOPORTE` text,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_movimientos`
--

INSERT INTO `tbl_movimientos` (`ID`, `ID_ARTISTA`, `ID_CLIENTE`, `ID_TIPO`, `ID_ESTADO`, `COSTO_TOTAL`, `PORCENTAJE_PLATAFORMA`, `COMICION_PLATAFORMA`, `PORCENTAJE_ARTISTA`, `COMICION_ARTISTA`, `SOPORTE`, `CREATED_AT`, `UPDATED_AT`) VALUES
(0000000050, 2, 1, 31, 40, '35000', '4', '1400', '96', '33600', NULL, '2019-04-23 09:57:29', '2019-04-23 09:57:29'),
(0000000051, 2, 1, 32, 40, '1000000', '1', '10000', '99', '990000', NULL, '2019-04-23 10:04:05', '2019-04-23 10:04:05'),
(0000000052, 2, 2, 39, 40, '500000', '0', '0', '0', '0', '52.jpg', '2019-04-23 20:15:08', '2019-04-23 21:14:31'),
(0000000053, 2, 2, 39, 40, '50000', '0', '0', '0', '0', '53.jpeg', '2019-04-23 21:31:29', '2019-04-23 21:31:42'),
(0000000054, 2, 2, 39, 40, '100000', '0', '0', '0', '0', '54.jpeg', '2019-04-23 21:33:53', '2019-04-23 21:34:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_negociacion_contratacion`
--

CREATE TABLE `tbl_negociacion_contratacion` (
  `ID` int(10) UNSIGNED NOT NULL,
  `ID_SOLICITUD_DE_CONTRATACION` int(10) UNSIGNED NOT NULL,
  `ID_USER` int(10) UNSIGNED NOT NULL,
  `ID_ARTISTA` int(10) UNSIGNED NOT NULL,
  `ID_CLIENTE` int(10) UNSIGNED NOT NULL,
  `ID_ESTADO` int(10) UNSIGNED NOT NULL DEFAULT '44',
  `MENSAJE` text NOT NULL,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_negociacion_contratacion`
--

INSERT INTO `tbl_negociacion_contratacion` (`ID`, `ID_SOLICITUD_DE_CONTRATACION`, `ID_USER`, `ID_ARTISTA`, `ID_CLIENTE`, `ID_ESTADO`, `MENSAJE`, `CREATED_AT`, `UPDATED_AT`) VALUES
(30, 12, 2, 2, 1, 44, 'UN saludo', '2019-04-23 10:01:09', '2019-04-23 10:01:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_parametros`
--

CREATE TABLE `tbl_parametros` (
  `ID` int(10) UNSIGNED NOT NULL,
  `ID_VALOR` int(10) UNSIGNED NOT NULL,
  `NOMBRE` varchar(250) NOT NULL,
  `DESCRIPCION` text NOT NULL,
  `ID_ESTADO` int(11) NOT NULL DEFAULT '0',
  `CREATED_AT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATED_AT` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_parametros`
--

INSERT INTO `tbl_parametros` (`ID`, `ID_VALOR`, `NOMBRE`, `DESCRIPCION`, `ID_ESTADO`, `UPDATED_AT`) VALUES
(0, 0, 'Clientes', 'Sin definir.', 0, NULL),
(1, 0, 'Artistas o celebridad', 'Sin definri.', 0, NULL),
(2, 0, 'Administrador', 'Sin definir.', 0, NULL),
(3, 1, 'Champeta', 'Sin definir.', 0, NULL),
(4, 1, 'Vallenato', 'Sin definir.', 0, NULL),
(5, 1, 'Salsa', 'Sin definir.', 0, NULL),
(6, 1, 'Reggaeton', 'Sin definir.', 0, NULL),
(7, 1, 'Trap', 'Sin definir.', 0, NULL),
(9, 2, 'Activo', 'Sin definir.', 0, NULL),
(10, 2, 'Pendiente', 'Sin definir.', 0, NULL),
(11, 2, 'Rechazado', 'Sin definir.', 0, NULL),
(12, 3, 'Pendiente por pago', 'El ciente solicito una dedicatoria pero a un la pagado', 0, NULL),
(13, 3, 'Esperando respuesta', 'El cliente ya pago, y esta esperando respuesta por parte del artista o celebridad', 0, NULL),
(14, 3, 'Respondido', 'El artista o celebridad respondo la solicitud del cliente.', 0, NULL),
(15, 3, 'Finalizado', 'Sin definir.', 0, '2019-04-22 11:38:26'),
(16, 3, 'Cancelado', 'Sin definir.', 0, NULL),
(17, 2, 'Pendiente por revisión', 'Sin definir.', 0, NULL),
(18, 4, 'Msg de confirmación', 'Gracias por registrarte en nuestra plataforma, hemos enviado un correo electronico para que confirmes la cuenta.', 0, NULL),
(19, 2, 'Suspendido', 'Sin definir.', 0, NULL),
(20, 1, 'Corrido', 'Sin definir.', 0, NULL),
(21, 1, 'Country', 'Sin definir.', 0, NULL),
(24, 1, 'Blues', 'Sin definir.', 0, NULL),
(25, 1, 'Cumbia', 'Sin definir.', 0, NULL),
(26, 5, 'Si', 'Sin definir.', 0, NULL),
(27, 5, 'No', 'Sin definir.', 0, NULL),
(28, 6, 'Publicado', 'Sin definri.', 0, NULL),
(29, 6, 'Borrador', 'Sin definri.', 0, NULL),
(30, 6, 'Eliminar', 'Sin definri.', 0, NULL),
(31, 7, 'Dedicatoria', 'Sin definir.', 0, NULL),
(32, 7, 'Contratacion', 'Sin definir.', 0, NULL),
(33, 8, 'Esperando respuesta', 'Esperando respuesta', 0, NULL),
(34, 8, 'Reportado al administrador', 'Reportado al administrador', 0, NULL),
(35, 8, 'En negociacion', 'En negociacion', 0, NULL),
(38, 4, 'Msg de dedicatoria.', 'Has resivido una nueva solictud de dedicatoria.', 0, NULL),
(39, 7, 'Retiro', 'Sin definir.', 0, NULL),
(40, 9, 'Aprobado', 'Sin definir.', 0, NULL),
(41, 9, 'Rechazado', 'Sin definir.', 0, NULL),
(42, 9, 'Esperando aprobación', 'Sin definir.', 0, NULL),
(43, 4, 'Msg de contratación', 'Nos complace informate que te allegado una solicitud de crontratación de un cliente,  responde lo mas pronto posile, gracias.', 0, NULL),
(44, 10, 'Enviado', 'Mensaje enviado', 0, NULL),
(45, 10, 'Eliminado', 'Este mensaje eliminado', 0, NULL),
(46, 8, 'Pendiente por pago', 'Pendiente por pago', 0, NULL),
(47, 8, 'Pagado', 'Pagado', 0, NULL),
(48, 8, 'Cancelado', 'Cancelado', 0, NULL),
(49, 8, 'Finalizado', 'Finalizado', 0, NULL),
(50, 7, 'Deposito', 'Deposito', 0, NULL),
(51, 3, 'Reportado', 'Reportado al adminitrador', 0, '2019-04-22 11:39:44'),
(52, 11, 'Titulo Nª 1', 'Tu artista cerca de ti', 0, NULL),
(53, 11, 'Titulo Nª 2', 'Conecta tu artista favorito, con tu persona favorita.', 0, NULL),
(54, 11, 'Titulo Nª 3', 'Conecta con tu artista', 0, NULL),
(55, 11, 'Titulo Nª 4', 'Sólo por $9,99 US', 0, NULL),
(56, 12, 'Facebook', 'Url de facebook', 0, NULL),
(57, 12, 'Twiter', 'Url de twiter', 0, NULL),
(58, 12, 'Instagram', 'Url de instagram', 0, NULL),
(59, 4, 'Msg de liquidacion', 'Nos complace informate que tu solicitud de retiro a sido aprobada, revisa tus transaciones o movientos y descarga el soporte', 0, NULL),
(60, 1, 'Usuarios clientes', 'Sin definir.', 0, NULL),
(61, 11, 'Titulo Nª 5', '35.000 COP', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_post_artistas`
--

CREATE TABLE `tbl_post_artistas` (
  `ID` int(11) NOT NULL,
  `ID_ARTISTA` int(10) UNSIGNED NOT NULL,
  `NOMBRE` text NOT NULL,
  `IMAGEN` text,
  `EMBED` text NOT NULL,
  `DESCRIPCION` text NOT NULL,
  `ID_ESTADO` int(10) UNSIGNED NOT NULL,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_post_artistas`
--

INSERT INTO `tbl_post_artistas` (`ID`, `ID_ARTISTA`, `NOMBRE`, `IMAGEN`, `EMBED`, `DESCRIPCION`, `ID_ESTADO`, `CREATED_AT`, `UPDATED_AT`) VALUES
(1, 2, 'La PupiCole', 'LaPupiCole.jpg', 'https://www.youtube.com/embed/74yo_jkHvgk', 'Sin definir', 28, '2019-03-29 17:24:51', NULL),
(2, 2, 'Pa\' la calle me voy', 'Pa\' la calle me voy.jpg', 'https://www.youtube.com/embed/tacQJz76s7U', 'Sin definir', 28, '2019-03-29 17:24:51', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitudes_de_contratacion`
--

CREATE TABLE `tbl_solicitudes_de_contratacion` (
  `ID` int(10) UNSIGNED NOT NULL,
  `ID_ARTISTA` int(10) UNSIGNED NOT NULL,
  `ID_CLIENTE` int(10) UNSIGNED NOT NULL,
  `ID_ESTADO` int(10) UNSIGNED NOT NULL,
  `COSTO` varchar(250) DEFAULT NULL,
  `CIUDAD` text NOT NULL,
  `PAIS` text NOT NULL,
  `DIRECCION` text NOT NULL,
  `NOMBRES` text NOT NULL,
  `TELEFONO` text NOT NULL,
  `DESDE` text NOT NULL,
  `HASTA` text NOT NULL,
  `HORA` text NOT NULL,
  `MENSAJE` text NOT NULL,
  `ID_MOVIMIENTO` int(10) UNSIGNED DEFAULT NULL,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_solicitudes_de_contratacion`
--

INSERT INTO `tbl_solicitudes_de_contratacion` (`ID`, `ID_ARTISTA`, `ID_CLIENTE`, `ID_ESTADO`, `COSTO`, `CIUDAD`, `PAIS`, `DIRECCION`, `NOMBRES`, `TELEFONO`, `DESDE`, `HASTA`, `HORA`, `MENSAJE`, `ID_MOVIMIENTO`, `CREATED_AT`, `UPDATED_AT`) VALUES
(12, 2, 1, 49, '1000000', 'Barranquilla', 'Colombia', 'Kr 5 N 15', 'Daniel Jose Ruiz Gutierrez', '3222222', '2019-04-23', '2019-04-23', '04:00', 'ok ESTA ES LA FIESTA', 51, '2019-04-23 10:00:26', '2019-04-23 10:05:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitudes_de_dedicatorias`
--

CREATE TABLE `tbl_solicitudes_de_dedicatorias` (
  `ID` int(11) UNSIGNED NOT NULL,
  `ID_ARTISTA` int(11) UNSIGNED NOT NULL,
  `ID_CLIENTE` int(11) UNSIGNED NOT NULL,
  `ID_ESTADO` int(11) UNSIGNED NOT NULL,
  `DE_PARTE_DE` text NOT NULL,
  `DIRIGIDO_A` text NOT NULL,
  `MENSAJE` text NOT NULL,
  `COSTO_DEDICATORIA` varchar(250) NOT NULL,
  `URL_DE_RESPUESTA` text,
  `ID_MOVIMIENTO` int(10) UNSIGNED NOT NULL,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_solicitudes_de_dedicatorias`
--

INSERT INTO `tbl_solicitudes_de_dedicatorias` (`ID`, `ID_ARTISTA`, `ID_CLIENTE`, `ID_ESTADO`, `DE_PARTE_DE`, `DIRIGIDO_A`, `MENSAJE`, `COSTO_DEDICATORIA`, `URL_DE_RESPUESTA`, `ID_MOVIMIENTO`, `CREATED_AT`, `UPDATED_AT`) VALUES
(26, 2, 1, 14, 'Mi', 'Ti', 'OK', '35000', 'conecte/Twister_el_Rey_2/Twister_el_Rey__2_1556121031754.mp4', 50, '2019-04-23 09:57:29', '2019-04-24 15:50:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitudes_de_liquidacion`
--

CREATE TABLE `tbl_solicitudes_de_liquidacion` (
  `ID` int(11) UNSIGNED ZEROFILL NOT NULL,
  `ID_ARTISTA` int(11) UNSIGNED NOT NULL,
  `CANTIDAD` varchar(250) NOT NULL,
  `ID_MOVIMIENTO` int(11) UNSIGNED NOT NULL,
  `ID_ESTADO` int(11) UNSIGNED DEFAULT NULL,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_solicitudes_de_liquidacion`
--

INSERT INTO `tbl_solicitudes_de_liquidacion` (`ID`, `ID_ARTISTA`, `CANTIDAD`, `ID_MOVIMIENTO`, `ID_ESTADO`, `CREATED_AT`, `UPDATED_AT`) VALUES
(00000000018, 2, '500000', 52, 40, '2019-04-23 20:15:08', '2019-04-23 21:14:31'),
(00000000019, 2, '50000', 53, 40, '2019-04-23 21:31:29', '2019-04-23 21:31:42'),
(00000000020, 2, '100000', 54, 40, '2019-04-23 21:33:53', '2019-04-23 21:34:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_valores`
--

CREATE TABLE `tbl_valores` (
  `ID` int(11) UNSIGNED NOT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  `DESCRIPCION` varchar(250) NOT NULL,
  `ID_ESTADO` varchar(45) NOT NULL DEFAULT '0',
  `CREATED_AT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATED_AT` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_valores`
--

INSERT INTO `tbl_valores` (`ID`, `NOMBRE`, `DESCRIPCION`, `ID_ESTADO`, `UPDATED_AT`) VALUES
(0, 'Tipo de perfil', 'Sin definir.', '0', '2019-04-09 08:50:06'),
(1, 'Generos', 'Sin definir.', '0', NULL),
(2, 'Estado de cuenta', 'Sin definir.', '0', NULL),
(3, 'Estado dedicatorias', 'Sin definir.', '0', NULL),
(4, 'Mensajes de correo', 'Con tiene el msj del correo de confirmacion', '0', NULL),
(5, 'Si y No', 'Sin definir.', '0', NULL),
(6, 'Estado de post', 'Sin definir.', '0', NULL),
(7, 'Tipo de movimientos', 'Sin definir.', '0', NULL),
(8, 'Estado de contratacion', 'Sin definir.', '0', NULL),
(9, 'Estados movimientos', 'Sin definir.', '0', NULL),
(10, 'Estado de los mensaje de contratacion', 'Sin definir.', '0', NULL),
(11, 'Pagina de inicio', 'Sin definir.', '0', NULL),
(12, 'Redes sociales', 'Sin definir.', '0', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_perfil` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `id_genero` int(11) UNSIGNED DEFAULT '60',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `foto_perfil` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '1006517.svg',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirm_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_estado` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foto_portada` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'fondoPerfilArtisata.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `id_perfil`, `id_genero`, `name`, `email`, `foto_perfil`, `password`, `remember_token`, `confirm_token`, `id_estado`, `created_at`, `updated_at`, `foto_portada`) VALUES
(1, 0, 60, 'Daniel Develop App', 'daniel.ruiz@developapp.co', '1.jpg', '$2y$10$npVVZwJB.bijf7db970rbOy9dkp9d290ssnrjmu.l5v6OHK007L1S', 'V7yMziA7aKgfGpiYZVZzB0K19macr5jrlNQ1OhoqlHYwseMFwJmFbs6IDPak', NULL, 9, '2019-03-29 21:45:17', '2019-04-26 21:56:31', 'fondoPerfilArtisata.jpg'),
(2, 1, 3, 'Twister el Rey ', 'djruizgutierrezz@gmail.com', 'sebastian-yatra-artista-colombiano.jpg', '$2y$10$zmMU0MSRVe3NxnjpsHRGeuZnb8OlqmO.Gfn76TDFDTaTHkoSdiPhq', 'kBdWAtnF98R00PLhRX1lelKesd1zErFq2XaRdqlCZ8O3mBHNwDuwQkNBkdSm', NULL, 9, '2019-03-29 21:45:17', '2019-04-23 21:12:22', '2.jpg'),
(3, 1, 7, 'Piso 21', 'piso.21@developapp.co', 'sebastian-yatra-artista-colombiano.jpg', '$2y$10$Bx41OtubyGlBjoWg6j.r5eOsuklx/KMRUF8rk71JBzY/hL0zgdTEW', NULL, NULL, 9, '2019-03-29 21:45:17', '2019-04-23 09:26:45', 'fondoPerfilArtisata.jpg'),
(4, 1, 3, 'Sebastián Yatra', 'sebastian.yatra@developapp.co', 'sebastian-yatra-artista-colombiano.jpg', '$2y$10$Bx41OtubyGlBjoWg6j.r5eOsuklx/KMRUF8rk71JBzY/hL0zgdTEW', NULL, NULL, 9, '2019-03-29 21:45:17', NULL, 'fondoPerfilArtisata.jpg'),
(5, 1, 3, 'Young F ', 'young.f@developapp.co', 'sebastian-yatra-artista-colombiano.jpg', '$2y$10$Bx41OtubyGlBjoWg6j.r5eOsuklx/KMRUF8rk71JBzY/hL0zgdTEW', NULL, NULL, 9, '2019-03-29 21:45:17', NULL, 'fondoPerfilArtisata.jpg'),
(28, 2, 60, 'Daniel Ruiz', 'jaime.barrios@developapp.co', '28.png', '$2y$10$K2btI9nvkUWT646tjHxWS.geazRcJx4RfGf2qaMgf2ZtXkE2XWvda', '7BNdeMBsSwtPgGAW6KO7lox8zvSEukYZt6clsYmokU19OkbaS8NFcZKI8BQL', NULL, 9, '2019-03-29 21:45:17', '2019-04-23 21:42:25', 'fondoPerfilArtisata.jpg'),
(30, 0, 60, 'Juan Cho', 'juancho@emailna.co', '1006517.svg', '$2y$10$DZwaehGmWLKj6bMV.tCR1u/VpVoed4VhnWjZi2KzDxbFpTUoGjPVu', '7bVHmYCjK5V18YNQ1MxibA3b8DrNG2qNS6VYeD3A7KImz2rn7nwvAbffjZawEXnXJ6yhuaMv5N02icm76fuSVJNdOl5jkdK9jwNh', 'sv4Gvc4f2Eeu1DHx4EvR3MNj3eUJu8ZhuR5RmKP9Safdnaf1rMVKDOjyLSqix1si332YVYtvps2VpKOdjOzniR1JTokLOBtD9HMF', 10, '2019-04-26 21:09:03', '2019-04-26 21:09:03', 'fondoPerfilArtisata.jpg'),
(33, 0, 60, 'Daniel Outlook', 'djruiz@outlook.ess', '1006517.svg', '$2y$10$n5mZfcnNlrO53A/SGi0cnumGF5XzMSHKfg8bwnJO66UkwK/CqQPv6', 'RDeFaN7PbWmPSd5jsbxAo7hgh5MGG65bJUz2E5piYw59YB9nHZY0nvNiSBU95ZELqDqxrtxJU0VFkKFezqazJJEQ6TvzljZOwKoJ', '9TkKJ082teFWAkM7GJ83rEzHbZ5mFrltfy4EJn2VKF5zcRl1g1awHPm3Esm7IOdAg5miPRN5HqHrni7zVSyvYzbTUprIhKTDm1mo', 9, '2019-04-26 22:02:36', '2019-04-26 22:04:36', 'fondoPerfilArtisata.jpg'),
(35, 1, 60, 'Oto', 'djruiz@outlook.es', '1006517.svg', '$2y$10$lz2XKXeLlP/VTd4qXx6xE.B/uI6b9RfkPY6FQeT2EFs31EOICLD7W', 'H2eRhVEfFNWSDfaLCflDNwF0We6zJ2szwcvNrOlZ6wOTIwgpSS5whmnTr37se7lSiPmSWnvXHJiWG2yIrbb9G7RHVoOH8kpsQuUm', 'ycDuYK9FPEzEWpqFoGy6gcqFN541CFrbi66YHcz75Tr0IULX6vXsSz1YoSKqx3TXvSmUjSW79kBva78PG2jnRxX7m99eMq0fwu2S', 17, '2019-04-26 22:16:43', '2019-04-26 22:17:07', 'fondoPerfilArtisata.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `tbl_billeteras`
--
ALTER TABLE `tbl_billeteras`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tblbilletera_fk1` (`ID_USER`);

--
-- Indices de la tabla `tbl_configuraciones_artistas`
--
ALTER TABLE `tbl_configuraciones_artistas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tblconfiguracionesartistas_fk1` (`ID_ARTISTA`),
  ADD KEY `fk_acepto_solicitudes_de_dedicatorias` (`ACEPTO_SOLICITUDES_DE_DEDICATORIAS`),
  ADD KEY `tblconfiguracionesartistas_fk3` (`ACEPTO_CONTRATOS`);

--
-- Indices de la tabla `tbl_formulario_de_pago_contratacion`
--
ALTER TABLE `tbl_formulario_de_pago_contratacion`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_SOLICITUD_DE_CONTRATACION` (`ID_SOLICITUD_DE_CONTRATACION`);

--
-- Indices de la tabla `tbl_movimientos`
--
ALTER TABLE `tbl_movimientos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tblmovimientos_fk1` (`ID_TIPO`),
  ADD KEY `ID_ARTISTA` (`ID_ARTISTA`),
  ADD KEY `ID_CLIENTE` (`ID_CLIENTE`),
  ADD KEY `ID_ESTADO` (`ID_ESTADO`);

--
-- Indices de la tabla `tbl_negociacion_contratacion`
--
ALTER TABLE `tbl_negociacion_contratacion`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tblnegociacioncontratacion_fk1` (`ID_USER`),
  ADD KEY `ID_SOLICITUD_DE_CONTRATACION` (`ID_SOLICITUD_DE_CONTRATACION`),
  ADD KEY `ID_CLIENTE` (`ID_CLIENTE`),
  ADD KEY `ID_ARTISTA` (`ID_ARTISTA`),
  ADD KEY `ID_ESTADO` (`ID_ESTADO`);

--
-- Indices de la tabla `tbl_parametros`
--
ALTER TABLE `tbl_parametros`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_idx` (`ID_VALOR`);

--
-- Indices de la tabla `tbl_post_artistas`
--
ALTER TABLE `tbl_post_artistas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tblpostartistas_fk1` (`ID_ARTISTA`),
  ADD KEY `tblpostartistas_fk2` (`ID_ESTADO`);

--
-- Indices de la tabla `tbl_solicitudes_de_contratacion`
--
ALTER TABLE `tbl_solicitudes_de_contratacion`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tblsolicitudesdecontratacion_fk1` (`ID_ARTISTA`),
  ADD KEY `tblsolicitudesdecontratacion_fk2` (`ID_CLIENTE`),
  ADD KEY `tblsolicitudesdecontratacion_fk3` (`ID_ESTADO`);

--
-- Indices de la tabla `tbl_solicitudes_de_dedicatorias`
--
ALTER TABLE `tbl_solicitudes_de_dedicatorias`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tblsolicitudesdedicatoria_fk1` (`ID_ARTISTA`),
  ADD KEY `tblsolicitudesdedicatoria_fk2` (`ID_CLIENTE`),
  ADD KEY `tblsolicitudesdedicatoria_fk3` (`ID_ESTADO`),
  ADD KEY `tblsolicitudesdededicatorias_fk3` (`ID_MOVIMIENTO`);

--
-- Indices de la tabla `tbl_solicitudes_de_liquidacion`
--
ALTER TABLE `tbl_solicitudes_de_liquidacion`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_ARTISTA` (`ID_ARTISTA`),
  ADD KEY `ID_ESTADO` (`ID_ESTADO`),
  ADD KEY `ID_MOVIMIENTO` (`ID_MOVIMIENTO`);

--
-- Indices de la tabla `tbl_valores`
--
ALTER TABLE `tbl_valores`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_fk1` (`id_perfil`),
  ADD KEY `users_fk2` (`id_genero`),
  ADD KEY `users_fk3` (`id_estado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_billeteras`
--
ALTER TABLE `tbl_billeteras`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `tbl_configuraciones_artistas`
--
ALTER TABLE `tbl_configuraciones_artistas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_formulario_de_pago_contratacion`
--
ALTER TABLE `tbl_formulario_de_pago_contratacion`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tbl_movimientos`
--
ALTER TABLE `tbl_movimientos`
  MODIFY `ID` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `tbl_negociacion_contratacion`
--
ALTER TABLE `tbl_negociacion_contratacion`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `tbl_parametros`
--
ALTER TABLE `tbl_parametros`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `tbl_post_artistas`
--
ALTER TABLE `tbl_post_artistas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_solicitudes_de_contratacion`
--
ALTER TABLE `tbl_solicitudes_de_contratacion`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tbl_solicitudes_de_dedicatorias`
--
ALTER TABLE `tbl_solicitudes_de_dedicatorias`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `tbl_solicitudes_de_liquidacion`
--
ALTER TABLE `tbl_solicitudes_de_liquidacion`
  MODIFY `ID` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_billeteras`
--
ALTER TABLE `tbl_billeteras`
  ADD CONSTRAINT `tblbilletera_fk1` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tbl_configuraciones_artistas`
--
ALTER TABLE `tbl_configuraciones_artistas`
  ADD CONSTRAINT `fk_acepto_solicitudes_de_dedicatorias` FOREIGN KEY (`ACEPTO_SOLICITUDES_DE_DEDICATORIAS`) REFERENCES `tbl_parametros` (`ID`),
  ADD CONSTRAINT `tblconfiguracionesartistas_fk1` FOREIGN KEY (`ID_ARTISTA`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tblconfiguracionesartistas_fk3` FOREIGN KEY (`ACEPTO_CONTRATOS`) REFERENCES `tbl_parametros` (`ID`);

--
-- Filtros para la tabla `tbl_formulario_de_pago_contratacion`
--
ALTER TABLE `tbl_formulario_de_pago_contratacion`
  ADD CONSTRAINT `tbl_formulario_de_pago_contratacion_ibfk_1` FOREIGN KEY (`ID_SOLICITUD_DE_CONTRATACION`) REFERENCES `tbl_solicitudes_de_contratacion` (`ID`);

--
-- Filtros para la tabla `tbl_movimientos`
--
ALTER TABLE `tbl_movimientos`
  ADD CONSTRAINT `tbl_movimientos_ibfk_1` FOREIGN KEY (`ID_ARTISTA`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tbl_movimientos_ibfk_2` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tbl_movimientos_ibfk_3` FOREIGN KEY (`ID_ESTADO`) REFERENCES `tbl_parametros` (`ID`);

--
-- Filtros para la tabla `tbl_negociacion_contratacion`
--
ALTER TABLE `tbl_negociacion_contratacion`
  ADD CONSTRAINT `tbl_negociacion_contratacion_ibfk_1` FOREIGN KEY (`ID_SOLICITUD_DE_CONTRATACION`) REFERENCES `tbl_solicitudes_de_contratacion` (`ID`),
  ADD CONSTRAINT `tbl_negociacion_contratacion_ibfk_2` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tbl_negociacion_contratacion_ibfk_3` FOREIGN KEY (`ID_ARTISTA`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tbl_negociacion_contratacion_ibfk_4` FOREIGN KEY (`ID_ESTADO`) REFERENCES `tbl_parametros` (`ID`),
  ADD CONSTRAINT `tblnegociacioncontratacion_fk1` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tbl_post_artistas`
--
ALTER TABLE `tbl_post_artistas`
  ADD CONSTRAINT `tblpostartistas_fk1` FOREIGN KEY (`ID_ARTISTA`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tblpostartistas_fk2` FOREIGN KEY (`ID_ESTADO`) REFERENCES `tbl_parametros` (`ID`);

--
-- Filtros para la tabla `tbl_solicitudes_de_contratacion`
--
ALTER TABLE `tbl_solicitudes_de_contratacion`
  ADD CONSTRAINT `tblsolicitudesdecontratacion_fk1` FOREIGN KEY (`ID_ARTISTA`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tblsolicitudesdecontratacion_fk2` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tblsolicitudesdecontratacion_fk3` FOREIGN KEY (`ID_ESTADO`) REFERENCES `tbl_parametros` (`ID`);

--
-- Filtros para la tabla `tbl_solicitudes_de_dedicatorias`
--
ALTER TABLE `tbl_solicitudes_de_dedicatorias`
  ADD CONSTRAINT `tblsolicitudesdededicatorias_fk2` FOREIGN KEY (`ID_ARTISTA`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tblsolicitudesdededicatorias_fk3` FOREIGN KEY (`ID_MOVIMIENTO`) REFERENCES `tbl_movimientos` (`ID`),
  ADD CONSTRAINT `tblsolicitudesdededicatorias_fk4` FOREIGN KEY (`ID_ESTADO`) REFERENCES `tbl_parametros` (`ID`),
  ADD CONSTRAINT `tblsolicitudesdededicatorias_fk5` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tbl_solicitudes_de_liquidacion`
--
ALTER TABLE `tbl_solicitudes_de_liquidacion`
  ADD CONSTRAINT `tbl_solicitudes_de_liquidacion_ibfk_1` FOREIGN KEY (`ID_ARTISTA`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tbl_solicitudes_de_liquidacion_ibfk_2` FOREIGN KEY (`ID_ESTADO`) REFERENCES `tbl_parametros` (`ID`),
  ADD CONSTRAINT `tbl_solicitudes_de_liquidacion_ibfk_3` FOREIGN KEY (`ID_MOVIMIENTO`) REFERENCES `tbl_movimientos` (`ID`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_fk1` FOREIGN KEY (`id_perfil`) REFERENCES `tbl_parametros` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
