<?php
session_start();
include 'BD/conexion.php';


// Obtén el ID del estudiante desde la sesión
$id_estudiante = $_SESSION['id_estudiante'];


// Configuración de la vista predeterminada
$vista = isset($_GET['vista']) ? $_GET['vista'] : 'listado_docentes';
$mensaje = null;

// Procesar registro de asistencia
if ($_SERVER["REQUEST_METHOD"] == "POST" && $vista == 'llenar_asistencia') {
    $id_docente = intval($_POST['id_docente']);
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $tema = $_POST['tema'];
    $salon = $_POST['salon'];
    $materia = $_POST['materia'] ?? null;
    $fecha_actual = date("Y-m-d");
    $id_administrativo = 1; // Constante asignada para Id_Administrativo

    // Validar campos obligatorios
    if (!$id_docente || !$hora_inicio || !$hora_fin || !$tema || !$salon || !$materia) {
        $mensaje = "Todos los campos son obligatorios.";
    } else {
        // Consulta para insertar los datos en la tabla Tutorias
        $sql = "INSERT INTO Tutorias (Fecha, Hora_inicio, Hora_Fin, Tema, Salon, Id_Estudiante, Id_Administrativo, Id_Docente, Materia) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $datosConexion->prepare($sql);
        $stmt->bind_param("ssssiiiss", $fecha_actual, $hora_inicio, $hora_fin, $tema, $salon, $id_estudiante, $id_administrativo, $id_docente, $materia);

        if ($stmt->execute()) {
            // Redirigir a la encuesta de satisfacción después de guardar los datos
            header("Location: encuesta_satisfaccion.php?id_docente=" . $id_docente);
            exit(); }
        else {
        echo "Error al registrar la asistencia: " . $stmt->error;
    }
}
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/faviconMDD.png"/>
    <title>Panel Estudiante</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <?php if ($vista == 'listado_docentes'): ?>
            <!-- Vista: Listado de Docentes -->
            <h1 class="text-center mb-4">Panel de Estudiante</h1>
            <div class="row">
                <?php
                $sql = "SELECT * FROM Docentes";
                $result = $datosConexion->query($sql);
                while ($docente = $result->fetch_assoc()):
                ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($docente['Nombre'] . ' ' . $docente['Apellido']); ?></h5>
                                <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($docente['Email']); ?></p>
                                <p class="card-text"><strong>Horario:</strong> <?php echo htmlspecialchars($docente['Horario']); ?></p>
                                <a href="?vista=perfil_docente&id=<?php echo $docente['Id_Docente']; ?>" class="btn btn-primary w-100">Ver Perfil</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php elseif ($vista == 'perfil_docente'): ?>
            <!-- Vista: Perfil del Docente -->
            <?php
            $id_docente = intval($_GET['id']);
            $sql = "SELECT * FROM Docentes WHERE Id_Docente = ?";
            $stmt = $datosConexion->prepare($sql);
            $stmt->bind_param("i", $id_docente);
            $stmt->execute();
            $result = $stmt->get_result();
            $docente = $result->fetch_assoc();
            ?>
            <h1 class="text-center mb-4">Perfil del Docente</h1>
            <div class="card mx-auto" style="max-width: 500px;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($docente['Nombre'] . ' ' . $docente['Apellido']); ?></h5>
                    <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($docente['Email']); ?></p>
                    <p class="card-text"><strong>Horario:</strong> <?php echo htmlspecialchars($docente['Horario']); ?></p>
                    <a href="?vista=llenar_asistencia&id_docente=<?php echo $docente['Id_Docente']; ?>" class="btn btn-success w-100">Llenar Asistencia</a>
                </div>
            </div>
        <?php elseif ($vista == 'llenar_asistencia'): ?>
            <!-- Vista: Llenar Asistencia -->
            <?php
            $id_docente = isset($_GET['id_docente']) ? intval($_GET['id_docente']) : null;

            if (!$id_docente) {
                echo "<div class='alert alert-danger'>No se encontró el docente seleccionado.</div>";
                exit();
            }
            ?>
            <h1 class="text-center mb-4">Llenar Asistencia</h1>
            <div class="card mx-auto" style="max-width: 500px;">
                <div class="card-body">
                    <?php if ($mensaje): ?>
                        <div class="alert alert-info" role="alert">
                            <?php echo htmlspecialchars($mensaje); ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST">
                        <input type="hidden" name="id_docente" value="<?php echo $id_docente; ?>">
                        <!-- Fecha -->
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="text" name="fecha" class="form-control" id="fecha" value="<?php echo date("Y-m-d"); ?>" readonly>
                        </div>
                        <!-- Hora de inicio -->
                        <div class="mb-3">
                            <label for="hora_inicio" class="form-label">Hora de Inicio</label>
                            <input type="time" name="hora_inicio" class="form-control" id="hora_inicio" required>
                        </div>
                        <!-- Hora de fin -->
                        <div class="mb-3">
                            <label for="hora_fin" class="form-label">Hora de Fin</label>
                            <input type="time" name="hora_fin" class="form-control" id="hora_fin" required>
                        </div>
                        <!-- Tema -->
                        <div class="mb-3">
                            <label for="tema" class="form-label">Tema</label>
                            <input type="text" name="tema" class="form-control" id="tema" required>
                        </div>
                        <!-- Salón -->
                        <div class="mb-3">
                            <label for="salon" class="form-label">Salón</label>
                            <input type="text" name="salon" class="form-control" id="salon" required>
                        </div>
                        <!-- Materia -->
                        <div class="mb-3">
                            <label for="materia" class="form-label">Materia</label>
                            <select name="materia" class="form-select" required>
                                <option value="" disabled selected>Seleccione una materia</option>
                                <option value="Ingenieria de Software">Ingeniería de Software</option>
                                <option value="Sistemas Transaccionales">Sistemas Transaccionales</option>
                                <option value="Programacion Orientada a Objetos">Programación Orientada a Objetos</option>
                                <option value="Bases de Datos">Bases de Datos</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Registrar Tutoria</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
        <div class="text-center mt-4">
            <a href="Logout.php" class="btn btn-danger">Cerrar Sesión</a>
        </div>
    </div>
    <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</body>
</html>
