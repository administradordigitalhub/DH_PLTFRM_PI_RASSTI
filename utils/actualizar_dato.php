<?php
require '../connection/DatabaseConnection.php'; // Asegúrate de incluir la clase DatabaseConnection
require '../models/CourseModel.php'; // Incluye también tu modelo CourseModel

// Obtener la conexión a la base de datos
$dbConnection = DatabaseConnection::getInstance();
$courseModel = new CourseModel($dbConnection);

// Obtener los datos del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

// Validar y limpiar los datos aquí antes de procesarlos
$idCurso = $data['idCurso'];
$fechaInicio = $data['fechaInicio'];
$horaInicio = $data['horaInicio'];
//$fechaFin = $data['fechaFin'];
$horaFin = $data['horaFin'];
$esfuerzo = $data['esfuerzo'];
$actividadTarea = $data['actividadTarea'];
$solicitante = $data['solicitante'];
$resultado = $data['resultado'];
$comentarios = $data['comentarios'];
$modalidad = $data['modalidad'];


// Suponiendo que tienes un método para actualizar los datos del curso
$resultadoActualizacion = $courseModel->actualizarCurso($idCurso, $fechaInicio, $horaInicio, 
//$fechaFin, 
$horaFin,$esfuerzo, $modalidad, $actividadTarea, $solicitante, $resultado, $comentarios);

// Devolver una respuesta
echo json_encode(['success' => $resultadoActualizacion]);
