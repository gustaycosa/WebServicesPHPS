<?php
    $Empresa = $_POST["TxtEmpresa"];
    $Mes = $_POST["TxtMes"]; 
    $Ejercicio = $_POST["TxtEjercicio"];
    $ctb = $_POST["TxtClave"];

    echo file_get_contents('http://ws.eimportacion.com.mx/tabla-edobalgral2.php?x1='.$Empresa.'&x2='.$Mes.'&x3='.$Ejercicio.'&x4='.$ctb.'');
?>