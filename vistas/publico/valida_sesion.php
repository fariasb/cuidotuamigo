<!DOCTYPE html>
<?php
    $arrayCss = array("../../estatico/css/hazte_cliente.css");
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

        <article class="box2">
            <div class="contenido" style="height: 412px;">
                <h2> Iniciar sesión  </h2><br>
               
                <div class="formulario_contacto">
                    
                    <form action="">
                        <label for="correo">Correo electrónico:</label><br>
                        <input type="text" id="correo" placeholder="correo@gmail.com"><br><br>
                        <label for="pass">Contraseña:</label><br>
                        <input type="password" id="pass"><br><br>
                        <input type="button" value="Ingresar" onclick="location.href='../privado/cliente/reserva.php'" class="btn  btn_planes"><br><br>
                        <h6>¿No eres cliente aún? <a href="hazte_cliente.php">Hazte Cliente!</a></h6>
                    </form>
    
                </div>
            </div>
    
        </article>

        <?php
            include('../comun/footer.php');
        ?>

    </div>


</body>

</html>