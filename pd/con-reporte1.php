<?php
    $suc = $_POST["CmbSUCURSALES"]; 
    $fini = $_POST["Fini"]; 
    $ffin = $_POST["Ffin"];

    //$query = "dbo.RPT_SP_COBRANZADIARIA @fini = '".$myparams['fini']."', @ffin = '".$myparams['ffin']."', @suc = '".$myparams['suc']."'";
    //print_r($query);
    //print_r($myparams);
    include('http://ws.eimportacion.com.mx/tabla-reporte1.php?x1='.$suc.'&x2='.$fini.'&x3='.$ffin.'');
?>