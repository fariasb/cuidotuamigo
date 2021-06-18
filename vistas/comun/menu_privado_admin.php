<?php
    $path = getcwd();
    $pathIndex = "";
    $pathPublic = "vistas/publico/";
    $pathPrivado = "vistas/privado/";
    if (endswithMP($path, 'admin')) {
        $pathIndex = "../../../";
        $pathPublic = "../../publico/";
        $pathPrivado = "";
    }
    /*if (endswithMP($path, 'publico')) {
        $pathIndex = "../../";
        $pathPublic = "";
        $pathPrivado = "../privado/";
    }*/

    function endswithMP($string, $test) {
        $strlen = strlen($string);
        $testlen = strlen($test);
        if ($testlen > $strlen) return false;
        return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
    }
?>
<nav class="menu"> 
    <ul>
        <li> <a href="<?php echo $pathPrivado;?>micuenta.php" ><span style="font-weight:bold"> Mi cuenta </span></a></li>
        <li> <a href="<?php echo $pathPrivado;?>admin_trabajadores.php"><span style="font-weight:bold">Admin Trabajadores </span></a></li>
        <li> <a href="<?php echo $pathPrivado;?>admin_clientes.php"><span style="font-weight:bold">Admin Clientes </span></a></li>
        <li> <a href="<?php echo $pathPrivado;?>solicitudes.php"><span style="font-weight:bold">Solicitudes </span></a></li>

    </ul>
    
</nav>