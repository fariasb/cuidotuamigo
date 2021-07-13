<!DOCTYPE html>
<?php
    $array = array("../../../estatico/css/mi_cuenta.css", "../../../estatico/css/admin.css", "../../../estatico/css/reserva.css");
    include('../../comun/head.php');
?>
<body>

    <div id="contenedor"> <!-- Contenedor-->
        <?php
            include('../../comun/header.php');
        ?>
        <?php
            include('../../comun/menu_privado_cliente.php');
        ?>
        <br/>
        <div class="row">
            <div class="col-3">
                <div class="nav flex-column nav-pills red" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#mis-datos" role="tab" aria-controls="v-pills-home" aria-selected="true">Mis datos</a>
                    <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#mis-mascotas" role="tab" aria-controls="v-pills-profile" aria-selected="false">Mis Mascotas</a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#mis-reservas" role="tab" aria-controls="v-pills-messages" aria-selected="false">Mis Reservas</a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content" id="v-pills-tabContents">
                <div class="tab-pane fade" id="mis-datos" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <?php
                        include('./mis_datos.php');
                    ?>
                </div>
                <div class="tab-pane fade show active" id="mis-mascotas" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <?php
                        include('./mis_mascotas.php');
                    ?>
                </div>
                <div class="tab-pane fade" id="mis-reservas" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <?php
                        include('./mis_reservas.php');
                    ?>
                </div>
                </div>
            </div>
        </div>

        <?php
            include('../../comun/footer.php');
        ?>

    </div>


</body>

</html>