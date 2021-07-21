<!DOCTYPE html>
<?php
  
    include_once ($_SERVER['DOCUMENT_ROOT'].'/cuidotuamigo/rutas.php');
    include (DATA_PATH."conexiondb.php");

    
    $array = array("../../../estatico/css/mi_cuenta.css", "../../../estatico/css/admin.css", "../../../estatico/css/reserva.css","../../../estatico/font/css/all.css");
    include('../../comun/head.php');

    $pathPrivadoAdmin = VPRIVADO_ADMIN_PATH;

  

    $consulta = "select c.id_cliente, p.nombre, CONCAT( p.apellido_paterno, ' ',p.apellido_materno) as apellidos, CONCAT(p.direccion, ', ',c2.nombre_comuna ) as direccion,
    p.telefono, p.correo, c.estado_cliente 
    from cuidotuamigodb.cliente c
    inner join cuidotuamigodb.persona p on p.id_persona  = c.id_persona 
    inner join cuidotuamigodb.comuna c2 on c2.id_comuna = p.id_comuna 
    where estado_cliente ='PENDIENTE'"; 

    $resultado = mysqli_query($conex,$consulta);

    $view = false;
    $alerta = false;

    if (isset($_GET['asc'])) {

        $idCliente=$_GET["asc"];

        $email=$_GET["ascorr"];

        $queryValida= "select id_usuario from cuidotuamigodb.usuario u where u.correo ='$email'";
        $resultadoValida = mysqli_query($conex, $queryValida);

        if($resultadoValida && $resultadoValida->num_rows >0){
            $alerta = true;

            $data = [
                'error' => true,
                'mensaje' => 'El correo indicado en la solicitud ya se encuentra registrado en otro cliente' 
            ];
        }else{
            $queryCreateUser = "INSERT INTO cuidotuamigodb.usuario
            (id_perfil_usuario, correo, contrasenia)
            VALUES(3, '$email', 'cta01');
            ";

            $resultadoCreate = mysqli_query($conex, $queryCreateUser);
            if ($resultadoCreate){

                $querySelect = "select id_usuario from cuidotuamigodb.usuario u where u.correo ='$email'";
                $resultadoSelect = mysqli_query($conex, $querySelect);
            
                if($resultadoSelect && $resultadoSelect->num_rows == 1){
                    $rowSelect = mysqli_fetch_array($resultadoSelect);
                    $idUsuario = $rowSelect["id_usuario"];

                    $queryUpdateCliente = "update cliente set estado_cliente='ACTIVO', id_usuario=$idUsuario where id_cliente=$idCliente";
                    $resultadoUpdate = mysqli_query($conex, $queryUpdateCliente);
                    if ($resultadoUpdate){
                        $message = "La solicitud fue aprobada";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                        header("Location:$pathPrivadoAdmin/solicitudes.php");
                        
                    }else{
                        echo mysqli_error($conex);
                    }
                }
            }else{
                echo mysqli_error($conex);
            }
        }

        

         
    }
    if (isset($_GET['rsc'])) {

        $idCliente=$_GET["rsc"];
        $queryUpdateCliente = "update cliente set estado_cliente='RECHAZADO' where id_cliente=$idCliente";
        $resultadoUpdate = mysqli_query($conex, $queryUpdateCliente);
        if ($resultadoUpdate){
            $message = "La solicitud fue rechaza";
            echo "<script type='text/javascript'>alert('$message');</script>";
            header("Location:$pathPrivadoAdmin/solicitudes.php");
        }else{
            echo mysqli_error($conex);
        } 
    }

?>

<body>

    <div id="contenedor"> <!-- Contenedor-->
        <?php
            include('../../comun/header.php');
        ?>
        <?php
            include('../../comun/menu_privado_admin.php');
        ?>

        <div class="contenido">
            <h2 >Solicitudes Pendientes</h2><br>
            <?php
                if ($alerta) {
            ?>
            <div class="container mt-3">
                <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-<?= $data['error'] ? 'danger' : 'success' ?>" role="alert">
                        <?= $data['mensaje'] ?>
                    </div>
                </div>
                </div>
            </div>
            <?php
                }
            ?>
            <div class="table_mis_reservas_container">
                <table class="table table-striped table_mis_reservas" style="background-color: white">
                    <thead>
                        <tr>
                            <th class="col_3">Nombre</th>
                            <th class="col_1_1">Teléfono</th>
                            <th class="col_1_1">Dirección</th>                                
                            <th class="col_1_1">Correo</th>
                            <th class="col_1_1">Acciones</th>
                        </tr>
                    </thead>
                    <?php 
                        if(isset($resultado)){
                            while ($row = mysqli_fetch_array($resultado)) { ?>
                    <tr>
                        <td class="col_3"><?php echo $row['nombre'].' '.$row['apellidos']; ?></td>
                        <td class="col_1_1"><?php echo $row['telefono']; ?></td>
                        <td class="col_1_1"><?php echo $row['direccion']; ?></td>
                        <td class="col_1_1"><?php echo $row['correo']; ?></td>
                        <td class="col_1_1">
                            <a href="solicitudes.php?asc=<?php echo $row['id_cliente']?>&ascorr=<?php echo $row['correo']?>" class="del_btn" onclick="return confirm('¿Esta seguro que desea aprobar esta solicitud?. Esto le generará una cuenta a este cliente y se le notificará por correo');"><span class="fas fa-check"></span></a>
                            &nbsp;&nbsp;
                            <a href="solicitudes.php?rsc=<?php echo $row['id_cliente']?>" class="del_btn" onclick="return confirm('¿Esta seguro que desea rechazar esta solicitud?. Esto notificará al cliente del rechazo de la solicitud');"><span class="fas fa-times"></span></a>
                        </td>
                    </tr>
                    <?php 
                            }
                        } 
                    ?>
                </table>
            </div>
            <br/>
            

                
        </div>

        <?php
            include('../../comun/footer.php');
        ?>

    </div>
</body>

</html>