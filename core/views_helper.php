<?php

class ViewsHelper {

    public static function get_template($form = 'get', $modulo) {
        $file = '../site_media/html/' . $modulo . '/' . $form . '.html';
        $template = file_get_contents($file);
        return $template;
    }

    public static function render_dinamic_data($html, $data) {
        foreach ($data as $clave => $valor) {
            $html = str_replace('{' . $clave . '}', $valor, $html);
        }
        return $html;
    }

    public static function options_select($lista = array()) {
        $options_select = "";
        $i = 0;

        foreach ($lista as $v1) {
            foreach ($v1 as $v2) {
                if ($i % 2 == 0) {
                    $options_select .= "<option value=\"" . $v2 . "\">";
                } else {
                    $options_select .= $v2 . "</option>";
                }
                $i++;
            }
        }

        return $options_select;
    }

}
?>

