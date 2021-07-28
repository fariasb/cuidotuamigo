<!DOCTYPE html>
<?php

    include_once ($_SERVER['DOCUMENT_ROOT'].'/cuidotuamigo/rutas.php');
    include (DATA_PATH."conexiondb.php");
    

    $pathPrivadoCliente = VPRIVADO_CLIENTE_PATH;


    if (isset($_GET['edit_id_mascotas'])) {
        $edit_id_mascotas = $_GET['edit_id_mascotas'];
    }

    if (isset($_POST['edit_id_mascotas'])) {
        $edit_id_mascotas = $_POST['edit_id_mascotas'];
    }


    $array = array("../../../estatico/css/agregar_trabajador.css", "../../../estatico/css/mi_cuenta.css");
    include('../../comun/head.php');

    $data = [
        'error' => true,
        'mensaje' => 'Hubo un problema, la mascota no fue encontrada, intente más tarde' 
    ];

    $queryMascota = "SELECT * FROM mascota where id_mascota = '$edit_id_mascotas'";
    $resultMascota = mysqli_query($conex,$queryMascota);

    $regMascota = mysqli_fetch_array($resultMascota);

    $queryEspecie = "SELECT id_especie, nombre_especie FROM especie ORDER BY nombre_especie";
    $resultEspecie = mysqli_query($conex,$queryEspecie);

    
    

    if (isset($_POST['guardar_edit_mascota'])) {

        $data = [
            'error' => false,
            'mensaje' => 'La mascota ' .  $_POST['nombre'] . ' ha sido modificada con éxito' 
        ];

        try {

            $nombre = $_POST["nombre"];
            $chip = $_POST["chip"];
            $especie = $_POST["especie"];
            $raza = $_POST["raza"];
            $edad = $_POST["edad"];
            $sexo = $_POST["sexo"];
            $fecha = $_POST["fecha"];
            $tamanio = $_POST["tamanio"];
            $color = $_POST["color"];
            $esterilizada = $_POST["esterilizada"];
            $vacunas = $_POST["vacunas"];
            $enfermedad = $_POST["enfermedad"];
            
            
            $update = "UPDATE cuidotuamigodb.mascota
            SET nombre='$nombre', chip_mascota='$chip', id_especie=$especie, raza='$raza', edad=$edad, fecha_nacto='$fecha', sexo='$sexo',
            tamanio='$tamanio', color='$color', esterilizada='$esterilizada', vacunas='$vacunas', enfermedad='$enfermedad'
            WHERE id_mascota=$edit_id_mascotas;
            "; 

            $resultadoUpdate = mysqli_query($conex, $update);
            
            $queryMascota = "SELECT * FROM mascota where id_mascota = '$edit_id_mascotas'";
            $resultMascota = mysqli_query($conex,$queryMascota);

            $regMascota = mysqli_fetch_array($resultMascota);

            $query = "SELECT id_especie, nombre_especie FROM especie ORDER BY nombre_especie";
            $result = mysqli_query($conex,$query);

        } catch(PDOException $error) {
            $data['error'] = true;
            $data['mensaje'] = $error->getMessage();
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
                    <div class="contenido contenido_mascota">
                        <h2> Editar Mascota  </h2><br>

                        <?php
                            if (isset($resultadoUpdate)) {
                        ?>
                            <div class="container mt-3">
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-<?= $data['error'] ? 'danger' : 'success' ?>" role="alert">
                                    <?= $data['mensaje'] ?>
                                    </div>
                                </div>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                                        
                        <div class="formulario_contacto  formulario_mascota">
                            
                            <form  method="POST">
                                <input type="hidden" id="edit_id_mascotas" name="edit_id_mascotas" value="<?= $edit_id_mascotas;?>">
                                <label for="nombre">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" value="<?= $regMascota['nombre'] ?>"><br>
                                <label for="chip">N° Chip:</label>
                                <input type="text" id="chip" name="chip" value="<?= $regMascota['chip_mascota'] ?>"><br>

                                <label for="especie">Especie:</label>
                                <select class="form-control select_mascota" id="especie" name="especie">
                                    <?php 
                                        while ($row = mysqli_fetch_array($resultEspecie))
                                        {
                                            if($row['id_especie'] == $regMascota['id_especie'] ){
                                                echo "<option value=".$row['id_especie']." selected>".$row['nombre_especie']."</option>";
                                            }else{
                                                echo "<option value=".$row['id_especie'].">".$row['nombre_especie']."</option>";
                                            }
                                        }
                                    ?>       
                                </select><br>

                                <label for="raza">Raza:</label>
                                <input type="text" id="raza" name="raza" value="<?= $regMascota['raza'] ?>"><br>
                                <label for="edad">Edad(años):</label>
                                <input type="text" id="edad" name ="edad" value="<?= $regMascota['edad'] ?>"><br>
                                <label for="fecha">Fecha Nacimiento:</label>
                                <input id="datepickerfrom" type="date" name="fecha" width="250" value="<?= $regMascota['fecha_nacto'] ?>"/><br>
                                <label for="sexo">Sexo:</label>
                                <select class="form-control select_mascota" id="sexo" name="sexo" value="<?= $regMascota['sexo'] ?>">
                                    <?php
                                        if("Hembra" == $regMascota['sexo'] ){
                                            echo "<option selected>Hembra</option>";
                                        }else{
                                            echo "<option>Hembra</option>";
                                        }
                                        if("Macho" == $regMascota['sexo'] ){
                                            echo "<option selected>Macho</option>";
                                        }else{
                                            echo "<option>Macho</option>";
                                        }
                                    ?>  
                                </select><br>
                                <label for="tamanio">Tamaño:</label>
                                <input type="text" id="tamanio" name="tamanio" value="<?= $regMascota['tamanio'] ?>"><br>
                                <label for="color">Color:</label>
                                <input type="text" id="color" name="color" value="<?= $regMascota['color'] ?>"><br>
                                <label for="esterilizada">Esterilizada:</label>
                                <select class="form-control select_mascota" id="esterilizada" name="esterilizada" value="<?= $regMascota['esterilizada'] ?>">
                                    <?php
                                        if("Si" == $regMascota['esterilizada'] ){
                                            echo "<option selected>Si</option>";
                                        }else{
                                            echo "<option>Si</option>";
                                        }
                                        if("No" == $regMascota['esterilizada'] ){
                                            echo "<option selected>No</option>";
                                        }else{
                                            echo "<option>No</option>";
                                        }
                                    ?>  
                                </select><br>
                                <label for="vacunas">Vacunas:</label>
                                <select class="form-control select_mascota" id="vacunas" name="vacunas" value="<?= $regMascota['vacunas'] ?>">
                                    <?php
                                        if("Al dia" == $regMascota['vacunas'] ){
                                            echo "<option selected>Al dia</option>";
                                            echo "<option>Pendiente</option>";
                                            echo "<option>No tiene</option>";
                                        } elseif ("Pendiente" == $regMascota['vacunas']) {
                                            echo "<option>Al dia</option>";
                                            echo "<option selected>Pendiente</option>";
                                            echo "<option>No tiene</option>";
                                        } else {
                                            echo "<option>Al dia</option>";
                                            echo "<option>Pendiente</option>";
                                            echo "<option selected>No tiene</option>";
                                        }
                                        
                                    ?>  
                                    
                                </select><br>
                                
                                <label for="enfermedad">Enfermedad:</label>
                                <input type="text" id="enfermedad" name="enfermedad" value="<?= $regMascota['enfermedad'] ?>"><br><br>
                                <input type="submit" value="Guardar"  name="guardar_edit_mascota" class="btn  btn_planes"><br><br>
                                
                            </form><br><br>
                            <form action="mi_cuenta.php" method="POST">
                                <input type="submit" value="Volver a Listado" name ="agregar"  class="btn btn-success btn_planes">
                            </form>

                        </div>
                    </div>
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