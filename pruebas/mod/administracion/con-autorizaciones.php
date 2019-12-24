<?php

    $empresa = 'EAGLE';
    $estatus = $_POST["CmbEstatus"];
    $fini = $_POST["Fini"]; 
    $ffin = $_POST["Ffin"];    
    $suc = $_POST["CmbSUCURSALES"]; 
    $solicita = $_POST["CmbNOMBRESUSUARIOWEB"]; 
    $responsable = $_POST["TxtEjercicio"]; 
    $depto = $_POST["CmbDepto"]; 
    $tipo = '0';

    echo file_get_contents('http://ws.eimportacion.com.mx/php_con.php?x1='.$empresa.'&x2='.$estatus.'&x3='.$fini.'&x4='.$ffin.'&x5='.$suc.'&x6='.$solicita.'&x7='.$responsable.'&x8='.$depto.'&x9='.$tipo.'');

?>