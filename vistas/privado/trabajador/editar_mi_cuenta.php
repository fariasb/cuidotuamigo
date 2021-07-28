<!DOCTYPE html>
<?php

    include_once ($_SERVER['DOCUMENT_ROOT'].'/cuidotuamigo/rutas.php');
    include (DATA_PATH."conexiondb.php");
  
    $array = array("../../../estatico/css/hazte_cliente.css");
    include('../../comun/head.php');

    $pathPrivadoTrabajador = VPRIVADO_TRAB_PATH;

    $disabled = "";
    $edicion = false;

    $query = "SELECT id_comuna, nombre_comuna FROM comuna ORDER BY nombre_comuna";
    $result = mysqli_query($conex,$query);

    if (isset($_SESSION['id_trabajador'])) {
        $idTrabajador = $_SESSION['id_trabajador'];

        $consulta = "select p.rut, p.nombre, p.apellido_paterno, p.apellido_materno, p.direccion, p.id_comuna, p.correo, p.telefono, 
        tt.id_tipo_trabajador, tt.nombre_tipo_trab, p.id_persona 
        from cuidotuamigodb.trabajador t 
        inner join cuidotuamigodb.persona p on p.id_persona = t.id_persona 
        inner join cuidotuamigodb.tipo_trabajador tt on tt.id_tipo_trabajador = t.id_tipo_trabajador 
        where t.id_trabajador =$idTrabajador"; 

        $resultado = mysqli_query($conex, $consulta);
        $reg = mysqli_fetch_array($resultado);
    }

    if (isset($_POST['cancela'])) {
        header("Location:$pathPrivadoTrabajador/mi_cuenta.php");
    }
    $alerta= false;

    if (isset($_POST['guarda'])) {

        $data = [
            'error' => false,
            'mensaje' => 'Los datos han sido actualizados con éxito' 
        ];
        $alerta= true;

        $nombre = $_POST["nombre"];
        $rut = $_POST["rut"];
        $apellido_pat = $_POST["apellido_pat"];
        $apellido_mat = $_POST["apellido_mat"];
        $direccion = $_POST["direccion"];
        $comuna = $_POST["comuna"];
        $telefono = $_POST["telefono"];
        $idPersona = $_POST["id_persona"];

        $correo = $_POST["correo"];

        $passActual = $_POST["pass_actual"];
        $passNueva = $_POST["pass_nueva"];

        $errores= false;

        if($passActual != ""){
            if($passNueva != ""){

                $queryUsuario = "select us.id_usuario from cuidotuamigodb.usuario us 
                where us.correo ='$correo' and us.contrasenia ='$passActual'";

                $resultadoUsuario = $conex->query($queryUsuario);

                if($resultadoUsuario->num_rows == 1){
                    $regUsuario = mysqli_fetch_array($resultadoUsuario);
                    $idUsuario = $regUsuario["id_usuario"];
                    $queryUpdUsuario = "update cuidotuamigodb.usuario set contrasenia='$passNueva' where id_usuario=$idUsuario";
                    $resultadoUpdateUsuario = mysqli_query($conex, $queryUpdUsuario);
                    if($resultadoUpdateUsuario){

                    }else{
                        $data['error'] =  true;
                        $data['mensaje'] = "No se logro actualizar la contraseña. Por favor intente más tarde";
                        $errores= true;
                    }
                }else{
                    $data['error'] =  true;
                    $data['mensaje'] = "La contraseña actual es incorrecta";
                    $errores= true;
                }
            }else{
                $data['error'] =  true;
                $data['mensaje'] = "Para cambiar la contraseña, debe ingresar la actual y la nueva";
                $errores= true;
            }
        }
        if($errores == false){
            $queryUpdPersona = "UPDATE cuidotuamigodb.persona
            SET rut='$rut', nombre='$nombre', apellido_paterno='$apellido_pat', apellido_materno='$apellido_mat',
            direccion='$direccion', telefono='$telefono', id_comuna=$comuna
            WHERE id_persona=$idPersona;
            ";
            $resultadoUpdatePersona = mysqli_query($conex, $queryUpdPersona);
            if($resultadoUpdatePersona){
                $idTrabajador = $_SESSION['id_trabajador'];

                $consulta = "select p.rut, p.nombre, p.apellido_paterno, p.apellido_materno, p.direccion, p.id_comuna, p.correo, p.telefono, 
                tt.id_tipo_trabajador, tt.nombre_tipo_trab, p.id_persona 
                from cuidotuamigodb.trabajador t 
                inner join cuidotuamigodb.persona p on p.id_persona = t.id_persona 
                inner join cuidotuamigodb.tipo_trabajador tt on tt.id_tipo_trabajador = t.id_tipo_trabajador 
                where t.id_trabajador =$idTrabajador"; 

                $resultado = mysqli_query($conex, $consulta);
                $reg = mysqli_fetch_array($resultado);
            }else{
                $data['error'] =  true;
                $data['mensaje'] = "No se lograron actualizar los datos. Por favor intente más tarde";
                $errores= true;
            }

            
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

        <article class="box3">
            <div class="contenido2">
                <h2> Mis Datos  </h2><br>
               
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
                    
                    <form action="" method="POST">
                    <input type="hidden" id="id_persona" name="id_persona" value="<?= $reg['id_persona'] ?>">
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
                        <?php 
                            if(!$edicion){
                        ?>
                            <div class="row">
                                <div class="col-md-8"><label for="correo"><strong>Llene los siguientes datos solo si desea cambiar la contraseña</strong></label></div>
    
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-2"><label for="pass_actual">Contraseña Actual:</label></div>
                                <div class="col-md-3"><input type="password" id="pass_actual" name ="pass_actual" class="form-control" ></div>
                                <div class="col-md-2"><label for="pass_nueva">Contraseña Nueva:</label></div>
                                <div class="col-md-3"><input type="password" id="pass_nueva"  name ="pass_nueva" class="form-control" ></div>
    
                            </div>
                            <br/>
                        <?php 
                            }
                        ?>
               
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-6"><input type="submit" name="cancela" value="Volver" class="btn  btn_planes"><br><br></div>
                            <div class="col-md-1"><input type="submit" name="guarda" value="Guardar" class="btn  btn_planes"><br><br></div>
                          
                          
                        </div>
                    </form>
    
                
            </div>
    
        </article>

        <?php
            include('../../comun/footer.php');
        ?>

    </div>
</body>

</html>