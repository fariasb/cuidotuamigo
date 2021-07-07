<!DOCTYPE html>
<?php
  
    $array = array("../../../estatico/css/agregar_trabajador.css");
    include('../../comun/head.php');

?>
<script>
    $(document).ready(function(){
    //getdeails será nuestra función para enviar la solicitud ajax
    var getdetails = function(id){
        return $.getJSON( "personas.php", { "id" : id });
    }
    
    //al hacer click sobre cualquier elemento que tenga el atributo data-user.....
    $('[data-user]').click(function(e){
        //Detenemos el comportamiento normal del evento click sobre el elemento clicado
        e.preventDefault();
        //Mostramos texto de que la solicitud está en curso
        $("#response-container").html("<p>Buscando...</p>");
        //this hace referencia al elemento que ha lanzado el evento click
        //con el método .data('user') obtenemos el valor del atributo data-user de dicho elemento y lo pasamos a la función getdetails definida anteriormente
        getdetails($(this).data('user'))
        .done( function( response ) {
            //done() es ejecutada cuándo se recibe la respuesta del servidor. response es el objeto JSON recibido
            if( response.success ) {
                
                console.log("exito : "+ response.data.message);
                
                } else {
                    console.log("err0r : "+ response.data.message);
            }
        })
        .fail(function( jqXHR, textStatus, errorThrown ) {
            $("#response-container").html("Algo ha fallado: " +  textStatus);
        });
    });
});        
</script>

<body>

    <div id="contenedor"> <!-- Contenedor-->
        <?php
            include('../../comun/header.php');
        ?>
        <?php
            include('../../comun/menu_privado_admin.php');
        ?>

<p><button data-user="1">Dame los datos de la persona con ID = 1</button> - <button data-user="[1,2,3]">Dame los datos de las personas con ID = 1, ID = 2 e ID = 3.</button> - <button data-user="0">Ningún usuario</button></p>
        <div id="response-container"></div>

        <?php
            include('../../comun/footer.php');
        ?>

    </div>
</body>

</html>