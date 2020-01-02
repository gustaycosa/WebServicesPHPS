<?php
    $Empresa = $_POST["TxtEmpresa"];
    //$Mes = $_POST["TxtMes"]; 
    //$Ejercicio = $_POST["TxtEjercicio"];
    $fini = $_POST["Fini"]; 
    $ffin = $_POST["Ffin"]; 
    //print_r('http://192.168.20.130/gastos1.php?x1='.$Empresa.'&x2='.$Mes.'&x3='.$Ejercicio.'');
    echo file_get_contents('http://192.168.20.130/tabla-gastosgral.php?x1='.$Empresa.'&x2='.$fini.'&x3='.$ffin.'');
?>