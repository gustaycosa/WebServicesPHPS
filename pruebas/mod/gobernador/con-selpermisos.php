<?php
    $empresa = 'EAGLE'; 
    $user = $_POST["TxtClave"];

    echo file_get_contents('http://ws.eimportacion.com.mx/tabla-selpermisos.php?x1='.$empresa.'&x2='.$user.'');
?>