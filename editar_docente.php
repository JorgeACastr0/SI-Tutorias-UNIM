<?php
include 'BD/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_docente = $_POST['Id_Docente'];
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellido'];
    $email = $_POST['Email'];
    $horario = $_POST['Horario'];

    $sql = "UPDATE Docentes SET Nombre = ?, Apellido = ?, Email = ?, Horario = ? WHERE Id_Docente = ?";
    $stmt = $datosConexion->prepare($sql);
    $stmt->bind_param("ssssi", $nombre, $apellido, $email, $horario, $id_docente);

    if ($stmt->execute()) {
        header("Location: panel_administrador.php?success=docente_editado");
        exit();
    } else {
        header("Location: panel_administrador.php?error=error_editando");
        exit();
    }
}
?>
