<?php
// Aquí puedes manejar la lógica para guardar las respuestas si lo deseas
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pregunta1 = $_POST['pregunta1'];
    $pregunta2 = $_POST['pregunta2'];
    $comentarios = $_POST['comentarios'];

    // Conectar a la base de datos
    include 'BD/conexion.php';

    $sql = "INSERT INTO Encuestas (Pregunta1, Pregunta2, Comentarios, Id_Estudiante)
            VALUES (?, ?, ?, ?)";
    $stmt = $datosConexion->prepare($sql);
    $stmt->bind_param("sssi", $pregunta1, $pregunta2, $comentarios, $_SESSION['id_estudiante']);

    if ($stmt->execute()) {
        echo "<script>alert('Gracias por tu respuesta.');</script>";
        header("Location: panel_estudiante.php"); // Redirigir al panel de estudiantes
        exit();
    } else {
        echo "Error al guardar la encuesta: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <title>Encuesta de Satisfacción</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Encuesta de Satisfacción</h1>
        <form method="POST" class="p-4 border rounded bg-white shadow-sm">
            <div class="mb-3">
                <label for="pregunta1" class="form-label">¿Cómo calificas la tutoría?</label>
                <select name="pregunta1" id="pregunta1" class="form-select" required>
                    <option value="" disabled selected>Selecciona una opción</option>
                    <option value="Excelente">Excelente</option>
                    <option value="Buena">Buena</option>
                    <option value="Regular">Regular</option>
                    <option value="Mala">Mala</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="pregunta2" class="form-label">¿El docente respondió tus dudas?</label>
                <select name="pregunta2" id="pregunta2" class="form-select" required>
                    <option value="" disabled selected>Selecciona una opción</option>
                    <option value="Sí">Sí</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="comentarios" class="form-label">Comentarios adicionales</label>
                <textarea name="comentarios" id="comentarios" class="form-control" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Enviar Respuesta</button>
        </form>
    </div>
    <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</body>
</html>
