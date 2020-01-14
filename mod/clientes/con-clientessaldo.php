<?php

    $Empresa = $_POST["TxtEmpresa"];
    $Ejercicio = $_POST["TxtEjercicio"];

    echo file_get_contents('http://192.168.20.130/tabla-clientessaldo.php?x1='.$Empresa.'&x3='.$Ejercicio.'');
?>