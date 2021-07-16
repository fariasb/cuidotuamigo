<!DOCTYPE html>
<?php
    $array = array("../../estatico/css/quienessomos.css");
    include('../comun/head.php');
?>
<body>

    <div id="contenedor"> <!-- Contenedor-->
        <?php
            include('../comun/header.php');
        ?>
        <?php
            include('../comun/menu_publico.php');
        ?>

        <article class="box1">
            <div style="margin-bottom: 12%;"><img style="border-radius: 10px;" src="../../estatico/images/perro1.jpeg" alt="perro1" width="380" height="200"></div>
            <div style="border-radius: 10px;"><img style="border-radius: 10px;" src="../../estatico/images/perro4.png" alt="perro4" width="380" height="200"></div>

        </article>

        <article class="box_contenido">
            <div class="contenido_cuadro">
                <h3 class="titulo_quienesomos"> <B>QUIENES SOMOS </B></h3>
                <p><b>Una empresa familiar</b> </p>
                <p class="parrafoprincipal">Somos <span style="font-weight: bold;">Tu Amigo SPA.</span>  Empresa legalmente establecida y con años trabajando
                    en el rubro de cuidados de mascotas. <br><br>
                    ​
                    Comenzamos a trabajar en este ámbito de forma remunerada por el año 2014 donde por cosas del destino una
                    pareja de amigos veterinarios nos dejó a cargo su perrita, así comenzamos el servicio de guardería, lo
                    fuimos complementando con paseos y poco a poco se fueron sumando los clientes pasando a ser este,
                    nuestro trabajo único y principal. <br>

                    Para nosotros es muy importante cuidar de su mascota como si cuidáramos a un integrante más de nuestra
                    propia familia, y como sabemos lo importante que ellos son para ustedes es que hemos ido aprendiendo ,
                    creciendo y perfeccionandonos para entregar el mejor servicio posible.</p>
            </div>

        </article>

        <?php
            include('../comun/footer.php');
        ?>

    </div>


</body>

</html>