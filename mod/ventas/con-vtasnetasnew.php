<?php

    $Id_Empresa = 'EAGLE';
    $Mes = $_POST["TxtMes"];
    $Ejercicio = $_POST["TxtEjercicio"]; 
    $Moneda = $_POST["CmbMoneda"];    

    include('http://192.168.20.130/tabla-vtasnetasnew.php?x1='.$Id_Empresa.'&x2='.$Mes.'&x3='.$Ejercicio.'&x4='.$Moneda.'');
?>