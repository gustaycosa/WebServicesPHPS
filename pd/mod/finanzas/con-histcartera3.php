<?php
    $suc = $_POST["CmbSUCURSALES"]; 
    $fini = $_POST["Fini"];
    $cliente = $_POST["TxtClave"];

    $vendedor = $_POST["Cmbvendedores"];
    $tipo = $_POST["cmbseries"];
    $moneda = $_POST["cmbmoneda"];

    echo file_get_contents('http://ws.eimportacion.com.mx/tabla-histcartera4.php?x1='.$suc.'&x2='.$fini.'&x3='.$cliente.'&x4='.$vendedor.'&x5='.$tipo.'&x6='.$moneda.'');
?>