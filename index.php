<!DOCTYPE html>
<?php
    $arrayCss = array("estatico/css/home.css");
    include('vistas/comun/head.php');
?>
<body>

    <div id="contenedor"> <!-- Contenedor-->
        <?php
            include('vistas/comun/header.php');
        ?>
        <?php
            include('vistas/comun/menu_publico.php');
        ?>

        <article class="box1"> 
            <img src="estatico/images/descuento.png" alt="descuento" width="380" height="400" class="fotodescuento">

        </article>

        <article class="box2">
            <div class="contenido">
                <h3 class="titulo_contenido">¡Cuidamos un integrante más de tu familia!</h3>
                <p><b>Una empresa familiar</b> </p>
                <p class="parrafo_principal">Lorem ipsum dolor sit amet consectetur 
                    adipisicing elit. Dolores facere, quae reprehenderit ipsam fuga eius
                    asperiores, quam debitis omnis sapiente, libero doloribus 
                    consectetur enim sunt nesciunt mollitia at accusamus
                    veritatis.libero doloribus 
                    consectetur enim sunt nesciunt mollitia at accusamus
                    veritatis.</p>
                <p class="parrafo_principal">Lorem ipsum dolor sit amet consectetur 
                    adipisicing elit. Dolores facere, quae reprehenderit ipsam fuga eius
                    asperiores, quam debitis omnis sapiente, libero doloribus 
                    consectetur enim sunt nesciunt mollitia at accusamus
                    veritatis.
                </p>
                <p class="parrafo3">Lorem ipsum dolor sit amet consectetur 
                    adipisicing elit. 
                </p>
            </div>

        </article>

        <?php
            include('vistas/comun/footer.php');
        ?>

    </div>
</body>

</html>