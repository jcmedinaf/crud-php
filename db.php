<?php
/*
=====================================================================
ARCHIVO: db.php
DESCRIPCIÓN: Conexión a la base de datos mediante MySQLi
PROYECTO: crud-php (Fines educativos)
AUTOR: Juan Carlos Medina
=====================================================================
*/

$servidor = "localhost";
$db       = "crud-php";
$user     = "root";
$pass     = "";

// Crear la conexión usando mysqli_connect
$conexion = mysqli_connect($servidor, $user, $pass, $db);

// Verificar la conexión
if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Configurar el juego de caracteres a utf8mb4
mysqli_set_charset($conexion, "utf8mb4");

?>