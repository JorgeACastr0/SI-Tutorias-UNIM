
<?php
include 'BD/conexion.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM Docentes WHERE Id_Docente = ?";
    $stmt = mysqli_prepare($datosConexion, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Docente no encontrado']);
    }
} else {
    echo json_encode(['error' => 'ID no proporcionado']);
}
?>
