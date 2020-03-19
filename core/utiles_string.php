<?php

class UtilesString {
    
    public static function ConvertirFechaDatabase($fecha) {
        $delimiter = "/";
        $nums_fecha = explode($delimiter, $fecha);
        $fechaDatabase = $nums_fecha[2] . $nums_fecha[1] . $nums_fecha[0];
        
        return $fechaDatabase;
    }
    
}

?>

