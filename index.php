<?php
include 'BD/conexion.php';

// Procesar el formulario de registro
$mensaje_registro = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Id_Estudiante = $_POST['Id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $carrera = $_POST['carrera'];
    $contraseña = $_POST['contraseña']; 

    // Insertar datos en la tabla Estudiantes
    $sql = "INSERT INTO Estudiantes (Id_Estudiante, Nombre, Apellido, Email, Carrera, Contraseña) VALUES (?,?, ?, ?, ?, ?)";
    $stmt = $datosConexion->prepare($sql);
    $stmt->bind_param("ssssss",$Id_Estudiante, $nombre, $apellido, $email, $carrera, $contraseña);

    if ($stmt->execute()) {
        $mensaje_registro = "Registrado satisfactoriamente.";
    } else {
        $mensaje_registro = "Error en el registro: " . $conn->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/faviconMDD.png"/>
    <title>Página Principal</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <style>
        /* Colores personalizados */
        .bg-yellow { background-color: #FFC72C; } /* Amarillo Pantone C106 */
        .bg-navy { background-color: #041E42; } /* Azul Pantone 287C */
        .bg-dark-navy { background-color: #012F5C; } /* Azul marino Pantone C533 */
        .bg-camel { background-color: #B79C6D; } /* Camel Pantone 465C */
        .text-yellow { color: #FFC72C; }
        .text-navy { color: #041E42; }
        .text-camel { color: #B79C6D; }
        .btn-yellow { background-color: #FFC72C; color: black; }
        .btn-navy { background-color: #041E42; color: white; }
        .btn-navy:hover { background-color: #012F5C; }
        .btn-camel { background-color: #B79C6D; color: white; }
    </style>
</head>
<body class="bg-light">
    <!-- Banner de Bienvenida -->
    <header class="bg-yellow py-4 text-center text-dark">
        <h1 class="display-4">Bienvenido</h1>
        <p class="lead"> <b>Al sistema de gestion de acompañamiento academico, </b></p>
        <p class="lead"> <b> Seleccione su rol para continuar: </b></p>
    </header>

    <!-- Mostrar mensaje si el registro fue exitoso -->
    <?php if (!empty($mensaje_registro)): ?>
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?php echo $mensaje_registro; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>

    <!-- Secciones: Docentes y Estudiantes -->
    <main class="container my-5">
        <div class="row">
            <!-- Sección Docentes -->
            <div class="col-md-6 mb-4">
                <div class="card text-center shadow">
                    <div class="card-header bg-navy text-white">
                        <h2>Docentes</h2>
                    </div>
                    <div class="card-body bg-light">
                        <p class="card-text">Acceda a su panel de control.</p>
                        <a href="Login.php" class="btn btn-navy btn-lg">Ingresar</a>
                    </div>
                </div>
            </div>
            <!-- Sección Estudiantes -->
            <div class="col-md-6 mb-4">
                <div class="card text-center shadow">
                    <div class="card-header bg-camel text-white">
                        <h2>Estudiantes</h2>
                    </div>
                    <div class="card-body bg-light">
                        <p class="card-text">Regístrese o ingrese para acceder al modulo de estudiante.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <button class="btn btn-yellow btn-lg" id="btnRegister">Registrarse</button>
                            <a href="Login.php" class="btn btn-navy btn-lg">Ingresar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

               <!-- Mostrar formulario de registro al hacer clic -->
        <div id="registerForm" class="mt-5 d-none">
            <div class="card">
                <div class="card-header bg-yellow text-dark">
                    <h3>Registrar Estudiante</h3>
                </div>
                <div class="card-body">
                    <form action="index.php" method="POST">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">ID</label>
                            <input type="text" class="form-control" id="Id" name="Id" required>
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
                            <label for="carrera" class="form-label">Carrera</label>
                            <input type="text" class="form-control" id="carrera" name="carrera" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                        </div>
                        <button type="submit" class="btn btn-navy">Registrar</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </main>
    
    <footer class="bg-dark text-white text-center text-lg-start mt-1">
    <div class="container p-3">
        <!-- Sección de información -->
        <div class="row">
            <!-- Columna 1 -->
            <div class="col-lg-6 col-md-5 mb-4 mb-md-1">
                <h5 class="text-uppercase">Sobre Nosotros</h5>
                <p>
                    Este sistema ha sido desarrollado para optimizar la gestión académica y 
                    las tutorías en la universidad. Nuestro objetivo es facilitar el acceso y el 
                    seguimiento tanto para estudiantes como para docentes.
                </p>
            </div>

            <!-- Columna 2 -->
            <div class="col-lg-6 col-md-5 mb-4 mb-md-2">
                <h5 class="text-uppercase">Enlaces Rápidos</h5>
                <ul class="list-unstyled mb-0">
                    <li><a href="https://www.uniminuto.edu/" class="text-white">Pagina Principal Uniminuto</a></li>
                    <li><a href="https://github.com/JorgeACastr0/SI-Tutorias-UNIM" class="text-white">Repositorio del Proyecto</a></li>
                    <li>CONTACTO:</li>
                    <li>jorge.castro-pa@uniminuto.edu.co </li>
                    <li>brayhan.otriz@uniminuto.edu.co</li>
                </ul>
            </div>           
        </div>
    </div>

    <!-- Línea inferior -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2024 Universidad
    </div>
</footer>

    <!-- Bootstrap JS -->
    <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>

    <!-- JavaScript para mostrar/ocultar formulario -->
    <script>
        const btnRegister = document.getElementById("btnRegister");
        const registerForm = document.getElementById("registerForm");

        btnRegister.addEventListener("click", () => {
            registerForm.classList.toggle("d-none");
            registerForm.scrollIntoView({ behavior: "smooth" });
        });
    </script>

</body>
</html>
