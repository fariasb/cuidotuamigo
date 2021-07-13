<!DOCTYPE html>
<?php
    $array = array("../../estatico/css/hazte_cliente.css");
    include('../comun/head.php');

    include("../../data/conexiondb.php");

    $query = "SELECT id_comuna, nombre_comuna FROM comuna ORDER BY nombre_comuna";
    $result = mysqli_query($conex,$query);

    $enviaSol = false;

    if (isset($_POST['env_sol'])) {

        $data = [
            'error' => false,
            'mensaje' => 'La solicitud de cliente RUT: ' . $_POST['rut'] .' ha sido enviada con éxito' 
        ];

        $enviaSol = true;
        try {
    
            $nombre = $_POST["nombre"];
            $rut = $_POST["rut"];
            $apellido_pat = $_POST["apellido_pat"];
            $apellido_mat = $_POST["apellido_mat"];
            $direccion = $_POST["direccion"];
            $comuna = $_POST["comuna"];
            $correo = $_POST["correo"];
            $telefono = $_POST["telefono"];

            $consultaValidacion = "select * from persona where rut ='$rut'";
            $resultadoValidacion = mysqli_query($conex, $consultaValidacion);
            if (isset($resultadoValidacion) && $resultadoValidacion->num_rows >0) {
                $data['error'] =  true;
                $data['mensaje'] = "Los datos del cliente RUT:" . $_POST['rut'] ." ya se encuentran registrado. Favor valide en su correo si su cuenta ya fue activada";
            
            }else{

                $consulta = "INSERT INTO persona (nombre, rut, apellido_paterno, apellido_materno, correo, direccion, telefono, id_comuna)
                VALUES ('$nombre','$rut', '$apellido_pat', '$apellido_mat','$correo','$direccion', $telefono, $comuna)"; 
            
                $resultado = mysqli_query($conex, $consulta);
                
                if ($resultado){
                    $consulta = "select id_persona from persona where rut ='$rut'";
                    $resultado = mysqli_query($conex, $consulta);
                    if (isset($resultado)) {
                        while ($row = mysqli_fetch_array($resultado)) {
                        
                            $id_persona = $row['id_persona'];
            
                            $consulta = "INSERT INTO cliente (id_persona, estado_cliente) 
                            VALUES ('$id_persona','PENDIENTE')";
            
                            $resultadoInsert = mysqli_query($conex, $consulta);
                            if ($resultadoInsert){
                            
                            }else{
                                $data['error'] = true;
                                $data['mensaje'] = "Ha ocurrido un error el enviar la solicitud. Favor reintente más tarde.";
                            }
                        }
                    }else{
                        $data['error'] = true;
                        $data['mensaje'] = "Ha ocurrido un error el enviar la solicitud. Favor reintente más tarde.";
                    }
                }else{
                    $data['error'] = true;
                    $data['mensaje'] = "Ha ocurrido un error el enviar la solicitud. Favor reintente más tarde.";
                }
            }

    
        } catch(PDOException $error) {
            $data['error'] = true;
            $data['mensaje'] = $error->getMessage();
        }
    }
?>
<body>

    <div id="contenedor"> <!-- Contenedor-->
        <?php
            include('../comun/header.php');
        ?>
        <?php
            include('../comun/menu_publico.php');
        ?>

        <article class="box2">
            <div class="contenido">
                <h2> Hazte cliente y accede a nuestros servicios  </h2><br>
               
                    <?php
                        if (isset($enviaSol) && isset($data)) {
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
                        <div class="row">
                            <div class="col-md-2"><label for="rut">Rut:</label></div>
                            <div class="col-md-3"><input type="text" id="rut" name="rut" class="form-control"></div>
                            <div class="col-md-2"><label for="nombre">Nombre:</label></div>
                            <div class="col-md-3"><input type="text" id="nombre" name="nombre" class="form-control"></div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-2"><label for="apellido_pat" >Apellido Paterno:</label></div>
                            <div class="col-md-3"><input type="text" id="apellido_pat" name="apellido_pat"  class="form-control"></div>
                            <div class="col-md-2"><label for="apellido_mat">Apellido Materno:</label></div>
                            <div class="col-md-3"><input type="text" id="apellido_mat" name="apellido_mat" class="form-control"></div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-2"><label for="direccion">Dirección:</label></div>
                            <div class="col-md-3"><input type="text" id="direccion" name ="direccion" placeholder="Calle # Número" class="form-control"></div>
                            <div class="col-md-2"><label for="comuna">Comuna:</label></div>
                            <div class="col-md-3"><select name="comuna" class="form-control">
                                <?php 
                                while ($row = mysqli_fetch_array($result))
                                {
                                    echo "<option value=".$row['id_comuna'].">".$row['nombre_comuna']."</option>";
                                }
                                ?>        
                            </select></div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-2"><label for="correo">Correo electrónico:</label></div>
                            <div class="col-md-3"><input type="text" id="correo" name ="correo" placeholder="correo@gmail.com" class="form-control"></div>
                            <div class="col-md-2"><label for="telefono">Télefono de contacto:</label></div>
                            <div class="col-md-3"><input type="text" id="telefono"  name ="telefono" placeholder="9 12345678" class="form-control"></div>
   
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-11"><h6><i>*Las solicitudes serán revisadas por nuestra administradora. Se enviará un correo una vez sea aprobada.</i> </h6></div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-9"><input type="submit" name="env_sol" value="Enviar Solicitud" class="btn  btn_planes"><br><br></div>
                        </div>
                    </form>
    
                
            </div>
    
        </article>

        <?php
            include('../comun/footer.php');
        ?>

    </div>


</body>

</html>