<?php
/*    $suc = $_POST["CmbSUCURSALES"]; 
    $fini = $_POST["Fini"]; 
    $ffin = $_POST["Ffin"];
    $cliente = $_POST["TxtClave"];
    $tipo = $_POST["cmbtipo"]; 
    $moneda = $_POST["cmbmoneda"]; 
    $empresa = "eagle"; */
    //$query = "dbo.RPT_SP_COBRANZADIARIA @fini = '".$myparams['fini']."', @ffin = '".$myparams['ffin']."', @suc = '".$myparams['suc']."'";
    //print_r($query);
    //print_r($myparams);
    echo file_get_contents('http://192.168.20.130/graf-suclitros.php');
?>