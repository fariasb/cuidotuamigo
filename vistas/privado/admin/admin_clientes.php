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
    where estado_cliente in ('BLOQUEADO','ACTIVO')"; 

    $resultado = mysqli_query($conex,$consulta);

    $view = false;

    if (isset($_GET['ver_mascotas'])) {

        $acc=$_GET["acc"];

        if($acc == "close"){
            $view = false;
            header("Location:$pathPrivadoAdmin/admin_clientes.php");

        }elseif ($acc == "view"){
            $view = true;
        
            $idCliente=$_GET["ver_mascotas"];
            
            $queryMascotas = "select e.nombre_especie, m.nombre, m.raza, m.edad, m.color,m.sexo, m.esterilizada, m.vacunas, m.enfermedad, m.chip_mascota  from cuidotuamigodb.mascota m
            inner join cuidotuamigodb.especie e on m.id_especie = e.id_especie 
            where m.id_cliente =$idCliente";
            $resultadoMascota = mysqli_query($conex, $queryMascotas);
    
            if ($resultadoMascota){
                
            }else{
                echo mysqli_error($conex);
            }
        }

           
    }
    if (isset($_GET['bc'])) {

        $idCliente=$_GET["bc"];
        $queryUpdateCliente = "update cliente set estado_cliente='BLOQUEADO' where id_cliente=$idCliente";
        $resultadoUpdate = mysqli_query($conex, $queryUpdateCliente);
        if ($resultadoUpdate){
            header("Location:$pathPrivadoAdmin/admin_clientes.php");
        }else{
            echo mysqli_error($conex);
        } 
    }
    if (isset($_GET['dbc'])) {

        $idCliente=$_GET["dbc"];
        $queryUpdateCliente = "update cliente set estado_cliente='ACTIVO' where id_cliente=$idCliente";
        $resultadoUpdate = mysqli_query($conex, $queryUpdateCliente);
        if ($resultadoUpdate){
            header("Location:$pathPrivadoAdmin/admin_clientes.php");
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

        <div class="contenido_admin_clientes">
            <h2 >Clientes</h2><br>
            <div class="table_mis_reservas_container">
                <table class="table table-striped table_mis_reservas" style="background-color: white">
                    <thead>
                        <tr>
                            <th class="col_3">Nombre</th>
                            <th class="col_1_1">Teléfono</th>
                            <th class="col_1_1">Dirección</th>                                
                            <th class="col_1_1">Correo</th>
                            <th class="col_1_1">Estado</th>
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
                        <td class="col_1_1"><?php echo $row['estado_cliente']; ?></td>
                        <td class="col_1_1">
                            <a href="admin_clientes.php?ver_mascotas=<?php echo $row['id_cliente']?>&acc=view" class="edit_btn" ><i class="fas fa-paw"></i></a>
                            &nbsp;&nbsp;
                            <?php 
                                if($row['estado_cliente'] == 'ACTIVO'){
                            ?>
                                <a href="admin_clientes.php?bc=<?php echo $row['id_cliente']?>" class="del_btn" onclick="return confirm('¿Esta seguro que desea bloquear a este cliente?. Luego de esto el cliente no podrá acceder a su sitio');"><span class="fas fa-ban"></span></a>
                            <?php 
                                }else{
                            ?>
                                <a href="admin_clientes.php?dbc=<?php echo $row['id_cliente']?>" class="del_btn" onclick="return confirm('¿Esta seguro que desea desbloquear a este cliente?. Luego de esto el cliente podrá acceder a su sitio y generar reservas');"><span class="fas fa-check"></span></a>
                            <?php 
                                }
                            ?>
                        </td>
                    </tr>
                    <?php 
                            }
                        } 
                    ?>
                </table>
            </div>
            <br/>
            <?php 
                if($view && isset($resultadoMascota) && $resultadoMascota->num_rows > 0){
            ?>

                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-3"><strong>Datos de las Mascotas</strong></div>
                    <div class="col-md-3"><input type="button" value="  Ocultar  " onclick="location.href='admin_clientes.php?acc=close'"  class="btn btn_planes"></div>
                </div>
                <div class="table_admin_cliente_container">
                    <table class="table table-striped table_mis_reservas" style="background-color: white">
                        <thead>
                            <tr>
                                <th class="col_1">Especie</th>
                                <th class="col_1">Nombre</th>
                                <th class="col_1">Raza</th>                                
                                <th class="col_1">Edad</th>
                                <th class="col_1">Color</th>
                                <th class="col_1">Sexo</th>
                                <th class="col_1">Esteril.</th>
                                <th class="col_1">Vacunas</th>
                                <th class="col_1">Enfermedad</th>
                            </tr>
                        </thead>
                        <?php 
                            if(isset($resultadoMascota)){
                                while ($rowm = mysqli_fetch_array($resultadoMascota)) { ?>
                        <tr>
                            
                            <td class="col_1"><?php echo $rowm['nombre_especie']; ?></td>
                            <td class="col_1"><?php echo $rowm['nombre']; ?></td>
                            <td class="col_1"><?php echo $rowm['raza']; ?></td>
                            <td class="col_1"><?php echo $rowm['edad']; ?></td>
                            <td class="col_1"><?php echo $rowm['color']; ?></td>
                            <td class="col_1"><?php echo $rowm['sexo']; ?></td>
                            <td class="col_1"><?php echo $rowm['esterilizada']; ?></td>
                            <td class="col_1"><?php echo $rowm['vacunas']; ?></td>
                            <td class="col_1"><?php echo $rowm['enfermedad']; ?></td>
                            
                        </tr>
                        <?php 
                                }
                            } 
                        ?>
                    </table>
                </div>
              
            
            <?php 
                }
            ?>

                
        </div>

        <?php
            include('../../comun/footer.php');
        ?>

    </div>
</body>

</html>