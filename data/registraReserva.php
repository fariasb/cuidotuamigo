<?php

if( isset($_GET['idTrab']) && isset($_GET['idMasc']) && isset($_GET['idHorario']) && isset($_GET['tipoPlan']) ) {
    registraHorario($_GET['idTrab'], $_GET['idMasc'], $_GET['idHorario'],$_GET['tipoPlan']);
} else {
    die("Solicitud no válida.");
}

function registraHorario($idTrab, $idMasc, $idHorario, $tipoPlan ) {
    
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
                    (id_horario, id_trabajador, id_mascota, estado_atencion, id_plan)
                    VALUES($idHorario, $idTrab, $idMasc, 'PENDIENTE', $tipoPlan);
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