<?php

require_once('../config/global_constants.php');
require_once('constants.php');
require_once('model.php');
require_once('../usuarios/model.php');
require_once('view.php');

function handler() {
    $event = VIEW_GET_TAREA;
    $uri = $_SERVER['REQUEST_URI'];
    $peticiones = array(
        SET_TAREA,
        GET_TAREA,
        DELETE_TAREA,
        EDIT_TAREA,
        VIEW_SET_TAREA,
        VIEW_GET_TAREA,
        VIEW_DELETE_TAREA,
        VIEW_EDIT_TAREA
    );

    foreach ($peticiones as $peticion) {
        $uri_peticion = MODULO . $peticion . '/';
        if (strpos($uri, $uri_peticion) == true) {
            $event = $peticion;
        }
    }

    $tarea_data = helper_tarea_data();
    $tarea = set_obj_tarea();
    $usuario = set_obj_user();
    switch ($event) {
        case VIEW_SET_TAREA :
            $lista_usuarios = $usuario->get_all('id,nombre');
            $options_usuarios = ViewsHelper::options_select($lista_usuarios);
            $data = array('usuarios' => $options_usuarios);
            retornar_vista(VIEW_SET_TAREA, $data);
            break;
        case SET_TAREA :
            $tarea->set($tarea_data);
            $data = array('mensaje' => $tarea->mensaje);
            retornar_vista(VIEW_SET_TAREA, $data);
        break;
        case VIEW_GET_TAREA :
            $lista_usuarios = $usuario->get_all('id,nombre');
            $options_usuarios = ViewsHelper::options_select($lista_usuarios);
            $data = array('usuarios' => $options_usuarios);
            retornar_vista(VIEW_GET_TAREA, $data);
        break;
        default:
            retornar_vista($event);
    }
}

function set_obj_tarea() {
    $obj = new Tarea();
    return $obj;
}

function set_obj_user() {
    $user = new Usuario;
    return $user;
}

function helper_tarea_data() {
    $tarea_data = array();
    if ($_POST) {
        if (array_key_exists('titulo', $_POST)) {
            $tarea_data['titulo'] = $_POST['titulo'];
        }
        if (array_key_exists('id_usuario', $_POST)) {
            $tarea_data['id_usuario'] = $_POST['id_usuario'];
        }
        if (array_key_exists('descripcion', $_POST)) {
            $tarea_data['descripcion'] = $_POST['descripcion'];
        }
        if (array_key_exists('fecha_alta', $_POST)) {
            $tarea_data['fecha_alta'] = $_POST['fecha_alta'];
        }
        if (array_key_exists('fecha_limite', $_POST)) {
            $tarea_data['fecha_limite'] = $_POST['fecha_limite'];
        }
        if (array_key_exists('fecha_realizacion', $_POST)) {
            $tarea_data['fecha_realizacion'] = $_POST['fecha_realizacion'];
        }
        if (array_key_exists('tiempo_realizacion', $_POST)) {
            $tarea_data['tiempo_realizacion'] = $_POST['tiempo_realizacion'];
        }
        if (array_key_exists('estado', $_POST)) {
            $tarea_data['estado'] = $_POST['estado'];
        }
        if (array_key_exists('ficheros_modificados', $_POST)) {
            $tarea_data['ficheros_modificados'] = $_POST['ficheros_modificados'];
        }
        if (array_key_exists('notas_desarrollador', $_POST)) {
            $tarea_data['notas_desarrollador'] = $_POST['notas_desarrollador'];
        }
    } 
    return $tarea_data;
}

handler();
?>

