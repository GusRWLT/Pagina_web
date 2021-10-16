-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 16-10-2021 a las 02:04:18
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id17489553_donar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dadores`
--

CREATE TABLE `dadores` (
  `PUB_ID` int(9) NOT NULL,
  `USU_ID` int(8) NOT NULL,
  `DAD_FECHA` date NOT NULL,
  `DAS_ID` int(1) NOT NULL COMMENT 'Clave foránea, tabla ESTADO_DADORES'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `dadores`
--

INSERT INTO `dadores` (`PUB_ID`, `USU_ID`, `DAD_FECHA`, `DAS_ID`) VALUES
(3, 49, '2021-10-15', 1),
(3, 51, '2021-10-13', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_usu`
--

CREATE TABLE `estados_usu` (
  `ESTADO_ID` int(1) NOT NULL,
  `ESTADO_DESC` varchar(50) CHARACTER SET latin1 NOT NULL COMMENT 'Descripción del estado de una cuenta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estados_usu`
--

INSERT INTO `estados_usu` (`ESTADO_ID`, `ESTADO_DESC`) VALUES
(1, 'Inactivo'),
(2, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_dadores`
--

CREATE TABLE `estado_dadores` (
  `DAS_ID` int(1) NOT NULL,
  `DAS_DESC` varchar(50) CHARACTER SET latin1 NOT NULL COMMENT 'Descripción del estado de los dadores'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estado_dadores`
--

INSERT INTO `estado_dadores` (`DAS_ID`, `DAS_DESC`) VALUES
(1, 'En espera'),
(2, 'Aprobado'),
(3, 'Rechazado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factores`
--

CREATE TABLE `factores` (
  `FACTOR_ID` int(1) NOT NULL,
  `FACTOR_DESC` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Nombre del factor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `factores`
--

INSERT INTO `factores` (`FACTOR_ID`, `FACTOR_DESC`) VALUES
(1, 'A+'),
(2, 'A-'),
(3, 'B+'),
(4, 'B-'),
(5, 'O+'),
(6, 'O-'),
(7, 'AB+'),
(8, 'AB-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospitales`
--

CREATE TABLE `hospitales` (
  `HOS_ID` int(3) NOT NULL,
  `HOS_NOMBRE` varchar(50) CHARACTER SET latin1 NOT NULL COMMENT 'Nombre del hospital',
  `HOS_DIRECC` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Dirección del hospital',
  `LOC_ID` int(3) NOT NULL COMMENT 'Clave foránea, tabla LOCALIDADES',
  `HOS_TEL` varchar(20) CHARACTER SET latin1 NOT NULL COMMENT 'Teléfono',
  `HOS_HORA` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Horarios para la donación'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `hospitales`
--

INSERT INTO `hospitales` (`HOS_ID`, `HOS_NOMBRE`, `HOS_DIRECC`, `LOC_ID`, `HOS_TEL`, `HOS_HORA`) VALUES
(1, 'Hospital Isidoro Iriarte', 'Allison Bell 770', 3, '011 4253 6021', 'lunes a viernes de 7:30 a 12:30 hs. o los sábados de 7:30 a 12 hs.'),
(2, 'Hospital Dr. Pedro Fiorito', 'Belgrano Nº 581', 1, '011 4201 3081 / 3087', 'De 7 AM a 12 PM.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

CREATE TABLE `localidades` (
  `LOC_ID` int(3) NOT NULL,
  `LOC_DESC` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Nombre de la localidad'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `localidades`
--

INSERT INTO `localidades` (`LOC_ID`, `LOC_DESC`) VALUES
(1, 'Avellaneda'),
(2, 'Almirante Brown'),
(3, 'Quilmes'),
(4, 'Lanús'),
(5, 'Florencio Varela'),
(6, 'Berazategui'),
(7, 'Lomas de Zamora'),
(8, 'Esteban Echeverría'),
(9, 'Adrogué'),
(10, 'Banfield'),
(11, 'Bernal'),
(12, 'Burzaco'),
(13, 'Ezeiza'),
(14, 'Lavallol'),
(15, 'Monte Grande'),
(16, 'Platanos'),
(17, 'Rafael Calzada'),
(18, 'Ranelagh'),
(19, 'San Francisco Solano'),
(20, 'Sarandí'),
(21, 'Wilde');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `PUB_ID` int(9) NOT NULL,
  `USU_ID` int(8) NOT NULL COMMENT 'Clave foránea del usuario que creó la publicación',
  `PUB_APELLIDO` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Apellido de la persona que necesita sangre',
  `PUB_NOMBRE` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Nombre de la persona que necesita sangre',
  `PUB_DNI` int(8) NOT NULL,
  `FACTOR_ID` int(1) NOT NULL COMMENT 'Clave foránea, tabla FACTORES',
  `HOS_ID` int(3) NOT NULL COMMENT 'Clave foránea, tabla HOSPITALES',
  `PUB_DADORES_CANT` int(1) NOT NULL COMMENT 'Cantidad de dadores de sangre necesaria',
  `PUB_FECHA` date NOT NULL COMMENT 'Fecha de publicación (dd/mm/aaaa)',
  `PUB_FECHA_LIM` date NOT NULL COMMENT 'Fecha límite de la publicación (dd/mm/aaaa)',
  `PUB_ESTADO` int(1) NOT NULL COMMENT '1 = Activa // 2 = Completada satisf. // 3 = Cancelada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`PUB_ID`, `USU_ID`, `PUB_APELLIDO`, `PUB_NOMBRE`, `PUB_DNI`, `FACTOR_ID`, `HOS_ID`, `PUB_DADORES_CANT`, `PUB_FECHA`, `PUB_FECHA_LIM`, `PUB_ESTADO`) VALUES
(1, 48, 'Mendez', 'Pablo', 12345678, 5, 1, 5, '2021-09-22', '2022-09-27', 1),
(2, 49, 'Nuñez', 'Stella', 23423423, 3, 2, 4, '2021-09-22', '2021-10-30', 1),
(3, 53, 'PELLEGRINI', 'JUAN', 99888777, 3, 2, 1, '2021-09-22', '2021-09-01', 1),
(4, 51, 'Vilches', 'Walter', 36985214, 5, 1, 4, '2021-10-13', '2021-10-31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `ROL_ID` int(1) NOT NULL,
  `ROL_DESC` varchar(13) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Nombre del rol'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`ROL_ID`, `ROL_DESC`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `USU_ID` int(8) NOT NULL,
  `USU_APELLIDO` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `USU_NOMBRE` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `USU_DNI` int(8) NOT NULL COMMENT 'Necesario para el ingreso',
  `USU_TRAMIT` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `USU_FECHA_NAC` date NOT NULL COMMENT 'Fecha de nacimiento (aaaa-mm-dd)',
  `LOC_ID` int(3) NOT NULL COMMENT 'Clave foránea, tabla LOCALIDADES',
  `USU_EMAIL` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `USU_TEL` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Número de teléfono',
  `FACTOR_ID` int(1) NOT NULL COMMENT 'Clave foránea, tabla FACTORES',
  `USU_PASS` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Contraseña. Necesaria para el ingreso',
  `USU_ESTADO` int(1) NOT NULL COMMENT 'Clave foránea, tabla ESTADO_CUENTA',
  `USU_FECHA_REG` date NOT NULL COMMENT 'Fecha de registro (aaaa-mm-dd)',
  `ROL_ID` int(1) NOT NULL COMMENT 'Clave foránea, tabla ROLES',
  `USU_HASH` varchar(32) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Un string generado aleato.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`USU_ID`, `USU_APELLIDO`, `USU_NOMBRE`, `USU_DNI`, `USU_TRAMIT`, `USU_FECHA_NAC`, `LOC_ID`, `USU_EMAIL`, `USU_TEL`, `FACTOR_ID`, `USU_PASS`, `USU_ESTADO`, `USU_FECHA_REG`, `ROL_ID`, `USU_HASH`) VALUES
(48, 'Admin', 'Admin', 12345678, '12345678900', '1989-03-27', 1, 'vaccarogustavo1989@gmail.com', '1234567', 1, 'admin', 2, '2021-09-01', 1, 'f0e52b27a7a5d6a1a87373dffa53dbe5'),
(49, 'fernandez', 'matias', 30245897, '00102456635', '1986-05-10', 1, 'matias_fernandez@live.com.ar', '01115263548965421212', 1, 'matias1234', 2, '2021-09-08', 2, '50c3d7614917b24303ee6a220679dab3'),
(50, 'carlos', 'flores', 30761734, '00102598784', '1986-06-15', 1, 'matute1910@gmail.com', '0111548792365', 1, 'matias2345', 2, '2021-09-08', 2, 'b3e3e393c77e35a4a3f3cbd1e429b5dc'),
(51, 'MICHELTORENA', 'VERONICA', 11111111, '11111111', '1974-12-16', 3, 'ISFDYT24@MICHELTORENA.COM.AR', '111111', 5, 'Hola1111', 2, '2021-09-08', 2, '67d96d458abdef21792e6d8e590244e7'),
(52, 'vilches', 'walter', 95125124, '01010101010', '1966-09-19', 3, 'waltervilches@aol.com', '141214450', 1, '141414', 2, '2021-09-22', 2, '4311359ed4969e8401880e3c1836fbe1'),
(53, 'PEREZ GARDEL', 'MARIA ALEJANDRA', 98574586, '12345678955', '2000-09-19', 3, 'veromicheltorena@gmail.com', '12345678912345678912', 5, 'Hola1111', 2, '2021-09-22', 2, '9431c87f273e507e6040fcb07dcb4509'),
(54, 'Perez', 'Juan', 1000, '1000', '1970-10-13', 3, 'veromicheltorena@hotmail.com', '11111', 1, '1111', 1, '2021-10-13', 2, 'ccb1d45fb76f7c5a0bf619f979c6cf36');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dadores`
--
ALTER TABLE `dadores`
  ADD PRIMARY KEY (`PUB_ID`,`USU_ID`),
  ADD KEY `DAS_ID` (`DAS_ID`),
  ADD KEY `USU_ID` (`USU_ID`);

--
-- Indices de la tabla `estados_usu`
--
ALTER TABLE `estados_usu`
  ADD PRIMARY KEY (`ESTADO_ID`);

--
-- Indices de la tabla `estado_dadores`
--
ALTER TABLE `estado_dadores`
  ADD PRIMARY KEY (`DAS_ID`);

--
-- Indices de la tabla `factores`
--
ALTER TABLE `factores`
  ADD PRIMARY KEY (`FACTOR_ID`);

--
-- Indices de la tabla `hospitales`
--
ALTER TABLE `hospitales`
  ADD PRIMARY KEY (`HOS_ID`),
  ADD KEY `LOC_ID` (`LOC_ID`);

--
-- Indices de la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD PRIMARY KEY (`LOC_ID`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`PUB_ID`),
  ADD KEY `USU_ID` (`USU_ID`),
  ADD KEY `FACTOR_ID` (`FACTOR_ID`),
  ADD KEY `HOS_ID` (`HOS_ID`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ROL_ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`USU_ID`),
  ADD KEY `LOC_ID` (`LOC_ID`),
  ADD KEY `FACTOR_ID` (`FACTOR_ID`),
  ADD KEY `ROL_ID` (`ROL_ID`),
  ADD KEY `USU_ESTADO` (`USU_ESTADO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estados_usu`
--
ALTER TABLE `estados_usu`
  MODIFY `ESTADO_ID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `factores`
--
ALTER TABLE `factores`
  MODIFY `FACTOR_ID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `hospitales`
--
ALTER TABLE `hospitales`
  MODIFY `HOS_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `localidades`
--
ALTER TABLE `localidades`
  MODIFY `LOC_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `PUB_ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `ROL_ID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `USU_ID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dadores`
--
ALTER TABLE `dadores`
  ADD CONSTRAINT `dadores_ibfk_1` FOREIGN KEY (`USU_ID`) REFERENCES `usuarios` (`USU_ID`),
  ADD CONSTRAINT `dadores_ibfk_2` FOREIGN KEY (`PUB_ID`) REFERENCES `publicaciones` (`PUB_ID`),
  ADD CONSTRAINT `dadores_ibfk_3` FOREIGN KEY (`DAS_ID`) REFERENCES `estado_dadores` (`DAS_ID`);

--
-- Filtros para la tabla `hospitales`
--
ALTER TABLE `hospitales`
  ADD CONSTRAINT `hospitales_ibfk_1` FOREIGN KEY (`LOC_ID`) REFERENCES `localidades` (`LOC_ID`);

--
-- Filtros para la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `publicaciones_ibfk_1` FOREIGN KEY (`USU_ID`) REFERENCES `usuarios` (`USU_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `publicaciones_ibfk_2` FOREIGN KEY (`FACTOR_ID`) REFERENCES `factores` (`FACTOR_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `publicaciones_ibfk_3` FOREIGN KEY (`HOS_ID`) REFERENCES `hospitales` (`HOS_ID`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`LOC_ID`) REFERENCES `localidades` (`LOC_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`FACTOR_ID`) REFERENCES `factores` (`FACTOR_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_4` FOREIGN KEY (`ROL_ID`) REFERENCES `roles` (`ROL_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_5` FOREIGN KEY (`USU_ESTADO`) REFERENCES `estados_usu` (`ESTADO_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
