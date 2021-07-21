<?php

if( isset($_GET['accion']) ) {
    if($_GET['accion'] == "create"){
        if( isset($_GET['idTrab']) && isset($_GET['hora']) && isset($_GET['fecha']) && isset($_GET['idHorario']) ){
            registraHorario($_GET['idTrab'], $_GET['hora'], $_GET['fecha'], $_GET['idHorario']);
        }else{
            die("Solicitud no válida."); 
        }
    }
    if($_GET['accion'] == "delete"){
        if( isset($_GET['idHorario'])) {
            eliminaHorario($_GET['idHorario']);
        }else{
            die("Solicitud no válida."); 
        } 
    }
    if($_GET['accion'] != "create" && $_GET['accion'] != "delete"){
        die("Solicitud no válida."); 
    }
}else{
    die("Solicitud no válida."); 
}


function eliminaHorario($idHorario){

    $dbserver = "localhost";
    $dbuser = "root";
    $password = "";
    $dbname = "cuidotuamigodb";
    
    $database = new mysqli($dbserver, $dbuser, $password, $dbname);
    
    if($database->connect_errno) {
        die("No se pudo conectar a la base de datos");
    }

    $jsondata = array();

    $queryInsert = "DELETE FROM cuidotuamigodb.horario
                    where id_horario=$idHorario";

    $resultado = mysqli_query($database, $queryInsert);
  
    
    if ( $resultado) {
        
        $jsondata["success"] = true;
        $jsondata["data"]["message"] = sprintf("Registro eliminado %d",$idHorario);
        
        
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
function registraHorario($idTrab, $hora, $fecha,$idHorario ) {

    $jsondata = array();
    if($idHorario >0){
        $jsondata["success"] = true;
        $jsondata["data"]["message"] = sprintf("Registros ya existente idHorario: %d",$idHorario);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsondata, JSON_FORCE_OBJECT);
        return;
    }
    
    //Cambia por los detalles de tu base datos
    $dbserver = "localhost";
    $dbuser = "root";
    $password = "";
    $dbname = "cuidotuamigodb";
    
    $database = new mysqli($dbserver, $dbuser, $password, $dbname);
    
    if($database->connect_errno) {
        die("No se pudo conectar a la base de datos");
    }
    
    
    
    //Sanitize ipnut y preparar query

    $queryInsert = "INSERT INTO cuidotuamigodb.horario
                    (id_trabajador, hora_dia, fecha)
                    VALUES( $idTrab, '$hora:00', STR_TO_DATE('$fecha','%d-%m-%Y'));
                    ";

    $resultado = mysqli_query($database, $queryInsert);
  
    
    if ( $resultado) {
        
        $jsondata["success"] = true;
        $jsondata["data"]["message"] = sprintf("Registros creados %d-%d-%d",$idTrab, $hora, $fecha);
        
        
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