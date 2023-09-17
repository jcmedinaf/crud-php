<?php

$servidor = "localhost";
$db = "app";
$user = "root";
$pass = "";

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$db",$user,$pass);
} catch (Exception $ex) {
    echo $ex->getMessage();
}

?>