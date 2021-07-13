<?php
    
    include_once ($_SERVER['DOCUMENT_ROOT'].'/cuidotuamigo/rutas.php');

    $pathPrivadoTrabajador = VPRIVADO_TRAB_PATH;

?>
<nav class="menu"> 
    <ul>
        <li> <a href="<?php echo $pathPrivadoTrabajador;?>/mi_cuenta.php"><span style="font-weight:bold">Mi Cuenta </span></a></li>
        <li> <a href="<?php echo $pathPrivadoTrabajador;?>/mis_reservas.php"><span style="font-weight:bold">Mis Reservas </span></a></li>
    </ul>
    
</nav>