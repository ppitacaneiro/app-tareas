<?php

require_once '../core/db_abstract_model.php';
require_once '../core/utiles_string.php';

class Tarea extends DBAbstractModel {
    
    protected $id;
    public $id_usuario;
    public $titulo;
    public $descripcion;
    public $fecha_alta;
    public $fecha_limite;
    public $fecha_realizacion;
    public $tiempo_realizacion;
    public $estado;
    public $ficheros_modificados;
    public $notas_desarrollador;
    
    public function __construct() {
        $this->db_table = 'tareas';
    }
    
    public function delete() {
        echo 'delete()';
    }

    public function edit() {
        echo 'edit()';
    }

    public function get() {
        echo 'get()';
    }

    // Crear una nueva tarea
    public function set($tarea_data = array()) {
        if (array_key_exists('id_usuario', $tarea_data)) {
            if ($tarea_data['titulo'] == '') {
                $this->mensaje = "Debe indicar un titulo para la tarea"; 
            }
            elseif ($tarea_data['descripcion'] == '') {
                $this->mensaje = "Debe indicar una descripcion para la tarea"; 
            }
            else
            {
                foreach ($tarea_data as $campo => $valor) {
                    $$campo = $valor;
                }
                
                $fecha_alta = UtilesString::ConvertirFechaDatabase($fecha_alta);
                $fecha_limite = UtilesString::ConvertirFechaDatabase($fecha_limite);
                $fecha_realizacion = UtilesString::ConvertirFechaDatabase($fecha_realizacion);
                
                $this->query = "INSERT INTO $this->db_table "
                        . "(id_usuario,
                            titulo,
                            descripcion,
                            fecha_alta,
                            fecha_limite,
                            fecha_realizacion,
                            tiempo_realizacion,
                            estado,
                            ficheros_modificados,
                            notas_desarrollador)"
                        ."VALUES"
                        ."('$id_usuario',
                            '$titulo',
                            '$descripcion',
                            '$fecha_alta',
                            '$fecha_limite',
                            '$fecha_realizacion',
                            '$tiempo_realizacion',
                            '$estado',
                            '$ficheros_modificados',
                            '$notas_desarrollador'
                            )";
                $this->execute_single_query();
                $this->mensaje = "Tarea creada con exito";
            }
        }
        else
        {
            $this->mensaje = "Imposible crear tarea sin asignar usuario";
        }
    }
}

?>

