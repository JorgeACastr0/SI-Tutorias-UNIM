<?php
require 'BD/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_docente= $_POST['id_docente'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];

    // Inserción de datos en la base de datos
    $sql = "INSERT INTO Docentes (Id_Docente,Nombre, Apellido, Email, Contraseña) VALUES (?, ?, ?, ?, ?)";
    $stmt = $datosConexion->prepare($sql);
    $stmt->bind_param('issss',$id_docente,$nombre, $apellido, $email, $contraseña);

    if ($stmt->execute()) {
        echo "Docente agregado exitosamente";
    } else {
        echo "Error al agregar docente: " . $stmt->error;
    }
    $stmt->close();
}
?>
