<!DOCTYPE html>
<?php
    $arrayCss = array("../../../estatico/css/confirmacion.css");
    include('../../comun/head.php');
?>
<body>

    <div id="contenedor"> <!-- Contenedor-->
        <?php
            include('../../comun/header.php');
        ?>
        <?php
            include('../../comun/menu_privado_admin.php');
        ?>

        <section class="seccion_cuenta">
            <div class="cuenta">
                
                <div class="formulario_cuenta">
                    <h2> ¡¡Enhorabuena!! Tu reserva ha sido registrada!</h2><br/>
                    <h4> Informaremos al profesional de la reserva, cualquier incoveniente se le informará a la brevedad.</h4>
                </div>

            </div>
        </section>

        <?php
            include('../../comun/footer.php');
        ?>

    </div>


</body>

</html>