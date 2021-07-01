<!DOCTYPE html>
<?php

    include_once ($_SERVER['DOCUMENT_ROOT'].'/cuidotuamigo03/rutas.php');
    include (DATA_PATH."conexiondb.php");
    

    $pathPrivadoCliente = VPRIVADO_CLIENTE_PATH;

    if (isset($_POST['id_cliente'])) {
        $idCliente = $_POST['id_cliente'];
    }


    $array = array("../../../estatico/css/agregar_trabajador.css", "../../../estatico/css/mi_cuenta.css");
    include('../../comun/head.php');


    $query = "SELECT id_especie, nombre_especie FROM especie ORDER BY nombre_especie";
    $result = mysqli_query($conex,$query);

    if (isset($_POST['guardar_mascota'])) {

        

        $data = [
            'error' => false,
            'mensaje' => 'La mascota ' . $_POST['nombre'] . ' ha sido registrada con éxito' 
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

            $idCliente = $_POST["idCliente"];
            
            
            $consulta = "INSERT INTO cuidotuamigodb.mascota
            (id_cliente, nombre, chip_mascota, id_especie, raza, edad, fecha_nacto, sexo, tamanio, color, esterilizada, vacunas, enfermedad)
            VALUES($idCliente, '$nombre', '$chip',  $especie, '$raza', $edad, '$fecha', '$sexo', '$tamanio', '$color', '$esterilizada', '$vacunas', '$enfermedad');
            "; 

            $resultado = mysqli_query($conex, $consulta);
            
            if ($resultado){
                
            }else{
                echo mysqli_error($conex);
                $data['error'] = true;
                $data['mensaje'] = "No se pudo registrar la mascota ";
            }

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
                        <h2> Agregar Mascota  </h2><br>

                        <?php
                            if (isset($resultado)) {
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
                                <input type="hidden" id="idCliente" name="idCliente" value="<?= $idCliente;?>">
                                <label for="nombre">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" ><br>
                                <label for="chip">N° Chip:</label>
                                <input type="text" id="chip" name="chip" ><br>

                                <label for="especie">Especie:</label>
                                <select class="form-control select_mascota" id="especie" name="especie">
                                    <?php 
                                    while ($row = mysqli_fetch_array($result))
                                    {
                                        echo "<option value=".$row['id_especie'].">".$row['nombre_especie']."</option>";
                                    }
                                    ?>       
                                </select><br>

                                <label for="raza">Raza:</label>
                                <input type="text" id="raza" name="raza" ><br>
                                <label for="edad">Edad:</label>
                                <input type="text" id="edad" name ="edad"><br>
                                <label for="fecha">Fecha Nacimiento:</label>
                                <input id="datepickerfrom" type="date" name="fecha" width="250"/><br>
                                <label for="sexo">Sexo:</label>
                                <select class="form-control select_mascota" id="sexo" name="sexo">
                                    <option>Hembra</option>
                                    <option>Macho</option>
                                </select><br>
                                <label for="tamanio">Tamaño:</label>
                                <input type="text" id="tamanio" name="tamanio" ><br>
                                <label for="color">Color:</label>
                                <input type="text" id="color" name="color" ><br>
                                <label for="esterilizada">Esterilizada:</label>
                                <select class="form-control select_mascota" id="esterilizada" name="esterilizada">
                                    <option>Si</option>
                                    <option>No</option>
                                </select><br>
                                <label for="vacunas">Vacunas:</label>
                                <input type="text" id="vacunas" name="vacunas" ><br>
                                <label for="enfermedad">Enfermedad:</label>
                                <input type="text" id="enfermedad" name="enfermedad" ><br><br>
                                <input type="submit" value="Guardar"  name="guardar_mascota" class="btn  btn_planes"><br><br>
                                
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