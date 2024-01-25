<?php
session_start();
require '../connection/DatabaseConnection.php'; // Incluye la clase DatabaseConnection
require '../models/CourseModel.php'; // Incluye la clase CourseModel

// Obtiene la conexión a la base de datos
$dbConnection = DatabaseConnection::getInstance();
$courseModel = new CourseModel($dbConnection);

// Leer los datos JSON de la solicitud POST
$data = json_decode(file_get_contents('php://input'), true);
$userId = $data['userId'] ?? null; // Usa el userId enviado desde el cliente

// Utiliza la clase CourseModel para obtener los cursos del usuario
$courses = $courseModel->getCoursesForUser3($userId);

// Devuelve los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($courses);
