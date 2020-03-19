<?php

require_once '../core/views_helper.php';

$diccionario = array(
    'config' => array
    (
      'DIR_PRINCIPAL' => DIR_PRINCIPAL,
    ),
    'subtitle' => array
    (
        VIEW_SET_USER => 'Crear Nuevo Usuario',
        VIEW_GET_USER => 'Buscar Usuario',
        VIEW_DELETE_USER => 'Eliminar un Usuario',
        VIEW_EDIT_USER => 'Editar un Usuario',
    ),
    'links_menu' => array 
    (
        'VIEW_SET_USER' => '/'.DIR_PRINCIPAL.'/'.MODULO.VIEW_SET_USER.'/',
        'VIEW_GET_USER' => '/'.DIR_PRINCIPAL.'/'.MODULO.VIEW_GET_USER.'/',
        'VIEW_DELETE_USER' => '/'.DIR_PRINCIPAL.'/'.MODULO.VIEW_DELETE_USER.'/',
        'VIEW_EDIT_USER' => '/'.DIR_PRINCIPAL.'/'.MODULO.VIEW_EDIT_USER.'/',
    ),
    'form_actions' => array
    (
        'SET'=>'/'.DIR_PRINCIPAL.'/'.MODULO.SET_USER.'/',
        'GET'=>'/'.DIR_PRINCIPAL.'/'.MODULO.GET_USER.'/',
        'DELETE'=>'/'.DIR_PRINCIPAL.'/'.MODULO.DELETE_USER.'/',
        'EDIT'=>'/'.DIR_PRINCIPAL.'/'.MODULO.EDIT_USER.'/',
    )
);

function retornar_vista($vista, $data = array()) {
    
    global $diccionario;
    
    $modulo = substr(MODULO, 0, -1);
    $html = ViewsHelper::get_template('template',$modulo);
    $html = str_replace('{subtitulo}', $diccionario['subtitle'][$vista],$html);
    $html = str_replace('{formulario}', ViewsHelper::get_template($vista,$modulo), $html);
    $html = ViewsHelper::render_dinamic_data($html, $diccionario['form_actions']);
    $html = ViewsHelper::render_dinamic_data($html, $diccionario['links_menu']);
    $html = ViewsHelper::render_dinamic_data($html, $diccionario['config']);
    $html = ViewsHelper::render_dinamic_data($html, $data);

    if (array_key_exists('nombre', $data) &&  array_key_exists('apellido', $data) && $vista == VIEW_EDIT_USER) {
        $mensaje = 'Editar usuario ' . $data['nombre'] . ' ' . $data['apellido'];
    } else {
        if (array_key_exists('mensaje', $data)) {
            $mensaje = $data['mensaje'];
        } else {
            $mensaje = 'Datos del usuario:';
        }
    }
    $html = str_replace('{mensaje}', $mensaje, $html);
    print $html;
}

?>