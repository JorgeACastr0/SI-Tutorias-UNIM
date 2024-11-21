<?php
include 'conexion.php'; // Archivo de conexión a la base de datos
$idDocente = $_GET['id_docente'];
$sql = "SELECT * FROM Tutorías WHERE Id_Docente = ?";
$stmt = $datosConexion->prepare($sql);
$stmt->bind_param("i", $idDocente);
$stmt->execute();
$result = $stmt->get_result();

echo "<table class='table table-striped'>";
echo "<thead><tr><th>Fecha</th><th>Tema</th><th>Materia</th></tr></thead>";
echo "<tbody>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['Fecha']}</td><td>{$row['Tema']}</td><td>{$row['Materia']}</td></tr>";
}
echo "</tbody></table>";
?>
