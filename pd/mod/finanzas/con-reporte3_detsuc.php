<?php

    $suc = $_POST["TxtSuc"]; 
    $fini = $_POST["Fini"]; 
    $ffin = $_POST["Ffin"];
    $cliente = $_POST["TxtClave"];
    //$mes = $_POST["TxtSuc"];
    $estatus = $_POST["CmbEstatus"];
    $Empresa = $_POST["TxtEmpresa"];


//print_r('http://192.168.20.130/tabla-reporte3_detsuc.php?x1='.$suc.'&x2='.$fini.'&x3='.$ffin.'&x4='.$cliente.'&x5='.$estatus.'');
    echo file_get_contents('http://192.168.20.130/tabla-reporte3_detsuc.php?x1='.$suc.'&x2='.$fini.'&x3='.$ffin.'&x4='.$cliente.'&x5='.$estatus.'&x6='.$Empresa.'');
    
?>