<?php
    
    include_once ($_SERVER['DOCUMENT_ROOT'].'/cuidotuamigo/rutas.php');
    include (DATA_PATH."conexiondb.php");

    $pathPrivadoCliente = VPRIVADO_CLIENTE_PATH;

    if (isset($_SESSION['id_cliente'])) {
        $idCliente = $_SESSION['id_cliente'];

        $consulta = "select m.id_mascota, m.nombre, m.chip_mascota, e.nombre_especie from cuidotuamigodb.mascota m 
        inner join cuidotuamigodb.especie e on e.id_especie = m.id_especie where m.id_cliente = '$idCliente'"; 

        $resultado = mysqli_query($conex,$consulta);
    }

    if (isset($_GET['del_id_mascotas'])) {
        
        $idMascota=$_GET["del_id_mascotas"];
        
        $queryDelMascota = "DELETE FROM mascota where id_mascota = '$idMascota'";
        $resultadoDelMascota = mysqli_query($conex, $queryDelMascota);

        if ($resultadoDelMascota){
            header("Location:$pathPrivadoCliente/mi_cuenta.php");
        }else{
            echo mysqli_error($conex);
        }    
    }
?>
<div>
    
        <div class="contenido">
            <h2 >Mascotas</h2><br>
            <div class="table_mis_reservas_container">
                <table class="table table-striped table_mis_reservas" style="background-color: white">
                    <thead>
                        <tr>
                            <th class="col_3">Nombre</th>
                            <th class="col_1">Chip Mascota</th>
                            <th class="col_1">Especie</th>                                
                            <th colspan="2" class="col_1">Acciones</th>
                        </tr>
                    </thead>
                    <?php 
                        if(isset($resultado)){
                            while ($row = mysqli_fetch_array($resultado)) { ?>
                    <tr>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['chip_mascota']; ?></td>
                        <td><?php echo $row['nombre_especie']; ?></td>
                        <td>
                            <a href="editar_mascota.php?edit_id_mascotas=<?php echo $row['id_mascota']?>" class="edit_btn" ><span class="fa fa-pencil"></span></a>
                        </td>
                        <td>
                            <a href="mis_mascotas.php?del_id_mascotas=<?php echo $row['id_mascota']?>" class="del_btn" onclick="return confirm('Esta seguro que desea eliminar el registro de la mascota?');"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>
                    <?php 
                            }
                        } 
                    ?>
                </table>
            </div>
            <br/>
            <div>
                <form action="agregar_mascota.php" method="POST">
                    <input type="hidden" id="id_cliente" name="id_cliente" value="<?= $idCliente;?>">
                    <input type="submit" value="Agregar Mascota" name ="agregar"  class="btn btn-success btn_planes">
                </form>
            </div>

                
        </div>

   
</div>