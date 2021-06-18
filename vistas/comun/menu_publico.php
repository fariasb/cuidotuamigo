<?php
    $path = getcwd();
    $pathIndex = "";
    $pathPublic = "vistas/publico/";
    $pathPrivado = "vistas/privado/";
    if (endswithM($path, 'cliente') || endswithM($path, 'admin') || endswithM($path, 'trabajador')) {
        $pathIndex = "../../../";
        $pathPublic = "../../publico/";
        $pathPrivado = "";
    }
    if (endswithM($path, 'publico')) {
        $pathIndex = "../../";
        $pathPublic = "";
    }

    function endswithM($string, $test) {
        $strlen = strlen($string);
        $testlen = strlen($test);
        if ($testlen > $strlen) return false;
        return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
    }
?>
<nav class="menu"> 
    <ul>
        <li> <a href="<?php echo $pathIndex;?>index.php" ><span style="font-weight:bold"> Home </span></a></li>
        <li> <a href="<?php echo $pathPublic;?>nosotros.php"><span style="font-weight:bold">Quiénes somos </span></a></li>
        <li> <a href="<?php echo $pathPublic;?>hazte_cliente.php"><span style="font-weight:bold">Hazte Cliente </span></a></li>
        <li> <a href="<?php echo $pathPublic;?>servicios.php"><span style="font-weight:bold">Servicios </span></a></li>
        <li> <a href="<?php echo $pathPublic;?>contacto.php"><span style="font-weight:bold">Contacto </span></a></li>

    </ul>
    
</nav>