<!--
 =====================================================================
 ARCHIVO: README.md
 DESCRIPCIÓN: Documentación principal, instrucciones de instalación, 
 configuración y arquitectura del sistema CRUD modular en PHP y PDO.
 PROYECTO: crud-php (Fines educativos)
 AUTOR: Juan Carlos Medina
 =====================================================================
-->

# 📂 crud-php — Sistema Web Modular con PHP Nativo y PDO

> 🎓 **Proyecto Académico / Educativo**  
> Desarrollado por **Juan Carlos Medina** con fines de aprendizaje, demostración de arquitectura modular por secciones y gestión segura de bases de datos relacionales.

[![PHP Version](https://img.shields.io/badge/PHP-7.x%20%2F%208.x-blue.svg)](https://php.net)
[![Database](https://img.shields.io/badge/Database-MySQL%20%2F%20PDO-orange.svg)](https://mysql.com)
[![Architecture](https://img.shields.io/badge/Architecture-Modular%20PHP-purple.svg)]()
[![jQuery](https://img.shields.io/badge/Frontend-jQuery%20%2F%20HTML5-yellow.svg)](https://jquery.com)

Aplicación web robusta desarrollada en PHP nativo utilizando **PDO (PHP Data Objects)** para la gestión segura de bases de datos relacionales. Cuenta con un diseño estructurado por secciones modulares, control de sesiones, capas de plantillas reutilizables y soporte para gestión multimedia.

---

## 📂 Estructura del Proyecto

Puedes consultar la arquitectura detallada de directorios en [esquema.md](esquema.md).

---

## ⚙️ Requisitos Previos

- Servidor web local con soporte para PHP (como XAMPP, LAMPP o equivalente).
- Gestor de bases de datos MySQL / MariaDB.
- Navegador web moderno.

---

## 🛠️ Instalación y Configuración Local

1. **Clona o descarga** este repositorio dentro de tu directorio local de servidores web (por ejemplo, `C:/xampp/htdocs/crud-php`).
2. **Importa la base de datos**:  
   Crea una base de datos en tu gestor e importa el archivo ubicado en la raíz del proyecto **`db.sql`**.
3. **Configura la conexión**:  
   Verifica y ajusta los parámetros de conexión a la base de datos en el archivo **`db.php`**:
   ```php
   $servidor = "localhost";
   $usuario = "root";
   $password = "";
   $base_datos = "tu_base_de_datos";

## Ejecuta el proyecto:

    Inicia tus servicios de Apache y MySQL en XAMPP y abre tu navegador web ingresando a la URL:

    http://localhost/crud-php/

## ✨ Características Principales

* Autenticación y Sesiones: Control de acceso seguro mediante inicio de sesión (login.php) y cierre de sesión controlado (cerrar.php).
* Arquitectura Modular: Secciones organizadas de manera independiente para la administración eficiente de entidades clave (empleados, puestos, usuarios).
* Capas de Plantillas: Reutilización de componentes visuales globales ubicados en la carpeta templates/ (header.php, footer.php).
* Gestión de Archivos y Multimedia: Soporte estructurado para el almacenamiento de imágenes (assets/img/fotos/) y generación de documentos.
* Librerías Externas: Integración de dependencias y autoloaders en el directorio libs/.

## 📝 Créditos y Autoría

Desarrollado con rigor técnico y vocación pedagógica por Juan Carlos Medina.

Repositorio con fines educativos y de demostración de arquitectura de software en PHP nativo.