<?php

    $suc = $_POST["CmbSUCURSALES"]; 
//    $mes = $_POST["TxtMes"]; 
//    $ejercicio = $_POST["TxtEjercicio"];
    $fini = $_POST["Fini"]; 
    $ffin = $_POST["Ffin"];
    $cliente = $_POST["TxtClave"];
    $estatus = $_POST["CmbEstatus"];
    $Empresa = $_POST["TxtEmpresa"];
    //$query = "dbo.RPT_SP_COBRANZADIARIA @fini = '".$myparams['fini']."', @ffin = '".$myparams['ffin']."', @suc = '".$myparams['suc']."'";
    //print_r($query);
    //print_r($myparams);
//print_r('http://192.168.20.130/tabla-reporte3.php?x1='.$suc.'&x2='.$fini.'&x3='.$ffin.'&x4='.$cliente.'&x5='.$estatus.'');
    //print_r('http://192.168.20.130/grafcobdiaria2.php?x1='.$suc.'&x2='.$mes.'&x3='.$ejercicio.'&x4='.$cliente.'&x5='.$estatus.'');
    echo file_get_contents('http://192.168.20.130/grafcobdiaria2.php?x1='.$suc.'&x2='.$fini.'&x3='.$ffin.'&x4='.$cliente.'&x5='.$estatus.'&x6='.$Empresa.'');
    
?>