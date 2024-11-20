<?php
include 'BD/conexion.php';

$id = $_GET['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];

$sql = "UPDATE Docentes SET Nombre='$nombre', Apellido='$apellido', Email='$email' WHERE Id_Docente=$id";
mysqli_query($datosConexion, $sql);

echo "Docente actualizado correctamente.";
?>
