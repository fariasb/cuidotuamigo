<!DOCTYPE html>
<?php
    $array = array("../../estatico/css/hazte_cliente.css");
    include('../comun/head.php');

    include_once ($_SERVER['DOCUMENT_ROOT'].'/cuidotuamigo/rutas.php');
    include (DATA_PATH."conexiondb.php");

    $pathPrivadoAdmin = VPRIVADO_ADMIN_PATH;
    $pathPrivadoCliente = VPRIVADO_CLIENTE_PATH;
    $pathPrivadoTrabajador = VPRIVADO_TRAB_PATH;

    $errorLoginVS = false;
    $styleLoginVS = "";

    if (isset($_POST['login_vs'])) {

        $errorLoginVS = false;
        $styleLoginVS = "";

        $correo = $_POST["correo"];
        $pass = $_POST["pass"];

        $queryUsuario = "select us.id_usuario, pu.nombre_tipo_usuario from cuidotuamigodb.usuario us 
        inner join cuidotuamigodb.perfil_usuario pu on pu.id_perfil_usuario = us.id_perfil_usuario 
        where us.correo ='$correo' and us.contrasenia ='$pass'";

        //$resultado = mysqli_query($conex, $queryUsuario);

        $resultado = $conex->query($queryUsuario);

       // echo "1: $resultado->num_rows";

        if($resultado->num_rows > 0){
            //Si hay una sesion activa, se destruye
            //if(isset($_SESSION['id_usuario'])){
              //  session_destroy();
            //}
            
            $row = $resultado->fetch_assoc();

            //Se buscan los datos de persona
            $id_usuario = $row['id_usuario'];
            $perfil = $row['nombre_tipo_usuario'];

            if(strcasecmp($perfil,"administrador")==0){
                $queryDatos = "select tr.id_trabajador,per.nombre, per.apellido_paterno, per.apellido_materno from cuidotuamigodb.trabajador tr
                inner join cuidotuamigodb.persona per on per.id_persona = tr.id_persona 
                where tr.id_usuario  = '$id_usuario'";

                $resultadoDatos = $conex->query($queryDatos);
                //echo "2: $resultadoDatos->num_rows";
                if($resultadoDatos->num_rows > 0){
                    $rowDatos = $resultadoDatos->fetch_assoc();
                    $errorLoginVS = false;
                    $styleLoginVS = "";
                    $_SESSION['id_usuario'] = $id_usuario;
                    $_SESSION['nombre'] = $rowDatos['nombre'];
                    $_SESSION['apellido_paterno'] = $rowDatos['apellido_paterno'];
                    $_SESSION['apellido_materno'] = $rowDatos['apellido_materno'];    
                    header("Location:$pathPrivadoAdmin/admin_trabajadores.php");        
                }else{
                    session_destroy();
                    $errorLoginVS = true;
                    $styleLoginVS = "border: 2px solid red;";
                }
               
            }
            if(strcasecmp($perfil,"cliente")==0){
                $queryDatos = "select per.nombre, per.apellido_paterno, per.apellido_materno, cl.id_cliente from cuidotuamigodb.cliente cl
                inner join cuidotuamigodb.persona per on per.id_persona = cl.id_persona 
                where cl.id_usuario  = '$id_usuario' and cl.estado_cliente='ACTIVO'";

                $resultadoDatos = $conex->query($queryDatos);
                //echo "2: $resultadoDatos->num_rows";
                if($resultadoDatos->num_rows > 0){
                    $rowDatos = $resultadoDatos->fetch_assoc();
                    $errorLoginVS = false;
                    $styleLoginVS = "";
                    $_SESSION['id_usuario'] = $id_usuario;
                    $_SESSION['id_cliente'] =  $rowDatos['id_cliente'];
                    $_SESSION['nombre'] = $rowDatos['nombre'];
                    $_SESSION['apellido_paterno'] = $rowDatos['apellido_paterno'];
                    $_SESSION['apellido_materno'] = $rowDatos['apellido_materno'];    
                    header("Location:$pathPrivadoCliente/servicios.php");
                }else{
                    session_destroy();
                    $errorLoginVS = true;
                    $styleLoginVS = "border: 2px solid red;";
                }
            }

            if(strcasecmp($perfil,"paseador")==0){
                $queryDatos = "select tr.id_trabajador,per.nombre, per.apellido_paterno, per.apellido_materno from cuidotuamigodb.trabajador tr
                inner join cuidotuamigodb.persona per on per.id_persona = tr.id_persona 
                where tr.id_usuario  = '$id_usuario'";

                $resultadoDatos = $conex->query($queryDatos);
                //echo "2: $resultadoDatos->num_rows";
                if($resultadoDatos->num_rows > 0){
                    $rowDatos = $resultadoDatos->fetch_assoc();
                    $errorLoginVS = false;
                    $styleLoginVS = "";
                    $_SESSION['id_usuario'] = $id_usuario;
                    $_SESSION['nombre'] = $rowDatos['nombre'];
                    $_SESSION['apellido_paterno'] = $rowDatos['apellido_paterno'];
                    $_SESSION['apellido_materno'] = $rowDatos['apellido_materno'];    
                    header("Location:$pathPrivadoTrabajador/mi_cuenta.php");        
                }else{
                    session_destroy();
                    $errorLoginVS = true;
                    $styleLoginVS = "border: 2px solid red;";
                }
            }

        }else{
      
           $errorLoginVS = true;
           $styleLoginVS = "border: 2px solid red;";
  
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
            <div class="contenido" style="height: 412px;">
                <h2> Iniciar sesión  </h2><br>
               
                <div class="formulario_contacto">
                    
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10"><label for="correo" style="width: 150px">Correo electrónico:</label></div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10"><input type="text" id="correo" style="<?php echo $styleLoginVS;?>" name="correo" placeholder="correo@gmail.com" class="form-control"></div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10"><label for="pass">Contraseña:</label></div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10"><input type="password" id="pass" style="<?php echo $styleLoginVS;?>" name="pass" class="form-control"></div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-3"><input type="submit" value="Ingresar" name="login_vs" class="btn  btn_planes"><br><br></div>
                            <div class="col-md-8">
                                <?php
                                    if ($errorLoginVS) {
                                ?>
                                <label style="color: red; width: 200px">Datos incorrectos</label><br/>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10"><h6>¿No eres cliente aún? <a href="hazte_cliente.php">Hazte Cliente!</a></h6></div>
                        </div>
                    </form>
    
                </div>
            </div>
    
        </article>

        <?php
            include('../comun/footer.php');
        ?>

    </div>


</body>

</html>