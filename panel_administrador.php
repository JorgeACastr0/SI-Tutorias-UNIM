<?php
session_start();
include 'BD/conexion.php';

/*
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}
*/
// Variables para manejo de mensajes
$mensaje = "";

//PHP para agregar nuevos Docentes
if (isset($_POST['agregar_docente'])) {
    $Id_DocenteNuevo = $_POST['Id_DocenteNuevo'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $horario = $_POST['horario'];
    $contraseña = $_POST['contraseña'];

    $sql = "INSERT INTO Docentes (Id_Docente, Nombre, Apellido, Email, Horario, Contraseña) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $datosConexion->prepare($sql);
    $stmt->bind_param("isssss",$Id_DocenteNuevo, $nombre, $apellido, $email, $horario, $contraseña);

    if ($stmt->execute()) {
        echo "<script>alert('Docente agregado correctamente');</script>";
    } else {
        echo "<script>alert('Error al agregar el docente');</script>";
    }
}


// Manejo de acciones en la sección Docentes
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['eliminar_docente'])) {
        $id_docente = $_POST['id_docente'];
        $sql = "DELETE FROM Docentes WHERE Id_Docente = ?";
        $stmt = $datosConexion->prepare($sql);
        $stmt->bind_param("i", $id_docente);
        if ($stmt->execute()) {
            $mensaje = "Docente eliminado correctamente.";
        } else {
            $mensaje = "Error al eliminar el docente.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <title>Panel Administrador</title>
</head>
<body>
    <!-- Menú de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Panel Administrador</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="#docentes">Docentes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#encuestas">Encuestas Estudiantiles</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Mensaje de estado -->
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>

        <!-- Sección Docentes -->
        <section id="docentes">
            <h2>Gestión de Docentes</h2>
            <!-- Botón para abrir el formulario -->
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarDocente">Agregar Docente</button>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM Docentes";
                    $result = $datosConexion->query($sql);
                    while ($row = $result->fetch_assoc()):
                    ?>
                    <!--MODAL PARA EDITAR UN DOCENTE-->
                    <div class="modal fade" id="editModal<?php echo $row['Id_Docente']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                         <div class="modal-header">
                         <h5 class="modal-title" id="editModalLabel">Editar Docente</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <form method="POST" action="editar_docente.php">
                    <div class="modal-body">
                        <input type="hidden" name="Id_Docente" value="<?php echo $row['Id_Docente']; ?>">
                        <div class="mb-3">
                        <label for="Nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="Nombre" value="<?php echo $row['Nombre']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="Apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" name="Apellido" value="<?php echo $row['Apellido']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="Email" value="<?php echo $row['Email']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="Horario" class="form-label">Horario</label>
                        <input type="text" class="form-control" name="Horario" value="<?php echo $row['Horario']; ?>" required>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                    </form>
                    </div>
                    </div>
                    </div>

                        <tr>
                            <td><?php echo htmlspecialchars($row['Id_Docente']); ?></td>
                            <td><?php echo htmlspecialchars($row['Nombre']); ?></td>
                            <td><?php echo htmlspecialchars($row['Apellido']); ?></td>
                            <td><?php echo htmlspecialchars($row['Email']); ?></td>
                            <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['Id_Docente']; ?>">Editar</button>
                            </td>
                            <td>
                            <form action="" method="POST" style="display:inline;">
                                    <input type="hidden" name="id_docente" value="<?php echo $row['Id_Docente']; ?>">
                                    <button type="submit" name="eliminar_docente" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este docente?');">Eliminar</button>
                             </form>
                            </td>
                            <td>
                            <a href="docentes_exportar_excel.php?id=<?php echo $row['Id_Docente']; ?>" class="btn btn-success">Exportar Excel</a>
                            </td>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>

        <!-- Modal Añadir Docente -->
        <!-- Modal para el formulario -->
<div class="modal fade" id="modalAgregarDocente" tabindex="-1" aria-labelledby="modalAgregarDocenteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarDocenteLabel">Agregar Nuevo Docente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                <div class="mb-3">
                        <label for="Id_DocenteNuevo" class="form-label">ID Docente</label>
                        <input type="number" class="form-control" id="Id_DocenteNuevo" name="Id_DocenteNuevo" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="horario" class="form-label">Horario</label>
                        <textarea class="form-control" id="horario" name="horario" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="contraseña" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                    </div>
                    <button type="submit" name="agregar_docente" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

        <!-- Sección Encuestas -->
        <section id="encuestas" class="mt-5">
            <h2>Encuestas Estudiantiles</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id Encuesta</th>
                        <th>Id Estudiante</th>
                        <th>Id Docente</th>
                        <th>Nombre Docente</th>
                        <th>Calificación</th>
                        <th>Comentario</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT E.Id_Encuesta, E.Id_Estudiante, E.Pregunta1, E.Fecha, D.Id_Docente, D.Nombre AS Nombre_Docente, D.Apellido AS Apellido_Docente, 
                    E.Comentarios
                    FROM Encuestas E
                    JOIN Docentes D ON E.Id_Docente = D.Id_Docente";
                    $result = $datosConexion->query($sql);
                    while ($row = $result->fetch_assoc()):
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['Id_Encuesta']); ?></td>
                            <td><?php echo htmlspecialchars($row['Id_Estudiante']); ?></td>
                            <td><?php echo htmlspecialchars($row['Id_Docente']); ?></td>
                            <td><?php echo $row['Nombre_Docente'].' '.$row['Apellido_Docente']; ?></td>
                            <td><?php echo htmlspecialchars($row['Pregunta1']); ?></td>
                            <td><?php echo htmlspecialchars($row['Comentarios']); ?></td>
                            <td><?php echo htmlspecialchars($row['Fecha']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </div>

    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
