-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-06-2022 a las 00:06:58
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sgp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barrios`
--

CREATE TABLE `barrios` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ciudad` int(10) UNSIGNED DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_negocios`
--

CREATE TABLE `categoria_negocios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marcador` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria_negocios`
--

INSERT INTO `categoria_negocios` (`id`, `nombre`, `descripcion`, `marcador`, `created_at`, `updated_at`) VALUES
(1, 'Tienda', 'tiendas,graneros,mini mercados', 'marker2-tienda.png', NULL, NULL),
(2, 'Restaurante', 'restaurantes, comidas rápidas', 'marker2.png', NULL, NULL),
(3, 'Drogueria', 'drogueria', 'marker2-drogueria.png', NULL, NULL),
(4, 'Almacen', 'ropa, variedades, suplementos etc', 'marker2-almacen.png', NULL, NULL),
(5, 'Floristeria', 'floristeria', 'marker2-floristeria.png', NULL, NULL),
(6, 'Heladeria', 'heladeria', 'marker2-heladeria.png', NULL, NULL),
(7, 'Optica', 'opticas', 'marker2-optica.png', NULL, NULL),
(8, 'Licores', 'licores', 'marker2-licorera.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria__productos`
--

CREATE TABLE `categoria__productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_negocio` int(10) UNSIGNED DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria__productos`
--

INSERT INTO `categoria__productos` (`id`, `id_negocio`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lacteos', 'lacteos', '2020-03-30 04:24:07', '2020-03-30 04:24:07'),
(2, 1, 'Galletas', 'galletas', '2020-03-30 20:53:59', '2020-03-30 20:53:59'),
(3, 2, 'Comidas', 'comidas', '2020-04-03 23:22:06', '2020-04-03 23:22:06'),
(4, 2, 'Acompañantes', 'acompañantes', '2020-04-03 23:22:28', '2020-04-03 23:22:28'),
(5, 2, 'Bebidas', 'bebidas', '2020-04-03 23:22:44', '2020-04-03 23:22:44'),
(6, 3, 'Computadores', 'portatiles y de mesa', '2022-06-29 20:39:30', '2022-06-29 20:39:30'),
(7, 3, 'Televisores', 'smart tv, oled', '2022-06-29 20:40:33', '2022-06-29 20:41:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudads`
--

CREATE TABLE `ciudads` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_departamento` int(10) UNSIGNED DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ciudads`
--

INSERT INTO `ciudads` (`id`, `id_departamento`, `estado`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Abriaquí', NULL, NULL),
(2, 50, 1, 'Acacías', NULL, NULL),
(3, 27, 1, 'Acandí', NULL, NULL),
(4, 41, 1, 'Acevedo', NULL, NULL),
(5, 13, 1, 'Achí', NULL, NULL),
(6, 41, 1, 'Agrado', NULL, NULL),
(7, 25, 1, 'Agua de Dios', NULL, NULL),
(8, 20, 1, 'Aguachica', NULL, NULL),
(9, 68, 1, 'Aguada', NULL, NULL),
(10, 17, 1, 'Aguadas', NULL, NULL),
(11, 85, 1, 'Aguazul', NULL, NULL),
(12, 20, 1, 'Agustín Codazzi', NULL, NULL),
(13, 41, 1, 'Aipe', NULL, NULL),
(14, 18, 1, 'Albania', NULL, NULL),
(15, 44, 1, 'Albania', NULL, NULL),
(16, 68, 1, 'Albania', NULL, NULL),
(17, 25, 1, 'Albán', NULL, NULL),
(18, 52, 1, 'Albán (San José)', NULL, NULL),
(19, 76, 1, 'Alcalá', NULL, NULL),
(20, 5, 1, 'Alejandria', NULL, NULL),
(21, 47, 1, 'Algarrobo', NULL, NULL),
(22, 41, 1, 'Algeciras', NULL, NULL),
(23, 19, 1, 'Almaguer', NULL, NULL),
(24, 15, 1, 'Almeida', NULL, NULL),
(25, 73, 1, 'Alpujarra', NULL, NULL),
(26, 41, 1, 'Altamira', NULL, NULL),
(27, 27, 1, 'Alto Baudó (Pie de Pato)', NULL, NULL),
(28, 13, 1, 'Altos del Rosario', NULL, NULL),
(29, 73, 1, 'Alvarado', NULL, NULL),
(30, 5, 1, 'Amagá', NULL, NULL),
(31, 5, 1, 'Amalfi', NULL, NULL),
(32, 73, 1, 'Ambalema', NULL, NULL),
(33, 25, 1, 'Anapoima', NULL, NULL),
(34, 52, 1, 'Ancuya', NULL, NULL),
(35, 76, 1, 'Andalucía', NULL, NULL),
(36, 5, 1, 'Andes', NULL, NULL),
(37, 5, 1, 'Angelópolis', NULL, NULL),
(38, 5, 1, 'Angostura', NULL, NULL),
(39, 25, 1, 'Anolaima', NULL, NULL),
(40, 5, 1, 'Anorí', NULL, NULL),
(41, 17, 1, 'Anserma', NULL, NULL),
(42, 76, 1, 'Ansermanuevo', NULL, NULL),
(43, 73, 1, 'Anzoátegui', NULL, NULL),
(44, 5, 1, 'Anzá', NULL, NULL),
(45, 5, 1, 'Apartadó', NULL, NULL),
(46, 25, 1, 'Apulo', NULL, NULL),
(47, 66, 1, 'Apía', NULL, NULL),
(48, 15, 1, 'Aquitania', NULL, NULL),
(49, 47, 1, 'Aracataca', NULL, NULL),
(50, 17, 1, 'Aranzazu', NULL, NULL),
(51, 68, 1, 'Aratoca', NULL, NULL),
(52, 81, 1, 'Arauca', NULL, NULL),
(53, 81, 1, 'Arauquita', NULL, NULL),
(54, 25, 1, 'Arbeláez', NULL, NULL),
(55, 52, 1, 'Arboleda (Berruecos)', NULL, NULL),
(56, 54, 1, 'Arboledas', NULL, NULL),
(57, 5, 1, 'Arboletes', NULL, NULL),
(58, 15, 1, 'Arcabuco', NULL, NULL),
(59, 13, 1, 'Arenal', NULL, NULL),
(60, 5, 1, 'Argelia', NULL, NULL),
(61, 19, 1, 'Argelia', NULL, NULL),
(62, 76, 1, 'Argelia', NULL, NULL),
(63, 47, 1, 'Ariguaní (El Difícil)', NULL, NULL),
(64, 13, 1, 'Arjona', NULL, NULL),
(65, 5, 1, 'Armenia', NULL, NULL),
(66, 63, 1, 'Armenia', NULL, NULL),
(67, 73, 1, 'Armero (Guayabal)', NULL, NULL),
(68, 13, 1, 'Arroyohondo', NULL, NULL),
(69, 20, 1, 'Astrea', NULL, NULL),
(70, 73, 1, 'Ataco', NULL, NULL),
(71, 27, 1, 'Atrato (Yuto)', NULL, NULL),
(72, 23, 1, 'Ayapel', NULL, NULL),
(73, 27, 1, 'Bagadó', NULL, NULL),
(74, 27, 1, 'Bahía Solano (Mútis)', NULL, NULL),
(75, 27, 1, 'Bajo Baudó (Pizarro)', NULL, NULL),
(76, 19, 1, 'Balboa', NULL, NULL),
(77, 66, 1, 'Balboa', NULL, NULL),
(78, 8, 1, 'Baranoa', NULL, NULL),
(79, 41, 1, 'Baraya', NULL, NULL),
(80, 52, 1, 'Barbacoas', NULL, NULL),
(81, 5, 1, 'Barbosa', NULL, NULL),
(82, 68, 1, 'Barbosa', NULL, NULL),
(83, 68, 1, 'Barichara', NULL, NULL),
(84, 50, 1, 'Barranca de Upía', NULL, NULL),
(85, 68, 1, 'Barrancabermeja', NULL, NULL),
(86, 44, 1, 'Barrancas', NULL, NULL),
(87, 13, 1, 'Barranco de Loba', NULL, NULL),
(88, 8, 1, 'Barranquilla', NULL, NULL),
(89, 20, 1, 'Becerríl', NULL, NULL),
(90, 17, 1, 'Belalcázar', NULL, NULL),
(91, 5, 1, 'Bello', NULL, NULL),
(92, 5, 1, 'Belmira', NULL, NULL),
(93, 25, 1, 'Beltrán', NULL, NULL),
(94, 15, 1, 'Belén', NULL, NULL),
(95, 52, 1, 'Belén', NULL, NULL),
(96, 27, 1, 'Belén de Bajirá', NULL, NULL),
(97, 66, 1, 'Belén de Umbría', NULL, NULL),
(98, 18, 1, 'Belén de los Andaquíes', NULL, NULL),
(99, 15, 1, 'Berbeo', NULL, NULL),
(100, 5, 1, 'Betania', NULL, NULL),
(101, 15, 1, 'Beteitiva', NULL, NULL),
(102, 5, 1, 'Betulia', NULL, NULL),
(103, 68, 1, 'Betulia', NULL, NULL),
(104, 25, 1, 'Bituima', NULL, NULL),
(105, 15, 1, 'Boavita', NULL, NULL),
(106, 54, 1, 'Bochalema', NULL, NULL),
(107, 11, 1, 'Bogotá D.C.', NULL, NULL),
(108, 25, 1, 'Bojacá', NULL, NULL),
(109, 27, 1, 'Bojayá (Bellavista)', NULL, NULL),
(110, 5, 1, 'Bolívar', NULL, NULL),
(111, 19, 1, 'Bolívar', NULL, NULL),
(112, 68, 1, 'Bolívar', NULL, NULL),
(113, 76, 1, 'Bolívar', NULL, NULL),
(114, 20, 1, 'Bosconia', NULL, NULL),
(115, 15, 1, 'Boyacá', NULL, NULL),
(116, 5, 1, 'Briceño', NULL, NULL),
(117, 15, 1, 'Briceño', NULL, NULL),
(118, 68, 1, 'Bucaramanga', NULL, NULL),
(119, 54, 1, 'Bucarasica', NULL, NULL),
(120, 76, 1, 'Buenaventura', NULL, NULL),
(121, 15, 1, 'Buenavista', NULL, NULL),
(122, 23, 1, 'Buenavista', NULL, NULL),
(123, 63, 1, 'Buenavista', NULL, NULL),
(124, 70, 1, 'Buenavista', NULL, NULL),
(125, 19, 1, 'Buenos Aires', NULL, NULL),
(126, 52, 1, 'Buesaco', NULL, NULL),
(127, 76, 1, 'Buga', NULL, NULL),
(128, 76, 1, 'Bugalagrande', NULL, NULL),
(129, 5, 1, 'Burítica', NULL, NULL),
(130, 15, 1, 'Busbanza', NULL, NULL),
(131, 25, 1, 'Cabrera', NULL, NULL),
(132, 68, 1, 'Cabrera', NULL, NULL),
(133, 50, 1, 'Cabuyaro', NULL, NULL),
(134, 25, 1, 'Cachipay', NULL, NULL),
(135, 5, 1, 'Caicedo', NULL, NULL),
(136, 76, 1, 'Caicedonia', NULL, NULL),
(137, 70, 1, 'Caimito', NULL, NULL),
(138, 73, 1, 'Cajamarca', NULL, NULL),
(139, 19, 1, 'Cajibío', NULL, NULL),
(140, 25, 1, 'Cajicá', NULL, NULL),
(141, 13, 1, 'Calamar', NULL, NULL),
(142, 95, 1, 'Calamar', NULL, NULL),
(143, 63, 1, 'Calarcá', NULL, NULL),
(144, 5, 1, 'Caldas', NULL, NULL),
(145, 15, 1, 'Caldas', NULL, NULL),
(146, 19, 1, 'Caldono', NULL, NULL),
(147, 68, 1, 'California', NULL, NULL),
(148, 76, 1, 'Calima (Darién)', NULL, NULL),
(149, 19, 1, 'Caloto', NULL, NULL),
(150, 76, 1, 'Calí', NULL, NULL),
(151, 5, 1, 'Campamento', NULL, NULL),
(152, 8, 1, 'Campo de la Cruz', NULL, NULL),
(153, 41, 1, 'Campoalegre', NULL, NULL),
(154, 15, 1, 'Campohermoso', NULL, NULL),
(155, 23, 1, 'Canalete', NULL, NULL),
(156, 8, 1, 'Candelaria', NULL, NULL),
(157, 76, 1, 'Candelaria', NULL, NULL),
(158, 13, 1, 'Cantagallo', NULL, NULL),
(159, 27, 1, 'Cantón de San Pablo', NULL, NULL),
(160, 25, 1, 'Caparrapí', NULL, NULL),
(161, 68, 1, 'Capitanejo', NULL, NULL),
(162, 5, 1, 'Caracolí', NULL, NULL),
(163, 5, 1, 'Caramanta', NULL, NULL),
(164, 68, 1, 'Carcasí', NULL, NULL),
(165, 5, 1, 'Carepa', NULL, NULL),
(166, 73, 1, 'Carmen de Apicalá', NULL, NULL),
(167, 25, 1, 'Carmen de Carupa', NULL, NULL),
(168, 5, 1, 'Carmen de Viboral', NULL, NULL),
(169, 27, 1, 'Carmen del Darién (CURBARADÓ)', NULL, NULL),
(170, 5, 1, 'Carolina', NULL, NULL),
(171, 13, 1, 'Cartagena', NULL, NULL),
(172, 18, 1, 'Cartagena del Chairá', NULL, NULL),
(173, 76, 1, 'Cartago', NULL, NULL),
(174, 97, 1, 'Carurú', NULL, NULL),
(175, 73, 1, 'Casabianca', NULL, NULL),
(176, 50, 1, 'Castilla la Nueva', NULL, NULL),
(177, 5, 1, 'Caucasia', NULL, NULL),
(178, 5, 1, 'Cañasgordas', NULL, NULL),
(179, 68, 1, 'Cepita', NULL, NULL),
(180, 23, 1, 'Cereté', NULL, NULL),
(181, 15, 1, 'Cerinza', NULL, NULL),
(182, 68, 1, 'Cerrito', NULL, NULL),
(183, 47, 1, 'Cerro San Antonio', NULL, NULL),
(184, 52, 1, 'Chachaguí', NULL, NULL),
(185, 25, 1, 'Chaguaní', NULL, NULL),
(186, 70, 1, 'Chalán', NULL, NULL),
(187, 73, 1, 'Chaparral', NULL, NULL),
(188, 68, 1, 'Charalá', NULL, NULL),
(189, 68, 1, 'Charta', NULL, NULL),
(190, 5, 1, 'Chigorodó', NULL, NULL),
(191, 68, 1, 'Chima', NULL, NULL),
(192, 20, 1, 'Chimichagua', NULL, NULL),
(193, 23, 1, 'Chimá', NULL, NULL),
(194, 15, 1, 'Chinavita', NULL, NULL),
(195, 17, 1, 'Chinchiná', NULL, NULL),
(196, 54, 1, 'Chinácota', NULL, NULL),
(197, 23, 1, 'Chinú', NULL, NULL),
(198, 25, 1, 'Chipaque', NULL, NULL),
(199, 68, 1, 'Chipatá', NULL, NULL),
(200, 15, 1, 'Chiquinquirá', NULL, NULL),
(201, 20, 1, 'Chiriguaná', NULL, NULL),
(202, 15, 1, 'Chiscas', NULL, NULL),
(203, 15, 1, 'Chita', NULL, NULL),
(204, 54, 1, 'Chitagá', NULL, NULL),
(205, 15, 1, 'Chitaraque', NULL, NULL),
(206, 15, 1, 'Chivatá', NULL, NULL),
(207, 47, 1, 'Chivolo', NULL, NULL),
(208, 25, 1, 'Choachí', NULL, NULL),
(209, 25, 1, 'Chocontá', NULL, NULL),
(210, 85, 1, 'Chámeza', NULL, NULL),
(211, 25, 1, 'Chía', NULL, NULL),
(212, 15, 1, 'Chíquiza', NULL, NULL),
(213, 15, 1, 'Chívor', NULL, NULL),
(214, 13, 1, 'Cicuco', NULL, NULL),
(215, 68, 1, 'Cimitarra', NULL, NULL),
(216, 63, 1, 'Circasia', NULL, NULL),
(217, 5, 1, 'Cisneros', NULL, NULL),
(218, 15, 1, 'Ciénaga', NULL, NULL),
(219, 47, 1, 'Ciénaga', NULL, NULL),
(220, 23, 1, 'Ciénaga de Oro', NULL, NULL),
(221, 13, 1, 'Clemencia', NULL, NULL),
(222, 5, 1, 'Cocorná', NULL, NULL),
(223, 73, 1, 'Coello', NULL, NULL),
(224, 25, 1, 'Cogua', NULL, NULL),
(225, 41, 1, 'Colombia', NULL, NULL),
(226, 70, 1, 'Colosó (Ricaurte)', NULL, NULL),
(227, 86, 1, 'Colón', NULL, NULL),
(228, 52, 1, 'Colón (Génova)', NULL, NULL),
(229, 5, 1, 'Concepción', NULL, NULL),
(230, 68, 1, 'Concepción', NULL, NULL),
(231, 5, 1, 'Concordia', NULL, NULL),
(232, 47, 1, 'Concordia', NULL, NULL),
(233, 27, 1, 'Condoto', NULL, NULL),
(234, 68, 1, 'Confines', NULL, NULL),
(235, 52, 1, 'Consaca', NULL, NULL),
(236, 52, 1, 'Contadero', NULL, NULL),
(237, 68, 1, 'Contratación', NULL, NULL),
(238, 54, 1, 'Convención', NULL, NULL),
(239, 5, 1, 'Copacabana', NULL, NULL),
(240, 15, 1, 'Coper', NULL, NULL),
(241, 63, 1, 'Cordobá', NULL, NULL),
(242, 19, 1, 'Corinto', NULL, NULL),
(243, 68, 1, 'Coromoro', NULL, NULL),
(244, 70, 1, 'Corozal', NULL, NULL),
(245, 15, 1, 'Corrales', NULL, NULL),
(246, 25, 1, 'Cota', NULL, NULL),
(247, 23, 1, 'Cotorra', NULL, NULL),
(248, 15, 1, 'Covarachía', NULL, NULL),
(249, 70, 1, 'Coveñas', NULL, NULL),
(250, 73, 1, 'Coyaima', NULL, NULL),
(251, 81, 1, 'Cravo Norte', NULL, NULL),
(252, 52, 1, 'Cuaspud (Carlosama)', NULL, NULL),
(253, 50, 1, 'Cubarral', NULL, NULL),
(254, 15, 1, 'Cubará', NULL, NULL),
(255, 15, 1, 'Cucaita', NULL, NULL),
(256, 25, 1, 'Cucunubá', NULL, NULL),
(257, 54, 1, 'Cucutilla', NULL, NULL),
(258, 15, 1, 'Cuitiva', NULL, NULL),
(259, 50, 1, 'Cumaral', NULL, NULL),
(260, 99, 1, 'Cumaribo', NULL, NULL),
(261, 52, 1, 'Cumbal', NULL, NULL),
(262, 52, 1, 'Cumbitara', NULL, NULL),
(263, 73, 1, 'Cunday', NULL, NULL),
(264, 18, 1, 'Curillo', NULL, NULL),
(265, 68, 1, 'Curití', NULL, NULL),
(266, 20, 1, 'Curumaní', NULL, NULL),
(267, 5, 1, 'Cáceres', NULL, NULL),
(268, 54, 1, 'Cáchira', NULL, NULL),
(269, 54, 1, 'Cácota', NULL, NULL),
(270, 25, 1, 'Cáqueza', NULL, NULL),
(271, 27, 1, 'Cértegui', NULL, NULL),
(272, 15, 1, 'Cómbita', NULL, NULL),
(273, 13, 1, 'Córdoba', NULL, NULL),
(274, 52, 1, 'Córdoba', NULL, NULL),
(275, 54, 1, 'Cúcuta', NULL, NULL),
(276, 5, 1, 'Dabeiba', NULL, NULL),
(277, 76, 1, 'Dagua', NULL, NULL),
(278, 44, 1, 'Dibulla', NULL, NULL),
(279, 44, 1, 'Distracción', NULL, NULL),
(280, 73, 1, 'Dolores', NULL, NULL),
(281, 5, 1, 'Don Matías', NULL, NULL),
(282, 66, 1, 'Dos Quebradas', NULL, NULL),
(283, 15, 1, 'Duitama', NULL, NULL),
(284, 54, 1, 'Durania', NULL, NULL),
(285, 5, 1, 'Ebéjico', NULL, NULL),
(286, 5, 1, 'El Bagre', NULL, NULL),
(287, 47, 1, 'El Banco', NULL, NULL),
(288, 76, 1, 'El Cairo', NULL, NULL),
(289, 50, 1, 'El Calvario', NULL, NULL),
(290, 54, 1, 'El Carmen', NULL, NULL),
(291, 68, 1, 'El Carmen', NULL, NULL),
(292, 27, 1, 'El Carmen de Atrato', NULL, NULL),
(293, 13, 1, 'El Carmen de Bolívar', NULL, NULL),
(294, 50, 1, 'El Castillo', NULL, NULL),
(295, 76, 1, 'El Cerrito', NULL, NULL),
(296, 52, 1, 'El Charco', NULL, NULL),
(297, 15, 1, 'El Cocuy', NULL, NULL),
(298, 25, 1, 'El Colegio', NULL, NULL),
(299, 20, 1, 'El Copey', NULL, NULL),
(300, 18, 1, 'El Doncello', NULL, NULL),
(301, 50, 1, 'El Dorado', NULL, NULL),
(302, 76, 1, 'El Dovio', NULL, NULL),
(303, 15, 1, 'El Espino', NULL, NULL),
(304, 68, 1, 'El Guacamayo', NULL, NULL),
(305, 13, 1, 'El Guamo', NULL, NULL),
(306, 44, 1, 'El Molino', NULL, NULL),
(307, 20, 1, 'El Paso', NULL, NULL),
(308, 18, 1, 'El Paujil', NULL, NULL),
(309, 52, 1, 'El Peñol', NULL, NULL),
(310, 13, 1, 'El Peñon', NULL, NULL),
(311, 68, 1, 'El Peñon', NULL, NULL),
(312, 25, 1, 'El Peñón', NULL, NULL),
(313, 47, 1, 'El Piñon', NULL, NULL),
(314, 68, 1, 'El Playón', NULL, NULL),
(315, 95, 1, 'El Retorno', NULL, NULL),
(316, 47, 1, 'El Retén', NULL, NULL),
(317, 70, 1, 'El Roble', NULL, NULL),
(318, 25, 1, 'El Rosal', NULL, NULL),
(319, 52, 1, 'El Rosario', NULL, NULL),
(320, 52, 1, 'El Tablón de Gómez', NULL, NULL),
(321, 19, 1, 'El Tambo', NULL, NULL),
(322, 52, 1, 'El Tambo', NULL, NULL),
(323, 54, 1, 'El Tarra', NULL, NULL),
(324, 54, 1, 'El Zulia', NULL, NULL),
(325, 76, 1, 'El Águila', NULL, NULL),
(326, 41, 1, 'Elías', NULL, NULL),
(327, 68, 1, 'Encino', NULL, NULL),
(328, 68, 1, 'Enciso', NULL, NULL),
(329, 5, 1, 'Entrerríos', NULL, NULL),
(330, 5, 1, 'Envigado', NULL, NULL),
(331, 73, 1, 'Espinal', NULL, NULL),
(332, 25, 1, 'Facatativá', NULL, NULL),
(333, 73, 1, 'Falan', NULL, NULL),
(334, 17, 1, 'Filadelfia', NULL, NULL),
(335, 63, 1, 'Filandia', NULL, NULL),
(336, 15, 1, 'Firavitoba', NULL, NULL),
(337, 73, 1, 'Flandes', NULL, NULL),
(338, 18, 1, 'Florencia', NULL, NULL),
(339, 19, 1, 'Florencia', NULL, NULL),
(340, 15, 1, 'Floresta', NULL, NULL),
(341, 76, 1, 'Florida', NULL, NULL),
(342, 68, 1, 'Floridablanca', NULL, NULL),
(343, 68, 1, 'Florián', NULL, NULL),
(344, 44, 1, 'Fonseca', NULL, NULL),
(345, 81, 1, 'Fortúl', NULL, NULL),
(346, 25, 1, 'Fosca', NULL, NULL),
(347, 52, 1, 'Francisco Pizarro', NULL, NULL),
(348, 5, 1, 'Fredonia', NULL, NULL),
(349, 73, 1, 'Fresno', NULL, NULL),
(350, 5, 1, 'Frontino', NULL, NULL),
(351, 50, 1, 'Fuente de Oro', NULL, NULL),
(352, 47, 1, 'Fundación', NULL, NULL),
(353, 52, 1, 'Funes', NULL, NULL),
(354, 25, 1, 'Funza', NULL, NULL),
(355, 25, 1, 'Fusagasugá', NULL, NULL),
(356, 25, 1, 'Fómeque', NULL, NULL),
(357, 25, 1, 'Fúquene', NULL, NULL),
(358, 25, 1, 'Gachalá', NULL, NULL),
(359, 25, 1, 'Gachancipá', NULL, NULL),
(360, 15, 1, 'Gachantivá', NULL, NULL),
(361, 25, 1, 'Gachetá', NULL, NULL),
(362, 8, 1, 'Galapa', NULL, NULL),
(363, 70, 1, 'Galeras (Nueva Granada)', NULL, NULL),
(364, 68, 1, 'Galán', NULL, NULL),
(365, 25, 1, 'Gama', NULL, NULL),
(366, 20, 1, 'Gamarra', NULL, NULL),
(367, 15, 1, 'Garagoa', NULL, NULL),
(368, 41, 1, 'Garzón', NULL, NULL),
(369, 41, 1, 'Gigante', NULL, NULL),
(370, 76, 1, 'Ginebra', NULL, NULL),
(371, 5, 1, 'Giraldo', NULL, NULL),
(372, 25, 1, 'Girardot', NULL, NULL),
(373, 5, 1, 'Girardota', NULL, NULL),
(374, 68, 1, 'Girón', NULL, NULL),
(375, 20, 1, 'Gonzalez', NULL, NULL),
(376, 54, 1, 'Gramalote', NULL, NULL),
(377, 5, 1, 'Granada', NULL, NULL),
(378, 25, 1, 'Granada', NULL, NULL),
(379, 50, 1, 'Granada', NULL, NULL),
(380, 68, 1, 'Guaca', NULL, NULL),
(381, 15, 1, 'Guacamayas', NULL, NULL),
(382, 76, 1, 'Guacarí', NULL, NULL),
(383, 52, 1, 'Guachavés', NULL, NULL),
(384, 19, 1, 'Guachené', NULL, NULL),
(385, 25, 1, 'Guachetá', NULL, NULL),
(386, 52, 1, 'Guachucal', NULL, NULL),
(387, 5, 1, 'Guadalupe', NULL, NULL),
(388, 41, 1, 'Guadalupe', NULL, NULL),
(389, 68, 1, 'Guadalupe', NULL, NULL),
(390, 25, 1, 'Guaduas', NULL, NULL),
(391, 52, 1, 'Guaitarilla', NULL, NULL),
(392, 52, 1, 'Gualmatán', NULL, NULL),
(393, 47, 1, 'Guamal', NULL, NULL),
(394, 50, 1, 'Guamal', NULL, NULL),
(395, 73, 1, 'Guamo', NULL, NULL),
(396, 68, 1, 'Guapota', NULL, NULL),
(397, 19, 1, 'Guapí', NULL, NULL),
(398, 70, 1, 'Guaranda', NULL, NULL),
(399, 5, 1, 'Guarne', NULL, NULL),
(400, 25, 1, 'Guasca', NULL, NULL),
(401, 5, 1, 'Guatapé', NULL, NULL),
(402, 25, 1, 'Guataquí', NULL, NULL),
(403, 25, 1, 'Guatavita', NULL, NULL),
(404, 15, 1, 'Guateque', NULL, NULL),
(405, 68, 1, 'Guavatá', NULL, NULL),
(406, 25, 1, 'Guayabal de Siquima', NULL, NULL),
(407, 25, 1, 'Guayabetal', NULL, NULL),
(408, 15, 1, 'Guayatá', NULL, NULL),
(409, 68, 1, 'Guepsa', NULL, NULL),
(410, 15, 1, 'Guicán', NULL, NULL),
(411, 25, 1, 'Gutiérrez', NULL, NULL),
(412, 66, 1, 'Guática', NULL, NULL),
(413, 68, 1, 'Gámbita', NULL, NULL),
(414, 15, 1, 'Gámeza', NULL, NULL),
(415, 63, 1, 'Génova', NULL, NULL),
(416, 5, 1, 'Gómez Plata', NULL, NULL),
(417, 54, 1, 'Hacarí', NULL, NULL),
(418, 13, 1, 'Hatillo de Loba', NULL, NULL),
(419, 68, 1, 'Hato', NULL, NULL),
(420, 85, 1, 'Hato Corozal', NULL, NULL),
(421, 44, 1, 'Hatonuevo', NULL, NULL),
(422, 5, 1, 'Heliconia', NULL, NULL),
(423, 54, 1, 'Herrán', NULL, NULL),
(424, 73, 1, 'Herveo', NULL, NULL),
(425, 5, 1, 'Hispania', NULL, NULL),
(426, 41, 1, 'Hobo', NULL, NULL),
(427, 73, 1, 'Honda', NULL, NULL),
(428, 73, 1, 'Ibagué', NULL, NULL),
(429, 73, 1, 'Icononzo', NULL, NULL),
(430, 52, 1, 'Iles', NULL, NULL),
(431, 52, 1, 'Imúes', NULL, NULL),
(432, 19, 1, 'Inzá', NULL, NULL),
(433, 94, 1, 'Inírida', NULL, NULL),
(434, 52, 1, 'Ipiales', NULL, NULL),
(435, 41, 1, 'Isnos', NULL, NULL),
(436, 27, 1, 'Istmina', NULL, NULL),
(437, 5, 1, 'Itagüí', NULL, NULL),
(438, 5, 1, 'Ituango', NULL, NULL),
(439, 15, 1, 'Izá', NULL, NULL),
(440, 19, 1, 'Jambaló', NULL, NULL),
(441, 76, 1, 'Jamundí', NULL, NULL),
(442, 5, 1, 'Jardín', NULL, NULL),
(443, 15, 1, 'Jenesano', NULL, NULL),
(444, 5, 1, 'Jericó', NULL, NULL),
(445, 15, 1, 'Jericó', NULL, NULL),
(446, 25, 1, 'Jerusalén', NULL, NULL),
(447, 68, 1, 'Jesús María', NULL, NULL),
(448, 68, 1, 'Jordán', NULL, NULL),
(449, 8, 1, 'Juan de Acosta', NULL, NULL),
(450, 25, 1, 'Junín', NULL, NULL),
(451, 27, 1, 'Juradó', NULL, NULL),
(452, 23, 1, 'La Apartada y La Frontera', NULL, NULL),
(453, 41, 1, 'La Argentina', NULL, NULL),
(454, 68, 1, 'La Belleza', NULL, NULL),
(455, 25, 1, 'La Calera', NULL, NULL),
(456, 15, 1, 'La Capilla', NULL, NULL),
(457, 5, 1, 'La Ceja', NULL, NULL),
(458, 66, 1, 'La Celia', NULL, NULL),
(459, 52, 1, 'La Cruz', NULL, NULL),
(460, 76, 1, 'La Cumbre', NULL, NULL),
(461, 17, 1, 'La Dorada', NULL, NULL),
(462, 54, 1, 'La Esperanza', NULL, NULL),
(463, 5, 1, 'La Estrella', NULL, NULL),
(464, 52, 1, 'La Florida', NULL, NULL),
(465, 20, 1, 'La Gloria', NULL, NULL),
(466, 20, 1, 'La Jagua de Ibirico', NULL, NULL),
(467, 44, 1, 'La Jagua del Pilar', NULL, NULL),
(468, 52, 1, 'La Llanada', NULL, NULL),
(469, 50, 1, 'La Macarena', NULL, NULL),
(470, 17, 1, 'La Merced', NULL, NULL),
(471, 25, 1, 'La Mesa', NULL, NULL),
(472, 18, 1, 'La Montañita', NULL, NULL),
(473, 25, 1, 'La Palma', NULL, NULL),
(474, 68, 1, 'La Paz', NULL, NULL),
(475, 20, 1, 'La Paz (Robles)', NULL, NULL),
(476, 25, 1, 'La Peña', NULL, NULL),
(477, 5, 1, 'La Pintada', NULL, NULL),
(478, 41, 1, 'La Plata', NULL, NULL),
(479, 54, 1, 'La Playa', NULL, NULL),
(480, 99, 1, 'La Primavera', NULL, NULL),
(481, 85, 1, 'La Salina', NULL, NULL),
(482, 19, 1, 'La Sierra', NULL, NULL),
(483, 63, 1, 'La Tebaida', NULL, NULL),
(484, 52, 1, 'La Tola', NULL, NULL),
(485, 5, 1, 'La Unión', NULL, NULL),
(486, 52, 1, 'La Unión', NULL, NULL),
(487, 70, 1, 'La Unión', NULL, NULL),
(488, 76, 1, 'La Unión', NULL, NULL),
(489, 15, 1, 'La Uvita', NULL, NULL),
(490, 19, 1, 'La Vega', NULL, NULL),
(491, 25, 1, 'La Vega', NULL, NULL),
(492, 15, 1, 'La Victoria', NULL, NULL),
(493, 17, 1, 'La Victoria', NULL, NULL),
(494, 76, 1, 'La Victoria', NULL, NULL),
(495, 66, 1, 'La Virginia', NULL, NULL),
(496, 54, 1, 'Labateca', NULL, NULL),
(497, 15, 1, 'Labranzagrande', NULL, NULL),
(498, 68, 1, 'Landázuri', NULL, NULL),
(499, 68, 1, 'Lebrija', NULL, NULL),
(500, 52, 1, 'Leiva', NULL, NULL),
(501, 50, 1, 'Lejanías', NULL, NULL),
(502, 25, 1, 'Lenguazaque', NULL, NULL),
(503, 91, 1, 'Leticia', NULL, NULL),
(504, 5, 1, 'Liborina', NULL, NULL),
(505, 52, 1, 'Linares', NULL, NULL),
(506, 27, 1, 'Lloró', NULL, NULL),
(507, 23, 1, 'Lorica', NULL, NULL),
(508, 23, 1, 'Los Córdobas', NULL, NULL),
(509, 70, 1, 'Los Palmitos', NULL, NULL),
(510, 54, 1, 'Los Patios', NULL, NULL),
(511, 68, 1, 'Los Santos', NULL, NULL),
(512, 54, 1, 'Lourdes', NULL, NULL),
(513, 8, 1, 'Luruaco', NULL, NULL),
(514, 73, 1, 'Lérida', NULL, NULL),
(515, 73, 1, 'Líbano', NULL, NULL),
(516, 19, 1, 'López (Micay)', NULL, NULL),
(517, 15, 1, 'Macanal', NULL, NULL),
(518, 68, 1, 'Macaravita', NULL, NULL),
(519, 5, 1, 'Maceo', NULL, NULL),
(520, 25, 1, 'Machetá', NULL, NULL),
(521, 25, 1, 'Madrid', NULL, NULL),
(522, 13, 1, 'Magangué', NULL, NULL),
(523, 52, 1, 'Magüi (Payán)', NULL, NULL),
(524, 13, 1, 'Mahates', NULL, NULL),
(525, 44, 1, 'Maicao', NULL, NULL),
(526, 70, 1, 'Majagual', NULL, NULL),
(527, 8, 1, 'Malambo', NULL, NULL),
(528, 52, 1, 'Mallama (Piedrancha)', NULL, NULL),
(529, 8, 1, 'Manatí', NULL, NULL),
(530, 44, 1, 'Manaure', NULL, NULL),
(531, 20, 1, 'Manaure Balcón del Cesar', NULL, NULL),
(532, 17, 1, 'Manizales', NULL, NULL),
(533, 25, 1, 'Manta', NULL, NULL),
(534, 17, 1, 'Manzanares', NULL, NULL),
(535, 85, 1, 'Maní', NULL, NULL),
(536, 50, 1, 'Mapiripan', NULL, NULL),
(537, 13, 1, 'Margarita', NULL, NULL),
(538, 5, 1, 'Marinilla', NULL, NULL),
(539, 15, 1, 'Maripí', NULL, NULL),
(540, 73, 1, 'Mariquita', NULL, NULL),
(541, 17, 1, 'Marmato', NULL, NULL),
(542, 17, 1, 'Marquetalia', NULL, NULL),
(543, 66, 1, 'Marsella', NULL, NULL),
(544, 17, 1, 'Marulanda', NULL, NULL),
(545, 13, 1, 'María la Baja', NULL, NULL),
(546, 68, 1, 'Matanza', NULL, NULL),
(547, 5, 1, 'Medellín', NULL, NULL),
(548, 25, 1, 'Medina', NULL, NULL),
(549, 27, 1, 'Medio Atrato', NULL, NULL),
(550, 27, 1, 'Medio Baudó', NULL, NULL),
(551, 27, 1, 'Medio San Juan (ANDAGOYA)', NULL, NULL),
(552, 73, 1, 'Melgar', NULL, NULL),
(553, 19, 1, 'Mercaderes', NULL, NULL),
(554, 50, 1, 'Mesetas', NULL, NULL),
(555, 18, 1, 'Milán', NULL, NULL),
(556, 15, 1, 'Miraflores', NULL, NULL),
(557, 95, 1, 'Miraflores', NULL, NULL),
(558, 19, 1, 'Miranda', NULL, NULL),
(559, 66, 1, 'Mistrató', NULL, NULL),
(560, 97, 1, 'Mitú', NULL, NULL),
(561, 86, 1, 'Mocoa', NULL, NULL),
(562, 68, 1, 'Mogotes', NULL, NULL),
(563, 68, 1, 'Molagavita', NULL, NULL),
(564, 23, 1, 'Momil', NULL, NULL),
(565, 13, 1, 'Mompós', NULL, NULL),
(566, 15, 1, 'Mongua', NULL, NULL),
(567, 15, 1, 'Monguí', NULL, NULL),
(568, 15, 1, 'Moniquirá', NULL, NULL),
(569, 5, 1, 'Montebello', NULL, NULL),
(570, 13, 1, 'Montecristo', NULL, NULL),
(571, 23, 1, 'Montelíbano', NULL, NULL),
(572, 63, 1, 'Montenegro', NULL, NULL),
(573, 23, 1, 'Monteria', NULL, NULL),
(574, 85, 1, 'Monterrey', NULL, NULL),
(575, 13, 1, 'Morales', NULL, NULL),
(576, 19, 1, 'Morales', NULL, NULL),
(577, 18, 1, 'Morelia', NULL, NULL),
(578, 70, 1, 'Morroa', NULL, NULL),
(579, 25, 1, 'Mosquera', NULL, NULL),
(580, 52, 1, 'Mosquera', NULL, NULL),
(581, 15, 1, 'Motavita', NULL, NULL),
(582, 23, 1, 'Moñitos', NULL, NULL),
(583, 73, 1, 'Murillo', NULL, NULL),
(584, 5, 1, 'Murindó', NULL, NULL),
(585, 5, 1, 'Mutatá', NULL, NULL),
(586, 54, 1, 'Mutiscua', NULL, NULL),
(587, 15, 1, 'Muzo', NULL, NULL),
(588, 68, 1, 'Málaga', NULL, NULL),
(589, 5, 1, 'Nariño', NULL, NULL),
(590, 25, 1, 'Nariño', NULL, NULL),
(591, 52, 1, 'Nariño', NULL, NULL),
(592, 73, 1, 'Natagaima', NULL, NULL),
(593, 5, 1, 'Nechí', NULL, NULL),
(594, 5, 1, 'Necoclí', NULL, NULL),
(595, 17, 1, 'Neira', NULL, NULL),
(596, 41, 1, 'Neiva', NULL, NULL),
(597, 25, 1, 'Nemocón', NULL, NULL),
(598, 25, 1, 'Nilo', NULL, NULL),
(599, 25, 1, 'Nimaima', NULL, NULL),
(600, 15, 1, 'Nobsa', NULL, NULL),
(601, 25, 1, 'Nocaima', NULL, NULL),
(602, 17, 1, 'Norcasia', NULL, NULL),
(603, 13, 1, 'Norosí', NULL, NULL),
(604, 27, 1, 'Novita', NULL, NULL),
(605, 47, 1, 'Nueva Granada', NULL, NULL),
(606, 15, 1, 'Nuevo Colón', NULL, NULL),
(607, 85, 1, 'Nunchía', NULL, NULL),
(608, 27, 1, 'Nuquí', NULL, NULL),
(609, 41, 1, 'Nátaga', NULL, NULL),
(610, 76, 1, 'Obando', NULL, NULL),
(611, 68, 1, 'Ocamonte', NULL, NULL),
(612, 54, 1, 'Ocaña', NULL, NULL),
(613, 68, 1, 'Oiba', NULL, NULL),
(614, 15, 1, 'Oicatá', NULL, NULL),
(615, 5, 1, 'Olaya', NULL, NULL),
(616, 52, 1, 'Olaya Herrera', NULL, NULL),
(617, 68, 1, 'Onzaga', NULL, NULL),
(618, 41, 1, 'Oporapa', NULL, NULL),
(619, 86, 1, 'Orito', NULL, NULL),
(620, 85, 1, 'Orocué', NULL, NULL),
(621, 73, 1, 'Ortega', NULL, NULL),
(622, 52, 1, 'Ospina', NULL, NULL),
(623, 15, 1, 'Otanche', NULL, NULL),
(624, 70, 1, 'Ovejas', NULL, NULL),
(625, 15, 1, 'Pachavita', NULL, NULL),
(626, 25, 1, 'Pacho', NULL, NULL),
(627, 19, 1, 'Padilla', NULL, NULL),
(628, 41, 1, 'Paicol', NULL, NULL),
(629, 20, 1, 'Pailitas', NULL, NULL),
(630, 25, 1, 'Paime', NULL, NULL),
(631, 15, 1, 'Paipa', NULL, NULL),
(632, 15, 1, 'Pajarito', NULL, NULL),
(633, 41, 1, 'Palermo', NULL, NULL),
(634, 17, 1, 'Palestina', NULL, NULL),
(635, 41, 1, 'Palestina', NULL, NULL),
(636, 68, 1, 'Palmar', NULL, NULL),
(637, 8, 1, 'Palmar de Varela', NULL, NULL),
(638, 68, 1, 'Palmas del Socorro', NULL, NULL),
(639, 76, 1, 'Palmira', NULL, NULL),
(640, 70, 1, 'Palmito', NULL, NULL),
(641, 73, 1, 'Palocabildo', NULL, NULL),
(642, 54, 1, 'Pamplona', NULL, NULL),
(643, 54, 1, 'Pamplonita', NULL, NULL),
(644, 25, 1, 'Pandi', NULL, NULL),
(645, 15, 1, 'Panqueba', NULL, NULL),
(646, 25, 1, 'Paratebueno', NULL, NULL),
(647, 25, 1, 'Pasca', NULL, NULL),
(648, 19, 1, 'Patía (El Bordo)', NULL, NULL),
(649, 15, 1, 'Pauna', NULL, NULL),
(650, 15, 1, 'Paya', NULL, NULL),
(651, 85, 1, 'Paz de Ariporo', NULL, NULL),
(652, 15, 1, 'Paz de Río', NULL, NULL),
(653, 47, 1, 'Pedraza', NULL, NULL),
(654, 20, 1, 'Pelaya', NULL, NULL),
(655, 17, 1, 'Pensilvania', NULL, NULL),
(656, 5, 1, 'Peque', NULL, NULL),
(657, 66, 1, 'Pereira', NULL, NULL),
(658, 15, 1, 'Pesca', NULL, NULL),
(659, 5, 1, 'Peñol', NULL, NULL),
(660, 19, 1, 'Piamonte', NULL, NULL),
(661, 68, 1, 'Pie de Cuesta', NULL, NULL),
(662, 73, 1, 'Piedras', NULL, NULL),
(663, 19, 1, 'Piendamó', NULL, NULL),
(664, 63, 1, 'Pijao', NULL, NULL),
(665, 47, 1, 'Pijiño', NULL, NULL),
(666, 68, 1, 'Pinchote', NULL, NULL),
(667, 13, 1, 'Pinillos', NULL, NULL),
(668, 8, 1, 'Piojo', NULL, NULL),
(669, 15, 1, 'Pisva', NULL, NULL),
(670, 41, 1, 'Pital', NULL, NULL),
(671, 41, 1, 'Pitalito', NULL, NULL),
(672, 47, 1, 'Pivijay', NULL, NULL),
(673, 73, 1, 'Planadas', NULL, NULL),
(674, 23, 1, 'Planeta Rica', NULL, NULL),
(675, 47, 1, 'Plato', NULL, NULL),
(676, 52, 1, 'Policarpa', NULL, NULL),
(677, 8, 1, 'Polonuevo', NULL, NULL),
(678, 8, 1, 'Ponedera', NULL, NULL),
(679, 19, 1, 'Popayán', NULL, NULL),
(680, 85, 1, 'Pore', NULL, NULL),
(681, 52, 1, 'Potosí', NULL, NULL),
(682, 76, 1, 'Pradera', NULL, NULL),
(683, 73, 1, 'Prado', NULL, NULL),
(684, 52, 1, 'Providencia', NULL, NULL),
(685, 88, 1, 'Providencia', NULL, NULL),
(686, 20, 1, 'Pueblo Bello', NULL, NULL),
(687, 23, 1, 'Pueblo Nuevo', NULL, NULL),
(688, 66, 1, 'Pueblo Rico', NULL, NULL),
(689, 5, 1, 'Pueblorrico', NULL, NULL),
(690, 47, 1, 'Puebloviejo', NULL, NULL),
(691, 68, 1, 'Puente Nacional', NULL, NULL),
(692, 52, 1, 'Puerres', NULL, NULL),
(693, 86, 1, 'Puerto Asís', NULL, NULL),
(694, 5, 1, 'Puerto Berrío', NULL, NULL),
(695, 15, 1, 'Puerto Boyacá', NULL, NULL),
(696, 86, 1, 'Puerto Caicedo', NULL, NULL),
(697, 99, 1, 'Puerto Carreño', NULL, NULL),
(698, 8, 1, 'Puerto Colombia', NULL, NULL),
(699, 50, 1, 'Puerto Concordia', NULL, NULL),
(700, 23, 1, 'Puerto Escondido', NULL, NULL),
(701, 50, 1, 'Puerto Gaitán', NULL, NULL),
(702, 86, 1, 'Puerto Guzmán', NULL, NULL),
(703, 86, 1, 'Puerto Leguízamo', NULL, NULL),
(704, 23, 1, 'Puerto Libertador', NULL, NULL),
(705, 50, 1, 'Puerto Lleras', NULL, NULL),
(706, 50, 1, 'Puerto López', NULL, NULL),
(707, 5, 1, 'Puerto Nare', NULL, NULL),
(708, 91, 1, 'Puerto Nariño', NULL, NULL),
(709, 68, 1, 'Puerto Parra', NULL, NULL),
(710, 18, 1, 'Puerto Rico', NULL, NULL),
(711, 50, 1, 'Puerto Rico', NULL, NULL),
(712, 81, 1, 'Puerto Rondón', NULL, NULL),
(713, 25, 1, 'Puerto Salgar', NULL, NULL),
(714, 54, 1, 'Puerto Santander', NULL, NULL),
(715, 19, 1, 'Puerto Tejada', NULL, NULL),
(716, 5, 1, 'Puerto Triunfo', NULL, NULL),
(717, 68, 1, 'Puerto Wilches', NULL, NULL),
(718, 25, 1, 'Pulí', NULL, NULL),
(719, 52, 1, 'Pupiales', NULL, NULL),
(720, 19, 1, 'Puracé (Coconuco)', NULL, NULL),
(721, 73, 1, 'Purificación', NULL, NULL),
(722, 23, 1, 'Purísima', NULL, NULL),
(723, 17, 1, 'Pácora', NULL, NULL),
(724, 15, 1, 'Páez', NULL, NULL),
(725, 19, 1, 'Páez (Belalcazar)', NULL, NULL),
(726, 68, 1, 'Páramo', NULL, NULL),
(727, 25, 1, 'Quebradanegra', NULL, NULL),
(728, 25, 1, 'Quetame', NULL, NULL),
(729, 27, 1, 'Quibdó', NULL, NULL),
(730, 63, 1, 'Quimbaya', NULL, NULL),
(731, 66, 1, 'Quinchía', NULL, NULL),
(732, 15, 1, 'Quipama', NULL, NULL),
(733, 25, 1, 'Quipile', NULL, NULL),
(734, 54, 1, 'Ragonvalia', NULL, NULL),
(735, 15, 1, 'Ramiriquí', NULL, NULL),
(736, 85, 1, 'Recetor', NULL, NULL),
(737, 13, 1, 'Regidor', NULL, NULL),
(738, 5, 1, 'Remedios', NULL, NULL),
(739, 47, 1, 'Remolino', NULL, NULL),
(740, 8, 1, 'Repelón', NULL, NULL),
(741, 50, 1, 'Restrepo', NULL, NULL),
(742, 76, 1, 'Restrepo', NULL, NULL),
(743, 5, 1, 'Retiro', NULL, NULL),
(744, 25, 1, 'Ricaurte', NULL, NULL),
(745, 52, 1, 'Ricaurte', NULL, NULL),
(746, 68, 1, 'Rio Negro', NULL, NULL),
(747, 73, 1, 'Rioblanco', NULL, NULL),
(748, 76, 1, 'Riofrío', NULL, NULL),
(749, 44, 1, 'Riohacha', NULL, NULL),
(750, 17, 1, 'Risaralda', NULL, NULL),
(751, 41, 1, 'Rivera', NULL, NULL),
(752, 52, 1, 'Roberto Payán (San José)', NULL, NULL),
(753, 76, 1, 'Roldanillo', NULL, NULL),
(754, 73, 1, 'Roncesvalles', NULL, NULL),
(755, 15, 1, 'Rondón', NULL, NULL),
(756, 19, 1, 'Rosas', NULL, NULL),
(757, 73, 1, 'Rovira', NULL, NULL),
(758, 15, 1, 'Ráquira', NULL, NULL),
(759, 27, 1, 'Río Iró', NULL, NULL),
(760, 27, 1, 'Río Quito', NULL, NULL),
(761, 17, 1, 'Río Sucio', NULL, NULL),
(762, 13, 1, 'Río Viejo', NULL, NULL),
(763, 20, 1, 'Río de oro', NULL, NULL),
(764, 5, 1, 'Ríonegro', NULL, NULL),
(765, 27, 1, 'Ríosucio', NULL, NULL),
(766, 68, 1, 'Sabana de Torres', NULL, NULL),
(767, 8, 1, 'Sabanagrande', NULL, NULL),
(768, 5, 1, 'Sabanalarga', NULL, NULL),
(769, 8, 1, 'Sabanalarga', NULL, NULL),
(770, 85, 1, 'Sabanalarga', NULL, NULL),
(771, 47, 1, 'Sabanas de San Angel (SAN ANGEL)', NULL, NULL),
(772, 5, 1, 'Sabaneta', NULL, NULL),
(773, 15, 1, 'Saboyá', NULL, NULL),
(774, 23, 1, 'Sahagún', NULL, NULL),
(775, 41, 1, 'Saladoblanco', NULL, NULL),
(776, 17, 1, 'Salamina', NULL, NULL),
(777, 47, 1, 'Salamina', NULL, NULL),
(778, 54, 1, 'Salazar', NULL, NULL),
(779, 73, 1, 'Saldaña', NULL, NULL),
(780, 63, 1, 'Salento', NULL, NULL),
(781, 5, 1, 'Salgar', NULL, NULL),
(782, 15, 1, 'Samacá', NULL, NULL),
(783, 52, 1, 'Samaniego', NULL, NULL),
(784, 17, 1, 'Samaná', NULL, NULL),
(785, 70, 1, 'Sampués', NULL, NULL),
(786, 41, 1, 'San Agustín', NULL, NULL),
(787, 20, 1, 'San Alberto', NULL, NULL),
(788, 68, 1, 'San Andrés', NULL, NULL),
(789, 23, 1, 'San Andrés Sotavento', NULL, NULL),
(790, 5, 1, 'San Andrés de Cuerquía', NULL, NULL),
(791, 23, 1, 'San Antero', NULL, NULL),
(792, 73, 1, 'San Antonio', NULL, NULL),
(793, 25, 1, 'San Antonio de Tequendama', NULL, NULL),
(794, 68, 1, 'San Benito', NULL, NULL),
(795, 70, 1, 'San Benito Abad', NULL, NULL),
(796, 25, 1, 'San Bernardo', NULL, NULL),
(797, 52, 1, 'San Bernardo', NULL, NULL),
(798, 23, 1, 'San Bernardo del Viento', NULL, NULL),
(799, 54, 1, 'San Calixto', NULL, NULL),
(800, 5, 1, 'San Carlos', NULL, NULL),
(801, 23, 1, 'San Carlos', NULL, NULL),
(802, 50, 1, 'San Carlos de Guaroa', NULL, NULL),
(803, 25, 1, 'San Cayetano', NULL, NULL),
(804, 54, 1, 'San Cayetano', NULL, NULL),
(805, 13, 1, 'San Cristobal', NULL, NULL),
(806, 20, 1, 'San Diego', NULL, NULL),
(807, 15, 1, 'San Eduardo', NULL, NULL),
(808, 13, 1, 'San Estanislao', NULL, NULL),
(809, 13, 1, 'San Fernando', NULL, NULL),
(810, 5, 1, 'San Francisco', NULL, NULL),
(811, 25, 1, 'San Francisco', NULL, NULL),
(812, 86, 1, 'San Francisco', NULL, NULL),
(813, 68, 1, 'San Gíl', NULL, NULL),
(814, 13, 1, 'San Jacinto', NULL, NULL),
(815, 13, 1, 'San Jacinto del Cauca', NULL, NULL),
(816, 5, 1, 'San Jerónimo', NULL, NULL),
(817, 68, 1, 'San Joaquín', NULL, NULL),
(818, 17, 1, 'San José', NULL, NULL),
(819, 68, 1, 'San José de Miranda', NULL, NULL),
(820, 5, 1, 'San José de Montaña', NULL, NULL),
(821, 15, 1, 'San José de Pare', NULL, NULL),
(822, 23, 1, 'San José de Uré', NULL, NULL),
(823, 18, 1, 'San José del Fragua', NULL, NULL),
(824, 95, 1, 'San José del Guaviare', NULL, NULL),
(825, 27, 1, 'San José del Palmar', NULL, NULL),
(826, 50, 1, 'San Juan de Arama', NULL, NULL),
(827, 70, 1, 'San Juan de Betulia', NULL, NULL),
(828, 13, 1, 'San Juan de Nepomuceno', NULL, NULL),
(829, 52, 1, 'San Juan de Pasto', NULL, NULL),
(830, 25, 1, 'San Juan de Río Seco', NULL, NULL),
(831, 5, 1, 'San Juan de Urabá', NULL, NULL),
(832, 44, 1, 'San Juan del Cesar', NULL, NULL),
(833, 50, 1, 'San Juanito', NULL, NULL),
(834, 52, 1, 'San Lorenzo', NULL, NULL),
(835, 73, 1, 'San Luis', NULL, NULL),
(836, 5, 1, 'San Luís', NULL, NULL),
(837, 15, 1, 'San Luís de Gaceno', NULL, NULL),
(838, 85, 1, 'San Luís de Palenque', NULL, NULL),
(839, 70, 1, 'San Marcos', NULL, NULL),
(840, 20, 1, 'San Martín', NULL, NULL),
(841, 50, 1, 'San Martín', NULL, NULL),
(842, 13, 1, 'San Martín de Loba', NULL, NULL),
(843, 15, 1, 'San Mateo', NULL, NULL),
(844, 68, 1, 'San Miguel', NULL, NULL),
(845, 86, 1, 'San Miguel', NULL, NULL),
(846, 15, 1, 'San Miguel de Sema', NULL, NULL),
(847, 70, 1, 'San Onofre', NULL, NULL),
(848, 13, 1, 'San Pablo', NULL, NULL),
(849, 52, 1, 'San Pablo', NULL, NULL),
(850, 15, 1, 'San Pablo de Borbur', NULL, NULL),
(851, 5, 1, 'San Pedro', NULL, NULL),
(852, 70, 1, 'San Pedro', NULL, NULL),
(853, 76, 1, 'San Pedro', NULL, NULL),
(854, 52, 1, 'San Pedro de Cartago', NULL, NULL),
(855, 5, 1, 'San Pedro de Urabá', NULL, NULL),
(856, 23, 1, 'San Pelayo', NULL, NULL),
(857, 5, 1, 'San Rafael', NULL, NULL),
(858, 5, 1, 'San Roque', NULL, NULL),
(859, 19, 1, 'San Sebastián', NULL, NULL),
(860, 47, 1, 'San Sebastián de Buenavista', NULL, NULL),
(861, 5, 1, 'San Vicente', NULL, NULL),
(862, 18, 1, 'San Vicente del Caguán', NULL, NULL),
(863, 68, 1, 'San Vicente del Chucurí', NULL, NULL),
(864, 47, 1, 'San Zenón', NULL, NULL),
(865, 52, 1, 'Sandoná', NULL, NULL),
(866, 47, 1, 'Santa Ana', NULL, NULL),
(867, 5, 1, 'Santa Bárbara', NULL, NULL),
(868, 68, 1, 'Santa Bárbara', NULL, NULL),
(869, 52, 1, 'Santa Bárbara (Iscuandé)', NULL, NULL),
(870, 47, 1, 'Santa Bárbara de Pinto', NULL, NULL),
(871, 13, 1, 'Santa Catalina', NULL, NULL),
(872, 5, 1, 'Santa Fé de Antioquia', NULL, NULL),
(873, 27, 1, 'Santa Genoveva de Docorodó', NULL, NULL),
(874, 68, 1, 'Santa Helena del Opón', NULL, NULL),
(875, 73, 1, 'Santa Isabel', NULL, NULL),
(876, 8, 1, 'Santa Lucía', NULL, NULL),
(877, 47, 1, 'Santa Marta', NULL, NULL),
(878, 15, 1, 'Santa María', NULL, NULL),
(879, 41, 1, 'Santa María', NULL, NULL),
(880, 13, 1, 'Santa Rosa', NULL, NULL),
(881, 19, 1, 'Santa Rosa', NULL, NULL),
(882, 66, 1, 'Santa Rosa de Cabal', NULL, NULL),
(883, 5, 1, 'Santa Rosa de Osos', NULL, NULL),
(884, 15, 1, 'Santa Rosa de Viterbo', NULL, NULL),
(885, 13, 1, 'Santa Rosa del Sur', NULL, NULL),
(886, 99, 1, 'Santa Rosalía', NULL, NULL),
(887, 15, 1, 'Santa Sofía', NULL, NULL),
(888, 15, 1, 'Santana', NULL, NULL),
(889, 19, 1, 'Santander de Quilichao', NULL, NULL),
(890, 54, 1, 'Santiago', NULL, NULL),
(891, 86, 1, 'Santiago', NULL, NULL),
(892, 5, 1, 'Santo Domingo', NULL, NULL),
(893, 8, 1, 'Santo Tomás', NULL, NULL),
(894, 5, 1, 'Santuario', NULL, NULL),
(895, 66, 1, 'Santuario', NULL, NULL),
(896, 52, 1, 'Sapuyes', NULL, NULL),
(897, 81, 1, 'Saravena', NULL, NULL),
(898, 54, 1, 'Sardinata', NULL, NULL),
(899, 25, 1, 'Sasaima', NULL, NULL),
(900, 15, 1, 'Sativanorte', NULL, NULL),
(901, 15, 1, 'Sativasur', NULL, NULL),
(902, 5, 1, 'Segovia', NULL, NULL),
(903, 25, 1, 'Sesquilé', NULL, NULL),
(904, 76, 1, 'Sevilla', NULL, NULL),
(905, 15, 1, 'Siachoque', NULL, NULL),
(906, 25, 1, 'Sibaté', NULL, NULL),
(907, 86, 1, 'Sibundoy', NULL, NULL),
(908, 54, 1, 'Silos', NULL, NULL),
(909, 25, 1, 'Silvania', NULL, NULL),
(910, 19, 1, 'Silvia', NULL, NULL),
(911, 68, 1, 'Simacota', NULL, NULL),
(912, 25, 1, 'Simijaca', NULL, NULL),
(913, 13, 1, 'Simití', NULL, NULL),
(914, 70, 1, 'Sincelejo', NULL, NULL),
(915, 70, 1, 'Sincé', NULL, NULL),
(916, 27, 1, 'Sipí', NULL, NULL),
(917, 47, 1, 'Sitionuevo', NULL, NULL),
(918, 25, 1, 'Soacha', NULL, NULL),
(919, 15, 1, 'Soatá', NULL, NULL),
(920, 15, 1, 'Socha', NULL, NULL),
(921, 68, 1, 'Socorro', NULL, NULL),
(922, 15, 1, 'Socotá', NULL, NULL),
(923, 15, 1, 'Sogamoso', NULL, NULL),
(924, 18, 1, 'Solano', NULL, NULL),
(925, 8, 1, 'Soledad', NULL, NULL),
(926, 18, 1, 'Solita', NULL, NULL),
(927, 15, 1, 'Somondoco', NULL, NULL),
(928, 5, 1, 'Sonsón', NULL, NULL),
(929, 5, 1, 'Sopetrán', NULL, NULL),
(930, 13, 1, 'Soplaviento', NULL, NULL),
(931, 25, 1, 'Sopó', NULL, NULL),
(932, 15, 1, 'Sora', NULL, NULL),
(933, 15, 1, 'Soracá', NULL, NULL),
(934, 15, 1, 'Sotaquirá', NULL, NULL),
(935, 19, 1, 'Sotara (Paispamba)', NULL, NULL),
(936, 52, 1, 'Sotomayor (Los Andes)', NULL, NULL),
(937, 68, 1, 'Suaita', NULL, NULL),
(938, 8, 1, 'Suan', NULL, NULL),
(939, 41, 1, 'Suaza', NULL, NULL),
(940, 25, 1, 'Subachoque', NULL, NULL),
(941, 19, 1, 'Sucre', NULL, NULL),
(942, 68, 1, 'Sucre', NULL, NULL),
(943, 70, 1, 'Sucre', NULL, NULL),
(944, 25, 1, 'Suesca', NULL, NULL),
(945, 25, 1, 'Supatá', NULL, NULL),
(946, 17, 1, 'Supía', NULL, NULL),
(947, 68, 1, 'Suratá', NULL, NULL),
(948, 25, 1, 'Susa', NULL, NULL),
(949, 15, 1, 'Susacón', NULL, NULL),
(950, 15, 1, 'Sutamarchán', NULL, NULL),
(951, 25, 1, 'Sutatausa', NULL, NULL),
(952, 15, 1, 'Sutatenza', NULL, NULL),
(953, 19, 1, 'Suárez', NULL, NULL),
(954, 73, 1, 'Suárez', NULL, NULL),
(955, 85, 1, 'Sácama', NULL, NULL),
(956, 15, 1, 'Sáchica', NULL, NULL),
(957, 25, 1, 'Tabio', NULL, NULL),
(958, 27, 1, 'Tadó', NULL, NULL),
(959, 13, 1, 'Talaigua Nuevo', NULL, NULL),
(960, 20, 1, 'Tamalameque', NULL, NULL),
(961, 81, 1, 'Tame', NULL, NULL),
(962, 52, 1, 'Taminango', NULL, NULL),
(963, 52, 1, 'Tangua', NULL, NULL),
(964, 97, 1, 'Taraira', NULL, NULL),
(965, 5, 1, 'Tarazá', NULL, NULL),
(966, 41, 1, 'Tarqui', NULL, NULL),
(967, 5, 1, 'Tarso', NULL, NULL),
(968, 15, 1, 'Tasco', NULL, NULL),
(969, 85, 1, 'Tauramena', NULL, NULL),
(970, 25, 1, 'Tausa', NULL, NULL),
(971, 41, 1, 'Tello', NULL, NULL),
(972, 25, 1, 'Tena', NULL, NULL),
(973, 47, 1, 'Tenerife', NULL, NULL),
(974, 25, 1, 'Tenjo', NULL, NULL),
(975, 15, 1, 'Tenza', NULL, NULL),
(976, 54, 1, 'Teorama', NULL, NULL),
(977, 41, 1, 'Teruel', NULL, NULL),
(978, 41, 1, 'Tesalia', NULL, NULL),
(979, 25, 1, 'Tibacuy', NULL, NULL),
(980, 15, 1, 'Tibaná', NULL, NULL),
(981, 15, 1, 'Tibasosa', NULL, NULL),
(982, 25, 1, 'Tibirita', NULL, NULL),
(983, 54, 1, 'Tibú', NULL, NULL),
(984, 23, 1, 'Tierralta', NULL, NULL),
(985, 41, 1, 'Timaná', NULL, NULL),
(986, 19, 1, 'Timbiquí', NULL, NULL),
(987, 19, 1, 'Timbío', NULL, NULL),
(988, 15, 1, 'Tinjacá', NULL, NULL),
(989, 15, 1, 'Tipacoque', NULL, NULL),
(990, 13, 1, 'Tiquisio (Puerto Rico)', NULL, NULL),
(991, 5, 1, 'Titiribí', NULL, NULL),
(992, 15, 1, 'Toca', NULL, NULL),
(993, 25, 1, 'Tocaima', NULL, NULL),
(994, 25, 1, 'Tocancipá', NULL, NULL),
(995, 15, 1, 'Toguí', NULL, NULL),
(996, 5, 1, 'Toledo', NULL, NULL),
(997, 54, 1, 'Toledo', NULL, NULL),
(998, 70, 1, 'Tolú', NULL, NULL),
(999, 70, 1, 'Tolú Viejo', NULL, NULL),
(1000, 68, 1, 'Tona', NULL, NULL),
(1001, 15, 1, 'Topagá', NULL, NULL),
(1002, 25, 1, 'Topaipí', NULL, NULL),
(1003, 19, 1, 'Toribío', NULL, NULL),
(1004, 76, 1, 'Toro', NULL, NULL),
(1005, 15, 1, 'Tota', NULL, NULL),
(1006, 19, 1, 'Totoró', NULL, NULL),
(1007, 85, 1, 'Trinidad', NULL, NULL),
(1008, 76, 1, 'Trujillo', NULL, NULL),
(1009, 8, 1, 'Tubará', NULL, NULL),
(1010, 23, 1, 'Tuchín', NULL, NULL),
(1011, 76, 1, 'Tulúa', NULL, NULL),
(1012, 52, 1, 'Tumaco', NULL, NULL),
(1013, 15, 1, 'Tunja', NULL, NULL),
(1014, 15, 1, 'Tunungua', NULL, NULL),
(1015, 13, 1, 'Turbaco', NULL, NULL),
(1016, 13, 1, 'Turbaná', NULL, NULL),
(1017, 5, 1, 'Turbo', NULL, NULL),
(1018, 15, 1, 'Turmequé', NULL, NULL),
(1019, 15, 1, 'Tuta', NULL, NULL),
(1020, 15, 1, 'Tutasá', NULL, NULL),
(1021, 85, 1, 'Támara', NULL, NULL),
(1022, 5, 1, 'Támesis', NULL, NULL),
(1023, 52, 1, 'Túquerres', NULL, NULL),
(1024, 25, 1, 'Ubalá', NULL, NULL),
(1025, 25, 1, 'Ubaque', NULL, NULL),
(1026, 25, 1, 'Ubaté', NULL, NULL),
(1027, 76, 1, 'Ulloa', NULL, NULL),
(1028, 25, 1, 'Une', NULL, NULL),
(1029, 27, 1, 'Unguía', NULL, NULL),
(1030, 27, 1, 'Unión Panamericana (ÁNIMAS)', NULL, NULL),
(1031, 5, 1, 'Uramita', NULL, NULL),
(1032, 50, 1, 'Uribe', NULL, NULL),
(1033, 44, 1, 'Uribia', NULL, NULL),
(1034, 5, 1, 'Urrao', NULL, NULL),
(1035, 44, 1, 'Urumita', NULL, NULL),
(1036, 8, 1, 'Usiacuri', NULL, NULL),
(1037, 5, 1, 'Valdivia', NULL, NULL),
(1038, 23, 1, 'Valencia', NULL, NULL),
(1039, 68, 1, 'Valle de San José', NULL, NULL),
(1040, 73, 1, 'Valle de San Juan', NULL, NULL),
(1041, 86, 1, 'Valle del Guamuez', NULL, NULL),
(1042, 20, 1, 'Valledupar', NULL, NULL),
(1043, 5, 1, 'Valparaiso', NULL, NULL),
(1044, 18, 1, 'Valparaiso', NULL, NULL),
(1045, 5, 1, 'Vegachí', NULL, NULL),
(1046, 73, 1, 'Venadillo', NULL, NULL),
(1047, 5, 1, 'Venecia', NULL, NULL),
(1048, 25, 1, 'Venecia (Ospina Pérez)', NULL, NULL),
(1049, 15, 1, 'Ventaquemada', NULL, NULL),
(1050, 25, 1, 'Vergara', NULL, NULL),
(1051, 76, 1, 'Versalles', NULL, NULL),
(1052, 68, 1, 'Vetas', NULL, NULL),
(1053, 25, 1, 'Viani', NULL, NULL),
(1054, 5, 1, 'Vigía del Fuerte', NULL, NULL),
(1055, 76, 1, 'Vijes', NULL, NULL),
(1056, 54, 1, 'Villa Caro', NULL, NULL),
(1057, 19, 1, 'Villa Rica', NULL, NULL),
(1058, 15, 1, 'Villa de Leiva', NULL, NULL),
(1059, 54, 1, 'Villa del Rosario', NULL, NULL),
(1060, 86, 1, 'Villagarzón', NULL, NULL),
(1061, 25, 1, 'Villagómez', NULL, NULL),
(1062, 73, 1, 'Villahermosa', NULL, NULL),
(1063, 17, 1, 'Villamaría', NULL, NULL),
(1064, 13, 1, 'Villanueva', NULL, NULL),
(1065, 44, 1, 'Villanueva', NULL, NULL),
(1066, 68, 1, 'Villanueva', NULL, NULL),
(1067, 85, 1, 'Villanueva', NULL, NULL),
(1068, 25, 1, 'Villapinzón', NULL, NULL),
(1069, 73, 1, 'Villarrica', NULL, NULL),
(1070, 50, 1, 'Villavicencio', NULL, NULL),
(1071, 41, 1, 'Villavieja', NULL, NULL),
(1072, 25, 1, 'Villeta', NULL, NULL),
(1073, 25, 1, 'Viotá', NULL, NULL),
(1074, 15, 1, 'Viracachá', NULL, NULL),
(1075, 50, 1, 'Vista Hermosa', NULL, NULL),
(1076, 17, 1, 'Viterbo', NULL, NULL),
(1077, 68, 1, 'Vélez', NULL, NULL),
(1078, 25, 1, 'Yacopí', NULL, NULL),
(1079, 52, 1, 'Yacuanquer', NULL, NULL),
(1080, 41, 1, 'Yaguará', NULL, NULL),
(1081, 5, 1, 'Yalí', NULL, NULL),
(1082, 5, 1, 'Yarumal', NULL, NULL),
(1083, 5, 1, 'Yolombó', NULL, NULL),
(1084, 5, 1, 'Yondó (Casabe)', NULL, NULL),
(1085, 85, 1, 'Yopal', NULL, NULL),
(1086, 76, 1, 'Yotoco', NULL, NULL),
(1087, 76, 1, 'Yumbo', NULL, NULL),
(1088, 13, 1, 'Zambrano', NULL, NULL),
(1089, 68, 1, 'Zapatoca', NULL, NULL),
(1090, 47, 1, 'Zapayán (PUNTA DE PIEDRAS)', NULL, NULL),
(1091, 5, 1, 'Zaragoza', NULL, NULL),
(1092, 76, 1, 'Zarzal', NULL, NULL),
(1093, 15, 1, 'Zetaquirá', NULL, NULL),
(1094, 25, 1, 'Zipacón', NULL, NULL),
(1095, 25, 1, 'Zipaquirá', NULL, NULL),
(1096, 47, 1, 'Zona Bananera (PRADO - SEVILLA)', NULL, NULL),
(1097, 54, 1, 'Ábrego', NULL, NULL),
(1098, 41, 1, 'Íquira', NULL, NULL),
(1099, 15, 1, 'Úmbita', NULL, NULL),
(1100, 25, 1, 'Útica', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combos`
--

CREATE TABLE `combos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_negocio` int(10) UNSIGNED DEFAULT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` int(11) DEFAULT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_estado` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `combos`
--

INSERT INTO `combos` (`id`, `id_negocio`, `foto`, `nombre`, `valor`, `descripcion`, `id_estado`, `created_at`, `updated_at`) VALUES
(1, 1, '1585749645.jpeg', 'ancheta de lacteos', 18000, 'leche alqueria x 1 und yogurth griego x 1 und galletas ducales x 1  und queso mozarella alpina x 1 und', 1, '2020-04-02 00:00:46', '2020-04-02 00:00:46'),
(2, 1, '1585752728.jpeg', 'ancheta', 10000, 'fdbdfhdfhgddbb', 1, '2020-04-02 00:52:08', '2020-04-02 00:52:08'),
(3, 2, 'combo.png', 'combo perro', 13000, 'peero caliente sencillo\npapas sencillas\nmalteada sencilla', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracions`
--

CREATE TABLE `configuracions` (
  `id` int(10) UNSIGNED NOT NULL,
  `nit` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_admin` int(10) UNSIGNED DEFAULT NULL,
  `comision_lente` int(11) DEFAULT NULL,
  `comision_montura` int(11) DEFAULT NULL,
  `iva` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(5, 'ANTIOQUIA', NULL, NULL),
(8, 'ATLÁNTICO', NULL, NULL),
(11, 'BOGOTÁ, D.C.', NULL, NULL),
(13, 'BOLÍVAR', NULL, NULL),
(15, 'BOYACÁ', NULL, NULL),
(17, 'CALDAS', NULL, NULL),
(18, 'CAQUETÁ', NULL, NULL),
(19, 'CAUCA', NULL, NULL),
(20, 'CESAR', NULL, NULL),
(23, 'CÓRDOBA', NULL, NULL),
(25, 'CUNDINAMARCA', NULL, NULL),
(27, 'CHOCÓ', NULL, NULL),
(41, 'HUILA', NULL, NULL),
(44, 'LA GUAJIRA', NULL, NULL),
(47, 'MAGDALENA', NULL, NULL),
(50, 'META', NULL, NULL),
(52, 'NARIÑO', NULL, NULL),
(54, 'NORTE DE SANTANDER', NULL, NULL),
(63, 'QUINDIO', NULL, NULL),
(66, 'RISARALDA', NULL, NULL),
(68, 'SANTANDER', NULL, NULL),
(70, 'SUCRE', NULL, NULL),
(73, 'TOLIMA', NULL, NULL),
(76, 'VALLE DEL CAUCA', NULL, NULL),
(81, 'ARAUCA', NULL, NULL),
(85, 'CASANARE', NULL, NULL),
(86, 'PUTUMAYO', NULL, NULL),
(88, 'ARCHIPIÉLAGO DE SAN ANDRÉS, PROVIDENCIA Y SANTA CATALINA', NULL, NULL),
(91, 'AMAZONAS', NULL, NULL),
(94, 'GUAINÍA', NULL, NULL),
(95, 'GUAVIARE', NULL, NULL),
(97, 'VAUPÉS', NULL, NULL),
(99, 'VICHADA', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_combos`
--

CREATE TABLE `detalle_combos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_combo` int(10) UNSIGNED DEFAULT NULL,
  `id_producto` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_combos`
--

INSERT INTO `detalle_combos` (`id`, `id_combo`, `id_producto`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 4, NULL, NULL),
(4, 2, 3, NULL, NULL),
(5, 2, 1, NULL, NULL),
(6, 2, 2, NULL, NULL),
(7, 1, 1, NULL, NULL),
(11, 3, 7, NULL, NULL),
(12, 3, 5, NULL, NULL),
(13, 3, 6, NULL, NULL),
(14, 1, 4, NULL, NULL),
(15, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pedido` int(10) UNSIGNED DEFAULT NULL,
  `id_producto` int(10) UNSIGNED DEFAULT NULL,
  `id_combo` int(10) UNSIGNED DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_pedidos`
--

INSERT INTO `detalle_pedidos` (`id`, `id_pedido`, `id_producto`, `id_combo`, `cantidad`, `created_at`, `updated_at`) VALUES
(14, 9, 6, NULL, 2, NULL, NULL),
(15, 9, 5, NULL, 2, NULL, NULL),
(16, 9, NULL, 3, NULL, NULL, NULL),
(17, 10, 1, NULL, 1, NULL, NULL),
(18, 10, 3, NULL, 1, NULL, NULL),
(19, 10, 4, NULL, 1, NULL, NULL),
(20, 11, 7, NULL, 1, NULL, NULL),
(21, 11, 6, NULL, 1, NULL, NULL),
(22, 12, 5, NULL, 2, NULL, NULL),
(23, 13, 1, NULL, 1, NULL, NULL),
(24, 13, 2, NULL, 1, NULL, NULL),
(25, 13, 3, NULL, 1, NULL, NULL),
(26, 14, 5, NULL, 1, NULL, NULL),
(27, 14, 6, NULL, 4, NULL, NULL),
(28, 14, 7, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Activo', 'Activo', NULL, NULL),
(2, 'Inactivo', 'Inactivo', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pedidos`
--

CREATE TABLE `estado_pedidos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estado_pedidos`
--

INSERT INTO `estado_pedidos` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'solicitado', NULL, NULL, NULL),
(2, 'aceptado', NULL, NULL, NULL),
(3, 'despachado', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_12_23_154242_create_tipo_documentos_table', 1),
(4, '2019_12_23_154243_create_departamentos_table', 1),
(5, '2019_12_23_154243_create_roles_table', 1),
(6, '2019_12_23_154244_create_ciudads_table', 1),
(7, '2019_12_23_154245_create_barrios_table', 1),
(8, '2019_12_23_154304_create_estados_table', 1),
(9, '2019_12_23_154528_create_usuarios_table', 1),
(10, '2020_02_07_142818_create_configuracions_table', 1),
(11, '2020_03_12_224007_create_categoria__productos_table', 1),
(12, '2020_03_12_224008_create_categoria_negocios_table', 1),
(13, '2020_03_24_233234_create_negocios_table', 1),
(14, '2020_03_24_233235_create_productos_table', 1),
(15, '2020_03_24_233700_create_estado_pedidos_table', 1),
(16, '2020_03_24_233750_create_pedidos_table', 1),
(17, '2020_03_24_233820_create_detalle_pedidos_table', 1),
(18, '2020_03_24_233950_create_combos_table', 1),
(19, '2020_03_24_233952_create_detalle_combos_table', 1),
(39, '2014_10_12_000000_create_users_table', 1),
(40, '2014_10_12_100000_create_password_resets_table', 1),
(41, '2019_12_23_154242_create_tipo_documentos_table', 1),
(42, '2019_12_23_154243_create_departamentos_table', 1),
(43, '2019_12_23_154243_create_roles_table', 1),
(44, '2019_12_23_154244_create_ciudads_table', 1),
(45, '2019_12_23_154245_create_barrios_table', 1),
(46, '2019_12_23_154304_create_estados_table', 1),
(47, '2019_12_23_154528_create_usuarios_table', 1),
(48, '2020_02_07_142818_create_configuracions_table', 1),
(49, '2020_03_12_224007_create_categoria__productos_table', 1),
(50, '2020_03_12_224008_create_categoria_negocios_table', 1),
(51, '2020_03_24_233234_create_negocios_table', 1),
(52, '2020_03_24_233235_create_productos_table', 1),
(53, '2020_03_24_233700_create_estado_pedidos_table', 1),
(54, '2020_03_24_233750_create_pedidos_table', 1),
(55, '2020_03_24_233820_create_detalle_pedidos_table', 1),
(56, '2020_03_24_233950_create_combos_table', 1),
(57, '2020_03_24_233952_create_detalle_combos_table', 1),
(58, '2014_10_12_000000_create_users_table', 1),
(59, '2014_10_12_100000_create_password_resets_table', 1),
(60, '2019_12_23_154242_create_tipo_documentos_table', 1),
(61, '2019_12_23_154243_create_departamentos_table', 1),
(62, '2019_12_23_154243_create_roles_table', 1),
(63, '2019_12_23_154244_create_ciudads_table', 1),
(64, '2019_12_23_154245_create_barrios_table', 1),
(65, '2019_12_23_154304_create_estados_table', 1),
(66, '2019_12_23_154528_create_usuarios_table', 1),
(67, '2020_02_07_142818_create_configuracions_table', 1),
(68, '2020_03_12_224007_create_categoria__productos_table', 1),
(69, '2020_03_12_224008_create_categoria_negocios_table', 1),
(70, '2020_03_24_233234_create_negocios_table', 1),
(71, '2020_03_24_233235_create_productos_table', 1),
(72, '2020_03_24_233700_create_estado_pedidos_table', 1),
(73, '2020_03_24_233750_create_pedidos_table', 1),
(74, '2020_03_24_233820_create_detalle_pedidos_table', 1),
(75, '2020_03_24_233950_create_combos_table', 1),
(76, '2020_03_24_233952_create_detalle_combos_table', 1),
(77, '2014_10_12_000000_create_users_table', 1),
(78, '2014_10_12_100000_create_password_resets_table', 1),
(79, '2019_12_23_154242_create_tipo_documentos_table', 1),
(80, '2019_12_23_154243_create_departamentos_table', 1),
(81, '2019_12_23_154243_create_roles_table', 1),
(82, '2019_12_23_154244_create_ciudads_table', 1),
(83, '2019_12_23_154245_create_barrios_table', 1),
(84, '2019_12_23_154304_create_estados_table', 1),
(85, '2019_12_23_154528_create_usuarios_table', 1),
(86, '2020_02_07_142818_create_configuracions_table', 1),
(87, '2020_03_12_224007_create_categoria__productos_table', 1),
(88, '2020_03_12_224008_create_categoria_negocios_table', 1),
(89, '2020_03_24_233234_create_negocios_table', 1),
(90, '2020_03_24_233235_create_productos_table', 1),
(91, '2020_03_24_233700_create_estado_pedidos_table', 1),
(92, '2020_03_24_233750_create_pedidos_table', 1),
(93, '2020_03_24_233820_create_detalle_pedidos_table', 1),
(94, '2020_03_24_233950_create_combos_table', 1),
(95, '2020_03_24_233952_create_detalle_combos_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocios`
--

CREATE TABLE `negocios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nit` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_completo` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_ciudad` int(10) UNSIGNED DEFAULT NULL,
  `id_usuario` int(10) UNSIGNED DEFAULT NULL,
  `id_categoria` int(10) UNSIGNED DEFAULT NULL,
  `long` float DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `hora_apertura` time NOT NULL,
  `hora_cierre` time NOT NULL,
  `canal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `negocios`
--

INSERT INTO `negocios` (`id`, `nit`, `nombre_completo`, `telefono`, `direccion`, `foto`, `descripcion`, `id_ciudad`, `id_usuario`, `id_categoria`, `long`, `lat`, `hora_apertura`, `hora_cierre`, `canal`, `created_at`, `updated_at`) VALUES
(1, '900002456', 'Granero pachito', '321231245', 'calle 32', 'pachito.jpg', 'mini mercado', 639, 5, 1, -76.2998, 3.53183, '08:00:00', '23:59:00', 31, NULL, NULL),
(2, '9054678', 'Billos', '56570893', 'calle 56', '1586874949.jpeg', 'comidas rápidas', 639, 3, 2, -76.2979, 3.53395, '08:00:00', '22:00:00', 32, NULL, NULL),
(3, '111456743', 'TECNOLOGIA', '3206041556', NULL, 'logo-traelo-ve.png', 'venta de articulos tecnologicos', NULL, 10, 4, -76.33, 3.47146, '06:00:00', '20:00:00', 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED DEFAULT NULL,
  `id_negocio` int(10) UNSIGNED DEFAULT NULL,
  `id_estado` int(10) UNSIGNED DEFAULT NULL,
  `valor_total` int(11) DEFAULT NULL,
  `tiempo_entrega` time DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_usuario`, `id_negocio`, `id_estado`, `valor_total`, `tiempo_entrega`, `fecha`, `cantidad`, `created_at`, `updated_at`) VALUES
(9, 6, 2, 1, 33000, NULL, NULL, NULL, '2020-04-10 05:30:23', '2020-04-10 05:30:23'),
(10, 6, 1, 1, 10500, NULL, NULL, NULL, '2020-04-10 05:49:56', '2020-04-10 05:49:56'),
(11, 7, 2, 2, 10000, '00:30:00', NULL, NULL, '2020-04-10 21:56:38', '2020-04-16 05:40:45'),
(12, 9, 2, 1, 8000, NULL, NULL, NULL, '2020-04-16 06:57:19', '2020-04-16 06:57:19'),
(13, 12, 1, 1, 9500, NULL, '2022-06-29', NULL, '2022-06-29 22:02:52', '2022-06-29 22:02:52'),
(14, 12, 2, 1, 32000, NULL, '2022-06-29', NULL, '2022-06-29 22:03:41', '2022-06-29 22:03:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_categoria` int(10) UNSIGNED DEFAULT NULL,
  `id_negocio` int(10) UNSIGNED DEFAULT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unidad_medida` int(11) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `id_negocio`, `foto`, `codigo`, `nombre`, `descripcion`, `unidad_medida`, `valor`, `stock`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1585524438.png', 'le001', 'leche alqueria', 'leche alqueria x 1100 ml', NULL, 2500, 20, '2020-03-30 14:27:18', '2020-03-30 14:27:18'),
(2, 1, 1, '1585583005.jpeg', 'y001', 'yogurth griego', 'yogurth griego x 150g', NULL, 3000, 20, '2020-03-31 06:43:26', '2020-03-31 06:43:26'),
(3, 2, 1, '1585583867.jpeg', 'ga001', 'Galletas Ducales', 'galletas ducales taco x 2 x 260g', NULL, 4000, 10, '2020-03-31 06:57:47', '2020-03-31 06:57:47'),
(4, 1, 1, '1585698619.png', 'qu001', 'Queso mozarella alpina', 'queso mozarella alpina x 250g', NULL, 4000, 12, '2020-04-01 14:50:20', '2020-04-01 14:50:20'),
(5, 5, 2, '1585938222.jpeg', 'ma001', 'malteada sencilla', 'malteada sencilla', NULL, 4000, 10, NULL, NULL),
(6, 3, 2, '1585938288.jpeg', 'pe001', 'perro caliente sencillo', 'perro caliente sencillo', NULL, 6000, 10, NULL, NULL),
(7, 4, 2, '1585938556.jpeg', 'pa001', 'papas sencillass', 'papas sencillas', NULL, 4000, 10, NULL, NULL),
(8, 6, 3, '1656535509.jpeg', 'AC753', 'Computador Acer Aspire E', 'portatil de 16 GB de Ram, Quad core, 1TB disco duro', NULL, 3200000, 20, NULL, NULL),
(9, 6, 3, '1656535668.jpeg', 'AB 3412', 'Hp 34 Pc', 'Computador de mesa adabtado para gamers com procesador ryzen', NULL, 4500000, 30, NULL, NULL),
(10, 7, 3, 'sin-imagen.jpeg', 'TV23', 'televisor LG ultima generacion', 'televisor oled de 72\"\" smart tv', NULL, 2500000, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'administrador', NULL, NULL),
(2, 'Cliente', 'cliente', NULL, NULL),
(3, 'Vendedor', 'vendedor', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documentos`
--

CREATE TABLE `tipo_documentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_documentos`
--

INSERT INTO `tipo_documentos` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'CC', 'cedula', NULL, NULL),
(2, 'TI', 'tarjeta de identidad', NULL, NULL),
(3, 'PA', 'pasaporte', NULL, NULL),
(4, 'CE', 'cedula extranjera', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_tipo_documento` int(10) UNSIGNED DEFAULT NULL,
  `numero_documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_completo` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_ciudad` int(10) UNSIGNED DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_role` int(10) UNSIGNED DEFAULT NULL,
  `id_estado` int(10) UNSIGNED DEFAULT NULL,
  `long` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_tipo_documento`, `numero_documento`, `nombre_completo`, `foto`, `telefono`, `id_ciudad`, `direccion`, `email`, `password`, `email_verified_at`, `id_role`, `id_estado`, `long`, `lat`, `id_admin`, `created_at`, `updated_at`) VALUES
(3, 1, '1113675262', 'antony', '1585935481.png', '3207763491', 639, 'calle 32', 'antony@email.com', '$2y$10$x6hGersBZZlXd6lqo/DxieW/cfrWptMPUbTxTKvSh.M3z5HrWte9a', '2020-04-03 22:38:02', 1, NULL, NULL, NULL, NULL, '2020-03-28 13:50:29', '2020-04-04 03:38:02'),
(5, 1, '1112435799', 'Lucho Ramirez', 'admin.jpg', '3214567890', 639, 'Calle 16A #34-4, Palmira, Valle del Cauca, Colombia', 'lucho@email.com', '$2y$10$a8UHXHmQHRPftDG9RfskGelCBFimbKHLy358rwPO8g4UPLg7S0dsm', '2020-04-07 14:13:42', 1, 1, '-76.31', '3.52', NULL, '2020-04-07 19:13:42', '2020-04-07 19:13:42'),
(6, 1, '1113456287', 'chester manyoma', 'admin.jpg', '42334457', NULL, 'Cra. 28 #32-1, Palmira, Valle del Cauca, Colombia', 'chester@email.com', '$2y$10$XSF.Xe7Wuq4AdSsUeNkHzuvSJ3e7ggxgnWoeUas3dsZ6/SVlt3gBO', '2020-04-08 17:40:20', 2, 1, '-76.29855979999999', '3.5287657', NULL, '2020-04-08 22:34:18', '2020-04-08 22:34:18'),
(7, 1, '111546789', 'fernando castro', 'admin.jpg', '3215467832', 639, NULL, 'fernando@email.com', '$2y$10$eANGyRrBv/oyJjwGANc.1OnzmFqX4hSaRRc7yPDjJmsV8N/94Wztu', '2020-04-10 16:54:35', 2, 1, NULL, NULL, NULL, '2020-04-10 21:54:35', '2020-04-10 21:54:35'),
(8, 1, '11165432890', 'Carlos Castro', '1586618561.jpeg', '32142678', NULL, 'calle 45', 'carlos@email.com', '$2y$10$vNq/Aopc.9SRyWSOz7DJYurpo0C6KiD70MbZlxDorcRcot7AzL5/O', '2020-04-11 15:28:46', 3, 1, NULL, NULL, 3, '2020-04-11 20:22:41', '2020-04-11 20:28:46'),
(9, 1, '56565656', 'fernanda perez', 'admin.jpg', '78787878', 639, 'Cra. 28, Palmira, Valle del Cauca, Colombia', 'fernanda@email.com', '$2y$10$gf1Uhfhde7h6MK4oFDzqKubxqQHZCcsIScX5HuZAlaoJyxoo7dJx.', '2020-04-16 01:56:27', 2, 1, NULL, '3.5373505', NULL, '2020-04-16 06:56:27', '2020-04-16 06:56:27'),
(10, 1, '111456743', 'steven ortiz sandoval', 'admin.png', '3206041556', 639, NULL, 'stevenluck431@gmail.com', '$2y$10$/zi0FnEXlkYqX4FX1iAT4OUxlW1kqMm92IlFW0Gzv9bS3w3ezPeH.', '2022-06-29 20:37:52', 1, 1, NULL, NULL, NULL, '2022-06-29 20:37:52', '2022-06-29 20:37:52'),
(11, 1, '11145678', 'Daniela Rodriguez', 'avatar.png', '3214562389', NULL, 'calle 5', 'dani@gmail.com', '$2y$10$JVu1xtzMGzPhOVedAK0NKeiY.wMGbZCOc0zSW3lIFb/L1CmtiVQuG', '2022-06-29 20:51:44', 3, 1, NULL, NULL, 10, '2022-06-29 20:51:44', '2022-06-29 20:51:44'),
(12, NULL, NULL, 'nicole tatiana', 'avatar.png', '3245634222', 639, 'calle 5', 'nicole@gmail.com', '$2y$10$AZR0yb.GZ1ZEbEQgJeeJHuOZHg/d/fxfXJbj1eW/KO91u4yXh0KE2', '2022-06-29 21:57:52', 2, 1, NULL, NULL, NULL, '2022-06-29 21:57:52', '2022-06-29 21:57:52');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `barrios`
--
ALTER TABLE `barrios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barrios_id_ciudad_foreign` (`id_ciudad`);

--
-- Indices de la tabla `categoria_negocios`
--
ALTER TABLE `categoria_negocios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria__productos`
--
ALTER TABLE `categoria__productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciudads`
--
ALTER TABLE `ciudads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ciudads_id_departamento_foreign` (`id_departamento`);

--
-- Indices de la tabla `combos`
--
ALTER TABLE `combos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `combos_id_estado_foreign` (`id_estado`),
  ADD KEY `combos_id_negocio_foreign` (`id_negocio`);

--
-- Indices de la tabla `configuracions`
--
ALTER TABLE `configuracions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `configuracions_id_admin_foreign` (`id_admin`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_combos`
--
ALTER TABLE `detalle_combos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_combos_id_producto_foreign` (`id_producto`),
  ADD KEY `detalle_combos_id_combo_foreign` (`id_combo`);

--
-- Indices de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_pedidos_id_producto_foreign` (`id_producto`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_pedidos`
--
ALTER TABLE `estado_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `negocios`
--
ALTER TABLE `negocios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `negocios_id_categoria_foreign` (`id_categoria`),
  ADD KEY `negocios_id_usuario_foreign` (`id_usuario`),
  ADD KEY `negocios_id_ciudad_foreign` (`id_ciudad`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_id_negocio_foreign` (`id_negocio`),
  ADD KEY `pedidos_id_usuario_foreign` (`id_usuario`),
  ADD KEY `pedidos_id_estado_foreign` (`id_estado`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productos_id_categoria_foreign` (`id_categoria`),
  ADD KEY `productos_id_negocio_foreign` (`id_negocio`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_documentos`
--
ALTER TABLE `tipo_documentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_id_tipo_documento_foreign` (`id_tipo_documento`),
  ADD KEY `usuarios_id_estado_foreign` (`id_estado`),
  ADD KEY `usuarios_id_role_foreign` (`id_role`),
  ADD KEY `usuarios_id_ciudad_foreign` (`id_ciudad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `barrios`
--
ALTER TABLE `barrios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria_negocios`
--
ALTER TABLE `categoria_negocios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `categoria__productos`
--
ALTER TABLE `categoria__productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ciudads`
--
ALTER TABLE `ciudads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1101;

--
-- AUTO_INCREMENT de la tabla `combos`
--
ALTER TABLE `combos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `configuracions`
--
ALTER TABLE `configuracions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `detalle_combos`
--
ALTER TABLE `detalle_combos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estado_pedidos`
--
ALTER TABLE `estado_pedidos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de la tabla `negocios`
--
ALTER TABLE `negocios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_documentos`
--
ALTER TABLE `tipo_documentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `barrios`
--
ALTER TABLE `barrios`
  ADD CONSTRAINT `barrios_id_ciudad_foreign` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudads` (`id`);

--
-- Filtros para la tabla `ciudads`
--
ALTER TABLE `ciudads`
  ADD CONSTRAINT `ciudads_id_departamento_foreign` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id`);

--
-- Filtros para la tabla `combos`
--
ALTER TABLE `combos`
  ADD CONSTRAINT `combos_id_estado_foreign` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `combos_id_negocio_foreign` FOREIGN KEY (`id_negocio`) REFERENCES `negocios` (`id`);

--
-- Filtros para la tabla `configuracions`
--
ALTER TABLE `configuracions`
  ADD CONSTRAINT `configuracions_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `detalle_combos`
--
ALTER TABLE `detalle_combos`
  ADD CONSTRAINT `detalle_combos_id_combo_foreign` FOREIGN KEY (`id_combo`) REFERENCES `combos` (`id`),
  ADD CONSTRAINT `detalle_combos_id_producto_foreign` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD CONSTRAINT `detalle_pedidos_id_producto_foreign` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `negocios`
--
ALTER TABLE `negocios`
  ADD CONSTRAINT `negocios_id_categoria_foreign` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_negocios` (`id`),
  ADD CONSTRAINT `negocios_id_ciudad_foreign` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudads` (`id`),
  ADD CONSTRAINT `negocios_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_id_estado_foreign` FOREIGN KEY (`id_estado`) REFERENCES `estado_pedidos` (`id`),
  ADD CONSTRAINT `pedidos_id_negocio_foreign` FOREIGN KEY (`id_negocio`) REFERENCES `negocios` (`id`),
  ADD CONSTRAINT `pedidos_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_id_categoria_foreign` FOREIGN KEY (`id_categoria`) REFERENCES `categoria__productos` (`id`),
  ADD CONSTRAINT `productos_id_negocio_foreign` FOREIGN KEY (`id_negocio`) REFERENCES `negocios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_id_ciudad_foreign` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudads` (`id`),
  ADD CONSTRAINT `usuarios_id_estado_foreign` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `usuarios_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `usuarios_id_tipo_documento_foreign` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipo_documentos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
