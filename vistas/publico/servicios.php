<!DOCTYPE html>
<?php
    $array = array("../../estatico/css/servicios.css");
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

        <div>
            <div class="rectangulo" style = "float: left">
                <div class="serv_cont" ><h3>Paseos recreativos</h3></div>
               
                <div class="serv_cont">
                    <div class="fotoref">
                        <img src="../../estatico/images/paseo.jpg" alt="paseo" width="200" height="170">
                    </div>
                </div>
                <br/>

                <div class="serv_cont">
                    <h5><p>Paseos personalizados según las necesidades de su amigo, nos importa que sea un paseo divertido con oportunidad para sociabilizar con otros perritos de su barrio. </p> 
                    <p>Tienen una duración entre 40 y 50 minutos, se ofrece agua durante el paseo, 
                    se retira y se entrega en su domicilio. Debe presentar placa con su nombre y vacunas al día.</p>
                    </h5>
                </div>
                <br/>
                <div>
                    <input type="button" value=">> Ver Planes" onclick="location.href='planes.php'" class="btn  btn_planes"><br>
                </div>
            </div>

            <div class="rectangulo" style = "float: left">
                <div class="serv_cont" ><h3>Cuidado a domicilio</h3></div>

                <div class="serv_cont">
                    <div class="fotoref">
                        <img src="../../estatico/images/domicilio.jpg" alt="paseo" width="200" height="170">
                    </div>
                </div>
                <br/>

                <div class="serv_cont">
                    <h5><p>Perros: visitas entre 40 y 50 minutos. Se alimentan, se limpia su entorno, se pasean y se les deja cómodos. Se envía registro fotográfico.</p>
                     <P>Gatos: visitas entre 30 y 40 minutos. Se alimentan, se limpia su entorno o arenero, se juega con ellos y se les deja cómodos. Se envía registro fotográfico.</P>
                    
                    </h5>
                </div>
                <br/>
                <div>
                    <input type="button" value=">> Ver Planes" onclick="location.href='planes.php'" class="btn  btn_planes"><br>
                </div>
            </div>
        </div>

        <?php
            include('../comun/footer.php');
        ?>

    </div>


</body>

</html>