<?php

    $estatus = $_POST["TxtRow"];
    $fini = $_POST["TxtMov"]; 

    $Id_Autorizacion = $_POST["TxtRow"];
    $Orden = $_POST["TxtMov"]; 
    $Respuesta = 'SI';
    $sTipo = 0;
    $iError = 0;
    $msg = '';

    echo file_get_contents('http://192.168.20.130/nvo-autok.php?x1='.$Id_Autorizacion.'&x2='.$Orden.'&x3='.$Respuesta.'&x4='.$sTipo.'&x5='.$iError.'&x6='.$msg.'');

?>