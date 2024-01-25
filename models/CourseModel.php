<?php
class CourseModel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function getUserInfo($userId) {
        $stmt = $this->db->prepare("SELECT NOMBRE_USUARIO, CORREO_USUARIO FROM USUARIO WHERE ID_USUARIO = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getCoursesForUser($userId) {
        $stmt = $this->db->prepare("
                                SELECT 
                                registro_actividades.fecha_inicio, 
                                registro_actividades.hora_inicio, 
                                registro_actividades.hora_fin, 
                                registro_actividades.actividad_tarea, 
                                registro_actividades.solicitante, 
                                registro_actividades.esfuerzo, 
                                registro_actividades.modalidad, 
                                registro_actividades.resultado, 
                                registro_actividades.comentarios,
                                registro_actividades.id
                                FROM 
                                registro_actividades
                                INNER JOIN usuario 
                                ON registro_actividades.usuario_id = usuario.id
                                WHERE 
                                usuario.id = ? ORDER BY 
                                registro_actividades.fecha_inicio DESC;");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    
    public function getCoursesForUser3($userId) {
        $stmt = $this->db->prepare("
                                SELECT 
                                DATE_FORMAT(registro_actividades.fecha_inicio, '%d/%m/%Y'), 
                                registro_actividades.hora_inicio  as 'HORA INICIO', 
                                registro_actividades.hora_fin as 'HORA FIN', 
                                FORMAT(registro_actividades.esfuerzo, 2, 'de_DE') AS `ESFUERZO`,
                                registro_actividades.modalidad as 'MODALIDAD', 
                                registro_actividades.actividad_tarea as 'ACTIVIDAD/TAREA', 
                                registro_actividades.resultado as 'RESULTADO', 
                                registro_actividades.comentarios as 'COMENTARIO'
                                FROM 
                                registro_actividades
                                INNER JOIN usuario 
                                ON registro_actividades.usuario_id = usuario.id
                                WHERE 
                                usuario.id = ? ORDER BY 
                                registro_actividades.fecha_inicio DESC;");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    //obtenerDatosUsuarioPorDNI
    
        public function obtenerDatosUsuarioPorId($userId) {
            $stmt = $this->db->prepare("SELECT id,nombre, apellido FROM usuario WHERE id = ?;");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $resultado = $stmt->get_result();
            if ($resultado->num_rows > 0) {
                return $resultado->fetch_assoc(); // Devuelve un único usuario
            } else {
                return null; // No se encontró el usuario
            }
        }

    
    
     public function getCoursesForUser2($userId) {
        $stmt = $this->db->prepare("
                                SELECT 
                                registro_actividades.fecha_inicio, 
                                registro_actividades.hora_inicio, 
                                registro_actividades.hora_fin, 
                                registro_actividades.actividad_tarea, 
                                registro_actividades.solicitante, 
                                registro_actividades.esfuerzo, 
                                registro_actividades.resultado, 
                                registro_actividades.modalidad, 
                                registro_actividades.comentarios,
                                registro_actividades.id
                                FROM 
                                registro_actividades
                                INNER JOIN usuario 
                                ON registro_actividades.usuario_id = usuario.id
                                WHERE 
                                registro_actividades.id = ?;");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    
    public function obtenerInformacionEquipo($userId) {
    // Preparar la sentencia SQL para seleccionar la información del equipo específico
    $stmt = $this->db->prepare("
        SELECT 
            informacion_equipo.cliente_final, 
            informacion_equipo.cliente_intermedio, 
            informacion_equipo.area, 
            informacion_equipo.nombre_equipo, 
            informacion_equipo.lider_equipo, 
            informacion_equipo.nombre_consultor
        FROM 
            informacion_equipo
        WHERE 
            informacion_equipo.usuario_id = ?;
    ");

    // Vincular el ID del equipo como parámetro a la sentencia preparada
    $stmt->bind_param("i", $userId);

    // Ejecutar la sentencia preparada
    $stmt->execute();

    // Obtener y devolver los resultados de la consulta
    return $stmt->get_result()->fetch_assoc(); // fetch_assoc si solo esperas un resultado
}

    
    public function actualizarCurso($idCurso, $fechaInicio, $horaInicio, $horaFin, $esfuerzo, $modalidad , $actividadTarea, $solicitante, $resultado, $comentarios) {
        
    // Preparar la sentencia SQL para actualizar la tabla registro_actividades
    $stmt = $this->db->prepare("UPDATE registro_actividades SET fecha_inicio = ?, hora_inicio = ?, hora_fin = ?, esfuerzo = ?, modalidad = ?, actividad_tarea = ?, solicitante = ?, resultado = ?, comentarios = ? WHERE id = ?");
    $stmt->bind_param("sssdsssssi", $fechaInicio, $horaInicio, 
    //$fechaFin,
    $horaFin, $esfuerzo, $modalidad , $actividadTarea, $solicitante, $resultado, $comentarios, $idCurso);

    $stmt->execute();
    return $stmt->affected_rows > 0;
}
    
    public function crearActividad($usuarioId,$fechaInicio, $horaInicio, 
    //$fechaFin,
    $horaFin, $esfuerzo , $modalidad , $actividadTarea, $solicitante, $resultado, $comentarios) {
        // Preparar la sentencia SQL para insertar una nueva actividad
        $stmt = $this->db->prepare("INSERT INTO registro_actividades (usuario_id,fecha_inicio, hora_inicio, hora_fin, esfuerzo, modalidad , actividad_tarea, solicitante, resultado, comentarios) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
        // Asumiendo que $esfuerzo es un número (integer)
        // Si todos son strings, reemplaza 'i' con 's'
        $stmt->bind_param("isssdsssss", $usuarioId, $fechaInicio, $horaInicio, $horaFin, $esfuerzo, $modalidad , $actividadTarea, $solicitante, $resultado, $comentarios);

        $stmt->execute();
        return $stmt->affected_rows > 0;
    }
    
    public function eliminarCurso($idCurso) {
    // Preparar la consulta SQL para eliminar el curso por su ID
    $stmt = $this->db->prepare("DELETE FROM registro_actividades WHERE id = ?");
    $stmt->bind_param("i", $idCurso);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Si la eliminación fue exitosa, devuelve true
        return true;
    } else {
        // Si hubo un error en la eliminación, devuelve false
        return false;
    }
}

    
    
    public function authenticateUser($dni) {
    // Preparar la consulta SQL para verificar si el usuario con el DNI proporcionado existe
    $stmt = $this->db->prepare("SELECT * FROM usuario WHERE dni = ?");
    $stmt->bind_param("s", $dni);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // El usuario con el DNI existe, autenticación exitosa
        // Puedes guardar información del usuario en la sesión si lo deseas
        $userData = $result->fetch_assoc();
        $_SESSION['userId'] = $userData['id']; // Guardar el ID del usuario en la sesión
        return true;
    } else {
        // El usuario no existe o hay más de un usuario con el mismo DNI
        return false;
    }
}




    // Puedes agregar más métodos para recuperar información de otras tablas según sea necesario
}
