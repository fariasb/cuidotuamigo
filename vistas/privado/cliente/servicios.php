<!DOCTYPE html>
<?php
    $array = array("../../../estatico/css/servicios.css");
    include('../../comun/head.php');
?>
<body>

    <div id="contenedor"> <!-- Contenedor-->
        <?php
            include('../../comun/header.php');
        ?>
        <?php
            include('../../comun/menu_privado_cliente.php');
        ?>

        <div>
            <div class="rectangulo" style = "float: left">
                <div class="serv_cont" ><h3>Paseos recreativos</h3></div>
               
                <div class="serv_cont">
                    <div class="fotoref">
                        <img src="../../../estatico/images/paseo.jpg" alt="paseo" width="200" height="170">
                    </div>
                </div>
                <br/>

                <div class="serv_cont">
                    <h4> Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, suscipit omnis? Quisquam,
                        numquam accusamus a expedita sunt praesentium deserunt quis explicabo quasi consequuntur atque
                        provident aliquid beatae quos eveniet repudiandae! ipsum dolor sit amet consectetur adipisicing
                        elit.
                    </h4>
                </div>
                <br/>
                <div>
                    <input type="button" value=">> Ver Planes" onclick="location.href='planes.php'" class="btn  btn_planes"><br>
                </div>
            </div>

            <div class="rectangulo" style = "float: left">
                <div class="serv_cont" ><h3>Cuidado a domicilis</h3></div>

                <div class="serv_cont">
                    <div class="fotoref">
                        <img src="../../../estatico/images/domicilio.jpg" alt="paseo" width="200" height="170">
                    </div>
                </div>
                <br/>

                <div class="serv_cont">
                    <h4> Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, suscipit omnis? Quisquam,
                        numquam accusamus a expedita sunt praesentium deserunt quis explicabo quasi consequuntur atque
                        provident aliquid beatae quos eveniet repudiandae! ipsum dolor sit amet consectetur adipisicing
                        elit.
                    </h4>
                </div>
                <br/>
                <div>
                    <input type="button" value=">> Ver Planes" onclick="location.href='planes.php'" class="btn  btn_planes"><br>
                </div>
            </div>
        </div>

        <?php
            include('../../comun/footer.php');
        ?>

    </div>


</body>

</html>