<!DOCTYPE html>
<?php
    
   
    include_once ($_SERVER['DOCUMENT_ROOT'].'/cuidotuamigo/rutas.php');
    include (DATA_PATH."conexiondb.php");

    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }

    
    $pathcliente = VPRIVADO_CLIENTE_PATH;
    
    $array = array("../../../estatico/css/reserva.css");
    $arrayJs = array("../../../estatico/js/reserva.js");
    include('../../comun/head.php');

 
    
    date_default_timezone_set("America/Santiago");

    $datetime = new DateTime();

    if(isset($_GET['loadHours'])){
        $hourSelected = $_GET['loadHours'];
        debug_to_console("** $hourSelected");
    }

    $consultaTrab = "select t.id_trabajador, p.nombre, p.apellido_paterno, p.apellido_materno from cuidotuamigodb.trabajador t 
    inner join cuidotuamigodb.persona p on p.id_persona = t.id_persona 
    where t.id_tipo_trabajador =1";

    $resultTrab = mysqli_query($conex,$consultaTrab);

    if(isset($_SESSION['id_cliente'])){
        $consultaMascotas = "select id_mascota, nombre from cuidotuamigodb.mascota where id_cliente =".$_SESSION['id_cliente'];
        $resultMascotas = mysqli_query($conex,$consultaMascotas);
    }
?>
<script>

    //const jsonListStr = "{'reservas':[]}";
    //const reservasJson = JSON.parse(jsonListStr);

    const jsonListStr = '{ "reservas":[]}';
    const reservasJson = JSON.parse(jsonListStr);
    

    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '< Ant',
        nextText: 'Sig >',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $(document).ready(function() {

        var dateToday = new Date();
        
      
        $(".date").datepicker({
            numberOfMonths: 1,
            minDate: dateToday,
            dateFormat: "dd-mm-yy",
            onSelect: function(dateText) {
                
                $.getJSON("../../../data/buscaHoras.php", {    
                    "fecha": dateText,
                    "idTrab": document.getElementById('profesional').value
                }).done(function(response) {
                    
                    if (response.success) {
                        console.log("exito : "+ response.data.message);
                        //console.log("exito : "+ JSON.stringify(response.data.horarios));
                        var output = "";
                        $.each(response.data.horarios, function( key, value ) {
                            output += "<option value='" + value['id_horario'] + "'>"+value['hora']+"</option>";
                        });
                        //console.log(output)
                        $("#horarios").html(output);
                    } else {
                        console.log("fallo : "+ response.data.message);
                        var output = "";
                        output += "<option value='-1'>No hay horarios</option>";
                        $("#horarios").html(output);
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.log("Algo ha fallado : "+JSON.stringify(jqXHR));        
                    var output = "";
                    output += "<option value='-1'>No hay horarios</option>";
                    $("#horarios").html(output);            
                });

                
            }
        });
        
       
    });

    function agregarHorario(){

        var rowCount = $('#reservas >tbody >tr').length;

        var fecha = $("#datepicker").val();
        var hora = $("#horarios option:selected").text();
        var mascota = $("#mascota option:selected").text();
        var prof = $("#profesional option:selected").text();
        
        if(fecha == null || fecha == "" || hora == null ||hora == "" || hora == "No hay horarios"){
            alert("Para agregar una reserva debe ingresar la fecha y hora")
            return;
        }

        if(mascota == "Sin Mascotas"){
            alert("Debe tener al menos una mascota registrada")
            return;
        }


        var tr= "<tr id='tr_"+(rowCount+1)+"'>";
        tr += "<td>"+prof+"</td>";
        tr += "<td>"+mascota+"</td>";
        tr += "<td>"+fecha+"</td>";
        tr += "<td>"+hora+"</td>";
        tr += "<td><a href=\"javascript:eliminarHorario("+(rowCount+1)+");\"><span class=\"fa fa-trash\"></span></a></td>";
        tr += "</tr>";
        //$("#reservas>tbody").append("<tr><td class='col-1'>1</td><td>1</td><td>1</td><td>1</td><td>1</td></tr>");
        $("#reservas>tbody").append(tr);

        var idTrab = $("#profesional").val();
        var idMasc = $("#mascota").val();
        var idHorario = $("#horarios").val();

        reservasJson.reservas.push({"idTrab":idTrab, "idMasc":idMasc, "idHorario":idHorario});
    }
    function eliminarHorario(id){
        $("#tr_"+id).remove(); 
    }
    function limpiaFecha(){
        $("#datepicker").val("");
        $('#horarios')
            .find('option')
            .remove()
            .end()
            .append('<option value="-1">No hay horarios</option>')
            .val('-1')
        ;
    }

    function guardar(){
        console.log(JSON.stringify(reservasJson))
    }

 
</script>
<body>

<div id="contenedor"> <!-- Contenedor-->
    <?php
        include('../../comun/header.php');
    ?>
    <?php
        include('../../comun/menu_publico.php');
    ?>

    <div class="filtros-res formulario-res">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <label for="profesional" class="form_label">Profesional: </label>
            </div>
            <div class="col-md-3">
                <select name="profesional" id="profesional" class="form-control" onchange="limpiaFecha()">
                <?php 
                while ($row = mysqli_fetch_array($resultTrab))
                {
                    echo "<option value=".$row['id_trabajador'].">".$row['nombre']." ".$row['apellido_paterno']."</option>";
                }
                ?>
                </select>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <label for="mascota" class="form_label">Mascota: </label>
            </div>
            <div class="col-md-3">
                <select name="mascota" id="mascota" class="form-control">
                    <?php 
                    if(isset($resultMascotas) && $resultMascotas->num_rows >0){
                        while ($row = mysqli_fetch_array($resultMascotas))
                        {
                            echo "<option value=".$row['id_mascota'].">".$row['nombre']."</option>";
                        }
                    }else{
                        echo "<option value=".$row['id_mascota'].">Sin Mascotas</option>";
                    }
                    ?>
                </select>
            </div>
            
        </div>
        <br/>
        <div class="row">
     
            <div class="col-md-11">
                <div class="card carga-horas">
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="col-md-1">
                                <label for="mascota">Día:</label>
                            </div>
                            <div class="col-md-4">
                                <input type='text' class='date' id="datepicker">
                            </div>
                            <div class="col-md-2">
                                <label for="mascota">Horas:</label>
                            </div>
                            <div class="col-md-3">
                                <select name="horarios" id="horarios" class="form-control">
                                    <option value="1">No hay horarios</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <input type="button" value="+" onclick="agregarHorario()" class="btn btn_planes">
                            </div>
                        </div>
                        <br/><br/>
                        <div class="row table-container">
                            <table class="table table-striped" style="background-color: white" id="reservas">
                                <thead>
                                    <tr>
                                    <th scope="col">Profesional</th>
                                    <th scope="col">Mascota</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="tbd">
                                    
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row"><br></div>
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-1">
                <input type="button" value="Guardar" onclick="guardar()" class="btn btn_planes">
            </div>
        </div>
    </div>
    <br/>

    <?php
        include('../../comun/footer.php');
    ?>

</div>



</body>

</html>