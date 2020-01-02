<?php
    $Empresa = $_POST["TxtEmpresa"];
    $Mes = $_POST["TxtMes"]; 
    $Ejercicio = $_POST["TxtEjercicio"];
    $suc = $_POST["CmbSUCURSALES"];
    //print_r('http://192.168.20.130/tabla-compulsaalmvsconta.php?x1='.$Empresa.'&x2='.$Mes.'&x3='.$Ejercicio.'&x4='.$suc.'');
    echo file_get_contents('http://192.168.20.130/tabla-compulsaalmdevprovsconta.php?x1='.$Empresa.'&x2='.$Mes.'&x3='.$Ejercicio.'&x4='.$suc.'');
?>