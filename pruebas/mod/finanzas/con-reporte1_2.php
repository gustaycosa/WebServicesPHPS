<?php
    $suc = $_POST["CmbSUCURSALES"]; 
    $fini = $_POST["Fini"]; 
    $ffin = $_POST["Ffin"];
    $cliente = $_POST["TxtClave"];
    $tipo = $_POST["cmbtipo"]; 
    $moneda = $_POST["cmbmoneda"]; 
    $Empresa = $_POST["TxtEmpresa"];

    echo file_get_contents('http://ws.eimportacion.com.mx/tabla-reporte1_2.php?x1='.$tipo.'&x2='.$fini.'&x3='.$ffin.'&x4='.$moneda.'&x5='.$Empresa.'&x6='.$suc.'&x7='.$cliente.'');
?>