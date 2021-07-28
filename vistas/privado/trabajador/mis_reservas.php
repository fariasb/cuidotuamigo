<!DOCTYPE html>
<?php
  
    include_once ($_SERVER['DOCUMENT_ROOT'].'/cuidotuamigo/rutas.php');
    include (DATA_PATH."conexiondb.php");
    $array = array("../../../estatico/css/mi_cuenta.css", "../../../estatico/css/admin_reservas.css", "../../../estatico/css/reserva.css");
    include('../../comun/head.php');

    $pathPrivadoTrabajador = VPRIVADO_TRAB_PATH;

    if (isset($_SESSION['id_trabajador'])) {
        $idTrabajador = $_SESSION['id_trabajador'];

        $consulta = "select a.id_atencion, m.nombre as mascota, p.nombre, p.apellido_paterno, h.fecha , h.hora_dia , a.estado_atencion, pl.nombre_plan  from cuidotuamigodb.atencion a 
        inner join cuidotuamigodb.mascota m on m.id_mascota = a.id_mascota 
        inner join cuidotuamigodb.cliente c on c.id_cliente = m.id_cliente 
        inner join cuidotuamigodb.horario h on h.id_horario = a.id_horario 
        inner join cuidotuamigodb.trabajador t on t.id_trabajador  = a.id_trabajador 
        inner join cuidotuamigodb.persona p on p.id_persona = c.id_persona 
        inner join cuidotuamigodb.plan pl on pl.id_plan = a.id_plan
        where t.id_trabajador = $idTrabajador
        order by h.fecha, h.hora_dia desc"; 

        $resultado = mysqli_query($conex,$consulta);
    }

    $edit = false;
    if (isset($_GET['eia'])) {
        
        $editIdAtencion=$_GET["eia"];
        $acc=$_GET["acc"];

        if($acc == "close"){
            $edit = false;
            header("Location:$pathPrivadoTrabajador/mis_reservas.php");

        } elseif ($acc == "done") {
            $queryUpdatePersona = "update atencion set estado_atencion='REALIZADO' where id_atencion=$editIdAtencion";
            $resultadoUpdate = mysqli_query($conex, $queryUpdatePersona);
            if ($resultadoUpdate){
                header("Location:$pathPrivadoTrabajador/mis_reservas.php");
            }else{
                echo mysqli_error($conex);
            } 
            

        } elseif ($acc == "undo") {
            $queryUpdatePersona = "update atencion set estado_atencion='PENDIENTE' where id_atencion=$editIdAtencion";
            $resultadoUpdate = mysqli_query($conex, $queryUpdatePersona);
            if ($resultadoUpdate){
                header("Location:$pathPrivadoTrabajador/mis_reservas.php");
            }else{
                echo mysqli_error($conex);
            } 
            

        }else{
            $edit = true;

            $queryAtencion = "select a.id_atencion, a.estado_atencion ,m.nombre as mnombre, p.nombre, p.apellido_paterno, p.apellido_materno, p.direccion, p.telefono,
            co.nombre_comuna , h.fecha ,TIME_FORMAT(h.hora_dia, '%H:%i') as hora_dia , m.color, m.raza , m.sexo, m.edad, m.vacunas, m.enfermedad,  pl.nombre_plan from cuidotuamigodb.atencion a 
            inner join cuidotuamigodb.mascota m on m.id_mascota = a.id_mascota 
            inner join cuidotuamigodb.cliente c on c.id_cliente = m.id_cliente 
            inner join cuidotuamigodb.horario h on h.id_horario = a.id_horario 
            inner join cuidotuamigodb.trabajador t on t.id_trabajador  = a.id_trabajador 
            inner join cuidotuamigodb.persona p on p.id_persona = c.id_persona 
            inner join cuidotuamigodb.comuna co on co.id_comuna = p.id_comuna 
            inner join cuidotuamigodb.plan pl on pl.id_plan = a.id_plan
            where a.id_atencion =$editIdAtencion";

            $resultadoAtencion = mysqli_query($conex,$queryAtencion);

            $rowAtencion = mysqli_fetch_array($resultadoAtencion);
            
        }
        
      
    }

?>

<body>

    <div id="contenedor"> <!-- Contenedor-->
        <?php
            include('../../comun/header.php');
        ?>
        <?php
            include('../../comun/menu_privado_trabajador.php');
        ?>

        <div>
            
            <div class="contenido">
                <h2 >Mis reservas agendadas</h2><br>
                <div class="table_mis_reservas_container">
                    <table class="table table-striped table_mis_reservas" style="background-color: white" id="reservas">
                        <thead>
                            <tr>
                            <th scope="col" class="table_mis_reservas_tr_5"></th>
                            <th scope="col" class="table_mis_reservas_tr_15">Mascota</th>
                            <th scope="col" class="table_mis_reservas_tr_20">Tutor</th>
                            <th scope="col" class="table_mis_reservas_tr_20">Fecha</th>
                            <th scope="col" class="table_mis_reservas_tr_15">Hora</th>
                            <th scope="col" class="table_mis_reservas_tr_15">Tipo</th>
                            <th scope="col" class="table_mis_reservas_tr_15">Estado</th>
                            <th scope="col" class="table_mis_reservas_tr_10">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tbd">
                            <?php 
                                if(isset($resultado)){
                                    while ($row = mysqli_fetch_array($resultado)) { ?>
                            <tr>
                                <td class="table_mis_reservas_tr_5">
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
                                <td class="table_mis_reservas_tr_20"><?php echo $row['fecha']; ?></td>
                                <td class="table_mis_reservas_tr_15"><?php echo $row['hora_dia']; ?></td>
                                <td class="table_mis_reservas_tr_15"><?php echo $row['nombre_plan']; ?></td>
                                <td class="table_mis_reservas_tr_15"><?php echo $row['estado_atencion']; ?></td>

                                <td class="table_mis_reservas_tr_10">
                                    <a href="mis_reservas.php?acc=view&eia=<?php echo $row['id_atencion']?>" class="del_btn" ><span class="fa fa-chevron-circle-right"></span></a>
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
                <?php 
                    if($edit){
                ?>
                    <div style="background-color: white; margin: 5%">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-3"><strong>Datos de la Mascota</strong></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-5">Reserva : <?php echo $rowAtencion['fecha'].' '.$rowAtencion['hora_dia'].' hrs.'; ?></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-1"></div>    
                            <div class="col-md-2" style="text-align: left">Tutor:</div>
                            <div class="col-md-3" style="text-align: left"><?php echo $rowAtencion['nombre'].' '.$rowAtencion['apellido_paterno'].' '.$rowAtencion['apellido_materno']; ?></div>
                            <div class="col-md-2" style="text-align: left">Telefono:</div>
                            <div class="col-md-3" style="text-align: left"><?php echo $rowAtencion['telefono']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>    
                            <div class="col-md-2" style="text-align: left">Nombre:</div>
                            <div class="col-md-3" style="text-align: left"><?php echo $rowAtencion['mnombre']; ?></div>
                            <div class="col-md-2" style="text-align: left">Dirección:</div>
                            <div class="col-md-3" style="text-align: left"><?php echo $rowAtencion['direccion'].', '.$rowAtencion['nombre_comuna']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>    
                            <div class="col-md-2" style="text-align: left">Raza:</div>
                            <div class="col-md-3" style="text-align: left"><?php echo $rowAtencion['raza']; ?></div>
                            <div class="col-md-2" style="text-align: left">Sexo:</div>
                            <div class="col-md-3" style="text-align: left"><?php echo $rowAtencion['sexo']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>    
                            <div class="col-md-2" style="text-align: left">Color:</div>
                            <div class="col-md-3" style="text-align: left"><?php echo $rowAtencion['color']; ?></div>
                            <div class="col-md-2" style="text-align: left">Edad:</div>
                            <div class="col-md-3" style="text-align: left"><?php echo $rowAtencion['edad']; ?> años</div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-1"></div>    
                            <div class="col-md-2" style="text-align: left">Vacunas:</div>
                            <div class="col-md-3" style="text-align: left"><?php echo $rowAtencion['vacunas']; ?></div>
                            <div class="col-md-2" style="text-align: left">Enfermedad:</div>
                            <div class="col-md-3" style="text-align: left"><?php echo $rowAtencion['enfermedad']; ?></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4"></div>    
                            <div class="col-md-2"><input type="button" value="  Cerrar  " onclick="location.href='mis_reservas.php?acc=close'"  class="btn btn_planes"></div>
                            <div class="col-md-1"></div> 
                            <div class="col-md-2">
                                <?php 
                                    if(isset($rowAtencion['estado_atencion']) && strcasecmp($rowAtencion['estado_atencion'],"pendiente") == 0){
                                ?>  
                                    <input type="button" value=" Realizado " onclick="location.href='mis_reservas.php?acc=done&eia=<?php echo $rowAtencion['id_atencion']?>'"  class="btn btn-success">
                                <?php 
                                    }else{
                                ?>
                                    <input type="button" value="Marcar Pendiente" onclick="location.href='mis_reservas.php?acc=undo&eia=<?php echo $rowAtencion['id_atencion']?>'"  class="btn btn-warning">
                                <?php 
                                    }
                                ?>
                                
                            </div>
                        </div>
                        <br>
                    </div>

                
                <?php 
                    }
                ?>
                
                    
            </div>


        </div>

        <?php
            include('../../comun/footer.php');
        ?>

    </div>
</body>

</html>