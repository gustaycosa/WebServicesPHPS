<?php
    $Empresa = $_POST["TxtEmpresa"];
    $suc = $_POST["CmbSUCURSALES"]; 
    $fini = $_POST["Fini"]; 
    $ffin = $_POST["Ffin"];
    $cliente = $_POST["TxtClave"];
    $estatus = $_POST["CmbEstatus"];

    //$query = "dbo.RPT_SP_COBRANZADIARIA @fini = '".$myparams['fini']."', @ffin = '".$myparams['ffin']."', @suc = '".$myparams['suc']."'";
    //print_r($query);
    //print_r($myparams);
//print_r('http://ws.eimportacion.com.mx/tabla-reporte3.php?x1='.$suc.'&x2='.$fini.'&x3='.$ffin.'&x4='.$cliente.'&x5='.$estatus.'');
//print_r('http://ws.eimportacion.com.mx/tabla-reporte3.php?x1='.$suc.'&x2='.$fini.'&x3='.$ffin.'&x4='.$cliente.'&x5='.$estatus.'');
    echo file_get_contents('http://ws.eimportacion.com.mx/tabla-cobdiaria.php?x1='.$suc.'&x2='.$fini.'&x3='.$ffin.'&x4='.$cliente.'&x5='.$estatus.'&x6='.$Empresa.'');
    
?>