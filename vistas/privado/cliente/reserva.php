<!DOCTYPE html>
<?php
    $array = array("../../../estatico/css/reserva.css");
    include('../../comun/head.php');
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
            <div class="filtros">
                <form action="" class="formulario">
                    <label for="correo" class="form_label">Profesional: </label>
                    <select name="comuna" id="comuna" class="form_select">
                        <option value="1">Juan Perez</option>
                        <option value="2">Antonia Lagos</option>
                        <option value="3">Maria Rosales</option>
                    </select> <br/><br/>
                    <label for="pass" class="form_label">Mascota:</label>
                    <select name="comuna" id="comuna" class="form_select">
                        <option value="1">Michi</option>
                        <option value="2">Cachupin</option>
                    </select> 
                    <input type="button" value="Buscar" class="btn btn_planes"><br><br>
                </form>

            </div>

            <div class="agenda">
                <div class="container-fluid">
                    <header>
                        <h4 class="mb-4 text-center agenda_titulo">Junio 2021</h4>
                        <div class="row d-none d-sm-flex p-1 bg-dark text-white">
                            <h5 class="col-sm p-1 text-center">Lunes</h5>
                            <h5 class="col-sm p-1 text-center">Martes</h5>
                            <h5 class="col-sm p-1 text-center">Miércoles</h5>
                            <h5 class="col-sm p-1 text-center">Jueves</h5>
                            <h5 class="col-sm p-1 text-center">Viernes</h5>
                            <h5 class="col-sm p-1 text-center">Sábado</h5>
                            <h5 class="col-sm p-1 text-center">Domingo</h5>
                        </div>
                    </header>
                    <div class="row border border-right-0 border-bottom-0 agenda_libre">
                        <div
                            class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block text-muted agenda_bloqued agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">31</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">1</span>
                            </h5>
                            <a class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small text-white hora_disp">16:00 Disp</a>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">2</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">3</span>
                            </h5>
                            <a class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small text-white hora_disp">16:00 Disp</a>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">4</span>
                            </h5>
                            <a class="event d-block p-1 pl-2 pr-2 mb-1 rounded text-truncate small text-white hora_ocupada">16:00 Ocupado</a>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">5</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">6</span>
                            </h5>
                        </div>
                        <!-- salto semana -->
                        <div class="w-100"></div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">7</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">8</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">9</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">10</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">11</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">12</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">13</span>
                            </h5>
                        </div>
                        <!-- salto semana -->
                        <div class="w-100"></div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">14</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">15</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">16</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">17</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">18</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">19</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">20</span>
                            </h5>
                        </div>
                        <!-- salto semana -->
                        <div class="w-100"></div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">21</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">22</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">23</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">24</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">25</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">26</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">27</span>
                            </h5>
                        </div>
                        <!-- salto semana -->
                        <div class="w-100"></div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">28</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">29</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">30</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_bloqued agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">1</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_bloqued agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">2</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_bloqued agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">3</span>
                            </h5>
                        </div>
                        <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate agenda_bloqued agenda_dia">
                            <h5 class="row align-items-center">
                                <span class="date col-1">4</span>
                            </h5>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="accion">
                <form action="" class="accion_form">
            
                    <input type="button" value="Reservar" onclick="location.href='confirmacion.php'" class="btn btn_planes"><br><br>
                </form>

            </div>
        </div>

        <?php
            include('../../comun/footer.php');
        ?>

    </div>


</body>

</html>