<?php

    
    include_once ($_SERVER['DOCUMENT_ROOT'].'/cuidotuamigo03/rutas.php');
    include (DATA_PATH."conexiondb.php");

    //echo  __PROTOCOL__.__DOMAIN__."/".__CONTEXT__;
    
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
    $pathComun = COMUN_PATH;
    $pathBase = ROOT_ESTATIC;

    /*$pathEstatico = "estatico";
    $pathData = "data";
    $pathPublico = "vistas/publico/";
    $pathPrivadoAdmin = "vistas/privado/admin";
    $pathComun = "vistas/comun";
    $pathBase = "";

    if (endswithH($path, 'cuidotuamigo03')) {
        if(isset($_SESSION)){
            session_destroy();
        }
    }

    if (endswithH($path, 'admin')) {
        $pathEstatico = "../../../estatico";
        $pathData = "../../../data";
        $pathPrivadoAdmin = "";
        $pathComun = "../../comun";
        $pathBase = "../..";
    }
    if (endswithH($path, 'cliente')) {
        $pathEstatico = "../../../estatico";
        $pathData = "../../../data";
        $pathComun = "../../comun";
        $pathBase = "../..";
    }
    if ( endswithH($path, 'trabajador')) {
        $pathEstatico = "../../../estatico";
        $pathData = "../../../data";
        $pathComun = "../../comun";
        $pathBase = "../..";
    }
    if (endswithH($path, 'publico')) {
        $pathEstatico = "../../estatico";
        $pathPublico = "";
        $pathPrivadoAdmin = "../privado/admin";
        $pathData = "../../data";
        $pathComun = "../comun";
        $pathBase = "..";
    }

    if (endswithH($path, 'comun')) {
        $pathEstatico = "../../estatico";
        $pathPublico = "../publico/";
        $pathData = "../../data";
        $pathComun = "";
        $pathBase = "../..";
    }*/

    function endswithH($string, $test) {
        $strlen = strlen($string);
        $testlen = strlen($test);
        if ($testlen > $strlen) return false;
        return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
    }

    //include("$pathData/conexiondb.php");

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

        if($resultado->num_rows > 0){
            $row = $resultado->fetch_assoc();
            $perfil = $row['nombre_tipo_usuario'];
            if(strcasecmp($perfil,"administrador")==0){
                session_start();
                $id_usuario = $row['id_usuario'];
                $_SESSION['id_usuario'] = $id_usuario;
                
                $queryDatos = "select per.nombre, per.apellido_paterno, per.apellido_materno from cuidotuamigodb.trabajador tr
                inner join cuidotuamigodb.persona per on per.id_persona = tr.id_persona 
                where tr.id_usuario  = '$id_usuario'";

                $resultadoDatos = $conex->query($queryDatos);

                if($resultadoDatos->num_rows > 0){
                    $rowDatos = $resultadoDatos->fetch_assoc();
                    $_SESSION['nombre'] = $rowDatos['nombre'];
                    $_SESSION['apellido_paterno'] = $rowDatos['apellido_paterno'];
                    $_SESSION['apellido_materno'] = $rowDatos['apellido_materno'];

                    //echo ("Location:$pathPrivadoAdmin/admin_trabajadores.php");
                    header("Location:$pathPrivadoAdmin/admin_trabajadores.php");
                }else{
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
                
                <label style="color: white;">Hola <?php echo $_SESSION['nombre'];?>!   </label>
                <a href="<?php echo $pathComun;?>/header.php?logout=true">Cerrar Sesión</a>
                
            </form>
        <?php
                }
        ?>

    
        
    </div>
    
</header>