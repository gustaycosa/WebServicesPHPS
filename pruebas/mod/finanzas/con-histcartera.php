<?php
    $Empresa = $_POST["TxtEmpresa"];
    $suc = $_POST["CmbSUCURSALES"]; 
    $fini = $_POST["Fini"];
    $cliente = $_POST["TxtClave"];

    $vendedor = $_POST["Cmbvendedores"];
    $tipo = "0";
    $moneda = $_POST["cmbmoneda"];
//print_r('http://ws.eimportacion.com.mx/tabla-histcartera.php?x1='.$suc.'&x2='.$fini.'&x3='.$cliente.'&x4='.$vendedor.'&x5='.$tipo.'&x6='.$moneda.'&x7='.$Empresa.'');
    echo file_get_contents('http://ws.eimportacion.com.mx/tabla-histcartera.php?x1='.$suc.'&x2='.$fini.'&x3='.$cliente.'&x4='.$vendedor.'&x5='.$tipo.'&x6='.$moneda.'&x7='.$Empresa.'');
?>