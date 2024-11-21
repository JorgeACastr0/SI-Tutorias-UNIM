<?php
include 'BD/conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<!--mysql://root:FvkygBkuTmGGsXHfokQZeESnAEktyyex@junction.proxy.rlwy.net:54126/railway-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="img/faviconMDD.png" />
    <title>Panel Administrador</title>
    <!-- Bootstrap core CSS -->
    <link href="/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">
    <link href="offcanvas.css" rel="stylesheet">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>

<body class="bg-light">
    <!--Encabezado-->
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Offcanvas navbar</a>
            <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" onclick="showSection('menu')">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('docentes')">Docentes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#" onclick="showSection('estudiantes')">Estudiantes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('reportes')">Reportes</a>
                    </li>

                </ul>
                <div class="d-flex ">
                    <a href="Logout.php" class="btn btn-primary">Cerrar Sesión</a>
                </div>


            </div>
        </div>
    </nav>

    <main class="container mt-3 pt-3">
        <div id="menu" class="content-section">
            <h2>Sección principal</h2>
            <div class="d-flex align-items-center p-3 my-3 text-white bg-purple rounded shadow-sm">
                <img class="img-fluid" src="Img/Mesa de trabajo 1.png" alt="imagen del logo universidad" width="48" height="38">
                <div class="lh-1">
                    <br>
                    <h1 class="h6 mb-0 text-white lh-1"> Universidad Minuto de Dios</h1>
                    <small>Desde 2011</small>
                </div>
            </div>

            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <h6 class="border-bottom pb-2 mb-0">Actualizaciones recientes</h6>
                <div class="d-flex text-muted pt-3">
                    <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" role="img" aria-label="Placeholder: 32x32" focusable="false" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
                    </svg>

                    <p class="pb-3 mb-0 small lh-sm border-bottom">
                        <strong class="d-block text-gray-dark">@username</strong>
                        Algún contenido placeholder representativo, con alguna información sobre este usuario. ¿Imaginas que esto sea una especie de actualización de estado, tal vez?
                    </p>
                </div>
                <div class="d-flex text-muted pt-3">
                    <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" role="img" aria-label="Placeholder: 32x32" focusable="false" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#e83e8c"></rect><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text>
                    </svg>

                    <p class="pb-3 mb-0 small lh-sm border-bottom">
                        <strong class="d-block text-gray-dark">@username</strong>
                        Algún contenido placeholder más representativo, relacionado con este otro usuario. Otra actualización de estado, tal vez.
                    </p>
                </div>
                <div class="d-flex text-muted pt-3">
                    <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" role="img" aria-label="Placeholder: 32x32" focusable="false" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#6f42c1"></rect><text x="50%" y="50%" fill="#6f42c1" dy=".3em">32x32</text>
                    </svg>

                    <p class="pb-3 mb-0 small lh-sm border-bottom">
                        <strong class="d-block text-gray-dark">@username</strong>
                        Este usuario también obtiene algún contenido placeholder representativo. Tal vez hicieron algo interesante y realmente quieres resaltarlo en las actualizaciones recientes.
                    </p>
                </div>
                <small class="d-block text-end mt-3">
                    <a href="#">Todas las actualizaciones</a>
                </small>
            </div>

            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <h6 class="border-bottom pb-2 mb-0">Sugerencias</h6>
                <div class="d-flex text-muted pt-3">
                    <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" role="img" aria-label="Placeholder: 32x32" focusable="false" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
                    </svg>

                    <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                        <div class="d-flex justify-content-between">
                            <strong class="text-gray-dark">Nombre completo</strong>
                            <a href="#">Seguir</a>
                        </div>
                        <span class="d-block">@username</span>
                    </div>
                </div>
                <div class="d-flex text-muted pt-3">
                    <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" role="img" aria-label="Placeholder: 32x32" focusable="false" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
                    </svg>

                    <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                        <div class="d-flex justify-content-between">
                            <strong class="text-gray-dark">Nombre completo</strong>
                            <a href="#">Seguir</a>
                        </div>
                        <span class="d-block">@username</span>
                    </div>
                </div>
                <div class="d-flex text-muted pt-3">
                    <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" role="img" aria-label="Placeholder: 32x32" focusable="false" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
                    </svg>

                    <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                        <div class="d-flex justify-content-between">
                            <strong class="text-gray-dark">Nombre completo</strong>
                            <a href="#">Seguir</a>
                        </div>
                        <span class="d-block">@username</span>
                    </div>
                </div>
                <small class="d-block text-end mt-3">
                    <a href="#">Todas las sugerencias</a>
                </small>
            </div>


        </div>

        <div id="docentes" class="content-section">
            <h2>Sección de Docentes</h2>
            <div class="table-responsive">
                <table class="table table-sm table-hover table-dark styled-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Contraseña</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaDocentes">
                        <?php
                        // Consulta para obtener la lista de docentes
                        $sql = "SELECT * FROM Docentes";
                        $result = mysqli_query($datosConexion, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$row['Id_Docente']}</td>";
                            echo "<td>{$row['Nombre']}</td>";
                            echo "<td>{$row['Apellido']}</td>";
                            echo "<td>{$row['Email']}</td>";
                            echo "<td>{$row['Contraseña']}</td>";
                            echo "<td>
                                    <button class='btn btn-warning' onclick='mostrarModalEditar({$row['Id_Docente']})'>Editar</button>
                                    <button class='btn btn-danger' onclick='mostrarModalEliminar({$row['Id_Docente']})'>Eliminar</button>
                                    <button class='btn btn-light' onclick='mostrarModalReportes({$row['Id_Docente']})'>Reporte</button>
                                  </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDocenteModal">Agregar Docente</button>
            </div>

        </div>
        <div id="estudiantes" class="content-section hidden">
            <h2>Sección de Estudiantes</h2>
            <div class="table-responsive">
                <table class="table table-sm table-hover table-dark styled-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Contraseña</th>
                            <th>Carrera</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaEstudiantes">
                        <?php
                        // Consulta para obtener la lista de docentes
                        $sql = "SELECT * FROM Estudiantes";
                        $result = mysqli_query($datosConexion, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$row['Id_Estudiante']}</td>";
                            echo "<td>{$row['Nombre']}</td>";
                            echo "<td>{$row['Apellido']}</td>";
                            echo "<td>{$row['Email']}</td>";
                            echo "<td>{$row['Carrera']}</td>";
                            echo "<td>{$row['Contraseña']}</td>";
                            echo "<td>
                                    <button class='btn btn-warning' onclick='mostrarModalEditar({$row['Id_Estudiante']})'>Editar</button>
                                    <button class='btn btn-danger' onclick='mostrarModalEliminar({$row['Id_Estudiante']})'>Eliminar</button>
    
                                  </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
        <div id="reportes" class="content-section hidden">
            <h2>Sección de Reportes</h2>
            <div class="table-responsive">
                <table class="table table-sm table-hover table-dark styled-table">
                    <thead>
                        <tr>
                            <th>Estudiante</th>
                            <th>Docente</th>
                            <th>Pregunta 1</th>
                            <th>Pregunta 2</th>
                            <th>Comentarios</th>

                        </tr>
                    </thead>
                    <tbody id="tablaReportes">
                        <?php
                        // Consulta para obtener la lista de docentes
                        $sql = "SELECT * FROM Encuestas";
                        $result = mysqli_query($datosConexion, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$row['Id_Estudiante']}</td>";
                            echo "<td>{$row['Id_Docente']}</td>";
                            echo "<td>{$row['Pregunta1']}</td>";
                            echo "<td>{$row['Pregunta2']}</td>";
                            echo "<td>{$row['Comentarios']}</td>";

                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>


    <!-- Modal (Ubicado aquí) -->
    <!-- Modal para Agregar Docente -->
    <div class="modal fade" id="addDocenteModal" tabindex="-1" aria-labelledby="addDocenteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDocenteModalLabel">Agregar Nuevo Docente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addDocenteForm">
                        <div class="mb-3">
                            <label for="idDocente" class="form-label">ID Docente</label>
                            <input type="number" class="form-control" id="id_docente" name="id_docente" required>
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido:</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="contraseña" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="addDocenteButton">Agregar Docente</button>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.getElementById('addDocenteButton').addEventListener('click', function () {
        // Obtener los valores del formulario
        const id_docente = document.getElementById('id_docente').value;
        const nombre = document.getElementById('nombre').value;
        const apellido = document.getElementById('apellido').value;
        const email = document.getElementById('email').value;
        const contraseña = document.getElementById('contraseña').value;

        // Validar que todos los campos estén completos
        if (nombre && apellido && email && contraseña) {
            // Enviar los datos al servidor usando AJAX
            fetch('agregar_docente.php', {
                method: 'POST',
                body: new URLSearchParams({
                    'id_docente':id_docente,
                    'nombre': nombre,
                    'apellido': apellido,
                    'email': email,
                    'contraseña': contraseña
                })
            })
            .then(response => response.text())
            .then(data => {
                alert(data); // Mostrar mensaje de éxito o error
                // Cerrar el modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('addDocenteModal'));
                modal.hide();
                // Recargar la página para mostrar el nuevo docente en la tabla
                location.reload();
            })
            .catch(error => console.error('Error:', error));
        } else {
            alert('Por favor complete todos los campos.');
        }
    });
</script>



    <!-- Modal Editar -->
    <div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Editar Docente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="id_docente" name="id_docente">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido:</label>
                            <input type="text" class="form-control" id="apellido" name="apellido">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="contraseña" class="form-label">Contraseña:</label>
                            <input type="text" class="form-control" id="contraseña" name="contraseña">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="modalConfirmButton">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Fin del Modal -->

    <!-- Modal para Confirmar Eliminación -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Eliminar Docente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar a este docente?</p>
                    <input type="hidden" id="deleteDocenteId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para Reportes -->
    <div class="modal fade" id="reporteModal" tabindex="-1" aria-labelledby="reporteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reporteModalLabel">Reporte del Docente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="contenidoReporte">
                    <!-- Aquí se cargarán los datos dinámicamente -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="descargarReporte()">Imprimir</button>

                </div>
            </div>
        </div>
    </div>
    <script>
        function descargarReporte() {
            // Redirige al usuario al script de exportación
            window.location.href = "docentes_exportar_excel.php";
        }
    </script>

    <script>
        function mostrarModalReportes(idDocente) {
            // Llamada AJAX para obtener los datos del reporte
            fetch(`obtener_reporte_docente.php?id_docente=${idDocente}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('contenidoReporte').innerHTML = data;
                    const modal = new bootstrap.Modal(document.getElementById('reporteModal'));
                    modal.show();
                })
                .catch(error => console.error('Error al cargar el reporte:', error));
        }
    </script>


    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!--Cambio de opciones navegador-->
    <script src="Js-Proyecto/offcanvas.js"></script>




</body>

</html>