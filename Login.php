<?php
session_start(); 
include 'BD/conexion.php';

// Inicializar la variable para evitar errores de referencia antes del HTML
$mensaje_error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Definir una consulta reutilizable
    $roles = [
        'Estudiantes' => ['id_session' => 'id_estudiante', 'redirect' => 'panel_estudiante.php'],
        'Docentes' => ['id_session' => 'id_docente', 'redirect' => 'panel_docente.php'],
        'Administrativo' => ['id_session' => 'id_administrativo', 'redirect' => 'panel_administrador.php']
    ];

    foreach ($roles as $tabla => $config) {
        $sql = "SELECT * FROM $tabla WHERE Email = ? AND Contraseña = ?";
        $stmt = $datosConexion->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            $_SESSION[$config['id_session']] = $usuario["Id_" . rtrim($tabla, 's')];
          
            header("Location: " . $config['redirect']);
            exit();
        }
    }

    // Si no se encuentra el usuario, mostrar mensaje de error
    $mensaje_error = "Credenciales incorrectas. Por favor, intente de nuevo.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/CSS" href="CSS/styleLogin.css">
    <link rel="icon" type="image/png" href="img/faviconMDD.png"/>
    <title>Login</title>
    <style>
    .bg-yellow { background-color: #FFC72C; }
    </style>
</head>

<body>

<header class="bg-yellow py-3 text-center text-dark">
        <h1 class="display-4">Ingreso</h1>
        <p class="lead"> <b>Inicia sesion con tu correo y contraseña </b></p>
        <p class="lead"> <b>Si eres estudiante y aun no te haz registrado, vuelve a la pagina principal para registrarte</b></p>

    </header>

    <main class="form-signin w-100 m-auto">
        <form method="POST">
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-3"></div>
            <img src="Img/LogoMDD.png" class="img-fluid" alt="imagen del logo universidad" href="index.php">
            <h1 class="h3 mb-3 fw-normal">Inicia Sesión</h1>

            <!-- Mensaje de error dinámico -->
            <?php if (!empty($mensaje_error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo htmlspecialchars($mensaje_error); ?>
                </div>
            <?php endif; ?>

            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">Correo electrónico</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Contraseña</label>
            </div>

            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Recuerdame
                </label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Ingresar</button>
            <p class="mt-2 mb-5 text-body-secondary">&copy; 2017–2024</p>
        </form>

        <div class="center-text">        
        <button class="btn btn-secondary w-100 py-2" type="submit"><a href="index.php" style="color:#FFFFFF;"> VOLVER </a></button>
        </div>
    </main>

   

    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</body>

</html>
