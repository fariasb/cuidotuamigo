<?php

if( isset($_GET['fecha']) && isset($_GET['idTrab']) ) {
    get_horas($_GET['fecha'], $_GET['idTrab']);
} else {
    die("Solicitud no válida.");
}

function get_horas($fecha, $idTrab ) {
    
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
  
    
    if ( $result = $database->query( "select id_horario, TIME_FORMAT(hora_dia, '%H:%i') as hora from cuidotuamigodb.horario where DATE_FORMAT(fecha,'%d-%m-%Y') = '$fecha' and id_trabajador=$idTrab" ) ) {
        
        if( $result->num_rows > 0 ) {
            
            $jsondata["success"] = true;
            $jsondata["data"]["message"] = sprintf("Se han encontrado %d usuarios", $result->num_rows);
            $jsondata["data"]["horarios"] = array();
            while( $row = $result->fetch_object() ) {
                
                $jsondata["data"]["horarios"][] = $row;
            }
            
        } else {
            
            $jsondata["success"] = false;
            $jsondata["data"] = array(
                'message' => 'No se encontró ningún resultado.'
            );
            
        }
        
        $result->close();
        
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