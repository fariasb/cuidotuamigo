<!DOCTYPE html>
<?php

    include_once ($_SERVER['DOCUMENT_ROOT'].'/cuidotuamigo/rutas.php');
    include (DATA_PATH."conexiondb.php");
  
    $array = array("../../../estatico/css/mi_cuenta.css", "../../../estatico/css/admin.css", "../../../estatico/css/reserva.css", "../../../estatico/css/hazte_cliente.css");
    include('../../comun/head.php');

    $pathPrivadoCliente = VPRIVADO_CLIENTE_PATH;

    $disabled = "";
    $edicion = false;

    $query = "SELECT id_comuna, nombre_comuna FROM comuna ORDER BY nombre_comuna";
    $result = mysqli_query($conex,$query);

    if (isset($_SESSION['id_cliente'])) {
        $idCliente = $_SESSION['id_cliente'];

        $consulta = "select p.id_persona, p.rut, p.nombre, p.apellido_paterno, p.apellido_materno, p.direccion, p.id_comuna, p.correo, p.telefono
        from cuidotuamigodb.cliente c 
        inner join cuidotuamigodb.persona p on p.id_persona = c.id_persona 
        where c.id_cliente = $idCliente"; 

        $resultado = mysqli_query($conex, $consulta);
        $reg = mysqli_fetch_array($resultado);
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
                    echo $queryUpdUsuario;
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
                $idCliente = $_SESSION['id_cliente'];

                $consulta = "select p.id_persona, p.rut, p.nombre, p.apellido_paterno, p.apellido_materno, p.direccion, p.id_comuna, p.correo, p.telefono
                from cuidotuamigodb.cliente c 
                inner join cuidotuamigodb.persona p on p.id_persona = c.id_persona 
                where c.id_cliente = $idCliente"; 
        
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
            include('../../comun/menu_privado_cliente.php');
        ?>
        <br/>
        <div class="row">
            <div class="col-3">
                <div class="nav flex-column nav-pills red" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#mis-datos" role="tab" aria-controls="v-pills-home" aria-selected="true">Mis datos</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#mis-mascotas" role="tab" aria-controls="v-pills-profile" aria-selected="false">Mis Mascotas</a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#mis-reservas" role="tab" aria-controls="v-pills-messages" aria-selected="false">Mis Reservas</a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content" id="v-pills-tabContents">
                
                <div class="tab-pane fade show active" id="mis-datos" role="tabpanel" aria-labelledby=""v-pills-home-tab">
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
                                    <div class="col-md-3"><input type="text" id="rut" name="rut" class="form-control" required value="<?= $reg['rut'] ?>"  <?php echo $disabled; ?> ></div>
                                    <div class="col-md-2"><label for="nombre">Nombre:</label></div>
                                    <div class="col-md-3"><input type="text" id="nombre" name="nombre" class="form-control" required value="<?= $reg['nombre'] ?>"  <?php echo $disabled; ?>></div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-2"><label for="apellido_pat" >Apellido Paterno:</label></div>
                                    <div class="col-md-3"><input type="text" id="apellido_pat" name="apellido_pat"  class="form-control" required value="<?= $reg['apellido_paterno'] ?>"  <?php echo $disabled; ?>></div>
                                    <div class="col-md-2"><label for="apellido_mat">Apellido Materno:</label></div>
                                    <div class="col-md-3"><input type="text" id="apellido_mat" name="apellido_mat" class="form-control" required value="<?= $reg['apellido_materno'] ?>"  <?php echo $disabled; ?>></div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-2"><label for="direccion">Dirección:</label></div>
                                    <div class="col-md-3"><input type="text" id="direccion" name ="direccion" placeholder="Calle # Número" class="form-control" required value="<?= $reg['direccion'] ?>"  <?php echo $disabled; ?>></div>
                                    <div class="col-md-2"><label for="comuna">Comuna:</label></div>
                                    <div class="col-md-3"><select name="comuna" class="form-control" required  <?php echo $disabled; ?>>
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
                                    <div class="col-md-3"><input type="text" id="correo" name ="correo" placeholder="correo@gmail.com" class="form-control" required value="<?= $reg['correo'] ?>" readonly ></div>
                                    <div class="col-md-2"><label for="telefono">Télefono de contacto:</label></div>
                                    <div class="col-md-3"><input type="text" id="telefono"  name ="telefono" placeholder="9 12345678" class="form-control" required value="<?= $reg['telefono'] ?>"  <?php echo $disabled; ?>></div>
        
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
                                    <div class="col-md-4"></div>
                                    <div class="col-md-3"><input type="submit" name="guarda" value="Guardar" class="btn  btn_planes"><br><br></div>
                                </div>
                            </form>
                            <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-3">
                                        <form action="mi_cuenta.php" method="post">
                                            <input type="hidden" id="active" name="active" value="1">
                                            <input type="submit" name="cancela" value="Volver a Mis Datos" class="btn btn_planes">
                                        </form>
                                        
                                    </div>
                                   
                                </div>
                        
                    </div>
                </div>
                <div class="tab-pane fade" id="mis-mascotas" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <?php
                        include('./mis_mascotas.php');
                    ?>
                </div>
                <div class="tab-pane fade" id="mis-reservas" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <?php
                        include('./mis_reservas.php');
                    ?>
                </div>
                </div>
            </div>
        </div>

        <?php
            include('../../comun/footer.php');
        ?>

    </div>

   
</body>

</html>