<?php

require_once '../config/database.php';

abstract class DBAbstractModel {
    
    private static $db_host = HOST;
    private static $db_user = USER;
    private static $db_pass = PASSWORD;
    protected $db_name = BBDD;
    protected $db_table;
    protected $query;
    protected $rows = array();
    private $conn;
    public $mensaje = 'Hecho';
    
    // Metodos abstractos para ABM de clases que hereden
    abstract public function get();
    abstract public function set();
    abstract public function edit();
    abstract public function delete();
    
    // Los siguiente metodos no son abstactos y pueden definirse con exactitud
    // Conectar a la base de datos
    private function open_connection() {
        $this->conn = new mysqli(self::$db_host, self::$db_user, self::$db_pass, $this->db_name);
    }
    
    // Desconectar de la base de datos
    private function close_connection() {
        $this->conn->close();
    }
    
    // Ejecutar un query simple del tipo INSERT, UPDATE, DELETE
    protected function execute_single_query() {
        if($_POST) {
            $this->open_connection();
            $this->conn->query($this->query);
            $this->close_connection();
        } else {
            $mensaje = 'Metodo no permitido';
        }
    }
    
    // Traer resultados de una consulta en un array
    protected function get_resultados_from_query() {
        $this->open_connection();
        $result = $this->conn->query($this->query) or die($this->conn->error);
        while($this->rows[] = $result->fetch_assoc());
        $result->close();
        $this->close_connection();
        array_pop($this->rows);
    }
}

?>
