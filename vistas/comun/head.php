<?php
    include_once ($_SERVER['DOCUMENT_ROOT'].'/cuidotuamigo03/rutas.php');
    $path = getcwd();
    //$pathEstatico = "estatico";
    $pathEstatico = ESTATICO_PATH;
    // if (endswithHd($path, 'cliente') || endswithHd($path, 'admin') || endswithHd($path, 'trabajador')) {
    //     $pathEstatico = "../../../estatico";
    // }
    // if (endswithHd($path, 'publico')) {
    //     $pathEstatico = "../../estatico";
    // }

    // function endswithHd($string, $test) {
    //     $strlen = strlen($string);
    //     $testlen = strlen($test);
    //     if ($testlen > $strlen) return false;
    //     return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
    // }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto CTA</title>
    <!--    Enlaza hacia documento css-->
    <link rel="stylesheet" href="<?php echo $pathEstatico;?>/css/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php   
        $count = count($arrayCss);
        for ($i = 0; $i < $count; $i++) {
            echo "<link rel='stylesheet' href='$arrayCss[$i]'>"."\n";
        }
    ?>
    
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
    <script src="<?php echo $pathEstatico;?>/js/jquery.ui.datepicker-es.js"></script>
</head>