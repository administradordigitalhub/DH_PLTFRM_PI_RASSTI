<?php
class DatabaseConnection {
    private static $instance = null;
    private $connection;

    private $host = 'localhost'; // o la dirección del servidor de base de datos
    private $user = 'root'; // el usuario de la base de datos
    private $pass = ''; // la contraseña del usuario
    private $name = 'digitalh_CursoDB'; // el nombre de la base de datos

    private function __construct() {
        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->name);
        if ($this->connection->connect_error) {
            die('Conexión fallida: ' . $this->connection->connect_error);
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance->connection;
    }

    // No olvides cerrar la conexión cuando ya no sea necesaria
    public function close() {
        $this->connection->close();
    }
}
