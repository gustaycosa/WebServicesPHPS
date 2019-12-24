<?php

    $suc = $_POST["CmbSUCURSALES"]; 
    $fini = $_POST["Fini"]; 
    $ffin = $_POST["Ffin"];
    $cliente = $_POST["TxtClave"];
    $estatus = $_POST["CmbEstatus"];
    $Empresa = $_POST["TxtEmpresa"];
    //print_r('http://ws.eimportacion.com.mx/tabla-cobdiaria2.php?x1='.$suc.'&x2='.$fini.'&x3='.$ffin.'&x4='.$cliente.'&x5='.$estatus.'');
    echo file_get_contents('http://ws.eimportacion.com.mx/tabla-cobdiaria2.php?x1='.$suc.'&x2='.$fini.'&x3='.$ffin.'&x4='.$cliente.'&x5='.$estatus.'&x6='.$Empresa.'');
    
?>