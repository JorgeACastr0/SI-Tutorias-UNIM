<?php
include 'BD/conexion.php';

// Verifica si se recibe la solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtén los datos enviados en formato JSON
    $data = json_decode(file_get_contents('php://input'), true);
    $id = intval($data['id']); // Convierte el ID a entero para seguridad

    // Consulta SQL para eliminar el docente
    $sql = "DELETE FROM Docentes WHERE Id_Docente = ?";
    $stmt = mysqli_prepare($datosConexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'No se pudo eliminar el docente.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Error en la preparación de la consulta.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido.']);
}
?>
