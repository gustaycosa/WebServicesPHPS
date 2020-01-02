<?php
    $Empresa = $_POST["TxtEmpresa"];
    $Mes = $_POST["TxtMes"]; 
    $Ejercicio = $_POST["TxtEjercicio"];

    echo file_get_contents('http://192.168.20.130/tabla-edoprecomisiones.php?x1='.$Empresa.'&x2='.$Mes.'&x3='.$Ejercicio.'');
?>