-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 29, 2021 at 08:25 PM
-- Server version: 10.2.37-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hyms_softwar`
--

-- --------------------------------------------------------

--
-- Table structure for table `Abono_Compra`
--

CREATE TABLE `Abono_Compra` (
  `Id_Abono_Compra` int(11) NOT NULL,
  `Id_Compra_Cuenta` int(11) NOT NULL,
  `Abono` float(100,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Agente_Externo`
--

CREATE TABLE `Agente_Externo` (
  `Id_Agente_Externo` int(11) NOT NULL,
  `Nombre` varchar(200) DEFAULT NULL,
  `Documento` int(11) DEFAULT NULL,
  `Cupo` int(11) DEFAULT NULL,
  `Cupo_Usado` double(250,2) NOT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Alerta`
--

CREATE TABLE `Alerta` (
  `Id_Alerta` int(11) NOT NULL,
  `Identificacion_Funcionario` int(11) DEFAULT NULL,
  `Tipo` varchar(30) DEFAULT NULL,
  `Fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `Detalles` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `Respuesta` enum('SI','NO') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Banco`
--

CREATE TABLE `Banco` (
  `Id_Banco` int(11) NOT NULL,
  `Nombre` varchar(200) DEFAULT NULL,
  `Apodo` text NOT NULL,
  `Identificador` varchar(200) DEFAULT NULL,
  `Detalle` text NOT NULL,
  `Id_Pais` int(11) NOT NULL,
  `Id_Moneda` int(11) NOT NULL,
  `Estado` varchar(100) NOT NULL DEFAULT 'Activo',
  `Comision_Otros_Bancos` double DEFAULT 0,
  `Comision_Mayor_Valor` double DEFAULT 0,
  `Mayor_Valor` double DEFAULT 0,
  `Maximo_Transferencia_Otros_Bancos` double DEFAULT 0,
  `Comision_Consignacion_Nacional` double DEFAULT 0,
  `Comision_Cuatro_Mil` double DEFAULT 0,
  `Comision_Consignacion_Local` double DEFAULT 0,
  `Maximo_Consignacion_Local` double DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bloqueo_Cuenta_Bancaria_Funcionario`
--

CREATE TABLE `Bloqueo_Cuenta_Bancaria_Funcionario` (
  `Id_Bloqueo_Cuenta_Bancaria_Funcionario` int(11) NOT NULL,
  `Id_Cuenta_Bancaria` int(11) NOT NULL,
  `Id_Funcionario` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora_Inicio_Sesion` varchar(8) NOT NULL DEFAULT '00:00:00',
  `Ocupada` enum('Si','No') NOT NULL DEFAULT 'Si',
  `Hora_Cierre_Sesion` varchar(8) NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bloqueo_Transferencia_Funcionario`
--

CREATE TABLE `Bloqueo_Transferencia_Funcionario` (
  `Id_Bloqueo_Transferencia_Funcionario` int(11) NOT NULL,
  `Id_Transferencia` int(11) NOT NULL,
  `Id_Funcionario` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` varchar(8) NOT NULL,
  `Bloqueada` enum('Si','No') NOT NULL DEFAULT 'Si'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bolsa_Bolivares_Tercero`
--

CREATE TABLE `Bolsa_Bolivares_Tercero` (
  `Id_Bolsa_Bolivares_Tercero` int(11) NOT NULL,
  `Id_Tercero` int(11) NOT NULL,
  `Bolsa_Bolivares` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Caja`
--

CREATE TABLE `Caja` (
  `Id_Caja` int(11) NOT NULL,
  `Id_Oficina` int(11) DEFAULT NULL,
  `Nombre` varchar(200) DEFAULT NULL,
  `Detalle` text DEFAULT NULL,
  `Estado` enum('Activa','Inactiva') NOT NULL DEFAULT 'Activa',
  `MAC` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Caja_Recaudos`
--

CREATE TABLE `Caja_Recaudos` (
  `Id_Caja_Recaudos` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Password` varchar(100) NOT NULL,
  `Id_Departamento` int(11) NOT NULL,
  `Id_Municipio` int(11) NOT NULL,
  `Estado` enum('Activa','Inactiva') NOT NULL DEFAULT 'Activa'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Cajero_Oficina`
--

CREATE TABLE `Cajero_Oficina` (
  `Id_Cajero_Oficina` int(11) NOT NULL,
  `Id_Cajero` int(11) NOT NULL,
  `Id_Oficina` int(11) NOT NULL,
  `Fecha_Registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Cajero_Principal_Oficina`
--

CREATE TABLE `Cajero_Principal_Oficina` (
  `Id` bigint(20) NOT NULL,
  `Cajero_Principal_Id` bigint(20) NOT NULL,
  `Oficina_Id` bigint(20) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Cambio`
--

CREATE TABLE `Cambio` (
  `Id_Cambio` int(11) NOT NULL,
  `Tipo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fomapago_id` bigint(20) NOT NULL,
  `Codigo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Observacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Fecha` timestamp NULL DEFAULT current_timestamp(),
  `Id_Caja` int(11) DEFAULT NULL,
  `Id_Oficina` int(11) DEFAULT NULL,
  `Moneda_Origen` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Moneda_Destino` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'Pesos',
  `Tasa` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Valor_Origen` double(10,2) DEFAULT NULL,
  `Valor_Destino` double(50,2) DEFAULT NULL,
  `TotalPago` double NOT NULL,
  `Vueltos` int(11) DEFAULT 0,
  `Recibido` int(11) NOT NULL DEFAULT 0,
  `Estado` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Realizado',
  `Identificacion_Funcionario` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Tercero_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Cargo`
--

CREATE TABLE `Cargo` (
  `Id_Cargo` int(11) NOT NULL,
  `Id_Dependencia` int(11) DEFAULT NULL,
  `Nombre` varchar(200) DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Compra`
--

CREATE TABLE `Compra` (
  `Id_Compra` int(11) NOT NULL,
  `Codigo` varchar(100) NOT NULL,
  `Id_Funcionario` int(11) NOT NULL,
  `Id_Tercero` int(11) NOT NULL,
  `Valor_Compra` float(50,2) NOT NULL,
  `Tasa` varchar(50) NOT NULL,
  `Valor_Peso` float(50,2) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `Hora` varchar(10) DEFAULT '00:00:00',
  `Detalle` text NOT NULL,
  `Id_Moneda_Compra` int(11) NOT NULL,
  `Estado` enum('Activa','Anulada','Pendiente') NOT NULL DEFAULT 'Activa'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Compra_Cuenta`
--

CREATE TABLE `Compra_Cuenta` (
  `Id_Compra_Cuenta` int(11) NOT NULL,
  `Id_Compra` int(11) DEFAULT NULL,
  `Id_Cuenta_Bancaria` int(11) NOT NULL,
  `Id_Funcionario` int(11) NOT NULL,
  `Valor` float(50,2) NOT NULL,
  `Numero_Transaccion` varchar(50) DEFAULT NULL,
  `Estado` enum('Cheque','Otro','Bloqueada','Efectiva') NOT NULL DEFAULT 'Bloqueada',
  `Detalle` text NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `Id_Consultor_Apertura_Cuenta` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Configuracion`
--

CREATE TABLE `Configuracion` (
  `Id_Configuracion` int(11) NOT NULL,
  `Nombre_Empresa` varchar(100) DEFAULT NULL,
  `NIT` varchar(50) NOT NULL,
  `Telefono` varchar(50) DEFAULT NULL,
  `Celular` varchar(10) DEFAULT NULL,
  `Direccion` varchar(50) DEFAULT NULL,
  `Correo` varchar(30) DEFAULT NULL,
  `Extras_Legales` int(11) NOT NULL,
  `Festivos_Legales` int(11) NOT NULL,
  `Llegadas_Tarde` int(11) NOT NULL,
  `Salario_Base` int(11) NOT NULL,
  `Subsidio_Transporte` int(11) NOT NULL,
  `Hora_Inicio_Dia` time NOT NULL,
  `Hora_Fin_Dia` time NOT NULL,
  `Hora_Extra_Diurna` varchar(5) NOT NULL,
  `Hora_Extra_Nocturna` varchar(5) NOT NULL,
  `Hora_Extra_Domingo_Diurna` varchar(5) NOT NULL,
  `Hora_Extra_Domingo_Nocturna` varchar(5) NOT NULL,
  `Recargo_Dominical_Diurna` varchar(5) NOT NULL,
  `Recargo_Dominical_Nocturna` varchar(5) NOT NULL,
  `Recargo_Diurna` varchar(5) NOT NULL,
  `Recargo_Nocturno` varchar(5) NOT NULL,
  `Hora_Inicio_Noche` time NOT NULL,
  `Hora_Fin_Noche` time NOT NULL,
  `Festivos` longtext NOT NULL,
  `Libres` longtext DEFAULT NULL,
  `Recibo` int(15) NOT NULL,
  `Prefijo_Recibo` varchar(100) NOT NULL,
  `Codigo_Formato_Recibo` varchar(100) NOT NULL,
  `Nombre_Dian_Recibo` varchar(100) NOT NULL,
  `Compra` int(11) DEFAULT NULL,
  `Prefijo_Compra` varchar(200) DEFAULT NULL,
  `Codigo_Formato_Compra` varchar(200) DEFAULT NULL,
  `Nombre_Dian_Compra` varchar(200) DEFAULT NULL,
  `Servicio_Externo` int(11) DEFAULT NULL,
  `Prefijo_Servicio_Externo` varchar(200) DEFAULT NULL,
  `Codigo_Formato_Servicio_Externo` varchar(200) DEFAULT NULL,
  `Nombre_Dian_Servicio_Externo` varchar(200) DEFAULT NULL,
  `Giro` int(11) DEFAULT NULL,
  `Prefijo_Giro` varchar(200) DEFAULT NULL,
  `Codigo_Formato_Giro` varchar(200) DEFAULT NULL,
  `Nombre_Dian_Giro` varchar(200) DEFAULT NULL,
  `Transferencia` int(11) DEFAULT NULL,
  `Prefijo_Transferencia` varchar(200) DEFAULT NULL,
  `Codigo_Formato_Transferencia` varchar(200) DEFAULT NULL,
  `Nombre_Dian_Transferencia` varchar(200) DEFAULT NULL,
  `Traslado` int(11) DEFAULT NULL,
  `Prefijo_Traslado` varchar(200) DEFAULT NULL,
  `Codigo_Formato_Traslado` varchar(200) DEFAULT NULL,
  `Nombre_Dian_Traslado` varchar(200) DEFAULT NULL,
  `Egreso` int(11) DEFAULT NULL,
  `Prefijo_Egreso` varchar(200) DEFAULT NULL,
  `Codigo_Formato_Egreso` varchar(200) DEFAULT NULL,
  `Nombre_Dian_Egreso` varchar(200) DEFAULT NULL,
  `Cambio` int(11) NOT NULL,
  `Prefijo_Cambio` varchar(100) NOT NULL,
  `Codigo_Formato_Cambio` varchar(100) NOT NULL,
  `Nombre_Dian_Cambio` varchar(1000) NOT NULL,
  `Traslado_Caja` int(11) NOT NULL,
  `Prefijo_Traslado_Caja` varchar(100) NOT NULL,
  `Codigo_Formato_Traslado_Caja` varchar(100) NOT NULL,
  `Nombre_Dian_Traslado_Caja` varchar(100) NOT NULL,
  `Servicio` int(11) NOT NULL,
  `Prefijo_Servicio` varchar(100) NOT NULL,
  `Codigo_Formato_Servicio` varchar(100) NOT NULL,
  `Nombre_Dian_Servicio` varchar(100) NOT NULL,
  `Fin_Hora_Laboral` time DEFAULT NULL,
  `Fechas_Festivas` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Consultor_Apertura_Cuenta`
--

CREATE TABLE `Consultor_Apertura_Cuenta` (
  `Id_Consultor_Apertura_Cuenta` int(11) NOT NULL,
  `Id_Funcionario` int(20) NOT NULL,
  `Fecha_Apertura` date NOT NULL,
  `Hora_Apertura` time NOT NULL,
  `Id_Oficina` int(11) NOT NULL,
  `Id_Caja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Consultor_Cierre_Cuenta`
--

CREATE TABLE `Consultor_Cierre_Cuenta` (
  `Id_Consultor_Cierre_Cuenta` int(11) NOT NULL,
  `Id_Consultor_Apertura_Cuenta` int(11) NOT NULL,
  `Id_Funcionario` int(20) NOT NULL,
  `Fecha_Cierre` date NOT NULL,
  `Hora_Cierre` time NOT NULL,
  `Id_Oficina` int(11) NOT NULL,
  `Id_Caja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Corresponsal_Bancario`
--

CREATE TABLE `Corresponsal_Bancario` (
  `Id_Corresponsal_Bancario` int(11) NOT NULL,
  `Id_Tercero` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Cupo` int(11) DEFAULT NULL,
  `Id_Departamento` int(11) NOT NULL,
  `Id_Municipio` int(11) NOT NULL,
  `Fecha_Registro` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Corresponsal_Diario`
--

CREATE TABLE `Corresponsal_Diario` (
  `Id_Corresponsal_Diario` int(11) NOT NULL,
  `Id_Corresponsal_Bancario` int(11) DEFAULT NULL,
  `Valor` int(11) DEFAULT NULL,
  `Detalle` varchar(200) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora` time DEFAULT NULL,
  `Identificacion_Funcionario` int(11) DEFAULT NULL,
  `Id_Moneda` int(11) NOT NULL DEFAULT 1,
  `Id_Caja` int(11) DEFAULT NULL,
  `Id_Oficina` int(11) DEFAULT NULL,
  `Id_Tipo_Movimiento_Corresponsal` int(11) NOT NULL,
  `Estado` enum('Activo','Anulado') NOT NULL DEFAULT 'Activo'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Corresponsal_Diario_Nuevo`
--

CREATE TABLE `Corresponsal_Diario_Nuevo` (
  `Id_Corresponsal_Diario` int(11) NOT NULL,
  `Id_Corresponsal_Bancario` int(11) NOT NULL,
  `Retiro` float(20,2) NOT NULL,
  `Consignacion` float(20,2) NOT NULL,
  `Total_Corresponsal` float(20,2) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Identificacion_Funcionario` int(11) NOT NULL,
  `Id_Caja` int(11) NOT NULL,
  `Id_Oficina` int(11) NOT NULL,
  `Id_Moneda` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Cuenta_Bancaria`
--

CREATE TABLE `Cuenta_Bancaria` (
  `Id_Cuenta_Bancaria` int(11) NOT NULL,
  `Numero_Cuenta` varchar(200) DEFAULT NULL,
  `Id_Banco` int(11) DEFAULT NULL,
  `Nombre_Titular` varchar(200) DEFAULT NULL,
  `Alias` varchar(100) DEFAULT NULL,
  `Identificacion_Titular` bigint(20) DEFAULT NULL,
  `Fecha` datetime DEFAULT current_timestamp(),
  `Detalle` text NOT NULL,
  `Estado` varchar(100) NOT NULL DEFAULT 'Activo',
  `Tipo_Cuenta` varchar(100) NOT NULL,
  `Comision_Bancaria` decimal(20,2) NOT NULL,
  `Id_Pais` int(11) NOT NULL,
  `Tipo` varchar(100) DEFAULT NULL,
  `Monto_Inicial` text DEFAULT NULL,
  `Id_Moneda` int(11) NOT NULL,
  `Asignada` enum('Si','No') NOT NULL DEFAULT 'No',
  `Estado_Apertura` enum('Abierta','Cerrada','Seleccionada') NOT NULL DEFAULT 'Cerrada',
  `Funcionario_Seleccion` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Cuenta_Bancaria_Apertura`
--

CREATE TABLE `Cuenta_Bancaria_Apertura` (
  `Id_Cuenta_Bancaria_Apertura` int(11) NOT NULL,
  `Id_Consultor_Apertura_Cuenta` int(11) NOT NULL,
  `Id_Cuenta_Bancaria` int(11) NOT NULL,
  `Fecha_Apertura` date NOT NULL,
  `Hora_Apertura` time DEFAULT NULL,
  `Monto_Apertura` float(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Cuenta_Bancaria_Cierre`
--

CREATE TABLE `Cuenta_Bancaria_Cierre` (
  `Id_Cuenta_Bancaria_Cierre` int(11) NOT NULL,
  `Id_Consultor_Cierre_Cuenta` int(11) NOT NULL,
  `Id_Cuenta_Bancaria` int(11) NOT NULL,
  `Fecha_Cierre` date NOT NULL,
  `Hora_Cierre` time NOT NULL,
  `Monto_Cierre` float(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Departamento`
--

CREATE TABLE `Departamento` (
  `Id_Departamento` int(11) NOT NULL,
  `Nombre` varchar(200) DEFAULT NULL,
  `Codigo` varchar(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Dependencia`
--

CREATE TABLE `Dependencia` (
  `Id_Dependencia` int(11) NOT NULL,
  `Id_Grupo` int(11) DEFAULT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Destinatario`
--

CREATE TABLE `Destinatario` (
  `Id_Destinatario` bigint(30) NOT NULL,
  `Nombre` varchar(200) DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `Tipo_Documento` varchar(100) DEFAULT NULL,
  `Id_Pais` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Triggers `Destinatario`
--
DELIMITER $$
CREATE TRIGGER `uppercase` BEFORE INSERT ON `Destinatario` FOR EACH ROW SET NEW.Nombre=UPPER(NEW.Nombre)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `uppercase2` BEFORE UPDATE ON `Destinatario` FOR EACH ROW SET NEW.Nombre=UPPER(NEW.Nombre)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Destinatario_Cuenta`
--

CREATE TABLE `Destinatario_Cuenta` (
  `Id_Destinatario_Cuenta` int(11) NOT NULL,
  `Id_Destinatario` bigint(20) DEFAULT NULL,
  `Id_Banco` int(11) DEFAULT NULL,
  `Numero_Cuenta` varchar(50) DEFAULT NULL,
  `Id_Pais` int(11) DEFAULT NULL,
  `Id_Tipo_Cuenta` int(11) DEFAULT NULL,
  `Estado` enum('Activa','Inactiva') NOT NULL DEFAULT 'Activa'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Destinatario_Cuenta_Externo`
--

CREATE TABLE `Destinatario_Cuenta_Externo` (
  `Id_Destinatario_Cuenta` int(11) NOT NULL,
  `Id_Destinatario` bigint(20) DEFAULT NULL,
  `Id_Banco` int(11) DEFAULT NULL,
  `Numero_Cuenta` varchar(50) DEFAULT NULL,
  `Id_Pais` int(11) DEFAULT NULL,
  `Id_Tipo_Cuenta` int(11) DEFAULT NULL,
  `Estado` enum('Activa','Inactiva') NOT NULL DEFAULT 'Activa'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Destinatario_Externo`
--

CREATE TABLE `Destinatario_Externo` (
  `Id_Destinatario` bigint(30) NOT NULL,
  `Nombre` varchar(200) DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `Tipo_Documento` varchar(100) DEFAULT NULL,
  `Id_Pais` int(11) DEFAULT NULL,
  `Id_Agente_Externo` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Devolucion_Cambios`
--

CREATE TABLE `Devolucion_Cambios` (
  `id` int(11) NOT NULL,
  `hora` datetime NOT NULL,
  `observacion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `motivodevolucioncambios_id` int(11) NOT NULL,
  `cambio_id` bigint(20) NOT NULL,
  `valor_entregado` decimal(50,0) NOT NULL,
  `valor_recibido` decimal(50,0) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Devolucion_Compra`
--

CREATE TABLE `Devolucion_Compra` (
  `Id_Devolucion_Compra` int(11) NOT NULL,
  `Id_Compra` int(11) NOT NULL,
  `Detalle_Devolucion` varchar(50) NOT NULL,
  `Fecha_Registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Devolucion_Transferencia`
--

CREATE TABLE `Devolucion_Transferencia` (
  `Id_Devolucion_Transferencia` int(11) NOT NULL,
  `Id_Pago_Transferencia` int(11) NOT NULL,
  `Id_Motivo_Devolucion` int(11) NOT NULL,
  `Id_Transferencia_Destinatario` int(11) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `Id_Funcionario` int(11) NOT NULL,
  `Observaciones` text NOT NULL,
  `Numero_Comprobante_Banco` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Diario`
--

CREATE TABLE `Diario` (
  `Id_Diario` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora_Apertura` varchar(100) NOT NULL,
  `Id_Funcionario` int(10) NOT NULL,
  `Caja_Apertura` int(10) NOT NULL,
  `Oficina_Apertura` int(10) NOT NULL,
  `Caja_Cierre` int(11) DEFAULT 0,
  `Oficina_Cierre` int(11) DEFAULT 0,
  `Hora_Cierre` varchar(100) DEFAULT '00:00:00',
  `Observacion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Diario_Consultor`
--

CREATE TABLE `Diario_Consultor` (
  `Id_Diario_Consultor` int(11) NOT NULL,
  `Id_Funcionario` int(11) NOT NULL,
  `Fecha_Apertura` date DEFAULT NULL,
  `Hora_Apertura` time DEFAULT NULL,
  `Fecha_Cierre` date DEFAULT NULL,
  `Hora_Cierre` time DEFAULT NULL,
  `Id_Oficina` int(11) DEFAULT NULL,
  `Id_Caja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Diario_Cuenta`
--

CREATE TABLE `Diario_Cuenta` (
  `Id_Diario_Cuenta` int(11) NOT NULL,
  `Id_Diario_Consultor` int(11) NOT NULL,
  `Id_Cuenta_Bancaria` int(11) NOT NULL,
  `Monto_Apertura` decimal(20,2) NOT NULL,
  `Monto_Cierre` decimal(20,2) DEFAULT NULL,
  `Fecha_Registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Diario_Moneda_Apertura`
--

CREATE TABLE `Diario_Moneda_Apertura` (
  `Id_Diario_Moneda_Apertura` int(11) NOT NULL,
  `Id_Diario` int(11) NOT NULL,
  `Id_Moneda` int(11) NOT NULL,
  `Valor_Moneda_Apertura` decimal(20,4) NOT NULL DEFAULT 0.0000,
  `Fecha_Registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Diario_Moneda_Cierre`
--

CREATE TABLE `Diario_Moneda_Cierre` (
  `Id_Diario_Moneda_Cierre` int(11) NOT NULL,
  `Id_Diario` int(11) NOT NULL,
  `Id_Moneda` int(11) NOT NULL,
  `Valor_Moneda_Cierre` varchar(20) NOT NULL DEFAULT '0',
  `Valor_Diferencia` varchar(20) NOT NULL DEFAULT '0',
  `Fecha_Registro` datetime DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Direcciones_Mac`
--

CREATE TABLE `Direcciones_Mac` (
  `MAC` varchar(100) NOT NULL,
  `Ip_Publica` text DEFAULT NULL,
  `Ip_Privada` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Egreso`
--

CREATE TABLE `Egreso` (
  `Id_Egreso` int(11) NOT NULL,
  `Id_Tercero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Id_Moneda` int(11) NOT NULL,
  `Id_Oficina` int(11) NOT NULL,
  `Valor` int(11) NOT NULL,
  `Detalle` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Identificacion_Funcionario` int(11) NOT NULL,
  `Fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `Estado` enum('Activo','Anulado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activo',
  `Codigo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fomapagos`
--

CREATE TABLE `fomapagos` (
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Funcionario`
--

CREATE TABLE `Funcionario` (
  `Identificacion_Funcionario` int(11) NOT NULL,
  `Suspendido` enum('NO','SI') NOT NULL DEFAULT 'NO',
  `Liquidado` enum('NO','SI') NOT NULL DEFAULT 'NO',
  `Nombres` varchar(45) DEFAULT NULL,
  `Apellidos` varchar(45) DEFAULT NULL,
  `Id_Grupo` int(11) NOT NULL,
  `Id_Dependencia` int(11) NOT NULL DEFAULT 1,
  `Id_Cargo` int(11) NOT NULL DEFAULT 1,
  `Id_Perfil` int(11) NOT NULL,
  `Fecha_Nacimiento` date DEFAULT '0000-00-00',
  `Lugar_Nacimiento` varchar(500) DEFAULT NULL,
  `Tipo_Sangre` varchar(3) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Celular` varchar(15) DEFAULT NULL,
  `Correo` varchar(45) DEFAULT NULL,
  `Direccion_Residencia` varchar(200) DEFAULT NULL,
  `Estado_Civil` varchar(15) DEFAULT NULL,
  `Grado_Instruccion` varchar(200) DEFAULT NULL,
  `Titulo_Estudio` varchar(200) DEFAULT NULL,
  `Talla_Pantalon` varchar(3) DEFAULT NULL,
  `Talla_Bata` varchar(3) DEFAULT NULL,
  `Talla_Botas` varchar(3) DEFAULT NULL,
  `Talla_Camisa` varchar(4) DEFAULT NULL,
  `Username` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Imagen` varchar(45) DEFAULT NULL,
  `Autorizado` varchar(2) DEFAULT 'No',
  `Salario` int(11) DEFAULT NULL,
  `Bonos` varchar(45) DEFAULT NULL,
  `Fecha_Ingreso` varchar(10) DEFAULT NULL,
  `Hijos` int(11) NOT NULL DEFAULT 0,
  `Ultima_Sesion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Fecha_Registrado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `personId` varchar(100) DEFAULT NULL,
  `persistedFaceId` varchar(200) NOT NULL DEFAULT '',
  `Tipo_Turno` enum('Rotativo','Fijo','Mixto','Libre') NOT NULL DEFAULT 'Fijo',
  `Id_Turno` int(11) NOT NULL DEFAULT 0,
  `Id_Proceso` int(11) NOT NULL DEFAULT 0,
  `Lider_Grupo` int(11) NOT NULL DEFAULT 0,
  `Fecha_Retiro` date DEFAULT '2100-12-31',
  `Sexo` varchar(50) DEFAULT NULL,
  `Jefe` int(11) DEFAULT 0,
  `Salarios` enum('Si','No') NOT NULL DEFAULT 'No',
  `Reporte_HE` enum('Si','No') NOT NULL DEFAULT 'No',
  `Validacion_HE` enum('Si','No') NOT NULL DEFAULT 'No',
  `Reporte_Horario` enum('Si','No') NOT NULL DEFAULT 'No',
  `Asignacion_Horario` enum('Si','No') NOT NULL DEFAULT 'No',
  `Funcionarios` enum('Si','No') NOT NULL DEFAULT 'No',
  `Indicadores` enum('Si','No') NOT NULL DEFAULT 'No',
  `Configuracion` enum('Si','No') NOT NULL DEFAULT 'No',
  `Llegada_Tarde` enum('Si','No') NOT NULL DEFAULT 'No',
  `Novedades` enum('Si','No') NOT NULL DEFAULT 'No',
  `Permiso_App` enum('Si','No') NOT NULL DEFAULT 'Si',
  `Contrato` varchar(200) NOT NULL DEFAULT '',
  `Afiliaciones` varchar(200) NOT NULL DEFAULT '',
  `Gcm_Id` varchar(200) NOT NULL DEFAULT '',
  `Estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `Saldo_Inicial_Peso` int(11) NOT NULL DEFAULT 0,
  `Saldo_Inicial_Bolivar` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Funcionario_Contacto_Emergencia`
--

CREATE TABLE `Funcionario_Contacto_Emergencia` (
  `Identificacion_Funcionario_Contacto_Emergencia` int(11) NOT NULL,
  `Identificacion_Funcionario` int(11) NOT NULL DEFAULT 0,
  `Parentesco` varchar(45) DEFAULT '',
  `Nombre` varchar(200) DEFAULT '',
  `Telefono` varchar(15) DEFAULT '',
  `Celular` varchar(15) NOT NULL DEFAULT '',
  `Direccion` varchar(200) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Funcionario_Cuenta_Bancaria`
--

CREATE TABLE `Funcionario_Cuenta_Bancaria` (
  `Id_Funcionario_Cuenta_Bancaria` int(11) NOT NULL,
  `Id_Funcionario` int(11) NOT NULL,
  `Id_Cuenta_Bancaria` int(11) NOT NULL,
  `EnUso` enum('Si','No') NOT NULL DEFAULT 'Si',
  `Fecha_Registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Funcionario_Experiencia_Laboral`
--

CREATE TABLE `Funcionario_Experiencia_Laboral` (
  `id_Funcionario_Experiencia_Laboral` int(11) NOT NULL,
  `Identificacion_Funcionario` int(11) NOT NULL,
  `Nombre_Empresa` varchar(45) DEFAULT NULL,
  `Cargo` varchar(45) DEFAULT NULL,
  `Ingreso_Empresa` varchar(15) DEFAULT NULL,
  `Retiro_Empresa` varchar(15) DEFAULT NULL,
  `Labores` varchar(255) DEFAULT NULL,
  `Jefe` varchar(45) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Funcionario_Modulo`
--

CREATE TABLE `Funcionario_Modulo` (
  `Id_Funcionario_Modulo` int(11) NOT NULL,
  `Id_Funcionario` int(11) NOT NULL,
  `Id_Modulo` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Funcionario_Referencia_Personal`
--

CREATE TABLE `Funcionario_Referencia_Personal` (
  `id_Funcionario_Referencias` int(11) NOT NULL,
  `Identificacion_Funcionario` int(11) NOT NULL,
  `Nombres` varchar(45) DEFAULT NULL,
  `Profesion` varchar(45) DEFAULT NULL,
  `Empresa` varchar(45) DEFAULT NULL,
  `Telefono` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Giro`
--

CREATE TABLE `Giro` (
  `Id_Giro` int(11) NOT NULL,
  `Documento_Remitente` int(11) NOT NULL,
  `Nombre_Remitente` varchar(100) NOT NULL,
  `Telefono_Remitente` varchar(100) NOT NULL,
  `Valor_Recibido` double(12,2) NOT NULL,
  `Valor_Entrega` double(12,2) NOT NULL,
  `Valor_Total` double(15,2) NOT NULL,
  `Comision` varchar(100) NOT NULL,
  `Documento_Destinatario` int(11) NOT NULL,
  `Nombre_Destinatario` varchar(100) NOT NULL,
  `Telefono_Destinatario` varchar(100) NOT NULL,
  `Identificacion_Funcionario` int(11) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `Id_Oficina` int(11) NOT NULL,
  `Id_Caja` int(11) NOT NULL,
  `Detalle` text NOT NULL,
  `Estado` varchar(100) NOT NULL DEFAULT 'Pendiente',
  `Fecha_Pago` date DEFAULT NULL,
  `Codigo` varchar(100) NOT NULL,
  `Motivo_Devolucion` text DEFAULT NULL,
  `Departamento_Remitente` int(10) NOT NULL,
  `Municipio_Remitente` int(10) NOT NULL,
  `Departamento_Destinatario` int(10) NOT NULL,
  `Municipio_Destinatario` int(10) NOT NULL,
  `Funcionario_Pago` int(11) DEFAULT NULL,
  `Caja_Pago` int(11) DEFAULT NULL,
  `Id_Moneda` int(11) NOT NULL DEFAULT 1,
  `Giro_Libre` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Giro_Comision`
--

CREATE TABLE `Giro_Comision` (
  `Id_Giro_Comision` int(11) NOT NULL,
  `Valor_Minimo` double(15,2) NOT NULL,
  `Valor_Maximo` double(15,2) NOT NULL,
  `Comision` double(15,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Giro_Destinatario`
--

CREATE TABLE `Giro_Destinatario` (
  `Documento_Destinatario` bigint(11) NOT NULL,
  `Id_Tipo_Documento` int(11) NOT NULL DEFAULT 1,
  `Nombre_Destinatario` varchar(100) DEFAULT NULL,
  `Telefono_Destinatario` varchar(100) DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Giro_Remitente`
--

CREATE TABLE `Giro_Remitente` (
  `Documento_Remitente` bigint(20) NOT NULL,
  `Id_Tipo_Documento` int(11) NOT NULL DEFAULT 1,
  `Nombre_Remitente` varchar(100) DEFAULT NULL,
  `Telefono_Remitente` varchar(100) DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Grupo`
--

CREATE TABLE `Grupo` (
  `Id_Grupo` int(11) NOT NULL,
  `Nombre` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Grupo_Tercero`
--

CREATE TABLE `Grupo_Tercero` (
  `Id_Grupo_Tercero` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Detalle` varchar(200) DEFAULT NULL,
  `Padre` int(11) DEFAULT 0,
  `Estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Grupo_Tercero_Nuevo`
--

CREATE TABLE `Grupo_Tercero_Nuevo` (
  `Id_Grupo_Tercero` int(11) NOT NULL,
  `Nombre_Grupo` varchar(50) NOT NULL,
  `Id_Grupo_Padre` int(11) NOT NULL DEFAULT 0,
  `Estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `Fecha_Registro` datetime NOT NULL DEFAULT current_timestamp(),
  `Id_Funcionario` int(11) NOT NULL,
  `Nivel` int(6) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Log_Sistema`
--

CREATE TABLE `Log_Sistema` (
  `Id_Log_Sistema` int(11) NOT NULL,
  `Id_Funcionario` int(11) NOT NULL,
  `Accion` varchar(50) NOT NULL,
  `Detalle` text NOT NULL,
  `Id_Registro` int(11) DEFAULT NULL,
  `Fecha_Registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Modulo`
--

CREATE TABLE `Modulo` (
  `Id_Modulo` int(4) NOT NULL,
  `Nombre_Modulo` varchar(250) NOT NULL,
  `Codigo` varchar(6) NOT NULL,
  `Ruta` varchar(250) NOT NULL,
  `Icono` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Moneda`
--

CREATE TABLE `Moneda` (
  `Id_Moneda` int(11) NOT NULL,
  `Codigo` varchar(10) DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Id_Pais` int(11) NOT NULL,
  `Orden` int(11) DEFAULT NULL,
  `Estado` enum('Activa','Inactiva') NOT NULL DEFAULT 'Activa',
  `MDefault` int(11) DEFAULT 0,
  `Compras` tinyint(1) NOT NULL DEFAULT 0,
  `Transferencia` tinyint(1) NOT NULL DEFAULT 0,
  `Gasto` tinyint(1) NOT NULL DEFAULT 0,
  `ServicioExterno` tinyint(1) NOT NULL DEFAULT 0,
  `CorresponsalBancario` tinyint(1) NOT NULL DEFAULT 0,
  `Traslado` tinyint(1) NOT NULL DEFAULT 0,
  `Giro` tinyint(1) NOT NULL DEFAULT 0,
  `Cambio` tinyint(1) NOT NULL DEFAULT 0,
  `Monto_Minimo_Diferencia_Transferencia` decimal(20,4) NOT NULL DEFAULT 0.0000,
  `Monto_Maximo_Diferencia_Transferencia` decimal(20,4) NOT NULL DEFAULT 0.0000,
  `MDefaultCompra` int(11) DEFAULT 0,
  `MDefaultVenta` int(11) DEFAULT 0,
  `CuotaCompra` varchar(50) CHARACTER SET utf32 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Moneda_Campo`
--

CREATE TABLE `Moneda_Campo` (
  `Id_Moneda_Campo` int(11) NOT NULL,
  `Campo_Visual` varchar(200) NOT NULL,
  `Columna` varchar(100) NOT NULL,
  `Color` varchar(100) NOT NULL,
  `Orden` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Moneda_Cuenta_Apertura`
--

CREATE TABLE `Moneda_Cuenta_Apertura` (
  `Id_Moneda_Cuenta_Apertura` int(11) NOT NULL,
  `Id_Moneda` int(11) NOT NULL,
  `Id_Cuenta_Bancaria` int(11) NOT NULL,
  `Valor` decimal(20,4) NOT NULL,
  `Id_Bloqueo_Cuenta` int(11) NOT NULL DEFAULT 0,
  `Fecha_Apertura` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Moneda_Cuenta_Cierre`
--

CREATE TABLE `Moneda_Cuenta_Cierre` (
  `Id_Moneda_Cierre_Cuenta` int(11) NOT NULL,
  `Id_Moneda` int(11) NOT NULL,
  `Id_Cuenta_Bancaria` int(11) NOT NULL,
  `Valor` decimal(20,4) NOT NULL,
  `Id_Bloqueo_Cuenta` int(11) NOT NULL,
  `Fecha_Cierre` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Moneda_Oficina`
--

CREATE TABLE `Moneda_Oficina` (
  `Id` int(11) NOT NULL,
  `Id_Moneda` int(11) NOT NULL,
  `Oficina_Id` int(11) NOT NULL,
  `Monto` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Moneda_Valor`
--

CREATE TABLE `Moneda_Valor` (
  `Id_Moneda_Valor` int(11) NOT NULL,
  `Identificacion_Funcionario` varchar(200) DEFAULT NULL,
  `Id_Moneda` int(11) DEFAULT NULL,
  `Valor` varchar(100) DEFAULT NULL,
  `Campo_Visual` varchar(200) NOT NULL,
  `Columna` varchar(100) DEFAULT NULL,
  `Color` varchar(100) DEFAULT NULL,
  `Orden` int(11) DEFAULT NULL,
  `Diario` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Motivo_Devolucion_Cambios`
--

CREATE TABLE `Motivo_Devolucion_Cambios` (
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` int(11) NOT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Motivo_Devolucion_Transferencia`
--

CREATE TABLE `Motivo_Devolucion_Transferencia` (
  `Id_Motivo_Devolucion_Transferencia` int(11) NOT NULL,
  `Motivo_Devolucion` varchar(30) NOT NULL,
  `Fecha_Creacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Movimiento_Cuenta_Bancaria`
--

CREATE TABLE `Movimiento_Cuenta_Bancaria` (
  `Id_Movimiento_Cuenta_Bancaria` int(11) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Valor` decimal(20,2) NOT NULL,
  `Tipo` varchar(100) NOT NULL,
  `Id_Cuenta_Bancaria` int(11) DEFAULT NULL,
  `Fecha_Creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `Detalle` text NOT NULL,
  `Id_Tipo_Movimiento_Bancario` int(11) NOT NULL,
  `Valor_Tipo_Movimiento_Bancario` int(11) NOT NULL,
  `Numero_Transferencia` text DEFAULT NULL,
  `Movimiento_Cerrado` enum('Si','No') DEFAULT 'No',
  `Id_Consultor_Apertura_Cuenta` int(11) DEFAULT NULL,
  `Estado` enum('Activo','Anulado') NOT NULL DEFAULT 'Activo',
  `Id_Funcionario` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Triggers `Movimiento_Cuenta_Bancaria`
--
DELIMITER $$
CREATE TRIGGER `Actualizar Saldo` AFTER INSERT ON `Movimiento_Cuenta_Bancaria` FOR EACH ROW BEGIN
    IF (EXISTS(SELECT Id_Saldo_Cuenta FROM Saldo_Cuenta WHERE Id_Cuenta_Bancaria = NEW.Id_Cuenta_Bancaria AND Fecha = CURDATE())) THEN
        IF NEW.Tipo = "Ingreso" THEN
            BEGIN
                UPDATE Saldo_Cuenta SET Saldo_Cuenta.Saldo = Saldo_Cuenta.Saldo + NEW.Valor;
            END;
        ELSE
            BEGIN
                UPDATE Saldo_Cuenta SET Saldo_Cuenta.Saldo = Saldo_Cuenta.Saldo - NEW.Valor;
            END;
        END IF;
    ELSE
        BEGIN
        	DECLARE saldo_anterior DECIMAL(20,2);
            SET saldo_anterior = IFNULL((SELECT IFNULL(Saldo, 0) FROM Saldo_Cuenta WHERE Fecha < CURDATE() AND Id_Cuenta_Bancaria = NEW.Id_Cuenta_Bancaria ORDER BY Id_Saldo_Cuenta DESC LIMIT 1), 0);
            
            IF NEW.Tipo = "Ingreso" THEN
            BEGIN
                 INSERT INTO Saldo_Cuenta(Saldo, Id_Cuenta_Bancaria, Fecha)
            	VALUES ((saldo_anterior + NEW.Valor), NEW.Id_Cuenta_Bancaria, CURDATE());
            END;
        ELSE
            BEGIN
                INSERT INTO Saldo_Cuenta(Saldo, Id_Cuenta_Bancaria, Fecha)
            	VALUES ((saldo_anterior - NEW.Valor), NEW.Id_Cuenta_Bancaria, CURDATE());
            END;
         END IF;
        END;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Movimiento_Tercero`
--

CREATE TABLE `Movimiento_Tercero` (
  `Id_Movimiento_Tercero` int(11) NOT NULL,
  `Fecha` date DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Valor` text NOT NULL,
  `Id_Moneda_Valor` int(11) NOT NULL,
  `Tipo` varchar(100) NOT NULL,
  `Id_Tercero` int(11) DEFAULT NULL,
  `Fecha_Creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Detalle` text DEFAULT NULL,
  `Id_Tipo_Movimiento` int(11) NOT NULL DEFAULT 0,
  `Valor_Tipo_Movimiento` int(11) NOT NULL DEFAULT 0,
  `Estado` enum('Activo','Anulado') NOT NULL DEFAULT 'Activo',
  `Id_Funcionario` int(11) NOT NULL DEFAULT 0,
  `Id_Compra` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Municipio`
--

CREATE TABLE `Municipio` (
  `Id_Municipio` int(11) NOT NULL,
  `Id_Departamento` int(11) DEFAULT NULL,
  `Nombre` varchar(200) DEFAULT NULL,
  `Codigo` varchar(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Oficina`
--

CREATE TABLE `Oficina` (
  `Id_Oficina` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Telefono` varchar(200) NOT NULL,
  `Celular` varchar(200) NOT NULL,
  `Correo` varchar(200) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Id_Municipio` int(30) NOT NULL,
  `Limite_Transferencia` int(11) NOT NULL,
  `Nombre_Establecimiento` varchar(200) NOT NULL,
  `Lema` varchar(200) NOT NULL,
  `Pie_Pagina` varchar(200) NOT NULL,
  `Estado` enum('Activa','Inactiva') NOT NULL DEFAULT 'Activa',
  `Creado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Oficina_Moneda`
--

CREATE TABLE `Oficina_Moneda` (
  `Id_Oficina_Moneda` int(11) NOT NULL,
  `Identificacion_Funcionario` varchar(200) DEFAULT NULL,
  `Id_Moneda` int(11) DEFAULT NULL,
  `Valor` double DEFAULT NULL,
  `Campo_Visual` varchar(200) NOT NULL,
  `Id_Oficina` int(11) DEFAULT NULL,
  `Creado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Opcion_Predeterminada_Select`
--

CREATE TABLE `Opcion_Predeterminada_Select` (
  `Id_Opcion_Predeterminada_Select` int(11) NOT NULL,
  `Moneda_Que_Compra` varchar(10) NOT NULL,
  `Moneda_Que_Vende` varchar(10) NOT NULL,
  `Moneda_Que_Recibe` varchar(10) NOT NULL,
  `Moneda_Para_El_Cambio` varchar(10) NOT NULL,
  `Forma_Pago` varchar(10) NOT NULL,
  `Moneda_Traslado` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `OtroTraslado`
--

CREATE TABLE `OtroTraslado` (
  `Id` int(195) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Id_Cajero` int(11) NOT NULL,
  `Valor` varchar(255) NOT NULL,
  `Id_Moneda` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Pago_Cupo_Agente_Externo`
--

CREATE TABLE `Pago_Cupo_Agente_Externo` (
  `Id_Pago_Cupo_Agente_Externo` int(11) NOT NULL,
  `Id_Agente_Externo` int(11) DEFAULT NULL,
  `Valor` double(50,2) DEFAULT NULL,
  `Fecha` timestamp NULL DEFAULT current_timestamp(),
  `Estado` enum('Pendiente','Aprobado','Rechazado') COLLATE utf8_unicode_ci DEFAULT 'Pendiente',
  `Observacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Recibo` varchar(2500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Pago_Transfenecia`
--

CREATE TABLE `Pago_Transfenecia` (
  `Id_Pago_Transfenecia` int(11) NOT NULL,
  `Id_Consultor_Apertura_Cuenta` int(11) NOT NULL,
  `Fecha` timestamp NULL DEFAULT current_timestamp(),
  `Fecha_Devolucion` datetime DEFAULT NULL,
  `Id_Transferencia_Destino` int(10) DEFAULT NULL,
  `Cajero` varchar(100) DEFAULT NULL COMMENT 'Este campo es en realidad el id del funcionario(consultor) que paga la transferencia',
  `Id_Cuenta_Bancaria` varchar(30) NOT NULL COMMENT 'Esta es la cuenta de origen del pago realizado',
  `Codigo_Transferencia` varchar(30) NOT NULL,
  `Valor` float(10,2) DEFAULT NULL,
  `Devuelta` varchar(100) DEFAULT 'No'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Pago_Transferencia_Cuenta`
--

CREATE TABLE `Pago_Transferencia_Cuenta` (
  `Id_Pago_Transferencia_Cuenta` int(11) NOT NULL,
  `Id_Pago_Transferencia` int(11) NOT NULL,
  `Id_Cuenta_Destinatario` int(11) NOT NULL,
  `Fecha_Registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Pais`
--

CREATE TABLE `Pais` (
  `Id_Pais` int(11) NOT NULL,
  `Codigo` varchar(5) DEFAULT NULL,
  `Nombre` varchar(200) DEFAULT NULL,
  `Id_Moneda` int(11) NOT NULL,
  `Cantidad_Digitos_Inicial_Cuenta` int(11) NOT NULL,
  `Cantidad_Digitos_Cuenta` int(21) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Perfil`
--

CREATE TABLE `Perfil` (
  `Id_Perfil` int(11) NOT NULL,
  `Nombre` varchar(200) DEFAULT NULL,
  `Detalle` varchar(100) DEFAULT NULL,
  `Tablero` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Perfil_Funcionario`
--

CREATE TABLE `Perfil_Funcionario` (
  `Id_Perfil_Funcionario` int(11) NOT NULL,
  `Id_Perfil` int(11) DEFAULT NULL,
  `Identificacion_Funcionario` int(11) NOT NULL,
  `Titulo_Modulo` varchar(100) DEFAULT NULL,
  `Modulo` varchar(100) DEFAULT NULL,
  `Crear` varchar(10) DEFAULT NULL,
  `Editar` varchar(10) DEFAULT NULL,
  `Eliminar` varchar(10) DEFAULT NULL,
  `Ver` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Perfil_Permiso`
--

CREATE TABLE `Perfil_Permiso` (
  `Id_Perfil_Permiso` int(11) NOT NULL,
  `Id_Perfil` int(11) DEFAULT NULL,
  `Titulo_Modulo` varchar(100) DEFAULT NULL,
  `Modulo` varchar(100) DEFAULT NULL,
  `Crear` varchar(10) NOT NULL DEFAULT 'false',
  `Editar` varchar(10) NOT NULL DEFAULT 'false',
  `Eliminar` varchar(10) NOT NULL DEFAULT 'false',
  `Ver` varchar(100) NOT NULL DEFAULT 'false'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Recaudo`
--

CREATE TABLE `Recaudo` (
  `Codigo` varchar(191) NOT NULL,
  `Estado` varchar(255) NOT NULL,
  `Remitente` bigint(20) NOT NULL,
  `Recibido` varchar(255) NOT NULL,
  `Comision` varchar(255) NOT NULL,
  `Detalle` text NOT NULL,
  `Transferido` varchar(255) NOT NULL,
  `Funcionario` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Recaudo_Destinatario`
--

CREATE TABLE `Recaudo_Destinatario` (
  `id` int(11) NOT NULL,
  `Comision` varchar(255) NOT NULL,
  `Destinatario_Id` bigint(20) NOT NULL,
  `Recaudo_Id` bigint(20) NOT NULL,
  `Transferido` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Original` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Recibo`
--

CREATE TABLE `Recibo` (
  `Id_Recibo` int(11) NOT NULL,
  `Codigo` varchar(200) DEFAULT NULL,
  `Fecha` timestamp NULL DEFAULT current_timestamp(),
  `Identificacion_Funcionario` int(11) DEFAULT NULL,
  `Id_Oficina` int(11) DEFAULT NULL,
  `Id_Caja` int(11) DEFAULT NULL,
  `Id_Transferencia` int(11) DEFAULT NULL,
  `Tasa_Cambio` float(20,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Resumen_Movimiento`
--

CREATE TABLE `Resumen_Movimiento` (
  `Id_Resumen_Movimiento` int(11) NOT NULL,
  `Valor` text NOT NULL,
  `Moneda` text NOT NULL,
  `Tipo` text NOT NULL,
  `Modulo` text NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `Id_Diario` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Ruta_Funcionario`
--

CREATE TABLE `Ruta_Funcionario` (
  `Id_Ruta_Funcionario` int(11) NOT NULL,
  `Id_Funcionario` int(11) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `Latitud` varchar(50) NOT NULL,
  `Longitud` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Saldo_Cuenta`
--

CREATE TABLE `Saldo_Cuenta` (
  `Id_Saldo_Cuenta` int(11) NOT NULL,
  `Id_Cuenta_Bancaria` int(11) NOT NULL,
  `Saldo` bigint(20) DEFAULT NULL,
  `Fecha` date NOT NULL,
  `Hora` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Saldo_Moneda_Tercero`
--

CREATE TABLE `Saldo_Moneda_Tercero` (
  `Id_Saldo_Moneda` int(11) NOT NULL,
  `Id_Tercero_Credito` int(11) NOT NULL,
  `Id_Moneda` int(11) NOT NULL,
  `Valor_Bolsa` decimal(20,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Servicio`
--

CREATE TABLE `Servicio` (
  `Id_Servicio` int(11) NOT NULL,
  `Servicio_Externo` varchar(30) DEFAULT NULL,
  `Comision` int(11) DEFAULT NULL,
  `Valor` int(11) DEFAULT NULL,
  `Detalle` longtext CHARACTER SET utf8 DEFAULT NULL,
  `Fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `Codigo` varchar(100) DEFAULT NULL,
  `Estado` enum('Activo','Anulado','Pagado') CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT 'Activo',
  `Identificacion_Funcionario` text NOT NULL,
  `Id_Caja` int(11) DEFAULT NULL,
  `Id_Oficina` int(11) DEFAULT NULL,
  `Id_Moneda` int(11) NOT NULL DEFAULT 1,
  `Id_Funcionario_Destino` int(11) DEFAULT NULL,
  `Fecha_Pago` timestamp NULL DEFAULT NULL,
  `Documento` varchar(255) DEFAULT NULL,
  `locked` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `funcionario_locked` bigint(20) DEFAULT NULL,
  `evidence` varchar(50) DEFAULT NULL,
  `entrega` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Servicio_Comision`
--

CREATE TABLE `Servicio_Comision` (
  `Id_Servicio_Comision` int(11) NOT NULL,
  `Valor_Minimo` float(15,2) DEFAULT NULL,
  `Valor_Maximo` float(15,2) DEFAULT NULL,
  `Comision` float(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Servicio_Externo`
--

CREATE TABLE `Servicio_Externo` (
  `Id_Servicio_Externo` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Comision` int(100) NOT NULL,
  `Estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tercero`
--

CREATE TABLE `Tercero` (
  `Id_Tercero` varchar(11) NOT NULL DEFAULT '0',
  `Nombre` varchar(200) DEFAULT NULL,
  `Direccion` varchar(200) DEFAULT NULL,
  `Telefono` varchar(100) DEFAULT NULL,
  `Celular` varchar(15) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Tercero_Desde` date DEFAULT NULL,
  `Destacado` varchar(2) DEFAULT NULL,
  `Credito` varchar(2) DEFAULT NULL,
  `Cupo` bigint(11) DEFAULT NULL,
  `Cupo_Disponible` bigint(20) DEFAULT NULL,
  `Detalle` text DEFAULT NULL,
  `Id_Departamento` int(11) DEFAULT NULL,
  `Id_Municipio` int(11) DEFAULT NULL,
  `Id_Tipo_Documento` int(11) DEFAULT NULL,
  `Barrio` varchar(20) DEFAULT NULL,
  `Id_Grupo_Tercero` int(11) DEFAULT 0,
  `Tipo_Tercero` enum('Cliente','Proveedor','Corresponsal') NOT NULL,
  `Estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `Porcentaje_Recauda` double(50,2) DEFAULT NULL,
  `Recaudo` enum('Si','No') DEFAULT NULL,
  `Fecha_Registro` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tipo_Ajuste_Cuenta`
--

CREATE TABLE `Tipo_Ajuste_Cuenta` (
  `Id_Tipo_Ajuste_Cuenta` int(11) NOT NULL,
  `Descripcion_Ajuste` varchar(30) NOT NULL,
  `Fecha_Registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tipo_Cuenta`
--

CREATE TABLE `Tipo_Cuenta` (
  `Id_Tipo_Cuenta` int(11) NOT NULL,
  `Nombre` varchar(30) DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tipo_Documento`
--

CREATE TABLE `Tipo_Documento` (
  `Id_Tipo_Documento` int(11) NOT NULL,
  `Codigo` varchar(5) DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Estado` varchar(100) NOT NULL DEFAULT 'Activo',
  `Orden` int(11) NOT NULL,
  `Id_Pais` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tipo_Documento_Extranjero`
--

CREATE TABLE `Tipo_Documento_Extranjero` (
  `Id_Tipo_Documento_Extranjero` int(11) NOT NULL,
  `Codigo` varchar(5) DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Estado` varchar(100) NOT NULL DEFAULT 'Activo',
  `Orden` int(11) NOT NULL,
  `Id_Pais` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tipo_Movimiento_Bancario`
--

CREATE TABLE `Tipo_Movimiento_Bancario` (
  `Id_Tipo_Movimiento_Bancario` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tipo_Movimiento_Corresponsal`
--

CREATE TABLE `Tipo_Movimiento_Corresponsal` (
  `Id_Tipo_Movimiento_Corresponsal` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tipo_Movimiento_Tercero`
--

CREATE TABLE `Tipo_Movimiento_Tercero` (
  `Id_Tipo_Movimiento_Tercero` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Token_Permiso`
--

CREATE TABLE `Token_Permiso` (
  `Id_Token_Permiso` int(11) NOT NULL,
  `Token` varchar(10) NOT NULL,
  `Consumido_Por` int(11) NOT NULL,
  `Usado_Para` varchar(30) DEFAULT NULL,
  `Fecha_Registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Transferencia`
--

CREATE TABLE `Transferencia` (
  `Id_Transferencia` int(11) NOT NULL,
  `Codigo` varchar(45) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `Forma_Pago` varchar(45) NOT NULL,
  `Tipo_Transferencia` varchar(45) NOT NULL,
  `Moneda_Origen` varchar(45) NOT NULL DEFAULT 'Pesos',
  `Moneda_Destino` varchar(45) NOT NULL DEFAULT 'Bolivares',
  `Documento_Origen` varchar(45) DEFAULT NULL,
  `Observacion_Transferencia` text NOT NULL,
  `Estado` enum('Activa','Pagada','Anulada','') NOT NULL DEFAULT 'Activa',
  `Id_Cuenta_Bancaria` varchar(100) DEFAULT NULL,
  `Identificacion_Funcionario` varchar(100) DEFAULT NULL,
  `Cantidad_Recibida` text DEFAULT NULL COMMENT 'Valor en pesos',
  `Cantidad_Transferida` text DEFAULT NULL COMMENT 'Valor en moneda extranjera',
  `Cantidad_Recibida_Bolsa_Bolivares` bigint(20) NOT NULL COMMENT 'Aqui se guarda el monto de la bolsa de bolivares usados para una transferencia de credito, en caso de que se use bolsa',
  `Motivo_Anulacion` text DEFAULT NULL,
  `Id_Caja` int(11) DEFAULT NULL,
  `Id_Oficina` int(11) DEFAULT NULL,
  `Tasa_Cambio` double NOT NULL,
  `Tipo_Origen` enum('Tercero','Remitente') DEFAULT 'Remitente',
  `Tipo_Destino` enum('Destinatario','Tercero') NOT NULL DEFAULT 'Destinatario',
  `Alertada` varchar(11) DEFAULT NULL,
  `Agente_Externo` enum('Si','No') DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Transferencia_Destinatario`
--

CREATE TABLE `Transferencia_Destinatario` (
  `Id_Transferencia_Destinatario` int(11) NOT NULL,
  `Numero_Documento_Destino` varchar(100) DEFAULT NULL,
  `Id_Destinatario_Cuenta` int(11) DEFAULT NULL,
  `Valor_Transferencia_Bolivar` text DEFAULT NULL,
  `Id_Transferencia` int(11) NOT NULL,
  `Id_Recibo` int(100) DEFAULT NULL,
  `Id_Moneda` int(11) NOT NULL,
  `Valor_Transferencia` float(20,2) NOT NULL COMMENT 'Valor en moneda extranjera',
  `Estado` enum('Pendiente','Pagada','Anulada') NOT NULL DEFAULT 'Pendiente',
  `Bloqueada` tinytext DEFAULT NULL,
  `Seleccionada` tinyint(4) DEFAULT NULL,
  `Estado_Consultor` enum('Abierta','Cerrada') NOT NULL DEFAULT 'Cerrada',
  `Funcionario_Opera` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Transferencia_Remitente`
--

CREATE TABLE `Transferencia_Remitente` (
  `Id_Transferencia_Remitente` bigint(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Telefono` varchar(50) NOT NULL,
  `Estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Transferencia_Remitente_Externo`
--

CREATE TABLE `Transferencia_Remitente_Externo` (
  `Id_Transferencia_Remitente` bigint(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Telefono` varchar(50) NOT NULL,
  `Estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `Id_Agente_Externo` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Traslado`
--

CREATE TABLE `Traslado` (
  `Id_Traslado` int(11) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `Origen` varchar(45) NOT NULL,
  `Destino` varchar(45) NOT NULL,
  `Id_Origen` int(11) NOT NULL,
  `Id_Destino` int(11) NOT NULL,
  `Moneda` varchar(45) NOT NULL,
  `Valor` float(20,2) NOT NULL,
  `Estado` enum('Activo','Anulado') NOT NULL DEFAULT 'Activo',
  `Detalle` text NOT NULL,
  `Identificacion_Funcionario` int(11) NOT NULL,
  `Codigo` varchar(45) NOT NULL,
  `Id_Caja` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Traslado_Caja`
--

CREATE TABLE `Traslado_Caja` (
  `Id_Traslado_Caja` int(11) NOT NULL,
  `Funcionario_Destino` int(11) DEFAULT NULL,
  `Id_Cajero_Origen` int(11) DEFAULT NULL,
  `Valor` int(11) DEFAULT NULL,
  `Detalle` varchar(200) DEFAULT NULL,
  `Id_Moneda` int(11) NOT NULL,
  `Fecha_Traslado` timestamp NULL DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT NULL,
  `Estado` enum('Pendiente','Anulado','Aprobado','Negado') NOT NULL DEFAULT 'Pendiente',
  `Aprobado` varchar(100) DEFAULT NULL,
  `Codigo` varchar(100) NOT NULL,
  `Identificacion_Funcionario` text NOT NULL,
  `Alerta` varchar(100) NOT NULL DEFAULT 'Si',
  `Id_Caja` int(11) DEFAULT NULL,
  `Id_Oficina` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Valor_Moneda`
--

CREATE TABLE `Valor_Moneda` (
  `Id_Valor_Moneda` int(11) NOT NULL,
  `Id_Moneda` int(11) NOT NULL,
  `Min_Venta_Efectivo` decimal(50,0) NOT NULL DEFAULT 0,
  `Max_Venta_Efectivo` decimal(50,0) NOT NULL DEFAULT 0,
  `Sugerido_Venta_Efectivo` decimal(50,0) NOT NULL DEFAULT 0,
  `Min_Compra_Efectivo` decimal(50,0) NOT NULL DEFAULT 0,
  `Max_Compra_Efectivo` decimal(50,0) NOT NULL DEFAULT 0,
  `Sugerido_Compra_Efectivo` varchar(10) NOT NULL DEFAULT '00',
  `Min_Venta_Transferencia` float(50,0) NOT NULL DEFAULT 0,
  `Max_Venta_Transferencia` float(50,0) DEFAULT 0,
  `Sugerido_Venta_Transferencia` float(50,0) NOT NULL DEFAULT 0,
  `Costo_Transferencia` decimal(50,0) NOT NULL DEFAULT 0,
  `Comision_Efectivo_Transferencia` decimal(50,0) NOT NULL DEFAULT 0,
  `Pagar_Comision_Desde` decimal(50,0) NOT NULL DEFAULT 0,
  `Min_No_Cobro_Transferencia` decimal(50,0) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Abono_Compra`
--
ALTER TABLE `Abono_Compra`
  ADD PRIMARY KEY (`Id_Abono_Compra`);

--
-- Indexes for table `Agente_Externo`
--
ALTER TABLE `Agente_Externo`
  ADD PRIMARY KEY (`Id_Agente_Externo`);

--
-- Indexes for table `Alerta`
--
ALTER TABLE `Alerta`
  ADD PRIMARY KEY (`Id_Alerta`);

--
-- Indexes for table `Banco`
--
ALTER TABLE `Banco`
  ADD PRIMARY KEY (`Id_Banco`);

--
-- Indexes for table `Bloqueo_Cuenta_Bancaria_Funcionario`
--
ALTER TABLE `Bloqueo_Cuenta_Bancaria_Funcionario`
  ADD PRIMARY KEY (`Id_Bloqueo_Cuenta_Bancaria_Funcionario`);

--
-- Indexes for table `Bloqueo_Transferencia_Funcionario`
--
ALTER TABLE `Bloqueo_Transferencia_Funcionario`
  ADD PRIMARY KEY (`Id_Bloqueo_Transferencia_Funcionario`);

--
-- Indexes for table `Bolsa_Bolivares_Tercero`
--
ALTER TABLE `Bolsa_Bolivares_Tercero`
  ADD PRIMARY KEY (`Id_Bolsa_Bolivares_Tercero`);

--
-- Indexes for table `Caja`
--
ALTER TABLE `Caja`
  ADD PRIMARY KEY (`Id_Caja`),
  ADD UNIQUE KEY `MAC` (`MAC`);

--
-- Indexes for table `Caja_Recaudos`
--
ALTER TABLE `Caja_Recaudos`
  ADD PRIMARY KEY (`Id_Caja_Recaudos`);

--
-- Indexes for table `Cajero_Oficina`
--
ALTER TABLE `Cajero_Oficina`
  ADD PRIMARY KEY (`Id_Cajero_Oficina`);

--
-- Indexes for table `Cajero_Principal_Oficina`
--
ALTER TABLE `Cajero_Principal_Oficina`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Cambio`
--
ALTER TABLE `Cambio`
  ADD PRIMARY KEY (`Id_Cambio`);
ALTER TABLE `Cambio` ADD FULLTEXT KEY `Observacion` (`Observacion`);

--
-- Indexes for table `Cargo`
--
ALTER TABLE `Cargo`
  ADD PRIMARY KEY (`Id_Cargo`);

--
-- Indexes for table `Compra`
--
ALTER TABLE `Compra`
  ADD PRIMARY KEY (`Id_Compra`);

--
-- Indexes for table `Compra_Cuenta`
--
ALTER TABLE `Compra_Cuenta`
  ADD PRIMARY KEY (`Id_Compra_Cuenta`);

--
-- Indexes for table `Configuracion`
--
ALTER TABLE `Configuracion`
  ADD PRIMARY KEY (`Id_Configuracion`);

--
-- Indexes for table `Consultor_Apertura_Cuenta`
--
ALTER TABLE `Consultor_Apertura_Cuenta`
  ADD PRIMARY KEY (`Id_Consultor_Apertura_Cuenta`);

--
-- Indexes for table `Consultor_Cierre_Cuenta`
--
ALTER TABLE `Consultor_Cierre_Cuenta`
  ADD PRIMARY KEY (`Id_Consultor_Cierre_Cuenta`);

--
-- Indexes for table `Corresponsal_Bancario`
--
ALTER TABLE `Corresponsal_Bancario`
  ADD PRIMARY KEY (`Id_Corresponsal_Bancario`);

--
-- Indexes for table `Corresponsal_Diario`
--
ALTER TABLE `Corresponsal_Diario`
  ADD PRIMARY KEY (`Id_Corresponsal_Diario`);

--
-- Indexes for table `Corresponsal_Diario_Nuevo`
--
ALTER TABLE `Corresponsal_Diario_Nuevo`
  ADD PRIMARY KEY (`Id_Corresponsal_Diario`);

--
-- Indexes for table `Cuenta_Bancaria`
--
ALTER TABLE `Cuenta_Bancaria`
  ADD PRIMARY KEY (`Id_Cuenta_Bancaria`);

--
-- Indexes for table `Cuenta_Bancaria_Apertura`
--
ALTER TABLE `Cuenta_Bancaria_Apertura`
  ADD PRIMARY KEY (`Id_Cuenta_Bancaria_Apertura`);

--
-- Indexes for table `Cuenta_Bancaria_Cierre`
--
ALTER TABLE `Cuenta_Bancaria_Cierre`
  ADD PRIMARY KEY (`Id_Cuenta_Bancaria_Cierre`);

--
-- Indexes for table `Departamento`
--
ALTER TABLE `Departamento`
  ADD PRIMARY KEY (`Id_Departamento`);

--
-- Indexes for table `Dependencia`
--
ALTER TABLE `Dependencia`
  ADD PRIMARY KEY (`Id_Dependencia`);

--
-- Indexes for table `Destinatario`
--
ALTER TABLE `Destinatario`
  ADD PRIMARY KEY (`Id_Destinatario`);

--
-- Indexes for table `Destinatario_Cuenta`
--
ALTER TABLE `Destinatario_Cuenta`
  ADD PRIMARY KEY (`Id_Destinatario_Cuenta`);

--
-- Indexes for table `Destinatario_Cuenta_Externo`
--
ALTER TABLE `Destinatario_Cuenta_Externo`
  ADD PRIMARY KEY (`Id_Destinatario_Cuenta`);

--
-- Indexes for table `Destinatario_Externo`
--
ALTER TABLE `Destinatario_Externo`
  ADD PRIMARY KEY (`Id_Destinatario`);

--
-- Indexes for table `Devolucion_Cambios`
--
ALTER TABLE `Devolucion_Cambios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Devolucion_Compra`
--
ALTER TABLE `Devolucion_Compra`
  ADD PRIMARY KEY (`Id_Devolucion_Compra`);

--
-- Indexes for table `Devolucion_Transferencia`
--
ALTER TABLE `Devolucion_Transferencia`
  ADD PRIMARY KEY (`Id_Devolucion_Transferencia`);

--
-- Indexes for table `Diario`
--
ALTER TABLE `Diario`
  ADD PRIMARY KEY (`Id_Diario`);

--
-- Indexes for table `Diario_Consultor`
--
ALTER TABLE `Diario_Consultor`
  ADD PRIMARY KEY (`Id_Diario_Consultor`);

--
-- Indexes for table `Diario_Cuenta`
--
ALTER TABLE `Diario_Cuenta`
  ADD PRIMARY KEY (`Id_Diario_Cuenta`);

--
-- Indexes for table `Diario_Moneda_Apertura`
--
ALTER TABLE `Diario_Moneda_Apertura`
  ADD PRIMARY KEY (`Id_Diario_Moneda_Apertura`);

--
-- Indexes for table `Diario_Moneda_Cierre`
--
ALTER TABLE `Diario_Moneda_Cierre`
  ADD PRIMARY KEY (`Id_Diario_Moneda_Cierre`);

--
-- Indexes for table `Direcciones_Mac`
--
ALTER TABLE `Direcciones_Mac`
  ADD PRIMARY KEY (`MAC`);

--
-- Indexes for table `Egreso`
--
ALTER TABLE `Egreso`
  ADD PRIMARY KEY (`Id_Egreso`);

--
-- Indexes for table `fomapagos`
--
ALTER TABLE `fomapagos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Funcionario`
--
ALTER TABLE `Funcionario`
  ADD PRIMARY KEY (`Identificacion_Funcionario`),
  ADD KEY `id_Municipio` (`Lugar_Nacimiento`);

--
-- Indexes for table `Funcionario_Contacto_Emergencia`
--
ALTER TABLE `Funcionario_Contacto_Emergencia`
  ADD PRIMARY KEY (`Identificacion_Funcionario_Contacto_Emergencia`),
  ADD KEY `Identificacion_Funcionario` (`Identificacion_Funcionario`);

--
-- Indexes for table `Funcionario_Cuenta_Bancaria`
--
ALTER TABLE `Funcionario_Cuenta_Bancaria`
  ADD PRIMARY KEY (`Id_Funcionario_Cuenta_Bancaria`);

--
-- Indexes for table `Funcionario_Experiencia_Laboral`
--
ALTER TABLE `Funcionario_Experiencia_Laboral`
  ADD PRIMARY KEY (`id_Funcionario_Experiencia_Laboral`),
  ADD KEY `Identificacion_Funcionario` (`Identificacion_Funcionario`);

--
-- Indexes for table `Funcionario_Modulo`
--
ALTER TABLE `Funcionario_Modulo`
  ADD PRIMARY KEY (`Id_Funcionario_Modulo`);

--
-- Indexes for table `Funcionario_Referencia_Personal`
--
ALTER TABLE `Funcionario_Referencia_Personal`
  ADD PRIMARY KEY (`id_Funcionario_Referencias`),
  ADD KEY `Identificacion_Funcionario` (`Identificacion_Funcionario`);

--
-- Indexes for table `Giro`
--
ALTER TABLE `Giro`
  ADD PRIMARY KEY (`Id_Giro`);

--
-- Indexes for table `Giro_Comision`
--
ALTER TABLE `Giro_Comision`
  ADD PRIMARY KEY (`Id_Giro_Comision`);

--
-- Indexes for table `Giro_Destinatario`
--
ALTER TABLE `Giro_Destinatario`
  ADD PRIMARY KEY (`Documento_Destinatario`);

--
-- Indexes for table `Giro_Remitente`
--
ALTER TABLE `Giro_Remitente`
  ADD PRIMARY KEY (`Documento_Remitente`);

--
-- Indexes for table `Grupo`
--
ALTER TABLE `Grupo`
  ADD PRIMARY KEY (`Id_Grupo`);

--
-- Indexes for table `Grupo_Tercero`
--
ALTER TABLE `Grupo_Tercero`
  ADD PRIMARY KEY (`Id_Grupo_Tercero`);

--
-- Indexes for table `Grupo_Tercero_Nuevo`
--
ALTER TABLE `Grupo_Tercero_Nuevo`
  ADD PRIMARY KEY (`Id_Grupo_Tercero`),
  ADD UNIQUE KEY `Nombre_Grupo` (`Nombre_Grupo`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Log_Sistema`
--
ALTER TABLE `Log_Sistema`
  ADD PRIMARY KEY (`Id_Log_Sistema`);

--
-- Indexes for table `Modulo`
--
ALTER TABLE `Modulo`
  ADD PRIMARY KEY (`Id_Modulo`),
  ADD UNIQUE KEY `Nombre_Modulo` (`Nombre_Modulo`),
  ADD UNIQUE KEY `Codigo` (`Codigo`);

--
-- Indexes for table `Moneda`
--
ALTER TABLE `Moneda`
  ADD PRIMARY KEY (`Id_Moneda`);

--
-- Indexes for table `Moneda_Campo`
--
ALTER TABLE `Moneda_Campo`
  ADD PRIMARY KEY (`Id_Moneda_Campo`);

--
-- Indexes for table `Moneda_Cuenta_Apertura`
--
ALTER TABLE `Moneda_Cuenta_Apertura`
  ADD PRIMARY KEY (`Id_Moneda_Cuenta_Apertura`);

--
-- Indexes for table `Moneda_Cuenta_Cierre`
--
ALTER TABLE `Moneda_Cuenta_Cierre`
  ADD PRIMARY KEY (`Id_Moneda_Cierre_Cuenta`);

--
-- Indexes for table `Moneda_Oficina`
--
ALTER TABLE `Moneda_Oficina`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Moneda_Valor`
--
ALTER TABLE `Moneda_Valor`
  ADD PRIMARY KEY (`Id_Moneda_Valor`);

--
-- Indexes for table `Motivo_Devolucion_Cambios`
--
ALTER TABLE `Motivo_Devolucion_Cambios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Motivo_Devolucion_Transferencia`
--
ALTER TABLE `Motivo_Devolucion_Transferencia`
  ADD PRIMARY KEY (`Id_Motivo_Devolucion_Transferencia`);

--
-- Indexes for table `Movimiento_Cuenta_Bancaria`
--
ALTER TABLE `Movimiento_Cuenta_Bancaria`
  ADD PRIMARY KEY (`Id_Movimiento_Cuenta_Bancaria`);

--
-- Indexes for table `Movimiento_Tercero`
--
ALTER TABLE `Movimiento_Tercero`
  ADD PRIMARY KEY (`Id_Movimiento_Tercero`);

--
-- Indexes for table `Municipio`
--
ALTER TABLE `Municipio`
  ADD PRIMARY KEY (`Id_Municipio`);

--
-- Indexes for table `Oficina`
--
ALTER TABLE `Oficina`
  ADD PRIMARY KEY (`Id_Oficina`);

--
-- Indexes for table `Oficina_Moneda`
--
ALTER TABLE `Oficina_Moneda`
  ADD PRIMARY KEY (`Id_Oficina_Moneda`);

--
-- Indexes for table `Opcion_Predeterminada_Select`
--
ALTER TABLE `Opcion_Predeterminada_Select`
  ADD PRIMARY KEY (`Id_Opcion_Predeterminada_Select`);

--
-- Indexes for table `OtroTraslado`
--
ALTER TABLE `OtroTraslado`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Pago_Cupo_Agente_Externo`
--
ALTER TABLE `Pago_Cupo_Agente_Externo`
  ADD PRIMARY KEY (`Id_Pago_Cupo_Agente_Externo`);

--
-- Indexes for table `Pago_Transfenecia`
--
ALTER TABLE `Pago_Transfenecia`
  ADD PRIMARY KEY (`Id_Pago_Transfenecia`);

--
-- Indexes for table `Pago_Transferencia_Cuenta`
--
ALTER TABLE `Pago_Transferencia_Cuenta`
  ADD PRIMARY KEY (`Id_Pago_Transferencia_Cuenta`);

--
-- Indexes for table `Pais`
--
ALTER TABLE `Pais`
  ADD PRIMARY KEY (`Id_Pais`);

--
-- Indexes for table `Perfil`
--
ALTER TABLE `Perfil`
  ADD PRIMARY KEY (`Id_Perfil`);

--
-- Indexes for table `Perfil_Funcionario`
--
ALTER TABLE `Perfil_Funcionario`
  ADD PRIMARY KEY (`Id_Perfil_Funcionario`);

--
-- Indexes for table `Perfil_Permiso`
--
ALTER TABLE `Perfil_Permiso`
  ADD PRIMARY KEY (`Id_Perfil_Permiso`);

--
-- Indexes for table `Recaudo`
--
ALTER TABLE `Recaudo`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `Recaudo_Destinatario`
--
ALTER TABLE `Recaudo_Destinatario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Recibo`
--
ALTER TABLE `Recibo`
  ADD PRIMARY KEY (`Id_Recibo`),
  ADD UNIQUE KEY `Codigo` (`Codigo`);

--
-- Indexes for table `Resumen_Movimiento`
--
ALTER TABLE `Resumen_Movimiento`
  ADD PRIMARY KEY (`Id_Resumen_Movimiento`);

--
-- Indexes for table `Ruta_Funcionario`
--
ALTER TABLE `Ruta_Funcionario`
  ADD PRIMARY KEY (`Id_Ruta_Funcionario`);

--
-- Indexes for table `Saldo_Cuenta`
--
ALTER TABLE `Saldo_Cuenta`
  ADD PRIMARY KEY (`Id_Saldo_Cuenta`);

--
-- Indexes for table `Saldo_Moneda_Tercero`
--
ALTER TABLE `Saldo_Moneda_Tercero`
  ADD PRIMARY KEY (`Id_Saldo_Moneda`);

--
-- Indexes for table `Servicio`
--
ALTER TABLE `Servicio`
  ADD PRIMARY KEY (`Id_Servicio`);

--
-- Indexes for table `Servicio_Comision`
--
ALTER TABLE `Servicio_Comision`
  ADD PRIMARY KEY (`Id_Servicio_Comision`);

--
-- Indexes for table `Servicio_Externo`
--
ALTER TABLE `Servicio_Externo`
  ADD PRIMARY KEY (`Id_Servicio_Externo`);

--
-- Indexes for table `Tercero`
--
ALTER TABLE `Tercero`
  ADD PRIMARY KEY (`Id_Tercero`),
  ADD KEY `Id_Tercero` (`Id_Tercero`);

--
-- Indexes for table `Tipo_Ajuste_Cuenta`
--
ALTER TABLE `Tipo_Ajuste_Cuenta`
  ADD PRIMARY KEY (`Id_Tipo_Ajuste_Cuenta`);

--
-- Indexes for table `Tipo_Cuenta`
--
ALTER TABLE `Tipo_Cuenta`
  ADD PRIMARY KEY (`Id_Tipo_Cuenta`);

--
-- Indexes for table `Tipo_Documento`
--
ALTER TABLE `Tipo_Documento`
  ADD PRIMARY KEY (`Id_Tipo_Documento`);

--
-- Indexes for table `Tipo_Documento_Extranjero`
--
ALTER TABLE `Tipo_Documento_Extranjero`
  ADD PRIMARY KEY (`Id_Tipo_Documento_Extranjero`);

--
-- Indexes for table `Tipo_Movimiento_Bancario`
--
ALTER TABLE `Tipo_Movimiento_Bancario`
  ADD PRIMARY KEY (`Id_Tipo_Movimiento_Bancario`);

--
-- Indexes for table `Tipo_Movimiento_Corresponsal`
--
ALTER TABLE `Tipo_Movimiento_Corresponsal`
  ADD PRIMARY KEY (`Id_Tipo_Movimiento_Corresponsal`);

--
-- Indexes for table `Tipo_Movimiento_Tercero`
--
ALTER TABLE `Tipo_Movimiento_Tercero`
  ADD PRIMARY KEY (`Id_Tipo_Movimiento_Tercero`);

--
-- Indexes for table `Token_Permiso`
--
ALTER TABLE `Token_Permiso`
  ADD PRIMARY KEY (`Id_Token_Permiso`);

--
-- Indexes for table `Transferencia`
--
ALTER TABLE `Transferencia`
  ADD PRIMARY KEY (`Id_Transferencia`);

--
-- Indexes for table `Transferencia_Destinatario`
--
ALTER TABLE `Transferencia_Destinatario`
  ADD PRIMARY KEY (`Id_Transferencia_Destinatario`),
  ADD KEY `Valor_Transferencia` (`Valor_Transferencia`);

--
-- Indexes for table `Transferencia_Remitente`
--
ALTER TABLE `Transferencia_Remitente`
  ADD PRIMARY KEY (`Id_Transferencia_Remitente`);

--
-- Indexes for table `Transferencia_Remitente_Externo`
--
ALTER TABLE `Transferencia_Remitente_Externo`
  ADD PRIMARY KEY (`Id_Transferencia_Remitente`);

--
-- Indexes for table `Traslado`
--
ALTER TABLE `Traslado`
  ADD PRIMARY KEY (`Id_Traslado`);

--
-- Indexes for table `Traslado_Caja`
--
ALTER TABLE `Traslado_Caja`
  ADD PRIMARY KEY (`Id_Traslado_Caja`);

--
-- Indexes for table `Valor_Moneda`
--
ALTER TABLE `Valor_Moneda`
  ADD PRIMARY KEY (`Id_Valor_Moneda`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Abono_Compra`
--
ALTER TABLE `Abono_Compra`
  MODIFY `Id_Abono_Compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Agente_Externo`
--
ALTER TABLE `Agente_Externo`
  MODIFY `Id_Agente_Externo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Alerta`
--
ALTER TABLE `Alerta`
  MODIFY `Id_Alerta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Banco`
--
ALTER TABLE `Banco`
  MODIFY `Id_Banco` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Bloqueo_Cuenta_Bancaria_Funcionario`
--
ALTER TABLE `Bloqueo_Cuenta_Bancaria_Funcionario`
  MODIFY `Id_Bloqueo_Cuenta_Bancaria_Funcionario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Bloqueo_Transferencia_Funcionario`
--
ALTER TABLE `Bloqueo_Transferencia_Funcionario`
  MODIFY `Id_Bloqueo_Transferencia_Funcionario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Bolsa_Bolivares_Tercero`
--
ALTER TABLE `Bolsa_Bolivares_Tercero`
  MODIFY `Id_Bolsa_Bolivares_Tercero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Caja`
--
ALTER TABLE `Caja`
  MODIFY `Id_Caja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Caja_Recaudos`
--
ALTER TABLE `Caja_Recaudos`
  MODIFY `Id_Caja_Recaudos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Cajero_Oficina`
--
ALTER TABLE `Cajero_Oficina`
  MODIFY `Id_Cajero_Oficina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Cajero_Principal_Oficina`
--
ALTER TABLE `Cajero_Principal_Oficina`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Cambio`
--
ALTER TABLE `Cambio`
  MODIFY `Id_Cambio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Cargo`
--
ALTER TABLE `Cargo`
  MODIFY `Id_Cargo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Compra`
--
ALTER TABLE `Compra`
  MODIFY `Id_Compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Compra_Cuenta`
--
ALTER TABLE `Compra_Cuenta`
  MODIFY `Id_Compra_Cuenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Consultor_Apertura_Cuenta`
--
ALTER TABLE `Consultor_Apertura_Cuenta`
  MODIFY `Id_Consultor_Apertura_Cuenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Consultor_Cierre_Cuenta`
--
ALTER TABLE `Consultor_Cierre_Cuenta`
  MODIFY `Id_Consultor_Cierre_Cuenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Corresponsal_Bancario`
--
ALTER TABLE `Corresponsal_Bancario`
  MODIFY `Id_Corresponsal_Bancario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Corresponsal_Diario`
--
ALTER TABLE `Corresponsal_Diario`
  MODIFY `Id_Corresponsal_Diario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Corresponsal_Diario_Nuevo`
--
ALTER TABLE `Corresponsal_Diario_Nuevo`
  MODIFY `Id_Corresponsal_Diario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Cuenta_Bancaria`
--
ALTER TABLE `Cuenta_Bancaria`
  MODIFY `Id_Cuenta_Bancaria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Cuenta_Bancaria_Apertura`
--
ALTER TABLE `Cuenta_Bancaria_Apertura`
  MODIFY `Id_Cuenta_Bancaria_Apertura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Cuenta_Bancaria_Cierre`
--
ALTER TABLE `Cuenta_Bancaria_Cierre`
  MODIFY `Id_Cuenta_Bancaria_Cierre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Departamento`
--
ALTER TABLE `Departamento`
  MODIFY `Id_Departamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Dependencia`
--
ALTER TABLE `Dependencia`
  MODIFY `Id_Dependencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Destinatario_Cuenta`
--
ALTER TABLE `Destinatario_Cuenta`
  MODIFY `Id_Destinatario_Cuenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Destinatario_Cuenta_Externo`
--
ALTER TABLE `Destinatario_Cuenta_Externo`
  MODIFY `Id_Destinatario_Cuenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Devolucion_Cambios`
--
ALTER TABLE `Devolucion_Cambios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Devolucion_Compra`
--
ALTER TABLE `Devolucion_Compra`
  MODIFY `Id_Devolucion_Compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Devolucion_Transferencia`
--
ALTER TABLE `Devolucion_Transferencia`
  MODIFY `Id_Devolucion_Transferencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Diario`
--
ALTER TABLE `Diario`
  MODIFY `Id_Diario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Diario_Consultor`
--
ALTER TABLE `Diario_Consultor`
  MODIFY `Id_Diario_Consultor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Diario_Cuenta`
--
ALTER TABLE `Diario_Cuenta`
  MODIFY `Id_Diario_Cuenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Diario_Moneda_Apertura`
--
ALTER TABLE `Diario_Moneda_Apertura`
  MODIFY `Id_Diario_Moneda_Apertura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Diario_Moneda_Cierre`
--
ALTER TABLE `Diario_Moneda_Cierre`
  MODIFY `Id_Diario_Moneda_Cierre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Egreso`
--
ALTER TABLE `Egreso`
  MODIFY `Id_Egreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fomapagos`
--
ALTER TABLE `fomapagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Funcionario_Contacto_Emergencia`
--
ALTER TABLE `Funcionario_Contacto_Emergencia`
  MODIFY `Identificacion_Funcionario_Contacto_Emergencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Funcionario_Cuenta_Bancaria`
--
ALTER TABLE `Funcionario_Cuenta_Bancaria`
  MODIFY `Id_Funcionario_Cuenta_Bancaria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Funcionario_Experiencia_Laboral`
--
ALTER TABLE `Funcionario_Experiencia_Laboral`
  MODIFY `id_Funcionario_Experiencia_Laboral` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Funcionario_Modulo`
--
ALTER TABLE `Funcionario_Modulo`
  MODIFY `Id_Funcionario_Modulo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Funcionario_Referencia_Personal`
--
ALTER TABLE `Funcionario_Referencia_Personal`
  MODIFY `id_Funcionario_Referencias` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Giro`
--
ALTER TABLE `Giro`
  MODIFY `Id_Giro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Giro_Comision`
--
ALTER TABLE `Giro_Comision`
  MODIFY `Id_Giro_Comision` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Grupo`
--
ALTER TABLE `Grupo`
  MODIFY `Id_Grupo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Grupo_Tercero`
--
ALTER TABLE `Grupo_Tercero`
  MODIFY `Id_Grupo_Tercero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Grupo_Tercero_Nuevo`
--
ALTER TABLE `Grupo_Tercero_Nuevo`
  MODIFY `Id_Grupo_Tercero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Log_Sistema`
--
ALTER TABLE `Log_Sistema`
  MODIFY `Id_Log_Sistema` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Modulo`
--
ALTER TABLE `Modulo`
  MODIFY `Id_Modulo` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Moneda`
--
ALTER TABLE `Moneda`
  MODIFY `Id_Moneda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Moneda_Campo`
--
ALTER TABLE `Moneda_Campo`
  MODIFY `Id_Moneda_Campo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Moneda_Cuenta_Apertura`
--
ALTER TABLE `Moneda_Cuenta_Apertura`
  MODIFY `Id_Moneda_Cuenta_Apertura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Moneda_Cuenta_Cierre`
--
ALTER TABLE `Moneda_Cuenta_Cierre`
  MODIFY `Id_Moneda_Cierre_Cuenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Moneda_Oficina`
--
ALTER TABLE `Moneda_Oficina`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Moneda_Valor`
--
ALTER TABLE `Moneda_Valor`
  MODIFY `Id_Moneda_Valor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Motivo_Devolucion_Cambios`
--
ALTER TABLE `Motivo_Devolucion_Cambios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Motivo_Devolucion_Transferencia`
--
ALTER TABLE `Motivo_Devolucion_Transferencia`
  MODIFY `Id_Motivo_Devolucion_Transferencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Movimiento_Cuenta_Bancaria`
--
ALTER TABLE `Movimiento_Cuenta_Bancaria`
  MODIFY `Id_Movimiento_Cuenta_Bancaria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Movimiento_Tercero`
--
ALTER TABLE `Movimiento_Tercero`
  MODIFY `Id_Movimiento_Tercero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Municipio`
--
ALTER TABLE `Municipio`
  MODIFY `Id_Municipio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Oficina`
--
ALTER TABLE `Oficina`
  MODIFY `Id_Oficina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Oficina_Moneda`
--
ALTER TABLE `Oficina_Moneda`
  MODIFY `Id_Oficina_Moneda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Opcion_Predeterminada_Select`
--
ALTER TABLE `Opcion_Predeterminada_Select`
  MODIFY `Id_Opcion_Predeterminada_Select` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `OtroTraslado`
--
ALTER TABLE `OtroTraslado`
  MODIFY `Id` int(195) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Pago_Cupo_Agente_Externo`
--
ALTER TABLE `Pago_Cupo_Agente_Externo`
  MODIFY `Id_Pago_Cupo_Agente_Externo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Pago_Transfenecia`
--
ALTER TABLE `Pago_Transfenecia`
  MODIFY `Id_Pago_Transfenecia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Pago_Transferencia_Cuenta`
--
ALTER TABLE `Pago_Transferencia_Cuenta`
  MODIFY `Id_Pago_Transferencia_Cuenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Pais`
--
ALTER TABLE `Pais`
  MODIFY `Id_Pais` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Perfil`
--
ALTER TABLE `Perfil`
  MODIFY `Id_Perfil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Perfil_Funcionario`
--
ALTER TABLE `Perfil_Funcionario`
  MODIFY `Id_Perfil_Funcionario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Perfil_Permiso`
--
ALTER TABLE `Perfil_Permiso`
  MODIFY `Id_Perfil_Permiso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Recaudo`
--
ALTER TABLE `Recaudo`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Recaudo_Destinatario`
--
ALTER TABLE `Recaudo_Destinatario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Recibo`
--
ALTER TABLE `Recibo`
  MODIFY `Id_Recibo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Resumen_Movimiento`
--
ALTER TABLE `Resumen_Movimiento`
  MODIFY `Id_Resumen_Movimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Ruta_Funcionario`
--
ALTER TABLE `Ruta_Funcionario`
  MODIFY `Id_Ruta_Funcionario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Saldo_Cuenta`
--
ALTER TABLE `Saldo_Cuenta`
  MODIFY `Id_Saldo_Cuenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Saldo_Moneda_Tercero`
--
ALTER TABLE `Saldo_Moneda_Tercero`
  MODIFY `Id_Saldo_Moneda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Servicio`
--
ALTER TABLE `Servicio`
  MODIFY `Id_Servicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Servicio_Comision`
--
ALTER TABLE `Servicio_Comision`
  MODIFY `Id_Servicio_Comision` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Servicio_Externo`
--
ALTER TABLE `Servicio_Externo`
  MODIFY `Id_Servicio_Externo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Tipo_Ajuste_Cuenta`
--
ALTER TABLE `Tipo_Ajuste_Cuenta`
  MODIFY `Id_Tipo_Ajuste_Cuenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Tipo_Cuenta`
--
ALTER TABLE `Tipo_Cuenta`
  MODIFY `Id_Tipo_Cuenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Tipo_Documento`
--
ALTER TABLE `Tipo_Documento`
  MODIFY `Id_Tipo_Documento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Tipo_Documento_Extranjero`
--
ALTER TABLE `Tipo_Documento_Extranjero`
  MODIFY `Id_Tipo_Documento_Extranjero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Tipo_Movimiento_Bancario`
--
ALTER TABLE `Tipo_Movimiento_Bancario`
  MODIFY `Id_Tipo_Movimiento_Bancario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Tipo_Movimiento_Corresponsal`
--
ALTER TABLE `Tipo_Movimiento_Corresponsal`
  MODIFY `Id_Tipo_Movimiento_Corresponsal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Tipo_Movimiento_Tercero`
--
ALTER TABLE `Tipo_Movimiento_Tercero`
  MODIFY `Id_Tipo_Movimiento_Tercero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Token_Permiso`
--
ALTER TABLE `Token_Permiso`
  MODIFY `Id_Token_Permiso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Transferencia`
--
ALTER TABLE `Transferencia`
  MODIFY `Id_Transferencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Transferencia_Destinatario`
--
ALTER TABLE `Transferencia_Destinatario`
  MODIFY `Id_Transferencia_Destinatario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Traslado`
--
ALTER TABLE `Traslado`
  MODIFY `Id_Traslado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Traslado_Caja`
--
ALTER TABLE `Traslado_Caja`
  MODIFY `Id_Traslado_Caja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Valor_Moneda`
--
ALTER TABLE `Valor_Moneda`
  MODIFY `Id_Valor_Moneda` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Funcionario_Contacto_Emergencia`
--
ALTER TABLE `Funcionario_Contacto_Emergencia`
  ADD CONSTRAINT `Funcionario_Contacto_Emergencia_ibfk_1` FOREIGN KEY (`Identificacion_Funcionario`) REFERENCES `Funcionario` (`Identificacion_Funcionario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
