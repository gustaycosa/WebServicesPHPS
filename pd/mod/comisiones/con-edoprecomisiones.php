<?php

    $Empresa = 'EAGLE';
    $Mes = $_POST["TxtMes"]; 
    $Ejercicio = $_POST["TxtEjercicio"];

    echo file_get_contents('http://ws.eimportacion.com.mx/tabla-edoprecomisiones.php?x1='.$Empresa.'&x2='.$Mes.'&x3='.$Ejercicio.'');
?>