<!DOCTYPE html>
<?php
    $array = array("../../estatico/css/hazte_cliente.css");
    include('../comun/head.php');

    include("../../data/conexiondb.php");

    $query = "SELECT id_comuna, nombre_comuna FROM comuna ORDER BY nombre_comuna";
    $result = mysqli_query($conex,$query);
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
            <div class="contenido">
                <h2> Hazte cliente y accede a nuestros servicios  </h2><br>
               
                <div class="formulario_contacto">
                    
                    <form action="" method="POST">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" ><br><br>
                        <label for="apellido">Apellido:</label>
                        <input type="text" id="apellido" name="apellido" ><br><br>
                        <label for="rut">Rut:</label>
                        <input type="text" id="rut" name="rut" ><br><br>
                        
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name ="direccion" placeholder="Calle # Número"><br><br>
                        <label for="comuna">Comuna:</label>
                        <select name="comuna">
                        <?php 
                        while ($row = mysqli_fetch_array($result))
                        {
                            echo "<option value=".$row['id_comuna'].">".$row['nombre_comuna']."</option>";
                        }
                        ?>        
                        </select><br/>
                        <label for="correo">Correo electrónico:</label>
                        <input type="text" id="correo" name ="correo" placeholder="correo@gmail.com"><br><br>
                        <!--<label for="telefono">Télefono de contacto:</label>
                        <input type="text" id="telefono"  name ="telefono" placeholder="9 12345678"><br><br>
                        -->
                        <h6><i>*Las solicitudes serán revisadas por nuestra administradora. Se enviará un correo una vez sea aprobada.</i> </h6>
                        <input type="submit" value="Enviar Solicitud" class="btn  btn_planes"><br><br>
                        
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