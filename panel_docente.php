<?php
session_start();
include "BD/conexion.php";

// Verificar si el docente ha iniciado sesión
if (!isset($_SESSION['id_docente'])) {
  header("Location: Login.php");
  exit();
}

// Obtener el ID del docente desde la sesión
$id_docente = $_SESSION['id_docente'];
$mensaje = "";

// Inicializar la variable $docente
$docente = null;

// Obtener los datos del docente desde la base de datos
$sql = "SELECT * FROM Docentes WHERE Id_Docente = ?";
$stmt = $datosConexion->prepare($sql);
$stmt->bind_param("i", $id_docente);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $docente = $result->fetch_assoc();
} else {
    $mensaje = "No se encontraron datos del docente.";
}

// Manejar la actualización del horario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuevo_horario = $_POST['horario'];

    if ($docente) { // Asegurarse de que los datos del docente están cargados
        $sql_update = "UPDATE Docentes SET Horario = ? WHERE Id_Docente = ?";
        $stmt_update = $datosConexion->prepare($sql_update);
        $stmt_update->bind_param("si", $nuevo_horario, $id_docente);

        if ($stmt_update->execute()) {
            $mensaje = "Horario actualizado correctamente.";
            $docente['Horario'] = $nuevo_horario; // Actualizar en memoria
        } else {
            $mensaje = "Error al actualizar el horario. Inténtelo de nuevo.";
        }
    } else {
        $mensaje = "No se pudo actualizar el horario porque no se encontraron datos del docente.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="img/faviconMDD.png"/>
    <title>Panel Docente</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Panel Docente</h1>
    
        
    <?php
    //ESTO SIRVE PARA MIRAR QUE VARIABLES ESTAN EN LA SESSION
    /*var_dump($_SESSION);
    exit();*/
    ?>

        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-info" role="alert">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <?php if ($docente): ?>
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Información del Docente</h3>
                    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($docente['Nombre'] . ' ' . $docente['Apellido']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($docente['Email']); ?></p>
                    <p><strong>Horario y Salon Actual:</strong> <?php echo htmlspecialchars($docente['Horario']); ?></p>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <h3 class="card-title">Editar Horario</h3>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="horario" class="form-label">Nuevo Horario y Salon:</label>
                            <textarea class="form-control" name="horario" id="horario" rows="2" required><?php echo htmlspecialchars($docente['Horario']); ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Actualizar Horario y Salon</button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                No se encontraron datos del docente. Por favor, contacte al administrador.
            </div>
        <?php endif; ?>


        <?php 
        $sql = "SELECT 
                Tutorias.Fecha, 
                Tutorias.Hora_inicio, 
                Tutorias.Hora_fin, 
                Tutorias.Tema, 
                Tutorias.Materia, 
                Estudiantes.Id_Estudiante, 
                Estudiantes.Nombre, 
                Estudiantes.Apellido
                FROM 
                Tutorias
                JOIN 
                Estudiantes ON Tutorias.Id_Estudiante = Estudiantes.Id_Estudiante
                WHERE 
                Tutorias.Id_Docente = ?;";

        $stmt = $datosConexion->prepare($sql);
        $stmt->bind_param("i", $id_docente);
        $stmt->execute();
        $result = $stmt->get_result();
?>
    

        <h1 class="text-center">Tutorías Asignadas</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Tema</th>
                    <th>Materia</th>
                    <th>ID Estudiante</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                    <td><?php echo htmlspecialchars($row['Fecha']); ?></td>
                        <td><?php echo htmlspecialchars($row['Hora_inicio']); ?></td>
                        <td><?php echo htmlspecialchars($row['Hora_fin']); ?></td>
                        <td><?php echo htmlspecialchars($row['Tema']); ?></td>
                        <td><?php echo htmlspecialchars($row['Materia']); ?></td>
                        <td><?php echo htmlspecialchars($row['Id_Estudiante']); ?></td>
                        <td><?php echo htmlspecialchars($row['Nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['Apellido']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="text-center">
    <form action="docentes_exportar_excel.php" method="POST">
    <button type="submit" class="btn btn-success mt-3 regular-button">Exportar a EXCEL</button>
    </form>
    </div>
        
        <div class="text-center mt-4">
            <a href="Logout.php" class="btn btn-danger">Cerrar Sesión</a>
        </div>
    </div>
    

    <!-- Bootstrap JavaScript Libraries -->
    <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</body>

</html>
