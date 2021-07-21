<!DOCTYPE html>
<?php
    $array = array("../../estatico/css/planes.css");
    include('../comun/head.php');
?>
<body>

    <div id="contenedor"> <!-- Contenedor-->
        <?php
            include('../comun/header.php');
        ?>
        <?php
            include('../comun/menu_publico.php');
        ?>

        <div >
           
            
           <div class="spacer spacer-sm"></div>
           <div >
               <div >
                   
                   <div class="row row_planes">
                     
                       <div class="col-md-4 col-sm-4">
                           <div class="pricing-table pricing-table__style1 no col_planes">
                               <header class="pricing-head">
                                   <h3>1 visita a la semana</h3><span class="price"><sup>$</sup>7.000</span>
                               </header>
                               <div class="pricing-body">
                                   <ul>
                                       <li><span style="font-weight: 400;"><strong>Una</strong> visita de hasta una
                                               hora&nbsp;por un cuidador verificado</span></li>
                                       <li>Durante la visita se revisa que tenga agua y comida</li>
                                       <li><span style="font-weight: 400;">Incluye <strong>un</strong> paseo de 30
                                               minutos</span></li>
                                       <li>Disponible en diferentes comunas</li>
                                       <li>Garantía veterinaria limitada</li>
                                   </ul>
                               </div>
                               <footer class="pricing-footer">
                                   <div>
                                       <input type="button" value="Reservar" onclick="location.href='valida_sesion.php'"  class="btn  btn_planes"><br>
                                   </div>
                               </footer>
                           </div>
                       </div>
                       <div class="col-md-4 col-sm-4">
                           <div class="pricing-table pricing-table__style1 no  col_planes">
                               <header class="pricing-head">
                                   <h3>3 visitas a la semana</h3><span class="price"><sup>$</sup>12.500</span>
                               </header>
                               <div class="pricing-body">
                                   <ul>
                                       <li><span style="font-weight: 400;"><strong>Tres</strong> visitas de hasta una
                                               hora por un cuidador verificado</span></li>
                                       <li>En cada visita se revisará que tenga agua y comida</li>
                                       <li><span style="font-weight: 400;">Incluye <strong>tres</strong> paseos&nbsp;de
                                               30 minutos&nbsp;</span></li>
                                       <li>Disponible en diferentes&nbsp;comunas</li>
                                       <li>Garantía veterinaria limitada</li>
                                   </ul>
                               </div>
                               
                               <footer class="pricing-footer">
                                   <div>
                                       <input type="button" value="Reservar" onclick="location.href='valida_sesion.php'" class="btn  btn_planes"><br>
                                   </div>
                               </footer>
                           </div>
                       </div>
                       <div class="col-md-4 col-sm-4">
                           <div class="pricing-table pricing-table__style1 popular  col_planes">
                               <header class="pricing-head">
                                   <h3 class="prin_plan" >5 visitas a la semana</h3><span class="price"><sup>$</sup>17.000</span>
                               </header>
                               <div class="pricing-body">
                                   <ul>
                                       <li><strong>Cinco</strong> visitas de hasta una hora por un cuidador verificado
                                       </li>
                                       <li>En cada visita se revisará que tenga agua y comida</li>
                                       <li>Incluye <strong>cinco</strong>&nbsp;paseos. Dos de 30 minutos y uno de una
                                           hora</li>
                                       <li>Disponible en diferentes&nbsp;comunas</li>
                                       <li>Garantía veterinaria limitada</li>
                                   </ul>
                               </div>
                               <footer class="pricing-footer">
                                   <div>
                                       <input type="button" value="Reservar" onclick="location.href='valida_sesion.php'" class="btn  btn_planes"><br>
                                   </div>
                               </footer>
                           </div>
                       </div>
                   </div>
               </div>
           </div>

       </div>

        <?php
            include('../comun/footer.php');
        ?>

    </div>


</body>

</html>