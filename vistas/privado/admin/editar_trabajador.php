<!DOCTYPE html>
<?php

    $array = array("../../../estatico/css/agregar_trabajador.css");
    include('../../comun/head.php');

    if (isset($_GET['edit_id_persona'])) {
    
        include("../../../data/conexiondb.php");


    
    $data = [
        'error' => true,
        'mensaje' => 'El trabajador no fue encontrado' 
    ];  


        $idPersona=$_GET["edit_id_persona"];
        $idTrabajador=$_GET["edit_id_trabajador"];

        $queryBuscaPersona = "select * from persona where id_persona=$idPersona";
        $registros = mysqli_query($conex, $queryBuscaPersona);

        $reg = mysqli_fetch_array($registros);
        
        
        $queryBuscaTrabajador = "select * from trabajador where id_trabajador=$idTrabajador";
        $registrosTrab = mysqli_query($conex, $queryBuscaTrabajador);

        $regTrab = mysqli_fetch_array($registrosTrab);
    
    }
    if (isset($_POST['submit'])) {

        include("../../../data/conexiondb.php");

        $data = [
            'error' => false,
            'mensaje' => 'El trabajador ' .  $_POST['nombre'] . ' ha sido modificado con éxito' 
        ];

        $nombre = $_POST["nombre"];
        $apellido_pat = $_POST["apellido_pat"];
        $apellido_mat = $_POST["apellido_mat"];
        $rut = $_POST["rut"];
        $correo = $_POST["correo"];
        $cargo = $_POST["cargo"];

        $queryUpdatePersona = "update persona set nombre='$nombre',
        rut='$rut',
        apellido_paterno='$apellido_pat',
        apellido_materno='$apellido_mat',
        correo='$correo'
        where id_persona=$idPersona";
        $resultadoUpdate = mysqli_query($conex, $queryUpdatePersona);


        $queryUpdateTrabajador = "update trabajador set cargo='$cargo'
        where id_trabajador=$idTrabajador";
        $resultadoUpdate = mysqli_query($conex, $queryUpdateTrabajador);

        //Busca de nuevo para actualizar los datos en pantalla

        $queryBuscaPersona = "select * from persona where id_persona=$idPersona";
        $registros = mysqli_query($conex, $queryBuscaPersona);

        $reg = mysqli_fetch_array($registros);
        
        
        $queryBuscaTrabajador = "select * from trabajador where id_trabajador=$idTrabajador";
        $registrosTrab = mysqli_query($conex, $queryBuscaTrabajador);

        $regTrab = mysqli_fetch_array($registrosTrab);

    }
?>


<body>

    <div id="contenedor"> <!-- Contenedor-->
        <?php
            include('../../comun/header.php');
        ?>
        <?php
            include('../../comun/menu_privado_admin.php');
        ?>

        <article class="box2">
            <div class="contenido">
                <h2> Editar Trabajador  </h2><br>

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
                                
                <div class="formulario_contacto">
                    
                    <form  method="POST">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" value="<?= $reg['nombre'] ?>"><br><br>
                        <label for="apellido_pat">Apellido Paterno:</label>
                        <input type="text" id="apellido_pat" name="apellido_pat" value="<?= $reg['apellido_paterno'] ?>"><br><br>
                        <label for="apellido_mat">Apellido Materno:</label>
                        <input type="text" id="apellido_mat" name="apellido_mat" value="<?= $reg['apellido_materno'] ?>"><br><br>
                        <label for="rut">Rut:</label>
                        <input type="text" id="rut" name="rut" value="<?= $reg['rut'] ?>"><br><br>
                        <label for="correo">Correo:</label>
                        <input type="text" id="correo" name ="correo" value="<?= $reg['correo'] ?>"><br><br>
                        <label for="cargo">Cargo:</label>
                        <input type="text" id="cargo" name ="cargo"  value="<?= $regTrab['cargo'] ?>"><br><br>
                        <input type="submit" value="Guardar"  name="submit" class="btn  btn_planes"><br><br>
                        
                    </form><br>
                    <form action="admin_trabajadores.php" method="POST">
                        <input type="submit" value="Volver a Listado" name ="agregar"  class="btn btn-success btn_planes">
                    </form>
    
                </div>
            </div>
    
        </article>

        <?php
            include('../../comun/footer.php');
        ?>

    </div>
</body>

</html>