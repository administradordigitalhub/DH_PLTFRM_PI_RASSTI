<?php
session_start();

require 'connection/DatabaseConnection.php';
require 'models/CourseModel.php';
require 'controllers/CourseController.php';

$dbConnection = DatabaseConnection::getInstance(); // Obtener la conexi��n a la base de datos
$model = new CourseModel($dbConnection);
$controller = new CourseController($model);

// Comprobar si el usuario est�� autenticado


if (isset($_GET['action'])) {
    if ($_GET['action'] == 'login') {
        $controller->login();
    } elseif ($_GET['action'] == 'listCourses') {
        $controller->listCourses();
    }
} else {
    // Redirecciona a la p�gina de inicio de sesi�n por defecto
    header('Location: index.php?action=login');
    exit;
}
