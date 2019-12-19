<?php
    $suc = $_POST["CmbSUCURSALES"]; 
    $fini = $_POST["Fini"]; 
    $ffin = $_POST["Ffin"];
    $cliente = $_POST["TxtClave"];
    $tipo = $_POST["cmbtipo"]; 
    $moneda = $_POST["cmbmoneda"]; 
    $empresa = "eagle"; 
    //$query = "dbo.RPT_SP_COBRANZADIARIA @fini = '".$myparams['fini']."', @ffin = '".$myparams['ffin']."', @suc = '".$myparams['suc']."'";
    //print_r($query);
    //print_r($myparams);
    echo file_get_contents('http://ws.eimportacion.com.mx/tabla-trayfactpago.php?x1='.$tipo.'&x2='.$fini.'&x3='.$ffin.'&x4='.$moneda.'&x5='.$empresa.'&x6='.$suc.'&x7='.$cliente.'');
?>