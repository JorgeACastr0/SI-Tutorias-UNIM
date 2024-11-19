<?php

// Variables de conexión
$ubicacionDB = "localhost:3307";
$usuarioDB = "root";
$claveDB = "12345";
$nombreDB = "BaseDatosTutorias";

// Crea la conexión a la BD MySQL
$datosConexion = mysqli_connect($ubicacionDB, $usuarioDB, $claveDB, $nombreDB);

// Comprueba que se haya conectado 
if (!$datosConexion) {
    die("Conexión a la BD fallida: " . mysqli_connect_error());
}
