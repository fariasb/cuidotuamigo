<!DOCTYPE html>
<?php
    
   
    include_once ($_SERVER['DOCUMENT_ROOT'].'/cuidotuamigo/rutas.php');
    include (DATA_PATH."conexiondb.php");

    $array = array("../../../estatico/css/mi_cuenta.css", "../../../estatico/css/admin.css", "../../../estatico/css/reserva.css","../../../estatico/font/css/all.css");
    $arrayJs = array("../../../estatico/js/reserva.js");
    include('../../comun/head.php');

    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }

    date_default_timezone_set("America/Santiago");

    $datetime = new DateTime();


    $consultaTrab = "select t.id_trabajador, p.nombre, p.apellido_paterno, p.apellido_materno from cuidotuamigodb.trabajador t 
    inner join cuidotuamigodb.persona p on p.id_persona = t.id_persona 
    where t.id_tipo_trabajador =1";

    $resultTrab = mysqli_query($conex,$consultaTrab);

?>
<script>

    const jsonListStr = '{ "horarios":[], "deleted":[]}';
    const horariosJson = JSON.parse(jsonListStr);
    
    const horasTotales = ["07:00","08:00","09:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00"];

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
        
        $("#successMsge").hide();
      
        $(".date").datepicker({
            numberOfMonths: 1,
            minDate: dateToday,
            dateFormat: "dd-mm-yy",
            onSelect: function(dateText) {

                $('#horarios')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="-1">No hay horarios</option>')
                    .val('-1')
                ;
                horariosJson.horarios = [];
                horariosJson.deleted = [];
                $("#reservas>tbody").empty();
                
                $.getJSON("../../../data/buscaHorasAdmin.php", {    
                    "fecha": dateText,
                    "idTrab": document.getElementById('profesional').value
                }).done(function(response) {
                    
                    if (response.success) {
                        console.log("exito : "+ response.data.message);
                        console.log("exito : "+ JSON.stringify(response.data.horarios));
                        var output = "";
                        for(var i=0;i < horasTotales.length;i++){
                            var registrada = false;
                            $.each(response.data.horarios, function( key, value ) {
                                if(value['hora'] == horasTotales[i]){
                                    registrada = true;
                                }
                                
                            });  
                            if(!registrada){
                                output += "<option value='" + ((i+1)*-1) + "'>"+horasTotales[i]+"</option>";
                            }  
                        }
                        
                        $.each(response.data.horarios, function( key, value ) {

                            if(value['id_atencion'] == null){
                                var maxCount = 0;
                                for(var i = 0; i < horariosJson.horarios.length; i++) {
                                    var obj = horariosJson.horarios[i];
                                    if(obj.count > maxCount){
                                        maxCount = obj.count;
                                    }
                                }
                                var prof = $("#profesional option:selected").text();
                                var idTrab = $("#profesional").val();
                                var tr= "<tr id='tr_"+(maxCount+1)+"'>";
                                tr += "<td>"+prof+"</td>";
                                tr += "<td>"+dateText+"</td>";
                                tr += "<td>"+value['hora']+"</td>";
                                tr += "<td><a href=\"javascript:eliminarHorario("+(maxCount+1)+");\"><span class=\"fa fa-trash\"></span></a></td>";
                                tr += "</tr>";
                                //$("#reservas>tbody").append("<tr><td class='col-1'>1</td><td>1</td><td>1</td><td>1</td><td>1</td></tr>");
                                $("#reservas>tbody").append(tr);           

                                horariosJson.horarios.push({"count":(maxCount+1),"idTrab":idTrab, "idHorario":value['id_horario'], "hora":value['hora'], "fecha": dateText});
                                console.log(JSON.stringify(horariosJson))
                            }
                        });
                        //console.log(output)
                        $("#horarios").html(output);
                    } else {
                        if(response.count == 0){
                            console.log("vacio : "+ response.data.message);
                            for(var i=0;i < horasTotales.length;i++){
                                output += "<option value='" + ((i+1)*-1) + "'>"+horasTotales[i]+"</option>";
                            }
                            $("#horarios").html(output);
                        }else{
                            console.log("fallo : "+ response.data.message);
                            var output = "";
                            output += "<option value='-1'>No hay horarios</option>";
                            $("#horarios").html(output);
                        }
                       
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


        var fecha = $("#datepicker").val();
        var hora = $("#horarios option:selected").text();
        var prof = $("#profesional option:selected").text();
        
        if(fecha == null || fecha == "" || hora == null ||hora == "" || hora == "No hay horarios"){
            alert("Para agregar una reserva debe ingresar la fecha y hora")
            return;
        }

        var idTrab = $("#profesional").val();
        var idHorario = $("#horarios").val();

        var existe = false;
        var maxCount = 0;
        for(var i = 0; i < horariosJson.horarios.length; i++) {
            var obj = horariosJson.horarios[i];
            if(obj.idTrab == idTrab && obj.idHorario==idHorario){
                existe = true;
            }
            if(obj.count > maxCount){
                maxCount = obj.count;
            }
        }
        if(existe){
            alert("El horario ya se encuentra ingresado para este trabajador")
            return;
        }
        
        var tr= "<tr id='tr_"+(maxCount+1)+"'>";
        tr += "<td>"+prof+"</td>";
        tr += "<td>"+fecha+"</td>";
        tr += "<td>"+hora+"</td>";
        tr += "<td><a href=\"javascript:eliminarHorario("+(maxCount+1)+");\"><span class=\"fa fa-trash\"></span></a></td>";
        tr += "</tr>";
        //$("#reservas>tbody").append("<tr><td class='col-1'>1</td><td>1</td><td>1</td><td>1</td><td>1</td></tr>");
        $("#reservas>tbody").append(tr);

        horariosJson.horarios.push({"count":(maxCount+1),"idTrab":idTrab, "idHorario":idHorario, "hora":hora, "fecha": fecha});
        console.log(JSON.stringify(horariosJson))

    }
    function eliminarHorario(id){
        $("#tr_"+id).remove(); 
        var index = 0;
        for(var i = 0; i < horariosJson.horarios.length; i++) {
            var obj = horariosJson.horarios[i];
            if(obj.count == id){
                index = i;
                if(obj.idHorario>0){
                    horariosJson.deleted.push({"id":obj.idHorario});
                }
                break;
            }
        }
        horariosJson.horarios.splice(index, 1);
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
        horariosJson.horarios = [];
        horariosJson.deleted = [];
        $("#reservas>tbody").empty();
    }

    function guardar(){
        console.log(JSON.stringify(horariosJson))

        if(horariosJson.deleted.length == 0 && horariosJson.horarios.length == 0){
            alert("Debe ingresar o eliminar horarios para poder guardar");
            return;
        }

        var exito = true;
        for(var i = 0; i < horariosJson.deleted.length; i++) {
            var obj = horariosJson.deleted[i];
            $.getJSON("../../../data/registraHorario.php", {    
                "idHorario": obj.id,
                "accion": "delete"
            }).done(function(response) {
                
                if (response.success) {
                    console.log("exito delete : "+ response.data.message);
                
                } else {
                    console.log("fallo dalete: "+ response.data.message);
                
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.log("Algo ha fallado delete: "+JSON.stringify(jqXHR));        
                exito = false;
            });
        }
        for(var i = 0; i < horariosJson.horarios.length; i++) {
            var obj = horariosJson.horarios[i];

            $.getJSON("../../../data/registraHorario.php", {    
                "idTrab": obj.idTrab,
                "hora": obj.hora,
                "fecha": obj.fecha,
                "idHorario": obj.idHorario,
                "accion": "create"
            }).done(function(response) {
                
                if (response.success) {
                    console.log("exito create: "+ response.data.message);
                
                } else {
                    console.log("fallo create: "+ response.data.message);
                
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.log("Algo ha fallado create: "+JSON.stringify(jqXHR));        
                exito = false;
            });
        }
        if(exito){
            
            for(var i = 0; i < horariosJson.horarios.length; i++) {
                var obj = horariosJson.horarios[i];
                $("#tr_"+obj.count).remove(); 
            }
            horariosJson.horarios=[];
            limpiaFecha();

            var modal = document.getElementById("successMsge");
            var btnCloses = document.getElementById("closesBtn");

            btnCloses.onclick = function() {
                modal.style.display = "none";
                window.location.href = "admin_horarios.php";
            }
            modal.style.display = "block";
        }
      

        
    }

    var modal = document.getElementById("successMsge");
    

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

 
</script>
<body>

<body>

    <div id="contenedor"> <!-- Contenedor-->
        <?php
            include('../../comun/header.php');
        ?>
        <?php
            include('../../comun/menu_privado_admin.php');
        ?>
         <div class="contenido_admin_clientes">
                <h2 >Horarios disponibles de Trabajadores</h2><br>

        <div id="successMsge" class="modal">
            <div class="row">
                <!-- Modal content -->
                <div class="col-md-3"></div>
                <div class="col-md-4 modal-content">
                    <div class="modal-content">
                        <div class="row">
                            <p>¡Se han registrado los horarios con Éxito!</p>
                        </div>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"><button id="closesBtn">Aceptar</button></div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>

        <div class="filtros-horarios formulario-horario">
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
                </div>

        <?php
            include('../../comun/footer.php');
        ?>

    </div>
</body>

</html>