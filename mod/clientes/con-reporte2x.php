<?php
    $suc = $_POST["CmbSUCURSALES"]; 
    $fini = $_POST["Fini"]; 

    //$query = "dbo.RPT_SP_COBRANZADIARIA @fini = '".$myparams['fini']."', @ffin = '".$myparams['ffin']."', @suc = '".$myparams['suc']."'";
    //print_r($query);
    //print_r($myparams);
    include('http://192.168.20.130/tabla-reporte2.php?x1='.$suc.'&x2='.$fini.'');
?>