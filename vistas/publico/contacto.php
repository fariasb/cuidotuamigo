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
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-3"> 
                                <label for="nombre">Nombre:</label>
                            </div>
                            <div class="col-md-6"> 
                                <input type="text" name="nombre"    class="form-control" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-3"> 
                                <label for="apellido">Apellido:</label>
                            </div>
                            <div class="col-md-6"> 
                                <input type="text" name="apellido"  class="form-control" required >
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-3"> 
                                <label for="mail" >Correo:</label>
                            </div>
                            <div class="col-md-6"> 
                                <input type="email" name="correo"  class="form-control" required  >
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-3"> 
                                <label for="asunto">Asunto:</label>
                            </div>
                            <div class="col-md-6"> 
                                <input type="text" name="asunto"  class="form-control" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-3"> 
                            <label for="Comentarios">Comentarios:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10"> 
                                <textarea name="comentarios" style="resize: none;"  class="form-control" required id="" cols="50" rows="7"  placeholder="Escriba su mensaje"></textarea>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <input type="submit" value="Enviar mensaje" class="btn btn-success btn_planes" onclick="return validar()">
                            </div>
                        </div>
                        
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