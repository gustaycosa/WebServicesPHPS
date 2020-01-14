<?php
    $suc = $_POST["CmbSUCURSALES"]; 
    $fini = $_POST["Fini"]; 
    $ffin = $_POST["Ffin"];
    $cliente = $_POST["TxtClave"];

    //$query = "dbo.RPT_SP_COBRANZADIARIA @fini = '".$myparams['fini']."', @ffin = '".$myparams['ffin']."', @suc = '".$myparams['suc']."'";
    //print_r($query);
    //print_r($myparams);
    echo file_get_contents('http://192.168.20.130/tabla-reporte1.php?x1='.$suc.'&x2='.$fini.'&x3='.$ffin.'&x4='.$cliente.'');
?>