<?php
session_start();
require 'vendor/autoload.php';
require 'BD/conexion.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if (!isset($_SESSION['id_docente'])) {
    die("Acceso no autorizado.");
}

$idDocente = $_SESSION['id_docente'];

// Consulta para obtener las tutorías del docente logueado
$sql = "SELECT T.Fecha, T.Hora_inicio, T.Hora_fin, T.Tema, T.Materia, 
        E.Nombre AS NombreEstudiante, E.Apellido AS ApellidoEstudiante
        FROM Tutorias T
        INNER JOIN Estudiantes E ON T.Id_Estudiante = E.Id_Estudiante
        WHERE T.Id_Docente = ?";
$stmt = $datosConexion->prepare($sql);
$stmt->bind_param("i", $idDocente);
$stmt->execute();
$result = $stmt->get_result();

// Crear hoja de Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Configurar encabezados
$sheet->setCellValue('A1', 'Fecha')
    ->setCellValue('B1', 'Hora Inicio')
    ->setCellValue('C1', 'Hora Fin')
    ->setCellValue('D1', 'Tema')
    ->setCellValue('E1', 'Materia')
    ->setCellValue('F1', 'Nombre Estudiante')
    ->setCellValue('G1', 'Apellido Estudiante');

// Llenar datos
$row = 2; // Empezar después de los encabezados
while ($tutoria = $result->fetch_assoc()) {
    $sheet->setCellValue("A$row", $tutoria['Fecha'])
        ->setCellValue("B$row", $tutoria['Hora_inicio'])
        ->setCellValue("C$row", $tutoria['Hora_fin'])
        ->setCellValue("D$row", $tutoria['Tema'])
        ->setCellValue("E$row", $tutoria['Materia'])
        ->setCellValue("F$row", $tutoria['NombreEstudiante'])
        ->setCellValue("G$row", $tutoria['ApellidoEstudiante']);
    $row++;
}

// Exportar como archivo Excel
$writer = new Xlsx($spreadsheet);
$filename = "TutoriasDocente_" . $idDocente . ".xlsx";

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit();
?>


?>