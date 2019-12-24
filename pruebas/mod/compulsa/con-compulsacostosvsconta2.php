<?php
    $Empresa = 'EAGLE';
    $Mes = $_POST["TxtMes"]; 
    $Ejercicio = $_POST["TxtEjercicio"];
    $suc = $_POST["CmbSUCURSALES"];
    //print_r('http://ws.eimportacion.com.mx/tabla-compulsaalmvsconta.php?x1='.$Empresa.'&x2='.$Mes.'&x3='.$Ejercicio.'&x4='.$suc.'');
    echo file_get_contents('http://ws.eimportacion.com.mx/tabla-compulsacostosvsconta2.php?x1='.$Empresa.'&x2='.$Mes.'&x3='.$Ejercicio.'&x4='.$suc.'');
?>