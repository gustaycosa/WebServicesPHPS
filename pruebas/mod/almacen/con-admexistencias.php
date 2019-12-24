<?php

//        $empresa = 'eagle'; 
//        $division = $_POST["Cmbdivisiones"]; 
//        $depto = $_POST["Cmbdeptos"];    
//        $familia = $_POST["Cmbfamilia"]; 
//        $text = $_POST["Txtfiltro"]; 
    $Empresa = $_POST["TxtEmpresa"];
    $division = '0';
    $depto = '0';
    $familia = '0';
    $text = '';
    echo file_get_contents('http://ws.eimportacion.com.mx/tabla-admexistencias.php?x1='.$Empresa.'&x2='.$division.'&x4='.$familia.'&x5='.$text.'&x3='.$depto);
?>