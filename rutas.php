<?php 
define('__PROTOCOL__', 'http://');
define('__DOMAIN__', 'localhost');
define('__CONTEXT__', 'cuidotuamigo03/');
///////////////////////////////////
define('ROOT_ESTATIC', __PROTOCOL__.__DOMAIN__."/".__CONTEXT__);
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/'.__CONTEXT__);
define('ESTATICO_PATH', ROOT_ESTATIC.'estatico/');
define('DATA_PATH', ROOT_PATH.'data/');
define('VISTAS_PATH', ROOT_ESTATIC.'vistas/');
define('COMUN_PATH', ROOT_ESTATIC.'vistas/comun/');
define('VPUBLICO_PATH', ROOT_ESTATIC.'vistas/publico/');
define('VPRIVADO_ADMIN_PATH', ROOT_ESTATIC.'vistas/privado/admin');
define('VPRIVADO_TRAB_PATH', ROOT_ESTATIC.'vistas/privado/trabajador/');
define('VPRIVADO_CLIENTE_PATH', ROOT_ESTATIC.'vistas/privado/cliente/');

?>