<?php
    $Empresa = $_POST["TxtEmpresa"];
    $Mes = $_POST["TxtMes"]; 
    $Ejercicio = $_POST["TxtEjercicio"];
    $Cuenta = $_POST["TxtClave"];
    $Periodo = $_POST["TxtRow"];
    $Suc = $_POST["TxtSuc"];

    //print_r('http://ws.eimportacion.com.mx/tabla-selgastos2.php?x1='.$Empresa.'&x2='.$Mes.'&x3='.$Ejercicio.'&x4='.$Cuenta.'');
    echo file_get_contents('http://ws.eimportacion.com.mx/tabla-selgastos2.php?x1='.$Empresa.'&x2='.$Mes.'&x3='.$Ejercicio.'&x4='.$Cuenta.'&x5='.$Periodo.'');
?>