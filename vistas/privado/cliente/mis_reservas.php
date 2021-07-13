<?php
    
    include_once ($_SERVER['DOCUMENT_ROOT'].'/cuidotuamigo/rutas.php');
    include (DATA_PATH."conexiondb.php");
    $array = array("../../../estatico/css/reserva.css");

    $pathPrivadoCliente = VPRIVADO_CLIENTE_PATH;

    if (isset($_SESSION['id_cliente'])) {
        $idCliente = $_SESSION['id_cliente'];

        $consulta = "select a.id_atencion, m.nombre as mascota, p.nombre, p.apellido_paterno, h.fecha , h.hora_dia , a.estado_atencion from cuidotuamigodb.atencion a 
        inner join cuidotuamigodb.mascota m on m.id_mascota = a.id_mascota 
        inner join cuidotuamigodb.horario h on h.id_horario = a.id_horario 
        inner join cuidotuamigodb.trabajador t on t.id_trabajador  = a.id_trabajador 
        inner join cuidotuamigodb.persona p on p.id_persona = t.id_persona 
        where m.id_cliente = $idCliente
        order by h.fecha, h.hora_dia desc"; 

        $resultado = mysqli_query($conex,$consulta);
    }

    if (isset($_GET['del_id_atencion'])) {
        
        $idAtencion=$_GET["del_id_atencion"];
        
        $queryDelAtencion = "DELETE FROM atencion where id_atencion = $idAtencion";
        $resultadoDelAtencion = mysqli_query($conex, $queryDelAtencion);

        if ($resultadoDelAtencion){
            header("Location:$pathPrivadoCliente/mi_cuenta.php");
        }else{
            echo mysqli_error($conex);
        }    
    }
?>
<div>
    
        <div class="contenido">
            <h2 >Mis reservas agendadas</h2><br>
            <div class="table_mis_reservas_container">
                <table class="table table-striped table_mis_reservas" style="background-color: white" id="reservas">
                    <thead>
                        <tr>
                        <th scope="col" class="table_mis_reservas_tr_10"></th>
                        <th scope="col" class="table_mis_reservas_tr_15">Mascota</th>
                        <th scope="col" class="table_mis_reservas_tr_20">Paseador</th>
                        <th scope="col" class="table_mis_reservas_tr_15">Fecha</th>
                        <th scope="col" class="table_mis_reservas_tr_15">Hora</th>
                        <th scope="col" class="table_mis_reservas_tr_15">Estado</th>
                        <th scope="col" class="table_mis_reservas_tr_10">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="tbd">
                        <?php 
                            if(isset($resultado)){
                                while ($row = mysqli_fetch_array($resultado)) { ?>
                        <tr>
                            <td class="table_mis_reservas_tr_10">
                                <?php 
                                    if(isset($row['estado_atencion']) && strcasecmp($row['estado_atencion'],"pendiente") == 0){
                                ?>  
                                    <i style="color: orange" class="bi bi-hourglass-split"></i>  
                                <?php 
                                    }else{
                                ?>
                                    <i style="color: green" class="bi bi-check-lg"></i>  
                                <?php 
                                    }
                                ?>
                            </td>
                            <td class="table_mis_reservas_tr_15"><?php echo $row['mascota']; ?></td>
                            <td class="table_mis_reservas_tr_20"><?php echo $row['nombre']." ".$row['apellido_paterno']; ?></td>
                            <td class="table_mis_reservas_tr_15"><?php echo $row['fecha']; ?></td>
                            <td class="table_mis_reservas_tr_15"><?php echo $row['hora_dia']; ?></td>
                            <td class="table_mis_reservas_tr_15"><?php echo $row['estado_atencion']; ?></td>

                            <td class="table_mis_reservas_tr_10">
                                <?php 
                                    if(isset($row['estado_atencion']) && strcasecmp($row['estado_atencion'],"pendiente") == 0){
                                ?>
                                    <a href="mis_reservas.php?del_id_atencion=<?php echo $row['id_atencion']?>" class="del_btn" onclick="return confirm('Esta seguro que desea eliminar el registro de la reserva?');"><span class="fa fa-trash"></span></a>
                                <?php 
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php 
                                }
                            } 
                        ?>
                    </tbody>
                </table>
                
            </div>
            <br/>

                
        </div>

   
</div>