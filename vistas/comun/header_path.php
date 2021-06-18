<?php

    $path = getcwd();

    $pathEstatico = "estatico";
    $pathData = "data";
    $pathPublico = "vistas/publico/";
    $pathPrivadoAdmin = "vistas/privado/admin";

    if (endswithH($path, 'cuidotuamigo03')) {
        if(isset($_SESSION)){
            session_destroy();
        }
    }

    if (endswithH($path, 'admin')) {
        $pathEstatico = "../../../estatico";
        $pathData = "../../../data";
        $pathPrivadoAdmin = "";
    }
    if (endswithH($path, 'cliente')) {
        $pathEstatico = "../../../estatico";
        $pathData = "../../../data";
    }
    if ( endswithH($path, 'trabajador')) {
        $pathEstatico = "../../../estatico";
        $pathData = "../../../data";
    }
    if (endswithH($path, 'publico')) {
        $pathEstatico = "../../estatico";
        $pathPublico = "";
        $pathData = "../../data";
    }

    include("$pathData/conexiondb.php");

    include("$pathData/conexiondb.php");

    function endswithH($string, $test) {
        $strlen = strlen($string);
        $testlen = strlen($test);
        if ($testlen > $strlen) return false;
        return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
    }

?>