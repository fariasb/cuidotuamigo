<?php
    include_once ($_SERVER['DOCUMENT_ROOT'].'/cuidotuamigo/rutas.php');
    include (DATA_PATH."conexiondb.php");
  
    $pathPrivadoCliente = VPRIVADO_CLIENTE_PATH;

    $disabled = "readonly";
    $edicion = true;

    $query = "SELECT id_comuna, nombre_comuna FROM comuna ORDER BY nombre_comuna";
    $result = mysqli_query($conex,$query);

    if (isset($_SESSION['id_cliente'])) {
        $idCliente = $_SESSION['id_cliente'];

        $consulta = "select p.rut, p.nombre, p.apellido_paterno, p.apellido_materno, p.direccion, p.id_comuna, p.correo, p.telefono
        from cuidotuamigodb.cliente c 
        inner join cuidotuamigodb.persona p on p.id_persona = c.id_persona 
        where c.id_cliente = $idCliente"; 

        $resultado = mysqli_query($conex, $consulta);
        $reg = mysqli_fetch_array($resultado);
    }
?>
<div>
    <div class="contenido">
        <h2> Mis Datos  </h2><br>
            
            <form action="editar_mi_cuenta.php" method="POST">
                <div class="row">
                    <div class="col-md-2"><label for="rut">Rut:</label></div>
                    <div class="col-md-3"><input type="text" id="rut" name="rut" class="form-control" value="<?= $reg['rut'] ?>"  <?php echo $disabled; ?> ></div>
                    <div class="col-md-2"><label for="nombre">Nombre:</label></div>
                    <div class="col-md-3"><input type="text" id="nombre" name="nombre" class="form-control" value="<?= $reg['nombre'] ?>"  <?php echo $disabled; ?>></div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-2"><label for="apellido_pat" >Apellido Paterno:</label></div>
                    <div class="col-md-3"><input type="text" id="apellido_pat" name="apellido_pat"  class="form-control" value="<?= $reg['apellido_paterno'] ?>"  <?php echo $disabled; ?>></div>
                    <div class="col-md-2"><label for="apellido_mat">Apellido Materno:</label></div>
                    <div class="col-md-3"><input type="text" id="apellido_mat" name="apellido_mat" class="form-control" value="<?= $reg['apellido_materno'] ?>"  <?php echo $disabled; ?>></div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-2"><label for="direccion">Dirección:</label></div>
                    <div class="col-md-3"><input type="text" id="direccion" name ="direccion" placeholder="Calle # Número" class="form-control" value="<?= $reg['direccion'] ?>"  <?php echo $disabled; ?>></div>
                    <div class="col-md-2"><label for="comuna">Comuna:</label></div>
                    <div class="col-md-3"><select name="comuna" class="form-control"  <?php echo $disabled; ?>>
                        <?php 
                        while ($row = mysqli_fetch_array($result))
                        {
                            $selected = "";
                            if($row['id_comuna'] == $reg['id_comuna']){
                                $selected = "selected='selected'";
                            }
                            echo "<option value=".$row['id_comuna']." $selected >".$row['nombre_comuna']."</option>";
                        }
                        ?>        
                    </select></div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-2"><label for="correo">Correo electrónico:</label></div>
                    <div class="col-md-3"><input type="text" id="correo" name ="correo" placeholder="correo@gmail.com" class="form-control" value="<?= $reg['correo'] ?>" readonly ></div>
                    <div class="col-md-2"><label for="telefono">Télefono de contacto:</label></div>
                    <div class="col-md-3"><input type="text" id="telefono"  name ="telefono" placeholder="9 12345678" class="form-control" value="<?= $reg['telefono'] ?>"  <?php echo $disabled; ?>></div>

                </div>
                <br/>
        
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-9"><input type="submit" name="edita_cuenta" value="Editar Datos" class="btn  btn_planes"><br><br></div>
                </div>
            </form>

        
    </div>

</div>