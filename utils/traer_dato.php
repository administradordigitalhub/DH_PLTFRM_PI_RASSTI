<?php
require '../connection/DatabaseConnection.php'; // Aseg��rate de incluir la clase DatabaseConnection
require '../models/CourseModel.php'; // Incluir la clase CourseModel

// Obtener la conexi��n a la base de datos a trav��s de DatabaseConnection
$dbConnection = DatabaseConnection::getInstance();

$courseModel = new CourseModel($dbConnection);

// Obtener el ID del usuario desde la solicitud AJAX
$data = json_decode(file_get_contents('php://input'), true);
$userId = $data['userId'];
// Utilizar la clase CourseModel para obtener los cursos del usuario
$courses = $courseModel->getCoursesForUser2($userId);

// Devolver los datos en formato JSON
echo json_encode($courses);
