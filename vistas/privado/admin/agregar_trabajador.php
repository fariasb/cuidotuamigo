<!DOCTYPE html>
<?php

$array = array("../../../estatico/css/agregar_trabajador.css");
include('../../comun/head.php');

if (isset($_POST['add_trab'])) {
  
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

    $queryValida= "select id_usuario from cuidotuamigodb.usuario u where u.correo ='$correo'";
    $resultadoValida = mysqli_query($conex, $queryValida);

    if($resultadoValida && $resultadoValida->num_rows >0){
        $alerta = true;

        $data = [
            'error' => true,
            'mensaje' => 'El correo indicado en la solicitud ya se encuentra registrado en otro trabajador' 
        ];
    }else{
        $queryCreateUser = "INSERT INTO cuidotuamigodb.usuario
        (id_perfil_usuario, correo, contrasenia)
        VALUES($cargo, '$correo', 'trab01');
        ";

        $resultadoCreate = mysqli_query($conex, $queryCreateUser);
        if ($resultadoCreate){

            $querySelect = "select id_usuario from cuidotuamigodb.usuario u where u.correo ='$correo'";
            $resultadoSelect = mysqli_query($conex, $querySelect);
        
            if($resultadoSelect && $resultadoSelect->num_rows == 1){
                $rowSelect = mysqli_fetch_array($resultadoSelect);
                $idUsuario = $rowSelect["id_usuario"];

                $consulta = "INSERT INTO persona (nombre, rut, apellido_paterno, apellido_materno, correo)
                VALUES ('$nombre','$rut', '$apellido_pat', '$apellido_mat','$correo')"; 
            
                $resultado = mysqli_query($conex, $consulta);
                
                if ($resultado){
                    $consulta = "select id_persona from persona where rut ='$rut'";
                    $resultado = mysqli_query($conex, $consulta);
                    if (isset($resultado)) {
                        while ($row = mysqli_fetch_array($resultado)) {
                           
                            $id_persona = $row['id_persona'];
            
                            $consulta = "INSERT INTO trabajador (id_tipo_trabajador, id_usuario, id_persona) 
                            VALUES ($cargo,$idUsuario, '$id_persona')";
            
                            $resultadoInsert = mysqli_query($conex, $consulta);
                            if ($resultadoInsert){
                               
                            }else{
                                $data['error'] = true;
                                $data['mensaje'] = "No se pudo crear el trabajador";
                            }
                        }
                    }
                };
            }
        }else{
            echo mysqli_error($conex);
        }
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
                        <div class="form-row">
                            <div class="col-md-3">
                                <label for="nombre">Nombre:</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="nombre" name="nombre" class="form-control" required>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col-md-3">
                                <label for="apellido_pat">Apellido Paterno:</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="apellido_pat" name="apellido_pat" class="form-control" required>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col-md-3">
                                <label for="apellido_mat">Apellido Materno:</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="apellido_mat" name="apellido_mat" class="form-control" required>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col-md-3">
                                <label for="rut">Rut:</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="rut" name="rut" class="form-control" required>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col-md-3">
                                <label for="correo">Correo:</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="correo" name="correo" class="form-control" required>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col-md-3">
                                <label for="cargo">Cargo:</label>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control select_cargo" id="cargo" name="cargo" style="width:100%" required>
                                    <option value="1">Paseador</option>
                                    <option value="2">Administrador</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <input type="submit" value="Guardar"  name="add_trab" class="btn  btn_planes"><br><br>
                        
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