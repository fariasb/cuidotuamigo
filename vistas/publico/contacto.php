<!DOCTYPE html>
<?php
    $array = array("../../estatico/css/contacto.css");
    include('../comun/head.php');
?>
 <script>
        
        $( function() {
          $.datepicker.setDefaults($.datepicker.regional["es"]);
          $( "#fechanacto" ).datepicker();
        } );
        </script>
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
                <h2 >Contáctate con nosotros</h2><br>
               
                <div class="formulario_contacto">
                    <form action="" name="form">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" class="campo"  placeholder="Ingrese Nombre"><br><br>
                        <label for="apellido">Apellido:</label>
                        <input type="text" name="apellido" class="campo"  placeholder="Ingrese Apellido"><br><br>
                        <label for="mail">Mail:</label>
                        <input type="email" name="correo" class="campo"  placeholder="Ingrese Mail" ><br><br>
                        <label for="fechanacimiento">Fecha de nacimiento</label>
                        <input type="text" id="fechanacto" name="fechanacto"><br><br>
    
                    
                        <label for="genero">Género:</label>
                        <input type="radio" name="género" class="form_radio" value="femenino" checked>Femenino
                        <input type="radio" name="género" class="form_radio" value="masculino">Masculino <br><br>
    
                        <label for="asunto">Asunto:</label><br>
                        <input type="text" name="asunto" class="campo_asunto"><br><br>
    
    
    
                        <label for="Comentarios">Comentarios:</label> <br>
                        <textarea name="comentarios" style="resize: none;" class="campo_asunto" id="" cols="50" rows="7"  placeholder="Escriba su mensaje"></textarea>
                        <br><br>
    
                        <input type="submit" value="Enviar mensaje" class="btn btn-success btn_planes" onclick="return validar()">
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