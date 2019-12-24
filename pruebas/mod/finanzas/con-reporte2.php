<?php
    $suc = $_POST["CmbSUCURSALES"]; 
    $fini = $_POST["Fini"];
    $cliente = $_POST["TxtClave"];
    $Empresa = $_POST["TxtEmpresa"];
    //$query = "dbo.RPT_SP_COBRANZADIARIA @fini = '".$myparams['fini']."', @ffin = '".$myparams['ffin']."', @suc = '".$myparams['suc']."'";
    //print_r($query);
    //print_r($myparams);
    echo file_get_contents('http://ws.eimportacion.com.mx/tabla-reporte2.php?x1='.$suc.'&x2='.$fini.'&x3='.$cliente.'&x4='.$Empresa.'');
?>