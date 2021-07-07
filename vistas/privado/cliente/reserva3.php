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

    //echo '<pre>';
    //var_dump($_SESSION);
    //echo '</pre>';

    date_default_timezone_set("America/Santiago");
    //date_default_timezone_set('Brazil/East');

    $datetime = new DateTime();

    if(isset($_GET['loadHours'])){
        $hourSelected = $_GET['loadHours'];
        debug_to_console("$hourSelected");
    }
?>
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
                <select name="profesional" id="profesional" class="form-control">
                    <option value="1">Juan Perez</option>
                    <option value="2">Antonia Lagos</option>
                    <option value="3">Maria Rosales</option>
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
                    <option value="1">Michi</option>
                    <option value="2">Cachupin</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="button" value="Buscar" class="btn btn_planes">
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-9">
                <div class="card carga-horas">
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="col-md-1">
                                <label for="mascota">Día:</label>
                            </div>
                            <div class="col-md-4">
                                <input id="datepickerfrom" type="date" name="datepickerfrom" width="250" onchange="location.href='reserva3.php?loadHours=as'" />
                            </div>
                            <div class="col-md-2">
                                <label for="mascota">Horas:</label>
                            </div>
                            <div class="col-md-3">
                                <select name="mascota" id="mascota" class="form-control">
                                    <option value="1">10:00</option>
                                    <option value="2">11:00</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <input type="button" value="+" class="btn btn_planes">
                            </div>
                        </div>
                        
                        <div class="row">
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        </div>
    </div>
    <br/>

    <?php
        include('../../comun/footer.php');
    ?>

</div>


</body>

</html>