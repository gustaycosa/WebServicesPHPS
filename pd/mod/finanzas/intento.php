<?php

//    $myparams['Empresa'] = 'EAGLE';
//    $myparams['Mes'] = $_POST["TxtMes"]; 
//    $myparams['Ejercicio'] = $_POST["TxtEjercicio"];

    $Empresa = $_POST["TxtEmpresa"];
    $Mes = $_POST["TxtMes"]; 
    $Ejercicio = $_POST["TxtEjercicio"];
    
    echo file_get_contents('http://ws.eimportacion.com.mx/tabla-edobalgral.php?x1='.$Empresa.'&x2='.$Mes.'&x3='.$Ejercicio.'');
    
?>