<?php
    $Empresa = $_POST["TxtEmpresa"];
    $Mes = $_POST["TxtMes"]; 
    $Ejercicio = $_POST["TxtEjercicio"];

    //print_r('http://192.168.20.130/gastos1.php?x1='.$Empresa.'&x2='.$Mes.'&x3='.$Ejercicio.'');
    echo file_get_contents('http://192.168.20.130/tabla-selgastos1.php?x1='.$Empresa.'&x2='.$Mes.'&x3='.$Ejercicio.'');
?>