-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-12-2024 a las 11:11:10
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `databgeneral`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `ID_CLIENTE` int(11) NOT NULL,
  `CLIENTE` int(11) NOT NULL,
  `DNI` int(11) NOT NULL,
  `TELEFONO` int(11) NOT NULL,
  `ID_PRODUCTO` int(11) NOT NULL,
  `PRECIO` int(11) NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
  `IMPORTE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`ID_CLIENTE`, `CLIENTE`, `DNI`, `TELEFONO`, `ID_PRODUCTO`, `PRECIO`, `CANTIDAD`, `IMPORTE`) VALUES
(0, 0, 5555, 931267969, 123, 1500, 3, 100),
(0, 0, 41252003, 931267969, 123, 1500, 3, 100),
(0, 0, 41252003, 931267969, 123, 1500, 3, 100),
(0, 0, 41252003, 931267969, 123, 1500, 3, 100),
(0, 0, 41252003, 931267969, 123, 1500, 3, 100),
(0, 0, 5555, 931267969, 123, 1500, 3, 100),
(0, 0, 75343875, 931267969, 123, 1500, 3, 111);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consulta de clientes`
--

CREATE TABLE `consulta de clientes` (
  `NombreC` int(11) NOT NULL,
  `correo` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `consulta Recursos humanos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultar rrhh`
--

CREATE TABLE `consultar rrhh` (
  `id_empleado` int(11) NOT NULL,
  `Nombre_completo` varchar(11) NOT NULL,
  `apellido` varchar(110) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `nombre_departamento` varchar(11) NOT NULL,
  `empleado_nuevo` varchar(11) NOT NULL,
  `salario` decimal(10,0) NOT NULL,
  `fecha_pago` date NOT NULL,
  `dias_vacaciones` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad_id` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id`, `venta_id`, `producto_id`, `cantidad_id`, `precio`) VALUES
(0, 2, 2, 2, 200.00),
(0, 2, 2, 2, 200.00),
(0, 2, 2, 2, 200.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(30) NOT NULL,
  `APELLIDO` varchar(30) NOT NULL,
  `DEPARTAMENTO` varchar(30) NOT NULL,
  `CARGO` varchar(255) NOT NULL,
  `SALARIO` varchar(255) NOT NULL,
  `FECHA_INGRESO` date NOT NULL,
  `ESTADO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`ID`, `NOMBRE`, `APELLIDO`, `DEPARTAMENTO`, `CARGO`, `SALARIO`, `FECHA_INGRESO`, `ESTADO`) VALUES
(0, 'jose', 'quispe acuña ', 'ventas', 'empleado', '1200', '2024-12-30', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `Usuario` varchar(100) NOT NULL,
  `Contraseña` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`Usuario`, `Contraseña`) VALUES
('Miguel', '123456'),
('LDAVILAMIGUELAN', '123456miguel'),
('Jose', '123456'),
('Miguel Angel', '123456'),
('Jorge', '123456'),
('Admin', 'Admin'),
('Cliente', '123456'),
('josue', '123456'),
('Escanor', '123456'),
('Miguel22', '123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre_Producto` varchar(110) NOT NULL,
  `descripcion_producto` text NOT NULL,
  `precio_producto` decimal(10,2) NOT NULL,
  `stock` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre_Producto`, `descripcion_producto`, `precio_producto`, `stock`) VALUES
(0, 'LAPTOP', 'nuevo', 250.00, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proovedores`
--

CREATE TABLE `proovedores` (
  `NombreProovedor` varchar(255) NOT NULL,
  `Empresa` varchar(255) NOT NULL,
  `Direccion` int(255) NOT NULL,
  `Telefono` varchar(255) NOT NULL,
  `Precios` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provedor`
--

CREATE TABLE `provedor` (
  ` Nombre Proveedor` varchar(255) NOT NULL,
  `Empresa` varchar(255) NOT NULL,
  `Dirección` varchar(255) NOT NULL,
  `Teléfono` varchar(255) NOT NULL,
  `Precios` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_consulta`
--

CREATE TABLE `tbl_consulta` (
  `ID` varchar(255) NOT NULL,
  `CLIENTE` varchar(255) NOT NULL,
  `Correo_Electronico` varchar(255) NOT NULL,
  `Descripcion` text NOT NULL,
  `Reporte` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pro`
--

CREATE TABLE `tbl_pro` (
  `NOMBRE` varchar(255) NOT NULL,
  `CELULAR` varchar(20) NOT NULL,
  `EMPRESA` varchar(30) NOT NULL,
  `EMAIL` varchar(40) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_pro`
--

INSERT INTO `tbl_pro` (`NOMBRE`, `CELULAR`, `EMPRESA`, `EMAIL`, `ID`) VALUES
('jose', '983444567', 'SONIC', 'lzmiguel752@gmail.com', 0),
('miguel', '983444567', 'SONIC', 'lzmiguel752@gmail.com', 0),
('Elmer', '983444567', 'SONIC', 'DXS6CK6LC@juanpa.xyz', 0),
('WILAR', '983444567', 'SONIC', 'DXS6CK6LC@juanpa.xyz', 0),
('ALAN', '983444567', 'SONIC', 'DXS6CK6LC@juanpa.xyz', 0),
('manolo', '983444567', 'SONIC', 'D49366942@juanpa.mx', 0),
('wili', '983444567', 'SONIC', 'D49366942@juanpa.mx', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

CREATE TABLE `tbl_productos` (
  `ID` varchar(11) NOT NULL,
  `NOMBRE` varchar(255) NOT NULL,
  `DESCRIPCION` varchar(30) NOT NULL,
  `PRECIO` int(11) NOT NULL,
  `STOCK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_productos`
--

INSERT INTO `tbl_productos` (`ID`, `NOMBRE`, `DESCRIPCION`, `PRECIO`, `STOCK`) VALUES
('', 'pcGamer', 'nuevo', 1500, 2),
('', 'tablet samsug', 'nuevo', 200, 3),
('', 'laptop', 'nuevo', 1500, 3),
('', 'celular2', 'nuevo', 1500, 2),
('', 'teclado ', 'nuevo', 30, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_consulta`
--

CREATE TABLE `tb_consulta` (
  `Cliente` varchar(100) NOT NULL,
  `Correo_Electrónico` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `reporte` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `venta_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`venta_id`, `total`, `fecha`) VALUES
(0, 200.00, 2024),
(0, 200.00, 2024);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
