<!DOCTYPE html>
<?php
    $arrayCss = array("../../../estatico/css/admin.css");
    include('../../comun/head.php');

    include("../../../data/conexiondb.php");

    $consulta = "select p.id_persona, t.id_trabajador, p.rut, p.nombre, p.apellido_paterno, p.apellido_materno, p.correo, t.cargo 
    from trabajador t inner join persona p on p.id_persona = t.id_persona"; 

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

        <article class="box2">
            <div class="contenido">
                <h2 >Administrar trabajadores</h2><br>

                <!--div class="formulario_contacto">
                    <form action="data/trabajador.php" method="POST">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" class="campo"  placeholder="Ingrese Nombre">
                        <input type="submit" value="Buscar" name ="filtrar" class="btn btn-success btn_planes">
                    </form>
                </div>
                <br-->
                <div>
                    <table class="tabla_resultado">
                        <thead>
                            <tr>
                                <th class="col_1">Rut</th>
                                <th class="col_2">Nombre</th>
                                <th class="col_3">Apellidos</th>                                
                                <th class="col_4">Correo</th>
                                <th class="col_5">Cargo</th>
                                <th colspan="2" class="col_6">Acciones</th>
                            </tr>
                        </thead>
                        <?php while ($row = mysqli_fetch_array($resultado)) { ?>
                        <tr>
                            <td><?php echo $row['rut']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['apellido_paterno']; ?>&nbsp;<?php echo $row['apellido_materno']; ?></td>
                            <td><?php echo $row['correo']; ?></td>
                            <td><?php echo $row['cargo']; ?></td>
                            <td>
                                <a href="editar_trabajador.php?edit_id_persona=<?php echo $row['id_persona']?>&edit_id_trabajador=<?php echo $row['id_trabajador']?>" class="edit_btn" ><span class="fa fa-pencil"></span></a>
                            </td>
                            <td>
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
    
        </article>

        <?php
            include('../../comun/footer.php');
        ?>

    </div>


</body>

</html>