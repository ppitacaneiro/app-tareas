<?php

require_once '../core/db_abstract_model.php';

class Usuario extends DBAbstractModel {
   
    public $nombre;
    public $apellido;
    public $email;
    private $clave;
    protected $id;
    
    public function __construct() {
        $this->db_table = 'usuarios';
    }
    
    // eliminar un usuario
    public function delete($user_email = '') {
        $this->query = ""
                . "DELETE FROM $this->db_table"
                . " WHERE email = '$user_email'";
        $this->execute_single_query();
        $this->mensaje = 'Usuario eliminado';
    }
    
    // editar los datos de un usuario
    public function edit($user_data = array()) {
        foreach ($user_data as $campo => $valor) {
            $$campo = $valor;
        }
        $this->query = ""
                . "UPDATE $this->db_table"
                . " SET nombre = '$nombre'"
                . " ,apellido = '$apellido'"
                . "WHERE email = '$email'";
        $this->execute_single_query();
        $this->mensaje = 'Usuario modificado';
    }
    
    // obtener todos los usuarios
    public function get_all($campos) {
        if ($campos != "") {
            $this->query = "SELECT $campos FROM $this->db_table";
            $this->get_resultados_from_query();
            return $this->rows;
        }
    }

    // traer datos de un usuario
    public function get($user_email = '') {
        if ($user_email != '') {
            $this->query = ""
                    . "SELECT id,nombre,apellido,email,clave "
                    . "FROM $this->db_table "
                    . "WHERE email = '$user_email'";
            $this->get_resultados_from_query();
        }
        
        if (count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad => $valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Usuario encontrado';
        } else {
            $this->mensaje = 'Usuario no encontrado';
        }
    }
    
    // Crear un nuevo usuario
    public function set($user_data = array()) {
        if (array_key_exists('email', $user_data)) {
            $this->get($user_data['email']);
            if ($user_data['email'] != $this->email) {
                foreach ($user_data as $campo => $valor) {
                    $$campo = $valor;
                }
                $this->query = ""
                        . "INSERT INTO $this->db_table"
                        . "(nombre,apellido,email,clave)"
                        . "VALUES"
                        . "('$nombre','$apellido','$email','$clave')";
                $this->execute_single_query();
                $this->mensaje = 'Usuario creado con exito';
            } else {
                $this->mensaje = 'El usuario ya existe';
            }
        } else {
            $this->mensaje = "No se ha agregado al usuario";
        }
    }
}

?>

