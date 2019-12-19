<?php
    $emp = $_POST["TxtEmpresa"];
    $suc = $_POST["CmbSUCURSALES"]; 
    $fini = $_POST["Fini"];
    $ffin = $_POST["Ffin"];
    $cliente = $_POST["TxtClave"];
    $vendedor = $_POST["Cmbvendedores"];
    $tipo = "3";
    $moneda = $_POST["cmbmoneda"];
    //print_r('http://ws.eimportacion.com.mx/tabla-factdiariadet.php?x1='.$suc.'&x2='.$fini.'&x3='.$cliente.'&x4='.$vendedor.'&x5='.$tipo.'&x6='.$ffin.'');
    echo file_get_contents('http://ws.eimportacion.com.mx/tabla-factdiariadet.php?x1='.$suc.'&x2='.$fini.'&x3='.$cliente.'&x4='.$vendedor.'&x5='.$tipo.'&x6='.$ffin.'&x7='.$emp.'');

?>