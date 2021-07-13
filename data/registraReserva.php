<?php

if( isset($_GET['idTrab']) && isset($_GET['idMasc']) && isset($_GET['idHorario']) ) {
    registraHorario($_GET['idTrab'], $_GET['idMasc'], $_GET['idHorario']);
} else {
    die("Solicitud no válida.");
}

function registraHorario($idTrab, $idMasc, $idHorario ) {
    
    //Cambia por los detalles de tu base datos
    $dbserver = "localhost";
    $dbuser = "root";
    $password = "";
    $dbname = "cuidotuamigodb";
    
    $database = new mysqli($dbserver, $dbuser, $password, $dbname);
    
    if($database->connect_errno) {
        die("No se pudo conectar a la base de datos");
    }
    
    $jsondata = array();
    
    //Sanitize ipnut y preparar query

    $queryInsert = "INSERT INTO cuidotuamigodb.atencion
                    (id_horario, id_trabajador, id_mascota, estado_atencion)
                    VALUES($idHorario, $idTrab, $idMasc, 'PENDIENTE');
                    ";

    $resultado = mysqli_query($database, $queryInsert);
  
    
    if ( $resultado) {
        
        $jsondata["success"] = true;
        $jsondata["data"]["message"] = sprintf("Registros creados %d-%d-%d",$idTrab, $idMasc, $idHorario);
        
        
    } else {
        
        $jsondata["success"] = false;
        $jsondata["data"] = array(
            'message' => $database->error
        );
        
    }
    
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata, JSON_FORCE_OBJECT);
    
    $database->close();
    
}

exit();                            