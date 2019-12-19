<?php

    $Empresa = $_POST["TxtEmpresa"];
    $Ejercicio = $_POST["TxtEjercicio"];

    echo file_get_contents('http://ws.eimportacion.com.mx/tabla-clientessaldo.php?x1='.$Empresa.'&x2='.$Mes.'&x3='.$Ejercicio.'');
?>