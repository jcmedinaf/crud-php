/*
=====================================================================
ARCHIVO: db.sql
DESCRIPCIÓN: Estructura normalizada de la base de datos y datos de prueba.
PROYECTO: crud-php (Fines educativos)
AUTOR: Juan Carlos Medina
=====================================================================
*/

-- 1. Creación e inicialización de la base de datos
CREATE DATABASE IF NOT EXISTS `crud-php` 
  DEFAULT CHARACTER SET utf8mb4 
  COLLATE utf8mb4_unicode_ci;

USE `crud-php`;

-- --------------------------------------------------------

-- 2. Estructura de la tabla `puestos`
DROP TABLE IF EXISTS `empleados`;
DROP TABLE IF EXISTS `puestos`;

CREATE TABLE IF NOT EXISTS `puestos` (
  `idPuesto` INT AUTO_INCREMENT PRIMARY KEY,
  `puesto` VARCHAR(50) NOT NULL UNIQUE,
  `creado_el` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcado de datos iniciales para `puestos`
INSERT INTO `puestos` (`idPuesto`, `puesto`) VALUES
(1, 'Jefe de Departamento'),
(2, 'Líder de Proyectos'),
(3, 'Desarrollador de Software');

-- --------------------------------------------------------

-- 3. Estructura de la tabla `empleados`
CREATE TABLE IF NOT EXISTS `empleados` (
  `idEmpleado` INT AUTO_INCREMENT PRIMARY KEY,
  `primer_nombre` VARCHAR(50) NOT NULL,
  `segundo_nombre` VARCHAR(50) DEFAULT NULL,
  `primer_apellido` VARCHAR(50) NOT NULL,
  `segundo_apellido` VARCHAR(50) DEFAULT NULL,
  `foto` VARCHAR(255) DEFAULT NULL,
  `cv` VARCHAR(255) DEFAULT NULL,
  `idPuesto` INT NOT NULL,
  `fecha_ingreso` DATE NOT NULL,
  `creado_el` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT `fk_empleados_puestos`
    FOREIGN KEY (`idPuesto`) 
    REFERENCES `puestos` (`idPuesto`) 
    ON DELETE RESTRICT 
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcado de datos iniciales para `empleados`
INSERT INTO `empleados` (`idEmpleado`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `foto`, `cv`, `idPuesto`, `fecha_ingreso`) VALUES
(1, 'Juan', 'Carlos', 'Medina', 'Flores', '1695038083_Juan Carlos Medina.JPG', '1695038083_CV_Juan_Medina.pdf', 1, '2015-09-18');

-- --------------------------------------------------------

-- 4. Estructura de la tabla `usuarios`
DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(50) NOT NULL,
  `apellido` VARCHAR(50) NOT NULL,
  `correo` VARCHAR(100) NOT NULL UNIQUE,
  `clave` VARCHAR(255) NOT NULL,
  `creado_el` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcado de datos iniciales para `usuarios`
-- NOTA: La clave se mantiene en texto plano para compatibilidad inicial, 
-- pero se recomienda cifrarla con password_hash() en la lógica PHP de producción.
INSERT INTO `usuarios` (`idUsuario`, `nombre`, `apellido`, `correo`, `clave`) VALUES
(1, 'Juan Carlos', 'Medina', 'jcmedinaf@gmail.com', '123');