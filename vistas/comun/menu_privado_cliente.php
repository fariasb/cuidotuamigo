<?php
    
    include_once ($_SERVER['DOCUMENT_ROOT'].'/cuidotuamigo03/rutas.php');

    $pathPrivadoCliente = VPRIVADO_CLIENTE_PATH;

?>
<nav class="menu"> 
    <ul>
        <li> <a href="<?php echo $pathPrivadoCliente;?>/home.php" ><span style="font-weight:bold"> Inicio </span></a></li>
        <li> <a href="<?php echo $pathPrivadoCliente;?>/nosotros.php"><span style="font-weight:bold">Quienes Somos </span></a></li>
        <li> <a href="<?php echo $pathPrivadoCliente;?>/nosotros.php"><span style="font-weight:bold">Servicios </span></a></li>
        <li> <a href="<?php echo $pathPrivadoCliente;?>/mi_cuenta.php"><span style="font-weight:bold">Mi Cuenta </span></a></li>

    </ul>
    
</nav>