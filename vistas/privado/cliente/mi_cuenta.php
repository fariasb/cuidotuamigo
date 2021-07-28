<!DOCTYPE html>
<?php
    $array = array("../../../estatico/css/mi_cuenta.css", "../../../estatico/css/admin.css", "../../../estatico/css/reserva.css","../../../estatico/font/css/all.css");
    include('../../comun/head.php');
    $tab2 = "active";
    $div2 = "show active";
    $tab1 = "";
    $div1 = "";
    $tab3= "";
    $div3 = "";
    $post = false;
    if (isset($_POST['active'])) {
        $tabActive = $_POST['active'];
        $post = true;
        if($tabActive == 1){
            $tab1 = "active";
            $div1 = "show active";
            $tab2 = "";
            $div2 = "";
            $tab3= "";
            $div3 = "";
        }
        if($tabActive == 2){
            $tab2 = "active";
            $div2 = "show active";
            $tab1 = "";
            $div1 = "";
            $tab3= "";
            $div3 = "";
        }
        if($tabActive == 3){
            $tab3 = "active";
            $div3 = "show active";
            $tab2 = "";
            $div2 = "";
            $tab1= "";
            $div1 = "";
        }
    }
    if (isset($_GET['active'])) {
        $tabActive = $_GET['active'];
        $post = true;
        if($tabActive == 1){
            $tab1 = "active";
            $div1 = "show active";
            $tab2 = "";
            $div2 = "";
            $tab3= "";
            $div3 = "";
        }
        if($tabActive == 2){
            $tab2 = "active";
            $div2 = "show active";
            $tab1 = "";
            $div1 = "";
            $tab3= "";
            $div3 = "";
        }
        if($tabActive == 3){
            $tab3 = "active";
            $div3 = "show active";
            $tab2 = "";
            $div2 = "";
            $tab1= "";
            $div1 = "";
        }
    }
    
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
                    <a class="nav-link <?php echo $tab1;?>" id="v-pills-home-tab" data-toggle="pill" href="#mis-datos" role="tab" aria-controls="v-pills-home" aria-selected="true">Mis datos</a>
                    <a class="nav-link <?php echo $tab2;?>" id="v-pills-profile-tab" data-toggle="pill" href="#mis-mascotas" role="tab" aria-controls="v-pills-profile" aria-selected="false">Mis Mascotas</a>
                    <a class="nav-link <?php echo $tab3;?>" id="v-pills-messages-tab" data-toggle="pill" href="#mis-reservas" role="tab" aria-controls="v-pills-messages" aria-selected="false">Mis Reservas</a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content" id="v-pills-tabContents">
                <div class="tab-pane fade <?php echo $div1;?>" id="mis-datos" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <?php
                        include('./mis_datos.php');
                    ?>
                </div>
                <div class="tab-pane fade <?php echo $div2;?>" id="mis-mascotas" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <?php
                        include('./mis_mascotas.php');
                    ?>
                </div>
                <div class="tab-pane fade <?php echo $div3;?>" id="mis-reservas" role="tabpanel" aria-labelledby="v-pills-messages-tab">
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