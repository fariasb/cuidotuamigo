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
    
    $query = "select h.id_horario, TIME_FORMAT(h.hora_dia, '%H:%i') as hora, a.id_atencion as id_atencion
    from cuidotuamigodb.horario h
    left join cuidotuamigodb.atencion a on a.id_horario = h.id_horario 
    where DATE_FORMAT(h.fecha,'%d-%m-%Y') = '$fecha' 
    and h.id_trabajador=$idTrab and a.id_atencion is NULL order by hora asc";
    
    if ( $result = $database->query( $query ) ) {
        
        if( $result->num_rows > 0 ) {
            
            $jsondata["success"] = true;
            $jsondata["data"]["message"] = sprintf("Se han encontrado %d horarios", $result->num_rows);
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