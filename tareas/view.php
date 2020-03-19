<?php

require_once '../core/views_helper.php';

$diccionario = array(
    'config' => array
    (
      'DIR_PRINCIPAL' => DIR_PRINCIPAL,
    ),
    'subtitle' => array
    (
        VIEW_SET_TAREA => 'Crear Nueva Tarea',
        VIEW_GET_TAREA => 'Buscar Tareas',
        VIEW_DELETE_TAREA => 'Eliminar una Tarea',
        VIEW_EDIT_TAREA => 'Editar una Tarea',
    ),
    'links_menu' => array 
    (
        'VIEW_SET_TAREA' => '/'.DIR_PRINCIPAL.'/'.MODULO.VIEW_SET_TAREA.'/',
        'VIEW_GET_TAREA' => '/'.DIR_PRINCIPAL.'/'.MODULO.VIEW_GET_TAREA.'/',
        'VIEW_DELETE_TAREA' => '/'.DIR_PRINCIPAL.'/'.MODULO.VIEW_DELETE_TAREA.'/',
        'VIEW_EDIT_TAREA' => '/'.DIR_PRINCIPAL.'/'.MODULO.VIEW_EDIT_TAREA.'/',
    ),
    'form_actions' => array
    (
        'SET'=>'/'.DIR_PRINCIPAL.'/'.MODULO.SET_TAREA.'/',
        'GET'=>'/'.DIR_PRINCIPAL.'/'.MODULO.GET_TAREA.'/',
        'DELETE'=>'/'.DIR_PRINCIPAL.'/'.MODULO.DELETE_TAREA.'/',
        'EDIT'=>'/'.DIR_PRINCIPAL.'/'.MODULO.EDIT_TAREA.'/',
    ),
    'estados' => array
    (
        'estados' => 
            '<option>' . ESTADO_PENDIENTE .'</option>
            <option>' . ESTADO_ENPROCESO . '</option>
            <option>' . ESTADO_REALIZADO . '</option>
            <option>' . ESTADO_REVISADO . '</option>
            <option>' . ESTADO_ACTUALIZADO . '</option>'
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
    $html = ViewsHelper::render_dinamic_data($html, $diccionario['estados']);
    $html = ViewsHelper::render_dinamic_data($html, $data);

    if (array_key_exists('titulo', $data) && $vista == VIEW_EDIT_TAREA) {
        $mensaje = 'Editar tarea ' . $data['titulo'];
    } else {
        if (array_key_exists('mensaje', $data)) {
            $mensaje = $data['mensaje'];
        } else {
            $mensaje = 'Datos de la tarea:';
        }
    }
    $html = str_replace('{mensaje}', $mensaje, $html);
    print $html;
}
?>
