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
                                   <h3>1 Paseo a la semana</h3><span class="price"><sup>$</sup>7.000</span>
                               </header>
                               <div class="pricing-body">
                                   <ul>
                                       <li><span style="font-weight: 400;"><strong>Un</strong> paseo de hasta 50 minutos
                                       &nbsp;por un cuidador verificado</span></li>
                                       <li>Durante el paseo se estimula la sociabilización de su mascota</li>
                                       <li><span style="font-weight: 400;">Incluye materiales como bolsa de fecas</span></li>
                                       <li>Disponible en diferentes comunas</li>
                                       <li>Se comparte registro fotográfico</li>
                                   </ul>
                               </div>
                               <footer class="pricing-footer">
                                   <div>
                                       <input type="button" value="Reservar" onclick="location.href='valida_sesion.php'"  class="btn btn_planes"><br>
                                   </div>
                               </footer>
                           </div>
                       </div>
                       <div class="col-md-4 col-sm-4">
                           <div class="pricing-table pricing-table__style1 no  col_planes">
                               <header class="pricing-head">
                                   <h3>3 paseos a la semana</h3><span class="price"><sup>$</sup>19.500</span>
                               </header>
                               <div class="pricing-body">
                                   <ul>
                                       <li><span style="font-weight: 400;"><strong>Tres</strong> paseos de hasta 50
                                               minutos por un cuidador verificado</span></li>
                                       <li>Durante el paseo se estimula la sociabilización de su mascota</li>
                                       <li><span style="font-weight: 400;">Incluye materiales como bolsa de fecas &nbsp;</span></li>
                                       <li>Disponible en diferentes&nbsp;comunas</li>
                                       <li>Se comparte registro fotográfico</li>
                                   </ul>
                               </div>
                               
                               <footer class="pricing-footer">
                                   <div>
                                       <input type="button" value="Reservar" onclick="location.href='valida_sesion.php'" class="btn btn_planes"><br>
                                   </div>
                               </footer>
                           </div>
                       </div>
                       <div class="col-md-4 col-sm-4">
                           <div class="pricing-table pricing-table__style1 popular  col_planes">
                               <header class="pricing-head">
                                   <h3 class="prin_plan" >5 paseos a la semana</h3><span class="price"><sup>$</sup>33.500</span>
                               </header>
                               <div class="pricing-body">
                                   <ul>
                                       <li><strong>Cinco</strong> paseos de hasta 50 minutos por un cuidador verificado
                                       </li>
                                       <li>En cada paseo se estimula la sociabilización de su mascota</li>
                                       <li>Incluye materiales como bolsa de fecas</li>
                                       <li>Disponible en diferentes&nbsp;comunas</li>
                                       <li>Se comparte registro fotográfico</li>
                                   </ul>
                               </div>
                               <footer class="pricing-footer">
                                   <div>
                                       <input type="button" value="Reservar" onclick="location.href='valida_sesion.php'" class="btn btn_planes"><br>
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