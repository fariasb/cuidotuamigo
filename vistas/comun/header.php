<?php

    
    include_once ($_SERVER['DOCUMENT_ROOT'].'/cuidotuamigo03/rutas.php');
    include (DATA_PATH."conexiondb.php");

    function debug_to_consoleH($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects --: " . $output . "' );</script>";
    }
    

    //echo  __PROTOCOL__.__DOMAIN__."/".__CONTEXT__;
    debug_to_consoleH(isset($_SESSION['id_usuario']));
    $requiereInicio = true;
    if(isset($_SESSION['id_usuario'])){
        $requiereInicio = false;
    }else{
        $requiereInicio = true;
    }
    
    $path = getcwd();

    $pathEstatico = ESTATICO_PATH;
    $pathPublico = VPUBLICO_PATH;
    $pathPrivadoAdmin = VPRIVADO_ADMIN_PATH;
    $pathPrivadoCliente = VPRIVADO_CLIENTE_PATH;
    $pathComun = COMUN_PATH;
    $pathBase = ROOT_ESTATIC;


    $errorLogin = false;
    $styleLogin = "";

    if (isset($_POST['submit'])) {

        $errorLogin = false;
        $styleLogin = "";

        $correo = $_POST["correo"];
        $pass = $_POST["pass"];

        $queryUsuario = "select us.id_usuario, pu.nombre_tipo_usuario from cuidotuamigodb.usuario us 
        inner join cuidotuamigodb.perfil_usuario pu on pu.id_perfil_usuario = us.id_perfil_usuario 
        where us.correo ='$correo' and us.contrasenia ='$pass'";

        //$resultado = mysqli_query($conex, $queryUsuario);

        $resultado = $conex->query($queryUsuario);

        echo "1: $resultado->num_rows";

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
                $queryDatos = "select per.nombre, per.apellido_paterno, per.apellido_materno from cuidotuamigodb.trabajador tr
                inner join cuidotuamigodb.persona per on per.id_persona = tr.id_persona 
                where tr.id_usuario  = '$id_usuario'";

                $resultadoDatos = $conex->query($queryDatos);
                echo "2: $resultadoDatos->num_rows";
                if($resultadoDatos->num_rows > 0){
                    $rowDatos = $resultadoDatos->fetch_assoc();
                    $errorLogin = false;
                    $_SESSION['id_usuario'] = $id_usuario;
                    $_SESSION['nombre'] = $rowDatos['nombre'];
                    $_SESSION['apellido_paterno'] = $rowDatos['apellido_paterno'];
                    $_SESSION['apellido_materno'] = $rowDatos['apellido_materno'];    
                    header("Location:$pathPrivadoAdmin/admin_trabajadores.php");        
                }else{
                    session_destroy();
                    $errorLogin = true;
                    $styleLogin = "border: 2px solid red;";
                }
               
            }
            if(strcasecmp($perfil,"cliente")==0){
                $queryDatos = "select per.nombre, per.apellido_paterno, per.apellido_materno, cl.id_cliente from cuidotuamigodb.cliente cl
                inner join cuidotuamigodb.persona per on per.id_persona = cl.id_persona 
                where cl.id_usuario  = '$id_usuario'";

                $resultadoDatos = $conex->query($queryDatos);
                echo "2: $resultadoDatos->num_rows";
                if($resultadoDatos->num_rows > 0){
                    $rowDatos = $resultadoDatos->fetch_assoc();
                    $errorLogin = false;
                    $_SESSION['id_usuario'] = $id_usuario;
                    $_SESSION['id_cliente'] =  $rowDatos['id_cliente'];
                    $_SESSION['nombre'] = $rowDatos['nombre'];
                    $_SESSION['apellido_paterno'] = $rowDatos['apellido_paterno'];
                    $_SESSION['apellido_materno'] = $rowDatos['apellido_materno'];    
                    header("Location:$pathPrivadoCliente/home.php");
                }else{
                    session_destroy();
                    $errorLogin = true;
                    $styleLogin = "border: 2px solid red;";
                }
            }

        }else{
           $errorLogin = true;
           $styleLogin = "border: 2px solid red;";
        }
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        header("Location:$pathBase/index.php");
    }
?>
<header class="header">
    <div class="logotipo">
        <div style = "float: left">
            <img src="<?php echo $pathEstatico;?>/images/logo.webp" alt="logotipo" width="120" height="90">
        </div>
        <div class="titulo_header">
            <h1 class="letras">CUIDO   TU   AMIGO</h1>
        </div>
    </div>
    <div class="login">
        <?php
            if ($requiereInicio) {
        ?>
            <form method="POST">
                
                <input type="text" style="<?php echo $styleLogin;?>" name="correo" class="campolog" required placeholder="Correo">
                
                <input type="password" style="<?php echo $styleLogin;?>" name="pass" class="campolog" required placeholder="Contraseña">
                <input type="submit"name="submit" value=">" class="btn btn-success"><br>
                <?php
                    if ($errorLogin) {
                ?>
                <label style="color: #ff9244;">Datos incorrectos</label><br/>
                <?php
                    }
                ?>
                <a href="<?php echo $pathPublico;?>hazte_cliente.php">Hazte Cliente!</a>
                
            </form>
        <?php
                }else{
        ?>
             <form method="POST">
                
                <label style="color: white;">Hola <?php echo $_SESSION['nombre']." ".$_SESSION['apellido_paterno']." ".$_SESSION['apellido_materno'];?>!   </label>
                <a href="<?php echo $pathComun;?>/header.php?logout=true">Cerrar Sesión</a>
                
            </form>
        <?php
                }
        ?>

    
        
    </div>
    
</header>