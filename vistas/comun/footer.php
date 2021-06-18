<?php
    $path = getcwd();
    $pathEstatico = "estatico";
    if (endswith($path, 'cliente') || endswith($path, 'admin') || endswith($path, 'trabajador')) {
        $pathEstatico = "../../../estatico";
    }
    if (endswith($path, 'publico')) {
        $pathEstatico = "../../estatico";
    }

    function endswith($string, $test) {
        $strlen = strlen($string);
        $testlen = strlen($test);
        if ($testlen > $strlen) return false;
        return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
    }
?>
<footer class="footer">
    <div class="footer_logo"> 
        <li> 
            <a href=""><img src="<?php echo $pathEstatico;?>/images/instagram.png" alt="logotipo" width="27" height="27"></a>
            Instagram</li>
        <li>
            <a href=""><img src="<?php echo $pathEstatico;?>/images/facebook.png" alt="logotipo" width="27" height="27"></a>
            Facebook
        </li>
        <li>
            <a href=""><img src="<?php echo $pathEstatico;?>/images/whatsapp.png" alt="logotipo" width="27" height="27"></a>
            whatsap
        </li>
    </div>
    
    <div class="footer_link">
        <h3><span>CUIDO TU AMIGO</span></h3>
        <h3><span>cuidotuamigo@gmail.com</span></h3>
        <h3><span>Horario de consultas lunes a viernes de 10:00 a 20:00 hrs</span></h3>

    </div>

</footer>