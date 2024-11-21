<?php
include 'BD/conexion.php'; // Archivo de conexión
$idDocente = isset($_GET['id_docente']) ? intval($_GET['id_docente']) : 0;

if (!$idDocente) {
    echo "<p>Error: ID del docente no válido.</p>";
    exit;
}

$sql = "SELECT Fecha, Tema, Materia FROM Tutorias WHERE Id_Docente = ?";
$stmt = $datosConexion->prepare($sql);
if (!$stmt) {
    echo "<p>Error al preparar la consulta: " . $datosConexion->error . "</p>";
    exit;
}
$stmt->bind_param("i", $idDocente);
if (!$stmt->execute()) {
    echo "<p>Error al ejecutar la consulta: " . $stmt->error . "</p>";
    exit;
}
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p>No se encontraron tutorías para este docente.</p>";
} else {
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>Fecha</th><th>Tema</th><th>Materia</th></tr></thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['Fecha']}</td><td>{$row['Tema']}</td><td>{$row['Materia']}</td></tr>";
    }
    echo "</tbody></table>";
}


?>
<script>
    function descargarReporte() {
  // Redirige al usuario al script de exportación
  window.location.href = "docentes_exportar_excel.php";
}
</script>
