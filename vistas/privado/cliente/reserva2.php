<!DOCTYPE html>
<?php
    
    session_start();
   
    include_once ($_SERVER['DOCUMENT_ROOT'].'/cuidotuamigo03/rutas.php');
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
    //$now = $datetime->format('Y\-m\-d\ h:i:s');
    //echo $now; //2021-06-20 09:31:25
    //echo strftime("%A",$datetime->getTimestamp());

    $days_dias = array(
        'Monday'=>'Lun',
        'Tuesday'=>'Mar',
        'Wednesday'=>'Miér',
        'Thursday'=>'Jue',
        'Friday'=>'Vie',
        'Saturday'=>'Sáb',
        'Sunday'=>'Dom'
        );

    $dia_uno = new DateTime();
    $dia_dos = new DateTime();
    $dia_dos->add(new DateInterval('P1D'));
    $dia_tres = new DateTime();
    $dia_tres->add(new DateInterval('P2D'));

    debug_to_console("111111111111 ".$dia_uno->format('Y\-m\-d'));

    if (isset($_GET['next']))
    {
        
        $timeStampUltimo = $_GET['next'];
        //$dia_anterior = new DateTime();
        $dia_uno->setTimestamp($timeStampUltimo);
        $dia_uno->add(new DateInterval('P1D'));
        $dia_dos = new DateTime();
        $dia_dos->setTimestamp($timeStampUltimo);
        $dia_dos->add(new DateInterval('P2D'));
        $dia_tres = new DateTime();
        $dia_tres->setTimestamp($timeStampUltimo);
        $dia_tres->add(new DateInterval('P3D'));

        $_SESSION['dia_uno'] = $dia_uno->getTimestamp();
        $_SESSION['dia_dos'] = $dia_dos->getTimestamp();
        $_SESSION['dia_tres'] = $dia_tres->getTimestamp();
        debug_to_console("set on sesion dia_uno ".$_SESSION['dia_uno']);
        debug_to_console("set on sesion dia_dos ".$_SESSION['dia_dos']);
        debug_to_console("set on sesion dia_tres ".$_SESSION['dia_tres']);

    }

    if (isset($_GET['prev']))
    {
      
        $timeStampPrimero = $_GET['prev'];
        //$dia_anterior = new DateTime();
        $dia_uno->setTimestamp($timeStampPrimero);
        $dia_uno->sub(new DateInterval('P3D'));

        $dia_dos = new DateTime();
        $dia_dos->setTimestamp($timeStampPrimero);
        $dia_dos->sub(new DateInterval('P2D'));
        $dia_tres = new DateTime();
        $dia_tres->setTimestamp($timeStampPrimero);
        $dia_tres->sub(new DateInterval('P1D'));

        $_SESSION['dia_uno'] = $dia_uno->getTimestamp();
        $_SESSION['dia_dos'] = $dia_dos->getTimestamp();
        $_SESSION['dia_tres'] = $dia_tres->getTimestamp();
        debug_to_console("set on sesion dia_uno ".$_SESSION['dia_uno']);
        debug_to_console("set on sesion dia_dos ".$_SESSION['dia_dos']);
        debug_to_console("set on sesion dia_tres ".$_SESSION['dia_tres']);

    }

    if(isset($_SESSION['dia_uno'])){
        $dia_uno->setTimestamp($_SESSION['dia_uno']);
        debug_to_console("en sesion dia_uno ".$_SESSION['dia_uno']);
    }else{
        $_SESSION['dia_uno'] = $dia_uno->getTimestamp();
    }

    if(isset($_SESSION['dia_dos'])){
        $dia_dos->setTimestamp($_SESSION['dia_dos']);
        debug_to_console("en sesion dia_dos ".$_SESSION['dia_dos']);
    }else{
        $_SESSION['dia_dos'] = $dia_dos->getTimestamp();
    }

    if(isset($_SESSION['dia_tres'])){
        $dia_tres->setTimestamp($_SESSION['dia_tres']);
        debug_to_console("en sesion dia_tres ".$_SESSION['dia_tres']);
    }else{
        $_SESSION['dia_tres'] = $dia_tres->getTimestamp();
    }

    $first =  $dia_uno->getTimestamp();
    $last =  $dia_tres->getTimestamp();

    $primerDia = $days_dias[date('l', $dia_uno->getTimestamp())]." ".$dia_uno->format('d')."-".$dia_uno->format('m');
    $segundoDia = $days_dias[date('l', $dia_dos->getTimestamp())]." ".$dia_dos->format('d')."-".$dia_dos->format('m');
    $tercerDia = $days_dias[date('l', $dia_tres->getTimestamp())]." ".$dia_tres->format('d')."-".$dia_tres->format('m');
        
    debug_to_console("222222 ".$dia_uno->format('Y\-m\-d'));
    /*
    $first =  $datetime->getTimestamp();
    $diaNombre =  $days_dias[date('l', $datetime->getTimestamp())];
    $diaNumero = $datetime->format('d');
    $mesNumero = $datetime->format('m');
    $primerDia = $diaNombre." ".$diaNumero."-".$mesNumero;

    $datetime->add(new DateInterval('P1D'));
    $diaNombre =  $days_dias[date('l', $datetime->getTimestamp())];
    $diaNumero = $datetime->format('d');
    $mesNumero = $datetime->format('m');
    $segundoDia = $diaNombre." ".$diaNumero."-".$mesNumero;


    $datetime->add(new DateInterval('P1D'));
    $diaNombre =  $days_dias[date('l', $datetime->getTimestamp())];
    $diaNumero = $datetime->format('d');
    $mesNumero = $datetime->format('m');
    $tercerDia = $diaNombre." ".$diaNumero."-".$mesNumero;

    $last =  $datetime->getTimestamp();
    

    if (isset($_GET['next']))
    {
        
        $last = $_GET['next'];

        debug_to_console("$last");
        debug_to_console("entra a get next");
        $datetime->setTimestamp($last);
        
        $datetime->add(new DateInterval('P1D'));
        $first =  $datetime->getTimestamp();
        $_SESSION['firstTimestamp'] = $last;
        debug_to_console("en sesion ".$_SESSION['firstTimestamp']);
        $diaNombre =  $days_dias[date('l', $datetime->getTimestamp())];
        $diaNumero = $datetime->format('d');
        $mesNumero = $datetime->format('m');
        $primerDia = $diaNombre." ".$diaNumero."-".$mesNumero;

        $datetime->add(new DateInterval('P1D'));
        $diaNombre =  $days_dias[date('l', $datetime->getTimestamp())];
        $diaNumero = $datetime->format('d');
        $mesNumero = $datetime->format('m');
        $segundoDia = $diaNombre." ".$diaNumero."-".$mesNumero;


        $datetime->add(new DateInterval('P1D'));
        $diaNombre =  $days_dias[date('l', $datetime->getTimestamp())];
        $diaNumero = $datetime->format('d');
        $mesNumero = $datetime->format('m');
        $tercerDia = $diaNombre." ".$diaNumero."-".$mesNumero;
        $last =  $datetime->getTimestamp();
    }
    if (isset($_GET['prev']))
    {
        
        $first = $_GET['prev'];

        debug_to_console("$first");
        debug_to_console("entra a get prev");
        $datetime->setTimestamp($first);
        
        $datetime->sub(new DateInterval('P3D'));
        $first =  $datetime->getTimestamp();
        $_SESSION['firstTimestamp'] = $datetime->getTimestamp();
        $diaNombre =  $days_dias[date('l', $datetime->getTimestamp())];
        $diaNumero = $datetime->format('d');
        $mesNumero = $datetime->format('m');
        $primerDia = $diaNombre." ".$diaNumero."-".$mesNumero;

        $datetime->add(new DateInterval('P1D'));
        $diaNombre =  $days_dias[date('l', $datetime->getTimestamp())];
        $diaNumero = $datetime->format('d');
        $mesNumero = $datetime->format('m');
        $segundoDia = $diaNombre." ".$diaNumero."-".$mesNumero;


        $datetime->add(new DateInterval('P1D'));
        $diaNombre =  $days_dias[date('l', $datetime->getTimestamp())];
        $diaNumero = $datetime->format('d');
        $mesNumero = $datetime->format('m');
        $tercerDia = $diaNombre." ".$diaNumero."-".$mesNumero;
        $last =  $datetime->getTimestamp();
    }
    */
    if (isset($_GET['loadTime']))
    {
        
        debug_to_console("3333333333333 ".$dia_uno->format('Y\-m\-d'));
        $timestampDate = $_GET['loadTime'];
        debug_to_console("loadTime : $timestampDate");
        $dateSelected = new DateTime();
        $dateSelected->setTimestamp($timestampDate);

        $dateSearch = $dateSelected->format('Y\-m\-d');

        $queryHorarios = "select DATE_FORMAT(hora_dia, '%H:%i') as 'hora_dia' from cuidotuamigodb.horario where fecha='$dateSearch' and id_trabajador= 2";
        $resultado = $conex->query($queryHorarios);

        debug_to_console("$resultado->num_rows");
    }

    if(isset($_GET['hour'])){
        $hourSelected = $_GET['hour'];
        debug_to_console("$hourSelected  $dateSelected");
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

        <div>
            <div class="filtros-res">
                <div class="row">
                    <div class="col-md-5">
                        <form action="" class="form-group formulario-res">
                            <label for="correo" class="form_label">Profesional: </label>
                            <select name="comuna" id="comuna" class="form-control">
                                <option value="1">Juan Perez</option>
                                <option value="2">Antonia Lagos</option>
                                <option value="3">Maria Rosales</option>
                            </select> <br/>
                            <label for="pass" class="form_label">Mascota:</label>
                            <select name="comuna" id="comuna" class="form-control">
                                <option value="1">Michi</option>
                                <option value="2">Cachupin</option>
                            </select> 
                            <br/>
                            <input type="button" value="Buscar" class="btn btn_planes"><br><br>
                        </form>
                        
                       
                    </div>
                    <div class="col-md-7 days-div">
                        <div class="row days-div-hours">
                            <div class="col-md-1"><a href="reserva2.php?prev=<?php echo $dia_uno->getTimestamp();?>"><i class="bi bi-caret-left-fill"></i></a></div>
                            <div class="col-md-9">
                                <nav>
                                    <div class="nav nav-tabs  days-tab-avaible days-nav" id="nav-tab" role="tablist">
                                        <a class="nav-link" id="nav-home-tab"  href="reserva2.php?loadTime=<?php echo $dia_uno->getTimestamp();?>" role="tab" aria-controls="nav-home" aria-selected="true"><?php echo $primerDia;?></a>
                                        <a class="nav-link" id="nav-profile-tab" href="reserva2.php?loadTime=<?php echo $dia_dos->getTimestamp();?>"" role="tab" aria-controls="nav-profile" aria-selected="false"><?php echo $segundoDia;?></a>
                                        <a class="nav-link" id="nav-contact-tab" href="reserva2.php?loadTime=<?php echo $dia_tres->getTimestamp();?>" role="tab" aria-controls="nav-contact" aria-selected="false"><?php echo $tercerDia;?></a>
                                    </div>
                                </nav>
                                <br/>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <?php 
                                            if(isset($resultado)){
                                                $style1="col-md-1 days-hours";
                                                $style2="col-md-2 days-hours";
                                                $style3="btn btn-light";
                                                $type="button";
                                                if($resultado->num_rows > 0){
                                                    echo "<div class='row'>";
                                                    while ($row = mysqli_fetch_array($resultado))
                                                    {
                                                        echo '<div class='.$style1.'></div><div class='.$style2.'><button type='.$type.' class="btn btn-light" onclick="location.href=\'reserva2.php?hour='.$row['hora_dia'].'\'">'.$row["hora_dia"].'</button></div>';
                                                    }
                                                    echo "</div>";
                                                }
                                            }else{

                                            }
                                        ?>
                                        <!--div class="row">
                                            <div class="col-md-1 days-hours"></div><div class="col-md-2 days-hours"><button type="button" class="btn btn-light">10:00</button></div>
                                            <div class="col-md-1 days-hours"></div><div class="col-md-2 days-hours"><button type="button" class="btn btn-light">11:00</button></div>
                                            <div class="col-md-1 days-hours"></div><div class="col-md-2 days-hours"><button type="button" class="btn btn-light">12:00</button></div>
                                            <div class="col-md-1 days-hours"></div><div class="col-md-2 days-hours"><button type="button" class="btn btn-light">13:00</button></div>
                                            <div class="col-md-1 days-hours"></div><div class="col-md-2 days-hours"><button type="button" class="btn btn-light">14:00</button></div>
                                            <div class="col-md-1 days-hours"></div><div class="col-md-2 days-hours"><button type="button" class="btn btn-light">15:00</button></div>
                                            <div class="col-md-1 days-hours"></div><div class="col-md-2 days-hours"><button type="button" class="btn btn-light">16:00</button></div>
                                            <div class="col-md-1 days-hours"></div><div class="col-md-2 days-hours"><button type="button" class="btn btn-light">17:00</button></div>
                                            <div class="col-md-1 days-hours"></div><div class="col-md-2 days-hours"><button type="button" class="btn btn-light">18:00</button></div>
                                            <div class="col-md-1 days-hours"></div><div class="col-md-2 days-hours"><button type="button" class="btn btn-light">19:00</button></div>
                                            <div class="col-md-1 days-hours"></div><div class="col-md-2 days-hours"><button type="button" class="btn btn-light">20:00</button></div>
                                            <div class="col-md-1 days-hours"></div><div class="col-md-2 days-hours"><button type="button" class="btn btn-light">21:00</button></div>
                                            <div class="col-md-1 days-hours"></div><div class="col-md-2 days-hours"><button type="button" class="btn btn-light">22:00</button></div>
                                        </div-->
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-1"><a href="reserva2.php?next=<?php echo $dia_tres->getTimestamp();?>"><i class="bi bi-caret-right-fill"></i></a></div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-6"><label for="correo" class="form_label">Resumen: </label></div>
                            <div class="col-md-3"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <ul class="list-group">
                                    <li class="list-group-item">Lun 21-06 10:00 <a href="#"><i class="bi bi-x-circle-fill"></i></a></li>
                                    <li class="list-group-item">Mar 22-06 10:00 <a href="#"><i class="bi bi-x-circle-fill"></i></a></li>
                                    <li class="list-group-item">Mar 22-06 18:00 <a href="#"><i class="bi bi-x-circle-fill"></i></a></li>
                                </ul>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                        <br/>
                    </div>
                </div>
                <div class="row">
                </div>
                <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                    <form action="" >
            
                        <input type="button" value="Reservar" onclick="location.href='confirmacion.php'" class="btn btn_planes"><br><br>
                    </form>
                    </div>
                
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