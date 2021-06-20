<!DOCTYPE html>
<?php

$arrayCss = array("../../../estatico/css/agregar_trabajador.css");
include('../../comun/head.php');

if (isset($_POST['submit'])) {
  
    include("../../../data/conexiondb.php");


  $data = [
    'error' => false,
    'mensaje' => 'El trabajador ' . $_POST['nombre'] . ' ha sido agregado con éxito' 
  ];


  try {

    $nombre = $_POST["nombre"];
    $apellido_pat = $_POST["apellido_pat"];
    $apellido_mat = $_POST["apellido_mat"];
    $rut = $_POST["rut"];
    $correo = $_POST["correo"];
    $cargo = $_POST["cargo"];
    
    
    $consulta = "INSERT INTO persona (nombre, rut, apellido_paterno, apellido_materno, correo)
    VALUES ('$nombre','$rut', '$apellido_pat', '$apellido_mat','$correo')"; 

    $resultado = mysqli_query($conex, $consulta);
    
    if ($resultado){
        $consulta = "select id_persona from persona where rut ='$rut'";
        $resultado = mysqli_query($conex, $consulta);
        if (isset($resultado)) {
            while ($row = mysqli_fetch_array($resultado)) {
               
                $id_persona = $row['id_persona'];

                $consulta = "INSERT INTO trabajador (id_tipo_trabajador, id_usuario, id_persona, cargo) 
                VALUES ('1','1', '$id_persona','$cargo')";

                $resultadoInsert = mysqli_query($conex, $consulta);
                if ($resultadoInsert){
                   
                }else{
                    $data['error'] = true;
                    $data['mensaje'] = "No se pudo crear el trabajador";
                }
            }
        }
    };

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
            include('../../comun/menu_privado_admin.php');
        ?>

        <article class="box2">
            <div class="contenido">
                <h2> Agregar Trabajador  </h2><br>

                <?php
                    if (isset($resultadoInsert)) {
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
                        <input type="text" id="nombre" name="nombre" ><br><br>
                        <label for="apellido_pat">Apellido Paterno:</label>
                        <input type="text" id="apellido_pat" name="apellido_pat" ><br><br>
                        <label for="apellido_mat">Apellido Materno:</label>
                        <input type="text" id="apellido_mat" name="apellido_mat" ><br><br>
                        <label for="rut">Rut:</label>
                        <input type="text" id="rut" name="rut" ><br><br>
                        <label for="correo">Correo:</label>
                        <input type="text" id="correo" name ="correo"><br><br>
                        <label for="cargo">Cargo:</label>
                        <input type="text" id="cargo" name ="cargo"><br><br>
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