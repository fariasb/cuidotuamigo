<!DOCTYPE html>
<?php
    $array = array("../../../estatico/css/mi_cuenta.css", "../../../estatico/css/admin.css", "../../../estatico/css/reserva.css","../../../estatico/font/css/all.css");
    include('../../comun/head.php');

    include("../../../data/conexiondb.php");

    $idTrabajador = $_SESSION['id_trabajador'];

    $consulta = "select p.id_persona, t.id_trabajador, p.rut, p.nombre, p.apellido_paterno, p.apellido_materno, p.correo, tt.nombre_tipo_trab as cargo
    from cuidotuamigodb.trabajador t 
    inner join cuidotuamigodb.persona p on p.id_persona = t.id_persona
    inner join cuidotuamigodb.tipo_trabajador tt on tt.id_tipo_trabajador = t.id_tipo_trabajador
    where t.id_trabajador != $idTrabajador"; 

    $resultado = mysqli_query($conex,$consulta);

    if (isset($_GET['del_id_persona'])) {
        $idPersona=$_GET["del_id_persona"];
        $idTrabajador=$_GET["del_id_trabajador"];

        $queryDelTrabajador = "DELETE FROM trabajador where id_trabajador = ' $idTrabajador'";
        $resultadoDelTrabajador = mysqli_query($conex, $queryDelTrabajador);

        if ($resultadoDelTrabajador){

            $queryDelPersona = "DELETE FROM persona where id_persona = ' $idPersona'";
            $resultadoPersona = mysqli_query($conex, $queryDelPersona);

            if($resultadoPersona){
                header("Location:admin_trabajadores.php");
            }else{
                echo mysqli_error($conex);
            }
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
                <h2 >Trabajadores</h2><br>
                <div class="table_mis_reservas_container">
                    <table class="table table-striped table_mis_reservas" style="background-color: white; width:90%; margin-left:5%">
                        <thead>
                            <tr>
                                <th class="col_3">Rut</th>
                                <th class="col_1_1">Nombre</th>
                                <th class="col_1_1">Apellidos</th>                                
                                <th class="col_1_1">Correo</th>
                                <th class="col_1_1">Cargo</th>
                                <th class="col_1_1">Acciones</th>
                            </tr>
                        </thead>
                        <?php while ($row = mysqli_fetch_array($resultado)) { 
                        ?>
                        <tr>
                            <td class="col_3" style="word-wrap:break-word;"><?php echo $row['rut']; ?></td>
                            <td class="col_1_1" style="word-wrap:break-word;"><?php echo $row['nombre']; ?></td>
                            <td class="col_1_1" style="word-wrap:break-word;"><?php echo $row['apellido_paterno']; ?>&nbsp;<?php echo $row['apellido_materno']; ?></td>
                            <td class="col_1_1" style="word-wrap:break-word;"><?php echo $row['correo']; ?></td>
                            <td class="col_1_1" style="word-wrap:break-word;"><?php echo $row['cargo']; ?></td>
                            <td class="col_1_1" style="word-wrap:break-word;">
                                <a href="editar_trabajador.php?edit_id_persona=<?php echo $row['id_persona']?>&edit_id_trabajador=<?php echo $row['id_trabajador']?>" class="edit_btn" ><span class="fas fa-pencil-alt"></span></a>
                                &nbsp;&nbsp;
                                <a href="admin_trabajadores.php?del_id_persona=<?php echo $row['id_persona']?>&del_id_trabajador=<?php echo $row['id_trabajador']?>" class="del_btn" onclick="return confirm('Esta seguro que desea eliminar el registro?');"><span class="fa fa-trash"></span></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                <br/>
                <div>
                     <form action="agregar_trabajador.php" method="POST">
                        <input type="submit" value="Agregar Nuevo" name ="agregar"  class="btn btn-success btn_planes">
                    </form>
                </div>

                 
            </div>
    
       

        <?php
            include('../../comun/footer.php');
        ?>

    </div>


</body>

</html>