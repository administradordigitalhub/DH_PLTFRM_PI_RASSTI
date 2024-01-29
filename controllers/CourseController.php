<?php

class CourseController
{
    private $model;

    public function __construct(CourseModel $model)
    {
        $this->model = $model;
    }

    public function listCourses()
    {
        $userId = $_SESSION['userId'];
        $courses = $this->model->getCoursesForUser($userId);
        $usuario = $this->model->obtenerDatosUsuarioPorId($userId);
        $informacionEquipo1 = $this->model->obtenerInformacionEquipo($userId);


        // Combinar todos los datos en un solo array
        $data = [
            'cursos' => $courses,
            'usuarioVista' => $usuario,
            'informacionEquipo' => $informacionEquipo1
        ];

        require './views/principal.php';
    }


    public function login()
    {
        // Verificar si el usuario ya está autenticado
        if (isset($_SESSION['userId'])) {
            // El usuario ya está autenticado, redireccionar a la lista de cursos
            $userId = $_SESSION['userId'];
            $courses = $this->model->getCoursesForUser($userId);
            $usuario = $this->model->obtenerDatosUsuarioPorId($userId);

            $informacionEquipo1 = $this->model->obtenerInformacionEquipo($userId);


            // Combinar todos los datos en un solo array
            $data = [
                'cursos' => $courses,
                'usuarioVista' => $usuario,
                'informacionEquipo' => $informacionEquipo1
            ];

            require './views/principal.php';
        } else
            // Verificar si se ha enviado el formulario de inicio de sesión
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // print_r($_POST);
                // Obtener el DNI ingresado por el usuario
                $dni = $_POST['dni'];
                // Realizar la autenticación en tu modelo
                $authenticated = $this->model->authenticateUser($dni);

                if ($authenticated) {
                    // El usuario se autenticó correctamente, redireccionar a la lista de cursos

                    // El usuario ya está autenticado, redireccionar a la lista de cursos
                    $userId =  $_SESSION['userId'];
                    // print_r($userId);

                    $courses = $this->model->getCoursesForUser($userId);
                    $informacionEquipo1 = $this->model->obtenerInformacionEquipo($userId);
                    // print_r($informacionEquipo1);
                    $usuario = $this->model->obtenerDatosUsuarioPorId($userId);



                    // Combinar todos los datos en un solo array
                    $data = [
                        'cursos' => $courses,
                        'usuarioVista' => $usuario,
                        'informacionEquipo' => $informacionEquipo1
                    ];

                    // Pasar los cursos a la vista
                    require './views/principal.php';
                } else {
                    // Autenticación fallida, mostrar un mensaje de error en la vista de inicio de sesión
                    $error = "Autenticación fallida. Por favor, verifica tu DNI.";
                    require './views/login.php';
                }
            } else {
                // Si no se ha enviado el formulario, mostrar la vista de inicio de sesión
                require './views/login.php';
            }
    }
}
