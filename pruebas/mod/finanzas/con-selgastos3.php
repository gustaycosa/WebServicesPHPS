<?php
    $Empresa = $_POST["TxtEmpresa"];
    $Mes = $_POST["TxtMes"]; 
    $Ejercicio = $_POST["TxtEjercicio"];
    $Cuenta = $_POST["TxtClave"];
    $Periodo = $_POST["TxtRow"];
    $Suc = $_POST["TxtSuc"];
    //print_r('http://ws.eimportacion.com.mx/tabla-compulsaalmvsconta.php?x1='.$Empresa.'&x2='.$Mes.'&x3='.$Ejercicio.'&x4='.$suc.'');
    echo file_get_contents('http://ws.eimportacion.com.mx/tabla-selgastos3.php?x1='.$Empresa.'&x2='.$Mes.'&x3='.$Ejercicio.'&x4='.$Cuenta.'&x5='.$Periodo.'&x6='.$Suc.'');
?>