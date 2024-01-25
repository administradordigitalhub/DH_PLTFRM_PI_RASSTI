<?php
session_start(); // Iniciar la sesión

// Destruir la sesión para cerrar la sesión actual del usuario
session_destroy();

// Redireccionar al usuario a la página de inicio de sesión
header('Location: ../index.php');
exit;
?>
